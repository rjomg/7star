<?php

header( "Content-Type:text/html;charset=utf-8" );

date_default_timezone_set( "PRC" );

error_reporting( 0 );

include_once( "../../global.php" );

$db = new action( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );

$arr = $_REQUEST;

if ( $arr['action'] == "addmar" )

{

		$uid = $arr['cuser'];

		$style = $arr['aa'];

		// $content = iconv( "gbk", "utf-8", $arr['cot'] );
		$content = $arr['cot'];
		$date = mktime( );

		$sql = "INSERT INTO `system_marquee` (\n\n\n\n`user` ,\n\n`type` ,\n\n`content` ,\n\n`datetime` \n\n)\n\nVALUES (\n\n '{$uid}', '{$style}', '{$content}', '{$date}'\n\n)";

		$query = mysql_query( $sql );

		if ( $query )

		{

				echo 1;

		}

		else

		{

				echo 0;

		}

}

if ( $_GET['action'] == "mardel" )

{

		$id = $_GET['id'];

		$sql = "DELETE FROM `system_marquee` WHERE id ='{$id}'";

		$query = mysql_query( $sql );

		if ( $query )

		{

				echo 1;

		}

		else

		{

				echo 0;

		}

}

if ( $_GET['action'] == "dellog" )

{

		$id1 = $_GET['id1'];

		$id2 = $_GET['id2'];

		$sql22 = "select id from admin_users_action where id between  '{$id1}' and '{$id2}' ";

		$info = mysql_query( $sql22 );

		while ( $rw = mysql_fetch_array( $info ) )

		{

				$ids[] = $rw['id'];

		}

		$sql123 = "delete FROM admin_users_action WHERE Id IN(".implode( ",", $ids ).")";

		$done = mysql_query( $sql123 );

		if ( $done )

		{

				echo 1;

		}

}

if ( $_GET['action'] == "kinckout" )

{

		$id = $_GET['id'];

		$id = $_GET['id'];

		$sql = " update users SET is_online = 0,is_ti = 1  where user_id = '{$id}'";

		$query = mysql_query( $sql );

		if ( $query )

		{

				$db_action->caozuorizhi( $uid, "用户被踢出。", 0 );

				echo 1;

		}

		else

		{

				echo 0;

		}

}

?>

