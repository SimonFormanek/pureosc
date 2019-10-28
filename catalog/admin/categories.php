<?php
/*
  TODO: cache refresh/triggers
 * musi se updatovat vsechny kategorie, nejen materska

  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2015 osCommerce

  Released under the GNU General Public License
 */

namespace PureOSC\Admin;
require('includes/application_top.php');

$currencies = new AdminCurrencies();

try {

//pure:NEW show all products categories, set canonical START
//save canonical category and return back to category listing
if (isset($_POST['set_canonical_return_back'])) {

    if (isset($_POST['product_canon_category']) && isset($_POST['product_cat_exists'])) {

        foreach ($_POST['product_cat_exists'] as $catId) {

            $cQ = tep_db_query("SELECT canonical FROM products_to_categories WHERE products_id=" . $_POST['products_id'] . " AND categories_id = " . $catId);

            $cA = tep_db_fetch_array($cQ);
            $can = ($cA['canonical'] > 0) ? true : false;


            if ($can && ($_POST['product_canon_category'] != $catId)) { //odkanonizovat
                tep_db_query("UPDATE products_to_categories SET canonical=null WHERE products_id=" . $_POST['products_id'] . " AND categories_id = " . $catId);
            } else if ((!$can) && ($_POST['product_canon_category'] == $catId)) { //kanonizovat
                tep_db_query("UPDATE products_to_categories SET canonical=1 WHERE products_id=" . $_POST['products_id'] . " AND categories_id = " . $catId);
            }
        }
    }

    tep_redirect($_POST['set_canonical_return_back']);
}

$action = (isset($_GET['action']) ? $_GET['action'] : ''); 

$discount = (isset($_POST['products_discount']) ? $_POST['products_discount'] : 0); 


// Ultimate SEO URLs v2.2d
// If the action will affect the cache entries
if (preg_match("/(insert|update|setflag)/i", $action)) {
    include_once('includes/reset_seo_cache.php');
}

if (tep_not_null($action)) {

$oQ = tep_db_query("SELECT DISTINCT products_options_id AS id FROM products_options");
while($oA = tep_db_fetch_array($oQ)) {

$id = $oA['id'];

if(isset($_POST['newactive_'.$id])) if($_POST['newactive_'.$id] != 'nic') {
//prdel("NOVY ATRIBUT '".$_POST['newactive']."' - POST: ".var_export($_POST, true)."\nGET: ".var_export($_GET, true)."\n");
$cQ = tep_db_query("SELECT products_options_values_color AS color FROM ".TABLE_PRODUCTS_OPTIONS_VALUES." WHERE products_options_values_id = " . $_POST['newactive_'.$id] . " AND language_id = " . $languages_id); 

if(tep_db_num_rows($cQ) > 0) {
  $cA = tep_db_fetch_array($cQ); 
  $c = $cA['color'];
} else $c = '';

$qok = tep_db_query($pq = "INSERT INTO " . TABLE_PRODUCTS_ATTRIBUTES . " SET products_id=" . $_GET['pID'] . ", options_id=".$id.", options_values_id=" . $_POST['newactive_'.$id] . ", options_values_price=1.00, price_prefix='+', options_values_color = '".$c."', products_options_sort_order=1, options_values_active=1");

if(isset($_POST['newactive_'.$id])) unset($_POST['newactive_'.$id]);

//$hs = 'Location: categories.php?' . tep_get_all_get_params(array('action')) . 'action=new_product';
$hs = 'categories.php?' . tep_get_all_get_params(array('action')) . 'action=new_product';
tep_redirect($hs);
}  

}
//}


if(! tep_session_is_registered('langexcl')) { 
  
  $langexcl = array();
  if(isset($_COOKIE['langexcl'])) { 
    $langA = explode(',', $_COOKIE['langexcl']); 
    foreach($langA as $lV) { 
      $expl = explode('=>', $lV);
      if(isset($expl[1])) $langexcl[$expl[0]] = $expl[1];
    }
  }
  
  tep_session_register('langexcl');
}

if(! tep_session_is_registered('shopexcl')) { 

  $shopexcl = isset($_COOKIE['shopexcl']) ? $_COOKIE['shopexcl'] : '';
  tep_session_register('shopexcl');
}


if($action == 'setexclude') {
  $langexcl = array();
  for($i = 0, $n = sizeof($languages); $i < $n; $i++) {
    if(! isset($_POST['exclude'][$i])) $langexcl[$languages[$i]['code']] = 1;
    else unset($_POST['exclude'][$i]);
  }
  
  if(count($langexcl) >= count($languages)) $langexcl = array('sk' => 1); //myslet za debily a bez js

  $langCook = '';
  foreach($langexcl as $lK => $lV) $langCook .= $lK . '=>' . $lV . ',';
  setcookie('langexcl', $langCook, time()+(60*60*24*3650));
  
  $shopexcl = '';
  foreach(array('yi', 'hau') as $s) {
    if(! isset($_POST['exclude_'.$s])) { if($shopexcl == '') $shopexcl = $s; }
    else unset($_POST['exclude_'.$s]);
  }
  
  setcookie('shopexcl', $shopexcl, time()+(60*60*24*3650));
  
  tep_redirect('categories.php?' . tep_get_all_get_params(array('action')) . 'action=new_product');
}
    switch ($action) {
        case 'setflag':
            if (($_GET['flag'] == '0') || ($_GET['flag'] == '1')) {
                if (isset($_GET['pID'])) {
                    tep_set_product_status($_GET['pID'], $_GET['flag']);
                }

                if (cfg('USE_CACHE') == 'true') {
                    tep_reset_cache_block('categories');
                    tep_reset_cache_block('also_purchased');
                }

                //pure:new cache reset
                if ($_GET['flag'] == '0') {
                    //deleting product need full reset
                    tep_db_query("UPDATE " . TABLE_RESET . " SET reset='1' WHERE admin = 'shop' AND section='all'");
                    tep_db_query("UPDATE " . TABLE_RESET . " SET reset='1' WHERE admin = 'admin' AND section='all'");
                } else {
                    tep_db_query("UPDATE " . TABLE_PRODUCTS_DESCRIPTION . " SET cached = 0 WHERE products_id = " . $_GET['pID']);
                    tep_db_query("UPDATE " . TABLE_PRODUCTS_DESCRIPTION . " SET cached_admin = 0 WHERE products_id = " . $_GET['pID']);
                    $cached_categories_query = tep_db_query("SELECT categories_id FROM " . TABLE_PRODUCTS_TO_CATEGORIES . " WHERE products_id=" . $_GET['pID']);
                    while ($cached_categories = tep_db_fetch_array($cached_categories_query)) {
                        tep_db_query("UPDATE " . TABLE_CATEGORIES_DESCRIPTION . " SET cached = 0 WHERE categories_id = " . $cached_categories['categories_id']);
                        tep_db_query("UPDATE " . TABLE_CATEGORIES_DESCRIPTION . " SET cached_admin = 0 WHERE categories_id = " . $cached_categories['categories_id']);
                    }
                }
            }
            tep_redirect(tep_href_link(cfg('FILENAME_CATEGORIES'),
                'cPath=' . $_GET['cPath'] . '&pID=' . $_GET['pID']));
            break;
        case 'insert_category':
        case 'update_category':
            if (isset($_POST['categories_id']))
                $categories_id = tep_db_prepare_input($_POST['categories_id']);
            $sort_order = tep_db_prepare_input($_POST['sort_order']);

            $sql_data_array = ['sort_order' => (int)$sort_order];

            if ($action == 'insert_category') {
                $insert_sql_data = ['parent_id' => $current_category_id,
                    'date_added' => 'now()'];

                $sql_data_array = array_merge($sql_data_array, $insert_sql_data);

                tep_db_perform(TABLE_CATEGORIES, $sql_data_array);

                $categories_id = tep_db_insert_id();
            } elseif ($action == 'update_category') {
                $update_sql_data = ['last_modified' => 'now()'];

                $sql_data_array = array_merge($sql_data_array, $update_sql_data);

                tep_db_perform(TABLE_CATEGORIES, $sql_data_array, 'update',
                    "categories_id = '" . (int)$categories_id . "'");
            }

            $languages = tep_get_languages();
            for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
                $categories_name_array = $_POST['categories_name'];
                $categories_description_array = $_POST['categories_description'];
                $categories_seo_title_array = $_POST['categories_seo_title'];
                $categories_seo_description_array = $_POST['categories_seo_description'];
                $categories_seo_keywords_array = $_POST['categories_seo_keywords'];

                $language_id = $languages[$i]['id'];

                $sql_data_array = ['categories_name' => tep_db_prepare_input($categories_name_array[$language_id])];
                $sql_data_array['categories_description'] = tep_db_prepare_input($categories_description_array[$language_id]);
                $sql_data_array['categories_seo_title'] = tep_db_prepare_input($categories_seo_title_array[$language_id]);
                $sql_data_array['categories_seo_description'] = tep_db_prepare_input($categories_seo_description_array[$language_id]);
                $sql_data_array['categories_seo_keywords'] = tep_db_prepare_input($categories_seo_keywords_array[$language_id]);

                if ($action == 'insert_category') {
                    $insert_sql_data = ['categories_id' => $categories_id,
                        'language_id' => $languages[$i]['id']];

                    $sql_data_array = array_merge($sql_data_array,
                        $insert_sql_data);
                    $catLangs[$languages[$i]['code']] = $sql_data_array;
                    tep_db_perform(TABLE_CATEGORIES_DESCRIPTION, $sql_data_array);
                } elseif ($action == 'update_category') {
                    tep_db_perform(TABLE_CATEGORIES_DESCRIPTION,
                        $sql_data_array, 'update',
                        "categories_id = '" . (int)$categories_id . "' and language_id = '" . (int)$languages[$i]['id'] . "'");
                }
            }

            $categories_image = new \upload('categories_image');
            $categories_image->set_destination(DIR_FS_CATALOG_IMAGES);

            if ($categories_image->parse() && $categories_image->save()) {
                tep_db_query("update " . TABLE_CATEGORIES . " set categories_image = '" . tep_db_input($categories_image->filename) . "' where categories_id = '" . (int)$categories_id . "'");
            }

            if (cfg('USE_CACHE') == 'true') {
                tep_reset_cache_block('categories');
                tep_reset_cache_block('also_purchased');
            }
            //pure new: cache reset (all, because change categories_top_menu)
            tep_db_query("UPDATE " . TABLE_RESET . " SET reset='1' WHERE admin = 'shop' AND section='all'");
            tep_db_query("UPDATE " . TABLE_RESET . " SET reset='1' WHERE admin = 'admin' AND section='all'");

            if($_POST['discount_id']){
                $coupouner = new Coupon((int)$_POST['discount_id']);
                $coupouner->assignCategory((int)$categories_id);
            }

            if (defined('USE_FLEXIBEE') && (constant('USE_FLEXIBEE') == 'true')) {
                $strom = new \PureOSC\flexibee\Strom();
                foreach ($catLangs as $langCode => $langData) {
                    $strom->takeData($strom->convertOscData($langData, $langCode));
                }
                if (!empty($current_category_id)) {
                    $strom->setDataValue('otec',
                        'ext:categories:' . $current_category_id);
                }
                if (!empty($categories_id)) {
                    $strom->setDataValue('id', 'ext:categories:' . $categories_id);
                }

                if (file_exists(DIR_FS_CATALOG_IMAGES . $categories_image->filename)) {
                    $strom->setDataValue('strobr',
                        base64_encode(file_get_contents(DIR_FS_CATALOG_IMAGES . $categories_image->filename)));
                }

                $strom->setDataValue('poradi', $categories_id);

                $strom->sync();
            }

            //pure:new redirect back to edit
            if (tep_not_null(tep_db_insert_id())) {
                tep_redirect(tep_href_link(cfg('FILENAME_CATEGORIES'),
                    'cPath=' . $cPath . '&cID=' . $categories_id . '&action=edit_category'));
            } else {
                tep_redirect(tep_href_link(cfg('FILENAME_CATEGORIES'),
                    'cPath=' . $cPath . '&cID=' . $categories_id));
            }
            break;
        case 'delete_category_confirm':
            if (isset($_POST['categories_id'])) {
                $categories_id = tep_db_prepare_input($_POST['categories_id']);

                //pure:new cache reset
                tep_db_query("UPDATE " . TABLE_RESET . " SET reset='1' WHERE admin = 'shop' AND section='all'");
                tep_db_query("UPDATE " . TABLE_RESET . " SET reset='1' WHERE admin = 'admin' AND section='all'");
                /*
                  $parent_query = tep_db_query("SELECT parent_id FROM " . TABLE_CATEGORIES . " WHERE categories_id=" . (int)$categories_id);
                  $parent = tep_db_fetch_array($parent_query);
                  if ($parent['parent_id'] > 0)	{
                  tep_db_query("UPDATE " . TABLE_CATEGORIES_DESCRIPTION . " SET cached = 0 WHERE categories_id = " . $parent['parent_id']);
                  tep_db_query("UPDATE " . TABLE_CATEGORIES_DESCRIPTION . " SET cached_admin = 0 WHERE categories_id = " . $parent['parent_id']);

                  }
                 */

                $categories = tep_get_category_tree($categories_id, '',
                    '0', '', true);
                $products = [];
                $products_delete = [];

                for ($i = 0, $n = sizeof($categories); $i < $n; $i++) {
                    $product_ids_query = tep_db_query("select products_id from " . TABLE_PRODUCTS_TO_CATEGORIES . " where categories_id = '" . (int)$categories[$i]['id'] . "'");

                    while ($product_ids = tep_db_fetch_array($product_ids_query)) {
                        $products[$product_ids['products_id']]['categories'][] = $categories[$i]['id'];
                    }
                }

                reset($products);
                while (list($key, $value) = each($products)) {
                    $category_ids = '';

                    for ($i = 0, $n = sizeof($value['categories']); $i < $n; $i++) {
                        $category_ids .= "'" . (int)$value['categories'][$i] . "', ";
                    }
                    $category_ids = substr($category_ids, 0, -2);

                    $check_query = tep_db_query("select count(*) as total from " . TABLE_PRODUCTS_TO_CATEGORIES . " where products_id = '" . (int)$key . "' and categories_id not in (" . $category_ids . ")");
                    $check = tep_db_fetch_array($check_query);
                    if ($check['total'] < '1') {
                        $products_delete[$key] = $key;
                    }
                }

// removing categories can be a lengthy process
                tep_set_time_limit(0);
                for ($i = 0, $n = sizeof($categories); $i < $n; $i++) {
                    tep_remove_category($categories[$i]['id']);
                }

                reset($products_delete);
                while (list($key) = each($products_delete)) {
                    tep_remove_product($key);
                }
            }

            if (cfg('USE_CACHE') == 'true') {
                tep_reset_cache_block('categories');
                tep_reset_cache_block('also_purchased');
            }

            tep_redirect(tep_href_link(cfg('FILENAME_CATEGORIES'), 'cPath=' . $cPath));
            break;
        case 'delete_product_confirm':
            if (isset($_POST['products_id']) && isset($_POST['product_categories'])
                && is_array($_POST['product_categories'])) {
                $product_id = tep_db_prepare_input($_POST['products_id']);
                $product_categories = $_POST['product_categories'];

                for ($i = 0, $n = sizeof($product_categories); $i < $n; $i++) {
                    tep_db_query("delete from " . TABLE_PRODUCTS_TO_CATEGORIES . " where products_id = '" . (int)$product_id . "' and categories_id = '" . (int)$product_categories[$i] . "'");
                }

                $product_categories_query = tep_db_query("select count(*) as total from " . TABLE_PRODUCTS_TO_CATEGORIES . " where products_id = '" . (int)$product_id . "'");
                $product_categories = tep_db_fetch_array($product_categories_query);

                if ($product_categories['total'] == '0') {
                    tep_remove_product($product_id);
                }
            }

            if (cfg('USE_CACHE') == 'true') {
                tep_reset_cache_block('categories');
                tep_reset_cache_block('also_purchased');
            }

            //pure new:cache reset (case 'delete_product_confirm') ALL deleting product content
            tep_db_query("UPDATE " . TABLE_RESET . " SET reset='1' WHERE admin = 'shop' AND section='all'");
            tep_db_query("UPDATE " . TABLE_RESET . " SET reset='1' WHERE admin = 'admin' AND section='all'");

            //pure new:canonical set if deleted
            $still_exists_canonical_query = tep_db_query("SELECT canonical FROM " . TABLE_PRODUCTS_TO_CATEGORIES . " WHERE products_id= " . (int)$product_id . " and canonical=1");
            if (!tep_db_num_rows($still_exists_canonical_query)) {
                $still_exists_query = tep_db_query("SELECT * FROM " . TABLE_PRODUCTS_TO_CATEGORIES . " WHERE products_id= " . (int)$product_id . " order by categories_id");
                if (tep_db_num_rows($still_exists_query)) {
                    $still_exists = tep_db_fetch_array($still_exists_query);
                    if (tep_db_num_rows($still_exists_query) > 1) {
                        $messageStack->add_session(ERROR_CANONICAL_DELETED,
                            'error');
                        tep_redirect(tep_href_link(cfg('FILENAME_CATEGORIES'),
                            tep_get_path($still_exists['categories_id']) . '&pID=' . (int)$product_id . '&action=set_canonical'));
                    }
                }
            }
            tep_redirect(tep_href_link(cfg('FILENAME_CATEGORIES'), 'cPath=' . $cPath));
            break;
        case 'set_canonical_confirm':
            if (isset($_POST['set_canonical']) && (isset($_POST['products_id']))) {
//      echo 'ano neco delam';
                tep_db_query("UPDATE " . TABLE_PRODUCTS_TO_CATEGORIES . " SET canonical = 1 WHERE products_id = " . $_POST['products_id'] . " AND categories_id=" . $_POST['set_canonical']);
            }
//exit;
            tep_redirect(tep_href_link(cfg('FILENAME_CATEGORIES'), 'cPath=' . $cPath));
            break;
        case 'move_category_confirm':
            if (isset($_POST['categories_id']) && ($_POST['categories_id'] != $_POST['move_to_category_id'])) {
                $categories_id = tep_db_prepare_input($_POST['categories_id']);
                $new_parent_id = tep_db_prepare_input($_POST['move_to_category_id']);

                $path = explode('_',
                    tep_get_generated_category_path_ids($new_parent_id));

                if (in_array($categories_id, $path)) {
                    $messageStack->add_session(ERROR_CANNOT_MOVE_CATEGORY_TO_PARENT,
                        'error');

                    tep_redirect(tep_href_link(cfg('FILENAME_CATEGORIES'),
                        'cPath=' . $cPath . '&cID=' . $categories_id));
                } else {
                    tep_db_query("update " . TABLE_CATEGORIES . " set parent_id = '" . (int)$new_parent_id . "', last_modified = now() where categories_id = '" . (int)$categories_id . "'");

                    if (cfg('USE_CACHE') == 'true') {
                        tep_reset_cache_block('categories');
                        tep_reset_cache_block('also_purchased');
                    }

                    tep_redirect(tep_href_link(cfg('FILENAME_CATEGORIES'),
                        'cPath=' . $new_parent_id . '&cID=' . $categories_id));
                }
            }

            break;
        case 'move_product_confirm':
            $products_id = tep_db_prepare_input($_POST['products_id']);
            $new_parent_id = tep_db_prepare_input($_POST['move_to_category_id']);

            $duplicate_check_query = tep_db_query("select count(*) as total from " . TABLE_PRODUCTS_TO_CATEGORIES . " where products_id = '" . (int)$products_id . "' and categories_id = '" . (int)$new_parent_id . "'");
            $duplicate_check = tep_db_fetch_array($duplicate_check_query);

            $old_category_query = tep_db_query("select categories_id from " . TABLE_PRODUCTS_TO_CATEGORIES . " where products_id = '" . (int)$products_id . "'");
            $oldCategories = tep_db_fetch_array($old_category_query);


            if ($duplicate_check['total'] < 1) {
                tep_db_query("update " . TABLE_PRODUCTS_TO_CATEGORIES . " set categories_id = '" . (int)$new_parent_id . "' where products_id = '" . (int)$products_id . "' and categories_id = '" . (int)$current_category_id . "'");
                //pure:new cache reset full!
                tep_db_query("UPDATE " . TABLE_RESET . " SET reset='1' WHERE admin = 'shop' AND section='all'");
                tep_db_query("UPDATE " . TABLE_RESET . " SET reset='1' WHERE admin = 'admin' AND section='all'");
            }
            if (defined('USE_FLEXIBEE') && (constant('USE_FLEXIBEE') == 'true')) {

                $sokoban = new PureOSC\flexibee\StromCenik();
                $pricelist = new PureOSC\flexibee\Cenik('ext:products:' . $products_id,
                    ['detail' => 'id']);
                foreach ($oldCategories as $oldCategory) {
                    $sokoban->deleteFromFlexiBee('ext:ptc:' . $oldCategory);
                }
                $sokoban->insertToFlexiBee(['id' => 'ext:ptc:' . $new_parent_id, 'idZaznamu' => $pricelist->getRecordID(),
                    'uzel' => 'ext:categories:' . $new_parent_id]);
            }

            if (cfg('USE_CACHE') == 'true') {
                tep_reset_cache_block('categories');
                tep_reset_cache_block('also_purchased');
            }

            tep_redirect(tep_href_link(cfg('FILENAME_CATEGORIES'),
                'cPath=' . $new_parent_id . '&pID=' . $products_id));
            break;
        case 'insert_product':
        case 'update_product':
            if (isset($_GET['pID']))
                $products_id = tep_db_prepare_input($_GET['pID']);
            if (!isset($_GET['products_date_available']))
              $_POST['products_date_available'] = date('Y-m-d');
            $products_date_available = tep_db_prepare_input($_POST['products_date_available']);

            //pure: make permanent, used for sorting $products_date_available = (date('Y-m-d') < $products_date_available) ? $products_date_available : 'null';
            
            if($_POST['discount_id']){
                $coupouner = new Coupon((int)$_POST['discount_id']);
                $coupouner->assignProduct((int)$products_id);
            }            

            //pure:new if empty product_template - use default
            if ($_POST['product_template'] == '') {
                $_POST['product_template'] = cfg('DEFAULT_PRODUCT_TEMPLATE');
            }
            //dirtyHack: TODO:error manufacturer is empty => no product 
            if ($_POST['manufacturers_id'] == '') {
              $_POST['manufacturers_id'] = cfg('DEFAULT_MANUFACTURERS_ID');
            }
            if ($_POST['products_weight'] == '') {
            	$_POST['products_weight'] = '1'; 
            }
            if (!isset($_GET['products_custom_date'])) {
              $_POST['products_custom_date'] = date('Y-m-d');
                }
                if (!isset($_POST['products_price'])) {
              $_POST['products_price'] = 0;
                }

            $sql_data_array = ['products_quantity' => (int)tep_db_prepare_input($_POST['products_quantity']),
                'products_model' => tep_db_prepare_input($_POST['products_model']),
                'products_price' => tep_db_prepare_input($_POST['products_price']),
                'products_date_available' => is_null($products_date_available) ? (new \DateTime())->format('Y-m-d') : $products_date_available,
                'products_weight' => (float)tep_db_prepare_input($_POST['products_weight']),
                'products_status' => (int)(tep_db_prepare_input($_POST['products_status'])),
                'products_tax_class_id' => (int)tep_db_prepare_input($_POST['products_tax_class_id']),
                'manufacturers_id' => (int)tep_db_prepare_input($_POST['manufacturers_id']),
                'product_template' => (int)tep_db_prepare_input($_POST['product_template']),
                'products_custom_date' => empty($_POST['products_custom_date']) ?  date('Y-m-d')   : tep_db_prepare_input($_POST['products_custom_date']),
                'products_sort_order' => (int)tep_db_prepare_input($_POST['products_sort_order'])
            ];

            if($products_date_available){
               $sql_data_array['products_date_available']  = $products_date_available;
            }
            
            $products_image = new \upload('products_image');
            $products_image->set_destination(DIR_FS_CATALOG_IMAGES);
            if ($products_image->parse() && $products_image->save()) {
                $sql_data_array['products_image'] = tep_db_prepare_input($products_image->filename);
            } else if(isset($_POST['products_image_delete'])) { //chkbox Odstranit
            
              $sql_data_array['products_image'] = ''; 
              
              @unlink(DIR_FS_CATALOG_IMAGES.$_POST['products_image_name']);
            }

            if ($action == 'insert_product') {
                $insert_sql_data = ['products_date_added' => 'now()'];

                $sql_product_data_array = array_merge($sql_data_array,
                    $insert_sql_data);

                tep_db_perform(TABLE_PRODUCTS, $sql_product_data_array);
                $products_id = tep_db_insert_id();
                //pure:new canonical
                $canon = isset($_POST['canonical']) ? '1' : 'null';
                tep_db_query("insert into " . TABLE_PRODUCTS_TO_CATEGORIES . " (products_id, categories_id, canonical) values ('" . (int)$products_id . "', '" . (int)$current_category_id . "', " . $canon . ")");
                
                
                if (/*USE_DEFAULT_DISCOUNT == 'true' &&*/ $_POST['products_model'] != 'e-book') {
                
                  if($discount > 0) {
                    $discountPrice = ($_POST['products_price'] * (1 - ($discount / 100))); 
                  
                    tep_db_query("insert into " . TABLE_SPECIALS . " (products_id, specials_new_products_price) values ('" . (int) $products_id . "', '" . str_replace(',', '.', $discountPrice) ."')"); 
                  }
                  
                }

                
            } elseif ($action == 'update_product') {
            
            
                $update_sql_data = ['products_last_modified' => 'now()'];

                $sql_product_data_array = array_merge($sql_data_array,
                    $update_sql_data);

                tep_db_perform(TABLE_PRODUCTS, $sql_product_data_array,
                    'update', "products_id = '" . (int)$products_id . "'"); 
                    
                if (isset($_POST['canonical'])) { //je zaskrt.
                    $wQ = tep_db_query("SELECT categories_id FROM " . TABLE_PRODUCTS_TO_CATEGORIES . " WHERE products_id = " . (int)$products_id);
                    while ($w = tep_db_fetch_array($wQ))
                        tep_db_query("UPDATE " . TABLE_PRODUCTS_TO_CATEGORIES . " SET canonical = null WHERE products_id = " . (int)$products_id . " AND categories_id = " . $w['categories_id']);

                    $uQ = tep_db_query("UPDATE " . TABLE_PRODUCTS_TO_CATEGORIES . " SET canonical = 1 WHERE products_id = " . (int)$products_id . " AND categories_id = " . $current_category_id);
                } 
                
                
                $discountPrice = (($discount > 0) ? ($_POST['products_price'] * (1 - ( $discount / 100))) : 0); 
                
                if( ($_POST['products_model'] == 'e-book') || ($discountPrice == 0) )  {
                  tep_db_query("DELETE from " . TABLE_SPECIALS . " WHERE products_id = '" . (int) $products_id . "'");
                } else { 
                                
                  $discountQ = tep_db_query("SELECT specials_new_products_price FROM " . TABLE_SPECIALS . " WHERE products_id = '" . (int) $products_id . "'"); 
                  
                  if (tep_db_num_rows($discountQ) > 0) { 
                    
                      tep_db_query("UPDATE " . TABLE_SPECIALS . " SET specials_new_products_price = " . str_replace(',', '.', $discountPrice) . " WHERE products_id = '" . (int) $products_id . "'"); 
                      
                  } else { 
                  
                    tep_db_query("INSERT INTO " . TABLE_SPECIALS . " (products_id, specials_new_products_price) VALUES ('" . (int) $products_id . "', '" . str_replace(',', '.', $discountPrice) ."')");
                  }
                }
                
            }

            $languages = tep_get_languages();
            for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
                $language_id = $languages[$i]['id'];

                $sql_data_array = ['products_name' => tep_db_prepare_input($_POST['products_name'][$language_id]),
                    'products_description' => tep_db_prepare_input($_POST['products_description'][$language_id]),
                    'products_url' => tep_db_prepare_input($_POST['products_url'][$language_id]),
                    'products_seo_title' => tep_db_prepare_input($_POST['products_seo_title'][$language_id]),
                    'products_seo_description' => tep_db_prepare_input($_POST['products_seo_description'][$language_id]),
                    'products_seo_keywords' => tep_db_prepare_input($_POST['products_seo_keywords'][$language_id]),
                    'products_mini_description' => tep_db_prepare_input($_POST['products_mini_description'][$language_id])];

                if ($action == 'insert_product') {
                    $insert_sql_data = ['products_id' => $products_id,
                        'language_id' => $language_id];

                    $sql_data_array = array_merge($sql_data_array,
                        $insert_sql_data);

                    tep_db_perform(TABLE_PRODUCTS_DESCRIPTION, $sql_data_array);
                } elseif ($action == 'update_product') {
                    tep_db_perform(TABLE_PRODUCTS_DESCRIPTION, $sql_data_array,
                        'update',
                        "products_id = '" . (int)$products_id . "' and language_id = '" . (int)$language_id . "'");
                }
                $proLangs[$languages[$i]['code']] = $sql_data_array;
            }

            $pi_sort_order = 0;
            $piArray = [0];

            foreach ($_FILES as $key => $value) {
// Update existing large product images
                if (preg_match('/^products_image_large_([0-9]+)$/', $key,
                    $matches)) {
                    $pi_sort_order++;

                    $sql_data_array = ['htmlcontent' => tep_db_prepare_input($_POST['products_image_htmlcontent_' . $matches[1]]),
                        'sort_order' => $pi_sort_order];

                    $t = new upload($key);
                    $t->set_destination(DIR_FS_CATALOG_IMAGES);
                    if ($t->parse() && $t->save()) {
                        $sql_data_array['image'] = tep_db_prepare_input($t->filename);
                    }

                    tep_db_perform(TABLE_PRODUCTS_IMAGES, $sql_data_array,
                        'update',
                        "products_id = '" . (int)$products_id . "' and id = '" . (int)$matches[1] . "'");

                    $piArray[] = (int)$matches[1];
                } elseif (preg_match('/^products_image_large_new_([0-9]+)$/',
                    $key, $matches)) {
// Insert new large product images
                    $sql_data_array = ['products_id' => (int)$products_id,
                    'opt_id' => tep_db_prepare_input($_POST['products_image_opt_id_new_'.$matches[1]]), 
                    'htmlcontent' => tep_db_prepare_input($_POST['products_image_htmlcontent_new_' . $matches[1]]), 
                    'sort_order' => $_POST['products_image_sort_order_new_' . $matches[1]]
                    ];

                    $t = new \upload($key);
                    $t->set_destination(DIR_FS_CATALOG_IMAGES);
                    if ($t->parse() && $t->save()) {
                        $pi_sort_order++;

                        $sql_data_array['image'] = tep_db_prepare_input($t->filename);
                        $sql_data_array['sort_order'] = $pi_sort_order;

                        tep_db_perform(TABLE_PRODUCTS_IMAGES, $sql_data_array);

                        $piArray[] = tep_db_insert_id();
                    }
                }
            }

            $product_images_query = tep_db_query("select image from " . TABLE_PRODUCTS_IMAGES . " where products_id = '" . (int)$products_id . "' and id not in (" . implode(',',
                    $piArray) . ")");
            if (tep_db_num_rows($product_images_query)) {
                while ($product_images = tep_db_fetch_array($product_images_query)) {
                    $duplicate_image_query = tep_db_query("select count(*) as total from " . TABLE_PRODUCTS_IMAGES . " where image = '" . tep_db_input($product_images['image']) . "'");
                    $duplicate_image = tep_db_fetch_array($duplicate_image_query);

                    if ($duplicate_image['total'] < 2) {
                        if (file_exists(DIR_FS_CATALOG_IMAGES . $product_images['image'])) {
                            @unlink(DIR_FS_CATALOG_IMAGES . $product_images['image']);
                        }
                    }
                }

                tep_db_query("delete from " . TABLE_PRODUCTS_IMAGES . " where products_id = '" . (int)$products_id . "' and id not in (" . implode(',',
                        $piArray) . ")");
            }

            if (cfg('USE_CACHE')) {
                tep_reset_cache_block('categories');
                tep_reset_cache_block('also_purchased');
            }
            //pure new: cache reset
            tep_db_query("UPDATE " . TABLE_PRODUCTS_DESCRIPTION . " SET cached = 0 WHERE products_id = " . (int)$products_id);
            tep_db_query("UPDATE " . TABLE_PRODUCTS_DESCRIPTION . " SET cached_admin = 0 WHERE products_id = " . (int)$products_id);
            $cached_categories_query = tep_db_query("SELECT categories_id FROM " . TABLE_PRODUCTS_TO_CATEGORIES . " WHERE products_id=" . (int)$products_id);
            while ($cached_categories = tep_db_fetch_array($cached_categories_query)) {
                tep_db_query("UPDATE " . TABLE_CATEGORIES_DESCRIPTION . " SET cached = 0 WHERE categories_id = " . $cached_categories['categories_id']);
                tep_db_query("UPDATE " . TABLE_CATEGORIES_DESCRIPTION . " SET cached_admin = 0 WHERE categories_id = " . $cached_categories['categories_id']);
            }


            //pure:new reload page

            if (cfg('USE_FLEXIBEE')) {
                $pricelist = new \PureOSC\flexibee\Cenik();
                $pricelist->takeData($pricelist->convertOscData($sql_product_data_array));
                foreach ($proLangs as $langCode => $langData) {
                    $pricelist->takeData($pricelist->convertOscData($langData,
                        $langCode));
                }
                if (!empty($products_id)) {
                    $pricelist->setDataValue('id', 'ext:products:' . $products_id);
                }

                $pricelist->sync();
                if (isset($_FILES['products_image'])) {
                    \FlexiPeeHP\Priloha::addAttachmentFromFile($pricelist,
                        cfg('DIR_FS_CATALOG_IMAGES') . $_FILES['products_image']['name']);
                }
            }


            if (tep_not_null(tep_db_insert_id())) {
                tep_redirect(tep_href_link(cfg('FILENAME_CATEGORIES'),
                    'cPath=' . $cPath . '&pID=' . $products_id . '&action=new_product&#meta-edit'));
            } else {
                tep_redirect(tep_href_link(cfg('FILENAME_CATEGORIES'),
                    'cPath=' . $cPath . '&pID=' . $products_id));
            }
            break;
        case 'copy_to_confirm':
            if (isset($_POST['products_id']) && isset($_POST['categories_id'])) {
                $products_id = tep_db_prepare_input($_POST['products_id']);
                $categories_id = tep_db_prepare_input($_POST['categories_id']);

                if ($_POST['copy_as'] == 'link') {
                    if ($categories_id != $current_category_id) {
                        $check_query = tep_db_query("select count(*) as total from " . TABLE_PRODUCTS_TO_CATEGORIES . " where products_id = '" . (int)$products_id . "' and categories_id = '" . (int)$categories_id . "'");
                        $check = tep_db_fetch_array($check_query);
                        if ($check['total'] < '1') {
                            tep_db_query("insert into " . TABLE_PRODUCTS_TO_CATEGORIES . " (products_id, categories_id) values ('" . (int)$products_id . "', '" . (int)$categories_id . "')");
                        }
                    } else {
                        $messageStack->add_session(ERROR_CANNOT_LINK_TO_SAME_CATEGORY,
                            'error');
                    }
                } elseif ($_POST['copy_as'] == 'duplicate') {
                    $product_query = tep_db_query("select products_quantity, products_model, products_image, products_price, products_date_available, products_weight, products_tax_class_id, manufacturers_id, product_template, products_custom_date, products_sort_order from " . TABLE_PRODUCTS . " where products_id = '" . (int)$products_id . "'");
                    $product = tep_db_fetch_array($product_query);

                    tep_db_query("insert into " . TABLE_PRODUCTS . " (products_quantity, products_model,products_image, products_price, products_date_added, products_date_available, products_weight, products_status, products_tax_class_id, manufacturers_id, product_template, products_custom_date, products_sort_order) values ('" . tep_db_input($product['products_quantity']) . "', '" . tep_db_input($product['products_model']) . "', '" . tep_db_input($product['products_image']) . "', '" . tep_db_input($product['products_price']) . "',  now(), " . (empty($product['products_date_available'])
                            ? "null" : "'" . tep_db_input($product['products_date_available']) . "'") . ", '" . tep_db_input($product['products_weight']) . "', '0', '" . (int)$product['products_tax_class_id'] . "', '" . (int)$product['manufacturers_id'] . "', '" . (int)$product['product_template'] . "', '" . (int)$product['products_custom_date'] . "', '" . (int)$product['products_sort_order'] . "')");
                    $dup_products_id = tep_db_insert_id();

                    $description_query = tep_db_query("select language_id, products_name, products_description, products_url, products_seo_title, products_seo_description, products_seo_keywords, products_mini_description from " . TABLE_PRODUCTS_DESCRIPTION . " where products_id = '" . (int)$products_id . "'");
                    while ($description = tep_db_fetch_array($description_query)) {
                        tep_db_query("insert into " . TABLE_PRODUCTS_DESCRIPTION . " (products_id, language_id, products_name, products_description, products_url, products_viewed, products_seo_title, products_seo_description, products_seo_keywords, products_mini_description) values ('" . (int)$dup_products_id . "', '" . (int)$description['language_id'] . "', '" . tep_db_input($description['products_name']) . "', '" . tep_db_input($description['products_description']) . "', '" . tep_db_input($description['products_url']) . "', '0', '" . tep_db_input($description['products_seo_title']) . "', '" . tep_db_input($description['products_seo_description']) . "', '" . tep_db_input($description['products_seo_keywords']) . "', '" . tep_db_input($description['products_mini_description']) . "')");
                    }

                    $product_images_query = tep_db_query("select image, htmlcontent, sort_order from " . TABLE_PRODUCTS_IMAGES . " where products_id = '" . (int)$products_id . "'");
                    while ($product_images = tep_db_fetch_array($product_images_query)) {
                        tep_db_query("insert into " . TABLE_PRODUCTS_IMAGES . " (products_id, image, htmlcontent, sort_order) values ('" . (int)$dup_products_id . "', '" . tep_db_input($product_images['image']) . "', '" . tep_db_input($product_images['htmlcontent']) . "', '" . tep_db_input($product_images['sort_order']) . "')");
                    }

                    tep_db_query("insert into " . TABLE_PRODUCTS_TO_CATEGORIES . " (products_id, categories_id) values ('" . (int)$dup_products_id . "', '" . (int)$categories_id . "')");
                    $products_id = $dup_products_id;
                }

                if (cfg('USE_CACHE') == 'true') {
                    tep_reset_cache_block('categories');
                    tep_reset_cache_block('also_purchased');
                }
                //pure:new: cache reset
                tep_db_query("UPDATE " . TABLE_CATEGORIES_DESCRIPTION . " SET cached = 0 WHERE categories_id = " . $categories_id);
                tep_db_query("UPDATE " . TABLE_CATEGORIES_DESCRIPTION . " SET cached_admin = 0 WHERE categories_id = " . $categories_id);
            }

            tep_redirect(tep_href_link(cfg('FILENAME_CATEGORIES'),
                'cPath=' . $categories_id . '&pID=' . $products_id));
            break;
    }
}

// check if the catalog image directory exists
if (is_dir(DIR_FS_CATALOG_IMAGES)) {
    if (!tep_is_writable(DIR_FS_CATALOG_IMAGES))
        $messageStack->add(ERROR_CATALOG_IMAGE_DIRECTORY_NOT_WRITEABLE,
            'error');
} else {
    $messageStack->add(ERROR_CATALOG_IMAGE_DIRECTORY_DOES_NOT_EXIST, 'error');
}

require(DIR_WS_INCLUDES . 'template_top.php');

$tax_class_array = [['id' => '2', 'text' => 'Default 21%']];
$tax_class_query = tep_db_query("select tax_class_id, tax_class_title from " . TABLE_TAX_CLASS . " order by tax_class_title");
while ($tax_class = tep_db_fetch_array($tax_class_query)) {
    $tax_class_array[] = ['id' => $tax_class['tax_class_id'],
        'text' => $tax_class['tax_class_title']];
}


    ?>
    <script type="text/javascript"><!--
        var tax_rates = new Array();
        <?php
        
        if(isset($_GET['pID'])) {
          $tQ = tep_db_query("SELECT products_tax_class_id FROM products WHERE products_id = ".$_GET['pID']); 
          if(tep_db_num_rows($tQ) > 0) {
            $tA = tep_db_fetch_array($tQ);
            echo 'var pTaxId = ' . $tA['products_tax_class_id'] . ';';
          }
        }
        
        for ($i = 0, $n = sizeof($tax_class_array); $i < $n; $i++) {
            if ($tax_class_array[$i]['id'] > 0) {
                echo 'tax_rates["' . $tax_class_array[$i]['id'] . '"] = ' . tep_get_tax_rate_value($tax_class_array[$i]['id']) . ';' . "\n";
            }
        }
        ?>

        function doRound(x, places) {
                return parseFloat(Math.round(x)).toFixed(places);
        }

        
        function doTrunc(x, places) { 
        
                x = parseFloat(x.toFixed(places));
                var pre = 0, s = x.toString(); 
                
                pre = s.indexOf(".");
                if(pre < 1) pre = s.length;
        
                if(s.indexOf(".9999") > 0) x += 0.0001;
                if(s.indexOf(".0001") > 0) x -= 0.0001;

                return parseFloat(x.toPrecision(pre + places));
        }

/*        
        function getCoefficient(taxRate){
            return taxRate / (100+taxRate);
        }

*/
        
        
        function getTaxRate() {
            var parameterVal = 0; 
            
            if(document.getElementById("tax_class_id")) {
              var selected_value = parseInt(document.getElementById("tax_class_id").selectedIndex);
              parameterVal = parseFloat(document.getElementById("tax_class_id")[selected_value].value);
              
            } else parameterVal = pTaxId;
            
            if ((parameterVal > 0) && (tax_rates[parameterVal] > 0)) {
                return parseFloat(tax_rates[parameterVal]);
            } else {
                return 0;
            }
        }

        
        function updateGross() {
            var taxRate = getTaxRate();
            var grossValue = parseFloat(document.forms["new_product"].products_price.value);
            if (taxRate > 0) {
                grossValue = grossValue * ((taxRate / 100) + 1);
            }

            document.forms["new_product"].products_price_gross.value = doTrunc(grossValue, 4);
        }

        function updateNet() {
            var taxRate = getTaxRate();
            var netValue = parseFloat(document.forms["new_product"].products_price_gross.value);
            if (taxRate > 0) {
                netValue = netValue / ((taxRate / 100)+1 );
            }

            document.forms["new_product"].products_price.value = doTrunc(netValue, 4);
        }


function updateGrossOpt(idx) {
//alert(idx);
//  var taxRate = 21; //getTaxRate(); 
  var taxRate = getTaxRate();

var sName = "priceplustax[" + idx + "]"; var bezName = "price[" + idx + "]";
//var grossValue = document.forms["new_product"][bezName].value;
var grossValue = document.forms["new_product"]["price[" + idx + "]"].value;

  if (taxRate > 0) {
    grossValue = grossValue * ((taxRate / 100) + 1);
  }

  document.forms["new_product"][sName].value = doTrunc(grossValue, 4); 
}

function updateGrossOptId(id) {

  var taxRate = getTaxRate();
  
  //document.getElementById("dbg").innerHTML += " prnet_"+id;
  var grossValue = document.getElementById("prnet_"+id).value; 

  if (taxRate > 0) {
    grossValue = grossValue * ((taxRate / 100) + 1);
  }

  //document.getElementById("dbg").innerHTML += " | prgross_"+id + " || ";
  
  document.getElementById("prgross_"+id).value = doTrunc(grossValue, 4);
}


function updateNetOpt(idx) {
  var taxRate = getTaxRate();

  var sName = "priceplustax[" + idx + "]"; var bezName = "price[" + idx + "]";
  var netValue = document.forms["new_product"][sName].value;

  if (taxRate > 0) {
    netValue = netValue / ((taxRate / 100) + 1);
  }

  document.forms["new_product"][bezName].value = doTrunc(netValue, 4); //doRound(netValue, 4);
}


function updateNetOptId(id) {

  var taxRate = getTaxRate();
  var netValue = document.getElementById("prgross_"+id).value; 

  if (taxRate > 0) {
    netValue = netValue / ((taxRate / 100) + 1);
  }

  document.getElementById("prnet_"+id).value = doTrunc(netValue, 4); //doRound(netValue, 4);
} 


//--></script>

<?php

if ($action == 'new_product') {

    $parameters = ['products_name' => '',
        'products_description' => '',
        'products_url' => '',
        'products_id' => '',
        'products_quantity' => '',
        'products_model' => '',
        'products_image' => '',
        'products_larger_images' => [],
        'products_price' => '',
        'products_weight' => '',
        'products_date_added' => '',
        'products_last_modified' => '',
        'canonical' => '',
        'products_date_available' => '',
        'products_status' => '',
        'products_tax_class_id' => '',
        'manufacturers_id' => '',
        'product_template' => '',
        'products_seo_title' => '',
        'products_seo_description' => '',
        'products_seo_keywords' => '',
        'products_mini_description' => '',
        'products_custom_date' => '',
        'products_sort_order' => ''
    ];

    $pInfo = new \objectInfo($parameters);

    if (isset($_GET['pID']) && empty($_POST)) {

        $product_query = tep_db_query("select pd.products_name, pd.products_description, pd.products_url, p.products_id, p.products_quantity, p.products_model, p.products_image, p.products_price, p.products_weight, p.products_date_added, p.products_last_modified, p2c.canonical, date_format(p.products_date_available, '%Y-%m-%d') as products_date_available, p.products_status, p.products_tax_class_id, p.manufacturers_id, p.product_template, pd.products_mini_description, date_format(p.products_custom_date, '%Y-%m-%d') as products_custom_date, p.products_sort_order from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c WHERE p2c.products_id=" . (int)$_GET['pID'] . " AND p2c.categories_id=" . $current_category_id . " AND p.products_id = '" . (int)$_GET['pID'] . "' AND p.products_id = pd.products_id AND pd.language_id = '" . (int)$languages_id . "'");
        $product = tep_db_fetch_array($product_query);

        $pInfo->objectInfo($product);

        $product_images_query = tep_db_query("select id, image, htmlcontent, sort_order from " . TABLE_PRODUCTS_IMAGES . " where products_id = '" . (int)$product['products_id'] . "' order by sort_order");
        while ($product_images = tep_db_fetch_array($product_images_query)) {
            $pInfo->products_larger_images[] = ['id' => $product_images['id'],
                'opt_id' => $product_images['opt_id'],
                'image' => $product_images['image'],
                'htmlcontent' => $product_images['htmlcontent'],
                'sort_order' => $product_images['sort_order']];
        } 
        
        
        $discountQ = tep_db_query("SELECT specials_new_products_price AS price_spec from " . TABLE_SPECIALS . " WHERE products_id = '" . (int) $product['products_id'] . "'"); 
        
        if(tep_db_num_rows($discountQ) > 0) {
        
          $discA = tep_db_fetch_array($discountQ);
          
          $diff = ($product['products_price'] - $discA['price_spec']);
          if($diff > 0) $discount = round(($diff / $product['products_price']) * 100); 
          else $discount = 0; 
          
          //echo 'spec=' . $discA['price_spec'] . 'price=' . $product['products_price'] . ' diff='.$diff;
        } else $discount = 0; 
    }

    $manufacturers_array = [['id' => '', 'text' => TEXT_NONE]];
    $manufacturers_query = tep_db_query("select manufacturers_id, manufacturers_name from " . TABLE_MANUFACTURERS . " order by manufacturers_name");
    while ($manufacturers = tep_db_fetch_array($manufacturers_query)) {
        $manufacturers_array[] = ['id' => $manufacturers['manufacturers_id'],
            'text' => $manufacturers['manufacturers_name']];
    }

//pure:new product_template
    $product_templates_array = [['id' => '', 'text' => TEXT_NONE]];
    $product_templates_query = tep_db_query("select product_template_id, product_template_name from " . TABLE_PRODUCT_TEMPLATES . " order by product_template_id");
    while ($ptpl = tep_db_fetch_array($product_templates_query)) {
        $product_templates_array[] = ['id' => $ptpl['product_template_id'],
            'text' => $ptpl['product_template_name']];
    }
//newEND

    $tax_class_array = [['id' => '0', 'text' => TEXT_NONE]];
    $tax_class_query = tep_db_query("select tax_class_id, tax_class_title from " . TABLE_TAX_CLASS . " order by tax_class_title");
    while ($tax_class = tep_db_fetch_array($tax_class_query)) {
        $tax_class_array[] = ['id' => $tax_class['tax_class_id'],
            'text' => $tax_class['tax_class_title']];
    }

    $languages = tep_get_languages();

    if (!isset($pInfo->products_status)) $pInfo->products_status = '1';
    switch ($pInfo->products_status) {
        case '0':
            $in_status = false;
            $out_status = true;
            break;
        case '1':
        default:
            $in_status = true;
            $out_status = false;
    }

    $form_action = (isset($_GET['pID'])) ? 'update_product' : 'insert_product';
    ?>
    <script type="text/javascript"><!--
        var tax_rates = new Array();
        <?php
        for ($i = 0, $n = sizeof($tax_class_array); $i < $n; $i++) {
            if ($tax_class_array[$i]['id'] > 0) {
                echo 'tax_rates["' . $tax_class_array[$i]['id'] . '"] = ' . tep_get_tax_rate_value($tax_class_array[$i]['id']) . ';' . "\n";
            }
        }
        ?>

        function doRound(x, places) {
                return parseFloat(Math.round(x)).toFixed(places);
        }

        function doTrunc(x, places) { 
        
                var pre = 0, s = x.toString(); 
                
                pre = s.indexOf(".");
                if(pre < 1) pre = s.length;
        
                return parseFloat(x.toPrecision(pre + places));
        }

        
        function getCoefficient(taxRate){
            return taxRate / (100+taxRate);
        }

        function getTaxRate() {
            var selected_value = parseInt(document.forms["new_product"].products_tax_class_id.selectedIndex);
            var parameterVal = parseFloat(document.forms["new_product"].products_tax_class_id[selected_value].value);
            if ((parameterVal > 0) && (tax_rates[parameterVal] > 0)) {
                return parseFloat(tax_rates[parameterVal]);
            } else {
                return 0;
            }
        }

        function updateGross() {
            var taxRate = getTaxRate();
            var grossValue = parseFloat(document.forms["new_product"].products_price.value);
            if (taxRate > 0) {
                grossValue = grossValue * ((taxRate / 100) + 1);
            }

            document.forms["new_product"].products_price_gross.value = doTrunc(grossValue, 4); //doRound(grossValue, 4);
        }

        function updateNet() {
            var taxRate = getTaxRate();
            var netValue = parseFloat(document.forms["new_product"].products_price_gross.value);
            if (taxRate > 0) {
                netValue = netValue / ((taxRate / 100) + 1);
            }

            document.forms["new_product"].products_price.value = doTrunc(netValue, 4); //doRound(netValue, 4);
        }

        //--></script>
    <?php echo tep_draw_form('new_product',
        cfg('FILENAME_CATEGORIES'),
        'cPath=' . $cPath . (isset($_GET['pID']) ? '&pID=' . $_GET['pID']
            : '') . '&action=' . $form_action,
        'post', 'enctype="multipart/form-data" class="form-horizontal"'); 
    
        $twbcontainer = new \Ease\TWB\Container();
    
    ?>
    <table border="0" width="100%" cellspacing="0" cellpadding="2">
        <tr>
            <td class="smallText" align="right">
                <?php
                echo '<a href="' . tep_href_link(FILENAME_CATEGORIES,
                        'cPath=' . $cPath . (isset($_GET['pID']) ? '&pID=' . $_GET['pID']
                            : '') . '&action=new_product&#meta-edit') . '">' . 
                            GOTO_META_ANCHOR . '</a>&nbsp;';
/*                echo tep_draw_button(IMAGE_SAVE, 'disk',
                        null, 'primary') . tep_draw_button(IMAGE_CANCEL,
                        'close',
                        tep_href_link(FILENAME_CATEGORIES,
                            'cPath=' . $cPath . (isset($_GET['pID'])
                                ? '&pID=' . $_GET['pID'] : ''))) . '&nbsp;';
*/
                ?></td>
        </tr>
        <tr>
            <td>
                <table border="0" width="100%" cellspacing="0" cellpadding="0">
                    <tr>
                        <td class="pageHeading"><?php echo sprintf( __('TEXT_NEW_PRODUCT', _('New product in %s')) ,
                                tep_output_generated_category_path($current_category_id)); ?></td>
                        <td class="pageHeading" align="right"><?php echo tep_draw_separator('pixel_trans.gif',
                                cfg('HEADING_IMAGE_WIDTH'), cfg('HEADING_IMAGE_HEIGHT')); ?></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
        </tr>
        <tr>
            <td>
                <table border="0" cellspacing="0" cellpadding="2">
                    <tr>
                        <td class="main"><?php echo __('TEXT_PRODUCTS_STATUS',_('Status')); ?></td>
                        <td class="main"><?php echo tep_draw_separator('pixel_trans.gif',
                                    '24', '15') . '&nbsp;' . tep_draw_radio_field('products_status',
                                    '1', $in_status) . '&nbsp;' . __('TEXT_PRODUCT_AVAILABLE',_('Availble'))  . '&nbsp;' . tep_draw_radio_field('products_status',
                                    '0', $out_status) . '&nbsp;' .__('TEXT_PRODUCT_NOT_AVAILABLE',  _('Not Availble')); ?></td>
                    </tr>
                    <tr>
                        <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif',
                                '1', '10'); ?></td>
                    </tr>

                    <tr>
                        <td class="main"><?php echo __('TEXT_PRODUCTS_CANONICAL',_('Canonical')); ?></td>
                        <td class="main"><?php
                            $isChk = $pInfo->canonical > 0 ? true : false;
                            $ro = false;
                            $wrn = false;
                            if (!$isChk) { //navrh samoopravy chybejicich
                                $canQ = tep_db_query($qs = "SELECT * FROM " . TABLE_PRODUCTS_TO_CATEGORIES . " WHERE canonical > 0 AND products_id = " . (int)$pInfo->products_id);
                                if (tep_db_num_rows($canQ) < 1) {
                                    $isChk = true;
                                    $wrn = true;
                                }
                                } else {
                                    $ro = true;
                                }

                            echo tep_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;'
                                . '<INPUT type="CHECKBOX" name="canonical" value="on"' . ($isChk
                                    ? (' CHECKED' . ($ro ? ' READONLY' : '')) : '') . '>'
                                . ($wrn ? (_('WARNING: Canonical category AutoDetection'))
                                    : ''); //.$qs
                            //. tep_draw_checkbox_field('canonical', 'on', ($pInfo->canonical > 0 ? true : false));
                            ?></td>
                    </tr>


                    <?php if (cfg('DISPLAY_DATE_AVAILABLE') == 'true') { ?>
                        <tr>
                            <td class="main"><?php echo __('TEXT_PRODUCTS_DATE_AVAILABLE',_('Date Availble')); ?></td>
                            <td class="main"><?php echo tep_draw_separator('pixel_trans.gif',
                                        '24', '15') . '&nbsp;' . 
                                    
                                   $input = new \Ease\Html\InputDateTag('products_date_available',$pInfo->products_date_available,['id'=>'products_date_available'] );
                                         
                                        ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif',
                                    '1', '10'); ?></td>
                        </tr>
                    <?php }
                    if (cfg('DISPLAY_PRODUCTS_CUSTOM_DATE') == 'true') {
                        ?>
                        <tr>
                            <td class="main"><?php echo TEXT_PRODUCTS_CUSTOM_DATE; ?></td>
                            <td class="main"><?php
                            
                            
                            
                            
                            echo tep_draw_separator('pixel_trans.gif','24', '15');


                            echo  new \Ease\Html\InputDateTag('products_custom_date',$pInfo->products_date_available,['id'=>'products_custom_date'] );
                            
                          ?></td>
                        </tr>
                        <tr>
                            <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif',
                                    '1', '10'); ?></td>
                        </tr>
                    <?php }
                    if (cfg('DISPLAY_PRODUCTS_SORT_ORDER') == 'true') {
                        ?>
                        <tr>
                            <td class="main"><?php echo TEXT_PRODUCTS_SORT_ORDER; ?></td>
                            <td class="main"><?php echo tep_draw_separator('pixel_trans.gif',
                                        '24', '15') . '&nbsp;' . 
                            new \Ease\Html\InputNumberTag('products_sort_order', $pInfo->products_sort_order, ['id'=>'products_sort_order']);
             
                            ?></td>
                        </tr>
                        <tr>
                            <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif',
                                    '1', '10'); ?></td>
                        </tr>
                    <?php }
                    if ( cfg('DISPLAY_PRODUCTS_MANUFACTURER') == 'true') {
                        ?>
                        <tr>
                            <td class="main"><?php echo __('TEXT_PRODUCTS_MANUFACTURER',_('Manufacturer')) ; ?></td>
                            <td class="main"><?php echo tep_draw_separator('pixel_trans.gif',
                                        '24', '15') . '&nbsp;' . tep_draw_pull_down_menu('manufacturers_id',
                                        $manufacturers_array, $pInfo->manufacturers_id); ?>
                                <?php echo '<a href='. tep_href_link( 'manufacturers.php?page=0&mID=&action=new' ) .'><i class="fa fa-plus"></i>'._('Add new').'</a>'; ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif',
                                    '1', '10'); ?></td>
                        </tr>
                        <!-- pure:new template select //-->
                        <tr>
                            <td class="main"><?php echo TEXT_PRODUCTS_TEMPLATE; ?></td>
                            <td class="main"><?php echo tep_draw_separator('pixel_trans.gif',
                                        '24', '15') . '&nbsp;' . tep_draw_pull_down_menu('product_template',
                                        $product_templates_array, $pInfo->product_template); ?></td>
                        </tr>
                        <tr>
                            <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif',
                                    '1', '10'); ?></td>
                        </tr>

                        <?php
                    }
                    for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
                        ?>
                        <tr>
                            <td class="main"><?php if ($i == 0) echo TEXT_PRODUCTS_NAME; ?></td>
                            <td class="main"><?php echo tep_image(tep_catalog_admin_href_link(DIR_WS_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'],
                                        '', 'SSL'), $languages[$i]['name']) . '&nbsp;' . tep_draw_input_field('products_name[' . $languages[$i]['id'] . ']',
                                        (empty($pInfo->products_id) ? '' : tep_get_products_name($pInfo->products_id,
                                            $languages[$i]['id']))); ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                    <tr>
                        <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif',
                                '1', '10'); ?></td>
                    </tr>
                    <?php if (cfg('DISPLAY_PRODUCTS_TAX_CLASS') == 'true') { ?>
                        <tr bgcolor="#ebebff">
                            <td class="main"><?php echo __('TEXT_PRODUCTS_TAX_CLASS',_('Tax Class')); ?></td>
                            <td class="main"><?php echo tep_draw_separator('pixel_trans.gif',
                                        '24', '15') . '&nbsp;' . tep_draw_pull_down_menu('products_tax_class_id',
                                        $tax_class_array, $pInfo->products_tax_class_id,
                                        'onchange="updateGross()"'); ?></td>
                        </tr>
                    <?php } ?>
                    
                    <tr bgcolor="#ebebff">
                        <td class="main"><?php echo  __('TEXT_PRODUCTS_PRICE_NET',_('Price NET')); ?></td>
                        <td class="main"><?php echo tep_draw_separator('pixel_trans.gif',
                                    '24', '15') . '&nbsp;' . tep_draw_input_field('products_price',
                                    $pInfo->products_price,
                                    'onkeyup="updateGross()"'); ?></td>
                    </tr>

                    
                    <?php if ( cfg('DISPLAY_PRODUCTS_TAX_CLASS')  == 'true') { ?>
                        <tr bgcolor="#ebebff">
                            <td class="main"><?php echo TEXT_PRODUCTS_PRICE_GROSS; ?></td>
                            <td class="main"><?php echo tep_draw_separator('pixel_trans.gif',
                                        '24', '15') . '&nbsp;' . tep_draw_input_field('products_price_gross',
                                        $pInfo->products_price, 'onkeyup="updateNet()"'); ?></td>
                        </tr>
                        
                        
                    <tr bgcolor="#ebebff">
                        <td class="main"><?php echo _('Discount'); ?></td>
                        <td class="main"><?php echo tep_draw_separator('pixel_trans.gif',
                                    '24', '15') . '&nbsp;' . tep_draw_input_field('products_discount', 
                                    (($form_action=='update_product') ? (string)$discount : DEFAULT_DISCOUNT)); ?>%</td>
                    </tr>
                        
                        <tr>
                            <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif',
                                    '1', '10'); ?></td>
                        </tr>
                        <script type="text/javascript"><!--
        updateGross();
        //-->
                        </script>
                        <?php
                    }
                    $pbe =  new ui\ProductEditorBlock( _('Choose discount campagin') , new ui\DiscountSelector('discount_id', array_key_exists($_GET['pID'], $_GET) ? $_GET['pID'] : 0,'product') );
                    echo $pbe;
                    for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
                        ?>
                        <tr>
                            <td class="main" valign="top"><?php if ($i == 0) echo __('TEXT_PRODUCTS_DESCRIPTION',_('Description')); ?></td>
                            <td>
                                <table border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td class="main"
                                            valign="top"><?php echo tep_image(tep_catalog_admin_href_link(cfg('DIR_WS_LANGUAGES') . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'],
                                                '', 'SSL'),
                                                $languages[$i]['name']); ?>&nbsp;
                                        </td>
                                        <td class="main"><?php echo tep_draw_textarea_field_ckeditor('products_description[' . $languages[$i]['id'] . ']',
                                                'soft', '70', '15',
                                                (empty($pInfo->products_id) ? '' : tep_get_products_description($pInfo->products_id,
                                                    $languages[$i]['id']))); ?></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                    <tr>
                        <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif',
                                '1', '10'); ?></td>
                    </tr>
                    <?php
                    if (DISPLAY_PRODUCTS_MINI_DESCRIPTION == 'true') {
                        for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
                            ?>
                            <tr>
                                <td class="main"
                                    valign="top"><?php if ($i == 0) echo TEXT_PRODUCTS_MINI_DESCRIPTION; ?></td>
                                <td>
                                    <table border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td class="main"
                                                valign="top"><?php echo tep_image(tep_catalog_admin_href_link(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'],
                                                    '', 'SSL'), $languages[$i]['name']); ?>&nbsp;
                                            </td>
                                            <td class="main"><?php echo tep_draw_textarea_field_ckeditor('products_mini_description[' . $languages[$i]['id'] . ']',
                                                    'soft', '70', '7',
                                                    (empty($pInfo->products_id) ? '' : tep_get_products_mini_description($pInfo->products_id,
                                                        $languages[$i]['id']))); ?></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                        <tr>
                            <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif',
                                    '1', '10'); ?></td>
                        </tr>
                    <?php }
                    if (DISPLAY_PRODUCTS_QUANTITY == 'true') {
                        ?>
                        <tr>
                            <td class="main"><?php echo TEXT_PRODUCTS_QUANTITY; ?></td>
                            <td class="main"><?php echo tep_draw_separator('pixel_trans.gif',
                                        '24', '15') . '&nbsp;' . tep_draw_input_field('products_quantity',
                                        $pInfo->products_quantity); ?></td>
                        </tr>
                        <tr>
                            <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif',
                                    '1', '10'); ?></td>
                        </tr>
                    <?php }
                    if (DISPLAY_PRODUCTS_MODEL == 'true') {
                        ?>
                        <tr>
                            <td class="main"><?php echo TEXT_PRODUCTS_MODEL; ?></td>
                            <td class="main"><?php echo tep_draw_separator('pixel_trans.gif',
                                        '24', '15') . '&nbsp;' . tep_draw_input_field('products_model',
                                        $pInfo->products_model); ?></td>
                        </tr>
                        <tr>
                            <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif',
                                    '1', '10'); ?></td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td class="main" valign="top"><?php echo TEXT_PRODUCTS_IMAGE; ?></td>
                        <td class="main" style="padding-left: 30px;">
                            <div><?php echo '<strong>' . TEXT_PRODUCTS_MAIN_IMAGE . ' <small>(' . SMALL_IMAGE_WIDTH . ' x ' . SMALL_IMAGE_HEIGHT . 'px)</small></strong><br />' . (tep_not_null($pInfo->products_image)
                                        ? '<a href="' . HTTP_CATALOG_ADMIN_SERVER . DIR_WS_CATALOG_IMAGES . $pInfo->products_image . '" target="_blank">' . $pInfo->products_image . '</a> &#124; '
                                        : '') . tep_draw_file_field('products_image'); ?></div>

                            <ul id="piList">
                                <?php
                                $pi_counter = 0;

                                foreach ($pInfo->products_larger_images as $pi) {
                                    $pi_counter++;

                                    echo '                <li id="piId' . $pi_counter . '" class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s" style="float: right;"></span><a href="#" onclick="showPiDelConfirm(' . $pi_counter . ');return false;" class="ui-icon ui-icon-trash" style="float: right;"></a><strong>' . TEXT_PRODUCTS_LARGE_IMAGE . '</strong><br />' . tep_draw_file_field('products_image_large_' . $pi['id']) . '<br /><a href="' . HTTP_CATALOG_ADMIN_SERVER . DIR_WS_CATALOG_IMAGES . $pi['image'] . '" target="_blank">' . $pi['image'] . '</a><br /><br />' . TEXT_PRODUCTS_LARGE_IMAGE_HTML_CONTENT . '<br />' . tep_draw_textarea_field('products_image_htmlcontent_' . $pi['id'],
                                            'soft', '70','3',
                                            $pi['htmlcontent']) . '</li>';
                                }
                                ?>
                            </ul>

                            <a href="#" onclick="addNewPiForm(); return false;"><span class="ui-icon ui-icon-plus"
                                                                                      style="float: left;"></span><?php echo TEXT_PRODUCTS_ADD_LARGE_IMAGE; ?>
                            </a>

                            <div id="piDelConfirm" title="<?php echo TEXT_PRODUCTS_LARGE_IMAGE_DELETE_TITLE; ?>">
                                <p><span class="ui-icon ui-icon-alert"
                                         style="float:left; margin:0 7px 20px 0;"></span><?php echo TEXT_PRODUCTS_LARGE_IMAGE_CONFIRM_DELETE; ?>
                                </p>
                            </div>

                            <style type="text/css">
                                #piList {
                                    list-style-type: none;
                                    margin: 0;
                                    padding: 0;
                                }

                                #piList li {
                                    margin: 5px 0;
                                    padding: 2px;
                                }
                            </style>

                            <script type="text/javascript">
                                $('#piList').sortable({
                                    containment: 'parent'
                                });
                                var piSize = <?php echo $pi_counter; ?>;

                                function addNewPiForm() {
                                    piSize++;
                                    $('#piList').append('<li id="piId' + piSize + '" class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s" style="float: right;"></span><a href="#" onclick="showPiDelConfirm(' + piSize + ');return false;" class="ui-icon ui-icon-trash" style="float: right;"></a><strong><?php echo _('image for Gallery'); ?></strong><br /><input type="file" name="products_image_large_new_' + piSize + '" /><br /><br /><?php echo _('HTML Replacement'); ?><br /><textarea class="ckeditor" name="products_image_htmlcontent_new_' + piSize + '" wrap="soft" cols="70" rows="3"></textarea></li>');
                                }

                                var piDelConfirmId = 0;
                                $('#piDelConfirm').dialog({
                                    autoOpen: false,
                                    resizable: false,
                                    draggable: false,
                                    modal: true,
                                    buttons: {
                                        'Delete': function () {
                                            $('#piId' + piDelConfirmId).effect('blind').remove();
                                            $(this).dialog('close');
                                        },
                                        Cancel: function () {
                                            $(this).dialog('close');
                                        }
                                    }
                                });

                                function showPiDelConfirm(piId) {
                                    piDelConfirmId = piId;
                                    $('#piDelConfirm').dialog('open');
                                }
                            </script>

                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif',
                                '1', '10'); ?></td>
                    </tr>
                    <?php
                    if (DISPLAY_PRODUCTS_URL
                        == 'true') {
                        for ($i = 0, $n = sizeof($languages); $i
                        < $n; $i++) {
                            ?>
                            <tr>
                                <td class="main"><?php if ($i == 0) echo TEXT_PRODUCTS_URL . '<br /><small>' . TEXT_PRODUCTS_URL_WITHOUT_HTTP . '</small>'; ?></td>
                                <td class="main"><?php echo tep_image(tep_catalog_admin_href_link(DIR_WS_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'],
                                            '',
                                            'SSL'),
                                            $languages[$i]['name']) . '&nbsp;' . tep_draw_input_field('products_url[' . $languages[$i]['id'] . ']',
                                            (isset($products_url[$languages[$i]['id']])
                                                ? stripslashes($products_url[$languages[$i]['id']])
                                                : tep_get_products_url($pInfo->products_id,
                                                    $languages[$i]['id']))); ?></td>
                            </tr>
                            <?php
                        }
                        ?>
                        <tr>
                            <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif',
                                    '1', '10'); ?></td>
                        </tr>
                    <?php }
                    if (DISPLAY_PRODUCTS_WEIGHT
                        == 'true') {
                        ?>
                        <tr>
                            <td class="main"><?php echo TEXT_PRODUCTS_WEIGHT; ?></td>
                            <td class="main"><?php echo tep_draw_separator('pixel_trans.gif',
                                        '24', '15') . '&nbsp;' . tep_draw_input_field('products_weight',
                                        $pInfo->products_weight); ?></td>
                        </tr>
                        <tr>
                            <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif',
                                    '1', '10'); ?></td>
                        </tr>
                        <?php
                    }
                    if (!isset($_GET['pID'])) {
                        ?>
                        <tr>
                            <td><?php echo NEW_PRODUCT_INSERTING; ?></td>
                            <td class="smallText"
                                align="right"><?php echo TEXT_SAVE_NOW . '&nbsp;' . tep_draw_button(cfg('IMAGE_SAVE'),
                                        'disk', null, 'primary') . tep_draw_button(cfg('IMAGE_CANCEL'),
                                        'close',
                                        tep_href_link(cfg('FILENAME_CATEGORIES'),
                                            'cPath=' . $cPath . (isset($_GET['pID'])
                                                ? '&pID=' . $_GET['pID']
                                                : ''))) . '&nbsp;'; ?></td>
                        </tr>
                        <?php
                    } else {
                        echo '<tr><td id="meta-edit">&nbsp;</td></tr>';
                    }
                    if (DISPLAY_PRODUCTS_SEO_TITLE
                        == 'true') {

                        for ($i = 0, $n = sizeof($languages); $i
                        < $n; $i++) {
                            ?>
                            <tr bgcolor="#eeeeee">
                                <td class="main"><?php if ($i == 0) echo TEXT_PRODUCTS_SEO_TITLE; ?></td>
                                <td class="main">
                                    <table>
                                        <tr>
                                            <td><?php echo tep_image(tep_catalog_admin_href_link(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'],
                                                        '', 'SSL'),
                                                        $languages[$i]['name']) . '&nbsp;'; ?></td>
                                            <td><?php
                                                if (tep_not_null(tep_get_products_name($pInfo->products_id,
                                                    $languages[$i]['id']))) {
                                                    if ( cfg('ADD_MANUFACTURER_SEO_TITLE')
                                                        == 'true'
                                                        && (tep_not_null($pInfo->manufacturers_id))
                                                        && (tep_not_null(tep_get_products_name($pInfo->products_id,
                                                            $languages[$i]['id'])))) {
                                                        $manufacturers_name_query
                                                            = tep_db_query("select manufacturers_name from " . TABLE_MANUFACTURERS . " WHERE manufacturers_id=" . $pInfo->manufacturers_id);
                                                        $manufacturers_name
                                                            = tep_db_fetch_array($manufacturers_name_query);
                                                        $emptytitle
                                                            = $manufacturers_name['manufacturers_name'] . ' ' . tep_get_products_name($pInfo->products_id,
                                                                $languages[$i]['id']);
                                                    } else {
                                                        $emptytitle
                                                            = tep_get_products_name($pInfo->products_id,
                                                            $languages[$i]['id']);
                                                    }
                                                } else {
                                                    $emptytitle = '';
                                                }
                                                
                                                echo '<input onKeyUp="count_title(' . $languages[$i]['id'] . ', '. (constant('META_TITLE_LENGHT') - mb_strlen(constant('STORE_NAME'))) . ')" name="products_seo_title[' . $languages[$i]['id'] . ']" id="seotitle_' . $languages[$i]['id'] . '" size="80" value="' . (empty(tep_get_products_seo_title($pInfo->products_id,
                                                        $languages[$i]['id']))
                                                        ? $emptytitle
                                                        : tep_get_products_seo_title($pInfo->products_id,
                                                            $languages[$i]['id'])) . '">';
                                                echo '<br />' . TEXT_META_TITLE_LENGHT_REMAINING_CHARACTERS . ': <span id="counter_title_' . $languages[$i]['id'] . '"></span> (max: ' . META_TITLE_LENGHT . ')';
                                                
                                                ?>
                                                
<script>
function count_title(langId, len) {
document.getElementById('counter_title_'+langId).innerHTML = len - document.getElementById('seotitle_'+langId).value.length;
}

count_title(<?php echo $languages[$i]['id']; ?>, <?php echo constant('META_TITLE_LENGHT') - mb_strlen(constant('STORE_NAME')); ?>);
</script>
                                                
                                                
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                        <tr>
                            <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif',
                                    '1', '10'); ?></td>
                        </tr>
                        <?php
                    }

                    if (DISPLAY_PRODUCTS_SEO_DESCRIPTION
                        == 'true') {
                        for ($i = 0, $n = sizeof($languages); $i
                        < $n; $i++) {
                            ?>
                            <tr bgcolor="#eeeeee">
                                <td class="main" valign="top"><?php if ($i
                                        == 0) echo TEXT_PRODUCTS_SEO_DESCRIPTION; ?></td>
                                <td>
                                    <table border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td class="main"
                                                valign="top"><?php echo tep_image(tep_catalog_admin_href_link(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'],
                                                    '', 'SSL'),
                                                    $languages[$i]['name']); ?>&nbsp;
                                            </td>
                                            <td class="main"><?php
                                            
                                                echo '<textarea onKeyUp="count_description(' . $languages[$i]['id'] . ', ' . META_DESCRIPTION_LENGHT . ')" name="products_seo_description[' . $languages[$i]['id'] . ']" id="seodescription_' . $languages[$i]['id'] . '" cols="80" rows="6">' . (empty(tep_get_products_seo_description($pInfo->products_id,
                                                        $languages[$i]['id'])) ? str_replace([
                                                        "\r", "\n"], '',
                                                        strip_tags(tep_get_products_description($pInfo->products_id,
                                                            $languages[$i]['id'])))
                                                        : tep_get_products_seo_description($pInfo->products_id,
                                                            $languages[$i]['id'])) . '</textarea>';
                                                echo '<br />' . TEXT_META_DESCRIPTION_LENGHT_REMAINING_CHARACTERS . ': <strong><span id="counter_description_' . $languages[$i]['id'] . '"></span></strong> (max: ' . META_DESCRIPTION_LENGHT . ')';
                                                
                                                ?>

<script>
function count_description(langId, len) {
document.getElementById('counter_description_' + langId).innerHTML = len - document.getElementById('seodescription_' + langId).value.length;
}

count_description(<?php echo $languages[$i]['id']; ?>, <?php echo META_DESCRIPTION_LENGHT; ?>);
</script> 
                                                
                                                
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                        <tr>
                            <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif',
                                    '1', '10'); ?></td>
                        </tr>
                        <?php
                    }
                    if (DISPLAY_PRODUCTS_SEO_KEYWORDS == 'true') {
                        for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
                            ?>
                            <tr bgcolor="#eeeeee">
                                <td class="main" valign="top"><?php if ($i
                                        == 0) echo TEXT_PRODUCTS_SEO_KEYWORDS; ?></td>
                                <td>
                                    <table border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td class="main"
                                                valign="top"><?php echo tep_image(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'],
                                                    $languages[$i]['name']); ?>&nbsp;
                                            </td>
                                            <td class="main"
                                                valign="top"><?php echo tep_draw_input_field('products_seo_keywords[' . $languages[$i]['id'] . ']',
                                                    tep_get_products_seo_keywords($pInfo->products_id,
                                                        $languages[$i]['id']),
                                                    'placeholder="' . PLACEHOLDER_COMMA_SEPARATION . '" style="width: 300px;"'); ?></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </table>
            </td>
        </tr>
        <tr>
            <td><?php echo tep_draw_separator('pixel_trans.gif',
                    '1',
                    '10'); ?></td>
        </tr>
        <tr>
            <td class="smallText" align="right"><?php echo tep_draw_hidden_field('products_date_added',
                        (tep_not_null($pInfo->products_date_added)
                            ? $pInfo->products_date_added
                            : date('Y-m-d'))) . tep_draw_button(cfg('IMAGE_SAVE'),
                        'disk',
                        null,
                        'primary') . tep_draw_button(cfg('IMAGE_CANCEL'),
                        'close',
                        tep_href_link(cfg('FILENAME_CATEGORIES'),
                            'cPath=' . $cPath . (isset($_GET['pID'])
                                ? '&pID=' . $_GET['pID']
                                : ''))); ?></td>
        </tr>
    </table>

    <script type="text/javascript">
        $('#products_date_availa                                                ble').datepicker({
            dateFormat: 'yy-mm-dd'
        });
        $('#products_custom_date').datepicker({
            dateFormat: 'yy-mm-dd'
        });
    </script>

    </form>
    <?php
} elseif ($action
    == 'new_product_preview') {
    $product_query
        = tep_db_query("select p.products_id, pd.language_id, pd.products_name, pd.products_description, pd.products_url, p.products_quantity, p.products_model, p.products_image, p.products_price, p.products_weight, p.products_date_added, p.products_last_modified, p.products_date_available, p.products_status, p.manufacturers_id, pd.products_seo_title, pd.products_seo_description, pd.products_seo_keywords, pd.products_mini_description, products_custom_date, products_sort_order from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_id = pd.products_id and p.products_id = '" . (int)$_GET['pID'] . "'");
    $product = tep_db_fetch_array($product_query);

    $pInfo = new objectInfo($product);
    $products_image_name
        = $pInfo->products_image;

    $languages = tep_get_languages();
    for ($i = 0, $n
        = sizeof($languages); $i
         < $n; $i++) {
        $pInfo->products_name
            = tep_get_products_name($pInfo->products_id,
            $languages[$i]['id']);
        $pInfo->products_description
            = tep_get_products_description($pInfo->products_id,
            $languages[$i]['id']);
        $pInfo->products_url
            = tep_get_products_url($pInfo->products_id,
            $languages[$i]['id']);
        $pInfo->products_seo_title
            = tep_get_products_seo_title($pInfo->products_id,
            $languages[$i]['id']);
        $pInfo->products_seo_description
            = tep_get_products_seo_description($pInfo->products_id,
            $languages[$i]['id']);
        $pInfo->products_seo_keywords
            = tep_get_products_seo_keywords($pInfo->products_id,
            $languages[$i]['id']);
        $pInfo->products_mini_description
            = tep_get_products_mini_description($pInfo->products_id,
            $languages[$i]['id']);
        ?>
        <table border="0" width="100%" cellspacing="0" cellpadding="2">
        <tr>
            <td>
                <table border="0" width="100%" cellspacing="0" cellpadding="0">
                    <tr>
                        <td class="pageHeading"><?php echo tep_image(tep_catalog_admin_href_link(DIR_WS_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'],
                                    '', 'SSL'),
                                    $languages[$i]['name']) . '&nbsp;' . $pInfo->products_name; ?></td>
                        <td class="pageHeading"
                            align="right"><?php echo $currencies->format($pInfo->products_price); ?></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td><?php echo tep_draw_separator('pixel_trans.gif',
                    '1', '10'); ?></td>
        </tr>
        <tr>
            <td class="main"><?php echo tep_image(HTTP_CATALOG_ADMIN_SERVER . DIR_WS_CATALOG_IMAGES . $products_image_name,
                        $pInfo->products_name,
                        SMALL_IMAGE_WIDTH,
                        SMALL_IMAGE_HEIGHT,
                        'align="right" hspace="5" vspace="5"') . $pInfo->products_description; ?></td>
        </tr>
        <?php
        if ($pInfo->products_url) {
            ?>
            <tr>
                <td><?php echo tep_draw_separator('pixel_trans.gif',
                        '1', '10'); ?></td>
            </tr>
            <tr>
                <td class="main"><?php echo sprintf(TEXT_PRODUCT_MORE_INFORMATION,
                        $pInfo->products_url); ?></td>
            </tr>
            <?php
        }
        ?>
        <tr>
            <td><?php echo tep_draw_separator('pixel_trans.gif',
                    '1', '10'); ?></td>
        </tr>

        <tr>
            <td><?php echo tep_draw_separator('pixel_trans.gif',
                    '1', '10'); ?></td>
        </tr>
        <?php
        if ($pInfo->products_date_available
            > date('Y-m-d')) {
            ?>
            <tr>
                <td align="center" class="smallText"><?php echo sprintf(TEXT_PRODUCT_DATE_AVAILABLE,
                        tep_date_long($pInfo->products_date_available)); ?></td>
            </tr>
            <?php
        } else {
            ?>
            <tr>
                <td align="center" class="smallText"><?php echo sprintf(TEXT_PRODUCT_DATE_ADDED,
                        tep_date_long($pInfo->products_date_added)); ?></td>
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

    if (isset($_GET['origin'])) {
        $pos_params = strpos($_GET['origin'],
            '?', 0);
        if ($pos_params != false) {
            $back_url = substr($_GET['origin'],
                0, $pos_params);
            $back_url_params = substr($_GET['origin'],
                $pos_params + 1);
        } else {
            $back_url = $_GET['origin'];
            $back_url_params = '';
        }
    } else {
        $back_url = cfg('FILENAME_CATEGORIES');
        $back_url_params = 'cPath=' . $cPath . '&pID=' . $pInfo->products_id;
    }
    ?>
    <tr>
        <td align="right" class="smallText"><?php echo tep_draw_button(IMAGE_BACK,
                'triangle-1-w',
                tep_href_link($back_url,
                    $back_url_params)); ?></td>
    </tr>
    </table>
    <?php
} else {
    ?>
    <table border="0" width="100%" cellspacing="0" cellpadding="2">
        <tr>
            <td>
                <table border="0" width="100%" cellspacing="0" cellpadding="0">
                    <tr>
                        <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
                        <td class="pageHeading" align="right"><?php echo tep_draw_separator('pixel_trans.gif',
                                1, cfg('HEADING_IMAGE_HEIGHT')); ?></td>
                        <td align="right">
                            <table border="0" width="100%" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td class="smallText" align="right">
                                        <?php
                                        echo tep_draw_form('search',
                                            cfg('FILENAME_CATEGORIES'), '',
                                            'get');
                                        echo __('HEADING_TITLE_SEARCH',_('Search')) . ' ' . tep_draw_input_field('search');
                                        echo tep_hide_session_id() . '</form>';
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="smallText" align="right">
                                        <?php
                                        echo tep_draw_form('goto',
                                            cfg('FILENAME_CATEGORIES'), '',
                                            'get');
                                        echo _('Go to') . ' ' . tep_draw_pull_down_menu('cPath',
                                                tep_get_category_tree(),
                                                $current_category_id,
                                                'onchange="this.form.submit();"');
                                        echo tep_hide_session_id() . '</form>';
                                        ?>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table border="0" width="100%" cellspacing="0" cellpadding="0">
                    <tr>
                        <td valign="top">
                            <table border="0" width="100%" cellspacing="0" cellpadding="2">
                                <tr class="dataTableHeadingRow">
                                    <td class="dataTableHeadingContent"><?php echo _('Categories / Products') ?></td>
                                    <td class="dataTableHeadingContent"
                                        align="center"><?php echo _('Status'); ?></td>
                                    <td class="dataTableHeadingContent"
                                        align="right"><?php echo _('Action'); ?>&nbsp;
                                    </td>
                                </tr>
                                <?php
                                $categories_count = 0;
                                $rows = 0;
                                if (isset($_GET['search'])) {
                                    $search = tep_db_prepare_input($_GET['search']);
                                    $categories_query = tep_db_query("select c.categories_id, cd.categories_name, cd.categories_description, cd.categories_seo_title, cd.categories_seo_description, cd.categories_seo_keywords, c.categories_image, c.parent_id, c.sort_order, c.date_added, c.last_modified from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where c.categories_id = cd.categories_id and cd.language_id = '" . (int)$languages_id . "' and cd.categories_name like '%" . tep_db_input($search) . "%' order by c.sort_order, cd.categories_name");
                                } else {
                                    $categories_query = tep_db_query("select c.categories_id, cd.categories_name, cd.categories_description, cd.categories_seo_title, cd.categories_seo_description, cd.categories_seo_keywords, c.categories_image, c.parent_id, c.sort_order, c.date_added, c.last_modified from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where c.parent_id = '" . (int)$current_category_id . "' and c.categories_id = cd.categories_id and cd.language_id = '" . (int)$languages_id . "' order by c.sort_order, cd.categories_name");
                                }
                                while ($categories = tep_db_fetch_array($categories_query)) {
                                    $categories_count++;
                                    $rows++;

// Get parent_id for subcategories if search
                                        if (isset($_GET['search'])) {
                                            $cPath = $categories['parent_id'];
                                        }

                                    if ((!isset($_GET['cID']) && !isset($_GET['pID'])
                                            || (isset($_GET['cID']) && ($_GET['cID']
                                                    == $categories['categories_id'])))
                                        && !isset($cInfo) && (substr($action,
                                                0, 3) != 'new')) {
                                        $category_childs = ['childs_count' => tep_childs_in_category_count($categories['categories_id'])];
                                        $category_products = ['products_count' => tep_products_in_category_count($categories['categories_id'])];

                                        $cInfo_array = array_merge($categories,
                                            $category_childs,
                                            $category_products);
                                        $cInfo = new \objectInfo($cInfo_array);
                                    }

                                    if (isset($cInfo) && is_object($cInfo)
                                        && ($categories['categories_id']
                                            == $cInfo->categories_id)) {
                                        echo '              <tr id="defaultSelected" class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . tep_href_link(cfg('FILENAME_CATEGORIES'),
                                                tep_get_path($categories['categories_id'])) . '\'">' . "\n";
                                    } else {
                                        echo '              <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . tep_href_link(cfg('FILENAME_CATEGORIES'),
                                                'cPath=' . $cPath . '&cID=' . $categories['categories_id']) . '\'">' . "\n";
                                    }
                                    ?>
                                    <td class="dataTableContent"><?php echo '<a href="' . tep_href_link(cfg('FILENAME_CATEGORIES'),
                                                tep_get_path($categories['categories_id'])) . '">' . tep_image(DIR_WS_ICONS . 'folder.gif',
                                                ICON_FOLDER) . '</a>&nbsp;<strong>' . $categories['categories_name'] . '</strong>'; ?></td>
                                    <td class="dataTableContent" align="center">&nbsp;</td>
                                    <td class="dataTableContent" align="right"><?php if (isset($cInfo)
                                            && is_object($cInfo) && ($categories['categories_id']
                                                == $cInfo->categories_id)) {
                                            echo tep_image(DIR_WS_IMAGES . 'icon_arrow_right.gif',
                                                '');
                                        } else {
                                            echo '<a href="' . tep_href_link(cfg('FILENAME_CATEGORIES'),
                                                    'cPath=' . $cPath . '&cID=' . $categories['categories_id']) . '">' . tep_image(DIR_WS_IMAGES . 'icon_info.gif',
                                                    IMAGE_ICON_INFO) . '</a>';
                                        } ?>&nbsp;
                                    </td>
                                    </tr>
                                    <?php
                                }

                                $products_count = 0;
                                    if (isset($_GET['search'])) {
                                        $products_query = tep_db_query("select p.products_id, pd.products_name, p.products_quantity, p.products_image, p.products_price, p.products_date_added, p.products_last_modified, p.products_date_available, p.products_status, p2c.categories_id, p.products_custom_date, p.products_sort_order from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c," . TABLE_MANUFACTURERS . " m where p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' and p.products_id = p2c.products_id AND p.manufacturers_id = m.manufacturers_id and pd.products_name like '%" . tep_db_input($search) . "%' order by " . PRODUCT_LIST_DEFAULT_SORT_ORDER);
                                    } else {
                                        $products_query = tep_db_query("SELECT p.products_id, pd.products_name, p.products_quantity, p.products_image, p.products_price, p.products_date_added, p.products_last_modified, p.products_date_available, p.products_status, p.products_custom_date, p.products_sort_order FROM " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c," . TABLE_MANUFACTURERS . " m WHERE p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' and p.products_id = p2c.products_id and p2c.categories_id = '" . (int)$current_category_id . "' AND p.manufacturers_id = m.manufacturers_id ORDER BY " . PRODUCT_LIST_DEFAULT_SORT_ORDER);
                                    }
                                while ($products = tep_db_fetch_array($products_query)) {
                                    $products_count++;
                                    $rows++;

// Get categories_id for product if search
                                    if (isset($_GET['search']))
                                        $cPath = $products['categories_id'];

                                    if ((!isset($_GET['pID']) && !isset($_GET['cID'])
                                            || (isset($_GET['pID']) && ($_GET['pID']
                                                    == $products['products_id'])))
                                        && !isset($pInfo) && !isset($cInfo)
                                        && (substr($action, 0, 3)
                                            != 'new')) {
// find out the rating average from customer reviews
                                        $reviews_query = tep_db_query("select (avg(reviews_rating) / 5 * 100) as average_rating from " . TABLE_REVIEWS . " where products_id = '" . (int)$products['products_id'] . "'");
                                        $reviews = tep_db_fetch_array($reviews_query);
                                        $pInfo_array = array_merge($products,
                                            $reviews);
                                        $pInfo = new \objectInfo($pInfo_array);
                                    }

                                    if (isset($pInfo) && is_object($pInfo)
                                        && ($products['products_id']
                                            == $pInfo->products_id)) {
                                        echo '              <tr id="defaultSelected" class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . tep_href_link(cfg('FILENAME_CATEGORIES'),
                                                'cPath=' . $cPath . '&pID=' . $products['products_id'] . '&action=new_product_preview') . '\'">' . "\n";
                                    } else {
                                        echo '              <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . tep_href_link(cfg('FILENAME_CATEGORIES'),
                                                'cPath=' . $cPath . '&pID=' . $products['products_id']) . '\'">' . "\n";
                                    }
                                    ?>
                                    <td class="dataTableContent"><?php echo '<a href="' . tep_href_link(cfg('FILENAME_CATEGORIES'),
                                                'cPath=' . $cPath . '&pID=' . $products['products_id'] . '&action=new_product_preview') . '">' . tep_image(DIR_WS_ICONS . 'preview.gif',
                                                ICON_PREVIEW) . '</a>&nbsp;' . $products['products_name']; ?></td>
                                    <td class="dataTableContent" align="center">
                                        <?php
                                        if ($products['products_status']
                                            == '1') {
                                            echo tep_image(DIR_WS_IMAGES . 'icon_status_green.gif',
                                                    IMAGE_ICON_STATUS_GREEN,
                                                    10, 10) . '&nbsp;&nbsp;<a href="' . tep_href_link(cfg('FILENAME_CATEGORIES'),
                                                    'action=setflag&flag=0&pID=' . $products['products_id'] . '&cPath=' . $cPath) . '">' . tep_image(DIR_WS_IMAGES . 'icon_status_red_light.gif',
                                                    IMAGE_ICON_STATUS_RED_LIGHT,
                                                    10, 10) . '</a>';
                                        } else {
                                            echo '<a href="' . tep_href_link(cfg('FILENAME_CATEGORIES'),
                                                    'action=setflag&flag=1&pID=' . $products['products_id'] . '&cPath=' . $cPath) . '">' . tep_image(DIR_WS_IMAGES . 'icon_status_green_light.gif',
                                                    IMAGE_ICON_STATUS_GREEN_LIGHT,
                                                    10, 10) . '</a>&nbsp;&nbsp;' . tep_image(DIR_WS_IMAGES . 'icon_status_red.gif',
                                                    IMAGE_ICON_STATUS_RED,
                                                    10, 10);
                                        }
                                        ?></td>
                                    <td class="dataTableContent" align="right"><?php if (isset($pInfo)
                                            && is_object($pInfo) && ($products['products_id']
                                                == $pInfo->products_id)) {
                                            echo tep_image(DIR_WS_IMAGES . 'icon_arrow_right.gif',
                                                '');
                                        } else {
                                            echo '<a href="' . tep_href_link(cfg('FILENAME_CATEGORIES'),
                                                    'cPath=' . $cPath . '&pID=' . $products['products_id']) . '">' . tep_image(DIR_WS_IMAGES . 'icon_info.gif',
                                                    IMAGE_ICON_INFO) . '</a>';
                                        } ?>&nbsp;
                                    </td>
                                    </tr>
                                    <?php
                                }

                                $cPath_back = '';
                                if (!empty($cPath_array)) {
                                    for ($i = 0, $n = sizeof($cPath_array)
                                        - 1; $i < $n; $i++) {
                                        if (empty($cPath_back)) {
                                            $cPath_back .= $cPath_array[$i];
                                        } else {
                                            $cPath_back .= '_' . $cPath_array[$i];
                                        }
                                    }
                                }

                                $cPath_back = (tep_not_null($cPath_back))
                                    ? 'cPath=' . $cPath_back . '&'
                                    : '';
                                ?>
                                <tr>
                                    <td colspan="3">
                                        <table border="0" width="100%" cellspacing="0" cellpadding="2">
                                            <tr>
                                                <td class="smallText"><?php echo _('Categories') . '&nbsp;' . $categories_count . '<br />' . TEXT_PRODUCTS . '&nbsp;' . $products_count; ?></td>
                                                <td align="right" class="smallText"><?php if (!empty($cPath_array)) echo tep_draw_button(IMAGE_BACK,
                                                        'triangle-1-w',
                                                        tep_href_link(cfg('FILENAME_CATEGORIES'),
                                                            $cPath_back . 'cID=' . $current_category_id));
                                                    if (!isset($_GET['search'])) echo tep_draw_button(IMAGE_NEW_CATEGORY,
                                                            'plus',
                                                            tep_href_link(cfg('FILENAME_CATEGORIES'),
                                                                'cPath=' . $cPath . '&action=new_category')) . tep_draw_button(IMAGE_NEW_PRODUCT,
                                                            'plus',
                                                            tep_href_link(cfg('FILENAME_CATEGORIES'),
                                                                'cPath=' . $cPath . '&action=new_product')); ?>&nbsp;
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <?php
                        $heading = [];
                        $contents = [];
                        switch ($action) {
                            case 'new_category':
                                $heading[] = ['text' => '<strong>' . _('New Category / Article') . '</strong>'];

                                $contents = ['form' => tep_draw_form('newcategory',
                                    cfg('FILENAME_CATEGORIES'),
                                    'action=insert_category&cPath=' . $cPath, 'post',
                                    'enctype="multipart/form-data"')];
                                $contents[] = ['text' => TEXT_NEW_CATEGORY_INTRO];


                                $category_inputs_string = $category_description_string = '';
                                $category_seo_title_string = '';
                                $category_seo_description_string = '';
                                $category_seo_keywords_string = '';

                                $languages = tep_get_languages();
                                for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
                                    $category_inputs_string .= '<br />' . tep_image(tep_catalog_admin_href_link(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'],
                                            '', 'SSL'), $languages[$i]['name']) . '&nbsp;' . tep_draw_input_field('categories_name[' . $languages[$i]['id'] . ']',
                                            NULL, 'style="width: 300px;"');
                                }
                                for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
                                    $category_seo_title_string .= '<br />' . tep_image(tep_catalog_admin_href_link(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'],
                                            '', 'SSL'), $languages[$i]['name']) . '&nbsp;' . tep_draw_input_field('categories_seo_title[' . $languages[$i]['id'] . ']',
                                            NULL, 'style="width: 300px;"');
                                }
                                for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
                                    $category_seo_description_string .= '<br />' . tep_image(tep_catalog_admin_href_link(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'],
                                            '', 'SSL'), $languages[$i]['name'], '', '',
                                            'style="vertical-align: top;"') . '&nbsp;' . tep_draw_textarea_field('categories_seo_description[' . $languages[$i]['id'] . ']',
                                            'soft', '80', '3');
                                }
                                for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
                                    $category_seo_keywords_string .= '<br />' . tep_image(tep_catalog_admin_href_link(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'],
                                            '', 'SSL'), $languages[$i]['name']) . '&nbsp;' . tep_draw_input_field('categories_seo_keywords[' . $languages[$i]['id'] . ']',
                                            NULL,
                                            'style="width: 300px;" placeholder="' . PLACEHOLDER_COMMA_SEPARATION . '"');
                                }
                                for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
                                    $category_description_string .= '<br />' . tep_image(tep_catalog_admin_href_link(DIR_WS_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'],
                                            '', 'SSL'), $languages[$i]['name'], '', '',
                                            'style="vertical-align: top;"') . '&nbsp;' . tep_draw_textarea_field_ckeditor('categories_description[' . $languages[$i]['id'] . ']',
                                            'soft', '80', '10');
                                }


                                $contents[] = ['text' => '<br />' . _('The Category name') . $category_inputs_string];
                                $contents[] = ['text' => '<br />' . TEXT_CATEGORIES_DESCRIPTION . $category_description_string];
                                $contents[] = ['text' => '<br />' . TEXT_SORT_ORDER . '<br />' . tep_draw_input_field('sort_order',
                                        '', 'size="2"')];
                                $contents[] = ['text' => '<br />' . TEXT_CATEGORIES_SEO_TITLE . $category_seo_title_string];
                                $contents[] = ['text' => '<br />' . TEXT_CATEGORIES_SEO_DESCRIPTION . $category_seo_description_string];
                                $contents[] = ['text' => '<br />' . TEXT_CATEGORIES_SEO_KEYWORDS . $category_seo_keywords_string];
                                $contents[] = ['text' => '<br />' . TEXT_CATEGORIES_IMAGE . '<br />' . tep_draw_file_field('categories_image')];
                                $contents[] = ['align' => 'center', 'text' => '<br />' . tep_draw_button(cfg('IMAGE_SAVE'),
                                        'disk', null, 'primary') . tep_draw_button(cfg('IMAGE_CANCEL'),
                                        'close',
                                        tep_href_link(cfg('FILENAME_CATEGORIES'), 'cPath=' . $cPath))];
                                break;
                            case 'edit_category':
                                $heading[] = ['text' => '<strong>' . TEXT_INFO_HEADING_EDIT_CATEGORY . '</strong>'];

                                $contents = ['form' => tep_draw_form('categories',
                                        cfg('FILENAME_CATEGORIES'),
                                        'action=update_category&cPath=' . $cPath, 'post',
                                        'enctype="multipart/form-data"') . tep_draw_hidden_field('categories_id',
                                        $cInfo->categories_id)];
                                $contents[] = ['text' => TEXT_EDIT_INTRO];

                                $category_inputs_string = $category_description_string = '';
                                $category_seo_title_string = '';
                                $category_seo_description_string = '';
                                $category_seo_keywords_string = '';

                                $languages = tep_get_languages();
                                for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
                                    $category_inputs_string .= '<br />' . tep_image(tep_catalog_admin_href_link(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'],
                                            '', 'SSL'), $languages[$i]['name']) . '&nbsp;' . tep_draw_input_field('categories_name[' . $languages[$i]['id'] . ']',
                                            tep_get_category_name($cInfo->categories_id,
                                                $languages[$i]['id']), 'style="width: 300px;"');
                                }
                            for ($i = 0, $n = sizeof($languages);
                                 $i < $n;
                                 $i++) {
                                $category_seo_title_string .= '<br />' . tep_image(tep_catalog_admin_href_link(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'],
                                        '', 'SSL'), $languages[$i]['name']) . '&nbsp;';

                                $emptytitle = tep_get_category_name($cInfo->categories_id,
                                    $languages[$i]['id']);
//		$category_seo_title_string .= '<input onKeyUp="count_title()" name="categories_seo_title[' . $languages[$i]['id'] . ']" id="seotitle" size="80" value="' . (empty(tep_get_category_seo_title($cInfo->categories_id, $languages[$i]['id'])) ? $emptytitle : tep_get_category_seo_title($cInfo->categories_id)) . '">';
//		$category_seo_title_string .= '<br />Počet znaků limit max: 70 aktuálně ULOŽENO: <strong>' . (empty(tep_get_category_seo_title($cInfo->categories_id, $languages[$i]['id'])) ? mb_strlen($emptytitle) : mb_strlen(tep_get_category_seo_title($cInfo->categories_id, $languages[$i]['id']))) . '</strong>  Editace aktuálně zbývá: <span id="counter_title"></span>';
                                $category_seo_title_string .= '<input onKeyUp="count_title(' . $languages[$i]['id'] . ', '. (constant('META_TITLE_LENGHT') - mb_strlen(constant('STORE_NAME'))) . ')" name="categories_seo_title[' . $languages[$i]['id'] . ']" id="seotitle_' . $languages[$i]['id'] . '" size="80" value="' . (empty(tep_get_category_seo_title($cInfo->categories_id,
                                        $languages[$i]['id'])) ? $emptytitle : tep_get_category_seo_title($cInfo->categories_id,
                                        $languages[$i]['id'])) . '">';
                                $category_seo_title_string .= '<br />' . TEXT_META_TITLE_LENGHT_REMAINING_CHARACTERS . ': <span id="counter_title_' . $languages[$i]['id'] . '"></span> (max: ' . META_TITLE_LENGHT . ')';
                                ?>
                                
                                
<script>
function count_title(langId, len) {
document.getElementById('counter_title_'+langId).innerHTML = len - document.getElementById('seotitle_'+langId).value.length;
}

count_title(<?php echo $languages[$i]['id']; ?>, <?php echo constant('META_TITLE_LENGHT') - mb_strlen(constant('STORE_NAME')); ?>);
</script>
                                
                                
                            <?php
                            }
                            for ($i = 0, $n = sizeof($languages);
                            $i < $n;
                            $i++) {
                            //        $category_seo_description_string .= '<br />' . tep_image(tep_catalog_admin_href_link(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], '', 'SSL'), $languages[$i]['name'], '', '', 'style="vertical-align: top;"') . '&nbsp;' . tep_draw_textarea_field('categories_seo_description[' . $languages[$i]['id'] . ']', 'soft', '60', '3', tep_get_category_seo_description($cInfo->categories_id, $languages[$i]['id']));
                            $category_seo_description_string .= '<br />' . tep_image(tep_catalog_admin_href_link(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'],
                                    '', 'SSL'), $languages[$i]['name'], '', '',
                                    'style="vertical-align: top;"') . '&nbsp;';
                            $category_seo_description_string .= '<textarea onKeyUp="count_description(' . $languages[$i]['id'] . ', ' . META_DESCRIPTION_LENGHT . ')" name="categories_seo_description[' . $languages[$i]['id'] . ']" id="seodescription_' . $languages[$i]['id'] . '" cols="80" rows="6">' . (empty(tep_get_category_seo_description($cInfo->categories_id,
                                    $languages[$i]['id'])) ? str_replace(["\r", "\n"],
                                    '',
                                    strip_tags(tep_get_category_description($cInfo->categories_id,
                                        $languages[$i]['id']))) : tep_get_category_seo_description($cInfo->categories_id,
                                    $languages[$i]['id'])) . '</textarea>';
                            $category_seo_description_string .= '<br />' . TEXT_META_DESCRIPTION_LENGHT_REMAINING_CHARACTERS . ': <strong><span id="counter_description_' . $languages[$i]['id'] . '"></span></strong> (max: ' . META_DESCRIPTION_LENGHT . ')';
                            ?>
                            
                            
<script>
function count_description(langId, len) {
document.getElementById('counter_description_' + langId).innerHTML = len - document.getElementById('seodescription_' + langId).value.length;
}

count_description(<?php echo $languages[$i]['id']; ?>, <?php echo META_DESCRIPTION_LENGHT; ?>);
</script> 

                                <?php
                            }
                                for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
                                    $category_seo_keywords_string .= '<br />' . tep_image(tep_catalog_admin_href_link(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'],
                                            '', 'SSL'), $languages[$i]['name']) . '&nbsp;' . tep_draw_input_field('categories_seo_keywords[' . $languages[$i]['id'] . ']',
                                            tep_get_category_seo_keywords($cInfo->categories_id,
                                                $languages[$i]['id']),
                                            'style="width: 300px;" placeholder="' . PLACEHOLDER_COMMA_SEPARATION . '"');
                                }
                                for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
                                    $category_description_string .= '<br />' . tep_image(tep_catalog_admin_href_link(DIR_WS_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'],
                                            '', 'SSL'), $languages[$i]['name'], '', '',
                                            'style="vertical-align: top;"') . '&nbsp;' . tep_draw_textarea_field_ckeditor('categories_description[' . $languages[$i]['id'] . ']',
                                            'soft', '80', '10',
                                            tep_get_category_description($cInfo->categories_id,
                                                $languages[$i]['id']));
                                }

                                $contents[] = ['text' => '<br />' . TEXT_EDIT_CATEGORIES_NAME . $category_inputs_string];
                                $contents[] = ['text' => '<br />' . TEXT_EDIT_CATEGORIES_DESCRIPTION . $category_description_string];
                                $contents[] = ['text' => '<br />' . TEXT_EDIT_CATEGORIES_SEO_TITLE . $category_seo_title_string];
                                $contents[] = ['text' => '<br />' . TEXT_EDIT_CATEGORIES_SEO_DESCRIPTION . $category_seo_description_string];
                                $contents[] = ['text' => '<br />' . TEXT_EDIT_CATEGORIES_SEO_KEYWORDS . $category_seo_keywords_string];
                                $contents[] = ['text' => '<br />' . tep_image(HTTP_CATALOG_ADMIN_SERVER . DIR_WS_CATALOG_IMAGES . $cInfo->categories_image,
                                        $cInfo->categories_name) . '<br />' . DIR_WS_CATALOG_IMAGES . '<br /><strong>' . $cInfo->categories_image . '</strong>'];
                                $contents[] = ['text' => '<br />' . TEXT_EDIT_CATEGORIES_IMAGE . '<br />' . tep_draw_file_field('categories_image')];
                                $contents[] = ['text' => '<br />' . TEXT_EDIT_SORT_ORDER . '<br />' . tep_draw_input_field('sort_order',
                                        $cInfo->sort_order, 'size="2"')];
                                $contents[] = ['align' => 'center', 'text' => '<br />' . tep_draw_button(cfg('IMAGE_SAVE'),
                                        'disk', null, 'primary') . tep_draw_button(cfg('IMAGE_CANCEL'),
                                        'close',
                                        tep_href_link(cfg('FILENAME_CATEGORIES'),
                                            'cPath=' . $cPath . '&cID=' . $cInfo->categories_id))];
                                $contents[] = [  'text' =>   _('Assign all products to discount campagin').'<br /> ('._('Onetime tool').')' ];
                                $contents[] = [  'text' =>   (new ui\DiscountSelector('discount_id', (int)$cInfo->categories_id ,'category'))->getRendered() ];
                                break;
                            case 'delete_category':
                                $heading[] = ['text' => '<strong>' . TEXT_INFO_HEADING_DELETE_CATEGORY . '</strong>'];

                                $contents = ['form' => tep_draw_form('categories',
                                        cfg('FILENAME_CATEGORIES'),
                                        'action=delete_category_confirm&cPath=' . $cPath) . tep_draw_hidden_field('categories_id',
                                        $cInfo->categories_id)];
                                $contents[] = ['text' => TEXT_DELETE_CATEGORY_INTRO];
                                $contents[] = ['text' => '<br /><strong>' . $cInfo->categories_name . '</strong>'];
                                if ($cInfo->childs_count > 0)
                                    $contents[] = ['text' => '<br />' . sprintf(TEXT_DELETE_WARNING_CHILDS,
                                            $cInfo->childs_count)];
                                if ($cInfo->products_count > 0)
                                    $contents[] = ['text' => '<br />' . sprintf(TEXT_DELETE_WARNING_PRODUCTS,
                                            $cInfo->products_count)];
                                $contents[] = ['align' => 'center', 'text' => '<br />' . tep_draw_button(IMAGE_DELETE,
                                        'trash', null, 'primary') . tep_draw_button(cfg('IMAGE_CANCEL'),
                                        'close',
                                        tep_href_link(cfg('FILENAME_CATEGORIES'),
                                            'cPath=' . $cPath . '&cID=' . $cInfo->categories_id))];
                                break;
                            case 'move_category':
                                $heading[] = ['text' => '<strong>' . TEXT_INFO_HEADING_MOVE_CATEGORY . '</strong>'];

                                $contents = ['form' => tep_draw_form('categories',
                                        cfg('FILENAME_CATEGORIES'),
                                        'action=move_category_confirm&cPath=' . $cPath) . tep_draw_hidden_field('categories_id',
                                        $cInfo->categories_id)];
                                $contents[] = ['text' => sprintf(TEXT_MOVE_CATEGORIES_INTRO,
                                    $cInfo->categories_name)];
                                $contents[] = ['text' => '<br />' . sprintf(TEXT_MOVE,
                                        $cInfo->categories_name) . '<br />' . tep_draw_pull_down_menu('move_to_category_id',
                                        tep_get_category_tree(), $current_category_id)];
                                $contents[] = ['align' => 'center', 'text' => '<br />' . tep_draw_button(IMAGE_MOVE,
                                        'arrow-4', null, 'primary') . tep_draw_button(cfg('IMAGE_CANCEL'),
                                        'close',
                                        tep_href_link(cfg('FILENAME_CATEGORIES'),
                                            'cPath=' . $cPath . '&cID=' . $cInfo->categories_id))];
                                break;
                            case 'delete_product':
                                $heading[] = ['text' => '<strong>' . TEXT_INFO_HEADING_DELETE_PRODUCT . '</strong>'];

                                $contents = ['form' => tep_draw_form('products',
                                        cfg('FILENAME_CATEGORIES'),
                                        'action=delete_product_confirm&cPath=' . $cPath) . tep_draw_hidden_field('products_id',
                                        $pInfo->products_id)];
                                $contents[] = ['text' => TEXT_DELETE_PRODUCT_INTRO];
                                $contents[] = ['text' => '<br /><strong>' . $pInfo->products_name . '</strong>'];

                                $product_categories_string = '';
                                $product_categories = tep_generate_category_path($pInfo->products_id,
                                    'product');
                                for ($i = 0, $n = sizeof($product_categories); $i < $n; $i++) {
                                    $category_path = '';
                                    for ($j = 0, $k = sizeof($product_categories[$i]); $j < $k; $j++) {
                                        $category_path .= $product_categories[$i][$j]['text'] . '&nbsp;&gt;&nbsp;';
                                    }
                                    $category_path = substr($category_path, 0, -16);
                                    $product_categories_string .= tep_draw_checkbox_field('product_categories[]',
                                            $product_categories[$i][sizeof($product_categories[$i]) - 1]['id'],
                                            true) . '&nbsp;' . $category_path . '<br />';
                                }
                                $product_categories_string = substr($product_categories_string, 0,
                                    -4);

                                $contents[] = ['text' => '<br />' . $product_categories_string];
                                $contents[] = ['align' => 'center', 'text' => '<br />' . tep_draw_button(IMAGE_DELETE,
                                        'trash', null, 'primary') . tep_draw_button(cfg('IMAGE_CANCEL'),
                                        'close',
                                        tep_href_link(cfg('FILENAME_CATEGORIES'),
                                            'cPath=' . $cPath . '&pID=' . $pInfo->products_id))];
                                break;
                            case 'move_product':
                                $heading[] = ['text' => '<strong>' . TEXT_INFO_HEADING_MOVE_PRODUCT . '</strong>'];

                                $contents = ['form' => tep_draw_form('products',
                                        cfg('FILENAME_CATEGORIES'),
                                        'action=move_product_confirm&cPath=' . $cPath) . tep_draw_hidden_field('products_id',
                                        $pInfo->products_id)];
                                $contents[] = ['text' => sprintf(TEXT_MOVE_PRODUCTS_INTRO,
                                    $pInfo->products_name)];
                                $contents[] = ['text' => '<br />' . TEXT_INFO_CURRENT_CATEGORIES . '<br /><strong>' . tep_output_generated_category_path($pInfo->products_id,
                                        'product') . '</strong>'];
                                $contents[] = ['text' => '<br />' . sprintf(TEXT_MOVE,
                                        $pInfo->products_name) . '<br />' . tep_draw_pull_down_menu('move_to_category_id',
                                        tep_get_category_tree(), $current_category_id)];
                                $contents[] = ['align' => 'center', 'text' => '<br />' . tep_draw_button(IMAGE_MOVE,
                                        'arrow-4', null, 'primary') . tep_draw_button(cfg('IMAGE_CANCEL'),
                                        'close',
                                        tep_href_link(cfg('FILENAME_CATEGORIES'),
                                            'cPath=' . $cPath . '&pID=' . $pInfo->products_id))];
                                break;
                            case 'copy_to':
                                $heading[] = ['text' => '<strong>' . TEXT_INFO_HEADING_COPY_TO . '</strong>'];

                                $contents = ['form' => tep_draw_form('copy_to',
                                        cfg('FILENAME_CATEGORIES'),
                                        'action=copy_to_confirm&cPath=' . $cPath) . tep_draw_hidden_field('products_id',
                                        $pInfo->products_id)];
                                $contents[] = ['text' => TEXT_INFO_COPY_TO_INTRO];
                                $contents[] = ['text' => '<br />' . TEXT_INFO_CURRENT_CATEGORIES . '<br /><strong>' . tep_output_generated_category_path($pInfo->products_id,
                                        'product') . '</strong>'];
                                $contents[] = ['text' => '<br />' . _('Categories') . '<br />' . tep_draw_pull_down_menu('categories_id',
                                        tep_get_category_tree(), $current_category_id)];
                                $contents[] = ['text' => '<br />' . TEXT_HOW_TO_COPY . '<br />' . tep_draw_radio_field('copy_as',
                                        'link', true) . ' ' . TEXT_COPY_AS_LINK . '<br />' . tep_draw_radio_field('copy_as',
                                        'duplicate') . ' ' . TEXT_COPY_AS_DUPLICATE];
                                $contents[] = ['align' => 'center', 'text' => '<br />' . tep_draw_button(IMAGE_COPY,
                                        'copy', null, 'primary') . tep_draw_button(cfg('IMAGE_CANCEL'),
                                        'close',
                                        tep_href_link(cfg('FILENAME_CATEGORIES'),
                                            'cPath=' . $cPath . '&pID=' . $pInfo->products_id))];
                                break;


                            case 'set_canonical':
                                $heading[] = ['text' => '<strong>' . TEXT_INFO_HEADING_SET_CANONICAL_CATEGORY . '</strong>'];

                                $contents = ['form' => tep_draw_form('products',
                                        cfg('FILENAME_CATEGORIES'),
                                        'action=set_canonical_confirm&cPath=' . $cPath) . tep_draw_hidden_field('products_id',
                                        $pInfo->products_id)];
                                $contents[] = ['text' => TEXT_SET_CANONICAL_CATEGORY_INTRO];
                                $contents[] = ['text' => '<br /><strong>' . $pInfo->products_name . '</strong>'];

                                $product_categories_string = '';
                                $product_categories = tep_generate_category_path($pInfo->products_id,
                                    'product');
                                for ($i = 0, $n = sizeof($product_categories); $i < $n; $i++) {
                                    $category_path = '';
                                    for ($j = 0, $k = sizeof($product_categories[$i]); $j < $k; $j++) {
                                        $category_path .= $product_categories[$i][$j]['text'] . '&nbsp;&gt;&nbsp;';
                                    }
                                    $category_path = substr($category_path, 0, -16);
//          $product_categories_string .= tep_draw_checkbox_field('product_categories[]', $product_categories[$i][sizeof($product_categories[$i])-1]['id'], true) . '&nbsp;' . $category_path . '<br />';
                                    $product_categories_string .= tep_draw_radio_field('set_canonical',
                                            $product_categories[$i][sizeof($product_categories[$i]) - 1]['id'],
                                            '') . '&nbsp;' . $category_path . '<br />';
                                }
                                $product_categories_string = substr($product_categories_string, 0,
                                    -4);

                                $contents[] = ['text' => '<br />' . $product_categories_string];
                                $contents[] = ['align' => 'center', 'text' => '<br />' . tep_draw_button(cfg('IMAGE_SAVE'),
                                        'disk', null, 'primary') . tep_draw_button(cfg('IMAGE_CANCEL'),
                                        'close',
                                        tep_href_link(cfg('FILENAME_CATEGORIES'),
                                            'cPath=' . $cPath . '&pID=' . $pInfo->products_id))];
                                break;


                            default:
                                if ($rows > 0) {
                                    if (isset($cInfo) && is_object($cInfo)) { // category info box contents
                                        $category_path_string = '';
                                        $category_path = tep_generate_category_path($cInfo->categories_id);
                                        for ($i = (sizeof($category_path[0]) - 1); $i > 0; $i--) {
                                            $category_path_string .= $category_path[0][$i]['id'] . '_';
                                        }
                                        $category_path_string = substr($category_path_string, 0, -1);

                                        $heading[] = ['text' => '<strong>' . $cInfo->categories_name . '</strong>'];
                                        $contents[] = ['align' => 'center', 'text' => tep_draw_button(IMAGE_EDIT,
                                                'document',
                                                tep_href_link(cfg('FILENAME_CATEGORIES'),
                                                    'cPath=' . $category_path_string . '&cID=' . $cInfo->categories_id . '&action=edit_category')) . tep_draw_button(IMAGE_DELETE,
                                                'trash',
                                                tep_href_link(cfg('FILENAME_CATEGORIES'),
                                                    'cPath=' . $category_path_string . '&cID=' . $cInfo->categories_id . '&action=delete_category')) . tep_draw_button(IMAGE_MOVE,
                                                'arrow-4',
                                                tep_href_link(cfg('FILENAME_CATEGORIES'),
                                                    'cPath=' . $category_path_string . '&cID=' . $cInfo->categories_id . '&action=move_category'))];
                                        $contents[] = ['text' => '<br />' . _('DATE ADDED') . ' ' . tep_date_short($cInfo->date_added)];
                                        if (tep_not_null($cInfo->last_modified))
                                            $contents[] = ['text' => TEXT_LAST_MODIFIED . ' ' . tep_date_short($cInfo->last_modified)];
                                        $contents[] = ['text' => '<br />' . tep_info_image($cInfo->categories_image,
                                                $cInfo->categories_name, cfg('HEADING_IMAGE_WIDTH'),
                                                cfg('HEADING_IMAGE_HEIGHT')) . '<br />' . $cInfo->categories_image];
                                        $contents[] = ['text' => '<br />' . TEXT_SUBCATEGORIES . ' ' . $cInfo->childs_count . '<br />' . TEXT_PRODUCTS . ' ' . $cInfo->products_count];
                                    } elseif (isset($pInfo) && is_object($pInfo)) { // product info box contents
                                        $heading[] = ['text' => '<strong>' . tep_get_products_name($pInfo->products_id,
                                                $languages_id) . '</strong>'];
                                                //TODO: cPathSearchErrorHACK    
                                                if (isset($_GET['search'])) {
                                                  $canonical_cPath_query = tep_db_query("SELECT categories_id FROM " . TABLE_PRODUCTS_TO_CATEGORIES . " WHERE products_id = " . $pInfo->products_id . " AND canonical = 1");
                                                  $canonical_cPath = tep_db_fetch_array($canonical_cPath_query);
                                                  $cPath = $canonical_cPath['categories_id'];
                                                }
                                                $buttons = str_replace('<a ', '<a accesskey="' . ACCESSKEY_SELECT .'" ', tep_draw_button(IMAGE_EDIT, 'document',
                                                tep_href_link(cfg('FILENAME_CATEGORIES',
                                                    'cPath=' . $cPath . '&pID=' . $pInfo->products_id . '&action=new_product'))) . tep_draw_button(IMAGE_DELETE,
                                                'trash',
                                                tep_href_link(cfg('FILENAME_CATEGORIES'),
                                                    'cPath=' . $cPath . '&pID=' . $pInfo->products_id . '&action=delete_product')) . tep_draw_button(IMAGE_MOVE,
                                                'arrow-4',
                                                tep_href_link(cfg('FILENAME_CATEGORIES'),
                                                    'cPath=' . $cPath . '&pID=' . $pInfo->products_id . '&action=move_product')) . tep_draw_button(IMAGE_COPY_TO,
                                                'copy',
                                                tep_href_link(cfg('FILENAME_CATEGORIES'),
                                                    'cPath=' . $cPath . '&pID=' . $pInfo->products_id . '&action=copy_to')));

                                        if (defined('USE_FLEXIBEE') && (constant('USE_FLEXIBEE') == 'true')) {
                                            $linker = new \FlexiPeeHP\Cenik(null, ['offline' => true]);
                                            $linker->setMyKey('ext:products:' . $pInfo->products_id);
                                            $buttons .= tep_draw_button(_('Open in FlexiBee'),
                                                'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9Im5vIj8+CjwhLS0gQ3JlYXRlZCB3aXRoIElua3NjYXBlIChodHRwOi8vd3d3Lmlua3NjYXBlLm9yZy8pIC0tPgoKPHN2ZwogICB4bWxuczpkYz0iaHR0cDovL3B1cmwub3JnL2RjL2VsZW1lbnRzLzEuMS8iCiAgIHhtbG5zOmNjPSJodHRwOi8vY3JlYXRpdmVjb21tb25zLm9yZy9ucyMiCiAgIHhtbG5zOnJkZj0iaHR0cDovL3d3dy53My5vcmcvMTk5OS8wMi8yMi1yZGYtc3ludGF4LW5zIyIKICAgeG1sbnM6c3ZnPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIKICAgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIgogICB4bWxuczpzb2RpcG9kaT0iaHR0cDovL3NvZGlwb2RpLnNvdXJjZWZvcmdlLm5ldC9EVEQvc29kaXBvZGktMC5kdGQiCiAgIHhtbG5zOmlua3NjYXBlPSJodHRwOi8vd3d3Lmlua3NjYXBlLm9yZy9uYW1lc3BhY2VzL2lua3NjYXBlIgogICB2ZXJzaW9uPSIxLjEiCiAgIGlkPSJzdmcyIgogICB4bWw6c3BhY2U9InByZXNlcnZlIgogICB3aWR0aD0iMTIwIgogICBoZWlnaHQ9IjEyMCIKICAgdmlld0JveD0iMCAwIDEyMCAxMjAiCiAgIHNvZGlwb2RpOmRvY25hbWU9ImZsZXhpYmVlLWxvZ28uc3ZnIgogICBpbmtzY2FwZTp2ZXJzaW9uPSIwLjkyLjEgcjE1MzcxIj48bWV0YWRhdGEKICAgICBpZD0ibWV0YWRhdGE4Ij48cmRmOlJERj48Y2M6V29yawogICAgICAgICByZGY6YWJvdXQ9IiI+PGRjOmZvcm1hdD5pbWFnZS9zdmcreG1sPC9kYzpmb3JtYXQ+PGRjOnR5cGUKICAgICAgICAgICByZGY6cmVzb3VyY2U9Imh0dHA6Ly9wdXJsLm9yZy9kYy9kY21pdHlwZS9TdGlsbEltYWdlIiAvPjxkYzp0aXRsZT48L2RjOnRpdGxlPjwvY2M6V29yaz48L3JkZjpSREY+PC9tZXRhZGF0YT48ZGVmcwogICAgIGlkPSJkZWZzNiIgLz48c29kaXBvZGk6bmFtZWR2aWV3CiAgICAgcGFnZWNvbG9yPSIjZmZmZmZmIgogICAgIGJvcmRlcmNvbG9yPSIjNjY2NjY2IgogICAgIGJvcmRlcm9wYWNpdHk9IjEiCiAgICAgb2JqZWN0dG9sZXJhbmNlPSIxMCIKICAgICBncmlkdG9sZXJhbmNlPSIxMCIKICAgICBndWlkZXRvbGVyYW5jZT0iMTAiCiAgICAgaW5rc2NhcGU6cGFnZW9wYWNpdHk9IjAiCiAgICAgaW5rc2NhcGU6cGFnZXNoYWRvdz0iMiIKICAgICBpbmtzY2FwZTp3aW5kb3ctd2lkdGg9IjEyODAiCiAgICAgaW5rc2NhcGU6d2luZG93LWhlaWdodD0iOTU1IgogICAgIGlkPSJuYW1lZHZpZXc0IgogICAgIHNob3dncmlkPSJmYWxzZSIKICAgICBpbmtzY2FwZTp6b29tPSIxLjMzNjI2NzQiCiAgICAgaW5rc2NhcGU6Y3g9IjI0My42ODg2MyIKICAgICBpbmtzY2FwZTpjeT0iMzAuODg2NjY3IgogICAgIGlua3NjYXBlOndpbmRvdy14PSIwIgogICAgIGlua3NjYXBlOndpbmRvdy15PSIzMiIKICAgICBpbmtzY2FwZTp3aW5kb3ctbWF4aW1pemVkPSIxIgogICAgIGlua3NjYXBlOmN1cnJlbnQtbGF5ZXI9ImcxMCIgLz48ZwogICAgIGlkPSJnMTAiCiAgICAgaW5rc2NhcGU6Z3JvdXBtb2RlPSJsYXllciIKICAgICBpbmtzY2FwZTpsYWJlbD0iaW5rX2V4dF9YWFhYWFgiCiAgICAgdHJhbnNmb3JtPSJtYXRyaXgoMS4zMzMzMzMzLDAsMCwtMS4zMzMzMzMzLDAsMTIwKSI+PGcKICAgICAgIGlkPSJnNDU0MSIKICAgICAgIHRyYW5zZm9ybT0idHJhbnNsYXRlKC0xMTIuMjUyOTgsMjEuMzI4MDY2KSI+PHBhdGgKICAgICAgICAgZD0iTSAxNzAuODY4LDAgMTg0LjI0NiwyMy4xNjE3IDE5Ny42MTcsMCBaIgogICAgICAgICBzdHlsZT0iZmlsbDojZjlhZTJkO2ZpbGwtb3BhY2l0eToxO2ZpbGwtcnVsZTpub256ZXJvO3N0cm9rZTpub25lO3N0cm9rZS13aWR0aDowLjEiCiAgICAgICAgIGlkPSJwYXRoMjIiCiAgICAgICAgIGlua3NjYXBlOmNvbm5lY3Rvci1jdXJ2YXR1cmU9IjAiIC8+PHBhdGgKICAgICAgICAgZD0ibSAxNzAuODY4LDAgLTEzLjM3NSwyMy4xNjE3IGggMjYuNzUzIHoiCiAgICAgICAgIHN0eWxlPSJmaWxsOiNkMjhiMjU7ZmlsbC1vcGFjaXR5OjE7ZmlsbC1ydWxlOm5vbnplcm87c3Ryb2tlOm5vbmU7c3Ryb2tlLXdpZHRoOjAuMSIKICAgICAgICAgaWQ9InBhdGgyNCIKICAgICAgICAgaW5rc2NhcGU6Y29ubmVjdG9yLWN1cnZhdHVyZT0iMCIgLz48cGF0aAogICAgICAgICBkPSJtIDE1Ny40OTMsMjMuMTYxNyAxMy4zNzUsMjMuMTY4IDEzLjM3OCwtMjMuMTY4IHoiCiAgICAgICAgIHN0eWxlPSJmaWxsOiM5MzYzMjc7ZmlsbC1vcGFjaXR5OjE7ZmlsbC1ydWxlOm5vbnplcm87c3Ryb2tlOm5vbmU7c3Ryb2tlLXdpZHRoOjAuMSIKICAgICAgICAgaWQ9InBhdGgyNiIKICAgICAgICAgaW5rc2NhcGU6Y29ubmVjdG9yLWN1cnZhdHVyZT0iMCIgLz48cGF0aAogICAgICAgICBkPSJNIDE3MC44NjgsNDYuMzI5NyBIIDE0NC4xMjEgTCAxMTcuMzY1LDAgaCAyNi43NTYgbCAyNi43NDcsNDYuMzI5NyIKICAgICAgICAgc3R5bGU9ImZpbGw6Izc2N2E3YztmaWxsLW9wYWNpdHk6MTtmaWxsLXJ1bGU6bm9uemVybztzdHJva2U6bm9uZTtzdHJva2Utd2lkdGg6MC4xIgogICAgICAgICBpZD0icGF0aDI4IgogICAgICAgICBpbmtzY2FwZTpjb25uZWN0b3ItY3VydmF0dXJlPSIwIiAvPjwvZz48L2c+PC9zdmc+',
                                                $linker->getApiURL());
                                        }

                                        $contents[] = ['align' => 'center', 'text' => $buttons];

                                        $contents[] = ['text' => '<br />' . _('DATE ADDED') . ' ' . tep_date_short($pInfo->products_date_added)];
                                        if (tep_not_null($pInfo->products_last_modified))
                                            $contents[] = ['text' => TEXT_LAST_MODIFIED . ' ' . tep_date_short($pInfo->products_last_modified)];
                                        if (tep_not_null($pInfo->products_date_available))
                                            $contents[] = ['text' => TEXT_DATE_AVAILABLE . ' ' . tep_date_short($pInfo->products_date_available)];
                                        if (tep_not_null($pInfo->products_custom_date))
                                            $contents[] = ['text' => TEXT_PRODUCTS_CUSTOM_DATE . ' ' . tep_date_short($pInfo->products_custom_date)];
                                        if (tep_not_null($pInfo->products_sort_order))
                                            $contents[] = ['text' => TEXT_PRODUCTS_SORT_ORDER . ' ' . $pInfo->products_sort_order];
                                        $contents[] = ['text' => '<br />' . tep_info_image($pInfo->products_image,
                                                $pInfo->products_name, SMALL_IMAGE_WIDTH,
                                                SMALL_IMAGE_HEIGHT) . '<br />' . $pInfo->products_image];
                                        $contents[] = ['text' => '<br />' . TEXT_PRODUCTS_PRICE_INFO . ' ' . $currencies->format($pInfo->products_price) . '<br />' . TEXT_PRODUCTS_QUANTITY_INFO . ' ' . $pInfo->products_quantity];
                                        $contents[] = ['text' => '<br />' . TEXT_PRODUCTS_AVERAGE_RATING . ' ' . number_format($pInfo->average_rating,
                                                2) . '%'];

                                        //pure:NEW show all products categories, set canonical START
                                        $contents[] = ['text' => '<br /><b>' . SET_CANONICAL_TITLE . '</b><br />'];
                                        $contents[] = ['text' => '<form action="' . cfg('FILENAME_CATEGORIES') . '" method="POST">'];
                                        $product_categories_string = '';
                                        $product_categories = tep_generate_category_path($pInfo->products_id,
                                            'product');
                                        for ($i = 0, $n = sizeof($product_categories); $i < $n; $i++) {
                                            $category_path = '';
                                            for ($j = 0, $k = sizeof($product_categories[$i]); $j < $k; $j++) {
                                                $category_path .= $product_categories[$i][$j]['text'] . '&nbsp;&gt;&nbsp;';
                                                $catId = $product_categories[$i][$j]['id']; //posl.zustane neprepsana-tedy platna
                                            }
                                            $category_path = substr($category_path, 0,
                                                -16);
                                            $canQ = tep_db_query("SELECT * FROM " . TABLE_PRODUCTS_TO_CATEGORIES . " WHERE categories_id = " . $catId . " AND products_id = " . $pInfo->products_id . " AND canonical > 0");
                                            $product_categories_string .= tep_draw_radio_field('product_canon_category',
                                                    $product_categories[$i][sizeof($product_categories[$i])
                                                    - 1]['id'],
                                                    ((tep_db_num_rows($canQ) > 0) ? true : false)) . '&nbsp;' . $category_path . '<INPUT type="HIDDEN" name="product_cat_exists[]" value="' . $product_categories[$i][sizeof($product_categories[$i])
                                                - 1]['id'] . '"><br />'; //((tep_db_num_rows($canQ) > 0) ? '&nbsp;<b>KANONICKÁ</b>' : '') .
                                        }
                                        $product_categories_string = substr($product_categories_string,
                                            0, -4);
                                        $contents[] = ['text' => '<br />' . $product_categories_string];
                                        $contents[] = ['text' => '<br />'];
                                        $contents[] = ['text' => '<INPUT type="HIDDEN" name="set_canonical_return_back" value="' . $_SERVER['REQUEST_URI'] . '"><INPUT type="HIDDEN" name="products_id" value="' . $pInfo->products_id . '"><INPUT type="SUBMIT" style="border:1px solid red" value="' . SAVE_NEW_CANONICAL . '"></ br>']; //
                                        $contents[] = ['text' => '</form></ br>'];
                                        //pure:NEW show all products categories, set canonical END
                                    }
                                } else { // create category/product info
                                    $heading[] = ['text' => '<strong>' . EMPTY_CATEGORY . '</strong>'];

                                    $contents[] = ['text' => TEXT_NO_CHILD_CATEGORIES_OR_PRODUCTS];
                                }
                                break;
                        }

                        if ((tep_not_null($heading)) && (tep_not_null($contents))) {
                            echo '            <td width="50%" valign="top">' . "\n";

                            $box = new \box;
                            echo $box->infoBox($heading, $contents);

                            echo '            </td>' . "\n";
                        }
                        ?>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <?php
}

require(DIR_WS_INCLUDES . 'template_bottom.php');
require(DIR_WS_INCLUDES . 'application_bottom.php');

} catch ( \Exception $e ) {
    echo $e->getMessage();
}
