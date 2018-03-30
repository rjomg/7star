<?php
include_once( "../../global.php" );
$db = new rate( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
$query = $db->select( "abcd_rate", "*", "1 order by ao asc" );
echo "<html oncontextmenu=\"return false\" xmlns=\"http://www.w3.org/1999/xhtml\">\n<head>\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">\n</head>\n\n<body>\n<link href=\"../images/Index.css\" rel=\"stylesheet\" type=\"text/css\">\n    ";
echo "<s";
echo "cript src=\"../js/jquery-1.4.3.min.js?i=0\" type=\"text/javascript\"></script>\n";
echo "<s";
echo "cript src=\"js/abcd.js\" type=\"text/javascript\"></script>\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n  <tbody>\n    <tr>\n      <td background=\"../images/tab_05.gif\" height=\"30\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n          <tbody>\n            <tr>\n              <td height=\"30\" width=\"12\"><img src=\"../images/tab_03.gif\" height=\"30\" width=\"12\"></td>\n              <t";
echo "d><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n                  <tbody>\n                    <tr>\n                      <td valign=\"middle\" width=\"87%\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n                          <tbody>\n                            <tr>\n                              <td width=\"1%\"><div align=\"center\"><img src=\"../images/tb.gif\" height=\"16\" wid";
echo "th=\"16\"></div></td>\n                              <td class=\"F_bold\" width=\"32%\">ABCD盤賠率差</td>\n                              <td class=\"F_bold\" width=\"33%\">&nbsp;</td>\n                              <td valign=\"middle\" width=\"34%\">&nbsp;</td>\n                            </tr>\n                          </tbody>\n                        </table></td>\n                    </tr>\n                  </tbody>\n        ";
echo "        </table></td>\n              <td width=\"16\"><img src=\"../images/tab_07.gif\" height=\"30\" width=\"16\"></td>\n            </tr>\n          </tbody>\n        </table></td>\n    </tr>\n    <tr>\n      <td><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n          <tbody>\n            <tr>\n              <td background=\"../images/tab_12.gif\" width=\"8\">&nbsp;</td>\n              <td align=\"center\" height=\"50\">";
echo "<!-- 開始  -->\n                <div id=\"result\">\n                    <form action=\"set_rate_abcd.php\" method=\"post\" name=\"form1\" id=\"form1\">\n                  <table class=\"Ball_List Tab\" align=\"center\" bgcolor=\"ffffff\" border=\"0\" bordercolor=\"f1f1f1\" cellpadding=\"1\" cellspacing=\"1\" width=\"99%\">\n                   <tbody>\n                      <tr class=\"td_caption_1\">\n                        <td borderc";
echo "olor=\"cccccc\" bgcolor=\"#DFEFFF\" width=\"10%\"><div align=\"center\">類型</div></td>\n                        <td bordercolor=\"cccccc\" align=\"center\" bgcolor=\"#DFEFFF\" width=\"10%\">B盤差</td>\n                        <td bordercolor=\"cccccc\" align=\"center\" bgcolor=\"#DFEFFF\" width=\"10%\">C盤差</td>\n                        <td bordercolor=\"cccccc\" align=\"center\" bgcolor=\"#DFEFFF\" width=\"10%\">D盤差</td>\n              ";
echo "          \n                        <td bordercolor=\"cccccc\" bgcolor=\"#DFEFFF\" width=\"10%\"><div align=\"center\">類型</div></td>\n                        <td bordercolor=\"cccccc\" align=\"center\" bgcolor=\"#DFEFFF\" width=\"10%\">B盤差</td>\n                        <td bordercolor=\"cccccc\" align=\"center\" bgcolor=\"#DFEFFF\" width=\"10%\">C盤差</td>\n                        <td bordercolor=\"cccccc\" align=\"center\" bgcolor=\"";
echo "#DFEFFF\" width=\"10%\">D盤差</td>\n                      </tr>\n";
$i = 0;
for ( ;	$i < 16;	++$i	)
{
		echo "                      <tr style=\"background-color: rgb(255, 255, 255);\" onmouseover=\"this.style.backgroundColor='#FFFFA2'\" onmouseout=\"this.style.backgroundColor='ffffff'\" bgcolor=\"#FFFFFF\">\n                        \n                          ";
		$j = 0;
		for ( ;	$j < 2;	++$j	)
		{
				echo "                          ";
				$row = $db->fetch_array( $query );
				echo " \n                          ";
				if ( is_array( $row ) )
				{
						echo "                         <td bordercolor=\"cccccc\" class=\"TDb_D\" height=\"25\"><div align=\"center\"> ";
						echo $row['o_typename'];
						echo "                            <input name=\"id[]\" value=\"";
						echo $row['id'];
						echo "\" type=\"hidden\">\n                          </div></td>\n                        <td bordercolor=\"cccccc\" align=\"center\"><input name=\"mb[]\" class=\"input_abcd\" value=\"";
						echo $row['ab_rate'];
						echo "\" size=\"10\"></td>\n                        <td bordercolor=\"cccccc\" align=\"center\"><input name=\"mc[]\" class=\"input_abcd\" value=\"";
						echo $row['ac_rate'];
						echo "\" size=\"10\"></td>\n                        <td bordercolor=\"cccccc\" align=\"center\"><input name=\"md[]\" class=\"input_abcd\" value=\"";
						echo $row['ad_rate'];
						echo "\" size=\"10\"></td>\n                        ";
				}
				else
				{
						echo "<td></td><td></td><td></td><td></td>";
				}
		}
		echo "                      </tr>\n";
}
echo "                      <tr>\n                        <td colspan=\"8\" bordercolor=\"cccccc\" align=\"center\" bgcolor=\"#FFFFFF\" height=\"25\"><input type=\"submit\" onclick=\"return abcd_submit()\" class=\"button_a\" style=\"width:80;height:22\" value=\"確認提交\" /></td>\n                      </tr>\n                    </tbody>\n                  </table>\n                    </form>\n                </div>\n                <!-- ";
echo "結束  --></td>\n              <td background=\"../images/tab_15.gif\" width=\"8\">&nbsp;</td>\n            </tr>\n          </tbody>\n        </table></td>\n    </tr>\n    <tr>\n      <td background=\"../images/tab_19.gif\" height=\"35\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n          <tbody>\n            <tr>\n              <td height=\"35\" width=\"12\"><img src=\"../images/tab_18.gif\" height=\"35\" width=\"1";
echo "2\"></td>\n              <td valign=\"top\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" height=\"30\" width=\"100%\">\n                  <tbody>\n                    <tr>\n                      <td align=\"center\">&nbsp;</td>\n                    </tr>\n                  </tbody>\n                </table></td>\n              <td width=\"16\"><img src=\"../images/tab_20.gif\" height=\"35\" width=\"16\"></td>\n            </tr>\n    ";
echo "      </tbody>\n        </table></td>\n    </tr>\n  </tbody>\n</table>\n</body>\n</html>";
?>
