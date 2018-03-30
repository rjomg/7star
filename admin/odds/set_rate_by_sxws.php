<?php
include_once( "../../global.php" );
$db = new rate( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
$y = $db->select( "plate", "plate_num", "1 order by plate_num desc limit 0,1" );
$z = $db->fetch_array( $y );
$plate_num = $z['plate_num'];
$oid = $_POST['dx'];
$all_set = $_POST['bl'];
$url = $db->get_call_back_url( $oid );
$rate = $db->get_rate( $oid, $_SESSION["uid".$c_p_seesion] );
$str = $db->get_o_content_str( 9, $rate, $all_set );
$db->update_odd_down( $oid, $plate_num, $str );
$db->get_admin_msg( $url );
?>
