<?php
require_once('includes/application_top.php');

$oPage = new \Ease\TWB\WebPage('ISDOCx');

$embed    = $oPage->getRequestValue('embed');
$id       = 'ext:osc:'.$oPage->getRequestValue('id');
$evidence = $oPage->getRequestValue('evidence');


$document = new \FlexiPeeHP\FlexiBeeRO(is_numeric($id) ? intval($id) : $id,
    ['evidence' => $evidence]);

if (!is_null($document->getMyKey())) {
    $documentBody = $document->getInFormat('isdocx');
    header('Content-Description: File Transfer');
    header('Content-Disposition: attachment; filename='.$document->getEvidence().'_'.$document.'.isdocx');
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
