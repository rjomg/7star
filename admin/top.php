<?php

include_once('../global.php');

$db = new action($mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset); //数据库操作类.



if($_GET[action]=='logout')$db->Get_user_out($client_location['country']);//如果为真 那么退出

$username = $_SESSION['username'.$c_p_seesion];



//$db2 = new immediate($mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset); //数据库操作类.

//$user_id=$_SESSION['uid'.$c_p_seesion];

//$user_power=$_SESSION['user_power'.$c_p_seesion];

//$plate_num=$db2->get_plate();

//$type_num=$db2->get_num49();

//

//$imm_num=$db2->get_imm_tm_to_zm_by_num($type_num, $user_id, $plate_num, $t1, $t2, $user_power);



//子账户关闭类型

$rowclose_type=$db->zizhanghao_close_type($uid);

$close_type = explode(',', $rowclose_type['close_type']);



?>

<html>

 <head>

  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 

  <link href="./css/admincg.css" rel="stylesheet" type="text/css" /> 

    <script src="images/Top.js" type="text/javascript"></script> 

  <title></title> 

  <script>

  function sethighlight(n) {

    var lis = document.getElementsByTagName('li');

    for(var i = 0; i < lis.length; i++) {

      lis[i].id = '';

    }

    lis[n].id = 'menuon';

  }

</script> 

  <style>

  #header_top {

    background:black; 

    filter:alpha(opacity:30);

    opacity:0.3; 

    height:100%;

    position:absolute;

    width:100%;

    top:0;

    z-index:1;

  }

</style> 

 </head> 

 <body> 

  <div id="header_top" style="display:none"></div> 

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

/*mBut_1_1[0]=new Array("特码","Limit_URL('immediate/tm.php','tm','XZwA21DjBms!888','AcAE3wy/B2pTRQ!888!888','特码');");

mBut_1_1[1]=new Array("正1特","Limit_URL('immediate/z1.php','tm','DdVWqFadUIQ!888','XYUG+FBmAMADjA5C','正1特');");

mBut_1_1[2]=new Array("正2特","Limit_URL('immediate/z2.php','tm','XIQC/A3GBNA!888','XoYC/FZjB8cCjVwQ','正2特');");

mBut_1_1[3]=new Array("正3特","Limit_URL('immediate/z3.php','tm','WoIB/wPIAtY!888','DNRWqAw4UpJT3A9D','正3特');");

mBut_1_1[4]=new Array("正4特","Limit_URL('immediate/z4.php','tm','D9cP8VecUoY!888','XIRTrVNgBsZW2VsX','正4特');");

mBut_1_1[5]=new Array("正5特","Limit_URL('immediate/z5.php','tm','WYEH+Q3GUYU!888','XoZUqlNhBMRT3AFN','正5特');");

mBut_1_1[6]=new Array("正6特","Limit_URL('immediate/z6.php','tm','CtIF+w3GBdE!888','DdUG+AIzV5cCjQpG','正6特');");

mBut_1_1[7]=new Array("正码","Limit_URL('immediate/zm.php','tm','WYEF+1blA24!888','C9MA/lblAm9fSQ!888!888','正码');");

mBut_1_1[9]=new Array("连码","Limit_URL('immediate/lm.php','lm','XY8AQVHiBWg!888','ALsB/ATLB6Bf3gDd','二全中');");

mBut_1_1[10]=new Array("不中","Limit_URL('immediate/bz.php','lm','XeIFvQDRUo4!888','CskH4QC1BLNQ0QvW','五不中');");

mBut_1_1[11]=new Array("特肖一肖尾数","Limit_URL('immediate/tx.php','lm','C88D+gfQB68!888','DcwA2wTTDaU!888','特肖');");

mBut_1_1[12]=new Array("生肖连","Limit_URL('immediate/sql.php','lm','Wp4G/wbRA6s!888','CLNTrg3aBq5Q2ApFAA1chlWEAAs!888','二肖连[中]');");

mBut_1_1[13]=new Array("尾数连","Limit_URL('immediate/wsl.php','lm','WpkEtQeUUOk!888','XOcH+lGYDLJf114RUVwB21yNVl0!888','二尾连[中]');");

mBut_1_1[14]=new Array("半波","Limit_URL('immediate/bb.php','lm','XOFRuVPmVfE!888','DbBSulHkVvI!888','半波');");

mBut_1_1[15]=new Array("过关","Limit_URL('immediate/gg.php','lm','DN4HWlG8BVk!888','WYsGW1S5BVk!888','过关');");

mBut_1_1[16]=new Array("監控流水賬单","Limit_URL('immediate/jklszd.php');");



mBut_1_1[18]=new Array("賬单","Limit_URL('immediate/zd.php');");*/









mBut_1_1[0]=new Array("二字定","Limit_URL('immediate/tm.php?t1=二字定&t2=正1特AB&spul=2');");

mBut_1_1[1]=new Array("三字定","Limit_URL('immediate/tm.php?t1=三字定&t2=正2特AB&spul=3');");

mBut_1_1[2]=new Array("四字定","Limit_URL('immediate/tm.php?t1=四字定&t2=正3特AB&spul=4');");

mBut_1_1[3]=new Array("二字现","Limit_URL('immediate/tm.php?t1=二字现&t2=正4特AB&spul=5');");

mBut_1_1[4]=new Array("三字现","Limit_URL('immediate/tm.php?t1=三字现&t2=正5特AB&spul=6');");

mBut_1_1[5]=new Array("四字现","Limit_URL('immediate/tm.php?t1=四字现&t2=正6特AB&spul=7');");

mBut_1_1[19]=new Array("賬单","Limit_URL('immediate/zd.php?spul=17');");













/*mBut_1_2[0]=new Array("分公司","Limit_URL('user/branch.php?spul=D2kFWVY8DS8FPwBsU2xbOQ!888!888&type=ADw!888','main','WmY!888','WeNThlHvAaYDn17t','分公司');");

mBut_1_2[1]=new Array("股东","Limit_URL('user/shareholder.php?spul=XDoHWwNpACIEPl4yBjlYOg!888!888&type=DzA!888','main','XWI!888','XOgBywOSBHQ!888','股东');");

mBut_1_2[2]=new Array("总代理","Limit_URL('user/distributor.php?spul=CmwFWVY8ASMHPQFtBzgIag!888!888&type=XGI!888','main','CDY!888','DrwBgAOwAPZSxQDg','总代理');");

mBut_1_2[3]=new Array("代理","Limit_URL('user/proxy.php?spul=DGoCXgJoUHIDOVwwAT5fPQ!888!888&type=WWA!888','main','DzY!888','WeBRqAPEAOE!888','代理');");

mBut_1_2[4]=new Array("会员","Limit_URL('user/member.php?spul=DmgPU1Q+AiBSaFs3BjlcPg!888!888&type=XmY!888','main','CDA!888','AZlTrgeGAVk!888','会员');");

mBut_1_2[6]=new Array("跨站走飞账号管理","Limit_URL('user/branch.php?spul=AGZUCFc0ByUEMghhBzwNaABvACxXYg!888!888');");

mBut_1_2[7]=new Array("修改密码","Limit_URL('user/updatepass.php?spul=WjwPUwZlBCZQZlw1Bj0IbVM8CHBTcA5sUSFaLw!888!888');");



 */

<?php if($_SESSION['user_power'.$c_p_seesion]<2) { //管理员权限?>

mBut_1_2[0]=new Array("分公司","Limit_URL('user/branch.php?power=2&spul=36','main','WmY!888','WeNThlHvAaYDn17t','分公司');");

<?php }?>

    

<?php if($_SESSION['user_power'.$c_p_seesion]<3) { //分公司以上权限?>

    mBut_1_2[1]=new Array("股东","Limit_URL('user/branch.php?power=3&spul=37');");

<?php }?>

    

    <?php if($_SESSION['user_power'.$c_p_seesion]<4) { //股东以上权限?>

mBut_1_2[2]=new Array("总代理","Limit_URL('user/branch.php?power=4&spul=38');");

<?php }?>

    

<?php if($_SESSION['user_power'.$c_p_seesion]<5) { //总代理以上权限?>

    mBut_1_2[3]=new Array("代理","Limit_URL('user/branch.php?power=5&spul=39');");

<?php }?>

    

<?php if($_SESSION['user_power'.$c_p_seesion]<6) { //代理以上权限?>

    mBut_1_2[4]=new Array("会员","Limit_URL('user/branch.php?power=6&spul=40');");

    <?php if(empty($zizhanghaodenglu[2])){?>

    mBut_1_2[5]=new Array("子账户","Limit_URL('user/son_user.php?user_id=<?php echo $_SESSION['uid'.$c_p_seesion];?>&user_name=<?php echo $_SESSION['username'.$c_p_seesion];?>&spul=103');");

    <?php }?>

<?php }?>

    

<?php if($_SESSION['user_power'.$c_p_seesion]==1) {?>

//mBut_1_2[5]=new Array("跨站走飞账号管理","Limit_URL('user/branch.php?power=6&spul=41');");

<?php }?>

mBut_1_2[6]=new Array("修改密码","Limit_URL('user/updatepass.php?spul=42');");





//mBut_1_3[0]=new Array("信用資料","Limit_URL('?spul=edit');");





mBut_1_4[0]=new Array("盘口设置","Limit_URL('plate/tab.php?spul=43');");

mBut_1_4[1]=new Array("历史开奖","Limit_URL('plate/his.php?spul=44');");

mBut_1_4[2]=new Array("系统设置","Limit_URL('system/system.php?spul=47');");

mBut_1_4[3]=new Array("备份数据","Limit_URL('backup.php?spul=101');");

mBut_1_4[4]=new Array("还原数据","Limit_URL('restore.php?spul=102');");

mBut_1_4[5]=new Array("清除数据","Limit_URL('system/clear.php?spul=52');");

mBut_1_4[6]=new Array("还原信用度","Limit_URL('system/restore.php?spul=53');");

// mBut_1_4[2]=new Array("導出数據","Limit_URL('plate/output.php?spul=45');");

// mBut_1_4[3]=new Array("校驗註单","Limit_URL('plate/check.php?spul=46');");

// mBut_1_4[4]=new Array("即時開獎","Limit_URL('plate/lottery.php?spul=100');");

 



 

mBut_1_6[0]=new Array("分公司","Limit_URL('odds/odds.php?o=18&spul=19');");

mBut_1_6[1]=new Array("股东","Limit_URL('odds/odds.php?o=20&spul=20');");

mBut_1_6[2]=new Array("总代理","Limit_URL('odds/odds.php?o=22&spul=21');");

mBut_1_6[3]=new Array("代理","Limit_URL('odds/odds.php?o=24&spul=22');");

mBut_1_6[4]=new Array("会员","Limit_URL('odds/odds.php?o=26&spul=23');");

mBut_1_6[5]=new Array("子账户","Limit_URL('odds/odds.php?o=28&spul=24');");



 



 




// mBut_1_7[2]=new Array("操作日誌","Limit_URL('system/log.php?spul=49');");


mBut_1_7[0]=new Array("手动降水","Limit_URL('system/drop_odds.php?spul=53');");
mBut_1_7[1]=new Array("自动降水","Limit_URL('system/auto_pre.php?spul=50');");

mBut_1_7[2]=new Array("退水默認設置","Limit_URL('system/default_setting.php?spul=51');");

mBut_1_7[3]=new Array("跑马灯","Limit_URL('system/marquee.php?spul=48');");

mBut_1_7[4]=new Array("操作退水","Limit_URL('system/opera_water.php?spul=49');");

mBut_1_7[5]=new Array("营业报表","Limit_URL('system/business.php?o_typename=口XX口&spul=52');");









 



</script>

  <table width="100%" border="0" cellpadding="0" cellspacing="0" class="topmenubg"> 

   <tbody>

    <tr> 

     <td rowspan="2" width="10%" style="text-align:center;"> <span class="editiontext"> 管理员：

       <?php echo $username?> </span> <input name="bb" id="bb" value="4" type="hidden" /> <input name="cc" id="cc" value="0" type="hidden" /> </td> 

     <td height="21" class="marquees" width="75%"> 

      <marquee scrolldelay="400" style="height:18px;width:50%;"> 

       <div id="news">

        <a href="header.php" style="text-decoration:none;color:#fff;font-size:14px;font-family:Microsoft JhengHei;">1.用户明确同意本系统的使用由用户个人承担风险。 2.本系统不作任何类型的担保，不担保服务一定能满足用户的要求，也不担保服务不会受中断，对服务的及时性，安全性，出错发生都不作担保。 用户理解并接受，任何通过本系统服务取得的信息资料的可靠性取决于用户自己，用户自己承担所有风险和责任。 3.本声明的最终解释权归本系统所有。 特别提醒：本公司如果输入开奖结果错误，有权利更正开奖结果，最终以官方最后公布结果来结账，不得异议。</a>

       </div> 

      </marquee> </td> 

    </tr> 

    <tr> 

     <td> 

      <div class="topmenu" style="width:50%;min-width:650px;"> 

       <ul> 

        <li id="menuon"><span><a href="javascript:;" onclick="Loading_But1(4);Loading_But(1,4);SelectType1(1,4);sethighlight(0);Limit_URL('plate/tab.php?spul=56');">盘口管理</a></span></li> 

        <li id=""><span><a href="javascript:;" onclick="Loading_But(1,7);sethighlight(1);Limit_URL('system/default_setting.php?spul=58');">前台控制</a></span></li> 

        <!-- <li id=""><span><a href="javascript:;" onclick="Loading_But1(6);Loading_But(1,6);SelectType1(1,6);sethighlight(2);Limit_URL('odds/odds.php?spul=57&x1=XJ1WjQGyVjs!888&x2=DM0D2FHiDGFeSA!888!888');">赔率设置</a></span></li>  -->

         <li id=""><span><a href="javascript:;" onclick="sethighlight(2);Limit_URL('reports/awardreadadmin.php');">总货明细</a></span></li>

         <li id=""><span><a href="javascript:;" onclick="sethighlight(3);Limit_URL('reports/awardreadadmin.php');">分类帐</a></span></li>

        <li id=""><span><a href="javascript:;" onclick="sethighlight(4);Limit_URL('reports/report.php?percent=commpany&spul=55');">报表查询</a></span></li> 

        <!-- <li id=""><span><a href="javascript:;" onclick="Loading_But1(1);Loading_But(1,1);SelectType1(1,1);sethighlight(2);Limit_URL('immediate/tm.php?spul=60&x1=WZgA21TnUTw!888&x2=Xp9WjVDjBGlVQw!888!888','tm','XJ0G3VHiUD1eSA!888!888','特码A');">即时注单</a></span></li>  -->

        <li id=""><span><a href="javascript:;" onclick="Loading_But(1,2);sethighlight(5);Limit_URL('user/branch.php?power=2&spul=59','main','AT0!888','XedUgVHvUvVSzg+8','分公司');">用户管理</a></span></li> 

        <li id=""><span><a href="javascript:;" onclick="sethighlight(6);Limit_URL('onlineNum.php?spul=54');">在线人数</a></span></li>

        <li id=""><span><a href="javascript:if(confirm('\u60a8确定要退出吗？')){ go_web('top.php?action=logout')}; " target="_top">退出</a></span></li> 

       </ul> 

      </div> 

      <div><div style="text-align:center" id="issuenoTag"></div><div style="text-align:center;vertical-align:middle;font-size:14px;font-family:Microsoft JhengHei;margin-top:3px;" id="timeTag"></div></div>

      </td> 

    </tr> 

    <tr class="header">

    <td colspan="3" height="22"><table border="0" cellpadding="0" cellspacing="0" width="100%">

      <tbody><tr>

        <td height="4" width="2%"><div height="4" style="width:161"></div></td>

        <td rowspan="2" id="But_Html" width="98%"><table border="0" cellpadding="0" cellspacing="0" width="100%"><tbody><tr><td height="28" width="80"><table align="center" border="0" cellpadding="0" cellspacing="0" width="80"><tbody><tr><td style="" onClick="Limit_URL('?spul=XDoDXwJrVi8AOg!888!888');" height="20"><div align="center">盤口管理</div></td></tr></tbody></table></td><td width="3"><img src="images/main_34.gif" height="27" width="3"></td><td height="28" width="80"><table align="center" border="0" cellpadding="0" cellspacing="0" width="80"><tbody><tr><td style="" onClick="Limit_URL('?spul=DWsHWwNvA24FDVw/Di0Pbg!888!888');" height="20"><div align="center">歷史開獎</div></td></tr></tbody></table></td><td width="3"><img src="images/main_34.gif" height="27" width="3"></td><td height="28" width="80"><table align="center" border="0" cellpadding="0" cellspacing="0" width="80"><tbody><tr><td style="; border-style: none; border-width: 1px;" onClick="Limit_URL('?spul=Wz1SDgdrVjtfV1k2BTIPaA!888!888&amp;name=AYBU8AK2A/lfnF7mAscP/Q!888!888');" height="20"><div align="center">導出数據</div></td></tr></tbody></table></td><td width="3"><img src="images/main_34.gif" height="27" width="3"></td><td height="28" width="80"><table align="center" border="0" cellpadding="0" cellspacing="0" width="80"><tbody><tr><td style="" onClick="Limit_URL('?spul=XDoAXFc7A25QWF0yU2RfOA!888!888&amp;name=CNVV9VGkDZ9R0lsLVYUAwg!888!888');" height="20"><div align="center">校驗註单</div></td></tr></tbody></table></td><td>&nbsp;</td></tr></tbody></table></td>

      </tr>

      <tr>

        <td class="f_center" height="23" style="background:none;border:none;"><span style="position: relative; top: -1px" id="clock_Html" class="font_w F_bold">&nbsp;</span>&nbsp;&nbsp;&nbsp;</td>

        </tr>

    </tbody></table></td>

  </tr>

   </tbody>

  </table> 

  <div id="LT_DIV" style="position: absolute; top: 66px; left: 25px; ">

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

if (tmpDate.getDay() == 5){weekday="星期五&nbsp;";}

if (tmpDate.getDay() == 6) {weekday="星期六&nbsp;";}

if (tmpDate.getDay() == 0) {weekday="星期日&nbsp;";}

if (tmpDate.getDay() == 1) {weekday="星期一&nbsp;";}

if (tmpDate.getDay() == 2) {weekday="星期二&nbsp;";}

if (tmpDate.getDay() == 3) {weekday="星期三&nbsp;";}

if (tmpDate.getDay() == 4) {weekday="星期四&nbsp;";}

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

SelectType(1,4);

</script>

<script language="javascript" type="text/javascript">

function add_win() {

document.all.cc.value="0";

//alert("没有选择纪录，或只有最后一条纪录")



}

function add_win1(lm) {

document.all.cc.value=lm;

//alert("没有选择纪录，或只有最后一条纪录")



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







// 開始運行

function Run_onTimer() {

  counter = 0;

  // 初始化開始時間

  startTime = new Date().valueOf();

  

  document.getElementById("hClockTime_C").innerHTML=ClockTime_C.substr(0);

  //document.getElementById("hClockTime_O").innerHTML=ClockTime_O.substr(0);



  // nextelapse是定時時間, 初始時為1000毫秒

  // 註意setInterval函数: 時間逝去nextelapse(毫秒)後, onTimer才開始執行

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



// 倒計時函数

function onTimer(){



  if (ClockTime_O == finish){//時間到就刷新頁面

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

                   // objTD.innerHTML="封盤";

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

  

  // 清除上一次的定時器

  window.clearInterval(timer);

  

  // 自校驗系統時間得到時間差, 並由此得到下次所啟動的新定時器的時間nextelapse

  counter++; 

  var counterSecs = counter * 1000;

  var elapseSecs = new Date().valueOf() - startTime;

  var diffSecs = counterSecs - elapseSecs;

  nextelapse = normalelapse + diffSecs;

  if (nextelapse < 0) nextelapse = 0;

  

  // 啟動新的定時器

  timer = window.setInterval("onTimer()", nextelapse); 

}







ClockTime_C="<?php echo  $bbbccc.":".$ddd.":".$eee;?>";

ClockTime_O="<?php echo  $bbbccc.":".$ddd.":".$eee;?>";



Run_onTimer();

 

 </script>

   <script src="./js/common.js" type="text/javascript"></script> 

  <script src="./js/menu.js" type="text/javascript"></script> 

  <script src="./js/ajax.js" type="text/javascript"></script> 

  <script src="./js/frank.js" type="text/javascript"></script> 

  <script src="./js/json2.js" type="text/javascript"></script> 

  <style media="print"> .Noprint{display:none;}</style>

  <script src="./js/showdate.js" type="text/javascript"></script> 

  <script language="JavaScript">

    var _openstart;

    var _sellBegTime;

    var _sellEndTime;

    var _systemTime;

    var _issueno;

    var action = "news";

    var local_hash = 'cddf1befb3e14856911e51a38349662a';

    function ajax(url, vars, callbackFunction){

      var request = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject("MSXML2.XMLHTTP.3.0");

      request.open("GET", url, true); 

      request.onreadystatechange = function(){

        if (request.readyState == 4 && request.status == 200){

          if (request.responseText){         

            callbackFunction(request.responseText);

            //document.getElementById("news").innerHTML=request.responseText;

          }

        }

      };

      request.send(vars);

    }



    function donews(str){

      if (str != null && str != ""){

        str = JSON.parse(str);

        

        _sellBegTime = str['starttime'];

        _sellEndTime  = str['endtime'];

        _systemTime = str['systime'];

        _openstart = str['openmode'];

        return_hash = str['hash'];

        _issueno = str['issueno'];

        document.getElementById('issuenoTag').innerHTML = '当前期数：' + _issueno;

        document.getElementById('issuenoTag').style.margin="-5px 0px 0px";

        if (_openstart != "" || _openstart==0){

          $('news').innerHTML = "<a href=header.php style='text-decoration:none;color:#fff;font-size:14px;font-family:Microsoft JhengHei;'>"+'1.用户明确同意本系统的使用由用户个人承担风险。 2.本系统不作任何类型的担保，不担保服务一定能满足用户的要求，也不担保服务不会受中断，对服务的及时性，安全性，出错发生都不作担保。 用户理解并接受，任何通过本系统服务取得的信息资料的可靠性取决于用户自己，用户自己承担所有风险和责任。 3.本声明的最终解释权归本系统所有。 特别提醒：本公司如果输入开奖结果错误，有权利更正开奖结果，最终以官方最后公布结果来结账，不得异议。本网1月26号凌晨2点后停盘。祝大家新春愉快！万事如意！'+"</a>";

        }

        if(local_hash != return_hash){

          top.location.href = '/';

        }

      }

    }

    function OpenWinCcomm(url,name) {

      window.open(url, "xupan"+name, "fullscreen=yes,toolbar=no,scrollbars=yes,resizable=yes,location=no,status=yes,menubar=no,top=0,left=0,");

    }

    function newsinfo(){

      ajax("./ajax/ajax.php","",donews);

    }

    newsinfo();

    startTime();

    setInterval("newsinfo()",23000);  

</script> 

 </body>

</html>

<script type="text/javascript">

//document.getElementById("LT_DIV").style.top = 76;

//document.getElementById("LT_DIV").style.left = 25;

SelectType(1,4);

</script>