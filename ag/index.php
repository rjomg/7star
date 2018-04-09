<?php
include_once ('../global.php');
//$db = new action($mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset); //数据库操作类.
//session_unset();
//session_destroy();
 //如果用户名和密码都不为空 即条件为假 执行$db进行判断
// if(!empty($_POST[username])&& !empty($_POST[password])) $db->Get_user_login($_POST[username],$_POST[password],$client_location['country']);
?>

<!-- saved from url=(0037)http://6h.10010pk.com/686/l_login.jsp -->

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
  <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
  <title>分公司-代理</title>
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
        <style type="text/css">

            #showwapmsg{
                z-index: 1000;
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
            }
            a{color:#0088cc;text-decoration:none;font-weight: normal;font-size: 20px;vertical-align:middle;}
            .bgdivright {float: right; cursor:pointer;vertical-align:middle;}
            .bgdivleft {margin-right:20px;}
            .bgdivmain {
                position: absolute;
                top: 0px;
                left: 0px;
                width: 100%;
                height: 100%;
                text-align: center;
                margin: 0px;
                padding: 0px;
                display:none;
                color:#555666;
            }
            .bgdiv{
                position: absolute;
                zoom: 1;
                filter: alpha(opacity=50);
                zoom: 1;
                display: inline-block;
                top: 0px;
                left: 0px;
                width: 100%;
                height: 100%;
                background-color: #e0e8e0;
                opacity: 0.75;
            }
            .bgdivdx{
                background: #fff;
                z-index: 999;
                padding: 4px;
                width: 300px;
                height: 210px;
                top: 0;
                bottom: 0;
                left: 0;
                right: 0;
                left: 50%;
                top: 50%;

                -webkit-border-radius: 3px;
                -moz-border-radius: 3px;
                border-radius: 3px;

                -webkit-box-shadow: 5px 5px 2px #888888;
                -moz-box-shadow: 5px 5px 2px #888888; /* 老的 Firefox */
                box-shadow: 5px 5px 2px #888888;
                border: 1px solid #555666;


                margin-left: -150px!important;
                margin-top: -60px!important;
                margin-top: 0px;

                position: fixed!important;
                position: absolute;
                _top: expression(eval(document.compatMode &&
        document.compatMode=="CSS1Compat") ?
        documentElement.scrollTop + (document.documentElement.clientHeight-this.offsetHeight)/2 :/*IE6*/
        document.body.scrollTop + (document.body.clientHeight - this.clientHeight)/2);
            }
            .bgdivdx input{font-size: 14px;vertical-align:middle;}
            .bgdivdx img{vertical-align:middle;}
            #seccodelogin{padding: 4px 8px;font-size: 18px;}
            .bgdivdxtit{
                width: 100%;
                font-size: 22px;
                border-bottom: 1px solid #555666;
                height:25px;
                margin-bottom:7px;
                font-weight:bold;
            }
            .clear{ clear:both}
            .bgdivdx ul{    padding: 0;margin: 4px 8px;}
            .bgdivdx li{display:inline-block;*display:inline;*zoom:1;padding:0;margin-left:4px;list-style:none;white-space:nowrap;}
            .mainkey{
                width:100%;position:relative;
            }
            #mainkey td{
                background-color:#54206c;
                color:#d4acf4;
                text-align:center;
                width:16.6%;
                line-height:35px;height:35px;cursor:pointer; font-size: 18px;font-weight: bold;
                -webkit-touch-callout:none;
            }

            #seccodeverify{-webkit-touch-callout:none;cursor:pointer;}
        </style>
        <style type="text/css">
            #routeList li a {
                color:blue;
                font-size:14px;
                font-weight:0;
                text-decoration:underline;
            }
            #contain{
                width:400px;
                margin:0 auto;
                overflow: hidden;
            }

            ul,li{
                padding:0;
                margin:0;
            }
            li span {
                color:#000;
                font-size:14px;
                font-weight:normal !important;
            }
        </style>
        <link rel="stylesheet" type="text/css" id="css" href="./css/logmsg.css">
        <script type="text/javascript">
            var login_but="";
            login_but="#seccodelogin";$(window).load(function(){
                seccodeWin.int("810386097",1);
            });
        </script>
        <script language="javascript" src="/member/js/applogincg.min.js"></script>
        <script type="text/javascript">

            function finalcheck(){
                if($(login_but).attr("disabled")=="disabled")return false;
                if(document.loginfrm.admin_username810386097.value==""){
                    alert("Please fill out the account！");
                    document.loginfrm.admin_username810386097.focus();
                    return false;
                }else if(document.loginfrm.admin_password810386097.value==""){
                    alert("Please fill in password！");
                    document.loginfrm.admin_password810386097.focus();
                    return false;
                }
                return seccodeWin.show();
            }
            function redirect(url) {window.location.replace(url);}
            function send(event){if(event.keyCode==13) {return finalcheck();}}
            if(self.parent.frames.length != 0) {self.parent.location=document.location;}

        </script>
  </head>
  <body topmargin="0" leftmargin="0" rightmargin="0" bottommargin="0" marginwidth="0" marginheight="0">
<!--      <table width="100%" border="0" cellpadding="0" cellspacing="0">-->
<!--  <tr ><td >-->
<!--    -->
<!--      <form name="form1" onSubmit="return CheckForm();" action="" method="post">-->
<!--      <input name="login" type="hidden" id="login" value="AWBRPQNjBGEAOQ!888!888"><br><table align=center width="840" border="0" cellpadding="0" cellspacing="0" style="background:url('images/2_02.jpg') no-repeat;" background="">-->
<!--  <tr>-->
<!--    <td colspan="3" height="62">-->
<!--  <table width="100%" border="0" cellpadding="0" cellspacing="0">-->
<!--  <tr>-->
<!--    <td width="220"></td>-->
<!--    <td width="40">AT:&nbsp;&nbsp;</td>-->
<!--    <td width="120"><input name="username" type="username" id="username" style="width:100px; height:20px; background:#e9e6e6; font-size:12px; border:solid 1px #a0a0a0; color:#3b1b1b;" tabindex="1" value=""></td>-->
<!--    <td width="40">PW:&nbsp;&nbsp;</td>-->
<!--    <td width="120"><input name="password" type="password" id="password" style="width:100px; height:20px; background:#e9e6e6; font-size:12px; border:solid 1px #a0a0a0; color:#3b1b1b;" tabindex="2" value=""></td>-->
<!--    <td height=30  width="*">&nbsp;&nbsp;-->
<!--    <input class="btn" name="Submit" tabindex="4" onMouseOut="this.className=&#39;btn&#39" onMouseOver="this.className=&#39;btn_m&#39;" type="submit" value="登陆" />-->
<!--       </td>-->
<!--  </tr>-->
<!--</table>-->
<!--      </td>-->
<!--  </tr>-->
<!--  <tr>-->
<!--    <td width="100%" height="607" ></td>-->
<!--  </tr>-->
<!--</table>-->
<!--</form>-->
<div>
    <div class="bgdivmain" style="display: none;">
        <div class="bgdiv"></div>
        <div class="bgdivdx">
            <div class="bgdivdxtit"><div class="bgdivright" id="loginx">X</div><div class="bgdivleft">请回答</div></div><div class="clear"></div>
            <ul>
                <li><span id="seccodeimage" title="看不清楚，请点击"><img id="seccode" onclick="updateseccode()" width="90" height="45" src="./seccode.php" align="absmiddle" alt=""></span></li>
                <li>= <input type="text" onfocus="this.onfocus = null" id="seccodeverify" name="seccodeverify" maxlength="4" style="width: 90px;height: 40px;line-height: 39px;font-size: 29px;vertical-align:middle;border: solid 1px #a0a0a0;" readonly="readonly"></li>
                <li><a href="http://8a.1380000138.com/?bmwid=1####" onclick="JavaScript:updateseccode();return false;">换题</a>
                    <script type="text/javascript">var seccodedata = [90, 45, 4];</script>
                </li>
            </ul>
            <ul>
                <li class="mainkey">
                    <table id="mainkey" class="mainkey" cellpadding="2" cellspacing="0" align="center" border="2" bordercolor="#FFFFFF">
                        <tbody>
                        <tr>
                            <td>1</td><td>2</td><td>0</td><td>3</td><td>7</td>
                        </tr>
                        <tr>
                            <td>4</td><td>8</td><td>5</td><td>6</td><td>9</td>
                        </tr>
                        </tbody><tbody>
                        </tbody></table>
                </li>
            </ul>
            <ul>
                <li><input type="button" id="seccodelogin" name="seccodelogin" value=" login"></li>
            </ul>
        </div>
    </div>
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tbody><tr><td>

                <form method="post" id="loginfrm" name="loginfrm"><input type="hidden" id="sid" name="sid" value="r0GboE"><input type="hidden" name="loginaction" value="1">
                    <input type="hidden" name="Hrand" value="810386097"><br><table align="center" width="928" border="0" cellpadding="0" cellspacing="0">
                        <tbody>
                        <tr>
                            <td colspan="3" height="78" background="./images/1_01.gif">
                                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                    <tbody>
                                    <tr>
                                        <td width="290"></td>
                                        <td width="40" style="font-weight:bold;">AT:&nbsp;&nbsp;</td>
                                        <td width="120"><input type="text" id="admin_username810386097" name="admin_username810386097" onkeypress="send(event)" value="" style="width:100px; height:20px; background:#e9e6e6; font-size:12px; border:solid 1px #a0a0a0; color:#3b1b1b;"></td>
                                        <td width="40" style="font-weight:bold;">PW:&nbsp;&nbsp;</td>
                                        <td width="120"><input type="password" id="admin_password810386097" onkeypress="send(event)" name="admin_password810386097" style="width:100px; height:20px; background:#e9e6e6; font-size:12px; border:solid 1px #a0a0a0; color:#3b1b1b;"></td>
                                        <td height="30" width="*">&nbsp;&nbsp;
                                            <input type="button" id="login_admin" name="login_admin" onclick="return finalcheck();" value=" login" class="login_a_input">
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td background="./images/1_02.gif" width="309" height="212"></td>
                            <td background="./images/1_03.gif" width="310"></td>
                            <td background="./images/1_04.gif" width="309"></td>
                        </tr>
                        <tr>
                            <td background="./images/1_05.gif" height="145"></td>
                            <td background="./images/1_06.gif"></td>
                            <td background="./images/1_07.gif"></td>
                        </tr>
                        <tr>
                            <td background="./images/1_08.gif" height="145"></td>
                            <td background="./images/1_09.gif"></td>
                            <td background="./images/1_10.gif"></td>
                        </tr>
                        </tbody>
                </form>
    </table>
</div>
<script type="text/javascript">setTimeout("document.loginfrm.admin_username810386097.focus();",200);</script>	</td></tr></tbody></table>
  </body>
  </html>