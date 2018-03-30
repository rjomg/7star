<?php
include_once( "../../global.php" );
$db = new plate( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
if ( $_POST['plate_num'] )
{
		$plate_num = $_POST['plate_num'];
		$nowtime = strtotime( $_POST['now'] );
		if ( empty( $_POST['is_auto'] ) )
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
		$zt = $_POST['zt'];
		$sql = "update plate set is_plate_start='{$zt}' where plate_num='{$plate_num}'";
		if ( $zt == 1 )
		{
				$sql = "update plate set is_plate_start='{$zt}',is_auto=1,is_special=0,is_normal=0 where plate_num='{$plate_num}'";
		}
		$db->query( $sql );
		echo 1;
}
?>
