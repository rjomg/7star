<?php
include_once( "../../global.php" );
$db = new plate( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
$plate_id = $_GET[plate_id];
$query = $db->select( "plate", "*", "id={$plate_id} order by plate_num desc" );
$plates = $db->fetch_array( $query );
if ( $_POST[plate_num] && strtotime( $_POST[plate_time_lottery] ) )
{
		$num_a = $_POST['num_a'] ? $_POST['num_a'] : -1;
		$num_b = $_POST['num_b'] ? $_POST['num_b'] : -2;
		$num_c = $_POST['num_c'] ? $_POST['num_c'] : -3;
		$num_d = $_POST['num_d'] ? $_POST['num_d'] : -4;
		$num_e = $_POST['num_e'] ? $_POST['num_e'] : -5;
		$num_f = $_POST['num_f'] ? $_POST['num_f'] : -6;
		$num_g = $_POST['num_g'] ? $_POST['num_g'] : -7;
		$arr1 = array(
				$num_a,
				$num_b,
				$num_c,
				$num_d,
				$num_e,
				$num_f,
				$num_g
		);
		$num1 = count( $arr1 );
		// $arr2 = array_unique( $arr1 );
		$num2 = count( $arr1 );
		if ( $num1 != $num2 )
		{
				$db->get_admin_msg( "edit_plate.php?plate_id=".$plate_id, "开奖号码有重复!" );
				exit( );
		}
		$sql2 = "update plate SET num_a = '{$_POST['num_a']}' ,num_b = '{$_POST['num_b']}' ,num_c = '{$_POST['num_c']}' ,num_d = '{$_POST['num_d']}' ,num_e = '{$_POST['num_e']}' ,num_f = '{$_POST['num_f']}' ,num_g = '{$_POST['num_g']}' ,plate_time_lottery='{$_POST[plate_time_lottery]}' where plate_num = {$_POST[plate_num]}";
		$db->query( $sql2 );
		$db->update( "plate", "history_is_account=0", "plate_num={$_POST['plate_num']}" );
		$db->edit_account( $_POST['plate_num'] );
		// exit;
		$db->get_admin_msg( "his.php", "修改成功！" );
}
echo "<html oncontextmenu=\"return false\" xmlns=\"http://www.w3.org/1999/xhtml\">\n    \n    <head>\n        <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">\n        ";
echo "<s";
echo "tyle type=\"text/css\">\n            <!-- body { margin-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom:\n            0px; } -->\n        </style>\n        ";
echo "<s";
echo "cript>\n            if (self == top) {\n                location = '/';\n            }\n            if (window.location.host != top.location.host) {\n                top.location = window.location;\n            }\n        </script>\n    </head>\n    \n    <body oncontextmenu=\"return false\" onselect=\"document.selection.empty()\"\n    oncopy=\"document.selection.empty()\" onmouseover=\"self.status='歡迎光臨';return t";
echo "rue\">\n        <link href=\"../images/Index.css\" rel=\"stylesheet\" type=\"text/css\">\n       ";
echo "<link href=\"../css/admincg.css\" type=\"text/css\">";
echo "<s";
echo "cript language=\"javascript\" type=\"text/javascript\" src=\"../My97DatePicker/WdatePicker.js\"></script>\n        ";
echo "<s";
echo "tyle type=\"text/css\">\n            <!-- .STYLE1 {color: #CCCCCC} -->\n        </style>\n        \n        ";
echo "<s";
echo "tyle type=\"text/css\">\n            #rs_windowss{ width:800px; height:500px; float:left; margin-left:0px;\n            margin-right:0px; border:0px solid #ffffff; overflow:auto; overflow-x:hidden;\n            /*主要就是這句代码*/ SCROLLBAR-ARROW-COLOR:#FFFFFF; SCROLLBAR-FACE-COLOR:#E0F3FF;\n            SCROLLBAR-DARKSHADOW-COLOR:#FFFFFF; SCROLLBAR-HIGHLIGHT-COLOR:#FFFFFF;\n            SCROLLBAR-3DLIGHT";
echo "-COLOR:#FFFFFF; SCROLLBAR-SHADOW-COLOR:#FFFFFF; SCROLLBAR-TRACK-COLOR:#FFFFFF;}\n            #ly { width: 500px; height: 200px; position: absolute; left: 0; top: 0px;\n            border: 0px solid blue; background-color: #fff; } #ly iframe { display:none;/*sorry\n            for IE5*/ display/**/:block;/*sorry for IE5*/ position:absolute;/*must\n            have*/ top:0;/*must have*/ left:0;/*must ha";
echo "ve*/ z-index:-1;/*must have*/\n            filter:mask();/*must have*/ width: 100%;/*must have for any big value*/\n            height: 100%;/*must have for any big value*/; }\n        </style>\n        <div id=\"ly\" style=\"position: absolute; top: 0px; background-color: rgb(255, 255, 255); z-index: 2; left: 0px; display: block; width: 1354px; height: 513px; \">\n            <!--[if lte IE 6.5]>\n           ";
echo "     <iframe>\n                </iframe>\n            <![endif]-->\n        </div>\n        <!-- 浮層框架開始 -->\n        <div id=\"rs_window\" style=\"position: absolute; top: 25px; z-index: 2000; left: 427px; display: block; \">\n            <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">\n            ";
echo "<s";
echo "tyle type=\"text/css\">\n                <!-- body { margin-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom:\n                0px; } -->\n            </style>\n            ";
echo "<s";
echo "cript>\n                if (self == top) {\n                    location = '/';\n                }\n                if (window.location.host != top.location.host) {\n                    top.location = window.location;\n                }\n            </script>\n            <link href=\"../images/Index.css\" rel=\"stylesheet\" type=\"text/css\">\n            <table width=\"530\" border=\"0\" cellpadding=\"0\" cellspacing=\"";
echo "0\">\n                <form action=\"edit_plate.php?plate_id=";
echo $plate_id;
echo "\" method=\"post\" name=\"testFrm\" id=\"testFrm\">               \n                <tbody>\n                    <tr class=\"header\">\n                        <td height=\"30\" background=\"../images/tab_05.gif\">\n                            <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n                                <tbody>\n                                    <tr>\n                                        <td width=";
echo "\"12\" height=\"30\">\n                                            <img src=\"../images/tab_03.gif\" width=\"12\" height=\"30\">\n                                        </td>\n                                        <td>\n                                            <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n                                                <tbody>\n                                ";
echo "                    <tr>\n                                                        <td width=\"87%\" valign=\"middle\">\n                                                            <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n                                                                <tbody>\n                                                                    <tr class=\"header\">\n                      ";
echo "                                                  <td width=\"3%\">\n                                                                            <div align=\"center\">\n                                                                                <img src=\"../images/tb.gif\" width=\"16\" height=\"16\">\n                                                                            </div>\n                          ";
echo "                                              </td>\n                                                                        <td width=\"43%\" class=\"F_bold\">\n                                                                            &nbsp;修改期数－&gt;（\n                                                                            ";
echo "<s";
echo "pan>\n                                                                                ";
echo $plates[plate_num];
echo "                                                                            </span>\n                                                                            ）\n                                                                        </td>\n                                                                        <td width=\"47%\" align=\"left\" class=\"F_bold\">\n                                             ";
echo "                           </td>\n                                                                        <td width=\"7%\" align=\"right\" class=\"F_bold\">\n                                                                            <a href=\"his.php\" >\n                                                                                <img src=\"../images/icon_21x21_del.gif\" width=\"16\" height=\"16\" border=\"0\">\n   ";
echo "                                                                         </a>\n                                                                        </td>\n                                                                    </tr>\n                                                                </tbody>\n                                                            </table>\n                                 ";
echo "                       </td>\n                                                    </tr>\n                                                </tbody>\n                                            </table>\n                                        </td>\n                                        <td width=\"16\">\n                                            <img src=\"../images/tab_07.gif\" width=\"16\" height=\"30\">\n        ";
echo "                                </td>\n                                    </tr>\n                                </tbody>\n                            </table>\n                        </td>\n                    </tr>\n                    <tr>\n                        <td>\n                            <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n                                <tbody>\n          ";
echo "                          <tr>\n                                        <td width=\"8\" background=\"../images/tab_12.gif\">\n                                            &nbsp;\n                                        </td>\n                                        <td height=\"50\" align=\"center\">\n                                            <!-- 開始 -->\n                                            <div id=\"result";
echo "\">\n                                                <table width=\"99%\" border=\"0\" cellpadding=\"1\" cellspacing=\"1\" class=\"Ball_List\"\n                                                bordercolor=\"#ECE9D8\">\n                                                    <tbody>\n                                                        <tr>\n                                                            <td width=\"18%\" heigh";
echo "t=\"30\" align=\"right\" bordercolor=\"#CCCCCC\" class=\"t_Edit_caption\">\n                                                                期数\n                                                            </td>\n                                                            <td width=\"82%\" align=\"left\" bordercolor=\"#CCCCCC\" bgcolor=\"#FFFFFF\">\n                                                                <input ";
echo "name=\"plate_num\" type=\"text\" class=\"input1\" id=\"num\" value=\"";
echo $plates[plate_num];
echo "\" readonly=\"readonly\">\n                                                            </td>\n                                                        </tr>\n                                                        <tr>\n                                                            <td height=\"30\" align=\"center\" nowrap=\"nowrap\" bordercolor=\"#CCCCCC\" bgcolor=\"#FFFFFF\"\n                                             ";
echo "               class=\"t_Edit_caption\">\n                                                                開獎時間\n                                                            </td>\n                                                            <td height=\"30\" align=\"left\" bordercolor=\"#CCCCCC\" bgcolor=\"#FFFFFF\">\n                                                                <input name=\"plate_time_lottery";
echo "\" type=\"text\" class=\"input1\" id=\"times\" value=\"";
echo $plates[plate_time_lottery];
echo "\"\n                                                                size=\"35\" onFocus=\"WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})\"> \n                                                            </td>\n                                                        </tr>\n                                                        <tr>\n                                                            <td height=\"30\" align=";
echo "\"center\" bordercolor=\"#CCCCCC\" bgcolor=\"#FFFFFF\"\n                                                            class=\"t_Edit_caption\">\n                                                                開獎球號\n                                                            </td>\n                                                            <td height=\"30\" bordercolor=\"#CCCCCC\" bgcolor=\"#FFFFFF\">\n             ";
echo "                                                   <table border=\"0\" cellpadding=\"1\" cellspacing=\"1\" bordercolor=\"f1f1f1\"\n                                                                class=\"Ball_List\">\n                                                                    <tbody>\n                                                                        <tr class=\"td_caption_1\">\n                        ";
echo "                                                    <td height=\"25\" align=\"center\">\n                                                                                千\n                                                                            </td>\n                                                                            <td height=\"25\" align=\"center\">\n                                             ";
echo "                                   百\n                                                                            </td>\n                                                                            <td height=\"25\" align=\"center\">\n                                                                                十\n                                                                            </td>\n        ";
echo "                                                                    <td height=\"25\" align=\"center\">\n                                                                                个\n                                                                            </td>\n                                                                            <td height=\"25\" align=\"center\">\n                             ";
echo "                                                   特别号\n                                                                            </td>\n                                                                            <td height=\"25\" align=\"center\">\n                                                                                球6\n                                                                         ";
echo "   </td>\n                                                                            <td height=\"25\" align=\"center\">\n                                                                                球7\n                                                                            </td>\n                                                                        </tr>\n                                          ";
echo "                              <tr>\n                                                                            <td height=\"25\" align=\"center\" bgcolor=\"#FFFFFF\">\n                                                                                ";
echo "<s";
echo "elect name=\"num_a\" id=\"no1\">\n                                                                                    ";
$i = 0;
for ( ;	$i < 10;	++$i	)
{
		echo "                                                                                    ";
		$i = $i < 10 && 0 < $i ? $i : $i;
		echo "                                                                                    <option value=\"";
		echo $i;
		echo "\" ";
		if ( $i == $plates[num_a] )
		{
				echo "selected=\"selected\" style=\"color:ff0000\"";
		}
		echo ">\n                                                                                        &nbsp;";
		echo $i;
		echo "&nbsp;\n                                                                                    </option>\n                                                                                    ";
}
echo "                                                                                \n                                                                                </select>\n                                                                            </td>\n                                                                            <td height=\"25\" align=\"center\" bgcolor=\"#FFFFFF\">\n                        ";
echo "                                                        ";
echo "<s";
echo "elect name=\"num_b\" id=\"no2\">\n                                                                                    ";
$j = 0;
for ( ;	$j < 10;	++$j	)
{
		echo "                                                                                    ";
		$j = $j < 10 && 0 < $j ?$j : $j;
		echo "                                                                                    <option value=\"";
		echo $j;
		echo "\" ";
		if ( $j == $plates[num_b] )
		{
				echo "selected=\"selected\" style=\"color:ff0000\"";
		}
		echo ">\n                                                                                        &nbsp;";
		echo $j;
		echo "&nbsp;\n                                                                                    </option>\n                                                                                    ";
}
echo "                                                                                </select>\n                                                                            </td>\n                                                                            <td height=\"25\" align=\"center\" bgcolor=\"#FFFFFF\">\n                                                                                ";
echo "<s";
echo "elect name=\"num_c\" id=\"no3\">\n                                                                                    ";
$k = 0;
for ( ;	$k < 10;	++$k	)
{
		echo "                                                                                    ";
		$k = $k < 10 && 0 < $k ? $k : $k;
		echo "                                                                                    <option value=\"";
		echo $k;
		echo "\" ";
		if ( $k == $plates[num_c] )
		{
				echo "selected=\"selected\" style=\"color:ff0000\"";
		}
		echo ">\n                                                                                        &nbsp;";
		echo $k;
		echo "&nbsp;\n                                                                                    </option>\n                                                                                    ";
}
echo "                                                                                </select>\n                                                                            </td>\n                                                                            <td height=\"25\" align=\"center\" bgcolor=\"#FFFFFF\">\n                                                                                ";
echo "<s";
echo "elect name=\"num_d\" id=\"no4\">\n                                                                                    ";
$l = 0;
for ( ;	$l < 10;	++$l	)
{
		echo "                                                                                    ";
		$l = $l < 10 && 0 < $l ? $l : $l;
		echo "                                                                                    <option value=\"";
		echo $l;
		echo "\" ";
		if ( $l == $plates[num_d] )
		{
				echo "selected=\"selected\" style=\"color:ff0000\"";
		}
		echo ">\n                                                                                        &nbsp;";
		echo $l;
		echo "&nbsp;\n                                                                                    </option>\n                                                                                    ";
}
echo "                                                                                </select>\n                                                                            </td>\n                                                                            <td height=\"25\" align=\"center\" bgcolor=\"#FFFFFF\">\n                                                                                ";
echo "<s";
echo "elect name=\"num_e\" id=\"no5\">\n                                                                                    ";
$m = 0;
for ( ;	$m < 10;	++$m	)
{
		echo "                                                                                    ";
		$m = $m < 10 && 0 < $m ?$m : $m;
		echo "                                                                                    <option value=\"";
		echo $m;
		echo "\" ";
		if ( $m == $plates[num_e] )
		{
				echo "selected=\"selected\" style=\"color:ff0000\"";
		}
		echo ">\n                                                                                        &nbsp;";
		echo $m;
		echo "&nbsp;\n                                                                                    </option>\n                                                                                    ";
}
echo "                                                                                </select>\n                                                                            </td>\n                                                                            <td height=\"25\" align=\"center\" bgcolor=\"#FFFFFF\">\n                                                                                ";
echo "<s";
echo "elect name=\"num_f\" id=\"no6\">\n                                                                                    ";
$n = 0;
for ( ;	$n < 10;	++$n	)
{
		echo "                                                                                    ";
		$n = $n < 10 && 0 < $n ?$n : $n;
		echo "                                                                                    <option value=\"";
		echo $n;
		echo "\" ";
		if ( $n == $plates[num_f] )
		{
				echo "selected=\"selected\" style=\"color:ff0000\"";
		}
		echo ">\n                                                                                        &nbsp;";
		echo $n;
		echo "&nbsp;\n                                                                                    </option>\n                                                                                    ";
}
echo "                                                                                </select>\n                                                                            </td>\n                                                                            <td height=\"25\" align=\"center\" bgcolor=\"#FFFFFF\">\n                                                                                ";
echo "<s";
echo "elect name=\"num_g\" id=\"no7\">\n                                                                                    ";
$o = 0;
for ( ;	$o < 10;	++$o	)
{
		echo "                                                                                    ";
		$o = $o < 10 && 0 < $o ?$o : $o;
		echo "                                                                                    <option value=\"";
		echo $o;
		echo "\" ";
		if ( $o == $plates[num_g] )
		{
				echo "selected=\"selected\" style=\"color:ff0000\"";
		}
		echo ">\n                                                                                        &nbsp;";
		echo $o;
		echo "&nbsp;\n                                                                                    </option>\n                                                                                    ";
}
echo "                                                                                </select>\n                                                                            </td>\n                                                                        </tr>\n                                                                        <tr style=\"display:none\">\n                                                                            ";
$num_a = $db->get_num_detail( $plates['animal_set_id'], $plates['num_a'] );
$num_b = $db->get_num_detail( $plates['animal_set_id'], $plates['num_b'] );
$num_c = $db->get_num_detail( $plates['animal_set_id'], $plates['num_c'] );
$num_d = $db->get_num_detail( $plates['animal_set_id'], $plates['num_d'] );
$num_e = $db->get_num_detail( $plates['animal_set_id'], $plates['num_e'] );
$num_f = $db->get_num_detail( $plates['animal_set_id'], $plates['num_f'] );
$num_g = $db->get_num_detail( $plates['animal_set_id'], $plates['num_g'] );
echo "                                                                            <td height=\"25\" align=\"center\" bgcolor=\"#FFFFFF\">\n                                                                                <input name=\"zc1\" type=\"text\" class=\"input1\" id=\"zc1\" value=\"";
echo $num_a['animal'];
echo "\" size=\"5\"\n                                                                                readonly=\"readonly\">\n                                                                            </td>\n                                                                            <td height=\"25\" align=\"center\" bgcolor=\"#FFFFFF\">\n                                                                                <in";
echo "put name=\"zc2\" type=\"text\" class=\"input1\" id=\"zc2\" value=\"";
echo $num_b['animal'];
echo "\" size=\"5\"\n                                                                                readonly=\"readonly\">\n                                                                            </td>\n                                                                            <td height=\"25\" align=\"center\" bgcolor=\"#FFFFFF\">\n                                                                                <in";
echo "put name=\"zc3\" type=\"text\" class=\"input1\" id=\"zc3\" value=\"";
echo $num_c['animal'];
echo "\" size=\"5\"\n                                                                                readonly=\"readonly\">\n                                                                            </td>\n                                                                            <td height=\"25\" align=\"center\" bgcolor=\"#FFFFFF\">\n                                                                                <in";
echo "put name=\"zc4\" type=\"text\" class=\"input1\" id=\"zc4\" value=\"";
echo $num_d['animal'];
echo "\" size=\"5\"\n                                                                                readonly=\"readonly\">\n                                                                            </td>\n                                                                            <td height=\"25\" align=\"center\" bgcolor=\"#FFFFFF\">\n                                                                                <in";
echo "put name=\"zc5\" type=\"text\" class=\"input1\" id=\"zc5\" value=\"";
echo $num_e['animal'];
echo "\" size=\"5\"\n                                                                                readonly=\"readonly\">\n                                                                            </td>\n                                                                            <td height=\"25\" align=\"center\" bgcolor=\"#FFFFFF\">\n                                                                                <in";
echo "put name=\"zc6\" type=\"text\" class=\"input1\" id=\"zc6\" value=\"";
echo $num_f['animal'];
echo "\" size=\"5\"\n                                                                                readonly=\"readonly\">\n                                                                            </td>\n                                                                            <td height=\"25\" align=\"center\" bgcolor=\"#FFFFFF\">\n                                                                                <in";
echo "put name=\"zc7\" type=\"text\" class=\"input1\" id=\"zc7\" value=\"";
echo $num_g['animal'];
echo "\" size=\"5\"\n                                                                                readonly=\"readonly\">\n                                                                            </td>\n                                                                        </tr>\n                                                                    </tbody>\n                                                      ";
echo "          </table>\n                                                            </td>\n                                                        </tr>\n                                                        <tr>\n                                                            <td height=\"30\" colspan=\"2\" align=\"center\" bordercolor=\"#CCCCCC\" bgcolor=\"#FFFFFF\">\n                                                     ";
echo "           <input type=\"submit\" name=\"Submit\" value=\"確定\" class=\"btn2\" >                                                       　\n                                                                <input type=\"button\" name=\"cancel\" value=\"取消\" class=\"btn2\" onclick=\"javascript:window.location='his.php'\">\n                                                            </td>\n                                 ";
echo "                       </tr>\n                                                    </tbody>\n                                                </table>\n                                            </div>\n                                            <!-- 結束 -->\n                                        </td>\n                                        <td width=\"8\" background=\"../images/tab_15.gif\">\n                ";
echo "                            &nbsp;\n                                        </td>\n                                    </tr>\n                                </tbody>\n                            </table>\n                        </td>\n                    </tr>\n                    <tr>\n                        <td height=\"35\" background=\"../images/tab_19.gif\">\n                            <table width=\"100%\" bord";
echo "er=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n                                <tbody>\n                                    <tr>\n                                        <td width=\"12\" height=\"35\">\n                                            <img src=\"../images/tab_18.gif\" width=\"12\" height=\"35\">\n                                        </td>\n                                        <td valign=\"top\">\n             ";
echo "                               <table width=\"100%\" height=\"30\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n                                                <tbody>\n                                                    <tr>\n                                                        <td align=\"center\">\n                                                            &nbsp;\n                                         ";
echo "               </td>\n                                                    </tr>\n                                                </tbody>\n                                            </table>\n                                        </td>\n                                        <td width=\"16\">\n                                            <img src=\"../images/tab_20.gif\" width=\"16\" height=\"35\">\n                ";
echo "                        </td>\n                                    </tr>\n                                </tbody>\n                            </table>\n                        </td>\n                    </tr>\n                </tbody>\n              </form>\n            </table>\n        </div>\n        \n    </body>\n\n</html>";
?>
