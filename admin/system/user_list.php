<?php 
include_once( "../../global.php" );
$db = new mysql( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
$where_user='';
$uid=$_SESSION["uid".$c_p_seesion];
$new_plate=$db->get_one('select plate_num from plate order by id DESC');
$plate_num=$new_plate['plate_num'];

$total = $db->get_all('select * from users where user_power="6"');
$total=count($total);
pageft($total, 40); //15条为一页
if ($firstcount < 0){$firstcount = 0;}
$user_one=$db->get_all('select * from users where user_power="6" LIMIT '.$firstcount.','.$displaypg);
// var_dump($user_one);exit;
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
<script src="../js/jquery.min.js" type="text/javascript"></script>
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
	.tableborder td{text-align: center;}
	.header td{text-align:left;}
</style>
<script>
	function stop_user(id,stop){
		$.get("add_water.php",{user_id:id,act:'user_list',stop:stop},function(data){
			window.location.reload();
		});
	}
</script>
</head>
<body leftmargin="10" topmargin="10" >
	<div id="append_parent"></div>
	<table width="99%" align=center border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td>
				<table class="Noprint" width="100%"  border="0" cellpadding="0" cellspacing="0" >
	<tr>
		<td>
			<table width="100%" border="0" cellpadding="0" cellspacing="0" class="guide">
				<tr  style="border:none;">
					<td style="border:none;font-size:16px;font-family:Microsoft JhengHei;" width=15%>
						<a href="#" onClick="window.location.href='report.php?bet=1'">位置</a>&nbsp;&raquo;&nbsp;生效明细					</td>
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
							<tbody><tr class="header">
							<td colspan="3">生效明细</td>
							<td style="text-align:center;"><a href="opera_water.php" style="color:red;">操作退水</a></td>
							<td style="text-align:center;"><a href="#" style="color:red;">会员管理</a></td>
					    </tr>
						
						<tr class="reportTop">
							<td>顺序</td>
							<td>账号</td>
							<td>会员代号</td>
							<!-- <td>代理代号</td> -->
							<td>信用/可用</td>
							<td>操作</td>
							<!-- <td>操作</td> -->
						
						</tr>
						<?php $i=0; foreach ($user_one as $key => $value){?>
						<tr>
							<td><?php echo $i=$i+1;?></td>
							<td class="altbg1"><a href="../reports/awardreadadmin.php?issueno_start=&issueno_end=<?php echo time()+1;?>&company=1&user_id=<?php echo $value['user_id'];?>"><?php echo $value['user_name'];?>(会员)</a></td>
							<td><?php echo $value['user_nick'];?></td>
							<!-- <td><?php echo $value['top_nick'];?></td> -->
							<td><?php echo $value['credit_total'].'/'.$value['credit_remainder'];?></td>
							<?php if ($value['stop_water']=='0'){?>	
								<td><a style="color:red;" href="javascript:stop_user(<?php echo $value['user_id'];?>,'0');">暂停</a></td>
							<?php } else {?>
								<td><a style="color:red;" href="javascript:stop_user(<?php echo $value['user_id'];?>,'1');">已暂停</a></td>
							<?php }?>
							<!-- <td style="background:#cdc1db;text-align:center;"><a style="color:red;" href="javascript:;">修改</a></td> -->
						</tr>
						<?php }?>
						<tr class="td_caption_1"><td align=center colspan="7"><?php echo $pagenav;?></td></tr>
						</tbody></table>
				</div>
			</td>
		</tr>
	</table>
</body>
<script type="text/javascript">
	TotalBetSearch(1,true);
</script>
</html>