<?php
/*
  $Id: header_tags_seo_social.php,v 3.0 2013/01/10 14:07:36 hpdl Exp $
  Created by Jack York from http://www.oscommerce-solution.com

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce
  Portions Copyright 2009 oscommerce-solution.com

  Released under the GNU General Public License
*/
define('HEADING_TITLE', 'Header Tags SEO Social Media');
define('HEADING_TEXT_SOCIAL_ICONS', 'This section provides a way to control the various social media related items.
When entering a url for one of the social icons, it it important to use the keywords URL and TITLE (in caps)
where they are needed in the url since they will be replaced in the code with the proper values. If those
aren\'t entered, the entry won\'t be recorded. You also must check the icon by the same name.

The code works off of the images in the images/socialbookmarks/ directory. If a new image is added there, it will show
up in the icons on this page with a box for its link. Likewise, if you delete an icon, it will no longer
show here. There are many sites around that offer free packages of icon images. Some are quite unique so 
you may want to play around with getting a set that fits your site.
');

define('HEADING_TEXT_TWITTER_CARD', 'This section controls the Twitter Card options. Saving an empty entry will delete the option.');
define('TEXT_DISABLE', 'Disable');

define('TEXT_TWITTER_CREATOR', 'Your Twitter user name');
define('TEXT_TWITTER_SITE', 'Site Name');
define('TEXT_TWITTER_SUMMARY', 'summary');


define('TEXT_SIZE_16', '16x16');
define('TEXT_SIZE_24', '24x24');
define('TEXT_SIZE_32', '32x32');
define('TEXT_SIZE_48', '48x48');

define('ERROR_NO_MATCH', 'Images and urls do not match.');
define('RESULT_DISABLED', '&nbsp;&nbsp;Social Bookmarks Disabled');
define('RESULT_FAILED', '&nbsp;&nbsp;Save Failed!');
define('RESULT_FAILED_NO_SELECTION', '&nbsp;&nbsp;Not Saved - no icons picked');
define('RESULT_MISSING_PARAMETERS', 'Missing required url parameters');
define('RESULT_SUCCESS_INSERTED', '&nbsp;&nbsp;Data Save was successful');
define('RESULT_SUCCESS_REMOVED_TWITTER', '&nbsp;&nbsp;Removed Twitter Card');
define('RESULT_SUCCESS_UPDATED', '&nbsp;&nbsp;Data Change was successful');

define('RESULT_TWITTER_DATA_MISSING', 'Both fields are required');
?>
