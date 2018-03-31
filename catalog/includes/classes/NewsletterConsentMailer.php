<?php

namespace PureOSC;

/**
 * Description of NewsletterConsentMailer
 *
 * @author Vítězslav Dvořák <info@vitexsoftware.cz>
 */
class NewsletterConsentMailer extends \Ease\Mailer
{
    public $customer_id    = null;
    public $customer_email = null;
    public $customer_name  = null;

    public function __construct($userId, $email, $name)
    {
        $this->customer_id    = $userId;
        $this->customer_email = $email;
        $this->customer_name  = $name;
        parent::__construct($email, _('Newsletter GDPR Consent'),
            _('Dear Customer').' '.$name."\n");
        $this->setMailHeaders(['from'=> constant('STORE_OWNER').' <' . constant('STORE_OWNER_EMAIL_ADDRESS').'>' ]);
        
        $this->addContent();
    }

    public function addContent()
    {
        $this->addItem(new \Ease\Html\DivTag(sprintf(_('Would you like to subsribe to newsletter updates from %s ?'),
                    constant('STORE_NAME'))));

        $agreeLink = $this->getAgreeLink();

        $this->addItem(new \Ease\Html\DivTag(new \Ease\Html\ATag($agreeLink,
                    _('Click here to Agree'), ['style' => 'font: red 20px;'])));
        $this->addItem(new \Ease\Html\DivTag(new \Ease\Html\ATag($agreeLink,
                    $agreeLink)));
        $this->addItem(new \Ease\Html\DivTag(constant('EMAIL_CONTACT')));
    }

    public function getAgreeLink()
    {
        return constant( 'HTTPS_SERVER' ) . constant('DIR_WS_CATALOG').'newsletterconfirm.php?uid='.$this->customer_id.'&agree='.hash('sha256',
                $this->customer_email);
    }
}
