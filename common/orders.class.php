<?php
	class orders extends mysql {
		/**
		 * [get_odds description]
		 * @param  [type] $user_id [用户id]
		 * @param  [type] $o_type2 [下注类型]
		 * @param  [type] $number  [下注码]
		 * @param  [type] $plate_num  [期数]
		 * @param  [type] $money  [下注金额]
		 * @return [type]          [输出赔率]
		 */
	public function get_odds($user_id,$o_type2,$number='',$plate_num='',$money=0){
		// return $number;
		if ($o_type2=='口口口口') {
			$o_type2='四字定';
		}
		// $is_disa=$this->get_one('select is_disa from oddsset_type where user_id=0 and  o_typename="'.$o_type2.'"');
		// if ($is_disa['is_disa']=='1') {
		// 	return 'is_disa';
		// }
		// 获取赔率限额
		$outo_set=$this->get_one('select * from autorain_set where o_typename="'.$o_type2.'"');
		// 获取下降记录
		$rain_set=$this->get_one('select * from rain_set where number="'.$number.'"');
		if (empty($rain_set)) {
			$rain_set['auto_num']='';
		}
		// var_dump($rain_set);exit;
		if ($outo_set['is_use']==1) {
			$desc_limit=$this->get_one('select SUM(orders_y) as orders_y from orders where stattuima=0 and user_id='.$user_id.' and o_type3="'.$number.'" and plate_num='.$plate_num);
		// return ($desc_limit['orders_y']+$money);
			if (!empty($desc_limit['orders_y'])) {
				if ($outo_set['autodesc_limit']>($desc_limit['orders_y']+$money)) {
					$desc_odds=0;
				}else{
					// $desc_odds=$outo_set['desc_odds']+$rain_set['auto_num'];
					$data=array();
					if ($rain_set['auto_num']!='') {
						// $data['auto_num']=$desc_odds;
						$time_sum=(int)((time()-$rain_set['auto_time'])/60);
						$desc_odds=$time_sum*$rain_set['auto_num'];
					}else{
						$desc_odds=$outo_set['desc_odds'];
						$data['auto_time']=time();
						$data['auto_num']=$outo_set['desc_odds'];
						$data['number']=$number;
						$this->get_insert('rain_set',$data);
					}
				}
			}else{
				$desc_odds=0;
			}
			// var_dump($desc_limit);var_dump($outo_set['autodesc_limit']);exit;
		}else{
			$desc_odds=0;
		}
		if (($desc_odds*10)>=1) {
			$desc_odds="0.1";
		}
		$gs_odds=$this->get_one('select oddsset from tuishui_set where user_id=0 and typename="'.$o_type2.'"');
		$oddsset=$this->get_one('select * from tuishui_set where user_id='.$user_id.' and typename="'.$o_type2.'"');
		// 二字定
		if ($o_type2=='口X口X' || $o_type2=='口XX口' || $o_type2=='口口XX' || $o_type2=='X口口X' || $o_type2=='XX口口' || $o_type2=='X口X口') {
				$gs_odds['oddsset']=$gs_odds['oddsset']/100;
				$gs_odds['oddsset']=$gs_odds['oddsset']-$desc_odds;
				$oddsset['oddsset']=($gs_odds['oddsset']-$oddsset['tuishui']-$oddsset['d_tui']-$oddsset['zd_tui']-$oddsset['gd_tui']-$oddsset['fg_tui'])*100;
		}
		if ($o_type2=='口口口X' || $o_type2=='口X口口' || $o_type2=='X口口口' || $o_type2=='口口X口') {
				$gs_odds['oddsset']=$gs_odds['oddsset']/1000;
				$gs_odds['oddsset']=$gs_odds['oddsset']-$desc_odds;
				$oddsset['oddsset']=($gs_odds['oddsset']-$oddsset['tuishui']-$oddsset['d_tui']-$oddsset['zd_tui']-$oddsset['gd_tui']-$oddsset['fg_tui'])*1000;
		}
		if ($o_type2=='四字定' || $o_type2=='口口口口') {
				$gs_odds['oddsset']=$gs_odds['oddsset']/10000;
				$gs_odds['oddsset']=$gs_odds['oddsset']-$desc_odds;
				$oddsset['oddsset']=($gs_odds['oddsset']-$oddsset['tuishui']-$oddsset['d_tui']-$oddsset['zd_tui']-$oddsset['gd_tui']-$oddsset['fg_tui'])*10000;
		}
		if ($o_type2=='二字现') {
				// strstr ( $gs_odds['oddsset'] ,  '/' ,  true );
				$gs_odds['oddsset']=$gs_odds['oddsset']/10;
				$gs_odds['oddsset']=$gs_odds['oddsset']-$desc_odds;
				$oddsset['oddsset']=($gs_odds['oddsset']-$oddsset['tuishui']-$oddsset['d_tui']-$oddsset['zd_tui']-$oddsset['gd_tui']-$oddsset['fg_tui'])*10;
			}
		if ($o_type2=='三字现') {
				// strstr ( $gs_odds['oddsset'] ,  '/' ,  true );
				$gs_odds['oddsset']=$gs_odds['oddsset']/100;
				$gs_odds['oddsset']=$gs_odds['oddsset']-$desc_odds;
				$oddsset['oddsset']=($gs_odds['oddsset']-$oddsset['tuishui']-$oddsset['d_tui']-$oddsset['zd_tui']-$oddsset['gd_tui']-$oddsset['fg_tui'])*100;
			}
		if ($o_type2=='四字现') {
				// strstr ( $gs_odds['oddsset'] ,  '/' ,  true );
				$gs_odds['oddsset']=$gs_odds['oddsset']/100;
				$gs_odds['oddsset']=$gs_odds['oddsset']-$desc_odds;
				$oddsset['oddsset']=($gs_odds['oddsset']-$oddsset['tuishui']-$oddsset['d_tui']-$oddsset['zd_tui']-$oddsset['gd_tui']-$oddsset['fg_tui'])*100;
			}
		return $oddsset;
	}
	/**
	 * 获取所以会员的注单
	 * @param  [type] $user_id [description]
	 * @param  [type] $power   [description]
	 * @return [type]          [description]
	 */
	public function get_son_user($user_id,$power,$plate_num){
		if ($power=='6') {
			$user=$this->get_all('select user_id,user_power,top_id from users where user_id ='.$user_id);
		}else{
			$user=$this->get_all('select user_id,user_power,top_id from users where top_id in('.$user_id.')');
		}
		if ($user[0]['user_power']!='6') {
			$all_id='';
			foreach ($user as $key => $value) {
				$all_id .=$value['user_id'].',';
			}
			$all_id=rtrim($all_id,',');
			return $this->get_son_user($all_id);  //回调
		}else{
			$all_id='';
			foreach ($user as $key => $value) {
				$all_id .=$value['user_id'].',';
			}
			$all_id=rtrim($all_id,',');
			$orders=$this->get_all('select * from orders where stattuima=0 and plate_num='.$plate_num.' and user_id in('.$all_id.')');
			return $orders;
		}
	}
} 
?>