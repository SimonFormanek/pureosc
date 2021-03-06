<?php

/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2010 osCommerce

  Edited by 2014 Newburns Design and Technology
 * ************************************************
 * *********** New addon definitions **************
 * ***********        Below          **************
 * ************************************************
  SEO Header Tags Reloaded added -- http://addons.oscommerce.com/info/8864
  Custom Default Product Sort Order -- http://forums.oscommerce.com/topic/308798-product-listing-sort-order/

  Released under the GNU General Public License
 */

require_once('includes/application_top.php');

// the following cPath references come from application_top.php
$category_depth = 'top';
//Information Pages Unlimited PURE:NEW: added DefaultPage TITLE, DESCRIPTION, KEYWORDS
tep_information_default_page_define();

if (isset($cPath) && tep_not_null($cPath)) {
    $categories_products_query = tep_db_query("select count(*) as total from ".TABLE_PRODUCTS_TO_CATEGORIES." where categories_id = '".(int) $current_category_id."'");
    $categories_products       = tep_db_fetch_array($categories_products_query);
    if ($categories_products['total'] > 0) {
        $category_depth = 'products'; // display products
    } else {
        $category_parent_query = tep_db_query("select count(*) as total from ".TABLE_CATEGORIES." where parent_id = '".(int) $current_category_id."'");
        $category_parent       = tep_db_fetch_array($category_parent_query);
        if ($category_parent['total'] > 0) {
            $category_depth = 'nested'; // navigate through the categories
        } else {
            $category_depth = 'products'; // category has no products, but display the 'no products' message
        }
    }
}

require(DIR_WS_LANGUAGES.$language.'/'.FILENAME_DEFAULT);

require(DIR_WS_INCLUDES.'template_top.php');

if ($category_depth == 'nested') {
    $category_query = tep_db_query("select cd.categories_name, c.categories_image, cd.categories_description from ".TABLE_CATEGORIES." c, ".TABLE_CATEGORIES_DESCRIPTION." cd where c.categories_id = '".(int) $current_category_id."' and cd.categories_id = '".(int) $current_category_id."' and cd.language_id = '".(int) $languages_id."'");
    $category       = tep_db_fetch_array($category_query);
    ?>

    <div class="page-header">
        <h1><?php echo $category['categories_name']; ?></h1>
    </div>

    <?php
    if ($messageStack->size('product_action') > 0) {
        echo $messageStack->output('product_action');
    }
    ?>

    <?php
    if (tep_not_null($category['categories_description'])) {
        echo '<div class="well well-sm">'.$category['categories_description'].'</div>';
    }
    ?>

    <div class="contentContainer">
        <div class="contentText">
            <div class="row">
                <?php
                if (isset($cPath) && strpos('_', $cPath)) {
// check to see if there are deeper categories within the current category
                    $category_links = array_reverse($cPath_array);
                    for ($i = 0, $n = sizeof($category_links); $i < $n; $i++) {
                        $categories_query = tep_db_query("select count(*) as total from ".TABLE_CATEGORIES." c, ".TABLE_CATEGORIES_DESCRIPTION." cd where c.parent_id = '".(int) $category_links[$i]."' and c.categories_id = cd.categories_id and cd.language_id = '".(int) $languages_id."'");
                        $categories       = tep_db_fetch_array($categories_query);
                        if ($categories['total'] < 1) {
                            // do nothing, go through the loop
                        } else {
                            $categories_query = tep_db_query("select c.categories_id, cd.categories_name, c.categories_image, c.parent_id from ".TABLE_CATEGORIES." c, ".TABLE_CATEGORIES_DESCRIPTION." cd where c.parent_id = '".(int) $category_links[$i]."' and c.categories_id = cd.categories_id and cd.language_id = '".(int) $languages_id."' AND sort_order > 0 order by sort_order, cd.categories_name");
                            break; // we've found the deepest category the customer is in
                        }
                    }
                } else {
                    $categories_query = tep_db_query("select c.categories_id, cd.categories_name, c.categories_image, c.parent_id from ".TABLE_CATEGORIES." c, ".TABLE_CATEGORIES_DESCRIPTION." cd where c.parent_id = '".(int) $current_category_id."' and c.categories_id = cd.categories_id and cd.language_id = '".(int) $languages_id."' AND sort_order > 0 order by sort_order, cd.categories_name");
                }

                while ($categories = tep_db_fetch_array($categories_query)) {
                    $cPath_new = tep_get_path($categories['categories_id']);
                    echo '<div class="col-xs-6 col-sm-4">';
                    echo '  <div class="text-center">';
                    echo '    <a href="'.tep_href_link(FILENAME_DEFAULT,
                        $cPath_new).'">'.tep_image(DIR_WS_IMAGES.$categories['categories_image'],
                        $categories['categories_name'], SUBCATEGORY_IMAGE_WIDTH,
                        SUBCATEGORY_IMAGE_HEIGHT).'</a>';
                    echo '    <div class="caption text-center">';
                    echo '      <h5><a href="'.tep_href_link(FILENAME_DEFAULT,
                        $cPath_new).'">'.$categories['categories_name'].'</a></h5>';
                    echo '    </div>';
                    echo '  </div>';
                    echo '</div>';
                }

// needed for the new products module shown below
                $new_products_category_id = $current_category_id;
                ?>
            </div>

            <br />

            <?php 
            include(DIR_WS_MODULES.FILENAME_NEW_PRODUCTS); 
            ?>

        </div>
    </div>

    <?php
} elseif ($category_depth == 'products' || (isset($_GET['manufacturers_id']) && !empty($_GET['manufacturers_id']))) {
/* TODO: not work for manufacturers
    //PURE:NEW:inactive_category: if sort_order < 1 -> redirect to Index
    //TODO: MORE AI PLEASE .... starting realistic with: go to parent category
    if (SERVER_INSTANCE != 'admin') {
        $inactive_query = tep_db_query("SELECT sort_order FROM ".TABLE_CATEGORIES." WHERE categories_id = ".(int) $current_category_id);
        $inactive       = tep_db_fetch_array($inactive_query);
//  	echo "sort_order: " . $inactive['sort_order'] . "\n";
        if ($inactive['sort_order'] == 0) {
            tep_redirect(tep_href_link(FILENAME_DEFAULT, '', 'NONSSL'));
            exit;
        }
    }
*/
// create column list
    $define_list = array('PRODUCT_LIST_MODEL' => PRODUCT_LIST_MODEL,
        'PRODUCT_LIST_NAME' => PRODUCT_LIST_NAME,
        'PRODUCT_LIST_MANUFACTURER' => PRODUCT_LIST_MANUFACTURER,
        'PRODUCT_LIST_PRICE' => PRODUCT_LIST_PRICE,
        'PRODUCT_LIST_QUANTITY' => PRODUCT_LIST_QUANTITY,
        'PRODUCT_LIST_WEIGHT' => PRODUCT_LIST_WEIGHT,
        'PRODUCT_LIST_IMAGE' => PRODUCT_LIST_IMAGE,
        'PRODUCT_LIST_BUY_NOW' => PRODUCT_LIST_BUY_NOW,
        'PRODUCT_LIST_DATE_AVAILABLE' => PRODUCT_LIST_DATE_AVAILABLE,
        'PRODUCT_LIST_CUSTOM_DATE' => PRODUCT_LIST_CUSTOM_DATE,
        'PRODUCT_LIST_SORT_ORDER' => PRODUCT_LIST_SORT_ORDER);

    asort($define_list);

    $column_list = array();
    reset($define_list);
    while (list($key, $value) = each($define_list)) {
        if ($value > 0) $column_list[] = $key;
    }

    $select_column_list = '';

    for ($i = 0, $n = sizeof($column_list); $i < $n; $i++) {
        switch ($column_list[$i]) {
            case 'PRODUCT_LIST_MODEL':
                $select_column_list .= 'p.products_model, ';
                break;
            case 'PRODUCT_LIST_NAME':
                $select_column_list .= 'pd.products_name, ';
                break;
            case 'PRODUCT_LIST_MANUFACTURER':
                $select_column_list .= 'm.manufacturers_name, ';
                break;
            case 'PRODUCT_LIST_QUANTITY':
                $select_column_list .= 'p.products_quantity, ';
                break;
            case 'PRODUCT_LIST_IMAGE':
                $select_column_list .= 'p.products_image, ';
                break;
            case 'PRODUCT_LIST_WEIGHT':
                $select_column_list .= 'p.products_weight, ';
                break;
            case 'PRODUCT_LIST_DATE_AVAILABLE':
                $select_column_list .= 'p.products_date_available, ';
                break;
            case 'PRODUCT_LIST_CUSTOM_DATE':
                $select_column_list .= 'p.products_custom_date, ';
                break;
            case 'PRODUCT_LIST_SORT_ORDER':
                $select_column_list .= 'p.products_sort_order, ';
                break;
        }
    }

// show the products of a specified manufacturer
    if (isset($_GET['manufacturers_id']) && !empty($_GET['manufacturers_id'])) {
        if (isset($_GET['filter_id']) && tep_not_null($_GET['filter_id'])) {
// We are asked to show only a specific category
            $listing_sql = "select ".$select_column_list." p.products_id, SUBSTRING_INDEX(pd.products_description, ' ', ".LISTING_SNIPPET_LENGHT.") as products_description, pd.products_mini_description, p.manufacturers_id, p.products_price, p.products_tax_class_id, IF(s.status, s.specials_new_products_price, NULL) as specials_new_products_price, IF(s.status, s.specials_new_products_price, p.products_price) as final_price from ".TABLE_PRODUCTS." p left join ".TABLE_SPECIALS." s on p.products_id = s.products_id, ".TABLE_PRODUCTS_DESCRIPTION." pd, ".TABLE_MANUFACTURERS." m, ".TABLE_PRODUCTS_TO_CATEGORIES." p2c where p.products_status = '1' and p.manufacturers_id = m.manufacturers_id and m.manufacturers_id = '".(int) $_GET['manufacturers_id']."' and p.products_id = p2c.products_id and pd.products_id = p2c.products_id and pd.language_id = '".(int) $languages_id."' and p2c.categories_id = '".(int) $_GET['filter_id']."'";
        } else {
// We show them all
            $listing_sql = "select ".$select_column_list." p.products_id, SUBSTRING_INDEX(pd.products_description, ' ', ".LISTING_SNIPPET_LENGHT.") as products_description, pd.products_mini_description, p.manufacturers_id, p.products_price, p.products_tax_class_id, IF(s.status, s.specials_new_products_price, NULL) as specials_new_products_price, IF(s.status, s.specials_new_products_price, p.products_price) as final_price from ".TABLE_PRODUCTS." p left join ".TABLE_SPECIALS." s on p.products_id = s.products_id, ".TABLE_PRODUCTS_DESCRIPTION." pd, ".TABLE_MANUFACTURERS." m where p.products_status = '1' and pd.products_id = p.products_id and pd.language_id = '".(int) $languages_id."' and p.manufacturers_id = m.manufacturers_id and m.manufacturers_id = '".(int) $_GET['manufacturers_id']."'";
        }
    } else {
// show the products in a given categorie
        if (isset($_GET['filter_id']) && tep_not_null($_GET['filter_id'])) {
// We are asked to show only specific catgeory
            $listing_sql = "select ".$select_column_list." p.products_id, SUBSTRING_INDEX(pd.products_description, ' ', ".LISTING_SNIPPET_LENGHT.") as products_description, pd.products_mini_description, p.manufacturers_id, p.products_price, p.products_tax_class_id, IF(s.status, s.specials_new_products_price, NULL) as specials_new_products_price, IF(s.status, s.specials_new_products_price, p.products_price) as final_price from ".TABLE_PRODUCTS." p left join ".TABLE_SPECIALS." s on p.products_id = s.products_id, ".TABLE_PRODUCTS_DESCRIPTION." pd, ".TABLE_MANUFACTURERS." m, ".TABLE_PRODUCTS_TO_CATEGORIES." p2c where p.products_status = '1' and p.manufacturers_id = m.manufacturers_id and m.manufacturers_id = '".(int) $_GET['filter_id']."' and p.products_id = p2c.products_id and pd.products_id = p2c.products_id and pd.language_id = '".(int) $languages_id."' and p2c.categories_id = '".(int) $current_category_id."'";
        } else {
// We show them all
            $listing_sql = "select ".$select_column_list." p.products_id, SUBSTRING_INDEX(pd.products_description, ' ', ".LISTING_SNIPPET_LENGHT.") as products_description, pd.products_mini_description, p.manufacturers_id, p.products_price, p.products_tax_class_id, IF(s.status, s.specials_new_products_price, NULL) as specials_new_products_price, IF(s.status, s.specials_new_products_price, p.products_price) as final_price from ".TABLE_PRODUCTS_DESCRIPTION." pd, ".TABLE_PRODUCTS." p left join ".TABLE_MANUFACTURERS." m on p.manufacturers_id = m.manufacturers_id left join ".TABLE_SPECIALS." s on p.products_id = s.products_id, ".TABLE_PRODUCTS_TO_CATEGORIES." p2c where p.products_status = '1' and p.products_id = p2c.products_id and pd.products_id = p2c.products_id and pd.language_id = '".(int) $languages_id."' and p2c.categories_id = '".(int) $current_category_id."'";
        }
    }

    if ((!isset($_GET['sort'])) || (!preg_match('/^[1-8][ad]$/', $_GET['sort']))
        || (substr($_GET['sort'], 0, 1) > sizeof($column_list))) {
        for ($i = 0, $n = sizeof($column_list); $i < $n; $i++) {
            /*             * *Altered default sort type and sorting order**	  
              if ($column_list[$i] == 'PRODUCT_LIST_NAME') {
              $HTTP_GET_VARS['sort'] = $i+1 . 'a';
              $listing_sql .= " order by pd.products_name";
             */
//		if ($column_list[$i] == 'PRODUCT_LIST_DATE_AVAILABLE') {
//          $HTTP_GET_VARS['sort'] = $i+1 . 'a';
            $listing_sql .= " ORDER BY ".PRODUCT_LIST_DEFAULT_SORT_ORDER;
            /*             * * EOF alteration for default sort type and sorting order ** */
            break;
//        }
        }
    } else {
        $sort_col   = substr($_GET['sort'], 0, 1);
        $sort_order = substr($_GET['sort'], 1);

        switch ($column_list[$sort_col - 1]) {
            case 'PRODUCT_LIST_MODEL':
                $listing_sql .= " order by p.products_model ".($sort_order == 'd'
                        ? 'desc' : '').", pd.products_name";
                break;
            case 'PRODUCT_LIST_NAME':
                $listing_sql .= " order by pd.products_name ".($sort_order == 'd'
                        ? 'desc' : '');
                break;
            case 'PRODUCT_LIST_MANUFACTURER':
                $listing_sql .= " order by m.manufacturers_name ".($sort_order == 'd'
                        ? 'desc' : '').", pd.products_name";
                break;
            case 'PRODUCT_LIST_QUANTITY':
                $listing_sql .= " order by p.products_quantity ".($sort_order == 'd'
                        ? 'desc' : '').", pd.products_name";
                break;
            case 'PRODUCT_LIST_IMAGE':
                $listing_sql .= " order by pd.products_name";
                break;
            case 'PRODUCT_LIST_WEIGHT':
                $listing_sql .= " order by p.products_weight ".($sort_order == 'd'
                        ? 'desc' : '').", pd.products_name";
                break;
            case 'PRODUCT_LIST_PRICE':
                $listing_sql .= " order by final_price ".($sort_order == 'd' ? 'desc'
                        : '').", pd.products_name";
                break;
            case 'PRODUCT_LIST_DATE_AVAILABLE':
                $listing_sql .= " order by p.products_date_available DESC, p.products_date_added DESC, pd.products_name";
                break;
            case 'PRODUCT_LIST_DATE_AVAILABLE':
                $listing_sql .= " order by p.products_date_available DESC, p.products_date_added DESC, pd.products_name";
                break;
        }
    }

    /*     * * Altered for SEO Header Tags RELOADED **
      $catname = HEADING_TITLE;
      if (isset($HTTP_GET_VARS['manufacturers_id']) && !empty($HTTP_GET_VARS['manufacturers_id'])) {
      $image = tep_db_query("select m.manufacturers_image, m.manufacturers_name as catname, mi.manufacturers_description as catdesc from manufacturers m, manufacturers_info mi where m.manufacturers_id = '" . (int)$HTTP_GET_VARS['manufacturers_id'] . "' and m.manufacturers_id = mi.manufacturers_id and mi.languages_id = '" . (int)$languages_id . "'");
      $image = tep_db_fetch_array($image);
      $catname = $image['catname'];
      } elseif ($current_category_id) {
      $image = tep_db_query("select c.categories_image, cd.categories_name as catname, cd.categories_description as catdesc from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where c.categories_id = '" . (int)$current_category_id . "' and c.categories_id = cd.categories_id and cd.language_id = '" . (int)$languages_id . "'");
      $image = tep_db_fetch_array($image);
      $catname = $image['catname'];
      }
     */
    $catname = HEADING_TITLE;
    if (isset($_GET['manufacturers_id']) && !empty($_GET['manufacturers_id'])) {
        $image   = tep_db_query("select m.manufacturers_image, m.manufacturers_name as catname, mi.manufacturers_description as catdesc from ".TABLE_MANUFACTURERS." m, ".TABLE_MANUFACTURERS_INFO." mi where m.manufacturers_id = '".(int) $_GET['manufacturers_id']."' and m.manufacturers_id = mi.manufacturers_id and mi.languages_id = '".(int) $languages_id."'");
        $image   = tep_db_fetch_array($image);
        $catname = $image['catname'];
    } elseif ($current_category_id) {
        $image   = tep_db_query("select c.categories_image, cd.categories_name as catname, cd.categories_description as catdesc from ".TABLE_CATEGORIES." c, ".TABLE_CATEGORIES_DESCRIPTION." cd where c.categories_id = '".(int) $current_category_id."' and c.categories_id = cd.categories_id and cd.language_id = '".(int) $languages_id."'");
        $image   = tep_db_fetch_array($image);
        $catname = $image['catname'];
    }
    /*     * * EOF alteration for SEO Header Tags RELOADED ** */
    ?>
    <?php
    if (tep_not_null(HEADING_TITLE)) {
        ?>

        <div class="page-header">
            <h1><?php echo $catname; ?></h1>
        </div>

        <?php
    }
    if (tep_not_null($image['catdesc'])) {
        echo '<div class="well well-sm">'.$image['catdesc'].'</div>';
    }
    ?>
    <div class="contentContainer">

        <?php
// optional Product List Filter
        if (PRODUCT_LIST_FILTER > 0) {
            if (isset($_GET['manufacturers_id']) && !empty($_GET['manufacturers_id'])) {
                $filterlist_sql = "select distinct c.categories_id as id, cd.categories_name as name from ".TABLE_PRODUCTS." p, ".TABLE_PRODUCTS_TO_CATEGORIES." p2c, ".TABLE_CATEGORIES." c, ".TABLE_CATEGORIES_DESCRIPTION." cd where p.products_status = '1' and p.products_id = p2c.products_id and p2c.categories_id = c.categories_id and p2c.categories_id = cd.categories_id and cd.language_id = '".(int) $languages_id."' and p.manufacturers_id = '".(int) $_GET['manufacturers_id']."' order by cd.categories_name";
            } else {
                $filterlist_sql = "select distinct m.manufacturers_id as id, m.manufacturers_name as name from ".TABLE_PRODUCTS." p, ".TABLE_PRODUCTS_TO_CATEGORIES." p2c, ".TABLE_MANUFACTURERS." m where p.products_status = '1' and p.manufacturers_id = m.manufacturers_id and p.products_id = p2c.products_id and p2c.categories_id = '".(int) $current_category_id."' order by m.manufacturers_name";
            }
            $filterlist_query = tep_db_query($filterlist_sql);
            if (tep_db_num_rows($filterlist_query) > 1) {
                echo '<div>'.tep_draw_form('filter', FILENAME_DEFAULT, 'get').'<p align="right">'.TEXT_SHOW.'&nbsp;';
                if (isset($_GET['manufacturers_id']) && !empty($_GET['manufacturers_id'])) {
                    echo tep_draw_hidden_field('manufacturers_id',
                        $_GET['manufacturers_id']);
                    $options = array(array('id' => '', 'text' => TEXT_ALL_CATEGORIES));
                } else {
                    echo tep_draw_hidden_field('cPath', $cPath);
                    $options = array(array('id' => '', 'text' => TEXT_ALL_MANUFACTURERS));
                }
                echo tep_draw_hidden_field('sort', $_GET['sort']);
                while ($filterlist = tep_db_fetch_array($filterlist_query)) {
                    $options[] = array('id' => $filterlist['id'], 'text' => $filterlist['name']);
                }
                echo tep_draw_pull_down_menu('filter_id', $options,
                    (isset($_GET['filter_id']) ? $_GET['filter_id'] : ''),
                    'onchange="this.form.submit()"');
                echo tep_hide_session_id().'</p></form></div>'."\n";
            }
        }

        include(DIR_WS_MODULES.FILENAME_PRODUCT_LISTING);
        ?>

    </div>

    <?php
} else { // default page
// Start Modular Front Page
    ?>

    <div class="contentText">

        <?php
        echo $oscTemplate->getContent('front_page');
        ?>

    </div>

    <?php
// End Modular Front Page
}

require(DIR_WS_INCLUDES.'template_bottom.php');
require(DIR_WS_INCLUDES.'application_bottom.php');

