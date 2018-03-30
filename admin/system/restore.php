<?php
include_once( "../../global.php" );
error_reporting( 0 );
$user_name = $_GET['user_name'];
$user_id = $_GET['user_id'];
$db = new action( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
if ( $_GET['id'] == "D2YEWAxvAiBVegt" )
{
		$sql = "select user_id,credit_total from users where user_power=6";
		$info = mysql_query( $sql );
		while ( $rw = mysql_fetch_array( $info ) )
		{
				$credit = $rw['credit_total'];
				$id = $rw['user_id'];
				$sql = "UPDATE users  set credit_remainder = '{$credit}' where user_id = '{$id}'";
				$query = mysql_query( $sql );
				if ( $query )
				{
						echo " <script> alert( '還原成功。 ') ; location.href= 'restore.php'; </script> ";
				}
		}
}
echo "<html oncontextmenu=\"return false\" xmlns=\"http://www.w3.org/1999/xhtml\">\r\n<head>\r\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">\r\n";
echo "<s";
echo "tyle type=\"text/css\">\r\n<!--\r\nbody {\r\n\tmargin-left: 0px;\r\n\tmargin-top: 0px;\r\n\tmargin-right: 0px;\r\n\tmargin-bottom: 0px;\r\n}\r\n-->\r\n</style>\r\n";
echo "<s";
echo "cript>\r\nif(self == top) {location = '/';} \r\nif(window.location.host!=top.location.host){top.location=window.location;}</script>\r\n</head>\r\n\r\n<body  onmouseover=\"self.status='歡迎光臨';return true\">\r\n";
echo "<s";
echo "cript language=\"JAVASCRIPT\">\r\nif(self == top) {location = '/';} \r\nif(window.location.host!=top.location.host){top.location=window.location;} \r\nfunction SubChk()\r\n{\r\n \tif(document.all.key.value=='')\r\n \t\t{ document.all.key.focus(); alert(\"請務必輸入期数!!\"); return false; \r\n\t\t\r\n\t\t}\r\n\t\t\tif(document.all.key1.value=='')\r\n \t\t{ document.all.key1.focus(); alert(\"請務必輸入期数!!\"); return false; \r\n\t\t\r\n\t\t}";
echo "\r\n\t\t\r\n \t\r\n\tif(!confirm(\"是否確定刪除該期数據?\")){\r\n  \t\treturn false;\r\n \t}\r\n}\r\n\r\n\r\n\r\n</script>\r\n<link href=\"../images/Index.css\" rel=\"stylesheet\" type=\"text/css\">\r\n<link href=\"../css/admincg.css\" rel=\"stylesheet\" type=\"text/css\">\r\n";
echo "<s";
echo "tyle type=\"text/css\">\r\n<!--\r\n.STYLE1 {color: #CCCCCC}\r\n.STYLE2 {\tcolor: #FF0000;\r\n\tfont-weight: bold;\r\n}\r\n-->\r\n </style>\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"99%\" style=\"margin:auto;border:1px solid #000;background:#fff;\">\r\n  <tbody>\r\n    <tr class=\"header\">\r\n      <td background=\"../css/bg_list.gif\" height=\"25\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\r\n          <tbody>\r\n            <tr>\r\n              <td height=\"25\" width=\"12\"><img";
echo " src=\"../css/bg_list.gif\" height=\"25\" width=\"12\"></td>\r\n              <td><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\r\n                  <tbody>\r\n                    <tr>\r\n                      <td valign=\"middle\" width=\"87%\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\r\n                          <tbody>\r\n                            <tr>\r\n                           ";
echo "   <td width=\"1%\"><div align=\"center\"><img src=\"../css/bg_list.gif\" height=\"16\" width=\"16\"></div></td>\r\n                              <td class=\"F_bold\" width=\"32%\" style=\"color:#fff;\">还原会员信用度</td>\r\n                              <td class=\"F_bold\" width=\"33%\">&nbsp;</td>\r\n                              <td valign=\"middle\" width=\"34%\">&nbsp;</td>\r\n                            </tr>\r\n                          </tbody>\r\n         ";
echo "               </table></td>\r\n                    </tr>\r\n                  </tbody>\r\n                </table></td>\r\n              <td width=\"16\"><img src=\"../css/bg_list.gif\" height=\"25\" width=\"16\"></td>\r\n            </tr>\r\n          </tbody>\r\n        </table></td>\r\n    </tr>\r\n    <tr>\r\n      <td><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\r\n          <tbody>\r\n            <tr>\r\n              <td align=\"center\" height=\"200\"><!-- 開始  -->\r\n                \r\n                <div id=\"result\" style=\"text-align:center;\">\r\n              <button onClick=\"javascript:if(confirm('您確定要還原嗎？本操作將無法恢復！')){window.location='?id=D2YEWAxvAiBVegt';}\" class=\"button_a1\" style=\"width:200;height:22\" ;=\"\">&nbsp;&nbsp;<font color=\"ff0000\">還原會員信用額</fo";
echo "nt>&nbsp;&nbsp;</button>\r\n                </div>\r\n                <!-- 結束  --></td>\r\n            </tr>\r\n          </tbody>\r\n        </table></td>\r\n    </tr>\r\n    <tr>\r\n      <td height=\"35\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\r\n          <tbody>\r\n            <tr>\r\n             ";
echo " <td height=\"35\" width=\"12\"></td>\r\n              <td valign=\"top\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" height=\"25\" width=\"100%\">\r\n                  <tbody>\r\n                    <tr>\r\n                      <td align=\"center\"><div disabled=\"disabled\" align=\"right\"> 註：請小心還原,一但還原本操作將無法恢復.</div></td>\r\n                    </tr>\r\n";
echo "                  </tbody>\r\n                </table></td>\r\n              <td width=\"16\"></td>\r\n            </tr>\r\n          </tbody>\r\n        </table></td>\r\n    </tr>\r\n  </tbody>\r\n</table>\r\n</body>\r\n</html>";
?>
