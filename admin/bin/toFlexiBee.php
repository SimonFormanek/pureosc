#!/usr/bin/php -f
<?php

define('EASE_LOGGER', 'console|syslog');
chdir('../../');
require('includes/application_top.php');

$adresar   = new PureOSC\flexibee\Adresar();
$kontakter = new PureOSC\flexibee\Kontakt();


$ids  = $adresar->getAllFromFlexibee();


$adresar->addStatusMessage(count($ids).' addresses to import');

foreach ($adresar->dblink->queryToArray("select * FROM customers ORDER BY customers_lastname,customers_firstname") as $customerData) {
    $adresar->setData($adresar->convertOscData($customerData), true);
    if ($adresar->sync()) {
        $adresar->addStatusMessage($adresar->getApiURL().' '.FlexiPeeHP\FlexiBeeRO::uncode($adresar->getRecordCode()),
            'success');

        $addresses = $adresar->getContacts($customerData['customers_id']);
        foreach ($addresses as $kontakt) {
            $kontakter->setData($kontakter->convertOscData($kontakt), true);
            $kontakter->setDataValue('id',
                'ext:contact:'.$kontakt['address_book_id']);
            $kontakter->setDataValue('firma', $adresar);
            $kontakter->setDataValue('stat',
                $adresar->oscCountryCode($kontakt['entry_country_id']));

            if ($kontakter->sync()) {
                $kontakter->addStatusMessage($kontakter->getApiURL().' '.FlexiPeeHP\FlexiBeeRO::uncode($kontakter->getRecordCode()),
                    'success');
            }
        }
    }
}