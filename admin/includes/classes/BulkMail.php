<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace PureOSC\Admin;

/*
 * Description of BulkMail
 *
 * @author Vítězslav Dvořák <info@vitexsoftware.cz>
 */

class BulkMail extends \PureOSC\NewsletterConsentMailer
{

    public function addContent()
    {
        $this->addItem(new \Ease\Html\DivTag('Važený zákazníku. Z důvodu změny v legislativě v souvislosti se směrnicí GDPR, se na vás obracíme s prosbou o '
                .'potvrzení vlastnictví emailové adresy a souhlas příjmem emailových oznámení.'));
        $this->addItem(new \Ease\Html\DivTag('V případě že se jedná o omyl, prosím tento email ignorujte.'));
        parent::addContent();
    }
}
