<?php

use Phinx\Seed\AbstractSeed;

class ResetAdmin extends AbstractSeed
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
        $admins = $this->table('administrators');
        $admins->truncate();
        $ar = $this->table('action_recorder');
        $ar->truncate();
    }
}
