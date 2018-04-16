<?php

namespace PureOSC\SslCrypto;

use PureOSC\SslCrypto\SslDecryptSessionPassword;

class SslDecryptCustomer {
  //// TODO: jen jedene cyklus, rovnou spodek

  /**
   * Decrypt crypttext with customer key
   *

   * @param sting   $crypttext   text to decrypt
   * @param string  $crypted_password    plaintext
   * @param int    $customer_id required cutomer id
   * @param string $role customer or admin
   *
   * @return string
   */
  public static function decrypt($crypttext, $crypted_password, $customer_id) {
    $crypt_array = explode('|', $crypttext);
    $crypttext = $crypt_array['0'];

    $keys_query = tep_db_query("SELECT private_key_customer FROM " . constant('TABLE_KEYS_CUSTOMER') . " WHERE customers_id = '" . $customer_id . "'");
    $keys = tep_db_fetch_array($keys_query);
    if (tep_db_num_rows($keys_query)) {
      $private_key_master_data = $keys['private_key_customer'];
      $privateKey = openssl_pkey_get_private($private_key_master_data, SslDecryptSessionPassword::decrypt_session_password($crypted_password));
      openssl_private_decrypt(base64_decode($crypttext), $decrypted, $privateKey);
      openssl_free_key($privateKey);
    } else
    //TODO error do session !!!!
      $decrypted = 'ERROR: Private key not found (decrypt)';
    return $decrypted;
  }

}
