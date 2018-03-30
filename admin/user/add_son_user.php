<?php
include_once( "../../global.php" );
$user_id = $_GET['id'];
$db = new action( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
if ( $user_id )
{
		$user = $db->select( "users", "*", "user_id={$user_id}" );
		$row = $db->fetch_array( $user );
}
$x = $db->select( "users", "user_power,top_power", "user_id={$_GET['user_id']}" );
$r = $db->fetch_array( $x );
echo "<html oncontextmenu=\"return false\" xmlns=\"http://www.w3.org/1999/xhtml\">\n<head>\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">\n";
echo "<s";
echo "cript src=\"../js/jquery-1.4.3.min.js\" type=\"text/javascript\"></script>\n";
echo "<s";
echo "cript src=\"js/normal.js\" type=\"text/javascript\"></script>\n</head>\n\n<body oncontextmenu=\"return false\" onselect=\"document.selection.empty()\" oncopy=\"document.selection.empty()\" onmouseover=\"self.status='歡迎光臨';return true\">\n<link href=\"../images/Index.css\" rel=\"stylesheet\" type=\"text/css\">\n<div id=\"ly\" style=\"position: absolute; top: 0px; background-color: rgb(255, 255, 255); z-index: 2; left: 0px; d";
echo "isplay: block; width: 1354px; height: 513px;\"> \n  <!--[if lte IE 6.5]><iframe></iframe><![endif]--> \n</div>\n<!--          浮層框架開始         -->\n<div id=\"rs_window\" style=\"position: absolute; top: 30px; z-index: 2000; left: 427px; display: block;\">\n  <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">\n\n<form action=\"add_user_extend.php?user_id=";
echo $user_id;
echo "\" method=\"post\" name=\"testFrm\" id=\"testFrm\" onsubmit=\"return SubChkSon()\">\n  <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"500\">\n    \n    <tbody>\n      <tr>\n        <td background=\"../images/tab_05.gif\" height=\"30\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n            <tbody>\n              <tr>\n                <td height=\"30\" width=\"12\"><img src=\"../images/tab_03.gif\" heigh";
echo "t=\"30\" width=\"12\"></td>\n                <td><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n                    <tbody>\n                      <tr>\n                        <td valign=\"middle\" width=\"87%\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n                            <tbody>\n                              <tr>\n                                <td width=\"1%\"><div align";
echo "=\"center\"><img src=\"../images/tb.gif\" height=\"16\" width=\"16\"></div></td>\n                                <td class=\"F_bold\" width=\"32%\">\n                                    ";
if ( $user_id )
{
		echo "修改子賬號用户";
}
else
{
		echo "新增子賬號用户";
}
echo "                                </td>\n                                <td class=\"F_bold\" align=\"right\" width=\"67%\"><a href=\"javascript:history.back(-1)\"><img src=\"../images/icon_21x21_del.gif\" border=\"0\" height=\"16\" width=\"16\"></a></td>\n                              </tr>\n                            </tbody>\n                          </table></td>\n                      </tr>\n                    </tbody>\n     ";
echo "             </table></td>\n                <td width=\"16\"><img src=\"../images/tab_07.gif\" height=\"30\" width=\"16\"></td>\n              </tr>\n            </tbody>\n          </table></td>\n      </tr>\n      <tr>\n        <td><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n            <tbody>\n              <tr>\n                <td background=\"../images/tab_12.gif\" width=\"8\">&nbsp;</td>\n                <td ";
echo "align=\"center\" height=\"50\"><!-- 開始  -->\n                  \n                  <div id=\"result\">\n                    <table class=\"Ball_List\" border=\"0\" bordercolor=\"#ECE9D8\" cellpadding=\"1\" cellspacing=\"1\" width=\"99%\">\n                      <tbody>\n                        <tr>\n                          <td bordercolor=\"#CCCCCC\" class=\"t_Edit_caption\" align=\"right\" height=\"30\" width=\"18%\">子賬號账号</td>";
echo "\n                          <td bordercolor=\"#CCCCCC\" align=\"left\" bgcolor=\"#FFFFFF\" width=\"82%\">\n                              ";
if ( $user_id )
{
		echo $row['user_name'];
}
else
{
		echo "                              <input name=\"user_name\" id=\"kauser\" class=\"inp1\" onblur=\"this.className='inp1';SendFindVN()\" onfocus=\"this.className='inp1a'\" type=\"text\">\n                            ";
}
echo "                                  &nbsp;";
echo "<s";
echo "pan id=\"Find_Return\"> </span>\n                            <input name=\"is_extend\" id=\"id\" value=\"";
echo $_GET['user_id'];
echo "\" type=\"hidden\">\n                            <input name=\"ex_name\" id=\"id\" value=\"";
echo $_GET['user_name'];
echo "\" type=\"hidden\">\n                             <input name=\"user_power\" id=\"id\" value=\"";
echo $r['user_power'];
echo "\" type=\"hidden\">\n                             <input name=\"top_power\" id=\"id\" value=\"";
echo $r['top_power'];
echo "\" type=\"hidden\">                               \n                                </td>\n                        </tr>\n                        <tr>\n                          <td bordercolor=\"#CCCCCC\" class=\"t_Edit_caption\" align=\"right\" height=\"30\" width=\"18%\">登录密码</td>\n                          <td bordercolor=\"#CCCCCC\" align=\"left\" bgcolor=\"#FFFFFF\" width=\"82%\">\n                              <input na";
echo "me=\"user_pwd\" class=\"input1\" id=\"";
if ( empty( $_GET['id'] ) )
{
		echo "kapassword";
}
echo "\" type=\"password\"><font color=\"red\">*留空即不修改</font></td>\n                        </tr>\n                        <tr>\n                          <td bordercolor=\"#CCCCCC\" class=\"t_Edit_caption\" align=\"right\" height=\"30\" width=\"18%\">子賬號名称</td>\n                          <td bordercolor=\"#CCCCCC\" align=\"left\" bgcolor=\"#FFFFFF\" width=\"82%\">\n                              ";
if ( $user_id )
{
		echo $row['user_nick'];
}
else
{
		echo "                              <input name=\"user_nick\" class=\"input1\" id=\"xm\" type=\"text\">\n                              ";
}
echo "                          </td>\n                        </tr>\n                    ";
if ( $r['user_power'] == 1 )
{
		echo "      \n                    <tr>\n                    <td height=\"30\"  bordercolor=\"#CCCCCC\"  class=\"t_Edit_caption\" align=\"right\">关闭项目: </td>\n                    <td bordercolor=\"cccccc\" bgcolor=\"#E7ECF9\"> ";
		$close_type = explode( ",", $row['close_type'] );
		echo "<!--                        盘口管理:<input style=\"position:relative;top:2px\" type=\"checkbox\" name=\"close_type[]\" value=\"盘口管理\" ";
		if ( in_array( "盘口管理", $close_type ) )
		{
				echo "checked";
		}
		echo ">&nbsp;&nbsp;&nbsp;-->\n                        赔率设置:<input style=\"position:relative;top:2px\" type=\"checkbox\" name=\"close_type[]\" value=\"赔率设置\" ";
		if ( in_array( "赔率设置", $close_type ) )
		{
				echo "checked";
		}
		echo ">&nbsp;&nbsp;&nbsp; \n                        即时注单:<input style=\"position:relative;top:2px\" type=\"checkbox\" name=\"close_type[]\" value=\"即时注单\" ";
		if ( in_array( "即时注单", $close_type ) )
		{
				echo "checked";
		}
		echo ">&nbsp;&nbsp;&nbsp; \n                        用户管理:<input style=\"position:relative;top:2px\" type=\"checkbox\" name=\"close_type[]\" value=\"用户管理\" ";
		if ( in_array( "用户管理", $close_type ) )
		{
				echo "checked";
		}
		echo ">&nbsp;&nbsp;&nbsp;<br><br> \n                        报表查询:<input style=\"position:relative;top:2px\" type=\"checkbox\" name=\"close_type[]\" value=\"报表查询\" ";
		if ( in_array( "报表查询", $close_type ) )
		{
				echo "checked";
		}
		echo ">&nbsp;&nbsp;&nbsp;  \n                        系统维护:<input style=\"position:relative;top:2px\" type=\"checkbox\" name=\"close_type[]\" value=\"系统维护\" ";
		if ( in_array( "系统维护", $close_type ) )
		{
				echo "checked";
		}
		echo ">&nbsp;&nbsp;&nbsp;  \n                        在线人数:<input style=\"position:relative;top:2px\" type=\"checkbox\" name=\"close_type[]\" value=\"在线人数\" ";
		if ( in_array( "在线人数", $close_type ) )
		{
				echo "checked";
		}
		echo ">&nbsp;&nbsp;&nbsp;  \n                    </td>\n                    </tr> \n                    ";
}
echo "      \n                        <tr height=\"50\">\n                          <td colspan=\"2\" bordercolor=\"#CCCCCC\" align=\"center\" bgcolor=\"#FFFFFF\" height=\"30\"><input name=\"Submit\" value=\"確定\" class=\"btn2\" onmouseover=\"this.className='btn2m'\" onmouseout=\"this.className='btn2'\" type=\"submit\">\n                            <a href=\"javascript:history.back(-1)\"><input name=\"cancel\" onclick=\"javascript:history";
echo ".back(-1)\" value=\"取消\" class=\"btn2\" onmouseover=\"this.className='btn2m'\" onmouseout=\"this.className='btn2'\" type=\"button\"></a></td>\n                        </tr>\n                      </tbody>\n                    </table>\n                  </div>\n                  \n                  <!-- 結束  --></td>\n                <td background=\"../images/tab_15.gif\" width=\"8\">&nbsp;</td>\n              </tr>\n          ";
echo "  </tbody>\n          </table></td>\n      </tr>\n      <tr>\n        <td background=\"../images/tab_19.gif\" height=\"35\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n            <tbody>\n              <tr>\n                <td height=\"35\" width=\"12\"><img src=\"../images/tab_18.gif\" height=\"35\" width=\"12\"></td>\n                <td valign=\"top\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" height=\"";
echo "30\" width=\"100%\">\n                    <tbody>\n                      <tr>\n                        <td align=\"center\">&nbsp;</td>\n                      </tr>\n                    </tbody>\n                  </table></td>\n                <td width=\"16\"><img src=\"../images/tab_20.gif\" height=\"35\" width=\"16\"></td>\n              </tr>\n            </tbody>\n          </table></td>\n      </tr>\n    </tbody>\n  </table>\n      </f";
echo "orm>\n</div>\n</body>\n</html>";
?>
