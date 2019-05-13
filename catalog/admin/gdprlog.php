<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2010 osCommerce

  Released under the GNU General Public License
 */

require('includes/application_top.php');

$logTable = new \PureOSC\ui\DataTable( $adminLog );
$logTable->finalize();

require(DIR_WS_INCLUDES.'template_top.php');
?>
<table border="0" width="100%" cellspacing="0" cellpadding="2">
    <tr>
        <td><?php
                    
                    echo $logTable;

?>                    
        </td>
    </tr>
</table>
<?php
require(DIR_WS_INCLUDES.'template_bottom.php');
require(DIR_WS_INCLUDES.'application_bottom.php');

