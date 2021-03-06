<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2013 osCommerce

  Edited by 2014 Newburns Design and Technology
 * ************************************************
 * *********** New addon definitions **************
 * ***********        Below          **************
 * ************************************************
  Credit Class, Gift Vouchers & Discount Coupons osC2.3.3.4 (CCGV) added -- http://addons.oscommerce.com/info/9020
  Mail Manager added -- http://addons.oscommerce.com/info/9133/v,23

  Released under the GNU General Public License
 */

require_once('includes/application_top.php');

// needs to be included earlier to set the success message in the messageStack
require(DIR_WS_LANGUAGES.$language.'/'.FILENAME_CREATE_ACCOUNT);

$process = false;
if (isset($_POST['action']) && ($_POST['action'] == 'process') && isset($_POST['formid'])
    && ($_POST['formid'] == $sessiontoken)) {
  
    $process = true;

    if (cfg('ACCOUNT_GENDER') == 'true') {
        if (isset($_POST['gender'])) {
            $gender = tep_db_prepare_input($_POST['gender']);
        } else {
            $gender = false;
        }
    }
    $firstname     = tep_db_prepare_input($_POST['firstname']);
    $lastname      = tep_db_prepare_input($_POST['lastname']);
    if (cfg('ACCOUNT_DOB') == 'true')
        $dob = tep_db_prepare_input($_POST['dob']);
    $email_address = tep_db_prepare_input($_POST['email_address']);
    if (cfg('ACCOUNT_COMPANY') == 'true')
            $company       = tep_db_prepare_input($_POST['company']);
    if (cfg('ACCOUNT_COMPANY') == 'true') {
        $vat_number     = tep_db_prepare_input($_POST['vat_number']);
        $company_number = tep_db_prepare_input($_POST['company_number']);
    }
    $street_address = tep_db_prepare_input($_POST['street_address']);
    if (cfg('ACCOUNT_SUBURB') == 'true')
            $suburb         = tep_db_prepare_input($_POST['suburb']);
    $postcode       = tep_db_prepare_input($_POST['postcode']);
    $city           = tep_db_prepare_input($_POST['city']);
    if (cfg('ACCOUNT_STATE') == 'true') {
        $state = tep_db_prepare_input($_POST['state']);
        if (isset($_POST['zone_id'])) {
            $zone_id = tep_db_prepare_input($_POST['zone_id']);
        } else {
            $zone_id = false;
        }
    }
    $country   = tep_db_prepare_input($_POST['country']);
    $telephone = tep_db_prepare_input($_POST['telephone']);
    $fax       = tep_db_prepare_input($_POST['fax']);
    if (isset($_POST['newsletter'])) {
        $newsletter = tep_db_prepare_input($_POST['newsletter']);
    } else {
        $newsletter = false;
    }
    $password     = tep_db_prepare_input($_POST['password']);
    $confirmation = tep_db_prepare_input($_POST['confirmation']);

    $error = false;

    if (cfg('ACCOUNT_GENDER') == 'true') {
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

    if (cfg('ACCOUNT_DOB') == 'true') {
        if ((strlen($dob) < cfg('ENTRY_DOB_MIN_LENGTH')) || (!empty($dob) && (!is_numeric(tep_date_raw($dob)) || !@checkdate(substr(tep_date_raw($dob), 4, 2),
                substr(tep_date_raw($dob), 6, 2),
                substr(tep_date_raw($dob), 0, 4))))) {
            $error = true;

            $messageStack->add('create_account', __('ENTRY_DATE_OF_BIRTH_ERROR', _('Your Date of Birth must be in this format: MM/DD/YYYY (eg 05/21/1970)')));
        }
    }

    if (strlen($email_address) < ENTRY_EMAIL_ADDRESS_MIN_LENGTH) {
        $error = true;

        $messageStack->add('create_account', ENTRY_EMAIL_ADDRESS_ERROR);
    } elseif (tep_validate_email($email_address) === false) {
        $error = true;

        $messageStack->add('create_account', __('ENTRY_EMAIL_ADDRESS_CHECK_ERROR', _('Your E-Mail Address does not appear to be valid - please make any necessary corrections.')));
    } else {
        $check_email_query = tep_db_query("select count(*) as total from " . cfg('TABLE_CUSTOMERS') . " where customers_email_address = '" . tep_db_input($email_address) . "'");
        $check_email       = tep_db_fetch_array($check_email_query);
        if ($check_email['total'] > 0) {
            $error = true;

            $messageStack->add('create_account',
                    __('ENTRY_EMAIL_ADDRESS_ERROR_EXISTS', _('Your E-Mail Address already exists in our records - please log in with the e-mail address or create an account with a different address.')));
        }
    }

    if (strlen($street_address) < cfg('ENTRY_STREET_ADDRESS_MIN_LENGTH')) {
        $error = true;

        $messageStack->add('create_account', ENTRY_STREET_ADDRESS_ERROR);
    }

    if (strlen($postcode) < ENTRY_POSTCODE_MIN_LENGTH) {
        $error = true;

        $messageStack->add('create_account', __('ENTRY_POST_CODE_ERROR', sprintf(_('Your Post Code must contain a minimum of %s characters'), cfg('ENTRY_POSTCODE_MIN_LENGTH'))));
    }

    if (strlen($city) < cfg('ENTRY_CITY_MIN_LENGTH')) {
        $error = true;

        $messageStack->add('create_account', __('ENTRY_CITY_ERROR', sprintf(_('Your City must contain a minimum of %d characters.'), cfg('ENTRY_CITY_MIN_LENGTH'))));
    }

    if (is_numeric($country) === false) {
        $error = true;

        $messageStack->add('create_account', __('ENTRY_COUNTRY_ERROR', _('You must select a country from the Countries pull down menu.')));
    }

    if (cfg('ACCOUNT_STATE') == 'true') {
        $zone_id               = 0;
        $check_query           = tep_db_query("select count(*) as total from ".TABLE_ZONES." where zone_country_id = '".(int) $country."'");
        $check                 = tep_db_fetch_array($check_query);
        $entry_state_has_zones = ($check['total'] > 0);
        if ($entry_state_has_zones === true) {
            $zone_query = tep_db_query("select distinct zone_id from ".TABLE_ZONES." where zone_country_id = '".(int) $country."' and (zone_name = '".tep_db_input($state)."' or zone_code = '".tep_db_input($state)."')");
            if (tep_db_num_rows($zone_query) == 1) {
                $zone    = tep_db_fetch_array($zone_query);
                $zone_id = $zone['zone_id'];
            } else {
                $error = true;

                $messageStack->add('create_account', __('ENTRY_STATE_ERROR_SELECT', _('Please select a state from the States pull down menu.')));
            }
        } else {
            if (strlen($state) < cfg('ENTRY_STATE_MIN_LENGTH')) {
                $error = true;

                $messageStack->add('create_account', ENTRY_STATE_ERROR);
            }
        }
    }

    if (strlen($telephone) < cfg('ENTRY_TELEPHONE_MIN_LENGTH')) {
        $error = true;

        $messageStack->add('create_account', __('ENTRY_TELEPHONE_NUMBER_ERROR', sprintf('Your Telephone Number must contain a minimum of %d characters.', cfg('ENTRY_TELEPHONE_MIN_LENGTH'))));
    }


    if (strlen($password) < cfg('ENTRY_PASSWORD_MIN_LENGTH')) {
        $error = true;

        $messageStack->add('create_account', ENTRY_PASSWORD_ERROR);
    } elseif ($password != $confirmation) {
        $error = true;

        $messageStack->add('create_account', ENTRY_PASSWORD_ERROR_NOT_MATCHING);
    }

    if ($error === false) {
        $sql_data_array = array('customers_firstname' => $firstname,
            'customers_lastname' => $lastname,
            'customers_email_address' => $email_address,
            'customers_telephone' => $telephone,
            'customers_fax' => $fax,
            'customers_newsletter' => $newsletter,
            'customers_password' => tep_encrypt_password($password));

        if (cfg('ACCOUNT_GENDER') == 'true') {
                $sql_data_array['customers_gender'] = $gender;
        }
        if (cfg('ACCOUNT_DOB') == 'true') {
                $sql_data_array['customers_dob']    = tep_date_raw($dob);
        }

        $sqlResult = tep_db_perform(cfg('TABLE_CUSTOMERS'), $sql_data_array);

        $customer_id = tep_db_insert_id();

        $userLog->setCustomerID($customer_id);
        $userLog->logMySQLEvent(cfg('TABLE_CUSTOMERS'), 'customers_password',
            $customer_id, 'created');
        $userLog->logMySQLEvent(cfg('TABLE_CUSTOMERS'), 'customers_firstname',
            $customer_id, 'created');
        $userLog->logMySQLEvent(cfg('TABLE_CUSTOMERS'), 'customers_lastname',
            $customer_id, 'created');
        $userLog->logMySQLEvent(cfg('TABLE_CUSTOMERS'), 'customers_telephone',
            $customer_id, 'created');
        $userLog->logMySQLEvent(cfg('TABLE_CUSTOMERS'), 'customers_newsletter',
            $customer_id, $newsletter);


        if (cfg('USE_FLEXIBEE') == 'true') {

            $nazev = strlen($company) ? $company : $firstname.' '.$lastname;

            $adresar = new \PureOSC\flexibee\Adresar([
                'id' => 'ext:customers:'.$customer_id,
                'poznam' => 'zalozeno z eshopu',
                'nazev' => $nazev,
                'email' => $email_address,
                'ic' => $company_number,
                'dic' => $vat_number,
                'ulice' => $street_address,
                'mesto' => $city,
                'psc' => $postcode,
//            'stat' => $country,
                'tel' => $telephone,
                'fax' => $fax,
            ]);

            $adresar->insertToFlexiBee();

            if ($adresar->lastResponseCode == 201) {
                $userLog->logFlexiBeeEvent($adresar,
                    ['nazev', 'email', 'ic', 'dic']);
            }
        }


        $sql_data_array = array('customers_id' => $customer_id,
            'entry_firstname' => $firstname,
            'entry_lastname' => $lastname,
            'entry_vat_number' => $vat_number,
            'entry_company_number' => $company_number,
            'entry_street_address' => $street_address,
            'entry_postcode' => $postcode,
            'entry_city' => $city,
            'entry_country_id' => $country);

        if (cfg('ACCOUNT_GENDER') == 'true') {
            $sql_data_array['entry_gender'] = $gender;
        }
        if (cfg('ACCOUNT_COMPANY') == 'true') {
                $sql_data_array['entry_company'] = $company;
        }
        if (cfg('ACCOUNT_COMPANY') == 'true') {
            $sql_data_array['entry_vat_number']     = $vat_number;
            $sql_data_array['entry_company_number'] = $company_number;
        }
        if (cfg('ACCOUNT_SUBURB') == 'true') {
            $sql_data_array['entry_suburb'] = $suburb;
        }
        if (cfg('ACCOUNT_STATE') == 'true') {
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

        if (cfg('USE_FLEXIBEE') == 'true') {
            $kontakter = new \PureOSC\flexibee\Kontakt([
                'id' => 'ext:customers:'.$addres_id,
                'firma' => $adresar,
                'jmeno' => $firstname,
                'prijmeni' => $lastname,
                'email' => $email_address,
                'ulice' => $street_address,
                'mesto' => $city,
                'psc' => $postcode,
//            'stat' => $country,
                'tel' => $telephone,
                'fax' => $fax]);

            $kontakter->insertToFlexiBee();

            if ($kontakter->lastResponseCode == 201) {
                $userLog->logFlexiBeeEvent($kontakter,
                    ['jmeno', 'prijmeni', 'email']);
            }
        }

        tep_db_query("update " . cfg('TABLE_CUSTOMERS') . " set customers_default_address_id = '" . (int) $address_id . "' where customers_id = '" . (int) $customer_id . "'");

        tep_db_query("insert into ".TABLE_CUSTOMERS_INFO." (customers_info_id, customers_info_number_of_logons, customers_info_date_account_created) values ('".(int) $customer_id."', '0', now())");

        if (cfg('SESSION_RECREATE') == 'True') {
            tep_session_recreate();
        }

        $customer_first_name         = $firstname;
        $customer_default_address_id = $address_id;
        $customer_country_id         = $country;
        $customer_zone_id            = $zone_id;
        tep_session_register('customer_id');
        tep_session_register('customer_first_name');
        tep_session_register('customer_default_address_id');
        tep_session_register('customer_country_id');
        tep_session_register('customer_zone_id');

// reset session token
        $sessiontoken = md5(tep_rand().tep_rand().tep_rand().tep_rand());

// restore cart contents
        $cart->restore_contents();

// build the message content
        $name = $firstname.' '.$lastname;

        if (cfg('ACCOUNT_GENDER') == 'true') {
            if ($gender == 'm') {
                $email_text = sprintf(EMAIL_GREET_MR, $lastname);
            } else {
                $email_text = sprintf(EMAIL_GREET_MS, $lastname);
            }
        } else {
            $email_text = sprintf(EMAIL_GREET_NONE, $firstname);
        }

        $email_text .= EMAIL_WELCOME.EMAIL_TEXT.EMAIL_CONTACT.EMAIL_WARNING;
        /*         * * Altered for CCGV ** */
        if (cfg('NEW_SIGNUP_GIFT_VOUCHER_AMOUNT') > 0) {
            $coupon_code  = create_coupon_code();
            $insert_query = tep_db_query("insert into ".TABLE_COUPONS." (coupon_code, coupon_type, coupon_amount, date_created) values ('".$coupon_code."', 'G', '".NEW_SIGNUP_GIFT_VOUCHER_AMOUNT."', now())");
            $coupon_id    = tep_db_insert_id();
            $insert_query = tep_db_query("insert into ".TABLE_COUPON_EMAIL_TRACK." (coupon_id, customer_id_sent, sent_firstname, sent_lastname, emailed_to, date_sent) values ('".(int) $coupon_id."', '".(int) $customer_id."', '".$firstname."', '".$lastname."', '".$email_address."', now() )");
            $email_text   .= sprintf(EMAIL_GV_INCENTIVE_HEADER,
                            $currencies->format(cfg('NEW_SIGNUP_GIFT_VOUCHER_AMOUNT'))) . "\n\n" .
                    sprintf(_('The redeem code for the e-Gift Voucher is %s, you can enter the redeem code when checking out while making a purchase'), $coupon_code) . "\n\n" .
                STORE_NAME.
                "\n\n";
        }
        if (cfg('NEW_SIGNUP_DISCOUNT_COUPON') != '') {
            $coupon_code = cfg('NEW_SIGNUP_DISCOUNT_COUPON');
            $coupon_query      = tep_db_query("select * from ".TABLE_COUPONS." where coupon_active = 'Y' and coupon_status = '1' and coupon_code = '".$coupon_code."'");
            $coupon            = tep_db_fetch_array($coupon_query);
            $coupon_id         = $coupon['coupon_id'];
            $coupon_desc_query = tep_db_query("select * from ".TABLE_COUPONS_DESCRIPTION." where coupon_id = '".(int) $coupon_id."' and language_id = '".(int) $languages_id."'");
            $coupon_desc       = tep_db_fetch_array($coupon_desc_query);
            $insert_query      = tep_db_query("insert into ".TABLE_COUPON_EMAIL_TRACK." (coupon_id, customer_id_sent, sent_firstname, sent_lastname, emailed_to, date_sent) values ('".(int) $coupon_id."', '".(int) $customer_id."', '".$firstname."', '".$lastname."', '".$email_address."', now() )");
            $email_text        .= EMAIL_COUPON_INCENTIVE_HEADER."\n".
                sprintf("%s", $coupon_desc['coupon_description'])."\n\n".
                sprintf(EMAIL_COUPON_REDEEM, $coupon['coupon_code'])."\n\n".
                STORE_NAME.
                "\n\n";
        }
        /*         * * EOF alteration for CCGV ** */
        /*         * * Altered for Mail Manager **
          tep_mail($name, $email_address, EMAIL_SUBJECT, $email_text, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);
         */
        if (file_exists(DIR_WS_MODULES . 'mail_manager/create_account.php') && EMAIL_USE_HTML == 'true') {
            include(DIR_WS_MODULES.'mail_manager/create_account.php');
        } else {
            tep_mail($name, $email_address, EMAIL_SUBJECT, $email_text,
                STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);
        }
        /*         * * EOF alterations for Mail Manager ** */

        if ($newsletter !== false) {
            $gdprNewsLetterConsentReq = new \PureOSC\NewsletterConsentMailer($customer_id,
                $email_address, $name);
            $gdprNewsLetterConsentReq->send();
        }

        tep_redirect(tep_href_link(cfg('FILENAME_CREATE_ACCOUNT_SUCCESS'), '', 'SSL'));
    }
}

$breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_CREATE_ACCOUNT, '', 'SSL'));

require(DIR_WS_INCLUDES.'template_top.php');
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
    <?php
    echo sprintf(TEXT_ORIGIN_LOGIN,
        tep_href_link(FILENAME_LOGIN, tep_get_all_get_params(), 'SSL'));
    ?><span class="inputRequirement pull-right text-right"><?php echo _('Requied Information'); ?></span>
</div>

<?php
echo tep_draw_form('create_account',
    tep_href_link(FILENAME_CREATE_ACCOUNT, '', 'SSL'), 'post',
    'class="form-horizontal"', true).tep_draw_hidden_field('action', 'process');
?>

<div class="contentContainer">

    <h2><?php echo CATEGORY_PERSONAL; ?></h2>
    <div class="contentText">

        <?php
        if (ACCOUNT_GENDER == 'true') {
            ?>
            <div class="form-group has-feedback">
                <label class="control-label col-sm-3"><?php echo ENTRY_GENDER; ?></label>
                <div class="col-sm-9">
                    <label class="radio-inline">
                        <?php
                        echo tep_draw_radio_field('gender', 'm', NULL,
                            'required aria-required="true" aria-describedby="atGender"').' '.MALE;
                        ?>
                    </label>
                    <label class="radio-inline">
                        <?php
                        echo tep_draw_radio_field('gender', 'f').' '.FEMALE;
                        ?>
                    </label>
                    <?php echo _('Required'); ?>
                    <?php if (tep_not_null(ENTRY_GENDER_TEXT)) echo '<span id="atGender" class="help-block">'.ENTRY_GENDER_TEXT.'</span>'; ?>
                </div>
            </div>
            <?php
        }
        ?>
        <div class="form-group has-feedback">
            <label for="inputFirstName" class="control-label col-sm-3"><?php echo ENTRY_FIRST_NAME; ?></label>
            <div class="col-sm-9">
                <?php
                echo tep_draw_input_field('firstname', NULL,
                    'required aria-required="true" aria-describedby="atFirstname" id="inputFirstName" placeholder="'.ENTRY_FIRST_NAME.'"');
                echo _('Required');
                if (tep_not_null(ENTRY_FIRST_NAME_TEXT))
                        echo '<span id="atFirstName" class="help-block">'.ENTRY_FIRST_NAME_TEXT.'</span>';
                ?>
            </div>
        </div>
        <div class="form-group has-feedback">
            <label for="inputLastName" class="control-label col-sm-3"><?php echo ENTRY_LAST_NAME; ?></label>
            <div class="col-sm-9">
                <?php
                echo tep_draw_input_field('lastname', NULL,
                    'required aria-required="true" aria-describedby="atLastname" id="inputLastName" placeholder="'.ENTRY_LAST_NAME.'"');
                echo _('Required');
                if (tep_not_null(ENTRY_LAST_NAME_TEXT))
                        echo '<span id="atLastname" class="help-block">'.ENTRY_LAST_NAME_TEXT.'</span>';
                ?>
            </div>
        </div>
        <?php
        if (ACCOUNT_DOB == 'true') {
            ?>
            <div class="form-group has-feedback">
                <label for="dob" class="control-label col-sm-3"><?php echo ENTRY_DATE_OF_BIRTH; ?></label>
                <div class="col-sm-9">
                    <?php
                    echo tep_draw_input_field('dob', '',
                        'required aria-required="true" aria-describedby="atDob" id="dob" placeholder="'.ENTRY_DATE_OF_BIRTH.'"');
                    echo _('Required');
                    if (tep_not_null(ENTRY_DATE_OF_BIRTH_TEXT))
                            echo '<span id="atDob" class="help-block">'.ENTRY_DATE_OF_BIRTH_TEXT.'</span>';
                    ?>
                </div>
            </div>
            <?php
        }
        ?>
        <div class="form-group has-feedback">
            <label for="inputEmail" class="control-label col-sm-3"><?php echo _('E-Mail Address'); ?></label>
            <div class="col-sm-9">
                <?php
                echo tep_draw_input_field('email_address', NULL,
                    'required aria-required="true" aria-describedby="atEmail" id="inputEmail" placeholder="'._('E-Mail Address').'"',
                    'email');
                echo _('Required');
                if (tep_not_null(ENTRY_EMAIL_ADDRESS_TEXT))
                        echo '<span id="atEmail" class="help-block">'.ENTRY_EMAIL_ADDRESS_TEXT.'</span>';
                ?>
            </div>
        </div>
    </div>
    <?php
    if (ACCOUNT_COMPANY == 'true') {
        ?>

        <h2><?php echo CATEGORY_COMPANY; ?></h2>

        <div class="contentText">
            <div class="form-group">
                <label for="inputCompany" class="control-label col-sm-3"><?php echo _('Company Name'); ?></label>
                <div class="col-sm-9">
                    <?php
                    echo tep_draw_input_field('company', NULL,
                        'id="inputCompany" aria-describedby="atCompany" placeholder="'._('Company Name').'"');
                    if (tep_not_null(ENTRY_COMPANY_TEXT))
                            echo '<span id="atCompany" class="help-block">'.ENTRY_COMPANY_TEXT.'</span>';
                    ?>
                </div>

                <label for="inputVatnumber" class="control-label col-sm-3"><?php echo _('Vat Number'); ?></label>
                <div class="col-sm-9">
                    <?php
                    echo tep_draw_input_field('vat_number', NULL,
                        'id="inputVatnumber" aria-describedby="atVatnumber" placeholder="'._('Vat Number').'"');
                    if (tep_not_null(ENTRY_VAT_NUMBER_TEXT_2))
                            echo '<span id="atVatnumber" class="help-block">'.ENTRY_VAT_NUMBER_TEXT_2.'</span>';
                    ?>
                </div>

                <label for="inputVatnumber" class="control-label col-sm-3"><?php echo _('Company number'); ?></label>
                <div class="col-sm-9">
                    <?php
                    echo tep_draw_input_field('company_number', NULL,
                        'id="inputVatnumber" aria-describedby="atVatnumber" placeholder="'. _('Company Number') .'"');
                    if (!empty(_('Company Number2')))
                            echo '<span id="atVatnumber" class="help-block">'. _('Company Number') .'</span>';
                    ?>
                </div>


            </div>
        </div>

        <?php
    }
    ?>

    <h2><?php echo CATEGORY_ADDRESS; ?></h2>
    <div class="contentText">
        <div class="form-group has-feedback">
            <label for="inputStreet" class="control-label col-sm-3"><?php echo ENTRY_STREET_ADDRESS; ?></label>
            <div class="col-sm-9">
                <?php
                echo tep_draw_input_field('street_address', NULL,
                    'required aria-required="true" aria-describedby="atStreetAddress" id="inputStreet" placeholder="'.ENTRY_STREET_ADDRESS.'"');
                echo _('Required');
                if (tep_not_null(ENTRY_STREET_ADDRESS_TEXT))
                        echo '<span id="atStreetAddress" class="help-block">'.ENTRY_STREET_ADDRESS_TEXT.'</span>';
                ?>
            </div>
        </div>

        <?php
        if (ACCOUNT_SUBURB == 'true') {
            ?>
            <div class="form-group">
                <label for="inputSuburb" class="control-label col-sm-3"><?php echo ENTRY_SUBURB; ?></label>
                <div class="col-sm-9">
                    <?php
                    echo tep_draw_input_field('suburb', NULL,
                        'id="inputSuburb" aria-describedby="atSuburb" placeholder="'.ENTRY_SUBURB.'"');
                    if (tep_not_null(ENTRY_SUBURB_TEXT))
                            echo '<span id="atSuburb" class="help-block">'.ENTRY_SUBURB_TEXT.'</span>';
                    ?>
                </div>
            </div>
            <?php
        }
        ?>
        <div class="form-group has-feedback">
            <label for="inputCity" class="control-label col-sm-3"><?php echo ENTRY_CITY; ?></label>
            <div class="col-sm-9">
                <?php
                echo tep_draw_input_field('city', NULL,
                    'required aria-required="true" aria-describedby="atCity" id="inputCity" placeholder="'.ENTRY_CITY.'"');
                echo _('Required');
                if (tep_not_null(ENTRY_CITY_TEXT))
                        echo '<span id="atCity" class="help-block">'.ENTRY_CITY_TEXT.'</span>';
                ?>
            </div>
        </div>
        <div class="form-group has-feedback">
            <label for="inputZip" class="control-label col-sm-3"><?php echo ENTRY_POST_CODE; ?></label>
            <div class="col-sm-9">
                <?php
                echo tep_draw_input_field('postcode', NULL,
                    'required aria-required="true" aria-describedby="atZip" id="inputZip" placeholder="'.ENTRY_POST_CODE.'"');
                echo _('Required');
                if (tep_not_null(ENTRY_POST_CODE_TEXT))
                        echo '<span id="atZip" class="help-block">'.ENTRY_POST_CODE_TEXT.'</span>';
                ?>
            </div>
        </div>
        <?php
        if (ACCOUNT_STATE == 'true') {
            ?>
            <div class="form-group has-feedback">
                <label for="inputState" class="control-label col-sm-3"><?php echo ENTRY_STATE; ?></label>
                <div class="col-sm-9">
                    <?php
                    if ($process === true) {
                        if ($entry_state_has_zones === true) {
                            $zones_array  = array();
                            $zones_query  = tep_db_query("select zone_name from ".TABLE_ZONES." where zone_country_id = '".(int) $country."' order by zone_name");
                            while ($zones_values = tep_db_fetch_array($zones_query)) {
                                $zones_array[] = array('id' => $zones_values['zone_name'],
                                    'text' => $zones_values['zone_name']);
                            }
                            echo tep_draw_pull_down_menu('state', $zones_array,
                                0, 'id="inputState" aria-describedby="atState"');
                            echo _('Required');
                        } else {
                            echo tep_draw_input_field('state', NULL,
                                'id="inputState" aria-describedby="atState" placeholder="'.ENTRY_STATE.'"');
                            echo _('Required');
                        }
                    } else {
                        echo tep_draw_input_field('state', NULL,
                            'id="inputState" aria-describedby="atState" placeholder="'.ENTRY_STATE.'"');
                        echo _('Required');
                    }
                    if (tep_not_null(ENTRY_STATE_TEXT))
                            echo '<span id="atState" class="help-block">'.ENTRY_STATE_TEXT.'</span>';
                    ?>
                </div>
            </div>
            <?php
        }
        ?>
        <div class="form-group has-feedback">
            <label for="inputCountry" class="control-label col-sm-3"><?php echo ENTRY_COUNTRY; ?></label>
            <div class="col-sm-9">
                <?php
                echo tep_get_country_list('country', NULL,
                    'required aria-required="true" aria-describedby="atCountry" id="inputCountry"');
                echo _('Required');
                if (tep_not_null(ENTRY_COUNTRY_TEXT))
                        echo '<span id="atCountry" class="help-block">'.ENTRY_COUNTRY_TEXT.'</span>';
                ?>
            </div>
        </div>
    </div>

    <h2><?php echo CATEGORY_CONTACT; ?></h2>

    <div class="contentText">
        <div class="form-group has-feedback">
            <label for="inputTelephone" class="control-label col-sm-3"><?php echo ENTRY_TELEPHONE_NUMBER; ?></label>
            <div class="col-sm-9">
                <?php
                echo tep_draw_input_field('telephone', NULL,
                    'required aria-required="true" aria-describedby="atTelephone" id="inputTelephone" placeholder="'.ENTRY_TELEPHONE_NUMBER.'"',
                    'tel');
                echo _('Required');
                if (tep_not_null(ENTRY_TELEPHONE_NUMBER_TEXT))
                        echo '<span id="atTelephone" class="help-block">'.ENTRY_TELEPHONE_NUMBER_TEXT.'</span>';
                ?>
            </div>
        </div>
        <div class="form-group">
            <label for="inputFax" class="control-label col-sm-3"><?php echo ENTRY_FAX_NUMBER; ?></label>
            <div class="col-sm-9">
                <?php
                echo tep_draw_input_field('fax', '',
                    'id="inputFax" aria-describedby="atFax" placeholder="'.ENTRY_FAX_NUMBER.'"',
                    'tel');
                if (tep_not_null(ENTRY_FAX_NUMBER_TEXT))
                        echo '<span id="atFax" class="help-block">'.ENTRY_FAX_NUMBER_TEXT.'</span>';
                ?>
            </div>
        </div>
        <div class="form-group">
            <label for="inputNewsletter" class="control-label col-sm-3"><?php echo ENTRY_NEWSLETTER; ?></label>
            <div class="col-sm-9">
                <div class="checkbox">
                    <label>
                        <?php
                        echo tep_draw_checkbox_field('newsletter', '1', NULL,
                            'id="inputNewsletter"');
                        ?>
                        <?php if (tep_not_null(ENTRY_NEWSLETTER_TEXT)) echo ENTRY_NEWSLETTER_TEXT; ?>
                    </label>
                </div>
            </div>
        </div>

    </div>

    <h2><?php echo CATEGORY_PASSWORD; ?></h2>

    <div class="contentText">
        <div class="form-group has-feedback">
            <label for="inputPassword" class="control-label col-sm-3"><?php echo ENTRY_PASSWORD; ?></label>
            <div class="col-sm-9">
                <?php
                echo tep_draw_input_field('password', NULL,
                    'required aria-required="true" aria-describedby="atPassword" id="inputPassword" placeholder="'.ENTRY_PASSWORD.'"',
                    'password');
                echo _('Required');
                if (tep_not_null(ENTRY_PASSWORD_TEXT))
                        echo '<span id="atPassword" class="help-block">'.ENTRY_PASSWORD_TEXT.'</span>';
                ?>
            </div>
        </div>
        <div class="form-group has-feedback">
            <label for="inputConfirmation" class="control-label col-sm-3"><?php echo ENTRY_PASSWORD_CONFIRMATION; ?></label>
            <div class="col-sm-9">
                <?php
                echo tep_draw_input_field('confirmation', NULL,
                    'required aria-required="true" aria-describedby="atPasswordNew" id="inputConfirmation" placeholder="'.ENTRY_PASSWORD_CONFIRMATION.'"',
                    'password');
                echo _('Required');
                if (tep_not_null(ENTRY_PASSWORD_CONFIRMATION_TEXT))
                        echo '<span id="atPasswordNew" class="help-block">'.ENTRY_PASSWORD_CONFIRMATION_TEXT.'</span>';
                ?>
            </div>
        </div>
    </div>

    <div class="buttonSet">
        <div class="text-right"><?php
            echo tep_draw_button(IMAGE_BUTTON_CONTINUE, 'fa fa-user', null,
                'primary', null, 'btn-success');
            ?></div>
    </div>

</div>

</form>

<?php
require(DIR_WS_INCLUDES.'template_bottom.php');
require(DIR_WS_INCLUDES.'application_bottom.php');
?>
