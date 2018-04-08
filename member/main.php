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

<link rel="stylesheet" href="./css/jquery.alerts.css" />
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

<style type="text/css">
	#popup_container {
		position: fixed;
		z-index: 99999;
		padding: 0px;
		margin: 0px;
		min-width: 660px;
		max-width: 660px;
		top: 117px;
		left: 594px;
		background:#FFF;
		border:5px solid #8e779b;
		border-radius:5px;
		display:none;
	}

	#popup_container img {
		width:100%;
	}
	#popup_close {
		float: right;
		padding: 10px;
		vertical-align: middle;
		text-align: center;
		cursor: pointer;
		clear: both;
		font-size:1.3em;
		margin:0;
	}
	#popup_title {
		font-size: 14px;
		font-weight: bold;
		text-align: center;
		line-height: 2.75em;
		color: #666;
		background: #ac99b6;
		border: solid 1px #FFF;
		border-bottom: solid 1px #8e779b;
		cursor: default;
		padding: 0em;
		margin: 0em;
	}
	#popup_content {
		background: 16px 16px no-repeat url(./images/showinfo.gif);
		padding: 2em 1.75em;
		margin: 0em;
	}
	.alertsPrint1 {
		outline: 1px solid #660000;
		border: 0px !important;
		border: 1px solid #660000;
		empty-cells: show;
		border-collapse: separate !important;
		border-collapse: collapse;
	}
	#popup_container_print {
		display: block;
		overflow: auto;
		overflow: scroll;
		overflow-x: auto;
		_overflow-y: auto;
		_height: 100%;
		height: 500px;
	}
	#popup_panel {
		text-align: center;
		margin: 1em 0em 0em 1em;
		padding: 4px 0px 8px 0px;
		height: 50px;
	}
	#popup_content.ProgressBar, #popup_container.alertPrint #popup_content{
		background-image:none!important;
	}
	#leftBottomBox{
		width:260px;
		height:190px;
		background: url(/images/wx.png);
		position: fixed;
		z-index: 9999;
		right: 20px;
		bottom:-190px;
	}
	#boxContent{
		width:230px;
		margin:10px auto;
		font-size:14px;
	}
	#boxHead{
		margin-top:6px;
	}

	#boxHead a {
		float:right;
		margin-right:6px;
	}
</style>

<div id="popup_container">
	<div id="popup_container_print">
		<h1 id="popup_close">X</h1>
		<h1 id="popup_title">设置图示</h1>
		<div id="popup_content">
		<div id="popup_message">
		<table class="alertsPrint1 appnews" width="100%" align="center">
			<tbody>
				<tr>
					<td>
						<br>IE7 打印设置图示说明
					</td>
				</tr>
				<tr>
					<td>
						<br>步骤1、（如果您的浏览器已经设置菜单栏，直接从步骤2开始设置
						<br><br><img src="./images/ie7_1.gif">
						<br><br>步骤2、<br><br><img src="./images/ie7_2.gif">
						<br><br>步骤3、<br><br><img src="./images/ie7_3.gif">
						<br><br>步骤4、<br><br><img src="./images/ie7_4.gif">
					</td>
				</tr>
				<tr>
					<td>
						<br><br>IE11 打印设置图示说明
					</td>
				</tr>
				<tr>
					<td>
						<br>步骤1、<br><br><img src="./images/ie11_1.gif">
						<br><br>步骤2、<br><br><img src="./images/ie11_2.gif">
						<br><br>步骤3、<br><br><img src="./images/ie11_3.gif">
						<br><br>步骤5、<br><br><img src="./images/ie11_5.gif">
						<br><br>步骤4、<br><br><img src="./images/ie11_4.gif">
						<br><br>步骤6、<br><br><img src="./images/ie11_6.gif">
					</td>
				</tr>
				<tr>
					<td>
						<br>360下切换兼容模式
					</td>
				</tr>
				<tr>
					<td>
						<br>步骤、打开360浏览器，点击切换模式按钮，选中兼容模式，如图。<br><br><img src="./images/360moshi.jpg"><br>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
	<div id="popup_panel">
		<input class="btn" style="*width:80px" type="button" value="&nbsp;&nbsp;打印&nbsp;&nbsp;" id="popup_ok">
		<input class="btn" type="button" value="&nbsp;&nbsp;取消&nbsp;&nbsp;" id="popup_cancel">
	</div>
	</div>
	</div>
	
</div>

<div id="leftBottomBox">
	<div id="boxHead">
		<a href="javascript:void(0)" id="closeBtn">
			<img src="/images/close.gif" alt="" />
		</a>
		<a href="javascript:void(0)" id="maxormin">
			<img src="/images/min.gif" alt="" />
		</a>
		<div style="clear:both;"></div>
	</div>
	<div id="boxContent">好消息，奖虫APP有（打字聊天）功能了。安卓手机--下载奖虫
		（网址：jiangcho.com）--设置（会员或管理）网址，账号和密码--
		可以和上下级打字聊天。
	</div>
</div>


<script language="JavaScript">var window_img='./admincg/images/';</script>
<script type="text/javascript">
function pDirection(){
	var isShow = document.getElementById("popup_container").style.display;
	if (isShow == 'block') {
		document.getElementById("popup_container").style.display = "none";
	} else {
		document.getElementById("popup_container").style.display = "block";
	}
}

window.onload = function(){
	document.getElementById("popup_close").onclick = function(){
		document.getElementById("popup_container").style.display = "none";
	}

	var positionY = window.getComputedStyle(document.getElementById("leftBottomBox")).bottom;
	positionY = positionY.substr(0,positionY.length-2);
	var time = setInterval(function(){
		positionY ++;
		document.getElementById("leftBottomBox").style.bottom = positionY +"px";
		if (positionY == 0) {
			clearInterval(time);
		}
	},10);

	document.getElementById("maxormin").onclick = function(){
		var imgsrc = document.getElementById("maxormin").childNodes[1].getAttribute("src");
		if (imgsrc == '/images/min.gif') {
			document.getElementById("maxormin").childNodes[1].setAttribute("src",'/images/max.gif')
			if (positionY != -165) {
				var time = setInterval(function(){
					positionY --;
					document.getElementById("leftBottomBox").style.bottom = positionY +"px";
					if (positionY == -165) {
						clearInterval(time);
					}
				},10);
			}
		} else {
			document.getElementById("maxormin").childNodes[1].setAttribute("src",'/images/min.gif')
			var time = setInterval(function(){
				positionY ++;
				document.getElementById("leftBottomBox").style.bottom = positionY +"px";
				if (positionY == 0) {
					clearInterval(time);
				}
			},10);
		}
	};
	document.getElementById("closeBtn").onclick = function(){
		document.getElementById("leftBottomBox").remove();
	}
		
}


</script>

<script src="./js/appcg.js" type="text/javascript"></script>
<!-- <script src="./js/show_window.js" type="text/javascript"></script> -->
<noscript>&lt;iframe src=*.html&gt;&lt;/iframe&gt;</noscript>
</body></html>