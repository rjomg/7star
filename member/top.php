<?php
  include_once ('../global.php');
  $db = new action($mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset); //数据库操作类.
  if($_GET[action]=='logout')$db->Get_user_out($client_location['country']);//如果为真 那么退出
  $pao = mysql_query("select * from system_marquee where type=0 and (user='all_all' or user='all_user') order by datetime desc");
?>

<?php $w_close_type = explode(',', $system_setting['w_close_type']);?>

<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 

<link rel="stylesheet" type="text/css" id="css" href="./css/members.css">
<style>html{overflow-y:scroll;overflow-x:hidden;}</style>
<script src="js/common.js" type="text/javascript"></script>
<script src="js/showorderhtml.js" type="text/javascript"></script>
<script src="js/frank.js" type="text/javascript"></script>
<script src="js/ajax.js" type="text/javascript"></script>
<script src="js/showdate.js" type="text/javascript"></script>
<script type="text/javascript" src="js/json2.js"></script> 

<style media="print"> 
  .Noprint{display:none;}
  @page {
    size: auto; 
    margin: 0;
  }
  html{
        background-color: #FFFFFF;
        margin: 0px; 
    }
    body{
        margin: 5mm 5mm 5mm 5mm;
    }
</style> <script>
  function sethighlight(n) {
    var lis = document.getElementsByTagName('li');
    for(var i = 0; i < lis.length; i++) {
      lis[i].id = '';
    } 
    lis[n].id = 'menuon';
  }
</script>
<style>
  body{
    font-size:14px;
    /*background:url("./images/bg_2.gif") repeat fixed!important;*/
    /*background-image:url("./images/bg_2.gif") repeat fixed!important;*/
    /*background:url("./images/bg_1.gif") repeat fixed!important;*/
    background-image:url("./images/bg_1.gif") repeat fixed!important;
    background-size:cover;
  }

  .meuntop:hover{
      text-decoration:none;
      color:red !important;
  }
</style>
</head>
<body>
<table width="100%" border="0" height="90px" cellpadding="0" cellspacing="0" class="topmenubg">
  <tr>
    <td rowspan="3" width="200px" height="90px"></td>
    <td>
  <div class="topmenu">
    <ul>
      <li><span><a href="#" onclick="sethighlight(0);self.parent.location=&#39;loby.php&#39;;">换线路</a></span></li>
      <li><span><a href="#" onclick="sethighlight(0);parent.main.location=&#39;orderadmin.php&#39;;return false;">下注明细</a></span></li>
      <li><span><a href="#" onclick="sethighlight(1);parent.main.location=&#39;memberhistory.php&#39;;return false;">历史账单</a></span></li>
      <li><span><a href="#" onclick="sethighlight(2);parent.main.location=&#39;memberdata.php&#39;;return false;">会员资料</a></span></li>
      <li><span><a href="#" onclick="sethighlight(3);parent.main.location=&#39;memberaward.php&#39;;return false;">开奖号码</a></span></li>
      <li><span><a href="#" onclick="sethighlight(4);parent.main.location=&#39;memberrule.php&#39;;return false;">规则说明</a></span></li>
      <li><span><a href="#" onclick="sethighlight(5);parent.main.location=&#39;memberlogs.php&#39;;return false;">日志</a></span></li>
      <li><span><a href="#" onclick="sethighlight(6);parent.main.location=&#39;memberpass.php&#39;;return false;">修改密码</a></span></li>
      <li><span><a href="#" onclick="sethighlight(7);parent.location=&#39;top.php?action=logout&#39;;return false;">退出</a></span></li>
      <li id="cgchat_num" class="cgchat_emain_yes">1</li>
    </ul>
  </div>
  <div style="width:30%;z-index:1;position:absolute;bottom:0%;left:42%;height:30%;"> 
    <!-- <marquee scrolldelay="400" style="color=#000000;height:100%"> 
      <div id="news">
        <a href="" style="text-decoration:none;color:#FFF;">
          <font style="font-size:16px;font-family:Microsoft JhengHei;">
          ●●●【欢迎光临!】
          ●●●【会员】【（1,2,3,5,6,7,8,9）a.1380000138.com】●●●【会员备用】【（1111,2222,3333,5555）a.1380000138.com】
          ●●●【管理】【（1,2,3,5,6,7,8,9）b.1380000138.com】●●●【管理备用】【（1111,2222,3333,5555）b.1380000138.com】
          ●●●【通知网永久网址xp.2020209.com和xxxx999.com※※ ※通知码：2sw27a】
          ●●●【 原来是用（手工抄数），现在可以用（程序抄数）了，请上网址（xx007.cc)下载（抄数助手），使用它可以减少工作量，提高效率。】
          ●●●【温馨提示】各位会员在下注确定后请到“下注明细”里确认注单，一切注单结算以下注明细里资料为准！】
          ●●●【本公司七星彩开盘时间为每周 一 。四。六。  13:40开盘。开奖日当晚20:18分封盘！】
          </font>
        </a>
      </div>
    </marquee> -->
  </div>
<!--   <div id="timeTag" style="width:20%;z-index:1;position:absolute;bottom:0%;right:0%;height:40%;font-size:16px;font-family:Microsoft JhengHei;color:white;">离停盘时间：2分10秒</div>-->
    </td>
  </tr>
  <tr>
    <td height="23px" align=center>
      <table width="100%" border="0" cellpadding="0" cellspacing="0" align=center>
      <tr>
        <TD width="100"  style="color:#ffff00;font-size: 18px;">
          七星彩     
        </TD>
      <td  align=center style=" width:380px;">
      <div style=" width:380px;  z-index:1;margin-top:1px;margin-right:10px"> 
        <marquee scrolldelay=400 style="color=#000000;height:15px"> 
          <div id="news"></div>
        </marquee>
      </div>
  
      </td><td width="*"><div id="timeTag"></div></td>
        </tr>
        </table>
    </td>
  </tr>
      <tr class="erzi" >
        <td >
        &nbsp;&nbsp;
        <a href="#" id="setsoon4" name="setsoon" onclick="parent.main.location=&#39;numberfrank.php&#39;;ClickThisItem(this);return false;" style="color: white;" class="meuntop ">二字定</a>&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="#" id="setsoon1" name="setsoon" onclick="parent.main.location=&#39;soonhitmain.php&#39;;ClickThisItem(this);return false;" style="color: #f83535;" class="meuntop ">快打</a>&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="#" id="setsoon2" name="setsoon" onclick="parent.main.location=&#39;odds.php&#39;;ClickThisItem(this);return false;" style="color: white;" class="meuntop">快选</a>&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="#" id="setsoon3" name="setsoon" onclick="parent.main.location=&#39;soonhot.php&#39;;ClickThisItem(this);return false;" style="color: white;" class="meuntop">赔率变动表</a>&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="#" id="setsoon5" name="setsoon" onclick="parent.main.location=&#39;memberinput.php&#39;;ClickThisItem(this);return false;" style="color: white;" class="meuntop">txt导入</a>&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="http://www.jiangcho.com" id="setsoon6" name="setsoon" style="color: white;" class="meuntop">（奖虫）APP</a>&nbsp;&nbsp;&nbsp;&nbsp;  
        <span id="sound" style="display:none;margin:0px;margin:0px;border:0px;z-index:2;top:0px;"></span>
        </td> 
    </tr>
</table>
<script language="JavaScript">
  var _openstart;
  var _sellBegTime;
  var _sellEndTime;
  var _systemTime;
  var issueno_old = 0;
  
  var local_hash = 'cddf1befb3e14856911e51a38349662a';
  
  var Imgurl= "./admincg/images/";
  var action = "news";
  
  function ClickThisItem(t){
    var item = document.getElementsByName('setsoon');
    for(var i=1; i<=item.length; i++){
      document.getElementById('setsoon' + i).style.color = 'white';
    }
    t.style.color = 'red';
    //top.main.document.getElementById('main').setAttribute('class','flipx');
  }
  
  function showCloseFrame(){
    if(parent.window.frames['main'].frames[0] == undefined){
      var title = parent.window.frames['main'].document.title;
      switch(title){
        case 'numberfrank':
          parent.window.frames['main'].location.href = 'closeframe.php?from=TwoDingMode1';
          break;
        case 'numberfrank1':
          parent.window.frames['main'].location.href = 'closeframe.php?from=TwoDingMode2';
          break;
        case 'memberinput':
          parent.window.frames['main'].location.href = 'closeframe.php?from=TxtInput';
          break;
        default:
          break;
      }
    }else{
      var title = parent.window.frames['main'].frames[0].document.title
      switch(title){
        case 'main_ifr1':
          parent.window.frames['main'].frames[0].location.href = 'closeframe.php?from=QuickOrder';
          break;
        case 'soonselectmain_ifr1':
          parent.window.frames['main'].frames[0].location.href = 'closeframe.php?from=QuickSelect';
          break;
        default:
          break;
      }
    }
  }

  function donews(str){
    if (str != null && str != ""){
      str = JSON.parse(str);      
//       str = {"systime":1483109777,"starttime":1483109400,"endtime":1483109670,"openmode":1,"issueno":"161230108","hash":"cddf1befb3e14856911e51a38349662a"};
      _sellBegTime = str['starttime'];
      _sellEndTime  = str['endtime'];
      _systemTime = str['systime'];
      _openstart = str['openmode'];
      issueno = str['issueno'];
      return_hash = str['hash'];
      parent.menu.document.getElementById('my_issueno_now').innerHTML = issueno;
      if (_openstart != "" || _openstart==0){
        $('news').innerHTML = "<a href='#' style='text-decoration:none;color:#FFF;'><font style='font-size:16px;font-family:Microsoft JhengHei;'><?php while ($row = mysql_fetch_array($pao)) { ?><?php  echo $row['content'];?><?php }?></font></a>";
      }
      if(local_hash != return_hash){
        alert('目前系统在同一个浏览器上只能登入一个会员，如果想同时操作复数个会员，请用复数个浏览器!!');
        top.location.href = '/';
      }
      if(issueno != issueno_old && issueno_old != 0){
        parent.location.href = 'loby.php';
      }else if(issueno_old == 0){
        issueno_old = issueno;
      }
    }
  }
  function newsinfo(){
    ajax('POST',"ajax/ajax.php",true,"",donews);
  }
  newsinfo();
  
  startTime();
  setInterval("newsinfo()",23000);  
</script>
</body></html>