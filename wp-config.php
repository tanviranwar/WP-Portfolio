<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'portfolio');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'iik%tXD%8JLg083;Q-#AN[)$~=$J`3;[;9N,PaB9 p3d+5xH 5E $(}o[`!I=UD3');
define('SECURE_AUTH_KEY',  '-/{JGX0 [G!tWT>}<|S&zfBJ13k5:zf9*DM0<KW:K=LQ@C&9rakRnlxq#swX&Qq6');
define('LOGGED_IN_KEY',    '%3RIM,r{t-5{SAQm&:i6B[h+G_BpFX85e#{_DB/.xsz:>3Y ^h>Pkc>zoK,Dse=7');
define('NONCE_KEY',        'oC-ruv0qbCA#CW@{ #9qNxfNg+XZ{Bx]{7fU[)/h_SquUD`5x)l:=%Qf2Vt2QX@K');
define('AUTH_SALT',        'eL9Gpuq_6a~>>>@%W50/fMNfKW]zh9e3ieVfy|XhZzri/XM6q*k&jKHSFiV~^TF|');
define('SECURE_AUTH_SALT', 'xS1`n.YxHY<R%1_xTS(iZE>|}502LvZ4.YwoEg%4KyWZ{?<DX!mt#lL.>7.%q8[/');
define('LOGGED_IN_SALT',   'Cg+j0^zGS9rWN(JtQT /MJl_Bscg=(yr=3kj<|N`f/K;iq>N1dfrjd_*@4cqK4Ey');
define('NONCE_SALT',       ',OO0|<W4mgP-E}u.uuFe_|0`jmSd_`gh/iC7Abd_ujbV|W=C$OR.6da:G(K;Gw8=');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
