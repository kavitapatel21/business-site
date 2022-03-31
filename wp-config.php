<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'business' );

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
define( 'AUTH_KEY',         'd~aU?,,]s,FD{sD^TfriO<z@Mu(<A(Fb0}=taV<gc>%v{&Tr#/jT_Z[>~)Zk 1,#' );
define( 'SECURE_AUTH_KEY',  '2@wyB?Vb60))Qlp3gWL%8xN$wa}5+gw<-g^%-Y>(a39F;c>{Q1@`bq_<eug8uycz' );
define( 'LOGGED_IN_KEY',    ']TEl48^q$Wh5j`NM{*IU0?W{&NV]=LrHT6n{_Gu?QI_2e]dYV,dp)`ugrh7y@O.^' );
define( 'NONCE_KEY',        'NXl|K3eZ$xf1XKm?zpJ26,u!6V{+A0ImIh.nVuko ;!fm% E0AfM$0PgHtkveej-' );
define( 'AUTH_SALT',        ',gd4,>?31&,E^*b(07-9}UIcgB$x5=FlrUQChfv@tO4W;-K>*N7UxbMSGy}<Af1a' );
define( 'SECURE_AUTH_SALT', '~k0,)t%h L9fJ$sQZ0 r>b<e?]sx.]:y}o@]Yib;[X#;68M; R2RT@U`;_/ ?/ZR' );
define( 'LOGGED_IN_SALT',   '{V2fd2&7%Rg^N1 4y08BaHcUX>hU@?_k@c4`A2uCN31uDHRT-4)eOZMYs{k;VPr7' );
define( 'NONCE_SALT',       ':>7n8hM&8Zk/hISGZz9,SpB7Jl#>L49-D^X?gkP:FN!db9b@`Jo356p/|d6nNhAT' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
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
