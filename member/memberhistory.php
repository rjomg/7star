<?php 

include_once( "../global.php" );

$db = new plate( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );

$user_id=$_SESSION['uid'.$c_p_seesion];

$query = $db->findall( "orders where user_id={$user_id} and stattuima=0 group by plate_num order by plate_num DESC");

// $orders = $db->fetch_array( $query );

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<link rel="stylesheet" type="text/css" id="css" href="./css/members.css">

<style>html{overflow-y:scroll;}</style>



</head>

<body style="margin: 0px"  >





<table width="99%" border="0" cellpadding="0" cellspacing="0" align=center>

<tr>

<td style="padding:0px">

	<script src="./js/common.js" type="text/javascript"></script>

	<table width="100%" border="0" cellpadding="0" cellspacing="0" class="soon_b" >
    <?php
    $new_plate=$db->get_one('select plate_num, plate_time_end from plate order by id DESC');
    $plate_num=$new_plate['plate_num'];
    $now_date = date('m-d',strtotime($new_plate['plate_time_end']));
    ?>
	<tr class="header_left_b"><td colspan="14">历史账单<span id="bill_issueno_start"><select name="s_issueno_start" id="s_issueno_start" onchange="cgBill.Search();"><option value="18038" selected=""><?php echo $now_date;?>(<?php echo $plate_num;?>)</option></select></span> >> <span id="bill_issueno_end"><select name="s_issueno_end" id="s_issueno_end" onchange="cgBill.Search();"><option value="18038" selected=""><?php echo $now_date;?>(<?php echo $plate_num;?>)</option></select></span> </td></tr>

	<tr class="soon_head" > 

		<td width="14%" >日期</td>

		<td width="14%"  >期号</td>

		<td width="14%"  >笔数</td>

		<td width="*" >金额</td>

		<td width="14%" >回水</td>

		<td width="14%" >中奖</td>

		<td width="14%" >盈亏</td>



	</tr>

	<?php $dbnum = new action( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );$dby = new action( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );?>

	<?php $i = 0; $sum_mn='';$sum_bs='';$sum_ht;$sum_iw;$sum_yk; while ( $row = $db->fetch_array( $query ) ){?>

	<?php

     	$num = $dbnum->select( "orders", "count(*) as c","user_id={$row['user_id']} and plate_num={$row['plate_num']} and stattuima=0" );

     	$order_y = $dby->select( "orders", "SUM(orders_y) as order_y","user_id={$row['user_id']} and plate_num={$row['plate_num']} and stattuima=0" );

     	$order_num = $dbnum->fetch_array( $num );

     	$amount = $dby->fetch_array( $order_y );

     	$h_tui=$dbnum->get_all('select h_tui,orders_y,orders_p,is_win from orders where user_id='.$row['user_id'].' and plate_num='.$row['plate_num'].' and stattuima=0');

     	$is_win=$dbnum->get_one('select SUM(shuying_y) as is_win from orders where is_win=1 and user_id='.$row['user_id'].' and plate_num='.$row['plate_num'].' and stattuima=0');
     	$tuishui=0;
     	$zj=0;
     	foreach ($h_tui as $key => $value) {
     		$tuishui =$value['h_tui']*$value['orders_y']+$tuishui;
     		if ($value['is_win']==1) {
     			$zj=$value['orders_y']*$value['orders_p']+$zj;
     		}
     	}

     ?>

     <?php if($row['history_is_account']=='0'){ $h_tui['h_tui']=0; $is_win['is_win']=0;}?>

     <?php $sum_mn=$amount['order_y']+$sum_mn;$sum_bs=$order_num['c']+$sum_bs;$sum_ht+=$h_tui['h_tui'];$sum_iw+=$is_win['is_win'];?>

	<tr onMouseOver="hover1(this);" onMouseOut="hover2(this);" align="center" class="smalltxt hover">

	<td class="altbg1 report_2"><?php echo date('Y-m-d H:i:s',$row['time']);?></td>

		<td class="altbg2 report_2" ><a href="orderadmin.php?plate_num=<?php echo $row['plate_num'];?>" style="color:#FF0000;"><b><?php echo $row['plate_num'];?></b></a></td>

		<td class="altbg1 report_2" ><?php echo $order_num['c'];?></td>

		<td class="altbg2 report_2"><?php echo $amount['order_y'];?></td>

		<td class="altbg1"><?php if($row['history_is_account']=='1'){echo $tuishui;}else{echo '--';}?></td>

		<td class="altbg2"><?php if($row['history_is_account']=='1'){echo $sy=$zj;}else{echo '--';$sy=0;}?></td>

		<td class="altbg1"><?php if($row['history_is_account']=='1'){$zsy=($tuishui+$sy)-$amount['order_y'];echo round($zsy);}else{echo '--';$zsy=0;}?></td>

	</tr>
	<?php 
		$zsy_num=$zsy+$zsy_num;
		$z_ts=$tuishui+$z_ts;
	?>
	<?php }?>

<tr class="soon_head" ><td class="altbg2 report_2" >合计</td>

<td class="altbg2 report_2" ></td>

<td class="altbg2 report_2" ><?php echo $sum_bs;?></td>

<td class="altbg2 report_2"><?php echo $sum_mn;?></td>

<td class="altbg1"><?php echo $z_ts;?></td>

<td class="altbg2"><?php echo $sum_iw;?></td>

<td class="altbg1"><?php echo round($zsy_num);?></td>

</tr>

	</table><BR>

	

	</td>

<tr>

</table>

</body>

</html>