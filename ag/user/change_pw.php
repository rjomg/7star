<?php
include_once( "../../global.php" );
$db = new plate( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
$db2 = new plate( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
$uid = $zizhanghaodenglu[1];
$info = mysql_fetch_array( mysql_query( "select * from users  where user_id = '{$uid}'" ) );
if ( $_POST['Submit'] )
{
		$pass1 = $_POST['pass'];
		$pass = md5( $pass1 );
		$password = $_POST['pass2'];
		$password = md5( $password );
		if ( $pass == $info['user_pwd'] )
		{
				$query = $db->query( "UPDATE `users` SET `user_pwd`='{$password}' where user_id='{$uid}'" );
				if ( $query )
				{
						echo " <script> alert( 'ÐÞ¸Ä³É¹¦¡£ ') ; location.href= 'change_pw.php'; </script> ";
				}
		}
		else
		{
				echo " <script> alert( 'Ô­ÃÜÂë´íÎó¡£ ') ; location.href= 'change_pw.php'; </script> ";
		}
}
echo "<html oncontextmenu=\"return false\" xmlns=\"http://www.w3.org/1999/xhtml\"><head>\r\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">\r\n";
echo "<s";
echo "tyle type=\"text/css\">\r\n<!--\r\nbody {\r\n\tmargin-left: 0px;\r\n\tmargin-top: 0px;\r\n\tmargin-right: 0px;\r\n\tmargin-bottom: 0px;\r\n}\r\n-->\r\n</style>\r\n";
echo "<s";
echo "cript>\r\nif(self == top) {location = '/';} \r\nif(window.location.host!=top.location.host){top.location=window.location;}</script>\r\n</head>\r\n<body oncontextmenu=\"return false\" onselect=\"document.selection.empty()\" oncopy=\"document.selection.empty()\" onmouseover=\"self.status='šgÓ­¹âÅR';return true\">\r\n<link href=\"../images/Index.css\" rel=\"stylesheet\" type=\"text/css\">\r\n ";
echo "<s";
echo "cript language=\"JavaScript\">\r\nfunction send_request(url){//³õÊ¼»¯£¬Ö¸¶¨ÌŽÀíº¯Êý£¬°lËÍÕˆÇóµÄº¯Êý\r\n    http_request=false;\r\n    //é_Ê¼³õÊ¼»¯XMLHttpRequestŒ¦Ïó\r\n    if(window.XMLHttpRequest){//MozillažgÓ[Æ÷\r\n     http_request=new XMLHttpRequest();\r\n     if(http_request.overrideMimeType){//ÔOÖÃMIMEî„e\r\n       http_request.overrideMimeType(\"text/xml\");\r\n     }\r\n    }\r\n    else if(window.ActiveXObject)";
echo "{//IEžgÓ[Æ÷\r\n     try{\r\n      http_request=new ActiveXObject(\"Msxml2.XMLHttp\");\r\n     }catch(e){\r\n      try{\r\n      http_request=new ActiveXobject(\"Microsoft.XMLHttp\");\r\n      }catch(e){}\r\n     }\r\n    }\r\n    if(!http_request){//®³££¬„“½¨Œ¦ÏóŒÀýÊ§”¡\r\n     window.alert(\"„“½¨XMLHttpŒ¦ÏóÊ§”¡£¡\");\r\n     return false;\r\n    }\r\n    http_request.onreadystatechange=processrequest;\r\n    //´_¶¨°lËÍÕˆÇó·½Ê½£";
echo "¬URL£¬¼°ÊÇ·ñÍ¬²½ˆÌÐÐÏÂ¶Î´úÂë\r\n    http_request.open(\"GET\",url,true);\r\n    http_request.send(null);\r\n  }\r\n  //ÌŽÀí·µ»ØÐÅÏ¢µÄº¯Êý\r\n  function processrequest(){\r\n   if(http_request.readyState==4){//ÅÐ”àŒ¦Ïó î‘B\r\n     if(http_request.status==200){//ÐÅÏ¢ÒÑ³É¹¦·µ»Ø£¬é_Ê¼ÌŽÀíÐÅÏ¢\r\n\t// alert(http_request.responseText);\r\n\t \tif(http_request.responseText == 1){\r\n\t\t\t\r\n\t\t\talert(\"²Ù×÷³É¹¦!\");\r\n\t\t\thistory.go(0);";
echo "\r\n\t\t\t}else{\r\n\t\t\talert(\"²Ù×÷Ê§°Ü!\");\t\r\n\t\t\t\t}\r\n      //document.getElementById(reobj).innerHTML=http_request.responseText;\r\n\t\r\n     }\r\n     else{//í“Ãæ²»Õý³£\r\n      alert(\"ÄúËùÕˆÇóµÄí“Ãæ²»Õý³££¡\");\r\n     }\r\n   }\r\n  }\r\n  function dopage(obj,url){\r\n\t//  alert(obj+url);\r\n \t document.getElementById(obj).innerHTML=\"ÕýÔÚ×xÈ¡Êý“þ...\";\r\n   send_request(url);\r\n   reobj=obj;\r\n   } \r\n   \r\n\r\n\r\n function C_Key()";
echo "{\r\n\t//var key=document.all.key.value;\r\n\t\t//alert(1);\r\n\t//dopage('result','?action=selectlog&key='+key+'&page=1');\r\n\tlocation.href='change_pw.php?action=selectuser&key='+key+'&page=1';\r\n\t\r\n}\r\n\r\nfunction SubChk()\r\n{\r\n\tvar pass=document.all.pass.value;\r\n\tvar pass2=document.all.pass2.value;\r\n\tvar pass3=document.all.pass3.value;\r\n\t\r\n\tif(pass==''){\r\n\t\talert(\"ÇëÊäÈëÔ­ÃÜÂë~\");\r\n\t\tdocument.all.pass.focus()";
echo ";\r\n\t\treturn false;\r\n\t\t\r\n\t}\r\n\tif(pass2==''){\r\n\t\talert(\"ÇëÊäÈëÐÂÃÜÂë~\");\r\n\t\tdocument.all.pass2.focus();\r\n\t\treturn false;\r\n\t\t\r\n\t}if(pass3 != pass2){\r\n\t\talert(\"ÐÂÃÜÂëÓëÈ·ÈÏÃÜÂë²»·û~\");\r\n\t\tdocument.all.pass3.focus();\r\n\t\treturn false;\r\n\t}\r\n\t\r\n//\tC_Key();\r\n\t//alert(pass+pass2+pass3);\r\n\t\r\n//document.getElementById('Submit').disabled = true;\t\r\n} \r\n\r\n</script>\r\n\r\n\r\n\r\n ";
echo "<s";
echo "tyle type=\"text/css\">\r\n<!--\r\n.STYLE2 {color: #0000FF}\r\n.STYLE5 {\r\n\tcolor: #006600;\r\n\tfont-weight: bold;\r\n}\r\n.STYLE7 {color: #0000FF; font-weight: bold; }\r\n.STYLE8 {color: #006600}\r\n.input1 {\r\n\tdisplay:inline-block;BACKGROUND-COLOR: #ffffff; BORDER-BOTTOM: #A7BCCB 1px solid; BORDER-LEFT: #A7BCCB 1px solid; BORDER-RIGHT: #A7BCCB 1px solid; BORDER-TOP: #A7BCCB 1px solid; FONT-FAMILY: \"Verdana\", \"Arial";
echo "\", \"Helvetica\", \"sans-serif\"; FONT-SIZE: 12px;text-align:left;font-weight: bold;color: #990000;line-height: 15px;width: 100px;\r\n}\r\n\r\n.input3 {\r\n\tdisplay:inline-block;BACKGROUND-COLOR: #ffffff; BORDER-BOTTOM: #A7BCCB 1px solid; BORDER-LEFT: #A7BCCB 1px solid; BORDER-RIGHT: #A7BCCB 1px solid; BORDER-TOP: #A7BCCB 1px solid; FONT-FAMILY: \"Verdana\", \"Arial\", \"Helvetica\", \"sans-serif\"; FONT-SIZE: 12px;t";
echo "ext-align:left;font-weight: bold;color: #990000;line-height: 15px;width: 60px;\r\n}\r\n.input2 {\r\n\tdisplay:inline-block;BACKGROUND-COLOR: #ffffff; BORDER-BOTTOM: #A7BCCB 1px solid; BORDER-LEFT: #A7BCCB 1px solid; BORDER-RIGHT: #A7BCCB 1px solid; BORDER-TOP: #A7BCCB 1px solid; FONT-FAMILY: \"Verdana\", \"Arial\", \"Helvetica\", \"sans-serif\"; FONT-SIZE: 12px;text-align:left;font-weight: bold;color: #0000ff;li";
echo "ne-height: 15px;width: 45px;\r\n}\r\n.STYLE4 {\tcolor: #000000;\r\n\tfont-weight: bold;\r\n}\r\n.btn2 { border:#b5d6e6 1px solid; background:#dfefff}\r\n.btn2m{border:#dfefff 1px solid; background:#b5d6e6}\r\n-->\r\n </style>\r\n\r\n<table class=\"Ball_List\" align=\"center\" border=\"0\" cellpadding=\"1\" cellspacing=\"1\" width=\"740\">\r\n<form name=\"testFrm\" method=\"post\" action=\"\"  onSubmit=\"return SubChk()\">\r\n   <tbody><tr class=\"t";
echo "d_caption_1\">\r\n     <td colspan=\"2\" bordercolor=\"#CCCCCC\" align=\"center\" bgcolor=\"#DFEFFF\" height=\"22\">";
echo "<s";
echo "pan class=\"STYLE4\">×ƒ¸üÃÜÂë</span></td>\r\n  </tr>\r\n   <tr>\r\n    <td bordercolor=\"#CCCCCC\" align=\"right\" bgcolor=\"#DFEFFF\" height=\"30\" width=\"17%\">Ô­ÃÜÂë£º</td>\r\n    <td bordercolor=\"#CCCCCC\" bgcolor=\"#FFFFFF\" width=\"83%\"><input name=\"pass\" id=\"pass\" class=\"input1\" type=\"password\"></td>\r\n  </tr>\r\n  <tr>\r\n    <td bordercolor=\"#CCCCCC\" align=\"right\" bgcolor=\"#DFEFFF\" height=\"30\">ÐÂÃÜÂë£º</td>\r\n    <td bordercolor=\"";
echo "#CCCCCC\" bgcolor=\"#FFFFFF\"><input name=\"pass2\" id=\"pass2\" class=\"input1\" type=\"password\"></td>\r\n  </tr>\r\n  <tr>\r\n    <td bordercolor=\"#CCCCCC\" align=\"right\" bgcolor=\"#DFEFFF\" height=\"30\">´_ÕJÃÜÂë£º</td>\r\n    <td bordercolor=\"#CCCCCC\" bgcolor=\"#FFFFFF\"><input name=\"pass3\" id=\"pass3\" class=\"input1\" type=\"password\"></td>\r\n  </tr>\r\n  \r\n</tbody></table>\r\n <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing";
echo "=\"0\" width=\"740\">\r\n   <tbody><tr>\r\n     <td align=\"center\" height=\"50\">\r\n     <input name=\"Submit\" class=\"btn2\" onMouseOut=\"this.className='btn2'\" onMouseOver=\"this.className='btn2m'\" id=\"btnSubmit\" value=\"È·¶¨ÐÞ¸Ä\" type=\"submit\">\r\n     </td>\r\n   </tr> \r\n</tbody>\r\n</form></table>\r\n</body></html>";
?>
