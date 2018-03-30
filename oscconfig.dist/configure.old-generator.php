<?php
  define('DIR_FS_CATALOG', '/home/f/git/osc/osc/');

if (!defined(SERVER_INSTANCE)) define('SERVER_INSTANCE','admin'); //CONFIGURE: admin|shop <------ need to bee configured
define('GENERATOR_INSTANCE','true'); // set to 'true'for generator dir set 'false' for shop or admin  <------ need to bee configured ! ! !
if (GENERATOR_INSTANCE == 'false') {
define('SESSION_FORCE_COOKIE_USE', 'False');
define('USE_SEO_REDIRECT','true'); //false
} else {
define('SESSION_FORCE_COOKIE_USE', 'True');
define('USE_SEO_REDIRECT','false'); //TODO: experimental: test all possible urls for 'true' othervise set to 'false'
}
  define('MYSQL_DEBUG','on'); //on|off=default 'on' set only for DEVEL debug !!!
//  define('CSS_DEVEL_MODE','1');// empty =  NO
//  define('SHOP_KEYS_PATH','/home/printondemand/shop_keys/'); //SECURITY WARNING: need to bee obfuscated 

  define('HTTP_SERVER', 'http://' . $_SERVER['HTTP_HOST']);
  define('HTTPS_SERVER', 'https://' . $_SERVER['HTTP_HOST']);
  define('HTTP_COOKIE_DOMAIN', $_SERVER['HTTP_HOST']);
  define('HTTPS_COOKIE_DOMAIN', $_SERVER['HTTP_HOST']);
  define('ENABLE_SSL', false); // <------ need to bee configured
  define('HTTP_COOKIE_PATH', '/');
  define('HTTPS_COOKIE_PATH', '/');
  define('DIR_WS_HTTP_CATALOG', '/');
  define('DIR_WS_HTTPS_CATALOG', '/');
  define('DIR_WS_IMAGES', 'images/');
#  define('DIR_WS_IMAGES', 'http://images.knizninovinky/'); // <------ need to bee configured
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
