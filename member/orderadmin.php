<?php 
include_once( "../global.php" );
$where_user='';
$plate_num=isset($_GET['plate_num'])?$_GET['plate_num']:'';
$user_id=$_SESSION["uid".$c_p_seesion];
$db = new mysql( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
if ($plate_num=='') {	
	$new_plate=$db->get_one('select plate_num from plate order by id DESC');
	$plate_num=$new_plate['plate_num'];
}
if ($_GET['o_type3']) {
	$where_user.=' and orders.o_type3 like "%'.$_GET["o_type3"].'%"';
}
if ($_GET['is_win']) {
	$where_user.=' and orders.is_win=1';
}
if ($_GET['stattuima']) {
	$where_user.=' and orders.stattuima=1';
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
$query=  $db->select("orders", "count(*) as c", "user_id = {$user_id} and plate_num ='{$plate_num}' {$where_user}");
$total = $db->fetch_array($query);
$total=$total['c'];
pageft($total, 40); //15条为一页
if ($firstcount < 0){$firstcount = 0;}
$user_one=$db->get_all('select * from orders where user_id='.$user_id.$where_user.' and plate_num='.$plate_num.' order by time DESC limit '.$firstcount.','.$displaypg);
// var_dump($displaypg);exit;
$power=$db->get_one('select user_power,user_name from users where user_id='.$user_id);
switch ($power['user_power']) {
	case '2':
		$my_power='分公司';
		break;
	case '3':
		$my_power='股东';
		break;
	case '4':
		$my_power='总代理';
		break;
	case '5':
		$my_power='代理';
		break;
	case '6':
		$my_power='会员';
		break;
}
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
	 


					<script src="js/common.js" type="text/javascript"></script>
			<script src="js/frank.js" type="text/javascript"></script>
			<SCRIPT LANGUAGE="JavaScript">
			<!--
				function orderprint(){
					var s_number = formprint.s_number.value;
					var s_money = formprint.s_money.value;
					var s_money_end = formprint.s_money_end.value;
					var s_issueno = formprint.s_issueno.value;
					var getclassid = formprint.s_classid.value;
					
					window.open('index.php?action=orderadmin&doaction=memberorderprint&s_issueno='+s_issueno+'&s_number='+s_number+'&s_money='+s_money+'&s_money_end='+s_money_end+'&s_classid='+getclassid+'&page=1&docom=&sid=jcJOcX');
					return false;
				}
				
			//-->
			</SCRIPT>
			<form name="formprint" method="get" action="orderadmin.php">
			<input type="hidden" name="formhash" value="b718f6b0">	
			<input type="hidden" name="docom" value="">	
			<input type="hidden" name="s_datetime" value="">	
			<input type="hidden" name="plate_num" value="<?php echo $plate_num;?>">	
		  <table width="100%" border="0" cellpadding="0" cellspacing="0" class="left_b">
			<tr class="header_left_b"><td colspan="16">搜索</td></tr>
			<tr>
			<td width=40>查号码 </td>
			<td width=60><INPUT TYPE="text" NAME="o_type3" id="s_number" onblur="sNumber(this.value);" onkeydown="sNumber13(this.value);" onkeypress="return KeyPressNumber(e);"  maxlength=4 value="<?php if($_GET['o_type3']){echo $_GET['o_type3'];}?>" style="width:60px"></td>
			<td width=10>现</td>
			<td width=20><INPUT TYPE="checkbox" ID="sizixian" NAME="sizixian" ></td>	
			<td width=10></td>		
			<td width=30>列出</td> 
			<td width=50><select name="soclass" ><option value="0" selected>赔率</option><option value="1" >金额</option><option value="2" >退码</option></select></td>
			<td width=50><INPUT TYPE="text" id="s_money" NAME="s_money" value="" style="width:50px"></td>
			<td width=10>至</td>
			<td width=50><INPUT TYPE="text" id="s_money_end" NAME="s_money_end" value="" style="width:50px"></td>
			<td width=10></td>
			<td width=30>分类</td>
			<td width=130>
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
				</select></td> 
			<td width=50><input class="button" type="submit" name="addsubmit" value="提交"></td>
			<td width=50><input class="button" type="button" name="printsubmit" onclick="orderprint();return false;" value="打印"></td>
			<td width=*>
			<?php if ($_GET['is_win']){?>
				<input class="button" type="button" name="awardsubmit" onclick="location.href='orderadmin.php?plate_num=<?php echo $plate_num;?>';return false;" value="下注明细">
			<?php }else{?>
				<input class="button" type="button" name="awardsubmit" onclick="location.href='orderadmin.php?plate_num=<?php echo $plate_num;?>&is_win=1';return false;" value="中奖明细">
			<?php }?>
				<?php if ($_GET['stattuima']){?>
				<input style="float:right;" class="button" type="button" name="awardsubmit" onclick="location.href='orderadmin.php?plate_num=<?php echo $plate_num;?>';return false;" value="返回列表">
				<?php }else{?>
					<input style="float:right;" class="button" type="button" name="awardsubmit" onclick="location.href='orderadmin.php?plate_num=<?php echo $plate_num;?>&stattuima=1';return false;" value="退码明细">
				<?php }?>
			</td>
			</tr>
			</table><BR>
			</form>

			<form method="post" name=datamembers action="tuima.php" onsubmit="return false;">
			<input type="hidden" name="formhash" value="b718f6b0">
			<input type="hidden" id="PostOnlyRand" name="PostOnlyRand" value="3454e85f277b844522adab90bc681d29" />

			
			<table width="100%" border="0" cellpadding="0" cellspacing="0" class="soon_b" >
			<tr class="header_left_b"><td colspan="14">第<?php echo $plate_num;?>期 <?php if ($_GET['is_win']){echo '中奖明细';}else{echo '下注明细';}?></td></tr>
			<tr class="soon_head" > 
			<td width="7%" >彩种</td>
			<td width="11%"  >注单编号</td>
			<td width="18%"  >下单时间</td>
			<td width="8%" >号码</td>
			<td width="8%" >金额</td>
			<td width="6%" >赔率</td>
			<td width="11%" >中奖</td>
			<td width="8%" >回水</td>
			<td width="*" >盈亏</td>
			<td width="7%" >状态</td>
			 
			<td width="7%" >全选<input type="checkbox" name="chkall" onclick="checkall(this.form, 'idarray')" class="checkbox">
			<input class="btn_tuima" style="padding: 0 1px;line-height: 22px;;height: 22px;height: 22px !important;" type="button" name="ordertuima_del_button" onclick="javascript:tuimaexec(); " value="退码">
			</td> 
						</tr>
			<?php if (!empty($user_one) || isset($user_one)){?>
			<?php $sum_mn='';$sum_ts=''; foreach ($user_one as $key => $value){?>
			<?php /*$sum_yk=($value['h_tui']-$value['orders_y'])+$sum_yk;*/?>
			<tr class="hover" onmouseover="hover1(this);" onmouseout="hover2(this);" style="height:28px;line-height:29px;">
				<td class="<?php if($value['stattuima']==1){echo 'soon_tuima';}else{echo 'soon_success';}?>" width="7%" >七星彩</td>
				<td class="<?php if($value['stattuima']==1){echo 'soon_tuima';}else{echo 'soon_success';}?>" width="11%"  ><?php echo $value['order_no'];?></td>
				<td class="<?php if($value['stattuima']==1){echo 'soon_tuima';}else{echo 'soon_success';}?>" width="18%"  ><?php echo date('Y-m-d H:i:s',$value['time']);?><?php if($value['stattuima']==1){echo '<br/>退'.date('Y-m-d H:i:s',$value['tuima_time']);}?></td>
				<td class="soon_b_B soon_b_f2 <?php if($value['stattuima']==1){echo 'soon_tuima';}else{echo 'soon_success';}?>" width="8%" ><b><?php echo $value['o_type3'];?></b></td>
				<td class="soon_b_B soon_b_f1 <?php if($value['stattuima']==1){echo 'soon_tuima';}else{echo 'soon_success';}?>" width="8%" ><b><?php echo $value['orders_y'];?></b></td>
				<td class="soon_b_B <?php if($value['stattuima']==1){echo 'soon_tuima';}else{echo 'soon_success';}?>" width="6%" ><?php echo $value['orders_p'];?></td>
				<td class="<?php if($value['stattuima']==1){echo 'soon_tuima';}else{echo 'soon_success';}?>" width="11%" ><?php if($value['history_is_account']==1){if($value['is_win']==1){echo $z=$value['orders_y']*$value['orders_p'];}else{echo '--';$z=0;}}else{echo '--';}?></td>
				<td class="<?php if($value['stattuima']==1){echo 'soon_tuima';}else{echo 'soon_success';}?>" width="8%" ><?php echo $hs=$value['h_tui']*$value['orders_y'];?></td>  <!-- 回水 -->
				<td class="<?php if($value['stattuima']==1){echo 'soon_tuima';}else{echo 'soon_success';}?>" width="*" ><?php echo $yk=($z+$value['h_tui']*$value['orders_y'])-$value['orders_y'];?></td>
				<td class="<?php if($value['stattuima']==1){echo 'soon_tuima';}else{echo 'soon_success';}?>" width="7%" ><?php if($value['stattuima']==1){echo '已退码';}else{echo '成功';}?></td>
				<td class="<?php if($value['stattuima']==1){echo 'soon_tuima';}else{echo 'soon_success';}?>" width="7%" >
					<?php if (time()<($value['time']+600) && $value['stattuima']==0){?>
					<input type="checkbox" name="idarray[]" class="checkbox" value="<?php echo $value['id'];?>">
					<?php }else {?>
					<?php echo '--';?>
					<?php }?>
				</td> 
			</tr>
			<?php 
				if($value['stattuima']==0){
					$sum_yk=$yk+$sum_yk;
					$zj=$z+$zj;
					$z_hs=$hs+$z_hs;
					$sum_mn=$value['orders_y']+$sum_mn;
					$sum_ts=$value['h_tui']+$sum_ts;
				}
			?>
			<?php }?>
			<?php }?>
<?php $danss = mysql_query("select * from orders  where user_id = '{$uid}' and plate_num ='{$plate_num}'"); 
while ($zhuss = mysql_fetch_array($danss)) {
             $total_yss+=$zhuss['orders_y'];
             $total_hss+=$zhuss['tuishui_y'];
             $total_kss+=$zhuss['keying_y']; 
      }
?>
			<tr  class="reportFooter">
		<td colspan="2" style="text-align:center">合计</td><td><?php echo $key+1?></td><td></td><td><?php echo $sum_mn;?></td><td></td><td><?php echo $zj;?></td>
		<td><?php echo $z_hs;?></td>
		<td ><?php echo $sum_yk;?></td><td></td><td></td></tr>
		<tr class="td_caption_1"><td align=center colspan="11"><?php echo $pagenav;?></td></tr>
			</table>
<!--分页-->
        <div id="DetailListPager" class="pagination"><li class="allnumpage active" jp-role="allnumpage" jp-data="1">总 <?php echo $GLOBALS['page_totle'];?> 条</li><li class="page active" jp-role="page" jp-data="1"><a href="javascript:;">1</a></li><input class="pageinput" type="text" name="pageinput" value=" " jp-role="pageinput" jp-data="1"></div>

						<br><center><input type="hidden" name="ordertuima_del" >
<!--<input class="button" type="button" name="ordertuima_del_button" onclick="javascript:tuimaexec(); " value="退码">-->
</center>
           			
			<BR>
			
			</form>
			<BR>			
		<SCRIPT LANGUAGE="JavaScript">
		<!--
			tuimastat=true;
			function tuimaexec(){
				if(window.confirm('你确定要退掉选中的号码吗？')){ 
					if(tuimastat==true){
						tuimastat=false;
						datamembers.ordertuima_del_button.disabled=true;
						datamembers.ordertuima_del.value='ordertuima_del';
						datamembers.submit();
					}
				}else return;
			}
		-->
		</SCRIPT>	
			</td>
<tr>
</table>

<!-- 
	<table width="98%" align="center" border="0" cellpadding="0" cellspacing="0" >
	<tr >
	<td align="center" style="text-align:center">
版权所有 Copyright@2009-2010 usetime:0.013185 
mysqlquery:4 
</td>
<tr>
</table> -->
</body>
</html>