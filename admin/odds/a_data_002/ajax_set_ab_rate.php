<?php
include_once( "../../../global.php" );
include_once( "rate.class.php" );
$db = new rate0( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
$plate_num = "0";
$content = ",��:".$_POST['ma'].",˫��:".$_POST['sm'].",��ɫ:".$_POST['bs'].",";
$db->update( "odds_set", "ab_content='{$content}'", "o_id={$_POST['oid']} and user_id=0 and plate_num='{$plate_num}'" );
$db->update_another_odd( $_POST['oid'], $plate_num, "", $content );
echo 1;
?>
