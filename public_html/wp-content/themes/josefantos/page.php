<?php
/**
 * Šablona pro zobrazení běžných stránek
 *
 * Výchozí zobrazení odpovídá stránce s omezenou šířkou — na běžné textové
 * stránky (GDPR, obchodní podmínky) je to vhodnější než plná šířka.
 *
 * @author Digihood
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

require get_theme_file_path( '/page-templates/template-narrow.php' );
