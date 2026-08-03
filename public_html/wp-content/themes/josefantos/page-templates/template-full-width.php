<?php
/*
Template Name: Stránka na celou šířku
*/

/**
 * Šablona pro stránky složené z ACF bloků.
 * Bloky si container i odsazení řeší samy, obsah proto nic neobaluje.
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
