<?php

include_once ('../global.php');

$db = new action($mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset); //数据库操作类.



 //如果用户名和密码都不为空 即条件为假 执行$db进行判断

 if(!empty($_POST[username])&& !empty($_POST[password])) $db->Get_user_login($_POST[username],$_POST[password],$client_location['country']);

?>

<!-- saved from url=(0037)http://6h.10010pk.com/686/l_login.jsp -->

 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
  <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
  <title>Login</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
  <link rel="shortcut icon" href="./images/favicon.ico" type="image/x-icon" /> 
  <link rel="stylesheet" type="text/css" id="css" href="css/user_admin_login.css">
  <link rel="stylesheet" type="text/css" id="css" href="css/logmsg.css">
  <script language="javascript" src="js/jquery.min.js"></script>
  <script language="javascript" src="js/base64.min.js"></script>
  <script language="javascript" src="js/jquery.md5.js"></script>
  <script language="javascript" src="js/jquery.jcryption.3.1.0.js"></script>
  <script language="javascript" src="js/loginfrm.js"></script>
  <script type="text/javascript">
  <!--

  function finalcheck(){
    if($("#login_admin").attr("disabled")=="disabled")return false;
    if(document.loginfrm.admin_username641580942.value==""){
      alert("Please fill out the account！");
      document.loginfrm.admin_username641580942.focus();
      return false;
    }else if(document.loginfrm.admin_password641580942.value==""){
      alert("Please fill in password！");
      document.loginfrm.admin_password641580942.focus();
      return false;
    }
    return onLogin("641580942",1);
  }
  function redirect(url) {window.location.replace(url);}
  function send(event){if(event.keyCode==13) {return finalcheck();}}
  if(self.parent.frames.length != 0) {self.parent.location=document.location;}
  //-->
  </SCRIPT> 
<script language="JavaScript">

    

    function CheckForm()

    {

        if(document.form1.username.value=="")

        {

            alert("请输入用户");

            return false;

        }

        if(document.form1.password.value=="")

        {

            alert("请输入密码");

            return false;

        }

        if(document.form1.code.value=="")

        {

            alert("请输入以验证码");

            return false;

        }else{

            var vmsg=2;

            $.ajax({

                type: "POST",

                url: "ajax/check_num.php",

                data: {'num':document.form1.code.value},

                async: false,

                success: function(msg){

                    vmsg=msg;

                }

            });

            

            if(vmsg==2){

                alert("验证码错误！");

                document.form1.code.value="";

                $("#yzm").attr("src","img/rand_num.php?nowtime"+new Date().getTime());

                return false;

            }

        }



        return true;

    }

 function newgdcode(obj,url) {

obj.src = url+ '?nowtime=' + new Date().getTime();

//后面传递一个随机参数，否则在IE7和火狐下，不刷新图片

}

 

</script>
  </head>
  <body topmargin="0" leftmargin="0" rightmargin="0" bottommargin="0" marginwidth="0" marginheight="0">
      <table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr ><td >
    
      <form name="form1" onSubmit="return CheckForm();" action="" method="post">
      <input name="login" type="hidden" id="login" value="AWBRPQNjBGEAOQ!888!888"><br><table align=center width="840" border="0" cellpadding="0" cellspacing="0" style="background:url('images/2_02.jpg') no-repeat;" background="">
  <tr>
    <td colspan="3" height="62">
  <table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="220"></td>
    <td width="40">AT:&nbsp;&nbsp;</td>
    <td width="120"><input name="username" type="username" id="username" style="width:100px; height:20px; background:#e9e6e6; font-size:12px; border:solid 1px #a0a0a0; color:#3b1b1b;" tabindex="1" value=""></td>
    <td width="40">PW:&nbsp;&nbsp;</td>
    <td width="120"><input name="password" type="password" id="password" style="width:100px; height:20px; background:#e9e6e6; font-size:12px; border:solid 1px #a0a0a0; color:#3b1b1b;" tabindex="2" value=""></td>
    <td height=30  width="*">&nbsp;&nbsp;
    <input class="btn" name="Submit" tabindex="4" onMouseOut="this.className=&#39;btn&#39" onMouseOver="this.className=&#39;btn_m&#39;" type="submit" value="登陆" />
       </td>
  </tr>
</table>
      </td>
  </tr>
  <tr>
    <td width="100%" height="1000" ></td>
  </tr>
</table>
</form>
<script type="text/javascript">setTimeout("document.loginfrm.admin_username641580942.focus();",200);</script>  </td></tr></table>
  </body>
  </html>