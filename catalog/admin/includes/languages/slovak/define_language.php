<?php
/*
  $Id: define_language.php,v 1.3 2002/01/05 12:19:50 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Výber jazykov');
define('TABLE_HEADING_FILES', 'súboru');
define('TABLE_HEADING_WRITABLE', 'na zápis');
define('TABLE_HEADING_LAST_MODIFIED', 'Posledná zmena');

define('TEXT_EDIT_NOTE', '<strong>Editácia Definícia</strong><br /><br />Každá definícia je nastavený jazyk pomocou PHP <a href="http://www.php.net/define" target="_blank">define()</a> funkcie v nasledujúcim spôsobom: <br /><br /><nobr>define(\'TEXT_MAIN\', \'<span style="background-color: #FFFF99;">ento text je možné editovať. Je to naozaj jednoduché!</span>\');</nobr><br /><br />Zvýraznený text je možné editovať. Pretože táto definícia je pomocou apostrofov obsahovať text, nejaké jednoduché úvodzovky v rámci definície texte musí byť sprevádzané spätným lomítkom (Napr., Mc Donald\\\'s).');

define('TEXT_FILE_DOES_NOT_EXIST', 'Súbor neexistuje.');

define('ERROR_FILE_NOT_WRITEABLE', 'Chyba: Nemožno zapisovať do súboru. Nastavte prosím správne prístupové práva na: %s');
?>
