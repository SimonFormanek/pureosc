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
    $articles_id = tep_db_prepare_input($_GET['comID']);
    $languages = tep_get_languages();

    switch ($action) {
      case 'insert':
      case 'save':
        if (isset($_POST['delete_comment'])) {
            for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
                $comments = (array)$_POST['delete_comment'][$languages[$i]['id']];
                foreach ($comments as $comment) {
                    tep_db_query("delete from " . TABLE_ARTICLES_BLOG . " where unique_id = " . (int)$comment);
                }
            }
        }
        else if (isset($_GET['comID'])) {
            $commenters_name = tep_db_prepare_input($_POST['commenters_name']);
            $sql_data_array = array('commenters_name' => $commenters_name);

            for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
                for ($c = 0; $c < count($_POST['comments']); ++$c) {
                    $language_id = $languages[$i]['id'];

                    if (count($_POST['comments'][$language_id])) {
                        $comments_array = $_POST['comments'][$language_id][$c];
                        $sql_data_array = array('comment' => tep_db_prepare_input($comments_array));

                        if ($action == 'insert') {
                            $insert_sql_data = array('articles_id' => $articles_id,
                                                     'comment_date_added' => 'now()',
                                                     'language_id' => $language_id
                                                     );

                            $sql_data_array = array_merge($sql_data_array, $insert_sql_data);

                            tep_db_perform(TABLE_ARTICLES_BLOG, $sql_data_array);
                        } elseif ($action == 'save') {
                            tep_db_perform(TABLE_ARTICLES_BLOG, $sql_data_array, 'update', "unique_id = '" . (int)$_POST['unique_id'][$language_id][$c] . "' and articles_id = '" . (int)$articles_id . "' and language_id = '" . (int)$language_id . "'");
                        }
                    }
                }
            }
        }

        tep_redirect(tep_href_link(FILENAME_ARTICLES_BLOG_COMMENTS, (isset($_GET['page']) ? 'page=' . $_GET['page'] . '&' : '') . 'comID=' . $articles_id));
        break;
      case 'deleteconfirm':
        tep_remove_article($articles_id);

        if (USE_CACHE == 'true') {
          tep_reset_cache_block('authors');
        }

        tep_redirect(tep_href_link(FILENAME_ARTICLES_BLOG_COMMENTS, 'page=' . $_GET['page']));
        break;
    }
  }

  //display error message if at least one author doesn't exist
  if (isset($_GET['no_authors']) && $_GET['no_authors'] == 'true')
  {
    $messageStack->add(ERROR_NO_AUTHORS_FOUND, 'error');
  }

  require(DIR_WS_INCLUDES . 'template_top.php');
?>
<style type="text/css">
table.BorderedBoxWhite {border: ridge #ddd 3px; background-color: #eee; }
</style>

<table border="0" width="100%" cellspacing="0" cellpadding="2">
 <tr>
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
<?php
  if ($action == 'new') {
?>
      <tr>
        <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="0" class="BorderedBoxWhite">
          <tr>
            <td class="pageHeading"><?php echo TEXT_HEADING_NEW_AUTHOR; ?></td>
            <td class="pageHeading" align="right"><?php echo tep_draw_separator('pixel_trans.gif', '100%', 5); ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>
      <tr><?php echo tep_draw_form('authors', FILENAME_ARTICLES_BLOG_COMMENTS, 'action=insert', 'post', 'enctype="multipart/form-data"'); ?>
        <td><table border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main" colspan="2"><?php echo TEXT_NEW_INTRO; ?></td>
          </tr>
          <tr>
            <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
          </tr>
          <tr>
            <td class="main"><?php echo TEXT_AUTHORS_NAME; ?></td>
            <td class="main"><?php echo tep_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;' . tep_draw_input_field('authors_name', '', 'size="20"'); ?></td>
          </tr>
          <tr>
            <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
          </tr>
          <tr>
            <td class="main"><?php echo TEXT_AUTHORS_IMAGE; ?></td>
            <td class="main"><?php echo tep_image(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']) . '&nbsp;' . tep_draw_input_field('authors_image[' . $languages[$i]['id'] . ']', ''); ?></td>
          </tr>
          <tr>
            <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
          </tr>
<?php
  $languages = tep_get_languages();
  for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
?>
          <tr>
            <td class="main" valign="top"><?php echo TEXT_AUTHORS_DESCRIPTION; ?></td>
            <td>
              <table border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td class="main" valign="top"><?php echo tep_image(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']) . '&nbsp;'; ?></td>
           <?php if (FCK_EDITOR == 'true') { ?>
                <td class="main"><?php echo tep_draw_fckeditor('authors_description[' . $languages[$i]['id'] . ']','700','300',''); ?></td>
           <?php } else { ?>
                  <td class="main" valign="top"><?php echo tep_draw_textarea_field('authors_description[' . $languages[$i]['id'] . ']', 'soft', '70', '15', ''); ?></td>
           <?php } ?>
                </tr>
              </table>
            </td>
          <tr>
          <tr>
            <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
          </tr>
          <tr>
            <td class="main" valign="top"><?php echo TEXT_AUTHORS_URL; ?></td>
            <td class="main" valign="top"><?php echo tep_image(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']) . '&nbsp;' . tep_draw_input_field('authors_url[' . $languages[$i]['id'] . ']', '', 'size="30"'); ?></td>
          <tr>
          <tr>
            <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
          </tr>
<?php
  }
?>
          <tr>
            <td colspan="3" class="main" align="center"><?php echo tep_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;' . tep_image_submit('button_save.gif', IMAGE_SAVE) . ' <a href="' . tep_href_link(FILENAME_ARTICLES_BLOG_COMMENTS, 'page=' . $_GET['page'] . '&auID=' . $_GET['auID']) . '">' . tep_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>'; ?></td>
          </tr>
        </table></td>
      </form>
      </tr>
<?php
  } elseif ($action == 'edit') {

    $comments_query = tep_db_query("select * from " . TABLE_ARTICLES_DESCRIPTION . " ad inner join " . TABLE_ARTICLES_BLOG . " ab on ad.articles_id = ab.articles_id and ab.articles_id = " . (int)$_GET['comID'] . " order by ab.comment_date_added");
    $comments = tep_db_fetch_array($comments_query);
?>
      <tr>
        <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="0" class="BorderedBoxWhite">
          <tr>
            <td class="pageHeading"><?php echo TEXT_HEADING_EDIT_COMMENTS; ?></td>
            <td class="pageHeading" align="right"><?php echo tep_draw_separator('pixel_trans.gif', 5, 5); ?></td>
          </tr>
          <tr>
            <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
          </tr>
          <tr>
            <td class="main" colspan="2"><?php echo TEXT_EDIT_INTRO; ?></td>
          </tr>
          <tr>
            <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>
      <tr><?php echo tep_draw_form('comments', FILENAME_ARTICLES_BLOG_COMMENTS, 'page=' . $_GET['page'] . '&comID=' . $comments['articles_id'] . '&action=save', 'post', 'enctype="multipart/form-data"'); ?>
        <td><table border="0" cellspacing="0" cellpadding="2">
          <tr>
            <table border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td class="main"><?php echo TEXT_ARTICLES_NAME; ?></td>
                <td class="main"><?php echo tep_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;' . $comments['articles_name']; ?></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
          </tr>
          <?php
            $languages = tep_get_languages();
            for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
                $comments_query = tep_db_query("select * from " . TABLE_ARTICLES_DESCRIPTION . " ad inner join " . TABLE_ARTICLES_BLOG . " ab on ad.articles_id = ab.articles_id and ab.articles_id = " . (int)$_GET['comID'] . " and ab.language_id = " . (int)$languages[$i]['id'] . " order by ab.comment_date_added");
                $comIdx =0;       //count the comments for saving
                while ($comments = tep_db_fetch_array($comments_query)) {
            ?>
                <tr>
                  <td>
                    <table border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td class="main"><?php echo TEXT_ARTICLES_COMMENTER; ?></td>
                        <td class="main"><?php echo tep_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;' . tep_draw_input_field('commenters_name', $comments['commenters_name'], 'size="20"'); ?></td>
                        <td class="main" align="right"><?php echo TEXT_DELETE_COMMENT; ?></td>
                        <td><?php echo tep_draw_checkbox_field('delete_comment[' . $languages[$i]['id'] . ']'.'['.$comIdx.']', $comments['unique_id'], false); ?> </td>
                      </tr>
                      <tr>
                        <td colspan="4"><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
                      </tr>
                      <tr>
                        <td class="main" valign="top"><?php echo tep_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;' . tep_image(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']) . '&nbsp;'; ?></td>
                        <?php echo tep_draw_hidden_field('unique_id[' . $languages[$i]['id'] . ']'.'['.$comIdx.']', $comments['unique_id']); ?>
                        <?php if (FCK_EDITOR == 'true') { ?>
                        <td colspan="3" class="main"><?php echo tep_draw_fckeditor('comments[' . $languages[$i]['id'] . ']'.'['.$comIdx.']','700','300', $comments['comment']); ?></td>
                        <?php } else { ?>
                        <td colspan="3" class="main" valign="top"><?php echo tep_draw_textarea_field('comments[' . $languages[$i]['id'] . ']'.'['.$comIdx.']' , 'soft', '120', '10', $comments['comment']); ?></td>
                        <?php } ?>
                      </tr>
                    </table>
                  </td>
                <tr>
                <tr>
                  <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
                </tr>
                <?php
                 $comIdx++;
                }
                ?>
          <?php
            }
          ?>
          </tr>
          <tr>
            <td colspan="3" class="main" align="center"><?php echo tep_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;' . tep_image_submit('button_save.gif', IMAGE_SAVE) . ' <a href="' . tep_href_link(FILENAME_ARTICLES_BLOG_COMMENTS, 'page=' . $_GET['page'] . '&auID=' . $authors['authors_id']) . '">' . tep_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>'; ?></td>
          </tr>
        </table></td>
      </form>
      </tr>
<?php
  } elseif ($action == 'preview') {

    $authors_query = tep_db_query("select authors_id, authors_name from " . TABLE_AUTHORS . " where authors_id = '" . $_GET['auID'] . "'");
    $authors = tep_db_fetch_array($authors_query)

?>
      <tr>
        <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo TEXT_ARTICLE_BY . $authors['authors_name']; ?></td>
            <td class="pageHeading" align="right"><?php echo tep_draw_separator('pixel_trans.gif', HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>
      <tr>
        <td><table border="0" cellspacing="0" cellpadding="2">
<?php
  $languages = tep_get_languages();
  for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
?>
          <tr>
            <td class="main" colspan="2" valign="top"><?php echo tep_image(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']); ?></td>
          <tr>
          <tr>
            <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
          </tr>
          <tr>
            <td class="main" valign="top"><?php echo tep_get_author_description($authors['authors_id'], $languages[$i]['id']); ?></td>
          <tr>
          <tr>
            <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
          </tr>
          <?php if(tep_not_null(tep_get_author_url($authors['authors_id'], $languages[$i]['id']))) { ?>
          <tr>
            <td class="main" valign="top"><?php echo sprintf(TEXT_MORE_INFORMATION, tep_get_author_url($authors['authors_id'], $languages[$i]['id'])); ?></td>
          <tr>
          <tr>
            <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
          </tr>
          <?php } ?>
<?php
  }
?>
      <tr>
        <td class="main" colspan="2" align="right"><?php echo '<a href="' . tep_href_link(FILENAME_ARTICLES_BLOG_COMMENTS, 'page=' . $_GET['page'] . '&auID=' . $authors['authors_id']) . '">' . tep_image_button('button_back.gif', IMAGE_BACK) . '</a>'; ?></td>
      </form>
      </tr>
          </tr>
        </table></td>
      </tr>
<?php } else { ?>
      <tr>
        <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
            <td class="pageHeading" align="right"><?php echo tep_draw_separator('pixel_trans.gif', 5, 25); ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_ARTICLE_NAME; ?></td>
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_BLOG_STATUS; ?></td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_ACTION; ?>&nbsp;</td>
              </tr>
<?php
  $comments_query_raw = "select *, count(ab.articles_id) as ttl_comments from " . TABLE_ARTICLES . " a left join " . TABLE_ARTICLES_DESCRIPTION . " ad on a.articles_id = ad.articles_id inner join " . TABLE_ARTICLES_BLOG . " ab on ad.articles_id = ab.articles_id and a.articles_is_blog = 1 and ad.language_id = " . (int)$languages_id . " group by ab.articles_id order by ab.comment_date_added";
  $comments_split = new splitPageResults($_GET['page'], MAX_DISPLAY_SEARCH_RESULTS, $comments_query_raw, $comments_query_numrows);
  $comments_query = tep_db_query($comments_query_raw);
  $ttlComments = 0;;

  while ($comments = tep_db_fetch_array($comments_query)) {
      $ttlComments += $comments['ttl_comments'];

      if ((!isset($_GET['comID']) || (isset($_GET['comID']) && ($_GET['comID'] == $comments['articles_id']))) && !isset($comInfo) && (substr($action, 0, 3) != 'new')) {
          $comInfo = new objectInfo($comments);
      }

      if (isset($comInfo) && is_object($comInfo) && ($comments['articles_id'] == $comInfo->articles_id)) {
        echo '              <tr id="defaultSelected" class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . tep_href_link(FILENAME_ARTICLES_BLOG_COMMENTS, 'page=' . $_GET['page'] . '&comID=' . $comments['articles__id'] . '&action=edit') . '\'">' . "\n";
      } else {
        echo '              <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . tep_href_link(FILENAME_ARTICLES_BLOG_COMMENTS, 'page=' . $_GET['page'] . '&comID=' . $comments['articles_id']) . '\'">' . "\n";
      }
?>
                <td class="dataTableContent"><?php echo $comments['articles_name']; ?></td>
                <td class="dataTableContent"><?php echo $comments['comments_status']; ?></td>
                <td class="dataTableContent" align="right"><?php if (isset($comInfo) && is_object($comInfo) && ($comments['articles_id'] == $comInfo->articles_id)) { echo tep_image(DIR_WS_IMAGES . 'icon_arrow_right.gif'); } else { echo '<a href="' . tep_href_link(FILENAME_ARTICLES_BLOG_COMMENTS, 'page=' . $_GET['page'] . '&auID=' . $comments['articles_id']) . '">' . tep_image(DIR_WS_IMAGES . 'icon_info.gif', IMAGE_ICON_INFO) . '</a>'; } ?>&nbsp;</td>
              </tr>
<?php
  }
?>
              <tr>
                <td colspan="2"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="smallText" valign="top"><?php echo TEXT_DISPLAY_NUMBER_OF_COMMENTS . $ttlComments; ?></td>
                    <td class="smallText" align="right"><?php echo $comments_split->display_links($comments_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $_GET['page']); ?></td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
<?php
  $heading = array();
  $contents = array();

  switch ($action) {
    case 'delete':
      $heading[] = array('text' => '<b>' . TEXT_HEADING_DELETE_ARTICLE . '</b>');

      $contents = array('form' => tep_draw_form('articles', FILENAME_ARTICLES_BLOG_COMMENTS, 'page=' . $_GET['page'] . '&comID=' . $comInfo->articles_id . '&action=deleteconfirm'));
      $contents[] = array('text' => TEXT_DELETE_INTRO);
      $contents[] = array('text' => '<br><b>' . $comnfo->articles_name . '</b>');

      $contents[] = array('align' => 'center', 'text' => '<br>' . tep_image_submit('button_delete.gif', IMAGE_DELETE) . ' <a href="' . tep_href_link(FILENAME_ARTICLES_BLOG_COMMENTS, 'page=' . $_GET['page'] . '&comID=' . $comInfo->articles_id) . '">' . tep_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
      break;
    default:
      if (isset($comInfo) && is_object($comInfo)) {
        $heading[] = array('text' => '<b>' . $comInfo->articles_name . '</b>');

        $contents[] = array('align' => 'center', 'text' => '<a href="' . tep_href_link(FILENAME_ARTICLES_BLOG_COMMENTS, 'page=' . $_GET['page'] . '&comID=' . $comInfo->articles_id . '&action=edit') . '">' . tep_image_button('button_edit.gif', IMAGE_EDIT) . '</a> <a href="' . tep_href_link(FILENAME_ARTICLES_BLOG_COMMENTS, 'page=' . $_GET['page'] . '&comID=' . $comInfo->articles_id . '&action=delete') . '">' . tep_image_button('button_delete.gif', IMAGE_DELETE) . '</a>');
        $contents[] = array('text' => '<br>' . TEXT_DATE_ADDED . ' ' . tep_date_short($comInfo->comment_date_added));
        $contents[] = array('text' => '<br>' . TEXT_COMMENTS . ' ' . $comInfo->ttl_comments);
      }
      break;
  }

  if ( (tep_not_null($heading)) && (tep_not_null($contents)) ) {
    echo '            <td width="25%" valign="top">' . "\n";

    $box = new box;
    echo $box->infoBox($heading, $contents);

    echo '            </td>' . "\n";
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
  require(DIR_WS_INCLUDES . 'template_bottom.php');
  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
