<?php
include_once ('../global.php');
$db = new rate($mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset); //���ݿ������.


    $tiaojian_pan="����";




//��ȡ�ϼ����ϼ������Ϣ
$db->get_tops($_SESSION['uid'.$c_p_seesion]);
$user_top=$db->tops;
$queryusers=  $db->select("users", "is_odds,is_fly", "user_id={$user_top['branch']['user_id']}");
$user = $db->fetch_array($queryusers);
if($user['is_odds']==1){
    $db->get_tops($user_top['branch']['user_id']);
    $gs=$db->tops;
 $u_id= $gs['company']['user_id'];  
}else{
 $u_id= $user_top['branch']['user_id'];  
}
$rate_admin=$db->get_rate(63,1);
$rate_admin2=$db->get_rate(64,1);
$rate_admin3=$db->get_rate(65,1);
$rate_admin4=$db->get_rate(66,1);
$rate_admin5=$db->get_rate(67,1);
$rate_admin6=$db->get_rate(68,1);
$rate=$db->get_rate(63,$u_id);
$rate2=$db->get_rate(64,$u_id);
$rate3=$db->get_rate(65,$u_id);
$rate4=$db->get_rate(66,$u_id);
$rate5=$db->get_rate(67,$u_id);
$rate6=$db->get_rate(68,$u_id);

//��ǰ����
$qishus=  $db->select("plate", "*", "1 order by plate_num desc limit 1");
$qishu = $db->fetch_array($qishus);

//�����ж�����ķ���״̬
//  $qishu[is_special]=1;//���뿪
//  $qishu[special_time_end];//�������ʱ��
//  
//  $qishu[is_normal]=1;//���뿪
//  $qishu[normal_time_end];//�������ʱ��
//  
//  $qishu[plate_time_satrt];//����ʱ��
//  $qishu[plate_time_end];//�ܷ���ʱ��
// // $qishu[plate_time_satrt]<= time() && $qishu[plate_time_satrt]>$qishu[plate_time_end] && $qishu[is_plate_start]
//  $qishu[is_plate_start];//״̬0���ڿ��̣�1���ڷ���
        $gunqiufengpan_arr=$db->gunqiufengpan();//�������
        $gunqiufengpan_te=$gunqiufengpan_arr[0];
        $gunqiufengpan_other=$gunqiufengpan_arr[1];
     $tezhengma=0;
     if($gunqiufengpan_other==0 && $qishu[is_normal] && strtotime($qishu[normal_time_end])>time() && strtotime($qishu[plate_time_satrt])<= time() && time()<strtotime($qishu[plate_time_end]) && $qishu[is_plate_start]==0){
         $tezhengma=1;
     }
     $tezhengma_time=$qishu['normal_time_end'];
            
//��ǰ�û���Ϣ
$myusers=  $db->select("users", "*", "user_id={$_SESSION['uid'.$c_p_seesion]}");
$myuser = $db->fetch_array($myusers);


//ABCD���л�����
$o_pan=$_GET['pan'];
if($o_pan=="")$o_pan="A";


//����
$onlyabcds=  $db->select("abcd_rate", "*", "o_typename='$tiaojian_pan'");
$onlyabcd = $db->fetch_array($onlyabcds);
$abcd_rate=0;
if($o_pan=="B"){
   $abcd_rate=$onlyabcd['ab_rate']; 
}elseif($o_pan=="C"){
   $abcd_rate=$onlyabcd['ac_rate'];   
}elseif($o_pan=="D"){
   $abcd_rate=$onlyabcd['ad_rate']; 
}


if($_POST['btnSubmit']=="��ע"){
    for($i=0;$i<13;$i++){
    if(!empty($_POST['gagex'.$i])){
        $xxx.=$_POST['gagex'.$i].',';
    }
    }
    $xxx=trim($xxx,',');
    $xxx_arr=explode(',', $xxx);
    if(count($xxx_arr)<2){
        echo " <script> alert( '����ѡ��2��! ') ;window.location.href= 'gg.php';</script> " ; exit(); 
    }

    $orders_p=1;
  foreach ($xxx_arr as $j=>$v){
      $o_type3.=$xxx_arr[$j].'@'.$_POST[x_orders_p][$j].'<br>';
      $orders_p*=$_POST[x_orders_p][$j];
  }

    $x_o_type3=array($o_type3);
    $x_orders_p=array(round($orders_p,2));

$orders_tixing=$db->get_orders_tixing($qishu['plate_num'],$o_pan,'����',$tiaojian_pan,$x_o_type3,$_POST[x_orders_y],$x_orders_p,0,0,"");      
$x_o_type3 =  implode('=_=',$x_o_type3);
$x_orders_y =  implode('=_=',$_POST[x_orders_y]);
$x_orders_p =  implode('=_=',$x_orders_p);
//echo $x_orders_p ;
//echo "lm.php?o=$o_type&pan=$o_pan&x_orders_y_i=$orders_tixing[1]&x_plate_num=$qishu[plate_num]";
//exit();
    echo " <script>if(confirm('$orders_tixing[0]')){ 
   window.location.href='gg.php?pan=$o_pan&x_orders_y_i=$orders_tixing[1]&x_plate_num=$qishu[plate_num]&x_abcd_h=$o_pan&x_o_type1=����&x_o_type2=$tiaojian_pan&x_o_type3=$x_o_type3&x_orders_y=$x_orders_y&x_orders_p=$x_orders_p';
       }
else 
  { 
  
    }</script>";      
//$db->get_orders($qishu['plate_num'],$o_pan,'����',$tiaojian_pan,$x_o_type3,$_POST[x_orders_y],$x_orders_p,0,0,""); 

}
if($_GET[x_orders_y_i]>0){
//echo $_GET[x_orders_y_i].$_GET[x_plate_num].$_GET[x_abcd_h].$_GET[x_o_type1].$_GET[x_o_type2];
//echo $_GET[x_o_type3].$_GET[x_orders_y].$_GET[x_orders_p];
//exit;
    $db->get_orders($_GET[x_orders_y_i],$_GET[x_plate_num],$_GET[x_abcd_h],'����',$_GET[x_o_type2],explode('=_=',$_GET[x_o_type3]),explode('=_=',$_GET[x_orders_y]),explode('=_=',$_GET[x_orders_p]),0,0,"");

}
//$ty3="����1-��@1.7<br>����2-˫@1.8<br>����3-��@1.9<br>����4-С@1.9<br>����5-��@1.9<br>����6-˫@1.9<br>";
//                        $iscunzai3=explode('<br>',trim($ty3,'<br>'));
//                        foreach ($iscunzai3 as $icz3){
//                            $i3s=explode('@',$icz3);
//                            foreach ($i3s as $i3){
//                                $ijia=$i3s[0];
//                            }
//                            $ijia2[$iii].=$ijia.',';
//                        }
//                        //print_r($zm123456);print_r($dsdx);
//                        echo $ijia2[$iii];
//                        $iscz=explode(',', trim($ijia2[$iii],','));
//                        foreach ($iscz as $iz){
//                            $iz_arr=explode('-',$iz);
//                            $zm123456[]=$iz_arr[0];
//                            $dsdx[]=$iz_arr[1];
//                        }
//                        foreach ($zm123456 as $zk=> $z123456){
//                            $rate_v1=$rate[$dsdx[$zk]][1]-$abcd_rate;
//                        }
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
<script src="js/jquery-1.4.3.min.js?i=0" type="text/javascript"></script>
<link href="images/Index.css" rel="stylesheet" type="text/css">
<script src="js/normal.js?i=1" type="text/javascript"></script>    
<?php if($tezhengma==1){?>
<SCRIPT type="text/javascript">    
iso();
var ii=90;
function iso(){
    ii--;
    if(ii<='0'){
        ii=90;
        sendform();
    }
    $("#n").text(ii);
    setTimeout("iso()",1000);
}

</SCRIPT>  
<?php }?>     
 <script language="JavaScript">
var count_win=false;
function CheckKey(){
	if(event.keyCode == 13) return true;
	if((event.keyCode < 48 || event.keyCode > 57) && (event.keyCode > 95 || event.keyCode < 106)){alert("���]���~�H��ݔ������!!"); return false;}
}



function sendform(){
        var pan = $("#ltype");
        var url = 'gg.php';
        url += "?pan="+pan.val();
        window.open(url,'_self');
    }

</script>
<SCRIPT language=Javascript type=text/javascript>
<!--
//*****Javascript���ظ��ύ************
var frm_submit=false; //��¼�ύ״̬
function check_form(fobj) {
var error = 0;
var error_message = "";
if (fobj.formtext.value=="")
{
error_message = error_message + "formtext ����Ϊ��.n";
error = 1;
}

if (frm_submit==true) {
error_message = error_message + "������Ѿ��ύ.n�����ĵȴ������������������.nn";
error=1;
}

if (error == 1) {
alert(error_message);
return false;
} else {
frm_submit=true; //�ı��ύ״̬
return true;
}
}
-->
</script>
 <div align="left"><iframe name="5123" scrolling="no" frameborder="0" width="760" height="25" src="http://bmw.512302.com:8022/fgjfjgfj/vbnvbnt/vbnmvmvbm/live.html"></iframe>
</div>
 <table border="0" cellpadding="0" cellspacing="0" width="780">
                     <tbody>
                    <tr>
                      <td class="F_bold" nowrap="nowrap"><b id="t_LID" class="Font_G"><?php echo $qishu['plate_num'];?></b>�� <b class="font_b"><span id="ftm1">����</span>&nbsp;&nbsp;&nbsp;&nbsp;
                                <select class="za_select" id="ltype" name="ltype" onChange="sendform(this);">
            <?php
            $userelse_plates = explode(',', $myuser['else_plate']);
            foreach ($userelse_plates as $up_arr) { ?>
             <option <?php if ($o_pan == $up_arr): ?>selected<?php endif; ?> value="<?php echo $up_arr;?>"><?php echo $up_arr;?>�P</option>   
            <?php }?>
        </select></b></td>
                      <td class="F_bold" nowrap="nowrap"></td>
                      <td align="right" width="25%">
                          <?php if($tezhengma){ ?>
                          <font color="#000000">���x��P��</font>
          <span id="hClockTime_C">
               <?php                       $aaa=strtotime($tezhengma_time)-time();
                                                           $bbb=floor($aaa/86400);//��
                                                           $ccc=floor(($aaa-($bbb*86400))/3600);//Сʱ
                                                           $ddd=floor(($aaa-($bbb*86400)-($ccc*3600))/60);//����
                                                           $eee=$aaa-($bbb*86400)-($ccc*3600)-($ddd*60);//��
             //  echo $bbb.'��'.$ccc.'Сʱ'.$ddd."����";
                                                           $bbbccc=24*$bbb+$ccc;//Сʱ����
                                                           ?>   
             
          </span>
                        <?php }else{ echo '�ѷ���'; ?>
              <font color="#000000">���x���P��</font>
          <span id="hClockTime_C">
               <?php                       $aaa=strtotime($qishu['plate_time_satrt'])-time();
                                                           $bbb=floor($aaa/86400);//��
                                                           $ccc=floor(($aaa-($bbb*86400))/3600);//Сʱ
                                                           $ddd=floor(($aaa-($bbb*86400)-($ccc*3600))/60);//����
                                                           $eee=$aaa-($bbb*86400)-($ccc*3600)-($ddd*60);//��
                                                           //  echo $bbb.'��'.$ccc.'Сʱ'.$ddd."����";
                                                           $bbbccc=24*$bbb+$ccc;//Сʱ����
                                                           ?>   
             
          </span>   
              <?php }?>
           </td>
                      
                      <td align="right" width="22%">
                          <?php if($tezhengma){ ?>
                          <font color="#000000"><span id="Update_Time"><span id="n">90</span>��</span></font>
                          <?php }?>
                      </td>
                    </tr>
                  </tbody>
                </table>
<!-- �_ʼ  --><div id="result">  <table class="Ball_List Tab" bgcolor="ffffff" border="0" bordercolor="f1f1f1" cellpadding="0" cellspacing="1" width="780">
    <tbody><tr class="td_caption_1">
      <td bordercolor="cccccc" bgcolor="#DFEFFF" nowrap="nowrap"><div align="center"> NO </div></td>
      <td bordercolor="cccccc" align="center" bgcolor="#DFEFFF" nowrap="nowrap">�r��</td>
      <td bordercolor="cccccc" bgcolor="#DFEFFF" nowrap="nowrap"><div align="center"> NO </div></td>
      <td bordercolor="cccccc" align="center" bgcolor="#DFEFFF" nowrap="nowrap">�r��</td>
      <td bordercolor="cccccc" bgcolor="#DFEFFF" nowrap="nowrap"><div align="center"> NO </div></td>
      <td bordercolor="cccccc" align="center" bgcolor="#DFEFFF" nowrap="nowrap">�r��</td>
      <td bordercolor="cccccc" bgcolor="#DFEFFF" nowrap="nowrap"><div align="center"> NO </div></td>
      <td bordercolor="cccccc" align="center" bgcolor="#DFEFFF" nowrap="nowrap">�r��</td>
      <td bordercolor="cccccc" bgcolor="#DFEFFF" nowrap="nowrap"><div align="center"> NO </div></td>
      <td bordercolor="cccccc" align="center" bgcolor="#DFEFFF" nowrap="nowrap">�r��</td>
      <td bordercolor="cccccc" bgcolor="#DFEFFF" nowrap="nowrap"><div align="center"> NO </div></td>
      <td bordercolor="cccccc" align="center" bgcolor="#DFEFFF" nowrap="nowrap">�r��</td>
    </tr>
        <form name="lt_form" id="lt_form" method="post" action="" >
        <input name="fpsess" type="hidden" value="<?php echo $_SESSION["fsess"]; ?>" />
<!-- ���������ʱ�� -->
<input name="faction" type="hidden" value="submit" />
    <tr style="background-color: rgb(255, 255, 255);" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor='ffffff'" bgcolor="#FFFFFF">
      <td bordercolor="cccccc" align="center" height="25" nowrap="nowrap"><input name="gagex1" value="����1-��" type="radio" <?php if($rate['��'][2]==1 || $rate_admin['��'][2]==1 || $tezhengma==0){ echo  'disabled';}?> onClick="get_synchro_rate('63','��','1',<?php echo $u_id;?>,<?php echo $abcd_rate;?>);">
        ����1-��</td><input name="x_orders_p[]"  value="<?php echo ($rate['��'][1]-$abcd_rate);?>" type="hidden">
      <td align="center" height="25"><span id="bl0" class="multiple_Red synchro_rate1"><?php if($tezhengma) echo ($rate['��'][1]-$abcd_rate);else  echo '-';?></span></td>
      <td bordercolor="cccccc" align="center" height="25" nowrap="nowrap"><input name="gagex3" value="����2-��" type="radio" <?php if($rate2['��'][2]==1 || $rate_admin2['��'][2]==1 || $tezhengma==0){ echo  'disabled';}?> onClick="get_synchro_rate('64','��','2',<?php echo $u_id;?>,<?php echo $abcd_rate;?>);">
        ����2-��</td><input name="x_orders_p[]"  value="<?php echo ($rate2['��'][1]-$abcd_rate);?>" type="hidden">
      <td align="center" height="25"><span id="bl4" class="multiple_Red synchro_rate2"><?php if($tezhengma) echo ($rate2['��'][1]-$abcd_rate);else  echo '-';?></span></td>
      <td bordercolor="cccccc" align="center" height="25" nowrap="nowrap"><input name="gagex5" value="����3-��" type="radio" <?php if($rate3['��'][2]==1 || $rate_admin3['��'][2]==1 || $tezhengma==0){ echo  'disabled';}?> onClick="get_synchro_rate('65','��','3',<?php echo $u_id;?>,<?php echo $abcd_rate;?>);">
        ����3-��</td><input name="x_orders_p[]"  value="<?php echo ($rate3['��'][1]-$abcd_rate);?>" type="hidden">
      <td align="center" height="25"><span id="bl8" class="multiple_Red synchro_rate3"><?php if($tezhengma) echo ($rate3['��'][1]-$abcd_rate);else  echo '-';?></span></td>
      <td bordercolor="cccccc" align="center" height="25" nowrap="nowrap"><input name="gagex7" value="����4-��" type="radio" <?php if($rate4['��'][2]==1 || $rate_admin4['��'][2]==1 || $tezhengma==0){ echo  'disabled';}?> onClick="get_synchro_rate('66','��','4',<?php echo $u_id;?>,<?php echo $abcd_rate;?>);">
        ����4-��</td><input name="x_orders_p[]"  value="<?php echo ($rate4['��'][1]-$abcd_rate);?>" type="hidden">
      <td align="center" height="25"><span id="bl12" class="multiple_Red synchro_rate4"><?php if($tezhengma) echo ($rate4['��'][1]-$abcd_rate);else  echo '-';?></span></td>
      <td bordercolor="cccccc" align="center" height="25" nowrap="nowrap"><input name="gagex9" value="����5-��" type="radio" <?php if($rate5['��'][2]==1 || $rate_admin5['��'][2]==1 || $tezhengma==0){ echo  'disabled';}?> onClick="get_synchro_rate('67','��','5',<?php echo $u_id;?>,<?php echo $abcd_rate;?>);">
        ����5-��</td><input name="x_orders_p[]"  value="<?php echo ($rate5['��'][1]-$abcd_rate);?>" type="hidden">
      <td align="center" height="25"><span id="bl16" class="multiple_Red synchro_rate5"><?php if($tezhengma) echo ($rate5['��'][1]-$abcd_rate);else  echo '-';?></span></td>
      <td bordercolor="cccccc" align="center" height="25" nowrap="nowrap"><input name="gagex11" value="����6-��" type="radio" <?php if($rate6['��'][2]==1 || $rate_admin6['��'][2]==1 || $tezhengma==0){ echo  'disabled';}?> onClick="get_synchro_rate('68','��','6',<?php echo $u_id;?>,<?php echo $abcd_rate;?>);">
        ����6-��</td><input name="x_orders_p[]"  value="<?php echo ($rate6['��'][1]-$abcd_rate);?>" type="hidden">
      <td align="center" height="25"><span id="bl20" class="multiple_Red synchro_rate6"><?php if($tezhengma) echo ($rate6['��'][1]-$abcd_rate);else  echo '-';?></span></td>
    </tr>
    <tr style="background-color: rgb(255, 255, 255);" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor='ffffff'" bgcolor="#FFFFFF">
      <td bordercolor="cccccc" align="center" height="25" nowrap="nowrap"><input name="gagex1" value="����1-˫" type="radio" <?php if($rate['˫'][2]==1 || $rate_admin['˫'][2]==1 || $tezhengma==0){ echo  'disabled';}?> onClick="get_synchro_rate('63','˫','7',<?php echo $u_id;?>,<?php echo $abcd_rate;?>);">
        ����1-˫</td><input name="x_orders_p[]"  value="<?php echo ($rate['˫'][1]-$abcd_rate);?>" type="hidden">
      <td align="center" height="25"><span id="bl1" class="multiple_Red synchro_rate7"><?php if($tezhengma) echo ($rate['˫'][1]-$abcd_rate);else  echo '-';?></span></td>
      <td bordercolor="cccccc" align="center" height="25" nowrap="nowrap"><input name="gagex3" value="����2-˫" type="radio" <?php if($rate2['˫'][2]==1 || $rate_admin2['˫'][2]==1 || $tezhengma==0){ echo  'disabled';}?> onClick="get_synchro_rate('64','˫','8',<?php echo $u_id;?>,<?php echo $abcd_rate;?>);">
        ����2-˫</td><input name="x_orders_p[]"  value="<?php echo ($rate2['˫'][1]-$abcd_rate);?>" type="hidden">
      <td align="center" height="25"><span id="bl5" class="multiple_Red synchro_rate8"><?php if($tezhengma) echo ($rate2['˫'][1]-$abcd_rate);else  echo '-';?></span></td>
      <td bordercolor="cccccc" align="center" height="25" nowrap="nowrap"><input name="gagex5" value="����3-˫" type="radio" <?php if($rate3['˫'][2]==1 || $rate_admin3['˫'][2]==1 || $tezhengma==0){ echo  'disabled';}?> onClick="get_synchro_rate('65','˫','9',<?php echo $u_id;?>,<?php echo $abcd_rate;?>);">
        ����3-˫</td><input name="x_orders_p[]"  value="<?php echo ($rate3['˫'][1]-$abcd_rate);?>" type="hidden">
      <td align="center" height="25"><span id="bl9" class="multiple_Red synchro_rate9"><?php if($tezhengma) echo ($rate3['˫'][1]-$abcd_rate);else  echo '-';?></span></td>
      <td bordercolor="cccccc" align="center" height="25" nowrap="nowrap"><input name="gagex7" value="����4-˫" type="radio" <?php if($rate4['˫'][2]==1 || $rate_admin4['˫'][2]==1 || $tezhengma==0){ echo  'disabled';}?> onClick="get_synchro_rate('66','˫','10',<?php echo $u_id;?>,<?php echo $abcd_rate;?>);">
        ����4-˫</td><input name="x_orders_p[]"  value="<?php echo ($rate4['˫'][1]-$abcd_rate);?>" type="hidden">
      <td align="center" height="25"><span id="bl13" class="multiple_Red synchro_rate10"><?php if($tezhengma) echo ($rate4['˫'][1]-$abcd_rate);else  echo '-';?></span></td>
      <td bordercolor="cccccc" align="center" height="25" nowrap="nowrap"><input name="gagex9" value="����5-˫" type="radio" <?php if($rate5['˫'][2]==1 || $rate_admin5['˫'][2]==1 || $tezhengma==0){ echo  'disabled';}?> onClick="get_synchro_rate('67','˫','11',<?php echo $u_id;?>,<?php echo $abcd_rate;?>);">
        ����5-˫</td><input name="x_orders_p[]"  value="<?php echo ($rate5['˫'][1]-$abcd_rate);?>" type="hidden">
      <td align="center" height="25"><span id="bl17" class="multiple_Red synchro_rate11"><?php if($tezhengma) echo ($rate5['˫'][1]-$abcd_rate);else  echo '-';?></span></td>
      <td bordercolor="cccccc" align="center" height="25" nowrap="nowrap"><input name="gagex11" value="����6-˫" type="radio" <?php if($rate6['˫'][2]==1 || $rate_admin6['˫'][2]==1 || $tezhengma==0){ echo  'disabled';}?> onClick="get_synchro_rate('68','˫','12',<?php echo $u_id;?>,<?php echo $abcd_rate;?>);">
        ����6-˫</td><input name="x_orders_p[]"  value="<?php echo ($rate6['˫'][1]-$abcd_rate);?>" type="hidden">
      <td align="center" height="25"><span id="bl21" class="multiple_Red synchro_rate12"><?php if($tezhengma) echo ($rate6['˫'][1]-$abcd_rate);else  echo '-';?></span></td>
    </tr>
    <tr style="background-color: rgb(255, 255, 255);" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor='ffffff'" bgcolor="#FFFFFF">
      <td bordercolor="cccccc" align="center" height="25" nowrap="nowrap"><input name="gagex2" value="����1-��" type="radio" <?php if($rate['��'][2]==1 || $rate_admin['��'][2]==1 || $tezhengma==0){ echo  'disabled';}?> onClick="get_synchro_rate('63','��','13',<?php echo $u_id;?>,<?php echo $abcd_rate;?>);">
        ����1-��</td>
        <input name="x_orders_p[]"  value="<?php echo ($rate['��'][1]-$abcd_rate);?>" type="hidden">
      <td align="center" height="25"><span id="bl2" class="multiple_Red synchro_rate13"><?php if($tezhengma) echo ($rate['��'][1]-$abcd_rate);else  echo '-';?></span></td>
      <td bordercolor="cccccc" align="center" height="25" nowrap="nowrap"><input name="gagex4" value="����2-��" type="radio" <?php if($rate2['��'][2]==1 || $rate_admin2['��'][2]==1 || $tezhengma==0){ echo  'disabled';}?> onClick="get_synchro_rate('64','��','14',<?php echo $u_id;?>,<?php echo $abcd_rate;?>);">
        ����2-��</td>
      <input name="x_orders_p[]"  value="<?php echo ($rate2['��'][1]-$abcd_rate);?>" type="hidden">
      <td align="center" height="25"><span id="bl6" class="multiple_Red synchro_rate14"><?php if($tezhengma) echo ($rate2['��'][1]-$abcd_rate);else  echo '-';?></span></td>
      <td bordercolor="cccccc" align="center" height="25" nowrap="nowrap"><input name="gagex6" value="����3-��" type="radio" <?php if($rate3['��'][2]==1 || $rate_admin3['��'][2]==1 || $tezhengma==0){ echo  'disabled';}?> onClick="get_synchro_rate('65','��','15',<?php echo $u_id;?>,<?php echo $abcd_rate;?>);">
        ����3-��</td>
      <input name="x_orders_p[]"  value="<?php echo ($rate3['��'][1]-$abcd_rate);?>" type="hidden">
      <td align="center" height="25"><span id="bl10" class="multiple_Red synchro_rate15"><?php if($tezhengma) echo ($rate3['��'][1]-$abcd_rate);else  echo '-';?></span></td>
      <td bordercolor="cccccc" align="center" height="25" nowrap="nowrap"><input name="gagex8" value="����4-��" type="radio" <?php if($rate4['��'][2]==1 || $rate_admin4['��'][2]==1 || $tezhengma==0){ echo  'disabled';}?> onClick="get_synchro_rate('66','��','16',<?php echo $u_id;?>,<?php echo $abcd_rate;?>);">
        ����4-��</td>
      <input name="x_orders_p[]"  value="<?php echo ($rate4['��'][1]-$abcd_rate);?>" type="hidden">
      <td align="center" height="25"><span id="bl14" class="multiple_Red synchro_rate16"><?php if($tezhengma) echo ($rate4['��'][1]-$abcd_rate);else  echo '-';?></span></td>
      <td bordercolor="cccccc" align="center" height="25" nowrap="nowrap"><input name="gagex10" value="����5-��" type="radio" <?php if($rate5['��'][2]==1 || $rate_admin5['��'][2]==1 || $tezhengma==0){ echo  'disabled';}?> onClick="get_synchro_rate('67','��','17',<?php echo $u_id;?>,<?php echo $abcd_rate;?>);">
        ����5-��</td>
      <input name="x_orders_p[]"  value="<?php echo ($rate5['��'][1]-$abcd_rate);?>" type="hidden">
      <td align="center" height="25"><span id="bl18" class="multiple_Red synchro_rate17"><?php if($tezhengma) echo ($rate5['��'][1]-$abcd_rate);else  echo '-';?></span></td>
      <td bordercolor="cccccc" align="center" height="25" nowrap="nowrap"><input name="gagex12" value="����6-��" type="radio" <?php if($rate6['��'][2]==1 || $rate_admin6['��'][2]==1 || $tezhengma==0){ echo  'disabled';}?> onClick="get_synchro_rate('68','��','18',<?php echo $u_id;?>,<?php echo $abcd_rate;?>);">
        ����6-��</td>
      <input name="x_orders_p[]"  value="<?php echo ($rate6['��'][1]-$abcd_rate);?>" type="hidden">
      <td align="center" height="25"><span id="bl22" class="multiple_Red synchro_rate18"><?php if($tezhengma) echo ($rate6['��'][1]-$abcd_rate);else  echo '-';?></span></td>
    </tr>
    <tr style="background-color: rgb(255, 255, 255);" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor='ffffff'" bgcolor="#FFFFFF">
      <td bordercolor="cccccc" align="center" height="25" nowrap="nowrap"><input name="gagex2" value="����1-С" type="radio" <?php if($rate['С'][2]==1 || $rate_admin['С'][2]==1 || $tezhengma==0){ echo  'disabled';}?> onClick="get_synchro_rate('63','С','19',<?php echo $u_id;?>,<?php echo $abcd_rate;?>);">
        ����1-С</td>
        <input name="x_orders_p[]"  value="<?php echo ($rate['С'][1]-$abcd_rate);?>" type="hidden">
      <td align="center" height="25"><span id="bl3" class="multiple_Red synchro_rate19"><?php if($tezhengma) echo ($rate['С'][1]-$abcd_rate);else  echo '-';?></span></td>
      <td bordercolor="cccccc" align="center" height="25" nowrap="nowrap"><input name="gagex4" value="����2-С" type="radio" <?php if($rate2['С'][2]==1 || $rate_admin2['С'][2]==1 || $tezhengma==0){ echo  'disabled';}?> onClick="get_synchro_rate('64','С','20',<?php echo $u_id;?>,<?php echo $abcd_rate;?>);">
        ����2-С</td>
      <input name="x_orders_p[]"  value="<?php echo ($rate2['С'][1]-$abcd_rate);?>" type="hidden">
      <td align="center" height="25"><span id="bl7" class="multiple_Red synchro_rate20"><?php if($tezhengma) echo ($rate2['С'][1]-$abcd_rate);else  echo '-';?></span></td>
      <td bordercolor="cccccc" align="center" height="25" nowrap="nowrap"><input name="gagex6" value="����3-С" type="radio" <?php if($rate3['С'][2]==1 || $rate_admin3['С'][2]==1 || $tezhengma==0){ echo  'disabled';}?> onClick="get_synchro_rate('65','С','21',<?php echo $u_id;?>,<?php echo $abcd_rate;?>);">
        ����3-С</td>
      <input name="x_orders_p[]"  value="<?php echo ($rate3['С'][1]-$abcd_rate);?>" type="hidden">
      <td align="center" height="25"><span id="bl11" class="multiple_Red synchro_rate21"><?php if($tezhengma) echo ($rate3['С'][1]-$abcd_rate);else  echo '-';?></span></td>
      <td bordercolor="cccccc" align="center" height="25" nowrap="nowrap"><input name="gagex8" value="����4-С" type="radio" <?php if($rate4['С'][2]==1 || $rate_admin4['С'][2]==1 || $tezhengma==0){ echo  'disabled';}?> onClick="get_synchro_rate('66','С','22',<?php echo $u_id;?>,<?php echo $abcd_rate;?>);">
        ����4-С</td>
      <input name="x_orders_p[]"  value="<?php echo ($rate4['С'][1]-$abcd_rate);?>" type="hidden">
      <td align="center" height="25"><span id="bl15" class="multiple_Red synchro_rate22"><?php if($tezhengma) echo ($rate4['С'][1]-$abcd_rate);else  echo '-';?></span></td>
      <td bordercolor="cccccc" align="center" height="25" nowrap="nowrap"><input name="gagex10" value="����5-С" type="radio" <?php if($rate5['С'][2]==1 || $rate_admin5['С'][2]==1 || $tezhengma==0){ echo  'disabled';}?> onClick="get_synchro_rate('67','С','23',<?php echo $u_id;?>,<?php echo $abcd_rate;?>);">
        ����5-С</td>
      <input name="x_orders_p[]"  value="<?php echo ($rate5['С'][1]-$abcd_rate);?>" type="hidden">
      <td align="center" height="25"><span id="bl19" class="multiple_Red synchro_rate23"><?php if($tezhengma) echo ($rate5['С'][1]-$abcd_rate);else  echo '-';?></span></td>
      <td bordercolor="cccccc" align="center" height="25" nowrap="nowrap"><input name="gagex12" value="����6-С" type="radio" <?php if($rate6['С'][2]==1 || $rate_admin6['С'][2]==1 || $tezhengma==0){ echo  'disabled';}?> onClick="get_synchro_rate('68','С','24',<?php echo $u_id;?>,<?php echo $abcd_rate;?>);">
        ����6-С</td>
      <input name="x_orders_p[]"  value="<?php echo ($rate6['С'][1]-$abcd_rate);?>" type="hidden">
      <td align="center" height="25"><span id="bl23" class="multiple_Red synchro_rate24"><?php if($tezhengma) echo ($rate6['С'][1]-$abcd_rate);else  echo '-';?></span></td>
    </tr>
    <tr style="background-color: rgb(255, 255, 255);" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor='ffffff'" id="cc6699" bgcolor="#FFFFFF">
      <td colspan="12" bordercolor="cccccc" align="center" height="25"><table border="0" cellpadding="0" cellspacing="0" width="200">
        <tbody><tr>
          <td align="right">��ע��</td>
          <td><span id="gold1"><input onKeyPress="return CheckKey();"  style="height: 18px;" size="6" name="x_orders_y[]" class="inp1"></span></td>
          <td><input name="btnSubmit" class="btn2"  id="btnSubmit" value="��ע" type="Submit" <?php if(empty($tezhengma)){ echo 'disabled';}?>></td>
        </tr>
      </tbody></table></td>
    </tr></form>
   
  </tbody></table>
  <input value="0" name="gold_all" type="hidden"> <input value="0" name="allgold" type="hidden"> <input value="0" name="total_gold" type="hidden">
            
                
                            </div>
            <!-- �Y��  -->
			
			
			

<script language="javascript">
var normalelapse = 1000;
var nextelapse = normalelapse;
var counter; 
var startTime;
var ClockTime_C = "00:00:00";
var ClockTime_O = "00:00:00"; 
var finish = "00:00:00";
var timer = null;



// �_ʼ�\��
function Run_onTimer() {
  counter = 0;
  // ��ʼ���_ʼ�r�g
  startTime = new Date().valueOf();
  
  document.getElementById("hClockTime_C").innerHTML=ClockTime_C.substr(0);
  //document.getElementById("hClockTime_O").innerHTML=ClockTime_O.substr(0);

  // nextelapse�Ƕ��r�r�g, ��ʼ�r��1000����
  // �]��setInterval����: �r�g��ȥnextelapse(����)��, onTimer���_ʼ����
  timer = window.setInterval("onTimer()", nextelapse); 
}

rnd.today=new Date(); 
rnd.seed=rnd.today.getTime(); 
function rnd() { 
    rnd.seed = (rnd.seed*9301+49297) % 233280; 
    return rnd.seed/(233280.0); 
}
function rand(number) { 
    return Math.ceil(rnd()*number); 
}

function dj_Timer(t_Time){
    var hms = new String(t_Time).split(":");
	var s = new Number(hms[2]);
	var m = new Number(hms[1]);
	var h = new Number(hms[0]);
  
	s -= 1;
    if (s < 0){
        s = 59;
        m -= 1;
    }
	  
    if (m < 0){
        m = 59;
        h -= 1;
    }
	
	var ss = s < 10 ? ("0" + s) : s;
	var sm = m < 10 ? ("0" + m) : m;
	var sh = h < 10 ? ("0" + h) : h;
	
	return sh + ":" + sm + ":" + ss;
}

function Time_To_Sender(t_Time){
    var hms = new String(t_Time).split(":");
	var s = new Number(hms[2]);
	var m = new Number(hms[1]);
	var h = new Number(hms[0]);

	return ((h * 60) * 60) + (m * 60) + s;
}

// ��Ӌ�r����
function onTimer(){

	if (ClockTime_O == finish){//�r�g����ˢ�����
        return;
	}
	//alert(ClockTime_O)
	if (ClockTime_C != finish) {
	    ClockTime_C=dj_Timer(ClockTime_C);
		
	    document.getElementById("hClockTime_C").innerHTML=ClockTime_C.substr(0);
	    
	    if (ClockTime_C == finish) {
			//quick5();
            //var objTD, i = 0
            //var objTDs = document.getElementsByTagName("td");
            //while (objTD = objTDs.item(i++)) {
                //if (objTD.id.substr(0,6)=="jeu_p_"){
                   // objTD.innerHTML="<span class='multiple_Red'>-</span>";
               // } else if (objTD.id.substr(0,6)=="jeu_m_"){
                   // objTD.innerHTML="��P";
               // }
            //}
        }
	}
	if (ClockTime_O != finish) {
		
	    ClockTime_O=dj_Timer(ClockTime_O);
		
		
		if (ClockTime_O == finish) {
			//quick5();
		}
		
	   // document.getElementById("hClockTime_O").innerHTML=ClockTime_O.substr(0);
	}

    if (Time_To_Sender(ClockTime_O)==0) t_Update_Time=rand(10) + 1;
	
	// �����һ�εĶ��r��
	window.clearInterval(timer);
	
	// ��У�ϵ�y�r�g�õ��r�g��, �K�ɴ˵õ��´������ӵ��¶��r���ĕr�gnextelapse
	counter++; 
	var counterSecs = counter * 1000;
	var elapseSecs = new Date().valueOf() - startTime;
	var diffSecs = counterSecs - elapseSecs;
	nextelapse = normalelapse + diffSecs;
	if (nextelapse < 0) nextelapse = 0;
	
	// �����µĶ��r��
	timer = window.setInterval("onTimer()", nextelapse); 
}



ClockTime_C="<?php echo  $bbbccc.":".$ddd.":".$eee;?>";
ClockTime_O="<?php echo  $bbbccc.":".$ddd.":".$eee;?>";

Run_onTimer();
 
 </script>
</body></html>