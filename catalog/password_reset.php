<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2012 osCommerce

  Released under the GNU General Public License
 */

require_once('includes/application_top.php');

require(DIR_WS_LANGUAGES.$language.'/'.FILENAME_PASSWORD_RESET);

$error = false;

if (!isset($_GET['account']) || !isset($_GET['key'])) {
    $error = true;

    $messageStack->add_session('password_forgotten', TEXT_NO_RESET_LINK_FOUND);
}

if ($error === false) {
    $email_address = tep_db_prepare_input($_GET['account']);
    $password_key  = tep_db_prepare_input($_GET['key']);

    if ((strlen($email_address) < ENTRY_EMAIL_ADDRESS_MIN_LENGTH) || (tep_validate_email($email_address)
        === false)) {
        $error = true;

        $messageStack->add_session('password_forgotten',
            TEXT_NO_EMAIL_ADDRESS_FOUND);
    } elseif (strlen($password_key) != 40) {
        $error = true;

        $messageStack->add_session('password_forgotten',
            TEXT_NO_RESET_LINK_FOUND);
    } else {
        $check_customer_query = tep_db_query("select c.customers_id, c.customers_email_address, ci.password_reset_key, ci.password_reset_date from ".TABLE_CUSTOMERS." c, ".TABLE_CUSTOMERS_INFO." ci where c.customers_email_address = '".tep_db_input($email_address)."' and c.customers_id = ci.customers_info_id");
        if (tep_db_num_rows($check_customer_query)) {
            $check_customer = tep_db_fetch_array($check_customer_query);

            if (empty($check_customer['password_reset_key']) || ($check_customer['password_reset_key']
                != $password_key) || (strtotime($check_customer['password_reset_date'].' +1 day')
                <= time())) {
                $error = true;

                $messageStack->add_session('password_forgotten',
                    TEXT_NO_RESET_LINK_FOUND);
            }
        } else {
            $error = true;

            $messageStack->add_session('password_forgotten',
                TEXT_NO_EMAIL_ADDRESS_FOUND);
        }
    }
}

if ($error === true) {
    tep_redirect(tep_href_link(FILENAME_PASSWORD_FORGOTTEN));
}

if (isset($_GET['action']) && ($_GET['action'] == 'process') && isset($_POST['formid'])
    && ($_POST['formid'] == $sessiontoken)) {
    $password_new          = tep_db_prepare_input($_POST['password']);
    $password_confirmation = tep_db_prepare_input($_POST['confirmation']);

    if (strlen($password_new) < ENTRY_PASSWORD_MIN_LENGTH) {
        $error = true;

        $messageStack->add('password_reset', ENTRY_PASSWORD_NEW_ERROR);
    } elseif ($password_new != $password_confirmation) {
        $error = true;

        $messageStack->add('password_reset',
            ENTRY_PASSWORD_NEW_ERROR_NOT_MATCHING);
    }

    if ($error === false) {

        tep_db_query("update ".TABLE_CUSTOMERS." set customers_password = '".password_hash($password_new, PASSWORD_ARGON2ID)."' where customers_id = '".(int) $check_customer['customers_id']."'");
//TODO:        tep_db_query("update ".TABLE_CUSTOMERS." set customers_password = '".password_hash($password_new, constant('HASH_ALGO'))."' where customers_id = '".(int) $check_customer['customers_id']."'");

        tep_db_query("update ".TABLE_CUSTOMERS_INFO." set customers_info_date_account_last_modified = now(), password_reset_key = null, password_reset_date = null where customers_info_id = '".(int) $check_customer['customers_id']."'");

        $messageStack->add_session('login', SUCCESS_PASSWORD_RESET, 'success');

        tep_redirect(tep_href_link(FILENAME_LOGIN, '', 'SSL'));
    }
}

$breadcrumb->add(NAVBAR_TITLE_1, tep_href_link(FILENAME_LOGIN, '', 'SSL'));
$breadcrumb->add(NAVBAR_TITLE_2);

require(DIR_WS_INCLUDES.'template_top.php');
?>

<div class="page-header">
    <h1><?php echo HEADING_TITLE; ?></h1>
</div>

<?php
if ($messageStack->size('password_reset') > 0) {
    echo $messageStack->output('password_reset');
}
?>

<?php
echo tep_draw_form('password_reset',
    tep_href_link(FILENAME_PASSWORD_RESET,
        'account='.$email_address.'&key='.$password_key.'&action=process', 'SSL'),
    'post', 'class="form-horizontal"', true);
?>

<div class="contentContainer">
    <div class="contentText">
        <div class="alert alert-info"><?php echo TEXT_MAIN; ?></div>

        <div class="form-group has-feedback">
            <label for="inputPassword" class="control-label col-sm-3"><?php echo ENTRY_PASSWORD; ?></label>
            <div class="col-sm-9">
                <?php
                echo tep_draw_input_field('password', NULL,
                    'required aria-required="true"  autofocus="autofocus" id="inputPassword" placeholder="'.ENTRY_PASSWORD.'"',
                    'password');
                ?>
                <?php echo _('Required'); ?>
            </div>
        </div>
        <div class="form-group has-feedback">
            <label for="inputConfirm" class="control-label col-sm-3"><?php echo ENTRY_PASSWORD_CONFIRMATION; ?></label>
            <div class="col-sm-9">
                <?php
                echo tep_draw_input_field('confirmation', NULL,
                    'required aria-required="true" id="inputConfirm" placeholder="'.ENTRY_PASSWORD_CONFIRMATION.'"',
                    'password');
                ?>
                <?php echo _('Required'); ?>
            </div>
        </div>
    </div>

    <div class="buttonSet">
        <div class="text-right"><?php
            echo tep_draw_button(IMAGE_BUTTON_CONTINUE, 'fa fa-angle-right',
                null, 'primary', null, 'btn-success');
            ?></div>
    </div>
</div>

</form>

<?php
require(DIR_WS_INCLUDES.'template_bottom.php');
require(DIR_WS_INCLUDES.'application_bottom.php');