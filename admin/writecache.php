#!/usr/bin/php -q
<?php
$debug_level=3; //0 = nothing; 1 = essential 2 = partial 3 = all
chdir('../');
define('GENERATOR_FORCE_UPDATE_ALL', '0'); //0 = production, 1 = komplenti vynuceny
define('RSYNC_TO_REMOTE','0'); //1 = enable rsync to remote server
/*
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
if (file_exists('../oscconfig/languages/' . $argv[1] . '/static_admin.php')){
include('../oscconfig/languages/' . $argv[1] . '/static_admin.php');
} else {
	echo "Static ADMIN configuration file not found\n";
	exit;
}
}else {
$cached_flag = 'cached';
if (file_exists('../oscconfig/languages/' . $argv[1] . '/static_shop.php')){
include('../oscconfig/languages/' . $argv[1] . '/static_shop.php');
} else {
	echo "Static SHOP configuration file not found\n";
	exit;
}
}
//now include common static generator
if (file_exists('../oscconfig/static.php')){
include('../oscconfig/static.php');
} else {
	echo "Static CORE configuration file not found\n";
	exit;
}
if ($argv[2] == 'admin') {
$chdir_dest_dir = RSYNC_LOCAL_DEST_PATH . OSC_DIR;
} else {
$chdir_dest_dir = RSYNC_REMOTE_DEST_DIR . OSC_DIR;
}
require('includes/application_top.php');
//TODO: bude tady neco??????
//require('admin/'. DIR_WS_FUNCTIONS . 'cli.php');

//TODO: presunout /languages/LANG/static.php do DTB config
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
ini_set('display_errors', '1');
//////////////CONF START <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
$time1 = microtime(true);
date_default_timezone_set("Europe/Prague");
$information_group_id=1;
$updated = 0;

//language_id
    $lng_querey = tep_db_query("SELECT languages_id FROM " . TABLE_LANGUAGES . " WHERE code ='" . $argv[1] . "'");
    $lng = tep_db_fetch_array($lng_querey);
//    $lc = $lngcode['languages_id'];
//PURE:smazat    require(DIR_FS_ADMIN . DIR_WS_LANGUAGES . $lngcode['directory'] . '.php');
$context = stream_context_create(array(
    'http' => array(
        'header'  => "Authorization: Basic " . base64_encode(WGET_USER . ':' . WGET_PASSWORD)
    )
));

//////////////CONF END <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
//exit if lockfile exists, exis or create lock
$minute = date("Hi");
//if (SERVER_INSTANCE =='shop') {
if (file_exists('../cronlock/' . $argv['1'] . '.' . $argv['2'])){
//TODO: if lock wait too long send error message and restart
	echo 'EXITING: lockfile EXISTS!' . "\n";
	exit;
} else {
	file_put_contents('../cronlock/' . $argv['1'] . '.' . $argv['2'],$minute);
}
 if (!file_exists('../crontime/' . $argv['1'] . '.' . $argv['2']))  file_put_contents('../crontime/' . $argv['1'] . '.' . $argv['2'], '0301');
$crontime = (int)file_get_contents('../crontime/' . $argv['1'] . '.' . $argv['2']);
echo 'Conf. loaded OK' ."\n";

/*
} else {
//ADMIN:
if (file_exists('../cronlock/' . $argv['1'] . '_admin')){
//TODO: if lock wait too long send error message and restart
	echo 'EXITING: lockfile EXISTS!' . "\n";
	exit;
} else {
	file_put_contents('../cronlock/' . $argv['1'] . '_admin',$minute);
}
$crontime = (int)file_get_contents('../crontime/' . $argv['1'] . '_admin.cron');
echo 'Conf. loaded OK' ."\n";
}
*/
//CACHE RESET <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<

//check for reset needed:
$update_all='false';
// 1. information - one change require reset
$inormation_reset_query = tep_db_query("select COUNT(cached) as counter from information where cached=0 AND language_id=" . $lng['languages_id']);
$inormation_reset = tep_db_fetch_array($inormation_reset_query);
echo '.$inormation_reset:::'.$inormation_reset['counter'];
if ($inormation_reset['counter'] > 0) $update_all='true';
//nowtime: special full update NOW
$cron_query = tep_db_query("SELECT * FROM " . TABLE_ROBOT . " WHERE lang = '" . $argv['1'] . "' AND admin = '" . $argv['2'] . "'");
if (tep_db_num_rows($cron_query)){
	$cron = tep_db_fetch_array($cron_query);
	if ( ($minute == $cron['nowtime'])  && ($cron['admin'] ==  $argv['2']) ) tep_db_query("DELETE FROM " . TABLE_ROBOT . " WHERE '" . $cron['nowtime'] . "' = '" . $minute . "' AND admin = '" . $argv['2'] . "'");
}
if ($minute == $crontime || GENERATOR_FORCE_UPDATE_ALL == '1' || $minute == $cron['nowtime'])  $update_all='true';
if ($update_all=='true') {
//creating lockfile
echo "big upd. START\n";
echo "cas: " . date("H:i:s") . "\n";
/*
SMAZAT?<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<SMAZAT
if (SERVER_INSTANCE =='admin') {
    tep_db_query("UPDATE " . TABLE_PRODUCTS_DESCRIPTION . " SET cached_admin = 0 WHERE language_id =" . $lng['languages_id']);
    tep_db_query("UPDATE " . TABLE_CATEGORIES_DESCRIPTION . " SET cached_admin = 0 WHERE language_id =" . $lng['languages_id']);
    tep_db_query("UPDATE " . TABLE_ARTICLES_DESCRIPTION . " SET cached_admin = 0 WHERE language_id =" . $lng['languages_id']);
    tep_db_query("UPDATE " . TABLE_INFORMATION . " SET cached_admin = 0 WHERE language_id =" . $lng['languages_id']);
    tep_db_query("UPDATE " . TABLE_MANUFACTURERS_INFO . " SET cached_admin = 0 WHERE languages_id =" . $lng['languages_id']);
    tep_db_query("UPDATE " . TABLE_TOPICS_DESCRIPTION . " SET cached_admin = 0 WHERE language_id =" . $lng['languages_id']);
} else {
*/
    tep_db_query("UPDATE " . TABLE_PRODUCTS_DESCRIPTION . " SET " . $cached_flag . " = 0 WHERE language_id =" . $lng['languages_id']);
    tep_db_query("UPDATE " . TABLE_CATEGORIES_DESCRIPTION . " SET " . $cached_flag . " = 0 WHERE language_id =" . $lng['languages_id']);
    tep_db_query("UPDATE " . TABLE_ARTICLES_DESCRIPTION . " SET " . $cached_flag . " = 0 WHERE language_id =" . $lng['languages_id']);
    tep_db_query("UPDATE " . TABLE_INFORMATION . " SET " . $cached_flag . " = 0 WHERE language_id =" . $lng['languages_id']);
    tep_db_query("UPDATE " . TABLE_MANUFACTURERS_INFO . " SET " . $cached_flag . " = 0 WHERE languages_id =" . $lng['languages_id']);
    tep_db_query("UPDATE " . TABLE_TOPICS_DESCRIPTION . " SET " . $cached_flag . " = 0 WHERE language_id =" . $lng['languages_id']);
//}

echo 'TED MAZU...';

shell_exec('rm -rf ' . RSYNC_LOCAL_DEST_PATH . OSC_DIR);
//shell_exec('mkdir ' . HTML_CACHE_DIR);

} else {
echo 'updating...' . "\n";
}


if ($debug_level>2) echo "GENERATING_PRODUCTS<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<\n";

if (PRODUCTS_CANONICAL_TYPE == 'path') {
if ($debug_level>2) echo "Debug: PRODUCTS_CANONICAL_TYPE = 'path'\n";
$products_query = tep_db_query("SELECT p.products_id
	FROM " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION ." pd
	WHERE 
		products_status=1 
		AND p.products_id = pd.products_id 
		AND pd." . $cached_flag . " = 0
		AND pd.language_id = '" . $lng['languages_id']. "'");

    while ($products = tep_db_fetch_array($products_query)) {
    if (tep_db_num_rows($products_query)) {
		//select only products from active (sort_order > 0) categories:
    if (SERVER_INSTANCE !='admin') {
//    $canonical_category_query = tep_db_query("SELECT categories_id FROM " . TABLE_PRODUCTS_TO_CATEGORIES . " WHERE canonical = '1' AND ");
  	$inactive_query = tep_db_query("SELECT sort_order FROM " . TABLE_CATEGORIES . " c, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c WHERE 
  	c.categories_id = p2c.categories_id AND canonical = '1' AND p2c.products_id = " . $products['products_id']);
  	$inactive = tep_db_fetch_array($inactive_query);
  	if ($inactive['sort_order'] == 0) {
  	echo "id NEAKT:" . $products['products_id'];
		continue;
  	}
	}
			$newpath =  RSYNC_LOCAL_DEST_PATH . OSC_DIR . str_replace(HTTP_SERVER , '' , tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $products['products_id'])) . "/";
				if (!is_dir($newpath)){
				shell_exec('mkdir -p ' . $newpath);
				}
			$output = "<\?php
if (isset(\$_COOKIE['osCsid']) || !empty(\$_POST)){
chdir('" . $chdir_dest_dir . "');
\$_GET['products_id']=" . $products['products_id'] . ";
\$PHP_SELF = '" . FILENAME_PRODUCT_INFO . "';
include('" . FILENAME_PRODUCT_INFO . "');
exit;
}
?>
";
			//create static
			$curl_handle=curl_init();
			curl_setopt($curl_handle, CURLOPT_URL,HTTP_SERVER . '/product_info.php?products_id=' . $products['products_id']);
			curl_setopt($curl_handle, CURLOPT_USERPWD, WGET_USER . ":" . WGET_PASSWORD);
			curl_setopt($curl_handle,CURLOPT_USERAGENT,'wget');
			curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
			curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
			$output .= curl_exec($curl_handle);
			curl_close($curl_handle);
			$output = str_replace(HTTP_SERVER, '', $output);
			file_put_contents($newpath . 'index.php', stripslashes($output), 644);
			tep_db_query("UPDATE " . TABLE_PRODUCTS_DESCRIPTION . " SET " . $cached_flag . " = 1 WHERE products_id = " . $products['products_id'] . " AND language_id = " . $lng['languages_id']);
			$updated = 1;
		}
	}
} else {
if ($debug_level>2) echo "Debug: PRODUCTS_CANONICAL_TYPE = 'manufacturer'\n";
/*
    $products_query = tep_db_query("SELECT p.products_id, products_model, products_name, manufacturers_name 
    FROM " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION ." pd, " . TABLE_MANUFACTURERS . " m
    WHERE 
	products_status=1 
	AND p.products_id = pd.products_id 
	AND p.manufacturers_id = m.manufacturers_id
	AND pd." . $cached_flag . " = 0
	AND language_id = '" . $lng['languages_id']. "'
	");

    while ($products = tep_db_fetch_array($products_query)) {
    if (tep_db_num_rows($products_query)) {
    echo GENERATING_PRODUCTS . "\n";
    if ($products['products_model'] !='') $model = '-' . $products['products_model']; else $model = '';
 
    $manufurl = preg_replace('/(-[a-z])*$/','',remove_accents($products['manufacturers_name']));
    $newpath = $manufurl . '/' . remove_accents($products['products_name']) . $model . '/';
//generujeme .htaccess do htaccess.tmp <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<< configme
//pure:stop    $htaccess .= 'RewriteRule ^' . remove_accents($products['products_name']) . '/$ '  . 'http://en.oikoymenh.cz/' . $newpath .' [R=301,QSA,NC,L]' ."\n";

//$output = file_get_contents(HTTP_SERVER . '/product_info.php?products_id=' . $products['products_id'] . '&language='. $lc, false, $context);
    $output = str_replace(SHOP_SERVER . '/index.php"', SHOP_SERVER . '/"', $output);
//NNN $output = str_replace(HTTP_SERVER, SHOP_SERVER, $output);

shell_exec("mkdir -p " . RSYNC_LOCAL_DEST_PATH . OSC_DIR . $newpath);
if (!file_exists(DIR_FS_DOCUMENT_ROOT .  $manufurl)) {
    symlink(RSYNC_LOCAL_DEST_PATH . OSC_DIR . $manufurl,  DIR_FS_DOCUMENT_ROOT .  $manufurl);
}
  $index_file = fopen(RSYNC_LOCAL_DEST_PATH . OSC_DIR . $newpath . "/index.html", "w");
  fwrite($index_file, $output);
  fclose($index_file);
    $tst = file_get_contents(RSYNC_LOCAL_DEST_PATH . OSC_DIR . $newpath . "/index.html");
    if (preg_match("/<\/html>/", $tst)) file_put_contents(RSYNC_LOCAL_DEST_PATH . OSC_DIR . 'error','0'); else { file_put_contents(RSYNC_LOCAL_DEST_PATH . OSC_DIR . 'error','1'); echo 'ERROR generating:' . $newpath . "\n"; }

$hta_content = 'RewriteEngine On
RewriteBase /
RewriteCond %{HTTP_COOKIE} osCsid=(.*) [NC]
RewriteRule ^$ /product_info.php?products_id=' . $products['products_id'] . '&language='. $lc . ' [QSA,L]
';

  $hta_file = fopen(RSYNC_LOCAL_DEST_PATH . OSC_DIR . $newpath . "/.htaccess", "w");
  fwrite($hta_file, $hta_content);
  fclose($hta_file);
//echo 'path:'. $newpath;
//update status 
//CHANGEME
}}
tep_db_query("UPDATE " . TABLE_PRODUCTS_DESCRIPTION . " SET " . $cached_flag . " = 1 WHERE products_id = " . $products['products_id'] . " AND language_id = " . $lng['languages_id']);
$updated = 1;
*/
}

echo GENERATING_CATEGORIES ."\n";
//>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>;
    $categories_query = tep_db_query("SELECT c.categories_id, cd.categories_name FROM " . TABLE_CATEGORIES . " c,  " . TABLE_CATEGORIES_DESCRIPTION . " cd 
    WHERE cd.categories_id = c.categories_id 
    AND " . $cached_flag . " = 0 
    AND language_id = '" . $lng['languages_id'] .  "' 
    AND sort_order > 0");
    while ($categories = tep_db_fetch_array($categories_query)) {
    if (tep_db_num_rows($categories_query)) {
    echo 'neco je..' .$categories['categories_id'] . "\n";
			$newpath =  RSYNC_LOCAL_DEST_PATH . OSC_DIR . str_replace(HTTP_SERVER , '' , tep_href_link(FILENAME_DEFAULT, 'cPath=' . $categories['categories_id'])) . "/";
				if (!is_dir($newpath)){
				shell_exec('mkdir -p ' . $newpath);
				}
			$output = "<\?php
if (isset(\$_COOKIE['osCsid']) || !empty(\$_POST)){
chdir('" . $chdir_dest_dir . "');
\$_GET['cPath']=" . $categories['categories_id'] . ";
\$PHP_SELF = '" . FILENAME_DEFAULT . "';
include('" . FILENAME_DEFAULT . "');
exit;
//tady to je
}
?>
";
			//create static
			$curl_handle=curl_init();
//		curl_setopt($curl_handle, CURLOPT_URL, HTTP_SERVER . '/product_info.php?products_id=' . $products['products_id']);
//			curl_setopt($curl_handle, CURLOPT_URL, HTTP_SERVER . '/index.php?cPath=1');
			curl_setopt($curl_handle, CURLOPT_URL, HTTP_SERVER . '/index.php?cPath=' . $categories['categories_id']);
			curl_setopt($curl_handle, CURLOPT_USERPWD, WGET_USER . ":" . WGET_PASSWORD);
			curl_setopt($curl_handle,CURLOPT_USERAGENT,'wget');
			curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
			curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
			$output .= curl_exec($curl_handle);
//			echo '$output' . $output;
			curl_close($curl_handle);
			$output = str_replace(HTTP_SERVER, '', $output);
			file_put_contents($newpath . 'index.php', stripslashes($output), 644);


    tep_db_query("UPDATE " . TABLE_CATEGORIES_DESCRIPTION . " SET " . $cached_flag . " = 1 WHERE categories_id = " . $categories['categories_id'] . " AND language_id = " . $lng['languages_id']);
    $updated = 1;
}}

/*

//GENERATING_MANUFACTURERS<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<

    $manufacturers_query = tep_db_query("SELECT m.manufacturers_id, manufacturers_name  FROM " . TABLE_MANUFACTURERS . " m, " . TABLE_MANUFACTURERS_INFO . " mi
    WHERE
	m.manufacturers_id = mi.manufacturers_id
	AND mi." . $cached_flag . " = 0
	AND languages_id = '" . $lng['languages_id']. "'");
    while ($manufacturers = tep_db_fetch_array($manufacturers_query)) {
    if (tep_db_num_rows($manufacturers_query)) {
    echo GENERATING_MANUFACTURERS . "\n";
     $newpath = preg_replace('/(-[a-z])*$/','',remove_accents($manufacturers['manufacturers_name']));
    $context = stream_context_create(array('http' => array('header'  => "Authorization: Basic " . base64_encode(WGET_USER . ':' . WGET_PASSWORD))));
    $output = file_get_contents(HTTP_SERVER . '/index.php?manufacturers_id=' . $manufacturers['manufacturers_id'] . '&language='. $lc, false, $context);
    $output = str_replace(SHOP_SERVER . '/index.php"', SHOP_SERVER . '/"', $output);
    ///NNN    $output = str_replace(HTTP_SERVER, SHOP_SERVER, $output);
    shell_exec("mkdir -p " . RSYNC_LOCAL_DEST_PATH . OSC_DIR . $newpath);
    if (!file_exists(DIR_FS_DOCUMENT_ROOT .  $newpath)) {
    symlink(RSYNC_LOCAL_DEST_PATH . OSC_DIR . $newpath,  DIR_FS_DOCUMENT_ROOT .  $newpath);
    }
    $index_file = fopen(RSYNC_LOCAL_DEST_PATH . OSC_DIR . $newpath . "/index.html", "w");
    fwrite($index_file, $output);
    fclose($index_file);
    $tst = file_get_contents(RSYNC_LOCAL_DEST_PATH . OSC_DIR . $newpath . "/index.html");
    if (preg_match("/<\/html>/", $tst)) file_put_contents(RSYNC_LOCAL_DEST_PATH . OSC_DIR . 'error','0'); else { file_put_contents(RSYNC_LOCAL_DEST_PATH . OSC_DIR . 'error','1'); echo 'ERROR generating:' . $newpath . "\n"; }

    $hta_content = 'RewriteEngine On
    RewriteBase /
    RewriteCond %{HTTP_COOKIE} osCsid=(.*) [NC]
    RewriteRule ^$ /index.php?manufacturers_id=' . $manufacturers['manufacturers_id'] . '&language='. $lc . ' [QSA,L]
    ';
    $hta_file = fopen(RSYNC_LOCAL_DEST_PATH . OSC_DIR . $newpath . "/.htaccess", "w");
    fwrite($hta_file, $hta_content);
    fclose($hta_file);
    tep_db_query("UPDATE " . TABLE_MANUFACTURERS_INFO . " SET " . $cached_flag . " = 1 WHERE manufacturers_id = " . $manufacturers['manufacturers_id'] . " AND languages_id = " . $lng['languages_id']);
    $updated = 1;
}}

*/

#>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
//echo GENERATING_TOPICS
    $topics_query = tep_db_query("SELECT topics_id, topics_name FROM " . TABLE_TOPICS_DESCRIPTION . " td
    WHERE 
    " . $cached_flag . " = 0 
    AND language_id = '" . $lng['languages_id'] .  "'");
    while ($topics = tep_db_fetch_array($topics_query)) {
    if (tep_db_num_rows($topics_query)) {
    echo 'topics_name::::' . $topics['topics_name'] . "\n";
			$newpath =  RSYNC_LOCAL_DEST_PATH . OSC_DIR . str_replace(HTTP_SERVER , '' , tep_href_link(FILENAME_ARTICLES, 'tPath=' . $topics['topics_id'])) . "/";
				if (!is_dir($newpath)){
				shell_exec('mkdir -p ' . $newpath);
				}
			$output = "<\?php
if (isset(\$_COOKIE['osCsid']) || !empty(\$_POST)){
chdir('" . $chdir_dest_dir . "');
\$_GET['tPath']=" . $topics['topics_id'] . ";
\$PHP_SELF = '" . FILENAME_ARTICLES . "';
include('" . FILENAME_ARTICLES . "');
exit;
}
?>
";
			//create static
			$curl_handle=curl_init();
			curl_setopt($curl_handle, CURLOPT_URL, HTTP_SERVER . '/' . FILENAME_ARTICLES . '?tPath=' . $topics['topics_id']);
			curl_setopt($curl_handle, CURLOPT_USERPWD, WGET_USER . ":" . WGET_PASSWORD);
			curl_setopt($curl_handle,CURLOPT_USERAGENT,'wget');
			curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
			curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
			$output .= curl_exec($curl_handle);
			curl_close($curl_handle);
			$output = str_replace(HTTP_SERVER, '', $output);
			file_put_contents($newpath . 'index.php', stripslashes($output), 644);
    tep_db_query("UPDATE " . TABLE_TOPICS_DESCRIPTION . " SET " . $cached_flag . " = 1 WHERE topics_id = " . $topics['topics_id'] . " AND language_id = " . $lng['languages_id']);
    $updated = 1;

}}

//GENERATING_ARTICLES <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
//TODO removed condition   articles_status=1 - mazani clanku jen naoko zustanou tam, ale zmizej z HP
    $articles_query = tep_db_query("SELECT a.articles_id, articles_name FROM " . TABLE_ARTICLES . " a, " . TABLE_ARTICLES_DESCRIPTION . " ad 
    WHERE 
    a.articles_id= ad.articles_id 
    AND " . $cached_flag . " = 0
    AND language_id = '" . $lng['languages_id']. "'");
    while ($articles = tep_db_fetch_array($articles_query)) {
    if (tep_db_num_rows($articles_query)) {
    echo GENERATING_ARTICLES . "\n";

			$newpath =  RSYNC_LOCAL_DEST_PATH . OSC_DIR . str_replace(HTTP_SERVER , '' , tep_href_link(FILENAME_ARTICLE_INFO, 'articles_id=' . $articles['articles_id'])) . "/";
				if (!is_dir($newpath)){
				shell_exec('mkdir -p ' . $newpath);
				}
			$output = "<\?php
if (isset(\$_COOKIE['osCsid']) || !empty(\$_POST)){
chdir('" . $chdir_dest_dir . "');
\$_GET['articles_id']=" . $articles['articles_id'] . ";
\$PHP_SELF = '" . FILENAME_ARTICLE_INFO . "';
include('" . FILENAME_ARTICLE_INFO . "');
exit;
}
?>
";
			//create static
			$curl_handle=curl_init();
			curl_setopt($curl_handle, CURLOPT_URL, HTTP_SERVER . '/' . FILENAME_ARTICLE_INFO . '/?articles_id=' . $articles['articles_id']);
			curl_setopt($curl_handle, CURLOPT_USERPWD, WGET_USER . ":" . WGET_PASSWORD);
			curl_setopt($curl_handle,CURLOPT_USERAGENT,'wget');
			curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
			curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
			$output .= curl_exec($curl_handle);
			curl_close($curl_handle);
			$output = str_replace(HTTP_SERVER, '', $output);
			file_put_contents($newpath . 'index.php', stripslashes($output), 644);


    tep_db_query("UPDATE " . TABLE_ARTICLES_DESCRIPTION . " SET " . $cached_flag . " = 1 WHERE articles_id = " . $articles['articles_id'] . " AND language_id = " . $lng['languages_id']);
    $updated = 1;
}}


//TODO: ve stare verzi existuje zakometovana druha verze: GENERATING_ARTICLES



//GENERATING_INFORMATION_PAGES>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>.

    $information_query = tep_db_query("SELECT information_id, information_title FROM " . TABLE_INFORMATION . " WHERE visible='1' AND information_group_id = '" . (int) $information_group_id . "' AND language_id = '" . $lng['languages_id']. "' AND " . $cached_flag . " = 0");
    while ($information = tep_db_fetch_array($information_query)) {
    if (tep_db_num_rows($information_query)) {
    echo GENERATING_INFORMATION_PAGES . "\n";


			$newpath =  RSYNC_LOCAL_DEST_PATH . OSC_DIR . str_replace(HTTP_SERVER , '' , tep_href_link(FILENAME_INFORMATION, 'info_id=' . $information['information_id'])) . "/";
				if (!is_dir($newpath)){
				shell_exec('mkdir -p ' . $newpath);
				}
			$output = "<\?php
if (isset(\$_COOKIE['osCsid']) || !empty(\$_POST)){
chdir('" . $chdir_dest_dir . "');
\$_GET['information_id']=" . $information['information_id'] . ";
\$PHP_SELF = '" . FILENAME_INFORMATION . "';
include('" . FILENAME_INFORMATION . "');
exit;
}
?>
";
			//create static
			$curl_handle=curl_init();
			curl_setopt($curl_handle, CURLOPT_URL, HTTP_SERVER . '/' . FILENAME_INFORMATION . '?info_id=' . $information['information_id']);
			curl_setopt($curl_handle, CURLOPT_USERPWD, WGET_USER . ":" . WGET_PASSWORD);
			curl_setopt($curl_handle,CURLOPT_USERAGENT,'wget');
			curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
			curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
			$output .= curl_exec($curl_handle);
			curl_close($curl_handle);
			$output = str_replace(HTTP_SERVER, '', $output);
			file_put_contents($newpath . 'index.php', stripslashes($output), 644);

    tep_db_query("UPDATE " . TABLE_INFORMATION . " SET " . $cached_flag . " = 1 WHERE information_id = " . $information['information_id'] . " AND language_id = " . $lng['languages_id']);
    $updated = 1;
}}
		if ($update_all == 'true') tep_db_query("UPDATE " . TABLE_INFORMATION . " SET " . $cached_flag . " = 1 WHERE language_id = " . $lng['languages_id']);

//GENERATING_ALL_ALL if UPDATE <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
echo 'updated je:' . $updated . "\n";
if ($updated == 1){

/*
    echo 'Generating Manufacturers index' . "\n"; 
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    $newpath = preg_replace('/\//','',MANUFACTURERS_INDEX_LINK); //CONFIG ME! <<
//file_put_contents('/tmp/cesta',$newpath);
    $scriptfile = FILENAME_MANUFACTURERS_INDEX; //CONFIG ME! <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<< !!!
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



echo GENERATING_HOMEPAGE . "\n"; //<<<<<<<<<<<<<<<<<<<<
$output = '';
/*
			$output = "<\?php
if (isset(\$_COOKIE['osCsid']) || !empty(\$_POST)){
chdir('" . $chdir_dest_dir . "');
\$_GET['products_id']=" . $products['products_id'] . ";
include('product_info.php');
exit;
}
?>
";
*/
			//create static
			$curl_handle=curl_init();
			curl_setopt($curl_handle, CURLOPT_URL,HTTP_SERVER . '/index.php');
			curl_setopt($curl_handle, CURLOPT_USERPWD, WGET_USER . ":" . WGET_PASSWORD);
			curl_setopt($curl_handle,CURLOPT_USERAGENT,'wget');
			curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
			curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
			$output .= curl_exec($curl_handle);
			curl_close($curl_handle);
			$output = str_replace(HTTP_SERVER, '', $output);
		file_put_contents(RSYNC_LOCAL_DEST_PATH . OSC_DIR . '/index.html', stripslashes($output), 644);





//tohle pustit pak taky!!!
//    $tst = file_get_contents(DIR_FS_DOCUMENT_ROOT . "/index.html");
//    if (preg_match("/<\/html>/", $tst)) file_put_contents(RSYNC_LOCAL_DEST_PATH . OSC_DIR . 'error','0'); else { file_put_contents(RSYNC_LOCAL_DEST_PATH . OSC_DIR . 'error','1'); echo "ERROR generating: index.html \n"; }


/*
//RSYNC <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
//now is finished
//todo STOP tep_db_query("UPDATE " . TABLE_ROBOT . " SET now=0");
//NEW_TODO!!!!!!!!!!!!!!!!!!!!! spravne ten error zjistit k de je ten soubor!!!!!!!!!!!!!!!!!!!!!!!!!
$error = file_get_contents(RSYNC_LOCAL_DEST_PATH . OSC_DIR . 'error');
echo 'error je: ' . $error ."\n"; 
*/
if ($error == 0) {
echo 'No errors found Rsync start ...' ."\n";
//local rsync
    if (RSYNCLOGGING=='true'){
	shell_exec('rsync -av --exclude-from  ' . DIR_FS_CONFIG . 'exclude_local.txt ' . RSYNC_LOCAL_SRC_PATH . OSC_DIR . ' ' . RSYNC_LOCAL_DEST_PATH . ' >> ' . REPLICATION_LOG_DIR . HTTPS_COOKIE_DOMAIN . '_rsync_import_ALL.osclog  2>&1');
    } else {
	shell_exec('rsync -av --exclude-from  ' . DIR_FS_CONFIG . 'exclude_local.txt ' . RSYNC_LOCAL_SRC_PATH . OSC_DIR . ' ' . RSYNC_LOCAL_DEST_PATH);
    }


if (RSYNC_TO_REMOTE == 1) {
$remoteserver = 'osc@192.168.8.57';
shell_exec('rsync --chmod=D755,F644 -ave   ssh --protocol=29  --exclude admin ' . RSYNC_LOCAL_DEST_PATH . OSC_DIR . ' ' . $remoteserver . ':' .  RSYNC_REMOTE_DEST_DIR . ' --delete');
//orig    shell_exec('~/rsync_eshop.sh >> ' . REPLICATION_LOG_DIR . HTTPS_COOKIE_DOMAIN . '_rsync_export.osclog  2>&1');
}
} else {
echo 'Rsync to Eshop ERROR !!!!!!!!!!!!!!!!!!!!!!!!!!!' ."\n";
    mail(WEBMASTER_EMAIL, 'rsync ERROR! Static Export CANCELLED: ' . HTTPS_COOKIE_DOMAIN, 'Error creating document, see log, Static Export CANCELLED!!!');

}

} //end $updated == 1

unlink('../cronlock/' . $argv['1'] . '.' . $argv['2']);
echo "DONE: " . date("Y/m/d H:i") ,  "\n"; 



exit;

$time2 = microtime(true);
echo "script execution time: ".($time2-$time1); //value in seconds
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
