<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace PureOSC\ui;

/**
 * Description of QRFaktura
 *
 * @author Vítězslav Dvořák <info@vitexsoftware.cz>
 */
class QRFaktura extends \Ease\Html\ImgTag
{

    public function __construct($order, $tagProperties = array())
    {
        $qrFakt = new \BlahaSoft\QRFaktura\QRFaktura(false);
        $img    = $qrFakt->getQRCode($this->oscOrder2QRdata($order));
        parent::__construct('data:image/png;base64,'.base64_encode($img),
            _('QR Invoice'), $tagProperties);
    }

    public function oscOrder2QRdata($order)
    {
        $qrData       = [];
        $qrData['ID'] = $order->id;
        return $qrData;
    }
}
