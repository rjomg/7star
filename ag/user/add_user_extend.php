<?php
include_once( "../../global.php" );
$db = new action( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
$callback = "leveladdedit.php?user_id=".$_POST['is_extend']."&user_name=".$_POST['ex_name'];
$params = array( );
if ( $_GET['user_id'] )
{
		$params['user_pwd'] = md5( $_POST['user_pwd'] );
		$params['user_id'] = $_GET['user_id'];
		$db->update_user( $params, $callback );
}
else
{
		$_POST['user_pwd'] = md5( $_POST['user_pwd'] );
		unset( $_POST['Submit'] );
		unset( $_POST['ex_name'] );
		$db->add_user( $_POST, $callback );
}
?>
