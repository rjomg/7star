<?php
include_once( "../../global.php" );
$db = new rate( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
$tid = $_POST['tid'];
$u_id = $_POST['u_id'];
$plate_num = $_POST['plate_num'];
$o_content = $_POST['o_content'];
$x = $db->select( "odds_set", "o_content", "plate_num='{$plate_num}' and user_id={$u_id} and o_id={$tid}" );
$r = $db->fetch_array( $x );
$tos_arr = explode( ",", trim( $r['o_content'], "," ) );
foreach ( $tos_arr as $to )
{
		$o_arr = explode( ":", $to );
		$toi .= $o_arr[1].",";
}
$o_con = ",".trim( $toi, "," ).",";
if ( $o_content != $o_con )
{
		echo 1;
}
?>
