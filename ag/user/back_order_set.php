<?php
include_once( "../../global.php" );
$callback = "auto_add.php?power=".$_POST['power'];
$user_id = $_POST['user_id'];
$db = new action( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
foreach ( $_POST['o_typename'] as $i => $v )
{
		$query = $db->select( "backorder_set", "is_use", "user_id ='{$user_id}' and o_typename='{$v}'" );
		$row = $db->fetch_array( $query );
		if ( $row['is_use'] == 1 )
		{
				$sql = "update backorder_set set \n        control_limit=".$_POST['or_value'][$i].""." where user_id =".$user_id." and o_typename='".$v."'";
				$qq = $db->query( $sql );
				if ( $qq )
				{
						$db->auto_add( $v, $_POST['now_value'][$i], $_POST['or_value'][$i], $client_location['country'] );
				}
		}
}
$db->get_admin_msg( $callback, "保存操作成功！" );
?>
