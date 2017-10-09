<?php
define('DIR_FS_MASTER_ROOT_DIR','/home/f/git/osc/osc/');
  define('ENABLE_SSL_CATALOG', false);
  define('ENABLE_SSL', false);
  define('SERVER_INSTANCE','admin'); // admin or empty for shop ???? TODO

  define('HTTP_SERVER', 'http://' . $_SERVER['HTTP_HOST']); // <------ need to bee configured
  define('HTTPS_SERVER', 'https://' . $_SERVER['HTTP_HOST']); // <------ need to bee configured
  define('HTTP_COOKIE_DOMAIN', '');
  define('HTTPS_COOKIE_DOMAIN', '');
  define('HTTP_COOKIE_PATH', '/admin');
  define('HTTPS_COOKIE_PATH', '/admin');
  define('HTTP_CATALOG_SERVER', 'http://' . $_SERVER['HTTP_HOST']); // <------ need to bee configured
  define('HTTPS_CATALOG_SERVER', 'https://' . $_SERVER['HTTP_HOST']); // <------ need to bee configured
  define('DIR_FS_DOCUMENT_ROOT', DIR_FS_MASTER_ROOT_DIR); // <------ need to bee configured
  define('DIR_WS_ADMIN', '/admin/');
  define('DIR_WS_HTTPS_ADMIN', '/admin/');// <------ need to bee configured SECURITY: obfuscation
  define('DIR_FS_ADMIN', DIR_FS_MASTER_ROOT_DIR . 'admin/'); //  <------ need to bee configured SECURITY: obfuscation
  define('DIR_WS_CATALOG', '/');
  define('DIR_WS_HTTPS_CATALOG', '/');
  define('DIR_FS_CATALOG', DIR_FS_MASTER_ROOT_DIR); // <------ need to bee configured
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
  define('DIR_FS_CATALOG_IMAGES', DIR_FS_MASTER_ROOT_DIR . 'images/'); // <------ need to bee configured
  define('DIR_FS_CATALOG_MODULES', DIR_FS_CATALOG . 'includes/modules/');
  define('DIR_FS_BACKUP', DIR_FS_ADMIN . '../../data/backups/');
  define('DIR_FS_DOWNLOAD', DIR_FS_CATALOG . 'download/');
  define('DIR_FS_DOWNLOAD_PUBLIC', DIR_FS_CATALOG . 'pub/');

//  define('MULTI_DATABASE','false'); //true if defined multipe databases
//local db

  define('USE_PCONNECT', 'false');
  define('STORE_SESSIONS', 'mysql');
  define('CFG_TIME_ZONE', 'Europe/Prague'); // <------ need to bee configured

//SMAZAT? new_products stripe generator (catgories.php)
$imgWidth = 110;
$imgWidthSmall = 64;
//unused:$imgFixedHeight = 190; //vyska obr pro tapetu
//unused:$imgFixedHeightSmall = 110; //vyska obr pro tapetu MALY
//define('DEFAULT_PRODUCT_TEMPLATE','2'); //1 = product 2 = arricle

//  define('SHOP_KEYS_PATH','/home/printondemand/shop_keys/'); //SECURITY WARNING: need to bee obfuscated 
//  define('ADMIN_PRIVATE_KEYS_PATH','/home/printondemand/admin_private_keys/'); //SECURITY WARNING: on production environement save keys on removable media
//  define('DB_SERVER_USERNAME_PREFIX','os'); //2 chars
