<?php
/*
  $Id: edit_orders.php v5.0 08/05/2007 djmonkey1 Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2007 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Edit Order #%s of %s',true);
define('ADDING_TITLE', 'Adding product(s) to Order #%s',true);

define('ENTRY_UPDATE_TO_CC', '(Update to ' . ORDER_EDITOR_CREDIT_CARD . ' to view CC fields.)',true);
define('TABLE_HEADING_COMMENTS', 'Comments',true);
define('TABLE_HEADING_STATUS', 'Status',true);
define('TABLE_HEADING_NEW_STATUS', 'New status',true);
define('TABLE_HEADING_ACTION', 'Action',true);
define('TABLE_HEADING_DELETE', 'Delete?',true);
define('TABLE_HEADING_QUANTITY', 'Qty.',true);
define('TABLE_HEADING_PRODUCTS_MODEL', 'Model',true);
define('TABLE_HEADING_PRODUCTS', 'Products',true);
define('TABLE_HEADING_TAX', 'Tax',true);
define('TABLE_HEADING_TOTAL', 'Total',true);
define('TABLE_HEADING_BASE_PRICE', 'Price<br>(base)',true);
define('TABLE_HEADING_UNIT_PRICE', 'Price<br>(excl.)',true);
define('TABLE_HEADING_UNIT_PRICE_TAXED', 'Price<br>(incl.)',true);
define('TABLE_HEADING_TOTAL_PRICE', 'Total<br>(excl.)',true);
define('TABLE_HEADING_TOTAL_PRICE_TAXED', 'Total<br>(incl.)',true);
define('TABLE_HEADING_OT_TOTALS', 'Order Totals:',true);
define('TABLE_HEADING_OT_VALUES', 'Value:',true);
define('TABLE_HEADING_SHIPPING_QUOTES', 'Shipping Quotes:',true);
define('TABLE_HEADING_NO_SHIPPING_QUOTES', 'There are no shipping quotes to display!',true);

define('TABLE_HEADING_CUSTOMER_NOTIFIED', 'Customer<br>Notified',true);
define('TABLE_HEADING_DATE_ADDED', 'Date Added',true);

define('ENTRY_CUSTOMER', 'Customer',true);
define('ENTRY_NAME', 'Name:',true);
define('ENTRY_CITY_STATE', 'City, State:',true);
define('ENTRY_SHIPPING_ADDRESS', 'Shipping Address',true);
define('ENTRY_BILLING_ADDRESS', 'Billing Address',true);
define('ENTRY_PAYMENT_METHOD', 'Payment Method',true);
define('ENTRY_CREDIT_CARD_TYPE', 'Card Type:',true);
define('ENTRY_CREDIT_CARD_OWNER', 'Card Owner:',true);
define('ENTRY_CREDIT_CARD_NUMBER', 'Card Number:',true);
define('ENTRY_CREDIT_CARD_EXPIRES', 'Card Expires:',true);
define('ENTRY_SUB_TOTAL', 'Sub-Total:',true);
define('ENTRY_TYPE_BELOW', 'Type below',true);

//the definition of ENTRY_TAX is important when dealing with certain tax components and scenarios
define('ENTRY_TAX', 'Tax',true);
//do not use a colon (:) in the defintion, ie 'VAT' is ok, but 'VAT:' is not

define('ENTRY_SHIPPING', 'Shipping:',true);
define('ENTRY_TOTAL', 'Total:',true);
define('ENTRY_STATUS', 'Status:',true);
define('ENTRY_NOTIFY_CUSTOMER', 'Notify Customer:',true);
define('ENTRY_NOTIFY_COMMENTS', 'Send Comments:',true);
define('ENTRY_CURRENCY_TYPE', 'Currency',true);
define('ENTRY_CURRENCY_VALUE', 'Currency Value',true);

define('TEXT_INFO_PAYMENT_METHOD', 'Payment Method:',true);
define('TEXT_NO_ORDER_PRODUCTS', 'This order contains no products',true);
define('TEXT_ADD_NEW_PRODUCT', 'Add products',true);
define('TEXT_PACKAGE_WEIGHT_COUNT', 'Package Weight: %s  |  Product Qty: %s',true);

define('TEXT_STEP_1', '<b>Step 1:</b>',true);
define('TEXT_STEP_2', '<b>Step 2:</b>',true);
define('TEXT_STEP_3', '<b>Step 3:</b>',true);
define('TEXT_STEP_4', '<b>Step 4:</b>',true);
define('TEXT_SELECT_CATEGORY', '- Choose a Category from the list -',true);
define('TEXT_PRODUCT_SEARCH', '<b>- OR enter a search term in the box below to see potential matches -</b>',true);
define('TEXT_ALL_CATEGORIES', 'All Categories/All Products',true);
define('TEXT_SELECT_PRODUCT', '- Choose a Product -',true);
define('TEXT_BUTTON_SELECT_OPTIONS', 'Select These Options',true);
define('TEXT_BUTTON_SELECT_CATEGORY', 'Select This Category',true);
define('TEXT_BUTTON_SELECT_PRODUCT', 'Select This Product',true);
define('TEXT_SKIP_NO_OPTIONS', '<em>No Options - Skipped...</em>',true);
define('TEXT_QUANTITY', 'Quantity:',true);
define('TEXT_BUTTON_ADD_PRODUCT', 'Add to Order',true);
define('TEXT_CLOSE_POPUP', '<u>Close</u> [x]',true);
define('TEXT_ADD_PRODUCT_INSTRUCTIONS', 'Keep adding products until you are done.<br>Then close this tab/window, return to the main tab/window, and press the "update" button.',true);
define('TEXT_PRODUCT_NOT_FOUND', '<b>Product not found<b>',true);
define('TEXT_SHIPPING_SAME_AS_BILLING', 'Shipping same as billing address',true);
define('TEXT_BILLING_SAME_AS_CUSTOMER', 'Billing same as customer address',true);

define('IMAGE_ADD_NEW_OT', 'Insert new custom order total after this one',true);
define('IMAGE_REMOVE_NEW_OT', 'Remove this order total component',true);
define('IMAGE_NEW_ORDER_EMAIL', 'Send Confirmation Email',true);


define('TEXT_NO_ORDER_HISTORY', 'No Order History Available',true);

define('PLEASE_SELECT', 'Please Select',true);

define('EMAIL_SEPARATOR', '------------------------------------------------------',true);
define('EMAIL_TEXT_SUBJECT', 'Your order has been updated',true);
define('EMAIL_TEXT_ORDER_NUMBER', 'Order Number:',true);
define('EMAIL_TEXT_INVOICE_URL', 'Detailed Invoice:',true);
define('EMAIL_TEXT_DATE_ORDERED', 'Date Ordered:',true);
define('EMAIL_TEXT_STATUS_UPDATE', 'Thank you so much for your order with us!' . "\n\n" . 'The status of your order has been updated.' . "\n\n" . 'New status: %s' . "\n\n");
define('EMAIL_TEXT_STATUS_UPDATE2', 'If you have questions, please reply to this email.' . "\n\n" . 'With warm regards from your friends at the ' . STORE_NAME . "\n");
define('EMAIL_TEXT_COMMENTS_UPDATE', 'The comments for your order are' . "\n\n%s\n\n");

define('ERROR_ORDER_DOES_NOT_EXIST', 'Error: Order %s does not exist.',true);
define('ERROR_NO_ORDER_SELECTED', 'You have not selected an order to edit, or the order ID variable has not been set.',true);
define('SUCCESS_ORDER_UPDATED', 'Success: Order has been successfully updated.',true);
define('SUCCESS_EMAIL_SENT', 'Completed: The order was updated and an email with the new information was sent.',true);

//the hints
define('HINT_UPDATE_TO_CC', 'Set payment method to ' . ORDER_EDITOR_CREDIT_CARD . ' and the other fields will be displayed automatically.  CC fields are hidden if any other payment method is selected.  The name of the payment method that, when selected, will display the CC fields is configurable in the Order Editor area of the Configuration section of the Administration panel.',true);
define('HINT_UPDATE_CURRENCY', 'Changing the currency will cause the shipping quotes and order totals to recalculate and reload.',true);
define('HINT_SHIPPING_ADDRESS', 'If you change the shipping state, postcode, or country you will be given the option of whether or not to recalculate the totals and reload the shipping quotes.',true);
define('HINT_TOTALS', 'Feel free to give discounts by adding negative values. Subtotal, tax total, and grand total fields are not editable. When adding in custom order total components via AJAX make sure you enter the title first or the code will not recognize the entry (ie, a component with a blank title is deleted from the order).',true);
define('HINT_PRESS_UPDATE', 'Please click on "Update" to save all changes.',true);
define('HINT_BASE_PRICE', 'Price (base) is the products price before products attributes (ie, the catalog price of the item)',true);
define('HINT_PRICE_EXCL', 'Price (excl) is the base price plus any product attributes prices that may exist',true);
define('HINT_PRICE_INCL', 'Price (incl) is Price (excl) times tax',true);
define('HINT_TOTAL_EXCL', 'Total (excl) is Price (excl) times qty',true);
define('HINT_TOTAL_INCL', 'Total (incl) is Price (excl) times tax and qty',true);
//end hints

//new order confirmation email- this is a separate email from order status update
define('ENTRY_SEND_NEW_ORDER_CONFIRMATION', 'New order confirmation:',true);
define('EMAIL_TEXT_DATE_MODIFIED', 'Date Modified:',true);
define('EMAIL_TEXT_PRODUCTS', 'Products',true);
define('EMAIL_TEXT_DELIVERY_ADDRESS', 'Delivery Address',true);
define('EMAIL_TEXT_BILLING_ADDRESS', 'Billing Address',true);
define('EMAIL_TEXT_PAYMENT_METHOD', 'Payment Method',true);
// If you want to include extra payment information, enter text below (use <br> for line breaks):
//define('EMAIL_TEXT_PAYMENT_INFO', '',true); //why would this be useful???
// If you want to include footer text, enter text below (use <br> for line breaks):
define('EMAIL_TEXT_FOOTER', '',true);
//end email

//add-on for downloads
define('ENTRY_DOWNLOAD_COUNT', 'Download #',true);
define('ENTRY_DOWNLOAD_FILENAME', 'Filename',true);
define('ENTRY_DOWNLOAD_MAXDAYS', 'Expiry days',true);
define('ENTRY_DOWNLOAD_MAXCOUNT', 'Downloads remaining',true);

//add-on for Ajax
define('AJAX_CONFIRM_PRODUCT_DELETE', 'Are you sure you want to delete this product from the order?',true);
define('AJAX_CONFIRM_COMMENT_DELETE', 'Are you sure you want to delete this comment from the orders status history?',true);
define('AJAX_MESSAGE_STACK_SUCCESS', 'Success! \' + %s + \' has been updated',true);
define('AJAX_CONFIRM_RELOAD_TOTALS', 'You have changed some shipping information. Would you like to recalculate the order totals and shipping quotes?',true);
define('AJAX_CANNOT_CREATE_XMLHTTP', 'Cannot create XMLHTTP instance',true);
define('AJAX_SUBMIT_COMMENT', 'Submit new comments and/or status',true);
define('AJAX_NO_QUOTES', 'There are no shipping quotes to display.',true);
define('AJAX_SELECTED_NO_SHIPPING', 'You have selected a shipping method for this order but it appears there is not one already stored in the database.  Would you like to add this shipping charge to the order?',true);
define('AJAX_RELOAD_TOTALS', 'The new shipping component has been written to the database but the totals have not yet been re-calculated.  Click ok now to re-calculate the order totals.  If your connection is slow wait for all components to load before clicking ok.',true);
define('AJAX_NEW_ORDER_EMAIL', 'Are you sure you want to send a new order confirmation email for this order?',true);
define('AJAX_INPUT_NEW_EMAIL_COMMENTS', 'Please input any comments you may have here.  It is ok to leave this blank if you do not wish to include comments.  Please remember as you type that hitting the "enter" key will result in submitting the comments as they appear.  It is not yet possible to include line breaks.',true);
define('AJAX_SUCCESS_EMAIL_SENT', 'Success!  A new order confirmation email was sent to %s',true);
define('AJAX_WORKING', 'Working, please wait....',true);

// Mail Manager
  define('EMAIL_TEXT_CONFIRM', 'New purchase from ',true);
  define('EMAIL_HTML_STATUS_UPDATE','Your order has been updated to: ',true);

// Purchase Without Account
  define('EMAIL_WARNING', 'NOTE: This email address has been submitted by a visitor to our online-shop. If you were not this visitor, please send a message to:  ' . STORE_OWNER_EMAIL_ADDRESS . 'Thank you for your purchase and have a nice day.',true);
?>
