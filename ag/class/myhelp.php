<?php
class myhelp{
    function getmd5($str){
        return md5($str).'/'.$str;
    }
    
    //��֤��ͼƬ���� 
    function rand_create() 
    { 
        //֪ͨ�������Ҫ���PNGͼƬ 
        Header("Content-type: image/PNG"); 
        //׼�������������������  
        srand((double)microtime()*1000000); 
        //׼��ͼƬ����ز���   
        $im = imagecreate(57,18); 
        $black = ImageColorAllocate($im, 0,0,0);  //RGB��ɫ��ʶ�� 
//        $white = ImageColorAllocate($im, 255,255,255); //RGB��ɫ��ʶ�� 
        $gray = ImageColorAllocate($im, 200,200,200); //RGB��ɫ��ʶ�� 
        //��ʼ��ͼ     
        imagefill($im,0,0,$gray); 
        while(($randval=rand()%100000)<10000);{ 
//            $_COOKIE['login_check_num']=$randval;
            $_SESSION["login_check_num"] = $randval; 
            //����λ������֤�����ͼƬ  
            imagestring($im, 5, 9, 2, $randval, $black); 
        } 
        //�����������    
        for($i=0;$i<200;$i++){ 
            $randcolor = ImageColorallocate($im,rand(0,255),rand(0,255),rand(0,255)); 
            imagesetpixel($im, rand()%70 , rand()%30 , $randcolor); 
        } 
        //�����֤ͼƬ 
        ImagePNG($im); 
        //����ͼ���ʶ�� 
        ImageDestroy($im); 
    } 
    //������֤�� 
    function rand_check($reg_rand) 
    { 
        if($reg_rand == $_SESSION["login_check_num"]){ 
            return 1; 
        } 
        else{ 
            return 2;  //return 2; Ϊ2ʱ������֤�����������ʱ�����������붼ͨ����Ϊ1
        } 
    } 
}
?>
