<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
 */

define('NAVBAR_TITLE_1', 'Advanced Search', true);
define('NAVBAR_TITLE_2', 'Search Results', true);

define('HEADING_TITLE_1', 'Advanced Search', true);
define('HEADING_TITLE_2', 'Products meeting the search criteria', true);

define('HEADING_SEARCH_CRITERIA', 'Search Criteria', true);

define('TEXT_SEARCH_IN_DESCRIPTION', 'Search In Product Descriptions', true);
define('ENTRY_CATEGORIES', 'Categories', true);
define('ENTRY_INCLUDE_SUBCATEGORIES', 'Include Subcategories', true);
define('ENTRY_MANUFACTURERS', 'Manufacturers', true);
define('ENTRY_PRICE_FROM', 'Price From', true);
define('ENTRY_PRICE_TO', 'Price To', true);
define('ENTRY_DATE_FROM', 'Date From', true);
define('ENTRY_DATE_TO', 'Date To', true);

define('TEXT_SEARCH_HELP_LINK',
    '<span class="fa fa-info-circle"></span> Search Help', true);

define('TEXT_ALL_CATEGORIES', 'All Categories', true);
define('TEXT_ALL_MANUFACTURERS', 'All Manufacturers', true);

define('HEADING_SEARCH_HELP', 'Search Help', true);
define('TEXT_SEARCH_HELP',
    'Keywords may be separated by AND and/or OR statements for greater control of the search results.<br /><br />For example, <u>Microsoft AND mouse</u> would generate a result set that contain both words. However, for <u>mouse OR keyboard</u>, the result set returned would contain both or either words.<br /><br />Exact matches can be searched for by enclosing keywords in double-quotes.<br /><br />For example, <u>"notebook computer"</u> would generate a result set which match the exact string.<br /><br />Brackets can be used for further control on the result set.<br /><br />For example, <u>Microsoft and (keyboard or mouse or "visual basic")</u>.',
    true);
define('TEXT_CLOSE_WINDOW', '<u>Close Window</u> [x]', true);

define('TEXT_NO_PRODUCTS',
    'There is no product that matches the search criteria.', true);

define('ERROR_AT_LEAST_ONE_INPUT',
    'At least one of the fields in the search form must be entered.', true);
define('ERROR_INVALID_FROM_DATE', 'Invalid From Date.', true);
define('ERROR_INVALID_TO_DATE', 'Invalid To Date.', true);
define('ERROR_TO_DATE_LESS_THAN_FROM_DATE',
    'To Date must be greater than or equal to From Date.', true);
define('ERROR_PRICE_FROM_MUST_BE_NUM', 'Price From must be a number.', true);
define('ERROR_PRICE_TO_MUST_BE_NUM', 'Price To must be a number.', true);
define('ERROR_PRICE_TO_LESS_THAN_PRICE_FROM',
    'Price To must be greater than or equal to Price From.', true);
define('ERROR_INVALID_KEYWORDS', 'Invalid keywords.', true);
//pure:new
define('IMAGE_BUTTON_BACK_ADVANCED_SEARCH', 'back to advanced search', true);
?>
