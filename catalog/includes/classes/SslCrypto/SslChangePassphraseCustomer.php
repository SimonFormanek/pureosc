<?php

namespace PureOSC\SslCrypto;

use PureOSC\SslCrypto\SslDecryptSessionPassword;

class SslChangePassphraseCustomer {

  public static function ssl_change_passphrase_customer($oldpass, $new = null, $customer_id) {
    /**
     * update customers passphrase
     * $oldpass string old password
     */
    $result = false;

    $keys_query = tep_db_query("SELECT private_key_customer FROM " . constant('TABLE_KEYS_CUSTOMER') . " WHERE customers_id = '" . $customer_id . "'");
    $keys = tep_db_fetch_array($keys_query);
    if (tep_db_num_rows($keys_query)) {
      $key_decrypted = SslDecryptSessionPassword::decrypt_session_password($keys['private_key_customer']);
      $res = openssl_pkey_get_private($key_decrypted, $old);
      if ($res === false) {
        throw new \Exception("Loading private key failed: " . openssl_error_string());
      }
      if (openssl_pkey_export($res, $result, $new) === false) {
        throw new \Exception("Passphrase change failed: " . openssl_error_string());
      } else {
        $result = true;
      }
      return $result;
    }
  }

}

/**
    function changePassphrase ($private, $old, $new=null) {
    $res = openssl_pkey_get_private ($private, $old);
    if ($res === false) {
    throw new Exception ("Loading private key failed: ".openssl_error_string ());
    return false;
    }
    if (openssl_pkey_export ($res, $result, $new) === false) {
    throw new Exception ("Passphrase change failed: ".openssl_error_string ());
    return false;
    }
    return $result;
    }
   */
