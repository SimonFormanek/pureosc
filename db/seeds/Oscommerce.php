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
        $this->execute(file_get_contents(str_replace(".php",".sql", __FILE__)));
    }
}
