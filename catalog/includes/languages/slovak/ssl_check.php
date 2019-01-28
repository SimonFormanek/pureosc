<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
 */

define('NAVBAR_TITLE', 'Ochrana osobních údajů a zabezpečení', true);
define('HEADING_TITLE', 'Ochrana osobních údajů a zabezpečení', true);

define('TEXT_INFORMATION',
    'Zjistili jsme, že váš prohlížeč vygeneroval jiné identifikační číslo SSL relace použité na našich zabezpečených stránkách.<br /><br />Kvůli vaší bezpečnosti se budete muset znovu přihlásit do svého účtu, abyste mohli nakupovat online.<br /><br />Některé starší prohlížeče, jako například Konqueror 3.1, nemají schopnost automaticky vytvářet zabezpečené ID relace SSL, které požadujeme. Pokud používáte takový prohlížeč, doporučujeme použít jiný prohlížeč, například Microsoft Internet Explorer, Mozilla Firefox, Chrome, abyste mohli pokračovat v online nákupu.<br /><br />Toto ověření bezpečnosti provádíme ve váš prospěch, proto prosíme omluvte, pokud jsme vám tím způsobili něco nepříjemného.<br /><br />Prosíme <a href="'.tep_href_link(FILENAME_CONTACT_US,
        '', 'SSL').'">kontaktujte vlastníka obchodu</a> pokud máte nějaké dotazy týkající se tohoto problému, nebo objednejte zboží e-mailem..',
    true);

define('BOX_INFORMATION_HEADING', 'Ochrana osobních údajů a zabezpečení', true);
define('BOX_INFORMATION',
    'Ověřujeme ID relace SSL automaticky vygenerované vaším prohlížečem při každé žádosti o bezpečnostní stránku na tomto serveru.<br /><br />Tímto ověřením zajistíte, že ten kdo používá právě tuto stránku s vaším účtem jste opravdu vy a ne někdo jiný.',
    true);
?>
