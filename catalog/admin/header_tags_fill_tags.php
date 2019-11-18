<?php
/*
  $Id: header_tags_fill_tags.php,v 1.0 2005/08/25
  Originally Created by: Jack York - http://www.oscommerce-solution.com
  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce
  Portions Copyright 2009 oscommerce-solution.com

  Released under the GNU General Public License
 */

require('includes/application_top.php');
require(DIR_WS_LANGUAGES.$language.'/'.FILENAME_HEADER_TAGS_SEO);
require_once('includes/functions/header_tags.php');

$bottomOfPage        = 0; //don't use false fue to jquery call
$checkedCats         = array();
$checkedManuf        = array();
$checkedProds        = array();
$checkedMetaDesc     = array('yes' => '', 'no' => 'checked');
$checkedMetaKeywords = array('yes' => '', 'no' => 'checked');
$fillTagsCtr         = array();
$fillTagsErrors      = array();
$filltagsPopup       = '';
$languageID          = 99;
$languages           = tep_get_languages();
$listLength          = 20;
$sleep_ctr           = 0;
$sleep_interval      = '';
$sleep_start_ctr     = 0;
$sleep_total         = 0;
$updateDB            = false;
$updateTextCat       = '';
$updateTextManuf     = '';
$updateTextProd      = '';

$filltagsPopup = array();
if (HEADER_TAGS_DISPLAY_HELP_POPUPS) {
    $filltagsPopup = GetPopupText('filltags');
}

/* * **************** READ IN FORM DATA ***************** */
if (isset($_POST['action'])) {
    $categories_fill        = $_POST['group1'];
    $manufacturers_fill     = $_POST['group2'];
    $products_fill          = $_POST['group3'];
    $productsMetaDesc       = $_POST['group4'];
    $productsMetaKeywords   = $_POST['group5'];
    $productsMetaDescLength = $_POST['fillMetaDescrlength'];
    $languageID             = (int) substr($_POST['language_group'],
            (strpos($_POST['language_group'], '_') + 1)); //get the selected language or all
    $sleep                  = (isset($_POST['enable_sleep']) ? true : false);
    $sleep_start_ctr        = ($sleep && isset($_POST['sleep_start_ctr']) ? (int) $_POST['sleep_start_ctr']
            : 0);
    $sleep_interval         = ($sleep && isset($_POST['enable_sleep_interval']) ? (int) $_POST['enable_sleep_interval']
            : '');
    $sleep_total            = ($sleep && isset($_POST['sleep_total']) ? (int) $_POST['sleep_total']
            : '');
    $startLang              = ($languageID == 99 ? 0 : $languageID - 1);              //what language to begin with
    $stopLang               = ($languageID == 99 ? GetHighestLanguageID($languages)
            : $languageID); //what language to end with

    /*     * **************** FILL THE CATEGORIES ***************** */
    if (isset($categories_fill)) {
        $addComma                  = '';
        $set                       = '';
        $fillTagsCtr['categories'] = 0;

        if ($categories_fill == 'none') {
            $checkedCats['none'] = 'Checked';
        } else {
            $byCatID = ''; //filter by category
            if (isset($_POST['catfiles']) && $_POST['catfiles'][0] !== TEXT_FILTER_LIST_SELECT_ALL) { //at least one category was selected
                $byCatID = ' ( ';
                foreach ($_POST['catfiles'] as $cat) { //build the search string
                    if (strlen($byCatID) != 3) {
                        $byCatID .= ' or ';
                    }
                    $byCatID .= ' categories_id = '.$cat;
                }
                $byCatID .= ' ) and ';
            }

            $item_ctr = 0;

            for ($i = $startLang; $i <= $stopLang; $i++) {
                $idPos = '';
                if (($idPos = IsValidLanguage($i, $languages)) === FALSE) { //otherwise it is an invlaid ID
                    continue;
                }

                $categories_tags_query = tep_db_query("select categories_name, categories_id, categories_htc_title_tag, categories_htc_desc_tag, categories_htc_keywords_tag, language_id from  ".TABLE_CATEGORIES_DESCRIPTION." where ".$byCatID." language_id = '".(int) $languages[$idPos]['id']."'");
                while ($categories_tags       = tep_db_fetch_array($categories_tags_query)) {
                    $updateDB = false;

                    if ($sleep && $sleep_interval) {
                        if ($sleep_ctr >= $sleep_interval && $sleep_ctr !== 0) {
                            break;
                        } else if ($item_ctr < $sleep_start_ctr) {
                            $item_ctr++;
                            continue;
                        } else {
                            $item_ctr++;
                            $sleep_ctr++;
                            $sleep_total++;
                        }
                        $sleep_start_ctr = $item_ctr;
                    }

                    switch ($categories_fill) {
                        case 'empty':
                            if (!tep_not_null($categories_tags['categories_htc_title_tag'])
                                || !tep_not_null($categories_tags['categories_htc_desc_tag'])
                                || !tep_not_null($categories_tags['categories_htc_keywords_tag'])) {
                                $updateDB      = true;
                                $updateTextCat = TEXT_FILL_CATEGORIES_EMPTY;
                            }
                            $checkedCats['empty'] = 'Checked';
                            break;

                        case 'full':
                            $updateDB            = true;
                            $updateTextCat       = TEXT_FILL_CATEGORIES_FULL;
                            $checkedCats['full'] = 'Checked';
                            break;

                        default:      //assume clear all
                            tep_db_query("update ".TABLE_CATEGORIES_DESCRIPTION." set categories_htc_title_tag='', categories_htc_desc_tag = '', categories_htc_keywords_tag = '' where categories_id = '".$categories_tags['categories_id']."' and language_id  = '".(int) $languages[$idPos]['id']."'");
                            $updateTextCat        = TEXT_FILL_CATEGORIES_CLEAR;
                            $checkedCats['clear'] = 'Checked';
                            $checkedMetaDesc      = array('yes' => '', 'no' => 'checked');
                            $checkedMetaKeywords  = array('yes' => '', 'no' => 'checked');
                            $fillTagsCtr['categories'] ++;
                            break;
                    }

                    if ($updateDB) {
                        if (isset($_POST['generic_enabled']) && $_POST['generic_enabled']
                            == 'on') {
                            $addComma = '';
                            $set      = ' set ';

                            $set = BuildGenericString($set, $addComma,
                                'categories_htc_title_tag',
                                $categories_tags['categories_name'],
                                $_POST['add_generic_cat_title'],
                                tep_db_prepare_input($_POST['generic_cat_title']));
                            $set = BuildGenericString($set, $addComma,
                                'categories_htc_desc_tag',
                                $categories_tags['categories_name'],
                                $_POST['add_generic_cat_meta_desc'],
                                tep_db_prepare_input($_POST['generic_cat_meta_desc']));
                            $set = BuildGenericString($set, $addComma,
                                'categories_htc_keywords_tag',
                                $categories_tags['categories_name'],
                                $_POST['add_generic_cat_keywords'],
                                tep_db_prepare_input($_POST['generic_cat_keywords']));
                            $set = BuildGenericString($set, $addComma,
                                'categories_htc_description',
                                $categories_tags['categories_name'],
                                $_POST['add_generic_cat_description'],
                                tep_db_prepare_input($_POST['generic_cat_description']));
                        }

                        if (!empty($categories_tags['categories_name'])) {
                            if (empty($addComma)) {
                                tep_db_query("update ".TABLE_CATEGORIES_DESCRIPTION." set categories_htc_title_tag='".addslashes(strip_tags($categories_tags['categories_name']))."', categories_htc_desc_tag = '".addslashes($categories_tags['categories_name'])."', categories_htc_keywords_tag = '".addslashes(strip_tags($categories_tags['categories_name']))."' where categories_id = '".$categories_tags['categories_id']."' and language_id  = '".(int) $languages[$idPos]['id']."'");
                            } else { //generic option was used  
                                tep_db_query("update ".TABLE_CATEGORIES_DESCRIPTION.$set." where categories_id = '".$categories_tags['categories_id']."' and language_id  = '".(int) $languages[$idPos]['id']."'");
                            }
                            $fillTagsCtr['categories'] ++;
                        } else {
                            $fillTagsErrors['categories'][] = '<a class="htc_Link" href="'.tep_href_link(FILENAME_CATEGORIES,
                                    'cID='.$categories_tags['categories_id']).'&action=edit_category">'.sprintf(ERROR_FILL_TAGS_CATEGORIES,
                                    $categories_tags['categories_id'],
                                    $languages[$idPos]['id'].' ( '.$languages[$idPos]['name'].' ) ').'</a>';
                        }
                    }
                }
            }
            if ($fillTagsCtr['categories'] == 0 && count($fillTagsErrors['categories'])
                == 0) {
                $fillTagsCtr['categories'] = TEXT_NO;
                $updateTextCat             = TEXT_FILL_CATEGORIES_FULL;
            }

            if (HEADER_TAGS_ENABLE_CACHE != 'None') {
                ResetCache_HeaderTags('index.php', 'c_', true);
            }
        }
    } else {
        $checkedCats['none'] = 'Checked';
    }

    /*     * **************** FILL THE MANUFACTURERS ***************** */

    if (isset($manufacturers_fill)) {
        $addComma                     = '';
        $set                          = '';
        $fillTagsCtr['manufacturers'] = 0;

        if ($manufacturers_fill == 'none') {
            $checkedManuf['none'] = 'Checked';
        } else {
            $item_ctr = 0;

            for ($i = $startLang; $i <= $stopLang; $i++) {
                $idPos = '';
                if (($idPos = IsValidLanguage($i, $languages)) === FALSE) { //otherwise it is an invlaid ID
                    continue;
                }

                $manufacturers_tags_query = tep_db_query("select m.manufacturers_name, m.manufacturers_id, mi.languages_id, mi.manufacturers_htc_title_tag, mi.manufacturers_htc_desc_tag, mi.manufacturers_htc_keywords_tag from ".TABLE_MANUFACTURERS." m left join ".TABLE_MANUFACTURERS_INFO." mi on (m.manufacturers_id = mi.manufacturers_id) where mi.languages_id = '".(int) $languages[$idPos]['id']."'");
                while ($manufacturers_tags       = tep_db_fetch_array($manufacturers_tags_query)) {
                    $updateDB = false;

                    if ($sleep && $sleep_interval) {
                        if ($sleep_ctr >= $sleep_interval && $sleep_ctr !== 0) {
                            break;
                        } else if ($item_ctr < $sleep_start_ctr) {
                            $item_ctr++;
                            continue;
                        } else {
                            $item_ctr++;
                            $sleep_ctr++;
                            $sleep_total++;
                        }
                        $sleep_start_ctr = $item_ctr;
                    }


                    switch ($manufacturers_fill) {
                        case 'empty':
                            if (!tep_not_null($manufacturers_tags['manufacturers_htc_title_tag'])
                                || !tep_not_null($manufacturers_tags['manufacturers_htc_desc_tag'])
                                || !tep_not_null($manufacturers_tags['manufacturers_htc_keywords_tag'])) {
                                $updateDB        = true;
                                $updateTextManuf = TEXT_FILL_MANUFACTURERS_EMPTY;
                            }
                            $checkedManuf['empty'] = 'Checked';
                            break;

                        case 'full':
                            $updateDB             = true;
                            $updateTextManuf      = TEXT_FILL_MANUFACTURERS_FULL;
                            $checkedManuf['full'] = 'Checked';
                            break;

                        default:      //assume clear all
                            tep_db_query("update ".TABLE_MANUFACTURERS_INFO." set manufacturers_htc_title_tag='', manufacturers_htc_desc_tag = '', manufacturers_htc_keywords_tag = '' where manufacturers_id = '".$manufacturers_tags['manufacturers_id']."' and languages_id  = '".(int) $languages[$idPos]['id']."'");
                            $updateTextManuf       = TEXT_FILL_MANUFACTURERS_CLEAR;
                            $checkedManuf['clear'] = 'Checked';
                            $checkedMetaDesc       = array('yes' => '', 'no' => 'checked');
                            $checkedMetaKeywords   = array('yes' => '', 'no' => 'checked');
                            $fillTagsCtr['manufacturers'] ++;
                            break;
                    }

                    if ($updateDB) {
                        if (isset($_POST['generic_enabled']) && $_POST['generic_enabled']
                            == 'on') {
                            $addComma = '';
                            $set      = ' set ';

                            $set = BuildGenericString($set, $addComma,
                                'manufacturers_htc_title_tag',
                                $manufacturers_tags['manufacturers_name'],
                                $_POST['add_generic_man_title'],
                                tep_db_prepare_input($_POST['generic_man_title']));
                            $set = BuildGenericString($set, $addComma,
                                'manufacturers_htc_desc_tag',
                                $manufacturers_tags['manufacturers_name'],
                                $_POST['add_generic_man_meta_desc'],
                                tep_db_prepare_input($_POST['generic_man_meta_desc']));
                            $set = BuildGenericString($set, $addComma,
                                'manufacturers_htc_keywords_tag',
                                $manufacturers_tags['manufacturers_name'],
                                $_POST['add_generic_man_keywords'],
                                tep_db_prepare_input($_POST['generic_man_keywords']));
                            $set = BuildGenericString($set, $addComma,
                                'manufacturers_htc_description',
                                $manufacturers_tags['manufacturers_name'],
                                $_POST['add_generic_man_description'],
                                tep_db_prepare_input($_POST['generic_man_description']));
                        }

                        if (!empty($manufacturers_tags['manufacturers_name'])) {
                            if (empty($addComma)) {
                                tep_db_query("update ".TABLE_MANUFACTURERS_INFO." set manufacturers_htc_title_tag='".addslashes(strip_tags($manufacturers_tags['manufacturers_name']))."', manufacturers_htc_desc_tag = '".addslashes($manufacturers_tags['manufacturers_name'])."', manufacturers_htc_keywords_tag = '".addslashes(strip_tags($manufacturers_tags['manufacturers_name']))."' where manufacturers_id = '".$manufacturers_tags['manufacturers_id']."' and languages_id  = '".(int) $languages[$idPos]['id']."'");
                            } else { //generic option was used  
                                tep_db_query("update ".TABLE_MANUFACTURERS_INFO.$set." where manufacturers_id = '".$manufacturers_tags['manufacturers_id']."' and languages_id  = '".(int) $languages[$idPos]['id']."'");
                            }
                            $fillTagsCtr['manufacturers'] ++;
                        } else {
                            $fillTagsErrors['manufacturers'][] = '<a class="htc_Link" href="'.tep_href_link(FILENAME_MANUFACTURERS,
                                    'mID='.$manufacturers_tags['manufacturers_id']).'&action=edit_category">'.sprintf(ERROR_FILL_TAGS_MANUFACTURERS,
                                    $manufacturers_tags['manufacturers_id'],
                                    $languages[$idPos]['id'].' ( '.$languages[$idPos]['name'].' ) ').'</a>';
                        }
                    }
                }
            }

            if ($fillTagsCtr['manufacturers'] == 0 && count($fillTagsErrors['manufacturers'])
                == 0) {
                $fillTagsCtr['manufacturers'] = TEXT_NO;
                ;
                $updateTextManuf              = TEXT_FILL_MANUFACTURERS_FULL;
            }

            if (HEADER_TAGS_ENABLE_CACHE != 'None') {
                ResetCache_HeaderTags('index.php', 'm_', true);
            }
        }
    } else {
        $checkedManuf['none'] = 'Checked';
    }

    /*     * **************** FILL THE PRODUCTS ***************** */

    if (isset($products_fill)) {
        $addComma                = '';
        $set                     = '';
        $fillTagsCtr['products'] = 0;

        if ($products_fill == 'none') {
            $checkedProds['none'] = 'Checked';
        } else {
            $item_ctr = 0;

            for ($i = $startLang; $i <= $stopLang; $i++) {
                $idPos = '';
                if (($idPos = IsValidLanguage($i, $languages)) === FALSE) { //otherwise it is an invlaid ID
                    continue;
                }
                $products_tags_query = tep_db_query("select products_name, products_description, products_id, products_head_title_tag, products_head_desc_tag, products_head_keywords_tag, language_id from ".TABLE_PRODUCTS_DESCRIPTION." where language_id = '".(int) $languages[$idPos]['id']."'");

                while ($products_tags = tep_db_fetch_array($products_tags_query)) {
                    $updateDB = false;

                    if ($sleep && $sleep_interval) {
                        if ($sleep_ctr >= $sleep_interval && $sleep_ctr !== 0) {
                            break;
                        } else if ($item_ctr < $sleep_start_ctr) {
                            $item_ctr++;
                            continue;
                        } else {
                            $item_ctr++;
                            $sleep_ctr++;
                            $sleep_total++;
                        }
                        $sleep_start_ctr = $item_ctr;
                    }

                    switch ($products_fill) {
                        case 'empty':

                            if (!tep_not_null($products_tags['products_head_title_tag'])
                                || !tep_not_null($products_tags['products_head_desc_tag'])
                                || !tep_not_null($products_tags['products_head_keywords_tag'])) {
                                $updateDB       = true;
                                $updateTextProd = TEXT_FILL_PRODUCTS_EMPTY;
                            }
                            $checkedProds['empty'] = 'Checked';
                            break;

                        case 'full':
                            $updateDB             = true;
                            $updateTextProd       = TEXT_FILL_PRODUCTS_FULL;
                            $checkedProds['full'] = 'Checked';
                            break;

                        default:      //assume clear all
                            tep_db_query("update ".TABLE_PRODUCTS_DESCRIPTION." set products_head_title_tag='', products_head_desc_tag = '', products_head_keywords_tag =  '' where products_id = '".$products_tags['products_id']."' and language_id='".(int) $languages[$idPos]['id']."'");
                            $updateTextProd        = TEXT_FILL_PRODUCTS_CLEAR;
                            $checkedProds['clear'] = 'Checked';
                            $checkedMetaDesc       = array('yes' => '', 'no' => 'checked');
                            $checkedMetaKeywords   = array('yes' => '', 'no' => 'checked');
                            $fillTagsCtr['products'] ++;
                            break;
                    }

                    if ($updateDB) {
                        /*                         * ********************** FILL THE DESCRIPTION ********************* */
                        if ($productsMetaDesc == 'fillMetaDesc_yes') {        //fill the description with all or part of the product description 
                            if (!empty($products_tags['products_description'])) {
                                if (isset($productsMetaDescLength) && (int) $productsMetaDescLength
                                    > 3 && (int) $productsMetaDescLength < strlen($products_tags['products_description'])) {
                                    $desc = substr($products_tags['products_description'],
                                        0, (int) $productsMetaDescLength);
                                } else {                                              //length not entered or too small    
                                    $desc = $products_tags['products_description']; //so use the whole description
                                }
                            } else {
                                $desc = $products_tags['products_name'];
                            }
                        } else if (isset($_POST['generic_enabled']) && $_POST['generic_enabled']
                            == 'on') {
                            $addComma = '';
                            $set      = ' set ';

                            $set = BuildGenericString($set, $addComma,
                                'products_head_title_tag',
                                $products_tags['products_name'],
                                $_POST['add_generic_prod_title'],
                                tep_db_prepare_input($_POST['generic_prod_title']));
                            $set = BuildGenericString($set, $addComma,
                                'products_head_desc_tag',
                                $products_tags['products_name'],
                                $_POST['add_generic_prod_meta_desc'],
                                tep_db_prepare_input($_POST['generic_prod_meta_desc']));
                            $set = BuildGenericString($set, $addComma,
                                'products_head_keywords_tag',
                                $products_tags['products_name'],
                                $_POST['add_generic_prod_keywords'],
                                tep_db_prepare_input($_POST['generic_prod_keywords']));
                        } else {
                            $desc = $products_tags['products_name'];
                        }

                        /*                         * ********************** FILL THE KEYWORDS ********************* */
                        if ($productsMetaKeywords == 'fillMetaKeywords_yes') { //fill the keywords from those found on the page 
                            $pageName   = 'product_info.php'.'?products_id='.$products_tags['products_id'].'&language='.$languages[$idPos]['code'];
                            $keywordStr = GetKeywordsFromSite($pageName); //get the keywords from the page

                            if (strpos($keywordStr, "Failed") !== FALSE) {
                                $messageStack->add($keywordStr, 'failure');
                                $keywords = $products_tags['products_name'];  //fill in for default         
                            } else {
                                $keywords = (tep_not_null($keywordStr)) ? $keywordStr
                                        : $products_tags['products_name'];
                            }
                        } else {
                            $keywords = $products_tags['products_name'];
                        }

                        if (!empty($products_tags['products_name'])) {
                            if (empty($addComma)) {
                                tep_db_query("update ".TABLE_PRODUCTS_DESCRIPTION." set products_head_title_tag='".addslashes(strip_tags($products_tags['products_name']))."', products_head_desc_tag = '".addslashes(strip_tags($desc))."', products_head_keywords_tag =  '".addslashes(strip_tags($products_tags['products_name']))."' where products_id = '".$products_tags['products_id']."' and language_id='".(int) $languages[$idPos]['id']."'");
                            } else {//generic option was used  
                                tep_db_query("update ".TABLE_PRODUCTS_DESCRIPTION.$set." where products_id = '".$products_tags['products_id']."' and language_id='".(int) $languages[$idPos]['id']."'");
                            }
                            $fillTagsCtr['products'] ++;
                        } else {
                            $fillTagsErrors['products'][] = '<a class="htc_Link" href="'.tep_href_link(FILENAME_CATEGORIES,
                                    'pID='.$products_tags['products_id']).'&action=new_product">'.sprintf(ERROR_FILL_TAGS_PRODUCTS,
                                    $products_tags['products_id'],
                                    $languages[$idPos]['id'].' ( '.$languages[$idPos]['name'].' ) ').'</a>';
                        }
                    }
                }
            }

            $checkedMetaDesc     = ($productsMetaDesc == 'fillMetaDesc_yes') ? array(
                'yes' => 'checked', 'no' => '') : array('yes' => '', 'no' => 'checked');
            $checkedMetaKeywords = ($productsMetaKeywords == 'fillMetaKeywords_yes')
                    ? array('yes' => 'checked', 'no' => '') : array('yes' => '',
                'no' => 'checked');

            if ($fillTagsCtr['products'] == 0 && count($fillTagsErrors['products'])
                == 0) {
                $fillTagsCtr['products'] = TEXT_NO;
                ;
                $updateTextProd          = TEXT_FILL_PRODUCTS_FULL;
            }

            if (HEADER_TAGS_ENABLE_CACHE != 'None') {
                ResetCache_HeaderTags('product_info.php', 'p_', true);
            }
        }
    } else {
        $checkedProds['none'] = 'Checked';
        $checkedMetaDesc      = array('yes' => '', 'no' => 'checked');
        $checkedMetaKeywords  = array('yes' => '', 'no' => 'checked');
    }

    if (tep_not_null($fillTagsErrors)) {
        $bottomOfPage = 1;
    }
}

$missingTags = '';
if (isset($_POST['show_missing_tags']) && $_POST['show_missing_tags'] == 'on') {
    $checkDesc   = (isset($_POST['include_missing_description']) && $_POST['include_missing_description']
        == 'on') ? true : false;
    $missingTags = CheckForMissingTags(true, $checkDesc);
}
require(DIR_WS_INCLUDES.'template_top.php');
?>
<style type="text/css">
    td.HTC_Head {font-family: Verdana, Arial, sans-serif; color: sienna; font-size: 18px; font-weight: bold; } 
    td.HTC_subHead {font-family:verdana, arial, sans-serif; color:#3a3a3a; font-size: 12px; } 
    td.HTC_title {font-family: Verdana, Arial, sans-serif; color: sienna; background: #f0f1f1; font-size: 14px; font-weight: bold; text-align: center;}
    table.HTC_Box {border-width: 2px; border-style: ridge; border-color: gray; border-collapse: separate; background-color: white; } 
    .htc_Link  {font-family: Verdana, Arial, sans-serif; color: sienna; font-size: 10px; } 
    A.htc_Link  {color:blue; }
    A.htc_Link:hover {color:sienna } 
</style>

    <script type="text/javascript"> <!--
$(document).ready(function () {
            var show = <?php echo $bottomOfPage; ?>;
            if (show) {
                $('html, body').animate({
                    scrollTop: $("#errors").offset().top
                }, 2000);
            }
        });
        function EnableGenericCheckBoxes() { //enable all of the checkboxes
            if (document.header_tags.generic_enabled.checked === true) {
                document.header_tags.add_generic_cat_title.disabled = '';
                document.header_tags.add_generic_cat_meta_desc.disabled = '';
                document.header_tags.add_generic_cat_keywords.disabled = '';
                document.header_tags.add_generic_cat_description.disabled = '';
                document.header_tags.add_generic_cat_filterlist.disabled = '';
                document.header_tags.add_generic_man_title.disabled = '';
                document.header_tags.add_generic_man_meta_desc.disabled = '';
                document.header_tags.add_generic_man_keywords.disabled = '';
                document.header_tags.add_generic_man_description.disabled = '';
                document.header_tags.add_generic_prod_title.disabled = '';
                document.header_tags.add_generic_prod_meta_desc.disabled = '';
                document.header_tags.add_generic_prod_keywords.disabled = '';
            } else {
                document.header_tags.add_generic_cat_title.disabled = 'disabled';
                document.header_tags.add_generic_cat_meta_desc.disabled = 'disabled';
                document.header_tags.add_generic_cat_keywords.disabled = 'disabled';
                document.header_tags.add_generic_cat_description.disabled = 'disabled';
                document.header_tags.add_generic_cat_filterlist.disabled = 'disabled';
                document.header_tags.add_generic_man_title.disabled = 'disabled';
                document.header_tags.add_generic_man_meta_desc.disabled = 'disabled';
                document.header_tags.add_generic_man_keywords.disabled = 'disabled';
                document.header_tags.add_generic_man_description.disabled = 'disabled';
                document.header_tags.add_generic_prod_title.disabled = 'disabled';
                document.header_tags.add_generic_prod_meta_desc.disabled = 'disabled';
                document.header_tags.add_generic_prod_keywords.disabled = 'disabled';
            }
        }
        function EnableGeneric(box, ctrl) { //enable the input for each checkbox
            if (box.checked === false)
                ctrl.disabled = 'disabled';
            else
                ctrl.disabled = '';
        }

        function popupWindow(url) {
            window.open(url, 'popupWindow', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,copyhistory=no,width=800,height=800,screenX=150,screenY=150,top=15,left=15')
        }

        function ChangeIntervalState() {
            var state = document.header_tags.enable_sleep.checked;

            if (state === true) {
                document.header_tags.enable_sleep_interval.disabled = '';
            } else {
                document.header_tags.enable_sleep_interval.disabled = 'disabled';
            }
        }
//--></script>
        <table border="0" width="100%" cellspacing="2" cellpadding="2">
                <tr>
                    <td width="<?php echo cfg('BOX_WIDTH'); ?>" valign="top"><table border="0" width="<?php echo cfg('BOX_WIDTH'); ?>" cellspacing="1" cellpadding="1" class="columnLeft">
                            <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td class="HTC_Head"><?php echo HEADING_TITLE_FILL_TAGS; ?></td>
                                    </tr>
                                    <tr>
                                        <td><?php
                                            echo tep_draw_separator('pixel_trans.gif',
                                                '100%', '10');
                                            ?></td>
                                    </tr>
                                    <tr>
                                        <td class="HTC_subHead"><?php
                                            echo sprintf(TEXT_FILL_TAGS,
                                                sprintf(TEXT_SHOW_POPUP,
                                                    'TEXT_EXPLAIN_SLEEP'));
                                            ?></td>
                                    </tr>

                                    <!-- Begin of Header Tags -->      

                                    <tr>
                                        <td align="right"><?php
                                            echo tep_draw_form('header_tags',
                                                FILENAME_HEADER_TAGS_FILL_TAGS,
                                                '', 'post').tep_draw_hidden_field('action',
                                                'process');
                                            ?></td>
                                    <tr>
                                        <td><?php
                                            echo tep_draw_separator('pixel_trans.gif',
                                                '100%', '10');
                                            ?></td>
                                    </tr>

                                    <tr>
                                        <td><table border="1" class="HTC_Box" cellpadding="0">
                                                <tr> 
                                                    <td colspan="3" class="HTC_title"><?php echo HEADING_TITLE_FILL_TAGS_OVERRIDES; ?></td>
                                                </tr> 

                                                <tr>
                                                    <td width="55%"><table border="0" width="100%" cellpadding="0">    
                                                            <tr>
                                                                <td width="50%"><table border="1" width="100%" cellpadding="0">
                                                                        <tr>
                                                                            <td valign="top"><table border="0" width="100%" cellpadding="0">
                                                                                    <tr style="background-color:#FAF8CC">
                                                                                        <td class="main" align="center" style="font-weight:bold;"><?php echo TEXT_OVERRIDE_DESCRIPTION.sprintf(TEXT_SHOW_POPUP,
                                                'TEXT_OVERRIDE_DESCRIPTION');
                                            ?></td>     
                                                                                    </tr> 
                                                                                    <tr class="main"> 
                                                                                        <td colspan="3"><?php echo TEXT_FILL_WITH_DESCIPTION; ?></td>
                                                                                    </tr> 
                                                                                    <tr> 
                                                                                        <td width="100%"><table border="0" width="65%"> 
                                                                                                <tr class="main">
                                                                                                    <td align=left title="<?php echo $filltagsPopup['filldesc_yes']; ?>" class="popup"><INPUT TYPE="radio" NAME="group4" VALUE="fillMetaDesc_yes"<?php echo $checkedMetaDesc['yes']; ?>> <?php echo TEXT_YES; ?>&nbsp;</td>
                                                                                                    <td align=left title="<?php echo $filltagsPopup['filldesc_no']; ?>" class="popup"><INPUT TYPE="radio" NAME="group4" VALUE="fillmetaDesc_no"<?php echo $checkedMetaDesc['no']; ?>>&nbsp;<?php echo TEXT_NO; ?></td>
                                                                                                    <td align="right" class="main" title="<?php echo $filltagsPopup['filldesc_size']; ?>" class="popup"><?php
                                            echo TEXT_LIMIT_TO.'&nbsp;'.tep_draw_input_field('fillMetaDescrlength',
                                                '', 'maxlength="255", size="5"',
                                                false).'&nbsp;'.TEXT_CHARACTERS;
                                            ?> </td>
                                                                                                </tr>
                                                                                            </table></td> 
                                                                                    </tr>
                                                                                </table></td>           

                                                                            <td width="50%" valign="top"><table border="0" width="100%" >
                                                                                    <tr style="background-color:#FAF8CC">
                                                                                        <td class="main" align="center" style="font-weight:bold;"><?php echo TEXT_OVERRIDE_KEYWORDS.sprintf(TEXT_SHOW_POPUP,
                                                'TEXT_OVERRIDE_KEYWORDS');
                                            ?></td>
                                                                                    </tr>               

                                                                                    <tr class="main"> 
                                                                                        <td colspan="3"><?php echo TEXT_FILL_KEYWORDS_FROM_SHOP; ?></td>
                                                                                    </tr> 
                                                                                    <tr>
                                                                                        <td width="100%"><table border="0" width="24%"> 
                                                                                                <tr class="main">         
                                                                                                    <td align=left title="<?php echo $filltagsPopup['fillkeywords_yes']; ?>" class="popup"><INPUT TYPE="radio" NAME="group5" VALUE="fillMetaKeywords_yes"<?php echo $checkedMetaKeywords['yes']; ?>> <?php echo TEXT_YES; ?>&nbsp;</td>
                                                                                                    <td align=left title="<?php echo $filltagsPopup['fillkeywords_no']; ?>" class="popup"><INPUT TYPE="radio" NAME="group5" VALUE="fillmetaKeywords_no"<?php echo $checkedMetaKeywords['no']; ?>>&nbsp;<?php echo TEXT_NO; ?></td>
                                                                                                </tr>
                                                                                            </table></td> 
                                                                                    </tr>  
                                                                                </table></td><tr>

                                                                    </table></td></tr>   

                                                            <tr><td colspan="3" width="100%" height="5"><?php echo tep_black_line(); ?></td></tr>

                                                            <tr><td class="main" align="center" style="font-weight: bold; background-color: #FAF8CC"><?php echo TEXT_OVERRIDE_GENERIC.sprintf(TEXT_SHOW_POPUP,
                                                'TEXT_OVERRIDE_GENERIC');
                                            ?></td></tr>               
                                                            <tr class="main"> 
                                                                <td><input type="checkbox" name="generic_enabled" onClick="return EnableGenericCheckBoxes()" ><?php echo TEXT_FILL_KEYWORDS_WITH_GENERIC; ?></td>
                                                            </tr> 
                                                            <tr>
                                                                <td width="100%"><table border="0" width="24%" class="HTC_Box"> 
                                                                        <tr><th class="main" align="center" colspan="3"><?php echo TEXT_FILL_GENERIC_SECTION_CATEGORIES; ?></th><tr>

                                                                            <?php
                                                                            $categoryFiles
                                                                                = array();
                                                                            $categoryFiles[]
                                                                                = array(
                                                                                'id' => TEXT_FILTER_LIST_SELECT_ALL,
                                                                                'text' => TEXT_FILTER_LIST_SELECT_ALL);
                                                                            $categoryFiles
                                                                                = tep_get_category_tree('',
                                                                                '',
                                                                                '',
                                                                                $categoryFiles);

                                                                            $selectedCats
                                                                                = array();
                                                                            if (isset($_POST['catfiles'])
                                                                                && $_POST['catfiles'][0]
                                                                                !== TEXT_FILTER_LIST_SELECT_ALL) { //at least one category was selected
                                                                                $pos
                                                                                    = 0;
                                                                                for ($c
                                                                                = 0; $c
                                                                                    < count($categoryFiles); ++$c) {
                                                                                    if (in_array($categoryFiles[$c]['id'],
                                                                                            $_POST['catfiles'])) {
                                                                                        $selectedCats[$pos]
                                                                                            = array(
                                                                                            'id' => $categoryFiles[$c]['id'],
                                                                                            'text' => $categoryFiles[$c]['text']);
                                                                                        $pos++;
                                                                                    }
                                                                                }
                                                                            }
                                                                            ?>
                                                                        <tr class="main"> 
                                                                            <td valign="top"><?php echo TEXT_FILTER_LIST_CATEGORY; ?><br><span class="smallText"><?php echo TEXT_FILTER_LIST_MULTI; ?></span></td>
                                                                            <td>&nbsp;</td>
                                                                            <td class="smallText"><?php
                                                                            echo SMMultiSelectMenu('catfiles[]',
                                                                                $categoryFiles,
                                                                                $selectedCats,
                                                                                ' disabled style="width: 345;" size='.$listLength.' id="add_generic_cat_filterlist"');
                                                                            ?></td>
                                                                        </tr> 

                                                                        <tr class="main"> 
                                                                            <td><?php echo TEXT_FILL_GENERIC_TITLE; ?></td>
                                                                            <td><input type="checkbox" name="add_generic_cat_title" disabled onClick="return EnableGeneric(this, this.form.generic_cat_title)"></td>
                                                                            <td class="main"><?php echo tep_draw_input_field('generic_cat_title',
                                                                                TEXT_GENERIC_TITLE,
                                                                                'maxlength="255" size="61" disabled',
                                                                                false);
                                                                            ?> </td>
                                                                        </tr>
                                                                        <tr class="main"> 
                                                                            <td><?php echo TEXT_FILL_GENERIC_META_DESC; ?></td>
                                                                            <td><input type="checkbox" name="add_generic_cat_meta_desc" disabled onClick="return EnableGeneric(this, this.form.generic_cat_meta_desc)"></td>
                                                                            <td class="main"><?php echo tep_draw_input_field('generic_cat_meta_desc',
                                                                                    TEXT_GENERIC_DESC,
                                                                                    'maxlength="255" size="61" disabled',
                                                                                    false);
                                                                            ?> </td>
                                                                        </tr>       
                                                                        <tr class="main"> 
                                                                            <td><?php echo TEXT_FILL_GENERIC_KEYWORDS; ?></td>
                                                                            <td><input type="checkbox" name="add_generic_cat_keywords" disabled onClick="return EnableGeneric(this, this.form.generic_cat_keywords)"></td>
                                                                            <td class="main"><?php echo tep_draw_input_field('generic_cat_keywords',
                                                                                    TEXT_GENERIC_KEYWORDS,
                                                                                    'maxlength="255" size="61" disabled',
                                                                                    false);
                                                                            ?> </td>
                                                                        </tr>   
                                                                        <tr class="main"> 
                                                                            <td valign="top"><?php echo TEXT_FILL_GENERIC_DESCRIPTION; ?></td>
                                                                            <td><input type="checkbox" name="add_generic_cat_description" disabled onClick="return EnableGeneric(this, this.form.generic_cat_description)"></td>
                                                                            <td class="main"><?php echo tep_draw_textarea_field('generic_cat_description',
                                                                                    'hard',
                                                                                    57,
                                                                                    8,
                                                                                    TEXT_GENERIC_DESCRIPTION,
                                                                                    'disabled',
                                                                                    false);
                                                                            ?></td>
                                                                        </tr>   
                                                                    </table></td> 
                                                            </tr> 

                                                            <tr>
                                                                <td width="100%"><table border="0" width="24%" class="HTC_Box"> 
                                                                        <tr><th class="main" align="center" colspan="3"><?php echo TEXT_FILL_GENERIC_SECTION_MANUFACTURERS; ?></th><tr>
                                                                        <tr class="main"> 
                                                                            <td><?php echo TEXT_FILL_GENERIC_TITLE; ?></td>
                                                                            <td><input type="checkbox" name="add_generic_man_title" disabled onClick="return EnableGeneric(this, this.form.generic_man_title)"></td>
                                                                            <td class="main"><?php
                                                                                echo tep_draw_input_field('generic_man_title',
                                                                                    TEXT_GENERIC_TITLE,
                                                                                    'maxlength="255" size="61" disabled',
                                                                                    false);
                                                                            ?> </td>
                                                                        </tr>
                                                                        <tr class="main"> 
                                                                            <td><?php echo TEXT_FILL_GENERIC_META_DESC; ?></td>
                                                                            <td><input type="checkbox" name="add_generic_man_meta_desc" disabled onClick="return EnableGeneric(this, this.form.generic_man_meta_desc)"></td>
                                                                            <td class="main"><?php
                                                                                echo tep_draw_input_field('generic_man_meta_desc',
                                                                                    TEXT_GENERIC_DESC,
                                                                                    'maxlength="255" size="61" disabled',
                                                                                    false);
                                                                            ?> </td>
                                                                        </tr>       
                                                                        <tr class="main"> 
                                                                            <td><?php echo TEXT_FILL_GENERIC_KEYWORDS; ?></td>
                                                                            <td><input type="checkbox" name="add_generic_man_keywords" disabled onClick="return EnableGeneric(this, this.form.generic_man_keywords)"></td>
                                                                            <td class="main"><?php
                                                                                echo tep_draw_input_field('generic_man_keywords',
                                                                                    TEXT_GENERIC_KEYWORDS,
                                                                                    'maxlength="255" size="61" disabled',
                                                                                    false);
                                                                            ?> </td>
                                                                        </tr>   
                                                                        <tr class="main"> 
                                                                            <td valign="top"><?php echo TEXT_FILL_GENERIC_DESCRIPTION; ?></td>
                                                                            <td><input type="checkbox" name="add_generic_man_description" disabled onClick="return EnableGeneric(this, this.form.generic_man_description)"></td>
                                                                            <td class="main"><?php
                                                                                echo tep_draw_textarea_field('generic_man_description',
                                                                                    'hard',
                                                                                    57,
                                                                                    8,
                                                                                    TEXT_GENERIC_DESCRIPTION,
                                                                                    'disabled',
                                                                                    false);
                                                                            ?></td>
                                                                        </tr>               
                                                                    </table></td> 
                                                            </tr> 

                                                            <tr>
                                                                <td width="100%"><table border="0" width="24%" class="HTC_Box"> 
                                                                        <tr><th class="main" align="center" colspan="3"><?php echo TEXT_FILL_GENERIC_SECTION_PRODUCTS; ?></th><tr>
                                                                        <tr class="main"> 
                                                                            <td><?php echo TEXT_FILL_GENERIC_TITLE; ?></td>
                                                                            <td><input type="checkbox" name="add_generic_prod_title" disabled onClick="return EnableGeneric(this, this.form.generic_prod_title)"></td>
                                                                            <td class="main"><?php
                                                                                echo tep_draw_input_field('generic_prod_title',
                                                                                    TEXT_GENERIC_TITLE,
                                                                                    'maxlength="255" size="61" disabled',
                                                                                    false);
                                                                            ?> </td>
                                                                        </tr>
                                                                        <tr class="main"> 
                                                                            <td><?php echo TEXT_FILL_GENERIC_META_DESC; ?></td>
                                                                            <td><input type="checkbox" name="add_generic_prod_meta_desc" disabled onClick="return EnableGeneric(this, this.form.generic_prod_meta_desc)"></td>
                                                                            <td class="main"><?php
                                                                                                                                      echo tep_draw_input_field('generic_prod_meta_desc',
                                                                                                                                          TEXT_GENERIC_DESC,
                                                                                                                                          'maxlength="255" size="61" disabled',
                                                                                                                                          false);
                                                                                                                                      ?> </td>
                                                                        </tr>       
                                                                        <tr class="main"> 
                                                                            <td><?php echo TEXT_FILL_GENERIC_KEYWORDS; ?></td>
                                                                            <td><input type="checkbox" name="add_generic_prod_keywords" disabled onClick="return EnableGeneric(this, this.form.generic_prod_keywords)"></td>
                                                                            <td class="main"><?php
                                                                                                                                      echo tep_draw_input_field('generic_prod_keywords',
                                                                                                                                          TEXT_GENERIC_KEYWORDS,
                                                                                                                                          'maxlength="255" size="61" disabled',
                                                                                                                                          false);
                                                                                                                                      ?> </td>
                                                                        </tr>   
                                                                    </table></td> 
                                                            </tr>                       

                                                        </table></td>
                                                </tr>        
                                            </table></td>
                                    </tr> 

                                    <tr>        
                                        <td><table border="1" width="100%" class="HTC_Box">
                                                <tr> 
                                                    <td colspan="3" class="HTC_title"><?php echo HEADING_TITLE_FILL_TAGS_OPTIONS.sprintf(TEXT_SHOW_POPUP,
                                                                                                                                          'TEXT_EXPLAIN_FILLTAGS');
                                                                                                                                      ?></td>
                                                </tr> 
                                                <tr>
                                                    <td width="55%"><table border="2" width="100%">
                                                            <tr>
                                                                <td><table border="0" width="100%">
                                                                        <tr class="smallText">
                                                                            <th><?php echo HEADING_TITLE_SEO_CATEGORIES; ?></th>
                                                                            <th><?php echo HEADING_TITLE_SEO_MANUFACTURERS; ?></th>          
                                                                            <th><?php echo HEADING_TITLE_SEO_PRODUCTS; ?></th>
                                                                        </tr> 
                                                                        <tr class="smallText">          
                                                                            <td title="<?php echo $filltagsPopup['skipall']; ?>" class="popup"><INPUT TYPE="radio" NAME="group1" VALUE="none" <?php
                                                            echo (isset($checkedCats['none'])
                                                                    ? $checkedCats['none']
                                                                    : '');
                                                                                                                                      ?> id="rad01" ><label for="rad01"><?php echo HEADING_TITLE_SEO_SKIPALL; ?></label></td>
                                                                            <td title="<?php echo $filltagsPopup['skipall']; ?>" class="popup"><INPUT TYPE="radio" NAME="group2" VALUE="none" <?php
                                                                            echo (isset($checkedManuf['none'])
                                                                                    ? $checkedManuf['none']
                                                                                    : '');
                                                                                                                                      ?> id="rad02" ><label for="rad02"><?php echo HEADING_TITLE_SEO_SKIPALL; ?></label></td>
                                                                            <td title="<?php echo $filltagsPopup['skipall']; ?>" class="popup"><INPUT TYPE="radio" NAME="group3" VALUE="none" <?php
                                                                                echo (isset($checkedProds['none'])
                                                                                        ? $checkedProds['none']
                                                                                        : '');
                                                                                ?> id="rad03" ><label for="rad03"><?php echo HEADING_TITLE_SEO_SKIPALL; ?></label></td>
                                                                        </tr>
                                                                        <tr class="smallText"> 
                                                                            <td title="<?php echo $filltagsPopup['empty']; ?>"><INPUT TYPE="radio" NAME="group1" VALUE="empty" <?php
                                                                                                    echo (isset($checkedCats['empty'])
                                                                                                            ? $checkedCats['empty']
                                                                                                            : '');
                                                                                ?> id="rad11" ><label for="rad11"><?php echo HEADING_TITLE_SEO_FILLONLY; ?></label></td>
                                                                            <td title="<?php echo $filltagsPopup['empty']; ?>"><INPUT TYPE="radio" NAME="group2" VALUE="empty" <?php
                                                                                                    echo (isset($checkedManuf['empty'])
                                                                                                            ? $checkedManuf['empty']
                                                                                                            : '');
                                                                                ?> id="rad12" ><label for="rad12"><?php echo HEADING_TITLE_SEO_FILLONLY; ?></label></td>
                                                                            <td title="<?php echo $filltagsPopup['empty']; ?>"><INPUT TYPE="radio" NAME="group3" VALUE="empty" <?php
                                                                                echo (isset($checkedProds['empty'])
                                                                                        ? $checkedProds['empty']
                                                                                        : '');
                                                                                ?> id="rad13" ><label for="rad13"><?php echo HEADING_TITLE_SEO_FILLONLY; ?></label></td>
                                                                        </tr>
                                                                        <tr class="smallText"> 
                                                                            <td title="<?php echo $filltagsPopup['full']; ?>"><INPUT TYPE="radio" NAME="group1" VALUE="full" <?php echo (isset($checkedCats['full'])
                                                                                ? $checkedCats['full']
                                                                                : '');
                                                                                ?> id="rad21" ><label for="rad21"><?php echo HEADING_TITLE_SEO_FILLALL; ?></label></td>
                                                                            <td title="<?php echo $filltagsPopup['full']; ?>"><INPUT TYPE="radio" NAME="group2" VALUE="full" <?php echo (isset($checkedManuf['full'])
                                                                                        ? $checkedManuf['full']
                                                                                        : '');
                                                                                ?> id="rad22" ><label for="rad22"><?php echo HEADING_TITLE_SEO_FILLALL; ?></label></td>
                                                                            <td title="<?php echo $filltagsPopup['full']; ?>"><INPUT TYPE="radio" NAME="group3" VALUE="full" <?php echo (isset($checkedProds['full'])
                                                                                ? $checkedProds['full']
                                                                                : '');
                                                                                ?> id="rad23" ><label for="rad23"><?php echo HEADING_TITLE_SEO_FILLALL; ?></label></td>
                                                                        </tr>
                                                                        <tr class="smallText"> 
                                                                            <td title="<?php echo $filltagsPopup['clear']; ?>"><INPUT TYPE="radio" NAME="group1" VALUE="clear" <?php echo (isset($checkedCats['clear'])
                                                                                ? $checkedCats['clear']
                                                                                : '');
                                                                                ?> id="rad31" ><label for="rad31"><?php echo HEADING_TITLE_SEO_CLEARALL; ?></label></td>
                                                                            <td title="<?php echo $filltagsPopup['clear']; ?>"><INPUT TYPE="radio" NAME="group2" VALUE="clear" <?php echo (isset($checkedManuf['clear'])
                                                                                ? $checkedManuf['clear']
                                                                                : '');
                                                                                ?> id="rad32" ><label for="rad32"><?php echo HEADING_TITLE_SEO_CLEARALL; ?></label></td>
                                                                            <td title="<?php echo $filltagsPopup['clear']; ?>"><INPUT TYPE="radio" NAME="group3" VALUE="clear" <?php echo (isset($checkedProds['clear'])
                                                                                ? $checkedProds['clear']
                                                                                : '');
                                                                                ?> id="rad33" ><label for="rad33"><?php echo HEADING_TITLE_SEO_CLEARALL; ?></label></td>
                                                                        </tr>
                                                                    </table></td>         
                                                            </tr> 
                                                            <tr>
                                                                <td width="55%"><table border="0" width="95%" cellspacing="0" cellpadding="2">
                                                                        <tr class="smallText"> 
                                                                            <td title="<?php echo $filltagsPopup['show_missing_tags']; ?>"><INPUT TYPE="checkbox" NAME="show_missing_tags" ><?php echo HEADING_TITLE_SEO_SHOW_MISSING_TAGS; ?></td>
                                                                            <td title="<?php echo $filltagsPopup['include_missing_description']; ?>"><INPUT TYPE="checkbox" NAME="include_missing_description" ><?php echo HEADING_TITLE_SEO_INCLUDE_MISSING_DESCRIPTION; ?></td>
                                                                            <td title="<?php echo $filltagsPopup['enable_sleep']; ?>"><INPUT TYPE="checkbox" NAME="enable_sleep" <?php echo ($sleep
                                                                                        ? 'checked=true'
                                                                                        : '');
                                                                                ?> id="enable_sleep" onchange="ChangeIntervalState();"><?php echo HEADING_TITLE_SEO_ENABLE_SLEEP; ?></td>
                                                                            <td title="<?php echo $filltagsPopup['enable_sleep_interval']; ?>"><INPUT TYPE="text" NAME="enable_sleep_interval" value="<?php echo ($sleep
                                                                        && $sleep_interval
                                                                                ? $sleep_interval
                                                                                : '');
                                                                                ?>" size="2" <?php echo ($sleep
                                                                        && $sleep_interval
                                                                                ? ''
                                                                                : 'disabled');
                                                                                ?> id="enable_sleep_interval">&nbsp;<?php echo HEADING_TITLE_SEO_ENABLE_SLEEP_INTERVAL; ?></td>
                                                                        <?php echo tep_draw_hidden_field('sleep_start_ctr',
                                                                            $sleep_start_ctr).tep_draw_hidden_field('sleep_total',
                                                                            $sleep_total);
                                                                        ?>
                                                                        </tr>
                                                                    </table></td>
                                                            </tr>  

                                                                        <?php
                                                                        $langCnt
                                                                            = count($languages);
                                                                        if ($langCnt
                                                                            == 1)
                                                                                $languageID
                                                                                = $languages[0]['id'];
                                                                        ?>
                                                            <tr> 
                                                                <td width="55%"><table border="0" width="95%" cellspacing="0" cellpadding="2">
                                                                        <tr class="smallText">             
                                                                            <td width="20%">&nbsp;<b><?php echo HEADING_TITLE_SEO_LANGUAGE; ?></b></td>
                                                                        <?php
                                                                        //add an all languages button
                                                                        if ($langCnt
                                                                            > 1) {
                                                                            ?>
                                                                                <td align=left><INPUT TYPE="radio" NAME="language_group" VALUE="language_99" <?php echo ($languageID
                                                                            == 99
                                                                                    ? 'checked'
                                                                                    : '');
                                                                            ?> ><?php echo TEXT_FILL_ALL_LANGUAGES; ?></td>
    <?php
}

for ($i = 0, $n = $langCnt; $i < $n; ++$i) {
    ?>   
                                                                                <td align="left"><INPUT TYPE="radio" NAME="language_group" VALUE="language_<?php echo $languages[$i]['id']; ?>" <?php echo (($languageID
    - 1) == $i ? 'checked' : '');
    ?> ><?php echo $languages[$i]['name']; ?></td>
<?php } ?>
                                                                        </tr>
                                                                    </table></td>   
                                                            </tr> 

                                                            <div id="errors"><a name="bottomOfPage"></a></div>

                                                            <tr>
                                                                <td><table border="0" width="100%">
                                                                        <tr>
                                                                            <td><?php echo tep_draw_separator('pixel_trans.gif',
    '100%', '10');
?></td>
                                                                        </tr>
                                                                        <tr> 
                                                                            <td align="center"><?php echo (tep_image_submit('button_update.gif',
    IMAGE_UPDATE) );
?></td>
                                                                        </tr>

<?php if (tep_not_null($updateTextCat) || tep_not_null($updateTextManuf) || tep_not_null($updateTextProd)) {
    ?>
                                                                            <tr>
                                                                                <td><?php echo tep_draw_separator('pixel_trans.gif',
        '100%', '10');
    ?></td>
                                                                            </tr> 
<?php } ?> 

<?php
if ($bottomOfPage) {
    echo '<tr><td><div class="pageheading" style="padding-bottom:10px; color:#ff0000;">'.ERROR_FILL_TAGS_FOUND_ERRORS.'</div></td></tr>';
}
?>

<?php if (tep_not_null($updateTextCat)) { ?>
                                                                            <tr>
                                                                                <td class="HTC_subHead"><?php echo sprintf($updateTextCat,
        ($sleep ? $sleep_total : $fillTagsCtr['categories']));
    ?></td>
                                                                            </tr> 
    <?php
    if (isset($fillTagsErrors['categories']) && count($fillTagsErrors['categories'])
        > 0) {
        for ($i = 0; $i < count($fillTagsErrors['categories']); ++$i) {
            ?>
                                                                                    <tr>
                                                                                        <td class="HTC_subHead"><?php echo $fillTagsErrors['categories'][$i]; ?></td>
                                                                                    </tr>       
        <?php }
    }
    ?>

<?php
}
if (tep_not_null($updateTextManuf)) {
    ?>
                                                                            <tr>
                                                                                <td class="HTC_subHead"><?php echo sprintf($updateTextManuf,
        ($sleep ? $sleep_total : $fillTagsCtr['manufacturers']));
    ?></td>
                                                                            </tr>

    <?php
    if (isset($fillTagsErrors['manufacturers']) && count($fillTagsErrors['manufacturers'])
        > 0) {
        for ($i = 0; $i < count($fillTagsErrors['manufacturers']); ++$i) {
            ?>
                                                                                    <tr>
                                                                                        <td class="HTC_subHead"><?php echo $fillTagsErrors['manufacturers'][$i]; ?></td>
                                                                                    </tr>       
        <?php }
    }
    ?>

<?php
}
if (tep_not_null($updateTextProd)) {
    ?>
                                                                            <tr>
                                                                                <td class="HTC_subHead"><?php echo sprintf($updateTextProd,
        ($sleep ? $sleep_total : $fillTagsCtr['products']));
    ?></td>
                                                                            </tr>

    <?php
    if (isset($fillTagsErrors['products']) && count($fillTagsErrors['products'])
        > 0) {
        for ($i = 0; $i < count($fillTagsErrors['products']); ++$i) {
            ?>
                                                                                    <tr>
                                                                                        <td class="HTC_subHead"><?php echo $fillTagsErrors['products'][$i]; ?></td>
                                                                                    </tr>       
        <?php }
    }
    ?>

<?php
}
if (tep_not_null($missingTags)) {
    ?>
                                                                            <tr>
                                                                                <td><?php echo tep_draw_separator('pixel_trans.gif',
        '100%', '10');
    ?></td>
                                                                            </tr>                
                                                                            <tr>
                                                                                <td class="HTC_subHead" style="font-weight: bold;"><?php echo TEXT_MISSING_TAGS; ?></td>
                                                                            </tr>               
                                                                            <tr>
                                                                                <td class="HTC_subHead"><?php echo $missingTags; ?></td>
                                                                            </tr>
<?php } ?>
                                                                    </table></td>
                                                            </tr>
                                                        </table></td>

                                                </tr>                  
                                            </table></td>  
                                    </tr> 
                                </form></td>
                </tr>
                <!-- end of Header Tags -->

            </table></td>
    </tr>
</table>

<?php
require(DIR_WS_INCLUDES.'template_bottom.php');
require(DIR_WS_INCLUDES.'application_bottom.php');