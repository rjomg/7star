<?php
include_once ('../global.php');
$db = new action($mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset); //数据库操作类.

 //如果用户名和密码都不为空 即条件为假 执行$db进行判断
 if(!empty($_POST[username])&& !empty($_POST[password])) $db->Get_user_login($_POST[username],$_POST[password],$client_location['country']);
?>
<!-- saved from url=(0037)http://6h.10010pk.com/686/l_login.jsp -->
<html oncontextmenu="return false">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=GBK">
        <script type="text/javascript" src="js/jquery-1.4.3.min.js"></script>

<style type="text/css">
<!--
    body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #226DC7;
	overflow:hidden;
	background-image: url(images/user_all_bg.gif);
	background-repeat: repeat-x;
    }
    .Fone_Color {font-size: 12px; color: #adc9d9; }
    .btn, .btn_m
    {
        width: 49px;
        height: 18px;
        border: 0px solid #FF9224;
        background-color: #FFFFFF;
        background-image: url( 'images/dl.gif');
        cursor: hand background-position:0px 0;
    }
    .btn
    {
        background-position: 0px 0;
    }
    .btn_m
    {
		cursor: hand;
        background-position: -49px 0;
    }
	 <STYLE>
.input1 {
	BORDER-RIGHT: #b6b6b6 1px solid; BORDER-TOP: #b6b6b6 1px solid; MARGIN-LEFT: 15px; BORDER-LEFT: #b6b6b6 1px solid; BORDER-BOTTOM: #b6b6b6 1px solid
}
.btn1_mouseout {
	BORDER-RIGHT: 0px; BORDER-TOP: 0px; FONT-SIZE: 14px; BACKGROUND: url(images/user_botton.gif); BORDER-LEFT: 0px; WIDTH: 82px; CURSOR: hand; COLOR: #ffffff; BORDER-BOTTOM: 0px; HEIGHT: 32px
}

.TxtUserNameCssClass {
	BORDER-TOP-WIDTH: 0px; PADDING-LEFT: 25px; BORDER-LEFT-WIDTH: 0px; BACKGROUND: url(images/user_login_name.gif) no-repeat; BORDER-BOTTOM-WIDTH: 0px; WIDTH: 165px; LINE-HEIGHT: 20px; HEIGHT: 21px; BORDER-RIGHT-WIDTH: 0px
}
.TxtPasswordCssClass {
	BORDER-TOP-WIDTH: 0px; PADDING-LEFT: 25px; BORDER-LEFT-WIDTH: 0px; BACKGROUND: url(images/user_login_password.gif) no-repeat; BORDER-BOTTOM-WIDTH: 0px; WIDTH: 165px; LINE-HEIGHT: 20px; HEIGHT: 21px; BORDER-RIGHT-WIDTH: 0px
}
.TxtCVCssClass {
	BORDER-TOP-WIDTH: 0px; PADDING-LEFT: 25px; BORDER-LEFT-WIDTH: 0px; BACKGROUND: url(images/CodeVali.gif) no-repeat; BORDER-BOTTOM-WIDTH: 0px; WIDTH: 100px; LINE-HEIGHT: 20px; HEIGHT: 21px; BORDER-RIGHT-WIDTH: 0px
}
</style>
<title><?php echo $system_setting['w_name'];?></title></head>
<body>
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
<script type="text/javascript">
//if (top.location == self.location) top.location.href = "/"; 
</script>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<form name="form1" onsubmit="return CheckForm();" action="" method="post">
<table align="center" border="0" cellpadding="0" cellspacing="0" width="100">
<tbody><tr>
    <td><img alt="" src="images/user_top_l.gif" height="116" width="129"></td>
    <td><img alt="" src="images/user_top_c.gif" height="116" width="280"></td>
    <td><img alt="" src="images/user_top_r.gif" height="116" width="180"></td>
  </tr>
  <tr>
    <td background="images/user_main_l.gif" height="139">&nbsp;</td>
    <td background="images/user_main_c.gif" width="280"><table style="margin-top: 5px;" border="0" cellpadding="1" cellspacing="1" width="78%">
      <tbody>
        <tr height="35">
          <td style="font-size: 13px; color: rgb(102, 102, 102); padding-top: 5px;" align="right" width="54">帐&nbsp;&nbsp;&nbsp;&nbsp;号</td>
          <td><input class="TxtUserNameCssClass" tabindex="1" name="username"  id="username">          </td>
        </tr>
        <tr height="35">
          <td style="font-size: 13px; color: rgb(102, 102, 102);" align="right">密&nbsp;&nbsp;&nbsp;&nbsp;码</td>
          <td><input  class="TxtPasswordCssClass" tabindex="2"  name="password" type="password" id="password">          </td>
        </tr>
        <tr height="20">
          <td style="font-size: 13px; color: rgb(102, 102, 102);" align="right">验&nbsp;证&nbsp;码</td>
          <td width="10"><table border="0" cellpadding="0" cellspacing="0" width="99%">
              <tbody><tr>
                <td><input class="TxtCVCssClass" name="code" id="code" tabindex="2" size="10" type="text"></td>
                <td><span class="STYLE1"><img id="yzm" src="img/rand_num.php" alt="看不清楚，換一張" align="absmiddle" style="cursor: pointer;" onclick="javascript:newgdcode(this,this.src);"></span></td>
              </tr><div id="back2top" class="back2top" style="display: block;"><a href="../" title="返回入口"></a></div>
            </tbody></table><input name="login" id="login" value="WjtTPwJiUTQHPg!888!888" type="hidden"></td>
          </tr>
        <tr height="30">
          <td colspan="2" align="center"></td>
        </tr>
      </tbody>
    </table></td>
    <td background="images/user_main_r.gif"><input name="Submit" style="border-width: 0px;" src="images/user_botton.gif" type="image"></td>
  </tr>
  <tr>
    <td valign="top"><img src="images/user_bottom_l.gif" height="117" width="129"></td>
    <td background="images/user_bottom_c.gif" valign="top">&nbsp;</td>
    <td valign="top"><img src="images/user_bottom_r.gif" height="117" width="180"></td>
  </tr>
</tbody></table>    
<style>
.back2top {width:58px;height:58px;position:fixed;_position:absolute;left:50%;margin-left:300px;bottom:45%;_bottom:auto;cursor:pointer;display:none;}
.back2top a {display:block;width:100%;height:100%;background:url('../images/back2top.png') no-repeat;}
.back2top a:hover {background:url('../images/back2top.png') no-repeat -58px 0;}
</style>
</form>
</body></html>