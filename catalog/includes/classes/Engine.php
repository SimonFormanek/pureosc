<?php
/**
 * broker.dbfinance.cz
 * 
 * @author Vítězslav Dvořák <info@vitexsoftware.cz>
 * @copyright (c) 2017-2019, Vítězslav Dvořák
 */

namespace PureOSC;

use DataTables\Editor,
    DataTables\Editor\Field,
    DataTables\Editor\Format,
    DataTables\Editor\Mjoin,
    DataTables\Editor\Options,
    DataTables\Editor\Upload,
    DataTables\Editor\Validate,
    DataTables\Editor\ValidateOptions;

/**
 * Description of Engine
 *
 * @author Vítězslav Dvořák <info@vitexsoftware.cz>
 */
class Engine extends \Ease\SQL\Engine
{
    /**
     * Filter results by
     * @var array 
     */
    public $filter = null;

    /**
     * Prefill new Record form with values
     * @var array 
     */
    public $defaults = null;

    /**
     *
     * @var string usually id 
     */
    public $keyColumn = 'id';

    /**
     * Column with record name
     * @var string 
     */
    public $nameColumn     = null;
    public $createColumn   = null; //'created_at';
    public $modifiedColumn = null; //'updated_at';    

    /**
     * Search results targeting to index.php here
     * @var string 
     */
    public $keyword = null;

    /**
     * Object Subject
     * @var string 
     */
    public $subject = null;
    public $newSubmitText;
    public $editSubmitText;
    public $removeSubmitText;
    public $newTitleText;
    public $editTitleText;
    public $removeTitleText;
    public $removeConfirmText;

    /**
     *
     * @var array 
     */
    public $columnsCache = [];

    /**
     *
     * @var array 
     */
    public $initConds = null;

    /**
     *
     * @var string 
     */
    public $detailPage = null;

    /**
     * Data Processing Engine
     * 
     * @param int $init
     * @param int $filter Initial conditons
     */
    public function __construct($init = null, $filter = [])
    {
        if (is_numeric($init)) {
            $this->loadFromSQL($init);
        } elseif (is_array($init)) {
            $this->takeData($init);
        }
        $this->translate();
        $this->filter = $filter;
        if (is_null($this->detailPage)) {
            $this->setDetailPage();
        }
    }

 
    /**
     * Set page where to work wiht one row detail
     * 
     * @param string $detailPage
     */
    public function setDetailPage($detailPage = null)
    {
        $this->detailPage = empty($detailPage) ? ( empty($this->keyword) ? null : $this->keyword.'.php' )
                : $detailPage;
    }

    /**
     * Where to look for record name
     * 
     * @return string
     */
    public function getNameColumn()
    {
        return $this->nameColumn;
    }

    /**
     * 
     */
    public function translate()
    {
        $this->newSubmitText     = sprintf(_('New %s'), $this->subject);
        $this->editSubmitText    = sprintf(_('Edit %s'), $this->subject);
        $this->removeSubmitText  = sprintf(_('Remove %s'), $this->subject);
        $this->newTitleText      = sprintf(_('Create new %s'), $this->subject);
        $this->editTitleText     = sprintf(_('Editing %s'), $this->subject);
        $this->removeTitleText   = sprintf(_('Removing %s'), $this->subject);
        $this->removeConfirmText = sprintf(_('Are you sure you wish to delete %%d row of %s ?'),
            $this->subject);
    }

    /**
     * 
     * @return string
     */
    public function getRecordName()
    {
        return $this->getDataValue($this->nameColumn);
    }

    /**
     * Columns Properties
     * 
     * name:   name of column field
     * label:  Text Shown
     * requied: true/false - column is necessary 
     * ro:     true/false - column is readonly
     * hidden: true/false - do not show column
     * column: get foregin content from "table.column"
     * type:   date|datetime|integer|string is default
     * 
     * listingPage: eg.: products.php
     * detailPage:  eg.: product.php
     * idColumn:    column with related id: eg. 'product_id'
     * 
     * @return array
     */
    public function columns($columns = [])
    {
        if (empty($this->columnsCache)) {

            $columns = self::reindexArrayBy($columns, 'name');
            foreach ($columns as $columnId => $columnInfo) {
                if (array_key_exists('gdpr', $columnInfo)) {
                    $columns[$columnId]['visible'] = 0;
                }

                if (!array_key_exists('name', $columnInfo)) {
                    $this->addStatusMessage(sprintf(_('Missing ColumnInfo name for %s/%s'),
                            get_class($this), $columnId));
                }
                if (!array_key_exists('type', $columnInfo)) {
                    $this->addStatusMessage(sprintf(_('Missing ColumnInfo type for %s/%s'),
                            get_class($this), $columnInfo['name']));
                    $columns[$columnId]['type'] = 'string';
                }
            }

            if (!array_key_exists('id', $columns)) {
                $columns['id'] = ['name' => 'id', 'type' => 'int', 'hidden' => true,
                    'label' => _('Id')];
            }

            if (isset($this->modifiedColumn) && !array_key_exists($this->modifiedColumn,
                    $columns)) {
                $columns[$this->modifiedColumn] = ['name' => $this->modifiedColumn,
                    'type' => 'datetime',
                    'label' => _('Updated'), 'readonly' => true];
            }

            if (isset($this->createColumn) && !array_key_exists($this->createColumn,
                    $columns)) {
                $columns[$this->createColumn] = ['name' => $this->createColumn, 'type' => 'datetime',
                    'label' => _('Created'), 'readonly' => true];
            }
            $this->columnsCache = $columns;
        }
        return $this->columnsCache;
    }

    /**
     * Skip columns not suposed to be edited
     * 
     * @param array $columnsToFilter
     * 
     * @return array
     */
    public function editableColumns($columnsToFilter)
    {
        $columnsToEdit = [];
        $keyColum      = $this->getKeyColumn();
        foreach ($columnsToFilter as $id => $values) {
            $columnName = $values['name'];
            if (!empty($this->defaults) && array_key_exists($columnName,
                    $this->defaults)) {
                $values['def'] = $this->defaults[$columnName];
            }
            switch ($columnName) {
                case $keyColum:
                case $this->modifiedColumn:
                case $this->createColumn:
                    $values['type']  = 'display';
                    continue 2;
                    break;
                default:
                    $columnsToEdit[] = $values;
                    break;
            }
        }

        return $columnsToEdit;
    }

    /**
     * Get All records
     * 
     * @return array
     */
    public function getAll()
    {
        return $this->listingQuery()->fetchAll();
    }

    public function getColumnType($colName)
    {
        return $this->columns()[$colName]['type'];
    }

    /**
     * 
     * @param array $conditions
     * 
     * @return string
     */
    public function getAllForDataTable($conditions = [])
    {
        $data         = [];
        $dtColumns    = $conditions['columns'];
        $tableColumns = $this->columns();
        unset($conditions['columns']);
        unset($conditions['_']);
        unset($conditions['class']);
        $query        = $this->listingQuery();

        $recordsTotal = count($query);

        if ($recordsTotal) {

            if (array_key_exists('search', $conditions) && $conditions['search']['value']) {
                foreach ($tableColumns as $colProps) {
                    $query->whereOr((array_key_exists('column', $colProps) ? $colProps['column']
                                : $this->getMyTable().'.'."`".$colProps['name']."`")." LIKE '%".$conditions['search']['value']."%'");
                }
                unset($conditions['search']);
            }

            foreach ($conditions as $condName => $condValue) {
                if (array_key_exists($condName, $this->columns())) {
                    $query->where($this->getMyTable().'.'.$condName, $condValue);
                } else {
                    $query->where(str_replace('/', '.', $condName), $condValue);
                }
            }
        }

        $recordsFiltered = count($query);


        if (array_key_exists('length', $conditions)) {
            $query->limit($conditions['length']);
            unset($conditions['length']);
        }

        if (array_key_exists('start', $conditions)) {
            $query->offset($conditions['start']);
            unset($conditions['start']);
        } else {
            $query->offset('0');
        }

        if (array_key_exists('order', $conditions)) {
            foreach ($conditions['order'] as $order) {
                if ($dtColumns[$order['column']]['searchable'] == 'true') {
                    if (array_key_exists('column',
                            $tableColumns[$dtColumns[$order['column']]['data']])) {
                        $query->orderBy($dtColumns[$order['column']]['column'].' '.$order['dir']);
                    } else {
                        $query->orderBy($this->getMyTable().'.'.$dtColumns[$order['column']]['data'].' '.$order['dir']);
                    }
                }
            }
            unset($conditions['order']);
        }

        foreach ($query as $dataRow) {
            $dataRow['DT_RowId'] = 'row_'.$dataRow['id'];
            $data[]              = $dataRow;
        }

        return [
            "draw" => array_key_exists('draw', $conditions) ? intval($conditions['draw'])
                : 0,
            "recordsTotal" => intval($recordsTotal),
            "recordsFiltered" => intval($recordsFiltered),
            "data" => $data
        ];
    }

    /**
     * 
     * @return \Envms\FluentPDO
     */
    public function listingQuery()
    {
        return $this->getFluentPDO()->from($this->getMyTable());
    }

    /**
     * Return One Row data
     * 
     * @param int $id - Row ID
     * 
     * @return array
     */
    public function getOneRow($id = null)
    {
        if (is_null($id)) {
            $id = $this->getMyKey();
        }
        return $this->listingQuery()->where($this->getMyTable().'.id='.$id)->execute()->fetch();
    }

    /**
     * SQL Builder
     * @return \Envms\FluentPDO
     */
    public function getFluentPDO()
    {
        if (!is_object($this->fluent)) {
            $this->fluent = new \FluentPDO($this->dblink->sqlLink);
        }
        return $this->fluent;
    }

    /**
     * 
     */
    public function editorForm($id = null)
    {
        if (is_null($id)) {
            $id = $this->getObjectName();
        }
        $newRankForm = new \Ease\Html\DivTag(null, ['id' => $id]);
        foreach ($this->columns() as $column) {
            if (array_key_exists('ro', $column) && ($column['ro'] == true)) {
                continue;
            }
            if (!array_key_exists('type', $column)) {
                $column['type'] = 'string';
            }

            switch ($column['name']) {
                case 'created_at':
                case 'updated_at':
                    break;

                default:
                    switch ($column['type']) {
                        case 'string':
                        default:
                            $newRankForm->addItem(new ui\EditorField($column['name']));
                            break;
                    }

                    break;
            }
        }
        return $newRankForm;
    }

    /**
     * Submited form data validator
     * 
     * @return array
     */
    public function getSaverFields()
    {
        $saverFields = [];
        foreach ($this->columns() as $column) {
            if ($column['type'] == 'readonly') { //
                continue;
            }
            if ($column['type'] == 'display') { //
                continue;
            }
            if (array_key_exists('column', $column)) { //Joined
                continue;
            }
            $field = Field::inst($column['name']);

            switch ($column['type']) {
                case 'email':
                    $field->validator(Validate::email(ValidateOptions::inst()->message(sprintf(_('%s is not valid email'),
                                    $column['label']))));

                    break;
                case 'currency':
//                    $field->validator(Validate::numeric(ValidateOptions::inst()->message(sprintf(_('A %s must be a nuber'),
//                                    $column['label']))));
                    break;
//                case 'upload':
//                    echo '';
//                    $field
//                        ->upload(
//                            Upload::inst($_SERVER['DOCUMENT_ROOT'].'/../files/__ID__.__EXTN__')
//                            ->db($this->getMyTable().'_file', $column['name'],
//                                ['filename' => Upload::DB_FILE_NAME,
//                                'created_at' => date('Y-m-d'),
//                                'filesavedas' => md5_file($_FILES['upload']['tmp_name']).'.'.pathinfo($_FILES['upload']['name'],
//                                    PATHINFO_EXTENSION),
//                                $this->getMyTable().'_id' => 0
////                                'fileSize' => Upload::DB_FILE_SIZE
//                            ])
//                        )->setFormatter('Format::nullEmpty');
//                    break;
                default:
                    break;
            }

            if (array_key_exists('requied', $column) && ($column['requied'] == 'true')) {
                $field->validator(Validate::notEmpty(ValidateOptions::inst()->message(sprintf(_('A %s is required'),
                                $column['label']))));
            }

            if (array_key_exists('unique', $column) && ($column['unique'] == 'true')) {
                $field->validator(Validate::unique(ValidateOptions::inst()->message(sprintf(_('A %s is not unique'),
                                $column['label']))));
            }



            $saverFields[] = $field;
            /*
              if (array_key_exists('ro', $column) && ($column['ro'] == true)) {
              continue;
              }
              if (!array_key_exists('type', $column)) {
              $column['type'] = 'string';
              }

              switch ($column['name']) {
              case 'created_at':
              case 'updated_at':
              continue;
              break;

              default:
              switch ($column['type']) {
              case 'string':
              default:
              break;
              }

              break;
              }
             */
        }


        /*
          return [
          Field::inst('name')
          ->validator(Validate::notEmpty(ValidateOptions::inst()
          ->message('A name is required')
          )),
          Field::inst('description')
          ->validator(Validate::notEmpty(ValidateOptions::inst()
          ->message('A description is required')
          ))
          ];
         */

        return $saverFields;
    }

    /**
     * 
     * @param array $formPost
     * 
     * @return array
     */
    public function preprocessPost($formPost)
    {
        if (array_key_exists('action', $formPost) && array_key_exists('data',
                $formPost)) {
            foreach ($formPost['data'] as $recordId => $recordData) {
                $formPost['data'][$recordId] = $this->prepareToSave($recordData,
                    $formPost['action'], str_replace('row_', '', $recordId));
            }
            unset($_SESSION['feedCache'][get_class($this)]);
        }
        return $formPost;
    }

    /**
     * Vrací data jako HTML.
     *
     * @param array $data
     *
     * @return array
     */
    public function htmlizeData($data)
    {
        if (is_array($data) && count($data)) {
            $usedCache = array();
            foreach ($data as $rowId => $row) {
                $htmlized = $this->htmlizeRow($row);

                if (is_array($htmlized)) {
                    foreach ($htmlized as $key => $value) {
                        if (!is_null($value)) {
                            $data[$rowId][$key] = $value;
                        } else {
                            if (!isset($data[$rowId][$key])) {
                                $data[$rowId][$key] = $value;
                            }
                        }
                    }
                    if (isset($row['register']) && ($row['register'] == 1)) {
                        $data[$rowId]['name'] = '';
                    }
                }
            }
        }

        return $data;
    }

    /**
     * Vrací řádek dat jako html.
     *
     * @param array $row
     *
     * @return array
     */
    public function htmlizeRow($row)
    {
        $columns = self::reindexArrayBy($this->columns(), 'name');

        if (is_array($row) && count($row)) {
            foreach ($row as $key => $value) {
                if ($key == $this->myKeyColumn) {
                    continue;
                }
                if (!isset($columns[$key])) {
                    continue;
                }
                if (array_key_exists('type', $columns[$key])) {
                    $fieldType = $columns[$key]['type'];
                } else {
                    $this->addStatusMessage(sprintf(_('Field Type is not set for %s '),
                            $this->getMyTable(), $key));
                    $fieldType = 'string';
                }

                $fType = preg_replace('/\(.*\)/', '', $fieldType);

                switch ($fType) {
                    case 'hidden':
                        break;

                    case 'boolean':
                        if (is_null($value) || !strlen($value)) {
                            $row[$key] = '<em>NULL</em>';
                        } else {
                            if ($value === '0') {
                                $row[$key] = new \Ease\TWB\GlyphIcon('unchecked');
                            } else {
                                if ($value === '1') {
                                    $row[$key] = new \Ease\TWB\GlyphIcon('check');
                                }
                            }
                        }
                        break;
                    case 'date':
                        if ($value) {
                            $stamper   = new \DateTime($value);
                            $row[$key] = new \Ease\Html\ATag('calendar.php?day='.$stamper->format('Y-m-d'),
                                strftime("%x", $stamper->getTimestamp()).' ('.new ui\ShowTime($stamper->getTimestamp()).')');
                        }
                        break;
                    case 'datetime':
                        if ($value) {
                            $stamper   = new \DateTime($value);
                            $row[$key] = new \Ease\Html\ATag('calendar.php?day='.$stamper->format('Y-m-d'),
                                new \Ease\Html\TimeTag(strftime("%x %r",
                                        $stamper->getTimestamp()),
                                    ['datetime' => $stamper->getTimestamp()]));
                        }
                        break;
                    default :
                        if (isset($this->keywordsInfo[$key]['refdata']) && strlen(trim($value))) {
                            $table        = $this->keywordsInfo[$key]['refdata']['table'];
                            $searchColumn = $this->keywordsInfo[$key]['refdata']['captioncolumn'];
                            $row[$key]    = '<a title="'.$table.'" href="search.php?search='.$value.'&table='.$table.'&column='.$searchColumn.'">'.$value.'</a> '.EaseTWBPart::glyphIcon('search');
                        }
                        if (strstr($key, 'image') && strlen(trim($value))) {
                            $row[$key] = '<img title="'.$value.'" src="logos/'.$value.'" class="gridimg">';
                        }
                        if (strstr($key, 'url')) {
                            $row[$key] = '<a href="'.$value.'">'.$value.'</a>';
                        }

                        break;
                }
            }
        }

        return $row;
    }

    /**
     * 
     * @param type $initialContent
     * 
     * @return type
     */
    public function foterCallback()
    {
        return null;
    }

    /**
     * @link https://datatables.net/examples/advanced_init/column_render.html 
     * 
     * @return string Column rendering
     */
    public function columnDefs()
    {
        return '';
    }

    /**
     * 
     * 
     * @param array   $data
     * @param boolean $searchForId
     * 
     * @return int
     */
    public function saveToSQL($data = null, $searchForId = null)
    {
        if (is_null($data)) {
            $data = $this->getData();
        }
        if ($this->getMyKey($data)) {
            $data = $this->prepareToSave($data, 'edit', $this->getMyKey($data));
        }
        return parent::saveToSQL($data, $searchForId);
    }

    /**
     * By default we do noting
     * 
     * @param array  $data
     * @param string $action   edit|delete|create
     * @param int    $recordId 
     * 
     * @return array
     */
    public function prepareToSave($data, $action, $recordId = null)
    {
        $now = new \DateTime();
        switch ($action) {
            case 'create':
                if ($this->createColumn) {
                    $data[$this->createColumn] = date('Y-m-d');
                }
                if ($this->modifiedColumn) {
                    unset($data[$this->modifiedColumn]);
                }
                break;
            case 'edit':
                if ($this->createColumn) {
                    unset($data[$this->createColumn]);
                }
                if ($this->modifiedColumn) {
                    $data[$this->modifiedColumn] = date('Y-m-d');
                }
                break;

            default:
                break;
        }

        return $data;
    }

    /**
     * Vyhledavani v záznamech objektu
     *
     * @param string $what hledaný výraz
     * 
     * @return array pole výsledků
     */
    public function searchString($what)
    {
        $results   = [];
        $conds     = [];
        $what      = str_replace('.', '\.', $what);
        $columns[] = $this->getMyTable().'.'.$this->getKeyColumn();
        foreach ($this->getSqlColumns() as $keyword => $keywordInfo) {
            if (strstr($keywordInfo['type'], 'text')) {
                if (array_key_exists('column', $keywordInfo)) {
                    $conds[] = $keywordInfo['column']." LIKE '%".$what."%'";
                } else {
                    $conds[] = $this->getMyTable().".`$keyword` LIKE '%".$what."%'";
                }
            }
        }
        if (count($conds)) {
            $found = $this->listingQuery()->where('('.implode(' OR ', $conds).')');

            foreach (self::fixIterator($found) as $result) {
                $this->setData($result);
                $occurences = '';
                foreach ($result as $key => $value) {
                    if (strstr($value, stripslashes($what))) {
                        $occurences .= '('.$key.': '.$value.') ';
                    }
                }
                $results[$result[$this->keyColumn]] = [$this->nameColumn => $this->getRecordName(),
                    'what' => $occurences, 'url' => $this->getUrlForRecord($result['id'])];
            }
        }
        return $results;
    }

    public function getSqlColumns()
    {
        $sqlColumns = [];
        foreach ($this->columns() as $columnInfo) {
            if (array_key_exists('virtual', $columnInfo)) {
                continue;
            }
            switch ($columnInfo['type']) {
                case '':
                    break;
                default :
                    $sqlColumns[$columnInfo['name']] = $columnInfo;
                    break;
            }
        }
        return $sqlColumns;
    }

    /**
     * 
     * @return array
     * 
     * @throws \Exception
     */
    public function getGetDataTableColumns()
    {
        $dataTableColumns = [];
        foreach ($this->columns() as $columnInfo) {
            if (array_key_exists('hidden', $columnInfo) && ($columnInfo['hidden']
                == true)) {
                continue;
            }

            if (!array_key_exists('type', $columnInfo)) {
                throw new \Exception(sprintf(_('Column "%s" of %s without type definition'),
                        $columnInfo['name'], get_class($this)));
            }

            switch ($columnInfo['type']) {
//                case '':
//                    break;
                default :
                    unset($columnInfo['column']);
                    $dataTableColumns[$columnInfo['name']] = $columnInfo;
                    break;
            }
        }
        return array_values($dataTableColumns);
    }

    /**
     * pre code for DataTable initialization
     * 
     * @param string $tableID css #id of table
     * 
     * @return string
     */
    public function preTableCode($tableID)
    {
        return '';
    }

    /**
     * Additional code for DataTable initialization
     * 
     * @param string $tableID css #id of table
     * 
     * @return string
     */
    public function tableCode($tableID)
    {
        return '';
    }

    /**
     * post code for DataTable initialization
     * 
     * @param string $tableID css #id of table
     * 
     * @return string
     */
    public function postTableCode($tableID)
    {
        return '';
    }

    /**
     * 
     */
    public function feedSelectize($options = [])
    {
        $result     = [];
        $candidates = $this->listingQuery();
        foreach (self::fixIterator($candidates) as $candidat) {
            $result[] = ['label' => $candidat[$this->getNameColumn()], 'value' => intval($candidat[$this->getKeyColumn()])];
        }
        return $result;
    }

    /**
     * Save selectize records to cache
     * 
     * @param array $options
     * 
     * @return array
     */
    public function feedSelectizeCached($options = [])
    {
        if (!isset($_SESSION['feedCache'][get_class($this)]) || empty($_SESSION['feedCache'][get_class($this)])) {
            $_SESSION['feedCache'][get_class($this)] = $this->feedSelectize($options);
        }
        return $_SESSION['feedCache'][get_class($this)];
    }

    /**
     * 
     * @return array
     */
    public function getFilterOptions()
    {
        $result     = [];
        $candidates = $this->listingQuery()->orderBy($this->nameColumn);
        foreach (self::fixIterator($candidates) as $candidat) {
            $this->setData($candidat);
            $result[] = ['id' => $this->getMyKey(), 'name' => $name  = $this->getRecordName()];
        }
        return $result;
    }

    /**
     * 
     */
    public function getHiddenTagets($extra = [])
    {
        $hiddenColumns = [];
        foreach (array_values($this->columns()) as $columnId => $columnInfo) {
            if (array_key_exists('hidden', $columnInfo) && ($columnInfo['hidden']
                == true)) {
                $hiddenColumns[] = $columnId;
            }
        }
        return $hiddenColumns;
    }

    /**
     * 
     */
    static function selectize($rawdata)
    {
        $selectized = [];
        foreach ($rawdata as $key => $value) {
            $selectized[] = ['label' => $value, 'value' => $key];
        }
        return $selectized;
    }

    public function getCustomerID()
    {
        return $this->getDataValue('client_id');
    }

    public function getResume()
    {
        return implode(' ', $this->getData());
    }

    public function postCreate($datableSaver, $id, $row)
    {
        
    }

    public function validation($saver)
    {
        
    }

    public function editorOpenJS()
    {
        return '';
    }

    public function editorPostCreateJS()
    {
        return '';
    }

    public function editorCreateJS()
    {
        return '';
    }

    public function editorSubmitCompleteJS()
    {
        return '';
    }

    public static function renderYesNo($columns)
    {
        return '
            {
                "render": function ( data, type, row ) {
                    if(data == "1") { return  "'._('Yes').'" } else { return "'._('No').'" };
                },
                "targets": ['.$columns.']
            },
        ';
    }

    public static function renderSelectize($columns)
    {
        return '
            {
                "render": function ( data, type, row, opts ) {
                    opts.settings.aoColumns[ opts.col ].options.forEach(function(element) {
                        if(element[\'value\'] ==  data){
                            data = \'<a href="\' + opts.settings.aoColumns[ opts.col ].detailPage + \'?id=\'+ data + \'">\' + element[\'label\'] + \'</a>\';
                        }
                    });
                    return data;
                },
                "targets": ['.$columns.']
            },
            
';
    }

    public static function renderDate($columns, $target = 'calendar.php')
    {
        return '
            {
                "render": function ( data, type, row ) {
                    if (type == "sort" || type == \'type\'){
                        return data;            
                    }
                    dataRaw = data;
                    if (data) { 
                        data.replace(/(\d{4})-(\d{1,2})-(\d{1,2})/, function(match,y,m,d) { data = d + \'. \' + m + \'. \' + y; });
                    } else data = "";
                    return  "<a href=\"'.$target.'?day=" + dataRaw +"\"><time datetime=\"" + dataRaw + "\">" + data + "</time></a>";
                },
                "targets": ['.$columns.']
            },
            ';
    }

    public function getColumnsOfType($types)
    {
        $columns    = [];
        $columnsRaw = $this->columns();
        if (!is_array($types)) {
            $types = [$types];
        }
        foreach ($types as $type) {
            foreach ($columnsRaw as $columnName => $columnInfo) {
                if ($columnInfo['type'] == $type) {
                    $columns[$columnName] = $columnInfo;
                }
            }
        }
        return $columns;
    }

    /**
     * Always return array
     * 
     * @param \Envms\FluentPDO\Queries\Select $query
     * 
     * @return array
     */
    public static function fixIterator($query)
    {
        $data = $query->execute();
        return $data ? $data : [];
    }

    public function getUrlForRecord($recordID)
    {
        return isset($this->detailPage) ? $this->detailPage.'?id='.$recordID : null;
    }

    public function getAttachments()
    {
        $attachments = $this->getFluentPDO()->from($this->keyword.'_file')->where($this->keyword.'_id',
                $this->getMyKey())->fetchAll();
        return empty($attachments) ? [] : $attachments;
    }

    /**
     * Confirm data save ability
     * 
     * @param array $dataToSave
     * 
     * @return boolean
     */
    public function presaveCheck($dataToSave)
    {
        $this->loadFromSQL();
        return true;
    }

    /**
     * Finish Work
     * 
     * @param DataTableSaver $saver
     * 
     * @return DataTableSaver
     */
    public function finishProcess($saver)
    {
        if (is_null($saver)) {
            $_SESSION['feedCache'][get_class($this)] = $this->feedSelectize([]);
        } else {
            $_SESSION['feedCache'][get_class($saver->engine)] = $saver->engine->feedSelectize([
                ]);
        }
        return $saver;
    }
}
