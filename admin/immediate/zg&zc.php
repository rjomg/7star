<?php
include_once( "../../global.php" );
$db = new immediate( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
$db3 = new immediate( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
$user_id = $_SESSION["uid".$c_p_seesion];
$user_power = $_SESSION["user_power".$c_p_seesion];
$t2 = $_REQUEST['t2'];
$t3 = $_REQUEST['t3'];
$plate_num = $_REQUEST['plate_num'];
$sql = $db->get_imm_by_type3_user_id_power( $user_id, $t2, $t3, $user_power, $plate_num );
$x = $db->query( $sql );
echo "<html oncontextmenu=\"return false\" xmlns=\"http://www.w3.org/1999/xhtml\">\n<head>\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=gbk\">\n";
echo "<s";
echo "tyle type=\"text/css\">\n<!--\nbody {\n\tmargin-left: 0px;\n\tmargin-top: 0px;\n\tmargin-right: 0px;\n\tmargin-bottom: 0px;\n}\n-->\n</style>\n<link href=\"../images/Index.css\" rel=\"stylesheet\" type=\"text/css\">\n</head>\n<body onselect=\"document.selection.empty()\" oncopy=\"document.selection.empty()\" onmouseover=\"self.status='歡迎光臨';return true\">\n";
echo "<s";
echo "tyle type=\"text/css\">\n<!--\n.STYLE2 {color: #0000FF}\n.STYLE5 {\n\tcolor: #006600;\n\tfont-weight: bold;\n}\n.STYLE7 {color: #0000FF; font-weight: bold; }\n.STYLE8 {color: #006600}\n.input1 {\n\tdisplay:inline-block;BACKGROUND-COLOR: #ffffff; BORDER-BOTTOM: #A7BCCB 1px solid; BORDER-LEFT: #A7BCCB 1px solid; BORDER-RIGHT: #A7BCCB 1px solid; BORDER-TOP: #A7BCCB 1px solid; FONT-FAMILY: \"Verdana\", \"Arial\", \"Helvet";
echo "ica\", \"sans-serif\"; FONT-SIZE: 12px;text-align:left;font-weight: bold;color: #990000;line-height: 15px;width: 45px;\n}\n\n.input3 {\n\tdisplay:inline-block;BACKGROUND-COLOR: #ffffff; BORDER-BOTTOM: #A7BCCB 1px solid; BORDER-LEFT: #A7BCCB 1px solid; BORDER-RIGHT: #A7BCCB 1px solid; BORDER-TOP: #A7BCCB 1px solid; FONT-FAMILY: \"Verdana\", \"Arial\", \"Helvetica\", \"sans-serif\"; FONT-SIZE: 12px;text-align:left;";
echo "font-weight: bold;color: #990000;line-height: 15px;width: 60px;\n}\n.input2 {\n\tdisplay:inline-block;BACKGROUND-COLOR: #ffffff; BORDER-BOTTOM: #A7BCCB 1px solid; BORDER-LEFT: #A7BCCB 1px solid; BORDER-RIGHT: #A7BCCB 1px solid; BORDER-TOP: #A7BCCB 1px solid; FONT-FAMILY: \"Verdana\", \"Arial\", \"Helvetica\", \"sans-serif\"; FONT-SIZE: 12px;text-align:left;font-weight: bold;color: #0000ff;line-height: 15px;wi";
echo "dth: 45px;\n}\n.cz{FONT-FAMILY: \"Verdana\", \"Arial\", \"Helvetica\", \"sans-serif\"; FONT-SIZE: 12px;text-align:left;font-weight: bold;color: #990000;}\n-->\n </style>\n\n";
echo "<s";
echo "tyle type=\"text/css\">\n#rs_windowss{ \nwidth:800px; \nheight:500px; \nfloat:left; \nmargin-left:0px; \nmargin-right:0px; \nborder:0px solid #ffffff; \noverflow:auto; overflow-x:hidden;      /*主要就是這句代码*/\nSCROLLBAR-ARROW-COLOR:#FFFFFF;\nSCROLLBAR-FACE-COLOR:#E0F3FF;\nSCROLLBAR-DARKSHADOW-COLOR:#FFFFFF;\nSCROLLBAR-HIGHLIGHT-COLOR:#FFFFFF;\nSCROLLBAR-3DLIGHT-COLOR:#FFFFFF;\nSCROLLBAR-SHADOW-COLOR:#FFFFFF;\n";
echo "SCROLLBAR-TRACK-COLOR:#FFFFFF;}\n \n   #ly {\n            width: 500px;\n            height: 200px;\n          position: absolute;\n            left: 0;\n            top: 0px;\n            border: 0px solid blue;\n            background-color: #fff;\n        }\n #ly iframe\n        {\n            display:none;/*sorry for IE5*/\n            display/**/:block;/*sorry for IE5*/\n            position:absolute;/*must";
echo " have*/\n            top:0;/*must have*/\n            left:0;/*must have*/\n            z-index:-1;/*must have*/\n            filter:mask();/*must have*/\n            width: 100%;/*must have for any big value*/\n            height: 100%;/*must have for any big value*/;\n        }\n\n</style>\n<div id=\"ly\" style=\"position: absolute; top: 0px; background-color: rgb(255, 255, 255); z-index: 2; left: 0px; display";
echo ": block; width: 1337px; height: 513px;\"> \n  <!--[if lte IE 6.5]><iframe></iframe><![endif]--> \n</div>\n<!--          浮層框架開始         -->\n<div id=\"rs_window\" style=\"position: absolute; top: 25px; z-index: 2000; left: 268.5px; display: block;\">\n\n  <table bgcolor=\"#FFFFFF\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\n    <tbody>\n      <tr>\n        <td background=\"../images/tab_05.gif\" height=\"30\"><table borde";
echo "r=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n            <tbody>\n              <tr>\n                <td height=\"30\" width=\"12\"><img src=\"../images/tab_03.gif\" height=\"30\" width=\"12\"></td>\n                <td><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n                    <tbody>\n                      <tr>\n                        <td valign=\"middle\"><table border=\"0\" cellpadding=\"0\"";
echo " cellspacing=\"0\" width=\"100%\">\n                            <tbody>\n                              <tr>\n                                <td width=\"2%\"><div align=\"center\"><img src=\"../images/tb.gif\" height=\"16\" width=\"16\"></div></td>\n                                <td class=\"F_bold\" width=\"70%\">[";
echo $t2." ".str_replace( "<br>", ",", $t3 );
echo "]详细下注記錄</td>\n                                <td class=\"F_bold\" align=\"right\"><a  href=\"javascript:history.back(-1)\" target=\"content\"><img src=\"../images/icon_21x21_del.gif\" border=\"0\" height=\"16\" width=\"16\"></a></td>\n                              </tr>\n                            </tbody>\n                          </table></td>\n                      </tr>\n                    </tbody>\n                  ";
echo "</table></td>\n                <td width=\"16\"><img src=\"../images/tab_07.gif\" height=\"30\" width=\"16\"></td>\n              </tr>\n            </tbody>\n          </table></td>\n      </tr>\n      <tr>\n        <td><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n            <tbody>\n              <tr>\n                <td background=\"../images/tab_12.gif\" width=\"8\">&nbsp;</td>\n                <td align=\"center";
echo "\"><!-- 開始  -->\n                  \n                  <div id=\"rs_windowss\">\n                    <table class=\"t_list Tab\" cellpadding=\"1\" cellspacing=\"1\" width=\"785\">\n                      <tbody>\n                        <tr>\n                          <td class=\"t_list_caption\">ID</td>\n                          <td class=\"t_list_caption\">会员</td>\n                          <td class=\"t_list_caption\">期数</t";
echo "d>\n                          <td class=\"t_list_caption\">下注时间</td>\n                          <td class=\"t_list_caption\">下注金额</td>\n                          <td class=\"t_list_caption\">赔率</td>\n                          <td class=\"t_list_caption\">会员退水</td>\n                          <td class=\"t_list_caption\">代理</td>\n                          ";
if ( $user_power <= 4 )
{
		echo "                          <td class=\"t_list_caption\">总代理</td>\n                          ";
}
if ( $user_power <= 3 )
{
		echo "                          <td class=\"t_list_caption\">股东</td>\n                          ";
}
if ( $user_power <= 2 )
{
		echo "                          <td class=\"t_list_caption\">分公司</td>                          \n                          ";
}
if ( $user_power == 1 )
{
		echo "                          <td class=\"t_list_caption\">公司</td>\n                          ";
}
echo "                        </tr>\n                       ";
$i = 0;
while ( $row = $db->fetch_array( $x ) )
{
		if ( $row['is_fly'] == 1 )
		{
				$is_fly = $db3->get_his_f_user( $row['topf_id'] );
		}
		else
		{
				$is_fly = 2;
		}
		echo "                        <tr class=\"t_list_tr_0\" onmouseover=\"this.style.backgroundColor='#FFFFA2'\" onmouseout=\"this.style.backgroundColor=''\" style=\"line-height:25px;\">\n                          <td>";
		echo ++$i;
		echo "</td>\n                          <td>";
		echo $row['user_name'];
		echo "</td>\n                          <td>";
		echo $row['plate_num'];
		echo "</td>\n                          <td>";
		echo date( "Y-m-d H:i", $row['time'] );
		echo "</td>\n                          <td>";
		echo $row['orders_y'];
		echo " </td>\n                          <td>";
		echo $row['orders_p'];
		echo " </td>\n                          <td>";
		echo $row['tuishui_y'];
		echo " </td>\n                          <td>";
		echo $is_fly == 2 ? ( $tt1 = $row['orders_y'] / 100 * $row['d_z'] ) : ( $tt1 = 0 );
		echo "</td>\n                          ";
		if ( $user_power <= 4 )
		{
				echo "                          <td>";
				echo $is_fly == 2 ? ( $tt2 = $row['orders_y'] / 100 * $row['zd_z'] ) : ( $tt2 = 0 );
				echo "</td>\n                          ";
		}
		if ( $user_power <= 3 )
		{
				echo "                          <td>";
				echo $is_fly == 2 ? ( $tt3 = $row['orders_y'] / 100 * $row['gd_z'] ) : ( $tt3 = 0 );
				echo "</td>\n                          ";
		}
		if ( $user_power <= 2 )
		{
				echo "                          <td>";
				echo $is_fly == 2 ? ( $tt4 = $row['orders_y'] / 100 * $row['f_z'] ) : $is_fly == 1 ? ( $tt4 = $row['orders_y'] ) : ( $tt4 = 0 );
				echo "</td>\n                          ";
		}
		if ( $user_power == 1 )
		{
				echo "                          <td>";
				echo $is_fly == 2 ? ( $tt5 = $row['orders_y'] / 100 * $row['g_z'] ) : $is_fly == 0 ? ( $tt5 = $row['orders_y'] ) : ( $tt5 = 0 );
				echo "</td>\n                          ";
		}
		echo "                        </tr>\n                        ";
		$total += $row['orders_y'];
		$h += $row['tuishui_y'];
		$p1 += $row['orders_p'];
		$d += $tt1;
		$zd += $tt2;
		$gd += $tt3;
		$f += $tt4;
		$g += $tt5;
}
echo "                        <tr class=\"t_list_tr_0\" onmouseover=\"this.style.backgroundColor='#FFFFA2'\" onmouseout=\"this.style.backgroundColor=''\" style=\"line-height:25px;\">\n                          <td>统计</td>\n                          <td></td>\n                           <td>";
echo $i;
echo " </td>\n                           <td></td>\n                          <td>";
echo $total;
echo " </td>\n                          
 <td>";
echo $p1/$i;
echo " </td>\n                                        <td>";
echo $h;
echo " </td>\n                          <td>";
echo $d;
echo "</td>\n                          ";
if ( $user_power <= 4 )
{
		echo "                          <td>";
		echo $zd;
		echo "</td>\n                          ";
}
if ( $user_power <= 3 )
{
		echo "                          <td>";
		echo $gd;
		echo "</td>\n                          ";
}
if ( $user_power <= 2 )
{
		echo "                          <td>";
		echo $f;
		echo "</td>\n                          ";
}
if ( $user_power == 1 )
{
		echo "                          <td>";
		echo $g;
		echo "</td>\n                          ";
}
echo "                        </tr>\n                      </tbody>\n                    </table>\n                  </div>\n                  \n                  <!-- 結束  --></td>\n                <td background=\"../images/tab_15.gif\" width=\"8\">&nbsp;</td>\n              </tr>\n            </tbody>\n          </table></td>\n      </tr>\n      <tr>\n        <td background=\"../images/tab_19.gif\" height=\"35\"><table border=\"0\" cell";
echo "padding=\"0\" cellspacing=\"0\" width=\"100%\">\n            <tbody>\n              <tr>\n                <td height=\"35\" width=\"12\"><img src=\"../images/tab_18.gif\" height=\"35\" width=\"12\"></td>\n                <td valign=\"top\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" height=\"30\" width=\"100%\">\n                    <tbody>\n                      <tr>\n                        <td align=\"center\"><table bordercolord";
echo "ark=\"#FFFFFF\" align=\"center\" border=\"0\" bordercolor=\"f1f1f1\" cellpadding=\"2\" cellspacing=\"0\" width=\"99%\">\n                            <tbody>\n                              <tr>\n                                <td align=\"center\">&nbsp;</td>\n                              </tr>\n                            </tbody>\n                          </table></td>\n                      </tr>\n                    </tbody>\n";
echo "                  </table></td>\n                <td width=\"16\"><img src=\"../images/tab_20.gif\" height=\"35\" width=\"16\"></td>\n              </tr>\n            </tbody>\n          </table></td>\n      </tr>\n    </tbody>\n  </table>\n</div>\n</body>\n</html>";
?>
