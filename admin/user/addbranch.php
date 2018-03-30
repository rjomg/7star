<?php
include_once( "../../global.php" );
$power = $_GET['power'];
if ( !$power )
{
		$power = $_SESSION["user_power".$c_p_seesion] + 1;
}
$db = new action( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
$user_char = $db->get_user_power_char( $power );
if ( $power == 2 )
{
	$rdo=$db->get_one('select credit_remainder from users where user_power=1');
	$rd=$rdo['credit_remainder'];
}
$is_directly = $_GET['is_directly'];
if ( $is_directly == 1 )
{
		$top_id = $_GET['top_uid'];
		// $top_name = $_GET['top_name'];
		// $top_power = $_GET['top_power'];
		// $power2 = $_GET['power2'];
		$remainder = $db->select( "users", "user_power,credit_remainder,else_plate,percent_company,percent_branch,percent_partner,percent_all_proxy,else_plate", "user_id={$top_id}" );
		$rdo = $db->fetch_array( $remainder );
		$this_else_plate = explode( ",", $rd['else_plate'] );
		$rd = $rdo['credit_remainder'];
		$rdo_power = $rdo['user_power'];
		$percent_char = $db->get_key_power_char( $rdo_power );
		$this_else_plate = explode( ",", $rdo['else_plate'] );
}
// echo $rd;exit;
if ( $power == 2 )
{
		$this_else_plate = array( "A", "B", "C", "D" );
		$percent_char = $db->get_key_power_char( 2 );
		$rdo[$percent_char] = 100;
}
$user_total = $db->kekaihuiyuanshu( $power );


$db3 = new mysql( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
if ($_GET['top_uid']) {
	$top_uid=$_GET['top_uid'];
}else{
	$top_uid=$_SESSION["uid".$c_p_seesion];
}
$user_one=$db3->get_one('select * from users where user_id='.$top_uid);
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
		$('menuimg_' + menucount).src = './images//admincg/menu_reduce.gif';
		
	} else {

		$('menu_' + menucount).style.display = 'none';collapsed += '[' + menucount + ']';
		$('menuimg_' + menucount).src = './images//admincg/menu_add.gif';
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
window.open(url,"Detail1763612","Scrollbars=no,Toolbar=no,Location=no,Direction=no,Resizeable=no, Width="+iWidth+" ,Height="+iHeight+",top="+iTop+",left="+iLeft); 
}

//--> 
</script>
	<style media=print> .Noprint{display:none;} </style> <table class="Noprint" width="100%"  border="0" cellpadding="0" cellspacing="0" ><tr><td><table width="100%" border="0" cellpadding="0" cellspacing="0" class="guide"><tr><td ><table width="100%" style="border:none;" border="0" cellpadding="0" cellspacing="0" ><tr  style="border:none;"><td style="border:none;" width=15%><a href="#" onClick=" parent.main.location='?action=home';return false;">位置</a>&nbsp;&raquo;&nbsp;新增</td>
		<td width=85% style="border:none;text-align:right;padding-right:10px;"><a href="addbranch.php?power=<?php echo $_GET['power']?>&top_uid=<?php echo $_GET['top_uid'];?>" target="main" ><b>新增下级</b></a> | <a href="branch.php?power=<?php echo $_GET['power'];?>" target="main" ><b>账户列表</b></a></td></tr></table></td></tr></table></td></tr></table><br /><table width="100%" border="0" cellpadding="0" cellspacing="0" class="tableborder"><tr class="header"><td><div style="float:left; margin-left:0px; padding-top:8px"><a href="###" onclick="collapse_change('tip')">信息提示</a></div><div style="float:right; margin-right:4px; padding-bottom:9px"><a href="###" onclick="collapse_change('tip')"><img id="menuimg_tip" src="picture/menu_reduce.gif" border="0"/></a></div></td></tr><tbody id="menu_tip" style="display:"><tr><td><ul><li>总信用额度：<?php echo $user_one['credit_total'];?>；&nbsp;&nbsp;&nbsp;&nbsp;可分配信用额度：<?php echo $user_one['credit_remainder'];?>；&nbsp;&nbsp;&nbsp;&nbsp;已分配信用额度：<?php echo $user_one['credit_total']-$user_one['credit_remainder'];?>；</li></ul></td></tr></tbody></table><br />
<form method="post" action="add_user.php">
<input type="hidden" name="top" value="<?php echo $user_one['user_id'].",".$user_one['user_name'].",".$user_one['user_power'].",".$user_one['credit_remainder'];?>">
<input type="hidden" name="type1" value="<?php echo $_GET['power']?>">
<input name="id" id="id" value="XGE!888" type="hidden">
<input id="kyx" name="kyx" class="input1" readonly="" value="<?php echo $rd;?>" type="hidden">
<input name="else_plate[]" value="A" checked="checked" type="hidden">
<input name="credit_total" class="input1" id="cs" value="0" type="hidden">
<input name="fc1" id="fc1" value="0" type="hidden">
<input name="fc2" id="fc2" value="100" type="hidden">
<input name="c1" id="c1" value="0" type="hidden">
<input name="c2" id="c2" value="0" type="hidden">
<input name="sff" id="sff" value="100" type="hidden">
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tableborder">
<tr class="header"><td colspan="2">新增<?php 
											if($power=='2'){echo '分公司';}

											if($power=='3'){echo '股东';}

											if($power=='4'){echo '总代理';}

											if($power=='5'){echo '代理';}

											if($power=='6'){echo '会员';}
										?></td></tr>


<tr><td class="altbg1">账　　号:</td>
<td align="right" class="altbg2"><input type="text" name="user_name" maxlength="6"></td></tr>
<tr><td class="altbg1">密　　码:</td>
<td align="right" class="altbg2"><input type="password" name="user_pwd"><font style="font-size:18px;font-weight: bold;" color="red">密码不能跟账号相同，必须是数字和字母组合，至少6位以上。 </font>
</td></tr>

<tr>
	<td align="right" class="altbg2" colspan="2"><font style="font-size:14px;font-weight: bold;" color="#0000FF">系统禁止不可用密码:
	a12345，ab1234，abc123，a1b2c3，aaa111，123qwe</font></td></tr>
</table><br />
<center><input class="button" type="submit" name="Submit" value="提 交"></center>
</form>
</td></tr></table>
<br /><br /><div class="footer Noprint"><hr size="0" noshade color="BORDERCOLOR" width="80%">
<b></b> V2.0 &nbsp;&copy;  <b>
</b><span class="smalltxt"></span>
usetime:0.021353, 
mysqlquery:2
</div>

</body>
</html>

