<?php

use Phinx\Migration\AbstractMigration;

class BiblioProductExtraFields extends AbstractMigration
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
        $table = $this->table('products');
            if (!$table->hasColumn('products_biblio_isbn')) {

        $table
        -> addColumn('products_biblio_isbn', 'string')
        ->addColumn('products_biblio_isbn_pdf', 'string')
        ->addColumn('products_biblio_isbn_epub', 'string')
        ->addColumn('products_biblio_isbn_mobi', 'string')
        -> addColumn('products_biblio_pages_count', 'string')
        -> addColumn('products_biblio_bindings', 'string')
        -> addColumn('products_biblio_book_size', 'string')
        -> addColumn('products_biblio_publication_year', 'string')
            ->save();

    }
	}
}
