<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'crossroads_dental' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '*s73C>4g<LRo=p 5.=~O[I0t!L3A%Wf=p|OqB}3Fn*gm*.ReR(UiMq[3,MS/qH50' );
define( 'SECURE_AUTH_KEY',  'q= lU1YSI0BtAt;{S=On)BzCk-ex].kCt*AGU< SQe!Z`j-K#4C^zer[RsAhuvT*' );
define( 'LOGGED_IN_KEY',    'B]8,~!VEV;<$%GR$qe;Vk3OsN[RS2V#|T=xruq-`MQdHmGcL_2LYd$/q%]5LU|HT' );
define( 'NONCE_KEY',        '.l*1HUkd9^&oJCsgiV#WA3l*wo`pP-7bc-tNdg;F(1C*|uunC;ljj`Rq=b|<.NK+' );
define( 'AUTH_SALT',        'XHL23Ff.rXj4NP$qd0lIu{_a+g:0FucabqM*m%U~Jd R9G^D]a7@b $w_}$2J55I' );
define( 'SECURE_AUTH_SALT', 'uY%O6!q2vTy%8`wh7jv~)*^QaIsi+U/t~aRE XfLN;s#Q4=i3a3V}1TR#g){;V/o' );
define( 'LOGGED_IN_SALT',   'MN$34y(&.hof#icmUr$WEb(w#DasBYN*t%8nuZ<P6hwp9Iy1/S6xY s8j:7wLuv~' );
define( 'NONCE_SALT',       'SlN6Gz`.J_@1Piu_P%-(]|RSRBh.6-q#M|?P2.B{d^ImH:OPrJmH;v#t:eg|2p @' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
