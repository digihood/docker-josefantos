<?php
/**
 * Napojení kontaktního formuláře na Contact Form 7
 *
 * Formulář se spravuje v administraci pluginu, šablona jen řeší vzhled.
 * V obsahu formuláře se dají použít dva zástupné tokeny, aby se ikony
 * a odkaz na zásady nemusely psát do databáze natvrdo:
 *
 *   {{icon:send}}    — inline SVG ikona ze sady d1g1Icons
 *   {{privacy_url}}  — adresa stránky se zásadami ochrany osobních údajů
 *
 * @author Digihood
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'd1g1ContactForm' ) ) {

    class d1g1ContactForm {

        public function __construct() {
            add_filter( 'wpcf7_form_elements', [ $this, 'replace_tokens' ] );

            // rozestupy řeší Tailwind v šabloně formuláře, vlastní <p> a <br> od CF7 by je rozbily
            add_filter( 'wpcf7_autop_or_not', '__return_false' );
        }

        /**
         * Nahradí tokeny v obsahu formuláře
         *
         * @param string $html
         *
         * @author Digihood
         * @return string
         */
        public function replace_tokens( $html ) {

            $html = str_replace(
                '{{privacy_url}}',
                esc_url( get_privacy_policy_url() ?: home_url( '/ochrana-osobnich-udaju/' ) ),
                $html
            );

            return preg_replace_callback(
                '/\{\{icon:([a-z0-9-]+)\}\}/',
                function ( $matches ) {
                    return d1g1Icons::get( $matches[1], 'w-3.5 h-3.5' );
                },
                $html
            );
        }
    }

    new d1g1ContactForm;
}
