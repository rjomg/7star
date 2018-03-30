<?php
include_once( "../../global.php" );
$db = new plate( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
$history_is_account = $_POST['history_is_account'];
$history_is_lock = $_POST['history_is_lock'];
$id = $_POST['id'];
$plate_num = $_POST['plate_num'];
$query = $db->select( "plate", "*", "plate_num={$plate_num} order by plate_num desc" );
$xxx = $db->fetch_array( $query );
if ( $history_is_account == 0 )
{
		// $db->save_accountopen( $plate_num );
		$db->update( "plate", "history_is_account=1", "id={$id}" );
		$orders_alls = mysql_query("select * from orders where plate_num=$plate_num order by id desc");
		$oxxo=$xxx['num_a'].'XX'.$xxx['num_d'];
		$oxox=$xxx['num_a'].'X'.$xxx['num_c'].'X';
		$ooxx=$xxx['num_a'].$xxx['num_b'].'XX';
		$xoox='X'.$xxx['num_b'].$xxx['num_c'].'X';
		$xoxo='X'.$xxx['num_b'].'X'.$xxx['num_d'];
		$xxoo='XX'.$xxx['num_c'].$xxx['num_d'];

		$ooox=$xxx['num_a'].$xxx['num_b'].$xxx['num_c'].'X';
		$ooxo=$xxx['num_a'].$xxx['num_b'].'X'.$xxx['num_d'];
		$oxoo=$xxx['num_a'].'X'.$xxx['num_c'].$xxx['num_d'];
		$xooo='X'.$xxx['num_b'].$xxx['num_c'].$xxx['num_d'];

		$oooo=$xxx['num_a'].$xxx['num_b'].$xxx['num_c'].$xxx['num_d'];
		while($row = mysql_fetch_array($orders_alls)){
			$shuying_y=($row['orders_p']*$row['orders_y'])-$row['orders_y'];
            $roworders_y=0-$row['orders_y'];
			if ($row['o_type3']==$oxxo || $row['o_type3']==$oxox || $row['o_type3']==$ooxx || $row['o_type3']==$xoox || $row['o_type3']==$xoxo || $row['o_type3']==$xxoo || $row['o_type3']==$ooox || $row['o_type3']==$ooxo || $row['o_type3']==$oxoo || $row['o_type3']==$xooo || $row['o_type3']==$oooo) {
                $db->update("orders", "history_is_account=1,shuying_y=$shuying_y,is_win=1", "id={$row['id']}");
			}else{
				$db->update("orders", "history_is_account=1,shuying_y=$roworders_y", "id={$row['id']}");
			}
		}
		echo 2;
}
else if ( $history_is_lock == 0 )
{
		$db->update( "plate", "history_is_lock=1", "id={$id}" );
		echo 4;
}
else if ( $history_is_lock == 1 )
{
		$db->update( "plate", "history_is_lock=0", "id={$id}" );
		echo 3;
}
?>
