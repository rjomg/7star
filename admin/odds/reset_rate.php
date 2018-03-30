<?php
include_once( "../../global.php" );
$db = new rate( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
$db2 = new rate( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
$y = $db->select( "plate", "plate_num", "1 order by plate_num desc limit 0,1" );
$z = $db->fetch_array( $y );
$plate_num = $z['plate_num'];
$sql = "DELETE FROM odds_set WHERE user_id={$_SESSION["uid".$c_p_seesion]} and plate_num = '{$plate_num}';";
$query = "INSERT INTO odds_set SELECT {$_SESSION["uid".$c_p_seesion]},'{$plate_num}', o_id, `o_content` , `ab_content` FROM odds_set WHERE `plate_num` = '0' and user_id=0";
$db->query( $sql );
$db->query( $query );
$u = $db->select( "users", "user_id", "top_id={$_SESSION["uid".$c_p_seesion]} order by user_id desc" );
while ( $us = $db->fetch_array( $u ) )
{
		$sql2 = "DELETE FROM odds_set WHERE user_id={$us['user_id']} and plate_num = '{$plate_num}';";
		$query2 = "INSERT INTO odds_set SELECT {$us['user_id']},'{$plate_num}', o_id, `o_content` , `ab_content` FROM odds_set WHERE `plate_num` = '0' and user_id=0";
		$db2->query( $sql2 );
		$db2->query( $query2 );
}
$db->get_admin_msg( "hymr.php" );
?>
