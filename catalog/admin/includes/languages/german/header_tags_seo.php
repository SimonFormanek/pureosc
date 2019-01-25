<?php
/*
  $Id: header_tags_seo.php,v 3.0 2008/01/10 14:07:36 hpdl Exp $
  Created by Jack_mcs from http://www.oscommerce-solution.com

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce
  Portions Copyright 2009 oscommerce-solution.com

  Released under the GNU General Public License
*/
 
define('HEADING_TITLE', 'Header Tags SEO');
define('HEADING_TITLE_AUTHOR', 'by Jack York from <a href="http://www.oscommerce-solution.com/" target="_blank"><span style="font-family: Verdana, Arial, sans-serif; color: sienna; font-size: 12px;">oscommerce-solution.com</span></a>');
define('HEADING_TITLE_FILL_TAGS', 'Header Tags SEO - Fill Tags');
define('HEADING_TITLE_FILL_TAGS_OPTIONS', 'Fill Tags');
define('HEADING_TITLE_FILL_TAGS_OVERRIDES', 'OVERRIDE OPTIONS');
define('HEADING_TITLE_SUPPORT_THREAD', '<a href="http://forums.oscommerce.com/topic/298099-header-tags-seo" target="_blank"><span style="color: sienna;">(visit the support thread)</span></a>');
 
define('TEXT_INFORMATION_PAGES', 'This column controls the individual pages. Enter the desired text in the
boxes provided. If the default checkboxes are checked, the default tags (shown at right) will be added to what is entered.');
define('TEXT_INFORMATION_DEFAULT', 'The settings in this column are the default and global items. Text entered
and items selected here will appear on each page that is enabled with Header Tags code.');
define('TEXT_INFORMATION_DELETE_PAGE', '<b>Delete a New Page</b> - This option will remove the code for a page from the
above files.'); 
define('TEXT_INFORMATION_CHECK_PAGES', '<b>Check Missing Pages</b> - This option allows you to check which files in your
shop do not have entries in the above files. Note that not all pages should have entries. For example,
any page that will use SSL like Login or Create Account. To view the pages, click Update and then select the drop down list.'); 

define('SHADOW_POS_X', '10');
define('SHADOW_POS_Y', '10');
define('SHADOW_POS_OFFSET', '90');
define('SHADOW_POS_OFFSET_Y', '25');

define('TEXT_PAGE_TAGS', '<div class="smallText statsHeaderLeft">
<p>This page allows the setting up of titles and tags for all of the pages in a shop. Please
note that index.php and product_info.php handle all categories, manufacturers and products so the setup of the check boxes
for those pages is more important than the for other pages. Click one of the buttons to the right for help on the 
indicated topic.
</p>
<p>
<div>
<strong>Quick Stats:</strong> (all should be 0 except keywords)<br>
<div class="statsLeft">Categories Missing Descriptions: <strong>%s</strong></div>
<div class="statsRight">Categories Missing Title/Tags: <strong>%s</strong></div>
</div>
<div>
<div class="statsLeft">Manufacturers Missing Descriptions: <strong>%s</strong></div>
<div class="statsRight">Manufacturers Missing Title/Tags: <strong>%s</strong></div>
</div>
<div>
<div class="statsLeft">Keywords Searched: <strong>%s</strong>  Found: <strong>%s</strong></div>
<div class="statsRight">Products Missing Title/Tags: <strong>%s</strong></div>
</div>
</p>
</div>

<div class="statsHeaderRight">
  <div class="section_row shadow" style="position:absolute; left:' . SHADOW_POS_X . 'px; top:' . SHADOW_POS_Y . 'px">
    <div class="section_column"><a href="javascript:void(null);" onclick="showHelp(\'' .tep_href_link("header_tags_seo_help.php", "file=page_control") . '\');" title="Page Control"><span style="white-space:nowrap">Page Control</span></a></div>
  </div>   
  <div class="section_row shadow" style="position:absolute; left:' . (SHADOW_POS_X + SHADOW_POS_OFFSET). 'px; top:' . SHADOW_POS_Y . 'px">
    <div class="section_column"><a href="javascript:void(null);" onclick="showHelp(\'' .tep_href_link("header_tags_seo_help.php", "file=filltags") . '\');" title="Fill Tags"><span style="white-space:nowrap">Fill Tags</span></a></div>
  </div>   
  <div class="section_row shadow" style="position:absolute; left:' . (SHADOW_POS_X + (2 * SHADOW_POS_OFFSET)) . 'px; top:' . SHADOW_POS_Y . 'px">
    <div class="section_column"><a href="javascript:void(null);" onclick="showHelp(\'' .tep_href_link("header_tags_seo_help.php", "file=keywords") . '\');" title="Keywords"><span style="white-space:nowrap">Keywords</span></a></div>
  </div>   
  
  <div class="section_row shadow" style="position:absolute; left:' . SHADOW_POS_X . 'px; top:' . (SHADOW_POS_Y + SHADOW_POS_OFFSET_Y) . 'px">
    <div class="section_column"><a href="javascript:void(null);" onclick="showHelp(\'' .tep_href_link("header_tags_seo_help.php", "file=options") . '\');" title="Options"><span style="white-space:nowrap">Options</span></a></div>
  </div>     
  <div class="section_row shadow" style="position:absolute; left:' . (SHADOW_POS_X + SHADOW_POS_OFFSET) . 'px; top:' . (SHADOW_POS_Y + SHADOW_POS_OFFSET_Y) . 'px">
    <div class="section_column"><a href="javascript:void(null);" onclick="showHelp(\'' .tep_href_link("header_tags_seo_help.php", "file=silo") . '\');" title="Silo Control"><span style="white-space:nowrap">Silo Control</span></a></div>
  </div>   
  <div class="section_row shadow" style="position:absolute; left:' . (SHADOW_POS_X + (2 * SHADOW_POS_OFFSET)). 'px; top:' . (SHADOW_POS_Y + SHADOW_POS_OFFSET_Y) . 'px">
    <div class="section_column"><a href="javascript:void(null);" onclick="showHelp(\'' .tep_href_link("header_tags_seo_help.php", "file=social") . '\');" title="Social Tags"><span style="white-space:nowrap">Social Tags</span></a></div>
  </div>    
  
  <div class="section_row shadow" style="position:absolute; left:' . SHADOW_POS_X . 'px; top:' . (SHADOW_POS_Y + (2 * SHADOW_POS_OFFSET_Y)) . 'px">
    <div class="section_column"><a href="javascript:void(null);" onclick="showHelp(\'' .tep_href_link("header_tags_seo_help.php", "file=test") . '\');" title="Testing"><span style="white-space:nowrap">Testing</span></a></div>
  </div>   
  <div class="section_row shadow" style="position:absolute; left:' . (SHADOW_POS_X + SHADOW_POS_OFFSET). 'px; top:' . (SHADOW_POS_Y + (2 * SHADOW_POS_OFFSET_Y)) . 'px">
    <div class="section_column"><a href="javascript:void(null);" onclick="showHelp(\'' .tep_href_link("header_tags_seo_help.php", "file=titles_and_tags") . '\');" title="Titles and Tags"><span style="white-space:nowrap">Titles & Tags</span></a></div>
  </div>   
  <div class="section_row shadow" style="position:absolute; left:' . (SHADOW_POS_X + (2 * SHADOW_POS_OFFSET)). 'px; top:' . (SHADOW_POS_Y + (2 * SHADOW_POS_OFFSET_Y)) . 'px">
    <div class="section_column"><a href="javascript:void(null);" onclick="showHelp(\'' .tep_href_link("header_tags_seo_help.php", "file=need_help") . '\');" title="Need Help?"><span style="white-space:nowrap">Need Help?</span></a></div>
  </div>   
  
  <div class="section_row shadow" style="position:absolute; left:' . (SHADOW_POS_X + SHADOW_POS_OFFSET) . 'px; top:' . (SHADOW_POS_Y + (3 * SHADOW_POS_OFFSET_Y)) . 'px">
    <div class="section_column"><a href="javascript:void(null);" onclick="showHelp(\'' .tep_href_link("header_tags_seo_help.php", "file=need_host") . '\');" title="Need a Host?"><span style="white-space:nowrap">Need a Host?</span></a></div>
  </div>   
  
</div>

 <div id="hts_help" title="Header Tags SEO Help" style="display: none;"></div> 
');

define('TEXT_FILL_TAGS', '<p>This section allows the titles and meta tags added by Header Tags SEO to be quickly populated. 
The Override options allow for changing how they are populated. For most shops, all that is needed is to 
scroll to the bottom of the page, select the fill empty button for each type and update. It is always
safe to do this since only empty titles and tags will be changed. Once the update completes, the number of changes
are shown at the very bottom of the page. If any errors are found, the page will scroll to the bottom.
The errors shown are links to the items that failed. They should be corrected.</p>
<p>If Fill Tags times out before it completes, click here for instructions on using the sleep command: %s</p>
');

define('TEXT_EXPLAIN_POPUP', 'explain');

// header_tags_seo.php
define('HEADING_TITLE_SEO_DELETE', 'Delete:');
define('HEADING_TITLE_SEO_EXPLAIN', '(Explain)');
define('HEADING_TITLE_SEO_TITLE', 'Title:');
define('HEADING_TITLE_SEO_DESCRIPTION', 'Description:');
define('HEADING_TITLE_SEO_KEYWORDS', 'Keyword(s):');
define('HEADING_TITLE_SEO_LOGO', 'Logo Text:');
define('HEADING_TITLE_SEO_HOME_PAGE', 'Home Page:');
define('HEADING_TITLE_SEO_OPTIONS', 'Include:');
define('HEADING_TITLE_SEO_PAGENAME', 'Select an Option:');
define('HEADING_TITLE_SEO_PAGENAME_ERROR', 'Page name is already entered -> ');
define('HEADING_TITLE_SEO_PAGENAME_INVALID_ERROR', 'Page name is invalid -> ');
define('HEADING_TITLE_SEO_NO_DELETE_ERROR', 'Deleting %s is not allowed');
define('HEADING_TITLE_SEO_VIEW_RESULT', 'View Result:');
define('HEADING_TITLE_TEST', 'Testing the Installation');

define('HEADING_TITLE_SEO_DEFAULT_TAGS', 'Default Tags');
define('HEADING_TITLE_SEO_DEFAULT_META_TAGS', 'Meta Tags');
define('HEADING_TITLE_SEO_DEFAULT_DESCRIPTION', 'Default Description:');
define('HEADING_TITLE_SEO_DEFAULT_KEYWORDS', 'Default Keyword(s):');
define('HEADING_TITLE_SEO_DEFAULT_LOGO', 'Logo Text');

define('HEADING_TITLE_SEO_PSEUDO', 'Add a Pseudo Page:');

// header_tags_fill_tags.php
define('HEADING_TITLE_SEO_CATEGORIES', 'CATEGORIES');
define('HEADING_TITLE_SEO_MANUFACTURERS', 'MANUFACTURERS');
define('HEADING_TITLE_SEO_PRODUCTS', 'PRODUCTS');
define('HEADING_TITLE_SEO_SKIPALL', 'Skip All Tags');
define('HEADING_TITLE_SEO_FILLONLY', 'Fill Only Empty Tags');
define('HEADING_TITLE_SEO_FILLALL', 'Fill All Tags');
define('HEADING_TITLE_SEO_CLEARALL', 'Clear All Tags');
define('HEADING_TITLE_SEO_ENABLE_SLEEP', 'Sleep:');
define('HEADING_TITLE_SEO_ENABLE_SLEEP_INTERVAL', 'Item Count:');
define('HEADING_TITLE_SEO_SHOW_MISSING_TAGS', 'Show Missing Tags');
define('HEADING_TITLE_SEO_INCLUDE_MISSING_DESCRIPTION', 'Include Missing Descriptions in search');
define('HEADING_TITLE_SEO_LANGUAGE', 'Language:');

define('TEXT_COMMON_PROBLEMS_HEADING', 'Common Problems');
$commonQuestionsArray = array();
$commonQuestionsArray[] = array('Q' => 'Header Tags works on all of my pages except for one. What do I do??',
                                'A' => 'Replace the file for that page with the one from the contribution. If it works, then use a program like WinMerge to compare the two files.');
$commonQuestionsArray[] = array('Q' => 'Why do the titles and tags show in admin but not on the shop?',
                                'A' => 'Either the head code change for the files in the shop is missing or the includes/header_tags.php file is at fault. The latter can be replaced with the one from the contribution.');
$commonQuestionsArray[] = array('Q' => 'Why is the alignment of my page incorrect after installing Header Tags?',
                                'A' => 'You\'ve made a mistake in the installation. Try using the file of the same name from the contribution to see if the problem goes away. If it does, then use a program like WinMerge to compare the two to find your mistake.');
$commonQuestionsArray[] = array('Q' => 'Why aren\'t my urls working correctly?', 
                                'A' => 'Header Tags doesn\'t change the url\'s unless that option in Ultimate SEO is used. You need to ask in the support thread for the contribution you are using to handle your url\'s.');
$commonQuestionsArray[] = array('Q' => 'Why do I get a failure when Header Tags is used with Ultimate seo urls 5?',
                                'A' => 'That contribution isn\'t coded in a standard oscommerce way. There is a setting in it to allow the code to work correctly.');
$commonQuestionsArray[] = array('Q' => 'Why are my categories or products missing titles or meta tag information?',
                                'A' => 'You need to run Fill Tags to setup up the titles and meta tags or edit them manually in the catalog section.');
$commonQuestionsArray[] = array('Q' => 'Why do I get "error message appears on top "Warning: implode() [function.implode]: Invalid arguments passed"?',
                                'A' => 'You need to run Fill Tags.');
$commonQuestionsArray[] = array('Q' => 'Why is php code now appearing on my page?',
                                'A' => 'You overwrote or missed a php delimiter. Use the file in the contribution package by the same name and a program like WinMerge to find the mistake.');
$commonQuestionsArray[] = array('Q' => 'Why aren\'t the Social Bookmarks showing?',
                                'A' => 'You need to enable that option in admin->Header Tags SEO.');
$commonQuestionsArray[] = array('Q' => 'Does the Header Tags code that goes in the head section have to be added to every page?',
                                'A' => 'It should be in every page that you want to show up well in the search engine listings. However, if you are using BTS or STS, it should not be in any of them, as explained in the installation instructions.');
$commonQuestionsArray[] = array('Q' => 'Why don\'t the settings stay set in Fill Tags?',
                                'A' => 'As the text beside Fill Tags states, those are not settings. They will reset each time Fill Tags is loaded.');


define('TEXT_CHARACTERS', 'characters.');
define('TEXT_CHECK_URL', 'Check URL:');
define('TEXT_CHECK_URL_PAGE', 'Page Name');
define('TEXT_CHECK_URL_TAGS', 'ID (if needed)');
define('TEXT_CLOSE_POPUP', 'Close this window');
define('TEXT_FILL_ALL_LANGUAGES', 'All');
define('TEXT_FILL_CATEGORIES_CLEAR', 'All %s Category tags have been cleared.');
define('TEXT_FILL_CATEGORIES_EMPTY', '%s Empty Category tags have been filled.');
define('TEXT_FILL_CATEGORIES_FULL', '%s Category tags have been filled.');
define('TEXT_FILL_KEYWORDS_FROM_SHOP', 'Fill keywords for all added pages from derived keywords on actual pages?');
define('TEXT_FILL_WITH_DESCIPTION', 'Fill products meta description with Products Description?');
define('TEXT_FILL_KEYWORDS_WITH_GENERIC', 'Check to fill title and tags with generic strings.');
define('TEXT_FILL_GENERIC_TITLE', 'Title:');
define('TEXT_FILL_GENERIC_META_DESC', 'Description:');
define('TEXT_FILL_GENERIC_KEYWORDS', 'Keywords:');
define('TEXT_FILL_GENERIC_DESCRIPTION', 'Description: (page)');
define('TEXT_FILL_GENERIC_SECTION_CATEGORIES', 'Categories');
define('TEXT_FILL_GENERIC_SECTION_MANUFACTURERS', 'Manufacturers');
define('TEXT_FILL_GENERIC_SECTION_PRODUCTS', 'Products');
define('TEXT_FILL_MANUFACTURERS_CLEAR', 'All %s Manufacturer tags have been cleared.');
define('TEXT_FILL_MANUFACTURERS_EMPTY', '%s Empty Manufacturer tags have been filled.');
define('TEXT_FILL_MANUFACTURERS_FULL', '%s Manufacturer tags have been filled.');
define('TEXT_FILL_PRODUCTS_CLEAR', 'All %s Product tags have been cleared.');
define('TEXT_FILL_PRODUCTS_EMPTY', '%s Empty Product tags have been filled.');
define('TEXT_FILL_PRODUCTS_FULL', '%s Product tags have been filled.');
define('TEXT_FILTER_LIST_CATEGORY', 'Filter by Category');
define('TEXT_FILTER_LIST_MULTI', '(NOTE: This list allows multiple selections.)');
define('TEXT_FILTER_LIST_SELECT_ALL', 'Select All');
define('TEXT_GENERIC_TITLE', 'ITEMNAME is a great product ');
define('TEXT_GENERIC_DESC', 'We sell ITEMNAME in an quantity ');
define('TEXT_GENERIC_KEYWORDS', 'ITEMNAME, ITEMNAME computer, ITEMNAME dresses ');
define('TEXT_GENERIC_DESCRIPTION', 'UPPER_ITEMNAME is one of our best categories. There are many types of ITEMNAME\'s in the ITEMNAME category. ');
define('TEXT_LANGUAGE', 'Language:');
define('TEXT_LIMIT_TO', 'Limit to');
define('TEXT_NO', 'No');
define('TEXT_NO_URL_TYPE', 'None');
define('TEXT_YES', 'Yes');
define('SELECT_A_FILE', 'Select A File');
define('SHOW_ALL_FILES', 'Show All Files');
define('ADD_MISSING_PAGES', 'Add Missing Pages');
define('TEXT_MISSING_TAGS', 'Missing Tags');
define('TEXT_MISSING_VERSION_CHECKER', 'Version Checker is not installed. See <a href="http://addons.oscommerce.com/info/7148" target="_blank">here</a> for details.');
define('TEXT_TEXT_INFORMATION', '<p><b>Instructions:</b> Use this page to run a test on your installation of Header Tags SEO. If any
recognizable problems are found, they will be listed. The only error that may show up and which can, maybe, 
be ignored, is the permissions settings (see the note in the install files regarding this error). Also, this 
test is mainly meant for a standard osCommerce shop. BTS and STS based shops may, or may not, see errors that 
apply to them.</p>
<p><b>Show Limit Warnings:</b> Use this option to show tags that may not fit in with googles guidelines. These number are completely
arbitrary, by google, so only use these results as a very general guideline.
</p>
<p><b>Check URL:</b> This option allows live checking of the tags of a page. If one of your pages isn\'t working correctly, this option may
be useful. If a category or product page is selected, be sure to select cPath or products_if from the second dropdown menu and to enter
the category or product ID in the last box. 
</p>

');
define('TEST_FILE_NOTIN_DB', 'Files not in the database:');
define('TEST_FILE_NOTIN_FILE', 'Files not in the includes/header_tags.php file:');
define('TEST_RESULTS_HEADING', 'Test Results');
define('TEST_RESULTS_HEADING_NONE', 'Congratulations! No problems were found.');
define('TEXT_OVERRIDE_DESCRIPTION', 'Description Override');
define('TEXT_OVERRIDE_KEYWORDS', 'Keywords Override');
define('TEXT_OVERRIDE_GENERIC', 'Generic Override');
define('TEXT_PSEUDO_PAGE_NAME', 'Page Name:');
define('TEXT_PSEUDO_PAGE_NAME_NOTE', 'The page name must be entered as it appears on the page, with the root page 
included. For example, if Articles Manager is installed, the root page for articles is article_info.php. The 
additional articles would have an ID, like articles_id=2. So to add such a page, you would enter article_info.php?articles_id=2.<br><br>
<span style="color: red;">Note: </span>Add Missing Pages <b>Must</b> be ran prior to using this option to ensure the 
root file is present.');
define('TEXT_SHOW_LIMIT_MESSAGES', 'Show Limit Warnings:');
define('TEXT_SHOW_POPUP', '&nbsp;&nbsp;<a class="smallText" style="color:#dd0000" href="javascript:popupWindow(\'header_tags_fill_tags_popup_help.php?show=%s\')">(help)</a>');


define('OPTION_SELECT_ALL', 'Select All:');
define('OPTION_INCL_TITLE', 'Default Title:');
define('OPTION_INCL_DESC', 'Default Description');
define('OPTION_INCL_KEYWORDS', 'Default Keywords:');
define('OPTION_INCL_LOGO', 'Default Logo:');
define('OPTION_INCL_CATEGORY', 'Category:');
define('OPTION_INCL_ROOT', 'Root:');
define('OPTION_INCL_MANUFACTURER', 'Manufacturer:');
define('OPTION_INCL_MODEL', 'Model:');
define('OPTION_INCL_PRODUCT', 'Product:');
define('OPTION_INCL_GROUP', 'Group:');
define('OPTION_META_GOOGLE', 'Google');
define('OPTION_META_LANGUAGE', 'Language');
define('OPTION_META_NOODP', 'NOODP');
define('OPTION_META_NOYDIR', 'NOYDIR');
define('OPTION_META_REPLYTO', 'Reply To');
define('OPTION_META_REVISIT', 'Revisit');
define('OPTION_META_ROBOTS', 'Robots');
define('OPTION_META_UNSPAM', 'UnSpam');
define('OPTION_META_CANONICAL', 'Canonical');
define('OPTION_META_OG', 'Open Graph');

define('POPUP_COMMON_DELETE', ' Delete all entries for this page ');
define('POPUP_COMMON_TITLE', ' Title text for this page. May vary depending on options. Google recommends 60 - 80 characters ');
define('POPUP_COMMON_DESC', ' Meta description text for this page. May vary depending on options and search engine but Google recommends 155 characters ');  
define('POPUP_COMMON_KYWRDS', ' Meta Keywords text for this page. May vary depending on options ');  
define('POPUP_COMMON_KYWRDS_LIVE', ' Use keywords from text on the actual page ');
define('POPUP_COMMON_LOGO', ' Alt tag text for the logo image on this page. May vary depending on options ');  
define('POPUP_COMMON_LOGO_EXTRA', ' Open window to enter alt tag text for the additional logo images on this page. ');
define('POPUP_COMMON_VIEW', ' View how the title and meta tags actually appear on the web site ');
define('POPUP_COMMON_VIEW_TITLE_A', ' Title actually on this page. Yellow = Found, Red = Not Found ');
define('POPUP_COMMON_VIEW_TITLE_B', ' Title as it appears on this page online and to the search engines ');
define('POPUP_COMMON_VIEW_DESC_A', ' Description actually on this page. Yellow = Found, Red = Not Found ');
define('POPUP_COMMON_VIEW_DESC_B', ' Description as it appears on this page online and to the search engines ');
define('POPUP_COMMON_VIEW_KEYWORDS_A', ' Keywords actually on this page. Yellow = Found, Red = Not Found ');
define('POPUP_COMMON_VIEW_KEYWORDS_B', ' Keywords as they appear on this page online and to the search engines ');
define('POPUP_COMMON_PSEUDO_ADD', ' Add a pseudo page - see above instructions. ');
define('POPUP_DEFAULT_ALL', ' Include all options in the logo text ');  
define('POPUP_DEFAULT_CAT', ' Include the category name in the logo text ');  
define('POPUP_DEFAULT_MANU', ' Include the manufacturer name in the logo text ');  
define('POPUP_DEFAULT_PROD', ' Include the product name in the logo text ');  
define('POPUP_DEFAULT_TITLE', ' Default Title text for all pages. May vary depending on options ');
define('POPUP_DEFAULT_DESC', ' Default Meta description text for all pages. May vary depending on options ');  
define('POPUP_DEFAULT_KYWRDS', ' Default Meta Keywords text for all pages. May vary depending on options ');  
define('POPUP_DEFAULT_LOGO', ' Default Alt tag text for the logo image on all pages. May vary depending on options '); 
define('POPUP_DEFAULT_HOME_TEXT', ' Text entered here will appear on the home page. Leave blank to disable the code '); 
define('POPUP_FILTAGS_CLEAR', ' Clear all tags in this section. '); 
define('POPUP_FILTAGS_DESC_YES', ' Use the product description to fill the meta tag description. '); 
define('POPUP_FILTAGS_DESC_NO', ' Use the product title to fill the meta tag description. '); 
define('POPUP_FILTAGS_KEYWORDS_YES', ' Use the derived keywords from the actual pages. '); 
define('POPUP_FILTAGS_KEYWORDS_NO', ' Use the keywords built from the product pages. '); 
define('POPUP_FILTAGS_SIZE', ' If option set to yes, how much of the product description should be used. '); 
define('POPUP_FILTAGS_FULL', ' Fill all tags in this section. '); 
define('POPUP_FILTAGS_EMPTY', ' Only fill empty tags in this section. '); 
define('POPUP_FILTAGS_SKIPALL', ' Don\'t fill any tags in this section. '); 
define('POPUP_FILTAGS_SHOW_MISSING_TAGS', ' Display a list of missing meta tags. ');
define('POPUP_FILTAGS_INCLUDE_MISSING_DESCRIPTION', ' Check the description for this item. ');
define('POPUP_FILTAGS_ENABLE_SLEEP', ' Cause a delay between fills to allow a larger number of updates. ');
define('POPUP_FILTAGS_ENABLE_SLEEP_INTERVAL', ' Determines the number of items to processed at one time. ');
define('POPUP_METATAGS_GOOGLE', ' Control how google crawls your site. Defaults to all pages - all links. '); 
define('POPUP_METATAGS_LANG', ' Tells the search engines which language the site is intended for. '); 
define('POPUP_METATAGS_NOODP', ' Tells all search engines to use your description instead of DMoz\'s. '); 
define('POPUP_METATAGS_NOYDIR', ' Tells Yahoo to use your description instead of DMoz\'s.  '); 
define('POPUP_METATAGS_REPLY', ' Lists the shops email address. Not recommended for most shops.  '); 
define('POPUP_METATAGS_REVIST', ' Tells the search engines to revisit your site after a certain period. '); 
define('POPUP_METATAGS_ROBOTS', ' Control how all search engines crawl your site. Defaults to all pages - all links. '); 
define('POPUP_METATAGS_UNSPAM', ' Tries to prevent the search engines from harvesting email addresses. '); 
define('POPUP_METATAGS_CANONICAL', ' Adds a Canonical meta tag to all pages that need it, except for those already handled in categories and products. '); 
define('POPUP_METATAGS_OG', ' Adds Social Media Open Graph meta tags pages that use them. '); 
define('POPUP_OPTION_TITLE', ' Include the default title ');
define('POPUP_OPTION_DESC', ' Include the default description ');  
define('POPUP_OPTION_KYWRDS', ' Include the default keywords ');  
define('POPUP_OPTION_LOGO', ' Include the default logo text ');
define('POPUP_OPTION_CAT', ' Include the category name ');  
define('POPUP_OPTION_MANU', ' Include the manufacturer name ');
define('POPUP_OPTION_MODEL', ' Include the model number ');
define('POPUP_OPTION_PROD', ' Include the product title and tags where applicable ');
define('POPUP_OPTION_ROOT', ' Include the root title and tags (in above boxes) ');
define('POPUP_OPTION_CHECKBOX_TITLE', ' Enable/Disable the default title ');
define('POPUP_OPTION_CHECKBOX_DESC', ' Enable/Disable the default description ');  
define('POPUP_OPTION_CHECKBOX_KYWRDS', ' Enable/Disable the default keywords ');  
define('POPUP_OPTION_CHECKBOX_LOGO', ' Enable/Disable the default logo text ');
define('POPUP_OPTION_CHECKBOX_CAT', ' Enable/Disable the category name ');  
define('POPUP_OPTION_CHECKBOX_MANU', ' Enable/Disable the manufacturer name ');
define('POPUP_OPTION_CHECKBOX_MODEL', ' Enable/Disable the model number ');
define('POPUP_OPTION_CHECKBOX_PROD', ' Enable/Disable the product name ');
define('POPUP_OPTION_CHECKBOX_ROOT', ' Enable/Disable the root title and tags (in above boxes) ');
define('POPUP_OPTION_SORT_TITLE', ' Set the sort order of the default title ');
define('POPUP_OPTION_SORT_DESC', ' Set the sort order of the default description ');  
define('POPUP_OPTION_SORT_KYWRDS', ' Set the sort order of the default keywords ');  
define('POPUP_OPTION_SORT_LOGO', ' Set the sort order of the default logo text ');
define('POPUP_OPTION_SORT_CAT', ' Set the sort order of the category name ');  
define('POPUP_OPTION_SORT_MANU', ' Set the sort order of the manufacturer name ');
define('POPUP_OPTION_SORT_MODEL', ' Set the sort order of the model number ');
define('POPUP_OPTION_SORT_PROD', ' Set the sort order of the product name ');
define('POPUP_OPTION_SORT_ROOT', ' Set the sort order of the root title and tags (in above boxes) ');

define('FIRST_PAGE_ENTRY', '3');

define('ERROR_HEADING_COUNT_MISMATCH', '<b>Database/File Mismatch Error:</b>');
define('ERROR_HEADING_DATABASE', '<b>Missing Database Error:</b>');
define('ERROR_HEADING_DESCRIPTION_LENGTH', '<b>Meta Description length warning: (Suggested range is 15 to 300 characters)</b>');
define('ERROR_HEADING_DEFAULT_ROOT_TEXT_PRESENT', '<b>Default Text Present:</b>');
define('ERROR_HEADING_DUPLICATE_TITLE', '<b>Duplicate title found:</b>');
define('ERROR_HEADING_DUPLICATE_META_DESCRIPTION', '<b>Duplicate meta description found:</b>');
define('ERROR_HEADING_EXTRA_FILE', '<b>Extra File Error:</b>');
define('ERROR_HEADING_INVALID_FILENAME', '<b>Invalid FileNames found:</b>');
define('ERROR_HEADING_LANGUAGE_MISMATCH', '<b>Language Mismatch Error:</b>');
define('ERROR_HEADING_META_DATA', '<b>Title and Meta Tag results for %s</b>');
define('ERROR_HEADING_META_DATA_EXPLAIN', '<b>Title and Meta Tag results</b>');
define('ERROR_HEADING_MISSING_CODE', '<b>Missing Code in File</b>');
define('ERROR_HEADING_MISSING_FILE', '<b>Missing File Error:</b>');
define('ERROR_HEADING_MISSING_PSEUDO', '<b>Missing Pseudo Code Error:</b>');
define('ERROR_HEADING_MISSING_TAGS', '<b>Missing Title and/or descriptions:</b>');
define('ERROR_HEADING_PERMISSIONS', '<b>Permissions Error:</b>');
define('ERROR_HEADING_SEARCH_ENGINE_OPTION', '<b>Option Error:</b>');
define('ERROR_HEADING_STS', '<b>STS Error:</b>');
define('ERROR_HEADING_TEMPLATE', '<b>CRE or oscMax Error:</b>');
define('ERROR_HEADING_TITLE_LENGTH', '<b>Title length warning: (Suggested range is 60 to 120 characters)</b>');

define('ERROR_CANT_CHMOD', 'Cannot change the permission on %s');
define('ERROR_COUNT_MISMATCH', 'The number of file entries in the database (%s) does not match the number in the includes/header_tags.php file (%s).');
define('ERROR_DEFAULT_ROOT_TEXT_PRESENT', 'The default root text, %s, should be removed or changed for %s with language ID of %d.');
define('ERROR_DESCRIPTION_LENGTH_SHORT', 'The Meta Description for %s may be too short. It is %s characters long.');
define('ERROR_DESCRIPTION_LENGTH_LONG', 'The Meta Description for %s may be too long. It is %s characters long.');
define('ERROR_DUPLICATE_PAGE', 'An entry for the page %s already exists.');
define('ERROR_DUPLICATE_SORT_ORDER', 'Duplicate sort orders are not allowed -> %s');
define('ERROR_DUPLICATE_TITLE_LANGUAGE', '<b>for %s</b>');
define('ERROR_DUPLICATE_TITLE_META_DESCRIPTION', '%s exists more than once.');
define('ERROR_EXTRA_FILE', 'The %s file is present and should be removed.');
define('ERROR_FILL_TAGS_CATEGORIES', '&nbsp; Error: Category with ID of %s and language ID of %s is missing a name');
define('ERROR_FILL_TAGS_MANUFACTURERS', '&nbsp; Error: Manufacturer with ID of %s and language ID of %s is missing a name');
define('ERROR_FILL_TAGS_PRODUCTS', '&nbsp; Error: Product with ID of %s and language ID of %s is missing a name');
define('ERROR_FILL_TAGS_FOUND_ERRORS', 'Errors Found');

define('ERROR_EXPLAIN_COUNT_MISMATCH', 'Header Tags makes an entry in the database for each page and a 
corresponding entry in the includes/header_tags.php file. This error is saying those counts do not match. If
the database contains more entries than the file, an option is provided to delete those entries. If the 
file contains more entries than the database, then replace the file and choose the Add Missing Pages in Page Control.');
define('ERROR_EXPLAIN_DATABASE', 'The indicated table cannot be found in the database. Run the headertags_seo_uninstall.php
and then the headertags_seo_install.php to repair the database.');
define('ERROR_EXPLAIN_DESCRIPTION_LENGTH', 'Google will give warnings if they deem the meta description tag is too short or
too long. However, they do not say how long it should be. The general accepted notion is that it should be somewhere
between 15 and 300 characters, but what the description says plays a part in that too.');
define('ERROR_EXPLAIN_DEFAULT_ROOT_TEXT_PRESENT', 'Header Tags installs with some sample text. If that is left in,
it will have a negative affect on your pages. This error says that the text was found and needs to be removed.');
define('ERROR_EXPLAIN_DUPLICATE_TITLE', 'Google will issue a warning if the title of two pages are the same. If possible,
the titles of all items should be unique.');
define('ERROR_EXPLAIN_DUPLICATE_META_DESCRIPTION', 'Google will issue a warning if the meta description of two pages 
are the same. If possible, that description should be unique.');
define('ERROR_EXPLAIN_EXTRA_FILE', 'The indicated file(s) should not be present on the server during normal operation
so they should be deleted.');
define('ERROR_EXPLAIN_INVALID_FILENAME', 'The indicated file(s) does not have a valid name. This usually happens when a file is
renamed to make a backup. Header Tags will still try to use the file if it has Header Tags code in it so any such file should be removed.');
define('ERROR_EXPLAIN_LANGUAGE_MISMATCH', 'This means that an entry in the Header Tags tables is for a certain language
that does not exist in the shops declared languages or vice versa.');
define('ERROR_EXPLAIN_MISSING_CODE', 'The code required for Header Tags to work properly is missing from the indicated file(s).
See the Install_Catalog.txt file for what should be added.');
define('ERROR_EXPLAIN_MISSING_FILE', 'A file required by Header Tags to function properly cannot be found. The file 
needs to be uploaded from the contribution package.');
define('ERROR_EXPLAIN_MISSING_PSEUDO', 'A contribution is installed that uses pseudo pages but no entries have been made for them using 
the pseudo option in Page Control. This means that those pages have not been setup correctly.');
define('ERROR_EXPLAIN_MISSING_TAGS', 'The title or description is missing from the indicated file(s).');
define('ERROR_EXPLAIN_PERMISSIONS', 'The permissions settings on the includes/header_tags.php file are incorrect.
The code will try to determine the proper setting but they should typically match the ones on the images directory.
If that does not clear the error, then you will need to ask your host for the proper settings. However, if your
site is on a Windows server, which includes home computers, the error can be disregarded. Just make sure the 
setting on that file allow it to be written to.');
define('ERROR_EXPLAIN_SEARCH_ENGINE_OPTION', 'This error says the admin->configuration->My Store0>Search Engine Friendly 
option is turned on. It should always be disabled, whether Header Tags is installed or not.');
define('ERROR_EXPLAIN_STS', 'STS is installed but the Header Tags code is not setup properly.');
define('ERROR_EXPLAIN_TEMPLATE', 'The code has detected that either CRE or oscMax is installed but the Header Tags
code has not been added properly. See the Install_Catalog.txt file for instructions on how to do that.');
define('ERROR_EXPLAIN_META_DATA', 'Displays the actual and expected title and tags. If they do not match, there may be a problem.
The sort order is not checked so the result may not be identical.');
define('ERROR_EXPLAIN_TITLE_LENGTH', 'Google will issue a warning if the title of two pages are the same. If possible,
the titles of all items should be unique. The suggested range is 60 to 120 characters. Anything over 120 is generally
truncates so it serves little purpose to have such long titles.');

define('ERROR_FAILED_NO_KEYWORDS_FOUND', '*** No keywords found for this page: %s');
define('ERROR_FAILED_PAGE_LOAD', 'Failed to load page from shop: %s');
define('ERROR_FAILED_WORDS', 'Failed to load SEO words file: %s');
define('ERROR_FAILED_DIR_OPEN', 'Failed to open directory: %s');
define('ERROR_FAILED_FILE_OPEN', 'Failed to open file: %s<br>');
define('ERROR_FAILED_FILE_WRITE', 'Failed to write file: %s<br>');
define('ERROR_INVALID_DELETION', 'Deletion of %s is not allowed');
define('ERROR_INVALID_FILENAME', 'Page not added - not Header Tags SEO compatible - %s');
define('ERROR_INVALID_FILENAME_DELETE', 'delete (use with caution)');
define('ERROR_INVALID_FILENAME_EXCLUDE', 'exclude');
define('ERROR_INVALID_FILENAME_TEST', '&nbsp;&nbsp;<span style="color:red;">%s</span> is an invalid name. This file should be renamed or deleted.');
define('ERROR_INVALID_PSEUDO_FORMAT', 'Entered pseudo page format, %s, is incorrect.');
define('ERROR_INVALID_PSEUDO_PAGE', 'The base file entered, %s, does not support pseudo pages.');
define('ERROR_LANGUAGE_MISMATCH_DB', 'Language %s ( id = %d ) in the shops languages does not have an entry in the default Header Tags table.');
define('ERROR_LANGUAGE_MISMATCH_HT', 'Language ID %d in default Header Tags table does not exist in the shops languages so it is useless.');
define('ERROR_LANGUAGE_MISMATCH_PRESENT', '&nbsp;&nbsp;languages in the Header Tags table are: %d ( %s ).');
define('ERROR_META_CANONICAL_TAG_OFF', 'The canonical meta tag is not enabled. It should be.');
define('ERROR_META_DATA_TEXT_ACTUAL', '&nbsp;&nbsp;<b>From Site:</b>');
define('ERROR_META_DATA_TEXT_SHOULD_BE', '&nbsp;&nbsp;<b>From Settings:</b>');
define('ERROR_META_DATA_TITLE', '&nbsp;&nbsp;&nbsp;&nbsp;<span style="background-color:%s">Title -></span> %s');
define('ERROR_META_DATA_DESC', '&nbsp;&nbsp;&nbsp;&nbsp;<span style="background-color:%s">Meta Description -></span> %s');
define('ERROR_META_DATA_KEYWORDS', '&nbsp;&nbsp;&nbsp;&nbsp;<span style="background-color:%s">Meta Keywords -></span> %s');
define('ERROR_META_DATA_COMPARE_RESULTS', '&nbsp;&nbsp;<b>Results of scan:</b>');
define('ERROR_META_DATA_MISSING_CODE', '&nbsp;&nbsp;&nbsp;&nbsp;%s is missing Header Tags code or it is not installed correctly. Verify that Fill Tags has been ran and that the root checkbox or the default checkboxes have been checked in Page Control.');
define('ERROR_META_DATA_NO_TAGS', '&nbsp;&nbsp;&nbsp;&nbsp;%s is missing data. Fill Tags should be ran.'); 
define('ERROR_MISSING_CODE', 'The Header Tags head code for the %s file cannot be found.');
define('ERROR_MISSING_CONFIGURATION', 'The Header Tags entries are missing from the configuration table.');
define('ERROR_MISSING_CONFIGURATION_GROUP', 'The Header Tags entry is missing from the configuration group table.');
define('ERROR_MISSING_DATABASE', 'The %s table cannot be found in the database.');
define('ERROR_MISSING_DATABASE_FIELD', 'The %s field cannot be found in the %s table.');
define('ERROR_MISSING_FILE', 'Cannot find file %s.');
define('ERROR_MISSING_PSEUDO', '&nbsp;&nbsp;The file <span style="color:red;">%s</span> should have pseudo code entries but does not.');
define('ERROR_MISSING_SORT_ORDER', 'Missing sort orders are not allowed -> %s');
define('ERROR_MISSING_STS_FILE', 'Required module entry, headertags.php, for STS not found.');
define('ERROR_MISSING_TAGS', 'Found Missing Tags:<br>');
define('ERROR_MISSING_TAGS_TYPE', '%s table has %d items with missing meta tag information.');
define('ERROR_NO_NAME', 'The name for this item is missing');
define('ERROR_NOT_USING_HEADER_TAGS', 'File %s is not using Header Tags.');
define('ERROR_SEARCH_ENGINE_OPTION', 'The Search Engine Friendly option is set. This should be disabled since it can cause various problems.');
define('ERROR_STS_EXTRA_CODE', 'STS is running and the head code in the %s file has Header Tags code installed, which is a mistake.');
define('ERROR_TEMPLATE_EXTRA_CODE', 'CRE or oscMax is running and the head code in the %s file has Header Tags code installed, which is a mistake.');
define('ERROR_TITLE_LENGTH_SHORT', 'The Title for %s may be too short. It is %s characters long.');
define('ERROR_TITLE_LENGTH_LONG', 'The Title for %s may be too long. It is %s characters long.');
define('ERROR_WRONG_PERMISSIONS', 'Permissions settings for the %s file appear to be incorrect. Change to %s. <span style="font-weight: bold; color: red;">NOTE: Disregard if on Windows server.</span>');

define('IMAGE_ADD', 'Add');
