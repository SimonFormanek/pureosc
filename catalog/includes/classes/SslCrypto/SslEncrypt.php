<?php

namespace PureOSC\SslCrypto;

class SslEncrypt {

  /**
   * Encrypt string with customers and admins key
   *
   * @param string $source plaintext
   * @param int $customer_id
   *
   * @return string encrypted text
   */
  public static function ssl_encrypt($source, $customer_id) {

    $crypttext_customer = null;
    $crypttext_admin = null;
    $pk_customer = tep_db_fetch_array(tep_db_query("SELECT public_key_customer FROM " . TABLE_KEYS_CUSTOMER . " WHERE customers_id = '" . $customer_id . "'"));
    openssl_public_encrypt($source, $crypttext_customer, $pk_customer['public_key_customer']);
    $pk_admin = tep_db_fetch_array(tep_db_query("SELECT public_key_admin FROM " . TABLE_KEYS_ADMIN . " WHERE customers_id = '" . $customer_id . "'"));
    openssl_public_encrypt($source, $crypttext_admin, $pk_admin['public_key_admin']);
    return base64_encode($crypttext_customer) . '|' . base64_encode($crypttext_admin);
  }

}
