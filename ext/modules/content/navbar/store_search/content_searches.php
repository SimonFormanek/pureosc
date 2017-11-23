<?php
/*
  $Id$ version 1.5 for oscommerce 2.3.4BS

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2015 osCommerce

  Released under the GNU General Public License
*/

  //get rid of the individual calls for files and replace it with the only one we need, application_top.php
  //from here all other files necessary are also included.
  chdir('../../../../../');

  require('includes/application_top.php');
  include(DIR_WS_LANGUAGES . $language . '/modules/content/navbar/cm_nb_store_search.php');


  if (isset($_POST['query'])) {
    $query = tep_db_prepare_input($_POST['query']);
  } else {
    //nothing to do
    $query = "";
    exit();
  }

  //here we can replace certain phrases that people may search for that are wrong, i have left my examples below.
  //for example i have people add food or foods onto the end of search phrases, but food is rarely used in product names.
  //or for if people add spaces where there shouldnt be or remove spaces when there should be

  if ($language == 'english') {
    $query = str_replace('/', '', $query); // avoid highlight crash
    $query = str_replace(' food', '', $query);
    $query = str_replace(' foods', '', $query);
  }

  if ($language == 'french') {
    $query = str_replace('/', '', $query); // avoid highlight crash
  }

  //Explode This Query

  $query_exploded = array();
  $query_exploded = explode(' ', $query);
  $query_exploded = array_unique($query_exploded);

  //if a characters are only "b" or "B" do nothing!
  if (($key = array_search("b", $query_exploded)) !== false) { unset($query_exploded[$key]); }
  if (($key = array_search("B", $query_exploded)) !== false) { unset($query_exploded[$key]); }

  //for highlight rule
  arsort($query_exploded);
  $query_exploded_new = '';
  foreach ($query_exploded as $highlight) {
    // <b> is not search engine sensitive
    $query_exploded_new .= '<b>' . $highlight . '</b>' . "E_OF_L";
  }
  $query_exploded_new = substr($query_exploded_new, 0, -6);

  $query_exploded_highlight = explode("E_OF_L", $query_exploded_new);


  //Generate Like Statement for Each Word To Find Categories, Second Level, That Match

  foreach ($query_exploded as $category) {
    $like_statement_category .= " cd.categories_name LIKE '%" . tep_db_input($category) . "%' AND ";
  }

  //Remove That Last AND
  $like_statement_category = substr($like_statement_category, 0, -4);

  //Select categories, that are second level, and that match our query

  $sqlquery = tep_db_query("SELECT distinct(c.categories_id), cd.categories_name, c.parent_id FROM categories_description cd, categories c WHERE cd.categories_id = c.categories_id AND" . $like_statement_category . " and cd.language_id = '" . (int)$languages_id . "' limit 22");

  if (tep_db_num_rows($sqlquery)) {

    while ($row = tep_db_fetch_array($sqlquery)) {
      $url_title = ucwords(strtolower($row['categories_name']));

      //highlight
      $url_title = str_ireplace($query_exploded, $query_exploded_highlight, $url_title);

//      $array[] = array('icon'  => "sitemap",
      $array[] = array('icon'  => '<span style="float:left; margin-right:10px;"><i class="fa fa-sitemap fa-2x"></i></span>',
                       'title' => $url_title,
                       'href'  => tep_href_link('index.php', 'cPath=' . $row['categories_id'], $request_type),
                       'price' => null);
    }
  }

  $like_statement_category = '';


  //We Have All Suggested Categories

  //Find Suggested Products

  foreach ($query_exploded as $product) {
    //Prevent SQL Injection Attempts
    $product = str_replace(array("'", ";", "*", "(", ")"), '', $product);
	
	//Add products_head_keywords_tag search option
	if (MODULE_NAVIGATION_BAR_STORE_SEARCH_MODEL_OR_KEYWORDS == 'Model') {
      $like_statement_product .= " (pd.products_name LIKE '%" . tep_db_input($product) . "%' OR p.products_model LIKE '%" . tep_db_input($product) . "%') AND ";
	} else {
      $like_statement_product .= " (pd.products_name LIKE '%" . tep_db_input($product) . "%' OR pd.products_head_keywords_tag LIKE '%" . tep_db_input($product) . "%') AND ";
	}
  }

  //Remove the Last And
  $like_statement_product = substr($like_statement_product, 0, -4);

  //Add p.products_image
  $sqlquery = tep_db_query("SELECT distinct(p.products_id), pd.products_name, p.products_image, p.products_price, p.products_tax_class_id FROM products_description pd, products p WHERE" . $like_statement_product . " AND pd.products_id = p.products_id and pd.language_id = '" . (int)$languages_id . "' and p.products_status limit 8");


  $p = 0; //Set Row
  if (tep_db_num_rows($sqlquery)) {
    while ($row = tep_db_fetch_array($sqlquery)) {
      $p++;
      $url_title = str_replace('’', '', $row['products_name']);

      //highlight
      $url_title = str_ireplace($query_exploded, $query_exploded_highlight, $url_title);

      if ($p > 7) {
//        $array[] = array('icon'  => "cart-plus",
        $array[] = array('icon'  => '<span style="float:left; margin-right:10px;"><i class="fa fa-plus-circle fa-2x"></i></span>',
                         'title' => MODULE_NAVIGATION_BAR_STORE_SEARCH_MORE_PRODUCT,
                         'href'  => tep_href_link('advanced_search_result.php', 'keywords=' . urlencode(str_replace(' ', ' ', $query)), $request_type) . '&search_in_description=' . (MODULE_NAVIGATION_BAR_STORE_SEARCH_FUNCTIONS == 'Descriptions' ? 1 : 0),
                         'price' => null);
        break;
      } else {

        if ($new_price = tep_get_products_special_price($row['products_id'])) {
          $price = '<s>' . $currencies->display_price($row['products_price'], tep_get_tax_rate($row['products_tax_class_id'])) . '</s> <span class="productSpecialPrice">' . $currencies->display_price($new_price, tep_get_tax_rate($row['products_tax_class_id'])) . '</span>';
        } else {
          $price = $currencies->display_price($row['products_price'], tep_get_tax_rate($row['products_tax_class_id']));
        }

		// image or icon for products
		if (MODULE_NAVIGATION_BAR_STORE_SEARCH_IMAGE_OR_ICON == 'Image') {
		  if ($row['products_image'] != '') {
			$image_product = 	'<span class="visible-xs" style="float:left; margin-right:10px;"><img src="' . DIR_WS_IMAGES . $row['products_image'] . '" width="' . MODULE_NAVIGATION_BAR_STORE_SEARCH_IMAGE_WIDTH_XS . '" height="auto"></span>';
			$image_product .= 	'<span class="visible-sm" style="float:left; margin-right:10px;"><img src="' . DIR_WS_IMAGES . $row['products_image'] . '" width="' . MODULE_NAVIGATION_BAR_STORE_SEARCH_IMAGE_WIDTH_SM . '" height="auto"></span>';
			$image_product .= 	'<span class="visible-md" style="float:left; margin-right:10px;"><img src="' . DIR_WS_IMAGES . $row['products_image'] . '" width="' . MODULE_NAVIGATION_BAR_STORE_SEARCH_IMAGE_WIDTH_MD . '" height="auto"></span>';
			$image_product .= 	'<span class="visible-lg" style="float:left; margin-right:10px;"><img src="' . DIR_WS_IMAGES . $row['products_image'] . '" width="' . MODULE_NAVIGATION_BAR_STORE_SEARCH_IMAGE_WIDTH_LG . '" height="auto"></span>';
		  } else {
			$image_product = 	'<span class="visible-xs" style="float:left; margin-right:10px;"><img src="' . DIR_WS_IMAGES . 'picture_o_trans.png" width="' . MODULE_NAVIGATION_BAR_STORE_SEARCH_IMAGE_WIDTH_XS . '" height="auto"></span>';
			$image_product .= 	'<span class="visible-sm" style="float:left; margin-right:10px;"><img src="' . DIR_WS_IMAGES . 'picture_o_trans.png" width="' . MODULE_NAVIGATION_BAR_STORE_SEARCH_IMAGE_WIDTH_SM . '" height="auto"></span>';
			$image_product .= 	'<span class="visible-md" style="float:left; margin-right:10px;"><img src="' . DIR_WS_IMAGES . 'picture_o_trans.png" width="' . MODULE_NAVIGATION_BAR_STORE_SEARCH_IMAGE_WIDTH_MD . '" height="auto"></span>';
			$image_product .= 	'<span class="visible-lg" style="float:left; margin-right:10px;"><img src="' . DIR_WS_IMAGES . 'picture_o_trans.png" width="' . MODULE_NAVIGATION_BAR_STORE_SEARCH_IMAGE_WIDTH_LG . '" height="auto"></span>';
		  }
		} else {
		  $image_product = 	'<span style="float:left; margin-right:10px;"><i class="fa fa-cart-plus fa-2x"></i></span>';
		}

//        $array[] = array('icon'  => "cart-plus",
        $array[] = array('icon'  => $image_product,
                         'title' => $url_title,
                         'href'  => tep_href_link('product_info.php', 'products_id=' . $row['products_id'], $request_type),
                         'price' => $price);
      }
    }
  } else {

//    $array[] = array('icon'  => "wrench",
    $array[] = array('icon'  => '<span style="float:left; margin-right:10px;"><i class="fa fa-search-plus fa-2x"></i></span>',
                     'title' => MODULE_NAVIGATION_BAR_STORE_SEARCH_NOT_FOUND,
                     'href'  => tep_href_link('advanced_search.php', 'keywords=' . urlencode(str_replace(' ', ' ', $query)), $request_type),
                     'price' => null);
  }

  //Start content searches in files

  if (tep_not_null(MODULE_NAVIGATION_BAR_STORE_SEARCH_PAGES)) {
    $content_files = array();

    foreach (explode(';', MODULE_NAVIGATION_BAR_STORE_SEARCH_PAGES) as $page) {
      $page = trim($page);

      if (!empty($page)) {
        $content_files[] = $page;
      }
    }

    foreach ($content_files as $file_name) {

      $file = DIR_WS_LANGUAGES . $language . '/' . $file_name;

      $lines = @file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

      if ($lines !== false) {
        $f = 0;
        foreach ($lines as $line) {
          $f++;
          // skip header
          if ( $f>8 ) { //empty rows shifted in @file!
            // Check if the line contains the string we're looking for, and add if it does
            foreach ($query_exploded as $q) {
              if (strpos(strtolower($line), strtolower($q)) !== false) {
				
				//you can add any page that contents useful information
				$row_file = array(	'conditions.php',
									'shipping.php',
									'privacy.php');

				//don't forget to add the translation for any page registred above and into language file(s)
				$rendition = array(	MODULE_NAVIGATION_BAR_STORE_SEARCH_PAGE_CONDITIONS,
									MODULE_NAVIGATION_BAR_STORE_SEARCH_PAGE_SHIPPING,
									MODULE_NAVIGATION_BAR_STORE_SEARCH_PAGE_PRIVACY);

				$page_title = str_replace($row_file, $rendition, $file_name);

//                $array[] = array('icon'  => "file",
                $array[] = array('icon'  => '<span style="float:left; margin-right:10px;"><i class="fa fa-file fa-2x"></i></span>',
//                                 'title' => sprintf(MODULE_NAVIGATION_BAR_STORE_SEARCH_PAGE, substr(basename($file), 0, -4)),
                                 'title' => sprintf(MODULE_NAVIGATION_BAR_STORE_SEARCH_PAGE, $page_title),
                                 'href'  => tep_href_link($file_name, null, $request_type),
                                 'price' => null);
                break 2;
              }
            }
          }
        }
      }

    }
  }
  // build json
  echo json_encode($array);
?>