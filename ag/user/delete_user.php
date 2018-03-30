<?php
include_once( "../../global.php" );
$id = $_GET['id'];
$power = $_GET['power'];
$callback = "branch.php?power=".$power;
if ( $_GET['ty'] )
{
		$callback = "son_user.php?power=".$power."&user_id=".$_GET['ty'];
}
$db = new action( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
$db->delete_users( $id );
$db->get_admin_msg( $callback );
?>
