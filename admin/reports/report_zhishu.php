<?php
include_once( "../../global.php" );
$db = new rate( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
$db2 = new action( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
set_time_limit( 0 );
$one = $_GET['one'];
$time1 = strtotime( $_GET['time1'] );
$time2 = strtotime( $_GET['time2'] );
$jiesuan = $_GET['jiesuan'];
$leixing = $_GET['leixing'];
$qishu = $_GET['qishu'];
$u_id = $_GET[user_id];
if ( empty( $u_id ) )
{
		$u_id = $_SESSION["uid".$c_p_seesion];
}
$u_power = $_GET[power];
if ( empty( $u_power ) )
{
		$u_power = $_SESSION["user_power".$c_p_seesion];
}
$downname = $db2->get_user_power_char( $u_power + 1 );
$myname = $db2->get_user_name( $u_id );
$mypower = $db2->get_user_power( $u_id );
if ( $qishu )
{
		$tiaojian0 = " plate_num={$qishu} and ";
}
else
{
		$tiaojian0 = " {$time1}<=time and time<={$time2} and ";
}
if ( !empty( $leixing ) )
{
		$type1 = "特码,特码双面,正1特,正2特,正3特,正4特,正5特,正6特,正1特双面,正2特双面,正3特双面,正4特双面,正5特双面,正6特双面,正码,总和,半波,尾数,过关";
		$type2 = "三全中,三中二,二全中,二中特,特串,特肖,二肖,三肖,四肖,五肖,六肖,一肖,五不中,六不中,七不中,八不中,九不中,十不中,二肖连[中],二肖连[不中],三肖连[中],三肖连[不中],四肖连[中],四肖连[不中],二尾连[中],二尾连[不中],三尾连[中],三尾连[不中],四尾连[中],四尾连[不中]";
		$typearr1 = explode( ",", $type1 );
		if ( in_array( $leixing, $typearr1 ) )
		{
				$tiaojian11 = " and o_type1='{$leixing}'";
		}
		$typearr2 = explode( ",", $type2 );
		if ( in_array( $leixing, $typearr2 ) )
		{
				$tiaojian11 = " and o_type2='{$leixing}'";
		}
}
$downuser_arr = $db->lowerdownuser_arr( $u_id, $u_power, $qishu, $tiaojian0 );
echo " \n<HTML xmlns=\"http://www.w3.org/1999/xhtml\"><HEAD><META content=\"IE=5.0000\" http-equiv=\"X-UA-Compatible\">\n\n<META content=\"text/html; charset=gbk\" http-equiv=Content-Type>\n";
echo "<S";
echo "TYLE type=text/css>BODY {\n\tMARGIN: 0px\n}\n</STYLE>\n\n";
echo "<S";
echo "CRIPT>\nif(self == top) {location = '/';} \nif(window.location.host!=top.location.host){top.location=window.location;}</SCRIPT>\n</HEAD>\n<BODY oncontextmenu=\"return false\" oncopy=document.selection.empty() onmouseover=\"self.status='歡迎光臨';return true\" onselect=document.selection.empty()><LINK rel=stylesheet type=text/css href=\"../images/Index.css\">\n<TABLE border=0 cellSpacing=0 cellPadding=0 width=\"100";
echo "%\">\n<TBODY>\n<TR>\n<TD height=30 background=../images/tab_05.gif>\n<TABLE border=0 cellSpacing=0 cellPadding=0 width=\"100%\">\n<TBODY>\n<TR>\n<TD height=30 width=12><IMG src=\"../images/tab_03.gif\" width=12 height=30></TD>\n<TD>\n<TABLE border=0 cellSpacing=0 cellPadding=0 width=\"100%\">\n<TBODY>\n<TR>\n<TD vAlign=middle width=\"87%\">\n<TABLE border=0 cellSpacing=0 cellPadding=0 width=\"100%\">\n<TBODY>\n<TR>\n<TD width=\"1%\">\n<DIV align";
echo "=center><IMG src=\"../images/tb.gif\" width=16 height=16></DIV></TD>\n<TD class=F_bold width=\"15%\">";
echo "<S";
echo "PAN id=ftm1></SPAN>";
echo "[".$myname."]";
echo "直属会员報錶查詢</TD>\n<TD class=F_bold width=\"75%\">\n    <INPUT id=type name=type value=ADw!888 type=hidden> \n        <INPUT id=cuser name=cuser type=hidden> \n            <INPUT id=lm name=lm value=分公司 type=hidden>\n                <INPUT id=kithe name=kithe type=hidden>\n                    當前查詢--&gt;&gt; ";
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
echo "                        &nbsp;&nbsp;&nbsp;&nbsp;下註類型：[";
if ( !$leixing )
{
		echo "所有类型";
}
else
{
		echo $leixing;
}
echo "] </TD>\n<TD class=F_bold width=\"9%\" align=right><BUTTON class=button_a onclick=\"";
if ( $one )
{
		echo "javascript:window.location='report.php'";
}
else
{
		echo "javascript:history.back(-1)";
}
echo "\">返回</BUTTON></TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE></TD>\n<TD width=16><IMG src=\"../images/tab_07.gif\" width=16 height=30></TD></TR></TBODY></TABLE></TD></TR>\n<TR>\n<TD>\n<TABLE border=0 cellSpacing=0 cellPadding=0 width=\"100%\">\n<TBODY>\n<TR>\n<TD background=../images/tab_12.gif width=8>&nbsp;</TD>\n<TD height=50 align=center><!-- 開始  -->\n<DIV id=result><INPUT id=stype name=stype value=0 type=hidden> <INPUT id=styp";
echo "e1 name=stype1 value=ATw!888 type=hidden> <INPUT id=scuser name=scuser type=hidden> <INPUT id=slm name=slm type=hidden> \n<TABLE class=Ball_List border=0 cellSpacing=1 borderColor=#f1f1f1 cellPadding=1 width=\"100%\" bgColor=#ffffff align=center>\n<TBODY>\n<TR class=td_caption_1>\n<TD bgColor=#dfefff borderColor=#cccccc width=50>\n<DIV align=center>序號</DIV></TD>\n<TD bgColor=#dfefff borderColor=#cccccc>\n<DIV align";
echo "=center>";
echo $downname;
echo "</DIV></TD>\n<TD bgColor=#dfefff borderColor=#cccccc align=center>筆</TD>\n<TD bgColor=#dfefff borderColor=#cccccc align=center>下註總額</TD>\n<TD bgColor=#dfefff borderColor=#cccccc align=center>實投總額</TD>\n<TD bgColor=#dfefff borderColor=#cccccc align=center>會員輸贏</TD>\n<TD bgColor=#dfefff borderColor=#cccccc align=center>應收下綫</TD>\n<TD bgColor=#dfefff borderColor=#cccccc align=center>占成%</TD>\n<TD bgColo";
echo "r=#dfefff borderColor=#cccccc align=center>實占註額</TD>\n<TD bgColor=#dfefff borderColor=#cccccc align=center>實占退水</TD>\n";
if ( $u_power != 1 )
{
		echo "<TD bgColor=#dfefff borderColor=#cccccc align=center>實占結果</TD>\n<TD bgColor=#dfefff borderColor=#cccccc align=center>賺取退水</TD>\n";
}
echo "<TD bgColor=#dfefff borderColor=#cccccc align=center>實際結果</TD>\n";
if ( $u_power != 1 )
{
		echo "                \n<TD bgColor=#dfefff borderColor=#cccccc align=center>貢獻上級</TD>\n<TD bgColor=#dfefff borderColor=#cccccc align=center>應付上級</TD>\n";
}
echo "</TR>\n \n    \n";
$k = 0;
foreach ( $downuser_arr as $du => $downuser )
{
		++$k;
		$downusername = $db->get_user_name( $downuser_arr[$du], 1 );
		if ( $u_power == 1 )
		{
				$zctj = "g_z";
		}
		else if ( $u_power == 2 )
		{
				$zctj = "f_z";
		}
		else if ( $u_power == 3 )
		{
				$zctj = "gd_z";
		}
		else if ( $u_power == 4 )
		{
				$zctj = "zd_z";
		}
		else if ( $u_power == 5 )
		{
				$zctj = "d_z";
		}
		$tiaojian = "user_id={$downuser_arr[$du]}";
		$tiaojian = " {$tiaojian0} is_zhishu=1 and {$tiaojian} {$tiaojian11}";
		$u_query = mysql_query( "select * from orders where history_is_account={$jiesuan} and {$tiaojian}" );
		$user_bishu = mysql_num_rows( $u_query );
		if ( $user_bishu )
		{
				$user_arr = array( );
				while ( $row = mysql_fetch_array( $u_query ) )
				{
						$ttt = $db->zuanqutuishui( $row['id'], $u_power, $row[$zctj] );
						$zuanqutuishui += $ttt[0];
						$shizhantuishui += $ttt[1];
						$xiajizuanqutuishui += $ttt[2];
						$yingshou_down += $ttt[3];
						$shizhanjieguo += $ttt[4];
						$shizhanzhue += $ttt[5];
						$user_arr[] = $row['user_id'];
				}
				$user_arrs = array_flip( array_flip( $user_arr ) );
				foreach ( $user_arrs as $us )
				{
						$user_zonge = mysql_fetch_array( mysql_query( "select SUM(orders_y) as sum from orders where user_id={$us} and history_is_account={$jiesuan} and {$tiaojian}" ) );
						$user_tuishui = mysql_fetch_array( mysql_query( "select SUM(tuishui_y) as sum from orders where user_id={$us} and history_is_account={$jiesuan} and {$tiaojian}" ) );
						$user_shuying = mysql_fetch_array( mysql_query( "select SUM(shuying_y) as sum from orders where user_id={$us} and history_is_account={$jiesuan} and {$tiaojian}" ) );
						$user_zonge = round( $user_zonge[sum], 2 );
						$user_tuishui = round( $user_tuishui[sum], 2 );
						$user_shuying = round( $user_shuying[sum], 2 );
						$gaiusers = $db->select( "orders", "*", "user_id={$us} and history_is_account={$jiesuan} and {$tiaojian} limit 0,1" );
						$gaiuser = $db->fetch_array( $gaiusers );
						$shizhanzhue1 = $user_zonge * $gaiuser['g_z'] / 100;
						$shizhanzhue2 = $user_zonge * $gaiuser['f_z'] / 100;
						$shizhanzhue3 = $user_zonge * $gaiuser['gd_z'] / 100;
						$shizhanzhue4 = $user_zonge * $gaiuser['zd_z'] / 100;
						$shizhanzhue5 = $user_zonge * $gaiuser['d_z'] / 100;
						if ( $u_power == 1 )
						{
								$gaiuser_percent[] = $gaiuser['g_z'];
								$gongxian_top = 0;
						}
						else if ( $u_power == 2 )
						{
								$gaiuser_percent[] = $gaiuser['f_z'];
								$gongxian_top = $shizhanzhue1;
						}
						else if ( $u_power == 3 )
						{
								$gaiuser_percent[] = $gaiuser['gd_z'];
								$gongxian_top = $shizhanzhue1 + $shizhanzhue2;
						}
						else if ( $u_power == 4 )
						{
								$gaiuser_percent[] = $gaiuser['zd_z'];
								$gongxian_top = $shizhanzhue1 + $shizhanzhue2 + $shizhanzhue3;
						}
						else if ( $u_power == 5 )
						{
								$gaiuser_percent[] = $gaiuser['d_z'];
								$gongxian_top = $shizhanzhue1 + $shizhanzhue2 + $shizhanzhue3 + $shizhanzhue4;
						}
						$gongxian_top = round( $gongxian_top, 2 );
						$yingshou_down = round( $yingshou_down, 2 );
						$shitouzonge = $user_zonge - $user_tuishui;
						$user_sy = round( !$jiesuan ? "0" : $user_shuying + $user_tuishui, 2 );
						$shizhanzhue = round( $shizhanzhue, 2 );
						$shizhanjieguo = round( !$jiesuan ? "0" : $shizhanjieguo, 2 );
						$shijijieguo = round( !$jiesuan ? 0 : $shizhanjieguo + $zuanqutuishui, 2 );
						$yingfu_top = !$jiesuan ? 0 : round( $yingshou_down - $shijijieguo, 2 );
						$yingshou_down = !$jiesuan ? 0 : $yingshou_down;
						$shijijieguo_t = $u_power == 1 ? $yingshou_down : $shijijieguo;
						$user_z[$k] += $user_zonge;
						$shitouz[$k] += $shitouzonge;
						$user_s[$k] += $user_sy;
						$yingshou_d[$k] = $yingshou_down;
						$gaiuser_p[$k] = $gaiuser_percent[0];
						$shizhanz[$k] = $shizhanzhue;
						$shizhant[$k] = round( $shizhantuishui, 2 );
						$shizhanj[$k] = $shizhanjieguo;
						$gaiuser_earn_b[$k] = round( $zuanqutuishui, 2 );
						$shijijieg[$k] = $shijijieguo_t;
						$gongxian_t[$k] += $gongxian_top;
						$yingfu_t[$k] = $yingfu_top;
				}
				echo "    \n    <TR ";
				if ( 0 < $user_s[$k] )
				{
						echo "bgColor=#FFFFA2";
				}
				else
				{
						echo "onmouseover=\"javascript:this.bgColor='#D9FFD9'\" \n              onmouseout=\"javascript:this.bgColor='#ffffff'\" bgColor=#ffffff";
				}
				echo ">\n        <TD height=25 borderColor=#cccccc>\n        <DIV align=center>";
				echo $k;
				echo "</DIV></TD>\n    <TD height=25 align=center>";
				echo $downusername;
				echo "</TD>\n        <TD height=25 align=center>";
				echo $user_bishu;
				echo "</TD>\n        <TD height=25 align=center><A  href=\"";
				if ( $u_power == 5 )
				{
						echo "report_huiyuan.php";
				}
				else
				{
						echo "report_delivery.php";
				}
				echo "?power=";
				echo $u_power + 1;
				echo "&user_id=";
				echo $downuser_arr[$du];
				echo "&time1=";
				echo date( "Y-m-d", $time1 );
				echo "&time2=";
				echo date( "Y-m-d", $time2 );
				echo "&jiesuan=";
				echo $jiesuan;
				echo "&leixing=";
				echo $leixing;
				echo "&qishu=";
				echo $qishu;
				echo "\">";
				echo $user_z[$k];
				echo "</A></TD>\n        <TD align=center>";
				echo $shitouz[$k];
				echo "</TD>\n        <TD align=center>";
				echo "<S";
				echo "PAN class=";
				if ( 0 < $user_s[$k] )
				{
						echo "Font_B";
				}
				else
				{
						echo "Font_R";
				}
				echo ">";
				echo $user_s[$k];
				echo "</SPAN></TD>\n        <TD align=center>";
				echo $yingshou_d[$k];
				echo "</TD>\n        <TD align=center>";
				echo $gaiuser_p[$k];
				echo "</TD>\n        <TD height=25 align=center>";
				echo $shizhanz[$k];
				echo "</TD>\n        <TD align=center>";
				echo $shizhant[$k];
				echo "</TD>\n        ";
				if ( $u_power != 1 )
				{
						echo "        <TD align=center>";
						echo $shizhanj[$k];
						echo "</TD>\n        <TD align=center>";
						echo $gaiuser_earn_b[$k];
						echo "</TD>\n        ";
				}
				echo "        <TD align=center>";
				echo $shijijieg[$k];
				echo "</TD>\n        ";
				if ( $u_power != 1 )
				{
						echo "        <TD align=center>";
						echo $gongxian_t[$k];
						echo "</TD>\n        <TD align=center>";
						echo 0 - $yingfu_t[$k];
						echo "</TD>\n        ";
				}
				echo "  </TR> \n            ";
				$total_sum += $user_bishu;
				$total_total += $user_z[$k];
				$total_truetotal += $shitouz[$k];
				$total_wl += $user_s[$k];
				$total_down += $yingshou_d[$k];
				$total_downmoney += $shizhanz[$k];
				$total_back += $shizhant[$k];
				$total_occupyresult += $shizhanj[$k];
				$total_earn_back += $gaiuser_earn_b[$k];
				$total_result += $shijijieg[$k];
				$total_top += $gongxian_t[$k];
				$total_meet_top += $yingfu_t[$k];
		}
		unset( $ttt );
		unset( $zuanqutuishui );
		unset( $shizhantuishui );
		unset( $xiajizuanqutuishui );
		unset( $yingshou_down );
		unset( $shizhanjieguo );
		unset( $shizhanzhue );
		unset( $user_arr );
		unset( $gaiuser_percent );
}
echo "\n<TR style=\"BACKGROUND-COLOR: #ffffff\" onmouseover=\"this.style.backgroundColor='#FFFFA2'\" onmouseout=\"this.style.backgroundColor='ffffff'\" bgColor=#ffffff>\n<TD height=25 borderColor=#cccccc>&nbsp;</TD>\n<TD height=25 align=center>總計</TD>\n<TD height=25 align=center>";
echo $total_sum;
echo "</TD>\n<TD height=25 align=center>";
echo $total_total;
echo "</TD>\n<TD align=center>";
echo $total_truetotal;
echo "</TD>\n<TD align=center>";
echo "<S";
echo "PAN class=";
if ( 0 < $total_wl )
{
		echo "Font_B";
}
else
{
		echo "Font_R";
}
echo ">";
echo $total_wl;
echo "</SPAN></TD>\n<TD align=center>";
echo $total_down;
echo "</TD>\n<TD align=center>";
echo "</TD>\n<TD height=25 align=center>";
echo $total_downmoney;
echo "</TD>\n<TD align=center>";
echo $total_back;
echo " </TD>\n";
if ( $u_power != 1 )
{
		echo "<TD align=center>";
		echo $total_occupyresult;
		echo " </TD>\n<TD align=center>";
		echo $total_earn_back;
		echo " </TD>\n";
}
echo "<TD align=center>";
echo $total_result;
echo " </TD>\n";
if ( $u_power != 1 )
{
		echo "<TD align=center>";
		echo $total_top;
		echo " </TD>\n<TD align=center>";
		echo 0 - $total_meet_top;
		echo " </TD>\n";
}
echo "</TR>\n</TBODY></TABLE>\n                   \n</DIV><!-- 結束  --></TD>\n<TD background=../images/tab_15.gif width=8>&nbsp;</TD></TR></TBODY></TABLE></TD></TR>\n<TR>\n<TD height=35 background=../images/tab_19.gif>\n<TABLE border=0 cellSpacing=0 cellPadding=0 width=\"100%\">\n<TBODY>\n<TR>\n<TD height=35 width=12><IMG src=\"../images/tab_18.gif\" width=12 height=35></TD>\n<TD vAlign=top>\n    <TABLE border=0 cellSpacing=0 cellPadding=0 ";
echo "width=\"100%\" \n              height=30><TBODY>\n              <TR>\n                  ";
if ( $u_power != 1 )
{
		echo "              <TD align=center>";
		echo "<S";
		echo "PAN id=ftm2><B>占成結果：";
		echo "<S";
		echo "PAN class=Font_R>";
		if ( $jiesuan == 0 )
		{
				echo "0";
		}
		else
		{
				echo $total_occupyresult;
		}
		echo " \n                  </SPAN>/　賺取退水 ";
		echo $total_earn_back;
		echo " /　抵扣補貨及賺水後結果：";
		echo "<S";
		echo "PAN class=Font_B>";
		if ( $jiesuan == 0 )
		{
				echo "0";
		}
		else
		{
				echo $total_occupyresult + $total_earn_back;
		}
		echo " \n                  </SPAN>　/　應付上級：";
		echo "<S";
		echo "PAN class=Font_G> ";
		echo 0 - $total_meet_top;
		echo " \n              </SPAN></B></SPAN></TD>\n                  ";
}
else
{
		echo "                  <TD align=center>";
		echo "<S";
		echo "PAN id=ftm2>";
		echo "<S";
		echo "TRONG>抵扣補貨後結果：<FONT color=#ff0000> ";
		echo "<S";
		echo "TRONG>";
		if ( $jiesuan == 0 )
		{
				echo "0";
		}
		else
		{
				echo $total_result;
		}
		echo " </STRONG> </FONT></STRONG></SPAN></TD>\n                  ";
}
echo "              </TR></TBODY></TABLE>\n</TD>\n<TD width=16><IMG src=\"../images/tab_20.gif\" width=16 height=35></TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE></BODY></HTML>";
?>
