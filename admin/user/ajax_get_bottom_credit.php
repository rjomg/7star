<?php
include_once( "../../global.php" );
$db = new action( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
$user_id = $_POST['user_id'];
$x = $db->select( "users", "credit_remainder,credit_total", "user_id={$user_id}" );
$row = $db->fetch_array( $x );
$e = $row['credit_total'] - $row['credit_remainder'];
$e = trim( $e );
echo $e;
?>
