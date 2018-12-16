<?php
require_once('includes/application_top.php');

$oPage = new \Ease\TWB\WebPage('XLS');

$embed    = $oPage->getRequestValue('embed');
$id       = $oPage->getRequestValue('id');
$id       = str_replace('extorders', 'ext:orders:', $id);
$evidence = $oPage->getRequestValue('evidence');


$document = new \FlexiPeeHP\FlexiBeeRO(is_numeric($id) ? intval($id) : $id,
    ['evidence' => $evidence]);

$invoiceNum = 'ext:src:faktura-vydana:'.$document->getRecordID();
if ($document->recordExists($invoiceNum)) {
    $document->loadFromFlexiBee($invoiceNum);
}

$document = new \FlexiPeeHP\FlexiBeeRO(is_numeric($id) ? intval($id) : $id,
    ['evidence' => $evidence]);

if (!is_null($document->getMyKey())) {
    $documentBody = $document->getInFormat('xls');
    header('Content-Description: File Transfer');
    header('Content-Disposition: attachment; filename='.$document->getEvidence().'_'.$document.'.xls');
    header('Content-Type: application/octet-stream');
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Pragma: public');
    header('Content-Length: '.strlen($documentBody));
    echo $documentBody;
} else {
    die(_('Wrong call'));
}
