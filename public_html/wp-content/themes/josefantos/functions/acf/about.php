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
    'title'         => __( 'O mně', 'jos' ),
    'description'   => __( 'Sekce s fotkou, bio, dovednostmi a aktivitami', 'jos' ),
    'icon'          => 'admin-users',
    'keywords'      => [ 'o mne', 'about', 'bio' ],
    'preview_field' => 'about_title',
    'fields'        => [
        [
            'key'           => 'field_about_photo',
            'label'         => __( 'Fotografie', 'jos' ),
            'name'          => 'about_photo',
            'type'          => 'image',
            'return_format' => 'id',
            'preview_size'  => 'medium',
        ],
        [
            'key'   => 'field_about_label',
            'label' => __( 'Popisek nad nadpisem', 'jos' ),
            'name'  => 'about_label',
            'type'  => 'text',
        ],
        [
            'key'   => 'field_about_title',
            'label' => __( 'Nadpis sekce', 'jos' ),
            'name'  => 'about_title',
            'type'  => 'text',
        ],
        [
            'key'          => 'field_about_text',
            'label'        => __( 'Text', 'jos' ),
            'name'         => 'about_text',
            'type'         => 'wysiwyg',
            'tabs'         => 'visual',
            'toolbar'      => 'basic',
            'media_upload' => 0,
        ],
        [
            'key'   => 'field_about_skills_label',
            'label' => __( 'Popisek dovedností', 'jos' ),
            'name'  => 'about_skills_label',
            'type'  => 'text',
        ],
        [
            'key'          => 'field_about_skills',
            'label'        => __( 'Klíčové oblasti', 'jos' ),
            'name'         => 'about_skills',
            'type'         => 'repeater',
            'layout'       => 'table',
            'button_label' => __( 'Přidat oblast', 'jos' ),
            'sub_fields'   => [
                [
                    'key'   => 'field_about_skill_name',
                    'label' => __( 'Název', 'jos' ),
                    'name'  => 'name',
                    'type'  => 'text',
                ],
                [
                    'key'          => 'field_about_skill_url',
                    'label'        => __( 'Odkaz', 'jos' ),
                    'name'         => 'url',
                    'type'         => 'url',
                    'instructions' => __( 'Prázdné = oblast bez odkazu.', 'jos' ),
                ],
            ],
        ],
        [
            'key'   => 'field_about_activities_label',
            'label' => __( 'Popisek aktivit', 'jos' ),
            'name'  => 'about_activities_label',
            'type'  => 'text',
        ],
        [
            'key'          => 'field_about_activities',
            'label'        => __( 'Mimo kancelář', 'jos' ),
            'name'         => 'about_activities',
            'type'         => 'repeater',
            'layout'       => 'table',
            'button_label' => __( 'Přidat aktivitu', 'jos' ),
            'sub_fields'   => [
                [
                    'key'   => 'field_about_activity_name',
                    'label' => __( 'Aktivita', 'jos' ),
                    'name'  => 'name',
                    'type'  => 'text',
                ],
                [
                    'key'   => 'field_about_activity_note',
                    'label' => __( 'Poznámka', 'jos' ),
                    'name'  => 'note',
                    'type'  => 'text',
                ],
                [
                    'key'          => 'field_about_activity_url',
                    'label'        => __( 'Odkaz', 'jos' ),
                    'name'         => 'url',
                    'type'         => 'url',
                    'instructions' => __( 'Prázdné = aktivita bez odkazu.', 'jos' ),
                ],
            ],
        ],
    ],
];
