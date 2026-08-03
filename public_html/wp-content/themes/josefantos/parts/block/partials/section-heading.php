<?php
/**
 * Hlavička sekce — popisek, nadpis a volitelná poznámka vpravo
 *
 * @param string $args['label'] Popisek nad nadpisem
 * @param string $args['title'] Nadpis sekce
 * @param string $args['note']  Poznámka zarovnaná vpravo
 *
 * @author Digihood
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$label = $args['label'] ?? '';
$title = $args['title'] ?? '';
$note  = $args['note'] ?? '';

if ( ! $label && ! $title ) {
    return;
}
?>
<div class="intersect:animate-fade-up flex items-end justify-between gap-8 mb-14 pb-6 border-b border-border">

    <div>
        <?php if ( $label ) : ?>
            <span class="block text-xs font-semibold text-muted-foreground tracking-widest uppercase">
                <?= esc_html( $label ) ?>
            </span>
        <?php endif; ?>

        <?php if ( $title ) : ?>
            <h2 class="mt-2"><?= esc_html( $title ) ?></h2>
        <?php endif; ?>
    </div>

    <?php if ( $note ) : ?>
        <p class="hidden md:block text-sm text-muted-foreground max-w-xs text-right">
            <?= esc_html( $note ) ?>
        </p>
    <?php endif; ?>

</div>
