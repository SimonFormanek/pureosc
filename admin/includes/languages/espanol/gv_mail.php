<?php
/*
  $Id: gv_mail.php,v 1.5.2.2 2003/04/27 12:36:00 wilt Exp $
  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com
  Copyright (c) 2002 osCommerce
  Released under the GNU General Public License
*/
define('HEADING_TITLE', 'Send Gift Voucher To Customers',true);
define('TEXT_CUSTOMER', 'Customer:',true);
define('TEXT_SUBJECT', 'Subject:',true);
define('TEXT_FROM', 'From:',true);
define('TEXT_TO', 'Email To:',true);
define('TEXT_AMOUNT', 'Amount',true);
define('TEXT_MESSAGE', 'Message:',true);
define('TEXT_SINGLE_EMAIL', '<span class="smallText">Use this for sending single emails, otherwise use dropdown above</span>',true);
define('TEXT_SELECT_CUSTOMER', 'Select Customer',true);
define('TEXT_ALL_CUSTOMERS', 'All Customers',true);
define('TEXT_NEWSLETTER_CUSTOMERS', 'To All Newsletter Subscribers',true);
define('NOTICE_EMAIL_SENT_TO', 'Notice: Email sent to: %s',true);
define('ERROR_NO_CUSTOMER_SELECTED', 'Error: No customer has been selected.',true);
define('ERROR_NO_AMOUNT_SELECTED', 'Error: No amount has been selected.',true);
define('TEXT_GV_WORTH', 'The Gift Voucher is worth ',true);
define('TEXT_TO_REDEEM', 'To redeem this Gift Voucher, please click on the link below. Please also write down the redemption code',true);
define('TEXT_WHICH_IS', ' which is ',true);
define('TEXT_IN_CASE', ' in case you have any problems.',true);
define('TEXT_OR_VISIT', ' or visit ',true);
define('TEXT_ENTER_CODE', ' and enter the code during the checkout process',true);
define('TEXT_SIGN_OFF', 'Kind Regards' . "\n\n" . '' . STORE_NAME .'',true);
define ('TEXT_REDEEM_COUPON_MESSAGE_HEADER', 'You recently purchased a Gift Voucher from our site, for security reasons, the amount of the Gift Voucher was not immediately credited to you. The shop owner has now released this amount.',true);
define ('TEXT_REDEEM_COUPON_MESSAGE_AMOUNT', "\n\n" . 'The value of the Gift Voucher was %s',true);
define ('TEXT_REDEEM_COUPON_MESSAGE_BODY', "\n\n" . 'You can now visit our site, login and send the Gift Voucher amount to anyone you want.',true);
define ('TEXT_REDEEM_COUPON_MESSAGE_FOOTER', "\n\n");
?>