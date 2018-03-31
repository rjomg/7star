<?php
if (!session_id()) session_start();
include_once '../class/myhelp.php';
$reg_rand=$_POST['num'];
$c=new myhelp();
echo $c->rand_check($reg_rand);
?>
