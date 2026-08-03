<?php
/**
 * ACF blok — Konzultační služby (rozklikávací seznam)
 *
 * @author Digihood
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

return [
    'name'          => 'services',
    'title'         => __( 'Konzultační služby', 'digi' ),
    'description'   => __( 'Rozklikávací seznam služeb', 'digi' ),
    'icon'          => 'list-view',
    'keywords'      => [ 'sluzby', 'konzultace', 'accordion' ],
    'preview_field' => 'services_title',
    'fields'        => [
        [
            'key'   => 'field_services_label',
            'label' => __( 'Popisek nad nadpisem', 'digi' ),
            'name'  => 'services_label',
            'type'  => 'text',
        ],
        [
            'key'   => 'field_services_title',
            'label' => __( 'Nadpis sekce', 'digi' ),
            'name'  => 'services_title',
            'type'  => 'text',
        ],
        [
            'key'   => 'field_services_note',
            'label' => __( 'Poznámka vpravo', 'digi' ),
            'name'  => 'services_note',
            'type'  => 'text',
        ],
        [
            'key'          => 'field_services_items',
            'label'        => __( 'Služby', 'digi' ),
            'name'         => 'services_items',
            'type'         => 'repeater',
            'layout'       => 'block',
            'button_label' => __( 'Přidat službu', 'digi' ),
            'sub_fields'   => [
                [
                    'key'          => 'field_services_item_number',
                    'label'        => __( 'Pořadové číslo', 'digi' ),
                    'name'         => 'number',
                    'type'         => 'text',
                    'placeholder'  => '01',
                ],
                [
                    'key'           => 'field_services_item_icon',
                    'label'         => __( 'Ikona', 'digi' ),
                    'name'          => 'icon',
                    'type'          => 'select',
                    'choices'       => [
                        'monitor'   => __( 'Monitor', 'digi' ),
                        'zap'       => __( 'Blesk', 'digi' ),
                        'trending'  => __( 'Růst', 'digi' ),
                    ],
                    'default_value' => 'monitor',
                ],
                [
                    'key'   => 'field_services_item_title',
                    'label' => __( 'Název služby', 'digi' ),
                    'name'  => 'title',
                    'type'  => 'text',
                ],
                [
                    'key'   => 'field_services_item_brief',
                    'label' => __( 'Krátký popis (vždy viditelný)', 'digi' ),
                    'name'  => 'brief',
                    'type'  => 'textarea',
                    'rows'  => 3,
                ],
                [
                    'key'   => 'field_services_item_description',
                    'label' => __( 'Rozšířený popis', 'digi' ),
                    'name'  => 'description',
                    'type'  => 'textarea',
                    'rows'  => 4,
                ],
                [
                    'key'          => 'field_services_item_bullets',
                    'label'        => __( 'Odrážky', 'digi' ),
                    'name'         => 'bullets',
                    'type'         => 'repeater',
                    'layout'       => 'table',
                    'button_label' => __( 'Přidat odrážku', 'digi' ),
                    'sub_fields'   => [
                        [
                            'key'   => 'field_services_item_bullet_text',
                            'label' => __( 'Text', 'digi' ),
                            'name'  => 'text',
                            'type'  => 'text',
                        ],
                    ],
                ],
                [
                    'key'   => 'field_services_item_outcome',
                    'label' => __( 'Výstup / shrnutí', 'digi' ),
                    'name'  => 'outcome',
                    'type'  => 'textarea',
                    'rows'  => 3,
                ],
            ],
        ],
    ],
];
