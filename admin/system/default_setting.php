<?php 
include_once( "../../global.php" );
$db = new mysql( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
$uid=$_SESSION["uid".$c_p_seesion];
$user_one=$db->get_one('select * from users where user_id='.$uid);
$my_user=$db->get_one('select * from users where user_id='.$uid);
// var_dump($my_user);exit;
switch ($my_user['user_power']) {
	case '1':
		$my_power='公司';
		break;
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
}

//查找上级信息
$uid = $_SESSION['uid'.$c_p_seesion];	
if($uid){
$info = mysql_fetch_array(mysql_query("select * from users  where user_id = '$uid'"));	 
}
$username = $_SESSION['username'.$c_p_seesion];

// $oddsset_type=$db->get_all("select user_id from oddsset_type group by user_id");
// $top_oddsset0=$db->get_all("select * from oddsset_type where user_id=0 and o_typename='二字定' or user_id=0 and o_typename='三字定' group by o_typename order by o_id DESC");
// $top_oddsset1 =$db->get_all("select * from tuishui_set left join oddsset_type on tuishui_set.odds_id=oddsset_type.o_id where tuishui_set.user_id=0 and oddsset_type.user_id=0");
// $oddsset_type=array_merge($top_oddsset0,$top_oddsset1);
// foreach ($oddsset_type as $key => $value) {
// 	$oddsset[]=$value['user_id'];
// }
// $top_id=$info['o_id'];
// var_dump($top_id);exit;
// if (in_array($top_id,$oddsset)) {
// 	$top_oddsset=$db->get_all("select * from oddsset_type where user_id=".$top_id);
// }else{
	// $top_oddsset=$db->get_all("select * from oddsset_type where user_id=0 order by o_typename ASC");
// }
$top_oddsset0=$db->get_all("select * from oddsset_type where user_id=0 and o_typename='二字定' or user_id=0 and o_typename='三字定' group by o_typename order by o_id ASC");
$top_oddsset1 =$db->get_all("select * from tuishui_set left join oddsset_type on tuishui_set.odds_id=oddsset_type.o_id where tuishui_set.user_id=0 and oddsset_type.user_id=0");
$top_oddsset=array_merge($top_oddsset0,$top_oddsset1);
// var_dump($top_oddsset);exit;
// var_dump("select * from tuishui_set left join oddsset_type on tuishui_set.odds_id=oddsset_type.o_id where tuishui_set.user_id=0 and oddsset_type.user_id=0");exit;
//退水设置
foreach ($top_oddsset as $key => $value) {
	if ($value['o_topid']=='二字定') {
		$y=0;
		for ($i = $value['o_odd_limit']*10; $i >=890; $i--) {
			$data[$value['o_id']][$y]['huishui']=$y;
			$data[$value['o_id']][$y]['frank']=$i/10;
			$y=(string)($y+0.001);
		}
	}
	if ($value['o_topid']=='三字定') {
		$y=0;
		for ($i = $value['o_odd_limit']; $i >=890; $i--) {
			$data[$value['o_id']][$y]['huishui']=$y;
			$data[$value['o_id']][$y]['frank']=$i;
			$y=(string)($y+0.001);
		}
	}
	if ($value['o_typename']=='四字定') {
		$y=0;
		for ($i = $value['o_odd_limit']/10; $i >=850; $i--) {
			$data[$value['o_id']][$y]['huishui']=$y;
			$data[$value['o_id']][$y]['frank']=$i*10;
			$y=(string)($y+0.001);
		}
	}
	if ($value['o_typename']=='三字现') {
			$value['o_odds_limit']=($value['o_odd_limit']/1000-$value['d_tui']-$value['zd_tui']-$value['fg_tui']-$value['gd_tui'])*1000;
			$y=0;
			for ($i = substr($value['o_odd_limit'],-strlen($value['o_odd_limit']),strpos($value['o_odd_limit'],'/'))*10; $i >=420; $i--) {
			// var_dump($i);exit;
				$data[$value['odds_id']][$y]['huishui']=$y;
				$data[$value['odds_id']][$y]['frank']=$i/10;
				$y=(string)($y+0.001);
			}
		}
		if ($value['o_typename']=='二字现') {
			$value['o_odds_limit']=($value['o_odd_limit']/10-$value['d_tui']-$value['zd_tui']-$value['fg_tui']-$value['gd_tui'])*10;
			$y=0;
			for ($i = substr($value['o_odd_limit'],-strlen($value['o_odd_limit']),strpos($value['o_odd_limit'],'/'))*100; $i >=420; $i--) {
				$data[$value['odds_id']][$y]['huishui']=$y;
				$data[$value['odds_id']][$y]['frank']=$i*100;
				$y=(string)($y+0.001);
			}
		}
		if ($value['o_typename']=='四字现') {
			$value['o_odds_limit']=($value['o_odd_limit']/100-$value['d_tui']-$value['zd_tui']-$value['fg_tui']-$value['gd_tui'])*100;
			$y=0;
			for ($i = substr($value['o_odd_limit'],-strlen($value['o_odd_limit']),strpos($value['o_odd_limit'],'/')); $i >=300; $i--) {
				$data[$value['odds_id']][$y]['huishui']=$y;
				$data[$value['odds_id']][$y]['frank']=$i;
				$y=(string)($y+0.001);
			}
		}
}
	$tuishui=json_encode($data);

// 保存数据
if ($_POST) {
	// 退水
	$old_tuishui=$db->get_one("select user_id from tuishui_set where user_id=0");
	if ($old_tuishui['user_id']=="0") {
		// var_dump($_POST);exit;
		foreach ($_POST['o_list_order'] as $key => $value) {
			$fields['o_list_order']=$value;
			$fields['o_dzlimit']=$_POST['o_dzlimit'][$key];
			$fields['o_dxlimit']=$_POST['o_dxlimit'][$key];
			$fields['o_odd_limit']=$_POST['fixstrfrank'][$key];
			if ($key=='4') {
				$fields['o_odd_limit']=$_POST['fixstrfrank'][$key].'/'.($_POST['fixstrfrank'][$key]+7);
			}
			if ($key=='5') {
				$fields['o_odd_limit']=$_POST['fixstrfrank'][$key].'/'.($_POST['fixstrfrank'][$key]*2).'/'.($_POST['fixstrfrank'][$key]*3);
			// var_dump($fields);exit;
			}
			if ($key=='6') {
				$fields['o_odd_limit']=$_POST['fixstrfrank'][$key].'/'.($_POST['fixstrfrank'][$key]*2).'/'.($_POST['fixstrfrank'][$key]*4).'/'.($_POST['fixstrfrank'][$key]);
			}
			$fields['o_tuishui']=$_POST['fixstrhuishui'][$key];
			$db->get_update('oddsset_type',$fields,' o_typename="'.$_POST['typename'][$key].'" and user_id=0');
			$hs_set['tuishui']=$_POST['fixstrhuishui'][$key];
			$hs_set['d_tui']=$_POST['fixstrhuishui'][$key];
			$hs_set['zd_tui']=$_POST['fixstrhuishui'][$key];
			$hs_set['gd_tui']=$_POST['fixstrhuishui'][$key];
			$hs_set['fg_tui']=$_POST['fixstrhuishui'][$key];
			$hs_set['o_odds_limit']=$_POST['fixstrfrank'][$key];
			$hs_set['oddsset']=$_POST['fixstrfrank'][$key];
			if ($key=='4') {
				$hs_set['o_odds_limit']=$_POST['fixstrfrank'][$key].'/'.($_POST['fixstrfrank'][$key]+7);
				$hs_set['oddsset']=$_POST['fixstrfrank'][$key].'/'.($_POST['fixstrfrank'][$key]+7);
			}
			if ($key=='5') {
				$hs_set['o_odds_limit']=$_POST['fixstrfrank'][$key].'/'.($_POST['fixstrfrank'][$key]*2).'/'.($_POST['fixstrfrank'][$key]*3);
				$hs_set['oddsset']=$_POST['fixstrfrank'][$key].'/'.($_POST['fixstrfrank'][$key]*2).'/'.($_POST['fixstrfrank'][$key]*3);
			}
			if ($key=='6') {
				$hs_set['o_odds_limit']=$_POST['fixstrfrank'][$key].'/'.($_POST['fixstrfrank'][$key]*2).'/'.($_POST['fixstrfrank'][$key]*4).'/'.($_POST['fixstrfrank'][$key]);
				$hs_set['oddsset']=$_POST['fixstrfrank'][$key].'/'.($_POST['fixstrfrank'][$key]*2).'/'.($_POST['fixstrfrank'][$key]*4).'/'.($_POST['fixstrfrank'][$key]);
			}
			$db->get_update('tuishui_set',$hs_set,' typename="'.$_POST['typename'][$key].'" and user_id=0');
		}
		echo '<script>alert("修改成功");</script>';
	}else{
		foreach ($_POST['o_list_order'] as $key => $value) {
			$fields['o_list_order']=$value;
			$fields['o_dzlimit']=$_POST['o_dzlimit'][$key];
			$fields['o_dxlimit']=$_POST['o_dxlimit'][$key];
			$fields['o_odd_limit']=$_POST['fixstrfrank'][$key];
			$fields['o_tuishui']=$_POST['fixstrhuishui'][$key];
			$fields['user_id']=0;
			$db->get_insert('oddsset_type',$fields);
			$hs_set['tuishui']=$_POST['fixstrhuishui'][$key];
			$hs_set['d_tui']=$_POST['fixstrhuishui'][$key];
			$hs_set['zd_tui']=$_POST['fixstrhuishui'][$key];
			$hs_set['gd_tui']=$_POST['fixstrhuishui'][$key];
			$hs_set['fg_tui']=$_POST['fixstrhuishui'][$key];
			$fields['user_id']=0;
			$db->get_update('tuishui_set',$hs_set);
		}
		echo '<script>alert("添加成功");</script>';
	}
	echo '<script>window.location.href="default_setting.php";</script>';
	// var_dump($_POST);exit;
}
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
<style media=print> .Noprint{display:none;}</style>
<script type="text/javascript">
function checkalloption(form, value) {
	for(var i = 0; i < form.elements.length; i++) {
		var e = form.elements[i];
		if(e.value == value && e.type == 'radio' && e.disabled != true) {
			e.checked = true;
		}
	}
}
function checkAll(type, form, value, checkall, changestyle) {
	var checkall = checkall ? checkall : 'chkall';
	for(var i = 0; i < form.elements.length; i++) {
		var e = form.elements[i];
		if(type == 'option' && e.type == 'radio' && e.value == value && e.disabled != true) {
			e.checked = true;
		} else if(type == 'value' && e.type == 'checkbox' && e.getAttribute('chkvalue') == value) {
			e.checked = form.elements[checkall].checked;
		} else if(type == 'prefix' && e.name && e.name != checkall && (!value || (value && e.name.match(value)))) {
			e.checked = form.elements[checkall].checked;
			if(changestyle && e.parentNode && e.parentNode.tagName.toLowerCase() == 'li') {
				e.parentNode.className = e.checked ? 'checked' : '';
			}
		}
	}
}

function checkallvalue(form, value, checkall) {
	var checkall = checkall ? checkall : 'chkall';
	for(var i = 0; i < form.elements.length; i++) {
		var e = form.elements[i];
		if(e.type == 'checkbox' && e.value == value) {
			e.checked = form.elements[checkall].checked;
		}
	}
}

function zoomtextarea(objname, zoom) {
	zoomsize = zoom ? 10 : -10;
	obj = $(objname);
	if(obj.rows + zoomsize > 0 && obj.cols + zoomsize * 3 > 0) {
		obj.rows += zoomsize;
		obj.cols += zoomsize * 3;
	}
}

function redirect(url) {
	window.location.replace(url);
}

var collapsed = getcookie('cg_szyx_cookie_collapse');
function collapse_change(menucount) {

	if($('menu_' + menucount).style.display == 'none') {
		$('menu_' + menucount).style.display = '';collapsed = collapsed.replace('[' + menucount + ']' , '');
		$('menuimg_' + menucount).src = '../picture/menu_reduce.gif';
		
	} else {

		$('menu_' + menucount).style.display = 'none';collapsed += '[' + menucount + ']';
		$('menuimg_' + menucount).src = '../picture/menu_add.gif';
	}
	setcookie('cg_szyx_cookie_collapse', collapsed, 2592000);
}

function elamchange(base,flag,level){
	if(parseInt(level) < 5){
		var thislv = $('levelupoccupy');
		var nextlv = $('levelnextoccupy');
		if(flag == 0){
			nextlv.value = Math.round((base - thislv.value)*10)/10;
		}
		else{
			thislv.value = Math.round((base - nextlv.value)*10)/10;
		}
	}
}
</script>
</head>

<body leftmargin="10" topmargin="10" >
<div id="append_parent"></div>
<table width="99%" align=center border="0" cellpadding="0" cellspacing="0"><tr><td>
<SCRIPT LANGUAGE="JavaScript">
<!-- 
function openwinchuhuo(url) {
var iWidth=600; //窗口宽度 
var iHeight=600;//窗口高度 
var iTop=(window.screen.height-iHeight)/2; 
var iLeft=(window.screen.width-iWidth)/2; 
window.open(url,"Detail155706661","Scrollbars=no,Toolbar=no,Location=no,Direction=no,Resizeable=no, Width="+iWidth+" ,Height="+iHeight+",top="+iTop+",left="+iLeft); 
}

//--> 
</script>
	<style media=print> .Noprint{display:none;} </style> <table class="Noprint" width="100%"  border="0" cellpadding="0" cellspacing="0" ><tr><td><table width="100%" border="0" cellpadding="0" cellspacing="0" class="guide"><tr><td ><table width="100%" style="border:none;" border="0" cellpadding="0" cellspacing="0" ><tr  style="border:none;"><td style="border:none;" width=15%><a href="#" onClick=" parent.main.location='?action=home';return false;">位置</a>&nbsp;&raquo;&nbsp;退水默认设置</td>
		<td width=85% style="border:none;text-align:right;padding-right:10px;"><a href="addbranch.php?power=6"><b>新增下级</b></a> | <a href="leveladmin_plus.php?" target="main" ><b>账户列表</b></a></td></tr></table></td></tr></table></td></tr></table><br /><table width="100%" border="0" cellpadding="0" cellspacing="0" class="tableborder"><tr class="header"><td><div style="float:left; margin-left:0px; padding-top:8px"><a href="###" onclick="collapse_change('tip')">信息提示</a></div><div style="float:right; margin-right:4px; padding-bottom:9px"><a href="###" onclick="collapse_change('tip')"><img id="menuimg_tip" src="../picture/menu_reduce.gif" border="0"/></a></div></td></tr><tbody id="menu_tip" style="display:"><tr><td><ul><li><a href="leveladmin_plus.php?agent=958&level=7"><font color=#0033FF><?php echo $my_power;?>：<?php echo $my_user['user_name']?></font></a>&nbsp;&nbsp; 总信用额度：<?php echo $my_user['credit_total']?>；&nbsp;&nbsp;&nbsp;&nbsp;可分配信用额度：<?php echo $my_user['credit_remainder'];?>；&nbsp;&nbsp;&nbsp;&nbsp;已分配信用额度：<?php echo $my_user['credit_total']-$my_user['credit_remainder'];?>；</li></ul></td></tr></tbody></table><br /><SCRIPT LANGUAGE="JavaScript">
<!--
	function pledit(strid,n,t){
		id_arr = strid.split(',');
		if(id_arr=="")return '';
		for(i=0;i<=(id_arr.length-1);i++) {
			$(n+'_'+id_arr[i]).value=t.value;
		}
	}
//-->
</SCRIPT>
<form method="post" action="">
<input type="hidden" name="formhash" value="71d3b8a4">
<!-- 内容区 -->
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tableborder">
		<tr align="center" class="header">
		<td width="5"></td>
		<td width="*">类别</td>
		<td width="12%">最小下注</td>
		<!-- <td width="20%">赔率上限(多个用/分开)</td> -->
		<td width="12%">单注上限</td>
		<td width="12%">单项上限</td> 
		<td width="14%">默认回水</td>
		<td width="14%"> 最高赔率</td>
		</tr>
		<?php foreach ($top_oddsset as $key => $value){?>
		<?php if ($value['o_topid']=="0"){?>
		<?php $sizi_tuishui=$db->get_one("select * from tuishui_set where user_id=0".' and typename="'.$value['o_typename'].'"');?>
		 <tr onMouseOver="this.className='hover1'" onMouseOut="this.className='hover2'">
			<td class="altbg2" style="width:5px;"><div style=" margin-right:4px; padding-bottom:9px"><img id="menuimg_showfix_<?php echo $value['o_id'];?>" src="../picture/menu_add.gif" border="0"/></td>
			<td class="altbg1" ><a href="javascript:collapse_change('showfix_<?php echo $value['o_id'];?>');"><?php echo $value['o_typename'];?></a></td>
			<td class="altbg2"><span  style='<?php if($value['o_typename']=='二字定' || $value['o_typename']=='三字定'){echo 'display:none';}?>' ><input <?php if ($value['o_typename']=='二字定' || $value['o_typename']=='三字定'){echo 'disabled';}?> type="text" name="o_list_order[<?php echo $value['o_id']?>]" value="<?php echo $value['o_list_order']?>"></td>
			<!-- <td class="altbg2"><span  style='<?php if($value['o_typename']=='二字定' || $value['o_typename']=='三字定'){echo 'display:none';}?>' ><?php if($sizi_tuishui['o_odds_limit']){echo $sizi_tuishui['o_odds_limit'];}else{echo $value['o_odd_limit'];}?></td> -->
			<td class="altbg1"><span  style='<?php if($value['o_typename']=='二字定' || $value['o_typename']=='三字定'){echo 'display:none';}?>' ><input <?php if ($value['o_typename']=='二字定' || $value['o_typename']=='三字定'){echo 'disabled';}?> name="o_dzlimit[<?php echo $value['o_id'];?>]" value="<?php echo $value['o_dzlimit'];?>"></td>
			<td class="altbg2"><span  style='<?php if($value['o_typename']=='二字定' || $value['o_typename']=='三字定'){echo 'display:none';}?>' ><input <?php if ($value['o_typename']=='二字定' || $value['o_typename']=='三字定'){echo 'disabled';}?> name="o_dxlimit[<?php echo $value['o_id']?>]" value="<?php echo $value['o_dxlimit'];?>"></td>
			<td class="altbg1"><span  style='<?php if($value['o_typename']=='二字定' || $value['o_typename']=='三字定'){echo 'display:none';}?>' >
			<select id="fixstrhuishui_<?php echo $value['o_id'];?>" name="fixstrhuishui[<?php echo $value['o_id'];?>]"  >  
			<?php if($value['o_typename']=='四字定'){?>
			<?php $y=0; for ($i = 9700/10; $i >=850; $i--) {?>
				<option <?php if($sizi_tuishui['d_tui']==$y){echo 'selected="selected"';}?> value="<?php echo $y;?>" ><?php echo $y;?></option>
			<?php $y=(string)($y+0.001); }?>
			<?php }?>
			<?php if($value['o_typename']=='二字现'){?>
			<?php $y=0; for ($i = 9700/10; $i >=850; $i--) {?>
				<option <?php if($sizi_tuishui['d_tui']==$y){echo 'selected="selected"';}?> value="<?php echo $y;?>" ><?php echo $y;?></option>
			<?php $y=(string)($y+0.001); }?>
			<?php }?>
			<?php if($value['o_typename']=='三字现'){?>
			<?php $y=0; for ($i = 9700/10; $i >=850; $i--) {?>
				<option <?php if($sizi_tuishui['d_tui']==$y){echo 'selected="selected"';}?> value="<?php echo $y;?>" ><?php echo $y;?></option>
			<?php $y=(string)($y+0.001); }?>
			<?php }?>
			<?php if($value['o_typename']=='四字现'){?>
			<?php $y=0; for ($i = 9700/10; $i >=850; $i--) {?>
				<option <?php if($sizi_tuishui['d_tui']==$y){echo 'selected="selected"';}?> value="<?php echo $y;?>" ><?php echo $y;?></option>
			<?php $y=(string)($y+0.001); }?>
			<?php }?>
			</select></td>

			<td class="altbg2">
			<select  style='<?php if($value['o_typename']=='二字定' || $value['o_typename']=='三字定'){echo 'display:none';}?>'  id="fixstrfrank_<?php echo $value['o_id'];?>" name="fixstrfrank[<?php echo $value['o_id'];?>]"  >
			<?php if($value['o_typename']=='四字定'){?>
			<?php $y=0; for ($i = 970; $i >=850; $i--) {?>
				<option <?php if($value['o_odd_limit']==$i*10){echo 'selected="selected"';}?> value="<?php echo $i*10;?>" ><?php echo $i*10;?></option>
			<?php $y=(string)($y+0.001); }?>
			<?php }?>
			<?php if($value['o_typename']=='二字现'){?>
			<?php echo substr($value['o_odd_limit'],-strlen($value['o_odd_limit']),strpos($value['o_odd_limit'],'/'));echo $i;?>
			<?php $y=0; for ($i = 998; $i >=680; $i--) {?>
				<option <?php if($value['o_odd_limit']==$i/100){echo 'selected="selected"';}?> value="<?php echo $i/100;?>" ><?php echo $i/100;?></option>
			<?php $y=(string)($y+0.001); }?>
			<?php }?>
			<?php if($value['o_typename']=='三字现'){?>
			<?php $y=0; for ($i = 470; $i >=420; $i--) {?>
				<option <?php if($value['o_odd_limit']==$i/10){echo 'selected="selected"';}?> value="<?php echo $i/10;?>" ><?php echo $i/10;?></option>
			<?php $y=(string)($y+0.006); }?>
			<?php }?>
			<?php if($value['o_typename']=='四字现'){?>
			<?php $y=0; for ($i = 3792; $i >=3400; $i--) {?>
				<option <?php if($value['o_odd_limit']==$i/10){echo 'selected="selected"';}?> value="<?php echo $i/10;?>" ><?php echo $i/10;?></option>
			<?php $y=(string)($y+0.001); }?>
			<?php }?>
			</select>
			<input type="hidden" <?php if($value['o_typename']!=='二字定' && $value['o_typename']!=='三字定'){echo 'name="typename['. $value['o_id'].']"';}?> value="<?php echo $value['o_typename'];?>">
			<!--<span  style='display:none' ><span id="showfrank_1"></span>-->
			</td>
			</tr>
			<?php if($value['o_typename']=='二字定' || $value['o_typename']=='三字定'){?>
			<tr id="menu_showfix_<?php echo $value['o_id'];?>" ><td class="altbg2" colspan=8><table width="100%" border="0" cellpadding="0" cellspacing="0" class="tableborder">
		<?php foreach ($top_oddsset as $k => $v){?>
		<?php if($v['o_topid']==$value['o_typename']){?>
			<?php 
				$f_id[$value['o_id']][$k]=$v['o_id'];
			?>
			<tr  onMouseOver="this.className='hover1'" onMouseOut="this.className='hover2'">
			<td class="altbg2" width="5"></td>
			<td class="altbg1" width="*"><?php echo $v['o_typename'];?></td>
			<td class="altbg2" width="12%"><input type="text" name="o_list_order[<?php echo $v['o_id']?>]" value="<?php echo $v['o_list_order']?>"></td>
			<!-- <td class="altbg2" width="20%"><?php echo $sizi_tuishui['o_odds_limit']?$sizi_tuishui['o_odds_limit']:$v['o_odd_limit'];?></td> -->
			<td class="altbg1" width="12%"><input type="text" name="o_dzlimit[<?php echo $v['o_id'];?>]" value="<?php echo $v['o_dzlimit'];?>"></td>
			<td class="altbg2" width="12%"><input type="text" name="o_dxlimit[<?php echo $v['o_id'];?>]" value="<?php echo $v['o_dxlimit'];?>"></td>
			<td class="altbg1" width="14%"><select id="fixstrhuishui_<?php echo $v['o_id'];?>" name="fixstrhuishui[<?php echo $v['o_id'];?>]" >
			<?php $y_tuishui=$db->get_one("select * from tuishui_set where user_id=0".' and typename="'.$v['o_typename'].'"');?>


			<?php if($value['o_typename']=='二字定'){?>
			<?php $y=0; for ($i = 1000; $i >=890; $i--) {?>
				<option <?php if($y_tuishui['d_tui']==$y){echo 'selected="selected"';}?> value="<?php echo $y;?>" ><?php echo $y;?></option>
			<?php $y=(string)($y+0.001); }?>
			<?php }?>
			<?php if($value['o_typename']=='三字定'){?>
			<?php $y=0; for ($i = 1000; $i >=890; $i--) {?>
				<option <?php if($y_tuishui['d_tui']==$y){echo 'selected="selected"';}?> value="<?php echo $y;?>" ><?php echo $y;?></option>
			<?php $y=(string)($y+0.001); }?>
			<?php }?>
			</td>	

			<td class="altbg2" width="14%">
			<select id="fixstrfrank_<?php echo $v['o_id'];?>" name="fixstrfrank[<?php echo $v['o_id'];?>]"  >
			<?php if($value['o_typename']=='二字定'){?>
			<?php $y=0; for ($i = 1000; $i >=890; $i--) {?>
				<option <?php if($v['o_odd_limit']==$i/10){echo 'selected="selected"';}?> value="<?php echo $i/10;?>" ><?php echo $i/10;?></option>
			<?php $y=(string)($y+0.001); }?>
			<?php }?>
			<?php if($value['o_typename']=='三字定'){?>
			<?php $y=0; for ($i = 1000; $i >=890; $i--) {?>
				<option <?php if($v['o_odd_limit']==$i){echo 'selected="selected"';}?> value="<?php echo $i;?>" ><?php echo $i;?></option>
			<?php $y=(string)($y+0.001); }?>
			<?php }?>
			</select>
			<input type="hidden" name="typename[<?php echo $v['o_id'];?>]" value="<?php echo $v['o_typename'];?>">
			<!--<span id="showfrank_102">98.5</span>-->
			</td> 
			</tr>
			<?php }?>
			<?php }?>
			</td></tr>

			</table>

				</td></tr>
				<?php }?>
		<?php }?>
		<?php }?>
</table>
<!-- 内容区 -->
<br />
<table width="100%" border="0" cellpadding="0" cellspacing="0" ><tr>
<td width="37%">&nbsp;&nbsp;</td>
<td width="10%"><input class="button" type="submit"  value="提 交"></td>
<td width="35%">&nbsp;&nbsp;</td>
</tr></table>
</form>
</td></tr></table>
<br/>
<br/>
<br/>
</body>
</html>

