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
    'label' => __( 'Chyba 404', 'jos' ),
    'title' => __( 'Tuhle stránku neznám', 'jos' ),
    'text'  => __( 'Adresa neexistuje nebo se změnila. Zkuste to prosím z úvodní stránky.', 'jos' ),
] );

get_footer();
