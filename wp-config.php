<?php
define( 'WP_CACHE', true );
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
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'u590976107_uEKv8' );

/** Database username */
define( 'DB_USER', 'u590976107_QJJuG' );

/** Database password */
define( 'DB_PASSWORD', 'TaZ4CtH7Td' );

/** Database hostname */
define( 'DB_HOST', 'mysql' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define( 'AUTH_KEY',          'KCclM9x+,lmIx%z{=-@| *-D%&{6_<ml Midyc<kqvA;9k,rL~G+@wM.ruGmD %p' );
define( 'SECURE_AUTH_KEY',   'XYI.-YVJ!g@r[hO<+8!:;:}k!~9l%<rIN]*jd,]OONI?Nk^C!4M}+%K$+CQ%/;Nd' );
define( 'LOGGED_IN_KEY',     '_~s79])|.!;koEqEqum,Do|tsHVcg_SI.5JDGYz+!*`sSK Qez^e`;+[0}9vB!xu' );
define( 'NONCE_KEY',         'vS0~K!Jrw@n)%oY`V@6>VGbDQ+cr;XlZqj1DEU?^%v2f-ne,{H_u]0pe!moy!FtN' );
define( 'AUTH_SALT',         '~AzgCWa,7tNDvY0jzjLid=o@#&)H~Q?-=IKNx)=@GT2K@Q;A>O^@crz/ky_[2yr3' );
define( 'SECURE_AUTH_SALT',  ' 9t<u@0^Bf>=AXYWVX4OiOxJ:qFJ*yA?W9P,@B8^pr6(|mfUc.8XxD^}*[YrlT`R' );
define( 'LOGGED_IN_SALT',    '4%3y:fXn{?b-r{R&2o,oY2%[06ALLll#MO KB@BWd-zmt_AQxuKw^Vftw-mwYrW3' );
define( 'NONCE_SALT',        'sw,#rf}suD)>#[*$*QV4m=hj,n-+,Q,`-T,(;8ZIy7}~0]AX,eIMP@zox$Vb(dDc' );
define( 'WP_CACHE_KEY_SALT', 'sTv>+vbt*NRmu-aO:c-*OCZ=mIU{I%w&[Ms &dzJ*M)=pg#p~Zmpv=Y<MuRXu-tO' );


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



define( 'WP_AUTO_UPDATE_CORE', 'minor' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
