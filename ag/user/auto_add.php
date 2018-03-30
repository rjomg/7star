<?php
include_once( "../../global.php" );
error_reporting( 0 );
$user_name = $_GET['user_name'];
$power = $_SESSION["user_power".$c_p_seesion];
$uid = $_SESSION["uid".$c_p_seesion];
$db = new action( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
$o_te = $_GET['o_typename'];
if ( $_GET['vl'] == 1 && $o_te != "" )
{
		$sql2 = "update backorder_set SET is_use = 1 where user_id ='{$uid}' and o_typename='{$o_te}'";
		$db->query( $sql2 );
}
if ( $_GET['vl'] == 0 && $o_te != "" )
{
		$sql3 = "update backorder_set SET is_use = 0 where user_id ='{$uid}' and o_typename='{$o_te}'";
		$db->query( $sql3 );
}
echo "<html oncontextmenu=\"return false\" xmlns=\"http://www.w3.org/1999/xhtml\"><head>\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">\n";
echo "<s";
echo "tyle type=\"text/css\">\n<!--\nbody {\n\tmargin-left: 0px;\n\tmargin-top: 0px;\n\tmargin-right: 0px;\n\tmargin-bottom: 0px;\n}\n-->\n</style>\n</head>\n<body onmouseover=\"self.status='ög”≠π‚≈R';return true\">\n<link href=\"../images/Index.css\" rel=\"stylesheet\" type=\"text/css\">\n";
echo "<s";
echo "cript language=\"JavaScript\">\nif(self == top) {location = '/';} \nfunction send_request(url){//≥ı ºªØ£¨÷∏∂®Ãé¿Ì∫Ø ˝£¨∞lÀÕ’à«Ûµƒ∫Ø ˝\n    http_request=false;\n    //È_ º≥ı ºªØXMLHttpRequestå¶œÛ\n    if(window.XMLHttpRequest){//Mozillaûg”[∆˜\n     http_request=new XMLHttpRequest();\n     if(http_request.overrideMimeType){//‘O÷√MIMEÓêÑe\n       http_request.overrideMimeType(\"text/xml\");\n     }\n    }\n    else";
echo " if(window.ActiveXObject){//IEûg”[∆˜\n     try{\n      http_request=new ActiveXObject(\"Msxml2.XMLHttp\");\n     }catch(e){\n      try{\n      http_request=new ActiveXobject(\"Microsoft.XMLHttp\");\n      }catch(e){}\n     }\n    }\n    if(!http_request){//Æê≥££¨ÑìΩ®å¶œÛåç¿˝ ßî°\n     window.alert(\"ÑìΩ®XMLHttpå¶œÛ ßî°£°\");\n     return false;\n    }\n    http_request.onreadystatechange=processrequest;\n    //¥_∂®∞l";
echo "ÀÕ’à«Û∑Ω Ω£¨URL£¨º∞ «∑ÒÕ¨≤ΩàÃ––œ¬∂Œ¥˙¬Î\n    http_request.open(\"GET\",url,true);\n    http_request.send(null);\n  }\n  //Ãé¿Ì∑µªÿ–≈œ¢µƒ∫Ø ˝\n  function processrequest(){\n   if(http_request.readyState==4){//≈–î‡å¶œÛ†ÓëB\n     if(http_request.status==200){//–≈œ¢“—≥…π¶∑µªÿ£¨È_ ºÃé¿Ì–≈œ¢\n\t \n      document.getElementById(reobj).innerHTML=http_request.responseText;\n\t  \n     }\n     else{//Ìì√Ê≤ª’˝≥£\n      alert";
echo "(\"ƒ˙À˘’à«ÛµƒÌì√Ê≤ª’˝≥££°\");\n     }\n   }\n  }\n  function dopage(obj,url){\n  // document.getElementById(obj).innerHTML=\"’˝‘⁄◊x»° ˝ì˛...\";\n   send_request(url);\n   reobj=obj;\n   } \n   \n function C_Key(){\n\n\tdopage('result','?spul=WidUCFAnA3UDelonAi4!888&page=1');\n}\n\n</script>\n\n ";
echo "<s";
echo "tyle type=\"text/css\">\n<!--\n.STYLE2 {color: #0000FF}\n.STYLE5 {\n\tcolor: #006600;\n\tfont-weight: bold;\n}\n.STYLE7 {color: #0000FF; font-weight: bold; }\n.STYLE8 {color: #006600}\n.input1 {\n\tdisplay:inline-block;BACKGROUND-COLOR: #ffffff; BORDER-BOTTOM: #A7BCCB 1px solid; BORDER-LEFT: #A7BCCB 1px solid; BORDER-RIGHT: #A7BCCB 1px solid; BORDER-TOP: #A7BCCB 1px solid; FONT-FAMILY: \"Verdana\", \"Arial\", \"Helvet";
echo "ica\", \"sans-serif\"; FONT-SIZE: 12px;text-align:left;font-weight: bold;color: #990000;line-height: 15px;width: 45px;\n}\n\n.input3 {\n\tdisplay:inline-block;BACKGROUND-COLOR: #ffffff; BORDER-BOTTOM: #A7BCCB 1px solid; BORDER-LEFT: #A7BCCB 1px solid; BORDER-RIGHT: #A7BCCB 1px solid; BORDER-TOP: #A7BCCB 1px solid; FONT-FAMILY: \"Verdana\", \"Arial\", \"Helvetica\", \"sans-serif\"; FONT-SIZE: 12px;text-align:left;";
echo "font-weight: bold;color: #990000;line-height: 15px;width: 60px;\n}\n.input2 {\n\tdisplay:inline-block;BACKGROUND-COLOR: #ffffff; BORDER-BOTTOM: #A7BCCB 1px solid; BORDER-LEFT: #A7BCCB 1px solid; BORDER-RIGHT: #A7BCCB 1px solid; BORDER-TOP: #A7BCCB 1px solid; FONT-FAMILY: \"Verdana\", \"Arial\", \"Helvetica\", \"sans-serif\"; FONT-SIZE: 12px;text-align:left;font-weight: bold;color: #0000ff;line-height: 15px;wi";
echo "dth: 45px;\n}\n-->\n </style>\n  \n    <form action=\"back_order_set.php\" method=\"post\" name=\"testFrm\" id=\"testFrm\" onSubmit=\"return SubChkds()\">\n   <input type=\"hidden\" value=\"";
echo $uid;
echo "\" name=\"user_id\" />\n          <input type=\"hidden\" value=\"";
echo $power;
echo "\" name=\"power\" />\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n\n    <tbody>\n    <tr>\n      <td background=\"../images/tab_05.gif\" height=\"30\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n        <tbody>\n          <tr>\n            <td height=\"30\" width=\"12\"><img src=\"../images/tab_03.gif\" height=\"30\" width=\"12\"></td>\n            <td><table border=\"0\" cellpadding=\"0\" cellspa";
echo "cing=\"0\" width=\"100%\">\n              <tbody>\n                <tr>\n                  <td valign=\"middle\" width=\"87%\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n                    <tbody>\n                      <tr>\n                        <td width=\"16\"><div align=\"center\"><img src=\"../images/tb.gif\" height=\"16\" width=\"16\"></div></td>\n                        <td class=\"F_bold\" width=\"151\">";
echo "◊‘Ñ”—aÿõ‘O∂®</td>\n                        <td class=\"F_bold\" align=\"right\" nowrap=\"nowrap\">&nbsp;</td>\n       \n<td class=\"F_bold\" width=\"839\"> \n\t\t\t\t\t\t  </td>\n                        <td class=\"F_bold\" width=\"12\">&nbsp;</td>\n                      <td align=\"right\" width=\"179\">? </td>\n                      </tr>\n                    </tbody>\n                  </table></td>\n                  </tr>\n              </tb";
echo "ody>\n            </table></td>\n            <td width=\"16\"><img src=\"../images/tab_07.gif\" height=\"30\" width=\"16\"></td>\n          </tr>\n        </tbody>\n      </table></td>\n    </tr>\n    <tr>\n      <td><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n        <tbody>\n          <tr>\n            <td background=\"../images/tab_12.gif\" width=\"8\">&nbsp;</td>\n            <td align=\"center\" height=\"50\"><!-- È_ ";
echo "º  --><div id=\"result\">              \n<table class=\"t_list\" border=\"0\" cellpadding=\"0\" cellspacing=\"1\" width=\"100%\">\n            <tbody><tr class=\"td_caption_1\">\n                <td>—aÿõÓê–Õ</td>\n                <td>ﬂxìÒ”ãÀ„∑Ω Ω</td>\n                <td>øÿ—uÓ~∂»</td>\n                <td>◊ÓµÕø…’{Ó~∂»</td>\n                <td>∆—aÓ~∂»</td>\n                <td>∆Ù”√</td>\n                <td>—aÿõÓê–Õ</td>\n              ";
echo "  <td>ﬂxìÒ”ãÀ„∑Ω Ω</td>\n                <td>øÿ—uÓ~∂»</td>\n                <td>◊ÓµÕø…’{Ó~∂»</td>\n                <td>∆—aÓ~∂»</td>\n                <td>∆Ù”√</td>\n            </tr>\n                       ";
$qqu = $db->select( "backorder_set", "user_id", "user_id = '{$uid}' limit 0,1" );
$qrow = $db->fetch_array( $qqu );
if ( $qrow['user_id'] )
{
		$query = $db->select( "backorder_set", "*", "user_id = '{$uid}' order by view_order asc" );
}
else
{
		$query = $db->select( "backorder_set", "*", "user_id = 0 order by view_order asc" );
}
$i = 0;
for ( ;	$i < 21;	++$i	)
{
		echo "           \n\t\t   \t\t    <tr style=\"\" class=\"t_list_tr_0\" onMouseOut=\"this.style.backgroundColor=''\" onMouseOver=\"this.style.backgroundColor='#FFFFA2'\" height=\"26\">\n                                        ";
		if ( $row = $db->fetch_array( $query ) )
		{
				echo "   \n           \n                <td>";
				echo $row['o_typename'];
				echo "\t\t\t\n                    <input name=\"o_typename[]\" value=\"";
				echo $row['o_typename'];
				echo "\" type=\"hidden\" id=\"on";
				echo $row['view_order'];
				echo "\">\n                    <input name=\"or_value[]\" value=\"";
				echo $row['control_limit'];
				echo "\" id=\"or_value";
				echo $row['view_order'];
				echo "\" type=\"hidden\">\n                    <input name=\"now_value[]\" id=\"ffff0\" value=\"";
				echo $row['control_limit'];
				echo "\" type=\"hidden\">\n                    <input name=\"pz0\" id=\"pz0\" value=\"0\" type=\"hidden\"></td>\n                <td>";
				echo "<s";
				echo "elect name=\"";
				echo "FT".$row['view_order'];
				echo "\" style=\"cursor: hand\" ";
				if ( $row['is_use'] == 0 )
				{
						echo "disabled";
				}
				echo ">\n                    <option value=\"0\" selected=\"selected\">œ¬‘]Ó~</option>\n                    </select></td>\n                <td><input class=\"inp1\" id=\"cl";
				echo $row['view_order'];
				echo "\" maxlength=\"9\" name=\"";
				echo "mM".$row['view_order'];
				echo "\" onBlur=\"r(";
				echo $row['view_order'];
				echo ")\" onFocus=\"this.className='inp1a'\" onKeyPress=\"digitfOnly(event)\" size=\"12\" value=\"";
				echo $row['control_limit'];
				echo "\" ";
				if ( $row['is_use'] == 0 )
				{
						echo "disabled";
				}
				echo " type=\"text\"></td>\n                \n                <td class=\"f_right\">";
				echo $row['lowest_limit'];
				echo "&nbsp;</td>\n                ";
				echo "                <td class=\"f_right\">";
				echo $row['begin_limit'];
				echo "\t&nbsp;</td>\n                <td><input name=\"";
				echo "TO".$row['view_order'];
				echo "\" onClick=\"Sel_TO('";
				echo $row['view_order'];
				echo "')\" value=\"1\" type=\"checkbox\"   ";
				if ( $row['is_use'] == 1 )
				{
						echo "checked";
				}
				echo "></td>\n\t\t\t\t";
		}
		echo "       \n                    ";
		if ( $row = $db->fetch_array( $query ) )
		{
				echo "  \t\t\t\t\n\t\t\t\t<td>";
				echo $row['o_typename'];
				echo "\t\t\t\t\n                     <input name=\"o_typename[]\" value=\"";
				echo $row['o_typename'];
				echo "\" type=\"hidden\"  id=\"on";
				echo $row['view_order'];
				echo "\">\n                     <input name=\"or_value[]\" value=\"";
				echo $row['control_limit'];
				echo "\" id=\"or_value";
				echo $row['view_order'];
				echo "\" type=\"hidden\">\n                     <input name=\"now_value[]\" id=\"ffff0\" value=\"";
				echo $row['control_limit'];
				echo "\" type=\"hidden\">\n                    <input name=\"pz1\" id=\"pz1\" value=\"0\" type=\"hidden\"></td>\n                <td>";
				echo "<s";
				echo "elect name=\"";
				echo "FT".$row['view_order'];
				echo "\" style=\"cursor: hand\" ";
				if ( $row['is_use'] == 0 )
				{
						echo "disabled";
				}
				echo ">\n                    <option value=\"0\" selected=\"selected\">œ¬‘]Ó~</option>\n                    </select></td>\n                <td><input class=\"inp1\" id=\"cl";
				echo $row['view_order'];
				echo "\"  maxlength=\"9\" name=\"";
				echo "mM".$row['view_order'];
				echo "\" onBlur=\"r(";
				echo $row['view_order'];
				echo ")\" onFocus=\"this.className='inp1a'\" onKeyPress=\"digitfOnly(event)\" size=\"12\" value=\"";
				echo $row['control_limit'];
				echo "\" ";
				if ( $row['is_use'] == 0 )
				{
						echo "disabled";
				}
				echo " type=\"text\"></td>\n                \n                <td class=\"f_right\">";
				echo $row['lowest_limit'];
				echo "&nbsp;</td>\n                \n                <td class=\"f_right\">";
				echo $row['begin_limit'];
				echo "\t&nbsp;</td>\n                <td><input name=\"";
				echo "TO".$row['view_order'];
				echo "\" onClick=\"Sel_TO('";
				echo $row['view_order'];
				echo "')\" value=\"1\" type=\"checkbox\" ";
				if ( $row['is_use'] == 1 )
				{
						echo "checked";
				}
				echo "></td>\n\t\t\t\t\n\t\t\t\t\t\t\t\t\n                ";
		}
		echo "  \n\t\t    </tr>\n            \n            ";
}
echo "            \n            \n\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\n                \n\t\t    \n\t\t\t        </tbody></table>\n                </div> <!-- ΩY ¯  --></td>\n            <td background=\"../images/tab_15.gif\" width=\"8\">&nbsp;</td>\n          </tr>\n        </tbody>\n      </table></td>\n    </tr>\n    <tr>\n      <td background=\"../images/tab_19.gif\" height=\"35\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n        <tbody>";
echo "\n          <tr>\n            <td height=\"35\" width=\"12\"><img src=\"../images/tab_18.gif\" height=\"35\" width=\"12\"></td>\n            <td valign=\"top\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" height=\"30\" width=\"100%\">\n              <tbody>\n                <tr>\n                  <td align=\"center\"><input class=\"btn2\" name=\"Submit2\" onMouseOut=\"this.className='btn2'\" onMouseOver=\"this.className='btn2m'\" va";
echo "lue=\"±£¥Ê\" type=\"submit\">\n                    °°\n                    <input onclick=\"javascript:history.back(-1)\" class=\"btn2\" name=\"cancel\" onMouseOut=\"this.className='btn2'\" onMouseOver=\"this.className='btn2m'\" value=\"»°œ˚\" type=\"reset\"></td>\n                </tr>\n              </tbody>\n            </table></td>\n            <td width=\"16\"><img src=\"../images/tab_20.gif\" height=\"35\" width=\"16\"></td>\n     ";
echo "     </tr>\n        </tbody>\n      </table></td>\n    </tr>\n  </tbody>\n</table></form>\n";
echo "<s";
echo "cript language=\"javascript\">\n    function digitfOnly(evt) {\n        if (!(evt.keyCode>=48 && evt.keyCode<=57) ) {\n            evt.returnValue=false;\n        }\n    }\n    function Sel_TO(ID) {\n        if (document.getElementById(\"TO\"+ID).checked==true){\n\t\t\t\n\t\t\tvar o = 'on'+ID;\n\t\t\tvar otn =document.getElementById(o).value;\n\t\t\t\n            document.all[\"FT\"+ID].disabled = false;\n            document.ge";
echo "tElementById(\"mM\"+ID).disabled = false;\n            document.getElementById(\"mM\"+ID).focus();\n\t\t\tlocation.href = \"?vl=1&o_typename=\"+otn;\n\t\t\t\n        } else {    \n\t\t\tvar o = 'on'+ID;\n\t\t\tvar otn =document.getElementById(o).value;\n\t\t\tlocation.href = \"?vl=0&o_typename=\"+otn;  \n            document.all[\"FT\"+ID].disabled = true;\n            document.getElementById(\"mM\"+ID).disabled = true;\n        }\n  ";
echo "  }\n\t\n\tfunction r(i){\n\t\t\tvar zu = 'cl'+i;\n\t\t\t var ov = 'or_value'+i;\n \t\t  var cl = document.getElementById(zu);\n\t\t// alert(cl);\n\t\t   cl.className = \"inp1\";  //∏ƒ±‰classname\n\t\t    document.getElementById(ov).value =cl.value ;\t\n\t\t}\n\t\n    </script>\n \n</body></html>";
?>
