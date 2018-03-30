<?php
include_once( "../../global.php" );
$db = new action( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
$callback = "son_user.php?user_id=".$_POST['is_extend']."&user_name=".$_POST['ex_name'];
$params = array( );
if ( $_GET['user_id'] )
{
		if ( !empty( $_POST['user_pwd'] ) )
		{
				$params['user_pwd'] = md5( $_POST['user_pwd'] );
		}
		$params['user_id'] = $_GET['user_id'];
		$params['close_type'] = $_POST['close_type'];
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
