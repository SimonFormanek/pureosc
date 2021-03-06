<?php

use Phinx\Migration\AbstractMigration;

class GpwebpayOrdersStatus extends AbstractMigration
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
        $orders = $this->fetchAll('SELECT * FROM orders_status WHERE orders_status_id=105');

        if (empty($orders)) {

            $this->execute("
				INSERT INTO orders_status values (105, 1, 'Paid by Gpwebpay', 1, 1);
				INSERT INTO orders_status values (105, 4, 'Zaplaceno Gpwebpay', 1, 1);

        ");
        }
    }
}
