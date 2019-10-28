<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace PureOSC\Admin;

/**
 * Description of Configurator
 *
 * @author vitex
 */
class Configurator extends \Ease\SQL\Engine {

    public $myTable = 'configuration';

    public function setUpConstatnts() {
        $shared = \Ease\Shared::singleton();
        foreach ($this->getColumnsFromSQL(['configuration_key', 'configuration_value']) as $cfgRaw) {
            define($cfgRaw['configuration_key'], $cfgRaw['configuration_value']);
            $shared->setConfigValue($cfgRaw['configuration_key'], $cfgRaw['configuration_value']);
        }
    }

}
