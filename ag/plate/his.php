<?php
include_once( "../../global.php" );
$db = new plate( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
$db2 = new plate( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
$so = $_GET['so'];
if ( $so )
{
		$so = "and plate_num like '%{$so}%'";
}
$query = $db->select( "plate", "count(*) as c", "id>0 {$so} order by plate_num desc" );
$total = $db->fetch_array( $query );
$total = $total['c'];
pageft( $total, 20 );
if ( $firstcount < 0 )
{
		$firstcount = 0;
}
$query = $db->select( "plate", "*", "id>0 {$so} order by plate_num desc limit  {$firstcount}, {$displaypg}" );
if ( $_GET['plate_num'] )
{
		$db->output_excel( $_GET['plate_num'] );
}

?>
<html oncontextmenu="return false" xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>盘口管理</title>
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
.periodImg{margin:auto;}
.altbg2{text-align:center;}
-->
</style>
<link href="../images/commom.css" rel="stylesheet" type="text/css">
<link href="../css/admincg.css" rel="stylesheet" type="text/css">
<script src="../js/common.js" type="text/javascript"></script>
<script src="../js/jquery-1.4.3.min.js" type="text/javascript"></script>
<script>
var  highlightcolor='#c1ebff';
//此处clickcolor只能用win系统颜色代码才能成功,如果用#xxxxxx的代码就不行,还没搞清楚为什么:(
var  clickcolor='#51b2f6';
function  changeto(){
source=event.srcElement;
if  (source.tagName=="TR"||source.tagName=="TABLE")
return;
while(source.tagName!="TD")
source=source.parentElement;
source=source.parentElement;
cs  =  source.children;
//alert(cs.length);
if  (cs[1].style.backgroundColor!=highlightcolor&&source.id!="nc"&&cs[1].style.backgroundColor!=clickcolor)
for(i=0;i<cs.length;i++){
	cs[i].style.backgroundColor=highlightcolor;
}
}

function  changeback(){
if  (event.fromElement.contains(event.toElement)||source.contains(event.toElement)||source.id=="nc")
return
if  (event.toElement!=source&&cs[1].style.backgroundColor!=clickcolor)
//source.style.backgroundColor=originalcolor
for(i=0;i<cs.length;i++){
	cs[i].style.backgroundColor="";
}
}

function  clickto(){
source=event.srcElement;
if  (source.tagName=="TR"||source.tagName=="TABLE")
return;
while(source.tagName!="TD")
source=source.parentElement;
source=source.parentElement;
cs  =  source.children;
//alert(cs.length);
if  (cs[1].style.backgroundColor!=clickcolor&&source.id!="nc")
for(i=0;i<cs.length;i++){
	cs[i].style.backgroundColor=clickcolor;
}
else
for(i=0;i<cs.length;i++){
	cs[i].style.backgroundColor="";
}
}
</script>
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tbody>
<!--   <tr>
  <td height="30" background="../images/tab/tab_05.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tbody><tr>
        <td width="12" height="30"><img src="../images/tab/tab_03.gif" width="12" height="30"></td>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tbody><tr>
              <td width="100%" valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tbody><tr>
                    <td width="5%"><div align="center"><img src="../images/tab/tb.gif" width="16" height="16"></div></td>
                    <td width="95%" class="STYLE1"><span class="STYLE3">历史开奖 (只對前二十期数據)</span> <span class="font_size12 al" style=" margin-left:224px;">期数查询:
                      <input onblur="window.location.href='his.php?so='+$(this).val()+'&amp;page='" name="check" id="check" value="" type="text">
                      </span></td>
                  </tr>
                </tbody></table></td>
              <td width="54%"><table border="0" align="right" cellpadding="0" cellspacing="0">
                </table></td>
            </tr>
          </tbody></table></td>
        <td width="16"><img src="../images/tab/tab_07.gif" width="16" height="30"></td>
      </tr>
    </tbody></table></td>
</tr> -->
  <tr>
    <td><!-- <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tbody><tr>
          <td width="8" background="../images/tab/tab_12.gif">&nbsp;</td>
          <td><table width="99%" align="center" bordercolor="#b5d6e6" border="1" style="border-collapse: collapse" class="al font_size12">
              <tbody><tr onmouseover="this.style.background='#ffffa2'" onmouseout="this.style.background=''">
                <td width="5%" height="24" style="background:url(../images/bg2.gif) repeat-x 0 0 ;" class="al font_size12">NO</td>
                <td width="5%" style="background:url(../images/bg2.gif) repeat-x 0 0 ;" class="al font_size12">期数</td>
                <td width="10%" style="background:url(../images/bg2.gif) repeat-x 0 0 ;" class="al font_size12">开奖时间</td>
                <td width="5%" class="al font_size12" style="background:url(../images/bg2.gif) repeat-x 0 0 ;">仟</td>
                <td width="5%" class="al font_size12" style="background:url(../images/bg2.gif) repeat-x 0 0 ;">佰</td>
                <td width="5%" class="al font_size12" style="background:url(../images/bg2.gif) repeat-x 0 0 ;">拾</td>
                <td width="5%" class="al font_size12" style="background:url(../images/bg2.gif) repeat-x 0 0 ;">个</td>
                <td width="5%" class="al font_size12" style="background:url(../images/bg2.gif) repeat-x 0 0 ;">特别号(45位用)</td>
                <td width="5%" class="al font_size12" style="background:url(../images/bg2.gif) repeat-x 0 0 ;">球6</td>
                <td width="5%" class="al font_size12" style="background:url(../images/bg2.gif) repeat-x 0 0 ;">球7</td>
                <td width="26%" class="al font_size12" style="background:url(../images/bg2.gif) repeat-x 0 0 ;">操作</td>
              </tr>            
            </tbody></table></td>
          <td width="8" background="../images/tab/tab_15.gif">&nbsp;</td>
        </tr>
      </tbody></table> -->

<!-- 新增 -->
  <div id="awardtable">
   <input type="hidden" name="formhash" value="dd9b4271" />
   <table width="100%" border="0" cellpadding="0" cellspacing="0" class="tableborder">
    <tbody>
     <tr align="center" class="header">
      <td style="font-family:Microsoft JhengHei; text-align:center" width="13%">开奖时间</td>
      <td style="font-family:Microsoft JhengHei; text-align:center" width="*">期号</td>
      <td style="font-family:Microsoft JhengHei; text-align:center" width="7%">仟</td>
      <td style="font-family:Microsoft JhengHei; text-align:center" width="7%">佰</td>
      <td style="font-family:Microsoft JhengHei; text-align:center" width="7%">拾</td>
      <td style="font-family:Microsoft JhengHei; text-align:center" width="7%">个</td>
      <td style="font-family:Microsoft JhengHei; text-align:center" width="10%">特别号(45位用)</td>
      <td style="font-family:Microsoft JhengHei; text-align:center" width="7%">球6</td>
      <td style="font-family:Microsoft JhengHei; text-align:center" width="7%">球7</td>
      <td style="font-family:Microsoft JhengHei; text-align:center" width="15%">操作</td>
      <td style="font-family:Microsoft JhengHei; text-align:center" width="7%"></td>
     </tr>
     <?php $i = 0; while ( $row = $db->fetch_array( $query ) ){?>
          <tr onMouseOver="hover1(this);" onMouseOut="hover2(this);" align="center" class="smalltxt" style="text-align:center;">
  <td class="altbg2"><?php if($row['true_time_lottery']==''){echo '---';}else{ echo $row['true_time_lottery'];}?></td>
  <td class="altbg2"><?php echo $row['plate_num'];?></td>
  <td class="altbg2"><div class='periodImg periodImg_<?php if($row['true_time_lottery']==''){echo '5';}else{ echo '1';}?>' ><?php if($row['true_time_lottery']==''){echo '--';}else{ echo $row['num_a'];}?></div></td>
  <td class="altbg1"><div class='periodImg periodImg_<?php if($row['true_time_lottery']==''){echo '5';}else{ echo '1';}?>' ><?php if($row['true_time_lottery']==''){echo '--';}else{ echo $row['num_b'];}?></div></td>
  <td class="altbg1"><div class='periodImg periodImg_<?php if($row['true_time_lottery']==''){echo '5';}else{ echo '1';}?>' ><?php if($row['true_time_lottery']==''){echo '--';}else{ echo $row['num_c'];}?></div></td>
  <td class="altbg1"><div class='periodImg periodImg_<?php if($row['true_time_lottery']==''){echo '5';}else{ echo '1';}?>' ><?php if($row['true_time_lottery']==''){echo '--';}else{ echo $row['num_d'];}?></div></td>
  <td class="altbg1"><div class='periodImg periodImg_0' ><?php if($row['true_time_lottery']==''){echo '--';}else{ echo $row['num_e'];}?></div></td>
  <td class="altbg1"><div class='periodImg periodImg_0' ><?php if($row['true_time_lottery']==''){echo '--';}else{ echo $row['num_f'];}?></div></td>
  <td class="altbg1"><div class='periodImg periodImg_0' ><?php if($row['true_time_lottery']==''){echo '--';}else{ echo $row['num_g'];}?></div></td>
  <td class="altbg2"><!-- <img src="../images/22.gif" style=" vertical-align:middle"><a href="his.php?plate_num=<?php echo $row['plate_num'];?>" style="text-decoration:none"> 导出</a> --></td>
      <td class="altbg1"></td>
  </tr>
     <?php }?>
     <tr>
         <td class="al" height="24" colspan="20">
          <?php echo $pagenav;?>
         </td>
      </tr>
    </tbody>
   </table>
  </div>
<!-- 新增 -->
      </td>
  </tr>
<!--   <tr>
    <td height="35" background="../images/tab/tab_19.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tbody><tr>
          <td width="12" height="35"><img src="../images/tab/tab_18.gif" width="12" height="35"></td>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tbody><tr>
                <td class="STYLE4">&nbsp;&nbsp;</td>
                <td><table border="0" align="right" cellpadding="0" cellspacing="0">
                    <tbody><tr> </tr>
                  </tbody></table></td>
              </tr>
            </tbody></table></td>
          <td width="16"> <img src="../images/tab/tab_20.gif" width="16" height="35"></td>
        </tr>
      </tbody></table></td>
  </tr> -->
</tbody></table>


</body></html>