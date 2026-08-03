<?php
/**
 * Blok — Čemu se věnuji
 *
 * @author Digihood
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$cards = get_field( 'focus_cards' );
?>
<section id="focus" class="container py-24 lg:py-32">

    <?php
    get_template_part( 'parts/block/partials/section-heading', null, [
        'label' => get_field( 'focus_label' ),
        'title' => get_field( 'focus_title' ),
    ] );
    ?>

    <?php if ( $cards ) : ?>
        <div class="grid grid-cols-1 md:grid-cols-5 gap-8">

            <?php foreach ( $cards as $index => $card ) :

                $span        = ( ( $card['width'] ?? '3' ) === '2' ) ? 'md:col-span-2' : 'md:col-span-3';
                $brand_style = ( ( $card['brand_style'] ?? 'filled' ) === 'outline' )
                    ? 'border border-foreground'
                    : 'bg-primary text-primary-foreground';
                ?>
                <div class="intersect:animate-fade-up <?= esc_attr( $span ) ?>" style="animation-delay: <?= esc_attr( $index * 80 ) ?>ms">
                    <div class="h-full border border-border p-8 lg:p-10 flex flex-col justify-between group hover:border-primary transition-colors duration-300">

                        <div>
                            <?php if ( ! empty( $card['label'] ) ) : ?>
                                <div class="flex items-start justify-between mb-8">
                                    <span class="text-xs font-semibold text-muted-foreground tracking-widest uppercase">
                                        <?= esc_html( $card['label'] ) ?>
                                    </span>
                                    <?= d1g1Icons::get( 'arrow-up-right', 'w-4 h-4 text-muted-foreground group-hover:text-primary transition-colors' ) ?>
                                </div>
                            <?php endif; ?>

                            <?php if ( ! empty( $card['brand'] ) ) : ?>
                                <div class="inline-block font-display font-bold text-2xl px-3 py-1 mb-4 <?= esc_attr( $brand_style ) ?>">
                                    <?= esc_html( $card['brand'] ) ?>
                                </div>
                            <?php endif; ?>

                            <?php if ( ! empty( $card['title'] ) ) : ?>
                                <h3 class="mb-4"><?= esc_html( $card['title'] ) ?></h3>
                            <?php endif; ?>

                            <?php if ( ! empty( $card['text'] ) ) : ?>
                                <p class="text-muted-foreground max-w-content mb-6"><?= esc_html( $card['text'] ) ?></p>
                            <?php endif; ?>
                        </div>

                        <?php if ( ! empty( $card['tags'] ) ) : ?>
                            <div class="flex flex-wrap gap-2 pt-6 border-t border-border">
                                <?php foreach ( $card['tags'] as $tag ) : ?>
                                    <?php if ( ! empty( $tag['name'] ) ) : ?>
                                        <span class="font-mono text-2xs px-2.5 py-1 bg-muted text-muted-foreground tracking-wide">
                                            <?= esc_html( $tag['name'] ) ?>
                                        </span>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>

                    </div>
                </div>
            <?php endforeach; ?>

        </div>
    <?php endif; ?>

</section>
