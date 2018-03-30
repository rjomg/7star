<?php
include_once ('../../global.php');
$db = new immediate($mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset); //数据库操作类.
$y =  $db->select("plate", "plate_num","1 order by plate_num desc limit 0,1");
$z=  $db->fetch_array($y);
$plate_num=$z['plate_num'];
//$_POST['type_id']
//echo $plate_num;
//$plate_num="2012044";
//获取上级以上级别的信息
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


//echo $_SESSION['uid'.$c_p_seesion];
if($tid==33){
    $rate=$db->get_rate(69,$u_id,$plate_num);
    $rate2=$db->get_rate(70,$u_id,$plate_num);
    
}elseif($tid==36){
    $rate=$db->get_rate(71,$u_id,$plate_num);
    $rate2=$db->get_rate(72,$u_id,$plate_num);
}else{
$rate=$db->get_rate($tid,$u_id,$plate_num);
$r=array();
foreach($rate as $k=>$v){
    if($k<'50'){
        $v[1]-=$cha;
        $r[]=$v;
        unset($rate[$k]);
    }
}
}



if($tid==33 || $tid==36){
$r=array();
$r2=array();
foreach($rate as $k=>$v){
    if($k<'50'){
        $v[1]-=$cha;
        $r[]=$v;
        unset($rate[$k]);
    }
}
foreach($rate2 as $k2=>$v2){
    if($k2<'50'){
        $v2[1]-=$cha;
        $r2[]=$v2;
        unset($rate[$k2]);
    }
}
echo json_encode(array($r,$r2));
}else{
echo json_encode($r);    
}
?>
