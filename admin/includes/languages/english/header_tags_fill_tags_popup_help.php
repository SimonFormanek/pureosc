<?php
/*
  $Id: header_tags_fill_tags_popup_help.php,v 1.0 2009/03/13 

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce
  Portions Copyright 2009 oscommerce-solution.com

  Released under the GNU General Public License
*/
define('HEADING_TITLE', 'Fill Tags Help');

$showArray = array();
$showArray['TEXT_OVERRIDE_DESCRIPTION'] = '<p>Description Override is used to change the description meta tag
for any number of products as taken from the products description. How much text is used depends upon the 
limit setting.</p>';

$showArray['TEXT_OVERRIDE_GENERIC'] = '<p>The Generic Override allows the selected items to be filled in for 
all,or any, items (categories, manufacturers and products), as selected at the bottom of the form. Wherever the 
text contains the special words ITEMNAME or UPPER_ITEMNAME, those special words will be replaced 
by the categories, manufacturers or products name. ITEMNAME will use the text as it appears in the database
while UPPER_ITEMNAME will convert it to upper case letters. In order to use this section, you must click
on the main enable checkbox. That will cause all of the individual checkboxes to become enabled. Each individual 
field can then be enabled/disabled by the checkbox beside the text box. After the checkboxes are checked and the 
text is entered as you like, select the Fill Tags options at the bottom and then click Update.  
</p>';

$showArray['TEXT_OVERRIDE_KEYWORDS'] = '<p>The Keywords Override determines how the keywords are filled in. 
Selecting "Yes" will cause the code to try to generate the keywords from the text on each of the pages that have been 
added into Header Tags (see the Page Control section for how to do that). Selecting "No" will cause them to be created 
from the title of the product in the database.</p>';

$showArray['TEXT_EXPLAIN_FILLTAGS'] = '<p>The Fill Tags section is used to fill in the various title and meta tags
for the categories, manufacturers and products in your shop. Select the appropriate setting for the categories, 
manufacturers and products tags and then click Update. If you select the Fill Only Empty Tags, then tags already
filled in will not be overwritten. If one of the override options is selected, then those options will be applied.
<br><br><span style="color:red;">Note: The options
on this page are not settings. If you leave this page and return, the options on this page will revert to the 
default settings. This only affects this page, not any changes made to the database.</span></p>';

$showArray['TEXT_EXPLAIN_SLEEP'] = '<p>The "Sleep" and "Item Count" options can be used when a database is too large, or 
the server settings too low, to allow Fill Tags to complete. For example, to fill in 10 items at a time, select Fill Empty 
or Fill All for that group (category, manufacturer or product), click on the Sleep checkbox, enter 10 in the Item Count 
box and click Update. The counter at the bottom of the page should show 10 items were filled. Click Update again to fill 
the next 10. Any number can be entered in the Item Count box but one small enough not to cause a timeout is needed. That 
will vary with the server. 
</p>';

define('TEXT_CLOSE_POPUP', 'Close Window'); 

