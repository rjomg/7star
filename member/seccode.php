<?php

//创建验证码

$imgWidth = 90;
$imgHeight = 40;

$image = imagecreatetruecolor($imgWidth,$imgHeight);

//设定背景色
$bgColor = imagecolorallocate($image,200,200,200);
//填充背景色
imagefill($image,0,0,$bgColor);

$borderColor = imagecolorallocate($image,0,0,0);
//绘制边框
imagerectangle($image,0,0,89,39,$borderColor);

//填充字符
$chars = ['零','壹','贰','叁','肆','伍','陆','柒'	,'捌',
            '玖','一','二','三','四','五','六','七','八','九',1,2,3,4,5,6,7,8,9,0];
			
$len = count($chars);
$char1 = $chars[mt_rand(0,$len)];


imagejpeg($image);
imagedestroy($image);