<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2013 osCommerce
  
  Edited by 2014 Newburns Design and Technology
  *************************************************
  ************ New addon definitions **************
  ************        Below          **************
  *************************************************
  SEO Header Tags Reloaded added -- http://addons.oscommerce.com/info/8864
  Credit Class, Gift Vouchers & Discount Coupons osC2.3.3.4 (CCGV) added -- http://addons.oscommerce.com/info/9020
  Mail Manager added -- http://addons.oscommerce.com/info/9133/v,23
  
  Released under the GNU General Public License
*/

// look in your $PATH_LOCALE/locale directory for available locales
// or type locale -a on the server.
// Examples:
// on RedHat try 'en_US'
// on FreeBSD try 'en_US.ISO_8859-1'
// on Windows try 'en', or 'English'
@setlocale(LC_ALL, array('en_US.UTF-8', 'en_US.UTF8', 'enu_usa'));

define('DATE_FORMAT_SHORT', '%m/%d/%Y',true);  // this is used for strftime()
define('DATE_FORMAT_LONG', '%A %d %B, %Y',true); // this is used for strftime()
define('DATE_FORMAT', 'm/d/Y',true); // this is used for date()
define('DATE_TIME_FORMAT', DATE_FORMAT_SHORT . ' %H:%M:%S',true);
define('JQUERY_DATEPICKER_I18N_CODE', '',true); // leave empty for en_US; see http://jqueryui.com/demos/datepicker/#localization
define('JQUERY_DATEPICKER_FORMAT', 'mm/dd/yy',true); // see http://docs.jquery.com/UI/Datepicker/formatDate

////
// Return date in raw format
// $date should be in format mm/dd/yyyy
// raw date is in format YYYYMMDD, or DDMMYYYY
function tep_date_raw($date, $reverse = false) {
  if ($reverse) {
    return substr($date, 3, 2) . substr($date, 0, 2) . substr($date, 6, 4);
  } else {
    return substr($date, 6, 4) . substr($date, 0, 2) . substr($date, 3, 2);
  }
}

// if USE_DEFAULT_LANGUAGE_CURRENCY is true, use the following currency, instead of the applications default currency (used when changing language)
define('LANGUAGE_CURRENCY', 'USD',true);

// Global entries for the <html> tag
define('HTML_PARAMS', 'dir="ltr" lang="en"',true);

// charset for web pages and emails
define('CHARSET', 'utf-8',true);

// page title
define('TITLE', STORE_NAME);

// header text in includes/header.php
define('HEADER_TITLE_CREATE_ACCOUNT', 'Create an Account',true);
define('HEADER_TITLE_MY_ACCOUNT', 'My Account',true);
define('HEADER_TITLE_CART_CONTENTS', 'Cart Contents',true);
define('HEADER_TITLE_CHECKOUT', 'Checkout',true);
define('HEADER_TITLE_TOP', '<i class="fa fa-home"><span class="sr-only">Home</span></i>',true);
define('HEADER_TITLE_CATALOG', 'Catalog',true);
define('HEADER_TITLE_LOGOFF', 'Log Off',true);
define('HEADER_TITLE_LOGIN', 'Log In',true);

// text for gender
define('MALE', 'M<span class="hidden-xs">ale</span>',true);
define('FEMALE', 'F<span class="hidden-xs">emale</span>',true);
define('MALE_ADDRESS', 'Mr.',true);
define('FEMALE_ADDRESS', 'Ms.',true);

// text for date of birth example
define('DOB_FORMAT_STRING', 'mm/dd/yyyy',true);

// checkout procedure text
define('CHECKOUT_BAR_DELIVERY', 'Delivery Information',true);
define('CHECKOUT_BAR_PAYMENT', 'Payment Information',true);
define('CHECKOUT_BAR_CONFIRMATION', 'Confirmation',true);
define('CHECKOUT_BAR_FINISHED', 'Finished!',true);

// pull down default text
define('PULL_DOWN_DEFAULT', 'Please Select',true);
define('TYPE_BELOW', 'Type Below',true);

// javascript messages
define('JS_ERROR', 'Errors have occured during the process of your form.\n\nPlease make the following corrections:\n\n',true);

define('JS_REVIEW_TEXT', '* The \'Review Text\' must have at least ' . REVIEW_TEXT_MIN_LENGTH . ' characters.\n',true);
define('JS_REVIEW_RATING', '* You must rate the product for your review.\n',true);

define('JS_ERROR_NO_PAYMENT_MODULE_SELECTED', '* Please select a payment method for your order.\n',true);

define('JS_ERROR_SUBMITTED', 'This form has already been submitted. Please press Ok and wait for this process to be completed.',true);

define('ERROR_NO_PAYMENT_MODULE_SELECTED', 'Please select a payment method for your order.',true);

define('CATEGORY_COMPANY', 'Company Details',true);
define('CATEGORY_PERSONAL', 'Your Personal Details',true);
define('CATEGORY_ADDRESS', 'Your Address',true);
define('CATEGORY_CONTACT', 'Your Contact Information',true);
define('CATEGORY_OPTIONS', 'Options',true);
define('CATEGORY_PASSWORD', 'Your Password',true);

define('ENTRY_COMPANY', 'Company Name',true);
define('ENTRY_COMPANY_TEXT', '',true);
define('ENTRY_GENDER', 'Gender',true);
define('ENTRY_GENDER_ERROR', 'Please select your Gender.',true);
define('ENTRY_GENDER_TEXT', '',true);
define('ENTRY_FIRST_NAME', 'First Name',true);
define('ENTRY_FIRST_NAME_ERROR', 'Your First Name must contain a minimum of ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' characters.',true);
define('ENTRY_FIRST_NAME_TEXT', '',true);
define('ENTRY_LAST_NAME', 'Last Name',true);
define('ENTRY_LAST_NAME_ERROR', 'Your Last Name must contain a minimum of ' . ENTRY_LAST_NAME_MIN_LENGTH . ' characters.',true);
define('ENTRY_LAST_NAME_TEXT', '',true);
define('ENTRY_DATE_OF_BIRTH', 'Date of Birth',true);
define('ENTRY_DATE_OF_BIRTH_ERROR', 'Your Date of Birth must be in this format: MM/DD/YYYY (eg 05/21/1970)',true);
define('ENTRY_DATE_OF_BIRTH_TEXT', 'eg. 05/21/1970',true);
define('ENTRY_EMAIL_ADDRESS', 'E-Mail Address',true);
define('ENTRY_EMAIL_ADDRESS_ERROR', 'Your E-Mail Address must contain a minimum of ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' characters.',true);
define('ENTRY_EMAIL_ADDRESS_CHECK_ERROR', 'Your E-Mail Address does not appear to be valid - please make any necessary corrections.',true);
define('ENTRY_EMAIL_ADDRESS_ERROR_EXISTS', 'Your E-Mail Address already exists in our records - please log in with the e-mail address or create an account with a different address.',true);
define('ENTRY_EMAIL_ADDRESS_TEXT', '',true);
define('ENTRY_STREET_ADDRESS', 'Street Address',true);
define('ENTRY_STREET_ADDRESS_ERROR', 'Your Street Address must contain a minimum of ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' characters.',true);
define('ENTRY_STREET_ADDRESS_TEXT', '',true);
define('ENTRY_SUBURB', 'Suburb',true);
define('ENTRY_SUBURB_TEXT', '',true);
define('ENTRY_POST_CODE', 'Post Code',true);
define('ENTRY_POST_CODE_ERROR', 'Your Post Code must contain a minimum of ' . ENTRY_POSTCODE_MIN_LENGTH . ' characters.',true);
define('ENTRY_POST_CODE_TEXT', '',true);
define('ENTRY_CITY', 'City',true);
define('ENTRY_CITY_ERROR', 'Your City must contain a minimum of ' . ENTRY_CITY_MIN_LENGTH . ' characters.',true);
define('ENTRY_CITY_TEXT', '',true);
define('ENTRY_STATE', 'State/Province',true);
define('ENTRY_STATE_ERROR', 'Your State must contain a minimum of ' . ENTRY_STATE_MIN_LENGTH . ' characters.',true);
define('ENTRY_STATE_ERROR_SELECT', 'Please select a state from the States pull down menu.',true);
define('ENTRY_STATE_TEXT', '',true);
define('ENTRY_COUNTRY', 'Country',true);
define('ENTRY_COUNTRY_ERROR', 'You must select a country from the Countries pull down menu.',true);
define('ENTRY_COUNTRY_TEXT', '',true);
define('ENTRY_TELEPHONE_NUMBER', 'Telephone Number',true);
define('ENTRY_TELEPHONE_NUMBER_ERROR', 'Your Telephone Number must contain a minimum of ' . ENTRY_TELEPHONE_MIN_LENGTH . ' characters.',true);
define('ENTRY_TELEPHONE_NUMBER_TEXT', '',true);
define('ENTRY_FAX_NUMBER', 'Fax Number',true);
define('ENTRY_FAX_NUMBER_TEXT', '',true);
define('ENTRY_NEWSLETTER', 'Newsletter',true);
define('ENTRY_NEWSLETTER_TEXT', '',true);
define('ENTRY_NEWSLETTER_YES', 'Subscribed',true);
define('ENTRY_NEWSLETTER_NO', 'Unsubscribed',true);
define('ENTRY_PASSWORD', 'Password',true);
define('ENTRY_PASSWORD_ERROR', 'Your Password must contain a minimum of ' . ENTRY_PASSWORD_MIN_LENGTH . ' characters.',true);
define('ENTRY_PASSWORD_ERROR_NOT_MATCHING', 'The Password Confirmation must match your Password.',true);
define('ENTRY_PASSWORD_TEXT', '',true);
define('ENTRY_PASSWORD_CONFIRMATION', 'Password Confirmation',true);
define('ENTRY_PASSWORD_CONFIRMATION_TEXT', '',true);
define('ENTRY_PASSWORD_CURRENT', 'Current Password',true);
define('ENTRY_PASSWORD_CURRENT_TEXT', '',true);
define('ENTRY_PASSWORD_CURRENT_ERROR', 'Your Password must contain a minimum of ' . ENTRY_PASSWORD_MIN_LENGTH . ' characters.',true);
define('ENTRY_PASSWORD_NEW', 'New Password',true);
define('ENTRY_PASSWORD_NEW_TEXT', '',true);
define('ENTRY_PASSWORD_NEW_ERROR', 'Your new Password must contain a minimum of ' . ENTRY_PASSWORD_MIN_LENGTH . ' characters.',true);
define('ENTRY_PASSWORD_NEW_ERROR_NOT_MATCHING', 'The Password Confirmation must match your new Password.',true);
define('PASSWORD_HIDDEN', '--HIDDEN--',true);

// constants for use in tep_prev_next_display function
define('TEXT_RESULT_PAGE', 'Result Pages:',true);
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS', 'Displaying <strong>%d</strong> to <strong>%d</strong> (of <strong>%d</strong> products)',true);
define('TEXT_DISPLAY_NUMBER_OF_ORDERS', 'Displaying <strong>%d</strong> to <strong>%d</strong> (of <strong>%d</strong> orders)',true);
define('TEXT_DISPLAY_NUMBER_OF_REVIEWS', 'Displaying <strong>%d</strong> to <strong>%d</strong> (of <strong>%d</strong> reviews)',true);
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS_NEW', 'Displaying <strong>%d</strong> to <strong>%d</strong> (of <strong>%d</strong> new products)',true);
define('TEXT_DISPLAY_NUMBER_OF_SPECIALS', 'Displaying <strong>%d</strong> to <strong>%d</strong> (of <strong>%d</strong> specials)',true);

define('PREVNEXT_TITLE_FIRST_PAGE', 'First Page',true);
define('PREVNEXT_TITLE_PREVIOUS_PAGE', 'Previous Page',true);
define('PREVNEXT_TITLE_NEXT_PAGE', 'Next Page',true);
define('PREVNEXT_TITLE_LAST_PAGE', 'Last Page',true);
define('PREVNEXT_TITLE_PAGE_NO', 'Page %d',true);
define('PREVNEXT_TITLE_PREV_SET_OF_NO_PAGE', 'Previous Set of %d Pages',true);
define('PREVNEXT_TITLE_NEXT_SET_OF_NO_PAGE', 'Next Set of %d Pages',true);
define('PREVNEXT_BUTTON_FIRST', '&lt;&lt;FIRST',true);
define('PREVNEXT_BUTTON_PREV', '[&lt;&lt;&nbsp;Prev]',true);
define('PREVNEXT_BUTTON_NEXT', '[Next&nbsp;&gt;&gt;]',true);
define('PREVNEXT_BUTTON_LAST', 'LAST&gt;&gt;',true);

define('IMAGE_BUTTON_ADD_ADDRESS', 'Add Address',true);
define('IMAGE_BUTTON_ADDRESS_BOOK', 'Address Book',true);
define('IMAGE_BUTTON_BACK', 'Back',true);
define('IMAGE_BUTTON_BUY_NOW', 'Buy Now',true);
define('IMAGE_BUTTON_CHANGE_ADDRESS', 'Change Address',true);
define('IMAGE_BUTTON_CHECKOUT', 'Checkout',true);
define('IMAGE_BUTTON_CONFIRM_ORDER', 'Confirm Order',true);
define('IMAGE_BUTTON_CONTINUE', 'Continue',true);
define('IMAGE_BUTTON_CONTINUE_SHOPPING', 'Continue Shopping',true);
define('IMAGE_BUTTON_DELETE', 'Delete',true);
define('IMAGE_BUTTON_EDIT_ACCOUNT', 'Edit Account',true);
define('IMAGE_BUTTON_HISTORY', 'Order History',true);
define('IMAGE_BUTTON_LOGIN', 'Sign In',true);
define('IMAGE_BUTTON_IN_CART', 'Add to Cart',true);
define('IMAGE_BUTTON_NOTIFICATIONS', 'Notifications',true);
define('IMAGE_BUTTON_QUICK_FIND', 'Quick Find',true);
define('IMAGE_BUTTON_REMOVE_NOTIFICATIONS', 'Remove Notifications',true);
define('IMAGE_BUTTON_REVIEWS', 'Reviews',true);
define('IMAGE_BUTTON_SEARCH', 'Search',true);
define('IMAGE_BUTTON_SHIPPING_OPTIONS', 'Shipping Options',true);
define('IMAGE_BUTTON_TELL_A_FRIEND', 'Tell a Friend',true);
define('IMAGE_BUTTON_UPDATE', 'Update',true);
define('IMAGE_BUTTON_UPDATE_CART', 'Update Cart',true);
define('IMAGE_BUTTON_WRITE_REVIEW', 'Write Review',true);

define('SMALL_IMAGE_BUTTON_DELETE', 'Delete',true);
define('SMALL_IMAGE_BUTTON_EDIT', 'Edit',true);
define('SMALL_IMAGE_BUTTON_VIEW', 'View',true);
define('SMALL_IMAGE_BUTTON_BUY', 'Buy',true);

define('ICON_ARROW_RIGHT', 'more',true);
define('ICON_CART', 'In Cart',true);
define('ICON_ERROR', 'Error',true);
define('ICON_SUCCESS', 'Success',true);
define('ICON_WARNING', 'Warning',true);

define('TEXT_GREETING_PERSONAL', 'Welcome back <span class="greetUser">%s!</span> Would you like to see which <a href="%s"><u>new products</u></a> are available to purchase?',true);
define('TEXT_GREETING_PERSONAL_RELOGON', '<small>If you are not %s, please <a href="%s"><u>log yourself in</u></a> with your account information.</small>',true);
define('TEXT_GREETING_GUEST','',true); //Welcome <span class="greetUser">Guest!</span> Would you like to <a href="%s"><u>log yourself in</u></a>? Or would you prefer to <a href="%s"><u>create an account</u></a>?

define('TEXT_SORT_PRODUCTS', 'Sort products ',true);
define('TEXT_DESCENDINGLY', 'descendingly',true);
define('TEXT_ASCENDINGLY', 'ascendingly',true);
define('TEXT_BY', ' by ',true);

define('TEXT_REVIEW_BY', 'by %s',true);
define('TEXT_REVIEW_WORD_COUNT', '%s words',true);
define('TEXT_REVIEW_RATING', 'Rating: %s [%s]',true);
define('TEXT_REVIEW_DATE_ADDED', 'Date Added: %s',true);
define('TEXT_NO_REVIEWS', 'There are currently no product reviews.',true);

define('TEXT_NO_NEW_PRODUCTS', 'There are currently no products.',true);

define('TEXT_UNKNOWN_TAX_RATE', 'Unknown tax rate',true);

define('TEXT_REQUIRED', '<span class="errorText">Required</span>',true);

define('ERROR_TEP_MAIL', '<font face="Verdana, Arial" size="2" color="#ff0000"><strong><small>TEP ERROR:</small> Cannot send the email through the specified SMTP server. Please check your php.ini setting and correct the SMTP server if necessary.</strong></font>',true);

define('TEXT_CCVAL_ERROR_INVALID_DATE', 'The expiry date entered for the credit card is invalid. Please check the date and try again.',true);
define('TEXT_CCVAL_ERROR_INVALID_NUMBER', 'The credit card number entered is invalid. Please check the number and try again.',true);
define('TEXT_CCVAL_ERROR_UNKNOWN_CARD', 'The first four digits of the number entered are: %s. If that number is correct, we do not accept that type of credit card. If it is wrong, please try again.',true);

// category views
define('TEXT_VIEW', 'View: ',true);
define('TEXT_VIEW_LIST', ' List',true);
define('TEXT_VIEW_GRID', ' Grid',true);

// search placeholder
define('TEXT_SEARCH_PLACEHOLDER','Search',true);

// message for required inputs
define('FORM_REQUIRED_INFORMATION', '<span class="fa fa-asterisk inputRequirement"></span> Required information',true);
define('FORM_REQUIRED_INPUT', '<span><span class="fa fa-asterisk form-control-feedback inputRequirement"></span></span>',true);

// reviews
define('REVIEWS_TEXT_RATED', 'Rated %s by <cite title="%s" itemprop="reviewer">%s</cite>',true);
define('REVIEWS_TEXT_AVERAGE', 'Average rating based on <span itemprop="count">%s</span> review(s) %s',true);
define('REVIEWS_TEXT_TITLE', 'What our customers say...',true);

// grid/list
define('TEXT_SORT_BY', 'Sort By ',true);
// moved from index
define('TABLE_HEADING_IMAGE', '',true);
define('TABLE_HEADING_MODEL', 'Model',true);
define('TABLE_HEADING_PRODUCTS', 'Product Name',true);
define('TABLE_HEADING_MANUFACTURER', 'Manufacturer',true);
define('TABLE_HEADING_QUANTITY', 'Quantity',true);
define('TABLE_HEADING_PRICE', 'Price',true);
define('TABLE_HEADING_WEIGHT', 'Weight',true);
define('TABLE_HEADING_BUY_NOW', 'Buy Now',true);
//define('TABLE_HEADING_LATEST_ADDED', 'Latest Products',true);
define('TABLE_HEADING_DATE_AVAILABLE','Latest Products',true);
define('TABLE_HEADING_CUSTOM_DATE','Evet\'s Date',true);
define('TABLE_HEADING_SORT_ORDER','Sort Order',true);


// product notifications
define('PRODUCT_SUBSCRIBED', '%s has been added to your Notification List',true);
define('PRODUCT_UNSUBSCRIBED', '%s has been removed from your Notification List',true);
define('PRODUCT_ADDED', '%s has been added to your Cart',true);
define('PRODUCT_REMOVED', '%s has been removed from your Cart',true);

// bootstrap helper
define('MODULE_CONTENT_BOOTSTRAP_ROW_DESCRIPTION', '',true);

// sorting product_listing module
define('TEXT_SORT_BY', 'Sort By ',true);

/*
************************************************************************
************** Custom Filenames can be defined below here **************
**************               Raymond Burns                **************
************************************************************************
*/
// SEO Header Tags Reloaded
  //header titles
define('HEADER_CART_CONTENTS', '<i class="glyphicon glyphicon-shopping-cart"></i> %s item(s) <span class="caret"></span>',true);
define('HEADER_CART_NO_CONTENTS', '<i class="glyphicon glyphicon-shopping-cart"></i> 0 items',true); //pure:static version needed clickable statc cart if you go back to generated page - no idea about cart contents
define('HEADER_ACCOUNT_LOGGED_OUT', '<i class="glyphicon glyphicon-user"></i><span class="hidden-sm"> My Account</span> <span class="caret"></span>',true);
define('HEADER_ACCOUNT_LOGGED_IN', '<i class="glyphicon glyphicon-user"></i> %s <span class="caret"></span>',true);
define('HEADER_SITE_SETTINGS', '<i class="glyphicon glyphicon-cog"></i><span class="hidden-sm"> Site Settings</span> <span class="caret"></span>',true);
define('HEADER_TOGGLE_NAV', 'Toggle Navigation',true);
define('HEADER_HOME', '<i class="glyphicon glyphicon-home"></i><span class="hidden-sm"> Home</span>',true);
define('HEADER_WHATS_NEW', '<i class="glyphicon glyphicon-certificate"></i><span class="hidden-sm">  New Products</span>',true);
define('HEADER_SPECIALS', '<i class="glyphicon glyphicon-fire"></i><span class="hidden-sm"> Special Offers</span>',true);
define('HEADER_REVIEWS', '<i class="glyphicon glyphicon-comment"></i><span class="hidden-sm"> Reviews</span>',true);
// header dropdowns
define('HEADER_ACCOUNT_LOGIN', '<i class="glyphicon glyphicon-log-in"></i> Log In',true);
define('HEADER_ACCOUNT_LOGOFF', '<i class="glyphicon glyphicon-log-out"></i> Log Off',true);
define('HEADER_ACCOUNT', 'My Account',true);
define('HEADER_ACCOUNT_HISTORY', 'My Orders',true);
define('HEADER_ACCOUNT_EDIT', 'My Details',true);
define('HEADER_ACCOUNT_ADDRESS_BOOK', 'My Address Book',true);
define('HEADER_ACCOUNT_PASSWORD', 'My Password',true);
define('HEADER_ACCOUNT_REGISTER', '<i class="glyphicon glyphicon-pencil"></i> Register',true);
define('HEADER_CART_HAS_CONTENTS', '%s item(s), %s',true);
define('HEADER_CART_VIEW_CART', 'View Cart',true);
define('HEADER_CART_CHECKOUT', '<i class="glyphicon glyphicon-chevron-right"></i> Checkout',true);
define('USER_LOCALIZATION', '<abbr title="Selected Language">L:</abbr> %s <abbr title="Selected Currency">C:</abbr> %s',true);

// CCGV
  define('VOUCHER_BALANCE', 'Voucher Balance',true);
  define('BOX_HEADING_GIFT_VOUCHER', 'Gift Voucher Account',true);
  define('GV_FAQ', 'Gift Voucher FAQ',true);
  define('IMAGE_REDEEM_VOUCHER', 'Redeem',true);
  define('ERROR_REDEEMED_AMOUNT', 'Congratulations, you have redeemed ',true);
  define('ERROR_NO_REDEEM_CODE', 'You did not enter a redeem code.',true);
  define('ERROR_NO_INVALID_REDEEM_GV', 'Invalid Gift Voucher Code',true);
  define('TABLE_HEADING_CREDIT', 'Discount Coupon',true);
  define('GV_HAS_VOUCHERA', 'You have funds in your Gift Voucher Account. If you want <br>                           you can send those funds by <a class="pageResults" href="',true);
  define('GV_HAS_VOUCHERB', '"><b>email</b></a> to someone',true);
  define('ENTRY_AMOUNT_CHECK_ERROR', 'You do not have enough funds to send this amount.',true);
  define('BOX_SEND_TO_FRIEND', 'Send Gift Voucher',true);
  define('VOUCHER_REDEEMED', 'Voucher Redeemed',true);
  define('CART_COUPON', 'Coupon :',true);
  define('CART_COUPON_INFO', 'more info',true);
// MailManager
  define('BOX_HEADING_MAIL_MANAGER', 'Mail Manager',true);
  define('BOX_MM_BULKMAIL', 'BulkMail Manager',true);
  define('BOX_MM_TEMPLATES', 'Template Manager',true);
  define('BOX_MM_EMAIL', 'Send Email',true);
  define('BOX_MM_RESPONSEMAIL', 'Response Mail',true);
//pure:new link to advanced search
  define('IMAGE_BUTTON_ADVANCED_SEARCH_LINK','advanced',true);
//VAT numbber
define('ENTRY_VAT_NUMBER', 'VAT Number:',true);
define('ENTRY_VAT_NUMBER_TEXT_2', '',true);
define('ENTRY_COMPANY_NUMBER', 'COMPANY ID:',true);
define('ENTRY_COMPANY_NUMBER_TEXT_2', '',true);

