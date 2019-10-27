<?php

use Phinx\Migration\AbstractMigration;

class ConfigDefaultManufacturer extends AbstractMigration {

    /**
     * Migrate Up.
     */
    public function up() {


        $stmt = $this->query('SELECT * FROM manufacturers'); // returns PDOStatement
        if (empty($stmt->fetchAll())) {

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
