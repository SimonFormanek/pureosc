<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce
  
  Edited by 2014 Newburns Design and Technology
  *************************************************
  ************ New addon definitions **************
  ************        Below          **************
  *************************************************
  SEO Header Tags Reloaded added -- http://addons.oscommerce.com/info/8864

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Categories / Products',true);
define('HEADING_TITLE_SEARCH', 'Search:',true);
define('HEADING_TITLE_GOTO', 'Go To:',true);

define('TABLE_HEADING_ID', 'ID',true);
define('TABLE_HEADING_CATEGORIES_PRODUCTS', 'Categories / Products',true);
define('TABLE_HEADING_ACTION', 'Action',true);
define('TABLE_HEADING_STATUS', 'Status',true);

define('TEXT_NEW_PRODUCT', 'New Product in &quot;%s&quot;',true);
define('TEXT_CATEGORIES', 'Categories:',true);
define('TEXT_SUBCATEGORIES', 'Subcategories:',true);
define('TEXT_PRODUCTS', 'Products:',true);
define('TEXT_PRODUCTS_PRICE_INFO', 'Price:',true);
define('TEXT_PRODUCTS_TAX_CLASS', 'Tax Class:',true);
define('TEXT_PRODUCTS_AVERAGE_RATING', 'Average Rating:',true);
define('TEXT_PRODUCTS_QUANTITY_INFO', 'Quantity:',true);
define('TEXT_DATE_ADDED', 'Date Added:',true);
define('TEXT_DATE_AVAILABLE', 'Date Available:',true);
define('TEXT_LAST_MODIFIED', 'Last Modified:',true);
define('TEXT_IMAGE_NONEXISTENT', 'IMAGE DOES NOT EXIST',true);
define('TEXT_NO_CHILD_CATEGORIES_OR_PRODUCTS', 'Please insert a new category or product in this level.',true);
define('TEXT_PRODUCT_MORE_INFORMATION', 'For more information, please visit this products <a href="http://%s" target="blank"><u>webpage</u></a>.',true);
define('TEXT_PRODUCT_DATE_ADDED', 'This product was added to our catalog on %s.',true);
define('TEXT_PRODUCT_DATE_AVAILABLE', 'This product will be in stock on %s.',true);

define('TEXT_EDIT_INTRO', 'Please make any necessary changes',true);
define('TEXT_EDIT_CATEGORIES_ID', 'Category ID:',true);
define('TEXT_EDIT_CATEGORIES_NAME', 'Category Name:',true);
define('TEXT_EDIT_CATEGORIES_IMAGE', 'Category Image:',true);
define('TEXT_EDIT_SORT_ORDER', 'Sort Order:',true);

define('TEXT_INFO_COPY_TO_INTRO', 'Please choose a new category you wish to copy this product to',true);
define('TEXT_INFO_CURRENT_CATEGORIES', 'Current Categories:',true);

define('TEXT_INFO_HEADING_NEW_CATEGORY', 'New Category',true);
define('TEXT_INFO_HEADING_EDIT_CATEGORY', 'Edit Category',true);
define('TEXT_INFO_HEADING_DELETE_CATEGORY', 'Delete Category',true);
define('TEXT_INFO_HEADING_MOVE_CATEGORY', 'Move Category',true);
define('TEXT_INFO_HEADING_DELETE_PRODUCT', 'Delete Product',true);
define('TEXT_INFO_HEADING_MOVE_PRODUCT', 'Move Product',true);
define('TEXT_INFO_HEADING_COPY_TO', 'Copy To',true);

define('TEXT_DELETE_CATEGORY_INTRO', 'Are you sure you want to delete this category?',true);
define('TEXT_DELETE_PRODUCT_INTRO', 'Are you sure you want to permanently delete this product?',true);

define('TEXT_DELETE_WARNING_CHILDS', '<strong>WARNING:</strong> There are %s (child-)categories still linked to this category!',true);
define('TEXT_DELETE_WARNING_PRODUCTS', '<strong>WARNING:</strong> There are %s products still linked to this category!',true);

define('TEXT_MOVE_PRODUCTS_INTRO', 'Please select which category you wish <strong>%s</strong> to reside in',true);
define('TEXT_MOVE_CATEGORIES_INTRO', 'Please select which category you wish <strong>%s</strong> to reside in',true);
define('TEXT_MOVE', 'Move <strong>%s</strong> to:',true);

define('TEXT_NEW_CATEGORY_INTRO', 'Please fill out the following information for the new category',true);
define('TEXT_CATEGORIES_NAME', 'Category Name:',true);
define('TEXT_CATEGORIES_IMAGE', 'Category Image:',true);
define('TEXT_SORT_ORDER', 'Sort Order:',true);

define('TEXT_PRODUCTS_STATUS', 'Products Status:',true);
define('TEXT_PRODUCTS_DATE_AVAILABLE', 'Date Available:',true);
define('TEXT_PRODUCTS_CUSTOM_DATE','Custom date:',true);
define('TEXT_PRODUCTS_SORT_ORDER','Sort order:',true);
define('TEXT_PRODUCT_AVAILABLE', 'In Stock',true);
define('TEXT_PRODUCT_NOT_AVAILABLE', 'Out of Stock',true);
define('TEXT_PRODUCTS_MANUFACTURER', 'Products Manufacturer:',true);
define('TEXT_PRODUCTS_NAME', 'Products Name:',true);
define('TEXT_PRODUCTS_DESCRIPTION', 'Products Description:',true);
define('TEXT_PRODUCTS_QUANTITY', 'Products Quantity:',true);
define('TEXT_PRODUCTS_MODEL', 'Products Model:',true);
define('TEXT_PRODUCTS_IMAGE', 'Products Image:',true);
define('TEXT_PRODUCTS_MAIN_IMAGE', 'Main Image',true);
define('TEXT_PRODUCTS_LARGE_IMAGE', 'Large Image',true);
define('TEXT_PRODUCTS_LARGE_IMAGE_HTML_CONTENT', 'HTML Content (for popup)',true);
define('TEXT_PRODUCTS_ADD_LARGE_IMAGE', 'Add Large Image',true);
define('TEXT_PRODUCTS_LARGE_IMAGE_DELETE_TITLE', 'Delete Large Product Image?',true);
define('TEXT_PRODUCTS_LARGE_IMAGE_CONFIRM_DELETE', 'Please confirm the removal of the large product image.',true);
define('TEXT_PRODUCTS_URL', 'Products URL:',true);
define('TEXT_PRODUCTS_URL_WITHOUT_HTTP', '<small>(without http://)</small>',true);
define('TEXT_PRODUCTS_PRICE_NET', 'Products Price (Net):',true);
define('TEXT_PRODUCTS_PRICE_GROSS', 'Products Price (Gross):',true);
define('TEXT_PRODUCTS_WEIGHT', 'Products Weight:',true);

define('EMPTY_CATEGORY', 'Empty Category',true);

define('TEXT_HOW_TO_COPY', 'Copy Method:',true);
define('TEXT_COPY_AS_LINK', 'Link product',true);
define('TEXT_COPY_AS_DUPLICATE', 'Duplicate product',true);

define('ERROR_CANNOT_LINK_TO_SAME_CATEGORY', 'Error: Can not link products in the same category.',true);
define('ERROR_CATALOG_IMAGE_DIRECTORY_NOT_WRITEABLE', 'Error: Catalog images directory is not writeable: ' . DIR_FS_CATALOG_IMAGES);
define('ERROR_CATALOG_IMAGE_DIRECTORY_DOES_NOT_EXIST', 'Error: Catalog images directory does not exist: ' . DIR_FS_CATALOG_IMAGES);
define('ERROR_CANNOT_MOVE_CATEGORY_TO_PARENT', 'Error: Category cannot be moved into child category.',true);

define('TEXT_CATEGORIES_DESCRIPTION', 'Category Description:<br><small>shows in category page</small>',true);
define('TEXT_EDIT_CATEGORIES_DESCRIPTION', 'Edit the Category Description:',true);
/* ************************************************************************
************** Custom Filenames can be defined below here **************
**************               Raymond Burns                **************
************************************************************************ */
// Definition for SEO Header Tags Reloaded
  define('TEXT_PRODUCTS_SEO_TITLE', 'Products Title for SEO:<br><small>Replaces the product name in the &lt;title&gt; Meta Element.<br>Leave blank to default to product name.</small>',true);
  define('TEXT_CATEGORIES_SEO_TITLE', 'Category Title for SEO:<br><small>Replaces the category name in the &lt;title&gt; Meta Element.<br>Leave blank to default to category name.</small>',true);
  define('TEXT_EDIT_CATEGORIES_SEO_TITLE', 'Edit the Category Title for SEO:',true);
  define('TEXT_CATEGORIES_SEO_DESCRIPTION', 'Category Meta Description for SEO:<br><small>Add a &lt;description&gt; Meta Element.</small>',true);
  define('TEXT_EDIT_CATEGORIES_SEO_DESCRIPTION', 'Edit the Category Meta Description for SEO:<br><small>Changes the &lt;description&gt; Meta Element.</small>',true);
  define('TEXT_CATEGORIES_SEO_KEYWORDS', 'Category Meta Keywords for SEO:<br><small>Add a &lt;keyword&gt; Meta Element.<br>Must be comma separated.</small>',true);
  define('TEXT_EDIT_CATEGORIES_SEO_KEYWORDS', 'Edit the Category Meta Keywords for SEO:<br><small>Changes the &lt;keyword&gt; Meta Element.<br>Must be comma separated.</small>',true);
  define('TEXT_PRODUCTS_SEO_DESCRIPTION', 'Product Meta Description for SEO:<br><small>Add a &lt;description&gt; Meta Element.</small>',true);
  define('TEXT_PRODUCTS_SEO_KEYWORDS', 'Product Meta Keywords for SEO:<br><small>Add a &lt;keyword&gt; Meta Element.<br>Must be comma separated.</small>',true);
  define('TEXT_PRODUCTS_MINI_DESCRIPTION', 'Product Mini Description:<br><small>Used in the "product list" in Category Pages.</small>',true);
  //pure:new products_templates
  define('TEXT_PRODUCTS_TEMPLATE','Select template (article/product):');


/*** Begin Header Tags SEO ***/
define('TEXT_PRODUCT_METTA_INFO', 'Header Tags SEO Meta Tag Data',true);
define('TEXT_PRODUCTS_BREADCRUMB', 'Breadcrumb Text',true);
define('TEXT_PRODUCTS_PAGE_TITLE', 'Title Tag',true);
define('TEXT_PRODUCTS_PAGE_TITLE_ALT', 'Title Tag - Alternate',true);
define('TEXT_PRODUCTS_PAGE_TITLE_URL', 'Title Tag - URL',true);
define('TEXT_PRODUCTS_HEADER_DESCRIPTION', 'Meta Description',true);
define('TEXT_PRODUCTS_KEYWORDS', 'Meta Keywords',true);
define('TEXT_PRODUCTS_LISTING_TEXT', 'Product Listing Text',true);
define('TEXT_PRODUCTS_SUB_TEXT', 'Product Page Sub Text',true);
/*** End Header Tags SEO ***/
