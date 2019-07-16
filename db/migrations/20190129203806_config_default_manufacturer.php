<?php


use Phinx\Migration\AbstractMigration;

class ConfigDefaultManufacturer extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    addCustomColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Any other destructive changes will result in an error when trying to
     * rollback the migration.
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
      $this->execute("insert into manufacturers (manufacturers_name) VALUES ('Change this to Default')");
      $this->execute("insert into manufacturers_info (manufacturers_id, languages_id) VALUES (1,1)");
      $this->execute("insert into manufacturers_info (manufacturers_id, languages_id) VALUES (1,4)");
    }
}
