<?php
$crypttext = file_get_contents('/tmp/crypted');
  require('includes/application_top.php');
  require('includes/functions/password_funcs.php');
//pure_ssl_generate_customer_keys(1,'heslo');
//echo '$customer_id'.$customer_id;
echo 'jetu nekde:'.$customer_id . 'konec';
$customer_id = 1;
$decrypted = master_decrypt_admin($crypttext, $customer_id);
echo $decrypted;
