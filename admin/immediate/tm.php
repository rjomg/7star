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



$db = new immediate( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
$db2 = new rate( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
$user_id = $_SESSION["uid".$c_p_seesion];
$user_power = $_SESSION["user_power".$c_p_seesion];
$plate_num = $_GET['plate_num'];
if ( !$plate_num )
{
		$plate_num = $db->get_plate( );
}
$type_num = $db->get_num49( );
$t1 = $_GET['t1'];
if ( !$t1 )
{
		$t1 = "特码";
}
$t2 = $_GET['t2'];
if ( !$t2 )
{
		$t2 = "特码AB";
}
if ( strstr( $t2, "AB" ) == "AB" )
{
		$tab2 = $t2;
		$t2 = $t1."A";
		$ab = 1;
}
else
{
		$tab2 = $t2;
		$ab = 0;
}
$type_not_num = $db->get_type_not_num_tm_to_zm( $t1 );
$oid = $db->change_oid_or_oname( 0, $t2 );
$sing = $db->get_single_set( $user_id, $oid );
$imm_num = $db->get_imm_tm_to_zm_by_num( $type_num, $user_id, $plate_num, $t1, $t2, $user_power, $sing['kx_value'], 1, $ab );
$all_plate = $db->get_all_plate_num( );
$imm_not_num = $db->get_imm_tm_to_zm_by_num( $type_not_num, $user_id, $plate_num, $t1, $t2, $user_power, $sing['kx_value'], 0, $ab );
$rate = $db2->get_rate( $oid, 1 );
foreach ( $imm_num as $cv )
{
		$imm_total0 += $cv['total'];
		$imm_zc0 += $cv['zc'];
		$imm_yf0 += $cv['yf'];
		$imm_type3 .= $cv['type3'].",";
		if ( $cv['total'] != 0 )
		{
				$duo_bus .= $cv['type3'].",".$rate[$cv['type3']][1].",".$sing['zfts_value'].",".$cv['zf'].",".$t1.",".$t2.";";
		}
}
foreach ( $imm_not_num as $cv_not )
{       
		$imm_total1 += $cv_not['total'];
		$imm_zc1 += $cv_not['zc'];
		$imm_yf1 += $cv_not['yf'];
}
$imm_total = $imm_total0 + $imm_total1;
$imm_zc = $imm_zc0 + $imm_zc1;
$imm_yf = 0 - ( $imm_yf0 + $imm_yf1 );


echo "<html oncontextmenu=\"return false\" xmlns=\"http://www.w3.org/1999/xhtml\">\n<head>\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">\n</head>\n\n<body>\n<link href=\"../images/Index.css\" rel=\"stylesheet\" type=\"text/css\">\n    ";
echo "<s";
echo "cript src=\"../js/jquery-1.4.3.min.js?i=0\" type=\"text/javascript\"></script>\n";
echo "<s";
echo "cript src=\"js/normal.js?i=1\" type=\"text/javascript\"></script>\n";
if ( !empty( $_GET['jishizhudanshuaxinshijian'] ) )
{
		if ( $_GET['jishizhudanshuaxinshijian'] == -1 )
		{
				$_SESSION["jishizhudanshuaxinshijian".$c_p_seesion] = 0;
		}
		else
		{
				$_SESSION["jishizhudanshuaxinshijian".$c_p_seesion] = $_GET['jishizhudanshuaxinshijian'];
		}
}
if ( !empty( $_SESSION["jishizhudanshuaxinshijian".$c_p_seesion] ) )
{
		echo "<s";
		echo "cript language=\"JavaScript\">  \niso();    \nvar ii=";
		echo $_SESSION["jishizhudanshuaxinshijian".$c_p_seesion];
		echo ";\nfunction iso(){\n    ii--;\n    if(ii<'0'){\n        ii=";
		echo $_SESSION["jishizhudanshuaxinshijian".$c_p_seesion];
		echo ";\n        sendform(ii); \n    }\n    \$(\"#n\").text(ii);\n    setTimeout(\"iso()\",1000);\n}\n</script> \n";
}
echo "<S";
echo "CRIPT type=\"text/javascript\">\n    function sendform(v){\n        if(v==''){\n        v = \"";
echo $_SESSION["jishizhudanshuaxinshijian".$c_p_seesion];
echo "\";\n        }\n        var hs = \$(\"#hengshu\");\n        var t1 = \$(\"#t1\");\n        var t2 = \$(\"#t2\");\n        var plate_num = \$(\"#plate_num\");\n        var url = 'tm.php';\n        url += \"?hs=\"+hs.val()+\"&t1=\"+t1.val()+\"&t2=\"+t2.val()+\"&plate_num=\"+plate_num.val()+\"&jishizhudanshuaxinshijian=\"+v;\n\n        window.open(url,'_self');\n    }\n</SCRIPT>\n\n";
echo "<s";
echo "tyle>\n    .yellow{\n        background-color: yellow;\n    }\n</style>\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n    \n  <tbody>\n    <tr>\n      <td background=\"../images/tab_05.gif\" height=\"30\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n          <tbody>\n            <tr>\n              <td height=\"30\" width=\"12\"><img src=\"../images/tab_03.gif\" height=\"30\" width=\"12\"></td";
echo ">\n              <td><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n                  <tbody>\n                    <tr>\n                      <td valign=\"middle\" width=\"87%\">\n                          <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n                          <tbody>\n                            <tr>\n                              <td width=\"16\"><div align=\"center";
echo "\"><img src=\"../images/tb.gif\" height=\"16\" width=\"16\"></div></td>\n                              <td class=\"F_bold\" width=\"151\">";
echo "<s";
echo "pan id=\"ftm1\">";
echo $t1;
echo "</span>即時註單</td>\n                              <td class=\"F_bold\" align=\"right\" nowrap=\"nowrap\">\n                                  <input id=\"t1\" type=\"hidden\" value=\"";
echo $t1;
echo "\" />\n                                      <input id=\"t2\" type=\"hidden\" value=\"";
echo $tab2;
echo "\" />\n                                      <input id=\"plate_num\" type=\"hidden\" value=\"";
echo $plate_num;
echo "\" />\n                                  模式： ";
echo "<S";
echo "ELECT name=\"hengshu\" id=\"hengshu\" onChange=\"sendform(";
echo $_SESSION["jishizhudanshuaxinshijian".$c_p_seesion];
echo ");\" class=za_select > \n                                      \n                                      <OPTION ";
if ( empty( $_GET['hs'] ) )
{
		echo "selected";
}
echo "  value=0>橫排</OPTION> <OPTION ";
if ( $_GET['hs'] )
{
		echo "selected";
}
echo " value=1>豎排</OPTION>\n                                  </SELECT> \n                                類型：\n                                ";
echo "<s";
echo "elect class=\"za_select\" id=\"ltype\" name=\"abcdx\" onchange=\"change_a_b(\$(this).val(),'";
echo $plate_num;
echo "','";
echo $t1;
echo "')\">\n                                  <option ";
echo strstr( $tab2, "A" ) ? "selected=\"selected\"" : "";
echo " value=\"A\">A</option>\n                                  <option ";
echo strstr( $tab2, "B" ) ? "selected=\"selected\"" : "";
echo " value=\"B\">B</option>\n                                  <option ";
echo strstr( $tab2, "AB" ) ? "selected=\"selected\"" : "";
echo " value=\"AB\">A+B</option>\n                                </select>\n                                ";
echo "<s";
echo "pan id=\"a6\" style=\"DISPLAY:none \">統計:\n                                ";
echo "<s";
echo "elect name=\"ztm1\">\n                                  <option value=\"0\">號碼</option>\n                                  <option value=\"1\" selected=\"selected\">全部</option>\n                                </select>\n                                </span> 期數：\n                                ";
echo "<s";
echo "elect class=\"zaselect_ste\" name=\"kithe\" onchange=\"change_a_b(\$('#ltype').val(),\$(this).val(),'";
echo $t1;
echo "')\">\n                                  ";
foreach ( $all_plate as $p )
{
		echo "                                    <option ";
		echo $plate_num == $p ? "selected=\"selected\"" : "";
		echo " value=\"";
		echo $p;
		echo "\">第[";
		echo $p;
		echo "]期</option>\n                                  ";
}
echo "                                </select></td>\n                              <td class=\"F_bold\" width=\"839\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\n                                  <tbody>\n                                    <tr>\n                                      <td> 設置--&gt;&nbsp;虧損:\n                                        <input name=\"c1\" class=\"input3\" id=\"c1\" value=\"";
echo $sing['kx_value'];
echo "\" size=\"15\" type=\"text\">\n                                        &nbsp;走飛默認退水:\n                                        <input name=\"c2\" class=\"input2\" id=\"c2\" value=\"";
echo $sing['zfts_value'];
echo "\" size=\"10\" type=\"text\"></td>\n                                      <td id=\"cc8899\">&nbsp;警值:\n                                        <input name=\"c3\" class=\"input3\" id=\"c3\" value=\"";
echo $sing['j_value'];
echo "\" size=\"10\" type=\"text\">\n                                       </td>\n                                      <td>&nbsp;\n                                        <input onclick=\"go_single_set(";
echo $user_id.",".$oid.",'".$plate_num."','".$t1."','".$t2."'";
echo ",\$('#c1').val(),\$('#c2').val(),\$('#c3').val())\" class=\"button_a\" id=\"Submit\" value=\"設置\" type=\"button\"></td>\n                                    </tr>\n                                  </tbody>\n                                </table></td>\n                              <td class=\"F_bold\" width=\"12\">&nbsp;</td>\n                              <td width=\"179\" align=\"right\"><input name=\"tm\" type=\"hidden\" id=\"t";
echo "m\" value=\"0\">\n                                ";
echo "<s";
echo "pan id=\"n\">";
echo $_SESSION["jishizhudanshuaxinshijian".$c_p_seesion];
echo "</span>秒\n                                ";
echo "<s";
echo "elect name=\"oReload\" onchange=\"sendform(this.value)\">\n                                    <option value=\"-1\" ";
echo empty( $_SESSION["jishizhudanshuaxinshijian".$c_p_seesion] ) ? "selected=\"selected\"" : "";
echo ">NO</option>\n                                  <option value=\"10\" ";
echo $_SESSION["jishizhudanshuaxinshijian".$c_p_seesion] == 10 ? "selected=\"selected\"" : "";
echo ">10 </option>\n                                  <option value=\"30\" ";
echo $_SESSION["jishizhudanshuaxinshijian".$c_p_seesion] == 30 ? "selected=\"selected\"" : "";
echo ">30 </option>\n                                  <option value=\"60\" ";
echo $_SESSION["jishizhudanshuaxinshijian".$c_p_seesion] == 60 ? "selected=\"selected\"" : "";
echo ">60 </option>\n                                  <option value=\"120\" ";
echo $_SESSION["jishizhudanshuaxinshijian".$c_p_seesion] == 120 ? "selected=\"selected\"" : "";
echo ">120 </option>\n                                </select>\n                               </td>\n                            </tr>\n                          </tbody>\n                        </table></td>\n                    </tr>\n                  </tbody>\n                </table></td>\n              <td width=\"16\"><img src=\"../images/tab_07.gif\" height=\"30\" width=\"16\"></td>\n            </tr>\n          </tbody>\n   ";
echo "     </table></td>\n    </tr>\n    <tr>\n      <td><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n          <tbody>\n            <tr>\n              <td background=\"../images/tab_12.gif\" width=\"8\">&nbsp;</td>\n              <td align=\"center\" height=\"50\"><!-- 開始  -->\n                <div id=\"result\">\n                  <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n                 ";
echo "   <tbody>\n                      <tr>\n                        <td valign=\"top\"><input name=\"ffc1\" id=\"ffc1\" value=\"0\" type=\"hidden\">\n                          <input name=\"ffc2\" id=\"ffc2\" value=\"12\" type=\"hidden\">\n                          <input name=\"ffc3\" id=\"ffc3\" value=\"0\" type=\"hidden\">\n                          <table id=\"tb\" class=\"ball_List Tab\" align=\"center\" border=\"0\" bordercolor=\"f1f1f1\" cel";
echo "lpadding=\"1\" cellspacing=\"1\" width=\"99%\">\n                            <tbody>\n                                ";
if ( empty( $_GET['hs'] ) )
{
		echo "                              <tr class=\"td_caption_1\">\n                                  ";
		$i = 0;
		for ( ;	$i < 3;	++$i	)
		{
				echo "                                <td bordercolor=\"cccccc\" align=\"center\" bgcolor=\"#DFEFFF\" height=\"28\" nowrap=\"nowrap\" width=\"30\">號碼</td>\n                                <td bordercolor=\"cccccc\" align=\"center\" bgcolor=\"#DFEFFF\" nowrap=\"nowrap\">總額/占成</td>\n                                <td bordercolor=\"cccccc\" align=\"center\" bgcolor=\"#DFEFFF\" nowrap=\"nowrap\">預計盈利</td>\n                          ";
				echo "      <td bordercolor=\"cccccc\" align=\"center\" bgcolor=\"#DFEFFF\" nowrap=\"nowrap\">走飛</td>\n                                <td bordercolor=\"cccccc\" align=\"center\" bgcolor=\"#DFEFFF\" nowrap=\"nowrap\">已飛</td>\n                                <td bordercolor=\"cccccc\" align=\"center\" bgcolor=\"#DFEFFF\" nowrap=\"nowrap\">賠率</td>\n                                ";
		}
		echo "                              </tr>\n                    ";
		$i = 0;
		for ( ;	$i < 18;	++$i	)
		{
			
			
			
				echo "                              <tr style=\"background-color: rgb(255, 255, 255);\" onmouseover=\"this.style.backgroundColor='#FFFFA2'\" onmouseout=\"this.style.backgroundColor='ffffff'\" bgcolor=\"#FFFFFF\">\n                                ";
				$j = 0;
				for ( ;	$j < 3;	++$j	)
				{
						$k = $i + $j * 18;
						if ( $imm_num[$k]['type3'] )
						{
								echo "                                <td bordercolor=\"cccccc\" class=\"ball ball_";
								echo $db->get_color( $imm_num[$k]['type3'] );
								echo "\" id=\"type_15\" align=\"center\" height=\"28\">";
								echo $imm_num[$k]['type3'];
								echo "</td>\n                                <td bordercolor=\"cccccc\" align=\"center\" ";
								echo $sing['j_value'] < $imm_num[$k]['total'] ? "bgcolor=\"#FFFFAA\"" : "";
								echo " nowrap=\"nowrap\"> \n                                 <a href=\"zg&zc.php?t2=";
								echo $t2."&t3=".$imm_num[$k]['type3']."&plate_num=".$plate_num;
								echo "\" target=\"content\">";
								echo $imm_num[$k]['total'];							
								echo "/";
								echo $imm_num[$k]['zc'];
								echo "</a></td>\n                                <td bordercolor=\"cccccc\" align=\"center\" nowrap=\"nowrap\">";
								echo sprintf("%.1f", $imm_num[$k]['yl']+$imm_zc0);
								echo "</td>\n                                <td bordercolor=\"cccccc\" align=\"center\" nowrap=\"nowrap\">\n                                ";
								if ( 0 < $imm_num[$k]['zf'] )
								{
										echo "     \n                                <a href=\"duo_bu.php?plate_num=";
										echo $plate_num;
										echo "&t2=";
										echo $t2;
										echo "&urlname=tm&duobu=";
										echo $db->get_duo_bu_string( $imm_num[$k]['type3'], $duo_bus, $imm_type3 );
										echo "\" target=\"content\">";
										if ( $k != 0 && $imm_num[$k]['total'] != 0 )
										{
												echo "<font color=\"009900\">多補</font>";
										}
										echo "</a>&nbsp;\n                                ";
										if ( $imm_num[$k]['total'] != 0 )
										{
												echo "                                <a href=\"dan_bu.php?type3=";
												echo $imm_num[$k]['type3']."&urlname=tm&rate=".$rate[$imm_num[$k]['type3']][1]."&ts=".$sing['zfts_value']."&je=".$imm_num[$k]['zf']."&t1=".$t1."&t2=".$t2."&plate_num=".$plate_num;
												echo "\" target=\"content\">\n                                <font color=\"ff0000\">單補";
												echo $imm_num[$k]['zf'];
												echo "</font></a> \n                                ";
										}
										else
										{
												echo 0;
										}
										echo "                                ";
								}
								else
								{
										echo 0;
								}
								echo "                                </td>\n                                <td bordercolor=\"cccccc\" align=\"center\" nowrap=\"nowrap\">  \n                                    <a href=\"yi_fei.php?t2=";
								echo $t2."&t3=".$imm_num[$k]['type3']."&plate_num=".$plate_num;
								echo "\" target=\"content\">";
								echo 0 - $imm_num[$k]['yf'];
								echo "</a></td>\n                                <td bordercolor=\"cccccc\" align=\"center\" nowrap=\"nowrap\">\n                                    <a style=\"\" onClick=\"UpdateRate(";
								echo $oid;
								echo ",1,\$(this).next('input'),";
								echo $rate[$imm_num[$k]['type3']][1];
								echo ",0.1,'";
								echo $plate_num;
								echo "','";
								echo $imm_num[$k]['type3'];
								echo "');\">";
								echo "<s";
								echo "pan style=\"vertical-align:middle;\"><img src=\"../images/bvbv_01.gif\" border=\"0\" height=\"17\" width=\"19\"></span></a>\n                        <input onblur=\"UpdateRate(";
								echo $oid;
								echo ",0,\$(this),";
								echo $rate[$imm_num[$k]['type3']][1];
								echo ",0,'";
								echo $plate_num;
								echo "','";
								echo $imm_num[$k]['type3'];
								echo "');\" class=\"rate_set rate_color\" type=\"text\" style=\"width:63px;\" value=\"";
								echo $rate[$imm_num[$k]['type3']][1];
								echo "\" />\n                        <a style=\"\" onClick=\"UpdateRate(";
								echo $oid;
								echo ",2,\$(this).prev('input'),";
								echo $rate[$imm_num[$k]['type3']][1];
								echo ",0.1,'";
								echo $plate_num;
								echo "','";
								echo $imm_num[$k]['type3'];
								echo "');\">";
								echo "<s";
								echo "pan style=\"vertical-align:middle;\"><img src=\"../images/bvbv_02.gif\" border=\"0\" height=\"17\" width=\"19\"></span></a>\n                                    ";
								echo "<s";
								echo "pan style=\"vertical-align:middle;\"></span>\n                                </td>\n                                \n                                 ";
						}
						else
						{
								echo "                                    <td colspan=\"6\">\n                                        ";
								++$l;
								if ( 1 < $l && $l < 5 )
								{
										echo "                                        <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\"><tbody>\n                                            <tr>\n                                                <td align=\"right\" width=\"40%\">";
										echo "<s";
										echo "pan class=\"STYLE10\">";
										if ( $l == 2 )
										{
												echo "下注总额：";
										}
										else if ( $l == 3 )
										{
												echo "占成总额：";
										}
										else
										{
												echo "已飞总额：";
										}
										echo "</span></td>\n                                                <td width=\"60%\"><font color=\"ff0000\">";
										echo "<s";
										echo "trong>";
										if ( $l == 2 )
										{
												echo $imm_total;
										}
										else if ( $l == 3 )
										{
												echo $imm_zc;
										}
										else
										{
												echo $imm_yf;
										}
										echo "</strong></font></td>\n                                            </tr>\n                                        </tbody></table>\n                                        ";
								}
								echo "                                    </td>\n                                ";
						}
				}
				echo "                              </tr>\n               ";
		}
		echo "                                ";
}
else
{
		echo "                                <TR class=td_caption_1>\n                      <TD bgColor=#dfefff height=28 borderColor=#cccccc width=30 noWrap align=center>排序</TD>\n                      <TD bgColor=#dfefff borderColor=#cccccc width=30 noWrap align=center>號碼</TD>\n                      <TD bgColor=#dfefff borderColor=#cccccc noWrap align=center>總額</TD>\n                      <TD bgColor=#dfefff border";
		echo "Color=#cccccc noWrap align=center>占成</TD>\n                      <TD bgColor=#dfefff borderColor=#cccccc noWrap align=center>單雙</TD>\n                      <TD bgColor=#dfefff borderColor=#cccccc noWrap align=center>大小</TD>\n                      <TD bgColor=#dfefff borderColor=#cccccc noWrap align=center>合單雙</TD>\n                      <TD bgColor=#dfefff borderColor=#cccccc noWrap align=center>尾大";
		echo "小</TD>\n                      <TD bgColor=#dfefff borderColor=#cccccc noWrap align=center>波色</TD>\n                      <TD bgColor=#dfefff borderColor=#cccccc noWrap align=center>預計盈利</TD>\n                      <TD bgColor=#dfefff borderColor=#cccccc noWrap align=center>走飛</TD>\n                      <TD bgColor=#dfefff borderColor=#cccccc noWrap align=center>已飛</TD>\n                      <TD bgCo";
		echo "lor=#dfefff borderColor=#cccccc noWrap align=center>賠率</TD></TR>\n         ";
		foreach ( $imm_num as $i => $cv )
		{
				if ( $cv['total'] != 0 )
				{
						$duo_bu .= $cv['type3'].",".$rate[$cv['type3']][1].",".$sing['zfts_value'].",".$cv['zf'].",".$t1.",".$t2.";";
				}
				echo "           \n                 <TR style=\"BACKGROUND-COLOR: #ffffff\" \n                    onmouseover=\"this.style.backgroundColor='#FFFFA2'\" \n                    onmouseout=\"this.style.backgroundColor='ffffff'\" \n                    bgColor=#ffffff>\n                      <TD height=28 borderColor=#cccccc noWrap \n                      align=center>";
				echo $i + 1;
				echo "</TD>\n                      <TD class=\"ball ball_";
				echo $db->get_color( $cv['type3'] );
				echo "\"\n                      height=25 borderColor=#cccccc align=center>";
				echo $cv['type3'];
				echo "</TD>\n                      <TD ";
				echo $sing['j_value'] < $cv['total'] ? "bgcolor=\"#FFFFAA\"" : "";
				echo " borderColor=#cccccc noWrap \n                      align=center>";
				echo $cv['total'];
				echo "</TD>\n                      <TD borderColor=#cccccc noWrap align=center>";
				echo $cv['zc'];
				echo "</TD>\n                      <TD borderColor=#cccccc noWrap align=center>0</TD>\n                      <TD borderColor=#cccccc noWrap align=center>0</TD>\n                      <TD borderColor=#cccccc noWrap align=center>0</TD>\n                      <TD borderColor=#cccccc noWrap align=center>0</TD>\n                      <TD borderColor=#cccccc noWrap align=center>0</TD>\n                      <TD borderColor=#cc";
				echo "cccc noWrap align=center>";
				echo sprintf("%.1f",$cv['yl']+$imm_zc0);
				echo "</TD>\n                      <TD borderColor=#cccccc noWrap align=center>\n                          ";
				if ( 0 < $cv['zf'] )
				{
						echo "     \n                                <a href=\"duo_bu.php?plate_num=";
						echo $plate_num;
						echo "&t2=";
						echo $t2;
						echo "&urlname=tm&duobu=";
						echo $duo_bu;
						echo "\" target=\"content\">";
						if ( $i != 0 && $cv['total'] != 0 )
						{
								echo "<font color=\"009900\">多補</font>";
						}
						echo "</a>&nbsp;\n                                ";
						if ( $cv['total'] != 0 )
						{
								echo "                                <a href=\"dan_bu.php?type3=";
								echo $cv['type3']."&urlname=tm&rate=".$rate[$cv['type3']][1]."&ts=".$sing['zfts_value']."&je=".$cv['zf']."&t1=".$t1."&t2=".$t2."&plate_num=".$plate_num;
								echo "\" target=\"content\">\n                                <font color=\"ff0000\">單補";
								echo $cv['zf'];
								echo "</font></a> \n                                ";
						}
						else
						{
								echo 0;
						}
						echo "                                ";
				}
				else
				{
						echo 0;
				}
				echo "                      </TD>\n                      <TD borderColor=#cccccc noWrap align=center>\n                          <a href=\"yi_fei.php?t2=";
				echo $t2."&t3=".$cv['type3']."&plate_num=".$plate_num;
				echo "\" target=\"content\">";
				echo $cv['yf'];
				echo "</a>\n                      </TD>\n                      <TD borderColor=#cccccc noWrap align=center>\n                          <a onClick=\"UpdateRate(";
				echo $oid;
				echo ",1,\$(this).next('input'),";
				echo $rate[$cv['type3']][1];
				echo ",0.1,'";
				echo $plate_num;
				echo "','";
				echo $cv['type3'];
				echo "');\" style=\"cursor:hand\">";
				echo "<s";
				echo "pan style=\"vertical-align:middle;\"><img src=\"../images/bvbv_01.gif\" border=\"0\" height=\"17\" width=\"19\"></span></a>\n                                    <input onblur=\"UpdateRate(";
				echo $oid;
				echo ",0,\$(this),";
				echo $rate[$cv['type3']][1];
				echo ",0,'";
				echo $plate_num;
				echo "','";
				echo $cv['type3'];
				echo "');\" class=\"rate_set rate_color\" type=\"text\" style=\"width:63;\" value=\"";
				echo $rate[$cv['type3']][1];
				echo "\" />\n                                    <a onClick=\"UpdateRate(";
				echo $oid;
				echo ",2,\$(this).prev('input'),";
				echo $rate[$cv['type3']][1];
				echo ",0.1,'";
				echo $plate_num;
				echo "','";
				echo $cv['type3'];
				echo "');\" style=\"cursor:hand\">";
				echo "<s";
				echo "pan style=\"vertical-align:middle;\"><img src=\"../images/bvbv_02.gif\" border=\"0\" height=\"17\" width=\"19\"></span></a>";
				echo "<s";
				echo "pan style=\"vertical-align:middle;\"></span>\n                                \n                      </TD></TR>\n";
		}
		echo "                        \n                    <TR onmouseover=\"this.style.backgroundColor='#FFFFA2'\" \n                    onmouseout=\"this.style.backgroundColor='ffffff'\" \n                    bgColor=#ffffff>\n                      <TD height=28 borderColor=#cccccc noWrap \n                      align=center>&nbsp;</TD>\n                      <TD borderColor=#cccccc noWrap align=center>總計</TD>\n          ";
		echo "            <TD borderColor=#cccccc noWrap align=center>";
		echo $imm_total;
		echo "</TD>\n                      <TD borderColor=#cccccc noWrap align=center>";
		echo $imm_zc;
		echo "</TD>\n                      <TD borderColor=#cccccc noWrap align=center>&nbsp;</TD>\n                      <TD borderColor=#cccccc noWrap align=center>&nbsp;</TD>\n                      <TD borderColor=#cccccc noWrap align=center>&nbsp;</TD>\n                      <TD borderColor=#cccccc noWrap align=center>&nbsp;</TD>\n                      <TD borderColor=#cccccc noWrap align=center>&nbsp;</TD>\n               ";
		echo "       <TD borderColor=#cccccc noWrap align=center>&nbsp;</TD>\n                      <TD borderColor=#cccccc noWrap align=center>&nbsp;</TD>\n                      <TD borderColor=#cccccc noWrap align=center>";
		echo $imm_yf;
		echo "</TD>\n                      <TD borderColor=#cccccc noWrap \n                    align=center>&nbsp;</TD></TR>\n                                ";
}
echo "                            </tbody>\n                          </table>\n                          <table id=\"tb\"  class=\"ball_List Tab\" align=\"center\" border=\"0\" bordercolor=\"f1f1f1\" cellpadding=\"1\" cellspacing=\"1\" width=\"99%\">\n                            <tbody>\n                              <tr class=\"td_caption_1\">\n                               ";
$i = 0;
for ( ;	$i < 3;	++$i	)
{
		echo "                                <td bordercolor=\"cccccc\" align=\"center\" bgcolor=\"#DFEFFF\" height=\"28\" nowrap=\"nowrap\" width=\"30\">號碼</td>\n                                <td bordercolor=\"cccccc\" align=\"center\" bgcolor=\"#DFEFFF\" nowrap=\"nowrap\">總額/占成</td>\n  <td bordercolor=\"cccccc\" align=\"center\" bgcolor=\"#DFEFFF\" nowrap=\"nowrap\">預計盈利</td>\n                                <td bordercolor=\"cccccc\" align=\"center\" bgcolor=\"#DFEFFF\" nowrap=\"nowrap\">走飛</td>\n                              ";
		echo "  <td bordercolor=\"cccccc\" align=\"center\" bgcolor=\"#DFEFFF\" nowrap=\"nowrap\">已飛</td>\n                                <td bordercolor=\"cccccc\" align=\"center\" bgcolor=\"#DFEFFF\" nowrap=\"nowrap\">賠率</td>\n                                ";
}
echo "                               </tr>\n                              ";
$i = 0;
for ( ;	$i < 5;	++$i	)
{
		echo "                              <tr onmouseover=\"this.style.backgroundColor='#FFFFA2'\" onmouseout=\"this.style.backgroundColor='ffffff'\" bgcolor=\"#FFFFFF\">\n                                ";
		$j = 0;
		foreach ( $imm_not_num as $k => $v )
		{
				++$j;
				if ( $j == 4 )
				{
						break;
				}
				echo "                                <td bordercolor=\"cccccc\" align=\"center\" height=\"28\" style=\"color:";
				if ( $v['type3'] == "红波" )
				{
						echo "red";
				}
				else if ( $v['type3'] == "蓝波" )
				{
						echo "blue";
				}
				else if ( $v['type3'] == "绿波" )
				{
						echo "green";
				}
				echo "\">";
				echo $v['type3'];
				echo "</td>\n                                <td bordercolor=\"cccccc\" align=\"center\" ";
				echo $sing['j_value'] < $v['total'] ? "bgcolor=\"#FFFFAA\"" : "";
				echo " nowrap=\"nowrap\">\n                                    <a href=\"zg&zc.php?t2=";
				echo $t2."&t3=".$v['type3']."&plate_num=".$plate_num;
				echo "\" onclick=\"\">";
				echo $v['total'];
				echo "/";
				echo $v['zc'];
				echo "</a></td>\n                             
				
				
			   <td bordercolor=\"cccccc\" align=\"center\" nowrap=\"nowrap\">";
								echo $v['yl']+$imm_zc1;
								echo "</td>\n              
				   <td bordercolor=\"cccccc\" align=\"center\" nowrap=\"nowrap\">\n                                    ";
				if ( $v['zf'] != 0 )
				{
						echo "                                    <a  href=\"dan_bu.php?type3=";
						echo $v['type3']."&urlname=tm&rate=".$rate[$v['type3']][1]."&ts=".$sing['zfts_value']."&je=".$v['zc']."&t1=".$t1."&t2=".$t2."&plate_num=".$plate_num;
						echo "\" >\n                                    <font color=\"ff0000\">單補";
						echo $v['zf'];
						echo "</font>\n                                    </a>\n                                    ";
				}
				else
				{
						echo 0;
				}
				echo "                                </td>\n   
				
				                             <td bordercolor=\"cccccc\" align=\"center\" nowrap=\"nowrap\">\n                                    <a href=\"yi_fei.php?t2=";
				echo $t2."&t3=".$v['type3']."&plate_num=".$plate_num;
				echo "\" target=\"content\">";
				echo 0 - $v['yf'];
				echo "</a>\n                                </td>\n                               <td bordercolor=\"cccccc\" align=\"center\" nowrap=\"nowrap\">\n                                    <a onClick=\"UpdateRate(";
				echo $oid;
				echo ",1,\$(this).next('input'),";
				echo $rate[$v['type3']][1];
				echo ",0.1,'";
				echo $plate_num;
				echo "','";
				echo $v['type3'];
				echo "');\" style=\"cursor:hand\">";
				echo "<s";
				echo "pan style=\"vertical-align:middle;\"><img src=\"../images/bvbv_01.gif\" border=\"0\" height=\"17\" width=\"19\"></span></a>\n                                    <input onblur=\"UpdateRate(";
				echo $oid;
				echo ",0,\$(this),";
				echo $rate[$v['type3']][1];
				echo ",0,'";
				echo $plate_num;
				echo "','";
				echo $v['type3'];
				echo "');\" class=\"rate_set rate_color\" type=\"text\" style=\"width:63px;\" value=\"";
				echo $rate[$v['type3']][1];
				echo "\" />\n                                    <a onClick=\"UpdateRate(";
				echo $oid;
				echo ",2,\$(this).prev('input'),";
				echo $rate[$v['type3']][1];
				echo ",0.1,'";
				echo $plate_num;
				echo "','";
				echo $v['type3'];
				echo "');\" style=\"cursor:hand\">";
				echo "<s";
				echo "pan style=\"vertical-align:middle;\"><img src=\"../images/bvbv_02.gif\" border=\"0\" height=\"17\" width=\"19\"></span></a>";
				echo "<s";
				echo "pan style=\"vertical-align:middle;\"></span></td>\n                                \n                                ";
				unset( $imm_not_num[$k] );
		}
		echo "                              </tr>\n                              ";
}
echo "                            </tbody>\n                          </table>\n<TABLE class=\"ball_List Tab\"  border=\"1\" bordercolor=\"#b5d6e6\"  borderColorDark=#ffffff cellPadding=2 width=\"99%\" align=center  class=\"Tab\" >\n          <tbody>\n            <tr class=\"td_caption_1\" align=\"center\">\n              <TD bgColor=#c6d0ec borderColor=#cccccc colSpan=15 height=\"25\" align=center style=\"background:url(../images";
echo "/bg2.gif) repeat-x 0 0  ;\" class=\"al font_size12\">";
echo "<S";
echo "TRONG>賠率調設&nbsp;</strong></td>\n            </tr>\n            <tr align=\"center\">\n                ";
$anmail = $db->get_animal_table( );
foreach ( $anmail as $key => $v )
{
		echo "              <td bordercolor=\"cccccc\" align=\"left\" bgcolor=\"#FFFFFF\"><input onclick=\"select_array(\$(this));\" value=\"";
		echo ",".$v;
		echo "\" type=\"checkbox\" />\n                ";
		echo $key;
		echo " </td>\n                ";
}
echo "              <td bordercolor=\"cccccc\" align=\"left\" bgcolor=\"#FFFFFF\">&nbsp;</td>\n              <td bordercolor=\"cccccc\" align=\"left\" bgcolor=\"#FFFFFF\">&nbsp;</td>\n              <td bordercolor=\"cccccc\" align=\"left\" bgcolor=\"#FFFFFF\">&nbsp;</td>\n            </tr>\n            <tr align=\"center\">\n              <td bordercolor=\"cccccc\" align=\"left\" bgcolor=\"#FFFFFF\"><input onclick=\"select_array(\$(this));\" valu";
echo "e=\"01,07,13,19,23,29,35,45\" type=\"checkbox\" />\n                ";
echo "<s";
echo "pan class=\"Font_R\">紅單</span></td>\n              <td bordercolor=\"cccccc\" align=\"left\" bgcolor=\"#FFFFFF\"><input onclick=\"select_array(\$(this));\" value=\"02,08,12,18,24,30,34,40,46\" type=\"checkbox\" />\n                ";
echo "<s";
echo "pan class=\"Font_R\">紅雙</span></td>\n              <td bordercolor=\"cccccc\" align=\"left\" bgcolor=\"#FFFFFF\"><input onclick=\"select_array(\$(this));\" value=\"29,30,34,35,40,45,46\" type=\"checkbox\" />\n                ";
echo "<s";
echo "pan class=\"Font_R\">紅大</span></td>\n              <td bordercolor=\"cccccc\" align=\"left\" bgcolor=\"#FFFFFF\"><input onclick=\"select_array(\$(this));\" value=\"01,02,07,08,12,13,18,19,23,24\" type=\"checkbox\" />\n                ";
echo "<s";
echo "pan class=\"Font_R\">紅小</span></td>\n              <td bordercolor=\"cccccc\" align=\"left\" bgcolor=\"#FFFFFF\"><input onclick=\"select_array(\$(this));\" value=\"03,09,15,25,31,37,41,47\" type=\"checkbox\" />\n                ";
echo "<s";
echo "pan class=\"STYLE2\">藍單</span></td>\n              <td bordercolor=\"cccccc\" align=\"left\" bgcolor=\"#FFFFFF\"><input onclick=\"select_array(\$(this));\" value=\"04,10,14,20,26,36,42,48\" type=\"checkbox\" />\n                ";
echo "<s";
echo "pan class=\"STYLE2\">藍雙</span></td>\n              <td bordercolor=\"cccccc\" align=\"left\" bgcolor=\"#FFFFFF\"><input onclick=\"select_array(\$(this));\" value=\"25,26,31,36,37,41,42,47,48\" type=\"checkbox\" />\n                ";
echo "<s";
echo "pan class=\"STYLE2\">藍大</span></td>\n              <td bordercolor=\"cccccc\" align=\"left\" bgcolor=\"#FFFFFF\"><input onclick=\"select_array(\$(this));\" value=\"03,04,09,10,14,15,20\" type=\"checkbox\" />\n                ";
echo "<s";
echo "pan class=\"STYLE2\">藍小</span></td>\n              <td bordercolor=\"cccccc\" align=\"left\" bgcolor=\"#FFFFFF\"><input onclick=\"select_array(\$(this));\" value=\"05,11,17,21,27,33,39,43,49,49\" type=\"checkbox\" />\n                ";
echo "<s";
echo "pan class=\"STYLE8\">綠單</span></td>\n              <td bordercolor=\"cccccc\" align=\"left\" bgcolor=\"#FFFFFF\"><input onclick=\"select_array(\$(this));\" value=\"06,16,22,28,32,38,44\" type=\"checkbox\" />\n                ";
echo "<s";
echo "pan class=\"STYLE8\">綠雙</span></td>\n              <td bordercolor=\"cccccc\" align=\"left\" bgcolor=\"#FFFFFF\"><input onclick=\"select_array(\$(this));\" value=\"27,28,32,33,38,39,43,44,49,49\" type=\"checkbox\" />\n                ";
echo "<s";
echo "pan class=\"STYLE8\">綠大</span></td>\n              <td bordercolor=\"cccccc\" align=\"left\" bgcolor=\"#FFFFFF\"><input onclick=\"select_array(\$(this));\" value=\"05,06,11,16,17,21,22\" type=\"checkbox\" />\n                ";
echo "<s";
echo "pan class=\"STYLE8\">綠小</span></td>\n              <td bordercolor=\"cccccc\" align=\"left\" bgcolor=\"#FFFFFF\"><input onclick=\"select_array(\$(this));\" value=\"01,07,13,19,23,29,35,45,02,08,12,18,24,30,34,40,46\" type=\"checkbox\" />\n                ";
echo "<s";
echo "pan class=\"Font_R\">";
echo "<s";
echo "trong>紅波</strong></span></td>\n              <td bordercolor=\"cccccc\" align=\"left\" bgcolor=\"#FFFFFF\"><input onclick=\"select_array(\$(this));\" value=\"03,09,15,25,31,37,41,47,04,10,14,20,26,36,42,48\" type=\"checkbox\" />\n                ";
echo "<s";
echo "pan class=\"STYLE7\">藍波</span></td>\n              <td bordercolor=\"cccccc\" align=\"left\" bgcolor=\"#FFFFFF\"><input onclick=\"select_array(\$(this));\" value=\"05,11,17,21,27,33,39,43,49,06,16,22,28,32,38,44,49\" type=\"checkbox\" />\n                ";
echo "<s";
echo "pan class=\"STYLE5\">綠波</span></td>\n            </tr>\n            <tr align=\"center\">\n              <td bordercolor=\"cccccc\" align=\"left\" bgcolor=\"#FFFFFF\"><input onclick=\"select_array(\$(this));\" value=\"01,03,05,07,09,11,13,15,17,19,21,23,25,27,29,31,33,35,37,39,41,43,45,47,49\" type=\"checkbox\" />\n                單號</td>\n              <td bordercolor=\"cccccc\" align=\"left\" bgcolor=\"#FFFFFF\"><input onclick=";
echo "\"select_array(\$(this));\" value=\"02,04,06,08,10,12,14,16,18,20,22,24,26,28,30,32,34,36,38,40,42,44,46,48\" type=\"checkbox\" />\n                雙號</td>\n              <td bordercolor=\"cccccc\" align=\"left\" bgcolor=\"#FFFFFF\"><input onclick=\"select_array(\$(this));\" value=\"25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49\" type=\"checkbox\" />\n                大號</td>\n              <td";
echo " bordercolor=\"cccccc\" align=\"left\" bgcolor=\"#FFFFFF\"><input onclick=\"select_array(\$(this));\" value=\"01,02,03,04,05,06,07,08,09,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24\" type=\"checkbox\" />\n                小號</td>\n              <td bordercolor=\"cccccc\" align=\"left\" bgcolor=\"#FFFFFF\"><input onclick=\"select_array(\$(this));\" value=\"01,03,05,07,09,10,12,14,16,18,21,23,25,27,29,30,32,34,36,38,41,43,45,";
echo "47,49\" type=\"checkbox\" />\n                合單</td>\n              <td bordercolor=\"cccccc\" align=\"left\" bgcolor=\"#FFFFFF\"><input onclick=\"select_array(\$(this));\" value=\"02,04,06,08,11,13,15,17,19,20,22,24,26,28,31,33,35,37,39,40,42,44,46,48\" type=\"checkbox\" />\n                合雙</td>\n              <td bordercolor=\"cccccc\" align=\"left\" bgcolor=\"#FFFFFF\"><input onclick=\"select_array(\$(this));\" value=\"01";
echo ",03,05,07,09,11,13,15,17,19,21,23\" type=\"checkbox\" />\n                小單</td>\n              <td bordercolor=\"cccccc\" align=\"left\" bgcolor=\"#FFFFFF\"><input onclick=\"select_array(\$(this));\" value=\"25,27,29,31,33,35,37,39,41,43,45,47,49\" type=\"checkbox\" />\n                大單</td>\n              <td bordercolor=\"cccccc\" align=\"left\" bgcolor=\"#FFFFFF\"><input onclick=\"select_array(\$(this));\" value=\"02,04,0";
echo "6,08,10,12,14,16,18,20,22,24\" type=\"checkbox\" />\n                小雙</td>\n              <td bordercolor=\"cccccc\" align=\"left\" bgcolor=\"#FFFFFF\"><input onclick=\"select_array(\$(this));\" value=\"26,28,30,32,34,36,38,40,42,44,46,48\" type=\"checkbox\" />\n                大雙</td>\n              <td bordercolor=\"cccccc\" align=\"left\" bgcolor=\"#FFFFFF\"><input onclick=\"select_array(\$(this));\" value=\"01,02,03,04,05,";
echo "06,07,08,09\" type=\"checkbox\" />\n                0頭</td>\n              <td bordercolor=\"cccccc\" align=\"left\" bgcolor=\"#FFFFFF\"><input onclick=\"select_array(\$(this));\" value=\"10,11,12,13,14,15,16,17,18,19\" type=\"checkbox\" />\n                1頭</td>\n              <td bordercolor=\"cccccc\" align=\"left\" bgcolor=\"#FFFFFF\"><input onclick=\"select_array(\$(this));\" value=\"20,21,22,23,24,25,26,27,28,29\" type=\"che";
echo "ckbox\" />\n                2頭</td>\n              <td bordercolor=\"cccccc\" align=\"left\" bgcolor=\"#FFFFFF\"><input onclick=\"select_array(\$(this));\" value=\"30,31,32,33,34,35,36,37,38,39\" type=\"checkbox\" />\n                3頭</td>\n              <td bordercolor=\"cccccc\" align=\"left\" bgcolor=\"#FFFFFF\"><input onclick=\"select_array(\$(this));\" value=\"40,41,42,43,44,45,46,47,48,49\" type=\"checkbox\" />\n            ";
echo "    4頭</td>\n            </tr>\n            <tr align=\"center\">\n              <td bordercolor=\"cccccc\" align=\"left\" bgcolor=\"#FFFFFF\"><input onclick=\"select_array(\$(this));\" value=\"10,20,30,40\" type=\"checkbox\" />\n                0尾</td>\n              <td bordercolor=\"cccccc\" align=\"left\" bgcolor=\"#FFFFFF\"><input onclick=\"select_array(\$(this));\" value=\"01,11,21,31,41\" type=\"checkbox\" />\n                1尾";
echo "</td>\n              <td bordercolor=\"cccccc\" align=\"left\" bgcolor=\"#FFFFFF\"><input onclick=\"select_array(\$(this));\" value=\"02,12,22,32,42\" type=\"checkbox\" />\n                2尾</td>\n              <td bordercolor=\"cccccc\" align=\"left\" bgcolor=\"#FFFFFF\"><input onclick=\"select_array(\$(this));\" value=\"03,13,23,33,43\" type=\"checkbox\" />\n                3尾</td>\n              <td bordercolor=\"cccccc\" align=\"le";
echo "ft\" bgcolor=\"#FFFFFF\"><input onclick=\"select_array(\$(this));\" value=\"04,14,24,34,44\" type=\"checkbox\" />\n                4尾</td>\n              <td bordercolor=\"cccccc\" align=\"left\" bgcolor=\"#FFFFFF\"><input onclick=\"select_array(\$(this));\" value=\"05,15,25,35,45\" type=\"checkbox\" />\n                5尾</td>\n              <td bordercolor=\"cccccc\" align=\"left\" bgcolor=\"#FFFFFF\"><input onclick=\"select_array(\$(";
echo "this));\" value=\"06,16,26,36,46\" type=\"checkbox\" />\n                6尾</td>\n              <td bordercolor=\"cccccc\" align=\"left\" bgcolor=\"#FFFFFF\"><input onclick=\"select_array(\$(this));\" value=\"07,17,27,37,47\" type=\"checkbox\" />\n                7尾</td>\n              <td bordercolor=\"cccccc\" align=\"left\" bgcolor=\"#FFFFFF\"><input onclick=\"select_array(\$(this));\" value=\"08,18,28,38,48\" type=\"checkbox\" />\n ";
echo "               8尾</td>\n              <td bordercolor=\"cccccc\" align=\"left\" bgcolor=\"#FFFFFF\"><input onclick=\"select_array(\$(this));\" value=\"09,19,29,39,49\" type=\"checkbox\" />\n                9尾</td>\n              <td bordercolor=\"cccccc\" align=\"left\" bgcolor=\"#FFFFFF\">&nbsp;</td>\n              <td colspan=\"4\" bordercolor=\"cccccc\" align=\"left\" bgcolor=\"#FFFFFF\">\n                  <form id=\"f1\" action=\"se";
echo "t_rate.php\" method=\"post\">\n                  <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\n                  <tbody>\n                    <tr>\n                      <td>減</td>\n                      <td><input class=\"jj\" name=\"mv\" value=\"1\" checked=\"checked\" type=\"radio\"></td>\n                      <td><input id=\"jjh\" name=\"money\" class=\"input1 rate_color\" value=\"0.5\" size=\"4\"></td>\n                     ";
echo " <td><input class=\"jj\" name=\"mv\" value=\"2\" type=\"radio\"></td>\n                      <td>加</td>\n                      <td>&nbsp;\n                          \n                              <input type=\"hidden\" value=\"\" name=\"t3str\" id=\"ocontent\" />\n                              <input type=\"hidden\" value=\"";
echo $oid;
echo "\" name=\"o_type\" id=\"o_type\" />\n                              <input type=\"hidden\" value=\"";
echo $plate_num;
echo "\" name=\"pl_num\" id=\"o_ype\" />\n                                <input onclick=\"return go_select()\" name=\"button2\"  class=\"button_a\" value=\"送出\" type=\"submit\">\n                        \n                      </td>\n                      <td>&nbsp;\n                        <input class=\"button_a\" value=\"取消\" name=\"reset\" onClick=\"unset_select();\" type=\"reset\"></td>\n                    </tr>\n                ";
echo "  </tbody>\n                </table>\n              </form>\n              </td>\n            </tr>\n          </tbody>\n        </table>\n       <form id=\"f2\" action=\"set_rate_by_all.php\" method=\"post\">\n    <input type=\"hidden\" value=\"";
echo $oid;
echo "\" name=\"oid\" id=\"oid\" />\n        <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"99%\">  \n          <tbody>\n            <tr>\n              <td align=\"center\" height=\"25\">";
echo "<s";
echo "pan class=\"STYLE1\">統一修改：</span>\n                <input name=\"dx\" value=\"1\" type=\"radio\">\n                单\n                <input name=\"dx\" value=\"2\" type=\"radio\">\n                双\n                <input name=\"dx\" value=\"3\" type=\"radio\">\n                大\n                <input name=\"dx\" value=\"4\" type=\"radio\">\n                小\n                <input name=\"dx\" value=\"5\" type=\"radio\">\n        ";
echo "        紅波\n                <input name=\"dx\" value=\"6\" type=\"radio\">\n                綠波\n                <input name=\"dx\" value=\"7\" type=\"radio\">\n                藍波\n                <input name=\"dx\" value=\"8\" checked=\"checked\" type=\"radio\">\n                全部 ";
echo "<s";
echo "pan class=\"STYLE1\">賠率</span>\n                <input name=\"bl\" class=\"input1 rate_color\" id=\"bl\" style=\"height: 18px;\" value=\"0\" size=\"6\">\n                &nbsp;\n                <input onclick=\"return chk_bl(\$('#bl').val())\" class=\"button_a\" name=\"Submit22\" value=\"統一修改\" type=\"submit\"></td>\n            </tr>\n          </tbody>\n        </table>\n</form>                       \n                           ";
echo "   </td>\n                        <td valign=\"top\" width=\"220\">\n                            ";
include_once( "right.php" );
echo "                        </td>\n                      </tr>\n                    </tbody>\n                  </table>\n                </div>\n                <!-- 結束  --></td>\n              <td background=\"../images/tab_15.gif\" width=\"8\">&nbsp;</td>\n            </tr>\n          </tbody>\n        </table></td>\n    </tr>\n    <tr>\n      <td background=\"../images/tab_19.gif\" height=\"35\"><table border=\"0\" cellpadding=\"0\" ce";
echo "llspacing=\"0\" width=\"100%\">\n          <tbody>\n            <tr>\n              <td height=\"35\" width=\"12\"><img src=\"../images/tab_18.gif\" height=\"35\" width=\"12\"></td>\n              <td valign=\"top\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" height=\"30\" width=\"100%\">\n                  <tbody>\n                    <tr>\n                      <td align=\"center\">&nbsp;</td>\n                    </tr>\n          ";
echo "        </tbody>\n                </table></td>\n              <td width=\"16\"><img src=\"../images/tab_20.gif\" height=\"35\" width=\"16\"></td>\n            </tr>\n          </tbody>\n        </table></td>\n    </tr>\n  </tbody>\n</table>\n<div id=\"ly\" style=\"position: absolute; top: 0px; filter: alpha(opacity=70); background-color: #ffffff;\nz-index: 2; left: 0px; display: none;\"> \n  <!--[if lte IE 6.5]><iframe></iframe><![endif";
echo "]--> \n</div>\n<!--          浮層框架開始         -->\n<div id=\"rs_window\" style=\"position: absolute; top: 0px; \nz-index: 2000; left: 0px; display: none;\"> </div>\n</body>\n</html>";
?>
