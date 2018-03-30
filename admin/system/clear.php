<?php

include_once( "../../global.php" );

$db = new plate( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );

if ( ( $_POST[B1] == "清除当期" || $_POST[B2] == "清除历史" ) && 0 < $_POST[id1] && 0 < $_POST[id2] )

{

		$all_nums = "select plate_num from plate where plate_num between  '{$_POST[id1]}' and '{$_POST[id2]}'";

		$all_num = mysql_query( $all_nums );

		$nums = array( );

		while ( $allnum = mysql_fetch_array( $all_num ) )

		{

				$nums[] = $allnum['plate_num'];

		}

		foreach ( $nums as $ns )

		{

				if ( $ns )

				{

						$db->delete( "orders", "plate_num={$ns}", "" );

						$db->delete( "orders_totalmoney", "plate_num={$ns}", "" );

						$db->delete( "member_settlereport", "plate_num={$ns}", "" );

						$db->delete( "accountopen", "plate_num={$ns}", "" );

						$db->del_total_bet( $ns );

				}

		}

		$db->Get_admin_msg( "clear.php", "清除数据成功！" );

}

echo "<html oncontextmenu=\"return false\" xmlns=\"http://www.w3.org/1999/xhtml\">\n<head>\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">\n";

echo "<s";

echo "tyle type=\"text/css\">\n<!--\nbody {\n\tmargin-left: 0px;\n\tmargin-top: 0px;\n\tmargin-right: 0px;\n\tmargin-bottom: 0px;\n}\n-->\n</style>\n";

echo "<s";

echo "cript>\nif(self == top) {location = '/';} \nif(window.location.host!=top.location.host){top.location=window.location;}</script>\n</head>\n\n<body oncontextmenu=\"return false\" onselect=\"document.selection.empty()\" oncopy=\"document.selection.empty()\" onmouseover=\"self.status='歡迎光臨';return true\">\n  ";

echo "<s";

echo "cript src=\"../js/jquery-1.4.3.min.js\" type=\"text/javascript\"></script>\n";

echo "<s";

echo "cript language=\"JAVASCRIPT\">\nif(self == top) {location = '/';} \nif(window.location.host!=top.location.host){top.location=window.location;} \n　\$(document).ready(function(){ \n//alert(1);\n\t　\$(\"#B1\").click(function(){ \n　　\t\n\t\tvar id1  = \$(\"#id1\").val();\n\t\tvar id2  = \$(\"#id2\").val();\n\t\t\n\t\tif(id1 == \"\" || id2 == \"\"){\n\t\t\talert(\"请输入需要删除的期数~\");\n\t\t\treturn false;\n\t\t\t} \n\t\t//alert(\"i am \"+id1);\n\t\t\n";

echo "//\t\t\$.get(\"ajax_clear.php\",{id1:id1,id2:id2,action:\"clearB1\"},rend); \n//\t\t　　function rend(xml){ \n//\t\t　　\tif(xml == 1){alert(\"清除成功\")}else{alert(\"操作失败\");};\n//\t\t\t\t\n//\t\t//alert(xml); \n//\t\t　　}  \n　　\t});\n\n\t  　\$(\"#B2\").click(function(){ \n\t \tvar id1  = \$(\"#id1\").val();\n\t\tvar id2  = \$(\"#id2\").val();\n　　\t \n　　\t\n\t\tif(id1 == \"\" || id2 == \"\"){\n\t\t\talert(\"请输入需要删除的期数~\");\n\t\t\treturn false";

echo ";\n\t\t\t} \n\t\t//alert(\"i am \"+id2);\n\t\t\n//\t\t\$.get(\"ajax_clear.php\",{id1:id1,id2:id2,action:\"clearB2\"},rend); \n//\t\t　　function rend(xml){ \n//\t\t　　\tif(xml == 1){alert(\"清除成功\")}else{alert(\"操作失败\");};\n//\t\t\t\t\n//\t\t//alert(xml); \n//\t\t　　}\n\t\t}); \n\n\n\t});\n\n</script>\n<link href=\"../images/Index.css\" rel=\"stylesheet\" type=\"text/css\">\n<link href=\"../css/admincg.css\" rel=\"stylesheet\" type=\"text/css\">\n";

echo "<s";

echo "tyle type=\"text/css\">\n<!--\n.STYLE2 {\tcolor: #0000FF;\n\tfont-weight: bold;\n}\n-->\n </style>\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"99%\" style=\"margin:auto;border:1px solid #000;background:#fff;\">\n  <tbody>\n    <tr class=\"header\">\n      <td background=\"../css/bg_list.gif\" height=\"25\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n          <tbody>\n            <tr>\n              <td height=\"25\" width=\"12\"><img src=\"../css/bg_list.gif\" height=\"25\"";

echo " width=\"12\"></td>\n              <td><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n                  <tbody>\n                    <tr>\n                      <td valign=\"middle\" width=\"87%\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n                          <tbody>\n                            <tr>\n                              <td width=\"1%\"><div align=\"center\">";

echo "</div></td>\n                              <td class=\"F_bold\" width=\"32%\" style=\"color:#fff;\">删除数据</td>\n                              <td class=\"F_bold\" width=\"33%\">&nbsp;</td>\n                              <td valign=\"middle\" width=\"34%\">&nbsp;</td>\n                            </tr>\n                          </tbody>\n                        </table></td>\n                    </tr>\n      ";

echo "            </tbody>\n                </table></td>\n              <td width=\"16\"><img src=\"../css/bg_list.gif\" height=\"25\" width=\"16\"></td>\n            </tr>\n          </tbody>\n        </table></td>\n    </tr>\n    <tr>\n      <td><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n          <tbody>\n            <tr>\n<td";

echo " align=\"center\" height=\"200\"><!-- 開始  -->\n                \n                <div id=\"result\" style=\"text-align:center;\">\n                  <table style=\"margin:auto;\">\n                    <form action=\"\" method=\"post\" name=\"testFrm\"  id=\"testFrm\">\n                    \n                    <tbody>\n                      <tr>\n                        <td colspan=\"2\" align=\"center\" nowrap=\"nowrap\"><p align=\"right\">";

echo "<s";

echo "pan class=\"STYLE2\">請輸入期数：</span></p></td>\n                        <td colspan=\"6\" align=\"center\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n                            <tbody>\n                              <tr>\n                                <td>\n                              <input name=\"id1\" class=\"input1\" id=\"id1\" size=\"10\" type=\"text\">\n                                      -";

echo "-\n                                      <input name=\"id2\" class=\"input1\" id=\"id2\" size=\"10\" type=\"text\">\n                                  </td>\n                                <td align=\"center\" nowrap=\"nowrap\">&nbsp;&nbsp;&nbsp;&nbsp;\n                                  <input value=\"清除当期\" name=\"B1\" class=\"button_a1\" type=\"submit\" id=\"B1\">\n                                   \n                      ";

echo "            &nbsp;&nbsp;&nbsp;&nbsp;\n                                  <input value=\"清除历史\" name=\"B2\" class=\"button_a\" type=\"submit\" id=\"B2\"></td>\n                                <td>&nbsp;</td>\n                              </tr>\n                            </tbody>\n                          </table></td>\n                      </tr>\n                    </tbody>\n                        </form>\n           ";

echo "       </table>\n                </div>\n                \n                <!-- 結束  --></td>\n            </tr>\n          </tbody>\n        </table></td>\n    </tr>\n    <tr>\n      <td height=\"35\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n          <tbody>\n            <tr>\n              <td ";

echo "height=\"35\" width=\"12\"></td>\n              <td valign=\"top\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" height=\"25\" width=\"100%\">\n                  <tbody>\n                    <tr>\n                      <td align=\"center\"><div disabled=\"disabled\" align=\"right\"> 提示：如果一但刪除了就不可能在還原.請小心清除数據.</div></td>\n                    </tr>\n";

echo "                  </tbody>\n                </table></td>\n              <td width=\"16\"></td>\n            </tr>\n          </tbody>\n        </table></td>\n    </tr>\n  </tbody>\n</table>\n</body>\n</html>";

?>

