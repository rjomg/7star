<?php 
include_once( "../../global.php" );
$db = new mysql( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
$uid=$_SESSION["uid".$c_p_seesion];
$user_one=$db->get_one('select * from users where user_id='.$uid);
$my_odds=$db->get_one('select * from oddsset_type where user_id='.$uid);

switch ($user_one['user_power']) {
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
// if (empty($my_odds)) {	
// 	$odds_p=$db->get_all('select * from oddsset_type where o_topid="0" and user_id=0 order by o_id ASC');
// 	$odds_son=$db->get_all('select * from oddsset_type where o_topid!="0" and user_id=0 order by o_id ASC');
// }else{
// 	$odds_p=$db->get_all('select * from oddsset_type where o_topid="0" and user_id='.$uid.' order by o_id ASC');
// 	$odds_son=$db->get_all('select * from oddsset_type where o_topid!="0" and user_id='.$uid.' order by o_id ASC');
// }
$top_oddsset0=$db->get_all("select * from oddsset_type where o_typename='二字定' or o_typename='三字定' group by o_typename order by o_typename DESC");
$top_oddsset1 =$db->get_all("select * from tuishui_set left join oddsset_type on tuishui_set.odds_id=oddsset_type.o_id where tuishui_set.user_id=".$uid.' and oddsset_type.user_id=0 order by tuishui_set.odds_id ASC');
$top_oddsset=array_merge($top_oddsset0,$top_oddsset1);
// var_dump($top_oddsset1);exit;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<link href="../css/admincg.css" rel="stylesheet" type="text/css" />
<title></title><script type="text/javascript">var IMGDIR = './images/';var attackevasive = '0';</script>
<script src="../js/common.js" type="text/javascript"></script>
<script src="../js/menu.js" type="text/javascript"></script>
<script src="../js/ajax.js" type="text/javascript"></script>
<script src="../js/frank.js" type="text/javascript"></script>
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
window.open(url,"Detail376878604","Scrollbars=no,Toolbar=no,Location=no,Direction=no,Resizeable=no, Width="+iWidth+" ,Height="+iHeight+",top="+iTop+",left="+iLeft); 
}

//--> 
</script>
	<style media=print> .Noprint{display:none;} </style> <table class="Noprint" width="100%"  border="0" cellpadding="0" cellspacing="0" ><tr><td><table width="100%" border="0" cellpadding="0" cellspacing="0" class="guide"><tr><td ><table width="100%" style="border:none;" border="0" cellpadding="0" cellspacing="0" ><tr  style="border:none;"><td style="border:none;" width=15%><a href="#" onClick=" parent.main.location='?action=home';return false;">位置</a>&nbsp;&raquo;&nbsp;基本资料</td>
		<td width=85% style="border:none;text-align:right;padding-right:10px;"><a href="index.php?action=childuseradmin" target="main" ><b>子账号</b></a> | <a href="index.php?action=membersinfoadmin" target="main" class=meuntop><b>基本资料</b></a> | <a href="index.php?action=settings&action=editpass" target="main" ><b>修改密码</b></a></td></tr></table></td></tr></table></td></tr></table><br /><table width="100%" border="0" cellpadding="0" cellspacing="0" class="tableborder"><tr class="header"><td><div style="float:left; margin-left:0px; padding-top:8px"><a href="###" onclick="collapse_change('tip')">信息提示</a></div><div style="float:right; margin-right:4px; padding-bottom:9px"><a href="###" onclick="collapse_change('tip')"><img id="menuimg_tip" src="../picture/menu_reduce.gif" border="0"/></a></div></td></tr><tbody id="menu_tip" style="display:"><tr><td><ul><li>总信用额度：<?php echo $user_one['credit_total'];?>；&nbsp;&nbsp;&nbsp;&nbsp;可分配信用额度：<?php echo $user_one['credit_remainder'];?>；&nbsp;&nbsp;&nbsp;&nbsp;已分配信用额度：<?php echo $user_one['credit_total']-$user_one['credit_remainder'];?>；</li></ul></td></tr></tbody></table><br />
<form method="post" name="datamembers" action="membersinfoadmin.php">
<input type="hidden" name="formhash" value="1c8b6462">

<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tableborder">
<tr class="header"><td colspan="4">新增</td></tr>

<tr>
<td class="altbg1">账　　号:</td>
<td align="right" class="altbg2"><input type="text" name="user_name" value="<?php echo $user_one['user_name'];?>" disabled></td>
<td class="altbg1">Email:</td>
<td align="right" class="altbg2"><input type="text" name="newemail" value="" disabled></td>
</tr>
<tr>
<td class="altbg1">代　　号:</td>
<td align="right" class="altbg2"><input type="text" name="nickname" value="<?php echo $user_one['user_nick'];?>" disabled></td>
<td class="altbg1">联系电话:</td>
<td align="right" class="altbg2"><input type="text" name="phone" value="0" disabled></td>
</tr>
<tr>
<td class="altbg1">占成上限:</td>
<td align="right"  class="altbg2"><input type="text" name="occupy" value="0" disabled></td>
<!--<td class="altbg1">手机电话:</td>
<td align="right" class="altbg2"><input type="text" name="handset" value="0" disabled></td>-->
<!--<td class="altbg1">下级人数上限:</td>
<td align="right" class="altbg2"><input type="text" name="manlimit" value="0" disabled>已分配人数：0</td>
-->


<td class="altbg1">信用额度:</td>
<td align="right" class="altbg2" colspan="3"><input type="text" name="credits" value="<?php echo $user_one['credit_remainder'];?>" disabled>
<input class="button" disabled=true style='color:#c0c0c0' type="button" onclick="javascript:if(window.confirm('确实要对下级信用额度归零吗?')){location.href='index.php?action=membersguiling';}else return;return false;" name="guilingsubmit" value="下级归零"></td>
</tr>

<!--<tr>
<td class="altbg1">占成间距:</td>
<td align="right" class="altbg2" colspan="3"><input type="text" name="occupyjj" value="" ></td>
</tr>-->
</table><br /><center>
<input type="hidden" name="addsubmit" >
<input class="button"   type="button" onclick="javascript:if(window.confirm('如果庄家先吃满，则不以所设成数来分配，以实际分配到拦货中金额为准，你同意吗?')){ datamembers.addsubmit.value='addsubmit';datamembers.submit();}else return; " name="addsubmit2" value="提 交">
</center>
<br />
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tableborder">
<tr align="center" class="header">
<td width="10"></td>
<td width="*">类别</td>
<td width="12%">最小下注</td>
<td width="12%">拦货金额</td>
<td width="12%">赔率上限</td>
<td width="12%">单注上限</td>
<td width="12%">单项上限</td>
<!--<td width="12%">交易回水</td>
<td width="12%">赔率</td>-->

</tr>
<?php foreach ($top_oddsset as $k => $v){?>
<?php if ($v['o_topid']=='0'){?>
<?php if($v['o_typename']=='四字定'){?>
			<?php 
				if ($power=='gd_tui') {
					$v['o_odd_limit']=$v['o_odd_limit']-$v['fg_tui']*10000;
				}
				if ($power=='zd_tui') {
					$v['o_odd_limit']=$v['o_odd_limit']-$v['fg_tui']*10000-$v['gd_tui']*10000;
				}
				if ($power=='d_tui') {
					$v['o_odd_limit']=$v['o_odd_limit']-$v['fg_tui']*10000-$v['gd_tui']*10000-$v['zd_tui']*10000;
				}
				if ($power=='h_tui') {
					$v['o_odd_limit']=$v['o_odd_limit']-$v['fg_tui']*10000-$v['gd_tui']*10000-$v['zd_tui']*10000-$v['d_tui']*10000;
				}

			?>
<?php }?>
<tr class="hover">
<td class="altbg2"><div style=" margin-right:4px; padding-bottom:9px"><img id="menuimg_showfix_<?php echo $v['o_id'];?>" src="../picture/menu_add.gif" border="0"/></td>
<td class="altbg1" ><a href="javascript:collapse_change('showfix_<?php echo $v['o_id'];?>');"><?php echo $v['o_typename'];?></a></td>
<td class="altbg2" ><span style='<?php if ($v['o_typename']=='二字定' || $v['o_typename']=='三字定'){?>display:none<?php }?>' ><?php echo $v['o_list_order'];?></span></td>
<td class="altbg1"><input type="text"  style='<?php if ($v['o_typename']=='二字定' || $v['o_typename']=='三字定'){?>display:none<?php }?>'  name="fixstr[<?php echo $v['o_id'];?>][o_ccupy_money]" value="<?php echo $v['o_ccupy_money'];?>"></td>
<td class="altbg2"><span  style='<?php if ($v['o_typename']=='二字定' || $v['o_typename']=='三字定'){?>display:none<?php }?>' ><?php echo $v['o_odd_limit'];?></span></td>
<td class="altbg1"><span  style='<?php if ($v['o_typename']=='二字定' || $v['o_typename']=='三字定'){?>display:none<?php }?>' ><?php echo $v['o_dzlimit'];?></span></td>
<td class="altbg2"><span  style='<?php if ($v['o_typename']=='二字定' || $v['o_typename']=='三字定'){?>display:none<?php }?>' ><?php echo $v['o_dxlimit'];?></span></td>
</tr>
	<?php if ($v['o_typename']=='二字定' || $v['o_typename']=='三字定'){?>
	<tr  id="menu_showfix_<?php echo $v['o_id'];?>" ><td class="altbg2" colspan=9>
	<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tableborder">
	<?php foreach ($top_oddsset as $key => $value){?>
	<?php if ($value['o_topid']==$v['o_typename']){?>
	<?php 
				if ($v['o_typename']=='二字定') {
					if ($power=='gd_tui') {
						$value['o_odd_limit']=$value['o_odd_limit']-$value['fg_tui']*100;
					}
					if ($power=='zd_tui') {
						$value['o_odd_limit']=$value['o_odd_limit']-$value['fg_tui']*100-$value['gd_tui']*100;
					}
					if ($power=='d_tui') {
						$value['o_odd_limit']=$value['o_odd_limit']-$value['fg_tui']*100-$value['gd_tui']*100-$value['zd_tui']*100;
					}
					if ($power=='h_tui') {
						$value['o_odd_limit']=$value['o_odd_limit']-$value['fg_tui']*100-$value['gd_tui']*100-$value['zd_tui']*100-$value['d_tui']*100;
					}
				}
				if ($v['o_typename']=='三字定') {
					if ($power=='gd_tui') {
						$value['o_odd_limit']=$value['o_odd_limit']-$value['fg_tui']*1000;
					}
					if ($power=='zd_tui') {
						$value['o_odd_limit']=$value['o_odd_limit']-$value['fg_tui']*1000-$value['gd_tui']*1000;
					}
					if ($power=='d_tui') {
						$value['o_odd_limit']=$value['o_odd_limit']-$value['fg_tui']*1000-$value['gd_tui']*1000-$value['zd_tui']*1000;
					}
					if ($power=='h_tui') {
						$value['o_odd_limit']=$value['o_odd_limit']-$value['fg_tui']*1000-$value['gd_tui']*1000-$value['zd_tui']*1000-$value['d_tui']*1000;
					}
				}
			?>
	<tr class="hover">
		<td class="altbg2" width="13"></td>
		<td class="altbg1" width="*"><?php echo $value['o_typename'];?></td>
		<td class="altbg2" width="12%"><?php echo $value['o_list_order'];?></td>
		<td class="altbg2" width="12%"><input type="text" name="fixstr[<?php echo $value['o_id'];?>][o_ccupy_money]" value="<?php echo $value['o_ccupy_money'];?>"></td>	
		<td class="altbg2" width="12%"><?php echo $value['o_odd_limit'];?></td>
		<td class="altbg1" width="12%"><?php echo $value['o_dzlimit'];?></td>
		<td class="altbg2" width="12%"><?php echo $value['o_dxlimit'];?></td>
	</tr>
	<?php }?>
	<?php }?>
	</table></td>
	</tr>
	<?php }?>
	
<?php }?>
<?php }?>
	
	<br /></form>
</td></tr></table>
<br /><br /><div class="footer Noprint"><hr size="0" noshade color="BORDERCOLOR" width="80%">
<b></b> V2.0 &nbsp;&copy;  <b>
</b><span class="smalltxt"></span>
usetime:0.092881, 
mysqlquery:4
</div>

</body>
</html>

