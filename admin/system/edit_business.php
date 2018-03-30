<?php 
include_once( "../../global.php" );
$db = new mysql( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
$uid=$_SESSION["uid".$c_p_seesion];
$new_plate=$db->get_one('select plate_num from plate order by id DESC');
$plate_num=$new_plate['plate_num'];

if ($_GET['act']=='del_type') {
	$url='edit_business.php?o_typename='.$_POST['o_typename'];
	if ($_POST['id']) {	
		$db->delete('orders_type',' id='.$_POST["id"]);
		$db->delete('cut_code',' type_id='.$_POST['id']);
		echo '1';
	}elseif ($_POST['cut_type'] && $_POST['type_id'] && $_POST['cut_num']) {
		$db->delete('cut_code',' type_id='.$_POST['type_id'].' and cut_type="'.$_POST['cut_type'].'" and cut_num='.$_POST['cut_num']);
		echo '1';
	}
}

// 百分比切码
if ($_GET['act']=='minus_bfb') {
	if ($_POST['data']!=='') {
		$data=rtrim($_POST['data'],',');
		$data=explode(',',$data);
		$last_type=$db->get_one('select cut_num from cut_code where type_id='.$_POST['id'].' and cut_type="百分比" order by cut_num DESC limit 1');
		if ($last_type) {
			$cut_num=$last_type['cut_num']+1;
		}else{
			$cut_num=1;
		}
		foreach ($data as $key => $value) {
			$data[$key]=explode(':',$value);
			$cut['number']=$data[$key][0];
			$cut['money']=$data[$key][1];
			$cut['type_id']=$_POST['id'];
			$cut['cut_type']='百分比';
			$cut['cut_num']=$cut_num;
			$res=$db->get_insert('cut_code',$cut);
		}
		if ($res) {
			echo '1';
		}else{
			echo '2';
		}
	}else{
		echo '3';
	}
}

// 导出txt
if ($_GET['act']=='down_txt') {
	$txt='';
	$filename=$_GET['cut_type'].'('.$_GET['cut_num'].').txt';
	$cut_code=$db->get_all('select * from cut_code where type_id='.$_GET['type_id'].' and cut_type="'.$_GET['cut_type'].'" and cut_num='.$_GET['cut_num']);
	foreach ($cut_code as $key => $value) {
		$txt .=$value['number'].'='.$value['money'].',';
	}
	header('Content-Type:text/plain');
	Header( "Accept-Ranges:   bytes "); 
	header( "Content-Disposition:   attachment;   filename=".$filename); 
	header( "Expires:   0 "); 
	header( "Cache-Control:   must-revalidate,   post-check=0,   pre-check=0 "); 
	header( "Pragma:   public "); 
	ob_end_clean();
	echo $txt;exit;
}

// 禁止割码操作
if ($_GET['act']=='ban') {
	if ($_POST['is_q']=='正常割') {
		unset($_POST['is_q']);
		$res=$db->get_insert('cut_off',$_POST);
		if ($res) {
			echo json_encode(array('res'=>'禁止割'));
		}else{
			echo json_encode(array('res'=>'正常割'));
		}
	}
	if ($_POST['is_q']=='禁止割') {
		$db->delete('cut_off',' typename="'.$_POST['typename'].'" and type="'.$_POST['type'].'"');
		echo json_encode(array('res'=>'正常割'));
	}
	// var_dump($_POST);exit;
}

// 禁止割码组数
if ($_GET['act']=='ban_p') {
	$off_one=$db->get_one('select * from cut_off where typename="'.$_POST['typename'].'" and type=""');
	if ($off_one) {
		$res=$db->get_update('cut_off',array('off_p'=>$_POST['num']),' type="" and typename="'.$_POST['typename'].'"');
	}
	if (empty($off_one)) {
		$res=$db->get_insert('cut_off',array('off_p'=>$_POST['num'],'typename'=>$_POST['typename']));
	}
	// var_dump($off_one);exit;
}
?>