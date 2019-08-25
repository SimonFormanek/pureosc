<?php


use Phinx\Migration\AbstractMigration;

class AccessKeysConfig extends AbstractMigration
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
        $this->execute("
DELETE FROM configuration WHERE configuration_key = 'ACCESSKEY_SAVE';
				insert into configuration (configuration_title, configuration_key, configuration_value,   configuration_description, configuration_group_id, sort_order,  last_modified, date_added)  
					values 
				('Access Key Save', 'ACCESSKEY_SAVE', 's', 'Letter, default: s', '1', '9999', NOW(), NOW());

DELETE FROM configuration WHERE configuration_key = 'ACCESSKEY_SELECT';
				insert into configuration (configuration_title, configuration_key, configuration_value,   configuration_description, configuration_group_id, sort_order,  last_modified, date_added)  
					values 
				('Access Key Select', 'ACCESSKEY_SELECT', 'x', 'Letter, default: x', '1', '9999', NOW(), NOW());
        ");

    }
}
