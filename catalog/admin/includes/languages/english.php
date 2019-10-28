<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2014 osCommerce

  Edited by 2014 Newburns Design and Technology
 * ************************************************
 * *********** New addon definitions **************
 * ***********        Below          **************
 * ************************************************
  SEO Header Tags Reloaded added -- http://addons.oscommerce.com/info/8864
  Database Check 1.4 added -- http://addons.oscommerce.com/info/9087
  Manual Order Maker added -- http://addons.oscommerce.com/info/8334
  Alternative Administration System added -- http://addons.oscommerce.com/info/9135
  Credit Class, Gift Vouchers & Discount Coupons osC2.3.3.4 (CCGV) added -- http://addons.oscommerce.com/info/9020
  Mail Manager added -- http://addons.oscommerce.com/info/9133/v,23

  Released under the GNU General Public License
 */

// look in your $PATH_LOCALE/locale directory for available locales..
// on RedHat6.0 I used 'en_US'
// on FreeBSD 4.0 I use 'en_US.ISO_8859-1'
// this may not work under win32 environments..
setlocale(LC_ALL, array('en_US.UTF-8', 'en_US.UTF8', 'enu_usa'));
define('DATE_FORMAT_SHORT', '%m/%d/%Y', true);  // this is used for strftime()
define('DATE_FORMAT_LONG', '%A %d %B, %Y', true); // this is used for strftime()
define('DATE_FORMAT', 'm/d/Y', true); // this is used for date()
define('PHP_DATE_TIME_FORMAT', 'm/d/Y H:i:s', true); // this is used for date()
define('DATE_TIME_FORMAT', DATE_FORMAT_SHORT.' %H:%M:%S', true);
define('JQUERY_DATEPICKER_I18N_CODE', '', true); // leave empty for en_US; see http://jqueryui.com/demos/datepicker/#localization
define('JQUERY_DATEPICKER_FORMAT', 'mm/dd/yy', true); // see http://docs.jquery.com/UI/Datepicker/formatDate

////
// Return date in raw format
// $date should be in format mm/dd/yyyy
// raw date is in format YYYYMMDD, or DDMMYYYY
function tep_date_raw($date, $reverse = false)
{
    if ($reverse) {
        return substr($date, 3, 2).substr($date, 0, 2).substr($date, 6, 4);
    } else {
        return substr($date, 6, 4).substr($date, 0, 2).substr($date, 3, 2);
    }
}
// Global entries for the <html> tag
define('HTML_PARAMS', 'dir="ltr" lang="en"', true);

// charset for web pages and emails
define('CHARSET', 'utf-8', true);

// page title
define('TITLE', 'Administration', true);

// header text in includes/header.php
define('HEADER_TITLE_TOP', 'Administration', true);
define('HEADER_TITLE_SUPPORT_SITE', 'Support Site', true);
define('HEADER_TITLE_ONLINE_CATALOG', 'Online Catalog', true);
define('HEADER_TITLE_ADMINISTRATION', 'Administration', true);

// text for gender
define('MALE', 'Male', true);
define('FEMALE', 'Female', true);

// text for date of birth example
define('DOB_FORMAT_STRING', 'mm/dd/yyyy', true);

// configuration box text in includes/boxes/configuration.php
define('BOX_HEADING_CONFIGURATION', 'Configuration', true);
define('BOX_CONFIGURATION_MYSTORE', 'My Store', true);
define('BOX_CONFIGURATION_LOGGING', 'Logging', true);
define('BOX_CONFIGURATION_CACHE', 'Cache', true);
define('BOX_CONFIGURATION_ADMINISTRATORS', 'Administrators', true);
define('BOX_CONFIGURATION_STORE_LOGO', 'Store Logo', true);

// modules box text in includes/boxes/modules.php
define('BOX_HEADING_MODULES', 'Modules', true);

// categories box text in includes/boxes/catalog.php
define('BOX_HEADING_CATALOG', 'Catalog', true);
define('BOX_CATALOG_CATEGORIES_PRODUCTS', 'Categories/Products', true);
define('BOX_CATALOG_CATEGORIES_PRODUCTS_ATTRIBUTES', 'Products Attributes', true);
define('BOX_CATALOG_MANUFACTURERS', 'Manufacturers', true);
define('BOX_CATALOG_REVIEWS', 'Reviews', true);
define('BOX_CATALOG_SPECIALS', 'Specials', true);
define('BOX_CATALOG_PRODUCTS_EXPECTED', 'Products Expected', true);

// customers box text in includes/boxes/customers.php
define('BOX_HEADING_CUSTOMERS', 'Customers', true);
define('BOX_CUSTOMERS_CUSTOMERS', 'Customers', true);

// orders box text in includes/boxes/orders.php
define('BOX_HEADING_ORDERS', 'Orders', true);
define('BOX_ORDERS_ORDERS', 'Orders', true);

// taxes box text in includes/boxes/taxes.php
define('BOX_HEADING_LOCATION_AND_TAXES', 'Locations / Taxes', true);
define('BOX_TAXES_COUNTRIES', 'Countries', true);
define('BOX_TAXES_ZONES', 'Zones', true);
define('BOX_TAXES_GEO_ZONES', 'Tax Zones', true);
define('BOX_TAXES_TAX_CLASSES', 'Tax Classes', true);
define('BOX_TAXES_TAX_RATES', 'Tax Rates', true);

// reports box text in includes/boxes/reports.php
define('BOX_HEADING_REPORTS', 'Reports', true);
define('BOX_REPORTS_PRODUCTS_VIEWED', 'Products Viewed', true);
define('BOX_REPORTS_PRODUCTS_PURCHASED', 'Products Purchased', true);
define('BOX_REPORTS_ORDERS_TOTAL', 'Customer Orders-Total', true);
define('BOX_REPORTS_STATS_SALES', 'Stat sales', true);

// tools text in includes/boxes/tools.php
define('BOX_HEADING_TOOLS', 'Tools', true);
define('BOX_TOOLS_ACTION_RECORDER', 'Action Recorder', true);
define('BOX_TOOLS_BACKUP', 'Database Backup', true);
define('BOX_TOOLS_BANNER_MANAGER', 'Banner Manager', true);
define('BOX_TOOLS_CACHE', 'Cache Control', true);
define('BOX_TOOLS_DEFINE_LANGUAGE', 'Define Languages', true);
define('BOX_TOOLS_MAIL', 'Send Email', true);
define('BOX_TOOLS_NEWSLETTER_MANAGER', 'Newsletter Manager', true);
define('BOX_TOOLS_SEC_DIR_PERMISSIONS', 'Security Directory Permissions', true);
define('BOX_TOOLS_SERVER_INFO', 'Server Info', true);
define('BOX_TOOLS_VERSION_CHECK', 'Version Checker', true);
define('BOX_TOOLS_WHOS_ONLINE', 'Who\'s Online', true);
define('BOX_TOOLS_FLEXIBEE_SYNC', 'Flexibee sync', true);

// localizaion box text in includes/boxes/localization.php
define('BOX_HEADING_LOCALIZATION', 'Localization', true);
define('BOX_LOCALIZATION_CURRENCIES', 'Currencies', true);
define('BOX_LOCALIZATION_LANGUAGES', 'Languages', true);
define('BOX_LOCALIZATION_ORDERS_STATUS', 'Orders Status', true);

// BOF: Information Pages Unlimited
// localizaion box text in includes/boxes/information.php
define('BOX_HEADING_INFORMATION', 'Info manager');
// EOF: Information Pages Unlimited
// javascript messages
define('JS_ERROR',
    'Errors have occured during the process of your form!\nPlease make the following corrections:\n\n',
    true);

define('JS_OPTIONS_VALUE_PRICE',
    '* The new product atribute needs a price value\n', true);
define('JS_OPTIONS_VALUE_PRICE_PREFIX',
    '* The new product atribute needs a price prefix\n', true);

define('JS_PRODUCTS_NAME', '* The new product needs a name\n', true);
define('JS_PRODUCTS_DESCRIPTION', '* The new product needs a description\n',
    true);
define('JS_PRODUCTS_PRICE', '* The new product needs a price value\n', true);
define('JS_PRODUCTS_WEIGHT', '* The new product needs a weight value\n', true);
define('JS_PRODUCTS_QUANTITY', '* The new product needs a quantity value\n',
    true);
define('JS_PRODUCTS_MODEL', '* The new product needs a model value\n', true);
define('JS_PRODUCTS_IMAGE', '* The new product needs an image value\n', true);

define('JS_SPECIALS_PRODUCTS_PRICE',
    '* A new price for this product needs to be set\n', true);

define('JS_GENDER', '* The \'Gender\' value must be chosen.\n', true);
define('JS_FIRST_NAME',
    '* The \'First Name\' entry must have at least '.ENTRY_FIRST_NAME_MIN_LENGTH.' characters.\n',
    true);
define('JS_LAST_NAME',
    '* The \'Last Name\' entry must have at least '.ENTRY_LAST_NAME_MIN_LENGTH.' characters.\n',
    true);
define('JS_DOB',
    '* The \'Date of Birth\' entry must be in the format: xx/xx/xxxx (month/date/year).\n',
    true);
define('JS_EMAIL_ADDRESS',
    '* The \'E-Mail Address\' entry must have at least '.ENTRY_EMAIL_ADDRESS_MIN_LENGTH.' characters.\n',
    true);
define('JS_ADDRESS',
    '* The \'Street Address\' entry must have at least '.ENTRY_STREET_ADDRESS_MIN_LENGTH.' characters.\n',
    true);
define('JS_POST_CODE',
    '* The \'Post Code\' entry must have at least '.ENTRY_POSTCODE_MIN_LENGTH.' characters.\n',
    true);
define('JS_CITY',
    '* The \'City\' entry must have at least '.ENTRY_CITY_MIN_LENGTH.' characters.\n',
    true);
define('JS_STATE', '* The \'State\' entry is must be selected.\n', true);
define('JS_STATE_SELECT', '-- Select Above --', true);
define('JS_ZONE',
    '* The \'State\' entry must be selected from the list for this country.',
    true);
define('JS_COUNTRY', '* The \'Country\' value must be chosen.\n', true);
define('JS_TELEPHONE',
    '* The \'Telephone Number\' entry must have at least '.ENTRY_TELEPHONE_MIN_LENGTH.' characters.\n',
    true);
define('JS_PASSWORD',
    '* The \'Password\' amd \'Confirmation\' entries must match amd have at least '.ENTRY_PASSWORD_MIN_LENGTH.' characters.\n',
    true);

define('JS_ORDER_DOES_NOT_EXIST', 'Order Number %s does not exist!', true);

define('CATEGORY_PERSONAL', 'Personal', true);
define('CATEGORY_ADDRESS', 'Address', true);
define('CATEGORY_CONTACT', 'Contact', true);
define('CATEGORY_COMPANY', 'Company', true);
define('CATEGORY_OPTIONS', 'Options', true);

define('ENTRY_GENDER', 'Gender:', true);
define('ENTRY_GENDER_ERROR', '&nbsp;<span class="errorText">required</span>',
    true);
define('ENTRY_FIRST_NAME', 'First Name:', true);
define('ENTRY_FIRST_NAME_ERROR',
    '&nbsp;<span class="errorText">min '.ENTRY_FIRST_NAME_MIN_LENGTH.' chars</span>',
    true);
define('ENTRY_LAST_NAME', 'Last Name:', true);
define('ENTRY_LAST_NAME_ERROR',
    '&nbsp;<span class="errorText">min '.ENTRY_LAST_NAME_MIN_LENGTH.' chars</span>',
    true);
define('ENTRY_DATE_OF_BIRTH', 'Date of Birth:', true);
define('ENTRY_DATE_OF_BIRTH_ERROR',
    '&nbsp;<span class="errorText">(eg. 05/21/1970)</span>', true);
define('ENTRY_EMAIL_ADDRESS', 'E-Mail Address:', true);
define('ENTRY_EMAIL_ADDRESS_ERROR',
    '&nbsp;<span class="errorText">min '.ENTRY_EMAIL_ADDRESS_MIN_LENGTH.' chars</span>',
    true);
define('ENTRY_EMAIL_ADDRESS_CHECK_ERROR',
    '&nbsp;<span class="errorText">The email address doesn\'t appear to be valid!</span>',
    true);
define('ENTRY_EMAIL_ADDRESS_ERROR_EXISTS',
    '&nbsp;<span class="errorText">This email address already exists!</span>',
    true);
define('ENTRY_STREET_ADDRESS', 'Street Address:', true);
define('ENTRY_STREET_ADDRESS_ERROR',
    '&nbsp;<span class="errorText">min '.ENTRY_STREET_ADDRESS_MIN_LENGTH.' chars</span>',
    true);
define('ENTRY_SUBURB', 'Suburb:', true);
define('ENTRY_POST_CODE', 'Post Code:', true);
define('ENTRY_POST_CODE_ERROR',
    '&nbsp;<span class="errorText">min '.ENTRY_POSTCODE_MIN_LENGTH.' chars</span>',
    true);
define('ENTRY_CITY', 'City:', true);
define('ENTRY_CITY_ERROR',
    '&nbsp;<span class="errorText">min '.ENTRY_CITY_MIN_LENGTH.' chars</span>',
    true);
define('ENTRY_STATE', 'State:', true);
define('ENTRY_STATE_ERROR', '&nbsp;<span class="errorText">required</span>',
    true);
define('ENTRY_COUNTRY', 'Country:', true);
define('ENTRY_COUNTRY_ERROR',
    'You must select a country from the Countries pull down menu.', true);
define('ENTRY_TELEPHONE_NUMBER', 'Telephone Number:', true);
define('ENTRY_TELEPHONE_NUMBER_ERROR',
    '&nbsp;<span class="errorText">min '.ENTRY_TELEPHONE_MIN_LENGTH.' chars</span>',
    true);
define('ENTRY_FAX_NUMBER', 'Fax Number:', true);
define('ENTRY_NEWSLETTER', 'Newsletter:', true);
define('ENTRY_NEWSLETTER_YES', 'Subscribed', true);
define('ENTRY_NEWSLETTER_NO', 'Unsubscribed', true);

// images
define('IMAGE_ANI_SEND_EMAIL', 'Sending E-Mail', true);
define('IMAGE_BACK', 'Back', true);
define('IMAGE_BACKUP', 'Backup', true);
define('IMAGE_CANCEL', 'Cancel', true);
define('IMAGE_CONFIRM', 'Confirm', true);
define('IMAGE_COPY', 'Copy', true);
define('IMAGE_COPY_TO', 'Copy To', true);
define('IMAGE_DETAILS', 'Details', true);
define('IMAGE_DELETE', 'Delete', true);
define('IMAGE_EDIT', 'Edit', true);
define('IMAGE_EMAIL', 'Email', true);
define('IMAGE_EXPORT', 'Export', true);
define('IMAGE_ICON_STATUS_GREEN', 'Active', true);
define('IMAGE_ICON_STATUS_GREEN_LIGHT', 'Set Active', true);
define('IMAGE_ICON_STATUS_RED', 'Inactive', true);
define('IMAGE_ICON_STATUS_RED_LIGHT', 'Set Inactive', true);
define('IMAGE_ICON_INFO', 'Info', true);
define('IMAGE_INSERT', 'Insert', true);
define('IMAGE_LOCK', 'Lock', true);
define('IMAGE_MODULE_INSTALL', 'Install Module', true);
define('IMAGE_MODULE_REMOVE', 'Remove Module', true);
define('IMAGE_MOVE', 'Move', true);
define('IMAGE_NEW_BANNER', 'New Banner', true);
define('IMAGE_NEW_CATEGORY', 'New Category', true);
define('IMAGE_NEW_COUNTRY', 'New Country', true);
define('IMAGE_NEW_CURRENCY', 'New Currency', true);
define('IMAGE_NEW_FILE', 'New File', true);
define('IMAGE_NEW_FOLDER', 'New Folder', true);
define('IMAGE_NEW_LANGUAGE', 'New Language', true);
define('IMAGE_NEW_NEWSLETTER', 'New Newsletter', true);
define('IMAGE_NEW_PRODUCT', 'New Product', true);
define('IMAGE_NEW_TAX_CLASS', 'New Tax Class', true);
define('IMAGE_NEW_TAX_RATE', 'New Tax Rate', true);
define('IMAGE_NEW_TAX_ZONE', 'New Tax Zone', true);
define('IMAGE_NEW_ZONE', 'New Zone', true);
define('IMAGE_ORDERS', 'Orders', true);
define('IMAGE_ORDERS_INVOICE', 'Invoice', true);
define('IMAGE_ORDERS_PACKINGSLIP', 'Packing Slip', true);
define('IMAGE_PREVIEW', 'Preview', true);
define('IMAGE_RESTORE', 'Restore', true);
define('IMAGE_RESET', 'Reset', true);
define('IMAGE_SAVE', 'Save', true);
define('IMAGE_SEARCH', 'Search', true);
define('IMAGE_SELECT', 'Select', true);
define('IMAGE_SEND', 'Send', true);
define('IMAGE_SEND_EMAIL', 'Send Email', true);
define('IMAGE_UNLOCK', 'Unlock', true);
define('IMAGE_UPDATE', 'Update', true);
define('IMAGE_UPDATE_CURRENCIES', 'Update Exchange Rate', true);
define('IMAGE_UPLOAD', 'Upload', true);

define('ICON_CROSS', 'False', true);
define('ICON_CURRENT_FOLDER', 'Current Folder', true);
define('ICON_DELETE', 'Delete', true);
define('ICON_ERROR', 'Error', true);
define('ICON_FILE', 'File', true);
define('ICON_FILE_DOWNLOAD', 'Download', true);
define('ICON_FOLDER', 'Folder', true);
define('ICON_LOCKED', 'Locked', true);
define('ICON_PREVIOUS_LEVEL', 'Previous Level', true);
define('ICON_PREVIEW', 'Preview', true);
define('ICON_STATISTICS', 'Statistics', true);
define('ICON_SUCCESS', 'Success', true);
define('ICON_TICK', 'True', true);
define('ICON_UNLOCKED', 'Unlocked', true);
define('ICON_WARNING', 'Warning', true);

// constants for use in tep_prev_next_display function
define('TEXT_RESULT_PAGE', 'Page %s of %d', true);
define('TEXT_DISPLAY_NUMBER_OF_BANNERS',
    'Displaying <strong>%d</strong> to <strong>%d</strong> (of <strong>%d</strong> banners)',
    true);
define('TEXT_DISPLAY_NUMBER_OF_COUNTRIES',
    'Displaying <strong>%d</strong> to <strong>%d</strong> (of <strong>%d</strong> countries)',
    true);
define('TEXT_DISPLAY_NUMBER_OF_CUSTOMERS',
    'Displaying <strong>%d</strong> to <strong>%d</strong> (of <strong>%d</strong> customers)',
    true);
define('TEXT_DISPLAY_NUMBER_OF_CURRENCIES',
    'Displaying <strong>%d</strong> to <strong>%d</strong> (of <strong>%d</strong> currencies)',
    true);
define('TEXT_DISPLAY_NUMBER_OF_ENTRIES',
    'Displaying <strong>%d</strong> to <strong>%d</strong> (of <strong>%d</strong> entries)',
    true);
define('TEXT_DISPLAY_NUMBER_OF_LANGUAGES',
    'Displaying <strong>%d</strong> to <strong>%d</strong> (of <strong>%d</strong> languages)',
    true);
define('TEXT_DISPLAY_NUMBER_OF_MANUFACTURERS',
    'Displaying <strong>%d</strong> to <strong>%d</strong> (of <strong>%d</strong> manufacturers)',
    true);
define('TEXT_DISPLAY_NUMBER_OF_NEWSLETTERS',
    'Displaying <strong>%d</strong> to <strong>%d</strong> (of <strong>%d</strong> newsletters)',
    true);
define('TEXT_DISPLAY_NUMBER_OF_ORDERS',
    'Displaying <strong>%d</strong> to <strong>%d</strong> (of <strong>%d</strong> orders)',
    true);
define('TEXT_DISPLAY_NUMBER_OF_ORDERS_STATUS',
    'Displaying <strong>%d</strong> to <strong>%d</strong> (of <strong>%d</strong> orders status)',
    true);
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS',
    'Displaying <strong>%d</strong> to <strong>%d</strong> (of <strong>%d</strong> products)',
    true);
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS_EXPECTED',
    'Displaying <strong>%d</strong> to <strong>%d</strong> (of <strong>%d</strong> products expected)',
    true);
define('TEXT_DISPLAY_NUMBER_OF_REVIEWS',
    'Displaying <strong>%d</strong> to <strong>%d</strong> (of <strong>%d</strong> product reviews)',
    true);
define('TEXT_DISPLAY_NUMBER_OF_SPECIALS',
    'Displaying <strong>%d</strong> to <strong>%d</strong> (of <strong>%d</strong> products on special)',
    true);
define('TEXT_DISPLAY_NUMBER_OF_TAX_CLASSES',
    'Displaying <strong>%d</strong> to <strong>%d</strong> (of <strong>%d</strong> tax classes)',
    true);
define('TEXT_DISPLAY_NUMBER_OF_TAX_ZONES',
    'Displaying <strong>%d</strong> to <strong>%d</strong> (of <strong>%d</strong> tax zones)',
    true);
define('TEXT_DISPLAY_NUMBER_OF_TAX_RATES',
    'Displaying <strong>%d</strong> to <strong>%d</strong> (of <strong>%d</strong> tax rates)',
    true);
define('TEXT_DISPLAY_NUMBER_OF_ZONES',
    'Displaying <strong>%d</strong> to <strong>%d</strong> (of <strong>%d</strong> zones)',
    true);

define('PREVNEXT_BUTTON_PREV', '&lt;&lt;', true);
define('PREVNEXT_BUTTON_NEXT', '&gt;&gt;', true);

define('TEXT_DEFAULT', 'default', true);
define('TEXT_SET_DEFAULT', 'Set as default', true);
define('TEXT_FIELD_REQUIRED',
    '&nbsp;<span class="fieldRequired">* Required</span>', true);

define('TEXT_CACHE_CATEGORIES', 'Categories Box', true);
define('TEXT_CACHE_MANUFACTURERS', 'Manufacturers Box', true);
define('TEXT_CACHE_ALSO_PURCHASED', 'Also Purchased Module', true);

define('TEXT_NONE', '--none--', true);
define('TEXT_TOP', 'Top', true);

define('ERROR_DESTINATION_DOES_NOT_EXIST', 'Error: Destination does not exist.',
    true);
define('ERROR_DESTINATION_NOT_WRITEABLE', 'Error: Destination not writeable.',
    true);
define('ERROR_FILE_NOT_SAVED', 'Error: File upload not saved.', true);
define('ERROR_FILETYPE_NOT_ALLOWED', 'Error: File upload type not allowed.',
    true);
define('SUCCESS_FILE_SAVED_SUCCESSFULLY',
    'Success: File upload saved successfully.', true);
define('WARNING_NO_FILE_UPLOADED', 'Warning: No file uploaded.', true);

// bootstrap helper
define('MODULE_CONTENT_BOOTSTRAP_ROW_DESCRIPTION',
    '<p>Content Width can be 12 or less per column per row.</p><p>12/12 = 100% width, 6/12 = 50% width, 4/12 = 33% width.</p><p>Total of all columns in any one row must equal 12 (eg:  3 boxes of 4 columns each, 1 box of 12 columns and so on).</p>',
    true);
/*
 * ***********************************************************************
 * ************* Custom Filenames can be defined below here **************
 * *************               Raymond Burns                **************
 * ***********************************************************************
 */
// Definition for SEO Header Tags Reloaded
define('BOX_CUSTOMERS_ORDERS', 'Orders', true);
define('PLACEHOLDER_COMMA_SEPARATION', 'Must, Be, Comma, Separated', true);
define('BOX_CUSTOMERS_CREATE_ORDER', 'Create Order', true);
define('IMAGE_DETAIL', 'Details', true);
define('TABLE_HEADING_EDIT_ORDERS', 'To modify the order', true);
define('TEXT_IMAGE_CREATE', 'Create Order', true);
define('TEXT_INFO_CUSTOMER_SERVICE_ID', 'Entered by:', true);
define('IMAGE_CREATE_ORDER', 'Create New Order', true);
define('BOX_CUSTOMERS_CREATE_ORDER', 'Create Order', true);
// EOF Order Maker

// Alternative Administration System
define('BOX_HEADING_AAS', 'A.A.S.', true);
define('BOX_AAS_ACCESS_AAS', 'Access AAS', true);
define('BOX_AAS_SUPPORT', 'Support', true);
define('BOX_AAS_DISCUSSION_BOARD', 'Discussion Board', true);
define('BOX_AAS_DONATIONS', 'Make a Donation', true);
// Database Check Tool
define('BOX_TOOLS_DATABASE_CHECK', 'Database Check', true);
// CCGV
define('BOX_HEADING_GV_ADMIN', 'Vouchers/Coupons', true);
define('BOX_GV_ADMIN_QUEUE', 'Gift Voucher Queue', true);
define('BOX_GV_ADMIN_MAIL', 'Mail Gift Voucher', true);
define('BOX_GV_ADMIN_SENT', 'Gift Vouchers sent', true);
define('BOX_COUPON_ADMIN', 'Coupon Admin', true);
define('IMAGE_RELEASE', 'Redeem Gift Voucher', true);
define('TEXT_DISPLAY_NUMBER_OF_GIFT_VOUCHERS',
    'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> gift vouchers)', true);
define('TEXT_DISPLAY_NUMBER_OF_COUPONS',
    'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> coupons)', true);
define('TEXT_VALID_PRODUCTS_LIST', 'Products List', true);
define('TEXT_VALID_PRODUCTS_ID', 'Products ID', true);
define('TEXT_VALID_PRODUCTS_NAME', 'Products Name', true);
define('TEXT_VALID_PRODUCTS_MODEL', 'Products Model', true);
define('TEXT_VALID_CATEGORIES_LIST', 'Categories List', true);
define('TEXT_VALID_CATEGORIES_ID', 'Category ID', true);
define('TEXT_VALID_CATEGORIES_NAME', 'Category Name', true);
// Mail Manager
define('BOX_HEADING_MAIL_MANAGER', 'Mail Manager', true);
define('BOX_MM_BULKMAIL', 'BulkMail Manager', true);
define('BOX_MM_TEMPLATES', 'Template Manager', true);
define('BOX_MM_EMAIL', 'Send Email', true);
define('BOX_MM_RESPONSEMAIL', 'Response Mail', true);
define('BOX_TOOLS_MAIL_MANAGER', 'Mail Manager', true);

// BOF Create Account 
define('BOX_CUSTOMERS_CREATE_ACCOUNT', 'Create Customer', true);
define('IMAGE_CONTINUE', 'Continue', true);
// EOF Create Account
//VAT number
/* * ** BEGIN ARTICLE MANAGER *** */
define('BOX_HEADING_ARTICLES', 'Article Manager');
define('BOX_TOPICS_ARTICLES', 'Topics/Articles');
define('BOX_ARTICLES_CONFIG', 'Configuration');
define('BOX_ARTICLES_AUTHORS', 'Authors');
define('BOX_ARTICLES_BLOG_COMMENTS', 'Blog Comments');
define('BOX_ARTICLES_REVIEWS', 'Reviews');
define('BOX_ARTICLES_XSELL', 'Cross-Sell Articles');
define('IMAGE_NEW_TOPIC', 'New Topic');
define('IMAGE_NEW_ARTICLE', 'New Article');
define('TEXT_DISPLAY_NUMBER_OF_AUTHORS',
    'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> authors)');
/* * ** END ARTICLE MANAGER *** */

/* * * Begin Header Tags SEO ** */
// header_tags_seo text in includes/boxes/header_tags_seo.php
define('BOX_HEADING_HEADER_TAGS_SEO', 'Header Tags SEO');
define('BOX_HEADER_TAGS_ADD_A_PAGE', 'Page Control');
define('BOX_HEADER_TAGS_FILL_TAGS', 'Fill Tags');
define('BOX_HEADER_TAGS_KEYWORDS', 'Keywords');
define('BOX_HEADER_TAGS_SILO', 'Silo Control');
define('BOX_HEADER_TAGS_SOCIAL', 'Social');
define('BOX_HEADER_TAGS_TEST', 'Test');
/*** End Header Tags SEO ***/
define('BOX_TOOLS_DATABASE_OPTIMIZER', 'Database Optimizer');
