<?php
//include "pripojdtb.php";
require('includes/application_top.php');
if (($_GET['vstup'] == 1)) {
    if ($_GET['now'] == 1)
            tep_db_query("UPDATE orders SET date_tax=NOW() WHERE orders_id=".$_GET['oID']);
    else
            tep_db_query("UPDATE orders SET date_tax='".$_POST['newdate']."' WHERE orders_id=".$_GET['oID']);
    echo '<script language="javascript"><!--';
    if ($katset == 1) {
        echo '
document.write(history.go(-1))
';
    } else {
        echo '
document.write(history.go(-2))
';
    }
    echo '//--></script>';

    exit;
}
$date_q   = tep_db_query("SELECT date_tax FROM orders WHERE orders_id=".$_GET['oID']);
$date     = tep_db_fetch_array($date_q);
$date_tax = $date['date_tax'];
$date_tax = substr($date_tax, 0, 10);
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-2">
    </head>
    <html>
        <body>
            format: (rrrr-mm-dd)
            <form action="?oID=<?php print $_GET['oID']; ?>&vstup=1" method="post" enctype="multipart/form-data">

                <input name=newdate type=text  value="<?php print $date_tax; ?>">
            </form>
            <a href=?oID=<?php echo$oID ?>&vstup=1&now=1>dnes</a>

    </html>