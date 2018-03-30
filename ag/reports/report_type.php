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
$u_id = $_SESSION["uid".$c_p_seesion];
$u_power = $_GET[power];
if ( empty( $u_power ) )
{
		$u_power = $_SESSION["user_power".$c_p_seesion];
}
$downname = $db2->get_user_power_char( $u_power + 1 );
$mypowername = $db2->get_user_power_char( $u_power );
if ( $u_power != 1 )
{
		$db->get_tops( $u_id );
		$user_top = $db->tops;
		$queryusers = $db->select( "users", "is_fly", "user_id={$user_top['branch']['user_id']}" );
		$user = $db->fetch_array( $queryusers );
}
if ( $u_power == 1 )
{
		$tiaojian = "user_id!={$u_id}";
		$zctj = "g_z";
}
else if ( $u_power == 2 )
{
		$tiaojian = "topf_id={$u_id}";
		$zctj = "f_z";
}
else if ( $u_power == 3 )
{
		$tiaojian = "topgd_id={$u_id}";
		$zctj = "gd_z";
}
else if ( $u_power == 4 )
{
		$tiaojian = "topzd_id={$u_id}";
		$zctj = "zd_z";
}
else if ( $u_power == 5 )
{
		$tiaojian = "topd_id={$u_id}";
		$zctj = "d_z";
}
if ( $qishu )
{
		$tiaojian0 = " plate_num={$qishu} and ";
}
else
{
		$tiaojian0 = " {$time1}<=time and time<={$time2} and ";
}
$leixingtiaojian = $tiaojian;
$typeall = "特码,特码双面,正1特,正2特,正3特,正4特,正5特,正6特,正1特双面,正2特双面,正3特双面,正4特双面,正5特双面,正6特双面,正码,总和,半波,尾数,过关,三全中,三中二,二全中,二中特,特串,特肖,二肖,三肖,四肖,五肖,六肖,一肖,五不中,六不中,七不中,八不中,九不中,十不中,二肖连[中],二肖连[不中],三肖连[中],三肖连[不中],四肖连[中],四肖连[不中],二尾连[中],二尾连[不中],三尾连[中],三尾连[不中],四尾连[中],四尾连[不中]";
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
$tiaojian = " {$tiaojian0} ({$tiaojian} or (user_id!={$u_id} and fly_user_id like '%,{$u_id},%' and is_fly=1)) {$tiaojian11}";
$zh_cxs = mysql_query( "select * from orders where history_is_account={$jiesuan} and {$tiaojian} order by time desc" );
echo "\n<HTML xmlns=\"http://www.w3.org/1999/xhtml\"><HEAD><META content=\"IE=5.0000\" http-equiv=\"X-UA-Compatible\">\n\n<META content=\"text/html; charset=utf-8\" http-equiv=Content-Type>\n";
echo "<S";
echo "TYLE type=text/css>BODY {\n\tMARGIN: 0px\n}\n</STYLE>\n\n";
echo "<S";
echo "CRIPT>\nif(self == top) {location = '/';} \nif(window.location.host!=top.location.host){top.location=window.location;}</SCRIPT>\n</HEAD>\n<BODY ><LINK rel=stylesheet type=text/css href=\"../images/Index.css\">\n<TABLE border=0 cellSpacing=0 cellPadding=0 width=\"100%\">\n<TBODY>\n<TR>\n<TD height=30 background=../images/tab_05.gif>\n<TABLE border=0 cellSpacing=0 cellPadding=0 width=\"100%\">\n<TBODY>\n<TR>\n<TD height=30 width";
echo "=12><IMG src=\"../images/tab_03.gif\" width=12 height=30></TD>\n<TD>\n<TABLE border=0 cellSpacing=0 cellPadding=0 width=\"100%\">\n<TBODY>\n<TR>\n<TD vAlign=middle width=\"87%\">\n<TABLE border=0 cellSpacing=0 cellPadding=0 width=\"100%\">\n<TBODY>\n<TR>\n<TD width=\"1%\">\n<DIV align=center><IMG src=\"../images/tb.gif\" width=16 height=16></DIV></TD>\n<TD class=F_bold width=\"15%\">";
echo "<S";
echo "PAN id=ftm1></SPAN>分類報錶查詢</TD>\n<TD class=F_bold width=\"75%\"> 當前查詢--&gt;&gt; ";
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
echo "] </TD>\n<TD class=F_bold width=\"9%\" align=right><BUTTON class=button_a onclick=\"";
if ( $one )
{
		echo "javascript:window.location='report.php'";
}
else
{
		echo "javascript:history.back(-1)";
}
echo "\">返回</BUTTON></TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE></TD>\n<TD width=16><IMG src=\"../images/tab_07.gif\" width=16 height=30></TD></TR></TBODY></TABLE></TD></TR>\n<TR>\n<TD>\n<TABLE border=0 cellSpacing=0 cellPadding=0 width=\"100%\">\n<TBODY>\n<TR>\n<TD background=../images/tab_12.gif width=8>&nbsp;</TD>\n<TD height=50 align=center><!-- 開始  --><INPUT id=stype name=stype value=0 type=hidden> <INPUT id=slm name=slm value=";
echo "[] type=hidden> \n<DIV id=result><INPUT id=stype1 name=stype1 value=0 type=hidden> <INPUT id=stype2 name=stype2 value=0 type=hidden> \n<TABLE class=Ball_List border=0 cellSpacing=1 borderColor=#f1f1f1 cellPadding=1 width=\"100%\" bgColor=#ffffff align=center>\n<TBODY>\n<TR class=td_caption_1>\n<TD bgColor=#dfefff borderColor=#cccccc width=50>\n<DIV align=center>序號</DIV></TD>\n<TD bgColor=#dfefff borderColor=#cccccc";
echo ">\n<DIV align=center>類別 </DIV></TD>\n<TD bgColor=#dfefff borderColor=#cccccc align=center>筆</TD>\n<TD bgColor=#dfefff borderColor=#cccccc align=center>下註總額</TD>\n<TD bgColor=#dfefff borderColor=#cccccc align=center>實投總額</TD>\n<TD bgColor=#dfefff borderColor=#cccccc align=center>會員輸贏</TD>\n<TD bgColor=#dfefff borderColor=#cccccc align=center>應收下綫</TD>\n<TD bgColor=#dfefff borderColor=#cccccc align=ce";
echo "nter>占成%</TD>\n<TD bgColor=#dfefff borderColor=#cccccc align=center>實占註額</TD>\n<TD bgColor=#dfefff borderColor=#cccccc align=center>實占退水</TD>\n";
if ( $u_power != 1 )
{
		echo "<TD bgColor=#dfefff borderColor=#cccccc align=center>實占結果</TD>\n<TD bgColor=#dfefff borderColor=#cccccc align=center>賺取退水</TD>\n";
}
echo "<TD bgColor=#dfefff borderColor=#cccccc align=center>實際結果</TD>\n";
if ( $u_power != 1 )
{
		echo "                \n<TD bgColor=#dfefff borderColor=#cccccc align=center>貢獻上級</TD>\n<TD bgColor=#dfefff borderColor=#cccccc align=center>應付上級</TD>\n";
}
echo "</TR>\n";
$user_arr = array( );
while ( $row = mysql_fetch_array( $zh_cxs ) )
{
		$user_arr[] = $row['user_id'];
}
echo $shizhanzhue;
$user_arrs = array_flip( array_flip( $user_arr ) );
if ( !empty( $leixing ) )
{
		$typearralls = explode( ",", $leixing );
}
else
{
		$typearralls = explode( ",", $typeall );
}
$k = 0;
foreach ( $typearralls as $key => $ts )
{
		if ( in_array( $ts, $typearr1 ) )
		{
				$tiaojian3 = "({$tiaojian} or (user_id!={$u_id} and fly_user_id like '%,{$u_id},%' and is_fly=1)) and o_type1='{$ts}'";
		}
		else if ( in_array( $ts, $typearr2 ) )
		{
				$tiaojian3 = "({$tiaojian} or (user_id!={$u_id} and fly_user_id like '%,{$u_id},%' and is_fly=1)) and o_type2='{$ts}'";
		}
		$gai_typy_orders_y = mysql_num_rows( mysql_query( "select * from orders where {$tiaojian0} history_is_account={$jiesuan} and {$tiaojian3}" ) );
		$u_query = mysql_query( "select * from orders where {$tiaojian0} history_is_account={$jiesuan} and {$tiaojian3}" );
		if ( $gai_typy_orders_y )
		{
				while ( $rowx = mysql_fetch_array( $u_query ) )
				{
						$ttt = $db->zuanqutuishui( $rowx['id'], $u_power, $rowx[$zctj] );
						$zuanqutuishui += $ttt[0];
						$shizhantuishui += $ttt[1];
						$xiajizuanqutuishui += $ttt[2];
						$d1 += $ttt[3];
						$shizhanjieguo += $ttt[4];
						$shizhanzhue += $ttt[5];
				}
				++$k;
				foreach ( $user_arrs as $us )
				{
						$user_bishu = mysql_num_rows( $u_query );
						$user_zonge = mysql_fetch_array( mysql_query( "select SUM(orders_y) as sum from orders where {$tiaojian0} history_is_account={$jiesuan} and {$tiaojian3}" ) );
						$user_tuishui = mysql_fetch_array( mysql_query( "select SUM(tuishui_y) as sum from orders where {$tiaojian0} history_is_account={$jiesuan} and {$tiaojian3}" ) );
						$user_shuying = mysql_fetch_array( mysql_query( "select SUM(shuying_y) as sum from orders where {$tiaojian0} history_is_account={$jiesuan} and {$tiaojian3}" ) );
						$user_zonge = round( $user_zonge[sum], 2 );
						$user_tuishui = round( $user_tuishui[sum], 2 );
						$user_shuying = round( $user_shuying[sum], 2 );
						$gaiusers = $db->select( "orders", "*", "user_id={$us} and {$tiaojian0} history_is_account={$jiesuan} and {$tiaojian3} limit 0,1" );
						$gaiuser = $db->fetch_array( $gaiusers );
						$db->get_tops( $us );
						$user_top = $db->tops;
						$ttts = !$jiesuan ? 0 : 0 - $zuanqutuishui;
						$xiajizuanqutuishui = !$jiesuan ? 0 : $xiajizuanqutuishui;
						$shizhanzhue1 = $user_zonge * $gaiuser['g_z'] / 100;
						$shizhanzhue2 = $user_zonge * $gaiuser['f_z'] / 100;
						$shizhanzhue3 = $user_zonge * $gaiuser['gd_z'] / 100;
						$shizhanzhue4 = $user_zonge * $gaiuser['zd_z'] / 100;
						$shizhanzhue5 = $user_zonge * $gaiuser['d_z'] / 100;
						$shijijieguo1 = !$jiesuan ? 0 : 0 - ( $user_shuying + $user_tuishui ) * $gaiuser['g_z'] / 100 + 0;
						$shijijieguo2 = !$jiesuan ? 0 : 0 - ( $user_shuying + $user_tuishui ) * $gaiuser['f_z'] / 100 + 0;
						$shijijieguo3 = !$jiesuan ? 0 : 0 - ( $user_shuying + $user_tuishui ) * $gaiuser['gd_z'] / 100 + 0;
						$shijijieguo4 = !$jiesuan ? 0 : 0 - ( $user_shuying + $user_tuishui ) * $gaiuser['zd_z'] / 100 + 0;
						$shijijieguo5 = !$jiesuan ? 0 : 0 - ( $user_shuying + $user_tuishui ) * $gaiuser['d_z'] / 100 + 0;
						if ( $u_power == 1 )
						{
								$duiying_name = $user_top['branch']['user_name'];
								$duiying_name_nick = $user_top['branch']['user_nick'];
								if ( $gaiuser['is_fly'] == 0 )
								{
										$gaiuser_percent[] = $gaiuser['g_z'];
								}
								$gongxian_top = 0;
								$yingshou_down = $d1;
						}
						else if ( $u_power == 2 )
						{
								$duiying_name = $user_top['partner']['user_name'];
								$duiying_name_nick = $user_top['partner']['user_nick'];
								if ( $gaiuser['is_fly'] == 0 )
								{
										$gaiuser_percent[] = $gaiuser['f_z'];
								}
								$gongxian_top = $shizhanzhue1;
								$yingshou_down = $shijijieguo1 + $shijijieguo2 - $xiajizuanqutuishui;
						}
						else if ( $u_power == 3 )
						{
								$duiying_name = $user_top['proxy_all']['user_name'];
								$duiying_name_nick = $user_top['proxy_all']['user_nick'];
								if ( $gaiuser['is_fly'] == 0 )
								{
										$gaiuser_percent[] = $gaiuser['gd_z'];
								}
								$gongxian_top = $shizhanzhue1 + $shizhanzhue2;
								$yingshou_down = $shijijieguo1 + $shijijieguo2 + $shijijieguo3 - $xiajizuanqutuishui;
						}
						else if ( $u_power == 4 )
						{
								$duiying_name = $user_top['proxy']['user_name'];
								$duiying_name_nick = $user_top['proxy']['user_nick'];
								if ( $gaiuser['is_fly'] == 0 )
								{
										$gaiuser_percent[] = $gaiuser['zd_z'];
								}
								$gongxian_top = $shizhanzhue1 + $shizhanzhue2 + $shizhanzhue3;
								$yingshou_down = $shijijieguo1 + $shijijieguo2 + $shijijieguo3 + $shijijieguo4 - $xiajizuanqutuishui;
						}
						else if ( $u_power == 5 )
						{
								$duiying_name = $user_top['huiyuan']['user_name'];
								$duiying_name_nick = $user_top['huiyuan']['user_nick'];
								if ( $gaiuser['is_fly'] == 0 )
								{
										$gaiuser_percent[] = $gaiuser['d_z'];
								}
								$gongxian_top = $shizhanzhue1 + $shizhanzhue2 + $shizhanzhue3 + $shizhanzhue4;
								$yingshou_down = $shijijieguo1 + $shijijieguo2 + $shijijieguo3 + $shijijieguo4 + $shijijieguo5 - $xiajizuanqutuishui;
						}
						$gongxian_top = round( $gongxian_top, 2 );
						$yingshou_down = !$jiesuan ? 0 : round( $yingshou_down, 2 );
						$shitouzonge = $user_zonge - $user_tuishui;
						$user_sy = round( !$jiesuan ? "0" : $user_shuying + $user_tuishui, 2 );
						$shizhanzhue = round( $shizhanzhue, 2 );
						$shizhanjieguo = round( !$jiesuan ? "0" : $shizhanjieguo, 2 );
						$shijijieguo = round( !$jiesuan ? 0 : $shizhanjieguo + $zuanqutuishui, 2 );
						$yingfu_top = !$jiesuan ? 0 : round( $yingshou_down - $shijijieguo, 2 );
						$shijijieguo_t = $u_power == 1 ? $yingshou_down : $shijijieguo;
						$total_sum = $user_bishu;
						$total_total = $user_zonge;
						$total_truetotal = $shitouzonge;
						$total_wl = $user_sy;
						$total_down = $yingshou_down;
						$total_occupy = $gaiuser_percent[0];
						$total_downmoney = $shizhanzhue;
						$total_back = round( $shizhantuishui, 2 );
						$total_occupyresult = $shizhanjieguo;
						$total_earn_back = round( $zuanqutuishui, 2 );
						$total_result = $shijijieguo_t;
						$total_top = $gongxian_top;
						$total_meet_top = $yingfu_top;
				}
				echo "<TR ";
				if ( 0 < $total_wl )
				{
						echo "bgColor=#FFFFA2";
				}
				else
				{
						echo "onmouseover=\"javascript:this.bgColor='#D9FFD9'\" \n              onmouseout=\"javascript:this.bgColor='#ffffff'\" bgColor=#ffffff";
				}
				echo ">    \n<TD height=25 borderColor=#cccccc>\n<DIV align=center>";
				echo $k;
				echo "</DIV></TD>\n<TD height=25 align=center>";
				echo $ts;
				echo "</TD>\n<TD height=25 align=center>";
				echo $total_sum;
				echo "</TD>\n<TD height=25 align=center><A href=\"report_huiyuan_type.php?time1=";
				echo date( "Y-m-d", $time1 );
				echo "&time2=";
				echo date( "Y-m-d", $time2 );
				echo "&jiesuan=";
				echo $jiesuan;
				echo "&leixing=";
				echo $ts;
				echo "&qishu=";
				echo $qishu;
				echo "\">";
				echo $total_total;
				echo "</A></TD>\n<TD align=center>";
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
				echo $total_occupy;
				echo "</TD>\n<TD height=25 align=center>";
				echo $total_downmoney;
				echo "</TD>\n<TD align=center>";
				echo $total_back;
				echo "</TD>\n";
				if ( $u_power != 1 )
				{
						echo "<TD align=center>";
						echo $total_occupyresult;
						echo "</TD>\n<TD align=center>";
						echo $total_earn_back;
						echo "</TD>\n";
				}
				echo "<TD align=center>";
				echo $total_result;
				echo "</TD>\n";
				if ( $u_power != 1 )
				{
						echo "<TD align=center>";
						echo $total_top;
						echo "</TD>\n<TD align=center>";
						echo 0 - $total_meet_top;
						echo "</TD>\n";
				}
				echo "</TR>\n";
				$total_sum2 += $total_sum;
				$total_total2 += $total_total;
				$total_truetotal2 += $total_truetotal;
				$total_wl2 += $total_wl;
				$total_down2 += $total_down;
				$total_downmoney2 += $total_downmoney;
				$total_back2 += $total_back;
				$total_occupyresult2 += $total_occupyresult;
				$total_earn_back2 += $total_earn_back;
				$total_result2 += $total_result;
				$total_top2 += $total_top;
				$total_meet_top2 += $total_meet_top;
		}
		unset( $ttt );
		unset( $zuanqutuishui );
		unset( $shizhantuishui );
		unset( $xiajizuanqutuishui );
		unset( $d1 );
		unset( $shizhanjieguo );
		unset( $shizhanzhue );
		unset( $gaiuser_percent );
}
echo "    \n<TR style=\"BACKGROUND-COLOR: #ffffff\" onmouseover=\"this.style.backgroundColor='#FFFFA2'\" onmouseout=\"this.style.backgroundColor='ffffff'\" bgColor=#ffffff>\n<TD height=25 borderColor=#cccccc>&nbsp;</TD>\n<TD height=25 align=center>總計</TD>\n<TD height=25 align=center>";
echo $total_sum2;
echo "</TD>\n<TD height=25 align=center>";
echo $total_total2;
echo "</TD>\n<TD align=center>";
echo $total_truetotal2;
echo "</TD>\n<TD align=center>";
echo "<S";
echo "PAN class=";
if ( 0 < $total_wl2 )
{
		echo "Font_B";
}
else
{
		echo "Font_R";
}
echo ">";
echo $total_wl2;
echo "</SPAN></TD>\n<TD align=center>";
echo $total_down2;
echo "</TD>\n<TD align=center>";
echo "</TD>\n<TD height=25 align=center>";
echo $total_downmoney2;
echo "</TD>\n<TD align=center>";
echo $total_back2;
echo "</TD>\n";
if ( $u_power != 1 )
{
		echo "<TD align=center>";
		echo $total_occupyresult2;
		echo "</TD>\n<TD align=center>";
		echo $total_earn_back2;
		echo "</TD>\n";
}
echo "<TD align=center>";
echo $total_result2;
echo "</TD>\n";
if ( $u_power != 1 )
{
		echo "<TD align=center>";
		echo $total_top2;
		echo "</TD>\n<TD align=center>";
		echo 0 - $total_meet_top2;
		echo "</TD>\n";
}
echo "</TR>\n</TBODY></TABLE>\n";
if ( !empty( $leixing ) )
{
		$typearralls_f = explode( ",", $leixing );
}
else
{
		$typearralls_f = explode( ",", $typeall );
}
$f = 0;
foreach ( $typearralls_f as $key => $fs )
{
		++$f;
		if ( in_array( $fs, $typearr1 ) )
		{
				$tiaojian3 = "o_type1='{$fs}'";
		}
		else if ( in_array( $fs, $typearr2 ) )
		{
				$tiaojian3 = "o_type2='{$fs}'";
		}
		$zoufei_query = mysql_query( "select * from orders where {$tiaojian0} history_is_account={$jiesuan} and user_id={$u_id} and is_fly=1 {$tiaojian11} and {$tiaojian3}" );
		$zoufeiusername = $db->get_user_name( $u_id );
		$zf_bishu = mysql_num_rows( $zoufei_query );
		if ( $zf_bishu )
		{
				$user_zonge_zf = mysql_fetch_array( mysql_query( "select SUM((case when user_id-1=0 then -orders_y else orders_y end)) as sum from orders where {$tiaojian0} history_is_account={$jiesuan} and user_id={$u_id} and is_fly=1 {$tiaojian11} and {$tiaojian3}" ) );
				$user_tuishui_zf = mysql_fetch_array( mysql_query( "select SUM(tuishui_y) as sum from orders where {$tiaojian0} history_is_account={$jiesuan} and user_id={$u_id} and is_fly=1 {$tiaojian11} and {$tiaojian3}" ) );
				$user_shuying_zf = mysql_fetch_array( mysql_query( "select SUM(shuying_y) as sum from orders where {$tiaojian0} history_is_account={$jiesuan} and user_id={$u_id} and is_fly=1 {$tiaojian11} and {$tiaojian3}" ) );
				$user_tuishui_zf = round( $user_tuishui_zf[sum], 2 );
				$user_shuying_zf = round( $user_shuying_zf[sum], 2 );
				if ( $u_power == 1 )
				{
						$user_zonge_zf = round( $user_zonge_zf[sum], 2 );
						$user_shuying_zf = 0 - $user_shuying_zf;
				}
				else
				{
						$user_zonge_zf = round( $user_zonge_zf[sum], 2 );
				}
				$zf_company_jieguo = !$jiesuan ? 0 : $user_shuying_zf + $user_tuishui_zf;
				echo "            \n<TABLE id=tb class=Ball_List border=0 cellSpacing=1 borderColor=#f1f1f1 borderColorDark=#ffffff cellPadding=1 width=800 align=left>\n<TBODY>\n<TR class=td_caption_1>\n<TD bgColor=#d4e5f4 height=28 borderColor=#cccccc colSpan=6 noWrap align=left>";
				echo "<S";
				echo "TRONG>";
				echo $mypowername;
				echo "走飛</STRONG></TD></TR>\n<TR class=td_caption_1>\n<TD bgColor=#d4e5f4 height=28 borderColor=#cccccc width=\"4%\" noWrap align=center>序號</TD>\n<TD bgColor=#d4e5f4 borderColor=#cccccc noWrap align=center>類別</TD>\n<TD bgColor=#d4e5f4 borderColor=#cccccc noWrap align=center>筆</TD>\n<TD bgColor=#d4e5f4 borderColor=#cccccc align=center>總下註額</TD>\n<TD bgColor=#d4e5f4 borderColor=#cccccc align=center>";
				echo $mypowername;
				echo "退水</TD>\n<TD bgColor=#d4e5f4 borderColor=#cccccc align=center>";
				echo $mypowername;
				echo "結果</TD></TR>\n    \n<TR ";
				if ( 0 < $zf_company_jieguo )
				{
						echo "bgColor=#FFFFA2";
				}
				else
				{
						echo "onmouseover=\"javascript:this.bgColor='#D9FFD9'\" \n              onmouseout=\"javascript:this.bgColor='#ffffff'\" bgColor=#ffffff";
				}
				echo ">\n<TD height=28 borderColor=#cccccc noWrap align=center>";
				echo $f;
				echo "</TD>\n<TD borderColor=#cccccc noWrap align=center>";
				echo $fs;
				echo "</TD>\n<TD borderColor=#cccccc noWrap align=center>";
				echo $zf_bishu;
				echo "</TD>\n<TD borderColor=#cccccc noWrap align=center><A href=\"report_huiyuan_type.php?time1=";
				echo date( "Y-m-d", $time1 );
				echo "&time2=";
				echo date( "Y-m-d", $time2 );
				echo "&jiesuan=";
				echo $jiesuan;
				echo "&leixing=";
				echo $leixing;
				echo "&qishu=";
				echo $qishu;
				echo "&is_fly=1\">";
				echo $user_zonge_zf;
				echo "</A></TD>\n<TD borderColor=#cccccc noWrap align=center>";
				echo 0 - $user_tuishui_zf;
				echo "</TD>\n<TD borderColor=#cccccc noWrap align=center>";
				echo $zf_company_jieguo;
				echo "</TD></TR>\n ";
				$zf_bishus += $zf_bishu;
				$user_zonge_zfs += $user_zonge_zf;
				$user_tuishui_zfs += $user_tuishui_zf;
				$zf_company_jieguos += $zf_company_jieguo;
		}
}
echo "                      \n";
if ( 0 < $zf_bishus )
{
		echo "                       \n<TR onmouseover=\"this.style.backgroundColor='#FFFFA2'\" onmouseout=\"this.style.backgroundColor='ffffff'\" bgColor=#ffffff>\n<TD height=28 borderColor=#cccccc noWrap align=center>總計</TD>\n<TD borderColor=#cccccc noWrap align=center>&nbsp;</TD>\n<TD borderColor=#cccccc noWrap align=center>";
		echo $zf_bishus;
		echo "</TD>\n<TD borderColor=#cccccc noWrap align=center>";
		echo $user_zonge_zfs;
		echo "</TD>\n<TD borderColor=#cccccc noWrap align=center>";
		echo 0 - $user_tuishui_zfs;
		echo "</TD>\n<TD borderColor=#cccccc noWrap align=center>";
		echo $zf_company_jieguos;
		echo "</TD>\n</TR>\n</TBODY></TABLE>\n\n";
}
echo "            \n</DIV><!-- 結束  --></TD>\n<TD background=../images/tab_15.gif width=8>&nbsp;</TD></TR></TBODY></TABLE></TD></TR>\n<TR>\n<TD height=35 background=../images/tab_19.gif>\n<TABLE border=0 cellSpacing=0 cellPadding=0 width=\"100%\">\n<TBODY>\n<TR>\n<TD height=35 width=12><IMG src=\"../images/tab_18.gif\" width=12 height=35></TD>\n<TD vAlign=top>  \n    <TABLE border=0 cellSpacing=0 cellPadding=0 width=\"100%\" \n           ";
echo "   height=30><TBODY>\n              <TR>\n                  ";
if ( $u_power != 1 )
{
		echo "              <TD align=center>";
		echo "<S";
		echo "PAN id=ftm2><B>占成結果：";
		echo "<S";
		echo "PAN class=Font_R>";
		echo $total_occupyresult2;
		echo " \n                  </SPAN>/　賺取退水 ";
		echo $total_earn_back2;
		echo " /　抵扣補貨及賺水後結果：";
		echo "<S";
		echo "PAN class=Font_B>";
		echo $total_result2 + $zf_company_jieguos;
		echo " \n                  </SPAN>　/　應付上級：";
		echo "<S";
		echo "PAN class=Font_G> ";
		echo 0 - ( $total_meet_top2 - $zf_company_jieguos );
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
		echo $total_result2 + $zf_company_jieguos;
		echo "</STRONG> </FONT></STRONG></SPAN></TD>\n                  ";
}
echo "              </TR></TBODY></TABLE>\n</TD>\n<TD width=16><IMG src=\"../images/tab_20.gif\" width=16 height=35></TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE></BODY></HTML>";
?>
