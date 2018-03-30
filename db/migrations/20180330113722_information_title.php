<?php

use Phinx\Migration\AbstractMigration;

class InformationTitle extends AbstractMigration
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
        $table = $this->table('information');

        $short = $table->hasColumn('info_title ');
        if ($short) {
            $table->renameColumn('info_title', 'information_title');
        } else {
            $long = $table->hasColumn('information_title');
            if (!$long) {
                $table->addColumn('information_title', 'string')
                    ->update();
            }
        }

        $short = $table->hasColumn('description');
        if ($short) {
            $table->renameColumn('description', 'information_description');
        } else {
            $long = $table->hasColumn('information_description');
            if (!$long) {
                $table->addColumn('information_description', 'string')
                    ->update();
            }
        }

        if ($table->hasColumn('languages_id')) {
            $table->renameColumn('languages_id', 'language_id');
        }


        if (!$table->hasColumn('information_group_id')) {
            $table->addColumn('information_group_id', 'integer')
                ->update();
        }
    }
}
