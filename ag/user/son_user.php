<?php
include_once( "../../global.php" );
$power = $_GET['power'];
$page = $_GET['page'];
if ( !$page )
{
		$page = 1;
}
$start = ( $page - 1 ) * 10;
$get_user_limit = $_GET['get_user_limit'];
$t1 = $_GET['t1'];
$t2 = $_GET['t2'];
$user_id = $_GET['user_id'];
$db = new action( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
$user_limit = $db->get_user_limit_char( $get_user_limit, $t1, $t2 );
if ( $user_limit )
{
		$user_limit .= " and is_extend={$user_id}";
		$all_page = $db->get_page( "users", $user_limit, 10 );
		$query = $db->select( "users", "*", $user_limit." limit ".$start.",10" );
}
else
{
		$all_page = $db->get_page( "users", "is_extend=".$user_id, 10 );
		$query = $db->select( "users", "*", "is_extend=".$user_id." limit ".$start.",10" );
}
echo "<html oncontextmenu=\"return false\" xmlns=\"http://www.w3.org/1999/xhtml\">\n<head>\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=gbk\">\n";
echo "<s";
echo "cript>\nif(self == top) {location = '/';} \nif(window.location.host!=top.location.host){top.location=window.location;}</script>\n";
echo "<s";
echo "cript src=\"../js/jquery-1.4.3.min.js\" type=\"text/javascript\"></script>\n";
echo "<s";
echo "cript src=\"js/normal.js\" type=\"text/javascript\"></script>\n";
echo "<s";
echo "cript language=\"JavaScript\">\nvar user_id=";
echo $user_id;
echo ";\nvar user_name=\"";
echo $_GET['user_name'];
echo "\";\nvar page=";
echo $page;
echo ";\nvar allpage=";
echo $all_page;
echo ";\nvar t0=\"";
echo $get_user_limit;
echo "\";\nfunction C_Key(){\n        var t1=\$(\"#vip_name\").val();\n        var t2=\$(\"#vip_selectl\").val();\n        window.location.href=\"son_user.php?t1=\"+t1+\"&t2=\"+t2+\"&user_id=\"+user_id+\"&user_name=\"+user_name+\"&page=1&get_user_limit=0\";\n}\n\nfunction get_user_limit(th){\n    //window.open(\"branch.php?get_user_limit=\"+th+\"&power=\"+power+\"&page=1\");\n    window.location.href=\"son_user.php?get_user_limit=\"+th+";
echo "\"&user_id=\"+user_id+\"&user_name=\"+user_name+\"&page=1\";\n}\n\nfunction fy_go(ty){\n    var t1=\$(\"#vip_name\").val();\n    var t2=\$(\"#vip_selectl\").val();\n    var chars=\"son_user.php?t1=\"+t1+\"&t2=\"+t2+\"&&user_id=\"+user_id+\"&user_name=\"+user_name+\"&get_user_limit=\"+t0;\n    if(ty==1){\n        if(page==1){\n            return false;\n        }\n        chars+=\"&page=1\";\n    }else if(ty==2){\n        if(page==1){";
echo "\n            return false;\n        }\n        page--;\n        chars+=\"&page=\"+page;\n    }else if(ty==3){\n        if(page==allpage){\n            return false;\n        }\n        page++;\n        chars+=\"&page=\"+page;\n    }else if(ty==4){\n        if(page==allpage){\n            return false;\n        }\n        chars+=\"&page=\"+allpage;\n    }\n    window.location.href=chars;\n}\n</script>\n</head>\n<body  onselect";
echo "=\"document.selection.empty()\" oncopy=\"document.selection.empty()\" onmouseover=\"self.status='�gӭ���R';return true\">\n<link href=\"../images/Index.css\" rel=\"stylesheet\" type=\"text/css\">\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n  <tbody>\n    <tr>\n      <td background=\"../images/tab_05.gif\" height=\"30\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n          <tbody>\n   ";
echo "         <tr>\n              <td height=\"30\" width=\"12\"><img src=\"../images/tab_03.gif\" height=\"30\" width=\"12\"></td>\n              <td>\n                  <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n                  <tbody>\n                    <tr>\n                      <td valign=\"middle\" width=\"87%\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n                        ";
echo "  <tbody>\n                            <tr>\n                              <td width=\"1%\"><div align=\"center\"><img src=\"../images/tb.gif\" height=\"16\" width=\"16\"></div></td>\n                              <td class=\"F_bold\" width=\"32%\">";
echo $_GET['user_name'];
echo "���~̖����</td>\n                              <td class=\"F_bold\" align=\"right\" nowrap=\"nowrap\" width=\"45\">�Y�x��</td>\n                              <td nowrap=\"nowrap\">";
echo "<s";
echo "elect name=\"VIP_Estate\" onChange=\"get_user_limit(\$(this).val());\">\n                                  <option value=\"0\" ";
echo $get_user_limit == 0 ? "selected='selected'" : "";
echo ">ȫ��</option>\n                                  <option value=\"1\" ";
echo $get_user_limit == 1 ? "selected='selected'" : "";
echo ">����</option>\n                                  <option value=\"3\" ";
echo $get_user_limit == 3 ? "selected='selected'" : "";
echo ">���Y</option>\n                                  <option value=\"2\" ";
echo $get_user_limit == 2 ? "selected='selected'" : "";
echo ">ͣ�� </option>\n                                </select>\n                                &nbsp;&nbsp;</td>\n                              <td class=\"F_bold\" align=\"right\" nowrap=\"nowrap\" width=\"45\">������</td>\n                              <td nowrap=\"nowrap\">\n                                  ";
echo "<s";
echo "elect id=\"vip_name\" name=\"VIP_name\" onChange=\"return C_Key();\">\n                                  <option ";
echo $t1 == 0 ? "selected='selected'" : "";
echo " value=\"0\">��̖��</option>\n                                  <option ";
echo $t1 == 1 ? "selected='selected'" : "";
echo " value=\"1\">���Q��</option>\n                                </select></td>\n                              \n                              <td class=\"F_bold\" width=\"67%\"><input value=\"";
echo $t2;
echo "\" name=\"key\" id=\"vip_selectl\" class=\"input1\" onBlur=\"return C_Key();\" type=\"text\">\n                                <input name=\"xctype\" id=\"xctype\" value=\"Czc!888\" type=\"hidden\"></td>\n                              <td class=\"F_bold\" nowrap=\"nowrap\" width=\"67%\">\n                               <a href=\"add_son_user.php?user_id=";
echo $user_id."&user_name=".$_GET['user_name'];
echo "\" target=\"content\" style=\"border:#b5d6e6 solid 1; background-color:#e6f1f7; width:88px; height:21px; line-height:21px; font-size:12px; font-weight:500; text-align:center\">�������~̖</a>    \n                          <!--    <button onclick=\"show_win('XGZRYFdo','XGc!888','WjxWCgxmUHJfaQBpUmABdwFp','500','30');\" class=\"button_a\"></button>--></td>\n                            </tr>\n                         ";
echo " </tbody>\n                        </table></td>\n                    </tr>\n                  </tbody>\n                </table></td>\n              <td width=\"16\"><img src=\"../images/tab_07.gif\" height=\"30\" width=\"16\"></td>\n            </tr>\n          </tbody>\n        </table></td>\n    </tr>\n    <tr>\n      <td><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n          <tbody>\n            <tr>\n            ";
echo "  <td background=\"../images/tab_12.gif\" width=\"8\">&nbsp;</td>\n              <td align=\"center\" height=\"50\"><!-- �_ʼ  -->\n                <div id=\"result\">\n                  <table class=\"Ball_List Tab\" align=\"center\" bgcolor=\"ffffff\" border=\"0\" bordercolor=\"f1f1f1\" cellpadding=\"1\" cellspacing=\"1\" width=\"99%\">\n                    <tbody>\n                      <tr class=\"td_caption_1\">\n                    ";
echo "    <td bordercolor=\"cccccc\" bgcolor=\"#DFEFFF\" nowrap=\"nowrap\" width=\"50\"><div align=\"center\"> �ھ� </div></td>\n                        <td bordercolor=\"cccccc\" bgcolor=\"#DFEFFF\" nowrap=\"nowrap\"><div align=\"center\">�Ñ�</div></td>\n                        <td bordercolor=\"cccccc\" align=\"center\" bgcolor=\"#DFEFFF\" nowrap=\"nowrap\">���Q</td>\n                        <td bordercolor=\"cccccc\" align=\"center\" bgcolor=";
echo "\"#DFEFFF\" nowrap=\"nowrap\">�����û�</td>\n                        <td bordercolor=\"cccccc\" align=\"center\" bgcolor=\"#DFEFFF\" nowrap=\"nowrap\">�]�ԕr�g</td>\n                        <td bordercolor=\"cccccc\" align=\"center\" bgcolor=\"#DFEFFF\" nowrap=\"nowrap\">��䛴���</td>\n                        <td bordercolor=\"cccccc\" align=\"center\" bgcolor=\"#DFEFFF\" nowrap=\"nowrap\">��r</td>\n                        <td borderco";
echo "lor=\"cccccc\" bgcolor=\"#DFEFFF\" nowrap=\"NOWRAP\"><div align=\"center\">���� </div></td>\n                      </tr>\n                        ";
while ( $row = $db->fetch_array( $query ) )
{
		echo "                       <tr>\n                        <td bordercolor=\"cccccc\" bgcolor=\"#ffffff\" nowrap=\"nowrap\" width=\"50\"><div align=\"center\"> ";
		$info = mysql_fetch_array( mysql_query( "select auc.datetime from admin_users_action  auc left join users u on u.user_id = auc.uid  where auc.uid =  ".$row['user_id']." and u.is_online = 1 order by auc.datetime desc limit  1" ) );
		$min = mktime( ) - $info['datetime'];
		echo $min <= 1800 ? "<img src='../images/USER_1.gif'>" : "<img src='../images/USER_0.gif'>";
		echo "</div></td>\n                        <td bordercolor=\"cccccc\" bgcolor=\"#ffffff\" nowrap=\"nowrap\"><div align=\"center\">";
		echo $row['user_name'];
		echo "</div></td>\n                        <td bordercolor=\"cccccc\" align=\"center\" bgcolor=\"#ffffff\" nowrap=\"nowrap\">";
		echo $row['user_nick'];
		echo "</td>\n                        <td bordercolor=\"cccccc\" align=\"center\" bgcolor=\"#ffffff\" nowrap=\"nowrap\">";
		echo $_GET['user_name'];
		echo "</td>\n                        <td bordercolor=\"cccccc\" align=\"center\" bgcolor=\"#ffffff\" nowrap=\"nowrap\">";
		echo $row['else_created_at'];
		echo "</td>\n                        <td bordercolor=\"cccccc\" align=\"center\" bgcolor=\"#ffffff\" nowrap=\"nowrap\">";
		echo $row['else_count_login'];
		echo "</td>\n                        <td bgcolor=\"#ffffff\" align=\"center\" height=\"25\">\n                            <input type=\"hidden\" value=\"";
		echo $row['is_lock'];
		echo "\" />\n                            <button class=\"button_a\" onClick=\"set_is(\$(this),2,";
		echo $row['user_id'];
		echo ")\">";
		echo $row['is_lock'] == 0 ? "���_��" : "<font color='ff0000'>��ֹ</font>";
		echo "</button></td>\n                        <td align=\"center\" bordercolor=\"cccccc\" bgcolor=\"#ffffff\" nowrap=\"NOWRAP\">\n                            <table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\n                              <tbody>\n                                <tr valign=\"bottom\"><td align=\"center\" nowrap=\"nowrap\"><img src=\"../images/edit.gif\" height=\"15\" width=\"14\"><a href=\"add_son_user.php";
		echo "?user_name=";
		echo $_GET['user_name']."&id=".$row['user_id']."&user_id=".$user_id;
		echo "\"  target=\"content\">�޸�</a></td>\n                                  <td align=\"center\" nowrap=\"nowrap\"><img src=\"../images/55.gif\"><a href=\"user_log.php?user_id=";
		echo $row['user_id']."&user_name=".$row['user_name'];
		echo "\"  target=\"content\">���I</a></td>\n                                </tr>\n                              </tbody>\n                            </table>\n                            \n                        </td>\n                      </tr>\n                        ";
}
echo "<!--                      <tr>\n                        <td colspan=\"9\" bgcolor=\"#FFFFFF\" height=\"25\"><div id=\"fm\" align=\"center\">\n                            <div class=\"page\">\n                              <button class=\"button_a\">";
echo $page."/".$all_page;
echo "</button>\n                              &nbsp;&nbsp;&nbsp;\n                              <button onclick=\"fy_go(1)\" class=\"button_a\" ";
echo $page == 1 ? "disabled=\"disabled\"" : "";
echo ">��һ�</button>\n                              &nbsp;&nbsp;\n                              <button onclick=\"fy_go(2)\" class=\"button_a\" ";
echo $page == 1 ? "disabled=\"disabled\"" : "";
echo ">��һ�</button>\n                              &nbsp;&nbsp;\n                              <button class=\"button_a1\"><font color=\"#FF0000\">&nbsp;";
echo $page;
echo "&nbsp;</font></button>\n                              &nbsp;&nbsp;\n                              <button onclick=\"fy_go(3)\" class=\"button_a\" ";
echo $page == $all_page ? "disabled=\"disabled\"" : "";
echo ">��һ�</button>\n                              &nbsp;&nbsp;\n                              <button onclick=\"fy_go(4)\" class=\"button_a\" ";
echo $page == $all_page ? "disabled=\"disabled\"" : "";
echo ">����һ�</button>\n                            </div>\n                          </div></td>\n                      </tr>-->\n                    </tbody>\n                  </table>\n                </div>\n                <!-- �Y��  --></td>\n              <td background=\"../images/tab_15.gif\" width=\"8\">&nbsp;</td>\n            </tr>\n          </tbody>\n        </table></td>\n    </tr>\n    <tr>\n      <td background=\"../imag";
echo "es/tab_19.gif\" height=\"35\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n          <tbody>\n            <tr>\n              <td height=\"35\" width=\"12\"><img src=\"../images/tab_18.gif\" height=\"35\" width=\"12\"></td>\n              <td valign=\"top\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" height=\"30\" width=\"100%\">\n                  <tbody>\n                    <tr>\n                      <td";
echo " align=\"center\">&nbsp;</td>\n                    </tr>\n                  </tbody>\n                </table></td>\n              <td width=\"16\"><img src=\"../images/tab_20.gif\" height=\"35\" width=\"16\"></td>\n            </tr>\n          </tbody>\n        </table></td>\n    </tr>\n  </tbody>\n</table>\n</body>\n</html>";
?>
