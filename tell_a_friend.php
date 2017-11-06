<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2010 osCommerce
    
  Edited by 2014 Newburns Design and Technology
  *************************************************
  ************ New addon definitions **************
  ************        Below          **************
  *************************************************
  Mail Manager added -- http://addons.oscommerce.com/info/9133/v,23

  Released under the GNU General Public License
*/

  require_once('includes/application_top.php');

  if (!tep_session_is_registered('customer_id') && (ALLOW_GUEST_TO_TELL_A_FRIEND == 'false')) {
    $navigation->set_snapshot();
    tep_redirect(tep_href_link(FILENAME_LOGIN, '', 'SSL'));
  }

  $valid_product = false;
  if (isset($HTTP_GET_VARS['products_id'])) {
/* ** Altered for Mail Manager **  
    $product_info_query = tep_db_query("select pd.products_name from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_status = '1' and p.products_id = '" . (int)$HTTP_GET_VARS['products_id'] . "' and p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "'");
*/
	$product_info_query = tep_db_query("select p.products_image, pd.products_name from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_status = '1' and p.products_id = '" . (int)$HTTP_GET_VARS['products_id'] . "' and p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "'");
/* ** EOF alteration for Mail Manager ** */
    if (tep_db_num_rows($product_info_query)) {
      $valid_product = true;

      $product_info = tep_db_fetch_array($product_info_query);
    }
  }

  if ($valid_product == false) {
    tep_redirect(tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . (int)$HTTP_GET_VARS['products_id']));
  }

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_TELL_A_FRIEND);

  if (isset($HTTP_GET_VARS['action']) && ($HTTP_GET_VARS['action'] == 'process') && isset($HTTP_POST_VARS['formid']) && ($HTTP_POST_VARS['formid'] == $sessiontoken)) {
    $error = false;

    $to_email_address = tep_db_prepare_input($HTTP_POST_VARS['to_email_address']);
    $to_name = tep_db_prepare_input($HTTP_POST_VARS['to_name']);
    $from_email_address = tep_db_prepare_input($HTTP_POST_VARS['from_email_address']);
    $from_name = tep_db_prepare_input($HTTP_POST_VARS['from_name']);
    $message = tep_db_prepare_input($HTTP_POST_VARS['message']);

    if (empty($from_name)) {
      $error = true;

      $messageStack->add('friend', ERROR_FROM_NAME);
    }

    if (!tep_validate_email($from_email_address)) {
      $error = true;

      $messageStack->add('friend', ERROR_FROM_ADDRESS);
    }

    if (empty($to_name)) {
      $error = true;

      $messageStack->add('friend', ERROR_TO_NAME);
    }

    if (!tep_validate_email($to_email_address)) {
      $error = true;

      $messageStack->add('friend', ERROR_TO_ADDRESS);
    }

    $actionRecorder = new actionRecorder('ar_tell_a_friend', (tep_session_is_registered('customer_id') ? $customer_id : null), $from_name);
    if (!$actionRecorder->canPerform()) {
      $error = true;

      $actionRecorder->record(false);

      $messageStack->add('friend', sprintf(ERROR_ACTION_RECORDER, (defined('MODULE_ACTION_RECORDER_TELL_A_FRIEND_EMAIL_MINUTES') ? (int)MODULE_ACTION_RECORDER_TELL_A_FRIEND_EMAIL_MINUTES : 15)));
    }

    if ($error == false) {
      $email_subject = sprintf(TEXT_EMAIL_SUBJECT, $from_name, STORE_NAME);
      $email_body = sprintf(TEXT_EMAIL_INTRO, $to_name, $from_name, $product_info['products_name'], STORE_NAME) . "\n\n";

      if (tep_not_null($message)) {
        $email_body .= $message . "\n\n";
      }

      $email_body .= sprintf(TEXT_EMAIL_LINK, tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . (int)$HTTP_GET_VARS['products_id'], 'NONSSL', false)) . "\n\n" .
                     sprintf(TEXT_EMAIL_SIGNATURE, STORE_NAME . "\n" . HTTP_SERVER . DIR_WS_CATALOG . "\n");

/* ** Altered for Mail Manager **
      tep_mail($to_name, $to_email_address, $email_subject, $email_body, $from_name, $from_email_address);
*/
	  if (file_exists(DIR_WS_MODULES.'mail_manager/tell_a_friend.php') && EMAIL_USE_HTML == 'true'){
		include(DIR_WS_MODULES.'mail_manager/tell_a_friend.php'); 
		}else{ 
	  tep_mail($to_name, $to_email_address, $email_subject, $email_body, $from_name, $from_email_address);
	  }
/* ** EOF alterations for Mail Manager ** */	  

      $actionRecorder->record();

      $messageStack->add_session('header', sprintf(TEXT_EMAIL_SUCCESSFUL_SENT, $product_info['products_name'], tep_output_string_protected($to_name)), 'success');

      tep_redirect(tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . (int)$HTTP_GET_VARS['products_id']));
    }
  } elseif (tep_session_is_registered('customer_id')) {
    $account_query = tep_db_query("select customers_firstname, customers_lastname, customers_email_address from " . TABLE_CUSTOMERS . " where customers_id = '" . (int)$customer_id . "'");
    $account = tep_db_fetch_array($account_query);

    $from_name = $account['customers_firstname'] . ' ' . $account['customers_lastname'];
    $from_email_address = $account['customers_email_address'];
  }

  $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_TELL_A_FRIEND, 'products_id=' . (int)$HTTP_GET_VARS['products_id']));

  require(DIR_WS_INCLUDES . 'template_top.php');
?>

<div class="page-header">
  <h1><?php echo sprintf(HEADING_TITLE, $product_info['products_name']); ?></h1>
</div>

<?php
  if ($messageStack->size('friend') > 0) {
    echo $messageStack->output('friend');
  }
?>

<?php echo tep_draw_form('email_friend', tep_href_link(FILENAME_TELL_A_FRIEND, 'action=process&products_id=' . (int)$HTTP_GET_VARS['products_id']), 'post', 'class="form-horizontal"', true); ?>

<div class="contentContainer">

  <div class="inputRequirement text-right"><?php echo FORM_REQUIRED_INFORMATION; ?></div>

  <h2><?php echo FORM_TITLE_CUSTOMER_DETAILS; ?></h2>

  <div class="contentText">
    <div class="form-group has-feedback">
      <label for="inputFromName" class="control-label col-sm-3"><?php echo FORM_FIELD_CUSTOMER_NAME; ?></label>
      <div class="col-sm-9">
        <?php
        echo tep_draw_input_field('from_name', NULL, 'required aria-required="true" id="inputFromName" placeholder="' . FORM_FIELD_CUSTOMER_NAME . '"');
        echo FORM_REQUIRED_INPUT;
        ?>
      </div>
    </div>
    <div class="form-group has-feedback">
      <label for="inputFromEmail" class="control-label col-sm-3"><?php echo FORM_FIELD_CUSTOMER_EMAIL; ?></label>
      <div class="col-sm-9">
        <?php
        echo tep_draw_input_field('from_email_address', NULL, 'required aria-required="true" id="inputFromEmail" placeholder="' . FORM_FIELD_CUSTOMER_EMAIL . '"', 'email');
        echo FORM_REQUIRED_INPUT;
        ?>
      </div>
    </div>
  </div>

  <h2><?php echo FORM_TITLE_FRIEND_DETAILS; ?></h2>

  <div class="contentText">
    <div class="form-group has-feedback">
      <label for="inputToName" class="control-label col-sm-3"><?php echo FORM_FIELD_FRIEND_NAME; ?></label>
      <div class="col-sm-9">
        <?php
        echo tep_draw_input_field('to_name', NULL, 'required aria-required="true" id="inputToName" placeholder="' . FORM_FIELD_FRIEND_NAME . '"');
        echo FORM_REQUIRED_INPUT;
        ?>
      </div>
    </div>
    <div class="form-group has-feedback">
      <label for="inputToEmail" class="control-label col-sm-3"><?php echo FORM_FIELD_FRIEND_EMAIL; ?></label>
      <div class="col-sm-9">
        <?php
        echo tep_draw_input_field('to_email_address', NULL, 'required aria-required="true" id="inputToEmail" placeholder="' . FORM_FIELD_FRIEND_EMAIL . '"', 'email');
        echo FORM_REQUIRED_INPUT;
        ?>
      </div>
    </div>
  </div>

  <hr>

  <div class="contentText">
    <div class="form-group has-feedback">
      <label for="inputMessage" class="control-label col-sm-3"><?php echo FORM_TITLE_FRIEND_MESSAGE; ?></label>
      <div class="col-sm-9">
        <?php
        echo tep_draw_textarea_field('message', 'soft', 40, 8, NULL, 'required aria-required="true" id="inputMessage" placeholder="' . FORM_TITLE_FRIEND_MESSAGE . '"');
        echo FORM_REQUIRED_INPUT;
        ?>
      </div>
    </div>
  </div>

  <div class="buttonSet row">
    <div class="col-xs-6"><?php echo tep_draw_button(IMAGE_BUTTON_BACK, 'fa fa-angle-left', tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . (int)$HTTP_GET_VARS['products_id'])); ?></div>
    <div class="col-xs-6 text-right"><?php echo tep_draw_button(IMAGE_BUTTON_CONTINUE, 'fa fa-send', null, 'primary', null, 'btn-success'); ?></div>
  </div>
</div>

</form>

<?php
  require(DIR_WS_INCLUDES . 'template_bottom.php');
  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
