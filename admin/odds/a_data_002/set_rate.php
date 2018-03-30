<?php
include_once( "../../../global.php" );
include_once( "rate.class.php" );
$db = new rate0( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
$plate_num = "0";
$url = $db->get_call_back_url( $_POST['o_type'] );
if ( $_POST['o_type'] == 69 || $_POST['o_type'] == 71 )
{
		$db->update( "odds_set", "o_content='{$_POST['ocontent2']}'", "o_id=".( $_POST['o_type'] + 1 )." and user_id=0 and plate_num='{$plate_num}'" );
}
else
{
		$db->update_another_odd( $_POST['o_type'], $plate_num, $_POST['ocontent'] );
}
$db->update( "odds_set", "o_content='{$_POST['ocontent']}'", "o_id={$_POST['o_type']} and user_id=0 and plate_num='{$plate_num}'", $url );
?>
