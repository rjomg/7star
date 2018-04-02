<?php
include_once('../global.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>会员</title>

<link rel="shortcut icon" href="" type="image/x-icon"> 
<script language="JavaScript">
	if(self!=top) window.open('index.php','_top');
	if(self.location.hostname!=top.location.hostname) top.location=self.location;
	var _OldOrderPrint = [];
	
</script>
<script src="./js/common.js" type="text/javascript"></script>
</head>
 <body style="margin: 0px" scroll="no">

<iframe id="logoutifr" name="logoutifr" width="0" height="0" style="display:none"></iframe>
<iframe id="soonsend_ifr" name="soonsend_ifr" width="0" height="0" style="display:none"></iframe>

<div style="position: absolute;top: 0px;left: 0px; z-index: 2;height: 95px;width: 100%">
	<iframe frameborder="0" id="header" name="header" src="./top.php" scrolling="no" style="height: 95px; visibility: inherit; width: 100%; z-index: 1;"></iframe>
</div>
<table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" style="table-layout: fixed;">
	<tbody>
		<tr>
			<td width="201" height="95"></td>
			<td></td>
		</tr>
		<tr>
			<td>
				<iframe frameborder="0" id="menu" name="menu" scrolling="yes" src="./left.php" style="height: 852px; visibility: inherit; width: 100%; z-index: 2; overflow: auto;" onload="loadIf(this,1);"></iframe>
			</td>
			<td>
				<iframe frameborder="0" id="main" name="main" scrolling="yes" src="./soonhitmain.php" style="height: 852px; visibility: inherit; width: 100%; z-index: 3; overflow: auto;" onload="loadIf(this,1);"></iframe>
			</td>
		</tr>
	</tbody>
</table>

<script language="JavaScript">var window_img='./admincg/images/';</script>
<!-- <script src="./js/show_window.js" type="text/javascript"></script> -->
<noscript>&lt;iframe src=*.html&gt;&lt;/iframe&gt;</noscript>
</body></html>