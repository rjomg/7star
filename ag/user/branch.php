<?php

include_once( "../../global.php" );

$power = $_GET['power'];

if ( !$power )

{

		$power = $_SESSION["user_power".$c_p_seesion] + 1;

}
if (!$_GET['top_uid']) {
	$_GET['top_uid']=$_SESSION['uid'.$c_p_seesion];
}
$get_user_limit = $_GET['get_user_limit'];

$t1 = $_GET['t1'];

$t2 = $_GET['t2'];

$youguan_id = $_GET['youguan_id'];

$db = new action( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );

$db2 = new action( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );

// echo $_GET['top_uid'];exit;

if ( 0 < $youguan_id )

{		

			$youguan_id2 = $db->loweralluser_arr( $youguan_id, $power );

			$youguantiaojian = " and user_id in({$youguan_id},{$youguan_id2})";

}

$user_limit = $db->get_user_limit_char( $get_user_limit, $t1, $t2 );

if ( $user_limit )

{

		$user_limit = " and ".$user_limit;

}

if (isset($_GET['top_uid']) && !empty($_GET['top_uid'])) {

	$uid=$_GET['top_uid'];

	$youguantiaojian = " and top_id = {$_GET['top_uid']}";

	$top_user=$db->get_one('select user_name from users where user_id='.$_GET['top_uid']);

}
if ($_GET['is_lock']=='2') {

		$youguantiaojian .=" and is_lock = 2";

}else{

		$youguantiaojian .=" and is_lock = 0 or is_lock = 3 and user_power={$power}";

}
if ($_GET['is_del']=='1') {
	$user_limit .=" and is_del = 1";
}else{
	$user_limit .=" and is_del = 0";
}
// echo $youguantiaojian;
$query = $db->select( "users", "count(*) as c", "is_extend=0 and user_power={$power} {$user_limit} {$youguantiaojian}" );

$total = $db->fetch_array( $query );

$total = $total['c'];

pageft( $total, 30 );

if ( $firstcount < 0 )

{

		$firstcount = 0;

}

$query = $db->select( "users", "*", "is_extend=0 and user_power={$power} {$user_limit} {$youguantiaojian} order by else_last_login desc,else_created_at desc limit {$firstcount}, {$displaypg}" );
$user_char = $db->get_user_power_char( $power );

$db3 = new mysql( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
if ($_GET['top_uid']) {
	$uid=$_GET['top_uid'];
}else{
	$uid=$_SESSION["uid".$c_p_seesion];
}
$user_one=$db3->get_one('select * from users where user_id='.$uid);
// var_dump($db->fetch_array($query));exit;
?>

<!Doctype>

<html><head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<link href="../css/admincg.css" rel="stylesheet" type="text/css" />

<title></title>

<script src="js/common.js" type="text/javascript"></script>

<script src="js/menu.js" type="text/javascript"></script>

<script src="js/ajax.js" type="text/javascript"></script>

<script src="js/frank.js" type="text/javascript"></script>

<script src="js/json2.js" type="text/javascript"></script>

<style media=print> .Noprint{display:none;}</style><script type="text/javascript">

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



function suocheck(o){

   if(o.s_UID.value=="" && o.s_username.value=="" && o.s_nickname.value==""){

		alert("请填写级别查询条件！");

		o.s_UID.focus();

		return false;

	}

	else{

		parent.main.location='leveladmin_plus.php?uid='+$('uid').value+'&account='+$('account').value+'&name='+$('name').value;

		return false;

	}

}



function companychange(){

	parent.main.location='leveladmin_plus.php?company='+$('formcomid').value;

	return false;

}



function simulate(agent){

	var string = "target="+agent;

	ajax('POST',"post_simulation.php",true,string,function(msg){

		msg=JSON.parse(msg);

		switch(msg.code){

			case 7000:

				alert("无模拟权限");

				break;

				

			default:

				alert("失败");

		}

	});

	return false;

}



</script>

<style>
	.header td{text-align:center;}
</style>
</head>
<body leftmargin="10" topmargin="10" >

	<div id="append_parent"></div>

	<table width="99%" align=center border="0" cellpadding="0" cellspacing="0">

		<tr>

			<td>

				<table width="100%" border="0" cellpadding="0" cellspacing="0" class="guide">

					<tr>

						<td>

							<table width="100%" style="border:none;" border="0" cellpadding="0" cellspacing="0">

								<tr style="border:none;">

									<td style="font-size:14px;font-family:Microsoft JhengHei;border:none;" width='40%'>

										<a href="#">位置</a>&nbsp;&raquo;&nbsp;
										<?php 
											if($power=='2'){echo '分公司';}

											if($power=='3'){echo '股东';}

											if($power=='4'){echo '总代理';}

											if($power=='5'){echo '代理';}

											if($power=='6'){echo '会员';}
										?>管理 ( <?php echo $top_user['user_name'];?> )

									</td>

									<td width='39%' style='font-size:14px;font-family:Microsoft JhengHei;border:none;'>

										<marquee scrolldelay=400 style='height:18px;font-weight:bold;'>您好，赔率变动设置，批量新增里，增加了（配数全转）功能，能一次解决目前套餐生成问题，请使用。如不明白，请咨询。</marquee>

									</td>

									<td width=46% style="font-size:14px;font-family:Microsoft JhengHei;border:none;text-align:right;padding-right:10px;">

										<a href="addbranch.php?power=<?php echo $_GET['power']?>&top_uid=<?php echo $_GET['top_uid'];?><?php if(!empty($_GET['top_uid'])){echo '&is_directly=1';}?>"><b>新增下级</b></a> | 

										<a href="branch.php?power=<?php echo $_GET['power'];?>"><b>账户列表</b></a>

									</td>

								</tr>

							</table>

						</td>

					</tr>

				</table><br/>

				<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tableborder">

					<tr class="header">

						<td>

							<div style="font-size:14px;font-family:Microsoft JhengHei;border:none;float:left; margin-left:0px; padding-top:8px">

								<a href="###" onclick="collapse_change('tip')">信息提示</a>

							</div>

							<div style="float:right; margin-right:4px; padding-bottom:9px">

								<a href="###" onclick="collapse_change('tip')">

									<img id="menuimg_tip" src="picture/menu_reduce.gif" border="0"/>

								</a>

							</div>

						</td>

					</tr>

					<tbody id="menu_tip" style="display:">

					<tr>

						<td style="font-family:Microsoft JhengHei;">

							<ul>

								<li>总信用额度：<?php echo $user_one['credit_total'];?>；&nbsp;&nbsp;&nbsp;&nbsp;可分配信用额度：<?php echo $user_one['credit_remainder'];?>；&nbsp;&nbsp;&nbsp;&nbsp;已分配信用额度：<?php echo $user_one['credit_total']-$user_one['credit_remainder'];?>；</li>

							</ul>

						</td>

					</tr></tbody>

				</table><br/>

				<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tableborder">

					<form name="datamembers" action="#" onsubmit="return suocheck(this);"> 

						<input type="hidden" name="formhash" value="dd9b4271">	

						<input type="hidden" name="comid" value="0">	

						<tr class="header">

							<td colspan="12" style="text-align:left;font-size:14px;font-family:Microsoft JhengHei;border:none;">级别查询</td>

						</tr>

						<tr>

							<td width=100 style="font-size:14px;font-family:Microsoft JhengHei;border:none;">UID：</td>

							<td width=120><INPUT TYPE="text" NAME="s_UID" id="uid" maxlength=10 value="" style="width:90px" onkeyup="this.value=this.value.replace(/[^0-9.]/g,'')"></td>

							<td width=100 style="font-size:14px;font-family:Microsoft JhengHei;border:none;">账　　号：</td>

							<td width=120 style="font-size:14px;font-family:Microsoft JhengHei;border:none;"><INPUT TYPE="text" NAME="s_username" id="account" maxlength=14 value="" style="width:90px"></td>

							<td width="80" style="font-size:14px;font-family:Microsoft JhengHei;border:none;">代　　号：</td>

							<td width="100" ><input type="text" class="txt" name="s_nickname" id="name" value="" ></td>

							<td width=* style="font-size:14px;font-family:Microsoft JhengHei;border:none;"><input class="button" type="submit" name="addsubmit" value="搜索级别"><a style="float:right;line-height:26px!important;" class="button" href="branch.php?power=<?php echo $_GET['power'];?>&top_uid=<?php echo $_GET['top_uid'];?><?php if($_GET['is_del']!=='1'){echo '&is_del=1';}?>"><?php if($_GET['is_del']=='1'){echo '返回列表';}else{echo '查看回收站';}?></a></td>

					</form>

						</tr>

					</table><BR>

					<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tableborder" style="table-layout: fixed">

						<form method="post" name="datamembers" action="index.php?action=leveladmin">

							<input type="hidden" name="formhash" value="dd9b4271">

							<input type="hidden" name="classid" value="">

							<input type="hidden" name="page" value="1">

							<input type="hidden" name="uid" value="0">

						<tr align="center" class="header">

<td width="30" style="font-size:14px;font-family:Microsoft JhengHei;border:none;">序号</td>

<td width="10%" style="font-size:14px;font-family:Microsoft JhengHei;border:none;">账　　号</td>

<td width="8%" style="font-size:14px;font-family:Microsoft JhengHei;border:none;">代　　号</td>

<td width="8%" style="font-size:14px;font-family:Microsoft JhengHei;border:none;">占成</td>

<td width="18%" style="font-size:14px;font-family:Microsoft JhengHei;border:none;">信用/现金 额度</td>

<td width="10%" style="font-size:14px;font-family:Microsoft JhengHei;border:none;">修改时间</td>

<td width="8%" style="font-size:14px;font-family:Microsoft JhengHei;border:none;">修改者</td>

<td width="9%" style="font-size:14px;font-family:Microsoft JhengHei;border:none;"><!--?php if(count($agentlist)>0)echo$level2name[$agentlist[0]['level']]?-->地区</td>

<!--td width="8%"><A HREF="index.php?action=leveladmin&doaction=memberadmin&g_levelid_parent_uid=199&g_levelid=0&s_start=0"><font color=red>查看停用</font></A></td-->

<?php if ($_GET['is_lock']!=='2'){?>

<td width="8%" style="font-size:14px;font-family:Microsoft JhengHei;border:none;"><A href="branch.php?is_lock=2&power=<?php echo $_GET['power'];?><?php if($_GET['top_uid']){ echo '&top_uid='.$_GET['top_uid'];}?>"><font color=red>查看停用</font></A></td>

<?php }else{?>

<td width="8%" style="font-size:14px;font-family:Microsoft JhengHei;border:none;"><A href="branch.php?is_lock=0&power=<?php echo $_GET['power'];?><?php if($_GET['top_uid']){ echo '&top_uid='.$_GET['top_uid'];}?>"><font color=red>查看启用</font></A></td>

<?php }?>

<td width="10%" colspan="2" style="font-size:14px;font-family:Microsoft JhengHei;border:none;text-align:center;">操作</td>

</tr>

<form method="post" name="datamembers" action="index.php?action=dissertaxis">

<input type="hidden" name="formhash" value="dd9b4271">

<?php $i=0; while ( $row = $db->fetch_array( $query ) ){?>

<tr title='会员(占):5/5' onMouseOver='hover1(this);' onMouseOut='hover2(this);' align='center' class='smalltxt hover'>

	<td class='altbg2' ><?php echo $i=$i+1;?></td>

	<td class='altbg1'><a title='' href="<?php if($power!=='6'){?>branch.php?power=<?php echo $power+1;?>&top_uid=<?php echo $row['user_id'];?><?php }?>"><?php echo $row['user_name'];?>(<?php if($row['user_power']=='2'){echo '分公司';}if($row['user_power']=='3'){echo '股东';}if($row['user_power']=='4'){echo '总代理';}if($row['user_power']=='5'){echo '代理';}if($row['user_power']=='6'){echo '会员';}?>)</a></td>

	<td class='altbg2'><?php echo $row['user_nick'];?><input type='hidden' name='myuid[]' value='<?php echo $row['user_id'];?>'></td>

	<td class='altbg1'><?php if($row['user_power']=='2'){echo '分公司';}if($row['user_power']=='3'){echo '股东';}if($row['user_power']=='4'){echo '总代理';}if($row['user_power']=='5'){echo '代理';}if($row['user_power']=='6'){echo '会员';}?>(占):<?php echo $row['percent_proxy'].'%';?></td>

	<td class='altbg2'><?php echo $row['credit_total']."/".$row['credit_remainder'];;?></td>

	<td class='altbg1'><?php echo $row['else_created_at'];?></td>

	<td class='altbg2'><?php echo $_SESSION["username".$c_p_seesion];?></td>

	<td class='altbg1'>广州</td>

	<td class='altbg2'><?php if($row['is_lock']==0){echo '启用';}else if($row['is_lock']==2){echo '<span style="color:red;">禁用</span>';}else{echo '<span style="color:red;">暂停下注</span>';}?></td>

	<td class='altbg1'><a href='leveladdedit.php?user_id=<?php echo $row['user_id'];?>&top_id=<?php echo $row['top_id'];?>&power=<?php echo $power;?>' title=''>修改</a></td>
	<?php if ($_GET['is_del']=='1'){?>
		<td class='altbg2'><a href="delete_user.php?power=<?php echo $power;?>&id=<?php echo $row['user_id'];?>&top_id=<?php echo $row['top_id'];?>" onclick="{if(confirm('您確定刪除嗎?此操作將不能恢復!')){ return true;}else{return   false;}};">彻底删除</a></td>
	<?php }else {?>
		<td class='altbg2'><a href="delete_user.php?power=<?php echo $power;?>&id=<?php echo $row['user_id'];?>&top_id=<?php echo $row['top_id'];?>&is_del=1" onclick="{if(confirm('您確定刪除嗎?此操作將不能恢復!')){ return true;}else{return   false;}};">删除</a></td>
	<?php }?>

</tr>

<?php }?>

<!--tr title='总监(占):2/10

大股东(占):8/10' onMouseOver="hover1(this);" onMouseOut="hover2(this);" align="center" class="smalltxt hover"><td class="altbg2" >53</td>

<td class="altbg1"><a href="index.php?action=leveladmin&doaction=memberadmin&g_levelid_parent_uid=297&g_levelid=2" title='编辑yu888'>yu888(大股东)</a></td>

<td class="altbg2">小雨<input type="hidden" name="myuid[]" value="297"></td>

<td class="altbg1">总监(占):2/10

大股东(占):8/10</td>

<td class="altbg2">2200000</td>

<td class="altbg1">02-01 01:08</td>

<td class="altbg2">ap777</td>

<td class="altbg1">223.198.*.*</td>

<td class="altbg2">启用</td>

<td class="altbg1"><a href="index.php?action=leveladdedit&doaction=memberadmin&g_levelid=2&uid=297" title='修改yu888'>修改</a></td>

<td class="altbg2"><a href="index.php?action=reportadmin&doaction=user&s_username=yu888&g_uid=297&g_levelid=2" title='查看yu888月报表'>月报表</a></td>

</tr-->

</table>

<br />

<center>

</center></form>

</td></tr></table>

<br /><br /><div class="footer Noprint"><hr size="0" noshade color="BORDERCOLOR" width="80%">

<b></b> V2.0 &nbsp;&copy;  <b>

</b><span class="smalltxt"></span>

usetime:0.078041, 

mysqlquery:30

</div>

<noscript><iframe src=*.html></iframe></noscript>



</body>

</html>

