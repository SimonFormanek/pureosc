<?php

namespace PureOSC\SslCrypto;

/**
 * @author Simon Formanek <mail at simonformanek.cz>
 */
class SslEncryptSessionPassword {

  /**
   * encrypt session password
   * @param string $source plaintext
   */
  public static function ssl_encrypt_session_password($source) {
    $public_key = file_get_contents(SERVER_SESSION_CUSTOMER_PUBLIC_KEY);
    openssl_public_encrypt($source, $encrypted, $public_key);
    return base64_encode($encrypted);
  }

}
