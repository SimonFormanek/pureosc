<?php

namespace PureOSC;

use Ease\Container;
use Ease\Html\ATag;
use Ease\Html\DivTag;
use Ease\Html\ImgTag;
use Ease\HtmlMailer;
use function cfg;

/**
 * Description of NewsletterConsentMailer
 *
 * @author Vítězslav Dvořák <info@vitexsoftware.cz>
 */
class NewsletterConsentMailer extends HtmlMailer {

    public $customer_id = null;
    public $customer_email = null;
    public $customer_name = null;

    /**
     * 
     * @param int    $userId
     * @param string $email
     * @param string $name
     */
    public function __construct($userId, $email, $name) {
        $this->customer_id = $userId;
        $this->customer_email = $email;
        $this->customer_name = $name;

        $mailBody = new DivTag();

        $mailBody->addItem(new DivTag(_('Dear Customer') . ' ' . $name));

        $mailBody->addItem(new DivTag(sprintf(_('Would you like to subsribe to newsletter updates from %s ?'),
                                cfg('STORE_NAME'))));

        $agreeLink = $this->getAgreeLink();

        $mailBody->addItem(new DivTag(new ATag($agreeLink,
                                _('Click here to Agree'), ['style' => 'font: red 20px;'])));
        $mailBody->addItem(new DivTag(new ATag($agreeLink,
                                $agreeLink)));
        $mailBody->addItem(new DivTag(cfg('EMAIL_CONTACT')));

        $mailBody->addItem(new ImgTag(ImgTag::fileBase64src(cfg('DIR_WS_IMAGES') . 'store_logo.png'), _('Store logo')), ['style' => 'margin: 10px']);

        parent::__construct($email, _('Newsletter GDPR Consent'), $mailBody,
                new Container("\n"));
        $this->setMailHeaders(['from' => cfg('STORE_OWNER') . ' <' . cfg('STORE_OWNER_EMAIL_ADDRESS') . '>']);
    }

    public function getAgreeLink() {
        return cfg('HTTPS_SERVER') . cfg('DIR_WS_CATALOG') . 'newsletterconfirm.php?uid=' . $this->customer_id . '&agree=' . \hash('sha256',
                        $this->customer_email);
    }

}
