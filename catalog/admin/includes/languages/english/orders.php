<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce
    
  Edited by 2014 Newburns Design and Technology
  *************************************************
  ************ New addon definitions **************
  ************        Below          **************
  *************************************************
  Mail Manager added -- http://addons.oscommerce.com/info/9133/v,23
  Purchase Without Account (PWA) -- http://addons.oscommerce.com/info/9142

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Orders',true);
define('HEADING_TITLE_SEARCH', 'Order ID:',true);
define('HEADING_TITLE_STATUS', 'Status:',true);

define('TABLE_HEADING_COMMENTS', 'Comments',true);
define('TABLE_HEADING_CUSTOMERS', 'Customers',true);
define('TABLE_HEADING_ORDER_TOTAL', 'Order Total',true);
define('TABLE_HEADING_DATE_PURCHASED', 'Date Purchased',true);
define('TABLE_HEADING_STATUS', 'Status',true);
define('TABLE_HEADING_ACTION', 'Action',true);
define('TABLE_HEADING_QUANTITY', 'Qty.',true);
define('TABLE_HEADING_PRODUCTS_MODEL', 'Model',true);
define('TABLE_HEADING_PRODUCTS', 'Products',true);
define('TABLE_HEADING_TAX', 'Tax',true);
define('TABLE_HEADING_TOTAL', 'Total',true);
define('TABLE_HEADING_PRICE_EXCLUDING_TAX', 'Price (ex)',true);
define('TABLE_HEADING_PRICE_INCLUDING_TAX', 'Price (inc)',true);
define('TABLE_HEADING_TOTAL_EXCLUDING_TAX', 'Total (ex)',true);
define('TABLE_HEADING_TOTAL_INCLUDING_TAX', 'Total (inc)',true);

define('TABLE_HEADING_CUSTOMER_NOTIFIED', 'Customer Notified',true);
define('TABLE_HEADING_DATE_ADDED', 'Date Added',true);

define('ENTRY_CUSTOMER', 'Customer:',true);
define('ENTRY_SOLD_TO', 'SOLD TO:',true);
define('ENTRY_DELIVERY_TO', 'Delivery To:',true);
define('ENTRY_SHIP_TO', 'SHIP TO:',true);
define('ENTRY_SHIPPING_ADDRESS', 'Shipping Address:',true);
define('ENTRY_BILLING_ADDRESS', 'Billing Address:',true);
define('ENTRY_PAYMENT_METHOD', 'Payment Method:',true);
define('ENTRY_CREDIT_CARD_TYPE', 'Credit Card Type:',true);
define('ENTRY_CREDIT_CARD_OWNER', 'Credit Card Owner:',true);
define('ENTRY_CREDIT_CARD_NUMBER', 'Credit Card Number:',true);
define('ENTRY_CREDIT_CARD_EXPIRES', 'Credit Card Expires:',true);
define('ENTRY_SUB_TOTAL', 'Sub-Total:',true);
define('ENTRY_TAX', 'Tax:',true);
define('ENTRY_SHIPPING', 'Shipping:',true);
define('ENTRY_TOTAL', 'Total:',true);
define('ENTRY_DATE_PURCHASED', 'Date Purchased:',true);
define('ENTRY_STATUS', 'Status:',true);
define('ENTRY_DATE_LAST_UPDATED', 'Date Last Updated:',true);
define('ENTRY_NOTIFY_CUSTOMER', 'Notify Customer:',true);
define('ENTRY_NOTIFY_COMMENTS', 'Append Comments:',true);
define('ENTRY_PRINTABLE', 'Print Invoice',true);

define('TEXT_INFO_HEADING_DELETE_ORDER', 'Delete Order',true);
define('TEXT_INFO_DELETE_INTRO', 'Are you sure you want to delete this order?',true);
define('TEXT_INFO_RESTOCK_PRODUCT_QUANTITY', 'Restock product quantity',true);
define('TEXT_DATE_ORDER_CREATED', 'Date Created:',true);
define('TEXT_DATE_ORDER_LAST_MODIFIED', 'Last Modified:',true);
define('TEXT_INFO_PAYMENT_METHOD', 'Payment Method:',true);

define('TEXT_ALL_ORDERS', 'All Orders',true);
define('TEXT_NO_ORDER_HISTORY', 'No Order History Available',true);

define('EMAIL_SEPARATOR', '------------------------------------------------------',true);
define('EMAIL_TEXT_SUBJECT', 'Order Update',true);
define('EMAIL_TEXT_ORDER_NUMBER', 'Order Number:',true);
define('EMAIL_TEXT_INVOICE_URL', 'Detailed Invoice:',true);
define('EMAIL_TEXT_DATE_ORDERED', 'Date Ordered:',true);
define('EMAIL_TEXT_STATUS_UPDATE', 'Your order has been updated to the following status.' . "\n\n" . 'New status: %s' . "\n\n" . 'Please reply to this email if you have any questions.' . "\n");
define('EMAIL_TEXT_COMMENTS_UPDATE', 'The comments for your order are' . "\n\n%s\n\n");

define('ERROR_ORDER_DOES_NOT_EXIST', 'Error: Order does not exist.',true);
define('SUCCESS_ORDER_UPDATED', 'Success: Order has been successfully updated.',true);
define('WARNING_ORDER_NOT_UPDATED', 'Warning: Nothing to change. The order was not updated.',true);

/*
************************************************************************
************** Custom Filenames can be defined below here **************
**************               Raymond Burns                **************
************************************************************************
*/
// Mail Manager
  define('EMAIL_HTML_STATUS_UPDATE','Your order has been updated to: ',true);
  
// Purchase Without Account
  define('GUEST', 'Guest',true);