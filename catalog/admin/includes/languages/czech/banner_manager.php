<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Banner Manager',true);

define('TABLE_HEADING_BANNERS', 'Banners',true);
define('TABLE_HEADING_GROUPS', 'Groups',true);
define('TABLE_HEADING_STATISTICS', 'Displays / Clicks',true);
define('TABLE_HEADING_STATUS', 'Status',true);
define('TABLE_HEADING_ACTION', 'Action',true);

define('TEXT_BANNERS_TITLE', 'Banner Title:',true);
define('TEXT_BANNERS_URL', 'Banner URL:',true);
define('TEXT_BANNERS_GROUP', 'Banner Group:',true);
define('TEXT_BANNERS_NEW_GROUP', ', or enter a new banner group below',true);
define('TEXT_BANNERS_IMAGE', 'Image:',true);
define('TEXT_BANNERS_IMAGE_LOCAL', ', or enter local file below',true);
define('TEXT_BANNERS_IMAGE_TARGET', 'Image Target (Save To):',true);
define('TEXT_BANNERS_HTML_TEXT', 'HTML Text:',true);
define('TEXT_BANNERS_EXPIRES_ON', 'Expires On:',true);
define('TEXT_BANNERS_OR_AT', ', or at',true);
define('TEXT_BANNERS_IMPRESSIONS', 'impressions/views.',true);
define('TEXT_BANNERS_SCHEDULED_AT', 'Scheduled At:',true);
define('TEXT_BANNERS_BANNER_NOTE', '<strong>Banner Notes:</strong><ul><li>Use an image or HTML text for the banner - not both.</li><li>HTML Text has priority over an image</li></ul>',true);
define('TEXT_BANNERS_INSERT_NOTE', '<strong>Image Notes:</strong><ul><li>Uploading directories must have proper user (write) permissions setup!</li><li>Do not fill out the \'Save To\' field if you are not uploading an image to the webserver (ie, you are using a local (serverside) image).</li><li>The \'Save To\' field must be an existing directory with an ending slash (eg, banners/).</li></ul>',true);
define('TEXT_BANNERS_EXPIRCY_NOTE', '<strong>Expiry Notes:</strong><ul><li>Only one of the two fields should be submitted</li><li>If the banner is not to expire automatically, then leave these fields blank</li></ul>',true);
define('TEXT_BANNERS_SCHEDULE_NOTE', '<strong>Schedule Notes:</strong><ul><li>If a schedule is set, the banner will be activated on that date.</li><li>All scheduled banners are marked as deactive until their date has arrived, to which they will then be marked active.</li></ul>',true);

define('TEXT_BANNERS_DATE_ADDED', 'Date Added:',true);
define('TEXT_BANNERS_SCHEDULED_AT_DATE', 'Scheduled At: <strong>%s</strong>',true);
define('TEXT_BANNERS_EXPIRES_AT_DATE', 'Expires At: <strong>%s</strong>',true);
define('TEXT_BANNERS_EXPIRES_AT_IMPRESSIONS', 'Expires At: <strong>%s</strong> impressions',true);
define('TEXT_BANNERS_STATUS_CHANGE', 'Status Change: %s',true);

define('TEXT_BANNERS_DATA', 'D<br />A<br />T<br />A',true);
define('TEXT_BANNERS_LAST_3_DAYS', 'Last 3 Days',true);
define('TEXT_BANNERS_BANNER_VIEWS', 'Banner Views',true);
define('TEXT_BANNERS_BANNER_CLICKS', 'Banner Clicks',true);

define('TEXT_INFO_DELETE_INTRO', 'Are you sure you want to delete this banner?',true);
define('TEXT_INFO_DELETE_IMAGE', 'Delete banner image',true);

define('SUCCESS_BANNER_INSERTED', 'Success: The banner has been inserted.',true);
define('SUCCESS_BANNER_UPDATED', 'Success: The banner has been updated.',true);
define('SUCCESS_BANNER_REMOVED', 'Success: The banner has been removed.',true);
define('SUCCESS_BANNER_STATUS_UPDATED', 'Success: The status of the banner has been updated.',true);

define('ERROR_BANNER_TITLE_REQUIRED', 'Error: Banner title required.',true);
define('ERROR_BANNER_GROUP_REQUIRED', 'Error: Banner group required.',true);
define('ERROR_IMAGE_DIRECTORY_DOES_NOT_EXIST', 'Error: Target directory does not exist: %s',true);
define('ERROR_IMAGE_DIRECTORY_NOT_WRITEABLE', 'Error: Target directory is not writeable: %s',true);
define('ERROR_IMAGE_DOES_NOT_EXIST', 'Error: Image does not exist.',true);
define('ERROR_IMAGE_IS_NOT_WRITEABLE', 'Error: Image can not be removed.',true);
define('ERROR_UNKNOWN_STATUS_FLAG', 'Error: Unknown status flag.',true);

define('ERROR_GRAPHS_DIRECTORY_DOES_NOT_EXIST', 'Error: Graphs directory does not exist. Please create a \'graphs\' directory inside \'images\'.',true);
define('ERROR_GRAPHS_DIRECTORY_NOT_WRITEABLE', 'Error: Graphs directory is not writeable.',true);