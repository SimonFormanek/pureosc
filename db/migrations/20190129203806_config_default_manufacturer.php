<?php

use Phinx\Migration\AbstractMigration;

class ConfigDefaultManufacturer extends AbstractMigration {
//        $this->execute("insert into manufacturers (manufacturers_name) VALUES ()");
//        $this->execute("insert into manufacturers_info (manufacturers_id) VALUES (1)");

    /**
     * Migrate Up.
     */
    public function up() {


        $stmt = $this->query('SELECT * FROM manufacturers'); // returns PDOStatement
        if(empty($stmt->fetchAll())) {

            $table = $this->table('manufacturers');
            $table->insert(['manufacturers_id' => 1, 'manufacturers_name' => _('Default manufacturer')]);
            $table->saveData();

            $table = $this->table('manufacturers_info');
            $table->insert([
                'manufacturers_id' => 1,
                'manufacturers_url' => '',
                'languages_id' => 4,
                'manufacturers_description' => _('Only manufacturer yet')]);
            $table->saveData();
        }
    }

}
