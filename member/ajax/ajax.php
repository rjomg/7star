<?php 
include_once( "../../global.php" );
header("Content-type:text/html;charset=utf-8");
$db = new action( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
$odb = new orders( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
$query = $db->select( "plate order by id desc", "*", "" );
$uid = $_SESSION['uid'.$c_p_seesion];	
$plate = $db->fetch_array( $query );
$user_one=$db->get_one('select is_lock from users where user_id='.$uid);
$top_lh=$db->get_all('select o_ccupy_money,o_typename,percent_proxy from oddsset_type left join users on oddsset_type.user_id=users.top_id where oddsset_type.o_ccupy_money >0 and users.percent_proxy>0 and users.user_id='.$uid);
$oddsset=$db->get_all('select o_typename,o_dzlimit,o_dxlimit from oddsset_type where user_id=0');

//获取所有上级信息
$db->get_tops($_SESSION['uid'.$c_p_seesion]);
$user_top=$db->tops;

if ($plate['is_plate_start']=='1') {
	$endtime=time()-1;
}else{
	$endtime=strtotime($plate['plate_time_end']);
}

$i=0;
// var_dump($plate['plate_time_satrt']);exit;
	if (!$_POST && !$_GET) {	
		$data['starttime']=strtotime($plate['plate_time_satrt']);
		$data['systime']=time();
		$data['endtime']=$endtime;
		$data['openmode']=1;
		$data['issueno']=$plate['plate_num'];
		$data['hash']='cddf1befb3e14856911e51a38349662a';
		echo json_encode($data);
	}
	//清空
	if ($_GET['action']=='soonprintstat') {
		$db->get_update('orders',array('is_cloce'=>1),'user_id='.$uid);
	}
	if ($_GET && $_POST && $_GET['action']!=='soonprintstat') {
		if (time()>=$endtime) {
			echo '<script>javascript:history.go(-1);alert("已经封盘了，请等下期");window.parent.parent.location.href="../main.php";</script>';exit;
		}
		if ($user_one['is_lock']==2) {	
			echo '<script>javascript:history.go(-1);alert("账号已停用");window.parent.parent.location.href="../index.php";</script>';exit;
		}
		if ($user_one['is_lock']==1) {	
			echo '<script>javascript:history.go(-1);alert("账号被冻结");window.parent.parent.location.href="../index.php";</script>';exit;
		}
		if ($user_one['is_lock']==3) {
			echo '<script>javascript:history.go(-1);alert("账号已停止下注，请联系上级更改");</script>';exit;
		}
	}
	/**
	 * 快选下注
	 */
	if ($_POST && $_GET['action']=='soonselect') {
		$get_string=explode('|||',$_POST['get_string']);
		switch ($get_string[0]){
			case 'classid=1':
			  $orders['o_type1']='二字定';
			  break;
			case 'classid=2':
			  $orders['o_type1']='三字定';
			  break;
			case 'classid=3':
			  $orders['o_type1']='四字定';
			  break;
			case 'classid=4':
			  $orders['o_type1']='二字现';
			  break;
			case 'classid=5':
			  $orders['o_type1']='三字现';
			  break;
			case 'classid=6':
			  $orders['o_type1']='四字现';
			  break;
			default:
			  $orders['o_type1']='不符合';
		}
		$send_data=json_decode(stripslashes($_POST['send_data']),'true');
		$orders['time']=time(); //下注时间
		$orders['user_id']=$uid; //下注用户
		$html='';
		$totalmoney=$db->get_one('select * from users where user_id='.$uid);
		$old_money=$totalmoney['credit_remainder'];
		foreach ($send_data as $key => $value) {
			$orders['o_type2']=''; //类型2如口口XX
			$number=str_split($value['number']);
			foreach ($number as $k => $val) {
				if ($val!=='X') {
					$orders['o_type2'].='口';
				}else{
					$orders['o_type2'].='X';
				}
			}
			$o_type2='"'.$orders['o_type2'].'"';
			if ($orders['o_type2']=='口口口口' && $get_string[0]=='classid=3') {
				$o_type2='"四字定"';
			}
			if ($orders['o_type2']=='口口') {
				$orders['o_type2']='二字现';
				$o_type2='"二字现"';
			}
			if ($orders['o_type2']=='口口口') {
				$orders['o_type2']='三字现';
				$o_type2='"三字现"';
			}
			if ($orders['o_type2']=='口口口口' && $get_string[0]=='classid=6') {
				$orders['o_type2']='四字现';
				$o_type2='"四字现"';
			}
			if (!empty($top_lh)) {
				$sum_y=$db->get_all('select SUM(orders_y) as orders_y from orders where user_id='.$uid.' and plate_num='.$plate['plate_num'].' and o_type2='.$value['member']);
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
			$oddsset=$odb->get_odds($uid,$orders['o_type2'],$value['number'],$plate['plate_num'],$value['money']);
			// var_dump($oddsset);exit;
			$orders['h_tui']=$oddsset['tuishui'];
			$orders['d_tui']=$oddsset['d_tui'];
			$orders['zd_tui']=$oddsset['zd_tui'];
			$orders['gd_tui']=$oddsset['gd_tui'];
			$orders['f_tui']=$oddsset['fg_tui'];
			$orders['orders_p']=$oddsset['oddsset'];

			$orders['plate_num']=$plate['plate_num'];  //期数
			$orders['o_type3']=$value['number']; //号码
			$orders['orders_y']=$value['money']; //下注金额
			$orders['topf_id']=$user_top['branch']['user_id']; //分公司id
			$orders['topgd_id']=$user_top['partner']['user_id']; //股东id
			$orders['topzd_id']=$user_top['proxy_all']['user_id']; //总代理id
			$orders['topd_id']=$user_top['proxy']['user_id']; //代理id
			$old_money=$old_money-$value['money'];
			$order_no=$db->get_one('select order_no from orders where user_id='.$uid.' and is_cloce=0');
			if (!empty($order_no)) {
				$orders['order_no']=$order_no['order_no'];
			}else{
				$orders['order_no']=$plate['plate_num'].$uid.time();
			}
			$columnName='';
			$v='';
			foreach ($orders as $o_key => $o_val) {
                $columnName.=$o_key.',';
                $v.="'".$o_val."',";
            }
            if($value){
                $columnName=  substr($columnName, 0, -1);
                $v=  substr($v, 0, -1);
            }
            $a=$db->insert("orders", $columnName, $v);//下注
            if ($a) {
            	$new_orders[$key]=$orders;
            }
            $html .= '<tr bgcolor="#ffffff" class="print2"  style="height:28px;line-height:19px;"> ';
			$html .= '<td style="text-align:center;">'.$value['number'].'</td><td style="text-align:center;">'.$orders['orders_p'].'</td><td style="text-align:center;">'.$value['money'].'</td>';
			$html .= '</tr>';
		}
		$db->get_update('users',array('credit_remainder'=>$old_money),'user_id='.$uid);
		$old_bet_times=$db->get_one('select bet_times from users where user_id='.$uid);
		$bet_times=(int)$old_bet_times['bet_times']+1;
		$db->get_update('users',array('bet_times'=>$bet_times),'user_id='.$uid);
		echo json_encode(array('new_orders'=>$html));
	}
	/**
	 * 快打显示
	 */
	if ($_GET['action']=='chacknumbermoney') {
		$str='';
		$uid = $_SESSION['uid'.$c_p_seesion];	
		if($uid){
		$info = mysql_fetch_array(mysql_query("select * from users  where user_id = '$uid'"));	 
		}
		// var_dump($info);
		if ($info['credit_remainder']>0) {
			$str[0]=1;
			$str[1]=$info['credit_remainder'];
		}
		$number=$_GET['post_number'];
		if ($_GET['sizixian']=='1') {
			$oddsset=$odb->get_odds($uid,'四字定',$number,$plate['plate_num'],$value['money']);
			$str[2]=$oddsset['oddsset'];
		}
		if ($_GET['sizixian']=='0') {
			$oddsset=$odb->get_odds($uid,'四字定',$number,$plate['plate_num'],$value['money']);
			$str[2]=$oddsset['oddsset'];
		}
		// $str=implode('|',$str);
		echo json_encode($str);
	}
	// 二字定选码
	if ($_GET['action']=='numberfrank') {
		$classid=$_GET['childid'];
		$str=time().'@@';
		// var_dump($classid);
		$typename=$classid ? $classid:'口XX口';
		$oddsset=$odb->get_odds($uid,$typename);
		if ($classid=='' || $classid=='口XX口') {
			for ($i=0; $i < 10; $i++) { 
				for ($y=0; $y < 10; $y++) { 
						$str.=$i.'|';
						$str.=$i.'XX'.$y.'|';
						$str.=$oddsset['oddsset'].'|';
						$str.='16500|';
						$str.='99'.'`';
				}
			}
			$str.='@@98.5@@0.107697@@204=';
			echo $str;
		}
		if ($classid=='口口XX') {
			for ($i=0; $i < 10; $i++) { 
				for ($y=0; $y < 10; $y++) { 
						$str.=$i.'|';
						$str.=$i.$y.'XX'.'|';
						$str.=$oddsset['oddsset'].'|';
						$str.='16500|';
						$str.='99'.'`';
				}
			}
			$str.='@@98.5@@0.107697@@204=';
			echo $str;
		}
		if ($classid=='口X口X') {
			for ($i=0; $i < 10; $i++) { 
				for ($y=0; $y < 10; $y++) { 
						$str.=$i.'|';
						$str.=$i.'X'.$y.'X'.'|';
						$str.=$oddsset['oddsset'].'|';
						$str.='16500|';
						$str.='99'.'`';
				}
			}
			$str.='@@98.5@@0.107697@@204=';
			echo $str;
		}
		if ($classid=='X口X口') {
			for ($i=0; $i < 10; $i++) { 
				for ($y=0; $y < 10; $y++) { 
						$str.=$i.'|';
						$str.='X'.$i.'X'.$y.'|';
						$str.=$oddsset['oddsset'].'|';
						$str.='16500|';
						$str.='99'.'`';
				}
			}
			$str.='@@98.5@@0.107697@@204=';
			echo $str;
		}
		if ($classid=='X口口X') {
			for ($i=0; $i < 10; $i++) { 
				for ($y=0; $y < 10; $y++) { 
						$str.=$i.'|';
						$str.='X'.$i.$y.'X'.'|';
						$str.=$oddsset['oddsset'].'|';
						$str.='16500|';
						$str.='99'.'`';
				}
			}
			$str.='@@98.5@@0.107697@@204=';
			echo $str;
		}
		if ($classid=='XX口口') {
			for ($i=0; $i < 10; $i++) { 
				for ($y=0; $y < 10; $y++) { 
						$str.=$i.'|';
						$str.='XX'.$i.$y.'|';
						$str.=$oddsset['oddsset'].'|';
						$str.='16500|';
						$str.='99'.'`';
				}
			}
			$str.='@@98.5@@0.107697@@204=';
			echo $str;
		}
	}
 // 二字定下注
	if ($_GET['action']=='soonselectnumber') {
		
		$post_n_m=explode(',',$_POST['post_number_money']);
		foreach ($post_n_m as $key => $value) {
			$n_m[$key]=explode('|',$value);
		}
		$totalmoney=$db->get_one('select * from users where user_id='.$uid);
		$old_money=$totalmoney['credit_remainder'];
		$orders['time']=time(); //下注时间
		$orders['user_id']=$uid; //下注用户
		$orders['o_type1']='二字定';

		foreach ($n_m as $k => $v) {
			$jiner +=$v[1];//
		}


		foreach ($n_m as $k => $v) {
			$orders['o_type2']=''; //类型2如口口XX
			$number=str_split($v[0]);
			foreach ($number as $k => $val) {
				if ($val!=='X') {
					$orders['o_type2'].='口';
				}else{
					$orders['o_type2'].='X';
				}
			}
			$o_type2='"'.$orders['o_type2'].'"';
			
			//$v[1]金额  $v[0]类型
			foreach ($oddsset as $key => $value) {
				if(str_replace('口','0',$value['o_typename'])==$v[0]){
					if($value['o_dzlimit']<$v[1]){
						echo '<script>alert("填写的金额不能超出单注上限'.$value['o_dzlimit'].'!");</script>';
						exit;
					}

					if($jiner>$value['o_dxlimit']){
						echo '<script>alert("填写的金额不能超出单项上限'.$value['o_dxlimit'].'!");</script>';
						exit;
					}
				}

			}
			



			if (!empty($top_lh)) {
				$sum_y=$db->get_all('select SUM(orders_y) as orders_y from orders where user_id='.$uid.' and plate_num='.$plate['plate_num']);
				// var_dump($sum_y);exit;
				foreach ($top_lh as $lk => $lv) {
					file_put_contents('1.txt', $lv, FILE_APPEND);
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
			$oddsset=$odb->get_odds($uid,$orders['o_type2'],$v[0],$plate['plate_num'],$value['money']);
			$orders['h_tui']=$oddsset['tuishui'];
			$orders['d_tui']=$oddsset['d_tui'];
			$orders['zd_tui']=$oddsset['zd_tui'];
			$orders['gd_tui']=$oddsset['gd_tui'];
			$orders['f_tui']=$oddsset['f_tui'];
			$orders['orders_p']=$oddsset['oddsset'];


			$orders['plate_num']=$plate['plate_num'];  //期数
			$orders['o_type3']=$v[0]; //号码
			if($_POST['post_money']!=='0'){
				$orders['orders_y']=$_POST['post_money'];
				$old_money=$old_money-$_POST['post_money'];
			}else{
				$orders['orders_y']=$v[1]; //下注金额
				$old_money=$old_money-$v[1];
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
			$db->get_insert('orders',$orders);
		}
		$db->get_update('users',array('credit_remainder'=>$old_money),'user_id='.$uid);
		$old_bet_times=$db->get_one('select bet_times from users where user_id='.$uid);
		$bet_times=(int)$old_bet_times['bet_times']+1;
		$db->get_update('users',array('bet_times'=>$bet_times),'user_id='.$uid);
		echo '<script>javascript:history.go(-1);window.parent.parent.frames["menu"].location.reload();window.parent.parent.location.reload();</script>';
	}

    // 快打下注
	if ($_GET['action']=='soonsend') {
		$post_n_m=explode(',',$_POST['post_number']);
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
        if ($orders['o_type2']=='口口') {
            $orders['o_type2']='二字现';
            $o_type2='"二字现"';
            $show = "1";
        }
        if ($orders['o_type2']=='口口口') {
            $orders['o_type2']='三字现';
            $o_type2='"三字现"';
            $show = "1";
        }
        if ($orders['o_type2']=='口口口口' && $get_string[0]=='classid=6') {
            $orders['o_type2']='四字现';
            $o_type2='"四字现"';
            $show = "1";
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
        $orders['h_tui'] = $oddsset['tuishui']? $oddsset['tuishui']:'0';
        $orders['d_tui'] = $oddsset['d_tui']? $oddsset['d_tui']:'0';
        $orders['zd_tui'] = $oddsset['zd_tui']? $oddsset['zd_tui']:'0';
        $orders['gd_tui'] = $oddsset['gd_tui']? $oddsset['gd_tui']:'0';
        $orders['f_tui'] = $oddsset['fg_tui']? $oddsset['fg_tui']:'0';
        $orders['orders_p'] = $oddsset['oddsset']? $oddsset['oddsset']:'0'; // 赔率
        $orders['show'] = $show? $show:'0'; // 现

//        $orders['h_tui']=$oddsset['tuishui'];
//        $orders['d_tui']=$oddsset['d_tui'];
//        $orders['zd_tui']=$oddsset['zd_tui'];
//        $orders['gd_tui']=$oddsset['gd_tui'];
//        // 分公司退水back
////        $orders['f_tui']=$oddsset['f_tui'];
//        $orders['f_tui']=$oddsset['fg_tui'];
//        $orders['orders_p']=$oddsset['oddsset'];


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
        print_r($orders);
        $res=$db->get_insert('orders',$orders);
        if ($res) {
            $cg=1;
            $sb=0;
        }else{
            $cg=0;
            $sb=1;
        }
		$db->get_update('users',array('credit_remainder'=>$new_money),'user_id='.$uid);
		$old_bet_times=$db->get_one('select bet_times from users where user_id='.$uid);
		$bet_times=(int)$old_bet_times['bet_times']+1;
		$db->get_update('users',array('bet_times'=>$bet_times),'user_id='.$uid);
		echo '<script>javascript:history.go(-1);window.parent.parent.frames["menu"].location.reload();window.location.reload();</script>';
		$yh=$totalmoney["credit_total"]-$new_money;
		echo '!@#%0!@#%!@#%0!@#%4!@#%'.$new_money.'!@#%'.$yh.'!@#%'.$totalmoney["credit_total"].'!@#%0!@#%default!@#%1!@#%0.023182!@#%'.$cg.'!@#%'.$sb;
		
	}
	if ($_GET['action']=='resetOrder') {
		// echo '2!@#%{"s":1,"j":[{"id":2274727,"orderid":"14804021017515252","frank":"8720","number":"5687","money":1,"hotstat":0,"classid":5,"stattuima":0,"datetime":1486720305,"statsizi":0}],"d":1486720305,"t":1800,"m":1,"p":{"n":[1,1],"j":0,"o":"14804021017515252","oid":2274727,"d":"2017-02-10 17:51","u":"hg008","s":"uFzjw4","i":17015,"t":0,"m":1,"ps":0}}!@#%0!@#%!@#%0!@#%4!@#%1!@#%5!@#%0!@#%0!@#%default!@#%1!@#%0.023182!@#%10!@#%0';
		// echo '!@#%0!@#%!@#%0!@#%4!@#%1!@#%5!@#%0!@#%0!@#%default!@#%1!@#%0.023182!@#%10!@#%0';
		// echo json_encode($data);
	}

	if($_GET['action'] == 'memberinput') {
		$data = array();
		$type = 0;
		$fp = fopen($_FILES['fileinput']['tmp_name'],"r");
		if ($fp){
			while(($line = fgets($fp)) !== false){
				$line = iconv("GBK","UTF-8//IGNORE",$line);
				$line = preg_replace("/[\s，]+/i",",",$line);
				$temp = explode(",",$line);
				foreach ($temp as &$item) {
					if ($item){
						if (!$type) {
							$type = strpos($item,"=")!==false ? 2 : 1; 
						}
						if ($type == 1) {
							if (strpos($item,"=")===false) {
								$data['data'][] = $item;
							}
						} else {
							if (strpos($item,"=") !== false) {
								$_t = array();
								list($_t['number'],$_t['money']) = explode("=",trim($item));
								$data['data'][] = $_t;
							}
						}
					}
				}
			}
			$data['type'] = $type;
			echo json_encode($data);
		}
	}
?>