<?php
use Ease\Locale as Loc;
use PHPMailer\PHPMailer\PHPMailer;
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2014 osCommerce

  Edited by 2014 Newburns Design and Technology
 * ************************************************
 * *********** New addon definitions **************
 * ***********        Below          **************
 * ************************************************
  Alternative Administration System added -- http://addons.oscommerce.com/info/9135

  Released under the GNU General Public License
 */

// Start the clock for the page parse time log
define('PAGE_PARSE_START_TIME', microtime());

// load server configuration parameters
if (file_exists('includes/local/configure.php')) { // for developers
    include('includes/local/configure.php');
} else {
    include('../../../oscconfig/admin/configure.php');
    include('../../../oscconfig/dbconfigure.php');
}

require_once constant('DIR_FS_CATALOG').'../vendor/autoload.php';
Loc::singleton(null, '../i18n','pureosc');

// some code to solve compatibility issues
require(DIR_WS_FUNCTIONS.'compatibility.php');

// set the type of request (secure or not)
$request_type = (getenv('HTTPS') == 'on') ? 'SSL' : 'NONSSL';

// set php_self in the local scope
$req      = parse_url($HTTP_SERVER_VARS['SCRIPT_NAME']);
$_SERVER['PHP_SELF'] = substr($req['path'],
    ($request_type == 'SSL') ? strlen(DIR_WS_HTTPS_ADMIN) : strlen(DIR_WS_ADMIN));

// Used in the "Backup Manager" to compress backups
define('LOCAL_EXE_GZIP', 'gzip');
define('LOCAL_EXE_GUNZIP', 'gunzip');
define('LOCAL_EXE_ZIP', 'zip');
define('LOCAL_EXE_UNZIP', 'unzip');

// include the list of project filenames
require(DIR_WS_INCLUDES.'filenames.php');

// include the list of project database tables
require(DIR_WS_INCLUDES.'database_tables.php');

// Define how do we update currency exchange rates
// Possible values are 'oanda' 'xe' or ''
define('CURRENCY_SERVER_PRIMARY', 'oanda');
define('CURRENCY_SERVER_BACKUP', 'xe');

// include the database functions
require(DIR_WS_FUNCTIONS.'database.php');

// make a connection to the database... now
tep_db_connect() or die('Unable to connect to database server!');

// set application wide parameters
$configuration_query = tep_db_query('select configuration_key as cfgKey, configuration_value as cfgValue from '.TABLE_CONFIGURATION);
while ($configuration       = tep_db_fetch_array($configuration_query)) {
    define($configuration['cfgKey'], $configuration['cfgValue']);
}

// define our general functions used application-wide
require(DIR_WS_FUNCTIONS.'general.php');
require(DIR_WS_FUNCTIONS.'html_output.php');

// define how the session functions will be used
require(DIR_WS_FUNCTIONS.'sessions.php');

// set the cookie domain
$cookie_domain = (($request_type == 'NONSSL') ? HTTP_COOKIE_DOMAIN : HTTPS_COOKIE_DOMAIN);
$cookie_path   = (($request_type == 'NONSSL') ? HTTP_COOKIE_PATH : HTTPS_COOKIE_PATH);

// set the session name and save path
tep_session_name('osCAdminID');
tep_session_save_path(SESSION_WRITE_DIRECTORY);

// set the session cookie parameters
if (function_exists('session_set_cookie_params')) {
    session_set_cookie_params(0, $cookie_path, $cookie_domain);
} elseif (function_exists('ini_set')) {
    ini_set('session.cookie_lifetime', '0');
    ini_set('session.cookie_path', $cookie_path);
    ini_set('session.cookie_domain', $cookie_domain);
}

@ini_set('session.use_only_cookies',
        (SESSION_FORCE_COOKIE_USE == 'True') ? 1 : 0);

// lets start our session
tep_session_start();

if ((PHP_VERSION >= 4.3) && function_exists('ini_get') && (ini_get('register_globals')
    === false)) {
    extract($_SESSION, EXTR_OVERWRITE + EXTR_REFS);
}

// set the language
if (!tep_session_is_registered('language') || isset($_GET['language'])) {
    if (!tep_session_is_registered('language')) {
        tep_session_register('language');
        tep_session_register('languages_id');
    }

    $lng = new language();

    if (isset($_GET['language']) && tep_not_null($_GET['language'])) {
        $lng->set_language($_GET['language']);
    } else {
      $browser_language = preg_replace('/,.*/','',$_SERVER['HTTP_ACCEPT_LANGUAGE']);
      if (preg_match('/^en/', $browser_language)){
        $browser_language = 'en';
      }
      $languages_all_query = tep_db_query("SELECT code FROM " . constant('TABLE_LANGUAGES'));
       while ($languages_all = tep_db_fetch_array($languages_all_query)) {
         if ($languages_all['code'] == $browser_language) {
           $new_language = $browser_language;
       }
       }
      if ($new_language){
        $lng->set_language($new_language);
      } else {
        $lng->set_language(constant('DEFAULT_LANGUAGE'));
      }
    }  
} else {
    $lng = new language();
  //$lng->set_language($_SESSION['language']);
      $language_code_query = tep_db_query("SELECT code FROM " . constant('TABLE_LANGUAGES') . " WHERE languages_id =  '" . $_SESSION['languages_id'] . "'");
      $language_code = tep_db_fetch_array($language_code_query);
    $lng->set_language($language_code['code']);
    }

    
    Loc::singleton()->useLocale($lng->language['locale']);
    
    $language     = $lng->language['directory'];
    $languages_id = $lng->language['id'];

// redirect to login page if administrator is not yet logged in
if (!tep_session_is_registered('admin')) {
    $redirect = false;

    $current_page = $_SERVER['PHP_SELF'];

// if the first page request is to the login page, set the current page to the index page
// so the redirection on a successful login is not made to the login page again
    if (($current_page == FILENAME_LOGIN) && !tep_session_is_registered('redirect_origin')) {
        $current_page = FILENAME_DEFAULT;
        $_GET         = array();
    }

    if (basename($current_page) != FILENAME_LOGIN) {
        if (!tep_session_is_registered('redirect_origin')) {
            tep_session_register('redirect_origin');

            $redirect_origin = array('page' => $current_page,
                'get' => $_GET);
        }

// try to automatically login with the HTTP Authentication values if it exists
        if (!tep_session_is_registered('auth_ignore')) {
            if (isset($HTTP_SERVER_VARS['PHP_AUTH_USER']) && !empty($HTTP_SERVER_VARS['PHP_AUTH_USER'])
                && isset($HTTP_SERVER_VARS['PHP_AUTH_PW']) && !empty($HTTP_SERVER_VARS['PHP_AUTH_PW'])) {
                $redirect_origin['auth_user'] = $HTTP_SERVER_VARS['PHP_AUTH_USER'];
                $redirect_origin['auth_pw']   = $HTTP_SERVER_VARS['PHP_AUTH_PW'];
            }
        }

        $redirect = true;
    }

    if (!isset($login_request) || isset($_GET['login_request']) || isset($_POST['login_request'])
        || isset($HTTP_COOKIE_VARS['login_request']) || isset($HTTP_SESSION_VARS['login_request'])
        || isset($HTTP_POST_FILES['login_request']) || isset($HTTP_SERVER_VARS['login_request'])) {
        $redirect = true;
    }

    /*     * * Altered for Alternative Administration System **
      if ($redirect == true) {
      tep_redirect(tep_href_link(FILENAME_LOGIN, (isset($redirect_origin['auth_user']) ? 'action=process' : '')));
      }
     */
    if ($redirect == true) {
        if (basename($current_page) == FILENAME_AAS) $sessionTimeout = true;
        else
                tep_redirect(tep_href_link(FILENAME_LOGIN,
                    (isset($redirect_origin['auth_user']) ? 'action=process' : '')));
    }
    /*     * * EOF alteration for Alternative Administration System ** */

    unset($redirect);
}

// include the language translations
$_system_locale_numeric = setlocale(LC_NUMERIC, 0);
require(DIR_WS_LANGUAGES.$language.'.php');
setlocale(LC_NUMERIC, $_system_locale_numeric); // Prevent LC_ALL from setting LC_NUMERIC to a locale with 1,0 float/decimal values instead of 1.0 (see bug #634)

$current_page = basename($_SERVER['PHP_SELF']);
if (file_exists(DIR_WS_LANGUAGES.$language.'/'.$current_page)) {
    include(DIR_WS_LANGUAGES.$language.'/'.$current_page);
}

// define our localization functions
require(DIR_WS_FUNCTIONS.'localization.php');

// Include validation functions (right now only email address)
require(DIR_WS_FUNCTIONS.'validations.php');

// initialize the message stack for output messages
$messageStack = new AdminMessageStack();
$phpMail = new PHPMailer();



// calculate category path
if (isset($_GET['cPath'])) {
    $cPath = $_GET['cPath'];
} else {
    $cPath = '';
}

if (tep_not_null($cPath)) {
    $cPath_array         = tep_parse_category_path($cPath);
    $cPath               = implode('_', $cPath_array);
    $current_category_id = end($cPath_array);
} else {
    $current_category_id = 0;
}

// initialize configuration modules
$cfgModules = new cfg_modules();

// the following cache blocks are used in the Tools->Cache section
// ('language' in the filename is automatically replaced by available languages)
$cache_blocks = array(array('title' => TEXT_CACHE_CATEGORIES, 'code' => 'categories',
        'file' => 'categories_box-language.cache', 'multiple' => true),
    array('title' => TEXT_CACHE_MANUFACTURERS, 'code' => 'manufacturers', 'file' => 'manufacturers_box-language.cache',
        'multiple' => true),
    array('title' => TEXT_CACHE_ALSO_PURCHASED, 'code' => 'also_purchased', 'file' => 'also_purchased-language.cache',
        'multiple' => true)
);

/* Enable KCFinder, the filemanager in ckeditor */
$_SESSION['KCFINDER']             = array();
$_SESSION['KCFINDER']['disabled'] = false;
/* * ** BEGIN ARTICLE MANAGER *** */
// include the articles functions
require(DIR_WS_FUNCTIONS.'articles.php');

// Article Manager
if (isset($_GET['tPath'])) {
    $tPath = $_GET['tPath'];
} else {
    $tPath = '';
}

if (tep_not_null($tPath)) {
    $tPath_array      = tep_parse_topic_path($tPath);
    $tPath            = implode('_', $tPath_array);
    $current_topic_id = $tPath_array[(sizeof($tPath_array) - 1)];
} else {
    $current_topic_id = 0;
}
/* * ** END ARTICLE MANAGER *** */

$oPage = new \PureOSC\ui\WebPage();

// include the breadcrumb class and start the breadcrumb trail
require(DIR_FS_CATALOG.'includes/classes/breadcrumb.php');
$breadcrumb = new breadcrumb;

if (isset($_SESSION['admin']['id'])) {
$messageStack = new AdminMessageStack;
$adminLog     = new PureOSC\CustomerLog();
$adminLog->setAdministratorID($_SESSION['admin']['id']);

}
