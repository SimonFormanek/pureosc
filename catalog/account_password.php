<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2010 osCommerce

  Released under the GNU General Public License
 */

require_once('includes/application_top.php');

if (!tep_session_is_registered('customer_id')) {
    $navigation->set_snapshot();
    tep_redirect(tep_href_link(FILENAME_LOGIN, '', 'SSL'));
}

// needs to be included earlier to set the success message in the messageStack
require(DIR_WS_LANGUAGES.$language.'/'.FILENAME_ACCOUNT_PASSWORD);

if (isset($_POST['action']) && ($_POST['action'] == 'process') && isset($_POST['formid'])
    && ($_POST['formid'] == $sessiontoken)) {
    $password_current      = tep_db_prepare_input($_POST['password_current']);
    $password_new          = tep_db_prepare_input($_POST['password_new']);
    $password_confirmation = tep_db_prepare_input($_POST['password_confirmation']);

    $error = false;

    if (strlen($password_new) < ENTRY_PASSWORD_MIN_LENGTH) {
        $error = true;

        $messageStack->add('account_password', ENTRY_PASSWORD_NEW_ERROR);
    } elseif ($password_new != $password_confirmation) {
        $error = true;

        $messageStack->add('account_password',
            ENTRY_PASSWORD_NEW_ERROR_NOT_MATCHING);
    }

    if ($error === false) {
        $check_customer_query = tep_db_query("select customers_password from ".TABLE_CUSTOMERS." where customers_id = '".(int) $customer_id."'");
        $check_customer       = tep_db_fetch_array($check_customer_query);

        if (tep_validate_password($password_current, $check_customer['customers_password'])) {
            tep_db_query("update ".TABLE_CUSTOMERS." set customers_password = '".password_hash($password_new, PASSWORD_ARGON2ID)."' where customers_id = '".(int) $customer_id."'");
//TODO:            tep_db_query("update ".TABLE_CUSTOMERS." set customers_password = '".password_hash($password_new, cfg('HASH_ALGO'))."' where customers_id = '".(int) $customer_id."'");
            
            tep_db_query("update ".TABLE_CUSTOMERS_INFO." set customers_info_date_account_last_modified = now() where customers_info_id = '".(int) $customer_id."'");

            $messageStack->add_session('account', SUCCESS_PASSWORD_UPDATED,
                'success');

            tep_redirect(tep_href_link(FILENAME_ACCOUNT, '', 'SSL'));
        } else {
            $error = true;

            $messageStack->add('account_password',
                ERROR_CURRENT_PASSWORD_NOT_MATCHING);
        }
    }
}

$breadcrumb->add(NAVBAR_TITLE_1, tep_href_link(FILENAME_ACCOUNT, '', 'SSL'));
$breadcrumb->add(NAVBAR_TITLE_2,
    tep_href_link(FILENAME_ACCOUNT_PASSWORD, '', 'SSL'));

require(DIR_WS_INCLUDES.'template_top.php');
?>

<div class="page-header">
    <h1><?php echo HEADING_TITLE; ?></h1>
</div>

<?php
if ($messageStack->size('account_password') > 0) {
    echo $messageStack->output('account_password');
}
?>

<?php
echo tep_draw_form('account_password',
    tep_href_link(FILENAME_ACCOUNT_PASSWORD, '', 'SSL'), 'post',
    'class="form-horizontal"', true).tep_draw_hidden_field('action', 'process');
?>

<div class="contentContainer">
    <p class="inputRequirement text-right"><?php echo _('Requied Information'); ?></p>

    <div class="contentText">
        <div class="form-group has-feedback">
            <label for="inputCurrent" class="control-label col-sm-3"><?php echo ENTRY_PASSWORD_CURRENT; ?></label>
            <div class="col-sm-9">
                <?php
                echo tep_draw_input_field('password_current', NULL,
                    'required aria-required="true" aria-describedby="atPassword" autofocus="autofocus" id="inputCurrent" placeholder="'.ENTRY_PASSWORD_CURRENT.'"',
                    'password');
                ?>
                &#10033;
                <?php if (tep_not_null(ENTRY_PASSWORD_CURRENT_TEXT)) echo '<span id="atPassword" class="help-block">'.ENTRY_PASSWORD_CURRENT_TEXT.'</span>'; ?>
            </div>
        </div>
        <div class="form-group has-feedback">
            <label for="inputNew" class="control-label col-sm-3"><?php echo ENTRY_PASSWORD_NEW; ?></label>
            <div class="col-sm-9">
                <?php
                echo tep_draw_input_field('password_new', NULL,
                    'required aria-required="true" aria-describedby="atNewPassword" id="inputNew" placeholder="'.ENTRY_PASSWORD_NEW.'"',
                    'password');
                ?>
                &#10033;
                <?php if (tep_not_null(ENTRY_PASSWORD_NEW_TEXT)) echo '<span id="atNewPassword" class="help-block">'.ENTRY_PASSWORD_NEW_TEXT.'</span>'; ?>
            </div>
        </div>
        <div class="form-group has-feedback">
            <label for="inputConfirmation" class="control-label col-sm-3"><?php echo ENTRY_PASSWORD_CONFIRMATION; ?></label>
            <div class="col-sm-9">
                <?php
                echo tep_draw_input_field('password_confirmation', NULL,
                    'required aria-required="true"  aria-describedby="atNewPasswordConfirmation" id="inputConfirmation" placeholder="'.ENTRY_PASSWORD_CONFIRMATION.'"',
                    'password');
                ?>
                &#10033;
                <?php if (tep_not_null(ENTRY_PASSWORD_CONFIRMATION_TEXT)) echo '<span id="atNewPasswordConfirmation" class="help-block">'.ENTRY_PASSWORD_CONFIRMATION_TEXT.'</span>'; ?>
            </div>
        </div>
    </div>

    <div class="buttonSet row">
        <div class="col-xs-6"><?php
            echo tep_draw_button(IMAGE_BUTTON_BACK, 'fa fa-angle-left',
                tep_href_link(FILENAME_ACCOUNT, '', 'SSL'));
            ?></div>
        <div class="col-xs-6 text-right"><?php
            echo tep_draw_button(IMAGE_BUTTON_CONTINUE, 'fa fa-angle-right',
                null, 'primary', null, 'btn-success');
            ?></div>
    </div>
</div>

</form>

<?php
require(DIR_WS_INCLUDES.'template_bottom.php');
require(DIR_WS_INCLUDES.'application_bottom.php');