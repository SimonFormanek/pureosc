<?php

namespace PureOSC\SslCrypto;

/**
 * @author Simon Formanek <mail at simonformanek.cz>
 */
class SslChangePassphrase {

public static function change_passphrase ($old, $new=null, $customer_id) {

    $keys_query = tep_db_query("SELECT private_key_customer FROM " . constant('TABLE_KEYS_CUSTOMER') . " WHERE customers_id = '" . $customer_id . "'");
    $keys = tep_db_fetch_array($keys_query);
    if (tep_db_num_rows($keys_query)) {
    $private_key_master_data = $keys['private_key_customer'];
    $res = openssl_pkey_get_private ($keys['private_key_customer'], $old);

    if ($res === false) {
      throw new Exception ("Loading private key failed: ".openssl_error_string ());
      return false;
    }
    if (openssl_pkey_export ($res, $result, $new) === false) {
      throw new Exception ("Passphrase change failed: ".openssl_error_string ());
      return false;
    } else {
    	tep_db_query("UPDATE " . constant('TABLE_KEYS_CUSTOMER') . " SET private_key_customer = '" . $result . "' WHERE customers_id = '" . $customer_id . "'");
    }
    return $result;
	}
}

}
