<?php
include_once( "../../global.php" );
$db = new mysql( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
$db2 = new mysql( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
$qishus = $db->select( "plate", "*", "1 order by plate_num desc limit 1" );
$qishu = $db->fetch_array( $qishus );
$tiaojian = $db->loweralluser_arr( $_SESSION["uid".$c_p_seesion] );
if ( $_SESSION["user_power".$c_p_seesion] == 1 )
{
		$tiaojian = "user_id>0 and ";
}
else if ( !$tiaojian )
{
		$tiaojian = "user_id=0 and ";
}
else
{
		$tiaojian = "user_id in({$tiaojian},{$_SESSION["uid".$c_p_seesion]}) and ";
}
$x = $db->select( "orders", "*", "{$tiaojian} plate_num={$qishu['plate_num']} order by id desc limit 0,100" );
echo "<html oncontextmenu=\"return false\" xmlns=\"http://www.w3.org/1999/xhtml\"><head>\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=gbk\">\n";
echo "<s";
echo "cript src=\"../js/jquery-1.4.3.min.js?i=0\" type=\"text/javascript\"></script>    \n<link href=\"../images/Index.css\" rel=\"stylesheet\" type=\"text/css\">\n";
if ( !empty( $_GET['jishizhudanshuaxinshijian'] ) )
{
		if ( $_GET['jishizhudanshuaxinshijian'] == -1 )
		{
				$_SESSION["jishizhudanshuaxinshijian".$c_p_seesion] = 0;
		}
		else
		{
				$_SESSION["jishizhudanshuaxinshijian".$c_p_seesion] = $_GET['jishizhudanshuaxinshijian'];
		}
}
echo " \n";
if ( !empty( $_SESSION["jishizhudanshuaxinshijian".$c_p_seesion] ) )
{
		echo "<s";
		echo "cript language=\"JavaScript\">  \niso();    \nvar ii=";
		echo $_SESSION["jishizhudanshuaxinshijian".$c_p_seesion];
		echo ";\nfunction iso(){\n    ii--;\n    if(ii<'0'){\n        ii=";
		echo $_SESSION["jishizhudanshuaxinshijian".$c_p_seesion];
		echo ";\n        sendform(ii); \n    }\n    \$(\"#n\").text(ii);\n    setTimeout(\"iso()\",1000);\n}\n</script> \n";
}
echo "<S";
echo "CRIPT type=\"text/javascript\">\n    function sendform(v){\n        if(v==''){\n        v = \"";
echo $_SESSION["jishizhudanshuaxinshijian".$c_p_seesion];
echo "\";\n        }\n        var plate_num = \$(\"#plate_num\");\n        var url = 'jklszd.php';\n        url += \"?plate_num=\"+plate_num.val()+\"&jishizhudanshuaxinshijian=\"+v;\n\n        window.open(url,'_self');\n    }\n</SCRIPT>  \n <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n  <tbody>\n    <tr>\n      <td background=\"../images/tab_05.gif\" height=\"30\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\"";
echo " width=\"100%\">\n        <tbody>\n          <tr>\n            <td height=\"30\" width=\"12\"><img src=\"../images/tab_03.gif\" height=\"30\" width=\"12\"></td>\n            <td><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n              <tbody>\n                <tr>\n                  <td valign=\"middle\" width=\"87%\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n                    <tbody>\n ";
echo "                     <tr>\n                        <td width=\"1%\"><div align=\"center\"><img src=\"../images/tb.gif\" height=\"16\" width=\"16\"></div></td>\n                        <td class=\"F_bold\" width=\"19%\">監控流水賬单(最新100单)</td>\n                        <td class=\"F_bold\" width=\"29%\"></td>\n                        <td width=\"179\" align=\"right\"><input id=\"plate_num\" type=\"hidden\" value=\"";
echo $qishu['plate_num'];
echo "\" /> \n                                ";
echo "<s";
echo "pan id=\"n\">";
echo $_SESSION["jishizhudanshuaxinshijian".$c_p_seesion];
echo "</span>秒\n                                ";
echo "<s";
echo "elect name=\"oReload\" onchange=\"sendform(this.value)\">\n                                    <option value=\"-1\" ";
echo empty( $_SESSION["jishizhudanshuaxinshijian".$c_p_seesion] ) ? "selected=\"selected\"" : "";
echo ">NO</option>\n                                  <option value=\"10\" ";
echo $_SESSION["jishizhudanshuaxinshijian".$c_p_seesion] == 10 ? "selected=\"selected\"" : "";
echo ">10 </option>\n                                  <option value=\"30\" ";
echo $_SESSION["jishizhudanshuaxinshijian".$c_p_seesion] == 30 ? "selected=\"selected\"" : "";
echo ">30 </option>\n                                  <option value=\"60\" ";
echo $_SESSION["jishizhudanshuaxinshijian".$c_p_seesion] == 60 ? "selected=\"selected\"" : "";
echo ">60 </option>\n                                  <option value=\"120\" ";
echo $_SESSION["jishizhudanshuaxinshijian".$c_p_seesion] == 120 ? "selected=\"selected\"" : "";
echo ">120 </option>\n                                </select>\n                               </td>\n                      </tr>\n                    </tbody>\n                  </table></td>\n                  </tr>\n              </tbody>\n            </table></td>\n            <td width=\"16\"><img src=\"../images/tab_07.gif\" height=\"30\" width=\"16\"></td>\n          </tr>\n        </tbody>\n      </table></td>\n    </tr>\n    <tr>\n  ";
echo "    <td><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n        <tbody>\n          <tr>\n            <td background=\"../images/tab_12.gif\" width=\"8\">&nbsp;</td>\n            <td align=\"center\" height=\"50\"><!-- 開始  -->\n              <div id=\"result\">\n                                <table class=\"Ball_List Tab\" align=\"center\" bgcolor=\"ffffff\" border=\"0\" bordercolor=\"f1f1f1\" cellpadding=\"1\" cell";
echo "spacing=\"1\" width=\"99%\">\n                  <tbody>\n                    <tr class=\"td_caption_1\">\n                    <td bordercolor=\"cccccc\" bgcolor=\"#DFEFFF\" width=\"50\"><div align=\"center\"> NO </div></td>\n                    <td bordercolor=\"cccccc\" bgcolor=\"#DFEFFF\"><div align=\"center\">会员</div></td>\n                    <td bordercolor=\"cccccc\" align=\"center\" bgcolor=\"#DFEFFF\">下单时间</td>\n              ";
echo "      <td bordercolor=\"cccccc\" align=\"center\" bgcolor=\"#DFEFFF\">期数</td>\n                    <td bordercolor=\"cccccc\" align=\"center\" bgcolor=\"#DFEFFF\">下注总额</td>\n                    <td bordercolor=\"cccccc\" align=\"center\" bgcolor=\"#DFEFFF\">";
echo "<s";
echo "pan class=\"m_title_reall\">赔率</span></td>\n                    <td bordercolor=\"cccccc\" align=\"center\" bgcolor=\"#DFEFFF\">";
echo "<s";
echo "pan class=\"m_title_reall\">退佣%</span></td>\n                    <td bordercolor=\"cccccc\" align=\"center\" bgcolor=\"#DFEFFF\">";
echo "<s";
echo "pan class=\"m_title_reall\">类型1</span></td>\n                    <td bordercolor=\"cccccc\" align=\"center\" bgcolor=\"#DFEFFF\">";
echo "<s";
echo "pan class=\"m_title_reall\">类型2</span></td>\n                    <td bordercolor=\"cccccc\" align=\"center\" bgcolor=\"#DFEFFF\">";
echo "<s";
echo "pan class=\"m_title_reall\">球号</span></td>\n                    </tr>\n                  ";
$i = 0;
while ( $row = $db->fetch_array( $x ) )
{
		++$i;
		$q = $db2->select( "users", "user_name", "user_id={$row['user_id']}" );
		$u = $db2->fetch_array( $q );
		$user_name = $u['user_name'];
		echo "                      <tr>\n                    <td bordercolor=\"cccccc\" bgcolor=\"white\" width=\"50\"><div align=\"center\"> ";
		echo $i;
		echo " </div></td>\n                    <td bordercolor=\"cccccc\" bgcolor=\"white\"><div align=\"center\">";
		echo $user_name;
		echo "</div></td>\n                    <td bordercolor=\"cccccc\" align=\"center\" bgcolor=\"white\">";
		echo date( "Y-m-d H:i", $row['time'] );
		echo "</td>\n                    <td bordercolor=\"cccccc\" align=\"center\" bgcolor=\"white\">";
		echo $row['plate_num'];
		echo "</td>\n                    <td bordercolor=\"cccccc\" align=\"center\" bgcolor=\"white\">";
		echo $row['orders_y'];
		echo "</td>\n                    <td bordercolor=\"cccccc\" align=\"center\" bgcolor=\"white\">";
		echo "<s";
		echo "pan class=\"m_title_reall\">";
		echo $row['orders_p'];
		echo "</span></td>\n                    <td bordercolor=\"cccccc\" align=\"center\" bgcolor=\"white\">";
		echo "<s";
		echo "pan class=\"m_title_reall\">";
		echo $row['h_tui'];
		echo "%</span></td>\n                    <td bordercolor=\"cccccc\" align=\"center\" bgcolor=\"white\">";
		echo "<s";
		echo "pan class=\"m_title_reall\">";
		echo $row['o_type1'];
		echo "</span></td>\n                    <td bordercolor=\"cccccc\" align=\"center\" bgcolor=\"white\">";
		echo "<s";
		echo "pan class=\"m_title_reall\">";
		echo $row['o_type2'];
		echo "</span></td>\n                    <td bordercolor=\"cccccc\" align=\"center\" bgcolor=\"white\">";
		echo "<s";
		echo "pan class=\"m_title_reall\">";
		echo $row['o_type3'];
		echo "</span></td>\n                    </tr>\n                  ";
}
echo "\t\t\t\t\t                </tbody></table>\n                              </div>\n              <!-- 結束  --></td>\n            <td background=\"../images/tab_15.gif\" width=\"8\">&nbsp;</td>\n          </tr>\n        </tbody>\n      </table></td>\n    </tr>\n    <tr>\n      <td background=\"../images/tab_19.gif\" height=\"35\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n        <tbody>\n          <tr>\n            <t";
echo "d height=\"35\" width=\"12\"><img src=\"../images/tab_18.gif\" height=\"35\" width=\"12\"></td>\n            <td valign=\"top\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" height=\"30\" width=\"100%\">\n              <tbody>\n                <tr>\n                  <td align=\"center\">&nbsp;</td>\n                </tr>\n              </tbody>\n            </table></td>\n            <td width=\"16\"><img src=\"../images/tab_20.gif\" h";
echo "eight=\"35\" width=\"16\"></td>\n          </tr>\n        </tbody>\n      </table></td>\n    </tr>\n  </tbody>\n</table>\n</body></html>";
?>
