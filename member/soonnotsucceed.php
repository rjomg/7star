<?php 
	include_once( "../global.php" );
	$db = new action( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
	$plate_num=$db->get_all('select plate_num from plate order by plate_num DESC limit 0,3');
	// var_dump($plate_num);exit;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" type="text/css" id="css" href="./css/members.css">
<style>html{overflow-y:scroll;}</style>
</head>
<body style="margin: 0px;"  >
<table width="99%" border="0" cellpadding="0" cellspacing="0" align=center>
<tr>
<td style="padding:0px">
		<script src="./js/common.js" type="text/javascript"></script>
	<script type="text/javascript">
	<!--
	function delstat(t,f,d,s){
		f.submit_del.value=d;
		f.submit_delstat.value=s;
		t.disabled=true;
		f.target='soonsend_ifr2';
		f.action='index.php?action=soonnotsucceed&sid=bgDlMc';
		if(!f["idarray[]"]){
			var checkboxs = document.getElementsByName('idarray[]'); 
			var comm='';
			for(var i=0;i<checkboxs.length;i++){
				if(checkboxs[i].checked){
					f.idarraystr.value += comm+checkboxs[i].value;
					comm=',';
				}
			}
		}
		f.submit();
		return false;
	}
	function check_all(obj,cName) { 
		var checkboxs = document.getElementsByName(cName); 
		for(var i=0;i<checkboxs.length;i++){checkboxs[i].checked = obj.checked;} 
	} 
	//-->
	</script>
	<script src="./js/showorderhtml.js" type="text/javascript"></script>
	<iframe id="soonsend_ifr2" name="soonsend_ifr2" width="0" height="0" style="display:none"></iframe>
	<table width="100%" border="0" cellpadding="0" cellspacing="0" class="soon_b">
	<form method="POST" name="datamembers" id="datamembers" target="soonsend_ifr2" action="index.php?action=soonnotsucceed&sid=bgDlMc"  style="padding:0;margin:0">
	<input type="hidden" name="formhash" value="96df863f">
	<input type="hidden" name="delaction" value="yes">
	<input type="hidden" name="idarraystr" value="">
	<input type="hidden" name="dy_issueno" value="17011">
	<tr class="header_left_b">
	<td colspan="2" >目前停押号码</td>
	<td  ><select name="dy_issueno" id="dy_issueno" onchange="window.location.href='soonnotsucceed.php?sendmode=1&dy_issueno='+this.value+''">
	<?php foreach ($plate_num as $key => $value){?>
		<option <?php if($_GET['dy_issueno']==$value['plate_num']){ echo 'selected';}?> value="<?php echo $value['plate_num'];?>"><?php echo $value['plate_num'];?></option>
	<?php }?>
	</select></td>
	</tr>
	<tr class="soon_head"><td width="22%">号码</td><td width="25%">金额</td><td width="23%">全选<input type="checkbox" name="chkall" onclick="check_all(this,'idarray[]');" class="checkbox"></td><tr>
		<td colspan="4" style="height:280px;" valign=top>
		<div id="showissuenohtml">
			<table width="100%" style="border:none" border="0" cellpadding="0" cellspacing="0" class="soon_b_no" ><tr>
			<td class="soon_b_B " colspan=4 style="text-align:left;">&nbsp;&nbsp;笔数:0&nbsp;&nbsp;总金额:0</td>
			</tr>
						</table>
		</td><tr>

	</table>
	<table border="0" cellpadding="0" cellspacing="0"><tr><td height=6></td><tr></table>
	<center>
	<input type="hidden" name="submit_del" value=''>
	<input type="hidden" name="submit_delstat" value='' >


	<!--<input class="button" type="button" name="del_button" onclick="javascript:if(window.confirm('确实要删除所选中号码吗？')){delstat(this,datamembers,1,''); }else return; " value="删除">-->

	<input class="button" type="button" name="pirnt_button" onclick="javascript:window.open('indexno.php?action=soonnotsucceedprint&sid=bgDlMc');return false; " value="打印">
	<input class="button" type="button" name="delstat_button" id="delstat_button"  onclick="delstat(this,datamembers,'',1);" value="删除">
	</center></form>
	<table border="0" cellpadding="0" cellspacing="0" id="moren"><tr><td height=6></td><tr></table>
	<table width="100%" border="0" cellpadding="0" cellspacing="0" class="soon_b">
	<form method="POST" name="delform" id="delform" target="soonsend_ifr2" action="index.php?action=soonnotsucceed&sid=bgDlMc"  style="padding:0;margin:0">
	<input type="hidden" name="formhash" value="96df863f">
	<input type="hidden" name="delaction" value="yes">
	<input type="hidden" name="dy_issueno" value="17011">
	<tr class="header_left_b">
	<td colspan="4" >删除停押号码保留区</td>
	<tr>
	<tr class="soon_head"><td width="40%">号码</td><td width="60%">金额</td><tr>
		<td colspan="2" style="height:280px;" valign=top>

			<table width="100%" style="border:none" border="0" cellpadding="0" cellspacing="0" class="soon_b_no" ><tr>
			<td class="soon_b_B " colspan=4 style="text-align:left;">&nbsp;&nbsp;笔数:0&nbsp;&nbsp;总金额:0</td>
			</tr>
						</table>
		</td><tr>

	</table>
	<table border="0" cellpadding="0" cellspacing="0"><tr><td height=6></td><tr></table>
	<center>
	<input type="hidden" name="submit_del" >
	<input type="hidden" name="submit_delstat" >

	</center></form>
	

</td>
<tr>
</table>


</body>

</html>