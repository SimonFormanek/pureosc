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
function tep_validate_password($plain, $encrypted)
{
    if (tep_not_null($plain) && tep_not_null($encrypted)) {
      $info = password_get_info($encrypted);
      if($info['algo'] > 0) return password_verify($plain, $encrypted);
        if (tep_password_type($encrypted) == 'salt') {
            return tep_validate_old_password($plain, $encrypted);
        }

        $hasher = new PasswordHash(10, true);

        return $hasher->CheckPassword($plain, $encrypted);
    }

    return false;
}

////
// This function validates a plain text password with a
// salted password
function tep_validate_old_password($plain, $encrypted)
{
    if (tep_not_null($plain) && tep_not_null($encrypted)) {
// split apart the hash / salt
        $stack = explode(':', $encrypted);

        if (sizeof($stack) != 2) return false;

        if (md5($stack[1].$plain) == $stack[0]) {
            return true;
        }
    }

    return false;
}

////
// This function encrypts a phpass password from a plaintext
// password.
function tep_encrypt_password($plain)
{
    $hasher = new PasswordHash(10, true);

    return $hasher->HashPassword($plain);
}

////
// This function encrypts a salted password from a plaintext
// password.
function tep_encrypt_old_password($plain)
{
    $password = '';

    for ($i = 0; $i < 10; $i++) {
        $password .= tep_rand();
    }

    $salt = substr(md5($password), 0, 2);

    $password = md5($salt.$plain).':'.$salt;

    return $password;
}

////
// This function returns the type of the encrpyted password
// (phpass or salt)
function tep_password_type($encrypted)
{
    if (preg_match('/^[A-Z0-9]{32}\:[A-Z0-9]{2}$/i', $encrypted) === 1) {
        return 'salt';
    }

    return 'phpass';
}
//-------------------JSP ZAHUMENEK--------------------------

function jsp_passless_crypt($source) 
{
/*
$fp=fopen(PEM_PATH.'root-pub.pem',"r");
$pub_key=fread($fp,800);
fclose($fp);
*/

$pub_key = file_get_contents(PEM_PATH.'root-pub.pem');



//$pub_key = '';
openssl_get_publickey($pub_key);

// * NOTE:  Here you use the $pub_key value (converted, I guess)
$crypttext = '';
openssl_public_encrypt($source, $crypttext, $pub_key);
$ret = base64_encode($crypttext);
//prdel("crypt return '".$ret."'\n");
return $ret;
//return $crypttext;
}
//-----------------------------------------------------------

function jsp_passless_decrypt($crypttext) 
{
//prdel("IN:".$crypttext."\n");

$crypttext = base64_decode($crypttext);

//prdel("BASE64dec:".$crypttext."\n");
/*
$fp=fopen(PEM_PATH.'root-private.pem',"r");
$priv_key=fread($fp,888888);
fclose($fp);
*/

$priv_key = file_get_contents(PEM_PATH.'root-private.pem');


// $passphrase is required if your key is encoded (suggested)
$res = openssl_get_privatekey($priv_key, file_get_contents(PEM_PATH.'jsp_passless'));

//'WhZYmVsjZnuNfMrQmkKjCNPUXVL22r4hKKTsemidmStdnuSLLAraXuCVh5kq8K7qszaVyEF7Cf9YPAXqcXqqWBBPtihFrHQCW8tkCeQrQshcmB8evN5EHU4diXF3qCuv'
//prdel("RES: ".print_r($res, true)."\n");

//NOTE:  Here you use the returned resource value
$newsource = '';
$sslret = openssl_private_decrypt($crypttext, $newsource, $res);
//echo "String decrypt : $newsource";
//prdel("newsource:".$newsource."\nsslret: ".($sslret?"TRUE\n":"FALSE\n"));

return $newsource;
}
//-----------------------------------------------------------