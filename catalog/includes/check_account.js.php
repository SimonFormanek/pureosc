<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2014 osCommerce

  Released under the GNU General Public License
 */
?>
        <script><!--
var form = "";
            var submitted = false;
            var error = false;
            var error_message = "";

            function check_input(field_name, field_size, message) {
                if (form.elements[field_name] && (form.elements[field_name].type != "hidden")) {
                    var field_value = form.elements[field_name].value;

                    if (field_value.length < field_size) {
                        error_message = error_message + "* " + message + "\n";
                        error = true;
                    }
                }
            }

            function check_radio(field_name, message) {
                var isChecked = false;

                if (form.elements[field_name] && (form.elements[field_name].type != "hidden")) {
                    var radio = form.elements[field_name];

                    for (var i = 0; i < radio.length; i++) {
                        if (radio[i].checked === true) {
                            isChecked = true;
                            break;
                        }
                    }

                    if (isChecked === false) {
                        error_message = error_message + "* " + message + "\n";
                        error = true;
                    }
                }
            }

            function check_select(field_name, field_default, message) {
                if (form.elements[field_name] && (form.elements[field_name].type != "hidden")) {
                    var field_value = form.elements[field_name].value;

                    if (field_value == field_default) {
                        error_message = error_message + "* " + message + "\n";
                        error = true;
                    }
                }
            }


            function check_form(form_name) {
                if (submitted === true) {
                    alert("<?php echo JS_ERROR_SUBMITTED; ?>");
                    return false;
                }

                error = false;
                form = form_name;
                error_message = "<?php echo JS_ERROR; ?>";

<?php if (ACCOUNT_GENDER == 'true') echo '  check_radio("gender", "'.ENTRY_GENDER_ERROR.'");'."\n"; ?>

                check_input("firstname", <?php echo ENTRY_FIRST_NAME_MIN_LENGTH; ?>, "<?php echo ENTRY_FIRST_NAME_ERROR; ?>");
                check_input("lastname", <?php echo ENTRY_LAST_NAME_MIN_LENGTH; ?>, "<?php echo ENTRY_LAST_NAME_ERROR; ?>");

<?php if (ACCOUNT_DOB == 'true') echo '  check_input("dob", '.ENTRY_DOB_MIN_LENGTH.', "'.ENTRY_DATE_OF_BIRTH_ERROR.'");'."\n"; ?>

                check_input("email_address", <?php echo ENTRY_EMAIL_ADDRESS_MIN_LENGTH; ?>, "<?php echo ENTRY_EMAIL_ADDRESS_ERROR; ?>");
                check_input("street_address", <?php echo ENTRY_STREET_ADDRESS_MIN_LENGTH; ?>, "<?php echo ENTRY_STREET_ADDRESS_ERROR; ?>");
                check_input("postcode", <?php echo ENTRY_POSTCODE_MIN_LENGTH; ?>, "<?php echo ENTRY_POST_CODE_ERROR; ?>");
                check_input("city", <?php echo ENTRY_CITY_MIN_LENGTH; ?>, "<?php echo ENTRY_CITY_ERROR; ?>");

<?php if (ACCOUNT_STATE == 'true') echo '  check_input("state", '.ENTRY_STATE_MIN_LENGTH.', "'.ENTRY_STATE_ERROR.'");'."\n"; ?>

                check_select("country", "", "<?php echo ENTRY_COUNTRY_ERROR; ?>");

<?php if (GUEST_CHECKOUT_TELEPHONE == 'true') echo ' check_input("telephone", '.ENTRY_TELEPHONE_MIN_LENGTH.', "'.ENTRY_TELEPHONE_NUMBER_ERROR.'");'; ?>

                if (error === true) {
                    alert(error_message);
                    return false;
                } else {
                    submitted = true;
                    return true;
                }
            }
//--></script>
