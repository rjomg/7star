<?php
include_once( "../../global.php" );
$db = new plate( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
$db2 = new plate( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
$query = $db->select( "orders", "count(*) as c", "plate_num={$_GET['plate_num']} order by time desc" );
$total = $db->fetch_array( $query );
$total = $total['c'];
pageft( $total, 18 );
if ( $firstcount < 0 )
{
		$firstcount = 0;
}
$qishus = $db->select( "orders", "*", "plate_num={$_GET['plate_num']} order by time desc limit  {$firstcount}, {$displaypg}" );
echo "<html oncontextmenu=\"return false\" xmlns=\"http://www.w3.org/1999/xhtml\">\n<head>\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=gbk\">\n";
echo "<s";
echo "tyle type=\"text/css\">\n<!--\nbody {\n\tmargin-left: 0px;\n\tmargin-top: 0px;\n\tmargin-right: 0px;\n\tmargin-bottom: 0px;\n}\n-->\n</style>\n</head>\n<body onselect=\"document.selection.empty()\" oncopy=\"document.selection.empty()\" onmouseover=\"self.status='歡迎光臨';return true\">\n<link href=\"../images/Index.css\" rel=\"stylesheet\" type=\"text/css\">\n";
echo "<s";
echo "tyle type=\"text/css\">\n<!--\n.STYLE2 {color: #0000FF}\n.STYLE5 {\n\tcolor: #006600;\n\tfont-weight: bold;\n}\n.STYLE7 {color: #0000FF; font-weight: bold; }\n.STYLE8 {color: #006600}\n.input1 {\n\tdisplay:inline-block;BACKGROUND-COLOR: #ffffff; BORDER-BOTTOM: #A7BCCB 1px solid; BORDER-LEFT: #A7BCCB 1px solid; BORDER-RIGHT: #A7BCCB 1px solid; BORDER-TOP: #A7BCCB 1px solid; FONT-FAMILY: \"Verdana\", \"Arial\", \"Helvet";
echo "ica\", \"sans-serif\"; FONT-SIZE: 12px;text-align:left;font-weight: bold;color: #990000;line-height: 15px;width: 45px;\n}\n\n.input3 {\n\tdisplay:inline-block;BACKGROUND-COLOR: #ffffff; BORDER-BOTTOM: #A7BCCB 1px solid; BORDER-LEFT: #A7BCCB 1px solid; BORDER-RIGHT: #A7BCCB 1px solid; BORDER-TOP: #A7BCCB 1px solid; FONT-FAMILY: \"Verdana\", \"Arial\", \"Helvetica\", \"sans-serif\"; FONT-SIZE: 12px;text-align:left;";
echo "font-weight: bold;color: #990000;line-height: 15px;width: 60px;\n}\n.input2 {\n\tdisplay:inline-block;BACKGROUND-COLOR: #ffffff; BORDER-BOTTOM: #A7BCCB 1px solid; BORDER-LEFT: #A7BCCB 1px solid; BORDER-RIGHT: #A7BCCB 1px solid; BORDER-TOP: #A7BCCB 1px solid; FONT-FAMILY: \"Verdana\", \"Arial\", \"Helvetica\", \"sans-serif\"; FONT-SIZE: 12px;text-align:left;font-weight: bold;color: #0000ff;line-height: 15px;wi";
echo "dth: 45px;\n}\n.cz{FONT-FAMILY: \"Verdana\", \"Arial\", \"Helvetica\", \"sans-serif\"; FONT-SIZE: 12px;text-align:left;font-weight: bold;color: #990000;}\n-->\n </style>\n\n";
echo "<s";
echo "tyle type=\"text/css\">\n#rs_windowss{ \nwidth:800px; \nheight:500px; \nfloat:left; \nmargin-left:0px; \nmargin-right:0px; \nborder:0px solid #ffffff; \noverflow:auto; overflow-x:hidden;      /*主要就是這句代码*/\nSCROLLBAR-ARROW-COLOR:#FFFFFF;\nSCROLLBAR-FACE-COLOR:#E0F3FF;\nSCROLLBAR-DARKSHADOW-COLOR:#FFFFFF;\nSCROLLBAR-HIGHLIGHT-COLOR:#FFFFFF;\nSCROLLBAR-3DLIGHT-COLOR:#FFFFFF;\nSCROLLBAR-SHADOW-COLOR:#FFFFFF;\n";
echo "SCROLLBAR-TRACK-COLOR:#FFFFFF;}\n \n   #ly {\n            width: 500px;\n            height: 200px;\n          position: absolute;\n            left: 0;\n            top: 0px;\n            border: 0px solid blue;\n            background-color: #fff;\n        }\n #ly iframe\n        {\n            display:none;/*sorry for IE5*/\n            display/**/:block;/*sorry for IE5*/\n            position:absolute;/*must";
echo " have*/\n            top:0;/*must have*/\n            left:0;/*must have*/\n            z-index:-1;/*must have*/\n            filter:mask();/*must have*/\n            width: 100%;/*must have for any big value*/\n            height: 100%;/*must have for any big value*/;\n        }\n\n</style>\n<div id=\"ly\" style=\"position: absolute; top: 0px; background-color: rgb(255, 255, 255); z-index: 2; left: 0px; display";
echo ": block; width: 1337px; height: 513px;\"> \n  <!--[if lte IE 6.5]><iframe></iframe><![endif]--> \n</div>\n<!--          浮層框架開始         -->\n<DIV style=\"Z-INDEX: 2000; POSITION: absolute; DISPLAY: block; TOP: 25px; LEFT: 300px\" id=rs_window>\n    <LINK rel=stylesheet type=text/css \nhref=\"../images/Index.css\">\n<TABLE border=0 cellSpacing=0 cellPadding=0 bgColor=#ffffff>\n  <FORM id=testFrm onsubmit=\"return Sub";
echo "Chkedit()\" method=post name=testFrm \n  action=\"\" >\n  <TBODY>\n  <TR>\n    <TD height=30 background=../images/tab_05.gif>\n      <TABLE border=0 cellSpacing=0 cellPadding=0 width=\"100%\">\n        <TBODY>\n        <TR>\n          <TD height=30 width=12><IMG \n            src=\"../images/tab_03.gif\" width=12 \n            height=30></TD>\n          <TD>\n            <TABLE border=0 cellSpacing=0 cellPadding=0 width=\"100%\"";
echo ">\n              <TBODY>\n              <TR>\n                <TD vAlign=middle width=\"87%\">\n                  <TABLE border=0 cellSpacing=0 cellPadding=0 width=\"100%\">\n                    <TBODY>\n                    <TR>\n                      <TD width=\"3%\">\n                        <DIV align=center><IMG \n                        src=\"../images/tb.gif\" width=16 \n                        height=16></DIV></TD>\n   ";
echo "                   <TD class=F_bold \n                        width=\"43%\">&nbsp;檢驗註单－&gt;（";
echo "<S";
echo "PAN>";
echo $_GET[plate_num];
echo "</SPAN>）</TD>\n                      <TD class=F_bold width=\"47%\" align=left></TD>\n                      <TD class=F_bold width=\"7%\" align=right><A \n                        onclick=close_win(); \n                        href=\"check.php?spul=XDoAXFc7A25QWF0yU2RfOA!888!888&name=CNVV9VGkDZ9R0lsLVYUAwg!888!888\"><IMG \n                        border=0 \n                        src=\"../images/icon_21x21_del.gif\" ";
echo "\n                        width=16 \n            height=16></A></TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE></TD>\n          <TD width=16><IMG \n            src=\"../images/tab_07.gif\" width=16 \n            height=30></TD></TR></TBODY></TABLE></TD></TR>\n  <TR>\n    <TD>\n      <TABLE border=0 cellSpacing=0 cellPadding=0 width=\"100%\">\n        <TBODY>\n        <TR>\n          <TD background=../images/tab_12.gif width=8>&nbsp";
echo ";</TD>\n          <TD height=50><!-- 開始  -->\n            <DIV id=rs_windowss>\n            <TABLE class=t_list border=0 cellSpacing=1 borderColor=#cccccc \n            borderColorDark=#ffffff cellPadding=1 width=\"100%\">\n              <TBODY>\n              <TR class=td_caption_1>\n                <TD class=heardertop1 bgColor=#f1f1f1 height=28 noWrap \n                align=center>会员</TD>\n                <TD ";
echo "class=heardertop1 bgColor=#f1f1f1 noWrap align=center>下单时间 \n                </TD>\n                <TD class=heardertop1 bgColor=#f1f1f1 noWrap \nalign=center>期数</TD>\n                <TD class=heardertop1 bgColor=#f1f1f1 noWrap \n                align=center>下注金额</TD>\n                <TD class=heardertop1 bgColor=#f1f1f1 noWrap \nalign=center>赔率</TD>\n                <TD class=heardertop1 bgColor=#";
echo "f1f1f1 noWrap \n                align=center>类型1</TD>\n                <TD class=heardertop1 bgColor=#f1f1f1 noWrap \n                align=center>类型2</TD>\n                <TD class=heardertop1 bgColor=#f1f1f1 noWrap \n              align=center>球号</TD></TR>\n              ";
while ( $row = $db->fetch_array( $query ) )
{
		$users = $db2->select( "users", "user_name", "user_id={$row['user_id']}" );
		$user = $db2->fetch_array( $users );
		echo "              <tr style=\"background-color: #FFF\" onMouseOver=\"this.style.background='#ffffa2'\" \n              onMouseOut=\"this.style.background='#FFF'\" align=center>\n                <td  height=\"24\">";
		echo $user[user_name];
		echo "</td>\n                <td>";
		echo date( "Y-m-d", $row[time] );
		echo "</td>\n                <td>";
		echo $row[plate_num];
		echo "</td>\n                <td>";
		echo $row[orders_y];
		echo "</td>\n                <td>";
		echo $row[orders_p];
		echo "</td>\n                <td>";
		echo $row[o_type1];
		echo "</td>\n                <td>";
		echo $row[o_type2];
		echo "</td>\n                <td>";
		echo $row[o_type3];
		echo "</td>               \n                </tr>\n                ";
}
echo "  \n              </TBODY></TABLE></DIV><!-- 結束  --></TD>\n          <TD background=../images/tab_15.gif \n    width=8>&nbsp;</TD></TR>\n        \n        </TBODY></TABLE></TD></TR>\n  <TR>\n    <TD height=35 background=../images/tab_19.gif>\n      <TABLE border=0 cellSpacing=0 cellPadding=0 width=\"100%\">\n        <TBODY>\n        <TR>\n          <TD height=35 width=12><IMG \n            src=\"../images/tab_18.gif\" width=12 \n ";
echo "           height=35></TD>\n          <TD vAlign=top>\n            <TABLE border=0 cellSpacing=0 cellPadding=0 width=\"100%\" \n              height=30><TBODY>\n              <TR>\n                <TD align=center>";
echo $pagenav;
echo "</TD></TR></TBODY></TABLE></TD>\n          <TD width=16><IMG \n            src=\"../images/tab_20.gif\" width=16 \n            height=35></TD></TR>        \n        </TBODY></TABLE></TD></TR>\n\n  </TBODY></FORM></TABLE></DIV>\n\n</body>\n</html>";
?>
