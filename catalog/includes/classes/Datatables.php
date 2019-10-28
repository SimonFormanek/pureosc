<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace PureOSC;

use Ozdemir\Datatables\DB\MySQL;

/**
 * Description of Datatables
 *
 * @author vitex
 */
class Datatables extends \Ozdemir\Datatables\Datatables
{
    /**
     *
     * @var Engine
     */
    public $engine = null;

    public function __construct(Engine $engine = null)
    {
        $config = [
            'host' => constant('DB_SERVER'),
            'port' => defined('DB_PORT') ? constant('DB_PORT') : 3306,
            'username' => constant('DB_SERVER_USERNAME'),
            'password' => constant('DB_SERVER_PASSWORD'),
            'database' => constant('DB_DATABASE')
            ];
        
        parent::__construct( new MySQL($config));
        
        if($engine){
            $this->engine = $engine;
        }
        
    }
    
    public function getMyData(){
        return $this->query('SELECT '.implode(',', array_keys($this->engine->columns())).' from '.$this->engine->getMyTable());
    }
   
    
}
