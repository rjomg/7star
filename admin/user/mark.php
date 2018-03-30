<?php
include_once( "../../global.php" );
$user_name = $_GET['user_name'];
$user_id = $_GET['user_id'];
$db = new action( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
$query = $db->select( "update_code", "*", "user_id={$user_id} limit 0,50" );
echo "<html oncontextmenu=\"return false\" xmlns=\"http://www.w3.org/1999/xhtml\">\n<head>\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=gbk\">\n</head>\n\n<body oncontextmenu=\"return false\" onselect=\"document.selection.empty()\" oncopy=\"document.selection.empty()\" onmouseover=\"self.status='歡迎光臨';return true\">\n<link href=\"../images/Index.css\" rel=\"stylesheet\" type=\"text/css\">\n<div id=\"ly\" style=\"positi";
echo "on: absolute; top: 0px; background-color: rgb(255, 255, 255); z-index: 2; left: 0px; display: block; width: 1337px; height: 513px;\"> \n  <!--[if lte IE 6.5]><iframe></iframe><![endif]--> \n</div>\n<!--          浮層框架開始         -->\n<div id=\"rs_window\" style=\"position: absolute; top: 25px; z-index: 2000; left: 268.5px; display: block;\">\n  <meta http-equiv=\"Content-Type\" content=\"text/html; charset=gbk\">\n ";
echo " <table bgcolor=\"#FFFFFF\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\n    <tbody>\n      <tr>\n        <td background=\"../images/tab_05.gif\" height=\"30\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n            <tbody>\n              <tr>\n                <td height=\"30\" width=\"12\"><img src=\"../images/tab_03.gif\" height=\"30\" width=\"12\"></td>\n                <td><table border=\"0\" cellpadding=\"0\" ";
echo "cellspacing=\"0\" width=\"100%\">\n                    <tbody>\n                      <tr>\n                        <td valign=\"middle\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n                            <tbody>\n                              <tr>\n                                <td width=\"2%\"><div align=\"center\"><img src=\"../images/tb.gif\" height=\"16\" width=\"16\"></div></td>\n                 ";
echo "               <td class=\"F_bold\" width=\"70%\">[";
echo $user_name;
echo "]資料變更記錄</td>\n                                <td class=\"F_bold\" align=\"right\"><a href=\"javascript:history.back(-1)\"><img src=\"../images/icon_21x21_del.gif\" border=\"0\" height=\"16\" width=\"16\"></a></td>\n                              </tr>\n                            </tbody>\n                          </table></td>\n                      </tr>\n                    </tbody>\n                  </table></td>\n      ";
echo "          <td width=\"16\"><img src=\"../images/tab_07.gif\" height=\"30\" width=\"16\"></td>\n              </tr>\n            </tbody>\n          </table></td>\n      </tr>\n      <tr>\n        <td><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n            <tbody>\n              <tr>\n                <td background=\"../images/tab_12.gif\" width=\"8\">&nbsp;</td>\n                <td align=\"center\"><!-- 開始  -->\n  ";
echo "                \n                  <div id=\"rs_windowss\">\n                    <table class=\"t_list\" border=\"0\" cellpadding=\"1\" cellspacing=\"1\" width=\"785\">\n                      <tbody>\n                        <tr>\n                          <td class=\"t_list_caption\">ID</td>\n                          <td class=\"t_list_caption\">變更時間</td>\n                          <td class=\"t_list_caption\">變更類別</td>\n";
echo "                          <td class=\"t_list_caption\">原始值</td>\n                          <td class=\"t_list_caption\">變更值</td>\n                          <td class=\"t_list_caption\">變更人</td>\n                          <td class=\"t_list_caption\">IP</td>\n                          <td class=\"t_list_caption\">IP歸屬</td>\n                        </tr>\n                ";
while ( $row = $db->fetch_array( $query ) )
{
		echo "        \n                       <tr style=\"\" class=\"t_list_tr_0\" onmouseover=\"this.style.backgroundColor='#FFFFA2'\" onmouseout=\"this.style.backgroundColor=''\">\n                          <td>";
		echo $row['id'];
		echo "</td>\n                          <td>";
		echo $row['up_time'];
		echo "</td>\n                          <td>";
		echo $row['up_type'];
		echo "</td>\n                          <td>";
		echo $row['or_value'];
		echo "</td>\n                          <td>";
		echo $row['now_value'];
		echo "</td>\n                          <td>";
		echo $row['up_user_name'];
		echo "</td>\n                          <td>";
		echo $row['up_user_ip'];
		echo "</td>\n                          <td>";
		echo $row['up_user_location'];
		echo "</td>\n                        </tr>\n                ";
}
echo "                        <tr style=\"\" class=\"t_list_tr_0\" onmouseover=\"this.style.backgroundColor='#FFFFA2'\" onmouseout=\"this.style.backgroundColor=''\">\n                          <td colspan=\"8\"><a href=\"javascript:history.back(-1)\"><input name=\"cancel\" onclick=\"javascript:history.back(-1)\" value=\"取消\" class=\"btn2\"  onmouseover=\"this.className='btn2m'\" onmouseout=\"this.className='btn2'\" type=\"button\">";
echo "</a></td>\n                        </tr>\n                      </tbody>\n                    </table>\n                  </div>\n                  \n                  <!-- 結束  --></td>\n                <td background=\"../images/tab_15.gif\" width=\"8\">&nbsp;</td>\n              </tr>\n            </tbody>\n          </table></td>\n      </tr>\n      <tr>\n        <td background=\"../images/tab_19.gif\" height=\"35\"><table border=";
echo "\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n            <tbody>\n              <tr>\n                <td height=\"35\" width=\"12\"><img src=\"../images/tab_18.gif\" height=\"35\" width=\"12\"></td>\n                <td valign=\"top\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" height=\"30\" width=\"100%\">\n                    <tbody>\n                      <tr>\n                        <td align=\"center\"><table bord";
echo "ercolordark=\"#FFFFFF\" align=\"center\" border=\"0\" bordercolor=\"f1f1f1\" cellpadding=\"2\" cellspacing=\"0\" width=\"99%\">\n                            <tbody>\n                              <tr>\n                                <td align=\"center\">註意：脩改記錄最少被保畱15天、超過15天部分最多保留最後50筆。</td>\n                              </tr>\n                            </tbody>\n                          </tabl";
echo "e></td>\n                      </tr>\n                    </tbody>\n                  </table></td>\n                <td width=\"16\"><img src=\"../images/tab_20.gif\" height=\"35\" width=\"16\"></td>\n              </tr>\n            </tbody>\n          </table></td>\n      </tr>\n    </tbody>\n  </table>\n</div>\n</body>\n</html>";
?>
