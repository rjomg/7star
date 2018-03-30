<?php 
include_once( "../../global.php" );
$db = new mysql( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
$top_id = $_SESSION['uid'.$c_p_seesion];	
if ($_GET['top_id']) {
	$top_id=$_GET['top_id'];
}
// if ($top_id=='1') {
// 	$top_id=0;
// }
// var_dump($top_id);exit;
$user_one=$db->get_one('select * from users where user_id='.$_GET['user_id']);
$my_user=$db->get_one('select * from users where user_id='.$top_id);

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
switch ($_GET['power']) {
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
// 获取所以下级id
$son_id=$db->loweralluser_arr($_GET['user_id']);
// $son_tui=$db->get_all('select * from tuishui_set where user_id in('.$son_id.')');
// var_dump($son_tui);exit;
//查找上级信息
// $username = $_SESSION['username'.$c_p_seesion];

$oddsset_type=$db->get_all("select user_id from oddsset_type group by user_id");
foreach ($oddsset_type as $key => $value) {
	$oddsset[]=$value['user_id'];
}
// var_dump($top_id);exit;
// if (in_array($top_id,$oddsset)) {
// 	$top_oddsset=$db->get_all("select * from oddsset_type where user_id=".$top_id);
// }else{
// 	$top_oddsset=$db->get_all("select * from oddsset_type where user_id=0");
// }
$top_oddsset0=$db->get_all("select * from oddsset_type where o_typename='二字定' or o_typename='三字定' group by o_typename order by o_typename DESC");
$top_oddsset1 =$db->get_all("select * from tuishui_set left join oddsset_type on tuishui_set.odds_id=oddsset_type.o_id where tuishui_set.user_id=".$_GET['user_id'].' and oddsset_type.user_id=0');
$top_oddsset=array_merge($top_oddsset0,$top_oddsset1);
//退水设置
foreach ($top_oddsset as $key => $value) {
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
	$tuishui=json_encode($data);

// 保存数据
if ($_POST) {
	// 会员信息
	// if ($_POST['user_name']!=$user_one['user_name']) {
	// 	$user_in=$db->get_one('select user_id from users where user_name="'.$_POST['user_name'].'"');
	// 	if (!empty($user_in)) {
	// 		echo '<script>history.go(-1);alert("改账户名已存在");</script>';exit;
	// 	}
	// }
	// $user['user_name']=$_POST['user_name'];
	$user['user_nick']=$_POST['user_nick'];
	$user['is_lock']=$_POST['is_lock'];
	if (!empty($_POST['user_pwd'])) {	
		$user['user_pwd']=md5($_POST['user_pwd']);
	}
	$user['credit_total']=$_POST['credit_total'];
	$user['credit_remainder']=number_format(($_POST['credit_total']-$user_one['credit_total'])+$user_one['credit_remainder'], 0, '', '');
	$top_credit=number_format($my_user['credit_remainder']-($_POST['credit_total']-$user_one['credit_total']), 0, '', '');
	// var_dump($user_one['credit_total']);exit;
	if ($top_credit<0) {
		echo '<script>history.go(-1);alert("上级信用额度不足");</script>';exit;
	}
	$db->get_update('users',$user,'user_id='.$_GET['user_id']);
	$db->get_update('users',array('credit_remainder'=>$top_credit),'user_id='.$top_id);
	// 退水
	$old_tuishui=$db->get_one("select user_id from tuishui_set where user_id=".$_GET['user_id']);
	if (!empty($old_tuishui)) {
		foreach ($_POST['fixstrhuishui'] as $key => $value) {
			$old_set=$db->get_one("select oddsset from tuishui_set where user_id=".$_GET['user_id']." and typename='".$_POST['typename'][$key]."'");
			// var_dump($old_set);exit;
			if ($_POST['typename'][$key]=='口X口X' || $_POST['typename'][$key]=='口XX口' || $_POST['typename'][$key]=='口口XX' || $_POST['typename'][$key]=='X口口X' || $_POST['typename'][$key]=='XX口口' || $_POST['typename'][$key]=='X口X口') {
				$fields['oddsset']=$old_set['oddsset']-($value*100);
				$os=$value*100;
				if ($son_id) {	
					$db->query("UPDATE tuishui_set SET oddsset=oddsset-".$os." WHERE typename='".$_POST['typename'][$key]."' and user_id in (".$son_id.")");
				}
			}
			if ($_POST['typename'][$key]=='四字定') {
				$fields['oddsset']=$old_set['oddsset']-($value*10000);
				$os=$value*10000;
				if ($son_id) {	
					$db->query("UPDATE tuishui_set SET oddsset=oddsset-".$os." WHERE typename='".$_POST['typename'][$key]."' and user_id in (".$son_id.")");
				}
			}
			if ($_POST['typename'][$key]=='口口口X' || $_POST['typename'][$key]=='口X口口' || $_POST['typename'][$key]=='X口口口') {
				$fields['oddsset']=$old_set['oddsset']-($value*1000);
				$os=$value*1000;
				if ($son_id) {	
					$db->query("UPDATE tuishui_set SET oddsset=oddsset-".$os." WHERE typename='".$_POST['typename'][$key]."' and user_id in (".$son_id.")");
				}
			}
			if ($_POST['typename'][$key]=='二字现') {
				$fields['oddsset']=($old_set['oddsset']-($value*10)).'/'.(($old_set['oddsset']-($value*10))+7);
				$os=$value*10;
				if ($son_id) {	
					$db->query("UPDATE tuishui_set SET oddsset=oddsset-".$os." WHERE typename='".$_POST['typename'][$key]."' and user_id in (".$son_id.")");
				}
			}
			if ($_POST['typename'][$key]=='三字现') {
				$fields['oddsset']=($old_set['oddsset']-($value*100)).'/'.(($old_set['oddsset']-($value*100))*2).'/'.(($old_set['oddsset']-($value*100))*3);
				$os=$value*100;
				if ($son_id) {	
					$db->query("UPDATE tuishui_set SET oddsset=oddsset-".$os." WHERE typename='".$_POST['typename'][$key]."' and user_id in (".$son_id.")");
				}
			}
			if ($_POST['typename'][$key]=='四字现') {
				$fields['oddsset']=($old_set['oddsset']-($value*1000)).'/'.(($old_set['oddsset']-($value*1000))*2).'/'.(($old_set['oddsset']-($value*1000))*4).'/'.(($old_set['oddsset']-($value*1000)));
				$os=$value*1000;
				if ($son_id) {	
					$db->query("UPDATE tuishui_set SET oddsset=oddsset-".$os." WHERE typename='".$_POST['typename'][$key]."' and user_id in (".$son_id.")");
				}
			}
			$fields[$power]=$value;
			$fields['o_odds_limit']=$_POST['frank'][$key];
			$fields['odds_id']=$key;
			$db->get_update('tuishui_set',$fields,' typename="'.$_POST['typename'][$key].'" and user_id='.$_GET['user_id']);
			$son[$power]=$value;
			$son['o_odds_limit']=$_POST['frank'][$key];
			$db->get_update('tuishui_set',$son,' typename="'.$_POST['typename'][$key].'" and user_id in('.$son_id.')');
		}
		echo '<script>alert("修改成功");</script>';
	}else{
		foreach ($_POST['fixstrhuishui'] as $key => $value) {
			$fields['user_id']=$_GET['user_id'];
			$fields[$power]=$value;
			$fields['o_odds_limit']=$_POST['frank'][$key];
			$fields['oddsset']=$_POST['frank'][$key];
			$fields['typename']=$_POST['typename'][$key];
			$fields['odds_id']=$key;
			$db->get_insert('tuishui_set',$fields);
		}
		echo '<script>alert("添加成功");</script>';
	}
	echo '<script>window.location.href="branch.php?power='.$_GET['power'].'&top_uid='.$top_id.'";</script>';
	// var_dump($_POST);exit;
}
// var_dump($top_oddsset);exit;
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
	<style media=print> .Noprint{display:none;} </style> <table class="Noprint" width="100%"  border="0" cellpadding="0" cellspacing="0" ><tr><td><table width="100%" border="0" cellpadding="0" cellspacing="0" class="guide"><tr><td ><table width="100%" style="border:none;" border="0" cellpadding="0" cellspacing="0" ><tr  style="border:none;"><td style="border:none;" width=15%><a href="#" onClick=" parent.main.location='?action=home';return false;">位置</a>&nbsp;&raquo;&nbsp;编辑</td>
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
<form method="post" action="leveladdedit.php?user_id=<?php echo $_GET['user_id'];?>&power=<?php echo $_GET['power'];?>&top_id=<?php echo $top_id;?>">
<input type="hidden" name="formhash" value="71d3b8a4">
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tableborder">
<tbody><tr class="header"><td colspan="4">编辑会员</td></tr>

<tr>
<td class="altbg1">账　　号:</td>
<td align="right" class="altbg2"><input type="text" maxlength="6" name="user_name" value="<?php echo $user_one['user_name'];?>" autocomplete="off"></td>
<td class="altbg1">启/停用:</td>
<td align="right" class="altbg2">启用<input type="radio" name="is_lock" value="0" <?php if($user_one['is_lock']==0){echo "checked";}?> >&nbsp;&nbsp;停用<input type="radio" name="is_lock" <?php if($user_one['is_lock']==2){echo "checked";}?> value="2">&nbsp;&nbsp;暂停下注<input type="radio" name="is_lock" <?php if($user_one['is_lock']==3){echo "checked";}?> value="3"></td>
</tr>
<tr>
<td class="altbg1">密　　码:</td>
<input type="hidden">
<td align="right" class="altbg2"><input type="password" name="user_pwd" autocomplete="off"></td>
<td class="altbg1">Email:</td>
<td align="right" class="altbg2"><input type="text" name="newemail" value=""></td>
</tr>
<tr>
<td class="altbg1">代　　号:</td>
<td align="right" class="altbg2"><input type="text" maxlength="3" name="user_nick" value="<?php echo $user_one['user_nick'];?>"></td>
<td class="altbg1">联系电话:</td>
<td align="right" class="altbg2"><input type="text" name="phone" value="0"></td>
</tr>
<tr>
	<td class="altbg1">拦货占成上限:</td>
	<td align="right" class="altbg2" colspan="3">
	代理	<select disabled id ='levelupoccupy' name='levelupoccupy' onchange='elamchange(5,0,8)'><option value='0' selected>0</option><option value='0.1' selected>0.1</option><option value='0.2' selected>0.2</option><option value='0.3' selected>0.3</option><option value='0.4' selected>0.4</option><option value='0.5' selected>0.5</option><option value='0.6' selected>0.6</option><option value='0.7' selected>0.7</option><option value='0.8' selected>0.8</option><option value='0.9' selected>0.9</option><option value='1' selected>1</option><option value='1.1' selected>1.1</option><option value='1.2' selected>1.2</option><option value='1.3' selected>1.3</option><option value='1.4' selected>1.4</option><option value='1.5' selected>1.5</option><option value='1.6' selected>1.6</option><option value='1.7' selected>1.7</option><option value='1.8' selected>1.8</option><option value='1.9' selected>1.9</option><option value='2' selected>2</option><option value='2.1' selected>2.1</option><option value='2.2' selected>2.2</option><option value='2.3' selected>2.3</option><option value='2.4' selected>2.4</option><option value='2.5' selected>2.5</option><option value='2.6' selected>2.6</option><option value='2.7' selected>2.7</option><option value='2.8' selected>2.8</option><option value='2.9' selected>2.9</option><option value='3' selected>3</option><option value='3.1' selected>3.1</option><option value='3.2' selected>3.2</option><option value='3.3' selected>3.3</option><option value='3.4' selected>3.4</option><option value='3.5' selected>3.5</option><option value='3.6' selected>3.6</option><option value='3.7' selected>3.7</option><option value='3.8' selected>3.8</option><option value='3.9' selected>3.9</option><option value='4' selected>4</option><option value='4.1' selected>4.1</option><option value='4.2' selected>4.2</option><option value='4.3' selected>4.3</option><option value='4.4' selected>4.4</option><option value='4.5' selected>4.5</option><option value='4.6' selected>4.6</option><option value='4.7' selected>4.7</option><option value='4.8' selected>4.8</option><option value='4.9' selected>4.9</option><option value='5' selected>5</option></select><select disabled style='visibility: hidden' id ='levelnextoccupy' name='levelnextoccupy' onchange='elamchange(5,1,8)'><option value='0' selected>0</option><option value='0.1' selected>0.1</option><option value='0.2' selected>0.2</option><option value='0.3' selected>0.3</option><option value='0.4' selected>0.4</option><option value='0.5' selected>0.5</option><option value='0.6' selected>0.6</option><option value='0.7' selected>0.7</option><option value='0.8' selected>0.8</option><option value='0.9' selected>0.9</option><option value='1' selected>1</option><option value='1.1' selected>1.1</option><option value='1.2' selected>1.2</option><option value='1.3' selected>1.3</option><option value='1.4' selected>1.4</option><option value='1.5' selected>1.5</option><option value='1.6' selected>1.6</option><option value='1.7' selected>1.7</option><option value='1.8' selected>1.8</option><option value='1.9' selected>1.9</option><option value='2' selected>2</option><option value='2.1' selected>2.1</option><option value='2.2' selected>2.2</option><option value='2.3' selected>2.3</option><option value='2.4' selected>2.4</option><option value='2.5' selected>2.5</option><option value='2.6' selected>2.6</option><option value='2.7' selected>2.7</option><option value='2.8' selected>2.8</option><option value='2.9' selected>2.9</option><option value='3' selected>3</option><option value='3.1' selected>3.1</option><option value='3.2' selected>3.2</option><option value='3.3' selected>3.3</option><option value='3.4' selected>3.4</option><option value='3.5' selected>3.5</option><option value='3.6' selected>3.6</option><option value='3.7' selected>3.7</option><option value='3.8' selected>3.8</option><option value='3.9' selected>3.9</option><option value='4' selected>4</option><option value='4.1' selected>4.1</option><option value='4.2' selected>4.2</option><option value='4.3' selected>4.3</option><option value='4.4' selected>4.4</option><option value='4.5' selected>4.5</option><option value='4.6' selected>4.6</option><option value='4.7' selected>4.7</option><option value='4.8' selected>4.8</option><option value='4.9' selected>4.9</option><option value='5' selected>5</option></select>	<br>（设置占成，需要在“设置”中添加<font color="#FF0000"><b>拦货金额</b></font>才生效）。<font color="#FF0000"><b>提示:</b></font>如果庄家先吃满,则不以所设成数来分配,以实际分配到拦货中金额为准。
	</td>

<input type="hidden" name="handset" value="0">
</tr>
<tr>
<td class="altbg1">信用额度:</td>
<td align="right" class="altbg2" colspan="3"><input type="text" name="credit_total" value="<?php echo $user_one['credit_total'];?>">
</td>
</tr>



</tbody></table><br />
<!-- 内容区 -->
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tableborder">
		<tr align="center" class="header">
		<td width="10"></td>
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
		<?php $sizi_tuishui=$db->get_one("select * from tuishui_set where user_id=".$_GET['user_id'].' and typename="'.$value['o_typename'].'"');?>
		<?php if ($value['o_typename']=='四字定'){?>
			<?php 
				if ($power=='gd_tui') {
					$value['o_odd_limit']=$value['o_odd_limit']-$sizi_tuishui['fg_tui']*10000;
				}
				if ($power=='zd_tui') {
					$value['o_odd_limit']=$value['o_odd_limit']-$sizi_tuishui['fg_tui']*10000-$sizi_tuishui['gd_tui']*10000;
				}
				if ($power=='d_tui') {
					$value['o_odd_limit']=$value['o_odd_limit']-$sizi_tuishui['fg_tui']*10000-$sizi_tuishui['gd_tui']*10000-$sizi_tuishui['zd_tui']*10000;
				}
				if ($power=='h_tui') {
					$value['o_odd_limit']=$value['o_odd_limit']-$sizi_tuishui['fg_tui']*10000-$sizi_tuishui['gd_tui']*10000-$sizi_tuishui['zd_tui']*10000-$sizi_tuishui['d_tui']*10000;
				}

			?>
		<?php }?>
		 <tr onMouseOver="this.className='hover1'" onMouseOut="this.className='hover2'">
			<td class="altbg2"><div style=" margin-right:4px; padding-bottom:9px"><img id="menuimg_showfix_<?php echo $value['o_id'];?>" src="../picture/menu_add.gif" border="0"/></td>
			<td class="altbg1" ><a href="javascript:collapse_change('showfix_<?php echo $value['o_id'];?>');"><?php echo $value['o_typename'];?></a></td>
			<td class="altbg2"><span  style='<?php if($value['o_typename']=='二字定' || $value['o_typename']=='三字定'){echo 'display:none';}?>' >1</td>
			<td class="altbg2"><span  style='<?php if($value['o_typename']=='二字定' || $value['o_typename']=='三字定'){echo 'display:none';}?>' >
			<?php echo $value['o_odd_limit'];//if($sizi_tuishui['o_odds_limit']){echo $sizi_tuishui['o_odds_limit'];}else{echo $value['o_odd_limit'];}?>
			</td>
			<td class="altbg1"><span  style='<?php if($value['o_typename']=='二字定' || $value['o_typename']=='三字定'){echo 'display:none';}?>' ><?php echo $value['o_dzlimit'];?></td>
			<td class="altbg2"><span  style='<?php if($value['o_typename']=='二字定' || $value['o_typename']=='三字定'){echo 'display:none';}?>' ><?php echo $value['o_dxlimit'];?></td>
			<td class="altbg1"><span  style='<?php if($value['o_typename']=='二字定' || $value['o_typename']=='三字定'){echo 'display:none';}?>' >
			<select id="fixstrhuishui_<?php echo $value['o_id'];?>" name="fixstrhuishui[<?php echo $value['o_id'];?>]" onchange="showfrank('<?php echo $value['o_id'];?>',this.value,0,0)" >  
			<?php if($value['o_typename']=='四字定'){?>
			<?php $y=0; for ($i = $value['o_odd_limit']/10; $i >=850; $i--) {?>
				<option <?php if($sizi_tuishui[$power]==$y){echo 'selected="selected"';}?> value="<?php echo $y;?>" ><?php echo $y;?></option>
			<?php $y=(string)($y+0.001); }?>
			<?php }?>
			<?php if($value['o_typename']=='二字现'){?>
			<?php $y=0; for ($i = substr($value['o_odd_limit'],-strlen($value['o_odd_limit']),strpos($value['o_odd_limit'],'/'))*100; $i >=680; $i--) {?>
				<option <?php if($sizi_tuishui['tuishui']==$y){echo 'selected="selected"';}?> value="<?php echo $y;?>" ><?php echo $y;?></option>
			<?php $y=(string)($y+0.001); }?>
			<?php }?>
			<?php if($value['o_typename']=='三字现'){?>
			<?php $y=0; for ($i = substr($value['o_odd_limit'],-strlen($value['o_odd_limit']),strpos($value['o_odd_limit'],'/'))*10; $i >=420; $i--) {?>
				<option <?php if($sizi_tuishui['tuishui']==$y){echo 'selected="selected"';}?> value="<?php echo $y;?>" ><?php echo $y;?></option>
			<?php $y=(string)($y+0.001); }?>
			<?php }?>
			<?php if($value['o_typename']=='四字现'){?>
			<?php $y=0; for ($i = substr($value['o_odd_limit'],-strlen($value['o_odd_limit']),strpos($value['o_odd_limit'],'/'))*10; $i >=3000; $i--) {?>
				<option <?php if($sizi_tuishui['tuishui']==$y){echo 'selected="selected"';}?> value="<?php echo $y;?>" ><?php echo $y;?></option>
			<?php $y=(string)($y+0.001); }?>
			<?php }?>
			</select>
			</td>

			<td class="altbg2">
			<select  style='<?php if($value['o_typename']=='二字定' || $value['o_typename']=='三字定'){echo 'display:none';}?>'  id="fixstrfrank_<?php echo $value['o_id'];?>" name="fixstrfrank[<?php echo $value['o_id'];?>]" onchange="showfrank('<?php echo $value['o_id'];?>',this.value,0,0)" >
			<?php if($value['o_typename']=='四字定'){?>
			<?php $y=0; for ($i = $value['o_odd_limit']/10; $i >=850; $i--) {?>
				<option <?php if($sizi_tuishui[$power]==$y){echo 'selected="selected"';}?> value="<?php echo $y;?>" ><?php echo $i*10;?></option>
			<?php $y=(string)($y+0.001); }?>
			<?php }?>
			<?php if($value['o_typename']=='二字现'){?>
			<?php echo substr($value['o_odd_limit'],-strlen($value['o_odd_limit']),strpos($value['o_odd_limit'],'/'));echo $i;?>
			<?php $y=0; for ($i = substr($value['o_odd_limit'],-strlen($value['o_odd_limit']),strpos($value['o_odd_limit'],'/'))*100; $i >=680; $i--) {?>
				<option <?php if($sizi_tuishui['tuishui']==$y){echo 'selected="selected"';}?> value="<?php echo $y;?>" ><?php echo $i/100;?></option>
			<?php $y=(string)($y+0.001); }?>
			<?php }?>
			<?php if($value['o_typename']=='三字现'){?>
			<?php $y=0; for ($i = substr($value['o_odd_limit'],-strlen($value['o_odd_limit']),strpos($value['o_odd_limit'],'/'))*10; $i >=420; $i--) {?>
				<option <?php if($sizi_tuishui['tuishui']==$y){echo 'selected="selected"';}?> value="<?php echo $y;?>" ><?php echo $i/10;?></option>
			<?php $y=(string)($y+0.001); }?>
			<?php }?>
			<?php if($value['o_typename']=='四字现'){?>
			<?php $y=0; for ($i = substr($value['o_odd_limit'],-strlen($value['o_odd_limit']),strpos($value['o_odd_limit'],'/'))*10; $i >=3000; $i--) {?>
				<option <?php if($sizi_tuishui['tuishui']==$y){echo 'selected="selected"';}?> value="<?php echo $y;?>" ><?php echo $i/10;?></option>
			<?php $y=(string)($y+0.001); }?>
			<?php }?>
			</select>
			<input type="hidden" id="frank_<?php echo $value['o_id'];?>" <?php if($value['o_typename']!=='二字定' && $value['o_typename']!=='三字定'){echo 'name="frank['. $value['o_id'].']"';}?> value="<?php echo $sizi_tuishui['o_odds_limit']?$sizi_tuishui['o_odds_limit']:$value['o_odd_limit'];?>">
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
			<td class="altbg2" width="13"></td>
			<td class="altbg1" width="*"><?php echo $v['o_typename'];?></td>
			<td class="altbg2" width="12%">1</td>
			<td class="altbg2" width="20%">
			<?php $y_tuishui=$db->get_one("select * from tuishui_set where user_id=".$_GET['user_id'].' and typename="'.$v['o_typename'].'"');?>
			<?php 
				if ($value['o_typename']=='二字定') {
					if ($power=='gd_tui') {
						$v['o_odd_limit']=$v['o_odd_limit']-$y_tuishui['fg_tui']*100;
					}
					if ($power=='zd_tui') {
						$v['o_odd_limit']=$v['o_odd_limit']-$y_tuishui['fg_tui']*100-$y_tuishui['gd_tui']*100;
					}
					if ($power=='d_tui') {
						$v['o_odd_limit']=$v['o_odd_limit']-$y_tuishui['fg_tui']*100-$y_tuishui['gd_tui']*100-$y_tuishui['zd_tui']*100;
					}
					if ($power=='h_tui') {
						$v['o_odd_limit']=$v['o_odd_limit']-$y_tuishui['fg_tui']*100-$y_tuishui['gd_tui']*100-$y_tuishui['zd_tui']*100-$y_tuishui['d_tui']*100;
					}
				}
				if ($value['o_typename']=='三字定') {
					if ($power=='gd_tui') {
						$v['o_odd_limit']=$v['o_odd_limit']-$y_tuishui['fg_tui']*1000;
					}
					if ($power=='zd_tui') {
						$v['o_odd_limit']=$v['o_odd_limit']-$y_tuishui['fg_tui']*1000-$y_tuishui['gd_tui']*1000;
					}
					if ($power=='d_tui') {
						$v['o_odd_limit']=$v['o_odd_limit']-$y_tuishui['fg_tui']*1000-$y_tuishui['gd_tui']*1000-$y_tuishui['zd_tui']*1000;
					}
					if ($power=='h_tui') {
						$v['o_odd_limit']=$v['o_odd_limit']-$y_tuishui['fg_tui']*1000-$y_tuishui['gd_tui']*1000-$y_tuishui['zd_tui']*1000-$y_tuishui['d_tui']*1000;
					}
				}
			?>
			<?php echo $sizi_tuishui['o_odds_limit']?$sizi_tuishui['o_odds_limit']:$v['o_odd_limit'];?>
			</td>
			<td class="altbg1" width="12%"><?php echo $v['o_dzlimit'];?></td>
			<td class="altbg2" width="12%"><?php echo $v['o_dxlimit'];?></td>
			<td class="altbg1" width="14%"><select id="fixstrhuishui_<?php echo $v['o_id'];?>" name="fixstrhuishui[<?php echo $v['o_id'];?>]" onchange="showfrank('<?php echo $v['o_id'];?>',this.value,'<?php echo $value['o_id'];?>',0)">


			<?php if($value['o_typename']=='二字定'){?>
			<?php $y=0; for ($i = $v['o_odd_limit']*10; $i >=890; $i--) {?>
				<option <?php if($y_tuishui[$power]==$y){echo 'selected="selected"';}?> value="<?php echo $y;?>" ><?php echo $y;?></option>
			<?php $y=(string)($y+0.001); }?>
			<?php }?>
			<?php if($value['o_typename']=='三字定'){?>
			<?php $y=0; for ($i = $v['o_odd_limit']; $i >=890; $i--) {?>
				<option <?php if($y_tuishui[$power]==$y){echo 'selected="selected"';}?> value="<?php echo $y;?>" ><?php echo $y;?></option>
			<?php $y=(string)($y+0.001); }?>
			<?php }?>
			</td>	

			<td class="altbg2" width="14%">
			<select id="fixstrfrank_<?php echo $v['o_id'];?>" name="fixstrfrank[<?php echo $v['o_id'];?>]" onchange="showfrank('<?php echo $v['o_id'];?>',this.value,'<?php echo $value['o_id'];?>',1)" >
			<?php if($value['o_typename']=='二字定'){?>
			<?php $y=0; for ($i = $v['o_odd_limit']*10; $i >=890; $i--) {?>
				<option <?php if($y_tuishui[$power]==$y){echo 'selected="selected"';}?> value="<?php echo $y;?>" ><?php echo $i/10;?></option>
			<?php $y=(string)($y+0.001); }?>
			<?php }?>
			<?php if($value['o_typename']=='三字定'){?>
			<?php $y=0; for ($i = $v['o_odd_limit']; $i >=890; $i--) {?>
				<option <?php if($y_tuishui[$power]==$y){echo 'selected="selected"';}?> value="<?php echo $y;?>" ><?php echo $i;?></option>
			<?php $y=(string)($y+0.001); }?>
			<?php }?>
			</select>
			<input type="hidden" id="frank_<?php echo $v['o_id'];?>" name="frank[<?php echo $v['o_id'];?>]" value="<?php echo $y_tuishui['o_odds_limit']?$y_tuishui['o_odds_limit']:$v['o_odd_limit'];?>">
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
<SCRIPT LANGUAGE="JavaScript">
		<!--
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
						$('fixstrhuishui_'+fixclassid).value = huishui[fixclassid][keyid]['huishui'];
						$('fixstrfrank_'+fixclassid).value = huishui[fixclassid][keyid]['huishui'];
						$('frank_'+fixclassid).value = huishui[fixclassid][keyid]['frank'];
					}
				}
			}
		//-->
		</SCRIPT>
</td></tr></table>
<br/>
<br/>
<br/>
</body>
</html>

