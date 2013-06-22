<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'newword');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         '`;??;+D<i0ms6,@NMT[b@9pEBpN_^J}j7x:6?0+oP a)z%!H2`Ra8AHj1sqog78<');
define('SECURE_AUTH_KEY',  '<Be G&qdAOD@Tc*~a/ cNb[o+n8|uom;srh_E|V~v)@Cxo%2[3ErXgeY(KApktg5');
define('LOGGED_IN_KEY',    'O;0{!(6y>$AoR(.06JC|9r<QCo-Ma|:r 6|+.Gu;x:JE<n.mWBah@2IPh-UV8J2N');
define('NONCE_KEY',        '&XC|h:tP481MDNK-(bUY2?IY55hk5|Z.AZ|gdI[FcDRL|Gldn^%4{auQc[#Om:13');
define('AUTH_SALT',        'WrMO/r%]J`|dmbqG2MYEdj4~3yt)uZ&$SQypEnunV9X,q@.*/Gkf/R{4=1ZcO`Pt');
define('SECURE_AUTH_SALT', 'sbG?n(h9P1E=6L1N>>I^B2{hT7c{2oUS^U_G*dk3JqO( ?eXQNK7K1YuM,b<!P>1');
define('LOGGED_IN_SALT',   ':OYLVk7-@8/(?5]Wy0x^L;:<2lCSi^mDC)byD/Gdd:qC%B-97r/2InVQ>NmMIVr@');
define('NONCE_SALT',       '.-vm_.}#R&Uh$Ao{(A_[cVP+,tzYToKI^qBld&dW~6c;CY>]Edrz%_]HaB%xroq<');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
