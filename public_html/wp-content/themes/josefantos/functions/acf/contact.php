<?php
/**
 * ACF blok — Kontakt (nadpis + formulář)
 *
 * @author Digihood
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

return [
    'name'          => 'contact',
    'title'         => __( 'Kontakt', 'digi' ),
    'description'   => __( 'Kontaktní sekce s formulářem', 'digi' ),
    'icon'          => 'email',
    'keywords'      => [ 'kontakt', 'formular' ],
    'preview_field' => 'contact_title',
    'fields'        => [
        [
            'key'   => 'field_contact_label',
            'label' => __( 'Popisek nad nadpisem', 'digi' ),
            'name'  => 'contact_label',
            'type'  => 'text',
        ],
        [
            'key'          => 'field_contact_title',
            'label'        => __( 'Nadpis', 'digi' ),
            'name'         => 'contact_title',
            'type'         => 'textarea',
            'rows'         => 3,
            'instructions' => __( 'Každý řádek se zalomí. Slovo obalené do * bude zvýrazněno barvou — např. Pojďme\n*mluvit*\no vašem\nprojektu.', 'digi' ),
        ],
        [
            'key'   => 'field_contact_submit_text',
            'label' => __( 'Text tlačítka', 'digi' ),
            'name'  => 'contact_submit_text',
            'type'  => 'text',
        ],
        [
            'key'   => 'field_contact_success_title',
            'label' => __( 'Nadpis po odeslání', 'digi' ),
            'name'  => 'contact_success_title',
            'type'  => 'text',
        ],
        [
            'key'   => 'field_contact_success_text',
            'label' => __( 'Text po odeslání', 'digi' ),
            'name'  => 'contact_success_text',
            'type'  => 'text',
        ],
        [
            'key'          => 'field_contact_consent',
            'label'        => __( 'Text souhlasu', 'digi' ),
            'name'         => 'contact_consent',
            'type'         => 'textarea',
            'rows'         => 2,
            'instructions' => __( 'Text obalený do [odkaz]…[/odkaz] se propojí na stránku zásad ochrany osobních údajů.', 'digi' ),
        ],
        [
            'key'          => 'field_contact_recipient',
            'label'        => __( 'E-mail příjemce', 'digi' ),
            'name'         => 'contact_recipient',
            'type'         => 'email',
            'instructions' => __( 'Kam se odesílají zprávy z formuláře. Prázdné = e-mail administrátora webu.', 'digi' ),
        ],
    ],
];
