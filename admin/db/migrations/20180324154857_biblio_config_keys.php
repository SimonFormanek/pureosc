<?php

use Phinx\Migration\AbstractMigration;

class BiblioConfigKeys extends AbstractMigration
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

DISPLAY_PRODUCTS_BIBLIO true

insert into configuration (

configuration_title
 configuration_key
 configuration_value
configuration_description
 configuration_group_id
 sort_order
  last_modified
 date_added)  

values 

('CONFIG_TITLE_ORDER_SEND_CUSTOMERS_EMAIL_PHONE', 
'ORDER_SEND_CUSTOMERS_EMAIL_PHONE', 'false', 'CONFIG_DESCRIPTION_ORDER_SEND_CUSTOMERS_EMAIL_PHONE', '12', '11', NOW(), NOW());



     */
    public function change()
    {
  $singleRow = [
            'configuration_title'    => 'Display products biblio',
            'configuration_key'  => 'DISPLAY_PRODUCTS_BIBLIO',
            'configuration_value' => 'false',
            'configuration_description' => 'Display biblografical fields for bookstore',
            'configuration_group_id' => '17',
            'sort_order' => '14',
            'set_function' => 'tep_cfg_select_option(array(\'true\', \'false\'),'
        ];

        $table = $this->table('configuration');
        $table->insert($singleRow);
        $table->saveData();
    }
}
