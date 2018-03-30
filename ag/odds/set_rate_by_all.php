<?php
include_once( "../../global.php" );
$db = new rate( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
$y = $db->select( "plate", "plate_num", "1 order by plate_num desc limit 0,1" );
$z = $db->fetch_array( $y );
$plate_num = $z['plate_num'];
$url = $db->get_call_back_url( $_POST['oid'] );
$rate = $db->get_rate( $_POST['oid'], $_SESSION["uid".$c_p_seesion] );
$ty = $_POST['dx'];
$all_set = $_POST['bl'];
$str = $db->get_o_content_str( $ty, $rate, $all_set );
if ( $_POST['oid'] == 69 || $_POST['oid'] == 71 )
{
		$rate1 = $db->get_rate( $_POST['oid'] + 1, $_SESSION["uid".$c_p_seesion] );
		$str1 = $db->get_o_content_str( $ty, $rate1, $all_set );
		$db->is_exceed_company_odds( $_POST['oid'] + 1, $plate_num, $str1 );
		$db->update( "odds_set", "o_content='{$str1}'", "o_id=".( $_POST['oid'] + 1 )." and user_id={$_SESSION["uid".$c_p_seesion]} and plate_num='{$plate_num}'" );
}
else if ( 15 < $_POST['oid'] && $_POST['oid'] < 33 )
{
		$db->is_exceed_company_odds( $_POST['oid'], $plate_num, $str );
		$db->update_another_odd( $_POST['oid'], $plate_num, $_SESSION["uid".$c_p_seesion], $str );
}
$db->is_exceed_company_odds( $_POST['oid'], $plate_num, $str );
$db->update( "odds_set", "o_content='{$str}'", "o_id={$_POST['oid']} and user_id={$_SESSION["uid".$c_p_seesion]} and plate_num='{$plate_num}'", $url );
?>
