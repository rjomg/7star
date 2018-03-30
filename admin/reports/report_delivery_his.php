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
$mypowername = $db2->get_user_power_char( $u_power );
$myname = $db2->get_user_name( $u_id );
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
echo "[".$myname."]".$mypowername;
echo "報錶查詢</TD>\n<TD class=F_bold width=\"75%\">\n                    當前查詢--&gt;&gt; ";
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
echo "</TR>\n\n";
if ( 1 < $u_power )
{
		$zs = 0;
		if ( $u_power == 1 )
		{
				$zstiaojian = "id>0";
				$zctj = "g_z";
		}
		else if ( $u_power == 2 )
		{
				$zstiaojian = "topf_id={$u_id}";
				$zctj = "f_z";
		}
		else if ( $u_power == 3 )
		{
				$zstiaojian = "topgd_id={$u_id}";
				$zctj = "gd_z";
		}
		else if ( $u_power == 4 )
		{
				$zstiaojian = "topzd_id={$u_id}";
				$zctj = "zd_z";
		}
		else if ( $u_power == 5 )
		{
				$zstiaojian = "topd_id={$u_id}";
				$zctj = "d_z";
		}
		$zstiaojian = " {$tiaojian0} {$zstiaojian} and is_fly=0 {$tiaojian11}";
		$zhishu_query = mysql_query( "select * from orders where history_is_account={$jiesuan} and {$zstiaojian} and is_zhishu=1" );
		$zhishuusername = $db->get_user_name( $u_id );
		$zs_bishu = mysql_num_rows( $zhishu_query );
		$userzs_arr = array( );
		$zs_zs = $db->select( "orders", "*", "history_is_account={$jiesuan} and {$zstiaojian} and is_zhishu=1" );
		while ( $rowzs = $db->fetch_array( $zs_zs ) )
		{
				$tttzs = $db2->zuanqutuishui( $rowzs['id'], $u_power, $rowzs[$zctj] );
				$zuanqutuishui_zs += $tttzs[0];
				$shizhantuishui_zs += $tttzs[1];
				$xiajizuanqutuishui_zs += $tttzs[2];
				$yingshou_down_zs += $tttzs[3];
				$shizhanjieguo_zs += $tttzs[4];
				$shizhanzhue_zs += $tttzs[5];
				$userzs_arr[] = $rowzs['user_id'];
		}
		$userzs_arrs = array_flip( array_flip( $userzs_arr ) );
		if ( $zs_bishu )
		{
				$zs = 1;
				foreach ( $userzs_arrs as $kz => $us_zs )
				{
						$user_zonge_zs = mysql_fetch_array( mysql_query( "select SUM(orders_y) as sum from orders where user_id={$us_zs} and history_is_account={$jiesuan} and {$zstiaojian} and is_zhishu=1" ) );
						$user_tuishui_zs = mysql_fetch_array( mysql_query( "select SUM(tuishui_y) as sum from orders where user_id={$us_zs} and history_is_account={$jiesuan} and {$zstiaojian} and is_zhishu=1" ) );
						$user_shuying_zs = mysql_fetch_array( mysql_query( "select SUM(shuying_y) as sum from orders where user_id={$us_zs} and history_is_account={$jiesuan} and {$zstiaojian} and is_zhishu=1" ) );
						$user_zonge_zs = round( $user_zonge_zs[sum], 2 );
						$user_tuishui_zs = round( $user_tuishui_zs[sum], 2 );
						$user_shuying_zs = round( $user_shuying_zs[sum], 2 );
						$gaiusers_zs = $db->select( "orders", "*", "user_id={$us_zs} and history_is_account={$jiesuan} and {$zstiaojian} and is_zhishu=1 limit 0,1" );
						$gaiuser_zs = $db->fetch_array( $gaiusers_zs );
						$gaiuser_zs[else_back] = 0;
						$shizhanzhue_zs1 = $user_zonge_zs * $gaiuser_zs['g_z'] / 100;
						$shizhanzhue_zs2 = $user_zonge_zs * $gaiuser_zs['f_z'] / 100;
						$shizhanzhue_zs3 = $user_zonge_zs * $gaiuser_zs['gd_z'] / 100;
						$shizhanzhue_zs4 = $user_zonge_zs * $gaiuser_zs['zd_z'] / 100;
						$shizhanzhue_zs5 = $user_zonge_zs * $gaiuser_zs['d_z'] / 100;
						if ( $u_power == 1 )
						{
								$gaiuser_zs_percent[] = $gaiuser_zs['g_z'];
								$gongxian_top_zs = 0;
						}
						else if ( $u_power == 2 )
						{
								$gaiuser_zs_percent[] = $gaiuser_zs['f_z'];
								$gongxian_top_zs = $shizhanzhue_zs1;
						}
						else if ( $u_power == 3 )
						{
								$gaiuser_zs_percent[] = $gaiuser_zs['gd_z'];
								$gongxian_top_zs = $shizhanzhue_zs1 + $shizhanzhue_zs2;
						}
						else if ( $u_power == 4 )
						{
								$gaiuser_zs_percent[] = $gaiuser_zs['zd_z'];
								$gongxian_top_zs = $shizhanzhue_zs1 + $shizhanzhue_zs2 + $shizhanzhue_zs3;
						}
						else if ( $u_power == 5 )
						{
								$gaiuser_zs_percent[] = $gaiuser_zs['d_z'];
								$gongxian_top_zs = $shizhanzhue_zs1 + $shizhanzhue_zs2 + $shizhanzhue_zs3 + $shizhanzhue_zs4;
						}
						$shizhanzhue_zs = round( $shizhanzhue_zs, 2 );
						$shizhanjieguo_zs = round( !$jiesuan ? "0" : $shizhanjieguo_zs, 2 );
						$shijijieguo_zs = round( !$jiesuan ? 0 : $shizhanjieguo_zs + $zuanqutuishui_zs, 2 );
						$gongxian_top_zs = round( $gongxian_top_zs, 2 );
						$yingfu_top_zs = !$jiesuan ? 0 : round( $yingshou_down_zs - $shijijieguo_zs, 2 );
						$yingshou_down_zs = !$jiesuan ? 0 : round( $yingshou_down_zs, 2 );
						$shitouzonge_zs = $user_zonge_zs - $user_tuishui_zs;
						$user_sy_zs = round( !$jiesuan ? "0" : $user_shuying_zs + $user_tuishui_zs, 2 );
						$user_z_zs += $user_zonge_zs;
						$shitouz_zs += $shitouzonge_zs;
						$user_s_zs += $user_sy_zs;
						$yingshou_d_zs = $yingshou_down_zs;
						$gaiuser_zs_p_zs = $gaiuser_zs_percent[0];
						$shizhanz_zs = $shizhanzhue_zs;
						$shizhant_zs = round( $shizhantuishui_zs, 2 );
						$shizhanj_zs = $shizhanjieguo_zs;
						$gaiuser_zs_earn_b_zs = 0;
						$shijijieg_zs = $shijijieguo_zs;
						$gongxian_t_zs += $gongxian_top_zs;
						$yingfu_t_zs = $yingfu_top_zs;
						unset( $gaiuser_zs_percent );
				}
				echo "<TR ";
				if ( 0 < $user_s_zs )
				{
						echo "bgColor=#FFFFA2";
				}
				else
				{
						echo "onmouseover=\"javascript:this.bgColor='#D9FFD9'\" \n              onmouseout=\"javascript:this.bgColor='#ffffff'\" bgColor=#ffffff";
				}
				echo ">\n        <TD height=25 borderColor=#cccccc>\n        <DIV align=center>";
				echo $zs;
				echo " </DIV></TD>\n    <TD height=25 align=center>";
				echo $zhishuusername."<font color=blue>&nbsp;[直属]</font>";
				echo "</TD>\n        <TD height=25 align=center>";
				echo $zs_bishu;
				echo "</TD>\n        <TD height=25 align=center><A  href=\"report_zhishu.php?power=5&user_id=";
				echo $u_id;
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
				echo $user_z_zs;
				echo "</A></TD>\n        <TD align=center>";
				echo $shitouz_zs;
				echo "</TD>\n        <TD align=center>";
				echo "<S";
				echo "PAN class=";
				if ( 0 < $user_s_zs )
				{
						echo "Font_B";
				}
				else
				{
						echo "Font_R";
				}
				echo ">";
				echo $user_s_zs;
				echo "</SPAN></TD>\n        <TD align=center>";
				echo $yingshou_d_zs;
				echo "</TD>\n        <TD align=center>";
				echo $gaiuser_zs_p_zs;
				echo "</TD>\n        <TD height=25 align=center>";
				echo $shizhanz_zs;
				echo "</TD>\n        <TD align=center>";
				echo $shizhant_zs;
				echo "</TD>\n        ";
				if ( $u_power != 1 )
				{
						echo "        <TD align=center>";
						echo $shizhanj_zs;
						echo "</TD>\n        <TD align=center>";
						echo $gaiuser_zs_earn_b_zs;
						echo "</TD>\n        ";
				}
				echo "        <TD align=center>";
				echo $shijijieg_zs;
				echo "</TD>\n        ";
				if ( $u_power != 1 )
				{
						echo "        <TD align=center>";
						echo $gongxian_t_zs;
						echo "</TD>\n        <TD align=center>";
						echo 0 - $yingfu_t_zs;
						echo "</TD>\n        ";
				}
				echo "  </TR>                 \n ";
		}
}
echo "    \n \n   \n    \n";
$k = $zs;
foreach ( $downuser_arr as $du => $downuser )
{
		++$k;
		$downusername = $db->get_user_name( $downuser_arr[$du], 1 );
		if ( $u_power == 1 )
		{
				$tiaojian = "topf_id={$downuser_arr[$du]}";
				$zctj = "g_z";
		}
		else if ( $u_power == 2 )
		{
				$gaiuser_percent = $duiyingzhancheng['f_z'];
				$tiaojian = "topgd_id={$downuser_arr[$du]}";
				$zctj = "f_z";
		}
		else if ( $u_power == 3 )
		{
				$gaiuser_percent = $duiyingzhancheng['gd_z'];
				$tiaojian = "topzd_id={$downuser_arr[$du]}";
				$zctj = "gd_z";
		}
		else if ( $u_power == 4 )
		{
				$gaiuser_percent = $duiyingzhancheng['zd_z'];
				$tiaojian = "topd_id={$downuser_arr[$du]}";
				$zctj = "zd_z";
		}
		else if ( $u_power == 5 )
		{
				$gaiuser_percent = $duiyingzhancheng['d_z'];
				$tiaojian = "user_id={$downuser_arr[$du]}";
				$zctj = "d_z";
		}
		if ( $u_power == 1 )
		{
				$tiaojian = " {$tiaojian0} ({$tiaojian}  or ((user_id={$downuser_arr[$du]} or fly_user_id like '%,{$downuser_arr[$du]},%') and is_fly=1)) {$tiaojian11}";
		}
		else
		{
				$tiaojian = " {$tiaojian0} is_zhishu=0 and ({$tiaojian} or ((user_id={$downuser_arr[$du]} or fly_user_id like '%,{$downuser_arr[$du]},%') and is_fly=1)) {$tiaojian11}";
		}
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
						$gaiusers = $db->select( "orders", "*", "user_id={$us} and history_is_account={$jiesuan} and {$tiaojian}  limit 0,1" );
						$gaiuser = $db->fetch_array( $gaiusers );
						$shizhanzhue1 = $user_zonge * $gaiuser['g_z'] / 100;
						$shizhanzhue2 = $user_zonge * $gaiuser['f_z'] / 100;
						$shizhanzhue3 = $user_zonge * $gaiuser['gd_z'] / 100;
						$shizhanzhue4 = $user_zonge * $gaiuser['zd_z'] / 100;
						$shizhanzhue5 = $user_zonge * $gaiuser['d_z'] / 100;
						$ttts = !$jiesuan ? 0 : 0 - $zuanqutuishui;
						$xiajizuanqutuishui = !$jiesuan ? 0 : $xiajizuanqutuishui;
						$shijijieguo1 = !$jiesuan ? 0 : 0 - ( $user_shuying + $user_tuishui ) * $gaiuser['g_z'] / 100 + 0;
						$shijijieguo2 = !$jiesuan ? 0 : 0 - ( $user_shuying + $user_tuishui ) * $gaiuser['f_z'] / 100 + 0;
						$shijijieguo3 = !$jiesuan ? 0 : 0 - ( $user_shuying + $user_tuishui ) * $gaiuser['gd_z'] / 100 + 0;
						$shijijieguo4 = !$jiesuan ? 0 : 0 - ( $user_shuying + $user_tuishui ) * $gaiuser['zd_z'] / 100 + 0;
						$shijijieguo5 = !$jiesuan ? 0 : 0 - ( $user_shuying + $user_tuishui ) * $gaiuser['d_z'] / 100 + 0;
						if ( $u_power == 1 )
						{
								if ( $gaiuser['is_fly'] == 0 )
								{
										$gaiuser_percent[] = $gaiuser['g_z'];
								}
								$gongxian_top = 0;
						}
						else if ( $u_power == 2 )
						{
								if ( $gaiuser['is_fly'] == 0 )
								{
										$gaiuser_percent[] = $gaiuser['f_z'];
								}
								$gongxian_top = $shizhanzhue1;
						}
						else if ( $u_power == 3 )
						{
								if ( $gaiuser['is_fly'] == 0 )
								{
										$gaiuser_percent[] = $gaiuser['gd_z'];
								}
								$gongxian_top = $shizhanzhue1 + $shizhanzhue2;
						}
						else if ( $u_power == 4 )
						{
								if ( $gaiuser['is_fly'] == 0 )
								{
										$gaiuser_percent[] = $gaiuser['zd_z'];
								}
								$gongxian_top = $shizhanzhue1 + $shizhanzhue2 + $shizhanzhue3;
						}
						else if ( $u_power == 5 )
						{
								if ( $gaiuser['is_fly'] == 0 )
								{
										$gaiuser_percent[] = $gaiuser['d_z'];
								}
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
echo "\n<TR style=\"BACKGROUND-COLOR: #ffffff\" onmouseover=\"this.style.backgroundColor='#D9FFD9'\" onmouseout=\"this.style.backgroundColor='ffffff'\" bgColor=#ffffff>\n<TD height=25 borderColor=#cccccc>&nbsp;</TD>\n<TD height=25 align=center>總計</TD>\n<TD height=25 align=center>";
echo $total_sum + $zs_bishu;
echo "</TD>\n<TD height=25 align=center>";
echo $total_total + $user_z_zs;
echo "</TD>\n<TD align=center>";
echo $total_truetotal + $shitouz_zs;
echo "</TD>\n<TD align=center>";
echo "<S";
echo "PAN class=";
if ( 0 < $total_wl + $user_s_zs )
{
		echo "Font_B";
}
else
{
		echo "Font_R";
}
echo ">";
echo $total_wl + $user_s_zs;
echo "</SPAN></TD>\n<TD align=center>";
echo $total_down + $yingshou_d_zs;
echo "</TD>\n<TD align=center>";
echo "</TD>\n<TD height=25 align=center>";
echo $total_downmoney + $shizhanz_zs;
echo "</TD>\n<TD align=center>";
echo $total_back + $shizhant_zs;
echo " </TD>\n";
if ( $u_power != 1 )
{
		echo "<TD align=center>";
		echo $total_occupyresult + $shizhanj_zs;
		echo " </TD>\n<TD align=center>";
		echo $total_earn_back + $gaiuser_zs_earn_b_zs;
		echo " </TD>\n";
}
echo "<TD align=center>";
echo $total_result + $shijijieg_zs;
echo " </TD>\n";
if ( $u_power != 1 )
{
		echo "<TD align=center>";
		echo $total_top + $gongxian_t_zs;
		echo " </TD>\n<TD align=center>";
		echo 0 - ( $total_meet_top + $yingfu_t_zs );
		echo " </TD>\n";
}
echo "</TR>\n</TBODY></TABLE>\n";
$zoufei_query = mysql_query( "select * from orders where {$tiaojian0} history_is_account={$jiesuan} and user_id={$u_id} and is_fly=1 {$tiaojian11}" );
$zf_bishu = mysql_num_rows( $zoufei_query );
if ( $zf_bishu )
{
		$user_zonge_zf = mysql_fetch_array( mysql_query( "select SUM(orders_y) as sum from orders where {$tiaojian0} history_is_account={$jiesuan} and user_id={$u_id} and is_fly=1 {$tiaojian11}" ) );
		$user_tuishui_zf = mysql_fetch_array( mysql_query( "select SUM(tuishui_y) as sum from orders where {$tiaojian0} history_is_account={$jiesuan} and user_id={$u_id} and is_fly=1 {$tiaojian11}" ) );
		$user_shuying_zf = mysql_fetch_array( mysql_query( "select SUM(shuying_y) as sum from orders where {$tiaojian0} history_is_account={$jiesuan} and user_id={$u_id} and is_fly=1 {$tiaojian11}" ) );
		$user_tuishui_zf = round( $user_tuishui_zf[sum], 2 );
		$user_shuying_zf = round( $user_shuying_zf[sum], 2 );
		if ( $u_power == 1 )
		{
				$user_zonge_zf = 0 - round( $user_zonge_zf[sum], 2 );
				$user_shuying_zf = 0 - $user_shuying_zf;
		}
		else
		{
				$user_zonge_zf = round( $user_zonge_zf[sum], 2 );
		}
		$zf_company_jieguo = !$jiesuan ? 0 : $user_shuying_zf + $user_tuishui_zf;
		echo "\n ";
}
echo "                      \n";
if ( 0 < $zf_bishu )
{
		echo "                    \n<TABLE id=tb class=Ball_List border=0 cellSpacing=1 borderColor=#f1f1f1 borderColorDark=#ffffff cellPadding=1 width=800 align=left>\n<TBODY>\n<TR class=td_caption_1>\n<TD bgColor=#d4e5f4 height=28 borderColor=#cccccc colSpan=4 noWrap align=left>";
		echo "<S";
		echo "TRONG>";
		echo "[".$myname."]".$downname;
		echo "走飛</STRONG></TD></TR>\n    \n<TR class=td_caption_1>\n<TD bgColor=#d4e5f4 height=28 borderColor=#cccccc width=\"4%\" noWrap align=center>序號</TD>\n<TD bgColor=#d4e5f4 borderColor=#cccccc align=center>總下註額</TD>\n<TD bgColor=#d4e5f4 borderColor=#cccccc align=center>";
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
		echo ">\n<TD height=28 borderColor=#cccccc noWrap align=center>總計 </TD>\n<TD borderColor=#cccccc noWrap align=center><A  href=\"report_huiyuan.php?power=6&user_id=";
		echo $u_id;
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
		echo "&is_fly=1\">";
		echo $user_zonge_zf;
		echo "</A></TD>\n<TD borderColor=#cccccc noWrap align=center>";
		echo 0 - $user_tuishui_zf;
		echo "</TD>\n<TD borderColor=#cccccc noWrap align=center>";
		echo $zf_company_jieguo;
		echo "</TD>\n</TR>\n</TBODY></TABLE>\n";
}
echo "                    \n</DIV><!-- 結束  --></TD>\n<TD background=../images/tab_15.gif width=8>&nbsp;</TD></TR></TBODY></TABLE></TD></TR>\n<TR>\n<TD height=35 background=../images/tab_19.gif>\n<TABLE border=0 cellSpacing=0 cellPadding=0 width=\"100%\">\n<TBODY>\n<TR>\n<TD height=35 width=12><IMG src=\"../images/tab_18.gif\" width=12 height=35></TD>\n<TD vAlign=top>\n    <TABLE border=0 cellSpacing=0 cellPadding=0 width=\"100%\" \n     ";
echo "         height=30><TBODY>\n              <TR>\n                  ";
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
		echo $total_earn_back + $gaiuser_zs_earn_b_zs;
		echo " /　抵扣補貨及賺水後結果：";
		echo "<S";
		echo "PAN class=Font_B>";
		if ( $jiesuan == 0 )
		{
				echo "0";
		}
		else
		{
				echo $total_result + $shijijieg_zs + $zf_company_jieguo;
		}
		echo " \n                  </SPAN>　/　應付上級：";
		echo "<S";
		echo "PAN class=Font_G> ";
		echo 0 - ( $total_meet_top + $yingfu_t_zs - $zf_company_jieguo );
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
				echo $total_result + $zf_company_jieguo;
		}
		echo " </STRONG> </FONT></STRONG></SPAN></TD>\n                  ";
}
echo "              </TR></TBODY></TABLE>\n</TD>\n<TD width=16><IMG src=\"../images/tab_20.gif\" width=16 height=35></TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE></BODY></HTML>";
?>
