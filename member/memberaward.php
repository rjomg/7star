<?php
include_once( "../global.php" );
$db = new plate( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
$db2 = new plate( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
$so = $_GET['so'];
if ( $so )
{
		$so = "and plate_num like '%{$so}%'";
}
$query = $db->select( "plate", "count(*) as c", "id>0 {$so} order by plate_num desc" );
$total = $db->fetch_array( $query );
$total = $total['c'];
pageft( $total, 20 );
if ( $firstcount < 0 )
{
		$firstcount = 0;
}
$query = $db->select( "plate", "*", "id>0 {$so} order by plate_num desc limit  {$firstcount}, {$displaypg}" );
if ( $_GET['plate_num'] )
{
		$db->output_excel( $_GET['plate_num'] );
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" type="text/css" id="css" href="./css/members.css">
<style>html{overflow-y:scroll;}.periodImg{margin:auto;}</style>

</head>
<body style="margin: 0px"  >


<table width="99%" border="0" cellpadding="0" cellspacing="0" align=center>
<tr>
<td style="padding:0px">
	 		<script src="js/common.js" type="text/javascript"></script>
	<table width="100%" border="0" cellpadding="0" cellspacing="0" class="soon_b" >
	<tr class="header_left_b"><td colspan="17">开奖号码</td></tr>
	<tr class="soon_head" > 
		<td width="*" >开奖时间</td>
		<td width="10%"  >期号</td> 
		<td width="10%" >仟</td>
		<td width="10%" >佰</td>
		<td width="10%" >拾</td>
		<td width="10%" >个</td>
		<td width="10%" >特别号(45位用)</td>
		
		<td width="10%" >球6</td>
		<td width="10%" >球7</td>
		

	</tr> 
<?php $i = 0; while ( $row = $db->fetch_array( $query ) ){?>
	
	<tr onMouseOver="hover1(this);" onMouseOut="hover2(this);"  align="center" class="smalltxt">
	<td class="altbg2"><?php if($row['true_time_lottery']==''){echo '---';}else{ echo $row['true_time_lottery'];}?></td>
	<td class="altbg2"><?php echo $row['plate_num'];?></td>
	<td class="altbg2"><div class='periodImg periodImg_<?php if($row['true_time_lottery']==''){echo '5';}else{ echo '1';}?>' ><?php if($row['true_time_lottery']==''){echo '--';}else{ echo $row['num_a'];}?></div></td>
	<td class="altbg1"><div class='periodImg periodImg_<?php if($row['true_time_lottery']==''){echo '5';}else{ echo '1';}?>' ><?php if($row['true_time_lottery']==''){echo '--';}else{ echo $row['num_b'];}?></div></td>
	<td class="altbg1"><div class='periodImg periodImg_<?php if($row['true_time_lottery']==''){echo '5';}else{ echo '1';}?>' ><?php if($row['true_time_lottery']==''){echo '--';}else{ echo $row['num_c'];}?></div></td>
	<td class="altbg1"><div class='periodImg periodImg_<?php if($row['true_time_lottery']==''){echo '5';}else{ echo '1';}?>' ><?php if($row['true_time_lottery']==''){echo '--';}else{ echo $row['num_d'];}?></div></td>
	<td class="altbg1"><div class='periodImg periodImg_0' ><?php if($row['true_time_lottery']==''){echo '--';}else{ echo $row['num_e'];}?></div></td>
	<td class="altbg1"><div class='periodImg periodImg_0' ><?php if($row['true_time_lottery']==''){echo '--';}else{ echo $row['num_f'];}?></div></td>
	<td class="altbg1"><div class='periodImg periodImg_0' ><?php if($row['true_time_lottery']==''){echo '--';}else{ echo $row['num_g'];}?></div></td>
	</tr>
<?php }?>


	</table><BR>
	<table>
		<tr><td><?php echo $pagenav;?></td></tr>
	</table>
	</td>
<tr>
</table>

<!-- 
	<table width="98%" align="center" border="0" cellpadding="0" cellspacing="0" >
	<tr >
	<td align="center" style="text-align:center">
ç‰ˆæƒæ‰€æœ?Copyright@2009-2010 usetime:0.016609 
mysqlquery:2 
</td>
<tr>
</table> -->
</body>
</html>