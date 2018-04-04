<?php
include_once ('../global.php');
$db = new action($mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset); //数据库操作类.
$uid = $_SESSION['uid'.$c_p_seesion];	
if($uid){
$info = mysql_fetch_array(mysql_query("select * from users  where user_id = '$uid'"));	 
}
$username = $_SESSION['username'.$c_p_seesion];

$oddsset_type=$db->get_all("select user_id from oddsset_type group by user_id");
foreach ($oddsset_type as $key => $value) {
	$oddsset[]=$value['user_id'];
}
$top_id=$info['top_id'];
// var_dump($top_id);exit;
// if (in_array($top_id,$oddsset)) {
// 	$top_oddsset=$db->get_all("select * from oddsset_type where user_id=0");/*.$top_id*/
// }else{
// }
switch ($info['user_power']) {
	case '2':
		$power='fg_tui';
		break;
	case '3':
		$power='gd_tui';
		break;
	case '4':
		$power='zd_tui';
		break;
	case '5':
		$power='d_tui';
		break;
	case '6':
		$power='tuishui';
	break;
}
// var_dump($power);exit;
$top_oddsset0=$db->get_all("select * from oddsset_type where o_typename='二字定' or o_typename='三字定' group by o_typename order by o_typename DESC");
$top_oddsset1 =$db->get_all("select * from tuishui_set left join oddsset_type on tuishui_set.odds_id=oddsset_type.o_id where tuishui_set.user_id=".$uid.' and oddsset_type.user_id=0 order by tuishui_set.odds_id ASC');
$top_oddsset=array_merge($top_oddsset0,$top_oddsset1);
// var_dump($top_oddsset);exit;
if ($_POST) {
	// var_dump($_POST);exit;
	$old_tuishui=$db->get_all("select user_id from tuishui_set group by user_id");
	foreach ($old_tuishui as $key => $value) {
		$tuishui[]=$value['user_id'];
	}
	if (in_array($uid,$tuishui)) {
		foreach ($_POST['fixstrhuishui'] as $key => $value) {
			$fields['tuishui']=$value;
			$fields['oddsset']=$_POST['frank'][$key];
			if ($key=='4') {
				$fields['oddsset']=$_POST['frank'][$key].'/'.($_POST['frank'][$key]+7);
			}
			if ($key=='5') {
				$fields['oddsset']=$_POST['frank'][$key].'/'.($_POST['frank'][$key]*2).'/'.($_POST['frank'][$key]*3);
			}
			if ($key=='6') {
				$fields['oddsset']=$_POST['frank'][$key].'/'.($_POST['frank'][$key]*2).'/'.($_POST['frank'][$key]*4).'/'.($_POST['frank'][$key]);
			}
			$fields['typename']=$_POST['typename'][$key];
			$fields['odds_id']=$key;
			$res=$db->get_update('tuishui_set',$fields,'odds_id='.$key.' and user_id='.$uid);
			// if ($res!=0) {
			// // var_dump($res);var_dump($fields);exit;
			// 	$fields['user_id']=$uid;
			// 	$db->get_insert('tuishui_set',$fields);
			// }
		}
		echo '<script>alert("修改成功");window.location.href="memberdata.php"</script>';
	}else{
		// var_dump($_POST['fixstrhuishui']);exit;
		// $db->delete('tuishui_set','user_id='.$uid);
		foreach ($_POST['fixstrhuishui'] as $key => $value) {
			$fields['user_id']=$uid;
			$fields['tuishui']=$value;
			$fields['oddsset']=$_POST['frank'][$key];
			$fields['typename']=$_POST['typename'][$key];
			$fields['odds_id']=$key;
			$db->get_insert('tuishui_set',$fields);
		}
		echo '<script>alert("添加成功");window.location.href="memberdata.php"</script>';
	}
}
//退水设置
$tuishui_list=$db->get_all("select * from tuishui_set right join oddsset_type on tuishui_set.odds_id=oddsset_type.o_id where tuishui_set.user_id=".$uid.' and oddsset_type.user_id=0');
	// var_dump($tuishui_list);exit;
if (empty($tuishui_list)) {
	foreach ($top_oddsset as $key => $value) {
		if ($value['o_topid']=='二字定') {
			$y=0;
			for ($i = $value['o_odd_limit']*10; $i >=680; $i--) {
				$data[$value['o_id']][$y]['huishui']=$y;
				$data[$value['o_id']][$y]['frank']=$i/10;
				$y=(string)($y+0.001);
			}
		}
		if ($value['o_topid']=='三字定') {
			$y=0;
			for ($i = $value['o_odd_limit']; $i >=680; $i--) {
				$data[$value['o_id']][$y]['huishui']=$y;
				$data[$value['o_id']][$y]['frank']=$i;
				$y=(string)($y+0.001);
			}
		}
		if ($value['o_typename']=='四字定') {
			$y=0;
			for ($i = $value['o_odd_limit']/10; $i >=680; $i--) {
				$data[$value['o_id']][$y]['huishui']=$y;
				$data[$value['o_id']][$y]['frank']=$i*10;
				$y=(string)($y+0.001);
			}
		}
	}
}else{
	foreach ($tuishui_list as $key => $value) {
		if ($value['typename']=='口X口X' || $value['typename']=='口XX口' || $value['typename']=='口口XX' || $value['typename']=='X口口X' || $value['typename']=='XX口口' || $value['typename']=='X口X口') {
			$y=0;
			$value['o_odds_limit']=($value['o_odd_limit']/1000-$value['d_tui']-$value['zd_tui']-$value['fg_tui']-$value['gd_tui'])*1000;
			for ($i = $value['o_odds_limit']*10; $i >=680; $i--) {
				$data[$value['odds_id']][$y]['huishui']=$y;
				$data[$value['odds_id']][$y]['frank']=$i/10;
				$y=(string)($y+0.001);
			}
		}
		if ($value['typename']=='口口口X' || $value['typename']=='口X口口' || $value['typename']=='X口口口' || $value['typename']=='口口X口') {
			$y=0;
			$value['o_odds_limit']=($value['o_odd_limit']/1000-$value['d_tui']-$value['zd_tui']-$value['fg_tui']-$value['gd_tui'])*1000;
			for ($i = $value['o_odds_limit']; $i >=680; $i--) {
				$data[$value['odds_id']][$y]['huishui']=$y;
				$data[$value['odds_id']][$y]['frank']=$i;
				$y=(string)($y+0.001);
			}
		}
		if ($value['typename']=='四字定') {
			$value['o_odds_limit']=($value['o_odd_limit']/1000-$value['d_tui']-$value['zd_tui']-$value['fg_tui']-$value['gd_tui'])*1000;
			$y=0;
			for ($i = $value['o_odds_limit']/10; $i >=680; $i--) {
				$data[$value['odds_id']][$y]['huishui']=$y;
				$data[$value['odds_id']][$y]['frank']=$i*10;
				$y=(string)($y+0.001);
			}
		}
		if ($value['typename']=='三字现') {
			$value['o_odds_limit']=($value['o_odd_limit']/1000-$value['d_tui']-$value['zd_tui']-$value['fg_tui']-$value['gd_tui'])*1000;
			$y=0;
			for ($i = substr($value['o_odd_limit'],-strlen($value['o_odd_limit']),strpos($value['o_odd_limit'],'/'))*10; $i >=420; $i--) {
			// var_dump($i);exit;
				$data[$value['odds_id']][$y]['huishui']=$y;
				$data[$value['odds_id']][$y]['frank']=$i/10;
				$y=(string)($y+0.001);
			}
		}
		if ($value['typename']=='二字现') {
			$value['o_odds_limit']=($value['o_odd_limit']/10-$value['d_tui']-$value['zd_tui']-$value['fg_tui']-$value['gd_tui'])*10;
			$y=0;
			for ($i = substr($value['o_odd_limit'],-strlen($value['o_odd_limit']),strpos($value['o_odd_limit'],'/'))*100; $i >=420; $i--) {
				$data[$value['odds_id']][$y]['huishui']=$y;
				$data[$value['odds_id']][$y]['frank']=$i;
				$y=(string)($y+0.001);
			}
		}
		if ($value['typename']=='四字现') {
			$value['o_odds_limit']=($value['o_odd_limit']/10-$value['d_tui']-$value['zd_tui']-$value['fg_tui']-$value['gd_tui'])*10;
			$y=0;
			for ($i = substr($value['o_odd_limit'],-strlen($value['o_odd_limit']),strpos($value['o_odd_limit'],'/')); $i >=300; $i--) {
				$data[$value['odds_id']][$y]['huishui']=$y;
				$data[$value['odds_id']][$y]['frank']=$i;
				$y=(string)($y+0.001);
			}
			// var_dump($data);exit;
		}
	}
}
	$tuishui=json_encode($data);
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


	<form method="post" action="memberdata.php">
	<input type="hidden" name="formhash" value="b718f6b0">

		<table width="100%" border="0" cellpadding="0" cellspacing="0" >
		<tr ><td width=50%  valign=top>
			<table width="98%" border="0" cellpadding="0" cellspacing="0" class="members_b">
			<tr class="header_left_b"><td colspan="4">会员资料</td></tr>

			<tr>
			<td class="altbg1" style="height:25px;">账　　号:</td>
			<td align="right" class="altbg2"><?php echo $username;?></td>
			</tr>
			<tr>
			<td class="altbg1" style="height:25px;">姓　　名:</td>
			<td align="right" class="altbg2"><?php echo $info['user_nick'];?></td>
			</tr>
			<tr>
			<td class="altbg1" style="height:25px;">信用额度:</td>
			<td align="right" class="altbg2"><?php echo $info['credit_total'];?></td>
			</tr>
			</table>
		</td>
		<td width=50% valign=top>
			<table width="100%" border="0" cellpadding="0" cellspacing="0" class="members_b">
			<tr class="header_left_b"><td colspan="6">录码模式</td></tr>

			<tr>
			<td class="altbg1" style="height:25px;">自动:</td>
			<td align="right" class="altbg2"><INPUT TYPE="radio" NAME="entermode" value="0" checked></td>
			<td class="altbg1">小票打印:</td>
			<td align="right" class="altbg2"><INPUT TYPE="radio" NAME="sendmode" value="1" checked></td>
						<td class="altbg1">实际赔率:</td>
			<td align="right" class="altbg2"><INPUT TYPE="radio" NAME="isfpfrankhotzhuan" value="1" ></td>
						
			</tr> 
			<tr>
			<td class="altbg1" style="height:25px;">回车:</td>
			<td align="right" class="altbg2"><INPUT TYPE="radio" NAME="entermode" value="1" ></td>
			<td class="altbg1">显示彩种:</td>
			<td align="right" class="altbg2"><INPUT TYPE="radio" NAME="sendmode" value="0" ></td>

						<td class="altbg1">转换赔率:</td>
			<td align="right" class="altbg2"><INPUT TYPE="radio" NAME="isfpfrankhotzhuan" value="0" checked></td>
						</tr>
			<tr>
			<td class="altbg1" style="height:25px;">&nbsp;</td>
			<td align="right" class="altbg2">&nbsp;</td>
			<td class="altbg1">&nbsp;</td>
			<td align="right" class="altbg2">&nbsp;</td>
						<td class="altbg1">&nbsp;</td>
			<td align="right" class="altbg2">&nbsp;</td>
						</tr>
			</table>
		</td></tr>
		</table><br />


	<table width="100%" border="0" cellpadding="0" cellspacing="0" class="printfont">
			<tr>
				<td width="47%">
					&nbsp;1、小票打印请使用系统自带浏览器&nbsp;&nbsp;<img src="picture/ie7.png" width="35">
				</td>
				<td width="53%" rowspan="2">
					&nbsp;<input class="btn_tuima" type="submit" name="editsubmit" value="提交">
				</td>
			</tr>
			<tr>
				<td>
					&nbsp;2、提示:+号代表x号
				</td>
			</tr>
			<tr>
				<td colspan="2">
					&nbsp;3、小票打印处，增加了分页，每页显示500笔。
				</td>
			</tr>
			<tr>
				<td colspan="2">
					&nbsp;4、下注明细里，颜色（<font color='#ff0000' size='4'>●</font>）或（<font color='#339900' size='4'>●</font>）连在一起的，代表是在同一张小票上。
				</td>
			</tr>
			<tr>
				<td colspan="2">
					&nbsp;5、小票打印处内容超过500笔，再次下单后，系统会自动清空之前小票打印内容，请注意使用。
				</td>
			</tr>
	</table>

		<br />
		<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tableborder">
        <tr align="center" class="header_left_b"><td colspan="8">会员资料</td></tr>
		<tr align="center" class="altbg1">
		<td width="*">类别</td>
		<td width="12%">最小下注</td>
		<td width="20%">赔率上限(多个用/分开)</td>
		<td width="12%">单注上限</td>
		<td width="12%">单项上限</td>
		<td width="14%">交易回水</td>
		<td width="14%"> 赔率</td>
		</tr>
		<?php foreach ($top_oddsset as $key => $value){?>
		<?php if ($value['o_topid']=="0"){?>
		<?php $sizi_tuishui=$db->get_one("select * from tuishui_set where user_id=".$uid.' and typename="'.$value['o_typename'].'"');?>
		<?php //if($sizi_tuishui['o_odds_limit']){$value['o_odd_limit']=$sizi_tuishui['o_odds_limit'];}?>
		<?php if ($value['o_typename']=='四字定'){?>
			<?php 
				$value['o_odd_limit']=$value['o_odd_limit']-$value['fg_tui']*10000-$value['gd_tui']*10000-$value['zd_tui']*10000-$value['d_tui']*10000;

			?>
		<?php }?>
		 <tr >
<!--			<td class="altbg2"><div style=" margin-right:4px; padding-bottom:9px"><img id="menuimg_showfix_--><?php //echo $value['o_id'];?><!--" src="picture/menu_add.gif" border="0"/></td>-->
			<td  <?php if($value['o_typename'] == "二字定" || $value['o_typename'] == "三字定"){ echo 'class="altbg1"';}else{echo 'class="altbg2"';} ;?>  ><a style="color: red !important; " href="javascript:collapse_change('showfix_<?php echo $value['o_id'];?>');"><?php echo $value['o_typename'];?></a></td>
			<td <?php if($value['o_typename'] == "二字定" || $value['o_typename'] == "三字定"){ echo 'class="altbg1"';}else{echo 'class="altbg2"';} ;?>><span  style='<?php if($value['o_typename']=='二字定' || $value['o_typename']=='三字定'){echo 'display:none';}?>' >1</td>
			<td <?php if($value['o_typename'] == "二字定" || $value['o_typename'] == "三字定"){ echo 'class="altbg1"';}else{echo 'class="altbg2"';} ;?>><span  style='<?php if($value['o_typename']=='二字定' || $value['o_typename']=='三字定'){echo 'display:none';}?>' ><?php echo $value['o_odd_limit'];?></td>
			<td <?php if($value['o_typename'] == "二字定" || $value['o_typename'] == "三字定"){ echo 'class="altbg1"';}else{echo 'class="altbg2"';} ;?>><span  style='<?php if($value['o_typename']=='二字定' || $value['o_typename']=='三字定'){echo 'display:none';}?>' ><?php echo $value['o_dzlimit'];?></td>
			<td <?php if($value['o_typename'] == "二字定" || $value['o_typename'] == "三字定"){ echo 'class="altbg1"';}else{echo 'class="altbg2"';} ;?>><span  style='<?php if($value['o_typename']=='二字定' || $value['o_typename']=='三字定'){echo 'display:none';}?>' ><?php echo $value['o_dxlimit'];?></td>
			<td <?php if($value['o_typename'] == "二字定" || $value['o_typename'] == "三字定"){ echo 'class="altbg1"';}else{echo 'class="altbg2"';} ;?>><span  style='<?php if($value['o_typename']=='二字定' || $value['o_typename']=='三字定'){echo 'display:none';}?>' >
			<select class="select_data" id="fixstrhuishui_<?php echo $value['o_id'];?>" name="fixstrhuishui[<?php echo $value['o_id'];?>]" onchange="showfrank('<?php echo $value['o_id'];?>',this.value,0,0)" >
			<?php if($value['o_typename']=='四字定'){?>
			<?php $y=0; for ($i = $value['o_odd_limit']/10; $i >=680; $i--) {?>
				<option <?php if($sizi_tuishui['tuishui']==$y){echo 'selected="selected"';}?> value="<?php echo $y;?>" ><?php echo $y;?></option>
			<?php $y=(string)($y+0.001); }?>
			<?php }?>
			<?php if($value['o_typename']=='二字现'){?>
			<?php $y=0; for ($i = 980; $i >=680; $i--) {?>
				<option <?php if($sizi_tuishui['tuishui']==$y){echo 'selected="selected"';}?> value="<?php echo $y;?>" ><?php echo $y;?></option>
			<?php $y=(string)($y+0.001); }?>
			<?php }?>
			<?php if($value['o_typename']=='三字现'){?>
			<?php $y=0; for ($i = $value['o_odd_limit']*10; $i >=420; $i--) {?>
				<option <?php if($sizi_tuishui['tuishui']==$y){echo 'selected="selected"';}?> value="<?php echo $y;?>" ><?php echo $y;?></option>
			<?php $y=(string)($y+0.001); }?>
			<?php }?>
			<?php if($value['o_typename']=='四字现'){?>
			<?php $y=0; for ($i = $value['o_odd_limit']*10; $i >=3000; $i--) {?>
				<option <?php if($sizi_tuishui['tuishui']==$y){echo 'selected="selected"';}?> value="<?php echo $y;?>" ><?php echo $y;?></option>
			<?php $y=(string)($y+0.001); }?>
			<?php }?>
			</select></td>

			<td <?php if($value['o_typename'] == "二字定" || $value['o_typename'] == "三字定"){ echo 'class="altbg1"';}else{echo 'class="altbg2"';} ;?>>
			<select class="select_data" style='<?php if($value['o_typename']=='二字定' || $value['o_typename']=='三字定'){echo 'display:none';}?>'  id="fixstrfrank_<?php echo $value['o_id'];?>" name="fixstrfrank[<?php echo $value['o_id'];?>]" onchange="showfrank('<?php echo $value['o_id'];?>',this.value,0,0)" >
			<?php if($value['o_typename']=='四字定'){?>
			<?php $y=0; for ($i = $value['o_odd_limit']/10; $i >=680; $i--) {?>
				<option <?php if($sizi_tuishui['tuishui']==$y){echo 'selected="selected"';}?> value="<?php echo $y;?>" ><?php echo $i*10;?></option>
			<?php $y=(string)($y+0.001); }?>
			<?php }?>
			<?php if($value['o_typename']=='二字现'){?>
			<?php $y=0; for ($i = 980; $i >=680; $i--) {?>
				<option <?php if($sizi_tuishui['tuishui']==$y){echo 'selected="selected"';}?> value="<?php echo $y;?>" ><?php echo $i/100;?></option>
			<?php $y=(string)($y+0.001); }?>
			<?php }?>
			<?php if($value['o_typename']=='三字现'){?>
			<?php $y=0; for ($i = $value['o_odd_limit']*10; $i >=420; $i--) {?>
				<option <?php if($sizi_tuishui['tuishui']==$y){echo 'selected="selected"';}?> value="<?php echo $y;?>" ><?php echo $i/10;?></option>
			<?php $y=(string)($y+0.001); }?>
			<?php }?>
			<?php if($value['o_typename']=='四字现'){?>
			<?php $y=0; for ($i = $value['o_odd_limit']*10; $i >=3000; $i--) {?>
				<option <?php if($sizi_tuishui['tuishui']==$y){echo 'selected="selected"';}?> value="<?php echo $y;?>" ><?php echo $i/10;?></option>
			<?php $y=(string)($y+0.001); }?>
			<?php }?>
			</select>
			<input type="hidden" id="frank_<?php echo $value['o_id'];?>" name="frank[<?php echo $value['o_id'];?>]" value="<?php echo $sizi_tuishui['oddsset']?$sizi_tuishui['oddsset']:$value['o_odd_limit'];?>">
			<input type="hidden" name="typename[<?php echo $value['o_id'];?>]" value="<?php echo $value['o_typename'];?>">
			<!--<span  style='display:none' ><span id="showfrank_1"></span>-->
			</td>
			</tr>
			<?php if ($value['o_typename']=='二字定' || $value['o_typename']=='三字定'){?>
			<tr id="menu_showfix_<?php echo $value['o_id'];?>" >
<!--                    <td class="altbg2" colspan=8>-->
<!--                    <table width="100%" border="0" cellpadding="0" cellspacing="0" class="tableborder">-->
		<?php foreach ($top_oddsset as $k => $v){?>
		<?php if($v['o_topid']==$value['o_typename']){?>
			<?php 
				$f_id[$value['o_id']][$k]=$v['o_id'];
			?>
			<?php $y_tuishui=$db->get_one("select * from tuishui_set where user_id=".$uid.' and typename="'.$v['o_typename'].'"');?>
			<?php 
			// var_dump($v['d_tui']);
				if ($value['o_typename']=='二字定') {
						$v['o_odd_limit']=$v['o_odd_limit']-$v['fg_tui']*100-$v['gd_tui']*100-$v['zd_tui']*100-$v['d_tui']*100;
				}
				if ($value['o_typename']=='三字定') {
						$v['o_odd_limit']=$v['o_odd_limit']-$v['fg_tui']*1000-$v['gd_tui']*1000-$v['zd_tui']*1000-$v['d_tui']*1000;
				}
			?>
			<?php //if($y_tuishui['o_odds_limit']){$v['o_odd_limit']=$y_tuishui['o_odds_limit'];}?>
			<tr  onMouseOver="this.className='hover1'" onMouseOut="this.className='hover2'">
<!--			<td class="altbg2" width="13"></td>-->
			<td class="altbg2"  width="*"><?php echo $v['o_typename'];?></td>
			<td class="altbg2" width="12%">1</td>
			<td class="altbg2" width="20%"><?php echo $v['o_odd_limit'];?></td>
			<td class="altbg2" width="12%"><?php echo $v['o_dzlimit'];?></td>
			<td class="altbg2" width="12%"><?php echo $v['o_dxlimit'];?></td>
			<td class="altbg2" width="14%"><select class="select_data" id="fixstrhuishui_<?php echo $v['o_id'];?>" name="fixstrhuishui[<?php echo $v['o_id'];?>]" onchange="showfrank('<?php echo $v['o_id'];?>',this.value,'<?php echo $value['o_id'];?>',0)">


			<?php if($v['o_topid']=='二字定'){?>
			<?php $y=0; for ($i = $v['o_odd_limit']*10; $i >=680; $i--) {?>
				<option <?php if($v['tuishui']==$y){echo 'selected="selected"';}?> value="<?php echo $y;?>" ><?php echo $y;?></option>
			<?php $y=(string)($y+0.001); }?>
			<?php }?>
			<?php if($v['o_topid']=='三字定'){?>
			<?php $y=0; for ($i = $v['o_odd_limit']; $i >=680; $i--) {?>
				<option <?php if($v['tuishui']==$y){echo 'selected="selected"';}?> value="<?php echo $y;?>" ><?php echo $y;?></option>
			<?php $y=(string)($y+0.001); }?>
			<?php }?>
			</td>	

			<td class="altbg2" width="14%">
			<select class="select_data" id="fixstrfrank_<?php echo $v['o_id'];?>" name="fixstrfrank[<?php echo $v['o_id'];?>]" onchange="showfrank('<?php echo $v['o_id'];?>',this.value,'<?php echo $value['o_id'];?>',1)" >
			<?php if($v['o_topid']=='二字定'){?>
			<?php $y=0; for ($i = $v['o_odd_limit']*10; $i >=680; $i--) {?>
				<option <?php if($y_tuishui['tuishui']==$y){echo 'selected="selected"';}?> value="<?php echo $y;?>" ><?php echo $i/10;?></option>
			<?php $y=(string)($y+0.001); }?>
			<?php }?>
			<?php if($v['o_topid']=='三字定'){?>
			<?php $y=0; for ($i = $v['o_odd_limit']; $i >=680; $i--) {?>
				<option <?php if($y_tuishui['tuishui']==$y){echo 'selected="selected"';}?> value="<?php echo $y;?>" ><?php echo $i;?></option>
			<?php $y=(string)($y+0.001); }?>
			<?php }?>
			</select>
			<input type="hidden" id="frank_<?php echo $v['o_id'];?>" name="frank[<?php echo $v['o_id'];?>]" value="<?php echo $v['o_odd_limit'];?>">
			<input type="hidden" name="typename[<?php echo $v['o_id'];?>]" value="<?php echo $v['o_typename'];?>">
			<!--<span id="showfrank_102">98.5</span>-->
			</td> 
			</tr>
			<?php }?>
			<?php }?>
<!--			</td>-->
                    </tr>

<!--			</table>-->

				</td></tr>
				<?php }?>
		<?php }?>
		<?php }?>
			</table>

			<BR> <br /></form>
		
		<SCRIPT LANGUAGE="JavaScript">
		<!--
		var collapsed = getcookie('cg_szyx_cookie_collapse');
		function collapse_change(menucount) {

			if($('menu_' + menucount).style.display == 'none') {
				$('menu_' + menucount).style.display = '';collapsed = collapsed.replace('[' + menucount + ']' , '');
				$('menuimg_' + menucount).src = './picture/menu_reduce.gif';
				
			} else {

				$('menu_' + menucount).style.display = 'none';collapsed += '[' + menucount + ']';
				$('menuimg_' + menucount).src = './picture/menu_add.gif';
			}
			setcookie('cg_szyx_cookie_collapse', collapsed, 2592000);
		}
			
			var huishui = <?php echo $tuishui;?>;
			var allclassid = <?php echo json_encode($f_id);?>;
			function showfrank(fixclassid,keyid,s,frankstat){
				if(huishui[fixclassid]!=null){
					if(s>0){
						var fcid = fixclassid;
						var getfrank = '';
						for(i in allclassid[s]){
							fixclassid = allclassid[s][i];
							var frankhs = huishui[fixclassid][keyid]['huishui'];
							if(frankstat==1){
								if(getfrank=='')getfrank = huishui[fcid][keyid]['frank'];
								var arr = huishui[fixclassid];
								for(kk in arr){
									if(arr[kk]['frank'] == getfrank){
										frankhs = arr[kk]['huishui'];
										//$("ttt").innerHTML+="="+frankhs + "="+arr[kk]['frank'];
										break;
									}
								}
								
							}
							$('fixstrhuishui_'+fixclassid).value = frankhs;
							$('fixstrfrank_'+fixclassid).value = frankhs;
							$('frank_'+fixclassid).value = huishui[fixclassid][keyid]['frank'];
						}
					}else{
				// alert(huishui[fixclassid]);
						$('fixstrhuishui_'+fixclassid).value = huishui[fixclassid][keyid]['huishui'];
						$('fixstrfrank_'+fixclassid).value = huishui[fixclassid][keyid]['huishui'];
						$('frank_'+fixclassid).value = huishui[fixclassid][keyid]['frank'];
					}
				}
			}
		//-->
		</SCRIPT>
	</td>
<tr>
</table>
</body>
</html>