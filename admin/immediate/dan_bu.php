<?php
include_once( "../../global.php" );
$db = new rate( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
if ( $_POST['btnSubmit'] == "下注" )
{
		$url = "{$_GET['urlname']}.php?t1={$_GET['t1']}&t2={$_GET['t2']}&spul={$_GET['spul']}";
		$db->get_feiorders( $_GET['plate_num'], "A", $_GET[t1], $_GET[t2], explode( ",", $_GET['type3'] ), $_POST[x_orders_y], $_POST[x_orders_p], 0, $_POST[x_orders_t], 1, 1, 0, $url );
}
echo "<html  xmlns=\"http://www.w3.org/1999/xhtml\">\n<head>\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=gbk\">\n</head>\n\n<body>\n<link href=\"../images/Index.css\" rel=\"stylesheet\" type=\"text/css\">\n<div id=\"ly\" style=\"position: absolute; top: 0px; background-color: rgb(255, 255, 255); z-index: 2; left: 0px; display: block; width: 1337px; height: 513px;\"> \n  <!--[if lte IE 6.5]><iframe></iframe><![endif]--";
echo "> \n</div>\n<!--          浮層框架開始         -->\n<div id=\"rs_window\" style=\"position: absolute; top: 25px; z-index: 2000; left: 543.5px; display: block;\">\n  <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width:auto;\">\n    <tbody>\n      <tr>\n        <td background=\"../images/tab_05.gif\" height=\"30\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n            <tbody>\n              <tr";
echo ">\n                <td height=\"30\" width=\"12\"><img src=\"../images/tab_03.gif\" height=\"30\" width=\"12\"></td>\n                <td><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n                    <tbody>\n                      <tr>\n                        <td valign=\"middle\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n                            <tbody>\n                     ";
echo "         <tr>\n                                <td width=\"2%\"><div align=\"center\"><img src=\"../images/tb.gif\" height=\"16\" width=\"16\"></div></td>\n                                <td class=\"F_bold\" width=\"96%\">[";
if ( $_GET[t2] == "过关" )
{
		echo "过关";
}
else
{
		echo $_GET['type3'];
}
echo "]单補</td>\n                                <td width=\"2%\" class=\"F_bold\" align=\"right\"><a  href=\"javascript:history.back(-1)\" target=\"content\"><img src=\"../images/icon_21x21_del.gif\" border=\"0\" height=\"16\" width=\"16\"></a></td>\n                              </tr>\n                            </tbody>\n                          </table></td>\n                      </tr>\n                    </tbody>\n               ";
echo "   </table></td>\n                <td width=\"16\"><img src=\"../images/tab_07.gif\" height=\"30\" width=\"16\"></td>\n              </tr>\n            </tbody>\n          </table></td>\n      </tr>\n      <tr>\n        <td><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n            <tbody>\n              <tr>\n                <td background=\"../images/tab_12.gif\" width=\"8\">&nbsp;</td>\n                <td align=\"cen";
echo "ter\"><!-- 開始  -->\n                  \n                  <table class=\"Ball_List\" bgcolor=\"#FFFFFF\" border=\"0\" cellpadding=\"1\" cellspacing=\"1\" style=\"width:auto;\">\n                    <form name=\"form1\" method=\"post\" action=\"\">                   \n                    <tbody>\n                      <tr>\n                        <td align=\"right\" bgcolor=\"#E6F1F7\" width=\"58\">号码：</td>\n                      ";
echo "  <td bgcolor=\"#FFFFFF\" width=\"135\">";
echo $_GET['type3'];
echo "</td>\n                      </tr>\n                      <tr>\n                        <td align=\"right\" bgcolor=\"#E6F1F7\">赔率：</td>\n                        <td bgcolor=\"#FFFFFF\"><input name=\"x_orders_p[]\" class=\"input3\" id=\"bl\" value=\"";
echo $_GET['rate'];
echo "\" size=\"10\" type=\"text\"></td>\n                      </tr>\n                      ";
if ( $_GET[t2] == "二中特" || $_GET[t2] == "三中二" )
{
		echo "  \n                      <tr>\n                        <td align=\"right\" bgcolor=\"#E6F1F7\">赔率2：</td>\n                        <td bgcolor=\"#FFFFFF\"><input name=\"x_orders_p_2[]\" class=\"input3\" id=\"bl\" value=\"";
		echo $_GET['rate2'];
		echo "\" size=\"10\" type=\"text\"></td>\n                      </tr> \n                      ";
}
echo "  \n                      <tr>\n                        <td align=\"right\" bgcolor=\"#E6F1F7\">退水：</td>\n                        <td bgcolor=\"#FFFFFF\"><input name=\"x_orders_t[]\" class=\"input3\" id=\"ds\" value=\"";
echo $_GET['ts'];
echo "\" size=\"10\" type=\"text\"></td>\n                      </tr>\n                      <tr>\n                        <td align=\"right\" bgcolor=\"#E6F1F7\">金额：</td>\n                        <td bgcolor=\"#FFFFFF\"><input name=\"x_orders_y[]\" class=\"input3\" id=\"money\" value=\"";
echo $_GET['je'];
echo "\" size=\"10\" type=\"text\"></td>\n                      </tr>\n                      <tr>\n                        <td colspan=\"2\" align=\"center\" bgcolor=\"#FFFFFF\"><input name=\"btnSubmit\" class=\"button_a\" id=\"Submit\" value=\"下注\" type=\"submit\">\n                          &nbsp;\n                          <a onclick=\"javascript:history.back(-1)\" ><input name=\"Submit2\" class=\"button_a\" value=\"取消\"  type=\"button\">";
echo "</a>\n                        </td>\n                      </tr>\n                    </tbody></form>\n                  </table>\n                  \n                  <!-- 結束  --></td>\n                <td background=\"../images/tab_15.gif\" width=\"8\">&nbsp;</td>\n              </tr>\n            </tbody>\n          </table></td>\n      </tr>\n      <tr>\n        <td background=\"../images/tab_19.gif\" height=\"35\"><table border";
echo "=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n            <tbody>\n              <tr>\n                <td height=\"35\" width=\"12\"><img src=\"../images/tab_18.gif\" height=\"35\" width=\"12\"></td>\n                <td valign=\"top\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" height=\"30\" width=\"100%\">\n                    <tbody>\n                      <tr>\n                        <td align=\"center\"><table bor";
echo "dercolordark=\"#FFFFFF\" align=\"center\" border=\"0\" bordercolor=\"f1f1f1\" cellpadding=\"2\" cellspacing=\"0\" width=\"99%\">\n                            <tbody>\n                              <tr>\n                                <td align=\"center\">&nbsp;</td>\n                              </tr>\n                            </tbody>\n                          </table></td>\n                      </tr>\n                   ";
echo " </tbody>\n                  </table></td>\n                <td width=\"16\"><img src=\"../images/tab_20.gif\" height=\"35\" width=\"16\"></td>\n              </tr>\n            </tbody>\n          </table></td>\n      </tr>\n    </tbody>\n  </table>\n</div>\n</body>\n</html>";
?>
