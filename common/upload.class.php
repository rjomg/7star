<?php
/**
  * ͼƬ�ϴ�����-��Դ��PHP100������
  * $maxsize=500000 = 500k;
  * $updir="up/";
  * $upfile=$_FILES["file_img"];
  */
 function Get_file_upload($upfile,$maxsize,$updir,$newname = 'date') {

  if ($newname == 'date')
   $newname = date("Ymdhs"); //ʹ���������ļ���
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
   echo '�ļ����Ͳ���ȷ,ֻ��ʹ��JPG GIF PNG ��ʽ';  
  }*/
  
  
  if ($size > $maxsize) {
   $maxpr = $maxsize / 1000;
   echo "���棡�ϴ�ͼƬ��С���ܳ���";
  }
	  if (move_uploaded_file($tmp_name, $updir . $newname . ".".$hz)) {
	   return $newname . ".".$hz;
	  }
 }


?>