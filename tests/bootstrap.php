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
require_once __DIR__ . '/../../oscconfig/configure.php';
require_once __DIR__ . '/../../oscconfig/dbconfigure.php';
//require_once __DIR__ . '/../catalog/includes/application_top.php';
// include the list of project filenames
require(constant('DIR_FS_MASTER_ROOT_DIR') . 'catalog/' . constant('DIR_WS_INCLUDES') . 'filenames.php');

// TODO: to testy se musi pripravit REAL tabulky
require(DIR_FS_MASTER_ROOT_DIR . 'tests/database_tables_tests.php');

// include the database functions
require(DIR_FS_MASTER_ROOT_DIR . 'catalog/' . DIR_WS_FUNCTIONS . 'database.php');

// make a connection to the database... now
tep_db_connect() or die('Unable to connect to database server!');

// set the application parameters
$configuration_query = tep_db_query('select configuration_key as cfgKey, configuration_value as cfgValue from ' . TABLE_CONFIGURATION);
while ($configuration = tep_db_fetch_array($configuration_query)) {
  define($configuration['cfgKey'], $configuration['cfgValue']);
}




//define('SERVER_SESSION_CUSTOMER_PRIVATE_KEY', dirname(__FILE__) . DIRECTORY_SEPARATOR . 'server_session_customer_key.private');
