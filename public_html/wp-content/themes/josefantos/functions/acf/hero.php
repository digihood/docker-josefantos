<?php
/**
 * ACF blok — Hero (úvodní sekce)
 *
 * @author Digihood
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

return [
    'name'          => 'hero',
    'title'         => __( 'Hero', 'digi' ),
    'description'   => __( 'Úvodní sekce se jménem a claimem', 'digi' ),
    'icon'          => 'cover-image',
    'keywords'      => [ 'hero', 'uvod', 'jmeno' ],
    'preview_field' => 'hero_name_first',
    'fields'        => [
        [
            'key'   => 'field_hero_badge',
            'label' => __( 'Odznak nad jménem', 'digi' ),
            'name'  => 'hero_badge',
            'type'  => 'text',
        ],
        [
            'key'   => 'field_hero_prefix',
            'label' => __( 'Titul před jménem', 'digi' ),
            'name'  => 'hero_prefix',
            'type'  => 'text',
        ],
        [
            'key'   => 'field_hero_name_first',
            'label' => __( 'Jméno — první řádek', 'digi' ),
            'name'  => 'hero_name_first',
            'type'  => 'text',
        ],
        [
            'key'   => 'field_hero_name_second',
            'label' => __( 'Jméno — druhý řádek', 'digi' ),
            'name'  => 'hero_name_second',
            'type'  => 'text',
        ],
        [
            'key'          => 'field_hero_perex',
            'label'        => __( 'Perex', 'digi' ),
            'name'         => 'hero_perex',
            'type'         => 'wysiwyg',
            'tabs'         => 'visual',
            'toolbar'      => 'basic',
            'media_upload' => 0,
        ],
        [
            'key'          => 'field_hero_brands',
            'label'        => __( 'Značky', 'digi' ),
            'name'         => 'hero_brands',
            'type'         => 'repeater',
            'layout'       => 'table',
            'button_label' => __( 'Přidat značku', 'digi' ),
            'sub_fields'   => [
                [
                    'key'   => 'field_hero_brand_name',
                    'label' => __( 'Název', 'digi' ),
                    'name'  => 'name',
                    'type'  => 'text',
                ],
            ],
        ],
        [
            'key'   => 'field_hero_cta_text',
            'label' => __( 'Text odkazu', 'digi' ),
            'name'  => 'hero_cta_text',
            'type'  => 'text',
        ],
        [
            'key'          => 'field_hero_cta_anchor',
            'label'        => __( 'Kotva odkazu', 'digi' ),
            'name'         => 'hero_cta_anchor',
            'type'         => 'text',
            'placeholder'  => '#focus',
            'instructions' => __( 'Např. #focus — odkaz na sekci na téže stránce', 'digi' ),
        ],
    ],
];
