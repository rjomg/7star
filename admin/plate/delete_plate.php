<?php
include_once( "../../global.php" );
$db = new plate( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
$zhs = mysql_query( "select * from orders where plate_num={$_GET['plate_num']}" );
$user_arr = array( );
while ( $row = mysql_fetch_array( $zhs ) )
{
		$user_arr[] = $row['user_id'];
}
$user_arrs = array_flip( array_flip( $user_arr ) );
foreach ( $user_arrs as $key => $us )
{
		$orders_totalmoneys = $db->select( "orders_totalmoney", "orders_tm", "user_id={$us} and plate_num={$_GET['plate_num']}" );
		$orders_tm = $db->fetch_array( $orders_totalmoneys );
		$sql2 = "update users SET credit_remainder = credit_remainder+{$orders_tm['orders_tm']} where user_id ={$us}";
		$db->query( $sql2 );
}
$db->delete( "orders", "plate_num={$_GET['plate_num']}", "" );
$db->delete( "orders_totalmoney", "plate_num={$_GET['plate_num']}", "" );
$db->delete( "plate", "id={$_GET['id']}", "his.php" );
?>
