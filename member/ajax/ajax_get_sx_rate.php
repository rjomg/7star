<?php
include_once ('../../global.php');
$db = new immediate($mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset); //Êý¾Ý¿â²Ù×÷Àà.
$y =  $db->select("plate", "plate_num","1 order by plate_num desc limit 0,1");
$z=  $db->fetch_array($y);
$plate_num=$z['plate_num'];
//$_POST['type_id']
//echo $plate_num;
//$plate_num="2012044";
//»ñÈ¡ÉÏ¼¶ÒÔÉÏ¼¶±ðµÄÐÅÏ¢
$db->get_tops($_SESSION['uid'.$c_p_seesion]);
$user_top=$db->tops;
$queryusers=  $db->select("users", "is_odds,is_fly", "user_id={$user_top['branch']['user_id']}");
$user = $db->fetch_array($queryusers);
if($user['is_odds']==1){
    $db->get_tops($user_top['branch']['user_id']);
    $gs=$db->tops;
    $u_id= $gs['company']['user_id'];  
}else{
    $u_id= $user_top['branch']['user_id'];  
}

$tid=$_POST['tid'];
$cha=$_POST['cha_rate'];



$rate=$db->get_rate($tid,$u_id,$plate_num);

$r=array();
//foreach($rate as $k=>$v){
//    if($k==0){
//        $rate['Êó'][1]-=$cha;
//        
//    }elseif($k==1){
//        $rate['Å£'][1]-=$cha;
//    }elseif($k==2){
//        $rate['»¢'][1]-=$cha;
//    }elseif($k==3){
//        $rate['ÍÃ'][1]-=$cha;
//    }elseif($k==4){
//        $rate['Áú'][1]-=$cha;
//    }elseif($k==5){
//        $rate['Éß'][1]-=$cha;
//    }elseif($k==6){
//        $rate['Âí'][1]-=$cha;
//    }elseif($k==7){
//        $rate['Ñò'][1]-=$cha;
//    }elseif($k==8){
//        $rate['ºï'][1]-=$cha;
//    }elseif($k==9){
//        $rate['¼¦'][1]-=$cha;
//    }elseif($k==10){
//        $rate['¹·'][1]-=$cha;
//    }elseif($k==11){
//        $rate['Öí'][1]-=$cha;
//    }
//        $r[]=$v; 
//        unset($rate[$k]);
//}
$rate['Êó'][1]-=$cha;
$r[]=$rate['Êó'][1];
//unset($rate['Êó']);
$rate['Å£'][1]-=$cha;
$r[]=$rate['Å£'][1];
//unset($rate['Å£']);
$rate['»¢'][1]-=$cha;
$r[]=$rate['»¢'][1];
//unset($rate['»¢']);
$rate['ÍÃ'][1]-=$cha;
$r[]=$rate['ÍÃ'][1];
//unset($rate['ÍÃ']);
$rate['Áú'][1]-=$cha;
$r[]=$rate['Áú'][1];
//unset($rate['Áú']);
$rate['Éß'][1]-=$cha;
$r[]=$rate['Éß'][1];
//unset($rate['Éß']);
$rate['Âí'][1]-=$cha;
$r[]=$rate['Âí'][1];
//unset($rate['Âí']);
$rate['Ñò'][1]-=$cha;
$r[]=$rate['Ñò'][1];
//unset($rate['Ñò']);
$rate['ºï'][1]-=$cha;
$r[]=$rate['ºï'][1];
//unset($rate['ºï']);
$rate['¼¦'][1]-=$cha;
$r[]=$rate['¼¦'][1];
//unset($rate['¼¦']);
$rate['¹·'][1]-=$cha;
$r[]=$rate['¹·'][1];
//unset($rate['¹·']);
$rate['Öí'][1]-=$cha;
$r[]=$rate['Öí'][1];
//unset($rate['Öí']);
//foreach($rate as $k=>$v){
//        $v['Êó'][1]-=$cha;
//        $r[]=$v;
//}

//$r=iconv("utf-8", "gbk", $r);

echo json_encode($r);
?>
