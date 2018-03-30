<?php
include_once( "../../global.php" );
$power = $_GET['power'];
if ( !$power )
{
		$power = $_SESSION["user_power".$c_p_seesion] + 1;
}
$get_user_limit = $_GET['get_user_limit'];
$t1 = $_GET['t1'];
$t2 = $_GET['t2'];
$youguan_id = $_GET['youguan_id'];
$db = new action( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
$db2 = new action( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
if ( 0 < $youguan_id )
{
		$youguan_id2 = $db->loweralluser_arr( $youguan_id, $power );
		$youguantiaojian = " and user_id in({$youguan_id},{$youguan_id2})";
}
$user_limit = $db->get_user_limit_char( $get_user_limit, $t1, $t2 );
if ( $user_limit )
{
		$user_limit = " and ".$user_limit;
}
$query = $db->select( "users", "count(*) as c", "user_power={$power} {$user_limit} {$youguantiaojian}" );
if ( isset( $_GET['zi'] ) )
{
		$user_limit = "is_extend=".$_SESSION["uid".$c_p_seesion].$user_limit;
		$query = $db->select( "users", "count(*) as c", "{$user_limit}" );
}
$total = $db->fetch_array( $query );
$total = $total['c'];
pageft( $total, 30 );
if ( $firstcount < 0 )
{
		$firstcount = 0;
}
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
		$tiaojian = "user_id in({$tiaojian}) and ";
}
if ( isset( $_GET['zi'] ) )
{
		$query = $db->select( "users", "*", "{$user_limit} limit {$firstcount}, {$displaypg}" );
}
else
{
		$query = $db->select( "users", "*", "{$tiaojian} user_power={$power} {$user_limit} {$youguantiaojian} order by else_last_login desc,else_created_at desc limit {$firstcount}, {$displaypg}" );
}
if ( isset( $_GET['zi'] ) )
{
		$user_char = $_SESSION["username".$c_p_seesion]."子账户";
}
else
{
		$user_char = $db->get_user_power_char( $power );
}
$yiman = 0;
if ( $power == 6 )
{
		$user_total = $db2->gaihuiyuankekaihuiyuanshu( $_SESSION["uid".$c_p_seesion] );
		if ( $total == $user_total )
		{
				$yiman = 1;
		}
}
echo "<html oncontextmenu=\"return false\" xmlns=\"http://www.w3.org/1999/xhtml\">\n<head>\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">\n</head>\n<body>\n<link href=\"../images/Index.css\" rel=\"stylesheet\" type=\"text/css\">\n";
echo "<s";
echo "cript src=\"../js/jquery-1.4.3.min.js\" type=\"text/javascript\"></script>\n";
echo "<s";
echo "cript src=\"js/normal.js\" type=\"text/javascript\"></script>\n";
echo "<s";
echo "cript type=\"text/javascript\">\nvar power=";
echo $power;
echo ";\nvar page=";
echo $_GET['page'] ? $_GET['page'] : 1;
echo ";\nvar t0=\"";
echo $_GET['get_user_limit'] ? $_GET['get_user_limit'] : 0;
echo "\";\nfunction C_Key(){\n        var t1=\$(\"#vip_name\").val();\n        var t2=\$(\"#vip_selectl\").val();\n        window.location.href=\"branch.php?t1=\"+t1+\"&t2=\"+t2+\"&power=\"+power+\"&page=1&get_user_limit=\"+t0;\n}\n\nfunction get_user_limit(th,youguan_id){\n    window.location.href=\"branch.php?get_user_limit=\"+th+\"&power=\"+power+\"&page=1\"+\"&youguan_id=\"+youguan_id;\n}\n</script>\n<table border=\"0\" cellpadding=\"0\" ";
echo "cellspacing=\"0\" width=\"100%\">\n  <tbody>\n    <tr>\n      <td background=\"../images/tab_05.gif\" height=\"30\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n          <tbody>\n            <tr>\n              <td height=\"30\" width=\"12\"><img src=\"../images/tab_03.gif\" height=\"30\" width=\"12\"></td>\n              <td><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n                  <tbody";
echo ">\n                    <tr>\n                      <td valign=\"middle\" width=\"87%\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n                          <tbody>\n                            <tr>\n                              <td width=\"1%\"><div align=\"center\"><img src=\"../images/tb.gif\" height=\"16\" width=\"16\"></div></td>\n                              <td class=\"F_bold\" width=\"32%\">";
echo "<s";
echo "pan id=\"ftm1\">";
echo $user_char;
echo "</span>管理</td>\n                              <td class=\"F_bold\" align=\"right\" nowrap=\"nowrap\" width=\"45\">篩選：</td>\n                              <td nowrap=\"nowrap\">";
echo "<s";
echo "elect name=\"VIP_Estate\" onChange=\"get_user_limit(\$(this).val(),0);\">\n                                  <option value=\"0\" ";
echo $get_user_limit == 0 ? "selected='selected'" : "";
echo ">全部</option>\n                                  <option value=\"1\" ";
echo $get_user_limit == 1 ? "selected='selected'" : "";
echo ">啟用</option>\n                                  <option value=\"3\" ";
echo $get_user_limit == 3 ? "selected='selected'" : "";
echo ">凍結</option>\n                                  <option value=\"2\" ";
echo $get_user_limit == 2 ? "selected='selected'" : "";
echo ">停用 </option>\n                                </select>\n                                &nbsp;&nbsp;</td>\n                              <td class=\"F_bold\" align=\"right\" nowrap=\"nowrap\" width=\"45\">搜索：</td>\n                              <td nowrap=\"nowrap\">\n                                  ";
echo "<s";
echo "elect id=\"vip_name\" name=\"VIP_name\" onChange=\"return C_Key();\">\n                                  <option ";
echo $t1 == 0 ? "selected='selected'" : "";
echo " value=\"0\">帳號：</option>\n                                  <option ";
echo $t1 == 1 ? "selected='selected'" : "";
echo " value=\"1\">名稱：</option>\n                                </select></td>\n                              \n                              <td class=\"F_bold\" width=\"67%\"><input value=\"";
echo $t2;
echo "\" name=\"key\" id=\"vip_selectl\" class=\"input1\" onBlur=\"return C_Key();\" type=\"text\">\n                                <input name=\"xctype\" id=\"xctype\" value=\"Czc!888\" type=\"hidden\"></td>\n                             <td class=\"F_bold\"  align=\"right\" nowrap=\"nowrap\" >\n                                 ";
if ( $yiman == 1 )
{
		echo "                                 <font color=\"green\"><b>可開會員數已滿！</b></font>\n                                 ";
}
else
{
		echo "                                 <a href=\"addbranch1.php?power=";
		echo $power;
		echo "\" class=\"button_a\">新增";
		echo $user_char;
		echo "</a>\n                                 ";
		if ( $power == 6 )
		{
				echo "                                    <a class=\"button_a\" href=\"addbranch.php?power=6&power2=";
				echo $_SESSION["user_power".$c_p_seesion]."&top_id=".$_SESSION["uid".$c_p_seesion]."&top_name=".$_SESSION["username".$c_p_seesion]."&top_power=".$_SESSION["user_power".$c_p_seesion]."&is_directly=1";
				echo "\"  target=\"content\">添加直屬會員</a>\n                                ";
		}
		echo "                                ";
}
echo "    \n                             </td>\n                              \n                            </tr>\n                          </tbody>\n                        </table></td>\n                    </tr>\n                  </tbody>\n                </table></td>\n              <td width=\"16\"><img src=\"../images/tab_07.gif\" height=\"30\" width=\"16\"></td>\n            </tr>\n          </tbody>\n        </table></td>\n    </t";
echo "r>\n    <tr>\n      <td><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n          <tbody>\n            <tr>\n              <td background=\"../images/tab_12.gif\" width=\"8\">&nbsp;</td>\n              <td align=\"center\" height=\"50\"><!-- 開始  -->\n                <div id=\"result\">\n                  <input name=\"fm33\" value=\"&lt;button onclick=show_win('AD0!888','AT0!888','D2kPUwVvVnQFMw5nVGY!888','500";
echo "','30'); class=button_a&gt;新增分公司&lt;/button&gt;\" type=\"hidden\">\n                  <table class=\"Ball_List Tab\" align=\"center\" bgcolor=\"ffffff\" border=\"0\" bordercolor=\"f1f1f1\" cellpadding=\"1\" cellspacing=\"1\" width=\"99%\">\n                    <tbody>\n                      <tr class=\"td_caption_1\">\n                        <td bordercolor=\"cccccc\" bgcolor=\"#DFEFFF\" nowrap=\"nowrap\" width=\"50\"><div align";
echo "=\"center\"> 在線 </div></td>\n                        ";
if ( $power == 6 )
{
		echo "                        <td bordercolor=\"cccccc\" bgcolor=\"#DFEFFF\" nowrap=\"nowrap\"><div align=\"center\">会员类型</div></td>\n                        ";
}
echo "                        <td bordercolor=\"cccccc\" bgcolor=\"#DFEFFF\" nowrap=\"nowrap\"><div align=\"center\">用戶</div></td>\n                        <td bordercolor=\"cccccc\" align=\"center\" bgcolor=\"#DFEFFF\" nowrap=\"nowrap\">名稱</td>\n                        <td bordercolor=\"cccccc\" align=\"center\" bgcolor=\"#DFEFFF\" nowrap=\"nowrap\">信用額度/余額</td>\n                        ";
if ( $power == 6 )
{
		echo "                        <td bordercolor=\"cccccc\" bgcolor=\"#DFEFFF\" nowrap=\"nowrap\"><div align=\"center\">代理</div></td>\n                        ";
}
echo "                        ";
if ( 4 < $power && $_SESSION["user_power".$c_p_seesion] <= 4 )
{
		echo "                        <td bordercolor=\"cccccc\" bgcolor=\"#DFEFFF\" nowrap=\"nowrap\"><div align=\"center\">总代理</div></td>\n                        ";
}
echo "                        ";
if ( 3 < $power && $_SESSION["user_power".$c_p_seesion] <= 3 )
{
		echo "                        <td bordercolor=\"cccccc\" bgcolor=\"#DFEFFF\" nowrap=\"nowrap\"><div align=\"center\">股东</div></td>\n                        ";
}
echo "                        ";
if ( $_SESSION["user_power".$c_p_seesion] <= 2 )
{
		echo "                        <td bordercolor=\"cccccc\" bgcolor=\"#DFEFFF\" nowrap=\"nowrap\"><div align=\"center\">分公司</div></td>\n                        ";
}
echo "                        ";
if ( 4 < $power )
{
		echo "                        <td bordercolor=\"cccccc\" bordercolordark=\"#FFFFFF\" align=\"center\" bgcolor=\"#DFEFFF\" nowrap=\"nowrap\">代理%</td>\n                        ";
}
echo "                        ";
if ( $_SESSION["user_power".$c_p_seesion] <= 4 )
{
		echo "                        <td bordercolor=\"cccccc\" bordercolordark=\"#FFFFFF\" align=\"center\" bgcolor=\"#DFEFFF\" nowrap=\"nowrap\">总代理%</td>\n                        ";
}
echo "                        ";
if ( $_SESSION["user_power".$c_p_seesion] <= 3 )
{
		echo "                        <td bordercolor=\"cccccc\" bordercolordark=\"#FFFFFF\" align=\"center\" bgcolor=\"#DFEFFF\" nowrap=\"nowrap\">股东%</td>\n                        ";
}
echo "                        ";
if ( $_SESSION["user_power".$c_p_seesion] <= 2 )
{
		echo "                        <td bordercolor=\"cccccc\" bordercolordark=\"#FFFFFF\" align=\"center\" bgcolor=\"#DFEFFF\" nowrap=\"nowrap\">分公司%</td>\n                        ";
}
echo "                        ";
if ( $_SESSION["user_power".$c_p_seesion] == 1 )
{
		echo "                        <td bordercolor=\"cccccc\" bordercolordark=\"#FFFFFF\" align=\"center\" bgcolor=\"#DFEFFF\" nowrap=\"nowrap\">公司%</td>\n                        ";
}
echo "                        <td bordercolor=\"cccccc\" bordercolordark=\"#FFFFFF\" align=\"center\" bgcolor=\"#DFEFFF\" nowrap=\"nowrap\">類型</td>\n                        <td bordercolor=\"cccccc\" align=\"center\" bgcolor=\"#DFEFFF\" nowrap=\"nowrap\">註冊時間</td>\n                        <td bordercolor=\"cccccc\" align=\"center\" bgcolor=\"#DFEFFF\" nowrap=\"nowrap\">登錄次数</td>\n                        <td bordercolor=\"cccccc\" ";
echo "align=\"center\" bgcolor=\"#DFEFFF\" nowrap=\"nowrap\">停押</td>\n                        <td bordercolor=\"cccccc\" align=\"center\" bgcolor=\"#DFEFFF\" nowrap=\"nowrap\">狀況</td>\n                        ";
if ( $power < 6 )
{
		echo "                        <td bordercolor=\"cccccc\" align=\"center\" bgcolor=\"#DFEFFF\" nowrap=\"nowrap\">補貨</td>\n                        ";
}
echo "                        <td bordercolor=\"cccccc\" bgcolor=\"#DFEFFF\" nowrap=\"NOWRAP\"><div align=\"center\">操作 </div></td>\n                      </tr>\n ";
while ( $row = $db->fetch_array( $query ) )
{
		echo "                       \n                      <tr style=\"background-color: rgb(255, 255, 255);\" onMouseOver=\"this.style.backgroundColor='#FFFFA2'\" onMouseOut=\"this.style.backgroundColor='ffffff'\" bgcolor=\"#FFFFFF\">\n                        <td bordercolor=\"cccccc\" height=\"25\"><div align=\"center\">    ";
		$info = mysql_fetch_array( mysql_query( "select auc.datetime from admin_users_action  auc left join users u on u.user_id = auc.uid  where auc.uid =  ".$row['user_id']." and u.is_online = 1 order by auc.datetime desc limit  1" ) );
		$min = mktime( ) - $info['datetime'];
		echo $min <= 1800 ? "<img src='../images/USER_1.gif'>" : "<img src='../images/USER_0.gif'>";
		echo " </div></td>\n                        ";
		if ( $power == 6 )
		{
				echo "                        <td bordercolor=\"cccccc\" nowrap=\"nowrap\"><div align=\"center\">";
				echo $row['is_directly'] == 1 ? "直属会员" : "普通会员";
				echo "</div></td>\n                        ";
		}
		echo "                        <td align=\"center\" height=\"25\">";
		echo $row['user_name'];
		echo " </td>\n                        <td align=\"center\" height=\"25\">";
		echo $row['user_nick'];
		echo "</td>\n                        <td align=\"center\" height=\"25\" nowrap=\"nowrap\">";
		echo $row['credit_total']."/".$row['credit_remainder'];
		echo "</td>\n                        \n                        ";
		$aadd = $db2->get_tops2( $row['user_id'] );
		$aa = $aadd['proxy'];
		$you_guan_uid5 = $db2->Is_user_here( $aa, 1 );
		$bb = $aadd['proxy_all'];
		$you_guan_uid4 = $db2->Is_user_here( $bb, 1 );
		$cc = $aadd['partner'];
		$you_guan_uid3 = $db2->Is_user_here( $cc, 1 );
		$dd = $aadd['branch'];
		$you_guan_uid2 = $db2->Is_user_here( $dd, 1 );
		if ( $power == 6 && $row['is_directly'] == 1 )
		{
				$aa = $bb = $cc = $dd = $row['top_name'];
				$you_guan_uid5 = $you_guan_uid4 = $you_guan_uid3 = $you_guan_uid2 = $db2->Is_user_here( $aa, 1 );
		}
		echo "                        ";
		if ( $power == 6 )
		{
				echo "                        <td bordercolor=\"cccccc\" nowrap=\"nowrap\"><div align=\"center\"><a href=\"#\" onclick=\"get_user_limit(0,";
				echo $you_guan_uid5;
				echo ");\">";
				echo $aa;
				echo "</a></div></td>\n                        ";
		}
		echo "                        ";
		if ( 4 < $power && $_SESSION["user_power".$c_p_seesion] <= 4 )
		{
				echo "                        <td bordercolor=\"cccccc\" nowrap=\"nowrap\"><div align=\"center\"><a href=\"#\" onclick=\"get_user_limit(0,";
				echo $you_guan_uid4;
				echo ");\">";
				echo $bb;
				echo "</a></div></td>\n                        ";
		}
		echo "                        ";
		if ( 3 < $power && $_SESSION["user_power".$c_p_seesion] <= 3 )
		{
				echo "                        <td bordercolor=\"cccccc\" nowrap=\"nowrap\"><div align=\"center\"><a href=\"#\" onclick=\"get_user_limit(0,";
				echo $you_guan_uid3;
				echo ");\">";
				echo $cc;
				echo "</a></div></td>\n                        ";
		}
		echo "                        ";
		if ( $_SESSION["user_power".$c_p_seesion] <= 2 )
		{
				echo "                        <td bordercolor=\"cccccc\" nowrap=\"nowrap\"><div align=\"center\"><a href=\"#\" onclick=\"get_user_limit(0,";
				echo $you_guan_uid2;
				echo ");\">";
				echo $dd;
				echo "</a></div></td>\n                        ";
		}
		echo "                        ";
		if ( 4 < $power )
		{
				echo "                        <td bordercolor=\"cccccc\" bordercolordark=\"#FFFFFF\" align=\"center\">";
				echo $row['percent_proxy'];
				echo " %</td>\n                        ";
		}
		echo "                        ";
		if ( $_SESSION["user_power".$c_p_seesion] <= 4 )
		{
				echo "                        <td bordercolor=\"cccccc\" bordercolordark=\"#FFFFFF\" align=\"center\">";
				echo $row['percent_all_proxy'];
				echo " %</td>\n                        ";
		}
		echo "                        ";
		if ( $_SESSION["user_power".$c_p_seesion] <= 3 )
		{
				echo "                        <td bordercolor=\"cccccc\" bordercolordark=\"#FFFFFF\" align=\"center\">";
				echo $row['percent_partner'];
				echo " %</td>\n                        ";
		}
		echo "                        ";
		if ( $_SESSION["user_power".$c_p_seesion] <= 2 )
		{
				echo "                        <td bordercolor=\"cccccc\" bordercolordark=\"#FFFFFF\" align=\"center\" height=\"25\">";
				echo $row['percent_branch'];
				echo "%</td>\n                        ";
		}
		echo "                        ";
		if ( $_SESSION["user_power".$c_p_seesion] == 1 )
		{
				echo "                        <td bordercolor=\"cccccc\" bordercolordark=\"#FFFFFF\" align=\"center\">";
				echo $row['percent_company'];
				echo " %</td>\n                        ";
		}
		echo "                        <td bordercolor=\"cccccc\" bordercolordark=\"#FFFFFF\" align=\"center\" nowrap=\"nowrap\">";
		echo $row['else_plate'];
		echo "盤</td>\n                        <td align=\"center\" height=\"25\">";
		echo $row['else_created_at'];
		echo "</td>\n                        <td align=\"center\" width=\"60\">";
		echo "<s";
		echo "pan> ";
		echo $row['else_count_login'];
		echo " </span></td>\n                        <td align=\"center\">\n                            <input type=\"hidden\" value=\"";
		echo $row['is_bet'];
		echo "\" />\n                            <button class=\"button_a\" onClick=\"set_is(\$(this),1,";
		echo $row['user_id'];
		echo ")\"> ";
		echo $row['is_bet'] == 0 ? "已開啟" : "<font color='ff0000'>禁止</font>";
		echo " </button></td>\n                        <td align=\"center\" height=\"25\">\n                            <input type=\"hidden\" value=\"";
		echo $row['is_lock'];
		echo "\" />\n                            <button class=\"button_a\" onClick=\"set_is(\$(this),2,";
		echo $row['user_id'];
		echo ")\">";
		echo $row['is_lock'] == 0 ? "已開啟" : "<font color='ff0000'>禁止</font>";
		echo "</button></td>\n                        ";
		if ( $power < 6 )
		{
				echo "                        <td align=\"center\">\n                            <input type=\"hidden\" value=\"";
				echo $row['is_add'];
				echo "\" />\n                            <button class=\"button_a\" onClick=\"set_is(\$(this),3,";
				echo $row['user_id'];
				echo ")\"> ";
				echo $row['is_add'] == 0 ? "允許" : "<font color='ff0000'>禁止</font>";
				echo " </button></td>\n                         ";
		}
		echo "   \n                        <td nowrap=\"nowrap\"><div align=\"center\">\n                            <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\n                              <tbody>\n                                <tr valign=\"bottom\">\n                                ";
		if ( $power < 5 )
		{
				echo " \n                                    <td height=\"18\" width=\"14\"><img src=\"../images/22.gif\" height=\"14\" width=\"14\"></td>\n                                  <td nowrap=\"NOWRAP\">\n                                  <a href=\"addbranch.php?power=6&power2=";
				echo $power."&top_id=".$row['user_id']."&top_name=".$row['user_name']."&top_power=".$row['user_power']."&is_directly=1";
				echo "\"  target=\"content\">添加直屬會員</a></td>\n                                ";
		}
		echo "  \n                                    <td height=\"18\" nowrap=\"nowrap\" width=\"14\"><img src=\"../images/edt.gif\"></td>\n                                  <td nowrap=\"nowrap\" width=\"30\"><a href=\"reback.php?power=";
		echo $power."&user_id=".$row['user_id'];
		echo "\"  target=\"content\">退水</a></td>\n                                  <td height=\"18\" nowrap=\"nowrap\" width=\"15\"><img src=\"../images/edit.gif\" height=\"15\" width=\"14\"></td>\n                                  <td nowrap=\"nowrap\" width=\"30\"><a href=\"update_mes.php?power=";
		echo $power."&user_id=".$row['user_id'];
		echo "\"  target=\"content\">修改</a></td>\n                                  <td nowrap=\"nowrap\" width=\"16\"><img src=\"../images/55.gif\"></td>\n                                  <td nowrap=\"nowrap\" width=\"30\"><a href=\"user_log.php?user_id=";
		echo $row['user_id']."&user_name=".$row['user_name'];
		echo "\"  target=\"content\">日誌</a></td>\n                                  <td nowrap=\"nowrap\" width=\"16\"><img src=\"../images/44.gif\"></td>       \n                                  <td nowrap=\"nowrap\" width=\"26\"><a href=\"mark.php?user_id=";
		echo $row['user_id']."&user_name=".$row['user_name'];
		echo "\"  target=\"content\">記錄</a></td>\n                                  ";
		if ( $power < 6 )
		{
				echo " \n                                  <td nowrap=\"nowrap\" width=\"16\"><img src=\"../images/uesr.gif\" height=\"14\" width=\"14\"></td>\n                                  <td nowrap=\"NOWRAP\"><a href=\"son_user.php?user_id=";
				echo $row['user_id']."&user_name=".$row['user_name'];
				echo "\"  target=\"content\">子賬號</a></td>\n                                  ";
		}
		echo "  \n                                  ";
		
		
				echo " \n                                                           ";
		
		echo "  \n                                </tr>\n                              </tbody>\n                            </table>\n                          </div></td>\n                      </tr>\n";
}
echo "                       <tr>\n                       \n                            <td colspan=\"25\" bordercolor=\"cccccc\" bgcolor=\"#FFFFFF\" height=\"25\"><div id=\"fm\" align=\"center\">\n                             ";
echo $pagenav;
echo "                            \n                            </div></td>\n                    </tr>\n                    </tbody>\n                  </table>\n                </div>\n                <!-- 結束  --></td>\n              <td background=\"../images/tab_15.gif\" width=\"8\">&nbsp;</td>\n            </tr>\n          </tbody>\n        </table></td>\n    </tr>\n    <tr>\n      <td background=\"../images/tab_19.gif\" height=\"35\"";
echo "><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n          <tbody>\n            <tr>\n              <td height=\"35\" width=\"12\"><img src=\"../images/tab_18.gif\" height=\"35\" width=\"12\"></td>\n              <td valign=\"top\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" height=\"30\" width=\"100%\">\n                  <tbody>\n                    <tr>\n                      <td align=\"center\">&nbsp;</td>";
echo "\n                    </tr>\n                  </tbody>\n                </table></td>\n              <td width=\"16\"><img src=\"../images/tab_20.gif\" height=\"35\" width=\"16\"></td>\n            </tr>\n          </tbody>\n        </table></td>\n    </tr>\n  </tbody>\n</table>\n</body>\n</html>";
?>
