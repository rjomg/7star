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
$cha_b=$_POST['cha_rate_b'];
$cha_s=$_POST['cha_rate_s'];

//echo $_SESSION['uid'.$c_p_seesion];
$rate=$db->get_rate($tid,$u_id,$plate_num);
$r=array();
foreach($rate as $k=>$v){
    if($k<'50'){
        $v[1]-=$cha;
        $r[]=$v;
        unset($rate[$k]);
    }
//    if($k=='ºì²¨' || $k=='ÂÌ²¨' || $k=='À¶²¨'){
//        $rate[$k][1]-=$cha_b;
//        $r[]=$rate[$k]; 
//    }
}
//$rate['ºì²¨'][1]-=$cha_b;
//$r[]=$rate['ºì²¨'];
//unset($rate['ºì²¨']);
//
//$rate['ÂÌ²¨'][1]-=$cha_b;
//$r[]=$rate['ÂÌ²¨'];
//unset($rate['ÂÌ²¨']);
//
//$rate['À¶²¨'][1]-=$cha_b;
//$r[]=$rate['À¶²¨'];
//unset($rate['À¶²¨']);
//
//foreach($rate as $k=>$v){
//    $v[1]-=$cha_s;
//    $r[]=$v;
//}

echo json_encode($r);
?>
