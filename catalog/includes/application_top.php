<?php
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
  SEO Header Tags Reloaded added -- http://addons.oscommerce.com/info/8864
  Security Pro R11 added -- http://addons.oscommerce.com/info/7708

  Released under the GNU General Public License
 */
// start the timer for the page parse time log
define('PAGE_PARSE_START_TIME', microtime());

require_once dirname( __DIR__ ).'/../vendor/autoload.php' ;

// load server configuration parameters
if (file_exists('includes/local/configure.php')) { // for developers
    include('includes/local/configure.php');
} else {
    include('../../oscconfig/configure.php');
    include('../../oscconfig/dbconfigure.php');
}

if (empty(constant('DB_SERVER'))) {
    if (is_dir('install')) {
        header('Location: install/index.php');
        exit;
    }
}

// some code to solve compatibility issues
require(DIR_WS_FUNCTIONS.'compatibility.php');

// set default timezone if none exists (PHP 5.3 throws an E_WARNING)
date_default_timezone_set(defined('CFG_TIME_ZONE') ? CFG_TIME_ZONE : date_default_timezone_get());

// set the type of request (secure or not)
$request_type = (getenv('HTTPS') == 'on') ? 'SSL' : 'NONSSL';

// set php_self in the local scope
$req      = parse_url($_SERVER['SCRIPT_NAME']);
//PURE:NEW:PURE_SEO_URLS only if $_SERVER['PHP_SELF'] is empty...
if (!($_SERVER['PHP_SELF']))
        $_SERVER['PHP_SELF'] = substr($req['path'],
        ($request_type == 'NONSSL') ? strlen(DIR_WS_HTTP_CATALOG) : strlen(DIR_WS_HTTPS_CATALOG));

/* * * Altered for Security Pro r11 ** */

$security_pro = new Fwr_Media_Security_Pro();
// If you need to exclude a file from cleansing then you can add it like below
//$security_pro->addExclusion( 'some_file.php' );
$security_pro->addExclusion('advanced_search_result.php');
$security_pro->addExclusion('advanced_search.php');
$security_pro->cleanse($_SERVER['PHP_SELF']);
/* * * EOF alteration for Security Pro 11 ** */

if ($request_type == 'NONSSL') {
    define('DIR_WS_CATALOG', DIR_WS_HTTP_CATALOG);
} else {
    define('DIR_WS_CATALOG', DIR_WS_HTTPS_CATALOG);
}

// include the list of project filenames
require(DIR_WS_INCLUDES.'filenames.php');

// include the list of project database tables
require(DIR_WS_INCLUDES.'database_tables.php');

// include the database functions
require(DIR_WS_FUNCTIONS.'database.php');

// make a connection to the database... now
tep_db_connect() or die('Unable to connect to database server!');

// set the application parameters
$configuration_query = tep_db_query('select configuration_key as cfgKey, configuration_value as cfgValue from '.TABLE_CONFIGURATION);
while ($configuration       = tep_db_fetch_array($configuration_query)) {
    if(defined($configuration['cfgKey'])){
//        echo sprintf( _('Configuration %s key alreay defined!'),$configuration['cfgKey']);
    } else {
        define($configuration['cfgKey'], $configuration['cfgValue']);
    }
}


// set the HTTP GET parameters manually if search_engine_friendly_urls is enabled
if (SEARCH_ENGINE_FRIENDLY_URLS == 'true') {
    if (strlen(getenv('PATH_INFO')) > 1) {
        $GET_array = array();
        $_SERVER['PHP_SELF']  = str_replace(getenv('PATH_INFO'), '', $_SERVER['PHP_SELF']);
        $vars      = explode('/', substr(getenv('PATH_INFO'), 1));
        do_magic_quotes_gpc($vars);
        $n         = sizeof($vars);
        for ($i = 0; $i < $n; $i++) {
            if (strpos($vars[$i], '[]')) {
                $GET_array[substr($vars[$i], 0, -2)][] = $vars[$i + 1];
            } else {
                $_GET[$vars[$i]] = $vars[$i + 1];
            }
            $i++;
        }

        if ($GET_array !== null) {
            foreach ($GET_array as $key => $value) {
                $_GET[$key] = $value;
            }
        }
    }
}

// define general functions used application-wide
require(DIR_WS_FUNCTIONS.'general.php');
require(DIR_WS_FUNCTIONS.'html_output.php');

// set the cookie domain
$cookie_domain = (($request_type == 'NONSSL') ? HTTP_COOKIE_DOMAIN : HTTPS_COOKIE_DOMAIN);
$cookie_path   = (($request_type == 'NONSSL') ? HTTP_COOKIE_PATH : HTTPS_COOKIE_PATH);

// include cache functions if enabled
if (USE_CACHE == 'true') include(DIR_WS_FUNCTIONS.'cache.php');

// include shopping cart class
require(DIR_WS_CLASSES.'shopping_cart.php');

// include navigation history class
require(DIR_WS_CLASSES.'navigation_history.php');

// define how the session functions will be used
require(DIR_WS_FUNCTIONS.'sessions.php');

// set the session name and save path
tep_session_name('osCsid');
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

// set the session ID if it exists
if (SESSION_FORCE_COOKIE_USE == 'False') {
    if (isset($_GET[tep_session_name()]) && (!isset($_COOKIE[tep_session_name()])
        || ($_COOKIE[tep_session_name()] != $_GET[tep_session_name()]))) {
        tep_session_id($_GET[tep_session_name()]);
    } elseif (isset($_POST[tep_session_name()]) && (!isset($_COOKIE[tep_session_name()])
        || ($_COOKIE[tep_session_name()] != $_POST[tep_session_name()]))) {
        tep_session_id($_POST[tep_session_name()]);
    }
}

// start the session
$session_started = false;
if (SESSION_FORCE_COOKIE_USE == 'True') {
    tep_setcookie('cookie_test', 'please_accept_for_session', 0, $cookie_path,
        $cookie_domain); //PURE:BUGFIX privacy - session expires: 0 = only session cookies 

    if (isset($_COOKIE['cookie_test'])) {
        tep_session_start();
        $session_started = true;
    }
} elseif (SESSION_BLOCK_SPIDERS == 'True') {
    $user_agent  = strtolower(getenv('HTTP_USER_AGENT'));
    $spider_flag = false;

    if (tep_not_null($user_agent)) {
        $spiders = file(DIR_WS_INCLUDES.'spiders.txt');

        $n = sizeof($spiders);
        for ($i = 0; $i < $n; $i++) {
            if (tep_not_null($spiders[$i])) {
                if (is_integer(strpos($user_agent, trim($spiders[$i])))) {
                    $spider_flag = true;
                    break;
                }
            }
        }
    }

    if ($spider_flag == false) {
        tep_session_start();
        $session_started = true;
    }
} else {
    tep_session_start();
    $session_started = true;
}

if (($session_started == true) && (PHP_VERSION >= 4.3) && function_exists('ini_get')
    && (ini_get('register_globals') == false)) {
    extract($_SESSION, EXTR_OVERWRITE + EXTR_REFS);
}

// initialize a session token
if (!tep_session_is_registered('sessiontoken')) {
    $sessiontoken = md5(tep_rand().tep_rand().tep_rand().tep_rand());
    tep_session_register('sessiontoken');
}

// set SID once, even if empty
$SID = (defined('SID') ? SID : '');

// verify the ssl_session_id if the feature is enabled
if (($request_type == 'SSL') && (SESSION_CHECK_SSL_SESSION_ID == 'True') && (ENABLE_SSL
    == true) && ($session_started == true)) {
    $ssl_session_id = getenv('SSL_SESSION_ID');
    if (!tep_session_is_registered('SSL_SESSION_ID')) {
        $SESSION_SSL_ID = $ssl_session_id;
        tep_session_register('SESSION_SSL_ID');
    }

    if ($SESSION_SSL_ID != $ssl_session_id) {
        tep_session_destroy();
        tep_redirect(tep_href_link(FILENAME_SSL_CHECK));
    }
}

// verify the browser user agent if the feature is enabled
if (SESSION_CHECK_USER_AGENT == 'True') {
    $http_user_agent = getenv('HTTP_USER_AGENT');
    if (!tep_session_is_registered('SESSION_USER_AGENT')) {
        $SESSION_USER_AGENT = $http_user_agent;
        tep_session_register('SESSION_USER_AGENT');
    }

    if ($SESSION_USER_AGENT != $http_user_agent) {
        tep_session_destroy();
        tep_redirect(tep_href_link(FILENAME_LOGIN));
    }
}

// verify the IP address if the feature is enabled
if (SESSION_CHECK_IP_ADDRESS == 'True') {
    $ip_address = tep_get_ip_address();
    if (!tep_session_is_registered('SESSION_IP_ADDRESS')) {
        $SESSION_IP_ADDRESS = $ip_address;
        tep_session_register('SESSION_IP_ADDRESS');
    }

    if ($SESSION_IP_ADDRESS != $ip_address) {
        tep_session_destroy();
        tep_redirect(tep_href_link(FILENAME_LOGIN));
    }
}

// create the shopping cart
if (!tep_session_is_registered('cart') || !is_object($cart)) {
    tep_session_register('cart');
    $cart = new shoppingCart;
}

// include currencies class and create an instance
$currencies = new currencies();

// include the mail classes
//pure:modified
// set the language
if (!tep_session_is_registered('language')) {
    tep_session_register('language');
    tep_session_register('languages_id');
}

$lng = new language();
if (!defined('DEFAULT_LANGUAGE')) {
    $lng->set_language('cs');
} else {
    $lng->set_language(DEFAULT_LANGUAGE);
}

$language     = $lng->language['directory'];
$languages_id = $lng->language['id'];

\Ease\Shared::initializeGetText('pureosc', 'cs_CZ', '../i18n');
//original version:
// set the language
if (!tep_session_is_registered('language') || isset($_GET['language'])) {
    if (!tep_session_is_registered('language')) {
        tep_session_register('language');
        tep_session_register('languages_id');
    }

    if (isset($_GET['language']) && tep_not_null($_GET['language'])) {
        $lng->set_language($_GET['language']);
    } else {
        $lng->get_browser_language();
    }

    $language     = $lng->language['directory'];
    $languages_id = $lng->language['id'];
}

// include the language translations
$_system_locale_numeric = setlocale(LC_NUMERIC, 0);
require(DIR_WS_LANGUAGES.$language.'.php');
setlocale(LC_NUMERIC, $_system_locale_numeric); // Prevent LC_ALL from setting LC_NUMERIC to a locale with 1,0 float/decimal values instead of 1.0 (see bug #634)
// Ultimate SEO URLs v2.2d
if ((!defined(SEO_ENABLED)) || (SEO_ENABLED == 'true')) {
    include_once('includes/classes/seo.class.php');
    if (!isset($seo_urls) || !is_object($seo_urls)) {
        $seo_urls = new SEO_URL($languages_id);
    }
}

// currency
if (!tep_session_is_registered('currency') || isset($_GET['currency']) || ( (USE_DEFAULT_LANGUAGE_CURRENCY
    == 'true') && (LANGUAGE_CURRENCY != $currency) )) {
    if (!tep_session_is_registered('currency'))
            tep_session_register('currency');

    if (isset($_GET['currency']) && $currencies->is_set($_GET['currency'])) {
        $currency = $_GET['currency'];
    } else {
        $currency = ((USE_DEFAULT_LANGUAGE_CURRENCY == 'true') && $currencies->is_set(LANGUAGE_CURRENCY))
                ? LANGUAGE_CURRENCY : DEFAULT_CURRENCY;
    }
}

// navigation history
if (!tep_session_is_registered('navigation') || !is_object($navigation)) {
    tep_session_register('navigation');
    $navigation = new navigationHistory;
}
$navigation->add_current_page();

// action recorder
include('includes/classes/action_recorder.php');
// initialize the message stack for output messages
require(DIR_WS_CLASSES.'alertbox.php');
require(DIR_WS_CLASSES.'message_stack.php');
$messageStack = new messageStack;
// Shopping cart actions
if (isset($_GET['action'])) {
// redirect the customer to a friendly cookie-must-be-enabled page if cookies are disabled
    if ($session_started == false) {
        tep_redirect(tep_href_link(FILENAME_COOKIE_USAGE));
    }

    if (DISPLAY_CART == 'true') {
        $goto       = FILENAME_SHOPPING_CART;
        $parameters = array('action', 'cPath', 'products_id', 'pid');
    } else {
        $goto = $_SERVER['PHP_SELF'];
        if ($_GET['action'] == 'buy_now') {
            $parameters = array('action', 'pid', 'products_id');
        } else {
            $parameters = array('action', 'pid');
        }
//SEO Friendly Urls Modification get the right return url when we dont display cart after certain action
        if (isset($seo_friendly_urls) && $seo_friendly_urls->enabled) {
            $gt   = $seo_friendly_urls->process_goto_link();
            if ($gt != '') $goto = $gt;
        }
    }
//SEO Friendly Urls Modification so to exclude atts GET variable used when user has selected attributes
    $parameters[] = 'atts';

    switch ($_GET['action']) {
        // customer wants to update the product quantity in their shopping cart
        case 'update_product' : $n = sizeof($_POST['products_id']);
            for ($i = 0; $i < $n; $i++) {
                if (in_array($_POST['products_id'][$i],
                        (is_array($_POST['cart_delete']) ? $_POST['cart_delete']
                                : array()))) {
                    $cart->remove($_POST['products_id'][$i]);
                    $messageStack->add_session('product_action',
                        sprintf(PRODUCT_REMOVED,
                            tep_get_products_name($_POST['products_id'][$i])),
                        'warning');
                } else {
                    $attributes = ($_POST['id'][$_POST['products_id'][$i]]) ? $_POST['id'][$_POST['products_id'][$i]]
                            : '';
                    $cart->add_cart($_POST['products_id'][$i],
                        $_POST['cart_quantity'][$i], $attributes, false);
                }
            }
            tep_redirect(tep_href_link($goto,
                    tep_get_all_get_params($parameters)));
            break;
        // customer adds a product from the products page
        case 'add_product' : if (isset($_POST['products_id']) && is_numeric($_POST['products_id'])) {
                $attributes = isset($_POST['id']) ? $_POST['id'] : '';
                $cart->add_cart($_POST['products_id'],
                    $cart->get_quantity(tep_get_uprid($_POST['products_id'],
                            $attributes)) + 1, $attributes);
            }
            $messageStack->add_session('product_action',
                sprintf(PRODUCT_ADDED,
                    tep_get_products_name((int) $_POST['products_id'])),
                'success');
            tep_redirect(tep_href_link($goto,
                    tep_get_all_get_params($parameters)));
            break;
        // customer removes a product from their shopping cart
        case 'remove_product' : if (isset($_GET['products_id'])) {
                $cart->remove($_GET['products_id']);
                $messageStack->add_session('product_action',
                    sprintf(PRODUCT_REMOVED,
                        tep_get_products_name($_GET['products_id'])), 'warning');
            }
            tep_redirect(tep_href_link($goto,
                    tep_get_all_get_params($parameters)));
            break;
        // performed by the 'buy now' button in product listings and review page
        case 'buy_now' : if (isset($_GET['products_id'])) {
                if (tep_has_product_attributes($_GET['products_id'])) {
                    tep_redirect(tep_href_link(FILENAME_PRODUCT_INFO,
                            'products_id='.$_GET['products_id']));
                } else {
                    $cart->add_cart($_GET['products_id'],
                        $cart->get_quantity($_GET['products_id']) + 1);
                    $messageStack->add_session('product_action',
                        sprintf(PRODUCT_ADDED,
                            tep_get_products_name((int) $_GET['products_id'])),
                        'success');
                }
            }
            tep_redirect(tep_href_link($goto,
                    tep_get_all_get_params($parameters)));
            break;
        case 'notify' : if (tep_session_is_registered('customer_id')) {
                if (isset($_GET['products_id'])) {
                    $notify = $_GET['products_id'];
                } elseif (isset($_GET['notify'])) {
                    $notify = $_GET['notify'];
                } elseif (isset($_POST['notify'])) {
                    $notify = $_POST['notify'];
                } else {
                    tep_redirect(tep_href_link($_SERVER['PHP_SELF'],
                            tep_get_all_get_params(array('action', 'notify'))));
                }
                if (!is_array($notify)) $notify = array($notify);
                $n      = sizeof($notify);
                for ($i = 0; $i < $n; $i++) {
                    $check_query = tep_db_query("select count(*) as count from ".TABLE_PRODUCTS_NOTIFICATIONS." where products_id = '".(int) $notify[$i]."' and customers_id = '".(int) $customer_id."'");
                    $check       = tep_db_fetch_array($check_query);
                    if ($check['count'] < 1) {
                        tep_db_query("insert into ".TABLE_PRODUCTS_NOTIFICATIONS." (products_id, customers_id, date_added) values ('".(int) $notify[$i]."', '".(int) $customer_id."', now())");
                    }
                }
                $messageStack->add_session('product_action',
                    sprintf(PRODUCT_SUBSCRIBED,
                        tep_get_products_name((int) $_GET['products_id'])),
                    'success');
                tep_redirect(tep_href_link($_SERVER['PHP_SELF'],
                        tep_get_all_get_params(array('action', 'notify'))));
            } else {
                $navigation->set_snapshot();
                tep_redirect(tep_href_link(FILENAME_LOGIN, '', 'SSL'));
            }
            break;
        case 'notify_remove' : if (tep_session_is_registered('customer_id') && isset($_GET['products_id'])) {
                $check_query = tep_db_query("select count(*) as count from ".TABLE_PRODUCTS_NOTIFICATIONS." where products_id = '".(int) $_GET['products_id']."' and customers_id = '".(int) $customer_id."'");
                $check       = tep_db_fetch_array($check_query);
                if ($check['count'] > 0) {
                    tep_db_query("delete from ".TABLE_PRODUCTS_NOTIFICATIONS." where products_id = '".(int) $_GET['products_id']."' and customers_id = '".(int) $customer_id."'");
                }
                $messageStack->add_session('product_action',
                    sprintf(PRODUCT_UNSUBSCRIBED,
                        tep_get_products_name((int) $_GET['products_id'])),
                    'warning');
                tep_redirect(tep_href_link($_SERVER['PHP_SELF'],
                        tep_get_all_get_params(array('action'))));
            } else {
                $navigation->set_snapshot();
                tep_redirect(tep_href_link(FILENAME_LOGIN, '', 'SSL'));
            }
            break;
        case 'cust_order' : if (tep_session_is_registered('customer_id') && isset($_GET['pid'])) {
                if (tep_has_product_attributes($_GET['pid'])) {
                    tep_redirect(tep_href_link(FILENAME_PRODUCT_INFO,
                            'products_id='.$_GET['pid']));
                } else {
                    $cart->add_cart($_GET['pid'],
                        $cart->get_quantity($_GET['pid']) + 1);
                }
            }
            tep_redirect(tep_href_link($goto,
                    tep_get_all_get_params($parameters)));
            break;
    }
}

// include the who's online functions
require(DIR_WS_FUNCTIONS.'whos_online.php');
tep_update_whos_online();

// include the password crypto functions
require(DIR_WS_FUNCTIONS.'password_funcs.php');

// include validation functions (right now only email address)
require(DIR_WS_FUNCTIONS.'validations.php');

// split-page-results
require(DIR_WS_CLASSES.'split_page_results.php');

// infobox
require(DIR_WS_CLASSES.'boxes.php');

// auto activate and expire banners
require(DIR_WS_FUNCTIONS.'banner.php');
tep_activate_banners();
tep_expire_banners();

// auto expire special products
require(DIR_WS_FUNCTIONS.'specials.php');
tep_expire_specials();

require(DIR_WS_CLASSES.'osc_template.php');
$oscTemplate = new oscTemplate();

// calculate category path
if (isset($_GET['cPath'])) {
    $cPath = $_GET['cPath'];
} elseif (isset($_GET['products_id']) && !isset($_GET['manufacturers_id'])) {
    $cPath = tep_get_product_path($_GET['products_id']);
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

// include category tree class
require(DIR_WS_CLASSES.'category_tree.php');

// include the breadcrumb class and start the breadcrumb trail
require(DIR_WS_CLASSES.'breadcrumb.php');
$breadcrumb = new breadcrumb;

$breadcrumb->add(HEADER_TITLE_TOP, HTTP_SERVER);
$breadcrumb->add(HEADER_TITLE_CATALOG, tep_href_link(FILENAME_DEFAULT));

// add category names or the manufacturer name to the breadcrumb trail
/* * * Altered for SEO Header Tags RELOADED **
  if (isset($cPath_array)) {
  $n=sizeof($cPath_array);
  for ($i=0; $i<$n; $i++) {
  $categories_query = tep_db_query("select categories_name from " . TABLE_CATEGORIES_DESCRIPTION . " where categories_id = '" . (int)$cPath_array[$i] . "' and language_id = '" . (int)$languages_id . "'");
  if (tep_db_num_rows($categories_query) > 0) {
  $categories = tep_db_fetch_array($categories_query);
  $breadcrumb->add($categories['categories_name'], tep_href_link(FILENAME_DEFAULT, 'cPath=' . implode('_', array_slice($cPath_array, 0, ($i+1)))));
  } else {
  break;
  }
  }
  } elseif (isset($HTTP_GET_VARS['manufacturers_id'])) {
  $manufacturers_query = tep_db_query("select manufacturers_name from " . TABLE_MANUFACTURERS . " where manufacturers_id = '" . (int)$HTTP_GET_VARS['manufacturers_id'] . "'");
  if (tep_db_num_rows($manufacturers_query)) {
  $manufacturers = tep_db_fetch_array($manufacturers_query);
  $breadcrumb->add($manufacturers['manufacturers_name'], tep_href_link(FILENAME_DEFAULT, 'manufacturers_id=' . $HTTP_GET_VARS['manufacturers_id']));
  }
  }
 */
if (isset($cPath_array)) {
    for ($i = 0, $n = sizeof($cPath_array); $i < $n; $i++) {
        // header tags seo - reloaded
        $categories_query = tep_db_query("select coalesce(NULLIF(categories_seo_title, ''), categories_name) as categories_name from ".TABLE_CATEGORIES_DESCRIPTION." where categories_id = '".(int) $cPath_array[$i]."' and language_id = '".(int) $languages_id."'");
        // eof
        if (tep_db_num_rows($categories_query) > 0) {
            $categories = tep_db_fetch_array($categories_query);
            $breadcrumb->add($categories['categories_name'],
                tep_href_link(FILENAME_DEFAULT,
                    'cPath='.implode('_', array_slice($cPath_array, 0, ($i + 1)))));
        } else {
            break;
        }
    }
} elseif (isset($_GET['manufacturers_id'])) {
    // header tags seo - reloaded
    $manufacturers_query = tep_db_query("select coalesce(NULLIF(manufacturers_seo_title, ''), manufacturers_name) as manufacturers_name from ".TABLE_MANUFACTURERS." where manufacturers_id = '".(int) $_GET['manufacturers_id']."'");
    // eof
    if (tep_db_num_rows($manufacturers_query)) {
        $manufacturers = tep_db_fetch_array($manufacturers_query);
        $breadcrumb->add($manufacturers['manufacturers_name'],
            tep_href_link(FILENAME_DEFAULT,
                'manufacturers_id='.$_GET['manufacturers_id']));
    }
}
// add the products model to the breadcrumb trail
if (isset($_GET['products_id'])) {
    /*     * * Altered for SEO Header Tags RELOADED **
      $model_query = tep_db_query("select products_model from " . TABLE_PRODUCTS . " where products_id = '" . (int)$HTTP_GET_VARS['products_id'] . "'");
     */
    $model_query = tep_db_query("select coalesce(NULLIF(pd.products_seo_title, ''), p.products_model) as products_model from ".TABLE_PRODUCTS." p, ".TABLE_PRODUCTS_DESCRIPTION." pd where p.products_id = '".(int) $_GET['products_id']."' and p.products_id = pd.products_id and pd.language_id = '".(int) $languages_id."'");
    /*     * * EOF alteration for SEO Header Tags RELOADED ** */
    if (tep_db_num_rows($model_query)) {
        $model = tep_db_fetch_array($model_query);
        $breadcrumb->add($model['products_model'],
            tep_href_link(FILENAME_PRODUCT_INFO,
                'cPath='.$cPath.'&products_id='.$_GET['products_id']));
    }
}




/* * ** BEGIN ARTICLE MANAGER *** */
// include the articles functions
require(DIR_WS_FUNCTIONS.'articles.php');

// calculate topic path
if (isset($_GET['tPath'])) {
    $tPath = $_GET['tPath'];
} elseif (isset($_GET['articles_id']) && !isset($_GET['authors_id'])) {
    $tPath = tep_get_article_path($_GET['articles_id']);
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

if (isset($_GET['articles_id'])) {
    $articlesPage   = FILENAME_ARTICLE_INFO."?articles_id=".$_GET['articles_id'];
    $pageTags_query = tep_db_query("select page_name, page_title from ".TABLE_HEADERTAGS." where page_name like '".$articlesPage."' and language_id = '".(int) $languages_id."' LIMIT 1");
    if (tep_db_num_rows($pageTags_query) == 1) {
        $pageTags = tep_db_fetch_array($pageTags_query);
        $breadcrumb->add('Articles', tep_href_link(FILENAME_ARTICLES));
        $breadcrumb->add($pageTags['page_title'], tep_href_link($articlesPage));
    }
}
/* * ** END ARTICLE MANAGER *** */
//information
require_once(DIR_WS_FUNCTIONS.'information.php');
tep_information_define_constants();


$oPage = new Ease\Page();

\Ease\Shared::instanced()->webPage($oPage);

$userLog = new PureOSC\CustomerLog();

$oUser = new Ease\Anonym();
\Ease\Shared::instanced()->user($oUser);
