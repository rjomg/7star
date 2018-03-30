<?php
include_once( "../../../global.php" );
include_once( "rate.class.php" );
$db = new rate0( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
$plate_num = "0";
$oid = $_POST['dx'];
$all_set = $_POST['bl'];
$url = $db->get_call_back_url( $oid );
$rate = $db->get_rate( $oid );
$str = $db->get_o_content_str( 9, $rate, $all_set );
$db->update( "odds_set", "o_content='{$str}'", "o_id={$oid} and user_id=0 and plate_num='{$plate_num}'", $url );
?>
