<?php

use Phinx\Seed\AbstractSeed;

class Reset extends AbstractSeed
{

    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {
        $options = $this->adapter->getOptions();
        exec("echo drop database {$options['name']} | mysql -u {$options['user']} -p{$options['pass']} -h{$options['host']}  ");
        exec("echo create database {$options['name']} | mysql -u {$options['user']} -p{$options['pass']} -h{$options['host']}  ");
    }
}
