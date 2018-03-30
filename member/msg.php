<?php
header("Content-Type:text/html;charset=gbk");
include_once ('../global.php');
$db = new rate($mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset); //数据库操作类.
$uid = $_GET['uid'];

	
	$sqls = "select * from `web_new` where `newid`='".$uid."'";
	$uid_result = mysql_query( $sqls );
	$uid_row = mysql_fetch_array( $uid_result );
	if(!empty($uid_row)){
		mysql_query("delete  from `web_new` where `id`='".$uid_row['id']."'");
		echo "<script language='javascript'>usermessage('".$uid_row['news']."');</script>";
		
		
	}


?>
