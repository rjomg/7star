<?php
include_once ('../global.php');
$db = new rate($mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset); //���ݿ������.
$o_type=$_GET['o'];
if(!$o_type)$o_type=37;
//$url="bz.php?o=$o_type";


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
$rate=$db->get_rate($o_type,$u_id);

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

//�岻�� ������ �߲��� �˲��� �Ų��� ʮ����
if($o_type==37){
    $tiaojian_pan="�岻��";
}elseif($o_type==38){
    $tiaojian_pan="������";
}elseif($o_type==39){
    $tiaojian_pan="�߲���";
}elseif($o_type==40){
    $tiaojian_pan="�˲���";
}elseif($o_type==41){
    $tiaojian_pan="�Ų���";
}elseif($o_type==42){
    $tiaojian_pan="ʮ����";    
} 



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
    foreach ($_POST[x_o_type3] as $o){
        $ord=explode(':', $o);//ת��������
        $o_type33.=$ord[0].',';
        $orders_ppp.=$ord[1].',';
    }
    $o_type3=explode(',', trim($o_type33,','));//ת��������
    $orders_p=explode(',', trim($orders_ppp,','));//ת��������
    
    for($i=1;$i<10;$i++){
    if(!empty($_POST[dm.$i])){
        $xxx.=$_POST[dm.$i].',';
    }
    }
    
    $o_type3=explode(',', trim(trim($xxx,',').','.trim($o_type33,','),','));//������ͷʱ�ٺϲ�һ��
   
    $xxx=trim($xxx,',');
    $tuodan_arr=explode(',', $xxx);
 
    
$orders_tixing=$db->get_orders_tixing($qishu['plate_num'],$o_pan,'����',$tiaojian_pan,$o_type3,$_POST[x_orders_y],$orders_p,0,0,"","",$tuodan_arr);      
$x_o_type3 =  implode('=_=',$o_type3);
$x_orders_y =  $_POST[x_orders_y];
$x_orders_p =  implode('=_=',$orders_p);
$tuodan_arr =  implode('=_=',$tuodan_arr);
//$db->get_orders($qishu['plate_num'],$o_pan,'����',$tiaojian_pan,$o_type3,$_POST[x_orders_y],$orders_p,0,0,"","",$tuodan_arr);

    echo " <script>if(confirm('$orders_tixing[0]')){ 
   window.location.href='bz.php?o=$o_type&pan=$o_pan&x_orders_y_i=$orders_tixing[1]&x_plate_num=$qishu[plate_num]&x_abcd_h=$o_pan&x_o_type1=����&x_o_type2=$tiaojian_pan&x_o_type3=$x_o_type3&x_orders_y=$x_orders_y&x_orders_p=$x_orders_p&tuodan_arr=$tuodan_arr';
       }
else 
  { 
  
    }</script>";

}
if($_GET[x_orders_y_i]>0){
//echo $_GET[x_orders_y_i].$_GET[x_plate_num].$_GET[x_abcd_h].$_GET[x_o_type1].$_GET[x_o_type2];
//echo $_GET[x_o_type3].$_GET[x_orders_y].$_GET[x_orders_p];
//exit;
    $db->get_orders($_GET[x_orders_y_i],$_GET[x_plate_num],$_GET[x_abcd_h],'����',$_GET[x_o_type2],explode('=_=',$_GET[x_o_type3]),$_GET[x_orders_y],explode('=_=',$_GET[x_orders_p]),0,0,"","",explode('=_=',$_GET[tuodan_arr]));

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
.input1 {
	display:inline-block;BACKGROUND-COLOR: #ffffff; BORDER-BOTTOM: #A7BCCB 1px solid; BORDER-LEFT: #A7BCCB 1px solid; BORDER-RIGHT: #A7BCCB 1px solid; BORDER-TOP: #A7BCCB 1px solid; FONT-FAMILY: "Verdana", "Arial", "Helvetica", "sans-serif"; FONT-SIZE: 12px;text-align:left;font-weight: bold;color: #990000;line-height: 15px;width: 45px;
}
-->
</style>
</head>
<body oncontextmenu="return false" onselect="document.selection.empty()" oncopy="document.selection.empty()" onmouseover="self.status='�gӭ���R';return true">
<script src="js/jquery-1.4.3.min.js?i=0" type="text/javascript"></script>
<script src="js/bz.js" type="text/javascript"></script> 
 <script type="text/javascript">
    $(document).ready(function() {
        $('input[type=checkbox]').click(function() {
            $("input[name=x_o_type3[]]").attr('disabled', true);
            if ($("input[name=x_o_type3[]]:checked").length >= 12) {
               //alert('���ѡ��12��');
                $("input[name=x_o_type3[]]:checked").attr('disabled', false);
            } else {
                $("input[name=x_o_type3[]]").attr('disabled', false);
            }
        });
    })
</script>
<?php if($tezhengma==1){?>
<SCRIPT type="text/javascript">    
iso();
var ii=90;
var type_id="<?php echo $o_type; ?>";
var cha_rate="<?php echo $abcd_rate; ?>";
function iso(){
    ii--;
    if(ii<='0'){
        ii=90;
        get_rate();
    }
    $("#n").text(ii);
    setTimeout("iso()",1000);
}
//get_rate();
function get_rate(){
    $.post(
    "ajax/ajax_get_other_rate.php",
    {'tid':type_id,'cha_rate':cha_rate},
    function (msg){
        var ms=eval("("+msg+")");
        var ttext;
        $(".ball").each(function(){
            ttext=$(this).text();
            var i=0;
            //alert(ttext);
            while(ms[i]){
                if(ms[i][0]==ttext){
                    $(this).next().children().text(ms[i][1]);
                    $(this).next().next().children().children().eq(1).val(ms[i][1]);
                }
                i++;
            }
        });
    });
}
</SCRIPT>  
<?php }?>
<SCRIPT type="text/javascript">
    var count_win=false;
function CheckKey(){
	if(event.keyCode == 13) return true;
	if((event.keyCode < 48 || event.keyCode > 57) && (event.keyCode > 95 || event.keyCode < 106)){alert("���]���~�H��ݔ������!!"); return false;}
}
    function sendform(){
        var pan = $("#ltype");
        var o_type = <?php echo $o_type;?>;
        var url = 'bz.php';
        url += "?o="+o_type+"&pan="+pan.val();
        window.open(url,'_self');
    }
    function checkform1 (){
        var els2 = $('.inp1').val();  
        if(isNaN(els2) && els2!=""){
                    alert ("��������Ч��");
                    return false;
        }
        return true;
    }
</SCRIPT>
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
<link href="images/Index.css" rel="stylesheet" type="text/css">
  <table border="0" cellpadding="0" cellspacing="0" width="780">
                     <tbody>
                    <tr>
                      <td class="F_bold" nowrap="nowrap"><b id="t_LID" class="Font_G"><?php echo $qishu['plate_num'];?></b>�� <b class="font_b"><span id="ftm1"><?php echo $db->get_otype_by_oid($o_type);?></span>&nbsp;&nbsp;&nbsp;&nbsp;
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
<!-- �_ʼ  --><div id="result">               
                <table class="Ball_List Tab" bgcolor="ffffff" border="0" bordercolor="f1f1f1" cellpadding="0" cellspacing="1" width="780">
                         
                          <tbody><tr>
                            <td colspan="15" bordercolor="cccccc"  bgcolor="#DFEFFF" height="28" nowrap="nowrap">
                                <button id="rtm1" class="<?php echo $o_type==37?"button_a1":"button_a";?>" onClick="xuan_jizhong(37,'<?php echo $o_pan;?>');">�岻��</button>
                                &nbsp;
                                <button id="rtm2" class="<?php echo $o_type==38?"button_a1":"button_a";?>" onClick="xuan_jizhong(38,'<?php echo $o_pan;?>');">������</button>
                                &nbsp;
                                <button id="rtm3" class="<?php echo $o_type==39?"button_a1":"button_a";?>" onClick="xuan_jizhong(39,'<?php echo $o_pan;?>');">�߲���</button>
                                &nbsp;
                                <button id="rtm4" class="<?php echo $o_type==40?"button_a1":"button_a";?>" onClick="xuan_jizhong(40,'<?php echo $o_pan;?>');">�˲���</button>
                                &nbsp;
                                <button id="rtm5" class="<?php echo $o_type==41?"button_a1":"button_a";?>" onClick="xuan_jizhong(41,'<?php echo $o_pan;?>');">�Ų���</button>
                                &nbsp;
                                <button id="rtm6" class="<?php echo $o_type==42?"button_a1":"button_a";?>" onClick="xuan_jizhong(42,'<?php echo $o_pan;?>');">ʮ����</button>                            
                            </td>
                          </tr>
                              
                           <form  method="post" action="" onSubmit="return checkform1();">    
                            <tr class="td_caption_1" >
                            <td bordercolor="cccccc" bgcolor="#DFEFFF" nowrap="nowrap" colspan="15"> <div id="a2" style="DISPLAY: ">
                               <table border="0" bordercolor="f1f1f1" cellpadding="0" cellspacing="0" width="780">
                                  <tbody>
                                    <tr align="center">
                                      <TD bgColor=#f1f1f1  colSpan=3 align=center>
                                            <DIV align=left>
                                                <INPUT onClick="my_select_type(1,<?php echo $o_type;?>)" name="pabcd" value=1 CHECKED type=radio> ���� 
                                                <INPUT onClick="my_select_type(2,<?php echo $o_type;?>)" name="pabcd" value=2 type=radio> ��ͷ 
                                                <INPUT id=pabc name=pabc value=1 type=hidden> 
                                            </DIV></TD>
                                          <TD bgColor=#f1f1f1 colSpan=9 noWrap align=left>
                                            <DIV align=center>��1 <INPUT id=dm1 class=input1  name=dm1 
                                            readOnly size=2> ��2 <INPUT id=dm2 class=input1  name=dm2 
                                            readOnly size=2> ��3 <INPUT id=dm3 class=input1  name=dm3 
                                            readOnly size=2> ��4 <INPUT id=dm4 class=input1  name=dm4 
                                            readOnly size=2> ��5 <INPUT id=dm5 class=input1  name=dm5 
                                            readOnly size=2> ��6 <INPUT id=dm6 class=input1  name=dm6 
                                            readOnly size=2> ��7 <INPUT id=dm7 class=input1  name=dm7 
                                            readOnly size=2> ��8 <INPUT id=dm8 class=input1  name=dm8 
                                            readOnly size=2> ��9 <INPUT id=dm9 class=input1  name=dm9 
                                            readOnly size=2> </DIV>
                                      </TD>
                                    </tr>
                                  </tbody>
                                </table>
                            </div></td>
                          </tr>  
                             
                          <tr class="td_caption_1">
                            <?php for ($i=0;$i<5;$i++){?>
                             <td bordercolor="cccccc" bgcolor="#DFEFFF" nowrap="nowrap"><div align="center">NO</div></td>
                             <td bordercolor="cccccc" align="center" bgcolor="#DFEFFF" nowrap="nowrap" width="8%">�r��</td>
                             <td bordercolor="cccccc" align="center" bgcolor="#DFEFFF" nowrap="nowrap" width="8%">���x</td>
                             <?php }?>  					
			  
                         <?php for($i=1;$i<11;$i++){?>
                                                    <tr style="background-color: rgb(255, 255, 255);" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor='ffffff'" bgcolor="#FFFFFF">
                         <?php 
                      for($u=0;$u<5;$u++){
                            $j=$i+$u*10;
                            $k=$i+$u*10;
                            if($j<10) $j='0'.$i;
                            if($j<"50"){
                          ?>                               
						      <td bordercolor="cccccc" class="ball ball_<?php echo $db->get_color($j);?>" id="type_<?php echo $j;?>" align="center" height="25"><?php echo $j;?></td>
                                                     <td align="center" height="25"><span id="bl0" class="multiple_Red"><?php if($tezhengma) echo ($rate[$j][1]-$abcd_rate);else  echo '-';?></span></td>
                                                     
                                                     <input name="x_orders_p[]"  value="<?php echo ($rate[$j][1]-$abcd_rate);?>" type="hidden">
						    <td align="center"><input onClick="select_num($(this));get_rate();"  name="x_o_type3[]" value="<?php echo $j.':'.($rate[$j][1]-$abcd_rate);?>" type="checkbox" <?php if($tezhengma==0){ echo 'disabled';}?>></td>
							
                        <?php }}?>						    
														
					      </tr>                                                  
                        <?php }?>   
   				            <tr onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor='ffffff'" id="cc6699" bgcolor="#FFFFFF">
						  
						    <td colspan="15" bordercolor="cccccc" align="center" height="25"><table border="0" cellpadding="0" cellspacing="0" width="200">
                              <tbody><tr>
                                <td align="right">��ע��</td>
                                <td><input  onkeypress="return CheckKey();" style="height: 18px;" size="6" name="x_orders_y" class="inp1"></td>
                                <td><input name="btnSubmit"  class="btn2"  value="��ע" type="Submit" <?php if(empty($tezhengma)){ echo 'disabled';}?>>
                                <input name="sxl" id="sxl" value="5" type="hidden">
      <input name="fpsess" type="hidden" value="<?php echo $_SESSION["fsess"]; ?>" />
<!-- ���������ʱ�� -->
<input name="faction" type="hidden" value="submit" />                          
                                
                                </td>
                              </tr>
                            </tbody></table>						      </td>
   				            </tr></form>
                        
  </tbody></table>

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