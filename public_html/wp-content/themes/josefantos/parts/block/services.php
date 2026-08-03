<?php
/**
 * Blok — Konzultační služby (rozklikávací seznam)
 *
 * @author Digihood
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$items = get_field( 'services_items' );
?>
<section id="services" class="container py-24 lg:py-32 border-t border-border">

    <?php
    get_template_part( 'parts/block/partials/section-heading', null, [
        'label' => get_field( 'services_label' ),
        'title' => get_field( 'services_title' ),
        'note'  => get_field( 'services_note' ),
    ] );
    ?>

    <?php if ( $items ) : ?>
        <div class="flex flex-col gap-3">

            <?php foreach ( $items as $index => $item ) : ?>

                <div class="intersect:animate-fade-up border border-border" data-service style="animation-delay: <?= esc_attr( $index * 80 ) ?>ms">

                    <button type="button"
                            class="w-full text-left p-7 flex items-start gap-5 group hover:bg-muted/40 transition-colors"
                            data-service-toggle
                            aria-expanded="false">

                        <span class="w-10 h-10 flex-shrink-0 border border-border flex items-center justify-center mt-0.5 group-hover:border-primary group-hover:text-primary transition-colors">
                            <?= d1g1Icons::get( $item['icon'] ?? 'monitor', 'w-4 h-4' ) ?>
                        </span>

                        <span class="flex-1 min-w-0 flex items-start justify-between gap-4">
                            <span class="block">
                                <?php if ( ! empty( $item['number'] ) ) : ?>
                                    <span class="block text-xs font-semibold text-muted-foreground tracking-widest uppercase mb-2">
                                        <?= esc_html( $item['number'] ) ?>
                                    </span>
                                <?php endif; ?>

                                <?php if ( ! empty( $item['title'] ) ) : ?>
                                    <span class="block font-display text-xl font-semibold tracking-tight mb-2">
                                        <?= esc_html( $item['title'] ) ?>
                                    </span>
                                <?php endif; ?>

                                <?php if ( ! empty( $item['brief'] ) ) : ?>
                                    <span class="block text-sm text-muted-foreground">
                                        <?= esc_html( $item['brief'] ) ?>
                                    </span>
                                <?php endif; ?>
                            </span>

                            <span class="flex-shrink-0 mt-1" data-service-icon>
                                <?= d1g1Icons::get( 'chevron-down', 'w-4 h-4 text-muted-foreground transition-transform duration-300' ) ?>
                            </span>
                        </span>

                    </button>

                    <?php if ( ! empty( $item['description'] ) || ! empty( $item['bullets'] ) || ! empty( $item['outcome'] ) ) : ?>
                        <div class="hidden" data-service-panel>
                            <div class="px-7 pb-7 md:pl-[84px] border-t border-border pt-6">

                                <?php if ( ! empty( $item['description'] ) ) : ?>
                                    <p class="text-sm text-muted-foreground mb-5 max-w-content">
                                        <?= esc_html( $item['description'] ) ?>
                                    </p>
                                <?php endif; ?>

                                <?php if ( ! empty( $item['bullets'] ) ) : ?>
                                    <ul class="space-y-2 mb-6">
                                        <?php foreach ( $item['bullets'] as $bullet ) : ?>
                                            <?php if ( ! empty( $bullet['text'] ) ) : ?>
                                                <li class="flex items-start gap-3 text-sm text-foreground">
                                                    <span class="w-1 h-1 rounded-full bg-primary flex-shrink-0 mt-[7px]"></span>
                                                    <?= esc_html( $bullet['text'] ) ?>
                                                </li>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>

                                <?php if ( ! empty( $item['outcome'] ) ) : ?>
                                    <p class="text-sm text-muted-foreground border-l-2 border-primary pl-4 italic max-w-content">
                                        <?= esc_html( $item['outcome'] ) ?>
                                    </p>
                                <?php endif; ?>

                            </div>
                        </div>
                    <?php endif; ?>

                </div>

            <?php endforeach; ?>

        </div>
    <?php endif; ?>

</section>
