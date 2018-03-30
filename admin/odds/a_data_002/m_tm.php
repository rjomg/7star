<?php
include_once( "../../../global.php" );
include_once( "rate.class.php" );
$db = new rate0( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
$o_type = $_GET['o'];
if ( !$o_type )
{
		$o_type = 16;
}
$rate = $db->get_rate( $o_type );
$ab_rate = $db->get_rate( $o_type, "ab_content" );
$anmail = $db->get_animal_table( );
echo "<html oncontextmenu=\"return false\" xmlns=\"http://www.w3.org/1999/xhtml\">\n<head>\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=gbk\">\n</head>\n    \n<body>\n\n<link href=\"../../images/Index.css\" rel=\"stylesheet\" type=\"text/css\">\n    ";
echo "<s";
echo "tyle>\n        .yellow{\n            background-color: yellow;\n        }\n    </style>\n";
echo "<s";
echo "cript src=\"../../js/jquery-1.4.3.min.js?i=0\" type=\"text/javascript\"></script>\n";
echo "<s";
echo "cript src=\"js/normal.js?i=r\" type=\"text/javascript\"></script>\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n  <tbody>\n    <tr>\n      <td background=\"../../images/tab_05.gif\" height=\"30\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n          <tbody>\n            <tr>\n              <td height=\"30\" width=\"12\"><img src=\"../../images/tab_03.gif\" height=\"30\" width=\"12\"></td>\n   ";
echo "           <td><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n                  <tbody>\n                    <tr>\n                      <td valign=\"middle\" width=\"87%\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n                          <tbody>\n                            <tr>\n                              <td width=\"1%\"><div align=\"center\"><img src=\"../../images/tb.gif\" ";
echo "height=\"16\" width=\"16\"></div></td>\n                              <td class=\"F_bold\" width=\"150\">";
echo "<s";
echo "pan id=\"ftm1\">";
echo $db->get_otype_by_oid( $o_type );
echo "</span>賠率設置</td>\n                              <td class=\"F_bold\"><button id=\"rtm1\" class=\"";
echo $o_type % 2 == 0 ? "button_a1" : "button_a";
echo "\" onClick=\"window.location.href='m_tm.php?o=";
echo $o_type % 2 == 0 ? $o_type : $o_type - 1;
echo "'\">";
echo $o_type % 2 == 0 ? $db->get_otype_by_oid( $o_type ) : $db->get_otype_by_oid( $o_type - 1 );
echo "</button>\n                                &nbsp;\n                                <button class=\"";
echo $o_type % 2 == 1 ? "button_a1" : "button_a";
echo "\" id=\"rtm2\" onClick=\"window.location.href='m_tm.php?o=";
echo $o_type % 2 == 0 ? $o_type + 1 : $o_type;
echo "'\">";
echo $o_type % 2 == 0 ? $db->get_otype_by_oid( $o_type + 1 ) : $db->get_otype_by_oid( $o_type );
echo "</button></td>\n                              <td class=\"F_bold\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\n                                  <tbody>\n                                    <tr>\n                                      <td> AB盤賠率差--&gt;&nbsp;码:\n                                        <input name=\"tmnum\" class=\"input2\" id=\"tmnum\" value=\"";
echo $ab_rate['码'];
echo "\" size=\"10\" type=\"text\">\n                                        &nbsp;双面:\n                                        <input name=\"tmxx\" class=\"input2\" id=\"tmxx\" value=\"";
echo $ab_rate['双面'];
echo "\" size=\"10\" type=\"text\"></td>\n                                      <td id=\"cc8899\" style=\"\">&nbsp;波色:\n                                        <input name=\"tmps\" class=\"input2\" id=\"tmps\" value=\"";
echo $ab_rate['波色'];
echo "\" size=\"10\" type=\"text\">\n                                        </td>\n                                      <td>&nbsp;\n                                        <input onclick=\"set_ab_rate(";
echo $o_type;
echo ")\" class=\"button_a\" value=\"設置\" type=\"button\"></td>\n                                    </tr>\n                                  </tbody>\n                                </table></td>\n                              <td class=\"F_bold\">&nbsp;</td>\n                              <td class=\"F_bold\">&nbsp;</td>\n                            </tr>\n                          </tbody>\n                        </table></td>\n";
echo "                    </tr>\n                  </tbody>\n                </table></td>\n              <td width=\"16\"><img src=\"../../images/tab_07.gif\" height=\"30\" width=\"16\"></td>\n            </tr>\n          </tbody>\n        </table></td>\n    </tr>\n    <tr>\n      <td><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n          <tbody>\n            <tr>\n              <td background=\"../../images/tab_12.gif\" ";
echo "width=\"8\">&nbsp;</td>\n              <td align=\"center\" height=\"50\"><!-- 開始  -->\n                <div id=\"result\">\n               \n                <table align=\"center\" bgcolor=\"ffffff\" border=\"0\" bordercolor=\"f1f1f1\" cellpadding=\"1\" cellspacing=\"1\" width=\"99%\" border=\"1\" bordercolor=\"#b5d6e6\" class=\"Tab\">\n                <tbody>\n                <TR class=td_caption_1>\n                    <TD bgColor=#df";
echo "efff borderColor=#cccccc noWrap style=\"background:url(../../images/bg2.gif) repeat-x 0 0  ;\" class=\"al font_size12\"><DIV align=center>NO </DIV></TD>\n                    <TD bgColor=#dfefff borderColor=#cccccc width=\"10%\" noWrap style=\"background:url(../../images/bg2.gif) repeat-x 0 0  ;\" class=\"al font_size12\"><DIV align=center>賠率/封號</DIV></TD>\n                    <TD bgColor=#dfefff borderColor=#cccc";
echo "cc width=\"7%\" noWrap align=center style=\"background:url(../../images/bg2.gif) repeat-x 0 0  ;\" class=\"al font_size12\">下註總額</TD>\n                    <TD bgColor=#dfefff borderColor=#cccccc noWrap style=\"background:url(../../images/bg2.gif) repeat-x 0 0  ;\" class=\"al font_size12\"><DIV align=center>NO </DIV></TD>\n                    <TD bgColor=#dfefff borderColor=#cccccc width=\"10%\" noWrap style=\"back";
echo "ground:url(../../images/bg2.gif) repeat-x 0 0  ;\" class=\"al font_size12\"><DIV align=center>賠率/封號</DIV></TD>\n                    <TD bgColor=#dfefff borderColor=#cccccc width=\"7%\" noWrap align=center style=\"background:url(../../images/bg2.gif) repeat-x 0 0  ;\" class=\"al font_size12\">下註總額</TD>\n                    <TD bgColor=#dfefff borderColor=#cccccc noWrap style=\"background:url(../../images/bg2";
echo ".gif) repeat-x 0 0  ;\" class=\"al font_size12\"><DIV align=center>NO </DIV></TD>\n                    <TD bgColor=#dfefff borderColor=#cccccc width=\"10%\" noWrap style=\"background:url(../../images/bg2.gif) repeat-x 0 0  ;\" class=\"al font_size12\"><DIV align=center>賠率/封號</DIV></TD>\n                    <TD bgColor=#dfefff borderColor=#cccccc width=\"7%\" noWrap align=center style=\"background:url(../../images/b";
echo "g2.gif) repeat-x 0 0  ;\" class=\"al font_size12\">下註總額</TD>\n                    <TD bgColor=#dfefff borderColor=#cccccc noWrap style=\"background:url(../../images/bg2.gif) repeat-x 0 0  ;\" class=\"al font_size12\"><DIV align=center>NO </DIV></TD>\n                    <TD bgColor=#dfefff borderColor=#cccccc width=\"10%\" noWrap style=\"background:url(../../images/bg2.gif) repeat-x 0 0  ;\" class=\"al font_size1";
echo "2\"><DIV align=center>賠率/封號</DIV></TD>\n                    <TD bgColor=#dfefff borderColor=#cccccc width=\"7%\" noWrap align=center style=\"background:url(../../images/bg2.gif) repeat-x 0 0  ;\" class=\"al font_size12\">下註總額</TD>\n                    <TD bgColor=#dfefff borderColor=#cccccc noWrap style=\"background:url(../../images/bg2.gif) repeat-x 0 0  ;\" class=\"al font_size12\"><DIV align=center>NO </DIV";
echo "></TD>\n                    <TD bgColor=#dfefff borderColor=#cccccc width=\"10%\" noWrap style=\"background:url(../../images/bg2.gif) repeat-x 0 0  ;\" class=\"al font_size12\"><DIV align=center>賠率/封號</DIV></TD>\n                    <TD bgColor=#dfefff borderColor=#cccccc width=\"7%\" noWrap align=center style=\"background:url(../../images/bg2.gif) repeat-x 0 0  ;\" class=\"al font_size12\">下註總額</TD>\n         ";
echo "         </TR>\n     ";
$i = 1;
for ( ;	$i < 11;	++$i	)
{
		echo "           \n                  <tr style=\"background-color: rgb(255, 255, 255);\" onMouseOver=\"this.style.backgroundColor='#FFFFA2'\" onMouseOut=\"this.style.backgroundColor='ffffff'\" bgcolor=\"#FFFFFF\">\n             ";
		$u = 0;
		for ( ;	$u < 5;	++$u	)
		{
				$j = $i + $u * 10;
				if ( $j < 10 )
				{
						$j = "0".$i;
				}
				if ( $j < "50" )
				{
						echo "       \n                      <td bordercolor=\"cccccc\" class=\"ball ball_";
						echo $db->get_color( $j );
						echo "\" id=\"type_";
						echo $j;
						echo "\" align=\"center\" height=\"25\">";
						echo $j;
						echo "</td>\n                    <td align=\"center\" height=\"25\">\n                        <a class=\"left_add\" onClick=\"UpdateRate(";
						echo $o_type;
						echo ",1,\$(this).next('input'),0.1);\">";
						echo "<s";
						echo "pan style=\"vertical-align:middle;\"><img src=\"../../images/bvbv_01.gif\" border=\"0\" height=\"17\" width=\"19\"></span></a>\n                        <input onblur=\"UpdateRate(";
						echo $o_type;
						echo ",1,\$(this),0);\" class=\"rate_set rate_color\" type=\"text\" style=\"width:48%;\" value=\"";
						echo $rate[$j][1];
						echo "\" />\n                        <a style=\"\" onClick=\"UpdateRate(";
						echo $o_type;
						echo ",2,\$(this).prev('input'),0.1);\">";
						echo "<s";
						echo "pan style=\"vertical-align:middle;\"><img src=\"../../images/bvbv_02.gif\" border=\"0\" height=\"17\" width=\"19\"></span></a>";
						echo "<s";
						echo "pan style=\"vertical-align:middle;\">\n                      <input onClick=\"UpdateRate(";
						echo $o_type;
						echo ",3,\$(this),0);\" class=\"num_close\" name=\"checkbox\" ";
						echo $rate[$j][2] == 1 ? "checked=\"checked\"" : "";
						echo "  value=\"TRUE\" type=\"checkbox\" />\n                      </span>\n                    </td>\n                    <td align=\"center\" height=\"25\">";
						echo "<s";
						echo "pan id=\"gold";
						echo $i - 1;
						echo " ball\"><font class=\"odd_total\" color=\"ff6400\">";
						echo $rate[$j][3];
						echo "</font></span></td>\n              ";
				}
				unset( $rate[$j] );
		}
		echo "      \n                  </tr>\n      ";
}
echo "   \n              ";
$i = 0;
foreach ( $rate as $key => $v )
{
		++$i;
		echo "                    ";
		if ( $i == 1 )
		{
				echo "                        <tr style=\"background-color: rgb(255, 255, 255);\" bgcolor=\"#FFFFFF\">\n                    ";
		}
		echo "                    ";
		if ( $i == 6 || $i == 11 )
		{
				echo "                        </tr><tr style=\"background-color: rgb(255, 255, 255);\" bgcolor=\"#FFFFFF\">\n                    ";
		}
		echo "                    <td class=\"ball\" bordercolor=\"cccccc\" align=\"center\" height=\"25\" style=\"color:";
		if ( $key == "红波" )
		{
				echo "red";
		}
		else if ( $key == "蓝波" )
		{
				echo "blue";
		}
		else if ( $key == "绿波" )
		{
				echo "green";
		}
		echo "\">";
		echo $key;
		echo "</td>\n                    <td align=\"center\" height=\"25\"><div>\n                            <a class=\"left_add\"  onClick=\"UpdateRate(";
		echo $o_type;
		echo ",1,\$(this).next('input'),0.01);\">\n                                ";
		echo "<s";
		echo "pan style=\"vertical-align:middle;\"><img src=\"../../images/bvbv_01.gif\" border=\"0\" height=\"17\" width=\"19\"></span></a>\n                            <input onblur=\"UpdateRate(";
		echo $o_type;
		echo ",1,\$(this),0);\" class=\"rate_set rate_color\" type=\"text\" style=\"width:48%;\" value=\"";
		echo $v[1];
		echo "\" />\n                            <a style=\"\"  onClick=\"UpdateRate(";
		echo $o_type;
		echo ",2,\$(this).prev('input'),0.01);\">";
		echo "<s";
		echo "pan style=\"vertical-align:middle;\"><img src=\"../../images/bvbv_02.gif\" border=\"0\" height=\"17\" width=\"19\"></span></a>";
		echo "<s";
		echo "pan style=\"vertical-align:middle;\">\n                        <input onClick=\"UpdateRate(";
		echo $o_type;
		echo ",3,\$(this),0);\" ";
		echo $v[2] == 1 ? "checked=\"checked\"" : "";
		echo " class=\"num_close\" name=\"checkbox\" style=\"\" title=\"關閉該項\" type=\"checkbox\" />\n                        </span></div></td>\n                    <td align=\"center\" height=\"25\">";
		echo "<s";
		echo "pan id=\"gold49\"><font class=\"odd_total\" color=\"ff6400\">";
		echo $v[3];
		echo "</font></span></td>\n                ";
		if ( $i == 15 )
		{
				echo "  \n                </tr>\n                 ";
				break;
		}
		echo "               ";
}
echo "                </tbody>\n        </table>\n<TABLE class=\"ball_List Tab\"  border=\"1\" bordercolor=\"#b5d6e6\"  borderColorDark=#ffffff cellPadding=2 width=\"99%\" align=center  class=\"Tab\" >\n          <tbody>\n            <tr class=\"td_caption_1\" align=\"center\">\n              <TD bgColor=#c6d0ec borderColor=#cccccc colSpan=15 height=\"25\" align=center style=\"background:url(../../images/bg2.gif) repeat-x 0 0  ;\" ";
echo "class=\"al font_size12\">";
echo "<S";
echo "TRONG>賠率調設&nbsp;</strong></td>\n            </tr>\n            <tr align=\"center\">\n                ";
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
echo "pan class=\"Font_R\">紅单</span></td>\n              <td bordercolor=\"cccccc\" align=\"left\" bgcolor=\"#FFFFFF\"><input onclick=\"select_array(\$(this));\" value=\"02,08,12,18,24,30,34,40,46\" type=\"checkbox\" />\n                ";
echo "<s";
echo "pan class=\"Font_R\">紅双</span></td>\n              <td bordercolor=\"cccccc\" align=\"left\" bgcolor=\"#FFFFFF\"><input onclick=\"select_array(\$(this));\" value=\"29,30,34,35,40,45,46\" type=\"checkbox\" />\n                ";
echo "<s";
echo "pan class=\"Font_R\">紅大</span></td>\n              <td bordercolor=\"cccccc\" align=\"left\" bgcolor=\"#FFFFFF\"><input onclick=\"select_array(\$(this));\" value=\"01,02,07,08,12,13,18,19,23,24\" type=\"checkbox\" />\n                ";
echo "<s";
echo "pan class=\"Font_R\">紅小</span></td>\n              <td bordercolor=\"cccccc\" align=\"left\" bgcolor=\"#FFFFFF\"><input onclick=\"select_array(\$(this));\" value=\"03,09,15,25,31,37,41,47\" type=\"checkbox\" />\n                ";
echo "<s";
echo "pan class=\"STYLE2\">藍单</span></td>\n              <td bordercolor=\"cccccc\" align=\"left\" bgcolor=\"#FFFFFF\"><input onclick=\"select_array(\$(this));\" value=\"04,10,14,20,26,36,42,48\" type=\"checkbox\" />\n                ";
echo "<s";
echo "pan class=\"STYLE2\">藍双</span></td>\n              <td bordercolor=\"cccccc\" align=\"left\" bgcolor=\"#FFFFFF\"><input onclick=\"select_array(\$(this));\" value=\"25,26,31,36,37,41,42,47,48\" type=\"checkbox\" />\n                ";
echo "<s";
echo "pan class=\"STYLE2\">藍大</span></td>\n              <td bordercolor=\"cccccc\" align=\"left\" bgcolor=\"#FFFFFF\"><input onclick=\"select_array(\$(this));\" value=\"03,04,09,10,14,15,20\" type=\"checkbox\" />\n                ";
echo "<s";
echo "pan class=\"STYLE2\">藍小</span></td>\n              <td bordercolor=\"cccccc\" align=\"left\" bgcolor=\"#FFFFFF\"><input onclick=\"select_array(\$(this));\" value=\"05,11,17,21,27,33,39,43,49,49\" type=\"checkbox\" />\n                ";
echo "<s";
echo "pan class=\"STYLE8\">綠单</span></td>\n              <td bordercolor=\"cccccc\" align=\"left\" bgcolor=\"#FFFFFF\"><input onclick=\"select_array(\$(this));\" value=\"06,16,22,28,32,38,44\" type=\"checkbox\" />\n                ";
echo "<s";
echo "pan class=\"STYLE8\">綠双</span></td>\n              <td bordercolor=\"cccccc\" align=\"left\" bgcolor=\"#FFFFFF\"><input onclick=\"select_array(\$(this));\" value=\"27,28,32,33,38,39,43,44,49,49\" type=\"checkbox\" />\n                ";
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
echo "pan class=\"STYLE5\">綠波</span></td>\n            </tr>\n            <tr align=\"center\">\n              <td bordercolor=\"cccccc\" align=\"left\" bgcolor=\"#FFFFFF\"><input onclick=\"select_array(\$(this));\" value=\"01,03,05,07,09,11,13,15,17,19,21,23,25,27,29,31,33,35,37,39,41,43,45,47,49\" type=\"checkbox\" />\n                单號</td>\n              <td bordercolor=\"cccccc\" align=\"left\" bgcolor=\"#FFFFFF\"><input onclick=";
echo "\"select_array(\$(this));\" value=\"02,04,06,08,10,12,14,16,18,20,22,24,26,28,30,32,34,36,38,40,42,44,46,48\" type=\"checkbox\" />\n                双號</td>\n              <td bordercolor=\"cccccc\" align=\"left\" bgcolor=\"#FFFFFF\"><input onclick=\"select_array(\$(this));\" value=\"25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49\" type=\"checkbox\" />\n                大號</td>\n              <td";
echo " bordercolor=\"cccccc\" align=\"left\" bgcolor=\"#FFFFFF\"><input onclick=\"select_array(\$(this));\" value=\"01,02,03,04,05,06,07,08,09,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24\" type=\"checkbox\" />\n                小號</td>\n              <td bordercolor=\"cccccc\" align=\"left\" bgcolor=\"#FFFFFF\"><input onclick=\"select_array(\$(this));\" value=\"01,03,05,07,09,10,12,14,16,18,21,23,25,27,29,30,32,34,36,38,41,43,45,";
echo "47,49\" type=\"checkbox\" />\n                合单</td>\n              <td bordercolor=\"cccccc\" align=\"left\" bgcolor=\"#FFFFFF\"><input onclick=\"select_array(\$(this));\" value=\"02,04,06,08,11,13,15,17,19,20,22,24,26,28,31,33,35,37,39,40,42,44,46,48\" type=\"checkbox\" />\n                合双</td>\n              <td bordercolor=\"cccccc\" align=\"left\" bgcolor=\"#FFFFFF\"><input onclick=\"select_array(\$(this));\" value=\"01";
echo ",03,05,07,09,11,13,15,17,19,21,23\" type=\"checkbox\" />\n                小单</td>\n              <td bordercolor=\"cccccc\" align=\"left\" bgcolor=\"#FFFFFF\"><input onclick=\"select_array(\$(this));\" value=\"25,27,29,31,33,35,37,39,41,43,45,47,49\" type=\"checkbox\" />\n                大单</td>\n              <td bordercolor=\"cccccc\" align=\"left\" bgcolor=\"#FFFFFF\"><input onclick=\"select_array(\$(this));\" value=\"02,04,0";
echo "6,08,10,12,14,16,18,20,22,24\" type=\"checkbox\" />\n                小双</td>\n              <td bordercolor=\"cccccc\" align=\"left\" bgcolor=\"#FFFFFF\"><input onclick=\"select_array(\$(this));\" value=\"26,28,30,32,34,36,38,40,42,44,46,48\" type=\"checkbox\" />\n                大双</td>\n              <td bordercolor=\"cccccc\" align=\"left\" bgcolor=\"#FFFFFF\"><input onclick=\"select_array(\$(this));\" value=\"01,02,03,04,05,";
echo "06,07,08,09\" type=\"checkbox\" />\n                0頭</td>\n              <td bordercolor=\"cccccc\" align=\"left\" bgcolor=\"#FFFFFF\"><input onclick=\"select_array(\$(this));\" value=\"10,11,12,13,14,15,16,17,18,19\" type=\"checkbox\" />\n                1頭</td>\n              <td bordercolor=\"cccccc\" align=\"left\" bgcolor=\"#FFFFFF\"><input onclick=\"select_array(\$(this));\" value=\"20,21,22,23,24,25,26,27,28,29\" type=\"che";
echo "ckbox\" />\n                2頭</td>\n              <td bordercolor=\"cccccc\" align=\"left\" bgcolor=\"#FFFFFF\"><input onclick=\"select_array(\$(this));\" value=\"30,31,32,33,34,35,36,37,38,39\" type=\"checkbox\" />\n                3頭</td>\n              <td bordercolor=\"cccccc\" align=\"left\" bgcolor=\"#FFFFFF\"><input onclick=\"select_array(\$(this));\" value=\"40,41,42,43,44,45,46,47,48,49\" type=\"checkbox\" />\n            ";
echo "    4頭</td>\n            </tr>\n            <tr align=\"center\">\n              <td bordercolor=\"cccccc\" align=\"left\" bgcolor=\"#FFFFFF\"><input onclick=\"select_array(\$(this));\" value=\"10,20,30,40\" type=\"checkbox\" />\n                0尾</td>\n              <td bordercolor=\"cccccc\" align=\"left\" bgcolor=\"#FFFFFF\"><input onclick=\"select_array(\$(this));\" value=\"01,11,21,31,41\" type=\"checkbox\" />\n                1尾";
echo "</td>\n              <td bordercolor=\"cccccc\" align=\"left\" bgcolor=\"#FFFFFF\"><input onclick=\"select_array(\$(this));\" value=\"02,12,22,32,42\" type=\"checkbox\" />\n                2尾</td>\n              <td bordercolor=\"cccccc\" align=\"left\" bgcolor=\"#FFFFFF\"><input onclick=\"select_array(\$(this));\" value=\"03,13,23,33,43\" type=\"checkbox\" />\n                3尾</td>\n              <td bordercolor=\"cccccc\" align=\"le";
echo "ft\" bgcolor=\"#FFFFFF\"><input onclick=\"select_array(\$(this));\" value=\"04,14,24,34,44\" type=\"checkbox\" />\n                4尾</td>\n              <td bordercolor=\"cccccc\" align=\"left\" bgcolor=\"#FFFFFF\"><input onclick=\"select_array(\$(this));\" value=\"05,15,25,35,45\" type=\"checkbox\" />\n                5尾</td>\n              <td bordercolor=\"cccccc\" align=\"left\" bgcolor=\"#FFFFFF\"><input onclick=\"select_array(\$(";
echo "this));\" value=\"06,16,26,36,46\" type=\"checkbox\" />\n                6尾</td>\n              <td bordercolor=\"cccccc\" align=\"left\" bgcolor=\"#FFFFFF\"><input onclick=\"select_array(\$(this));\" value=\"07,17,27,37,47\" type=\"checkbox\" />\n                7尾</td>\n              <td bordercolor=\"cccccc\" align=\"left\" bgcolor=\"#FFFFFF\"><input onclick=\"select_array(\$(this));\" value=\"08,18,28,38,48\" type=\"checkbox\" />\n ";
echo "               8尾</td>\n              <td bordercolor=\"cccccc\" align=\"left\" bgcolor=\"#FFFFFF\"><input onclick=\"select_array(\$(this));\" value=\"09,19,29,39,49\" type=\"checkbox\" />\n                9尾</td>\n              <td bordercolor=\"cccccc\" align=\"left\" bgcolor=\"#FFFFFF\">&nbsp;</td>\n              <td colspan=\"4\" bordercolor=\"cccccc\" align=\"left\" bgcolor=\"#FFFFFF\"><table border=\"0\" cellpadding=\"0\" cellspaci";
echo "ng=\"0\">\n                  <tbody>\n                    <tr>\n                      <td>減</td>\n                      <td><input class=\"jj\" name=\"mv\" value=\"1\" checked=\"checked\" type=\"radio\"></td>\n                      <td><input id=\"jjh\" name=\"money\" class=\"input1 rate_color\" value=\"0.5\" size=\"4\"></td>\n                      <td><input class=\"jj\" name=\"mv\" value=\"2\" type=\"radio\"></td>\n                      <td>加</";
echo "td>\n                      <td>\n                          <form id=\"f1\" action=\"set_rate.php\" method=\"post\">\n                              <input type=\"hidden\" value=\"\" name=\"ocontent\" id=\"ocontent\" />\n                              <input type=\"hidden\" value=\"";
echo $o_type;
echo "\" name=\"o_type\" id=\"o_type\" />\n                                &nbsp;<input onclick=\"return go_select(\$('.jj:checked').val(),\$('#jjh').val())\" name=\"button2\"  class=\"button_a\" value=\"送出\" type=\"submit\">\n                        </form>\n                      </td>\n                      <td>&nbsp;\n                        <input class=\"button_a\" value=\"取消\" name=\"reset\" onClick=\"unset_select();\" type=\"re";
echo "set\"></td>\n                    </tr>\n                  </tbody>\n                </table></td>\n            </tr>\n          </tbody>\n        </table>\n<form id=\"f2\" action=\"set_rate_by_all.php\" method=\"post\">\n    <input type=\"hidden\" value=\"";
echo $o_type;
echo "\" name=\"oid\" id=\"oid\" />\n        <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"99%\">\n         \n          <tbody>\n            <tr>\n              <td align=\"center\" height=\"25\">";
echo "<s";
echo "pan class=\"STYLE1\">統一修改：</span>\n                <input name=\"dx\" value=\"1\" type=\"radio\">\n                单\n                <input name=\"dx\" value=\"2\" type=\"radio\">\n                双\n                <input name=\"dx\" value=\"3\" type=\"radio\">\n                大\n                <input name=\"dx\" value=\"4\" type=\"radio\">\n                小\n                <input name=\"dx\" value=\"5\" type=\"radio\">\n        ";
echo "        紅波\n                <input name=\"dx\" value=\"6\" type=\"radio\">\n                綠波\n                <input name=\"dx\" value=\"7\" type=\"radio\">\n                藍波\n                <input name=\"dx\" value=\"8\" checked=\"checked\" type=\"radio\">\n                全部 ";
echo "<s";
echo "pan class=\"STYLE1\">賠率</span>\n                <input name=\"bl\" class=\"input1 rate_color\" id=\"bl\" style=\"height: 18px;\" value=\"0\" size=\"6\">\n                &nbsp;\n                <input onclick=\"return chk_bl(\$('#bl').val())\" class=\"button_a\" name=\"Submit22\" value=\"統一修改\" type=\"submit\"></td>\n            </tr>\n          </tbody>\n        </table>\n</form>\n        </div>\n        <!-- 結束  --></td>\n      <td b";
echo "ackground=\"../../images/tab_15.gif\" width=\"8\">&nbsp;</td>\n    </tr>\n  </tbody>\n</table>\n</td>\n</tr>\n<tr>\n  <td background=\"../../images/tab_19.gif\" height=\"35\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n      <tbody>\n        <tr>\n          <td height=\"35\" width=\"12\"><img src=\"../../images/tab_18.gif\" height=\"35\" width=\"12\"></td>\n          <td valign=\"top\"><table border=\"0\" cellpadding=\"0\" cel";
echo "lspacing=\"0\" height=\"30\" width=\"100%\">\n              <tbody>\n                <tr>\n                  <td align=\"center\">&nbsp;</td>\n                </tr>\n              </tbody>\n            </table></td>\n          <td width=\"16\"><img src=\"../../images/tab_20.gif\" height=\"35\" width=\"16\"></td>\n        </tr>\n      </tbody>\n    </table></td>\n</tr>\n</tbody>\n</table>\n</body>\n</html>";
?>
