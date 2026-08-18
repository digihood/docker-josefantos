<?php
/**
 * Záložní šablona
 *
 * Web je jednostránkový a nemá blog. Tahle šablona se uplatní jen u adres,
 * na které nesedí nic konkrétnějšího — vyhledávání, archivy, kanály.
 * WordPress ji v šabloně vyžaduje, proto zůstává i bez výpisu příspěvků.
 *
 * @author Digihood
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();

get_template_part( 'parts/theme/message', null, [
    'label' => __( 'Stránka nenalezena', 'digi' ),
    'title' => __( 'Tady nic není', 'digi' ),
    'text'  => __( 'Obsah, který hledáte, na webu není. Vše podstatné najdete na úvodní stránce.', 'digi' ),
] );

get_footer();
