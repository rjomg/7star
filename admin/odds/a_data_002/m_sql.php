<?php
include_once( "../../../global.php" );
include_once( "rate.class.php" );
$db = new rate0( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
$rate = array( );
$x = array( "鼠", "牛", "虎", "兔", "龙", "蛇", "马", "羊", "猴", "鸡", "狗", "猪" );
$rate[0] = $db->get_rate( 51 );
$rate[1] = $db->get_rate( 52 );
$rate[2] = $db->get_rate( 53 );
$rate[3] = $db->get_rate( 54 );
$rate[4] = $db->get_rate( 55 );
$rate[5] = $db->get_rate( 56 );
echo "<html oncontextmenu=\"return false\" xmlns=\"http://www.w3.org/1999/xhtml\">\n<head>\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=gbk\">\n</head>\n\n<body>\n\n<link href=\"../../images/Index.css\" rel=\"stylesheet\" type=\"text/css\">\n    ";
echo "<s";
echo "cript src=\"../../js/jquery-1.4.3.min.js?i=0\" type=\"text/javascript\"></script>\n";
echo "<s";
echo "cript src=\"js/sx_ws.js\" type=\"text/javascript\"></script>\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n  <tbody>\n    <tr>\n      <td background=\"../../images/tab_05.gif\" height=\"30\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n          <tbody>\n            <tr>\n              <td height=\"30\" width=\"12\"><img src=\"../../images/tab_03.gif\" height=\"30\" width=\"12\"></td>\n        ";
echo "      <td><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n                  <tbody>\n                    <tr>\n                      <td valign=\"middle\" width=\"87%\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n                          <tbody>\n                            <tr>\n                              <td width=\"1%\"><div align=\"center\"><img src=\"../../images/tb.gif\" heigh";
echo "t=\"16\" width=\"16\"></div></td>\n                              <td class=\"F_bold\" width=\"150\">";
echo "<s";
echo "pan id=\"ftm1\">生肖连</span>賠率設置";
echo "<s";
echo "pan style=\"DISPLAY:\">\n                                </span></td>\n                              <td class=\"F_bold\">&nbsp;</td>\n                              <td class=\"F_bold\">&nbsp;</td>\n                              <td class=\"F_bold\">&nbsp;</td>\n                            </tr>\n                          </tbody>\n                        </table></td>\n                    </tr>\n                  </tbody>\n    ";
echo "            </table></td>\n              <td width=\"16\"><img src=\"../../images/tab_07.gif\" height=\"30\" width=\"16\"></td>\n            </tr>\n          </tbody>\n        </table></td>\n    </tr>\n    <tr>\n      <td><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n          <tbody>\n            <tr>\n              <td background=\"../../images/tab_12.gif\" width=\"8\">&nbsp;</td>\n              <td align=\"center\" he";
echo "ight=\"50\"><!-- 開始  -->\n                <div id=\"result\">\n                  <table class=\"Ball_List Tab\" align=\"center\" bgcolor=\"ffffff\" border=\"0\" bordercolor=\"f1f1f1\" cellpadding=\"1\" cellspacing=\"1\" width=\"99%\">\n                    <form name=\"form1\" method=\"post\" action=\"?spul=XDNWCgBlAGACe1wiAiw!888&amp;save=CWEAZ1c5Uio!888&amp;x1=XJ0C2QfQBa0!888&amp;x2=XJ0O1QDXVf0!888\" target=\"downf\">\n          ";
echo "          </form>\n                    <tbody>\n                      <tr class=\"td_caption_1\">\n                        <td bordercolor=\"cccccc\" bgcolor=\"#DFEFFF\" nowrap=\"nowrap\" width=\"20\"><div align=\"center\"> NO </div></td>\n                        <td bordercolor=\"cccccc\" bgcolor=\"#DFEFFF\" nowrap=\"nowrap\"><div align=\"center\">二肖连[中]</div></td>\n<!--                        <td bordercolor=\"cccccc\" bgcolor=\"#D";
echo "FEFFF\" nowrap=\"nowrap\" width=\"44\">總額</td>-->\n                        <td bordercolor=\"cccccc\" bgcolor=\"#DFEFFF\" nowrap=\"nowrap\"><div align=\"center\">二肖连[不中]</div></td>\n<!--                        <td bordercolor=\"cccccc\" bgcolor=\"#DFEFFF\" nowrap=\"nowrap\" width=\"44\">總額</td>-->\n                        <td bordercolor=\"cccccc\" bgcolor=\"#DFEFFF\" nowrap=\"nowrap\"><div align=\"center\">三肖连[中]</div></td>\n<!-";
echo "-                        <td bordercolor=\"cccccc\" bgcolor=\"#DFEFFF\" nowrap=\"nowrap\" width=\"44\">總額</td>-->\n                        <td bordercolor=\"cccccc\" bgcolor=\"#DFEFFF\" nowrap=\"nowrap\"><div align=\"center\">三肖连[不中]</div></td>\n<!--                        <td bordercolor=\"cccccc\" bgcolor=\"#DFEFFF\" nowrap=\"nowrap\" width=\"44\">總額</td>-->\n                        <td bordercolor=\"cccccc\" bgcolor=\"#DFEFF";
echo "F\" nowrap=\"nowrap\"><div align=\"center\">四肖连[中]</div></td>\n<!--                        <td bordercolor=\"cccccc\" bgcolor=\"#DFEFFF\" nowrap=\"nowrap\" width=\"44\">總額</td>-->\n                        <td bordercolor=\"cccccc\" bgcolor=\"#DFEFFF\" nowrap=\"nowrap\"><div align=\"center\">四肖连[不中]</div></td>\n<!--                        <td bordercolor=\"cccccc\" bgcolor=\"#DFEFFF\" nowrap=\"nowrap\" width=\"44\">總額</td>-->\n   ";
echo "                   </tr>\n                   ";
foreach ( $x as $i => $k )
{
		echo "     \n                      <tr style=\"background-color: rgb(255, 255, 255);\" onmouseover=\"this.style.backgroundColor='#FFFFA2'\" onmouseout=\"this.style.backgroundColor='ffffff'\" bgcolor=\"#FFFFFF\">\n                     ";
		foreach ( $rate as $u => $v )
		{
				echo " \n                        ";
				if ( $u == 0 )
				{
						echo "                        <td bordercolor=\"cccccc\" class=\"ball_a\" align=\"center\" height=\"25\">";
						echo $v[$k][0] ? $v[$k][0] : $v[$i][0];
						echo "</td>\n                        ";
				}
				echo "                        <td align=\"center\" height=\"25\">\n                            <input type=\"hidden\" value=\"";
				echo $v[$k][0] ? $v[$k][0] : $v[$i][0];
				echo "\" class=\"name";
				echo $u + 51;
				echo "\" />\n                            <a style=\"\" onClick=\"UpdateRate(";
				echo $u + 51;
				echo ",1,\$(this).next('input'),0.1);\">";
				echo "<s";
				echo "pan style=\"vertical-align:middle;\"><img src=\"../../images/bvbv_01.gif\" border=\"0\" height=\"17\" width=\"19\"></span></a>\n                            <input onblur=\"UpdateRate(";
				echo $u + 51;
				echo ",1,\$(this),0);\" class=\"rate_set";
				echo $u + 51;
				echo " rate_color\" type=\"text\" style=\"width:63px;\"  value=\"";
				echo $v[$k][1] ? $v[$k][1] : $v[$i][1];
				echo "\" />\n                            <a style=\"\" onClick=\"UpdateRate(";
				echo $u + 51;
				echo ",2,\$(this).prev('input'),0.1);\">";
				echo "<s";
				echo "pan style=\"vertical-align:middle;\"><img src=\"../../images/bvbv_02.gif\" border=\"0\" height=\"17\" width=\"19\"></span></a>";
				echo "<s";
				echo "pan style=\"vertical-align:middle;\">\n                            <input onClick=\"UpdateRate(";
				echo $u + 51;
				echo ",3,\$(this),0);\" class=\"num_close";
				echo $u + 51;
				echo "\" name=\"checkbox\" ";
				echo ( $v[$k][0] ? $v[$k][2] : $v[$i][2] ) == 1 ? "checked=\"checked\"" : "";
				echo " style=\"\" title=\"關閉該項\"  value=\"TRUE\" type=\"checkbox\" />\n                        </span>\n                        </td>\n<!--                        <td align=\"center\" height=\"25\">";
				echo "<s";
				echo "pan id=\"gold";
				echo $i - 1;
				echo " ball\"><font class=\"odd_total";
				echo $u + 51;
				echo "\" color=\"ff6400\">";
				echo $v[$k][0] ? $v[$k][3] : $v[$i][3];
				echo "</font></span></td>-->\n                    ";
		}
		echo "                    </tr>\n                 ";
}
echo "  \n                       \n                    </tbody>\n                  </table>\n                    <form action=\"set_rate_by_sxws.php\" name=\"form21\" method=\"post\">\n                  <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n                    <tbody>\n                      <tr>\n                        <td align=\"center\" height=\"25\">";
echo "<s";
echo "pan class=\"STYLE1\">統一修改：</span>\n                          <input name=\"dx\" value=\"51\" type=\"radio\">\n                          二肖连[中]\n                          <input name=\"dx\" value=\"52\" type=\"radio\">\n                          二肖连[不中]\n                          <input name=\"dx\" value=\"53\" type=\"radio\">\n                          三肖连[中]\n                          <input name=\"dx\" value=\"5";
echo "4\" type=\"radio\">\n                          三肖连[不中]\n                          <input name=\"dx\" value=\"55\" type=\"radio\">\n                          四肖连[中]\n                          <input checked=\"checked\" name=\"dx\" value=\"56\" type=\"radio\">\n                          四肖连[不中]\n                          ";
echo "<s";
echo "pan class=\"STYLE1\" id=\"ebl1\">賠率</span>\n                          <input name=\"bl\" class=\"input1 rate_color\" id=\"bl\" style=\"height: 18px;\" value=\"0\" size=\"6\">\n                          &nbsp;\n                          <input onclick=\"return chk_bl(\$('#bl').val())\" class=\"button_a\" name=\"Submit22\" value=\"統一修改\" type=\"submit\"></td>\n                      </tr>\n                    </tbody>\n             ";
echo "     </table>\n                         </form>\n                </div>\n                <!-- 結束  --></td>\n              <td background=\"../../images/tab_15.gif\" width=\"8\">&nbsp;</td>\n            </tr>\n          </tbody>\n        </table></td>\n    </tr>\n    <tr>\n      <td background=\"../../images/tab_19.gif\" height=\"35\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n          <tbody>\n            <tr";
echo ">\n              <td height=\"35\" width=\"12\"><img src=\"../../images/tab_18.gif\" height=\"35\" width=\"12\"></td>\n              <td valign=\"top\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" height=\"30\" width=\"100%\">\n                  <tbody>\n                    <tr>\n                      <td align=\"center\">&nbsp;</td>\n                    </tr>\n                  </tbody>\n                </table></td>\n            ";
echo "  <td width=\"16\"><img src=\"../../images/tab_20.gif\" height=\"35\" width=\"16\"></td>\n            </tr>\n          </tbody>\n        </table></td>\n    </tr>\n  </tbody>\n</table>\n</body>\n</html>";
?>
