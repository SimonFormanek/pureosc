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
        if ($this->hasTable('address_book')) {
            $table = $this->table('address_book');
            if (!$table->hasColumn('entry_company_number')) {
                $table->addColumn('entry_company_number', 'string')
                    ->save();
            }
            if (!$table->hasColumn('entry_vat_number')) {
                $table->addColumn('entry_vat_number', 'string')
                    ->save();
            }
            
        } else {

            $table = $this->table('address_book_real');
            if (!$table->hasColumn('entry_company_number')) {
                $table->addColumn('entry_company_number', 'string')
                    ->save();
            }
            if (!$table->hasColumn('entry_vat_number')) {
                $table->addColumn('entry_vat_number', 'string')
                    ->save();
            }


            $this->execute('ALTER
 ALGORITHM = UNDEFINED
DEFINER=`root`@`localhost` 
 SQL SECURITY DEFINER
 VIEW `address_book`
 AS  select 
 `address_book_real`.`address_book_id` AS `address_book_id`,
 `address_book_real`.`customers_id` AS `customers_id`,
 `address_book_real`.`entry_gender` AS `entry_gender`,
 `address_book_real`.`entry_company` AS `entry_company`,
 `address_book_real`.`entry_firstname` AS `entry_firstname`,
 `address_book_real`.`entry_lastname` AS `entry_lastname`,
 `address_book_real`.`entry_street_address` AS `entry_street_address`,
 `address_book_real`.`entry_suburb` AS `entry_suburb`,
 `address_book_real`.`entry_vat_number` AS `entry_vat_number`,
 `address_book_real`.`entry_company_number` AS `entry_company_number`,
 `address_book_real`.`entry_postcode` AS `entry_postcode`,
 `address_book_real`.`entry_city` AS `entry_city`,
 `address_book_real`.`entry_state` AS `entry_state`,
 `address_book_real`.`entry_country_id` AS `entry_country_id`,
 `address_book_real`.`entry_zone_id` AS `entry_zone_id`,
 `address_book_real`.`crypt_request` AS `crypt_request`,
 `address_book_real`.`crypt_auth` AS `crypt_auth` from `address_book_real` where ((`address_book_real`.`customers_id` = (select substr(substring_index(user(),\'@\',1),-(7)))) or (substring_index(user(),\'@\',1) = \'yinyang_all\'))');


            $table = $this->table('orders_real');
            $table->addColumn('customers_company_number', 'string')
                ->addColumn('delivery_company_number', 'string')
                ->addColumn('billing_company_number', 'string')
                ->save();
        }
    }
}
