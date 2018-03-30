<?php
include_once( "../../global.php" );
$user_id = $_POST['va'];
$x = explode( ",", $user_id );
$db = new action( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
$p = $db->get_top_yue( $x[0] );
echo json_encode( $p );
?>
