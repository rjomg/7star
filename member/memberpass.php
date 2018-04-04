<?php
include_once ('../global.php');
$db = new plate($mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset); //Êý¾Ý¿â²Ù×÷Àà.
$uid = $_SESSION['uid'.$c_p_seesion];	
if($uid){
$info = mysql_fetch_array(mysql_query("select * from users  where user_id = '$uid'"));
}	
if($_POST['editsubmit']){
	$pass1 = $_POST['oldpassword'];
	$pass = md5($pass1);
	$password = $_POST['newpassword'];
	$password2 = $_POST['newpassword2'];
	$password = md5($password);
	if($pass == $info['user_pwd']){
		if ($_POST['newpassword']!==$_POST['newpassword2']) {
			echo " <script> alert( '两次输入的密码不一样') ; location.href= 'memberpass.php'; </script> " ;exit;
		}
		$query =  $db->query("UPDATE `users` SET `user_pwd`='$password' where user_id='$uid'");
		   if($query){
                        if($_GET['else_count_login']==1){
                        $query =  $db->query("UPDATE `users` SET else_count_login=1 where user_id='$uid'");    
                        echo " <script> alert( '修改成功,请退出重新登陆') ; location.href= 'top.php?action=logout'; </script> " ;
                        }else{
			echo " <script> alert( '修改失败') ; location.href= 'memberpass.php'; </script> " ;
                        }
		   }
	}else{
			echo " <script> alert( '原密码不正确') ; location.href= 'memberpass.php'; </script> " ;
	}
	

	
}


?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" type="text/css" id="css" href="./css/members.css">
<script src="./js/jquery-1.11.1.min.js"></script>
<style>html{overflow-y:scroll;}</style>

</head>
<body style="margin: 0px"  >


<table width="99%" border="0" cellpadding="0" cellspacing="0" align=center>
<tr>
<td style="padding:0px">
		<form id='form1' name='form1'  method="post" action="memberpass.php?else_count_login=1">
	<input type="hidden" name="formhash" value="b718f6b0">
	<table width="100%" border="0" cellpadding="0" cellspacing="0" class="left_b" >
	<tr class="header_left_b">
	<td colspan="2" >帐户修改密码 </td>
	<tr>
	<tr><td width="100">原密码:</td><td width="*"><input type="password" name="oldpassword" id="oldpassword" size="25" tabindex="1"/></td><tr>
	<tr><td>新密码:</td><td><input type="password" name="newpassword" id="newpassword" size="25" tabindex="2"/><font style="font-size:18px;font-weight: bold;" color="red">新密码不能跟账号和原密码相同。</font></td><tr>
	<tr><td>确认新密码:</td><td><input type="password" name="newpassword2" id="newpassword2" size="25"  tabindex="3"/><font style="font-size:18px;font-weight: bold;" color="red">必须是数字和字母组合，至少6位以上。 </font></td><tr>
	<tr>
	<td align="right" class="altbg2" colspan="2"><font style="font-size:14px;font-weight: bold;" color="#0000FF">系统禁止不可用密码:		a12345		，ab1234		，abc123		，a1b2c3		，aaa111		，123qwe</font>
</td></tr>
	</table>
	<BR>
	<CENTER><button type="submit" class="btn_tuima" name="editsubmit" id="editsubmit" value="true">提交</button>
	</CENTER>		
	</form>
	<script>
	setTimeout("document.form1.oldpassword.focus(); ",200);
	</script>
	<BR>
	</td>
<tr>
</table>
<script>
	$('#editsubmit').click(function(){
		if ($('#oldpassword').val()=='') {
			alert('原密码不能为空');$('#oldpassword').focus();return false;
		};
		if ($('#newpassword').val()=='') {
			alert('新密码不能为空');$('#newpassword').focus();return false;
		};
		if ($('#newpassword2').val()=='') {
			alert('请输入确认密码');$('#newpassword2').focus();return false;
		};
		if ($('#newpassword').val()=='a12345' || $('#newpassword').val()=='ab1234' || $('#newpassword').val()=='abc123' || $('#newpassword').val()=='a1b2c3' || $('#newpassword').val()=='aaa111' || $('#newpassword').val()=='123qwe') {
			alert('此密码为禁用密码');$('#newpassword').focus();return false;
		};
	})
</script>
</body>
</html>