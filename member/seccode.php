<?php


header("Content-Type:text/html;charset=utf8");
//创建验证码
session_start();

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
$chars = array('零','壹','贰','叁','肆','伍','陆','柒','捌','玖','一','二','三','四','五','六','七','八','九',0,1,2,3,4,5,6,7,8,9);
			
$len = count($chars);
$num1 = mt_rand(0,$len-1);
$num2 = mt_rand(0,$len-1);
$char1 = $chars[$num1];
$char2 = "+";
$char3 = $chars[$num2];




if ($num1 <=9 ) {
	$num1 = $num1;
} else if ($num1 >9 && $num1 <19) {
	$num1 = $num1 - 9;
} else {
	$num1 = $num1 - 19;
}


if ($num2 <=9 ) {
	$num2 = $num2;
} else if ($num2 >9 && $num2 <19) {
	$num2 = $num2 - 9;
} else {
	$num2 = $num2 - 19;
}

$_SESSION['seccode'] = intval($num1) + intval($num2);

$font = dirname(__FILE__). DIRECTORY_SEPARATOR. 'font' . DIRECTORY_SEPARATOR . 'STXINWEI.TTF'; 


$fontSize = 20;
$x = mt_rand(5,15);
$textColor = imagecolorallocate($image,mt_rand(0,100),mt_rand(0,100),mt_rand(0,100));
imagettftext($image,$fontSize,mt_rand(-20,20),$x,mt_rand(15,35),$textColor,$font,$char1);

$textColor = imagecolorallocate($image,mt_rand(0,100),mt_rand(0,100),mt_rand(0,100));
imagettftext($image,$fontSize,mt_rand(-10,10),$x+25,mt_rand(15,35),$textColor,$font,$char2);

$textColor = imagecolorallocate($image,mt_rand(0,100),mt_rand(0,100),mt_rand(0,100));
imagettftext($image,$fontSize,mt_rand(-20,20),$x+45,mt_rand(15,35),$textColor,$font,$char3);


//绘制杂点
for ($i =0;$i< 100;$i++) {
	$pixelColor = imagecolorallocate($image,mt_rand(0,100),mt_rand(0,100),mt_rand(0,100));
	imagesetpixel($image,mt_rand(0,90),mt_rand(0,40),$pixelColor);
}

imagepng($image);
imagedestroy($image);

