<?php
include_once( "../../global.php" );
$db = new plate( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
$db2 = new plate( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
$so = $_GET['so'];
if ( $so )
{
		$so = "and plate_num like '%{$so}%'";
}
$query = $db->select( "plate", "count(*) as c", "num_g!=0 {$so} order by plate_num desc" );
$total = $db->fetch_array( $query );
$total = $total['c'];
pageft( $total, 10 );
if ( $firstcount < 0 )
{
		$firstcount = 0;
}
$query = $db->select( "plate", "*", "num_g!=0 {$so} order by plate_num desc limit  {$firstcount}, {$displaypg}" );
echo "<html oncontextmenu=\"return false\" xmlns=\"http://www.w3.org/1999/xhtml\">\n<head>\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />\n<title>盘口管理</title>\n<link href=\"../images/commom.css\" rel=\"stylesheet\" type=\"text/css\" />\n</head>\n ";
echo "<s";
echo "tyle type=\"text/css\">\n<!--\nbody {\n\tmargin-left: 0px;\n\tmargin-top: 0px;\n\tmargin-right: 0px;\n\tmargin-bottom: 0px;\n\tcolor:#344b50;\n}\n.STYLE1 {\n\tfont-size: 12px\n}\n.STYLE3 {\n\tfont-size: 12px;\n\tfont-weight: bold;\n}\n.STYLE4 {\n\tcolor: #03515d;\n\tfont-size: 12px;\n}\n-->\n</style>   \n<body>\n<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n  <tr>\n    <td height=\"30\" background=\"../images/tab/tab_05.gif";
echo "\"><table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n        <tr>\n          <td width=\"12\" height=\"30\"><img src=\"../images/tab/tab_03.gif\" width=\"12\" height=\"30\" /></td>\n          <td><table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n              <tr>\n                <td width=\"46%\" valign=\"middle\"><table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n                  ";
echo "  <tr>\n                      <td width=\"5%\"><div align=\"center\"><img src=\"../images/tab/tb.gif\" width=\"16\" height=\"16\" /></div></td>\n                      <td width=\"95%\" class=\"STYLE1\" >";
echo "<s";
echo "pan class=\"STYLE3\">历史开奖管理</span> ";
echo "<s";
echo "pan class=\"font_size12 al\" style=\" margin-left:199px;\">期数查询:\n                        <input onblur=\"window.location.href='his.php?so='+\$(this).val()+'&page=";
echo $_GET['page'];
echo "'\" name=\"check\" id=\"check\" value=\"";
echo $_GET['so'];
echo "\" type=\"text\" />\n                        </span></td>\n                    </tr>\n                  </table></td>\n                <td width=\"54%\"><table border=\"0\" align=\"right\" cellpadding=\"0\" cellspacing=\"0\">\n                  </table></td>\n              </tr>\n            </table></td>\n          <td width=\"16\"><img src=\"../images/tab/tab_07.gif\" width=\"16\" height=\"30\" /></td>\n        </tr>\n      </table></td>\n  </tr";
echo ">\n  <tr>\n    <td><table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n        <tr>\n          <td width=\"8\" background=\"../images/tab/tab_12.gif\">&nbsp;</td>\n          <td><table width=\"99%\" align=\"center\" bordercolor='#b5d6e6' border='1' style=\"border-collapse: collapse\" class=\"al font_size12\">\n              <tr onMouseOver=\"this.style.background='#ffffa2'\" \n              onMouseOut=\"this.style.";
echo "background=''\">\n                <td width=\"5%\" height=\"24\" style=\"background:url(../images/bg2.gif) repeat-x 0 0 ;\" class=\"al font_size12\">NO</td>\n                <td width=\"5%\" style=\"background:url(../images/bg2.gif) repeat-x 0 0 ;\" class=\"al font_size12\">期数</td>\n                <td width=\"10%\" style=\"background:url(../images/bg2.gif) repeat-x 0 0 ;\" class=\"al font_size12\">开奖时间</td>\n            ";
echo "    <td width=\"5%\" colspan=\"2\" class=\"al font_size12\" style=\"background:url(../images/bg2.gif) repeat-x 0 0 ;\">正码1</td>\n                <td width=\"5%\" colspan=\"2\" class=\"al font_size12\" style=\"background:url(../images/bg2.gif) repeat-x 0 0 ;\">正码2</td>\n                <td width=\"5%\" colspan=\"2\" class=\"al font_size12\" style=\"background:url(../images/bg2.gif) repeat-x 0 0 ;\">正码3</td>\n                ";
echo "<td width=\"5%\" colspan=\"2\" class=\"al font_size12\" style=\"background:url(../images/bg2.gif) repeat-x 0 0 ;\">正码4</td>\n                <td width=\"5%\" colspan=\"2\" class=\"al font_size12\" style=\"background:url(../images/bg2.gif) repeat-x 0 0 ;\">正码5</td>\n                <td width=\"5%\" colspan=\"2\" class=\"al font_size12\" style=\"background:url(../images/bg2.gif) repeat-x 0 0 ;\">正码6</td>\n                <td w";
echo "idth=\"5%\" colspan=\"2\" class=\"al font_size12\" style=\"background:url(../images/bg2.gif) repeat-x 0 0 ;\">特码</td>\n                <td width=\"4%\"  class=\"al font_size12\" style=\"background:url(../images/bg2.gif) repeat-x 0 0 ;\">总和</td>\n                <td width=\"4%\"  class=\"al font_size12\" style=\"background:url(../images/bg2.gif) repeat-x 0 0 ;\">特码单双</td>\n                <td width=\"4%\"  class=\"al font";
echo "_size12\" style=\"background:url(../images/bg2.gif) repeat-x 0 0 ;\">特码大小</td>\n                <td width=\"4%\"  class=\"al font_size12\" style=\"background:url(../images/bg2.gif) repeat-x 0 0 ;\">合数单双</td>\n                <td width=\"4%\"  class=\"al font_size12\" style=\"background:url(../images/bg2.gif) repeat-x 0 0 ;\">总和单双</td>\n                <td width=\"4%\"  class=\"al font_size12\" style=\"background:u";
echo "rl(../images/bg2.gif) repeat-x 0 0 ;\">总和大小</td>\n                <td width=\"6%\" style=\"background:url(../images/bg2.gif) repeat-x 0 0 ;\" class=\"al font_size12\">是否结算</td>\n                <td width=\"6%\" style=\"background:url(../images/bg2.gif) repeat-x 0 0 ;\" class=\"al font_size12\">状态</td>\n                <td width=\"10%\" class=\"al font_size12\" style=\"background:url(../images/bg2.gif) repeat-x 0 0";
echo " ;\">操作</td>\n              </tr>\n";
$i = 0;
while ( $row = $db->fetch_array( $query ) )
{
		$num_a = $db2->get_num_detail( $row['animal_set_id'], $row['num_a'] );
		$num_b = $db2->get_num_detail( $row['animal_set_id'], $row['num_b'] );
		$num_c = $db2->get_num_detail( $row['animal_set_id'], $row['num_c'] );
		$num_d = $db2->get_num_detail( $row['animal_set_id'], $row['num_d'] );
		$num_e = $db2->get_num_detail( $row['animal_set_id'], $row['num_e'] );
		$num_f = $db2->get_num_detail( $row['animal_set_id'], $row['num_f'] );
		$num_g = $db2->get_num_detail( $row['animal_set_id'], $row['num_g'] );
		++$i;
		echo "              <tr onMouseOver=\"this.style.background='#ffffa2'\" onMouseOut=\"this.style.background=''\">\n                <td class=\"al\" height=\"24\">";
		echo $i;
		echo "</td>\n                <td>";
		echo $row['plate_num'];
		echo "</td>\n                <td>";
		echo date( "Y-m-d", strtotime( $row['plate_time_lottery'] ) );
		echo "</td>\n                <td width=\"2%\" ><p style=\"background-image:url(../images/";
		echo $num_a['color'].".gif";
		echo "); height:27px; width:28px; margin:0; padding:0; line-height:27px;\"><b>";
		echo $row['num_a'];
		echo "</b></p></td>\n <td width=\"2%\" ><p style=\"background-image:url(../images/";
		echo $num_b['color'].".gif";
		echo "); height:27px; width:28px; margin:0; padding:0; line-height:27px;\"><b>";
		echo $row['num_b'];
		echo "</b></p></td>\n  <td width=\"2%\" ><p style=\"background-image:url(../images/";
		echo $num_c['color'].".gif";
		echo "); height:27px; width:28px; margin:0; padding:0; line-height:27px;\"><b>";
		echo $row['num_c'];
		echo "</b></p></td>\n  <td width=\"2%\" ><p style=\"background-image:url(../images/";
		echo $num_d['color'].".gif";
		echo "); height:27px; width:28px; margin:0; padding:0; line-height:27px;\"><b>";
		echo $row['num_d'];
		echo "</b></p></td>\n   <td width=\"2%\" ><p style=\"background-image:url(../images/";
		echo $num_e['color'].".gif";
		echo "); height:27px; width:28px; margin:0; padding:0; line-height:27px;\"><b>";
		echo $row['num_e'];
		echo "</b></p></td>\n   <td width=\"2%\" ><p style=\"background-image:url(../images/";
		echo $num_f['color'].".gif";
		echo "); height:27px; width:28px; margin:0; padding:0; line-height:27px;\"><b>";
		echo $row['num_f'];
		echo "</b></p></td>\n    <td width=\"2%\" ><p style=\"background-image:url(../images/";
		echo $num_g['color'].".gif";
		echo "); height:27px; width:28px; margin:0; padding:0; line-height:27px;\"><b>";
		echo $row['num_g'];
		echo "</b></p></td>\n   <td align=\"center\">";
		echo $row['num_a'] + $row['num_b'] + $row['num_c'] + $row['num_d'] + $row['num_e'] + $row['num_f'] + $row['num_g'];
		echo " </td>\n                            <td align=\"center\">";
		echo $row['num_g'] % 2 != 0 ? "<font color=\"0000ff\">单</font>" : "<font color=\"000000\">双</font>";
		echo "</td>\n                            <td align=\"center\">";
		echo 25 < $row['num_g'] ? "<font color=\"0000ff\">大</font>" : "<font color=\"000000\">小</font>";
		echo "</td>\n                            <td align=\"center\">";
		$hd = array( 1, 3, 5, 7, 0, 10, 12, 14, 16, 18, 21, 23, 25, 27, 29, 30, 32, 34, 36, 38, 41, 43, 45, 47, 49 );
		echo in_array( $row['num_g'], $hd ) ? "<font color=\"0000ff\">单</font>" : "<font color=\"000000\">双</font>";
		echo "</td>\n                            <td align=\"center\">";
		$to = $row['num_a'] + $row['num_b'] + $row['num_c'] + $row['num_d'] + $row['num_e'] + $row['num_f'] + $row['num_g'];
		echo $to % 2 != 0 ? "<font color=\"0000ff\">单</font>" : "<font color=\"000000\">双</font>";
		echo "</td>\n                            <td align=\"center\"><font color=\"000000\">";
		$to = $row['num_a'] + $row['num_b'] + $row['num_c'] + $row['num_d'] + $row['num_e'] + $row['num_f'] + $row['num_g'];
		echo 174 < $to ? "<font color=\"0000ff\">大</font>" : "<font color=\"000000\">小</font>";
		echo "</font></td>\n                <td><input onclick=\"change_is(\$(this),";
		echo $row['id'];
		echo ",";
		echo $row['plate_num'];
		echo ");\" type=\"button\" class=\"bt\" id=\"pay\" value=\"";
		echo $row['history_is_account'] == 0 ? "未结算" : "已结算";
		echo "\"  ";
		if ( $row['history_is_account'] == 0 )
		{
				echo "style=\"color:red\"";
		}
		echo "/></td>\n                <td><input onclick=\"change_is(\$(this),";
		echo $row['id'];
		echo ",";
		echo $row['plate_num'];
		echo ")\" type=\"button\" class=\"bt\" id=\"star\" value=\"";
		echo $row['history_is_lock'] == 0 ? "已关闭" : "已开启";
		echo "\" ";
		if ( $row['history_is_lock'] == 0 )
		{
				echo "style=\"color:red\"";
		}
		echo "/></td>\n                <td style=\" height:25px; line-height:25px;\" class=\"cz\">\n<!--                <img src=\"../images/22.gif\" style=\" vertical-align:middle\"/><a href=\"\" style=\"text-decoration:none\"> 结算</a>-->\n                <img src=\"../images/edit.gif\" style=\" vertical-align:middle\"/><a href=\"edit_plate.php?plate_id=";
		echo $row['id'];
		echo "\"style=\"text-decoration:none\">修改</a>\n                <img src=\"../images/icon_21x21_del.gif\" style=\" vertical-align:middle\"/><a onclick='{if(confirm(\"您確定刪除嗎?此操作將不能恢復!\")){ return true;}else{return   false;}}' href=\"delete_plate.php?id=";
		echo $row['id'];
		echo "&plate_num=";
		echo $row['plate_num'];
		echo "\" style=\"text-decoration:none\"> 删除</a></td>\n              </tr>\n";
}
echo "         \t\t\n                \n              <tr >\n                 <td class=\"al\" height=\"24\" colspan=\"26\">\n                 \t";
echo $pagenav;
echo "                 </td>\n              </tr>\n                \n            </table></td>\n          <td width=\"8\" background=\"../images/tab/tab_15.gif\">&nbsp;</td>\n        </tr>\n            \n      </table></td>\n  </tr>\n    \n  <tr>\n    <td height=\"35\" background=\"../images/tab/tab_19.gif\"><table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n        <tr>\n          <td width=\"12\" height=\"35\"><img src=\"../imag";
echo "es/tab/tab_18.gif\" width=\"12\" height=\"35\" /></td>\n          <td><table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n              <tr>\n                <td class=\"STYLE4\">&nbsp;&nbsp;";
echo "<s";
echo "pan style=\" float:right; color:#a4a4a4;margin-top:-5px;\">註：如果修改某一期的任何一個球號後請在重新結算該期！狀態如果[已開啟]前臺會員代理方可查賬!</span></td>\n                <td><table border=\"0\" align=\"right\" cellpadding=\"0\" cellspacing=\"0\">\n                    <tr> </tr>\n                  </table></td>\n              </tr>\n            </table></td>\n          <td width=\"16\"> <img src=\"../images/tab/tab_20";
echo ".gif\" width=\"16\" height=\"35\" /></td>\n        </tr>\n      </table></td>\n  </tr>\n</table>\n    ";
echo "<s";
echo "cript src=\"../js/jquery-1.4.3.min.js\" type=\"text/javascript\"></script>\n    ";
echo "<s";
echo "cript type=\"text/javascript\">\n    function change_is(th,id,plate_num){\n        var v=th.val();\n        var history_is_account=-1;\n        var history_is_lock=-1;\n        if(v==\"未结算\"){\n            history_is_account=0;\n        }else if(v==\"已结算\"){\n            history_is_account=1;\n        }else if(v==\"已关闭\"){\n            history_is_lock=0;\n        }else if(v==\"已开启\"){\n            history_i";
echo "s_lock=1;\n        }\n        \$.ajax({\n            type: \"POST\",\n            url: \"ajax_his_is.php\",\n            data: {'history_is_account':history_is_account,'history_is_lock':history_is_lock,'id':id,'plate_num':plate_num},\n            success: function(msg){\n                if(msg==1){\n                    th.val(\"未结算\");\n                }else if(msg==2){\n                    th.val(\"已结算\");\n  ";
echo "                  alert( plate_num+'期结算成功。') ;\n                }else if(msg==3){\n                    th.val(\"已关闭\");\n                }else if(msg==4){\n                    th.val(\"已开启\");\n                }\n            }\n        });\n    }\n    </script>\n</body>\n</html>\n";
?>
