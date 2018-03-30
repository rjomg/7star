<?php
include_once( "../../global.php" );
$user_name = $_POST['czai'];
$db = new action( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
$p = $db->user_name_exists( $user_name );
echo json_encode( $p );
?>
