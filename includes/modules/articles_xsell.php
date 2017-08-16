<?php
/*
  $Id: articles_xsell.php, v1.0 2003/12/04 12:00:00 ra Exp $

osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

Copyright (c) 2003 osCommerce 

Released under the GNU General Public License 
*/ 

if ($_GET['articles_id']) {
$xsell_query = tep_db_query("select distinct p.products_id, p.products_image, pd.products_name from " .
 TABLE_ARTICLES_XSELL . " ax left join " .
 TABLE_PRODUCTS . " p on ax.xsell_id = p.products_id left join " .
 TABLE_PRODUCTS_DESCRIPTION . " pd on p.products_id = pd.products_id
 where ax.articles_id = '" . (int)$_GET['articles_id'] . "'  and pd.language_id = '" . $languages_id . "' and p.products_status = '1' order by ax.sort_order asc limit " . MAX_DISPLAY_ARTICLES_XSELL);

$num_products_xsell = tep_db_num_rows($xsell_query);
if ($num_products_xsell >= MIN_DISPLAY_ARTICLES_XSELL) {
?>
<!-- xsell_articles //-->
<?php
      echo '<div style="font-weight:700">' . TEXT_XSELL_ARTICLES . '</div>';
      echo '<div class="articleBox">';
      while ($xsell = tep_db_fetch_array($xsell_query)) {
        $path = (substr(DIR_WS_IMAGES, -1) == '/' ? DIR_WS_IMAGES. $xsell['articles_image'] : DIR_WS_IMAGES.'/'.$xsell['articles_image']);
        $xsell['products_name'] = tep_get_products_name($xsell['products_id']);
        
        echo '<div style="padding:0 10px">';
        if (tep_not_null($xsell['articles_image']) && file_exists($path)) { 
           echo '<a href="' . tep_href_link('product_info.php', 'products_id=' . $xsell['products_id']) . '">' . tep_image($path, addslashes($xsell['products_name']), SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a><br>';
        } 
        echo '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $xsell['products_id']) . '">' . addslashes($xsell['products_name']) . '</a></div>';
      }
      echo '</div>';
?>
<!-- xsell_articles_eof //-->
<?php
    }
  }

