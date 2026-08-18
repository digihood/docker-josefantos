<?php
/**
 * Jednoduchá stránka se zprávou a odkazem na úvod
 *
 * @param string $args['label'] Popisek nad nadpisem
 * @param string $args['title'] Nadpis
 * @param string $args['text']  Text pod nadpisem
 *
 * @author Digihood
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$label = $args['label'] ?? '';
$title = $args['title'] ?? '';
$text  = $args['text'] ?? '';
?>
<section class="container pt-32 pb-24 lg:pb-32">

    <div class="max-w-3xl">

        <?php if ( $label ) : ?>
            <span class="block text-xs font-semibold text-muted-foreground tracking-widest uppercase">
                <?= esc_html( $label ) ?>
            </span>
        <?php endif; ?>

        <?php if ( $title ) : ?>
            <h1 class="h2 mt-3 mb-6"><?= esc_html( $title ) ?></h1>
        <?php endif; ?>

        <?php if ( $text ) : ?>
            <p class="text-muted-foreground mb-10 max-w-content"><?= esc_html( $text ) ?></p>
        <?php endif; ?>

        <a href="<?= esc_url( home_url( '/' ) ) ?>"
           class="inline-flex items-center gap-3 text-sm font-medium bg-primary text-primary-foreground px-7 py-3.5 hover:bg-primary/85 transition-colors">
            <?php esc_html_e( 'Zpět na úvodní stránku', 'digi' ); ?>
            <?= d1g1Icons::get( 'arrow-up-right', 'w-3.5 h-3.5' ) ?>
        </a>

    </div>

</section>
