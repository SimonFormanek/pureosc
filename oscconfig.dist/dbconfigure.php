<?php 
//username definition: 2 chars DB_SERVER_USERNAME_PREFIX + 3 chars acces level + 11 chars salt
//admin users acces level roles: 
//xx=2 chars db prefix, 1234567890 = salt
//shop user:
//xxano1234567890 = anonymous shop user
//xx1 = customer id 1
//admin users
//xxcad1234567890 = admin granted to ondly upate catalog
//xxadm1234567890 = ordinary admin granted to view orders
//xxmad1234567890 = master admin granted to add functions i.e.: grant all on dbname.* to dbmad@localhost identified by 'password' with grant option;
//username examples: poadm1234567890 = ordinary admin, pomad12345678901 = master admin

//master server
//  define('MULTI_DATABASE','false'); //true if defined multiple databases
  define('DB_SERVER', 'localhost'); //localhost <------ need to bee configured
  define('DB_DATABASE', 'pureosc'); // oik18 oscmaster
  define('DB_SERVER_USERNAME', 'root');
  define('DB_SERVER_PASSWORD', '');
  define('DB_SERVER_PASSWORD_CUSTOMER','secret');

//ADMIN SERVER ONLY section:
//root cron user
  define('DB_SERVER_USERNAME_ROOT', 'root');
  define('DB_SERVER_PASSWORD_ROOT', '');
//admin passphrase
  define('ADMIN_PASSPHRASE','secret');


//EasePHP Framework
define('DB_HOST', constant('DB_SERVER'));
define('DB_PASSWORD', constant('DB_SERVER_PASSWORD'));
define('DB_USERNAME', constant('DB_SERVER_USERNAME'));
define('DB_TYPE', 'mysql');
