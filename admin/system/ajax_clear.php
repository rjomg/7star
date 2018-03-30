<?php
header( "Content-Type:text/html;charset=utf-8" );
date_default_timezone_set( "PRC" );
error_reporting( 0 );
include_once( "../../global.php" );
$db = new action( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
if ( $_GET['action'] == "clearB1" )
{
		$id1 = $_GET['id1'];
		$id2 = $_GET['id2'];
		$sql22 = "select id from reports where plate_num between  '{$id1}' and '{$id2}' ";
		$info = mysql_query( $sql22 );
		while ( $rw = mysql_fetch_array( $info ) )
		{
				$ids[] = $rw['id'];
		}
		$sql123 = "delete FROM reports WHERE id IN(".implode( ",", $ids ).")";
		$done = mysql_query( $sql123 );
		if ( $done )
		{
				echo 1;
		}
		else
		{
				echo 0;
		}
}
if ( $_GET['action'] == "clearB2" )
{
		$id1 = $_GET['id1'];
		$id2 = $_GET['id2'];
		$sql22 = "select id from reports where plate_num between  '{$id1}' and '{$id2}' ";
		$info = mysql_query( $sql22 );
		while ( $rw = mysql_fetch_array( $info ) )
		{
				$ids[] = $rw['id'];
		}
		$sql23 = "select id from orders where plate_num between  '{$id1}' and '{$id2}' ";
		$info1 = mysql_query( $sql23 );
		while ( $rw1 = mysql_fetch_array( $info1 ) )
		{
				$ids1[] = $rw1['id'];
		}
		if ( $ids )
		{
				$sql124 = "delete FROM reports WHERE id IN(".implode( ",", $ids ).")";
				$done = mysql_query( $sql124 );
		}
		if ( $ids1 )
		{
				$sql125 = "delete FROM orders WHERE id IN(".implode( ",", $ids1 ).")";
				$orders = mysql_query( $sql125 );
		}
		if ( $done || $orders )
		{
				echo 1;
		}
		else
		{
				echo 0;
		}
}
?>
