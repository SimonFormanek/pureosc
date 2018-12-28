<?php
/*
  $Id: coupon_admin.php Exp $
  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com
  Copyright (c) 2002 osCommerce
  Released under the GNU General Public License
 */
define('TOP_BAR_TITLE', 'Statistics', true);
define('HEADING_TITLE', 'Discount Coupons', true);
define('HEADING_TITLE_STATUS', 'Status : ', true);
define('TEXT_CUSTOMER', 'Customer:', true);
define('TEXT_COUPON', 'Coupon Name', true);
define('TEXT_COUPON_ALL', 'All Coupons', true);
define('TEXT_COUPON_STATUS', 'Coupon Status', true);
define('TEXT_COUPON_ACTIVE', 'Active Coupons', true);
define('TEXT_COUPON_IS_ACTIVE', 'Active', true);
define('TEXT_COUPON_NOT_ACTIVE', 'Inactive', true);
define('TEXT_COUPON_INACTIVE', 'Inactive Coupons', true);
define('TEXT_SUBJECT', 'Subject:', true);
define('TEXT_FROM', 'From:', true);
define('TEXT_FREE_SHIPPING', 'Free Shipping', true);
define('TEXT_MESSAGE', 'Message:', true);
define('TEXT_SELECT_CUSTOMER', 'Select Customer', true);
define('TEXT_ALL_CUSTOMERS', 'All Customers', true);
define('TEXT_NEWSLETTER_CUSTOMERS', 'To All Newsletter Subscribers', true);
define('TEXT_CONFIRM_DELETE',
    'Are you sure you want to delete this Coupon? Deleting this coupon will delete it completely from the database.',
    true);
// email discount vouchers to customers text
define('TEXT_TO_REDEEM',
    'You can redeem this coupon during checkout. Just enter the code in the box provided, and click on the redeem button.',
    true);
define('TEXT_IN_CASE', ' in case you have any problems. ', true);
define('TEXT_VOUCHER_IS', 'The coupon code is ', true);
define('TEXT_REMEMBER',
    'Don\'t lose the coupon code, make sure to keep the code safe so you can benefit from this special offer.',
    true);
define('TEXT_VISIT', 'when you visit '.HTTP_SERVER.DIR_WS_CATALOG);
define('TEXT_ENTER_CODE', ' and enter the code ', true);
define('TEXT_SIGN_OFF', 'Kind Regards'."\n\n".''.STORE_NAME.'', true);
define('TABLE_HEADING_ACTION', 'Action', true);
define('CUSTOMER_ID', 'Customer id', true);
define('CUSTOMER_NAME', 'Customer Name', true);
define('REDEEM_DATE', 'Date Redeemed', true);
define('IP_ADDRESS', 'IP Address', true);
define('COUPON_BUTTON_PREVIEW', 'Preview', true);
define('TEXT_REDEMPTIONS', 'Redemptions', true);
define('TEXT_REDEMPTIONS_TOTAL', 'In Total', true);
define('TEXT_REDEMPTIONS_CUSTOMER', 'For this Customer', true);
define('TEXT_NO_FREE_SHIPPING', 'No Free Shipping', true);
define('NOTICE_EMAIL_SENT_TO', 'Notice: Email sent to: %s', true);
define('ERROR_NO_CUSTOMER_SELECTED', 'Error: No customer has been selected.',
    true);
define('COUPON_INFO', 'Coupon Information', true);
define('COUPON_DELETE', 'Delete Coupon', true);
define('COUPON_ID', 'Coupon ID', true);
define('COUPON_NAME', 'Coupon Name', true);
define('COUPON_TYPE', 'Coupon Type', true);
define('COUPON_AMOUNT', 'Coupon Amount', true);
define('COUPON_CODE', 'Coupon Code', true);
define('COUPON_STARTDATE', 'Start Date', true);
define('COUPON_FINISHDATE', 'Expiry Date', true);
define('COUPON_FREE_SHIP', 'Free Shipping', true);
define('COUPON_DESC', 'Coupon Description', true);
define('COUPON_MIN_ORDER', 'Coupon Minimum Order', true);
define('COUPON_USES_COUPON', 'Uses per Coupon', true);
define('COUPON_USES_USER', 'Uses per Customer', true);
define('COUPON_PRODUCTS', 'Valid Product List', true);
define('COUPON_CATEGORIES', 'Valid Categories List', true);
define('VOUCHER_NUMBER_USED', 'Number Used', true);
define('DATE_CREATED', 'Date Created', true);
define('DATE_MODIFIED', 'Date Modified', true);
define('TEXT_HEADING_NEW_COUPON', 'Create New Coupon', true);
define('ERROR_NO_COUPON_AMOUNT',
    'No Coupon Created. Please complete the fields below', true);
define('COUPON_STATUS_HELP', 'Set the status of the coupon', true);
define('COUPON_NAME_HELP', 'A short name for the coupon', true);
define('COUPON_AMOUNT_HELP',
    'The value of the discount for the coupon, either fixed or add a % on the end for a percentage discount.',
    true);
define('COUPON_CODE_HELP',
    'You can enter your own code here, or leave blank for an auto generated one.',
    true);
define('COUPON_STARTDATE_HELP', 'The date the coupon will be valid from', true);
define('COUPON_FINISHDATE_HELP', 'The date the coupon expires', true);
define('COUPON_FREE_SHIP_HELP',
    'The coupon gives free shipping on an order. Note. This overrides the coupon_amount figure but respects the minimum order value',
    true);
define('COUPON_DESC_HELP', 'A description of the coupon for the customer', true);
define('COUPON_MIN_ORDER_HELP',
    'The minimum order value before the coupon is valid', true);
define('COUPON_USES_COUPON_HELP',
    'The maximum number of times the coupon can be used, leave blank if you want no limit.',
    true);
define('COUPON_USES_USER_HELP',
    'Number of times a user can use the coupon, leave blank for no limit.', true);
define('COUPON_PRODUCTS_HELP',
    'A comma separated list of product_ids that this coupon can be used with. Leave blank for no restrictions.',
    true);
define('COUPON_CATEGORIES_HELP',
    'A comma separated list of cpaths that this coupon can be used with, leave blank for no restrictions.',
    true);
?>