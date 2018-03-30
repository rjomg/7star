<?php 
include_once( "../../global.php" );
$db = new mysql( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
$where_user='';
$uid=$_SESSION["uid".$c_p_seesion];
$new_plate=$db->get_one('select plate_num from plate order by id DESC');
$plate_num=$new_plate['plate_num'];

$odds_type=$db->get_all('select * from oddsset_type where user_id=0 and o_typename !="二字定" and o_typename !="三字定" and o_typename !="二字现" and o_typename !="三字现" and o_typename !="四字现" order by o_topid DESC');
// var_dump($odds_type);exit;
$o_topid=$db->get_one('select o_topid,o_typename from oddsset_type where o_typename="'.$_GET['o_typename'].'"');
// var_dump($o_topid);exit;
if ($_GET['act']=='add_type') {
	unset($_GET['act']);
	$data=$_GET;
	$data['plate_num']=$plate_num;
	// var_dump($data);exit;
	$res=$db->get_insert('orders_type',$data);
		$db->Get_admin_msg('business.php?o_typename='.$_GET['o_typename'], '增加分类成功！');
	// if ($res) {
	// }
}

// 获取分类
$orders_type=$db->get_all('select * from orders_type where plate_num='.$plate_num.' and o_typename="'.$_GET['o_typename'].'" order by start_odds ASC');
// var_dump($orders_type);exit;
// 
if ($_GET['start'] && $_GET['end']) {
	$where_type3=' and orders_p >= '.$_GET['start'].' and orders_p <= '.$_GET['end'];
}else if ($_GET['type_id']) {
	$where_type3=' and type_id = '.$_GET['type_id'].' and cut_type= "'.$_GET['cut_type'].'" and cut_num='.$_GET['cut_num'];
}else if ($_GET['s_type_id']) {
	$types=$db->get_one('select start_odds,end_odds from orders_type where id='.$_GET['s_type_id']);
	$where_type3=' and orders_p >= '.$types['start_odds'].' and orders_p <= '.$types['end_odds'];
}else{
	$where_type3='';
}

// 符合添加时间
$add_times=time()*10*60;

//禁止割
$off_p=$db->get_one('select id,off_p from cut_off where type="" and typename="'.$_GET['o_typename'].'"');
$cut_off=$db->get_all('select * from cut_off where type!="" and typename="'.$_GET['o_typename'].'"');
foreach ($cut_off as $key => $value) {
	$off_type[]=$value['type'];
}

?>
<!Doctype>
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title></title>
<!-- <script src="../js/common.js" type="text/javascript"></script> -->
<!-- <script src="../js/menu.js" type="text/javascript"></script> -->
<!-- <script src="../js/ajax.js" type="text/javascript"></script> -->
<!-- <script src="../js/frank.js" type="text/javascript"></script> -->
<!-- <script src="../js/json2.js" type="text/javascript"></script> -->
<link href="../css/admincg.css" rel="stylesheet" type="text/css" />
<link href="./css/business.css" rel="stylesheet" type="text/css" />
<script src="../js/jquery.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="../css/common.css" />
<link rel="stylesheet" type="text/css" href="../css/modal.css" />
<script type="text/javascript" src="../js/modal.js"></script>
<!-- <style media=print> .Noprint{display:none;}</style>
<script data-pace-options='{ "ajax": true,"startOnPageLoad": false}' src="../js/pace.min.js" ></script>-->
<link rel="stylesheet" href="../css/pace-theme-loading-bar.css">
<style>
	td{
		/*font-size: 16px;*/
		font-family: Microsoft JhengHei;

	}
	#showTotallog td{font-weight:bold;padding:0px;text-align:center;}
	.tableborder td{text-align: center;}
	.header td{text-align:left;}
	table {border-collapse:collapse;}
</style>
<script type="text/javascript">
	function add_water(id,water,classid=''){
	    	$.post("add_water.php",{id:id,water:water,classid:classid},function(data){
			    	window.location.reload();
			  });
			// $.ajax({
			// 	Type:'post',
			// 	url:'add_water.php',
			// 	data:{id:id,water:water},
			// 	dataType:'json',
			// 	success:function(data){

			// 	}
			// })
	}
</script>
<style>
	.tableborder table td{border-color:#000;}
	.tableborder td img{margin-top:0px;}
	.dTreeNode img{float:left;}
	.chan_type{float:left;width:100%;border:1px solid red;}
</style>
</head>
<body leftmargin="10" topmargin="10" >
	<div id="append_parent"></div>
	<table width="97%" style="margin:auto;" align=center border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td>
				<table class="Noprint" width="100%"  border="0" cellpadding="0" cellspacing="0" >
	<tr>
		<td>
			<table width="100%" border="0" cellpadding="0" cellspacing="0" class="guide">
				<tr  style="border:none;">
					<td style="border:none;font-size:16px;font-family:Microsoft JhengHei;overflow:hidden;" width=15%>
						<a href="#" onClick="window.location.href='report.php?bet=1'">位置</a>&nbsp;&raquo;&nbsp;汇总合计					</td>
					<td width='39%' style='border:none;font-size:16px;font-family:Microsoft JhengHei;'>
						<marquee scrolldelay=400 style='height:18px;font-weight: bold;'>您好，最近明细列表在调整中，如有问题请反映或是耐心等候，谢谢。</marquee>
					</td>
<!-- 					<td width=46% style="border:none;text-align:right;padding-right:10px;font-size:16px;font-family:Microsoft JhengHei;">
						<a href="awardreadadmin.php" class=<?php if(empty($_GET['is_win']) && empty($_GET['is_lh']) && empty($_GET['is_db'])){echo 'meuntop';}?>><b>总货明细</b></a> | 
						<a href="awardreadadmin.php?is_win=1&user_id=<?php echo $_GET['user_id'];?>" class=<?php if($_GET['is_win']){echo 'meuntop';}?>><b>中奖明细</b></a> | 
						<a href="awardreadadmin.php?is_lh=1&user_id=<?php echo $_GET['user_id'];?>" class=<?php if($_GET['is_lh']){echo 'meuntop';}?>><b>拦货明细</b></a> | 
						<a href="awardreadadmin.php?is_db=1&user_id=<?php echo $_GET['user_id'];?>" class=<?php if($_GET['is_db']){echo 'meuntop';}?>><b>打包白单拦货数据</b></a>
					</td> -->
				</tr>
			</table>
		</td>
	</tr>
</table><br/>

				<div id="showTotallog">
					<table border="0" cellpadding="0" cellspacing="0" class="tableborder" width="100%" style="table-layout: auto;">
						<!-- <form method="post" name="companyform" action=""></form>	 -->
							<tbody><tr class="header">
							<td colspan="16"></td>
							<!-- <td colspan="2">自动割码</td>
							<?php foreach ($odds_type as $key => $value){?>	
								<td><a href=""><?php echo $value['o_typename'];?> () %</a></td>
							<?php }?>
							<td><a href="">确定</a></td>
							<td><a href="">启用中</a></td>
							<td><a href=""></a></td> -->
					    </tr>
					    <!-- 二字定 -->
					    <?php if ($o_topid['o_topid']=='二字定'){?>
						<tr cellpadding="10" class="reportTop">
							<td colspan="8" style="width:60%;">
								<table style="width:100%;height:100%;" class="tableborder" border="0" cellpadding="0" cellspacing="0">
									<tbody>
										<tr class="reportTop">
											<?php foreach ($odds_type as $key => $value){?>	
												<td style="padding:5px 0px 5px;"><a href="business.php?o_typename=<?php echo $value['o_typename'];?>" style="<?php if($value['o_topid']=='二字定'){echo 'color:#3e8d3e;';}if($value['o_topid']=='三字定'){echo 'color:#0066cd;';}if($value['o_typename']=='四字定'){echo 'color:#ff0736;';}?>font-weight:bold;font-size:16px;<?php if($_GET['o_typename']==$value['o_typename']){echo 'border:1px solid red;background:#FFFFC4;';}?>"><?php echo $value['o_typename'];?></a></td>
											<?php }?>
											<td></td>
										</tr>
										<tr><td style="height:10px;" colspan="12"></td></tr>
										<?php for($i=0;$i<=9;$i++){?>
										<?php $row_num='';?>
											<tr>
												<?php for($y=0;$y<=9;$y++){?>
													<td style="border:none;">
														<table style="width:100%;height:100%;">
															<tr><td class="fn_<?php echo $y;?>" style="padding:0px;background:#b5e5bb;height:10px;">
																<?php 
																	if ($_GET['o_typename']=='口XX口') {
																	echo $o_type3=$i.'XX'.$y;
																		
																	}
																	if ($_GET['o_typename']=='口X口X') {
																	echo $o_type3=$i.'X'.$y.'X';
																		
																	}
																	if ($_GET['o_typename']=='口口XX') {
																	echo $o_type3=$i.$y.'XX';
																		
																	}
																	if ($_GET['o_typename']=='XX口口') {
																	echo $o_type3='XX'.$i.$y;
																		
																	}
																	if ($_GET['o_typename']=='X口X口') {
																	echo $o_type3='X'.$i.'X'.$y;
																		
																	}
																	if ($_GET['o_typename']=='X口口X') {
																	echo $o_type3='X'.$i.$y.'X';
																		
																	}
																?>
															</td></tr>
															<?php 
															if ($_GET['type_id']) {
																$count_y=$db->get_one('select SUM(money) as count_y from cut_code where number="'.$o_type3.'"'.$where_type3);
															}else if ($_GET['s_type_id']) {
																$old_count=$db->get_one('select SUM(orders_y) as count_y from orders where stattuima=0 and is_water=0 and plate_num='.$plate_num.' and  o_type3="'.$o_type3.'"'.$where_type3);
																$q_count=$db->get_one('select SUM(money) as count_y from cut_code where number="'.$o_type3.'" and type_id='.$_GET['s_type_id']);
																$count_y['count_y']=($old_count['count_y']-$q_count['count_y'])==0?'':($old_count['count_y']-$q_count['count_y']);
															}else{

																$count_y=$db->get_one('select SUM(orders_y) as count_y from orders where stattuima=0 and is_water=0 and plate_num='.$plate_num.' and  o_type3="'.$o_type3.'"'.$where_type3);
															}
															// echo 'select SUM(money) as count_y from cut_type where number="'.$o_type3.'"'.$where_type3;
															?>
															<tr><td style="color:blue;font-size:16px;"><?php ${'t'.$i}=${'t'.$i}+$count_y['count_y']; echo $count_y['count_y'];?></td></tr>
														</table>
													</td>
												<?php ${'f'.$y}=$count_y['count_y']+${'f'.$y};?>
												<?php 
													$row_num .=$o_type3.',';
													${'fn_'.$y} .=$o_type3.',';
												?>
												<?php }?>
												<td style="border:none;">
													<table style="width:100%;height:100%;">
														<tr><td style="background:#d8d8d8;height:10px;"><?php echo $i;?>头合计</td></tr>
														<tr><td style="color:red;font-size:16px;"><?php echo ${'t'.$i};${'t'.$i}=0;?></td></tr>
													</table>
												</td>
												<!-- 禁止割行 -->
												<td style="w-40">
													<input style="<?php if(in_array("top_$i",$off_type)){echo 'color:red;';}else{ echo '#268324';}?>" data='top_<?php echo $i;?>' num='<?php echo $row_num;?>' type="button" class="h-30 top_btn" value="<?php if(in_array("top_$i",$off_type)){echo '禁止割';}else{ echo '正常割';}?>">
												</td>
												<!-- 禁止割行end -->
											</tr>
										<?php }?>
										<tr>
											<?php for($y=0;$y<=9;$y++){?>
												<td style="background:#d8d8d8;border:none;">
													<table style="width:100%;height:100%;">
														<tr><td style="background:#d8d8d8;height:10px;"><?php echo $y;?>尾合计</td></tr>
														<tr><td style="color:red;font-size:16px;"><?php echo ${'f'.$y};?></td></tr>
													</table>
												</td>
												<?php $c=${'f'.$y}+$c;?>
											<?php }?>
											<td style="background:#fd0009;border:none;">
											<table style="width:100%;height:100%;">
													<tr><td style="background:#fd0009;height:10px;color:#fff;">总额合计</td></tr>
													<tr><td style="color:blue;font-size:16px;"><?php echo $c;?></td></tr>
											</table>
											</td>
											<td></td>
										</tr>
										<!-- 禁止割裂按钮 -->
										<tr>
										<?php for($z=0;$z<=9;$z++){?>
											<td style="padding:5px 0px 5px;">
												<input style="<?php if(in_array("foot_$z",$off_type)){echo 'color:red;';}else{ echo '#268324';}?>" data="foot_<?php echo $z;?>" num="<?php echo ${'fn_'.$z};?>" class="h-30 foot_btn" type="button" style="writing-mode:tb-rl;" value="<?php if(in_array("foot_$z",$off_type)){echo '禁止割';}else{ echo '正常割';}?>">
											</td>
										<?php }?>
										<td colspan="2">
											限制码<input data="<?php echo $off_p['id'];?>" type="text" class="w-50 h-20 off_num" value="<?php echo $off_p['off_p'];?>">组
										</td>
										</tr>
										<!-- 禁止割裂按钮end -->
									</tbody>
								</table>
							</td>
							<td colspan="8" style="padding:5px 0px 0px 20px;">
								<table border="0" cellpadding="0" cellspacing="0" style="width:100%;height:100%;" class="tableborder">
									<!-- <tr>
										<td colspan="3"><?php echo $_GET['o_typename']?></td>
										<td colspan="4">总金额：
										<?php 
											$bs=$db->get_all('select o_type3 from orders where plate_num='.$plate_num.' and stattuima=0 and is_water=0 and o_type2="'.$_GET['o_typename'].'" group by o_type3');
											echo count($bs);
										?>
										笔,<?php echo $c;?>元</td>
									</tr> -->
									<tr>
										<td colspan="3" style="width:40%;">割码排列</td>
										<td colspan="2">
											<form action="business.php" method="get">
											<input type="hidden" name="o_typename" value="<?php echo $_GET['o_typename'];?>">
											<input type="hidden" name="act" value="add_type">
											<select name="start_odds" id="">
												<?php for ($i=680; $i <= 1000; $i++) {?>
												<option value="<?php echo $i/10;?>"><?php echo $i/10;?></option>
												<?php }?>
											</select>
											<select name="end_odds" id="">
												<?php for ($i=1000; $i >= 680; $i--) {?>
												<option value="<?php echo $i/10;?>"><?php echo $i/10;?></option>
												<?php }?>
											</select>
											<input type="submit" value="添加">
											</form>
										</td>
										<td><?php echo $_GET['o_typename']?></td>
										<td>总额:<?php echo $c;?>元</td>
									</tr>
									<!-- <tr>
										<td colspan="3"></td>
										<td colspan="4"></td>
									</tr> -->
									<!-- 内容 -->
									<tr style="height:80%;">
										<td colspan="3" style="border-bottom:none;"></td>
										<td colspan="4">
											<div style="overflow-y: auto; height: 100%; width:100%;">
												<!-- <table style="width:100%">
												<?php foreach ($orders_type as $key => $value){?>
													<tr class="type_change">
														<td colspan="3" data="<?php echo $value['id'];?>"><img id="menuimg_showfix_782" src="../picture/menu_add.gif" border="0" style="background:#ccc;margin-right:10px;"><?php echo $value['start_odds'];?>-<?php echo $value['end_odds'];?> 总额</td>
														<td width="20%">
															<?php 
																$ms=$db->get_one('select count(*) from orders where plate_num='.$plate_num.' and stattuima=0 and is_water=0 and o_type2="'.$_GET['o_typename'].'" and orders_p BETWEEN '.$value['start_odds'].' AND '.$value['end_odds']);
																echo $ms['count(*)'];
															?>
														</td>
														<td width="20%">
															<?php 
																$ms=$db->get_one('select SUM(orders_y) as sum_y from orders where plate_num='.$plate_num.' and stattuima=0 and is_water=0 and o_type2="'.$_GET['o_typename'].'" and orders_p BETWEEN '.$value['start_odds'].' AND '.$value['end_odds']);
																echo $ms['sum_y'];
															?>
														</td>
													</tr>
													<tr>
														<td width="20%"></td>
														<td width="20%">割 1</td>
														<td width="20%"></td>
														<td width="20%"></td>
														<td width="20%"></td>
													</tr>
													<tr class="type_change">
														<td width="20%"></td>
														<td width="20%">剩数</td>
														<td width="20%"></td>
														<td width="20%"></td>
														<td width="20%"></td>
													</tr>
													<tr><td colspan="5"></td></tr>
												<?php }?>
													<tr></tr>
												</table> -->
												<?php foreach ($orders_type as $key => $value){?>
												<div class="dtree" data="<?php echo $value['id'];?>"> 
												   <div class="clip" style="display:block;color:#090;<?php if($_GET['start']==$value['start_odds'] && $_GET['end']==$value['end_odds']){echo 'border:1px solid red;float:left;width:100%;';}?>">
												    <div class="dTreeNode">
												     <a href="javascript:;">
												     <img class="jd1" src="./right_files/minus.gif" alt="" data="off"/></a>
												     <div style="width:50%;float:left;">
												     <span style="float:left;">分类</span>
												     <a href="business.php?o_typename=<?php echo $_GET['o_typename'];?>&start=<?php echo $value['start_odds'];?>&end=<?php echo $value['end_odds'];?>&dtree_type=<?php echo $value['id'];?>" title="main1" style="color:#090;"><?php echo $value['start_odds'];?>-<?php echo $value['end_odds'];?> 总额</a></div>
												     <div style="width:10%;float:left;"><?php 
																$ms=$db->get_all('select o_type3 from orders where plate_num='.$plate_num.' and stattuima=0 and is_water=0 and o_type2="'.$_GET['o_typename'].'" and orders_p BETWEEN '.$value['start_odds'].' AND '.$value['end_odds'].' group by o_type3');
																echo $msc=count($ms);
															?></div>
												     <div style="width:30%;float:left;"><?php 
																$ms=$db->get_one('select SUM(orders_y) as sum_y from orders where plate_num='.$plate_num.' and stattuima=0 and is_water=0 and o_type2="'.$_GET['o_typename'].'" and orders_p BETWEEN '.$value['start_odds'].' AND '.$value['end_odds']);
																echo $ms['sum_y'];
															?></div>
												    </div>
												     </div>
												     <div style="clear:both;"></div>
												     <?php 
												     	// $top_code=$db->get_all('select * from cut_code where type_id='.$value['id']." group by cut_type");
												     	$cut_code=$db->get_all('select * from cut_code where type_id='.$value['id']." group by cut_type,cut_num");
												     ?>
												     <!-- 切码列表 -->
												     <?php if (!empty($cut_code)){?>
												     <?php $last_cut_m=0;?>
												     <?php foreach ($cut_code as $k => $v){?>
												    <div class="dTreeNode node3 <?php if($_GET['cut_num']==$v['cut_num'] && $_GET['type_id']==$v['type_id'] && $_GET['cut_type']==$v['cut_type']){ echo 'chan_type';}?>" style="">
												    <div style="width:50%;float:left;">
												     <img src="./right_files/join.gif" alt="" />
												     <img id="id2" src="./right_files/page.gif" alt="" />
												     <a id="sd2" class="node" href="business.php?o_typename=<?php echo $_GET['o_typename'];?>&cut_type=<?php echo $v['cut_type'];?>&type_id=<?php echo $v['type_id'];?>&cut_num=<?php echo $v['cut_num'];?>" style="color:red;"><?php echo $v['cut_type'];?>(<?php echo $v['cut_num'];?>)</a>
												    </div>
												     <div style="width:10%;color:red;float:left;"><?php
																$cut_count=$db->get_all('select number from cut_code where cut_type="'.$v['cut_type'].'" and type_id='.$value['id'].' and cut_num='.$v['cut_num'].' group by number');

																echo count($cut_count);
															?></div>
													<div style="width:30%;color:red;float:left;"><?php
																$cut_m=$db->get_one('select SUM(money) as m from cut_code where cut_type="'.$v['cut_type'].'" and type_id='.$value['id'].' and cut_num='.$v['cut_num']);
																echo $cut_m['m'];
																$last_cut_m +=$cut_m['m'];
															?></div>
												    </div>
												    <!-- 切码列表end -->
												    <?php $a=$msc-count($cut_count);$b=$ms['sum_y']-$last_cut_m;?>
												     <?php }?>
												     <?php }else { $a=$msc-0;$b=$ms['sum_y']-0;?>
												     <?php }?>
												    <div style="clear:both;"></div>
													<!-- 切码列表end -->
													<!-- 分类剩数 -->
												    <div class="dTreeNode node2" onClick="javascript:location.href='business.php?o_typename=<?php echo $_GET['o_typename'];?>&s_type_id=<?php echo $value['id'];?>';" style="float:left;width:99%; <?php if($value['id']==$_GET['s_type_id']){ echo "border:1px solid red;";}?>" data="<?php echo $value['id'];?>" start="<?php echo $value['start_odds']?>" end="<?php echo $value['end_odds'];?>" <?php if($value['id']==$_GET['s_type_id']){echo "id='chan_ss'";}?>>
												     <img src="./right_files/join.gif" alt="" />
												     <div style="width:50%;float:left;">
												     <span style="float:left;">剩数</span>
												     <a id="sd2" class="node" href="javascript:;" style="color:#FF6600;"></a>
												     </div>
												     <!-- 剩余码数 -->
												     <div style="width:10%;float:left;"><?php
																echo $msc;
															?></div>
													<!-- 剩余金额 -->
													<div style="width:30%;float:left;"><?php
																echo $b;
															?></div>
												    </div>
												    <!-- 分类剩数end -->
												    <div style="clear:both;"></div>
												</div>
												<?php }?>
											</div>
										</td>
									</tr>
									<!-- 内容end -->
									<!-- <tr>
										<td colspan="2"></td>
										<td colspan="3">总剩数</td>
										<td></td>
										<td></td>
									</tr> -->
									<!-- <tr>
										<td colspan="7" style="height:10px;"></td>
									</tr> -->
									<!-- 二字定操作 -->
									<tr>
										<td colspan="3"></td>
										<td colspan="4">
											<table class="qm_btn" style="width:100%;">
												<tr>
													<td style="border-bottom:none;">
													<input type="button" id="zdy" data-title="自定义表" value="自定义割">
													<input type="button" id="bfb"  data-title="百分比表" value="割百分比">
													<input type="button" id="del_type" data="<?php if($_GET['start']==$value['start_odds'] && $_GET['end']==$value['end_odds']){echo $_GET['dtree_type'];}?>" value="删除">
													<input type="button" value="打印">
													<input type="button" id="down_txt" value="导出文件">
													</td>
												</tr>
											</table>
										</td>
										<!-- <td><a href="javascript:;" id="zdy" data-title="自定义表">自定义割</a></td>
										<td><a href="javascript:;" id="gph" data-title="平衡表">割平衡</a></td>
										<td><a href="javascript:;" id="gbm" data-title="爆码表">割爆码</a></td>
										<td><a href="javascript:;" id="bfb"  data-title="百分比表">割百分比</a></td>
										<td><a id="del_type" data="<?php if($_GET['start']==$value['start_odds'] && $_GET['end']==$value['end_odds']){echo $_GET['dtree_type'];}?>" href="javascript:;">删除</a></td>
										<td><a href="">打&nbsp;&nbsp;&nbsp;&nbsp;印</a></td>
										<td><a href="javascript:;" id="down_txt">导出文件</a></td> -->
									</tr>
									<!-- 二字定操作 -->
								</table>
							</td>
						</tr>
						<?php }?>
						<!-- 二字定end -->
						<!-- 三字定 -->
						<?php if ($o_topid['o_topid']=='三字定'){?>
						<?php 
							$o_type3=$db->get_all('select o_type2,o_type3 from orders where stattuima=0 and is_water=0 and plate_num='.$plate_num.' and o_type2="'.$_GET['o_typename'].'"'.$where_type3.' group by o_type3 order by o_type3 ASC');
						?>
						<tr class="reportTop">
							<td colspan="10">
								<table style="width:100%;height:100%;min-height:600px;" class="tableborder" border="0" cellpadding="0" cellspacing="0">
									<tbody>
										<tr class="reportTop">
											<?php foreach ($odds_type as $key => $value){?>	
												<td><a href="business.php?o_typename=<?php echo $value['o_typename'];?>" style="<?php if($value['o_topid']=='二字定'){echo 'color:#3e8d3e;';}if($value['o_topid']=='三字定'){echo 'color:#0066cd;';}if($value['o_typename']=='四字定'){echo 'color:#ff0736;';}?>font-weight:bold;font-size:16px;<?php if($_GET['o_typename']==$value['o_typename']){echo 'border:1px solid red;background:#FFFFC4;';}?>"><?php echo $value['o_typename'];?></a></td>
											<?php }?>
										</tr>
										<tr><td style="height:10px;" colspan="11"></td></tr>
											<tr>
												<?php foreach($o_type3 as $key => $value){?>
													<td style="border:none;">
														<table style="width:100%;height:100%;">
															<tr><td style="padding:0px;background:#b5e5bb;height:10px;">
																<?php echo $value['o_type3'];?>
															</td></tr>
															<?php 
																$count_y=$db->get_one('select SUM(orders_y) as count_y from orders where stattuima=0 and is_water=0 and plate_num='.$plate_num.' and  o_type3="'.$value['o_type3'].'"');
															?>
															<tr><td style="color:blue;font-size:16px;"><?php ${'t'.(($key)%11)}=${'t'.(($key)%11)}+$count_y['count_y']; echo $count_y['count_y'];?></td></tr>
														</table>
													</td>
												<?php if(($key+1)%11==0){echo '</tr><tr>';}?>
												<?php ${'f'.(($key)%11)}=$count_y['count_y']+${'f'.(($key)%11)};?>
												<?php }?>
												<tr></tr>
											</tr>
										<tr>
											<?php for($y=0;$y<=9;$y++){?>
												<td style="background:#d8d8d8;border:none;">
													<table style="width:100%;height:100%;">
														<tr><td style="background:#d8d8d8;height:10px;">合计</td></tr>
														<tr><td style="color:red;font-size:16px;"><?php echo ${'f'.$y};?></td></tr>
													</table>
												</td>
												<?php $c=${'f'.$y}+$c;?>
											<?php }?>
											<td style="background:#fd0009;border:none;">
											<table style="width:100%;height:100%;">
													<tr><td style="background:#fd0009;height:10px;color:#fff;">总额合计</td></tr>
													<tr><td style="color:blue;font-size:16px;"><?php echo $c;?></td></tr>
											</table>
											</td>
										</tr>
									</tbody>
								</table>
							</td>
							<td colspan="6" style="padding:5px 0px 0px 10px;">
								<table border="0" cellpadding="0" cellspacing="0" style="width:100%;height:100%;" class="tableborder">
									<tr>
										<td colspan="2"><?php echo $_GET['o_typename']?></td>
										<td colspan="5">总金额：笔，元</td>
									</tr>
									<tr>
										<td colspan="2">
											<form action="business.php" method="get">
											<input type="hidden" name="o_typename" value="<?php echo $_GET['o_typename'];?>">
											<input type="hidden" name="act" value="add_type">
											<select name="start_odds" id="">
												<?php for ($i=680; $i <= 1000; $i++) {?>
												<option value="<?php echo $i;?>"><?php echo $i;?></option>
												<?php }?>
											</select>
											<select name="end_odds" id="">
												<?php for ($i=1000; $i >= 680; $i--) {?>
												<option value="<?php echo $i;?>"><?php echo $i;?></option>
												<?php }?>
											</select>
											<input type="submit" value="添加">
											</form>
										</td>
										<td colspan="3">赔率分类</td>
										<td>码数</td>
										<td>金额</td>
									</tr>
									<tr>
										<td colspan="2"></td>
										<td colspan="5"></td>
									</tr>
									<!-- 内容 -->
									<tr style="height:80%;">
										<td colspan="2"></td>
										<td colspan="5">
											<div style="overflow-y: auto; height: 100%; width:100%;">
												<!-- <table style="width:100%">
												<?php foreach ($orders_type as $key => $value){?>
													<tr class="type_change">
														<td colspan="3" data="<?php echo $value['id'];?>"><img id="menuimg_showfix_782" src="../picture/menu_add.gif" border="0" style="background:#ccc;margin-right:10px;"><?php echo $value['start_odds'];?>-<?php echo $value['end_odds'];?> 总额</td>
														<td width="20%">
															<?php 
																$ms=$db->get_one('select count(*) from orders where plate_num='.$plate_num.' and stattuima=0 and is_water=0 and o_type2="'.$_GET['o_typename'].'" and orders_p BETWEEN '.$value['start_odds'].' AND '.$value['end_odds']);
																echo $ms['count(*)'];
															?>
														</td>
														<td width="20%">
															<?php 
																$ms=$db->get_one('select SUM(orders_y) as sum_y from orders where plate_num='.$plate_num.' and stattuima=0 and is_water=0 and o_type2="'.$_GET['o_typename'].'" and orders_p BETWEEN '.$value['start_odds'].' AND '.$value['end_odds']);
																echo $ms['sum_y'];
															?>
														</td>
													</tr>
													<tr>
														<td width="20%"></td>
														<td width="20%">割 1</td>
														<td width="20%"></td>
														<td width="20%"></td>
														<td width="20%"></td>
													</tr>
													<tr class="type_change">
														<td width="20%"></td>
														<td width="20%">剩数</td>
														<td width="20%"></td>
														<td width="20%"></td>
														<td width="20%"></td>
													</tr>
													<tr><td colspan="5"></td></tr>
												<?php }?>
													<tr></tr>
												</table> -->
												<?php foreach ($orders_type as $key => $value){?>
												<div class="dtree" data="<?php echo $value['id'];?>"> 
												   <div class="clip" style="display:block;color:#090;<?php if($_GET['start']==$value['start_odds'] && $_GET['end']==$value['end_odds']){echo 'border:1px solid red;float:left;width:100%;';}?>">
												    <div class="dTreeNode">
												     <a href="javascript:;">
												     <img class="jd1" src="./right_files/minus.gif" alt="" data="off"/></a>
												     <div style="width:50%;float:left;">
												     <span style="float:left;">分类</span>
												     <a href="business.php?o_typename=<?php echo $_GET['o_typename'];?>&start=<?php echo $value['start_odds'];?>&end=<?php echo $value['end_odds'];?>&dtree_type=<?php echo $value['id'];?>" title="main1" style="color:#090;"><?php echo $value['start_odds'];?>-<?php echo $value['end_odds'];?> 总额</a></div>
												     <div style="width:10%;float:left;"><?php 
																$ms=$db->get_all('select o_type3 from orders where plate_num='.$plate_num.' and stattuima=0 and is_water=0 and o_type2="'.$_GET['o_typename'].'" and orders_p BETWEEN '.$value['start_odds'].' AND '.$value['end_odds'].' group by o_type3');
																echo $msc=count($ms);
															?></div>
												     <div style="width:30%;float:left;"><?php 
																$ms=$db->get_one('select SUM(orders_y) as sum_y from orders where plate_num='.$plate_num.' and stattuima=0 and is_water=0 and o_type2="'.$_GET['o_typename'].'" and orders_p BETWEEN '.$value['start_odds'].' AND '.$value['end_odds']);
																echo $ms['sum_y'];
															?></div>
												    </div>
												     </div>
												     <div style="clear:both;"></div>
												     <?php 
												     	// $top_code=$db->get_all('select * from cut_code where type_id='.$value['id']." group by cut_type");
												     	$cut_code=$db->get_all('select * from cut_code where type_id='.$value['id']." group by cut_type,cut_num");
												     ?>
												     <!-- 切码列表 -->
												     <?php if (!empty($cut_code)){?>
												     <?php $last_cut_m=0;?>
												     <?php foreach ($cut_code as $k => $v){?>
												    <div class="dTreeNode node3 <?php if($_GET['cut_num']==$v['cut_num'] && $_GET['type_id']==$v['type_id'] && $_GET['cut_type']==$v['cut_type']){ echo 'chan_type';}?>" style="">
												    <div style="width:50%;float:left;">
												     <img src="./right_files/join.gif" alt="" />
												     <img id="id2" src="./right_files/page.gif" alt="" />
												     <a id="sd2" class="node" href="business.php?o_typename=<?php echo $_GET['o_typename'];?>&cut_type=<?php echo $v['cut_type'];?>&type_id=<?php echo $v['type_id'];?>&cut_num=<?php echo $v['cut_num'];?>" style="color:red;"><?php echo $v['cut_type'];?>(<?php echo $v['cut_num'];?>)</a>
												    </div>
												     <div style="width:10%;color:red;float:left;"><?php
																$cut_count=$db->get_all('select number from cut_code where cut_type="'.$v['cut_type'].'" and type_id='.$value['id'].' and cut_num='.$v['cut_num'].' group by number');

																echo count($cut_count);
															?></div>
													<div style="width:30%;color:red;float:left;"><?php
																$cut_m=$db->get_one('select SUM(money) as m from cut_code where cut_type="'.$v['cut_type'].'" and type_id='.$value['id'].' and cut_num='.$v['cut_num']);
																echo $cut_m['m'];
																$last_cut_m +=$cut_m['m'];
															?></div>
												    </div>
												    <!-- 切码列表end -->
												    <?php $a=$msc-count($cut_count);$b=$ms['sum_y']-$last_cut_m;?>
												     <?php }?>
												     <?php }else { $a=$msc-0;$b=$ms['sum_y']-0;?>
												     <?php }?>
												    <div style="clear:both;"></div>
													<!-- 切码列表end -->
													<!-- 分类剩数 -->
												    <div class="dTreeNode node2" onClick="javascript:location.href='business.php?o_typename=<?php echo $_GET['o_typename'];?>&s_type_id=<?php echo $value['id'];?>';" style="float:left;width:99%; <?php if($value['id']==$_GET['s_type_id']){ echo "border:1px solid red;";}?>" data="<?php echo $value['id'];?>" start="<?php echo $value['start_odds']?>" end="<?php echo $value['end_odds'];?>" <?php if($value['id']==$_GET['s_type_id']){echo "id='chan_ss'";}?>>
												     <img src="./right_files/join.gif" alt="" />
												     <div style="width:50%;float:left;">
												     <span style="float:left;">剩数</span>
												     <a id="sd2" class="node" href="javascript:;" style="color:#FF6600;"></a>
												     </div>
												     <!-- 剩余码数 -->
												     <div style="width:10%;float:left;"><?php
																echo $msc;
															?></div>
													<!-- 剩余金额 -->
													<div style="width:30%;float:left;"><?php
																echo $b;
															?></div>
												    </div>
												    <!-- 分类剩数end -->
												    <div style="clear:both;"></div>
												</div>
												<?php }?>
											</div>
										</td>
									</tr>
									<!-- 内容end -->
									<tr>
										<td colspan="2"></td>
										<td colspan="3">总剩数</td>
										<td></td>
										<td></td>
									</tr>
									<!-- <tr>
										<td colspan="7" style="height:10px;"></td>
									</tr> -->
									<!-- 三字定操作 -->
									<tr>
										<td><a href="javascript:;" id="zdy" data-title="自定义表">自定义割</a></td>
										<td><a href="javascript:;" id="gph" data-title="平衡表">割平衡</a></td>
										<td><a href="javascript:;" id="gbm" data-title="爆码表">割爆码</a></td>
										<td><a href="javascript:;" id="bfb"  data-title="割码表">割百分比</a></td>
										<td><a id="del_type" data="<?php if($_GET['start']==$value['start_odds'] && $_GET['end']==$value['end_odds']){echo $_GET['dtree_type'];}?>" href="javascript:;">删除</a></td>
										<td><a href="">打&nbsp;&nbsp;&nbsp;&nbsp;印</a></td>
										<td><a href="javascript:;" id="down_txt">导出文件</a></td>
									</tr>
									<!-- 三字定操作end -->
								</table>
							</td>
						</tr>
						<?php }?>
						<!-- 三字定end -->
						<!-- 四字定 -->
						<?php if ($o_topid['o_typename']=='四字定'){?>
						<?php 
							$o_type3=$db->get_all('select o_type2,o_type3 from orders where stattuima=0 and is_water=0 and plate_num='.$plate_num.' and o_type2="口口口口"'.$where_type3.' group by o_type3 order by o_type3 ASC');
							// var_dump($o_type3);exit;
						?>
						<tr class="reportTop">
							<td colspan="10">
								<table style="width:100%;height:100%;min-height:600px;" class="tableborder" border="0" cellpadding="0" cellspacing="0">
									<tbody>
										<tr class="reportTop">
											<?php foreach ($odds_type as $key => $value){?>	
												<td><a href="business.php?o_typename=<?php echo $value['o_typename'];?>" style="<?php if($value['o_topid']=='二字定'){echo 'color:#3e8d3e;';}if($value['o_topid']=='三字定'){echo 'color:#0066cd;';}if($value['o_typename']=='四字定'){echo 'color:#ff0736;';}?>font-weight:bold;font-size:16px;<?php if($_GET['o_typename']==$value['o_typename']){echo 'border:1px solid red;background:#FFFFC4;';}?>"><?php echo $value['o_typename'];?></a></td>
											<?php }?>
										</tr>
										<tr><td style="height:10px;" colspan="11"></td></tr>
											<tr>
												<?php foreach($o_type3 as $key => $value){?>
													<td style="border:none;">
														<table style="width:100%;height:100%;">
															<tr><td style="padding:0px;background:#b5e5bb;height:10px;">
																<?php echo $value['o_type3'];?>
															</td></tr>
															<?php 
																$count_y=$db->get_one('select SUM(orders_y) as count_y from orders where stattuima=0 and is_water=0 and plate_num='.$plate_num.' and  o_type3="'.$value['o_type3'].'"');
															?>
															<tr><td style="color:blue;font-size:16px;"><?php ${'t'.(($key)%11)}=${'t'.(($key)%11)}+$count_y['count_y']; echo $count_y['count_y'];?></td></tr>
														</table>
													</td>
												<?php if(($key+1)%11==0){echo '</tr><tr>';}?>
												<?php ${'f'.(($key)%11)}=$count_y['count_y']+${'f'.(($key)%11)};?>
												<?php }?>
												<tr></tr>
											</tr>
										<tr>
											<?php for($y=0;$y<=9;$y++){?>
												<td style="background:#d8d8d8;border:none;">
													<table style="width:100%;height:100%;">
														<tr><td style="background:#d8d8d8;height:10px;">合计</td></tr>
														<tr><td style="color:red;font-size:16px;"><?php echo ${'f'.$y};?></td></tr>
													</table>
												</td>
												<?php $c=${'f'.$y}+$c;?>
											<?php }?>
											<td style="background:#fd0009;border:none;">
											<table style="width:100%;height:100%;">
													<tr><td style="background:#fd0009;height:10px;color:#fff;">总额合计</td></tr>
													<tr><td style="color:blue;font-size:16px;"><?php echo $c;?></td></tr>
											</table>
											</td>
										</tr>
									</tbody>
								</table>
							</td>
							<td colspan="6" style="padding:5px 0px 0px 10px;">
								<table border="0" cellpadding="0" cellspacing="0" style="width:100%;height:100%;" class="tableborder">
									<tr>
										<td colspan="2"><?php echo $_GET['o_typename']?></td>
										<td colspan="5">总金额：笔，元</td>
									</tr>
									<tr>
										<td colspan="2">
											<form action="business.php" method="get">
											<input type="hidden" name="o_typename" value="<?php echo $_GET['o_typename'];?>">
											<input type="hidden" name="act" value="add_type">
											<select name="start_odds" id="">
												<?php for ($i=6800; $i <= 10000; $i++) {?>
												<option value="<?php echo $i;?>"><?php echo $i;?></option>
												<?php }?>
											</select>
											<select name="end_odds" id="">
												<?php for ($i=10000; $i >= 6800; $i--) {?>
												<option value="<?php echo $i;?>"><?php echo $i;?></option>
												<?php }?>
											</select>
											<input type="submit" value="添加">
											</form>
										</td>
										<td colspan="3">赔率分类</td>
										<td>码数</td>
										<td>金额</td>
									</tr>
									<tr>
										<td colspan="2"></td>
										<td colspan="5"></td>
									</tr>
									<!-- 内容 -->
									<tr style="height:80%;">
										<td colspan="2"></td>
										<td colspan="5">
											<div style="overflow-y: auto; height: 100%; width:100%;">
												<!-- <table style="width:100%">
												<?php foreach ($orders_type as $key => $value){?>
													<tr class="type_change">
														<td colspan="3" data="<?php echo $value['id'];?>"><img id="menuimg_showfix_782" src="../picture/menu_add.gif" border="0" style="background:#ccc;margin-right:10px;"><?php echo $value['start_odds'];?>-<?php echo $value['end_odds'];?> 总额</td>
														<td width="20%">
															<?php 
																$ms=$db->get_one('select count(*) from orders where plate_num='.$plate_num.' and stattuima=0 and is_water=0 and o_type2="'.$_GET['o_typename'].'" and orders_p BETWEEN '.$value['start_odds'].' AND '.$value['end_odds']);
																echo $ms['count(*)'];
															?>
														</td>
														<td width="20%">
															<?php 
																$ms=$db->get_one('select SUM(orders_y) as sum_y from orders where plate_num='.$plate_num.' and stattuima=0 and is_water=0 and o_type2="'.$_GET['o_typename'].'" and orders_p BETWEEN '.$value['start_odds'].' AND '.$value['end_odds']);
																echo $ms['sum_y'];
															?>
														</td>
													</tr>
													<tr>
														<td width="20%"></td>
														<td width="20%">割 1</td>
														<td width="20%"></td>
														<td width="20%"></td>
														<td width="20%"></td>
													</tr>
													<tr class="type_change">
														<td width="20%"></td>
														<td width="20%">剩数</td>
														<td width="20%"></td>
														<td width="20%"></td>
														<td width="20%"></td>
													</tr>
													<tr><td colspan="5"></td></tr>
												<?php }?>
													<tr></tr>
												</table> -->
												<?php foreach ($orders_type as $key => $value){?>
												<div class="dtree" data="<?php echo $value['id'];?>"> 
												   <div class="clip" style="display:block;color:#090;<?php if($_GET['start']==$value['start_odds'] && $_GET['end']==$value['end_odds']){echo 'border:1px solid red;float:left;width:100%;';}?>">
												    <div class="dTreeNode">
												     <a href="javascript:;">
												     <img class="jd1" src="./right_files/minus.gif" alt="" data="off"/></a>
												     <div style="width:50%;float:left;">
												     <span style="float:left;">分类</span>
												     <a href="business.php?o_typename=<?php echo $_GET['o_typename'];?>&start=<?php echo $value['start_odds'];?>&end=<?php echo $value['end_odds'];?>&dtree_type=<?php echo $value['id'];?>" title="main1" style="color:#090;"><?php echo $value['start_odds'];?>-<?php echo $value['end_odds'];?> 总额</a></div>
												     <div style="width:10%;float:left;"><?php 
																$ms=$db->get_all('select o_type3 from orders where plate_num='.$plate_num.' and stattuima=0 and is_water=0 and o_type2="'.$_GET['o_typename'].'" and orders_p BETWEEN '.$value['start_odds'].' AND '.$value['end_odds'].' group by o_type3');
																echo $msc=count($ms);
															?></div>
												     <div style="width:30%;float:left;"><?php 
																$ms=$db->get_one('select SUM(orders_y) as sum_y from orders where plate_num='.$plate_num.' and stattuima=0 and is_water=0 and o_type2="'.$_GET['o_typename'].'" and orders_p BETWEEN '.$value['start_odds'].' AND '.$value['end_odds']);
																echo $ms['sum_y'];
															?></div>
												    </div>
												     </div>
												     <div style="clear:both;"></div>
												     <?php 
												     	// $top_code=$db->get_all('select * from cut_code where type_id='.$value['id']." group by cut_type");
												     	$cut_code=$db->get_all('select * from cut_code where type_id='.$value['id']." group by cut_type,cut_num");
												     ?>
												     <!-- 切码列表 -->
												     <?php if (!empty($cut_code)){?>
												     <?php $last_cut_m=0;?>
												     <?php foreach ($cut_code as $k => $v){?>
												    <div class="dTreeNode node3 <?php if($_GET['cut_num']==$v['cut_num'] && $_GET['type_id']==$v['type_id'] && $_GET['cut_type']==$v['cut_type']){ echo 'chan_type';}?>" style="">
												    <div style="width:50%;float:left;">
												     <img src="./right_files/join.gif" alt="" />
												     <img id="id2" src="./right_files/page.gif" alt="" />
												     <a id="sd2" class="node" href="business.php?o_typename=<?php echo $_GET['o_typename'];?>&cut_type=<?php echo $v['cut_type'];?>&type_id=<?php echo $v['type_id'];?>&cut_num=<?php echo $v['cut_num'];?>" style="color:red;"><?php echo $v['cut_type'];?>(<?php echo $v['cut_num'];?>)</a>
												    </div>
												     <div style="width:10%;color:red;float:left;"><?php
																$cut_count=$db->get_all('select number from cut_code where cut_type="'.$v['cut_type'].'" and type_id='.$value['id'].' and cut_num='.$v['cut_num'].' group by number');

																echo count($cut_count);
															?></div>
													<div style="width:30%;color:red;float:left;"><?php
																$cut_m=$db->get_one('select SUM(money) as m from cut_code where cut_type="'.$v['cut_type'].'" and type_id='.$value['id'].' and cut_num='.$v['cut_num']);
																echo $cut_m['m'];
																$last_cut_m +=$cut_m['m'];
															?></div>
												    </div>
												    <!-- 切码列表end -->
												    <?php $a=$msc-count($cut_count);$b=$ms['sum_y']-$last_cut_m;?>
												     <?php }?>
												     <?php }else { $a=$msc-0;$b=$ms['sum_y']-0;?>
												     <?php }?>
												    <div style="clear:both;"></div>
													<!-- 切码列表end -->
													<!-- 分类剩数 -->
												    <div class="dTreeNode node2" onClick="javascript:location.href='business.php?o_typename=<?php echo $_GET['o_typename'];?>&s_type_id=<?php echo $value['id'];?>';" style="float:left;width:99%; <?php if($value['id']==$_GET['s_type_id']){ echo "border:1px solid red;";}?>" data="<?php echo $value['id'];?>" start="<?php echo $value['start_odds']?>" end="<?php echo $value['end_odds'];?>" <?php if($value['id']==$_GET['s_type_id']){echo "id='chan_ss'";}?>>
												     <img src="./right_files/join.gif" alt="" />
												     <div style="width:50%;float:left;">
												     <span style="float:left;">剩数</span>
												     <a id="sd2" class="node" href="javascript:;" style="color:#FF6600;"></a>
												     </div>
												     <!-- 剩余码数 -->
												     <div style="width:10%;float:left;"><?php
																echo $msc;
															?></div>
													<!-- 剩余金额 -->
													<div style="width:30%;float:left;"><?php
																echo $b;
															?></div>
												    </div>
												    <!-- 分类剩数end -->
												    <div style="clear:both;"></div>
												</div>
												<?php }?>
											</div>
										</td>
									</tr>
									<!-- 内容end -->
									<tr>
										<td colspan="2"></td>
										<td colspan="3">总剩数</td>
										<td></td>
										<td></td>
									</tr>
									<!-- <tr>
										<td colspan="7" style="height:10px;"></td>
									</tr> -->
									<!-- 四字定操作 -->
									<tr>
										<td><a href="javascript:;" id="zdy" data-title="自定义表">自定义割</a></td>
										<td><a href="javascript:;" id="gph" data-title="平衡表">割平衡</a></td>
										<td><a href="javascript:;" id="gbm" data-title="爆码表">割爆码</a></td>
										<td><a href="javascript:;" id="bfb"  data-title="百分比表">割百分比</a></td>
										<td><a id="del_type" data="<?php if($_GET['start']==$value['start_odds'] && $_GET['end']==$value['end_odds']){echo $_GET['dtree_type'];}?>" href="javascript:;">删除</a></td>
										<td><a href="">打&nbsp;&nbsp;&nbsp;&nbsp;印</a></td>
										<td><a href="javascript:;" id="down_txt">导出文件</a></td>
									</tr>
									<!-- 四字定操作end -->
								</table>
							</td>
						</tr>
						<?php }?>
						<!-- 四字定end -->
						</tbody>
					</table>
				</div>
			</td>
		</tr>
	</table>
</body>
</html>
<script type="text/javascript">
	// $(document).on('click','.type_change',function(){
	// 	if ($(this).attr('is_chan')==1) {
	// 		$('.type_change').children('td').css('background','#FFFFC4');
	// 		$(this).children('td').css('background','#F0F0F0');
	// 		$(this).attr('is_chan','');
	// 	}else{
	// 		$('.type_change').children('td').css('background','#F0F0F0');
	// 		$(this).children('td').css('background','#FFFFC4');
	// 		$(this).attr('is_chan','1');
	// 	};
	// });
	//选中分类
	$(document).on('click','.dtree',function(){
		var id=$(this).attr('data');
		$(this).css('background','#fbffe1');
		$(this).siblings().css('background','#f0f0f0');
		$('#del_type').attr('data',id);

	})
	// 删除分类
	$('#del_type').click(function(){
		var id=$(this).attr('data');
		var cut_type="<?php echo $_GET['cut_type'];?>";
		var type_id="<?php echo $_GET['type_id'];?>";
		var cut_num="<?php echo $_GET['cut_num'];?>";
		var o_typename='<?php echo $_GET["o_typename"];?>';
		if (id) {		
			$.ajax({
				type:'post',
				url:'edit_business.php?act=del_type',
				data:{'id':id,'o_typename':o_typename},
				dataType:'json',
				success:function(d){
					if (d=='1') {
						window.location.href="business.php?o_typename="+o_typename;
					};
				}
			})
		}else if (cut_type && type_id && cut_num) {
			$.ajax({
				type:'post',
				url:'edit_business.php?act=del_type',
				data:{'cut_type':cut_type,'type_id':type_id,'cut_num':cut_num,'o_typename':o_typename},
				dataType:'json',
				success:function(d){
					if (d=='1') {
						window.location.href="business.php?o_typename="+o_typename;
					};
				}
			})
		}else{
			alert('请选择分类');
		};
	})

	// 导出txt
	$('#down_txt').click(function(){
		var cut_type="<?php echo $_GET['cut_type'];?>";
		var type_id="<?php echo $_GET['type_id'];?>";
		var cut_num="<?php echo $_GET['cut_num'];?>";
		var o_typename='<?php echo $_GET["o_typename"];?>';
		if (cut_type && type_id && cut_num) {
			window.location.href="edit_business.php?act=down_txt&o_typename="+o_typename+'&cut_type='+cut_type+'&type_id='+type_id+'&cut_num='+cut_num;
		}else{
			alert('请选择分类');
		};
	})
	// 分类下拉
	// $(function(){	
	// 	$('.jd1').attr('data','off');
	// 	$('.jd1').attr('src','./right_files/minus.gif');
	// 	$('.jd1').parent().parent().parent().parent().children('.node2').show();
	// })
	$(document).on('click','.jd1',function(){
		var data=$(this).attr('data');
		if (!data || data=='on') {
			$(this).parent().parent().parent().parent().children('.node2').show();
			$(this).parent().parent().parent().parent().children('.node3').show();
			$(this).attr('data','off');
			$(this).attr('src','./right_files/minus.gif');
		};
		if (data=='off') {
			$(this).parent().parent().parent().parent().children('.node2').hide();
			$(this).parent().parent().parent().parent().children('.node3').hide();
			$(this).attr('data','on');
			$(this).attr('src','./right_files/plus.gif');
		};
	});
	// 剩数选择
	$(document).on('click','.node2',function(){
		$(this).parent().siblings().find('.node2').css('border','none');
		$(this).parent().siblings().find('.node2').attr('id','');
		$(this).css('border','1px solid #ff0000');
		$(this).attr('id','chan_ss');
	}) 
	// 限制割码按钮
	$('.foot_btn,.top_btn').click(function(){
		var btn=$(this);
		var is_q=$(this).val();
		var num=$(this).attr('num');
		var data=$(this).attr('data');
		var o_typename="<?php echo $_GET['o_typename'];?>";
		var off_num=$('.off_num').val();
		$.ajax({
			url:'edit_business.php?act=ban',
			type:'post',
			data:{'is_q':is_q,'num':num,'type':data,'typename':o_typename,'off_p':off_num},
			dataType:'json',
			success:function(data){
				btn.val(data.res);
				if (data.res=='正常割') {
					btn.css('color','#268324');
				}else{
					btn.css('color','red');
				};
			}
		})

	})
	//限制组数
	$('.off_num').blur(function(){
		var num=$(this).val();
		var o_typename="<?php echo $_GET['o_typename'];?>";
		$.ajax({
			url:'edit_business.php?act=ban_p',
			type:'post',
			data:{'num':num,'typename':o_typename},
			dataType:'json',
			success:function(data){
				
			}
		})
	})
		// 百分比
	$('#bfb').click(function(){	
		var widths='1200px';
		var heights='90%';
		var o_typename='<?php echo $_GET["o_typename"];?>';
		if ((o_typename.split("口").length-1)==3 || o_typename=='四字定') {
			widths='450px';
			heights='200px';
		};
		var start=$('#chan_ss').attr('start');
		var end=$('#chan_ss').attr('end');
		var data=$('#chan_ss').attr('data');
		if (!start && !end) {
			alert('请选择分类');return false;
		};
	 //  window.open ("bfb.php?o_typename="+o_typename+"&s_type_id="+data+"&start="+start+"&end="+end, "newwindow", "height=600px, width=1000, toolbar =no, menubar=no, scrollbars=no, resizable=no, location=no, status=no") //写成一行 
	 $('#bfb').createModal({
            background: "red",//设定弹窗之后的覆盖层的颜色
            width: widths,//设定弹窗的宽度
            height: heights,//设定弹窗的高度
            resizable: true,//设定弹窗是否可以拖动改变大小
			bgClose: false,
            html: '<iframe class="bfb_box" style="width:100%;height:100%;" src="bfb.php?o_typename='+o_typename+'&s_type_id='+data+'&start='+start+'&end='+end+'" frameborder="0"></iframe>'
        });
	 if ((o_typename.split("口").length-1)==3) {
			// $('.top_left').html('2423');
			$('.bfb_box').css('height','170px');
			$('.modal-title').parent().css({'left':'30%','top':'30%'});
			// heights='250px';
		};
	})
		// 自定义
	$('#zdy').click(function(){	
		var o_typename='<?php echo $_GET["o_typename"];?>';
		var start=$('#chan_ss').attr('start');
		var end=$('#chan_ss').attr('end');
		var data=$('#chan_ss').attr('data');
		if (!start && !end) {
			alert('请选择分类');return false;
		};
	  $('#zdy').createModal({
            background: "red",//设定弹窗之后的覆盖层的颜色
            width: "1200px",//设定弹窗的宽度
            height: "90%",//设定弹窗的高度
            resizable: true,//设定弹窗是否可以拖动改变大小
			bgClose: false,
            html: '<iframe style="width:100%;height:100%;" src="zdy.php?o_typename='+o_typename+'&s_type_id='+data+'&start='+start+'&end='+end+'" frameborder="0"></iframe>'
        });
	})
		// 割平衡
	$('#gph').click(function(){	
		var o_typename='<?php echo $_GET["o_typename"];?>';
		var start=$('#chan_ss').attr('start');
		var end=$('#chan_ss').attr('end');
		var data=$('#chan_ss').attr('data');
		if (!start && !end) {
			alert('请选择分类');return false;
		};
	  $('#gph').createModal({
            background: "red",//设定弹窗之后的覆盖层的颜色
            width: "1200px",//设定弹窗的宽度
            height: "90%",//设定弹窗的高度
            resizable: true,//设定弹窗是否可以拖动改变大小
			bgClose: false,
            html: '<iframe style="width:100%;height:100%;" src="gph.php?o_typename='+o_typename+'&s_type_id='+data+'&start='+start+'&end='+end+'" frameborder="0"></iframe>'
        });
	})
		// 割爆码
	$('#gbm').click(function(){	
		var o_typename='<?php echo $_GET["o_typename"];?>';
		var start=$('#chan_ss').attr('start');
		var end=$('#chan_ss').attr('end');
		var data=$('#chan_ss').attr('data');
		if (!start && !end) {
			alert('请选择分类');return false;
		};
	  $('#gbm').createModal({
            background: "red",//设定弹窗之后的覆盖层的颜色
            width: "1200px",//设定弹窗的宽度
            height: "90%",//设定弹窗的高度
            resizable: true,//设定弹窗是否可以拖动改变大小
			bgClose: false,
            html: '<iframe style="width:100%;height:100%;" src="gbm.php?o_typename='+o_typename+'&s_type_id='+data+'&start='+start+'&end='+end+'" frameborder="0"></iframe>'
        });
	})
</script>