<?php
include_once ('../global.php');
$db = new rate($mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset); //���ݿ������.


    $tiaojian_pan="o_typename='һФ'";
    $tiaojian_pan2="o_typename='β��'";

//$x=array('��','ţ','��','��','��','��','��','��','��','��','��','��');

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

$rate_admin=$db->get_rate(44,1);
$rate_admin2=$db->get_rate(50,1);
$rate=$db->get_rate(44,$u_id);
$rate2=$db->get_rate(50,$u_id);
$anmail=$db->get_animal_table();
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
     if($gunqiufengpan_other==0 && $qishu[is_special] && strtotime($qishu[special_time_end])>time() && strtotime($qishu[plate_time_satrt])<= time() && time()<strtotime($qishu[plate_time_end]) && $qishu[is_plate_start]==0){
         $tezhengma=1;
     }
     $tezhengma_time=$qishu['special_time_end'];
            
//��ǰ�û���Ϣ
$myusers=  $db->select("users", "*", "user_id={$_SESSION['uid'.$c_p_seesion]}");
$myuser = $db->fetch_array($myusers);


//ABCD���л�����
$o_pan=$_GET['pan'];
if($o_pan=="")$o_pan="A";



//����
$onlyabcds=  $db->select("abcd_rate", "*", "$tiaojian_pan");
$onlyabcd = $db->fetch_array($onlyabcds);
$abcd_rate=0;
if($o_pan=="B"){
   $abcd_rate=$onlyabcd['ab_rate']; 
}elseif($o_pan=="C"){
   $abcd_rate=$onlyabcd['ac_rate'];   
}elseif($o_pan=="D"){
   $abcd_rate=$onlyabcd['ad_rate']; 
}

$onlyabcds2=  $db->select("abcd_rate", "*", "$tiaojian_pan2");
$onlyabcd2 = $db->fetch_array($onlyabcds2);
$abcd_rate2=0;
if($o_pan=="B"){
   $abcd_rate2=$onlyabcd2['ab_rate']; 
}elseif($o_pan=="C"){
   $abcd_rate2=$onlyabcd2['ac_rate'];   
}elseif($o_pan=="D"){
   $abcd_rate2=$onlyabcd2['ad_rate']; 
}

if($_POST['btnSubmit']=="��ע"){
    $x_o_type3 =  implode('=_=',$_POST[x_o_type3]);
    $x_orders_y =  implode('=_=',$_POST[x_orders_y]);
    $x_orders_p =  implode('=_=',$_POST[x_orders_p]);

$orders_tixing=$db->get_orders_tixing($qishu['plate_num'],$o_pan,'һФβ��','һФ',$_POST[x_o_type3],$_POST[x_orders_y],$_POST[x_orders_p],0,0,"");    

    echo " <script>if(confirm('$orders_tixing[0]')){ 
   window.location.href='qws.php?pan=$o_pan&x_orders_y_i=$orders_tixing[1]&x_plate_num=$qishu[plate_num]&x_abcd_h=$o_pan&x_o_type1=һФβ��&x_o_type2=һФ&x_o_type3=$x_o_type3&x_orders_y=$x_orders_y&x_orders_p=$x_orders_p';
       }
else 
  { 
  
    }</script>";      
//$db->get_orders($qishu['plate_num'],$o_pan,'һФβ��','һФ',$_POST[x_o_type3],$_POST[x_orders_y],$_POST[x_orders_p],0,0,""); 
}

if($_GET[x_orders_y_i]>0){

    $db->get_orders($_GET[x_orders_y_i],$_GET[x_plate_num],$_GET[x_abcd_h],'һФβ��','һФ',explode('=_=',$_GET[x_o_type3]),explode('=_=',$_GET[x_orders_y]),explode('=_=',$_GET[x_orders_p]),0,0,"");

}
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
        var url = 'qws.php';
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
                      <td class="F_bold" nowrap="nowrap"><b id="t_LID" class="Font_G"><?php echo $qishu['plate_num'];?></b>�� <b class="font_b"><span id="ftm1">һФβ��</span>&nbsp;&nbsp;&nbsp;&nbsp;
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
<!-- �_ʼ  --><div id="result">  <form name="lt_form" id="lt_form" method="post" action="">          
<input name="fpsess" type="hidden" value="<?php echo $_SESSION["fsess"]; ?>" />
<!-- ���������ʱ�� -->
<input name="faction" type="hidden" value="submit" />   
                <table class="Ball_List Tab"  bgcolor="ffffff" border="0" bordercolor="f1f1f1" cellpadding="0" cellspacing="1" width="780">
                         
                          <tbody><tr class="td_caption_1">
                            <td bordercolor="cccccc" bgcolor="#DFEFFF" nowrap="nowrap" width="50"><div align="center">һФ</div></td>
                            <td bordercolor="cccccc" align="center" bgcolor="#DFEFFF" nowrap="nowrap" width="80">�r��</td>
                            <td bordercolor="cccccc" align="center" bgcolor="#DFEFFF" nowrap="nowrap" width="80">���~</td>
                            <td bordercolor="cccccc" bgcolor="#DFEFFF" nowrap="nowrap" width="50%"><div align="center">����</div></td>
                            <td bordercolor="cccccc" bgcolor="#DFEFFF" nowrap="nowrap" width="50"><div align="center">һФ</div></td>
                            <td bordercolor="cccccc" align="center" bgcolor="#DFEFFF" nowrap="nowrap" width="80">�r��</td>
                            <td bordercolor="cccccc" align="center" bgcolor="#DFEFFF" nowrap="nowrap" width="80">���~</td>
                            <td bordercolor="cccccc" bgcolor="#DFEFFF" nowrap="nowrap" width="50%"><div align="center">����</div></td>
                          </tr>
				  
                                                    <tr onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor='ffffff'" bgcolor="#FFFFFF">
						   <td bordercolor="cccccc" align="center" height="25" width="50">
				 
			  ��			  </td>
                            <td align="center" height="25"><span id="bl0" class="multiple_Red synchro_rate1"><?php if($tezhengma) echo ($rate['��'][1]-$abcd_rate);else  echo '-';?></span></td>
			<input name="x_o_type3[]"  value="��" type="hidden">
                            <input name="x_orders_p[]"  value="<?php echo ($rate['��'][1]-$abcd_rate);?>" type="hidden">			    
                            <td align="center"><span id="gold0">
                                    <?php if($tezhengma){ ?>
                                    <?php if($rate['��'][2]==1 || $rate_admin['��'][2]==1){ echo  '<input name="x_orders_y[]"  value="" type="hidden">���';}else{?>
                                    <input onKeyPress="return CheckKey();" onClick="get_synchro_rate('44','��','1',<?php echo $u_id;?>,<?php echo $abcd_rate;?>);" style="height: 18px;" size="6" name="x_orders_y[]" class="inp1">
                                    <?php }?>  
                                        <?php }else{ echo '����';}?>   
                                </span></td>
						    <td bordercolor="cccccc" align="center" height="25">
							<table align="left" border="0" cellpadding="0" cellspacing="0">
							  <tbody>
                                                              <tr>  
                                                                  <?php foreach(explode(',', trim($anmail['��'],',')) as $hm){?>
                                                                  <td class="ball_<?php echo $db->get_color($hm);?>" align="center" height="32" width="32"><?php echo $hm;?></td>         
                                                                  <?php }?>
    						              </tr>
                                                          </tbody>
                                                        </table>
                                                    </td>                        
						  
						  <td bordercolor="cccccc" align="center" height="25" width="50">
				 
			  ţ			  </td>
                            <td align="center" height="25"><span id="bl6" class="multiple_Red synchro_rate2"><?php if($tezhengma) echo ($rate['ţ'][1]-$abcd_rate);else  echo '-';?></span></td>
			<input name="x_o_type3[]"  value="ţ" type="hidden">
                            <input name="x_orders_p[]"  value="<?php echo ($rate['ţ'][1]-$abcd_rate);?>" type="hidden">			    
                            <td align="center"><span id="gold6">
                                    <?php if($tezhengma){ ?>
                                    <?php if($rate['ţ'][2]==1 || $rate_admin['ţ'][2]==1){ echo  '<input name="x_orders_y[]"  value="" type="hidden">���';}else{?>
                                    <input onKeyPress="return CheckKey();" onClick="get_synchro_rate('44','ţ','2',<?php echo $u_id;?>,<?php echo $abcd_rate;?>);" style="height: 18px;" size="6" name="x_orders_y[]" class="inp1">
                                    <?php }?>   
                                        <?php }else{ echo '����';}?>   
                                </span></td>
						    <td bordercolor="cccccc" align="center" height="25">
							<table align="left" border="0" cellpadding="0" cellspacing="0">
							  <tbody>
                                                              <tr>  
                                                                  <?php foreach(explode(',', trim($anmail['ţ'],',')) as $hm2){?>
                                                                  <td class="ball_<?php echo $db->get_color($hm2);?>" align="center" height="32" width="32"><?php echo $hm2;?></td>         
                                                                  <?php }?>
    						              </tr>
                                                          </tbody>
                                                        </table>
                                                    </td>
                          </tr>
					                               <tr onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor='ffffff'" bgcolor="#FFFFFF">
						   <td bordercolor="cccccc" align="center" height="25" width="50">
				 
			  ��			  </td>
                            <td align="center" height="25"><span id="bl1" class="multiple_Red synchro_rate3"><?php if($tezhengma) echo ($rate['��'][1]-$abcd_rate);else  echo '-';?></span></td>
			<input name="x_o_type3[]"  value="��" type="hidden">
                            <input name="x_orders_p[]"  value="<?php echo ($rate['��'][1]-$abcd_rate);?>" type="hidden">			    
                            <td align="center"><span id="gold1">
                                    <?php if($tezhengma){ ?>
                                    <?php if($rate['��'][2]==1 || $rate_admin['��'][2]==1){ echo  '<input name="x_orders_y[]"  value="" type="hidden">���';}else{?>
                                    <input onKeyPress="return CheckKey();" onClick="get_synchro_rate('44','��','3',<?php echo $u_id;?>,<?php echo $abcd_rate;?>);" style="height: 18px;" size="6" name="x_orders_y[]" class="inp1">
                                    <?php }?>  
                                        <?php }else{ echo '����';}?>   
                                </span></td>
						    <td bordercolor="cccccc" align="center" height="25">
							<table align="left" border="0" cellpadding="0" cellspacing="0">
							  <tbody>
                                                              <tr>  
                                                                  <?php foreach(explode(',', trim($anmail['��'],',')) as $hm3){?>
                                                                  <td class="ball_<?php echo $db->get_color($hm3);?>" align="center" height="32" width="32"><?php echo $hm3;?></td>         
                                                                  <?php }?>
    						              </tr>
                                                          </tbody>
                                                        </table>
                                                    </td>
                            
                          
						  
						  <td bordercolor="cccccc" align="center" height="25" width="50">
				 
			  ��			  </td>
                            <td align="center" height="25"><span id="bl7" class="multiple_Red synchro_rate4"><?php if($tezhengma) echo ($rate['��'][1]-$abcd_rate);else  echo '-';?></span></td>
			<input name="x_o_type3[]"  value="��" type="hidden">
                            <input name="x_orders_p[]"  value="<?php echo ($rate['��'][1]-$abcd_rate);?>" type="hidden">			    
                            <td align="center"><span id="gold7">
                                    <?php if($tezhengma){ ?>
                                    <?php if($rate['��'][2]==1 || $rate_admin['��'][2]==1){ echo  '<input name="x_orders_y[]"  value="" type="hidden">���';}else{?>
                                    <input onKeyPress="return CheckKey();" onClick="get_synchro_rate('44','��','4',<?php echo $u_id;?>,<?php echo $abcd_rate;?>);" style="height: 18px;" size="6" name="x_orders_y[]" class="inp1">
                                    <?php }?> 
                                        <?php }else{ echo '����';}?>   
                                </span></td>
						    <td bordercolor="cccccc" align="center" height="25">
							<table align="left" border="0" cellpadding="0" cellspacing="0">
							  <tbody>
                                                              <tr>  
                                                                  <?php foreach(explode(',', trim($anmail['��'],',')) as $hm4){?>
                                                                  <td class="ball_<?php echo $db->get_color($hm4);?>" align="center" height="32" width="32"><?php echo $hm4;?></td>         
                                                                  <?php }?>
    						              </tr>
                                                          </tbody>
                                                        </table>
                                                    </td>
                          </tr>
					                               <tr onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor='ffffff'" bgcolor="#FFFFFF">
						   <td bordercolor="cccccc" align="center" height="25" width="50">
				 
			  ��			  </td>
                            <td align="center" height="25"><span id="bl2" class="multiple_Red synchro_rate5"><?php if($tezhengma) echo ($rate['��'][1]-$abcd_rate);else  echo '-';?></span></td>
			<input name="x_o_type3[]"  value="��" type="hidden">
                            <input name="x_orders_p[]"  value="<?php echo ($rate['��'][1]-$abcd_rate);?>" type="hidden">			    
                            <td align="center"><span id="gold2">
                                    <?php if($tezhengma){ ?>
                                    <?php if($rate['��'][2]==1 || $rate_admin['��'][2]==1){ echo  '<input name="x_orders_y[]"  value="" type="hidden">���';}else{?>
                                    <input onKeyPress="return CheckKey();" onClick="get_synchro_rate('44','��','5',<?php echo $u_id;?>,<?php echo $abcd_rate;?>);" style="height: 18px;" size="6" name="x_orders_y[]" class="inp1">
                                    <?php }?> 
                                        <?php }else{ echo '����';}?>   
                                </span></td>
						    <td bordercolor="cccccc" align="center" height="25">
							<table align="left" border="0" cellpadding="0" cellspacing="0">
							  <tbody>
                                                              <tr>  
                                                                  <?php foreach(explode(',', trim($anmail['��'],',')) as $hm5){?>
                                                                  <td class="ball_<?php echo $db->get_color($hm5);?>" align="center" height="32" width="32"><?php echo $hm5;?></td>         
                                                                  <?php }?>
    						              </tr>
                                                          </tbody>
                                                        </table>
                                                    </td>
                            
                          
						  
						  <td bordercolor="cccccc" align="center" height="25" width="50">
				 
			  ��			  </td>
                            <td align="center" height="25"><span id="bl8" class="multiple_Red synchro_rate6"><?php if($tezhengma) echo ($rate['��'][1]-$abcd_rate);else  echo '-';?></span></td>
			<input name="x_o_type3[]"  value="��" type="hidden">
                            <input name="x_orders_p[]"  value="<?php echo ($rate['��'][1]-$abcd_rate);?>" type="hidden">			    
                            <td align="center"><span id="gold8">
                                    <?php if($tezhengma){ ?>
                                    <?php if($rate['��'][2]==1 || $rate_admin['��'][2]==1){ echo  '<input name="x_orders_y[]"  value="" type="hidden">���';}else{?>
                                    <input onKeyPress="return CheckKey();" onClick="get_synchro_rate('44','��','6',<?php echo $u_id;?>,<?php echo $abcd_rate;?>);" style="height: 18px;" size="6" name="x_orders_y[]" class="inp1">
                                    <?php }?>  
                                        <?php }else{ echo '����';}?>   
                                </span></td>
						    <td bordercolor="cccccc" align="center" height="25">
							<table align="left" border="0" cellpadding="0" cellspacing="0">
							  <tbody>
                                                              <tr>  
                                                                  <?php foreach(explode(',', trim($anmail['��'],',')) as $hm6){?>
                                                                  <td class="ball_<?php echo $db->get_color($hm6);?>" align="center" height="32" width="32"><?php echo $hm6;?></td>         
                                                                  <?php }?>
    						              </tr>
                                                          </tbody>
                                                        </table>
                                                    </td>
                          </tr>
					                               <tr onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor='ffffff'" bgcolor="#FFFFFF">
						   <td bordercolor="cccccc" align="center" height="25" width="50">
				 
			  ��			  </td>
                            <td align="center" height="25"><span id="bl3" class="multiple_Red synchro_rate7"><?php if($tezhengma) echo ($rate['��'][1]-$abcd_rate);else  echo '-';?></span></td>
			<input name="x_o_type3[]"  value="��" type="hidden">
                            <input name="x_orders_p[]"  value="<?php echo ($rate['��'][1]-$abcd_rate);?>" type="hidden">			   
                            <td align="center"><span id="gold3">
                                    <?php if($tezhengma){ ?>
                                    <?php if($rate['��'][2]==1 || $rate_admin['��'][2]==1){ echo  '<input name="x_orders_y[]"  value="" type="hidden">���';}else{?>
                                    <input onKeyPress="return CheckKey();" onClick="get_synchro_rate('44','��','7',<?php echo $u_id;?>,<?php echo $abcd_rate;?>);" style="height: 18px;" size="6" name="x_orders_y[]" class="inp1">
                                    <?php }?>   
                                        <?php }else{ echo '����';}?>   
                                </span></td>
						    <td bordercolor="cccccc" align="center" height="25">
							<table align="left" border="0" cellpadding="0" cellspacing="0">
							  <tbody>
                                                              <tr>  
                                                                  <?php foreach(explode(',', trim($anmail['��'],',')) as $hm7){?>
                                                                  <td class="ball_<?php echo $db->get_color($hm7);?>" align="center" height="32" width="32"><?php echo $hm7;?></td>         
                                                                  <?php }?>
    						              </tr>
                                                          </tbody>
                                                        </table>
                                                    </td>
                            
                          
						  
						  <td bordercolor="cccccc" align="center" height="25" width="50">
				 
			  ��			  </td>
                            <td align="center" height="25"><span id="bl9" class="multiple_Red synchro_rate8"><?php if($tezhengma) echo ($rate['��'][1]-$abcd_rate);else  echo '-';?></span></td>
			<input name="x_o_type3[]"  value="��" type="hidden">
                            <input name="x_orders_p[]"  value="<?php echo ($rate['��'][1]-$abcd_rate);?>" type="hidden">			   
                            <td align="center"><span id="gold9">
                                    <?php if($tezhengma){ ?>
                                    <?php if($rate['��'][2]==1 || $rate_admin['��'][2]==1){ echo  '<input name="x_orders_y[]"  value="" type="hidden">���';}else{?>
                                    <input onKeyPress="return CheckKey();" onClick="get_synchro_rate('44','��','8',<?php echo $u_id;?>,<?php echo $abcd_rate;?>);" style="height: 18px;" size="6" name="x_orders_y[]" class="inp1">
                                    <?php }?>   
                                        <?php }else{ echo '����';}?>   
                                </span></td>
						    <td bordercolor="cccccc" align="center" height="25">
							<table align="left" border="0" cellpadding="0" cellspacing="0">
							  <tbody>
                                                              <tr>  
                                                                  <?php foreach(explode(',', trim($anmail['��'],',')) as $hm8){?>
                                                                  <td class="ball_<?php echo $db->get_color($hm8);?>" align="center" height="32" width="32"><?php echo $hm8;?></td>         
                                                                  <?php }?>
    						              </tr>
                                                          </tbody>
                                                        </table>
                                                    </td>
                          </tr>
					                               <tr onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor='ffffff'" bgcolor="#FFFFFF">
						   <td bordercolor="cccccc" align="center" height="25" width="50">
				 
			  ��			  </td>
                            <td align="center" height="25"><span id="bl4" class="multiple_Red synchro_rate9"><?php if($tezhengma) echo ($rate['��'][1]-$abcd_rate);else  echo '-';?></span></td>
			<input name="x_o_type3[]"  value="��" type="hidden">
                            <input name="x_orders_p[]"  value="<?php echo ($rate['��'][1]-$abcd_rate);?>" type="hidden">			    
                            <td align="center"><span id="gold4">
                                    <?php if($tezhengma){ ?>
                                    <?php if($rate['��'][2]==1 || $rate_admin['��'][2]==1){ echo  '<input name="x_orders_y[]"  value="" type="hidden">���';}else{?>
                                    <input onKeyPress="return CheckKey();" onClick="get_synchro_rate('44','��','9',<?php echo $u_id;?>,<?php echo $abcd_rate;?>);" style="height: 18px;" size="6" name="x_orders_y[]" class="inp1">
                                    <?php }?>  
                                        <?php }else{ echo '����';}?>   
                                </span></td>
						    <td bordercolor="cccccc" align="center" height="25">
							<table align="left" border="0" cellpadding="0" cellspacing="0">
							  <tbody>
                                                              <tr>  
                                                                  <?php foreach(explode(',', trim($anmail['��'],',')) as $hm9){?>
                                                                  <td class="ball_<?php echo $db->get_color($hm9);?>" align="center" height="32" width="32"><?php echo $hm9;?></td>         
                                                                  <?php }?>
    						              </tr>
                                                          </tbody>
                                                        </table>
                                                    </td>
                            
                          
						  
						  <td bordercolor="cccccc" align="center" height="25" width="50">
				 
			  ��			  </td>
                            <td align="center" height="25"><span id="bl10" class="multiple_Red synchro_rate10"><?php if($tezhengma) echo ($rate['��'][1]-$abcd_rate);else  echo '-';?></span></td>
			<input name="x_o_type3[]"  value="��" type="hidden">
                            <input name="x_orders_p[]"  value="<?php echo ($rate['��'][1]-$abcd_rate);?>" type="hidden">			    
                            <td align="center"><span id="gold10">
                                    <?php if($tezhengma){ ?>
                                    <?php if($rate['��'][2]==1 || $rate_admin['��'][2]==1){ echo  '<input name="x_orders_y[]"  value="" type="hidden">���';}else{?>
                                    <input onKeyPress="return CheckKey();" onClick="get_synchro_rate('44','��','10',<?php echo $u_id;?>,<?php echo $abcd_rate;?>);" style="height: 18px;" size="6" name="x_orders_y[]" class="inp1">
                                    <?php }?> 
                                        <?php }else{ echo '����';}?>   
                                </span></td>
						    <td bordercolor="cccccc" align="center" height="25">
							<table align="left" border="0" cellpadding="0" cellspacing="0">
							  <tbody>
                                                              <tr>  
                                                                  <?php foreach(explode(',', trim($anmail['��'],',')) as $hm10){?>
                                                                  <td class="ball_<?php echo $db->get_color($hm10);?>" align="center" height="32" width="32"><?php echo $hm10;?></td>         
                                                                  <?php }?>
    						              </tr>
                                                          </tbody>
                                                        </table>
                                                    </td>
                          </tr>
					                               <tr style="background-color: rgb(255, 255, 255);" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor='ffffff'" bgcolor="#FFFFFF">
						   <td bordercolor="cccccc" align="center" height="25" width="50">
				 
			  ��			  </td>
                            <td align="center" height="25"><span id="bl5" class="multiple_Red synchro_rate11"><?php if($tezhengma) echo ($rate['��'][1]-$abcd_rate);else  echo '-';?></span></td>
			<input name="x_o_type3[]"  value="��" type="hidden">
                            <input name="x_orders_p[]"  value="<?php echo ($rate['��'][1]-$abcd_rate);?>" type="hidden">			   
                            <td align="center"><span id="gold5">
                                    <?php if($tezhengma){ ?>
                                    <?php if($rate['��'][2]==1 || $rate_admin['��'][2]==1){ echo  '<input name="x_orders_y[]"  value="" type="hidden">���';}else{?>
                                    <input onKeyPress="return CheckKey();" onClick="get_synchro_rate('44','��','11',<?php echo $u_id;?>,<?php echo $abcd_rate;?>);" style="height: 18px;" size="6" name="x_orders_y[]" class="inp1">
                                    <?php }?>
                                        <?php }else{ echo '����';}?>   
                                </span></td>
						    <td bordercolor="cccccc" align="center" height="25">
							<table align="left" border="0" cellpadding="0" cellspacing="0">
							  <tbody>
                                                              <tr>  
                                                                  <?php foreach(explode(',', trim($anmail['��'],',')) as $hm11){?>
                                                                  <td class="ball_<?php echo $db->get_color($hm11);?>" align="center" height="32" width="32"><?php echo $hm11;?></td>         
                                                                  <?php }?>
    						              </tr>
                                                          </tbody>
                                                        </table>
                                                    </td>
                            
                          
						  
						  <td bordercolor="cccccc" align="center" height="25" width="50">
				 
			  ��			  </td>
                            <td align="center" height="25"><span id="bl11" class="multiple_Red synchro_rate12"><?php if($tezhengma) echo ($rate['��'][1]-$abcd_rate);else  echo '-';?></span></td>
			<input name="x_o_type3[]"  value="��" type="hidden">
                            <input name="x_orders_p[]"  value="<?php echo ($rate['��'][1]-$abcd_rate);?>" type="hidden">			   
                            <td align="center"><span id="gold11">
                                    <?php if($tezhengma){ ?>
                                    <?php if($rate['��'][2]==1 || $rate_admin['��'][2]==1){ echo  '<input name="x_orders_y[]"  value="" type="hidden">���';}else{?>
                                    <input onKeyPress="return CheckKey();" onClick="get_synchro_rate('44','��','12',<?php echo $u_id;?>,<?php echo $abcd_rate;?>);" style="height: 18px;" size="6" name="x_orders_y[]" class="inp1">
                                    <?php }?>
                                        <?php }else{ echo '����';}?>   
                                </span></td>
						    <td bordercolor="cccccc" align="center" height="25">
							<table align="left" border="0" cellpadding="0" cellspacing="0">
							  <tbody>
                                                              <tr>  
                                                                  <?php foreach(explode(',', trim($anmail['��'],',')) as $hm12){?>
                                                                  <td class="ball_<?php echo $db->get_color($hm12);?>" align="center" height="32" width="32"><?php echo $hm12;?></td>         
                                                                  <?php }?>
    						              </tr>
                                                          </tbody>
                                                        </table>
                                                    </td>
                          </tr>
					      
  </tbody></table>
  
  
  <table class="Ball_List Tab" bgcolor="ffffff" border="0" bordercolor="f1f1f1" cellpadding="0" cellspacing="1" width="780">
                         
                          <tbody><tr class="td_caption_1">
                            <td bordercolor="cccccc" bgcolor="#DFEFFF" nowrap="nowrap" width="50"><div align="center">
                              β��
                          </div></td>
                            <td bordercolor="cccccc" align="center" bgcolor="#DFEFFF" nowrap="nowrap" width="80">�r��</td>
                            <td bordercolor="cccccc" align="center" bgcolor="#DFEFFF" nowrap="nowrap" width="80">���~</td>
                            <td bordercolor="cccccc" bgcolor="#DFEFFF" nowrap="nowrap" width="50%"><div align="center">����</div></td>
                            <td bordercolor="cccccc" bgcolor="#DFEFFF" nowrap="nowrap" width="50"><div align="center"> β�� </div></td>
                            <td bordercolor="cccccc" align="center" bgcolor="#DFEFFF" nowrap="nowrap" width="80">�r��</td>
                            <td bordercolor="cccccc" align="center" bgcolor="#DFEFFF" nowrap="nowrap" width="80">���~</td>
                            <td bordercolor="cccccc" bgcolor="#DFEFFF" nowrap="nowrap" width="50%"><div align="center">����</div></td>
                          </tr>
						  
                         
                                                    <tr style="background-color: rgb(255, 255, 255);" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor='ffffff'" bgcolor="#FFFFFF">
						   <td bordercolor="cccccc" align="center" height="25" width="50">
				 
			  0			  </td>
                            <td align="center" height="25"><span id="bl12" class="multiple_Red synchro_rate13"><?php if($tezhengma) echo ($rate2[0][1]-$abcd_rate2);else  echo '-';?></span></td>
			<input name="x_o_type3[]"  value="0" type="hidden">
                            <input name="x_orders_p[]"  value="<?php echo ($rate2[0][1]-$abcd_rate);?>" type="hidden">			    
                            <td align="center"><span id="gold12">
                                    <?php if($tezhengma){ ?>
                                    <?php if($rate2[0][2]==1 || $rate_admin2[0][2]==1){ echo  '<input name="x_orders_y[]"  value="" type="hidden">���';}else{?> 
                                    <input onKeyPress="return CheckKey();" onClick="get_synchro_rate('50','0','13',<?php echo $u_id;?>,<?php echo $abcd_rate;?>);" style="height: 18px;" size="6" name="x_orders_y[]" class="inp1">
                                <?php }?> 
                                    <?php }else{ echo '����';}?> 
                                </span></td>
						    <td bordercolor="cccccc" align="center" height="25">
							
							<table align="left" border="0" cellpadding="0" cellspacing="0">
							  <tbody><tr>    						<td class="ball_b" align="center" height="32" width="32">10</td>
    					    						<td class="ball_b" align="center" height="32" width="32">20</td>
    					    						<td class="ball_r" align="center" height="32" width="32">30</td>
    					    						<td class="ball_r" align="center" height="32" width="32">40</td>
    						</tr></tbody></table>							</td>
                            
                          
						  
						  <td bordercolor="cccccc" align="center" height="25" width="50">
				 
			  5			  </td>
                            <td align="center" height="25"><span id="bl17" class="multiple_Red synchro_rate14"><?php if($tezhengma) echo ($rate2[5][1]-$abcd_rate2);else  echo '-';?></span></td>
			<input name="x_o_type3[]"  value="5" type="hidden">
                            <input name="x_orders_p[]"  value="<?php echo ($rate2[5][1]-$abcd_rate);?>" type="hidden">	
                            <td align="center"><span id="gold17">
                                    <?php if($tezhengma){ ?>
                                    <?php if($rate2[5][2]==1 || $rate_admin2[5][2]==1){ echo  '<input name="x_orders_y[]"  value="" type="hidden">���';}else{?> 
                                    <input onKeyPress="return CheckKey();" onClick="get_synchro_rate('50','5','14',<?php echo $u_id;?>,<?php echo $abcd_rate;?>);" style="height: 18px;" size="6" name="x_orders_y[]" class="inp1">
                                <?php }?> 
                                    <?php }else{ echo '����';}?> 
                                </span></td>
						    <td bordercolor="cccccc" align="center" height="25">
							
							<table align="left" border="0" cellpadding="0" cellspacing="0">
							  <tbody><tr>    						<td class="ball_g" align="center" height="32" width="32">05</td>
    					    						<td class="ball_b" align="center" height="32" width="32">15</td>
    					    						<td class="ball_b" align="center" height="32" width="32">25</td>
    					    						<td class="ball_r" align="center" height="32" width="32">35</td>
    					    						<td class="ball_r" align="center" height="32" width="32">45</td>
    						</tr></tbody></table>							</td>
                          </tr>
					                               <tr style="background-color: rgb(255, 255, 255);" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor='ffffff'" bgcolor="#FFFFFF">
						   <td bordercolor="cccccc" align="center" height="25" width="50">
				 
			  1			  </td>
                            <td align="center" height="25"><span id="bl13" class="multiple_Red synchro_rate15"><?php if($tezhengma) echo ($rate2[1][1]-$abcd_rate2);else  echo '-';?></span></td>
			<input name="x_o_type3[]"  value="1" type="hidden">
                            <input name="x_orders_p[]"  value="<?php echo ($rate2[1][1]-$abcd_rate);?>" type="hidden">				    
                            <td align="center"><span id="gold13">
                                    <?php if($tezhengma){ ?>
                                    <?php if($rate2[1][2]==1 || $rate_admin2[1][2]==1){ echo  '<input name="x_orders_y[]"  value="" type="hidden">���';}else{?> 
                                    <input onKeyPress="return CheckKey();" onClick="get_synchro_rate('50','1','15',<?php echo $u_id;?>,<?php echo $abcd_rate;?>);" style="height: 18px;" size="6" name="x_orders_y[]" class="inp1">
                                <?php }?> 
                                    <?php }else{ echo '����';}?> 
                                </span></td>
						    <td bordercolor="cccccc" align="center" height="25">
							
							<table align="left" border="0" cellpadding="0" cellspacing="0">
							  <tbody><tr>    						<td class="ball_r" align="center" height="32" width="32">01</td>
    					    						<td class="ball_g" align="center" height="32" width="32">11</td>
    					    						<td class="ball_g" align="center" height="32" width="32">21</td>
    					    						<td class="ball_b" align="center" height="32" width="32">31</td>
    					    						<td class="ball_b" align="center" height="32" width="32">41</td>
    						</tr></tbody></table>							</td>
                            
                          
						  
						  <td bordercolor="cccccc" align="center" height="25" width="50">
				 
			  6			  </td>
                            <td align="center" height="25"><span id="bl18" class="multiple_Red synchro_rate16"><?php if($tezhengma) echo ($rate2[6][1]-$abcd_rate2);else  echo '-';?></span></td>
			<input name="x_o_type3[]"  value="6" type="hidden">
                            <input name="x_orders_p[]"  value="<?php echo ($rate2[6][1]-$abcd_rate);?>" type="hidden">				   
                            <td align="center"><span id="gold18">
                                    <?php if($tezhengma){ ?>
                                    <?php if($rate2[6][2]==1 || $rate_admin2[6][2]==1){ echo  '<input name="x_orders_y[]"  value="" type="hidden">���';}else{?> 
                                    <input onKeyPress="return CheckKey();" onClick="get_synchro_rate('50','6','16',<?php echo $u_id;?>,<?php echo $abcd_rate;?>);" style="height: 18px;" size="6" name="x_orders_y[]" class="inp1">
                                <?php }?> 
                                    <?php }else{ echo '����';}?> 
                                </span></td>
						    <td bordercolor="cccccc" align="center" height="25">
							
							<table align="left" border="0" cellpadding="0" cellspacing="0">
							  <tbody><tr>    						<td class="ball_g" align="center" height="32" width="32">06</td>
    					    						<td class="ball_g" align="center" height="32" width="32">16</td>
    					    						<td class="ball_b" align="center" height="32" width="32">26</td>
    					    						<td class="ball_b" align="center" height="32" width="32">36</td>
    					    						<td class="ball_r" align="center" height="32" width="32">46</td>
    						</tr></tbody></table>							</td>
                          </tr>
					                               <tr style="background-color: rgb(255, 255, 255);" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor='ffffff'" bgcolor="#FFFFFF">
						   <td bordercolor="cccccc" align="center" height="25" width="50">
				 
			  2			  </td>
                            <td align="center" height="25"><span id="bl14" class="multiple_Red synchro_rate17"><?php if($tezhengma) echo ($rate2[2][1]-$abcd_rate2);else  echo '-';?></span></td>
						<input name="x_o_type3[]"  value="2" type="hidden">
                            <input name="x_orders_p[]"  value="<?php echo ($rate2[2][1]-$abcd_rate);?>" type="hidden">	    
                            <td align="center"><span id="gold14">
                                    <?php if($tezhengma){ ?>
                                    <?php if($rate2[2][2]==1 || $rate_admin2[2][2]==1){ echo  '<input name="x_orders_y[]"  value="" type="hidden">���';}else{?> 
                                    <input onKeyPress="return CheckKey();" onClick="get_synchro_rate('50','2','17',<?php echo $u_id;?>,<?php echo $abcd_rate;?>);" style="height: 18px;" size="6" name="x_orders_y[]" class="inp1">
                                <?php }?> 
                                    <?php }else{ echo '����';}?> 
                                </span></td>
						    <td bordercolor="cccccc" align="center" height="25">
							
							<table align="left" border="0" cellpadding="0" cellspacing="0">
							  <tbody><tr>    						<td class="ball_r" align="center" height="32" width="32">02</td>
    					    						<td class="ball_r" align="center" height="32" width="32">12</td>
    					    						<td class="ball_g" align="center" height="32" width="32">22</td>
    					    						<td class="ball_g" align="center" height="32" width="32">32</td>
    					    						<td class="ball_b" align="center" height="32" width="32">42</td>
    						</tr></tbody></table>							</td>
                            
                          
						  
						  <td bordercolor="cccccc" align="center" height="25" width="50">
				 
			  7			  </td>
                            <td align="center" height="25"><span id="bl19" class="multiple_Red synchro_rate18"><?php if($tezhengma) echo ($rate2[7][1]-$abcd_rate2);else  echo '-';?></span></td>
			<input name="x_o_type3[]"  value="7" type="hidden">
                            <input name="x_orders_p[]"  value="<?php echo ($rate2[7][1]-$abcd_rate);?>" type="hidden">				    
                            <td align="center"><span id="gold19">
                                    <?php if($tezhengma){ ?>
                                    <?php if($rate2[7][2]==1 || $rate_admin2[7][2]==1){ echo  '<input name="x_orders_y[]"  value="" type="hidden">���';}else{?> 
                                    <input onKeyPress="return CheckKey();" onClick="get_synchro_rate('50','7','18',<?php echo $u_id;?>,<?php echo $abcd_rate;?>);" style="height: 18px;" size="6" name="x_orders_y[]" class="inp1">
                                <?php }?> 
                                    <?php }else{ echo '����';}?> 
                                </span></td>
						    <td bordercolor="cccccc" align="center" height="25">
							
							<table align="left" border="0" cellpadding="0" cellspacing="0">
							  <tbody><tr>    						<td class="ball_r" align="center" height="32" width="32">07</td>
    					    						<td class="ball_g" align="center" height="32" width="32">17</td>
    					    						<td class="ball_g" align="center" height="32" width="32">27</td>
    					    						<td class="ball_b" align="center" height="32" width="32">37</td>
    					    						<td class="ball_b" align="center" height="32" width="32">47</td>
    						</tr></tbody></table>							</td>
                          </tr>
					                               <tr style="background-color: rgb(255, 255, 255);" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor='ffffff'" bgcolor="#FFFFFF">
						   <td bordercolor="cccccc" align="center" height="25" width="50">
				 
			  3			  </td>
                            <td align="center" height="25"><span id="bl15" class="multiple_Red synchro_rate19"><?php if($tezhengma) echo ($rate2[3][1]-$abcd_rate2);else  echo '-';?></span></td>
			<input name="x_o_type3[]"  value="3" type="hidden">
                            <input name="x_orders_p[]"  value="<?php echo ($rate2[3][1]-$abcd_rate);?>" type="hidden">				    
                            <td align="center"><span id="gold15">
                                    <?php if($tezhengma){ ?>
                                    <?php if($rate2[3][2]==1 || $rate_admin2[3][2]==1){ echo  '<input name="x_orders_y[]"  value="" type="hidden">���';}else{?> 
                                    <input onKeyPress="return CheckKey();" onClick="get_synchro_rate('50','3','19',<?php echo $u_id;?>,<?php echo $abcd_rate;?>);" style="height: 18px;" size="6" name="x_orders_y[]" class="inp1">
                                <?php }?> 
                                    <?php }else{ echo '����';}?> 
                                </span></td>
						    <td bordercolor="cccccc" align="center" height="25">
							
							<table align="left" border="0" cellpadding="0" cellspacing="0">
							  <tbody><tr>    						<td class="ball_b" align="center" height="32" width="32">03</td>
    					    						<td class="ball_r" align="center" height="32" width="32">13</td>
    					    						<td class="ball_r" align="center" height="32" width="32">23</td>
    					    						<td class="ball_g" align="center" height="32" width="32">33</td>
    					    						<td class="ball_g" align="center" height="32" width="32">43</td>
    						</tr></tbody></table>							</td>
                            
                          
						  
						  <td bordercolor="cccccc" align="center" height="25" width="50">
				 
			  8			  </td>
                            <td align="center" height="25"><span id="bl20" class="multiple_Red synchro_rate20"><?php if($tezhengma) echo ($rate2[8][1]-$abcd_rate2);else  echo '-';?></span></td>
			<input name="x_o_type3[]"  value="8" type="hidden">
                            <input name="x_orders_p[]"  value="<?php echo ($rate2[8][1]-$abcd_rate);?>" type="hidden">				    
                            <td align="center"><span id="gold20">
                                    <?php if($tezhengma){ ?>
                                    <?php if($rate2[8][2]==1 || $rate_admin2[8][2]==1){ echo  '<input name="x_orders_y[]"  value="" type="hidden">���';}else{?>
                                    <input onKeyPress="return CheckKey();" onClick="get_synchro_rate('50','8','20',<?php echo $u_id;?>,<?php echo $abcd_rate;?>);" style="height: 18px;" size="6" name="x_orders_y[]" class="inp1">
                                <?php }?> 
                                    <?php }else{ echo '����';}?> 
                                </span></td>
						    <td bordercolor="cccccc" align="center" height="25">
							
							<table align="left" border="0" cellpadding="0" cellspacing="0">
							  <tbody><tr>    						<td class="ball_r" align="center" height="32" width="32">08</td>
    					    						<td class="ball_r" align="center" height="32" width="32">18</td>
    					    						<td class="ball_g" align="center" height="32" width="32">28</td>
    					    						<td class="ball_g" align="center" height="32" width="32">38</td>
    					    						<td class="ball_b" align="center" height="32" width="32">48</td>
    						</tr></tbody></table>							</td>
                          </tr>
					                               <tr onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor='ffffff'" bgcolor="#FFFFFF">
						   <td bordercolor="cccccc" align="center" height="25" width="50">
				 
			  4			  </td>
                            <td align="center" height="25"><span id="bl16" class="multiple_Red synchro_rate21"><?php if($tezhengma) echo ($rate2[4][1]-$abcd_rate2);else  echo '-';?></span></td>
			<input name="x_o_type3[]"  value="4" type="hidden">
                            <input name="x_orders_p[]"  value="<?php echo ($rate2[4][1]-$abcd_rate);?>" type="hidden">				    
                            <td align="center"><span id="gold16">
                                    <?php if($tezhengma){ ?>
                                    <?php if($rate2[4][2]==1 || $rate_admin2[4][2]==1){ echo  '<input name="x_orders_y[]"  value="" type="hidden">���';}else{?>
                                    <input onKeyPress="return CheckKey();" onClick="get_synchro_rate('50','4','21',<?php echo $u_id;?>,<?php echo $abcd_rate;?>);" style="height: 18px;" size="6" name="x_orders_y[]" class="inp1">
                                <?php }?> 
                                    <?php }else{ echo '����';}?> 
                                </span></td>
						    <td bordercolor="cccccc" align="center" height="25">
							
							<table align="left" border="0" cellpadding="0" cellspacing="0">
							  <tbody><tr>    						<td class="ball_b" align="center" height="32" width="32">04</td>
    					    						<td class="ball_b" align="center" height="32" width="32">14</td>
    					    						<td class="ball_r" align="center" height="32" width="32">24</td>
    					    						<td class="ball_r" align="center" height="32" width="32">34</td>
    					    						<td class="ball_g" align="center" height="32" width="32">44</td>
    						</tr></tbody></table>							</td>
                            
                          
						  
						  <td bordercolor="cccccc" align="center" height="25" width="50">
				 
			  9			  </td>
                            <td align="center" height="25"><span id="bl21" class="multiple_Red synchro_rate22"><?php if($tezhengma) echo ($rate2[9][1]-$abcd_rate2);else  echo '-';?></span></td>
			<input name="x_o_type3[]"  value="9" type="hidden">
                            <input name="x_orders_p[]"  value="<?php echo ($rate2[9][1]-$abcd_rate);?>" type="hidden">				   
                            <td align="center"><span id="gold21">
                                   <?php if($tezhengma){ ?>
                                    <?php if($rate2[9][2]==1 || $rate_admin2[9][2]==1){ echo  '<input name="x_orders_y[]"  value="" type="hidden">���';}else{?> 
                                    <input onKeyPress="return CheckKey();" onClick="get_synchro_rate('50','9','22',<?php echo $u_id;?>,<?php echo $abcd_rate;?>);" style="height: 18px;" size="6" name="x_orders_y[]" class="inp1">
                                <?php }?> 
                                    <?php }else{ echo '����';}?> 
                                </span></td>
						    <td bordercolor="cccccc" align="center" height="25">
							
							<table align="left" border="0" cellpadding="0" cellspacing="0">
							  <tbody><tr>    						<td class="ball_b" align="center" height="32" width="32">09</td>
    					    						<td class="ball_r" align="center" height="32" width="32">19</td>
    					    						<td class="ball_r" align="center" height="32" width="32">29</td>
    					    						<td class="ball_g" align="center" height="32" width="32">39</td>
    					    						<td class="ball_g" align="center" height="32" width="32">49</td>
    						</tr></tbody></table>							</td>
                          </tr>
					      
                       
   				            <tr onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor='ffffff'" id="cc6699" bgcolor="#FFFFFF">
						  
						    <td colspan="8" bordercolor="cccccc" align="center" height="25"><input name="btnSubmit" class="btn2"  id="btnSubmit" value="��ע" type="Submit" <?php if(empty($tezhengma)){ echo 'disabled';}?>></td>
   				            </tr>
                        
  </tbody></table>			
				
				
			</form>	
				
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