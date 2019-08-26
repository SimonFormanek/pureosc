<?php

use Ease\Html\ATag;
use Ease\Html\H1Tag;
use Ease\Html\UlTag;
use Ease\TWB\Container;
use FlexiPeeHP\FlexiBeeRO;
use FlexiPeeHP\ui\TWB\StatusInfoBox;
use PureOSC\flexibee\Adresar;

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


$checker2 = new StatusInfoBox();



$container = new Container(new H1Tag(_('FlexiBee sync')));

$container->addItem($checker2);

if ($checker2->connected()) {
    $adresar   = new Adresar();
    $adresar->logBanner('PureOSC Sync');
    $kontakter = new PureOSC\flexibee\Kontakt();
    $ids       = $adresar->getAllFromFlexibee(['typVztahuK' => 'typVztahu.odberDodav']);

    foreach ($ids as $addressData) {
        if (array_key_exists('external-ids', $addressData)) {
            $inFlexiBee[str_replace('ext:customers:', '',
                    $addressData['external-ids'][0])] = $addressData['external-ids'][0];
        }
    }
    $list = new UlTag();
//foreach ($ids as $idinfo) {
//    $sql_data_array = array('customers_firstname' => $firstname,
//        'customers_lastname' => $lastname,
//        'customers_email_address' => $email_address);
//    tep_db_perform(TABLE_CUSTOMERS, $sql_data_array);
//    $list->addItemSmart(implode(':', $idinfo));
//}

    foreach ((new Ease\SQL\Engine(null, ['myTable' => 'customers']))->listingQuery()->orderBy('customers_lastname,customers_firstname')->fetchAll() as $customerData) {
        if (array_key_exists($customerData['customers_id'], $inFlexiBee)) {
            $adresar->addStatusMessage(_('Already exists in database').$customerData['customers_id']);
        } else {

            if (!empty($customerData['customers_anonym'])) {
                continue; //Do not import anonymous user
            }
            $adresar->setData($adresar->convertOscData($customerData), true);
            $adresar->setDataValue('typVztahuK', 'typVztahu.odberatel');
            $adresar->setDataValue('id',
                'ext:customers:'.$customerData['customers_id']);
            if ($adresar->sync()) {
                $adresar->addStatusMessage($adresar->getApiURL().' '.FlexiBeeRO::uncode($adresar->getRecordCode()),
                    'success');

                $addresses = $adresar->getContacts($customerData['customers_id']);
                foreach ($addresses as $kontakt) {
                    $kontakter->setData($kontakter->convertOscData($kontakt),
                        true);
                    $kontakter->setDataValue('id',
                        'ext:contact:'.$kontakt['address_book_id']);
                    $kontakter->setDataValue('kod', $kontakt['address_book_id']);

                    $kontakter->setDataValue('firma',
                        'ext:customers:'.$customerData['customers_id']);
                    $kontakter->setDataValue('stat',
                        $adresar->oscCountryCode($kontakt['entry_country_id']));

                    if ($kontakter->insertToFlexiBee()) {
                        $kontakter->addStatusMessage($kontakter->getApiURL().' '.FlexiBeeRO::uncode($kontakter->getRecordCode()),
                            'success');
                    }
                }
                $list->addItemSmart(new ATag($adresar->getApiURL(),
                        $adresar->getRecordIdent()));
            }
        }
    }
} else {
    $container->addItem(_('FlexiBee server not connected.'));
    $container->addItem(_('Please change  FlexiBee options').' <a href="configuration.php">'._('Here').'</a>');
}

$container->addItem($list);
echo $container;
echo \Ease\WebPage::singleton()->getStatusMessagesAsHtml();

require(DIR_WS_INCLUDES.'template_bottom.php');
require(DIR_WS_INCLUDES.'application_bottom.php');
