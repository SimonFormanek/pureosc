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
class Cenik extends \FlexiPeeHP\Cenik
{

    use \Ease\SQL\Orm;
    public $nameColumn = 'nazev';

    public function __construct($init = null, $options = array())
    {
        parent::__construct($init, $options);
        $this->takemyTable('products');
    }

    public function convertOscData($productData)
    {
        $cenikData['id'] = 'ext:products:'.$productData['products_id'];

        $cenikData['cenaZakl'] = $productData['products_price'];

        $cenikData['nazev']  = $productData['products_name'];
        $cenikData['popis']  = $productData['products_description'];
        $kodSource           = empty($productData['products_model']) ? empty($productData['products_seo_title'])
                ? $productData['products_name'] : $productData['products_model']
                : $productData['products_seo_title'];
        $cenikData['poznam'] = _('FlexiBee import');
        $cenikData['kod']    = \FlexiPeeHP\FlexiBeeRO::uncode($this->getKod($kodSource));

        return $cenikData;
    }
}
