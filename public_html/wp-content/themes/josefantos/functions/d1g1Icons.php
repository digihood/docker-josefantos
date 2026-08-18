<?php
/**
 * Inline SVG ikony (sada Lucide)
 *
 * Ikony se vypisují inline, aby dědily barvu textu přes currentColor —
 * díky tomu fungují hover stavy definované Tailwindem.
 *
 * @author Digihood
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'd1g1Icons' ) ) {

    class d1g1Icons {

        /** @var array Vnitřek <svg> pro jednotlivé ikony */
        private static $paths = [
            'arrow-up-right'   => '<path d="M7 7h10v10"/><path d="M7 17 17 7"/>',
            'arrow-down-right' => '<path d="M7 17h10V7"/><path d="M7 7 17 17"/>',
            'chevron-down'   => '<path d="m6 9 6 6 6-6"/>',
            'menu'           => '<path d="M4 6h16"/><path d="M4 12h16"/><path d="M4 18h16"/>',
            'x'              => '<path d="M18 6 6 18"/><path d="m6 6 12 12"/>',
            'send'           => '<path d="M14.536 21.686a.5.5 0 0 0 .937-.024l6.5-19a.496.496 0 0 0-.635-.635l-19 6.5a.5.5 0 0 0-.024.937l7.93 3.18a2 2 0 0 1 1.112 1.11z"/><path d="m21.854 2.147-10.94 10.939"/>',
            'check-circle'   => '<path d="M21.801 10A10 10 0 1 1 17 3.335"/><path d="m9 11 3 3L22 4"/>',
            'monitor'        => '<rect width="20" height="14" x="2" y="3" rx="2"/><path d="M8 21h8"/><path d="M12 17v4"/>',
            'zap'            => '<path d="M4 14a1 1 0 0 1-.78-1.63l9.9-10.2a.5.5 0 0 1 .86.46l-1.92 6.02A1 1 0 0 0 13 10h7a1 1 0 0 1 .78 1.63l-9.9 10.2a.5.5 0 0 1-.86-.46l1.92-6.02A1 1 0 0 0 11 14z"/>',
            'trending'       => '<path d="M16 7h6v6"/><path d="m22 7-8.5 8.5-5-5L2 17"/>',
            'facebook'       => '<path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/>',
            'linkedin'       => '<path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/><rect width="4" height="12" x="2" y="9"/><circle cx="4" cy="4" r="2"/>',
        ];

        /**
         * Vrátí inline SVG ikonu
         *
         * @param string $name  Název ikony
         * @param string $class Tailwind třídy pro <svg>
         *
         * @author Digihood
         * @return string
         */
        public static function get( $name, $class = 'w-4 h-4' ) {

            if ( empty( self::$paths[ $name ] ) ) {
                return '';
            }

            return sprintf(
                '<svg class="%s" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">%s</svg>',
                esc_attr( $class ),
                self::$paths[ $name ]
            );
        }

        /**
         * Vypíše inline SVG ikonu
         *
         * @param string $name
         * @param string $class
         *
         * @author Digihood
         * @return void
         */
        public static function show( $name, $class = 'w-4 h-4' ) {
            echo self::get( $name, $class );
        }
    }
}
