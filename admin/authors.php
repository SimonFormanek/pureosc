<?php
/*
  $Id: authors.php, v1.0 2003/12/04 12:00:00 ra Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce
  Portions Copyright 2009 http://www.oscommerce-solution.com

  Released under the GNU General Public License
 */

require('includes/application_top.php');
require_once('includes/functions/articles.php');

$action = (isset($_GET['action']) ? $_GET['action'] : '');

if (tep_not_null($action)) {

    switch ($action) {
        case 'insert':
        case 'save':
            if (isset($_GET['auID']))
                    $authors_id   = tep_db_prepare_input($_GET['auID']);
            $authors_name = tep_db_prepare_input($_POST['authors_name']);

            $authorsImg    = '';
            $authors_image = new upload('authors_image');
            $authors_image->set_destination(DIR_FS_CATALOG_IMAGES.'article_manager_uploads/');

            if ($authors_image->parse() && $authors_image->save()) {
                $authorsImg = tep_db_input($authors_image->filename);
            }

            $sql_data_array = array('authors_name' => $authors_name,
                'authors_image' => $authorsImg,
            );

            if ($action == 'insert') {
                $insert_sql_data = array('date_added' => 'now()');

                $sql_data_array = array_merge($sql_data_array, $insert_sql_data);

                tep_db_perform(TABLE_AUTHORS, $sql_data_array);
                $authors_id = tep_db_insert_id();
            } elseif ($action == 'save') {
                $update_sql_data = array('last_modified' => 'now()');

                $sql_data_array = array_merge($sql_data_array, $update_sql_data);

                tep_db_perform(TABLE_AUTHORS, $sql_data_array, 'update',
                    "authors_id = '".(int) $authors_id."'");
            }

            $languages = tep_get_languages();
            for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
                $authors_desc_array = $_POST['authors_description'];
                $authors_url_array  = $_POST['authors_url'];
                $language_id        = $languages[$i]['id'];

                $sql_data_array = array('authors_description' => tep_db_prepare_input($authors_desc_array[$language_id]),
                    'authors_url' => tep_db_prepare_input($authors_url_array[$language_id]));

                if ($action == 'insert') {
                    $insert_sql_data = array('authors_id' => $authors_id,
                        'languages_id' => $language_id);

                    $sql_data_array = array_merge($sql_data_array,
                        $insert_sql_data);

                    tep_db_perform(TABLE_AUTHORS_INFO, $sql_data_array);
                } elseif ($action == 'save') {
                    tep_db_perform(TABLE_AUTHORS_INFO, $sql_data_array,
                        'update',
                        "authors_id = '".(int) $authors_id."' and languages_id = '".(int) $language_id."'");
                }
            }

            if (USE_CACHE == 'true') {
                tep_reset_cache_block('authors');
            }

            tep_redirect(tep_href_link(FILENAME_AUTHORS,
                    (isset($_GET['page']) ? 'page='.$_GET['page'].'&' : '').'auID='.$authors_id));
            break;
        case 'deleteconfirm':
            $authors_id = tep_db_prepare_input($_GET['auID']);

            tep_db_query("delete from ".TABLE_AUTHORS." where authors_id = '".(int) $authors_id."'");
            tep_db_query("delete from ".TABLE_AUTHORS_INFO." where authors_id = '".(int) $authors_id."'");

            if (isset($_POST['delete_articles']) && ($_POST['delete_articles'] == 'on')) {
                $articles_query = tep_db_query("select articles_id from ".TABLE_ARTICLES." where authors_id = '".(int) $authors_id."'");
                while ($articles       = tep_db_fetch_array($articles_query)) {
                    tep_remove_article($articles['articles_id']);
                }
            } else {
                tep_db_query("update ".TABLE_ARTICLES." set authors_id = '' where authors_id = '".(int) $authors_id."'");
            }

            if (USE_CACHE == 'true') {
                tep_reset_cache_block('authors');
            }

            tep_redirect(tep_href_link(FILENAME_AUTHORS, 'page='.$_GET['page']));
            break;
    }
}
//display error message if at least one author doesn't exist
if (isset($_GET['no_authors']) && $_GET['no_authors'] == 'true') {
    $messageStack->add(ERROR_NO_AUTHORS_FOUND, 'error');
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
                $str .= "authors_description[".$languages[$i]['id']."],";
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
    table.BorderedBoxWhite {border: ridge #ddd 3px; background-color: #eee; }
</style>

<table border="0" width="100%" cellspacing="0" cellpadding="2">
    <tr>
        <td width="<?php echo BOX_WIDTH; ?>" valign="top"><table border="0" width="<?php echo BOX_WIDTH; ?>" cellspacing="1" cellpadding="1" class="columnLeft">
                <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                        <?php
                        if ($action == 'new') {
                            ?>
                            <tr>
                                <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2" class="BorderedBoxWhite">
                                        <tr>
                                            <td class="pageHeading"><?php echo TEXT_HEADING_NEW_AUTHOR; ?></td>
                                        </tr>
                                        <tr>
                                            <td><?php echo tep_draw_separator('pixel_trans.gif',
                            '1', '10');
                            ?></td>
                                        </tr>
                                        <tr>
                                            <td class="main"><?php echo TEXT_NEW_INTRO; ?></td>
                                        </tr>
                                        <tr>
                                            <td><?php echo tep_draw_separator('pixel_trans.gif',
                                                '1', '10');
                                            ?></td>
                                        </tr>
                                    </table></td>
                            </tr>
                            <tr>
                                <td><?php echo tep_draw_separator('pixel_trans.gif',
                                                '1', '10');
                                            ?></td>
                            </tr>
                            <tr><?php
                                            echo tep_draw_form('authors',
                                                FILENAME_AUTHORS,
                                                'action=insert', 'post',
                                                'enctype="multipart/form-data"').tep_hide_session_id();
                                            ?>

                                <td><table border="0" cellspacing="0" cellpadding="2">
                                        <tr>
                                            <td class="smallText"><?php echo TEXT_AUTHORS_NAME; ?></td>
                                            <td class="smallText"><?php echo tep_draw_input_field('authors_name',
                                                '', 'size="20"');
                                            ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif',
                                                '1', '10');
                                            ?></td>
                                        </tr>
                                        <tr>
                                            <td class="smallText"><?php echo TEXT_AUTHORS_IMAGE; ?></td>
                                            <td><?php echo tep_draw_file_field('authors_image'); ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif',
                                        '1', '10');
                                    ?></td>
                                        </tr>
    <?php
    $languages = tep_get_languages();
    for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
        ?>
                                            <tr>
                                                <th class="smallText" align="left"><?php echo $languages[$i]['name']; ?></th>
                                            </tr>
                                            <tr>
                                                <td width="100%" colspan="2"><?php echo tep_black_line(); ?></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif',
                                                '1', '2');
        ?></td>
                                            </tr>
                                            <tr>
                                                <td class="smallText" valign="top" width="140"><?php echo TEXT_AUTHORS_DESCRIPTION; ?></td>
                                                <td>
                                                    <table border="0" cellspacing="0" cellpadding="0">
                                                        <tr>
                                                            <td class="smallText">
                                                                <?php
                                                                if (ARTICLE_ENABLE_HTML_EDITOR
                                                                    == 'No Editor')
                                                                        echo tep_draw_textarea_field('authors_description['.$languages[$i]['id'].']',
                                                                        'soft',
                                                                        '70',
                                                                        '15',
                                                                        (($authors_description[$languages[$i]['id']])
                                                                                ? stripslashes($authors_description[$languages[$i]['id']])
                                                                                : tep_get_author_description($aInfo->articles_id,
                                                                                $languages[$i]['id'])));
                                                                else {
                                                                    if (ARTICLE_ENABLE_HTML_EDITOR
                                                                        == 'FCKEditor') {
                                                                        echo tep_draw_fckeditor('authors_description['.$languages[$i]['id'].']',
                                                                            '700',
                                                                            '300',
                                                                            '');
                                                                    } else if (ARTICLE_ENABLE_HTML_EDITOR
                                                                        == 'CKEditor') {
                                                                        echo tep_draw_textarea_field('authors_description['.$languages[$i]['id'].']',
                                                                            'soft',
                                                                            '70',
                                                                            '15',
                                                                            '',
                                                                            'id = "authors_description['.$languages[$i]['id'].']" class="ckeditor"');
                                                                    } else {
                                                                        echo tep_draw_textarea_field('authors_description['.$languages[$i]['id'].']',
                                                                            'soft',
                                                                            '70',
                                                                            '15',
                                                                            '');
                                                                    }
                                                                }
                                                                ?>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            <tr>
                                            <tr>
                                                <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif',
                                                '1', '10');
                                                                ?></td>
                                            </tr>
                                            <tr>
                                                <td class="smallText" valign="top"><?php echo TEXT_AUTHORS_URL; ?></td>
                                                <td class="smallText" valign="top"><?php echo tep_draw_input_field('authors_url['.$languages[$i]['id'].']',
                            '', 'size="30"');
                        ?></td>
                                            <tr>
                                            <tr>
                                                <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif',
                            '1', '10');
                        ?></td>
                                            </tr>
                                                    <?php
                                                }
                                                ?>
                                        <tr>
                                            <td colspan="3" class="smallText" align="center"><?php
                                                echo tep_draw_separator('pixel_trans.gif',
                                                    '24', '15').'&nbsp;'.tep_image_submit('button_save.gif',
                                                    IMAGE_SAVE).' <a href="'.tep_href_link(FILENAME_AUTHORS,
                                                    'page='.$_GET['page'].'&auID='.$_GET['auID']).'">'.tep_image_button('button_cancel.gif',
                                                    IMAGE_CANCEL).'</a>';
                                                ?></td>
                                        </tr>
                                    </table></td>
                                </form>
                            </tr>
                                <?php
                            } elseif ($action == 'edit') {

                                $authors_query = tep_db_query("select authors_id, authors_name, authors_image from ".TABLE_AUTHORS." where authors_id = '".$_GET['auID']."'");
                                $authors       = tep_db_fetch_array($authors_query);
                                ?>
                            <tr>
                                <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2" class="BorderedBoxWhite">
                                        <tr>
                                            <td class="pageHeading"><?php echo TEXT_HEADING_EDIT_AUTHOR; ?></td>
                                            <td class="pageHeading" align="right"><?php echo tep_draw_separator('pixel_trans.gif',
                                                1, 10);
                                            ?></td>
                                        </tr>
                                        <tr>
                                            <td><?php echo tep_draw_separator('pixel_trans.gif',
                                                '1', '10');
                                            ?></td>
                                        </tr>
                                        <tr>
                                            <td class="main"><?php echo TEXT_EDIT_INTRO; ?></td>
                                        </tr>
                                        <tr>
                                            <td><?php echo tep_draw_separator('pixel_trans.gif',
                                                '1', '10');
                                            ?></td>
                                        </tr>
                                    </table></td>
                            </tr>
                            <tr>
                                <td><?php echo tep_draw_separator('pixel_trans.gif',
                                                '1', '10');
                                            ?></td>
                            </tr>
                            <tr><?php
                                            echo tep_draw_form('authors',
                                                FILENAME_AUTHORS,
                                                'page='.$_GET['page'].'&auID='.$authors['authors_id'].'&action=save',
                                                'post',
                                                'enctype="multipart/form-data"');
                                            ?>
                                <td><table border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td class="smallText"><?php echo TEXT_AUTHORS_NAME; ?></td>
                                            <td class="smallText"><?php
                                                            echo tep_draw_input_field('authors_name',
                                                                $authors['authors_name'],
                                                                'size="20"');
                                                            ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif',
                                                            '1', '10');
                                                            ?></td>
                                        </tr>
                                        <tr>
                                            <td class="smallText"><?php echo TEXT_AUTHORS_IMAGE; ?></td>
                                            <td><?php
                                                            echo tep_draw_input_field('authors_image_name',
                                                                $authors['authors_image'],
                                                                'disabled size="20"').'&nbsp;&nbsp;'.tep_draw_file_field('authors_image');
                                                            ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif',
                                                            '1', '10');
                                                            ?></td>
                                        </tr>
                                                            <?php
                                                            $languages     = tep_get_languages();
                                                            for ($i = 0, $n = sizeof($languages); $i
                                                                < $n; $i++) {
                                                                ?>
                                            <tr>
                                                <th class="smallText" align="left"><?php echo $languages[$i]['name']; ?></th>
                                            </tr>
                                            <tr>
                                                <td width="100%" colspan="2"><?php echo tep_black_line(); ?></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif',
                                                            '1', '2');
                                                        ?></td>
                                            </tr>
                                            <tr>
                                                <td class="smallText" valign="top" width="140"><?php echo TEXT_AUTHORS_DESCRIPTION; ?></td>
                                                <td>
                                                    <table border="0" cellspacing="0" cellpadding="0">
                                                        <tr>
                                                            <td class="smallText">
                                                    <?php
                                                    if (ARTICLE_ENABLE_HTML_EDITOR
                                                        == 'No Editor')
                                                            echo tep_draw_textarea_field('authors_description['.$languages[$i]['id'].']',
                                                            'soft', '70', '15',
                                                            (($authors_description[$languages[$i]['id']])
                                                                    ? stripslashes($authors_description[$languages[$i]['id']])
                                                                    : tep_get_author_description($authors['authors_id'],
                                                                    $languages[$i]['id'])));
                                                    else {
                                                        if (ARTICLE_ENABLE_HTML_EDITOR
                                                            == 'FCKEditor') {
                                                            echo tep_draw_fckeditor('authors_description['.$languages[$i]['id'].']',
                                                                '700', '300',
                                                                (isset($authors_description[$languages[$i]['id']])
                                                                        ? stripslashes($authors_description[$languages[$i]['id']])
                                                                        : tep_get_author_description($authors['authors_id'],
                                                                        $languages[$i]['id'])));
                                                        } else if (ARTICLE_ENABLE_HTML_EDITOR
                                                            == 'CKEditor') {
                                                            echo tep_draw_textarea_field('authors_description['.$languages[$i]['id'].']',
                                                                'soft', '70',
                                                                '15',
                                                                (($authors_description[$languages[$i]['id']])
                                                                        ? stripslashes($authors_description[$languages[$i]['id']])
                                                                        : tep_get_author_description($authors['authors_id'],
                                                                        $languages[$i]['id'])),
                                                                'id = "authors_description['.$languages[$i]['id'].']" class="ckeditor"');
                                                        } else {
                                                            echo tep_draw_textarea_field('authors_description['.$languages[$i]['id'].']',
                                                                'soft', '70',
                                                                '15',
                                                                (($authors_description[$languages[$i]['id']])
                                                                        ? stripslashes($authors_description[$languages[$i]['id']])
                                                                        : tep_get_author_description($authors['authors_id'],
                                                                        $languages[$i]['id'])));
                                                        }
                                                    }
                                                    ?>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            <tr>
                                            <tr>
                                                <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif',
                                    '1', '10');
                                ?></td>
                                            </tr>
                                            <tr>
                                                <td class="smallText" valign="top"><?php echo TEXT_AUTHORS_URL; ?></td>
                                                <td class="smallText" valign="top"><?php
                                echo tep_draw_input_field('authors_url['.$languages[$i]['id'].']',
                                    tep_get_author_url($authors['authors_id'],
                                        $languages[$i]['id']), 'size="30"');
                                ?></td>
                                            <tr>
                                            <tr>
                                                <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif',
                                    '1', '10');
                                                    ?></td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                        <tr>
                                            <td colspan="3" class="smallText" align="center"><?php
                                        echo tep_draw_separator('pixel_trans.gif',
                                            '24', '15').'&nbsp;'.tep_image_submit('button_save.gif',
                                            IMAGE_SAVE).' <a href="'.tep_href_link(FILENAME_AUTHORS,
                                            'page='.$_GET['page'].'&auID='.$authors['authors_id']).'">'.tep_image_button('button_cancel.gif',
                                            IMAGE_CANCEL).'</a>';
                                        ?></td>
                                        </tr>
                                    </table></td>
                                </form>
                            </tr>
                                                <?php
                                            } elseif ($action == 'preview') {

                                                $authors_query = tep_db_query("select authors_id, authors_name, authors_image from ".TABLE_AUTHORS." where authors_id = '".$_GET['auID']."' limit 1");
                                                $authors       = tep_db_fetch_array($authors_query)
                                                ?>
                            <tr>
                                <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td class="pageHeading"><?php echo TEXT_ARTICLE_BY.$authors['authors_name']; ?></td>
                                            <td align="right"><?php
                                                echo tep_image(DIR_WS_CATALOG_IMAGES.'article_manager_uploads/'.$authors['authors_image'],
                                                    HEADING_TITLE,
                                                    HEADING_IMAGE_WIDTH,
                                                    HEADING_IMAGE_HEIGHT);
                                                ?></td>
                                        </tr>
                                    </table></td>
                            </tr>
                            <tr>
                                <td><?php echo tep_draw_separator('pixel_trans.gif',
                            '1', '10');
                        ?></td>
                            </tr>
                            <tr>
                                <td><table border="0" cellspacing="0" cellpadding="2">
                                <?php
                                $languages     = tep_get_languages();
                                for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
                                    ?>
                                            <tr>
                                                <th class="smallText" colspan="2" valign="top" align="left"><?php echo TEXT_AUTHORS_DESCRIPTION.' - '.$languages[$i]['name']; ?></th>
                                            <tr>
                                            <tr>
                                                <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif',
                                '1', '10');
                                    ?></td>
                                            </tr>
                                            <tr>
                                                <td class="smallText" valign="top"><?php echo tep_get_author_description($authors['authors_id'],
                                $languages[$i]['id']);
                                    ?></td>
                                            <tr>
                                            <tr>
                                                <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif',
                                '1', '10');
                                    ?></td>
                                            </tr>
                                    <?php if (tep_not_null(tep_get_author_url($authors['authors_id'],
                                                $languages[$i]['id']))) {
                                        ?>
                                                <tr>
                                                    <td class="smallText" valign="top"><?php
                            echo sprintf(TEXT_MORE_INFORMATION,
                                tep_get_author_url($authors['authors_id'],
                                    $languages[$i]['id']));
                                        ?></td>
                                                <tr>
                                                <tr>
                                                    <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif',
                                    '1', '10');
                                        ?></td>
                                                </tr>
                        <?php } ?>
                        <?php
                    }
                    ?>
                                        <tr>
                                            <td class="smallText" colspan="2" align="right"><?php
                                        echo '<a href="'.tep_href_link(FILENAME_AUTHORS,
                                            'page='.$_GET['page'].'&auID='.$authors['authors_id']).'">'.tep_image_button('button_back.gif',
                                            IMAGE_BACK).'</a>';
                                        ?></td>
                                            </form>
                                        </tr>
                            </tr>
                        </table></td>
        </tr>
                <?php } else { ?>
        <tr>
            <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                    <tr>
                        <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
                        <td class="pageHeading" align="right"><?php echo tep_draw_separator('pixel_trans.gif',
                            '100%', 5);
                    ?></td>
                    </tr>
                </table></td>
        </tr>
        <tr>
            <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
                    <tr>
                        <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                                <tr class="dataTableHeadingRow">
                                    <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_AUTHORS; ?></td>
                                    <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_ACTION; ?>&nbsp;</td>
                                </tr>
            <?php
            $authors_query_raw = "select authors_id, authors_name, date_added, last_modified from ".TABLE_AUTHORS." order by authors_name";
            $authors_split     = new splitPageResults($_GET['page'],
                MAX_DISPLAY_SEARCH_RESULTS, $authors_query_raw,
                $authors_query_numrows);
            $authors_query     = tep_db_query($authors_query_raw);
            while ($authors           = tep_db_fetch_array($authors_query)) {
                if ((!isset($_GET['auID']) || (isset($_GET['auID']) && ($_GET['auID']
                    == $authors['authors_id']))) && !isset($auInfo) && (substr($action,
                        0, 3) != 'new')) {
                    $author_articles_query = tep_db_query("select count(*) as articles_count from ".TABLE_ARTICLES." where authors_id = '".(int) $authors['authors_id']."'");
                    $author_articles       = tep_db_fetch_array($author_articles_query);

                    $auInfo_array = array_merge($authors, $author_articles);
                    $auInfo       = new objectInfo($auInfo_array);
                }

                if (isset($auInfo) && is_object($auInfo) && ($authors['authors_id']
                    == $auInfo->authors_id)) {
                    echo '              <tr id="defaultSelected" class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\''.tep_href_link(FILENAME_AUTHORS,
                        'page='.$_GET['page'].'&auID='.$authors['authors_id'].'&action=edit').'\'">'."\n";
                } else {
                    echo '              <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\''.tep_href_link(FILENAME_AUTHORS,
                        'page='.$_GET['page'].'&auID='.$authors['authors_id']).'\'">'."\n";
                }
                ?>
                                    <td class="dataTableContent"><?php echo $authors['authors_name']; ?></td>
                                    <td class="dataTableContent" align="right"><?php
                if (isset($auInfo) && is_object($auInfo) && ($authors['authors_id']
                    == $auInfo->authors_id)) {
                    echo tep_image(DIR_WS_IMAGES.'icon_arrow_right.gif');
                } else {
                    echo '<a href="'.tep_href_link(FILENAME_AUTHORS,
                        'page='.$_GET['page'].'&auID='.$authors['authors_id']).'">'.tep_image(DIR_WS_IMAGES.'icon_info.gif',
                        IMAGE_ICON_INFO).'</a>';
                }
                ?>&nbsp;</td>
                        </tr>
                <?php
            }
            ?>
                    <tr>
                        <td colspan="2"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                                <tr>
                                    <td class="smallText" valign="top"><?php
        echo $authors_split->display_count($authors_query_numrows,
            MAX_DISPLAY_SEARCH_RESULTS, $_GET['page'],
            TEXT_DISPLAY_NUMBER_OF_AUTHORS);
            ?></td>
                                    <td class="smallText" align="right"><?php echo $authors_split->display_links($authors_query_numrows,
        MAX_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $_GET['page']);
    ?></td>
                                </tr>
                            </table></td>
                    </tr>
    <?php
    if (empty($action)) {
        ?>
                        <tr>
                            <td align="right" colspan="2" class="smallText"><?php
        echo '<a href="'.tep_href_link(FILENAME_AUTHORS,
            'page='.$_GET['page'].'&auID='.$auInfo->authors_id.'&action=new').'">'.tep_image_button('button_insert.gif',
            IMAGE_INSERT).'</a>';
        ?></td>
                        </tr>
        <?php
    }
    ?>
                </table></td>
    <?php
    $heading  = array();
    $contents = array();

    switch ($action) {
        case 'delete':
            $heading[] = array('text' => '<b>'.TEXT_HEADING_DELETE_AUTHOR.'</b>');

            $contents   = array('form' => tep_draw_form('authors',
                    FILENAME_AUTHORS,
                    'page='.$_GET['page'].'&auID='.$auInfo->authors_id.'&action=deleteconfirm'));
            $contents[] = array('text' => TEXT_DELETE_INTRO);
            $contents[] = array('text' => '<br><b>'.$auInfo->authors_name.'</b>');

            if ($auInfo->articles_count > 0) {
                $contents[] = array('text' => '<br>'.tep_draw_checkbox_field('delete_articles').' '.TEXT_DELETE_ARTICLES);
                $contents[] = array('text' => '<br>'.sprintf(TEXT_DELETE_WARNING_ARTICLES,
                        $auInfo->articles_count));
            }

            $contents[] = array('align' => 'center', 'text' => '<br>'.tep_image_submit('button_delete.gif',
                    IMAGE_DELETE).' <a href="'.tep_href_link(FILENAME_AUTHORS,
                    'page='.$_GET['page'].'&auID='.$auInfo->authors_id).'">'.tep_image_button('button_cancel.gif',
                    IMAGE_CANCEL).'</a>');
            break;
        default:
            if (isset($auInfo) && is_object($auInfo)) {
                $heading[] = array('text' => '<b>'.$auInfo->authors_name.'</b>');

                $contents[] = array('align' => 'center', 'text' => '<a href="'.tep_href_link(FILENAME_AUTHORS,
                        'page='.$_GET['page'].'&auID='.$auInfo->authors_id.'&action=edit').'">'.tep_image_button('button_edit.gif',
                        IMAGE_EDIT).'</a> <a href="'.tep_href_link(FILENAME_AUTHORS,
                        'page='.$_GET['page'].'&auID='.$auInfo->authors_id.'&action=delete').'">'.tep_image_button('button_delete.gif',
                        IMAGE_DELETE).'</a><br>'.' <a href="'.tep_href_link(FILENAME_AUTHORS,
                        'page='.$_GET['page'].'&auID='.$_GET['auID']).'&action=preview'.'">'.tep_image_button('button_preview.gif',
                        IMAGE_PREVIEW).'</a>');
                $contents[] = array('text' => '<br>'.TEXT_DATE_ADDED.' '.tep_date_short($auInfo->date_added));
                if (tep_not_null($auInfo->last_modified))
                        $contents[] = array('text' => TEXT_LAST_MODIFIED.' '.tep_date_short($auInfo->last_modified));
                $contents[] = array('text' => '<br>'.TEXT_ARTICLES.' '.$auInfo->articles_count);
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
    <?php
}
?>
</table></td>
</tr>
</table>

<?php
require(DIR_WS_INCLUDES.'template_bottom.php');
require(DIR_WS_INCLUDES.'application_bottom.php');
?>
