<?php
/**
 * Blok — Hero
 *
 * @author Digihood
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$badge       = get_field( 'hero_badge' );
$prefix      = get_field( 'hero_prefix' );
$name_first  = get_field( 'hero_name_first' );
$name_second = get_field( 'hero_name_second' );
$perex       = get_field( 'hero_perex' );
$brands      = get_field( 'hero_brands' );
$cta_text    = get_field( 'hero_cta_text' );
$cta_anchor  = get_field( 'hero_cta_anchor' );
?>
<section id="hero" class="container min-h-screen flex flex-col justify-end pb-16 pt-28">

    <?php if ( $badge ) : ?>
        <div class="intersect:animate-fade-up mb-14">
            <span class="inline-block text-xs font-semibold tracking-widest uppercase px-3 py-1.5 border border-primary text-primary">
                <?= esc_html( $badge ) ?>
            </span>
        </div>
    <?php endif; ?>

    <?php if ( $name_first || $name_second ) : ?>
        <h1 class="intersect:animate-fade-up">
            <?php if ( $prefix ) : ?>
                <span class="block font-mono text-[clamp(12px,1.4vw,20px)] font-normal text-muted-foreground tracking-wider uppercase mb-2 leading-none">
                    <?= esc_html( $prefix ) ?>
                </span>
            <?php endif; ?>

            <?php if ( $name_first ) : ?>
                <span class="block"><?= esc_html( $name_first ) ?></span>
            <?php endif; ?>

            <?php if ( $name_second ) : ?>
                <span class="block"><?= esc_html( $name_second ) ?></span>
            <?php endif; ?>
        </h1>
    <?php endif; ?>

    <?php if ( $perex || $brands || $cta_text ) : ?>
        <div class="intersect:animate-fade-up flex flex-col md:flex-row md:items-end justify-between gap-8 border-t border-border pt-8 mt-10">

            <?php if ( $perex ) : ?>
                <div class="max-w-content text-lg md:text-xl text-muted-foreground [&_p]:text-lg [&_p:last-child]:mb-0 md:[&_p]:text-xl [&_strong]:text-foreground [&_strong]:font-normal [&_em]:not-italic [&_em]:text-primary [&_em]:font-semibold">
                    <?= wp_kses_post( $perex ) ?>
                </div>
            <?php endif; ?>

            <div class="flex items-center gap-6 flex-shrink-0">

                <?php if ( $brands ) : ?>
                    <div class="text-right hidden lg:block">
                        <?php foreach ( $brands as $brand ) : ?>
                            <?php if ( ! empty( $brand['name'] ) ) : ?>
                                <div class="font-mono text-xs text-muted-foreground"><?= esc_html( $brand['name'] ) ?></div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                    <div class="w-px h-8 bg-border hidden lg:block"></div>
                <?php endif; ?>

                <?php if ( $cta_text ) : ?>
                    <a href="<?= esc_url( $cta_anchor ?: '#focus' ) ?>"
                       class="group flex items-center gap-2 text-sm font-medium hover:text-primary transition-colors">
                        <?= esc_html( $cta_text ) ?>
                        <?= d1g1Icons::get( 'arrow-up-right', 'w-4 h-4 transition-transform group-hover:translate-x-0.5 group-hover:-translate-y-0.5' ) ?>
                    </a>
                <?php endif; ?>

            </div>

        </div>
    <?php endif; ?>

</section>
