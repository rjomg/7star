<?php
include_once( "../../global.php" );
$db = new rate( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
$db2 = new action( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
$db3 = new immediate( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
$qishu = $_GET['qishu'];
$all_plate = $db3->get_all_plate_num( );
$u_id = $_GET[user_id];
if ( empty( $u_id ) )
{
		$u_id = $_SESSION["uid".$c_p_seesion];
}
$u_power = $_GET[power];
if ( empty( $u_power ) )
{
		$u_power = $_SESSION["user_power".$c_p_seesion];
}
$downname = $db2->get_user_power_char( $u_power + 1 );
$downuser_arr = $db->lowerdownuser_arr( $u_id, $u_power, $qishu );
echo "<html oncontextmenu=\"return false\" xmlns=\"http://www.w3.org/1999/xhtml\"><head>\r\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=gbk\"></head>\r\n\r\n<body onselect=\"document.selection.empty()\" oncopy=\"document.selection.empty()\" onmouseover=\"self.status='�gӭ���R';return true\">\r\n<link href=\"../images/Index.css\" rel=\"stylesheet\" type=\"text/css\">\r\n    ";
echo "<s";
echo "cript src=\"../js/jquery-1.4.3.min.js?i=0\" type=\"text/javascript\"></script>\r\n";
echo "<s";
echo "cript src=\"js/normal.js?i=3\" type=\"text/javascript\"></script>\r\n <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\r\n  <tbody>\r\n    <tr>\r\n      <td background=\"../images/tab_05.gif\" height=\"30\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\r\n        <tbody>\r\n          <tr>\r\n            <td height=\"30\" width=\"12\"><img src=\"../images/tab_03.gif\" height=\"30\" width=\"12\"></td>\r\n      ";
echo "      <td><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\r\n              <tbody>\r\n                <tr>\r\n                  <td valign=\"middle\" width=\"87%\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\r\n                    <tbody>\r\n                      <tr>\r\n                        <td width=\"1%\"><div align=\"center\"><img src=\"../images/tb.gif\" height=\"16\" width=\"16\"></div></td>";
echo "\r\n                        <td class=\"F_bold\" width=\"32%\">";
echo "<s";
echo "pan id=\"ftm1\"></span>[";
echo $db2->get_user_name( $u_id );
echo "]";
echo "�~��</td>\r\n                        <td class=\"F_bold\" width=\"67%\">������\r\n                          ";
echo "<s";
echo "elect class=\"zaselect_ste\" name=\"kithe\" onchange=\"change_plate('zd.php','-2','-2',\$(this).val())\">\r\n                                  ";
foreach ( $all_plate as $p )
{
		echo "                                    <option ";
		echo $qishu == $p ? "selected=\"selected\"" : "";
		echo " value=\"";
		echo $p;
		echo "\">��[";
		echo $p;
		echo "]��</option>\r\n                                  ";
}
echo "                          </select></td>\r\n                      </tr>\r\n                    </tbody>\r\n                  </table></td>\r\n                  </tr>\r\n              </tbody>\r\n            </table></td>\r\n            <td width=\"16\"><img src=\"../images/tab_07.gif\" height=\"30\" width=\"16\"></td>\r\n          </tr>\r\n        </tbody>\r\n      </table></td>\r\n    </tr>\r\n    <tr>\r\n      <td><table border=\"0\" cellpadding=\"0\" c";
echo "ellspacing=\"0\" width=\"100%\">\r\n        <tbody>\r\n          <tr>\r\n            <td background=\"../images/tab_12.gif\" width=\"8\">&nbsp;</td>\r\n            <td align=\"center\" height=\"50\"><!-- �_ʼ  -->\r\n              <div id=\"result\">\r\n                \t\t\t\t                <table class=\"Ball_List Tab\" align=\"center\" bgcolor=\"ffffff\" border=\"0\" bordercolor=\"f1f1f1\" cellpadding=\"1\" cellspacing=\"1\" width=\"99%\">\r\n     ";
echo "             <tbody>\r\n                      <tr class=\"td_caption_1\">\r\n                    <td bordercolor=\"cccccc\" bgcolor=\"#DFEFFF\" width=\"50\"><div align=\"center\"> NO </div></td>\r\n                    <td bordercolor=\"cccccc\" bgcolor=\"#DFEFFF\"><div align=\"center\">\r\n                      ";
echo $downname;
echo "\t\t\t\t\t \r\n                    </div>\r\n                    </td>\r\n                    <td bordercolor=\"cccccc\" align=\"center\" bgcolor=\"#DFEFFF\">�]��</td>\r\n                    <td bordercolor=\"cccccc\" align=\"center\" bgcolor=\"#DFEFFF\">���]���~</td>\r\n                    <td bordercolor=\"cccccc\" align=\"center\" bgcolor=\"#DFEFFF\">��Ͷ���~</td>\r\n                    ";
if ( $_SESSION["user_power".$c_p_seesion] == 1 )
{
		echo "                    <td bordercolor=\"cccccc\" align=\"center\" bgcolor=\"#DFEFFF\">��˾ռ��</td>\r\n                    ";
}
if ( $_SESSION["user_power".$c_p_seesion] <= 2 )
{
		echo "                    <td bordercolor=\"cccccc\" align=\"center\" bgcolor=\"#DFEFFF\">�ֹ�˾ռ��</td>\r\n                    ";
}
if ( $_SESSION["user_power".$c_p_seesion] <= 3 )
{
		echo "                    <td bordercolor=\"cccccc\" align=\"center\" bgcolor=\"#DFEFFF\">�ɖ|ռ��</td>\r\n                    ";
}
if ( $_SESSION["user_power".$c_p_seesion] <= 4 )
{
		echo "                    <td bordercolor=\"cccccc\" align=\"center\" bgcolor=\"#DFEFFF\">������ռ��</td>\r\n                    ";
}
echo "                    <td bordercolor=\"cccccc\" align=\"center\" bgcolor=\"#DFEFFF\">����ռ��</td>\r\n                    </tr>\r\n                \r\n";
$k = 0;
foreach ( $downuser_arr as $du => $downuser )
{
		++$k;
		$downusername = $db->get_user_name( $downuser_arr[$du] );
		$tiaojian = "user_id={$downuser_arr[$du]}";
		$tiaojian = " is_zhishu=1 and {$tiaojian}";
		$u_query = mysql_query( "select * from orders where plate_num={$qishu} and {$tiaojian}" );
		$user_bishu = mysql_num_rows( $u_query );
		$user_arr = array( );
		while ( $row = mysql_fetch_array( $u_query ) )
		{
				$user_arr[] = $row['user_id'];
		}
		$user_arrs = array_flip( array_flip( $user_arr ) );
		foreach ( $user_arrs as $us )
		{
				$user_zonge = mysql_fetch_array( mysql_query( "select SUM(orders_y) as sum from orders where user_id={$us} and plate_num={$qishu} and {$tiaojian}" ) );
				$user_tuishui = mysql_fetch_array( mysql_query( "select SUM(tuishui_y) as sum from orders where user_id={$us} and plate_num={$qishu} and {$tiaojian}" ) );
				$user_zonge = round( $user_zonge[sum], 2 );
				$user_tuishui = round( $user_tuishui[sum], 2 );
				$gaiusers = $db->select( "users", "*", "user_id={$us}" );
				$gaiuser = $db->fetch_array( $gaiusers );
				$shizhanzhue1 = $user_zonge * $gaiuser['percent_company'] / 100;
				$shizhanzhue2 = $user_zonge * $gaiuser['percent_branch'] / 100;
				$shizhanzhue3 = $user_zonge * $gaiuser['percent_partner'] / 100;
				$shizhanzhue4 = $user_zonge * $gaiuser['percent_all_proxy'] / 100;
				$shizhanzhue5 = $user_zonge * $gaiuser['percent_proxy'] / 100;
				$shitouzonge = $user_zonge - $user_tuishui;
				$total_total = $user_zonge;
				$total_truetotal = $shitouzonge;
				$total_shizhanzhue1 = $shizhanzhue1;
				$total_shizhanzhue2 = $shizhanzhue2;
				$total_shizhanzhue3 = $shizhanzhue3;
				$total_shizhanzhue4 = $shizhanzhue4;
				$total_shizhanzhue5 = $shizhanzhue5;
		}
		echo "                      <tr>\r\n                    <td bordercolor=\"cccccc\" bgcolor=\"white\" width=\"50\"><div align=\"center\"> ";
		echo $k;
		echo " </div></td>\r\n                    <td bordercolor=\"cccccc\" bgcolor=\"white\"><div align=\"center\">\r\n                     ";
		echo $downusername;
		echo "\t\t\t \r\n                    </div>\r\n                    </td>\r\n                    <td bordercolor=\"cccccc\" align=\"center\" bgcolor=\"white\">";
		echo $user_bishu;
		echo "</td>\r\n                    <td bordercolor=\"cccccc\" align=\"center\" bgcolor=\"white\"><A  href=\"zd_huiyuan.php?power=6&user_id=";
		echo $downuser_arr[$du];
		echo "&qishu=";
		echo $qishu;
		echo "\">";
		echo $total_total;
		echo "</A></td>\r\n                    <td bordercolor=\"cccccc\" align=\"center\" bgcolor=\"white\">";
		echo $total_truetotal;
		echo "</td>\r\n                    ";
		if ( $_SESSION["user_power".$c_p_seesion] == 1 )
		{
				echo "                    <td bordercolor=\"cccccc\" align=\"center\" bgcolor=\"white\">";
				echo $total_shizhanzhue1;
				echo "</td>\r\n                    ";
		}
		if ( $_SESSION["user_power".$c_p_seesion] <= 2 )
		{
				echo "                    <td bordercolor=\"cccccc\" align=\"center\" bgcolor=\"white\">";
				echo $total_shizhanzhue2;
				echo "</td>\r\n                    ";
		}
		if ( $_SESSION["user_power".$c_p_seesion] <= 3 )
		{
				echo "                    <td bordercolor=\"cccccc\" align=\"center\" bgcolor=\"white\">";
				echo $total_shizhanzhue3;
				echo "</td>\r\n                    ";
		}
		if ( $_SESSION["user_power".$c_p_seesion] <= 4 )
		{
				echo "                    <td bordercolor=\"cccccc\" align=\"center\" bgcolor=\"white\">";
				echo $total_shizhanzhue4;
				echo "</td>\r\n                    ";
		}
		echo "                    <td bordercolor=\"cccccc\" align=\"center\" bgcolor=\"white\">";
		echo $total_shizhanzhue5;
		echo "</td>\r\n                    </tr>\r\n                ";
		$total_sum2 += $user_bishu;
		$total_total2 += $total_total;
		$total_truetotal2 += $total_truetotal;
		$total_shizhanzhue12 += $total_shizhanzhue1;
		$total_shizhanzhue22 += $total_shizhanzhue2;
		$total_shizhanzhue32 += $total_shizhanzhue3;
		$total_shizhanzhue42 += $total_shizhanzhue4;
		$total_shizhanzhue52 += $total_shizhanzhue5;
}
echo " \r\n                       \r\n\t\t<tr style=\"background-color: rgb(255, 255, 255);\" onmouseover=\"this.style.backgroundColor='#FFFFA2'\" onmouseout=\"this.style.backgroundColor='ffffff'\" bgcolor=\"#FFFFFF\">\r\n                    <td bordercolor=\"cccccc\" height=\"25\">&nbsp;</td>\r\n                    <td align=\"center\" height=\"25\">��Ӌ</td>\r\n                    <td align=\"center\" height=\"25\">";
echo $total_sum2;
echo "</td>\r\n                    <td align=\"center\" height=\"25\">";
echo $total_total2;
echo "</td>\r\n                    <td align=\"center\">";
echo $total_truetotal2;
echo "</td>\r\n                    ";
if ( $_SESSION["user_power".$c_p_seesion] == 1 )
{
		echo "                    <td align=\"center\">";
		echo $total_shizhanzhue12;
		echo "</td>\r\n                    ";
}
if ( $_SESSION["user_power".$c_p_seesion] <= 2 )
{
		echo "                    <td align=\"center\" height=\"25\">";
		echo $total_shizhanzhue22;
		echo "</td>\r\n                    ";
}
if ( $_SESSION["user_power".$c_p_seesion] <= 3 )
{
		echo "                    <td align=\"center\">";
		echo $total_shizhanzhue32;
		echo "</td>\r\n                    ";
}
if ( $_SESSION["user_power".$c_p_seesion] <= 4 )
{
		echo "                    <td align=\"center\" height=\"25\">";
		echo $total_shizhanzhue42;
		echo "</td>\r\n                    ";
}
echo "                    <td align=\"center\" height=\"25\">";
echo $total_shizhanzhue52;
echo "</td>\r\n                  </tr>\r\n                \r\n                </tbody></table>\r\n\t\t\t\t\r\n\t\t\t\t              </div>\r\n              <!-- �Y��  --></td>\r\n            <td background=\"../images/tab_15.gif\" width=\"8\">&nbsp;</td>\r\n          </tr>\r\n        </tbody>\r\n      </table></td>\r\n    </tr>\r\n    <tr>\r\n      <td background=\"../images/tab_19.gif\" height=\"35\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100";
echo "%\">\r\n        <tbody>\r\n          <tr>\r\n            <td height=\"35\" width=\"12\"><img src=\"../images/tab_18.gif\" height=\"35\" width=\"12\"></td>\r\n            <td valign=\"top\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" height=\"30\" width=\"100%\">\r\n              <tbody>\r\n                <tr>\r\n                  <td align=\"center\">&nbsp;</td>\r\n                </tr>\r\n              </tbody>\r\n            </table></td>\r\n ";
echo "           <td width=\"16\"><img src=\"../images/tab_20.gif\" height=\"35\" width=\"16\"></td>\r\n          </tr>\r\n        </tbody>\r\n      </table></td>\r\n    </tr>\r\n  </tbody>\r\n</table>\r\n\r\n</body></html>";
?>
