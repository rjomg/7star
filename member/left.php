<?php
include_once ('../global.php');
$where='';
$db = new action($mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset); //数据库操作类.
$uid = $_SESSION['uid'.$c_p_seesion];	
if($uid){
$info = mysql_fetch_array(mysql_query("select * from users  where user_id = '$uid'"));	 
}
$username = $_SESSION['username'.$c_p_seesion];
$new_plate=$db->get_one('select plate_num from plate order by id desc');
$where.=' and user_id='.$uid;
// $where.=' and ts.user_id='.$uid;
$where.=' and plate_num='.$new_plate['plate_num'];
// echo $_SESSION['order_no'];
// if ($_SESSION['order_no']) {
//   $where.=' and order_no='.$_SESSION['order_no'];
// }
// $down_order=$db->get_all('select o.id,o.o_type3 as number,orders_y as money,orders_p,o.plate_num,ts.oddsset,ts.tuishui from orders as o left join tuishui_set as ts on ts.typename=o.o_type2 where o.is_del=0 and o.is_cloce=0 '.$where.' order by o.time DESC');
$down_order=$db->get_all('select id,o_type3 as number,orders_y as money,order_no as orderid,orders_p as frank,time as datetime,stattuima from orders as o where  is_water=0 and stattuima=0 and is_cloce=0 '.$where.' order by time DESC');
foreach ($down_order as $key => $value) {
  $down_order[$key]['classid']="5";
  $down_order[$key]['hotstat']="0";
  $down_order[$key]['statsizi']=0;
  $order_no=$value['orderid'];
}
$down_order=json_encode($down_order);
// echo $down_order;
?>

<!-- saved from url=(0028)http://89955899.com/menu.php -->
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 

<link rel="stylesheet" type="text/css" id="css" href="css/members.css">
<style>html{overflow-y:scroll;overflow-x:hidden;}</style>
<script src="js/common.js" type="text/javascript"></script>
<script src="js/showorderhtml.js" type="text/javascript"></script>
<script src="js/frank.js" type="text/javascript"></script>
<script src="js/ajax.js" type="text/javascript"></script>
<script src="js/showdate.js" type="text/javascript"></script>
<script type="text/javascript" src="js/json2.js"></script> 
<style media="print"> 
  .Noprint{display:none;}
  @page {
    size: auto; 
    margin: 0;
  }
  html{
        background-color: #FFFFFF;
        margin: 0px; 
    }
    body{
        margin: 5mm 5mm 5mm 5mm;
    }
</style> <style>
  td{
    font-size:12px;
    font-family:Microsoft JhengHei;
  }
</style>
<script type="text/javascript">
  var is_cash = 0;
</script>
</head>
<body oncopy="return false;" oncontextmenu="return false">
  <table class="left_body" style="padding:2px;" width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
    <tbody><tr class="Noprint"> 
      <td>
        <table width="100%" border="0" cellpadding="0" cellspacing="0" class="left_b" style="table-layout: fixed">
          <tbody><tr class="header_left_b">
            <td class="Noprint" colspan="2" style="text-align:center;">会员信息</td>
          </tr>
          <tr>
            <td colspan="2">账号：<?php echo $username?></td>
            <!-- <td></td> -->
          </tr>
              <tr>
            <td colspan="2">信用：<span id="my_rcedits"><?php echo $info['credit_total'];?></span></td>
            <!-- <td></td> -->
          </tr>
          <tr>
            <td colspan="2">已用：<span id="my_rcedits_use"><?php echo $info['credit_total']-$info['credit_remainder'];?></span></td>
            <!-- <td></td> -->
          </tr>
          <tr>
            <td colspan="2">可用：<span id="my_rcedits_leavings"><?php echo $info['credit_remainder'];?></span></td>
            <!-- <td></td> -->
          </tr>
              <tr>
            <td colspan="2">期号：<span id="my_issueno_now"><?php echo $new_plate['plate_num'];?></span></td>
            <!-- <td></td> -->
          </tr>
        </tbody></table>
      </td>
    </tr>
    <tr class="Noprint" height="18"><td>&nbsp;</td></tr>
    <tr>
      <td valign="top">
        <table align="center" width="100%" border="0" cellpadding="0" cellspacing="0">
          <tbody><tr>
            <td align="center">
              <div id="showorderhtml"></div>
            </td>
          </tr>
        </tbody></table>
      </td>
    </tr>
  </tbody></table>
<script language="JavaScript">
  window.parent.parent._OldOrderPrint=[];
  var data = '{"p":{"n":["1","1"],"j":<?php echo $down_order;?>,"o":"<?php echo $order_no;?>","oid":48703,"d":"<?php echo date('Y-m-d',time());?>","u":"<?php echo $username;?>","s":"yWqVsd","i":<?php echo $new_plate['plate_num'];?>,"t":0,"m":1,"ps":0}}';
  var cur_page = 0;
  showprint(cur_page, data);      
</script>
</body></html>