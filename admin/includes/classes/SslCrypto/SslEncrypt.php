<?php

namespace PureOSC\SslCrypto;

class SslEncrypt {

  /**
   * Encrypt string with customers and admins key
   * @param type $source
   * @param type $customer_id
   * @param type $role
   * @return type
   */
  public static function ssl_encrypt($source, $customer_id, $role = 'customer') {
    $pk_query = tep_db_query("SELECT public_key_customer FROM " . TABLE_KEYS_CUSTOMER . " WHERE customers_id = '" . $customer_id . "'");
    $pk = tep_db_fetch_array($pk_query);
//    $pub_key = $pk['public_key_admin']; else $pub_key = $pk['public_key_customer'];
    openssl_public_encrypt($source, $crypttext_customer, $pk['public_key_customer']);
    $pk_query = tep_db_query("SELECT public_key_admin FROM " . TABLE_KEYS_ADMIN . " WHERE customers_id = '" . $customer_id . "'");
    $pk = tep_db_fetch_array($pk_query);
    openssl_public_encrypt($source, $crypttext_admin, $pk['public_key_admin']);
    return base64_encode($crypttext_customer) . '|' . base64_encode($crypttext_admin);
  }

}

;
