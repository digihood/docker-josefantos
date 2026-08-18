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
            'key'           => 'field_contact_form',
            'label'         => __( 'Formulář', 'digi' ),
            'name'          => 'contact_form',
            'type'          => 'post_object',
            'post_type'     => [ 'wpcf7_contact_form' ],
            'return_format' => 'object',
            'ui'            => 1,
            'instructions'  => __( 'Formulář z Contact Form 7. Pole, texty tlačítka i příjemce se nastavují v administraci pluginu.', 'digi' ),
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
    ],
];
