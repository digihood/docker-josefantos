<?php 

if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

if( ! class_exists( 'd1g1RegisterCustomPostTypes' ) )
{
    class d1g1RegisterCustomPostTypes
    {

        public function __construct()
        {
			// Post types
            add_action( 'init', [$this, 'create_post_type'] );
            add_action( 'init', [$this, 'create_documentation_post_type'] );

            // Taxonomie
            add_action( 'init', [$this,'create_project_type_tax'] );
            add_action( 'init', [$this,'create_project_status_tax'] );
            add_action( 'init', [$this,'create_documentation_category_tax'] );
        }

		// Projekt post type
        function create_post_type() {
            register_post_type( 'project',
                array(
                  'labels' => array(
                    'name' => __( 'Projekt', 'custom' ),
                    'add_new' => __( 'Přidat projekt', 'custom' ),
                    'view_item'=> __( 'Zobrazit projekt', 'custom' ),
                    'edit_item' => __( 'Upravit projekt', 'custom' ),
                    'singular_name' => __( 'projekt', 'custom' ),
                    'menu_name' => __( 'Projekty', 'custom' ),
                  ),
                  'public' => true,
                  'menu_icon' => 'dashicons-media-spreadsheet',
                  'menu_position' => 57,
                  'has_archive' => true,
                  'show_in_rest' => true,
                  'supports' => array( 'title', 'editor', 'excerpt', 'page-attributes', 'thumbnail' , 'author' )
                )
            );
        }

		// Dokumentace post type
        function create_documentation_post_type() {
            register_post_type( 'documentation',
                array(
                    'labels' => array(
                        'name' => __( 'Dokumentace', 'custom' ),
                        'add_new' => __( 'Přidat dokumentaci', 'custom' ),
                        'view_item'=> __( 'Zobrazit dokumentaci', 'custom' ),
                        'edit_item' => __( 'Upravit dokumentaci', 'custom' ),
                        'singular_name' => __( 'dokumentace', 'custom' ),
                        'menu_name' => __( 'Dokumentace', 'custom' ),
                    ),
                    'public' => true,
                    'menu_icon' => 'dashicons-media-document',
                    'menu_position' => 58,
                    'has_archive' => true,
                    'show_in_rest' => true,
                    'hierarchical' => true,
                    'supports' => array( 'title', 'editor', 'page-attributes', 'revisions' ),
                    'rewrite' => array('slug' => 'dokumentace')
                )
            );
        }

        // Taxonomie typ projektu
        function create_project_type_tax() {
            register_taxonomy(
                'project_type',
                'project',
                array(
                    'label' => __( 'Typ projektu', 'custom' ),
                    'rewrite' => array( 'slug' => 'typ' ),
                    'hierarchical' => true,
                )
            );
        }

        // Taxonomie status
        function create_project_status_tax() {
            register_taxonomy(
                'project_status',
                'project',
                array(
                    'label' => __( 'Status projektu', 'custom' ),
                    'rewrite' => array( 'slug' => 'status' ),
                    'hierarchical' => true,
                )
            );
        }

        // Taxonomie kategorie dokumentace
        function create_documentation_category_tax() {
            register_taxonomy(
                'documentation_category',
                'documentation',
                array(
                    'label' => __( 'Kategorie dokumentace', 'custom' ),
                    'rewrite' => array( 'slug' => 'kategorie-dokumentace' ),
                    'hierarchical' => true,
                    'show_in_rest' => true,
                    'labels' => array(
                        'name' => __( 'Kategorie dokumentace', 'custom' ),
                        'singular_name' => __( 'Kategorie dokumentace', 'custom' ),
                        'add_new_item' => __( 'Přidat novou kategorii', 'custom' ),
                        'edit_item' => __( 'Upravit kategorii', 'custom' )
                    )
                )
            );
        }
    }
}

new d1g1RegisterCustomPostTypes;