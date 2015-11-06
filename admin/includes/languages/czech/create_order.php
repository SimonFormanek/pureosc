<?php
/*
  $Id: create_order.php,v 1 2003/08/17 23:21:34 frankl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
  
*/

// pull down default text
define('PULL_DOWN_DEFAULT', 'Please Select',true);
define('TYPE_BELOW', 'Type Below',true);

define('JS_ERROR', 'Errors have occured during the process of your form!\nPlease make the following corrections:\n\n',true);

define('JS_GENDER', '* The \'Gender\' value must be chosen.\n',true);
define('JS_FIRST_NAME', '* The \'First Name\' entry must have at least ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' characters.\n',true);
define('JS_LAST_NAME', '* The \'Last Name\' entry must have at least ' . ENTRY_LAST_NAME_MIN_LENGTH . ' characters.\n',true);
define('JS_DOB', '* The \'Date of Birth\' entry must be in the format: xx/xx/xxxx (month/day/year).\n',true);
define('JS_EMAIL_ADDRESS', '* The \'E-Mail Address\' entry must have at least ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' characters.\n',true);
define('JS_ADDRESS', '* The \'Street Address\' entry must have at least ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' characters.\n',true);
define('JS_POST_CODE', '* The \'Post Code\' entry must have at least ' . ENTRY_POSTCODE_MIN_LENGTH . ' characters.\n',true);
define('JS_CITY', '* The \'Suburb\' entry must have at least ' . ENTRY_CITY_MIN_LENGTH . ' characters.\n',true);
define('JS_STATE', '* The \'State\' must be entered.\n',true);
define('JS_STATE_SELECT', '-- Select Above --',true);
define('JS_ZONE', '* The \'State\' entry must be selected from the list for this country.\n',true);
define('JS_COUNTRY', '* The \'Country\' entry must be selected.\n',true);
define('JS_TELEPHONE', '* The \'Telephone Number\' entry must have at least ' . ENTRY_TELEPHONE_MIN_LENGTH . ' characters.\n',true);
define('JS_PASSWORD', '* The \'Password\' entry must have at least ' . ENTRY_PASSWORD_MIN_LENGTH . ' characters.\n',true);

define('CATEGORY_COMPANY', 'Company Details',true);
define('CATEGORY_PERSONAL', 'Personal Details',true);
define('CATEGORY_ADDRESS', 'Address',true);
define('CATEGORY_CONTACT', 'Contact Information',true);
define('CATEGORY_OPTIONS', 'Options',true);
define('CATEGORY_PASSWORD', 'Password',true);
define('CATEGORY_CORRECT', 'If this is the right customer, press the Confirm button below.',true);
define('ENTRY_CUSTOMERS_ID', 'Customer ID:',true);
define('ENTRY_CUSTOMERS_ID_TEXT', '&nbsp;',true);
define('ENTRY_COMPANY', 'Company Name:',true);
define('ENTRY_COMPANY_ERROR', '',true);
define('ENTRY_COMPANY_TEXT', '',true);
define('ENTRY_GENDER', 'Gender:',true);
define('ENTRY_GENDER_FEMALE', 'Female',true);
define('ENTRY_GENDER_MALE', 'Male',true);
define('ENTRY_GENDER_ERROR', '&nbsp;',true);
define('ENTRY_GENDER_TEXT', '&nbsp;',true);
define('ENTRY_FIRST_NAME', 'First Name:',true);
define('ENTRY_FIRST_NAME_ERROR', '&nbsp;<small><font color="#FF0000">min ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' chars</font></small>',true);
define('ENTRY_FIRST_NAME_TEXT', '&nbsp;',true);
define('ENTRY_LAST_NAME', 'Last Name:',true);
define('ENTRY_LAST_NAME_ERROR', '&nbsp;<small><font color="#FF0000">min ' . ENTRY_LAST_NAME_MIN_LENGTH . ' chars</font></small>',true);
define('ENTRY_LAST_NAME_TEXT', '&nbsp;',true);
define('ENTRY_DATE_OF_BIRTH', 'Date of Birth:',true);
define('ENTRY_DATE_OF_BIRTH_ERROR', '&nbsp;<small><font color="#FF0000">(eg. 05/21/1970)</font></small>',true);
define('ENTRY_DATE_OF_BIRTH_TEXT', '&nbsp;<small>(eg. 05/21/1970) ',true);
define('ENTRY_EMAIL_ADDRESS', 'E-Mail Address:',true);
define('ENTRY_EMAIL_ADDRESS_ERROR', '&nbsp;<small><font color="#FF0000">min ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' chars</font></small>',true);
define('ENTRY_EMAIL_ADDRESS_CHECK_ERROR', '&nbsp;<small><font color="#FF0000">Your email address doesn\'t appear to be valid!</font></small>',true);
define('ENTRY_EMAIL_ADDRESS_ERROR_EXISTS', '&nbsp;<small><font color="#FF0000">email address already exists!</font></small>',true);
define('ENTRY_EMAIL_ADDRESS_TEXT', '&nbsp;',true);
define('ENTRY_STREET_ADDRESS', 'Street Address:',true);
define('ENTRY_STREET_ADDRESS_ERROR', '&nbsp;<small><font color="#FF0000">min ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' chars</font></small>',true);
define('ENTRY_STREET_ADDRESS_TEXT', '&nbsp;',true);
define('ENTRY_SUBURB', 'Suburb:',true);
define('ENTRY_SUBURB_ERROR', '',true);
define('ENTRY_SUBURB_TEXT', '',true);
define('ENTRY_POST_CODE', 'Post Code:',true);
define('ENTRY_POST_CODE_ERROR', '&nbsp;<small><font color="#FF0000">min ' . ENTRY_POSTCODE_MIN_LENGTH . ' chars</font></small>',true);
define('ENTRY_POST_CODE_TEXT', '&nbsp;',true);
define('ENTRY_CITY', 'Suburb:',true);
define('ENTRY_CITY_ERROR', '&nbsp;<small><font color="#FF0000">min ' . ENTRY_CITY_MIN_LENGTH . ' chars</font></small>',true);
define('ENTRY_CITY_TEXT', '&nbsp;',true);
define('ENTRY_STATE', 'State/Province:',true);
define('ENTRY_STATE_ERROR', '&nbsp;',true);
define('ENTRY_STATE_TEXT', '&nbsp;',true);
define('ENTRY_COUNTRY', 'Country:',true);
define('ENTRY_COUNTRY_ERROR', '',true);
define('ENTRY_COUNTRY_TEXT', '&nbsp;',true);
define('ENTRY_TELEPHONE_NUMBER', 'Telephone Number:',true);
define('ENTRY_TELEPHONE_NUMBER_ERROR', '&nbsp;<small><font color="#FF0000">min ' . ENTRY_TELEPHONE_MIN_LENGTH . ' chars</font></small>',true);
define('ENTRY_TELEPHONE_NUMBER_TEXT', '&nbsp;',true);
define('ENTRY_FAX_NUMBER', 'Fax Number:',true);
define('ENTRY_FAX_NUMBER_ERROR', '',true);
define('ENTRY_FAX_NUMBER_TEXT', '',true);
define('ENTRY_NEWSLETTER', 'Newsletter:',true);
define('ENTRY_NEWSLETTER_TEXT', '',true);
define('ENTRY_NEWSLETTER_YES', 'Subscribed',true);
define('ENTRY_NEWSLETTER_NO', 'Unsubscribed',true);
define('ENTRY_NEWSLETTER_ERROR', '',true);
define('ENTRY_PASSWORD', 'Password:',true);
define('ENTRY_PASSWORD_CONFIRMATION', 'Password Confirmation:',true);
define('ENTRY_PASSWORD_CONFIRMATION_TEXT', '&nbsp;',true);
define('ENTRY_PASSWORD_ERROR', '&nbsp;<small><font color="#FF0000">min ' . ENTRY_PASSWORD_MIN_LENGTH . ' chars</font></small>',true);
define('ENTRY_PASSWORD_TEXT', '&nbsp;',true);
define('PASSWORD_HIDDEN', '--HIDDEN--',true);

define('CREATE_ORDER_TEXT_EXISTING_CUST', 'Existing Customer Account',true);
define('CREATE_ORDER_TEXT_NEW_CUST', 'New Customer Account',true);
define('CREATE_ORDER_TEXT_NO_CUST', 'Without Customer Account',true);

define('HEADING_TITLE', 'New Order',true);
define('TEXT_SELECT_CUST', '- Select a Customer -',true); 
define('TEXT_SELECT_CURRENCY', '- Select a Currency -',true);
define('TEXT_SELECT_CURRENCY_TITLE', 'Select a Currency',true);
define('BUTTON_TEXT_SELECT_CUST', 'Select a customer:',true); 
define('TEXT_OR_BY', 'or select by customer ID:',true); 
define('TEXT_STEP_1', 'Step 1 - Choose a customer to prefill the form or choose another option and enter custom details.',true);
define('TEXT_STEP_2', 'Step 2 - Confirm existing customer account details or enter new customer/shipping/billing details.',true);
define('BUTTON_SUBMIT', 'Select',true);
define('ENTRY_CURRENCY','Currency: ',true);
define('ENTRY_ADMIN','Order Entered By:',true);
define('TEXT_CS','Customer Service',true);

define('ACCOUNT_EXTRAS','Account Extras',true);
define('ENTRY_ACCOUNT_PASSWORD','Password',true);
define('ENTRY_NEWSLETTER_SUBSCRIBE','Newsletter',true);
define('ENTRY_ACCOUNT_PASSWORD_TEXT','',true);
define('ENTRY_NEWSLETTER_SUBSCRIBE_TEXT','1 => Yes, 0 => No',true);


?>