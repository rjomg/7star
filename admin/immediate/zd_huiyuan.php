<?php
include_once( "../../global.php" );
$db = new rate( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
$db2 = new action( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
$db3 = new immediate( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
$dangqianqishu_arr = $db->dangqianqishu_arr( );
$is_plate_starts = $db->is_plate_starts( );
$is_fly = $_GET[is_fly];
if ( empty( $is_fly ) )
{
		$is_fly = 0;
}
else
{
		$is_fly = 1;
}
$qishu = $_GET['qishu'];
$all_plate = $db3->get_all_plate_num( );
$is_account = $db->is_plate_account( $qishu );
if ( empty( $is_account ) )
{
		$ok_zd = 1;
}
$is_edit_bill = $db->get_user_edit_bill( $_SESSION["uid".$c_p_seesion] );
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
		$del_orders = $db->select( "orders", "orders_y,user_id", "id ={$del_zdid}" );
		$deleo = $db->fetch_array( $del_orders );
		$trueorders_y = $deleo['orders_y'];
		$db->update( "users", "credit_remainder=credit_remainder+'{$trueorders_y}'", "user_id ={$deleo['user_id']}" );
		$db->update( "orders_totalmoney", "orders_tm=orders_tm-'{$trueorders_y}'", "user_id ={$deleo['user_id']} and plate_num={$deleo['plate_num']}" );
		$db->delete( "orders", "id={$del_zdid}", "{$_SERVER['HTTP_REFERER']}" );
}
$edit_zdid = $_POST['edit_zdid'];
if ( $edit_zdid )
{
		$e_url = $_SERVER['HTTP_REFERER'];
		$postorders_y = $_POST["orders_y".$edit_zdid];
		$postorders_p = $_POST["orders_p".$edit_zdid];
		$posth_tui = $_POST["h_tui".$edit_zdid];
		$posto_type1 = $_POST["o_type1".$edit_zdid];
		$posto_type2 = $_POST["o_type2".$edit_zdid];
		$posto_type3 = $_POST["o_type3".$edit_zdid];
		$edit_orders = $db->select( "orders", "*", "id ={$edit_zdid}" );
		$eo = $db->fetch_array( $edit_orders );
		$ed_power = $db->get_user_power( $eo['user_id'] );
		if ( $ed_power == 1 )
		{
				$edq_tui = "g_tui";
		}
		else if ( $ed_power == 2 )
		{
				$edq_tui = "f_tui";
		}
		else if ( $ed_power == 3 )
		{
				$edq_tui = "gd_tui";
				if ( $eo['f_tui'] < $posth_tui )
				{
						echo " <script> alert( '��Ӷ���ܴ����ϼ� {$eo['f_tui']} ') ;window.location.href= '{$e_url}';</script> ";
						exit( );
				}
		}
		else if ( $ed_power == 4 )
		{
				$edq_tui = "zd_tui";
				if ( $eo['gd_tui'] < $posth_tui )
				{
						echo " <script> alert( '��Ӷ���ܴ����ϼ� {$eo['gd_tui']} ') ;window.location.href= '{$e_url}';</script> ";
						exit( );
				}
		}
		else if ( $ed_power == 5 )
		{
				$edq_tui = "d_tui";
				if ( $eo['zd_tui'] < $posth_tui )
				{
						echo " <script> alert( '��Ӷ���ܴ����ϼ� {$eo['zd_tui']} ') ;window.location.href= '{$e_url}';</script> ";
						exit( );
				}
		}
		else if ( $ed_power == 6 )
		{
				$edq_tui = "h_tui";
				if ( $eo['d_tui'] < $posth_tui )
				{
						echo " <script> alert( '��Ӷ���ܴ����ϼ� {$eo['d_tui']} ') ;window.location.href= '{$e_url}';</script> ";
						exit( );
				}
		}
		$t1_all_arr = explode( ",", "����,��1��,��2��,��3��,��4��,��5��,��6��,����,����˫��,��1��˫��,��2��˫��,��3��˫��,��4��˫��,��5��˫��,��6��˫��,����˫��,����,����,��Ф,����Ф,β��,һФ,��Ф��,β����,�벨,����" );
		$t2_all_arr = explode( ",", "����A,����B,��1��A,��1��B,��2��A,��2��B,��3��A,��3��B,��4��A,��4��B,��5��A,��5��B,��6��A,��6��B,����A,����B,��ȫ��,������,�ش�,��ȫ��,���ж�,�岻��,������,�߲���,�˲���,�Ų���,ʮ����,��Ф��[��],��Ф��[����],��Ф��[��],��Ф��[����],��Ф��[��],��Ф��[����],��β��[��],��β��[����],��β��[��],��β��[����],��β��[��],��β��[����],��Ф,��Ф,��Ф,��Ф,��Ф,��Ф,һФ,β��,�벨,����" );
		if ( !in_array( $posto_type1, $t1_all_arr ) )
		{
				echo " <script> alert( '����һ �����������Ӣ����ĸ��Сд�����ļ���!!! ') ;window.location.href= '{$e_url}';</script> ";
				exit( );
		}
		else
		{
				if ( !in_array( $posto_type2, $t2_all_arr ) )
				{
						echo " <script> alert( '���Ͷ� �����������Ӣ����ĸ��Сд�����ļ���!!! ') ;window.location.href= '{$e_url}';</script> ";
						exit( );
				}
		}
		if ( $posto_type2 == "������" || $posto_type2 == "���ж�" )
		{
				$p_o_p_arr = explode( "|", $postorders_p );
				if ( count( $p_o_p_arr ) <= 1 )
				{
						echo " <script> alert( '���������������������!!! ') ;window.location.href= '{$e_url}';</script> ";
						exit( );
				}
				$postorders_p = $p_o_p_arr[1];
				if ( $ed_power == 1 )
				{
						$postorders_p_2 = $p_o_p_arr[0]."|".$p_o_p_arr[0]."/".$p_o_p_arr[1]."|".$p_o_p_arr[1];
				}
				else
				{
						$e_max_order_p = $db->get_max_order_p_2( $eo['orders_p_2'] );
						$postorders_p_2 = $p_o_p_arr[0]."|".$e_max_order_p[0][1]."/".$p_o_p_arr[1]."|".$e_max_order_p[1][1];
				}
				if ( ( $e_max_order_p[1][1] < $p_o_p_arr[1] || $e_max_order_p[0][1] < $p_o_p_arr[0] ) && $ed_power != 1 )
				{
						$e_max_order_p01 = $e_max_order_p[0][1]."|".$e_max_order_p[1][1];
						echo " <script> alert( '���ʲ��ܴ����ϼ� {$e_max_order_p01} ') ;window.location.href= '{$e_url}';</script> ";
						exit( );
				}
		}
		else
		{
				$e_max_order_p = explode( "|", $eo['orders_p_2'] );
				if ( $ed_power == 1 )
				{
						$postorders_p_2 = $postorders_p."|".$postorders_p;
				}
				else
				{
						$postorders_p_2 = $postorders_p."|".$e_max_order_p[1];
				}
				if ( $e_max_order_p[1] < $postorders_p && $ed_power != 1 )
				{
						echo " <script> alert( '���ʲ��ܴ����ϼ� {$e_max_order_p['1']} ') ;window.location.href= '{$e_url}';</script> ";
						exit( );
				}
				$p_o_p_arr = explode( "|", $postorders_p );
				if ( 1 < count( $p_o_p_arr ) )
				{
						echo " <script> alert( '���������������������!!! ') ;window.location.href= '{$e_url}';</script> ";
						exit( );
				}
		}
		$trueorders_y = $eo['orders_y'] - $_POST["orders_y".$edit_zdid];
		$db->update( "users", "credit_remainder=credit_remainder+'{$trueorders_y}'", "user_id ={$eo['user_id']}" );
		$db->update( "orders_totalmoney", "orders_tm=orders_tm-'{$trueorders_y}'", "user_id ={$eo['user_id']} and plate_num={$eo['plate_num']}" );
		$tuishui_y = $postorders_y * $posth_tui / 100;
		$keying_y = $postorders_y * $postorders_p - $postorders_y + $tuishui_y;
		$db->update( "orders", "orders_y='{$postorders_y}',orders_p='{$postorders_p}',orders_p_2='{$postorders_p_2}',{$edq_tui}='{$posth_tui}',o_type1='{$posto_type1}',o_type2='{$posto_type2}',o_type3='{$posto_type3}',tuishui_y='{$tuishui_y}',keying_y='{$keying_y}'", "id ={$edit_zdid}", "{$e_url}" );
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
echo "tyle type=\"text/css\">\n<!--\nbody {\n\tmargin-left: 0px;\n\tmargin-top: 0px;\n\tmargin-right: 0px;\n\tmargin-bottom: 0px;\n}\n-->\n</style>\n</head>\n<body onselect=\"document.selection.empty()\" oncopy=\"document.selection.empty()\" onmouseover=\"self.status='�gӭ���R';return true\">\n<link href=\"../images/Index.css\" rel=\"stylesheet\" type=\"text/css\">\n";
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
echo "]���T</span>�~��</td>\n                        <td class=\"F_bold\" width=\"67%\">������\n                          ";
echo "<s";
echo "elect class=\"zaselect_ste\" name=\"kithe\" onchange=\"change_plate('zd.php','-2','-2',\$(this).val())\">\n                                  ";
foreach ( $all_plate as $p )
{
		echo "                                    <option ";
		echo $qishu == $p ? "selected=\"selected\"" : "";
		echo " value=\"";
		echo $p;
		echo "\">��[";
		echo $p;
		echo "]��</option>\n                                  ";
}
echo "                                </select></td>\n                      </tr>\n                    </tbody>\n                  </table></td>\n                  </tr>\n              </tbody>\n            </table></td>\n            <td width=\"16\"><img src=\"../images/tab_07.gif\" width=\"16\" height=\"30\"></td>\n          </tr>\n        </tbody>\n      </table></td>\n    </tr>\n    <tr>\n      <td><table width=\"100%\" border=\"0\" cellspacing";
echo "=\"0\" cellpadding=\"0\">\n        <tbody>\n          <tr>\n            <td width=\"8\" background=\"../images/tab_12.gif\">&nbsp;</td>\n            <td height=\"50\" align=\"center\"><!-- �_ʼ  -->\n              <div id=\"result\">\n\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=gbk\">\n";
echo "<s";
echo "tyle type=\"text/css\">\n<!--\nbody {\n\tmargin-left: 0px;\n\tmargin-top: 0px;\n\tmargin-right: 0px;\n\tmargin-bottom: 0px;\n}\n-->\n</style>\n<table width=\"99%\" border=\"0\" align=\"center\" cellpadding=\"1\" cellspacing=\"1\" bordercolor=\"f1f1f1\" bgcolor=\"ffffff\" class=\"Ball_List\">\n                  <tbody><tr class=\"td_caption_1\">\n                    <td width=\"50\" bordercolor=\"cccccc\" bgcolor=\"#DFEFFF\"><div align=\"center\"> ";
echo "NO </div></td>\n                    <td bordercolor=\"cccccc\" bgcolor=\"#DFEFFF\"><div align=\"center\">���T</div></td>\n                    <td align=\"center\" bordercolor=\"cccccc\" bgcolor=\"#DFEFFF\">�Εr�g</td>\n                    <td align=\"center\" bordercolor=\"cccccc\" bgcolor=\"#DFEFFF\">�ڔ�</td>\n                    <td align=\"center\" bordercolor=\"cccccc\" bgcolor=\"#DFEFFF\">���]���~</td>\n                    <td ali";
echo "gn=\"center\" bordercolor=\"cccccc\" bgcolor=\"#DFEFFF\">";
echo "<s";
echo "pan class=\"m_title_reall\">�r��</span></td>\n                    <td align=\"center\" bordercolor=\"cccccc\" bgcolor=\"#DFEFFF\">";
echo "<s";
echo "pan class=\"m_title_reall\">�˂�%</span></td>\n                    <td align=\"center\" bordercolor=\"cccccc\" bgcolor=\"#DFEFFF\">";
echo "<s";
echo "pan class=\"m_title_reall\">���1</span></td>\n                    <td align=\"center\" bordercolor=\"cccccc\" bgcolor=\"#DFEFFF\">";
echo "<s";
echo "pan class=\"m_title_reall\">���2</span></td>\n                    <td align=\"center\" bordercolor=\"cccccc\" bgcolor=\"#DFEFFF\">";
echo "<s";
echo "pan class=\"m_title_reall\">��̖</span></td>\n                    ";
if ( empty( $is_edit_bill ) && $ok_zd )
{
		echo "                    <td align=\"center\" bordercolor=\"cccccc\" bgcolor=\"#DFEFFF\">";
		echo "<s";
		echo "pan class=\"m_title_reall\">����</span></td>\n                    ";
}
echo "                    </tr>\n";
$k = 0;
while ( $row = mysql_fetch_array( $zh_cxs ) )
{
		++$k;
		$d_power = $db2->get_user_power( $row['user_id'] );
		if ( $d_power == 1 )
		{
				$dq_tui = "g_tui";
		}
		else if ( $d_power == 2 )
		{
				$dq_tui = "f_tui";
		}
		else if ( $d_power == 3 )
		{
				$dq_tui = "gd_tui";
		}
		else if ( $d_power == 4 )
		{
				$dq_tui = "zd_tui";
		}
		else if ( $d_power == 5 )
		{
				$dq_tui = "d_tui";
		}
		else if ( $d_power == 6 )
		{
				$dq_tui = "h_tui";
		}
		echo "             \n                   ";
		if ( $is_edit_bill == 1 && empty( $is_account ) || empty( $ok_zd ) )
		{
				echo "                      <tr bgcolor=\"#FFFFFF\" onmouseover=\"this.style.backgroundColor='#FFFFA2'\" onmouseout=\"this.style.backgroundColor='ffffff'\" style=\"background-color: rgb(255, 255, 255); \">\n                    <td height=\"25\" bordercolor=\"cccccc\"><div align=\"center\">\n                       ";
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
				echo $row['orders_p_2'];
				echo "</td>\n                    <td height=\"25\" align=\"center\">";
				echo $row[$dq_tui];
				echo "%</td>\n                    <td align=\"center\">";
				echo $row['o_type1'];
				echo "</td>\n                    <td height=\"25\" align=\"center\">";
				echo $row['o_type2'];
				echo "</td>\n                    <td align=\"center\">";
				echo $row['o_type3'];
				echo "</td>\n                    </tr>\n                   ";
		}
		else
		{
				echo "   \n                   <form name=\"lt_form";
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
				if ( $row['o_type2'] == "������" || $row['o_type2'] == "���ж�" )
				{
						$max_order_p = $db2->get_max_order_p_2( $row['orders_p_2'] );
						echo $max_order_p[0][0]."|".$max_order_p[1][0];
				}
				else
				{
						echo $row['orders_p'];
				}
				echo "\" style=\"width: 60px;\"/></td>\n                    <td height=\"25\" align=\"center\"><input name=\"h_tui";
				echo $row['id'];
				echo "\" type=\"text\" value=\"";
				echo $row[$dq_tui];
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
				echo ".reset();\" style=\"text-decoration:none;cursor:pointer\">ȡ��</a>\n                        <img src=\"../images/edit.gif\" style=\" vertical-align:middle\"/><a onclick=\"document.lt_form";
				echo $row['id'];
				echo ".submit();\" style=\"text-decoration:none;cursor:pointer\">�޸�</a>\n                        <img src=\"../images/icon_21x21_del.gif\" style=\" vertical-align:middle\"/><a onclick='{if(confirm(\"���_���h����?�˲��������ܻ֏�!\")){ return true;}else{return   false;}}' href=\"zd_huiyuan.php?del_zdid=";
				echo $row['id'];
				echo "&plate_num=";
				echo $row['plate_num'];
				echo "\" style=\"text-decoration:none\">ɾ��</a>\n                    </td>\n                    </tr>\n                   </form>\n                   ";
		}
		echo "   \n ";
		$total_y += $row['orders_y'];
}
echo "                     \n      \n                      ";
if ( 15 < $total )
{
		echo "<tr bgcolor=\"#FFFFFF\" onmouseover=\"this.style.backgroundColor='#FFFFA2'\" onmouseout=\"this.style.backgroundColor='ffffff'\" style=\"background-color: rgb(255, 255, 162); \">\n                    <td height=\"25\" bordercolor=\"cccccc\">&nbsp;</td>\n                    <td height=\"25\" align=\"center\">��ҳ</td>\n                    <td height=\"25\" align=\"center\">";
		echo $k;
		echo "</td>\n                    <td align=\"center\">&nbsp;</td>\n                    <td height=\"25\" align=\"center\">";
		echo $total_y;
		echo "</td>\n                    <td align=\"center\">&nbsp;</td>\n                    <td height=\"25\" align=\"center\">&nbsp;</td>\n                    <td align=\"center\">&nbsp;</td>\n                    <td height=\"25\" align=\"center\">&nbsp;</td>\n                    <td align=\"center\">&nbsp;</td>\n                    ";
		if ( empty( $is_edit_bill ) && $ok_zd )
		{
				echo "                    <td align=\"center\">&nbsp;</td>\n                    ";
		}
		echo "                    </tr>\n                      ";
}
echo " \n";
while ( $row2 = mysql_fetch_array( $zh_cxsss ) )
{
		echo "    \n ";
		$total_y2 += $row2['orders_y'];
}
echo "                         \n<tr bgcolor=\"#FFFFFF\" onmouseover=\"this.style.backgroundColor='#FFFFA2'\" onmouseout=\"this.style.backgroundColor='ffffff'\" style=\"background-color: rgb(255, 255, 162); \">\n                    <td height=\"25\" bordercolor=\"cccccc\">&nbsp;</td>\n                    <td height=\"25\" align=\"center\">��Ӌ</td>\n                    <td height=\"25\" align=\"center\">";
echo $total;
echo "</td>\n                    <td align=\"center\">&nbsp;</td>\n                    <td height=\"25\" align=\"center\">";
echo $total_y2;
echo "</td>\n                    <td align=\"center\">&nbsp;</td>\n                    <td height=\"25\" align=\"center\">&nbsp;</td>\n                    <td align=\"center\">&nbsp;</td>\n                    <td height=\"25\" align=\"center\">&nbsp;</td>\n                    <td align=\"center\">&nbsp;</td>\n                    ";
if ( empty( $is_edit_bill ) && $ok_zd )
{
		echo "                    <td align=\"center\">&nbsp;</td>\n                    ";
}
echo "                    </tr>\n                      \n                </tbody></table>\n\t\t\t\t\n                </div>\n              <!-- �Y��  --></td>\n            <td width=\"8\" background=\"../images/tab_15.gif\">&nbsp;</td>\n          </tr>\n        </tbody>\n      </table></td>\n    </tr>\n    <tr>\n      <td height=\"35\" background=\"../images/tab_19.gif\"><table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n        ";
echo "<tbody>\n          <tr>\n            <td width=\"12\" height=\"35\"><img src=\"../images/tab_18.gif\" width=\"12\" height=\"35\"></td>\n            <td valign=\"top\"><table width=\"100%\" height=\"30\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n              <tbody>\n                <tr>\n                  <td align=\"center\">";
echo $pagenav;
echo "</td>\n                </tr>\n              </tbody>\n            </table></td>\n            <td width=\"16\"><img src=\"../images/tab_20.gif\" width=\"16\" height=\"35\"></td>\n          </tr>\n        </tbody>\n      </table></td>\n    </tr>\n  </tbody>\n</table>\n\n</body></html>";
?>
