<?php 
include_once( "../../global.php" );
$db = new mysql( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
$where_user='';
$uid=$_SESSION["uid".$c_p_seesion];
$new_plate=$db->get_one('select plate_num from plate order by id DESC');
$plate_num=$new_plate['plate_num'];
if (isset($_GET['issueno_start']) && isset($_GET['issueno_end'])) {
	$starttime=$_GET['issueno_start'];
	$endtime=$_GET['issueno_end'];
}else{
	$starttime = 0;
	$endtime = time( );
}
$power=$db->get_one('select * from users where user_id='.$uid);
switch ($power['user_power']) {
	case '1':
		$my_power='公司';
		$zc='percent_company';
		$tuishui='g_tui';
		break;
	case '2':
		$my_power='分公司';
		$zc='percent_branch';
		$top_id="topf_id";
		$tuishui='f_tui';
		break;
	case '3':
		$my_power='股东';
		$zc='percent_partner';
		$top_id="topgd_id";
		$tuishui='gd_tui';
		break;
	case '4':
		$my_power='总代理';
		$zc='percent_all_proxy';
		$top_id="topzd_id";
		$tuishui='zd_tui';
		break;
	case '5':
		$my_power='代理';
		$zc='percent_proxy';
		$top_id="topd_id";
		$tuishui='d_tui';
		break;
}
// echo $zc;
if (isset($_GET['user_id'])) {
	$where_user.=' orders.user_id='.$_GET["user_id"];
}else{
	$where_user=" orders.".$top_id.'='.$uid;
}
if (isset($_GET['is_win']) && isset($_GET['user_id'])) {
	$where_user.=' and orders.is_win=1';
}else if(isset($_GET['is_win'])){
	$where_user.=' and orders.is_win=1';
}
if ($_GET['o_type3']) {
	$where_user.=' and orders.o_type3 like "%'.$_GET["o_type3"].'%"';
}
if ($_GET['o_type2']) {
	switch ($_GET['o_type2']) {
		case '二字定':
			$where_user.=' and orders.o_type1 like "%'.$_GET["o_type2"].'%"';
			break;
		case '三字定':
			$where_user.=' and orders.o_type1 like "%'.$_GET["o_type2"].'%"';
			break;
		case '四字定':
			$where_user.=' and orders.o_type1 like "%'.$_GET["o_type2"].'%"';
			break;
		default:
			$where_user.=' and orders.o_type2 like "%'.$_GET["o_type2"].'%"';
			break;
	}
}
if ($_GET['plate_num']) {
	$where_user.=' and orders.plate_num ='.$_GET["plate_num"];
}else{
	$where_user.=' and orders.plate_num ='.$plate_num;
}
if ($_GET['user_name']) {
	$where_user.=' and users.user_name like "%'.$_GET["user_name"].'%"';
}
// if ($_GET['is_lh']==1) {
	
// }
$query=  $db->select("orders left join users on users.user_id=orders.user_id", "count(*) as c", $where_user);
$total = $db->fetch_array($query);
$total=$total['c'];
// var_dump($total);exit;
pageft($total, 40); //15条为一页
if ($firstcount < 0){$firstcount = 0;}
$user_one=$db->get_all('select orders.*,users.user_name,users.user_nick from orders left join users on users.user_id=orders.user_id where '.$where_user.' order by time DESC limit '.$firstcount.','.$displaypg);
// $count_money=$db->get_one('select SUM(orders.orders_y) as s from orders left join users on users.user_id=orders.user_id where orders.time>='.$starttime.' and orders.time<='.$endtime.$where_user.' limit '.$firstcount.','.$displaypg);
// var_dump($count_money);exit;
// var_dump($user_one);exit;

$new_plate_num=$db->get_all('select plate_num from plate order by plate_num DESC limit 0,10');
?>
<!Doctype>
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../css/admincg.css" rel="stylesheet" type="text/css" />
<title></title>
<script src="../js/common.js" type="text/javascript"></script>
<script src="../js/menu.js" type="text/javascript"></script>
<script src="../js/ajax.js" type="text/javascript"></script>
<script src="../js/frank.js" type="text/javascript"></script>
<script src="../js/json2.js" type="text/javascript"></script>
<style media=print> .Noprint{display:none;}</style><script data-pace-options='{ "ajax": true,"startOnPageLoad": false}' src="../js/pace.min.js" ></script>
<link rel="stylesheet" href="../css/pace-theme-loading-bar.css">
<script type="text/javascript">
	function orderprint(){
		var company = document.getElementById('formcomid').value;
		window.open('print_awardreadadmin.php?company=' + company);
		return false;
	}
	function orderexcelshow(){
		//var s_number = $('s_number').value; 
		//var s_money = $('s_money').value;
		//var s_money_end = $('s_money_end').value;
		//var s_issueno = $('s_issueno').value;
		//var getclassid = $('s_classid').value;		
		//var awardmoney = $('s_awardmoney').value;		
		//location.href='backup.php?action=db&doaction=award&operation=import&s_issueno='+s_issueno+'&s_number='+s_number+'&s_money='+s_money+'&s_money_end='+s_money_end+'&s_classid='+getclassid+'&s_awardmoney='+awardmoney+'&page=1&sid=wNnns3';
		//javascript:location.href='awardreadadmin.php?action=batchexcelshow&s_issueno='+s_issueno+'&s_number='+s_number+'&s_money='+s_money+'&s_classid='+getclassid+'&awardmoney='+awardmoney+'&page=1&sid=wNnns3';
		location.href = 'backup.php';
		return false;
	}
	function TotalBetSearch(cur_page,first){
		var company = (first)?1:document.getElementById('formcomid').value;
		var issueno = (first)?0:document.getElementById('s_issueno').value;
		var account = document.getElementById('s_account').value;
		var number = document.getElementById('s_number').value;
		var sizixian = document.getElementById('sizixian').checked;
		var soclass = document.getElementById('soclass').value;
		var money_start = document.getElementById('s_money').value;
		var money_end = document.getElementById('s_money_end').value;
		var classid = document.getElementById('s_classid').value;
		var send_data = {};
		send_data.company = company;
		send_data.issueno = issueno;
		send_data.getissueno_start = 170124024;
		send_data.getissueno_end = 170125023;
		send_data.account = account;
		send_data.number = number;
		send_data.sizixian = sizixian;
		send_data.soclass = soclass;
		send_data.money_start = money_start;
		send_data.money_end = money_end;
		send_data.classid = classid;
		Pace.restart();
		Pace.track(function(){
			ajax('post','awardreadadmin.php',true,'send_data=' + JSON.stringify(send_data) + '&reward=' + 0 + '&cur_page=' + cur_page + '&page_unit=' + 40,function(data){
				data = JSON.parse(data);
				document.getElementById("showTotallog").innerHTML = data;
			});
		});
	}
</script>
<style>
	td{
		/*font-size: 16px;*/
		font-family: Microsoft JhengHei;

	}
	#showTotallog td{font-weight:bold;}
</style>
</head>
<body leftmargin="10" topmargin="10" >
	<div id="append_parent"></div>
	<table width="99%" align=center border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td >
				<table class="Noprint" width="100%"  border="0" cellpadding="0" cellspacing="0" >
	<tr>
		<td style="    border: 1px solid #036564;">
			<table width="100%" border="0" cellpadding="0" cellspacing="0" class="guide">
				<tr  style="border:none;">
					<td style="border:none; 12px Arial, Helvetica, sans-serif" width=15%>
						<a href="#" onClick="window.location.href='report.php?bet=1'">位置</a>&nbsp;&raquo;&nbsp;总货明细					</td>
					<td width='39%' style='border:none;font-size:16px;font-family:Microsoft JhengHei;'>
						<marquee scrolldelay=400 style='height:18px;font-weight: bold;'>您好，最近明细列表在调整中，如有问题请反映或是耐心等候，谢谢。</marquee>
					</td>
					<td width=46% style="border:none;text-align:right;padding-right:10px;font-size:16px;font-family:Microsoft JhengHei;">
						<a href="awardreadadmin.php<?php if(isset($_GET['user_id'])){echo '?user_id='.$_GET['user_id'];}?>" class=<?php if(empty($_GET['is_win']) && empty($_GET['is_lh']) && empty($_GET['is_db'])){echo 'meuntop';}?>><b>总货明细</b></a> | 
						<a href="awardreadadmin.php?is_win=1<?php if(isset($_GET['user_id'])){echo '&user_id='.$_GET['user_id'];}?>" class=<?php if($_GET['is_win']){echo 'meuntop';}?>><b>中奖明细</b></a> | 
						<a href="awardreadadmin.php?is_lh=1<?php if(isset($_GET['user_id'])){echo '&user_id='.$_GET['user_id'];}?>" class=<?php if($_GET['is_lh']){echo 'meuntop';}?>><b>拦货明细</b></a> | 
						<a href="awardreadadmin.php?is_db=1<?php if(isset($_GET['user_id'])){echo '&user_id='.$_GET['user_id'];}?>" class=<?php if($_GET['is_db']){echo 'meuntop';}?>><b>打包白单拦货数据</b></a>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table><br/>				
<form action="">
<input type="hidden" name="issueno_start" value="<?php echo $starttime;?>">
<input type="hidden" name="issueno_end" value="<?php echo $endtime;?>">
<?php if (isset($_GET['user_id'])) {?>
<input type="hidden" name="user_id" value="<?php echo $_GET['user_id'];?>">
<?php }?>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tableborder">
					<tr class="header"><td colspan="18"></td></tr>
					<tr>
						<td width=70 style="text-align:center;"> 查账号 </td>
						<td width=100 style="text-align:center;"><INPUT TYPE="text" NAME="user_name" id="s_account" maxlength=20 value="<?php if($_GET['user_name']){echo $_GET['user_name'];}?>" style="width:90px"></td>
						<td width=70 style="text-align:center;"> 查号码 </td>
						<td width=100 style="text-align:center;"><INPUT TYPE="text" NAME="o_type3" id="s_number" onblur="sNumber(this.value);"  onkeydown="sNumber13(this.value);" onkeypress=""  maxlength=5 value="<?php if($_GET['o_type3']){echo $_GET['o_type3'];}?>" style="width:90px"></td>
						<td width=10 style="text-align:center;"> 现 </td>
						<td width=20 style="text-align:center;"><INPUT TYPE="checkbox" ID="sizixian" NAME="sizixian" ></td>
						<td width=50 style="text-align:center;"> 列出</td>
						<td width=40 style="text-align:center;">
							<select name="soclass" id="soclass">
								<option value="0">赔率</option>
								<option value="1">金额</option>
								<option value="2">退码</option>
							</select>
						</td>
						<td width=60 style="text-align:center;"><INPUT TYPE="text" NAME="s_money" ID="s_money" value="" style="width:60px"></td>
						<td width=10 style="font-size:16px;font-family:Microsoft JhengHei;text-align:center;">至</td>
						<td width=60 style="font-size:16px;font-family:Microsoft JhengHei;text-align:center;"><INPUT TYPE="text" NAME="s_money_end" ID="s_money_end" value="" style="width:60px"></td>
						<td width=40 style="font-size:16px;font-family:Microsoft JhengHei;text-align:center;">分类</td>
						<td width=80 style="font-size:16px;font-family:Microsoft JhengHei;text-align:center;">
							<select name="o_type2" id="s_classid" >
								<option value="" >全部</option>
								<option <?php if($_GET['o_type2']=='二字定'){echo 'selected="selected"';}?> value="二字定" >二字定</option>
								<option <?php if($_GET['o_type2']=='口口XX'){echo 'selected="selected"';}?> value="口口XX" >口口XX</option>
								<option <?php if($_GET['o_type2']=='口X口X'){echo 'selected="selected"';}?> value="口X口X" >口X口X</option>
								<option <?php if($_GET['o_type2']=='口XX口'){echo 'selected="selected"';}?> value="口XX口" >口XX口</option>
								<option <?php if($_GET['o_type2']=='X口X口'){echo 'selected="selected"';}?> value="X口X口" >X口X口</option>
								<option <?php if($_GET['o_type2']=='X口口X'){echo 'selected="selected"';}?> value="X口口X" >X口口X</option>
								<option <?php if($_GET['o_type2']=='XX口口'){echo 'selected="selected"';}?> value="XX口口" >XX口口</option>
								<option <?php if($_GET['o_type2']=='三字定'){echo 'selected="selected"';}?> value="三字定" >三字定</option>
								<option <?php if($_GET['o_type2']=='口口口X'){echo 'selected="selected"';}?> value="口口口X" >口口口X</option>
								<option <?php if($_GET['o_type2']=='口口X口'){echo 'selected="selected"';}?> value="口口X口" >口口X口</option>
								<option <?php if($_GET['o_type2']=='口X口口'){echo 'selected="selected"';}?> value="口X口口" >口X口口</option>
								<option <?php if($_GET['o_type2']=='X口口口'){echo 'selected="selected"';}?> value="X口口口" >X口口口</option>
								<option <?php if($_GET['o_type2']=='四字定'){echo 'selected="selected"';}?> value="四字定" >四字定</option>
								<option <?php if($_GET['o_type2']=='二字现'){echo 'selected="selected"';}?> value="二字现" >二字现</option>
								<option <?php if($_GET['o_type2']=='三字现'){echo 'selected="selected"';}?> value="三字现" >三字现</option>
								<option <?php if($_GET['o_type2']=='四字现'){echo 'selected="selected"';}?> value="四字现" >四字现</option>
								<!-- <option value="XXX口口(45位)" >XXX口口(45位)</option> -->
								<!-- <option value="二定" >二定</option> -->
<!-- 								<option value="快打" >快打</option>
								<option value="快选" >快选</option>
								<option value="导入" >导入</option>	 -->
							</select>
						</td>
						<td width=40 style="font-size:16px;font-family:Microsoft JhengHei;text-align:center;">期数</td>
						<td width="80">
					<select name="plate_num" id="s_issueno" onchange="javascript:;"><!-- companyform.submit() -->
					<?php foreach ($new_plate_num as $key => $value){?>
						<option value="<?php echo $value['plate_num'];?>" <?php if($_GET['plate_num']==$value['plate_num']){echo 'selected';}?>><?php echo $value['plate_num'];?></option>
					<?php }?>
					</select>	
						</td>	
						<td width=50 style="font-size:16px;font-family:Microsoft JhengHei;text-align:center;"><!-- <input class="button" type="button" name="addsubmit" value="提 交" onclick="TotalBetSearch(1);"> -->
						<input class="button" type="submit" value="提 交"></td>
						<td width=* style="font-size:16px;font-family:Microsoft JhengHei;text-align:left;"><input class="button" type="button" name="printsubmit" onclick="orderprint();return false;" value="打印"></td>
						<td width=50 style="font-size:16px;font-family:Microsoft JhengHei;text-align:center;"></td>
					</tr>
				</table><BR>
</form>

				<div id="showTotallog">
					<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tableborder">
						<form method="post" name="companyform" action=""></form>
						<input type="hidden" name="formhash" value="82872a3a">	
						<input type="hidden" name="s_awardmoney" id="s_awardmoney" value="">	
						<input type="hidden" name="doaction" value="">	
						<input type="hidden" name="uid" value="0">		
						<input type="hidden" name="comid" value="3">		
						<input type="hidden" name="s_username" value="">
						<input type="hidden" name="s_money" value="">
						<input type="hidden" name="s_number" value="">		
						<input type="hidden" name="soclass" value="0">	
						<input type="hidden" name="s_classid" value="0">		
							<tbody><tr class="header"><td colspan="14">总货明细(红色为退码)</td><input type="hidden" id="formcomid" name="formcomid" value="3">
					    </tr>
						
						<tr class="reportTop">
							<td width="12%">注单编号</td>
							<td width="10%">会员</td>
							<td width="10%">下单时间</td>
							<td width="6%">号码</td>
							<td width="7%">下注金额</td>
							<?php if ($_GET['is_lh']==1){?>
							<td width="7%" >占成金额</td>
							<?php }?>
							<td width="6%">赔率</td>
							<td width="7%">中奖</td>
							<td width="7%">下线回水</td>
							<td width="7%">实收下线</td>
									<td width="7%">自己回水</td>
							<td width="7%">实付上线</td>
							<td width="6%">赚水</td>
									<td width="5%">路径</td>
							<td width="5%">IP</td>
						
						</tr>
						<?php if (!empty($user_one) && isset($user_one) && empty($_GET['is_lh'])){?>
						<?php $sum_mn='';$sum_ts=''; foreach ($user_one as $key => $value){?>
						<?php $sum_mn=$value['orders_y']+$sum_mn;$sum_ts=$value['tuishui_y']+$sum_ts;?>
						<tr class="hover" onmouseover="hover1(this);" onmouseout="hover2(this);" style="height:28px;line-height:29px;">
							<td class="<?php if($value['stattuima']==1){echo 'soon_tuima';}else{echo '';}?>" width="12%"><?php echo $value['plate_num'].$value['time'].$value['id'];?></td>
							<td class="<?php if($value['stattuima']==1){echo 'soon_tuima';}else{echo '';}?>" width="10%"><?php echo $value['user_name'];?><b style="color:#090;">(<?php echo $value['user_nick'];?>)</b></td>
							<td class="<?php if($value['stattuima']==1){echo 'soon_tuima';}else{echo '';}?>" width="15%"><?php echo date('Y-m-d H:i:s',$value['time']);?><?php if($value['stattuima']==1){echo '<br/>退'.date('Y-m-d H:i:s',$value['tuima_time']);}?></td>
							<td class="<?php if($value['stattuima']==1){echo 'soon_tuima';}else{echo '';}?>" width="6%"><b><?php echo $value['o_type3'];?></b></td>
							<td class="<?php if($value['stattuima']==1){echo 'soon_tuima';}else{echo '';}?>" width="7%"><?php echo $value['orders_y'];?></td>
							<?php if ($_GET['is_lh']==1){?>
							<td class="<?php if($value['stattuima']==1){echo 'soon_tuima';}else{echo '';}?>" width="7%" ><?php echo $power[$zc]/100*$value['orders_y'];?></td>
							<?php }?>
							<td class="<?php if($value['stattuima']==1){echo 'soon_tuima';}else{echo '';}?>" width="6%"><?php echo $value['orders_p'];?></td>
							<td class="<?php if($value['stattuima']==1){echo 'soon_tuima';}else{echo '';}?>" width="7%"><?php if($value['is_win']==1){echo $value['orders_y']*$value['orders_p'];}else{echo '--';}?></td>
							<td class="<?php if($value['stattuima']==1){echo 'soon_tuima';}else{echo '';}?>" width="7%">

								<?php 
									if ($my_power=='分公司') {
										echo $xx_h=$value['orders_y']*$value['gd_tui']+$value['orders_y']*$value['zd_tui']+$value['orders_y']*$value['d_tui']+$value['orders_y']*$value['h_tui'];
									}
									if ($my_power=='股东') {
										echo $xx_h=$value['orders_y']*$value['zd_tui']+$value['orders_y']*$value['d_tui']+$value['orders_y']*$value['h_tui'];
									}
									if ($my_power=='总代理') {
										echo $xx_h=$value['orders_y']*$value['d_tui']+$value['orders_y']*$value['h_tui'];
									}
									if ($my_power=='代理') {
										echo $xx_h=$value['orders_y']*$value['h_tui'];
									}
								?>

							</td><!-- 下线回水 -->
							<td class="<?php if($value['stattuima']==1){echo 'soon_tuima';}else{echo '';}?>" width="7%"><?php echo $value['orders_y']-$xx_h;?></td> <!-- 实收下线 -->
							<td class="<?php if($value['stattuima']==1){echo 'soon_tuima';}else{echo '';}?>" width="7%"><?php echo $zj_h=$xx_h+$value[$tuishui]*$value['orders_y'];?></td> <!-- 自己回水 -->
							<td class="<?php if($value['stattuima']==1){echo 'soon_tuima';}else{echo '';}?>" width="7%"><?php echo $value['orders_y']-$xx_h-$value[$tuishui]*$value['orders_y'];?></td> <!-- 实付上线 -->
							<td class="<?php if($value['stattuima']==1){echo 'soon_tuima';}else{echo '';}?>" width="6%"><?php echo $value[$tuishui]*$value['orders_y'];?></td>  <!-- 赚水 -->
							<td class="<?php if($value['stattuima']==1){echo 'soon_tuima';}else{echo '';}?>" width="5%">--</td>
							<td class="<?php if($value['stattuima']==1){echo 'soon_tuima';}else{echo '';}?>" width="5%">--</td>
						
						</tr>
						<?php 
							if ($value['stattuima']==0) {
								$z_bs=$z_bs+1;  //总笔数
								$z_je=$z_je+$value['orders_y'];  //总金额
								if ($value['is_win']==1) {
									$z_zj=$value['orders_y']*$value['orders_p']+$z_zj; //中奖
								}
								$z_xx_h=$z_xx_h+$xx_h;  //总下线回水
								$z_ssxx=$value['orders_y']-$xx_h+$z_ssxx;
								$z_zj_h=$zj_h+$z_zj_h;  //总自己会水
								$z_sfsx=$value['orders_y']-$xx_h-$value[$tuishui]*$value['orders_y']+$z_sfsx; //总实付上线
								$z_zs=$value[$tuishui]*$value['orders_y']+$z_zs;  //总赚水
							}

						?>
						<?php }?>
						<?php }?>
						<!-- 占成明细 -->
						<?php if (!empty($user_one) && isset($user_one) && !empty($_GET['is_lh'])){?>
						<?php $sum_mn='';$sum_ts=''; foreach ($user_one as $key => $value){?>
						<?php $top_zc=$power[$zc]/100*$value['orders_y'];?>
						<?php if ($top_zc>0){ continue;?>
						<?php $i=$i+1;?>
						<?php $sum_mn=$value['orders_y']+$sum_mn;$sum_ts=$value['tuishui_y']+$sum_ts;?>
						<tr>
							<td class="<?php if($value['stattuima']==1){echo 'soon_tuima';}else{echo '';}?>" width="12%"><?php echo $value['plate_num'].$value['time'].$value['id'];?></td>
							<td class="<?php if($value['stattuima']==1){echo 'soon_tuima';}else{echo '';}?>" width="10%"><?php echo $value['user_name'];?><b style="color:#090;">(<?php echo $value['user_nick'];?>)</b></td>
							<td class="<?php if($value['stattuima']==1){echo 'soon_tuima';}else{echo '';}?>" width="15%"><?php echo date('Y-m-d H:i:s',$value['time']);?><?php if($value['stattuima']==1){echo '<br/>退'.date('Y-m-d H:i:s',$value['tuima_time']);}?></td>
							<td class="<?php if($value['stattuima']==1){echo 'soon_tuima';}else{echo '';}?>" width="6%"><b><?php echo $value['o_type3'];?></b></td>
							<td class="<?php if($value['stattuima']==1){echo 'soon_tuima';}else{echo '';}?>" width="7%"><?php echo $value['orders_y'];?></td>
							<?php if ($_GET['is_lh']==1){?>
							<td class="<?php if($value['stattuima']==1){echo 'soon_tuima';}else{echo '';}?>" width="7%" ><?php echo $power[$zc]/100*$value['orders_y'];?></td>
							<?php }?>
							<td class="<?php if($value['stattuima']==1){echo 'soon_tuima';}else{echo '';}?>" width="6%"><?php echo $value['orders_p'];?></td>
							<td class="<?php if($value['stattuima']==1){echo 'soon_tuima';}else{echo '';}?>" width="7%"><?php if($value['is_win']==1){echo $value['orders_y']*$value['orders_p'];}else{echo '--';}?></td>
							<td class="<?php if($value['stattuima']==1){echo 'soon_tuima';}else{echo '';}?>" width="7%"><?php echo $value['orders_y']*$value['h_tui'];?></td>
							<td class="<?php if($value['stattuima']==1){echo 'soon_tuima';}else{echo '';}?>" width="7%"><?php echo $sou=$value['orders_y']-$value['h_tui'];?></td>
							<td class="<?php if($value['stattuima']==1){echo 'soon_tuima';}else{echo '';}?>" width="7%"><?php echo $value['d_tui'];?></td>
							<td class="<?php if($value['stattuima']==1){echo 'soon_tuima';}else{echo '';}?>" width="7%"><?php echo $sou-$value['d_tui']-$value['h_tui'];?></td>
							<td class="<?php if($value['stattuima']==1){echo 'soon_tuima';}else{echo '';}?>" width="6%"><?php $zs=$value['d_tui']-$value['h_tui'];if($zs<0){echo '0';}else{ echo $zs;}?></td>
							<td class="<?php if($value['stattuima']==1){echo 'soon_tuima';}else{echo '';}?>" width="5%">--</td>
							<td class="<?php if($value['stattuima']==1){echo 'soon_tuima';}else{echo '';}?>" width="5%">--</td>
						
						</tr>
						<?php }?>
						<?php }?>
						<?php }else{?>
                            <td colspan="14">还没有内容</td>

                            <?php }?>
						<?php 
							$zj=$user_js=$db->get_one('select SUM(shuying_y) as shuying_y from orders where stattuima=0 and '.$where_user);
							if ($_GET['is_win']==1) {
								$user_js=$db->get_one('select count(*) as c, SUM(orders_p) as order_p,SUM(orders_y) as order_y,SUM(h_tui) as h_tui from orders where is_win=1 and stattuima=0 and '.$where_user);
							}else{
								$user_js=$db->get_one('select count(*) as c, SUM(orders_p) as order_p,SUM(orders_y) as order_y,SUM(h_tui) as h_tui from orders where stattuima=0 and '.$where_user);
							}
						?>
						<!-- 占成明细结束 -->
								<tr class="reportFooter">
							<td colspan="2" style="text-align:center">合计</td>
							<td><?php echo $z_bs;?></td>
							<td></td>  <!-- 总笔数 -->
							<td><?php echo $z_je;?></td> <!-- 总金额 -->
							<td></td>  <!-- 赔率 -->
							
							<td><?php echo $z_zj;?></td> <!-- 中奖 -->
							<td><?php echo $z_xx_h;?></td>  <!-- 下线回水 -->
							<td><?php echo $z_ssxx-$z_zj;?></td> <!-- 实收下线 -->
							<td><?php echo $z_zj_h;?></td>  <!-- 自己会水 -->
							<td><?php echo $z_sfsx-$z_zj;?></td> <!-- 实付上线 -->
							<td><?php echo $z_zs;?></td>  <!-- 赚水 -->
							<td><?php echo $sum_ts;?></td>
							<td></td>
								</tr>
<!--							<tr class="td_caption_1"><td align=center colspan="14">--><?php //echo $pagenav;?><!--</td></tr>-->
						</tbody></table>
				</div>
			</td>
		</tr>
	</table>

    <br /><br /><div class="footer Noprint"><hr size="0" noshade color="BORDERCOLOR" width="80%">
        <b></b> V2.0 &nbsp;&copy;  <b>
        </b><span class="smalltxt"></span>
        usetime:0.331237,
        mysqlquery:5
    </div>
</body>
<script type="text/javascript">
	TotalBetSearch(1,true);
</script>
</html>