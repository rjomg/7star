<?php 
	include_once( "../global.php" );
	$db = new action( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
	$query = $db->select( "plate order by id desc", "*", "" );
	$uid = $_SESSION['uid'.$c_p_seesion];	
	$plate = $db->fetch_array( $query );
	$totalmoney=$db->get_one('select * from users where user_id='.$uid);
	$endtime=strtotime($plate['plate_time_end']);
	if (time()>=$endtime) {
		echo '<script>javascript:history.go(-1);alert("已经封盘了，请等下期");window.parent.parent.location.href="./main.php";</script>';exit;
	}
	if (empty($_POST['idarray'][1])) {
		$where='id = '.$_POST['idarray'][0];
	}else{
		$id=implode(',',$_POST['idarray']);
		$id=rtrim($id);
		$where='id in ('.$id.')';
	}
	$res=$db->get_update('orders',array('stattuima'=>1,'tuima_time'=>time()),$where);
	$add_credit=$db->get_all('select SUM(orders_y) as orders_y from orders where '.$where);
	$credit=$totalmoney['credit_remainder']+$add_credit[0]['orders_y'];
	if ($res) {
		$db->get_update('users',array('credit_remainder'=>$credit),'user_id ='.$uid);
		echo '<script>alert("退码成功");window.parent.parent.frames["menu"].location.reload();window.parent.location.reload();</script>';
	}else{
		echo '<script>alert("退码失败");</script>';
	}

?>