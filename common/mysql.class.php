<?php
if (!session_id()) session_start();
$_SESSION['fsess']=($_SESSION['fsess'])?$_SESSION['fsess']:time();//刷新禁止重新提交表单身份证
class mysql {
	private $db_host; //数据库主机
	private $db_user; //数据库用户名
	private $db_pwd; //数据库用户名密码
	private $db_database; //数据库名
	private $conn; //数据库连接标识;
	private $result; //执行query命令的结果资源标识
	private $sql; //sql执行语句
	private $row; //返回的条目数
	private $coding; //数据库编码，GBK,UTF8,gb2312
	private $bulletin = true; //是否开启错误记录
	private $show_error = true; //测试阶段，显示所有错误,具有安全隐患,默认关闭
	private $is_error = false; //发现错误是否立即终止,默认true,建议不启用，因为当有问题时用户什么也看不到是很苦恼的
        public $tops=array();
        
	/*构造函数*/
	public function __construct($db_host, $db_user, $db_pwd, $db_database, $conn, $coding) {
		$this->db_host = $db_host;
		$this->db_user = $db_user;
		$this->db_pwd = $db_pwd;
		$this->db_database = $db_database;
		$this->conn = $conn;
		$this->coding = $coding;
		$this->connect();
                
	}
        
        //多登陆设置
        public function c_p_seesion() {
                $a_a= $_SERVER['REQUEST_URI']; 
                $a_ag= '/ag/'; 
                $a_admin= '/admin/'; 
                $a_member='/member/';
                $a_c1=explode($a_ag,$a_a); 
                $a_c2=explode($a_admin,$a_a); 
                $a_c3=explode($a_member,$a_a); 
                if(count($a_c1)>1){
                    $c_p_seesio=1;
                }elseif(count($a_c2)>1){
                    $c_p_seesio=2;
                }elseif(count($a_c3)>1){    
                    $c_p_seesio=3; 
                }
		return $c_p_seesio;
	}
        

	/*数据库连接*/
	public function connect() {
		if ($this->conn == "pconn") {
			//永久链接
			$this->conn = mysql_pconnect($this->db_host, $this->db_user, $this->db_pwd);
		} else {
			//即使链接
			$this->conn = mysql_connect($this->db_host, $this->db_user, $this->db_pwd);
		}

		if (!mysql_select_db($this->db_database, $this->conn)) {
			if ($this->show_error) {
				$this->show_error("数据库不可用：", $this->db_database);
			}
		}
		mysql_query("SET NAMES $this->coding");
	}

	/*数据库执行语句，可执行查询添加修改删除等任何sql语句*/
	public function query($sql) {
		if ($sql == "") {
			$this->show_error("SQL语句错误：", "SQL查询语句为空");
		}
		$this->sql = $sql;

		$result = mysql_query($this->sql, $this->conn);

		if (!$result) {
			//调试中使用，sql语句出错时会自动打印出来
			if ($this->show_error) {
				$this->show_error("错误SQL语句：", $this->sql);
			}
		} else {
			$this->result = $result;
		}
		return $this->result;
	}

	/*创建添加新的数据库*/
	public function create_database($database_name) {
		$database = $database_name;
		$sqlDatabase = 'create database ' . $database;
		$this->query($sqlDatabase);
	}

	/*查询服务器所有数据库*/
	//将系统数据库与用户数据库分开，更直观的显示？
	public function show_databases() {
		$this->query("show databases");
		echo "现有数据库：" . $amount = $this->db_num_rows($rs);
		echo "<br />";
		$i = 1;
		while ($row = $this->fetch_array($rs)) {
			echo "$i $row[Database]";
			echo "<br />";
			$i++;
		}
	}

	//以数组形式返回主机中所有数据库名
	public function databases() {
		$rsPtr = mysql_list_dbs($this->conn);
		$i = 0;
		$cnt = mysql_num_rows($rsPtr);
		while ($i < $cnt) {
			$rs[] = mysql_db_name($rsPtr, $i);
			$i++;
		}
		return $rs;
	}

	/*查询数据库下所有的表*/
	public function show_tables($database_name) {
		$this->query("show tables");
		echo "现有数据库：" . $amount = $this->db_num_rows($rs);
		echo "<br />";
		$i = 1;
		while ($row = $this->fetch_array($rs)) {
			$columnName = "Tables_in_" . $database_name;
			echo "$i $row[$columnName]";
			echo "<br />";
			$i++;
		}
	}

	/*
	mysql_fetch_row()    array  $row[0],$row[1],$row[2]
	mysql_fetch_array()  array  $row[0] 或 $row['id']
	mysql_fetch_assoc()  array  用$row->content 字段大小写敏感
	mysql_fetch_object() object 用$row['id'],$row[content] 字段大小写敏感
	*/

	/*取得结果数据*/
	public function mysql_result_li() {
		return mysql_result($str);
	}

	/*取得记录集,获取数组-索引和关联,使用$row['content'] */
	public function fetch_array() {
		return mysql_fetch_array($this->result);
	}

	//获取关联数组,使用$row['字段名']
	public function fetch_assoc() {
		return mysql_fetch_assoc($this->result);
	}

	//获取数字索引数组,使用$row[0],$row[1],$row[2]
	public function fetch_row() {
		return mysql_fetch_row($this->result);
	}

	//获取对象数组,使用$row->content
	public function fetch_Object() {
		return mysql_fetch_object($this->result);
	}

	//简化查询select
	public function findall($table) {
		$this->query("SELECT * FROM $table");
	}

	//简化查询select
	public function select($table, $columnName = "*", $condition = '', $debug = '') {
		$condition = $condition ? ' Where ' . $condition : NULL;
		if ($debug) {
			echo "SELECT $columnName FROM $table $condition";
		} else {
			$this->query("SELECT $columnName FROM $table $condition");
		}
	}

	//简化删除del
	public function delete($table, $condition, $url = '') {
		if ($this->query("DELETE FROM $table WHERE $condition")) {
			if (!empty ($url))
				$this->Get_admin_msg($url, '删除成功！');
		}
	}

	//简化插入insert
	public function insert($table, $columnName, $value, $url = '',$ty='',$is_rate='') {
		if ($this->query("INSERT INTO $table ($columnName) VALUES ($value)")) {
                    if($ty==1){
                        $user_id =  $this->insert_id();
                        $this->start_back_set($user_id);
                        $this->set_single_set($user_id);
                        $this->set_order_back_set($user_id);
                        if($is_rate==1){
                            $this->start_set_rate($user_id);
                        }
                        $url.='&user_id='.$user_id;
                    }
                    if (!empty ($url))
                            $this->Get_admin_msg($url, '添加成功！');
                        return 1;
		}
	}
        
        public function set_order_back_set($user_id){
            $sql="insert into backorder_set select $user_id,o_typename,amode,control_limit,lowest_limit,begin_limit,is_use,o_ids,view_order from backorder_set where user_id=0";
            // 添加赔率信息
            $top_id=$this->get_one('select top_id from users where user_id='.$user_id);
        	if ($top_id['top_id']==1) {
        		$top_tuishui=$this->get_all('select * from tuishui_set where user_id=0');
        		$top_oddsset=$this->get_all('select * from oddsset_type where user_id=0');
        	}else{
        		$top_tuishui=$this->get_all('select * from tuishui_set where user_id='.$top_id['top_id']);
        		$top_oddsset=$this->get_all('select * from oddsset_type where user_id=0');
        	}
        	// var_dump($top_oddsset);exit;
        	$this->delete('tuishui_set',' user_id='.$user_id);
        	$this->delete('oddsset_type',' user_id='.$user_id);
        	foreach ($top_oddsset as $key => $value) {
        		unset($value['o_id']);
        		unset($value['o_content']);
        		$value['user_id']=$user_id;
        		$this->get_insert('oddsset_type',$value);
        	}
        	foreach ($top_tuishui as $key => $value) {
        		unset($value['t_id']);
        		$value['user_id']=$user_id;
        		$this->get_insert('tuishui_set',$value);
        	}
// 添加赔率信息end

            $this->query($sql);
        }
        
        public function start_set_rate($user_id){
            $y= $this->select("plate", "plate_num","1 order by plate_num desc limit 0,1");
            $z= $this->fetch_array($y);
            $plate_num=$z['plate_num'];
            $sql="insert ignore into odds_set select $user_id,'$plate_num',o_id,o_content,ab_content from odds_set where user_id=1 and plate_num='$plate_num'";
            $this->query($sql);
            $this->add_user_plate_num_odds($user_id,$plate_num); //当默认赔率大于公司时，这里更新
        }
        
    
    public function start_back_set($user_id){
            $q=  $this->select("users", "else_back,top_id,user_power", "user_id=$user_id");
            $r=  $this->fetch_array($q);
            $user_set=$r['else_back'];
            $top_id=$r['top_id'];
            $user_power=$r['user_power'];
            if(!$user_set){
                $user_set=0;
            }
            if($user_power==2){
                $top_id=0;
            }
            
            $sql="insert ignore into back_set select $user_id,set_name,
            (case when percent_a-$user_set >0 then percent_a-$user_set else 0 end),
            (case when percent_b-$user_set >0 then percent_b-$user_set else 0 end),
            (case when percent_c-$user_set >0 then percent_c-$user_set else 0 end),
            (case when percent_d-$user_set >0 then percent_d-$user_set else 0 end),
            bottom_limit,top_limit,odd_limit,view_order from back_set where user_id=$top_id";
            $this->query($sql);
            //$this->update_back_set_by_user_set($user_id);
    }

    //简化修改update
	public function update($table, $mod_content, $condition, $url = '') {
		//echo "UPDATE $table SET $mod_content WHERE $condition"; exit();
		if ($this->query("UPDATE $table SET $mod_content WHERE $condition")) {
			if (!empty ($url)){
                            if($table=='plate'){
                            $q=  $this->select("$table", "num_g,adrop,plate_num,open_num,last_special", "$condition");
                            $r=  $this->fetch_array($q);
                              if($r['num_g']>0){
                                  $url='his.php';
                              }
                              if($r['adrop']>0 && $r['open_num']<$r['last_special'] && $r['open_num']>0){
                              $this->update_tm_odd_down($r['plate_num'],$r['adrop']);//特码降赔
                              }
                              $this->Get_admin_msgtopnull($url);
                            }
			$this->Get_admin_msg($url);
                        }
		}
	}

	/*取得上一步 INSERT 操作产生的 ID*/
	public function insert_id() {
		return mysql_insert_id();
	}

	//指向确定的一条数据记录
	public function db_data_seek($id) {
		if ($id > 0) {
			$id = $id -1;
		}
		if (!@ mysql_data_seek($this->result, $id)) {
			$this->show_error("SQL语句有误：", "指定的数据为空");
		}
		return $this->result;
	}

	// 根据select查询结果计算结果集条数
	public function db_num_rows() {
		if ($this->result == null) {
			if ($this->show_error) {
				$this->show_error("SQL语句错误", "暂时为空，没有任何内容！");
			}
		} else {
			return mysql_num_rows($this->result);
		}
	}

	// 根据insert,update,delete执行结果取得影响行数
	public function db_affected_rows() {
		return mysql_affected_rows();
	}

	//输出显示sql语句
	public function show_error($message = "", $sql = "") {
		if (!$sql) {
			echo "<font color='red'>" . $message . "</font>";
			echo "<br />";
		} else {
			echo "<fieldset>";
			echo "<legend>错误信息提示:</legend><br />";
			echo "<div style='font-size:14px; clear:both; font-family:Verdana, Arial, Helvetica, sans-serif;'>";
			echo "<div style='height:20px; background:#000000; border:1px #000000 solid'>";
			echo "<font color='white'>错误号：12142</font>";
			echo "</div><br />";
			echo "错误原因：" . mysql_error() . "<br /><br />";
			echo "<div style='height:20px; background:#FF0000; border:1px #FF0000 solid'>";
			echo "<font color='white'>" . $message . "</font>";
			echo "</div>";
			echo "<font color='red'><pre>" . $sql . "</pre></font>";
			$ip = $this->getip();
			if ($this->bulletin) {
				$time = date("Y-m-d H:i:s");
				$message = $message . "\r\n$this->sql" . "\r\n客户IP:$ip" . "\r\n时间 :$time" . "\r\n\r\n";

				$server_date = date("Y-m-d");
				$filename = $server_date . ".txt";
				$file_path = "error/" . $filename;
				$error_content = $message;
				//$error_content="错误的数据库，不可以链接";
				$file = "error"; //设置文件保存目录

				//建立文件夹
				if (!file_exists($file)) {
					if (!mkdir($file, 0777)) {
						//默认的 mode 是 0777，意味着最大可能的访问权
						die("upload files directory does not exist and creation failed");
					}
				}

				//建立txt日期文件
				if (!file_exists($file_path)) {

					//echo "建立日期文件";
					fopen($file_path, "w+");

					//首先要确定文件存在并且可写
					if (is_writable($file_path)) {
						//使用添加模式打开$filename，文件指针将会在文件的开头
						if (!$handle = fopen($file_path, 'a')) {
							echo "不能打开文件 $filename";
							exit;
						}

						//将$somecontent写入到我们打开的文件中。
						if (!fwrite($handle, $error_content)) {
							echo "不能写入到文件 $filename";
							exit;
						}

						//echo "文件 $filename 写入成功";

						echo "——错误记录被保存!";

						//关闭文件
						fclose($handle);
					} else {
						echo "文件 $filename 不可写";
					}

				} else {
					//首先要确定文件存在并且可写
					if (is_writable($file_path)) {
						//使用添加模式打开$filename，文件指针将会在文件的开头
						if (!$handle = fopen($file_path, 'a')) {
							echo "不能打开文件 $filename";
							exit;
						}

						//将$somecontent写入到我们打开的文件中。
						if (!fwrite($handle, $error_content)) {
							echo "不能写入到文件 $filename";
							exit;
						}

						//echo "文件 $filename 写入成功";
						echo "——错误记录被保存!";

						//关闭文件
						fclose($handle);
					} else {
						echo "文件 $filename 不可写";
					}
				}

			}
			echo "<br />";
			if ($this->is_error) {
				exit;
			}
		}
		echo "</div>";
		echo "</fieldset>";

		echo "<br />";
	}

	//释放结果集
	public function free() {
		@ mysql_free_result($this->result);
	}

	//数据库选择
	public function select_db($db_database) {
		return mysql_select_db($db_database);
	}

	//查询字段数量
	public function num_fields($table_name) {
		//return mysql_num_fields($this->result);
		$this->query("select * from $table_name");
		echo "<br />";
		echo "字段数：" . $total = mysql_num_fields($this->result);
		echo "<pre>";
		for ($i = 0; $i < $total; $i++) {
			print_r(mysql_fetch_field($this->result, $i));
		}
		echo "</pre>";
		echo "<br />";
	}

	//取得 MySQL 服务器信息
	public function mysql_server($num = '') {
		switch ($num) {
			case 1 :
				return mysql_get_server_info(); //MySQL 服务器信息
				break;

			case 2 :
				return mysql_get_host_info(); //取得 MySQL 主机信息
				break;

			case 3 :
				return mysql_get_client_info(); //取得 MySQL 客户端信息
				break;

			case 4 :
				return mysql_get_proto_info(); //取得 MySQL 协议信息
				break;

			default :
				return mysql_get_client_info(); //默认取得mysql版本信息
		}
	}

	//析构函数，自动关闭数据库,垃圾回收机制
	public function __destruct() {
		if (!empty ($this->result)) {
			$this->free();
		}
		@mysql_close($this->conn);
	} //function __destruct();

	/*获得客户端真实的IP地址*/
	public function getip() {
		if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown")) {
			$ip = getenv("HTTP_CLIENT_IP");
		} else
			if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown")) {
				$ip = getenv("HTTP_X_FORWARDED_FOR");
			} else
				if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown")) {
					$ip = getenv("REMOTE_ADDR");
				} else
					if (isset ($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown")) {
						$ip = $_SERVER['REMOTE_ADDR'];
					} else {
						$ip = "unknown";
					}
		return ($ip);
	}

	public function inject_check($sql_str) { //防止注入
		$check = eregi('select|insert|update|delete|\'|\/\*|\*|\.\.\/|\.\/|union|into|load_file|outfile', $sql_str);
		if ($check) {
			echo "输入非法注入内容！";
			exit ();
		} else {
			return $sql_str;
		}
	}

	public function checkurl() { //检查来路
		if (preg_replace("/https?:\/\/([^\:\/]+).*/i", "\\1", $_SERVER['HTTP_REFERER']) !== preg_replace("/([^\:]+).*/", "\\1", $_SERVER['HTTP_HOST'])) {
			header("Location: http://www.kebeke.com");
			exit();
		}
	}
 
    public function set_single_set($user_id){
            //for($i=16;$i<73;$i++){
                $sql="insert ignore into single_set select $user_id,o_id,kx_value,zc_value,zfts_value,j_value from single_set where user_id=0";
                $this->query($sql);
                //$this->insert("single_set", "user_id,o_id,kx_value,zc_value,zfts_value,j_value", "$user_id,$i,1,1,1,1");
            //}
    }
        
    public function update_back_set_by_user_set($user_id){
            $q=  $this->select("users", "else_back", "user_id=$user_id");
            $r=  $this->fetch_array($q);
            $user_set=$r['else_back'];
            if(!$user_set){
                return false;
            }
            
            $query=  $this->select("back_set", "set_name,percent_a,percent_b,percent_c,percent_d", "user_id=$user_id");
            while ($row = $this->fetch_array($query)) {
                $setname=$row['set_name'];
                $percent_a=($row['percent_a']-$user_set) > 0 ? ($row['percent_a']-$user_set) :0;
                $percent_b=($row['percent_b']-$user_set) > 0 ? ($row['percent_b']-$user_set) :0;
                $percent_c=($row['percent_c']-$user_set) > 0 ? ($row['percent_c']-$user_set) :0;
                $percent_d=($row['percent_d']-$user_set) > 0 ? ($row['percent_d']-$user_set) :0;
                
                $sql.="update back_set set percent_a=$percent_a,percent_b=$percent_b,percent_c=$percent_c,percent_d=$percent_d where user_id=$user_id and set_name='$setname'; ";
                //$this->go_update_back_set($user_id, $setname, $percent_a, $percent_b, $percent_c, $percent_d);
            }
            $this->query($sql);
    }
        
    public function go_update_back_set($user_id,$setname,$percent_a,$percent_b,$percent_c,$percent_d){
            $this->update("back_set", "percent_a=$percent_a,percent_b=$percent_b,percent_c=$percent_c,percent_d=$percent_d", "user_id=$user_id and set_name='$setname'");
    }

	/*
     * 获取上司类表
     */
    public function get_tops($top_id){        
        $top= $this->get_top_one($top_id);
        if($top['is_directly']==1){
            switch($top['top_power']){
                case 1:           
                    $x['branch']['user_id']=$top['top_id'];
                case 2:
                    $x['partner']['user_id']=$top['top_id'];
                case 3:
                    $x['proxy_all']['user_id']=$top['top_id'];
                case 4:
                    $x['proxy']['user_id']=$top['top_id'];
            }
        }

        if($top['user_power']==1){
            $this->tops['company']=$top;
            return $this->tops;
        }else if($top['user_power']==2){
            $this->tops['branch']=$top;
            $this->get_tops($top['top_id']);         
        }else if($top['user_power']==3){
            $this->tops['partner']=$top;
            $this->get_tops($top['top_id']);          
        }else if($top['user_power']==4){
            $this->tops['proxy_all']=$top;
            $this->get_tops($top['top_id']);
        }else if($top['user_power']==5){
            $this->tops['proxy']=$top;
            $this->get_tops($top['top_id']);
        }else if($top['user_power']==6){
            if($top['is_directly']==1){
                $this->tops=$x;
            }
            $this->tops['huiyuan']=$top;
            $this->get_tops($top['top_id']);
        }
    }
    
    	/*
     * 获取上司类表
     */
    public function get_tops2($top_id,$tops=array()){
        $top=  $this->get_top_one($top_id);
        if($top['user_power']==1){
            $tops['company']=$top['user_name'];
            //return $this->tops;
        }else if($top['user_power']==2){
            $tops['branch']=$top['user_name'];
            $tops=$this->get_tops2($top['top_id'],$tops);         
        }else if($top['user_power']==3){
            $tops['partner']=$top['user_name'];
            $tops=$this->get_tops2($top['top_id'],$tops);          
        }else if($top['user_power']==4){
            $tops['proxy_all']=$top['user_name'];
            $tops=$this->get_tops2($top['top_id'],$tops);
        }else if($top['user_power']==5){
            $tops['proxy']=$top['user_name'];
            $tops=$this->get_tops2($top['top_id'],$tops);
        }else if($top['user_power']==6){
            $tops['huiyuan']=$top['user_name'];
            $tops=$this->get_tops2($top['top_id'],$tops);
        }
        
        return $tops;
    }

    public function get_top_one($top_id){
        $query=  $this->select("users", "*", "user_id=$top_id");
        $top=  $this->fetch_array($query);
        return $top;
    }
    
    public function get_tuishuizhi($user_id,$set_name,$percent_abcd){
           // $o_content=iconv("utf-8", "gb2312", "大家好");
            if($percent_abcd=="B"){
                $percent="percent_b";
            }elseif($percent_abcd=="C"){
                $percent="percent_c";
            }elseif($percent_abcd=="D"){
                $percent="percent_d";
            }else{
                $percent="percent_a";
            }
                        
            $back_sets= $this->select("back_set", "$percent", "user_id={$user_id} and set_name='$set_name'");
            $back_set = $this->fetch_array($back_sets);
            $back_set_abcd=$back_set[$percent];
            return $back_set_abcd;
    }
        
    public function get_rate($o_id,$user_id,$key='o_content'){
            if($user_id>0){
            $y =  $this->select("plate", "plate_num","1 order by plate_num desc limit 0,1");
            $z=  $this->fetch_array($y);
            $plate_num=$z['plate_num'];

            $x =  $this->select("odds_set", "*", "plate_num='$plate_num' and user_id=$user_id and o_id=$o_id");
            $r=  $this->fetch_array($x);
            $msg=  substr($r[$key], 1,-1);
            //echo $msg; return false;
            $ms =  explode(",", $msg);
            $ret=array();
            foreach ($ms as $v) {
                $o =  explode(":", $v);
                if($key!='o_content'){
                    $ret[$o[0]] =  $o[1];
                }else{
                    $ret[$o[0]] =  $o;
                }
            }
            return $ret; 
            }
    }


    //会员下注明细提示
  public function orders_prompt($tishi_type1,$tishi_type2,$tishi_type3,$tishi_orders_y,$tishi_orders_p,$tishi_zonge,$tishi_bishu,$true_type3,$is_duipeng,$o_type,$u_id,$abcd_h){
      if(in_array($tishi_type1, explode(',', "连码,不中,生肖连,多生肖,尾数连")) && empty($is_duipeng)){
      $dy_arr=array();
      foreach ($true_type3 as $t => $t3){
          $dy_arr[$t3]=$tishi_orders_p[$t];
      }
      }
	  
	  if(@$_POST["faction"]=="submit"||@$_GET["faction"]=="submit"){
//提交处理

//*****服务器端防重复提交*******************
//如果POST传来的表单生成时间与SESSION保存的表单生成时间
//相同；为正常提交
//不相同；为重复提交
if($_SESSION["fsess"]==$_POST["fpsess"]){
$_SESSION["fsess"]=time();
  $strtishi="共￥$tishi_zonge / $tishi_bishu 笔,确定下注吗？\\n 下注明细如下：\\n\\n";
            $t=0;
            foreach ($tishi_type3 as $i => $v) {
               if($tishi_orders_y[$i]>0){
                   if(is_numeric($tishi_type3[$i]) && $tishi_type2=='一肖'){
                           $tishi_type2='尾数';
                           $o_type=50;
                   }
                   if(empty($is_duipeng)){
                   $o_s_p=$this->get_min_order_p($u_id,$o_type,$true_type3,$tishi_orders_p,$tishi_type3[$i],$abcd_h);
                   }else{
                   $o_s_p=$this->get_min_order_p_dp($u_id,$o_type,$tishi_orders_p,$tishi_type3[$i],$abcd_h);    
                   }
                   $tishi_orders_p[$i]=$o_s_p[0];
                   $t++;
                   if($t<=30){
//                   $x3s=explode(',', $v);
//                   if(count($x3s)>1 && in_array($tishi_type1, explode(',', "连码,不中,生肖连,多生肖,尾数连")) && empty($is_duipeng)){ //大于1 即为连码，不中，生肖连，多生肖，尾数连
//                       foreach ($x3s as $x3){
//                           $min_p[]=$dy_arr[$x3];
//                       }
//                       $tishi_orders_p[$i]=min($min_p);
//                       unset($min_p);
//                   }
                   if($tishi_type2=='过关'){
                       $new_gg=$this->guoguannew($u_id,$tishi_type3[$i],$abcd_h);
                       $tishi_type3[$i]=str_replace("<br>"," \\n ",$new_gg[0]); 
                       $strtishi.=" $tishi_type3[$i] \\n 下注金额:￥$tishi_orders_y[$i] @ 赔率 $new_gg[1] ";
                   }else{       

//                       $p3s=explode(',', $tishi_orders_p[$i]);
//                       $tishi_orders_p[$i]=min($p3s);
                   $strtishi.="$tishi_type2 [$tishi_type3[$i]] @ 赔率 $tishi_orders_p[$i] ￥$tishi_orders_y[$i] \\n";
                   }
               }
               }
            }
            if($tishi_bishu>30){
                $strtishi.="\\n这里只显示前30条注单,确认下注后可在下注明细里查询详情";
            }
            return $strtishi;
exit;
} else {
 echo " <script> window.parent.document.getElementById('lleft').src='left.php';window.location.replace('/member/odds.php?spul=18');</script> " ;  exit();

}
} 
//$_SESSION["fsess"]=time();

     // print_r($dy_arr);exit;
      //$tishi_type2='特码A';$tishi_type3='07';$tishi_orders_y='1000';$tishi_orders_p='43';$tishi_bishu='1';
         //   $tishi_zonge=$tishi_bishu*$tishi_orders_y;
// 如果取消就返回上层页面，如果确定就执行下面的代码
          
        //  $url=$_SERVER['HTTP_REFERER'];//window.history.go(-1)
            //$strtishi.="$tishi_type2 [$tishi_type3] @ 赔率 $tishi_orders_p ￥$tishi_orders_y \\n";
            //$url=$_SERVER['HTTP_REFERER'];
//          echo " <script>if(!confirm('$strtishi')){                                   
//              window.history.go(-1)


  

  }

//      //会员下注提醒信息详细
  public function get_orders_tixing($plate_num,$abcd_h,$o_type1,$o_type2,$o_type3,$orders_y,$orders_p,$is_fly,$type_of_bet,$x_content,$url='',$tuodan='',$is_duipeng=0){
        //元素分别为： 期数(2012001) 盘口(A B C D) 下注类型1(特码) 下注类型2(特码A) 下注类型3(49 红波) 下注金额(100) 下注赔率(43) 是否走飞单(0为会员下注，1为代理网用户走飞) 下注方式(0为正常下注，1为手动输入下注) 快速下注的内容 赔率2(三中二，二中特才有) 退水(走飞单才有) 数组(连码时才有) 跳转链接
        //可以传数组形式过来 
        set_time_limit(0);//不限制响应时间
        if(empty($_SESSION['uid'.$this->c_p_seesion()])){
          echo " <script>window.parent.location= 'index.php '; </script> " ;
        }

        $gunqiufengpan_arr=$this->gunqiufengpan();//滚球封盘
        $gunqiufengpan_te=$gunqiufengpan_arr[0];
        $gunqiufengpan_other=$gunqiufengpan_arr[1];
        
        $true_type3=$o_type3;//这个用来处理下注提示明细
        $o_typemin3=$o_type3;//这个用来处理最小赔率时用的
        $orders_pmin=$orders_p;//这个用来处理最小赔率时用的
        if(empty($url)){
            $url=$_SERVER['HTTP_REFERER'];
            $url=str_replace("x_content","x_content2",$url);
            }
        
            $oddsset_types=  $this->select("oddsset_type", "o_id", "o_typename='$o_type2'");
            $oddsset_type = $this->fetch_array($oddsset_types);
            $o_type=$oddsset_type[o_id];

            //获取上级以上级别的信息
            //是管理员是为自己的赔率
            $this->get_tops($_SESSION['uid'.$this->c_p_seesion()]);
            $user_top=$this->tops;
           // print_r($user_top);
            
            $queryusers=  $this->select("users", "is_odds,is_fly", "user_id={$user_top['branch']['user_id']} limit 0,1");
            $user = $this->fetch_array($queryusers);

            if($user['is_odds']==1){
                //$this->get_tops($user_top['branch']['user_id']);
                //$gs=$this->tops;
                $u_id= $user_top['company']['user_id'];  
                $u_power= $user_top['company']['user_power'];
                $u_ids= array($u_id); //处理赔率下注总额
            }else{
             $u_id= $user_top['branch']['user_id'];
             $u_power= $user_top['branch']['user_power'];
             $u_ids= array($user_top['company']['user_id'],$u_id); //处理赔率下注总额
            }
          
            
            //是否直属会员
            if($user_top['huiyuan']['is_directly']){
            $is_zhishu=1;
            }else{
            $is_zhishu=0;
            }
            //当前期数
            $qishus=  $this->select("plate", "*", "1 order by plate_num desc limit 1");
            $qishu = $this->fetch_array($qishus);
            if($plate_num != $qishu[plate_num]){
                echo " <script> alert( '抱歉,你要下注的期数已过期！ ') ;window.location.href= '$url';</script> " ; 
                exit();
            }
            if($qishu[history_is_account]==1){
                echo " <script> alert( '本期已结算不能再投注！ ') ;window.location.href= '$url';</script> " ; 
                exit();
            }
            //这里判断特码的封盘状态

             $tezhengma=0;  //特码和正码
             if($o_type==16 || $o_type==17){
                 if($gunqiufengpan_te==0 && $qishu[is_special] && strtotime($qishu[special_time_end])>time() && strtotime($qishu[plate_time_satrt])<= time() && time()<strtotime($qishu[plate_time_end]) && $qishu[is_plate_start]==0){
                     $tezhengma=1;
                 }

             //这里判断正码的封盘状态    
             }elseif($o_type==18 || $o_type==19 || $o_type==20 || $o_type==21 || $o_type==22 || $o_type==23 || $o_type==24 || $o_type==25 || $o_type==26 || $o_type==27 || $o_type==28 || $o_type==29 || $o_type==30 || $o_type==31){
                 if($gunqiufengpan_other==0 && $qishu[is_normal] && strtotime($qishu[normal_time_end])>time() && strtotime($qishu[plate_time_satrt])<= time() && time()<strtotime($qishu[plate_time_end]) && $qishu[is_plate_start]==0){
                     $tezhengma=1;
                 }


             //连码    
             }elseif($o_type==32 || $o_type==33 || $o_type==34 || $o_type==35 || $o_type==36){
                 if($gunqiufengpan_other==0 && $qishu[is_normal] && strtotime($qishu[normal_time_end])>time() && strtotime($qishu[plate_time_satrt])<= time() && time()<strtotime($qishu[plate_time_end]) && $qishu[is_plate_start]==0){
                     $tezhengma=1;
                 }
                 $xiazhunum=count($o_type3);//已选择下注的个数

               
                 if($o_type==32 || $o_type==33 || $o_type==34){
                     if($xiazhunum<2){
                     echo " <script> alert( '最少选择2个! ') ;window.location.href= '$url';</script> " ; exit(); 
                     }
                     if($is_duipeng==1){ //是否对碰
                     $o_dp_arr = $this->dpfun(explode(',',trim($o_type3[0],',')), explode(',',trim($o_type3[1],',')),$o_type,$u_id);  
                     $o_type3 = $o_dp_arr[0];
                     $orders_p = $o_dp_arr[1];
                     $o_typemin3=$o_type3;//这个用来处理最小赔率时用的
                     $orders_pmin=$orders_p;//这个用来处理最小赔率时用的
                     }elseif(!empty($tuodan[0])){ //是否拖胆
                     $o_type3 = $this->del_arr_repeat_value($o_type3, $tuodan);  //拖胆时调用这个方法
                     }else{
                     $o_type3 = $this->getCombinationToString($o_type3, 2);
                     }                      
                 }elseif($o_type==35 || $o_type==36){
                     if($xiazhunum<3){
                     echo " <script> alert( '最少选择3个! ') ;window.location.href= '$url';</script> " ; exit(); 
                     }
                     if(!empty($tuodan[0])){ //是否拖胆
                     $o_type3 = $this->del_arr_repeat_value($o_type3, $tuodan);  //拖胆时调用这个方法
                     }else{
                     $o_type3 = $this->getCombinationToString($o_type3, 3);   
                     }
                 }
                 for($i=0;$i<count($o_type3);$i++){
                     $orders_yy.=$orders_y.',';
                 }
                 $orders_y=explode(',', trim($orders_yy,','));//转换成数组
                 $x_o_type1='连码';
                 
             //不中
             }elseif($o_type==37 || $o_type==38 || $o_type==39 || $o_type==40 || $o_type==41 || $o_type==42){
                 if($gunqiufengpan_other==0 && $qishu[is_special] && strtotime($qishu[special_time_end])>time() && strtotime($qishu[plate_time_satrt])<= time() && time()<strtotime($qishu[plate_time_end]) && $qishu[is_plate_start]==0){
                     $tezhengma=1;
                 }
                 $xiazhunum=count($o_type3);//已选择下注的个数                
                                       
                 if($o_type==37){
                     if($xiazhunum<5){
                     echo " <script> alert( '最少选择5个! ') ;window.location.href= '$url';</script> " ; exit(); 
                     }
                     //$gongshi_arr=($xiazhunum*($xiazhunum-1)*($xiazhunum-2)*($xiazhunum-3)*($xiazhunum-4))/(5*4*3*2*1);      //五不中公式
                     //$o_type3  = $this->fuck($o_type3, 5);
                     if(!empty($tuodan[0])){ //是否拖胆
                     $o_type3 = $this->del_arr_repeat_value($o_type3, $tuodan);  //拖胆时调用这个方法
                     }else{
                     $o_type3 = $this->getCombinationToString($o_type3, 5);
                     }
                     
                 }elseif($o_type==38){
                     if($xiazhunum<6){
                     echo " <script> alert( '最少选择6个! ') ;window.location.href= '$url';</script> " ; exit(); 
                     }
                     if(!empty($tuodan[0])){ //是否拖胆
                     $o_type3 = $this->del_arr_repeat_value($o_type3, $tuodan);  //拖胆时调用这个方法
                     }else{
                     $o_type3 = $this->getCombinationToString($o_type3, 6);
                     }
                    // $gongshi_arr=($xiazhunum*($xiazhunum-1)*($xiazhunum-2)*($xiazhunum-3)*($xiazhunum-4)*($xiazhunum-5))/(6*5*4*3*2*1);      //六不中公式
                 }elseif($o_type==39){
                     if($xiazhunum<7){
                     echo " <script> alert( '最少选择7个! ') ;window.location.href= '$url';</script> " ; exit(); 
                     }
                     if(!empty($tuodan[0])){ //是否拖胆
                     $o_type3 = $this->del_arr_repeat_value($o_type3, $tuodan);  //拖胆时调用这个方法
                     }else{
                     $o_type3 = $this->getCombinationToString($o_type3, 7);
                     }
                    // $gongshi_arr=($xiazhunum*($xiazhunum-1)*($xiazhunum-2)*($xiazhunum-3)*($xiazhunum-4)*($xiazhunum-5)*($xiazhunum-6))/(7*6*5*4*3*2*1);      //七不中公式
                 }elseif($o_type==40){
                     if($xiazhunum<8){
                     echo " <script> alert( '最少选择8个! ') ;window.location.href= '$url';</script> " ; exit();
                     }
                     if(!empty($tuodan[0])){ //是否拖胆
                     $o_type3 = $this->del_arr_repeat_value($o_type3, $tuodan);  //拖胆时调用这个方法
                     }else{
                     $o_type3 = $this->getCombinationToString($o_type3, 8);
                     }
                   //  $gongshi_arr=($xiazhunum*($xiazhunum-1)*($xiazhunum-2)*($xiazhunum-3)*($xiazhunum-4)*($xiazhunum-5)*($xiazhunum-6)*($xiazhunum-7))/(8*7*6*5*4*3*2*1);      //八不中公式
                 }elseif($o_type==41){
                     if($xiazhunum<9){
                     echo " <script> alert( '最少选择9个! ') ;window.location.href= '$url';</script> " ; exit(); 
                     }
                     if(!empty($tuodan[0])){ //是否拖胆
                     $o_type3 = $this->del_arr_repeat_value($o_type3, $tuodan);  //拖胆时调用这个方法
                     }else{
                     $o_type3 = $this->getCombinationToString($o_type3, 9);
                     }
                   //  $gongshi_arr=($xiazhunum*($xiazhunum-1)*($xiazhunum-2)*($xiazhunum-3)*($xiazhunum-4)*($xiazhunum-5)*($xiazhunum-6)*($xiazhunum-7)*($xiazhunum-8))/(9*8*7*6*5*4*3*2*1);      //八不中公式
                 }elseif($o_type==42){ 
                     if($xiazhunum<10){
                     echo " <script> alert( '最少选择10个! ') ;window.location.href= '$url';</script> " ; exit(); 
                     }
                     if(!empty($tuodan[0])){ //是否拖胆
                     $o_type3 = $this->del_arr_repeat_value($o_type3, $tuodan);  //拖胆时调用这个方法
                     }else{
                     $o_type3 = $this->getCombinationToString($o_type3, 10);
                     }
                     //$gongshi_arr=($xiazhunum*($xiazhunum-1)*($xiazhunum-2)*($xiazhunum-3)*($xiazhunum-4)*($xiazhunum-5)*($xiazhunum-6)*($xiazhunum-7)*($xiazhunum-8)*($xiazhunum-9))/(10*9*8*7*6*5*4*3*2*1);      //八不中公式
                 }
                 for($i=0;$i<count($o_type3);$i++){
                     $orders_yy.=$orders_y.',';
                 }
                 $orders_y=explode(',', trim($orders_yy,','));//转换成数组
                 $x_o_type1='不中';
             }
             //特肖
             if($o_type==43){
                 if($gunqiufengpan_other==0 && $qishu[is_special] && strtotime($qishu[special_time_end])>time() && strtotime($qishu[plate_time_satrt])<= time() && time()<strtotime($qishu[plate_time_end]) && $qishu[is_plate_start]==0){
                     $tezhengma=1;
                 }
                 $x_o_type1='特肖';
             }elseif($o_type==45 || $o_type==46 || $o_type==47 || $o_type==48 || $o_type==49){            
             //多生肖
              if($gunqiufengpan_other==0 && $qishu[is_special] && strtotime($qishu[special_time_end])>time() && strtotime($qishu[plate_time_satrt])<= time() && time()<strtotime($qishu[plate_time_end]) && $qishu[is_plate_start]==0){
                     $tezhengma=1;
              }
                 $xiazhunum=count($o_type3);//已选择下注的个数
                    
             if($o_type==45){                   
                    if($xiazhunum<2){
                    echo " <script> alert( '最少选择2个! ') ;window.location.href= '$url';</script> " ; exit(); 
                    }
                     if(!empty($tuodan[0])){ //是否拖胆
                     $o_type3 = $this->del_arr_repeat_value($o_type3, $tuodan);  //拖胆时调用这个方法
                     }else{
                     $o_type3 = $this->getCombinationToString($o_type3, 2);
                     }
             }elseif($o_type==46){ 
                    if($xiazhunum<3){
                    echo " <script> alert( '最少选择3个! ') ;window.location.href= '$url';</script> " ; exit(); 
                    }
                     if(!empty($tuodan[0])){ //是否拖胆
                     $o_type3 = $this->del_arr_repeat_value($o_type3, $tuodan);  //拖胆时调用这个方法
                     }else{
                     $o_type3 = $this->getCombinationToString($o_type3, 3);
                     }
             }elseif($o_type==47){
                    if($xiazhunum<4){
                    echo " <script> alert( '最少选择4个! ') ;window.location.href= '$url';</script> " ; exit();
                    }
                     if(!empty($tuodan[0])){ //是否拖胆
                     $o_type3 = $this->del_arr_repeat_value($o_type3, $tuodan);  //拖胆时调用这个方法
                     }else{
                     $o_type3 = $this->getCombinationToString($o_type3, 4);
                     }
             }elseif($o_type==48){ 
                    if($xiazhunum<5){
                    echo " <script> alert( '最少选择5个! ') ;window.location.href= '$url';</script> " ; exit();
                    }
                     if(!empty($tuodan[0])){ //是否拖胆
                     $o_type3 = $this->del_arr_repeat_value($o_type3, $tuodan);  //拖胆时调用这个方法
                     }else{
                     $o_type3 = $this->getCombinationToString($o_type3, 5);
                     }
             }elseif($o_type==49){ 
                    if($xiazhunum<6){
                    echo " <script> alert( '最少选择6个! ') ;window.location.href= '$url';</script> " ; exit(); 
                    }
                     if(!empty($tuodan[0])){ //是否拖胆
                     $o_type3 = $this->del_arr_repeat_value($o_type3, $tuodan);  //拖胆时调用这个方法
                     }else{
                     $o_type3 = $this->getCombinationToString($o_type3, 6);
                     }
             }
              for($i=0;$i<count($o_type3);$i++){
                     $orders_yy.=$orders_y.',';
              }
              $orders_y=explode(',', trim($orders_yy,','));//转换成数组
              $x_o_type1='多生肖';
              //生肖连
             }elseif($o_type==51 || $o_type==52 || $o_type==53 || $o_type==54 || $o_type==55 || $o_type==56){
                 if($gunqiufengpan_other==0 && $qishu[is_special] && strtotime($qishu[special_time_end])>time() && strtotime($qishu[plate_time_satrt])<= time() && time()<strtotime($qishu[plate_time_end]) && $qishu[is_plate_start]==0){
                     $tezhengma=1;
                 }
                 $xiazhunum=count($o_type3);//已选择下注的个数
                 
                   if($o_type==51 || $o_type==52){
                    if($xiazhunum<2){
                    echo " <script> alert( '最少选择2个! ') ;window.location.href= '$url';</script> " ; exit(); 
                    }
                     if(!empty($tuodan[0])){ //是否拖胆
                     $o_type3 = $this->del_arr_repeat_value($o_type3, $tuodan);  //拖胆时调用这个方法
                     }else{
                     $o_type3 = $this->getCombinationToString($o_type3, 2);
                     }
                   }elseif($o_type==53 || $o_type==54){
                    if($xiazhunum<3){
                    echo " <script> alert( '最少选择3个! ') ;window.location.href= '$url';</script> " ; exit(); 
                    }
                     if(!empty($tuodan[0])){ //是否拖胆
                     $o_type3 = $this->del_arr_repeat_value($o_type3, $tuodan);  //拖胆时调用这个方法
                     }else{
                     $o_type3 = $this->getCombinationToString($o_type3, 3);
                     }
                   }elseif($o_type==55 || $o_type==56){
                    if($xiazhunum<4){
                    echo " <script> alert( '最少选择4个! ') ;window.location.href= '$url';</script> " ; exit(); 
                    } 
                     if(!empty($tuodan[0])){ //是否拖胆
                     $o_type3 = $this->del_arr_repeat_value($o_type3, $tuodan);  //拖胆时调用这个方法
                     }else{
                     $o_type3 = $this->getCombinationToString($o_type3, 4);
                     }
                   }
                 for($i=0;$i<count($o_type3);$i++){
                     $orders_yy.=$orders_y.',';
                 }
                 $orders_y=explode(',', trim($orders_yy,','));//转换成数组
                 $x_o_type1='生肖连';
             //尾数连
             }elseif($o_type==57 || $o_type==58 || $o_type==59 || $o_type==60 || $o_type==61 || $o_type==62){
                 if($gunqiufengpan_other==0 && $qishu[is_special] && strtotime($qishu[special_time_end])>time() && strtotime($qishu[plate_time_satrt])<= time() && time()<strtotime($qishu[plate_time_end]) && $qishu[is_plate_start]==0){
                     $tezhengma=1;
                 }
                 $xiazhunum=count($o_type3);//已选择下注的个数
                  
                   if($o_type==57 || $o_type==58){
                    if($xiazhunum<2){
                    echo " <script> alert( '最少选择2个! ') ;window.location.href= '$url';</script> " ; exit(); 
                    }
                     if($tuodan[0]!=''){ //是否拖胆
                     $o_type3 = $this->del_arr_repeat_value($o_type3, $tuodan);  //拖胆时调用这个方法
                     }else{
                     $o_type3 = $this->getCombinationToString($o_type3, 2);
                     }
                   }elseif($o_type==59 || $o_type==60){
                    if($xiazhunum<3){
                    echo " <script> alert( '最少选择3个! ') ;window.location.href= '$url';</script> " ; exit(); 
                    }
                     if($tuodan[0]!=''){ //是否拖胆
                     $o_type3 = $this->del_arr_repeat_value($o_type3, $tuodan);  //拖胆时调用这个方法
                     }else{
                     $o_type3 = $this->getCombinationToString($o_type3, 3);
                     }
                   }elseif($o_type==61 || $o_type==62){
                    if($xiazhunum<4){
                    echo " <script> alert( '最少选择4个! ') ;window.location.href= '$url';</script> " ; exit(); 
                    } 
                     if($tuodan[0]!=''){ //是否拖胆
                     $o_type3 = $this->del_arr_repeat_value($o_type3, $tuodan);  //拖胆时调用这个方法
                     }else{
                     $o_type3 = $this->getCombinationToString($o_type3, 4);
                     }
                   }
                 for($i=0;$i<count($o_type3);$i++){
                     $orders_yy.=$orders_y.',';
                 }
                 $orders_y=explode(',', trim($orders_yy,','));//转换成数组
                 $x_o_type1='尾数连';
              //半波
             }elseif($o_type==14){
                 if($gunqiufengpan_other==0 && $qishu[is_special] && strtotime($qishu[special_time_end])>time() && strtotime($qishu[plate_time_satrt])<= time() && time()<strtotime($qishu[plate_time_end]) && $qishu[is_plate_start]==0){
                     $tezhengma=1;
                 }
                 $x_o_type1='半波';
               //过关
             }elseif($o_type==15){
                 if($gunqiufengpan_other==0 && $qishu[is_normal] && strtotime($qishu[normal_time_end])>time() && strtotime($qishu[plate_time_satrt])<= time() && time()<strtotime($qishu[plate_time_end]) && $qishu[is_plate_start]==0){
                     $tezhengma=1;
                 }
                 $x_o_type1='过关'; 
             //一肖尾数
             }elseif($o_type2=='一肖'){
                 if($gunqiufengpan_other==0 && $qishu[is_special] && strtotime($qishu[special_time_end])>time() && strtotime($qishu[plate_time_satrt])<= time() && time()<strtotime($qishu[plate_time_end]) && $qishu[is_plate_start]==0){
                     $tezhengma=1;
                 }              
             }
             
             
             
            if($tezhengma==0){
                echo " <script> alert( '已封盘! ') ;window.location.href= '$url';</script> " ; exit(); 
            }

            //当前用户信息
            $myusers=  $this->select("users", "*", "user_id={$_SESSION['uid'.$this->c_p_seesion()]}");
            $myuser = $this->fetch_array($myusers);

            $boseshuangmian=explode(',', "红波,绿波,蓝波,特单,特双,特大,特小,单,双,大,小,合单,合双,尾小,尾大,家禽,野兽,总单,总双,总大,总小");
            $bose_type=explode(',', "红波,绿波,蓝波");   
            $shuangmian_type=explode(',', "特单,特双,特大,特小,单,双,大,小,合单,合双,尾小,尾大,家禽,野兽,总单,总双,总大,总小"); 
            if($x_o_type1=='尾数连' || $x_o_type1=='生肖连'){  //特殊的退水
                $o_type2name=$x_o_type1;
            }elseif(in_array("特单", $boseshuangmian)){
                 if(in_array("绿波", $bose_type)){
                 $o_type2name='波色';    
                 }elseif(in_array($o_type3, $shuangmian_type)){
                 $o_type2name='两面';    
                 }
            }else{
                $o_type2name=$o_type2;
            }
            
            $back_sets=  $this->select("back_set", "*", "user_id={$_SESSION['uid'.$this->c_p_seesion()]} and set_name='{$o_type2name}'");
            $back_set = $this->fetch_array($back_sets);

            if($type_of_bet==0){ //正常下注
            $tishi_bishu=0; 
            foreach ($o_type3 as $i => $v) {
           // foreach ($orders_y as $y => $yy) {
               if($orders_y[$i]>0){
               $top_limit = mysql_fetch_array(mysql_query("select SUM(orders_y) as sum from orders where user_id={$_SESSION['uid'.$this->c_p_seesion()]} and plate_num={$qishu['plate_num']} and o_type2='{$o_type2[$i]}' and o_type3='{$o_type3[$i]}'"));    
               $tishi_bishu++; 
               $x_orders_y_i+=$orders_y[$i];
               $top_limits=$top_limit['sum']+$orders_y[$i];
               if(!empty($orders_y[$i]) && $back_set[bottom_limit]>$orders_y[$i]){
                   echo " <script> alert( '少于最低限额$back_set[bottom_limit],请重新下注! ') ;window.location.href= '$url'; </script> " ; exit();
               } 
               }
            }
            }
            

            //你的账号被停押is_bet=1 
                if($myuser['is_lock']){                  
                  echo " <script> alert( '你的账号被冻结! ') </script>";
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
                      echo " <script>
                            window.open('index.php', '_top');
                             window.top.close();
                            </script> " ;
                            exit();    
                }
                if($myuser['is_bet']){
                  echo " <script> alert( '你的账号被停押!有疑问请联系你的上级！ ') ;window.location.href= '$url'; </script> " ; exit();    
                }
                $user_yue=$myuser['credit_remainder']-$x_orders_y_i;
                if($user_yue<0){
                 echo " <script> alert( '你的余额不足。 ') ;window.location.href= '$url'; </script> " ; exit();  
                }
                
                if($tishi_bishu==0){
                 echo " <script> alert( '请选择再投注！') ;window.location.href= '$url'; </script> " ; exit();  
                }
             $this->is_fenghao($o_type,$u_id,$o_type3,$orders_y);//判断是否封号
             //下注详细提示
             $orders_tixing=$this->orders_prompt($o_type1,$o_type2,$o_type3,$orders_y,$orders_p,$x_orders_y_i,$tishi_bishu,$true_type3,$is_duipeng,$o_type,$u_id,$abcd_h);
              return array($orders_tixing,$x_orders_y_i,$tishi_bishu);
        }
        
    //会员下注
  public function get_orders($x_orders_y_i,$plate_num,$abcd_h,$o_type1,$o_type2,$o_type3,$orders_y,$orders_p,$is_fly,$type_of_bet,$x_content,$url='',$tuodan='',$is_duipeng=0){
        //元素分别为： 期数(2012001) 盘口(A B C D) 下注类型1(特码) 下注类型2(特码A) 下注类型3(49 红波) 下注金额(100) 下注赔率(43) 是否走飞单(0为会员下注，1为代理网用户走飞) 下注方式(0为正常下注，1为手动输入下注) 快速下注的内容 赔率2(三中二，二中特才有) 退水(走飞单才有) 数组(连码时才有) 跳转链接
        //可以传数组形式过来 
		


		
		
        set_time_limit(0);//不限制响应时间
        if(empty($_SESSION['uid'.$this->c_p_seesion()])){
          echo " <script>window.parent.location= 'index.php '; </script> " ;
        }
        
        $gunqiufengpan_arr=$this->gunqiufengpan();//滚球封盘
        $gunqiufengpan_te=$gunqiufengpan_arr[0];
        $gunqiufengpan_other=$gunqiufengpan_arr[1];

      //  $true_type3=$o_type3;//这个用来处理下注提示明细
        $o_typemin3=$o_type3;//这个用来处理最小赔率时用的
        $orders_pmin=$orders_p;//这个用来处理最小赔率时用的
        if(empty($url)){
            $url=$_SERVER['HTTP_REFERER'];
            $url=str_replace("x_content","x_content2",$url);
            }
        
            $oddsset_types=  $this->select("oddsset_type", "o_id", "o_typename='$o_type2'");
            $oddsset_type = $this->fetch_array($oddsset_types);
            $o_type=$oddsset_type[o_id];

            //获取上级以上级别的信息
            //是管理员是为自己的赔率
            $this->get_tops($_SESSION['uid'.$this->c_p_seesion()]);
            $user_top=$this->tops;
           // print_r($user_top);
            
//            $user_top['branch']['user_id'].'a<br>'.
//            $user_top['company']['user_id'].'b<br>'.
//            $user_top['partner']['user_id'].'c<br>'.
//            $user_top['proxy_all']['user_id'].'d<br>'.
//            $user_top['proxy']['user_id'].'e<br>' ;
            
            //下注用户的所有上级用户id
            $user_toparr=explode(',', "{$user_top['company']['user_id']},{$user_top['branch']['user_id']},{$user_top['partner']['user_id']},{$user_top['proxy_all']['user_id']},{$user_top['proxy']['user_id']}"); 
            $user_toparrs=array_flip(array_flip($user_toparr));//删除重复
            
            $user_toppowerarr=explode(',', "{$user_top['company']['user_power']},{$user_top['branch']['user_power']},{$user_top['partner']['user_power']},{$user_top['proxy_all']['user_power']},{$user_top['proxy']['user_power']}"); 
            $user_toppowerarrs=array_flip(array_flip($user_toppowerarr));//删除重复
            
            $queryusers=  $this->select("users", "is_odds,is_fly", "user_id={$user_top['branch']['user_id']} limit 0,1");
            $user = $this->fetch_array($queryusers);

            if($user['is_odds']==1){
                //$this->get_tops($user_top['branch']['user_id']);
                //$gs=$this->tops;
                $u_id= $user_top['company']['user_id'];  
                $u_power= $user_top['company']['user_power'];
                $u_ids= array($u_id); //处理赔率下注总额
            }else{
             $u_id= $user_top['branch']['user_id'];
             $u_power= $user_top['branch']['user_power'];
             $u_ids= array($user_top['company']['user_id'],$u_id); //处理赔率下注总额
            }

           // $rate=$this->get_rate($o_type,$u_id); 
            
            
            //是否直属会员
            if($user_top['huiyuan']['is_directly']){
            $is_zhishu=1;
            }else{
            $is_zhishu=0;
            }
            //当前期数
            $qishus=  $this->select("plate", "*", "1 order by plate_num desc limit 1");
            $qishu = $this->fetch_array($qishus);

            $shuangmian_type=array();
            //这里判断特码的封盘状态
            //  $qishu[is_special]=1;//特码开
            //  $qishu[special_time_end];//特码封盘时间
            //  
            //  $qishu[is_normal]=1;//正码开
            //  $qishu[normal_time_end];//正码封盘时间
            //  
            //  $qishu[plate_time_satrt];//开盘时间
            //  $qishu[plate_time_end];//总封盘时间
            // // $qishu[plate_time_satrt]<= time() && $qishu[plate_time_satrt]>$qishu[plate_time_end] && $qishu[is_plate_start]
            //  $qishu[is_plate_start];//状态0正在开盘，1正在封盘

             $tezhengma=0;  //特码和正码
             if($o_type==16 || $o_type==17){
                 if($gunqiufengpan_te==0 && $qishu[is_special] && strtotime($qishu[special_time_end])>time() && strtotime($qishu[plate_time_satrt])<= time() && time()<strtotime($qishu[plate_time_end]) && $qishu[is_plate_start]==0){
                     $tezhengma=1;
                 }
                 $tiaojian_pan="o_typename='特码'";
                 $tiaojian_pan_b="o_typename='特码波色'";
                 $tiaojian_pan_s="o_typename='特码双面'";
                 $shuangmian_type=explode(',', "特单,特双,特大,特小,合单,合双,尾小,尾大,家禽,野兽");
                 $x_o_type1="特码";
                 $x_o_type1t="特码";
                 $all_type_arr=explode(',', "01,02,03,04,05,06,07,08,09,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,红波,蓝波,绿波,特单,特双,特大,特小,合单,合双,尾小,尾大,家禽,野兽,总单,总双,总大,总小");

             //这里判断正码的封盘状态    
             }elseif($o_type==18 || $o_type==19 || $o_type==20 || $o_type==21 || $o_type==22 || $o_type==23 || $o_type==24 || $o_type==25 || $o_type==26 || $o_type==27 || $o_type==28 || $o_type==29 || $o_type==30 || $o_type==31){
                 if($gunqiufengpan_other==0 && $qishu[is_normal] && strtotime($qishu[normal_time_end])>time() && strtotime($qishu[plate_time_satrt])<= time() && time()<strtotime($qishu[plate_time_end]) && $qishu[is_plate_start]==0){
                     $tezhengma=1;
                 }
                 if($o_type==30 || $o_type==31){
                 $tiaojian_pan="o_typename='正码'";
                 $tiaojian_pan_s="o_typename='正码双面'";
                 $shuangmian_type=explode(',', "总单,总双,总大,总小");
                 $x_o_type1='正码';
                 $all_type_arr=explode(',', "01,02,03,04,05,06,07,08,09,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,总单,总双,总大,总小");
                 }else{
                 $tiaojian_pan="o_typename='正特'";
                 $tiaojian_pan_b="o_typename='正码1-6波色'";
                 $tiaojian_pan_s="o_typename='正码1-6双面'";
                 $shuangmian_type=explode(',', "单,双,大,小,合单,合双,尾小,尾大,家禽,野兽");
  
                 if($o_type==18 || $o_type==19){$xx=1;}elseif($o_type==20 || $o_type==21){$xx=2;}elseif($o_type==22 || $o_type==23){$xx=3;}elseif($o_type==24 || $o_type==25){$xx=4;}elseif($o_type==26 || $o_type==27){$xx=5;}elseif($o_type==28 || $o_type==29){$xx=6;}
                 $x_o_type1='正'.$xx.'特';
                 $x_o_type1t='正'.$xx.'特';
                 $all_type_arr=explode(',', "01,02,03,04,05,06,07,08,09,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,红波,蓝波,绿波,单,双,大,小,合单,合双,尾小,尾大,家禽,野兽");
                 }
                 
             //连码    
             }elseif($o_type==32 || $o_type==33 || $o_type==34 || $o_type==35 || $o_type==36){
                 if($gunqiufengpan_other==0 && $qishu[is_normal] && strtotime($qishu[normal_time_end])>time() && strtotime($qishu[plate_time_satrt])<= time() && time()<strtotime($qishu[plate_time_end]) && $qishu[is_plate_start]==0){
                     $tezhengma=1;
                 }
//                 $xiazhunum=count($o_type3);//已选择下注的个数
                 
                 if($o_type==32 || $o_type==33 || $o_type==34){

                     if($is_duipeng==1){ //是否对碰
                     $o_dp_arr = $this->dpfun(explode(',',trim($o_type3[0],',')), explode(',',trim($o_type3[1],',')),$o_type,$u_id);  
                     $o_type3 = $o_dp_arr[0];
                     $orders_p = $o_dp_arr[1];
                     $o_typemin3=$o_type3;//这个用来处理最小赔率时用的
                     $orders_pmin=$orders_p;//这个用来处理最小赔率时用的
                     }elseif(!empty($tuodan[0])){ //是否拖胆
                     $o_type3 = $this->del_arr_repeat_value($o_type3, $tuodan);  //拖胆时调用这个方法
                     }else{
                     $o_type3 = $this->getCombinationToString($o_type3, 2);
                     }                      
                 }elseif($o_type==35 || $o_type==36){

                     if(!empty($tuodan[0])){ //是否拖胆
                     $o_type3 = $this->del_arr_repeat_value($o_type3, $tuodan);  //拖胆时调用这个方法
                     }else{
                     $o_type3 = $this->getCombinationToString($o_type3, 3);   
                     }
                 }
                 for($i=0;$i<count($o_type3);$i++){
                     $orders_yy.=$orders_y.',';
                 }
                 //echo count($o_type3);
                 //print_r($o_type3);exit;
                 $orders_y=explode(',', trim($orders_yy,','));//转换成数组
                 $x_o_type1='连码';
                 
             //不中
             }elseif($o_type==37 || $o_type==38 || $o_type==39 || $o_type==40 || $o_type==41 || $o_type==42){
                 if($gunqiufengpan_other==0 && $qishu[is_special] && strtotime($qishu[special_time_end])>time() && strtotime($qishu[plate_time_satrt])<= time() && time()<strtotime($qishu[plate_time_end]) && $qishu[is_plate_start]==0){
                     $tezhengma=1;
                 }
//                 $xiazhunum=count($o_type3);//已选择下注的个数                
//                                     
                 if($o_type==37){

                     //$gongshi_arr=($xiazhunum*($xiazhunum-1)*($xiazhunum-2)*($xiazhunum-3)*($xiazhunum-4))/(5*4*3*2*1);      //五不中公式
                     //$o_type3  = $this->fuck($o_type3, 5);
                     if(!empty($tuodan[0])){ //是否拖胆
                     $o_type3 = $this->del_arr_repeat_value($o_type3, $tuodan);  //拖胆时调用这个方法
                     }else{
                     $o_type3 = $this->getCombinationToString($o_type3, 5);
                     }
                     
                 }elseif($o_type==38){

                     if(!empty($tuodan[0])){ //是否拖胆
                     $o_type3 = $this->del_arr_repeat_value($o_type3, $tuodan);  //拖胆时调用这个方法
                     }else{
                     $o_type3 = $this->getCombinationToString($o_type3, 6);
                     }
                    // $gongshi_arr=($xiazhunum*($xiazhunum-1)*($xiazhunum-2)*($xiazhunum-3)*($xiazhunum-4)*($xiazhunum-5))/(6*5*4*3*2*1);      //六不中公式
                 }elseif($o_type==39){

                     if(!empty($tuodan[0])){ //是否拖胆
                     $o_type3 = $this->del_arr_repeat_value($o_type3, $tuodan);  //拖胆时调用这个方法
                     }else{
                     $o_type3 = $this->getCombinationToString($o_type3, 7);
                     }
                    // $gongshi_arr=($xiazhunum*($xiazhunum-1)*($xiazhunum-2)*($xiazhunum-3)*($xiazhunum-4)*($xiazhunum-5)*($xiazhunum-6))/(7*6*5*4*3*2*1);      //七不中公式
                 }elseif($o_type==40){

                     if(!empty($tuodan[0])){ //是否拖胆
                     $o_type3 = $this->del_arr_repeat_value($o_type3, $tuodan);  //拖胆时调用这个方法
                     }else{
                     $o_type3 = $this->getCombinationToString($o_type3, 8);
                     }
                   //  $gongshi_arr=($xiazhunum*($xiazhunum-1)*($xiazhunum-2)*($xiazhunum-3)*($xiazhunum-4)*($xiazhunum-5)*($xiazhunum-6)*($xiazhunum-7))/(8*7*6*5*4*3*2*1);      //八不中公式
                 }elseif($o_type==41){

                     if(!empty($tuodan[0])){ //是否拖胆
                     $o_type3 = $this->del_arr_repeat_value($o_type3, $tuodan);  //拖胆时调用这个方法
                     }else{
                     $o_type3 = $this->getCombinationToString($o_type3, 9);
                     }
                   //  $gongshi_arr=($xiazhunum*($xiazhunum-1)*($xiazhunum-2)*($xiazhunum-3)*($xiazhunum-4)*($xiazhunum-5)*($xiazhunum-6)*($xiazhunum-7)*($xiazhunum-8))/(9*8*7*6*5*4*3*2*1);      //八不中公式
                 }elseif($o_type==42){ 

                     if(!empty($tuodan[0])){ //是否拖胆
                     $o_type3 = $this->del_arr_repeat_value($o_type3, $tuodan);  //拖胆时调用这个方法
                     }else{
                     $o_type3 = $this->getCombinationToString($o_type3, 10);
                     }
                     //$gongshi_arr=($xiazhunum*($xiazhunum-1)*($xiazhunum-2)*($xiazhunum-3)*($xiazhunum-4)*($xiazhunum-5)*($xiazhunum-6)*($xiazhunum-7)*($xiazhunum-8)*($xiazhunum-9))/(10*9*8*7*6*5*4*3*2*1);      //八不中公式
                 }
                 for($i=0;$i<count($o_type3);$i++){
                     $orders_yy.=$orders_y.',';
                 }
                 $orders_y=explode(',', trim($orders_yy,','));//转换成数组
                 $x_o_type1='不中';
             }
             //特肖
             if($o_type==43){
                 if($gunqiufengpan_other==0 && $qishu[is_special] && strtotime($qishu[special_time_end])>time() && strtotime($qishu[plate_time_satrt])<= time() && time()<strtotime($qishu[plate_time_end]) && $qishu[is_plate_start]==0){
                     $tezhengma=1;
                 }
                 $x_o_type1='特肖';
             }elseif($o_type==45 || $o_type==46 || $o_type==47 || $o_type==48 || $o_type==49){            
             //多生肖
              if($gunqiufengpan_other==0 && $qishu[is_special] && strtotime($qishu[special_time_end])>time() && strtotime($qishu[plate_time_satrt])<= time() && time()<strtotime($qishu[plate_time_end]) && $qishu[is_plate_start]==0){
                     $tezhengma=1;
              }
              //   $xiazhunum=count($o_type3);//已选择下注的个数

             if($o_type==45){                   

                     if(!empty($tuodan[0])){ //是否拖胆
                     $o_type3 = $this->del_arr_repeat_value($o_type3, $tuodan);  //拖胆时调用这个方法
                     }else{
                     $o_type3 = $this->getCombinationToString($o_type3, 2);
                     }
             }elseif($o_type==46){ 

                     if(!empty($tuodan[0])){ //是否拖胆
                     $o_type3 = $this->del_arr_repeat_value($o_type3, $tuodan);  //拖胆时调用这个方法
                     }else{
                     $o_type3 = $this->getCombinationToString($o_type3, 3);
                     }
             }elseif($o_type==47){

                     if(!empty($tuodan[0])){ //是否拖胆
                     $o_type3 = $this->del_arr_repeat_value($o_type3, $tuodan);  //拖胆时调用这个方法
                     }else{
                     $o_type3 = $this->getCombinationToString($o_type3, 4);
                     }
             }elseif($o_type==48){ 

                     if(!empty($tuodan[0])){ //是否拖胆
                     $o_type3 = $this->del_arr_repeat_value($o_type3, $tuodan);  //拖胆时调用这个方法
                     }else{
                     $o_type3 = $this->getCombinationToString($o_type3, 5);
                     }
             }elseif($o_type==49){ 

                     if(!empty($tuodan[0])){ //是否拖胆
                     $o_type3 = $this->del_arr_repeat_value($o_type3, $tuodan);  //拖胆时调用这个方法
                     }else{
                     $o_type3 = $this->getCombinationToString($o_type3, 6);
                     }
             }
              for($i=0;$i<count($o_type3);$i++){
                     $orders_yy.=$orders_y.',';
              }
              $orders_y=explode(',', trim($orders_yy,','));//转换成数组
              $x_o_type1='多生肖';
              
              //生肖连
             }elseif($o_type==51 || $o_type==52 || $o_type==53 || $o_type==54 || $o_type==55 || $o_type==56){
                 if($gunqiufengpan_other==0 && $qishu[is_special] && strtotime($qishu[special_time_end])>time() && strtotime($qishu[plate_time_satrt])<= time() && time()<strtotime($qishu[plate_time_end]) && $qishu[is_plate_start]==0){
                     $tezhengma=1;
                 }
//                 $xiazhunum=count($o_type3);//已选择下注的个数
                 
                   if($o_type==51 || $o_type==52){

                     if(!empty($tuodan[0])){ //是否拖胆
                     $o_type3 = $this->del_arr_repeat_value($o_type3, $tuodan);  //拖胆时调用这个方法
                     }else{
                     $o_type3 = $this->getCombinationToString($o_type3, 2);
                     }
                   }elseif($o_type==53 || $o_type==54){

                     if(!empty($tuodan[0])){ //是否拖胆
                     $o_type3 = $this->del_arr_repeat_value($o_type3, $tuodan);  //拖胆时调用这个方法
                     }else{
                     $o_type3 = $this->getCombinationToString($o_type3, 3);
                     }
                   }elseif($o_type==55 || $o_type==56){

                     if(!empty($tuodan[0])){ //是否拖胆
                     $o_type3 = $this->del_arr_repeat_value($o_type3, $tuodan);  //拖胆时调用这个方法
                     }else{
                     $o_type3 = $this->getCombinationToString($o_type3, 4);
                     }
                   }
                 for($i=0;$i<count($o_type3);$i++){
                     $orders_yy.=$orders_y.',';
                 }
                 $orders_y=explode(',', trim($orders_yy,','));//转换成数组
              $x_o_type1='生肖连';
              
             //尾数连
             }elseif($o_type==57 || $o_type==58 || $o_type==59 || $o_type==60 || $o_type==61 || $o_type==62){
                 if($gunqiufengpan_other==0 && $qishu[is_special] && strtotime($qishu[special_time_end])>time() && strtotime($qishu[plate_time_satrt])<= time() && time()<strtotime($qishu[plate_time_end]) && $qishu[is_plate_start]==0){
                     $tezhengma=1;
                 }
//                 $xiazhunum=count($o_type3);//已选择下注的个数

                   if($o_type==57 || $o_type==58){

                     if($tuodan[0]!=''){ //是否拖胆
                     $o_type3 = $this->del_arr_repeat_value($o_type3, $tuodan);  //拖胆时调用这个方法
                     }else{
                     $o_type3 = $this->getCombinationToString($o_type3, 2);
                     }
                   }elseif($o_type==59 || $o_type==60){

                     if($tuodan[0]!=''){ //是否拖胆
                     $o_type3 = $this->del_arr_repeat_value($o_type3, $tuodan);  //拖胆时调用这个方法
                     }else{
                     $o_type3 = $this->getCombinationToString($o_type3, 3);
                     }
                   }elseif($o_type==61 || $o_type==62){

                     if($tuodan[0]!=''){ //是否拖胆
                     $o_type3 = $this->del_arr_repeat_value($o_type3, $tuodan);  //拖胆时调用这个方法
                     }else{
                     $o_type3 = $this->getCombinationToString($o_type3, 4);
                     }
                   }
                 for($i=0;$i<count($o_type3);$i++){
                     $orders_yy.=$orders_y.',';
                 }
                 $orders_y=explode(',', trim($orders_yy,','));//转换成数组
              $x_o_type1='尾数连'; 
              
              //半波
             }elseif($o_type==14){
                 if($gunqiufengpan_other==0 && $qishu[is_special] && strtotime($qishu[special_time_end])>time() && strtotime($qishu[plate_time_satrt])<= time() && time()<strtotime($qishu[plate_time_end]) && $qishu[is_plate_start]==0){
                     $tezhengma=1;
                 }
               $x_o_type1='半波'; 
             
               //过关
             }elseif($o_type==15){
                 if($gunqiufengpan_other==0 && $qishu[is_normal] && strtotime($qishu[normal_time_end])>time() && strtotime($qishu[plate_time_satrt])<= time() && time()<strtotime($qishu[plate_time_end]) && $qishu[is_plate_start]==0){
                     $tezhengma=1;
                 }
               $x_o_type1='过关'; 
               
             //一肖尾数
             }elseif($o_type2=='一肖'){
                 if($gunqiufengpan_other==0 && $qishu[is_special] && strtotime($qishu[special_time_end])>time() && strtotime($qishu[plate_time_satrt])<= time() && time()<strtotime($qishu[plate_time_end]) && $qishu[is_plate_start]==0){
                     $tezhengma=1;
                 }              
             }
             
             
             
            if($tezhengma==0){
                echo " <script> alert( '已封盘! ') ;window.location.href= '$url';</script> " ; exit(); 
            }

            //当前用户信息
            $myusers=  $this->select("users", "*", "user_id={$_SESSION['uid'.$this->c_p_seesion()]}");
            $myuser = $this->fetch_array($myusers);



            //退水信息
            //  `set_name`'交易类型',
            //  `percent_a`  'A盘退水占成百分率',
            //  `percent_b`  'B盘退水占成百分率',
            //  `percent_c`  'C盘退水占成百分率',
            //  `percent_d`  'D盘退水占成百分率',
            //  `bottom_limit`  '最低限额',
            //  `top_limit`  '最高限额',
            //  `odd_limit` '单码限额',

            //处理下注数据
            //  `user_id`  '用户id',
            //  `plate_num`'格式"年+期数"，如：2012106',
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
            //  `is_fly`'下级走飞归属（分0"全归公司"，1"全归分公司"和2"按各级成数分配"）',
            //  `topd_id`  '上级代理id', 
            //  `topzd_id` '上级总代理id',
            //  `topgd_id` '上级股东id',
            //  `topf_id`  '上级分公司id',
            //  `keying_y` '可赢金额（下注金额*赔率-下注金额+该注退水金额）',
            //   `tuishui_y`  '该注单退水金额（下注类型金额*下注类型的退水率--------退水也叫佣金）',

            //该下注类型是否被设置为"停押"，是否少于"最低下注额"，是否金额是否超出"余额"，是否被"封号"，是否超出"下注最高限额"，是否到了"封盘时间"，提示方式可以有两种，1:将无问题的注单设置下注成功，有问题的注单设置下注失败，并返回问题信息。  2:直接提示下注单中有有问题的注单，并返回问题信息，提示重新下单。

           
 
            $x_time=time();
            
            //快速下注内容
  //          $managerarr = explode(' ', $x_content);//转换成数组,把字符串分割为数组        implode()转换成字符串  


                $user_yue=$myuser['credit_remainder']-$x_orders_y_i;
                if($user_yue<0){
                 echo " <script> window.location.href= '$url'; </script> " ; exit();  
                }
           
             //下注详细提示
          //   $is_go=$this->orders_prompt($o_type1,$o_type2,$o_type3,$orders_y,$orders_p,$x_orders_y_i,$tishi_bishu,$true_type3,$is_duipeng);
             //这里木有办法鸟，妈的，只能下注了再删除刚刚下注的。。。。别逼我
               // $o_s_p=$this->get_min_order_p($u_id,$o_type,$o_typemin3,$orders_pmin,$o_type3[$i],$abcd_h);
//             if($is_go==1){
//                 echo 'fuck';
//             }else{
//                 echo 'cao';exit;
//             }   
             //自动补货分类
             $bose_type_arr1=explode(',', "生肖连,尾数连,半波,过关,特码双面,正码双面,正1特双面,正2特双面,正3特双面,正4特双面,正5特双面,正6特双面");
             $bose_type_arr2=explode(',', "特码A,特码B,正1特A,正1特B,正2特A,正2特B,正3特A,正3特B,正4特A,正4特B,正5特A,正5特B,正6特A,正6特B,正码A,正码B,特肖,二肖,三肖,四肖,五肖,六肖,一肖,尾数,五不中,六不中,七不中,八不中,九不中,十不中,二全中,二中特,特串,三全中,三中二");
             $bose_type_arr3=explode(',', "红波,绿波,蓝波");  
             
            //手动快速下注插入数据
//              if($type_of_bet==1){  
//               foreach ($managerarr as $ma){
//               $ma_arr = explode('=', $ma);  
//                 if(in_array($ma_arr[0],$all_type_arr) && is_numeric($ma_arr[1])){
//                     if($back_set[bottom_limit]<=$ma_arr[1] && $ma_arr[1]<=$back_set[top_limit]){
//                          if($ma_arr[1]>0){
//                          $tuishui_y[$i]=$ma_arr[1]*$back_set_h/100;
//                          $keying_y[$i]=$ma_arr[1]*$rate[$ma_arr[0]][1]-$ma_arr[1]+$tuishui_y[$i];
//                          //处理是否自动降水
//                           $is_back=$this->is_autobacks($x_o_type1,$o_type2,$ma_arr[0],$rate[$ma_arr[0]][1],$ma_arr[1],$qishu['plate_num'],$_SESSION['uid'.$this->c_p_seesion()]);
////                            if($is_back[0]=='ok'){
////                                $rate[$ma_arr[0]][1]=$is_back[1];
////                            }
//                            if(($o_type>=16 && $o_type<=31) || $o_type==14 || $o_type==44 || $o_type==50){
//                            $this->update_total_bet($o_type,$ma_arr[0],$qishu['plate_num'],$ma_arr[1],$u_ids);//更新赔率里的下注总额
//                            }
//                          $sql="insert into orders (user_id,plate_num,time,o_type1,o_type2,o_type3,orders_y,orders_p,orders_p2,abcd_h,h_tui,d_tui,zd_tui,gd_tui,f_tui,d_z,zd_z,gd_z,f_z,g_z,topd_id,topzd_id,topgd_id,topf_id,keying_y,tuishui_y,fly_user,is_fly,is_zhishu)values ('{$_SESSION['uid'.$this->c_p_seesion()]}','{$qishu['plate_num']}','{$x_time}','{$x_o_type1}','{$o_type2}','{$ma_arr[0]}','{$ma_arr[1]}','{$rate[$ma_arr[0]][1]}','{$rate[$ma_arr[0]][1]}','{$abcd_h}','{$back_set_h}','{$back_set_d}','{$back_set_zd}','{$back_set_gd}','{$back_set_f}','{$myuser['percent_proxy']}','{$myuser['percent_all_proxy']}','{$myuser['percent_partner']}','{$myuser['percent_branch']}','{$myuser['percent_company']}','{$user_top['proxy']['user_id']}','{$user_top['proxy_all']['user_id']}','{$user_top['partner']['user_id']}','{$user_top['branch']['user_id']}','{$keying_y[$i]}','{$tuishui_y[$i]}','{$user['is_fly']}','{$is_fly}','{$is_zhishu}')";
//                          $this->query($sql);
//                          
//                                foreach ($user_toparrs as $ki=> $uts) {      
//                                  //处理自动补货
//                                   if(in_array($x_o_type1,$bose_type_arr1)){
//                                         //判断一级类
//                                         $autoorder=$this->is_autoorders($x_o_type1,$user_toparrs[$ki]);
//                                   }elseif(in_array($ma_arr[0],$bose_type_arr3)){
//                                         //判断是否是波色
//                                         $autoorder=$this->is_autoorders($ma_arr[0],$user_toparrs[$ki]);
//                                   }elseif(in_array($o_type2,$bose_type_arr2)){
//                                         //判断二级类
//                                         $autoorder=$this->is_autoorders($o_type2,$user_toparrs[$ki]);
//                                   }else{
//                                         $autoorder=$this->is_autoorders($x_o_type1,$user_toparrs[$ki]);
//                                   }
//                                   if($autoorder[0]=='ok'){
//                                           $autoarrs=$this->auto_get_type3_zc($ma_arr[0],$user_toparrs[$ki],$qishu['plate_num'],$x_o_type1,$o_type2,$user_toppowerarrs[$ki],$o_type,$rate[$ma_arr[0]][1]);
//                                         //$autoarrs=$this->get_total_for_auto($user_toparrs[$ki], $qishu['plate_num'], $user_toppowerarrs[$ki]);
//                                         $autoorders_y=floor($autoarrs-$autoorder[1]); //走飞值减去控制额
//                                         if($autoorders_y>=1){
//                                             $autoo_type3=explode(',', $ma_arr[0]);
//                                             $autoorders_y=explode(',', $autoorders_y);
//                                             $autoorders_p=explode(',', $rate[$ma_arr[0]][1]);
//                                             $this->get_feiorders($qishu['plate_num'],$abcd_h,$x_o_type1,$o_type2,$autoo_type3,$autoorders_y,$autoorders_p,'0','0','1','1','0','no',$user_toparrs[$ki],$user_toppowerarrs[$ki]);
//                                         }
//                                   }
//                                 }//补货结束 
//                          }
//                     }   
//                 }
//               }
//              }else{   
            //普通下注插入数据    
            foreach ($o_type3 as $i => $v) {
    
	           //获得退水值
            $boseshuangmian=explode(',', "红波,绿波,蓝波,特单,特双,特大,特小,单,双,大,小,合单,合双,尾小,尾大,家禽,野兽,总单,总双,总大,总小");
            $bose_type=explode(',', "红波,绿波,蓝波");   
            $shuangmian_types=explode(',', "特单,特双,特大,特小,单,双,大,小,合单,合双,尾小,尾大,家禽,野兽,总单,总双,总大,总小");
	
			
            if($x_o_type1=='尾数连' || $x_o_type1=='生肖连'){  //特殊的退水
                $o_type2name=$x_o_type1;
				
            }elseif(in_array($o_type3[$i], $boseshuangmian)){
                 if(in_array($o_type3[$i], $bose_type)){
                 $o_type2name='波色';    
                 }elseif(in_array($o_type3[$i], $shuangmian_types)){
                 $o_type2name='两面';    
                 }    
            }else{
			
                $o_type2name=$o_type2;
            }
			
			if($o_type==44){
                       if(!is_numeric($o_type3[$i])){
                          
                       }else{
                           $o_type2name= '尾数';
                       }
               }  
            
	
			
            $back_sets=  $this->select("back_set", "*", "user_id={$_SESSION['uid'.$this->c_p_seesion()]} and set_name='{$o_type2name}'");

            $back_set = $this->fetch_array($back_sets);
     
            $back_set_h = $this->get_tuishuizhi($_SESSION['uid'.$this->c_p_seesion()],$o_type2name,$abcd_h);//会员的退水百分率
			
            $back_set_d = $this->get_tuishuizhi($user_top['proxy']['user_id'],$o_type2name,$abcd_h);//代理
            $back_set_zd = $this->get_tuishuizhi($user_top['proxy_all']['user_id'],$o_type2name,$abcd_h);//总代理
            $back_set_gd = $this->get_tuishuizhi($user_top['partner']['user_id'],$o_type2name,$abcd_h);//股东
            $back_set_f = $this->get_tuishuizhi($user_top['branch']['user_id'],$o_type2name,$abcd_h);//分公司    
	
	
               if($orders_y[$i]>0){

               $top_limit = mysql_fetch_array(mysql_query("select SUM(orders_y) as sum from orders where user_id={$_SESSION['uid'.$this->c_p_seesion()]} and plate_num={$qishu['plate_num']} and o_type2='{$o_type2}'  and o_type3='{$o_type3[$i]}'"));    
               $top_limits=$top_limit['sum']+$orders_y[$i];
               if(!empty($orders_y[$i]) && $back_set[bottom_limit]>$orders_y[$i]){
                   echo " <script> alert( '少于最低限额$back_set[bottom_limit],请重新下注1! ') ;window.location.href= '$url'; </script> " ; exit();
               }elseif(!empty($orders_y[$i]) &&  $orders_y[$i]>$back_set[top_limit]){
                   echo " <script> alert( '大于单号限额$back_set[top_limit],请重新下注2! ') ;window.location.href= '$url'; </script> " ; exit();
               }elseif(!empty($orders_y[$i]) &&  $top_limits>$back_set[odd_limit]){
                   echo " <script> alert( '大于最高限额$back_set[odd_limit],请重新下注3! ') ;window.location.href= '$url'; </script> " ; exit();    
               }  
 
                              //print_r($o_type3);exit;
               if(in_array($o_type3[$i],$shuangmian_type)){
                   $x_o_type1='正'.$xx.'特双面';
                   if($o_type==16 || $o_type==17){
                       //if($o_type3[$i]!='红波' || $o_type3[$i]!='蓝波' || $o_type3[$i]!='绿波')
                   $x_o_type1='特码双面';
                   }elseif($o_type==30 || $o_type==31){
                   $x_o_type1='正码双面';    
                   }             
               }
               if($o_type==44){
                       if(!is_numeric($o_type3[$i])){
                           $x_o_type1='一肖';
                           $o_type2='一肖';
                       }else{
                           $x_o_type1='尾数';
                           $o_type2='尾数';
                           $o_type=50;
                       }
               }  
               //$this->is_fenghao($o_type,$u_id,$o_type3,$orders_y);//判断是否封号 
               if(empty($is_duipeng)){
               $o_s_p=$this->get_min_order_p($u_id,$o_type,$o_typemin3,$orders_pmin,$o_type3[$i],$abcd_h);
               }else{
               $o_s_p=$this->get_min_order_p_dp($u_id,$o_type,$orders_pmin,$o_type3[$i],$abcd_h);      
               }
               $orders_p[$i]=$o_s_p[0];

               if($o_type>=32 && $o_type!=43 && $o_type!=44 && $o_type!=50 && $o_type<=62){  
//                    32->36 连码
//                    37->42 不中
//                    45->49 多生肖
//                    51->56 生肖连
//                    57->62 尾数连
                //$o_s_p=$this->get_min_order_p($u_id,$o_type,$o_typemin3,$orders_pmin,$o_type3[$i],$abcd_h);
                //$orders_p[$i]=$o_s_p[0];
                if($o_type==33 || $o_type==36){
                $orders_p_company_and=$o_s_p[1];
                }else{
                $orders_p_company_and=$o_s_p[0].'|'.$o_s_p[1];    
                }
               }elseif($o_type==15){ //过关赔率特殊处理
                 //$o_s_p=$this->get_min_order_p($u_id,$o_type,$o_typemin3,$orders_pmin,$o_type3[$i],$abcd_h);  
                 $orders_p_company_and=$o_s_p[0].'|'.$o_s_p[1];
                       $new_gg=$this->guoguannew($u_id,$o_type3[$i],$abcd_h);
                       $o_type3[$i]=$new_gg[0];
                       $orders_p[$i]=$new_gg[1];
               }else{
                   if($x_o_type1=='尾数'){
                   $orders_p_company=$this->get_one_order_p(50,$o_type3[$i],$abcd_h);    
                   }else{
                   //$orders_p_company=$this->get_one_order_p($o_type,$o_type3[$i],$abcd_h);
                   $orders_p_company=$o_s_p[1];
                   }
                 $orders_p_company_and=$o_s_p[0].'|'.$orders_p_company;   
               }
  
               $tuishui_y[$i]=$orders_y[$i]*$back_set_h/100;
               $keying_y[$i]=$orders_y[$i]*$orders_p[$i]-$orders_y[$i]+$tuishui_y[$i];
               //处理是否自动降水
//               $is_back=$this->is_autobacks($x_o_type1,$o_type2,$o_type3[$i],$orders_p[$i],$orders_y[$i],$qishu['plate_num'],$_SESSION['uid'.$this->c_p_seesion()]);
//               if($is_back[0]=='ok'){
//                   $orders_p[$i]=$is_back[1];
//               }
               if($o_type3[$i]=='红波' || $o_type3[$i]=='蓝波' || $o_type3[$i]=='绿波'){
                   $x_o_type1=$x_o_type1t;
               }

               if(($o_type>=16 && $o_type<=31) || $o_type==14 || $o_type==44 || $o_type==50){
                   //$newrate=$this->get_rate($o_type3[$i],$u_id);//最新赔率
               $this->update_total_bet($o_type,$o_type3[$i],$qishu['plate_num'],$orders_y[$i],$u_ids);//更新赔率里的下注总额
               }
               $sql="insert into orders (user_id,plate_num,time,o_type1,o_type2,o_type3,orders_y,orders_p,orders_p_2,abcd_h,h_tui,d_tui,zd_tui,gd_tui,f_tui,d_z,zd_z,gd_z,f_z,g_z,topd_id,topzd_id,topgd_id,topf_id,keying_y,tuishui_y,fly_user,is_fly,is_zhishu)values ('{$_SESSION['uid'.$this->c_p_seesion()]}','{$qishu['plate_num']}','{$x_time}','{$x_o_type1}','{$o_type2}','{$o_type3[$i]}','{$orders_y[$i]}','{$orders_p[$i]}','{$orders_p_company_and}','{$abcd_h}','{$back_set_h}','{$back_set_d}','{$back_set_zd}','{$back_set_gd}','{$back_set_f}','{$myuser['percent_proxy']}','{$myuser['percent_all_proxy']}','{$myuser['percent_partner']}','{$myuser['percent_branch']}','{$myuser['percent_company']}','{$user_top['proxy']['user_id']}','{$user_top['proxy_all']['user_id']}','{$user_top['partner']['user_id']}','{$user_top['branch']['user_id']}','{$keying_y[$i]}','{$tuishui_y[$i]}','{$user['is_fly']}','{$is_fly}','{$is_zhishu}')";
               $this->query($sql);
               
               foreach ($user_toparrs as $ki=> $uts) {      
                  //处理自动补货
                   if(in_array($x_o_type1,$bose_type_arr1)){
                         //判断一级类
                         $autoorder=$this->is_autoorders($x_o_type1,$user_toparrs[$ki]);
                   }elseif(in_array($o_type3[$i],$bose_type_arr3)){
                         //判断是否是波色
                         $autoorder=$this->is_autoorders($o_type3[$i],$user_toparrs[$ki]);
                   }elseif(in_array($o_type2,$bose_type_arr2)){
                         //判断二级类
                         $autoorder=$this->is_autoorders($o_type2,$user_toparrs[$ki]);
                   }else{
                         $autoorder=$this->is_autoorders($x_o_type1,$user_toparrs[$ki]);
                   }
                   if($autoorder[0]=='ok'){
                           $autoarrs=$this->auto_get_type3_zc($o_type3[$i],$user_toparrs[$ki],$qishu['plate_num'],$x_o_type1,$o_type2,$user_toppowerarrs[$ki],$o_type,$orders_p[$i]);
                         //$autoarrs=$this->get_total_for_auto($user_toparrs[$ki], $qishu['plate_num'], $user_toppowerarrs[$ki]);
                         $autoorders_y=floor($autoarrs-$autoorder[1]);
                         if($autoorders_y>=1){
                             $autoo_type3=explode(',', $o_type3[$i]);
                             $autoorders_y=explode(',', $autoorders_y);
                             $autoorders_p=explode(',', $orders_p[$i]);
                             $this->get_feiorders($qishu['plate_num'],$abcd_h,$x_o_type1,$o_type2,$autoo_type3,$autoorders_y,$autoorders_p,'0','0','1','1','0','no',$user_toparrs[$ki],$user_toppowerarrs[$ki]);
                         }
                   }
                 }//补货结束 
                  //处理是否自动降水
               $is_back=$this->is_autobacks($x_o_type1,$o_type2,$o_type3[$i],$orders_p[$i],$orders_y[$i],$qishu['plate_num'],$_SESSION['uid'.$this->c_p_seesion()]);
               }
            //   }else{
            //       if($back_set[bottom_limit]>$orders_y[$i]){
            //       $x_o_type3.='"'.o_type3[$i].'"'.'&nbsp;少于最低限额'.$back_set[bottom_limit].'<br>';  
            //       }
            //       if($orders_y[$i]>$back_set[top_limit]){
            //       $x_o_type3.='"'.o_type3[$i].'"'.'大于最高限额'.$back_set[top_limit].'<br>';    
            //       }
            }
//              }
//            if($x_orders_y_i){ 
                //更新余额
                $sql2 = "update users SET credit_remainder = $user_yue where user_id ={$_SESSION['uid'.$this->c_p_seesion()]}" ;
                $this->query($sql2);
                //同时记录该期该用户下注的总金额
                $orders_totalmones=  $this->select("orders_totalmoney", "id", "user_id={$_SESSION['uid'.$this->c_p_seesion()]} and plate_num={$qishu['plate_num']}");
                $orders_tm = $this->fetch_array($orders_totalmones);
                if($orders_tm[id]){
                  $sql3 = "update orders_totalmoney SET orders_tm = orders_tm+$x_orders_y_i where user_id ={$_SESSION['uid'.$this->c_p_seesion()]} and plate_num={$qishu['plate_num']}" ;
                  $this->query($sql3);   
                }else{
                  $this->query("INSERT INTO `orders_totalmoney` (`user_id`, `plate_num`,`orders_tm`) " .
                                    "VALUES ('{$_SESSION['uid'.$this->c_p_seesion()]}', '{$qishu['plate_num']}', '{$x_orders_y_i}')");  
                }
           // $this->reload_leftframe();
          
            echo " <script> alert('下注成功,请查看本期注单详细下注情况。') ;window.parent.document.getElementById('lleft').src='left.php';window.location.replace('$url');</script> " ;  exit();    
//            }else{

//            }
          
        }

//        //会员再次确定下注
//        public function get_get_orders($back_set_h,$back_set,$orders_y,$shuangmian_type,$u_id,$o_typemin3,$orders_pmin,$x_time,$orders_p,$back_set_d,$back_set_zd,$back_set_gd,$back_set_f,$myuser,$user_top,$user,$is_fly,$is_zhishu,$x_o_type1t,$o_type,$u_ids,$user_toparrs,$user_toppowerarrs,$abcd_h,$x_o_type1,$o_type2,$o_type3,$user_yue, $qishu,$x_orders_y_i,$url){
//            //自动补货分类
//             $bose_type_arr1=explode(',', "生肖连,尾数连,半波,过关,特码双面,正码双面,正1特双面,正2特双面,正3特双面,正4特双面,正5特双面,正6特双面");
//             $bose_type_arr2=explode(',', "特码A,特码B,正1特A,正1特B,正2特A,正2特B,正3特A,正3特B,正4特A,正4特B,正5特A,正5特B,正6特A,正6特B,正码A,正码B,特肖,二肖,三肖,四肖,五肖,六肖,一肖,尾数,五不中,六不中,七不中,八不中,九不中,十不中,二全中,二中特,特串,三全中,三中二");
//             $bose_type_arr3=explode(',', "红波,绿波,蓝波");  
//
//            //普通下注插入数据    
//            foreach ($o_type3 as $i => $v) {
//     
//               if($back_set[bottom_limit]<=$orders_y[$i] && $orders_y[$i]<=$back_set[top_limit]){ //是否大于最低限额小于最高限额
//               if($orders_y[$i]>0){
//                              //print_r($o_type3);exit;
//               if(in_array($o_type3[$i],$shuangmian_type)){
//                   $x_o_type1='正'.$xx.'特双面';
//                   if($o_type==16 || $o_type==17){
//                       //if($o_type3[$i]!='红波' || $o_type3[$i]!='蓝波' || $o_type3[$i]!='绿波')
//                   $x_o_type1='特码双面';
//                   }elseif($o_type==30 || $o_type==31){
//                   $x_o_type1='正码双面';    
//                   }             
//               }
//               if($o_type==44){
//                       if(!is_numeric($o_type3[$i])){
//                           $x_o_type1='一肖';
//                           $o_type2='一肖';
//                       }else{
//                           $x_o_type1='尾数';
//                           $o_type2='尾数';
//                       }
//               }     
//               if($o_type>=32 && $o_type!=43 && $o_type!=44 && $o_type!=50 && $o_type<=62){  
////                    32->36 连码
////                    37->42 不中
////                    45->49 多生肖
////                    51->56 生肖连
////                    57->62 尾数连
//                $o_s_p=$this->get_min_order_p($u_id,$o_type,$o_typemin3,$orders_pmin,$o_type3[$i],$abcd_h);
//                $orders_p[$i]=$o_s_p[0];
//                if($o_type==33 || $o_type==36){
//                $orders_p_company_and=$o_s_p[1];
//                }else{
//                $orders_p_company_and=$o_s_p[0].'|'.$o_s_p[1];    
//                }
//               }elseif($o_type==15){ //过关赔率特殊处理
//                 $o_s_p=$this->get_min_order_p($u_id,$o_type,$o_typemin3,$orders_pmin,$o_type3[$i],$abcd_h);  
//                 $orders_p_company_and=$o_s_p[0].'|'.$o_s_p[1];
//               }else{
//                   if($x_o_type1=='尾数'){
//                   $orders_p_company=$this->get_one_order_p(50,$o_type3[$i],$abcd_h);    
//                   }else{
//                   $orders_p_company=$this->get_one_order_p($o_type,$o_type3[$i],$abcd_h); 
//                   }
//                 $orders_p_company_and=$orders_p[$i].'|'.$orders_p_company;   
//               }
//  
//               $tuishui_y[$i]=$orders_y[$i]*$back_set_h/100;
//               $keying_y[$i]=$orders_y[$i]*$orders_p[$i]-$orders_y[$i]+$tuishui_y[$i];
//               //处理是否自动降水
//               $is_back=$this->is_autobacks($x_o_type1,$o_type2,$o_type3[$i],$orders_p[$i],$orders_y[$i],$qishu['plate_num'],$_SESSION['uid'.$this->c_p_seesion()]);
////               if($is_back[0]=='ok'){
////                   $orders_p[$i]=$is_back[1];
////               }
//               if($o_type3[$i]=='红波' || $o_type3[$i]=='蓝波' || $o_type3[$i]=='绿波'){
//                   $x_o_type1=$x_o_type1t;
//               }
//
//               if(($o_type>=16 && $o_type<=31) || $o_type==14 || $o_type==44 || $o_type==50){
//                   //$newrate=$this->get_rate($o_type3[$i],$u_id);//最新赔率
//               $this->update_total_bet($o_type,$o_type3[$i],$qishu['plate_num'],$orders_y[$i],$u_ids);//更新赔率里的下注总额
//               }
//               $sql="insert into orders (user_id,plate_num,time,o_type1,o_type2,o_type3,orders_y,orders_p,orders_p_2,abcd_h,h_tui,d_tui,zd_tui,gd_tui,f_tui,d_z,zd_z,gd_z,f_z,g_z,topd_id,topzd_id,topgd_id,topf_id,keying_y,tuishui_y,fly_user,is_fly,is_zhishu)values ('{$_SESSION['uid'.$this->c_p_seesion()]}','{$qishu['plate_num']}','{$x_time}','{$x_o_type1}','{$o_type2}','{$o_type3[$i]}','{$orders_y[$i]}','{$orders_p[$i]}','{$orders_p_company_and}','{$abcd_h}','{$back_set_h}','{$back_set_d}','{$back_set_zd}','{$back_set_gd}','{$back_set_f}','{$myuser['percent_proxy']}','{$myuser['percent_all_proxy']}','{$myuser['percent_partner']}','{$myuser['percent_branch']}','{$myuser['percent_company']}','{$user_top['proxy']['user_id']}','{$user_top['proxy_all']['user_id']}','{$user_top['partner']['user_id']}','{$user_top['branch']['user_id']}','{$keying_y[$i]}','{$tuishui_y[$i]}','{$user['is_fly']}','{$is_fly}','{$is_zhishu}')";
//               $this->query($sql);
//               
//               foreach ($user_toparrs as $ki=> $uts) {      
//                  //处理自动补货
//                   if(in_array($x_o_type1,$bose_type_arr1)){
//                         //判断一级类
//                         $autoorder=$this->is_autoorders($x_o_type1,$user_toparrs[$ki]);
//                   }elseif(in_array($o_type3[$i],$bose_type_arr3)){
//                         //判断是否是波色
//                         $autoorder=$this->is_autoorders($o_type3[$i],$user_toparrs[$ki]);
//                   }elseif(in_array($o_type2,$bose_type_arr2)){
//                         //判断二级类
//                         $autoorder=$this->is_autoorders($o_type2,$user_toparrs[$ki]);
//                   }else{
//                         $autoorder=$this->is_autoorders($x_o_type1,$user_toparrs[$ki]);
//                   }
//                   if($autoorder[0]=='ok'){
//                           $autoarrs=$this->auto_get_type3_zc($o_type3[$i],$user_toparrs[$ki],$qishu['plate_num'],$x_o_type1,$o_type2,$user_toppowerarrs[$ki],$o_type,$orders_p[$i]);
//                         //$autoarrs=$this->get_total_for_auto($user_toparrs[$ki], $qishu['plate_num'], $user_toppowerarrs[$ki]);
//                         $autoorders_y=floor($autoarrs-$autoorder[1]);
//                         if($autoorders_y>=1){
//                             $autoo_type3=explode(',', $o_type3[$i]);
//                             $autoorders_y=explode(',', $autoorders_y);
//                             $autoorders_p=explode(',', $orders_p[$i]);
//                             $this->get_feiorders($qishu['plate_num'],$abcd_h,$x_o_type1,$o_type2,$autoo_type3,$autoorders_y,$autoorders_p,'0','0','1','1','0','no',$user_toparrs[$ki],$user_toppowerarrs[$ki]);
//                         }
//                   }
//                 }//补货结束 
//               }
//               }
//            }
//            if($x_orders_y_i){ 
//                //更新余额
//                $sql2 = "update users SET credit_remainder = $user_yue where user_id ={$_SESSION['uid'.$this->c_p_seesion()]}" ;
//                $this->query($sql2);
//                //同时记录该期该用户下注的总金额
//                $orders_totalmones=  $this->select("orders_totalmoney", "id", "user_id={$_SESSION['uid'.$this->c_p_seesion()]} and plate_num={$qishu['plate_num']}");
//                $orders_tm = $this->fetch_array($orders_totalmones);
//                if($orders_tm[id]){
//                  $sql3 = "update orders_totalmoney SET orders_tm = orders_tm+$x_orders_y_i where user_id ={$_SESSION['uid'.$this->c_p_seesion()]} and plate_num={$qishu['plate_num']}" ;
//                  $this->query($sql3);   
//                }else{
//                  $this->query("INSERT INTO `orders_totalmoney` (`user_id`, `plate_num`,`orders_tm`) " .
//                                    "VALUES ('{$_SESSION['uid'.$this->c_p_seesion()]}', '{$qishu['plate_num']}', '{$x_orders_y_i}')");  
//                }
//           // $this->reload_leftframe();
  
//            }else{
//            }
//        }
        
        //左边栏刷新
        public function reload_leftframe(){
	echo '<script>alert("下注成功,请查看本期注单详细下注情况。");window.parent.document.getElementById(\'lleft\').src = "left.php";</script>';
        }
 
        //判断是否自动降水
        public function is_autobacks($type1,$type2,$type3,$order_p,$order_y,$plate_num,$user_id){
                $type3_arr=explode(',', $type3);
                
                if($type1=="特码" || $type1=="特码双面"){
                $oids=array(16,17);
                }elseif($type1=="正1特" || $type1=="正1特双面"){
                $oids=array(18,19);
                }elseif($type1=="正2特" || $type1=="正2特双面"){
                $oids=array(20,21);
                }elseif($type1=="正3特" || $type1=="正3特双面"){
                $oids=array(22,23);
                }elseif($type1=="正4特" || $type1=="正4特双面"){
                $oids=array(24,25);
                }elseif($type1=="正5特" || $type1=="正5特双面"){
                $oids=array(26,27);
                }elseif($type1=="正6特" || $type1=="正6特双面"){
                $oids=array(28,29);
                }elseif($type1=="正码" || $type1=="正码双面"){
                $oids=array(30,31);
                }elseif($type1=="半波"){
                $oids=array(14);
                }elseif($type1=="尾数"){
                $oids=array(50);
                }elseif($type1=="特肖"){
                $oids=array(43);
                }elseif($type1=="一肖"){
                $oids=array(44);
                }elseif($type2=="二肖"){
                $oids=array(45);
                }elseif($type2=="三肖"){
                $oids=array(46);
                }elseif($type2=="四肖"){
                $oids=array(47);
                }elseif($type2=="五肖"){
                $oids=array(48);
                }elseif($type2=="六肖"){
                $oids=array(49);
            }
            
            
            if(in_array($type1,explode(',', "特码,正特,正1特,正2特,正3特,正4特,正5特,正6特,正码,特肖,一肖,尾数,半波"))){
                if(in_array($type1,explode(',', "正特,正1特,正2特,正3特,正4特,正5特,正6特"))){
                    $o_typename='正特';
                    $intype="'正1特','正2特','正3特','正4特','正5特','正6特'";

                }else{
                    $o_typename=$type1;
                    $intype=$type1;
                }                
            }elseif(in_array($type2,explode(',', "二肖,三肖,四肖,五肖,六肖"))){
            $o_typename=$type2;
            }elseif(in_array($type3,explode(',', "特单,特双,特大,特小,合单,合双,尾小,尾大,家禽,野兽,单,双,大,小,总单,总双,总大,总小"))){
            $o_typename='两面';
            $intype="'特单','特双','特大','特小','合单','合双','尾小','尾大','家禽','野兽','单','双','大','小','总单','总双','总大','总小'";
            }elseif(in_array($type3,explode(',', "红波,绿波,蓝波"))){
            $o_typename='波色';
            $intype="'红波','绿波','蓝波'";
            }
            
            if(in_array($type2,explode(',', "二肖,三肖,四肖,五肖,六肖"))){
            $user_zonge = mysql_fetch_array(mysql_query("select SUM(orders_y) as sum from orders where o_type2='$type2' and o_type3='$type3' and plate_num=$plate_num and is_fly=0"));
            }else{
            $user_zonge = mysql_fetch_array(mysql_query("select SUM(orders_y) as sum from orders where o_type1='$type1' and o_type3='$type3' and plate_num=$plate_num and is_fly=0"));
            }
            
            //叼这里不用处理已下注的总额，fuck
            //$user_zonge=0;
            if(!empty($o_typename)){          
            $autorain_backs=  $this->select("autorain_set", "autodesc_limit,desc_odds,lowest_odds,amode,is_use", "o_typename='$o_typename'");
            $autorain_back = $this->fetch_array($autorain_backs);
            
            $gaiusers_zs=  $this->select("users", "percent_company", "user_id=$user_id");
            $gaiuser_zs = $this->fetch_array($gaiusers_zs);
            $pei=$gaiuser_zs['percent_company']/100;
            
            $user_zonge=round($user_zonge[sum],2);//该类型3已下注的所有总额
            $user_zonge=$user_zonge-$order_y;
            if($autorain_back['amode']==0){// 按总额自动退水
            $zhengbeishu=floor($user_zonge/$autorain_back['autodesc_limit']); //倍数
            $yushu=$user_zonge-($zhengbeishu*$autorain_back['autodesc_limit']);
            $zzong=$yushu+$order_y;//当超过控制额就自动降水
            }else{
            $zhengbeishu=floor($user_zonge*$pei/$autorain_back['autodesc_limit']); //倍数
            $yushu=$user_zonge*$pei-($zhengbeishu*$autorain_back['autodesc_limit']);
            $zzong=$yushu+($order_y*$pei);//当超过控制额就自动降水    
            }
           // $pzong=$user_zonge+$order_y;
           // echo $zzong;
            //第一次下注超额处理
//            if($order_y==$pzong && $order_y>$autorain_back['autodesc_limit']){
//                $kaishi_y=$autorain_back['autodesc_limit']*$autorain_back['desc_odds'];
//            }else{
//                $kaishi_y=0;
//            }
            
            //echo $pzong.'<br>';
            if($autorain_back['is_use'] && $zzong>=$autorain_back['autodesc_limit']){ //是否开启了自动退水 并且大于最低限额  
                //$cha=$pzong-$autorain_back['autodesc_limit'];
                //if($pzong==$autorain_back['autodesc_limit']){$order_y=$pzong;}
                //if($autorain_back['amode']==0){
                $descodds=$order_p-(floor($zzong/$autorain_back['autodesc_limit'])*$autorain_back['desc_odds']);//最终下降后的赔率
                $down_p=floor($zzong/$autorain_back['autodesc_limit'])*$autorain_back['desc_odds'];//下降的赔率

                if($descodds<$autorain_back['lowest_odds']){ //退水后赔率是否少于最低赔率
                      $shijiodds=$autorain_back['lowest_odds'];
                }else{
                      $shijiodds=round($descodds,2);
                }                             
                
                //更新对应赔率
                foreach ($oids as $oid){
                    //$type3_arr
                    if(in_array($type2,explode(',', "二肖,三肖,四肖,五肖,六肖"))){
                        //暂时屏蔽"二肖,三肖,四肖,五肖,六肖"，多选时不合理
                       // foreach ($type3_arr as $te3){
                       //    $this->update_autobacks($oid,$te3,$down_p,$plate_num,$autorain_back['lowest_odds']);  
                       // }
                    }else{
                           $this->update_autobacks($oid,$type3,$down_p,$plate_num,$autorain_back['lowest_odds']);  
                    }                 
                }
                
                if(in_array($type2,explode(',', "二肖,三肖,四肖,五肖,六肖"))){
                    $autoback=array('no',$order_p);//暂时屏蔽"二肖,三肖,四肖,五肖,六肖"，多选时不合理
                }else{
                $autoback=array('ok',$shijiodds);
                }
                }else{
                $autoback=array('no',$order_p); 
            }
            
            }else{
                $autoback=array('no',$order_p);
            }      
             //return $autoback;
        }
        
        //更新单个赔率值
        public function update_autobacks($oid,$t3,$down_p,$plate_num,$lowest_odds) {
            //$t3='大';
            //$down_p=3;
            //$content_arr=array(",单:1.9:0:0,双:1.9:0:0,大:1.9:0:0,小:1.9:0:0,");
            $y =  $this->select("odds_set", "o_content,user_id","plate_num=$plate_num and o_id={$oid} order by user_id asc");
            while($row= $this->fetch_array($y)) {
            $content_arr[]=$row['o_content'];
            $userzs_arr[]=$row['user_id'];
             }

            $i=-1;
            foreach ($content_arr as $ct){
            $i++;
            $tos_arr = explode(',', trim($ct,','));
               foreach ($tos_arr as $to){
                   $o_arr = explode(':', $to);
                   if($o_arr[0]==$t3){
                       $down_odd=$o_arr[1]-$down_p;
                            if($down_odd<$lowest_odds){ //退水后赔率是否少于最低赔率
                                  $shijiodds=$lowest_odds;
                            }else{
                                  $shijiodds=round($down_odd,2);
                            }
                       $to=$o_arr[0].':'.$shijiodds.':'.$o_arr[2].':'.$o_arr[3];
                   }
                   $toi.=$to.',';
               }
               $o_con=','.trim($toi, ',').',';
            $this->update("odds_set", "o_content='$o_con'", "o_id={$oid} and user_id={$userzs_arr[$i]} and plate_num=$plate_num");
            unset($toi);
            unset($o_con);
            }
        }
        
        //更新赔率赔率设置里对应的下注总额
        public function update_total_bet($oid,$t3,$plate_num,$order_y,$u_ids) {
            foreach ($u_ids as $us){
            $y =  $this->select("odds_set", "o_content","user_id=$us and plate_num=$plate_num and o_id={$oid} limit 0,1");
            $yy= $this->fetch_array($y);
            $tos_arr = explode(',', trim($yy['o_content'],','));
               foreach ($tos_arr as $to){
                   $o_arr = explode(':', $to);
                   if($o_arr[0]==$t3){
                       $up_y=$o_arr[3]+$order_y;
                       $to=$o_arr[0].':'.$o_arr[1].':'.$o_arr[2].':'.$up_y;
                   }
                   $toi.=$to.',';
               }
               $o_con=','.trim($toi, ',').',';    
               $this->update("odds_set", "o_content='$o_con'", "o_id={$oid} and user_id=$us and plate_num=$plate_num");
               unset($toi);
               unset($o_con);
            }
        }
        
        //清除数据时赔率设置里对应的下注总额统一为0
        public function del_total_bet($plate_num) {
            $y =  $this->select("odds_set", "o_content,o_id,user_id","plate_num=$plate_num and user_id>0  order by user_id asc");
            $yy = $this->fetch_array($y);
            while($yy = $this->fetch_array($y)) {
                $yys[]=trim($yy['user_id'].'!'.$yy['o_id'].'!'.$yy['o_content']);
            }
            foreach ($yys as $yy){
            $yys_arr = explode('!', $yy);
            $tos_arr = explode(',', trim($yys_arr[2],','));
               foreach ($tos_arr as $to){
                   $o_arr = explode(':', $to);
                   $to=$o_arr[0].':'.$o_arr[1].':'.$o_arr[2].':0';
                   $toi.=$to.',';
               }
               $o_con=','.trim($toi, ',').',';    
               $this->update("odds_set", "o_content='$o_con'", "o_id={$yys_arr[1]} and user_id={$yys_arr[0]} and plate_num=$plate_num");
               unset($toi);
               unset($o_con);
            }
            
        }
        
        //判断两个赔率，不能超公司赔率
        public function is_exceed_company_odds($oid,$plate_num,$o_content) {
            $y =  $this->select("odds_set", "o_content","user_id=1 and plate_num=$plate_num and o_id={$oid} limit 0,1");
            $yy= $this->fetch_array($y);
            $tos_arr = explode(',', trim($yy['o_content'],','));
            $mys_arr = explode(',', trim($o_content,','));
               foreach ($tos_arr as $to){
                   $o_arr = explode(':', $to);
                       $o1[]=$o_arr[1];
               }
               foreach ($mys_arr as $my){
                   $m_arr = explode(':', $my);
                       $m1[]=$m_arr[1];
               }
               $countarr=count($o1);
               for ($i = 0; $i < $countarr; $i++) {
                   if($m1[$i]>$o1[$i]){
                       $this->Get_admin_msg($_SERVER['HTTP_REFERER'],'不能超过公司赔率，请重新设置。');exit;
                   }
               }
        }
        
        
        //添加某个用户的赔率,这里将总额还原成0；
        public function add_user_plate_num_odds($user_id,$plate_num) {
            $y =  $this->select("odds_set", "o_content,o_id","user_id=$user_id and plate_num=$plate_num and o_id>0 order by o_id asc");
            while($yy = $this->fetch_array($y)){  
                $o_id_arrs[]=$yy['o_id'];
            }
            $o_id_arr=array_flip(array_flip($o_id_arrs));//删除重复            
            foreach ($o_id_arr as $key=>$o_id){
               $yd =  $this->select("odds_set", "o_content","user_id=$user_id and plate_num=$plate_num and o_id=$o_id order by o_id asc limit 0,1");
               $d= $this->fetch_array($yd);
               $tos_arr = explode(',', trim($d['o_content'],','));              
               foreach ($tos_arr as $to){
                   $o_arr = explode(':', $to);
                   if($o_arr[3]>0){
                       $up_y=0;
                       $to=$o_arr[0].':'.$o_arr[1].':'.$o_arr[2].':'.$up_y;
                   }
                   $toi.=$to.',';
               }
               $o_con=','.trim($toi, ',').',';
               $this->update("odds_set", "o_content='$o_con'", "o_id={$o_id} and user_id=$user_id and plate_num=$plate_num");
               unset($to);
               unset($toi);
               unset($o_con);
            }      
        }
        
        //修改单个类型赔率时同步更新下级赔率，不能大于公司赔率
        public function update_down_odds($oid,$plate_num) {
            $y =  $this->select("odds_set", "o_content","user_id=1 and plate_num=$plate_num and o_id={$oid} limit 0,1");
            $yy= $this->fetch_array($y);
            $tos_arr = explode(',', trim($yy['o_content'], ','));
              foreach ($tos_arr as $to){
                   $o_arr = explode(':', $to);
                       //$o0[]=$o_arr[0];
                       $o1[]=$o_arr[1];
                       //$o2[]=$o_arr[2];
                       //$o3[]=$o_arr[3];
               }
            $countarr=count($o1);   
            $u =  $this->select("users", "user_id","top_id=1");
            while($uu= $this->fetch_array($u)){  
                $uu_arrs[]=$uu['user_id'];
            }    
            //print_r($uu_arrs);exit;
            $uu_arr=array_flip(array_flip($uu_arrs));//删除重复    
            foreach ($uu_arr as $us){
                $d =  $this->select("odds_set", "o_content","user_id=$us and plate_num=$plate_num and o_id={$oid} limit 0,1");
                $dd= $this->fetch_array($d);
                $mys_arr = explode(',', trim($dd['o_content'], ','));
                foreach ($mys_arr as $my){
                   $m_arr = explode(':', $my);
                       $m0[]=$m_arr[0];
                       $m1[]=$m_arr[1];
                       $m2[]=$m_arr[2];
                       $m3[]=$m_arr[3];
                }
                for ($i = 0; $i < $countarr; $i++) {
                   //if(!$m0[$i]){
                   $to=$m0[$i].':'.$m1[$i].':'.$m2[$i].':'.$m3[$i];
                   //}
                   if($m1[$i]>$o1[$i]){                     
                       $to=$m0[$i].':'.$o1[$i].':'.$m2[$i].':'.$m3[$i];                   
                   }
                   $toi.=$to.',';
                }
                $o_con=','.trim($toi, ',').',';
                $this->update("odds_set", "o_content='$o_con'", "o_id={$oid} and user_id=$us and plate_num=$plate_num");
                $this->update_another_odd($oid,$plate_num,$us);//再次同步ab盘率差
                unset($to);
                unset($toi);
                unset($o_con);
                unset($m0);
                unset($m1);
                unset($m2);
                unset($m3);
                //unset($o1);
            }     
        }
        
//        public function autobacks_p($type1,$type2,$type3,$plate_num){
//            if(in_array($type1,explode(',', "特码,正特,正1特,正2特,正3特,正4特,正5特,正6特,正码,特肖,一肖,尾数,半波"))){
//                if(in_array($type1,explode(',', "正特,正1特,正2特,正3特,正4特,正5特,正6特"))){
//                    $o_typename='正特';
//                    $intype="'正1特','正2特','正3特','正4特','正5特','正6特'";
//                    //查下注该类型的当前已下注的总额
//                    $user_zonge = mysql_fetch_array(mysql_query("select SUM(orders_y) as sum from orders where o_type1 in($intype) and plate_num=$plate_num"));   
//                }else{                   
//                    $o_typename=$type1;
//                    $intype=$type1;
//                    //查下注该类型的当前已下注的总额
//                    $user_zonge = mysql_fetch_array(mysql_query("select SUM(orders_y) as sum from orders where o_type1='$intype' and plate_num=$plate_num"));   
//                }    
//                 
//            }elseif(in_array($type2,explode(',', "二肖,三肖,四肖,五肖,六肖"))){
//            $o_typename=$type2;
//            //查下注该类型的当前已下注的总额
//            $user_zonge = mysql_fetch_array(mysql_query("select SUM(orders_y) as sum from orders where o_type2='$type2' and plate_num=$plate_num"));
//            }elseif(in_array($type3,explode(',', "特单,特双,特大,特小,合单,合双,尾小,尾大,家禽,野兽,单,双,大,小,总单,总双,总大,总小"))){
//            $o_typename='两面';
//            $intype="'特单','特双','特大','特小','合单','合双','尾小','尾大','家禽','野兽','单','双','大','小','总单','总双','总大','总小'";
//             //查下注该类型的当前已下注的总额
//            $user_zonge = mysql_fetch_array(mysql_query("select SUM(orders_y) as sum from orders where o_type3 in($intype) and plate_num=$plate_num"));          
//            }elseif(in_array($type3,explode(',', "红波,绿波,蓝波"))){
//            $o_typename='波色';
//            $intype="'红波','绿波','蓝波'";
//            //查下注该类型的当前已下注的总额
//            $user_zonge = mysql_fetch_array(mysql_query("select SUM(orders_y) as sum from orders where o_type3 in($intype) and plate_num=$plate_num"));           
//            }
//            if(!empty($o_typename)){
//            $autorain_backs=  $this->select("autorain_set", "autodesc_limit,desc_odds,lowest_odds,amode,is_use", "o_typename='$o_typename'");
//            $autorain_back = $this->fetch_array($autorain_backs);
//            $user_zonge=round($user_zonge[sum],2);
//            if($autorain_back['is_use'] && $user_zonge>$autorain_back['autodesc_limit']){ //是否开启了自动退水 并且大于最低限额              
//                if($autorain_back['amode']==0){// 按总额自动退水
//                $descodds=(($user_zonge-$autorain_back['autodesc_limit'])/$autorain_back['autodesc_limit'])*$autorain_back['desc_odds'];
//                }else{
//                $descodds=(($user_zonge-$autorain_back['autodesc_limit'])/$autorain_back['autodesc_limit'])*$autorain_back['desc_odds'];//按占成自动退水，暂时不知道点样处理，暂设置和总额自动退水一样
//                }
//                $shijiodds=round($descodds,2);
//                //$autoback=array('ok',$shijiodds,$autorain_back['lowest_odds']);//返回下降的赔率和最低的赔率
//                $autoback=array('no'); 
//                }else{
//                $autoback=array('no'); 
//            }
//            
//            }else{
//                $autoback=array('no');
//            }      
//             return $autoback;
//        }
        
        //判断是否满足自动补货
        public function is_autoorders($auto_ordertype,$t_uid){
            //特殊处理
//                两面  （$x_o_type1='特码双面'  $x_o_type1='正码双面' $x_o_type1='正1特双面' $x_o_type1='正2特双面' $x_o_type1='正3特双面' $x_o_type1='正4特双面' $x_o_type1='正5特双面' $x_o_type1='正6特双面'）
//                波色   （$o_type3[$i]='红波' $o_type3[$i]='绿波' $o_type3[$i]='蓝波'）
//                半波   （$x_o_type1='半波'）
//                过关   （$x_o_type1='过关'）
//                尾数连 （$x_o_type1='尾数连'）
//                生肖连 （$x_o_type1='生肖连'）
            
                $all_type_arr1=explode(',', "特码双面,正码双面,正1特双面,正2特双面,正3特双面,正4特双面,正5特双面,正6特双面");
                $all_type_arr2=explode(',', "红波,绿波,蓝波");
             $uis_adds=$this->select("users", "is_add", "user_id=$t_uid"); 
             $uis=$this->fetch_array($uis_adds); 
             //$uis['is_add'] //为0为允许补货，为1为禁止补货
           if($uis['is_add']==0){
            if(in_array($auto_ordertype,$all_type_arr1)){
                 //两面
                $o_typename='两面';
            }elseif(in_array($auto_ordertype,$all_type_arr2)){
                //波色
                $o_typename='波色';
            }else{
                $o_typename=$auto_ordertype;
            }
            $orders_backs=  $this->select("backorder_set", "control_limit,user_id,is_use", "user_id={$t_uid} and o_typename='$o_typename' and is_use=1");
            $orders_back = $this->fetch_array($orders_backs);
            if($orders_back['is_use']){
                $autoorder=array('ok',$orders_back['control_limit']);
            }else{
                $autoorder=array('no',0);
            }     
           }else{
                $autoorder=array('no',0);
           }
                return $autoorder;
        }
        
//    function get_total_for_auto($user_id, $plate_num, $user_power){
//        $t1=array('生肖连','尾数连','半波','过关','特码双面','正码双面','正1特双面','正2特双面','正3特双面','正4特双面','正5特双面','正6特双面');
//        $t2=array('特码A','特码B','正1特A','正1特B','正2特A','正2特B','正3特A','正3特B','正4特A','正4特B','正5特A','正5特B','正6特A','正6特B','正码A','正码B','特肖','二肖','三肖','四肖','五肖','六肖','一肖','尾数','五不中','六不中','七不中','八不中','九不中','十不中','二全中','二中特','特串','三全中','三中二');
//        $t3=array('红波','绿波','蓝波');
//        $m1=  $this->get_total_for_auto_y($t1, 1, $user_id, $plate_num, $user_power);
//        $m2=  $this->get_total_for_auto_y($t2, 2, $user_id, $plate_num, $user_power);
//        $m3=  $this->get_total_for_auto_y($t3, 3, $user_id, $plate_num, $user_power);
//        $msg=array_merge($m1, $m2,$m3);
//        return $msg;
//    }
//    
//    function get_total_for_auto_y($t,$ty,$user_id,$plate_num,$user_power){
//        $msg=array();
//        foreach($t as $v):
//            if($ty==1){
//                $sql="select a.*,b.is_fly from orders a left join users b on a.topf_id=b.user_id where a.plate_num='$plate_num' and a.o_type1='$v'";
//            }elseif($ty==2){
//                $sql="select a.*,b.is_fly from orders a left join users b on a.topf_id=b.user_id where a.plate_num='$plate_num' and a.o_type2='$v'";
//            }elseif($ty==3){
//                $sql="select a.*,b.is_fly from orders a left join users b on a.topf_id=b.user_id where a.plate_num='$plate_num' and a.o_type3='$v'";
//            }
//            $x =  $this->query($sql);
//            $percent=0;
//            while($r =  $this->fetch_array($x)):
//                switch ($user_power):
//                    case 1:
//                        if($r['topd_id']!=0){
//                          //$total+=$r['orders_y'];//会员的下注金额
//                          $percent+=round($r['orders_y']*$r['g_z']/100,1);
//                       }else if($r['is_fly']==1){
//                          //$total+=$r['orders_y'];//走飞归全公司金额
//                          $percent+=$r['orders_y'];
//                       }else if($r['is_fly']==2){
//                          //$total+=round($r['orders_y']*$r['g_z']/100,1);//按各级成数归属分配到全公司金额
//                          $percent+=round($r['orders_y']*$r['g_z']/100,1);
//                       }
//                       if($r['user_id']==$user_id){
//                          //$total+=$r['orders_y'];//自己走飞金额
//                          $percent-=$r['orders_y'];
//                       }
//                        break;
//                    case 2:
//                        if($r['topf_id']==$user_id){
//                            if($r['topd_id']!=0){
//                                    //$total+=$r['orders_y'];//会员的下注金额
//                                    $percent+=round($r['orders_y']*$r['f_z']/100,1);
//                            }else if($r['is_fly']==0 && !is_null($r['is_fly'])){
//                                //$total+=$r['orders_y'];//走飞归分公司金额
//                                $percent+=$r['orders_y'];
//                            }else if($r['is_fly']==2){
//                                //$total+=round($r['orders_y']*$r['f_z']/100,1);//按各级成数归属分配到分公司金额
//                                $percent+=round($r['orders_y']*$r['f_z']/100,1);
//                            }
//                       }
//                       if($r['user_id']==$user_id){
//                            //$total+=$r['orders_y'];//自己走飞金额
//                            $percent-=$r['orders_y'];
//                        }
//                        break;
//                    case 3:
//                       if($r['topgd_id']==$user_id){
//                            if($r['topd_id']!=0){
//                                    //$total+=$r['orders_y'];//会员的下注金额
//                                    $percent+=round($r['orders_y']*$r['gd_z']/100,1);
//                            }else if($r['is_fly']==2){
//                                //$total+=round($r['orders_y']*$r['gd_z']/100,1);//按各级成数归属分配到分公司金额
//                                $percent+=round($r['orders_y']*$r['gd_z']/100,1);
//                            }
//                       }
//                       if($r['user_id']==$user_id){
//                            //$total+=$r['orders_y'];//自己走飞金额
//                            $percent-=$r['orders_y'];
//                        }
//                       break;
//                   case 4:
//                       if($r['topzd_id']==$user_id){
//                            if($r['topd_id']!=0){
//                                    //$total+=$r['orders_y'];//会员的下注金额
//                                    $percent+=round($r['orders_y']*$r['zd_z']/100,1);
//                            }else if($r['is_fly']==2){
//                                //$total+=round($r['orders_y']*$r['zd_z']/100,1);//按各级成数归属分配到分公司金额
//                                $percent+=round($r['orders_y']*$r['zd_z']/100,1);
//                            }
//                       }
//                       if($r['user_id']==$user_id){
//                            //$total+=$r['orders_y'];//自己走飞金额
//                            $percent-=$r['orders_y'];
//                        }
//                       break;
//                    case 5:
//                       if($r['topd_id']==$user_id){
//                            if($r['topd_id']!=0){
//                                    //$total+=$r['orders_y'];//会员的下注金额
//                                    $percent+=round($r['orders_y']*$r['d_z']/100,1);
//                            }else if($r['is_fly']==2){
//                                //$total+=round($r['orders_y']*$r['d_z']/100,1);//按各级成数归属分配到分公司金额
//                                $percent+=round($r['orders_y']*$r['d_z']/100,1);
//                            }
//                       }
//                       if($r['user_id']==$user_id){
//                            //$total+=$r['orders_y'];//自己走飞金额
//                            $percent-=$r['orders_y'];
//                        }
//                       break;
//
//                    default:
//                        break;
//                endswitch;
//            endwhile;
//           $msg[$v]=$percent; 
//       endforeach;
//       return $msg;
//    }

    //获取类型3的走飞值
    function auto_get_type3_zc($i,$user_id,$plate_num,$t1,$t2,$user_power,$kx_oid,$rate){
            $querykx= $this->select("single_set", "*", "user_id=$user_id and `o_id`=$kx_oid");
            $kxs=$this->fetch_array($querykx);
            $kx=$kxs['kx_value'];
            
            $sql="select a.*,b.is_fly from orders a left join users b on a.topf_id=b.user_id where a.plate_num='$plate_num' and a.o_type1='$t1' and a.o_type2='$t2' and a.o_type3='$i'";
            $x =  $this->query($sql);
            $percent=0;//占成值;
            while($r =  $this->fetch_array($x)){
                switch ($user_power) {
                    case 1:
                       if($r['topd_id']!=0){
                          $percent+=round($r['orders_y']*$r['g_z']/100,1);
                       }else if($r['is_fly']==1){
                          $percent+=$r['orders_y'];
                       }else if($r['is_fly']==2){
                          $percent+=round($r['orders_y']*$r['g_z']/100,1);
                       }
                       
                       if($r['user_id']==$user_id){
                          $percent-=$r['orders_y'];
			  $yf=$r['orders_y'];
                       }
                       break;
                   case 2:
                       if($r['topf_id']==$user_id){
                            if($r['topd_id']!=0){
                                    $percent+=round($r['orders_y']*$r['f_z']/100,1);
                            }else if($r['is_fly']==0 && !is_null($r['is_fly'])){
                                $percent+=$r['orders_y'];
                            }else if($r['is_fly']==2){
                                $percent+=round($r['orders_y']*$r['f_z']/100,1);
                            }
                       }
                       if($r['user_id']==$user_id){
                            $percent-=$r['orders_y'];
			    $yf=$r['orders_y'];
                        }
                       break;
                   case 3:
                       if($r['topgd_id']==$user_id){
                            if($r['topd_id']!=0){
                                    $percent+=round($r['orders_y']*$r['gd_z']/100,1);
                            }else if($r['is_fly']==2){
                                $percent+=round($r['orders_y']*$r['gd_z']/100,1);
                            }
                       }
                       if($r['user_id']==$user_id){
                            $percent-=$r['orders_y'];
			    $yf=$r['orders_y'];
                        }
                       break;
                   case 4:
                       if($r['topzd_id']==$user_id){
                            if($r['topd_id']!=0){
                                    $percent+=round($r['orders_y']*$r['zd_z']/100,1);
                            }else if($r['is_fly']==2){
                                $percent+=round($r['orders_y']*$r['zd_z']/100,1);
                            }
                       }
                       if($r['user_id']==$user_id){
                            $percent-=$r['orders_y'];
			    $yf=$r['orders_y'];
                        }
                       break;
                    case 5:
                       if($r['topd_id']==$user_id){
                            if($r['topd_id']!=0){
                                    $percent+=round($r['orders_y']*$r['d_z']/100,1);
                            }else if($r['is_fly']==2){
                                $percent+=round($r['orders_y']*$r['d_z']/100,1);
                            }
                       }
                       if($r['user_id']==$user_id){
                            $percent-=$r['orders_y'];
			    $yf=$r['orders_y'];
                        }
                       break;

                    default:
                        break;
                }
            }

	    $yl=-$percent*$rate;
            if($percent>0){
                $zf=$percent;
            }
            if($yl<0){
                $zf= (int)((-$yl-$kx)/$rate);
            }
            $zf-=$yf;
            if($zf<0)$zf=0;
            
//            echo $total.',';
            //凑成数组
           // $imm_detail[$i]=$zf;
            
        return $zf;
    }

    
        public function down_fly($t_uid,$t_upower,$user_is_fly){
            $this->get_tops($t_uid);
            $user_top=$this->tops;

           if($user_is_fly==0){
                    //下注用户的所有上级用户id
                    $user_toparr=explode(',', "{$user_top['company']['user_id']}"); 
                    $user_toparrs=array_flip(array_flip($user_toparr));//删除重复
                    $user_toppowerarr=explode(',', "{$user_top['company']['user_power']}"); 
                    $user_toppowerarrs=array_flip(array_flip($user_toppowerarr));//删除重复
           }elseif($user_is_fly==1){
                    //下注用户的所有上级用户id
                    $user_toparr=explode(',', "{$user_top['branch']['user_id']}"); 
                    $user_toparrs=array_flip(array_flip($user_toparr));//删除重复
                    $user_toppowerarr=explode(',', "{$user_top['branch']['user_power']}"); 
                    $user_toppowerarrs=array_flip(array_flip($user_toppowerarr));//删除重复
           }else{
                if($t_upower==1){
                            //下注用户的所有上级用户id
                            $user_toparr=explode(',', "{$user_top['company']['user_id']}"); 
                            $user_toparrs=array_flip(array_flip($user_toparr));//删除重复
                            $user_toppowerarr=explode(',', "{$user_top['company']['user_power']}"); 
                            $user_toppowerarrs=array_flip(array_flip($user_toppowerarr));//删除重复
                }elseif($t_upower==2){
                            $user_toparr=explode(',', "{$user_top['company']['user_id']}"); 
                            $user_toparrs=array_flip(array_flip($user_toparr));//删除重复
                            $user_toppowerarr=explode(',', "{$user_top['company']['user_power']}"); 
                            $user_toppowerarrs=array_flip(array_flip($user_toppowerarr));//删除重复
                }elseif($t_upower==3){
                            $user_toparr=explode(',', "{$user_top['company']['user_id']},{$user_top['branch']['user_id']}"); 
                            $user_toparrs=array_flip(array_flip($user_toparr));//删除重复
                            $user_toppowerarr=explode(',', "{$user_top['company']['user_power']},{$user_top['branch']['user_power']}"); 
                            $user_toppowerarrs=array_flip(array_flip($user_toppowerarr));//删除重复
                }elseif($t_upower==4){
                            $user_toparr=explode(',', "{$user_top['company']['user_id']},{$user_top['branch']['user_id']},{$user_top['partner']['user_id']}"); 
                            $user_toparrs=array_flip(array_flip($user_toparr));//删除重复
                            $user_toppowerarr=explode(',', "{$user_top['company']['user_power']},{$user_top['branch']['user_power']},{$user_top['partner']['user_power']}"); 
                            $user_toppowerarrs=array_flip(array_flip($user_toppowerarr));//删除重复
                }elseif($t_upower==5){
                            $user_toparr=explode(',', "{$user_top['company']['user_id']},{$user_top['branch']['user_id']},{$user_top['partner']['user_id']},{$user_top['proxy_all']['user_id']}"); 
                            $user_toparrs=array_flip(array_flip($user_toparr));//删除重复
                            $user_toppowerarr=explode(',', "{$user_top['company']['user_power']},{$user_top['branch']['user_power']},{$user_top['partner']['user_power']},{$user_top['proxy_all']['user_power']}"); 
                            $user_toppowerarrs=array_flip(array_flip($user_toppowerarr));//删除重复
                }
           }
                   $row=explode(',', "{$user_toparrs},{$user_toppowerarrs}");
                   
                   return $row;
        } 
    
        //走飞单下注
        public function get_feiorders($plate_num,$abcd_h,$o_type1,$o_type2,$o_type3,$orders_y,$orders_p,$orders_p2='0',$tuishui='0',$shuzu='1',$is_fly='1',$type_of_bet='0',$url='',$t_uid='0',$t_upower='0'){
//元素分别为： 期数(2012001) 盘口(A B C D) 下注类型1(特码) 下注类型2(特码A) 下注类型3(49 红波) 下注金额(100) 下注赔率(43) 下注赔率2(43) 退水(走飞单才有) 数组(连码时才有) 是否走飞单(0为会员下注，1为代理网用户走飞) 下注方式(0为正常下注，1为手动输入下注)  跳转链接
        //可以传数组形式过来
    //echo $plate_num.'<br>'.$abcd_h.'<br>'.$o_type1.'<br>'.$o_type2.'<br>'.$o_type3[0].'<br>'.$orders_y[0].'<br>'.$orders_p[0];exit;
            set_time_limit(0);//不限制响应时间
            if(empty($_SESSION['uid'.$this->c_p_seesion()])){
               echo " <script>window.parent.location= 'index.php '; </script> " ;
            }
            
           $gunqiufengpan_arr=$this->gunqiufengpan();//滚球封盘
           $gunqiufengpan_te=$gunqiufengpan_arr[0];
           $gunqiufengpan_other=$gunqiufengpan_arr[1];
        
            $o_typemin3=$o_type3;//这个用来处理最小赔率时用的
            $orders_pmin=$orders_p;//这个用来处理最小赔率时用的
            $is_fly=1;
            $type_of_bet=0;
//            if($url!='no'){
//            $url=$_SERVER['HTTP_REFERER'];
//            }
            $oddsset_types=  $this->select("oddsset_type", "o_id", "o_typename='$o_type2'");
            $oddsset_type = $this->fetch_array($oddsset_types);
            $o_type=$oddsset_type[o_id];
            

            //获取上级以上级别的信息
            //是管理员是为自己的赔率
            if(($t_uid==0 && $t_upower==0) || $t_upower==1){
               $t_uid=$_SESSION['uid'.$this->c_p_seesion()]; 
               $t_upower=$_SESSION['user_power'.$this->c_p_seesion()];
            }
            $user_is_fly=0;
            if($t_upower>1){
            $this->get_tops($t_uid);
            $user_top=$this->tops;           
            $queryusers=  $this->select("users", "is_odds,is_fly", "user_id={$user_top['branch']['user_id']}");
            $user = $this->fetch_array($queryusers);
            $user_is_fly=$user[is_fly];//走飞类型
            }

            $u_id=1;
            if($user['is_odds']==1){
                $u_id= $user_top['company']['user_id'];  
                $u_ids= array($u_id); //处理赔率下注总额
            }else{
                if($t_upower==1){
                $u_ids= array($t_uid);    
                }else{
                $u_id= $user_top['branch']['user_id'];
                $u_ids= array($user_top['company']['user_id'],$u_id); //处理赔率下注总额
                }
            }
 
            //当前期数
            $qishus=  $this->select("plate", "*", "1 order by plate_num desc limit 1");
            $qishu = $this->fetch_array($qishus);
            if($plate_num != $qishu[plate_num] && $url!='no'){
                echo " <script> alert( '抱歉,你要下注的期数已过期！') ;window.location.href= '$url';</script> " ; exit();
                //$this->Get_admin_msg($url,'抱歉,你要下注的期数已过期！');
               // exit();
            }
            if($qishu[history_is_account]==1 && $url!='no'){
                 echo " <script> alert( '本期已结算不能再投注！') ;window.location.href= '$url';</script> " ; exit();
                 //$this->Get_admin_msg($url,'本期已结算不能再投注！'); 
               // exit();
            }
            $shuangmian_type=array();

             $tezhengma=0;  //特码和正码
             if($o_type==16 || $o_type==17){
                 if($gunqiufengpan_te==0 && $qishu[is_special] && strtotime($qishu[special_time_end])>time() && strtotime($qishu[plate_time_satrt])<= time() && time()<strtotime($qishu[plate_time_end]) && $qishu[is_plate_start]==0){
                     $tezhengma=1;
                 }
                 $tiaojian_pan="o_typename='特码'";
                 $tiaojian_pan_b="o_typename='特码波色'";
                 $tiaojian_pan_s="o_typename='特码双面'";
                 $shuangmian_type=explode(',', "特单,特双,特大,特小,合单,合双,尾小,尾大,家禽,野兽");
                 $x_o_type1="特码";
                 $x_o_type1t="特码";
                 $all_type_arr=explode(',', "01,02,03,04,05,06,07,08,09,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,红波,蓝波,绿波,特单,特双,特大,特小,合单,合双,尾小,尾大,家禽,野兽,总单,总双,总大,总小");

             //这里判断正码的封盘状态    
             }elseif($o_type==18 || $o_type==19 || $o_type==20 || $o_type==21 || $o_type==22 || $o_type==23 || $o_type==24 || $o_type==25 || $o_type==26 || $o_type==27 || $o_type==28 || $o_type==29 || $o_type==30 || $o_type==31){
                 if($gunqiufengpan_other==0 && $qishu[is_normal] && strtotime($qishu[normal_time_end])>time() && strtotime($qishu[plate_time_satrt])<= time() && time()<strtotime($qishu[plate_time_end]) && $qishu[is_plate_start]==0){
                     $tezhengma=1;
                 }
                 if($o_type==30 || $o_type==31){
                 $tiaojian_pan="o_typename='正码'";
                 $tiaojian_pan_s="o_typename='正码双面'";
                 $shuangmian_type=explode(',', "总单,总双,总大,总小");
                 $x_o_type1='正码';
                 $all_type_arr=explode(',', "01,02,03,04,05,06,07,08,09,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,总单,总双,总大,总小");
                 }else{
                 $tiaojian_pan="o_typename='正特'";
                 $tiaojian_pan_b="o_typename='正码1-6波色'";
                 $tiaojian_pan_s="o_typename='正码1-6双面'";
                 $shuangmian_type=explode(',', "红波,蓝波,绿波,单,双,大,小,合单,合双,尾小,尾大,家禽,野兽");
  
                 if($o_type==18 || $o_type==19){$xx=1;}elseif($o_type==20 || $o_type==21){$xx=2;}elseif($o_type==22 || $o_type==23){$xx=3;}elseif($o_type==24 || $o_type==25){$xx=4;}elseif($o_type==26 || $o_type==27){$xx=5;}elseif($o_type==28 || $o_type==29){$xx=6;}
                 $x_o_type1='正'.$xx.'特';
                 $x_o_type1t='正'.$xx.'特';
                 $all_type_arr=explode(',', "01,02,03,04,05,06,07,08,09,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,红波,蓝波,绿波,单,双,大,小,合单,合双,尾小,尾大,家禽,野兽");
                 }
                 
             //连码    
             }elseif($o_type==32 || $o_type==33 || $o_type==34 || $o_type==35 || $o_type==36){
                 if($gunqiufengpan_other==0 && $qishu[is_normal] && strtotime($qishu[normal_time_end])>time() && strtotime($qishu[plate_time_satrt])<= time() && time()<strtotime($qishu[plate_time_end]) && $qishu[is_plate_start]==0){
                     $tezhengma=1;
                 }

                    // $orders_yy.=$orders_y.',';
                 //$orders_y=explode(',', trim($orders_yy,','));//转换成数组

                 
                 if($o_type==32 || $o_type==33 || $o_type==34){
                     $o_type3 = $this->getCombinationToString($o_type3, 2);
                     
                 }elseif($o_type==35 || $o_type==36){
                     $o_type3 = $this->getCombinationToString($o_type3, 3);                    
                 }

                 $x_o_type1='连码';
                 
             //不中
             }elseif($o_type==37 || $o_type==38 || $o_type==39 || $o_type==40 || $o_type==41 || $o_type==42){
                 if($gunqiufengpan_other==0 && $qishu[is_special] && strtotime($qishu[special_time_end])>time() && strtotime($qishu[plate_time_satrt])<= time() && time()<strtotime($qishu[plate_time_end]) && $qishu[is_plate_start]==0){
                     $tezhengma=1;
                 }
                     //$orders_yy.=$orders_y.',';
                 //$orders_y=explode(',', trim($orders_yy,','));//转换成数组
                 
                                     
                 if($o_type==37){
                     //$gongshi_arr=($xiazhunum*($xiazhunum-1)*($xiazhunum-2)*($xiazhunum-3)*($xiazhunum-4))/(5*4*3*2*1);      //五不中公式
                     //$o_type3  = $this->fuck($o_type3, 5);
                     $o_type3 = $this->getCombinationToString($o_type3, 5);
                     
                 }elseif($o_type==38){
                     $o_type3 = $this->getCombinationToString($o_type3, 6);
                    // $gongshi_arr=($xiazhunum*($xiazhunum-1)*($xiazhunum-2)*($xiazhunum-3)*($xiazhunum-4)*($xiazhunum-5))/(6*5*4*3*2*1);      //六不中公式
                 }elseif($o_type==39){
                     $o_type3 = $this->getCombinationToString($o_type3, 7);
                    // $gongshi_arr=($xiazhunum*($xiazhunum-1)*($xiazhunum-2)*($xiazhunum-3)*($xiazhunum-4)*($xiazhunum-5)*($xiazhunum-6))/(7*6*5*4*3*2*1);      //七不中公式
                 }elseif($o_type==40){
                     $o_type3 = $this->getCombinationToString($o_type3, 8);
                   //  $gongshi_arr=($xiazhunum*($xiazhunum-1)*($xiazhunum-2)*($xiazhunum-3)*($xiazhunum-4)*($xiazhunum-5)*($xiazhunum-6)*($xiazhunum-7))/(8*7*6*5*4*3*2*1);      //八不中公式
                 }elseif($o_type==41){
                     $o_type3 = $this->getCombinationToString($o_type3, 9);
                   //  $gongshi_arr=($xiazhunum*($xiazhunum-1)*($xiazhunum-2)*($xiazhunum-3)*($xiazhunum-4)*($xiazhunum-5)*($xiazhunum-6)*($xiazhunum-7)*($xiazhunum-8))/(9*8*7*6*5*4*3*2*1);      //八不中公式
                 }elseif($o_type==42){ 
                     $o_type3 = $this->getCombinationToString($o_type3, 10);
                     //$gongshi_arr=($xiazhunum*($xiazhunum-1)*($xiazhunum-2)*($xiazhunum-3)*($xiazhunum-4)*($xiazhunum-5)*($xiazhunum-6)*($xiazhunum-7)*($xiazhunum-8)*($xiazhunum-9))/(10*9*8*7*6*5*4*3*2*1);      //八不中公式
                 }
                 $x_o_type1='不中';
             }
             //特肖
             if($o_type==43){
                 if($gunqiufengpan_other==0 && $qishu[is_special] && strtotime($qishu[special_time_end])>time() && strtotime($qishu[plate_time_satrt])<= time() && time()<strtotime($qishu[plate_time_end]) && $qishu[is_plate_start]==0){
                     $tezhengma=1;
                 }
                 $x_o_type1='特肖';
             }elseif($o_type==45 || $o_type==46 || $o_type==47 || $o_type==48 || $o_type==49){            
             //多生肖
              if($gunqiufengpan_other==0 && $qishu[is_special] && strtotime($qishu[special_time_end])>time() && strtotime($qishu[plate_time_satrt])<= time() && time()<strtotime($qishu[plate_time_end]) && $qishu[is_plate_start]==0){
                     $tezhengma=1;
              }
                     //$orders_yy.=$orders_y.',';
                 //$orders_y=explode(',', trim($orders_yy,','));//转换成数组

             if($o_type==45){                   
                    $o_type3 = $this->getCombinationToString($o_type3, 2);
             }elseif($o_type==46){ 
                    $o_type3 = $this->getCombinationToString($o_type3, 3);
             }elseif($o_type==47){
                    $o_type3 = $this->getCombinationToString($o_type3, 4);
             }elseif($o_type==48){ 
                    $o_type3 = $this->getCombinationToString($o_type3, 5);
             }elseif($o_type==49){ 
                    $o_type3 = $this->getCombinationToString($o_type3, 6);
             }
              $x_o_type1='多生肖';
              
              //生肖连
             }elseif($o_type==51 || $o_type==52 || $o_type==53 || $o_type==54 || $o_type==55 || $o_type==56){
                 if($gunqiufengpan_other==0 && $qishu[is_special] && strtotime($qishu[special_time_end])>time() && strtotime($qishu[plate_time_satrt])<= time() && time()<strtotime($qishu[plate_time_end]) && $qishu[is_plate_start]==0){
                     $tezhengma=1;
                 }

                     //$orders_yy.=$orders_y.',';
                 //$orders_y=explode(',', trim($orders_yy,','));//转换成数组

                   if($o_type==51 || $o_type==52){
                    $o_type3 = $this->getCombinationToString($o_type3, 2);
                   }elseif($o_type==53 || $o_type==54){
                    $o_type3 = $this->getCombinationToString($o_type3, 3);
                   }elseif($o_type==55 || $o_type==56){
                    $o_type3 = $this->getCombinationToString($o_type3, 4);
                   }
              $x_o_type1='生肖连';
              
             //尾数连
             }elseif($o_type==57 || $o_type==58 || $o_type==59 || $o_type==60 || $o_type==61 || $o_type==62){
                 if($gunqiufengpan_other==0 && $qishu[is_special] && strtotime($qishu[special_time_end])>time() && strtotime($qishu[plate_time_satrt])<= time() && time()<strtotime($qishu[plate_time_end]) && $qishu[is_plate_start]==0){
                     $tezhengma=1;
                 }
                    // $orders_yy.=$orders_y.',';
                // $orders_y=explode(',', trim($orders_yy,','));//转换成数组

                   if($o_type==57 || $o_type==58){
                    $o_type3 = $this->getCombinationToString($o_type3, 2);
                   }elseif($o_type==59 || $o_type==60){
                    $o_type3 = $this->getCombinationToString($o_type3, 3);
                   }elseif($o_type==61 || $o_type==62){
                    $o_type3 = $this->getCombinationToString($o_type3, 4);
                   }
              $x_o_type1='尾数连';
              
              //半波
             }elseif($o_type==14){
                 if($gunqiufengpan_other==0 && $qishu[is_special] && strtotime($qishu[special_time_end])>time() && strtotime($qishu[plate_time_satrt])<= time() && time()<strtotime($qishu[plate_time_end]) && $qishu[is_plate_start]==0){
                     $tezhengma=1;
                 }
               $x_o_type1='半波'; 
             
               //过关
             }elseif($o_type==15){
                 if($gunqiufengpan_other==0 && $qishu[is_normal] && strtotime($qishu[normal_time_end])>time() && strtotime($qishu[plate_time_satrt])<= time() && time()<strtotime($qishu[plate_time_end]) && $qishu[is_plate_start]==0){
                     $tezhengma=1;
                 }
               $x_o_type1='过关'; 
               
             //一肖尾数
             }elseif($o_type2=='一肖' || $o_type2=='尾数'){
                 if($gunqiufengpan_other==0 && $qishu[is_special] && strtotime($qishu[special_time_end])>time() && strtotime($qishu[plate_time_satrt])<= time() && time()<strtotime($qishu[plate_time_end]) && $qishu[is_plate_start]==0){
                     $tezhengma=1;
                 }              
             }
             
                        
            if($tezhengma==0 && $url!='no'){
                echo " <script> alert( '已封盘!') ;window.location.href= '$url';</script> " ; exit();
                //$this->Get_admin_msg($url,'已封盘!'); 
                //exit(); 
            }

            //当前用户信息
            $myusers=  $this->select("users", "*", "user_id={$t_uid}");
            $myuser = $this->fetch_array($myusers);
            
            //退水占成设置
            //d_z 代理占成值	zd_z 总代理占成值	gd_z 股东占成值	    f_z 分公司占成值	   g_z公司占成值
            if($user_is_fly==0 || $t_upower==2){
              $yxzf_u_id=1;  
              $myuser_percent_proxy=0;
              $myuser_percent_all_proxy=0;
              $myuser_percent_partner=0;
              $myuser_percent_branch=0;
              $myuser_percent_company=100;  
              $fly_user_id=',1,';
            }elseif($user_is_fly==1){
              $yxzf_u_id=$u_id;  
              $myuser_percent_proxy=0;
              $myuser_percent_all_proxy=0;
              $myuser_percent_partner=0;
              $myuser_percent_branch=100;
              $myuser_percent_company=0;   
              $fly_user_id=','.$user_top['branch']['user_id'].',';
            }else{
              $yxzf_u_id=1;  
              $myuser_percent_proxy=$myuser['percent_proxy'];
              $myuser_percent_all_proxy=$myuser['percent_all_proxy'];
              $myuser_percent_partner=$myuser['percent_partner'];
              $myuser_percent_branch=$myuser['percent_branch'];
              $myuser_percent_company=$myuser['percent_company']; 
                if($t_upower==1){
                   $fly_user_id=',1,'; 
                }elseif($t_upower==2){
                   $myuser_percent_company=$myuser['percent_company']+$myuser['percent_branch']; 
                   $myuser_percent_branch=0;
                   $fly_user_id=',1,'.$user_top['branch']['user_id'].','; 
                }elseif($t_upower==3){
                   $myuser_percent_company=$myuser['percent_company']+$myuser['percent_partner']; 
                   $myuser_percent_partner=0;
                   $fly_user_id=',1,'.$user_top['branch']['user_id'].','.$user_top['partner']['user_id'].','; 
                }elseif($t_upower==4){
                   $myuser_percent_company=$myuser['percent_company']+$myuser['percent_all_proxy']; 
                   $myuser_percent_all_proxy=0;
                   $fly_user_id=',1,'.$user_top['branch']['user_id'].','.$user_top['partner']['user_id'].','.$user_top['proxy_all']['user_id'].','; 
                }elseif($t_upower==5){
                   $myuser_percent_company=$myuser['percent_company']+$myuser['percent_proxy'];  
                   $myuser_percent_proxy=0;
                   $fly_user_id=',1,'.$user_top['branch']['user_id'].','.$user_top['partner']['user_id'].','.$user_top['proxy_all']['user_id'].','.$user_top['proxy']['user_id'].','; 
                }            
            }

            
            //获得退水值
            $boseshuangmian=explode(',', "红波,绿波,蓝波,特单,特双,特大,特小,单,双,大,小,合单,合双,尾小,尾大,家禽,野兽,总单,总双,总大,总小");
            $bose_type=explode(',', "红波,绿波,蓝波");   
            $shuangmian_types=explode(',', "特单,特双,特大,特小,单,双,大,小,合单,合双,尾小,尾大,家禽,野兽,总单,总双,总大,总小"); 
            if($x_o_type1=='尾数连' || $x_o_type1=='生肖连'){  //特殊的退水
                $o_type2name=$x_o_type1;
            }elseif(in_array($o_type3, $boseshuangmian)){
                 if(in_array($o_type3, $bose_type)){
                 $o_type2name='波色';    
                 }elseif(in_array($o_type3, $shuangmian_types)){
                 $o_type2name='两面';    
                 }
            }else{
                $o_type2name=$o_type2;
            }
            //退水信息
            $back_sets=  $this->select("back_set", "*", "user_id={$_SESSION['uid'.$this->c_p_seesion()]} and set_name='{$o_type2name}'");
            $back_set = $this->fetch_array($back_sets);
            
            if($t_upower==1){
            $user_top_proxy =0;
            $user_top_proxy_all = 0;
            $user_top_partner = 0;
            $user_top_branch = 0;
            $back_set_h = 0;//会员的退水百分率
            $back_set_d = 0;//代理
            $back_set_zd = 0;//总代理
            $back_set_gd = 0;//股东
            $back_set_f = 0;//分公司 
            //$back_set_g = $tuishui;//公司
            $back_set[bottom_limit]=0;
            $back_set[top_limit]=99999999999999;
            $back_set[odd_limit]=99999999999999;
            //$duiying_back_set=$tuishui;
            }elseif($t_upower==2){
            $user_top_proxy =0;
            $user_top_proxy_all = 0;
            $user_top_partner = 0;
            $user_top_branch = $user_top['branch']['user_id'];
            $back_set_h = 0;//会员的退水百分率
            $back_set_d = 0;//代理
            $back_set_zd = 0;//总代理
            $back_set_gd = 0;//股东
            $back_set_f = $this->get_tuishuizhi($user_top['branch']['user_id'],$o_type2name,$abcd_h);//分公司      
            $back_set_g = 0;//公司
            $duiying_back_set=$back_set_f;
            }elseif($t_upower==3){
            $user_top_proxy =0;
            $user_top_proxy_all = 0;
            $user_top_partner = $user_top['partner']['user_id'];
            $user_top_branch = $user_top['branch']['user_id'];    
            $back_set_h = 0;//会员的退水百分率
            $back_set_d = 0;//代理
            $back_set_zd = 0;//总代理
            $back_set_gd = $this->get_tuishuizhi($user_top_partner,$o_type2name,$abcd_h);//股东
            $back_set_f = $this->get_tuishuizhi($user_top_branch,$o_type2name,$abcd_h);//分公司      
            $back_set_g = 0;//公司
            $duiying_back_set=$back_set_gd;
            }elseif($t_upower==4){
            $user_top_proxy =0;
            $user_top_proxy_all = $user_top['proxy_all']['user_id'];
            $user_top_partner = $user_top['partner']['user_id'];
            $user_top_branch = $user_top['branch']['user_id'];    
            $back_set_h = 0;//会员的退水百分率
            $back_set_d = 0;//代理
            $back_set_zd = $this->get_tuishuizhi($user_top_proxy_all,$o_type2name,$abcd_h);//总代理
            $back_set_gd = $this->get_tuishuizhi($user_top_partner,$o_type2name,$abcd_h);//股东
            $back_set_f = $this->get_tuishuizhi($user_top_branch,$o_type2name,$abcd_h);//分公司   
            $back_set_g = 0;//公司
            $duiying_back_set=$back_set_zd;
            }elseif($t_upower==5){
            $user_top_proxy =$user_top['proxy']['user_id'];
            $user_top_proxy_all = $user_top['proxy_all']['user_id'];
            $user_top_partner = $user_top['partner']['user_id'];
            $user_top_branch = $user_top['branch']['user_id'];    
            $back_set_h = 0;//会员的退水百分率
            $back_set_d = $this->get_tuishuizhi($user_top_proxy,$o_type2name,$abcd_h);//代理
            $back_set_zd = $this->get_tuishuizhi($user_top_proxy_all,$o_type2name,$abcd_h);//总代理
            $back_set_gd = $this->get_tuishuizhi($user_top_partner,$o_type2name,$abcd_h);//股东
            $back_set_f = $this->get_tuishuizhi($user_top_branch,$o_type2name,$abcd_h);//分公司     
            $back_set_g = 0;//公司
            $duiying_back_set=$back_set_d;
            }elseif($t_upower==6){
            $user_top_proxy =$user_top['proxy']['user_id'];
            $user_top_proxy_all = $user_top['proxy_all']['user_id'];
            $user_top_partner = $user_top['partner']['user_id'];
            $user_top_branch = $user_top['branch']['user_id'];    
            $back_set_d = $this->get_tuishuizhi($user_top_proxy,$o_type2name,$abcd_h);//代理
            $back_set_zd = $this->get_tuishuizhi($user_top_proxy_all,$o_type2name,$abcd_h);//总代理
            $back_set_gd = $this->get_tuishuizhi($user_top_partner,$o_type2name,$abcd_h);//股东
            $back_set_f = $this->get_tuishuizhi($user_top_branch,$o_type2name,$abcd_h);//分公司    
            }
            $x_time=time();
            
            foreach ($orders_y as $y => $yy) {
               if($orders_y[$y]>0){ 
               $x_orders_y_i+=$orders_y[$y];
//               if(!empty($orders_y[$y]) && $back_set[bottom_limit]>$orders_y[$y] && $url!='no'){
//                   echo " <script> alert( '少于最低限额,请重新下注! ') ;window.location.href= '$url';</script> " ; exit();
//                   //$this->Get_admin_msg($url,'少于最低限额,请重新下注! '); exit();
//               }elseif(!empty($orders_y[$y]) &&  $orders_y[$y]>$back_set[top_limit] && $url!='no'){
//                   echo " <script> alert( '大于最高限额,请重新下注! ') ;window.location.href= '$url';</script> " ; exit();
//                  // $this->Get_admin_msg($url,'大于最高限额,请重新下注! ');
//                  //  exit();
//               }
               }
            }
            

            //你的账号被停押is_bet=1 
                if($myuser['is_bet'] && $url!='no'){
                     echo " <script> alert( '你的账号被停押! ') ;window.location.href= '$url';</script> " ; exit();
                    //$this->Get_admin_msg($url,'你的账号被停押! '); exit();    
                }
                $user_yue=$myuser['credit_remainder']-$x_orders_y_i;
                if($user_yue<0 && $url!='no'){
                    echo " <script> alert( '你的余额不足。 ') ;window.location.href= '$url';</script> " ; exit();
                    //$this->Get_admin_msg($url,'你的余额不足。 '); exit();  
                }
                
             //自动补货分类
             $bose_type_arr1=explode(',', "生肖连,尾数连,半波,过关,特码双面,正码双面,正1特双面,正2特双面,正3特双面,正4特双面,正5特双面,正6特双面");
             $bose_type_arr2=explode(',', "特码A,特码B,正1特A,正1特B,正2特A,正2特B,正3特A,正3特B,正4特A,正4特B,正5特A,正5特B,正6特A,正6特B,正码A,正码B,特肖,二肖,三肖,四肖,五肖,六肖,一肖,尾数,五不中,六不中,七不中,八不中,九不中,十不中,二全中,二中特,特串,三全中,三中二");
             $bose_type_arr3=explode(',', "红波,绿波,蓝波");  
             
             if($_SESSION['uid'.$this->c_p_seesion()]!=1){
             $this->is_fenghao($o_type,$yxzf_u_id,$o_type3,$orders_y,$url);//判断是否封号
             }
            //
            //普通下注插入数据    
            foreach ($o_type3 as $i => $v) {
               if($orders_y[$i]>0){
               $top_limit = mysql_fetch_array(mysql_query("select SUM(orders_y) as sum from orders where user_id={$_SESSION['uid'.$this->c_p_seesion()]} and plate_num={$qishu['plate_num']} and o_type3='{$o_type3[$i]}'"));    
               $top_limits=$top_limit['sum']+$orders_y[$i];
               if(!empty($orders_y[$i]) && $back_set[bottom_limit]>$orders_y[$i]){
                   echo " <script> alert( '少于最低限额$back_set[bottom_limit],请重新下注! ') ;window.location.href= '$url'; </script> " ; exit();
               }elseif(!empty($orders_y[$i]) &&  $orders_y[$i]>$back_set[odd_limit]){
                   echo " <script> alert( '大于单号限额$back_set[odd_limit],请重新下注! ') ;window.location.href= '$url'; </script> " ; exit();
               }elseif(!empty($orders_y[$i]) &&  $top_limits>$back_set[top_limit]){
                   echo " <script> alert( '大于最高限额$back_set[top_limit],请重新下注! ') ;window.location.href= '$url'; </script> " ; exit();    
               }     
                              //print_r($o_type3);exit;
               if(in_array($o_type3[$i],$shuangmian_type)){
                   $x_o_type1='正'.$xx.'特双面';
                   if($o_type==16 || $o_type==17){
                       //if($o_type3[$i]!='红波' || $o_type3[$i]!='蓝波' || $o_type3[$i]!='绿波')
                   $x_o_type1='特码双面';
                   }elseif($o_type==30 || $o_type==31){
                   $x_o_type1='正码双面';    
                   }             
               }
               if($o_type==44){
                       if(!is_numeric($o_type3[$i])){
                           $x_o_type1='一肖';
                           $o_type2='一肖';
                       }else{
                           $x_o_type1='尾数';
                           $o_type2='尾数';
                       }
               }     

               if($o_type>=32 && $o_type!=43 && $o_type!=44 && $o_type!=50 && $o_type<=62){  
//                    32->36 连码
//                    37->42 不中
//                    45->49 多生肖
//                    51->56 生肖连
//                    57->62 尾数连
                $o_s_p=$this->get_min_order_p($u_id,$o_type,$o_typemin3,$orders_p[$i],$o_type3[$i],$abcd_h,$orders_p2[$i],1);   
                $orders_p[$i]=$o_s_p[0];
                if($o_type==33 || $o_type==36){ 
                $orders_p_company_and=$o_s_p[1];
                }else{
                $orders_p_company_and=$o_s_p[0].'|'.$o_s_p[1];    
                }
               }elseif($o_type==15){ //过关赔率特殊处理
                 $o_s_p=$this->get_min_order_p($u_id,$o_type,$o_typemin3,$orders_pmin,$o_type3[$i],$abcd_h,0,1);  
                 $orders_p_company_and=$o_s_p[0].'|'.$o_s_p[1];
               }else{
                   if($x_o_type1=='尾数'){
                   $orders_p_company=$this->get_one_order_p(50,$o_type3[$i],$abcd_h);    
                   }else{
                   $orders_p_company=$this->get_one_order_p($o_type,$o_type3[$i],$abcd_h); 
                   }
                    if($t_upower==1){ 
                      $orders_p_company_and=$orders_p[$i].'|'.$orders_p[$i];   
                    }else{
                      $orders_p_company_and=$orders_p[$i].'|'.$orders_p_company;     
                    }
               }
               
                   if($t_upower==1){
                       $duiying_back_set=$tuishui[$i];
                       $back_set_g=$tuishui[$i];
                   }
               $tuishui_y[$i]=$orders_y[$i]*$duiying_back_set/100;
               $keying_y[$i]=$orders_y[$i]*$orders_p[$i]-$orders_y[$i]+$tuishui_y[$i];
               //处理是否自动降水
               //$is_back=$this->is_autobacks($x_o_type1,$o_type2,$o_type3[$i],$orders_p[$i],$orders_y[$i],$qishu['plate_num'],$t_uid);
               //if($is_back[0]=='ok'){
               //    $orders_p[$i]=$is_back[1];
               //}
               if($o_type3[$i]=='红波' || $o_type3[$i]=='蓝波' || $o_type3[$i]=='绿波'){
                   $x_o_type1=$x_o_type1t;
               }
               
               
               if(($o_type>=16 && $o_type<=31) || $o_type==14 || $o_type==44 || $o_type==50){
                         $this->update_total_bet($o_type,$o_type3[$i],$qishu['plate_num'],$orders_y[$i],$u_ids);//更新赔率里的下注总额
               }
               if($t_upower==1)$orders_y[$i]=-$orders_y[$i];
               $sql="insert into orders (user_id,plate_num,time,o_type1,o_type2,o_type3,orders_y,orders_p,orders_p_2,abcd_h,h_tui,d_tui,zd_tui,gd_tui,f_tui,g_tui,d_z,zd_z,gd_z,f_z,g_z,topd_id,topzd_id,topgd_id,topf_id,keying_y,tuishui_y,fly_user,fly_user_id,is_fly)values ('{$t_uid}','{$qishu['plate_num']}','{$x_time}','{$x_o_type1}','{$o_type2}','{$o_type3[$i]}','{$orders_y[$i]}','{$orders_p[$i]}','{$orders_p_company_and}','{$abcd_h}','{$back_set_h}','{$back_set_d}','{$back_set_zd}','{$back_set_gd}','{$back_set_f}','{$back_set_g}','{$myuser_percent_proxy}','{$myuser_percent_all_proxy}','{$myuser_percent_partner}','{$myuser_percent_branch}','{$myuser_percent_company}','{$user_top_proxy}','{$user_top_proxy_all}','{$user_top_partner}','{$user_top_branch}','{$keying_y[$i]}','{$tuishui_y[$i]}','{$user_is_fly}','{$fly_user_id}','1')";
               $this->query($sql);
               
               $down_fly_arr=$this->down_fly($t_uid,$t_upower,$user_is_fly);//获取下级走飞情况
               //自动补货
               foreach ($down_fly_arr[0] as $ki=> $uts) {      
                  //处理自动补货
                   if(in_array($x_o_type1,$bose_type_arr1)){
                         //判断一级类
                         $autoorder=$this->is_autoorders($x_o_type1,$down_fly_arr[0][$ki]);
                   }elseif(in_array($o_type3[$i],$bose_type_arr3)){
                         //判断是否是波色
                         $autoorder=$this->is_autoorders($o_type3[$i],$down_fly_arr[0][$ki]);
                   }elseif(in_array($o_type2,$bose_type_arr2)){
                         //判断二级类
                         $autoorder=$this->is_autoorders($o_type2,$down_fly_arr[0][$ki]);
                   }else{
                         $autoorder=$this->is_autoorders($x_o_type1,$down_fly_arr[0][$ki]);
                   }
                   if($autoorder[0]=='ok'){
                           $autoarrs=$this->auto_get_type3_zc($o_type3[$i],$down_fly_arr[0][$ki],$qishu['plate_num'],$x_o_type1,$o_type2,$down_fly_arr[1][$ki],$o_type,$orders_p[$i]);
                         //$autoarrs=$this->get_total_for_auto($user_toparrs[$ki], $qishu['plate_num'], $user_toppowerarrs[$ki]);
                         $autoorders_y=floor($autoarrs-$autoorder[1]); //走飞值减去控制额
                         if($autoorders_y>=1){
                             $autoo_type3=explode(',', $o_type3[$i]);
                             $autoorders_y=explode(',', $autoorders_y);
                             $autoorders_p=explode(',', $orders_p[$i]);
                             $duiying_back_set2=explode(',', $duiying_back_set);
                             $this->get_feiorders($qishu['plate_num'],$abcd_h,$x_o_type1,$o_type2,$autoo_type3,$autoorders_y,$autoorders_p,'0',$duiying_back_set2,'1','1','0','no',$down_fly_arr[0][$ki],$down_fly_arr[1][$ki]);
                         }
                   }
                 }//补货结束 
                 
                       
               }
            }
              
            if($x_orders_y_i){ 
                //更新余额
                if($t_upower!=1){
                $sql2 = "update users SET credit_remainder = $user_yue where user_id ={$t_uid}" ;
                $this->query($sql2);
                //同时记录该期该用户下注的总金额
                $orders_totalmones=  $this->select("orders_totalmoney", "id", "user_id={$t_uid} and plate_num={$qishu['plate_num']}");
                $orders_tm = $this->fetch_array($orders_totalmones);
                if($orders_tm[id]){
                  $sql3 = "update orders_totalmoney SET orders_tm = orders_tm+$x_orders_y_i where user_id ={$t_uid} and plate_num={$qishu['plate_num']}" ;
                  $this->query($sql3);   
                }else{
                  $this->query("INSERT INTO `orders_totalmoney` (`user_id`, `plate_num`,`orders_tm`) " .
                                    "VALUES ('{$t_uid}', '{$qishu['plate_num']}', '{$x_orders_y_i}')");  
                }
                }
                   if($url!='no'){
                       echo " <script> alert( '走飞成功。 ') ;window.location.href= '$url';</script> " ; exit();
                   //$this->Get_admin_msg($url,'下注成功。 '); exit(); 
                   }
            }else{
                if($url!='no'){
                    echo " <script> alert( '请输入有效金额进行下注。 ') ;window.location.href= '$url';</script> " ;  exit(); 
                //$this->Get_admin_msg($url,'请输入有效金额进行下注。 '); exit();
                }
            }

            
        }

        public function get_num_detail($set_id,$num){
        $query=  $this->select("animal", "*", "set_id=$set_id and num=$num");
        $row=  $this->fetch_array($query);
        return $row;
        } 
    
        //结算
        public function settle_accounts($animal_set_id,$plate_num,$num1,$num2,$num3,$num4,$num5,$num6,$num7){
            //***********************特殊(开49时 六肖,特码双面,正1特双面，正2特双面，正3特双面，正4特双面，正5特双面，正6特双面算打和)**************************//
            // fixed_type
            //不固定数组 
            $nums=explode(',', "$num1,$num2,$num3,$num4,$num5,$num6,$num7");
            $nums_z=explode(',', "$num1,$num2,$num3,$num4,$num5,$num6");//全部正码
            //7个号码对应的生肖          
            $animalnum1=$this->get_num_detail($animal_set_id, $num1);
            $animalnum2=$this->get_num_detail($animal_set_id, $num2);
            $animalnum3=$this->get_num_detail($animal_set_id, $num3);
            $animalnum4=$this->get_num_detail($animal_set_id, $num4);
            $animalnum5=$this->get_num_detail($animal_set_id, $num5);
            $animalnum6=$this->get_num_detail($animal_set_id, $num6);
            $animalnum7=$this->get_num_detail($animal_set_id, $num7);
            $animals=explode(',', "$animalnum1[animal],$animalnum2[animal],$animalnum3[animal],$animalnum4[animal],$animalnum5[animal],$animalnum6[animal],$animalnum7[animal]");
            //7个号码对应的尾数
            $weishu1=substr($num1,1);
            $weishu2=substr($num2,1);
            $weishu3=substr($num3,1);
            $weishu4=substr($num4,1);
            $weishu5=substr($num5,1);
            $weishu6=substr($num6,1);
            $weishu7=substr($num7,1);
            $weishus=explode(',', "$weishu1,$weishu2,$weishu3,$weishu4,$weishu5,$weishu6,$weishu7");
            
            $zong=$num1+$num2+$num3+$num4+$num5+$num6+$num7;
            
            //固定数组
            //--------------------------------------波色
            $hongbo=explode(',', "01,02,07,08,12,13,18,19,23,24,29,30,34,35,40,45,46"); //红波
            $lanbo=explode(',', "03,04,09,10,14,15,20,25,26,31,36,37,41,42,47,48");     //蓝波
            $lvbo=explode(',', "05,06,11,16,17,21,22,27,28,32,33,38,39,43,44,49");      //绿波
            //--------------------------------------半波
            $hongdan=explode(',', "01,07,13,19,23,29,35,45");                           //红单
            $hongshuang=explode(',', "02,08,12,18,24,30,34,40,46");                     //红双
            $hongda=explode(',', "29,30,34,35,40,45,46");                               //红大
            $hongxiao=explode(',', "01,02,07,08,12,13,18,19,23,24");                    //红小
            $landan=explode(',', "03,09,15,25,31,37,41,47");                            //蓝单 
            $lanshuang=explode(',', "04,10,14,20,26,36,42,48");                         //蓝双 
            $landa=explode(',', "25,26,31,36,37,41,42,47,48");                          //蓝大 
            $lanxiao=explode(',', "03,04,09,10,14,15,20");                              //蓝小 
            $lvdan=explode(',', "05,11,17,21,27,33,39,43,49");                          //绿单 
            $lvshuang=explode(',', "06,16,22,28,32,38,44");                             //绿双 
            $lvda=explode(',', "27,28,32,33,38,39,43,44,49");                           //绿大 
            $lvxiao=explode(',', "05,06,11,16,17,21,22");                               //绿小 
            //---------------------------------------两面(双面)
            $dan=explode(',', "01,03,05,07,09,11,13,15,17,19,21,23,25,27,29,31,33,35,37,39,41,43,45,47,49");    //(特单)单
            $shuang=explode(',', "02,04,06,08,10,12,14,16,18,20,22,24,26,28,30,32,34,36,38,40,42,44,46,48");    //(特双)双
            $da=explode(',', "25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49");     //(特大)大
            $xiao=explode(',', "01,02,03,04,05,06,07,08,09,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24");      //(特小)小
            $hedan=explode(',', "01,03,05,07,09,10,12,14,16,18,21,23,25,27,29,30,32,34,36,38,41,43,45,47,49");  //合单
            $heshuang=explode(',', "02,04,06,08,11,13,15,17,19,20,22,24,26,28,31,33,35,37,39,40,42,44,46,48");  //合双
            $weixiao=explode(',', "01,02,03,04,10,11,12,13,14,20,21,22,23,24,30,31,32,33,34,40,41,42,43,44");   //尾小
            $weida=explode(',', "05,06,07,08,09,15,16,17,18,19,25,26,27,28,29,35,36,37,38,39,45,46,47,48,49");  //尾大
            $jiaqin=explode(',', "牛,马,羊,鸡,狗,猪");                                                           //家禽
            $yeshou=explode(',', "鼠,虎,兔,龙,蛇,猴");                                                           //野兽
            
            //--------------------------------------尾数连
            $wei0=explode(',', "10,20,30,40");    //0尾
            $wei1=explode(',', "01,11,21,31,41"); //1尾
            $wei2=explode(',', "02,12,22,32,42"); //2尾 
            $wei3=explode(',', "03,13,23,33,43"); //3尾
            $wei4=explode(',', "04,14,24,34,44"); //4尾
            $wei5=explode(',', "05,15,25,35,45"); //5尾
            $wei6=explode(',', "06,16,26,36,46"); //6尾
            $wei7=explode(',', "07,17,27,37,47"); //7尾
            $wei8=explode(',', "08,18,28,38,48"); //8尾
            $wei9=explode(',', "09,19,29,39,49"); //9尾
            
            //--------------------------------------
                $orders_alls = mysql_query("select * from orders where plate_num=$plate_num order by id desc");
                //$row = $this->fetch_array($orders_alls);
                $iii=0;
                while($row = mysql_fetch_array($orders_alls)){
                $iii++;
                    $shuying_y=($row['orders_p']*$row['orders_y'])-$row['orders_y'];
                    $roworders_y=0-$row['orders_y'];
                    if(in_array($row['o_type1'],explode(',', "特码,正1特,正2特,正3特,正4特,正5特,正6特,特码双面,正1特双面,正2特双面,正3特双面,正4特双面,正5特双面,正6特双面"))){
                        //特码 正1特 正2特 正3特 正4特 正5特 正6特01,02,03,04,05,06,07,08,09,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,红波,蓝波,绿波,特单,特双,特大,特小,合单,合双,尾小,尾大,家禽,野兽
                        if($row['o_type1']=='特码' || $row['o_type1']=='特码双面'){ 
                            if($num7=='49' && $row['o_type1']=='特码双面'){
                                $this->update("orders", "history_is_account=1,shuying_y=0,tuishui_y=0,is_win=2", "id={$row['id']}"); 
                            }else{
                            if(($row['o_type3']==$num7) ||($row['o_type3']=='红波' && in_array($num7, $hongbo))||($row['o_type3']=='蓝波' && in_array($num7, $lanbo))||($row['o_type3']=='绿波' && in_array($num7, $lvbo))||($row['o_type3']=='特单' && in_array($num7, $dan))||($row['o_type3']=='特双' && in_array($num7, $shuang))||($row['o_type3']=='特大' && in_array($num7, $da))||($row['o_type3']=='特小' && in_array($num7, $xiao))||($row['o_type3']=='合单' && in_array($num7, $hedan))||($row['o_type3']=='合双' && in_array($num7, $heshuang))||($row['o_type3']=='尾小' && in_array($num7, $weixiao))||($row['o_type3']=='尾大' && in_array($num7, $weida))||($row['o_type3']=='家禽' && in_array($animalnum7[animal], $jiaqin))||($row['o_type3']=='野兽' && in_array($animalnum7[animal], $yeshou))){
                                $this->update("orders", "history_is_account=1,shuying_y=$shuying_y,is_win=1", "id={$row['id']}");                           
                            }else{  
                                $this->update("orders", "history_is_account=1,shuying_y=$roworders_y", "id={$row['id']}"); 
                            }
                            }
                        }elseif($row['o_type1']=='正1特' || $row['o_type1']=='正1特双面'){
                            if($num1=='49' && $row['o_type1']=='正1特双面'){
                                $this->update("orders", "history_is_account=1,shuying_y=0,tuishui_y=0,is_win=2", "id={$row['id']}"); 
                            }else{
                            if(($row['o_type3']==$num1) ||($row['o_type3']=='红波' && in_array($num1, $hongbo))||($row['o_type3']=='蓝波' && in_array($num1, $lanbo))||($row['o_type3']=='绿波' && in_array($num1, $lvbo))||($row['o_type3']=='单' && in_array($num1, $dan))||($row['o_type3']=='双' && in_array($num1, $shuang))||($row['o_type3']=='大' && in_array($num1, $da))||($row['o_type3']=='小' && in_array($num1, $xiao))||($row['o_type3']=='合单' && in_array($num1, $hedan))||($row['o_type3']=='合双' && in_array($num1, $heshuang))||($row['o_type3']=='尾小' && in_array($num1, $weixiao))||($row['o_type3']=='尾大' && in_array($num1, $weida))||($row['o_type3']=='家禽' && in_array($animalnum7[animal], $jiaqin))||($row['o_type3']=='野兽' && in_array($animalnum7[animal], $yeshou))){
                                
                                $this->update("orders", "history_is_account=1,shuying_y=$shuying_y,is_win=1", "id={$row['id']}");                           
                            }else{  
                                $this->update("orders", "history_is_account=1,shuying_y=$roworders_y", "id={$row['id']}"); 
                            }
                            }
                        }elseif($row['o_type1']=='正2特' || $row['o_type1']=='正2特双面'){ 
                            if($num2=='49' && $row['o_type1']=='正2特双面'){
                                $this->update("orders", "history_is_account=1,shuying_y=0,tuishui_y=0,is_win=2", "id={$row['id']}"); 
                            }else{
                            if(($row['o_type3']==$num2) ||($row['o_type3']=='红波' && in_array($num2, $hongbo))||($row['o_type3']=='蓝波' && in_array($num2, $lanbo))||($row['o_type3']=='绿波' && in_array($num2, $lvbo))||($row['o_type3']=='单' && in_array($num2, $dan))||($row['o_type3']=='双' && in_array($num2, $shuang))||($row['o_type3']=='大' && in_array($num2, $da))||($row['o_type3']=='小' && in_array($num2, $xiao))||($row['o_type3']=='合单' && in_array($num2, $hedan))||($row['o_type3']=='合双' && in_array($num2, $heshuang))||($row['o_type3']=='尾小' && in_array($num2, $weixiao))||($row['o_type3']=='尾大' && in_array($num2, $weida))||($row['o_type3']=='家禽' && in_array($animalnum7[animal], $jiaqin))||($row['o_type3']=='野兽' && in_array($animalnum7[animal], $yeshou))){
                                
                                $this->update("orders", "history_is_account=1,shuying_y=$shuying_y,is_win=1", "id={$row['id']}");                           
                            }else{  
                                $this->update("orders", "history_is_account=1,shuying_y=$roworders_y", "id={$row['id']}"); 
                            }
                            }
                        }elseif($row['o_type1']=='正3特' || $row['o_type1']=='正3特双面'){
                            if($num3=='49' && $row['o_type1']=='正3特双面'){
                                $this->update("orders", "history_is_account=1,shuying_y=0,tuishui_y=0,is_win=2", "id={$row['id']}"); 
                            }else{
                            if(($row['o_type3']==$num3) ||($row['o_type3']=='红波' && in_array($num3, $hongbo))||($row['o_type3']=='蓝波' && in_array($num3, $lanbo))||($row['o_type3']=='绿波' && in_array($num3, $lvbo))||($row['o_type3']=='单' && in_array($num3, $dan))||($row['o_type3']=='双' && in_array($num3, $shuang))||($row['o_type3']=='大' && in_array($num3, $da))||($row['o_type3']=='小' && in_array($num3, $xiao))||($row['o_type3']=='合单' && in_array($num3, $hedan))||($row['o_type3']=='合双' && in_array($num3, $heshuang))||($row['o_type3']=='尾小' && in_array($num3, $weixiao))||($row['o_type3']=='尾大' && in_array($num3, $weida))||($row['o_type3']=='家禽' && in_array($animalnum7[animal], $jiaqin))||($row['o_type3']=='野兽' && in_array($animalnum7[animal], $yeshou))){
                                
                                $this->update("orders", "history_is_account=1,shuying_y=$shuying_y,is_win=1", "id={$row['id']}");                           
                            }else{  
                                $this->update("orders", "history_is_account=1,shuying_y=$roworders_y", "id={$row['id']}"); 
                            }
                            }
                        }elseif($row['o_type1']=='正4特' || $row['o_type1']=='正4特双面'){  
                            if($num4=='49' && $row['o_type1']=='正4特双面'){
                                $this->update("orders", "history_is_account=1,shuying_y=0,tuishui_y=0,is_win=2", "id={$row['id']}"); 
                            }else{
                            if(($row['o_type3']==$num4) ||($row['o_type3']=='红波' && in_array($num4, $hongbo))||($row['o_type3']=='蓝波' && in_array($num4, $lanbo))||($row['o_type3']=='绿波' && in_array($num4, $lvbo))||($row['o_type3']=='单' && in_array($num4, $dan))||($row['o_type3']=='双' && in_array($num4, $shuang))||($row['o_type3']=='大' && in_array($num4, $da))||($row['o_type3']=='小' && in_array($num4, $xiao))||($row['o_type3']=='合单' && in_array($num4, $hedan))||($row['o_type3']=='合双' && in_array($num4, $heshuang))||($row['o_type3']=='尾小' && in_array($num4, $weixiao))||($row['o_type3']=='尾大' && in_array($num4, $weida))||($row['o_type3']=='家禽' && in_array($animalnum7[animal], $jiaqin))||($row['o_type3']=='野兽' && in_array($animalnum7[animal], $yeshou))){
                                
                                $this->update("orders", "history_is_account=1,shuying_y=$shuying_y,is_win=1", "id={$row['id']}");                           
                            }else{  
                                $this->update("orders", "history_is_account=1,shuying_y=$roworders_y", "id={$row['id']}"); 
                            }
                            }
                        }elseif($row['o_type1']=='正5特' || $row['o_type1']=='正5特双面'){
                            if($num5=='49' && $row['o_type1']=='正5特双面'){
                                $this->update("orders", "history_is_account=1,shuying_y=0,tuishui_y=0,is_win=2", "id={$row['id']}"); 
                            }else{
                            if(($row['o_type3']==$num5) ||($row['o_type3']=='红波' && in_array($num5, $hongbo))||($row['o_type3']=='蓝波' && in_array($num5, $lanbo))||($row['o_type3']=='绿波' && in_array($num5, $lvbo))||($row['o_type3']=='单' && in_array($num5, $dan))||($row['o_type3']=='双' && in_array($num5, $shuang))||($row['o_type3']=='大' && in_array($num5, $da))||($row['o_type3']=='小' && in_array($num5, $xiao))||($row['o_type3']=='合单' && in_array($num5, $hedan))||($row['o_type3']=='合双' && in_array($num5, $heshuang))||($row['o_type3']=='尾小' && in_array($num5, $weixiao))||($row['o_type3']=='尾大' && in_array($num5, $weida))||($row['o_type3']=='家禽' && in_array($animalnum7[animal], $jiaqin))||($row['o_type3']=='野兽' && in_array($animalnum7[animal], $yeshou))){
                                
                                $this->update("orders", "history_is_account=1,shuying_y=$shuying_y,is_win=1", "id={$row['id']}");                           
                            }else{  
                                $this->update("orders", "history_is_account=1,shuying_y=$roworders_y", "id={$row['id']}"); 
                            }
                            }
                        }elseif($row['o_type1']=='正6特' || $row['o_type1']=='正6特双面'){
                            if($num6=='49' && $row['o_type1']=='正6特双面'){
                                $this->update("orders", "history_is_account=1,shuying_y=0,tuishui_y=0,is_win=2", "id={$row['id']}"); 
                            }else{
                            if(($row['o_type3']==$num6) ||($row['o_type3']=='红波' && in_array($num6, $hongbo))||($row['o_type3']=='蓝波' && in_array($num6, $lanbo))||($row['o_type3']=='绿波' && in_array($num6, $lvbo))||($row['o_type3']=='单' && in_array($num6, $dan))||($row['o_type3']=='双' && in_array($num6, $shuang))||($row['o_type3']=='大' && in_array($num6, $da))||($row['o_type3']=='小' && in_array($num6, $xiao))||($row['o_type3']=='合单' && in_array($num6, $hedan))||($row['o_type3']=='合双' && in_array($num6, $heshuang))||($row['o_type3']=='尾小' && in_array($num6, $weixiao))||($row['o_type3']=='尾大' && in_array($num6, $weida))||($row['o_type3']=='家禽' && in_array($animalnum7[animal], $jiaqin))||($row['o_type3']=='野兽' && in_array($animalnum7[animal], $yeshou))){
                                
                                $this->update("orders", "history_is_account=1,shuying_y=$shuying_y,is_win=1", "id={$row['id']}");                           
                            }else{  
                                
                                $this->update("orders", "history_is_account=1,shuying_y=$roworders_y", "id={$row['id']}");
                            }
                            }
                        }                   
                        
                    }elseif($row['o_type1']=='正码' || $row['o_type1']=='正码双面'){
                        //正码 01,02,03,04,05,06,07,08,09,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,总单,总双,总大,总小
                            if((in_array($row['o_type3'], explode(',', "$num1,$num2,$num3,$num4,$num5,$num6"))) ||($row['o_type3']=='总大' && $zong>174)||($row['o_type3']=='总小' && $zong<175)||($row['o_type3']=='总单' && $zong%2!=0)||($row['o_type3']=='总双' && $zong%2==0)){
                                
                                $this->update("orders", "history_is_account=1,shuying_y=$shuying_y,is_win=1", "id={$row['id']}");                           
                            }else{  
                                
                                $this->update("orders", "history_is_account=1,shuying_y=$roworders_y", "id={$row['id']}");
                            }    
                    }elseif($row['o_type1']=='连码'){
                        $is_maxorders_p=0;
                        //连码（開獎號码中的正码+特码）
                         if($row['o_type2']=='三中二'){
                        //            三中二（全部为正码，分三中二之三和三中二之二）
                            if(count(array_intersect(explode(',', $row['o_type3']), $nums_z))>=2){    
                                if(count(array_intersect(explode(',', $row['o_type3']), $nums_z))==3){
                                    //判断是否3个全中，是即为"三中二之三"
                                    //这时赔率计算大的那个                                    
                                    //$orders_p_m=$this->get_max_order_p($row['user_id'],$row['o_type2'],explode(',', $row['o_type3']));
                                    $orders_p_m=$this->get_max_order_p_2($row['orders_p_2']);
                                    $shuying_y=($orders_p_m[0][0]*$row['orders_y'])-$row['orders_y'];
                                    $is_maxorders_p=1;//为大赔率
                                }
                                $this->update("orders", "history_is_account=1,shuying_y=$shuying_y,is_win=1,is_maxorders_p=$is_maxorders_p", "id={$row['id']}");                           
                            }else{                                 
                                $this->update("orders", "history_is_account=1,shuying_y=$roworders_y", "id={$row['id']}");
                            } 
                         }elseif($row['o_type2']=='三全中'){
                        //            三全中（全部为正码）
                            if(count(array_intersect(explode(',', $row['o_type3']), $nums_z))==3){                             
                                $this->update("orders", "history_is_account=1,shuying_y=$shuying_y,is_win=1", "id={$row['id']}");                           
                            }else{                                 
                                $this->update("orders", "history_is_account=1,shuying_y=$roworders_y", "id={$row['id']}");
                            }  
                         }elseif($row['o_type2']=='二全中'){
                        //            二全中（全部为正码）                            
                            if(count(array_intersect(explode(',', $row['o_type3']), $nums_z))==2){                             
                                $this->update("orders", "history_is_account=1,shuying_y=$shuying_y,is_win=1", "id={$row['id']}");                           
                            }else{                                 
                                $this->update("orders", "history_is_account=1,shuying_y=$roworders_y", "id={$row['id']}");
                            } 
                         }elseif($row['o_type2']=='二中特'){
                        //            二中特（全部为正码或者正码+特码，分中二（全正码）和中特（正码+特码））
                            if(count(array_intersect(explode(',', $row['o_type3']), $nums))==2){
                                if(count(array_intersect(explode(',', $row['o_type3']), $nums_z))==2){
                                    //判断是否有一个数为特码，是即为"中特"
                                    //中二，这时赔率计算大的那个    中特，这时赔率计算小的那个  
                                    //$shuying_y=$row[orders_p]*$row['orders_y']-$row['orders_y'];
                                //$orders_p_m=$this->get_max_order_p($row['user_id'],$row['o_type2'],explode(',', $row['o_type3']));
                                $orders_p_m=$this->get_max_order_p_2($row['orders_p_2']);
                                $shuying_y=($orders_p_m[0][0]*$row['orders_y'])-$row['orders_y'];
                                $is_maxorders_p=1;//为大赔率
                                }
                                $this->update("orders", "history_is_account=1,shuying_y=$shuying_y,is_win=1,is_maxorders_p=$is_maxorders_p", "id={$row['id']}");                           
                            }else{                                 
                                $this->update("orders", "history_is_account=1,shuying_y=$roworders_y", "id={$row['id']}");
                            }
                         }elseif($row['o_type2']=='特串'){
                        //            特串（正码+特码）
                             $techuan1=explode(',', "$num1,$num7");
                             $techuan2=explode(',', "$num2,$num7");
                             $techuan3=explode(',', "$num3,$num7");
                             $techuan4=explode(',', "$num4,$num7");
                             $techuan5=explode(',', "$num5,$num7");
                             $techuan6=explode(',', "$num6,$num7");
                            if(count(array_intersect(explode(',', $row['o_type3']), $techuan1))==2 || count(array_intersect(explode(',', $row['o_type3']), $techuan2))==2 || count(array_intersect(explode(',', $row['o_type3']), $techuan3))==2 || count(array_intersect(explode(',', $row['o_type3']), $techuan4))==2 || count(array_intersect(explode(',', $row['o_type3']), $techuan5))==2 || count(array_intersect(explode(',', $row['o_type3']), $techuan6))==2){          
                                $this->update("orders", "history_is_account=1,shuying_y=$shuying_y,is_win=1", "id={$row['id']}");                           
                            }else{                                 
                                $this->update("orders", "history_is_account=1,shuying_y=$roworders_y", "id={$row['id']}");
                            }
                         }  
                    }elseif($row['o_type1']=='不中'){
                        //            不中（所選的號码都不在正码1、正码2、正码3、正码4、正码5、正码6、特码即視為中獎）
                        //            五不中 六不中 七不中 八不中 九不中
                        //01,02,03,04,05,06,07,08,09,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49
                        
                            if(!array_intersect(explode(',', $row['o_type3']), $nums)){
                                
                                $this->update("orders", "history_is_account=1,shuying_y=$shuying_y,is_win=1", "id={$row['id']}");                           
                            }else{  
                                
                                $this->update("orders", "history_is_account=1,shuying_y=$roworders_y", "id={$row['id']}");
                            } 
//                        if($row['o_type2']=='五不中'){ 
//                            
//                        }elseif($row['o_type2']=='六不中'){
//                            
//                        }elseif($row['o_type2']=='七不中'){
//                            
//                        }elseif($row['o_type2']=='八不中'){
//                            
//                        }elseif($row['o_type2']=='九不中'){
//                            
//                        }
                          
                    }elseif($row['o_type1']=='特肖'){
                        //            特肖（指開獎的第7個號码（特別號码）是所屬生肖的號码，就算中獎）
                        //            鼠 牛 虎 兔 龙 蛇 马 羊 猴 鸡 狗 猪
                            if($animalnum7[animal]==$row['o_type3']){
                                
                                $this->update("orders", "history_is_account=1,shuying_y=$shuying_y,is_win=1", "id={$row['id']}");                           
                            }else{  
                                
                                $this->update("orders", "history_is_account=1,shuying_y=$roworders_y", "id={$row['id']}");
                            }                        
                    }elseif($row['o_type1']=='多生肖'){
                        //            多生肖（指開獎的第7個號码（特別號码）是所屬生肖的號码，就算中獎）
                        //            二肖 三肖 四肖 五肖 六肖
                        $duoshengxiao='二肖,三肖,四肖,五肖,六肖';
                            if($num7=='49' && $row['o_type2']=='六肖'){
                                $this->update("orders", "history_is_account=1,shuying_y=0,tuishui_y=0,is_win=2", "id={$row['id']}");
                            }else{
                            if(in_array($row['o_type2'],explode(',', $duoshengxiao)) && in_array($animalnum7[animal], explode(',', $row['o_type3']))){
                                
                                $this->update("orders", "history_is_account=1,shuying_y=$shuying_y,is_win=1", "id={$row['id']}");                           
                            }else{  
                                
                                $this->update("orders", "history_is_account=1,shuying_y=$roworders_y", "id={$row['id']}");
                            }
                            }
 
                    }elseif($row['o_type1']=='尾数'){  
                        //            尾数（指開出的正码和特別號码中含有所屬尾数的號码，就算中獎）
                        //            0 1 2 3 4 5 6 7 8 9 
                        
                            if(in_array($row['o_type3'], $weishus)){
                                
                                $this->update("orders", "history_is_account=1,shuying_y=$shuying_y,is_win=1", "id={$row['id']}");                           
                            }else{  
                                
                                $this->update("orders", "history_is_account=1,shuying_y=$roworders_y", "id={$row['id']}");
                            }
 
                    }elseif($row['o_type1']=='一肖'){ 
                        //            一肖（挑選1生肖(排列如同生肖)投註，並選擇開獎出來的正码和特码是否在此生肖內，若開獎號码的正码和特码亦在此組合內 ，即視為中獎）
                        //            鼠 牛 虎 兔 龙 蛇 马 羊 猴 鸡 狗 猪
                            if(in_array($row['o_type3'], $animals)){
                                
                                $this->update("orders", "history_is_account=1,shuying_y=$shuying_y,is_win=1", "id={$row['id']}");                           
                            }else{  
                                
                                $this->update("orders", "history_is_account=1,shuying_y=$roworders_y", "id={$row['id']}");
                            }
                         
                    }elseif($row['o_type1']=='生肖连'){ 
                        //            生肖连（正码和特码）
                        //            二肖连[中] 二肖连[不中] 三肖连[中] 三肖连[不中] 四肖连[中] 四肖连[不中]
                        //            鼠 牛 虎 兔 龙 蛇 马 羊 猴 鸡 狗 猪
                        if($row['o_type2']=='二肖连[中]' || $row['o_type2']=='三肖连[中]' || $row['o_type2']=='四肖连[中]'){
                              //array_intersect();//判断两个数组是否有重复元素（交集个数）
                                   if($row['o_type2']=='二肖连[中]'){$geshu=2;}else if($row['o_type2']=='三肖连[中]'){$geshu=3;}else if($row['o_type2']=='四肖连[中]'){$geshu=4;}
                            if(count(array_intersect(explode(',', $row['o_type3']), $animals))==$geshu){
                                
                                $this->update("orders", "history_is_account=1,shuying_y=$shuying_y,is_win=1", "id={$row['id']}");                           
                            }else{  
                                
                                $this->update("orders", "history_is_account=1,shuying_y=$roworders_y", "id={$row['id']}");
                            }
                        }elseif($row['o_type2']=='二肖连[不中]' || $row['o_type2']=='三肖连[不中]' || $row['o_type2']=='四肖连[不中]'){
                            if(!array_intersect(explode(',', $row['o_type3']), $animals)){
                                
                                $this->update("orders", "history_is_account=1,shuying_y=$shuying_y,is_win=1", "id={$row['id']}");                           
                            }else{  
                                
                                $this->update("orders", "history_is_account=1,shuying_y=$roworders_y", "id={$row['id']}");
                            }
                        }   
                    }elseif($row['o_type1']=='尾数连'){ 
                        //            尾数连（正码和特码）
                        //            二尾连[中] 二尾连[不中] 三尾连[中] 三尾连[不中] 四尾连[中] 四尾连[不中]
                        //            0 1 2 3 4 5 6 7 8 9 
                        if($row['o_type2']=='二尾连[中]' || $row['o_type2']=='三尾连[中]' || $row['o_type2']=='四尾连[中]'){
                              //array_intersect();//判断两个数组是否有重复元素（交集个数）
                            if($row['o_type2']=='二尾连[中]'){$geshu=2;}else if($row['o_type2']=='三尾连[中]'){$geshu=3;}else if($row['o_type2']=='四尾连[中]'){$geshu=4;}
                            if(count(array_intersect(explode(',', $row['o_type3']), $weishus))==$geshu){
                                
                                $this->update("orders", "history_is_account=1,shuying_y=$shuying_y,is_win=1", "id={$row['id']}");                           
                            }else{  
                                
                                $this->update("orders", "history_is_account=1,shuying_y=$roworders_y", "id={$row['id']}");
                            }
                        }elseif($row['o_type2']=='二尾连[不中]' || $row['o_type2']=='三尾连[不中]' || $row['o_type2']=='四尾连[不中]'){
                            if(!array_intersect(explode(',', $row['o_type3']), $weishus)){
                                
                                $this->update("orders", "history_is_account=1,shuying_y=$shuying_y,is_win=1", "id={$row['id']}");                           
                            }else{  
                                
                                $this->update("orders", "history_is_account=1,shuying_y=$roworders_y", "id={$row['id']}");
                            }
                        }
                            
                    }elseif($row['o_type1']=='半波'){ 
                        //            半波（针对特码）
                        //            //查固定分类表
                        //            红单 红双 红大 红小 绿单 绿双 绿大 绿小 蓝单 蓝双 蓝大 蓝小
                            if($row['o_type3']=='红单'){
                                $banbos=$hongdan;
                            }elseif($row['o_type3']=='红双'){
                                $banbos=$hongshuang;
                            }elseif($row['o_type3']=='红大'){
                                $banbos=$hongda; 
                            }elseif($row['o_type3']=='红小'){
                                $banbos=$hongxiao; 
                            }elseif($row['o_type3']=='绿单'){
                                $banbos=$lvdan;  
                            }elseif($row['o_type3']=='绿双'){
                                $banbos=$lvshuang; 
                            }elseif($row['o_type3']=='绿大'){
                                $banbos=$lvda;  
                            }elseif($row['o_type3']=='绿小'){
                                $banbos=$lvxiao;    
                            }elseif($row['o_type3']=='蓝单'){
                                $banbos=$landan; 
                            }elseif($row['o_type3']=='蓝双'){
                                $banbos=$lanshuang; 
                            }elseif($row['o_type3']=='蓝大'){
                                $banbos=$landa;    
                            }elseif($row['o_type3']=='蓝小'){
                                $banbos=$lanxiao;    
                            }
                            if(in_array($num7, $banbos)){
                                
                                $this->update("orders", "history_is_account=1,shuying_y=$shuying_y,is_win=1", "id={$row['id']}");                           
                            }else{  
                                
                                $this->update("orders", "history_is_account=1,shuying_y=$roworders_y", "id={$row['id']}");
                            } 
                    }elseif($row['o_type1']=='过关'){  
                        //            过关（针对正码）
                        //             小于25的为小，奇数为单，偶数为双
                        //             正码1-单	 正码2-单	 正码3-单	 正码4-单	 正码5-单	 正码6-单	
                        //             正码1-双	 正码2-双	 正码3-双	 正码4-双	 正码5-双	 正码6-双	
                        //             正码1-大	 正码2-大	 正码3-大	 正码4-大	 正码5-大	 正码6-大	
                        //             正码1-小	 正码2-小	 正码3-小	 正码4-小	 正码5-小	 正码6-小
                        if($num1%2 !=0) $zhengma1ds="单";else  $zhengma1ds="双";
                        if($num1>24) $zhengma1dx="大";else  $zhengma1dx="小";
                        if($num2%2 !=0) $zhengma2ds="单";else  $zhengma2ds="双";
                        if($num2>24) $zhengma2dx="大";else  $zhengma2dx="小";
                        if($num3%2 !=0) $zhengma3ds="单";else  $zhengma3ds="双";
                        if($num3>24) $zhengma3dx="大";else  $zhengma3dx="小";
                        if($num4%2 !=0) $zhengma4ds="单";else  $zhengma4ds="双";
                        if($num4>24) $zhengma4dx="大";else  $zhengma4dx="小";
                        if($num5%2 !=0) $zhengma5ds="单";else  $zhengma5ds="双";
                        if($num5>24) $zhengma5dx="大";else  $zhengma5dx="小";
                        if($num6%2 !=0) $zhengma6ds="单";else  $zhengma6ds="双";
                        if($num6>24) $zhengma6dx="大";else  $zhengma6dx="小";
                        $guoguan=explode(',', "正码1-$zhengma1ds,正码1-$zhengma1dx,正码2-$zhengma2ds,正码2-$zhengma2dx,正码3-$zhengma3ds,正码3-$zhengma3dx,正码4-$zhengma4ds,正码4-$zhengma4dx,正码5-$zhengma5ds,正码5-$zhengma5dx,正码6-$zhengma6ds,正码6-$zhengma6dx");
                        $iscunzai3=explode('<br>',trim($row['o_type3'],'<br>'));
                        //$iscunzai3=implode(',',$iscunzai3);
                        foreach ($iscunzai3 as $icz3){
                            $i3s=explode('@',$icz3);
                            foreach ($i3s as $i3){
                                $ijia=$i3s[0];
                            }
                            $ijia2[$iii].=$ijia.',';
                        }
                        $iscz=explode(',', trim($ijia2[$iii],','));
                        if(count(array_intersect($iscz,$guoguan))==count($iscunzai3)){
                        
                            $this->update("orders", "history_is_account=1,shuying_y=$shuying_y,is_win=1", "id={$row['id']}");                           
                        }else{  
                            
                            $this->update("orders", "history_is_account=1,shuying_y=$roworders_y", "id={$row['id']}"); 
                        }    
                    }
                    $this->update("orders", "history_is_account=1", "id={$row['id']}");
                    
                }
        }
        
        //当前用户的下一级用户数组,会员级别没有
        public function loweruser_arr($user_id,$backtype){
                $loweruser_arrs=  $this->select("users", "user_id,user_name", "top_id=$user_id");
                $loweruser_id_arr=array();
                $loweruser_name_arr=array();
                while($row= $this->fetch_array($loweruser_arrs)){ 
                    $loweruser_id_arr[]=$row['user_id'];
                    $loweruser_name_arr[]=$row['user_name'];
                }
                if($backtype==2){
                return $loweruser_name_arr;
                }else{
                return $loweruser_id_arr;    
                }
        }
        
        //当前用户的下一级所有用户id
        public function lowerdownuser_arr($user_id,$power,$qishu,$tiaojian0=""){
                $powers=$power+1;
                $loweruser_arrs=  $this->select("users", "user_id", "top_id=$user_id and user_power=$powers");
                while($row= $this->fetch_array($loweruser_arrs)){ 
                    if(empty($qishu)){
                     $userisorders=  mysql_query("select id from orders where  $tiaojian0  user_id={$row['user_id']} order by id desc limit 1");
                    }else{
                     $userisorders=  mysql_query("select id from orders where  plate_num=$qishu and user_id={$row['user_id']} order by id desc limit 1");   
                    }
                     $userisorder = mysql_fetch_array($userisorders);
                     if($powers==6){
                         if($userisorder['id']){          //排除没有下注会员id
                         $loweruser_id_arr[]=$row['user_id']; 
                         }
                     }else{
                         $loweruser_id_arr[]=$row['user_id']; 
                     }
                }
                return $loweruser_id_arr; 
        }
        
        //当前用户的下级所有用户id,会员级别没有,管理员这里不考虑
        public function loweralluser_arr($user_id){
            $loweruser_id_arr0=$this->loweroneuser_arr($user_id);
            foreach ($loweruser_id_arr0 as $loweruser_id0){
                $loweruser_id_arr=$this->loweroneuser_arr($loweruser_id0);
                $loweruser_ids0.=$loweruser_id0.',';//分公司
                foreach ($loweruser_id_arr as $loweruser_id){                   
                    $loweruser_id_arr2=$this->loweroneuser_arr($loweruser_id);
                     $loweruser_ids.=$loweruser_id.',';//股东
                    foreach ($loweruser_id_arr2 as $loweruser_id2){                              
                    $loweruser_id_arr3=$this->loweroneuser_arr($loweruser_id2);
                    $loweruser_ids2.=$loweruser_id2.',';//总代理
                        foreach ($loweruser_id_arr3 as $loweruser_id3){                               
                                 $loweruser_id_arr4=$this->loweroneuser_arr($loweruser_id3);
                                 $loweruser_ids3.=$loweruser_id3.',';//代理
                                 foreach ($loweruser_id_arr4 as $loweruser_id4){
                                     $loweruser_ids4.=$loweruser_id4.',';//会员
                                 }
                        }
                    }
                }
            }
                $loweruser_id_all=$loweruser_ids0.$loweruser_ids.$loweruser_ids2.$loweruser_ids3.$loweruser_ids4;
                $loweruser_id_all=trim($loweruser_id_all,',');
                return $loweruser_id_all; 
        }
        
        public function loweroneuser_arr($user_id){
                $loweruser_arrs=  $this->select("users", "user_id", "top_id=$user_id");
                while($row= $this->fetch_array($loweruser_arrs)){ 
                    $loweruser_id_arr[]=$row['user_id']; 
                }
                return $loweruser_id_arr; 
        }
        
       //返回盘率差边对应的名字 
       public function get_abcd_o_typename($o_type,$o_type3_i){
           if($o_type>=16 && $o_type<=31){
                 if($o_type==16 || $o_type==17){
                 $shuangmian_type=explode(',', "特单,特双,特大,特小,合单,合双,尾小,尾大,家禽,野兽");
                 $bose_type=explode(',', "红波,绿波,蓝波");
                   if(in_array($o_type3_i, $shuangmian_type)){
                     $tiaojian_pan="o_typename='特码双面'";
                   }elseif(in_array($o_type3_i, $bose_type)){
                     $tiaojian_pan="o_typename='特码波色'";  
                   }else{
                     $tiaojian_pan="o_typename='特码'";  
                   }
                 }elseif($o_type==30 || $o_type==31){
                 $shuangmian_type=explode(',', "总单,总双,总大,总小");
                   if(in_array($o_type3_i, $shuangmian_type)){
                     $tiaojian_pan="o_typename='正码双面'";
                   }else{
                     $tiaojian_pan="o_typename='正码'";  
                   }
                 }else{
                 $shuangmian_type=explode(',', "单,双,大,小,合单,合双,尾小,尾大,家禽,野兽");
                   $bose_type=explode(',', "红波,绿波,蓝波");
                   if(in_array($o_type3_i, $shuangmian_type)){
                     $tiaojian_pan="o_typename='正码1-6双面'";
                   }elseif(in_array($o_type3_i, $bose_type)){
                     $tiaojian_pan="o_typename='正码1-6波色'";  
                   }else{
                     $tiaojian_pan="o_typename='正特'";  
                   }
                 }
           }elseif($o_type==32){      
                     $tiaojian_pan="o_typename='二全中'";
           }elseif($o_type==33){      
                     $tiaojian_pan="o_typename='二中特'";
           }elseif($o_type==34){      
                     $tiaojian_pan="o_typename='特串'";
           }elseif($o_type==35){      
                     $tiaojian_pan="o_typename='三全中'";
           }elseif($o_type==36){      
                     $tiaojian_pan="o_typename='三中二'";
           }elseif($o_type==37){      
                     $tiaojian_pan="o_typename='五不中'";
           }elseif($o_type==38){      
                     $tiaojian_pan="o_typename='六不中'";
           }elseif($o_type==39){      
                     $tiaojian_pan="o_typename='七不中'";
           }elseif($o_type==40){      
                     $tiaojian_pan="o_typename='八不中'";
           }elseif($o_type==41){      
                     $tiaojian_pan="o_typename='九不中'";
           }elseif($o_type==42){      
                     $tiaojian_pan="o_typename='十不中'";
           }elseif($o_type==43){      
                     $tiaojian_pan="o_typename='特肖'";
           }elseif($o_type==44){      
                     $tiaojian_pan="o_typename='一肖'";
           }elseif($o_type==45){      
                     $tiaojian_pan="o_typename='二肖'";
           }elseif($o_type==46){      
                     $tiaojian_pan="o_typename='三肖'";
           }elseif($o_type==47){      
                     $tiaojian_pan="o_typename='四肖'";
           }elseif($o_type==48){      
                     $tiaojian_pan="o_typename='五肖'";
           }elseif($o_type==49){      
                     $tiaojian_pan="o_typename='六肖'";
           }elseif($o_type==50){      
                     $tiaojian_pan="o_typename='尾数'";
           }elseif($o_type==51 || $o_type==52 || $o_type==53 || $o_type==54 || $o_type==55 || $o_type==56){      
                     $tiaojian_pan="o_typename='生肖连'";
           }elseif($o_type==57 || $o_type==58 || $o_type==59 || $o_type==60 || $o_type==61 || $o_type==62){      
                     $tiaojian_pan="o_typename='尾数连'";
           }elseif($o_type==14){      
                     $tiaojian_pan="o_typename='半波'";
           }elseif($o_type==15){      
                     $tiaojian_pan="o_typename='过关'";
           }
               return $tiaojian_pan;
       }
       
       //获取最少赔率
       public function get_min_order_p($u_id,$o_type,$o_typemin3,$order_p,$o_type3_i,$abcd_h,$order_p2=0,$is_fly=0){
            $tiaojian_pan=$this->get_abcd_o_typename($o_type,$o_type3_i);
            $onlyabcds= $this->select("abcd_rate", "*", "$tiaojian_pan");
            $onlyabcd = $this->fetch_array($onlyabcds);
            $abcd_rate=0;
            if($abcd_h=="B"){
               $abcd_rate=$onlyabcd['ab_rate']; 
            }elseif($abcd_h=="C"){
               $abcd_rate=$onlyabcd['ac_rate'];   
            }elseif($abcd_h=="D"){
               $abcd_rate=$onlyabcd['ad_rate']; 
            }
            if($o_type==33){   //连码特殊处理    二中特
                $rate=$this->get_rate(69,$u_id);//赔率大的
                $rate2=$this->get_rate(70,$u_id);
                $rate3=$this->get_rate(69,1);//赔率大的
                $rate4=$this->get_rate(70,1);
            }elseif($o_type==36){ //            三中二
                $rate=$this->get_rate(71,$u_id);//赔率大的
                $rate2=$this->get_rate(72,$u_id);
                $rate3=$this->get_rate(71,1);//赔率大的
                $rate4=$this->get_rate(72,1);
            }elseif($o_type==15){ //   过关
                $rate=$this->get_rate(63,$u_id);
                $rate2=$this->get_rate(64,$u_id);
                $rate3=$this->get_rate(65,$u_id);
                $rate4=$this->get_rate(66,$u_id);
                $rate5=$this->get_rate(67,$u_id);
                $rate6=$this->get_rate(68,$u_id);  
                $rate7=$this->get_rate(63,1);
                $rate8=$this->get_rate(64,1);
                $rate9=$this->get_rate(65,1);
                $rate10=$this->get_rate(66,1);
                $rate11=$this->get_rate(67,1);
                $rate12=$this->get_rate(68,1);    
            }else{
                $rate=$this->get_rate($o_type,1);
//                //对应分公司最新赔率
                $fly_rate_user_id=$this->rate_user_id($u_id,100);
                $rate_f_new=$this->get_rate($o_type,$fly_rate_user_id);
            }
           if($o_type==15){
                        //$ty3="正码1-单@1.7<br>正码2-双@1.8<br>正码3-大@1.9<br>正码4-小@1.9<br>正码5-大@1.9<br>正码6-双@1.9<br>";
                        $iscunzai3=explode('<br>',trim($o_type3_i,'<br>'));
                        foreach ($iscunzai3 as $icz3){
                            $i3s=explode('@',$icz3);
                            foreach ($i3s as $i3){
                                $ijia=$i3s[0];
                            }
                            $ijia2[$iii].=$ijia.',';
                        }
                        $iscz=explode(',', trim($ijia2[$iii],','));
                        foreach ($iscz as $iz){
                            $iz_arr=explode('-',$iz);
                            $zm123456[]=$iz_arr[0]; //正码123456类型
                            $dsdx[]=$iz_arr[1];     //单双大小
                        }
                        $rate_v123456=1;
                        $rate_v789101112=1;
                        foreach ($zm123456 as $zk=> $z123456){
                            
                            if($z123456=='正码1'){
                                $rate123456=$rate;
                                $rate789101112=$rate7;
                            }elseif($z123456=='正码2'){
                                $rate123456=$rate2;
                                $rate789101112=$rate8;
                            }elseif($z123456=='正码3'){
                                $rate123456=$rate3;
                                $rate789101112=$rate9;
                            }elseif($z123456=='正码4'){
                                $rate123456=$rate4;
                                $rate789101112=$rate10;
                            }elseif($z123456=='正码5'){
                                $rate123456=$rate5;
                                $rate789101112=$rate11;
                            }elseif($z123456=='正码6'){   
                                $rate123456=$rate6;
                                $rate789101112=$rate12;
                            }
                            $rate_v123456*=$rate123456[$dsdx[$zk]][1]-$abcd_rate;
                            $rate_v789101112*=$rate789101112[$dsdx[$zk]][1]-$abcd_rate;
                        }
           }
           foreach ($o_typemin3 as $k=>$mi) {
              if(in_array($mi,explode(',', $o_type3_i))){
                  if($o_type==33 || $o_type==36){
                   $rate_v1=$rate[$mi][1]-$abcd_rate;
                   $rate_p_company1[]=$rate_v1;
                   $rate_v2=$rate2[$mi][1]-$abcd_rate;
                   $rate_p_company2[]=$rate_v2;  
                   $rate_v3=$rate3[$mi][1]-$abcd_rate;
                   $rate_p_company3[]=$rate_v3;  
                   $rate_v4=$rate4[$mi][1]-$abcd_rate;
                   $rate_p_company4[]=$rate_v4; 
                  }else{
                   $rate_v=$rate[$mi][1]-$abcd_rate;
                   $rate_p_company[]=$rate_v; 
                   
                   $rate_fv=$rate_f_new[$mi][1]-$abcd_rate;
                   $rate_p_f_new[]=$rate_fv; 
                  }
                  // $ke.=$k.',';
              }
           }
//           $ke=trim($ke,',');
//           if($is_fly==0){
//           foreach ($order_p as $k2=>$mi2) {
//              if(in_array($k2,explode(',', $ke))){
//                   $min_p.=$mi2.',';
//              }
//           }
//           $min_p=explode(',', trim($min_p,','));//转换成数组
//           $orders_p=min($min_p);
//           }
           
           
           if($o_type==33 || $o_type==36){
           $orders_p_company1=min($rate_p_company1); 
           $orders_p_company2=min($rate_p_company2);
            if($u_id==1  && $is_fly==1){
            $orders_p_company3=$order_p2;//大赔率
            $orders_p_company4=$order_p;
            $orders_p=$order_p;
            }else{
            $orders_p_company3=min($rate_p_company3);
            $orders_p_company4=min($rate_p_company4);
            $orders_p=$orders_p_company4;
            }
           $orders_p_company=$orders_p_company1.'|'.$orders_p_company3.'/'.$orders_p_company2.'|'.$orders_p_company4;
           }elseif($o_type==15){ 
                if($u_id==1 && $is_fly==1){
                $orders_p_company=$order_p;
                $orders_p=$order_p;
                }else{
                $orders_p=$rate_v123456; //这个是最新的赔率，不用前台刷新
                $orders_p_company=$rate_v789101112; 
                }
           }else{
            if($u_id==1  && $is_fly==1){
            $orders_p_company=$order_p;
            $orders_p=$order_p;
            }else{
            $orders_p_company=min($rate_p_company);
            $orders_p=min($rate_p_f_new); 
            }
           }
           return array($orders_p,$orders_p_company);          
       } 
       
       //获取对碰时的最少赔率
       public function get_min_order_p_dp($u_id,$o_type,$order_p,$o_type3_i,$abcd_h){
            $tiaojian_pan=$this->get_abcd_o_typename($o_type,$o_type3_i);
            $onlyabcds= $this->select("abcd_rate", "*", "$tiaojian_pan");
            $onlyabcd = $this->fetch_array($onlyabcds);
            $abcd_rate=0;
            if($abcd_h=="B"){
               $abcd_rate=$onlyabcd['ab_rate']; 
            }elseif($abcd_h=="C"){
               $abcd_rate=$onlyabcd['ac_rate'];   
            }elseif($abcd_h=="D"){
               $abcd_rate=$onlyabcd['ad_rate']; 
            }
            if($o_type==33){   //连码特殊处理    二中特
                $rate=$this->get_rate(69,$u_id);//赔率大的
                $rate2=$this->get_rate(70,$u_id);
                $rate3=$this->get_rate(69,1);//赔率大的
                $rate4=$this->get_rate(70,1);
            }elseif($o_type==36){ //            三中二
                $rate=$this->get_rate(71,$u_id);//赔率大的
                $rate2=$this->get_rate(72,$u_id);
                $rate3=$this->get_rate(71,1);//赔率大的
                $rate4=$this->get_rate(72,1);             
            }else{
                $rate=$this->get_rate($o_type,1);
//                //对应分公司最新赔率
                $fly_rate_user_id=$this->rate_user_id($u_id,100);
                $rate_f_new=$this->get_rate($o_type,$fly_rate_user_id);
            }
           $o_typemin3=explode(',', $o_type3_i);
           foreach ($o_typemin3 as $k=>$mi) {
                  if($o_type==33 || $o_type==36){
                   $rate_v1=$rate[$mi][1]-$abcd_rate;
                   $rate_p_company1[]=$rate_v1;
                   $rate_v2=$rate2[$mi][1]-$abcd_rate;
                   $rate_p_company2[]=$rate_v2;  
                   $rate_v3=$rate3[$mi][1]-$abcd_rate;
                   $rate_p_company3[]=$rate_v3;  
                   $rate_v4=$rate4[$mi][1]-$abcd_rate;
                   $rate_p_company4[]=$rate_v4; 
                  }else{
                   $rate_v=$rate[$mi][1]-$abcd_rate;
                   $rate_p_company[]=$rate_v; 
                   
                   $rate_fv=$rate_f_new[$mi][1]-$abcd_rate;
                   $rate_p_f_new[]=$rate_fv; 
                  }
                  // $ke.=$k.',';
           }
        
           if($o_type==33 || $o_type==36){
            $orders_p_company1=min($rate_p_company1); 
            $orders_p_company2=min($rate_p_company2);
            $orders_p_company3=min($rate_p_company3);
            $orders_p_company4=min($rate_p_company4);
            $orders_p=$orders_p_company4;
            $orders_p_company=$orders_p_company1.'|'.$orders_p_company3.'/'.$orders_p_company2.'|'.$orders_p_company4;
           }else{
            $orders_p_company=min($rate_p_company);
            $orders_p=min($rate_p_f_new); 
           }
           return array($orders_p,$orders_p_company);          
       } 
       
       //单个类型3时，对应的公司赔率
       public function get_one_order_p($o_type,$o_type3_i,$abcd_h){
            $tiaojian_pan=$this->get_abcd_o_typename($o_type,$o_type3_i);
            $onlyabcds= $this->select("abcd_rate", "*", "$tiaojian_pan");
            $onlyabcd = $this->fetch_array($onlyabcds);
            $abcd_rate=0;
            if($abcd_h=="B"){
               $abcd_rate=$onlyabcd['ab_rate']; 
            }elseif($abcd_h=="C"){
               $abcd_rate=$onlyabcd['ac_rate'];   
            }elseif($abcd_h=="D"){
               $abcd_rate=$onlyabcd['ad_rate']; 
            }
            $rate=$this->get_rate($o_type,1);
            $orders_p_company=$rate[$o_type3_i][1]-$abcd_rate;
           return $orders_p_company;         
       }
       
       //二中特，三中二
       public function get_max_order_p_2($order_p_2){
            $p_arr=explode('/', $order_p_2);//转换成数组
                $p_max=explode('|', $p_arr[0]);//分公司和公司大赔率
                $p_min=explode('|', $p_arr[1]);//分公司和公司小赔率
            return array($p_max,$p_min);
       }
       
       //二中特，三中二
       public function get_max_order_p($user_id,$o_type2name,$type3_arr){
            $oddsset_types=  $this->select("oddsset_type", "o_id", "o_typename='$o_type2name'");
            $oddsset_type = $this->fetch_array($oddsset_types);
            $o_type=$oddsset_type[o_id];
            
            $this->get_tops($user_id);
            $user_top=$this->tops;
            $queryusers=  $this->select("users", "is_odds,is_fly", "user_id={$user_top['branch']['user_id']}");
            $user = $this->fetch_array($queryusers);
            if($user['is_odds']==1){
                $this->get_tops($user_top['branch']['user_id']);
                $gs=$this->tops;
             $u_id= $gs['company']['user_id'];  
            }else{
             $u_id= $user_top['branch']['user_id'];  
            }
            
            foreach ($type3_arr as $i=>$mi2) {
            if($o_type==33){
                $rate2=$this->get_rate(69,$u_id);
            }elseif($o_type==36){
                $rate2=$this->get_rate(71,$u_id);
            }
            $min_p.=$rate2[$type3_arr[$i]][1].',';
            }
            $min_p=explode(',', trim($min_p,','));//转换成数组
            $orders_p=min($min_p);
           return $orders_p;          
       }
        
        public function getCombinationToString($arr,$m)
        {
            $result = array();
            if ($m ==1)
            {
               return $arr;
            }

            if ($m == count($arr))
            {
                $result[] = implode(',' , $arr);
                return $result;
            }

            $temp_firstelement = $arr[0];
            unset($arr[0]);
            $arr = array_values($arr);
            $temp_list1 = $this->getCombinationToString($arr, ($m-1));

            foreach ($temp_list1 as $s)
            {
                $s = $temp_firstelement.','.$s;
                $result[] = $s;
            }
            unset($temp_list1);

            $temp_list2 = $this->getCombinationToString($arr, $m);
            foreach ($temp_list2 as $s)
            {
                $result[] = $s;
            }    
            unset($temp_list2);
            
            return $result;
        } 
        
        public function get_user_name($user_id,$is_user_nick=0){
            $sql=  $this->select("users", "user_name,user_nick", "user_id='$user_id'");
            $row = $this->fetch_array($sql);
            if($is_user_nick){
            return $row['user_name'].'['.$row['user_nick'].']';    
            }else{
            return $row['user_name'];
            }
        }
        
        public function get_user_power($user_id){
            $sql=  $this->select("users", "user_power", "user_id='$user_id'");
            $row = $this->fetch_array($sql);
            return $row['user_power'];
        }
        
        public function get_duiyingzhancheng($user_id){
            //`percent_company` '公司占成',
            //`percent_branch`  '分公司占成',
            //`percent_partner` '股东占成',
            //`percent_all_proxy` '总代理占成',
            //`percent_proxy`  '代理占成',
            $sql=  $this->select("users", "percent_company,percent_branch,percent_partner,percent_all_proxy,percent_proxy", "user_id='$user_id'");
            $row = $this->fetch_array($sql);
            return $row;
        }
        
        public function get_user_edit_bill($user_id){
            $sql=  $this->select("users", "is_edit_bill", "user_id='$user_id'");
            $row = $this->fetch_array($sql);
            return $row['is_edit_bill'];
        }
        
        public function get_user_tuishui($user_id){
            $sql=  $this->select("users", "else_back", "user_id='$user_id'");
            $row = $this->fetch_array($sql);
            return $row['else_back'];
        }
        
        public function output_excel($plate_num){
                $u_id=$_SESSION['uid'.$this->c_p_seesion()];// 当前用户身份
                $u_power=$_SESSION['user_power'.$this->c_p_seesion()];// 当前用户身份
                set_time_limit(0);//不限制响应时间
        /*
        引入所需的文件(提示：请将下载下来的包里的名为clsasses整个文件夹引入到你的项目中)
        */
        // $roodir = "PHPExcel_1_7_8/Classes/";
		$roodir = dirname(dirname(__FILE__))."/PHPExcel_1_7_8/Classes/";            
		//set_include_path("{$roodir}/1.7.2/Classes"); //设置包含phpexcel包的路径
		require_once($roodir . 'PHPExcel.php');
		require_once($roodir . 'PHPExcel/Writer/Excel5.php'); // 创建一个处理对象实例

		$objExcel = new PHPExcel(); // 创建文件格式写入对象实例,
		$objWriter = new PHPExcel_Writer_Excel5($objExcel); // 用于 2003 格式
		$objExcel->setActiveSheetIndex(0);
		$objActSheet = $objExcel->getActiveSheet(); //设置当前活动sheet的名称
		$objActSheet->setTitle('sheet1');
                    //// 创建一个处理对象实例（此对象对于2003 2007是相同的）
                    //$objExcel = new PHPExcel();
                    ////合併儲存隔
                    //$objExcel->getActiveSheet()->mergeCells('A1:L2')->setCellValue('A1',$month.'期数表');
                    //// 重命名表
                    ////$objExcel->getActiveSheet()->setCellValue('A1',$month.'期数表');
                    ////垂直居中
                    //$objExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                    ////开始处理数据(索引从0开始)
                    //$objExcel->setActiveSheetIndex(0);


                    //表头      
                    /*---------------------栏目名称-----------------------*/
                    $type1='A';
                    if($u_power==1){
                    $arr="编号,用户,期数,下注时间,类型1,类型2,类型3,金额,赔率,会员盘,会员退水,代理退水,总代理退水,股东退水,分公司退水,代理占成,总代理占成,股东占成,分公司占成,公司占成,代理,总代理,股东,分公司";
                    }elseif($u_power==2){
                    $arr="编号,用户,期数,下注时间,类型1,类型2,类型3,金额,赔率,会员盘,会员退水,代理退水,总代理退水,股东退水,分公司退水,代理占成,总代理占成,股东占成,分公司占成,代理,总代理,股东,分公司";    
                    }elseif($u_power==3){
                    $arr="编号,用户,期数,下注时间,类型1,类型2,类型3,金额,赔率,会员盘,会员退水,代理退水,总代理退水,股东退水,代理占成,总代理占成,股东占成,代理,总代理,股东";    
                    }elseif($u_power==4){
                    $arr="编号,用户,期数,下注时间,类型1,类型2,类型3,金额,赔率,会员盘,会员退水,代理退水,总代理退水,代理占成,总代理占成,代理,总代理";    
                    }elseif($u_power==5){    
                    $arr="编号,用户,期数,下注时间,类型1,类型2,类型3,金额,赔率,会员盘,会员退水,代理退水,代理占成,代理";    
                    }
                    $arr=iconv('gbk', 'utf-8', $arr);
                    $arr1=explode(',', $arr);

                    foreach($arr1 as $k){
                        $objExcel->getActiveSheet()->setCellValue($type1.'1', "$k");
                        $objExcel->getActiveSheet()->getColumnDimension($type1)->setWidth(10);
                       // $objExcel->getActiveSheet()->getStyle($type1.'3')->getFont()->setBold(true); //字体加粗
                        $type1++;
                    }

                    if($u_power==1){
                    $orders_alls = mysql_query("select * from orders where plate_num=$plate_num");
                    }else{
                            if($u_power==2){
                            $tiaojian="topf_id={$u_id}"; 
                            }elseif($u_power==3){
                            $tiaojian="topgd_id={$u_id}"; 
                            }elseif($u_power==4){
                            $tiaojian="topzd_id={$u_id}";
                            }elseif($u_power==5){
                            $tiaojian="topd_id={$u_id}";
                            }
                    $orders_alls = mysql_query("select * from orders where plate_num=$plate_num and ($tiaojian or user_id={$u_id})");    
                    }
                    $i = 2;
                   // $limit = 1000;
                    while($row = mysql_fetch_array($orders_alls)){ 
                    $type = 'A';
                            /*------------------------写入内容----------------------------*/
                            $objExcel->getActiveSheet()->setCellValue($type . $i, $row['id']);
                            $type++;
                            $objExcel->getActiveSheet()->setCellValue($type . $i, iconv('gbk', 'utf-8', $this->get_user_name($row['user_id'])));
                            $type++;
                            $objExcel->getActiveSheet()->setCellValue($type . $i, $row[plate_num]);
                            $type++;
                            $objExcel->getActiveSheet()->setCellValue($type . $i, date('Y-m-d H:i',$row[time]));
                            $type++;
                            $objExcel->getActiveSheet()->setCellValue($type . $i, iconv('gbk', 'utf-8', $row['o_type1']));
                            $type++;
                            $objExcel->getActiveSheet()->setCellValue($type . $i, iconv('gbk', 'utf-8', $row['o_type2']));
                            $type++;
                            $objExcel->getActiveSheet()->setCellValue($type . $i, iconv('gbk', 'utf-8', $row['o_type3']));
                            $type++;
                            $objExcel->getActiveSheet()->setCellValue($type . $i, $row['orders_y']);
                            $type++;
                            $objExcel->getActiveSheet()->setCellValue($type . $i, $row[orders_p]);
                            $type++;
                            $objExcel->getActiveSheet()->setCellValue($type . $i, $row[abcd_h]);
                            $type++;
                            $objExcel->getActiveSheet()->setCellValue($type . $i, $row[h_tui]);
                            $type++;
                            $objExcel->getActiveSheet()->setCellValue($type . $i, $row[d_tui]);
                            $type++;

                            if($u_power<=4){
                            $objExcel->getActiveSheet()->setCellValue($type . $i, $row[zd_tui]);
                            $type++;
                            }if($u_power<=3){
                            $objExcel->getActiveSheet()->setCellValue($type . $i, $row[gd_tui]);
                            $type++;
                            }if($u_power<=2){
                            $objExcel->getActiveSheet()->setCellValue($type . $i, $row[f_tui]);
                            $type++;
                            }
                            $objExcel->getActiveSheet()->setCellValue($type . $i, $row[d_z]);
                            $type++;
                            if($u_power<=4){
                            $objExcel->getActiveSheet()->setCellValue($type . $i, $row[zd_z]);
                            $type++;
                            }if($u_power<=3){
                            $objExcel->getActiveSheet()->setCellValue($type . $i, $row[gd_z]);
                            $type++;
                            }if($u_power<=2){
                            $objExcel->getActiveSheet()->setCellValue($type . $i, $row[f_z]);
                            $type++;
                            }if($u_power<=1){
                            $objExcel->getActiveSheet()->setCellValue($type . $i, $row[g_z]);
                            $type++;
                            }
                            $objExcel->getActiveSheet()->setCellValue($type . $i, iconv('gbk', 'utf-8', $this->get_user_name($row[topd_id])));
                            if($u_power<=4){
                            $type++;
                            $objExcel->getActiveSheet()->setCellValue($type . $i, iconv('gbk', 'utf-8', $this->get_user_name($row[topzd_id])));
                            }if($u_power<=3){
                            $type++;
                            $objExcel->getActiveSheet()->setCellValue($type . $i, iconv('gbk', 'utf-8', $this->get_user_name($row[topgd_id])));
                            }if($u_power<=2){
                            $type++;
                            $objExcel->getActiveSheet()->setCellValue($type . $i, iconv('gbk', 'utf-8', $this->get_user_name($row[topf_id])));
                            }
                    $i++;
//                        if ($limit == $i) { //刷新一下输出buffer，防止由于数据过多造成问题
//                            ob_flush();
//                            flush();
//                            $i = 2;
//                        }
                    }

                    //    /*----------输出内容-------------*/
                    //header('Content-Type: application/vnd.ms-excel');
                    //header('Content-Disposition: attachment;filename="'.$plate_num.'期.xls"');
                    //header('Cache-Control: max-age=0');
                    //$objWriter = PHPExcel_IOFactory::createWriter($objExcel, 'Excel5');
                    //$objWriter->save('php://output');
                    //exit;
                    //输出到浏览器.
                    header("Content-type:text/csv");
                    header("Content-Type:application/force-download");
                    header("Content-Type:application/octet-stream");
                    header("Content-Type:application/download");
                    header('Content-Disposition:inline;filename="'.$plate_num.'期.xls"');
                    header("Content-Transfer-Encoding: binary");
                    header("Expires:Mon,26 Jul 1997 05:00:00 GMT");
                    header("Last-Modified:" . gmdate("D, d M Y H:i:s") . "GMT");
                    header("Cache-Control:must-revalidate,post-check=0,pre-check=0");
                    header("Pragma:no-cache");
                    ob_clean();
                    flush();
                    $objWriter->save('php://output');
                    exit();
                    
        }
        
        //删除两个数组中重复的值并组合成一个数组
        public function del_arr_repeat_value($arr1,$arr2){
            //$arr1为所有的选择号码   $arr2为拖胆号码    
                $arrjie = $arr2;
                $arr3 = array_merge($arr1,$arr2);
                $arr4 = array_unique($arr3);
                //找出重复的值
                $arr5 = array_diff_assoc($arr3,$arr4);
                //从arr3中删除值等于
                foreach($arr5 as $item){
                        $k1 = array_search($item,$arr1);
                        $k2 = array_search($item,$arr2);
                        unset($arr1[$k1]);
                        unset($arr2[$k2]); 
                }
                $arr6 = array_merge($arr1,$arr2); 
                foreach ($arr6 as $i => $v) {
                    $arrarr[]=implode(',',$arrjie).','.$arr6[$i];
                }
            return $arrarr;
        }             

        //对碰方法 
        public function dpfun($dp_arr1,$dp_arr2,$o_type,$u_id) {
            //(2,3,4,5) 碰 (6,7,8,9)
            //$dp_arr1=explode(',',"1,2,3,6,7");
            //$dp_arr2=explode(',',"7,8,9");
            //对碰时处理特殊的赔率
                        $dp_rate=$this->get_rate($o_type,$u_id);
                        if($o_type==33){
                        $dp_rate=$this->get_rate(70,$u_id);
                        }

                        //二全中 二中特 特串 三全中 三中二
                        if($o_type==32){
                            $tiaojian_pan="二全中";
                        }elseif($o_type==33){
                            $tiaojian_pan="二中特";
                        }elseif($o_type==34){
                            $tiaojian_pan="特串";
                        }elseif($o_type==35){
                            $tiaojian_pan="三全中";
                        }elseif($o_type==36){
                            $tiaojian_pan="三中二";
                        } 
                        //号码
                        $onlyabcds=  $this->select("abcd_rate", "*", "o_typename='$tiaojian_pan'");
                        $onlyabcd = $this->fetch_array($onlyabcds);
                        $abcd_rate=0;
                        if($abcd_h=="B"){
                           $abcd_rate=$onlyabcd['ab_rate']; 
                        }elseif($abcd_h=="C"){
                           $abcd_rate=$onlyabcd['ac_rate'];   
                        }elseif($abcd_h=="D"){
                           $abcd_rate=$onlyabcd['ad_rate']; 
                        }
                        
            foreach ($dp_arr1 as $i => $v1) {
                foreach ($dp_arr2 as $j => $v2) {  
                    if($dp_arr1[$i]!=$dp_arr2[$j]){  //排除重复
                    $arrarr[]=$dp_arr1[$i].','.$dp_arr2[$j];
                    $arrarrp[]=($dp_rate[$dp_arr1[$i]][1]-$abcd_rate).','.($dp_rate[$dp_arr2[$j]][1]-$abcd_rate);
                    }
                }              
            }
            $arrarr_dp=array($arrarr,$arrarrp);
            return $arrarr_dp;
        }

        public function Get_admin_msg($url, $show = '操作已成功！') {
		$msg = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml"><head>
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
				<link rel="stylesheet" href="css/common.css" type="text/css" />
				<meta http-equiv="refresh" content="1; URL=' . $url . '" />
				<title>管理区域</title>
				</head>
				<body style=" margin-top:200px;">
				<div id="man_zone" >
				  <table width="30%" border="0"  style="line-height:20px; font-size:12px;background:url(./../images/xx.jpg) no-repeat 0 0; width:370px; height:144px;"align="center"  cellpadding="3" cellspacing="0" class="table" >
				    <tr>
				      <td align="center" style=" height:10px; line-height:10px; color:#000; font-weight:bold">信息提示</td>
				    </tr>
				    <tr>
				      <td style=" text-align:center"><p>' . $show . '<br />
				      5 秒后返回指定页面！<br />
				      如果浏览器无法跳转，<a href="' . $url . '">请点击此处</a>。</p></td>
				    </tr>
				  </table>
				</div>
				</body>
				</html>';
		echo $msg;
		exit ();
	}
        
       	public function Get_admin_msgtop($url, $show = '操作已成功！') {
		$msg = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml"><head>
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
				<link rel="stylesheet" href="css/common.css" type="text/css" />
				<SCRIPT     LANGUAGE="JavaScript">   
                                <!--   
                                 window.onload=function(){ 
                                 alert("' . $show . '");
                                 window.top.location.href="' . $url . '";   
                                 }   
                                //-->   
                                </SCRIPT> 
				<title>管理区域</title>
				</head>
				</html>';
		echo $msg;
		exit ();
	}
        
        public function Get_admin_msgtopnull($url) {
		$msg = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml"><head>
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
				<link rel="stylesheet" href="css/common.css" type="text/css" />
				<SCRIPT     LANGUAGE="JavaScript">   
                                <!--   
                                 window.onload=function(){                                  
                                 window.location.href="' . $url . '";   
                                 }   
                                //-->   
                                </SCRIPT> 
				<title>管理区域</title>
				</head>
				</html>';
		echo $msg;
		exit ();
	}
        

        //自动封盘设置
        function auto_set_plate(){
            $query = $this->select('plate', '*', '1 order by plate_num desc ');
            $row = $this->fetch_array($query);
            $nowtime=  time();
            if(strtotime($row['plate_time_end']) < $nowtime){ 
                    $this->query("update plate set is_plate_start=1,is_special=0,is_normal=0 where plate_num=".$row['plate_num']);
            }

            if($row['is_auto']==0){
                    if($nowtime>=strtotime($row['plate_time_satrt']) and $nowtime<=strtotime($row['special_time_end'])){
                       $is_special=1;//开
                    }else{
                        $is_special=0;//封
                    }
                    if($nowtime>=strtotime($row['plate_time_satrt']) and $nowtime<=strtotime($row['normal_time_end'])){
                        $is_normal=1;//开
                    }else{
                        $is_normal=0;//封
                    }
                    if($nowtime>=strtotime($row['plate_time_satrt']) and $nowtime<=strtotime($row['plate_time_end'])){
                        $is_plate_start=0;//开
                    }else{
                        $is_plate_start=1;//封
                    }
                    //$this->update("plate", "is_plate_start=0,is_special=1,is_normal=1", "plate_num=".$row['plate_num']);
                    $this->update("plate", "is_special=$is_special,is_normal=$is_normal,is_plate_start=$is_plate_start", "plate_num=".$row['plate_num']);
            }
        }
        
        //保存未结算数据
        function save_accountopen($plate_num){
                //结算前先保存一批没有结算的数据，为了能修改开奖号码重新结算用的 
                //先查询是否已存在该期数据
                $query=  $this->select("accountopen", "id", "plate_num=$plate_num limit 1");
                $is = $this->fetch_array($query);
                if(empty($is['id'])){
                $this->query("insert into accountopen select * from orders where plate_num=$plate_num");
                }
        }
        
        //修改结算
        function edit_account($plate_num){
                //先删除已结算数据再重新插入再结算  
                // $this->query("delete from orders where plate_num=$plate_num");
                // $this->query("delete from member_settlereport where plate_num=$plate_num");
                // $this->query("insert into orders select * from accountopen where plate_num=$plate_num");
                $data['is_win']=0;
                $data['history_is_account']=0;
                $this->get_update('orders',$data,' plate_num ='.$plate_num);
                $this->get_update('plate',array('history_is_account'=>0),' plate_num ='.$plate_num);
        }
        
                //保存会员结算数据
        function save_member_settlereport($plate_num){
//                $zs_zs=  $this->select("plate", "plate_time_satrt", "plate_num=$plate_num limit 0,1");
//                $zs=  $this->fetch_array($zs_zs);
//                $plate_time_satrt=strtotime($zs['plate_time_satrt']);
                $us=  $this->select("users", "user_id", "else_count_login > 0");
                while($rowus= $this->fetch_array($us)) {
                    $userzs_arr[]=$rowus['user_id'];
                }
                if(count($userzs_arr)){
                foreach ($userzs_arr as $user){
                    $baobiao_n = mysql_num_rows(mysql_query("select * from orders  where user_id = '$user' and plate_num='$plate_num'"));
                    if($baobiao_n){
                    $baobiao_y = mysql_fetch_array(mysql_query("select SUM(orders_y) as sum from orders  where user_id = '$user' and plate_num='$plate_num'" ));
                    $baobiao_s = mysql_fetch_array(mysql_query("select SUM(shuying_y) as sum from orders  where user_id = '$user' and plate_num='$plate_num'" ));
                    $baobiao_t = mysql_fetch_array(mysql_query("select SUM(tuishui_y) as sum from orders  where user_id = '$user' and plate_num='$plate_num'" ));
                    
                    
                    $order_y=round($baobiao_y[sum],1);
                    $shuying_y=round($baobiao_s[sum],1);
                    $tuishui_y=round($baobiao_t[sum],1);
                    $end_y=round($baobiao_s[sum],1)+round($baobiao_t[sum],1);
                    
                    $this->query("INSERT ignore INTO `member_settlereport` (`user_id`, `plate_num`,`bishu`,`order_y`,`shuying_y`,`tuishui_y`,`end_y`) " .
                                    "VALUES ('{$user}', '{$plate_num}', '{$baobiao_n}', '{$order_y}', '{$shuying_y}', '{$tuishui_y}', '{$end_y}')");  
                    }
                }
                }
        }
        
        //判断是否开盘
        function is_plate_starts(){         
            $is_kaipans = $this->select('plate', 'is_plate_start', '1 order by plate_num desc ');
            $is_kaipan = $this->fetch_array($is_kaipans);
            return $is_kaipan['is_plate_start'];  //0为开盘，1为封盘
        }
        
                //判断是否已结算
        function is_plate_account($qishu){   
            if($qishu){
            $is_accounts = $this->select('plate', 'history_is_account', "plate_num={$qishu}");
            $is_account = $this->fetch_array($is_accounts);
            return $is_account['history_is_account'];  //0为未结算，1已结算
            }
        }
        
        //判断是否分公司赔率还是公司
        function is_myplate($uid){ 
            $this->get_tops($uid);
            $user_top=$this->tops;
            $queryusers=  $this->select("users", "is_odds,is_fly", "user_id={$user_top['branch']['user_id']}");
            $user = $this->fetch_array($queryusers);
            if($user['is_odds']==1){
                $u_id= $user_top['company']['user_id'];  
            }else{
                $u_id= $user_top['branch']['user_id'];  
            }
            return $u_id;  //返回对应赔率用户id
        }
        
//        //下注单对应上级赚取的退水值 和 当前用户实占退水
//        function zuanqutuishui($gaiuid,$uid,$z_uid,$z_u_power,$z_zc,$set_name,$abcd_h,$user_zonge){
//            //echo $gaiuid.','.$uid.','.$z_uid.','.$z_u_power.','.$set_name.','.$abcd_h.','.$user_zonge.'<br>';
//            //$uid 为显示用户id  $z_uid为要赚取退水用户id 
//        $shizhanzhue=$user_zonge*$z_zc/100;
//        $query1=  $this->select("back_set", "percent_a,percent_b,percent_c,percent_d", "user_id=$uid and set_name='$set_name'");
//        $row1 = $this->fetch_array($query1);
//        
//        $query2=  $this->select("back_set", "percent_a,percent_b,percent_c,percent_d", "user_id=$z_uid and set_name='$set_name'");
//        $row2 = $this->fetch_array($query2); 
//        //echo '@'.$row2['percent_a'].','.$row1['percent_a'].'@';
//            if($abcd_h=='A'){
//                  $mytuishuizhi=$row2['percent_a']-$row1['percent_a'];
//                  $myshizhantuishui=$row1['percent_a'];
//            }elseif($abcd_h=='B'){
//                  $mytuishuizhi=$row2['percent_b']-$row1['percent_b'];
//                  $myshizhantuishui=$row1['percent_b'];
//            }elseif($abcd_h=='C'){
//                  $mytuishuizhi=$row2['percent_c']-$row1['percent_c'];
//                  $myshizhantuishui=$row1['percent_c'];
//            }elseif($abcd_h=='D'){
//                  $mytuishuizhi=$row2['percent_d']-$row1['percent_d'];  
//                  $myshizhantuishui=$row1['percent_d'];
//            }
//            //echo $mytuishuizhi;
//            $shizhantuishui=-($shizhanzhue*$myshizhantuishui/100);//当前用户实占退水
//            //echo $shizhantuishui.'<br>';
//            $gaiusers=  $this->select("users", "percent_company,percent_branch,percent_partner,percent_all_proxy", "user_id=$gaiuid");
//            $gaiuser = $this->fetch_array($gaiusers);
//            
//         if($z_u_power==1){
//             $zuanqutuishui=0; //赚取退水=下注总额*（以上上级占成总和）/100*赚下级退水值/100
//         }elseif($z_u_power==2){
//             $zuanqutuishui=$user_zonge*($gaiuser['percent_company'])/100*$mytuishuizhi/100; //赚取退水=下注总额*（以上上级占成总和）/100*赚下级退水值/100    
//         }elseif($z_u_power==3){
//             $zuanqutuishui=$user_zonge*($gaiuser['percent_company']+$gaiuser['percent_branch'])/100*$mytuishuizhi/100; //赚取退水=下注总额*（以上上级占成总和）/100*赚下级退水值/100
//         }elseif($z_u_power==4){
//             $zuanqutuishui=$user_zonge*($gaiuser['percent_company']+$gaiuser['percent_branch']+$gaiuser['percent_partner'])/100*$mytuishuizhi/100; //赚取退水=下注总额*（以上上级占成总和）/100*赚下级退水值/100       
//         }elseif($z_u_power==5){
//             $zuanqutuishui=$user_zonge*($gaiuser['percent_company']+$gaiuser['percent_branch']+$gaiuser['percent_partner']+$gaiuser['percent_all_proxy'])/100*$mytuishuizhi/100; //赚取退水=下注总额*（以上上级占成总和）/100*赚下级退水值/100       
//         }      
//         //echo $zuanqutuishui;
//            return array($zuanqutuishui,$shizhantuishui);  //返回赚取退水值           
//        }
        
         //下注单对应上级赚取的退水值 和 当前用户实占退水
        function zuanqutuishui($id,$z_u_power,$z_zc){

        $gaiusers=  $this->select("orders", "*", "id=$id");
        $row = $this->fetch_array($gaiusers);    
	if($row['o_type2']=='二中特' || $row['o_type2']=='三中二'){
            $orders_p_m=$this->get_max_order_p_2($row['orders_p_2']);
            if($row['is_maxorders_p']){ //是否中了大赔率
                $orders_p_12=$orders_p_m[0][1]; 
		$orders_p_3456=$orders_p_m[0][0];
            }else{
                $orders_p_12=$orders_p_m[1][1];
	        $orders_p_3456=$orders_p_m[1][0];
            } 
	}else{
                $orders_p_2=explode('|', $row['orders_p_2']);
		$orders_p_12=$orders_p_2[1];
		$orders_p_3456=$orders_p_2[0];
	}


         //中奖与不中奖计算方式不同
        if($row['is_win']==1){  //是否中奖
        $d1=-(($row['orders_y']*$row['g_z']/100)*($orders_p_12-1))-(($row['orders_y']*$row['g_z']/100)*$row['f_tui']/100);
        $d2=-(($row['orders_y']*$row['f_z']/100)*($orders_p_3456-1))-(($row['orders_y']*$row['f_z']/100)*$row['gd_tui']/100)+(($row['orders_y']*$row['g_z']/100)*($orders_p_12-$orders_p_3456));
        $d3=-(($row['orders_y']*$row['gd_z']/100)*($orders_p_3456-1))-(($row['orders_y']*$row['gd_z']/100)*$row['zd_tui']/100);
        $d4=-(($row['orders_y']*$row['zd_z']/100)*($orders_p_3456-1))-(($row['orders_y']*$row['zd_z']/100)*$row['d_tui']/100);
        $d5=-(($row['orders_y']*$row['d_z']/100)*($orders_p_3456-1))-(($row['orders_y']*$row['d_z']/100)*$row['h_tui']/100);
        $j1=-(($row['orders_y']*$row['g_z']/100)*($orders_p_12-1));
        $j2=-(($row['orders_y']*$row['f_z']/100)*($orders_p_3456-1))+(($row['orders_y']*$row['g_z']/100)*($orders_p_12-$orders_p_3456));
        $j3=-(($row['orders_y']*$row['gd_z']/100)*($orders_p_3456-1));
        $j4=-(($row['orders_y']*$row['zd_z']/100)*($orders_p_3456-1));
        $j5=-(($row['orders_y']*$row['d_z']/100)*($orders_p_3456-1));
        }elseif($row['is_win']==0){
        $d1=($row['orders_y']*$row['g_z']/100)-(($row['orders_y']*$row['g_z']/100)*$row['f_tui']/100);
        $d2=($row['orders_y']*$row['f_z']/100)-(($row['orders_y']*$row['f_z']/100)*$row['gd_tui']/100);
        $d3=($row['orders_y']*$row['gd_z']/100)-(($row['orders_y']*$row['gd_z']/100)*$row['zd_tui']/100);
        $d4=($row['orders_y']*$row['zd_z']/100)-(($row['orders_y']*$row['zd_z']/100)*$row['d_tui']/100);
        $d5=($row['orders_y']*$row['d_z']/100)-(($row['orders_y']*$row['d_z']/100)*$row['h_tui']/100);
        $j1=$row['orders_y']*$row['g_z']/100;
        $j2=$row['orders_y']*$row['f_z']/100;
        $j3=$row['orders_y']*$row['gd_z']/100;
        $j4=$row['orders_y']*$row['zd_z']/100;
        $j5=$row['orders_y']*$row['d_z']/100;
        }else{//打和
        $d1=0;
        $d2=0;
        $d3=0;
        $d4=0;
        $d5=0;
        $j1=0;
        $j2=0;
        $j3=0;
        $j4=0;
        $j5=0;
        }
     
        $shizhanzhue=$row['orders_y']*$z_zc/100;
                 
         if($z_u_power==1){
             $zuanqutuishui=0; //赚取退水=下注总额*（以上上级占成总和）/100*赚下级退水值/100
             $myshizhantuishui=$row['f_tui'];
             $shizhantuishui=-($shizhanzhue*$myshizhantuishui/100);//当前用户实占退水
             $xiajizuanqutuishui=$row['orders_y']*($row['g_z'])/100*($row['f_tui']-$row['gd_tui'])/100;
             $zijituishui=0;//自己退水
             $yingshou_down=$d1;
             $shizhanjieguo=$j1+$shizhantuishui;
//             if($row['is_fly']){
//             $shizhanzhue=$row['orders_y'];
//             }else{
             $shizhanzhue=$row['orders_y']*$row['g_z']/100;    
//             }
         }elseif($z_u_power==2){
             $mytuishuizhi=$row['f_tui']-$row['gd_tui'];
             $myshizhantuishui=$row['gd_tui'];
             $shizhantuishui=-($shizhanzhue*$myshizhantuishui/100);//当前用户实占退水
             $zuanqutuishui=$row['orders_y']*($row['g_z'])/100*$mytuishuizhi/100; //赚取退水=下注总额*（以上上级占成总和）/100*赚下级退水值/100  
             $xiajizuanqutuishui=$row['orders_y']*($row['g_z']+$row['f_z'])/100*($row['gd_tui']-$row['zd_tui'])/100;
             $zijituishui=$row['orders_y']*($row['g_z'])/100*($row['f_tui']-$row['gd_tui'])/100;
             $yingshou_down=$d1+$d2+$zijituishui;
             $shizhanjieguo=$j2+$shizhantuishui;
//             if($row['is_fly']){
//             $shizhanzhue=$row['orders_y'];
//             }else{
             $shizhanzhue=$row['orders_y']*$row['f_z']/100;    
//             }
         }elseif($z_u_power==3){
             $mytuishuizhi=$row['gd_tui']-$row['zd_tui'];
             $myshizhantuishui=$row['zd_tui'];
             $shizhantuishui=-($shizhanzhue*$myshizhantuishui/100);//当前用户实占退水
             $zuanqutuishui=$row['orders_y']*($row['g_z']+$row['f_z'])/100*$mytuishuizhi/100; //赚取退水=下注总额*（以上上级占成总和）/100*赚下级退水值/100
             $xiajizuanqutuishui=$row['orders_y']*($row['g_z']+$row['f_z']+$row['gd_z'])/100*($row['zd_tui']-$row['d_tui'])/100;
             $zijituishui=$row['orders_y']*($row['g_z'])/100*($row['f_tui']-$row['gd_tui'])/100+$row['orders_y']*($row['g_z']+$row['f_z'])/100*($row['gd_tui']-$row['zd_tui'])/100;
             $yingshou_down=$d1+$d2+$d3+$zijituishui;
             $shizhanjieguo=$j3+$shizhantuishui;
//             if($row['is_fly']){
//             $shizhanzhue=$row['orders_y'];
//             }else{
             $shizhanzhue=$row['orders_y']*$row['gd_z']/100;    
//             }
         }elseif($z_u_power==4){
             $mytuishuizhi=$row['zd_tui']-$row['d_tui'];
             $myshizhantuishui=$row['d_tui'];
             $shizhantuishui=-($shizhanzhue*$myshizhantuishui/100);//当前用户实占退水
             $zuanqutuishui=$row['orders_y']*($row['g_z']+$row ['f_z']+$row['gd_z'])/100*$mytuishuizhi/100; //赚取退水=下注总额*（以上上级占成总和）/100*赚下级退水值/100    
             $xiajizuanqutuishui=$row['orders_y']*($row['g_z']+$row['f_z']+$row['gd_z']+$row['zd_z'])/100*($row['d_tui']-$row['h_tui'])/100;
             $zijituishui=$row['orders_y']*($row['g_z'])/100*($row['f_tui']-$row['gd_tui'])/100+$row['orders_y']*($row['g_z']+$row['f_z'])/100*($row['gd_tui']-$row['zd_tui'])/100+$row['orders_y']*($row['g_z']+$row['f_z']+$row['gd_z'])/100*($row['zd_tui']-$row['d_tui'])/100;
             $yingshou_down=$d1+$d2+$d3+$d4+$zijituishui;
             $shizhanjieguo=$j4+$shizhantuishui;
//             if($row['is_fly']){
//             $shizhanzhue=$row['orders_y'];
//             }else{
             $shizhanzhue=$row['orders_y']*$row['zd_z']/100;    
//             }
         }elseif($z_u_power==5){
             $mytuishuizhi=$row['d_tui']-$row['h_tui'];
             $myshizhantuishui=$row['h_tui'];
             $shizhantuishui=-($shizhanzhue*$myshizhantuishui/100);//当前用户实占退水
             $zuanqutuishui=$row['orders_y']*($row['g_z']+$row['f_z']+$row['gd_z']+$row['zd_z'])/100*$mytuishuizhi/100; //赚取退水=下注总额*（以上上级占成总和）/100*赚下级退水值/100   
             $xiajizuanqutuishui=0;
             $zijituishui=$row['orders_y']*($row['g_z'])/100*($row['f_tui']-$row['gd_tui'])/100+$row['orders_y']*($row['g_z']+$row['f_z'])/100*($row['gd_tui']-$row['zd_tui'])/100+$row['orders_y']*($row['g_z']+$row['f_z']+$row['gd_z'])/100*($row['zd_tui']-$row['d_tui'])/100+$row['orders_y']*($row['g_z']+$row['f_z']+$row['gd_z']+$row['zd_z'])/100*($row['d_tui']-$row['h_tui'])/100;
             $yingshou_down=$d1+$d2+$d3+$d4+$d5+$zijituishui;
             $shizhanjieguo=$j5+$shizhantuishui;
//             if($row['is_fly']){
//             $shizhanzhue=$row['orders_y'];
//             }else{
             $shizhanzhue=$row['orders_y']*$row['d_z']/100;    
//             }
         }     
             //中奖与不中奖计算方式不同
//             if($row['is_win']){  //是否中奖
//              // $d1=-(($row['orders_y']*$row['g_z']/100)*($row['orders_p']-1))-(($row['orders_y']*$row['g_z']/100)*$row['f_tui']/100);
//               //$yingshou_down=-($shizhanzhue*($row['orders_p']-1))+$shizhantuishui;//应收下线=实占注额*(赔率-1)的积的相反数+实占退水  
//             }else{
//              // $d1=($row['orders_y']*$row['g_z']/100)-(($row['orders_y']*$row['g_z']/100)*$row['f_tui']/100);
//               //$yingshou_down=$shizhanzhue+$shizhantuishui;//应收下线=实占注额+实占退水  
//             }

             //echo $yingshou_down.'<br>';
        // echo $zuanqutuishui.'<br>';
            if($row['is_win']==2){$zuanqutuishui=0;$shizhantuishui=0;$xiajizuanqutuishui=0;$yingshou_down=0;$shizhanjieguo=0; }
            return array($zuanqutuishui,$shizhantuishui,$xiajizuanqutuishui,$yingshou_down,$shizhanjieguo,$shizhanzhue);  //返回赚取退水值           
        }
        
        //报表---会员----赚取退水
        function huiyuanreport_zuanqutuishui($id,$z_u_power){

        $gaiusers=  $this->select("orders", "*", "id=$id");
        $row = $this->fetch_array($gaiusers);  
 	if($row['o_type2']=='二中特' || $row['o_type2']=='三中二'){
            $orders_p_m=$this->get_max_order_p_2($row['orders_p_2']);
            if($row['is_maxorders_p']){ //是否中了大赔率
                $orders_p_12=$orders_p_m[0][1]; 
		$orders_p_3456=$orders_p_m[0][0];
            }else{
                $orders_p_12=$orders_p_m[1][1];
	        $orders_p_3456=$orders_p_m[1][0];
            } 
	}else{
                $orders_p_2=explode('|', $row['orders_p_2']);
		$orders_p_12=$orders_p_2[1];
		$orders_p_3456=$orders_p_2[0];
	}


         //中奖与不中奖计算方式不同
        if($row['is_win']==1){  //是否中奖
        $j1=-(($row['orders_y']*$row['g_z']/100)*($orders_p_12-1));
        $j2=-(($row['orders_y']*$row['f_z']/100)*($orders_p_3456-1))+(($row['orders_y']*$row['g_z']/100)*($orders_p_12-$orders_p_3456));
        $j3=-(($row['orders_y']*$row['gd_z']/100)*($orders_p_3456-1));
        $j4=-(($row['orders_y']*$row['zd_z']/100)*($orders_p_3456-1));
        $j5=-(($row['orders_y']*$row['d_z']/100)*($orders_p_3456-1));
        }elseif($row['is_win']==0){
        $j1=$row['orders_y']*$row['g_z']/100;
        $j2=$row['orders_y']*$row['f_z']/100;
        $j3=$row['orders_y']*$row['gd_z']/100;
        $j4=$row['orders_y']*$row['zd_z']/100;
        $j5=$row['orders_y']*$row['d_z']/100;
        }else{//打和
        $j1=0;
        $j2=0;
        $j3=0;
        $j4=0;
        $j5=0;
        }
         
        $h_shuying=$row['shuying_y']+$row['tuishui_y'];
                 
         if($z_u_power==1){
//             if($row['is_fly']){
//             $shizhanzhue=$row['orders_y'];
//             }else{
             $shizhanzhue=$row['orders_y']*$row['g_z']/100;    
//             }
             $zuanqutuishui=0; //赚取退水=下注总额*（以上上级占成总和）/100*赚下级退水值/100
             $myshizhantuishui=$row['g_tui']-$row['f_tui'];
             $shizhantuishui=-($shizhanzhue*$myshizhantuishui/100);//当前用户实占退水
             $shijijieguo=$j1+$shizhantuishui+$zuanqutuishui;
             $huiyuan_view_zuanqutuishui=$shijijieguo+($h_shuying*$row['g_z']/100);
           //  if($row['g_z']==0)$huiyuan_view_zuanqutuishui=0;
         }elseif($z_u_power==2){
//             if($row['is_fly']){
//             $shizhanzhue=$row['orders_y'];
//             }else{
             $shizhanzhue=$row['orders_y']*$row['f_z']/100;    
//             }
             $mytuishuizhi=$row['f_tui']-$row['gd_tui'];
             $myshizhantuishui=$row['gd_tui'];
             $shizhantuishui=-($shizhanzhue*$myshizhantuishui/100);//当前用户实占退水
             $zuanqutuishui=$row['orders_y']*($row['g_z'])/100*$mytuishuizhi/100; //赚取退水=下注总额*（以上上级占成总和）/100*赚下级退水值/100  
             if($row['is_fly'] && $row['gd_tui']==0){
                $zuanqutuishui=0; 
             }
             $shijijieguo=$j2+$shizhantuishui+$zuanqutuishui;
             $huiyuan_view_zuanqutuishui=$shijijieguo+($h_shuying*$row['f_z']/100);
            // echo $huiyuan_view_zuanqutuishui;
            // if($row['f_z']==0)$huiyuan_view_zuanqutuishui=0;
         }elseif($z_u_power==3){
//             if($row['is_fly']){
//             $shizhanzhue=$row['orders_y'];
//             }else{
             $shizhanzhue=$row['orders_y']*$row['gd_z']/100;    
//             }
             $mytuishuizhi=$row['gd_tui']-$row['zd_tui'];
             $myshizhantuishui=$row['zd_tui'];
             $shizhantuishui=-($shizhanzhue*$myshizhantuishui/100);//当前用户实占退水
             $zuanqutuishui=$row['orders_y']*($row['g_z']+$row['f_z'])/100*$mytuishuizhi/100; //赚取退水=下注总额*（以上上级占成总和）/100*赚下级退水值/100
             if($row['is_fly'] && $row['zd_tui']==0){
                $zuanqutuishui=0; 
             }
             $shijijieguo=$j3+$shizhantuishui+$zuanqutuishui;
             $huiyuan_view_zuanqutuishui=$shijijieguo+($h_shuying*$row['gd_z']/100);
             //if($row['gd_z']==0)$huiyuan_view_zuanqutuishui=0;
         }elseif($z_u_power==4){
//             if($row['is_fly']){
//             $shizhanzhue=$row['orders_y'];
//             }else{
             $shizhanzhue=$row['orders_y']*$row['zd_z']/100;    
//             }
             $mytuishuizhi=$row['zd_tui']-$row['d_tui'];
             $myshizhantuishui=$row['d_tui'];
             $shizhantuishui=-($shizhanzhue*$myshizhantuishui/100);//当前用户实占退水
             $zuanqutuishui=$row['orders_y']*($row['g_z']+$row ['f_z']+$row['gd_z'])/100*$mytuishuizhi/100; //赚取退水=下注总额*（以上上级占成总和）/100*赚下级退水值/100    
             if($row['is_fly'] && $row['d_tui']==0){
                $zuanqutuishui=0; 
             }
             $shijijieguo=$j4+$shizhantuishui+$zuanqutuishui;
             $huiyuan_view_zuanqutuishui=$shijijieguo+($h_shuying*$row['zd_z']/100);
          //   if($row['zd_z']==0)$huiyuan_view_zuanqutuishui=0;
         }elseif($z_u_power==5){
//             if($row['is_fly']){
//             $shizhanzhue=$row['orders_y'];
//             }else{
             $shizhanzhue=$row['orders_y']*$row['d_z']/100;    
//             }
             $mytuishuizhi=$row['d_tui']-$row['h_tui'];
             $myshizhantuishui=$row['h_tui'];
             $shizhantuishui=-($shizhanzhue*$myshizhantuishui/100);//当前用户实占退水
             $zuanqutuishui=$row['orders_y']*($row['g_z']+$row['f_z']+$row['gd_z']+$row['zd_z'])/100*$mytuishuizhi/100; //赚取退水=下注总额*（以上上级占成总和）/100*赚下级退水值/100   
             if($row['is_fly'] && $row['h_tui']==0){
                $zuanqutuishui=0; 
             }
             $shijijieguo=$j5+$shizhantuishui+$zuanqutuishui;
             $huiyuan_view_zuanqutuishui=$shijijieguo+($h_shuying*$row['d_z']/100);
          //   if($row['d_z']==0)$huiyuan_view_zuanqutuishui=0;
         }
         
         
//         if($z_u_power==1){
//             $zuanqutuishui=0; //赚取退水=下注总额*（以上上级占成总和）/100*赚下级退水值/100
//         }elseif($z_u_power==2){
//             $mytuishuizhi=$row['f_tui']-$row['gd_tui'];//再减去下级的退水
//             $mytuishuizhi2=$row['gd_tui']-$row['zd_tui'];//再减去下下级的退水
//             $zuanqutuishui=$row['orders_y']*($row['g_z'])/100*$mytuishuizhi/100-($row['orders_y']*($row['g_z'])/100*$mytuishuizhi2/100); //赚取退水=下注总额*（以上上级占成总和）/100*赚下级退水值/100  
//         }elseif($z_u_power==3){
//             $mytuishuizhi=$row['gd_tui']-$row['zd_tui'];
//           //  $mytuishuizhi2=$row['zd_tui']-$row['d_tui'];//再减去下下级的退水
//             $zuanqutuishui=$row['orders_y']*($row['g_z']+$row['f_z'])/100*$mytuishuizhi/100-($row['orders_y']*($row['g_z']+$row['f_z'])/100*$mytuishuizhi2/100); //赚取退水=下注总额*（以上上级占成总和）/100*赚下级退水值/100
//         }elseif($z_u_power==4){
//             $mytuishuizhi=$row['zd_tui']-$row['d_tui'];
//           //  $mytuishuizhi2=$row['d_tui']-$row['h_tui'];//再减去下下级的退水
//             $zuanqutuishui=$row['orders_y']*($row['g_z']+$row ['f_z']+$row['gd_z'])/100*$mytuishuizhi/100-($row['orders_y']*($row['g_z']+$row ['f_z']+$row['gd_z'])/100*$mytuishuizhi2/100); //赚取退水=下注总额*（以上上级占成总和）/100*赚下级退水值/100    
//         }elseif($z_u_power==5){
//             $mytuishuizhi=$row['d_tui']-$row['h_tui'];
//             $zuanqutuishui=$row['orders_y']*($row['g_z']+$row['f_z']+$row['gd_z']+$row['zd_z'])/100*$mytuishuizhi/100; //赚取退水=下注总额*（以上上级占成总和）/100*赚下级退水值/100   
//         }     
            if($row['is_win']==2){ $huiyuan_view_zuanqutuishui=0;}//打和时为0
            return round($huiyuan_view_zuanqutuishui,2);            
        }
        
        //报表---会员----走飞时特殊数据处理
        function huiyuanreport_fly($id,$z_u_power){

        $gaiusers=  $this->select("orders", "*", "id=$id");
        $row = $this->fetch_array($gaiusers);  
 	if($row['o_type2']=='二中特' || $row['o_type2']=='三中二'){
            $orders_p_m=$this->get_max_order_p_2($row['orders_p_2']);
            if($row['is_maxorders_p']){ //是否中了大赔率
                $orders_p_12=$orders_p_m[0][1]; 
		$orders_p_3456=$orders_p_m[0][0];
            }else{
                $orders_p_12=$orders_p_m[1][1];
	        $orders_p_3456=$orders_p_m[1][0];
            } 
	}else{
                $orders_p_2=explode('|', $row['orders_p_2']);
		$orders_p_12=$orders_p_2[1];
		$orders_p_3456=$orders_p_2[0];
	}
//        $xiazhu_user_power=$this->get_user_power($row['user_id']);
        if($z_u_power==1){$zc=$row['g_z'];}elseif($z_u_power==2){$zc=$row['f_z'];}elseif($z_u_power==3){$zc=$row['gd_z'];}elseif($z_u_power==4){$zc=$row['zd_z'];}elseif($z_u_power==5){$zc=$row['d_z'];}
        if($zc==0){$row['tuishui_y']=0;}
        if($row['is_win']==1){
//            if($xiazhu_user_power==1){
//              $zzz=round(abs($row['orders_y'])*($orders_p_12-1),2)*$zc/100+$row['tuishui_y'];    
//            }else{
              $zzz=round(abs($row['orders_y'])*($orders_p_3456-1),2)*$zc/100+$row['tuishui_y'];  
//            }       
        }elseif($row['is_win']==0){
            $zzz=-(abs($row['orders_y']))*$zc/100+$row['tuishui_y'];        
        }else{
            $zzz=0;
        }
        //if($zc==0)$zzz=0;

            return $zzz;            
        }
       
       //退水值设置不能大于上级
       public function type_dy_backvalue($top_id,$set_name,$percent_abcd){
            if($top_id>1){
            $query=$this->select("back_set", "*", "user_id=$top_id and set_name='$set_name' limit 0,1");
            $tuishui = $this->fetch_array($query);
            if($percent_abcd=='percent_d'){
                $top_percent_abcd=$tuishui['percent_d'];
            }elseif($percent_abcd=='percent_c'){
                $top_percent_abcd=$tuishui['percent_c'];
            }elseif($percent_abcd=='percent_b'){
                $top_percent_abcd=$tuishui['percent_b'];
            }else{
                $top_percent_abcd=$tuishui['percent_a'];                   
            }
            return $top_percent_abcd;
            }else{
            return 10;    
            }
        }
         //最少投注金额设置不能小于上级
       public function type_dy_backvalue3($top_id,$set_name,$bottom_limit){
            if($top_id>1){
            $query=$this->select("back_set", "*", "user_id=$top_id and set_name='$set_name' limit 0,1");
            $tuishui = $this->fetch_array($query);
       
                $bottom_limit=$tuishui['bottom_limit'];                   
          
            return $bottom_limit;
            }else{
            return 1;    
            }
        }
          //单注金额设置不能大于上级
       public function type_dy_backvalue1($top_id,$set_name,$top_limit){
            if($top_id>1){
            $query=$this->select("back_set", "*", "user_id=$top_id and set_name='$set_name' limit 0,1");
            $tuishui = $this->fetch_array($query);
       
                $top_limit=$tuishui['top_limit'];                   
          
            return $top_limit;
            }else{
            return 10;    
            }
        }
            //单项金额设置不能大于上级
       public function type_dy_backvalue2($top_id,$set_name,$odd_limit){
            if($top_id>1){
            $query=$this->select("back_set", "*", "user_id=$top_id and set_name='$set_name' limit 0,1");
            $tuishui = $this->fetch_array($query);
       
                $odd_limit=$tuishui['odd_limit'];                   
          
            return $odd_limit;
            }else{
            return 10;    
            }
        }
        //当前期数相关信息
        public function dangqianqishu_arr($qianyiqi=""){
            $qishus=  $this->select("plate", "*", "1 order by plate_num desc limit 1");
            $qishu = $this->fetch_array($qishus);
            if($qianyiqi==-1){  //上一期信息
                $plate_num=$qishus['plate_num']-1;
                $qishus1=  $this->select("plate", "*", "plate_num={$plate_num} limit 1");
                $qishu = $this->fetch_array($qishus1);
            }
            return $qishu;
        }
        
        //同步更新下级退水值，当上级修改退水值时，下级当前的退水值不能大于上级
        public function down_tuishui_update($down_user_arr,$percent_a,$percent_b,$percent_c,$percent_d,$set_name){
            if($down_user_arr[0]){
            foreach ($down_user_arr as $user_id){
                 $query=  $this->select("back_set", "percent_a,percent_b,percent_c,percent_d", "user_id=$user_id and set_name='$set_name'");
                 $row = $this->fetch_array($query);
                 if($row['percent_a']>$percent_a){
                     $this->update("back_set", "percent_a=$percent_a", "user_id=$user_id and set_name='$set_name'");
                 }
                 if($row['percent_b']>$percent_b){
                     $this->update("back_set", "percent_b=$percent_b", "user_id=$user_id and set_name='$set_name'");
                 }
                 if($row['percent_c']>$percent_c){
                     $this->update("back_set", "percent_c=$percent_c", "user_id=$user_id and set_name='$set_name'");
                 }
                 if($row['percent_d']>$percent_d){
                     $this->update("back_set", "percent_d=$percent_d", "user_id=$user_id and set_name='$set_name'");
                 }
            }
            }
        }
        
        //判断当前用户是否存在,是否已被删除
        public function user_exists($user_id){
            if($user_id){
            $user_exists=  $this->select("users", "user_id", "user_id={$user_id}");
            $exists = $this->fetch_array($user_exists);
            if($exists['user_id']){
                $cunzai=1;
            }else{
                $cunzai=0;
            }
            }else{
                $cunzai=0;
            }
            return $cunzai;
        }
        

        
        //当前在线用户id
        public function online_users(){
                $query=$this->select("users", "user_id", " is_online = 1");
		while($info = $this->fetch_array($query)){
                    $online_users[]=$info['user_id'];
		}
                return $online_users;
        }
        
        //当前应读取赔率的对应用户id
       public function rate_user_id($user_id,$user_power){
        //获取上级以上级别的信息
            if($user_power==1 || $user_power==2 || $user_id==1){
                $u_id=1;
            }else{
                $this->get_tops($user_id);
                $user_top=$this->tops;
                $queryusers=  $this->select("users", "is_odds", "user_id={$user_top['branch']['user_id']}");
                $user = $this->fetch_array($queryusers);
                if($user['is_odds']==1){
                    $u_id= $user_top['company']['user_id'];  
                }else{
                    $u_id= $user_top['branch']['user_id'];  
                }
            }
            return $u_id;
       }
       
       //返回分公司和公司赔率，当无分公司赔率时，返回的为两个公司赔率
       public function back_fg_order_p($u_id,$user_power,$o_type,$o_type3_i,$abcd_h='A'){
           if($abcd_h!='A'){
            $tiaojian_pan=$this->get_abcd_o_typename($o_type,$o_type3_i);
            $onlyabcds= $this->select("abcd_rate", "*", "$tiaojian_pan");
            $onlyabcd = $this->fetch_array($onlyabcds);
            $abcd_rate=0;
            if($abcd_h=="B"){
               $abcd_rate=$onlyabcd['ab_rate']; 
            }elseif($abcd_h=="C"){
               $abcd_rate=$onlyabcd['ac_rate'];   
            }elseif($abcd_h=="D"){
               $abcd_rate=$onlyabcd['ad_rate']; 
            }
           } 
            $o_typemin3=explode(',', $o_type3_i);
            $fly_rate_user_id=$this->rate_user_id($u_id,100);
            if($o_type==33){   //连码特殊处理    二中特
                $rate=$this->get_rate(69,$fly_rate_user_id);//赔率大的
                $rate2=$this->get_rate(70,$fly_rate_user_id);
                $rate3=$this->get_rate(69,1);//赔率大的
                $rate4=$this->get_rate(70,1);
            }elseif($o_type==36){ //            三中二
                $rate=$this->get_rate(71,$fly_rate_user_id);//赔率大的
                $rate2=$this->get_rate(72,$fly_rate_user_id);
                $rate3=$this->get_rate(71,1);//赔率大的
                $rate4=$this->get_rate(72,1);
            }elseif($o_type==15){ //   过关
                $rate=$this->get_rate(63,$fly_rate_user_id);
                $rate2=$this->get_rate(64,$fly_rate_user_id);
                $rate3=$this->get_rate(65,$fly_rate_user_id);
                $rate4=$this->get_rate(66,$fly_rate_user_id);
                $rate5=$this->get_rate(67,$fly_rate_user_id);
                $rate6=$this->get_rate(68,$fly_rate_user_id);  
                $rate7=$this->get_rate(63,1);
                $rate8=$this->get_rate(64,1);
                $rate9=$this->get_rate(65,1);
                $rate10=$this->get_rate(66,1);
                $rate11=$this->get_rate(67,1);
                $rate12=$this->get_rate(68,1);
            }else{
                $rate_fly=$this->get_rate($o_type,$fly_rate_user_id);
                $rate=$this->get_rate($o_type,1);
            }
            
           if($o_type==15){
                        //$ty3="正码1-单@1.7<br>正码2-双@1.8<br>正码3-大@1.9<br>正码4-小@1.9<br>正码5-大@1.9<br>正码6-双@1.9<br>";
                        $iscunzai3=explode('<br>',trim($o_type3_i,'<br>'));
                        foreach ($iscunzai3 as $icz3){
                            $i3s=explode('@',$icz3);
                            foreach ($i3s as $i3){
                                $ijia=$i3s[0];
                            }
                            $ijia2[$iii].=$ijia.',';
                        }
                        $iscz=explode(',', trim($ijia2[$iii],','));
                        foreach ($iscz as $iz){
                            $iz_arr=explode('-',$iz);
                            $zm123456[]=$iz_arr[0]; //正码123456类型
                            $dsdx[]=$iz_arr[1];     //单双大小
                        }
                        $rate_v123456=1;
                        $rate_v789101112=1;
                        foreach ($zm123456 as $zk=> $z123456){
                            
                            if($z123456=='正码1'){
                                $rate123456=$rate;
                                $rate789101112=$rate7;
                            }elseif($z123456=='正码2'){
                                $rate123456=$rate2;
                                $rate789101112=$rate8;
                            }elseif($z123456=='正码3'){
                                $rate123456=$rate3;
                                $rate789101112=$rate9;
                            }elseif($z123456=='正码4'){
                                $rate123456=$rate4;
                                $rate789101112=$rate10;
                            }elseif($z123456=='正码5'){
                                $rate123456=$rate5;
                                $rate789101112=$rate11;
                            }elseif($z123456=='正码6'){   
                                $rate123456=$rate6;
                                $rate789101112=$rate12;
                            }
                            $rate_v123456*=$rate123456[$dsdx[$zk]][1]-$abcd_rate;
                            $rate_v789101112*=$rate789101112[$dsdx[$zk]][1]-$abcd_rate;
                        }
           }else{
           foreach ($o_typemin3 as $k=>$mi) {
                  if($o_type==33 || $o_type==36){
                   $rate_v1=$rate[$mi][1]-$abcd_rate;
                   $rate_p_company1[]=$rate_v1;
                   $rate_v2=$rate2[$mi][1]-$abcd_rate;
                   $rate_p_company2[]=$rate_v2;  
                   $rate_v3=$rate3[$mi][1]-$abcd_rate;
                   $rate_p_company3[]=$rate_v3;  
                   $rate_v4=$rate4[$mi][1]-$abcd_rate;
                   $rate_p_company4[]=$rate_v4; 
                  }else{
                   $rate_fv=$rate_fly[$mi][1]-$abcd_rate;
                   $rate_p_fly[]=$rate_fv; 
                   
                   $rate_v=$rate[$mi][1]-$abcd_rate;
                   $rate_p_company[]=$rate_v;                  
                  }
           }
           }
           
           
           if($o_type==33 || $o_type==36){
            $orders_p_company1=min($rate_p_company1); 
            $orders_p_company2=min($rate_p_company2);
            $orders_p_company3=min($rate_p_company3);
            $orders_p_company4=min($rate_p_company4);
            $orders_p_f=$orders_p_company1.'|'.$orders_p_company2;//分公司 大赔率和小赔率
            $orders_p_company=$orders_p_company3.'|'.$orders_p_company4;
           }elseif($o_type==15){ 
            $orders_p_f=$rate_v123456; 
            $orders_p_company=$rate_v789101112;   
           }else{
            $orders_p_f=min($rate_p_fly); 
            $orders_p_company=min($rate_p_company);    
           }
           if($user_power==2){
               $xianshi_p=$orders_p_company;
               $duqu_p=$orders_p_f;
           }elseif($user_power>2){
               $xianshi_p=$orders_p_f;
               $duqu_p=$orders_p_f;
           }else{
               $xianshi_p=$orders_p_company;
               $duqu_p=$orders_p_company;
           }
           return array($xianshi_p,$duqu_p); //显示和单补时读取的赔率         
       } 
       
       //子账户，返回对应的主属用户id
       public function sub_account($user_id){
           if($user_id>0){
                $queryusers=  $this->select("users", "is_extend", "user_id={$user_id}");
                $user = $this->fetch_array($queryusers);
                if($user['is_extend']>0){
                    $u_id= $user['is_extend']; 
                    $is_z=1;
                }else{
                    $u_id= $user_id;  
                    $is_z=0;
                }
            return array($u_id,$user_id,$is_z);
           }
       }
       
//       public function get_synchro_rate($user_id,$o_id,$t3,$plate_num){
//            $y =  $this->select("odds_set", "o_content","plate_num=$plate_num and o_id={$o_id} and user_id={$user_id} order by user_id asc");
//            while($row= $this->fetch_array($y)) {
//            $content_arr[]=$row['o_content'];
//             }
//
//            foreach ($content_arr as $ct){
//            $tos_arr = explode(',', trim($ct,','));
//               foreach ($tos_arr as $to){
//                   $o_arr = explode(':', $to);
//                   if($o_arr[0]==$t3){
//                       $view_odd=$o_arr[1];
//                   }
//               }
//            }
//                $str="<input type='hidden' value='$view_odd' id='new_rate$t3' />";
//                $str=iconv("gbk", "utf-8", $str);
//                echo $str;
//            exit;
//        }
       
//       public function synchro_rate($user_id,$oid,$plate_num,$o_content) {
//            $y =  $this->select("odds_set", "o_content","user_id=$user_id and plate_num=$plate_num and o_id={$oid} limit 0,1");
//            $yy= $this->fetch_array($y);
//            $tos_arr = explode(',', trim($yy['o_content'],','));
//            $mys_arr = explode(',', trim($o_content,','));
//               foreach ($tos_arr as $to){
//                   $o_arr = explode(':', $to);
//                       $o1[]=$o_arr[1];
//               }
//               foreach ($mys_arr as $my){
//                   $m_arr = explode(':', $my);
//                       $m1[]=$m_arr[1];
//                       $m2[]=$m_arr[2];
//               }
//               
//               $countarr=count($o1);
//               for ($i = 0; $i < $countarr; $i++) {
////                   if($m1[$i]>$o1[$i]){ //旧的是否大于最新的，是即用最新的
////                      $over_r[]=$o1[$i];
////                   }else{
//                      $over_r[]=$m1[$i]; 
//               //    }
//                   $col_r[]=$m2[$i]; 
//               }
//               
//               foreach ($tos_arr as $to){
//                   $o_arr = explode(':', $to);
//                           $mo0[]=$o_arr[0];
//                           //$mo1[]=$o_arr[1];
//                           //$mo2[]=$o_arr[2];
//                           $mo3[]=$o_arr[3];
//               }
//               for ($j = 0; $j < $countarr; $j++) {
//                   $to=$mo0[$j].':'.$over_r[$j].':'.$col_r[$j].':'.$mo3[$j];
//                   $toi.=$to.',';
//               }
//               $o_con=','.trim($toi, ',').',';    
//               return $o_con;
//        }
       
       //判断是否封号
       public function is_fenghao($o_type,$u_id,$o_type3,$orders_y,$url=''){          
            if($o_type==33){   //连码特殊处理    二中特
                $rate=$this->get_rate(69,$u_id);//赔率大的
                $rate2=$this->get_rate(70,$u_id);
                $rate3=$this->get_rate(69,1);//赔率大的
                $rate4=$this->get_rate(70,1);
            }elseif($o_type==36){ //            三中二
                $rate=$this->get_rate(71,$u_id);//赔率大的
                $rate2=$this->get_rate(72,$u_id);
                $rate3=$this->get_rate(71,1);//赔率大的
                $rate4=$this->get_rate(72,1);
            }elseif($o_type==15){ //   过关
                $rate=$this->get_rate(63,$u_id);
                $rate2=$this->get_rate(64,$u_id);
                $rate3=$this->get_rate(65,$u_id);
                $rate4=$this->get_rate(66,$u_id);
                $rate5=$this->get_rate(67,$u_id);
                $rate6=$this->get_rate(68,$u_id);
                $rate7=$this->get_rate(63,1);
                $rate8=$this->get_rate(64,1);
                $rate9=$this->get_rate(65,1);
                $rate10=$this->get_rate(66,1);
                $rate11=$this->get_rate(67,1);
                $rate12=$this->get_rate(68,1); 
            }else{
                $rate=$this->get_rate($o_type,$u_id);
                $rate2=$this->get_rate($o_type,1);
            }
            foreach ($o_type3 as $i => $v) {
                if($orders_y[$i]>0){
                    if($o_type==15){
                        //$ty3="正码1-单@1.7<br>正码2-双@1.8<br>正码3-大@1.9<br>正码4-小@1.9<br>正码5-大@1.9<br>正码6-双@1.9<br>";
                        $iscunzai3=explode('<br>',trim($o_type3[$i],'<br>'));
                        foreach ($iscunzai3 as $icz3){
                            $i3s=explode('@',$icz3);
                            foreach ($i3s as $i3){
                                $ijia=$i3s[0];
                            }
                            $ijia2[$iii].=$ijia.',';
                        }
                        $iscz=explode(',', trim($ijia2[$iii],','));
                        foreach ($iscz as $iz){
                            $iz_arr=explode('-',$iz);
                            $zm123456[]=$iz_arr[0]; //正码123456类型
                            $dsdx[]=$iz_arr[1];     //单双大小
                        }
                        foreach ($zm123456 as $zk=> $z123456){                           
                            if($z123456=='正码1'){
                                $rate123456=$rate;
                                $rate789101112=$rate7;
                            }elseif($z123456=='正码2'){
                                $rate123456=$rate2;
                                $rate789101112=$rate8;
                            }elseif($z123456=='正码3'){
                                $rate123456=$rate3;
                                $rate789101112=$rate9;
                            }elseif($z123456=='正码4'){
                                $rate123456=$rate4;
                                $rate789101112=$rate10;
                            }elseif($z123456=='正码5'){
                                $rate123456=$rate5;
                                $rate789101112=$rate11;
                            }elseif($z123456=='正码6'){   
                                $rate123456=$rate6;
                                $rate789101112=$rate12;
                            }
                            if($rate123456[$dsdx[$zk]][2] || $rate789101112[$dsdx[$zk]][2]){
                                $gb.=$z123456.'-'.$dsdx[$zk].',';
                            }
//                            if($rate789101112[$dsdx[$zk]][2]){
//                                $gb.=$z123456.'-'.$dsdx[$zk].',';
//                            }
                        }
                        $gbs=trim($gb,',');
                    }else if($o_type==33 || $o_type==36){
                        $o_typemin3=explode(',', $o_type3[$i]);
                        foreach ($o_typemin3 as $k=>$mi) {
                            $rate_v1=$rate[$mi][2];
                            $rate_v2=$rate2[$mi][2]; 
                            $rate_v3=$rate3[$mi][2];
                            $rate_v4=$rate4[$mi][2]; 
                            if($rate_v1 || $rate_v2 || $rate_v3 || $rate_v4){
                               $gb.=$mi.','; 
                            }
//                            if($rate_v3 || $rate_v4){
//                               $gb.=$mi.','; 
//                            }
                        }
                        $gbs=trim($gb,',');
                    }else{
                        $o_typemin3=explode(',', $o_type3[$i]);
                        foreach ($o_typemin3 as $k=>$mi) {
                           $rate_v=$rate[$mi][2]; 
                           $rate_v2=$rate2[$mi][2];
                            if($rate_v || $rate_v2){
                               $gb.=$mi.','; 
                            }
//                            if($rate_v2){
//                               $gb.=$mi.','; 
//                            }
                        }
                        $gbs=trim($gb,',');
                    }
                        $cz=explode(',', $gbs);
                        $czs_arrs=array_flip(array_flip($cz));//删除重复
                        $gbs=implode(',',$czs_arrs);
                }
            }
           // $cz=explode(',', $gbs);
            if(!empty($gbs)){
                $ag="对不起,[$gbs]暂停下注.请返回重新选择！";
                if(empty($url)){$url=$_SERVER['HTTP_REFERER'];}
                echo " <script> alert( '$ag') ;window.location.href= '$url';</script> " ;  exit();   
            }
       }     
       
       //用cookies来再次保存seesion值，由于seesion在不稳定
       public function seesion_save_time_set($user_id,$z_user_id,$power,$username){
           if($user_id){
//                $zs_a= $this->select("admin_users_action", "datetime","uid={$user_id} order by datetime desc limit 0,1");
//                $za= $this->fetch_array($zs_a);
//                if(($za['datetime']+600)< time()){ //10分钟重复保存一次seesion
                  	$_SESSION['uid'.$this->c_p_seesion()] = $user_id;
			$_SESSION['username'.$this->c_p_seesion()] = $username;
			$_SESSION['z_uid'.$this->c_p_seesion()] = $z_user_id;
                        $_SESSION['user_power'.$this->c_p_seesion()]=$power;
//                }
           }
       }
       
       //特码降赔
       public function update_tm_odd_down($plate_num,$down_pei) {   
                $adminn = $this->select("odds_set", "user_id", "o_id=16 and user_id>0 and plate_num='$plate_num'");
                 while($adminm = $this->fetch_array($adminn)){  
                   $uu_arrs[]=$adminm['user_id'];
                 }   
                 $s1617s = explode(",", '16,17');
                 foreach ($uu_arrs as $uu){ 
                     foreach ($s1617s as $s1617){ 
                     $a1617s = $this->select("odds_set", "o_content", "o_id=$s1617 and user_id=$uu and plate_num='$plate_num'");
                     $a1617 = $this->fetch_array($a1617s);
                     $mm = $a1617['o_content'];

                        $mp = explode(",", substr($mm, 1, -1));
                           foreach ($mp as $mo){
                               $mo_arr = explode(':', $mo);
                               if(is_numeric($mo_arr[0])){
                                   $mo_arr1=$mo_arr[1]-$down_pei;
                                   if($mo_arr1<0){
                                      $mo_arr1=0; 
                                   }
                               }else{
                                   $mo_arr1=$mo_arr[1];
                               }
                               $mpo=$mo_arr[0].':'.$mo_arr1.':'.$mo_arr[2].':'.$mo_arr[3];
                               $mpoi.=$mpo.',';
                           }            
                           $mp_content=','.trim($mpoi, ',').',';

                        $this->update("odds_set", "o_content='{$mp_content}'", "o_id={$s1617} and user_id=$uu and plate_num='$plate_num'"); 

                        unset($mpo);
                        unset($mpoi);
                        unset($mp_content);
                
                     }
                 }            
        }
        
        //滚球封盘
        public function gunqiufengpan(){
              $dqqs=$this->dangqianqishu_arr();//当前期数相关信息
              //$dqqs['last_special'];//开完第几个正码后全部封盘
              $feng_te=0;
              $feng_other=0;
              if($dqqs['open_num']>=$dqqs['last_special']){
                  $feng_te=1;
              }
              if($dqqs['num_a']>0){  //这里设置开出第一个正码后，除了特码，其他下注类型统一封盘 
                  $feng_other=1;
              }
              
              return array($feng_te,$feng_other);
        }
        
        //过关下注时最新的信息,返回类型3和赔率
        public function guoguannew($u_id,$o_type3_i,$abcd_h){
                        //$ty3="正码1-单@1.7<br>正码2-双@1.8<br>正码3-大@1.9<br>正码4-小@1.9<br>正码5-大@1.9<br>正码6-双@1.9<br>";
            $tiaojian_pan=$this->get_abcd_o_typename(15,$o_type3_i);
            $onlyabcds= $this->select("abcd_rate", "*", "$tiaojian_pan");
            $onlyabcd = $this->fetch_array($onlyabcds);
            $abcd_rate=0;
            if($abcd_h=="B"){
               $abcd_rate=$onlyabcd['ab_rate']; 
            }elseif($abcd_h=="C"){
               $abcd_rate=$onlyabcd['ac_rate'];   
            }elseif($abcd_h=="D"){
               $abcd_rate=$onlyabcd['ad_rate']; 
            }
                $rate=$this->get_rate(63,$u_id);
                $rate2=$this->get_rate(64,$u_id);
                $rate3=$this->get_rate(65,$u_id);
                $rate4=$this->get_rate(66,$u_id);
                $rate5=$this->get_rate(67,$u_id);
                $rate6=$this->get_rate(68,$u_id);
                        $iscunzai3=explode('<br>',trim($o_type3_i,'<br>'));
                        foreach ($iscunzai3 as $icz3){
                            $i3s=explode('@',$icz3);
                            foreach ($i3s as $i3){
                                $ijia=$i3s[0];
                            }
                            $ijia2[$iii].=$ijia.',';
                        }
                        $iscz=explode(',', trim($ijia2[$iii],','));
                        foreach ($iscz as $iz){
                            $iz_arr=explode('-',$iz);
                            $zm123456[]=$iz_arr[0]; //正码123456类型
                            $dsdx[]=$iz_arr[1];     //单双大小
                        }
                        $rate_v123456=1;
                        foreach ($zm123456 as $zk=> $z123456){
                            
                            if($z123456=='正码1'){
                                $rate123456=$rate;
                            }elseif($z123456=='正码2'){
                                $rate123456=$rate2;
                            }elseif($z123456=='正码3'){
                                $rate123456=$rate3;
                            }elseif($z123456=='正码4'){
                                $rate123456=$rate4;
                            }elseif($z123456=='正码5'){
                                $rate123456=$rate5;
                            }elseif($z123456=='正码6'){   
                                $rate123456=$rate6;
                            }
                            $dp=$rate123456[$dsdx[$zk]][1]-$abcd_rate;
                            $new_t3.=$z123456.'-'.$dsdx[$zk].'@'.$dp.'<br>';//正码1-单@1.7<br>正码2-双@1.8<br>
                            $rate_v123456*=$dp; //最终的赔率值
                        }
                        return array($new_t3,$rate_v123456);
        }
        
        //修改单个类型赔率时同步更新下级赔率，不能大于公司赔率
        public function company_only_odds($oid,$plate_num,$t3) {
            $y =  $this->select("odds_set", "o_content","user_id=1 and plate_num=$plate_num and o_id={$oid} limit 0,1");
            $yy= $this->fetch_array($y);
            $tos_arr = explode(',', trim($yy['o_content'], ','));
              foreach ($tos_arr as $to){
                   $o_arr = explode(':', $to);
                       if("$t3"==$o_arr[0]){
                       $o1=$o_arr[1];
                       }
              }
              return $o1;//返回某个赔率值
        }
        
        //系统设置
        public function system_setting() {
             $query=$this->select("animal_set");
             $row=$this->fetch_array($query);
             return $row;
        }
        
        //开奖采集 
        public function preg_substr($start, $end, $str) // 正则截取函数      
        {      
            $temp = preg_split($start, $str);      
            $content = preg_split($end, $temp[1]);      
            return $content[0];      
        }   
        
        public function str_substr($start, $end, $str) // 字符串截取函数      
        {      
            $temp = explode($start, $str, 2);      
            $content = explode($end, $temp[1], 2);      
            return $content[0];      
        }   
        
        //采集网站数据
        public function kaijiangcaiji() // 开奖号码采集      
        {
            $haoma=array();
         // ---------------- 使用实例 ----------------   
            $str = iconv("gbk", "GB2312", file_get_contents("http://www.237238.com/bm/bm.asp"));    
            $qishu=$this->str_substr('<p align="center">', "期：六合彩开奖结果", $str);
            $zhengma=$this->str_substr('六合彩开奖结果：&nbsp;&nbsp;<font color="#0000FF" size="+1"><b>', "&nbsp;&nbsp;</b></font>", $str);   
            //echo ('作者: ' . $db->preg_substr("/userid=\d+\">/", "/<\//", $str)); // 通过正则提取作者   
            $tema=$this->str_substr('特码：&nbsp;&nbsp;<font color="#FF0000" size="+1"><b>', '</b></font></p>', $str);            
            $zhengma_arr=explode('&nbsp;&nbsp;',$zhengma);
            $haoma[0]=date('Y').$qishu;
            $haoma[1]=$zhengma_arr[0];
            $haoma[2]=$zhengma_arr[1];
            $haoma[3]=$zhengma_arr[2];
            $haoma[4]=$zhengma_arr[3];
            $haoma[5]=$zhengma_arr[4];
            $haoma[6]=$zhengma_arr[5];
            $haoma[7]=$tema;
            
            //保存采集信息
            $kaijiangs= $this->select("caijikaijiang", "id","plate_num='{$haoma[0]}' limit 0,1");
            $kaijiang= $this->fetch_array($kaijiangs);
            if(empty($kaijiang['id']) && $haoma[7]>0){
                              $this->query("INSERT INTO `caijikaijiang` (`num_a`,`num_b`,`num_c`,`num_d`,`num_e`,`num_f`,`num_g`,`plate_num`) " .
                                    "VALUES ('{$haoma[1]}', '{$haoma[2]}', '{$haoma[3]}', '{$haoma[4]}', '{$haoma[5]}', '{$haoma[6]}', '{$haoma[7]}', '{$haoma[0]}')");  
            }
            return $haoma;
        }
        
        
       
        
        //可開會員個數
        public function kekaihuiyuanshu($power){
              $animal_set=$this->select("animal_set", "*", "1 order by id desc limit 1");
              $row=$this->fetch_array($animal_set);   
              if($power==2){
                  $user_total=$row['w_user_total2'];
              }elseif($power==3){
                  $user_total=$row['w_user_total3'];
              }elseif($power==4){
                  $user_total=$row['w_user_total4'];
              }elseif($power==5){    
                  $user_total=$row['w_user_total5'];
              }
              return $user_total;
        }
        
        //該用戶可開會員數
        public function gaihuiyuankekaihuiyuanshu($user_id){ 
            $row['user_total']=0;
            if($user_id){
              $user=$this->select("users", "user_total", "user_id=$user_id limit 0,1");
              $row=$this->fetch_array($user);         
            }
            return $row['user_total'];
        }

        /*
		 * 根据条件查询数据表，并返回所查到的所有记录
		 * @param string $sql 查询语句
		 * @return array $data 所查到的所有记录
		 */
		public function get_all($sql=''){
			$res=mysql_query($sql,$this->conn);
			$data=array();
			if($res && mysql_num_rows($res)){
				while($arr=mysql_fetch_assoc($res)){
					$data[]=$arr;
				}
			}
			return $data;
		}
		/*
		 * 根据条件查询数据表，并返回所查到的一条记录
		 * @param string $sql 查询语句
		 * @return array $data 所查到的一条记录
		 */
		function get_one($sql){
			$result=mysql_query($sql,$this->conn);
			$data=array();
			if($result && mysql_num_rows($result)>0){
				$data=mysql_fetch_assoc($result);
			}	
			return $data;
		}
		/*
		 * 向数据表插入记录，并返回刚插入的记录的id
		 * @param string $table 数据表名
		 * @param array $fields 要插入的数据（写成array形式，每个key都必须是数据表的字段）
		 * @return int 新记录的id
		 */
		function get_insert($table,$fields){
			$k = '`' . implode('`,`', array_keys($fields)) . '`';
			$v = "'" . implode("','", $fields) . "'";
			
			$sql = "INSERT INTO `$table` ({$k}) VALUES ({$v})";
//            print_r($sql);
			mysql_query($sql,$this->conn);
			return mysql_insert_id($this->conn);
		}
		/**
		 * 向数据表更新一些记录，并返回所影响的记录行数
		 * @param string $table 数据表名
		 * @param array $fields 要更新的数据（写成array形式，每个key都必须是数据表的字段）
		 * @param string $where 查询条件
		 * @return int 所影响的记录行数
		 */
		function get_update($table, $fields, $where = 0){
			$str='';
			foreach($fields as $k=>$v){
				$str .= "$k='$v',";	
			}
			$str = rtrim($str, ',');
			$sql = "UPDATE $table SET $str  WHERE $where";
			mysql_query($sql,$this->conn);
			return mysql_affected_rows($this->conn);
		}
}
?>