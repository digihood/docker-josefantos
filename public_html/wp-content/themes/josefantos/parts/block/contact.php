<?php
/**
 * Blok — Kontakt
 *
 * @author Digihood
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$label         = get_field( 'contact_label' );
$title         = get_field( 'contact_title' );
$submit_text   = get_field( 'contact_submit_text' ) ?: __( 'Odeslat zprávu', 'digi' );
$success_title = get_field( 'contact_success_title' );
$success_text  = get_field( 'contact_success_text' );
$consent       = get_field( 'contact_consent' );

// Sdílené třídy polí formuláře
$field_class = 'w-full bg-transparent border border-border px-4 py-3 text-sm text-foreground placeholder:text-muted-foreground/40 focus:outline-none focus:border-primary transition-colors';
$label_class = 'text-xs font-semibold text-muted-foreground tracking-widest uppercase';

/**
 * Nadpis: každý řádek zvlášť, *text* se obarví primární barvou
 */
$title_html = '';

if ( $title ) {
    foreach ( preg_split( '/\r\n|\r|\n/', $title ) as $line ) {
        $line = preg_replace(
            '/\*(.+?)\*/',
            '<span class="text-primary">$1</span>',
            esc_html( trim( $line ) )
        );
        $title_html .= $line . '<br>';
    }
}

/**
 * Text souhlasu: [odkaz]…[/odkaz] se propojí na zásady ochrany osobních údajů
 */
$consent_html = '';

if ( $consent ) {
    $privacy_url  = get_privacy_policy_url() ?: home_url( '/ochrana-osobnich-udaju/' );
    $consent_html = preg_replace(
        '/\[odkaz\](.+?)\[\/odkaz\]/',
        '<a href="' . esc_url( $privacy_url ) . '" target="_blank" rel="noopener noreferrer" class="text-foreground underline underline-offset-2 hover:text-primary transition-colors">$1</a>',
        esc_html( $consent )
    );
}
?>
<section id="contact" class="container py-24 lg:py-36 border-t border-border">

    <div class="grid grid-cols-1 md:grid-cols-2 gap-16 lg:gap-28 items-start">

        <div class="intersect:animate-fade-up">
            <?php if ( $label ) : ?>
                <span class="block text-xs font-semibold text-muted-foreground tracking-widest uppercase">
                    <?= esc_html( $label ) ?>
                </span>
            <?php endif; ?>

            <?php if ( $title_html ) : ?>
                <h2 class="mt-4 mb-6 font-display font-bold tracking-tighter text-contact">
                    <?= wp_kses_post( $title_html ) ?>
                </h2>
            <?php endif; ?>
        </div>

        <div class="intersect:animate-fade-up">

            <form data-contact-form
                  data-error="<?= esc_attr__( 'Zprávu se nepodařilo odeslat. Zkuste to prosím znovu.', 'digi' ) ?>"
                  class="flex flex-col gap-5">

                <input type="hidden" name="action" value="<?= esc_attr( d1g1ContactForm::ACTION ) ?>">
                <?php wp_nonce_field( d1g1ContactForm::ACTION, 'nonce', false ); ?>

                <?php /* Honeypot — skryté pole pro roboty */ ?>
                <div class="hidden" aria-hidden="true">
                    <label>
                        <?php esc_html_e( 'Nevyplňujte', 'digi' ); ?>
                        <input type="text" name="website" tabindex="-1" autocomplete="off">
                    </label>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <label class="flex flex-col gap-2">
                        <span class="<?= esc_attr( $label_class ) ?>"><?php esc_html_e( 'Jméno', 'digi' ); ?></span>
                        <input type="text" name="name" required
                               placeholder="<?= esc_attr__( 'Jan Novák', 'digi' ) ?>"
                               class="<?= esc_attr( $field_class ) ?>">
                    </label>

                    <label class="flex flex-col gap-2">
                        <span class="<?= esc_attr( $label_class ) ?>"><?php esc_html_e( 'E-mail', 'digi' ); ?></span>
                        <input type="email" name="email" required
                               placeholder="<?= esc_attr__( 'jan@firma.cz', 'digi' ) ?>"
                               class="<?= esc_attr( $field_class ) ?>">
                    </label>
                </div>

                <label class="flex flex-col gap-2">
                    <span class="<?= esc_attr( $label_class ) ?>"><?php esc_html_e( 'Zpráva', 'digi' ); ?></span>
                    <textarea name="message" rows="5" required
                              placeholder="<?= esc_attr__( 'Stručně popište projekt nebo myšlenku…', 'digi' ) ?>"
                              class="<?= esc_attr( $field_class ) ?> resize-none"></textarea>
                </label>

                <?php if ( $consent_html ) : ?>
                    <label class="flex items-start gap-3 cursor-pointer">
                        <input type="checkbox" name="consent" value="1" required
                               class="mt-0.5 w-4 h-4 flex-shrink-0 accent-primary cursor-pointer">
                        <span class="text-sm text-muted-foreground"><?= wp_kses_post( $consent_html ) ?></span>
                    </label>
                <?php endif; ?>

                <p class="hidden text-sm text-primary" data-contact-error role="alert"></p>

                <button type="submit"
                        data-contact-submit
                        data-sending="<?= esc_attr__( 'Odesílám…', 'digi' ) ?>"
                        class="self-start inline-flex items-center gap-3 text-sm font-medium bg-primary text-primary-foreground px-7 py-3.5 hover:bg-primary/85 transition-colors disabled:opacity-60">
                    <?= esc_html( $submit_text ) ?>
                    <?= d1g1Icons::get( 'send', 'w-3.5 h-3.5' ) ?>
                </button>

            </form>

            <div class="hidden flex-col items-start gap-4 py-10" data-contact-success>
                <?= d1g1Icons::get( 'check-circle', 'w-8 h-8 text-primary' ) ?>
                <div>
                    <?php if ( $success_title ) : ?>
                        <p class="font-display text-lg font-semibold mb-1"><?= esc_html( $success_title ) ?></p>
                    <?php endif; ?>

                    <?php if ( $success_text ) : ?>
                        <p class="text-sm text-muted-foreground"><?= esc_html( $success_text ) ?></p>
                    <?php endif; ?>
                </div>
            </div>

        </div>

    </div>

</section>
