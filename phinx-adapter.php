<?php
/**
 * Icinga Editor - Phinx Adapter
 *
 * @author     Vitex <vitex@hippy.cz>
 * @copyright  2018 Vitex@hippy.cz (G)
 */


include_once './vendor/autoload.php';

//\Ease\Shared::instanced()->loadConfig('config.json', 'true');

if (file_exists('../oscconfig/dbconfigure.php')) {
    require_once '../oscconfig/dbconfigure.php';
} else {
    echo "Using BulitIN dbconfig\n";
    define('DB_PORT',3306);
    define('DB_SERVER', '127.0.0.1');
    define('DB_DATABASE', 'pureosc');
    define('DB_SERVER_USERNAME', 'pureosc');
    define('DB_SERVER_PASSWORD', 'pureosc');
//EasePHP Framework
    define('DB_HOST', constant('DB_SERVER'));
    define('DB_PASSWORD', constant('DB_SERVER_PASSWORD'));
    define('DB_USERNAME', constant('DB_SERVER_USERNAME'));
    define('DB_TYPE', 'mysql');
   
}

$eng = new Ease\SQL\Engine();


return array('environments' =>
    array(
        'default_database' => 'development',
        'development' => array(
            'name' => $eng->database,
            'connection' => $eng->getPdo()
        ),
        'default_database' => 'production',
        'production' => array(
            'name' => $eng->database,
            'connection' => $eng->getPdo()
        ),
    ),
    'paths' => [
        'migrations' => 'db/migrations',
        'seeds' => 'db/seeds'
    ]
);
