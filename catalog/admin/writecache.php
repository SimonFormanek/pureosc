#!/usr/bin/php -q
<?php
function cache_reset($group) {
            tep_db_query("DELETE FROM cache WHERE cache_name = 'seo_urls_v2_" . $group . "'");
            tep_db_query("UPDATE configuration SET configuration_value='false' WHERE configuration_key='SEO_URLS_CACHE_RESET'");
}
chdir('../');
$error = 0;
$_SERVER['HTTP_ACCEPT_LANGUAGE'] = $argv[1];
$_GET['language'] = $argv[1];
/*
TODO: manufacturers_page platon/index.php - Mon 11 Mar 2019 02:30:38 AM CET

//TEST_ME =vyzkouset
NNN old new problematic 

  CONFIG TODO:
  SESSION_FORCE_COOKIE_USE -> False, projit vsechny moznosti, jestli to nekde nevadi
  TODO:
  if ($updated == 1) TOHLE SPUSTIT !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
  TODO: ODKOMENTOVAT
  + odkomentovat smycku na konci

  1. class je potreba doplnit o tabulku jazyku
  nove ke smazani: PURE:smazat !!!!!!!!!!!!!!
  opravit NEW_TODO !!!!!!!!!!!!!!!!!!
 */

//define in first place SERVER_INSTANCE if $argv[2], othervise: 1. load from config/LANG/static.php or config/configure.php
//and include lang dependent shop/admin configuration file
if ($argv[2] == 'admin') {
    $cached_flag = 'cached_admin';
    if (file_exists('../../oscconfig/languages/'.$argv[1].'/static_admin.php')) {
        include('../../oscconfig/languages/'.$argv[1].'/static_admin.php');
    } else {
        echo "Static ADMIN configuration file not found\n";
        exit;
    }
} else {
    $cached_flag = 'cached';
    if (file_exists('../../oscconfig/languages/'.$argv[1].'/static_shop.php')) {
        include('../../oscconfig/languages/'.$argv[1].'/static_shop.php');
    } else {
        echo "Static SHOP configuration file not found\n";
        exit;
    }
}
//now include common static generator
if (file_exists('../../oscconfig/static.php')) {
    include('../../oscconfig/static.php');
} else {
    echo "Static CORE configuration file not found\n";
    exit;
}
if ($argv[2] == 'admin') {
    $chdir_dest_dir = RSYNC_LOCAL_DEST_PATH . DIR_FS_RELATIVE_CATALOG;
} else {
    $chdir_dest_dir = RSYNC_REMOTE_DEST_DIR . DIR_FS_RELATIVE_CATALOG;
}
require('includes/application_top.php');
//echo config vars
if ($debug_level > 2){
  echo 'GENERATOR_FORCE_UPDATE_ALL: ' . GENERATOR_FORCE_UPDATE_ALL . "\n";
  echo '$_SERVER[REQUEST_SCHEME]: ' . $_SERVER['REQUEST_SCHEME'] . "\n";
  echo '$_SERVER[HTTP_HOST]: ' . $_SERVER['HTTP_HOST'] . "\n";
}
//TODO: bude tady neco??????
//require('admin/'. DIR_WS_FUNCTIONS . 'cli.php');
//TODO: presunout /languages/LANG/static.php do DTB config
if (DISPLAY_GENERATOR_ERRORS == 'true') {
	error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
ini_set('display_errors', '1');
}
//////////////CONF START <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
$time1                = microtime(true);
date_default_timezone_set("Europe/Prague");
$information_group_id = 1;
$updated              = INITIAL_UPDATED;

//language_id
$lng_querey = tep_db_query("SELECT languages_id FROM ".TABLE_LANGUAGES." WHERE code ='".$argv[1]."'");
$lng        = tep_db_fetch_array($lng_querey);
$context    = stream_context_create(array(
    'http' => array(
        'header' => "Authorization: Basic ".base64_encode(WGET_USER.':'.WGET_PASSWORD)
    )
    ));

//////////////CONF END <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
//exit if lockfile exists, exis or create lock
$minute = date("Hi");
//if (SERVER_INSTANCE =='shop') {
if (!file_exists('../../cronlock')) {
  mkdir('../../cronlock', 0777);
}
if (file_exists('../../cronlock/'.$argv['1'].'.'.$argv['2'])) {
//TODO: if lock wait too long send error message and restart
    $oldlock = file_get_contents('../../cronlock/'.$argv['1'].'.'.$argv['2']);
    $oldlock = $oldlock + MAX_LOCK_TIME;
    echo '$oldlock:'.$oldlock."\n";
    echo '$_SERVER[\'REQUEST_TIME\']:'.$_SERVER['REQUEST_TIME']."\n";
    if ($oldlock > $_SERVER['REQUEST_TIME']) {
        echo 'Lockfile Exists, Exiting!'."\n";
        exit;
    } else {
       echo 'Err: GeneratorTimeout, Exiting'."\n";
       mail(WEBMASTER_EMAIL,
         'Err: GeneratorTimeout ' . HTTPS_COOKIE_DOMAIN,
         'Static Export CANCELLED!');
        unlink('../../cronlock/'.$argv['1'].'.'.$argv['2']);
        echo "ERROR: Lock Timeout, unlocked killall????\n";
        sleep(2);
        echo 'killing croncache & writecache';
        shell_exec("killall croncache.php;killall writecache.php");
        exit;
    }
} else {
    file_put_contents('../../cronlock/'.$argv['1'].'.'.$argv['2'],
        $_SERVER['REQUEST_TIME']);
}
//TODO:move to configure.php
if (!file_exists('../../crontime')) {
  mkdir('../../crontime', 0777);
}
if (!file_exists('../../crontime/'.$argv['1'].'.'.$argv['2']))
        file_put_contents('../../crontime/'.$argv['1'].'.'.$argv['2'], '0301');
$crontime = (int) file_get_contents('../../crontime/'.$argv['1'].'.'.$argv['2']);
if ($debug_level > 2) echo 'crontime: ' . $crontime . "\n";
if ($debug_level > 2) echo 'Conf. loaded OK'."\n";

/*
  } else {
  //ADMIN:
  if (file_exists('../../cronlock/' . $argv['1'] . '_admin')){
  //TODO: if lock wait too long send error message and restart
  echo 'EXITING: lockfile EXISTS!' . "\n";
  exit;
  } else {
  file_put_contents('../../cronlock/' . $argv['1'] . '_admin',$minute);
  }
  $crontime = (int)file_get_contents('../../crontime/' . $argv['1'] . '_admin.cron');
  echo 'Conf. loaded OK' ."\n";
  }
 */
//CACHE RESET ---------------------------------------------------------------------------------->
//check for reset needed:
$update_all             = 'false';

//crontime
if (date("Hi") == $crontime ) {
echo 'Big Update Daily cron time: ' . date("Hi") . "\n";
$update_all             = 'true';
}
if ($debug_level > 2) echo 'update_all0:' . $update_all . "\n";  
//information - one change require reset
$information_reset_query = tep_db_query("select COUNT(cached) as counter from information where ".$cached_flag."=0 AND language_id=".$lng['languages_id']);
if ($debug_level > 2) echo("select COUNT(cached) as counter from information where ".$cached_flag."=0 AND language_id=".$lng['languages_id']) . "\n";
$information_reset       = tep_db_fetch_array($information_reset_query);
if ($information_reset['counter'] > 0) $update_all             = 'true';
if ($debug_level > 2) echo 'update_all1:' . $update_all . "\n";  
//nowtime: special full update NOW
//$cron_query = tep_db_query("SELECT * FROM " . TABLE_ROBOT . " WHERE lang = '" . $argv['1'] . "' AND admin = '" . $argv['2'] . "'");
$reset_query = tep_db_query("SELECT reset FROM ".TABLE_RESET." WHERE lang = '".$argv['1']."' AND admin = '".$argv['2']."' AND section='all'");
$reset       = tep_db_fetch_array($reset_query);
if ($reset['reset'] == 1) {
    echo 'Big Reset!'."\n";
    $update_all = 'true';
    tep_db_query("UPDATE ".TABLE_RESET." SET reset='0' WHERE lang = '".$argv['1']."' AND admin = '".$argv['2']."' AND section='all'");
}
if ($debug_level > 2) echo 'update_all2:' . $update_all . "\n";

if ($update_all == 'true' || GENERATOR_FORCE_UPDATE_ALL == '1') {
//creating lockfile
    echo "big upd. START\n";
    echo "cas: ".date("H:i:s")."\n";
    tep_db_query("UPDATE ".TABLE_PRODUCTS_DESCRIPTION." SET ".$cached_flag." = 0 WHERE language_id =".$lng['languages_id']);
    tep_db_query("UPDATE ".TABLE_CATEGORIES_DESCRIPTION." SET ".$cached_flag." = 0 WHERE language_id =".$lng['languages_id']);
    tep_db_query("UPDATE ".TABLE_ARTICLES_DESCRIPTION." SET ".$cached_flag." = 0 WHERE language_id =".$lng['languages_id']);
    tep_db_query("UPDATE ".TABLE_INFORMATION." SET ".$cached_flag." = 0 WHERE language_id =".$lng['languages_id']);
    tep_db_query("UPDATE ".TABLE_MANUFACTURERS_INFO." SET ".$cached_flag." = 0 WHERE languages_id =".$lng['languages_id']);
    tep_db_query("UPDATE ".TABLE_TOPICS_DESCRIPTION." SET ".$cached_flag." = 0 WHERE language_id =".$lng['languages_id']);
    if ($debug_level > 2) echo "Action: Cleaning destination\n";
    shell_exec('rsync -av --exclude-from  ' . DIR_FS_CONFIG . 'exclude_local.txt ' . RSYNC_LOCAL_SRC_PATH . OSC_DIR . ' ' . RSYNC_LOCAL_DEST_PATH . OSC_DIR . ' --delete --delete-excluded');
    echo 'rsync-empty: rsync -av --exclude-from  ' . DIR_FS_CONFIG . 'exclude_local.txt ' . RSYNC_LOCAL_SRC_PATH . OSC_DIR . ' ' . RSYNC_LOCAL_DEST_PATH . OSC_DIR . ' --delete --delete-excluded' . "\n";
    //TODO: auto create composer.catalog-only
    if ($argv[2] == 'admin') {
          copy(RSYNC_LOCAL_SRC_PATH . OSC_DIR . 'composer.json', RSYNC_LOCAL_DEST_PATH . OSC_DIR . 'composer.json');
    } else {
          copy(RSYNC_LOCAL_SRC_PATH . OSC_DIR . 'composer.catalog-only-template.json', RSYNC_LOCAL_DEST_PATH . OSC_DIR . 'composer.json');
    }
} else {
    if ($debug_level > 2) echo "Action: updating...\n";
}
if (GENERATE_PRODUCTS == 'true') {
if ($debug_level > 2) echo "GENERATING_PRODUCTS\n";

if (PRODUCTS_CANONICAL_TYPE == 'path') {
    if ($debug_level > 2) echo "Debug: PRODUCTS_CANONICAL_TYPE = 'path'\n";
    $products_query = tep_db_query("SELECT p.products_id
	FROM ".TABLE_PRODUCTS." p, ".TABLE_PRODUCTS_DESCRIPTION." pd
	WHERE 
		products_status=1 
		AND p.products_id = pd.products_id 
		AND pd.".$cached_flag." = 0
		AND pd.language_id = '".$lng['languages_id']."'");
} else { //type=manufacturer
    if ($debug_level > 2) echo "Debug: PRODUCTS_CANONICAL_TYPE = 'manufacturer'\n";
    $products_query = tep_db_query("SELECT p.products_id, products_model, products_name, manufacturers_name
      FROM " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION ." pd, " . TABLE_MANUFACTURERS . " m
      WHERE
      products_status=1
      AND p.products_id = pd.products_id
      AND p.manufacturers_id = m.manufacturers_id
      AND pd." . $cached_flag . " = 0
      AND language_id = '" . $lng['languages_id']. "'
      ");
}
    while ($products = tep_db_fetch_array($products_query)) {
        if (tep_db_num_rows($products_query)) {
          cache_reset('PRODUCTS');

            //select only products from active categories (sort_order > 0):
            if (PRODUCTS_CANONICAL_TYPE == 'path') {
            if (SERVER_INSTANCE == 'shop') {
                $inactive_query = tep_db_query("SELECT sort_order FROM ".TABLE_CATEGORIES." c, ".TABLE_PRODUCTS_TO_CATEGORIES." p2c WHERE 
                c.categories_id = p2c.categories_id AND canonical = '1' AND p2c.products_id = ".$products['products_id']);
                $inactive       = tep_db_fetch_array($inactive_query);
                if ($inactive['sort_order'] == 0) {
                    if ($debug_level > 2)
                            echo "id NEAKT:".$products['products_id'] . "\n";
                    continue;
                }
            }
            } else {
            //TODO inactive 
            if ($debug_level > 2) echo 'TODO: manufacturers type ...' ."\n";
            }
            if (PRODUCTS_CANONICAL_TYPE == 'path') {
            $canonical_category_query = tep_db_query("SELECT categories_id FROM ".TABLE_PRODUCTS_TO_CATEGORIES." WHERE canonical = '1' AND products_id=".$products['products_id']);
            $canonical_category       = tep_db_fetch_array($canonical_category_query);
            if ($canonical_category['categories_id'] > 0) {
                if ($debug_level > 2)
                        echo "canonical je: ".tep_get_category_path($canonical_category['categories_id'])."Produkt:".$products['products_id']."\n";
            } else {
                echo "ERROR: Canonical not found Products_id: ".$products['products_id']."\n";
            continue; //TEST_ME
            }
            }
            if (PRODUCTS_CANONICAL_TYPE == 'path') { 
            $newpath = RSYNC_LOCAL_DEST_PATH . OSC_DIR . DIR_FS_RELATIVE_CATALOG .str_replace(HTTP_SERVER, '', tep_href_link(FILENAME_PRODUCT_INFO, 'cPath=' . tep_get_category_path($canonical_category['categories_id']) . '&products_id=' . $products['products_id'])) . "/";
            } else {
            $manufurl = preg_replace('/(-[a-z])*$/','',remove_accents($products['manufacturers_name']));
            if ($products['products_model'] !='') $model = '-' . $products['products_model']; else $model = '';
            $newpath = RSYNC_LOCAL_DEST_PATH . OSC_DIR . DIR_FS_RELATIVE_CATALOG . '/' . $manufurl . '/' . remove_accents($products['products_name']) . $model . '/';
            }
            if ($debug_level > 2){
            	echo 'newpath Prods:' .$newpath . "\n"; 
            }
            if (!is_dir($newpath)) {
                shell_exec('mkdir -p '.$newpath);
            }
            if (PRODUCTS_CANONICAL_TYPE == 'path') { 
      $hta_content = 'RewriteEngine On
      RewriteBase /
      RewriteCond %{HTTP_COOKIE} osCsid=(.*) [NC]
			RewriteRule ^$ /product_info.php?cPath='.tep_get_category_path($canonical_category['categories_id']).'&products_id='.$products['products_id'] . '&language=' . $_GET['language'] . ' [QSA,L]
			RewriteCond %{QUERY_STRING} (.*)=(.*) [NC]
			RewriteRule ^$ /product_info.php?cPath='.tep_get_category_path($canonical_category['categories_id']).'&products_id='.$products['products_id'] . '&language=' . $_GET['language'] . ' [QSA,L]
			';
     file_put_contents($newpath . '.htaccess', $hta_content, 644);

/*            
            <\?php
if (isset(\$_COOKIE['osCsid']) || !empty(\$_POST) || !empty(\$_GET['osCsid'])){
chdir('".$chdir_dest_dir."');
\$_GET['cPath']='".tep_get_category_path($canonical_category['categories_id'])."';
\$_GET['products_id']=".$products['products_id'].";
\$_SERVER['PHP_SELF'] = '".FILENAME_PRODUCT_INFO."';
include('".FILENAME_PRODUCT_INFO."');
exit;
}
?>
";
*/
} else {
            $output      = "<\?php
if (isset(\$_COOKIE['osCsid']) || !empty(\$_POST) || !empty(\$_GET['osCsid'])){
chdir('".$chdir_dest_dir."');
\$_GET['products_id']=".$products['products_id'].";
\$_SERVER['PHP_SELF'] = '".FILENAME_PRODUCT_INFO."';
include('".FILENAME_PRODUCT_INFO."');
exit;
}
?>
";
}
            //create static
            $curl_handle = curl_init();
            curl_setopt($curl_handle, CURLOPT_URL,
                HTTP_SERVER.'/product_info.php?cPath='.tep_get_category_path($canonical_category['categories_id']).'&products_id='.$products['products_id'] . '&language=' . $_GET['language']);
            curl_setopt($curl_handle, CURLOPT_USERPWD,
                WGET_USER.":".WGET_PASSWORD);
            curl_setopt($curl_handle, CURLOPT_USERAGENT, 'wget');
            curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
            curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
            $output      = curl_exec($curl_handle);
            curl_close($curl_handle);
    $output = filtr($output);
            file_put_contents($newpath . 'index.html.gz', gzencode(stripslashes($output), 9), 644);
            if (preg_match("/<\/html>/", gzdecode(file_get_contents($newpath . 'index.html.gz')))) {
              tep_db_query("UPDATE ".TABLE_PRODUCTS_DESCRIPTION." SET ".$cached_flag." = 1 WHERE products_id = ".$products['products_id']." AND language_id = ".$lng['languages_id']);
              $updated     = 1;
            } else {
              $error = 1;
              echo "Error: Product:" . $products['products_id'] . " \n";
            }
        }
    }
} //end GENERATE_PRODUCTS

if (GENERATE_CATEGORIES == 'true') {
if ($debug_level > 2) echo "GENERATING CATEGORIES\n";
$categories_query = tep_db_query("SELECT c.categories_id, cd.categories_name FROM ".TABLE_CATEGORIES." c,  ".TABLE_CATEGORIES_DESCRIPTION." cd 
    WHERE cd.categories_id = c.categories_id 
    AND ".$cached_flag." = 0 
    AND language_id = '".$lng['languages_id']."' 
    AND sort_order > 0");
while ($categories       = tep_db_fetch_array($categories_query)) {
    if (tep_db_num_rows($categories_query)) {
    	  cache_reset('CATEGORIES');
        if ($debug_level > 2)
                echo 'cPath:'.tep_get_category_path($categories['categories_id'])."\n";
        $newpath = RSYNC_LOCAL_DEST_PATH.OSC_DIR.DIR_FS_RELATIVE_CATALOG.str_replace(HTTP_SERVER, '',
                tep_href_link(FILENAME_DEFAULT,
                    'cPath='.$categories['categories_id']))."/";

        if (!is_dir($newpath)) {
            shell_exec('mkdir -p '.$newpath);
        }
      $hta_content = 'RewriteEngine On
      RewriteBase /
      RewriteCond %{HTTP_COOKIE} osCsid=(.*) [NC]
			RewriteRule ^$ /index.php?cPath='.tep_get_category_path($categories['categories_id']) . '&language=' . $_GET['language'] . ' [QSA,L]
			RewriteCond %{QUERY_STRING} (.*)=(.*) [NC]
			RewriteRule ^$ /index.php?cPath='.tep_get_category_path($categories['categories_id']) . '&language=' . $_GET['language'] . ' [QSA,L]
			';
     file_put_contents($newpath . '.htaccess', $hta_content, 644);

/*        $output      = "<\?php
if (isset(\$_COOKIE['osCsid']) || !empty(\$_POST) || !empty(\$_GET['osCsid'])){
chdir('".$chdir_dest_dir."');
\$_GET['cPath']='".tep_get_category_path($categories['categories_id'])."';
\$_SERVER['PHP_SELF'] = '".FILENAME_DEFAULT."';
include('".FILENAME_DEFAULT."');
exit;
}
?>
";
*/        //create static
        $curl_handle = curl_init();
//		curl_setopt($curl_handle, CURLOPT_URL, HTTP_SERVER . '/product_info.php?products_id=' . $products['products_id']);
//			curl_setopt($curl_handle, CURLOPT_URL, HTTP_SERVER . '/index.php?cPath=1');
//orig			curl_setopt($curl_handle, CURLOPT_URL, HTTP_SERVER . '/index.php?cPath=' . $categories['categories_id']);
        curl_setopt($curl_handle, CURLOPT_URL,
            HTTP_SERVER.'/index.php?cPath='.tep_get_category_path($categories['categories_id'] . '&language=' . $_GET['language']));
        curl_setopt($curl_handle, CURLOPT_USERPWD, WGET_USER.":".WGET_PASSWORD);
        curl_setopt($curl_handle, CURLOPT_USERAGENT, 'wget');
        curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        $output      = curl_exec($curl_handle);
        curl_close($curl_handle);
    $output = filtr($output);
            file_put_contents($newpath . 'index.html.gz', gzencode(stripslashes($output), 9), 644);
            if (preg_match("/<\/html>/", gzdecode(file_get_contents($newpath . 'index.html.gz')))) {
              tep_db_query("UPDATE ".TABLE_CATEGORIES_DESCRIPTION." SET ".$cached_flag." = 1 WHERE categories_id = ".$categories['categories_id']." AND language_id = ".$lng['languages_id']);
              $updated     = 1;
            } else {
              $error = 1;
              echo "Error: Category:" . $categories['categories_id'] . " \n";
            }
    }
}
} //end GENERATE_CATEGORIES

if (GENERATE_MANUFACTURERS == 'true') {

  if ($debug_level>2) echo "GENERATING_MANUFACTURERS\n";
  $manufacturers_query = tep_db_query("SELECT m.manufacturers_id, manufacturers_name  FROM " . TABLE_MANUFACTURERS . " m, " . TABLE_MANUFACTURERS_INFO . " mi
  WHERE
  m.manufacturers_id = mi.manufacturers_id
  AND mi." . $cached_flag . " = 0
  AND languages_id = '" . $lng['languages_id']. "'");

  while ($manufacturers = tep_db_fetch_array($manufacturers_query)) {
  if (tep_db_num_rows($manufacturers_query)) {
  if ($debug_level > 2) echo "RESETTING MANUFACTURERS\n";
//TODO:    cache_reset('MANUFACTURERS'); //TODO: cache error zustane stara verze (cache disabled)
//  $newpath = preg_replace('/(-[a-z])*$/','',remove_accents($manufacturers['manufacturers_name']));
      $newpath = RSYNC_LOCAL_DEST_PATH.OSC_DIR.DIR_FS_RELATIVE_CATALOG.str_replace(HTTP_SERVER, '',
                tep_href_link(FILENAME_DEFAULT,
                    'manufacturers_id='.$manufacturers['manufacturers_id']))."/";
echo '2>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>' . $newpath . "\n";
        if (!is_dir($newpath)) {
            shell_exec('mkdir -p '.$newpath);
        }
  
      $hta_content = 'RewriteEngine On
      RewriteBase /
      RewriteCond %{HTTP_COOKIE} osCsid=(.*) [NC]
			RewriteRule ^$ /index.php?manufacturers_id=' . $manufacturers['manufacturers_id'] . '&language=' . $_GET['language'] . ' [QSA,L]
			RewriteCond %{QUERY_STRING} (.*)=(.*) [NC]
			RewriteRule ^$ /index.php?manufacturers_id=' . $manufacturers['manufacturers_id'] . '&language=' . $_GET['language'] . ' [QSA,L]
			';
     file_put_contents($newpath . '.htaccess', $hta_content, 644);
/*
        $output      = "<\?php
if (isset(\$_COOKIE['osCsid']) || !empty(\$_POST) || !empty(\$_GET['osCsid'])){
chdir('".$chdir_dest_dir."');
\$_GET['manufacturers_id']=".$manufacturers['manufacturers_id'].";
\$_SERVER['PHP_SELF'] = '" . FILENAME_DEFAULT . "';
include('" . FILENAME_DEFAULT ."');
exit;
}
?>
";
*/
            //create static
            $curl_handle = curl_init();
            curl_setopt($curl_handle, CURLOPT_URL,
                HTTP_SERVER.'/index.php?manufacturers_id=' . $manufacturers['manufacturers_id'] . '&language=' . $_GET['language']);
            curl_setopt($curl_handle, CURLOPT_USERPWD,
                WGET_USER.":".WGET_PASSWORD);
            curl_setopt($curl_handle, CURLOPT_USERAGENT, 'wget');
            curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
            curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
            $output      = curl_exec($curl_handle);
            curl_close($curl_handle);
    				$output = filtr($output);
            file_put_contents($newpath . 'index.html.gz', gzencode(stripslashes($output), 9), 644);
            if (preg_match("/<\/html>/", gzdecode(file_get_contents($newpath . 'index.html.gz')))) {
              tep_db_query("UPDATE " . TABLE_MANUFACTURERS_INFO . " SET " . $cached_flag . " = 1 WHERE manufacturers_id = " . $manufacturers['manufacturers_id'] . " AND languages_id = " . $lng['languages_id']);
              $updated     = 1;
            } else {
              $error = 1;
              echo "Error: Manufacturer:" . $manufacturers['manufacturers_id'] . " \n";
            }
    }
}
} //end GENERATE_MANUFACTURERS

if (GENERATE_TOPICS == 'true') {
if ($debug_level > 2) echo "GENERATING TOPICS\n";
$topics_query = tep_db_query("SELECT topics_id, topics_name FROM ".TABLE_TOPICS_DESCRIPTION." td
    WHERE 
    ".$cached_flag." = 0 
    AND language_id = '".$lng['languages_id']."'");
while ($topics       = tep_db_fetch_array($topics_query)) {
    if (tep_db_num_rows($topics_query)) {
        $newpath = RSYNC_LOCAL_DEST_PATH.OSC_DIR.DIR_FS_RELATIVE_CATALOG . str_replace(HTTP_SERVER, '', tep_href_link(FILENAME_ARTICLES, 'tPath='.$topics['topics_id']))."/"; //NEW??
        if (!is_dir($newpath)) {
            shell_exec('mkdir -p '. $newpath);
        }
      $hta_content = 'RewriteEngine On
      RewriteBase /
      RewriteCond %{HTTP_COOKIE} osCsid=(.*) [NC]
			RewriteRule ^$ /articles.php?cPath='.tep_get_topic_path($topics['topics_id']) . '&language=' . $_GET['language'] . ' [QSA,L]
			RewriteCond %{QUERY_STRING} (.*)=(.*) [NC]
			RewriteRule ^$ /articles.php?cPath='.tep_get_topic_path($topics['topics_id']) . '&language=' . $_GET['language'] . ' [QSA,L]
			';
     file_put_contents($newpath . '.htaccess', $hta_content, 644);

/*        $output      = "<\?php
if (isset(\$_COOKIE['osCsid']) || !empty(\$_POST) || !empty(\$_GET['osCsid'])){
chdir('".$chdir_dest_dir."');
\$_GET['tPath']=".$topics['topics_id'].";
\$_SERVER['PHP_SELF'] = '".FILENAME_ARTICLES."';
include('".FILENAME_ARTICLES."');
exit;
}
?>
";
*/  
      //create static
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL,
            HTTP_SERVER.'/'.FILENAME_ARTICLES.'?tPath='.$topics['topics_id'] . '&language=' . $_GET['language']);
        curl_setopt($curl_handle, CURLOPT_USERPWD, WGET_USER.":".WGET_PASSWORD);
        curl_setopt($curl_handle, CURLOPT_USERAGENT, 'wget');
        curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        $output      = curl_exec($curl_handle);
        curl_close($curl_handle);
    $output = filtr($output);
            file_put_contents($newpath . 'index.html.gz', gzencode(stripslashes($output), 9), 644);
            if (preg_match("/<\/html>/", gzdecode(file_get_contents($newpath . 'index.html.gz')))) {
        tep_db_query("UPDATE ".TABLE_TOPICS_DESCRIPTION." SET ".$cached_flag." = 1 WHERE topics_id = ".$topics['topics_id']." AND language_id = ".$lng['languages_id']);
              $updated     = 1;
            } else {
              $error = 1;
              echo "Error: Topics:" . $topics['topics_id'] . " \n";
            }
    }
}
} //end GENERATE_TOPICS

if (GENERATE_ARTICLES == 'true') {
if ($debug_level > 2) echo "GENERATING ARTICLES\n";

//TODO: generate admin version articles_status=0
$articles_query = tep_db_query("SELECT a.articles_id, articles_name FROM ".TABLE_ARTICLES." a, ".TABLE_ARTICLES_DESCRIPTION." ad 
    WHERE 
    articles_status=1
    AND a.articles_id= ad.articles_id 
    AND ".$cached_flag." = 0
    AND language_id = '".$lng['languages_id']."'");
while ($articles       = tep_db_fetch_array($articles_query)) {
    if (tep_db_num_rows($articles_query)) {

        $newpath = RSYNC_LOCAL_DEST_PATH.OSC_DIR.DIR_FS_RELATIVE_CATALOG.str_replace(HTTP_SERVER, '',
                tep_href_link(FILENAME_ARTICLE_INFO,
                    'articles_id='.$articles['articles_id']))."/";
        if (!is_dir($newpath)) {
            shell_exec('mkdir -p '.$newpath);
        }
      $hta_content = 'RewriteEngine On
      RewriteBase /
      RewriteCond %{HTTP_COOKIE} osCsid=(.*) [NC]
			RewriteRule ^$ /article_info.php?articles_id ='. $articles['articles_id'] . '&language=' . $_GET['language'] . ' [QSA,L]
			RewriteCond %{QUERY_STRING} (.*)=(.*) [NC]
			RewriteRule ^$ /article_info.php?articles_id=' . $articles['articles_id'] . '&language=' . $_GET['language'] . ' [QSA,L]
			';
     file_put_contents($newpath . '.htaccess', $hta_content, 644);
/*        $output      = "<\?php
if (isset(\$_COOKIE['osCsid']) || !empty(\$_POST) || !empty(\$_GET['osCsid'])){
chdir('".$chdir_dest_dir."');
\$_GET['articles_id']=".$articles['articles_id'].";
\$_SERVER['PHP_SELF'] = '".FILENAME_ARTICLE_INFO."';
include('".FILENAME_ARTICLE_INFO."');
exit;
}
?>
";
*/
        //create static
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL,
            HTTP_SERVER.'/'.FILENAME_ARTICLE_INFO.'/?articles_id='.$articles['articles_id'] . '&language=' . $_GET['language']);
        curl_setopt($curl_handle, CURLOPT_USERPWD, WGET_USER.":".WGET_PASSWORD);
        curl_setopt($curl_handle, CURLOPT_USERAGENT, 'wget');
        curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        $output      = curl_exec($curl_handle);
        curl_close($curl_handle);
    $output = filtr($output);
            file_put_contents($newpath . 'index.html.gz', gzencode(stripslashes($output), 9), 644);
            if (preg_match("/<\/html>/", gzdecode(file_get_contents($newpath . 'index.html.gz')))) {
              tep_db_query("UPDATE ".TABLE_ARTICLES_DESCRIPTION." SET ".$cached_flag." = 1 WHERE articles_id = ".$articles['articles_id']." AND language_id = ".$lng['languages_id']);
              $updated     = 1;
            } else {
              $error = 1;
              echo "Error: Article:" . $articles['articles_id'] . " \n";
            }
    }
}
} //end GENERATE_ARTICLES

if (GENERATE_INFORMATION == 'true') {
if ($debug_level > 2) echo "GENERATING INFORMATION PAGES\n";
$information_query = tep_db_query("SELECT information_id, information_title FROM ".TABLE_INFORMATION." WHERE visible='1' AND information_group_id = '".(int) $information_group_id."' AND language_id = '".$lng['languages_id']."' AND ".$cached_flag." = 0");
while ($information       = tep_db_fetch_array($information_query)) {
    if (tep_db_num_rows($information_query)) {
        $newpath = RSYNC_LOCAL_DEST_PATH.OSC_DIR.DIR_FS_RELATIVE_CATALOG.str_replace(HTTP_SERVER, '',
                tep_href_link(FILENAME_INFORMATION,
                    'info_id='.$information['information_id']))."/";
        if (!is_dir($newpath)) {
            shell_exec('mkdir -p '.$newpath);
        }
      $hta_content = 'RewriteEngine On
      RewriteBase /
      RewriteCond %{HTTP_COOKIE} osCsid=(.*) [NC]
			RewriteRule ^$ /information.php?info_id='.$categories['categories_id'] . '&language=' . $_GET['language'] . ' [QSA,L]
			RewriteCond %{QUERY_STRING} (.*)=(.*) [NC]
			RewriteRule ^$ /information.php?info_id='. $information['information_id'] . '&language=' . $_GET['language'] . ' [QSA,L]
			';
     file_put_contents($newpath . '.htaccess', $hta_content, 644);
/*        $output      = "<\?php
if (isset(\$_COOKIE['osCsid']) || !empty(\$_POST) || !empty(\$_GET['osCsid'])){
chdir('".$chdir_dest_dir."');
\$_GET['info_id']=".$information['information_id'].";
\$_SERVER['PHP_SELF'] = '".FILENAME_INFORMATION."';
include('".FILENAME_INFORMATION."');
exit;
}
?>
";
*/
        //create static
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL,
            HTTP_SERVER.'/'.FILENAME_INFORMATION.'?info_id='.$information['information_id'] . '&language=' . $_GET['language']);
        curl_setopt($curl_handle, CURLOPT_USERPWD, WGET_USER.":".WGET_PASSWORD);
        curl_setopt($curl_handle, CURLOPT_USERAGENT, 'wget');
        curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        $output      = curl_exec($curl_handle);
        curl_close($curl_handle);
    		$output = filtr($output);
            file_put_contents($newpath . 'index.html.gz', gzencode(stripslashes($output), 9), 644);
            if (preg_match("/<\/html>/", gzdecode(file_get_contents($newpath . 'index.html.gz')))) {
        tep_db_query("UPDATE ".TABLE_INFORMATION." SET ".$cached_flag." = 1 WHERE information_id = ".$information['information_id']." AND language_id = ".$lng['languages_id']);
              $updated     = 1;
            } else {
              $error = 1;
              echo "Error: Information:" . $information['information_id'] . " \n";
            }
    }
}
} //end GENERATE_INFORMATION 
/*!?????
if ($update_all == 'true')
        tep_db_query("UPDATE ".TABLE_INFORMATION." SET ".$cached_flag." = 1 WHERE language_id = ".$lng['languages_id']);
*/
//GENERATING_ALL_ALL if UPDATE <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
if ($debug_level > 2) {echo 'updated status:'.$updated."\n";}
if ($updated == 1) {

if (GENERATE_MANUFACTURERS_INDEX == 'true') {
if ($debug_level > 2)      echo 'Generating Manufacturers index' . "\n";
$newpath = RSYNC_LOCAL_DEST_PATH . OSC_DIR . DIR_FS_RELATIVE_CATALOG . '/'. remove_accents(cfg('MANUFACTURERS')) . '/';

/*
      $output = "<\?php
      if (isset(\$_COOKIE['osCsid']) || !empty(\$_POST) || !empty(\$_GET['osCsid'])){
      chdir('" . $chdir_dest_dir . "');
			\$_SERVER['PHP_SELF'] = '".FILENAME_MANUFACTURERS_INDEX."';
			include('".FILENAME_MANUFACTURERS_INDEX."');
      exit;
      }
      ?>
      ";
*/
        if (!is_dir($newpath)) {
            shell_exec('mkdir -p '.$newpath);
        }
      $hta_content = 'RewriteEngine On
      RewriteBase /
      RewriteCond %{HTTP_COOKIE} osCsid=(.*) [NC]
			RewriteRule ^$ /manufacturers_index.php&language=' . $_GET['language'] . ' [QSA,L]
			RewriteCond %{QUERY_STRING} (.*)=(.*) [NC]
			RewriteRule ^$ /manufacturers_index.php&language=' . $_GET['language'] . ' [QSA,L]
			';
     file_put_contents($newpath . '.htaccess', $hta_content, 644);

    //create static
    $curl_handle = curl_init();
    curl_setopt($curl_handle, CURLOPT_URL, HTTP_SERVER . '/' . FILENAME_MANUFACTURERS_INDEX . '?language=' . $_GET['language']);
    curl_setopt($curl_handle, CURLOPT_USERPWD, WGET_USER.":".WGET_PASSWORD);
    curl_setopt($curl_handle, CURLOPT_USERAGENT, 'wget');
    curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
    curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
    $output      = curl_exec($curl_handle);
    curl_close($curl_handle);
    $output = filtr($output);
            file_put_contents($newpath . 'index.html.gz', gzencode(stripslashes($output), 9), 644);
            if (preg_match("/<\/html>/", gzdecode(file_get_contents($newpath . 'index.html.gz')))) {
//              tep_db_query("UPDATE ".TABLE_PRODUCTS_DESCRIPTION." SET ".$cached_flag." = 1 WHERE products_id = ".$products['products_id']." AND language_id = ".$lng['languages_id']);
              }else {
              $error = 1;
              echo "Error: GENERATE_MANUFACTURERS_INDEX \n";

            }
} //end GENERATE_MANUFACTURERS_INDEX

if (GENERATE_PRODUCTS_NEW_PAGE == 'true') {
if ($debug_level > 2)      echo 'Generating New Products All Page' . "\n";
$newpath = RSYNC_LOCAL_DEST_PATH . OSC_DIR . DIR_FS_RELATIVE_CATALOG . '/' . remove_accents(cfg('PRODUCTS_NEW_PAGE')) . '/';
/*
      $output = "<\?php
      if (isset(\$_COOKIE['osCsid']) || !empty(\$_POST) || !empty(\$_GET['osCsid'])){
      chdir('" . $chdir_dest_dir . "');
			\$_SERVER['PHP_SELF'] = '".FILENAME_PRODUCTS_NEW."';
			include('".FILENAME_PRODUCTS_NEW."');
      exit;
      }
      ?>
      ";
*/
        if (!is_dir($newpath)) {
        if ($debug_level > 2) echo 'mkdir:' . $newpath . "\n";
            shell_exec('mkdir -p '.$newpath);
        }
      $hta_content = 'RewriteEngine On
      RewriteBase /
      RewriteCond %{HTTP_COOKIE} osCsid=(.*) [NC]
			RewriteRule ^$ /products_new.php&language=' . $_GET['language'] . ' [QSA,L]
			RewriteCond %{QUERY_STRING} (.*)=(.*) [NC]
			RewriteRule ^$ /products_new.php&language=' . $_GET['language'] . ' [QSA,L]
			';
     file_put_contents($newpath . '.htaccess', $hta_content, 644);
    //create static
    $curl_handle = curl_init();
    curl_setopt($curl_handle, CURLOPT_URL, HTTP_SERVER . '/' . FILENAME_PRODUCTS_NEW . '?language=' . $_GET['language']);
    curl_setopt($curl_handle, CURLOPT_USERPWD, WGET_USER.":".WGET_PASSWORD);
    curl_setopt($curl_handle, CURLOPT_USERAGENT, 'wget');
    curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
    curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
    $output      = curl_exec($curl_handle);
    curl_close($curl_handle);
    $output = filtr($output);
            file_put_contents($newpath . 'index.html.gz', gzencode(stripslashes($output), 9), 644);
            if (preg_match("/<\/html>/", gzdecode(file_get_contents($newpath . 'index.html.gz')))) {
//              tep_db_query("UPDATE ".TABLE_PRODUCTS_DESCRIPTION." SET ".$cached_flag." = 1 WHERE products_id = ".$products['products_id']." AND language_id = ".$lng['languages_id']);
              $updated     = 1;
            } else {
              $error = 1;
              echo "Error: New Products All Page \n";
		}
} //end GENERATE_PRODUCTS_NEW_PAGE

/*
      //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
      $newpath = preg_replace('/\//','',MANUFACTURERS_INDEX_LINK); //CONFIG ME! <<
      //file_put_contents('/tmp/cesta',$newpath);
      $scriptfile = FILENAME_MANUFACTURERS_INDEX; //CONFIG ME! 
      $context = stream_context_create(array('http' => array('header'  => "Authorization: Basic " . base64_encode(WGET_USER . ':' . WGET_PASSWORD))));
      //NNN    $output = str_replace(HTTP_SERVER, SHOP_SERVER, $output);
      $output = file_get_contents(HTTP_SERVER . '/' . $scriptfile . '?language='. $lc, false, $context);
      //echo 'oooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooo' .$output;
      //    $output = HTTP_SERVER . '/' . FILENAME_MANUFACTURERS_INDEX . '?language='. $lc;
      $output = str_replace(SHOP_SERVER . '/index.php"', SHOP_SERVER . '/"', $output);
      shell_exec("mkdir -p " . RSYNC_LOCAL_DEST_PATH . OSC_DIR . $newpath);

      $index_file = fopen(RSYNC_LOCAL_DEST_PATH . OSC_DIR . $newpath . "/index.html", "w");
      fwrite($index_file, $output);
      fclose($index_file);
      $tst = file_get_contents(RSYNC_LOCAL_DEST_PATH . OSC_DIR . $newpath . "/index.html");
      if (preg_match("/<\/html>/", $tst)) file_put_contents(RSYNC_LOCAL_DEST_PATH . OSC_DIR . 'error','0'); else { file_put_contents(RSYNC_LOCAL_DEST_PATH . OSC_DIR . 'error','1'); echo 'ERROR generating:' . $newpath . "\n"; }

      if (!file_exists(DIR_FS_DOCUMENT_ROOT .  $newpath)) {
      symlink(RSYNC_LOCAL_DEST_PATH . OSC_DIR . $newpath,  DIR_FS_DOCUMENT_ROOT .  $newpath);
      }


      $hta_content = 'RewriteEngine On
      RewriteBase /
      RewriteCond %{HTTP_COOKIE} osCsid=(.*) [NC]
      RewriteRule ^$ /' . $scriptfile . '?language='. $lc . ' [QSA,L]';
      $hta_file = fopen(RSYNC_LOCAL_DEST_PATH . OSC_DIR . $newpath . "/.htaccess", "w");
      fwrite($hta_file, $hta_content);
      fclose($hta_file);

      echo 'Generating MySQL ERROR Page' . "\n"; //<<<<<<<<<<<<<<<<<<<<
      $newpath = preg_replace('/\/$/','','safe_mode.html'); //CONFIG ME! <
      $scriptfile = FILENAME_SAFE_MODE; //CONFIG ME! <<<
      $context = stream_context_create(array('http' => array('header'  => "Authorization: Basic " . base64_encode(WGET_USER . ':' . WGET_PASSWORD))));
      //NNN    $output = str_replace(HTTP_SERVER, SHOP_SERVER, $output);
      $output = file_get_contents(HTTP_SERVER . '/' . $scriptfile . '?language='. $lc, false, $context);
      //    $output = HTTP_SERVER . '/' . FILENAME_MANUFACTURERS_INDEX . '?language='. $lc;
      $output = str_replace(SHOP_SERVER . '/index.php"', SHOP_SERVER . '/"', $output);
      //echo $output;

      $index_file = fopen(DIR_FS_DOCUMENT_ROOT . $newpath, "w");
      fwrite($index_file, $output);
      fclose($index_file);
      $tst = file_get_contents(DIR_FS_DOCUMENT_ROOT . $newpath);
      if (preg_match("/<\/html>/", $tst)) file_put_contents(RSYNC_LOCAL_DEST_PATH . OSC_DIR . 'error','0'); else { file_put_contents(RSYNC_LOCAL_DEST_PATH . OSC_DIR . 'error','1'); echo 'ERROR generating:' . $newpath . "\n"; }




      echo 'Generating All products Page' . "\n"; //<<<<
      /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
      $newpath = remove_accents(preg_replace('/\/$/','',BOX_CATALOG_PRODUCTS_WITH_IMAGES)); //CONFIG ME!
      $scriptfile = FILENAME_CATALOG_PRODUCTS_WITH_IMAGES; //CONFIG ME! <<<<
      $context = stream_context_create(array('http' => array('header'  => "Authorization: Basic " . base64_encode(WGET_USER . ':' . WGET_PASSWORD))));
      //NNN    $output = str_replace(HTTP_SERVER, SHOP_SERVER, $output);
      $output = file_get_contents(HTTP_SERVER . '/' . $scriptfile . '?language='. $lc, false, $context);
      //    $output = HTTP_SERVER . '/' . FILENAME_MANUFACTURERS_INDEX . '?language='. $lc;
      $output = str_replace(SHOP_SERVER . '/index.php"', SHOP_SERVER . '/"', $output);
      //echo $output;
      shell_exec("mkdir -p " . RSYNC_LOCAL_DEST_PATH . OSC_DIR . $newpath);

      $index_file = fopen(RSYNC_LOCAL_DEST_PATH . OSC_DIR . $newpath . "/index.html", "w");
      fwrite($index_file, $output);
      //    fwrite($index_file, 'err'); //test error
      fclose($index_file);
      $tst = file_get_contents(RSYNC_LOCAL_DEST_PATH . OSC_DIR . $newpath . "/index.html");
      if (preg_match("/<\/html>/", $tst)) file_put_contents(RSYNC_LOCAL_DEST_PATH . OSC_DIR . 'error','0'); else { file_put_contents(RSYNC_LOCAL_DEST_PATH . OSC_DIR . 'error','1'); echo 'ERROR generating:' . $newpath . "\n"; }


      if (!file_exists(DIR_FS_DOCUMENT_ROOT .  $newpath)) {
      symlink(RSYNC_LOCAL_DEST_PATH . OSC_DIR . $newpath,  DIR_FS_DOCUMENT_ROOT .  $newpath);
      }


      $hta_content = 'RewriteEngine On
      RewriteBase /
      RewriteCond %{HTTP_COOKIE} osCsid=(.*) [NC]
      RewriteRule ^$ /' . $scriptfile . '?language='. $lc . ' [QSA,L]
      ';
      $hta_file = fopen(RSYNC_LOCAL_DEST_PATH . OSC_DIR . $newpath . "/.htaccess", "w");
      fwrite($hta_file, $hta_content);
      fclose($hta_file);
     */

if (GENERATE_DB_ERROR == 'true') {
    echo 'GENERATING ERROR PAGE'."\n"; //------------------------------------------------
    $curl_handle = curl_init();
    curl_setopt($curl_handle, CURLOPT_URL, HTTP_SERVER.'/' . FILENAME_DB_ERROR_PHP . '?language=' . $_GET['language']);
    curl_setopt($curl_handle, CURLOPT_USERPWD, WGET_USER.":".WGET_PASSWORD);
    curl_setopt($curl_handle, CURLOPT_USERAGENT, 'wget');
    curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
    curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
    $output      = curl_exec($curl_handle);
    curl_close($curl_handle);
    $output = filtr($output);
    file_put_contents(RSYNC_LOCAL_DEST_PATH.OSC_DIR . DIR_FS_RELATIVE_CATALOG . '/' . FILENAME_DB_ERROR, stripslashes($output), 644); 
            if (!preg_match("/<\/html>/", file_get_contents(RSYNC_LOCAL_DEST_PATH.OSC_DIR . DIR_FS_RELATIVE_CATALOG . '/' . FILENAME_DB_ERROR))) {
              $error = 1;
              echo "Error: HomePage \n";
            }
}

if (GENERATE_HOMEPAGE == 'true') {

    echo 'GENERATING HOMEPAGE'."\n"; //------------------------------------------------
//    $output      = '';
    /* SMAZAT?
      $output = "<\?php
      if (isset(\$_COOKIE['osCsid']) || !empty(\$_POST) || !empty(\$_GET['osCsid'])){
      chdir('" . $chdir_dest_dir . "');
      \$_GET['products_id']=" . $products['products_id'] . ";
      include('product_info.php');
      exit;
      }
      ?>
      ";
     */
    //create static
      $hta_content = 'RewriteEngine On
      RewriteBase /
      RewriteCond %{HTTP_COOKIE} osCsid=(.*) [NC]
			RewriteRule ^$ /index.php?language=' . $_GET['language'] . ' [QSA,L]
			RewriteCond %{QUERY_STRING} (.*)=(.*) [NC]
			RewriteRule ^$ /index.php?language=' . $_GET['language'] . ' [QSA,L]
			';
//     unlink(RSYNC_LOCAL_DEST_PATH.OSC_DIR . DIR_FS_RELATIVE_CATALOG . '/.htaccess');
    file_put_contents(RSYNC_LOCAL_DEST_PATH.OSC_DIR . DIR_FS_RELATIVE_CATALOG . '/.htaccess', $hta_content, 644);



    $curl_handle = curl_init();
    curl_setopt($curl_handle, CURLOPT_URL, HTTP_SERVER.'/index.php?language=' . $_GET['language']);
    curl_setopt($curl_handle, CURLOPT_USERPWD, WGET_USER.":".WGET_PASSWORD);
    curl_setopt($curl_handle, CURLOPT_USERAGENT, 'wget');
    curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
    curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
    $output      = curl_exec($curl_handle);
    curl_close($curl_handle);
    $output = filtr($output);
//    file_put_contents(RSYNC_LOCAL_DEST_PATH.OSC_DIR . DIR_FS_RELATIVE_CATALOG . '/index.html', stripslashes($output), 644); 
    file_put_contents(RSYNC_LOCAL_DEST_PATH.OSC_DIR . DIR_FS_RELATIVE_CATALOG . '/index.html.gz', gzencode(stripslashes($output)), 644); 
            if (!preg_match("/<\/html>/", gzdecode(file_get_contents(RSYNC_LOCAL_DEST_PATH.OSC_DIR . DIR_FS_RELATIVE_CATALOG . '/index.html.gz')))) {
              $error = 1;
              echo "Error: HomePage \n";
            } else {
//set cached_flag 1 for information constants
        tep_db_query("UPDATE ".TABLE_INFORMATION." SET ".$cached_flag." = 1 WHERE information_group_id != ". $information_group_id ." AND language_id = ".$lng['languages_id']);
}
} //end GENERATE_HOMEPAGE
    /*
      //RSYNC <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
      //now is finished
      //todo STOP tep_db_query("UPDATE " . TABLE_ROBOT . " SET now=0");
      //NEW_TODO!!!!!!!!!!!!!!!!!!!!! spravne ten error zjistit k de je ten soubor!!!!!!!!!!!!!!!!!!!!!!!!!
      $error = file_get_contents(RSYNC_LOCAL_DEST_PATH . OSC_DIR . 'error');
      echo 'error je: ' . $error ."\n";
     */
    if ($error < 1) {
        echo 'Rsync start ...'."\n";
//local rsync
        if (RSYNCLOGGING == 'true') {
            shell_exec('rsync -av --exclude-from  '. DIR_FS_CONFIG . 'exclude_local.txt ' . RSYNC_LOCAL_SRC_PATH . OSC_DIR . ' ' . RSYNC_LOCAL_DEST_PATH . OSC_DIR . ' >> ' . REPLICATION_LOG_DIR.HTTPS_COOKIE_DOMAIN . '_rsync_import_ALL.osclog  2>&1');
        } else {
            shell_exec('rsync -av --exclude-from  '. DIR_FS_CONFIG . 'exclude_local.txt ' . RSYNC_LOCAL_SRC_PATH . OSC_DIR . ' ' . RSYNC_LOCAL_DEST_PATH . OSC_DIR);
        }


        if (RSYNC_TO_REMOTE == 1 && $argv[2] == 'shop') {

            foreach ($remoteservers_arr as &$remoteserver) {
                                shell_exec('rsync --chmod=D755,F644 -ave   ssh --protocol=29 --exclude catalog/admin ' . RSYNC_LOCAL_DEST_PATH . OSC_DIR . ' ' . $remoteserver . ':' . RSYNC_REMOTE_DEST_DIR . ' --delete --delete-excluded');
                if ($debug_level > 2) echo('rsync --chmod=D755,F644 -ave   ssh --protocol=29  --exclude catalog/admin ' . RSYNC_LOCAL_DEST_PATH . OSC_DIR . ' ' . $remoteserver . ':' . RSYNC_REMOTE_DEST_DIR . ' --delete --delete-excluded');
            }
//orig    shell_exec('~/rsync_eshop.sh >> ' . REPLICATION_LOG_DIR . HTTPS_COOKIE_DOMAIN . '_rsync_export.osclog  2>&1');
//	shell_exec("composer --no-dev --optimize-autoloader update");
//	die("docker build -t purehtml/" . remove_accents(STORE_NAME) . " -t purehtml/" . remove_accents(STORE_NAME) . ":`git rev-parse --short HEAD` " . RSYNC_LOCAL_DEST_PATH . OSC_DIR);
        }
    } else {
        echo 'Rsync to Eshop ERROR code:'.$error."\n";
        mail(WEBMASTER_EMAIL,
            'ERR:' . $error . ' ' . HTTPS_COOKIE_DOMAIN,
            'Static Export CANCELLED!');
    }
} //end $updated == 1

unlink('../../cronlock/'.$argv['1'].'.'.$argv['2']);

if ($debug_level > 0) {echo "DONE: ".date("Y/m/d H:i"), "\n";}

function filtr ($output) {

$output = str_replace($_SERVER['HTTP_HOST'], HTTP_HOST_GENERATED, $output);
$output = str_replace('?sort=1','', $output);
return $output;
    $output = filtr($output);

}

$time2 = microtime(true);
if ($debug_level > 2)echo "script execution time: ".($time2 - $time1) . "\n"; //value in seconds
exit;
/*
uzitecne funkce:

tep_get_path
tep_get_category_tree
tep_get_category_name
tep_get_products_name
tep_get_products_url
tep_get_manufacturer_url
tep_generate_category_path
tep_output_generated_category_path
tep_get_generated_category_path_ids
tep_parse_category_path

OSCmax
tep_html_noquote = strips apostrophes from strings
tep_get_products_seo_url
tep_get_category_path
tep_get_parent_categories
tep_get_topic_full_path
tep_get_parent_topics
tep_get_topic_seourl
remove_accents
get_parents (category_id)
tep_get_category_seourl
tep_get_product_path
//POZOR:tohle projit !!!!!!!!!!!

*/
