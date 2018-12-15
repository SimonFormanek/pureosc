<?php

use Phinx\Seed\AbstractSeed;

class Oscommerce extends AbstractSeed
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
        exec("mysql -u {$options['user']} -p{$options['pass']} {$options['name']} < ".str_replace(".php",
                ".sql", __FILE__));
    }
}
