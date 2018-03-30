<?php
/*
  $Id: articles.php, v1.0 2003/12/04 12:00:00 ra Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce
  Portions Copyright 2009 http://www.oscommerce-solution.com

  Released under the GNU General Public License
 */

require('includes/application_top.php');
require_once('includes/functions/articles.php');

//goto the authors page since at least one author is required
$authors_query = tep_db_query("select count(*) as total from ".TABLE_AUTHORS);
$authors       = tep_db_fetch_array($authors_query);
if ($authors['total'] < 1)
        tep_redirect(tep_href_link(FILENAME_AUTHORS, 'no_authors=true'));

/* * ******************** BEGIN VERSION CHECKER ******************** */
if (file_exists(DIR_WS_FUNCTIONS.'version_checker.php')) {
    require_once(DIR_WS_LANGUAGES.$language.'/version_checker.php');
    require_once(DIR_WS_FUNCTIONS.'version_checker.php');
    $contribPath    = 'http://addons.oscommerce.com/info/1709';
    $currentVersion = 'Articles Manager V 1.57_8';
    $contribName    = 'Articles Manager V';
    $versionStatus  = '';
}
/* * ******************** END VERSION CHECKER ******************** */

$action = (isset($_GET['action']) ? $_GET['action'] : '');

/* * ******************** CHECK THE VERSION ********************** */
if (isset($_POST['action']) && $_POST['action'] == 'getversion') {
    if (isset($_POST['version_check']) && $_POST['version_check'] == 'on')
            $versionStatus = AnnounceVersion($contribPath, $currentVersion,
            $contribName);
} else if (tep_not_null($action)) {
    // Ultimate SEO URLs v2.2d
// If the action will affect the cache entries
    if (preg_match("/(insert|update|setflag)/i", $action))
            include_once('includes/reset_seo_cache.php');


    switch ($action) {
        case 'setflag':
            if (($_GET['flag'] == '0') || ($_GET['flag'] == '1')) {
                if (isset($_GET['aID'])) {
                    tep_set_article_status($_GET['aID'], $_GET['flag']);
                }

                if (USE_CACHE == 'true') {
                    tep_reset_cache_block('topics');
                }
                //pure new: cache reset
                if ($_GET['flag'] == '0') {
                    //deleting product need full reset
                    tep_db_query("UPDATE ".TABLE_RESET." SET reset='1' WHERE admin = 'shop' AND section='all'");
                    tep_db_query("UPDATE ".TABLE_RESET." SET reset='1' WHERE admin = 'admin' AND section='all'");
                } else {

                    tep_db_query("UPDATE ".TABLE_ARTICLES_DESCRIPTION." SET cached = 0 WHERE articles_id = ".$_GET['aID']);
                    tep_db_query("UPDATE ".TABLE_ARTICLES_DESCRIPTION." SET cached_admin = 0 WHERE articles_id = ".$_GET['aID']);
                    $cached_topics_query = tep_db_query("SELECT topics_id FROM ".TABLE_ARTICLES_TO_TOPICS." WHERE articles_id=".$_GET['aID']);
                    while ($cached_topics       = tep_db_fetch_array($cached_topics_query)) {
                        tep_db_query("UPDATE ".TABLE_TOPICS_DESCRIPTION." SET cached = 0 WHERE topics_id = ".$cached_topics['topics_id']);
                        tep_db_query("UPDATE ".TABLE_TOPICS_DESCRIPTION." SET cached_admin = 0 WHERE topics_id = ".$cached_topics['topics_id']);
                    }
                }
            }
            tep_redirect(tep_href_link(FILENAME_ARTICLES,
                    'tPath='.$_GET['tPath'].'&aID='.$_GET['aID']));
            break;
        case 'setflagblog':
            if (($_GET['flagblog'] == '0') || ($_GET['flagblog'] == '1')) {
                if (isset($_GET['aID'])) {
                    tep_set_article_blog_status($_GET['aID'], $_GET['flagblog']);
                }

                if (USE_CACHE == 'true') {
                    tep_reset_cache_block('topics');
                }
                //pure new: cache reset
                tep_db_query("UPDATE ".TABLE_ARTICLES_DESCRIPTION." SET cached = 0 WHERE articles_id = ".$_GET['aID']);
                tep_db_query("UPDATE ".TABLE_ARTICLES_DESCRIPTION." SET cached_admin = 0 WHERE articles_id = ".$_GET['aID']);
                $cached_topics_query = tep_db_query("SELECT topics_id FROM ".TABLE_ARTICLES_TO_TOPICS." WHERE articles_id=".$_GET['aID']);
                while ($cached_topics       = tep_db_fetch_array($cached_topics_query)) {
                    tep_db_query("UPDATE ".TABLE_TOPICS_DESCRIPTION." SET cached = 0 WHERE topics_id = ".$cached_topics['topics_id']);
                    tep_db_query("UPDATE ".TABLE_TOPICS_DESCRIPTION." SET cached_admin = 0 WHERE topics_id = ".$cached_topics['topics_id']);
                }
            }

            tep_redirect(tep_href_link(FILENAME_ARTICLES,
                    'tPath='.$_GET['tPath'].'&aID='.$_GET['aID']));
            break;
        case 'new_topic':
        case 'edit_topic':
            $_GET['action'] = $_GET['action'].'_ACD';
            break;
        case 'insert_topic':
        case 'update_topic':
            if (($_POST['edit_x']) || ($_POST['edit_y'])) {
                $_GET['action'] = 'edit_topic_ACD';
            } else {
                if (isset($_POST['topics_id']))
                        $topics_id = tep_db_prepare_input($_POST['topics_id']);
                if ($topics_id == '') {
                    $topics_id = tep_db_prepare_input($_GET['tID']);
                }
                $sort_order = tep_db_prepare_input($_POST['sort_order']);

                $sql_data_array = array('sort_order' => (int) $sort_order);

                if ($action == 'insert_topic') {
                    $insert_sql_data = array('parent_id' => $current_topic_id,
                        'date_added' => 'now()');

                    $sql_data_array = array_merge($sql_data_array,
                        $insert_sql_data);

                    tep_db_perform(TABLE_TOPICS, $sql_data_array);

                    $topics_id = tep_db_insert_id();
                } elseif ($action == 'update_topic') {
                    $update_sql_data = array('last_modified' => 'now()');

                    $sql_data_array = array_merge($sql_data_array,
                        $update_sql_data);

                    tep_db_perform(TABLE_TOPICS, $sql_data_array, 'update',
                        "topics_id = '".(int) $topics_id."'");
                }

                $languages = tep_get_languages();
                for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {

                    $language_id = $languages[$i]['id'];

                    $sql_data_array = array('topics_name' => tep_db_prepare_input($_POST['topics_name'][$language_id]),
                        'topics_heading_title' => tep_db_prepare_input($_POST['topics_heading_title'][$language_id]),
                        'topics_description' => tep_db_prepare_input($_POST['topics_description'][$language_id]));

                    if ($action == 'insert_topic') {
                        $insert_sql_data = array('topics_id' => $topics_id,
                            'language_id' => $languages[$i]['id']);

                        $sql_data_array = array_merge($sql_data_array,
                            $insert_sql_data);

                        tep_db_perform(TABLE_TOPICS_DESCRIPTION, $sql_data_array);
                    } elseif ($action == 'update_topic') {
                        tep_db_perform(TABLE_TOPICS_DESCRIPTION,
                            $sql_data_array, 'update',
                            "topics_id = '".(int) $topics_id."' and language_id = '".(int) $languages[$i]['id']."'");
                    }

                    /*                     * *************** ADD AS PSEDUO PAGE FOR HEADER TAGS SEO *************** */
                    $psedudoPage = sprintf(FILENAME_ARTICLES."?tPath=%d",
                        $topics_id);
                    require_once(DIR_WS_FUNCTIONS.'header_tags.php');
                    require(DIR_WS_MODULES.'articles_pseudo.php');
                }

                if (USE_CACHE == 'true') {
                    tep_reset_cache_block('topics');
                }
                //pure new: cache reset (case 'update_topic' OR case 'insert_topic')
                tep_db_query("UPDATE ".TABLE_RESET." SET reset='1' WHERE admin = 'shop' AND section='all'");
                tep_db_query("UPDATE ".TABLE_RESET." SET reset='1' WHERE admin = 'admin' AND section='all'");

                tep_redirect(tep_href_link(FILENAME_ARTICLES,
                        'tPath='.$tPath.'&tID='.$topics_id));
                break;
            }
        case 'delete_topic_confirm':
            if (isset($_POST['topics_id'])) {
                $topics_id = tep_db_prepare_input($_POST['topics_id']);

                $topics          = tep_get_topic_tree($topics_id, '', '0', '',
                    true);
                $articles        = array();
                $articles_delete = array();

                for ($i = 0, $n = sizeof($topics); $i < $n; $i++) {
                    $article_ids_query = tep_db_query("select articles_id from ".TABLE_ARTICLES_TO_TOPICS." where topics_id = '".(int) $topics[$i]['id']."'");

                    while ($article_ids = tep_db_fetch_array($article_ids_query)) {
                        $articles[$article_ids['articles_id']]['topics'][] = $topics[$i]['id'];
                    }
                }

                reset($articles);
                while (list($key, $value) = each($articles)) {
                    $topic_ids = '';

                    for ($i = 0, $n = sizeof($value['topics']); $i < $n; $i++) {
                        $topic_ids .= "'".(int) $value['topics'][$i]."', ";
                    }
                    $topic_ids = substr($topic_ids, 0, -2);

                    $check_query = tep_db_query("select count(*) as total from ".TABLE_ARTICLES_TO_TOPICS." where articles_id = '".(int) $key."' and topics_id not in (".$topic_ids.")");
                    $check       = tep_db_fetch_array($check_query);
                    if ($check['total'] < '1') {
                        $articles_delete[$key] = $key;
                    }
                }

// removing topics can be a lengthy process
                tep_set_time_limit(0);
                for ($i = 0, $n = sizeof($topics); $i < $n; $i++) {
                    tep_remove_topic($topics[$i]['id']);
                }

                reset($articles_delete);
                while (list($key) = each($articles_delete)) {
                    tep_remove_article($key);
                }
            }

            if (USE_CACHE == 'true') {
                tep_reset_cache_block('topics');
            }
            //pure new: cache reset (case 'delete_topic_confirm')
            tep_db_query("UPDATE ".TABLE_RESET." SET reset='1' WHERE admin = 'shop' AND section='all'");
            tep_db_query("UPDATE ".TABLE_RESET." SET reset='1' WHERE admin = 'admin' AND section='all'");

            tep_redirect(tep_href_link(FILENAME_ARTICLES, 'tPath='.$tPath));
            break;
        case 'delete_article_confirm':
            if (isset($_POST['articles_id']) && isset($_POST['article_topics']) && is_array($_POST['article_topics'])) {
                $article_id     = tep_db_prepare_input($_POST['articles_id']);
                $article_topics = $_POST['article_topics'];

                for ($i = 0, $n = sizeof($article_topics); $i < $n; $i++) {
                    tep_db_query("delete from ".TABLE_ARTICLES_TO_TOPICS." where articles_id = '".(int) $article_id."' and topics_id = '".(int) $article_topics[$i]."'");
                }
                //pure new: cache reset (case 'delete_article_confirm') ALL - need delete article contents
                tep_db_query("UPDATE ".TABLE_RESET." SET reset='1' WHERE admin = 'shop' AND section='all'");
                tep_db_query("UPDATE ".TABLE_RESET." SET reset='1' WHERE admin = 'admin' AND section='all'");

                $article_topics_query = tep_db_query("select count(*) as total from ".TABLE_ARTICLES_TO_TOPICS." where articles_id = '".(int) $article_id."'");
                $article_topics       = tep_db_fetch_array($article_topics_query);

                if ($article_topics['total'] == '0') {
                    tep_remove_article($article_id);
                }
            }

            if (USE_CACHE == 'true') {
                tep_reset_cache_block('topics');
            }

            tep_redirect(tep_href_link(FILENAME_ARTICLES, 'tPath='.$tPath));
            break;
        case 'move_topic_confirm':
            if (isset($_POST['topics_id']) && ($_POST['topics_id'] != $_POST['move_to_topic_id'])) {
                $topics_id     = tep_db_prepare_input($_POST['topics_id']);
                $new_parent_id = tep_db_prepare_input($_POST['move_to_topic_id']);

                $path = explode('_',
                    tep_get_generated_topic_path_ids($new_parent_id));

                if (in_array($topics_id, $path)) {
                    $messageStack->add_session(ERROR_CANNOT_MOVE_TOPIC_TO_PARENT,
                        'error');

                    tep_redirect(tep_href_link(FILENAME_ARTICLES,
                            'tPath='.$tPath.'&tID='.$topics_id));
                } else {
                    tep_db_query("update ".TABLE_TOPICS." set parent_id = '".(int) $new_parent_id."', last_modified = now() where topics_id = '".(int) $topics_id."'");

                    if (USE_CACHE == 'true') {
                        tep_reset_cache_block('topics');
                    }
                    //pure new: cache reset (case 'update_topic' OR case 'insert_topic')
                    tep_db_query("UPDATE ".TABLE_RESET." SET reset='1' WHERE admin = 'shop' AND section='all'");
                    tep_db_query("UPDATE ".TABLE_RESET." SET reset='1' WHERE admin = 'admin' AND section='all'");

                    tep_redirect(tep_href_link(FILENAME_ARTICLES,
                            'tPath='.$new_parent_id.'&tID='.$topics_id));
                }
            }

            break;
        case 'move_article_confirm':
            $articles_id   = tep_db_prepare_input($_POST['articles_id']);
            $new_parent_id = tep_db_prepare_input($_POST['move_to_topic_id']);

            $duplicate_check_query = tep_db_query("select count(*) as total from ".TABLE_ARTICLES_TO_TOPICS." where articles_id = '".(int) $articles_id."' and topics_id = '".(int) $new_parent_id."'");
            $duplicate_check       = tep_db_fetch_array($duplicate_check_query);
            if ($duplicate_check['total'] < 1) {
                tep_db_query("update ".TABLE_ARTICLES_TO_TOPICS." set topics_id = '".(int) $new_parent_id."' where articles_id = '".(int) $articles_id."' and topics_id = '".(int) $current_topic_id."'");
                //pure:new cache reset full!
                tep_db_query("UPDATE ".TABLE_RESET." SET reset='1' WHERE admin = 'shop' AND section='all'");
                tep_db_query("UPDATE ".TABLE_RESET." SET reset='1' WHERE admin = 'admin' AND section='all'");
            }
            if (USE_CACHE == 'true') {
                tep_reset_cache_block('topics');
            }

            tep_redirect(tep_href_link(FILENAME_ARTICLES,
                    'tPath='.$new_parent_id.'&aID='.$articles_id));
            break;
        case 'insert_article':
        case 'update_article':
            if (isset($_POST['edit_x']) || isset($_POST['edit_y'])) {
                $action = 'new_article';
            } else {
                if (isset($_GET['aID']))
                        $articles_id             = tep_db_prepare_input($_GET['aID']);
                $articles_date_available = tep_db_prepare_input($_POST['articles_date_available']);
                $articles_date_available = (date('Y-m-d') < $articles_date_available)
                        ? $articles_date_available : 'null';

                $sort_order = tep_db_prepare_input($_POST['sort_order']);

                $sql_data_array = array('articles_date_available' => $articles_date_available,
                    'articles_status' => tep_db_prepare_input($_POST['articles_status']),
                    'articles_is_blog' => tep_db_prepare_input($_POST['articles_is_blog']),
                    'authors_id' => tep_db_prepare_input($_POST['authors_id']),
                    'articles_sort_order' => (int) $sort_order);

                if ($action == 'insert_article') {
                    // If expected article then articles_date _added becomes articles_date_available
                    if (isset($_POST['articles_date_available']) && tep_not_null($_POST['articles_date_available'])) {
                        $insert_sql_data = array('articles_date_added' => tep_db_prepare_input($_POST['articles_date_available']));
                    } else {
                        $insert_sql_data = array('articles_date_added' => 'now()');
                    }
                    $sql_data_array = array_merge($sql_data_array,
                        $insert_sql_data);

                    tep_db_perform(TABLE_ARTICLES, $sql_data_array);
                    $articles_id = tep_db_insert_id();

                    tep_db_query("insert into ".TABLE_ARTICLES_TO_TOPICS." (articles_id, topics_id, canonical) values ('".(int) $articles_id."', '".(int) $current_topic_id."', '1')");
                } elseif ($action == 'update_article') {
                    $update_sql_data = array('articles_last_modified' => 'now()');
                    $update_sql_data = array('articles_last_modified' => 'now()');
                    // If expected article then articles_date _added becomes articles_date_available
                    if (isset($_POST['articles_date_available']) && tep_not_null($_POST['articles_date_available'])) {
                        $update_sql_data = array('articles_date_added' => tep_db_prepare_input($_POST['articles_date_available']));
                    }

                    $sql_data_array = array_merge($sql_data_array,
                        $update_sql_data);

                    tep_db_perform(TABLE_ARTICLES, $sql_data_array, 'update',
                        "articles_id = '".(int) $articles_id."'");
                    //update canonical
                    if (isset($_POST['canonical'])) { //je zaskrt.
                        $wQ = tep_db_query("SELECT topics_id FROM ".TABLE_ARTICLES_TO_TOPICS." WHERE articles_id = ".(int) $articles_id);
                        while ($w  = tep_db_fetch_array($wQ))
                            tep_db_query("UPDATE ".TABLE_ARTICLES_TO_TOPICS." SET canonical = null WHERE articles_id = ".(int) $articles_id." AND topics_id = ".$w['topics_id']);

                        $uQ = tep_db_query("UPDATE ".TABLE_ARTICLES_TO_TOPICS." SET canonical = 1 WHERE articles_id = ".(int) $articles_id." AND topics_id = ".$current_topic_id);
                    }
                }

                $languages = tep_get_languages();

                for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
                    $language_id = $languages[$i]['id'];

                    $articlesImg = tep_db_prepare_input($_POST['articles_image_'.$language_id]);

                    if (!tep_not_null($articlesImg)) {
                        $db_query = tep_db_query("select articles_image from ".TABLE_ARTICLES_DESCRIPTION." where articles_id = ".(int) $articles_id." and language_id = ".(int) $language_id);
                        if (tep_db_num_rows($db_query) > 0) {
                            $db          = tep_db_fetch_array($db_query);
                            $articlesImg = $db['articles_image'];
                        }
                    }

                    $sql_data_array = array('articles_name' => tep_db_prepare_input($_POST['articles_name'][$language_id]),
                        'articles_description' => tep_db_prepare_input($_POST['articles_description'][$language_id]),
                        'articles_image' => tep_db_prepare_input($articlesImg),
                        'articles_url' => tep_db_prepare_input($_POST['articles_url'][$language_id]),
                        'articles_head_desc_tag' => tep_db_prepare_input($_POST['articles_head_desc_tag'][$language_id]));

                    if ($action == 'insert_article') {
                        $insert_sql_data = array('articles_id' => $articles_id,
                            'language_id' => $language_id);

                        $sql_data_array = array_merge($sql_data_array,
                            $insert_sql_data);

                        tep_db_perform(TABLE_ARTICLES_DESCRIPTION,
                            $sql_data_array);
                    } elseif ($action == 'update_article') {
                        tep_db_perform(TABLE_ARTICLES_DESCRIPTION,
                            $sql_data_array, 'update',
                            "articles_id = '".(int) $articles_id."' and language_id = '".(int) $language_id."'");
                    }


                    /*                     * *************** ADD AS PSEDUO PAGE FOR HEADER TAGS SEO *************** */
                    $psedudoPage = sprintf(FILENAME_ARTICLE_INFO."?articles_id=%d",
                        $articles_id);
                    require_once(DIR_WS_FUNCTIONS.'header_tags.php');
                    require(DIR_WS_MODULES.'articles_pseudo.php');
                }

                if (USE_CACHE == 'true') {
                    tep_reset_cache_block('topics');
                }
                //pure: static cache reset
                tep_db_query("UPDATE ".TABLE_ARTICLES_DESCRIPTION." SET cached = 0 WHERE articles_id = ".(int) $articles_id);
                tep_db_query("UPDATE ".TABLE_ARTICLES_DESCRIPTION." SET cached_admin = 0 WHERE articles_id = ".(int) $articles_id);

                $cached_topics_query = tep_db_query("SELECT topics_id FROM ".TABLE_ARTICLES_TO_TOPICS." WHERE articles_id=".(int) $articles_id);
                while ($cached_topics       = tep_db_fetch_array($cached_topics_query)) {
                    tep_db_query("UPDATE ".TABLE_TOPICS_DESCRIPTION." SET cached = 0 WHERE topics_id = ".$cached_topics['topics_id']);
                    tep_db_query("UPDATE ".TABLE_TOPICS_DESCRIPTION." SET cached_admin = 0 WHERE topics_id = ".$cached_topics['topics_id']);
                }

                tep_redirect(tep_href_link(FILENAME_ARTICLES,
                        'tPath='.$tPath.'&aID='.$articles_id));
            }
            break;
        case 'copy_to_confirm':
            if (isset($_POST['articles_id']) && isset($_POST['topics_id'])) {
                $articles_id = tep_db_prepare_input($_POST['articles_id']);
                $topics_id   = tep_db_prepare_input($_POST['topics_id']);

                if ($_POST['copy_as'] == 'link') {
                    if ($topics_id != $current_topic_id) {
                        $check_query = tep_db_query("select count(*) as total from ".TABLE_ARTICLES_TO_TOPICS." where articles_id = '".(int) $articles_id."' and topics_id = '".(int) $topics_id."'");
                        $check       = tep_db_fetch_array($check_query);
                        if ($check['total'] < '1') {
                            tep_db_query("insert into ".TABLE_ARTICLES_TO_TOPICS." (articles_id, topics_id) values ('".(int) $articles_id."', '".(int) $topics_id."')");
                        }
                    } else {
                        $messageStack->add_session(ERROR_CANNOT_LINK_TO_SAME_TOPIC,
                            'error');
                    }
                } elseif ($_POST['copy_as'] == 'duplicate') {
                    $article_query = tep_db_query("select articles_date_available, authors_id from ".TABLE_ARTICLES." where articles_id = '".(int) $articles_id."'");
                    $article       = tep_db_fetch_array($article_query);
                    $sort_order    = tep_db_prepare_input($_POST['sort_order']);

                    tep_db_query("insert into ".TABLE_ARTICLES." (articles_date_added, articles_date_available, articles_status, articles_is_blog, articles_sort_order, authors_id) values (now(), '".tep_db_input($article['articles_date_available'])."', '0', '".(int) $sort_order."', '".(int) $article['authors_id']."')");
                    $dup_articles_id = tep_db_insert_id();

                    $description_query = tep_db_query("select language_id, articles_name, articles_description, articles_image, articles_url, articles_head_desc_tag from ".TABLE_ARTICLES_DESCRIPTION." where articles_id = '".(int) $articles_id."'");
                    while ($description       = tep_db_fetch_array($description_query)) {
                        tep_db_query("insert into ".TABLE_ARTICLES_DESCRIPTION." (articles_id, language_id, articles_name, articles_description, articles_image, articles_url, articles_head_desc_tag, articles_viewed) values ('".(int) $dup_articles_id."', '".(int) $description['language_id']."', '".tep_db_input($description['articles_name'])."', '".tep_db_input($description['articles_description'])."', '".tep_db_input($description['articles_image'])."', '".tep_db_input($description['articles_url'])."', '".tep_db_input($description['articles_head_desc_tag'])."', '0')");
                    }

                    tep_db_query("insert into ".TABLE_ARTICLES_TO_TOPICS." (articles_id, topics_id) values ('".(int) $dup_articles_id."', '".(int) $topics_id."')");
                    $articles_id = $dup_articles_id;
                }

                if (USE_CACHE == 'true') {
                    tep_reset_cache_block('topics');
                }
                //pure:new cache reset
                tep_db_query("UPDATE ".TABLE_TOPICS_DESCRIPTION." SET cached = 0 WHERE topics_id = ".$topics_id);
                tep_db_query("UPDATE ".TABLE_TOPICS_DESCRIPTION." SET cached_admin = 0 WHERE topics_id = ".$topics_id);
            }

            tep_redirect(tep_href_link(FILENAME_ARTICLES,
                    'tPath='.$topics_id.'&aID='.$articles_id));
            break;
    }
}

// check if the catalog image directory exists
if (is_dir(DIR_FS_CATALOG_IMAGES)) {
    if (!is_writeable(DIR_FS_CATALOG_IMAGES))
            $messageStack->add(ERROR_CATALOG_IMAGE_DIRECTORY_NOT_WRITEABLE,
            'error');
} else {
    $messageStack->add(ERROR_CATALOG_IMAGE_DIRECTORY_DOES_NOT_EXIST, 'error');
}
require(DIR_WS_INCLUDES.'template_top.php');
?>

<?php
switch (ARTICLE_ENABLE_HTML_EDITOR) {
    case 'CKEditor':
        echo '<script type="text/javascript" src="./ckeditor/ckeditor.js"></script>';
        break;

    case 'FCKEditor':
        break;

    case 'TinyMCE':
        // START tinyMCE Anywhere
        $storeGet       = $_GET['action']; //kludge to work around poor coding used by previous programer
        if ($_GET['action'] = 'new_topic_ACD' || $_GET['action'] = 'new_topic_preview'
            || $_GET['action'] = 'new_article' || $_GET['action'] = 'article_preview'
            || $_GET['action'] = 'insert_article') {
            $languages = tep_get_languages(); // Get all languages
            // Build list of textareas to convert
            $str       = '';
            for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
                $str .= "topics_description[".$languages[$i]['id']."],articles_description[".$languages[$i]['id']."],articles_head_desc_tag[".$languages[$i]['id']."],";
            }  //end for each language
            $mce_str = rtrim($str, ","); // Removed the last comma from the string.
            // You can add more textareas to convert in the $str, be careful that they are all separated by a comma.
            echo '<script language="javascript" type="text/javascript" src="includes/javascript/tiny_mce/tiny_mce.js"></script>';
            include "includes/javascript/tiny_mce/general.php";
        } // END tinyMCE Anywhere
        $_GET['action'] = $storeGet;
        break;

    default: break;
}
?>

<style type="text/css">
    table.BorderedBox {border: ridge #ddd 3px; background-color: #eee; }
    table.BorderedBoxWhite {border: ridge #ddd 3px; background-color: #eee; }
    table.BorderedBoxLight {border: ridge #ddd 3px; background-color: #eee; }
    tr.Header { background-color: #eee; }
    td.HTC_Head {font-family: Verdana, Arial, sans-serif; color:#333; font-size: 18px; font-weight: bold; }
</style>

<table border="0" width="100%" cellspacing="0" cellpadding="2">
    <tr>
        <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
<?php
//----- new_topic / edit_topic  -----
if (isset($_GET['action']) && ($_GET['action'] == 'new_topic_ACD' || $_GET['action']
    == 'edit_topic_ACD')) {
    if (($_GET['tID']) && (!$_POST)) {
        $topics_query = tep_db_query("select t.topics_id, td.topics_name, td.topics_heading_title, td.topics_description, t.parent_id, t.sort_order, t.date_added, t.last_modified from ".TABLE_TOPICS." t, ".TABLE_TOPICS_DESCRIPTION." td where t.topics_id = '".$_GET['tID']."' and t.topics_id = td.topics_id and td.language_id = '".$languages_id."' order by t.sort_order, td.topics_name");
        $topic        = tep_db_fetch_array($topics_query);

        $tInfo = new objectInfo($topic);
    } elseif ($_POST) {
        $tInfo                = new objectInfo($_POST);
        $topics_name          = $_POST['topics_name'];
        $topics_heading_title = $_POST['topics_heading_title'];
        $topics_description   = $_POST['topics_description'];
        $topics_url           = $_POST['topics_url'];
    } else {
        $tInfo = new objectInfo(array());
    }

    $languages = tep_get_languages();

    $text_new_or_edit = ($_GET['action'] == 'new_topic_ACD') ? TEXT_INFO_HEADING_NEW_TOPIC
            : TEXT_INFO_HEADING_EDIT_TOPIC;
    ?>
                    <tr>
                        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td class="pageHeading"><?php echo sprintf($text_new_or_edit,
                                tep_output_generated_topic_path($current_topic_id)); ?></td>
                                    <td class="pageHeading" align="right"><?php echo tep_draw_separator('pixel_trans.gif',
                                HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
                                </tr>
                            </table></td>
                    </tr>
                    <tr>
                        <td><?php echo tep_draw_separator('pixel_trans.gif', '1',
                                '10'); ?></td>
                    </tr>
                    <tr><?php echo tep_draw_form('new_topic', FILENAME_ARTICLES,
                                'tPath='.$tPath.'&tID='.$_GET['tID'].'&action=new_topic_preview',
                                'post', 'enctype="multipart/form-data"'); ?>
                        <td><table border="0" cellspacing="0" cellpadding="2">
                                                    <?php
                                                    for ($i = 0; $i < sizeof($languages); $i++) {
                                                        ?>
                                    <tr>
                                        <td class="smallText"><?php if ($i == 0) echo TEXT_EDIT_TOPICS_NAME; ?></td>
                                        <td class="smallText"><?php echo tep_draw_input_field('topics_name['.$languages[$i]['id'].']',
                                                    (($topics_name[$languages[$i]['id']])
                                                            ? stripslashes($topics_name[$languages[$i]['id']])
                                                            : tep_get_topic_name($tInfo->topics_id,
                                                            $languages[$i]['id']))).'&nbsp;'.$languages[$i]['name']; ?></td>
                                    </tr>
                                                        <?php
                                                    }
                                                    ?>
                                <tr>
                                    <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif',
                                                    '1', '10'); ?></td>
                                </tr>
                                <?php
                                for ($i = 0; $i < sizeof($languages); $i++) {
                                    ?>
                                    <tr>
                                        <td class="smallText"><?php if ($i == 0) echo TEXT_EDIT_TOPICS_HEADING_TITLE; ?></td>
                                        <td class="smallText"><?php echo tep_draw_input_field('topics_heading_title['.$languages[$i]['id'].']',
                                (($topics_name[$languages[$i]['id']]) ? stripslashes($topics_name[$languages[$i]['id']])
                                        : tep_get_topic_heading_title($tInfo->topics_id,
                                        $languages[$i]['id']))).'&nbsp;'.$languages[$i]['name']; ?></td>
                                    </tr>
        <?php
    }
    ?>
                                <tr>
                                    <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif',
        '1', '10'); ?></td>
                                </tr>
    <?php
    for ($i = 0; $i < sizeof($languages); $i++) {
        ?>
                                    <tr>
                                        <td class="smallText" valign="top"><?php if ($i
            == 0) echo TEXT_EDIT_TOPICS_DESCRIPTION; ?></td>
                                        <td><table border="0" cellspacing="0" cellpadding="0">
                                                <tr>
                                                    <td class="smallText">
                        <?php
                        if (ARTICLE_ENABLE_HTML_EDITOR == 'No Editor')
                                echo tep_draw_textarea_field('topics_description['.$languages[$i]['id'].']',
                                'soft', '70', '15',
                                (($topics_description[$languages[$i]['id']]) ? stripslashes($topics_description[$languages[$i]['id']])
                                        : tep_get_topic_description($tInfo->topics_id,
                                        $languages[$i]['id'])));
                        else {
                            if (ARTICLE_ENABLE_HTML_EDITOR == 'FCKEditor') {
                                echo tep_draw_fckeditor('topics_description['.$languages[$i]['id'].']',
                                    '700', '300',
                                    (isset($topics_description[$languages[$i]['id']])
                                            ? stripslashes($topics_description[$languages[$i]['id']])
                                            : tep_get_topic_description($tInfo->topics_id,
                                            $languages[$i]['id'])));
                            } else if (ARTICLE_ENABLE_HTML_EDITOR == 'CKEditor') {
                                echo tep_draw_textarea_field('topics_description['.$languages[$i]['id'].']',
                                    'soft', '70', '15',
                                    (($topics_description[$languages[$i]['id']])
                                            ? stripslashes($topics_description[$languages[$i]['id']])
                                            : tep_get_topic_description($tInfo->topics_id,
                                            $languages[$i]['id'])),
                                    'id = "topics_description['.$languages[$i]['id'].']" class="ckeditor"');
                            } else {
                                echo tep_draw_textarea_field('topics_description['.$languages[$i]['id'].']',
                                    'soft', '70', '15',
                                    (($topics_description[$languages[$i]['id']])
                                            ? stripslashes($topics_description[$languages[$i]['id']])
                                            : tep_get_topic_description($tInfo->topics_id,
                                            $languages[$i]['id'])));
                            }
                        }
                        ?>
                                                    </td>
                                                    <td class="smallText" valign="top"><?php echo '&nbsp;'.$languages[$i]['name']; ?>&nbsp;</td>
                                                </tr>
                                            </table></td>
                                    </tr>
        <?php
    }
    ?>
                                <tr>
                                    <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif',
        '1', '10'); ?></td>
                                </tr>
                                <tr>
                                    <td class="smallText"><?php echo TEXT_EDIT_SORT_ORDER; ?></td>
                                    <td class="smallText"><?php echo tep_draw_input_field('sort_order',
                    $tInfo->sort_order, 'size="2"'); ?></td>
                                </tr>
                                <tr>
                                    <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif',
                    '1', '10'); ?></td>
                                </tr>
                            </table></td>
                    </tr>
                    <tr>
                        <td><?php echo tep_draw_separator('pixel_trans.gif', '1',
                    '10'); ?></td>
                    </tr>
                    <tr>
                        <td class="smallText" align="right"><?php echo tep_draw_hidden_field('topics_date_added',
                    (($tInfo->date_added) ? $tInfo->date_added : date('Y-m-d'))).tep_draw_hidden_field('parent_id',
                    $tInfo->parent_id).tep_image_submit('button_preview.gif',
                    IMAGE_PREVIEW).'&nbsp;&nbsp;<a href="'.tep_href_link(FILENAME_ARTICLES,
                    'tPath='.$tPath.'&tID='.$_GET['tID']).'">'.tep_image_button('button_cancel.gif',
                    IMAGE_CANCEL).'</a>'; ?></td>
                        </form></tr>
                            <?php
                            //----- new_topic_preview -----
                        } elseif (isset($_GET['action']) && $_GET['action'] == 'new_topic_preview') {
                            if ($_POST) {
                                $tInfo                = new objectInfo($_POST);
                                $topics_name          = $_POST['topics_name'];
                                $topics_heading_title = $_POST['topics_heading_title'];
                                $topics_description   = $_POST['topics_description'];
                            } else {
                                $topic_query = tep_db_query("select t.topics_id, td.language_id, td.topics_name, td.topics_heading_title, td.topics_description, t.sort_order, t.date_added, t.last_modified from ".TABLE_TOPICS." t, ".TABLE_TOPICS_DESCRIPTION." td where t.topics_id = td.topics_id and t.topics_id = '".$_GET['tID']."'");
                                $topic       = tep_db_fetch_array($topic_query);

                                $tInfo = new objectInfo($topic);
                            }

                            $form_action = ($_GET['tID']) ? 'update_topic' : 'insert_topic';

                            echo tep_draw_form($form_action, FILENAME_ARTICLES,
                                'tPath='.$tPath.'&tID='.$_GET['tID'].'&action='.$form_action,
                                'post', 'enctype="multipart/form-data"');

                            $languages = tep_get_languages();
                            for ($i = 0; $i < sizeof($languages); $i++) {
                                if ($_GET['read'] == 'only') {
                                    $tInfo->topics_name          = tep_get_topic_name($tInfo->topics_id,
                                        $languages[$i]['id']);
                                    $tInfo->topics_heading_title = tep_get_topic_heading_title($tInfo->topics_id,
                                        $languages[$i]['id']);
                                    $tInfo->topics_description   = tep_get_topic_description($tInfo->topics_id,
                                        $languages[$i]['id']);
                                } else {
                                    $tInfo->topics_name          = tep_db_prepare_input($topics_name[$languages[$i]['id']]);
                                    $tInfo->topics_heading_title = tep_db_prepare_input($topics_heading_title[$languages[$i]['id']]);
                                    $tInfo->topics_description   = tep_db_prepare_input($topics_description[$languages[$i]['id']]);
                                }
                                ?>
                        <tr>
                            <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td class="pageHeading"><?php echo $tInfo->topics_heading_title.'&nbsp;<span class="smallText">('.$languages[$i]['name'].')</span>'; ?></td>
                                    </tr>
                                </table></td>
                        </tr>
                        <tr>
                            <td><?php echo tep_draw_separator('pixel_trans.gif', '1',
                    '10'); ?></td>
                        </tr>
                        <tr>
                            <td class="smallText"><?php echo $tInfo->topics_description; ?></td>
                        </tr>

                        <?php
                    }
                    if ($_GET['read'] == 'only') {
                        if ($_GET['origin']) {
                            $pos_params = strpos($_GET['origin'], '?', 0);
                            if ($pos_params != false) {
                                $back_url        = substr($_GET['origin'], 0,
                                    $pos_params);
                                $back_url_params = substr($_GET['origin'],
                                    $pos_params + 1);
                            } else {
                                $back_url        = $_GET['origin'];
                                $back_url_params = '';
                            }
                        } else {
                            $back_url        = FILENAME_ARTICLES;
                            $back_url_params = 'tPath='.$tPath.'&tID='.$tInfo->topics_id;
                        }
                        ?>
                        <tr>
                            <td align="right"><?php echo '<a href="'.tep_href_link($back_url,
                    $back_url_params, 'NONSSL').'">'.tep_image_button('button_back.gif',
                    IMAGE_BACK).'</a>'; ?></td>
                        </tr>
                        <?php
                    } else {
                        ?>
                        <tr>
                            <td align="right" class="smallText">
                        <?php
                        /* Re-Post all POST'ed variables */
                        reset($_POST);
                        while (list($key, $value) = each($_POST)) {
                            if (!is_array($_POST[$key])) {
                                echo tep_draw_hidden_field($key,
                                    htmlspecialchars(stripslashes($value)));
                            }
                        }
                        $languages = tep_get_languages();
                        for ($i = 0; $i < sizeof($languages); $i++) {
                            echo tep_draw_hidden_field('topics_name['.$languages[$i]['id'].']',
                                htmlspecialchars(stripslashes($topics_name[$languages[$i]['id']])));
                            echo tep_draw_hidden_field('topics_heading_title['.$languages[$i]['id'].']',
                                htmlspecialchars(stripslashes($topics_heading_title[$languages[$i]['id']])));
                            echo tep_draw_hidden_field('topics_description['.$languages[$i]['id'].']',
                                htmlspecialchars(stripslashes($topics_description[$languages[$i]['id']])));
                        }

                        echo tep_image_submit('button_back.gif', IMAGE_BACK,
                            'name="edit"').'&nbsp;&nbsp;';

                        if ($_GET['tID']) {
                            echo tep_image_submit('button_update.gif',
                                IMAGE_UPDATE);
                        } else {
                            echo tep_image_submit('button_insert.gif',
                                IMAGE_INSERT);
                        }
                        echo '&nbsp;&nbsp;<a href="'.tep_href_link(FILENAME_ARTICLES,
                            'tPath='.$tPath.'&tID='.$_GET['tID']).'">'.tep_image_button('button_cancel.gif',
                            IMAGE_CANCEL).'</a>';
                        ?></td>
                            </form></tr>
                                                <?php
                                            }
                                        } elseif ($action == 'new_article') {
                                            $parameters = array('articles_name' => '',
                                                'articles_description' => '',
                                                'articles_image' => '',
                                                'articles_url' => '',
                                                'articles_head_desc_tag' => '',
                                                'articles_id' => '',
                                                'articles_date_added' => '',
                                                'articles_last_modified' => '',
                                                'articles_date_available' => '',
                                                'articles_status' => '',
                                                'articles_is_blog' => '',
                                                'articles_sort_order' => 0,
                                                'authors_id' => '');

                                            $aInfo = new objectInfo($parameters);

                                            if (isset($_GET['aID']) && empty($_POST)) {
                                                $article_query = tep_db_query("select ad.articles_name, ad.articles_description, ad.articles_image, ad.articles_url, ad.articles_head_desc_tag, a.articles_id, a.articles_date_added, a.articles_last_modified, date_format(a.articles_date_available, '%Y-%m-%d') as articles_date_available, a.articles_status, a.articles_is_blog, a.articles_sort_order, a.authors_id from ".TABLE_ARTICLES." a, ".TABLE_ARTICLES_DESCRIPTION." ad where a.articles_id = '".(int) $_GET['aID']."' and a.articles_id = ad.articles_id and ad.language_id = '".(int) $languages_id."'");
                                                $article       = tep_db_fetch_array($article_query);

                                                $aInfo->objectInfo($article);
                                            } elseif (tep_not_null($_POST)) {
                                                $aInfo->objectInfo($_POST);
                                                $articles_name        = $_POST['articles_name'];
                                                $articles_description = $_POST['articles_description'];

                                                $articles_image = '';

                                                $articles_url           = $_POST['articles_url'];
                                                $articles_head_desc_tag = $_POST['articles_head_desc_tag'];
                                                $articles_sort_order    = $_POST['sort_order'];
                                            }

                                            $authors_array = array(array('id' => '',
                                                    'text' => TEXT_NONE));
                                            $authors_query = tep_db_query("select authors_id, authors_name from ".TABLE_AUTHORS." order by authors_name");
                                            while ($authors       = tep_db_fetch_array($authors_query)) {
                                                $authors_array[] = array('id' => $authors['authors_id'],
                                                    'text' => $authors['authors_name']);
                                            }

                                            $languages = tep_get_languages();

                                            if (!isset($aInfo->articles_status))
                                                    $aInfo->articles_status = '1';
                                            switch ($aInfo->articles_status) {
                                                case '0': $in_status  = false;
                                                    $out_status = true;
                                                    break;
                                                case '1':
                                                default: $in_status  = true;
                                                    $out_status = false;
                                            }
                                            if (!isset($aInfo->articles_is_blog))
                                                    $aInfo->articles_is_blog = '1';
                                            switch ($aInfo->articles_is_blog) {
                                                case '0': $blog_in_status  = false;
                                                    $blog_out_status = true;
                                                    break;
                                                case '1':
                                                default: $blog_in_status  = true;
                                                    $blog_out_status = false;
                                            }
                                            ?>
                    <link rel="stylesheet" type="text/css" href="includes/javascript/spiffyCal/spiffyCal_v2_1.css">
                    <script language="JavaScript" src="includes/javascript/spiffyCal/spiffyCal_v2_1.js"></script>
                    <script language="javascript">
                    <!--
                        var dateAvailable = new ctlSpiffyCalendarBox("dateAvailable", "new_article", "articles_date_available", "btnDate1", "<?php echo $aInfo->articles_date_available; ?>", scBTNMODE_CUSTOMBLUE);
                    -->
                    </script>
    <?php echo tep_draw_form('new_article', FILENAME_ARTICLES,
        'tPath='.$tPath.(isset($_GET['aID']) ? '&aID='.$_GET['aID'] : '').'&action=article_preview',
        'post', 'enctype="multipart/form-data"'); ?>
                    <table border="0" width="100%" cellspacing="0" cellpadding="2">
                        <tr>
                            <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td class="pageHeading"><?php echo (isset($_GET['aID'])
                                        ? sprintf(TEXT_EDIT_ARTICLE,
                                        tep_output_generated_topic_path($current_topic_id))
                                        : sprintf(TEXT_NEW_ARTICLE,
                                        tep_output_generated_topic_path($current_topic_id))); ?></td>
                                        <td class="pageHeading" align="right"><?php echo tep_draw_separator('pixel_trans.gif',
                                                        '100%', 15); ?></td>
                                    </tr>
                                </table></td>
                        </tr>
                        <tr>
                            <td><?php echo tep_draw_separator('pixel_trans.gif',
                                                        '1', '10'); ?></td>
                        </tr>
                        <tr>
                            <td><table border="0" cellspacing="0" cellpadding="2">


                                    <tr>
                                        <td class="main"><?php echo TEXT_ARTICLES_CANONICAL; ?></td>
                                        <td class="main"><?php
                                                    $isChk = $pInfo->canonical > 0
                                                            ? true : false;
                                                    $ro    = false;
                                                    $wrn   = false;
                                                    if (!$isChk) { //navrh samoopravy chybejicich
                                                        $canQ = tep_db_query($qs
                                                            = "SELECT * FROM ".TABLE_ARTICLES_TO_TOPICS." WHERE canonical > 0 AND articles_id = ".(int) $aInfo->articles_id);
                                                        if (tep_db_num_rows($canQ)
                                                            < 1) {
                                                            $isChk = true;
                                                            $wrn   = true;
                                                        }
                                                    } else $ro = true;

                                                    echo tep_draw_separator('pixel_trans.gif',
                                                        '24', '15').'&nbsp;'
                                                    .'<INPUT type="CHECKBOX" name="canonical" value="on"'.($isChk
                                                            ? (' CHECKED'.($ro ? ' READONLY'
                                                                : '')) : '').'>'
                                                    .($wrn ? (' POZOR - produkt dosud nemá kanonické označení - odznačte, nemá-li být zde. ')
                                                            : ''); //.$qs
                                                    //. tep_draw_checkbox_field('canonical', 'on', ($pInfo->canonical > 0 ? true : false)); 
    ?></td>
                                    </tr>



                                    <tr>
                                        <td class="smallText"><?php echo TEXT_ARTICLES_STATUS; ?></td>
                                        <td class="smallText"><?php echo tep_draw_radio_field('articles_status',
                                                        '0', $out_status).'&nbsp;'.TEXT_ARTICLE_NOT_AVAILABLE.'&nbsp;'.tep_draw_radio_field('articles_status',
                                                        '1', $in_status).'&nbsp;'.TEXT_ARTICLE_AVAILABLE; ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif',
                                                        '1', '10'); ?></td>
                                    </tr>
                                    <tr>
                                        <td class="smallText"><?php echo TEXT_ARTICLES_BLOG_STATUS; ?></td>
                                        <td class="smallText"><?php echo tep_draw_radio_field('articles_is_blog',
                                    '0', $blog_out_status).'&nbsp;'.TEXT_ARTICLE_BLOG_NO.'&nbsp;'.tep_draw_radio_field('articles_is_blog',
                                    '1', $blog_in_status).'&nbsp;'.TEXT_ARTICLE_BLOG_YES; ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif',
                                    '1', '10'); ?></td>
                                    </tr>
                                    <tr>
                                        <td class="smallText"><?php echo TEXT_ARTICLES_DATE_AVAILABLE; ?><br><small>(YYYY-MM-DD)</small></td>
                                        <td class="smallText" align="left"><script language="javascript">dateAvailable.writeControl(); dateAvailable.dateFormat = "yyyy-MM-dd";</script></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif',
                                    '1', '10'); ?></td>
                                    </tr>
                                    <tr>
                                        <td class="smallText"><?php echo TEXT_EDIT_SORT_ORDER; ?></td>
                                        <td class="smallText"><?php echo tep_draw_input_field('sort_order',
                                    $aInfo->articles_sort_order, 'size="2"'); ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif',
                                    '1', '10'); ?></td>
                                    </tr>
                                    <tr>
                                    <tr>
                                        <td class="smallText"><?php echo TEXT_ARTICLES_AUTHOR; ?></td>
                                        <td class="smallText"><?php echo tep_draw_pull_down_menu('authors_id',
                    $authors_array, $aInfo->authors_id); ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif',
                    '1', '10'); ?></td>
                                    </tr>
                    <?php
                    for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
                        ?>
                                        <tr>
                                            <td class="smallText"><?php if ($i == 0) echo TEXT_ARTICLES_NAME; ?></td>
                                            <td class="smallText"><?php echo tep_draw_input_field('articles_name['.$languages[$i]['id'].']',
                    (isset($articles_name[$languages[$i]['id']]) ? $articles_name[$languages[$i]['id']]
                            : tep_get_articles_name($aInfo->articles_id,
                            $languages[$i]['id'])), 'size="35"').'&nbsp;'.$languages[$i]['name']; ?></td>
                                        </tr>
                        <?php
                    }
                    ?>
                                    <tr>
                                        <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif',
                    '1', '10'); ?></td>
                                    </tr>
                    <?php
                    for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
                        ?>
                                        <tr>
                                            <td class="smallText"><?php if ($i == 0) echo TEXT_ARTICLES_IMAGE; ?></td>
                                            <td class="smallText"><?php echo (isset($_GET['aID'])
                        ? tep_draw_input_field('articles_image_name',
                        tep_get_articles_image($aInfo->articles_id,
                            $languages[$i]['id']), 'disabled size="20"').'&nbsp;&nbsp;'
                        : '').tep_draw_file_field('articles_image_'.$languages[$i]['id']).'&nbsp;'.$languages[$i]['name']; ?></td>
                                        </tr>
                        <?php
                    }
                    ?>

                                    <tr>
                                        <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif',
                    '1', '10'); ?></td>
                                    </tr>
    <?php
    for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
        ?>
                                        <tr bgcolor="#ffffcc">
                                            <td class="smallText" valign="top"><?php if ($i
            == 0) echo sprintf(TEXT_ARTICLES_HEAD_DESC_TAG,
                MAX_ARTICLE_ABSTRACT_LENGTH); ?></td>
                                            <td><table border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td class="smallText">
        <?php
        if (ARTICLE_ENABLE_HTML_EDITOR == 'No Editor')
                echo tep_draw_textarea_field('articles_head_desc_tag['.$languages[$i]['id'].']',
                'soft', '70', '15',
                (($articles_head_desc_tag[$languages[$i]['id']]) ? stripslashes($articles_head_desc_tag[$languages[$i]['id']])
                        : tep_get_articles_head_desc_tag($aInfo->articles_id,
                        $languages[$i]['id'])));
        else {
            if (ARTICLE_ENABLE_HTML_EDITOR == 'FCKEditor') {
                echo tep_draw_fckeditor('articles_head_desc_tag['.$languages[$i]['id'].']',
                    '700', '300',
                    (isset($articles_head_desc_tag[$languages[$i]['id']]) ? stripslashes($articles_head_desc_tag[$languages[$i]['id']])
                            : tep_get_articles_head_desc_tag($aInfo->articles_id,
                            $languages[$i]['id'])));
            } else if (ARTICLE_ENABLE_HTML_EDITOR == 'CKEditor') {
                echo tep_draw_textarea_field('articles_head_desc_tag['.$languages[$i]['id'].']',
                    'soft', '70', '15',
                    (($articles_head_desc_tag[$languages[$i]['id']]) ? stripslashes($articles_head_desc_tag[$languages[$i]['id']])
                            : tep_get_articles_head_desc_tag($aInfo->articles_id,
                            $languages[$i]['id'])),
                    'id = "articles_head_desc_tag['.$languages[$i]['id'].']" class="ckeditor"');
            } else {
                echo tep_draw_textarea_field('articles_head_desc_tag['.$languages[$i]['id'].']',
                    'soft', '70', '15',
                    (($articles_head_desc_tag[$languages[$i]['id']]) ? stripslashes($articles_head_desc_tag[$languages[$i]['id']])
                            : tep_get_articles_head_desc_tag($aInfo->articles_id,
                            $languages[$i]['id'])));
            }
        }
        ?>
                                                        </td>
                                                        <td class="smallText" valign="top"><?php echo '&nbsp;'.$languages[$i]['name']; ?>&nbsp;</td>
                                                    </tr>
                                                </table></td>
                                        </tr>
                            <?php
                        }
                        ?>
                                    <tr>
                                        <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif',
                        '1', '10'); ?></td>
                                    </tr>

                        <?php
                        for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
                            ?>
                                        <tr>
                                            <td class="smallText" valign="top"><?php if ($i
                        == 0) echo TEXT_ARTICLES_DESCRIPTION; ?></td>
                                            <td><table border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td class="smallText">
                            <?php
                            if (ARTICLE_ENABLE_HTML_EDITOR == 'No Editor')
                                    echo tep_draw_textarea_field('articles_description['.$languages[$i]['id'].']',
                                    'soft', '70', '15',
                                    (($articles_description[$languages[$i]['id']])
                                            ? stripslashes($articles_description[$languages[$i]['id']])
                                            : tep_get_articles_description($aInfo->articles_id,
                                            $languages[$i]['id'])));
                            else {
                                if (ARTICLE_ENABLE_HTML_EDITOR == 'FCKEditor') {
                                    echo tep_draw_fckeditor('articles_description['.$languages[$i]['id'].']',
                                        '700', '300',
                                        (isset($articles_description[$languages[$i]['id']])
                                                ? stripslashes($articles_description[$languages[$i]['id']])
                                                : tep_get_articles_description($aInfo->articles_id,
                                                $languages[$i]['id'])));
                                } else if (ARTICLE_ENABLE_HTML_EDITOR == 'CKEditor') {
                                    echo tep_draw_textarea_field('articles_description['.$languages[$i]['id'].']',
                                        'soft', '70', '15',
                                        (($articles_description[$languages[$i]['id']])
                                                ? stripslashes($articles_description[$languages[$i]['id']])
                                                : tep_get_articles_description($aInfo->articles_id,
                                                $languages[$i]['id'])),
                                        'id = "articles_description['.$languages[$i]['id'].']" class="ckeditor"');
                                } else {
                                    echo tep_draw_textarea_field('articles_description['.$languages[$i]['id'].']',
                                        'soft', '70', '15',
                                        (($articles_description[$languages[$i]['id']])
                                                ? stripslashes($articles_description[$languages[$i]['id']])
                                                : tep_get_articles_description($aInfo->articles_id,
                                                $languages[$i]['id'])));
                                }
                            }
                            ?>
                                                        </td>
                                                        <td class="smallText" valign="top"><?php echo '&nbsp;'.$languages[$i]['name']; ?>&nbsp;</td>
                                                    </tr>
                                                </table></td>
                                        </tr>
                                    <?php
                                }
                                ?>
                                    <tr>
                                        <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif',
                                    '1', '10'); ?></td>
                                    </tr>
                    <?php
                    for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
                        ?>
                                        <tr>
                                            <td class="smallText"><?php if ($i == 0) echo TEXT_ARTICLES_URL.'<br><small>'.TEXT_ARTICLES_URL_WITHOUT_HTTP.'</small>'; ?></td>
                                            <td class="smallText"><?php echo tep_draw_input_field('articles_url['.$languages[$i]['id'].']',
                            (isset($articles_url[$languages[$i]['id']]) ? $articles_url[$languages[$i]['id']]
                                    : tep_get_articles_url($aInfo->articles_id,
                                    $languages[$i]['id'])), 'size="35"').'&nbsp;'.$languages[$i]['name']; ?></td>
                                        </tr>
        <?php
    }
    ?>
                                </table></td>
                        </tr>
                        <tr>
                            <td><?php echo tep_draw_separator('pixel_trans.gif',
        '1', '10'); ?></td>
                        </tr>
                        <tr>
                            <td class="smallText" align="right"><?php echo tep_draw_hidden_field('articles_date_added',
        (tep_not_null($aInfo->articles_date_added) ? $aInfo->articles_date_added
                : date('Y-m-d'))).tep_image_submit('button_preview.gif',
        IMAGE_PREVIEW).'&nbsp;&nbsp;<a href="'.tep_href_link(FILENAME_ARTICLES,
        'tPath='.$tPath.(isset($_GET['aID']) ? '&aID='.$_GET['aID'] : '')).'">'.tep_image_button('button_cancel.gif',
        IMAGE_CANCEL).'</a>'; ?></td>
                        </tr>
                    </table></form>
                                                <?php
                                            } elseif ($action == 'article_preview') {
                                                if (tep_not_null($_POST)) {
                                                    $aInfo                = new objectInfo($_POST);
                                                    $articles_name        = $_POST['articles_name'];
                                                    $articles_description = $_POST['articles_description'];

                                                    $languages = tep_get_languages();
                                                    $imgArray  = array();
                                                    for ($i = 0, $n = sizeof($languages); $i
                                                        < $n; $i++) {
                                                        $imgID     = sprintf("articles_image_%s",
                                                            $languages[$i]['id']);
                                                        $art_image = new upload($imgID);
                                                        $art_image->set_destination(DIR_FS_CATALOG_IMAGES.'article_manager_uploads/');

                                                        if ($art_image->parse() && $art_image->save()) {
                                                            $imgArray[$languages[$i]['id']]
                                                                = tep_db_input($art_image->filename);
                                                        }
                                                    }

                                                    $articles_url           = $_POST['articles_url'];
                                                    $articles_head_desc_tag = $_POST['articles_head_desc_tag'];
                                                } else {
                                                    $article_query = tep_db_query("select a.articles_id, ad.language_id, ad.articles_name, ad.articles_description, ad.articles_image, ad.articles_url, ad.articles_head_desc_tag, a.articles_date_added, a.articles_last_modified, a.articles_date_available, a.articles_status, a.articles_is_blog, a.authors_id  from ".TABLE_ARTICLES." a, ".TABLE_ARTICLES_DESCRIPTION." ad where a.articles_id = ad.articles_id and a.articles_id = '".(int) $_GET['aID']."'");
                                                    $article       = tep_db_fetch_array($article_query);

                                                    $aInfo = new objectInfo($article);
                                                }

                                                $form_action = (isset($_GET['aID']))
                                                        ? 'update_article' : 'insert_article';

                                                echo tep_draw_form($form_action,
                                                    FILENAME_ARTICLES,
                                                    'tPath='.$tPath.(isset($_GET['aID'])
                                                            ? '&aID='.$_GET['aID']
                                                            : '').'&action='.$form_action,
                                                    'post',
                                                    'enctype="multipart/form-data"');

                                                $languages = tep_get_languages();
                                                for ($i = 0, $n = sizeof($languages); $i
                                                    < $n; $i++) {
                                                    if (isset($_GET['read']) && ($_GET['read']
                                                        == 'only')) {
                                                        $aInfo->articles_name          = tep_get_articles_name($aInfo->articles_id,
                                                            $languages[$i]['id']);
                                                        $aInfo->articles_description
                                                            = tep_get_articles_description($aInfo->articles_id,
                                                            $languages[$i]['id']);
                                                        $aInfo->articles_image         = tep_get_articles_image($aInfo->articles_id,
                                                            $languages[$i]['id']);
                                                        $aInfo->articles_url           = tep_get_articles_url($aInfo->articles_id,
                                                            $languages[$i]['id']);
                                                        $aInfo->articles_head_desc_tag
                                                            = tep_get_articles_head_desc_tag($aInfo->articles_id,
                                                            $languages[$i]['id']);
                                                    } else {
                                                        $aInfo->articles_name          = tep_db_prepare_input($articles_name[$languages[$i]['id']]);
                                                        $aInfo->articles_description
                                                            = tep_db_prepare_input($articles_description[$languages[$i]['id']]);
                                                        $aInfo->articles_image         = tep_db_prepare_input($articles_image[$languages[$i]['id']]);
                                                        $aInfo->articles_url           = tep_db_prepare_input($articles_url[$languages[$i]['id']]);
                                                        $aInfo->articles_head_desc_tag
                                                            = tep_db_prepare_input($articles_head_desc_tag[$languages[$i]['id']]);
                                                    }
                                                    ?>
                        <table border="0" width="100%" cellspacing="0" cellpadding="2">
                            <tr>
                                <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td class="pageHeading" colspan="2"><?php echo tep_image(DIR_WS_CATALOG_LANGUAGES.$languages[$i]['directory'].'/images/'.$languages[$i]['image'],
                                                $languages[$i]['name']).'&nbsp;'.$aInfo->articles_name; ?></td>
                                        </tr>
                                    </table></td>
                            </tr>
                                                    <?php
                                                    if ($aInfo->articles_description) {
                                                        ?>
                                <tr>
                                    <td><?php echo tep_draw_separator('pixel_trans.gif',
                                                '1', '10'); ?></td>
                                </tr>
                                <tr>
                                    <td class="smallText"><?php echo $aInfo->articles_description; ?></td>
                                </tr>
                                                        <?php
                                                    }
                                                    ?>
                                                    <?php
                                                    if ($aInfo->articles_url) {
                                                        ?>
                                <tr>
                                    <td><?php echo tep_draw_separator('pixel_trans.gif',
                                                            '1', '10'); ?></td>
                                </tr>
                                <tr>
                                    <td class="smallText"><?php echo sprintf(TEXT_ARTICLE_MORE_INFORMATION,
                                                            $aInfo->articles_url); ?></td>
                                </tr>
                                            <?php
                                        }
                                        ?>
                            <tr>
                                <td><?php echo tep_draw_separator('pixel_trans.gif',
                                    '1', '10'); ?></td>
                            </tr>
                                        <?php
                                        if ($aInfo->articles_date_available > date('Y-m-d')) {
                                            ?>
                                <tr>
                                    <td align="center" class="smallText"><?php echo sprintf(TEXT_ARTICLE_DATE_AVAILABLE,
                                    tep_date_long($aInfo->articles_date_available)); ?></td>
                                </tr>
                                            <?php
                                        } else {
                                            ?>
                                <tr>
                                    <td align="center" class="smallText"><?php echo sprintf(TEXT_ARTICLE_DATE_ADDED,
                                    tep_date_long($aInfo->articles_date_added)); ?></td>
                                </tr>
                                            <?php
                                        }
                                        ?>
                            <tr>
                                <td><?php echo tep_draw_separator('pixel_trans.gif',
                                    '1', '10'); ?></td>
                            </tr>
                                            <?php
                                        }

                                        if (isset($_GET['read']) && ($_GET['read']
                                            == 'only')) {
                                            if (isset($_GET['origin'])) {
                                                $pos_params = strpos($_GET['origin'],
                                                    '?', 0);
                                                if ($pos_params != false) {
                                                    $back_url        = substr($_GET['origin'],
                                                        0, $pos_params);
                                                    $back_url_params = substr($_GET['origin'],
                                                        $pos_params + 1);
                                                } else {
                                                    $back_url        = $_GET['origin'];
                                                    $back_url_params = '';
                                                }
                                            } else {
                                                $back_url        = FILENAME_ARTICLES;
                                                $back_url_params = 'tPath='.$tPath.'&aID='.$aInfo->articles_id;
                                            }
                                            ?>
                            <tr>
                                <td align="right"><?php echo '<a href="'.tep_href_link($back_url,
                        $back_url_params, 'NONSSL').'">'.tep_image_button('button_back.gif',
                        IMAGE_BACK).'</a>'; ?></td>
                            </tr>
                            <?php
                        } else {
                            ?>
                            <tr>
                                <td align="right" class="smallText">
                            <?php
                            /* Re-Post all POST'ed variables */
                            reset($_POST);
                            while (list($key, $value) = each($_POST)) {
                                if (!is_array($_POST[$key])) {
                                    echo tep_draw_hidden_field($key,
                                        htmlspecialchars(stripslashes($value)));
                                }
                            }
                            $languages = tep_get_languages();
                            for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
                                echo tep_draw_hidden_field('articles_name['.$languages[$i]['id'].']',
                                    htmlspecialchars(stripslashes($articles_name[$languages[$i]['id']])));
                                echo tep_draw_hidden_field('articles_description['.$languages[$i]['id'].']',
                                    htmlspecialchars(stripslashes($articles_description[$languages[$i]['id']])));
                                echo tep_draw_hidden_field('articles_image_'.$languages[$i]['id'],
                                    htmlspecialchars(stripslashes($imgArray[$languages[$i]['id']])));
                                echo tep_draw_hidden_field('articles_url['.$languages[$i]['id'].']',
                                    htmlspecialchars(stripslashes($articles_url[$languages[$i]['id']])));
                                echo tep_draw_hidden_field('articles_head_desc_tag['.$languages[$i]['id'].']',
                                    htmlspecialchars(stripslashes($articles_head_desc_tag[$languages[$i]['id']])));
                            }

                            echo tep_image_submit('button_back.gif', IMAGE_BACK,
                                'name="edit"').'&nbsp;&nbsp;';

                            if (isset($_GET['aID'])) {
                                echo tep_image_submit('button_update.gif',
                                    IMAGE_UPDATE);
                            } else {
                                echo tep_image_submit('button_insert.gif',
                                    IMAGE_INSERT);
                            }
                            echo '&nbsp;&nbsp;<a href="'.tep_href_link(FILENAME_ARTICLES,
                                'tPath='.$tPath.(isset($_GET['aID']) ? '&aID='.$_GET['aID']
                                        : '')).'">'.tep_image_button('button_cancel.gif',
                                IMAGE_CANCEL).'</a>';
                            ?></td>
                            </tr>
                        </table></form>
                <?php
            }
        } else {
            ?>
                    <table border="0" width="100%" cellspacing="0" cellpadding="2">
                        <tr>
                            <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2" class="BorderedBoxWhite">
                                    <tr>
                                        <td><table border="0" width="95%" cellspacing="0" cellpadding="0">
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
                $idParts = explode(' ', $currentVersion);
                foreach ($idParts as $part) {
                    if ($part !== 'V') {
                        $name .= $part;
                    } else {
                        break;
                    }
                }
                $id = $idParts[count($idParts) - 1];
                if (ARTICLE_ENABLE_VERSION_CHECKER == 'true') {
                    ?>
                                                        <tr>
                                                            <td style="float:right"><table border="0" cellpadding="0"><tr>
                                                                        <td class="smallText" align="right" style="font-weight: bold; color: red;"><?php echo AnnounceVersion($contribPath,
                $currentVersion, $contribName); ?></td>
                                                                        <td class="smallText" align="right" style="font-weight: bold; color: red;"><INPUT TYPE="radio" NAME="version_check_unreleased" onClick="window.open('http://www.oscommerce-solution.com/check_unreleased_updates.php?id=<?php echo $id; ?>&name=<?php echo $name; ?>')"><span style="vertical-align:top"><?php echo TEXT_VERSION_CHECK_UPDATES_UNRELEASED; ?></span></td>
                                                                    </tr></table></td>                  
                                                        </tr>
                <?php
                } else if (tep_not_null($versionStatus)) {
                    echo '<tr><td class="smallText" align="right" style="font-weight: bold; color: red;">'.$versionStatus.'</td></tr>';
                } else {
                    echo tep_draw_form('version_check', FILENAME_ARTICLES, '',
                        'post').tep_draw_hidden_field('action', 'getversion');
                    ?>
                                                        <tr>
                                                            <td style="float:right"><table border="0" cellpadding="0"><tr>
                                                                        <td class="smallText" align="right" style="font-weight: bold; color: red;"><INPUT style="vertical-align:bottom" TYPE="radio" NAME="version_check" onClick="this.form.submit();"><?php echo TEXT_VERSION_CHECK_UPDATES; ?></td>
                                                                        <td class="smallText" align="right" style="font-weight: bold; color: red;"><INPUT style="vertical-align:bottom" TYPE="radio" NAME="version_check_unreleased" onClick="window.open('http://www.oscommerce-solution.com/check_unreleased_updates.php?id=<?php echo $id; ?>&name=<?php echo $name; ?>')"><?php echo TEXT_VERSION_CHECK_UPDATES_UNRELEASED; ?></td>
                                                                    </tr></table></td>
                                                        </tr>
                                                        </form>
                <?php }
            } else { ?>
                                                    <tr>
                                                        <td class="smallText" align="right" style="font-weight: bold; color: red;"><?php echo TEXT_MISSING_VERSION_CHECKER; ?></td>
                                                    </tr>
            <?php } ?>
                                            </table></td>
                                    </tr>
                                    <tr>
                                        <td align="center" colspan="3"><table border="0" width="100%" cellspacing="0" cellpadding="0">
                                                <tr>
                                                    <td width="70%"></td>
                                                    <td class="smallText" align="right">
            <?php
            echo tep_draw_form('search', FILENAME_ARTICLES, '', 'get');
            echo HEADING_TITLE_SEARCH.' '.tep_draw_input_field('search');
            echo '</form>';
            ?>
                                                    </td>
                                                    <td class="smallText" align="right">
            <?php
            echo tep_draw_form('goto', FILENAME_ARTICLES, '', 'get');
            echo HEADING_TITLE_GOTO.' '.tep_draw_pull_down_menu('tPath',
                tep_get_topic_tree(), $current_topic_id,
                'onChange="this.form.submit();"');
            echo '</form>';
            ?>
                                                    </td>
                                                </tr>
                                            </table></td>
                                    </tr>
                                </table></td>
                        </tr>

                        <tr>
                            <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                                                <tr class="dataTableHeadingRow">
                                                    <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_TOPICS_ARTICLES; ?></td>
                                                    <td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_STATUS; ?></td>
                                                    <td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_BLOG_STATUS; ?></td>
                                                    <td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_SORT_ORDER; ?></td>
                                                    <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_ACTION; ?>&nbsp;</td>
                                                </tr>
            <?php
            $topics_count = 0;
            $rows         = 0;
            if (isset($_GET['search'])) {
                $search = tep_db_prepare_input($_GET['search']);

                $topics_query = tep_db_query("select t.topics_id, td.topics_name, t.parent_id, t.sort_order, t.date_added, t.last_modified from ".TABLE_TOPICS." t, ".TABLE_TOPICS_DESCRIPTION." td where t.topics_id = td.topics_id and td.language_id = '".(int) $languages_id."' and td.topics_name like '%".tep_db_input($search)."%' order by t.sort_order, td.topics_name");
            } else {
                $topics_query = tep_db_query("select t.topics_id, td.topics_name, t.parent_id, t.sort_order, t.date_added, t.last_modified from ".TABLE_TOPICS." t, ".TABLE_TOPICS_DESCRIPTION." td where t.parent_id = '".(int) $current_topic_id."' and t.topics_id = td.topics_id and td.language_id = '".(int) $languages_id."' order by t.sort_order, td.topics_name");
            }
            while ($topics = tep_db_fetch_array($topics_query)) {
                $topics_count++;
                $rows++;
// Get parent_id for subtopics if search
                if (isset($_GET['search'])) $tPath = $topics['parent_id'];

                if ((!isset($_GET['tID']) && !isset($_GET['aID']) || (isset($_GET['tID'])
                    && ($_GET['tID'] == $topics['topics_id']))) && !isset($tInfo)
                    && (substr($action, 0, 3) != 'new')) {
                    $topic_childs   = array('childs_count' => tep_childs_in_topic_count($topics['topics_id']));
                    $topic_articles = array('articles_count' => tep_articles_in_topic_count($topics['topics_id']));

                    $tInfo_array = array_merge($topics, $topic_childs,
                        $topic_articles);
                    $tInfo       = new objectInfo($tInfo_array);
                }

                if (isset($tInfo) && is_object($tInfo) && ($topics['topics_id'] == $tInfo->topics_id)) {
                    echo '              <tr id="defaultSelected" class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\''.tep_href_link(FILENAME_ARTICLES,
                        tep_get_topic_path($topics['topics_id'])).'\'">'."\n";
                } else {
                    echo '              <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\''.tep_href_link(FILENAME_ARTICLES,
                        'tPath='.$tPath.'&tID='.$topics['topics_id']).'\'">'."\n";
                }
                ?>
                                                    <td class="dataTableContent"><?php echo '<a href="'.tep_href_link(FILENAME_ARTICLES,
                    tep_get_topic_path($topics['topics_id'])).'">'.tep_image(DIR_WS_ICONS.'folder.gif',
                    ICON_FOLDER).'</a>&nbsp;<b>'.$topics['topics_name'].'</b>'; ?></td>
                                                    <td class="dataTableContent" align="center">&nbsp;</td>
                                                    <td class="dataTableContent" align="center">&nbsp;</td>
                                                    <td class="dataTableContent" align="center"><?php echo $topics['sort_order']; ?></td>
                                                    <td class="dataTableContent" align="right"><?php if (isset($tInfo)
                    && is_object($tInfo) && ($topics['topics_id'] == $tInfo->topics_id)) {
                    echo tep_image(DIR_WS_IMAGES.'icon_arrow_right.gif', '');
                } else {
                    echo '<a href="'.tep_href_link(FILENAME_ARTICLES,
                        'tPath='.$tPath.'&tID='.$topics['topics_id']).'">'.tep_image(DIR_WS_IMAGES.'icon_info.gif',
                        IMAGE_ICON_INFO).'</a>';
                } ?>&nbsp;</td>
                                        </tr>
        <?php
    }

    $articles_count = 0;
    if (isset($_GET['search'])) {
        $articles_query = tep_db_query("select a.articles_id, ad.articles_name, a.articles_date_added, a.articles_last_modified, a.articles_date_available, a.articles_status, a.articles_is_blog, a.articles_sort_order, a2t.topics_id from ".TABLE_ARTICLES." a, ".TABLE_ARTICLES_DESCRIPTION." ad, ".TABLE_ARTICLES_TO_TOPICS." a2t where a.articles_id = ad.articles_id and ad.language_id = '".(int) $languages_id."' and a.articles_id = a2t.articles_id and ad.articles_name like '%".tep_db_input($search)."%' order by ad.articles_name");
    } else {
        $articles_query = tep_db_query("select a.articles_id, ad.articles_name, a.articles_date_added, a.articles_last_modified, a.articles_date_available, a.articles_status, a.articles_is_blog, a.articles_sort_order from ".TABLE_ARTICLES." a, ".TABLE_ARTICLES_DESCRIPTION." ad, ".TABLE_ARTICLES_TO_TOPICS." a2t where a.articles_id = ad.articles_id and ad.language_id = '".(int) $languages_id."' and a.articles_id = a2t.articles_id and a2t.topics_id = '".(int) $current_topic_id."' order by ad.articles_name");
    }
    while ($articles = tep_db_fetch_array($articles_query)) {
        $articles_count++;
        $rows++;

// Get topics_id for article if search
        if (isset($_GET['search'])) $tPath = $articles['topics_id'];

        if ((!isset($_GET['aID']) && !isset($_GET['tID']) || (isset($_GET['aID'])
            && ($_GET['aID'] == $articles['articles_id']))) && !isset($aInfo) && !isset($tInfo)
            && (substr($action, 0, 3) != 'new')) {
// find out the rating average from customer reviews
            $reviews_query = tep_db_query("select (avg(reviews_rating) / 5 * 100) as average_rating from ".TABLE_ARTICLE_REVIEWS." where articles_id = '".(int) $articles['articles_id']."'");
            $reviews       = tep_db_fetch_array($reviews_query);
            $aInfo_array   = array_merge($articles, $reviews);
            $aInfo         = new objectInfo($aInfo_array);
        }

        if (isset($aInfo) && is_object($aInfo) && ($articles['articles_id'] == $aInfo->articles_id)) {
            echo '              <tr id="defaultSelected" class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\''.tep_href_link(FILENAME_ARTICLES,
                'tPath='.$tPath.'&aID='.$articles['articles_id'].'&action=article_preview&read=only').'\'">'."\n";
        } else {
            echo '              <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\''.tep_href_link(FILENAME_ARTICLES,
                'tPath='.$tPath.'&aID='.$articles['articles_id']).'\'">'."\n";
        }
        ?>
                                        <td class="dataTableContent"><?php echo '<a href="'.tep_href_link(FILENAME_ARTICLES,
            'tPath='.$tPath.'&aID='.$articles['articles_id'].'&action=article_preview&read=only').'">'.tep_image(DIR_WS_ICONS.'preview.gif',
            ICON_PREVIEW).'</a>&nbsp;'.$articles['articles_name']; ?></td>
                                        <td class="dataTableContent" align="center">
        <?php
        if ($articles['articles_status'] == '1') {
            echo tep_image(DIR_WS_IMAGES.'icon_status_green.gif',
                IMAGE_ICON_STATUS_GREEN, 10, 10).'&nbsp;&nbsp;<a href="'.tep_href_link(FILENAME_ARTICLES,
                'action=setflag&flag=0&aID='.$articles['articles_id'].'&tPath='.$tPath).'">'.tep_image(DIR_WS_IMAGES.'icon_status_red_light.gif',
                IMAGE_ICON_STATUS_RED_LIGHT, 10, 10).'</a>';
        } else {
            echo '<a href="'.tep_href_link(FILENAME_ARTICLES,
                'action=setflag&flag=1&aID='.$articles['articles_id'].'&tPath='.$tPath).'">'.tep_image(DIR_WS_IMAGES.'icon_status_green_light.gif',
                IMAGE_ICON_STATUS_GREEN_LIGHT, 10, 10).'</a>&nbsp;&nbsp;'.tep_image(DIR_WS_IMAGES.'icon_status_red.gif',
                IMAGE_ICON_STATUS_RED, 10, 10);
        }
        ?></td>
                                        <td class="dataTableContent" align="center">
        <?php
        if ($articles['articles_is_blog'] == '1') {
            echo tep_image(DIR_WS_IMAGES.'icon_status_green.gif',
                IMAGE_ICON_STATUS_GREEN, 10, 10).'&nbsp;&nbsp;<a href="'.tep_href_link(FILENAME_ARTICLES,
                'action=setflagblog&flagblog=0&aID='.$articles['articles_id'].'&tPath='.$tPath).'">'.tep_image(DIR_WS_IMAGES.'icon_status_red_light.gif',
                IMAGE_ICON_STATUS_RED_LIGHT, 10, 10).'</a>';
        } else {
            echo '<a href="'.tep_href_link(FILENAME_ARTICLES,
                'action=setflagblog&flagblog=1&aID='.$articles['articles_id'].'&tPath='.$tPath).'">'.tep_image(DIR_WS_IMAGES.'icon_status_green_light.gif',
                IMAGE_ICON_STATUS_GREEN_LIGHT, 10, 10).'</a>&nbsp;&nbsp;'.tep_image(DIR_WS_IMAGES.'icon_status_red.gif',
                IMAGE_ICON_STATUS_RED, 10, 10);
        }
        ?></td>
                                        <td class="dataTableContent" align="center"><?php echo $articles['articles_sort_order']; ?></td>
                                        <td class="dataTableContent" align="right"><?php if (isset($aInfo)
            && is_object($aInfo) && ($articles['articles_id'] == $aInfo->articles_id)) {
            echo tep_image(DIR_WS_IMAGES.'icon_arrow_right.gif', '');
        } else {
            echo '<a href="'.tep_href_link(FILENAME_ARTICLES,
                'tPath='.$tPath.'&aID='.$articles['articles_id']).'">'.tep_image(DIR_WS_IMAGES.'icon_info.gif',
                IMAGE_ICON_INFO).'</a>';
        } ?>&nbsp;</td>
                            </tr>
        <?php
    }

    $tPath_back = '';
    if (sizeof($tPath_array) > 0) {
        for ($i = 0, $n = sizeof($tPath_array) - 1; $i < $n; $i++) {
            if (empty($tPath_back)) {
                $tPath_back .= $tPath_array[$i];
            } else {
                $tPath_back .= '_'.$tPath_array[$i];
            }
        }
    }

    $tPath_back = (tep_not_null($tPath_back)) ? 'tPath='.$tPath_back.'&' : '';
    ?>
                        <tr>
                            <td colspan="3"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                                    <tr>
                                        <td class="smallText"><?php echo TEXT_TOPICS.'&nbsp;'.$topics_count.'<br>'.TEXT_ARTICLES.'&nbsp;'.$articles_count; ?></td>
                                        <td align="right" class="smallText"><?php if (sizeof($tPath_array)
        > 0) echo '<a href="'.tep_href_link(FILENAME_ARTICLES,
            $tPath_back.'tID='.$current_topic_id).'">'.tep_image_button('button_back.gif',
            IMAGE_BACK).'</a>&nbsp;';
    if (!isset($_GET['search'])) echo '<a href="'.tep_href_link(FILENAME_ARTICLES,
            'tPath='.$tPath.'&action=new_topic').'">'.tep_image_button('button_new_topic.gif',
            IMAGE_NEW_TOPIC).'</a>&nbsp;<a href="'.tep_href_link(FILENAME_ARTICLES,
            'tPath='.$tPath.'&action=new_article').'">'.tep_image_button('button_new_article.gif',
            IMAGE_NEW_ARTICLE).'</a>'; ?>&nbsp;</td>
                                    </tr>
                                </table></td>
                        </tr>
                    </table></td>
    <?php
    $heading    = array();
    $contents   = array();
    switch ($action) {
        case 'new_topic':
            $heading[] = array('text' => '<b>'.TEXT_INFO_HEADING_NEW_TOPIC.'</b>');

            $contents   = array('form' => tep_draw_form('newtopic',
                    FILENAME_ARTICLES, 'action=insert_topic&tPath='.$tPath,
                    'post', 'enctype="multipart/form-data"'));
            $contents[] = array('text' => TEXT_NEW_TOPIC_INTRO);

            $topic_inputs_string = '';
            $languages           = tep_get_languages();
            for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
                $topic_inputs_string .= '<br>'.tep_image(DIR_WS_CATALOG_LANGUAGES.$languages[$i]['directory'].'/images/'.$languages[$i]['image'],
                        $languages[$i]['name']).'&nbsp;'.tep_draw_input_field('topics_name['.$languages[$i]['id'].']');
            }

            $contents[] = array('text' => '<br>'.TEXT_TOPICS_NAME.$topic_inputs_string);
            $contents[] = array('text' => '<br>'.TEXT_SORT_ORDER.'<br>'.tep_draw_input_field('sort_order',
                    '', 'size="2"'));
            $contents[] = array('align' => 'center', 'text' => '<br>'.tep_image_submit('button_save.gif',
                    IMAGE_SAVE).' <a href="'.tep_href_link(FILENAME_ARTICLES,
                    'tPath='.$tPath).'">'.tep_image_button('button_cancel.gif',
                    IMAGE_CANCEL).'</a>');
            break;
        case 'edit_topic':
            $heading[]  = array('text' => '<b>'.TEXT_INFO_HEADING_EDIT_TOPIC.'</b>');

            $contents   = array('form' => tep_draw_form('topics',
                    FILENAME_ARTICLES, 'action=update_topic&tPath='.$tPath,
                    'post', 'enctype="multipart/form-data"').tep_draw_hidden_field('topics_id',
                    $tInfo->topics_id));
            $contents[] = array('text' => TEXT_EDIT_INTRO);

            $topic_inputs_string = '';
            $languages           = tep_get_languages();
            for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
                $topic_inputs_string .= '<br>'.tep_image(DIR_WS_CATALOG_LANGUAGES.$languages[$i]['directory'].'/images/'.$languages[$i]['image'],
                        $languages[$i]['name']).'&nbsp;'.tep_draw_input_field('topics_name['.$languages[$i]['id'].']',
                        tep_get_topic_name($tInfo->topics_id,
                            $languages[$i]['id']));
            }

            $contents[] = array('text' => '<br>'.TEXT_EDIT_TOPICS_NAME.$topic_inputs_string);
            $contents[] = array('text' => '<br>'.TEXT_EDIT_SORT_ORDER.'<br>'.tep_draw_input_field('sort_order',
                    $tInfo->sort_order, 'size="2"'));
            $contents[] = array('align' => 'center', 'text' => '<br>'.tep_image_submit('button_save.gif',
                    IMAGE_SAVE).' <a href="'.tep_href_link(FILENAME_ARTICLES,
                    'tPath='.$tPath.'&tID='.$tInfo->topics_id).'">'.tep_image_button('button_cancel.gif',
                    IMAGE_CANCEL).'</a>');
            break;
        case 'delete_topic':
            $heading[]  = array('text' => '<b>'.TEXT_INFO_HEADING_DELETE_TOPIC.'</b>');

            $contents   = array('form' => tep_draw_form('topics',
                    FILENAME_ARTICLES,
                    'action=delete_topic_confirm&tPath='.$tPath).tep_draw_hidden_field('topics_id',
                    $tInfo->topics_id));
            $contents[] = array('text' => TEXT_DELETE_TOPIC_INTRO);
            $contents[] = array('text' => '<br><b>'.$tInfo->topics_name.'</b>');
            if ($tInfo->childs_count > 0)
                    $contents[] = array('text' => '<br>'.sprintf(TEXT_DELETE_WARNING_CHILDS,
                        $tInfo->childs_count));
            if ($tInfo->articles_count > 0)
                    $contents[] = array('text' => '<br>'.sprintf(TEXT_DELETE_WARNING_ARTICLES,
                        $tInfo->articles_count));
            $contents[] = array('align' => 'center', 'text' => '<br>'.tep_image_submit('button_delete.gif',
                    IMAGE_DELETE).' <a href="'.tep_href_link(FILENAME_ARTICLES,
                    'tPath='.$tPath.'&tID='.$tInfo->topics_id).'">'.tep_image_button('button_cancel.gif',
                    IMAGE_CANCEL).'</a>');
            break;
        case 'move_topic':
            $heading[]  = array('text' => '<b>'.TEXT_INFO_HEADING_MOVE_TOPIC.'</b>');

            $contents   = array('form' => tep_draw_form('topics',
                    FILENAME_ARTICLES,
                    'action=move_topic_confirm&tPath='.$tPath).tep_draw_hidden_field('topics_id',
                    $tInfo->topics_id));
            $contents[] = array('text' => sprintf(TEXT_MOVE_TOPICS_INTRO,
                    $tInfo->topics_name));
            $contents[] = array('text' => '<br>'.sprintf(TEXT_MOVE,
                    $tInfo->topics_name).'<br>'.tep_draw_pull_down_menu('move_to_topic_id',
                    tep_get_topic_tree(), $current_topic_id));
            $contents[] = array('align' => 'center', 'text' => '<br>'.tep_image_submit('button_move.gif',
                    IMAGE_MOVE).' <a href="'.tep_href_link(FILENAME_ARTICLES,
                    'tPath='.$tPath.'&tID='.$tInfo->topics_id).'">'.tep_image_button('button_cancel.gif',
                    IMAGE_CANCEL).'</a>');
            break;
        case 'delete_article':
            $heading[]  = array('text' => '<b>'.TEXT_INFO_HEADING_DELETE_ARTICLE.'</b>');

            $contents   = array('form' => tep_draw_form('articles',
                    FILENAME_ARTICLES,
                    'action=delete_article_confirm&tPath='.$tPath).tep_draw_hidden_field('articles_id',
                    $aInfo->articles_id));
            $contents[] = array('text' => TEXT_DELETE_ARTICLE_INTRO);
            $contents[] = array('text' => '<br><b>'.$aInfo->articles_name.'</b>');

            $article_topics_string = '';
            $article_topics        = tep_generate_topic_path($aInfo->articles_id,
                'article');
            for ($i = 0, $n = sizeof($article_topics); $i < $n; $i++) {
                $topic_path = '';
                for ($j = 0, $k = sizeof($article_topics[$i]); $j < $k; $j++) {
                    $topic_path .= $article_topics[$i][$j]['text'].'&nbsp;&gt;&nbsp;';
                }
                $topic_path            = substr($topic_path, 0, -16);
                $article_topics_string .= tep_draw_checkbox_field('article_topics[]',
                        $article_topics[$i][sizeof($article_topics[$i]) - 1]['id'],
                        true).'&nbsp;'.$topic_path.'<br>';
            }
            $article_topics_string = substr($article_topics_string, 0, -4);

            $contents[] = array('text' => '<br>'.$article_topics_string);
            $contents[] = array('align' => 'center', 'text' => '<br>'.tep_image_submit('button_delete.gif',
                    IMAGE_DELETE).' <a href="'.tep_href_link(FILENAME_ARTICLES,
                    'tPath='.$tPath.'&aID='.$aInfo->articles_id).'">'.tep_image_button('button_cancel.gif',
                    IMAGE_CANCEL).'</a>');
            break;
        case 'move_article':
            $heading[]  = array('text' => '<b>'.TEXT_INFO_HEADING_MOVE_ARTICLE.'</b>');

            $contents   = array('form' => tep_draw_form('articles',
                    FILENAME_ARTICLES,
                    'action=move_article_confirm&tPath='.$tPath).tep_draw_hidden_field('articles_id',
                    $aInfo->articles_id));
            $contents[] = array('text' => sprintf(TEXT_MOVE_ARTICLES_INTRO,
                    $aInfo->articles_name));
            $contents[] = array('text' => '<br>'.TEXT_INFO_CURRENT_TOPICS.'<br><b>'.tep_output_generated_topic_path($aInfo->articles_id,
                    'article').'</b>');
            $contents[] = array('text' => '<br>'.sprintf(TEXT_MOVE,
                    $aInfo->articles_name).'<br>'.tep_draw_pull_down_menu('move_to_topic_id',
                    tep_get_topic_tree(), $current_topic_id));
            $contents[] = array('align' => 'center', 'text' => '<br>'.tep_image_submit('button_move.gif',
                    IMAGE_MOVE).' <a href="'.tep_href_link(FILENAME_ARTICLES,
                    'tPath='.$tPath.'&aID='.$aInfo->articles_id).'">'.tep_image_button('button_cancel.gif',
                    IMAGE_CANCEL).'</a>');
            break;
        case 'copy_to':
            $heading[]  = array('text' => '<b>'.TEXT_INFO_HEADING_COPY_TO.'</b>');

            $contents   = array('form' => tep_draw_form('copy_to',
                    FILENAME_ARTICLES, 'action=copy_to_confirm&tPath='.$tPath).tep_draw_hidden_field('articles_id',
                    $aInfo->articles_id));
            $contents[] = array('text' => TEXT_INFO_COPY_TO_INTRO);
            $contents[] = array('text' => '<br>'.TEXT_INFO_CURRENT_TOPICS.'<br><b>'.tep_output_generated_topic_path($aInfo->articles_id,
                    'article').'</b>');
            $contents[] = array('text' => '<br>'.TEXT_TOPICS.'<br>'.tep_draw_pull_down_menu('topics_id',
                    tep_get_topic_tree(), $current_topic_id));
            $contents[] = array('text' => '<br>'.TEXT_HOW_TO_COPY.'<br>'.tep_draw_radio_field('copy_as',
                    'link', true).' '.TEXT_COPY_AS_LINK.'<br>'.tep_draw_radio_field('copy_as',
                    'duplicate').' '.TEXT_COPY_AS_DUPLICATE);
            $contents[] = array('align' => 'center', 'text' => '<br>'.tep_image_submit('button_copy.gif',
                    IMAGE_COPY).' <a href="'.tep_href_link(FILENAME_ARTICLES,
                    'tPath='.$tPath.'&aID='.$aInfo->articles_id).'">'.tep_image_button('button_cancel.gif',
                    IMAGE_CANCEL).'</a>');
            break;

        default:
            if ($rows > 0) {
                if (isset($tInfo) && is_object($tInfo)) { // topic info box contents
                    $heading[] = array('text' => '<b>'.$tInfo->topics_name.'</b>');

                    $contents[] = array('align' => 'center', 'text' => '<a href="'.tep_href_link(FILENAME_ARTICLES,
                            'tPath='.$tPath.'&tID='.$tInfo->topics_id.'&action=edit_topic').'">'.tep_image_button('button_edit.gif',
                            IMAGE_EDIT).'</a> <a href="'.tep_href_link(FILENAME_ARTICLES,
                            'tPath='.$tPath.'&tID='.$tInfo->topics_id.'&action=delete_topic').'">'.tep_image_button('button_delete.gif',
                            IMAGE_DELETE).'</a> <a href="'.tep_href_link(FILENAME_ARTICLES,
                            'tPath='.$tPath.'&tID='.$tInfo->topics_id.'&action=move_topic').'">'.tep_image_button('button_move.gif',
                            IMAGE_MOVE).'</a>');
                    $contents[] = array('text' => '<br>'.TEXT_DATE_ADDED.' '.tep_date_short($tInfo->date_added));
                    if (tep_not_null($tInfo->last_modified))
                            $contents[] = array('text' => TEXT_LAST_MODIFIED.' '.tep_date_short($tInfo->last_modified));
                    $contents[] = array('text' => '<br>'.TEXT_SUBTOPICS.' '.$tInfo->childs_count.'<br>'.TEXT_ARTICLES.' '.$tInfo->articles_count);
                } elseif (isset($aInfo) && is_object($aInfo)) { // article info box contents
                    $heading[] = array('text' => '<b>'.tep_get_articles_name($aInfo->articles_id,
                            $languages_id).'</b>');

                    $contents[] = array('align' => 'center', 'text' => '<a href="'.tep_href_link(FILENAME_ARTICLES,
                            'tPath='.$tPath.'&aID='.$aInfo->articles_id.'&action=new_article').'">'.tep_image_button('button_edit.gif',
                            IMAGE_EDIT).'</a> <a href="'.tep_href_link(FILENAME_ARTICLES,
                            'tPath='.$tPath.'&aID='.$aInfo->articles_id.'&action=delete_article').'">'.tep_image_button('button_delete.gif',
                            IMAGE_DELETE).'</a> <a href="'.tep_href_link(FILENAME_ARTICLES,
                            'tPath='.$tPath.'&aID='.$aInfo->articles_id.'&action=move_article').'">'.tep_image_button('button_move.gif',
                            IMAGE_MOVE).'</a> <a href="'.tep_href_link(FILENAME_ARTICLES,
                            'tPath='.$tPath.'&aID='.$aInfo->articles_id.'&action=copy_to').'">'.tep_image_button('button_copy_to.gif',
                            IMAGE_COPY_TO).'</a>');
                    $contents[] = array('text' => '<br>'.TEXT_DATE_ADDED.' '.tep_date_short($aInfo->articles_date_added));
                    if (tep_not_null($aInfo->articles_last_modified))
                            $contents[] = array('text' => TEXT_LAST_MODIFIED.' '.tep_date_short($aInfo->articles_last_modified));
                    if (date('Y-m-d') < $aInfo->articles_date_available)
                            $contents[] = array('text' => TEXT_DATE_AVAILABLE.' '.tep_date_short($aInfo->articles_date_available));
                    $contents[] = array('text' => '<br>'.TEXT_ARTICLES_AVERAGE_RATING.' '.number_format($aInfo->average_rating,
                            2).'%');
                }
            } else { // create topic/article info
                $heading[] = array('text' => '<b>'.EMPTY_TOPIC.'</b>');

                $contents[] = array('text' => TEXT_NO_CHILD_TOPICS_OR_ARTICLES);
            }
            break;
    }

    if ((tep_not_null($heading)) && (tep_not_null($contents))) {
        echo '            <td width="25%" valign="top">'."\n";

        $box = new box;
        echo $box->infoBox($heading, $contents);

        echo '            </td>'."\n";
    }
    ?>
        </tr>
    </table></td>
    </tr>
    </table>
    <?php
}
?>
</td>
</tr>
</table>

<?php
require(DIR_WS_INCLUDES.'template_bottom.php');
require(DIR_WS_INCLUDES.'application_bottom.php');
?>
