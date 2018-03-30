<?php
include_once( "../../global.php" );
$db = new plate( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
$row = $system_setting;
echo "\n<html oncontextmenu=\"return false\" xmlns=\"http://www.w3.org/1999/xhtml\">\n<head>\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">\n</head>\n\n<body>\n<link href=\"../images/Index.css\" rel=\"stylesheet\" type=\"text/css\">\n<style>.Ball_List{background:#fff;}.TDb_D{background:#fff;}</style><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n  <tbody>\n </tbody>\n        </table></td>\n    </tr>\n    <tr>\n      <td><table border=\"0\" cellpadding=\"0\" cellspacing=\"0";
echo "\" width=\"100%\">\n          <tbody>\n            <tr>\n  <td align=\"center\" height=\"200\"><!-- 開始  --> \n                \n                <!-- 結束  -->\n<form id=\"f3\" method=\"post\" action=\"animal_set.php\" >\n                <table id=\"tb\" class=\"Ball_List Tab\" align=\"center\" border=\"0\" cellpadding=\"1\" cellspacing=\"1\" width=\"99";
echo "%\">\n                  <tbody>\n\n                    <tr class=\"td_caption_1\">\n                      <td colspan=\"4\" style=\"color:#fff;\" bordercolor=\"cccccc\" align=\"left\" bgcolor=\"#FFFFFF\" height=\"22\" nowrap=\"nowrap\">";
echo "<s";
echo "trong>系統設置</strong></td>\n                    </tr>\n                    <tr>\n                      <td bordercolor=\"cccccc\" class=\"TDb_D\" align=\"right\" height=\"25\" nowrap=\"nowrap\" width=\"120\">網站名稱：</td>\n                      <td bordercolor=\"cccccc\" align=\"left\" bgcolor=\"#FFFFFF\" height=\"22\"><input name=\"w_name\" class=\"input1\" id=\"nn2\" value=\"";
echo $row['w_name'];
echo "\" size=\"35\" type=\"text\"></td>\n                      <td bordercolor=\"cccccc\" class=\"TDb_D\" align=\"right\" width=\"120\">網站地址：http://</td>\n                      <td bordercolor=\"cccccc\" align=\"left\" bgcolor=\"#FFFFFF\"><input name=\"w_dress\" class=\"input1\" id=\"num\" value=\"";
echo $row['w_dress'];
echo "\" size=\"50\" type=\"text\"><font color=\"red\">結尾加‘/’</font></td>\n                    </tr>\n  ";
/*                   <tr>\n                      <td bordercolor=\"cccccc\" class=\"TDb_D\" align=\"right\" height=\"25\" nowrap=\"nowrap\">農歷生肖設置：</td>\n                      <td bordercolor=\"cccccc\" align=\"left\" bgcolor=\"#FFFFFF\" height=\"22\">請選擇與當前年份相應的生肖\n */
/*echo "<s";
echo "elect id=\"sanimal\" name=\"set_animal\">\n                          <option value=\"1\" ";
echo $row['set_animal'] == 1 ? "selected=\"selected\"" : "";
echo ">鼠</option>\n                          <option value=\"2\" ";
echo $row['set_animal'] == 2 ? "selected=\"selected\"" : "";
echo ">牛</option>\n                          <option value=\"3\" ";
echo $row['set_animal'] == 3 ? "selected=\"selected\"" : "";
echo ">虎</option>\n                          <option value=\"4\" ";
echo $row['set_animal'] == 4 ? "selected=\"selected\"" : "";
echo ">兔</option>\n                          <option value=\"5\" ";
echo $row['set_animal'] == 5 ? "selected=\"selected\" style=\"color:red\"" : "";
echo ">龙</option>\n                          <option value=\"6\" ";
echo $row['set_animal'] == 6 ? "selected=\"selected\"" : "";
echo ">蛇</option>\n                          <option value=\"7\" ";
echo $row['set_animal'] == 7 ? "selected=\"selected\"" : "";
echo ">马</option>\n                          <option value=\"8\" ";
echo $row['set_animal'] == 8 ? "selected=\"selected\"" : "";
echo ">羊</option>\n                          <option value=\"9\" ";
echo $row['set_animal'] == 9 ? "selected=\"selected\"" : "";
echo ">猴</option>\n                          <option value=\"10\" ";
echo $row['set_animal'] == 10 ? "selected=\"selected\"" : "";
echo ">鸡</option>\n                          <option value=\"11\" ";
echo $row['set_animal'] == 11 ? "selected=\"selected\"" : "";
echo ">狗</option>\n                          <option value=\"12\" ";
echo $row['set_animal'] == 12 ? "selected=\"selected\"" : "";*/
/*>猪</option>\n                        </select></td>\n                     */
echo " <td bordercolor=\"cccccc\" class=\"TDb_D\" align=\"right\">系統維護：</td>\n                      <td bordercolor=\"cccccc\" align=\"left\" bgcolor=\"#FFFFFF\">\n                          ";
echo "<s";
echo "elect name=\"w_is_lock\" id=\"syint\">\n                          <option ";
echo $row['w_is_lock'] == 1 ? "selected=\"selected\"" : "";
echo " value=\"1\">開啟</option>\n                          <option ";
echo $row['w_is_lock'] == 0 ? "selected=\"selected\"" : "";
echo " value=\"0\" style=\"color:red\">關閉</option>\n                        </select></td>\n                    </tr>\n                    <tr>\n                      <td bordercolor=\"cccccc\" class=\"TDb_D\" align=\"right\" height=\"25\" nowrap=\"nowrap\" width=\"120\">入口驗證碼：</td>\n                      <td  bordercolor=\"cccccc\" align=\"left\" bgcolor=\"#FFFFFF\" height=\"22\">\n                          管理員驗證碼<input name=\"";
echo "w_yanzheng1\" class=\"input1\" value=\"";
echo $row['w_yanzheng1'];
echo "\" size=\"10\" type=\"text\">&nbsp;&nbsp;&nbsp;\n                          代理驗證碼<input name=\"w_yanzheng2345\" class=\"input1\" value=\"";
echo $row['w_yanzheng2345'];
echo "\" size=\"10\" type=\"text\">&nbsp;&nbsp;&nbsp;\n                          會員驗證碼<input name=\"w_yanzheng6\" class=\"input1\"  value=\"";
echo $row['w_yanzheng6'];
echo "\" size=\"10\" type=\"text\">&nbsp;&nbsp;&nbsp;\n                              <font color=\"red\">留空即無限制</font>    \n                      </td>\n                      <td bordercolor=\"cccccc\" class=\"TDb_D\" align=\"right\">開獎後自動還原信用額度：</td>\n                      <td bordercolor=\"cccccc\" align=\"left\" bgcolor=\"#FFFFFF\">\n                          ";
echo "<s";
echo "elect name=\"w_is_creditline\" id=\"syint\">\n                          <option ";
echo $row['w_is_creditline'] == 1 ? "selected=\"selected\"" : "";
echo " value=\"1\">開啟</option>\n                          <option ";
echo $row['w_is_creditline'] == 0 ? "selected=\"selected\"" : "";
echo " value=\"0\" style=\"color:red\">關閉</option>\n                        </select></td>\n                    </tr>  \n                   <tr>\n                      <td bordercolor=\"cccccc\" class=\"TDb_D\" align=\"right\" height=\"25\" nowrap=\"nowrap\" width=\"120\">默認可開會員數：</td>\n                      <td colspan=\"3\" bordercolor=\"cccccc\" align=\"left\" bgcolor=\"#FFFFFF\" height=\"22\">\n                          分公司可";
echo "開會員數<input name=\"w_user_total2\" class=\"input1\" value=\"";
echo $row['w_user_total2'];
echo "\" size=\"10\" type=\"text\">&nbsp;&nbsp;&nbsp;\n                          股東可開會員數<input name=\"w_user_total3\" class=\"input1\" value=\"";
echo $row['w_user_total3'];
echo "\" size=\"10\" type=\"text\">&nbsp;&nbsp;&nbsp;\n                          總代理可開會員數<input name=\"w_user_total4\" class=\"input1\"  value=\"";
echo $row['w_user_total4'];
echo "\" size=\"10\" type=\"text\">&nbsp;&nbsp;&nbsp;\n                          代理可開會員數<input name=\"w_user_total5\" class=\"input1\"  value=\"";
echo $row['w_user_total5'];
echo "\" size=\"10\" type=\"text\">&nbsp;&nbsp;&nbsp;\n                      </td>\n                    </tr> ";
/*                      \n                    <tr>\n                    <td height=\"30\" bordercolor=\"cccccc\" bgcolor=\"#CAD3E9\" align=\"right\">关闭项目: </td>\n                    <td colspan=\"3\" bordercolor=\"cccccc\" bgcolor=\"#E7ECF9\"> ";
$w_close_type = explode( ",", $row['w_close_type'] );
echo "<!--                        特码:<input style=\"position:relative;top:2px\" type=\"checkbox\" name=\"w_close_type[]\" value=\"特码\" ";
if ( in_array( "特码", $w_close_type ) )
{
		echo "checked";
}
echo ">&nbsp;&nbsp;&nbsp;-->\n                        正码:<input style=\"position:relative;top:2px\" type=\"checkbox\" name=\"w_close_type[]\" value=\"正码\" ";
if ( in_array( "正码", $w_close_type ) )
{
		echo "checked";
}
echo ">&nbsp;&nbsp;&nbsp;\n                        正特:<input style=\"position:relative;top:2px\" type=\"checkbox\" name=\"w_close_type[]\" value=\"正特\" ";
if ( in_array( "正特", $w_close_type ) )
{
		echo "checked";
}
echo ">&nbsp;&nbsp;&nbsp; \n                        连码:<input style=\"position:relative;top:2px\" type=\"checkbox\" name=\"w_close_type[]\" value=\"连码\" ";
if ( in_array( "连码", $w_close_type ) )
{
		echo "checked";
}
echo ">&nbsp;&nbsp;&nbsp; \n                        不中:<input style=\"position:relative;top:2px\" type=\"checkbox\" name=\"w_close_type[]\" value=\"不中\" ";
if ( in_array( "不中", $w_close_type ) )
{
		echo "checked";
}
echo ">&nbsp;&nbsp;&nbsp;    \n                        特肖:<input style=\"position:relative;top:2px\" type=\"checkbox\" name=\"w_close_type[]\" value=\"特肖\" ";
if ( in_array( "特肖", $w_close_type ) )
{
		echo "checked";
}
echo ">&nbsp;&nbsp;&nbsp;  \n                        多生肖:<input style=\"position:relative;top:2px\" type=\"checkbox\" name=\"w_close_type[]\" value=\"多生肖\" ";
if ( in_array( "多生肖", $w_close_type ) )
{
		echo "checked";
}
echo ">&nbsp;&nbsp;&nbsp;    \n                        一肖尾数:<input style=\"position:relative;top:2px\" type=\"checkbox\" name=\"w_close_type[]\" value=\"一肖尾数\" ";
if ( in_array( "一肖尾数", $w_close_type ) )
{
		echo "checked";
}
echo ">&nbsp;&nbsp;&nbsp;        \n                        生肖连:<input style=\"position:relative;top:2px\" type=\"checkbox\" name=\"w_close_type[]\" value=\"生肖连\" ";
if ( in_array( "生肖连", $w_close_type ) )
{
		echo "checked";
}
echo ">&nbsp;&nbsp;&nbsp; \n                        尾数连:<input style=\"position:relative;top:2px\" type=\"checkbox\" name=\"w_close_type[]\" value=\"尾数连\" ";
if ( in_array( "尾数连", $w_close_type ) )
{
		echo "checked";
}
echo ">&nbsp;&nbsp;&nbsp; \n                        半波:<input style=\"position:relative;top:2px\" type=\"checkbox\" name=\"w_close_type[]\" value=\"半波\" ";
if ( in_array( "半波", $w_close_type ) )
{
		echo "checked";
}
echo ">&nbsp;&nbsp;&nbsp;\n                        过关:<input style=\"position:relative;top:2px\" type=\"checkbox\" name=\"w_close_type[]\" value=\"过关\" ";
if ( in_array( "过关", $w_close_type ) )
{
		echo "checked";
}*/
/*>&nbsp;&nbsp;&nbsp;    \n                    </td>\n                    </tr>  \n*/
echo "                    <tr>\n                      <td bordercolor=\"cccccc\" class=\"TDb_D\" align=\"right\" height=\"25\" nowrap=\"nowrap\">維護公告：</td>\n                      <td bordercolor=\"cccccc\" align=\"left\" bgcolor=\"#FFFFFF\" height=\"22\">\n                          <textarea name=\"w_new\" cols=\"60\" rows=\"4\" class=\"input1\" id=\"wincot\"";
echo " style=\"color: rgb(255, 0, 0);\">";
echo $row['w_new'];
echo "</textarea></td>\n                      <td bordercolor=\"cccccc\" class=\"TDb_D\" align=\"right\">&nbsp;</td>\n                      <td bordercolor=\"cccccc\" align=\"left\" bgcolor=\"#FFFFFF\">&nbsp;</td>\n                    </tr>\n                    <tr>\n                      <td colspan=\"4\" bordercolor=\"cccccc\" class=\"TDb_D\" align=\"center\" bgcolor=\"#FFFFFF\" height=\"28\" nowrap=\"nowrap\"><input class=\"button_a\" value=\"";
echo "保存設置\" type=\"Submit\"></td>\n                    </tr>\n                    \n                    <tr class=\"td_caption_1\">\n                      <td colspan=\"4\" bordercolor=\"cccccc\" align=\"left\" bgcolor=\"#FFFFFF\" height=\"28\" nowrap=\"nowrap\" style=\"color:#fff;\">";
echo "<s";
echo "trong>清除緩存</strong></td>\n                    </tr>\n                    <tr>\n                      <td colspan=\"4\" bordercolor=\"cccccc\" align=\"center\" bgcolor=\"#FFFFFF\" height=\"50\" nowrap=\"nowrap\"><button onClick=\"javascript:if(confirm('您確定要清除緩存嗎？本操作將無法恢復！')){parent.downf.location.href='?spul=DWQPU1AzUnAHIw97&amp;save=CsBStFTgB/ZRuACCAeMO5A!888!888'}\" class=\"button_a1\" style=\"width";
echo ":200;height:22\" ;=\"\">&nbsp;&nbsp;<font color=\"ff0000\">清除網站緩存</font>&nbsp;&nbsp;</button></td>\n                    </tr>\n \n                  </tbody>\n                </table>\n</form> \n              </td>\n            </tr>\n          </tbody>\n        </table></td>\n    </tr>\n    <tr>\n<t";
echo "able border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n          <tbody>\n</tbody>\n</table>\n</body>\n</html>";
?>
