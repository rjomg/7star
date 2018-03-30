<?php
include_once( "../../global.php" );
$db = new immediate( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
$db2 = new rate( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
$user_id = $_SESSION["uid".$c_p_seesion];
$user_power = $_SESSION["user_power".$c_p_seesion];
$plate_num = $_GET['plate_num'];
if ( !$plate_num )
{
		$plate_num = $db->get_plate( );
}
$t1 = $_GET['t1'];
if ( !$t1 )
{
		$t1 = "尾数连";
}
$t2 = $_GET['t2'];
if ( !$t2 )
{
		$t2 = "二尾连[中]";
}
$oid = $db->change_oid_or_oname( 0, $t2 );
$sing = $db->get_single_set( $user_id, $oid );
$all_plate = $db->get_all_plate_num( );
$tongji_all = $db->tongji_all( $user_id, $plate_num, $t1, $t2, $user_power, $kx );
pageft( $tongji_all[0], 15 );
if ( $firstcount < 0 )
{
		$firstcount = 0;
}
$imm = $db->get_imm_after_zm( $user_id, $plate_num, $t1, $t2, $user_power, $sing['zc_value'], $firstcount, $displaypg );
$t2s = array( "二尾连[中]", "二尾连[不中]", "三尾连[中]", "三尾连[不中]", "四尾连[中]", "四尾连[不中]" );
$tongji_zc = $db->tongji_zc( $user_id, $plate_num, $t1, $t2s, $user_power, $kx );
echo "<html oncontextmenu=\"return false\" xmlns=\"http://www.w3.org/1999/xhtml\"><head>\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=gbk\">\n</head>\n\n<body onselect=\"document.selection.empty()\" oncopy=\"document.selection.empty()\" onmouseover=\"self.status='歡迎光臨';return true\">\n<link href=\"../images/Index.css\" rel=\"stylesheet\" type=\"text/css\">\n    ";
echo "<s";
echo "cript src=\"../js/jquery-1.4.3.min.js?i=0\" type=\"text/javascript\"></script>\n";
echo "<s";
echo "cript src=\"js/normal.js?i=3\" type=\"text/javascript\"></script>\n";
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
echo "\";\n        }\n        var t1 = \$(\"#t1\");\n        var t2 = \$(\"#t2\");\n        var plate_num = \$(\"#plate_num\");\n        var url = 'wsl.php';\n        url += \"?t1=\"+t1.val()+\"&t2=\"+t2.val()+\"&plate_num=\"+plate_num.val()+\"&jishizhudanshuaxinshijian=\"+v;\n\n        window.open(url,'_self');\n    }\n</SCRIPT>\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n  <tbody>\n    <tr>\n      <td background=\"..";
echo "/images/tab_05.gif\" height=\"30\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n        <tbody>\n          <tr>\n            <td height=\"30\" width=\"12\"><img src=\"../images/tab_03.gif\" height=\"30\" width=\"12\"></td>\n            <td><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n              <tbody>\n                <tr>\n                  <td valign=\"middle\" width=\"87%\">\n          ";
echo "            \n                      \n                          <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n                          <tbody>\n                            <tr>\n                              <td width=\"16\"><div align=\"center\"><img src=\"../images/tb.gif\" height=\"16\" width=\"16\"></div></td>\n                              <td class=\"F_bold\" width=\"151\">";
echo "<s";
echo "pan id=\"ftm1\">";
echo $t2;
echo "</span>即時註单</td>\n                              <td class=\"F_bold\" align=\"right\" nowrap=\"nowrap\">\n                              <input id=\"t1\" type=\"hidden\" value=\"";
echo $t1;
echo "\" />\n                              <input id=\"t2\" type=\"hidden\" value=\"";
echo $t2;
echo "\" /> \n                              <input id=\"plate_num\" type=\"hidden\" value=\"";
echo $plate_num;
echo "\" />   \n                                ";
echo "<s";
echo "pan id=\"a6\" style=\"DISPLAY:none \">統計:\n                                ";
echo "<s";
echo "elect name=\"ztm1\">\n                                  <option value=\"0\">號码</option>\n                                  <option value=\"1\" selected=\"selected\">全部</option>\n                                </select>\n                                </span> 期数：\n                                ";
echo "<s";
echo "elect class=\"zaselect_ste\" name=\"kithe\" onchange=\"change_plate('wsl.php','";
echo $t1;
echo "','";
echo $t2;
echo "',\$(this).val())\">\n                                  ";
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
echo "                                </select></td>\n                              <td class=\"F_bold\" width=\"839\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\n                                  <tbody>\n                                    <tr>\n                                      <td> 設置--&gt;&nbsp;占成:\n                                        <input name=\"c1\" class=\"input3\" id=\"c1\" value=\"";
echo $sing['zc_value'];
echo "\" size=\"15\" type=\"text\">\n                                        &nbsp;走飛默認退水:\n                                        <input name=\"c2\" class=\"input2\" id=\"c2\" value=\"";
echo $sing['zfts_value'];
echo "\" size=\"10\" type=\"text\"></td>\n                                      <td id=\"cc8899\">&nbsp;警值:\n                                        <input name=\"c3\" class=\"input3\" id=\"c3\" value=\"";
echo $sing['j_value'];
echo "\" size=\"10\" type=\"text\">\n                                       </td>\n                                      <td>&nbsp;\n                                        <input onclick=\"go_single_set2(";
echo "'wsl.php',".$user_id.",".$oid.",'".$plate_num."','".$t1."','".$t2."'";
echo ",\$('#c1').val(),\$('#c2').val(),\$('#c3').val())\" class=\"button_a\" id=\"Submit\" value=\"設置\" type=\"button\"></td>\n                                    </tr>\n                                  </tbody>\n                                </table></td>\n                              <td class=\"F_bold\" width=\"12\">&nbsp;</td>\n                              <td width=\"179\" align=\"right\"><input name=\"wsl\" type=\"hidden\" id=\"";
echo "wsl\" value=\"0\">\n                                ";
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
echo ">120 </option>\n                                </select>\n                               </td>\n                            </tr>\n                          </tbody>\n                        </table>\n                  </td>\n                  </tr>\n              </tbody>\n            </table></td>\n            <td width=\"16\"><img src=\"../images/tab_07.gif\" height=\"30\" width=\"16\"></td>\n          </tr>\n        </tbody>\n";
echo "      </table></td>\n    </tr>\n    <tr>\n      <td><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n        <tbody>\n          <tr>\n            <td background=\"../images/tab_12.gif\" width=\"8\">&nbsp;</td>\n            <td align=\"center\" height=\"50\"><!-- 開始  --><div id=\"result\">\n\n\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=gbk\">\n\n\t\t\t<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" wi";
echo "dth=\"100%\">\n  <tbody><tr>\n    <td valign=\"top\"><input name=\"ffc1\" id=\"ffc1\" value=\"0\" type=\"hidden\">\n            <input name=\"ffc2\" id=\"ffc2\" value=\"0\" type=\"hidden\">\n\t\t\t<input name=\"ffc3\" id=\"ffc3\" value=\"0\" type=\"hidden\">\n\t\t\t\n\t\t\t\n\t\t\t\n\t\t\t<table id=\"tb\" class=\"Ball_List Tab\" align=\"center\" border=\"0\" bordercolor=\"f1f1f1\" cellpadding=\"1\" cellspacing=\"1\" width=\"99%\">\n                \t\t\t\t\t<tbody><tr>\n        ";
echo "              <td colspan=\"9\" bordercolor=\"cccccc\" align=\"center\" background=\"../images/tab_19.gif\" bgcolor=\"#F5FBFF\" height=\"28\" nowrap=\"NOWRAP\">\n\t\t\t\t\t  \t\t\t\t\t\t\n\t\t\t\t\t\t\n\t\t\t\t\t\t\n\t\t\t\t\t\t\n\t\t\t\t\t\t\t\t\t\t\t\t\n\t\t\t\t\t\t\n\t\t\t\t\t\t\n\t\t\t\t\t\t\t\t\t  \t\n\t\t\t\n\n\n <button id=\"rtm1\" ";
echo $t2 == "二尾连[中]" ? "class=\"button_a1\"" : "class=\"button_a\"";
echo " onclick=\"window.location.href='wsl.php?t2=二尾连[中]&plate_num=";
echo $plate_num;
echo "'\">二尾连[中][";
echo $tongji_zc['二尾连[中]'] + 0;
echo "]</button>&nbsp;\n <button id=\"rtm1\" ";
echo $t2 == "二尾连[不中]" ? "class=\"button_a1\"" : "class=\"button_a\"";
echo " onclick=\"window.location.href='wsl.php?t2=二尾连[不中]&plate_num=";
echo $plate_num;
echo "'\">二尾连[不中][";
echo $tongji_zc['二尾连[不中]'] + 0;
echo "]</button>&nbsp;\n <button id=\"rtm1\" ";
echo $t2 == "三尾连[中]" ? "class=\"button_a1\"" : "class=\"button_a\"";
echo " onclick=\"window.location.href='wsl.php?t2=三尾连[中]&plate_num=";
echo $plate_num;
echo "'\">三尾连[中][";
echo $tongji_zc['三尾连[中]'] + 0;
echo "]</button>&nbsp;\n <button id=\"rtm1\" ";
echo $t2 == "三尾连[不中]" ? "class=\"button_a1\"" : "class=\"button_a\"";
echo " onclick=\"window.location.href='wsl.php?t2=三尾连[不中]&plate_num=";
echo $plate_num;
echo "'\">三尾连[不中][";
echo $tongji_zc['三尾连[不中]'] + 0;
echo "]</button>&nbsp;\n <button id=\"rtm1\" ";
echo $t2 == "四尾连[中]" ? "class=\"button_a1\"" : "class=\"button_a\"";
echo " onclick=\"window.location.href='wsl.php?t2=四尾连[中]&plate_num=";
echo $plate_num;
echo "'\">四尾连[中][";
echo $tongji_zc['四尾连[中]'] + 0;
echo "]</button>&nbsp;\n <button id=\"rtm1\" ";
echo $t2 == "四尾连[不中]" ? "class=\"button_a1\"" : "class=\"button_a\"";
echo " onclick=\"window.location.href='wsl.php?t2=四尾连[不中]&plate_num=";
echo $plate_num;
echo "'\">四尾连[不中][";
echo $tongji_zc['四尾连[不中]'] + 0;
echo "]</button>&nbsp;\n\t\t\t\t\t  </td>\n                    </tr>\n\t\t\t\t\t                    <tr class=\"td_caption_1\">\n                      <td bordercolor=\"cccccc\" align=\"center\" bgcolor=\"#DFEFFF\" height=\"28\" nowrap=\"NOWRAP\" width=\"31\">排序</td>\n                      <td bordercolor=\"cccccc\" align=\"center\" bgcolor=\"#DFEFFF\" nowrap=\"nowrap\" width=\"165\">號码</td>\n\t\t\t\t\t                        <td bordercolor=\"cccccc\" a";
echo "lign=\"center\" bgcolor=\"#DFEFFF\" nowrap=\"nowrap\">總額</td>\n                      <td bordercolor=\"cccccc\" align=\"center\" bgcolor=\"#DFEFFF\" nowrap=\"nowrap\">占成</td>\n                      <td bordercolor=\"cccccc\" align=\"center\" bgcolor=\"#DFEFFF\" nowrap=\"nowrap\">預計盈利</td>\n                      <td bordercolor=\"cccccc\" align=\"center\" bgcolor=\"#DFEFFF\" nowrap=\"nowrap\" width=\"131\">走飛</td>\n               ";
echo "       <td bordercolor=\"cccccc\" align=\"center\" bgcolor=\"#DFEFFF\" nowrap=\"nowrap\" width=\"131\">已飛</td>\n                      <td bordercolor=\"cccccc\" align=\"center\" bgcolor=\"#DFEFFF\" nowrap=\"nowrap\" width=\"135\">賠率</td>\n                    </tr>\n\t\t\t";
$total = 0;
$zc = 0;
$yf = 0;
$zf = 0;
$yl = 0;
if ( $imm )
{
		$j = 0;
		foreach ( $imm as $i => $v )
		{
				++$j;
				echo "                        ";
				$rate = $db2->back_fg_order_p( $user_id, $user_power, $oid, $i );
				echo "                                    \n                    <tr style=\"background-color: rgb(255, 255, 255);\" onmouseover=\"this.style.backgroundColor='#FFFFA2'\" onmouseout=\"this.style.backgroundColor='ffffff'\" bgcolor=\"#FFFFFF\">\n                      <td bordercolor=\"cccccc\" align=\"center\" height=\"28\" nowrap=\"NOWRAP\">";
				echo $j;
				echo "</td>\n                      <td bordercolor=\"cccccc\" align=\"center\" nowrap=\"nowrap\">";
				echo $i;
				echo "</td>\n                      <td bordercolor=\"cccccc\" align=\"center\" nowrap=\"nowrap\"><a href=\"zg&zc.php?t2=";
				echo $t2."&t3=".$i."&plate_num=".$plate_num;
				echo "\">";
				echo $v['total'];
				echo "</a></td>\n                      <td bordercolor=\"cccccc\" align=\"center\" nowrap=\"nowrap\">";
				echo $v['zc'];
				echo "</td>\n                      <td bordercolor=\"cccccc\" align=\"center\" nowrap=\"nowrap\">";
				echo $v['yl']+$tongji_all[2];
				echo "</td>\n                      <td bordercolor=\"cccccc\" align=\"center\" nowrap=\"nowrap\">\n                         ";
				if ( $v['zf'] != 0 )
				{
						echo "                            <a  href=\"dan_bu.php?type3=";
						echo $i."&urlname=wsl&rate=".$rate[1]."&ts=".$sing['zfts_value']."&je=".$v['zf']."&t1=".$t1."&t2=".$t2."&plate_num=".$plate_num;
						echo "\" >\n                            <font color=\"ff0000\">單補";
						echo $v['zf'];
						echo "</font>\n                            </a>\n                         ";
				}
				else
				{
						echo 0;
				}
				echo "                      </td>\n                      <td bordercolor=\"cccccc\" align=\"center\" nowrap=\"nowrap\">\n                          <a href=\"yi_fei.php?t2=";
				echo $t2."&t3=".$i;
				echo "\" target=\"content\">";
				if ( !empty( $v['yf'] ) )
				{
						echo 0 - $v['yf'];
				}
				else
				{
						echo "0";
				}
				echo "</a>\n                      </td>\n                      <td bordercolor=\"cccccc\" align=\"center\" nowrap=\"nowrap\">";
				echo $rate[0];
				echo "</td>\n                    </tr>\n                    ";
				$total += $v['total'];
				$zc += $v['zc'];
				$yf += $v['yf'];
				$zf += $v['zf'];
				$yl += $v['yl'];
		}
}
echo "                    ";
if ( 15 < $tongji_all[0] )
{
		echo "                                        \n                    <tr style=\"background-color: rgb(255, 255, 255);\" onmouseover=\"this.style.backgroundColor='#FFFFA2'\" onmouseout=\"this.style.backgroundColor='ffffff'\" bgcolor=\"#FFFFFF\">\n                      <td bordercolor=\"cccccc\" align=\"center\" height=\"28\" nowrap=\"NOWRAP\">&nbsp;</td>\n                      <td bordercolor=\"cccccc\" align=\"center\" nowrap=\"no";
		echo "wrap\">当页</td>\n                      <td bordercolor=\"cccccc\" align=\"center\" nowrap=\"nowrap\">";
		echo $total;
		echo "</td>\n                      <td bordercolor=\"cccccc\" align=\"center\" nowrap=\"nowrap\">";
		echo $zc;
		echo "</td>\n                      <td bordercolor=\"cccccc\" align=\"center\" nowrap=\"nowrap\">";
		echo "</td>\n                      <td bordercolor=\"cccccc\" align=\"center\" nowrap=\"nowrap\">";
		echo "</td>\n                      <td bordercolor=\"cccccc\" align=\"center\" nowrap=\"nowrap\">";
		echo 0 - $yf;
		echo "</td>\n                      <td bordercolor=\"cccccc\" align=\"center\" nowrap=\"nowrap\"></td>\n                    </tr>\n                    ";
}
echo "                                        \n                    <tr style=\"background-color: rgb(255, 255, 255);\" onmouseover=\"this.style.backgroundColor='#FFFFA2'\" onmouseout=\"this.style.backgroundColor='ffffff'\" bgcolor=\"#FFFFFF\">\n                      <td bordercolor=\"cccccc\" align=\"center\" height=\"28\" nowrap=\"NOWRAP\">&nbsp;</td>\n                      <td bordercolor=\"cccccc\" align=\"center\" nowrap=\"no";
echo "wrap\">總計</td>\n                      <td bordercolor=\"cccccc\" align=\"center\" nowrap=\"nowrap\"><b>";
echo $tongji_all[1];
echo "</b></td>\n                      <td bordercolor=\"cccccc\" align=\"center\" nowrap=\"nowrap\"><b>";
echo $tongji_all[2];
echo "</b></td>\n                      <td bordercolor=\"cccccc\" align=\"center\" nowrap=\"nowrap\">";
echo "</td>\n                      <td bordercolor=\"cccccc\" align=\"center\" nowrap=\"nowrap\">";
echo "</td>\n                      <td bordercolor=\"cccccc\" align=\"center\" nowrap=\"nowrap\"><b>";
echo 0 - $tongji_all[3];
echo "</b></td>\n                      <td bordercolor=\"cccccc\" align=\"center\" nowrap=\"nowrap\"></td>\n                    </tr>\n                                                            \n                    <tr style=\"background-color: rgb(255, 255, 255);\" onmouseover=\"this.style.backgroundColor='#FFFFA2'\" onmouseout=\"this.style.backgroundColor='ffffff'\" bgcolor=\"#FFFFFF\">\n                      <td bordercolor";
echo "=\"cccccc\" align=\"center\" nowrap=\"nowrap\" colspan=\"8\" height=\"28\">";
echo $pagenav;
echo "</td>\n                    </tr> \n                  </tbody></table></td>\n    <td valign=\"top\" width=\"220\">\n        ";
include_once( "right.php" );
echo "    </td>\n  </tr>\n</tbody></table>\n\n          \n            \n            </div>\n            <!-- 結束  --></td>\n            <td background=\"../images/tab_15.gif\" width=\"8\">&nbsp;</td>\n          </tr>\n        </tbody>\n      </table></td>\n    </tr>\n    <tr>\n      <td background=\"../images/tab_19.gif\" height=\"35\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n        <tbody>\n          <tr>\n            <t";
echo "d height=\"35\" width=\"12\"><img src=\"../images/tab_18.gif\" height=\"35\" width=\"12\"></td>\n            <td valign=\"top\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" height=\"30\" width=\"100%\">\n              <tbody>\n                <tr>\n                  <td align=\"center\">&nbsp;</td>\n                </tr>\n              </tbody>\n            </table></td>\n            <td width=\"16\"><img src=\"../images/tab_20.gif\" h";
echo "eight=\"35\" width=\"16\"></td>\n          </tr>\n        </tbody>\n      </table></td>\n    </tr>\n  </tbody>\n</table>\n<div id=\"ly\" style=\"position: absolute; top: 0px; filter: alpha(opacity=70); background-color: #ffffff;\nz-index: 2; left: 0px; display: none;\">\n <!--[if lte IE 6.5]><iframe></iframe><![endif]-->\n</div>\n<!--          浮層框架開始         -->\n<div id=\"rs_window\" style=\"position: absolute; top: 0px; \nz-inde";
echo "x: 2000; left: 0px; display: none;\">\n</div>\n\n\n</body></html>";
?>
