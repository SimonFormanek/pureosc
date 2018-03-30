<?php

namespace PureOSC;

/**
 * Description of NewsletterConsentMailer
 *
 * @author Vítězslav Dvořák <info@vitexsoftware.cz>
 */
class NewsletterConsentMailer extends \Ease\Mailer
{

    public function __construct($userId, $email, $name)
    {
        parent::__construct($email, _('Newsletter GDPR Consent'),
            _('Dear Customer').' '.$name."\n");
        $this->addItem(new \Ease\Html\DivTag(sprintf(_('Would you like to subsribe to newsletter updates from %s ?'),
                    constant('STORE_NAME'))));
        $this->addItem(new \Ease\Html\ATag(constant('DIR_WS_CATALOG').'/newsletterconfirm.php?uid='.$userId.'&agree='.hash('sha256',
                    $email), _('Click here to Agree'),
                ['style' => 'font: red 20px;']));
        $this->addItem(new \Ease\Html\DivTag(constant('EMAIL_CONTACT')));
    }
}
