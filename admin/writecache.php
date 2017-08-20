#!/usr/bin/php -q
<?php
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

*/
/// CONF BASIC <<<<<<<<<<<<<<<<<<<<<<<<<<<<
//require('includes/application_top.php');
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
ini_set('display_errors', '1');
//error_reporting(E_ALL);
/*
$lockfile = sys_get_temp_dir() . '/' . $lockname . '.lock';
if (!file_exists($lockfile)) {
   print "starting...\n";
   file_put_contents($lockfile, '1'); // create lockfile
} else {
$handle = fopen($lockfile, "r");
$counter = fread($handle, filesize($lockfile));
    if ($counter < $maxtime) {
    $counter = $counter+1;
   file_put_contents($lockfile, $counter); // create lockfile

	print "exiting!\n";
	exit;
    } else {
    unlink($lockfile);
    exit;
    }
} 
*/
//////////////CONF START <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
/// remove echo comment
///echo "'includes/configure.php'\n";
// include server parameters
require('includes/configure.php');
///echo "'filenames.php'\n";
  require(DIR_WS_INCLUDES . 'filenames.php');
///echo "database_tables.php\n";
  require(DIR_WS_INCLUDES . 'database_tables.php');
///echo "load functions: database.php\n";
  require(DIR_WS_FUNCTIONS . 'database.php');
//echo "!! DB_CONNECT\n";
  tep_db_connect(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD) or die('DB_SERVER:'.DB_SERVER.' DB_SERVER_USERNAME_ROOT:'. DB_SERVER_USERNAME_ROOT.' DB_SERVER_PASSWORD_ROOT:'.DB_SERVER_PASSWORD_ROOT.' Unable to connect to database server!');
///echo "Ctu konfiguraci..\n";
  $configuration_query = tep_db_query('select configuration_key as cfgKey, configuration_value as cfgValue from ' . TABLE_CONFIGURATION);
  while ($configuration = tep_db_fetch_array($configuration_query)) {
    define($configuration['cfgKey'], $configuration['cfgValue']);
    //echo $configuration['cfgKey']." = ".$configuration['cfgValue']."\n";
  }
///echo "cli.php\n";
 require(DIR_WS_FUNCTIONS . 'cli.php');
/*echo "general.php\n";
  require(DIR_WS_FUNCTIONS . 'general.php');*/
///echo "load functions: html_output\n";
 require(DIR_WS_FUNCTIONS . 'html_output.php');
//echo "password_funcs.php\n";
//  require(DIR_WS_FUNCTIONS . 'password_funcs.php');
//set the language
//require('includes/languages/czech/core.php');
//include('includes/header_static.php');
define('GENERATING_MANUFACTURERS', 'generuji manufacturers');
$htaccess='';
$time1 = microtime(true);
date_default_timezone_set("Europe/Prague");
$customer_group_id =0;
$information_group_id=1;
$updated = 0;
define('REPLICATION_LOG_DIR','/tmp/');
//language_code
    $lngcode_querey = tep_db_query("SELECT code, directory FROM " . TABLE_LANGUAGES . " WHERE languages_id ='" . $lng['id'] . "'");
    $lngcode = tep_db_fetch_array($lngcode_querey);
    $lc = $lngcode['code'];
    require(DIR_FS_ADMIN . DIR_WS_LANGUAGES . $lngcode['directory'] . '/core.php');
//////////////CONF END <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<

//CACHE RESET <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<



$cron_query = tep_db_query("SELECT * FROM " . TABLE_ROBOT);
$cron = tep_db_fetch_array($cron_query);

echo 'cas pro cron:' . $cron['crontime'] . "\n";
echo 'cas je:' . date("Hi") . "\n";

if ( (date("Hi") > $cron['crontime']) && (date("Hi") < $cron['crontime'] + $maxtime) ) {
echo 'cas EXIT: ' . date("H:i:s");
echo 'exiting (timeout cache reset)';
exit;
}


if (date("Hi") == $cron['crontime']) {
echo 'big upd. START---------------------------------------------';
echo 'cas BIG: ' . date("H:i:s");
//stop NOW if (date("Hi") == $cron['time'] || $cron['now'] == 1) {}
    tep_db_query("UPDATE " . TABLE_PRODUCTS_DESCRIPTION . " SET cached = 0 WHERE language_id =" . $lng['id']);
    tep_db_query("UPDATE " . TABLE_CATEGORIES_DESCRIPTION . " SET cached = 0 WHERE language_id =" . $lng['id']);
    tep_db_query("UPDATE " . TABLE_ARTICLES_DESCRIPTION . " SET cached = 0 WHERE language_id =" . $lng['id']);
    tep_db_query("UPDATE " . TABLE_INFORMATION . " SET cached = 0 WHERE language_id =" . $lng['id']);
    tep_db_query("UPDATE " . TABLE_MANUFACTURERS_INFO . " SET cached = 0 WHERE languages_id =" . $lng['id']);
    tep_db_query("UPDATE " . TABLE_TOPICS_DESCRIPTION . " SET cached = 0 WHERE language_id =" . $lng['id']);
    //delete cache content
echo 'TED MAZU >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>';
shell_exec('rm -rf ' . HTML_CACHE_DIR);
shell_exec('mkdir ' . HTML_CACHE_DIR);
//shell_exec('find ' . DIR_FS_DOCUMENT_ROOT . ' -maxdepth 1 -type l -delete');
//rsync with DELETE
//    shell_exec('~/rsync_import.sh  >> ' . REPLICATION_LOG_DIR . HTTPS_COOKIE_DOMAIN . '_rsync_import_ALL.osclog  2>&1');
    if (RSYNCLOGGING=='true'){
	shell_exec('rsync -av  /' . $homedir . '/' . $webnamedirSRC . '/' . $wwwdir . '/' . $frontenddir . '  --exclude-from=/' . $homedir . '/' . $webnamedirDEST . '/.config/osc/rsync_exclude.txt /' . $homedir . '/' . $webnamedirDEST . '/' . $wwwdir . '  --delete >> ' . REPLICATION_LOG_DIR . HTTPS_COOKIE_DOMAIN . '_rsync_import_ALL.osclog  2>&1');
    } else {
	shell_exec('rsync -av  /' . $homedir . '/' . $webnamedirSRC . '/' . $wwwdir . '/' . $frontenddir . '  --exclude-from=/' . $homedir . '/' . $webnamedirDEST . '/.config/osc/rsync_exclude.txt /' . $homedir . '/' . $webnamedirDEST . '/' . $wwwdir . '  --delete');

//	shell_exec('~/rsync_import.sh --delete');
    }
} else {
echo 'updating...' . "\n";
    if (RSYNCLOGGING=='true'){
	shell_exec('rsync -av  /' . $homedir . '/' . $webnamedirSRC . '/' . $wwwdir . '/' . $frontenddir . '  --exclude-from=/' . $homedir . '/' . $webnamedirDEST . '/.config/osc/rsync_exclude.txt /' . $homedir . '/' . $webnamedirDEST . '/' . $wwwdir . '  >> ' . REPLICATION_LOG_DIR . HTTPS_COOKIE_DOMAIN . '_rsync_import_ALL.osclog  2>&1');
//	shell_exec('~/rsync_import.sh >> ' . REPLICATION_LOG_DIR . HTTPS_COOKIE_DOMAIN . '_rsync_import-standard.osclog  2>&1');
    } else {
	shell_exec('rsync -av  /' . $homedir . '/' . $webnamedirSRC . '/' . $wwwdir . '/' . $frontenddir . '  --exclude-from=/' . $homedir . '/' . $webnamedirDEST . '/.config/osc/rsync_exclude.txt /' . $homedir . '/' . $webnamedirDEST . '/' . $wwwdir);
//	shell_exec('~/rsync_import.sh');
    }
}

//GENERATING_PRODUCTS<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<

    $products_query = tep_db_query("SELECT p.products_id, products_model, products_name, manufacturers_name 
    FROM " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION ." pd, " . TABLE_MANUFACTURERS . " m
    WHERE 
	products_status=1 
	AND p.products_id = pd.products_id 
	AND p.manufacturers_id = m.manufacturers_id
	AND pd.cached=0
	AND language_id = '" . $lng['id']. "'
	");

    while ($products = tep_db_fetch_array($products_query)) {
    if (tep_db_num_rows($products_query)) {
    echo GENERATING_PRODUCTS . "\n";
    if ($products['products_model'] !='') $model = '-' . $products['products_model']; else $model = '';
 
    $manufurl = preg_replace('/(-[a-z])*$/','',remove_accents($products['manufacturers_name']));
    $newpath = $manufurl . '/' . remove_accents($products['products_name']) . $model . '/';
//generujeme .htaccess do htaccess.tmp <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<< configme
//pure:stop    $htaccess .= 'RewriteRule ^' . remove_accents($products['products_name']) . '/$ '  . 'http://en.oikoymenh.cz/' . $newpath .' [R=301,QSA,NC,L]' ."\n";

$context = stream_context_create(array(
    'http' => array(
        'header'  => "Authorization: Basic " . base64_encode(WGET_USER . ':' . WGET_PASSWORD)
    )
));
$output = file_get_contents(HTTP_SERVER . '/product_info.php?products_id=' . $products['products_id'] . '&language='. $lc, false, $context);
    $output = str_replace(SHOP_SERVER . '/index.php"', SHOP_SERVER . '/"', $output);
//$output = preg_replace('/[&|\?]osCsid=[a-z|0-9]*/','', $output);
//NNN $output = str_replace(HTTP_SERVER, SHOP_SERVER, $output);

shell_exec("mkdir -p " . HTML_CACHE_DIR . $newpath);
if (!file_exists(DIR_FS_DOCUMENT_ROOT .  $manufurl)) {
    symlink(HTML_CACHE_DIR . $manufurl,  DIR_FS_DOCUMENT_ROOT .  $manufurl);
}
  $index_file = fopen(HTML_CACHE_DIR . $newpath . "/index.html", "w");
  fwrite($index_file, $output);
  fclose($index_file);
    $tst = file_get_contents(HTML_CACHE_DIR . $newpath . "/index.html");
    if (preg_match("/<\/html>/", $tst)) file_put_contents(HTML_CACHE_DIR . 'error','0'); else { file_put_contents(HTML_CACHE_DIR . 'error','1'); echo 'ERROR generating:' . $newpath . "\n"; }

$hta_content = 'RewriteEngine On
RewriteBase /
RewriteCond %{HTTP_COOKIE} osCsid=(.*) [NC]
RewriteRule ^$ /product_info.php?products_id=' . $products['products_id'] . '&language='. $lc . ' [QSA,L]
';
/*RewriteCond %{HTTP_HOST} ' . HTTPS_COOKIE_DOMAIN . ' [NC]
RewriteRule ^$ /product_info.php?products_id=' . $products['products_id'] . '&$language='. $lc . ' [QSA,L]*/

  $hta_file = fopen(HTML_CACHE_DIR . $newpath . "/.htaccess", "w");
  fwrite($hta_file, $hta_content);
  fclose($hta_file);
//echo 'path:'. $newpath;
//update status 
//CHANGEME
tep_db_query("UPDATE " . TABLE_PRODUCTS_DESCRIPTION . " SET cached = 1 WHERE products_id = " . $products['products_id'] . " AND language_id = " . $lng['id']);
$updated = 1;
}}


//GENERATING_MANUFACTURERS<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<

    $manufacturers_query = tep_db_query("SELECT m.manufacturers_id, manufacturers_name  FROM " . TABLE_MANUFACTURERS . " m, " . TABLE_MANUFACTURERS_INFO . " mi
    WHERE
	m.manufacturers_id = mi.manufacturers_id
	AND mi.cached=0
	AND languages_id = '" . $lng['id']. "'");
    while ($manufacturers = tep_db_fetch_array($manufacturers_query)) {
    if (tep_db_num_rows($manufacturers_query)) {
    echo GENERATING_MANUFACTURERS . "\n";
     $newpath = preg_replace('/(-[a-z])*$/','',remove_accents($manufacturers['manufacturers_name']));
    $context = stream_context_create(array('http' => array('header'  => "Authorization: Basic " . base64_encode(WGET_USER . ':' . WGET_PASSWORD))));
    $output = file_get_contents(HTTP_SERVER . '/index.php?manufacturers_id=' . $manufacturers['manufacturers_id'] . '&language='. $lc, false, $context);
    $output = str_replace(SHOP_SERVER . '/index.php"', SHOP_SERVER . '/"', $output);
    ///NNN    $output = str_replace(HTTP_SERVER, SHOP_SERVER, $output);
    shell_exec("mkdir -p " . HTML_CACHE_DIR . $newpath);
    if (!file_exists(DIR_FS_DOCUMENT_ROOT .  $newpath)) {
    symlink(HTML_CACHE_DIR . $newpath,  DIR_FS_DOCUMENT_ROOT .  $newpath);
    }
    $index_file = fopen(HTML_CACHE_DIR . $newpath . "/index.html", "w");
    fwrite($index_file, $output);
    fclose($index_file);
    $tst = file_get_contents(HTML_CACHE_DIR . $newpath . "/index.html");
    if (preg_match("/<\/html>/", $tst)) file_put_contents(HTML_CACHE_DIR . 'error','0'); else { file_put_contents(HTML_CACHE_DIR . 'error','1'); echo 'ERROR generating:' . $newpath . "\n"; }

    $hta_content = 'RewriteEngine On
    RewriteBase /
    RewriteCond %{HTTP_COOKIE} osCsid=(.*) [NC]
    RewriteRule ^$ /index.php?manufacturers_id=' . $manufacturers['manufacturers_id'] . '&language='. $lc . ' [QSA,L]
    ';
    /*    RewriteCond %{HTTP_HOST} ' . HTTPS_COOKIE_DOMAIN . ' [NC]
    RewriteRule ^$ /index.php?manufacturers_id=' . $manufacturers['manufacturers_id'] . '&$language='. $lc . ' [QSA,L]
    */
    $hta_file = fopen(HTML_CACHE_DIR . $newpath . "/.htaccess", "w");
    fwrite($hta_file, $hta_content);
    fclose($hta_file);
    tep_db_query("UPDATE " . TABLE_MANUFACTURERS_INFO . " SET cached = 1 WHERE manufacturers_id = " . $manufacturers['manufacturers_id'] . " AND languages_id = " . $lng['id']);
    $updated = 1;
}}


//GENERATING_CATEGORIES<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<

    $categories_query = tep_db_query("SELECT categories_id, categories_name FROM " . TABLE_CATEGORIES_DESCRIPTION . " cd 
    WHERE 
    cached=0 
    AND language_id = '" . $lng['id'] .  "'");
    while ($categories = tep_db_fetch_array($categories_query)) {
    if (tep_db_num_rows($categories_query)) {
    echo GENERATING_CATEGORIES . "\n";
    $newpath = tep_get_category_seourl($categories['categories_id'], $lng['id']);
    $context = stream_context_create(array(    'http' => array( 'header'  => "Authorization: Basic " . base64_encode(WGET_USER . ':' . WGET_PASSWORD) ) ) );
    $output = file_get_contents(HTTP_SERVER . '/index.php?cPath=' . tep_get_category_path($categories['categories_id']) . '&language='. $lc, false, $context);
    $output = str_replace(SHOP_SERVER . '/index.php"', SHOP_SERVER . '/"', $output);
    //NNN $output = str_replace(HTTP_SERVER, SHOP_SERVER, $output);
    shell_exec("mkdir -p " . HTML_CACHE_DIR . $newpath);

    $root_id = preg_replace('/_.*$/','',tep_get_category_path($categories['categories_id']));
    $root_categ_query = tep_db_query("SELECT categories_name FROM " . TABLE_CATEGORIES_DESCRIPTION . " cd WHERE categories_id = " . $root_id ." AND language_id = " . $lng['id']);
    $root_categ = tep_db_fetch_array($root_categ_query);
    $symlink = remove_accents($root_categ['categories_name']);
echo 'ma bejt syml:' . DIR_FS_DOCUMENT_ROOT . $symlink ."\n";
echo 'pro symlink:' . HTML_CACHE_DIR . $symlink,  DIR_FS_DOCUMENT_ROOT .  $symlink . "\n";
    if (!file_exists(DIR_FS_DOCUMENT_ROOT . $symlink)) {
	symlink(HTML_CACHE_DIR . $symlink,  DIR_FS_DOCUMENT_ROOT .  $symlink);
    }
    $index_file = fopen(HTML_CACHE_DIR . $newpath . "/index.html", "w");
    fwrite($index_file, $output);
    fclose($index_file);
    $tst = file_get_contents(HTML_CACHE_DIR . $newpath . "/index.html");
    if (preg_match("/<\/html>/", $tst)) file_put_contents(HTML_CACHE_DIR . 'error','0'); else { file_put_contents(HTML_CACHE_DIR . 'error','1'); echo 'ERROR generating:' . $newpath . "\n"; }

    $hta_content = 'RewriteEngine On
    RewriteBase /
    RewriteCond %{HTTP_COOKIE} osCsid=(.*) [NC]
    RewriteRule ^$ /index.php?cPath=' . tep_get_category_path($categories['categories_id']) . '&language='. $lc . ' [QSA,L]
    ';
    /*RewriteCond %{HTTP_HOST} ' . HTTPS_COOKIE_DOMAIN . ' [NC]
    RewriteRule ^$ /index.php?cPath=' . tep_get_category_path($categories['categories_id']) . '&language='. $lc . ' [QSA,L]*/
    $hta_file = fopen(HTML_CACHE_DIR . $newpath . "/.htaccess", "w");
    fwrite($hta_file, $hta_content);
    fclose($hta_file);
    //update status 
    //CHANGEME
    tep_db_query("UPDATE " . TABLE_CATEGORIES_DESCRIPTION . " SET cached = 1 WHERE categories_id = " . $categories['categories_id'] . " AND language_id = " . $lng['id']);
    $updated = 1;
}}

#>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
//echo GENERATING_TOPICS
    $topics_query = tep_db_query("SELECT topics_id, topics_name FROM " . TABLE_TOPICS_DESCRIPTION . " td
    WHERE 
    cached=0 
    AND language_id = '" . $lng['id'] .  "'");
    while ($topics = tep_db_fetch_array($topics_query)) {
    if (tep_db_num_rows($topics_query)) {
    $newpath = tep_get_topic_seourl($topics['topics_id'], $lng['id']);
echo '$newpath:' . $newpath . "\n";
echo '$lng[id]:' . $lng['id'] . "\n";

    $context = stream_context_create(array(    'http' => array( 'header'  => "Authorization: Basic " . base64_encode(WGET_USER . ':' . WGET_PASSWORD) ) ) );
    $output = file_get_contents(HTTP_SERVER . '/articles.php?tPath=' . tep_get_topic_full_path($topics['topics_id']) . '&language='. $lc, false, $context);
    $output = str_replace(SHOP_SERVER . '/index.php"', SHOP_SERVER . '/"', $output);
    //NNN $output = str_replace(HTTP_SERVER, SHOP_SERVER, $output);
    shell_exec("mkdir -p " . HTML_CACHE_DIR . $newpath);

    $root_id = preg_replace('/_.*$/','',tep_get_topic_full_path($topics['topics_id']));
    $root_topic_query = tep_db_query("SELECT topics_name FROM " . TABLE_TOPICS_DESCRIPTION . " td WHERE topics_id = " . $root_id ." AND language_id = '" . $lng['id'] .  "'");
    $root_topic = tep_db_fetch_array($root_topic_query);
    $symlink = remove_accents($root_topic['topics_name']);
    if (!file_exists(DIR_FS_DOCUMENT_ROOT . $symlink)) {
	symlink(HTML_CACHE_DIR . $symlink,  DIR_FS_DOCUMENT_ROOT .  $symlink);
    }
    $index_file = fopen(HTML_CACHE_DIR . $newpath . "/index.html", "w");
    fwrite($index_file, $output);
    fclose($index_file);

    $hta_content = 'RewriteEngine On
    RewriteBase /
    RewriteCond %{HTTP_COOKIE} osCsid=(.*) [NC]
    RewriteRule ^$ /articles.php?tPath=' . tep_get_topic_full_path($topics['topics_id']) . '&language='. $lc . ' [QSA,L]
    ';
    $hta_file = fopen(HTML_CACHE_DIR . $newpath . "/.htaccess", "w");
    fwrite($hta_file, $hta_content);
    fclose($hta_file);
    //update status 
    //CHANGEME
    tep_db_query("UPDATE " . TABLE_TOPICS_DESCRIPTION . " SET cached = 1 WHERE topics_id = " . $topics['topics_id'] . " AND language_id = " . $lng['id']);
    $updated = 1;

}}

//GENERATING_ARTICLES <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
//TODO removed condition   articles_status=1 - mazani clanku jen naoko zustanou tam, ale zmizej z HP
    $articles_query = tep_db_query("SELECT a.articles_id, articles_name FROM " . TABLE_ARTICLES . " a, " . TABLE_ARTICLES_DESCRIPTION . " ad 
    WHERE 
    a.articles_id= ad.articles_id 
    AND cached=0
    AND language_id = '" . $lng['id']. "'");
    while ($articles = tep_db_fetch_array($articles_query)) {
    if (tep_db_num_rows($articles_query)) {
    echo GENERATING_ARTICLES . "\n";
    $newpath = remove_accents($articles['articles_name']);
    $context = stream_context_create(array('http' => array('header'  => "Authorization: Basic " . base64_encode(WGET_USER . ':' . WGET_PASSWORD))));
    $output = file_get_contents(HTTP_SERVER . '/' . FILENAME_ARTICLE_INFO . '?articles_id=' . $articles['articles_id'] . '&language='. $lc, false, $context);
    $output = str_replace(SHOP_SERVER . '/index.php"', SHOP_SERVER . '/"', $output);
    //NNN    $output = str_replace(HTTP_SERVER, SHOP_SERVER, $output);
    shell_exec("mkdir -p " . HTML_CACHE_DIR . $newpath);
    $index_file = fopen(HTML_CACHE_DIR . $newpath . "/index.html", "w");
    fwrite($index_file, $output);
    fclose($index_file);
    $tst = file_get_contents(HTML_CACHE_DIR . $newpath . "/index.html");
    if (preg_match("/<\/html>/", $tst)) file_put_contents(HTML_CACHE_DIR . 'error','0'); else { file_put_contents(HTML_CACHE_DIR . 'error','1'); echo 'ERROR generating:' . $newpath . "\n"; }


    if (!file_exists(DIR_FS_DOCUMENT_ROOT .  $newpath)) {
	symlink(HTML_CACHE_DIR . $newpath,  DIR_FS_DOCUMENT_ROOT .  $newpath);
    }

    $hta_content = 'RewriteEngine On
    RewriteBase /
    RewriteCond %{HTTP_COOKIE} osCsid=(.*) [NC]
    RewriteRule ^$ /' . FILENAME_ARTICLE_INFO . '?articles_id=' . $articles['articles_id'] . '&$language='. $lc . ' [QSA,L]
    ';
    /*    RewriteCond %{HTTP_HOST} ' . HTTPS_COOKIE_DOMAIN . ' [NC]
    RewriteRule ^$ /' . FILENAME_ARTICLE_INFO . '?articles_id=' . $articles['articles_id'] . '&$language='. $lc . ' [QSA,L]*/
    $hta_file = fopen(HTML_CACHE_DIR . $newpath . "/.htaccess", "w");
    fwrite($hta_file, $hta_content);
    fclose($hta_file);
    tep_db_query("UPDATE " . TABLE_ARTICLES_DESCRIPTION . " SET cached = 1 WHERE articles_id = " . $articles['articles_id'] . " AND language_id = " . $lng['id']);
    $updated = 1;
}}


/*old ARTICLES SMAZAT
//GENERATING_ARTICLES <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
//TODO removed condition   articles_status=1 - mazani clanku jen naoko zustanou tam, ale zmizej z HP
    $articles_query = tep_db_query("SELECT a.articles_id, articles_name FROM " . TABLE_ARTICLES . " a, " . TABLE_ARTICLES_DESCRIPTION . " ad 
    WHERE 
    a.articles_id= ad.articles_id 
    AND cached=0
    AND language_id = '" . $lng['id']. "'");
    while ($articles = tep_db_fetch_array($articles_query)) {
    if (tep_db_num_rows($articles_query)) {
    echo GENERATING_ARTICLES . "\n";
    $newpath = remove_accents($articles['articles_name']);
    $context = stream_context_create(array('http' => array('header'  => "Authorization: Basic " . base64_encode(WGET_USER . ':' . WGET_PASSWORD))));
    $output = file_get_contents(HTTP_SERVER . '/' . FILENAME_ARTICLE_INFO . '?articles_id=' . $articles['articles_id'] . '&language='. $lc, false, $context);
    $output = str_replace(SHOP_SERVER . '/index.php"', SHOP_SERVER . '/"', $output);
    //NNN    $output = str_replace(HTTP_SERVER, SHOP_SERVER, $output);
    shell_exec("mkdir -p " . HTML_CACHE_DIR . $newpath);
    $index_file = fopen(HTML_CACHE_DIR . $newpath . "/index.html", "w");
    fwrite($index_file, $output);
    fclose($index_file);
    $tst = file_get_contents(HTML_CACHE_DIR . $newpath . "/index.html");
    if (preg_match("/<\/html>/", $tst)) file_put_contents(HTML_CACHE_DIR . 'error','0'); else { file_put_contents(HTML_CACHE_DIR . 'error','1'); echo 'ERROR generating:' . $newpath . "\n"; }


    if (!file_exists(DIR_FS_DOCUMENT_ROOT .  $newpath)) {
	symlink(HTML_CACHE_DIR . $newpath,  DIR_FS_DOCUMENT_ROOT .  $newpath);
    }

    $hta_content = 'RewriteEngine On
    RewriteBase /
    RewriteCond %{HTTP_COOKIE} osCsid=(.*) [NC]
    RewriteRule ^$ /' . FILENAME_ARTICLE_INFO . '?articles_id=' . $articles['articles_id'] . '&$language='. $lc . ' [QSA,L]
    ';
    //   RewriteCond %{HTTP_HOST} ' . HTTPS_COOKIE_DOMAIN . ' [NC]
    //RewriteRule ^$ /' . FILENAME_ARTICLE_INFO . '?articles_id=' . $articles['articles_id'] . '&$language='. $lc . ' [QSA,L]
    $hta_file = fopen(HTML_CACHE_DIR . $newpath . "/.htaccess", "w");
    fwrite($hta_file, $hta_content);
    fclose($hta_file);
    tep_db_query("UPDATE " . TABLE_ARTICLES_DESCRIPTION . " SET cached = 1 WHERE articles_id = " . $articles['articles_id'] . " AND language_id = " . $lng['id']);
    $updated = 1;
}}
*/

//GENERATING_INFORMATION_PAGES>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>.

    $information_query = tep_db_query("SELECT information_id, information_title FROM " . TABLE_INFORMATION . " WHERE visible='1' and  NOT find_in_set('" . $customer_group_id . "', info_cg_hide)  and information_group_id = '" . (int) $information_group_id . "' AND language_id = '" . $lng['id']. "' AND cached=0");
    while ($information = tep_db_fetch_array($information_query)) {
    if (tep_db_num_rows($information_query)) {
    echo GENERATING_INFORMATION_PAGES . "\n";

    $newpath = remove_accents($information['information_title']);
    $context = stream_context_create(array('http' => array('header'  => "Authorization: Basic " . base64_encode(WGET_USER . ':' . WGET_PASSWORD))));
    $output = file_get_contents(HTTP_SERVER . '/' . FILENAME_INFORMATION . '?info_id=' . $information['information_id'] . '&language='. $lc, false, $context);
    $output = str_replace(SHOP_SERVER . '/index.php"', SHOP_SERVER . '/"', $output);
//NNN    $output = str_replace(HTTP_SERVER, SHOP_SERVER, $output);
    shell_exec("mkdir -p " . HTML_CACHE_DIR . $newpath);
    $index_file = fopen(HTML_CACHE_DIR . $newpath . "/index.html", "w");
    fwrite($index_file, $output);
    fclose($index_file);
    $tst = file_get_contents(HTML_CACHE_DIR . $newpath . "/index.html");
    if (preg_match("/<\/html>/", $tst)) file_put_contents(HTML_CACHE_DIR . 'error','0'); else { file_put_contents(HTML_CACHE_DIR . 'error','1'); echo 'ERROR generating:' . $newpath . "\n"; }

    if (!file_exists(DIR_FS_DOCUMENT_ROOT .  $newpath)) {
	symlink(HTML_CACHE_DIR . $newpath,  DIR_FS_DOCUMENT_ROOT .  $newpath);
    }

    $hta_content = 'RewriteEngine On
    RewriteBase /
    RewriteCond %{HTTP_COOKIE} osCsid=(.*) [NC]
    RewriteRule ^$ /' . FILENAME_INFORMATION . '?info_id=' . $information['information_id'] . '$&language='. $lc . ' [QSA,L]
    ';
    $hta_file = fopen(HTML_CACHE_DIR . $newpath . "/.htaccess", "w");
    fwrite($hta_file, $hta_content);
    fclose($hta_file);
    tep_db_query("UPDATE " . TABLE_INFORMATION . " SET cached = 1 WHERE information_id = " . $information['information_id'] . " AND language_id = " . $lng['id']);
    $updated = 1;
}}




//GENERATING_ALL_ALL if UPDATE <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
echo 'updated je:' . $updated . "\n";
if ($updated == 1){

    echo 'Generating Manufacturers index' . "\n"; //<<<<<<<<<<<<<<<<<<<<
    $newpath = preg_replace('/\//','',MANUFACTURERS_INDEX_LINK); //CONFIG ME! <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<< !!!
//file_put_contents('/tmp/cesta',$newpath);
    $scriptfile = FILENAME_MANUFACTURERS_INDEX; //CONFIG ME! <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<< !!!
    $context = stream_context_create(array('http' => array('header'  => "Authorization: Basic " . base64_encode(WGET_USER . ':' . WGET_PASSWORD))));
    //NNN    $output = str_replace(HTTP_SERVER, SHOP_SERVER, $output);
    $output = file_get_contents(HTTP_SERVER . '/' . $scriptfile . '?language='. $lc, false, $context);
//echo 'oooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooo' .$output;
    //    $output = HTTP_SERVER . '/' . FILENAME_MANUFACTURERS_INDEX . '?language='. $lc;
    $output = str_replace(SHOP_SERVER . '/index.php"', SHOP_SERVER . '/"', $output);
    shell_exec("mkdir -p " . HTML_CACHE_DIR . $newpath);
    
    $index_file = fopen(HTML_CACHE_DIR . $newpath . "/index.html", "w");
    fwrite($index_file, $output);
    fclose($index_file);
    $tst = file_get_contents(HTML_CACHE_DIR . $newpath . "/index.html");
    if (preg_match("/<\/html>/", $tst)) file_put_contents(HTML_CACHE_DIR . 'error','0'); else { file_put_contents(HTML_CACHE_DIR . 'error','1'); echo 'ERROR generating:' . $newpath . "\n"; }

    if (!file_exists(DIR_FS_DOCUMENT_ROOT .  $newpath)) {
    symlink(HTML_CACHE_DIR . $newpath,  DIR_FS_DOCUMENT_ROOT .  $newpath);
    }


    $hta_content = 'RewriteEngine On
    RewriteBase /
    RewriteCond %{HTTP_COOKIE} osCsid=(.*) [NC]
    RewriteRule ^$ /' . $scriptfile . '?language='. $lc . ' [QSA,L]';
    $hta_file = fopen(HTML_CACHE_DIR . $newpath . "/.htaccess", "w");
    fwrite($hta_file, $hta_content);
    fclose($hta_file);

    echo 'Generating MySQL ERROR Page' . "\n"; //<<<<<<<<<<<<<<<<<<<<
    $newpath = preg_replace('/\/$/','','safe_mode.html'); //CONFIG ME! <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<< !!!
    $scriptfile = FILENAME_SAFE_MODE; //CONFIG ME! <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<< !!!
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
    if (preg_match("/<\/html>/", $tst)) file_put_contents(HTML_CACHE_DIR . 'error','0'); else { file_put_contents(HTML_CACHE_DIR . 'error','1'); echo 'ERROR generating:' . $newpath . "\n"; }




echo 'Generating All products Page' . "\n"; //<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
    $newpath = remove_accents(preg_replace('/\/$/','',BOX_CATALOG_PRODUCTS_WITH_IMAGES)); //CONFIG ME!
    $scriptfile = FILENAME_CATALOG_PRODUCTS_WITH_IMAGES; //CONFIG ME! <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<< !!!
    $context = stream_context_create(array('http' => array('header'  => "Authorization: Basic " . base64_encode(WGET_USER . ':' . WGET_PASSWORD))));
//NNN    $output = str_replace(HTTP_SERVER, SHOP_SERVER, $output);
    $output = file_get_contents(HTTP_SERVER . '/' . $scriptfile . '?language='. $lc, false, $context);
//    $output = HTTP_SERVER . '/' . FILENAME_MANUFACTURERS_INDEX . '?language='. $lc;
    $output = str_replace(SHOP_SERVER . '/index.php"', SHOP_SERVER . '/"', $output);
//echo $output;
    shell_exec("mkdir -p " . HTML_CACHE_DIR . $newpath);

    $index_file = fopen(HTML_CACHE_DIR . $newpath . "/index.html", "w");
    fwrite($index_file, $output);
//    fwrite($index_file, 'err'); //test error
    fclose($index_file);
    $tst = file_get_contents(HTML_CACHE_DIR . $newpath . "/index.html");
    if (preg_match("/<\/html>/", $tst)) file_put_contents(HTML_CACHE_DIR . 'error','0'); else { file_put_contents(HTML_CACHE_DIR . 'error','1'); echo 'ERROR generating:' . $newpath . "\n"; }


    if (!file_exists(DIR_FS_DOCUMENT_ROOT .  $newpath)) {
    symlink(HTML_CACHE_DIR . $newpath,  DIR_FS_DOCUMENT_ROOT .  $newpath);
}


    $hta_content = 'RewriteEngine On
    RewriteBase /
    RewriteCond %{HTTP_COOKIE} osCsid=(.*) [NC]
    RewriteRule ^$ /' . $scriptfile . '?language='. $lc . ' [QSA,L]
    ';
    $hta_file = fopen(HTML_CACHE_DIR . $newpath . "/.htaccess", "w");
    fwrite($hta_file, $hta_content);
    fclose($hta_file);




echo GENERATING_HOMEPAGE . "\n"; //<<<<<<<<<<<<<<<<<<<<
    $context = stream_context_create(array('http' => array('header'  => "Authorization: Basic " . base64_encode(WGET_USER . ':' . WGET_PASSWORD))));
//NNN    $output = str_replace(HTTP_SERVER, SHOP_SERVER, $output);
    $output = str_replace(SHOP_SERVER . '/index.php"', SHOP_SERVER . '/"', $output);
    $output = file_get_contents(HTTP_SERVER . '/' . FILENAME_DEFAULT . '?language='. $lc, false, $context);
//echo $output;

    $index_file = fopen(DIR_FS_DOCUMENT_ROOT .  "/index.html", "w");
    fwrite($index_file, $output);
    fclose($index_file);
    $tst = file_get_contents(DIR_FS_DOCUMENT_ROOT . "/index.html");
    if (preg_match("/<\/html>/", $tst)) file_put_contents(HTML_CACHE_DIR . 'error','0'); else { file_put_contents(HTML_CACHE_DIR . 'error','1'); echo "ERROR generating: index.html \n"; }

}

//RSYNC <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
//now is finished
//todo STOP tep_db_query("UPDATE " . TABLE_ROBOT . " SET now=0");
$error = file_get_contents(HTML_CACHE_DIR . 'error');
echo 'error je: ' . $error ."\n"; 
if ($error == 0) {
echo 'Rsync to Eshop OK ...' ."\n";
shell_exec('rsync --chmod=D755,F644 -ave   ssh --protocol=29  /' . $homedir . '/' . $webnamedir . '/' . $wwwdir . '/' . $frontenddir . ' --exclude-from=/' . $homedir . '/' . $webnamedirDEST . '/.config/osc/rsync_eshop_exclude.txt  ' . $remoteeshop . ':/' . $homedir . '/' . $webnamedir . '/' . $wwwdir . ' --delete');
//orig    shell_exec('~/rsync_eshop.sh >> ' . REPLICATION_LOG_DIR . HTTPS_COOKIE_DOMAIN . '_rsync_export.osclog  2>&1');
} else {
echo 'Rsync to Eshop ERROR !!!!!!!!!!!!!!!!!!!!!!!!!!!' ."\n";
    mail(WEBMASTER_EMAIL, 'rsync ERROR! Static Export CANCELLED: ' . HTTPS_COOKIE_DOMAIN, 'Error creating document, see log, Static Export CANCELLED!!!');

}
//$htaccess_all = $htaccess0 . $htaccess . $htaccess1;
//		if(isset($_POST['create'])){
if ($htaccess!='') {
		  $htaccess_file = fopen("/tmp/oik-htaccess.tmp", "a");
		  fwrite($htaccess_file, $htaccess);
		  fclose($htaccess_file);
		  echo "htaccess files Created!<br />";
}

exit;
    
//} //end lang loop
////echo GENERATING_CACHE_DONE . "\n";

//$arr = get_defined_functions();
//////////////echo $htaccess1;


//remove lock
//unlink($lockfile);





//print_r($arr);
//$time2 = microtime(true);
//echo "script execution time: ".($time2-$time1); //value in seconds

//		}

