
<?php
/*
  $Id: articles_pxsell.php, v1.0 2006/03/11 12:00:00 Rigadin $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2006 osCommerce

  Released under the GNU General Public License
 */

if ($_GET['products_id']) {
    $xsell_query        = tep_db_query("select distinct ax.articles_id, ad.articles_name, ad.articles_image, a.articles_last_modified from ".TABLE_ARTICLES_XSELL." ax LEFT JOIN ".TABLE_ARTICLES." a USING(articles_id) LEFT JOIN ".TABLE_ARTICLES_DESCRIPTION." ad USING(articles_id) where ax.xsell_id = '".(int) $_GET['products_id']."' and ad.language_id = '".(int) $languages_id."' and a.articles_status = '1' order by a.articles_last_modified");
    $num_products_xsell = tep_db_num_rows($xsell_query);
    if ($num_products_xsell >= MIN_DISPLAY_ARTICLES_XSELL) {
        ?> 
        <!-- xsell_articles //-->
        <?php
        echo '<div style="font-weight:700">'.TEXT_PXSELL_ARTICLES.'</div>';
        echo '<div class="articleBox">';
        while ($xsell = tep_db_fetch_array($xsell_query)) {
            $path                   = (substr(DIR_WS_IMAGES, -1) == '/' ? DIR_WS_IMAGES.$xsell['articles_image']
                    : DIR_WS_IMAGES.'/'.$xsell['articles_image']);
            $xsell['products_name'] = tep_get_products_name($_GET['products_id']);

            echo '<div style="padding:0 10px">';
            if (tep_not_null($xsell['articles_image']) && file_exists($path)) {
                echo '<a href="'.tep_href_link('product_info.php',
                    'products_id='.$xsell['products_id']).'">'.tep_image($path,
                    addslashes($xsell['articles_name']), SMALL_IMAGE_WIDTH,
                    SMALL_IMAGE_HEIGHT).'</a><br>';
            }
            echo '<a href="'.tep_href_link(FILENAME_ARTICLE_INFO,
                'articles_id='.$xsell['articles_id']).'">'.addslashes($xsell['articles_name']).'</a></div>';
        }
        echo '</div>';
        ?>
        <!-- xsell_articles_eof //-->
        <?php
    }
}

