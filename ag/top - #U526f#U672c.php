<?php
include_once ('../global.php');
$db = new action($mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset); //鏁版嵁搴撴搷浣滅被.

if($_SESSION['uid'.$c_p_seesion]>0){
$queryusers=  $db->select("users", "is_odds,is_add,is_extend", "user_id={$_SESSION['uid'.$c_p_seesion]}");
$user = $db->fetch_array($queryusers);
}
$username = $_SESSION['username'.$c_p_seesion];
if($_GET[action]=='logout')$db->Get_user_out($client_location['country']);//濡傛灉涓虹湡 閭ｄ箞閫€鍑?
?>
<html oncontextmenu="return false" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
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
<link href="images/Top.css" rel="stylesheet" type="text/css">
<script>
if(self == top) {location = '/';} 
if(window.location.host!=top.location.host){top.location=window.location;}</script></head>

<body style="background:url(images/top_right.jpg) repeat-x 0 0 ;"  onselect="document.selection.empty()" oncopy="document.selection.empty()" onmouseover="self.status='姝¤繋鍏夎嚚';return true">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="images/Index.css" rel="stylesheet" type="text/css">
<link href="images/Top.css" rel="stylesheet" type="text/css">
<SCRIPT LANGUAGE="JavaScript">
<!-- 
     function ResumeError() {
     return true;
}
window.onerror = ResumeError;
// -->
</SCRIPT>
<script type="text/javascript" src="images/For.js">
</script><script src="images/Top.js" type="text/javascript"></script>
<script type="text/javascript">
var UP_mXZ="1";
var UP_OC="A";
var UP_uniteB="";
function Load_Bet(T) {
    //var t_url="RT_Sum_" + s_LT + ".aspx";
	
	var time_mXZ="1";
	var time_OC="A";
	var time_SC="no";
    
	var time_AU="30";
	
	var time_uniteB="";
    try {
        if (parent.content.document.getElementById('money_XZ')) {
	        time_mXZ=parent.content.document.getElementById('money_XZ').value;
	        time_OC=parent.content.document.getElementById('OpenCheck').value;
	        if (parent.content.document.getElementById('showCount').checked == true) time_SC="yes";
	        time_AU=parent.content.document.getElementById('AutoUpdate').value;
	        if (parent.content.document.getElementById('uniteB').checked == true) time_uniteB="1";
	    }
    } catch (e){}
    
    if (UP_mXZ!=time_mXZ || UP_OC!=time_OC || UP_uniteB!=time_uniteB) Clase_CacheBet();
    
    if (CacheBet[Number(T)] == undefined) {
        Limit_URL(t_url + "&Lottery_Type=" + s_LT + "&mXZ=" + time_mXZ + "&OC=" + time_OC + "&SC=" + time_SC + "&AU=" + time_AU + "&uniteB=" + time_uniteB + "&T=" + T);
    } else {
        Limit_URL(t_url + "&Lottery_Type=" + s_LT + "&mXZ=" + time_mXZ + "&OC=" + time_OC + "&SC=" + time_SC + "&AU=" + time_AU + "&uniteB=" + time_uniteB + "&C=1&T=" + T);
    }
    UP_mXZ=time_mXZ;
    UP_OC=time_OC;
    UP_uniteB=time_uniteB;
}

mBut_1_1[18]=new Array("鐩ｆ帶娴佹按璩崟","Limit_URL('immediate/jklszd.php?spul=18');");
mBut_1_1[19]=new Array("灏庡嚭鏁版摎","Limit_URL('immediate/output.php?spul=19');");
mBut_1_1[20]=new Array("璩崟","Limit_URL('immediate/zd.php?spul=20');");

 <?php if($_SESSION['user_power'.$c_p_seesion]==2) { //鍒嗗叕鍙镐互涓婃潈闄?>
    mBut_1_2[1]=new Array("鑲℃澅","Limit_URL('user/branch1.php?power=3&spul=37');");
<?php }?>   
<?php if($_SESSION['user_power'.$c_p_seesion]<2) { //鍒嗗叕鍙镐互涓婃潈闄?>
    mBut_1_2[1]=new Array("鑲℃澅","Limit_URL('user/branch.php?power=3&spul=37');");
<?php }?>
     <?php if($_SESSION['user_power'.$c_p_seesion]==3) { //鑲′笢浠ヤ笂鏉冮檺?>
mBut_1_2[2]=new Array("绺戒唬鐞?,"Limit_URL('user/branch1.php?power=4&spul=38');");
<?php }?>
    <?php if($_SESSION['user_power'.$c_p_seesion]<3) { //鑲′笢浠ヤ笂鏉冮檺?>
mBut_1_2[2]=new Array("绺戒唬鐞?,"Limit_URL('user/branch.php?power=4&spul=38');");
<?php }?>
 <?php if($_SESSION['user_power'.$c_p_seesion]==4) { //鎬讳唬鐞嗕互涓婃潈闄?>
    mBut_1_2[3]=new Array("浠ｇ悊","Limit_URL('user/branch1.php?power=5&spul=39');");
<?php }?>   
<?php if($_SESSION['user_power'.$c_p_seesion]<4) { //鎬讳唬鐞嗕互涓婃潈闄?>
    mBut_1_2[3]=new Array("浠ｇ悊","Limit_URL('user/branch.php?power=5&spul=39');");
<?php }?>
    <?php if($_SESSION['user_power'.$c_p_seesion]==5) { //浠ｇ悊浠ヤ笂鏉冮檺?>
    mBut_1_2[4]=new Array("鏈冨摗","Limit_URL('user/branch1.php?power=6&spul=40');");
    mBut_1_2[5]=new Array("瀛愯处鎴?,"Limit_URL('user/son_user.php?user_id=<?php echo $_SESSION['uid'.$c_p_seesion];?>&user_name=<?php echo $_SESSION['username'.$c_p_seesion];?>');");
<?php }?>
<?php if($_SESSION['user_power'.$c_p_seesion]<5) { //浠ｇ悊浠ヤ笂鏉冮檺?>
    mBut_1_2[4]=new Array("鏈冨摗","Limit_URL('user/branch.php?power=6&spul=40');");
    mBut_1_2[5]=new Array("瀛愯处鎴?,"Limit_URL('user/son_user.php?user_id=<?php echo $_SESSION['uid'.$c_p_seesion];?>&user_name=<?php echo $_SESSION['username'.$c_p_seesion];?>');");
<?php }?>
    
<?php if($_SESSION['user_power'.$c_p_seesion]==1) {?>
mBut_1_2[5]=new Array("璺ㄧ珯璧伴璐﹀彿绠＄悊","Limit_URL('user/branch.php?power=6&spul=41');");
<?php }?>
//mBut_1_2[6]=new Array("淇敼瀵嗙爜","Limit_URL('user/updatepass.php');");



mBut_1_3[0]=new Array("淇＄敤璩囨枡","Limit_URL('user/cd_infor.php?spul=64');");
mBut_1_3[1]=new Array("鐧婚櫢鏃ヨ獙","Limit_URL('user/login_log.php?spul=65');");
mBut_1_3[2]=new Array("璁婃洿瀵嗙爜","Limit_URL('user/change_pw.php?spul=42');");
<?php if(empty($user['is_add']) && $zizhanghaodenglu[2]==0){?>
mBut_1_3[3]=new Array("鑷嫊瑁滆波瑷畾","Limit_URL('user/auto_add.php?spul=66');");
mBut_1_3[4]=new Array("鑷嫊瑁滆波璁婃洿瑷橀寗","Limit_URL('user/auto_change.php?spul=67');");
<?php }?>

mBut_1_4[0]=new Array("鐩ゅ彛绠＄悊","Limit_URL('plate/tab.php?spul=43');");
mBut_1_4[1]=new Array("姝峰彶闁嬬崕","Limit_URL('plate/his.php?spul=44');");
mBut_1_4[2]=new Array("灏庡嚭鏁版摎","Limit_URL('output.php?spul=45');");
mBut_1_4[3]=new Array("鏍￠瑷诲崟","Limit_URL('check.php?spul=46');");

mBut_1_6[0]=new Array("鐗圭爜","Limit_URL('odds/odds.php?spul=18');");
mBut_1_6[1]=new Array("姝?鐗?,"Limit_URL('odds/odds.php?o=18&spul=19');");
mBut_1_6[2]=new Array("姝?鐗?,"Limit_URL('odds/odds.php?o=20&spul=20');");
mBut_1_6[3]=new Array("姝?鐗?,"Limit_URL('odds/odds.php?o=22&spul=21');");
mBut_1_6[4]=new Array("姝?鐗?,"Limit_URL('odds/odds.php?o=24&spul=22');");
mBut_1_6[5]=new Array("姝?鐗?,"Limit_URL('odds/odds.php?o=26&spul=23');");
mBut_1_6[6]=new Array("姝?鐗?,"Limit_URL('odds/odds.php?o=28&spul=24');");
mBut_1_6[7]=new Array("姝ｇ爜","Limit_URL('odds/odds.php?o=30&spul=25');");
mBut_1_6[9]=new Array("杩炵爜","Limit_URL('odds/lm.php?spul=26');");
mBut_1_6[10]=new Array("涓嶄腑","Limit_URL('odds/bz.php?spul=27');");
mBut_1_6[11]=new Array("鐗硅倴涓€鑲栧熬鏁?,"Limit_URL('odds/tqws.php?spul=28');");
mBut_1_6[12]=new Array("鐢熻倴杩?,"Limit_URL('odds/sql.php?spul=29');");
mBut_1_6[13]=new Array("灏炬暟杩?,"Limit_URL('odds/wsl.php?spul=30');");
mBut_1_6[14]=new Array("鍗婃尝","Limit_URL('odds/bb.php?spul=31');");
mBut_1_6[15]=new Array("杩囧叧","Limit_URL('odds/gg.php?spul=32');");
 
mBut_1_7[0]=new Array("绯荤当瑷疆","Limit_URL('system/system.php?spul=47');");
mBut_1_7[1]=new Array("璺戦┈鐏?,"Limit_URL('system/marquee.php?spul=48');");
mBut_1_7[2]=new Array("鎿嶄綔鏃ヨ獙","Limit_URL('system/log.php?spul=49');");
mBut_1_7[3]=new Array("鑷嫊闄嶆按","Limit_URL('system/auto_pre.php?spul=50');");
mBut_1_7[4]=new Array("閫€姘撮粯瑾嶈ō缃?,"Limit_URL('system/default_setting.php?spul=51');");
mBut_1_7[5]=new Array("娓呴櫎鏁版摎","Limit_URL('system/clear.php?spul=52');");
mBut_1_7[6]=new Array("閭勫師淇＄敤椤?,"Limit_URL('system/restore.php?spul=53');"); 
 

</script>

<table border="0" cellpadding="0" cellspacing="0" width="100%">
  <tbody><tr>
    <td rowspan="2" width="5%"><img src="../images/ag_logo.jpg" height="71" width="233"></td>
    <td height="29" width="94%">
        <table border="0" cellpadding="0" cellspacing="0" width="100%">
          <tbody><tr>
                <?php //褰撳墠鏈熸暟淇℃伅
                   $dangqianqishuxinxi=$db->dangqianqishu_arr();
                   $dangqianqishuxinxi_iskaipan=0;
                     if(strtotime($dangqianqishuxinxi[plate_time_satrt])<= time() && time()<strtotime($dangqianqishuxinxi[plate_time_end]) && $dangqianqishuxinxi[is_plate_start]==0){
                          $dangqianqishuxinxi_iskaipan=1;
                }?>   
                <td align="left" width="37%">
                <span id="BeLine_User" class="Font_h F_bold" style="position: relative; top: 1px"><?php echo $dangqianqishuxinxi['plate_num']?>鏈?/span>
                <?php if($dangqianqishuxinxi_iskaipan){ ?>
                <b><font color="red">璺濋洟灏佺洡锛?/font>
                           <span id="hClockTime_C" style="color:#FFFFFF">
                <?php                       $aaa=strtotime($dangqianqishuxinxi['plate_time_end'])-time();
                                                           $bbb=floor($aaa/86400);//澶?
                                                           $ccc=floor(($aaa-($bbb*86400))/3600);//灏忔椂
                                                           $ddd=floor(($aaa-($bbb*86400)-($ccc*3600))/60);//鍒嗛挓
                                                           $eee=$aaa-($bbb*86400)-($ccc*3600)-($ddd*60);//绉?
                                                           //  echo $bbb.'澶?.$ccc.'灏忔椂'.$ddd."鍒嗛挓";
                                                           $bbbccc=24*$bbb+$ccc;//灏忔椂鎬绘暟
                                                           ?>   
             
                           </span></b> 
                <?php }else{  ?>
                <b>&nbsp;<font color="#FFFFFF">宸插皝鐩?/font> &nbsp;<font color="green">璺濋洟寮€鐩わ細</font>
                <span id="hClockTime_C" style="color:#FFFFFF">
                <?php                       $aaa=strtotime($dangqianqishuxinxi['plate_time_satrt'])-time();
                                                           $bbb=floor($aaa/86400);//澶?
                                                           $ccc=floor(($aaa-($bbb*86400))/3600);//灏忔椂
                                                           $ddd=floor(($aaa-($bbb*86400)-($ccc*3600))/60);//鍒嗛挓
                                                           $eee=$aaa-($bbb*86400)-($ccc*3600)-($ddd*60);//绉?
                                                           //  echo $bbb.'澶?.$ccc.'灏忔椂'.$ddd."鍒嗛挓";
                                                           $bbbccc=24*$bbb+$ccc;//灏忔椂鎬绘暟
                                                           ?>   
             
                </span></b>   
                <?php }?>
            </td> 
            
            <td class="f_D3BVP1c3UTUEJw!888!888" align="right" height="29" nowrap="nowrap"><span class="Font_h F_bold" style="position: relative; top: 1px">
           
		   <font color="ff0000"><?php echo $db->get_user_power_char($_SESSION['user_power'.$c_p_seesion])?></font> 锛?span style="font-weight:800; color:#FF0"><?php echo $username?></span>		
		
			</span></td>
          </tr>
        </tbody></table>
    </td>
    <td rowspan="3" valign="top" width="1%"><img src="images/TR.jpg" height="98" width="21"></td>
  </tr>
  <tr>
    <td align="left" height="33" valign="top">
<table align="left" border="0" cellpadding="0" cellspacing="0" width="100%">
  <tbody><tr>
    <td height="3"></td>
  </tr>
  <tr>
    <td height="18">
        <input class="but_1" name="but_1" onClick="Loading_But1(1);Loading_But(1,1);SelectType1(1,1);Limit_URL('immediate/tm.php?spul=60&amp;x1=WZgA21TnUTw!888&amp;x2=Xp9WjVDjBGlVQw!888!888','tm','XJ0G3VHiUD1eSA!888!888','鐗圭爜A');" onMouseOut="this.className='but_1'" onMouseOver="this.className='but_1_m'" type="button">
	<?php if($_SESSION['user_power'.$c_p_seesion]==2 && $user['is_odds']==0 && $zizhanghaodenglu[2]==0){ //浠ｇ悊缃戝彧鏈夊垎鍏徃鍙互璁剧疆锛屼絾鏄繕闇€瑕佸垽鏂叕鍙告槸鍚﹀厑璁歌鍒嗗叕鍙歌缃禂鐜??>
	<input class="but_6" name="but_6" onClick="Loading_But1(6);Loading_But(1,6);SelectType1(1,6);Limit_URL('odds/odds.php?spul=57&amp;x1=XJ1WjQGyVjs!888&amp;x2=DM0D2FHiDGFeSA!888!888');" onMouseOut="this.className='but_6'" onMouseOver="this.className='but_6_m'" type="button">
	<?php }?>
        <input class="but_4" name="but_4" onClick="Loading_But1(4);Loading_But(1,3);SelectType1(1,3);Limit_URL('user/cd_infor.php?spul=63');" onMouseOut="this.className='but_4'" onMouseOver="this.className='but_4_m'" type="button">

	<?php if($_SESSION['user_power'.$c_p_seesion]!=6 && $zizhanghaodenglu[2]==0){ //鐢ㄦ埛绠＄悊锛岄潪浼氬憳鐢ㄦ埛鏈夋潈闄??>
            <input class="but_2" name="but_2" onClick="Loading_But(1,2);Limit_URL('user/branch.php?spul=59','main','AT0!888','XedUgVHvUvVSzg+8','鍒嗗叕鍙?);" onMouseOut="this.className='but_2'" onMouseOver="this.className='but_2_m'" type="button">
	<?php }?>
	<input class="but_5" name="but_5" onClick="Limit_URL('reports/report.php?spul=55');" onMouseOut="this.className='but_5'" onMouseOver="this.className='but_5_m'" type="button">
	
	<input class="but_7" name="but_7" onClick="Limit_URL('system/system.php?spul=62');" onMouseOut="this.className='but_7'" onMouseOver="this.className='but_7_m'" type="button">
	
	<input class="but_3" name="but_3" onClick="Limit_URL('plate/his.php?spul=61');" onMouseOut="this.className='but_3'" onMouseOver="this.className='but_3_m'" type="button">
 
        <input class="but_8" name="but_8" onClick="javascript:if(confirm('\u60a8纭畾瑕侀€€鍑哄悧锛?)){ go_web('top.php?action=logout')}; " onMouseOut="this.className='but_8'" onMouseOver="this.className='but_8_m'" type="button">
	<input name="bb" id="bb" value="4" type="hidden">	<input name="cc" id="cc" value="0" type="hidden"></td>
  </tr>
</tbody></table>

	</td>
  </tr>
  <tr>
    <td colspan="2" height="22"><table border="0" cellpadding="0" cellspacing="0" width="100%">
      <tbody><tr>
        <td height="4" width="2%"><img src="images/TL_2.jpg" height="4" width="161"></td>
        <td rowspan="2" id="But_Html" width="98%"><table border="0" cellpadding="0" cellspacing="0" width="100%"><tbody><tr><td height="28" width="63"><table align="center" border="0" cellpadding="0" cellspacing="0" width="58"><tbody><tr><td style="" onMouseOver="this.style.backgroundImage='url(images/bg.gif)';this.style.borderStyle='solid';this.style.borderWidth='1';borderColor='#a6d0e7';" onMouseOut="this.style.backgroundImage='url()';this.style.borderStyle='none'" onClick="Limit_URL('?spul=56');" height="20"><div align="center">鐩ゅ彛绠＄悊</div></td></tr></tbody></table></td><td width="3"><img src="images/main_34.gif" height="27" width="3"></td><td height="28" width="63"><table align="center" border="0" cellpadding="0" cellspacing="0" width="58"><tbody><tr><td style="" onMouseOver="this.style.backgroundImage='url(images/bg.gif)';this.style.borderStyle='solid';this.style.borderWidth='1';borderColor='#a6d0e7';" onMouseOut="this.style.backgroundImage='url()';this.style.borderStyle='none'" onClick="Limit_URL('?spul=61');" height="20"><div align="center">姝峰彶闁嬬崕</div></td></tr></tbody></table></td><td width="3"><img src="images/main_34.gif" height="27" width="3"></td><td height="28" width="63"><table align="center" border="0" cellpadding="0" cellspacing="0" width="58"><tbody><tr><td style="background-image: url(&quot;&quot;); border-style: none; border-width: 1px;" onMouseOver="this.style.backgroundImage='url(images/bg.gif)';this.style.borderStyle='solid';this.style.borderWidth='1';borderColor='#a6d0e7';" onMouseOut="this.style.backgroundImage='url()';this.style.borderStyle='none'" onClick="Limit_URL('?spul=45&amp;name=AYBU8AK2A/lfnF7mAscP/Q!888!888');" height="20"><div align="center">灏庡嚭鏁版摎</div></td></tr></tbody></table></td><td width="3"><img src="images/main_34.gif" height="27" width="3"></td><td height="28" width="63"><table align="center" border="0" cellpadding="0" cellspacing="0" width="58"><tbody><tr><td style="" onMouseOver="this.style.backgroundImage='url(images/bg.gif)';this.style.borderStyle='solid';this.style.borderWidth='1';borderColor='#a6d0e7';" onMouseOut="this.style.backgroundImage='url()';this.style.borderStyle='none'" onClick="Limit_URL('?spul=46&amp;name=CNVV9VGkDZ9R0lsLVYUAwg!888!888');" height="20"><div align="center">鏍￠瑷诲崟</div></td></tr></tbody></table></td><td>&nbsp;</td></tr></tbody></table></td>
      </tr>
      <tr>
        <td class="f_center" background="images/TL_3.jpg" height="23"><span style="position: relative; top: -1px" id="clock_Html" class="font_w F_bold">&nbsp;</span>&nbsp;&nbsp;&nbsp;</td>
        </tr>
    </tbody></table></td>
  </tr>
</tbody></table>
<div id="LT_DIV" style="position: absolute; top: 76px; left: 25px; ">
  <strong><font id="Clock" color="white"><script language="JavaScript">tick();
function tick() {
var hours, minutes, seconds, date, month, year;
var intHours, intMinutes, intSeconds;
var tmpDate;
tmpDate = new Date();
date = tmpDate.getDate();
month= tmpDate.getMonth() + 1 ;
year= tmpDate.getFullYear();
intHours = tmpDate.getHours();
intMinutes = tmpDate.getMinutes();
intSeconds = tmpDate.getSeconds();
if (intHours == 0) {
hours = "00:";
} else if (intHours < 10) {
hours = "0" + intHours+":";
} else {
hours = intHours + ":";
}
if (intMinutes < 10) {
minutes = "0"+intMinutes+":";
} else {
minutes = intMinutes+":";
}
if (intSeconds < 10) {
seconds = "0"+intSeconds+" ";
} else {
seconds = intSeconds+" ";
}
if(month<10){month="0"+month;};
if(date<10){date="0"+date;};
if (tmpDate.getDay() == 5){weekday="鏄熸湡浜?nbsp;";}
if (tmpDate.getDay() == 6) {weekday="鏄熸湡鍏?nbsp;";}
if (tmpDate.getDay() == 0) {weekday="鏄熸湡鏃?nbsp;";}
if (tmpDate.getDay() == 1) {weekday="鏄熸湡涓€&nbsp;";}
if (tmpDate.getDay() == 2) {weekday="鏄熸湡浜?nbsp;";}
if (tmpDate.getDay() == 3) {weekday="鏄熸湡涓?nbsp;";}
if (tmpDate.getDay() == 4) {weekday="鏄熸湡鍥?nbsp;";}
timeString = hours+minutes+seconds;
dayString="";
document.getElementById("Clock").innerHTML = dayString+timeString+weekday;
window.setTimeout("tick();", 1000);
}
//window.onload = tick;
</script></font></strong>  
</div>
<script type="text/javascript">
//document.getElementById("LT_DIV").style.top = 76;
//document.getElementById("LT_DIV").style.left = 25;
SelectType(1,1);
</script>
<script language="javascript" type="text/javascript">
function add_win() {
document.all.cc.value="0";
//alert("娌℃湁閫夋嫨绾綍锛屾垨鍙湁鏈€鍚庝竴鏉＄邯褰?)

}
function add_win1(lm) {
document.all.cc.value=lm;
//alert("娌℃湁閫夋嫨绾綍锛屾垨鍙湁鏈€鍚庝竴鏉＄邯褰?)

}
</script>

<script language="javascript">
var normalelapse = 1000;
var nextelapse = normalelapse;
var counter; 
var startTime;
var ClockTime_C = "00:00:00";
var ClockTime_O = "00:00:00"; 
var finish = "00:00:00";
var timer = null;



// 闁嬪閬嬭
function Run_onTimer() {
  counter = 0;
  // 鍒濆鍖栭枊濮嬫檪闁?
  startTime = new Date().valueOf();
  
  document.getElementById("hClockTime_C").innerHTML=ClockTime_C.substr(0);
  //document.getElementById("hClockTime_O").innerHTML=ClockTime_O.substr(0);

  // nextelapse鏄畾鏅傛檪闁? 鍒濆鏅傜偤1000姣
  // 瑷绘剰setInterval鍑芥暟: 鏅傞枔閫濆幓nextelapse(姣)寰? onTimer鎵嶉枊濮嬪煼琛?
  timer = window.setInterval("onTimer()", nextelapse); 
}

rnd.today=new Date(); 
rnd.seed=rnd.today.getTime(); 
function rnd() { 
    rnd.seed = (rnd.seed*9301+49297) % 233280; 
    return rnd.seed/(233280.0); 
}
function rand(number) { 
    return Math.ceil(rnd()*number); 
}

function dj_Timer(t_Time){
    var hms = new String(t_Time).split(":");
	var s = new Number(hms[2]);
	var m = new Number(hms[1]);
	var h = new Number(hms[0]);
  
	s -= 1;
    if (s < 0){
        s = 59;
        m -= 1;
    }
	  
    if (m < 0){
        m = 59;
        h -= 1;
    }
	
	var ss = s < 10 ? ("0" + s) : s;
	var sm = m < 10 ? ("0" + m) : m;
	var sh = h < 10 ? ("0" + h) : h;
	
	return sh + ":" + sm + ":" + ss;
}

function Time_To_Sender(t_Time){
    var hms = new String(t_Time).split(":");
	var s = new Number(hms[2]);
	var m = new Number(hms[1]);
	var h = new Number(hms[0]);

	return ((h * 60) * 60) + (m * 60) + s;
}

// 鍊掕▓鏅傚嚱鏁?
function onTimer(){

	if (ClockTime_O == finish){//鏅傞枔鍒板氨鍒锋柊闋侀潰
        return;
	}
	//alert(ClockTime_O)
	if (ClockTime_C != finish) {
	    ClockTime_C=dj_Timer(ClockTime_C);
		
	    document.getElementById("hClockTime_C").innerHTML=ClockTime_C.substr(0);
	    
	    if (ClockTime_C == finish) {
			//quick5();
            //var objTD, i = 0
            //var objTDs = document.getElementsByTagName("td");
            //while (objTD = objTDs.item(i++)) {
                //if (objTD.id.substr(0,6)=="jeu_p_"){
                   // objTD.innerHTML="<span class='multiple_Red'>-</span>";
               // } else if (objTD.id.substr(0,6)=="jeu_m_"){
                   // objTD.innerHTML="灏佺洡";
               // }
            //}
        }
	}
	if (ClockTime_O != finish) {
		
	    ClockTime_O=dj_Timer(ClockTime_O);
		
		
		if (ClockTime_O == finish) {
			//quick5();
		}
		
	   // document.getElementById("hClockTime_O").innerHTML=ClockTime_O.substr(0);
	}

    if (Time_To_Sender(ClockTime_O)==0) t_Update_Time=rand(10) + 1;
	
	// 娓呴櫎涓婁竴娆＄殑瀹氭檪鍣?
	window.clearInterval(timer);
	
	// 鑷牎椹楃郴绲辨檪闁撳緱鍒版檪闁撳樊, 涓︾敱姝ゅ緱鍒颁笅娆℃墍鍟熷嫊鐨勬柊瀹氭檪鍣ㄧ殑鏅傞枔nextelapse
	counter++; 
	var counterSecs = counter * 1000;
	var elapseSecs = new Date().valueOf() - startTime;
	var diffSecs = counterSecs - elapseSecs;
	nextelapse = normalelapse + diffSecs;
	if (nextelapse < 0) nextelapse = 0;
	
	// 鍟熷嫊鏂扮殑瀹氭檪鍣?
	timer = window.setInterval("onTimer()", nextelapse); 
}



ClockTime_C="<?php echo  $bbbccc.":".$ddd.":".$eee;?>";
ClockTime_O="<?php echo  $bbbccc.":".$ddd.":".$eee;?>";

Run_onTimer();
 
 </script>
</body></html>