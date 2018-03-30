<?php
include_once( "../../global.php" );
$db = new rate( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
$y = $db->select( "plate", "plate_num", "1 order by plate_num desc limit 0,1" );
$z = $db->fetch_array( $y );
$plate_num = $z['plate_num'];
$content = ",Âë:".$_POST['ma'].",Ë«Ãæ:".$_POST['sm'].",²¨É«:".$_POST['bs'].",";
$db->update( "odds_set", "ab_content='{$content}'", "o_id={$_POST['oid']} and user_id={$_SESSION["uid".$c_p_seesion]} and plate_num='{$plate_num}'" );
$db->update_another_odd( $_POST['oid'], $plate_num, $_SESSION["uid".$c_p_seesion], "", $content );
echo 1;
?>
