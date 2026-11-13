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
    'title'         => __( 'Čemu se věnuji', 'jos' ),
    'description'   => __( 'Sekce s kartami značek', 'jos' ),
    'icon'          => 'grid-view',
    'keywords'      => [ 'focus', 'zamereni', 'znacky' ],
    'preview_field' => 'focus_title',
    'fields'        => [
        [
            'key'   => 'field_focus_label',
            'label' => __( 'Popisek nad nadpisem', 'jos' ),
            'name'  => 'focus_label',
            'type'  => 'text',
        ],
        [
            'key'   => 'field_focus_title',
            'label' => __( 'Nadpis sekce', 'jos' ),
            'name'  => 'focus_title',
            'type'  => 'text',
        ],
        [
            'key'          => 'field_focus_cards',
            'label'        => __( 'Karty', 'jos' ),
            'name'         => 'focus_cards',
            'type'         => 'repeater',
            'layout'       => 'block',
            'button_label' => __( 'Přidat kartu', 'jos' ),
            'sub_fields'   => [
                [
                    'key'   => 'field_focus_card_label',
                    'label' => __( 'Popisek', 'jos' ),
                    'name'  => 'label',
                    'type'  => 'text',
                ],
                [
                    'key'   => 'field_focus_card_brand',
                    'label' => __( 'Název značky', 'jos' ),
                    'name'  => 'brand',
                    'type'  => 'text',
                ],
                [
                    'key'           => 'field_focus_card_brand_style',
                    'label'         => __( 'Styl značky', 'jos' ),
                    'name'          => 'brand_style',
                    'type'          => 'select',
                    'choices'       => [
                        'filled'  => __( 'Vyplněná (primární barva)', 'jos' ),
                        'outline' => __( 'Orámovaná', 'jos' ),
                    ],
                    'default_value' => 'filled',
                ],
                [
                    'key'   => 'field_focus_card_title',
                    'label' => __( 'Nadpis karty', 'jos' ),
                    'name'  => 'title',
                    'type'  => 'text',
                ],
                [
                    'key'   => 'field_focus_card_text',
                    'label' => __( 'Text', 'jos' ),
                    'name'  => 'text',
                    'type'  => 'textarea',
                    'rows'  => 5,
                ],
                [
                    'key'           => 'field_focus_card_width',
                    'label'         => __( 'Šířka karty', 'jos' ),
                    'name'          => 'width',
                    'type'          => 'select',
                    'choices'       => [
                        '3' => __( 'Širší (3/5)', 'jos' ),
                        '2' => __( 'Užší (2/5)', 'jos' ),
                    ],
                    'default_value' => '3',
                ],
                [
                    'key'          => 'field_focus_card_tags',
                    'label'        => __( 'Štítky', 'jos' ),
                    'name'         => 'tags',
                    'type'         => 'repeater',
                    'layout'       => 'table',
                    'button_label' => __( 'Přidat štítek', 'jos' ),
                    'sub_fields'   => [
                        [
                            'key'   => 'field_focus_card_tag_name',
                            'label' => __( 'Štítek', 'jos' ),
                            'name'  => 'name',
                            'type'  => 'text',
                        ],
                        [
                            'key'          => 'field_focus_card_tag_url',
                            'label'        => __( 'Odkaz', 'jos' ),
                            'name'         => 'url',
                            'type'         => 'url',
                            'instructions' => __( 'Prázdné = štítek bez odkazu.', 'jos' ),
                        ],
                    ],
                ],
            ],
        ],
    ],
];
