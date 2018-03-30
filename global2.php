<?php
session_start(); 
date_default_timezone_set('PRC');           
include_once ("common/mysql.class.php"); //mysql类
include_once ("configs/config.php"); //配置参数
include_once ("common/page.class.php"); //后台专用分页类
include_once ("common/action.class.php"); //数据库操作类
include_once ("common/immediate.class.php"); //数据库操作类
include_once ("common/plate.class.php"); //数据库操作类
include_once ("common/rate.class.php"); //数据库操作类
include_once ("common/systemset.class.php"); //数据库操作类
include_once ("common/back.class.php"); //数据库操作类
include_once ("common/phpzip.class.php"); //zip
include_once ("common/iplocaion.class.php"); 
error_reporting(0);
$db_action = new action($mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset); //数据库操作类.
$c_p_seesion=$db_action->c_p_seesion();

$db_action->seesion_save_time_set($_COOKIE['uid'.$c_p_seesion],$_COOKIE['z_uid'.$c_p_seesion],$_COOKIE['user_power'.$c_p_seesion],$_COOKIE['username'.$c_p_seesion]);//seesion重复保存

$db_action->Is_login($_SESSION['user_power'.$c_p_seesion],$_SESSION['uid'.$c_p_seesion]);
$IpLocation = new IpLocation();
$client_location = $IpLocation->getlocation();
$uid = $_SESSION['uid'.$c_p_seesion];
$usernames = $_SESSION['username'.$c_p_seesion];

$spul = $_GET['spul'];
//超时退出
$db_action->skipup($uid,$usernames,$client_location['country']);

$db_action->caozuorizhi($uid,$usernames,$spul,0,$client_location['country']);

$db_action->auto_set_plate();

$zizhanghaodenglu=$db_action->sub_account($_SESSION['z_uid'.$c_p_seesion]);
$_SESSION['uid'.$c_p_seesion]=$zizhanghaodenglu[0];
//chaoshituichu
if(isset($_SESSION['expiretime'])) {
    if($_SESSION['expiretime'] < time()) {
        unset($_SESSION['expiretime']);
        header('Location: top.php?action=logout'); // 登出
        exit(0);
    } else {
        $_SESSION['expiretime'] = time() + 3600; // 刷新时间戳
    }
}
//系统设置
$system_setting=$db_action->system_setting();
//echo $c_p_seesion;
//print_r($_SESSION);
//print_r($zizhanghaodenglu);
//echo $zizhanghaodenglu[2];
//print_r($_COOKIE);

//用cookies来再次保存seesion值，由于seesion在不稳定


?> 