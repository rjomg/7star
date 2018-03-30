<?php
include_once( "../../global.php" );
$power = $_POST['va'];
$x = explode( ",", $power );
$db = new action( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
$p = $db->get_top_percent( $x[2] + 1, $x[0] );
echo json_encode( $p );
?>
