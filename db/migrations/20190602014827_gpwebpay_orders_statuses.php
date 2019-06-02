<?php


use Phinx\Migration\AbstractMigration;

class GpwebpayOrdersStatuses extends AbstractMigration
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
alter table orders_status MODIFY orders_status_name varchar(64);
delete from orders_status WHERE orders_status_name like '%gpwebpay ERR%';

insert into orders_status (orders_status_id, language_id, orders_status_name, public_flag, downloads_flag ) values (109,1, '[gpwebpay ERR] OSC module unknow err', 0, 1);                  
insert into orders_status (orders_status_id, language_id, orders_status_name, public_flag, downloads_flag ) values (109,4, '[gpwebpay ERR] neznámá chyba OSC modulu', 0, 1); 

insert into orders_status (orders_status_id, language_id, orders_status_name, public_flag, downloads_flag ) values (110,1, '[gpwebpay ERR] Session Expired', 0, 1);                

insert into orders_status (orders_status_id, language_id, orders_status_name, public_flag, downloads_flag ) values (110,4, '[gpwebpay ERR] 35 Session Expired', 0, 1); 

insert into orders_status (orders_status_id, language_id, orders_status_name, public_flag, downloads_flag ) values (111,1, '[gpwebpay ERR] 17 Amount exceeds approved ', 0, 1);                 

insert into orders_status (orders_status_id, language_id, orders_status_name, public_flag, downloads_flag ) values (111,4, '[gpwebpay ERR] 17 Částka překročena', 0, 1);                                          

insert into orders_status (orders_status_id, language_id, orders_status_name, public_flag, downloads_flag ) values (112,1, '[gpwebpay ERR] 1000 Technical problem', 0, 1);                                                 

insert into orders_status (orders_status_id, language_id, orders_status_name, public_flag, downloads_flag ) values (112,4, '[gpwebpay ERR] 1000 Technický problém', 0, 1);         

insert into orders_status (orders_status_id, language_id, orders_status_name, public_flag, downloads_flag ) values (113,1, '[gpwebpay ERR] 50 Canceled by cardholder', 0, 1);                  
insert into orders_status (orders_status_id, language_id, orders_status_name, public_flag, downloads_flag ) values (113,4, '[gpwebpay ERR] 50 zrušeno vlastníkem', 0, 1); 

   ");

    }
}
