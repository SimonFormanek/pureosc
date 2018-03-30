<?php
//TODO:presun do databaze - seo URLS config
//presun define('SESSION_FORCE_COOKIE_USE','True'); //bacha vyresit TODO
$remoteservers_arr = array('osc@192.168.8.57');
define('MAX_LOCK_TIME','500'); //seconds
define('PRODUCTS_CANONICAL_TYPE','path'); //config: path / manufacturer
define('RSYNCLOGGING','false');
$debug_level=3; //0 = nothing; 1 = essential 2 = partial 3 = all
define('GENERATOR_FORCE_UPDATE_ALL', '0'); //0 = production, 1 = komplenti vynuceny
define('RSYNC_TO_REMOTE','1'); //1 = enable rsync to remote server

//rsync
define('WGET_USER','osc');
define('WGET_PASSWORD','osc');
define('OSC_DIR','osc');
define('RSYNC_LOCAL_SRC_PATH','/home/f/git/osc/'); //trailing slash at the end (/); Without including OSC_DIR!
define('DIR_FS_CONFIG','/home/f/git/osc/oscconfig/'); //trailing slash! '/'


//old DEPRECATED>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
/*
define('SHOP_SERVER','http://oscstatic.local'); //www.oikoymenh.cz
define('HTML_CACHE_DIR', DIR_FS_DOCUMENT_ROOT . 'HTML/');
//define('SHOP_SERVER',HTTP_SERVER); //config if need <<<<<<<<
define('SERVER_INSTANCE','admin');
define('DIR_FS_CATALOG_SHOP_SERVER', '/home/atelierradostnetvorby_cz/osc/catalog/');


//git
//  define('GIT_USER', '');
//  define('GIT_SHOP_REPO', 'web');
//  define('GIT_SHOP_BRANCH', '');

//robot>>>>>>>>>>>>>>>>
//DEPRECATED $maxtime = 7; //minutes cron skip
//DEPRECATED $lng['id'] =4; //<< !! = english
//DEPRECATED $lockname = 'atelierradostnetvorbyCZ'; //<< !!
$reset_time = '0339';

$homedir='home';
$webnamedir='atelierradostnetvorby_cz';
$webnamedirSRC='atelierradostnetvorby';
$webnamedirDEST='atelierradostnetvorby_cz';
$wwwdir='osc';
$frontenddir='catalog';
$remoteeshop='192.168.2.55:/home/osc/WWW';

*/