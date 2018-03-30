<?php
include_once( "../../global.php" );
$callback = "auto_pre.php";
$user_id = $_POST['user_id'];
$db = new action( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
foreach ( $_POST['o_typename'] as $i => $v )
{
		$sql = "update autorain_set set \r\n        autodesc_limit=".$_POST['autodesc_limit'][$i].",\r\n            desc_odds=".$_POST['desc_odds'][$i].",\r\n                lowest_odds=".$_POST['lowest_odds'][$i].",\r\n                    amode=".$_POST['amode'][$i].",\r\n                        is_use=".$_POST['is_use'][$i]."\r\n                             where  o_typename='".$v."'";
		$db->query( $sql );
}
$db->get_admin_msg( $callback, "保存操作成功！" );
?>
