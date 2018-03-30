<?php
include_once( "../../global.php" );
$db = new rate( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
$y = $db->select( "plate", "plate_num", "1 order by plate_num desc limit 0,1" );
$z = $db->fetch_array( $y );
$plate_num = $z['plate_num'];
$o_content = iconv( "utf-8", "gbk", $_POST['o_content'] );
$db->update_odd_down( $_POST['oid'], $plate_num, $o_content );
?>
