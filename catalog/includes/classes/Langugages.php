<?php
/**
 * PureOSC languagues
 * 
 * @author Vítězslav Dvořák <info@vitexsoftware.cz>
 * @copyright (c) 2017, Vítězslav Dvořák
 */

namespace PureOSC;

/**
 * Description of DBFContracts
 *
 * @author vitex
 */
class Languagues extends Engine
{
    public $myTable     = TABLE_LANGUAGUES;
    public $myKeyColumn = 'languages_id';

    /**
     * Group Rows by
     * @var boolean 
     */
    public $grouping = false;
//    public $modifiedColumn = 'updated_at';

    /**
     * Search resuts targeting to  here
     * @var string 
     */
    public $keyword  = 'language';

    /**
     * Contract
     * 
     * @param int $init
     * @param array $filter
     */
    public function __construct($init = null, $filter = array())
    {
        parent::__construct($init, $filter);
    }
    /**
     * Column with record name
     * @var string 
     */
    public $nameColumn = 'contract_id';

    /**
     * 
     */
    public function translate()
    {
        $this->subject = _('Languague');
        parent::translate();
    }

    /**
     * Contract Columns
     * 
     * @return arrat
     */
    public function columns($columns = [])
    {

        $languager = new Languages();

        return parent::columns([
                ['name' => 'name', 'type' => 'text', 'label' => _('Language'),'requied' => true],
                ['name' => 'code', 'type' => 'text', 'label' => _('Code'),'type' => 'currency'],
                ['name' => "image", 'type' => 'text', 'label' => _('Image')],
                ['name' => "directory", 'type' => 'text', 'label' => _('Directory')],
                ['name' => "sort_order", 'type' => 'text','label' => _('Sort Order')]
        ]);
    }

    public function editorPostCreateJS()
    {
        return '
            window.location.href = "languague.php?id=" + data["id"] ;
';
    }

}
