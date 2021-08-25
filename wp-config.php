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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wp' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'TPrr=El%94^-;J cjVyiBp%,sXK|[ko,ImWY=s_ZrZd<!@#?f~uyfYh>6`5u&FT*' );
define( 'SECURE_AUTH_KEY',  'cpX~/Bl)|g3%0d.t&MT&51Ur^8x.oPRyK=4q-%WF)5${h/KY`d82znQE&H_vC$|9' );
define( 'LOGGED_IN_KEY',    '#d[%x5<%I0-X1*E;Y9})x.}=kDas^oc#SQ16E(@r?TP$6JtTf}4P{SQSwP_+Mp?$' );
define( 'NONCE_KEY',        'UQd`N*46Ve.xS6B[:Vji0!Yd:#>k|7TE+vxH1FUb%IP+vVA=,ko/kMeri?G;dM_^' );
define( 'AUTH_SALT',        'u$Vv&*/O<0Yi%&qZv+HM?})9-ocX==g28xnz3t$F<$i2pht.@_Y{jz2idY}Ox3+~' );
define( 'SECURE_AUTH_SALT', 'OOF~V#kBeC2q5AqnJH[!t:E*LOr`xYaLhtZgPoj?z_:>yZXIHQd[$ng$0[<F[n9(' );
define( 'LOGGED_IN_SALT',   '++]he8i(ewFV8}w+-#wm&Sd-<i&KY*NtNJ%S[EEqOU6gEGIUV0)D<0D_}Uf[n;^U' );
define( 'NONCE_SALT',       '/[ZQ(-wx.$[+#-XjnAg]M{;8_<ZLZG:-gtEmmi ;-{)a;>o8N##RC]JWrpk_:].@' );

/**#@-*/

/**
 * WordPress Database Table prefix.
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

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
