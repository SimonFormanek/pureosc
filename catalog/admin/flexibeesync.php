<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2010 osCommerce

  Released under the GNU General Public License
 */

require('includes/application_top.php');

$action = (isset($_GET['action']) ? $_GET['action'] : '');

switch ($action) {
    case 'sync':
        break;
    case 'submit':
    default:
        break;
}

require(DIR_WS_INCLUDES.'template_top.php');

$container = new Ease\TWB\Container(new \Ease\Html\H1Tag(_('FlexiBee sync')));


$adresar   = new PureOSC\flexibee\Adresar();
$kontakter = new PureOSC\flexibee\Kontakt();


$ids  = $adresar->getAllFromFlexibee();
$list = new Ease\Html\UlTag();
//foreach ($ids as $idinfo) {
//    $sql_data_array = array('customers_firstname' => $firstname,
//        'customers_lastname' => $lastname,
//        'customers_email_address' => $email_address);
//    tep_db_perform(TABLE_CUSTOMERS, $sql_data_array);
//    $list->addItemSmart(implode(':', $idinfo));
//}



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
        $list->addItemSmart(new Ease\Html\ATag($adresar->getApiURL(),
                $adresar->getRecordIdent()));
    }
}
$container->addItem($list);
echo $container;

require(DIR_WS_INCLUDES.'template_bottom.php');
require(DIR_WS_INCLUDES.'application_bottom.php');

