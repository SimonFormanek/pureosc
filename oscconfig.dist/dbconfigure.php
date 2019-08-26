<?php
//  define('MULTI_DATABASE','false'); //true if defined multiple databases
define('DB_SERVER', 'XDBSERVERX');
define('DB_DATABASE', 'XDBDATABASEX');
define('DB_SERVER_USERNAME', 'XDBSERVERUSERNAMEX');
define('DB_SERVER_PASSWORD', 'XDBSERVERPASSWORDX');


//EasePHP Framework
define('DB_HOST', constant('DB_SERVER'));
define('DB_PASSWORD', constant('DB_SERVER_PASSWORD'));
define('DB_USERNAME', constant('DB_SERVER_USERNAME'));
define('DB_TYPE', 'mysql');
