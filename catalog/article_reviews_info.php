<?php
/*
  $Id: article_reviews_info.php, v1.0 2003/12/04 12:00:00 ra Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
 */

require('includes/application_top.php');

if (isset($_GET['reviews_id']) && tep_not_null($_GET['reviews_id']) && isset($_GET['articles_id'])
    && tep_not_null($_GET['articles_id'])) {
    $review_check_query = tep_db_query("SELECT COUNT(*) as total from ".TABLE_ARTICLE_REVIEWS." r, ".TABLE_ARTICLE_REVIEWS_DESCRIPTION." rd where r.reviews_id = '".(int) $_GET['reviews_id']."' and r.articles_id = '".(int) $_GET['articles_id']."' and r.reviews_id = rd.reviews_id and rd.languages_id = '".(int) $languages_id."'");
    $review_check       = tep_db_fetch_array($review_check_query);

    if ($review_check['total'] < 1) {
        tep_redirect(tep_href_link(FILENAME_ARTICLE_REVIEWS,
                tep_get_all_get_params(array('reviews_id'))));
    }
} else {
    tep_redirect(tep_href_link(FILENAME_ARTICLE_REVIEWS,
            tep_get_all_get_params(array('reviews_id'))));
}

tep_db_query("update ".TABLE_ARTICLE_REVIEWS." set reviews_read = reviews_read+1 where reviews_id = '".(int) $_GET['reviews_id']."'");

$review_query = tep_db_query("select rd.reviews_text, r.reviews_rating, r.reviews_id, r.customers_name, r.date_added, r.reviews_read, a.articles_id, ad.articles_name from ".TABLE_ARTICLE_REVIEWS." r, ".TABLE_ARTICLE_REVIEWS_DESCRIPTION." rd, ".TABLE_ARTICLES." a, ".TABLE_ARTICLES_DESCRIPTION." ad where r.reviews_id = '".(int) $_GET['reviews_id']."' and r.reviews_id = rd.reviews_id and rd.languages_id = '".(int) $languages_id."' and r.articles_id = a.articles_id and a.articles_status = '1' and a.articles_id = ad.articles_id and ad.language_id = '".(int) $languages_id."'");
$review       = tep_db_fetch_array($review_query);

$articles_name = $review['articles_name'];

require(DIR_WS_LANGUAGES.$language.'/'.FILENAME_ARTICLE_REVIEWS_INFO);

$breadcrumb->add(NAVBAR_TITLE,
    tep_href_link(FILENAME_ARTICLE_REVIEWS, tep_get_all_get_params()));
require(DIR_WS_INCLUDES.'template_top.php');
?>
<script language="javascript"><!--
function popupWindow(url) {
    window.open(url, 'popupWindow', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=yes,copyhistory=no,width=100,height=100,screenX=150,screenY=150,top=150,left=150')
            }
//--></scri    pt>
    <table border="0" width="100%" cellspacing="3" cellpadding="3">
<tr>
<td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellp                            adding="0">
    <tr>
    <td><table border="0" width="100                                                                %" cellspacing="0" cellpadding="0">
    <tr>
    <td class="pageHeading" valign="top"><?php echo HEADING_TITLE.'\''.$articles_name.'\''; ?></td>
    </tr>
    </table></td>
    </tr>
    <tr>
    <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10');
?></td>
    </tr>
    <tr>
    <td><table w                                                                                    idth="100%" border="0" cellspacing="0" cellpadding="2">
        <tr>
                <td valign="top"><tab                                                                                                    le border="0" width="100%" cellspacing="0" cellpadding="2">
<tr>
<td><table border="0                                                                                                    " width="100%" cellspacing="0" cellpadding="2">
<tr>
<td class="main"><?php echo '<b>'.sprintf(TEXT_REVIEW_BY,
    tep_output_string_protected($review['customers_name'])).'</b>';
?></td>
<td class="smallText" align="right"><?php echo sprintf(TEXT_REVIEW_DATE_ADDED,
                                                                                                                                        tep_date_long($review['date_added']));
?></td>
</tr>
</table></td>
</tr>
<tr>
<td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
<tr class="infoBoxContents">
<td><table border="0" width="100%" cellspacing="0" cellpadding="2">
<tr>
<td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1');
?></td>
<td valign="top" class="main"><?php
                                                                                                                                                                        echo tep_break_string(nl2br(tep_output_string_protected($review['reviews_text'])),
                                                                                                                                                                            60,
                                                                                                                                                                            '-<br>').'<br><br><i>'.sprintf(TEXT_REVIEW_RATING,
                                                                                                                                                                            tep_image(DIR_WS_IMAGES.'stars_'.$review['reviews_rating'].'.gif',
                                                                                                                                                                                sprintf(TEXT_OF_5_STARS,
                                                                                                                                                                                    $review['reviews_rating'])),
                                                                                                                                                                            sprintf(TEXT_OF_5_STARS,
                                                                                                                                                                                $review['reviews_rating'])).'</i>';
                                                                                                                                                                        ?></td>
<td width="10" align="right"><?php echo tep_draw_separator('pixel_trans.gif',
                                                                                                                                                                                '10',
                                                                                                                                                                                '1');
                                                                                                                                                                        ?></td>
</tr>
</table></td>
</tr>
</table></td>
</tr>
<tr>
<td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10');
                                                                                                                                                                        ?></td>
</tr>
<tr>
<td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
<tr class="infoBoxContents">
<td><table border="0" width="100%" cellspacing="0" cellpadding="2">
<tr>
<td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1');
                                                                                                                                                                        ?></td>
    <td class="main"><?php
                                                                                                                                                                echo '<a href="'.tep_href_link(FILENAME_ARTICLE_REVIEWS,
                                                                                                                                                                    tep_get_all_get_params(array(
                                                                                                                                                                    'reviews_id'))).'">'.tep_image_button('button_back.gif',
                                                                                                                                                                    IMAGE_BUTTON_BACK).'</a>';
                                                                                                                                                                ?></td>
    <td class="main" align="right"><?php
                                                                                                                                                                echo '<a href="'.tep_href_link(FILENAME_ARTICLE_REVIEWS_WRITE,
                                                                                                                                                                    tep_get_all_get_params(array(
                                                                                                                                                                    'reviews_id'))).'">'.tep_image_button('button_write_review.gif',
                                                                                                                                                                    IMAGE_BUTTON_WRITE_REVIEW).'</a>';
                                                                                                                                                                ?></td>
<td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1');
                                                                                                                                                                ?></td>
</tr>
</table></td>
</tr>
</table></td>
</tr>
</table></td>
    </table></td>
    </tr>
    </table></td>
    
    </table></td>
    </tr>
            </table>

<?php
require(DIR_WS_INCLUDES.'template_bottom.php');
require(DIR_WS_INCLUDES.'application_bottom.php');