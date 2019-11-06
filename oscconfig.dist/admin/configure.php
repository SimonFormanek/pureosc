<?php
//LANG dependent START 
if (!defined('DEFAULT_CURRENCY')) {
  define('DEFAULT_CURRENCY','CZK');
}
if (!defined('DEFAULT_LANGUAGE')) {
  define('DEFAULT_LANGUAGE','cs');
}
//LANG dependent END

define('PRODUCTS_CANONICAL_TYPE','path'); //config: path / manufacturer
//TODO: future ver define('CATALOG_DOMAIN', 'XCATALOGDOMAINX'); //TODO: www.eshop.cz Need changed: eshop.cz + dynamicaly en,fr,de added
define('CATALOG_DOMAIN', 'XCSDOMAINX');
define('CATALOG_ADMIN_DOMAIN', 'XADMINDOMAINX'); //new!!!!!!!
define('DIR_FS_MASTER_ROOT_DIR', 'XDIRFSMASTERROOTDIRX/'); //trailing slash YES, catalog subdir/catalog NO (!)
if (!defined('OSC_DIR')) {define('OSC_DIR','osc/');}
define('MYSQL_DEBUG', 'on'); //on|off=default 'on' set only for DEVEL debug !!!
if (!defined('MAX_DISPLAY_SEARCH_RESULTS')) {define('MAX_DISPLAY_SEARCH_RESULTS','30');} // > procucts count for all Products on one Page (controversal option)
define('SESSION_FORCE_COOKIE_USE', 'True');
if (!isset($_SERVER['REQUEST_SCHEME'])){
  $_SERVER['REQUEST_SCHEME'] ='https'; //productions: 'https' localhost: 'http' NEW!!!
  $_SERVER['HTTP_HOST'] = CATALOG_DOMAIN;
}
if ($_SERVER['REQUEST_SCHEME'] =='https') {
  $https = 'https';
  define('ENABLE_SSL', true);
  define('ENABLE_SSL_CATALOG', true);
} else {
  $https = 'http';
  define('ENABLE_SSL', false);
  define('ENABLE_SSL_CATALOG', false);
}
define('HTTP_SERVER', $https . '://' . $_SERVER['HTTP_HOST']);
define('HTTPS_SERVER', $https . '://' . $_SERVER['HTTP_HOST']);
define('HTTP_COOKIE_DOMAIN', '');
define('HTTPS_COOKIE_DOMAIN', '');
define('HTTP_COOKIE_PATH', '/admin');
define('HTTPS_COOKIE_PATH', '/admin');
define('HTTP_CATALOG_SERVER', $https . '://' . CATALOG_DOMAIN);
define('HTTPS_CATALOG_SERVER', $https . '://' . CATALOG_DOMAIN);
define('HTTP_CATALOG_ADMIN_SERVER', $https . '://' . CATALOG_ADMIN_DOMAIN);
define('HTTPS_CATALOG_ADMIN_SERVER', $https . '://' . CATALOG_ADMIN_DOMAIN);
define('DIR_FS_DOCUMENT_ROOT', DIR_FS_MASTER_ROOT_DIR . OSC_DIR . 'catalog/');
define('DIR_WS_ADMIN', '/admin/');
define('DIR_WS_HTTPS_ADMIN', '/admin/');
define('DIR_FS_ADMIN', DIR_FS_MASTER_ROOT_DIR . OSC_DIR . 'catalog/admin/');
define('DIR_WS_CATALOG', '/');
define('DIR_WS_HTTPS_CATALOG', '/');
define('DIR_FS_CATALOG', DIR_FS_MASTER_ROOT_DIR . OSC_DIR . '/catalog/');
define('DIR_WS_IMAGES', 'images/');
define('DIR_WS_ICONS', DIR_WS_IMAGES . 'icons/');
define('DIR_WS_CATALOG_IMAGES', DIR_WS_CATALOG . 'images/');
define('DIR_WS_INCLUDES', 'includes/');
define('DIR_WS_BOXES', DIR_WS_INCLUDES . 'boxes/');
define('DIR_WS_FUNCTIONS', DIR_WS_INCLUDES . 'functions/');
define('DIR_WS_CLASSES', DIR_WS_INCLUDES . 'classes/');
define('DIR_WS_MODULES', DIR_WS_INCLUDES . 'modules/');
define('DIR_WS_LANGUAGES', DIR_WS_INCLUDES . 'languages/');
define('DIR_WS_CATALOG_LANGUAGES', DIR_WS_CATALOG . 'includes/languages/');
define('DIR_FS_CATALOG_LANGUAGES', DIR_FS_CATALOG . 'includes/languages/');
define('DIR_FS_CATALOG_IMAGES', DIR_FS_MASTER_ROOT_DIR . OSC_DIR . 'catalog/images/');
define('DIR_FS_CATALOG_MODULES', DIR_FS_CATALOG . 'includes/modules/');
define('DIR_FS_BACKUP', DIR_FS_ADMIN . '../../data/backups/');
define('DIR_FS_DOWNLOAD', DIR_FS_CATALOG . 'download/');
define('DIR_FS_DOWNLOAD_PUBLIC', DIR_FS_CATALOG . 'pub/');
define('DIR_WS_DOWNLOAD_PUBLIC', 'pub/'); //??? je potreba?
define('WEBMASTER_EMAIL', '00420602604992@sms.cz.o2.com');

//DELEATUR!  define('MULTI_DATABASE','false'); //true if defined multipe databases
//local db

define('USE_PCONNECT', 'false');
define('STORE_SESSIONS', 'mysql');
define('CFG_TIME_ZONE', 'Europe/Prague'); // <------ need to bee configured
//DELEATUR!TODO-opravit aby fungovalo z DB  new_products stripe generator (catgories.php)
//DELEATUR?$imgWidth = 110;
//DELEATUR?$imgWidthSmall = 64;
//Path to DB Error log, assumed HOME of apache user
define('DATABASE_ERRORS_LOG','/logs/db_error.log');

//define('FLEXIBEE_URL', 'https://demo.flexibee.eu:5434');
/*
 * Uživatel FlexiBee API
 */
//define('FLEXIBEE_LOGIN', 'winstrom');
/*
 * Heslo FlexiBee API
 */
//define('FLEXIBEE_PASSWORD', 'winstrom');
/*
 * Společnost v FlexiBee
 */
//define('FLEXIBEE_COMPANY', 'demo');

define('EASE_LOGGER', 'syslog');
define('EASE_APPNAME', 'pureosc');
//define('SEO_ENABLED','false'); //uncommnent for debug only 
