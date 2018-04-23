<?php


use Phinx\Migration\AbstractMigration;

class PhpIdsExclusions extends AbstractMigration
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
    $this->execute("
			update configuration set configuration_value = 'REQUEST.__utmz, COOKIE.__utmz, REQUEST.custom, POST.custom, REQUEST.osCsid, COOKIE.osCsid, REQUEST.verify_sign, POST.verify_sign, REQUEST.s_pers, COOKIE.s_pers, REQUEST.enquiry, POST.enquiry, REQUEST.DIGEST, POST.DIGEST, GET.DIGEST, DIGEST' where configuration_key = 'PHPIDS_EXCLUSIONS';
    ");

    }
}
