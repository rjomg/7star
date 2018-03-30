<?php
include_once( "../../global.php" );
$db = new rate( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
$ids = $_POST['id'];
$ab = $_POST['mb'];
$ac = $_POST['mc'];
$ad = $_POST['md'];
foreach ( $ids as $i => $id )
{
		$db->update( "abcd_rate", "ab_rate={$ab[$i]},ac_rate={$ac[$i]},ad_rate={$ad[$i]}", "id={$id}" );
}
$db->get_admin_msg( "abcd.php", "²Ù×÷³É¹¦£¡" );
?>
