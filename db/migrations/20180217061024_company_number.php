<?php

use Phinx\Migration\AbstractMigration;

class CompanyNumber extends AbstractMigration
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
        $table = $this->table('address_book');
        $table->addColumn('entry_company_number', 'string')
            ->save();
        $table = $this->table('orders');
        $table->addColumn('customers_company_number', 'string')
            ->addColumn('delivery_company_number', 'string')
            ->addColumn('billing_company_number', 'string')
            ->save();
    }
}
