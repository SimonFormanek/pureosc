<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2007 osCommerce

  Released under the GNU General Public License
*/

  define('MODULE_PAYMENT_AUTHORIZENET_CC_AIM_TEXT_TITLE', 'Authorize.net Kreditkarte AIM');
  define('MODULE_PAYMENT_AUTHORIZENET_CC_AIM_TEXT_PUBLIC_TITLE', 'Kreditkarte (Processed by Authorize.net)');
  define('MODULE_PAYMENT_AUTHORIZENET_CC_AIM_TEXT_DESCRIPTION', '<img src="images/icon_popup.gif" border="0">&nbsp;<a href="https://www.authorize.net" target="_blank" style="text-decoration: underline; font-weight: bold;">Authorize.net-Webseite besuchen</a>');
  
  define('MODULE_PAYMENT_AUTHORIZENET_CC_AIM_ERROR_ADMIN_CURL', 'This module requires cURL to be enabled in PHP and will not load until it has been enabled on this webserver.');
  define('MODULE_PAYMENT_AUTHORIZENET_CC_AIM_ERROR_ADMIN_CONFIGURATION', 'This module will not load until the API Login ID and API Transaction Key parameters have been configured. Please edit and configure the settings of this module.');


  //define('MODULE_PAYMENT_AUTHORIZENET_CC_AIM_CREDIT_CARD_OWNER', 'Karteninhaber:');
  define('MODULE_PAYMENT_AUTHORIZENET_CC_AIM_CREDIT_CARD_OWNER_FIRSTNAME', 'Vorname Karteninhaber:');
  define('MODULE_PAYMENT_AUTHORIZENET_CC_AIM_CREDIT_CARD_OWNER_LASTNAME', 'Nachname Karteninhaber:');

  define('MODULE_PAYMENT_AUTHORIZENET_CC_AIM_CREDIT_CARD_NUMBER', 'Kartennummer:');
  define('MODULE_PAYMENT_AUTHORIZENET_CC_AIM_CREDIT_CARD_EXPIRES', 'Ablaufdatum:');
  define('MODULE_PAYMENT_AUTHORIZENET_CC_AIM_CREDIT_CARD_CVC', 'Prüfnummer (CVC):');

  define('MODULE_PAYMENT_AUTHORIZENET_CC_AIM_TEXT_AVS_A', 'Address (Street) matches, ZIP does not');
  define('MODULE_PAYMENT_AUTHORIZENET_CC_AIM_TEXT_AVS_B', 'Address information not provided for AVS check');
  define('MODULE_PAYMENT_AUTHORIZENET_CC_AIM_TEXT_AVS_E', 'AVS error');
  define('MODULE_PAYMENT_AUTHORIZENET_CC_AIM_TEXT_AVS_G', 'Non-U.S. Card Issuing Bank');
  define('MODULE_PAYMENT_AUTHORIZENET_CC_AIM_TEXT_AVS_N', 'No Match on Address (Street) or ZIP');
  define('MODULE_PAYMENT_AUTHORIZENET_CC_AIM_TEXT_AVS_P', 'AVS not applicable for this transaction');
  define('MODULE_PAYMENT_AUTHORIZENET_CC_AIM_TEXT_AVS_R', 'Retry – System unavailable or timed out');
  define('MODULE_PAYMENT_AUTHORIZENET_CC_AIM_TEXT_AVS_S', 'Service not supported by issuer');
  define('MODULE_PAYMENT_AUTHORIZENET_CC_AIM_TEXT_AVS_U', 'Address information is unavailable');
  define('MODULE_PAYMENT_AUTHORIZENET_CC_AIM_TEXT_AVS_W', 'Nine digit ZIP matches, Address (Street) does not');
  define('MODULE_PAYMENT_AUTHORIZENET_CC_AIM_TEXT_AVS_X', 'Address (Street) and nine digit ZIP match');
  define('MODULE_PAYMENT_AUTHORIZENET_CC_AIM_TEXT_AVS_Y', 'Address (Street) and five digit ZIP match');
  define('MODULE_PAYMENT_AUTHORIZENET_CC_AIM_TEXT_AVS_Z', 'Five digit ZIP matches, Address (Street) does not');

  define('MODULE_PAYMENT_AUTHORIZENET_CC_AIM_TEXT_CVV2_M', 'Match');
  define('MODULE_PAYMENT_AUTHORIZENET_CC_AIM_TEXT_CVV2_N', 'No Match');
  define('MODULE_PAYMENT_AUTHORIZENET_CC_AIM_TEXT_CVV2_P', 'Not Processed');
  define('MODULE_PAYMENT_AUTHORIZENET_CC_AIM_TEXT_CVV2_S', 'Should have been present');
  define('MODULE_PAYMENT_AUTHORIZENET_CC_AIM_TEXT_CVV2_U', 'Issuer unable to process request');

  define('MODULE_PAYMENT_AUTHORIZENET_CC_AIM_TEXT_CAVV_0', 'CAVV not validated because erroneous data was submitted');
  define('MODULE_PAYMENT_AUTHORIZENET_CC_AIM_TEXT_CAVV_1', 'CAVV failed validation');
  define('MODULE_PAYMENT_AUTHORIZENET_CC_AIM_TEXT_CAVV_2', 'CAVV passed validation');
  define('MODULE_PAYMENT_AUTHORIZENET_CC_AIM_TEXT_CAVV_3', 'CAVV validation could not be performed; issuer attempt incomplete');
  define('MODULE_PAYMENT_AUTHORIZENET_CC_AIM_TEXT_CAVV_4', 'CAVV validation could not be performed; issuer system error');
  define('MODULE_PAYMENT_AUTHORIZENET_CC_AIM_TEXT_CAVV_5', 'Reserved for future use');
  define('MODULE_PAYMENT_AUTHORIZENET_CC_AIM_TEXT_CAVV_6', 'Reserved for future use');
  define('MODULE_PAYMENT_AUTHORIZENET_CC_AIM_TEXT_CAVV_7', 'CAVV attempt – failed validation – issuer available (U.S.-issued card/non-U.S. acquirer)');
  define('MODULE_PAYMENT_AUTHORIZENET_CC_AIM_TEXT_CAVV_8', 'CAVV attempt – passed validation – issuer available (U.S.-issued card/non-U.S. acquirer)');
  define('MODULE_PAYMENT_AUTHORIZENET_CC_AIM_TEXT_CAVV_9', 'CAVV attempt – failed validation – issuer unavailable (U.S.-issued card/non-U.S. acquirer)');
  define('MODULE_PAYMENT_AUTHORIZENET_CC_AIM_TEXT_CAVV_A', 'CAVV attempt – passed validation – issuerunavailable (U.S.-issued card/non-U.S. acquirer)');
  define('MODULE_PAYMENT_AUTHORIZENET_CC_AIM_TEXT_CAVV_B', 'CAVV passed validation, information only, no liability shift');

  define('MODULE_PAYMENT_AUTHORIZENET_CC_AIM_ERROR_TITLE', 'Ein Fehler ist bei der Prüfung Ihrer Kreditkarte aufgetreten');
  define('MODULE_PAYMENT_AUTHORIZENET_CC_AIM_ERROR_GENERAL', 'Versuchen Sie es bitte noch einmal oder wechseln Sie die Zahlungsweise.');
  define('MODULE_PAYMENT_AUTHORIZENET_CC_AIM_ERROR_DECLINED', 'Die Transaktion wurde abgelehnt. Versuchen Sie es bitte noch einmal oder wechseln Sie die Zahlungsweise.');
  define('MODULE_PAYMENT_AUTHORIZENET_CC_AIM_ERROR_INVALID_EXP_DATE', 'Das Ablaufdatum Ihrer Kreditkarte ist ungültig. Bitte überprüfen Sie Ihre Eingaben.');
  define('MODULE_PAYMENT_AUTHORIZENET_CC_AIM_ERROR_EXPIRED', 'Ihre Kreditkarte ist abgelaufen. Versuchen Sie es bitte noch einmal mit einer anderen Karte oder Zahlungsweise.');
  define('MODULE_PAYMENT_AUTHORIZENET_CC_AIM_ERROR_CVC', 'Die Prüfnummer (CVC) der Kreditkarte ist ungültig. Bitte überprüfen Sie Ihre Eingaben.');

  define('MODULE_PAYMENT_AUTHORIZENET_CC_AIM_ERROR_MERCHANT_ACCOUNT', 'The API Login ID or Transaction Key is invalid or the account is inactive. Please review your module configuration settings and try again.');
  define('MODULE_PAYMENT_AUTHORIZENET_CC_AIM_ERROR_CURRENCY', 'The supplied currency code is either invalid, not supported, not allowed for this merchant or doesn\'t have an exchange rate. Please review your currency and module configuration settings and try again.');

  define('MODULE_PAYMENT_AUTHORIZENET_CC_AIM_DIALOG_CONNECTION_LINK_TITLE', 'Test API Server Connection');
  define('MODULE_PAYMENT_AUTHORIZENET_CC_AIM_DIALOG_CONNECTION_TITLE', 'API Server Connection Test');
  define('MODULE_PAYMENT_AUTHORIZENET_CC_AIM_DIALOG_CONNECTION_GENERAL_TEXT', 'Testing connection to server..');
  define('MODULE_PAYMENT_AUTHORIZENET_CC_AIM_DIALOG_CONNECTION_BUTTON_CLOSE', 'Close');
  define('MODULE_PAYMENT_AUTHORIZENET_CC_AIM_DIALOG_CONNECTION_TIME', 'Connection Time:');
  define('MODULE_PAYMENT_AUTHORIZENET_CC_AIM_DIALOG_CONNECTION_SUCCESS', 'Success!');
  define('MODULE_PAYMENT_AUTHORIZENET_CC_AIM_DIALOG_CONNECTION_FAILED', 'Failed! Please review the Verify SSL Certificate settings and try again.');
  define('MODULE_PAYMENT_AUTHORIZENET_CC_AIM_DIALOG_CONNECTION_ERROR', 'An error occurred. Please refresh the page, review your settings, and try again.');
?>
