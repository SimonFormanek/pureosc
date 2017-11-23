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
  Purchase Without Account (PWA) added -- http://addons.oscommerce.com/info/9142
  
  Released under the GNU General Public License
*/

define('EMAIL_TEXT_SUBJECT', 'Order Process',true);
define('EMAIL_TEXT_ORDER_NUMBER', 'Order Number:',true);
define('EMAIL_TEXT_INVOICE_URL', 'Detailed Invoice:',true);
define('EMAIL_TEXT_DATE_ORDERED', 'Date Ordered:',true);
define('EMAIL_TEXT_PRODUCTS', 'Products',true);
define('EMAIL_TEXT_SUBTOTAL', 'Sub-Total:',true);
define('EMAIL_TEXT_TAX', 'Tax:        ',true);
define('EMAIL_TEXT_SHIPPING', 'Shipping: ',true);
define('EMAIL_TEXT_TOTAL', 'Total:    ',true);
define('EMAIL_TEXT_DELIVERY_ADDRESS', 'Delivery Address',true);
define('EMAIL_TEXT_BILLING_ADDRESS', 'Billing Address',true);
define('EMAIL_TEXT_PAYMENT_METHOD', 'Payment Method',true);

define('EMAIL_SEPARATOR', '------------------------------------------------------',true);
define('TEXT_EMAIL_VIA', 'via',true);

/*
************************************************************************
************** Custom Filenames can be defined below here **************
**************               Raymond Burns                **************
************************************************************************
*/
// Mail Manager
  define('EMAIL_TEXT_CONFIRM', 'New purchase from ',true);
  
// Purchase Without Account
  define('EMAIL_WARNING', 'NOTE: This email address has been submitted by a visitor to our online-shop. If you were not this visitor, please send a message to:  ' . STORE_OWNER_EMAIL_ADDRESS . 'Thank you for your purchase and have a nice day.',true);  
//ORDER_SEND_CUSTOMERS_EMAIL_PHONE
define('CUSTOMERS_PHONE','Phone: ');
define('CUSTOMERS_E_MAIL','E-mail: ');
