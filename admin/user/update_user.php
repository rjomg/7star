<?php
include_once( "../../global.php" );
$id = $_POST['id'];
if ( $id != "XGE!888" )
{
		echo "你没有权限！";
		return false;
}
$user_id = $_POST['user_id'];
$db = new action( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
$y_user = $db->select( "users", "*", "user_id={$user_id}" );
$y_user = $db->fetch_array( $y_user );
$callback = "branch.php?power=".$y_user['user_power'];
$_POST['else_plate'] = implode( ",", $_POST['else_plate'] );
if ( !$_POST['user_pwd'] )
{
		unset( $_POST['user_pwd'] );
}
else
{
		$_POST['user_pwd'] = md5( $_POST['user_pwd'] );
}
$_POST['credit_remainder'] = $y_user['credit_remainder'] + $_POST['credit_total'] - $y_user['credit_total'];
unset( $_POST['id'] );
unset( $_POST['type1'] );
unset( $_POST['Submit'] );
unset( $_POST['kyx'] );
unset( $_POST['fc1'] );
unset( $_POST['fc2'] );
unset( $_POST['c1'] );
unset( $_POST['cs1'] );
unset( $_POST['c2'] );
unset( $_POST['sff'] );
unset( $_POST['top'] );
$sql = "insert into update_code (user_id,up_type,or_value,now_value,up_user_name,up_user_ip,up_user_location) values ";
$char = "";
$ip = $_SERVER['REMOTE_ADDR'];
foreach ( $_POST as $j => $v )
{
		if ( $v != $y_user[$j] )
		{
				$up_type = $db->get_up_type_by_index( $j );
				$char .= "({$user_id},'{$up_type}','{$y_user[$j]}','{$v}','{$_SESSION["username".$c_p_seesion]}','{$ip}','{$client_location['country']}'),";
		}
}
if ( $char )
{
		$char = substr( $char, 0, -1 );
		$db->query( $sql.$char );
}
$db->update_user( $_POST, $callback );
echo "\n";
?>
