<?php
if (!session_id()) session_start();
include_once( "../../global.php" );
include_once( "rate.class.php" );
$db = new rate0( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
$plate_num = $_POST['plate_num'];
$t3 = iconv( "utf-8", "gbk", $_POST['t3'] );
$rate = $db->get_rate( $_POST['oid'], $_SESSION["uid".$c_p_seesion], $plate_num );
$rate[$t3][1] = $_POST['v'];
$o_content = ",";
foreach ( $rate as $v )
{
		$o_content .= implode( ":", $v ).",";
}
if ( $o_content )
{
		$db->update( "odds_set", "o_content='{$o_content}'", "o_id={$_POST['oid']} and user_id={$_SESSION["uid".$c_p_seesion]} and plate_num='{$plate_num}'" );
		$db->update_another_odd( $_SESSION["uid".$c_p_seesion], $_POST['oid'], $plate_num );
}
?>
