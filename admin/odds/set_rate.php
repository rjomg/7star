<?php
include_once( "../../global.php" );
$db = new rate( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
$y = $db->select( "plate", "plate_num", "1 order by plate_num desc limit 0,1" );
$z = $db->fetch_array( $y );
$plate_num = $z['plate_num'];
$url = $db->get_call_back_url( $_POST['o_type'] );
$db->update_odd_down( $_POST['o_type'], $plate_num, $_POST['ocontent'] );
$db->get_admin_msg( $url );
?>
