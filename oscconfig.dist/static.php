<?php
//to be loaded before main configuration.php from application_top
$_SERVER['REQUEST_SCHEME'] = 'http'; // http | https
$_SERVER['HTTP_HOST'] = 'example.org'; //no thirth domain = use default language; en.domain.com, cs.domain.com

define('DIR_FS_RELATIVE_CATALOG', 'catalog'); //WITHOUT ending slash '/'
define('MAX_DISPLAY_SEARCH_RESULTS','3000'); // > procucts count for all Products on one Page (controversal option)

$remoteservers_arr = array('osc@192.168.2.57');
define('MAX_LOCK_TIME','500'); //seconds
define('RSYNCLOGGING','false');
$debug_level=3; //0 = nothing; 1 = essential 2 = partial 3 = all
define('GENERATOR_FORCE_UPDATE_ALL', '0'); //0 = production, 1 = komplenti vynuceny
define('INITIAL_UPDATED','0');//0=production 1=debug HomePage generation
define('RSYNC_TO_REMOTE','0'); //1 = enable rsync to remote server

//rsync
define('WGET_USER','osc');
define('WGET_PASSWORD','osc');
define('OSC_DIR','osc/');
define('RSYNC_LOCAL_SRC_PATH','/home/user/git/pureosc/'); //trailing slash at the end (/); Without including OSC_DIR!
define('DIR_FS_CONFIG','/home/user/git/pureosc/oscconfig/'); //trailing slash! '/'

//modules
define('GENERATE_PRODUCTS', 'false');
define('GENERATE_CATEGORIES', 'false');
define('GENERATE_MANUFACTURERS', 'false');
define('GENERATE_TOPICS', 'false');
define('GENERATE_ARTICLES', 'false');
define('GENERATE_INFORMATION', 'false');
