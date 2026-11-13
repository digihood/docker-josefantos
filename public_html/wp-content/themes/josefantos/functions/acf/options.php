<?php
/**
 * ACF — nastavení webu (záhlaví a zápatí)
 *
 * Soubor se načítá registrátorem d1g1AcfBlocks na acf/init. Nevrací blok,
 * registruje si stránku nastavení i vlastní pole sám.
 *
 * @author Digihood
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! function_exists( 'acf_add_options_page' ) ) {
    return null;
}

acf_add_options_page( [
    'page_title' => __( 'Nastavení webu', 'jos' ),
    'menu_title' => __( 'Nastavení webu', 'jos' ),
    'menu_slug'  => 'nastaveni-webu',
    'capability' => 'edit_theme_options',
    'icon_url'   => 'dashicons-admin-customizer',
    'position'   => 30,
    'redirect'   => false,
] );

acf_add_local_field_group( [
    'key'      => 'group_site_options',
    'title'    => __( 'Nastavení webu', 'jos' ),
    'fields'   => [

        // ── Záhlaví ─────────────────────────────────────────────
        [
            'key'   => 'field_options_tab_header',
            'label' => __( 'Záhlaví', 'jos' ),
            'type'  => 'tab',
        ],
        [
            'key'          => 'field_options_brand',
            'label'        => __( 'Název v záhlaví', 'jos' ),
            'name'         => 'brand',
            'type'         => 'text',
            'instructions' => __( 'Zobrazí se vlevo nahoře. Prázdné = název webu.', 'jos' ),
        ],
        [
            'key'   => 'field_options_header_cta_text',
            'label' => __( 'Text tlačítka v záhlaví', 'jos' ),
            'name'  => 'header_cta_text',
            'type'  => 'text',
        ],
        [
            'key'         => 'field_options_header_cta_anchor',
            'label'       => __( 'Kotva tlačítka', 'jos' ),
            'name'        => 'header_cta_anchor',
            'type'        => 'text',
            'placeholder' => '#contact',
        ],

        // ── Zápatí ──────────────────────────────────────────────
        [
            'key'   => 'field_options_tab_footer',
            'label' => __( 'Zápatí', 'jos' ),
            'type'  => 'tab',
        ],
        [
            'key'          => 'field_options_footer_name',
            'label'        => __( 'Jméno v copyrightu', 'jos' ),
            'name'         => 'footer_name',
            'type'         => 'text',
            'instructions' => __( 'Rok se doplní automaticky.', 'jos' ),
        ],
        [
            'key'   => 'field_options_footer_company',
            'label' => __( 'Firma v zápatí', 'jos' ),
            'name'  => 'footer_company',
            'type'  => 'text',
        ],
        [
            'key'          => 'field_options_socials',
            'label'        => __( 'Sociální sítě', 'jos' ),
            'name'         => 'socials',
            'type'         => 'repeater',
            'layout'       => 'table',
            'button_label' => __( 'Přidat síť', 'jos' ),
            'sub_fields'   => [
                [
                    'key'           => 'field_options_social_network',
                    'label'         => __( 'Síť', 'jos' ),
                    'name'          => 'network',
                    'type'          => 'select',
                    'choices'       => [
                        'facebook' => 'Facebook',
                        'linkedin' => 'LinkedIn',
                    ],
                    'default_value' => 'facebook',
                ],
                [
                    'key'   => 'field_options_social_url',
                    'label' => __( 'Odkaz', 'jos' ),
                    'name'  => 'url',
                    'type'  => 'url',
                ],
            ],
        ],
    ],
    'location' => [ [ [
        'param'    => 'options_page',
        'operator' => '==',
        'value'    => 'nastaveni-webu',
    ] ] ],
] );

return null;
