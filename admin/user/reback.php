<?php
include_once( "../../global.php" );
$user_id = $_GET['user_id'];
$power = $_GET['power'];
$db = new action( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
$db2 = new mysql( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
$sql = $db->select( "users", "user_name,top_id", "user_id={$user_id}" );
$user = $db->fetch_array( $sql );
$power_char = $db->get_user_power_char( $power );
$is_plate_starts = $db->is_plate_starts( );
echo "<html oncontextmenu=\"return false\" xmlns=\"http://www.w3.org/1999/xhtml\">\n<head>\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">\n    ";
echo "<s";
echo "tyle type=\"text/css\">\n<!--\n.t11 {\nbackground-color: #219CBD;\n}\n.fw12 {\nfont-size: 12px;\ncolor: #ffffff;\n}\n-->\n</style>\n</head>\n\n<body  onselect=\"document.selection.empty()\" oncopy=\"document.selection.empty()\" onmouseover=\"self.status='歡迎光臨';return true\">\n";
echo "<s";
echo "cript src=\"../js/jquery-1.4.3.min.js?i=0\" type=\"text/javascript\"></script>\n";
echo "<s";
echo "cript src=\"js/normal.js?i=1\" type=\"text/javascript\"></script>\n";
echo "<s";
echo "cript language=\"JavaScript\">\nfunction quanxuan(){\n    var cao = \$(\"input[type='checkbox']\");\n    for(var i=0;i<8;i++){\n        cao.eq(i).attr(\"checked\",false);\n    }\n}\nfunction go_select2(){\n    var pan = \$(\"#tpan\").val();//下拉选择类型\n    var typea = \$(\"input:checked\");//多选框\n    var tuishui = \$(\"#jjh\").val();//退水\n    var th;\n    var tdtext;\n   var cao = \$(\"input[type='checkbox']\");\n      if(";
echo "typea.val()==1){\n          if(pan == \"all\"){  \n               \$(\".t_list_tr_1\").next().children(\"input\").val(tuishui);//a\n               \$(\".t_list_tr_1\").next().next().children(\"input\").val(tuishui);//b\n               \$(\".t_list_tr_1\").next().next().next().children(\"input\").val(tuishui);//c\n               \$(\".t_list_tr_1\").next().next().next().next().children(\"input\").val(tuishui);//d\n          }";
echo "else if(pan == \"A\"){\n               \$(\".t_list_tr_1\").next().children(\"input\").val(tuishui);//a\n          }else if(pan == \"B\"){\n               \$(\".t_list_tr_1\").next().next().children(\"input\").val(tuishui);//b\n          }else if(pan == \"C\"){\n               \$(\".t_list_tr_1\").next().next().next().children(\"input\").val(tuishui);//c\n          }else if(pan == \"D\"){\n               \$(\".t_list_tr_1\").next";
echo "().next().next().next().children(\"input\").val(tuishui);//d\n          }\n   }\n    if( cao.eq(0).attr(\"checked\")==false && cao.eq(1).attr(\"checked\")==false && cao.eq(2).attr(\"checked\")==false && cao.eq(3).attr(\"checked\")==false  && cao.eq(4).attr(\"checked\")==false){\n        if(cao.eq(5).attr(\"checked\")==true){\n            \$(\".t_list_tr_1\").next().next().next().next().next().children(\"input\").val(tuis";
echo "hui);//c\n        }\n        if(cao.eq(6).attr(\"checked\")==true){\n            \$(\".t_list_tr_1\").next().next().next().next().next().next().children(\"input\").val(tuishui);//c\n        }\n        if(cao.eq(7).attr(\"checked\")==true){\n            \$(\".t_list_tr_1\").next().next().next().next().next().next().next().children(\"input\").val(tuishui);//c\n        }\n    }else{\n    \$(\".t_list_tr_1\").each(function(){ ";
echo "\n        th = \$(this);\n        tdtext = th.text();\n        tdtext = tdtext.replace(/\\s/gi,'');\n        //alert(tdtext);\n        var i = 0,typevalue,is;\n        typea.each(function(){ \n            is = -1;\n            typevalue = typea.eq(i).val(); \n            is = typevalue.indexOf(tdtext); //alert(is);\n            if(is != -1){ \n                if(cao.eq(5).attr(\"checked\")==true){\n              ";
echo "      th.next().next().next().next().next().children(\"input\").val(tuishui);//c\n                }\n                if(cao.eq(6).attr(\"checked\")==true){\n                    th.next().next().next().next().next().next().children(\"input\").val(tuishui);//c\n                }\n                if(cao.eq(7).attr(\"checked\")==true){\n                    th.next().next().next().next().next().next().next().childre";
echo "n(\"input\").val(tuishui);//c\n                }\n                if( cao.eq(5).attr(\"checked\")==false && cao.eq(6).attr(\"checked\")==false && cao.eq(7).attr(\"checked\")==false){\n                      if(pan == \"all\"){  \n                          th.next().children(\"input\").val(tuishui);//a\n                          th.next().next().children(\"input\").val(tuishui);//b\n                          th.next().";
echo "next().next().children(\"input\").val(tuishui);//c\n                          th.next().next().next().next().children(\"input\").val(tuishui);//c\n                      }else if(pan == \"A\"){\n                          th.next().children(\"input\").val(tuishui);//a\n                      }else if(pan == \"B\"){\n                          th.next().next().children(\"input\").val(tuishui);//b\n                      ";
echo "}else if(pan == \"C\"){\n                          th.next().next().next().children(\"input\").val(tuishui);//c\n                      }else if(pan == \"D\"){\n                          th.next().next().next().next().children(\"input\").val(tuishui);//c\n                      }\n                }\n            }\n            i++;\n        });\n    });\n    }\n}\n\n</script>\n<link href=\"../images/Index.css\" rel=\"styleshee";
echo "t\" type=\"text/css\">\n<div id=\"ly\" style=\"position: absolute; top: 0px; background-color: rgb(255, 255, 255); z-index: 2; left: 0px; display: block; width: 1337px; height: 513px;\"> \n  <!--[if lte IE 6.5]><iframe></iframe><![endif]--> \n</div>\n<!--          浮層框架開始         -->\n<div id=\"rs_window\" style=\"position: absolute; top: 25px; z-index: 2000; left: 277px; display: block;\">\n    \n      <form action=\"u";
echo "pdate_back_set.php\" method=\"post\" name=\"testFrm\" id=\"testFrm\" onsubmit=\"return SubChkds()\">\n          <input type=\"hidden\" value=\"";
echo $user_id;
echo "\" name=\"user_id\" />\n          <input type=\"hidden\" value=\"";
echo $power;
echo "\" name=\"power\" />\n  <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"900\">\n    <tbody>\n    \n   \n    <tr>\n      <td background=\"../images/tab_05.gif\" height=\"30\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n          <tbody>\n            <tr>\n              <td height=\"30\" width=\"12\"><img src=\"../images/tab_03.gif\" height=\"30\" width=\"12\"></td>\n              <td><table border=\"0\" cellpa";
echo "dding=\"0\" cellspacing=\"0\" width=\"100%\">\n                  <tbody>\n                    <tr>\n                      <td valign=\"middle\" width=\"87%\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n                          <tbody>\n                            <tr>\n                              <td width=\"1%\"><div align=\"center\"><img src=\"../images/tb.gif\" height=\"16\" width=\"16\"></div></td>\n       ";
echo "                       <td class=\"F_bold\" width=\"99%\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n                                  <tbody>\n                                    <tr>\n                                      <td valign=\"middle\" width=\"30%\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n                                          <tbody>\n                      ";
echo "                      <tr>\n                                              <td class=\"F_bold\" align=\"left\" width=\"99%\">&nbsp;退水設定－&gt;";
echo $power_char;
echo "（";
echo "<s";
echo "pan>";
echo $user['user_name'];
echo "</span>）</td>\n                                            </tr>\n                                          </tbody>\n                                        </table></td>\n                                      <td align=\"left\" width=\"60%\">";
if ( $is_plate_starts == 0 )
{
		echo "<font color=\"red\">(*注:当前正在开盘，若修改退水，已下注单的退水按未修改前统计。)</font>";
}
else
{
		echo $power_char;
		echo "名稱：";
		echo $user['user_name'];
}
echo "</td>\n                                      <td align=\"right\" width=\"10%\"><a href=\"javascript:history.back(-1)\"><img src=\"../images/icon_21x21_del.gif\" border=\"0\" height=\"16\" width=\"16\"></a></td>\n                                    </tr>\n                                  </tbody>\n                                </table></td>\n                            </tr>\n                          </tbody>\n                ";
echo "        </table></td>\n                    </tr>\n                  </tbody>\n                </table></td>\n              <td width=\"16\"><img src=\"../images/tab_07.gif\" height=\"30\" width=\"16\"></td>\n            </tr>\n          </tbody>\n        </table></td>\n    </tr>\n    <tr>\n      <td><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n          <tbody>\n            <tr>\n              <td background=\"../image";
echo "s/tab_12.gif\" width=\"8\">&nbsp;</td>\n              <td align=\"center\"><!-- 開始  -->\n                <div id=\"ToolBar\">\n<table width=\"100%\" height=\"40\" border=\"0\" cellpadding=\"2\" cellspacing=\"1\" class=\"t20\">\n<tbody><tr class=\"t4\" align=\"center\">\n<td class=\"t11 fw12\" width=\"1%\">项目</td>\n<td width=\"48%\">\n    <input value=\"正1特A,正2特A,正3特A,正4特A,正5特A,正6特A\" type=\"checkbox\" />正1-6特A&nbsp;\n    <input val";
echo "ue=\"正1特B,正2特B,正3特B,正4特B,正5特B,正6特B\" type=\"checkbox\" />正1-6特B&nbsp;\n    <input value=\"二肖,三肖,四肖,五肖,六肖\" type=\"checkbox\" />多生肖&nbsp;\n    <input value=\"五不中,六不中,七不中,八不中,九不中,十不中\" type=\"checkbox\" />不中&nbsp;\n    <input value=\"二全中,二中特,特串,三全中,三中二\" type=\"checkbox\" />连码&nbsp;<br><br>\n<input  value=\"5\" type=\"checkbox\" />最低限額&nbsp;\n<input  value=\"6\" type";
echo "=\"checkbox\" />单註限額&nbsp;\n<input  value=\"7\" type=\"checkbox\" />最高限額&nbsp; \n        ";
echo "<s";
echo "elect size=\"1\" name=\"tpan\" id=\"tpan\">\n\t    <option selected=\"\" value=\"all\">全部</option>\n\t    <option value=\"A\">A</option>\n\t    <option value=\"B\">B</option>\n\t    <option value=\"C\">C</option>\n\t    <option value=\"D\">D</option>\n\t</select>盘&nbsp;&nbsp;&nbsp;\n        \n        <input  value=\"1\" type=\"checkbox\" onchange=\"quanxuan()\" />全选(限額除外)&nbsp;&nbsp;&nbsp;\n</td>\n\n<td class=\"t11 fw12\" width=\"1%\">功能</td>\n<td";
echo " width=\"40%\">\n    退水值<input id=\"jjh\" name=\"money\" class=\"input1 rate_color\" value=\"\" size=\"4\" >\n        <input onclick=\"go_select2()\" name=\"button2\" class=\"button_a\" value=\"送出\" type=\"button\" style=\"width:60;height:22\">\n         <input type=\"reset\" name=\"Submit2\" value=\"取消\" class=\"button_a\" style=\"width:60;height:22\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n<!--         <button onClick=\"submit()\" cla";
echo "ss=\"button_a\" style=\"width:80;height:22\" >確認提交</button>    -->\n<input class=\"btn2\" name=\"Submit\" onmouseout=\"this.className='btn2'\" onmouseover=\"this.className='btn2m'\" value=\"保存\" type=\"submit\">\n</td>\n</tr>\n</tbody></table>\n</div><div id=\"result\">\n                <table class=\"Ball_List\" bgcolor=\"f1f1f1\" border=\"0\" cellpadding=\"1\" cellspacing=\"1\" width=\"100%\">\n                  <tbody>\n               ";
echo "     <tr class=\"td_caption_1\">\n                      <td align=\"center\" bgcolor=\"#EBF4DF\" height=\"22\" nowrap=\"nowrap\">交易類型</td>\n                      <td align=\"center\" bgcolor=\"#EBF4DF\" nowrap=\"nowrap\">A%</td>\n                      <td bordercolor=\"f1f1f1\" align=\"center\" bgcolor=\"#EBF4DF\" nowrap=\"nowrap\">%B</td>\n                      <td bordercolor=\"f1f1f1\" align=\"center\" bgcolor=\"#EBF4DF\" nowrap=\"n";
echo "owrap\">%C</td>\n                      <td bordercolor=\"f1f1f1\" align=\"center\" bgcolor=\"#EBF4DF\" nowrap=\"nowrap\">%D</td>\n                      <td bordercolor=\"f1f1f1\" align=\"center\" bgcolor=\"#EBF4DF\" nowrap=\"nowrap\">最低</td>\n                      <td align=\"center\" bgcolor=\"#EBF4DF\" nowrap=\"nowrap\">最高</td>\n                      <td align=\"center\" bgcolor=\"#EBF4DF\" nowrap=\"nowrap\">单項(號)限額</td>\n      ";
echo "                <td align=\"center\" bgcolor=\"#EBF4DF\" height=\"22\" nowrap=\"nowrap\">交易類型</td>\n                      <td align=\"center\" bgcolor=\"#EBF4DF\" nowrap=\"nowrap\">A%</td>\n                      <td bordercolor=\"f1f1f1\" align=\"center\" bgcolor=\"#EBF4DF\" nowrap=\"nowrap\">%B</td>\n                      <td bordercolor=\"f1f1f1\" align=\"center\" bgcolor=\"#EBF4DF\" nowrap=\"nowrap\">%C</td>\n                      ";
echo "<td bordercolor=\"f1f1f1\" align=\"center\" bgcolor=\"#EBF4DF\" nowrap=\"nowrap\">%D</td>\n                      <td bordercolor=\"f1f1f1\" align=\"center\" bgcolor=\"#EBF4DF\" nowrap=\"nowrap\">最低</td>\n                      <td align=\"center\" bgcolor=\"#EBF4DF\" nowrap=\"nowrap\">最高</td>\n                      <td align=\"center\" bgcolor=\"#EBF4DF\" nowrap=\"nowrap\">单項(號)限額</td>\n                    </tr>\n                 ";
echo "     \n";
$query = $db->select( "back_set", "*", "user_id={$user_id} order by view_order asc" );
$i = 0;
for ( ;	$i < 21;	++$i	)
{
		echo "                    <tr class=\"t_list_tr_0\" onmouseover=\"this.style.backgroundColor='#FFFFA2'\" onmouseout=\"this.style.backgroundColor=''\">\n    ";
		if ( $row = $db->fetch_array( $query ) )
		{
				echo "               \n                      <td class=\"t_list_tr_1\" align=\"center\">";
				echo $row['set_name'];
				echo "                      <input name=\"cname[]\" id=\"set_name[]\" value=\"";
				echo $row['set_name'];
				echo "\" type=\"hidden\">\n                      <td align=\"center\"><input onblur=\"istuishui(\$(this),";
				echo $db2->type_dy_backvalue( $user['top_id'], $row['set_name'], "percent_a" );
				echo ",";
				echo $power;
				echo ",";
				echo $user_id;
				echo ");return CountGoldS1(this,'blur','SP','14');\" onkeypress=\"return CheckKey11();\" onkeyup=\"return CountGoldS1(this,'keyup');\" name=\"percent_a[]\" class=\"input1\" id=\"ma[]\" value=\"";
				echo $row['percent_a'];
				echo "\" size=\"4\"></td>\n                      <td align=\"center\"><input name=\"percent_b[]\" class=\"input1\" onkeypress=\"return CheckKey11();\" onblur=\"istuishui(\$(this),";
				echo $db2->type_dy_backvalue( $user['top_id'], $row['set_name'], "percent_b" );
				echo ",";
				echo $power;
				echo ",";
				echo $user_id;
				echo ");return CountGoldS1(this,'blur','SP','14');\" onkeyup=\"return CountGoldS1(this,'keyup');\" id=\"mm[]\" value=\"";
				echo $row['percent_b'];
				echo "\" size=\"4\"></td>\n                      <td align=\"center\"><input name=\"percent_c[]\" class=\"input1\" id=\"mc[]\" onkeypress=\"return CheckKey11();\" onblur=\"istuishui(\$(this),";
				echo $db2->type_dy_backvalue( $user['top_id'], $row['set_name'], "percent_c" );
				echo ",";
				echo $power;
				echo ",";
				echo $user_id;
				echo ");return CountGoldS1(this,'blur','SP','15');\" onkeyup=\"return CountGoldS1(this,'keyup');\" value=\"";
				echo $row['percent_c'];
				echo "\" size=\"4\"></td>\n                      <td align=\"center\"><input name=\"percent_d[]\" class=\"input1\" id=\"md[]\" onkeypress=\"return CheckKey11();\" onblur=\"istuishui(\$(this),";
				echo $db2->type_dy_backvalue( $user['top_id'], $row['set_name'], "percent_d" );
				echo ",";
				echo $power;
				echo ",";
				echo $user_id;
				echo ");return CountGoldS1(this,'blur','SP','16');\" onkeyup=\"return CountGoldS1(this,'keyup');\" value=\"";
				echo $row['percent_d'];
				echo "\" size=\"4\"></td>\n                      <td align=\"center\"><input onblur=\"return CountGoldS1(this,'blur','TP','1','0');\" onkeyup=\"return CountGoldS1(this,'keyup');\" onkeypress=\"return CheckKey11();\" name=\"bottom_limit[]\" class=\"input1\" id=\"m0\" value=\"";
				echo $row['bottom_limit'];
				echo "\" size=\"4\"></td>\n                      <td align=\"center\"><input onblur=\"return CountGoldS1(this,'blur','MP','50000','0');\" onkeyup=\"return CountGoldS1(this,'keyup');\" onkeypress=\"return CheckKey11();\" name=\"top_limit[]\" class=\"input1\" id=\"mm0\" value=\"";
				echo $row['top_limit'];
				echo "\" size=\"6\"></td>\n                      <td align=\"center\"><input onblur=\"return CountGoldS1(this,'blur','XP','500000','0');\" onkeypress=\"return CheckKey11();\" onkeyup=\"return CountGoldS1(this,'keyup');\" name=\"odd_limit[]\" class=\"input1\" id=\"mmm0\" value=\"";
				echo $row['odd_limit'];
				echo "\" size=\"6\"></td>\n    ";
		}
		echo " \n    ";
		if ( $row = $db->fetch_array( $query ) )
		{
				echo "   \n                      ";
				echo "                      <td class=\"t_list_tr_1\" align=\"center\">";
				echo $row['set_name'];
				echo "                      <input name=\"cname[]\" id=\"set_name[]\" value=\"";
				echo $row['set_name'];
				echo "\" type=\"hidden\">\n                      <td align=\"center\"><input onblur=\"istuishui(\$(this),";
				echo $db2->type_dy_backvalue( $user['top_id'], $row['set_name'], "percent_a" );
				echo ",";
				echo $power;
				echo ",";
				echo $user_id;
				echo ");return CountGoldS1(this,'blur','SP','14');\" onkeypress=\"return CheckKey11();\" onkeyup=\"return CountGoldS1(this,'keyup');\" name=\"percent_a[]\" class=\"input1\" id=\"ma[]\" value=\"";
				echo $row['percent_a'];
				echo "\"  size=\"4\"></td>\n                      <td align=\"center\"><input name=\"percent_b[]\" class=\"input1\" onkeypress=\"return CheckKey11();\" onblur=\"istuishui(\$(this),";
				echo $db2->type_dy_backvalue( $user['top_id'], $row['set_name'], "percent_b" );
				echo ",";
				echo $power;
				echo ",";
				echo $user_id;
				echo ");return CountGoldS1(this,'blur','SP','14');\" onkeyup=\"return CountGoldS1(this,'keyup');\" id=\"mm[]\" value=\"";
				echo $row['percent_b'];
				echo "\"  size=\"4\"></td>\n                      <td align=\"center\"><input name=\"percent_c[]\" class=\"input1\" id=\"mc[]\" onkeypress=\"return CheckKey11();\" onblur=\"istuishui(\$(this),";
				echo $db2->type_dy_backvalue( $user['top_id'], $row['set_name'], "percent_c" );
				echo ",";
				echo $power;
				echo ",";
				echo $user_id;
				echo ");return CountGoldS1(this,'blur','SP','15');\" onkeyup=\"return CountGoldS1(this,'keyup');\" value=\"";
				echo $row['percent_c'];
				echo "\"  size=\"4\"></td>\n                      <td align=\"center\"><input name=\"percent_d[]\" class=\"input1\" id=\"md[]\" onkeypress=\"return CheckKey11();\" onblur=\"return CountGoldS1(this,'blur','SP','16');\" onkeyup=\"istuishui(\$(this),";
				echo $db2->type_dy_backvalue( $user['top_id'], $row['set_name'], "percent_d" );
				echo ",";
				echo $power;
				echo ",";
				echo $user_id;
				echo ");return CountGoldS1(this,'keyup');\" value=\"";
				echo $row['percent_d'];
				echo "\"  size=\"4\"></td>\n                      <td align=\"center\"><input onblur=\"return CountGoldS1(this,'blur','TP','1','0');\" onkeyup=\"return CountGoldS1(this,'keyup');\" onkeypress=\"return CheckKey11();\" name=\"bottom_limit[]\" class=\"input1\" id=\"m0\" value=\"";
				echo $row['bottom_limit'];
				echo "\" size=\"4\"></td>\n                      <td align=\"center\"><input onblur=\"return CountGoldS1(this,'blur','MP','50000','0');\" onkeyup=\"return CountGoldS1(this,'keyup');\" onkeypress=\"return CheckKey11();\" name=\"top_limit[]\" class=\"input1\" id=\"mm0\" value=\"";
				echo $row['top_limit'];
				echo "\" size=\"6\"></td>\n                      <td align=\"center\"><input onblur=\"return CountGoldS1(this,'blur','XP','500000','0');\" onkeypress=\"return CheckKey11();\" onkeyup=\"return CountGoldS1(this,'keyup');\" name=\"odd_limit[]\" class=\"input1\" id=\"mmm0\" value=\"";
				echo $row['odd_limit'];
				echo "\" size=\"6\"></td>\n    ";
		}
		echo "                 \n                    </tr>\n";
}
echo "                  </tbody>\n                </table>\n                </div>\n                <!-- 結束  --></td>\n              <td background=\"../images/tab_15.gif\" width=\"8\">&nbsp;</td>\n            </tr>\n          </tbody>\n        </table></td>\n    </tr>\n    <tr>\n      <td background=\"../images/tab_19.gif\" height=\"35\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n          <tbody>\n            <tr>";
echo "\n              <td height=\"35\" width=\"12\"><img src=\"../images/tab_18.gif\" height=\"35\" width=\"12\"></td>\n              <td valign=\"top\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" height=\"30\" width=\"100%\">\n                  <tbody>\n                    <tr>\n                      <td align=\"center\">                          \n<!--                          <input class=\"btn2\" name=\"Submit\" onmouseout=\"this.";
echo "className='btn2'\" onmouseover=\"this.className='btn2m'\" value=\"保存\" type=\"submit\">\n                        <a href=\"javascript:history.back(-1)\"><input class=\"btn2\" onclick=\"javascript:history.back(-1)\" name=\"cancel\"  onmouseout=\"this.className='btn2'\" onmouseover=\"this.className='btn2m'\" value=\"取消\" type=\"button\"></a>-->\n                      </td>\n                    </tr>\n                  </tbody>\n";
echo "                </table></td>\n              <td width=\"1%\"><img src=\"../images/tab_20.gif\" height=\"35\" width=\"17\"></td>\n            </tr>\n          </tbody>\n        </table></td>\n    </tr>\n    </tbody>\n    \n  </table>\n       </form>\n</div>\n</body>\n</html>";
?>
