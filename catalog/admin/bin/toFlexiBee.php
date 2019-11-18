#!/usr/bin/php -f
<?php
define('EASE_LOGGER', 'console|syslog');
chdir('../../');
require_once '../vendor/autoload.php';
\Ease\Shared::initializeGetText('pureosc', 'cs_CZ', '../i18n');
\Ease\Shared::instanced()->webPage(new \Ease\Page());

require('../../oscconfig/configure.php');
require('../../oscconfig/dbconfigure.php');

$lngSql = "SELECT languages_id FROM languages WHERE code='cs'";


$cenik    = new PureOSC\flexibee\Cenik();
$products = $cenik->dblink->queryToArray("select * FROM products p, products_description pd WHERE p.products_id=pd.products_id AND pd.language_id=(".$lngSql.")");
$cenik->addStatusMessage(count($products).' products to import');
foreach ($products as $progress => $productData) {
    $cenik->setData($cenik->convertOscData($productData), true);
    if ($cenik->sync()) {
        $cenik->addStatusMessage(($progress + 1).'/'.count($products).':'.$cenik->getApiURL().' '.FlexiPeeHP\FlexiBeeRO::uncode($cenik->getRecordCode()),
            'success');
        $imagePath = cfg('DIR_FS_CATALOG_IMAGES').$productData['products_image'];

        if (file_exists($imagePath)) {
            $cenik->addStatusMessage(sprintf(_('Image attach %s'),
                    $productData['products_image']),
                \FlexiPeeHP\Priloha::addAttachmentFromFile($cenik, $imagePath) ? 'success'
                        : 'warning' );
        }

//        $images = $cenik->dblink->queryToArray("select * FROM  products_images WHERE products_id= ".$productData['products_id']." )");
//        $cenik->addStatusMessage(count($images).' images to import');
//        foreach ($images as $imageData) {               }
    }
}

$adresar   = new PureOSC\flexibee\Adresar();
$kontakter = new PureOSC\flexibee\Kontakt();
$customers = $adresar->dblink->queryToArray("select * FROM customers ORDER BY customers_lastname,customers_firstname");
$adresar->addStatusMessage(count($customers).' addresses to import');
foreach ($customers as $progress => $customerData) {
    $customerId = $customerData['customers_id'];
    $adresar->setData($adresar->convertOscData($customerData), true);
    if ($adresar->sync()) {
        $adresar->addStatusMessage(($progress + 1).'/'.count($customers).':'.$adresar->getApiURL().' '.FlexiPeeHP\FlexiBeeRO::uncode($adresar->getRecordCode()),
            'success');
        $addresses = $adresar->getContacts($customerId);
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

$ordersQuery = "SELECT * FROM orders";

$faktura = new \PureOSC\flexibee\FakturaVydana();
$orders  = $faktura->dblink->queryToArray($ordersQuery);
$faktura->addStatusMessage(count($orders).' orders to import as invoices');

foreach ($orders as $progress => $orderData) {
    $orderId = $orderData['orders_id'];
    $faktura->setData($faktura->convertOscData($orderData), true);
    $faktura->setDataValue('typDokl', FlexiPeeHP\FlexiBeeRO::code('FAKTURA'));
    $faktura->addOrderItems($orderId);
    if ($faktura->sync()) {
        $faktura->addStatusMessage(($progress + 1).'/'.count($orders).':'.$faktura->getApiURL().' '.FlexiPeeHP\FlexiBeeRO::uncode($faktura->getRecordCode()),
            'success');
    }
}


