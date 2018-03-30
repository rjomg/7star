<?php
/**
  * 图片上传方法-来源与PHP100中文网
  * $maxsize=500000 = 500k;
  * $updir="up/";
  * $upfile=$_FILES["file_img"];
  */
 function Get_file_upload($upfile,$maxsize,$updir,$newname = 'date') {

  if ($newname == 'date')
   $newname = date("Ymdhs"); //使用日期做文件名
  $name = $upfile["name"];
  $type = $upfile["type"];
  $size = $upfile["size"];
  $tmp_name = $upfile["tmp_name"];
  
  $hz_temp = explode(".",$name);
  $hz = $hz_temp[1];

/*  switch ($type) {
   case 'image/pjpeg' :
   case 'image/jpeg' :
    $extend = ".jpg";
    break;
   case 'image/gif' :
    $extend = ".gif";
    break;
   case 'image/png' :
    $extend = ".png";
    break;
  }
  if (empty ($extend)) {
   echo '文件类型不正确,只能使用JPG GIF PNG 格式';  
  }*/
  
  
  if ($size > $maxsize) {
   $maxpr = $maxsize / 1000;
   echo "警告！上传图片大小不能超过";
  }
	  if (move_uploaded_file($tmp_name, $updir . $newname . ".".$hz)) {
	   return $newname . ".".$hz;
	  }
 }


?>