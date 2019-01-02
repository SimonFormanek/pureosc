<?php
/*
  $Id: popup_image.php,v 1.18 2003/06/05 23:26:23 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
 */

require('includes/application_top.php');
require(DIR_WS_LANGUAGES.$language.'/'.FILENAME_ARTICLE_INFO);

$article_info_query = tep_db_query("select a.articles_id, a.articles_date_added, a.articles_date_available, a.authors_id, ad.articles_name, ad.articles_description, ad.articles_image, ad.articles_url, au.authors_name, au.authors_image from ".TABLE_ARTICLES." a left join ".TABLE_AUTHORS." au using(authors_id), ".TABLE_ARTICLES_DESCRIPTION." ad where a.articles_status = '1' and a.articles_id = '".(int) $_GET['aID']."' and ad.articles_id = a.articles_id and ad.language_id = '".(int) $_GET['language_id']."'");
$article_info       = tep_db_fetch_array($article_info_query);

$navigation->remove_current_page();
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
        <title><?php echo $article_info['articles_name']; ?></title>
        <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
        <link rel="stylesheet" type="text/css" href="stylesheet.css">
        <base href="<?php echo (($request_type == 'SSL') ? HTTPS_SERVER : HTTP_SERVER).DIR_WS_CATALOG; ?>">

    </head>
    <body onload="javascript: window.print();">

        <table border="0" cellpadding="0">
            <tr>
                <td class="main"><b><?php echo $article_info['articles_name']; ?></b></td>
            </tr>
            <tr>
                <td class="main"><?php echo TEXT_BY.' '.$article_info['authors_name']; ?></td>
            </tr>
            <tr>
                <td class="smallText"><?php echo TEXT_COURTESY_OF; ?></td>
            </tr>
            <tr>
                <td><?php
                    echo tep_draw_separator('pixel_trans.gif', '100%', '10');
                    ?></td>
            </tr>
            <tr>
                <td class="main"><?php echo $article_info['articles_description']; ?></td>
            </tr>
            <tr>
                <td><?php
                    echo tep_draw_separator('pixel_trans.gif', '100%', '10');
                    ?></td>
            </tr>
            <tr>
                <td class="main" align="right"><a href="javascript: self.close ()"><?php echo TEXT_CLOSE_POPUP; ?></a></td>
            </tr>
        </table>

    </body>
</html>
