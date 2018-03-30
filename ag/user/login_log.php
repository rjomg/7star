<?php
include_once( "../../global.php" );
$db = new plate( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
$db2 = new plate( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
$uid = $zizhanghaodenglu[1];
$info = mysql_fetch_array( mysql_query( "select * from users  where user_id = '{$uid}'" ) );
$query = "select * from admin_users_action where uid = '{$uid}'  and mark = 1 ";
$result_all = mysql_query( $query );
$total = mysql_num_rows( $result_all );
pageft( $total, 10 );
if ( $firstcount < 0 )
{
		$firstcount = 0;
}
$result = mysql_query( "{$query} order by datetime desc limit  {$firstcount}, {$displaypg}" );
echo "\n<html oncontextmenu=\"return false\" xmlns=\"http://www.w3.org/1999/xhtml\"><head>\n\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">\n\n";
echo "<s";
echo "tyle type=\"text/css\">\n\n<!--\n\nbody {\n\n\tmargin-left: 0px;\n\n\tmargin-top: 0px;\n\n\tmargin-right: 0px;\n\n\tmargin-bottom: 0px;\n\n}\n\n-->\n\n</style>\n\n</head>\n\n<body oncontextmenu=\"return false\" onselect=\"document.selection.empty()\" oncopy=\"document.selection.empty()\" onmouseover=\"self.status='歡迎光臨';return true\">\n<link href=\"../images/Index.css\" rel=\"stylesheet\" type=\"text/css\">\n\n <table border=\"0\" cellpadding=\"0";
echo "\" cellspacing=\"0\" width=\"100%\">\n\n  <tbody>\n\n    <tr>\n\n      <td background=\"../images/tab_05.gif\" height=\"30\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n\n        <tbody>\n\n          <tr>\n\n            <td height=\"30\" width=\"12\"><img src=\"../images/tab_03.gif\" height=\"30\" width=\"12\"></td>\n\n            <td><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n\n              <tbody>\n";
echo "\n                <tr>\n\n                  <td valign=\"middle\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n\n                    <tbody>\n\n                      <tr>\n\n                        <td width=\"2%\"><div align=\"center\"><img src=\"../images/tb.gif\" height=\"16\" width=\"16\"></div></td>\n\n                        <td class=\"F_bold\">[f1]登陸日誌</td>\n\n                        <td class=\"F_bold\" al";
echo "ign=\"right\"><a href=\"#\" onClick=\"close_win();\"></a></td>\n\n                      </tr>\n\n                    </tbody>\n\n                  </table></td>\n\n                </tr>\n\n              </tbody>\n\n            </table></td>\n\n            <td width=\"16\"><img src=\"../images/tab_07.gif\" height=\"30\" width=\"16\"></td>\n\n          </tr>\n\n        </tbody>\n\n      </table></td>\n\n    </tr>\n\n    <tr>\n\n      <td><table border=\"0\" cell";
echo "padding=\"0\" cellspacing=\"0\" width=\"100%\">\n\n        <tbody>\n\n          <tr>\n\n            <td background=\"../images/tab_12.gif\" width=\"8\">&nbsp;</td>\n\n            <td align=\"center\"><!-- 開始  -->\n\n             <div id=\"rs_windowss\"> <table class=\"t_list\" border=\"0\" cellpadding=\"1\" cellspacing=\"1\" width=\"100%\">\n\n                <tbody><tr>\n\n                  <td class=\"t_list_caption\">ID</td>\n\n                 ";
echo " <td class=\"t_list_caption\">登陸時間</td>\n\n                  <td class=\"t_list_caption\">IP</td>\n\n                  <td class=\"t_list_caption\">IP歸屬</td>\n\n                </tr>\n\n\t\t\t\t  ";
while ( $row = mysql_fetch_array( $result ) )
{
		echo "\n                  \n\n                   <tr style=\"\" class=\"t_list_tr_0\" onMouseOver=\"this.style.backgroundColor='#FFFFA2'\" onMouseOut=\"this.style.backgroundColor=''\">\n\n                  <td> ";
		echo $row['id'];
		echo "   </td>\n\n                  <td>";
		echo date( "Y-m-d H:i:s", $row['datetime'] );
		echo "</td>\n\n                  <td>";
		echo $row['ip'];
		echo " </td>\n\n                  <td>";
		echo $row['location'];
		echo " </td>\n\n                </tr>  \n\n                \n\n                    ";
}
echo "\n                                           \n\n              \n\n              </tbody></table>\n\n             </div>\n\n              <!-- 結束  -->            </td>\n\n            <td background=\"../images/tab_15.gif\" width=\"8\">&nbsp;</td>\n\n          </tr>\n\n        </tbody>\n\n      </table></td>\n\n    </tr>\n\n    <tr>\n\n      <td background=\"../images/tab_19.gif\" height=\"35\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"";
echo "0\" width=\"100%\">\n\n        <tbody>\n\n          <tr>\n\n            <td height=\"35\" width=\"12\"><img src=\"../images/tab_18.gif\" height=\"35\" width=\"12\"></td>\n\n            <td valign=\"top\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" height=\"30\" width=\"100%\">\n\n              <tbody>\n\n                <tr>\n\n                  <td align=\"center\"><table bordercolordark=\"#FFFFFF\" align=\"center\" border=\"0\" bordercolor=";
echo "\"f1f1f1\" cellpadding=\"2\" cellspacing=\"0\" width=\"99%\">\n\n                    <tbody><tr>\n\n                      \n\n                        <td align=\"center\">  \n\n\t\t\t\t\t\t";
echo $pagenav;
echo "-註意：登陸日誌最少被保畱7天、超過7天部分最多保留最後50筆。</td>\n\n                   \n\n                    </tr>\n\n                  </tbody></table></td>\n\n                </tr>\n\n              </tbody>\n\n            </table></td>\n\n            <td width=\"16\"><img src=\"../images/tab_20.gif\" height=\"35\" width=\"16\"></td>\n\n          </tr>\n\n        </tbody>\n\n      </table></td>\n\n    </tr>\n\n  </tbody>\n\n</table>\n\n</body></html>";
?>
