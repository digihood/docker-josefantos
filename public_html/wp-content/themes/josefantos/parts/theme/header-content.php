<?php
/**
 * Záhlaví — fixní lišta, na scrollu dostane pozadí a spodní linku
 *
 * @author Digihood
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$brand      = get_field( 'brand', 'option' ) ?: get_bloginfo( 'name' );
$cta_text   = get_field( 'header_cta_text', 'option' );
$cta_anchor = get_field( 'header_cta_anchor', 'option' );
?>
<header id="header-content"
        class="fixed top-0 left-0 right-0 z-50 transition-all duration-500 border-b border-transparent [.admin-bar_&]:top-8"
        itemscope itemtype="http://schema.org/WPHeader">

    <div class="container h-16 flex items-center justify-between">

        <a href="<?= esc_url( home_url( '/' ) ) ?>"
           class="font-display text-sm font-semibold tracking-tight hover:text-primary transition-colors">
            <?= esc_html( $brand ) ?>
        </a>

        <nav class="hidden md:flex items-center gap-8
                    [&_ul]:flex [&_ul]:items-center [&_ul]:gap-8
                    [&_ul_a]:text-sm [&_ul_a]:text-muted-foreground [&_ul_a]:transition-colors
                    [&_ul_a:hover]:text-foreground
                    [&_ul_.active>a]:text-foreground">

            <?php do_action( 'd1g1_menu_top' ); ?>

            <?php if ( $cta_text ) : ?>
                <a href="<?= esc_url( $cta_anchor ?: '#contact' ) ?>"
                   class="text-sm px-5 py-2 bg-primary text-primary-foreground hover:bg-primary/85 transition-colors">
                    <?= esc_html( $cta_text ) ?>
                </a>
            <?php endif; ?>

        </nav>

        <button type="button"
                class="md:hidden p-1"
                data-menu-toggle
                aria-controls="mobile-menu"
                aria-expanded="false"
                aria-label="<?= esc_attr__( 'Otevřít menu', 'digi' ) ?>">
            <span data-menu-icon="open"><?= d1g1Icons::get( 'menu', 'w-5 h-5' ) ?></span>
            <span data-menu-icon="close" class="hidden"><?= d1g1Icons::get( 'x', 'w-5 h-5' ) ?></span>
        </button>

    </div>

</header>
