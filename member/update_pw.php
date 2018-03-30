<?php
include_once ('../global.php');
$db = new plate($mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset); //数据库操作类.
$uid = $_SESSION['uid'.$c_p_seesion];	
if($uid){
$info = mysql_fetch_array(mysql_query("select * from users  where user_id = '$uid'"));
}	
if($_POST['Submit']){
	$pass1 = $_POST['pass'];
	$pass = md5($pass1);
	$password = $_POST['pass2'];
	$password = md5($password);
	if($pass == $info['user_pwd']){
		
		$query =  $db->query("UPDATE `users` SET `user_pwd`='$password' where user_id='$uid'");
		   if($query){
                        if($_GET['else_count_login']==1){
                        $query =  $db->query("UPDATE `users` SET else_count_login=1 where user_id='$uid'");    
                        echo " <script> alert( '修改成功,请重新登录。 ') ; location.href= 'index.php'; </script> " ;
                        }else{
			echo " <script> alert( '修改成功。 ') ; location.href= 'update_pw.php'; </script> " ;
                        }
		   }
	}else{
			echo " <script> alert( '原密码错误。 ') ; location.href= 'update_pw.php'; </script> " ;
	}
	

	
}


?>
<html oncontextmenu="return false" xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk">
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
-->
</style>
</head>
<body oncontextmenu="return false" onselect="document.selection.empty()" oncopy="document.selection.empty()" onmouseover="self.status='歡迎光臨';return true">
<script language="JAVASCRIPT">
if(self == top) {location = '/';} 
if(window.location.host!=top.location.host){top.location=window.location;}
function SubChk()
{
	var pass=document.all.pass.value;
	var pass2=document.all.pass2.value;
	var pass3=document.all.pass3.value;
	
	if(pass==''){
		alert("请输入原密码~");
		document.all.pass.focus();
		return false;
		
	}
	if(pass2==''){
		alert("请输入新密码~");
		document.all.pass2.focus();
		return false;
		
	}if(pass3 != pass2){
		alert("新密码与确认密码不符~");
		document.all.pass3.focus();
		return false;
	}
	
//	C_Key();
	//alert(pass+pass2+pass3);
	
//document.getElementById('Submit').disabled = true;	
} 

</script>

<link rel="stylesheet" href="images/Index.css" type="text/css">
<style type="text/css">
<!--
.style1 {
	color: #666666;
	font-weight: bold;
}
.style2 {color: #FF0000}
.STYLE4 {
	color: #000000;
	font-weight: bold;
}
-->
</style>
 

 <table class="Ball_List Tab" border="0" cellpadding="1" cellspacing="1" width="740">
<form name="testFrm" method="post" action=""  onsubmit="return SubChk()">
   <tbody><tr class="td_caption_1">
     <td colspan="2" bordercolor="#CCCCCC" align="center" bgcolor="#DFEFFF" height="22"><span class="STYLE4">變更密码</span></td>
  </tr>
   <tr>
    <td bordercolor="#CCCCCC" align="right" bgcolor="#DFEFFF" height="30" width="17%">原密码：</td>
    <td bordercolor="#CCCCCC" bgcolor="#FFFFFF" width="83%"><input name="pass" id="pass" class="input1" type="password"></td>
  </tr>
  <tr>
    <td bordercolor="#CCCCCC" align="right" bgcolor="#DFEFFF" height="30">新密码：</td>
    <td bordercolor="#CCCCCC" bgcolor="#FFFFFF"><input name="pass2" id="pass2" class="input1" type="password"></td>
  </tr>
  <tr>
    <td bordercolor="#CCCCCC" align="right" bgcolor="#DFEFFF" height="30">確認密码：</td>
    <td bordercolor="#CCCCCC" bgcolor="#FFFFFF"><input name="pass3" id="pass3" class="input1" type="password"></td>
  </tr>
  
</tbody></table>
 <table border="0" cellpadding="0" cellspacing="0" width="740">
   <tbody><tr>
     <td align="center" height="50"><input name="Submit" class="btn2" onmouseout="this.className='btn2'" onmouseover="this.className='btn2m'" id="btnSubmit" value="确定修改" type="submit"></td>
   </tr> 
 </tbody>
 </form>
 </table>

</body></html>