<?php
/**
 * ACF blok — O mně
 *
 * @author Digihood
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

return [
    'name'          => 'about',
    'title'         => __( 'O mně', 'digi' ),
    'description'   => __( 'Sekce s fotkou, bio, dovednostmi a aktivitami', 'digi' ),
    'icon'          => 'admin-users',
    'keywords'      => [ 'o mne', 'about', 'bio' ],
    'preview_field' => 'about_title',
    'fields'        => [
        [
            'key'           => 'field_about_photo',
            'label'         => __( 'Fotografie', 'digi' ),
            'name'          => 'about_photo',
            'type'          => 'image',
            'return_format' => 'id',
            'preview_size'  => 'medium',
        ],
        [
            'key'   => 'field_about_label',
            'label' => __( 'Popisek nad nadpisem', 'digi' ),
            'name'  => 'about_label',
            'type'  => 'text',
        ],
        [
            'key'   => 'field_about_title',
            'label' => __( 'Nadpis sekce', 'digi' ),
            'name'  => 'about_title',
            'type'  => 'text',
        ],
        [
            'key'          => 'field_about_text',
            'label'        => __( 'Text', 'digi' ),
            'name'         => 'about_text',
            'type'         => 'wysiwyg',
            'tabs'         => 'visual',
            'toolbar'      => 'basic',
            'media_upload' => 0,
        ],
        [
            'key'   => 'field_about_skills_label',
            'label' => __( 'Popisek dovedností', 'digi' ),
            'name'  => 'about_skills_label',
            'type'  => 'text',
        ],
        [
            'key'          => 'field_about_skills',
            'label'        => __( 'Klíčové oblasti', 'digi' ),
            'name'         => 'about_skills',
            'type'         => 'repeater',
            'layout'       => 'table',
            'button_label' => __( 'Přidat oblast', 'digi' ),
            'sub_fields'   => [
                [
                    'key'   => 'field_about_skill_name',
                    'label' => __( 'Název', 'digi' ),
                    'name'  => 'name',
                    'type'  => 'text',
                ],
                [
                    'key'          => 'field_about_skill_url',
                    'label'        => __( 'Odkaz', 'digi' ),
                    'name'         => 'url',
                    'type'         => 'url',
                    'instructions' => __( 'Prázdné = oblast bez odkazu.', 'digi' ),
                ],
            ],
        ],
        [
            'key'   => 'field_about_activities_label',
            'label' => __( 'Popisek aktivit', 'digi' ),
            'name'  => 'about_activities_label',
            'type'  => 'text',
        ],
        [
            'key'          => 'field_about_activities',
            'label'        => __( 'Mimo kancelář', 'digi' ),
            'name'         => 'about_activities',
            'type'         => 'repeater',
            'layout'       => 'table',
            'button_label' => __( 'Přidat aktivitu', 'digi' ),
            'sub_fields'   => [
                [
                    'key'   => 'field_about_activity_name',
                    'label' => __( 'Aktivita', 'digi' ),
                    'name'  => 'name',
                    'type'  => 'text',
                ],
                [
                    'key'   => 'field_about_activity_note',
                    'label' => __( 'Poznámka', 'digi' ),
                    'name'  => 'note',
                    'type'  => 'text',
                ],
                [
                    'key'          => 'field_about_activity_url',
                    'label'        => __( 'Odkaz', 'digi' ),
                    'name'         => 'url',
                    'type'         => 'url',
                    'instructions' => __( 'Prázdné = aktivita bez odkazu.', 'digi' ),
                ],
            ],
        ],
    ],
];
