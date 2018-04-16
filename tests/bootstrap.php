<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * @author Simon Formanek <mail at simonformanek.cz>
 */
// TODO: check include path
//ini_set('include_path', ini_get('include_path'));
// put your code here
require_once __DIR__ . '/../vendor/autoload.php';

define('SERVER_SESSION_CUSTOMER_PRIVATE_KEY', dirname(__FILE__) . DIRECTORY_SEPARATOR . 'server_session_customer_key.private');
