<?php
include_once( "../../global.php" );
$db = new plate( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
if ( $_POST['plate_num'] )
{
		$is_auto = $_POST['is_auto'];
		$plate_num = $_POST['plate_num'];
		$nowtime = time( );
		$sql = "update plate set is_auto='{$is_auto}' where plate_num='{$plate_num}'";
		$db->query( $sql );
		$db->auto_set_plate( );
		$is_plate_starts = $db->is_plate_starts( );
		if ( empty( $_POST['is_auto'] ) && empty( $is_plate_starts ) )
		{
				if ( strtotime( $_POST['plate_time_satrt'] ) <= $nowtime && $nowtime <= strtotime( $_POST['special_time_end'] ) )
				{
						$is_special = 1;
				}
				else
				{
						$is_special = 0;
				}
				if ( strtotime( $_POST['plate_time_satrt'] ) <= $nowtime && $nowtime <= strtotime( $_POST['normal_time_end'] ) )
				{
						$is_normal = 1;
				}
				else
				{
						$is_normal = 0;
				}
				if ( strtotime( $_POST['plate_time_satrt'] ) <= $nowtime && $nowtime <= strtotime( $_POST['plate_time_end'] ) )
				{
						$is_plate_start = 0;
				}
				else
				{
						$is_plate_start = 1;
				}
				$db->query( "update plate set is_special={$is_special},is_normal={$is_normal},is_plate_start={$is_plate_start} where plate_num='{$plate_num}'" );
		}
		echo 1;
}
?>
