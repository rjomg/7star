<?php
include_once ('../../global.php');
$db = new immediate($mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset); //���ݿ������.
$y =  $db->select("plate", "plate_num","1 order by plate_num desc limit 0,1");
$z=  $db->fetch_array($y);
$plate_num=$z['plate_num'];
//$_POST['type_id']
//echo $plate_num;
//$plate_num="2012044";
//��ȡ�ϼ����ϼ������Ϣ
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
//        $rate['��'][1]-=$cha;
//        
//    }elseif($k==1){
//        $rate['ţ'][1]-=$cha;
//    }elseif($k==2){
//        $rate['��'][1]-=$cha;
//    }elseif($k==3){
//        $rate['��'][1]-=$cha;
//    }elseif($k==4){
//        $rate['��'][1]-=$cha;
//    }elseif($k==5){
//        $rate['��'][1]-=$cha;
//    }elseif($k==6){
//        $rate['��'][1]-=$cha;
//    }elseif($k==7){
//        $rate['��'][1]-=$cha;
//    }elseif($k==8){
//        $rate['��'][1]-=$cha;
//    }elseif($k==9){
//        $rate['��'][1]-=$cha;
//    }elseif($k==10){
//        $rate['��'][1]-=$cha;
//    }elseif($k==11){
//        $rate['��'][1]-=$cha;
//    }
//        $r[]=$v; 
//        unset($rate[$k]);
//}
$rate['��'][1]-=$cha;
$r[]=$rate['��'][1];
//unset($rate['��']);
$rate['ţ'][1]-=$cha;
$r[]=$rate['ţ'][1];
//unset($rate['ţ']);
$rate['��'][1]-=$cha;
$r[]=$rate['��'][1];
//unset($rate['��']);
$rate['��'][1]-=$cha;
$r[]=$rate['��'][1];
//unset($rate['��']);
$rate['��'][1]-=$cha;
$r[]=$rate['��'][1];
//unset($rate['��']);
$rate['��'][1]-=$cha;
$r[]=$rate['��'][1];
//unset($rate['��']);
$rate['��'][1]-=$cha;
$r[]=$rate['��'][1];
//unset($rate['��']);
$rate['��'][1]-=$cha;
$r[]=$rate['��'][1];
//unset($rate['��']);
$rate['��'][1]-=$cha;
$r[]=$rate['��'][1];
//unset($rate['��']);
$rate['��'][1]-=$cha;
$r[]=$rate['��'][1];
//unset($rate['��']);
$rate['��'][1]-=$cha;
$r[]=$rate['��'][1];
//unset($rate['��']);
$rate['��'][1]-=$cha;
$r[]=$rate['��'][1];
//unset($rate['��']);
//foreach($rate as $k=>$v){
//        $v['��'][1]-=$cha;
//        $r[]=$v;
//}

//$r=iconv("utf-8", "gbk", $r);

echo json_encode($r);
?>
