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
    'title'         => __( 'Konzultační služby', 'jos' ),
    'description'   => __( 'Rozklikávací seznam služeb', 'jos' ),
    'icon'          => 'list-view',
    'keywords'      => [ 'sluzby', 'konzultace', 'accordion' ],
    'preview_field' => 'services_title',
    'fields'        => [
        [
            'key'   => 'field_services_label',
            'label' => __( 'Popisek nad nadpisem', 'jos' ),
            'name'  => 'services_label',
            'type'  => 'text',
        ],
        [
            'key'   => 'field_services_title',
            'label' => __( 'Nadpis sekce', 'jos' ),
            'name'  => 'services_title',
            'type'  => 'text',
        ],
        [
            'key'   => 'field_services_note',
            'label' => __( 'Poznámka vpravo', 'jos' ),
            'name'  => 'services_note',
            'type'  => 'text',
        ],
        [
            'key'          => 'field_services_items',
            'label'        => __( 'Služby', 'jos' ),
            'name'         => 'services_items',
            'type'         => 'repeater',
            'layout'       => 'block',
            'button_label' => __( 'Přidat službu', 'jos' ),
            'sub_fields'   => [
                [
                    'key'          => 'field_services_item_number',
                    'label'        => __( 'Pořadové číslo', 'jos' ),
                    'name'         => 'number',
                    'type'         => 'text',
                    'placeholder'  => '01',
                ],
                [
                    'key'           => 'field_services_item_icon',
                    'label'         => __( 'Ikona', 'jos' ),
                    'name'          => 'icon',
                    'type'          => 'select',
                    'choices'       => [
                        'monitor'   => __( 'Monitor', 'jos' ),
                        'zap'       => __( 'Blesk', 'jos' ),
                        'trending'  => __( 'Růst', 'jos' ),
                    ],
                    'default_value' => 'monitor',
                ],
                [
                    'key'   => 'field_services_item_title',
                    'label' => __( 'Název služby', 'jos' ),
                    'name'  => 'title',
                    'type'  => 'text',
                ],
                [
                    'key'   => 'field_services_item_brief',
                    'label' => __( 'Krátký popis (vždy viditelný)', 'jos' ),
                    'name'  => 'brief',
                    'type'  => 'textarea',
                    'rows'  => 3,
                ],
                [
                    'key'   => 'field_services_item_description',
                    'label' => __( 'Rozšířený popis', 'jos' ),
                    'name'  => 'description',
                    'type'  => 'textarea',
                    'rows'  => 4,
                ],
                [
                    'key'          => 'field_services_item_bullets',
                    'label'        => __( 'Odrážky', 'jos' ),
                    'name'         => 'bullets',
                    'type'         => 'repeater',
                    'layout'       => 'table',
                    'button_label' => __( 'Přidat odrážku', 'jos' ),
                    'sub_fields'   => [
                        [
                            'key'   => 'field_services_item_bullet_text',
                            'label' => __( 'Text', 'jos' ),
                            'name'  => 'text',
                            'type'  => 'text',
                        ],
                    ],
                ],
                [
                    'key'   => 'field_services_item_outcome',
                    'label' => __( 'Výstup / shrnutí', 'jos' ),
                    'name'  => 'outcome',
                    'type'  => 'textarea',
                    'rows'  => 3,
                ],
            ],
        ],
    ],
];
