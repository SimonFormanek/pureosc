<?php
/**
 * @category    Payment
 * @author      Global Payments Europe s.r.o. (emailgpwebpay@gpe.cz)
 */
$er = error_reporting();

if (!function_exists("isZencart")) {

    function isZencart()
    {
        return !function_exists("tep_db_query");
    }
    if (isZencart()) {

        function tep_db_query($sql)
        {
            global $db;
            return $db->Execute($sql);
        }

        function tep_db_num_rows($query)
        {
            return $query->RecordCount();
        }

        function tep_db_insert_id()
        {
            global $db;
            return $db->insert_ID();
        }
    } else {
        define('DB_PREFIX', '');

        class MySniffer
        {

            function table_exists($table_name)
            {
                global $db;
                $found_table = false;
                $sql         = "SHOW TABLES like '".$table_name."'";
                $tables      = tep_db_query($sql);
                if (tep_db_num_rows($tables) > 0) {
                    $found_table = true;
                }
                return $found_table;
            }
        }

        global $sniffer;
        $sniffer = new MySniffer();

        function zen_cfg_select_option($select_array, $key_value, $key = '')
        {
            return tep_cfg_select_option($select_array, $key_value, $key);
        }

        function zen_get_zone_class_title($zone_class_id)
        {
            return tep_get_zone_class_title($zone_class_id);
        }

        function zen_cfg_pull_down_zone_classes($zone_class_id, $key = '')
        {
            return tep_cfg_pull_down_zone_classes($zone_class_id, $key);
        }

        function zen_cfg_pull_down_order_statuses($order_status_id, $key = '')
        {
            return tep_cfg_pull_down_order_statuses($order_status_id, $key);
        }

        function zen_get_order_status_name($order_status_id, $language_id = '')
        {
            return tep_get_order_status_name($order_status_id, $language_id);
        }

        function zen_href_link($page = '', $parameters = '',
                               $connection = 'NONSSL', $add_session_id = true)
        {
            return tep_href_link($page, $parameters, $connection,
                $add_session_id);
        }

        function zen_draw_hidden_field($name, $value = '', $parameters = '')
        {
            return tep_draw_hidden_field($name, $value, $parameters);
        }

        function zen_redirect($url)
        {
            return tep_redirect($url);
        }

        function zen_mail($to_name, $to_address, $email_subject, $email_text,
                          $from_email_name, $from_email_address,
                          $block = array(), $module = 'default',
                          $attachments_list = '')
        {
            return tep_mail($to_name, $to_address, $email_subject, $email_text,
                $from_email_name, $from_email_address);
        }
    }
}

define('MODULE_PAYMENT_GPWEBPAY_KEYDIR',
    DIR_FS_CATALOG.DIR_WS_MODULES.'payment/gpwebpay/cert');
define('MODULE_PAYMENT_GPWEBPAY_LOGFILE',
    DIR_FS_CATALOG.DIR_WS_MODULES.'payment/gpwebpay/log/gpwebpay.log');

if (!defined('TABLE_GPWEBPAY_TRANS'))
        define('TABLE_GPWEBPAY_TRANS', DB_PREFIX.'gpwebpay_trans');
include(DIR_FS_CATALOG.DIR_WS_MODULES.'payment/gpwebpay/muzo/muzo.php');

define('GPE_E_3DSECURE', 1);
define('GPE_E_BLOCKED', 2);
define('GPE_E_LIMIT', 3);
define('GPE_E_TECHNICAL', 4);
define('GPE_E_CANCELED', 5);

function classify_error($valid, $prCode, $srCode)
{
    if (!$valid) return GPE_E_TECHNICAL;
    if ($prCode == 28 && array_search($srCode,
            array(3000, 3002, 3004, 3005, 3008))) return GPE_E_3DSECURE;
    else if ($prCode == 30 && array_search($srCode, array(1001, 1002)))
            return GPE_E_BLOCKED;
    else if ($prCode == 30 && array_search($srCode, array(1003, 1005)))
            return GPE_E_LIMIT;
    else if ($prCode == 50) return GPE_E_CANCELED;
    else return GPE_E_TECHNICAL;
}

class gpwebpay
{
    var $code, $title, $description, $enabled, $payment;

    function gpwebpay()
    {
        global $order;
        $this->code        = 'gpwebpay';
        $this->title       = _('GlobalPayment\'s GPWebPay');
        $this->description = __('MODULE_PAYMENT_GPWEBPAY_TEXT_DESCRIPTION',
            _('Provided by Global Payment'));
        $this->sort_order  = defined('MODULE_PAYMENT_GPWEBPAY_SORT_ORDER') ? constant('MODULE_PAYMENT_GPWEBPAY_SORT_ORDER')
                : 0;
        $this->enabled     = (defined('MODULE_PAYMENT_GPWEBPAY_STATUS') && (constant('MODULE_PAYMENT_GPWEBPAY_STATUS')
            == 'True') ? true : false);

        if (defined('MODULE_PAYMENT_GPWEBPAY_ORDER_STATUS_ID') && (int) constant('MODULE_PAYMENT_GPWEBPAY_ORDER_STATUS_ID')
            > 0) {
            $this->order_status = constant('MODULE_PAYMENT_GPWEBPAY_ORDER_STATUS_ID');
            $payment            = 'gpwebpay';
        } else {
            if ($payment == 'gpwebpay') {
                $payment = '';
            }
        }

        if (is_object($order)) $this->update_status();

        $this->email_footer    = defined('MODULE_PAYMENT_GPWEBPAY_TEXT_EMAIL_FOOTER')
                ? constant('MODULE_PAYMENT_GPWEBPAY_TEXT_EMAIL_FOOTER') : '';
        $this->form_action_url = defined('MODULE_PAYMENT_GPWEBPAY_GPWEBPAYURL') ? constant('MODULE_PAYMENT_GPWEBPAY_GPWEBPAYURL')
                : '';
    }

    function update_status()
    {
        global $db;
        global $order;

        if (($this->enabled == true) && ((int) MODULE_PAYMENT_GPWEBPAY_ZONE > 0)) {
            $check_flag = false;
            $check      = tep_db_query("select zone_id from ".TABLE_ZONES_TO_GEO_ZONES." where geo_zone_id = '".MODULE_PAYMENT_GPWEBPAY_ZONE."' and zone_country_id = '".$order->billing['country']['id']."' order by zone_id");
            while (!$check->EOF) {
                if ($check->fields['zone_id'] < 1) {
                    $check_flag = true;
                    break;
                } elseif ($check->fields['zone_id'] == $order->billing['zone_id']) {
                    $check_flag = true;
                    break;
                }
                $check->MoveNext();
            }

            if ($check_flag == false) {
                $this->enabled = false;
            }
        }
    }

    function javascript_validation()
    {
        return false;
    }

    function selection()
    {
        return array('id' => $this->code,
            'module' => $this->title);
    }

    function pre_confirmation_check()
    {
        return false;
    }

    function confirmation()
    {
        return false;
    }

    function fixDescription($t)
    {
        $t = strtr($t, "ÁÄČÇĎÉĚËÍŇÓÖŘŠŤÚŮÜÝŽáäčçďéěëíňóöřšťúůüýž",
            "AACCDEEEINOORSTUUUYZaaccdeeeinoorstuuuyz");
        for ($i = 0; $i < strlen($t); $i++) {
            if ($t[$i] < 0x20 && $t[$i] > 0x7e) {
                $t[$i] = ' ';
            }
        }
        $t = substr($t, 0, 120);
        return $t;
    }

    function process_button()
    {
        global $order, $db, $currencies;

        $order_currency = $order->info['currency'];

        if ($order_currency == "Kč") {
            $order_currency = "CZK";
        }
        $currencyCodes = array("CZK" => 203, "EUR" => 978, "GBP" => 826, "USD" => 840);
        $order_total   = $order->info['total'] * $order->info['currency_value'];

        //$is_native_currency = isset($currencyCodes[$order_currency]) && trim(constant('MODULE_PAYMENT_GPWEBPAY_MERCHANTNUMBER_' . $order_currency)) != '';
        $is_native_currency = true;
        if ($is_native_currency) {
            //$gpwebpay_merchant = constant('MODULE_PAYMENT_GPWEBPAY_MERCHANTNUMBER_' . $order_currency);
            $gpwebpay_merchant = constant('MODULE_PAYMENT_GPWEBPAY_MERCHANTNUMBER');
            $gpwebpay_currency = $currencyCodes[$order_currency];
            $amount            = $order_total;
            $transtable_note   = "";
        } else {
            $gpwebpay_merchant = constant('MODULE_PAYMENT_GPWEBPAY_MERCHANTNUMBER_CZK');
            $gpwebpay_currency = '203';
            $rate              = $this->get_cnb_currency_rate($order_currency);
            $amount            = $order_total * $rate;
            $amount_txt        = number_format($amount, 2, '.', '');
            $order_total_txt   = number_format($order_total, 2, '.', '');

            $transtable_note             = $order_total_txt." $order_currency  (CZK/$order_currency = $rate @ ".date("Y-m-d").")  =&gt;  $amount_txt CZK";
            $_SESSION["transtable_note"] = $transtable_note; // pro zapis do mailu pro majitele obchodu
        }
        $gpwebpay_amount = round($amount * 100);

        $description = "";
        foreach ($order->products as $p) {
            if ($description != '') $description .= ", ";
            $description .= $p["name"];
        }
        $description = trim(self::convertToAscii($this->fixDescription($description)));


        $lastIdQueryRaw = tep_db_query('SELECT id FROM '.constant('TABLE_GPWEBPAY_TRANS').' ORDER BY id DESC limit 1');
        if (tep_db_num_rows($lastIdQueryRaw)) {
            $gpwebpay_order_number = tep_db_fetch_fields($lastIdQueryRaw) + constant('MODULE_PAYMENT_GPWEBPAY_ORDNUM_OFFSET');
        } else {
            $gpwebpay_order_number = constant('MODULE_PAYMENT_GPWEBPAY_ORDNUM_OFFSET');
        }

        $_SESSION['gpwebpay_order_number'] = $gpwebpay_order_number;

        $sql = "insert into ".constant('TABLE_GPWEBPAY_TRANS')." set gpwebpay_order_number = $gpwebpay_order_number, note = '$transtable_note'";
        tep_db_query($sql);


        $operation = 'CREATE_ORDER';

        $replyUrl = zen_href_link(FILENAME_CHECKOUT_PROCESS, '', 'SSL');

        $digest = GpeMuzoDigest(MODULE_PAYMENT_GPWEBPAY_KEYDIR.'/'.MODULE_PAYMENT_GPWEBPAY_KEYFILE,
            MODULE_PAYMENT_GPWEBPAY_KEYPASS, $replyUrl, $operation,
            $gpwebpay_merchant, $gpwebpay_order_number, $gpwebpay_amount,
            $gpwebpay_currency, MODULE_PAYMENT_GPWEBPAY_DEPOSITFLAG,
            $gpwebpay_order_number, $description, 'X');

        $payment_fields   = array();
        $payment_fields[] = zen_draw_hidden_field('MERCHANTNUMBER',
            $gpwebpay_merchant);
        $payment_fields[] = zen_draw_hidden_field('OPERATION', $operation);
        $payment_fields[] = zen_draw_hidden_field('ORDERNUMBER',
            $gpwebpay_order_number);
        $payment_fields[] = zen_draw_hidden_field('AMOUNT', $gpwebpay_amount);
        $payment_fields[] = zen_draw_hidden_field('DESCRIPTION', $description);
        $payment_fields[] = zen_draw_hidden_field('DEPOSITFLAG',
            MODULE_PAYMENT_GPWEBPAY_DEPOSITFLAG);
        $payment_fields[] = zen_draw_hidden_field('DIGEST', $digest);
        $payment_fields[] = zen_draw_hidden_field('CURRENCY', $gpwebpay_currency);
        $payment_fields[] = zen_draw_hidden_field('URL', $replyUrl);
        $payment_fields[] = zen_draw_hidden_field('MD', 'X');
        $payment_fields[] = zen_draw_hidden_field('MERORDERNUM',
            $gpwebpay_order_number);

        $this->writeLog("MAKING_ORDER_FORM ".implode(",", $payment_fields));

        if (!$is_native_currency) {
            echo "<div class='pgwebpay_count'>";
            echo MODULE_PAYMENT_GPWEBPAY_CZK_TITLE." ";
            echo "1.00 $order_currency  =  $rate CZK.";
            echo " ".MODULE_PAYMENT_GPWEBPAY_CZK_TOTAL." $amount_txt CZK";
            echo "</div>";
        }

        return "\r\n".implode("\r\n", $payment_fields)."\r\n";
    }

    /**
     * Remove any non-ASCII characters and convert known non-ASCII characters 
     * to their ASCII equivalents, if possible.
     *
     * @param string $string 
     * @return string $string
     * @author Jay Williams <myd3.com>
     * 
     * @license MIT License
     * 
     * @link http://gist.github.com/119517
     */
    static function convertToAscii($string)
    {
        // Replace Single Curly Quotes
        $search[]  = chr(226).chr(128).chr(152);
        $replace[] = "'";
        $search[]  = chr(226).chr(128).chr(153);
        $replace[] = "'";
        // Replace Smart Double Curly Quotes
        $search[]  = chr(226).chr(128).chr(156);
        $replace[] = '"';
        $search[]  = chr(226).chr(128).chr(157);
        $replace[] = '"';
        // Replace En Dash
        $search[]  = chr(226).chr(128).chr(147);
        $replace[] = '--';
        // Replace Em Dash
        $search[]  = chr(226).chr(128).chr(148);
        $replace[] = '---';
        // Replace Bullet
        $search[]  = chr(226).chr(128).chr(162);
        $replace[] = '*';
        // Replace Middle Dot
        $search[]  = chr(194).chr(183);
        $replace[] = '*';
        // Replace Ellipsis with three consecutive dots
        $search[]  = chr(226).chr(128).chr(166);
        $replace[] = '...';
        // Apply Replacements
        $string    = str_replace($search, $replace, $string);
        // Remove any non-ASCII Characters
        $string    = preg_replace("/[^\x01-\x7F]/", "", $string);
        return $string;
    }

    function before_process()
    {
        $valid = GpeMuzoReceiveReply(
            MODULE_PAYMENT_GPWEBPAY_KEYDIR.'/'.MODULE_PAYMENT_GPWEBPAY_GPWEBPAYKEYFILE,
            $gpwebpay_order_number, $merOrderNum, $md, $prCode, $srCode,
            $resultText);

        $this->writeLog("REPLY Signature ".($valid ? "OK" : "INVALID")." ".$_SERVER['REMOTE_ADDR']." ".$_SERVER['REQUEST_URI']);

        $valid = $valid && ($_SESSION['gpwebpay_order_number'] == $gpwebpay_order_number);

        if (!$valid || $prCode != 0) {

            $erc    = classify_error($valid, $prCode, $srCode);
            $ertext = $this->get_error_text($erc);

            $this->_send_error_mail($gpwebpay_order_number, $prCode, $srCode,
                $resultText, $ertext);

            zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT,
                    'payment_error='.$this->code.'&error='.urlencode($ertext),
                    'SSL', true, false));
        }

        $this->transaction_id = $gpwebpay_order_number;
        if ($transtable_note != "") {
            $this->transaction_id .= "  (".$_SESSION["transtable_note"].")";
        }

        return false;
    }

    function _send_error_mail($gpwebpay_order_number, $prCode, $srCode,
                              $resultText, $ertext)
    {
        global $order;
        $subject     = "Platba GPE Pay neakceptovana [ORDERNUMBER: $gpwebpay_order_number]";
        $body        = '';
        $body        .= "Chyba hlasena uzivateli: $ertext\n";
        $body        .= "Chyba z GPE: ($prCode, $srCode) $resultText\n";
        $body        .= "ORDERNUMBER: $gpwebpay_order_number\n";
        $body        .= "Zakaznik: ".$order->customer['firstname'].' '.$order->customer['lastname']."\n";
        $body        .= 'Mail: '.$order->customer['email_address']."\n";
        $body        .= 'Telefon: '.$order->customer['telephone']."\n";
        $body        .= "Cena: ".number_format($order->info['total'] * $order->info['currency_value'],
                2, '.', '').' '.$order->info['currency']."\n";
        $description = "";
        foreach ($order->products as $p) {
            $description .= $p["qty"]." ks \t".$p["name"]."\n";
        }
        $body .= "\nObjednane zbozi:\n".$description;

        if (SEND_EXTRA_ORDER_EMAILS_TO != '') {
            zen_mail('', SEND_EXTRA_ORDER_EMAILS_TO, $subject, $body,
                STORE_NAME, EMAIL_FROM, '', $this->code, '');
        }
    }

    function after_process()
    {
        global $insert_id, $db;

        $valid = GpeMuzoReceiveReply(
            MODULE_PAYMENT_GPWEBPAY_KEYDIR.'/'.MODULE_PAYMENT_GPWEBPAY_GPWEBPAYKEYFILE,
            $gpwebpay_order_number, $merOrderNum, $md, $prCode, $srCode,
            $resultText);

        $sql = "update ".TABLE_GPWEBPAY_TRANS." set state = 1, order_id = $insert_id ,date_paid = now() where gpwebpay_order_number = ".$gpwebpay_order_number;
        tep_db_query($sql);

        return false;
    }

    function get_error()
    {
        $error = array('title' => 'GPE Pay',
            'error' => urldecode($_GET['error']));
        return $error;
    }

    function check()
    {
        global $db;
        if (!isset($this->_check)) {
            $check_query  = tep_db_query("select configuration_value from ".TABLE_CONFIGURATION." where configuration_key = 'MODULE_PAYMENT_GPWEBPAY_STATUS'");
            $this->_check = tep_db_num_rows($check_query);
        }
        return $this->_check;
    }

    function admin_notification($zf_order_id)
    {
        global $db;
        $output = '';
        $sql    = "select * from ".TABLE_GPWEBPAY_TRANS." where order_id = '".$zf_order_id."' and state = 1 order by date_paid";
        $lp_api = tep_db_query($sql);
        if (tep_db_num_rows($lp_api) > 0) {
            $output = "<td> <b style='color:green'>GPE Pay</b><br/>
			 Zaplaceno dne ".$lp_api->fields['date_paid']
                ."<br/>  GPE Pay ORDERNUMBER je ".$lp_api->fields['gpwebpay_order_number']."</b><br/>"
                .$lp_api->fields['note']." </td>";
        }
        return $output;
    }

    function install()
    {
        global $db;
        tep_db_query("insert into ".TABLE_CONFIGURATION." (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable GP webpay Module', 'MODULE_PAYMENT_GPWEBPAY_STATUS', 'True', 'Do you want to accept GP webpay payments?', '6', '1', 'zen_cfg_select_option(array(\'True\', \'False\'), ', now());");
        tep_db_query("insert into ".TABLE_CONFIGURATION." (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort order of display', 'MODULE_PAYMENT_GPWEBPAY_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '0', now())");
        tep_db_query("insert into ".TABLE_CONFIGURATION." (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('Payment Zone', 'MODULE_PAYMENT_GPWEBPAY_ZONE', '0', 'If a zone is selected, only enable this payment method for that zone.', '6', '2', 'zen_get_zone_class_title', 'zen_cfg_pull_down_zone_classes(', now())");
        tep_db_query("insert into ".TABLE_CONFIGURATION." (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) values ('Set Order Status', 'MODULE_PAYMENT_GPWEBPAY_ORDER_STATUS_ID', '2', 'Set the status of orders made with this payment module that have completed payment to this value<br />(\'Processing\' recommended)', '6', '44', 'zen_cfg_pull_down_order_statuses(', 'zen_get_order_status_name', now())");

        tep_db_query("insert into ".TABLE_CONFIGURATION." (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Merchant number', 'MODULE_PAYMENT_GPWEBPAY_MERCHANTNUMBER', '', 'Merchant number', '6', '0', now())");

        /* tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Merchant number CZK', 'MODULE_PAYMENT_GPWEBPAY_MERCHANTNUMBER_CZK', '', 'Merchant number for CZK', '6', '0', now())");
          tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Merchant number EUR', 'MODULE_PAYMENT_GPWEBPAY_MERCHANTNUMBER_EUR', '', 'Merchant number for EUR', '6', '0', now())");
          tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Merchant number USD', 'MODULE_PAYMENT_GPWEBPAY_MERCHANTNUMBER_USD', '', 'Merchant number for USD', '6', '0', now())");
          tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Merchant number GBP', 'MODULE_PAYMENT_GPWEBPAY_MERCHANTNUMBER_GBP', '', 'Merchant number for GBP', '6', '0', now())"); */

        tep_db_query("insert into ".TABLE_CONFIGURATION." (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Deposit flag', 'MODULE_PAYMENT_GPWEBPAY_DEPOSITFLAG', '1', 'Deposit flag: 0 = Authorize only, 1 = Pay', '6', '1', 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());");

        tep_db_query("insert into ".TABLE_CONFIGURATION." (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Private key file', 'MODULE_PAYMENT_GPWEBPAY_KEYFILE', '', 'Merchant private key file (*.key) stored in includes/modules/payment/gpwebpay/cert/', '6', '0', now())");
        tep_db_query("insert into ".TABLE_CONFIGURATION." (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Private key password', 'MODULE_PAYMENT_GPWEBPAY_KEYPASS', '', 'Merchant private key password', '6', '2', now())");
        tep_db_query("insert into ".TABLE_CONFIGURATION." (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Public key file', 'MODULE_PAYMENT_GPWEBPAY_GPWEBPAYKEYFILE', '', 'Public key file (*.pem) stored in includes/modules/payment/gpwebpay/cert/', '6', '0', now())");
        tep_db_query("insert into ".TABLE_CONFIGURATION." (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('GP webpay URL', 'MODULE_PAYMENT_GPWEBPAY_GPWEBPAYURL', '', 'GP webpay gateway URL', '6', '0', now())");
        tep_db_query("insert into ".TABLE_CONFIGURATION." (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Order number offset', 'MODULE_PAYMENT_GPWEBPAY_ORDNUM_OFFSET', '1000', 'Gateway order number offset (recommended value 1000, do not change after it is once set)', '6', '0', now())");

        global $sniffer;
        if (!$sniffer->table_exists(TABLE_GPWEBPAY_TRANS)) {
            $sql = "CREATE TABLE ".TABLE_GPWEBPAY_TRANS." (
                  id int(11) unsigned NOT NULL auto_increment,
                  order_id int(11) NOT NULL default '0',
				  gpwebpay_order_number varchar(16) NOT NULL DEFAULT 0,
                  date_paid datetime,
				  state int(11),
				  note text,
                  PRIMARY KEY  (id)
                  )";
            tep_db_query($sql);
        }
    }

    function remove()
    {
        global $db;
        tep_db_query("delete from ".TABLE_CONFIGURATION." where configuration_key in ('".implode("', '",
                $this->keys())."')");
    }

    function keys()
    {
        return array('MODULE_PAYMENT_GPWEBPAY_STATUS', 'MODULE_PAYMENT_GPWEBPAY_ZONE',
            'MODULE_PAYMENT_GPWEBPAY_ORDER_STATUS_ID', 'MODULE_PAYMENT_GPWEBPAY_SORT_ORDER',
            'MODULE_PAYMENT_GPWEBPAY_MERCHANTNUMBER', /* 'MODULE_PAYMENT_GPWEBPAY_MERCHANTNUMBER_CZK', 'MODULE_PAYMENT_GPWEBPAY_MERCHANTNUMBER_EUR', 'MODULE_PAYMENT_GPWEBPAY_MERCHANTNUMBER_USD', 'MODULE_PAYMENT_GPWEBPAY_MERCHANTNUMBER_GBP', */
            'MODULE_PAYMENT_GPWEBPAY_DEPOSITFLAG', 'MODULE_PAYMENT_GPWEBPAY_KEYFILE',
            'MODULE_PAYMENT_GPWEBPAY_KEYPASS', 'MODULE_PAYMENT_GPWEBPAY_GPWEBPAYKEYFILE',
            'MODULE_PAYMENT_GPWEBPAY_GPWEBPAYURL', 'MODULE_PAYMENT_GPWEBPAY_ORDNUM_OFFSET');
    }

    function get_cnb_currency_rate($currency)
    {
        if ($currency == "CZK") return 1;
        $rateStr   = $this->file_get_contents_curl("http://www.cnb.cz/en/financial_markets/foreign_exchange_market/exchange_rate_fixing/daily.txt");
        $rateLines = explode("\n", $rateStr);
        foreach ($rateLines as $rateLine) {
            $rateDets = explode("|", $rateLine);
            if (count($rateDets) == 5) {
                if ($rateDets[3] == $currency) {
                    $rate = $rateDets[4] / $rateDets[2];
                    return $rate;
                }
            }
        }
        die("Nelze urcit kurz!");
    }

    function file_get_contents_curl($url)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);

        $data = curl_exec($ch);
        curl_close($ch);

        return $data;
    }

    function writeLog($s)
    {
        $line = "*** ".date('r')." ".$s."\n";
        if (file_exists(MODULE_PAYMENT_GPWEBPAY_LOGFILE))
                file_put_contents(MODULE_PAYMENT_GPWEBPAY_LOGFILE, $line,
                FILE_APPEND | LOCK_EX);
    }

    function get_error_text($gpe_err)
    {
        switch ($gpe_err) {
            case GPE_E_3DSECURE:
                return MODULE_PAYMENT_GPWEBPAY_ERR_3DSECURE;
            case GPE_E_BLOCKED:
                return MODULE_PAYMENT_GPWEBPAY_ERR_BLOCKED;
            case GPE_E_LIMIT:
                return MODULE_PAYMENT_GPWEBPAY_ERR_LIMIT;
            case GPE_E_TECHNICAL:
                return MODULE_PAYMENT_GPWEBPAY_ERR_TECHNICAL;
            case GPE_E_CANCELED:
                return MODULE_PAYMENT_GPWEBPAY_ERR_CANCELED;
            default:
                return "Unknown error type";
        }
    }
}

error_reporting($er);
?>
