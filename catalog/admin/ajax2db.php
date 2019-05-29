<?php
//header('Content-Type: application/json');
require('includes/application_top.php');

$class = $oPage->getRequestValue('class');


/**
 * @var Engine Data Source
 */
$engine = new $class;

$dataRaw = $engine->getAllForDataTable($_REQUEST);
echo json_encode($dataRaw);
