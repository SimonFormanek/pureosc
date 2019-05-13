<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace PureOSC\Admin;

/**
 * Description of Customers
 *
 * @author Vítězslav Dvořák <info@vitexsoftware.cz>
 */
class AddressBook extends \Ease\Brick
{

    /**
     * 
     * @param mixed $init
     * @param array $options
     */
    public function __construct($init, $options = [])
    {
        $this->takemyTable('address_book');
        $this->setkeyColumn('address_book_id');
        parent::__construct($init, $options);
        if(is_integer($init)){
            $this->loadFromSQL($init);
        }
    }
}
