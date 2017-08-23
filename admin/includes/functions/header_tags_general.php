<?php
/*
  $Id: header_tags_seo.php,v 1.0 2008/04/04 22:50:52 hpdl Exp $
  Originally Created by: Jack_mcs - http://www.oscommerce-solution.com
  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce
  Portions Copyright 2009 oscommerce-solution.com

  Released under the GNU General Public License
*/
  function tep_get_category_htc_title($category_id, $language_id) {
    $category_query = tep_db_query("select categories_htc_title_tag from " . TABLE_CATEGORIES_DESCRIPTION . " where categories_id = '" . (int)$category_id . "' and language_id = '" . (int)$language_id . "'");
    $category = tep_db_fetch_array($category_query);

    return $category['categories_htc_title_tag'];
  }
  
  function tep_get_category_htc_title_alt($category_id, $language_id) {
    $category_query = tep_db_query("select categories_htc_title_tag_alt from " . TABLE_CATEGORIES_DESCRIPTION . " where categories_id = '" . (int)$category_id . "' and language_id = '" . (int)$language_id . "'");
    $category = tep_db_fetch_array($category_query);

    return $category['categories_htc_title_tag_alt'];
  }

  function tep_get_category_htc_title_url($category_id, $language_id) {
    $category_query = tep_db_query("select categories_htc_title_tag_url from " . TABLE_CATEGORIES_DESCRIPTION . " where categories_id = '" . (int)$category_id . "' and language_id = '" . (int)$language_id . "'");
    $category = tep_db_fetch_array($category_query);

    return $category['categories_htc_title_tag_url'];
  }  
    
  function tep_get_category_htc_desc($category_id, $language_id) {
    $category_query = tep_db_query("select categories_htc_desc_tag from " . TABLE_CATEGORIES_DESCRIPTION . " where categories_id = '" . (int)$category_id . "' and language_id = '" . (int)$language_id . "'");
    $category = tep_db_fetch_array($category_query);

    return $category['categories_htc_desc_tag'];
  }
   
  function tep_get_category_htc_keywords($category_id, $language_id) {
    $category_query = tep_db_query("select categories_htc_keywords_tag from " . TABLE_CATEGORIES_DESCRIPTION . " where categories_id = '" . (int)$category_id . "' and language_id = '" . (int)$language_id . "'");
    $category = tep_db_fetch_array($category_query);

    return $category['categories_htc_keywords_tag'];
  }
  
  function tep_get_category_htc_description($category_id, $language_id) {
    $category_query = tep_db_query("select categories_htc_description from " . TABLE_CATEGORIES_DESCRIPTION . " where categories_id = '" . (int)$category_id . "' and language_id = '" . (int)$language_id . "'");
    $category = tep_db_fetch_array($category_query);

    return $category['categories_htc_description'];
  }
  
  function tep_get_category_htc_breadcrumb($category_id, $language_id) {
    $category_query = tep_db_query("select categories_htc_breadcrumb_text from " . TABLE_CATEGORIES_DESCRIPTION . " where categories_id = '" . (int)$category_id . "' and language_id = '" . (int)$language_id . "'");
    $category = tep_db_fetch_array($category_query);

    return $category['categories_htc_breacrumb_text'];
  }  

  function tep_get_products_head_title_tag($product_id, $language_id) {
    $product_query = tep_db_query("select products_head_title_tag from " . TABLE_PRODUCTS_DESCRIPTION . " where products_id = '" . (int)$product_id . "' and language_id = '" . (int)$language_id . "'");
    $product = tep_db_fetch_array($product_query);

    return $product['products_head_title_tag'];
  }
  
  function tep_get_products_head_title_tag_alt($product_id, $language_id) {
    $product_query = tep_db_query("select products_head_title_tag_alt from " . TABLE_PRODUCTS_DESCRIPTION . " where products_id = '" . (int)$product_id . "' and language_id = '" . (int)$language_id . "'");
    $product = tep_db_fetch_array($product_query);

    return $product['products_head_title_tag_alt'];
  }  
  
  function tep_get_products_head_title_tag_url($product_id, $language_id) {
    $product_query = tep_db_query("select products_head_title_tag_url from " . TABLE_PRODUCTS_DESCRIPTION . " where products_id = '" . (int)$product_id . "' and language_id = '" . (int)$language_id . "'");
    $product = tep_db_fetch_array($product_query);

    return $product['products_head_title_tag_url'];
  }  

  function tep_get_products_head_desc_tag($product_id, $language_id) {
    $product_query = tep_db_query("select products_head_desc_tag from " . TABLE_PRODUCTS_DESCRIPTION . " where products_id = '" . (int)$product_id . "' and language_id = '" . (int)$language_id . "'");
    $product = tep_db_fetch_array($product_query);

    return $product['products_head_desc_tag'];
  }

  function tep_get_products_head_keywords_tag($product_id, $language_id) {
    $product_query = tep_db_query("select products_head_keywords_tag from " . TABLE_PRODUCTS_DESCRIPTION . " where products_id = '" . (int)$product_id . "' and language_id = '" . (int)$language_id . "'");
    $product = tep_db_fetch_array($product_query);

    return $product['products_head_keywords_tag'];
  }
  
  function tep_get_products_head_breadcrumb_text($product_id, $language_id) {
    $product_query = tep_db_query("select products_head_breadcrumb_text from " . TABLE_PRODUCTS_DESCRIPTION . " where products_id = '" . (int)$product_id . "' and language_id = '" . (int)$language_id . "'");
    $product = tep_db_fetch_array($product_query);

    return $product['products_head_breadcrumb_text'];
  }
  
  function tep_get_products_head_listing_text($product_id, $language_id) {
    $product_query = tep_db_query("select products_head_listing_text from " . TABLE_PRODUCTS_DESCRIPTION . " where products_id = '" . (int)$product_id . "' and language_id = '" . (int)$language_id . "'");
    $product = tep_db_fetch_array($product_query);

    return $product['products_head_listing_text'];
  }

  function tep_get_products_head_sub_text($product_id, $language_id) {
    $product_query = tep_db_query("select products_head_sub_text from " . TABLE_PRODUCTS_DESCRIPTION . " where products_id = '" . (int)$product_id . "' and language_id = '" . (int)$language_id . "'");
    $product = tep_db_fetch_array($product_query);

    return $product['products_head_sub_text'];
  }
  
  function tep_get_manufacturer_htc_title($manufacturer_id, $language_id) {
    $manufacturer_query = tep_db_query("select manufacturers_htc_title_tag from " . TABLE_MANUFACTURERS_INFO . " where manufacturers_id = '" . (int)$manufacturer_id . "' and languages_id = '" . (int)$language_id . "'");
    $manufacturer = tep_db_fetch_array($manufacturer_query);

    return $manufacturer['manufacturers_htc_title_tag'];
  }
  
  function tep_get_manufacturer_htc_title_alt($manufacturer_id, $language_id) {
    $manufacturer_query = tep_db_query("select manufacturers_htc_title_tag_alt from " . TABLE_MANUFACTURERS_INFO . " where manufacturers_id = '" . (int)$manufacturer_id . "' and languages_id = '" . (int)$language_id . "'");
    $manufacturer = tep_db_fetch_array($manufacturer_query);

    return $manufacturer['manufacturers_htc_title_tag_alt'];
  }

  function tep_get_manufacturer_htc_title_url($manufacturer_id, $language_id) {
    $manufacturer_query = tep_db_query("select manufacturers_htc_title_tag_url from " . TABLE_MANUFACTURERS_INFO . " where manufacturers_id = '" . (int)$manufacturer_id . "' and languages_id = '" . (int)$language_id . "'");
    $manufacturer = tep_db_fetch_array($manufacturer_query);

    return $manufacturer['manufacturers_htc_title_tag_url'];
  }  
    
  function tep_get_manufacturer_htc_desc($manufacturer_id, $language_id) {
    $manufacturer_query = tep_db_query("select manufacturers_htc_desc_tag from " . TABLE_MANUFACTURERS_INFO . " where manufacturers_id = '" . (int)$manufacturer_id . "' and languages_id = '" . (int)$language_id . "'");
    $manufacturer = tep_db_fetch_array($manufacturer_query);

    return $manufacturer['manufacturers_htc_desc_tag'];
  }
   
  function tep_get_manufacturer_htc_keywords($manufacturer_id, $language_id) {
    $manufacturer_query = tep_db_query("select manufacturers_htc_keywords_tag from " . TABLE_MANUFACTURERS_INFO . " where manufacturers_id = '" . (int)$manufacturer_id . "' and languages_id = '" . (int)$language_id . "'");
    $manufacturer = tep_db_fetch_array($manufacturer_query);

    return $manufacturer['manufacturers_htc_keywords_tag'];
  } 
   
  function tep_get_manufacturer_htc_description($manufacturer_id, $language_id) {
    $manufacturer_query = tep_db_query("select manufacturers_htc_description from " . TABLE_MANUFACTURERS_INFO . " where manufacturers_id = '" . (int)$manufacturer_id . "' and languages_id = '" . (int)$language_id . "'");
    $manufacturer = tep_db_fetch_array($manufacturer_query);

    return $manufacturer['manufacturers_htc_description'];
  }
  
  function tep_get_manufacturer_htc_breadcrumb($manufacturer_id, $language_id) {
    $manufacturer_query = tep_db_query("select manufacturers_htc_breadcrumb_text from " . TABLE_MANUFACTURERS_INFO . " where manufacturers_id = '" . (int)$manufacturer_id . "' and languages_id = '" . (int)$language_id . "'");
    $manufacturer = tep_db_fetch_array($manufacturer_query);

    return $manufacturer['manufacturers_htc_breadcrumb_text'];
  }  
  
  function header_tags_reset_cache($action)
  {
    switch ($action) {
    case 'clear':
     tep_db_query("truncate TABLE " . TABLE_HEADERTAGS_CACHE);
     break;
    default: return 'false'; 
    } 
    return 'false';
  } 
  ?>