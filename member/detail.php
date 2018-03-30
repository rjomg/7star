<?php 
include_once ('../global.php');
$db = new action($mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset); //数据库操作类.
$db2 = new mysql($mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset); //数据库操作类.
$uid = $_SESSION['uid'.$c_p_seesion];
$plate_num=$_GET[plate_num];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML xmlns="http://www.w3.org/1999/xhtml"><HEAD><META content="IE=5.0000" 
http-equiv="X-UA-Compatible">

<META content="text/html; charset=gbk" http-equiv=Content-Type>
<STYLE type=text/css>BODY {
	MARGIN: 0px
}
</STYLE>
</HEAD>
<BODY oncontextmenu="return false" oncopy=document.selection.empty() 
onmouseover="self.status='歡迎光臨';return true" 
onselect=document.selection.empty()><LINK rel=stylesheet 
type=text/css href="images/Index.css">
<SCRIPT language=JAVASCRIPT>
if(self == top) {location = '/';} 
if(window.location.host!=top.location.host){top.location=window.location;} 
</SCRIPT>

<STYLE type=text/css>.STYLE5 {
	COLOR: #000000
}
.STYLE6 {
	COLOR: #ff0000
}
.STYLE7 {
	COLOR: #ff0000; FONT-WEIGHT: bold
}
.STYLE8 {
	COLOR: #0000ff
}
</STYLE>

<DIV align=center>
<TABLE border=0 cellSpacing=0 cellPadding=0 width="96%" align=center>
  <TBODY>
  <TR>
    <TD>
      <TABLE border=0 cellSpacing=0 cellPadding=0 width="100%">
        <TBODY>
        <TR>
          <TD height=3></TD></TR></TBODY></TABLE>
      <TABLE border=0 cellSpacing=0 cellPadding=0 width=740>
        <TBODY>
        <TR>
          <TD height=25 width="46%">[<?php echo $plate_num;?>期]下註狀況&nbsp;&nbsp;</SPAN></TD>
          <TD width="36%"></TD>
          <TD></TD></TR></TBODY></TABLE>
      <TABLE class=Ball_List border=0 cellSpacing=1 borderColor=#cccccc 
      borderColorDark=#f9f9f9 cellPadding=2 width=740>
        <TBODY>
        <TR class=td_caption_1>
          <TD bgColor=#dfefff height=22 width=120 noWrap align=center><SPAN 
            class=STYLE5>註單號/時間 </SPAN></TD>
          <TD bgColor=#dfefff height=22 width=60 noWrap align=center><SPAN 
            class=STYLE5>下註類型</SPAN></TD>
          <TD bgColor=#dfefff height=22 width=60 noWrap align=center><SPAN 
            class=STYLE5>類型/盤口</SPAN></TD>
          <TD bgColor=#dfefff height=22 noWrap align=center><SPAN 
            class=STYLE5>註單明細</SPAN></TD>
          <TD bgColor=#dfefff height=22 width=60 noWrap align=center><SPAN 
            class=STYLE5>下註金額</SPAN></TD>
          <TD bgColor=#dfefff height=22 width=60 noWrap align=center><SPAN 
            class=STYLE5>退水</SPAN></TD>
          <TD bgColor=#dfefff height=22 width=80 noWrap align=center><SPAN 
            class=STYLE5>退水後結果</SPAN></TD></TR>
    <?php 
    $query=  $db->select("orders", "count(*) as c", "user_id = '$uid' and plate_num ='{$plate_num}'  order by time desc");
$total = $db->fetch_array($query);
$total=$total['c'];
pageft($total, 15); //20条为一页
if ($firstcount < 0)
	$firstcount = 0;
$dan = $db->select("orders", "*", "user_id = '$uid' and plate_num ='{$plate_num}'  order by time desc limit  $firstcount, $displaypg");
        $danss = mysql_query("select * from orders  where user_id = '$uid' and plate_num ='{$plate_num}'"); 
        $key=0;
while($zhu=$db->fetch_array($dan)){ 
    $key++;
    $endjine=$zhu['shuying_y']+$zhu['tuishui_y'];
    ?>          
        <TR <?php if($endjine>0){?>bgColor=#FFFFA2<?php }else{?>onmouseover="javascript:this.bgColor='#D9FFD9'" 
              onmouseout="javascript:this.bgColor='#ffffff'" bgColor=#ffffff<?php }?>>
          <TD height=28 noWrap align=center><?php echo $zhu['id']?>/<?php echo date('Y-m-d H:i:s',$zhu['time']);?></TD>
          <TD noWrap align=center><SPAN class=jeu_OpenLottery><?php echo $plate_num;?> 
          期</SPAN></TD>
          <TD noWrap align=center><?php echo $zhu['o_type1']?>/<?php echo $zhu['abcd_h']?>盤</TD>
          <TD height=28 noWrap align=center><SPAN 
            class=jeu_XZ_Type><?php echo $zhu['o_type2']?>『&nbsp;<?php echo $zhu['o_type3']?>&nbsp;』</SPAN> @&nbsp;<SPAN 
            id=jeu_multiple class=jeu_multiple><?php $orders_p_m=$db2->get_max_order_p_2($zhu['orders_p_2']);if($zhu['o_type2']=='二中特' || $zhu['o_type2']=='三中二') echo $orders_p_m[0][0].'/'.$orders_p_m[1][0];else echo $zhu['orders_p'];?></SPAN></TD>
          <TD noWrap align=right><?php echo $zhu['orders_y']?></TD>
          <TD noWrap align=right><?php echo $zhu['tuishui_y']?></TD>
          <TD noWrap align=right><?php echo $endjine;?></TD></TR>
        
     <?php     
    $total_y+=$zhu['orders_y'];
    $total_h+=$zhu['tuishui_y'];
    $total_k+=$endjine;
     }?>   
         <?php if($total>15){?>
        <TR class=td_caption_1>
          <TD bgColor=#dfefff height=22 noWrap align=center><SPAN 
            class=STYLE6></SPAN></TD>
          <TD bgColor=#dfefff height=22 noWrap align=center><SPAN 
            class=STYLE6></SPAN></TD>
          <TD bgColor=#dfefff height=22 noWrap align=center><SPAN 
            class=STYLE7>当页</SPAN></TD>
          <TD bgColor=#dfefff height=22 noWrap align=center><SPAN 
            class=STYLE7>《 <?php echo $key;?> 註》</SPAN></TD>
          <TD bgColor=#dfefff height=22 noWrap align=right><SPAN 
            class=STYLE7><?php echo round($total_y,2);?></SPAN></TD>
          <TD bgColor=#dfefff height=22 noWrap align=right><b><SPAN style="color:green"><?php echo round($total_h,2);?></SPAN></b></TD>
          <TD bgColor=#dfefff height=22 noWrap align=right><SPAN 
            class=STYLE7><?php echo round($total_k,2);?></SPAN></TD></TR>
        <?php }?>
              <?php 
      while ($zhuss = mysql_fetch_array($danss)) {
             $total_yss+=$zhuss['orders_y'];
             $total_hss+=$zhuss['tuishui_y'];
             $total_kss+=($zhuss['shuying_y']+$zhuss['tuishui_y']); 
      }
      ?>
        <TR class=td_caption_1>
          <TD bgColor=#dfefff height=22 noWrap align=center><SPAN 
            class=STYLE6></SPAN></TD>
          <TD bgColor=#dfefff height=22 noWrap align=center><SPAN 
            class=STYLE6></SPAN></TD>
          <TD bgColor=#dfefff height=22 noWrap align=center><SPAN 
            class=STYLE7>小計</SPAN></TD>
          <TD bgColor=#dfefff height=22 noWrap align=center><SPAN 
            class=STYLE7>共下註《 <?php echo $total;?> 註》</SPAN></TD>
          <TD bgColor=#dfefff height=22 noWrap align=right><SPAN 
            class=STYLE7><?php echo round($total_yss,2);?></SPAN></TD>
          <TD bgColor=#dfefff height=22 noWrap align=right><b><SPAN style="color:green"><?php echo round($total_hss,2);?></SPAN></b></TD>
          <TD bgColor=#dfefff height=22 noWrap align=right><SPAN 
            class=STYLE7><?php echo round($total_kss,2);?></SPAN></TD></TR>
        
        <tr class="td_caption_1"><td align=center colspan="10"><?php echo $pagenav;?></td></tr>
        </TBODY></TABLE>
      <TABLE border=0 cellSpacing=0 cellPadding=0 width=700>
        <TBODY>
        <TR>
          <TD>&nbsp;</TD></TR></TBODY></TABLE>
      <DIV align=center><BR><BR></DIV></TD></TR></TBODY></TABLE></DIV></BODY></HTML>
