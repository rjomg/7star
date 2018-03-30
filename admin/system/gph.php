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
// if ($_GET['start'] && $_GET['end']) {
// 	$where_type3=' and orders_p >= '.$_GET['start'].' and orders_p <= '.$_GET['end'];
// }else{
// 	$where_type3='';
// }
if ($_GET['s_type_id']) {
	$types=$db->get_one('select start_odds,end_odds from orders_type where id='.$_GET['s_type_id']);
	$where_type3=' and orders_p >= '.$types['start_odds'].' and orders_p <= '.$types['end_odds'];
}else{
	$where_type3='';
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>割平衡</title>
	<link href="../css/admincg.css" rel="stylesheet" type="text/css" />
	<script src="../js/jquery.min.js" type="text/javascript"></script>
	<style media=print> .Noprint{display:none;}</style>
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
</head>
<body>
<div id="showTotallog">
	<table border="0" cellpadding="0" cellspacing="0" class="tableborder" width="100%" style="table-layout: auto;">
	<?php if ($o_topid['o_topid']=='二字定'){?>
	<tr cellpadding="10" class="reportTop">
	<!-- 左侧切割码 -->
		<td colspan="10" style="padding:5px;">
			<table style="width:100%;height:100%;" class="tableborder" border="0" cellpadding="0" cellspacing="0">
				<tbody>
					<tr><td style="height:10px;" colspan="11"></td></tr>
					<?php for($i=0;$i<=9;$i++){?>
						<tr>
							<?php for($y=0;$y<=9;$y++){?>
								<td style="border:none;">
									<table style="width:100%;height:100%;">
										<tr><td style="padding:0px;background:#b5e5bb;height:10px;">
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
										<tr><td data="<?php echo $o_type3;?>" class="left_num left_<?php echo $i.$y;?>" style="color:blue;font-size:16px;border:2px solid #ccc;background:#fff;"></td></tr>
									</table>
								</td>
							<?php }?>
							<td style="border:none;">
								<table style="width:100%;height:100%;">
									<tr><td style="background:#d8d8d8;height:10px;"><?php echo $i;?>头合计</td></tr>
									<tr><td style="color:red;font-size:16px;"></td></tr>
								</table>
							</td>
						</tr>
					<?php }?>
					<tr>
						<?php for($y=0;$y<=9;$y++){?>
							<td style="background:#d8d8d8;border:none;">
								<table style="width:100%;height:100%;">
									<tr><td style="background:#d8d8d8;height:10px;"><?php echo $y;?>尾合计</td></tr>
									<tr><td style="color:red;font-size:16px;"></td></tr>
								</table>
							</td>
						<?php }?>
						<td style="background:#fd0009;border:none;">
						<table style="width:100%;height:100%;">
								<tr><td style="background:#fd0009;height:10px;color:#fff;">总额合计</td></tr>
								<tr><td style="color:blue;font-size:16px;"></td></tr>
						</table>
						</td>
					</tr>
				</tbody>
			</table>
		</td>
		<!-- 右侧剩余数 -->
		<td colspan="10" style="padding:5px;">
			<table style="width:100%;height:100%;" class="tableborder" border="0" cellpadding="0" cellspacing="0">
				<tbody>
					<tr><td style="height:10px;" colspan="11"></td></tr>
					<?php for($i=0;$i<=9;$i++){?>
						<tr>
							<?php for($y=0;$y<=9;$y++){?>
								<td style="border:none;">
									<table style="width:100%;height:100%;">
										<tr><td style="padding:0px;background:#b5e5bb;height:10px;">
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
											// $count_y=$db->get_one('select SUM(orders_y) as count_y from orders where stattuima=0 and is_water=0 and plate_num='.$plate_num.' and  o_type3="'.$o_type3.'"'.$where_type3);
											$old_count=$db->get_one('select SUM(orders_y) as count_y from orders where stattuima=0 and is_water=0 and plate_num='.$plate_num.' and  o_type3="'.$o_type3.'"'.$where_type3);
											$q_count=$db->get_one('select SUM(money) as count_y from cut_code where number="'.$o_type3.'" and type_id='.$_GET['s_type_id']);
											$count_y['count_y']=($old_count['count_y']-$q_count['count_y'])==0?'':($old_count['count_y']-$q_count['count_y']);
										?>
										<tr><td data="<?php echo $i.$y;?>" class="right_num right_<?php echo $i.$y;?>" style="color:blue;font-size:16px;"><?php ${'t'.$i}=${'t'.$i}+$count_y['count_y']; echo $count_y['count_y'];?></td></tr>
									</table>
								</td>
							<?php ${'f'.$y}=$count_y['count_y']+${'f'.$y};?>
							<?php }?>
							<td style="border:none;">
								<table style="width:100%;height:100%;">
									<tr><td style="background:#d8d8d8;height:10px;"><?php echo $i;?>头合计</td></tr>
									<tr><td style="color:red;font-size:16px;"><?php echo ${'t'.$i};${'t'.$i}=0;?></td></tr>
								</table>
							</td>
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
					</tr>
				</tbody>
			</table>
		</td>
	</tr>
	<?php }?>
	<tr>
		<td colspan="20" style="padding:10px;">
			<table style="border:none;width:100%;">
				<tr>
					<td style="text-align:left;">原表总额<input type="text" disabled style="width:60px;" value="<?php echo $c;?>" /></td>
					<td style="width:100px"></td>
					<td colspan="5" rowspan="2"><input id="minus_bfb" type="button" value="切割" style="height:100%;"/></td>
					<!-- <td style="width:100px"></td>
					<td><input type="button" value="减去『余数表』"/></td>
					<td style="width:100px"></td>
					<td><input type="button" value="打印百分比表"/></td> -->
					<td style="width:100px"></td>
					<td rowspan="2"><input type="button" value="取消退出" onClick="javascript:closeWin();" style="height:100%;" /></td>
				</tr>
				<tr>
					<td style="text-align:left;">百分比<input class="keyup" maxlength="3" type="text" style="width:60px;"/>%</td>
					<td style="width:100px"></td>
					<!-- <td><input type="button" value="加上『百分比表』"/></td>
					<td style="width:100px"></td>
					<td><input type="button" value="加上『余数表』"/></td>
					<td style="width:100px"></td> -->
					<!-- <td><input type="button" value="打印余额表"/></td> -->
				</tr>
			</table>
		</td>
	</tr>
	</table>
</div>
</body>
</html>
<script>
	function closeWin(){
		window.opener=null; 
		window.open('','_self',''); 
		window.close(); 
	}

	// 设置百分比
	$('.keyup').keyup(function(){
		var key_num=$(this).val();
		if (key_num>100) {key_num=100};
		$(this).val(key_num);
		$('.right_num').each(function(){
			var old_num=$(this).html();
			var data=$(this).attr('data');
			var num=parseInt(($(this).html())*(key_num/100));
			if (old_num) {	
				$('.left_'+data).html(num);
			};
			// $(this).html(old_num-num);
		})
		
	})

	// 减去百分比表
	// $('#minus_bfb').click(function(){
	// 	var id='<?php echo $_GET["id"];?>';
	// 	var obj_str='';
	// 	$('.left_num').each(function(){
	// 		var q_num=$(this).html();
	// 		var type3=$(this).attr('data');
	// 		if (q_num>0) {
	// 			obj_str +=type3+':'+q_num+',';
	// 		};
	// 	})
	// 		$.ajax({
	// 			type:'POST',
	// 			url:'edit_business.php?act=minus_bfb',
	// 			data:{'data':obj_str,'id':id},
	// 			dataType:'json',
	// 			success:function(data){
	// 				if (data=='1') {
	// 					alert('切码成功');
	// 					window.opener=null; 
	// 					window.open('','_self',''); 
	// 					window.close();
	// 				}else{
	// 					alert('切码失败');
	// 				};
	// 			}
	// 		})
	// })
</script>