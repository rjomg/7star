<?php
include_once( "../../global.php" );
$db = new rate( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
$db2 = new action( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
set_time_limit( 0 );
$time1 = strtotime( $_GET['time1'] );
$time2 = strtotime( $_GET['time2'] );
$jiesuan = $_GET['jiesuan'];
$leixing = $_GET['leixing'];
$qishu = $_GET['qishu'];
$is_fly = $_GET[is_fly];
$u_id = $_SESSION["uid".$c_p_seesion];
$u_power = $_SESSION["user_power".$c_p_seesion];
if ( $u_power == 1 )
{
		$tiaojian = "user_id!={$u_id}";
}
else if ( $u_power == 2 )
{
		$tiaojian = "topf_id={$u_id}";
}
else if ( $u_power == 3 )
{
		$tiaojian = "topgd_id={$u_id}";
}
else if ( $u_power == 4 )
{
		$tiaojian = "topzd_id={$u_id}";
}
else if ( $u_power == 5 )
{
		$tiaojian = "topd_id={$u_id}";
}
if ( $qishu )
{
		$tiaojian0 = " plate_num={$qishu} and ";
}
else
{
		$tiaojian0 = " {$time1}<=time and time<={$time2} and ";
}
$type1 = "特码,特码双面,正1特,正2特,正3特,正4特,正5特,正6特,正1特双面,正2特双面,正3特双面,正4特双面,正5特双面,正6特双面,正码,总和,半波,尾数,过关";
$type2 = "三全中,三中二,二全中,二中特,特串,特肖,二肖,三肖,四肖,五肖,六肖,一肖,五不中,六不中,七不中,八不中,九不中,十不中,二肖连[中],二肖连[不中],三肖连[中],三肖连[不中],四肖连[中],四肖连[不中],二尾连[中],二尾连[不中],三尾连[中],三尾连[不中],四尾连[中],四尾连[不中]";
$typearr1 = explode( ",", $type1 );
$typearr2 = explode( ",", $type2 );
if ( !empty( $leixing ) )
{
		if ( in_array( $leixing, $typearr1 ) )
		{
				$tiaojian11 = " and o_type1='{$leixing}'";
		}
		if ( in_array( $leixing, $typearr2 ) )
		{
				$tiaojian11 = " and o_type2='{$leixing}'";
		}
}
if ( empty( $is_fly ) )
{
		$tiaojian = "{$tiaojian0} ({$tiaojian} or (user_id!={$u_id} and fly_user_id like '%,{$u_id},%' and is_fly=1)) {$tiaojian11}";
}
else
{
		$tiaojian = "{$tiaojian0} user_id={$u_id} and is_fly=1 {$tiaojian11}";
}
$query = $db->select( "orders", "count(*) as c", "history_is_account={$jiesuan} and {$tiaojian}" );
$total = $db->fetch_array( $query );
$total = $total['c'];
pageft( $total, 10 );
if ( $firstcount < 0 )
{
		$firstcount = 0;
}
$zh_cxs = mysql_query( "select * from orders where history_is_account={$jiesuan} and {$tiaojian} order by time desc limit {$firstcount}, {$displaypg}" );
$zh_cxsss = mysql_query( "select * from orders where history_is_account={$jiesuan} and {$tiaojian} order by time desc" );
echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\">\n<HTML xmlns=\"http://www.w3.org/1999/xhtml\"><HEAD><META content=\"IE=5.0000\" \nhttp-equiv=\"X-UA-Compatible\">\n\n<META content=\"text/html; charset=utf-8\" http-equiv=Content-Type>\n";
echo "<S";
echo "TYLE type=text/css>BODY {\n\tMARGIN: 0px\n}\n</STYLE>\n\n";
echo "<S";
echo "CRIPT>\nif(self == top) {location = '/';} \nif(window.location.host!=top.location.host){top.location=window.location;}</SCRIPT>\n</HEAD>\n<BODY oncontextmenu=\"return false\" oncopy=document.selection.empty() \nonmouseover=\"self.status='歡迎光臨';return true\" \nonselect=document.selection.empty()><LINK rel=stylesheet \ntype=text/css href=\"../images/Index.css\">\n\n<TABLE border=0 cellSpacing=0 cellPadding=0 width=";
echo "\"100%\">\n  <TBODY>\n  <TR>\n    <TD height=30 background=../images/tab_05.gif>\n      <TABLE border=0 cellSpacing=0 cellPadding=0 width=\"100%\">\n        <TBODY>\n        <TR>\n          <TD height=30 width=12><IMG src=\"../images/tab_03.gif\" width=12 \n            height=30></TD>\n          <TD>\n            <TABLE border=0 cellSpacing=0 cellPadding=0 width=\"100%\">\n              <TBODY>\n              <TR>\n               ";
echo " <TD vAlign=middle width=\"87%\">\n                  <TABLE border=0 cellSpacing=0 cellPadding=0 width=\"100%\">\n                    <TBODY>\n                    <TR>\n                      <TD width=\"1%\">\n                        <DIV align=center><IMG src=\"../images/tb.gif\" width=16 \n                        height=16></DIV></TD>\n                      <TD class=F_bold width=\"15%\">";
echo "<S";
echo "PAN \n                        id=ftm1>[";
if ( !$leixing )
{
		echo "所有类型";
}
else
{
		echo $leixing;
}
echo "]分类</SPAN>報錶查詢</TD>\n                      <TD class=F_bold width=\"75%\"><INPUT id=type name=type \n                        value=DjU!888 type=hidden> <INPUT id=cuser name=cuser \n                        value=368 type=hidden> <INPUT id=lm name=lm value=分公司 \n                        type=hidden> <INPUT id=kithe name=kithe type=hidden> \n                       當前查詢--&gt;&gt; ";
if ( $qishu )
{
		echo " [第";
		echo $qishu;
		echo "期] ";
}
else
{
		echo " [";
		echo date( "Y-m-d", $time1 );
		echo "至";
		echo date( "Y-m-d", $time2 );
		echo "] ";
}
echo " &nbsp;&nbsp;&nbsp;&nbsp;下註類型：[";
if ( !$leixing )
{
		echo "所有类型";
}
else
{
		echo $leixing;
}
echo "]  </TD>\n                      <TD class=F_bold width=\"9%\" align=right><BUTTON \n                        class=button_a \n                    onclick=\"javascript:history.back(-1)\">返回</BUTTON></TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE></TD>\n          <TD width=16><IMG src=\"../images/tab_07.gif\" width=16 \n        height=30></TD></TR></TBODY></TABLE></TD></TR>\n  <TR>\n    <TD>\n      <TABLE border=0 cellSpacing=0 cel";
echo "lPadding=0 width=\"100%\">\n        <TBODY>\n        <TR>\n          <TD background=../images/tab_12.gif width=8>&nbsp;</TD>\n          <TD height=50 align=center><!-- 開始  -->\n            <DIV id=result><INPUT id=stype name=stype \n            value=1 type=hidden> <INPUT id=stype1 name=stype1 value=DTE!888 \n            type=hidden> <INPUT id=scuser name=scuser type=hidden> <INPUT id=slm \n            name=slm type";
echo "=hidden> \n            <TABLE class=Ball_List border=0 cellSpacing=1 borderColor=#f1f1f1 \n            cellPadding=1 width=\"99%\" bgColor=#ffffff align=center>\n              <TBODY>\n              <TR class=td_caption_1>\n                <TD bgColor=#dfefff borderColor=#cccccc noWrap>\n                  <DIV align=center>註單號碼/時間 </DIV></TD>\n                <TD bgColor=#dfefff borderColor=#cccccc noWrap>\n ";
echo "                 <DIV align=center>會員</DIV></TD>\n                <TD bgColor=#dfefff borderColor=#cccccc noWrap \n                  align=center>下註明細</TD>\n                <TD bgColor=#dfefff borderColor=#cccccc noWrap \n                align=center>期數</TD>\n                <TD bgColor=#dfefff borderColor=#cccccc noWrap \n                  align=center>會員下註</TD>\n                <TD bgColor=#dfefff bo";
echo "rderColor=#cccccc noWrap \n                  align=center>會員輸贏</TD>\n                <TD bgColor=#d9ffd9 borderColor=#cccccc width=80 \n                borderColorDark=#ffffff noWrap \n                align=center>";
echo "<S";
echo "TRONG>代理</STRONG></TD>\n                ";
if ( $_SESSION["user_power".$c_p_seesion] <= 4 )
{
		echo "                <TD bgColor=#d9ffd9 borderColor=#cccccc width=80 \n                borderColorDark=#ffffff noWrap \n                  align=center>";
		echo "<S";
		echo "TRONG>總代理</STRONG></TD>\n                ";
}
if ( $_SESSION["user_power".$c_p_seesion] <= 3 )
{
		echo "                <TD bgColor=#d9ffd9 borderColor=#cccccc width=80 \n                borderColorDark=#ffffff noWrap \n                align=center>";
		echo "<S";
		echo "TRONG>股東</STRONG></TD>\n                ";
}
if ( $_SESSION["user_power".$c_p_seesion] <= 2 )
{
		echo "                <TD bgColor=#d9ffd9 borderColor=#cccccc width=80 \n                borderColorDark=#ffffff noWrap \n                  align=center>";
		echo "<S";
		echo "TRONG>分公司</STRONG></TD>\n                ";
}
if ( $_SESSION["user_power".$c_p_seesion] == 1 )
{
		echo "                <TD bgColor=#d9ffd9 borderColor=#cccccc width=80 \n                borderColorDark=#ffffff noWrap \n                align=center>";
		echo "<S";
		echo "TRONG>公司</STRONG></TD>\n                ";
}
echo "                ";
if ( $_SESSION["user_power".$c_p_seesion] == 1 || $_SESSION["user_power".$c_p_seesion] == 5 )
{
		echo "                <TD class=Font_R bgColor=#d9ffd9 borderColor=#cccccc width=80 \n                borderColorDark=#ffffff noWrap align=center>";
		echo "<S";
		echo "TRONG>";
		if ( $db2->get_user_power_char( $_SESSION["user_power".$c_p_seesion] ) == "代理" )
		{
				echo "<span class=\"t_list_caption F_bold Font_R\">您的結果</span>";
		}
		else
		{
				echo "代理";
		}
		echo " \n                  </STRONG></TD>\n                ";
}
if ( $_SESSION["user_power".$c_p_seesion] == 1 || $_SESSION["user_power".$c_p_seesion] == 4 )
{
		echo "  \n                <TD class=Font_R bgColor=#d9ffd9 borderColor=#cccccc width=80 \n                borderColorDark=#ffffff noWrap \n                  align=center>";
		echo "<S";
		echo "TRONG>";
		if ( $db2->get_user_power_char( $_SESSION["user_power".$c_p_seesion] ) == "总代理" )
		{
				echo "<span class=\"t_list_caption F_bold Font_R\">您的結果</span>";
		}
		else
		{
				echo "總代理";
		}
		echo "</STRONG></TD>\n                ";
}
if ( $_SESSION["user_power".$c_p_seesion] == 1 || $_SESSION["user_power".$c_p_seesion] == 3 )
{
		echo "                <TD class=Font_R bgColor=#d9ffd9 borderColor=#cccccc width=80 \n                borderColorDark=#ffffff noWrap \n                align=center>";
		echo "<S";
		echo "TRONG>";
		if ( $db2->get_user_power_char( $_SESSION["user_power".$c_p_seesion] ) == "股东" )
		{
				echo "<span class=\"t_list_caption F_bold Font_R\">您的結果</span>";
		}
		else
		{
				echo "股東";
		}
		echo "</STRONG></TD>\n                ";
}
if ( $_SESSION["user_power".$c_p_seesion] == 1 || $_SESSION["user_power".$c_p_seesion] == 2 )
{
		echo "                <TD class=Font_R bgColor=#d9ffd9 borderColor=#cccccc width=80 \n                borderColorDark=#ffffff noWrap \n                  align=center>";
		echo "<S";
		echo "TRONG>";
		if ( $db2->get_user_power_char( $_SESSION["user_power".$c_p_seesion] ) == "分公司" )
		{
				echo "<span class=\"t_list_caption F_bold Font_R\">您的結果</span>";
		}
		else
		{
				echo "分公司";
		}
		echo "</STRONG></TD>\n                ";
}
echo "                ";
if ( $_SESSION["user_power".$c_p_seesion] == 1 )
{
		echo "                <TD class=\"Font_R\" bgColor=#d9ffd9 \n                borderColor=#cccccc width=80 borderColorDark=#ffffff noWrap \n                align=center>";
		if ( $db2->get_user_power_char( $_SESSION["user_power".$c_p_seesion] ) == "公司" )
		{
				echo "<span class=\"t_list_caption F_bold Font_R\">您的結果</span>";
		}
		else
		{
				echo "公司";
		}
		echo "</TD>\n                ";
}
echo "  \n              </TR>\n";
$ii = 0;
while ( $row = mysql_fetch_array( $zh_cxs ) )
{
		++$ii;
		if ( $row['is_fly'] && $row['user_id'] == 1 )
		{
				$row['tuishui_y'] = 0 - $row['tuishui_y'];
		}
		if ( $row['history_is_account'] )
		{
				if ( $row['is_win'] == 2 )
				{
						$h_shuying = 0;
				}
				else
				{
						$h_shuying = $row['shuying_y'] + $row['tuishui_y'];
				}
		}
		else
		{
				$h_shuying = $row['shuying_y'];
		}
		$zq_d_z = $db->huiyuanreport_zuanqutuishui( $row['id'], 5 );
		$zq_zd_z = $db->huiyuanreport_zuanqutuishui( $row['id'], 4 );
		$zq_gd_z = $db->huiyuanreport_zuanqutuishui( $row['id'], 3 );
		$zq_f_z = $db->huiyuanreport_zuanqutuishui( $row['id'], 2 );
		if ( !$jiesuan )
		{
				$zq_f_z = 0;
				$zq_gd_z = 0;
				$zq_zd_z = 0;
				$zq_d_z = 0;
		}
		if ( $_SESSION["user_power".$c_p_seesion] == 1 )
		{
				if ( $row['is_fly'] )
				{
						$zzz = $db->huiyuanreport_fly( $row['id'], 1 ) + ( $zq_f_z + $zq_gd_z + $zq_zd_z + $zq_d_z );
				}
				else
				{
						$zzz = round( $h_shuying * $row['g_z'] / 100, 2 ) + ( $zq_f_z + $zq_gd_z + $zq_zd_z + $zq_d_z );
				}
		}
		else if ( $_SESSION["user_power".$c_p_seesion] == 2 )
		{
				if ( $row['is_fly'] )
				{
						$zzz = $db->huiyuanreport_fly( $row['id'], 2 ) + ( $zq_gd_z + $zq_zd_z + $zq_d_z );
				}
				else
				{
						$zzz = round( $h_shuying * $row['f_z'] / 100, 2 ) + ( $zq_gd_z + $zq_zd_z + $zq_d_z );
				}
		}
		else if ( $_SESSION["user_power".$c_p_seesion] == 3 )
		{
				if ( $row['is_fly'] )
				{
						$zzz = $db->huiyuanreport_fly( $row['id'], 3 ) + ( $zq_zd_z + $zq_d_z );
				}
				else
				{
						$zzz = round( $h_shuying * $row['gd_z'] / 100, 2 ) + ( $zq_zd_z + $zq_d_z );
				}
		}
		else if ( $_SESSION["user_power".$c_p_seesion] == 4 )
		{
				if ( $row['is_fly'] )
				{
						$zzz = $db->huiyuanreport_fly( $row['id'], 4 ) + $zq_d_z;
				}
				else
				{
						$zzz = round( $h_shuying * $row['zd_z'] / 100, 2 ) + $zq_d_z;
				}
		}
		else if ( $_SESSION["user_power".$c_p_seesion] == 5 )
		{
				if ( $row['is_fly'] )
				{
						$zzz = $db->huiyuanreport_fly( $row['id'], 5 );
				}
				else
				{
						$zzz = round( $h_shuying * $row['d_z'] / 100, 2 );
				}
		}
		if ( !$jiesuan )
		{
				$zzz = 0;
		}
		echo "              <TR ";
		if ( 0 < $h_shuying )
		{
				echo "bgColor=#FFFFA2";
		}
		else
		{
				echo "onmouseover=\"javascript:this.bgColor='#D9FFD9'\" \n              onmouseout=\"javascript:this.bgColor='#ffffff'\" bgColor=#ffffff";
		}
		echo ">\n                <TD height=25 borderColor=#cccccc noWrap>\n                  <DIV align=center>";
		echo $row['id']."/".date( "Y-m-d H:i:s", $row['time'] );
		echo "</DIV></TD>\n                <TD height=25 align=center>";
		echo $db2->get_user_name( $row['user_id'] );
		echo "</TD>\n                <TD height=25 align=center>";
		echo "<S";
		echo "PAN \n                  class=jeu_XZ_Type>";
		echo $row['o_type2'];
		echo "『&nbsp;";
		echo $row['o_type3'];
		echo "&nbsp;』</SPAN> @&nbsp;";
		echo "<S";
		echo "PAN \n                  id=jeu_multiple class=jeu_multiple>";
		if ( $_SESSION["user_power".$c_p_seesion] == 1 )
		{
				echo $row['orders_p_2'];
		}
		else if ( $row['o_type2'] == "二中特" || $row['o_type2'] == "三中二" )
		{
				$max_order_p = $db2->get_max_order_p_2( $row['orders_p_2'] );
				echo $max_order_p[0][0]."|".$max_order_p[1][0];
		}
		else
		{
				echo $row['orders_p'];
		}
		echo "</SPAN></TD>\n                <TD class=jeu_OpenLottery noWrap align=center>";
		echo $row['plate_num'];
		echo "期</TD>\n                <TD height=25 align=center>";
		echo $row['orders_y'];
		echo "</TD>\n                <TD borderColor=#cccccc borderColorDark=#ffffff noWrap \n                align=center>";
		echo "<S";
		echo "PAN class=";
		if ( 0 < $h_shuying )
		{
				echo "Font_B";
		}
		else
		{
				echo "Font_R";
		}
		echo ">";
		echo $h_shuying;
		echo "</SPAN></TD>\n                <TD borderColor=#cccccc borderColorDark=#ffffff noWrap \n                align=center>";
		echo "<S";
		echo "TRONG>";
		echo $row['d_z'];
		echo "%</STRONG><BR>";
		echo $row['h_tui'];
		echo "</TD>\n                ";
		if ( $_SESSION["user_power".$c_p_seesion] <= 4 )
		{
				echo "                <TD borderColor=#cccccc borderColorDark=#ffffff noWrap \n                align=center>";
				echo "<S";
				echo "TRONG>";
				echo $row['zd_z'];
				echo "%</STRONG><BR>";
				echo $row['d_tui'];
				echo "</TD>\n                ";
		}
		if ( $_SESSION["user_power".$c_p_seesion] <= 3 )
		{
				echo "                <TD borderColor=#cccccc borderColorDark=#ffffff noWrap \n                align=center>";
				echo "<S";
				echo "TRONG>";
				echo $row['gd_z'];
				echo "%</STRONG><BR>";
				echo $row['zd_tui'];
				echo "</TD>\n                ";
		}
		if ( $_SESSION["user_power".$c_p_seesion] <= 2 )
		{
				echo "                <TD borderColor=#cccccc borderColorDark=#ffffff noWrap \n                align=center>";
				echo "<S";
				echo "TRONG>";
				echo $row['f_z'];
				echo "%</STRONG><BR>";
				echo $row['gd_tui'];
				echo "</TD>\n                ";
		}
		if ( $_SESSION["user_power".$c_p_seesion] == 1 )
		{
				echo "                <TD borderColor=#cccccc borderColorDark=#ffffff noWrap \n                align=center>";
				echo "<S";
				echo "TRONG>";
				echo $row['g_z'];
				echo "%</STRONG><BR>";
				echo $row['f_tui'];
				echo "</TD>\n                ";
		}
		echo "                ";
		if ( $_SESSION["user_power".$c_p_seesion] == 1 || $_SESSION["user_power".$c_p_seesion] == 5 )
		{
				echo "                <TD height=22 borderColor=#cccccc borderColorDark=#ffffff noWrap \n                align=right>";
				echo "<S";
				echo "PAN class=";
				if ( $h_shuying < 0 )
				{
						echo "Font_B";
				}
				else
				{
						echo "Font_R";
				}
				echo ">";
				$dz = round( $h_shuying * $row['d_z'] / 100, 2 );
				echo 0 - $dz;
				echo "</SPAN><BR>";
				echo $zq_d_z;
				echo "</TD>\n                ";
		}
		if ( $_SESSION["user_power".$c_p_seesion] == 1 || $_SESSION["user_power".$c_p_seesion] == 4 )
		{
				echo "                <TD borderColor=#cccccc borderColorDark=#ffffff noWrap \n                align=right>";
				echo "<S";
				echo "PAN>";
				echo "<S";
				echo "PAN class=";
				if ( $h_shuying < 0 )
				{
						echo "Font_B";
				}
				else
				{
						echo "Font_R";
				}
				echo ">";
				$zdz = round( $h_shuying * $row['zd_z'] / 100, 2 );
				echo 0 - $zdz;
				echo "</SPAN><BR>";
				echo $zq_zd_z;
				echo "</SPAN></TD>\n                ";
		}
		if ( $_SESSION["user_power".$c_p_seesion] == 1 || $_SESSION["user_power".$c_p_seesion] == 3 )
		{
				echo "                <TD borderColor=#cccccc borderColorDark=#ffffff noWrap \n                align=right>";
				echo "<S";
				echo "PAN>";
				echo "<S";
				echo "PAN class=";
				if ( $h_shuying < 0 )
				{
						echo "Font_B";
				}
				else
				{
						echo "Font_R";
				}
				echo ">";
				$gdz = round( $h_shuying * $row['gd_z'] / 100, 2 );
				echo 0 - $gdz;
				echo "</SPAN><BR>";
				echo $zq_gd_z;
				echo "</SPAN></TD>\n                ";
		}
		if ( $_SESSION["user_power".$c_p_seesion] == 1 || $_SESSION["user_power".$c_p_seesion] == 2 )
		{
				echo "                <TD borderColor=#cccccc borderColorDark=#ffffff noWrap \n                align=right>";
				echo "<S";
				echo "PAN>";
				echo "<S";
				echo "PAN class=";
				if ( $h_shuying < 0 )
				{
						echo "Font_B";
				}
				else
				{
						echo "Font_R";
				}
				echo ">";
				$fz = round( $h_shuying * $row['f_z'] / 100, 2 );
				echo 0 - $fz;
				echo "</SPAN><BR>";
				echo $zq_f_z;
				echo "</SPAN></TD>\n                ";
		}
		echo "                ";
		if ( $_SESSION["user_power".$c_p_seesion] == 1 )
		{
				echo "                <TD borderColor=#cccccc borderColorDark=#ffffff noWrap \n                align=right>";
				echo "<S";
				echo "PAN>";
				echo "<S";
				echo "PAN class=";
				if ( $h_shuying < 0 )
				{
						echo "Font_B";
				}
				else
				{
						echo "Font_R";
				}
				echo ">";
				echo 0 - $zzz;
				echo "</SPAN></SPAN></TD>\n                ";
		}
		echo "              </TR>             \n";
		$total_y += $row['orders_y'];
		$total_h += $h_shuying;
		$total_dz += $dz - $zq_d_z;
		$total_zdz += $zdz - $zq_zd_z;
		$total_gdz += $gdz - $zq_d_z;
		$total_fz += $fz - $zq_f_z;
		$total_gz += $zzz;
}
echo "                         ";
if ( 10 < $total )
{
		echo "              <TR style=\"BACKGROUND-COLOR: #ffffff\" \n              onmouseover=\"this.style.backgroundColor='#FFFFA2'\" \n              onmouseout=\"this.style.backgroundColor='ffffff'\" \n                bgColor=#ffffff><TD height=25 borderColor=#cccccc>&nbsp;</TD>\n                <TD height=25 align=center>当页</TD>\n                <TD height=25 align=center>";
		echo $ii;
		echo "</TD>\n                <TD align=center>&nbsp;</TD>\n                <TD height=25 align=center>";
		echo $total_y;
		echo "</TD>\n                <TD bgColor=#ffffff borderColor=#cccccc borderColorDark=#ffffff \n                noWrap align=center>";
		echo "<S";
		echo "PAN class=";
		if ( 0 < $total_h )
		{
				echo "Font_B";
		}
		else
		{
				echo "Font_R";
		}
		echo ">";
		echo $total_h;
		echo "</SPAN></TD>\n                <TD bgColor=#ffffff borderColor=#cccccc borderColorDark=#ffffff \n                noWrap align=center>&nbsp;</TD>\n                ";
		if ( $_SESSION["user_power".$c_p_seesion] <= 4 )
		{
				echo "                <TD bgColor=#ffffff borderColor=#cccccc borderColorDark=#ffffff \n                noWrap align=center>&nbsp;</TD>\n                ";
		}
		if ( $_SESSION["user_power".$c_p_seesion] <= 3 )
		{
				echo "                <TD bgColor=#ffffff borderColor=#cccccc borderColorDark=#ffffff \n                noWrap align=center>&nbsp;</TD>\n                ";
		}
		if ( $_SESSION["user_power".$c_p_seesion] <= 2 )
		{
				echo "                <TD bgColor=#ffffff borderColor=#cccccc borderColorDark=#ffffff \n                noWrap align=center>&nbsp;</TD>\n                ";
		}
		if ( $_SESSION["user_power".$c_p_seesion] == 1 )
		{
				echo "                <TD bgColor=#ffffff borderColor=#cccccc borderColorDark=#ffffff \n                noWrap align=center>&nbsp;</TD>\n                ";
		}
		echo "                ";
		if ( $_SESSION["user_power".$c_p_seesion] == 1 || $_SESSION["user_power".$c_p_seesion] == 5 )
		{
				echo "                <TD bgColor=#ffffff borderColor=#cccccc borderColorDark=#ffffff \n                noWrap align=right>";
				echo "<S";
				echo "PAN class=";
				if ( 0 < 0 - $total_dz )
				{
						echo "Font_B";
				}
				else
				{
						echo "Font_R";
				}
				echo ">";
				echo 0 - $total_dz;
				echo "</SPAN></TD>\n                ";
		}
		if ( $_SESSION["user_power".$c_p_seesion] == 1 || $_SESSION["user_power".$c_p_seesion] == 4 )
		{
				echo "                <TD bgColor=#ffffff borderColor=#cccccc borderColorDark=#ffffff \n                noWrap align=right>";
				echo "<S";
				echo "PAN class=";
				if ( 0 < 0 - $total_zdz )
				{
						echo "Font_B";
				}
				else
				{
						echo "Font_R";
				}
				echo ">";
				echo 0 - $total_zdz;
				echo "</SPAN></TD>\n                ";
		}
		if ( $_SESSION["user_power".$c_p_seesion] == 1 || $_SESSION["user_power".$c_p_seesion] == 3 )
		{
				echo "                <TD bgColor=#ffffff borderColor=#cccccc borderColorDark=#ffffff \n                noWrap align=right>";
				echo "<S";
				echo "PAN class=";
				if ( 0 < 0 - $total_gdz )
				{
						echo "Font_B";
				}
				else
				{
						echo "Font_R";
				}
				echo ">";
				echo 0 - $total_gdz;
				echo "</SPAN></TD>\n                ";
		}
		if ( $_SESSION["user_power".$c_p_seesion] == 1 || $_SESSION["user_power".$c_p_seesion] == 2 )
		{
				echo "                <TD bgColor=#ffffff borderColor=#cccccc borderColorDark=#ffffff \n                noWrap align=right>";
				echo "<S";
				echo "PAN class=";
				if ( 0 < 0 - $total_fz )
				{
						echo "Font_B";
				}
				else
				{
						echo "Font_R";
				}
				echo ">";
				echo 0 - $total_fz;
				echo "</SPAN></TD>\n                ";
		}
		echo "                ";
		if ( $_SESSION["user_power".$c_p_seesion] == 1 )
		{
				echo "                <TD bgColor=#ffffff borderColor=#cccccc borderColorDark=#ffffff \n                noWrap align=right>";
				echo "<S";
				echo "PAN class=";
				if ( 0 < 0 - $total_gz )
				{
						echo "Font_B";
				}
				else
				{
						echo "Font_R";
				}
				echo ">";
				echo 0 - $total_gz;
				echo "</SPAN></TD>\n                ";
		}
		echo "              </TR>\n           ";
}
echo " \n              \n              ";
while ( $row2 = mysql_fetch_array( $zh_cxsss ) )
{
		if ( $row2['is_fly'] && $row2['user_id'] == 1 )
		{
				$row2['tuishui_y'] = 0 - $row2['tuishui_y'];
		}
		if ( $row2['history_is_account'] )
		{
				if ( $row2['is_win'] == 2 )
				{
						$h_shuying2 = 0;
				}
				else
				{
						$h_shuying2 = $row2['shuying_y'] + $row2['tuishui_y'];
				}
		}
		else
		{
				$h_shuying2 = $row2['shuying_y'];
		}
		$zq_d_z2 = $db2->huiyuanreport_zuanqutuishui( $row2['id'], 5 );
		$zq_zd_z2 = $db2->huiyuanreport_zuanqutuishui( $row2['id'], 4 );
		$zq_gd_z2 = $db2->huiyuanreport_zuanqutuishui( $row2['id'], 3 );
		$zq_f_z2 = $db2->huiyuanreport_zuanqutuishui( $row2['id'], 2 );
		if ( !$jiesuan )
		{
				$zq_f_z2 = 0;
				$zq_gd_z2 = 0;
				$zq_zd_z2 = 0;
				$zq_d_z2 = 0;
		}
		if ( $_SESSION["user_power".$c_p_seesion] == 1 )
		{
				if ( $row2['is_fly'] )
				{
						$zzz2 = $db2->huiyuanreport_fly( $row2['id'], 1 ) + ( $zq_f_z2 + $zq_gd_z2 + $zq_zd_z2 + $zq_d_z2 );
				}
				else
				{
						$zzz2 = round( $h_shuying2 * $row2['g_z'] / 100, 2 ) + ( $zq_f_z2 + $zq_gd_z2 + $zq_zd_z2 + $zq_d_z2 );
				}
		}
		else if ( $_SESSION["user_power".$c_p_seesion] == 2 )
		{
				if ( $row2['is_fly'] )
				{
						$zzz2 = $db2->huiyuanreport_fly( $row2['id'], 2 ) + ( $zq_gd_z2 + $zq_zd_z2 + $zq_d_z2 );
				}
				else
				{
						$zzz2 = round( $h_shuying2 * $row2['f_z'] / 100, 2 ) + ( $zq_gd_z2 + $zq_zd_z2 + $zq_d_z2 );
				}
		}
		else if ( $_SESSION["user_power".$c_p_seesion] == 3 )
		{
				if ( $row2['is_fly'] )
				{
						$zzz2 = $db2->huiyuanreport_fly( $row2['id'], 3 ) + ( $zq_zd_z2 + $zq_d_z2 );
				}
				else
				{
						$zzz2 = round( $h_shuying2 * $row2['gd_z'] / 100, 2 ) + ( $zq_zd_z2 + $zq_d_z2 );
				}
		}
		else if ( $_SESSION["user_power".$c_p_seesion] == 4 )
		{
				if ( $row2['is_fly'] )
				{
						$zzz2 = $db2->huiyuanreport_fly( $row2['id'], 4 ) + $zq_d_z2;
				}
				else
				{
						$zzz2 = round( $h_shuying2 * $row2['zd_z'] / 100, 2 ) + $zq_d_z2;
				}
		}
		else if ( $_SESSION["user_power".$c_p_seesion] == 5 )
		{
				if ( $row2['is_fly'] )
				{
						$zzz2 = $db2->huiyuanreport_fly( $row2['id'], 5 );
				}
				else
				{
						$zzz2 = round( $h_shuying2 * $row2['d_z'] / 100, 2 );
				}
		}
		if ( !$jiesuan )
		{
				$zzz2 = 0;
		}
		echo "                ";
		if ( $_SESSION["user_power".$c_p_seesion] == 1 || $_SESSION["user_power".$c_p_seesion] == 5 )
		{
				echo "                ";
				$dz2 = round( $h_shuying2 * $row2['d_z'] / 100, 2 );
				echo "                ";
		}
		if ( $_SESSION["user_power".$c_p_seesion] == 1 || $_SESSION["user_power".$c_p_seesion] == 4 )
		{
				echo "                ";
				$zdz2 = round( $h_shuying2 * $row2['zd_z'] / 100, 2 );
				echo "                ";
		}
		if ( $_SESSION["user_power".$c_p_seesion] == 1 || $_SESSION["user_power".$c_p_seesion] == 3 )
		{
				echo "                ";
				$gdz2 = round( $h_shuying2 * $row2['gd_z'] / 100, 2 );
				echo "                ";
		}
		if ( $_SESSION["user_power".$c_p_seesion] == 1 || $_SESSION["user_power".$c_p_seesion] == 2 )
		{
				echo "                ";
				$fz2 = round( $h_shuying2 * $row2['f_z'] / 100, 2 );
				echo "                ";
		}
		echo "           \n";
		$total_y2 += $row2['orders_y'];
		$total_h2 += $h_shuying2;
		$total_dz2 += $dz2 - $zq_d_z2;
		$total_zdz2 += $zdz2 - $zq_zd_z2;
		$total_gdz2 += $gdz2 - $zq_gd_z2;
		$total_fz2 += $fz2 - $zq_f_z2;
		$total_gz2 += $zzz2;
}
echo "              <TR style=\"BACKGROUND-COLOR: #ffffff\" \n              onmouseover=\"this.style.backgroundColor='#FFFFA2'\" \n              onmouseout=\"this.style.backgroundColor='ffffff'\" \n                bgColor=#ffffff><TD height=25 borderColor=#cccccc>&nbsp;</TD>\n                <TD height=25 align=center>總計</TD>\n                <TD height=25 align=center>";
echo $total;
echo "</TD>\n                <TD align=center>&nbsp;</TD>\n                <TD height=25 align=center>";
echo $total_y2;
echo "</TD>\n                <TD bgColor=#ffffff borderColor=#cccccc borderColorDark=#ffffff \n                noWrap align=center>";
echo "<S";
echo "PAN class=";
if ( 0 < $total_h2 )
{
		echo "Font_B";
}
else
{
		echo "Font_R";
}
echo ">";
echo $total_h2;
echo "</SPAN></TD>\n                <TD bgColor=#ffffff borderColor=#cccccc borderColorDark=#ffffff \n                noWrap align=center>&nbsp;</TD>\n                ";
if ( $_SESSION["user_power".$c_p_seesion] <= 4 )
{
		echo "                <TD bgColor=#ffffff borderColor=#cccccc borderColorDark=#ffffff \n                noWrap align=center>&nbsp;</TD>\n                ";
}
if ( $_SESSION["user_power".$c_p_seesion] <= 3 )
{
		echo "                <TD bgColor=#ffffff borderColor=#cccccc borderColorDark=#ffffff \n                noWrap align=center>&nbsp;</TD>\n                ";
}
if ( $_SESSION["user_power".$c_p_seesion] <= 2 )
{
		echo "                <TD bgColor=#ffffff borderColor=#cccccc borderColorDark=#ffffff \n                noWrap align=center>&nbsp;</TD>\n                ";
}
if ( $_SESSION["user_power".$c_p_seesion] == 1 )
{
		echo "                <TD bgColor=#ffffff borderColor=#cccccc borderColorDark=#ffffff \n                noWrap align=center>&nbsp;</TD>\n                ";
}
echo "                ";
if ( $_SESSION["user_power".$c_p_seesion] == 1 || $_SESSION["user_power".$c_p_seesion] == 5 )
{
		echo "                <TD bgColor=#ffffff borderColor=#cccccc borderColorDark=#ffffff \n                noWrap align=right>";
		echo "<S";
		echo "PAN class=";
		if ( 0 < 0 - $total_dz2 )
		{
				echo "Font_B";
		}
		else
		{
				echo "Font_R";
		}
		echo ">";
		echo 0 - round( $total_dz2, 2 );
		echo "</SPAN></TD>\n                ";
}
if ( $_SESSION["user_power".$c_p_seesion] == 1 || $_SESSION["user_power".$c_p_seesion] == 4 )
{
		echo "                <TD bgColor=#ffffff borderColor=#cccccc borderColorDark=#ffffff \n                noWrap align=right>";
		echo "<S";
		echo "PAN class=";
		if ( 0 < 0 - $total_zdz2 )
		{
				echo "Font_B";
		}
		else
		{
				echo "Font_R";
		}
		echo ">";
		echo 0 - round( $total_zdz2, 2 );
		echo "</SPAN></TD>\n                ";
}
if ( $_SESSION["user_power".$c_p_seesion] == 1 || $_SESSION["user_power".$c_p_seesion] == 3 )
{
		echo "                <TD bgColor=#ffffff borderColor=#cccccc borderColorDark=#ffffff \n                noWrap align=right>";
		echo "<S";
		echo "PAN class=";
		if ( 0 < 0 - $total_gdz2 )
		{
				echo "Font_B";
		}
		else
		{
				echo "Font_R";
		}
		echo ">";
		echo 0 - round( $total_gdz2, 2 );
		echo "</SPAN></TD>\n                ";
}
if ( $_SESSION["user_power".$c_p_seesion] == 1 || $_SESSION["user_power".$c_p_seesion] == 2 )
{
		echo "                <TD bgColor=#ffffff borderColor=#cccccc borderColorDark=#ffffff \n                noWrap align=right>";
		echo "<S";
		echo "PAN class=";
		if ( 0 < 0 - $total_fz2 )
		{
				echo "Font_B";
		}
		else
		{
				echo "Font_R";
		}
		echo ">";
		echo 0 - round( $total_fz2, 2 );
		echo "</SPAN></TD>\n                ";
}
echo "                ";
if ( $_SESSION["user_power".$c_p_seesion] == 1 )
{
		echo "                <TD bgColor=#ffffff borderColor=#cccccc borderColorDark=#ffffff \n                noWrap align=right>";
		echo "<S";
		echo "PAN class=";
		if ( 0 < 0 - $total_gz2 )
		{
				echo "Font_B";
		}
		else
		{
				echo "Font_R";
		}
		echo ">";
		echo 0 - round( $total_gz2, 2 );
		echo "</SPAN></TD>\n                ";
}
echo "              </TR>\n              \n              \n              </TBODY></TABLE><INPUT id=summ \n            name=summ value=&nbsp; type=hidden> </DIV><!-- 結束  --></TD>\n          <TD background=../images/tab_15.gif \n    width=8>&nbsp;</TD></TR></TBODY></TABLE></TD></TR>\n  <TR>\n    <TD height=35 background=../images/tab_19.gif>\n      <TABLE border=0 cellSpacing=0 cellPadding=0 width=\"100%\">\n        <TBODY>\n        ";
echo "<TR>\n          <TD height=35 width=12><IMG src=\"../images/tab_18.gif\" width=12 \n            height=35></TD>\n          <TD vAlign=top>\n            <TABLE border=0 cellSpacing=0 cellPadding=0 width=\"100%\" \n              height=30><TBODY>\n              <TR>\n                <TD align=center>";
echo "<S";
echo "PAN \n            id=ftm2>";
echo $pagenav;
echo "</SPAN></TD></TR></TBODY></TABLE></TD>\n          <TD width=16><IMG src=\"../images/tab_20.gif\" width=16 \n        height=35></TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE></BODY></HTML>\n";
?>
