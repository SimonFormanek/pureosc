<?php
/*
  $Id: gv_faq.php,v 1.1.1.1.2.2 2003/05/04 12:24:25 wilt Exp $

  The Exchange Project - Community Made Shopping!
  http://www.theexchangeproject.org

  Gift Voucher System v1.0
  Copyright (c) 2001,2002 Ian C Wilson
  http://www.phesis.org

  Released under the GNU General Public License
 */

define('NAVBAR_TITLE', 'Dárkový poukaz FAQ', true);
define('HEADING_TITLE', 'Dárkový poukaz FAQ', true);

define('TEXT_INFORMATION',
    '<a name="Top"></a>
  <a href="'.tep_href_link(FILENAME_GV_FAQ, 'faq_item=1', 'NONSSL').'">Nákup dárkových poukazů</a><br>
  <a href="'.tep_href_link(FILENAME_GV_FAQ, 'faq_item=2', 'NONSSL').'">Jak zaslat dárkové poukazy</a><br>
  <a href="'.tep_href_link(FILENAME_GV_FAQ, 'faq_item=3', 'NONSSL').'">Nákup s dárkovým poukazem</a><br>
  <a href="'.tep_href_link(FILENAME_GV_FAQ, 'faq_item=4', 'NONSSL').'">Uplatnění dárkových poukazů</a><br>
  <a href="'.tep_href_link(FILENAME_GV_FAQ, 'faq_item=5', 'NONSSL').'">Případné potíže</a><br>
');
switch ($_GET['faq_item']) {
    case '1':
        define('SUB_HEADING_TITLE', 'Nákup dárkových poukazů.', true);
        define('SUB_HEADING_TEXT',
            'Dárkové poukazy se kupují stejně jako jiné položky v našem obchodě. Platíte za ně pomocí standardních platebních metod. Jakmile zakoupíte hodnotu dárkového poukazu, bude přidán do vašeho osobního účtu dárkových poukazů. Máte-li v účtu dárkových poukazů prostředky, částka se zobrazuje v Nákupním košíku a také odkaz na stránku, kterou můžete někomu zaslat e-mailem.');
        break;
    case '2':
        define('SUB_HEADING_TITLE', 'Jak zaslat dárkové poukazy', true);
        define('SUB_HEADING_TEXT',
            'Chcete-li poslat dárkový poukaz, musíte jít na stránku Odeslat dárkový poukaz. Odkaz na tuto stránku naleznete v poli Nákupní košík v pravém sloupci každé stránky.
Při odeslání dárkového poukazu musíte zadat následující údaje:
Jméno osoby, na kterou zasíláte dárkový poukaz.
E-mailovou adresu osoby, jíž doručujete dárkový poukaz.
Částku, kterou chcete odeslat. (Všimněte si, že nemusíte odesílat celou částku, která je v účtu Vašich dárkových poukazů.)
Krátká zpráva se objeví v e-mailu.
Ujistěte se, že jste zadali všechny informace správně, můžete vše změnit, než bude e-mail skutečně odeslán.');
        break;
    case '3':
        define('SUB_HEADING_TITLE', 'Nákup s dárkovým poukazem.', true);
        define('SUB_HEADING_TEXT',
            'Máte-li peníze na účtu dárkových poukazů, můžete je použít k zakoupení dalšího zboží. Ve fázi placení se vám ukáže další schránka. Zaškrtnutím tohoto políčka použijete tyto prostředky z účtu dárkového poukazu. Vezměte prosím na vědomí, že budete muset vybrat jinou platební metodu, pokud účet dárkového poukazu nebude stačit k zaplacení nákupu. Pokud máte na účtě dárkových poukazů více peněz než celkovou cenu nákupu, můžete je použít při příštím nákupu.');
        break;
    case '4':
        define('SUB_HEADING_TITLE', 'Uplatnění dárkových poukazů.', true);
        define('SUB_HEADING_TEXT',
            'Pokud obdržíte dárkový poukaz e-mailem, bude obsahovat podrobnosti o tom, kdo ho odeslal
a případně krátkou zprávou od něj. E-mail bude obsahovat i odkaz na uplatnění poukazu. Dárkový poukaz můžete uplatnit jste-li přihlášeni nebo jste si vytvořili účet. Dva způsoby, jak můžete kupón uplatnit: <br>
   1. Kliknutím na odkaz obsažený v e-mailu pro tento výslovný účel se
dostanete na stránku Uplatnění dárkového poukazu. Budete požádáni o vytvoření účte nebo přihlášení, než bude dárkový poukaz ověřen a vložen do vašeho účtu dárkových poukazů, který je připraven k vašemu nákupu jakéholi zboží.
   2. Během placení v pokladně ve volbě způsob placení bude zaškrtávací políčko a tlačítko pro uplatnění zůstatku dárkových poukazů pro váš nákup.');
        break;
    case '5':
        define('SUB_HEADING_TITLE', 'Pokud dojde k potížím.', true);
        define('SUB_HEADING_TEXT',
            'V případě jakýchkoli dotazů ohledně systému dárkových poukazů kontaktujte prosím obchod e-mailem na adrese '.STORE_OWNER_EMAIL_ADDRESS.'. Ujistěte se, že posíláte e-mailem co nejvíce informací. ');
        break;
    default:
        define('SUB_HEADING_TITLE', '', true);
        define('SUB_HEADING_TEXT', 'Vyberte jednu z výše uvedených otázek.',
            true);
}