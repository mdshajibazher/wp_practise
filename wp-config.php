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

define( 'WPLANG', 'en_US' );

define( 'DB_NAME', 'wp' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'password' );

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
define( 'AUTH_KEY',         'R(ZmYn;LpN45 <BH +P6OrxpDGq:7).LB/w;pGgBgqRc/#Xg?I-F*y~?,/ta*Zn6' );
define( 'SECURE_AUTH_KEY',  'G~0P.iQ2?^7IQFkj&3M*LeIg:|p4ZRTr1S89dKqa(k.0JytmjWIp$X^;WI|%[[Ox' );
define( 'LOGGED_IN_KEY',    'RS>&!>c,6%vBe|;E0B?jTYXwaUkt|g|v?7Q?Lv}2_csCAi8T|8E$6MSYolb7~0Nm' );
define( 'NONCE_KEY',        'rmA[xT{1U0|S}MqxXIk->7GNRtvIv#s#,d^7#w6XU$bd;nz1n|v`+)iQ+7,L?W&%' );
define( 'AUTH_SALT',        ';&A^`4w*[=WRWH@n%2A!yAdDL?s_2MtiAb.mRJ *Eo{*ZL5l8Qh&GAo0U<wRa<^o' );
define( 'SECURE_AUTH_SALT', 'w8[wrhT}sX_I7U,}Odf$~@e&1wZ[d|8l.(zv)wt@{MtzKeXauBUV5:2fwYzLS>C/' );
define( 'LOGGED_IN_SALT',   'MFRrYJTVNOV.g@K1}vajZS&H}R7Hf=OVh{:~.0WmaO.^xTx{5vWT9}0]B7d-,.Ln' );
define( 'NONCE_SALT',       ')Hnh=%?a;ozUhzQLQlcYzlPz,*%(:.|TE!9N%*,Cp^f27VUpPPVpAr-}u9-co%(s' );

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
define( 'WP_DEBUG', true );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
