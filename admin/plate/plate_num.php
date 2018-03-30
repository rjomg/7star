<?php
include_once( "../../global.php" );
$db = new plate( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
$_POST['true_time_lottery'] = date( "Y-m-d H:i:s", time( ) );
// var_dump($_POST);exit;
if ( $_POST['num_g'] )
{
		$_POST['open_num'] = 7;
}
else if ( $_POST['num_f'] )
{
		$_POST['open_num'] = 6;
}
else if ( $_POST['num_e'] )
{
		$_POST['open_num'] = 5;
}
else if ( $_POST['num_d'] )
{
		$_POST['open_num'] = 4;
}
else if ( $_POST['num_c'] )
{
		$_POST['open_num'] = 3;
}
else if ( $_POST['num_b'] )
{
		$_POST['open_num'] = 2;
}
else if ( $_POST['num_a'] )
{
		$_POST['open_num'] = 1;
}
$num_a = 0 <= $_POST['num_a'] ? $_POST['num_a'] : -1;
$num_b = 0 <= $_POST['num_b'] ? $_POST['num_b'] : -2;
$num_c = 0 <= $_POST['num_c'] ? $_POST['num_c'] : -3;
$num_d = 0 <= $_POST['num_d'] ? $_POST['num_d'] : -4;
$num_e = 0 <= $_POST['num_e'] ? $_POST['num_e'] : -5;
$num_f = 0 <= $_POST['num_f'] ? $_POST['num_f'] : -6;
$num_g = 0 <= $_POST['num_g'] ? $_POST['num_g'] : -7;
$arr1 = array(
		$_POST['num_a'],
		$_POST['num_b'],
		$_POST['num_c'],
		$_POST['num_d'],
		$_POST['num_e'],
		$_POST['num_f'],
		$_POST['num_g']
);
$num1 = count( $arr1 );
// $arr2 = array_unique( $arr1 );
$num2 = count( $arr1 );
if ( $num1 != $num2 )
{
		$db->get_admin_msg( "tab.php", "操作成功" );
		exit( );
}
$i = -3;
$f = 0;
foreach ( $_POST as $v )
{
		if ( 0 <= $v )
		{
				++$i;
		}
		// if ( $v == 0 )
		// {
		// 		++$f;
		// }
}
// exit;
// var_dump($i);exit;
if ( 0 < $f )
{
		$db->get_admin_msgtopnull( "tab.php" );
}
$query = $db->select( "plate", "last_special,plate_num,is_plate_start", "1 order by plate_num desc" );
$row = $db->fetch_array( $query );
// var_dump($i);exit;
if ( $row['is_plate_start'] != 1 && $row['last_special'] <= $i )
{
		$db->update( "plate", "is_plate_start=1,is_auto=1,is_special=0,is_normal=0", "plate_num='{$row['plate_num']}'" );
}
$db->update_plate( $_POST, "tab.php" );
?>
