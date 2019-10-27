<?php
/*
  $Id: header_tags_seo.php,v 1.2 2008/08/08
  header_tags_seo Originally Created by: Jack_mcs
  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce
  Portions Copyright 2009 oscommerce-solution.com

  Released under the GNU General Public License
 */

require('includes/application_top.php');
require_once('includes/functions/header_tags.php');
require(DIR_WS_LANGUAGES.$language.'/header_tags_seo.php');

$dbError        = '';
$filename       = DIR_FS_CATALOG.DIR_WS_INCLUDES.'header_tags.php';
$languages      = tep_get_languages();
$extra_db_files = array();
$results        = array();



$explain = "&nbsp;&nbsp;<A style=\"color: sienna;\" HREF='javascript:parent.openNewWindow(\"header_tags_seo_popup_help.php?language=$language\", \"WINDOW_NAME\", 800, 800)'>".TEXT_EXPLAIN_POPUP."</A>";

/* * ******************** CHECK THE INPUT ********************* */
if (isset($_POST['action']) && $_POST['action'] == 'test') {
    /*     * ************* CHECK THE FILE PERMISSIONS ************** */
    $filename = DIR_FS_CATALOG.DIR_WS_INCLUDES.'header_tags.php';
    if (GetPermissions(DIR_FS_CATALOG_IMAGES) != Getpermissions($filename)) {
        $results[] = ERROR_HEADING_PERMISSIONS.$explain;
        $results[] = sprintf(ERROR_WRONG_PERMISSIONS, $filename,
            Getpermissions(DIR_WS_IMAGES));
        $results[] = '<br>'.tep_black_line();
    }

    /*     * ************* CHECK THE SEARCH ENGINE FRIENDLY SETTING ************** */
    $check_query = tep_db_query("select configuration_value from ".TABLE_CONFIGURATION." where configuration_key like 'SEARCH_ENGINE_FRIENDLY_URLS'");
    $check       = tep_db_fetch_array($check_query);
    if ($check['configuration_value'] == 'true') { //the option is enabled
        $results[] = ERROR_HEADING_SEARCH_ENGINE_OPTION.$explain;
        ;
        $results[] = sprintf(ERROR_SEARCH_ENGINE_OPTION);
        $results[] = '<br>'.tep_black_line();
    }

    /*     * ************* CHECK IF FILES ARE PRESENT ************** */
    $extraFiles = array();
    $files      = array();
    $files[]    = DIR_FS_ADMIN.'header_tags_seo.php';
    $files[]    = DIR_FS_ADMIN.'header_tags_fill_tags.php';
    $files[]    = DIR_FS_ADMIN.DIR_WS_INCLUDES.'header_tags_seo_words.txt';
    $files[]    = DIR_FS_ADMIN.DIR_WS_FUNCTIONS.'header_tags.php';
    $files[]    = DIR_FS_ADMIN.DIR_WS_BOXES.'header_tags_seo.php';
    $files[]    = DIR_FS_ADMIN.DIR_WS_LANGUAGES.$language.'/header_tags_seo.php';
    $files[]    = DIR_FS_CATALOG.DIR_WS_INCLUDES.'header_tags.php';
    $files[]    = DIR_FS_CATALOG.DIR_WS_FUNCTIONS.'clean_html_comments.php';
    $files[]    = DIR_FS_CATALOG.DIR_WS_FUNCTIONS.'header_tags.php';
    $files[]    = DIR_FS_CATALOG.DIR_WS_MODULES.'boxes/bm_header_tags.php';
    $files[]    = DIR_FS_CATALOG.DIR_WS_INCLUDES.'modules/header_tags_social_bookmarks.php';
    $files[]    = DIR_FS_CATALOG.'headertags_seo_install.php';
    $files[]    = DIR_FS_CATALOG.'headertags_seo_uninstall.php';
    $files[]    = DIR_FS_CATALOG.'headertags_seo_update.php';

    $found = false;
    for ($i = 0; $i < count($files); ++$i) {
        if (!file_exists($files[$i]) && (strpos($files[$i], "install.php") === FALSE
            && strpos($files[$i], "update.php") === FALSE)) {
            if (!$found) {
                $results[] = ERROR_HEADING_MISSING_FILE.$explain;
                ;
                $found     = true;
            }
            $results[] = sprintf(ERROR_MISSING_FILE, $files[$i]);
        } else if (file_exists($files[$i]) && (strpos($files[$i], "install.php")
            !== FALSE || strpos($files[$i], "update.php") !== FALSE)) {
            $extraFiles[] = $files[$i];
            $found        = true;
        }
    }
    if (count($extraFiles) > 0) {
        $results[] = ERROR_HEADING_EXTRA_FILE.$explain;
        ;
        for ($i = 0; $i < count($extraFiles); ++$i) {
            $results[] = sprintf(ERROR_EXTRA_FILE, $extraFiles[$i]);
        }
    }

    if ($found) $results[] = '<br>'.tep_black_line();

    /*     * ************* CHECK IF HEADER TAGS TABLES EXIST ************** */
    $dbError     = false; //for master group of database errors
    $check_query = tep_db_query("SHOW TABLES LIKE '".TABLE_HEADERTAGS."'");
    if (tep_db_num_rows($check_query) == 0) {
        if (!$dbError) {
            $results[] = ERROR_HEADING_DATABASE.$explain;
            ;
            $dbError   = true;
        }
        $results[] = sprintf(ERROR_MISSING_DATABASE, TABLE_HEADERTAGS);
    }
    $check_query = tep_db_query("SHOW TABLES LIKE '".TABLE_HEADERTAGS_DEFAULT."'");
    if (tep_db_num_rows($check_query) == 0) {
        if (!$dbError) {
            $results[] = ERROR_HEADING_DATABASE.$explain;
            ;
            $dbError   = true;
        }
        $results[] = sprintf(ERROR_MISSING_DATABASE, TABLE_HEADERTAGS_DEFAULT);
    }
    if ($dbError) $results[] = '<br>'.tep_black_line();


    /*     * ************** CHECK IF ROOT TEXT FROM NEW INSTALL ARE PRESENT ******************** */
    $dbError     = false; //for master group of database errors
    $check_query = tep_db_query("select page_name, page_title, language_id from ".TABLE_HEADERTAGS." where page_title like 'New Home Page Title' or page_title like 'products new home'");

    while ($check = tep_db_fetch_array($check_query)) {
        if (!$dbError) {
            $results[] = ERROR_HEADING_DEFAULT_ROOT_TEXT_PRESENT.$explain;
            ;
            $results[] = sprintf(ERROR_DEFAULT_ROOT_TEXT_PRESENT,
                $check['page_title'], $check['page_name'], $check['language_id']);
            $dbError   = true;
        } else
                $results[] = sprintf(ERROR_DEFAULT_ROOT_TEXT_PRESENT,
                $check['page_title'], $check['page_name'], $check['language_id']);
    }
    if ($dbError) $results[] = '<br>'.tep_black_line();


    /*     * ************** CHECK IF DUPLICATE PRODUCT TITLES EXIST ******************** */
    $dbError  = false; //for master group of database errors
    $lastLang = '';

    for ($i = 0; $i < count($languages); ++$i) {
        $check_query = tep_db_query("select products_id, products_head_title_tag, count(products_head_title_tag) as ttl from ".TABLE_PRODUCTS_DESCRIPTION." where language_id = '".$languages[$i]['id']."' group by products_head_title_tag having count(*) > 1 ");

        while ($check = tep_db_fetch_array($check_query)) {
            if (!$dbError) {
                $results[] = ERROR_HEADING_DUPLICATE_TITLE.$explain;
                ;
                $results[] = '<a class="htc_Link" href="'.tep_href_link(FILENAME_CATEGORIES,
                        'action=new_product&pID='.$check['products_id']).'">'.sprintf(ERROR_DUPLICATE_TITLE_LANGUAGE,
                        $languages[$i]['name']).'</a>';
                $results[] = sprintf(ERROR_DUPLICATE_TITLE_META_DESCRIPTION,
                    $check['products_head_title_tag']);
                $dbError   = true;
                $lastLang  = $languages[$i]['id'];
            } else {
                if ($languages[$i]['id'] != $lastLang) {
                    $lastLang  = $languages[$i]['id'];
                    $results[] = '<a class="htc_Link" href="'.tep_href_link(FILENAME_CATEGORIES,
                            'action=new_product&pID='.$check['products_id']).'">'.sprintf(ERROR_DUPLICATE_TITLE_LANGUAGE,
                            $languages[$i]['name']).'</a>';
                }
                $results[] = sprintf(ERROR_DUPLICATE_TITLE_META_DESCRIPTION,
                    $check['products_head_title_tag']);
            }
        }
    }
    if ($dbError) $results[] = '<br>'.tep_black_line();


    /*     * ************** CHECK IF DUPLICATE PRODUCT META DESCRIPTIONS EXIST ******************** */
    $dbError  = false; //for master group of database errors
    $lastLang = '';

    for ($i = 0; $i < count($languages); ++$i) {
        $check_query = tep_db_query("select products_id, products_head_title_tag, count(products_head_desc_tag) as ttl from ".TABLE_PRODUCTS_DESCRIPTION." where language_id = '".$languages[$i]['id']."' group by products_head_desc_tag having count(*) > 1 ");

        while ($check = tep_db_fetch_array($check_query)) {
            if (!$dbError) {
                $results[] = ERROR_HEADING_DUPLICATE_META_DESCRIPTION.$explain;
                ;
                $results[] = '<a class="htc_Link" href="'.tep_href_link(FILENAME_CATEGORIES,
                        'action=new_product&pID='.$check['products_id']).'">'.sprintf(ERROR_DUPLICATE_TITLE_LANGUAGE,
                        $languages[$i]['name']).'</a>';
                $results[] = sprintf(ERROR_DUPLICATE_TITLE_META_DESCRIPTION,
                    $check['products_head_title_tag']);
                $dbError   = true;
                $lastLang  = $languages[$i]['id'];
            } else {
                if ($languages[$i]['id'] != $lastLang) {
                    $lastLang  = $languages[$i]['id'];
                    $results[] = '<a class="htc_Link" href="'.tep_href_link(FILENAME_CATEGORIES,
                            'action=new_product&pID='.$check['products_id']).'">'.sprintf(ERROR_DUPLICATE_TITLE_LANGUAGE,
                            $languages[$i]['name']).'</a>';
                }
                $results[] = sprintf(ERROR_DUPLICATE_TITLE_META_DESCRIPTION,
                    $check['products_head_title_tag']);
            }
        }
    }
    if ($dbError) $results[] = '<br>'.tep_black_line();


    /*     * ************** CHECK FOR MISSING TAGS ******************** */
    if (tep_not_null(($msg = CheckForMissingTags(true, false)))) {
        $results[] = ERROR_HEADING_MISSING_TAGS.$explain;
        ;
        $results[] = $msg;
        $results[] = '<br>'.tep_black_line();
    }


    /*     * ************** CHECK IF PRODUCT TITLE IS TOO SHORT OR LONG ******************** */
    if (isset($_POST['show_limit_messages']) && $_POST['show_limit_messages'] == 'on') {
        $dbError  = false; //for master group of database errors
        $lastLang = '';

        for ($i = 0; $i < count($languages); ++$i) {
            $check_query = tep_db_query("select products_id, products_head_title_tag from ".TABLE_PRODUCTS_DESCRIPTION." where language_id = '".$languages[$i]['id']."' and length(products_head_title_tag) NOT BETWEEN 60 and 120 ");

            while ($check = tep_db_fetch_array($check_query)) {
                $msg = (strlen($check['products_head_desc_tag']) < 60) ? ERROR_TITLE_LENGTH_SHORT
                        : ERROR_TITLE_LENGTH_LONG;

                if (!$dbError) {
                    $results[] = ERROR_HEADING_TITLE_LENGTH.$explain;
                    ;
                    $results[] = sprintf(ERROR_DUPLICATE_TITLE_LANGUAGE,
                        $languages[$i]['name']);
                    $results[] = sprintf($msg,
                        '<a class="htc_Link" href="'.tep_href_link(FILENAME_CATEGORIES,
                            'action=new_product&pID='.$check['products_id']).'">'.(tep_not_null($check['products_head_title_tag'])
                            ? $check['products_head_title_tag'] : ERROR_NO_NAME).'</a>',
                        strlen($check['products_head_title_tag']));
                    $dbError   = true;
                } else {
                    if ($languages[$i]['id'] != $lastLang) {
                        $lastLang  = $languages[$i]['id'];
                        $results[] = sprintf(ERROR_DUPLICATE_TITLE_LANGUAGE,
                            $languages[$i]['name']);
                    }
                    $results[] = sprintf($msg,
                        '<a class="htc_Link" href="'.tep_href_link(FILENAME_CATEGORIES,
                            'action=new_product&pID='.$check['products_id']).'">'.(tep_not_null($check['products_head_title_tag'])
                            ? $check['products_head_title_tag'] : ERROR_NO_NAME).'</a>',
                        strlen($check['products_head_title_tag']));
                }
            }
        }
        if ($dbError) $results[] = '<br>'.tep_black_line();
    }


    /*     * ************** CHECK IF PRODUCT META DESCRIPTION IS TOO SHORT OR LONG ******************** */
    if (isset($_POST['show_limit_messages']) && $_POST['show_limit_messages'] == 'on') {
        $dbError  = false; //for master group of database errors
        $lastLang = '';

        for ($i = 0; $i < count($languages); ++$i) {
            $check_query = tep_db_query("select products_id, products_head_title_tag, products_head_desc_tag from ".TABLE_PRODUCTS_DESCRIPTION." where language_id = '".$languages[$i]['id']."' and length(products_head_desc_tag) NOT BETWEEN 16 and 300 ");

            while ($check = tep_db_fetch_array($check_query)) {
                $msg = (strlen($check['products_head_desc_tag']) < 16) ? ERROR_DESCRIPTION_LENGTH_SHORT
                        : ERROR_DESCRIPTION_LENGTH_LONG;

                if (!$dbError) {
                    $results[] = ERROR_HEADING_DESCRIPTION_LENGTH.$explain;
                    ;
                    $results[] = sprintf(ERROR_DUPLICATE_TITLE_LANGUAGE,
                        $languages[$i]['name']);
                    $results[] = sprintf($msg,
                        '<a class="htc_Link" href="'.tep_href_link(FILENAME_CATEGORIES,
                            'action=new_product&pID='.$check['products_id']).'">'.(tep_not_null($check['products_head_title_tag'])
                            ? $check['products_head_title_tag'] : ERROR_NO_NAME).'</a>',
                        strlen($check['products_head_desc_tag']));
                    $dbError   = true;
                } else {
                    if ($languages[$i]['id'] != $lastLang) {
                        $lastLang  = $languages[$i]['id'];
                        $results[] = sprintf(ERROR_DUPLICATE_TITLE_LANGUAGE,
                            $languages[$i]['name']);
                    }
                    $results[] = sprintf($msg,
                        '<a class="htc_Link" href="'.tep_href_link(FILENAME_CATEGORIES,
                            'action=new_product&pID='.$check['products_id']).'">'.(tep_not_null($check['products_head_title_tag'])
                            ? $check['products_head_title_tag'] : ERROR_NO_NAME).'</a>',
                        strlen($check['products_head_desc_tag']));
                }
            }
        }
        if ($dbError) $results[] = '<br>'.tep_black_line();
    }


    /*     * ************* CHECK IF HEADER TAGS FIELDS EXIST ************** */
    $dbError = false;
    $tables  = array(TABLE_PRODUCTS_DESCRIPTION => 'products_head_title_tag',
        TABLE_CATEGORIES_DESCRIPTION => 'categories_htc_title_tag',
        TABLE_MANUFACTURERS_INFO => 'manufacturers_htc_title_tag'
    );

    foreach ($tables as $table => $field) {
        $fields = tep_db_query("SHOW COLUMNS from ".$table." LIKE '".$field."'");
        $found  = (tep_db_num_rows($fields)) ? true : false;

        if (!$found) {
            if (!$dbError) {
                $results[] = ERROR_HEADING_DATABASE.$explain;
                ;
                $dbError   = true;
            }
            $results[] = sprintf(ERROR_MISSING_DATABASE_FIELD, $field, $table);
        }
    }
    if ($dbError) $results[] = '<br>'.tep_black_line();


    /*     * ************* CHECK IF CONFIGURATION ENTRIES EXIST ************** */
    $dbError     = false;
    $check_query = tep_db_query("select * from ".TABLE_CONFIGURATION_GROUP." where configuration_group_title LIKE 'Header Tags SEO'");
    if (tep_db_num_rows($check_query) == 0) {
        if (!$dbError) {
            $results[] = ERROR_HEADING_DATABASE.$explain;
            ;
            $dbError   = true;
        }
        $results[] = ERROR_MISSING_CONFIGURATION_GROUP;
    }

    $check_query = tep_db_query("select * from ".TABLE_CONFIGURATION." where configuration_key LIKE 'Header_Tags%'");
    if (tep_db_num_rows($check_query) == 0) {
        if (!$dbError) {
            $results[] = ERROR_HEADING_DATABASE.$explain;
            ;
            $dbError   = true;
        }
        $results[] = ERROR_MISSING_CONFIGURATION;
    }

    if ($dbError) $results[] = '<br>'.tep_black_line();


    /*     * ************* CHECK IF STS HAS THE REQUIRED ENTRY ************** */
    $stsInstalled = false;
    $found        = false;
    $check_query  = tep_db_query("select configuration_value from ".TABLE_CONFIGURATION." where configuration_key like 'MODULE_STS_DEFAULT_STATUS'");
    $check        = tep_db_fetch_array($check_query);
    if ($check['configuration_value'] == 'true') { //this is an STS installation and it's enabled
        $stsInstalled = true;
        //disabled for now due to STS code change
        /*
          $check_query = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key like 'MODULE_STS_DEFAULT_NORMAL'");
          $check = tep_db_fetch_array($check_query);
          if (strpos($check['configuration_value'], "headertags.php") === FALSE)
          {
          if (! $dbError)
          {
          $results[] = ERROR_HEADING_STS . $explain;;
          $dbError = true;
          }
          $results[] = ERROR_MISSING_STS_FILE;
          }
         */
    }

    if ($found) $results[] = '<br>'.tep_black_line();


    /*     * ************* CHECK IF FILES HAVE HEADER TAGS CODE CHANGES ************** */
    $hdrFiles = GetFilesWithHeaderTagsInclude(DIR_FS_CATALOG);
    $dbError  = false;
    $files    = (IsTemplate()) ? $hdrFiles : GetBaseFiles();

    for ($i = 0; $i < count($files); ++$i) {
        if ($stsInstalled) {
            if (!$dbError) {
                $results[] = ERROR_HEADING_STS.$explain;
                ;
                $dbError   = true;
            }
            $results[] = sprintf(ERROR_STS_EXTRA_CODE, $files[$i]);
        } else if (IsTemplate()) {
            if (!$dbError) {
                $results[] = ERROR_HEADING_TEMPLATE.$explain;
                ;
                $dbError   = true;
            }
            $results[] = sprintf(ERROR_TEMPLATE_EXTRA_CODE, $files[$i]);
        } else {
            if (!in_array($files[$i], $hdrFiles)) {
                if (!$dbError) {
                    $results[] = ERROR_HEADING_MISSING_CODE.$explain;
                    ;
                    $dbError   = true;
                }
                $results[] = sprintf(ERROR_MISSING_CODE, $files[$i]);
            }
        }
    }
    if ($dbError) $results[] = '<br>'.tep_black_line();


    /*     * ************* CHECK IF PSEUDO CODE IS BEING USED ************** */
    $dbError     = false;
    $pseudoArray = array(0 => 'article-topics.php',
        1 => 'article_info.php',
        2 => 'information.php',
        3 => 'pages.php');

    for ($i = 0; $i < count($pseudoArray); ++$i) {
        if (in_array($pseudoArray[$i], $hdrFiles)) {
            $db_query = tep_db_query("select 1 from ".TABLE_HEADERTAGS." where page_name LIKE '".$pseudoArray[$i].'?'."%' limit 1");
            if (tep_db_num_rows($db_query) == 0) {
                if (!$dbError) {
                    $results[] = ERROR_HEADING_MISSING_PSEUDO.$explain;
                    ;
                    $dbError   = true;
                }
                $results[] = sprintf(ERROR_MISSING_PSEUDO, $pseudoArray[$i]);
            }
        }
    }

    if ($dbError) $results[] = '<br>'.tep_black_line();


    /*     * ************* CHECK IF FILE NAMES ARE INVALID ************** */
    $dbError = false;
    for ($i = 0; $i < count($hdrFiles); ++$i) {
        if (strpos($hdrFiles[$i], " ") !== FALSE) {         //invalid filename
            if (!$dbError) {
                $results[] = ERROR_HEADING_INVALID_FILENAME.$explain;
                ;
                $dbError   = true;
            }
            $results[] = sprintf(ERROR_INVALID_FILENAME_TEST, $hdrFiles[$i]);
        }
    }
    if ($dbError) $results[] = '<br>'.tep_black_line();


    /*     * ************* CHECK IF INCLUDES/HEADER_TAGS.PHP FILE MATCHES THE DATABSE ************** */
    $path       = DIR_FS_CATALOG.'includes/header_tags.php';
    $dbArray    = array();
    $dbError    = false;
    $filesArray = array();
    $found      = false;
    $lines      = array();
    $lines      = @file($path);
    $filesCnt   = 0;

    for ($idx = 0; $idx < count($lines); ++$idx) {
        if (($p1 = strpos($lines[$idx], "//")) !== FALSE && ($p2 = strpos(strtolower($lines[$idx]),
            ".php")) !== FALSE && $p1 < $p2) {
            $filesCnt++;
            $filesArray[] = strtolower(trim(substr($lines[$idx], $p1 + 2)));
        }
    }

    $check_query = tep_db_query("select page_name from ".TABLE_HEADERTAGS." where language_id = '".(int) $languages_id."'");
    if (($dbCnt       = tep_db_num_rows($check_query)) != $filesCnt) {
        while ($check = tep_db_fetch_array($check_query)) {
            if (strpos($check['page_name'], "?") !== FALSE)   //check for pseudo pages
                    $dbCnt--;                                       //don't count since they are not in the files
            else $dbArray[] = $check['page_name'];
        }

        if ($dbCnt != $filesCnt) {
            $results[] = ERROR_HEADING_COUNT_MISMATCH.$explain;
            ;
            $results[] = sprintf(ERROR_COUNT_MISMATCH,
                tep_db_num_rows($check_query), $filesCnt);
            $dbError   = true;

            if ($dbCnt < $filesCnt) {
                $results[] = '&nbsp;'.TEST_FILE_NOTIN_DB;
                foreach ($filesArray as $file)
                    if (!in_array($file, $dbArray))
                            $results[] = '&nbsp;&nbsp;'.$file;
            } else {
                $found     = false;
                $results[] = '&nbsp;'.TEST_FILE_NOTIN_FILE;
                foreach ($dbArray as $file) {
                    if (!in_array($file, $filesArray)) {
                        $found            = true;
                        $results[]        = '&nbsp;&nbsp;'.$file;
                        $extra_db_files[] = $file;
                    }
                }
                if ($found)
                        $results[] = ' <form method="post" action="header_tags_test.php">'.tep_draw_hidden_field('action',
                            'delete_extra_files').tep_draw_hidden_field('files_to_delete',
                            urlencode(serialize($extra_db_files))).tep_hide_session_id().tep_image_submit('button_delete.gif',
                            IMAGE_DELETE).'</form>';
            }
        }
    }
    if ($dbError) $results[] = '<br>'.tep_black_line();


    /*     * ************* CHECK IF LANGUAGES/TABLES MATCH ************** */
    $dbError   = false;
    $languages = tep_get_languages();
    $found     = false;

    /* --------------- is the languages in the shop in the default header tags table? -------------- */
    for ($i = 0; $i < count($languages); ++$i) {
        $check_query = tep_db_query("select 1 from ".TABLE_HEADERTAGS_DEFAULT." where language_id = '".(int) $languages[$i]['id']."'");
        if (tep_db_num_rows($check_query) > 0) continue;

        if (!$dbError) {
            $results[] = ERROR_HEADING_LANGUAGE_MISMATCH.$explain;
            ;
            $dbError   = true;
        }
        $results[] = sprintf(ERROR_LANGUAGE_MISMATCH_DB, $languages[$i]['name'],
                $languages[$i]['id']).' <form method="post" action="header_tags_test.php">'.tep_draw_hidden_field('action',
                'add_languages').tep_draw_hidden_field('language_name',
                $languages[$i]['name']).tep_draw_hidden_field('language_id',
                $languages[$i]['id']).tep_hide_session_id().tep_image_submit('button_add_small.gif',
                IMAGE_ADD).'</form>';
    }

    /* --------------- is the languages in the default header tags table in the shop? -------------- */
    $check_query = tep_db_query("select language_id from ".TABLE_HEADERTAGS_DEFAULT);
    $found       = false;
    $currentID   = 0;

    while ($check = tep_db_fetch_array($check_query)) {
        $currentID = $check['language_id'];
        for ($i = 0; $i < count($languages); ++$i) {
//      echo 'checking '.$check['language_id'].' - '.$i.'<br>';
            if (in_array($check['language_id'], $languages[$i])) {
//      echo 'found '.$check['language_id'].' - '.$i.'<br>';

                $found = true;
                break;
            }
        }

        if (!$found) {
//    else if ($notFirst && $i == 0)  //show what is there

            if (!$dbError) { //else entry already exists
                $results[] = ERROR_HEADING_LANGUAGE_MISMATCH.$explain;
                ;
                $dbError   = true;
            }
            $results[] = sprintf(ERROR_LANGUAGE_MISMATCH_HT,
                    $check['language_id']).' <form method="post" action="header_tags_test.php">'.tep_draw_hidden_field('action',
                    'delete_languages').tep_draw_hidden_field('language_id',
                    $check['language_id']).tep_hide_session_id().tep_image_submit('button_delete_small.gif',
                    IMAGE_DELETE).'</form>';
        } else {
            $found     = false;
            $results[] = sprintf(ERROR_LANGUAGE_MISMATCH_PRESENT,
                $check['language_id'], $languages[$i]['name']);
        }
        if ($dbError) $results[] = '<br>'.tep_black_line();
    }


    /*     * ************* COMPARE TITLE AND TAGS OF LIVE PAGE TO WHAT'S IN THE DATABASE ************** */
    if (isset($_POST['check_url_page']) && substr($_POST['check_url_page'], -4) == '.php') {
        /*         * **************** save the cache setting ****************** */
        $cacheStored = '';
        if (HEADER_TAGS_ENABLE_CACHE != 'None') {     //this test causes cahce to become corrupted co turn it off until done
            $cacheStored = HEADER_TAGS_ENABLE_CACHE;
            tep_db_query("update ".TABLE_CONFIGURATION." set configuration_value = 'None' where configuration_key = 'HEADER_TAGS_ENABLE_CACHE'");
        }

        /*         * **************** get the run settings ****************** */
        $args = ((isset($_POST['check_url_tags']) && tep_not_null($_POST['check_url_tags']))
                ? (int) $_POST['check_url_tags'] : '');

        if (isset($_POST['check_url_id']) && $_POST['check_url_id'] != TEXT_NO_URL_TYPE) { //cPath or products_id selected
            $id = '?'.$_POST['check_url_id'].'='.$args;  //args should have the id
        } else if (isset($_POST['check_url_id']) && $_POST['check_url_id'] == TEXT_NO_URL_TYPE) {
            if (tep_not_null($args)) //none chosen but arguments entered
                    $id = '?'.$args;
        }

        $sep      = (tep_not_null($id) || tep_not_null($args) ? '&language=' : '?language=');
        $pageName = $_POST['check_url_page'].$id;
        $pageInfo = array();

        $results[] = sprintf(ERROR_HEADING_META_DATA, $pageName).$explain;
        ;


        for ($i = 0; $i < count($languages); ++$i) {
            $metaData  = GetMetaInfo($pageName.$sep.$languages[$i]['code']);
            $results[] = '&nbsp;<b>'.$languages[$i]['name'].'</b>';
            $results[] = ERROR_META_DATA_TEXT_ACTUAL;
            $results[] = sprintf(ERROR_META_DATA_TITLE,
                (tep_not_null($metaData['title'][1]) ? 'yellow' : 'red'),
                $metaData['title']);
            $results[] = sprintf(ERROR_META_DATA_DESC,
                (tep_not_null($metaData['description'][1]) ? 'yellow' : 'red'),
                $metaData['description']);
            $results[] = sprintf(ERROR_META_DATA_KEYWORDS,
                (tep_not_null($metaData['keywords'][1]) ? 'yellow' : 'red'),
                $metaData['keywords']);
            $results[] = ERROR_META_DATA_TEXT_SHOULD_BE;

            $pageInfo_query = tep_db_query("select page_title as title, page_description as description, page_keywords as keywords, append_category, append_product, append_default_title, append_default_description, append_default_keywords, sortorder_title, sortorder_description, sortorder_keywords, sortorder_root, sortorder_product, sortorder_category from ".TABLE_HEADERTAGS." where page_name = '".tep_db_input($_POST['check_url_page'])."' and language_id = ".(int) $languages[$i]['id']);
            if (tep_db_num_rows($pageInfo_query) > 0) {
                $pageInfo = tep_db_fetch_array($pageInfo_query);
            }

            $data = array();
            if (tep_not_null($pageInfo)) {
                switch ($_POST['check_url_id']) {
                    case 'cPath':
                        if ($pageInfo['append_category']) {
                            $data_query = tep_db_query("select categories_htc_title_tag as title, categories_htc_desc_tag as description, categories_htc_keywords_tag as keywords from ".TABLE_CATEGORIES_DESCRIPTION." where categories_id = ".(int) $args." and language_id = ".(int) $languages[$i]['id']." limit 1");
                            if (tep_db_num_rows($data_query) > 0) {
                                $data                    = tep_db_fetch_array($data_query);
                                $pageInfo['title']       .= ' '.HEADER_TAGS_SEPARATOR_DESCRIPTION.' '.$data['title'];
                                $pageInfo['description'] .= ' '.HEADER_TAGS_SEPARATOR_DESCRIPTION.' '.$data['description'];
                                $pageInfo['keywords']    .= ' '.HEADER_TAGS_SEPARATOR_KEYWORD.' '.$data['keywords'];
                            }
                        }
                        break;

                    case 'products_id':
                        if ($pageInfo['append_product']) {
                            $data_query = tep_db_query("select products_head_title_tag as title, products_head_desc_tag as description, products_head_keywords_tag as keywords from ".TABLE_PRODUCTS_DESCRIPTION." where products_id = ".(int) $args." and language_id = ".(int) $languages[$i]['id']." limit 1");
                            if (tep_db_num_rows($data_query) > 0) {
                                $data                    = tep_db_fetch_array($data_query);
                                $pageInfo['title']       .= ' '.HEADER_TAGS_SEPARATOR_DESCRIPTION.' '.$data['title'];
                                $pageInfo['description'] .= ' '.HEADER_TAGS_SEPARATOR_DESCRIPTION.' '.$data['description'];
                                $pageInfo['keywords']    .= ' '.HEADER_TAGS_SEPARATOR_KEYWORD.' '.$data['keywords'];
                            }
                        }
                        break;

                    default: break;
                }
            }

            $results[] = sprintf(ERROR_META_DATA_TITLE,
                (tep_not_null($pageInfo['title']) ? 'yellow' : 'red'),
                $pageInfo['title']);
            $results[] = sprintf(ERROR_META_DATA_DESC,
                (tep_not_null($pageInfo['description']) ? 'yellow' : 'red'),
                $pageInfo['description']);
            $results[] = sprintf(ERROR_META_DATA_KEYWORDS,
                (tep_not_null($pageInfo['keywords']) ? 'yellow' : 'red'),
                $pageInfo['keywords']);

            if (!tep_not_null($metaData['description'][1]) && tep_not_null($pageInfo['description'])) {
                $results[] = ERROR_META_DATA_COMPARE_RESULTS;
                $results[] = sprintf(ERROR_META_DATA_MISSING_CODE,
                    $_POST['check_url_page']);
            } else if (!tep_not_null($metaData['description'][1]) && !tep_not_null($pageInfo['description'])) {
                $results[] = ERROR_META_DATA_COMPARE_RESULTS;
                $results[] = sprintf(ERROR_META_DATA_NO_TAGS,
                    $_POST['check_url_page']);
            }

            if ($i < count($languages) - 1)
                    $results[] = '<hr style="border-top: 1px solid red">';
        }

        if (tep_not_null($cacheStored))
                tep_db_query("update ".TABLE_CONFIGURATION." set configuration_value = '".$cacheStored."' where configuration_key = 'HEADER_TAGS_ENABLE_CACHE'");

        $results[] = '<br>'.tep_black_line();
    }
}


/* * ***************** DELETE ENTRIES IN THE DATABASE WHERE LANGUAGE DOES NOT EXIST ********************** */ else if (isset($_POST['action'])
    && $_POST['action'] == 'delete_languages') {
    tep_db_query("delete from ".TABLE_HEADERTAGS_DEFAULT." where language_id = '".(int) $_POST['language_id']."'");
}

/* * ***************** ADD ENTRIES IN THE HEADER TAGS DEFAULT TABLE WHERE LANGUAGE DOES NOT EXIST ********************** */ else if (isset($_POST['action'])
    && $_POST['action'] == 'add_languages') {
    $check_query = tep_db_query("select * from ".TABLE_HEADERTAGS_DEFAULT." where language_id = '".(int) $_POST['language_id']."' LIMIT 1");

    if (tep_db_num_rows($check_query) < 1) {
        $sql_data_array = array('default_title' => $_POST['language_name'],
            'default_description' => '',
            'default_keywords' => '',
            'default_logo_text' => '',
            'home_page_text' => '',
            'default_logo_append_group' => 0,
            'default_logo_append_category' => 0,
            'default_logo_append_manufacturer' => 0,
            'default_logo_append_product' => 0,
            'meta_google' => 0,
            'meta_language' => 0,
            'meta_noodp' => 0,
            'meta_noydir' => 0,
            'meta_replyto' => 0,
            'meta_revisit' => 0,
            'meta_robots' => 0,
            'meta_unspam' => 0,
            'meta_canonical' => 1,
            'meta_og' => 1,
            'language_id' => (int) $_POST['language_id']
        );
        tep_db_perform(TABLE_HEADERTAGS_DEFAULT, $sql_data_array);
    }
}

/* * ***************** DELETE ENTRIES IN THE DATABASE WHERE FILES DO NOT EXISTS ********************** */ else if (isset($_POST['action'])
    && $_POST['action'] == 'delete_extra_files') {
    $files = unserialize(urldecode($_POST['files_to_delete']));
    for ($i = 0; $i < count($files); ++$i)
        tep_db_query("delete from ".TABLE_HEADERTAGS." where page_name LIKE '".$files[$i]."'");
}
require(DIR_WS_INCLUDES.'template_top.php');
?>
<style type="text/css">
    td.HTC_Head {font-family: Verdana, Arial, sans-serif; color: sienna; font-size: 18px; font-weight: bold; } 
    td.HTC_subHead {font-family: Verdana, Arial, sans-serif; color: sienna; font-size: 12px; } 
    .HTC_title {background: #fof1f1; text-align: center;} 
    .htc_Link  {font-family: Verdana, Arial, sans-serif; color: sienna; font-size: 10px; } 
    A.htc_Link  {color:blue; }
    A.htc_Link:hover {color:sienna } 

    .popup
    {
        color: yellow;
        cursor: pointer;
        text-decoration: none
    }
</style>
<script language="javascript">
    function openNewWindow(fileName, windowName, theWidth, theHeight) {
        window.open(fileName, windowName, "toolbar=0,location=0,directories=0,status=1,menubar=1,scrollbars=1,resizable=1,width=" + theWidth + ",height=" + theHeight)
    }
    function confirmdelete(form, page) {
        if (confirm('Do you really want to delete ' + page + '?\r\n\r\nThis only deletes the entry in Header Tags, not the actual file.'))
            form.submit();

        return false;
    }
    function UpdateSortOrder(page) {
        var checkbox = "option_" + page;
        var ckbox_status = document.getElementById(checkbox).checked;

        if (ckbox_status === false)
            document.getElementById(page).disabled = true;
        else
            document.getElementById(page).disabled = false;

    }
</script>
<table border="0" width="100%" cellspacing="2" cellpadding="2">
    <tr>
        <td width="<?php echo cfg('BOX_WIDTH'); ?>" valign="top"><table border="0" width="<?php echo cfg('BOX_WIDTH'); ?>" cellspacing="1" cellpadding="1" class="columnLeft">
                <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                        <tr>
                            <td class="HTC_Head" colspan="2"><?php echo HEADING_TITLE_TEST; ?></td>
                        </tr>
                        <tr>
                            <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif',
    '100%', '10');
?></td>
                        </tr>
                        <tr>
                            <td colspan="2"><?php echo tep_black_line(); ?></td>
                        </tr>     

                        <!-- Begin of Header Test -->   
                        <tr>
                            <td align="right"><table width="100%" border="0" cellspacing="0" cellpadding="0">     
                                    <!-- begin left column new page -->
                                    <tr>
                                        <td align="right" width="60%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                <?php echo tep_draw_form('header_tags',
                                                    FILENAME_HEADER_TAGS_TEST,
                                                    '', 'post').tep_draw_hidden_field('action',
                                                    'test');
                                                ?></td>

                                    <tr>
                                        <td><table border="0" style="border:ridge gray 3px;" cellpadding="2">
                                                <tr>
                                                    <td class="smallText" height="60" valign="top"><?php echo TEXT_TEXT_INFORMATION; ?></td>
                                                </tr>
                                                <tr>
                                                    <td height="10"></td>
                                                </tr>
                                            </table></td>
                                    </tr> 
                                    <tr>
                                        <td><table border="0" style="border:ridge gray 3px;" width="100%">
                                                <tr>
                                                    <td><table border="0" width="200">
                                                            <tr>
                                                                <td class="smallText" width="110"><?php echo TEXT_SHOW_LIMIT_MESSAGES; ?></td>
                                                                <td><?php echo tep_draw_checkbox_field('show_limit_messages',
                                                    '', false);
                                                ?> </td>
                                                            </tr>
                                                        </table></td>  
                                                </tr>
                                                <tr>
                                                    <td><table border="0" width="70%" class="smallText">
                                                            <tr>
                                                                <?php
                                                                $files = GetFileList($languages_id);
                                                                unset($files[3]); //remove add missing, etc.
                                                                unset($files[2]);
                                                                unset($files[1]);
                                                                $files = array_values($files);

                                                                $idsArray = array(
                                                                    array('id' => TEXT_NO_URL_TYPE,
                                                                        'text' => TEXT_NO_URL_TYPE),
                                                                    array('id' => 'cPath',
                                                                        'text' => 'cPath'),
                                                                    array('id' => 'products_id',
                                                                        'text' => 'products_id')
                                                                );
                                                                ?>
                                                                <td width="110"><?php echo TEXT_CHECK_URL; ?></td>
                                                                <td><?php
                                                                echo tep_draw_pull_down_menu('check_url_page',
                                                                    $files, '',
                                                                    '', false);
                                                                ?></td>
                                                                <td><?php
                                                        echo tep_draw_pull_down_menu('check_url_id',
                                                            $idsArray, '', '',
                                                            false);
                                                        ?></td>
                                                                <td width="140" align="right"><?php echo TEXT_CHECK_URL_TAGS; ?></td>
                                                                <td><input type="text" name="check_url_tags" size="5"></td>
                                                            </tr>
                                                        </table></td>  
                                                </tr>   
                                                <tr><td height="10"></td></tr>         
                                                <tr> 
                                                    <td align="center"><?php
                        echo (tep_image_submit('button_test.gif', 'Test') ).' <a href="'.tep_href_link(FILENAME_HEADER_TAGS_SEO,
                            '').'">'.'</a>';
                        ?></td>
                                                </tr>
                                            </table></td>
                                    </tr> 

                                    </form>
                                </table></td>
                        </tr>
                        <!-- end Header Tags Test -->    

                        <!-- Begin Header Tags Test Results -->           
                        <?php if (count($results) > 0) { ?>  
                            <tr><td height="10"></td></tr>     
                            <tr><td><?php echo tep_black_line(); ?></td></tr>          
                            <tr>
                                <td class="HTC_Head"><?php echo TEST_RESULTS_HEADING; ?></td>
                            </tr>
    <?php
    for ($i = 0; $i < count($results) - 1; ++$i) {  //skip the last line, which will be a black line  
        if (strpos($results[$i], "<b") !== FALSE) {
            ?>
                                    <tr><td height="10"></td></tr>
        <?php } ?>
                                <tr>
                                    <td class="smallText"><?php echo $results[$i]; ?></td>
                                </tr> 
    <?php }
} else if (isset($_POST['action']) && $_POST['action'] == 'test') {
    ?>
                            <tr><td height="10"></td></tr>     
                            <tr><td><?php echo tep_black_line(); ?></td></tr>          
                            <tr>
                                <td class="HTC_Head"><?php echo TEST_RESULTS_HEADING_NONE; ?></td>
                            </tr>
    <?php } ?>      
                    </table></td> 
    </tr>
    <!-- End Header Tags Test Results -->           



    <!-- Begin of Header Tags Common Problems -->
    <tr><td><?php echo tep_image(DIR_WS_IMAGES.'pixel_trans.gif', '', '100%',
        '4');
    ?></td></tr>
    <tr><td><?php echo tep_image(DIR_WS_IMAGES.'pixel_black.gif', '', '100%',
        '4');
    ?></td></tr>
    <tr>
        <td class="main" style="font-weight: bold;"><?php echo TEXT_COMMON_PROBLEMS_HEADING; ?></td>
    </tr>    
<?php for ($i = 0; $i < count($commonQuestionsArray); ++$i) { ?>  
        <tr><td height="10"></td></tr> 
        <tr>
            <td class="smallText"><?php echo '<b>Q:</b> '.$commonQuestionsArray[$i]['Q']; ?></td>
        </tr>           
        <tr>
            <td class="smallText"><?php echo '<b>A:</b> '.$commonQuestionsArray[$i]['A']; ?></td>
        </tr>    
<?php } ?> 
    <tr>
        <td><?php echo tep_black_line(); ?></td>
    </tr>      
    <!-- end of Header Tags Common Problems -->

</table></td>
</tr>
</table>

<?php
require(DIR_WS_INCLUDES.'template_bottom.php');
require(DIR_WS_INCLUDES.'application_bottom.php');
?>
