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
define('DB_NAME', 'goclaptrinh_prod');

/** MySQL database username */
define('DB_USER', 'goclaptrinh_db');

/** MySQL database password */
define('DB_PASSWORD', 'M00nL1ght');

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
define('AUTH_KEY',         'J$1)};oVj&:4U Sdgv;0EaX7p6&0!S(i&u,AY3NXf,,8+[36F,J2~vMC]iA5iqvi');
define('SECURE_AUTH_KEY',  'c*4E3,2`i*cB+-R`9+(5B]f`wzL~QHyd049?JEQMp, L,eM&itE:&z:vQWYnJ, [');
define('LOGGED_IN_KEY',    ';s8I6D6.M;uq`aPl5*Xf4([c1Q_ki3BO&YOv~_*s@W5yE5$1[Qwm}(1XnE2)0R{F');
define('NONCE_KEY',        '2cjC1gobK@hd#XFmv-(d9^Nox5NJ:csA%pci*X)SJ=eJLdwo>:e`~lNGB7O23-_[');
define('AUTH_SALT',        '@dq94Dh*p4oOV:Wyx#XCkgsSSz[nf`#ad)y:Q9B@Z|nA.k}g6FPl|<<e`kSAF]K3');
define('SECURE_AUTH_SALT', 'K+C%EOvO6HeN~i:9]@;(A`m QH0_rIsR_mtZH#X6yAq5_` |i]<_!Fk <[i9NW~L');
define('LOGGED_IN_SALT',   '3)?em^7I^A&wlET5W10rTk5^bo[ng$X;c/0_A5++MRd^~0n soan_B|12%7u~i,N');
define('NONCE_SALT',       'u9Ap%jy6c!A6L[,1[%sYC4[6(i(7iGK)18{,@J$UqPWqL^}[4=x:hZj`4wnl<^r?');

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
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', false);
/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
