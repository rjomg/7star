<?php
include_once( "../../global.php" );
$user_id = $_SESSION["uid".$c_p_seesion];
$o_id = $_POST['o_id'];
$t3 = $_POST['t3'];
$ty = $_POST['ty'];
$oth = $_POST['oth'];
$o = $_POST['o'];
$thnew = $_POST['thnew'];
$t3 = iconv( "utf-8", "gbk", $t3 );
$db = new rate( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
$yx = $db->select( "plate", "plate_num", "1 order by plate_num desc limit 0,1" );
$z = $db->fetch_array( $yx );
$plate_num = $z['plate_num'];
$o1 = $db->company_only_odds( $o_id, $plate_num, $t3 );
$y = $db->select( "odds_set", "o_content", "plate_num={$plate_num} and o_id={$o_id} and user_id={$user_id} order by user_id asc" );
$row = $db->fetch_array( $y );
$tos_arr = explode( ",", trim( $row['o_content'], "," ) );
foreach ( $tos_arr as $to )
{
		$o_arr = explode( ":", $to );
		if ( $o_arr[0] == "{$t3}" )
		{
				$view_odd = $o_arr[1];
				if ( $ty == 1 )
				{
						$view_odd += $o;
				}
				else if ( $ty == 2 )
				{
						$view_odd -= $o;
				}
				else if ( $ty == 3 )
				{
						if ( $o_arr[2] == 0 )
						{
								$o_arr[2] = 1;
						}
						else
						{
								$o_arr[2] = 0;
						}
				}
				else if ( ( double )$oth != ( double )$thnew )
				{
						$view_odd = $thnew;
				}
				if ( $o1 < $view_odd )
				{
						$view_odd = $o1;
				}
				$to = $o_arr[0].":".$view_odd.":".$o_arr[2].":".$o_arr[3];
		}
		$toi .= $to.",";
}
$o_content = ",".trim( $toi, "," ).",";
if ( 16 <= $o_id && $o_id <= 31 )
{
		$db->update_another_odd( $o_id, $plate_num, $user_id, $o_content );
}
$db->update( "odds_set", "o_content='{$o_content}'", "o_id={$o_id} and user_id={$user_id} and plate_num='{$plate_num}'" );
echo $view_odd;
exit( );
?>
