<?php
//to be loaded before main configuration.php from application_top
$_SERVER['REQUEST_SCHEME'] = 'XREQUESTSCHEMEX'; // http | https
//$_SERVER['HTTP_HOST'] = 'example.org'; //no thirth domain = use default language; en.domain.com, cs.domain.com
$_SERVER['REMOTE_ADDR'] = '127.0.0.1';
define('DIR_FS_RELATIVE_CATALOG', 'catalog'); //WITHOUT ending slash '/'
define('MAX_DISPLAY_SEARCH_RESULTS','200'); // for static generator number should be bigger then dynamic shop, need to be adjusted

$remoteservers_arr = array('osc@192.168.2.57');
define('MAX_LOCK_TIME','500'); //seconds
define('RSYNCLOGGING','false');
$debug_level=1; //0 = nothing; 1 = essential 2 = partial 3 = all 4 = detailed
define('GENERATOR_FORCE_UPDATE_ALL', '0'); //0 = production, 1 = komplenti vynuceny
define('INITIAL_UPDATED','0');//0=production 1=debug HomePage generation
define('RSYNC_TO_REMOTE','0'); //1 = enable rsync to remote server
define('DISPLAY_GENERATOR_ERRORS','false'); 
//rsync
define('WGET_USER','osc');
define('WGET_PASSWORD','osc');
define('OSC_DIR','osc/');
define('RSYNC_LOCAL_SRC_PATH','XDIRFSMASTERROOTDIRX/'); //trailing slash at the end (/); Without including OSC_DIR!
define('DIR_FS_CONFIG','XDIRFSMASTERROOTDIRX/oscconfig/'); //trailing slash! '/'

//modules
define('GENERATE_PRODUCTS', 'true');
define('GENERATE_CATEGORIES', 'true');
define('GENERATE_MANUFACTURERS', 'true');
define('GENERATE_TOPICS', 'true');
define('GENERATE_ARTICLES', 'true');
define('GENERATE_INFORMATION', 'true');
define('GENERATE_MANUFACTURERS_INDEX', 'true');
define('GENERATE_PRODUCTS_NEW_PAGE', 'true');
define('GENERATE_DB_ERROR','true');
define('GENERATE_ROBOTS_TXT','true');
define('GENERATE_HOMEPAGE','true');
