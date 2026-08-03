<?php

define( 'WP_CACHE', false ); // Vypnuty page cache pro lokalni vyvoj

// true = styly a scripty se berou z Vite dev serveru (npm run dev)
// false = nacitaji se ze zbuildeneho assets-minified (npm run build)
define( 'VITE_DEVELOPMENT', false );

/**
 * The base configuration for WordPress
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'database' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'ls4H#=Jyc%$6h_GkeyNJUz)30Rw-W+^%nJ*&M--RBK2_rBUHMxW9ihlXEAnaz0VK' );
define( 'SECURE_AUTH_KEY',  '(sbb7_A&$(OKgx*U6CLX*t-yyTrtr(M-@zC+EZvICsz7s)*(&bVoCZpr*ZfQV^6a' );
define( 'LOGGED_IN_KEY',    '-g*Q-WD=aCne12+yC1(9%&-+gBcAHa34zDFcLX8KPyEQK)8vW6#7^IWZ$JVc2tv1' );
define( 'NONCE_KEY',        'S0N4PB7C*H(bABfb1o7wmDQcDIZ22x7CsmD5bCwk=6cSEC6DoX+GS077--_*$1bD' );
define( 'AUTH_SALT',        'K=ZqYu&5bjY!=9Ib$4Py69VDUhS(sWN^Itc=nxbrbps$Qkfs1FpQRB%B2(XzKUbq' );
define( 'SECURE_AUTH_SALT', '^Ku81AJ0u0(%lk2-6%eR#^+j%eMn4K0NUpkbgdmWuZcWKNA5pAv7S-57=Rp+bWPu' );
define( 'LOGGED_IN_SALT',   'jsdEP3%^Q16oXF-8rnIHS-b8J3)EPlRJU5*Mq$FCS=VhCCxvIQV68L*$=#JE2lUG' );
define( 'NONCE_SALT',       '!$2Yww9-PkvmFrFYf-FC(fM5Y1@AfeS9ug1CG)h&l3Ci4)O2bfC7LDX82^h8Sha1' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 */
$table_prefix = 'j0s3f_';

/**
 * For developers: WordPress debugging mode.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', true );
define( 'WP_DEBUG_DISPLAY', false ); // chyby nesmi do vystupu - rozbijelo to hlavicky na wp-login.php
define( 'WP_DEBUG_LOG', true );      // misto toho do wp-content/debug.log
@ini_set( 'display_errors', 0 );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );

define('FS_METHOD', 'direct');
