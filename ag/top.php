<?php

include_once ('../global.php');

$db = new action($mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset); //数据库操作类.

$uid=$_SESSION['uid'.$c_p_seesion];

if($_SESSION['uid'.$c_p_seesion]>0){

$queryusers=  $db->select("users", "is_odds,is_add,is_extend", "user_id={$_SESSION['uid'.$c_p_seesion]}");

$user = $db->fetch_array($queryusers);

}

$username = $_SESSION['username'.$c_p_seesion];

if($_GET['action']=='logout')$db->Get_user_out($client_location['country']);//如果为真 那么退出
$pao = mysql_query("select * from system_marquee where type=0 and (user='all_all' or user='all_user') order by datetime desc");

$power=$db->get_one('select user_power from users where user_id='.$uid);
?>

<html>

 <head>

  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 

  <link href="./css/admincg.css" rel="stylesheet" type="text/css" /> 

  <title></title> 

  <script src="./js/common.js" type="text/javascript"></script> 

  <script src="./js/menu.js" type="text/javascript"></script> 

  <script src="./js/ajax.js" type="text/javascript"></script> 

  <script src="./js/frank.js" type="text/javascript"></script> 

  <script src="./js/json2.js" type="text/javascript"></script> 

  <script src="./images/Top.js" type="text/javascript"></script> 

  <style media="print"> .Noprint{display:none;}</style>

  <script src="./js/showdate.js" type="text/javascript"></script> 

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

  <table width="100%" border="0" cellpadding="0" cellspacing="0" class="topmenubg"> 

   <tbody>

    <tr> 

     <td style="text-align:center;" rowspan="2" width="10%"> <span class="editiontext">&nbsp;&nbsp; 代理：<?php echo $username?> </span> <input name="bb" id="bb" value="4" type="hidden" /> <input name="cc" id="cc" value="0" type="hidden" /> </td> 

     <td height="21" class="marquees" width="75%"> 

      <marquee scrolldelay="400" style="height:18px;width:50%;"> 

       <div id="news">

        <a href="#" style="text-decoration:none;color:#fff;font-size:14px;font-family:Microsoft JhengHei;">1.用户明确同意本系统的使用由用户个人承担风险。 2.本系统不作任何类型的担保，不担保服务一定能满足用户的要求，也不担保服务不会受中断，对服务的及时性，安全性，出错发生都不作担保。 用户理解并接受，任何通过本系统服务取得的信息资料的可靠性取决于用户自己，用户自己承担所有风险和责任。 3.本声明的最终解释权归本系统所有。 特别提醒：本公司如果输入开奖结果错误，有权利更正开奖结果，最终以官方最后公布结果来结账，不得异议。</a>

       </div> 

      </marquee> </td> 

<!--      <td rowspan="2" style="text-align:center;vertical-align:middle;" width="15%"> 

      <div style="text-align:center;vertical-align:middle;font-size:16px;font-family:Microsoft JhengHei;" id="issuenoTag">

       当前期数：

      </div> 

      <div style="text-align:center;vertical-align:middle;font-size:16px;font-family:Microsoft JhengHei;margin-top:3px;" id="timeTag">

       离停盘时间：4分54秒

      </div> </td>  -->

    </tr> 

    <tr> 

     <td> 

      <div class="topmenu" style="width:50%;min-width:600px;"> 

       <ul> 

        <li id=""><span><a href="javascript:;" onclick="sethighlight(0); parent.main.location='main.php';return false;">首页</a></span></li> 

        <li id=""><span><a href="javascript:;" onclick="sethighlight(1); Limit_URL('reports/awardreadadmin.php')">总货明细</a></span></li> 

        <li id=""><span><a href="javascript:;" onclick="sethighlight(2);Limit_URL('reportclass/reportclass.php');">分类帐</a></span></li> 

        <li id=""><span><a href="javascript:;" onclick="sethighlight(3);Limit_URL('reports/report.php?spul=55&bet=1');">报表</a></span></li> 

        <li id="menuon"><span><a href="javascript:;" onclick="sethighlight(4);Limit_URL('plate/his.php?spul=61');">开奖号码</a></span></li> 

        <li id=""><span><a href="javascript:;" onclick="sethighlight(5);Loading_But1(1);Loading_But(1,2);SelectType1(1,1);Limit_URL('user/branch.php?power=<?php echo $power['user_power']+1;?>&spul=59','main','AT0!888','XedUgVHvUvVSzg+8','分公司');">下级管理</a></span></li> 

        <li id=""><span><a href="javascript:;" onclick="sethighlight(6); parent.main.location='logsuser.php?action=logsuser2';return false;">日志</a></span></li> 

        <li id=""><span><a href="javascript:;" onclick="sethighlight(7);Loading_But1(1);Loading_But(1,1);SelectType1(1,1);Limit_URL('immediate/tm.php?spul=60&x1=WZgA21TnUTw!888&x2=Xp9WjVDjBGlVQw!888!888','tm','XJ0G3VHiUD1eSA!888!888','特码A');">设置</a></span></li> 

        <li id=""><span><a href="javascript:if(confirm('确定退出？')){ go_web('top.php?action=logout')}; " target="_top">退出</a></span></li> 

        <!-- <li style="border:0px;">

        </li> -->

       </ul> 

      </div> 

      <div><div style="text-align:center" id="issuenoTag"></div><div style="text-align:center;vertical-align:middle;font-size:14px;font-family:Microsoft JhengHei;margin-top:3px;" id="timeTag"></div></div>

      </td> 

    </tr> 

   </tbody>

  </table> 

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

          $('news').innerHTML = "<a href=header.php style='text-decoration:none;color:#fff;font-size:14px;font-family:Microsoft JhengHei;'><?php while ($row = mysql_fetch_array($pao)) { ?><?php  echo $row['content'];?><?php }?></a>";

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