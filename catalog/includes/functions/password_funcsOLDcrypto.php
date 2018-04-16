<?php

/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2010 osCommerce

  Released under the GNU General Public License
 */

////
// This function validates a plain text password with a
// salted or phpass password
function tep_validate_password($plain, $encrypted) {
  if (tep_not_null($plain) && tep_not_null($encrypted)) {
    if (tep_password_type($encrypted) == 'salt') {
      return tep_validate_old_password($plain, $encrypted);
    }

    if (!class_exists('PasswordHash')) {
      include(DIR_WS_CLASSES . 'passwordhash.php');
    }

    $hasher = new PasswordHash(10, true);

    return $hasher->CheckPassword($plain, $encrypted);
  }

  return false;
}

////
// This function validates a plain text password with a
// salted password
function tep_validate_old_password($plain, $encrypted) {
  if (tep_not_null($plain) && tep_not_null($encrypted)) {
// split apart the hash / salt
    $stack = explode(':', $encrypted);

    if (sizeof($stack) != 2)
      return false;

    if (md5($stack[1] . $plain) == $stack[0]) {
      return true;
    }
  }

  return false;
}

////
// This function encrypts a phpass password from a plaintext
// password.
function tep_encrypt_password($plain) {
  if (!class_exists('PasswordHash')) {
    include(DIR_WS_CLASSES . 'passwordhash.php');
  }

  $hasher = new PasswordHash(10, true);

  return $hasher->HashPassword($plain);
}

////
// This function encrypts a salted password from a plaintext
// password.
function tep_encrypt_old_password($plain) {
  $password = '';

  for ($i = 0; $i < 10; $i++) {
    $password .= tep_rand();
  }

  $salt = substr(md5($password), 0, 2);

  $password = md5($salt . $plain) . ':' . $salt;

  return $password;
}

////
// This function returns the type of the encrpyted password
// (phpass or salt)
function tep_password_type($encrypted) {
  if (preg_match('/^[A-Z0-9]{32}\:[A-Z0-9]{2}$/i', $encrypted) === 1) {
    return 'salt';
  }

  return 'phpass';
}

/**
 * This function generate customers public and private keys, encrypt private key with passphrase
 *
 * @param string $password plaintext
 * @param int $customer_id used customer id
 */
function pure_ssl_generate_customer_keys($password, $customer_id) {
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
function decrypt($crypttext, $crypted_password, $customer_id, $role = 'customer') {
  $crypt_array = explode('|', $crypttext);
  if ($role == 'customer') {
    $crypttext = $crypt_array['0'];

    $keys_query = tep_db_query("SELECT private_key_customer FROM " . constant('TABLE_KEYS_CUSTOMER') . " WHERE customers_id = '" . $customer_id . "'");
    $keys = tep_db_fetch_array($keys_query);
    if (tep_db_num_rows($keys_query)) {
      $private_key_master_data = $keys['private_key_customer'];
      $privateKey = openssl_pkey_get_private($private_key_master_data, decrypt_session_password($crypted_password));
      openssl_private_decrypt(base64_decode($crypttext), $decrypted, $privateKey);
      openssl_free_key($privateKey);
    } else
      $decrypted = 'ERROR: Private key not found (decrypt)';
  }
  return $decrypted;
}

/**
 * Encrypt string with customers and admins key
 * @param type $source
 * @param type $customer_id
 * @param type $role
 * @return type
 */
function encrypt($source, $customer_id, $role = 'customer') {
  $pk_query = tep_db_query("SELECT public_key_customer FROM " . TABLE_KEYS_CUSTOMER . " WHERE customers_id = '" . $customer_id . "'");
  $pk = tep_db_fetch_array($pk_query);
//    $pub_key = $pk['public_key_admin']; else $pub_key = $pk['public_key_customer'];
  openssl_public_encrypt($source, $crypttext_customer, $pk['public_key_customer']);
  $pk_query = tep_db_query("SELECT public_key_admin FROM " . TABLE_KEYS_ADMIN . " WHERE customers_id = '" . $customer_id . "'");
  $pk = tep_db_fetch_array($pk_query);
  openssl_public_encrypt($source, $crypttext_admin, $pk['public_key_admin']);
  return base64_encode($crypttext_customer) . '|' . base64_encode($crypttext_admin);
}

////
// This function encrypt session password
function encrypt_session_password($source) {
  $public_key = file_get_contents(SERVER_SESSION_CUSTOMER_PUBLIC_KEY);
  openssl_public_encrypt($source, $encrypted, $public_key);
  return base64_encode($encrypted);
}

function decrypt_session_password($crypttext) {
  if (file_exists(SERVER_SESSION_CUSTOMER_PRIVATE_KEY)) {
    $private_key_data = file_get_contents(constant('SERVER_SESSION_CUSTOMER_PRIVATE_KEY'));
    $privateKey = openssl_pkey_get_private($private_key_data);
    openssl_private_decrypt(base64_decode($crypttext), $decrypted, $privateKey);
    openssl_free_key($privateKey);
  } else
    echo 'ERROR: Admin Private key not found (decrypt_session_password)';
  return $decrypted;
}
