<?php
include_once( "../../global.php" );
include_once( "rate.class.php" );
$db = new rate0( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
$user_id = $_SESSION["uid".$c_p_seesion];
if ( $_POST['mv'] == 1 )
{
		$gset = 0 - $_POST['money'];
}
else
{
		$gset = $_POST['money'];
}
$t3str = $_POST['t3str'];
$oid = $_POST['o_type'];
$plate_num = $_POST['pl_num'];
$rate = $db->get_rate( $oid, $user_id, $plate_num );
$t3str = substr( $t3str, 0, -1 );
$t3s = explode( ",", $t3str );
foreach ( $t3s as $t3 )
{
		$rate[$t3][1] += $gset;
}
$o_content = ",";
foreach ( $rate as $v )
{
		$o_content .= implode( ":", $v ).",";
}
$url = $db->get_call_back_url( $oid, $plate_num );
$db->update_another_odd( $user_id, $oid, $plate_num, $o_content );
$db->update( "odds_set", "o_content='{$o_content}'", "o_id={$oid} and user_id={$user_id} and plate_num='{$plate_num}'", $url );
?>
