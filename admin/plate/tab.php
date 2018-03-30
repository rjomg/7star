<?php
include_once( "../../global.php" );
$db = new action( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
$db2 = new rate( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
if ( $_GET['plate_num'] )
{
		$get_plate_num = "plate_num={$_GET['plate_num']}";
}
else
{
		$get_plate_num = 1;
}
$iss7 = $db->select( "plate", "plate_num", "1 order by plate_num desc " );
$is7 = $db->fetch_array( $iss7 );
if ( $is7['plate_num'] < $_GET['plate_num'] )
{
		$platetable = "plate_autoadd";
}
else
{
		$platetable = "plate";
}
$query = $db->select( "{$platetable}", "*", "{$get_plate_num} order by plate_num desc" );
$row = $db->fetch_array( $query );
$set = $db->select( "animal_set", "set_animal" );
$set_id = $db->fetch_array( $set );
$query2 = $db->select( "plate_autoadd", "*", "plate_num>{$is7['plate_num']} order by plate_num asc" );
$kaijiangs = $db2->select( "caijikaijiang", "*", "plate_num='{$is7['plate_num']}' limit 0,1" );
$kaijiang = $db2->fetch_array( $kaijiangs );
if ( $_GET['del_plate_autoadd_plate_num'] )
{
		$db->delete( "plate_autoadd", "plate_num={$_GET['del_plate_autoadd_plate_num']}", "" );
		$db->get_admin_msgtopnull( "tab.php" );
}

?>
<html oncontextmenu="return false" xmlns="http://www.w3.org/1999/xhtml">
 <head> 
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
  <title>盘口管理</title> 
  <script language="javascript" type="text/javascript" src="../My97DatePicker/WdatePicker.js"></script>
  <link href="../My97DatePicker/skin/WdatePicker.css" rel="stylesheet" type="text/css" /> 
  <link href="../css/admincg.css" rel="stylesheet" type="text/css" /> 
  <script language="javascript" type="text/javascript" src="../js/jquery-1.4.3.min.js"></script> 
  <script language="javascript" type="text/javascript" src="js/normal.js"></script> 
  <link href="../images/commom.css" rel="stylesheet" type="text/css" /> 
  <style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	color:#344b50;
}
.STYLE1 {
	font-size: 12px
}
.STYLE3 {
	font-size: 12px;
	font-weight: bold;
}
.STYLE4 {
	color: #03515d;
	font-size: 12px;
}
-->
</style>
 </head> 
 <body> 
 <!-- 开奖 -->
 <?php if ( !empty( $row ) && !$row['num_g'] ){?>
   <table width="100%" border="0" cellspacing="0" cellpadding="0"> 
   <tbody>
    <tr class="header"> 
     <td height="30" background="../images/tab/tab_05.gif">
      <table width="100%" border="0" cellspacing="0" cellpadding="0"> 
       <tbody>
        <tr> 
         <td width="12" height="30"><img src="../images/tab/tab_03.gif" width="12" height="30" /></td> 
         <td>
          <table width="100%" border="0" cellspacing="0" cellpadding="0"> 
           <tbody>
            <tr> 
             <td width="46%" valign="middle">
              <table width="100%" border="0" cellspacing="0" cellpadding="0"> 
               <tbody>
                <tr> 
                 <td width="5%">
                  <div align="center">
                   <img src="../images/tab/tb.gif" width="16" height="16" />
                  </div></td> 
                 <td width="95%" class="STYLE1"><span class="STYLE3 header">盘口管理</span></td> 
                </tr> 
               </tbody>
              </table></td> 
             <td width="54%">
              <table border="0" align="right" cellpadding="0" cellspacing="0"> 
              </table></td> 
            </tr> 
           </tbody>
          </table>
          </td> 
         <td width="16"><img src="../images/tab/tab_07.gif" width="16" height="30" /></td> 
        </tr> 
       </tbody>
      </table></td> 
    </tr> 
    <tr> 
     <td>
      <table width="100%" border="0" cellspacing="0" cellpadding="0"> 
       <tbody>
        <tr> 
         <td width="8" background="../images/tab/tab_12.gif">&nbsp;</td> 
         <td> 
          <table width="99%" align="center" bordercolor="#b5d6e6" border="1" style="border-collapse: collapse"> 
           <tbody>
            <tr> 
             <!-- <td colspan="5" height="84" bgcolor="#d4e5f4" style="color:#344b50; font-size:12px; text-align:right">开奖号码:</td>  -->
             <td style="text-align:center;"> 
             <div style="width:469px;text-align:center;margin:auto;">
              <form id="form2" method="post" action="plate_num.php"> 
               <input type="hidden" name="animal_set_id" value="<?php echo $set_id['set_animal'];?>" /> 
               <input value="<?php echo $row['plate_num'] ? $row['num_g'] ? $row['plate_num'] + 1 : $row['plate_num'] : "2012001";?>" name="plate_num" type="hidden" /> 
               <table width="60%" align="left" bordercolor="#b5d6e6" border="1" style="border-collapse: collapse"> 
                <tbody>
                 <tr class="header"> 
                  <td class="kj_tr w60">千</td> 
                  <td class="kj_tr w60">百</td> 
                  <td class="kj_tr w60">十</td> 
                  <td class="kj_tr w60">个</td> 
                  <td class="kj_tr w60">球5</td> 
                  <td class="kj_tr w60">球6</td> 
                  <td class="kj_tr w60">球7</td> 
                  <td class="kj_tr w40">操作</td> 
                 </tr> 
                 <tr> 
                  <td class="al" style="line-height:25px;height:25px;"> <select name="num_a" style="width:58px ; "> <option value="0">0</option> <option value="1">1</option> <option value="2">2</option> <option value="3">3</option> <option value="4">4</option> <option value="5">5</option> <option value="6">6</option> <option value="7">7</option> <option value="8">8</option> <option value="9">9</option> </select> </td> 
                  <td class="al" style="line-height:25px;height:25px;"> <select name="num_b" style="width:58px ; "> <option value="0">0</option> <option value="1">1</option> <option value="2">2</option> <option value="3">3</option> <option value="4">4</option> <option value="5">5</option> <option value="6">6</option> <option value="7">7</option> <option value="8">8</option> <option value="9">9</option> </select> </td>
                  <td class="al" style="line-height:25px;height:25px;"> <select name="num_c" style="width:58px ; "> <option value="0">0</option> <option value="1">1</option> <option value="2">2</option> <option value="3">3</option> <option value="4">4</option> <option value="5">5</option> <option value="6">6</option> <option value="7">7</option> <option value="8">8</option> <option value="9">9</option> </select> </td>
                  <td class="al" style="line-height:25px;height:25px;"> <select name="num_d" style="width:58px ; "> <option value="0">0</option> <option value="1">1</option> <option value="2">2</option> <option value="3">3</option> <option value="4">4</option> <option value="5">5</option> <option value="6">6</option> <option value="7">7</option> <option value="8">8</option> <option value="9">9</option> </select> </td>
                  <td class="al" style="line-height:25px;height:25px;"> <select name="num_e" style="width:58px ; "> <option value="0">0</option> <option value="1">1</option> <option value="2">2</option> <option value="3">3</option> <option value="4">4</option> <option value="5">5</option> <option value="6">6</option> <option value="7">7</option> <option value="8">8</option> <option value="9">9</option> </select> </td>
                  <td class="al" style="line-height:25px;height:25px;"> <select name="num_f" style="width:58px ; "> <option value="0">0</option> <option value="1">1</option> <option value="2">2</option> <option value="3">3</option> <option value="4">4</option> <option value="5">5</option> <option value="6">6</option> <option value="7">7</option> <option value="8">8</option> <option value="9">9</option> </select> </td>
                  <td class="al" style="line-height:25px;height:25px;"> <select name="num_g" style="width:58px ; "> <option value="0">0</option> <option value="1">1</option> <option value="2">2</option> <option value="3">3</option> <option value="4">4</option> <option value="5">5</option> <option value="6">6</option> <option value="7">7</option> <option value="8">8</option> <option value="9">9</option> </select> </td>

                  <td class="al"><input type="submit" value="开奖" class="bt" /></td> 
                 </tr> 
                 <tr> 
                  <td colspan="8" class="font_size12 al" style="line-height:25px;">如果还未到开奖，这里数据请保持为0</td> 
                 </tr> 
                </tbody>
               </table> 
              </form> 
              </div>
              </td> 
            </tr> 
           </tbody>
          </table> </td> 
        </tr> 
       </tbody>
      </table> </td> 
     <td width="8" background="../images/tab/tab_15.gif">&nbsp;</td> 
    </tr> 
   </tbody>
  </table>
  <?php }?>
 <!-- 开奖end -->
  <table width="100%" border="0" cellspacing="0" cellpadding="0"> 
   <tbody>
    <tr> 
     <td height="30" background="../images/tab/tab_05.gif">
      <table width="100%" border="0" cellspacing="0" cellpadding="0"> 
       <tbody>
        <tr class="header"> 
         <td width="12" height="30"><img src="../images/tab/tab_03.gif" width="12" height="30" /></td> 
         <td>
          <table width="100%" border="0" cellspacing="0" cellpadding="0"> 
           <tbody>
            <tr> 
             <td width="46%" valign="middle">
              <table width="100%" border="0" cellspacing="0" cellpadding="0"> 
               <tbody>
                <tr> 
                 <td width="5%">
                  <div align="center">
                   <img src="../images/tab/tb.gif" width="16" height="16" />
                  </div></td> 
                 <td width="95%" class="STYLE1"><span class="STYLE3">盘口管理</span></td> 
                </tr> 
               </tbody>
              </table></td> 
             <td width="54%">
              <table border="0" align="right" cellpadding="0" cellspacing="0"> 
              </table></td> 
            </tr> 
           </tbody>
          </table></td> 
         <td width="16"><img src="../images/tab/tab_07.gif" width="16" height="30" /></td> 
        </tr> 
       </tbody>
      </table></td> 
    </tr>
    <tr> 
     <td>
      <table width="100%" border="0" cellspacing="0" cellpadding="0"> 
       <tbody>
        <tr> 
         <td width="8" background="../images/tab/tab_12.gif">&nbsp;</td> 
         <td> <input type="hidden" name="animal_set_id" value="<?php echo $set_id['set_animal'];?>" /><input type="hidden" id="is_plate_start" value="1" />
          <table width="99%" align="center" bordercolor="#b5d6e6" border="1" style="border-collapse: collapse"> 
           <form id="form1" action="add_plate.php" method="post"> 
           <input type="hidden" name="animal_set_id" value="<?php echo $set_id['set_animal'];?>" /> 
           <!--    <input type="hidden" name="ty" value="1" />--> 
           <tbody>
            <tr> 
             <td colspan="4" style="height:25px;" align="center" class="font_size12">盘口设置</td> 
            </tr> 
            <tr>
             <th></th> 
            </tr>
            <tr> 
             <td class="bg_color font_size12 rightside">期数:</td> 
             <td><input value="<?php echo $row['plate_num'] ? $row['num_g'] ? $row['plate_num'] + 1 : $row['plate_num'] : date( "Y" )."001";?>" name="plate_num" id="qs" type="text" class="shot_input" /></td> 
             <td class="bg_color font_size12 rightside">总盘状态:</td> 
             <td> <input onclick="change_plate_zt($(this),$('#is_plate_start'),'<?php echo $row['plate_num'];?>',$('#plate_time_end').val(),'<?php echo date( "Y-m-d H:i:s" );?>',$('#is_auto').val(),$('#plate_time_satrt').val(),$('#special_time_end').val(),$('#normal_time_end').val())" type="button" style="width:150px; color:<?php echo $row['is_plate_start'] == 1 ? "red" : "#00F";?>" class="bt" id="closeing" value="<?php echo $row['is_plate_start'] == 1 ? "正在封盘中..." : "正在开盘中...";?>" /></td> 
             <input type="hidden" id="is_plate_start" value="<?php echo $row['is_plate_start'];?>" /> 
            </tr> 
            <tr> 
             <td class="bg_color font_size12 rightside">开盘时间:</td> 
             <td class="tr_height"> <input value="<?php echo $row['plate_time_satrt'] ? $row['plate_time_satrt'] : date( "Y-m-d 17:30:00" );?>" name="plate_time_satrt" id="plate_time_satrt" type="text" class="long_input" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})" /> </td> 
             <td class="bg_color font_size12 rightside">自动开盘:</td> 
             <td class="tr_height"> <select onchange="is_auto_set($(this).val(),'2017005',$('#plate_time_satrt').val(),$('#special_time_end').val(),$('#normal_time_end').val())" name="is_auto" id="is_auto" style="width:58px ; "> <option value="0">允许</option> <option value="1">禁止</option> </select> </td> 
            </tr> 
            <tr> 
             <td class="bg_color font_size12 rightside">开奖时间:</td> 
             <td><input value="<?php echo $row['plate_time_lottery'] ? $row['plate_time_lottery'] : date( "Y-m-d 21:30:00" );?>" name="plate_time_lottery" id="wardopen" type="text" class="long_input" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})" /></td> 
             <td class="bg_color font_size12 rightside">总封盘时间:</td> 
             <td><input value="<?php echo $row['plate_time_end'] ? $row['plate_time_end'] : date( "Y-m-d 21:30:00" );?>" name="plate_time_end" id="plate_time_end" type="text" class="long_input" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})" /> <input onclick="plate_time_send($('#plate_time_end').val(),'2017005')" type="button" class="bt" id="send" value="传送" /> </td> 
            </tr> 
<!--             <tr> 
             <td class="bg_color font_size12 rightside">特码:</td> 
             <td> <input id="open" name="is_special" type="radio" value="0" /> <span class="style1 font_red">封</span> <input id="close" name="is_special" type="radio" value="1" checked="checked" /> <span class="style1">开</span> </td> 
             <td class="bg_color font_size12 rightside">特码封盘时间:</td> 
             <td><input value="2017-01-29 20:46:51" name="special_time_end" id="special_time_end" type="text" class="long_input" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})" /></td> 
            </tr>  -->
<!--             <tr> 
             <td class="bg_color font_size12 rightside">正码:</td> 
             <td> <input id="open" name="is_normal" type="radio" value="0" /> <span class="style1 font_red">封</span> <input id="close" name="is_normal" type="radio" value="1" checked="checked" /> <span class="style1">开</span> </td> 
             <td class="bg_color font_size12 rightside">正码封盘时间:</td> 
             <td><input value="2017-01-29 20:46:51" name="normal_time_end" id="normal_time_end" type="text" class="long_input" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})" /></td> 
            </tr>  -->
            <!-- <tr> 
             <td class="bg_color font_size12 rightside">特码最迟封盘:</td> 
             <td class="font_size12">开完第 <select name="last_special" style="width:38px ; "> <option value="1" selected="">1</option> <option value="2">2</option> <option value="3">3</option> <option value="4">4</option> <option value="5">5</option> <option value="6">6</option> </select> 个正码后全部封盘</td> 
             <td class="bg_color font_size12 rightside">特码滚球降赔:</td> 
             <td class="font_size12">每输入一个下码赔率下降 <select name="adrop" style="width:45px ; "> <option value="0" selected="">0</option> <option value="0.5">0.5</option> <option value="1">1</option> <option value="2">2</option> <option value="3">3</option> </select> </td> 
            </tr>  -->
            <tr> 
             <td colspan="4" style=" background-color:#d4e5f4; height:25px;text-align:center;" class="font_size12"> <input onclick="return chk_plate_time()" type="submit" class="bt" id="save" value="<?php if ( !empty( $row ) && !$row['num_g'] ){echo "保存盘口";}else{echo "添加盘口";}?>" /> </td> 
            </tr> 
           </tbody>
          </table> 
			</form>
          </td> 
         <td width="8" background="../images/tab/tab_15.gif">&nbsp;</td> 
        </tr> 
                    <tr> 
             <!-- <td><iframe border="0" name="I2" marginwidth="1" marginheight="-10" style="padding-left:27px;" src="http://special.hkjc.com/root/marksix/info/ch/mark6/fixtures.asp" frameborder="0" width="265" scrolling="no" height="250"></iframe></td>  -->
             <td colspan="4"> 
              <table width="60%" border="0" align="center" cellpadding="1" cellspacing="1" style="color:#344b50; font-size:13px;"> 
               <tbody>
                <tr class="F_bold"> 
                 <td height="25" align="center" bgcolor="DDE4F4">预设期数</td> 
                 <td align="center" bgcolor="DDE4F4">开奖时间</td> 
                 <td align="center" bgcolor="DDE4F4">自动开盘时间</td> 
                 <td align="center" bgcolor="DDE4F4">自动封盘时间</td> 
                 <td align="center" bgcolor="DDE4F4">操作</td> 
                </tr> 
              <?php while ( $row2 = $db->fetch_array( $query2 ) ) {?>
                <tr bgcolor="#FFFFFF">
                  <td height="25" align="center" valign="middle"><?php echo $row2['plate_num'];?></td>
                  <td align="center" valign="middle"><?php echo $row2['plate_time_lottery'];?></td>
                  <td align="center" valign="middle"><?php echo $row2['plate_time_satrt'];?></td>
                  <td align="center" valign="middle"><?php echo $row2['plate_time_end'];?></td>
                  <td align="center" valign="middle">
                      <button class="button_a" onclick="javascript:window.location='tab.php?plate_num=<?php echo $row2['plate_num'];?>'"><img src="../images/icon_21x21_edit01.gif" align="absmiddle">设置</button>
                      <button class="button_a" onclick="{if(confirm('您確定刪除该预设期数嗎?')){ javascript:window.location='tab.php?del_plate_autoadd_plate_num=<?php echo $row2['plate_num'];?>';return true;}else{return   false;}};"><img src="../images/icon_21x21_del.gif" style=" vertical-align:middle">删除</button>
                  </td>
                </tr>
                <?php }?>
               </tbody>
              </table> </td> 
            </tr> 
       </tbody>
      </table></td> 
    </tr> 
    <tr> 
     <td height="35" background="../images/tab/tab_19.gif">
      <table width="100%" border="0" cellspacing="0" cellpadding="0"> 
       <tbody>
        <tr> 
         <td width="12" height="35"><img src="../images/tab/tab_18.gif" width="12" height="35" /></td> 
         <td>
          <table width="100%" border="0" cellspacing="0" cellpadding="0"> 
           <tbody>
            <tr> 
             <td class="STYLE4">&nbsp;&nbsp;</td> 
             <td>
              <table border="0" align="right" cellpadding="0" cellspacing="0"> 
               <tbody>
                <tr> 
                </tr> 
               </tbody>
              </table></td> 
            </tr> 
           </tbody>
          </table></td> 
         <td width="16"><img src="../images/tab/tab_20.gif" width="16" height="35" /></td> 
        </tr> 
       </tbody>
      </table></td> 
    </tr> 
   </tbody>
  </table> 
 </body>
</html>