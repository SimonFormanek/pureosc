<?php
/**
 * @category    Payment
 * @author      Global Payments Europe s.r.o. (emailgpwebpay@gpe.cz)
 */

function GpeMuzoCreateOrder(    // funkce presmeruje browser s pozadavkem na server Muzo     
	$urlMuzoCreateOrder,      // adresa kam posilat pozadavek do Muzo
	$replyUrl,                // adresa kam ma Muzo presmerovat odpoved
	$privateKeyFile,          // soubor s privatnim klicem
	$privateKeyPass,          // heslo privatniho klice
	$merchantNumber,          // cislo obchodnika
	$orderNumber,             // cislo objednavky
	$amount,                  // hodnota objednavky v halerich
	$currency,                // kod meny (pro ceske PayMuzo funguje pouze kod 203, coz je CZK)
	$depositFlag,             // uhrada okamzite "1", nebo uhrada az z admin rozhrani
	$merOrderNum,             // identifikace objednavky pro obchodnika
	$description,             // popis nakupu, pouze ASCII
	$md) {                    // data obchodnika, pouze ASCII

	$operation = "CREATE_ORDER";
	$digest = GpeMuzoDigest($privateKeyFile, $privateKeyPass, $replyUrl, $operation, $merchantNumber, $orderNumber, $amount, $currency, $depositFlag, $merOrderNum, $description, $md);

	$getfs = $urlMuzoCreateOrder . "?";
	$getfs .= "MERCHANTNUMBER=" .    urlencode($merchantNumber) . "&";
	$getfs .= "OPERATION=" .         urlencode($operation) . "&";
	$getfs .= "ORDERNUMBER=" .       urlencode($orderNumber) . "&";
	$getfs .= "AMOUNT=" .            urlencode($amount) . "&";
	$getfs .= "CURRENCY=" .          urlencode($currency) . "&";
	$getfs .= "DEPOSITFLAG=" .       urlencode($depositFlag) . "&";
	$getfs .= "MERORDERNUM=" .       urlencode($merOrderNum) . "&";
	$getfs .= "URL=" .               urlencode($replyUrl) . "&";
	$getfs .= "DESCRIPTION=" .       urlencode($description) . "&";
	$getfs .= "MD=" .                urlencode($md) . "&";
	$getfs .= "DIGEST=" .            urlencode($digest);

	Header("Location: $getfs");
	return $getfs; // vracene url muze byt pouzito napriklad pro logovani
}

function GpeMuzoReceiveReply(     // funkce zpracuje a overi zpetne presmerovani z Muzo
	$muzoPublicKeyFile,         // soubor s verejnym klicem Muzo
	&$orderNumber,              // cislo objednavky
	&$merOrderNum,              // identifikace objednavky pro obchodnika
	&$md,                       // data obchodnika, pouze ASCII
	&$prCode,                   // primarni kod
	&$srCode,                   // sekundarni kod
	&$resultText) {             // slovni popis chyby

	$signHash = "CREATE_ORDER";
	$orderNumber = $_REQUEST["ORDERNUMBER"];   $signHash .=  "|".$orderNumber;
	$merOrderNum = $_REQUEST["MERORDERNUM"]; $signHash .= "|" . $merOrderNum;
	$md = $_REQUEST["MD"]; if ($md != '') $signHash .= "|" . $md;
	$prCode = $_REQUEST["PRCODE"]; $signHash .= "|" . $prCode;
	$srCode = $_REQUEST["SRCODE"]; $signHash .= "|" . $srCode;
	$resultText = $_REQUEST["RESULTTEXT"]; $signHash .= "|" . $resultText;
	
	$digest = $_REQUEST["DIGEST"];
	return GpeMuzoVerify($signHash, $digest, $muzoPublicKeyFile);  // urcuje zda byl podpis verohodny, stav provedeni platby je vsak urcen vracenym argumenten prCode!
}

function GpeMuzoDigest(         // funkce vrati podepsany digest pozadavku
	$privateKeyFile,          // soubor s privatnim klicem
	$privateKeyPass,          // heslo privatniho klice
	$replyUrl,                // adresa kam ma Muzo presmerovat odpoved
	$operation,               // pouze CREATE_ORDER
	$merchantNumber,          // cislo obchodnika
	$orderNumber,             // cislo objednavky
	$amount,                  // hodnota objednavky v halerich
	$currency,                // kod meny (pro ceske PayMuzo funguje pouze kod 203, coz je CZK)
	$depositFlag,             // uhrada okamzite "1", nebo uhrada az z admin rozhrani
	$merOrderNum,             // identifikace objednavky pro obchodnika
	$description,             // popis nakupu, pouze ASCII
	$md) {                    // data obchodnika, pouze ASCII
	
	$digestSrc = $merchantNumber . "|" . $operation . "|" . $orderNumber . "|" . $amount . "|" . $currency . "|" . $depositFlag . "|" . $merOrderNum . "|" . $replyUrl . "|" . $description . "|" . $md;
	if ($digestSrc[strlen($digestSrc)-1]=='|') $digestSrc = substr($digestSrc,0,strlen($digestSrc)-1);   // korekce chyby v implementaci GPE
	$digest = GpeMuzoSign($digestSrc, $privateKeyFile, $privateKeyPass);

	return $digest;
}


function GpeMuzoSign($text, $keyFile, $password) {
  $fp = fopen($keyFile, "r");
  $privatni = fread($fp, filesize($keyFile));
  fclose($fp);
  $pkeyid = openssl_get_privatekey($privatni, $password);
  openssl_sign($text, $signature, $pkeyid);
  $signature = base64_encode($signature);
  openssl_free_key($pkeyid);
  return $signature;
}

function GpeMuzoVerify($text, $sigb64, $keyFile) {
  $fp = fopen($keyFile, "r");
  $verejny = fread($fp, filesize($keyFile));
  fclose($fp);
  $pubkeyid = openssl_get_publickey($verejny);
  $signature = base64_decode($sigb64);
  $vysledek = openssl_verify($text, $signature, $pubkeyid);
  openssl_free_key($pubkeyid);
  return (($vysledek==1) ? true : false);
}

?>
