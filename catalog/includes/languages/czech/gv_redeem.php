<?php
/*
  $Id: gv_redeem.php,v 1.1.1.1.2.1 2003/04/18 16:56:03 wilt Exp $

  The Exchange Project - Community Made Shopping!
  http://www.theexchangeproject.org

  Gift Voucher System v1.0
  Copyright (c) 2001,2002 Ian C Wilson
  http://www.phesis.org

  Released under the GNU General Public License
 */

define('NAVBAR_TITLE', 'Uplatnění dárkového poukazu', true);
define('HEADING_TITLE', 'Uplatnění dárkového poukazu', true);
define('TEXT_INFORMATION',
    'Další informace týkající se dárkových poukazů naleznete <a href="'.tep_href_link(FILENAME_GV_FAQ,
        '', 'NONSSL').'">'.GV_FAQ.'.</a>', true);
define('TEXT_INVALID_GV',
    'Číslo dárkového poukazu může být neplatné nebo již bylo uplatněno. Chcete-li kontaktovat vlastníka obchodu, použijte kontaktní stránku',
    true);
define('TEXT_VALID_GV',
    'Blahopřejeme vám, že jste uplatnili dárkový poukaz v hodnotě %', true);