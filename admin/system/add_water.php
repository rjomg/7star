<?php 
include_once( "../../global.php" );
$db = new action( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
$odb = new orders( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
$query = $db->select( "plate order by id desc", "*", "" );
$uid=$_POST['id']?$_POST['id']:'1';
$plate = $db->fetch_array( $query );
$user_one=$db->get_one('select is_lock from users where user_id='.$uid);
$top_lh=$db->get_all('select o_ccupy_money,o_typename,percent_proxy from oddsset_type left join users on oddsset_type.user_id=users.top_id where oddsset_type.o_ccupy_money >0 and users.percent_proxy>0 and users.user_id='.$uid);
//获取所有上级信息
$db->get_tops($uid);
$user_top=$db->tops;

if (empty($_GET) || !isset($_GET)) {
	if ($_POST && $_POST['num']!=='all') {
		$old_opera_water=$db->get_one('select opera_water from users where user_id='.$uid);
		$old_opera_water=(int)$old_opera_water['opera_water']+(int)$_POST['water'];
		$res=$db->get_update('users',array('opera_water'=>$old_opera_water),'user_id='.$uid);
		if ($res) {
			if ($_POST['classid']=='2' || $_POST['classid']=='') {
				$post_n_m[0]=rand(0,9).'XX'.rand(0,9);
			}
			if ($_POST['classid']=='3') {
				$post_n_m[0]=rand(0,9).rand(0,9).'X'.rand(0,9);
			}
			if ($_POST['classid']=='4') {
				$post_n_m[0]=rand(1000,9999);
			}
			$post_n_m[1]=$_POST['water'];
			$totalmoney=$db->get_one('select * from users where user_id='.$uid);
			$old_money=$totalmoney['credit_remainder'];
			$orders['time']=time(); //下注时间
			$orders['user_id']=$uid; //下注用户
			$orders['o_type1']='四字定';
				$orders['o_type2']=''; //类型2如口口XX
				$number=str_split($post_n_m[0]);
				foreach ($number as $k => $val) {
					if ($val!=='X') {
						$orders['o_type2'].='口';
					}else{
						$orders['o_type2'].='X';
					}
				}
				$o_type2=($orders['o_type2']=='口口口口')?'"四字定"':'"'.$orders['o_type2'].'"';
				if (!empty($top_lh)) {
					$sum_y=$db->get_all('select SUM(orders_y) as orders_y from orders where user_id='.$uid.' and plate_num='.$plate['plate_num']);
					foreach ($top_lh as $lk => $lv) {
						if ($lv['o_typename']==$orders['o_type2']) {
							if ($sum_y[0]['orders_y']<$lv['o_ccupy_money']) {
								if (($sum_y[0]['orders_y']+$value['money'])>$lv['o_ccupy_money']) {
									$add_y=($sum_y[0]['orders_y']+$value['money'])-$lv['o_ccupy_money'];
									$orders['d_z']=($lv['percent_proxy']/100)*$add_y;
								}else{

								$orders['d_z']=($lv['percent_proxy']/100)*$value['money'];
								}
							}
						}
					}
				}
				// 各层回水获取
				$oddsset=$odb->get_odds($uid,$orders['o_type2'],$post_n_m[0],$plate['plate_num'],$value['money']);
				$orders['h_tui']=$oddsset['tuishui'];
				$orders['d_tui']=$oddsset['d_tui'];
				$orders['zd_tui']=$oddsset['zd_tui'];
				$orders['gd_tui']=$oddsset['gd_tui'];
				$orders['f_tui']=$oddsset['f_tui'];
				$orders['orders_p']=$oddsset['oddsset'];


				$orders['plate_num']=$plate['plate_num'];  //期数
				$orders['o_type3']=$post_n_m[0]; //号码
				if($_POST['post_money']!=='0'){
					$orders['orders_y']=$post_n_m[1];
					$new_money=$old_money-$post_n_m[1];
				}
				$orders['topf_id']=$user_top['branch']['user_id']; //分公司id
				$orders['topgd_id']=$user_top['partner']['user_id']; //股东id
				$orders['topzd_id']=$user_top['proxy_all']['user_id']; //总代理id
				$orders['topd_id']=$user_top['proxy']['user_id']; //代理id
				$order_no=$db->get_one('select order_no from orders where user_id='.$uid.' and is_cloce=0');
				if (!empty($order_no)) {
					$orders['order_no']=$order_no['order_no'];
				}else{
					$orders['order_no']=$plate['plate_num'].$uid.time();
				}
				$orders['is_water']=1;
				$res=$db->get_insert('orders',$orders);
				if ($res) {
					$cg=1;
					$sb=0;
				}else{
					$cg=0;
					$sb=1;
				}
			$db->get_update('users',array('credit_remainder'=>$new_money),'user_id='.$uid);
			$data['res']='ok';
			echo json_encode($data);
		}
	}
	
}
if ($_GET['o_type3']) {
	$res=$db->get_update('orders',array('o_type3'=>$_GET['o_type3']),'id='.$_GET['order_id']);
	if ($res) {
		$data['res']='ok';
		echo json_encode($data);
	}
}
if ($_GET['act']=='user_list') {
	if ($_GET['stop']=='0') {
		$stop=1;
	}else{
		$stop=0;
	}
	$res=$db->get_update('users',array('stop_water'=>$stop),'user_id='.$_GET['user_id']);
	if ($res) {
		$data['res']='ok';
		echo json_encode($data);
	}
}

if ($_GET['act']=='del') {
	if (!empty($_GET['user_id'])) {
		$url='sx_list.php?user_id='.$_GET['user_id'];
	}else{
		$url='sx_list.php';
	}
	$opera_water=$db->get_one('select opera_water from users where user_id='.$_GET['user_id']);
	$orders_y=$db->get_one('select orders_y from orders where id='.$_GET['id']);
	$new_water=$opera_water['opera_water']-$orders_y['orders_y'];
	$db->get_update('users',array('opera_water'=>$new_water),'user_id='.$_GET['user_id']);
	$db->delete('orders', 'id='.$_GET['id'], $url);
}

if ($_GET['act']=='edit_a') {
	if (empty($_GET['num_a'])) {
		$_GET['num_a']='0';
	}
		$water_num=$db->get_all('select id,o_type3 from orders where is_water=1');
		foreach ($water_num as $key => $value) {
			$frist = substr( $value['o_type3'], 0, 1 );
			if ($frist==$_GET['num_a']) {
				$frist=get_rand_num($_GET['num_a']);
			}
			$water_num[$key]['o_type3']=$frist.substr($value['o_type3'],1);
			$db->get_update('orders',array('o_type3'=>$water_num[$key]['o_type3']),' id='.$value['id']);
		}
		$db->get_admin_msg( "sx_list.php", "操作成功" );
}

function get_rand_num($num_a)
{
    $num = rand(0,9);
    if($num == $num_a)
    {
        $num = get_rand_num();
    }
    return $num;
}
?>