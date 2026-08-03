<?php
/**
 * Blok — O mně
 *
 * @author Digihood
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$photo      = get_field( 'about_photo' );
$label      = get_field( 'about_label' );
$title      = get_field( 'about_title' );
$text       = get_field( 'about_text' );
$skills     = get_field( 'about_skills' );
$activities = get_field( 'about_activities' );
?>
<section id="about" class="container py-24 lg:py-32 border-t border-border">

    <div class="grid grid-cols-1 md:grid-cols-[1fr_2fr] gap-10 lg:gap-14">

        <?php if ( $photo ) : ?>
            <div class="intersect:animate-fade-up">
                <div class="aspect-[3/4] overflow-hidden">
                    <?= wp_get_attachment_image( $photo, 'large', false, [
                        'class'   => 'w-full h-full object-cover object-[center_8%]',
                        'loading' => 'lazy',
                    ] ) ?>
                </div>
                <div class="h-1 bg-primary w-16 mt-4"></div>
            </div>
        <?php endif; ?>

        <div class="intersect:animate-fade-up flex flex-col gap-10">

            <div>
                <?php if ( $label ) : ?>
                    <span class="block text-xs font-semibold text-muted-foreground tracking-widest uppercase">
                        <?= esc_html( $label ) ?>
                    </span>
                <?php endif; ?>

                <?php if ( $title ) : ?>
                    <h2 class="mt-3 mb-8"><?= nl2br( esc_html( $title ) ) ?></h2>
                <?php endif; ?>

                <?php if ( $text ) : ?>
                    <div class="max-w-content text-muted-foreground [&_p]:mb-5 [&_p:last-child]:mb-0 [&_strong]:text-foreground [&_strong]:font-medium">
                        <?= wp_kses_post( $text ) ?>
                    </div>
                <?php endif; ?>
            </div>

            <?php if ( $skills || $activities ) : ?>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-10 pt-8 border-t border-border">

                    <?php if ( $skills ) : ?>
                        <div>
                            <?php if ( get_field( 'about_skills_label' ) ) : ?>
                                <span class="block text-xs font-semibold text-muted-foreground tracking-widest uppercase mb-5">
                                    <?= esc_html( get_field( 'about_skills_label' ) ) ?>
                                </span>
                            <?php endif; ?>

                            <div class="flex flex-wrap gap-2">
                                <?php foreach ( $skills as $skill ) : ?>
                                    <?php if ( ! empty( $skill['name'] ) ) : ?>
                                        <span class="text-sm px-3 py-1.5 border border-border text-foreground hover:border-primary hover:text-primary transition-colors cursor-default">
                                            <?= esc_html( $skill['name'] ) ?>
                                        </span>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if ( $activities ) : ?>
                        <div>
                            <?php if ( get_field( 'about_activities_label' ) ) : ?>
                                <span class="block text-xs font-semibold text-muted-foreground tracking-widest uppercase mb-5">
                                    <?= esc_html( get_field( 'about_activities_label' ) ) ?>
                                </span>
                            <?php endif; ?>

                            <div>
                                <?php
                                $last = count( $activities ) - 1;
                                foreach ( $activities as $index => $activity ) :

                                    if ( empty( $activity['name'] ) ) {
                                        continue;
                                    }
                                    ?>
                                    <div class="flex items-center justify-between gap-4 py-4 <?= $index < $last ? 'border-b border-border' : '' ?>">
                                        <span class="text-sm font-medium text-foreground"><?= esc_html( $activity['name'] ) ?></span>

                                        <?php if ( ! empty( $activity['note'] ) ) : ?>
                                            <span class="text-sm text-muted-foreground text-right"><?= esc_html( $activity['note'] ) ?></span>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                </div>
            <?php endif; ?>

        </div>

    </div>

</section>
