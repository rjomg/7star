<?php
include_once( "../../global.php" );
$db = new plate( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
if ( $_POST['plate_num'] )
{
		$kaijiangs = $db->select( "caijikaijiang", "*", "plate_num='{$_POST['plate_num']}' limit 0,1" );
		$kaijiang = $db->fetch_array( $kaijiangs );
		$params['plate_num'] = $kaijiang['plate_num'];
		$params['num_a'] = $kaijiang['num_a'];
		$params['num_b'] = $kaijiang['num_b'];
		$params['num_c'] = $kaijiang['num_c'];
		$params['num_d'] = $kaijiang['num_d'];
		$params['num_e'] = $kaijiang['num_e'];
		$params['num_f'] = $kaijiang['num_f'];
		$params['num_g'] = $kaijiang['num_g'];
		$params['is_plate_start'] = 1;
		$params['is_auto'] = 1;
		$params['is_special'] = 0;
		$params['is_normal'] = 0;
		$params['open_num'] = 7;
		$params['true_time_lottery'] = date( "Y-m-d H:i:s", time( ) );
		if ( $_POST['plate_num'] == $kaijiang['plate_num'] )
		{
				$db->update_plate( $params, "" );
				echo 1;
		}
}
?>
