<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace PureOSC\flexibee;

/**
 * Description of StromCenik
 *
 * @author Vítězslav Dvořák <info@vitexsoftware.cz>
 */
class StromCenik extends \FlexiPeeHP\StromCenik
{

    use \Ease\SQL\Orm;

    public function __construct($init = null, $options = array())
    {
        parent::__construct($init, $options);
        $this->takemyTable('products-to-categories');
    }
    
    
    public function convertOscData($productData){
        
    }
}
