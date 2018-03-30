<?php
include_once ('../global.php');
$db = new action($mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset); //数据库操作类.
$uid = $_SESSION['uid'.$c_p_seesion];
if($uid){
$info = mysql_fetch_array(mysql_query("select * from users  where user_id = '$uid'"));
}
 function set($name,$uid){
	   $sql ="select * from back_set where set_name = '$name' and user_id = '$uid'";
	 
	 $bs = mysql_query($sql);	
	 
	 while($bs_info=mysql_fetch_array($bs)){
		 	$bs_detail[] = array(
			"bottom_limit" => $bs_info['bottom_limit'],
			"top_limit" => $bs_info['top_limit'],
			"odd_limit" => $bs_info['odd_limit']
			);
		 }
	 return $bs_detail;
	 }
	 	
$username = $_SESSION['username'.$c_p_seesion];		 
		 

?>
<html oncontextmenu="return false" xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk">
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
-->
</style>
</head>
<body oncontextmenu="return false" onselect="document.selection.empty()" oncopy="document.selection.empty()" onmouseover="self.status='歡迎光臨';return true">
<link rel="stylesheet" href="images/Index.css" type="text/css">
 
<style type="text/css">
<!--
.style1 {
	color: #666666;
	font-weight: bold;
}
.style2 {color: #FF0000}
.STYLE4 {
	color: #000000;
	font-weight: bold;
}
-->
</style>

  <table border="0" cellpadding="0" cellspacing="0" width="100%">
  <tbody><tr>
    <td height="3"></td>
  </tr>
</tbody></table><table class="Ball_List Tab"  border="0" cellpadding="0" cellspacing="1" width="740">

   <tbody><tr class="td_caption_1">
     <td colspan="2" bordercolor="#CCCCCC" align="center" bgcolor="#DFEFFF" height="22"><span class="STYLE4">信用資料</span></td>
    </tr>
   <tr>
    <td bordercolor="#CCCCCC" align="right" bgcolor="#DFEFFF" height="30" width="17%">會員賬號：</td>
    <td bordercolor="#CCCCCC" bgcolor="#FFFFFF" width="83%">
      <?php echo $username?>(
       <?php echo trim($info['else_plate'], ',');?>   盤   )</td>
    </tr>
  <tr>
    <td bordercolor="#CCCCCC" align="right" bgcolor="#DFEFFF" height="30">總信用額：</td>
    <td bordercolor="#CCCCCC" bgcolor="#FFFFFF"><?php echo $info['credit_total'];?>    </td>
    </tr>
  <tr>
    <td bordercolor="#CCCCCC" align="right" bgcolor="#DFEFFF" height="30">下注余額：</td>
    <td bordercolor="#CCCCCC" bgcolor="#FFFFFF">
      <?php echo $info['credit_remainder'];?>  </td>
    </tr>
  
</tbody></table>
 
<table class="Ball_List Tab" border="0" bordercolor="f1f1f1" cellpadding="0" cellspacing="1" width="740">
  <tbody><tr class="td_caption_1">
    <td align="center" bgcolor="#DFEFFF" width="90">交易類型</td>
    <?php 
    $managerarr = explode(',', $info['else_plate']);   
    ?>  <?php 
        if(in_array('A',$managerarr)){?>
        <td align="center" bgcolor="#DFEFFF">A盤</td>
        <?php }
        if(in_array('B',$managerarr)){
        ?>
        <td align="center" bgcolor="#DFEFFF">B盤</td>
        <?php }
        if(in_array('C',$managerarr)){
        ?>
        <td align="center" bgcolor="#DFEFFF">C盤</td>
        <?php }
        if(in_array('D',$managerarr)){
        ?>
        <td align="center" bgcolor="#DFEFFF">D盤</td>
        <?php }?>
        <td align="center" bgcolor="#DFEFFF">最低限額</td> 
        <td align="center" bgcolor="#DFEFFF">最高限額</td>
        <td align="center" bgcolor="#DFEFFF">单項(號)限額</td>
  </tr>
 <?php 
  $sql ="select * from back_set where  user_id = '$uid' order by view_order asc";
	 
	 $bs = mysql_query($sql);	
	 
	 while($bs_info=mysql_fetch_array($bs)){
 ?>
    <tr>
    <td align="center" bgcolor="#DFEFFF" height="20"><?php echo $bs_info['set_name']?></td>
        <?php 
        if(in_array('A',$managerarr)){?>
        <td align="center" bgcolor="#ffffff"><?php echo $bs_info['percent_a']?></td>
        <?php }
        if(in_array('B',$managerarr)){
        ?>
        <td align="center" bgcolor="#ffffff"><?php echo $bs_info['percent_b']?></td>
        <?php }
        if(in_array('C',$managerarr)){
        ?>
        <td align="center" bgcolor="#ffffff"><?php echo $bs_info['percent_c']?></td>
        <?php }
        if(in_array('D',$managerarr)){
        ?>
        <td align="center" bgcolor="#ffffff"><?php echo $bs_info['percent_d']?></td>
        <?php } ?>
        <td align="center" bgcolor="#ffffff"><?php echo $bs_info['bottom_limit']?></td> 
        <td align="center" bgcolor="#ffffff"><?php echo $bs_info['top_limit']?></td>
        <td align="center" bgcolor="#ffffff"><?php echo $bs_info['odd_limit']?></td>
  </tr>
<?php  }?>      
  </tbody></table>
  <table border="0" cellpadding="0" cellspacing="0" width="200">
    <tbody><tr>
      <td>&nbsp;</td>
    </tr>
  </tbody></table>
  
</body></html>