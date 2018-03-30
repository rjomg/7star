<?php
include_once( "../../global.php" );
$db = new rate( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
if ( $_POST['btnSubmit'] == "下注" )
{
		$url = "{$_GET['urlname']}.php?t1={$_GET['t1']}&t2={$_GET['t2']}&spul={$_GET['spul']}";
		$db->get_feiorders( $_GET['plate_num'], "A", $_GET[t1], $_GET[t2], $_POST[x_o_type3], $_POST[x_orders_y], $_POST[x_orders_p], 0, 0, 1, 1, 0, $url );
}
echo "<html  xmlns=\"http://www.w3.org/1999/xhtml\">\n<head>\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=gbk\">\n</head>\n\n<body>\n    ";
$x = explode( ";", substr( $_GET['duobu'], 0, -1 ) );
echo "<link href=\"../images/Index.css\" rel=\"stylesheet\" type=\"text/css\">\n";
echo "<s";
echo "cript type=\"text/javascript\"> \nfunction copyUrl2() \n{ \nvar Url2=document.getElementById(\"ffgg\"); \nUrl2.select(); // 选择对象 \ndocument.execCommand(\"Copy\"); // 执行浏览器复制命令 \nalert(\"已复制好，可贴粘。\"); \n} \n</script>    \n<div id=\"ly\" style=\"position: absolute; top: 0px; background-color: rgb(255, 255, 255); z-index: 2; left: 0px; display: block; width: 1337px; height: 513px;\"> \n  <!--[if lte IE ";
echo "6.5]><iframe></iframe><![endif]--> \n</div>\n<!--          浮層框架開始         -->\n<div id=\"rs_window\" style=\"position: absolute; top: 25px; z-index: 2000; left: 468.5px; display: block;\">\n  <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"400\">\n    <tbody>\n      <tr>\n        <td background=\"../images/tab_05.gif\" height=\"30\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n            <t";
echo "body>\n              <tr>\n                <td height=\"30\" width=\"12\"><img src=\"../images/tab_03.gif\" height=\"30\" width=\"12\"></td>\n                <td><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n                    <tbody>\n                      <tr>\n                        <td valign=\"middle\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n                            <tbody>";
echo "\n                              <tr>\n                                <td width=\"2%\"><div align=\"center\"><img src=\"../images/tb.gif\" height=\"16\" width=\"16\"></div></td>\n                                <td class=\"F_bold\" width=\"70%\">多補</td>\n                                <td class=\"F_bold\" align=\"right\"><a  href=\"javascript:history.back(-1)\"  target=\"content\"><img src=\"../images/icon_21x21_del.gif\" border=\"0\"";
echo " height=\"16\" width=\"16\"></a></td>\n                              </tr>\n                            </tbody>\n                          </table></td>\n                      </tr>\n                    </tbody>\n                  </table></td>\n                <td width=\"16\"><img src=\"../images/tab_07.gif\" height=\"30\" width=\"16\"></td>\n              </tr>\n            </tbody>\n          </table></td>\n      </tr>\n      <tr>\n   ";
echo "     <td><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n            <tbody>\n              <tr>\n                <td background=\"../images/tab_12.gif\" width=\"8\">&nbsp;</td>\n                <td align=\"center\"><!-- 開始  -->\n                  \n                  <table class=\"Ball_List\" bgcolor=\"#FFFFFF\" border=\"0\" cellpadding=\"1\" cellspacing=\"1\" width=\"100%\">\n                    <form name=\"for";
echo "mzf1\" method=\"post\" action=\"\">                   \n                    <tbody>\n                      <tr>\n                        <td align=\"center\" bgcolor=\"#E6F1F7\" width=\"58\">号码</td>\n                        <td align=\"center\" bgcolor=\"#E6F1F7\" width=\"135\"> 赔率</td>\n                        <td align=\"center\" bgcolor=\"#E6F1F7\" width=\"135\">金额</td>\n                      </tr>\n                        ";
foreach ( $x as $v )
{
		$y = explode( ",", $v );
		echo "                      <tr>\n                        <td align=\"center\" bgcolor=\"#FFFFFF\">";
		echo $y[0];
		echo "</td>\n                        <input name=\"x_o_type3[]\" type=\"hidden\" value=\"";
		echo $y[0];
		echo "\" />\n                        <input name=\"x_orders_p[]\" type=\"hidden\" value=\"";
		echo $y[1];
		echo "\" />\n                        <td align=\"center\" bgcolor=\"#FFFFFF\">";
		echo $y[1];
		echo "</td>\n                        <td align=\"center\" bgcolor=\"#FFFFFF\"><input name=\"x_orders_y[]\" class=\"input3\" id=\"money_0\" value=\"";
		echo $y[3];
		echo "\" size=\"10\" type=\"text\">\n                        </td>\n                      </tr>\n                        ";
		$kuaisudan .= $y[0]."=".$y[3]."&nbsp;";
}
echo "                      <tr>\n                        <td colspan=\"3\" align=\"center\" bgcolor=\"#FFFFFF\"><input name=\"btnSubmit\" class=\"button_a\" id=\"Submit\" value=\"下注\" type=\"submit\">\n                          &nbsp;\n                          <a onclick=\"javascript:history.back(-1)\" ><input name=\"Submit2\" class=\"button_a\"  value=\"取消\"  type=\"button\"></a>\n                          <input name=\"wws\" id=\"wws\"";
echo " value=\"2\" type=\"hidden\"></td>\n                      </tr>\n                      <tr>\n                        <td colspan=\"3\" bgcolor=\"#FFFFFF\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n                            <tbody>\n                              <tr>\n                                <td><textarea name=\"ffgg\" cols=\"50\" rows=\"5\" id=\"ffgg\">";
echo $kuaisudan;
echo "</textarea></td>\n                                <td><input name=\"Submit22\" class=\"button_a\" id=\"Submit22\" value=\"复制\" onclick=\"copyUrl2();\" type=\"button\"></td>\n                              </tr>\n                            </tbody>\n                          </table></td>\n                      </tr>\n                    </tbody></form>\n                  </table>\n                  \n                  <!-- 結束  ";
echo "--></td>\n                <td background=\"../images/tab_15.gif\" width=\"8\">&nbsp;</td>\n              </tr>\n            </tbody>\n          </table></td>\n      </tr>\n      <tr>\n        <td background=\"../images/tab_19.gif\" height=\"35\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n            <tbody>\n              <tr>\n                <td height=\"35\" width=\"12\"><img src=\"../images/tab_18.gif\" height";
echo "=\"35\" width=\"12\"></td>\n                <td valign=\"top\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" height=\"30\" width=\"100%\">\n                    <tbody>\n                      <tr>\n                        <td align=\"center\"><table bordercolordark=\"#FFFFFF\" align=\"center\" border=\"0\" bordercolor=\"f1f1f1\" cellpadding=\"2\" cellspacing=\"0\" width=\"99%\">\n                            <tbody>\n                 ";
echo "             <tr>\n                                <td align=\"center\">&nbsp;</td>\n                              </tr>\n                            </tbody>\n                          </table></td>\n                      </tr>\n                    </tbody>\n                  </table></td>\n                <td width=\"16\"><img src=\"../images/tab_20.gif\" height=\"35\" width=\"16\"></td>\n              </tr>\n            </tbody>\n";
echo "          </table></td>\n      </tr>\n    </tbody>\n  </table>\n</div>\n</body>\n</html>";
?>
