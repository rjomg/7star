<?php
include_once( "../../global.php" );
$db = new rate( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
$y = $db->select( "plate", "plate_num", "1 order by plate_num desc limit 0,1" );
$z = $db->fetch_array( $y );
$plate_num = $z['plate_num'];
$sql = "DELETE FROM odds_set WHERE plate_num = '{$plate_num}';";
$query = "INSERT INTO odds_set SELECT {$_SESSION["uid".$c_p_seesion]},'{$plate_num}', o_id, `o_content` , `ab_content` FROM odds_set WHERE `plate_num` = '0'";
$db->query( $sql );
$db->query( $query );
$db->Get_admin_msg( "hymr.php" );
?>
