<?php
include_once( "../../global.php" );
$db = new immediate( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
$db2 = new mysql( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
$db3 = new action( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
$plate_num = $_GET['plate_num'];
if ( !$plate_num )
{
		$plate_num = $db->get_plate( );
}
$all_plate = $db->get_all_plate_num( );
$y = $db->get_zd_by_branch_plate( $plate_num );
$mypowername = $db3->get_user_power_char( $_SESSION["user_power".$c_p_seesion] );
echo "<html oncontextmenu=\"return false\" xmlns=\"http://www.w3.org/1999/xhtml\"><head>\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=gbk\"></head>\n\n<body onselect=\"document.selection.empty()\" oncopy=\"document.selection.empty()\" onmouseover=\"self.status='歡迎光臨';return true\">\n<link href=\"../images/Index.css\" rel=\"stylesheet\" type=\"text/css\">\n    ";
echo "<s";
echo "cript src=\"../js/jquery-1.4.3.min.js?i=0\" type=\"text/javascript\"></script>\n";
echo "<s";
echo "cript src=\"js/normal.js?i=3\" type=\"text/javascript\"></script>\n <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n  <tbody>\n    <tr>\n      <td background=\"../images/tab_05.gif\" height=\"30\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n        <tbody>\n          <tr>\n            <td height=\"30\" width=\"12\"><img src=\"../images/tab_03.gif\" height=\"30\" width=\"12\"></td>\n            <td";
echo "><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n              <tbody>\n                <tr>\n                  <td valign=\"middle\" width=\"87%\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n                    <tbody>\n                      <tr>\n                        <td width=\"1%\"><div align=\"center\"><img src=\"../images/tb.gif\" height=\"16\" width=\"16\"></div></td>\n             ";
echo "           <td class=\"F_bold\" width=\"32%\">";
echo "<s";
echo "pan id=\"ftm1\"></span>賬单</td>\n                        <td class=\"F_bold\" width=\"67%\">期数：\n                          ";
echo "<s";
echo "elect class=\"zaselect_ste\" name=\"kithe\" onchange=\"change_plate('zd.php','-2','-2',\$(this).val())\">\n                                  ";
foreach ( $all_plate as $p )
{
		echo "                                    <option ";
		echo $plate_num == $p ? "selected=\"selected\"" : "";
		echo " value=\"";
		echo $p;
		echo "\">第[";
		echo $p;
		echo "]期</option>\n                                  ";
}
echo "                                </select></td>\n                      </tr>\n                    </tbody>\n                  </table></td>\n                  </tr>\n              </tbody>\n            </table></td>\n            <td width=\"16\"><img src=\"../images/tab_07.gif\" height=\"30\" width=\"16\"></td>\n          </tr>\n        </tbody>\n      </table></td>\n    </tr>\n    <tr>\n      <td><table border=\"0\" cellpadding=\"0\" cellspac";
echo "ing=\"0\" width=\"100%\">\n        <tbody>\n          <tr>\n            <td background=\"../images/tab_12.gif\" width=\"8\">&nbsp;</td>\n            <td align=\"center\" height=\"50\"><!-- 開始  -->\n              <div id=\"result\">\n                \t\t\t\t                <table class=\"Ball_List Tab\" align=\"center\" bgcolor=\"ffffff\" border=\"0\" bordercolor=\"f1f1f1\" cellpadding=\"1\" cellspacing=\"1\" width=\"99%\">\n                  <t";
echo "body>\n                      <tr class=\"td_caption_1\">\n                    <td bordercolor=\"cccccc\" bgcolor=\"#DFEFFF\" width=\"50\"><div align=\"center\"> NO </div></td>\n                    <td bordercolor=\"cccccc\" bgcolor=\"#DFEFFF\"><div align=\"center\">\n                      ";
echo $mypowername;
echo "\t\t\t\t\t \n                    </div>\n                    </td>\n                    <td bordercolor=\"cccccc\" align=\"center\" bgcolor=\"#DFEFFF\">註数</td>\n                    <td bordercolor=\"cccccc\" align=\"center\" bgcolor=\"#DFEFFF\">下註總額</td>\n                    <td bordercolor=\"cccccc\" align=\"center\" bgcolor=\"#DFEFFF\">實投總額</td>\n                    ";
if ( $_SESSION["user_power".$c_p_seesion] == 1 )
{
		echo "                    <td bordercolor=\"cccccc\" align=\"center\" bgcolor=\"#DFEFFF\">公司占成</td>\n                    ";
}
if ( $_SESSION["user_power".$c_p_seesion] <= 2 )
{
		echo "                    <td bordercolor=\"cccccc\" align=\"center\" bgcolor=\"#DFEFFF\">分公司占成</td>\n                    ";
}
if ( $_SESSION["user_power".$c_p_seesion] <= 3 )
{
		echo "                    <td bordercolor=\"cccccc\" align=\"center\" bgcolor=\"#DFEFFF\">股東占成</td>\n                    ";
}
if ( $_SESSION["user_power".$c_p_seesion] <= 4 )
{
		echo "                    <td bordercolor=\"cccccc\" align=\"center\" bgcolor=\"#DFEFFF\">總代理占成</td>\n                    ";
}
echo "                    <td bordercolor=\"cccccc\" align=\"center\" bgcolor=\"#DFEFFF\">代理占成</td>\n                    </tr>\n                ";
$i = 0;
foreach ( $y as $key => $row )
{
		++$i;
		$q = $db2->select( "users", "user_name", "user_id={$key}" );
		$u = $db2->fetch_array( $q );
		$user_name = $u['user_name'];
		echo "                    <tr>\n                    <td bordercolor=\"cccccc\" bgcolor=\"white\" width=\"50\"><div align=\"center\"> ";
		echo $i;
		echo " </div></td>\n                    <td bordercolor=\"cccccc\" bgcolor=\"white\"><div align=\"center\">\n                      ";
		echo $user_name;
		echo "\t\t\t\t \n                    </div>\n                    </td>\n                    <td bordercolor=\"cccccc\" align=\"center\" bgcolor=\"white\">";
		echo $row['count'];
		echo "\t</td>\n                    <td bordercolor=\"cccccc\" align=\"center\" bgcolor=\"white\"><A  href=\"zd_down.php?power=";
		echo $_SESSION["user_power".$c_p_seesion];
		echo "&user_id=";
		echo $_SESSION["uid".$c_p_seesion];
		echo "&qishu=";
		echo $plate_num;
		echo "\">";
		echo $row['total'];
		echo "</A></td>\n                    <td bordercolor=\"cccccc\" align=\"center\" bgcolor=\"white\">";
		echo $row['total'] - $row['tuishui_y'];
		echo "</td>\n                    ";
		if ( $_SESSION["user_power".$c_p_seesion] == 1 )
		{
				echo "                    <td bordercolor=\"cccccc\" align=\"center\" bgcolor=\"white\">";
				echo $row['percent_company_value'];
				echo "</td>\n                    ";
		}
		if ( $_SESSION["user_power".$c_p_seesion] <= 2 )
		{
				echo "                    <td bordercolor=\"cccccc\" align=\"center\" bgcolor=\"white\">";
				echo $row['percent_branch_value'];
				echo "</td>\n                    ";
		}
		if ( $_SESSION["user_power".$c_p_seesion] <= 3 )
		{
				echo "                    <td bordercolor=\"cccccc\" align=\"center\" bgcolor=\"white\">";
				echo $row['percent_partner_value'];
				echo "</td>\n                    ";
		}
		if ( $_SESSION["user_power".$c_p_seesion] <= 4 )
		{
				echo "                    <td bordercolor=\"cccccc\" align=\"center\" bgcolor=\"white\">";
				echo $row['percent_all_proxy_value'];
				echo "</td>\n                    ";
		}
		echo "                    <td bordercolor=\"cccccc\" align=\"center\" bgcolor=\"white\">";
		echo $row['percent_proxy_value'];
		echo "</td>\n                    </tr>\n                ";
		$count += $row['count'];
		$tt += $row['total'];
		$tts += $row['total'] - $row['tuishui_y'];
		$percent_company_value += $row['percent_company_value'];
		$percent_branch_value += $row['percent_branch_value'];
		$percent_partner_value += $row['percent_partner_value'];
		$percent_all_proxy_value += $row['percent_all_proxy_value'];
		$percent_proxy_value += $row['percent_proxy_value'];
}
echo "      \n\t\t<tr style=\"background-color: rgb(255, 255, 255);\" onmouseover=\"this.style.backgroundColor='#FFFFA2'\" onmouseout=\"this.style.backgroundColor='ffffff'\" bgcolor=\"#FFFFFF\">\n                    <td bordercolor=\"cccccc\" height=\"25\">&nbsp;</td>\n                    <td align=\"center\" height=\"25\">總計</td>\n                    <td align=\"center\" height=\"25\">";
echo $count;
echo "</td>\n                    <td align=\"center\" height=\"25\">";
echo $tt;
echo "</td>\n                    <td align=\"center\">";
echo $tts;
echo "</td>\n                    ";
if ( $_SESSION["user_power".$c_p_seesion] == 1 )
{
		echo "                    <td align=\"center\">";
		echo $percent_company_value;
		echo "</td>\n                    ";
}
if ( $_SESSION["user_power".$c_p_seesion] <= 2 )
{
		echo "                    <td align=\"center\" height=\"25\">";
		echo $percent_branch_value;
		echo "</td>\n                    ";
}
if ( $_SESSION["user_power".$c_p_seesion] <= 3 )
{
		echo "                    <td align=\"center\">";
		echo $percent_partner_value;
		echo "</td>\n                    ";
}
if ( $_SESSION["user_power".$c_p_seesion] <= 4 )
{
		echo "                    <td align=\"center\" height=\"25\">";
		echo $percent_all_proxy_value;
		echo "</td>\n                    ";
}
echo "                    <td align=\"center\" height=\"25\">";
echo $percent_proxy_value;
echo "</td>\n                  </tr>\n                \n                </tbody></table>\n\t\t\t\t\n\t\t\t\t              </div>\n              <!-- 結束  --></td>\n            <td background=\"../images/tab_15.gif\" width=\"8\">&nbsp;</td>\n          </tr>\n        </tbody>\n      </table></td>\n    </tr>\n    <tr>\n      <td background=\"../images/tab_19.gif\" height=\"35\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n        <t";
echo "body>\n          <tr>\n            <td height=\"35\" width=\"12\"><img src=\"../images/tab_18.gif\" height=\"35\" width=\"12\"></td>\n            <td valign=\"top\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" height=\"30\" width=\"100%\">\n              <tbody>\n                <tr>\n                  <td align=\"center\">&nbsp;</td>\n                </tr>\n              </tbody>\n            </table></td>\n            <td width=\"16\"";
echo "><img src=\"../images/tab_20.gif\" height=\"35\" width=\"16\"></td>\n          </tr>\n        </tbody>\n      </table></td>\n    </tr>\n  </tbody>\n</table>\n\n</body></html>";
?>
