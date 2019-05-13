<?php


use Phinx\Migration\AbstractMigration;

class ConfigRemoveOscDashboards extends AbstractMigration
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
        	DELETE FROM configuration WHERE configuration_key='MODULE_ADMIN_DASHBOARD_LATEST_NEWS_STATUS';
        	DELETE FROM configuration WHERE configuration_key='MODULE_ADMIN_DASHBOARD_LATEST_NEWS_SORT_ORDER';

        	DELETE FROM configuration WHERE configuration_key='MODULE_ADMIN_DASHBOARD_LATEST_ADDONS_STATUS';
        	DELETE FROM configuration WHERE configuration_key='MODULE_ADMIN_DASHBOARD_LATEST_ADDONS_SORT_ORDER';

        	DELETE FROM configuration WHERE configuration_key='MODULE_ADMIN_DASHBOARD_VERSION_CHECK_STATUS';
        	DELETE FROM configuration WHERE configuration_key='MODULE_ADMIN_DASHBOARD_VERSION_CHECK_SORT_ORDER';

        	DELETE FROM configuration WHERE configuration_key='MODULE_ADMIN_DASHBOARD_SECURITY_CHECKS_STATUS';
        	DELETE FROM configuration WHERE configuration_key='MODULE_ADMIN_DASHBOARD_SECURITY_CHECKS_SORT_ORDER';

        	DELETE FROM configuration WHERE configuration_key='MODULE_ADMIN_DASHBOARD_PARTNER_NEWS_STATUS';
        	DELETE FROM configuration WHERE configuration_key='MODULE_ADMIN_DASHBOARD_PARTNER_NEWS_SORT_ORDER';

        	DELETE FROM configuration WHERE configuration_key='MODULE_ADMIN_DASHBOARD_LATEST_NEWS_STATUS';
        	DELETE FROM configuration WHERE configuration_key='MODULE_ADMIN_DASHBOARD_LATEST_NEWS_SORT_ORDER';
        
        
        ");

    }
}
