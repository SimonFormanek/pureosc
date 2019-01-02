<?php
/*
  $Id: articles_new.php, v1.5.1 2003/12/04 12:00:00 ra Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
 */

require('includes/application_top.php');
require(DIR_WS_LANGUAGES.$language.'/'.FILENAME_ARTICLES_NEW);

$breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_ARTICLES_NEW));
require(DIR_WS_INCLUDES.'template_top.php');
?>

<table border="0" width="100%" cellspacing="3" cellpadding="3">
    <tr>

        <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                    <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
                            <tr>
                                <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
                            </tr>
                        </table></td>
                </tr>
                <tr>
                    <td><?php echo tep_draw_separator('pixel_trans.gif',
    '100%', '10');
?></td>
                </tr>
                <?php
                $articles_new_array = array();
                $listing_sql        = "select a.articles_id, a.articles_date_added, ad.articles_name, ad.articles_head_desc_tag, au.authors_id, au.authors_name, td.topics_id, td.topics_name from ((".TABLE_ARTICLES." a), ".TABLE_ARTICLES_TO_TOPICS." a2t) left join ".TABLE_TOPICS_DESCRIPTION." td on a2t.topics_id = td.topics_id left join ".TABLE_AUTHORS." au on a.authors_id = au.authors_id, ".TABLE_ARTICLES_DESCRIPTION." ad where (a.articles_date_available IS NULL or to_days(a.articles_date_available) <= to_days(now())) and a.articles_id = a2t.articles_id and a.articles_status = '1' and a.articles_id = ad.articles_id and ad.language_id = '".(int) $languages_id."' and td.language_id = '".(int) $languages_id."' and a.articles_date_added > SUBDATE(now( ), INTERVAL '".NEW_ARTICLES_DAYS_DISPLAY."' DAY) order by a.articles_date_added desc, ad.articles_name";
                $listing_no_article = sprintf(TEXT_NO_NEW_ARTICLES,
                    NEW_ARTICLES_DAYS_DISPLAY);

                //$articles_new_split = new splitPageResults($listing_sql, MAX_NEW_ARTICLES_PER_PAGE);
                ?>

<?php include(DIR_WS_MODULES.FILENAME_ARTICLE_LISTING); ?></td>
    <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
    </tr>
</table></td>
</tr>
</table>

<?php
require(DIR_WS_INCLUDES.'template_bottom.php');
require(DIR_WS_INCLUDES.'application_bottom.php');
?>
