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
window.open(url,"Detail510991152","Scrollbars=no,Toolbar=no,Location=no,Direction=no,Resizeable=no, Width="+iWidth+" ,Height="+iHeight+",top="+iTop+",left="+iLeft); 
}

//--> 
</script>
	<style media=print> .Noprint{display:none;} </style> <table class="Noprint" width="100%"  border="0" cellpadding="0" cellspacing="0" ><tr><td><table width="100%" border="0" cellpadding="0" cellspacing="0" class="guide"><tr><td ><table width="100%" style="border:none;" border="0" cellpadding="0" cellspacing="0" ><tr  style="border:none;"><td style="border:none;" width=15%><a href="#" onClick=" parent.main.location='?action=home';return false;">位置</a>&nbsp;&raquo;&nbsp;日分类帐</td>
		<td width=85% style="border:none;text-align:right;padding-right:10px;"><a href="index.php?action=reportgxd&s_issueno=0" target="main" ><b>贡献度</b></a> | <a href="index.php?action=reportclass" target="main" class=meuntop><b>日分类帐</b></a> | <a href="index.php?action=reportclass&joaction=month" target="main" ><b>月分类帐</b></a></td></tr></table></td></tr></table></td></tr></table><br />
<table border="0" cellpadding="0" cellspacing="0" class="tableborder" width="100%">
<form method="post" name="companyform" action="index.php?action=reportclass&joaction=&zizhanghao=">
<input type="hidden" name="formhash" value="a220d12d">		
<input type="hidden" name="s_ym" value="">	
<tr class="header"><td colspan="5">
分类帐&nbsp;&nbsp;期号17012

</td><td colspan=2>
<!--<select name="s_issueno" id="s_issueno" onchange=companyform.submit()>
<option value="17012" selected>17012</option><option value="17011" >17011</option><option value="17010" >17010</option><option value="17009" >17009</option><option value="17008" >17008</option><option value="17007" >17007</option><option value="17006" >17006</option><option value="17005" >17005</option><option value="17004" >17004</option><option value="17003" >17003</option><option value="17002" >17002</option></select>-->
</td>
</tr>
</form>

<tr class="reportTop">
	<td style="width:15%">公司</td>
	<td style="width:15%">类别</td>
	<td style="width:14%">笔数</td>
	<td style="width:14%">下注金额</td>
	<td style="width:14%">回水</td>
	<td style="width:14%">中奖</td>
	<td style="width:14%">盈亏</td>
</tr>
<tr><td colspan="7">还没有内容</td></tr>
</table>
	<br />
</td></tr></table>
<br /><br /><div class="footer Noprint"><hr size="0" noshade color="BORDERCOLOR" width="80%">
<b></b> V2.0 &nbsp;&copy;  <b>
</b><span class="smalltxt"></span>
usetime:0.331237, 
mysqlquery:5
</div>

</body>
</html>

