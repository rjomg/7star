<?php
include_once('../../global.php');
//$user_id=$_SESSION['uid'.$c_p_seesion];
$o_id=$_POST['o_id'];
$t3=$_POST['t3'];
$user_id=$_POST['user_id'];
$abcd_rate=$_POST['abcd_rate'];
if(empty($abcd_rate))$abcd_rate=0;
//$ty=$_POST['ty'];
//$o=$_POST['o'];
$db = new action($mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset); //数据库操作类.
$yx =  $db->select("plate", "plate_num","1 order by plate_num desc limit 0,1");
$z=  $db->fetch_array($yx);
$plate_num=$z['plate_num'];
            $y =  $db->select("odds_set", "o_content","plate_num=$plate_num and o_id={$o_id} and user_id={$user_id} order by user_id asc");
            while($row= $db->fetch_array($y)) {
            $content_arr[]= $row['o_content'];
             }

            foreach ($content_arr as $ct){
            $tos_arr = explode(',', trim($ct,','));
               foreach ($tos_arr as $to){
                   $o_arr = explode(':', $to);
                   $o_arr[0]=iconv("gbk", "utf-8", $o_arr[0]);
                   if($o_arr[0]==$t3){
                       $view_odd=$o_arr[1]-$abcd_rate;
                   }
               }
            }
//            if($ty==1){
//               $view_odd+=$o;
//            }else if($ty==2){
//               $view_odd-=$o;
//            }
//            $str="<input name='x_orders_p[]'  value='$view_odd' type='hidden'>";
                echo $view_odd;exit;
?>
