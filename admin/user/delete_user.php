<?php
include_once( "../../global.php" );
$id = $_GET['id'];
$power = $_GET['power'];
if (empty($_GET['top_id'])) {
	$_GET['top_id']=1;
}
$callback = "branch.php?power=".$power.'&top_uid='.$_GET['top_id'];
if ( $_GET['ty'] )
{
		$callback = "son_user.php?power=".$power."&user_id=".$_GET['ty'];
}
$db = new action( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
if ($_GET['is_del']=='1') {
	$users=$db->get_one('select credit_total from users where user_id='.$id);
	$top_users=$db->get_one('select credit_remainder from users where user_id='.$_GET['top_id']);
	$top_credit=number_format($top_users['credit_remainder']+$users['credit_total'], 0, '', '');
	$db->get_update('users',array('is_del'=>1),' user_id='.$id);
	$db->get_update('users',array('credit_remainder'=>$top_credit),' user_id='.$_GET['top_id']);
}else{	
	$db->delete_users( $id );
}
$db->get_admin_msg( $callback );
?>
