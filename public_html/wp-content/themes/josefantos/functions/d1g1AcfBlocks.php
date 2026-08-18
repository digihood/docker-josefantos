<?php
/**
 * Registrace ACF bloků šablony
 *
 * Každý blok má vlastní definiční soubor ve functions/acf/, který vrací pole:
 *   name           — slug bloku (odpovídá parts/block/{name}.php)
 *   title          — název v editoru
 *   icon, keywords — metadata pro editor
 *   preview_text   — callback vracející text náhledu v adminu (obvykle nadpis)
 *   fields         — pole ACF (bez location, tu doplní registrátor)
 *
 * @author Digihood
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'd1g1AcfBlocks' ) ) {

    class d1g1AcfBlocks {

        /** @var array Načtené definice bloků, klíč = slug bloku */
        private static $blocks = [];

        public function __construct() {
            add_action( 'acf/init', [ $this, 'register' ] );
        }

        /**
         * Načte definice ze functions/acf a zaregistruje bloky i jejich pole
         *
         * @author Digihood
         * @return void
         */
        public function register() {

            if ( ! function_exists( 'acf_register_block_type' ) ) {
                return;
            }

            foreach ( glob( __DIR__ . '/acf/*.php' ) as $file ) {

                $config = include $file;

                if ( ! is_array( $config ) || empty( $config['name'] ) ) {
                    continue;
                }

                // Konfigurační soubory bez bloku (např. stránka nastavení) se registrují samy
                if ( empty( $config['fields'] ) ) {
                    continue;
                }

                self::$blocks[ $config['name'] ] = $config;

                $this->register_block( $config );
                $this->register_fields( $config );
            }
        }

        /**
         * Registrace jednoho bloku
         *
         * @param array $config
         *
         * @author Digihood
         * @return void
         */
        private function register_block( $config ) {

            acf_register_block_type( [
                'name'              => $config['name'],
                'title'             => $config['title'],
                'description'       => $config['description'] ?? '',
                'category'          => 'josefantos',
                'icon'              => $config['icon'] ?? 'layout',
                'keywords'          => $config['keywords'] ?? [],
                'render_callback'   => [ $this, 'render' ],
                // auto = nezvolený blok ukazuje náhled, po kliknutí se rozbalí formulář ACF
                'mode'              => 'auto',
                'blockVersion'      => 2,
                // inline editace by nechala upravovat texty rovnou v náhledu místo formuláře
                'autoInlineEditing' => false,
                'supports'          => [
                    'align'  => false,
                    'anchor' => true,
                    'jsx'    => true,
                ],
            ] );
        }

        /**
         * Registrace pole bloku — location se dopočítá ze slugu
         *
         * @param array $config
         *
         * @author Digihood
         * @return void
         */
        private function register_fields( $config ) {

            acf_add_local_field_group( [
                'key'      => 'group_' . $config['name'],
                'title'    => $config['title'],
                'fields'   => $config['fields'],
                'location' => [ [ [
                    'param'    => 'block',
                    'operator' => '==',
                    'value'    => 'acf/' . $config['name'],
                ] ] ],
            ] );
        }

        /**
         * Render bloku
         *
         * V editoru (náhled) vypíše jen nadpis, po kliknutí ACF zobrazí formulář.
         * Na frontendu includuje šablonu parts/block/{name}.php.
         *
         * @param array $block
         *
         * @author Digihood
         * @return void
         */
        public function render( $block, $content = '', $is_preview = false, $post_id = 0 ) {

            $name   = str_replace( 'acf/', '', $block['name'] );
            $config = self::$blocks[ $name ] ?? [];

            // Náhled se vykresluje i přes REST, příznak proto chodí jako třetí parametr callbacku
            if ( $is_preview ) {
                echo self::preview( $config );
                return;
            }

            $template = get_theme_file_path( "/parts/block/{$name}.php" );

            if ( file_exists( $template ) ) {
                include $template;
            }
        }

        /**
         * Náhled bloku v administraci — pouze nadpis
         *
         * @param array $config
         *
         * @author Digihood
         * @return string
         */
        private static function preview( $config ) {

            $label = $config['title'] ?? __( 'Blok', 'digi' );
            $text  = '';

            if ( ! empty( $config['preview_field'] ) ) {
                $text = wp_strip_all_tags( (string) get_field( $config['preview_field'] ) );

                // víceřádkové nadpisy do jedné řádky, bez značek zvýraznění (*text*)
                $text = trim( preg_replace( '/\s+/', ' ', str_replace( '*', '', $text ) ) );
            }

            $out  = '<div class="d1g1-block-preview">';
            $out .= '<span class="d1g1-block-preview__label">' . esc_html( $label ) . '</span>';

            if ( $text !== '' ) {
                $out .= '<span class="d1g1-block-preview__title">' . esc_html( $text ) . '</span>';
            }

            $out .= '<span class="d1g1-block-preview__hint">' . esc_html__( 'Kliknutím upravíte obsah', 'digi' ) . '</span>';
            $out .= '</div>';

            return $out;
        }
    }

    new d1g1AcfBlocks;
}

/**
 * Vlastní kategorie bloků, aby byly sekce webu pohromadě
 *
 * @author Digihood
 */
add_filter( 'block_categories_all', function ( $categories ) {

    array_unshift( $categories, [
        'slug'  => 'josefantos',
        'title' => __( 'Sekce webu', 'digi' ),
    ] );

    return $categories;
}, 10, 1 );
