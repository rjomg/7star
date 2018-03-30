<?php
include_once( "../../global.php" );
$power = $_GET['power'];
$user_id = $_GET['user_id'];
$db = new action( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
$user_char = $db->get_user_power_char( $power );
$user = $db->select( "users", "*", "user_id={$user_id}" );
$row = $db->fetch_array( $user );
$user_1128 = $db->select( "users", "*", "user_id={$row['top_id']}" );
$row_1128 = $db->fetch_array( $user_1128 );
$usermin = $db->select( "users", "*", "top_id={$user_id} order by is_directly asc" );
$rowmin = $db->fetch_array( $usermin );
if ( $power == 2 )
{
		$percent_min = $rowmin['percent_branch'] + $rowmin['percent_partner'] + 0;
		$percent_own = $row['percent_branch'];
		$percent_top = $row['percent_company'];
}
else if ( $power == 3 )
{
		$percent_min = $rowmin['percent_partner'] + $rowmin['percent_all_proxy'] + 0;
		$percent_hight = $row_1128['percent_branch'] + 0;
		$percent_own = $row['percent_partner'];
		$percent_top = $row['percent_branch'];
}
else if ( $power == 4 )
{
		$percent_min = $rowmin['percent_all_proxy'] + $rowmin['percent_proxy'] + 0;
		$percent_hight = $row_1128['percent_partner'] + 0;
		$percent_own = $row['percent_all_proxy'];
		$percent_top = $row['percent_partner'];
}
else if ( $power == 5 )
{
		$percent_min = $rowmin['percent_proxy'] + 0;
		$percent_hight = $row_1128['percent_all_proxy'] + 0;
		$percent_own = $row['percent_proxy'];
		$percent_top = $row['percent_all_proxy'];
}
else
{
		$percent_min = 0;
		$percent_hight = $row_1128['percent_proxy'] + 0;
		$percent_top = $row['percent_proxy'];
		$percent_own = 0;
}
$percent_max = $percent_own;
if ( $power != 2 )
{
		$fquery = $db->select( "users", "*", "user_id={$row['top_id']}" );
		$f = $db->fetch_array( $fquery );
		$this_else_plate = explode( ",", $f['else_plate'] );
		$this_top_power = $f['user_power'];
		if ( $power == 6 && $this_top_power != 5 )
		{
				$this_select_name = $db->get_key_power_char( $this_top_power );
				$percent_top = $f[$this_select_name];
				$percent_own = $row[$this_select_name];
				$percent_max = $row_1128[$this_select_name];
		}
}
else
{
		$f['credit_remainder'] = 1e+014;
		$this_else_plate = array( "A", "B", "C", "D" );
}
$is_plate_starts = $db->is_plate_starts( );
echo "<html oncontextmenu=\"return false\" xmlns=\"http://www.w3.org/1999/xhtml\">\n<head>\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">\n";
echo "<s";
echo "cript src=\"../js/jquery-1.4.3.min.js\" type=\"text/javascript\"></script>\n";
echo "<s";
echo "cript src=\"js/normal.js?i=3\" type=\"text/javascript\"></script>\n";
echo "<s";
echo "cript>\n    \$(function (){\n        ";
if ( $power == 6 && $this_top_power != 5 )
{
}
else
{
		echo "        get_top_percent_for_update(\"";
		echo $row['top_id'].",".$row['top_name'].",".$row['top_power'].",".$f['credit_remainder'];
		echo "\",";
		echo $percent_own;
		echo ",";
		echo $percent_top;
		echo ");\n        //get_own_limit_percent(";
		echo $percent_own;
		echo ");\n        ";
}
echo "    });\n    \n</script>\n</head>\n<body onselect=\"document.selection.empty()\" oncopy=\"document.selection.empty()\" onmouseover=\"self.status='歡迎光臨';return true\">\n<link href=\"../images/Index.css\" rel=\"stylesheet\" type=\"text/css\">\n<div id=\"ly\" style=\"position: absolute; top: 0px; background-color: rgb(255, 255, 255); z-index: 2; left: 0px; display: block; width: 1354px; height: 513px;\"> \n  <!--[if lte IE 6";
echo ".5]><iframe></iframe><![endif]--> \n</div>\n<!--          浮層框架開始         -->\n<div id=\"rs_window\" style=\"position: absolute; top: 26px; z-index: 2000; left: 418.5px; display: block;\">\n    <form action=\"update_user.php\" method=\"post\" name=\"testFrm\" id=\"testFrm\" onsubmit=\"return SubChkedit(";
echo $user_id;
echo ")\">\n  <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"600\">\n    <tbody>\n      <tr>\n        <td background=\"../images/tab_05.gif\" height=\"30\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n            <tbody>\n              <tr>\n                <td height=\"30\" width=\"12\"><img src=\"../images/tab_03.gif\" height=\"30\" width=\"12\"></td>\n                <td><table border=\"0\" cellpadding=\"0\" c";
echo "ellspacing=\"0\" width=\"100%\">\n                    <tbody>\n                      <tr>\n                        <td valign=\"middle\" width=\"87%\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n                            <tbody>\n                              <tr>\n                                <td width=\"3%\"><div align=\"center\"><img src=\"../images/tb.gif\" height=\"16\" width=\"16\"></div></td>\n      ";
echo "                          <td class=\"F_bold\" width=\"43%\">&nbsp;修改資訊－&gt;";
echo $user_char;
echo "（";
echo "<s";
echo "pan>";
echo $row['user_name'];
echo "</span>）</td>\n                                <td class=\"F_bold\" align=\"left\" width=\"47%\">";
echo $user_char;
echo "：";
echo $row['user_name'];
echo "</td>\n                                <td class=\"F_bold\" align=\"right\" width=\"7%\"><a href=\"javascript:history.back(-1)\"><img src=\"../images/icon_21x21_del.gif\" border=\"0\" height=\"16\" width=\"16\"></a></td>\n                              </tr>\n                            </tbody>\n                          </table></td>\n                      </tr>\n                    </tbody>\n                  </table></td>\n        ";
echo "        <td width=\"16\"><img src=\"../images/tab_07.gif\" height=\"30\" width=\"16\"></td>\n              </tr>\n            </tbody>\n          </table></td>\n      </tr>\n      <tr>\n        <td><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n            <tbody>\n              <tr>\n                <td background=\"../images/tab_12.gif\" width=\"8\">&nbsp;</td>\n                <td align=\"center\" height=\"50\"><!-- 開";
echo "始  -->\n                  \n                  <div id=\"result\">\n                    <table class=\"Ball_List\" border=\"0\" bordercolor=\"#ECE9D8\" cellpadding=\"1\" cellspacing=\"1\" width=\"99%\">\n                      <tbody>\n                        ";
if ( 2 < $power )
{
		echo "  \n                        <tr>\n                            <td bordercolor=\"#CCCCCC\" class=\"t_Edit_caption\" align=\"right\" height=\"30\" width=\"18%\">上级";
		echo $db->get_user_power_char( $row['top_power'] );
		echo "</td>\n                          <td bordercolor=\"#CCCCCC\" align=\"left\" bgcolor=\"#FFFFFF\" width=\"82%\">";
		echo $row['top_name'];
		echo "&nbsp;";
		echo $db->get_top_yue2( $row['top_id'] );
		echo "                          </td>\n                        </tr>  \n                        ";
}
echo "                        <tr>\n                          <td bordercolor=\"#CCCCCC\" class=\"t_Edit_caption\" align=\"right\" height=\"30\" width=\"18%\">";
echo $user_char;
echo "賬號</td>\n                          <td bordercolor=\"#CCCCCC\" align=\"left\" bgcolor=\"#FFFFFF\" width=\"82%\">";
echo $row['user_name'];
echo "&nbsp;";
echo "<s";
echo "pan id=\"Find_Return\"> </span>\n                            <input name=\"user_id\" value=\"";
echo $row['user_id'];
echo "\" id=\"type1\" value=\"1\" type=\"hidden\">\n                             <input name=\"id\" id=\"id\" value=\"XGE!888\" type=\"hidden\">\n                            <input name=\"type1\" id=\"type1\" value=\"";
echo $power;
echo "\" type=\"hidden\">\n                          </td>\n                        </tr>\n                        <tr>\n                          <td bordercolor=\"#CCCCCC\" class=\"t_Edit_caption\" align=\"right\" height=\"30\" width=\"18%\">登錄密码</td>\n                          <td bordercolor=\"#CCCCCC\" align=\"left\" bgcolor=\"#FFFFFF\" width=\"82%\">\n                              <input name=\"user_pwd\" class=\"input1\" id=\"kapa";
echo "ssword\" type=\"password\"><font color=\"red\">*留空即不修改</font></td>\n                        </tr>\n                        <tr>\n                          <td bordercolor=\"#CCCCCC\" class=\"t_Edit_caption\" align=\"right\" height=\"30\" width=\"18%\">";
echo $user_char;
echo "名稱</td>\n                          <td bordercolor=\"#CCCCCC\" align=\"left\" bgcolor=\"#FFFFFF\" width=\"82%\">\n                              <input name=\"user_nick\" class=\"input1\" id=\"xm\" value=\"";
echo $row['user_nick'];
echo "\" type=\"text\"></td>\n                        </tr>\n                        <tr>\n                          <td bordercolor=\"#CCCCCC\" class=\"t_Edit_caption\" align=\"right\" height=\"30\" width=\"18%\">總信用額</td>\n                          <td bordercolor=\"#CCCCCC\" align=\"left\" bgcolor=\"#FFFFFF\" width=\"82%\">\n                              <input name=\"credit_total\" class=\"input1\" id=\"cs\" value=\"";
echo $row['credit_total'];
echo "\" type=\"text\">\n                            ";
echo "<s";
echo "pan class=\"Font_R F_bold\" id=\"RMB_XY\"></span>\n                            <input name=\"cs1\" id=\"cs1\" value=\"0\" type=\"hidden\">\n                            <input id=\"kyx\" name=\"kyx\" class=\"input1\" readonly=\"readonly\" value=\"\" type=\"hidden\"></td>\n                        </tr>\n                          <tr>\n                      <td bordercolor=\"#CCCCCC\" class=\"t_Edit_caption\" align=\"right\" height=\"30\" widt";
echo "h=\"18%\">占成设置</td>\n                      <td bordercolor=\"#CCCCCC\" align=\"left\" bgcolor=\"#FFFFFF\" width=\"82%\">\n                          ";
echo "<s";
echo "pan class=\"STYLE2\" style=\"DISPLAY: \">\n                          ";
if ( $this_top_power != 5 && $power == 6 )
{
		echo $db->get_user_power_char( $this_top_power );
}
else
{
		echo $db->get_user_power_char( $power - 1 );
		$this_select_name = $db->get_key_power_char( $power - 1 );
}
echo "                          </span>\n                          ";
if ( $power == 2 )
{
		echo "                                  ";
		echo "<s";
		echo "elect  class=\"za_select_02\" name=\"";
		echo $db->get_key_power_char( $power - 1 );
		echo "\" id=\"sj\" ";
		if ( $is_plate_starts == 0 )
		{
				echo "disabled";
		}
		echo ">\n                           <option value=\"0\">不占成</option>\n                           ";
		$i = 1;
		for ( ;	$i < 101;	++$i	)
		{
				echo "                           <option calss=\"opt\" ";
				echo $percent_top == $i ? "selected=\"selected" : "";
				echo " value=\"";
				echo $i;
				echo "\">";
				echo $i."%";
				echo "</option>\n                           ";
		}
		echo "                         </select>\n                         ";
		echo "<s";
		echo "pan class=\"STYLE2\" style=\"DISPLAY: \">\t\t\t\t\t\t\t\t  \n                                 ";
		echo $user_char;
		echo "                                 ";
		echo "<s";
		echo "elect onchange=\"lian_dong2(\$(this).val())\" class=\"za_select_02\" name=\"";
		echo $db->get_key_power_char( $power );
		echo "\" id=\"sf\" ";
		if ( $is_plate_starts == 0 )
		{
				echo "disabled";
		}
		echo ">\n                                <option value=\"0\">不占成</option>\n                                ";
		$i = 1;
		for ( ;	$i < 101;	++$i	)
		{
				echo "                                <option ";
				echo $percent_own == $i ? "selected=\"selected" : "";
				echo " value=\"";
				echo $i;
				echo "\">";
				echo $i."%";
				echo "</option>\n                                ";
		}
		echo "                          </select>\n                         </span>\n                          ";
}
else
{
		echo "                                ";
		echo "<s";
		echo "elect  class=\"za_select_02\" name=\"";
		echo $this_select_name;
		echo "\" id=\"sj\" ";
		if ( $is_plate_starts == 0 )
		{
				echo "disabled";
		}
		echo ">\n                                   <option value=\"0\">不占成</option>\n                                   ";
		$i = 1;
		for ( ;	$i <= $percent_max;	++$i	)
		{
				echo "                                   <option ";
				echo $percent_top == $i ? "selected=\"selected" : "";
				echo " value=\"";
				echo $i;
				echo "\">";
				echo $i."%";
				echo "</option>\n                                   ";
		}
		echo "                                 </select>\n                                  ";
		if ( $power < 6 )
		{
				echo "                                ";
				echo "<s";
				echo "pan class=\"STYLE2\" style=\"DISPLAY: \">\t\t\t\t\t\t\t\t  \n                                ";
				echo $user_char;
				echo "                                ";
				echo "<s";
				echo "elect class=\"za_select_02\" onchange=\"lian_dong2(\$(this).val())\" name=\"";
				echo $db->get_key_power_char( $power );
				echo "\" id=\"sf\" ";
				if ( $is_plate_starts == 0 )
				{
						echo "disabled";
				}
				echo ">\n                                <option value=\"0\">不占成</option>\n                                ";
				$i = 1;
				for ( ;	$i <= $percent_hight;	++$i	)
				{
						echo "                                <option ";
						echo $percent_own == $i ? "selected=\"selected" : "";
						echo " value=\"";
						echo $i;
						echo "\">";
						echo $i."%";
						echo "</option>\n                                ";
				}
				echo "                                </select>\n                                </span>\n                                ";
		}
		echo "                          ";
}
echo "  \n                        最高可設占成\n                        ";
echo "<s";
echo "pan id=\"sff_zc\">";
echo $power == 6 ? $percent_max : "100";
echo "</span>% \n                        ";
if ( $is_plate_starts == 0 )
{
		echo "<br>\n                           <font color=\"red\">(*注:当前正在开盘，不允许修改占成。)</font>\n                        ";
}
echo "   \n                      </td>\n                    </tr>\n ";
if ( $power == 2 )
{
		echo "\t\t\t\t    \n                    <tr>\n                      <td bordercolor=\"#CCCCCC\" class=\"t_Edit_caption\" align=\"right\" height=\"30\">剩余成数归属</td>\n                      <td bordercolor=\"#CCCCCC\" align=\"left\" bgcolor=\"#FFFFFF\">\n<input name=\"is_remainder_percent\" value=\"0\" ";
		echo $row['is_remainder_percent'] == 0 ? "checked=\"checked\"" : "";
		echo " type=\"radio\">\n全归公司\n  <input name=\"is_remainder_percent\" value=\"1\" ";
		echo $row['is_remainder_percent'] == 1 ? "checked=\"checked\"" : "";
		echo " type=\"radio\">\n全归分公司 </td>\n                    </tr>\n                    <tr>\n                      <td bordercolor=\"#CCCCCC\" class=\"t_Edit_caption\" align=\"right\" height=\"30\">下级走飞归属</td>\n                      <td bordercolor=\"#CCCCCC\" align=\"left\" bgcolor=\"#FFFFFF\">\n<input name=\"is_fly\" value=\"0\" ";
		echo $row['is_fly'] == 0 ? "checked=\"checked\"" : "";
		echo " type=\"radio\">\n全归公司\n  <input name=\"is_fly\" value=\"1\" ";
		echo $row['is_fly'] == 1 ? "checked=\"checked\"" : "";
		echo " type=\"radio\">\n全归分公司\n<input name=\"is_fly\" value=\"2\" ";
		echo $row['is_fly'] == 2 ? "checked=\"checked\"" : "";
		echo " type=\"radio\">\n按各级成数分配</td>\n                    </tr>\n           \n                    <tr>\n                      <td bordercolor=\"#CCCCCC\" class=\"t_Edit_caption\" align=\"right\" height=\"30\">开放赔率</td>\n                      <td bordercolor=\"#CCCCCC\" align=\"left\" bgcolor=\"#FFFFFF\">\n                     ";
		echo "<s";
		echo "elect name=\"is_odds\" id=\"bl\">\n                        <option value=\"0\" ";
		echo $row['is_odds'] == 0 ? "selected=\"selected\"" : "";
		echo ">允许</option>\n                        <option value=\"1\" ";
		echo $row['is_odds'] == 1 ? "selected=\"selected\"" : "";
		echo ">禁止</option>\n                      </select></td>\n                    </tr>  \n  ";
}
echo "  ";
if ( $power != 6 )
{
		echo "                        <tr>\n                          <td bordercolor=\"#CCCCCC\" class=\"t_Edit_caption\" align=\"right\" height=\"30\" width=\"18%\">可開會員個數</td>\n                          <td bordercolor=\"#CCCCCC\" align=\"left\" bgcolor=\"#FFFFFF\" width=\"82%\">\n                              <input name=\"user_total\" class=\"input1\" id=\"user_total\" value=\"";
		echo $row['user_total'];
		echo "\" type=\"text\">\n                          </td>\n                        </tr>     \n<!--                    <tr>\n                      <td bordercolor=\"#CCCCCC\" class=\"t_Edit_caption\" align=\"right\" height=\"30\">账单修改</td>\n                      <td bordercolor=\"#CCCCCC\" align=\"left\" bgcolor=\"#FFFFFF\">\n                      ";
		echo "<s";
		echo "elect name=\"is_edit_bill\" id=\"bl\">\n                        <option value=\"0\" ";
		echo $row['is_edit_bill'] == 0 ? "selected=\"selected\"" : "";
		echo ">允许</option>\n                        <option value=\"1\" ";
		echo $row['is_edit_bill'] == 1 ? "selected=\"selected\"" : "";
		echo ">禁止</option>\n                      </select></td>\n                    </tr>  -->\n                        <tr>\n                          <td bordercolor=\"#CCCCCC\" class=\"t_Edit_caption\" align=\"right\" height=\"30\" width=\"18%\">補貨功能</td>\n                          <td bordercolor=\"#CCCCCC\" align=\"left\" bgcolor=\"#FFFFFF\" width=\"82%\">";
		echo "<s";
		echo "pan class=\"t_Edit_td\">\n                            <input name=\"is_add\" ";
		echo $row['is_add'] == 0 ? "checked=\"checked\"" : "";
		echo " value=\"0\" type=\"radio\">\n                            啓用&nbsp;\n                            <input name=\"is_add\" value=\"1\" ";
		echo $row['is_add'] == 1 ? "checked=\"checked\"" : "";
		echo "  type=\"radio\">\n                            禁用</span></td>\n                        </tr>\n  ";
}
echo "                        <tr>\n                          <td bordercolor=\"#CCCCCC\" class=\"t_Edit_caption\" align=\"right\" height=\"30\">開放盤口</td>\n                          <td bordercolor=\"#CCCCCC\" align=\"left\" bgcolor=\"#FFFFFF\" height=\"30\">\n                              ";
foreach ( $this_else_plate as $v )
{
		echo "                            <input name=\"else_plate[]\" value=\"";
		echo $v;
		echo "\" ";
		echo strstr( $row['else_plate'], $v ) ? "checked=\"checked\"" : "";
		echo " type=\"checkbox\">\n                            ";
		echo $v;
		echo "&nbsp;&nbsp;&nbsp;&nbsp;\n                            ";
}
echo "                          </td>\n                        </tr>\n                          \n                          ";
if ( $power != 2 )
{
		echo "  \n                          <!--\n                 <tr>\n                      <td bordercolor=\"#CCCCCC\" class=\"t_Edit_caption\" align=\"right\" height=\"30\" width=\"18%\">赚取退水</td>\n                      <td bordercolor=\"#CCCCCC\" align=\"left\" bgcolor=\"#FFFFFF\" width=\"82%\">";
		echo "<s";
		echo "pan class=\"t_Edit_td\">\n                        <input type=\"text\"  class=\"input1\" value=\"";
		echo "\" name=\"else_back\" />\n                      </td>\n                    </tr>  \n                          -->\n                        ";
}
echo " \n                          \n                        <tr>\n                          <td colspan=\"2\" bordercolor=\"#CCCCCC\" align=\"center\" bgcolor=\"#FFFFFF\" height=\"30\">\n                              <input onclick=\"return chk_add_or_up_user()\" name=\"Submit\" value=\"確定\" class=\"btn2\" onmouseover=\"this.className='btn2m'\" onmouseout=\"this.className='btn2'\" type=\"submit\">\n                            <a hre";
echo "f=\"javascript:history.back(-1)\"><input onclick=\"javascript:history.back(-1)\" name=\"cancel\" value=\"取消\" class=\"btn2\" onmouseover=\"this.className='btn2m'\" onmouseout=\"this.className='btn2'\" type=\"button\"></a></td>\n                        </tr>\n                      </tbody>\n                    </table>\n                  </div>\n                  \n                  <!-- 結束  --></td>\n                <td backg";
echo "round=\"../images/tab_15.gif\" width=\"8\">&nbsp;</td>\n              </tr>\n            </tbody>\n          </table></td>\n      </tr>\n      <tr>\n        <td background=\"../images/tab_19.gif\" height=\"35\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n            <tbody>\n              <tr>\n                <td height=\"35\" width=\"12\"><img src=\"../images/tab_18.gif\" height=\"35\" width=\"12\"></td>\n          ";
echo "      <td valign=\"top\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" height=\"30\" width=\"100%\">\n                    <tbody>\n                      <tr>\n                        <td align=\"center\">&nbsp;</td>\n                      </tr>\n                    </tbody>\n                  </table></td>\n                <td width=\"16\"><img src=\"../images/tab_20.gif\" height=\"35\" width=\"16\"></td>\n              </tr>\n    ";
echo "        </tbody>\n          </table></td>\n      </tr>\n    </tbody>\n  </table>\n    </form>\n</div>\n</body>\n</html>";
?>
