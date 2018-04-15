#!/usr/bin/php
<?php
////
// This functuon create server session customer key
function create_server_session_customer_key(){
          $privateKey = openssl_pkey_new(array(
          'digest_alg' => 'sha512',
          'private_key_bits' => 4096,
          'private_key_type' => OPENSSL_KEYTYPE_RSA,
          ));
  				//TODO: passphrasse add to admin private key???
          openssl_pkey_export_to_file($privateKey, './server_session_customer_key.private');
					$public_key_array = openssl_pkey_get_details($privateKey);
					$public_key = $public_key_array['key'];
					echo 'pk:' . $public_key ."\n";
    			file_put_contents('./server_session_customer_key.pub' ,$public_key);

	openssl_free_key($privateKey);
}
create_server_session_customer_key();