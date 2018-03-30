<?php
include_once( "../../global.php" );
if ( $_POST['pass'] )
{
		$db = new action( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
		$pass = md5( $_POST['pass'] );
		if ( $_SESSION["z_uid".$c_p_seesion] )
		{
				$user_id = $_SESSION["z_uid".$c_p_seesion];
		}
		else
		{
				$user_id = $_SESSION["uid".$c_p_seesion];
		}
		$db->update( "users", "user_pwd='{$pass}'", "user_id={$user_id}", "updatepass.php" );
}
echo "<html oncontextmenu=\"return false\" xmlns=\"http://www.w3.org/1999/xhtml\">\n    <head>\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">\n    </head>\n<body>\n<link href=\"../images/Index.css\" rel=\"stylesheet\" type=\"text/css\">\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n  <tbody>\n    <tr>\n      <td background=\"../images/tab_05.gif\" height=\"30\"><table border=\"0\" cellpadding=\"0\" ce";
echo "llspacing=\"0\" width=\"100%\">\n        <tbody>\n          <tr>\n            <td height=\"30\" width=\"12\"><img src=\"../images/tab_03.gif\" height=\"30\" width=\"12\"></td>\n            <td><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n              <tbody>\n                <tr>\n                  <td valign=\"middle\" width=\"87%\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n               ";
echo "     <tbody>\n                      <tr>\n                        <td width=\"1%\"><div align=\"center\"><img src=\"../images/tb.gif\" height=\"16\" width=\"16\"></div></td>\n\t\t\t\t\t\t<td>";
echo "<s";
echo "pan class=\"F_bold\">–ﬁ∏ƒ√‹¬Î</span></td>\n                        </tr>\n                    </tbody>\n                  </table></td>\n                  </tr>\n              </tbody>\n            </table></td>\n            <td width=\"16\"><img src=\"../images/tab_07.gif\" height=\"30\" width=\"16\"></td>\n          </tr>\n        </tbody>\n      </table></td>\n    </tr>\n    <tr>\n      <td><table border=\"0\" cellpadding=\"0\" cellspacing=\"";
echo "0\" width=\"100%\">\n        <tbody>\n          <tr>\n            <td background=\"../images/tab_12.gif\" width=\"8\">&nbsp;</td>\n            <td align=\"center\" height=\"50\"><!-- È_ º  -->\n                <form action=\"updatepass.php\" method=\"post\" name=\"form1\" id=\"form1\">\n              <table class=\"Ball_List Tab\" align=\"center\" border=\"0\" bordercolor=\"f1f1f1\" cellpadding=\"0\" cellspacing=\"1\" width=\"99%\">\n          ";
echo "      \n                  <tbody>\n                  <tr>\n                    <td bordercolor=\"cccccc\" align=\"right\" bgcolor=\"#DFEFFF\" height=\"30\">Ÿ~Ãñ£∫</td>\n                    <td bordercolor=\"cccccc\" bgcolor=\"#FFFFFF\">";
echo $_SESSION["username".$c_p_seesion];
echo "</td>\n                  </tr>\n                  <tr>\n                    <td bordercolor=\"cccccc\" align=\"right\" bgcolor=\"#DFEFFF\" height=\"30\">√‹¬Î£∫</td>\n                    <td bordercolor=\"cccccc\" bgcolor=\"#FFFFFF\"><input name=\"pass\" class=\"input1\" id=\"pass\" type=\"password\"></td>\n                  </tr>\n                  \n                  \n                  \n                  <tr>\n                    <td ";
echo "bordercolor=\"cccccc\" bgcolor=\"#DFEFFF\" height=\"30\" width=\"16%\">&nbsp;</td>\n                    <td bordercolor=\"cccccc\" bgcolor=\"#FFFFFF\" width=\"84%\">\n                        <input type=\"submit\" class=\"button_a\" style=\"width:80;height:22\" value=\"–ﬁ∏ƒ√‹¬Î\" />\n                    </td>\n                  </tr>\n                \n              </tbody>\n              </table>\n                </form>\n           ";
echo "   <!-- ΩY ¯  --></td>\n            <td background=\"../images/tab_15.gif\" width=\"8\">&nbsp;</td>\n          </tr>\n        </tbody></form>\n      </table></td>\n    </tr>\n    <tr>\n      <td background=\"../images/tab_19.gif\" height=\"35\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n        <tbody>\n          <tr>\n            <td height=\"35\" width=\"12\"><img src=\"../images/tab_18.gif\" height=\"35\" width=\"12";
echo "\"></td>\n            <td valign=\"top\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" height=\"30\" width=\"100%\">\n              <tbody>\n                <tr>\n                  <td align=\"center\">&nbsp;</td>\n                </tr>\n              </tbody>\n            </table></td>\n            <td width=\"16\"><img src=\"../images/tab_20.gif\" height=\"35\" width=\"16\"></td>\n          </tr>\n        </tbody>\n      </table></td>\n ";
echo "   </tr>\n  </tbody>\n</table>\n </body></html>";
?>
