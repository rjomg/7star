<?php 

include_once ('../global.php');

$db = new action($mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset); //���ݿ������.
$db2 = new plate($mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset); //���ݿ������.
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



<script language="JAVASCRIPT">

if(self == top) {location = '/';} 

if(window.location.host!=top.location.host){top.location=window.location;} 

</script>







 <style type="text/css">

<!--

.STYLE10 {font-weight: bold}

-->

 </style>


<table class="Ball_List Tab" border="0" cellpadding="0" cellspacing="1">

  <tbody>

    <tr class="td_caption_1">

      <td height="22" width="150">�����ڔ�</td>

      <td width="82">�]�ιP��</td>

      <td width="130">���]���~</td>

      <td width="120">ݔ�A�Y��</td>

      <td width="90">��ˮ</td>

      <td width="120">��ˮ��Y��</td>

    </tr>

    <?php 
        $query=$db->select("member_settlereport", "*", "user_id=$uid order by plate_num desc");
        while ($row=$db->fetch_array($query)) { 
            $zs_zs=  $db2->select("plate", "history_is_lock", "plate_num={$row['plate_num']} limit 0,1");
            $zs=  $db2->fetch_array($zs_zs);
            //
        if($zs['history_is_lock']){    
    ?>  

     <TR <?php if($row['end_y']>0){?>bgColor=#FFFFA2<?php }else{?>onmouseover="javascript:this.bgColor='#D9FFD9'" 
              onmouseout="javascript:this.bgColor='#ffffff'" bgColor=#ffffff<?php }?>>

        <TD height=22 align=center><?php echo $row['plate_num'];?> ��</TD>

        <TD align=center><?php echo $row['bishu'];?></TD>

        <TD align=right><?php echo $row['order_y'];?></TD>

        <TD align=right><font <?php if($row['shuying_y']>0) echo 'color=blue';else echo 'color=red';?>><?php echo round($row['shuying_y'],2);?></font></TD>

        <TD align=right><?php echo $row['tuishui_y'];?></TD>

        <TD align=right><A 

          href="detail.php?plate_num=<?php echo $row['plate_num'];?>"><FONT <?php if($row['end_y']>0) echo 'color=blue';else echo 'color=red';?>><STRONG><?php echo round($row['end_y'],2);?></STRONG></FONT></A></TD>

     </TR>

  	<?php 
            $total_z+=$row['bishu'];

            $total_y+=$row['order_y'];

            $total_s+=$row['shuying_y'];

            $total_t+=$row['tuishui_y'];

            $total_tj+=$row['end_y'];

        }
        }
?>

    <tr class="td_caption_1">

      <td height="22"><span class="Font_R">СӋ</span></td>

      <td align="center"><?php echo $total_z;?></td>

      <td align="right"><?php echo $total_y;?></td>

      <td align="right"><font <?php if($total_s>0) echo 'color=blue';else echo 'color=red';?>><?php echo $total_s;?></font></td>

      <td align="right"><?php echo $total_t;?></td>

      <td align="right"><span class="STYLE10">

        <font <?php if($total_tj>0) echo 'color=blue';else echo 'color=red';?>><?php echo $total_tj;?></font>      </span></td>

    </tr>

  </tbody>

</table>

<br>

 </body></html>