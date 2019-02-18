<?php


use Phinx\Migration\AbstractMigration;

class ConfigSessionForceCookieUseTrue extends AbstractMigration
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
        DELETE FROM configuration WHERE configuration_key='SESSION_FORCE_COOKIE_USE';
				insert into configuration (configuration_title, configuration_key, configuration_value,   configuration_description, configuration_group_id, sort_order,  last_modified, date_added)  
					values 
				('Force session cookies', 'SESSION_FORCE_COOKIE_USE', 'True', 'Set to False to alow SID', '1', '1099', NOW(), NOW());
        
				

        ");

    }
}
