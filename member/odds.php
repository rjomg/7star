<?php

include_once ('../global.php');

$db = new rate($mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset); //数据库操作类.

$o_type=$_GET['o'];

if(!$o_type)$o_type=16;



$url="odds.php?o=$o_type";











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



$rate_admin=$db->get_rate($o_type,1);

$rate=$db->get_rate($o_type,$u_id);

$ab_rate=$db->get_rate($o_type,$u_id, 'ab_content');

$anmail=$db->get_animal_table();



//当前期数

$qishus=  $db->select("plate", "*", "1 order by plate_num desc limit 1");

$qishu = $db->fetch_array($qishus);





//  $qishu[is_plate_start];//状态0正在开盘，1正在封盘

        $gunqiufengpan_arr=$db->gunqiufengpan();//滚球封盘

        $gunqiufengpan_te=$gunqiufengpan_arr[0];

        $gunqiufengpan_other=$gunqiufengpan_arr[1];

        

 $tezhengma=0; 

 if($o_type==16 || $o_type==17){



     if($gunqiufengpan_te==0 && $qishu[is_special] && strtotime($qishu[special_time_end])>time() && strtotime($qishu[plate_time_satrt])<= time() && time()<strtotime($qishu[plate_time_end]) && $qishu[is_plate_start]==0){

         $tezhengma=1;

     }

     $tezhengma_time=$qishu['special_time_end'];

     $tiaojian_pan="o_typename='特码'";

     $tiaojian_pan_b="o_typename='特码波色'";

     $tiaojian_pan_s="o_typename='特码双面'";

     $x_o_type1="特码";

     $all_type_arr=explode(',', "01,02,03,04,05,06,07,08,09,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,红波,蓝波,绿波,特单,特双,特大,特小,合单,合双,尾小,尾大,家禽,野兽,总单,总双,总大,总小");

    

 //这里判断正码的封盘状态    

 }elseif($o_type==18 || $o_type==19 || $o_type==20 || $o_type==21 || $o_type==22 || $o_type==23 || $o_type==24 || $o_type==25 || $o_type==26 || $o_type==27 || $o_type==28 || $o_type==29 || $o_type==30 || $o_type==31){

     if($gunqiufengpan_other==0 && $qishu[is_normal] && strtotime($qishu[normal_time_end])>time() && strtotime($qishu[plate_time_satrt])<= time() && time()<strtotime($qishu[plate_time_end]) && $qishu[is_plate_start]==0){

         $tezhengma=1;

     }

     $tezhengma_time=$qishu['normal_time_end'];

     if($o_type==30 || $o_type==31){

     $tiaojian_pan="o_typename='正码'";

     $tiaojian_pan_s="o_typename='正码双面'";

     $x_o_type1="正码";

     $all_type_arr=explode(',', "01,02,03,04,05,06,07,08,09,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,总单,总双,总大,总小");

     }else{

     $tiaojian_pan="o_typename='正特'";

     $tiaojian_pan_b="o_typename='正码1-6波色'";

     $tiaojian_pan_s="o_typename='正码1-6双面'";

     $x_o_type1="正特";

     $all_type_arr=explode(',', "01,02,03,04,05,06,07,08,09,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,红波,蓝波,绿波,单,双,大,小,合单,合双,尾小,尾大,家禽");

     }

 }



            

//当前用户信息

$myusers=  $db->select("users", "*", "user_id={$_SESSION['uid'.$c_p_seesion]}");

$myuser = $db->fetch_array($myusers);





//ABCD盘切换设置

$o_pan=$_GET['pan'];

if($o_pan=="")$o_pan="A";



//号码

$onlyabcds=  $db->select("abcd_rate", "*", "$tiaojian_pan");

$onlyabcd = $db->fetch_array($onlyabcds);

$abcd_rate=0;

if($o_pan=="B"){

   $abcd_rate=$onlyabcd['ab_rate']; 

}elseif($o_pan=="C"){

   $abcd_rate=$onlyabcd['ac_rate'];   

}elseif($o_pan=="D"){

   $abcd_rate=$onlyabcd['ad_rate']; 

}

//波色

//$bs_name="红波,蓝波,绿波";

//$bs_name = explode(',', $bs_name);

$onlyabcds_b=  $db->select("abcd_rate", "*", "$tiaojian_pan_b");

$onlyabcd_b = $db->fetch_array($onlyabcds_b);

$abcd_rate_b=0;

if($o_pan=="B"){

   $abcd_rate_b=$onlyabcd_b['ab_rate']; 

}elseif($o_pan=="C"){

   $abcd_rate_b=$onlyabcd_b['ac_rate'];   

}elseif($o_pan=="D"){

   $abcd_rate_b=$onlyabcd_b['ad_rate']; 

}

//双面

//$sm_name="特单,特双,特大,特小,合单,合双,尾小,尾大,家禽,野兽,总单,总双,总大,总小";

//$sm_name = explode(',', $sm_name);

$onlyabcds_s=  $db->select("abcd_rate", "*", "$tiaojian_pan_s");

$onlyabcd_s = $db->fetch_array($onlyabcds_s);

$abcd_rate_s=0;

if($o_pan=="B"){

   $abcd_rate_s=$onlyabcd_s['ab_rate']; 

}elseif($o_pan=="C"){

   $abcd_rate_s=$onlyabcd_s['ac_rate'];   

}elseif($o_pan=="D"){

   $abcd_rate_s=$onlyabcd_s['ad_rate']; 

}

if($_GET[x_orders_y_i]>0){

$_GET[x_plate_num]=$_SESSION['tzts4'];

$_GET[x_abcd_h]=$_SESSION['tzts5'];

$_GET[x_o_type1]=$_SESSION['tzts6'];

$_GET[x_o_type2]=$_SESSION['tzts7'];

$_GET[x_o_type3]=$_SESSION['tzts8'];

$_GET[x_orders_y]=$_SESSION['tzts9'];

$_GET[x_orders_p]=$_SESSION['tzts10'];

    $db->get_orders($_GET[x_orders_y_i],$_GET[x_plate_num],$_GET[x_abcd_h],$_GET[x_o_type1],$_GET[x_o_type2],explode('=_=',$_GET[x_o_type3]),explode('=_=',$_GET[x_orders_y]),explode('=_=',$_GET[x_orders_p]),0,0,"");





}

if($_POST['btnSubmit']=="下注"){ 



    $x_o_type3 =  implode('=_=',$_POST[x_o_type3]);

    $x_orders_y =  implode('=_=',$_POST[x_orders_y]);

    $x_orders_p =  implode('=_=',$_POST[x_orders_p]);

unset($_SESSION['tzts4']);

unset($_SESSION['tzts5']);

unset($_SESSION['tzts6']);

unset($_SESSION['tzts7']);

unset($_SESSION['tzts8']);

unset($_SESSION['tzts9']);

unset($_SESSION['tzts10']);

$_SESSION['tzts4']=$_POST[x_plate_num];

$_SESSION['tzts5']=$_POST[x_abcd_h];

$_SESSION['tzts6']=$_POST[x_o_type1];

$_SESSION['tzts7']=$_POST[x_o_type2];

$_SESSION['tzts8']=$x_o_type3;

$_SESSION['tzts9']=$x_orders_y;

$_SESSION['tzts10']=$x_orders_p;





$orders_tixing=$db->get_orders_tixing($_POST[x_plate_num],$_POST[x_abcd_h],$_POST[x_o_type1],$_POST[x_o_type2],$_POST[x_o_type3],$_POST[x_orders_y],$_POST[x_orders_p],0,0,"");    



    echo " <script>if(confirm('$orders_tixing[0]')){ 

   window.location.href='odds.php?o=$o_type&pan=$o_pan&x_orders_y_i=$orders_tixing[1]';

       }

else 

  { 



    }</script>";



  //window.history.go(-1)



}elseif(!empty($_GET['x_content'])){

    $kuaisu=array();

    $x_content_arr=explode(' ',$_GET['x_content']); 

    foreach ($x_content_arr as $ck => $c) {

        $x_c_arr=explode('=',$c);

        //$x_c_arr[0];//号码

        //$x_c_arr[1];//金额

        $kuaisu[$x_c_arr[0]]=$x_c_arr[1];

    }   

//$db->get_orders($_POST[x_plate_num],$_POST[x_abcd_h],$_POST[x_o_type1],$_POST[x_o_type2],$_POST[x_o_type3],$_POST[x_orders_y],$_POST[x_orders_p],0,1,$_POST[x_content]);    

}

//退水信息

//  `set_name`'交易类型',

//  `percent_a`  'A盘退水占成百分率',

//  `percent_b`  'B盘退水占成百分率',

//  `percent_c`  'C盘退水占成百分率',

//  `percent_d`  'D盘退水占成百分率',

//  `bottom_limit`  '最低限额',

//  `top_limit`  '最高限额',

//  `odd_limit` '单码限额',

//$back_sets=  $db->select("back_set", "*", "user_id={$_SESSION['uid'.$c_p_seesion]}");

//$back_set = $db->fetch_array($back_sets);





//处理下注数据

//  `user_id`  '用户id',

//  `plate_num`'格式“年+期数”，如：2012106',

//  `time` '下注时间',

//  `o_type1`  '选择下注的类型1（如特码，正码）',

//  `o_type2` '选择下注的类型2 （如特码A，特码B）',

//  `o_type3` '要下注金额的类型3（号码，双面，波色，生肖等...）',

//  `orders_y`  '下注金额',

//  `orders_p`  '下注时的赔率值',

//  `abcd_h`  '下注对应的会员盘（分A,B,C,D盘）',

//  `h_tui` '会员退水值',

//  `d_tui`  '代理退水值',

//  `zd_tui`  '总代理退水值',

//  `gd_tui`'股东退水值',

//  `f_tui`  '分公司退水值',

//  `d_z` '代理占成值',

//  `zd_z`  '总代理占成值',

//  `gd_z` '股东占成值',

//  `f_z` '分公司占成值',

//  `g_z`  '公司占成值',

//  `is_fly`'下级走飞归属（分0“全归公司”，1“全归分公司”和2“按各级成数分配”）',

//  `topd_id`  '上级代理id', 

//  `topzd_id` '上级总代理id',

//  `topgd_id` '上级股东id',

//  `topf_id`  '上级分公司id',

//  `keying_y` '可赢金额（下注金额*赔率-下注金额+该注退水金额）',

//   `tuishui_y`  '该注单退水金额（下注类型金额*下注类型的退水率--------退水也叫佣金）',



//该下注类型是否被设置为“停押”，是否少于“最低下注额”，是否金额是否超出“余额”，是否被“封号”，是否超出“下注最高限额”，是否到了“封盘时间”，提示方式可以有两种，1:将无问题的注单设置下注成功，有问题的注单设置下注失败，并返回问题信息。  2:直接提示下注单中有有问题的注单，并返回问题信息，提示重新下单。



?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">



<link rel="stylesheet" type="text/css" id="css" href="css/members.css">

<script src="js/common.js" type="text/javascript"></script>

</head>

<body style="margin: 0px;background:white;" scroll="no"> 

  <table border="0" cellpadding="0" cellspacing="0" height="100%" width="99%" align="center" style="table-layout: fixed;">

    <tbody><tr>

      <td width="40%"><iframe frameborder="0" id="soonselectorder" name="soonselectorder" src="soonselectmain_ifr1.php" scrolling="yes" style="height: 1000px; visibility: inherit; width: 100%; z-index: 1; overflow: auto;" onload="loadIf(this,2);"></iframe></td>

      <td width="60%"><iframe frameborder="0" id="soonselectset" name="soonselectset" src="soonselectmain_ifr2.php" scrolling="yes" style="height: 1000px; visibility: inherit; width: 100%; z-index: 1; overflow: auto;" onload="loadIf(this,2);"></iframe></td>

    </tr>

  </tbody></table>

<noscript>&lt;iframe src=*.html&gt;&lt;/iframe&gt;</noscript>



</body></html>