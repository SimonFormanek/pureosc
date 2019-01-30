<?php
/*
  $Id: header_tags_seo.php,v 1.2 2008/08/08
  header_tags_seo Originally Created by: Jack York (aka Jack_mcs) - http://www.oscommerce-solution.com
  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce
  Portions Copyright 2009 oscommerce-solution.com

  Released under the GNU General Public License
 */

require('includes/application_top.php');
require_once(DIR_WS_FUNCTIONS.'header_tags.php');

/* * ******************** BEGIN VERSION CHECKER ******************** */
if (file_exists(DIR_WS_FUNCTIONS.'version_checker.php')) {
    require(DIR_WS_LANGUAGES.$language.'/version_checker.php');
    require(DIR_WS_FUNCTIONS.'version_checker.php');
    $contribPath    = 'http://addons.oscommerce.com/info/5851';
    $currentVersion = 'Header Tags SEO V 3.3.4';
    $contribName    = 'Header Tags SEO V';
    $versionStatus  = '';
}
/* * ******************** END VERSION CHECKER ******************** */

$filename      = DIR_FS_CATALOG.DIR_WS_INCLUDES.'header_tags.php';
$languages     = tep_get_languages();
$missingArray  = array();
$shopsMetaInfo = array();

/* * ******************** RUN OPTIONS ******************** */
if (HEADER_TAGS_AUTO_ADD_PAGES == 'true') {
    $newfiles = AddMissingPages($languages_id, $languages);
} else {
    $newfiles = GetFileList($languages_id);
}

if (HEADER_TAGS_CHECK_TAGS == 'true') {
    if (tep_not_null($missingTags = CheckForMissingTags(false, false,
            $missingArray)))
            $messageStack->add(ERROR_MISSING_TAGS.$missingTags, 'error');
}
if (HEADER_TAGS_DIABLE_PERMISSION_WARNING == 'false') {
    if (GetPermissions(DIR_FS_CATALOG_IMAGES) != Getpermissions($filename))
            $messageStack->add(sprintf(ERROR_WRONG_PERMISSIONS, $filename,
                Getpermissions(DIR_WS_IMAGES)), 'error');
}
if (!IsOptionSet('meta_canonical')) {
    $messageStack->add(ERROR_META_CANONICAL_TAG_OFF, 'error');
}

$optionPopup   = array();
$commonPopup   = array();
$defaultPopup  = array();
$metatagsPopup = array();
if (HEADER_TAGS_DISPLAY_HELP_POPUPS) {
    $optionPopup   = GetPopupText('option');
    $commonPopup   = GetPopupText('common');
    $defaultPopup  = GetPopupText('default');
    $metatagsPopup = GetPopupText('metatags');
}

/* * ******************** INITIAL SETTINGS ******************** */
$checkedKeywordLive = array();
$currentFile        = SELECT_A_FILE;
$deletedFile        = false;       //indicate that a deletion was perfomed
$keywordStr         = '';           //used for loading from live shop 
$viewResult         = '';
$showMetaInfoItem   = 0;

$def_options   = array();
$def_options[] = OPTION_INCL_GROUP;
$def_options[] = OPTION_INCL_CATEGORY;
$def_options[] = OPTION_INCL_MANUFACTURER;
$def_options[] = OPTION_INCL_PRODUCT;

$options   = array();
$options[] = OPTION_INCL_CATEGORY;
$options[] = OPTION_INCL_MANUFACTURER;
$options[] = OPTION_INCL_MODEL;
$options[] = OPTION_INCL_PRODUCT;
$options[] = OPTION_INCL_ROOT;
$options[] = OPTION_INCL_TITLE;
$options[] = OPTION_INCL_DESC;
$options[] = OPTION_INCL_KEYWORDS;
$options[] = OPTION_INCL_LOGO;

$metaTags[] = OPTION_META_GOOGLE;
$metaTags[] = OPTION_META_LANGUAGE;
$metaTags[] = OPTION_META_NOODP;
$metaTags[] = OPTION_META_NOYDIR;
$metaTags[] = OPTION_META_REPLYTO;
$metaTags[] = OPTION_META_REVISIT;
$metaTags[] = OPTION_META_ROBOTS;
$metaTags[] = OPTION_META_UNSPAM;
$metaTags[] = OPTION_META_CANONICAL;
$metaTags[] = OPTION_META_OG;

/* * ******************** CHECK THE INPUT ********************* */
if (isset($_POST['action']) && $_POST['action'] == 'update') {
    if (isset($_POST['x'])) {
        $failedDupSort = false;
        $found         = false;
        $pageNumb      = GetKey($newfiles, $_POST['new_files']);

        if ($pageNumb === SHOW_ALL_FILES || is_string($pageNumb))
                $pageNumb = FIRST_PAGE_ENTRY;       //skip over the selection options

        while ($pageNumb < count($newfiles) && !$failedDupSort) {
            $found = false;
            for ($i = 0; $i < count($languages); ++$i) {
                $name = sprintf("title_%d_%d", $pageNumb, $languages[$i]['id']);
                $desc = sprintf("desc_%d_%d", $pageNumb, $languages[$i]['id']);
                $keys = sprintf("keyword_%d_%d", $pageNumb, $languages[$i]['id']);
                $logo = sprintf("logo_%d_%d", $pageNumb, $languages[$i]['id']);

                $optionID     = array();
                $sortOptionID = array();
                for ($z = 0; $z < count($options); ++$z) {  //create unique option id's 
                    $optionID[]     = sprintf("option_%d_%d_%d", $z, $pageNumb,
                        $languages[$i]['id']);
                    $sortOptionID[] = sprintf("sortoption_%d_%d_%d", $z,
                        $pageNumb, $languages[$i]['id']);
                }

                /*                 * ************** BEGIN CHECK FOR MISSING AND DUPLICATE SORT ORDERS ***************** */
                $dupSort = array();

                for ($o = 0; $o < count($sortOptionID); ++$o) {
                    if (isset($_POST[$sortOptionID[$o]]) && (int) $_POST[$sortOptionID[$o]]
                        == 0) {
                        $failedDupSort = true;
                        $messageStack->add(sprintf(ERROR_MISSING_SORT_ORDER,
                                $newfiles[$pageNumb]['text']), 'error');
                        break;
                    } else if (isset($_POST[$sortOptionID[$o]]) && (int) $_POST[$sortOptionID[$o]]
                        > 0) {
                        if (!in_array($_POST[$sortOptionID[$o]], $dupSort)) {
                            $dupSort[] = $_POST[$sortOptionID[$o]];
                        } else {
                            $failedDupSort = true;
                            $messageStack->add(sprintf(ERROR_DUPLICATE_SORT_ORDER,
                                    $newfiles[$pageNumb]['text']), 'error');
                            break;
                        }
                    }
                }
                /*                 * ************** END CHECK FOR MISSING AND DUPLICATE SORT ORDERS ***************** */

                if (!$failedDupSort && isset($_POST[$name])) {
                    $found          = true;
                    $pageTags_query = tep_db_query("select * from ".TABLE_HEADERTAGS." where page_name like '".tep_db_input($newfiles[$pageNumb]['text'])."' and language_id = '".(int) $languages[$i]['id']."'");
                    $pageTags       = tep_db_fetch_array($pageTags_query);

                    $sql_data_array = array('page_title' => tep_db_prepare_input($_POST[$name]),
                        'page_description' => tep_db_prepare_input($_POST[$desc]),
                        'page_keywords' => tep_db_prepare_input($_POST[$keys]),
                        'page_logo' => tep_db_prepare_input($_POST[$logo]),
                        'append_category' => ((isset($_POST[$optionID[0]]) && $_POST[$optionID[0]]
                        == 'on') ? 1 : 0),
                        'append_manufacturer' => ((isset($_POST[$optionID[1]]) && $_POST[$optionID[1]]
                        == 'on') ? 1 : 0),
                        'append_model' => ((isset($_POST[$optionID[2]]) && $_POST[$optionID[2]]
                        == 'on') ? 1 : 0),
                        'append_product' => ((isset($_POST[$optionID[3]]) && $_POST[$optionID[3]]
                        == 'on') ? 1 : 0),
                        'append_root' => ((isset($_POST[$optionID[4]]) && $_POST[$optionID[4]]
                        == 'on') ? 1 : 0),
                        'append_default_title' => ((isset($_POST[$optionID[5]]) && $_POST[$optionID[5]]
                        == 'on') ? 1 : 0),
                        'append_default_description' => ((isset($_POST[$optionID[6]])
                        && $_POST[$optionID[6]] == 'on') ? 1 : 0),
                        'append_default_keywords' => ((isset($_POST[$optionID[7]])
                        && $_POST[$optionID[7]] == 'on') ? 1 : 0),
                        'append_default_logo' => ((isset($_POST[$optionID[8]]) && $_POST[$optionID[8]]
                        == 'on') ? 1 : 0),
                        'sortorder_category' => (int) $_POST[$sortOptionID[0]],
                        'sortorder_manufacturer' => (int) $_POST[$sortOptionID[1]],
                        'sortorder_model' => (int) $_POST[$sortOptionID[2]],
                        'sortorder_product' => (int) $_POST[$sortOptionID[3]],
                        'sortorder_root' => (int) $_POST[$sortOptionID[4]],
                        'sortorder_title' => (int) $_POST[$sortOptionID[5]],
                        'sortorder_description' => (int) $_POST[$sortOptionID[6]],
                        'sortorder_keywords' => (int) $_POST[$sortOptionID[7]],
                        'sortorder_logo' => (int) $_POST[$sortOptionID[8]]);


                    if (tep_db_num_rows($pageTags_query)) {
                        tep_db_perform(TABLE_HEADERTAGS, $sql_data_array,
                            'update',
                            "page_name LIKE '".tep_db_input($newfiles[$pageNumb]['text'])."' and language_id = '".(int) $languages[$i]['id']."'");
                    } else {
                        $insert_sql_data = array('page_name' => $newfiles[$pageNumb]['text'],
                            'language_id' => $languages[$i]['id']);
                        $sql_data_array  = array_merge($sql_data_array,
                            $insert_sql_data);
                        tep_db_perform(TABLE_HEADERTAGS, $sql_data_array);
                    }

                    if (HEADER_TAGS_ENABLE_CACHE != 'None') {
                        ResetCache_HeaderTags($newfiles[$pageNumb]['text'], '',
                            true);
                    }
                }
            }

            $pageNumb++;
        }
    } else if (isset($_POST['view_result']) && $_POST['view_result'] > 0) {
        $done          = false;
        $pageName      = '';
        $numbLanguages = count($languages);

        for ($x = 2; $x < count($newfiles); ++$x) {    //show the correct boxes
            for ($i = 0; $i < $numbLanguages; ++$i) { //show one for each language
                $pageTags_query = tep_db_query("select page_title, page_description, page_keywords, page_logo from ".TABLE_HEADERTAGS." where page_name like '".tep_db_input($newfiles[$x]['text'])."' and language_id = '".(int) $languages[$i]['id']."'");
                $pageTags       = tep_db_fetch_array($pageTags_query);
                $id_toggle      = sprintf("%d%d", $x, $languages[$i]['id']);  //build unique id

                if ($_POST['view_result'] == $id_toggle) { // find the one that was clicked on
                    $pageName         = $newfiles[$x]['text'].'?language='.$languages[$i]['code'];
                    $showMetaInfoItem = $id_toggle;
                    $shopsMetaInfo    = GetMetaInfo($pageName); //read the tags right from the page
                    $viewResult       = $id_toggle;
                    $done             = true;
                    break;
                }
            }

            if ($done) break;
        }
    }

    /*     * ********************** Delete the selected entry ***************************** */ else if (isset($_POST['delete_page'])
        && $_POST['delete_page'] > 0) {
        $protectedFiles = (array) GetBaseFiles();
        $done           = false;
        $pageName       = '';
        $numbLanguages  = count($languages);

        for ($x = 2; $x < count($newfiles); ++$x) {    //show the correct boxes
            $deleteThisPage = false;

            for ($i = 0; $i < $numbLanguages; ++$i) {  //show one for each language
                $id_toggle = sprintf("%d%d", $x, $languages[$i]['id']);  //build unique id

                if ($_POST['delete_page'] == $id_toggle) { // find the one that was clicked on
                    if (in_array($newfiles[$x]['text'], $protectedFiles))
                            $messageStack->add(sprintf(ERROR_INVALID_DELETION,
                                $newfiles[$x]['text']), 'error');
                    else $deleteThisPage = true;

                    $done = true;
                    break;
                }
            }

            if ($done) break;
        }

        if ($deleteThisPage) {
            $deleted = false;
            for ($y = 2; $y < count($newfiles); ++$y) {
                if (strpos($newfiles[$y]['text'], $newfiles[$x]['text']) !== FALSE) { //check for pseudo pages
                    if (!$deleted)
                            $deleted = Deletepage($newfiles[$x]['text']); //only delete the main page

                    if ($deleted) {
                        for ($i = 0; $i < $numbLanguages; ++$i) {  //show one for each language
                            $pageDelete_query = tep_db_query("delete from ".TABLE_HEADERTAGS." where page_name like '".$newfiles[$y]['text']."' and language_id = '".(int) $languages[$i]['id']."'");

                            if (HEADER_TAGS_ENABLE_CACHE != 'None') {
                                if (strpos($newfiles[$x]['text'], "?") !== FALSE) {  // this is a pseudo page
                                    $parts = explode("?", $newfiles[$x]['text']);
                                    $id    = explode("=", $parts[1]);
                                    ResetCache_HeaderTags($parts[0], $id[1]);
                                } else
                                        ResetCache_HeaderTags($newfiles[$y]['text'],
                                        '', true); //parent page was deleted so delete all children
                            }

                            $deletedFile = true;
                        }
                    }
                }
            }
        }

        $newfiles    = GetFileList($languages_id);
        $currentFile = SELECT_A_FILE;
    }

    /*     * ******************** Get Live Keywords Box Checked ********************** */ else if (isset($_POST['keyword_live'])
        && $_POST['keyword_live'] == 'clicked') {
        $checkedKeywordLive = array();  //clear it
        $pageNumb           = GetKey($newfiles, $_POST['new_files']); //find this page

        if ($pageNumb === SHOW_ALL_FILES || is_string($pageNumb))
                $pageNumb = FIRST_PAGE_ENTRY;       //skip over the selection options

        $optionID = array();

        $done = false;
        while (!$done && $pageNumb < count($newfiles)) {
            $found = false;
            for ($i = 0; $i < count($languages); ++$i) {
                $keys       = sprintf("keyword_live_%d_%d", $pageNumb,
                    $languages[$i]['id']); //build the post ID's
                $keysStatus = sprintf("keyword_live_status_%d_%d", $pageNumb,
                    $languages[$i]['id']);

                if (isset($_POST[$keysStatus]) && $_POST[$keysStatus] == '') { //clicked to use live keywords
                    if (isset($_POST[$keys]) && $_POST[$keys] == 'on') { //which page was clicked
                        $pageName   = $_POST['new_files'].'?language='.$languages[$i]['code'];
                        $keywordStr = GetKeywordsFromSite($pageName);

                        if (strpos($keywordStr, "Failed") !== FALSE)
                                $messageStack->add($keywordStr, 'failure');
                        else $checkedKeywordLive[$i] = 'checked';

                        $done = true;
                        break;
                    }
                } //else fall through and use the default keywords
            }
            $pageNumb++;
        }
    }
}

/* * ******************** HANDLE THE DEFAULT SETTINGS ********************** */ else if (isset($_POST['action'])
    && $_POST['action'] == 'default') {
    if (isset($_POST['update_default_section_x'])) {
        for ($i = 0; $i < count($languages); ++$i) {
            $name = sprintf("default_title_%d", $languages[$i]['id']);
            $desc = sprintf("default_desc_%d", $languages[$i]['id']);
            $keys = sprintf("default_keyword_%d", $languages[$i]['id']);
            $logo = sprintf("default_logo_text_%d", $languages[$i]['id']);
            $home = sprintf("home_page_text_%d", $languages[$i]['id']);

            $optTag = array();
            for ($y = 0; $y < count($def_options); ++$y) {
                $optTag[] = sprintf("def_option_%d_%d", $y, $languages[$i]['id']);
            }

            $metaOptionID = array();
            for ($z = 0; $z < count($metaTags); ++$z) {  //create unique option id's 
                $metaOptionID[] = sprintf("metatags_%d", $z);
            }

            if (isset($_POST[$name])) {
                $defaultTags_query = tep_db_query("select * from ".TABLE_HEADERTAGS_DEFAULT." where language_id = '".(int) $languages[$i]['id']."' LIMIT 1");
                $defaultTags       = tep_db_fetch_array($defaultTags_query);
                $sql_data_array    = array('default_title' => tep_db_prepare_input($_POST[$name]),
                    'default_description' => tep_db_prepare_input($_POST[$desc]),
                    'default_keywords' => tep_db_prepare_input($_POST[$keys]),
                    'default_logo_text' => tep_db_prepare_input($_POST[$logo]),
                    'home_page_text' => tep_db_prepare_input($_POST[$home]),
                    'default_logo_append_group' => ((isset($_POST[$optTag[0]]) && $_POST[$optTag[0]]
                    == 'on') ? 1 : 0),
                    'default_logo_append_category' => ((isset($_POST[$optTag[1]])
                    && $_POST[$optTag[1]] == 'on') ? 1 : 0),
                    'default_logo_append_manufacturer' => ((isset($_POST[$optTag[2]])
                    && $_POST[$optTag[2]] == 'on') ? 1 : 0),
                    'default_logo_append_product' => ((isset($_POST[$optTag[3]])
                    && $_POST[$optTag[3]] == 'on') ? 1 : 0),
                    'meta_google' => ((isset($_POST[$metaOptionID[0]]) && $_POST[$metaOptionID[0]]
                    == 'on') ? 1 : 0),
                    'meta_language' => ((isset($_POST[$metaOptionID[1]]) && $_POST[$metaOptionID[1]]
                    == 'on') ? 1 : 0),
                    'meta_noodp' => ((isset($_POST[$metaOptionID[2]]) && $_POST[$metaOptionID[2]]
                    == 'on') ? 1 : 0),
                    'meta_noydir' => ((isset($_POST[$metaOptionID[3]]) && $_POST[$metaOptionID[3]]
                    == 'on') ? 1 : 0),
                    'meta_replyto' => ((isset($_POST[$metaOptionID[4]]) && $_POST[$metaOptionID[4]]
                    == 'on') ? 1 : 0),
                    'meta_revisit' => ((isset($_POST[$metaOptionID[5]]) && $_POST[$metaOptionID[5]]
                    == 'on') ? 1 : 0),
                    'meta_robots' => ((isset($_POST[$metaOptionID[6]]) && $_POST[$metaOptionID[6]]
                    == 'on') ? 1 : 0),
                    'meta_unspam' => ((isset($_POST[$metaOptionID[7]]) && $_POST[$metaOptionID[7]]
                    == 'on') ? 1 : 0),
                    'meta_canonical' => ((isset($_POST[$metaOptionID[8]]) && $_POST[$metaOptionID[8]]
                    == 'on') ? 1 : 0),
                    'meta_og' => ((isset($_POST[$metaOptionID[9]]) && $_POST[$metaOptionID[9]]
                    == 'on') ? 1 : 0)
                );

                if (tep_db_num_rows($defaultTags_query)) {
                    tep_db_perform(TABLE_HEADERTAGS_DEFAULT, $sql_data_array,
                        'update',
                        "language_id = '".(int) $languages[$i]['id']."'");
                } else {
                    $insert_sql_data = array('language_id' => (int) $languages[$i]['id']);
                    $sql_data_array  = array_merge($sql_data_array,
                        $insert_sql_data);
                    tep_db_perform(TABLE_HEADERTAGS_DEFAULT, $sql_data_array);
                }
            }
        }
    }

    /*     * ******************** ADD A PSEUDO PAGE ********************** */ else if (isset($_POST['add_pseudo_page_x'])) {
        $psedudoPage = tep_db_prepare_input($_POST['pseudo_page_name']);
        if (strpos($psedudoPage, ".php") === FALSE || strpos($psedudoPage, "?") === FALSE
            || strpos($psedudoPage, "=") === FALSE) {
            $messageStack->add(sprintf(ERROR_INVALID_PSEUDO_FORMAT, $psedudoPage),
                'error');
        } else {
            $parts     = explode("?", $psedudoPage);
            $baseFiles = (array) GetBaseFiles();
            if (in_array($parts[0], $baseFiles)) { //don't allow pseudo pages for base files
                $messageStack->add(sprintf(ERROR_INVALID_PSEUDO_PAGE, $parts[0]),
                    'error');
            } else if (($result = FileNotUsingHeaderTags($parts[0])) === 'FALSE'
                || IsTemplate()) {
                $pageTags_query = tep_db_query("select * from ".TABLE_HEADERTAGS." where page_name like '".$psedudoPage."' and language_id = '".(int) $languages_id."'");
                $pageTags       = tep_db_fetch_array($pageTags_query);

                if (tep_db_num_rows($pageTags_query) == 0) {
                    $filenameInc = DIR_FS_CATALOG.DIR_WS_INCLUDES.'header_tags.php';
                    $fp          = @file($filenameInc);

                    if (AddedToHeaderTagsIncludesFilePseudo($psedudoPage, $fp,
                            $languages_id)) {
                        if (WriteHeaderTagsFile($filenameInc, $fp)) {
                            $pageTags_query = tep_db_query("select * from ".TABLE_HEADERTAGS." where page_name like '".$psedudoPage."' and language_id = '".(int) $languages_id."'");
                            if (tep_db_num_rows($pageTags_query) == 0) {
                                for ($i = 0; $i < count($languages); ++$i) {
                                    $sql_data_array = array('page_name' => $psedudoPage,
                                        'page_title' => '',
                                        'page_description' => '',
                                        'page_keywords' => '',
                                        'page_logo' => '',
                                        'page_logo_1' => '',
                                        'page_logo_2' => '',
                                        'page_logo_3' => '',
                                        'page_logo_4' => '',
                                        'append_default_title' => 0,
                                        'append_default_description' => 0,
                                        'append_default_keywords' => 0,
                                        'append_default_logo' => 0,
                                        'append_category' => 0,
                                        'append_manufacturer' => 0,
                                        'append_model' => 0,
                                        'append_product' => 0,
                                        'append_root' => 1,
                                        'sortorder_title' => 0,
                                        'sortorder_description' => 0,
                                        'sortorder_keywords' => 0,
                                        'sortorder_logo' => 0,
                                        'sortorder_logo_1' => 0,
                                        'sortorder_logo_2' => 0,
                                        'sortorder_logo_3' => 0,
                                        'sortorder_logo_4' => 0,
                                        'sortorder_category' => 0,
                                        'sortorder_manufacturer' => 0,
                                        'sortorder_model' => 0,
                                        'sortorder_product' => 0,
                                        'sortorder_root' => 1,
                                        'sortorder_root_1' => 0,
                                        'sortorder_root_2' => 0,
                                        'sortorder_root_3' => 0,
                                        'sortorder_root_4' => 0,
                                        'language_id' => $languages[$i]['id']);

                                    tep_db_perform(TABLE_HEADERTAGS,
                                        $sql_data_array);

                                    if (HEADER_TAGS_ENABLE_CACHE != 'None') {
                                        ResetCache_HeaderTags($psedudoPage, '',
                                            true);
                                    }
                                }
                                $newfiles = GetFileList($languages_id);
                            }
                        }
                    }
                } else
                        $messageStack->add(sprintf(ERROR_DUPLICATE_PAGE,
                            $psedudoPage), 'error');
            } else if ($result != 'TRUE')
                    $messageStack->add(sprintf(ERROR_NOT_USING_HEADER_TAGS,
                        $parts[0]), 'error');
        }
    }
}

/* * ******************** CHECK THE VERSION ********************** */ else if (isset($_POST['action'])
    && $_POST['action'] == 'getversion') {
    if (isset($_POST['version_check']) && $_POST['version_check'] == 'on')
            $versionStatus = AnnounceVersion($contribPath, $currentVersion,
            $contribName);
}


if (isset($_POST['new_files']) && (!$deletedFile)) {
    $currentFile = GetKey($newfiles, $_POST['new_files']);

    if ($currentFile === ADD_MISSING_PAGES)
            $newfiles = AddMissingPages($languages_id, $languages);
}
require(DIR_WS_INCLUDES.'template_top.php');
?>
<style type="text/css">
    table.BorderedBox {border: ridge #ddd 3px; background-color: #eee; }
    table.BorderedBoxWhite {border: ridge #ddd 3px; background-color: #fff; }
    td.HTC_Head {font-family: Verdana, Arial, sans-serif; color:#727272; font-size: 18px; font-weight: bold; } 
    td.HTC_subHead {font-family: Verdana, Arial, sans-serif; color:#727272; font-size: 12px; } 
    .HTC_title {background: #fof1f1; text-align: center;} 

    .popup { color:yellow; cursor:pointer; text-decoration:none }
</style>

<script type="text/javascript">

    $(document).ready(function () {
        $.each($("input"), function () {
            var id = $(this).attr("id");

            if (typeof id !== 'undefined') {
                if (id.contains("pagetitle_") || id.contains("pagedesc_")) {
                    ShowCharacterCount(id);
                }
            }
        });
    });

    function confirmdelete(form, page) {
        if (confirm('Do you really want to delete ' + page + '?\r\n\r\nThis only deletes the entry in Header Tags, not the actual file.'))
            form.submit();

        return false;
    }

    function ShowCharacterCount(id) {
        var cnt = ($("#" + id).val().length); //how many characters in box
        var dest = id + "_cnt";
        $("#" + dest).val(cnt);   //display the count

        var size1;
        var size2;

        if (id.contains("title")) {
            size1 = 65;
            size2 = 55;
        } else {
            size1 = 170;
            size2 = 150;
        }

        var color = "#fff";          //change the color based on the character count
        if (cnt > size1)
            color = "#ff3300"
        else if (cnt > size2)
            color = "#ffff00"

        $("#" + dest).css("background-color", color);

        return false;
    }

    function showHelp(page) {
        $("#hts_help").dialog({
            show: "fade",
            hide: "fade",
            position: ['middle', 100],
            width: 600,
            height: 400,
            modal: true,
            open: function (event, ui) {
                $(this).load(page);
            }
            //, buttons: { "Ok": function() { $(this).dialog("close"); } }
        });
    }

    function UpdateSortOrder(page) {
        var checkbox = "option_" + page;
        var ckbox_status = document.getElementById(checkbox).checked;

        if (ckbox_status === false)
            document.getElementById(page).disabled = true;
        else
            document.getElementById(page).disabled = false;
    }
    function AddExtraLogoText(pagename, languageid) {
        var url = "header_tags_seo_popup_logotext.php" + "?pagename=" + pagename + "&languageid=" + languageid;
        window.open(url, 'HTS', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no,copyhistory=no,width=700,height=400,screenX=50,screenY=150,top=50,left=150');
    }
</script>
<div id='dialog'></div>  <!-- for ajax popup //-->
<table border="0" width="100%" cellspacing="2" cellpadding="2">
    <tr>
        <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                <tr>
                    <td><table border="0" width="100%" cellspacing="0" cellpadding="2" class="BorderedBox">
                            <tr>
                                <td><table border="0" width="95%" cellspacing="0" cellpadding="2">
                                        <tr>
                                            <td class="HTC_Head" valign="top" style="white-space:nowrap;"><?php echo $currentVersion; ?></td>
                                        </tr>
                                        <tr>
                                            <td class="smallText" valign="top"><?php echo HEADING_TITLE_SUPPORT_THREAD; ?></td>
                                        </tr>
                                    </table></td>

                                <td><table border="0" width="100%">
                                        <tr>
                                            <td class="smallText" align="right"><?php echo HEADING_TITLE_AUTHOR; ?></td>
                                        </tr>
                                        <?php
                                        if (function_exists('AnnounceVersion')) {
                                            $idParts = explode(' ',
                                                $currentVersion);
                                            foreach ($idParts as $part) {
                                                if ($part !== 'V') {
                                                    $name .= $part;
                                                } else {
                                                    break;
                                                }
                                            }
                                            $id = $idParts[count($idParts) - 1];
                                            if (HEADER_TAGS_ENABLE_VERSION_CHECKER
                                                == 'true') {
                                                ?>
                                                <tr>
                                                    <td style="float:right"><table border="0" cellpadding="0"><tr>
                                                                <td class="smallText" align="right" style="font-weight: bold; color: red;"><?php
                                                                    echo AnnounceVersion($contribPath,
                                                                        $currentVersion,
                                                                        $contribName);
                                                                    ?></td>
                                                                <td class="smallText" align="right" style="font-weight: bold; color: red;"><INPUT TYPE="radio" NAME="version_check_unreleased" onClick="window.open('http://www.oscommerce-solution.com/check_unreleased_updates.php?id=<?php echo $id; ?>&name=<?php echo $name; ?>')"><span style="vertical-align:top"><?php echo TEXT_VERSION_CHECK_UPDATES_UNRELEASED; ?></span></td>
                                                            </tr></table></td>                  
                                                </tr>
                                                <?php
                                            } else if (tep_not_null($versionStatus)) {
                                                echo '<tr><td class="smallText" align="right" style="font-weight: bold; color: red;">'.$versionStatus.'</td></tr>';
                                            } else {
                                                echo tep_draw_form('version_check',
                                                    FILENAME_HEADER_TAGS_SEO,
                                                    '', 'post').tep_draw_hidden_field('action',
                                                    'getversion');
                                                ?>
                                                <tr>
                                                    <td style="float:right"><table border="0" cellpadding="0"><tr>
                                                                <td class="smallText" align="right" style="font-weight: bold; color: red;"><INPUT TYPE="radio" NAME="version_check" onClick="this.form.submit();"><?php echo TEXT_VERSION_CHECK_UPDATES; ?></td>
                                                                <td class="smallText" align="right" style="font-weight: bold; color: red;"><INPUT TYPE="radio" NAME="version_check_unreleased" onClick="window.open('http://www.oscommerce-solution.com/check_unreleased_updates.php?id=<?php echo $id; ?>&name=<?php echo $name; ?>')"><span style="vertical-align:top"><?php echo TEXT_VERSION_CHECK_UPDATES_UNRELEASED; ?></span></td>
                                                            </tr></table></td>
                                                </tr>
                                                </form>
    <?php }
} else {
    ?>
                                            <tr>
                                                <td class="smallText" align="right" style="font-weight: bold; color: red;"><?php echo TEXT_MISSING_VERSION_CHECKER; ?></td>
                                            </tr>
                            <?php } ?>
                                    </table></td>
                            </tr>
                                    <?php $stats = GetQuickStats($missingArray); ?>
                            <tr>
                                <td class="HTC_subHead" colspan="2" style="height:100px; vertical-align:top">
                                    <?php
                                    echo sprintf(TEXT_PAGE_TAGS,
                                        $stats['cat_desc'], $stats['missing_c'],
                                        $stats['manu_desc'],
                                        $stats['missing_m'],
                                        $stats['keywords_searched'],
                                        $stats['keywords_not_found'],
                                        $stats['missing_p']);
                                    ?>
                                </td>
                            </tr>
                            <tr><td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif',
                                        '100%', '10');
                                    ?></td></tr>       
                        </table></td>
                </tr>

                <!-- Begin of Header Tags -->   
                <tr>
                    <td align="right"><table width="100%" border="0" cellspacing="0" cellpadding="2" class="BorderedBoxWhite">     
                            <tr>
                                <!-- begin left column new page -->
                                <td align="right" width="60%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
<?php
echo tep_draw_form('header_tags', FILENAME_HEADER_TAGS_SEO, '', 'post').tep_draw_hidden_field('action',
    'update');
?>
                                        <tr>
                                            <td class="smallText" height="40" valign="top"><?php echo TEXT_INFORMATION_PAGES; ?></td>
                                        </tr>

                                        <tr>
                                            <td valign="top" width="100%"><table width="100%" border="1">       
                                                    <tr>
                                                        <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                                                                <tr>
                                                                    <td><table border="0" width="100%">
                                                                            <tr>
                                                                                <td class="smallText" width="25%" style="font-weight: bold;"><?php echo HEADING_TITLE_SEO_PAGENAME; ?></td>
                                                                                <td align="left"><?php
                                                                echo tep_draw_pull_down_menu('new_files',
                                                                    $newfiles,
                                                                    '',
                                                                    'onChange="this.form.submit();"',
                                                                    false);
                                                                ?></td>
                                                                            <tr>             
                                                                        </table></td>
                                                                </tr>          
                                                                <?php
                                                                if ($currentFile
                                                                    == SELECT_A_FILE
                                                                    || $currentFile
                                                                    == ADD_MISSING_PAGES) {  //don't display any boxes
                                                                    $start = 0;
                                                                    $stop  = 0;
                                                                    $title = '';
                                                                } else if ($currentFile
                                                                    == SHOW_ALL_FILES) { //display all boxes
                                                                    $start = FIRST_PAGE_ENTRY;
                                                                    $stop  = count($newfiles);
                                                                } else {                                     //display the selected file
                                                                    $start = $currentFile;
                                                                    $stop  = $currentFile
                                                                        + 1;
                                                                }

                                                                $numbLanguages = count($languages);
                                                                for ($x = $start; $x
                                                                    < $stop; ++$x) {    //show the correct boxes
                                                                    for ($i = 0; $i
                                                                        < $numbLanguages; ++$i) { //show one for each language
                                                                        $pageTags_query
                                                                            = tep_db_query("select page_title, page_description, page_keywords, page_logo, page_logo_1 as alt_1, append_category as opt_0, append_manufacturer as opt_1, append_model as opt_2, append_product as opt_3, append_root as opt_4, append_default_title as opt_5, append_default_description as opt_6, append_default_keywords as opt_7, append_default_logo as opt_8, sortorder_category as opt_9, sortorder_manufacturer as opt_10, sortorder_model as opt_11, sortorder_product as opt_12, sortorder_root as opt_13, sortorder_title as opt_14, sortorder_description as opt_15, sortorder_keywords as opt_16, sortorder_logo as opt_17 from ".TABLE_HEADERTAGS." where page_name like '".$newfiles[$x]['text']."' and language_id = '".(int) $languages[$i]['id']."' LIMIT 1");
                                                                        $pageTags
                                                                            = tep_db_fetch_array($pageTags_query);

                                                                        if ($checkedKeywordLive[$i]
                                                                            == 'checked') {
                                                                            $pageTags['page_keywords']
                                                                                = $keywordStr;
                                                                        }

                                                                        $id            = sprintf("%d_%d",
                                                                            $x,
                                                                            $languages[$i]['id']);  //build unique id
                                                                        $id_toggle
                                                                            = sprintf("%d%d",
                                                                            $x,
                                                                            $languages[$i]['id']);  //build unique id
                                                                        $checked
                                                                            = ($viewResult
                                                                            == $id_toggle)
                                                                                ? 'checked disabled'
                                                                                : '';
                                                                        ?>            
                                                                        <tr>
                                                                            <td><table border="2" width="100%">
                                                                                    <tr>
                                                                                        <td ><table border="0" style="background-color: #f0f1f1;" width="100%" class="infoBoxContent">
                                                                                                <tr>
                                                                                                    <th class="smallText"width="50%"><?php echo $newfiles[$x]['text'].' - '.$languages[$i]['name']; ?></th>
                                                                                                    <td align="right"><table border="0" cellpadding="0" celspacing="0">
                                                                                                            <tr> 
                                                                                                                <th class="smallText" title="<?php echo $commonPopup['view']; ?>" class="popup" ><?php echo HEADING_TITLE_SEO_VIEW_RESULT; ?> </th>
                                                                                                                <th title="<?php echo $commonPopup['view']; ?>" class="popup" ><input type="checkbox" name="view_result" value="<?php echo $id_toggle; ?>" onClick="this.form.submit();"  <?php echo $checked; ?> ></th>
                                                                                                                <th class="smallText" title="<?php echo $commonPopup['delete']; ?>" class="popup"><?php echo HEADING_TITLE_SEO_DELETE; ?> </th>
                                                                                                                <th title="<?php echo $commonPopup['delete']; ?>" class="popup"><input type="checkbox" name="delete_page" value="<?php echo $id_toggle; ?>" onClick="return confirmdelete(this.form, '<?php echo $newfiles[$x]['text']; ?>')" ></th>
                                                                                                            </tr>
                                                                                                        </table></td>                                                
                                                                                                </tr> 
                                                                                            </table></td>
                                                                                    </tr>                     
                                                                                    <tr>            
                                                                                        <td><table border="1" width="100%">

                                                                                                <tr>
                                                                                                    <td class="smallText" width="18%" style="font-weight: bold;"><?php echo HEADING_TITLE_SEO_TITLE; ?></td>
                                                                                                    <td class="smallText" title="<?php echo $commonPopup['title']; ?>" class="popup" >
                                                                                                        <div style="float:left; width:100%;">
                                                                                                            <div style="float:left">
                                                                                                                <input type="text" name="title_<?php echo $id; ?>" value="<?php echo ($pageTags['page_title'])
                                                                                                                       ? $pageTags['page_title']
                                                                                                                       : '';
                                                                        ?>" maxlength="255" size="55" id="pagetitle_<?php echo $id_toggle; ?>"                             
                                                                                                                       onkeyup="javascript:return ShowCharacterCount('<?php echo 'pagetitle_'.$id_toggle; ?>')">
                                                                                                            </div> 
                                                                                                            <div style="float:right;"><input type="text" disabled name="title_<?php echo $id.'_cnt'; ?>" id="pagetitle_<?php echo $id_toggle.'_cnt'; ?>" value="0" size="2" style=""></div>
                                                                                                        </div>
                                                                                                    </td>
                                                                                                </tr> 
                                                                                                <tr>
                                                                                                    <td class="smallText" style="font-weight: bold;"><?php echo HEADING_TITLE_SEO_DESCRIPTION; ?></td>
                                                                                                    <td class="smallText" title="<?php echo $commonPopup['desc']; ?>" class="popup" >
                                                                                                        <div style="float:left; width:100%;">
                                                                                                            <div style="float:left;">                        
                                                                                                                <input type="text" name="desc_<?php echo $id; ?>" value="<?php
                                                                                                            echo ($pageTags['page_description'])
                                                                                                                    ? $pageTags['page_description']
                                                                                                                    : '';
                                                                                                            ?>" maxlength="255" size="55" id="pagedesc_<?php echo $id_toggle; ?>" onkeyup="javascript:return ShowCharacterCount('<?php echo 'pagedesc_'.$id_toggle; ?>')">  
                                                                                                            </div> 
                                                                                                            <div style="float:right;"><input type="text" disabled name="desc_<?php echo $id.'_cnt'; ?>" id="pagedesc_<?php echo $id_toggle.'_cnt'; ?>" value=0 size="2" ></div>
                                                                                                        </div>                          
                                                                                                    </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td class="smallText" style="font-weight: bold;"><?php echo HEADING_TITLE_SEO_KEYWORDS; ?></td>
                                                                                                    <td class="smallText" title="<?php echo $commonPopup['keywords']; ?>" class="popup" >
                                                                                                        <input type="text" name="keyword_<?php echo $id; ?>" value="<?php
                                                                                                            echo ($pageTags['page_keywords'])
                                                                                                                    ? $pageTags['page_keywords']
                                                                                                                    : '';
                                                                                                            ?>" maxlength="255" size="60" id="keyword_<?php echo $id_toggle; ?>">
                                                                                                        <span title="<?php echo $commonPopup['keywords_live']; ?>" class="popup" ><input type="radio" name="keyword_live_<?php echo $id; ?>" <?php echo $checkedKeywordLive[$i]; ?> onClick="this.form.submit();"></span>
                                                                                                        <input type="hidden" name="keyword_live" value="clicked">
                                                                                                        <input type="hidden" name="keyword_live_status_<?php echo $id; ?>" value="<?php echo $checkedKeywordLive[$i]; ?>">
                                                                                                    </td>
                                                                                                </tr>
                                                                                                <tr style="background: <?php
                                                                                                            echo (tep_not_null($pageTags['alt_1'])
                                                                                                                    ? "#99ffff"
                                                                                                                    : white)
                                                                                                            ?>;">
                                                                                                    <td class="smallText" style="font-weight: bold;"><?php echo HEADING_TITLE_SEO_LOGO; ?></td>
                                                                                                    <td class="smallText" title="<?php echo $commonPopup['logo']; ?>" class="popup" ><input type="text" name="logo_<?php echo $id; ?>" value="<?php
                                                                                                            echo ($pageTags['page_logo'])
                                                                                                                    ? $pageTags['page_logo']
                                                                                                                    : '';
                                                                                                            ?>" maxlength="255" size="60" id="logo_<?php echo $id_toggle; ?>">
                                                                                                        <span title="<?php echo $commonPopup['logo_extra']; ?>" class="popup" ><input type="radio" name="logo_extra_<?php echo $id; ?>" <?php echo $addextraLogoText[$i]; ?> onClick="AddExtraLogoText('<?php echo $newfiles[$x]['text']; ?>', '<?php echo $languages[$i]['id']; ?>');"></span>
                                                                                                        <input type="hidden" name="logo_extra_text" value="clicked">
                                                                                                        <input type="hidden" name="logo_extra_status_<?php echo $id; ?>" value="<?php echo $logoExtraText[$i]; ?>">
                                                                                                    </td>
                                                                                                </tr>                       
                                                                                                <tr>
                                                                                                    <td class="smallText" style="font-weight: bold;"><?php echo HEADING_TITLE_SEO_OPTIONS; ?></td>
                                                                                                    <td class="smallText"><table border="2" width="100%">
        <?php
        $incrCheckNumb = count($optionPopup) / 3;
        $incrSortNumb  = count($optionPopup) - $incrCheckNumb;
        $rows          = floor(count($options) / 2) + 1;
        for ($y = 0; $y < $rows; ++$y) {
            $optTag     = sprintf("opt_%d", $y);
            $sortoptTag = sprintf("opt_%d",
                $y + $incrCheckNumb);
            $checked    = ($pageTags[$optTag] > 0) ? 'checked' : '';
            $disabled   = ($pageTags[$sortoptTag] > 0) ? '' : 'disabled';
            $sortNumb   = (tep_not_null($pageTags[$sortoptTag]) && $pageTags[$sortoptTag]
                !== '0') ? $pageTags[$sortoptTag] : '';
            ?> 
                                                                                                                <tr onMouseOver="this.style.backgroundColor = '#F0F0F0'" onMouseOut="this.style.backgroundColor = '#FFFFFF'" bgcolor="#FFFFFF">
                                                                                                                    <td><table border="0" style="border: ridge 1 px; width: 100%">
                                                                                                                            <tr>
                                                                                                                                <td class="smallText" width="80%" title="<?php echo $optionPopup[$y]; ?>" class="popup"><?php echo $options[$y]; ?></td>
                                                                                                                                <td align="left" width="10" align="right" title="<?php echo $optionPopup[$y
                                                                                                        + $incrCheckNumb];
            ?>" class="popup"><input type="checkbox" name="option_<?php echo $y.'_'.$id; ?>" id="option_<?php echo $y.'_'.$id; ?>" <?php echo $checked; ?> onClick="UpdateSortOrder('<?php echo $y.'_'.$id; ?>');"></td>
                                                                                                                                <td class="smallText" align="right" title="<?php echo $optionPopup[$y
                                                                                                        + $incrSortNumb];
                                                                                                        ?>" class="popup"><?php
                                                                                                                                    echo tep_draw_input_field('sortoption_'.$y.'_'.$id,
                                                                                                                                        $sortNumb,
                                                                                                                                        'maxlength="2" size="1" '.$disabled.' id="'.$y.'_'.$id.'"');
                                                                                                                                    ?> </td>
                                                                                                                            </tr>
                                                                                                                        </table></td> 
                                                                                                                    <?php
                                                                                                                    if ($y
                                                                                                                        < ($rows
                                                                                                                        - 1)) {
                                                                                                                        $z
                                                                                                                            = $y
                                                                                                                            + 5;
                                                                                                                        $optTag
                                                                                                                            = sprintf("opt_%d",
                                                                                                                            $z);
                                                                                                                        $sortoptTag
                                                                                                                            = sprintf("opt_%d",
                                                                                                                            $z
                                                                                                                            + $incrCheckNumb);
                                                                                                                        $checked
                                                                                                                            = ($pageTags[$optTag]
                                                                                                                            > 0)
                                                                                                                                ? 'checked'
                                                                                                                                : '';
                                                                                                                        $disabled
                                                                                                                            = ($pageTags[$sortoptTag]
                                                                                                                            > 0)
                                                                                                                                ? ''
                                                                                                                                : 'disabled';
                                                                                                                        $sortNumb
                                                                                                                            = (tep_not_null($pageTags[$sortoptTag])
                                                                                                                            && $pageTags[$sortoptTag]
                                                                                                                            !== '0')
                                                                                                                                ? $pageTags[$sortoptTag]
                                                                                                                                : '';
                                                                                                                        ?>
                                                                                                                        <td><table border="0" style="border: ridge 1 px; width: 100%">
                                                                                                                                <tr>
                                                                                                                                    <td class="smallText" width="80%" title="<?php echo $optionPopup[$z]; ?>" class="popup"><?php echo $options[$z]; ?></td>
                                                                                                                                    <td align="left" width="10" align="right" title="<?php echo $optionPopup[$z
                                                                                            + $incrCheckNumb];
                                                                                            ?>" class="popup"><input type="checkbox" name="option_<?php echo $z.'_'.$id; ?>" id="option_<?php echo $z.'_'.$id; ?>" <?php echo $checked; ?> onClick="UpdateSortOrder('<?php echo $z.'_'.$id; ?>');"></td>
                                                                                                                                    <td class="smallText" align="right" title="<?php echo $optionPopup[$z
                                                                                            + $incrSortNumb];
                                                                                            ?>" class="popup"><?php
                                                                                        echo tep_draw_input_field('sortoption_'.$z.'_'.$id,
                                                                                            $sortNumb,
                                                                                            'maxlength="2" size="1" '.$disabled.' id="'.$z.'_'.$id.'"');
                                                                                        ?> </td>
                                                                                                                                </tr>
                                                                                                                            </table></td> 
                                                                            <?php } else { ?>
                                                                                                                        <td><table border="0" style="border: ridge 1 px; width: 70%">
                                                                                                                                <tr>
                                                                                                                                    <td>&nbsp;</td>
                                                                                                                                </tr>
                                                                                                                            </table></td> 
                                                                            <?php } ?>
                                                                                                                </tr>
        <?php }
        ?>
                                                                                                        </table></td>                        
                                                                                                <tr>                                          
                                                                                            </table></td>
                                                                                    </tr>
                                                                                    <!-- View Result -->  
                                                                                    <tr>            
                                                                                        <td><table border="0" width="100%" id="<?php echo $id_toggle; ?>" style="display: <?php echo (($id_toggle
        == $showMetaInfoItem) ? 'inline' : 'none');
        ?>">
                                                                                                <tr class="smallText" style="background: <?php echo (tep_not_null($shopsMetaInfo['title'])
                ? yellow : red)
        ?>;">
                                                                                                    <td  title="<?php echo $commonPopup['view_title_A']; ?>" class="popup" width="10%" style="color:#000; font-weight: bold;"><?php echo HEADING_TITLE_SEO_TITLE; ?></td>
                                                                                                    <td  title="<?php echo $commonPopup['view_title_B']; ?>" class="popup"><input type="text" name="title_viewed" value="<?php echo $shopsMetaInfo['title']; ?>" size="65" id="title_<?php echo $id_toggle; ?>_viewed"> </td>
                                                                                                </tr> 
                                                                                                <tr class="smallText" style="background: <?php echo (tep_not_null($shopsMetaInfo['description'][1])
                ? yellow : red)
        ?>;">
                                                                                                    <td title="<?php echo $commonPopup['view_desc_A']; ?>" class="popup" style="color:#000; font-weight: bold;"><?php echo HEADING_TITLE_SEO_DESCRIPTION; ?></td>
                                                                                                    <td title="<?php echo $commonPopup['view_desc_B']; ?>" class="popup"><input type="text" name="desc_viewed" value="<?php echo $shopsMetaInfo['description']; ?>" size="65" id="desc_<?php echo $id_toggle; ?>_viewed"> </td>
                                                                                                </tr> 
                                                                                                <tr class="smallText" style="background: <?php echo (tep_not_null($shopsMetaInfo['keywords'][1])
                                                            ? yellow : red)
                                                    ?>;">
                                                                                                    <td title="<?php echo $commonPopup['view_keywords_A']; ?>" class="popup" style="color:#000; font-weight: bold;"><?php echo HEADING_TITLE_SEO_KEYWORDS; ?></td>
                                                                                                    <td title="<?php echo $commonPopup['view_keywords_B']; ?>" class="popup"><input type="text" name="keyword_viewed" value="<?php echo $shopsMetaInfo['keywords']; ?>" size="65" id="keyword_<?php echo $id_toggle; ?>_viewed"> </td>
                                                                                                <tr>
                                                                                            </table></td>
                                                                                    </tr>                    
                                                                                </table></td>
                                                                        </tr>         
                                                                        <tr>
                                                                            <td><?php
                                                                            echo tep_draw_separator('pixel_trans.gif',
                                                                                '100%',
                                                                                '10');
                                                                            ?></td>
                                                                        </tr>
    <?php }
}
?>     

<?php if ($currentFile != SELECT_A_FILE && $currentFile != ADD_MISSING_PAGES && count($newfiles)
    > FIRST_PAGE_ENTRY) {
    ?>
                                                                    <tr> 
                                                                        <td align="center"><?php echo (tep_image_submit('button_update.gif',
        IMAGE_UPDATE) ).' <a href="'.tep_href_link(FILENAME_HEADER_TAGS_SEO, '').'">'.'</a>';
    ?></td>
                                                                    </tr>
<?php } ?>  
                                                                <tr>
                                                                    <td><?php echo tep_black_line(); ?></td>
                                                                </tr>
                                                            </table></td>
                                                    </tr> 
                                                </table></td>
                                        </tr>
                                        </form>
                                    </table></td>      



                                <!-- begin right column default options -->

                                <td align="right" width="40%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td align="right" width="40%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
<?php
echo tep_draw_form('header_tags_default', FILENAME_HEADER_TAGS_SEO, '', 'post').tep_draw_hidden_field('action',
    'default');
?>
                                                    <tr>
                                                        <td class="smallText" height="40" valign="top"><?php echo TEXT_INFORMATION_DEFAULT; ?></td>
                                                    </tr>          
                                                    <tr>
                                                        <td valign="top" width="100%"><table width="100%" border="2">             
                                                                <tr>
                                                                    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="0">
                                                                            <!-- BEGIN DEFAULT TAGS -->      
                                                                                                            <?php
                                                                                                            $numbLanguages
                                                                                                                = count($languages);
                                                                                                            for ($i
                                                                                                            = 0; $i
                                                                                                                < $numbLanguages; ++$i) { //show one for each language
                                                                                                                $defaultTags_query
                                                                                                                    = tep_db_query("select default_title, default_description, default_keywords, default_logo_text, home_page_text, default_logo_append_group as def_option_0, default_logo_append_category as def_option_1, default_logo_append_manufacturer as def_option_2, default_logo_append_product as def_option_3, meta_google as meta_0, meta_language as meta_1, meta_noodp as meta_2, meta_noydir as meta_3, meta_replyto as meta_4, meta_revisit as meta_5, meta_robots as meta_6, meta_unspam as meta_7, meta_canonical as meta_8, meta_og as meta_9 from ".TABLE_HEADERTAGS_DEFAULT." where language_id = '".(int) $languages[$i]['id']."' LIMIT 1");
                                                                                                                $defaultTags
                                                                                                                    = tep_db_fetch_array($defaultTags_query);
                                                                                                                $id
                                                                                                                    = $languages[$i]['id'];  //build unique id
                                                                                                                ?>                   
                                                                                <tr>
                                                                                    <td><table border="1" width="100%" >
                                                                                            <tr>
                                                                                                <td><table border="0" width="100%" class="infoBoxContent">
                                                                                                        <tr>
                                                                                                            <th class="smallText" style="background-color: #f0f1f1; text-align: center;"><?php echo HEADING_TITLE_SEO_DEFAULT_TAGS.' - '.$languages[$i]['name']; ?></th>
                                                                                                        </tr> 
                                                                                                    </table></td>
                                                                                            </tr>
                                                                                            <tr>            
                                                                                                <td><table border="1" width="100%">
                                                                                                        <tr>
                                                                                                            <td class="smallText" width="25%" style="font-weight: bold;"><?php echo HEADING_TITLE_SEO_TITLE; ?></td>
                                                                                                            <td class="smallText" title="<?php echo $commonPopup['def_title']; ?>" class="popup" ><input type="text" name="default_title_<?php echo $id; ?>" value="<?php
                                                                                                                                                echo (tep_not_null($defaultTags['default_title'])
                                                                                                                                                        ? $defaultTags['default_title']
                                                                                                                                                        : '');
                                                                                                                                                ?>" maxlength="255" size="36"> </td>
                                                                                                        </tr> 
                                                                                                        <tr>
                                                                                                            <td class="smallText" style="font-weight: bold;"><?php echo HEADING_TITLE_SEO_DESCRIPTION; ?></td>
                                                                                                            <td class="smallText" title="<?php echo $commonPopup['def_desc']; ?>" class="popup" ><input type="text" name="default_desc_<?php echo $id; ?>" value="<?php
                                                                                                                                            echo (tep_not_null($defaultTags['default_description'])
                                                                                                                                                    ? $defaultTags['default_description']
                                                                                                                                                    : '');
                                                                                                                                            ?>" maxlength="255" size="36"> </td>
                                                                                                        </tr> 
                                                                                                        <tr>
                                                                                                            <td class="smallText" style="font-weight: bold;"><?php echo HEADING_TITLE_SEO_KEYWORDS; ?></td>
                                                                                                            <td class="smallText" title="<?php echo $commonPopup['def_keywords']; ?>" class="popup" ><input type="text" name="default_keyword_<?php echo $id; ?>" value="<?php
                                                                            echo (tep_not_null($defaultTags['default_keywords'])
                                                                                    ? $defaultTags['default_keywords']
                                                                                    : '');
                                                                            ?>" maxlength="255" size="36"> </td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <td class="smallText" style="font-weight: bold;"><?php echo HEADING_TITLE_SEO_LOGO; ?></td>
                                                                                                            <td class="smallText" title="<?php echo $commonPopup['def_logo']; ?>" class="popup" ><input type="text" name="default_logo_text_<?php echo $id; ?>" value="<?php
                                                                            echo (tep_not_null($defaultTags['default_logo_text'])
                                                                                    ? $defaultTags['default_logo_text']
                                                                                    : '');
                                                                            ?>" maxlength="255" size="36"> </td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <td class="smallText" style="font-weight: bold; vertical-align:top"><?php echo HEADING_TITLE_SEO_HOME_PAGE; ?></td>
                                                                                                            <td class="smallText" title="<?php echo $commonPopup['def_home_text']; ?>" class="popup" >

                                                                                                                        <?php
                                                                                                                        if (HEADER_TAGS_ENABLE_HTML_EDITOR
                                                                                                                            == 'CKEditor') {
                                                                                                                            echo tep_draw_textarea_field('home_page_text_'.$id,
                                                                                                                                'soft',
                                                                                                                                37,
                                                                                                                                8,
                                                                                                                                (tep_not_null($defaultTags['home_page_text'])
                                                                                                                                        ? $defaultTags['home_page_text']
                                                                                                                                        : ''),
                                                                                                                                'id = "home_page_text_'.$id.'" class="ckeditor"');
                                                                                                                        } else {
                                                                                                                            echo tep_draw_textarea_field('home_page_text_'.$id,
                                                                                                                                'soft',
                                                                                                                                36,
                                                                                                                                8,
                                                                                                                                (tep_not_null($defaultTags['home_page_text'])
                                                                                                                                        ? $defaultTags['home_page_text']
                                                                                                                                        : ''));
                                                                                                                        }
                                                                                                                        ?>
                                                                                                            </td>
                                                                                                        </tr>                                               
                                                                                                        <tr>
                                                                                                            <td class="smallText" style="font-weight: bold;"><?php echo HEADING_TITLE_SEO_OPTIONS; ?></td>
                                                                                                            <td class="smallText"><table border="0" width="100%">
                                                                                                                    <tr>
                                                                                                                        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
                                                                                                                                <tr>
                                                                                                                                    <td><table border="0" style="border: ridge 1 px; width: 100%">
                                                                                                                                            <tr>
    <?php
    for ($y = 0; $y < count($def_options); ++$y) {
        $optTag   = sprintf("def_option_%d_%d", $y, $id);
        $checkTag = sprintf("def_option_%d", $y);
        $checked  = ($defaultTags[$checkTag]) ? 'checked' : '';
        ?>
                                                                                                                                                    <td align="left" width="10" title="<?php echo $defaultPopup[$y]; ?>" class="popup"><?php echo tep_draw_checkbox_field($optTag,
            '', $checked, '');
        ?> </td>
                                                                                                                                                    <td class="smallText" width="90" title="<?php echo $defaultPopup[$y]; ?>" class="popup"><?php echo $def_options[$y]; ?></td>
        <?php
        if ($y < 2) {
            if ($y == 1) {
                echo '</tr><tr>';
            }
        } else if ((($y - 1) % 2 == 0)) { //break on each three
            echo '</tr><tr>';
        }
    }
    ?>
                                                                                                                                            </tr>
                                                                                                                                        </table></td>
                                                                                                                                </tr>
                                                                                                                            </table></td>
                                                                                                                    </tr>                   
                                                                                                                </table></td>
                                                                                                        </tr>              
                                                                                                    </table></td>                   
                                                                                            </tr>  
                                                                                        </table></td>
                                                                                </tr>
<?php } ?>
                                                                            <tr>
                                                                                <td><table border="2" width="100%">
                                                                                        <tr>
                                                                                            <td><table border="0" width="100%" class="infoBoxContent">
                                                                                                    <tr>
                                                                                                        <th class="smallText" style="background-color: #f0f1f1; text-align: center;"><?php echo HEADING_TITLE_SEO_DEFAULT_META_TAGS; ?></th>
                                                                                                    </tr> 
                                                                                                </table></td>
                                                                                        </tr>              
                                                                                        <tr>            
                                                                                            <td><table border="0" width="100%">               
                                                                                                    <tr>
                                                                                                        <td class="smallText"><table border="0" width="100%">
                                                                                                                <tr>
<?php
$defaultTags_query = tep_db_query("select meta_google as meta_0, meta_language as meta_1, meta_noodp as meta_2, meta_noydir as meta_3, meta_replyto as meta_4, meta_revisit as meta_5, meta_robots as meta_6, meta_unspam as meta_7, meta_canonical as meta_8, meta_og as meta_9 from ".TABLE_HEADERTAGS_DEFAULT." LIMIT 1");
$defaultTags       = tep_db_fetch_array($defaultTags_query);
for ($y = 0; $y < count($metaTags); ++$y) {
    $optTag  = sprintf("meta_%d", $y);
    $checked = ($defaultTags[$optTag]) ? 'checked' : '';
    ?>
                                                                                                                        <td align="left" title="<?php echo $metatagsPopup[$y]; ?>" class="popup"><?php echo tep_draw_checkbox_field('metatags_'.$y,
        '', $checked, '');
    ?> </td>
                                                                                                                        <td class="smallText" width="90" title="<?php echo $metatagsPopup[$y]; ?>" class="popup"><?php echo $metaTags[$y]; ?></td>
    <?php
    if ($y < 3) {
        if ($y == 2) {
            echo '</tr><tr>';
        }
    } else if ((($y - 2) % 3 == 0)) { //break on each three
        echo '</tr><tr>';
    }
}
?>
                                                                                                                </tr>
                                                                                                            </table></td>
                                                                                                    </tr>                                          
                                                                                                </table></td>
                                                                                        </tr>         
                                                                                    </table></td>
                                                                            </tr>                       
                                                                            <tr>
                                                                                <td><?php echo tep_draw_separator('pixel_trans.gif',
    '100%', '10');
?></td>
                                                                            </tr>
                                                                            <tr> 
                                                                                <td class="smallText" align="center"><INPUT type="image" src="<?php echo DIR_WS_LANGUAGES.$language.'/images/buttons/button_update.gif'; ?>" NAME="update_default_section"></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td><?php echo tep_black_line(); ?></td>
                                                                            </tr>          
                                                                        </table></td>
                                                                </tr> 
                                                            </table></td>
                                                    </tr>
                                                    </form>  
                                                </table></td>
                                        </tr>

                                        <tr>
                                            <td align="right" width="40%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
<?php
echo tep_draw_form('header_tags_pseudo', FILENAME_HEADER_TAGS_SEO, '', 'post').tep_draw_hidden_field('action',
    'default');
?>
                                                    <tr>
                                                        <td valign="top" width="100%"><table width="100%" border="2">             
                                                                <tr>
                                                                    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="0">
                                                                            <!-- BEGIN PSEUDO CODE -->      
                                                                            <tr>
                                                                                <td><table border="2" width="100%">
                                                                                        <tr>
                                                                                            <td><table border="0" width="100%" class="infoBoxContent">
                                                                                                    <tr>
                                                                                                        <th class="smallText" style="background-color: #f0f1f1; text-align: center;"><?php echo HEADING_TITLE_SEO_PSEUDO; ?></th>
                                                                                                    </tr> 
                                                                                                </table></td>
                                                                                        </tr>              
                                                                                        <tr>            
                                                                                            <td><table border="0" width="100%" cellpadding="0">               
                                                                                                    <tr>
                                                                                                        <td class="smallText"><table border="1" width="100%">
                                                                                                                <tr>
                                                                                                                    <td class="smallText" colspan="2"><?php echo TEXT_PSEUDO_PAGE_NAME_NOTE; ?></td>
                                                                                                                </tr>                
                                                                                                                <tr>
                                                                                                                    <td class="smallText" width="27%" style="font-weight: bold;"><?php echo TEXT_PSEUDO_PAGE_NAME; ?></td>
                                                                                                                    <td class="smallText" title="<?php echo $commonPopup['pseudo_add']; ?>" class="popup" ><input type="text" name="pseudo_page_name" maxlength="255" size="34"></td>
                                                                                                                </tr>
                                                                                                            </table></td>
                                                                                                    <tr>
                                                                                                </table></td>
                                                                                        </tr>         
                                                                                    </table></td>
                                                                            </tr>                       
                                                                            <tr>
                                                                                <td><?php echo tep_draw_separator('pixel_trans.gif',
    '100%', '10');
?></td>
                                                                            </tr>
                                                                            <tr> 
                                                                                <td class="smallText" align="center"><INPUT type="image" src="<?php echo DIR_WS_LANGUAGES.$language.'/images/buttons/button_update.gif'; ?>" NAME="add_pseudo_page"></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td><?php echo tep_black_line(); ?></td>
                                                                            </tr>          
                                                                        </table></td>
                                                                </tr> 
                                                            </table></td>
                                                    </tr>  
                                                </table></td>
                                        </tr>         


                                        </form>
                                        <!-- end right column -->    
                            </tr>
                        </table></td> 
                </tr>
                <!-- end of Header Tags -->
            </table></td>
    </tr>
</table>

<?php
require(DIR_WS_INCLUDES.'template_bottom.php');
require(DIR_WS_INCLUDES.'application_bottom.php');
?>
