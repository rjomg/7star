<?php 

//做登陆验证
if (!session_id()) session_start();
header("Content-Type:text/html;charset=utf-8");
include_once ('../../global.php');

//验证码验证

$loginseccodeverify = $_POST['loginseccodeverify'];


if ($_SESSION['seccode'] != $loginseccodeverify) {
	echo json_encode(array('status'=>8001,'msg'=>"您输入的答案不正确"));
	die;
}




$db = new action($mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset); //数据库操作类.


if (empty($_POST['username'])) {
	echo json_encode(array('status'=>8001,'msg'=>"请输入用户名"));
}

if (empty($_POST['password'])) {
	echo json_encode(array('status'=>8001,'msg'=>"请输入密码"));
}


if(!empty($_POST['username'])&& !empty($_POST['password'])) {
	$msg = $db->Get_user_login($_POST['username'],$_POST['password'],$client_location['country']);
} 