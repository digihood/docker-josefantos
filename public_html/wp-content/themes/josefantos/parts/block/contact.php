<?php
/**
 * Blok — Kontakt
 *
 * Formulář obsluhuje Contact Form 7, vzhled polí je ve style.css (.contact-form).
 * Po odeslání se formulář skryje a místo něj se ukáže potvrzení (app.js).
 *
 * @author Digihood
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$label         = get_field( 'contact_label' );
$title         = get_field( 'contact_title' );
$form          = get_field( 'contact_form' );
$success_title = get_field( 'contact_success_title' );
$success_text  = get_field( 'contact_success_text' );

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
?>
<section id="contact" class="container py-24 lg:py-36 border-t border-border">

    <div class="grid grid-cols-1 md:grid-cols-2 gap-16 lg:gap-28 items-start">

        <div class="intersect:animate-fade-up intersect-once">
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

        <div class="intersect:animate-fade-up intersect-once">

            <?php if ( $form ) : ?>
                <div class="contact-form" data-contact-form>
                    <?= do_shortcode( '[contact-form-7 id="' . absint( $form->ID ) . '"]' ) ?>
                </div>
            <?php endif; ?>

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
