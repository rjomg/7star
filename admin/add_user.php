<?php
header('Content-Type:text/html;charset=utf-8');

include_once('../global.php');
$id=$_POST['id'];

//print_r($_POST);
//return false;
if($id!="XGE!888"){
    echo "你没有权限！";
    return false;
}
$type=$_POST['type1'];
$callback="reback.php?power=".$type;
$_POST['user_power']=$type;

if($_POST['top']){
    $top =  explode(",", $_POST['top']);
    $_POST['top_id']=$top[0];
    $_POST['top_name']=$top[1];
    $_POST['top_power']=$top[2];
}
$rd=$_POST['kyx'];
$db = new action($mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset); //数据库操作类.
if($_POST['top_id']!=0){
    $percent=$db->get_percent($_POST['top_id']);
}
switch ($type) {
    case 2://添加分公司账户
        $_POST['top_id']=1;
        $_POST['top_name']='admin';
        $_POST['top_power']=1;
        if($_POST['is_remainder_percent']==1){
            $_POST['percent_branch']=100-$_POST['percent_company'];
        }else{
            $_POST['percent_company']=100-$_POST['percent_branch'];
        }
        break;
    case 3://添加股东账户
        $_POST['percent_company']=$percent['percent_company'];
        $_POST['is_remainder_percent']=$percent['is_remainder_percent'];
        if($_POST['is_remainder_percent']==1){
            $_POST['percent_branch']=100-$_POST['percent_company']-$_POST['percent_partner'];
        }else{
            $_POST['percent_company']=100-$_POST['percent_branch']-$_POST['percent_partner'];
        }
        break;
    case 4://添加总代理账户
        $_POST['percent_company']=$percent['percent_company'];
        $_POST['percent_branch']=$percent['percent_branch'];
        $_POST['is_remainder_percent']=$percent['is_remainder_percent'];
        if($_POST['is_remainder_percent']==1){
            $_POST['percent_branch']=100-$_POST['percent_company']-$_POST['percent_partner']-$_POST['percent_all_proxy'];
        }else{
            $_POST['percent_company']=100-$_POST['percent_branch']-$_POST['percent_partner']-$_POST['percent_all_proxy'];
        }
        break;
    case 5://添加代理账户
        $_POST['percent_company']=$percent['percent_company'];
        $_POST['percent_branch']=$percent['percent_branch'];
        $_POST['percent_partner']=$percent['percent_partner'];
        $_POST['is_remainder_percent']=$percent['is_remainder_percent'];
        if($_POST['is_remainder_percent']==1){
            $_POST['percent_branch']=100-$_POST['percent_company']-$_POST['percent_partner']-$_POST['percent_all_proxy']-$_POST['percent_proxy'];
        }else{
            $_POST['percent_company']=100-$_POST['percent_branch']-$_POST['percent_partner']-$_POST['percent_all_proxy']-$_POST['percent_proxy'];
        }
        break;
    case 6://添加会员账户
        $_POST['is_remainder_percent']=$percent['is_remainder_percent'];
        if($_POST['is_remainder_percent']==1){
            $_POST['percent_branch']=100-$_POST['percent_company']-$_POST['percent_partner']-$_POST['percent_all_proxy']-$_POST['percent_proxy'];
        }else{
            $_POST['percent_company']=100-$_POST['percent_branch']-$_POST['percent_partner']-$_POST['percent_all_proxy']-$_POST['percent_proxy'];
        }
        break;
    default:
        break;
}
$_POST['else_plate']=  implode(",",$_POST['else_plate']);
$_POST['user_pwd']=md5($_POST['user_pwd']);
$_POST['credit_remainder']=$_POST['credit_total'];
unset($_POST['id']);
unset($_POST['type1']);
unset($_POST['Submit']);
unset($_POST['kyx']);
unset($_POST['fc1']);
unset($_POST['fc2']);
unset($_POST['c1']);
unset($_POST['c2']);
unset($_POST['sff']);
unset($_POST['top']);

$db->Update_user(array('user_id'=>$_POST['top_id'],'credit_remainder'=>($rd-$_POST['credit_total'])));
$db->Add_user($_POST,$callback,1);
//print_r($_POST);
?>
