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
class Customers extends \Ease\SQL\Engine
{

    public function __construct($init, $options = [])
    {
        $this->keyColumn = 'customers_id';
        $this->myTable = 'customers';
        parent::__construct($init, $options);
    }
}
