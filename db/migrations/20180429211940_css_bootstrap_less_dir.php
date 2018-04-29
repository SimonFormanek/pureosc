<?php


use Phinx\Migration\AbstractMigration;

class CssBootstrapLessDir extends AbstractMigration
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
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        // inserting only one row
        $singleRow = [
            'configuration_title'    => 'Bootstrap Less dir',
            'configuration_key'    => 'BOOTSTRAP_LESS_DIR',
            'configuration_value'    => 'bootstrap-3.3.7/less/',
            'configuration_description'    => 'Bootstrap source Less directory',
            'configuration_group_id'    => '16',
            'sort_order'    => '3',
            'date_added'    => 'NOW()'

        ];

        $table = $this->table('configuration');
        $table->insert($singleRow);
        $table->saveData();

/*
    {
        $this->execute("INSERT INTO `configuration` 
            (`configuration_title`, `configuration_key`, `configuration_value`, `configuration_description`, `configuration_group_id`, `sort_order`, `last_modified`, `date_added`, `use_function`, `set_function`) VALUES
                ('Bootstrap Less dir', 'BOOTSTRAP_LESS_DIR', '', 'Use FlexiBee ?', $configurationId, 999, NULL, NOW(), NULL, 'tep_cfg_select_option(array(\'true\', \'false\'), ')");

    }
*/
}
}