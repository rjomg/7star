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
$db->is_exceed_company_odds( $oid, $plate_num, $str );
$db->update( "odds_set", "o_content='{$str}'", "o_id={$oid} and user_id={$_SESSION["uid".$c_p_seesion]} and plate_num='{$plate_num}'", $url );
?>
