<?php
header( "Content-Type:text/html;charset=utf-8" );
include_once( "../../global.php" );
$id = $_POST['id'];
if ( $id != "XGE!888" )
{
		echo "你没有权限！";
		return false;
}
$type = $_POST['type1'];
// $callback = "reback.php?power=".$type;
$callback = "leveladdedit.php?power=".$type;
$_POST['user_power'] = $type;
if ( $_POST['top'] )
{
		$top = explode( ",", $_POST['top'] );
		$_POST['top_id'] = $top[0];
		$_POST['top_name'] = $top[1];
		$_POST['top_power'] = $top[2];
		$callback = "leveladdedit.php?power=".$type.'&top_id='.$top[0];
}
$rd = $_POST['kyx'];
// echo $rd;exit;
// var_dump(preg_match("/^[0-9a-zA-Z]{3,6}$/",$_POST['user_name']));exit;
$db = new action( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
preg_match_all("/\d/",$_POST['user_name'],$arr);  //数字
preg_match_all("/[a-zA-Z]{1}/",$_POST['user_name'],$arrAl);  //字母
// var_dump($arrAl);exit;
if (empty($arr[0]) || empty($arrAl[0])) {
	$db->get_admin_msg( $_SERVER['HTTP_REFERER'], "用户名必须为字母和数组组合！,请重新添加！" );
}
if (count($arr[0])>3 || count($arrAl[0])>3) {
	$db->get_admin_msg( $_SERVER['HTTP_REFERER'], "用户名中数字和字母均不能超过3位！,请重新添加！" );
}
if (strlen($_POST['user_name'])>6 || strlen($_POST['user_name'])<3)
  {
  	$db->get_admin_msg( $_SERVER['HTTP_REFERER'], "用户名必须为3-6位的字符串！,请重新添加！" );
  }
  if(preg_match("/^\d*$/",$_POST['user_name']))
  {
    $db->get_admin_msg( $_SERVER['HTTP_REFERER'], "用户名必须包含字母！,请重新添加！" );
  }
  if(preg_match("/^[a-z]*$/i",$_POST['user_name']))
  {
    $db->get_admin_msg( $_SERVER['HTTP_REFERER'], "用户名必须包含数字！,请重新添加！" );
  }
  if(!preg_match("/^[a-z\d]*$/i",$_POST['user_name']))
  {
    $db->get_admin_msg( $_SERVER['HTTP_REFERER'], "用户名必须为字母和数组组合！,请重新添加！" );
  }
  if ($_POST['user_name']==$_POST['user_pwd']) {
  	$db->get_admin_msg( $_SERVER['HTTP_REFERER'], "用户名和密码不能相同！,请重新添加！" );
  }
  if ($_POST['user_pwd']=='a12345' || $_POST['user_pwd']=='ab1234' || $_POST['user_pwd']=='abc123' || $_POST['user_pwd']=='a1b2c3' || $_POST['user_pwd']=='aaa111' || $_POST['user_pwd']=='123qwe') {
  	$db->get_admin_msg( $_SERVER['HTTP_REFERER'], "此密码为禁用密码！,请重新添加！" );
  }
// if (preg_match("/[A-Za-z]/",$_POST['user_name']) && preg_match("/\d/",$_POST['user_name'])) {
// 	$db->get_admin_msg( $_SERVER['HTTP_REFERER'], "用户名必须为字母和数组组合！,请重新添加！" );
// }
$is_username = $db->select( "users", "user_id", "user_name='{$_POST['user_name']}'" );
$rusername = $db->fetch_array( $$is_username );
if ( !empty( $rusername['user_id'] ) )
{
		$db->get_admin_msg( $_SERVER['HTTP_REFERER'], "用户名已存在！,请重新添加！" );
}
if ( $_POST['top_id'] != 0 )
{
		$percent = $db->get_percent( $_POST['top_id'] );
}
switch ( $type )
{
case 2 :
		$_POST['top_id'] = 1;
		$_POST['top_name'] = "admin";
		$_POST['top_power'] = 1;
		if ( $_POST['is_remainder_percent'] == 1 )
		{
				$_POST['percent_branch'] = 100 - $_POST['percent_company'];
		}
		else
		{
				$_POST['percent_company'] = 100 - $_POST['percent_branch'];
		}
		break;
case 3 :
		$_POST['percent_company'] = $percent['percent_company'];
		$_POST['is_remainder_percent'] = $percent['is_remainder_percent'];
		if ( $_POST['is_remainder_percent'] == 1 )
		{
				$_POST['percent_branch'] = 100 - $_POST['percent_company'] - $_POST['percent_partner'];
		}
		else
		{
				$_POST['percent_company'] = 100 - $_POST['percent_branch'] - $_POST['percent_partner'];
		}
		break;
case 4 :
		$_POST['percent_company'] = $percent['percent_company'];
		$_POST['percent_branch'] = $percent['percent_branch'];
		$_POST['is_remainder_percent'] = $percent['is_remainder_percent'];
		if ( $_POST['is_remainder_percent'] == 1 )
		{
				$_POST['percent_branch'] = 100 - $_POST['percent_company'] - $_POST['percent_partner'] - $_POST['percent_all_proxy'];
		}
		else
		{
				$_POST['percent_company'] = 100 - $_POST['percent_branch'] - $_POST['percent_partner'] - $_POST['percent_all_proxy'];
		}
		break;
case 5 :
		$_POST['percent_company'] = $percent['percent_company'];
		$_POST['percent_branch'] = $percent['percent_branch'];
		$_POST['percent_partner'] = $percent['percent_partner'];
		$_POST['is_remainder_percent'] = $percent['is_remainder_percent'];
		if ( $_POST['is_remainder_percent'] == 1 )
		{
				$_POST['percent_branch'] = 100 - $_POST['percent_company'] - $_POST['percent_partner'] - $_POST['percent_all_proxy'] - $_POST['percent_proxy'];
		}
		else
		{
				$_POST['percent_company'] = 100 - $_POST['percent_branch'] - $_POST['percent_partner'] - $_POST['percent_all_proxy'] - $_POST['percent_proxy'];
		}
		break;
case 6 :
		$_POST['is_remainder_percent'] = $percent['is_remainder_percent'];
		if ( $percent['user_power'] != 2 )
		{
				$_POST['percent_branch'] = $percent['percent_branch'];
		}
		$_POST['percent_company'] = $percent['percent_company'];
		$_POST['percent_partner'] = $percent['percent_partner'];
		$_POST['percent_all_proxy'] = $percent['percent_all_proxy'];
		if ( $_POST['is_remainder_percent'] == 1 )
		{
				$_POST['percent_branch'] = 100 - $_POST['percent_company'] - $_POST['percent_partner'] - $_POST['percent_all_proxy'] - $_POST['percent_proxy'];
		}
		else
		{
				$_POST['percent_company'] = 100 - $_POST['percent_branch'] - $_POST['percent_partner'] - $_POST['percent_all_proxy'] - $_POST['percent_proxy'];
		}
		break;
default :
		break;
}
$_POST['else_plate'] = implode( ",", $_POST['else_plate'] );
$_POST['user_pwd'] = md5( $_POST['user_pwd'] );
$_POST['credit_remainder'] = $_POST['credit_total'];
unset( $_POST['id'] );
unset( $_POST['type1'] );
unset( $_POST['Submit'] );
unset( $_POST['kyx'] );
unset( $_POST['fc1'] );
unset( $_POST['fc2'] );
unset( $_POST['c1'] );
unset( $_POST['c2'] );
unset( $_POST['sff'] );
unset( $_POST['top'] );
$db->update_user( array(
		"user_id" => $_POST['top_id'],
		"credit_remainder" => $rd - $_POST['credit_total']
) );
$db->add_user( $_POST, $callback, 1 );
?>
