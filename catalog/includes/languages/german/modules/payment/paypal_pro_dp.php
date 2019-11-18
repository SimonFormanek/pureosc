<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2014 osCommerce

  Released under the GNU General Public License
*/

  define('MODULE_PAYMENT_PAYPAL_PRO_DP_TEXT_TITLE', 'PayPal Payments Pro (Direct Payment)',true);
  define('MODULE_PAYMENT_PAYPAL_PRO_DP_TEXT_PUBLIC_TITLE', 'Credit or Debit Card',true);
  define('MODULE_PAYMENT_PAYPAL_PRO_DP_TEXT_DESCRIPTION', '<img src="images/icon_info.gif" border="0" />&nbsp;<a href="http://library.oscommerce.com/Package&en&paypal&oscom23&payments_pro_direct" target="_blank" style="text-decoration: underline; font-weight: bold;">View Online Documentation</a><br /><br /><img src="images/icon_popup.gif" border="0" />&nbsp;<a href="https://www.paypal.com" target="_blank" style="text-decoration: underline; font-weight: bold;">Visit PayPal Website</a>',true);

  define('MODULE_PAYMENT_PAYPAL_PRO_DP_ERROR_EXPRESS_MODULE', 'PayPal mandates the PayPal Express Checkout payment module be enabled if this module is to be activated. This module will not load until the PayPal Express Checkout module has been installed.',true);
  define('MODULE_PAYMENT_PAYPAL_PRO_DP_ERROR_ADMIN_CURL', 'This module requires cURL to be enabled in PHP and will not load until it has been enabled on this webserver.',true);
  define('MODULE_PAYMENT_PAYPAL_PRO_DP_ERROR_ADMIN_CONFIGURATION', 'This module will not load until the API Credential parameters have been configured. Please edit and configure the settings of this module.',true);

  define('MODULE_PAYMENT_PAYPAL_PRO_DP_CARD_OWNER', 'Card Owner:',true);
  define('MODULE_PAYMENT_PAYPAL_PRO_DP_CARD_TYPE', 'Card Type:',true);
  define('MODULE_PAYMENT_PAYPAL_PRO_DP_CARD_NUMBER', 'Card Number:',true);
  define('MODULE_PAYMENT_PAYPAL_PRO_DP_CARD_VALID_FROM', 'Card Valid From Date:',true);
  define('MODULE_PAYMENT_PAYPAL_PRO_DP_CARD_VALID_FROM_INFO', '(if available)',true);
  define('MODULE_PAYMENT_PAYPAL_PRO_DP_CARD_EXPIRES', 'Card Expiry Date:',true);
  define('MODULE_PAYMENT_PAYPAL_PRO_DP_CARD_CVC', 'Card Security Code (CVV2):',true);
  define('MODULE_PAYMENT_PAYPAL_PRO_DP_CARD_ISSUE_NUMBER', 'Card Issue Number:',true);
  define('MODULE_PAYMENT_PAYPAL_PRO_DP_CARD_ISSUE_NUMBER_INFO', '(for Maestro cards only)',true);
  define('MODULE_PAYMENT_PAYPAL_PRO_DP_ERROR_ALL_FIELDS_REQUIRED', 'Error: All payment information fields are required.',true);

  define('MODULE_PAYMENT_PAYPAL_PRO_DP_DIALOG_CONNECTION_LINK_TITLE', 'Test API Server Connection',true);
  define('MODULE_PAYMENT_PAYPAL_PRO_DP_DIALOG_CONNECTION_TITLE', 'API Server Connection Test',true);
  define('MODULE_PAYMENT_PAYPAL_PRO_DP_DIALOG_CONNECTION_GENERAL_TEXT', 'Testing connection to server..',true);
  define('MODULE_PAYMENT_PAYPAL_PRO_DP_DIALOG_CONNECTION_BUTTON_CLOSE', 'Close',true);
  define('MODULE_PAYMENT_PAYPAL_PRO_DP_DIALOG_CONNECTION_TIME', 'Connection Time:',true);
  define('MODULE_PAYMENT_PAYPAL_PRO_DP_DIALOG_CONNECTION_SUCCESS', 'Success!',true);
  define('MODULE_PAYMENT_PAYPAL_PRO_DP_DIALOG_CONNECTION_FAILED', 'Failed! Please review the Verify SSL Certificate settings and try again.',true);
  define('MODULE_PAYMENT_PAYPAL_PRO_DP_DIALOG_CONNECTION_ERROR', 'An error occurred. Please refresh the page, review your settings, and try again.',true);