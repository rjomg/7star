<?php
include_once( "../../global.php" );
$o_id = $_POST['o_id'];
$t3 = $_POST['t3'];
$t3 = iconv( "utf-8", "gbk", $t3 );
$db = new rate( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
$yx = $db->select( "plate", "plate_num", "1 order by plate_num desc limit 0,1" );
$z = $db->fetch_array( $yx );
$plate_num = $z['plate_num'];
$o1 = $db->company_only_odds( $o_id, $plate_num, $t3 );
$str = "<font color='blue'>{$o1}</font>";
echo $str;
exit( );
?>
