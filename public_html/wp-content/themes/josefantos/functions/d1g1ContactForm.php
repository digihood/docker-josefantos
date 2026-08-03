<?php
/**
 * Zpracování kontaktního formuláře
 *
 * V návrhu z Figmy je odeslání pouze simulované (setTimeout), takže odesílání
 * e-mailu je doplněno zde. Běží přes admin-ajax s nonce a honeypotem.
 *
 * @author Digihood
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'd1g1ContactForm' ) ) {

    class d1g1ContactForm {

        const ACTION = 'd1g1_contact';

        public function __construct() {
            add_action( 'wp_ajax_' . self::ACTION, [ $this, 'handle' ] );
            add_action( 'wp_ajax_nopriv_' . self::ACTION, [ $this, 'handle' ] );
        }

        /**
         * Zpracuje odeslaný formulář
         *
         * @author Digihood
         * @return void
         */
        public function handle() {

            check_ajax_referer( self::ACTION, 'nonce' );

            // Honeypot — roboti vyplní skryté pole, lidé ne
            if ( ! empty( $_POST['website'] ) ) {
                wp_send_json_success();
            }

            $name    = sanitize_text_field( wp_unslash( $_POST['name'] ?? '' ) );
            $email   = sanitize_email( wp_unslash( $_POST['email'] ?? '' ) );
            $message = sanitize_textarea_field( wp_unslash( $_POST['message'] ?? '' ) );
            $consent = ! empty( $_POST['consent'] );

            if ( $name === '' || $message === '' ) {
                wp_send_json_error( [ 'message' => __( 'Vyplňte prosím jméno a zprávu.', 'digi' ) ] );
            }

            if ( ! is_email( $email ) ) {
                wp_send_json_error( [ 'message' => __( 'Zadejte platnou e-mailovou adresu.', 'digi' ) ] );
            }

            if ( ! $consent ) {
                wp_send_json_error( [ 'message' => __( 'Bez souhlasu se zpracováním údajů nelze zprávu odeslat.', 'digi' ) ] );
            }

            $recipient = get_field( 'contact_recipient' ) ?: get_option( 'admin_email' );

            $subject = sprintf(
                /* translators: %s: jméno odesílatele */
                __( 'Nová zpráva z webu — %s', 'digi' ),
                $name
            );

            $body = sprintf(
                "%s: %s\n%s: %s\n\n%s:\n%s",
                __( 'Jméno', 'digi' ),
                $name,
                __( 'E-mail', 'digi' ),
                $email,
                __( 'Zpráva', 'digi' ),
                $message
            );

            $headers = [
                'Content-Type: text/plain; charset=UTF-8',
                sprintf( 'Reply-To: %s <%s>', $name, $email ),
            ];

            $sent = wp_mail( $recipient, $subject, $body, $headers );

            if ( ! $sent ) {
                wp_send_json_error( [ 'message' => __( 'Zprávu se nepodařilo odeslat. Zkuste to prosím znovu.', 'digi' ) ] );
            }

            wp_send_json_success();
        }
    }

    new d1g1ContactForm;
}
