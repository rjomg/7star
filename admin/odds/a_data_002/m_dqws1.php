<?php
include_once( "../../../global.php" );
include_once( "rate.class.php" );
$db = new rate0( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
$rate = array( );
$x = array( "Êó", "Å£", "»¢", "ÍÃ", "Áú", "Éß", "Âí", "Ñò", "ºï", "¼¦", "¹·", "Öí" );
$rate[0] = $db->get_rate( 43 );
$rate[1] = $db->get_rate( 45 );
$rate[2] = $db->get_rate( 46 );
$rate[3] = $db->get_rate( 47 );
$rate[4] = $db->get_rate( 48 );
$rate[5] = $db->get_rate( 49 );
$rate[6] = $db->get_rate( 44 );
$rate[7] = $db->get_rate( 50 );
echo "<html oncontextmenu=\"return false\" xmlns=\"http://www.w3.org/1999/xhtml\">\n<head>\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">\n</head>\n\n<body>\n\n<link href=\"../../images/Index.css\" rel=\"stylesheet\" type=\"text/css\">\n    ";
echo "<s";
echo "cript src=\"../../js/jquery-1.4.3.min.js?i=0\" type=\"text/javascript\"></script>\n";
echo "<s";
echo "cript src=\"js/sx_ws.js?i=b\" type=\"text/javascript\"></script>\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n  <tbody>\n    <tr>\n      <td background=\"../../images/tab_05.gif\" height=\"30\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n          <tbody>\n            <tr>\n              <td height=\"30\" width=\"12\"><img src=\"../../images/tab_03.gif\" height=\"30\" width=\"12\"></td>\n    ";
echo "          <td><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n                  <tbody>\n                    <tr>\n                      <td valign=\"middle\" width=\"87%\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n                          <tbody>\n                            <tr>\n                              <td width=\"1%\"><div align=\"center\"><img src=\"../../images/tb.gif\" h";
echo "eight=\"16\" width=\"16\"></div></td>\n                              <td class=\"F_bold\" width=\"150\">";
echo "<s";
echo "pan id=\"ftm1\">ÌØÐ¤/Ò»Ð¤/Î²Êý</span>ÙrÂÊÔOÖÃ";
echo "<s";
echo "pan style=\"DISPLAY:\">\n                                <input name=\"x2\" id=\"x2\" value=\"DcwD2FCHVv4!888\" type=\"hidden\">\n                                <input name=\"ex2\" id=\"ex2\" value=\"ÌØÐ¤\" type=\"hidden\">\n                                </span></td>\n                              <td class=\"F_bold\">&nbsp;</td>\n                              <td class=\"F_bold\">&nbsp;</td>\n                              <td cla";
echo "ss=\"F_bold\">&nbsp;</td>\n                            </tr>\n                          </tbody>\n                        </table></td>\n                    </tr>\n                  </tbody>\n                </table></td>\n              <td width=\"16\"><img src=\"../../images/tab_07.gif\" height=\"30\" width=\"16\"></td>\n            </tr>\n          </tbody>\n        </table></td>\n    </tr>\n    <tr>\n      <td><table border=\"0\" cellpad";
echo "ding=\"0\" cellspacing=\"0\" width=\"100%\">\n          <tbody>\n            <tr>\n              <td background=\"../../images/tab_12.gif\" width=\"8\">&nbsp;</td>\n              <td align=\"center\" height=\"50\"><!-- é_Ê¼  -->\n                <div id=\"result\">\n                  <table class=\"Ball_List Tab\" align=\"center\" bgcolor=\"ffffff\" border=\"0\" bordercolor=\"f1f1f1\" cellpadding=\"1\" cellspacing=\"1\" width=\"99%\">\n       ";
echo "            <tbody>\n                      <tr class=\"td_caption_1\">\n                        <td bordercolor=\"cccccc\" bgcolor=\"#DFEFFF\" nowrap=\"nowrap\" width=\"20\"><div align=\"center\"> NO </div></td>\n                        <td bordercolor=\"cccccc\" bgcolor=\"#DFEFFF\" nowrap=\"nowrap\"><div align=\"center\">ÌØÐ¤</div></td>\n<!--                        <td bordercolor=\"cccccc\" bgcolor=\"#DFEFFF\" nowrap=\"nowrap\" width=\"3";
echo "6\">¿‚î~</td>-->\n                        <td bordercolor=\"cccccc\" bgcolor=\"#DFEFFF\" nowrap=\"nowrap\"><div align=\"center\">¶þÐ¤</div></td>\n<!--                        <td bordercolor=\"cccccc\" bgcolor=\"#DFEFFF\" nowrap=\"nowrap\" width=\"36\">¿‚î~</td>-->\n                        <td bordercolor=\"cccccc\" bgcolor=\"#DFEFFF\" nowrap=\"nowrap\"><div align=\"center\">ÈýÐ¤</div></td>\n<!--                        <td bordercolor=\"cccc";
echo "cc\" bgcolor=\"#DFEFFF\" nowrap=\"nowrap\" width=\"36\">¿‚î~</td>-->\n                        <td bordercolor=\"cccccc\" bgcolor=\"#DFEFFF\" nowrap=\"nowrap\"><div align=\"center\">ËÄÐ¤</div></td>\n<!--                        <td bordercolor=\"cccccc\" bgcolor=\"#DFEFFF\" nowrap=\"nowrap\" width=\"36\">¿‚î~</td>-->\n                        <td bordercolor=\"cccccc\" bgcolor=\"#DFEFFF\" nowrap=\"nowrap\"><div align=\"center\">ÎåÐ¤</div></td>\n<!";
echo "--                        <td bordercolor=\"cccccc\" bgcolor=\"#DFEFFF\" nowrap=\"nowrap\" width=\"36\">¿‚î~</td>-->\n                        <td bordercolor=\"cccccc\" bgcolor=\"#DFEFFF\" nowrap=\"nowrap\"><div align=\"center\">ÁùÐ¤</div></td>\n<!--                        <td bordercolor=\"cccccc\" bgcolor=\"#DFEFFF\" nowrap=\"nowrap\" width=\"36\">¿‚î~</td>-->\n                        <td bordercolor=\"cccccc\" bgcolor=\"#DFEFFF\" nowr";
echo "ap=\"nowrap\">Ò»Ð¤</td>\n<!--                        <td bordercolor=\"cccccc\" bgcolor=\"#DFEFFF\" nowrap=\"nowrap\" width=\"36\">¿‚î~</td>-->\n                        <td bordercolor=\"cccccc\" bgcolor=\"#DFEFFF\" nowrap=\"nowrap\" width=\"20\"><div align=\"center\"> NO </div></td>\n                        <td bordercolor=\"cccccc\" bgcolor=\"#DFEFFF\" nowrap=\"nowrap\">Î²Êý</td>\n<!--                        <td bordercolor=\"cccccc\" bgc";
echo "olor=\"#DFEFFF\" nowrap=\"nowrap\" width=\"36\">¿‚î~</td>-->\n                      </tr>\n                   ";
foreach ( $x as $i => $k )
{
		echo "     \n                      <tr style=\"background-color: rgb(255, 255, 255);\" onmouseover=\"this.style.backgroundColor='#FFFFA2'\" onmouseout=\"this.style.backgroundColor='ffffff'\" bgcolor=\"#FFFFFF\">\n                     ";
		foreach ( $rate as $u => $v )
		{
				if ( $v[$k][0] || $v[$i][1] )
				{
						echo " \n                        ";
						if ( $u == 0 || $u == 7 )
						{
								echo "                        <td bordercolor=\"cccccc\" class=\"ball_a\" align=\"center\" height=\"25\">";
								echo $v[$k][0] ? $v[$k][0] : $v[$i][0];
								echo "</td>\n                        ";
						}
						echo "                        <td align=\"center\" height=\"25\">\n                            <input type=\"hidden\" value=\"";
						echo $v[$k][0] ? $v[$k][0] : $v[$i][0];
						echo "\" class=\"name";
						echo $u + 43;
						echo "\" />\n                            <a style=\"\" onClick=\"UpdateRate(";
						echo $u + 43;
						echo ",1,\$(this).next('input'),0.1);\">";
						echo "<s";
						echo "pan style=\"vertical-align:middle;\"><img src=\"../../images/bvbv_01.gif\" border=\"0\" height=\"17\" width=\"19\"></span></a>\n                            <input onblur=\"UpdateRate(";
						echo $u + 43;
						echo ",1,\$(this),0);\" class=\"rate_set";
						echo $u + 43;
						echo " rate_color\" type=\"text\" style=\"width:63px;\"  value=\"";
						echo $v[$k][1] ? $v[$k][1] : $v[$i][1];
						echo "\" />\n                            <a style=\"\" onClick=\"UpdateRate(";
						echo $u + 43;
						echo ",2,\$(this).prev('input'),0.1);\">";
						echo "<s";
						echo "pan style=\"vertical-align:middle;\"><img src=\"../../images/bvbv_02.gif\" border=\"0\" height=\"17\" width=\"19\"></span></a>";
						echo "<s";
						echo "pan style=\"vertical-align:middle;\">\n                            <input onClick=\"UpdateRate(";
						echo $u + 43;
						echo ",3,\$(this),0);\" class=\"num_close";
						echo $u + 43;
						echo "\" name=\"checkbox\" ";
						echo ( $v[$k][0] ? $v[$k][2] : $v[$i][2] ) == 1 ? "checked=\"checked\"" : "";
						echo " style=\"\" title=\"êPé]Ô“í—\"  value=\"TRUE\" type=\"checkbox\" />\n                        </span>\n                        </td>\n<!--                        <td align=\"center\" height=\"25\">";
						echo "<s";
						echo "pan id=\"gold";
						echo $i - 1;
						echo " ball\"><font class=\"odd_total";
						echo $u + 43;
						echo "\" color=\"ff6400\">";
						echo $v[$k][0] ? $v[$k][3] : $v[$i][3];
						echo "</font></span></td>-->\n                    ";
				}
		}
		echo "                    </tr>\n                 ";
}
echo "  \n                       \n                    </tbody>\n                  </table>\n                    <form action=\"set_rate_by_sxws.php\" name=\"form21\" method=\"post\">\n                  <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n                    <tbody>\n                      <tr>\n                        <td align=\"center\" height=\"25\">";
echo "<s";
echo "pan class=\"STYLE1\">½yÒ»ÐÞ¸Ä£º</span>\n                          <input name=\"dx\" value=\"43\" type=\"radio\">\n                          ÌØÐ¤\n                          <input name=\"dx\" value=\"45\" type=\"radio\">\n                          ¶þÐ¤\n                          <input name=\"dx\" value=\"46\" type=\"radio\">\n                          ÈýÐ¤\n                          <input name=\"dx\" value=\"47\" type=\"radio\">\n   ";
echo "                       ËÄÐ¤\n                          <input name=\"dx\" value=\"48\" type=\"radio\">\n                          ÎåÐ¤\n                          <input name=\"dx\" value=\"49\" type=\"radio\">\n                          ÁùÐ¤\n                          <input name=\"dx\" value=\"44\" type=\"radio\">\n                          Ò»Ð¤\n                          <input name=\"dx\" value=\"50\" checked=\"checked\" type=\"r";
echo "adio\">\n                          Î²Êý ";
echo "<s";
echo "pan class=\"STYLE1\" id=\"ebl1\">ÙrÂÊ</span>\n                          <input name=\"bl\" class=\"input1 rate_color\" id=\"bl\" style=\"height: 18px;\" value=\"0\" size=\"6\">\n                          &nbsp;\n                          <input class=\"button_a\" name=\"Submit22\" value=\"½yÒ»ÐÞ¸Ä\" type=\"submit\"></td>\n                      </tr>\n                    </tbody>\n                  </table>\n                         </f";
echo "orm>\n                </div>\n                <!-- ½YÊø  --></td>\n              <td background=\"../../images/tab_15.gif\" width=\"8\">&nbsp;</td>\n            </tr>\n          </tbody>\n        </table></td>\n    </tr>\n    <tr>\n      <td background=\"../../images/tab_19.gif\" height=\"35\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n          <tbody>\n            <tr>\n              <td height=\"35\" width=\"12";
echo "\"><img src=\"../../images/tab_18.gif\" height=\"35\" width=\"12\"></td>\n              <td valign=\"top\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" height=\"30\" width=\"100%\">\n                  <tbody>\n                    <tr>\n                      <td align=\"center\">&nbsp;</td>\n                    </tr>\n                  </tbody>\n                </table></td>\n              <td width=\"16\"><img src=\"../../images/ta";
echo "b_20.gif\" height=\"35\" width=\"16\"></td>\n            </tr>\n          </tbody>\n        </table></td>\n    </tr>\n  </tbody>\n</table>\n</body>\n</html>";
?>
