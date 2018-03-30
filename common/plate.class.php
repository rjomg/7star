<?php
class plate extends mysql {
    public function add_plate($params,$url=''){

            
            //下面是添加盘口数据
            //$dangqianqishu_arr=$this->dangqianqishu_arr();
            $columnName='';
            $value='';
            foreach ($params as $key => $v) {
//                if($key=='last_special' && $v==1){
//                    $v=$dangqianqishu_arr['last_special'];
//                }
//                if($key=='adrop' && $v==0){
//                    $v=$dangqianqishu_arr['adrop'];
//                }
                $columnName.=$key.',';
                $value.="'".$v."',";
            }
            if($value){
                $columnName=  substr($columnName, 0, -1);
                $value=  substr($value, 0, -1);
            }
            $autoadds= $this->select("plate_autoadd", "id","plate_num='{$params['plate_num']}' order by plate_num desc limit 0,1");
            $autoadd= $this->fetch_array($autoadds);
            if(empty($autoadd['id'])){
            $this->insert("plate_autoadd", $columnName, $value);//同步添加自动盘口表数据
            }
            
            $iss7 = $this->select('plate', 'open_num,plate_num', '1 order by plate_num desc ');
            $is7 = $this->fetch_array($iss7);
            if($is7['open_num']==7 && $is7['plate_num']<$params['plate_num']){
                $yodds_set= $this->select("odds_set", "plate_num","plate_num='{$params['plate_num']}' order by plate_num desc limit 0,1");
                $zodds_set= $this->fetch_array($yodds_set);
                if(empty($zodds_set['plate_num'])){
                    //查用户最新的期数赔率来生成，避免下次要重新设置赔率才下注。
                    //会员那边显示的赔率是距上级的赔率
                    //添加盘口时要添加所有用户的赔率设置
                    $users =  $this->select("users", "user_id","user_power<3 order by user_id asc");
                    $us=array();
                    while ($row = $this->fetch_array($users)) {
                        $us[] = $row['user_id'];
                    }
                    foreach ($us as $uid) {               
                        $y= $this->select("odds_set", "plate_num","user_id='$uid' order by plate_num desc limit 0,1");
                        $z= $this->fetch_array($y);
                        $plate_num=$z['plate_num'];
                        if(empty($plate_num)){
                            $plate_num=0;
                            $uid2=0;
                        }else{
                            $uid2=$uid;
                            $this->add_user_plate_num_odds($uid2,$plate_num);
                        }
                        $sql="insert ignore into odds_set select $uid,'{$params['plate_num']}',o_id,o_content,ab_content from odds_set where user_id=$uid2 and plate_num=$plate_num";
                        $this->query($sql);
                    }
                }
            $this->insert("plate", $columnName, $value);
            }
            $this->Get_admin_msg($url, '添加成功！');
    }
    
    public function update_plate($params,$url){
            $iss = $this->select('plate', 'plate_num', '1 order by plate_num desc ');
            $is = $this->fetch_array($iss);
            
            $_POST=$params;
            $mod_content='';
            foreach ($params as $key => $v) {
                if($key!='plate_num'){
                    
                    if($v < 10 && $key!='adrop' && $key!='animal_set_id'){
                        $v = (int)$v;
                        $v=$v;
                    }
                    $mod_content.="$key='$v',";
                }
            }
            if($mod_content){
                $mod_content=  substr ($mod_content, 0, -1);
            }
            if($is['plate_num']>=$params['plate_num']){
            $this->update("plate", "$mod_content", 'plate_num='.$params['plate_num']);
            }
            $this->update("plate_autoadd", "$mod_content", 'plate_num='.$params['plate_num']);
            
            $nowtime=  time();
           if(empty($_POST['is_auto']) and empty($_POST['is_plate_starts'])){
                if($nowtime>=strtotime($_POST['plate_time_satrt']) and $nowtime<=strtotime($_POST['special_time_end'])){
                    $is_special=1;//开
                }else{
                    $is_special=0;//封
                }
                if($nowtime>=strtotime($_POST['plate_time_satrt']) and $nowtime<=strtotime($_POST['normal_time_end'])){
                    $is_normal=1;
                }else{
                    $is_normal=0;
                }
                if($nowtime>=strtotime($_POST['plate_time_satrt']) and $nowtime<=strtotime($_POST['plate_time_end'])){
                    $is_plate_start=0;//开
                }else{
                    $is_plate_start=1;//封
                }
                if($is['plate_num']>=$params['plate_num']){
                $this->query("update plate set is_special=$is_special,is_normal=$is_normal,is_plate_start=$is_plate_start where plate_num={$_POST['plate_num']}");
                }
                $this->query("update plate_autoadd set is_special=$is_special,is_normal=$is_normal,is_plate_start=$is_plate_start where plate_num={$_POST['plate_num']}");

            }
            if($_POST['open_num']>0 && $_POST['open_num']<7){
                $this->Get_admin_msgtopnull($url);
            }elseif($_POST['open_num']==7){
                $iss2 = $this->select('plate_autoadd', 'plate_num', 'open_num<7 order by plate_num asc  limit 0,1');
                $is2 = $this->fetch_array($iss2);
                if($is2['plate_num']>$params['plate_num']){
                                    $yodds_set= $this->select("odds_set", "plate_num","plate_num='{$is2['plate_num']}' order by plate_num desc limit 0,1");
                                    $zodds_set= $this->fetch_array($yodds_set);
                                    if(empty($zodds_set['plate_num'])){
                                        //查用户最新的期数赔率来生成，避免下次要重新设置赔率才下注。
                                        //会员那边显示的赔率是距上级的赔率
                                        //添加盘口时要添加所有用户的赔率设置
                                        $users =  $this->select("users", "user_id","user_power<3 order by user_id asc");
                                        $us=array();
                                        while ($row = $this->fetch_array($users)) {
                                            $us[] = $row['user_id'];
                                        }
                                        foreach ($us as $uid) {               
                                            $y= $this->select("odds_set", "plate_num","user_id='$uid' order by plate_num desc limit 0,1");
                                            $z= $this->fetch_array($y);
                                            $plate_num=$z['plate_num'];
                                            if(empty($plate_num)){
                                                $plate_num=0;
                                                $uid2=0;
                                            }else{
                                                $uid2=$uid;
                                                $this->add_user_plate_num_odds($uid2,$plate_num);
                                            }
                                            $sql="insert ignore into odds_set select $uid,'{$is2['plate_num']}',o_id,o_content,ab_content from odds_set where user_id=$uid2 and plate_num=$plate_num";
                                            $this->query($sql);
                                        }
                                    }
                    $this->query("insert into plate select * from plate_autoadd where plate_num={$is2['plate_num']}");//copy现有的期数到plate表
                }
                //自动还原信用额度
                $animal_sets = $this->select('animal_set', 'w_is_creditline', 'id>0 order by id desc  limit 0,1');
                $animal_set = $this->fetch_array($animal_sets);
                if($animal_set['w_is_creditline']){
                                $sqlusers = "select user_id,credit_total from users where user_power=6";
                                $infouser = mysql_query($sqlusers);
	                        while($rw = mysql_fetch_array($infouser)){
		                $credit= $rw['credit_total'];
		                $id= $rw['user_id'];
		                $updateuserssql ="UPDATE users  set credit_remainder = '$credit',bet_times=0,opera_water=0 where user_id = '$id'" ;		
		                $queryusers = mysql_query($updateuserssql);
		                }
                }  
                mysql_query("UPDATE users  set bet_times=0,opera_water=0");
                $this->Get_admin_msg('his.php', '开奖成功！');
            }else{
                $this->Get_admin_msg($url, '修改盘口成功');
            }
        }
        
    public function get_all_page_plate($tj,$count=10){
        $query=  $this->select("plate", "count(*) as c",$tj);
        $row=  $this->fetch_array($query);
        if($row['c']%10==0){
            $all_page=$row['c']/$count;
        }else{
            $all_page=($row['c']-$row['c']%$count)/$count+1;
        }
        return $all_page;
    }
    
    public function get_plate_limit($page,$tj='',$count=10){
        $start=($page-1)*$count;
        $query=  $this->select("plate", "*", "num_g!=0 ".($tj?"and $tj":'')." order by plate_num desc limit $start,$count");
        return $query;
    }
    

}
?>