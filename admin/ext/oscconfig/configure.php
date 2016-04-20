<?php
  define('MYSQL_DEBUG','off'); // on/off = set to 'on' for user rights problems


  define('CUSTOMERS_KEY_PATH','/home/f/git/pureosc/shop_keys/customers_keys/'); //SECURITY WARNING: need to bee obfuscated 
  define('CUSTOMERS_ADMIN_PUBLIC_KEY_PATH','/home/f/git/pureosc/shop_keys/admin_public_keys/'); //SECURITY WARNING: on production environement save keys on removable media
  define('SERVER_INSTANCE','admin'); // admin or empty for shop

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
  define('DIR_WS_IMAGES', 'http://images.pureosc/'); // <------ need to bee configured
  define('DIR_WS_ICONS', 'icons/');
  define('DIR_WS_INCLUDES', 'includes/');
  define('DIR_WS_FUNCTIONS', DIR_WS_INCLUDES . 'functions/');
  define('DIR_WS_CLASSES', DIR_WS_INCLUDES . 'classes/');
  define('DIR_WS_MODULES', DIR_WS_INCLUDES . 'modules/');
  define('DIR_WS_LANGUAGES', DIR_WS_INCLUDES . 'languages/');

  define('DIR_WS_DOWNLOAD_PUBLIC', 'pub/');
  define('DIR_FS_CATALOG', '/home/f/git/pureosc/osc_devel/');
  define('DIR_FS_DOWNLOAD', DIR_FS_CATALOG . 'download/');
  define('DIR_FS_DOWNLOAD_PUBLIC', DIR_FS_CATALOG . 'pub/');

  define('DB_SERVER_USERNAME_PREFIX','po'); //2 chars
  define('USE_PCONNECT', 'false'); 
  define('STORE_SESSIONS', 'mysql'); 
  define('CFG_TIME_ZONE', 'Europe/Prague'); // <------ need to bee configured
?>