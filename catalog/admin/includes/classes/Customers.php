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
class Customers extends \Ease\Brick
{

    public function __construct($init, $optins = [])
    {
        parent::__construct($init, $optins);
        $this->takemyTable('customers');
        $this->setkeyColumn('customers_id');
    }
}
