<?php
include_once( "../../../global.php" );
include_once( "rate.class.php" );
$db = new rate0( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
$plate_num = "0";
$url = $db->get_call_back_url( $_POST['oid'] );
$rate = $db->get_rate( $_POST['oid'] );
$ty = $_POST['dx'];
$all_set = $_POST['bl'];
$str = $db->get_o_content_str( $ty, $rate, $all_set );
if ( $_POST['oid'] == 69 || $_POST['oid'] == 71 )
{
		$rate1 = $db->get_rate( $_POST['oid'] + 1 );
		$str1 = $db->get_o_content_str( $ty, $rate1, $all_set );
		$db->update( "odds_set", "o_content='{$str1}'", "o_id=".( $_POST['oid'] + 1 )." and user_id=0 and plate_num='{$plate_num}'" );
}
else if ( 15 < $_POST['oid'] && $_POST['oid'] < 33 )
{
		$db->update_another_odd( $_POST['oid'], $plate_num, $str );
}
$db->update( "odds_set", "o_content='{$str}'", "o_id={$_POST['oid']} and user_id=0 and plate_num='{$plate_num}'", $url );
?>
