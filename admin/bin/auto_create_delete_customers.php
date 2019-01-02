#!/usr/bin/php
<?php
//this script is to bee executed by daily crontab

chdir('../');
//error_reporting(E_ERROR | E_WARNING | E_PARSE);
include('../../oscconfig/admin/configure.php');
include('../../oscconfig/dbconfigure.php');
require(DIR_WS_INCLUDES.'filenames.php');
require(DIR_WS_INCLUDES.'database_tables.php');
require(DIR_WS_FUNCTIONS.'database.php');
require(DIR_WS_FUNCTIONS.'password_funcs.php');
require(DIR_WS_FUNCTIONS.'general.php');

//todo: login as master admin user
tep_db_connect(DB_SERVER, DB_SERVER_USERNAME_ROOT, DB_SERVER_PASSWORD_ROOT) or die('Unable to connect to database server!');

$configuration_query = tep_db_query('select configuration_key as cfgKey, configuration_value as cfgValue from '.TABLE_CONFIGURATION);
while ($configuration       = tep_db_fetch_array($configuration_query)) {
    define($configuration['cfgKey'], $configuration['cfgValue']);
}

$last_customer_query = tep_db_query("SELECT customers_id from ".TABLE_NEW_CUSTOMER_ID." order by customers_id DESC LIMIT 1");
$last_customer       = tep_db_fetch_array($last_customer_query);
$last_customer       = $last_customer['customers_id'];

$last_empty_customer_query = tep_db_query("SELECT customers_id from ".TABLE_LAST_EMPTY_CUSTOMERS_ID." order by customers_id DESC LIMIT 1");
$last_empty_customer       = tep_db_fetch_array($last_empty_customer_query);
$last_empty_customer       = $last_empty_customer['customers_id'];

//because $last_empty_customer = last_empty_customer too
if ($last_customer + NEW_CUSTOMERS_ID_RESERVE >= $last_empty_customer) {
    $new_customer_id = $last_empty_customer + NEW_CUSTOMERS_ID_TO_GENERATE;
    for ($id = $last_empty_customer + 1; $id <= $new_customer_id; $id++) {
        echo 'New id:'.$id."\n";
        ////create customer: salt[0] | db_pwd[1]
        mkdir(SHOP_KEYS_PATH.'/'.$id, 0755);
        file_put_contents(SHOP_KEYS_PATH.$id.'/customer_salt',
            bin2hex(openssl_random_pseudo_bytes('32')));
        $db_server_password = bin2hex(openssl_random_pseudo_bytes('32'));
        file_put_contents(SHOP_KEYS_PATH.$id.'/customer_db_pwd',
            $db_server_password);
        //create admin keys
        $privateKey         = openssl_pkey_new(array(
            'digest_alg' => 'sha512',
            'private_key_bits' => 4096,
            'private_key_type' => OPENSSL_KEYTYPE_RSA,
        ));
        openssl_pkey_export_to_file($privateKey, ADMIN_PRIVATE_KEYS_PATH.$id);
        $admin_key_array    = openssl_pkey_get_details($privateKey);
        file_put_contents(SHOP_KEYS_PATH.'/'.$id.'/admin_pubkey',
            $admin_key_array['key']);
        openssl_free_key($privateKey);
        //create customer tmp keys
        $privateKey         = openssl_pkey_new(array(
            'digest_alg' => 'sha512',
            'private_key_bits' => 4096,
            'private_key_type' => OPENSSL_KEYTYPE_RSA,
        ));
        openssl_pkey_export_to_file($privateKey,
            SHOP_KEYS_PATH.$id.'/customer_tmp_privkey');
        $admin_key_array    = openssl_pkey_get_details($privateKey);
        file_put_contents(SHOP_KEYS_PATH.'/'.$id.'/customer_tmp_pubkey',
            $admin_key_array['key']);
        openssl_free_key($privateKey);

//grant usage pak skript... TODO!!!
        tep_db_query("GRANT ALL ON ".DB_DATABASE.".* to '".DB_SERVER_USERNAME_PREFIX.$id."'@'".DB_SERVER."' IDENTIFIED BY '".$db_server_password."'");
    }
    tep_db_query("UPDATE ".TABLE_LAST_EMPTY_CUSTOMERS_ID." SET customers_id = '".$new_customer_id."'");
}


$current_time = time();
$xx_mins_ago  = ($current_time - 60); //900 -15 min
// remove entries that have expired
$expired_customers_query = tep_db_query("select customer_id, session_id from ".TABLE_WHOS_ONLINE." where time_last_click < '".$xx_mins_ago."'");
if (tep_db_num_rows($expired_customers_query) > 0) {
    while ($expired_customers = tep_db_fetch_array($expired_customers_query)) {
        tep_db_query("DELETE FROM ".TABLE_SESSIONS." WHERE sesskey = '".$expired_customers['session_id']."'");
        tep_db_query("DELETE FROM ".TABLE_WHOS_ONLINE." WHERE customer_id = '".$expired_customers['customer_id']."'");
        purge_expired_decrypted_customers_data($expired_customers['customer_id']);
    }
} else {
    echo 'No customers data to purge';
}
//delete uncative customers (db username from database)
//delete salt,db_password from config-file

