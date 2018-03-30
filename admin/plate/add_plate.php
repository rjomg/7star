<?php
include_once( "../../global.php" );
$db = new plate( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
$iss7 = $db->select( "plate", "plate_num", "1 order by plate_num desc " );
$is7 = $db->fetch_array( $iss7 );
$iss77 = $db->select( "plate_autoadd", "id", "plate_num={$_POST['plate_num']} limit 0,1" );
$is77 = $db->fetch_array( $iss77 );
// var_dump($_POST['plate_num']);exit;
if ( $is7['plate_num'] < $_POST['plate_num'] && empty( $is77['id'] ) )
{
		$db->add_plate( $_POST, "tab.php" );
}
else
{
		$db->update_plate( $_POST, "tab.php" );

}
$sql = "select user_id,credit_total from users ";
		$info = mysql_query( $sql );
		while ( $rw = mysql_fetch_array( $info ) )
		{
				$credit = $rw['credit_total'];
				$id = $rw['user_id'];
				$sql = "UPDATE users  set credit_remainder = '{$credit}' where user_id = '{$id}'";
				$query = mysql_query( $sql );
				if ( $query )
				{
						echo " <script> alert( '還原成功。 ') ; location.href= 'restore.php'; </script> ";
				}
		}
?>
