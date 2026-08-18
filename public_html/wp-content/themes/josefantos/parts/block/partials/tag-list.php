<?php
/**
 * Seznam štítků — s odkazem se vykreslí jako <a>, bez odkazu jako <span>
 *
 * @param array  $args['tags']    Pole položek s klíči name a url
 * @param string $args['variant'] chip = malý mono štítek v kartě, outline = orámovaný štítek
 *
 * @author Digihood
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$tags    = $args['tags'] ?? [];
$variant = $args['variant'] ?? 'chip';

if ( ! $tags ) {
    return;
}

$base = ( $variant === 'outline' )
    ? 'text-sm px-3 py-1.5 border border-border text-foreground transition-colors'
    : 'font-mono text-2xs px-2.5 py-1 bg-muted text-muted-foreground tracking-wide transition-colors';

$hover = ( $variant === 'outline' )
    ? 'hover:border-primary hover:text-primary'
    : 'hover:bg-primary hover:text-primary-foreground';
?>
<div class="flex flex-wrap gap-2">

    <?php foreach ( $tags as $tag ) :

        if ( empty( $tag['name'] ) ) {
            continue;
        }

        $url = $tag['url'] ?? '';
        ?>
        <?php if ( $url ) : ?>
            <a href="<?= esc_url( $url ) ?>"
               target="_blank"
               rel="noopener noreferrer"
               class="<?= esc_attr( $base . ' ' . $hover ) ?>">
                <?= esc_html( $tag['name'] ) ?>
            </a>
        <?php else : ?>
            <span class="<?= esc_attr( $base ) ?> cursor-default">
                <?= esc_html( $tag['name'] ) ?>
            </span>
        <?php endif; ?>

    <?php endforeach; ?>

</div>
