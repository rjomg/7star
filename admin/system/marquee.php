<?php
include_once( "../../global.php" );
date_default_timezone_set( "PRC" );
error_reporting( 0 );
$power = $_GET['power'];
$page = $_GET['page'];
if ( !$page )
{
		$page = 1;
}
$start = ( $page - 1 ) * 10;
$get_user_limit = $_GET['get_user_limit'];
$t1 = $_GET['t1'];
$t2 = $_GET['t2'];
$db = new action( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
$user_limit = $db->get_user_limit_char( $get_user_limit, $t1, $t2 );
if ( $user_limit )
{
		$all_page = $db->get_page( "users", "`user_power` = '".$power."' and ".$user_limit, 10 );
		$query = $db->select( "users", "*", "`user_power` = '".$power."' and ".$user_limit." limit ".$start.",10" );
}
else
{
		$all_page = $db->get_page( "users", "`user_power` = '".$power."'", 10 );
		$query = $db->select( "users", "*", "`user_power` = '".$power."' limit ".$start.",10" );
}
$user_char = $db->get_user_power_char( $power );
echo $_GET['cot'];
echo $_GET['cuser'];
echo $_GET['lx'];
echo $user_id;
$query = $db->select( "system_marquee", "*", " 1 order by datetime desc limit 0,50" );
echo "<html oncontextmenu=\"return false\" xmlns=\"http://www.w3.org/1999/xhtml\">\n<head>\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">\n";
echo "<s";
echo "tyle type=\"text/css\">\n<!--\nbody {\n\tmargin-left: 0px;\n\tmargin-top: 0px;\n\tmargin-right: 0px;\n\tmargin-bottom: 0px;\n}\n-->\n</style>\n";
echo "<s";
echo "cript>\nif(self == top) {location = '/';} \nif(window.location.host!=top.location.host){top.location=window.location;}</script>\n</head>\n\n<body  onselect=\"document.selection.empty()\" oncopy=\"document.selection.empty()\" onmouseover=\"self.status='歡迎光臨';return true\">\n";
echo "<s";
echo "cript language=\"JavaScript\">\nfunction send_request(url){//初始化，指定處理函数，發送請求的函数\n    http_request=false;\n    //開始初始化XMLHttpRequest對象\n    if(window.XMLHttpRequest){//Mozilla瀏覽器\n     http_request=new XMLHttpRequest();\n     if(http_request.overrideMimeType){//設置MIME類別\n       http_request.overrideMimeType(\"text/xml\");\n     }\n    }\n    else if(window.ActiveXObject){//IE瀏覽";
echo "鱘n     try{\n      http_request=new ActiveXObject(\"Msxml2.XMLHttp\");\n     }catch(e){\n      try{\n      http_request=new ActiveXobject(\"Microsoft.XMLHttp\");\n      }catch(e){}\n     }\n    }\n    if(!http_request){//異常，創建對象實例失敗\n     window.alert(\"創建XMLHttp對象失敗！\");\n     return false;\n    }\n    http_request.onreadystatechange=processrequest;\n    //確定發送請求方式，URL，及是否同步執行下段";
echo "代码\n    http_request.open(\"GET\",url,true);\n    http_request.send(null);\n  }\n  //處理返回信息的函数\n  function processrequest(){\n   if(http_request.readyState==4){//判斷對象狀態\n     if(http_request.status==200){//信息已成功返回，開始處理信息\n\t \n      document.getElementById(reobj).innerHTML=http_request.responseText;\n\t  \n     }\n     else{//頁面不正常\n      alert(\"您所請求的頁面不正常！\");\n     }\n";
echo "   }\n  }\n  function dopage(obj,url){\n  // document.getElementById(obj).innerHTML=\"正在讀取数據...\";\n   send_request(url);\n   reobj=obj;\n   } \n   \n function C_Key(){\n\tdopage('result','?spul=DGUHW1EyVnRWeVsu&page=1');\n}\nfunction SubChk()\n{\n\t\tif(document.all.cuser.value=='')\n{ document.all.cuser.focus(); alert(\"用户请输入!!\"); return false; }\n\t\tif(document.all.cot.value=='')\n{ document.all.cot.focus(";
echo "); alert(\"内容請務必輸入!!\"); return false; }\n\t//document.getElementById('Submit').disabled = true;\n\t\n}\n\n</script>\n\n";
echo "<s";
echo "cript src=\"../js/jquery-1.4.3.min.js\" type=\"text/javascript\"></script>\n";
echo "<s";
echo "cript language=\"javascript\">\n\n\$(document).ready(function ()\n{\n\t\$('#send_ajax').click(function (){\n\t\n\t\n\tvar cuser = \$('#cuser').val();\n\t  if(cuser==\"\"){\n              alert(\"用户请输入!!\");\n                return false;\n            }\n\t\t\t\n\tvar cot = \$('#cot').val();\n\t  if(cot==\"\"){\n              alert(\"内容請務必輸入!!\");\n                return false;\n            }\n\n    \$.post(\n      'ajax.php',\n   ";
echo "   {\n        cuser:\$('#cuser').val(),\n        cot:\$('#cot').val(),\n\t\taction:'addmar',\n        aa:\$('input:radio[name=\"aa\"]:checked').val()\n      },\n      function (data) //回传函数\n      {\n\t\tif(data == 1){\n\t\t\t\n\t\t\talert(\"添加成功!\");\n\t\t\thistory.go(0);\n\t\t}else{\n\t\t\talert(\"添加失败!\");\t\n\t\t}\n        \n      }\n    );\n\t\n   });\n   \n  \$('.mar_del').click(function (){\n   var mid = \$(this).next(\".mid\").val();";
echo "\n\t\n\t\$.get(\"ajax.php\", { id: mid, action: \"mardel\" },\n\t  function(data){\n\t\tif(data == 1){\n\t\t\t\n\t\t\talert(\"删除成功!\");\n\t\t\thistory.go(0);\n\t\t}else{\n\t\t\talert(\"删除失败!\");\t\n\t\t}\n\t  });\n\t// alert(mid);\n  });\n   \n});\n\t\n\n</script>\n<link href=\"../images/Index.css\" rel=\"stylesheet\" type=\"text/css\">\n<link href=\"../css/admincg.css\" rel=\"stylesheet\" type=\"text/css\">\n";
echo "<s";
echo "tyle type=\"text/css\">\n<!--\n.STYLE1 {color: #344B50}\n-->\n</style>\n\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"99%\" style=\"margin:auto;\">\n  <tbody>\n    <tr class=\"header\">\n      <td background=\"../css/bg_list.gif\" height=\"25\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n          <tbody>\n            <tr>\n              <td height=\"25\" width=\"12\"><img src=\"../css/bg_list.gif\" height=\"25\" width=\"12\"></td>\n      ";
echo "        <td><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n                  <tbody>\n                    <tr>\n                      <td valign=\"middle\" width=\"87%\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n                          <tbody>\n                            <tr>\n                              <td width=\"1%\"><div align=\"center\">";
echo "</div></td>\n                              <td class=\"F_bold\" width=\"32%\" style=\"color:#fff;\">公告提示</td>\n                              <td class=\"F_bold\" width=\"33%\">&nbsp;</td>\n                              <td valign=\"middle\" width=\"34%\">&nbsp;</td>\n                            </tr>\n                          </tbody>\n                        </table></td>\n                    </tr>\n                  </tbody>\n     ";
echo "           </table></td>\n              <td width=\"16\"><img src=\"../css/bg_list.gif\" height=\"25\" width=\"16\"></td>\n            </tr>\n          </tbody>\n        </table></td>\n    </tr>\n    <tr>\n      <td><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n          <tbody>\n            <tr>\n <td align=\"center\" height=\"2";
echo "00\"><!-- 開始  -->\n                <div id=\"result\">\n                  <table class=\"Ball_List Tab\" border=\"0\" bordercolor=\"#ECE9D8\" cellpadding=\"1\" cellspacing=\"1\" width=\"100%\">\n                    <form action=\"\" method=\"post\" name=\"testFrm\" target=\"downf\" id=\"testFrm\">\n                   \n                    <tbody>\n                      <tr>\n                        <td bordercolor=\"#CCCCCC\" align=\"ri";
echo "ght\" bgcolor=\"#E7EFF8\" height=\"30\" width=\"11%\">用户账号：</td>\n                        <td bordercolor=\"#CCCCCC\" bgcolor=\"#FFFFFF\" height=\"30\">\n                          <input name=\"cuser\" class=\"input1\" id=\"cuser\" value=\"all_all\" size=\"10\" type=\"text\">\n                          ";
echo "<s";
echo "pan>如果想发布给所有用户请输入：</span>";
echo "<s";
echo "pan class=\"STYLE4 Font_R\">all_all ";
echo "<s";
echo "pan class=\"STYLE1\">只发代理：</span>all_ag ";
echo "<s";
echo "pan class=\"STYLE1\">只发会员：</span>all_user </span></td>\n                      </tr>\n                      <tr>\n                        <td bordercolor=\"#CCCCCC\" align=\"right\" bgcolor=\"#E7EFF8\" height=\"30\">公告类型：</td>\n                        <td bordercolor=\"#CCCCCC\" bgcolor=\"#FFFFFF\" height=\"30\">\n                         \n                          <input name=\"aa\"  id=\"aa\" value=\"0\" size=\"10\"  checke";
echo "d=\"checked\" type=\"radio\">\n                          普通跑马灯\n                          \n                          <input name=\"aa\"  id=\"aa\" value=\"1\" size=\"10\"   type=\"radio\">\n                          弹出公告</td>\n                      </tr>\n                      <tr>\n                        <td bordercolor=\"#CCCCCC\" align=\"right\" bgcolor=\"#E7EFF8\" height=\"30\">公告内容：</td>\n                       ";
echo " <td bordercolor=\"#CCCCCC\" bgcolor=\"#FFFFFF\" height=\"30\"><textarea name=\"cot\" cols=\"70\" rows=\"3\" class=\"input1\" id=\"cot\"></textarea></td>\n                      </tr>\n                      <tr>\n                        <td bordercolor=\"#CCCCCC\" bgcolor=\"#E7EFF8\" height=\"58\">&nbsp;</td>\n                        <td bordercolor=\"#CCCCCC\" bgcolor=\"#FFFFFF\"><br>\n                          \n                         ";
echo " <input class=\"button_a\" name=\"Submit\" value=\"发表\" id=\"send_ajax\" type=\"submit\">\n                          <br>\n                        </td>\n                      </tr>\n                    </tbody>\n                     </form>\n                  </table>\n                  <table bordercolordark=\"#FFFFFF\" class=\"Ball_List Tab\" align=\"center\" bgcolor=\"cccccc\" border=\"0\" bordercolor=\"0\" cellpadding=\"1\" cell";
echo "spacing=\"1\" width=\"100%\">\n                    <tbody>\n                      <tr class=\"\">\n                        <td bgcolor=\"#DFEFFF\" height=\"22\" width=\"79\" ><div align=\"center\" class=\"\"> NO </div></td>\n                        <td bgcolor=\"#DFEFFF\" width=\"80\"><div class=\"STYLE3\" align=\"center\">账号</div></td>\n                        <td bgcolor=\"#DFEFFF\" width=\"80\">类型</td>\n                   ";
echo "     <td bgcolor=\"#DFEFFF\" width=\"150\">时间</td>\n                        <td bgcolor=\"#DFEFFF\" width=\"926\">内容</td>\n                        <td bgcolor=\"#DFEFFF\" nowrap=\"nowrap\" width=\"100\"><div class=\"STYLE3\" align=\"center\">操作</div></td>\n                      </tr>\n\t\t\t\t\t  ";
while ( $row = $db->fetch_array( $query ) )
{
		echo "\t\t\t\t\t\t\n                      <tr>\n                        <td bgcolor=\"#FFFFFF\" height=\"25\"><div align=\"center\"> ";
		echo $row['id'];
		echo "</div></td>\n                        <td align=\"center\" bgcolor=\"#FFFFFF\" height=\"25\"> ";
		echo $row['user'];
		echo " </td>\n                        <td align=\"center\" bgcolor=\"#FFFFFF\" height=\"25\">";
		if ( $row['type'] == 1 )
		{
				echo "弹出";
		}
		else
		{
				echo "普通";
		}
		echo "</td>\n                        <td align=\"center\" bgcolor=\"#FFFFFF\" height=\"25\" nowrap=\"nowrap\">";
		echo date( "Y-m-d H:i:s", $row['datetime'] );
		echo "</td>\n                        <td align=\"left\" bgcolor=\"#FFFFFF\" height=\"25\"><font color=\"666666\"> ";
		echo $row['content'];
		echo " </font></td>\n                        <td bgcolor=\"#FFFFFF\" nowrap=\"nowrap\"><div align=\"center\"> \n\t\t\t\t\t\t<!--<a href=\"./marquee.php?id=\" onclick='{if(confirm(\"您確定刪除嗎?此操作將不能恢復!\")){return   true;}return   false;}' target=\"content\">刪除</a> \n\t\t\t\t\t\t--><a href=\"javascript:void(0);\" class=\"mar_del\" >删除</a>\n\t\t\t\t\t\t<input value=\"";
		echo $row['id'];
		echo "\" name=\"mid\" id=\"mid\" class=\"mid\" type=\"hidden\"/>\n\t\t\t\t\t\t</div></td>\n                      </tr>\n\t\t\t\t\t ";
}
echo "                     \n                    </tbody>\n                  </table>\n                </div>\n                <!-- 結束  --></td>\n            </tr>\n          </tbody>\n        </table></td>\n    </tr>\n  </tbody>\n</table>\n</body>\n</html>";
?>
