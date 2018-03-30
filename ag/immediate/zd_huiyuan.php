<?php
include_once( "../../global.php" );
$db = new rate( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
$db2 = new action( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
$db3 = new immediate( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
$qishu = $_GET['qishu'];
$all_plate = $db3->get_all_plate_num( );
$is_fly = $_GET[is_fly];
if ( empty( $is_fly ) )
{
		$is_fly = 0;
}
else
{
		$is_fly = 1;
}
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
$del_zdid = $_GET[del_zdid];
if ( $del_zdid )
{
		$db->delete( "orders", "id={$del_zdid}", "{$_SERVER['HTTP_REFERER']}" );
}
$edit_zdid = $_POST['edit_zdid'];
if ( $edit_zdid )
{
		$postorders_y = $_POST["orders_y".$edit_zdid];
		$postorders_p = $_POST["orders_p".$edit_zdid];
		$posth_tui = $_POST["h_tui".$edit_zdid];
		$posto_type1 = $_POST["o_type1".$edit_zdid];
		$posto_type2 = $_POST["o_type2".$edit_zdid];
		$posto_type3 = $_POST["o_type3".$edit_zdid];
		$db->update( orders, "orders_y='{$postorders_y}',orders_p='{$postorders_p}',h_tui='{$posth_tui}',o_type1='{$posto_type1}',o_type2='{$posto_type2}',o_type3='{$posto_type3}'", "id ={$edit_zdid}", "{$_SERVER['HTTP_REFERER']}" );
}
$tiaojian = "user_id={$u_id}";
$tiaojian = "{$tiaojian} and is_fly={$is_fly}";
$query = $db->select( "orders", "count(*) as c", "plate_num={$qishu} and {$tiaojian}" );
$total = $db->fetch_array( $query );
$total = $total['c'];
pageft( $total, 15 );
if ( $firstcount < 0 )
{
		$firstcount = 0;
}
$zh_cxs = mysql_query( "select * from orders where plate_num={$qishu} and {$tiaojian} order by time desc limit {$firstcount}, {$displaypg}" );
$zh_cxsss = mysql_query( "select * from orders where plate_num={$qishu} and {$tiaojian} order by time desc" );
echo "<html xmlns=\"http://www.w3.org/1999/xhtml\"><head>\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=gbk\">\n";
echo "<s";
echo "tyle type=\"text/css\">\n<!--\nbody {\n\tmargin-left: 0px;\n\tmargin-top: 0px;\n\tmargin-right: 0px;\n\tmargin-bottom: 0px;\n}\n-->\n</style>\n</head>\n<body onselect=\"document.selection.empty()\" oncopy=\"document.selection.empty()\" onmouseover=\"self.status='歡迎光臨';return true\">\n<link href=\"../images/Index.css\" rel=\"stylesheet\" type=\"text/css\">\n";
echo "<s";
echo "cript src=\"../js/jquery-1.4.3.min.js?i=0\" type=\"text/javascript\"></script>\n";
echo "<s";
echo "cript src=\"js/normal.js?i=3\" type=\"text/javascript\"></script>\n ";
echo "<s";
echo "tyle type=\"text/css\">\n<!--\n.STYLE1 {color: #CCCCCC}\n-->\n </style>\n <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n  <tbody>\n    <tr>\n      <td height=\"30\" background=\"../images/tab_05.gif\"><table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n        <tbody>\n          <tr>\n            <td width=\"12\" height=\"30\"><img src=\"../images/tab_03.gif\" width=\"12\" height=\"30\"></td>\n           ";
echo " <td><table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n              <tbody>\n                <tr>\n                  <td width=\"87%\" valign=\"middle\"><table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n                    <tbody>\n                      <tr>\n                        <td width=\"1%\"><div align=\"center\"><img src=\"../images/tb.gif\" width=\"16\" height=\"16\"></div></td>\n          ";
echo "              <td width=\"32%\" class=\"F_bold\">";
echo "<s";
echo "pan id=\"ftm1\">[";
echo $db2->get_user_name( $u_id );
echo "]會員</span>賬單</td>\n                        <td class=\"F_bold\" width=\"67%\">期数：\n                          ";
echo "<s";
echo "elect class=\"zaselect_ste\" name=\"kithe\" onchange=\"change_plate('zd.php','-2','-2',\$(this).val())\">\n                                  ";
foreach ( $all_plate as $p )
{
		echo "                                    <option ";
		echo $qishu == $p ? "selected=\"selected\"" : "";
		echo " value=\"";
		echo $p;
		echo "\">第[";
		echo $p;
		echo "]期</option>\n                                  ";
}
echo "                                </select></td>\n                      </tr>\n                    </tbody>\n                  </table></td>\n                  </tr>\n              </tbody>\n            </table></td>\n            <td width=\"16\"><img src=\"../images/tab_07.gif\" width=\"16\" height=\"30\"></td>\n          </tr>\n        </tbody>\n      </table></td>\n    </tr>\n    <tr>\n      <td><table width=\"100%\" border=\"0\" cellspacing";
echo "=\"0\" cellpadding=\"0\">\n        <tbody>\n          <tr>\n            <td width=\"8\" background=\"../images/tab_12.gif\">&nbsp;</td>\n            <td height=\"50\" align=\"center\"><!-- 開始  -->\n              <div id=\"result\">\n\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=gbk\">\n";
echo "<s";
echo "tyle type=\"text/css\">\n<!--\nbody {\n\tmargin-left: 0px;\n\tmargin-top: 0px;\n\tmargin-right: 0px;\n\tmargin-bottom: 0px;\n}\n-->\n</style>\n\n\n\t\t\t\t\t\t\t\t<table width=\"99%\" border=\"0\" align=\"center\" cellpadding=\"1\" cellspacing=\"1\" bordercolor=\"f1f1f1\" bgcolor=\"ffffff\" class=\"Ball_List\">\n                  <tbody><tr class=\"td_caption_1\">\n                    <td width=\"50\" bordercolor=\"cccccc\" bgcolor=\"#DFEFFF\"><div align=";
echo "\"center\"> NO </div></td>\n                    <td bordercolor=\"cccccc\" bgcolor=\"#DFEFFF\"><div align=\"center\">會員</div></td>\n                    <td align=\"center\" bordercolor=\"cccccc\" bgcolor=\"#DFEFFF\">下單時間</td>\n                    <td align=\"center\" bordercolor=\"cccccc\" bgcolor=\"#DFEFFF\">期數</td>\n                    <td align=\"center\" bordercolor=\"cccccc\" bgcolor=\"#DFEFFF\">下註總額</td>\n                ";
echo "    <td align=\"center\" bordercolor=\"cccccc\" bgcolor=\"#DFEFFF\">";
echo "<s";
echo "pan class=\"m_title_reall\">賠率</span></td>\n                    <td align=\"center\" bordercolor=\"cccccc\" bgcolor=\"#DFEFFF\">";
echo "<s";
echo "pan class=\"m_title_reall\">退傭%</span></td>\n                    <td align=\"center\" bordercolor=\"cccccc\" bgcolor=\"#DFEFFF\">";
echo "<s";
echo "pan class=\"m_title_reall\">類型1</span></td>\n                    <td align=\"center\" bordercolor=\"cccccc\" bgcolor=\"#DFEFFF\">";
echo "<s";
echo "pan class=\"m_title_reall\">類型2</span></td>\n                    <td align=\"center\" bordercolor=\"cccccc\" bgcolor=\"#DFEFFF\">";
echo "<s";
echo "pan class=\"m_title_reall\">球號</span></td>\n                    ";
echo "<!--                    <td align=\"center\" bordercolor=\"cccccc\" bgcolor=\"#DFEFFF\">";
echo "<s";
echo "pan class=\"m_title_reall\">操作</span></td>-->\n                    ";
echo "                    </tr>\n";
$k = 0;
while ( $row = mysql_fetch_array( $zh_cxs ) )
{
		++$k;
		echo "                      \n                   ";
		echo "                    <tr bgcolor=\"#FFFFFF\" onmouseover=\"this.style.backgroundColor='#FFFFA2'\" onmouseout=\"this.style.backgroundColor='ffffff'\" style=\"background-color: rgb(255, 255, 255); \">\n                    <td height=\"25\" bordercolor=\"cccccc\"><div align=\"center\">\n                       ";
		echo $k;
		echo "</div></td>\n                    <td height=\"25\" align=\"center\">";
		echo $db2->get_user_name( $row['user_id'] );
		echo "</td>\n                    <td height=\"25\" align=\"center\">";
		echo date( "Y-m-d H:i:s", $row['time'] );
		echo "</td>\n                    <td align=\"center\">";
		echo $row['plate_num'];
		echo "</td>\n                    <td height=\"25\" align=\"center\">";
		echo $row['orders_y'];
		echo "</td>\n                    <td align=\"center\">";
		echo $row['orders_p'];
		echo "/";
		echo $row['orders_p'];
		echo "</td>\n                    <td height=\"25\" align=\"center\">";
		echo $row['h_tui'];
		echo "%</td>\n                    <td align=\"center\">";
		echo $row['o_type1'];
		echo "</td>\n                    <td height=\"25\" align=\"center\">";
		echo $row['o_type2'];
		echo "</td>\n                    <td align=\"center\">";
		echo $row['o_type3'];
		echo "</td>\n                    </tr>\n                   ";
		echo "   \n<!--                   <form name=\"lt_form";
		echo $row['id'];
		echo "\" id=\"lt_form";
		echo $row['id'];
		echo "\" method=\"post\" action=\"\" onSubmit=\"return checkform1();\" >   \n\t           <input name=\"edit_zdid\" type=\"hidden\" value=\"";
		echo $row['id'];
		echo "\" />\n                    <tr bgcolor=\"#FFFFFF\" onmouseover=\"this.style.backgroundColor='#FFFFA2'\" onmouseout=\"this.style.backgroundColor='ffffff'\" style=\"background-color: rgb(255, 255, 255); \">\n                    <td height=\"25\" bordercolor=\"cccccc\"><div align=\"center\">\n                       ";
		echo $k;
		echo "</div></td>\n                    <td height=\"25\" align=\"center\">";
		echo $db2->get_user_name( $row['user_id'] );
		echo "</td>\n                    <td height=\"25\" align=\"center\">";
		echo date( "Y-m-d H:i:s", $row['time'] );
		echo "</td>\n                    <td align=\"center\">";
		echo $row['plate_num'];
		echo "</td>\n                    <td height=\"25\" align=\"center\"><input name=\"orders_y";
		echo $row['id'];
		echo "\" type=\"text\" value=\"";
		echo $row['orders_y'];
		echo "\" style=\"width: 60px;\"/></td>\n                    <td align=\"center\"><input name=\"orders_p";
		echo $row['id'];
		echo "\" type=\"text\" value=\"";
		echo $row['orders_p'];
		echo "\" style=\"width: 60px;\"/></td>\n                    <td height=\"25\" align=\"center\"><input name=\"h_tui";
		echo $row['id'];
		echo "\" type=\"text\" value=\"";
		echo $row['h_tui'];
		echo "\" style=\"width: 60px;\"/>%</td>\n                    <td align=\"center\"><input name=\"o_type1";
		echo $row['id'];
		echo "\" type=\"text\" value=\"";
		echo $row['o_type1'];
		echo "\" style=\"width: 60px;\"/></td>\n                    <td height=\"25\" align=\"center\"><input name=\"o_type2";
		echo $row['id'];
		echo "\" type=\"text\" value=\"";
		echo $row['o_type2'];
		echo "\" style=\"width: 60px;\"/></td>\n                    <td align=\"center\"><input name=\"o_type3";
		echo $row['id'];
		echo "\" type=\"text\" value=\"";
		echo $row['o_type3'];
		echo "\" style=\"width: 60px;\"/></td>\n                    <td align=\"center\">\n                        <img src=\"../images/55.gif\" style=\" vertical-align:middle\"/><a onclick=\"document.lt_form";
		echo $row['id'];
		echo ".reset();\" style=\"text-decoration:none;cursor:pointer\">取消</a>\n                        <img src=\"../images/edit.gif\" style=\" vertical-align:middle\"/><a onclick=\"document.lt_form";
		echo $row['id'];
		echo ".submit();\" style=\"text-decoration:none;cursor:pointer\">修改</a>\n                        <img src=\"../images/icon_21x21_del.gif\" style=\" vertical-align:middle\"/><a onclick='{if(confirm(\"您確定刪除嗎?此操作將不能恢復!\")){ return true;}else{return   false;}}' href=\"zd_huiyuan.php?del_zdid=";
		echo $row['id'];
		echo "&plate_num=";
		echo $row['plate_num'];
		echo "\" style=\"text-decoration:none\">删除</a>\n                    </td>\n                    </tr>\n                   </form>-->\n                   ";
		echo " \n ";
		$total_y += $row['orders_y'];
}
echo "                     \n                  \n                      ";
if ( 15 < $total )
{
		echo "<tr bgcolor=\"#FFFFFF\" onmouseover=\"this.style.backgroundColor='#FFFFA2'\" onmouseout=\"this.style.backgroundColor='ffffff'\" style=\"background-color: rgb(255, 255, 162); \">\n                    <td height=\"25\" bordercolor=\"cccccc\">&nbsp;</td>\n                    <td height=\"25\" align=\"center\">当页</td>\n                    <td height=\"25\" align=\"center\">";
		echo $k;
		echo "</td>\n                    <td align=\"center\">&nbsp;</td>\n                    <td height=\"25\" align=\"center\">";
		echo $total_y;
		echo "</td>\n                    <td align=\"center\">&nbsp;</td>\n                    <td height=\"25\" align=\"center\">&nbsp;</td>\n                    <td align=\"center\">&nbsp;</td>\n                    <td height=\"25\" align=\"center\">&nbsp;</td>\n                    <td align=\"center\">&nbsp;</td>\n                    ";
		echo "<!--                    <td align=\"center\">&nbsp;</td>-->\n                    ";
		php;
		echo "                    </tr>\n                      ";
}
echo " \n\n";
while ( $row2 = mysql_fetch_array( $zh_cxsss ) )
{
		echo " \n ";
		$total_y2 += $row2['orders_y'];
}
echo "                        \n                      <tr bgcolor=\"#FFFFFF\" onmouseover=\"this.style.backgroundColor='#FFFFA2'\" onmouseout=\"this.style.backgroundColor='ffffff'\" style=\"background-color: rgb(255, 255, 162); \">\n                    <td height=\"25\" bordercolor=\"cccccc\">&nbsp;</td>\n                    <td height=\"25\" align=\"center\">總計</td>\n                    <td height=\"25\" align=\"center\">";
echo $total;
echo "</td>\n                    <td align=\"center\">&nbsp;</td>\n                    <td height=\"25\" align=\"center\">";
echo $total_y2;
echo "</td>\n                    <td align=\"center\">&nbsp;</td>\n                    <td height=\"25\" align=\"center\">&nbsp;</td>\n                    <td align=\"center\">&nbsp;</td>\n                    <td height=\"25\" align=\"center\">&nbsp;</td>\n                    <td align=\"center\">&nbsp;</td>\n                    ";
echo "<!--                    <td align=\"center\">&nbsp;</td>-->\n                    ";
echo "                    </tr>\n                      \n                </tbody></table>\n\t\t\t\t\n                </div>\n              <!-- 結束  --></td>\n            <td width=\"8\" background=\"../images/tab_15.gif\">&nbsp;</td>\n          </tr>\n        </tbody>\n      </table></td>\n    </tr>\n    <tr>\n      <td height=\"35\" background=\"../images/tab_19.gif\"><table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n        ";
echo "<tbody>\n          <tr>\n            <td width=\"12\" height=\"35\"><img src=\"../images/tab_18.gif\" width=\"12\" height=\"35\"></td>\n            <td valign=\"top\"><table width=\"100%\" height=\"30\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n              <tbody>\n                <tr>\n                  <td align=\"center\">";
echo $pagenav;
echo "</td>\n                </tr>\n              </tbody>\n            </table></td>\n            <td width=\"16\"><img src=\"../images/tab_20.gif\" width=\"16\" height=\"35\"></td>\n          </tr>\n        </tbody>\n      </table></td>\n    </tr>\n  </tbody>\n</table>\n\n</body></html>";
?>
