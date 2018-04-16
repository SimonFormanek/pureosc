<?php

namespace PureOSC\SslCrypto;

class SslGenerateCustomerKeys{

/**
 * This function generate customers public and private keys, encrypt private key with passphrase
 *
 * @param string $password plaintext
 * @param int $customer_id used customer id
 */
function ssl_generate_customer_keys($password, $customer_id) {
//1.CUSTOMER
  $privateKey = openssl_pkey_new(array(
    'digest_alg' => 'sha512',
    'private_key_bits' => 4096,
    'private_key_type' => OPENSSL_KEYTYPE_RSA,
  ));
//TODO:salt? $customer_passphrase = $ and save it to arraypassword . file_get_contents(SHOP_KEYS_PATH . $customer_id . '/customer_salt');
  $customer_passphrase = $password;
// export private key
  openssl_pkey_export($privateKey, $customer_private_key, $customer_passphrase);
// generate public key from the private key
  $customer_public_key_array = openssl_pkey_get_details($privateKey);
  $customer_public_key = $customer_public_key_array['key'];
  tep_db_query("INSERT INTO " . TABLE_KEYS_CUSTOMER_REAL . " (customers_id, public_key_customer, private_key_customer) VALUES ('" . $customer_id . "', '" . $customer_public_key . "', '" . $customer_private_key . "')");
  openssl_free_key($privateKey);
}
}
