<?php
include_once( "../../../global.php" );
include_once( "rate.class.php" );
$db = new rate0( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
$plate_num = "0";
$o_content = iconv( "utf-8", "gbk", $_POST['o_content'] );
$db->update_another_odd( $_POST['oid'], $plate_num, $o_content );
$db->update( "odds_set", "o_content='{$o_content}'", "o_id={$_POST['oid']} and user_id=0 and plate_num='{$plate_num}'" );
?>
