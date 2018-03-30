<?php
include_once( "../../global.php" );
$db = new immediate( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
if ( $_POST['zc'] )
{
		$zc = $_POST['zc'];
}
else
{
		$zc = 0;
}
if ( $_POST['kx'] )
{
		$kx = $_POST['kx'];
}
else
{
		$kx = 0;
}
$sql = "insert ignore into single_set (zc_value,kx_value,zfts_value,j_value,user_id,o_id)";
$sql .= " values ('{$zc}','{$kx}','{$_POST['ts']}','{$_POST['j']}','{$_POST['uid']}','{$_POST['oid']}')";
$db->query( $sql );
if ( $_POST['kx'] )
{
		$db->update( "single_set", "kx_value='{$_POST['kx']}',zfts_value='{$_POST['ts']}',j_value='{$_POST['j']}'", "user_id='{$_POST['uid']}' and o_id='{$_POST['oid']}'" );
}
if ( $_POST['zc'] )
{
		$db->update( "single_set", "zc_value='{$_POST['zc']}',zfts_value='{$_POST['ts']}',j_value='{$_POST['j']}'", "user_id='{$_POST['uid']}' and o_id='{$_POST['oid']}'" );
}
?>
