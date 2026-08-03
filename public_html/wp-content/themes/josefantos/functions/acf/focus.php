<?php
/**
 * ACF blok — Čemu se věnuji (karty značek)
 *
 * @author Digihood
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

return [
    'name'          => 'focus',
    'title'         => __( 'Čemu se věnuji', 'digi' ),
    'description'   => __( 'Sekce s kartami značek', 'digi' ),
    'icon'          => 'grid-view',
    'keywords'      => [ 'focus', 'zamereni', 'znacky' ],
    'preview_field' => 'focus_title',
    'fields'        => [
        [
            'key'   => 'field_focus_label',
            'label' => __( 'Popisek nad nadpisem', 'digi' ),
            'name'  => 'focus_label',
            'type'  => 'text',
        ],
        [
            'key'   => 'field_focus_title',
            'label' => __( 'Nadpis sekce', 'digi' ),
            'name'  => 'focus_title',
            'type'  => 'text',
        ],
        [
            'key'          => 'field_focus_cards',
            'label'        => __( 'Karty', 'digi' ),
            'name'         => 'focus_cards',
            'type'         => 'repeater',
            'layout'       => 'block',
            'button_label' => __( 'Přidat kartu', 'digi' ),
            'sub_fields'   => [
                [
                    'key'   => 'field_focus_card_label',
                    'label' => __( 'Popisek', 'digi' ),
                    'name'  => 'label',
                    'type'  => 'text',
                ],
                [
                    'key'   => 'field_focus_card_brand',
                    'label' => __( 'Název značky', 'digi' ),
                    'name'  => 'brand',
                    'type'  => 'text',
                ],
                [
                    'key'           => 'field_focus_card_brand_style',
                    'label'         => __( 'Styl značky', 'digi' ),
                    'name'          => 'brand_style',
                    'type'          => 'select',
                    'choices'       => [
                        'filled'  => __( 'Vyplněná (primární barva)', 'digi' ),
                        'outline' => __( 'Orámovaná', 'digi' ),
                    ],
                    'default_value' => 'filled',
                ],
                [
                    'key'   => 'field_focus_card_title',
                    'label' => __( 'Nadpis karty', 'digi' ),
                    'name'  => 'title',
                    'type'  => 'text',
                ],
                [
                    'key'   => 'field_focus_card_text',
                    'label' => __( 'Text', 'digi' ),
                    'name'  => 'text',
                    'type'  => 'textarea',
                    'rows'  => 5,
                ],
                [
                    'key'           => 'field_focus_card_width',
                    'label'         => __( 'Šířka karty', 'digi' ),
                    'name'          => 'width',
                    'type'          => 'select',
                    'choices'       => [
                        '3' => __( 'Širší (3/5)', 'digi' ),
                        '2' => __( 'Užší (2/5)', 'digi' ),
                    ],
                    'default_value' => '3',
                ],
                [
                    'key'          => 'field_focus_card_tags',
                    'label'        => __( 'Štítky', 'digi' ),
                    'name'         => 'tags',
                    'type'         => 'repeater',
                    'layout'       => 'table',
                    'button_label' => __( 'Přidat štítek', 'digi' ),
                    'sub_fields'   => [
                        [
                            'key'   => 'field_focus_card_tag_name',
                            'label' => __( 'Štítek', 'digi' ),
                            'name'  => 'name',
                            'type'  => 'text',
                        ],
                    ],
                ],
            ],
        ],
    ],
];
