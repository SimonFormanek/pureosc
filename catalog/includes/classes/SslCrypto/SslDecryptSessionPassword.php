<?php

namespace PureOSC\SslCrypto;

/**
 * @author Simon Formanek <mail at simonformanek.cz>
 */
class SslDecryptSessionPassword {

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

}
