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

define( 'DB_NAME', 'local_io_blog' );




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

define( 'AUTH_KEY',         'W5}5Z;57z67=dadbtOp[Zzo;}@dd]hkxF~(6!k]&AXv|ux<7Tk0:$7eY8x?^}7qi' );


define( 'SECURE_AUTH_KEY',  'QY: wL35jF.fiAKIBP[N#t`wxIm],TNp~P5!&=gjdq|tiT[~-:hdrG0O?5E|?iI6' );


define( 'LOGGED_IN_KEY',    'H;v^:~`A^}ZZ:hk#x|QzZ-V^f[EZ_W}Jxq>LK19bR@V*qO&AyX=1[(siIlx8C:6O' );


define( 'NONCE_KEY',        'C<)IlsN<`XE7dj`X9P8Ji=2E%G4Il`]SR6IG<nvzA~EnYM:Q$?lSN?<:<^fHPyg{' );


define( 'AUTH_SALT',        'kVT(u[ukTbhJrbg^TQado:*W!3Nyuim&oHR?Y*zSEa`-tu<J=~TF?FmJhW<G/@_j' );


define( 'SECURE_AUTH_SALT', '*5;HM9ni`#Jr0[39`@M$kv+eDj~6VMkPcIYbvVN rOY[Z8V*t6=?2u#@#2{Sk}C~' );


define( 'LOGGED_IN_SALT',   '[/?&nVd2&u6x=Hp=@J@ONfK&L5qBS.T)$5;L(7P5>sLN092L2(n^=<f<7n?5-=b*' );


define( 'NONCE_SALT',       ']XkDM-.2]lwZdX-!/o6>~jzm}XTJd6&sHB{f/QqU5x3@MTed}|j&j;,6+L)[]O~L' );




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

