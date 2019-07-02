<?php
/*DEFAULT_CURRENCY, DEFAULT_LANGUAGE moved from DB to 
config.php and ALL oscconfig/languages/en/static_* files
*/
use Phinx\Migration\AbstractMigration;

class DefaultLanguageCurrency extends AbstractMigration
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
delete from configuration WHERE configuration_key = 'DEFAULT_CURRENCY';
delete from configuration WHERE configuration_key = 'DEFAULT_LANGUAGE';
update configuration set configuration_value = 'false' where configuration_key = 'USE_DEFAULT_LANGUAGE_CURRENCY';
");

    }
}
