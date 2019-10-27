#!/usr/bin/php
<?php
//echo __DIR__;
//exit;
        //create admin keys
        $privateKey         = openssl_pkey_new(array(
            'digest_alg' => 'sha512',
            'private_key_bits' => 4096,
            'private_key_type' => OPENSSL_KEYTYPE_RSA,
        ));
        openssl_pkey_export_to_file($privateKey, __DIR__ . '/../../oscconfig/root-private.pem');
        $admin_key_array    = openssl_pkey_get_details($privateKey);
        file_put_contents(__DIR__ . '/../../oscconfig/root-pub.pem',
            $admin_key_array['key']);
        openssl_free_key($privateKey);
