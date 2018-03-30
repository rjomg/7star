<?php 
include_once( "../../global.php" );
$db = new action( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
$uid = $_SESSION['uid'.$c_p_seesion];
$old_odd=$db->get_all('select o_id from oddsset_type where user_id='.$uid);
// var_dump($old_odd);exit;
$son_user=$db->get_all('select user_id from users where top_id='.$uid);
$son_id='';
foreach ($son_user as $key => $value) {
	$son_id.=$value['user_id'].',';
}
$son_id=rtrim($son_id,',');
if (empty($old_odd)) {
	foreach ($_POST['fixstr'] as $key => $value) {
		$fixstr=$db->get_one('select * from oddsset_type where o_id='.$key);
		unset($fixstr['o_id']);
		unset($fixstr['user_id']);
		unset($fixstr['o_ccupy_money']);
		unset($fixstr['o_content']);
		$fixstr['o_ccupy_money']=$value['o_ccupy_money'];
		$fixstr['user_id']=$uid;
		$db->get_insert('oddsset_type',$fixstr);
		echo '<script>javascript:history.go(-1);</script>';
	}
}
else{
	foreach ($_POST['fixstr'] as $key => $value) {
		$fixstr=$db->get_one('select * from oddsset_type where o_id='.$key);
		unset($fixstr['o_id']);
		unset($fixstr['user_id']);
		unset($fixstr['o_ccupy_money']);
		unset($fixstr['o_content']);
		$fixstr['o_ccupy_money']=$value['o_ccupy_money'];
		$fixstr['user_id']=$uid;
		$db->get_update('oddsset_type',$fixstr,'o_id='.$key);
		$db->get_update('tuishui_set',array('odds_id'=>$key),' typename="'.$fixstr['o_typename'].'" and user_id in ('.$son_id.')');
	}
	echo '<script>javascript:history.go(-1);</script>';
}
?>