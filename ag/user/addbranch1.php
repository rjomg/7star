<?php
include_once( "../../global.php" );
$power = $_GET['power'];
if ( !$power )
{
		$power = $_SESSION["user_power".$c_p_seesion] + 1;
}
$db = new action( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
$user_char = $db->get_user_power_char( $power );
if ( $power == @jiahe )
{
		$rd = 1e+014;
}
$is_directly = $_GET['is_directly'];
if ( $is_directly == 1 )
{
		$top_id = $_GET['top_id'];
		$top_name = $_GET['top_name'];
		$top_power = $_GET['top_power'];
		$power2 = $_GET['power2'];
		$remainder = $db->select( "users", "user_power,credit_remainder,else_plate,percent_company,percent_branch,percent_partner,percent_all_proxy,else_plate", "user_id={$top_id}" );
		$rdo = $db->fetch_array( $remainder );
		$this_else_plate = explode( ",", $rd['else_plate'] );
		$rd = $rdo['credit_remainder'];
		$rdo_power = $rdo['user_power'];
		$percent_char = $db->get_key_power_char( $rdo_power );
		$this_else_plate = explode( ",", $rdo['else_plate'] );
}
if ( $power == @jiahe )
{
		$this_else_plate = array( "A", "B", "C", "D" );
}
$myuid = $_SESSION["uid".$c_p_seesion];
$downusers = $db->loweralluser_arr( $myuid );
$user_total = $db->kekaihuiyuanshu( $power );
echo "<html oncontextmenu=\"return false\" xmlns=\"http://www.w3.org/1999/xhtml\"><head>\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">\n";
echo "<s";
echo "cript src=\"../js/jquery-1.4.3.min.js\" type=\"text/javascript\"></script>\n";
echo "<s";
echo "cript src=\"js/normal.js?i=4\" type=\"text/javascript\"></script>\n\n</head>\n<body onselect=\"document.selection.empty()\" oncopy=\"document.selection.empty()\" onmouseover=\"self.status='歡迎光臨';return true\">\n<div id=\"ly\" style=\"position: absolute; top: 0px; background-color: rgb(255, 255, 255); z-index: 2; left: 0px; display: block; width: 1354px; height: 513px;\">\n <!--[if lte IE 6.5]><iframe></iframe><![endif]-";
echo "->\n</div>\n<!--          浮層框架開始         -->\n<div id=\"rs_window\" style=\"position: absolute; top: 30px; z-index: 2000; left: 427px; display: block;\">\n\n<link href=\"../images/Index.css\" rel=\"stylesheet\" type=\"text/css\">\n <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"500\">\n  <tbody>\n    <tr>\n      <td background=\"../images/tab_05.gif\" height=\"30\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\"";
echo " width=\"100%\">\n        <tbody>\n          <tr>\n            <td height=\"30\" width=\"12\"><img src=\"../images/tab_03.gif\" height=\"30\" width=\"12\"></td>\n            <td><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n              <tbody>\n                <tr>\n                  <td valign=\"middle\" width=\"87%\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n                    <tbody>\n ";
echo "                     <tr>\n                        <td width=\"1%\"><div align=\"center\"><img src=\"../images/tb.gif\" height=\"16\" width=\"16\"></div></td>\n                        <td class=\"F_bold\" width=\"32%\">新增";
echo $user_char;
echo "账户</td>\n                        <td class=\"F_bold\" align=\"right\" width=\"67%\"><a href=\"javascript:history.back(-1)\"><img src=\"../images/icon_21x21_del.gif\" border=\"0\" height=\"16\" width=\"16\"></a></td>\n                        </tr>\n                    </tbody>\n                  </table></td>\n                  </tr>\n              </tbody>\n            </table></td>\n            <td width=\"16\"><img src=\"../images/tab_";
echo "07.gif\" height=\"30\" width=\"16\"></td>\n          </tr>\n        </tbody>\n      </table></td>\n    </tr>\n    <tr>\n      <td>\n        <form action=\"add_user.php\" method=\"post\" name=\"testFrm\" id=\"testFrm\" onSubmit=\"return SubChk()\">  \n          <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n        <tbody>\n          <tr>\n            <td background=\"../images/tab_12.gif\" width=\"8\">&nbsp;</td>\n         ";
echo "   <td align=\"center\" height=\"50\"><!-- 開始  -->\n              <div id=\"result\">\n             \n\t\t\t\t<table class=\"Ball_List\" border=\"0\" bordercolor=\"#ECE9D8\" cellpadding=\"1\" cellspacing=\"1\" width=\"99%\">\n                   \n\t\t<tbody>\n                    \n           ";
if ( $power != 2 && $is_directly != 1 )
{
		echo "         \n                     <tr>\n                         <td bordercolor=\"#CCCCCC\" class=\"t_Edit_caption\" align=\"right\" height=\"30\" width=\"18%\">上级";
		echo $db->get_user_power_char( $power - 1 );
		echo "</td>\n                      <td bordercolor=\"#CCCCCC\" align=\"left\" bgcolor=\"#FFFFFF\" width=\"82%\">\n                          ";
		echo "<s";
		echo "elect onchange=\"get_top_percent(\$(this).val());get_topyue(\$(this).val());\" id=\"temppid\" name=\"top\">\n                              <option value=\"\">--</option>\n                              ";
		$user_sql = $db->select( "users", "user_id,user_name,user_power,credit_remainder", "is_extend=0 and user_id in({$myuid}) and user_power=".( $power - 1 ) );
		while ( $row = $db->fetch_array( $user_sql ) )
		{
				echo "                              <option value=\"";
				echo $row['user_id'].",".$row['user_name'].",".$row['user_power'].",".$row['credit_remainder'];
				echo "\">";
				echo $row['user_name'];
				echo "</option>\n                              ";
		}
		echo "                          </select>&nbsp;&nbsp;&nbsp;";
		echo "<s";
		echo "pan id=\"topyue\"></span>\n                      </td>\n                    </tr>\n             ";
}
else if ( $is_directly == 1 )
{
		echo "     \n                   <tr>\n                    <td bordercolor=\"#CCCCCC\" class=\"t_Edit_caption\" align=\"right\" height=\"30\" width=\"18%\">上级";
		echo $db->get_user_power_char( $power2 );
		echo "</td>\n                      <td bordercolor=\"#CCCCCC\" align=\"left\" bgcolor=\"#FFFFFF\" width=\"82%\">\n                          <input id=\"top_id\" type=\"hidden\" name=\"top_id\" value=\"";
		echo $top_id;
		echo "\" />\n                          <input type=\"hidden\" name=\"top_name\" value=\"";
		echo $top_name;
		echo "\" />\n                          <input type=\"hidden\" name=\"top_power\" value=\"";
		echo $top_power;
		echo "\" />\n                          <input type=\"hidden\" name=\"is_directly\" value=\"";
		echo $is_directly;
		echo "\" />\n                          ";
		echo $top_name;
		echo "                      </td> \n             ";
}
echo "                    <tr>\n                      <td bordercolor=\"#CCCCCC\" class=\"t_Edit_caption\" align=\"right\" height=\"30\" width=\"18%\">";
echo $user_char;
echo "账号</td>\n                      <td bordercolor=\"#CCCCCC\" align=\"left\" bgcolor=\"#FFFFFF\" width=\"82%\">\n                          <input name=\"user_name\" id=\"kauser\" class=\"inp1\" onchange=\"get_user_is_czai(\$(this).val());\" type=\"text\">&nbsp;&nbsp;&nbsp;";
echo "<s";
echo "pan id=\"Find_Return\">\n                      </span>\n                        <input name=\"id\" id=\"id\" value=\"XGE!888\" type=\"hidden\">\n                        <input name=\"type1\" id=\"type1\" value=\"";
echo $power;
echo "\" type=\"hidden\"></td>\n                    </tr>\n                    <tr>\n                      <td bordercolor=\"#CCCCCC\" class=\"t_Edit_caption\" align=\"right\" height=\"30\" width=\"18%\">登录密码</td>\n                      <td bordercolor=\"#CCCCCC\" align=\"left\" bgcolor=\"#FFFFFF\" width=\"82%\"><input name=\"user_pwd\" class=\"input1\" id=\"kapassword\" type=\"password\"></td>\n                    </tr>\n                    ";
echo "<tr>\n                      <td bordercolor=\"#CCCCCC\" class=\"t_Edit_caption\" align=\"right\" height=\"30\" width=\"18%\">";
echo $user_char;
echo "名称</td>\n                      <td bordercolor=\"#CCCCCC\" align=\"left\" bgcolor=\"#FFFFFF\" width=\"82%\"><input name=\"user_nick\" class=\"input1\" id=\"xm\" type=\"text\"></td>\n                    </tr>\n                    <tr>\n                      <td bordercolor=\"#CCCCCC\" class=\"t_Edit_caption\" align=\"right\" height=\"30\" width=\"18%\">总信用额</td>\n                      <td bordercolor=\"#CCCCCC\" align=\"left\" bgcolor=";
echo "\"#FFFFFF\" width=\"82%\"><input onKeyUp=\"To_RMB();\" name=\"credit_total\" class=\"input1\" id=\"cs\" value=\"0\" type=\"text\">";
echo "<s";
echo "pan class=\"Font_R F_bold\" id=\"RMB_XY\"></span>\n\n  <input id=\"kyx\" name=\"kyx\" class=\"input1\" readonly value=\"";
echo $rd;
echo "\" type=\"hidden\"></td>\n\n                    </tr>\n                    <tr>\n                      <td bordercolor=\"#CCCCCC\" class=\"t_Edit_caption\" align=\"right\" height=\"30\" width=\"18%\">占成设置</td>\n                      <td bordercolor=\"#CCCCCC\" align=\"left\" bgcolor=\"#FFFFFF\" width=\"82%\">\n                          ";
echo "<s";
echo "pan class=\"STYLE2\" style=\"DISPLAY: \">\n                          ";
if ( $is_directly == 1 )
{
		echo $db->get_user_power_char( $power2 );
}
else
{
		echo $db->get_user_power_char( $power - 1 );
}
echo "                          </span>\n                        ";
echo "<s";
echo "elect onchange=\"lian_dong(\$(this).val())\" class=\"za_select_02\" name=\"";
echo $is_directly != 1 ? $db->get_key_power_char( $power - 1 ) : $percent_char;
echo "\" id=\"sj\">\n                           <option value=\"0\">不占成</option>\n                           ";
$i = 1;
for ( ;	$i <= $rdo[$percent_char];	++$i	)
{
		echo "                           <option calss=\"opt\" value=\"";
		echo $i;
		echo "\">";
		echo $i."%";
		echo "</option>\n                           ";
}
echo "                         </select>\n                          ";
if ( $power < 6 )
{
		echo "<s";
		echo "pan class=\"STYLE2\" style=\"DISPLAY: \">\t\t\t\t\t\t\t\t  \n ";
		echo $user_char;
		echo "<s";
		echo "elect class=\"za_select_02\" name=\"";
		echo $db->get_key_power_char( $power );
		echo "\" id=\"sf\">\n    <option value=\"0\">不占成</option>\n        ";
		$i = 1;
		for ( ;	$i < 101;	++$i	)
		{
				echo "        <option value=\"";
				echo $i;
				echo "\">";
				echo $i."%";
				echo "</option>\n        ";
		}
		echo "  </select>\n</span>\n";
}
echo "<input name=\"fc1\" id=\"fc1\" value=\"0\" type=\"hidden\">\n<input name=\"fc2\" id=\"fc2\" value=\"100\" type=\"hidden\">\n<input name=\"c1\" id=\"c1\" value=\"0\" type=\"hidden\">\n<input name=\"c2\" id=\"c2\" value=\"0\" type=\"hidden\">\n<input name=\"sff\" id=\"sff\" value=\"100\" type=\"hidden\">\n最高可設占成\n";
echo "<s";
echo "pan id=\"sff_zc\">";
echo $power == @jiahe ? 100 : $is_directly == 1 ? $rdo[$percent_char] : 0;
echo "</span>% </td>\n                    </tr>\n                   \n";
if ( $power == @jiahe )
{
		echo "\t\t\t\t    \n                    <tr>\n                      <td bordercolor=\"#CCCCCC\" class=\"t_Edit_caption\" align=\"right\" height=\"30\">剩余成数归属</td>\n                      <td bordercolor=\"#CCCCCC\" align=\"left\" bgcolor=\"#FFFFFF\"><input name=\"is_remainder_percent\" value=\"0\" checked=\"checked\" type=\"radio\">\n全归公司\n  <input name=\"is_remainder_percent\" value=\"1\" type=\"radio\">\n全归分公司 </td>\n               ";
		echo "     </tr>\n                    <tr>\n                      <td bordercolor=\"#CCCCCC\" class=\"t_Edit_caption\" align=\"right\" height=\"30\">下级走飞归属</td>\n                      <td bordercolor=\"#CCCCCC\" align=\"left\" bgcolor=\"#FFFFFF\"><input name=\"is_fly\" value=\"0\" checked=\"checked\" type=\"radio\">\n全归公司\n  <input name=\"is_fly\" value=\"1\" type=\"radio\">\n全归分公司\n<input name=\"is_fly\" value=\"2\" type=\"radio\">\n按?;
		骷冻墒峙?/td>\n                    </tr>\n           \n                    <tr>\n                      <td bordercolor=\"#CCCCCC\" class=\"t_Edit_caption\" align=\"right\" height=\"30\">开放赔率</td>\n                      <td bordercolor=\"#CCCCCC\" align=\"left\" bgcolor=\"#FFFFFF\">";
		echo "<s";
		echo "elect name=\"is_odds\" id=\"bl\">\n                        <option value=\"0\" selected=\"selected\">允许</option>\n                        <option value=\"1\">禁止</option>\n                      </select></td>\n                    </tr>  \n  ";
}
echo "   \n<!--                    <tr>\n                      <td bordercolor=\"#CCCCCC\" class=\"t_Edit_caption\" align=\"right\" height=\"30\">账单修改</td>\n                      <td bordercolor=\"#CCCCCC\" align=\"left\" bgcolor=\"#FFFFFF\">";
echo "<s";
echo "elect name=\"is_edit_bill\" id=\"bl\">\n                        <option value=\"0\">允许</option>\n                        <option value=\"1\" selected=\"selected\">禁止</option>\n                      </select></td>\n                    </tr>-->\n";
if ( $power != 6 )
{
		echo "                    \n                         <tr>\n                          <td bordercolor=\"#CCCCCC\" class=\"t_Edit_caption\" align=\"right\" height=\"30\" width=\"18%\">可開會員個數</td>\n                          <td bordercolor=\"#CCCCCC\" align=\"left\" bgcolor=\"#FFFFFF\" width=\"82%\">\n                              <input name=\"user_total\" class=\"input1\" id=\"user_total\" value=\"";
		echo $user_total;
		echo "\" type=\"text\">\n                          </td>\n                        </tr>\n";
}
echo "                     \n           <tr>\n                      <td bordercolor=\"#CCCCCC\" class=\"t_Edit_caption\" align=\"right\" height=\"30\" width=\"18%\">補貨功能</td>\n                      <td bordercolor=\"#CCCCCC\" align=\"left\" bgcolor=\"#FFFFFF\" width=\"82%\">";
echo "<s";
echo "pan class=\"t_Edit_td\">\n                        <input name=\"is_add\" value=\"0\" checked=\"checked\" type=\"radio\">\n                        啓用&nbsp;\n  <input name=\"is_add\" value=\"1\" type=\"radio\">\n                        禁用</span></td>\n                    </tr>\n                                        <tr>\n                      <td bordercolor=\"#CCCCCC\" class=\"t_Edit_caption\" align=\"right\" height=\"30\">开放盘";
echo "口</td>\n                      <td id=\"abcd_plate\" bordercolor=\"#CCCCCC\" align=\"left\" bgcolor=\"#FFFFFF\" height=\"30\">\n                              ";
if ( $this_else_plate )
{
		foreach ( $this_else_plate as $pla )
		{
				echo "\t\t\t\t";
				echo "<s";
				echo "pan class=\"forumRow\">\n                                <input name=\"else_plate[]\" value=\"";
				echo $pla;
				echo "\" checked=\"checked\" type=\"checkbox\">\n                                ";
				echo $pla;
				echo "盘</span>\n                              ";
		}
}
echo "                      </td>\n                    </tr>\n ";
if ( $power != 2 )
{
		echo "                                                          \n                 <tr>\n                      <td bordercolor=\"#CCCCCC\" class=\"t_Edit_caption\" align=\"right\" height=\"30\" width=\"18%\">赚取退水</td>\n                      <td bordercolor=\"#CCCCCC\" align=\"left\" bgcolor=\"#FFFFFF\" width=\"82%\">";
		echo "<s";
		echo "pan class=\"t_Edit_td\">\n                        <input type=\"text\"  class=\"input1\" value=\"0\" name=\"else_back\" />\n                      </td>\n                    </tr>                                          \n   ";
}
echo "                                                        \n                                                           \n                 \n                                                           \n                                                           \n                                       <tr>\n                      <td colspan=\"2\" bordercolor=\"#CCCCCC\" align=\"center\" bgcolor=\"#FFFFFF\" height=\"30";
echo "\"><input onclick=\"return chk_add_or_up_user()\" id=\"submit\" name=\"Submit\" value=\"確定\" class=\"btn2\" onMouseOver=\"this.className='btn2m'\" onMouseOut=\"this.className='btn2'\" type=\"submit\">　\n                      <a href=\"javascript:history.back(-1)\"><input name=\"cancel\" onclick=\"javascript:history.back(-1)\" value=\"取消\" class=\"btn2\" onMouseOver=\"this.className='btn2m'\" onMouseOut=\"this.className='btn2'";
echo "\" type=\"button\"></a></td>\n                    </tr>\n                  </tbody></table>\n              </div>\n              <!-- 結束  --></td>\n            <td background=\"../images/tab_15.gif\" width=\"8\">&nbsp;</td>\n          </tr>\n        </tbody>\n      </table>\n      </form></td>\n    </tr>\n    <tr>\n      <td background=\"../images/tab_19.gif\" height=\"35\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">";
echo "\n        <tbody>\n          <tr>\n            <td height=\"35\" width=\"12\"><img src=\"../images/tab_18.gif\" height=\"35\" width=\"12\"></td>\n            <td valign=\"top\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" height=\"30\" width=\"100%\">\n              <tbody>\n                <tr>\n                  <td align=\"center\">&nbsp;</td>\n                </tr>\n              </tbody>\n            </table></td>\n            <td ";
echo "width=\"16\"><img src=\"../images/tab_20.gif\" height=\"35\" width=\"16\"></td>\n          </tr>\n        </tbody>\n      </table></td>\n    </tr>\n  </tbody>\n</table>\n</div>\n</body></html>";
?>
