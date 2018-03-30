<?php
include_once('../global.php');
error_reporting(0);

 $db = new action($mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset); //数据库操作类.
//$user_limit=$db->get_user_limit_char($get_user_limit, $t1, $t2);
 
// if($user_limit){
//     $all_page=$db->get_page("admin_users_action", $user_limit, 10);
//     $query=$db->select('admin_users_action', '*', $user_limit.' limit '.$start.',10');
// }else{
//     $all_page=$db->get_page("admin_users_action", '1 order by datetime desc  ');
//     $query=$db->select('admin_users_action', '*', '1 order by datetime desc limit '.$start.',10');
// }

 
 
 
 

		
 		$query = "select * from admin_users_action where title='用户登录'";
	
			$result_all = mysql_query($query);
			$total = mysql_num_rows($result_all);
			pageft($total, 10);
			if ($firstcount < 0) $firstcount = 0;
			
			$result = mysql_query("$query order by datetime desc limit  $firstcount, $displaypg");
 
 
 

	
 
 
 
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

<body  onselect="document.selection.empty()"  onmouseover="self.status='歡迎光臨';return true">
<link href="images/Index.css" rel="stylesheet" type="text/css">
 

 <style type="text/css">
<!--
.STYLE1 {color: #CCCCCC}
-->
 </style>

 <table border="0" cellpadding="0" cellspacing="0" width="100%">
  <tbody>
    <tr>
      <td background="images/tab_05.gif" height="30"><table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tbody>
          <tr>
            <td height="30" width="12"><img src="images/tab_03.gif" height="30" width="12"></td>
            <td><table border="0" cellpadding="0" cellspacing="0" width="100%">
              <tbody>
                <tr>
                  <td valign="middle" width="87%"><table border="0" cellpadding="0" cellspacing="0" width="100%">
                    <tbody>
                      <tr>
                        <td width="1%"><div align="center"><img src="images/tb.gif" height="16" width="16"></div></td>
                        <td class="F_bold" width="32%">最近在线人员状况</td>
                        
                      </tr>
                    </tbody>
                  </table></td>
                  </tr>
              </tbody>
            </table></td>
            <td width="16"><img src="images/tab_07.gif" height="30" width="16"></td>
          </tr>
        </tbody>
      </table></td>
    </tr>
    <tr>
      <td><table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tbody>
          <tr>
            <td background="images/tab_12.gif" width="8">&nbsp;</td>
            <td align="center" height="50"><!-- 開始  --><div id="result"><table class="Ball_List Tab" align="center" bgcolor="ffffff" border="0" bordercolor="f1f1f1" cellpadding="1" cellspacing="1" width="99%">
                          <tbody><tr class="td_caption_1">
                            
                            <td bordercolor="cccccc" bgcolor="#DFEFFF" width="150"><div align="center">期数</div></td>
                            <td bordercolor="cccccc" align="center" bgcolor="#DFEFFF" width="150">在线用戶</td>
                            <td bordercolor="cccccc" align="center" bgcolor="#DFEFFF" width="150">用戶身份</td>
                            <td bordercolor="cccccc" bgcolor="#DFEFFF" nowrap="nowrap" ><div align="center">在线時間</div></td>
                          </tr>
						   <?php while($row =mysql_fetch_array($result)){?>    
                         
                                                    <tr style="background-color: rgb(255, 255, 255);" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor='ffffff'" bgcolor="#FFFFFF">
                            
                            <td bordercolor="cccccc" align="center" height="25"><?php echo $row['phases'];?>     </td>
                            <td bordercolor="cccccc" align="center" height="25"><?php 
							$info =  mysql_fetch_array(mysql_query("select user_name,user_power from users where user_id =  ".$row['uid'] ."")); 
                                                        if($info['user_power']==1){
                                                            $shenfen='管理员';
                                                        }elseif($info['user_power']==6){
                                                            $shenfen='会员';
                                                        }elseif($info['user_power']==2){
                                                            $shenfen='分公司';
                                                        }elseif($info['user_power']==3){
                                                            $shenfen='股东';
                                                        }elseif($info['user_power']==4){
                                                            $shenfen='总代理';
                                                        }elseif($info['user_power']==5){    
                                                            $shenfen='代理';
                                                        }
							echo $info['user_name'];?>  </td>
                            <td bordercolor="cccccc" align="center"><?php echo $shenfen;?> </td>
                            <td bordercolor="cccccc" align="center" nowrap="nowrap"><?php echo date("Y-m-d H:i:s" ,$row['datetime']);?> </td>
                          </tr>
                          <?php 
						 
						   }?>      
                         
                       <tr>
                       
                            <td colspan="5" bordercolor="cccccc" bgcolor="#FFFFFF" height="25"><div id="fm" align="center">
                             <?php echo $pagenav;?>

                            
                            </div></td>
                    </tr>
                        
                  </tbody></table>
            
             </div> <!-- 結束  --></td>
            <td background="images/tab_15.gif" width="8">&nbsp;</td>
          </tr>
        </tbody>
      </table></td>
    </tr>
    <tr>
      <td background="images/tab_19.gif" height="35"><table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tbody>
          <tr>
            <td height="35" width="12"><img src="images/tab_18.gif" height="35" width="12"></td>
            <td valign="top"><table border="0" cellpadding="0" cellspacing="0" height="30" width="100%">
              <tbody>
                <tr>
                  <td align="center"><button class="button_a" onClick="javascript:history.back(-1)">返 回</button></td>
                </tr>
              </tbody>
            </table></td>
            <td width="16"><img src="images/tab_20.gif" height="35" width="16"></td>
          </tr>
        </tbody>
      </table></td>
    </tr>
  </tbody>
</table>

</body></html>