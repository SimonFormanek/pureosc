<?php 
//username definition: 2 chars DB_SERVER_USERNAME_PREFIX + 3 chars acces level + 11 chars salt
//admin users acces level roles: adm = ordinary admin, mad = master admin
//username examples: poadm1234567890 = ordinary admin, pomad12345678901 = master admin

//master server
//  define('MULTI_DATABASE','false'); //true if defined multiple databases
  define('DB_SERVER', 'localhost'); //localhost <------ need to bee configured
  define('DB_DATABASE', 'pureosc'); //puretst5 // <------ need to bee configured
//  define('DB_PORT','3307');
  define('DB_SERVER_USERNAME', 'root');
  define('DB_SERVER_PASSWORD', '');
