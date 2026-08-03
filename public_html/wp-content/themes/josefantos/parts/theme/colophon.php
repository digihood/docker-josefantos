<?php
/**
 * Zápatí — copyright vlevo, sociální sítě vpravo
 *
 * @author Digihood
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$footer_name    = get_field( 'footer_name', 'option' ) ?: get_bloginfo( 'name' );
$footer_company = get_field( 'footer_company', 'option' );
$socials        = get_field( 'socials', 'option' );
?>
<div class="container py-8 border-t border-border flex flex-col md:flex-row items-start md:items-center justify-between gap-4">

    <div class="font-mono text-xs text-muted-foreground">
        <span>&copy; <?= esc_html( date_i18n( 'Y' ) ) ?> <?= esc_html( $footer_name ) ?></span>

        <?php if ( $footer_company ) : ?>
            <span class="mx-2">&middot;</span>
            <span><?= esc_html( $footer_company ) ?></span>
        <?php endif; ?>
    </div>

    <?php if ( $socials ) : ?>
        <div class="flex items-center gap-3">
            <?php foreach ( $socials as $social ) :

                if ( empty( $social['url'] ) ) {
                    continue;
                }
                ?>
                <a href="<?= esc_url( $social['url'] ) ?>"
                   target="_blank"
                   rel="noopener noreferrer"
                   aria-label="<?= esc_attr( ucfirst( $social['network'] ) ) ?>"
                   class="w-8 h-8 flex items-center justify-center border border-border text-muted-foreground hover:border-primary hover:text-primary transition-colors">
                    <?= d1g1Icons::get( $social['network'], 'w-3.5 h-3.5' ) ?>
                </a>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

</div>
