<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2010 osCommerce

  Released under the GNU General Public License
 */

namespace PureOSC;

require('includes/application_top.php');
require(DIR_WS_INCLUDES.'template_top.php');


$invoice = new flexibee\FakturaVydana($_REQUEST['id']);
if ($invoice->getDataCount()) {
    $casher = new \FlexiPeeHP\PokladniPohyb($_REQUEST['id']);

    if (empty($casher->getData())) { // Create New Payment
        $converter = new \FlexiPeeHP\Bricks\Convertor($invoice, $casher);
        $converter->conversion();
        $casher->setDataValue('nazev', _('Cash payment').': '.$_REQUEST['id']);
        $casher->unsetDataValue('kod');
        $casher->setDataValue('typPohybuK', 'typPohybu.prijem');
        $casher->setDataValue('datVyst', new \DateTime());
        $casher->setDataValue('typDokl', 'code:STANDARD');
        if ($invoice->getDataValue('mena') == 'code:CZK') {
            $casher->setDataValue('pokladna', 'code:POKLADNA KČ');
        } else {
            $casher->setDataValue('pokladna', 'code:POKLADNA EUR');
        }
        $casher->setDataValue('id', $_REQUEST['id']);
        if ($casher->sync()) {
            if ($invoice->sparujPlatbu($casher)) {

                //Set Status to "No Delivery"
                tep_db_query("UPDATE ".TABLE_ORDERS." SET orders_status = '".tep_db_input('9')."', 
                      last_modified = now() 
                      WHERE orders_id = '".$invoice->getExternalID('orders')."'");


                echo 'Platba se sparovala !';
            } else {
                echo 'Platba se nesparovala !';
            }
        }
    } else {
        //   echo 'platba již existuje';
    }
}

echo '<h3>'._('Payment')."</h3>";

echo new \Ease\Html\DivTag(new \FlexiPeeHP\ui\EmbedResponsivePDF($casher),
    ['style' => 'width: 600px']);

echo '<h3>'._('Invoice')."</h3>";


echo new \Ease\Html\DivTag(new \FlexiPeeHP\ui\EmbedResponsivePDF($invoice),
    ['style' => 'width: 600px']);

require(DIR_WS_INCLUDES.'template_bottom.php');
require(DIR_WS_INCLUDES.'application_bottom.php');

