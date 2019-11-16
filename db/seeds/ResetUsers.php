<?php

use Phinx\Seed\AbstractSeed;

class ResetUsers extends AbstractSeed {

    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run() {
        $admins = $this->table('customers');
        $admins->truncate();
        $ar = $this->table('customers_info');
        $ar->truncate();
    }

}
