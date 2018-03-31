<?php
if (!session_id()) session_start();
include_once '../class/myhelp.php';
$c=new myhelp();
$c->rand_create();
?>
