<?php
include_once( "../../global.php" );
$db = new systemset( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
$db->update_animal_set( $_POST, "system.php" );
?>
