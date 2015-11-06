<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2007 osCommerce

  Released under the GNU General Public License
*/

  define('MODULE_PAYMENT_AUTHORIZENET_CC_SIM_TEXT_TITLE', 'Authorize.net Kreditkarte SIM',true);
  define('MODULE_PAYMENT_AUTHORIZENET_CC_SIM_TEXT_PUBLIC_TITLE', 'Kreditkarte (Processed by Authorize.net)',true);
  define('MODULE_PAYMENT_AUTHORIZENET_CC_SIM_TEXT_DESCRIPTION', '<img src="images/icon_info.gif" border="0" />&nbsp;<a href="http://library.oscommerce.com/Package&en&authorizenet&oscom23&sim" target="_blank" style="text-decoration: underline; font-weight: bold;">View Online Documentation</a><br /><br /><img src="images/icon_popup.gif" border="0">&nbsp;<a href="http://reseller.authorize.net/application/?id=5559280" target="_blank" style="text-decoration: underline; font-weight: bold;">Visit Authorize.net Website</a>&nbsp;<a href="javascript:toggleDivBlock(\'anetInfo\',true);">(info)</a><span id="anetInfo" style="display: none;"><br /><i>Using the above link to signup at Authorize.net grants osCommerce a small financial bonus for referring a customer.</i></span>',true);

  define('MODULE_PAYMENT_AUTHORIZENET_CC_SIM_ERROR_ADMIN_CONFIGURATION', 'This module will not load until the API Login ID and API Transaction Key parameters have been configured. Please edit and configure the settings of this module.',true);

  define('MODULE_PAYMENT_AUTHORIZENET_CC_SIM_TEXT_RETURN_BUTTON', 'Back to ' . STORE_NAME);

  define('MODULE_PAYMENT_AUTHORIZENET_CC_SIM_TEXT_AVS_A', 'Address (Street) matches, ZIP does not',true);
  define('MODULE_PAYMENT_AUTHORIZENET_CC_SIM_TEXT_AVS_B', 'Address information not provided for AVS check',true);
  define('MODULE_PAYMENT_AUTHORIZENET_CC_SIM_TEXT_AVS_E', 'AVS error',true);
  define('MODULE_PAYMENT_AUTHORIZENET_CC_SIM_TEXT_AVS_G', 'Non-U.S. Card Issuing Bank',true);
  define('MODULE_PAYMENT_AUTHORIZENET_CC_SIM_TEXT_AVS_N', 'No Match on Address (Street) or ZIP',true);
  define('MODULE_PAYMENT_AUTHORIZENET_CC_SIM_TEXT_AVS_P', 'AVS not applicable for this transaction',true);
  define('MODULE_PAYMENT_AUTHORIZENET_CC_SIM_TEXT_AVS_R', 'Retry – System unavailable or timed out',true);
  define('MODULE_PAYMENT_AUTHORIZENET_CC_SIM_TEXT_AVS_S', 'Service not supported by issuer',true);
  define('MODULE_PAYMENT_AUTHORIZENET_CC_SIM_TEXT_AVS_U', 'Address information is unavailable',true);
  define('MODULE_PAYMENT_AUTHORIZENET_CC_SIM_TEXT_AVS_W', 'Nine digit ZIP matches, Address (Street) does not',true);
  define('MODULE_PAYMENT_AUTHORIZENET_CC_SIM_TEXT_AVS_X', 'Address (Street) and nine digit ZIP match',true);
  define('MODULE_PAYMENT_AUTHORIZENET_CC_SIM_TEXT_AVS_Y', 'Address (Street) and five digit ZIP match',true);
  define('MODULE_PAYMENT_AUTHORIZENET_CC_SIM_TEXT_AVS_Z', 'Five digit ZIP matches, Address (Street) does not',true);

  define('MODULE_PAYMENT_AUTHORIZENET_CC_SIM_TEXT_CVV2_M', 'Match',true);
  define('MODULE_PAYMENT_AUTHORIZENET_CC_SIM_TEXT_CVV2_N', 'No Match',true);
  define('MODULE_PAYMENT_AUTHORIZENET_CC_SIM_TEXT_CVV2_P', 'Not Processed',true);
  define('MODULE_PAYMENT_AUTHORIZENET_CC_SIM_TEXT_CVV2_S', 'Should have been present',true);
  define('MODULE_PAYMENT_AUTHORIZENET_CC_SIM_TEXT_CVV2_U', 'Issuer unable to process request',true);

  define('MODULE_PAYMENT_AUTHORIZENET_CC_SIM_TEXT_CAVV_0', 'CAVV not validated because erroneous data was submitted',true);
  define('MODULE_PAYMENT_AUTHORIZENET_CC_SIM_TEXT_CAVV_1', 'CAVV failed validation',true);
  define('MODULE_PAYMENT_AUTHORIZENET_CC_SIM_TEXT_CAVV_2', 'CAVV passed validation',true);
  define('MODULE_PAYMENT_AUTHORIZENET_CC_SIM_TEXT_CAVV_3', 'CAVV validation could not be performed; issuer attempt incomplete',true);
  define('MODULE_PAYMENT_AUTHORIZENET_CC_SIM_TEXT_CAVV_4', 'CAVV validation could not be performed; issuer system error',true);
  define('MODULE_PAYMENT_AUTHORIZENET_CC_SIM_TEXT_CAVV_5', 'Reserved for future use',true);
  define('MODULE_PAYMENT_AUTHORIZENET_CC_SIM_TEXT_CAVV_6', 'Reserved for future use',true);
  define('MODULE_PAYMENT_AUTHORIZENET_CC_SIM_TEXT_CAVV_7', 'CAVV attempt – failed validation – issuer available (U.S.-issued card/non-U.S. acquirer)',true);
  define('MODULE_PAYMENT_AUTHORIZENET_CC_SIM_TEXT_CAVV_8', 'CAVV attempt – passed validation – issuer available (U.S.-issued card/non-U.S. acquirer)',true);
  define('MODULE_PAYMENT_AUTHORIZENET_CC_SIM_TEXT_CAVV_9', 'CAVV attempt – failed validation – issuer unavailable (U.S.-issued card/non-U.S. acquirer)',true);
  define('MODULE_PAYMENT_AUTHORIZENET_CC_SIM_TEXT_CAVV_A', 'CAVV attempt – passed validation – issuerunavailable (U.S.-issued card/non-U.S. acquirer)',true);
  define('MODULE_PAYMENT_AUTHORIZENET_CC_SIM_TEXT_CAVV_B', 'CAVV passed validation, information only, no liability shift',true);




  define('MODULE_PAYMENT_AUTHORIZENET_CC_SIM_ERROR_TITLE', 'Ein Fehler ist bei der Prüfung Ihrer Kreditkarte aufgetreten.',true);
  define('MODULE_PAYMENT_AUTHORIZENET_CC_SIM_ERROR_VERIFICATION', 'Die Transaktion konnte nicht dieser Bestellung zugeordnet werden. Versuchen Sie es bitte noch einmal oder wechseln Sie die Zahlungsweise.',true);
  define('MODULE_PAYMENT_AUTHORIZENET_CC_SIM_ERROR_DECLINED', 'Die Transaktion wurde abgelehnt. Versuchen Sie es bitte noch einmal oder wechseln Sie die Zahlungsweise.',true);
  define('MODULE_PAYMENT_AUTHORIZENET_CC_SIM_ERROR_GENERAL', 'Versuchen Sie es bitte noch einmal oder wechseln Sie die Zahlungsweise.',true);
?>
