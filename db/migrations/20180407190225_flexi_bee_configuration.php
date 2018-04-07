<?php

use Phinx\Migration\AbstractMigration;

class FlexiBeeConfiguration extends AbstractMigration
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

        $this->execute("INSERT INTO `configuration_group` (`configuration_group_title`, `configuration_group_description`, `sort_order`, `visible`) VALUES
        ('FlexiBee', 'FlexiBee otions', 1, 1);");
        $rows = $this->fetchAll('SELECT configuration_group_id  FROM configuration_group ORDER BY configuration_group_id DESC LIMIT 1');
        $configurationId = $rows[0]['configuration_group_id'];
            
        $this->execute("INSERT INTO `configuration` 
            (`configuration_title`, `configuration_key`, `configuration_value`, `configuration_description`, `configuration_group_id`, `sort_order`, `last_modified`, `date_added`, `use_function`, `set_function`) VALUES
                ('FlexiBee Enable', 'USE_FLEXIBEE', 'true', 'Use FlexiBee ?', $configurationId, 999, NULL, NOW(), NULL, 'tep_cfg_select_option(array(\'true\', \'false\'), ')");
        $this->execute("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function )  values "
            ."('FlexiBee API URL', 'FLEXIBEE_URL', 'https://demo.flexibee.eu:5434', 'Url to FlexiBee server', $configurationId, '999', NOW(), NOW(), NULL, NULL);");
        $this->execute("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function )  values "
            ."('FlexiBee API User', 'FLEXIBEE_LOGIN', 'winstrom', 'FlexiBee login', $configurationId, '999', NOW(), NOW(), NULL, NULL);");
        $this->execute("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function )  values "
            ."('FlexiBee API Passwrd', 'FLEXIBEE_PASSWORD', 'winstrom', 'FlexiBee password', $configurationId, '999', NOW(), NOW(), NULL, NULL);");
        $this->execute("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function )  values "
            ."('FlexiBee Company', 'FLEXIBEE_COMPANY', 'demo', 'Default FlexiBee Company used', $configurationId, '999', NOW(), NOW(), NULL, NULL);");
    }
}
