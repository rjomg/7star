<?php
include_once ('../global.php');
$db = new action($mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset); //数据库操作类.
if($_GET[action]=='logout')$db->Get_user_out($client_location['country']);//如果为真 那么退出

$pao = mysql_query("select * from system_marquee where type=0 and (user='all_all' or user='all_user') order by datetime desc");

?>
<?php $w_close_type = explode(',', $system_setting['w_close_type']);?>
<html oncontextmenu="return false" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
#times {
	font-size: 12px;
	font-weight: bold;
	color: #06F;
	margin-left: 180px;
}
-->
</style>
</head>
<body id="body_backdrop" class="backdrop_1" scroll="no" oncontextmenu="return false" onselect="document.selection.empty()" oncopy="document.selection.empty()" onmouseover="self.status='歡迎光臨';return true">    

    <link href="images/Index.css" rel="stylesheet" type="text/css">
        <SCRIPT LANGUAGE="JavaScript">
<!-- 
     function ResumeError() {
     return true;
}
window.onerror = ResumeError;
// -->
</SCRIPT>
<script type="text/javascript" src="images/For.js"></script>
<script src="images/Top.js" type="text/javascript"></script>
<link href="a_data/TopMenu.css" rel="stylesheet" type="text/css">
<script language="JAVASCRIPT">
function rl_rl1(bb){
//rl1.style.color="ffffff"
//rl2.style.color="ffffff"
//rl3.style.color="ffffff"
//rl4.style.color="ffffff"
//rl5.style.color="003366"

rl6.style.color="003366"

rl7.style.color="003366"
rl8.style.color="003366"
rl9.style.color="003366"
rl10.style.color="003366"
rl11.style.color="003366"
rl12.style.color="003366"
rl13.style.color="003366"
rl15.style.color="003366"
rl14.style.color="003366"

rl17.style.color="003366"
rl19.style.color="003366"
rl18.style.color="003366"
rl20.style.color="003366"

rl21.style.color="003366"
rl23.style.color="003366"
rl24.style.color="003366"
//rl25.style.color="003366"
//rl26.style.color="003366"


bb.style.color="ff0000"
}
function rl_cc1(x1,x2,cc,ct,x4){
if (document.all.ids.value==ct && ct=="zt"){
parent.frames('k2f6983f2880d32e880d3ds2e83f2880d32b_memr').quick551(x2,x4,'A');
}else{
parent.k2f6983f2880d32e880d3ds2e83f2880d32b_memr.location.href='?spul='+cc+'&x1='+x1+'&x2='+x2;
}
document.all.ids.value=ct;
}
</script>
<table border="0" cellpadding="0" cellspacing="0" height="90" width="100%">
  <tbody>
    <tr>
      <td rowspan="3" valign="top"><table border="0" width="100%">
          <tbody>
          </tbody>
      </table>
        <img src="../images/h_logo.jpg" width="235" height="87">
        <table border="0" width="100%">
          <tbody>
            <tr></tr>
          </tbody>
        </table>
      </td>
      <td height="33" valign="top" width="100%">
           <input class="but_1" name="but_1" onClick="window.open('cd_infor.php?spul=64','main');" onMouseOut="this.className='but_1'" onMouseOver="this.className='but_1_m'" type="button">
	   <input class="but_2" name="but_2" onClick="window.open('update_pw.php?spul=42','main');" onMouseOut="this.className='but_2'"  onmouseover="this.className='but_2_m'" type="button">
           <input class="but_3" name="but_3" onClick="window.open('bet_detail.php?spul=68','main');" onMouseOut="this.className='but_3'" onMouseOver="this.className='but_3_m'" type="button">
	   <input class="but_4" name="but_4" onClick="window.open('stataccounts.php?spul=69','main');" onMouseOut="this.className='but_4'" onMouseOver="this.className='but_4_m'" type="button">
	   <input class="but_5" name="but_5" onClick="window.open('history.php?spul=44','main');" onMouseOut="this.className='but_5'" onMouseOver="this.className='but_5_m'" type="button">
	   <input class="but_6" name="but_6" onClick="window.open('rule.php?spul=70','main');" onMouseOut="this.className='but_6'" onMouseOver="this.className='but_6_m'" type="button">
	   <input class="but_7" name="but_7" onClick="javascript:if(confirm('\u60a8确定要退出吗？')){ go_web1('top.php?action=logout')};" onMouseOut="this.className='but_7'" onMouseOver="this.className='but_7_m'" type="button">
      </td>
    </tr>
    <tr>
      <td class="" height="24" valign="top"><table border="0" cellpadding="0" cellspacing="0" width="100%">
          <tbody>
            <tr>
              <td width="13%">&nbsp;&nbsp; </td>
              <td height="24" width="87%"><a href="#" onclick="rl_cc1('全部','全部','XDVVCQJhDC5UbVw0BSQLdA!888!888','et','et');">
                <marquee onMouseOut="this.start()" onMouseOver="this.stop()" scrollamount="4" scrolldelay="100">
                <font  style="position: relative;">
                    <a href="announcement.php" target="main" id="Affiche" class="NewS_Fone">
                    <?php while ($row = mysql_fetch_array($pao)) { ?>
                    
〖<?php
//将时区设置为中国
date_default_timezone_set("PRC");
echo date("Y-m-d H:i:s ");
//例输出：2010-03-06 Saturday 11:51:29 AM
?>〗※<?php  echo $row['content'];?>&nbsp;&nbsp;&nbsp;&nbsp;
                    <?php }?>
                    </a>
                </font>
                </marquee>
                </a>
                <input name="ids" id="ids" value="tm" type="hidden"></td>
            </tr>
          </tbody>
        </table></td>
    </tr>
    <b><tr>
    
    
      <td id="TypeBackdrop" class="" height="25" valign="top">
      <span id="Type_List" style="position: relative; top: 0; left: 10px;"> 
      <?php if(!in_array("特码",$w_close_type)){ ?>    
      <a href="odds.php?spul=18" target="main"  class="title1" onClick="rl_rl1(rl6);">
      <span id="rl6" style="color:ff0000;">特码</span></a> | 
      <?php }if(!in_array("正特",$w_close_type)){ ?>
      <a href="odds.php?o=18&spul=19" target="main" class="title1" onClick="rl_rl1(rl7);">
      <span id="rl7" style="color:003366;">正特码</span></a> | 
      <a href="odds.php?o=20&spul=20" target="main" class="title1" onClick="rl_rl1(rl8);">
      <span id="rl8" style="color:003366;"></span></a>
      <a href="odds.php?o=22&spul=21" target="main" class="title1" onClick="rl_rl1(rl15);">
      <span id="rl15" style="color:003366;"></span></a>
      <a href="odds.php?o=24&spul=22" target="main" class="title1" onClick="rl_rl1(rl9);">
      <span id="rl9" style="color:003366;"></span></a>
      <a href="odds.php?o=26&spul=23" target="main" class="title1" onClick="rl_rl1(rl10);">
      <span id="rl10" style="color:003366;"></span></a>
      <a href="odds.php?o=28&spul=24" target="main" class="title1" onClick="rl_rl1(rl11);">
      <span id="rl11" style="color:003366;"></span></a>
      <a href="odds.php?o=30&spul=25" target="main" class="title1" onClick="rl_rl1(rl12);">
      <?php }if(!in_array("平码",$w_close_type)){ ?>    
      <span id="rl12" style="color:003366;">平码</span></a> | 
      <?php }if(!in_array("连码",$w_close_type)){ ?>
      <a href="lm.php?spul=26" target="main" class="title1" onClick="rl_rl1(rl13);">
      <span id="rl13" style="color:003366;">连码</span></a> | 
      <?php }if(!in_array("自选不中",$w_close_type)){ ?>
      <a href="bz.php?spul=27"  target="main" class="title1" onClick="rl_rl1(rl14);">
      <span id="rl14" style="color:003366;">自选不中</span></a> | 
      <?php }if(!in_array("特肖",$w_close_type)){ ?>
      <a href="tx.php?spul=71" target="main" class="title1" onClick="rl_rl1(rl17);">
      <span id="rl17" style="color:003366;">特肖</span></a> | 	
      <?php }if(!in_array("特码②—⑥肖",$w_close_type)){ ?>
      <a href="dsq.php?spul=72" target="main" class="title1" onClick="rl_rl1(rl24);">
      <span id="rl24" style="color:003366;">特码②—⑥肖</span></a> | 
      <?php }if(!in_array("平特一肖尾数",$w_close_type)){ ?>
      <a href="qws.php?spul=73" target="main"  class="title1" onClick="rl_rl1(rl23);">
      <span id="rl23" style="color:003366;">平特一肖尾数</span></a> | 
      <?php }if(!in_array("生肖连",$w_close_type)){ ?>
      <a href="sql.php?spul=29" target="main" class="title1" onClick="rl_rl1(rl18);">
      <span id="rl18" style="color:003366;">生肖连</span></a> | 
      <?php }if(!in_array("尾数连",$w_close_type)){ ?>
      <a href="wsl.php?spul=30" target="main" class="title1" onClick="rl_rl1(rl19);">
      <span id="rl19" style="color:003366;">尾数连</span></a> | 
      <?php }if(!in_array("半波",$w_close_type)){ ?>
      <a href="bb.php?spul=31" target="main" class="title1" onClick="rl_rl1(rl20);">
      <span id="rl20" style="color:003366;">半波</span></a> | 
      <?php }if(!in_array("综合过关",$w_close_type)){ ?>
      <a href="gg.php?spul=32" target="main" class="title1" onClick="rl_rl1(rl21);">
      <span id="rl21" style="color:003366;">综合过关</span></a> 
      <?php }?>

      </span></td>
    </tr>
  </tbody>
</table></b>

<!--<script>alert('qqqaaaaaaaaa');</script> -->
<script src="/js/jquery.js"></script>
<div id="msgfrm"></div>
<div id="LT_DIV" style="position: absolute; top: 62px; left: 25px; margin-left: 45px;">
  <strong><font id="Clock" color="light blue"><script language="JavaScript">tick();
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
<script type="text/javascript">
function usermessage(message){
	alert(message);
}

setInterval(function(){
    $("#msgfrm").load("msg.php?uid=<?php echo $uid?>&t="+Math.random());
}, 3000);

</script>
</body>
</html>