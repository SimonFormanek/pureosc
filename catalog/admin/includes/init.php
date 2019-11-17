<?php

if (file_exists('includes/local/configure.php')) { // for developers
    include('includes/local/configure.php');
} else {
    include('../../../oscconfig/admin/configure.php');
    include('../../../oscconfig/dbconfigure.php');
}

include './includes/filenames.php';
include './includes/database_tables.php';

require_once cfg('DIR_FS_CATALOG') . '../vendor/autoload.php';

function cfg($key) {
    return defined($key) ? constant($key) : null;
}

function tep_href_link($argument) {
    return $argument;
}

function __($const, $gettext) {
    return $gettext;
}

function tep_db_query($sql) {
    $helper = new \Ease\SQL\Engine();
    return $helper->getFluentPDO()->getPDO()->query($sql);
}

function tep_db_fetch_array($stmt) {
    $result = [];
    if (is_object($stmt)) {
        try {
            $result = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
            $stmt = null;
        } catch (PDOException $e) {
            print $e->getMessage();
        }
    }
    return $result;
}

function tep_not_null( $argument ) {     return !empty($argument)  ;  }

define('TABLE_LANGUAGES', 'languages');



$cfg = new PureOSC\Admin\Configurator();
$cfg->setUpConstatnts();



session_start();

// set the language
if (!array_key_exists('language', $_SESSION) || isset($_GET['language'])) {

    $lng = new language();

    if (isset($_GET['language']) && tep_not_null($_GET['language'])) {
        $lng->set_language($_GET['language']);
    } else {
        $browser_language = preg_replace('/,.*/', '', $_SERVER['HTTP_ACCEPT_LANGUAGE']);
        if (preg_match('/^en/', $browser_language)) {
            $browser_language = 'en';
        }
        $languages_all_query = tep_db_query("SELECT code FROM " . cfg('TABLE_LANGUAGES'));
        while ($languages_all = tep_db_fetch_array($languages_all_query)) {
            if ($languages_all['code'] == $browser_language) {
                $new_language = $browser_language;
            }
        }
        if ($new_language) {
            $lng->set_language($new_language);
        } else {
            $lng->set_language(cfg('DEFAULT_LANGUAGE'));
        }
    }
} else {
    $lng = new language();
    //$lng->set_language($_SESSION['language']);
    $language_code_query = tep_db_query("SELECT code FROM " . cfg('TABLE_LANGUAGES') . " WHERE languages_id =  '" . $_SESSION['languages_id'] . "'");
    $language_code = tep_db_fetch_array($language_code_query);
    $lng->set_language($language_code['code']);
}

$language = $_SESSION['language'] = $lng->language['lng'] ;
$languages_id = $lng->language['id'];

$oPage = new PureOSC\Admin\ui\WebPage(_('Search Results'));


