<?php
/**
 * Šablona pro zobrazení domácí stránky
 *
 * Domácí stránka je složená z ACF bloků, které si container řeší samy.
 *
 * @author Digihood
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();

if ( have_posts() ) :
    while ( have_posts() ) : the_post();

        the_content();

    endwhile;
endif;

get_footer();
