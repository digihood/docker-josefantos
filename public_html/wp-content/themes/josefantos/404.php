<?php
/**
 * Šablona pro chybu 404
 *
 * @author Digihood
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();

get_template_part( 'parts/theme/message', null, [
    'label' => __( 'Chyba 404', 'digi' ),
    'title' => __( 'Tuhle stránku neznám', 'digi' ),
    'text'  => __( 'Adresa neexistuje nebo se změnila. Zkuste to prosím z úvodní stránky.', 'digi' ),
] );

get_footer();
