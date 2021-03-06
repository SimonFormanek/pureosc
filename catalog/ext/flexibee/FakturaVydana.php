<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace PureOSC\flexibee;

/**
 * Description of Customer
 *
 * @author Vítězslav Dvořák <info@vitexsoftware.cz>
 */
class FakturaVydana extends \FlexiPeeHP\FakturaVydana
{

    use \Ease\SQL\Orm;
    
    public function __construct($init = null, $options = array())
    {
        $this->nameColumn = 'nazev';
        $this->myTable = 'orders';
        parent::__construct($init, $options);
    }
    
    public function convertOscData($orderData)
    {
        $invoiceData['id'] = 'ext:osc:'.$orderData['orders_id'];

        if ($orderData['orders_status'] > 100) {
            $invoiceData['stavUhrK'] = 'stavUhr.uhrazenoRucne';
        }

        $datVyst = new \DateTime($orderData['date_purchased']);

        $invoiceData['datVyst'] = $this->timestampToFlexiDate($datVyst->getTimestamp());
        //$invoiceData['cenaZakl'] = $orderData['orders_price'];
//        $invoiceData['nazev']  = $orderData['orders_name'];
//        $invoiceData['popis']  = $orderData['orders_description'];
        $kodSource              = $orderData['orders_id'];
        $invoiceData['poznam']  = _('FlexiBee import');
//        $invoiceData['kod']    = \FlexiPeeHP\FlexiBeeRO::uncode($this->getKod($kodSource));

        return $invoiceData;
    }

    public function orderItems($id)
    {
        return $this->dblink->queryToArray('SELECT * FROM orders_products WHERE orders_products_id = '.$id);
    }

    public function addOrderItems($id)
    {
        $items = $this->orderItems($id);
        if (is_array($items)) {
            foreach ($items as $item) {
                $itemData             = ['typPolozkyK' => 'typPolozky.katalog'];
                $itemData['cenik']    = 'ext:products:'.$item['products_id'];
                $itemData['mnozMj']   = $item['products_quantity'];
                $itemData['cenaZakl'] = $item['products_price'];
                $this->addArrayToBranch($itemData, 'polozkyFaktury');
            }
        }
    }

    public function insertToFlexiBee($data = null)
    {
        if (is_null($data)) {
            $data = $this->getData();
        }
        $result = parent::insertToFlexiBee($data);

        if ($this->responseStats['inserted'] == 1) {
            FlexiPeeHP\Priloha::addAttachmentFromFile($invoice,
                'pub/obchodni-podminky.pdf');
            FlexiPeeHP\Priloha::addAttachmentFromFile($invoice,
                'pub/navratovy-reklamacni-list.pdf');
        }


        return $result;
    }

    public function performAction($action, $method = 'int')
    {
        if ($action == 'storno') {
            global $order_id;
            $this->updateToSQL(['id' => $order_id, 'orders_status' => 3]);
        }
        return parent::performAction($action, $method = 'int');
    }

    public function holderCancel()
    {
        $this->setDataValue('poznam', _('The Card holder canceled the payment'));
        $this->performAction('storno');
        $this->updateToSQL(['id' => $order_id, 'orders_status' => 4]); //FIXME: Variable needed
}
}
