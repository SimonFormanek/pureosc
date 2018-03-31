#!/usr/bin/php -f
<?php
define('EASE_LOGGER', 'console|syslog');
chdir('../../');
require_once 'vendor/autoload.php';
\Ease\Shared::initializeGetText('pureosc', 'cs_CZ', '../../i18n');

$oPage = new \Ease\Page();


require('admin/ext/oscconfig/flexibee.php');
require('admin/ext/oscconfig/dbconfigure.php');

$dbHelper   = new Ease\SQL\PDO();
$recipients = $dbHelper->queryToArray("select customers_id, customers_firstname, customers_lastname, customers_email_address from customers where customers_newsletter = '1'");

$oPage->addStatusMessage(count($recipients).' recipients to spam');
foreach ($recipients as $recipientId => $recipientData) {
    $mailer = new \PureOSC\Admin\BulkMail($recipientData['customers_id'], $recipientData['customers_email_address'], $recipientData['customers_firstname'].' '.$recipientData['customers_lastname']);
    if ($mailer->send()) {
        $oPage->addStatusMessage(($recipientId + 1).'/'.count($recipients).':'.$recipientData['customers_email_address'],
            'success');
        sleep(2);
    }
}

