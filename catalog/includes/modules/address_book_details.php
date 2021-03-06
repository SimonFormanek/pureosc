<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2010 osCommerce

  Released under the GNU General Public License
 */

if (!isset($process)) $process = false;
?>

<p class="text-right"><?php echo _('Requied Information'); ?></p>

<div class="contentText">

    <?php
    if (ACCOUNT_GENDER == 'true') {
        $male   = $female = false;
        if (isset($gender)) {
            $male   = ($gender == 'm') ? true : false;
            $female = !$male;
        } elseif (isset($entry['entry_gender'])) {
            $male   = ($entry['entry_gender'] == 'm') ? true : false;
            $female = !$male;
        }
        ?>

        <div class="form-group has-feedback">
            <label class="control-label col-sm-3"><?php echo ENTRY_GENDER; ?></label>
            <div class="col-sm-9">
                <label class="radio-inline">
                    <?php
                    echo tep_draw_radio_field('gender', 'm', $male,
                        'required aria-required="true" aria-describedby="atGender"').' '.MALE;
                    ?>
                </label>
                <label class="radio-inline">
                    <?php echo tep_draw_radio_field('gender',
                        'f', $female).' '.FEMALE;
                    ?>
                </label>
    &#10033;
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
            echo tep_draw_input_field('firstname',
                (isset($entry['entry_firstname']) ? $entry['entry_firstname'] : ''),
                'required aria-required="true" aria-describedby="atFirstName" id="inputFirstName" placeholder="'.ENTRY_FIRST_NAME.'"');
            ?>
&#10033;
<?php if (tep_not_null(ENTRY_FIRST_NAME_TEXT)) echo '<span id="atFirstName" class="help-block">'.ENTRY_FIRST_NAME_TEXT.'</span>'; ?>
        </div>
    </div>
    <div class="form-group has-feedback">
        <label for="inputLastName" class="control-label col-sm-3"><?php echo ENTRY_LAST_NAME; ?></label>
        <div class="col-sm-9">
            <?php
            echo tep_draw_input_field('lastname',
                (isset($entry['entry_lastname']) ? $entry['entry_lastname'] : ''),
                'required aria-required="true" aria-describedby="atLastName" id="inputLastName" placeholder="'.ENTRY_LAST_NAME.'"');
            ?>
    &#10033;
    <?php if (tep_not_null(ENTRY_LAST_NAME_TEXT)) echo '<span id="atLastName" class="help-block">'.ENTRY_LAST_NAME_TEXT.'</span>'; ?>
        </div>
    </div>

            <?php
            if (ACCOUNT_COMPANY == 'true') {
                ?>

        <div class="form-group">
            <label for="inputCompany" class="control-label col-sm-3"><?php echo _('Company Name'); ?></label>
            <div class="col-sm-9">
                <?php
                echo tep_draw_input_field('company',
                    (isset($entry['entry_company']) ? $entry['entry_company'] : ''),
                    'id="inputCompany" aria-describedby="atCompany" placeholder="'._('Company Name').'"');
                if (tep_not_null(ENTRY_COMPANY_TEXT))
                        echo '<span id="atCompany" class="help-block">'.ENTRY_COMPANY_TEXT.'</span>';
                ?>
            </div>

            <label for="inputVatnumber" class="control-label col-sm-3"><?php echo _('Vat Number'); ?></label>
            <div class="col-sm-9">
                <?php
                echo tep_draw_input_field('vat_number',
                    (isset($entry['entry_vat_number']) ? $entry['entry_vat_number']
                            : ''),
                    'id="inputVatnumber" aria-describedby="atVatnumber" placeholder="'._('Vat Number').'"');
                if (tep_not_null(ENTRY_VAT_NUMBER_TEXT_2))
                        echo '<span id="atVatnumber" class="help-block">'.ENTRY_VAT_NUMBER_TEXT_2.'</span>';
                ?>
            </div>
            <label for="inputVatnumber" class="control-label col-sm-3"><?php echo ENTRY_COMPANY_NUMBER; ?></label>
            <div class="col-sm-9">
                <?php
                echo tep_draw_input_field('company_number',
                    (isset($entry['entry_company_number']) ? $entry['entry_company_number']
                            : ''),
                    'id="inputVatnumber" aria-describedby="atVatnumber" placeholder="'.ENTRY_COMPANY_NUMBER.'"');
                if (tep_not_null(ENTRY_COMPANY_NUMBER_TEXT_2))
                        echo '<span id="atVatnumber" class="help-block">'.ENTRY_COMPANY_NUMBER_TEXT_2.'</span>';
                ?>
            </div>


        </div>

                <?php
            }
            ?>

    <div class="form-group has-feedback">
        <label for="inputStreet" class="control-label col-sm-3"><?php echo ENTRY_STREET_ADDRESS; ?></label>
        <div class="col-sm-9">
            <?php
            echo tep_draw_input_field('street_address',
                (isset($entry['entry_street_address']) ? $entry['entry_street_address']
                        : ''),
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
    echo tep_draw_input_field('suburb',
        (isset($entry['entry_suburb']) ? $entry['entry_suburb'] : ''),
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
            echo tep_draw_input_field('city',
                (isset($entry['entry_city']) ? $entry['entry_city'] : ''),
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
            echo tep_draw_input_field('postcode',
                (isset($entry['entry_postcode']) ? $entry['entry_postcode'] : ''),
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

        <div class="form-group">
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
                        echo tep_draw_pull_down_menu('state', $zones_array, 0,
                            'id="inputState" aria-describedby="atState"');
                    } else {
                        echo tep_draw_input_field('state', NULL,
                            'id="inputState" aria-describedby="atState" placeholder="'.ENTRY_STATE.'"');
                    }
                } else {
                    echo tep_draw_input_field('state',
                        (isset($entry['entry_country_id']) ? tep_get_zone_name($entry['entry_country_id'],
                                $entry['entry_zone_id'], $entry['entry_state']) : ''),
                        'required aria-required="true" aria-describedby="atState" id="inputState" placeholder="'.ENTRY_STATE.'"');
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
            echo tep_get_country_list('country',
                (isset($entry['entry_country_id']) ? $entry['entry_country_id'] : STORE_COUNTRY),
                0,
                'required aria-required="true" aria-describedby="atCountry" id="inputCountry"');
            echo _('Required');
            if (tep_not_null(ENTRY_COUNTRY_TEXT))
                    echo '<span id="atCountry" class="help-block">'.ENTRY_COUNTRY_TEXT.'</span>';
            ?>
        </div>
    </div>

<?php
if ((isset($_GET['edit']) && ($customer_default_address_id != $_GET['edit'])) || (isset($_GET['edit'])
    === false)) {
    ?>

        <div class="form-group">
            <label for="primary" class="control-label col-sm-3"><?php echo SET_AS_PRIMARY; ?></label>
            <div class="col-sm-9">
                <div class="checkbox">
                    <label>
        <?php echo tep_draw_checkbox_field('primary', 'on', false,
            'id="primary"');
        ?>
                    </label>
                </div>
            </div>
        </div>

    <?php
}
?>
</div>
