<?php
/**
 * PureOSC - Phinx Adapter
 *
 * @author     Vitex <vitex@hippy.cz>
 * @copyright  2018 Vitex@hippy.cz (G)
 */

include_once './vendor/autoload.php';
require_once  '../oscconfig/dbconfigure.php';

return array('environments' =>
    array(
        'default_database' => 'development',
        'development' => array(
            'name' => \Ease\Shared::db()->database,
            'connection' => \Ease\Shared::db()->sqlLink
        ),
        'default_database' => 'production',
        'production' => array(
            'name' => \Ease\Shared::db()->database,
            'connection' => \Ease\Shared::db()->sqlLink
        ),
    ),
    'paths' => [
        'migrations' => 'db/migrations',
        'seeds' => 'db/seeds'
    ]
);
