<?php
include_once( "../../global.php" );
$db = new plate( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
$db2 = new plate( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
$so = $_GET['so'];
if ( $so )
{
		$so = "and plate_num like '%{$so}%'";
}
$query = $db->select( "plate", "count(*) as c", "id>0 {$so} order by plate_num desc" );
$total = $db->fetch_array( $query );
$total = $total['c'];
pageft( $total, 20 );
if ( $firstcount < 0 )
{
		$firstcount = 0;
}
$query = $db->select( "plate", "*", "id>0 {$so} order by plate_num desc limit  {$firstcount}, {$displaypg}" );
if ( $_GET['plate_num'] )
{
		$db->output_excel( $_GET['plate_num'] );
}
echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\n<html oncontextmenu=\"return false\" xmlns=\"http://www.w3.org/1999/xhtml\">\n<head>\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=gbk\" />\n<title>盘口管理</title>\n";
echo "<s";
echo "tyle type=\"text/css\">\n<!--\nbody {\n\tmargin-left: 0px;\n\tmargin-top: 0px;\n\tmargin-right: 0px;\n\tmargin-bottom: 0px;\n\tcolor:#344b50;\n}\n.STYLE1 {\n\tfont-size: 12px\n}\n.STYLE3 {\n\tfont-size: 12px;\n\tfont-weight: bold;\n}\n.STYLE4 {\n\tcolor: #03515d;\n\tfont-size: 12px;\n}\n-->\n</style>\n<link href=\"../images/commom.css\" rel=\"stylesheet\" type=\"text/css\" />\n";
echo "<s";
echo "cript src=\"../js/jquery-1.4.3.min.js\" type=\"text/javascript\"></script>\n";
echo "<s";
echo "cript>\nvar  highlightcolor='#c1ebff';\n//此处clickcolor只能用win系统颜色代码才能成功,如果用#xxxxxx的代码就不行,还没搞清楚为什么:(\nvar  clickcolor='#51b2f6';\nfunction  changeto(){\nsource=event.srcElement;\nif  (source.tagName==\"TR\"||source.tagName==\"TABLE\")\nreturn;\nwhile(source.tagName!=\"TD\")\nsource=source.parentElement;\nsource=source.parentElement;\ncs  =  source.children;\n//alert(cs.length);\nif  (cs";
echo "[1].style.backgroundColor!=highlightcolor&&source.id!=\"nc\"&&cs[1].style.backgroundColor!=clickcolor)\nfor(i=0;i<cs.length;i++){\n\tcs[i].style.backgroundColor=highlightcolor;\n}\n}\n\nfunction  changeback(){\nif  (event.fromElement.contains(event.toElement)||source.contains(event.toElement)||source.id==\"nc\")\nreturn\nif  (event.toElement!=source&&cs[1].style.backgroundColor!=clickcolor)\n//source.style.backgr";
echo "oundColor=originalcolor\nfor(i=0;i<cs.length;i++){\n\tcs[i].style.backgroundColor=\"\";\n}\n}\n\nfunction  clickto(){\nsource=event.srcElement;\nif  (source.tagName==\"TR\"||source.tagName==\"TABLE\")\nreturn;\nwhile(source.tagName!=\"TD\")\nsource=source.parentElement;\nsource=source.parentElement;\ncs  =  source.children;\n//alert(cs.length);\nif  (cs[1].style.backgroundColor!=clickcolor&&source.id!=\"nc\")\nfor(i=0;i<cs.le";
echo "ngth;i++){\n\tcs[i].style.backgroundColor=clickcolor;\n}\nelse\nfor(i=0;i<cs.length;i++){\n\tcs[i].style.backgroundColor=\"\";\n}\n}\n</script>\n</head>\n<body>\n<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n  <tr>\n    <td height=\"30\" background=\"../images/tab/tab_05.gif\"><table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n        <tr>\n          <td width=\"12\" height=\"30\"><img src=\"../images/t";
echo "ab/tab_03.gif\" width=\"12\" height=\"30\" /></td>\n          <td><table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n              <tr>\n                <td width=\"46%\" valign=\"middle\"><table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n                    <tr>\n                      <td width=\"5%\"><div align=\"center\"><img src=\"../images/tab/tb.gif\" width=\"16\" height=\"16\" /></div></td>\n      ";
echo "                <td width=\"95%\" class=\"STYLE1\" >";
echo "<s";
echo "pan class=\"STYLE3\">導出数據 <!--(只對前二十期数據)--></span> ";
echo "<s";
echo "pan class=\"font_size12 al\" style=\" margin-left:224px;\">期数查询:\n                        <input onblur=\"window.location.href='output.php?so='+\$(this).val()+'&page=";
echo $_GET['page'];
echo "'\" name=\"check\" id=\"check\" value=\"";
echo $_GET['so'];
echo "\" type=\"text\" />\n                        </span></td>\n                    </tr>\n                  </table></td>\n                <td width=\"54%\"><table border=\"0\" align=\"right\" cellpadding=\"0\" cellspacing=\"0\">\n                  </table></td>\n              </tr>\n            </table></td>\n          <td width=\"16\"><img src=\"../images/tab/tab_07.gif\" width=\"16\" height=\"30\" /></td>\n        </tr>\n      </table></td>\n  </tr";
echo ">\n  <tr>\n    <td><table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n        <tr>\n          <td width=\"8\" background=\"../images/tab/tab_12.gif\">&nbsp;</td>\n          <td><table width=\"99%\" align=\"center\" bordercolor='#b5d6e6' border='1' style=\"border-collapse: collapse\" class=\"al font_size12\">\n              <tr onMouseOver=\"this.style.background='#ffffa2'\" \n              onMouseOut=\"this.style.";
echo "background=''\">\n                <td width=\"5%\" height=\"24\" style=\"background:url(../images/bg2.gif) repeat-x 0 0 ;\" class=\"al font_size12\">NO</td>\n                <td width=\"5%\" style=\"background:url(../images/bg2.gif) repeat-x 0 0 ;\" class=\"al font_size12\">期数</td>\n                <td width=\"10%\" style=\"background:url(../images/bg2.gif) repeat-x 0 0 ;\" class=\"al font_size12\">开奖时间</td>\n            ";
echo "    <td colspan=\"2\" class=\"al font_size12\" style=\"background:url(../images/bg2.gif) repeat-x 0 0 ;\">正码1</td>\n                <td width=\"5%\" colspan=\"2\" class=\"al font_size12\" style=\"background:url(../images/bg2.gif) repeat-x 0 0 ;\">正码2</td>\n                <td width=\"5%\" colspan=\"2\" class=\"al font_size12\" style=\"background:url(../images/bg2.gif) repeat-x 0 0 ;\">正码3</td>\n                <td width=\"5";
echo "%\" colspan=\"2\" class=\"al font_size12\" style=\"background:url(../images/bg2.gif) repeat-x 0 0 ;\">正码4</td>\n                <td width=\"5%\" colspan=\"2\" class=\"al font_size12\" style=\"background:url(../images/bg2.gif) repeat-x 0 0 ;\">正码5</td>\n                <td width=\"5%\" colspan=\"2\" class=\"al font_size12\" style=\"background:url(../images/bg2.gif) repeat-x 0 0 ;\">正码6</td>\n                <td width=\"5%\" c";
echo "olspan=\"2\" class=\"al font_size12\" style=\"background:url(../images/bg2.gif) repeat-x 0 0 ;\">特码</td>\n                <td width=\"26%\" class=\"al font_size12\" style=\"background:url(../images/bg2.gif) repeat-x 0 0 ;\">操作</td>\n              </tr>\n";
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
		echo "                  \n              <tr onMouseOver=\"this.style.background='#ffffa2'\" \n              onMouseOut=\"this.style.background=''\">\n                <td class=\"al\" height=\"24\">";
		echo $i;
		echo "</td>\n                <td>";
		echo $row['plate_num'];
		echo "</td>\n                <td>";
		echo $row['plate_time_lottery'];
		echo "</td>\n                <td width=\"2%\" ><p style=\"background-image:url(../images/";
		if ( empty( $num_a['color'] ) )
		{
				echo "r.gif";
		}
		else
		{
				echo $num_a['color'].".gif";
		}
		echo "); height:27px; width:28px; margin:0; padding:0; line-height:27px;\"><b>";
		echo $row['num_a'];
		echo "</b></p></td>\n                <td width=\"2%\">";
		echo $num_a['animal'];
		echo "</td>\n                <td width=\"2%\" ><p style=\"background-image:url(../images/";
		if ( empty( $num_b['color'] ) )
		{
				echo "r.gif";
		}
		else
		{
				echo $num_b['color'].".gif";
		}
		echo "); height:27px; width:28px; margin:0; padding:0; line-height:27px;\"><b>";
		echo $row['num_b'];
		echo "</b></p></td>\n                <td width=\"2%\">";
		echo $num_b['animal'];
		echo "</td>\n                <td width=\"2%\" ><p style=\"background-image:url(../images/";
		if ( empty( $num_c['color'] ) )
		{
				echo "r.gif";
		}
		else
		{
				echo $num_c['color'].".gif";
		}
		echo "); height:27px; width:28px; margin:0; padding:0; line-height:27px;\"><b>";
		echo $row['num_c'];
		echo "</b></p></td>\n                <td width=\"2%\">";
		echo $num_c['animal'];
		echo "</td>\n                <td width=\"2%\" ><p style=\"background-image:url(../images/";
		if ( empty( $num_d['color'] ) )
		{
				echo "r.gif";
		}
		else
		{
				echo $num_d['color'].".gif";
		}
		echo "); height:27px; width:28px; margin:0; padding:0; line-height:27px;\"><b>";
		echo $row['num_d'];
		echo "</b></p></td>\n                <td width=\"2%\">";
		echo $num_d['animal'];
		echo "</td>\n                <td width=\"2%\" ><p style=\"background-image:url(../images/";
		if ( empty( $num_e['color'] ) )
		{
				echo "r.gif";
		}
		else
		{
				echo $num_e['color'].".gif";
		}
		echo "); height:27px; width:28px; margin:0; padding:0; line-height:27px;\"><b>";
		echo $row['num_e'];
		echo "</b></p></td>\n                <td width=\"2%\">";
		echo $num_e['animal'];
		echo "</td>\n                <td width=\"2%\" ><p style=\"background-image:url(../images/";
		if ( empty( $num_f['color'] ) )
		{
				echo "r.gif";
		}
		else
		{
				echo $num_f['color'].".gif";
		}
		echo "); height:27px; width:28px; margin:0; padding:0; line-height:27px;\"><b>";
		echo $row['num_f'];
		echo "</b></p></td>\n                <td width=\"2%\">";
		echo $num_f['animal'];
		echo "</td>\n                <td width=\"2%\" ><p style=\"background-image:url(../images/";
		if ( empty( $num_g['color'] ) )
		{
				echo "r.gif";
		}
		else
		{
				echo $num_g['color'].".gif";
		}
		echo "); height:27px; width:28px; margin:0; padding:0; line-height:27px;\"><b>";
		echo $row['num_g'];
		echo "</b></p></td>\n                <td width=\"2%\">";
		echo $num_g['animal'];
		echo "</td>\n               \n                <td style=\" height:25px; line-height:25px;\" class=\"cz\">\n                <img src=\"../images/22.gif\" style=\" vertical-align:middle\"/><a href=\"output.php?plate_num=";
		echo $row['plate_num'];
		echo "\" style=\"text-decoration:none\"> 导出</a></td>\n              </tr>\n";
}
echo "         \t\t\n\n              <tr >\n                 <td class=\"al\" height=\"24\" colspan=\"18\">\n                 \t";
echo $pagenav;
echo "                 </td>\n              </tr>\n            </table></td>\n          <td width=\"8\" background=\"../images/tab/tab_15.gif\">&nbsp;</td>\n        </tr>\n      </table></td>\n  </tr>\n  <tr>\n    <td height=\"35\" background=\"../images/tab/tab_19.gif\"><table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n        <tr>\n          <td width=\"12\" height=\"35\"><img src=\"../images/tab/tab_18.gif\" width=\"12\" heigh";
echo "t=\"35\" /></td>\n          <td><table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n              <tr>\n                <td class=\"STYLE4\">&nbsp;&nbsp;</td>\n                <td><table border=\"0\" align=\"right\" cellpadding=\"0\" cellspacing=\"0\">\n                    <tr> </tr>\n                  </table></td>\n              </tr>\n            </table></td>\n          <td width=\"16\"> <img src=\"../images/tab/tab_20.g";
echo "if\" width=\"16\" height=\"35\" /></td>\n        </tr>\n      </table></td>\n  </tr>\n</table>\n</body>\n</html>\n";
?>
