<?php
/*
  $Id: header_tags_seo_silo.php,v 3.0 2009/10/10 14:07:36 hpdl Exp $
  Created by Jack_mcs from http://www.oscommerce-solution.com
  
  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce
  Portions Copyright 2009 oscommerce-solution.com

  Released under the GNU General Public License
*/

define('HEADING_TITLE_SILO', 'Header Tags Silo Control');
define('HEADING_TITLE_SECTION_MAIN', 'Main Control');
define('HEADING_TITLE_SECTION_LINKS', 'Links Control');

define('SELECT_A_FILE', 'Select A File');

define('TABLE_HEADING_CAT_NAME', 'Category Name');
define('TABLE_HEADING_BOX_TITLE', 'Box Title');
define('TABLE_HEADING_MAX_LINKS', 'Max Links');
define('TABLE_HEADING_SORT_ORDER', 'Sort Order');

define('TEXT_PAGE_HEADING', 'This section controls links in an infobox that are displayed 
when the categories or product listing pages are displayed. There is a setting in the
Header Tags configuration section that has to be enabled also. This option makes available an SEO technique 
known as "Siloing" and is used in SEO circles to increase the importance of a particular page. By having more links 
pointing to a page, the search engines see that page as more important. This, in theory, will help with 
all search engines but should be especially helpful with googles Page Ranking system. In practice,
when a Silo is displayed, the other links, like the categories infobox, should really be removed. I may
add an option for that in future releases but I thought to start out slow for now.<br><br>

None of the options below are necessary to use this. As long as the main option mentioned above
is enabled, default values will apply. But each category can be controlled from here, if wanted.
If you only want one or two categories to use this option, check the disable box while the Select All
Categories is showing and click update. Then select a particular category and set it up. All but that one category
will be disabled.
');

define('SELECT_ALL_CATEGORIES', 'Select All Categories');
define('TEXT_FILTER_LIST_CATEGORY', 'Categories');

define('ENTRY_SELECT_A_PAGE', 'Select A Page');
define('ENTRY_SILO_BOX_TITLE', 'Silo Box Title:');
define('ENTRY_SILO_DISABLE', 'Disable');
define('ENTRY_SILO_NUMBER_LINKS', 'Number of Links:');
define('ENTRY_SILO_SORT_BY', 'Sort By:');
define('ENTRY_SILO_SORT_BEST', 'Best Seller');
define('ENTRY_SILO_SORT_DATE', 'Date');
define('ENTRY_SILO_SORT_NAME', 'Name');
define('ENTRY_SILO_SORT_CUSTOM', 'Custom');

define('ERROR_INCORRECT_MAX_LINKS', 'Error - Number of links must be greater than 0 for %s language.');
?>
