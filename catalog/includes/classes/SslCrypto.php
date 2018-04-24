<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace PureOSC;

/**
 * Description of SslCrypto
 *
 * @author Simon Formanek <mail at simonformanek.cz>
 */
class SslCrypto {

  /**
   * Encrypt string with customers and admins key
   *
   * @param string $source plaintext
   * @param int $customer_id
   *
   * @return string encrypted text
   */
  public static function encrypt($source, $customer_id) {

    $crypttext_customer = null;
    $crypttext_admin = null;
    $pk_customer = tep_db_fetch_array(tep_db_query("SELECT public_key_customer FROM " . constant('TABLE_KEYS_CUSTOMER') . " WHERE customers_id = '" . $customer_id . "'"));
    openssl_public_encrypt($source, $crypttext_customer, $pk_customer['public_key_customer']);
    $pk_admin = tep_db_fetch_array(tep_db_query("SELECT public_key_admin FROM " . TABLE_KEYS_ADMIN . " WHERE customers_id = '" . $customer_id . "'"));
    openssl_public_encrypt($source, $crypttext_admin, $pk_admin['public_key_admin']);
    return base64_encode($crypttext_customer) . '|' . base64_encode($crypttext_admin);
  }

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

  /**
   * encrypt session password
   * @param string $source plaintext
   */
  public static function encrypt_session_password($source) {
    $public_key = file_get_contents(SERVER_SESSION_CUSTOMER_PUBLIC_KEY);
    openssl_public_encrypt($source, $encrypted, $public_key);
    return base64_encode($encrypted);
  }

  public static function decrypt($crypttext, $crypted_password, $customer_id) {
    $crypt_array = explode('|', $crypttext);
    $crypttext = $crypt_array['0'];

    $keys_query = tep_db_query("SELECT private_key_customer FROM " . constant('TABLE_KEYS_CUSTOMER') . " WHERE customers_id = '" . $customer_id . "'");
    $keys = tep_db_fetch_array($keys_query);
    if (tep_db_num_rows($keys_query)) {
      $private_key_master_data = $keys['private_key_customer'];
      $privateKey = openssl_pkey_get_private($private_key_master_data, self::decrypt_session_password($crypted_password));
      openssl_private_decrypt(base64_decode($crypttext), $decrypted, $privateKey);
      openssl_free_key($privateKey);
    } else
    //TODO error do session !!!!
      $decrypted = 'ERROR: Private key not found (decrypt)';
    return $decrypted;
  }

  public static function decrypt_session_password($crypttext) {
    if (file_exists(SERVER_SESSION_CUSTOMER_PRIVATE_KEY)) {
      $private_key_data = file_get_contents(constant('SERVER_SESSION_CUSTOMER_PRIVATE_KEY'));
      $privateKey = openssl_pkey_get_private($private_key_data);
      openssl_private_decrypt(base64_decode($crypttext), $decrypted, $privateKey);
      openssl_free_key($privateKey);
    } else
      echo 'ERROR: Admin Private key not found (decrypt_session_password)';
    return $decrypted;
  }
/**
 * change customers passphrase
 * 
 * @param type $password_current
 * @param type $password_new
 * @param type $customer_id
 * 
 * @return boolean
 * 
 * @throws \Exception
 */
  public static function change_passphrase_customer($password_current, $password_new, $customer_id) {
    $result = false;

    $keys_query = tep_db_query("SELECT private_key_customer FROM " . constant('TABLE_KEYS_CUSTOMER') . " WHERE customers_id = '" . $customer_id . "'");
    $keys = tep_db_fetch_array($keys_query);
    if (tep_db_num_rows($keys_query)) {

      $res = openssl_pkey_get_private($keys['private_key_customer'], $password_current);
      if ($res === false) {
        throw new \Exception("Loading private key failed: " . openssl_error_string());
//         $messageStack->add('account_password', "Loading private key failed: " . openssl_error_string());
      }
      if (openssl_pkey_export($res, $result, $password_new) === false) {
        throw new \Exception("Passphrase change failed: " . openssl_error_string());
//        $messageStack->add('account_password', "Passphrase change failed: " . openssl_error_string());
      } else {
        $result = true;
      }
      return $result;
    }
  }

  /**
   * Generate customers ssl keys and store it to DB
   *
   * @param string $password plaintext
   * @param int $customer_id
   */
  public static function
  generate_customer_keys($password, $customer_id) {
    $customer_private_key = null;
    $privateKey = openssl_pkey_new(array(
      'digest_alg' => 'sha512',
      'private_key_bits' => 4096,
      'private_key_type' => OPENSSL_KEYTYPE_RSA,
    ));
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
