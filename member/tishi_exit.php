<?php
include_once ('../global.php');
$db = new action($mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset); //数据库操作类.
$db2 = new action($mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset); //数据库操作类.
$bishu=$_GET['bishu'];
//if($bishu){
//    $d_orders=  $db->select("orders", "id", "user_id={$_SESSION['uid'.$c_p_seesion]} order by id desc limit 0,$bishu");
//    //$do = $db->fetch_array($d_orders);
//   // echo $do['id'].'fuck2';
//    while($do= $db->fetch_array($d_orders)) {
//    $db2->delete("orders", "id={$do['id']}", "");
//    }
//}
//$url=$_SERVER['HTTP_REFERER'];
//$db->Get_admin_msgtopnull($url);
//echo " <script>$url</script>" ;
exit;
?>
