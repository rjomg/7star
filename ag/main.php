<?php
include_once('../global.php');
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo $system_setting['w_name'];?></title>
</head>
<frameset rows="65,100%,4" frameborder="no" border="0" framespacing="0">
<frame name="topframer" src="top.php" frameborder="no" target="content" noresize="noresize" scrolling="no">
<frameset cols="6,100%,6,0" frameborder="no" border="0" framespacing="0">
<frame name="LeftFramer" src="" frameborder="no" target="content" noresize="noresize" scrolling="no">
<frame src="middel.php" name="content" target="content"> 
</frameset>
</frameset>
</html>
