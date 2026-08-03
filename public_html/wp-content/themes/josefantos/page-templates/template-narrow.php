<?php
/*
Template Name: Stránka s omezenou šířkou
*/

/**
 * Šablona pro textové stránky typu GDPR nebo Obchodní podmínky.
 * Obsah je omezený na čtecí šířku, protože jde o dlouhý souvislý text.
 *
 * @author Digihood
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();
?>

<article class="container pt-32 pb-24 lg:pb-32">

    <div class="max-w-3xl">

        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

            <header class="pb-6 mb-10 border-b border-border">
                <h1 class="h2"><?php the_title(); ?></h1>
            </header>

            <div class="entry-content text-muted-foreground
                        [&_p]:mb-5
                        [&_h2]:text-foreground [&_h2]:mt-12 [&_h2]:mb-4
                        [&_h3]:text-foreground [&_h3]:mt-8 [&_h3]:mb-3
                        [&_strong]:text-foreground [&_strong]:font-medium
                        [&_a]:text-primary [&_a]:underline [&_a]:underline-offset-2
                        [&_ul]:list-disc [&_ul]:pl-5 [&_ul]:mb-5 [&_ul]:space-y-2
                        [&_ol]:list-decimal [&_ol]:pl-5 [&_ol]:mb-5 [&_ol]:space-y-2
                        [&_table]:w-full [&_table]:mb-5
                        [&_td]:border [&_td]:border-border [&_td]:p-2
                        [&_th]:border [&_th]:border-border [&_th]:p-2 [&_th]:text-foreground">
                <?php the_content(); ?>
            </div>

        <?php endwhile; endif; ?>

    </div>

</article>

<?php
get_footer();
