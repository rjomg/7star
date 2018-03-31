<?php
if (!session_id()) session_start();
error_reporting( 0 );
$user_name = $_GET['user_name'];
include_once( "../../global.php" );
$db = new action( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
$uid = $_SESSION["uid".$c_p_seesion];
$power = $_SESSION["user_power".$c_p_seesion];

// 二字定
$tow_d=$db->get_all('select * from autorain_set where view_order<=6');
// 三字定
$three_d=$db->get_all('select * from autorain_set where view_order>6 and view_order<=10');
// 四字定，二字现，三字现
$fourth_d=$db->get_all('select * from autorain_set where view_order>6 and view_order>10');
// 提交处理
if ($_POST) {
	foreach ($_POST['autodesc_limit'] as $key => $value) {
		$data['autodesc_limit']=$value;
		$data['desc_odds']=$_POST['desc_odds'][$key];
		$data['lowest_odds']=$_POST['lowest_odds'][$key];
		$data['is_use']=$_POST['is_use'][$key];
		$data['auto_time']=$_POST['auto_time'][$key];
		$res[$key]=$db->get_update('autorain_set',$data,' view_order='.$key.' ');
	}
	if (count($res)>=14) {
		echo '<script>alert("修改成功");window.location.href="auto_pre.php";</script>';
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>Document</title>
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
<table width="99%" align=center border="0" cellpadding="0" cellspacing="0"><tr><td>
<form method="post" action="">
	<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tableborder">
	<tbody>
		<tr align="center" class="header">
		<td width="5"></td>
		<td width="*">类别</td>
		<td width="12%">自动降限额</td>
		<td width="12%">最低赔率</td>
		<td width="12%">下降时间</td> 
		<td width="14%">下降赔率</td>
		<td width="14%"> 是否启用</td>
		</tr>
			<!-- 父级 -->
			<tr onmouseover="this.className='hover1'" onmouseout="this.className='hover2'" class="hover2">
				<td class="altbg2" style="width:5px;"><div style=" margin-right:4px; padding-bottom:9px"><img id="menuimg_showfix_1" src="../picture/menu_add.gif" border="0"></div></td>
				<td class="altbg1"><a href="javascript:collapse_change('showfix_1');">二字定</a></td>
				<td class="altbg2"></td>
				<td class="altbg1"></td>
				<td class="altbg2"></td>
				<td class="altbg1"></td>
				<td class="altbg2"></td>
			</tr>
			<!-- 父级end -->
			<!-- 子级 -->
				
			 <tr>
			 <td class="altbg2" colspan="8">
			 <table width="100%" border="0" cellpadding="0" cellspacing="0" class="tableborder">
			 <tbody>
			<?php foreach ($tow_d as $key => $value){?>
			 <tr onmouseover="this.className='hover1'" onmouseout="this.className='hover2'" class="hover2"> 
			     <td class="altbg2" width="5"></td> 
			     <td class="altbg1" width="*"><?php echo $value['o_typename'];?></td> 
			     <td class="altbg2" width="12%"><input type="text" name="autodesc_limit[<?php echo $value['view_order'];?>]" value="<?php echo $value['autodesc_limit'];?>" /></td> 
			     <td class="altbg1" width="12%"><input type="text" name="lowest_odds[<?php echo $value['view_order'];?>]" value="<?php echo $value['lowest_odds'];?>" /></td> 
			     <td class="altbg2" width="12%"><input style="width:30%;" type="text" name="auto_time[<?php echo $value['view_order'];?>]" value="<?php echo $value['auto_time'];?>" />分钟</td> 
			     <td class="altbg1" width="14%"><select name="desc_odds[<?php echo $value['view_order'];?>]"> 
			     <?php for ($i=0; $i <= 100; $i++) {?>
			     	<option <?php if(($i/1000)==$value['desc_odds']){echo 'selected';}?> value="<?php echo ($i/1000);?>"><?php echo ($i/1000);?></option>
			     <?php }?>
			     </select></td> 
			     <td class="altbg1" width="14%"><select name="is_use[<?php echo $value['view_order'];?>]"> <option <?php if($value['is_use']=='1'){echo 'selected';}?> value="1">是</option> <option <?php if($value['is_use']=='0'){echo 'selected';}?> value="0">否</option></select></td> 
			     </tr>
			<?php }?>
			     </tbody>
			     </table>
			     </td>
		    </tr> 
		    <!-- 子级end -->
			<!-- 父级 -->
			<tr onmouseover="this.className='hover1'" onmouseout="this.className='hover2'" class="hover2">
				<td class="altbg2" style="width:5px;"><div style=" margin-right:4px; padding-bottom:9px"><img id="menuimg_showfix_2" src="../picture/menu_add.gif" border="0"></div></td>
				<td class="altbg1"><a href="javascript:collapse_change('showfix_2');">三字定</a></td>
				<td class="altbg2"></td>
				<td class="altbg1"></td>
				<td class="altbg2"></td>
				<td class="altbg1"></td>
				<td class="altbg2"></td>
			</tr>
			<!-- 父级end -->
			<!-- 子级 -->
			<tr>
			 <td class="altbg2" colspan="8">
			 <table width="100%" border="0" cellpadding="0" cellspacing="0" class="tableborder">
			 <tbody>
			<?php foreach ($three_d as $key => $value){?>
			 <tr onmouseover="this.className='hover1'" onmouseout="this.className='hover2'" class="hover2"> 
			     <td class="altbg2" width="5"></td> 
			     <td class="altbg1" width="*"><?php echo $value['o_typename'];?></td> 
			     <td class="altbg2" width="12%"><input type="text" name="autodesc_limit[<?php echo $value['view_order'];?>]" value="<?php echo $value['autodesc_limit'];?>" /></td> 
			     <td class="altbg1" width="12%"><input type="text" name="lowest_odds[<?php echo $value['view_order'];?>]" value="<?php echo $value['lowest_odds'];?>" /></td> 
			     <td class="altbg2" width="12%"><input style="width:30%;" type="text" name="auto_time[<?php echo $value['view_order'];?>]" value="<?php echo $value['auto_time'];?>" />分钟</td> 
			     <td class="altbg1" width="14%"><select name="desc_odds[<?php echo $value['view_order'];?>]"> 
			     <?php for ($i=0; $i <= 100; $i++) {?>
			     	<option <?php if(($i/1000)==$value['desc_odds']){echo 'selected';}?> value="<?php echo ($i/1000);?>"><?php echo ($i/1000);?></option>
			     <?php }?>
			     </select></td> 
			     <td class="altbg1" width="14%"><select name="is_use[<?php echo $value['view_order'];?>]"> <option <?php if($value['is_use']=='1'){echo 'selected';}?> value="1">是</option> <option <?php if($value['is_use']=='0'){echo 'selected';}?> value="0">否</option></select></td> 
			     </tr>
			<?php }?>
			     </tbody>
			     </table>
			     </td>
		    </tr> 
		    <!-- 子级end -->
		    <!-- 四字定，二字现，三字现 -->
		    <?php foreach ($fourth_d as $key => $value){?>	
			<tr onmouseover="this.className='hover1'" onmouseout="this.className='hover2'" class="hover2">
				<td class="altbg2" style="width:5px;"><div style=" margin-right:4px; padding-bottom:9px"><img id="menuimg_showfix_2" src="../picture/menu_add.gif" border="0"></div></td>
				<td class="altbg1"><a href="javascript:collapse_change('showfix_2');"><?php echo $value['o_typename'];?></a></td> 
			     <td class="altbg2" width="12%"><input type="text" name="autodesc_limit[<?php echo $value['view_order'];?>]" value="<?php echo $value['autodesc_limit'];?>" /></td> 
			     <td class="altbg1" width="12%"><input type="text" name="lowest_odds[<?php echo $value['view_order'];?>]" value="<?php echo $value['lowest_odds'];?>" /></td> 
			     <td class="altbg2" width="12%"><input style="width:30%;" type="text" name="auto_time[<?php echo $value['view_order'];?>]" value="<?php echo $value['auto_time'];?>" />分钟</td> 
			     <td class="altbg1" width="14%"><select name="desc_odds[<?php echo $value['view_order'];?>]"> 
			     <?php for ($i=0; $i <= 100; $i++) {?>
			     	<option <?php if(($i/1000)==$value['desc_odds']){echo 'selected';}?> value="<?php echo ($i/1000);?>"><?php echo ($i/1000);?></option>
			     <?php }?>
			     </select></td> 
			     <td class="altbg1" width="14%"><select name="is_use[<?php echo $value['view_order'];?>]"> <option <?php if($value['is_use']=='1'){echo 'selected';}?> value="1">是</option> <option <?php if($value['is_use']=='0'){echo 'selected';}?> value="0">否</option></select></td> 
			</tr>
		    <?php }?>
			<!-- 四字定，二字现，三字现 -->
    </tbody>
	</table>
	</td>
	</tr>
	</table>
	<br />
	<br />
	<br />
	<table width="100%" border="0" cellpadding="0" cellspacing="0"><tbody><tr>
	<td width="37%">&nbsp;&nbsp;</td>
	<td width="10%"><input class="button" type="submit" value="提 交"></td>
	<td width="30%">&nbsp;&nbsp;</td>
	</tr></tbody></table>
	<br />
	<br />
	<br />
	</form>
</body>
</html>