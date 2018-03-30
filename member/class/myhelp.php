<?php
class myhelp{
    function getmd5($str){
        return md5($str).'/'.$str;
    }
    
    //验证码图片生成 
    function rand_create() 
    { 
        //通知浏览器将要输出PNG图片 
        Header("Content-type: image/PNG"); 
        //准备好随机数发生器种子  
        srand((double)microtime()*1000000); 
        //准备图片的相关参数   
        $im = imagecreate(57,18); 
        $black = ImageColorAllocate($im, 0,0,0);  //RGB黑色标识符 
//        $white = ImageColorAllocate($im, 255,255,255); //RGB白色标识符 
        $gray = ImageColorAllocate($im, 200,200,200); //RGB灰色标识符 
        //开始作图     
        imagefill($im,0,0,$gray); 
        while(($randval=rand()%100000)<10000);{ 
//            $_COOKIE['login_check_num']=$randval;
            $_SESSION["login_check_num"] = $randval; 
            //将四位整数验证码绘入图片  
            imagestring($im, 5, 9, 2, $randval, $black); 
        } 
        //加入干扰象素    
        for($i=0;$i<200;$i++){ 
            $randcolor = ImageColorallocate($im,rand(0,255),rand(0,255),rand(0,255)); 
            imagesetpixel($im, rand()%70 , rand()%30 , $randcolor); 
        } 
        //输出验证图片 
        ImagePNG($im); 
        //销毁图像标识符 
        ImageDestroy($im); 
    } 
    //检验验证码 
    function rand_check($reg_rand) 
    { 
        if($reg_rand == $_SESSION["login_check_num"]){ 
            return 1; 
        } 
        else{ 
            return 2;  //return 2; 为2时返回验证码错误，这里暂时设置所有输入都通过即为1
        } 
    } 
}
?>
