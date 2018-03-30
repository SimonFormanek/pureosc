<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2014 osCommerce

  Released under the GNU General Public License
 */

require_once('includes/application_top.php');

// needs to be included earlier to set the success message in the messageStack
require(DIR_WS_LANGUAGES.$language.'/checkout_pwa.php');



if ($cart->count_contents() < 1)
        tep_redirect(tep_href_link(FILENAME_SHOPPING_CART));

if (tep_session_is_registered('customer_id'))
        tep_redirect(tep_href_link('checkout_shipping.php', '', 'SSL'));


$process = false;
if (isset($_POST['action']) && ($_POST['action'] == 'process') && isset($_POST['formid'])
    && ($_POST['formid'] == $sessiontoken)) {
    $process = true;

    if (ACCOUNT_GENDER == 'true') {
        if (isset($_POST['gender'])) {
            $gender = tep_db_prepare_input($_POST['gender']);
        } else {
            $gender = false;
        }
    }
    $firstname      = tep_db_prepare_input($_POST['firstname']);
    $lastname       = tep_db_prepare_input($_POST['lastname']);
    if (ACCOUNT_DOB == 'true') $dob            = tep_db_prepare_input($_POST['dob']);
    $email_address  = tep_db_prepare_input($_POST['email_address']);
    if (ACCOUNT_COMPANY == 'true')
            $company        = tep_db_prepare_input($_POST['company']);
    if (ACCOUNT_COMPANY == 'true')
            $vat_number     = tep_db_prepare_input($_POST['vat_number']);
    $street_address = tep_db_prepare_input($_POST['street_address']);
    if (ACCOUNT_SUBURB == 'true')
            $suburb         = tep_db_prepare_input($_POST['suburb']);
    $postcode       = tep_db_prepare_input($_POST['postcode']);
    $city           = tep_db_prepare_input($_POST['city']);
    if (ACCOUNT_STATE == 'true') {
        $state = tep_db_prepare_input($_POST['state']);
        if (isset($_POST['zone_id'])) {
            $zone_id = tep_db_prepare_input($_POST['zone_id']);
        } else {
            $zone_id = false;
        }
    }
    $country   = tep_db_prepare_input($_POST['country']);
    $telephone = tep_db_prepare_input($_POST['telephone']);
    $password  = tep_db_prepare_input($_POST['password']);

    $error = false;

    if (ACCOUNT_GENDER == 'true') {
        if (($gender != 'm') && ($gender != 'f')) {
            $error = true;

            $messageStack->add('create_account', ENTRY_GENDER_ERROR);
        }
    }

    if (strlen($firstname) < ENTRY_FIRST_NAME_MIN_LENGTH) {
        $error = true;

        $messageStack->add('create_account', ENTRY_FIRST_NAME_ERROR);
    }

    if (strlen($lastname) < ENTRY_LAST_NAME_MIN_LENGTH) {
        $error = true;

        $messageStack->add('create_account', ENTRY_LAST_NAME_ERROR);
    }

    if (ACCOUNT_DOB == 'true') {
        if ((strlen($dob) < ENTRY_DOB_MIN_LENGTH) || (!empty($dob) && (!is_numeric(tep_date_raw($dob))
            || !@checkdate(substr(tep_date_raw($dob), 4, 2),
                substr(tep_date_raw($dob), 6, 2),
                substr(tep_date_raw($dob), 0, 4))))) {
            $error = true;

            $messageStack->add('create_account', ENTRY_DATE_OF_BIRTH_ERROR);
        }
    }

    if (strlen($email_address) < ENTRY_EMAIL_ADDRESS_MIN_LENGTH) {
        $error = true;

        $messageStack->add('create_account', ENTRY_EMAIL_ADDRESS_ERROR);
    } elseif (tep_validate_email($email_address) == false) {
        $error = true;

        $messageStack->add('create_account', ENTRY_EMAIL_ADDRESS_CHECK_ERROR);
    } else {
        $check_email_query = tep_db_query("select count(*) as total from ".TABLE_CUSTOMERS." where customers_email_address = '".tep_db_input($email_address)."'");
        $check_email       = tep_db_fetch_array($check_email_query);
        if ($check_email['total'] > 0) {
            $error = true;

            $messageStack->add('create_account',
                ENTRY_EMAIL_ADDRESS_ERROR_EXISTS);
        }
    }

    if (strlen($street_address) < ENTRY_STREET_ADDRESS_MIN_LENGTH) {
        $error = true;

        $messageStack->add('create_account', ENTRY_STREET_ADDRESS_ERROR);
    }

    if (strlen($postcode) < ENTRY_POSTCODE_MIN_LENGTH) {
        $error = true;

        $messageStack->add('create_account', ENTRY_POST_CODE_ERROR);
    }

    if (strlen($city) < ENTRY_CITY_MIN_LENGTH) {
        $error = true;

        $messageStack->add('create_account', ENTRY_CITY_ERROR);
    }

    if (is_numeric($country) == false) {
        $error = true;

        $messageStack->add('create_account', ENTRY_COUNTRY_ERROR);
    }

    if (ACCOUNT_STATE == 'true') {
        $zone_id               = 0;
        $check_query           = tep_db_query("select count(*) as total from ".TABLE_ZONES." where zone_country_id = '".(int) $country."'");
        $check                 = tep_db_fetch_array($check_query);
        $entry_state_has_zones = ($check['total'] > 0);
        if ($entry_state_has_zones == true) {
            $zone_query = tep_db_query("select distinct zone_id from ".TABLE_ZONES." where zone_country_id = '".(int) $country."' and (zone_name = '".tep_db_input($state)."' or zone_code = '".tep_db_input($state)."')");
            if (tep_db_num_rows($zone_query) == 1) {
                $zone    = tep_db_fetch_array($zone_query);
                $zone_id = $zone['zone_id'];
            } else {
                $error = true;

                $messageStack->add('create_account', ENTRY_STATE_ERROR_SELECT);
            }
        } else {
            if (strlen($state) < ENTRY_STATE_MIN_LENGTH) {
                $error = true;

                $messageStack->add('create_account', ENTRY_STATE_ERROR);
            }
        }
    }

    if (GUEST_CHECKOUT_TELEPHONE == 'true') {
        if (strlen($telephone) < ENTRY_TELEPHONE_MIN_LENGTH) {
            $error = true;

            $messageStack->add('create_account', ENTRY_TELEPHONE_NUMBER_ERROR);
        }
    }

    if ($error == false) {

        $dbPass = tep_encrypt_password(tep_create_random_value(40));


        $sql_data_array                        = array('customers_firstname' => $firstname,
            'customers_lastname' => $lastname,
            'customers_email_address' => $email_address,
            'customers_password' => $dbPass,
            'customers_guest' => '1');
        if (GUEST_CHECKOUT_TELEPHONE == 'true')
                $sql_data_array['customers_telephone'] = $telephone;
        if (ACCOUNT_GENDER == 'true')
                $sql_data_array['customers_gender']    = $gender;
        if (ACCOUNT_DOB == 'true')
                $sql_data_array['customers_dob']       = tep_date_raw($dob);

        tep_db_perform(TABLE_CUSTOMERS, $sql_data_array);

        $customer_id = tep_db_insert_id();

        $sql_data_array = array('customers_id' => $customer_id,
            'entry_firstname' => $firstname,
            'entry_lastname' => $lastname,
            'entry_street_address' => $street_address,
            'entry_postcode' => $postcode,
            'entry_city' => $city,
            'entry_country_id' => $country,
            'customers_guest' => '1');

        if (ACCOUNT_GENDER == 'true') $sql_data_array['entry_gender']     = $gender;
        if (ACCOUNT_COMPANY == 'true')
                $sql_data_array['entry_company']    = $company;
        if (ACCOUNT_COMPANY == 'true')
                $sql_data_array['entry_vat_number'] = $vat_number;
        if (ACCOUNT_SUBURB == 'true') $sql_data_array['entry_suburb']     = $suburb;
        if (ACCOUNT_STATE == 'true') {
            if ($zone_id > 0) {
                $sql_data_array['entry_zone_id'] = $zone_id;
                $sql_data_array['entry_state']   = '';
            } else {
                $sql_data_array['entry_zone_id'] = '0';
                $sql_data_array['entry_state']   = $state;
            }
        }


        tep_db_perform(TABLE_ADDRESS_BOOK, $sql_data_array);

        $address_id = tep_db_insert_id();

        tep_db_query("update ".TABLE_CUSTOMERS." set customers_default_address_id = '".(int) $address_id."' where customers_id = '".(int) $customer_id."'");

        tep_db_query("insert into ".TABLE_CUSTOMERS_INFO." (customers_info_id, customers_info_number_of_logons, customers_info_date_account_created) values ('".(int) $customer_id."', '0', now())");

        if (SESSION_RECREATE == 'True') {
            tep_session_recreate();
        }

        $customer_first_name         = $firstname;
        $customer_default_address_id = $address_id;
        $customer_country_id         = $country;
        $customer_zone_id            = $zone_id;
        tep_session_register('customer_is_guest');
        tep_session_register('customer_id');
        tep_session_register('customer_first_name');
        tep_session_register('customer_default_address_id');
        tep_session_register('customer_country_id');
        tep_session_register('customer_zone_id');

///   reset session token
        $sessiontoken = md5(tep_rand().tep_rand().tep_rand().tep_rand());

// restore cart contents
        $cart->restore_contents();


        tep_redirect(tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'));
    }
}

$breadcrumb->add(NAVBAR_TITLE_3, tep_href_link($PHP_SELF, '', 'SSL'));

require(DIR_WS_INCLUDES.'template_top.php');
require('includes/check_account.js.php');
?>

<div class="page-header">
    <h1><?php echo HEADING_TITLE; ?></h1>
</div>

        <?php
        if ($messageStack->size('create_account') > 0) {
            echo $messageStack->output('create_account');
        }
        ?>

<div class="alert alert-warning">
                    <?php echo sprintf(TEXT_ORIGIN_LOGIN,
                        tep_href_link(FILENAME_LOGIN, tep_get_all_get_params(),
                            'SSL')); ?><span class="inputRequirement pull-right text-right"><?php echo FORM_REQUIRED_INFORMATION; ?></span>
</div>


                <?php echo tep_draw_form('create_account',
                    tep_href_link('account_pwa.php', '', 'SSL'), 'post',
                    'class="form-horizontal" onsubmit="return check_form(create_account);"',
                    true).tep_draw_hidden_field('action', 'process'); ?>

<div class="contentContainer">
    <div class="contentText">

<?php
if (ACCOUNT_GENDER == 'true') {
    ?>
            <div class="form-group has-feedback">
                <label class="control-label col-sm-3"><?php echo ENTRY_GENDER; ?></label>
                <div class="col-sm-9">
                    <label class="radio-inline">
    <?php echo tep_draw_radio_field('gender', 'm', NULL,
        'required aria-required="true"').' '.MALE; ?>
                    </label>
                    <label class="radio-inline">
                    <?php echo tep_draw_radio_field('gender', 'f').' '.FEMALE; ?>
                    </label>
                    <?php echo FORM_REQUIRED_INPUT; ?>
                    <?php if (tep_not_null(ENTRY_GENDER_TEXT)) echo '<span class="help-block">'.ENTRY_GENDER_TEXT.'</span>'; ?>
                </div>
            </div>
    <?php
}
?>
        <div class="form-group has-feedback">
            <label for="inputFirstName" class="control-label col-xs-3"><?php echo ENTRY_FIRST_NAME; ?></label>
            <div class="col-xs-9">
<?php
echo tep_draw_input_field('firstname', NULL,
    'required aria-required="true" id="inputFirstName" placeholder="'.ENTRY_FIRST_NAME.'"');
echo FORM_REQUIRED_INPUT;
if (tep_not_null(ENTRY_FIRST_NAME_TEXT))
        echo '<span class="help-block">'.ENTRY_FIRST_NAME_TEXT.'</span>';
?>
            </div>
        </div>
        <div class="form-group has-feedback">
            <label for="inputLastName" class="control-label col-xs-3"><?php echo ENTRY_LAST_NAME; ?></label>
            <div class="col-xs-9">
<?php
echo tep_draw_input_field('lastname', NULL,
    'required aria-required="true" id="inputLastName" placeholder="'.ENTRY_LAST_NAME.'"');
echo FORM_REQUIRED_INPUT;
if (tep_not_null(ENTRY_LAST_NAME_TEXT))
        echo '<span class="help-block">'.ENTRY_LAST_NAME_TEXT.'</span>';
?>
            </div>
        </div>
        <?php
        if (ACCOUNT_DOB == 'true') {
            ?>
            <div class="form-group has-feedback">
                <label for="dob" class="control-label col-xs-3"><?php echo ENTRY_DATE_OF_BIRTH; ?></label>
                <div class="col-xs-9">
    <?php
    echo tep_draw_input_field('dob', '',
        'required aria-required="true" id="dob" placeholder="'.ENTRY_DATE_OF_BIRTH.'"');
    echo FORM_REQUIRED_INPUT;
    if (tep_not_null(ENTRY_DATE_OF_BIRTH_TEXT))
            echo '<span class="help-block">'.ENTRY_DATE_OF_BIRTH_TEXT.'</span>';
    ?>
                </div>
            </div>
                    <?php
                }
                ?>
        <div class="form-group has-feedback">
            <label for="inputEmail" class="control-label col-xs-3"><?php echo ENTRY_EMAIL_ADDRESS; ?></label>
            <div class="col-xs-9">
<?php
echo tep_draw_input_field('email_address', NULL,
    'required aria-required="true" id="inputEmail" placeholder="'.ENTRY_EMAIL_ADDRESS.'"');
echo FORM_REQUIRED_INPUT;
if (tep_not_null(ENTRY_EMAIL_ADDRESS_TEXT))
        echo '<span class="help-block">'.ENTRY_EMAIL_ADDRESS_TEXT.'</span>';
?>
            </div>
        </div>
<?php
if (ACCOUNT_COMPANY == 'true') {
    ?>

            <div class="form-group">
                <label for="inputCompany" class="control-label col-xs-3"><?php echo ENTRY_COMPANY; ?></label>
                <div class="col-xs-9">
    <?php
    echo tep_draw_input_field('company', NULL,
        'id="inputCompany" placeholder="'.ENTRY_COMPANY.'"');
    if (tep_not_null(ENTRY_COMPANY_TEXT))
            echo '<span class="help-block">'.ENTRY_COMPANY_TEXT.'</span>';
    ?>
                </div>

                <label for="inputVatnumber" class="control-label col-sm-3"><?php echo ENTRY_VAT_NUMBER; ?></label>
                <div class="col-sm-9">
                    <?php
                    echo tep_draw_input_field('vat_number', NULL,
                        'id="inputVatnumber" aria-describedby="atVatnumber" placeholder="'.ENTRY_VAT_NUMBER.'"');
                    if (tep_not_null(ENTRY_VAT_NUMBER_TEXT_2))
                            echo '<span id="atVatnumber" class="help-block">'.ENTRY_VAT_NUMBER_TEXT_2.'</span>';
                    ?>
                </div>


            </div>

                    <?php
                }
                ?>

        <div class="form-group has-feedback">
            <label for="inputStreet" class="control-label col-xs-3"><?php echo ENTRY_STREET_ADDRESS; ?></label>
            <div class="col-xs-9">
<?php
echo tep_draw_input_field('street_address', NULL,
    'required aria-required="true" id="inputStreet" placeholder="'.ENTRY_STREET_ADDRESS.'"');
echo FORM_REQUIRED_INPUT;
if (tep_not_null(ENTRY_STREET_ADDRESS_TEXT))
        echo '<span class="help-block">'.ENTRY_STREET_ADDRESS_TEXT.'</span>';
?>
            </div>
        </div>

        <?php
        if (ACCOUNT_SUBURB == 'true') {
            ?>
            <div class="form-group">
                <label for="inputSuburb" class="control-label col-xs-3"><?php echo ENTRY_SUBURB; ?></label>
                <div class="col-xs-9">
                    <?php
                    echo tep_draw_input_field('suburb', NULL,
                        'id="inputSuburb" placeholder="'.ENTRY_SUBURB.'"');
                    if (tep_not_null(ENTRY_SUBURB_TEXT))
                            echo '<span class="help-block">'.ENTRY_SUBURB_TEXT.'</span>';
                    ?>
                </div>
            </div>
                    <?php
                }
                ?>
        <div class="form-group has-feedback">
            <label for="inputCity" class="control-label col-xs-3"><?php echo ENTRY_CITY; ?></label>
            <div class="col-xs-9">
                <?php
                echo tep_draw_input_field('city', NULL,
                    'required aria-required="true" id="inputCity" placeholder="'.ENTRY_CITY.'"');
                echo FORM_REQUIRED_INPUT;
                if (tep_not_null(ENTRY_CITY_TEXT))
                        echo '<span class="help-block">'.ENTRY_CITY_TEXT.'</span>';
                ?>
            </div>
        </div>
        <div class="form-group has-feedback">
            <label for="inputZip" class="control-label col-xs-3"><?php echo ENTRY_POST_CODE; ?></label>
            <div class="col-xs-9">
<?php
echo tep_draw_input_field('postcode', NULL,
    'required aria-required="true" id="inputZip" placeholder="'.ENTRY_POST_CODE.'"');
echo FORM_REQUIRED_INPUT;
if (tep_not_null(ENTRY_POST_CODE_TEXT))
        echo '<span class="help-block">'.ENTRY_POST_CODE_TEXT.'</span>';
?>
            </div>
        </div>
<?php
if (ACCOUNT_STATE == 'true') {
    ?>
            <div class="form-group has-feedback">
                <label for="inputState" class="control-label col-xs-3"><?php echo ENTRY_STATE; ?></label>
                <div class="col-xs-9">
                <?php
                if ($process == true) {
                    if ($entry_state_has_zones == true) {
                        $zones_array  = array();
                        $zones_query  = tep_db_query("select zone_name from ".TABLE_ZONES." where zone_country_id = '".(int) $country."' order by zone_name");
                        while ($zones_values = tep_db_fetch_array($zones_query)) {
                            $zones_array[] = array('id' => $zones_values['zone_name'],
                                'text' => $zones_values['zone_name']);
                        }
                        echo tep_draw_pull_down_menu('state', $zones_array, 0,
                            'id="inputState"');
                        echo FORM_REQUIRED_INPUT;
                    } else {
                        echo tep_draw_input_field('state', NULL,
                            'id="inputState" placeholder="'.ENTRY_STATE.'"');
                        echo FORM_REQUIRED_INPUT;
                    }
                } else {
                    echo tep_draw_input_field('state', NULL,
                        'id="inputState" placeholder="'.ENTRY_STATE.'"');
                    echo FORM_REQUIRED_INPUT;
                }
                if (tep_not_null(ENTRY_STATE_TEXT))
                        echo '<span class="help-block">'.ENTRY_STATE_TEXT.'</span>';
                ?>
                </div>
            </div>
    <?php
}
?>
        <div class="form-group has-feedback">
            <label for="inputCountry" class="control-label col-xs-3"><?php echo ENTRY_COUNTRY; ?></label>
            <div class="col-xs-9">
<?php
echo tep_get_country_list('country', NULL,
    'required aria-required="true" id="inputCountry"');
echo FORM_REQUIRED_INPUT;
if (tep_not_null(ENTRY_COUNTRY_TEXT))
        echo '<span class="help-block">'.ENTRY_COUNTRY_TEXT.'</span>';
?>
            </div>
        </div>
    </div>

<?php if (GUEST_CHECKOUT_TELEPHONE == 'true') { ?>
        <div class="form-group has-feedback">
            <label for="inputTelephone" class="control-label col-xs-3"><?php echo ENTRY_TELEPHONE_NUMBER; ?></label>
            <div class="col-xs-9">
    <?php
    echo tep_draw_input_field('telephone', NULL,
        'required aria-required="true" id="inputTelephone" placeholder="'.ENTRY_TELEPHONE_NUMBER.'"');
    echo FORM_REQUIRED_INPUT;
    if (tep_not_null(ENTRY_TELEPHONE_NUMBER_TEXT))
            echo '<span class="help-block">'.ENTRY_TELEPHONE_NUMBER_TEXT.'</span>';
    ?>
            </div>
        </div>
<?php } ?>


    <div class="buttonSet">
        <div class="text-right"><?php echo tep_draw_button(IMAGE_BUTTON_CONTINUE,
    'glyphicon glyphicon-user', null, 'primary', null, 'btn-default'); ?></div>
    </div>

</div>

</form>

<?php
require(DIR_WS_INCLUDES.'template_bottom.php');
require(DIR_WS_INCLUDES.'application_bottom.php');
?>