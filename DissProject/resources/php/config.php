<?php
ob_start();

define('CFG_IMG_FONT', 'BuxtonSketch.ttf');
define('CFG_IMG_FONT_SIZE', '15');

define('CFG_IMG_WIDTH', '700');
define('CFG_IMG_MARGIN', '10');

define('CFG_IMG_COLOR_START', '#FFFFFF');
define('CFG_IMG_COLOR_END', '#D6D6D6');

define('CFG_IMG_COLOR_TEXT_R', '0');
define('CFG_IMG_COLOR_TEXT_G', '0');
define('CFG_IMG_COLOR_TEXT_B', '0');

/*define('HOST', '');
define('USER', '');
define('PASS', '');
define('DB', '');
define('USER', 'rzufzxym_diss');
define('PASS', 'lol123**');
define('DB', 'rzufzxym_diss');
*/
define('DSN', 'mysql:host=localhost;dbname=dissProject'); // like URI:host=HOST;port=PORT;dbname=DB
// For MySQL -> URI=mysql | For PostgreSQL -> URI=pgsql
define('HOST', 'localhost');
define('USER', 'root');
define('PASS', 'qw3rty');
define('DB', 'dissProject');
define('ADRES', ''); // Like http://your.site.adress
define('PREFIX', 'diss');

/* *********************
 * FB ADMIN SETTINGS
 * 1 -> USER_ID
 * 2 -> APPLICATION_ID
* ******************* */
define('FB', '1');
define('FB_ID', '');

// Google reCAPTCHA
define('SITEKEY', '6LdpywATAAAAAFPxI9Hjgus87lWw2XM9SOAgEDJv');
define('SECRETKEY', '6LdpywATAAAAAO5oiuTKKbtAk7Uy-G-Rkr2bvWn_');

?>