<?php
include_once( "../../global.php" );
$db = new rate( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
$y = $db->select( "plate", "plate_num", "1 order by plate_num desc limit 0,1" );
$z = $db->fetch_array( $y );
$plate_num = $z['plate_num'];
$url = $db->get_call_back_url( $_POST['o_type'] );
if ( $_POST['o_type'] == 69 || $_POST['o_type'] == 71 )
{
		$db->is_exceed_company_odds( $_POST['o_type'] + 1, $plate_num, $_POST['ocontent2'] );
		$db->update( "odds_set", "o_content='{$_POST['ocontent2']}'", "o_id=".( $_POST['o_type'] + 1 )." and user_id={$_SESSION["uid".$c_p_seesion]} and plate_num='{$plate_num}'" );
}
else
{
		$db->is_exceed_company_odds( $_POST['o_type'], $plate_num, $_POST['ocontent'] );
		$db->update_another_odd( $_POST['o_type'], $plate_num, $_SESSION["uid".$c_p_seesion], $_POST['ocontent'] );
}
$db->update( "odds_set", "o_content='{$_POST['ocontent']}'", "o_id={$_POST['o_type']} and user_id={$_SESSION["uid".$c_p_seesion]} and plate_num='{$plate_num}'", $url );
?>
