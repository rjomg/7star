<?php
include_once('../global.php');

date_default_timezone_set('PRC');
error_reporting(0);
 $power=$_GET['power'];
 
 
 $page=$_GET['page'];
 if(!$page){
     $page=1;
 }
 $start=($page-1)*10;
 $get_user_limit=$_GET['get_user_limit'];
 $t1=$_GET['t1'];
 $t2=$_GET['t2'];
 

 $db = new action($mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset); //数据库操作类.
 $online_users=$db->online_users();//在线用户id 
// $user_limit=$db->get_user_limit_char($get_user_limit, $t1, $t2);
// 
// if($user_limit){
//     $all_page=$db->get_page("users", '`user_power` = \'' . $power . '\' and '.$user_limit, 10);
//     $query=$db->select('users', '*', '`user_power` = \'' . $power . '\' and '.$user_limit.' limit '.$start.',10');
// }else{
//     $all_page=$db->get_page("users", '`user_power` = \'' . $power . '\'', 10);
//     $query=$db->select('users', '*', '`user_power` = \'' . $power . '\' limit '.$start.',10');
// }
// 
 $user_char=$db->get_user_power_char($power);
 
echo $_GET['cot'];
echo $_GET['cuser'];
echo $_GET['lx'];
echo $user_id;
//$query=$db->select("users", "*", " is_online = 1 order by else_last_login desc");

//  $sql = "select  user_id,user_power,count(*) AS num_rows from users  where is_online = 1   and is_extend = 0 and user_power  != 1 group by user_power ";
//   $query = mysql_query($sql);
//     while($info = mysql_fetch_array($query)){
//        // $userzs_arr[]=$info['user_id'];
//                // echo $info['user_power'].$info['num_rows']."<br/>";
//				$info_list[] = array(
//						"user_power" => $info['user_power'],
//						"num_rows" => $info['num_rows']
//						);
//             }
	//print_r($info_list);
	//print_r($userzs_arr);
        //半个钟不操作当做不在线，注销了表示不在线     
        foreach ($online_users as $userzs_a){
            $zs_a= $db->select("admin_users_action", "datetime","uid={$userzs_a} order by datetime desc limit 0,1");
            $za= $db->fetch_array($zs_a);
            if(($za['datetime']+1800)< time()){ //算半个钟
            $db->query("update users set is_online=0 where user_id=$userzs_a" );
            }
        }     
	
	if($_GET['action'] == "selectuser"){
		$key = $_GET['key'];
		$query = "select * from users where   is_online = 1  and  user_name like '%$key%'";
	}elseif($_GET['action'] == "finduser"){
		//echo $_GET['is_extend'].$_GET['user_power'];
		$where = "where is_online = 1 ";
		if($_GET['is_extend']==0){ $where .= " and is_extend  = ".$_GET['is_extend'];}	
		if($_GET['is_extend']==-1){ $where .= "and is_extend != 0";}	
		if($_GET['user_power']){ $where .= " and user_power  = ".$_GET['user_power'];}	
		//echo $where;
		 if($_GET['is_extend']==0 && $_GET['user_power']==0){
			 $query = "select * from users where  is_online = 1 ";
			 }else{
		         $query = "select * from users ". $where;
			 }
	}else{
		
 		$query = "select * from users where  is_online = 1 ";
	}
	
			$result_all = mysql_query($query);
			$total = mysql_num_rows($result_all);
			pageft($total, 10);
			if ($firstcount < 0) $firstcount = 0;
			
			$result = mysql_query("$query order by else_last_login desc limit  $firstcount, $displaypg");
 
 
 	
//判断在线人	
		

?>
<html oncontextmenu="return false" xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
-->
</style>
<script>
if(self == top) {location = '/';} 
if(window.location.host!=top.location.host){top.location=window.location;}</script></head>

<body  onmouseover="self.status='歡迎光臨';return true">
<link href="images/Index.css" rel="stylesheet" type="text/css">
<link href="css/admincg.css" rel="stylesheet" type="text/css">
 <script language="JavaScript">
function send_request(url){//初始化，指定處理函数，發送請求的函数
    http_request=false;
    //開始初始化XMLHttpRequest對象
    if(window.XMLHttpRequest){//Mozilla瀏覽器
     http_request=new XMLHttpRequest();
     if(http_request.overrideMimeType){//設置MIME類別
       http_request.overrideMimeType("text/xml");
     }
    }
    else if(window.ActiveXObject){//IE瀏覽器
     try{
      http_request=new ActiveXObject("Msxml2.XMLHttp");
     }catch(e){
      try{
      http_request=new ActiveXobject("Microsoft.XMLHttp");
      }catch(e){}
     }
    }
    if(!http_request){//異常，創建對象實例失敗
     window.alert("創建XMLHttp對象失敗！");
     return false;
    }
    http_request.onreadystatechange=processrequest;
    //確定發送請求方式，URL，及是否同步執行下段代码
    http_request.open("GET",url,true);
    http_request.send(null);
  }
  //處理返回信息的函数
  function processrequest(){
   if(http_request.readyState==4){//判斷對象狀態
     if(http_request.status==200){//信息已成功返回，開始處理信息
	// alert(http_request.responseText);
	 	if(http_request.responseText == 1){
			
			alert("操作成功!");
			history.go(0);
			}else{
			alert("操作失败!");	
				}
      //document.getElementById(reobj).innerHTML=http_request.responseText;
	
     }
     else{//頁面不正常
      alert("您所請求的頁面不正常！");
     }
   }
  }
  function dopage(obj,url){
	//  alert(obj+url);
 	 document.getElementById(obj).innerHTML="正在讀取数據...";
   send_request(url);
   reobj=obj;
   } 
   


 function C_Key(){
	var key=document.all.key.value;
		
	//dopage('result','?action=selectlog&key='+key+'&page=1');
	location.href='?action=selectuser&key='+key+'&page=1';
	
}

 function send(is_extend , user_power){
	//	alert(is_extend + user_power);
	//dopage('result','?action=selectlog&key='+key+'&page=1');
	location.href='?action=finduser&is_extend='+is_extend+'&user_power='+user_power;
	
}

 function kinckout(id){
		//alert(id);
	dopage('result','system/ajax.php?action=kinckout&id='+id);
	//location.href='?action=finduser&is_extend='+is_extend+'&user_power='+user_power;
	
}
 function logsend(){
	location.href='log_userlogin.php';	
}
</script>

 <style type="text/css">
<!--
.STYLE1 {color: #CCCCCC}
-->
 </style>
 <link href="../css/admincg.css" rel="stylesheet" type="text/css" />
 <table border="0" cellpadding="0" cellspacing="0" width="100%">
  <tbody>
    <tr class="header">
      <td background="css/bg_list.gif" height="30"><table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tbody>
          <tr>
            <td height="30" width="12"><img src="css/bg_list.gif" height="30" width="12"></td>
            <td><table border="0" cellpadding="0" cellspacing="0" width="100%">
              <tbody>
                <tr>
                  <td valign="middle" width="87%"><table border="0" cellpadding="0" cellspacing="0" width="100%">
                    <tbody>
                      <tr>
                        <td width="1%"><div align="center"><img src="images/tb.gif" height="16" width="16"></div></td>
                        <td class="F_bold" width="32%">在線統計</td>
                        <td class="F_bold" width="60%">用戶查詢
                          <input name="key" class="input1" onBlur="return C_Key();"  type="text"></td>
                        <td class="F_bold" width="8%"><button class="button_a" onClick="javascript:logsend();">最近在线用户</button></td>  
                          
                      </tr>
                    </tbody>
                  </table></td>
                  </tr>
              </tbody>
            </table></td>
            <td width="16"><img src="css/bg_list.gif" height="30" width="16"></td>
          </tr>
        </tbody>
      </table></td>
    </tr>
    <tr>
      <td><table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tbody>
          <tr>
            <!-- <td background="images/tab_12.gif" width="8">&nbsp;</td> -->
            <td align="center" height="50"><!-- 開始  --><div id="result"><table class="Ball_List Tab" align="center" bgcolor="ffffff" border="0" bordercolor="f1f1f1" cellpadding="1" cellspacing="1" width="100%">
                          <tbody><tr>
                            <td colspan="6" bordercolor="cccccc" align="center" background="css/bg.gif" bgcolor="#DFEFFF" height="28">&nbsp;&nbsp;&nbsp;
   <button class="<?php if($_GET['is_extend']==0 && $_GET['user_power']==1) echo  'button_a1';else echo 'button_a';?>" onClick="javascript:send('0','1');">
   公司[<font color="ff0000"><?php 
   $to1 = mysql_num_rows(mysql_query("select * from users  where is_online = 1   and is_extend = 0 and user_power=1"));	
    echo $to1==0?0:$to1;
   ?></font>]
   </button>
&nbsp;&nbsp;&nbsp;
   <button class="<?php if($_GET['is_extend']==0 && $_GET['user_power']==2) echo  'button_a1';else echo 'button_a';?>" onClick="javascript:send('0','2');">
   分公司[<font color="ff0000"><?php 
   $to1 = mysql_num_rows(mysql_query("select * from users  where is_online = 1   and is_extend = 0 and user_power=2"));	
    echo $to1==0?0:$to1;
   ?></font>]
   </button>
&nbsp;&nbsp;&nbsp;<button class="<?php if($_GET['is_extend']==0 && $_GET['user_power']==3) echo  'button_a1';else echo 'button_a';?>" onClick="javascript:send('0','3');">
股東[<font color="ff0000"><?php 
$to1 = mysql_num_rows(mysql_query("select * from users  where is_online = 1   and is_extend = 0 and user_power=3"));	
    echo $to1==0?0:$to1;
?></font>]
</button>
&nbsp;&nbsp;&nbsp;
<button class="<?php if($_GET['is_extend']==0 && $_GET['user_power']==4) echo  'button_a1';else echo 'button_a';?>"onClick="javascript:send('0','4');">
&nbsp;總代理[<font color="ff0000"><?php
$to1 = mysql_num_rows(mysql_query("select * from users  where is_online = 1   and is_extend = 0 and user_power=4"));	
    echo $to1==0?0:$to1;
?></font>]
</button>
&nbsp;&nbsp;&nbsp;
<button class="<?php if($_GET['is_extend']==0 && $_GET['user_power']==5) echo  'button_a1';else echo 'button_a';?>" onClick="javascript:send('0','5');">
&nbsp;代理[<font color="ff0000"><?php 
$to1 = mysql_num_rows(mysql_query("select * from users  where is_online = 1   and is_extend = 0 and user_power=5"));	
    echo $to1==0?0:$to1;
 ?></font>]
</button>
&nbsp;&nbsp;&nbsp;
<button class="<?php if($_GET['is_extend']==0 && $_GET['user_power']==6) echo  'button_a1';else echo 'button_a';?>" onClick="javascript:send('0','6');">
&nbsp;會員[<font color="ff0000"><?php
$to1 = mysql_num_rows(mysql_query("select * from users  where is_online = 1   and is_extend = 0 and user_power=6"));	
    echo $to1==0?0:$to1;
 ?></font>]
</button>
&nbsp;&nbsp;&nbsp;
<button class="<?php if($_GET['is_extend']==-1 && $_GET['user_power']==1) echo  'button_a1';else echo 'button_a';?>" onClick="javascript:send('-1','1');">
&nbsp;公司子賬號[<font color="ff0000"><?PHP
  $to1 = mysql_num_rows(mysql_query("select * from users  where is_online = 1   and is_extend != 0 and user_power=1"));	
    echo $to1==0?0:$to1;
?></font>]
</button>
&nbsp;&nbsp;&nbsp;
<button class="<?php if($_GET['is_extend']==-1 && $_GET['user_power']==2) echo  'button_a1';else echo 'button_a';?>" onClick="javascript:send('-1','2');">
&nbsp;分公司子賬號[<font color="ff0000"><?PHP
  $to1 = mysql_num_rows(mysql_query("select * from users  where is_online = 1   and is_extend != 0 and user_power=2"));	
    echo $to1==0?0:$to1;
?></font>]
</button>
&nbsp;&nbsp;&nbsp;
<button class="<?php if($_GET['is_extend']==-1 && $_GET['user_power']==3) echo  'button_a1';else echo 'button_a';?>" onClick="javascript:send('-1','3');">
&nbsp;股東子賬號[<font color="ff0000"><?PHP
  $to1 = mysql_num_rows(mysql_query("select * from users  where is_online = 1   and is_extend != 0 and user_power=3"));	
    echo $to1==0?0:$to1;
?></font>]
</button>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<button class="<?php if($_GET['is_extend']==-1 && $_GET['user_power']==4) echo  'button_a1';else echo 'button_a';?>" onClick="javascript:send('-1','4');">
總代子賬號[<font color="ff0000"><?PHP
  $to1 = mysql_num_rows(mysql_query("select * from users  where is_online = 1   and is_extend != 0 and user_power=4"));	
    echo $to1==0?0:$to1;
?></font>]
</button>&nbsp;&nbsp;&nbsp;
<button class="<?php if($_GET['is_extend']==-1 && $_GET['user_power']==5) echo  'button_a1';else echo 'button_a';?>" onClick="javascript:send('-1','5');">
&nbsp;代理子賬號
[<font color="ff0000"><?PHP
  $to1 = mysql_num_rows(mysql_query("select * from users  where is_online = 1   and is_extend != 0 and user_power=5"));	
    echo $to1==0?0:$to1;
?></font>]
</button>
&nbsp;&nbsp;&nbsp;&nbsp;
<button class="<?php if(empty($_GET['is_extend']) && empty($_GET['user_power'])) echo  'button_a1';else echo 'button_a';?>" onClick="javascript:send('0','0');">
全部[<font color="ff0000"><?php 
   $sql2 = "select * from users  where is_online = 1 ";
 echo  $total = mysql_num_rows(mysql_query($sql2));?></font>]
</button>
&nbsp;&nbsp;&nbsp;
</td>
                          </tr>
                          <tr class="td_caption_1 header">
                            <td bordercolor="cccccc" bgcolor="#DFEFFF"><div align="center">
                                NO
                            </div></td>
                            <td bordercolor="cccccc" bgcolor="#DFEFFF" width="19%"><div align="center">用戶</div></td>
                            <td bordercolor="cccccc" align="center" bgcolor="#DFEFFF" width="19%">用戶IP</td>
                            <td bordercolor="cccccc" align="center" bgcolor="#DFEFFF" nowrap="nowrap" width="19%">所在地</td>
                            <td bordercolor="cccccc" align="center" bgcolor="#DFEFFF" nowrap="nowrap" width="19%">操作時間</td>
                            <td bordercolor="cccccc" align="center" bgcolor="#DFEFFF" width="19%">狀態</td>
                          </tr>
						<?php
						while ($row = mysql_fetch_array($result)) { ?>
                         
                                                    <tr style="background-color: rgb(255, 255, 255);" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor='ffffff'" bgcolor="#FFFFFF">
                            <td bordercolor="cccccc" height="25"><div align="center">
                               <?php echo $row['user_id']; ?>                           </div></td>
                            <td align="center" height="25" width="19%"> <?php echo $row['user_name']; ?></td>
                            <td align="center" height="25" width="19%"><?php 
								$ipsql=  $db->select("admin_users_action", "*", " uid = ".$row['user_id']." and mark= 1 order by id desc limit 1");
								$ip = $db->fetch_array($ipsql);
								
							echo $ip['ip']; ?>  </td>
                            <td align="center" width="19%"> <?php echo $ip['location'];?></td>
                            <td align="center" width="19%">
                                <?php
                                $y= $db->select("admin_users_action", "datetime","uid={$row['user_id']} order by datetime desc limit 0,1");
                                $z= $db->fetch_array($y);
                                //select datetime from admin_users_action where uid=$user_id order by datetime desc
                            echo date("Y-m-d H:i:s", $z['datetime']); 
                            ?></td>
                            <td align="center" height="25" width="19%"> 
                                                        <?php if($row['user_id']!=1){?>
							<button class="button_a"onClick="javascript:kinckout('<?php echo $row['user_id'];?>');">踢出</button>
							<?php }?>	
																
								
								</td>
                          </tr>
                         <?php
						}
					  ?>   
                        <tr>
                       
                            <td colspan="6" bordercolor="cccccc" bgcolor="#FFFFFF" height="25"><div id="fm" align="center">
                             <?php echo $pagenav;?>
                            </td>
                    </tr>
                        
                  </tbody></table>
            
             </div> <!-- 結束  --></td>
            <!-- <td background="images/tab_15.gif" width="8">&nbsp;</td> -->
          </tr>
        </tbody>
      </table></td>
    </tr>
<!--     <tr>
      <td background="images/tab_19.gif" height="35"><table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tbody>
          <tr>
            <td height="35" width="12"><img src="images/tab_18.gif" height="35" width="12"></td>
            <td valign="top"><table border="0" cellpadding="0" cellspacing="0" height="30" width="100%">
              <tbody>
                <tr>
                  <td align="center">&nbsp;</td>
                </tr>
              </tbody>
            </table></td>
            <td width="16"><img src="images/tab_20.gif" height="35" width="16"></td>
          </tr>
        </tbody>
      </table></td>
    </tr> -->
  </tbody>
</table>

</body></html>