<?php
include_once ('../global.php');
$db = new rate($mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset); //数据库操作类.
$o_type=$_GET['o'];
if(!$o_type)$o_type=32;

//获取生肖对应数字
$anmail=$db->get_animal_table();

//获取上级以上级别的信息
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
$ot=$o_type;

$rate2=0;
if($o_type==33){
    $rate=$db->get_rate(69,$u_id);
    $ot=69;
    $rate2=$db->get_rate(70,$u_id);
}
if($o_type==36){
    $rate=$db->get_rate(71,$u_id);
    $ot=71;
    $rate2=$db->get_rate(72,$u_id);
}

//当前期数
$qishus=  $db->select("plate", "*", "1 order by plate_num desc limit 1");
$qishu = $db->fetch_array($qishus);

//这里判断特码的封盘状态
//  $qishu[is_special]=1;//特码开
//  $qishu[special_time_end];//特码封盘时间
//  
//  $qishu[is_normal]=1;//正码开
//  $qishu[normal_time_end];//正码封盘时间
//  
//  $qishu[plate_time_satrt];//开盘时间
//  $qishu[plate_time_end];//总封盘时间
// // $qishu[plate_time_satrt]<= time() && $qishu[plate_time_satrt]>$qishu[plate_time_end] && $qishu[is_plate_start]
//  $qishu[is_plate_start];//状态0正在开盘，1正在封盘
        $gunqiufengpan_arr=$db->gunqiufengpan();//滚球封盘
        $gunqiufengpan_te=$gunqiufengpan_arr[0];
        $gunqiufengpan_other=$gunqiufengpan_arr[1];
     $tezhengma=0;
     if($gunqiufengpan_other==0 && $qishu[is_special] && strtotime($qishu[special_time_end])>time() && strtotime($qishu[plate_time_satrt])<= time() && time()<strtotime($qishu[plate_time_end]) && $qishu[is_plate_start]==0){
         $tezhengma=1;
     }
     $tezhengma_time=$qishu['special_time_end'];
            
//当前用户信息
$myusers=  $db->select("users", "*", "user_id={$_SESSION['uid'.$c_p_seesion]}");
$myuser = $db->fetch_array($myusers);


//ABCD盘切换设置
$o_pan=$_GET['pan'];
if($o_pan=="")$o_pan="A";

//二全中 二中特 特串 三全中 三中二
if($o_type==32){
    $tiaojian_pan="二全中";
}elseif($o_type==33){
    $tiaojian_pan="二中特";
}elseif($o_type==34){
    $tiaojian_pan="特串";
}elseif($o_type==35){
    $tiaojian_pan="三全中";
}elseif($o_type==36){
    $tiaojian_pan="三中二";
} 



//号码
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

if($_POST['btnSubmit']=="下注"){
    if($_POST[pabc1]==1 || $_POST[pabc2]==2){ //正常 //拖胆
    $is_duipeng=0;

    foreach ($_POST[x_o_type3] as $o){
        $ord=explode(':', $o);//转换成数组
        $o_type33.=$ord[0].',';
        $orders_ppp.=$ord[1].',';
    }
    
    $o_type3=explode(',', trim($o_type33,','));//转换成数组
    $orders_p=explode(',', trim($orders_ppp,','));//转换成数组
    
    for($i=1;$i<4;$i++){
    if(!empty($_POST[dm.$i])){
        $xxx.=$_POST[dm.$i].',';
    }
    }
    $o_type3=explode(',', trim(trim($xxx,',').','.trim($o_type33,','),','));//当有拖头时再合并一次
   
    $xxx=trim($xxx,',');
    $tuodan_arr=explode(',', $xxx);
    }else{
        $tuodan_arr=0;
        $is_duipeng=1;
//        if($rate2){ 
//            $rate2[$j][1]-$abcd_rate; 
//        }else{
//            $rate[$j][1]-$abcd_rate;           
//        }
        if($_POST[pabc3]==3 || $_POST[pabc4]==4 || $_POST[pabc5]==5){//生肖对碰 //尾数对碰 //生肖尾数对碰  
           if($_POST[dp1]==$_POST[dp2]){
               echo " <script>alert('不能选择两个相同，请重新选择！');window.location.href= 'lm.php?o=$o_type'; </script> " ;exit;
           } 
           $dp12=$_POST[dp1].'-'.$_POST[dp2];
           $o_type3=explode('-',$dp12); 
        }
        //print_r($o_type3);exit;
        elseif($_POST[pabc6]==6){//自由对碰
            for($i=1;$i<50;$i++){
                if(!empty($_POST[mc1.$i])){
                $xxx1.=$_POST[mc1.$i].',';               
                }
                if(!empty($_POST[mc2.$i])){
                $xxx2.=$_POST[mc2.$i].',';
                }
            }
            $dp12=trim($xxx1,',').'-'.trim($xxx2,',');
            $o_type3=explode('-',$dp12);
        }
        //print_r($o_type3);
        //echo count($o_type3).$_POST[x_orders_y];exit;
    }
    
//$db->get_orders($qishu['plate_num'],$o_pan,'连码',$tiaojian_pan,$o_type3,$_POST[x_orders_y],$orders_p,0,0,"","",$tuodan_arr,$is_duipeng);    

   // print_r($o_type3);exit;

$orders_tixing=$db->get_orders_tixing($qishu['plate_num'],$o_pan,'连码',$tiaojian_pan,$o_type3,$_POST[x_orders_y],$orders_p,0,0,"","",$tuodan_arr,$is_duipeng);      
$x_o_type3 =  implode('=_=',$o_type3);
$x_orders_y =  $_POST[x_orders_y];
$x_orders_p =  implode('=_=',$orders_p);
$tuodan_arr =  implode('=_=',$tuodan_arr);
//echo $x_orders_p ;
//echo "lm.php?o=$o_type&pan=$o_pan&x_orders_y_i=$orders_tixing[1]&x_plate_num=$qishu[plate_num]";
//exit();
    echo " <script>if(confirm('$orders_tixing[0]')){ 
   window.location.href='lm.php?o=$o_type&pan=$o_pan&x_orders_y_i=$orders_tixing[1]&x_plate_num=$qishu[plate_num]&x_abcd_h=$o_pan&x_o_type1=连码&x_o_type2=$tiaojian_pan&x_o_type3=$x_o_type3&x_orders_y=$x_orders_y&x_orders_p=$x_orders_p&tuodan_arr=$tuodan_arr&is_duipeng=$is_duipeng';
       }
else 
  { 
  
    }</script>";

}
if($_GET[x_orders_y_i]>0){
//echo $_GET[x_orders_y_i].$_GET[x_plate_num].$_GET[x_abcd_h].$_GET[x_o_type1].$_GET[x_o_type2];
//echo $_GET[x_o_type3].$_GET[x_orders_y].$_GET[x_orders_p];
//exit;


    $db->get_orders($_GET[x_orders_y_i],$_GET[x_plate_num],$_GET[x_abcd_h],'连码',$_GET[x_o_type2],explode('=_=',$_GET[x_o_type3]),$_GET[x_orders_y],explode('=_=',$_GET[x_orders_p]),0,0,"","",explode('=_=',$_GET[tuodan_arr]),$_GET[is_duipeng]);

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
<body oncontextmenu="return false" onselect="document.selection.empty()" oncopy="document.selection.empty()" onmouseover="self.status='歡迎光臨';return true">
    <script src="js/jquery-1.4.3.min.js?i=0" type="text/javascript"></script>    
    <script src="js/lm.js" type="text/javascript"></script> 
 <script type="text/javascript">
    $(document).ready(function() {
        $('input[type=checkbox]').click(function() {
            $("input[name=x_o_type3[]]").attr('disabled', true);
            if ($("input[name=x_o_type3[]]:checked").length >= 12) {
               //alert('最多选择12个');
                $("input[name=x_o_type3[]]:checked").attr('disabled', false);
            } else {
                $("input[name=x_o_type3[]]").attr('disabled', false);
            }
        });
    })
</script>
   
<?php if($tezhengma==1){?> 
<?php if($o_type==33 || $o_type==36){?>
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
            while(ms[0][i]){
                if(ms[0][i][0]==ttext){
                    $(this).next().children().text(ms[0][i][1]+'/'+ms[1][i][1]);
                    $(this).next().next().children().children().eq(1).val(ms[0][i][1]+'/'+ms[1][i][1]);
                }
                i++;
            }
        });
    });
}
</SCRIPT>     
<?php }else{?>    
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
<?php }?>    
<SCRIPT type="text/javascript">
    var count_win=false;
function CheckKey(){
	if(event.keyCode == 13) return true;
	if((event.keyCode < 48 || event.keyCode > 57) && (event.keyCode > 95 || event.keyCode < 106)){alert("下註金額僅能輸入数字!!"); return false;}
}
    function sendform(){
        var pan = $("#ltype");
        var o_type = <?php echo $o_type;?>;
        var url = 'lm.php';
        url += "?o="+o_type+"&pan="+pan.val();
        window.open(url,'_self');
    }
    function checkform1 (){
        var els2 = $('.inp1').val();  
        if(isNaN(els2) && els2!=""){
                    alert ("请输入有效金额。");
                    return false;
        }
        return true;
    }
</SCRIPT>
<script language="JavaScript">
var count_win=false;
function CheckKey(){
	if(event.keyCode == 13) return true;
	if((event.keyCode < 48 || event.keyCode > 57) && (event.keyCode > 95 || event.keyCode < 106)){alert("下註金額僅能輸入数字!!"); return false;}
}

 

function CountGold(gold,type,rtype,bb,ffb){
  switch(type) {
  	  case "focus":
  	  	goldvalue = gold.value;
  	  	if (goldvalue=='') goldvalue=0;
  	document.all.allgold.value = eval(document.all.allgold.value+"-"+goldvalue);
  	  	document.all.total_gold.value = document.all.allgold.value;
	
  	break;
  	  case "blur":
	  if (goldvalue!='')
  	  	{goldvalue = gold.value;
  	  	if (goldvalue=='') goldvalue=0;

if (rtype=='SP' && eval(goldvalue)<document.all.m.value  && eval(goldvalue)!=0) {gold.focus(); alert("下註金額不可小於最低限度 : "+document.all.m.value+"!!"); return false;}
if (rtype=='SP' && (eval(eval(bb)+eval(goldvalue)) > document.all.mm.value)) {gold.focus(); alert("對不起,止號本期下註金額最高限制 : "+document.all.mm.value+"!!"); return false;}
if (rtype=='SP' && (eval(goldvalue) > document.all.mmm.value)) {gold.focus(); alert("對不起,下註金額已超過单註限額 : "+document.all.mmm.value+"!!"); return false;}
if (eval(document.all.allgold.value) > 0)   {gold.focus(); alert("下註金額不可大於可用信用額度!!");    return false;}
		}
 break;
  	  case "keyup":
  	  	goldvalue = gold.value;
  	  	if (goldvalue=='') goldvalue=0;
		 document.all.allgold.value = eval(document.all.total_gold.value+"\+"+ goldvalue);
  	  	break;
  }
}

 
function makeRequest(url) {
  
    http_request = false;
    if (window.XMLHttpRequest) {
        http_request = new XMLHttpRequest();
        if (http_request.overrideMimeType){
 http_request.overrideMimeType('text/xml');
}
} else if (window.ActiveXObject) {
        try{
            http_request = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (e) {
            try {
                http_request = new ActiveXObject("Microsoft.XMLHTTP");
            } catch (e) {
            }
        }
     }
     if (!http_request) {
        alert("Your browser nonsupport operates at present, please use IE 5.0 above editions!");
        return false;
     }
//method init,no init();
 http_request.onreadystatechange = init;
 http_request.open('GET', url, true);
//Forbid IE to buffer memory
 http_request.setRequestHeader("If-Modified-Since","0");
//send count
 http_request.send(null);
//Updated every two seconds a page
// setTimeout("makeRequest('"+url+"')",30000);
}


function init() {
 
    if (http_request.readyState == 4) {
   
        if (http_request.status == 0 || http_request.status == 200) {
       
            var result = http_request.responseText;
			
           
            if(result==""){
           
                result = "Access failure ";
           
            }
           
		   //alert(result);
		   var arrResult = result.split("###");	
		   
		    
		   for(var i=1;i<arrResult.length-1;i++)
{	   
		   arrTmp = arrResult[i].split("@@@");
num1 = arrTmp[0]; //字段num1的值
num4 = arrTmp[1]; //字段num2的值
var bl;
bl="bl"+(i-1);
document.all[bl].innerHTML=num4;
if (num4=="-"){
var gold;
gold="gold1";
document.all[gold].innerHTML= "封盤";
}

}
        } else {//http_request.status != 200
                alert("Request failed! ");
        }
    }
}
function quick551(nn,wtmp3,wtmp4,xx)
{
document.all.ftm1.innerHTML=wtmp3;
document.all.x2.value=nn;
document.all.ex2.value=wtmp3;
tmp1 = document.getElementById("rtm1");
tmp2 = document.getElementById("rtm2");
tmp3 = document.getElementById("rtm3");
tmp4 = document.getElementById("rtm4");
tmp5 = document.getElementById("rtm5");

tmp1.className="button_a";tmp2.className="button_a";tmp3.className="button_a";tmp4.className="button_a";tmp5.className="button_a";

if (wtmp4=="二全中"){tmp1.className="button_a1";document.all.sxl.value="2";document.all.m.value=10;document.all.mm.value=50000;document.all.mmm.value=500000;}
if (wtmp4=="二中特"){tmp2.className="button_a1";document.all.sxl.value="2";document.all.m.value=10;document.all.mm.value=50000;document.all.mmm.value=500000;}
if (wtmp4=="特串"){tmp3.className="button_a1";document.all.sxl.value="2";document.all.m.value=10;document.all.mm.value=50000;document.all.mmm.value=500000;}
if (wtmp4=="三全中"){tmp4.className="button_a1";document.all.sxl.value="3";document.all.m.value=10;document.all.mm.value=50000;document.all.mmm.value=500000;}
if (wtmp4=="三中二"){tmp5.className="button_a1";document.all.sxl.value="3";document.all.m.value=10;document.all.mm.value=50000;document.all.mmm.value=500000;}


//document.all.m.value=10;document.all.mm.value=50000;document.all.mmm.value=500000;

for(i=1; i<50; i++) {
MM_changeProp('num'+i,'','disabled','0','INPUT/CHECKBOX')
MM_changeProp('num'+i,'','checked','0','INPUT/CHECKBOX');
var sxsx6="sxsx6"+i
document.all[sxsx6].value=0
}
cb_num=1;

s2="dm1"
document.all[s2].value ="" ;

s3="dm2"
document.all[s3].value ="";

	if (xx == 3) {
		type_nums = 10;
		type_min = 3;
		
		for(i=1; i<13; i++) {
				
			MM_changeProp('pan1'+i,'','disabled','disabled','INPUT/CHECKBOX')
			MM_changeProp('pan2'+i,'','disabled','disabled','INPUT/CHECKBOX')
			MM_changeProp('pan1'+i,'','checked','0','INPUT/CHECKBOX')
			MM_changeProp('pan2'+i,'','checked','0','INPUT/CHECKBOX')
			//MM_changeProp('num'+i,'','checked','0','INPUT/CHECKBOX');
		}
		for(i=0; i<10; i++) {
				
			MM_changeProp('pan3'+i,'','disabled','disabled','INPUT/CHECKBOX')
			MM_changeProp('pan4'+i,'','disabled','disabled','INPUT/CHECKBOX')
			MM_changeProp('pan3'+i,'','checked','0','INPUT/CHECKBOX')
			MM_changeProp('pan4'+i,'','checked','0','INPUT/CHECKBOX')
			//MM_changeProp('num'+i,'','checked','0','INPUT/CHECKBOX');
		}
		MM_changeProp('pabc3','','disabled','disabled','INPUT/RADIO')
		MM_changeProp('pabc4','','disabled','disabled','INPUT/RADIO')
		MM_changeProp('pabc5','','disabled','disabled','INPUT/RADIO')
			MM_changeProp('pabc6','','disabled','disabled','INPUT/RADIO')
		
		for(i=1; i<50; i++) {
				
			MM_changeProp('num'+i,'','disabled','0','INPUT/CHECKBOX')
			MM_changeProp('num'+i,'','checked','0','INPUT/CHECKBOX');
			
			MM_changeProp('mc1'+i,'','disabled','disabled','INPUT/CHECKBOX')
			MM_changeProp('mc1'+i,'','checked','0','INPUT/CHECKBOX');
			MM_changeProp('mc2'+i,'','disabled','disabled','INPUT/CHECKBOX')
			MM_changeProp('mc2'+i,'','checked','0','INPUT/CHECKBOX');
		}
		MM_changeProp('pabc','','checked','checked','INPUT/RADIO')
		a1.style.display = "";   
		a2.style.display = ""; 
		a3.style.display = "none";
		a4.style.display = "none"; 
		a5.style.display = "none"; 
		a6.style.display = "none"; 
		   
	 for(i=1; i<7; i++) {
			if (i==1) {
			var pabc="pabc";
			document.all[pabc].value = 1;
			MM_changeProp('pabc'+i,'','checked','1','INPUT/RADIO')
			}else{
			MM_changeProp('pabc'+i,'','checked','0','INPUT/RADIO')
			}
			
			
		}
	
	
	
	} else {
	cb_num=1
	


s2="dm1"
document.all[s2].value ="" ;

s3="dm2"
document.all[s3].value ="";

		type_nums = 10;
		type_min = 2;
		a1.style.display = "";  
		a2.style.display = ""; 
		a3.style.display = "none";
		a4.style.display = "none"; 
		a5.style.display = "none"; 
		a6.style.display = "none"; 
		MM_changeProp('pabc3','','disabled','0','INPUT/RADIO')
		MM_changeProp('pabc4','','disabled','0','INPUT/RADIO')
		MM_changeProp('pabc5','','disabled','0','INPUT/RADIO')
		MM_changeProp('pabc6','','disabled','0','INPUT/RADIO')
		for(i=1; i<50; i++) {
				
			MM_changeProp('num'+i,'','disabled','0','INPUT/CHECKBOX')
			MM_changeProp('num'+i,'','checked','0','INPUT/CHECKBOX');
			MM_changeProp('mc1'+i,'','disabled','disabled','INPUT/CHECKBOX')
			MM_changeProp('mc1'+i,'','checked','0','INPUT/CHECKBOX');
			MM_changeProp('mc2'+i,'','disabled','disabled','INPUT/CHECKBOX')
			MM_changeProp('mc2'+i,'','checked','0','INPUT/CHECKBOX');
		}
		
		for(i=1; i<13; i++) {
				
			MM_changeProp('pan1'+i,'','disabled','disabled','INPUT/CHECKBOX')
			MM_changeProp('pan2'+i,'','disabled','disabled','INPUT/CHECKBOX')
			MM_changeProp('pan1'+i,'','checked','0','INPUT/CHECKBOX')
			MM_changeProp('pan2'+i,'','checked','0','INPUT/CHECKBOX')
			MM_changeProp('pan5'+i,'','disabled','disabled','INPUT/CHECKBOX')
			MM_changeProp('pan5'+i,'','checked','0','INPUT/CHECKBOX')
			//MM_changeProp('num'+i,'','checked','0','INPUT/CHECKBOX');
		}
		for(i=0; i<10; i++) {
				
			MM_changeProp('pan3'+i,'','disabled','disabled','INPUT/CHECKBOX')
			MM_changeProp('pan4'+i,'','disabled','disabled','INPUT/CHECKBOX')
			MM_changeProp('pan3'+i,'','checked','0','INPUT/CHECKBOX')
			MM_changeProp('pan4'+i,'','checked','0','INPUT/CHECKBOX')
			MM_changeProp('pan6'+i,'','disabled','disabled','INPUT/CHECKBOX')
			MM_changeProp('pan6'+i,'','checked','0','INPUT/CHECKBOX')
			//MM_changeProp('num'+i,'','checked','0','INPUT/CHECKBOX');
		}
		
		
		
		 for(i=1; i<7; i++) {
			if (i==1) {
			var pabc="pabc";
			document.all[pabc].value = 1;
			MM_changeProp('pabc'+i,'','checked','1','INPUT/RADIO')
			}else{
			MM_changeProp('pabc'+i,'','checked','0','INPUT/RADIO')
			}
			
			
		}
		
	}


var key1=document.all.abcd.value;


//quick5();

}
function select_types1(type) {



cb_num=1
s2="dm1"
document.all[s2].value ="" ;

s3="dm2"
document.all[s3].value ="";
	if (type == 1 || type == 2) {
	
	for(i=1; i<50; i++) {
				
			MM_changeProp('num'+i,'','disabled','0','INPUT/CHECKBOX')
			MM_changeProp('num'+i,'','checked','0','INPUT/CHECKBOX');
			MM_changeProp('mc1'+i,'','disabled','disabled','INPUT/CHECKBOX')
			MM_changeProp('mc1'+i,'','checked','0','INPUT/CHECKBOX');
			MM_changeProp('mc2'+i,'','disabled','disabled','INPUT/CHECKBOX')
			MM_changeProp('mc2'+i,'','checked','0','INPUT/CHECKBOX');
		}
		
		for(i=1; i<13; i++) {
				
			MM_changeProp('pan1'+i,'','disabled','disabled','INPUT/CHECKBOX')
			MM_changeProp('pan2'+i,'','disabled','disabled','INPUT/CHECKBOX')
			MM_changeProp('pan5'+i,'','disabled','disabled','INPUT/CHECKBOX')
			MM_changeProp('pan5'+i,'','checked','0','INPUT/CHECKBOX')
			MM_changeProp('pan1'+i,'','checked','0','INPUT/CHECKBOX')
			MM_changeProp('pan2'+i,'','checked','0','INPUT/CHECKBOX')
			
			//MM_changeProp('num'+i,'','checked','0','INPUT/CHECKBOX');
		}
		for(i=0; i<10; i++) {
				
			MM_changeProp('pan3'+i,'','disabled','disabled','INPUT/CHECKBOX')
			MM_changeProp('pan4'+i,'','disabled','disabled','INPUT/CHECKBOX')
			MM_changeProp('pan3'+i,'','checked','0','INPUT/CHECKBOX')
			MM_changeProp('pan4'+i,'','checked','0','INPUT/CHECKBOX')
			
			MM_changeProp('pan6'+i,'','disabled','disabled','INPUT/CHECKBOX')
			MM_changeProp('pan6'+i,'','checked','0','INPUT/CHECKBOX')
		
			//MM_changeProp('num'+i,'','checked','0','INPUT/CHECKBOX');
		}
		
	
	var i
		for(i=1; i<7; i++) {
			if (i==type) {
			
			}else{
			MM_changeProp('pabc'+i,'','checked','0','INPUT/RADIO')
			}
			
			
		}
			
		
		  
		   
	
	
	
	} 
	
	
	
	if (type == 1 ) {
	a1.style.display = "";  
	a2.style.display = "";  
	a3.style.display = "none";
		a4.style.display = "none"; 
		a5.style.display = "none"; 
		a6.style.display = "none"; 
	}
	
	if (type == 2 ) {
	a1.style.display = "";  
	a2.style.display = "";  
	a3.style.display = "none";
		a4.style.display = "none"; 
		a5.style.display = "none"; 
		a6.style.display = "none"; 
	}
	
	if (type == 3 ) {
		
		
		for(i=1; i<50; i++) {
				
			MM_changeProp('num'+i,'','disabled','disabled','INPUT/CHECKBOX')
			MM_changeProp('num'+i,'','checked','0','INPUT/CHECKBOX');
			MM_changeProp('mc1'+i,'','disabled','disabled','INPUT/CHECKBOX')
			MM_changeProp('mc1'+i,'','checked','0','INPUT/CHECKBOX');
			MM_changeProp('mc2'+i,'','disabled','disabled','INPUT/CHECKBOX')
			MM_changeProp('mc2'+i,'','checked','0','INPUT/CHECKBOX');
		}
		
		for(i=1; i<13; i++) {
				
			MM_changeProp('pan1'+i,'','disabled','0','INPUT/CHECKBOX')
			MM_changeProp('pan2'+i,'','disabled','0','INPUT/CHECKBOX')
			MM_changeProp('pan1'+i,'','checked','0','INPUT/CHECKBOX')
			MM_changeProp('pan2'+i,'','checked','0','INPUT/CHECKBOX')
			
			MM_changeProp('pan5'+i,'','disabled','disabled','INPUT/CHECKBOX')
			MM_changeProp('pan5'+i,'','checked','0','INPUT/CHECKBOX')
			//MM_changeProp('num'+i,'','checked','0','INPUT/CHECKBOX');
		}
		for(i=0; i<10; i++) {
				
		
			MM_changeProp('pan4'+i,'','disabled','disabled','INPUT/CHECKBOX')
		MM_changeProp('pan4'+i,'','checked','0','INPUT/CHECKBOX')
		MM_changeProp('pan3'+i,'','disabled','disabled','INPUT/CHECKBOX')
			MM_changeProp('pan3'+i,'','checked','0','INPUT/CHECKBOX')
			MM_changeProp('pan6'+i,'','disabled','disabled','INPUT/CHECKBOX')
				MM_changeProp('pan6'+i,'','checked','0','INPUT/CHECKBOX')
			
	
			//MM_changeProp('num'+i,'','checked','0','INPUT/CHECKBOX');
		}
		
		for(i=1; i<7; i++) {
			if (i==type) {
			
			}else{
			MM_changeProp('pabc'+i,'','checked','0','INPUT/RADIO')
			}
			
			
		}
		a1.style.display = "none";  
		a2.style.display = ""; 
		a3.style.display = "";
		a4.style.display = "none"; 
		a5.style.display = "none"; 
		a6.style.display = "none"; 
	}
	
	
	if (type == 5 ) {
		
		
		for(i=1; i<50; i++) {
				
			MM_changeProp('num'+i,'','disabled','disabled','INPUT/CHECKBOX')
			MM_changeProp('num'+i,'','checked','0','INPUT/CHECKBOX');
			MM_changeProp('mc1'+i,'','disabled','disabled','INPUT/CHECKBOX')
			MM_changeProp('mc1'+i,'','checked','0','INPUT/CHECKBOX');
			MM_changeProp('mc2'+i,'','disabled','disabled','INPUT/CHECKBOX')
			MM_changeProp('mc2'+i,'','checked','0','INPUT/CHECKBOX');
		}
		
		for(i=1; i<13; i++) {
				
			MM_changeProp('pan1'+i,'','disabled','disabled','INPUT/CHECKBOX')
			MM_changeProp('pan2'+i,'','disabled','disabled','INPUT/CHECKBOX')
			MM_changeProp('pan2'+i,'','checked','0','INPUT/CHECKBOX')
			MM_changeProp('pan1'+i,'','checked','0','INPUT/CHECKBOX')
			MM_changeProp('pan5'+i,'','disabled','0','INPUT/CHECKBOX')
		
			//MM_changeProp('num'+i,'','checked','0','INPUT/CHECKBOX');
		}
		for(i=0; i<10; i++) {
				
		
			MM_changeProp('pan4'+i,'','disabled','disabled','INPUT/CHECKBOX')
		MM_changeProp('pan4'+i,'','checked','0','INPUT/CHECKBOX')
		MM_changeProp('pan3'+i,'','disabled','disabled','INPUT/CHECKBOX')
			MM_changeProp('pan3'+i,'','checked','0','INPUT/CHECKBOX')
			MM_changeProp('pan6'+i,'','disabled','0','INPUT/CHECKBOX')
				MM_changeProp('pan6'+i,'','checked','0','INPUT/CHECKBOX')
			
	
			//MM_changeProp('num'+i,'','checked','0','INPUT/CHECKBOX');
		}
		
		for(i=1; i<7; i++) {
			if (i==type) {
			
			}else{
			MM_changeProp('pabc'+i,'','checked','0','INPUT/RADIO')
			}
			
			
		}
		a1.style.display = "none";
		a3.style.display = "none";
		a4.style.display = "none"; 
		a5.style.display = ""; 
		a6.style.display = "none"; 
	}
	
	
	
	if (type == 6 ) {
		
		
		for(i=1; i<50; i++) {
				
			MM_changeProp('num'+i,'','disabled','disabled','INPUT/CHECKBOX')
			MM_changeProp('num'+i,'','checked','0','INPUT/CHECKBOX');
			
			MM_changeProp('mc1'+i,'','disabled','0','INPUT/CHECKBOX')
			MM_changeProp('mc1'+i,'','checked','0','INPUT/CHECKBOX');
			MM_changeProp('mc2'+i,'','disabled','0','INPUT/CHECKBOX')
			MM_changeProp('mc2'+i,'','checked','0','INPUT/CHECKBOX');
		}
		
		for(i=1; i<13; i++) {
				
			MM_changeProp('pan1'+i,'','disabled','disabled','INPUT/CHECKBOX')
			MM_changeProp('pan2'+i,'','disabled','disabled','INPUT/CHECKBOX')
			MM_changeProp('pan5'+i,'','disabled','disabled','INPUT/CHECKBOX')
			MM_changeProp('pan5'+i,'','checked','0','INPUT/CHECKBOX')
		    MM_changeProp('pan1'+i,'','checked','0','INPUT/CHECKBOX')
			MM_changeProp('pan2'+i,'','checked','0','INPUT/CHECKBOX')
			//MM_changeProp('num'+i,'','checked','0','INPUT/CHECKBOX');
		}
		for(i=0; i<10; i++) {
				
		
		MM_changeProp('pan4'+i,'','disabled','disabled','INPUT/CHECKBOX')
		MM_changeProp('pan4'+i,'','checked','0','INPUT/CHECKBOX')
		MM_changeProp('pan3'+i,'','disabled','disabled','INPUT/CHECKBOX')
		MM_changeProp('pan3'+i,'','checked','0','INPUT/CHECKBOX')
		MM_changeProp('pan6'+i,'','disabled','disabled','INPUT/CHECKBOX')
		MM_changeProp('pan6'+i,'','checked','0','INPUT/CHECKBOX')
			
	
			//MM_changeProp('num'+i,'','checked','0','INPUT/CHECKBOX');
		}
		
		for(i=1; i<7; i++) {
			if (i==type) {
			
			}else{
			MM_changeProp('pabc'+i,'','checked','0','INPUT/RADIO')
			}
			
			
		}
	a1.style.display = "none";	
	a3.style.display = "none";
		a4.style.display = "none"; 
		a5.style.display = "none"; 
		a6.style.display = "";
	}
	
	if (type == 4 ) {
	
		for(i=1; i<50; i++) {
				
			MM_changeProp('num'+i,'','disabled','disabled','INPUT/CHECKBOX')
			MM_changeProp('num'+i,'','checked','0','INPUT/CHECKBOX');
			MM_changeProp('mc1'+i,'','disabled','disabled','INPUT/CHECKBOX')
			MM_changeProp('mc1'+i,'','checked','0','INPUT/CHECKBOX');
			MM_changeProp('mc2'+i,'','disabled','disabled','INPUT/CHECKBOX')
			MM_changeProp('mc2'+i,'','checked','0','INPUT/CHECKBOX');
		}
		
	for(i=1; i<13; i++) {
				
			MM_changeProp('pan1'+i,'','disabled','disabled','INPUT/CHECKBOX')
			MM_changeProp('pan2'+i,'','disabled','disabled','INPUT/CHECKBOX')
			
			MM_changeProp('pan1'+i,'','checked','0','INPUT/CHECKBOX')
			MM_changeProp('pan2'+i,'','checked','0','INPUT/CHECKBOX')
			
			MM_changeProp('pan5'+i,'','disabled','disabled','INPUT/CHECKBOX')
			MM_changeProp('pan5'+i,'','checked','0','INPUT/CHECKBOX')
			MM_changeProp('pan6'+i,'','disabled','0','INPUT/CHECKBOX')
				MM_changeProp('pan6'+i,'','checked','0','INPUT/CHECKBOX')
			
			//MM_changeProp('num'+i,'','checked','0','INPUT/CHECKBOX');
		}
		for(i=0; i<10; i++) {
				
			MM_changeProp('pan3'+i,'','disabled','0','INPUT/CHECKBOX')
			MM_changeProp('pan4'+i,'','disabled','0','INPUT/CHECKBOX')
			
			MM_changeProp('pan6'+i,'','disabled','disabled','INPUT/CHECKBOX')
			MM_changeProp('pan6'+i,'','checked','0','INPUT/CHECKBOX')
			//MM_changeProp('num'+i,'','checked','0','INPUT/CHECKBOX');
		}
		a1.style.display = "none";
		a3.style.display = "none";
		a4.style.display = ""; 
		a5.style.display = "none"; 
		a6.style.display = "none";
	for(i=1; i<7; i++) {
			if (i==type) {
			
			}else{
			MM_changeProp('pabc'+i,'','checked','0','INPUT/RADIO')
			}
			
			
		}
		
		
	}
	
	
	
}

function r_pan1(zizi) {

for(i=1; i<13; i++) {
			if (i==zizi) {
						
			
			}else{
			MM_changeProp('pan1'+i,'','checked','0','INPUT/RADIO')
			}
			
			
		}
var str1="pan1";

var str2="pan2";
if(document.all[str2].value ==zizi)

{
MM_changeProp('pan1'+zizi,'','checked','0','INPUT/RADIO')

document.all[str1].value = "";
alert("對不起!請重新選擇两個不一樣的！");

document.all.pan4.focus();
return false;
}

}

function r_pan5(zizi) {

for(i=1; i<13; i++) {
			if (i==zizi) {
						
			
			}else{
			MM_changeProp('pan5'+i,'','checked','0','INPUT/RADIO')
			}
			
			
		}


}
		
function r_pan2(zizi,zzz){
for(i=1; i<13; i++) {
			if (i==zizi) {
						
			
			}else{
			MM_changeProp('pan2'+i,'','checked','0','INPUT/RADIO')
			}
			
			
		}

var str1="pan2";

var str2="pan1";
if(document.all[str2].value ==zizi)

{
MM_changeProp('pan2'+zizi,'','checked','0','INPUT/RADIO')

document.all[str1].value = "";
alert("對不起!請重新選擇两個不一樣的！");

document.all.pan4.focus();
return false;
}
}
		

function r_pan3(zizi,zzz){
for(i=0; i<10; i++) {
			if (i==zizi) {
						
			
			}else{
			MM_changeProp('pan3'+i,'','checked','0','INPUT/RADIO')
			}
			
			
		}
var str1="pan3";
var str2="pan4";
if(document.all[str2].value ==zizi)
{
MM_changeProp('pan3'+zizi,'','checked','0','INPUT/RADIO')

 document.all[str1].value = "";
alert("對不起!請重新選擇两個不一樣的！");

document.all.pan3.focus();
return false;
}
}
function r_pan4(zizi,zzz){



for(i=0; i<13; i++) {
			if (i==zizi) {
						
			
			}else{
			MM_changeProp('pan4'+i,'','checked','0','INPUT/RADIO')
			}
			
			
		}
		
var str1="pan4";

var str2="pan3";
if(document.all[str2].value ==zizi)

{
MM_changeProp('pan4'+zizi,'','checked','0','INPUT/RADIO')

document.all[str1].value = "";
alert("對不起!請重新選擇两個不一樣的！");

document.all.pan4.focus();
return false;
}


}
		
		
		function r_pan6(zizi,zzz){



for(i=0; i<13; i++) {
			if (i==zizi) {
						
			
			}else{
			MM_changeProp('pan6'+i,'','checked','0','INPUT/RADIO')
			}
			
			
		}


}


function ra_select(str1,zz){

    
       
        document.all[str1].value = zz;
   

}

function quick552(abcd){
var key=document.all.x2.value;
var key1=abcd;
document.all.abcd.value=abcd;
//quick5();
}


// function quick5(){
//var key=document.all.x2.value;
//var key1=document.all.abcd.value;
//makeRequest("?spul=XTsEWFY6ByUDOFw8&savew=CXcOaFYnA2peew9x&x1=W4lTElPgVTg!888&x2="+key+"&abcd="+key1+"&page=1")
//}



</script>
<SCRIPT language=Javascript type=text/javascript>
<!--
//*****Javascript防重复提交************
var frm_submit=false; //纪录提交状态
function check_form(fobj) {
var error = 0;
var error_message = "";
if (fobj.formtext.value=="")
{
error_message = error_message + "formtext 不能为空.n";
error = 1;
}

if (frm_submit==true) {
error_message = error_message + "这个表单已经提交.n请耐心等待服务器处理你的请求.nn";
error=1;
}

if (error == 1) {
alert(error_message);
return false;
} else {
frm_submit=true; //改变提交状态
return true;
}
}
-->
</script>
     <style type="text/css">
<!--
.STYLE2 {color: #0000FF}
.STYLE5 {
	color: #006600;
	font-weight: bold;
}
.STYLE7 {color: #0000FF; font-weight: bold; }
.STYLE8 {color: #006600}
.input1 {
	display:inline-block;BACKGROUND-COLOR: #ffffff; BORDER-BOTTOM: #A7BCCB 1px solid; BORDER-LEFT: #A7BCCB 1px solid; BORDER-RIGHT: #A7BCCB 1px solid; BORDER-TOP: #A7BCCB 1px solid; FONT-FAMILY: "Verdana", "Arial", "Helvetica", "sans-serif"; FONT-SIZE: 12px;text-align:left;font-weight: bold;color: #990000;line-height: 15px;width: 45px;
}
.input2 {
	display:inline-block;BACKGROUND-COLOR: #ffffff; BORDER-BOTTOM: #A7BCCB 1px solid; BORDER-LEFT: #A7BCCB 1px solid; BORDER-RIGHT: #A7BCCB 1px solid; BORDER-TOP: #A7BCCB 1px solid; FONT-FAMILY: "Verdana", "Arial", "Helvetica", "sans-serif"; FONT-SIZE: 12px;text-align:left;font-weight: bold;color: #0000ff;line-height: 15px;width: 45px;
}
 
-->
 </style>
  <div align="left"><iframe name="5123" scrolling="no" frameborder="0" width="760" height="25" src="http://bmw.512302.com:8022/fgjfjgfj/vbnvbnt/vbnmvmvbm/live.html"></iframe>
</div>
<link href="images/Index.css" rel="stylesheet" type="text/css">
<table border="0" cellpadding="0" cellspacing="0" width="780">
                     <tbody>
                    <tr>
                      <td class="F_bold" nowrap="nowrap"><b id="t_LID" class="Font_G"><?php echo $qishu['plate_num'];?></b>期 <b class="font_b"><span id="ftm1"><?php echo $db->get_otype_by_oid($o_type);?></span>&nbsp;&nbsp;&nbsp;&nbsp;
                                <select class="za_select" id="ltype" name="ltype" onChange="sendform(this);">
            <?php
            $userelse_plates = explode(',', $myuser['else_plate']);
            foreach ($userelse_plates as $up_arr) { ?>
             <option <?php if ($o_pan == $up_arr): ?>selected<?php endif; ?> value="<?php echo $up_arr;?>"><?php echo $up_arr;?>盤</option>   
            <?php }?>
        </select></b></td>
                      <td class="F_bold" nowrap="nowrap"></td>
                      <td align="right" width="25%">
                          <?php if($tezhengma){ ?>
                          <font color="#000000">距離封盤：</font>
          <span id="hClockTime_C">
               <?php                       $aaa=strtotime($tezhengma_time)-time();
                                                           $bbb=floor($aaa/86400);//天
                                                           $ccc=floor(($aaa-($bbb*86400))/3600);//小时
                                                           $ddd=floor(($aaa-($bbb*86400)-($ccc*3600))/60);//分钟
                                                           $eee=$aaa-($bbb*86400)-($ccc*3600)-($ddd*60);//秒
             //  echo $bbb.'天'.$ccc.'小时'.$ddd."分钟";
                                                           $bbbccc=24*$bbb+$ccc;//小时总数
                                                           ?>   
             
          </span>
            <?php }else{ echo '已封盘'; ?>
              <font color="#000000">距離开盤：</font>
          <span id="hClockTime_C">
               <?php                       $aaa=strtotime($qishu['plate_time_satrt'])-time();
                                                           $bbb=floor($aaa/86400);//天
                                                           $ccc=floor(($aaa-($bbb*86400))/3600);//小时
                                                           $ddd=floor(($aaa-($bbb*86400)-($ccc*3600))/60);//分钟
                                                           $eee=$aaa-($bbb*86400)-($ccc*3600)-($ddd*60);//秒
                                                           //  echo $bbb.'天'.$ccc.'小时'.$ddd."分钟";
                                                           $bbbccc=24*$bbb+$ccc;//小时总数
                                                           ?>   
             
          </span>   
              <?php }?>
           </td>
                      
                      <td align="right" width="22%">
                          <?php if($tezhengma){ ?>
                          <font color="#000000"><span id="Update_Time"><span id="n">90</span>秒</span></font>
                          <?php }?>
                      </td>
                    </tr>
                  </tbody>
                </table>
<!-- 開始  --><div id="result">               
                <table class="Ball_List Tab" bgcolor="ffffff" border="0" bordercolor="f1f1f1" cellpadding="0" cellspacing="1" width="780">
                         
                          <tbody><tr>
                            <td bordercolor="cccccc"  bgcolor="#DFEFFF" height="28" nowrap="nowrap">
                                <button id="rtm1" class="<?php echo $o_type==32?"button_a1":"button_a";?>" onClick="window.location.href='lm.php?o=32&pan=<?php echo $o_pan;?>'">二全中</button>
                                &nbsp;
                                <button id="rtm2" class="<?php echo $o_type==33?"button_a1":"button_a";?>" onClick="window.location.href='lm.php?o=33&pan=<?php echo $o_pan;?>'">二中特</button>
                                &nbsp;
                                <button id="rtm3" class="<?php echo $o_type==34?"button_a1":"button_a";?>" onClick="window.location.href='lm.php?o=34&pan=<?php echo $o_pan;?>'">特串</button>
                                &nbsp;
                                <button id="rtm4" class="<?php echo $o_type==35?"button_a1":"button_a";?>" onClick="window.location.href='lm.php?o=35&pan=<?php echo $o_pan;?>'">三全中</button>
                                &nbsp;
                                <button id="rtm5" class="<?php echo $o_type==36?"button_a1":"button_a";?>" onClick="window.location.href='lm.php?o=36&pan=<?php echo $o_pan;?>'">三中二</button></td>
                          </tr>
                              <form onSubmit="return SubChk(this);" name="lt_form" id="lt_form" method="post" action="" >
                          <tr class="td_caption_1">
                            <td bordercolor="cccccc" bgcolor="#DFEFFF" nowrap="nowrap"> <div id="a2" style="DISPLAY: ">
<table border="0" bordercolor="f1f1f1" cellpadding="0" cellspacing="0" width="780">
                                  <tbody>
                                    <tr align="center">
                                      <td width="76%">
                                        <INPUT onClick="my_select_type(1,<?php echo $o_type;?>);select_types1(1);javascript:ra_select('pabc','1')" name="pabc1" value=1 CHECKED type=radio> 正常 
                                        <INPUT onClick="my_select_type(2,<?php echo $o_type;?>);select_types1(2);javascript:ra_select('pabc','2')" name="pabc2" value=2 type=radio> 拖头  
                                        <input name="pabc3" onClick="select_types1(3);;javascript:ra_select('pabc','3')" value="3" type="radio" <?php if($o_type>34) { echo "disabled=disabled"; }?>>
                                        生肖对碰
                                        <input name="pabc4" onClick="select_types1(4);;javascript:ra_select('pabc','4')" value="4" type="radio" <?php if($o_type>34) { echo "disabled=disabled"; }?>>
                                        尾数对碰
										
										
										<input name="pabc5" onClick="select_types1(5);;javascript:ra_select('pabc','5')" value="5" type="radio" <?php if($o_type>34) { echo "disabled=disabled"; }?>>
                                        生肖尾数对碰
										
										<input name="pabc6" onClick="select_types1(6);;javascript:ra_select('pabc','6')" value="6" type="radio" <?php if($o_type>34) { echo "disabled=disabled"; }?>>
                                       自由对碰
                                      <input name="pabc" id="pabc" value="1" type="hidden"></td>
                                      <td id="hd1" nowrap="nowrap" width="9%">胆1
                                      <input name="dm1"  class="input1" id="dm1" size="4" readonly="readonly" type="text"></td>
                                      <td id="hd1" nowrap="nowrap" width="12%">胆2
                                      <input name="dm2"  class="input1" id="dm2" size="4" readonly="readonly" type="text"></td>
                                    </tr>
                                  </tbody>
    </table>
                            </div></td>
                          </tr>
                          
   				            <tr style="background-color: rgb(255, 255, 162);" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor='ffffff'" id="cc6699" bgcolor="#FFFFFF">
   				              
                                                <td bordercolor="cccccc" align="center" height="25">
							<div id="a1" style="DISPLAY: ">
                                             <table class="Ball_List" bgcolor="ffffff" border="0" bordercolor="f1f1f1" cellpadding="0" cellspacing="1" width="780">
                                                 <tbody>
                                             <tr class="td_caption_1">
                            <?php for ($i=0;$i<5;$i++){?>
                             <td bordercolor="cccccc" bgcolor="#DFEFFF" nowrap="nowrap"><div align="center">NO</div></td>
                            <td bordercolor="cccccc" align="center" bgcolor="#DFEFFF" nowrap="nowrap" width="8%">賠率</td>
                            <td bordercolor="cccccc" align="center" bgcolor="#DFEFFF" nowrap="nowrap" width="8%">勾選</td>
                                              <?php }?>  
                          </tr>
						  
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
                            <td align="center" height="25"><span id="bl0" class="multiple_Red"><?php if($tezhengma){ if($rate2) echo ($rate[$j][1]-$abcd_rate).'/'.($rate2[$j][1]-$abcd_rate); else echo ($rate[$j][1]-$abcd_rate);}else{  echo '-';}?></span></td>
                            <input name="x_orders_p[]"  value="<?php if($tezhengma){ if($rate2) echo ($rate2[$j][1]-$abcd_rate); else echo ($rate[$j][1]-$abcd_rate);}else{  echo '-';}?>" type="hidden">
                            <input name="fpsess" type="hidden" value="<?php echo $_SESSION["fsess"]; ?>" />
<!-- 保存表单生成时间 -->
<input name="faction" type="hidden" value="submit" />
						    <td align="center"><input onClick="select_num($(this));get_rate();" name="x_o_type3[]" value="<?php if($rate2){ $ratemin=$rate2[$j][1]-$abcd_rate; }else{ $ratemin=$rate[$j][1]-$abcd_rate;} echo $j.':'.$ratemin;?>" type="checkbox" <?php if($tezhengma==0){ echo 'disabled';}?>></td>
							
                        <?php }}?>						    
														
					      </tr>                                                  
                        <?php }?>                                               
			
					      
</tbody></table>
</div>	
 <div id="a3" style="DISPLAY: none">
                             <table class="Ball_List" bgcolor="ffffff" border="0" bordercolor="f1f1f1" cellpadding="0" cellspacing="1" width="780">
                                  <tbody>
                                    <tr align="center">
                                      <td align="center" bgcolor="#FFFFFF">
                                         鼠
                                        <input name="dp1" onClick="r_pan1(5);javascript:ra_select('pan1','5')" value="<?php echo trim($anmail['鼠'],',');?>" type="radio">
                                      </td>
                                      <td align="center" bgcolor="#FFFFFF">牛
                                        <input name="dp1" onClick="r_pan1(4);javascript:ra_select('pan1','4')" value="<?php echo trim($anmail['牛'],',');?>" type="radio">
                                      </td>
                                      <td align="center" bgcolor="#FFFFFF">虎
                                        <input name="dp1" onClick="r_pan1(3);javascript:ra_select('pan1','3')" value="<?php echo trim($anmail['虎'],',');?>" type="radio">
                                      </td>
                                      <td align="center" bgcolor="#FFFFFF">兔
                                        <input name="dp1" onClick="r_pan1(2);javascript:ra_select('pan1','2')" value="<?php echo trim($anmail['兔'],',');?>" type="radio">
                                      </td>
                                      <td align="center" bgcolor="#FFFFFF">龙
                                        <input name="dp1" onClick="r_pan1(1);javascript:ra_select('pan1','1')" value="<?php echo trim($anmail['龙'],',');?>" type="radio">
                                      </td>
                                      <td align="center" bgcolor="#FFFFFF">蛇
                                        <input name="dp1" onClick="r_pan1(12);javascript:ra_select('pan1','12')" value="<?php echo trim($anmail['蛇'],',');?>" type="radio">
                                      </td>
                                      <td align="center" bgcolor="#FFFFFF">马
                                        <input name="dp1" onClick="r_pan1(11);javascript:ra_select('pan1','11')" value="<?php echo trim($anmail['马'],',');?>" type="radio">
                                      </td>
                                      <td align="center" bgcolor="#FFFFFF">羊
                                        <input name="dp1" onClick="r_pan1(10);javascript:ra_select('pan1','10')" value="<?php echo trim($anmail['羊'],',');?>" type="radio">
                                      </td>
                                      <td align="center" bgcolor="#FFFFFF">猴
                                        <input name="dp1" onClick="r_pan1(9);javascript:ra_select('pan1','9')" value="<?php echo trim($anmail['猴'],',');?>" type="radio">
                                      </td>
                                      <td align="center" bgcolor="#FFFFFF">鸡
                                        <input name="dp1" onClick="r_pan1(8);javascript:ra_select('pan1','8')" value="<?php echo trim($anmail['鸡'],',');?>" type="radio">
                                      </td>
                                      <td align="center" bgcolor="#FFFFFF">狗
                                        <input name="dp1" onClick="r_pan1(7);javascript:ra_select('pan1','7')" value="<?php echo trim($anmail['狗'],',');?>" type="radio">
                                      </td>
                                      <td align="center" bgcolor="#FFFFFF">猪
                                      <input name="dp1" onClick="r_pan1(6);javascript:ra_select('pan1','6')" value="<?php echo trim($anmail['猪'],',');?>" type="radio">
                                          <input name="pan1" value="" type="hidden">
                                      </td>
                                    </tr>
                                    <tr align="center" bgcolor="E5F5FF">
                                      <td align="center" bgcolor="E5F5FF"><input name="pan2" value="" type="hidden">
                                       鼠
                                        <input name="dp2" onClick="r_pan2(5);javascript:ra_select('pan2','5')" value="<?php echo trim($anmail['鼠'],',');?>" type="radio">
                                      </td>
                                      <td align="center" bgcolor="#E5F5FF">牛
                                        <input name="dp2" onClick="r_pan2(4);javascript:ra_select('pan2','4')" value="<?php echo trim($anmail['牛'],',');?>" type="radio">
                                      </td>
                                      <td align="center" bgcolor="#E5F5FF">虎
                                        <input name="dp2" onClick="r_pan2(3);javascript:ra_select('pan2','3')" value="<?php echo trim($anmail['虎'],',');?>" type="radio">
                                      </td>
                                      <td align="center" bgcolor="#E5F5FF">兔
                                        <input name="dp2" onClick="r_pan2(2);javascript:ra_select('pan2','2')" value="<?php echo trim($anmail['兔'],',');?>" type="radio">
                                      </td>
                                      <td align="center" bgcolor="#E5F5FF">龙
                                        <input name="dp2" onClick="r_pan2(1);javascript:ra_select('pan2','1')" value="<?php echo trim($anmail['龙'],',');?>" type="radio">
                                      </td>
                                      <td align="center" bgcolor="#E5F5FF">蛇
                                        <input name="dp2" onClick="r_pan2(12);javascript:ra_select('pan2','12')" value="<?php echo trim($anmail['蛇'],',');?>" type="radio">
                                      </td>
                                      <td align="center" bgcolor="#E5F5FF">马
                                        <input name="dp2" onClick="r_pan2(11);javascript:ra_select('pan2','11')" value="<?php echo trim($anmail['马'],',');?>" type="radio">
                                      </td>
                                      <td align="center" bgcolor="#E5F5FF">羊
                                        <input name="dp2" onClick="r_pan2(10);javascript:ra_select('pan2','10')" value="<?php echo trim($anmail['羊'],',');?>" type="radio">
                                      </td>
                                      <td align="center" bgcolor="#E5F5FF">猴
                                        <input name="dp2" onClick="r_pan2(9);javascript:ra_select('pan2','9')" value="<?php echo trim($anmail['猴'],',');?>" type="radio">
                                      </td>
                                      <td align="center" bgcolor="#E5F5FF">鸡
                                        <input name="dp2" onClick="r_pan2(8);javascript:ra_select('pan2','8')" value="<?php echo trim($anmail['鸡'],',');?>" type="radio">
                                      </td>
                                      <td align="center" bgcolor="#E5F5FF">狗
                                        <input name="dp2" onClick="r_pan2(7);javascript:ra_select('pan2','7')" value="<?php echo trim($anmail['狗'],',');?>" type="radio">
                                      </td>
                                      <td align="center" bgcolor="#E5F5FF">猪
                                      <input name="dp2" onClick="r_pan2(6);javascript:ra_select('pan2','6')" value="<?php echo trim($anmail['猪'],',');?>" type="radio"></td>
                                    </tr>
                                  </tbody>
                                </table>
                            </div>
                            <div id="a4" style="DISPLAY:none ">
                                <table class="Ball_List" bgcolor="ffffff" border="0" bordercolor="f1f1f1" cellpadding="0" cellspacing="1" width="780">
                                  <tbody>
                                    <tr align="center">
                                      <td align="center" bgcolor="ffffff"><input name="pan3" value="22" type="hidden">
                                        0尾
                                        <input name="dp1" onClick="r_pan3(0);javascript:ra_select('pan3','0')" value="10,20,30,40" type="radio">                                      </td>
                                      <td align="center" bgcolor="ffffff">1尾
                                      <input name="dp1" onClick="r_pan3(1);javascript:ra_select('pan3','1')" value="01,11,21,31,41" type="radio">                                      </td>
                                      <td align="center" bgcolor="ffffff">2尾
                                      <input name="dp1" onClick="r_pan3(2);javascript:ra_select('pan3','2')" value="02,12,22,32,42" type="radio">                                      </td>
                                      <td align="center" bgcolor="ffffff">3尾
                                      <input name="dp1" onClick="r_pan3(3);javascript:ra_select('pan3','3')" value="03,13,23,33,43" type="radio">                                      </td>
                                      <td align="center" bgcolor="ffffff">4尾
                                      <input name="dp1" onClick="r_pan3(4);javascript:ra_select('pan3','4')" value="04,14,24,34,44" type="radio">                                      </td>
                                      <td align="center" bgcolor="ffffff">5尾
                                      <input name="dp1" onClick="r_pan3(5);javascript:ra_select('pan3','5')" value="05,15,25,35,45" type="radio">                                      </td>
                                      <td align="center" bgcolor="ffffff">6尾
                                      <input name="dp1" onClick="r_pan3(6);javascript:ra_select('pan3','6')" value="06,16,26,36,46" type="radio">                                      </td>
                                      <td align="center" bgcolor="ffffff">7尾
                                      <input name="dp1" onClick="r_pan3(7);javascript:ra_select('pan3','7')" value="07,17,27,37,47" type="radio">                                      </td>
                                      <td align="center" bgcolor="ffffff">8尾
                                      <input name="dp1" onClick="r_pan3(8);javascript:ra_select('pan3','8')" value="08,18,28,38,48" type="radio">                                      </td>
                                      <td align="center" bgcolor="ffffff">9尾
                                      <input name="dp1" onClick="r_pan3(9);javascript:ra_select('pan3','9')" value="09,19,29,39,49" type="radio">                                      </td>
                                    </tr>
                                    <tr align="center">
                                      <td align="center" bgcolor="E5F5FF"><input name="pan4" value="11" type="hidden">
                                        0尾
                                      <input name="dp2" onClick="r_pan4(0);javascript:ra_select('pan4','0')" value="10,20,30,40" type="radio">                                      </td>
                                      <td align="center" bgcolor="E5F5FF">1尾
                                      <input name="dp2" onClick="r_pan4(1);javascript:ra_select('pan4','1')" value="01,11,21,31,41" type="radio">                                      </td>
                                      <td align="center" bgcolor="E5F5FF">2尾
                                      <input name="dp2" onClick="r_pan4(2);javascript:ra_select('pan4','2')" value="02,12,22,32,42" type="radio">                                      </td>
                                      <td align="center" bgcolor="E5F5FF">3尾
                                      <input name="dp2" onClick="r_pan4(3);javascript:ra_select('pan4','3')" value="03,13,23,33,43" type="radio">                                      </td>
                                      <td align="center" bgcolor="E5F5FF">4尾
                                      <input name="dp2" onClick="r_pan4(4);javascript:ra_select('pan4','4')" value="04,14,24,34,44" type="radio">                                      </td>
                                      <td align="center" bgcolor="E5F5FF">5尾
                                      <input name="dp2" onClick="r_pan4(5);javascript:ra_select('pan4','5')" value="05,15,25,35,45" type="radio">                                      </td>
                                      <td align="center" bgcolor="E5F5FF">6尾
                                      <input name="dp2" onClick="r_pan4(6);javascript:ra_select('pan4','6')" value="06,16,26,36,46" type="radio">                                      </td>
                                      <td align="center" bgcolor="E5F5FF">7尾
                                      <input name="dp2" onClick="r_pan4(7);javascript:ra_select('pan4','7')" value="07,17,27,37,47" type="radio">                                      </td>
                                      <td align="center" bgcolor="E5F5FF">8尾
                                      <input name="dp2" onClick="r_pan4(8);javascript:ra_select('pan4','8')" value="08,18,28,38,48" type="radio">                                      </td>
                                      <td align="center" bgcolor="E5F5FF">9尾
                                      <input name="dp2" onClick="r_pan4(9);javascript:ra_select('pan4','9')" value="09,19,29,39,49" type="radio"></td>
                                    </tr>
                                  </tbody>
                              </table>
                            </div>
							 <div id="a5" style="DISPLAY: none">
                                <table class="Ball_List" bgcolor="ffffff" border="0" bordercolor="f1f1f1" cellpadding="0" cellspacing="1" width="780">
                                  <tbody>
                                    <tr align="center">
                                      <td align="center" bgcolor="ffffff">
                                        鼠
                                        <input name="dp1" onClick="r_pan5(5);javascript:ra_select('pan5','5')" value="<?php echo trim($anmail['鼠'],',');?>" type="radio">
                                      </td>
                                      <td align="center" bgcolor="#FFFFFF">牛
                                        <input name="dp1" onClick="r_pan5(4);javascript:ra_select('pan5','4')" value="<?php echo trim($anmail['牛'],',');?>" type="radio">
                                      </td>
                                      <td align="center" bgcolor="#FFFFFF">虎
                                        <input name="dp1" onClick="r_pan5(3);javascript:ra_select('pan5','3')" value="<?php echo trim($anmail['虎'],',');?>" type="radio">
                                      </td>
                                      <td align="center" bgcolor="#FFFFFF">兔
                                        <input name="dp1" onClick="r_pan5(2);javascript:ra_select('pan5','2')" value="<?php echo trim($anmail['兔'],',');?>" type="radio">
                                      </td>
                                      <td align="center" bgcolor="#FFFFFF">龙
                                        <input name="dp1" onClick="r_pan5(1);javascript:ra_select('pan5','1')" value="<?php echo trim($anmail['龙'],',');?>" type="radio">
                                      </td>
                                      <td align="center" bgcolor="#FFFFFF">蛇
                                        <input name="dp1" onClick="r_pan5(12);javascript:ra_select('pan5','12')" value="<?php echo trim($anmail['蛇'],',');?>" type="radio">
                                      </td>
                                      <td align="center" bgcolor="#FFFFFF">马
                                        <input name="dp1" onClick="r_pan5(11);javascript:ra_select('pan5','11')" value="<?php echo trim($anmail['马'],',');?>" type="radio">
                                      </td>
                                      <td align="center" bgcolor="#FFFFFF">羊
                                        <input name="dp1" onClick="r_pan5(10);javascript:ra_select('pan5','10')" value="<?php echo trim($anmail['羊'],',');?>" type="radio">
                                      </td>
                                      <td align="center" bgcolor="#FFFFFF">猴
                                        <input name="dp1" onClick="r_pan5(9);javascript:ra_select('pan5','9')" value="<?php echo trim($anmail['猴'],',');?>" type="radio">
                                      </td>
                                      <td align="center" bgcolor="#FFFFFF">鸡
                                        <input name="dp1" onClick="r_pan5(8);javascript:ra_select('pan5','8')" value="<?php echo trim($anmail['鸡'],',');?>" type="radio">
                                      </td>
                                      <td align="center" bgcolor="#FFFFFF">狗
                                        <input name="dp1" onClick="r_pan5(7);javascript:ra_select('pan5','7')" value="<?php echo trim($anmail['狗'],',');?>" type="radio">
                                      </td>
                                      <td align="center" bgcolor="#FFFFFF">猪
                                      <input name="dp1" onClick="r_pan5(6);javascript:ra_select('pan5','6')" value="<?php echo trim($anmail['猪'],',');?>" type="radio"> <input name="pan5" value="" type="hidden">
                                      </td>
                                    </tr>
                                     <tr align="center">
                                      <td align="center" bgcolor="E5F5FF"><input name="pan6" value="" type="hidden">
                                        0尾
                                       <input name="dp2" onClick="r_pan6(0);javascript:ra_select('pan6','0')" value="10,20,30,40" type="radio">                                      </td>
                                      <td align="center" bgcolor="E5F5FF">1尾
                                      <input name="dp2" onClick="r_pan6(1);javascript:ra_select('pan6','1')" value="01,11,21,31,41" type="radio">                                      </td>
                                      <td align="center" bgcolor="E5F5FF">2尾
                                      <input name="dp2" onClick="r_pan6(2);javascript:ra_select('pan6','2')" value="02,12,22,32,42" type="radio">                                      </td>
                                      <td align="center" bgcolor="E5F5FF">3尾
                                      <input name="dp2" onClick="r_pan6(3);javascript:ra_select('pan6','3')" value="03,13,23,33,43" type="radio">                                      </td>
                                      <td align="center" bgcolor="E5F5FF">4尾
                                      <input name="dp2" onClick="r_pan6(4);javascript:ra_select('pan6','4')" value="04,14,24,34,44" type="radio">                                      </td>
                                      <td align="center" bgcolor="E5F5FF">5尾
                                      <input name="dp2" onClick="r_pan6(5);javascript:ra_select('pan6','5')" value="05,15,25,35,45" type="radio">                                      </td>
                                      <td align="center" bgcolor="E5F5FF">6尾
                                      <input name="dp2" onClick="r_pan6(6);javascript:ra_select('pan6','6')" value="06,16,26,36,46" type="radio">                                      </td>
                                      <td align="center" bgcolor="E5F5FF">7尾
                                      <input name="dp2" onClick="r_pan6(7);javascript:ra_select('pan6','7')" value="07,17,27,37,47" type="radio">                                      </td>
                                      <td align="center" bgcolor="E5F5FF">8尾
                                      <input name="dp2" onClick="r_pan6(8);javascript:ra_select('pan6','8')" value="08,18,28,38,48" type="radio">                                      </td>
                                      <td align="center" bgcolor="E5F5FF">9尾
                                      <input name="dp2" onClick="r_pan6(9);javascript:ra_select('pan6','9')" value="09,19,29,39,49" type="radio"></td>
									     <td align="center" bgcolor="E5F5FF"></td>
										  <td align="center" bgcolor="E5F5FF"></td>
                                    </tr>
									
                                  </tbody>
                               </table>
                            </div>
							
							 <div id="a6" style="DISPLAY:none ">
							
						   <table class="Ball_List" bgcolor="ffffff" border="0" bordercolor="f1f1f1" cellpadding="0" cellspacing="1" width="780">
                               <tbody><tr>
                                 <td bgcolor="#FFFFFF"><table border="0" cellpadding="0" cellspacing="1" width="100%">
                                                                      <tbody><tr>
                                     <td class="ball_ff" nowrap="nowrap"><input onClick="Suc1(this,1)" value="01" name="mc11" type="checkbox">
                                         <font color="ff0000">
                                           01                                     </font></td>
                                     <td class="ball_ff" nowrap="nowrap"><input onClick="Suc1(this,2)" value="02" name="mc12" type="checkbox">
                                         <font color="ff0000">
                                           02                                     </font></td>
                                     <td class="ball_ff" nowrap="nowrap"><input onClick="Suc1(this,3)" value="03" name="mc13" type="checkbox">
                                         <font color="0000FF">
                                          03                                     </font></td>
                                     <td class="ball_ff" nowrap="nowrap"><input onClick="Suc1(this,4)" value="04" name="mc14" type="checkbox">
                                         <font color="0000FF">
                                         04                                     </font></td>
                                     <td class="ball_ff" nowrap="nowrap"><input onClick="Suc1(this,5)" value="05" name="mc15" type="checkbox">
                                         <font color="009900">
                                           05                                     </font></td>
                                     <td class="ball_ff" nowrap="nowrap"><input onClick="Suc1(this,6)" value="06" name="mc16" type="checkbox">
                                         <font color="009900">
                                           06                                     </font></td>
                                     <td class="ball_ff" nowrap="nowrap"><input onClick="Suc1(this,7)" value="07" name="mc17" type="checkbox">
                                         <font color="ff0000">
                                           07                                     </font></td>
                                     <td class="ball_ff" nowrap="nowrap"><input onClick="Suc1(this,8)" value="08" name="mc18" type="checkbox">
                                         <font color="ff0000">
                                           08                                     </font></td>
                                     <td class="ball_ff" nowrap="nowrap"><input onClick="Suc1(this,9)" value="09" name="mc19" type="checkbox">
                                         <font color="0000FF">
                                           09                                     </font></td>
                                     <td class="ball_ff" nowrap="nowrap"><input onClick="Suc1(this,10)" value="10" name="mc110" type="checkbox">
                                         <font color="0000FF">
                                           10                                     </font></td>
                                     <td class="ball_ff" nowrap="nowrap"><input onClick="Suc1(this,11)" value="11" name="mc111" type="checkbox">
                                         <font color="009900">
                                           11                                     </font></td>
                                     <td class="ball_ff" nowrap="nowrap"><input onClick="Suc1(this,12)" value="12" name="mc112" type="checkbox">
                                         <font color="ff0000">
                                           12                                     </font></td>
                                     <td class="ball_ff" nowrap="nowrap"><input onClick="Suc1(this,13)" value="13" name="mc113" type="checkbox">
                                         <font color="ff0000">
                                           13                                     </font></td>
                                     <td class="ball_ff" nowrap="nowrap"><input onClick="Suc1(this,14)" value="14" name="mc114" type="checkbox">
                                         <font color="0000FF">
                                           14                                     </font></td>
                                     <td class="ball_ff" nowrap="nowrap"><input onClick="Suc1(this,15)" value="15" name="mc115" type="checkbox">
                                         <font color="0000FF">
                                           15                                     </font></td>
                                                                          <td class="ball_ff" nowrap="nowrap"><input onClick="Suc1(this,16)" value="16" name="mc116" type="checkbox">
                                         <font color="009900">
                                           16                                     </font></td>
                                     <td class="ball_ff" nowrap="nowrap"><input onClick="Suc1(this,17)" value="17" name="mc117" type="checkbox">
                                         <font color="009900">
                                           17                                     </font></td>
                                                                        </tr>
                                                                      <tr>
                                     <td class="ball_ff" nowrap="nowrap"><input onClick="Suc1(this,18)" value="18" name="mc118" type="checkbox">
                                         <font color="ff0000">
                                           18                                     </font></td>
                                     <td class="ball_ff" nowrap="nowrap"><input onClick="Suc1(this,19)" value="19" name="mc119" type="checkbox">
                                         <font color="ff0000">
                                           19                                     </font></td>
                                     <td class="ball_ff" nowrap="nowrap"><input onClick="Suc1(this,20)" value="20" name="mc120" type="checkbox">
                                         <font color="0000FF">
                                          20                                     </font></td>
                                     <td class="ball_ff" nowrap="nowrap"><input onClick="Suc1(this,21)" value="21" name="mc121" type="checkbox">
                                         <font color="009900">
                                         21                                     </font></td>
                                     <td class="ball_ff" nowrap="nowrap"><input onClick="Suc1(this,22)" value="22" name="mc122" type="checkbox">
                                         <font color="009900">
                                           22                                     </font></td>
                                     <td class="ball_ff" nowrap="nowrap"><input onClick="Suc1(this,23)" value="23" name="mc123" type="checkbox">
                                         <font color="ff0000">
                                           23                                     </font></td>
                                     <td class="ball_ff" nowrap="nowrap"><input onClick="Suc1(this,24)" value="24" name="mc124" type="checkbox">
                                         <font color="ff0000">
                                           24                                     </font></td>
                                     <td class="ball_ff" nowrap="nowrap"><input onClick="Suc1(this,25)" value="25" name="mc125" type="checkbox">
                                         <font color="0000FF">
                                           25                                     </font></td>
                                     <td class="ball_ff" nowrap="nowrap"><input onClick="Suc1(this,26)" value="26" name="mc126" type="checkbox">
                                         <font color="0000FF">
                                           26                                     </font></td>
                                     <td class="ball_ff" nowrap="nowrap"><input onClick="Suc1(this,27)" value="27" name="mc127" type="checkbox">
                                         <font color="009900">
                                           27                                     </font></td>
                                     <td class="ball_ff" nowrap="nowrap"><input onClick="Suc1(this,28)" value="28" name="mc128" type="checkbox">
                                         <font color="009900">
                                           28                                     </font></td>
                                     <td class="ball_ff" nowrap="nowrap"><input onClick="Suc1(this,29)" value="29" name="mc129" type="checkbox">
                                         <font color="ff0000">
                                           29                                     </font></td>
                                     <td class="ball_ff" nowrap="nowrap"><input onClick="Suc1(this,30)" value="30" name="mc130" type="checkbox">
                                         <font color="ff0000">
                                           30                                     </font></td>
                                     <td class="ball_ff" nowrap="nowrap"><input onClick="Suc1(this,31)" value="31" name="mc131" type="checkbox">
                                         <font color="0000FF">
                                           31                                     </font></td>
                                     <td class="ball_ff" nowrap="nowrap"><input onClick="Suc1(this,32)" value="32" name="mc132" type="checkbox">
                                         <font color="009900">
                                           32                                     </font></td>
                                                                          <td class="ball_ff" nowrap="nowrap"><input onClick="Suc1(this,33)" value="33" name="mc133" type="checkbox">
                                         <font color="009900">
                                           33                                     </font></td>
                                     <td class="ball_ff" nowrap="nowrap"><input onClick="Suc1(this,34)" value="34" name="mc134" type="checkbox">
                                         <font color="ff0000">
                                           34                                     </font></td>
                                                                        </tr>
                                                                      <tr>
                                     <td class="ball_ff" nowrap="nowrap"><input onClick="Suc1(this,35)" value="35" name="mc135" type="checkbox">
                                         <font color="ff0000">
                                           35                                     </font></td>
                                     <td class="ball_ff" nowrap="nowrap"><input onClick="Suc1(this,36)" value="36" name="mc136" type="checkbox">
                                         <font color="0000FF">
                                           36                                     </font></td>
                                     <td class="ball_ff" nowrap="nowrap"><input onClick="Suc1(this,37)" value="37" name="mc137" type="checkbox">
                                         <font color="0000FF">
                                          37                                     </font></td>
                                     <td class="ball_ff" nowrap="nowrap"><input onClick="Suc1(this,38)" value="38" name="mc138" type="checkbox">
                                         <font color="009900">
                                         38                                     </font></td>
                                     <td class="ball_ff" nowrap="nowrap"><input onClick="Suc1(this,39)" value="39" name="mc139" type="checkbox">
                                         <font color="009900">
                                           39                                     </font></td>
                                     <td class="ball_ff" nowrap="nowrap"><input onClick="Suc1(this,40)" value="40" name="mc140" type="checkbox">
                                         <font color="ff0000">
                                           40                                     </font></td>
                                     <td class="ball_ff" nowrap="nowrap"><input onClick="Suc1(this,41)" value="41" name="mc141" type="checkbox">
                                         <font color="0000FF">
                                           41                                     </font></td>
                                     <td class="ball_ff" nowrap="nowrap"><input onClick="Suc1(this,42)" value="42" name="mc142" type="checkbox">
                                         <font color="0000FF">
                                           42                                     </font></td>
                                     <td class="ball_ff" nowrap="nowrap"><input onClick="Suc1(this,43)" value="43" name="mc143" type="checkbox">
                                         <font color="009900">
                                           43                                     </font></td>
                                     <td class="ball_ff" nowrap="nowrap"><input onClick="Suc1(this,44)" value="44" name="mc144" type="checkbox">
                                         <font color="009900">
                                           44                                     </font></td>
                                     <td class="ball_ff" nowrap="nowrap"><input onClick="Suc1(this,45)" value="45" name="mc145" type="checkbox">
                                         <font color="ff0000">
                                           45                                     </font></td>
                                     <td class="ball_ff" nowrap="nowrap"><input onClick="Suc1(this,46)" value="46" name="mc146" type="checkbox">
                                         <font color="ff0000">
                                           46                                     </font></td>
                                     <td class="ball_ff" nowrap="nowrap"><input onClick="Suc1(this,47)" value="47" name="mc147" type="checkbox">
                                         <font color="0000FF">
                                           47                                     </font></td>
                                     <td class="ball_ff" nowrap="nowrap"><input onClick="Suc1(this,48)" value="48" name="mc148" type="checkbox">
                                         <font color="0000FF">
                                           48                                     </font></td>
                                     <td class="ball_ff" nowrap="nowrap"><input onClick="Suc1(this,49)" value="49" name="mc149" type="checkbox">
                                         <font color="009900">
                                           49                                     </font></td>
                                                                          <td class="ball_ff" nowrap="nowrap"></td>
                                     <td class="ball_ff" nowrap="nowrap"></td>
                                                                        </tr>
                                                                    </tbody></table></td>
                               </tr>
                               <tr>
                                 <td class="td_caption_1" align="center"><span class="STYLE4">對碰</span></td>
                               </tr>
                               <tr>
                                 <td bgcolor="#E5F5FF"><table border="0" cellpadding="0" cellspacing="1" width="100%">
                                                                      <tbody><tr>
                                     <td class="ball_ff" nowrap="nowrap"><input onClick="Suc2(this,1)" value="01" name="mc21" type="checkbox">
                                         <font color="ff0000">
                                          01                                     </font></td>
                                     <td class="ball_ff" nowrap="nowrap"><input onClick="Suc2(this,2)" value="02" name="mc22" type="checkbox">
                                         <font color="ff0000">
                                           02                                     </font></td>
                                     <td class="ball_ff" nowrap="nowrap"><input onClick="Suc2(this,3)" value="03" name="mc23" type="checkbox">
                                         <font color="0000FF">
                                           03                                     </font></td>
                                     <td class="ball_ff" nowrap="nowrap"><input onClick="Suc2(this,4)" value="04" name="mc24" type="checkbox">
                                         <font color="0000FF">
                                           04                                     </font></td>
                                     <td class="ball_ff" nowrap="nowrap"><input onClick="Suc2(this,5)" value="05" name="mc25" type="checkbox">
                                         <font color="009900">
                                           05                                     </font></td>
                                     <td class="ball_ff" nowrap="nowrap"><input onClick="Suc2(this,6)" value="06" name="mc26" type="checkbox">
                                         <font color="009900">
                                           06                                     </font></td>
                                     <td class="ball_ff" nowrap="nowrap"><input onClick="Suc2(this,7)" value="07" name="mc27" type="checkbox">
                                         <font color="ff0000">
                                           07                                     </font></td>
                                     <td class="ball_ff" nowrap="nowrap"><input onClick="Suc2(this,8)" value="08" name="mc28" type="checkbox">
                                         <font color="ff0000">
                                           08                                     </font></td>
                                     <td class="ball_ff" nowrap="nowrap"><input onClick="Suc2(this,9)" value="09" name="mc29" type="checkbox">
                                         <font color="0000FF">
                                           09                                     </font></td>
                                     <td class="ball_ff" nowrap="nowrap"><input onClick="Suc2(this,10)" value="10" name="mc210" type="checkbox">
                                         <font color="0000FF">
                                           10                                     </font></td>
                                     <td class="ball_ff" nowrap="nowrap"><input onClick="Suc2(this,11)" value="11" name="mc211" type="checkbox">
                                         <font color="009900">
                                           11                                     </font></td>
                                     <td class="ball_ff" nowrap="nowrap"><input onClick="Suc2(this,12)" value="12" name="mc212" type="checkbox">
                                         <font color="ff0000">
                                           12                                     </font></td>
                                     <td class="ball_ff" nowrap="nowrap"><input onClick="Suc2(this,13)" value="13" name="mc213" type="checkbox">
                                         <font color="ff0000">
                                           13                                     </font></td>
                                     <td class="ball_ff" nowrap="nowrap"><input onClick="Suc2(this,14)" value="14" name="mc214" type="checkbox">
                                         <font color="0000FF">
                                           14                                     </font></td>
                                     <td class="ball_ff" nowrap="nowrap"><input onClick="Suc2(this,15)" value="15" name="mc215" type="checkbox">
                                         <font color="0000FF">
                                           15                                     </font></td>
                                                                          <td class="ball_ff" nowrap="nowrap"><input onClick="Suc2(this,16)" value="16" name="mc216" type="checkbox">
                                         <font color="009900">
                                           16                                     </font></td>
                                     <td class="ball_ff" nowrap="nowrap"><input onClick="Suc2(this,17)" value="17" name="mc217" type="checkbox">
                                         <font color="009900">
                                           17                                     </font></td>
                                                                        </tr>
                                                                      <tr>
                                     <td class="ball_ff" nowrap="nowrap"><input onClick="Suc2(this,18)" value="18" name="mc218" type="checkbox">
                                         <font color="ff0000">
                                          18                                     </font></td>
                                     <td class="ball_ff" nowrap="nowrap"><input onClick="Suc2(this,19)" value="19" name="mc219" type="checkbox">
                                         <font color="ff0000">
                                           19                                     </font></td>
                                     <td class="ball_ff" nowrap="nowrap"><input onClick="Suc2(this,20)" value="20" name="mc220" type="checkbox">
                                         <font color="0000FF">
                                           20                                     </font></td>
                                     <td class="ball_ff" nowrap="nowrap"><input onClick="Suc2(this,21)" value="21" name="mc221" type="checkbox">
                                         <font color="009900">
                                           21                                     </font></td>
                                     <td class="ball_ff" nowrap="nowrap"><input onClick="Suc2(this,22)" value="22" name="mc222" type="checkbox">
                                         <font color="009900">
                                           22                                     </font></td>
                                     <td class="ball_ff" nowrap="nowrap"><input onClick="Suc2(this,23)" value="23" name="mc223" type="checkbox">
                                         <font color="ff0000">
                                           23                                     </font></td>
                                     <td class="ball_ff" nowrap="nowrap"><input onClick="Suc2(this,24)" value="24" name="mc224" type="checkbox">
                                         <font color="ff0000">
                                           24                                     </font></td>
                                     <td class="ball_ff" nowrap="nowrap"><input onClick="Suc2(this,25)" value="25" name="mc225" type="checkbox">
                                         <font color="0000FF">
                                           25                                     </font></td>
                                     <td class="ball_ff" nowrap="nowrap"><input onClick="Suc2(this,26)" value="26" name="mc226" type="checkbox">
                                         <font color="0000FF">
                                           26                                     </font></td>
                                     <td class="ball_ff" nowrap="nowrap"><input onClick="Suc2(this,27)" value="27" name="mc227" type="checkbox">
                                         <font color="009900">
                                           27                                     </font></td>
                                     <td class="ball_ff" nowrap="nowrap"><input onClick="Suc2(this,28)" value="28" name="mc228" type="checkbox">
                                         <font color="009900">
                                           28                                     </font></td>
                                     <td class="ball_ff" nowrap="nowrap"><input onClick="Suc2(this,29)" value="29" name="mc229" type="checkbox">
                                         <font color="ff0000">
                                           29                                     </font></td>
                                     <td class="ball_ff" nowrap="nowrap"><input onClick="Suc2(this,30)" value="30" name="mc230" type="checkbox">
                                         <font color="ff0000">
                                           30                                     </font></td>
                                     <td class="ball_ff" nowrap="nowrap"><input onClick="Suc2(this,31)" value="31" name="mc231" type="checkbox">
                                         <font color="0000FF">
                                           31                                     </font></td>
                                     <td class="ball_ff" nowrap="nowrap"><input onClick="Suc2(this,32)" value="32" name="mc232" type="checkbox">
                                         <font color="009900">
                                           32                                     </font></td>
                                                                          <td class="ball_ff" nowrap="nowrap"><input onClick="Suc2(this,33)" value="33" name="mc233" type="checkbox">
                                         <font color="009900">
                                           33                                     </font></td>
                                     <td class="ball_ff" nowrap="nowrap"><input onClick="Suc2(this,34)" value="34" name="mc234" type="checkbox">
                                         <font color="ff0000">
                                           34                                     </font></td>
                                                                        </tr>
                                                                      <tr>
                                     <td class="ball_ff" nowrap="nowrap"><input onClick="Suc2(this,35)" value="35" name="mc235" type="checkbox">
                                         <font color="ff0000">
                                          35                                     </font></td>
                                     <td class="ball_ff" nowrap="nowrap"><input onClick="Suc2(this,36)" value="36" name="mc236" type="checkbox">
                                         <font color="0000FF">
                                           36                                     </font></td>
                                     <td class="ball_ff" nowrap="nowrap"><input onClick="Suc2(this,37)" value="37" name="mc237" type="checkbox">
                                         <font color="0000FF">
                                           37                                     </font></td>
                                     <td class="ball_ff" nowrap="nowrap"><input onClick="Suc2(this,38)" value="38" name="mc238" type="checkbox">
                                         <font color="009900">
                                           38                                     </font></td>
                                     <td class="ball_ff" nowrap="nowrap"><input onClick="Suc2(this,39)" value="39" name="mc239" type="checkbox">
                                         <font color="009900">
                                           39                                     </font></td>
                                     <td class="ball_ff" nowrap="nowrap"><input onClick="Suc2(this,40)" value="40" name="mc240" type="checkbox">
                                         <font color="ff0000">
                                           40                                     </font></td>
                                     <td class="ball_ff" nowrap="nowrap"><input onClick="Suc2(this,41)" value="41" name="mc241" type="checkbox">
                                         <font color="0000FF">
                                           41                                     </font></td>
                                     <td class="ball_ff" nowrap="nowrap"><input onClick="Suc2(this,42)" value="42" name="mc242" type="checkbox">
                                         <font color="0000FF">
                                           42                                     </font></td>
                                     <td class="ball_ff" nowrap="nowrap"><input onClick="Suc2(this,43)" value="43" name="mc243" type="checkbox">
                                         <font color="009900">
                                           43                                     </font></td>
                                     <td class="ball_ff" nowrap="nowrap"><input onClick="Suc2(this,44)" value="44" name="mc244" type="checkbox">
                                         <font color="009900">
                                           44                                     </font></td>
                                     <td class="ball_ff" nowrap="nowrap"><input onClick="Suc2(this,45)" value="45" name="mc245" type="checkbox">
                                         <font color="ff0000">
                                           45                                     </font></td>
                                     <td class="ball_ff" nowrap="nowrap"><input onClick="Suc2(this,46)" value="46" name="mc246" type="checkbox">
                                         <font color="ff0000">
                                           46                                     </font></td>
                                     <td class="ball_ff" nowrap="nowrap"><input onClick="Suc2(this,47)" value="47" name="mc247" type="checkbox">
                                         <font color="0000FF">
                                           47                                     </font></td>
                                     <td class="ball_ff" nowrap="nowrap"><input onClick="Suc2(this,48)" value="48" name="mc248" type="checkbox">
                                         <font color="0000FF">
                                           48                                     </font></td>
                                     <td class="ball_ff" nowrap="nowrap"><input onClick="Suc2(this,49)" value="49" name="mc249" type="checkbox">
                                         <font color="009900">
                                           49                                     </font></td>
                                                                          <td class="ball_ff" nowrap="nowrap"></td>
                                     <td class="ball_ff" nowrap="nowrap"></td>
                                                                        </tr>
                                                                    </tbody></table></td>
                               </tr>
                             </tbody></table></div>

                                                    
</td>
	              </tr>
   				            <tr onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor='ffffff'" id="cc6699" bgcolor="#FFFFFF">
						  
						    <td bordercolor="cccccc" align="center" height="25"><table border="0" cellpadding="0" cellspacing="0" width="200">
                              <tbody><tr>
                                <td align="right">下註金額：</td>
                                <td><span id="gold1"><input onKeyPress="return CheckKey();" onBlur="this.className='inp1';return CountGold(this,'blur','SP','0','1');" onKeyUp="return CountGold(this,'keyup');" onFocus="this.className='inp1m';CountGold(this,'focus');this.value='';" style="height: 18px;" size="6" name="x_orders_y" class="inp1"></span></td>
                                <td><input name="btnSubmit"  class="btn2"  value="下注" type="Submit" <?php if(empty($tezhengma)){ echo 'disabled';}?>>
                                <input name="sxl" id="sxl" value="2" type="hidden">
                                <span class="Font_W">
                                <input name="c1" id="c1" value="0" type="hidden">
                                <input name="c2" id="c2" value="0" type="hidden">
                                </span></td>
                              </tr>
                            </tbody></table>						      </td>
   				            </tr></form>
  </tbody></table> 
               
							
                          
            
                
                            </div>
            <!-- 結束  -->
<script>
			
 var type_nums = 12;  //預設為 3中2
type_min1 =document.all.sxl.value;
type_min=eval(type_min1);
var cb_num = 1;
var mess1 =  '最少選擇';
var mess11 = '個数字';


function SubChk(obj) {

type_min = document.all.sxl.value; 
type_nums=12;
type_min=eval(type_min);
type_min2=eval(document.all.sxl.value);
 

var cb_num = 1;
var mess1 =  '最少選擇';
var mess11 = '個尾';
var mess2 =  '最多選擇'+type_nums+'個';
var mess = mess2;

var checkCount = 0;
var checknum = obj.elements.length;
var rtypechk = 0;	
	
	for(i=0; i<checknum; i++) {
		if (obj.elements[i].checked) {
			checkCount ++;
		}
	}
	
	if (eval(document.all.allgold.value)<=0)
	{
		alert("請輸入下註金額!!");
	    document.all.btnSubmit.disabled = false;
		return false;

	}	
	
	 
 
	
	if (checkCount > (type_nums+1)) {
		alert(mess2);
		return false;
	}if(checkCount < (type_mins+1)){
	//alert(checkCount);
		alert(mess1+type_min2+mess11);
		return false;
	}else{
		document.all.btnSubmit.disabled =true ;
		return true;
	}
	
	 

	
}


function SubChkBox(obj,bmbm) {
var sxsx6="sxsx6"+bmbm
	if(obj.checked == false)
	{
		cb_num--;
		document.all[sxsx6].value=0
		//obj.checked = false;
		for(bmbmw=1;bmbmw<50;bmbmw++){
		
		if (document.all.dm1.value!=bmbmw && document.all.dm2.value!=bmbmw){ 
		MM_changeProp('num'+bmbmw,'','disabled','0','INPUT/CHECKBOX')
		}
		
		}
	}
	
	
	if(obj.checked == true)
	{
		if ( cb_num > type_nums ) 
		{
			alert("最多選擇12個");
			cb_num--;
			document.all[sxsx6].value=0
			obj.checked = false;
		}
		document.all[sxsx6].value=1
		cb_num++;
		
		if (cb_num>type_nums){
		for(bmbmw=1;bmbmw<50;bmbmw++){
		var wsxsx6="sxsx6"+bmbmw
		if (document.all[wsxsx6].value==0){
		MM_changeProp('num'+bmbmw,'','disabled','disabled','INPUT/CHECKBOX')
		}
		}
		} 
		
		
		
		
	
	}
	
	
	
	
	var str1="pabc";
var str2="ex2";
var str3="dm1";
var str4="dm2";

if(document.all[str1].value ==2)

{
if(document.all[str2].value =="三全中" || document.all[str2].value =="三中二")

{

if (document.all[str3].value ==""){
MM_changeProp('num'+bmbm,'','disabled','disabled','INPUT/CHECKBOX')
///MM_changeProp('num'+i,'','checked','0','INPUT/CHECKBOX');
document.all[str3].value = bmbm;
MM_changeProp('dm1','','disabled','0','INPUT/text')
}else
{
if (document.all[str4].value ==""){
MM_changeProp('num'+bmbm,'','disabled','disabled','INPUT/CHECKBOX')
MM_changeProp('dm2','','disabled','0','INPUT/text')
///MM_changeProp('num'+i,'','checked','0','INPUT/CHECKBOX');
document.all[str4].value = bmbm;
}
}


}else
{
if (document.all[str3].value ==""){
MM_changeProp('num'+bmbm,'','disabled','disabled','INPUT/CHECKBOX')
MM_changeProp('dm1','','disabled','0','INPUT/text')
///MM_changeProp('num'+i,'','checked','0','INPUT/CHECKBOX');
document.all[str3].value = bmbm;
}

}


}

	
	//if (cb_num>type_min){
	// document.all.btnSubmit.disabled = false;
	//}else{
	// document.all.btnSubmit.disabled =true ;
	//}
//alert (cb_num);
}









 function deafults(){
 cb_num=1;
  //quick5();
for(i=1; i<50; i++) {
MM_changeProp('num'+i,'','disabled','0','INPUT/CHECKBOX')
MM_changeProp('num'+i,'','checked','0','INPUT/CHECKBOX');
var sxsx6="sxsx6"+i
document.all[sxsx6].value=0
document.all.dm1.value=""
document.all.dm2.value=""
}

 tmp2 = document.getElementById("Num_1");
 tmp2.value='';

document.all.btnSubmit.disabled = false;
document.getElementById("gold_all").value='';
document.all.allgold.value ='0';
 }
  function deafults1(){
document.all.btnSubmit.disabled = false;
 }


function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_changeProp(objName,x,theProp,theValue) { //v6.0
  var obj = MM_findObj(objName);
  if (obj && (theProp.indexOf("style.")==-1 || obj.style)){
    if (theValue == true || theValue == false)
      eval("obj."+theProp+"="+theValue);
    else eval("obj."+theProp+"='"+theValue+"'");
  }
}

function MM_validateForm() { //v4.0
  var i,p,q,nm,test,num,min,max,errors='',args=MM_validateForm.arguments;
  for (i=0; i<(args.length-2); i+=3) { test=args[i+2]; val=MM_findObj(args[i]);
    if (val) { nm=val.name; if ((val=val.value)!="") {
      if (test.indexOf('isEmail')!=-1) { p=val.indexOf('@');
        if (p<1 || p==(val.length-1)) errors+='- '+nm+' must contain an e-mail address.\n';
      } else if (test!='R') { num = parseFloat(val);
        if (isNaN(val)) errors+='- '+nm+' must contain a number.\n';
        if (test.indexOf('inRange') != -1) { p=test.indexOf(':');
          min=test.substring(8,p); max=test.substring(p+1);
          if (num<min || max<num) errors+='- '+nm+' must contain a number between '+min+' and '+max+'.\n';
    } } } else if (test.charAt(0) == 'R') errors += '- '+nm+' is required.\n'; }
  } if (errors) alert('The following error(s) occurred:\n'+errors);
  document.MM_returnValue = (errors == '');
}

 </script>
			

<script language="javascript">
cb_num=0;
function Suc1(obj,bmbm) {

if(obj.checked == false)
{
cb_num--;
document.getElementById("c1").value=eval(eval(document.getElementById("c1").value)-1);
MM_changeProp('mc2'+bmbm,'','disabled','0','INPUT/CHECKBOX')
MM_changeProp('mc2'+bmbm,'','checked','0','INPUT/CHECKBOX');		
}


if(obj.checked == true)
{
cb_num++;
document.getElementById("c1").value=eval(eval(document.getElementById("c1").value)+1);
MM_changeProp('mc2'+bmbm,'','disabled','disabled','INPUT/CHECKBOX')
MM_changeProp('mc2'+bmbm,'','checked','0','INPUT/CHECKBOX');		
}

}
function Suc2(obj,bmbm) {

if(obj.checked == false)
{
cb_num--;
document.getElementById("c2").value=eval(eval(document.getElementById("c2").value)-1);
MM_changeProp('mc1'+bmbm,'','disabled','0','INPUT/CHECKBOX')
MM_changeProp('mc1'+bmbm,'','checked','0','INPUT/CHECKBOX');		
}


if(obj.checked == true)
{
cb_num++;
document.getElementById("c2").value=eval(eval(document.getElementById("c2").value)+1);
MM_changeProp('mc1'+bmbm,'','disabled','disabled','INPUT/CHECKBOX')
MM_changeProp('mc1'+bmbm,'','checked','0','INPUT/CHECKBOX');		
}

}
var normalelapse = 1000;
var nextelapse = normalelapse;
var counter; 
var startTime;
var ClockTime_C = "00:00:00";
var ClockTime_O = "00:00:00"; 
var finish = "00:00:00";
var timer = null;



// 開始運行
function Run_onTimer() {
  counter = 0;
  // 初始化開始時間
  startTime = new Date().valueOf();
  
  document.getElementById("hClockTime_C").innerHTML=ClockTime_C.substr(0);
  //document.getElementById("hClockTime_O").innerHTML=ClockTime_O.substr(0);

  // nextelapse是定時時間, 初始時為1000毫秒
  // 註意setInterval函数: 時間逝去nextelapse(毫秒)後, onTimer才開始執行
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

// 倒計時函数
function onTimer(){

	if (ClockTime_O == finish){//時間到就刷新頁面
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
                   // objTD.innerHTML="封盤";
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
	
	// 清除上一次的定時器
	window.clearInterval(timer);
	
	// 自校驗系統時間得到時間差, 並由此得到下次所啟動的新定時器的時間nextelapse
	counter++; 
	var counterSecs = counter * 1000;
	var elapseSecs = new Date().valueOf() - startTime;
	var diffSecs = counterSecs - elapseSecs;
	nextelapse = normalelapse + diffSecs;
	if (nextelapse < 0) nextelapse = 0;
	
	// 啟動新的定時器
	timer = window.setInterval("onTimer()", nextelapse); 
}



ClockTime_C="<?php echo  $bbbccc.":".$ddd.":".$eee;?>";
ClockTime_O="<?php echo  $bbbccc.":".$ddd.":".$eee;?>";

Run_onTimer();
 
 </script>
</body></html>