<?php
include_once( "../../global.php" );
$db = new plate( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
$db2 = new plate( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
$uid = $_SESSION["uid".$c_p_seesion];
$info = mysql_fetch_array( mysql_query( "select * from users  where user_id = '{$uid}'" ) );
$query = "select * from update_code where user_id = '{$uid}'  ";
$result_all = mysql_query( $query );
$total = mysql_num_rows( $result_all );
pageft( $total, 10 );
if ( $firstcount < 0 )
{
		$firstcount = 0;
}
$result = mysql_query( "{$query} order by up_time desc limit  {$firstcount}, {$displaypg}" );
echo "<html oncontextmenu=\"return false\" xmlns=\"http://www.w3.org/1999/xhtml\"><head>\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">\n";
echo "<s";
echo "tyle type=\"text/css\">\n<!--\nbody {\n\tmargin-left: 0px;\n\tmargin-top: 0px;\n\tmargin-right: 0px;\n\tmargin-bottom: 0px;\n}\n-->\n</style>\n</head>\n<body oncontextmenu=\"return false\" onselect=\"document.selection.empty()\" oncopy=\"document.selection.empty()\" onmouseover=\"self.status='歡迎光臨';return true\">\n<link href=\"../images/Index.css\" rel=\"stylesheet\" type=\"text/css\">\n <table border=\"0\" cellpadding=\"0\" cellspacin";
echo "g=\"0\" width=\"100%\">\n  <tbody>\n    <tr>\n      <td background=\"../images/tab_05.gif\" height=\"30\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n        <tbody>\n          <tr>\n            <td height=\"30\" width=\"12\"><img src=\"../images/tab_03.gif\" height=\"30\" width=\"12\"></td>\n            <td><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n              <tbody>\n                <tr>\n";
echo "                  <td valign=\"middle\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n                    <tbody>\n                      <tr>\n                        <td width=\"2%\"><div align=\"center\"><img src=\"../images/tb.gif\" height=\"16\" width=\"16\"></div></td>\n                        <td class=\"F_bold\">[f1]自動補貨變更記錄</td>\n                        <td class=\"F_bold\" align=\"right\"><a href=";
echo "\"#\" onClick=\"close_win();\"></a></td>\n                      </tr>\n                    </tbody>\n                  </table></td>\n                </tr>\n              </tbody>\n            </table></td>\n            <td width=\"16\"><img src=\"../images/tab_07.gif\" height=\"30\" width=\"16\"></td>\n          </tr>\n        </tbody>\n      </table></td>\n    </tr>\n    <tr>\n      <td><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" widt";
echo "h=\"100%\">\n        <tbody>\n          <tr>\n            <td background=\"../images/tab_12.gif\" width=\"8\">&nbsp;</td>\n            <td align=\"center\"><!-- 開始  -->\n             <div id=\"rs_windowss\"> <table class=\"t_list\" border=\"0\" cellpadding=\"1\" cellspacing=\"1\" width=\"100%\">\n                <tbody><tr>\n                  <td class=\"t_list_caption\">ID</td>\n                  <td class=\"t_list_caption\">變更時間</td>\n";
echo "                  <td class=\"t_list_caption\">變更類別</td>\n                  <td class=\"t_list_caption\">原始值</td>\n                  <td class=\"t_list_caption\">變更值</td>\n                  <td class=\"t_list_caption\">變更人</td>\n                  <td class=\"t_list_caption\">IP</td>\n                  <td class=\"t_list_caption\">IP歸屬</td>\n                </tr>\n\t\t\t\t    ";
while ( $row = mysql_fetch_array( $result ) )
{
		echo "                  \n                   <tr style=\"\" class=\"t_list_tr_0\" onMouseOver=\"this.style.backgroundColor='#FFFFA2'\" onMouseOut=\"this.style.backgroundColor=''\">\n                  <td> ";
		echo $row['id'];
		echo "   </td>\n                  <td>";
		echo $row['up_time'];
		echo "</td>\n                  <td>";
		echo $row['up_type'];
		echo " </td>\n                  <td>";
		echo $row['or_value'];
		echo " </td>\n                  <td> ";
		echo $row['now_value'];
		echo "   </td>\n                  <td>";
		echo $row['up_user_name'];
		echo "</td>\n                  <td>";
		echo $row['up_user_ip'];
		echo " </td>\n                  <td>";
		echo $row['up_user_location'];
		echo " </td>\n                </tr>  \n                \n                    ";
}
echo "             \n              \n              </tbody></table></div>\n              <!-- 結束  -->            </td>\n            <td background=\"../images/tab_15.gif\" width=\"8\">&nbsp;</td>\n          </tr>\n        </tbody>\n      </table></td>\n    </tr>\n    <tr>\n      <td background=\"../images/tab_19.gif\" height=\"35\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n        <tbody>\n          <tr>\n          ";
echo "  <td height=\"35\" width=\"12\"><img src=\"../images/tab_18.gif\" height=\"35\" width=\"12\"></td>\n            <td valign=\"top\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" height=\"30\" width=\"100%\">\n              <tbody>\n                <tr>\n                  <td align=\"center\"><table bordercolordark=\"#FFFFFF\" align=\"center\" border=\"0\" bordercolor=\"f1f1f1\" cellpadding=\"2\" cellspacing=\"0\" width=\"99%\">\n         ";
echo "           <tbody><tr>\n                      \n                        <td align=\"center\">";
echo $pagenav;
echo "-註意：脩改記錄最少被保畱15天、超過15天部分最多保留最後50筆。</td>\n                   \n                    </tr>\n                  </tbody></table></td>\n                </tr>\n              </tbody>\n            </table></td>\n            <td width=\"16\"><img src=\"../images/tab_20.gif\" height=\"35\" width=\"16\"></td>\n          </tr>\n        </tbody>\n      </table></td>\n    </tr>\n  </tbody>\n</table>\n</body></html>";
?>
