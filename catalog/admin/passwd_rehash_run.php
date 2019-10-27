#!/usr/bin/php
<?php
if (file_exists('includes/local/configure.php')) { // for developers
  include('includes/local/configure.php');
} else {
  include('../../../oscconfig/admin/configure.php');
  include('../../../oscconfig/dbconfigure.php');
}


// include the list of project filenames
require(DIR_WS_INCLUDES . 'filenames.php');

// include the list of project database tables
require(DIR_WS_INCLUDES . 'database_tables.php');

require(DIR_WS_FUNCTIONS . 'database.php');

// make a connection to the database... now
$db_link = tep_db_connect() or die("\nUnable to connect to database server!\n\n");
//$pic_link = tep_db_connect('192.168.32.1', 'yi19aazqn', 'AyEfNhiHq8cl', 'yinyang', 'pic_link') or die("\nNeda se pripojit do picfuku!\n\n");
// set application wide parameters
$configuration_query = tep_db_query('select configuration_key as cfgKey, configuration_value as cfgValue from ' . TABLE_CONFIGURATION);
while ($configuration = tep_db_fetch_array($configuration_query)) {
  if (!defined($configuration['cfgKey']))
    define($configuration['cfgKey'], $configuration['cfgValue']);
}

//-------------------JSP ZAHUMENEK--------------------------

function jsp_passless_crypt($source) {
  /*
    $fp=fopen(PEM_PATH.'root-pub.pem',"r");
    $pub_key=fread($fp,800);
    fclose($fp);
   */

  $pub_key = file_get_contents(PEM_PATH . 'root-pub.pem');



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

function jsp_passless_decrypt($crypttext) {
//prdel("IN:".$crypttext."\n");

  $crypttext = base64_decode($crypttext);

//prdel("BASE64dec:".$crypttext."\n");
  /*
    $fp=fopen(PEM_PATH.'root-private.pem',"r");
    $priv_key=fread($fp,888888);
    fclose($fp);
   */

  $priv_key = file_get_contents(PEM_PATH . 'root-private.pem');


// $passphrase is required if your key is encoded (suggested)
  $res = openssl_get_privatekey($priv_key, file_get_contents(PEM_PATH . 'jsp_passless'));

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


echo "-------------- START " . date('j.n.Y H:i:s') . " ------------------\n\n";

$U = false;
$F = false;

foreach ($argv as $pK => $par) {
  if (strpos($par, 'U') !== false) {
    $U = true;
    echo "!!! OSTRY UPDATE !!!\n\n";
  };
  //if(strpos($par, 'F') !== false) { $F = true; echo "DOHLEDAVANI DLE NAZVU ZAPNUTO\n\n"; }; 
}


//------------------------------------------------------------------------------------------------------
/*
  $eQ = tep_db_query("check table rehash_needed");
  if($eA = tep_db_fetch_array($eQ)) {

  if($eA['Msg_text'] == 'OK') {

  echo "Tabulka rehash_needed OK\n\n";
  $ok = true;

  } else {

  echo "Tabulka rehash_needed NEEXISTUJE - zakladam.. ";

  $ok = tep_db_query("CREATE TABLE rehash_needed (customers_id int(11), orig_hash text)");
  echo $ok ? "OK\n\n" : "!!!SELHALO!!!\n\n";
  }

  if($ok) { //naplnit vsema custid, co jeste nejsou prehashnuty

 */




$cQ = tep_db_query("SELECT customers_id AS id, customers_password AS pass FROM customers ORDER BY customers_id");
while ($cA = tep_db_fetch_array($cQ)) { //-----------------------------------
  //if(empty($cA['pass'])) { echo "!!! custid ".$cA['id']." MA PRAZDNE HESLO!!! IGNOROVANO!!!\n"; continue; }
  if ((strpos($cA['pass'], '$P$') !== 0) && (preg_match('/^[A-Z0-9]{32}\:[A-Z0-9]{2}$/i', $cA['pass']) !== 1)) {

    echo "!!! custid " . $cA['id'] . " MA PRAZDNE CI NESMYSLNE HESLO '" . $cA['pass'] . "' !!! IGNOROVANO!!!\n";
    continue;
  }

  echo "sifruji custid " . $cA['id'] . ".. ";

  $crypted = jsp_passless_crypt($cA['pass']);

  if (!empty($crypted)) {
    echo "OK\n";
    $cryptedHash = 'CrYpTeD' . $crypted;
  } else {
    echo "!!! custid " . $cA['id'] . " - SIFROVANI VRACI PRAZDNY STRING!!! IGNOROVANO!!!\n";
    continue;
  }


  //die("\n\n!!! ERROR - SELHALO SIFROVANI !!!\nKONEC\n\n");
  //echo "'".$cA['pass']."' PREPISUJI NA '".$cryptedHash."'\n";

  if ($U) {
    tep_db_query("UPDATE customers SET customers_password = '" . $cryptedHash . "' WHERE customers_id = " . $cA['id']);
  }

  /*
    $tQ = tep_db_query("SELECT * FROM rehash_needed WHERE customers_id = ".$cA['id']);
    if(tep_db_num_rows($tQ) < 1) {
    tep_db_query("INSERT INTO rehash_needed SET customers_id = ".$cA['id']);
    } else {

    //tep_db_query("UPDATE rehash_needed SET orig_hash = '".$cA['pass']."' WHERE customers_id = ".$cA['id']);
    echo "jiz prehashovano (radek existuje)\n";
    }
   */


  /*
    } else echo "jiz prehashovano\n";
   */
} //------------------------------------------------------------------------




/*
  } else echo "\n!!! CHYBA - NELZE VYTVORIT TABULKU 'rehash_needed' !!!\n\n";

  } else echo "\n!!! CHYBA DOTAZU 'check table rehash_needed' !!!\n\n";

 */

tep_db_close();

echo "\n------------- KONEC " . date('j.n.Y H:i:s') . " -------------\n\n";

exit(0);
?>

