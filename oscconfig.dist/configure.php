<?php
//LANG dependent START 
define('DIR_FS_MASTER_ROOT_DIR', 'XDIRFSMASTERROOTDIRX/'); //admin config: '/home/user/WWW/' english: /home/user/WWW.en/
if (!defined('DEFAULT_CURRENCY')) {
  define('DEFAULT_CURRENCY','CZK');
}
if (!defined('DEFAULT_LANGUAGE')) {
  define('DEFAULT_LANGUAGE','cs');
}
//LANG dependent END
define('PRODUCTS_CANONICAL_TYPE','path'); //config: path / manufacturer
if (!defined('OSC_DIR')) {define('OSC_DIR','osc/');}
define('CONFIG_DIR','oscconfig/'); 
define('MYSQL_DEBUG', 'on'); //on|off=default 'on' set only for DEVEL debug !!!
define('BOOTSTRAP_LESS_DIR', 'DISABLEDbootstrap-3.3.7/less/'); // <------ need to bee configured
if (!defined('SERVER_INSTANCE')) {
	define('SERVER_INSTANCE', 'admin'); //CONFIGURE: admin|shop <------ need to bee configured
}
if (!defined('MAX_DISPLAY_SEARCH_RESULTS')) {define('MAX_DISPLAY_SEARCH_RESULTS','30');}
define('GENERATOR_INSTANCE', 'true'); // set to 'true'for generator dir set 'false' for shop or admin  <------ need to bee configured ! ! !

define('DIR_FS_CATALOG', DIR_FS_MASTER_ROOT_DIR . OSC_DIR . 'catalog/');
if ($_SERVER['REQUEST_SCHEME'] =='https') { 
  $https = 'https';
  define('ENABLE_SSL', true); // <------ need to bee configured
} else {
  $https = 'http';
  define('ENABLE_SSL', false); // <------ need to bee configured
}
define('HTTP_SERVER', $https . '://' . $_SERVER['HTTP_HOST']);

if (GENERATOR_INSTANCE == 'true') {
  define('SESSION_FORCE_COOKIE_USE', 'True');
  define('USE_SEO_REDIRECT', 'false');
} else {
  define('SESSION_FORCE_COOKIE_USE', 'False');
  define('USE_SEO_REDIRECT', 'false'); //final version: 'true' TODO: fix translations in includes/classes/SeoUrl.php
}
define('HTTPS_SERVER', HTTP_SERVER);
define('HTTP_COOKIE_DOMAIN', $_SERVER['HTTP_HOST']);
define('HTTPS_COOKIE_DOMAIN', $_SERVER['HTTP_HOST']);
define('HTTP_COOKIE_PATH', '/');
define('HTTPS_COOKIE_PATH', '/');
define('DIR_WS_HTTP_CATALOG', '/');
define('DIR_WS_HTTPS_CATALOG', '/');
define('DIR_WS_IMAGES', 'images/');
define('DIR_WS_ICONS', 'icons/');
define('DIR_WS_INCLUDES', 'includes/');
define('DIR_WS_FUNCTIONS', DIR_WS_INCLUDES . 'functions/');
define('DIR_WS_CLASSES', DIR_WS_INCLUDES . 'classes/');
define('DIR_WS_MODULES', DIR_WS_INCLUDES . 'modules/');
define('DIR_WS_LANGUAGES', DIR_WS_INCLUDES . 'languages/');

define('DIR_WS_DOWNLOAD_PUBLIC', 'pub/');
define('DIR_FS_DOWNLOAD', DIR_FS_CATALOG . 'download/');
define('DIR_FS_DOWNLOAD_PUBLIC', DIR_FS_CATALOG . 'pub/');

//  define('DB_SERVER_USERNAME_PREFIX','os'); //2 chars
define('USE_PCONNECT', 'false');
define('STORE_SESSIONS', 'mysql');
define('CFG_TIME_ZONE', 'Europe/Prague'); // <------ need to bee configured
define('WEBMASTER_EMAIL', '00420602604992@sms.cz.o2.com');


define('FLEXIBEE_URL', 'https://vitexsoftware.flexibee.eu:5434');
/*
 * Uživatel FlexiBee API
 */
define('FLEXIBEE_LOGIN', 'purehtml');
/*
 * Heslo FlexiBee API
 */
define('FLEXIBEE_PASSWORD', 'jeansolpartre');
/*
 * Společnost v FlexiBee
 */
define('FLEXIBEE_COMPANY', 'purehtml');

define('EASE_LOGGER', 'syslog');
define('EASE_APPNAME', 'pureosc');
//define('SEO_ENABLED','false'); //uncommnent for debug only 
//Path to DB Error log, assumed HOME of apache user
define('DATABASE_ERRORS_LOG','/logs/db_error.log');
