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
define('DB_NAME', 'blablabla-Preschool');

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
define('AUTH_KEY',         'Hm3Ze/W(Pl(%J?eK]`IRb!X4<>>UDjbSgr%sQ1B~mrO5G6a*>#~1(ibOta:Cg6m@');
define('SECURE_AUTH_KEY',  '1WzutnLtr2^Nw6D_{{tWeD5er(Fmgn70J]XUP$lE)TH>loD=7^BqUB#1JRUQ<[fi');
define('LOGGED_IN_KEY',    'G8x_blk+p%qFnI&3<0S@/k1_I}mqt-}O#P`s?=d9`tkrF$f_C)n68Tk4Av1aKV{$');
define('NONCE_KEY',        'hC$OD,[ai^ugK5eKlX(XmZI;Hy%9Ha)ch?+&NU@kpE* jY%}YJ93;zx!zzEw11x2');
define('AUTH_SALT',        'f`BeHV,L7%s}(N~q%*0R][@V)I,[x$;WWfba<g[5kX&]KO:t=~:&^plLD(GC`Vy_');
define('SECURE_AUTH_SALT', 'Ow!}7+u#(p1W]NAb(-}*vZ2OA=rBIc_P5aBokH_n;6eWL2D,Y/#!Av3(caT3^32|');
define('LOGGED_IN_SALT',   '<Br_z6``OrAg{%V3owk[VgYg}RT?69G)sJpCY$O3nMXBLh82%=PwkJ(k5L<GunJ9');
define('NONCE_SALT',       'rN81^{RIkex:Cmi8?9:,@DiOG=)uFrX<%qPk7#@GSwu5_]K+p0I`;86~MgM -zn`');

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
