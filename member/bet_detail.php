<?php 
include_once ('../global.php');
$db = new action($mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset); //���ݿ������.
$db2 = new mysql($mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset); //���ݿ������.
$uid = $_SESSION['uid'.$c_p_seesion];
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
<body oncontextmenu="return false" onselect="document.selection.empty()" oncopy="document.selection.empty()" onmouseover="self.status='�gӭ���R';return true">
<link rel="stylesheet" href="images/Index.css" type="text/css">
 
 <style type="text/css">
<!--
.STYLE6 {color: #000000}
.STYLE7 {color: #FFFFFF}
-->
 </style>
<table bordercolordark="#f9f9f9" class="Ball_List Tab" border="0" bordercolor="#cccccc" cellpadding="0" cellspacing="1" width="700">
  <tbody><tr class="td_caption_1">
    <td align="center" bgcolor="#DFEFFF" height="22" nowrap="nowrap" width="30"><span class="STYLE6">��̖</span></td>
    <td align="center" bgcolor="#DFEFFF" height="22" nowrap="nowrap" width="60"><span class="STYLE6"> ���]��̖ </span></td>
    <td align="center" bgcolor="#DFEFFF" height="22" nowrap="nowrap" width="80"><span class="STYLE6">���]�r�g</span></td>
    <td align="center" bgcolor="#DFEFFF" height="22" nowrap="nowrap" width="60"><span class="STYLE6">����</span></td>
    <td align="center" bgcolor="#DFEFFF" height="22" nowrap="nowrap" width="60"><span class="STYLE6">���/�P��</span></td>
    <td align="center" bgcolor="#DFEFFF" height="22" nowrap="nowrap"><span class="STYLE6"> ����</span></td>
    <td align="center" bgcolor="#DFEFFF" height="22" nowrap="nowrap"><span class="STYLE6">�r��</span></td>
    <td align="center" bgcolor="#DFEFFF" height="22" nowrap="nowrap" width="60"><span class="STYLE6">���~</span></td>
    <td align="center" bgcolor="#DFEFFF" height="22" nowrap="nowrap" width="60"><span class="STYLE6">���</span></td>
    <td align="center" bgcolor="#DFEFFF" height="22" nowrap="nowrap" width="60"><span class="STYLE6">�������~</span></td>
  </tr>
    <?php 
    $query=$db->select("plate", "plate_num,history_is_account", "1 order by plate_num desc");
    $row=$db->fetch_array($query);
    if($row['history_is_account']==0){
    $query=  $db->select("orders", "count(*) as c", "user_id = '$uid' and plate_num ='{$row['plate_num']}'");
    $total = $db->fetch_array($query);
    $total=$total['c'];

    pageft($total, 15); //15��Ϊһҳ
    if ($firstcount < 0)
	$firstcount = 0;
        $dan = mysql_query("select * from orders  where user_id = '$uid' and plate_num ='{$row['plate_num']}'  order by time desc limit $firstcount, $displaypg");    
    //$dan = mysql_query("select * from orders  where user_id = '$uid' and plate_num ='{$row['plate_num']}'  order by time desc" );
    //$total = mysql_num_rows($dan);
        $danss = mysql_query("select * from orders  where user_id = '$uid' and plate_num ='{$row['plate_num']}'"); 
        $key=0;
    while ($zhu = mysql_fetch_array($dan)) {
        $key++;
    ?>  
    <TR style="BACKGROUND-COLOR: #ffffff" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor='ffffff'" bgColor=#ffffff>
    <TD noWrap align=center><?php echo $key?></TD>
    <TD height=28 align=center><?php echo $zhu['id']?></TD>
    <TD align=center><?php echo date('Y-m-d H:i:s',$zhu['time']);?></TD>
    <TD noWrap align=center><?php echo $zhu['plate_num']?>��</TD>
    <TD noWrap align=center><?php echo $zhu['o_type1']?>/<?php echo $zhu['abcd_h']?>�P</TD>
    <TD height=28 noWrap align=center><SPAN class=jeu_XZ_Type><?php echo $zhu['o_type2']?>��&nbsp;<?php echo $zhu['o_type3']?>&nbsp;��</SPAN> </TD>
    <TD noWrap align=center><?php $orders_p_m=$db2->get_max_order_p_2($zhu['orders_p_2']);if($zhu['o_type2']=='������' || $zhu['o_type2']=='���ж�') echo $orders_p_m[0][0].'/'.$orders_p_m[1][0];else echo $zhu['orders_p'];?></TD>
    <TD noWrap align=center><?php echo $zhu['orders_y']?></TD>
    <TD noWrap align=center><?php echo $zhu['tuishui_y']?></TD>
    <TD noWrap align=center><?php echo $zhu['keying_y']?></TD>
    </TR>
    <?php 
    $total_y+=$zhu['orders_y'];
    $total_h+=$zhu['tuishui_y'];
    $total_k+=$zhu['keying_y'];
    }
    }?>
      <?php if($total>15){?>
      <tr class="td_caption_1">
    <td align="center" bgcolor="#DFEFFF" height="22" nowrap="nowrap">&nbsp;</td>
    <td align="center" bgcolor="#DFEFFF" height="22" nowrap="nowrap">&nbsp;</td>
    <td align="center" bgcolor="#DFEFFF" height="22" nowrap="nowrap">&nbsp;</td>
    <td align="center" bgcolor="#DFEFFF" height="22" nowrap="nowrap">&nbsp;</td>
    <td align="center" bgcolor="#DFEFFF" height="22" nowrap="nowrap"><span class="Font_R">��ҳ</span></td>
    <td align="center" bgcolor="#DFEFFF" height="22" nowrap="nowrap"><span class="Font_R">�� <?php echo $key;?> ���P</span></td>
    <td align="center" bgcolor="#DFEFFF" height="22" nowrap="nowrap"><span class="Font_R"></span></td>
    <td align="center" bgcolor="#DFEFFF" height="22" nowrap="nowrap"><span class="Font_R">
      <?php echo round($total_y,2);?>    </span></td>
    <td align="center" bgcolor="#DFEFFF" height="22" nowrap="nowrap"><span class="STYLE5">
      <?php echo round($total_h,2);?>    </span></td>
    <td align="center" bgcolor="#DFEFFF" height="22" nowrap="nowrap"><span class="Font_R">
      <?php echo round($total_k,2);?>    </span></td>
     </tr>
      <?php }?> 
      <?php 
      while ($zhuss = mysql_fetch_array($danss)) {
             $total_yss+=$zhuss['orders_y'];
             $total_hss+=$zhuss['tuishui_y'];
             $total_kss+=$zhuss['keying_y']; 
      }
      ?>
    <tr class="td_caption_1">
    <td align="center" bgcolor="#DFEFFF" height="22" nowrap="nowrap">&nbsp;</td>
    <td align="center" bgcolor="#DFEFFF" height="22" nowrap="nowrap">&nbsp;</td>
    <td align="center" bgcolor="#DFEFFF" height="22" nowrap="nowrap">&nbsp;</td>
    <td align="center" bgcolor="#DFEFFF" height="22" nowrap="nowrap">&nbsp;</td>
    <td align="center" bgcolor="#DFEFFF" height="22" nowrap="nowrap"><span class="Font_R">СӋ</span></td>
    <td align="center" bgcolor="#DFEFFF" height="22" nowrap="nowrap"><span class="Font_R">�����]�� <?php echo $total;?> ���P</span></td>
    <td align="center" bgcolor="#DFEFFF" height="22" nowrap="nowrap"><span class="Font_R"></span></td>
    <td align="center" bgcolor="#DFEFFF" height="22" nowrap="nowrap"><b><span class="Font_R">
            <?php echo round($total_yss,2);?>    </span></b></td>
    <td align="center" bgcolor="#DFEFFF" height="22" nowrap="nowrap"><b><span class="STYLE5">
      <?php echo round($total_hss,2);?>    </span></b></td>
    <td align="center" bgcolor="#DFEFFF" height="22" nowrap="nowrap"><b><span class="Font_R">
      <?php echo round($total_kss,2);?></b>    </span></b></td>
  </tr>
      <tr class="td_caption_1"><td align=center colspan="10"><?php echo $pagenav;?></td></tr>
</tbody></table>
 </body></html>