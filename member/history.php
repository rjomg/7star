<?php
include_once ('../global.php');
$db = new plate($mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset); //数据库操作类.
$db2 = new plate($mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset); //数据库操作类.
 $so=$_GET['so'];

if($so){
    $so="and plate_num like '%$so%'";
}
$query=  $db->select("plate", "count(*) as c", "num_g!=0 $so order by plate_num desc");
$total = $db->fetch_array($query);
$total=$total['c'];
pageft($total, 10); //20条为一页
if ($firstcount < 0)
	$firstcount = 0;
$result = $db->select("plate", "*", "num_g!=0 $so order by plate_num desc limit  $firstcount, $displaypg");

?>
<html oncontextmenu="return false" xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk">
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
</head>
<body  onmouseover="self.status='歡迎光臨';return true">
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
                        <td class="F_bold" width="32%">歷史開獎</td>
                        <td class="F_bold" width="67%">期数查詢
                          <input onblur="window.location.href='history.php?so='+$(this).val()+'&page=<?php echo $_GET['page'];?>'" name="check" id="check" value="<?php echo $_GET['so'];?>" type="text" /></td>
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
      <td>
          <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tbody>
          <tr>
            <td background="images/tab_12.gif" width="8">&nbsp;</td>
            <td align="center" height="50"><!-- 開始  --><div id="result"><table class="Ball_List" align="center" bgcolor="ffffff" border="0" bordercolor="f1f1f1" cellpadding="1" cellspacing="1" width="99%">
                          <tbody><tr class="td_caption_1">
                            <td bordercolor="cccccc" bgcolor="#DFEFFF" width="68" style="background:url(images/bg2.gif) repeat-x 0 0 ;"><div align="center">
                                NO
                            </div></td>
                            <td bordercolor="cccccc" bgcolor="#DFEFFF" width="80" style="background:url(images/bg2.gif) repeat-x 0 0 ;"><div align="center">期数</div></td>
                            <td bordercolor="cccccc" align="center" bgcolor="#DFEFFF" width="120" style="background:url(images/bg2.gif) repeat-x 0 0 ;">開獎時間</td>
                            <td bordercolor="cccccc" align="center" bgcolor="#DFEFFF" nowrap="nowrap" style="background:url(images/bg2.gif) repeat-x 0 0 ;">正码1</td>
                            <td bordercolor="cccccc" align="center" bgcolor="#DFEFFF" nowrap="nowrap" style="background:url(images/bg2.gif) repeat-x 0 0 ;">正码2</td>
                            <td bordercolor="cccccc" align="center" bgcolor="#DFEFFF" nowrap="nowrap" style="background:url(images/bg2.gif) repeat-x 0 0 ;"> 正码3</td>
                            <td bordercolor="cccccc" align="center" bgcolor="#DFEFFF" nowrap="nowrap" style="background:url(images/bg2.gif) repeat-x 0 0 ;">正码4</td>
                            <td bordercolor="cccccc" align="center" bgcolor="#DFEFFF" nowrap="nowrap" style="background:url(images/bg2.gif) repeat-x 0 0 ;">正码5</td>
                            <td bordercolor="cccccc" align="center" bgcolor="#DFEFFF" nowrap="nowrap" style="background:url(images/bg2.gif) repeat-x 0 0 ;">正码6</td>
                            <td bordercolor="cccccc" align="center" bgcolor="#DFEFFF" nowrap="nowrap" style="background:url(images/bg2.gif) repeat-x 0 0 ;">特码</td>
                            <td bordercolor="cccccc" align="center" background="images/bg.gif" bgcolor="#DFEFFF" style="background:url(images/bg2.gif) repeat-x 0 0 ;">生肖</td>
                            <td bordercolor="cccccc" align="center" bgcolor="#DFEFFF" style="background:url(images/bg2.gif) repeat-x 0 0 ;">總和</td>
                            <td bordercolor="cccccc" align="center" bgcolor="#DFEFFF" nowrap="nowrap" style="background:url(images/bg2.gif) repeat-x 0 0 ;">特码单双</td>
                            <td bordercolor="cccccc" align="center" bgcolor="#DFEFFF" style="background:url(images/bg2.gif) repeat-x 0 0 ;">特码大小</td>
                            <td bordercolor="cccccc" align="center" bgcolor="#DFEFFF" style="background:url(images/bg2.gif) repeat-x 0 0 ;">合数单双</td>
                            <td bordercolor="cccccc" align="center" bgcolor="#DFEFFF" style="background:url(images/bg2.gif) repeat-x 0 0 ;">總和单双</td>
                            <td bordercolor="cccccc" align="center" bgcolor="#DFEFFF" style="background:url(images/bg2.gif) repeat-x 0 0 ;">總和大小</td>
                          </tr>
						  
                          
                        
                        <?php 
$i=0;
while($row=$db->fetch_array($result)){ 
    $num_a=$db2->get_num_detail($row['animal_set_id'], $row['num_a']);
    $num_b=$db2->get_num_detail($row['animal_set_id'], $row['num_b']);
    $num_c=$db2->get_num_detail($row['animal_set_id'], $row['num_c']);
    $num_d=$db2->get_num_detail($row['animal_set_id'], $row['num_d']);
    $num_e=$db2->get_num_detail($row['animal_set_id'], $row['num_e']);
    $num_f=$db2->get_num_detail($row['animal_set_id'], $row['num_f']);
    $num_g=$db2->get_num_detail($row['animal_set_id'], $row['num_g']);
$i++;
    ?>
                          <tr onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor='#ffffff'" bgcolor="#ffffff">
                            <td bordercolor="cccccc" height="25"><div align="center">
                               <?php echo $i;?>                         </div></td>
                            <td align="center" height="25"><?php echo $row['plate_num'];?>                          </td>
                            <td align="center" height="25" nowrap="nowrap"><?php echo date('Y-m-d',strtotime($row['plate_time_lottery']));?></td>
                             <td width="2%" align="center" height="25" width="30"><p style="background-image:url(images/<?php echo $num_a['color'].'.gif';?>); height:27px; width:28px; margin:0; padding:0; line-height:27px;"><b><?php echo $row['num_a'];?></b></p></td>
                              <td width="2%" align="center" height="25" width="30" ><p style="background-image:url(images/<?php echo $num_b['color'].'.gif';?>); height:27px; width:28px; margin:0; padding:0; line-height:27px;"><b><?php echo $row['num_b'];?></b></p></td>
                            <td width="2%" align="center" height="25" width="30"><p style="background-image:url(images/<?php echo $num_c['color'].'.gif';?>); height:27px; width:28px; margin:0; padding:0; line-height:27px;"><b><?php echo $row['num_c'];?></b></p></td>
                             <td width="2%" align="center" height="25" width="30" ><p style="background-image:url(images/<?php echo $num_d['color'].'.gif';?>); height:27px; width:28px; margin:0; padding:0; line-height:27px;"><b><?php echo $row['num_d'];?></b></p></td>
                             <td width="2%" align="center" height="25" width="30"><p style="background-image:url(images/<?php echo $num_e['color'].'.gif';?>); height:27px; width:28px; margin:0; padding:0; line-height:27px;"><b><?php echo $row['num_e'];?></b></p></td>
                            <td width="2% "align="center" height="25" width="30"><p style="background-image:url(images/<?php echo $num_f['color'].'.gif';?>); height:27px; width:28px; margin:0; padding:0; line-height:27px;"><b><?php echo $row['num_f'];?></b></p></td>
                             <td width="2%" align="center" height="25" width="30"><p style="background-image:url(images/<?php echo $num_g['color'].'.gif';?>); height:27px; width:28px; margin:0; padding:0; line-height:27px;"><b><?php echo $row['num_g'];?></b></p></td>
                            <td align="center" nowrap="nowrap">
                            <?php echo $num_a['animal'];?> 
							<?php echo $num_b['animal'];?> 
							<?php echo $num_c['animal'];?> 
							<?php echo $num_d['animal'];?> 
							<?php echo $num_e['animal'];?>  
							<?php echo $num_f['animal'];?>  + 
							<?php echo $num_g['animal'];?></td>
                            <td align="center"><?php echo $row['num_a']+$row['num_b']+$row['num_c']+$row['num_d']+$row['num_e']+$row['num_f']+$row['num_g'] ;?> </td>
                            <td align="center"><?php echo $row['num_g']%2 != 0 ?  '<font color="0000ff">单</font>' : '<font color="000000">双</font>' ?></td>
                            <td align="center"><?php echo $row['num_g']>25 ?  '<font color="0000ff">大</font>' : '<font color="000000">小</font>' ?></td>
                            <td align="center"><?php 
							$hd = array(01,03,05,07,09,10,12,14,16,18,21,23,25,27,29,30,32,34,36,38,41,43,45,47,49); 
							echo in_array($row['num_g'],$hd)?  '<font color="0000ff">单</font>' : '<font color="000000">双</font>';
							
							 ?></td>
                            <td align="center"><?php $to = $row['num_a']+$row['num_b']+$row['num_c']+$row['num_d']+$row['num_e']+$row['num_f']+$row['num_g'] ;echo $to%2 != 0 ?  '<font color="0000ff">单</font>' : '<font color="000000">双</font>' ?></td>
                            <td align="center"><font color="000000"><?php $to = $row['num_a']+$row['num_b']+$row['num_c']+$row['num_d']+$row['num_e']+$row['num_f']+$row['num_g'];echo $to>174 ?  '<font color="0000ff">大</font>' : '<font color="000000">小</font>' ?></font></td>
                          </tr>
                                       
                                <?php
						}
					  ?>           
                    
                  </tbody></table>
            
             </div> <!-- 結束  --></td>
            <td background="images/tab_15.gif" width="8"></td>
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
                  <td align="center">&nbsp;<?php echo $pagenav;?></td>
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
  <script src="js/jquery-1.4.3.min.js" type="text/javascript"></script>
</body></html>