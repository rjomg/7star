<?php
include_once ('../global.php');
$db = new action($mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset); //数据库操作类.
?>
<html oncontextmenu="return false" xmlns="http://www.w3.org/1999/xhtml">
<head>
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
<body onselect="document.selection.empty()" oncopy="document.selection.empty()" onmouseover="self.status='歡迎光臨';return true">
<link href="../images/Index.css" rel="stylesheet" type="text/css">
<script language="JavaScript">
var count_win=false;
function CheckKey(){
	if(event.keyCode == 13) return true;
	if((event.keyCode < 48 || event.keyCode > 57) && (event.keyCode > 95 || event.keyCode < 106)){alert("下註金額僅能輸入数字!!"); return false;}
}

function ChkSubmit(){
    //設定『確定』鍵為反白 
	document.all.btnSubmit.disabled = true;
	if (eval(document.all.allgold.value)<=0 )
	{
		alert("請輸入下註金額!!");
	    document.all.btnSubmit.disabled = false;
		return false;
	}
       // if (!confirm("是否確定下註")){
	   // document.all.btnSubmit.disabled = false;
       // return false;
       // }        
		document.all.gold_all.value=eval(document.all.allgold.value)
        document.lt_form.submit();
}


function CountGold(gold,type,rtype,bb,ffb){
  switch(type) {
  	  case "focus":
  	  	goldvalue = gold.value;
  	  	if (goldvalue=='') goldvalue=0;
  	document.all.allgold.value = eval(document.all.allgold.value+"-"+goldvalue);
  	  	total_gold.value = document.all.allgold.value;
	
  	break;
  	  case "blur":
	  if (goldvalue!='')
  	  	{goldvalue = gold.value;
  	  	if (goldvalue=='') goldvalue=0;

 
		
 

if (rtype=='SP' && eval(goldvalue)<document.all.m.value  && eval(goldvalue)!=0) {gold.focus(); alert("下註金額不可小於最低限度 : "+document.all.m.value+"!!"); return false;}
if (rtype=='SP' && (eval(eval(bb)+eval(goldvalue)) > document.all.mm.value)) {gold.focus(); alert("對不起,止號本期下註金額最高限制 : "+document.all.mm.value+"!!"); return false;}
if (rtype=='SP' && (eval(goldvalue) > document.all.mmm.value)) {gold.focus(); alert("對不起,下註金額已超過单註限額 : "+document.all.mmm.value+"!!"); return false;}

if (rtype=='SM' && eval(goldvalue)<document.all.xm.value  && eval(goldvalue)!=0) {gold.focus(); alert("下註金額不可小於最低限度 : "+document.all.xm.value+"!!"); return false;}
if (rtype=='SM' && (eval(eval(bb)+eval(goldvalue)) > document.all.xmm.value)) {gold.focus(); alert("對不起,止號本期下註金額最高限制 : "+document.all.xmm.value+"!!"); return false;}
if (rtype=='SM' && (eval(goldvalue) > document.all.xmmm.value)) {gold.focus(); alert("對不起,下註金額已超過单註限額 : "+document.all.xmmm.value+"!!"); return false;}

if (rtype=='BS' && eval(goldvalue)<document.all.bm.value  && eval(goldvalue)!=0) {gold.focus(); alert("下註金額不可小於最低限度 : "+document.all.bm.value+"!!"); return false;}
if (rtype=='BS' && (eval(eval(bb)+eval(goldvalue)) > document.all.bmm.value)) {gold.focus(); alert("對不起,止號本期下註金額最高限制 : "+document.all.bmm.value+"!!"); return false;}
if (rtype=='BS' && (eval(goldvalue) > document.all.bmmm.value)) {gold.focus(); alert("對不起,下註金額已超過单註限額 : "+document.all.bmmm.value+"!!"); return false;}

		
		
	 
if (eval(document.all.allgold.value) > 0)   {gold.focus(); alert("下註金額不可大於可用信用額度!!");    return false;}
		}
 break;
  	  case "keyup":
  	  	goldvalue = gold.value;
  	  	if (goldvalue=='') goldvalue=0;
		 document.all.allgold.value = eval(total_gold.value+"\+"+ goldvalue);
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
           
		  // alert(result);
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
gold="gold"+(i-1);
document.all[gold].innerHTML= "封盤";
}

}
        } else {//http_request.status != 200
                alert("Request failed! ");
        }
    }
}



function editArray1(c){
tmp= c.value;

 var tmpp = tmp.split(",");
var ctmpp=tmpp.length;
;
if(c.checked==true){
 for(var bs=0;bs<ctmpp;bs=bs+1)
{
tmp1 = document.getElementById("chk_"+tmpp[bs]);
tmp1.value = "Y";
}
}else{
 for(var bs=0;bs<ctmpp;bs=bs+1)
{
tmp1 = document.getElementById("chk_"+tmpp[bs]);
tmp1.value = "N";
}
}	
 	relocate();
 }

function editArray(type){
 	tmp1 = document.getElementById("chk_"+type);
 	if(tmp1.value=="N"){
 		tmp1.value = "Y";
 	}else{
 		tmp1.value = "N";
 	}
 	relocate();
 }
 
function editArray2(){
document.all.allgold.value="0";
document.all.total_gold.value="0";
document.all.gold_all.value="0";
ResetControl();

 for(i=1;i<50;i++){
 if(i<10){
 			type = '0'+i;
 		}else{
 			type = i;
 		}
document.all["chk_"+type].value = "N";
document.all["Num_"+i].value ="";
}

if (document.all.ex2.value=="正码A" || document.all.ex2.value=="正码B"){var cf=53;}else{var cf=62;}
for(i=50;i<=cf;i++){
document.all["Num_"+i].value="";
}

relocate();
}

function editArray5(){
var srt=document.all.num.value;
if (srt.length<=3 )	{alert("请输入下注号码和金额!!");return false;}
var arrResult= srt.split(" ");	
 for(var i=0;i<arrResult.length;i++){
 var dsult=arrResult[i];
 
 var arrResult1= dsult.split("=");	
 if (arrResult1[0]!="" && arrResult1[1]!=""){
 var icc=parseInt(eval(arrResult1[0]));
  var imoney=parseInt(eval(arrResult1[1]));
  if (icc<50){
if (eval(imoney)<document.all.m.value) { alert(icc+"号下註金額不可小於最低限度 : "+document.all.m.value+"!!"); return false;}
if ((eval(imoney) > document.all.mm.value)) {alert("對不起,"+icc+"号止號本期下註金額最高限制 : "+document.all.mm.value+"!!"); return false;}
if ((eval(imoney) > document.all.mmm.value)) {alert("對不起,"+icc+"号下註金額已超過单註限額 : "+document.all.mmm.value+"!!"); return false;}
document.all["Num_"+icc].value =imoney;
}
}
}

if (document.all.ex2.value=="正码A" || document.all.ex2.value=="正码B"){var cf=53;}else{var cf=62;}
var rr=0;
 for(i=1;i<=cf;i++){
 if (document.all["Num_"+i].value>0){
rr+=eval(document.all["Num_"+i].value);
}
 }


document.all.allgold.value=rr;
document.all.total_gold.value=rr;


}


function editArray3(){
if (eval(document.all.money.value)<document.all.m.value) { alert("下註金額不可小於最低限度 : "+document.all.m.value+"!!"); return false;}
if ((eval(document.all.money.value) > document.all.mm.value)) {alert("對不起,止號本期下註金額最高限制 : "+document.all.mm.value+"!!"); return false;}
if ((eval(document.all.money.value) > document.all.mmm.value)) {alert("對不起,下註金額已超過单註限額 : "+document.all.mmm.value+"!!"); return false;}

 for(i=1;i<50;i++){
 if(i<10){
 			type = '0'+i;
 		}else{
 			type = i;
 		}
if (document.all["chk_"+type].value == "Y"){
document.all["Num_"+i].value =document.all.money.value;
}
}

if (document.all.ex2.value=="正码A" || document.all.ex2.value=="正码B"){var cf=53;}else{var cf=62;}
var rr=0;
 for(i=1;i<=cf;i++){
 if (document.all["Num_"+i].value>0){
rr+=eval(document.all["Num_"+i].value);
}
 }


document.all.allgold.value=rr;
document.all.total_gold.value=rr;
if (eval(document.all.allgold.value) > 0)   {
 for(i=1;i<50;i++){
 if(i<10){
 			type = '0'+i;
 		}else{
 			type = i;
 		}
if (document.all["chk_"+type].value == "Y"){
document.all["Num_"+i].value ="";
}
}

var rr=0;
 for(i=1;i<=cf;i++){
 if (document.all["Num_"+i].value>0){
rr+=eval(document.all["Num_"+i].value);
}
 }


document.all.allgold.value=rr;
document.all.total_gold.value=rr;

alert("下註金額不可大於可用信用額度!!");    return false;}
}
 
 function relocate(){
 	dis = "Y";
 	 
 	for(i=1;i<50;i++){
 		if(i<10){
 			type = '0'+i;
 		}else{
 			type = i;
 		}
 		tmp1 = document.getElementById("chk_"+type).value;
 		tmp = document.getElementById("type_"+type);
 		if(tmp1=="Y"){
 			dis = "N";
 			if(tmp.className == "ball_r" || tmp.className == "ball1_r"){tmp.className="ball1_r";}
			if(tmp.className == "ball_b" || tmp.className == "ball1_b"){tmp.className="ball1_b";}
			if(tmp.className == "ball_g" || tmp.className == "ball1_g"){tmp.className="ball1_g";}
 		}else{
 			if(tmp.className == "ball_r" || tmp.className == "ball1_r"){tmp.className="ball_r";}
			if(tmp.className == "ball_b" || tmp.className == "ball1_b"){tmp.className="ball_b";}
			if(tmp.className == "ball_g" || tmp.className == "ball1_g"){tmp.className="ball_g";}
 		}
 	}

 }
 
 function quick551(nn,tmp3,tmp4)
{
document.all.ftm1.innerHTML=tmp3;
document.all.x2.value=nn;
document.all.ex2.value=tmp3;
//tmp1 = document.getElementById("rtm1");
//tmp2 = document.getElementById("rtm2");
//if (tmp4=="A"){tmp1.className="button_a1";tmp2.className="button_a";}
//if (tmp4=="B"){tmp2.className="button_a1";tmp1.className="button_a";}

if (tmp3=="特码A"){document.all.m.value=1;document.all.mm.value=50000;document.all.mmm.value=500000;document.all.cm222.innerHTML="<button id=rtm1 class=button_a1 onclick=\"quick551(\'WptSiVHiUD0AFg!888!888\',\'特码A\',\'A\');\">特码A<\/button>&nbsp;<button  class=button_a id=rtm2 onclick=\"quick551(\'XJ0F3g2+UD1RRA!888!888\',\'特码B\',\'B\');\">特码B<\/button>";}
if (tmp3=="特码B"){document.all.m.value=1;document.all.mm.value=50000;document.all.mmm.value=500000;document.all.cm222.innerHTML="<button id=rtm1 class=button_a onclick=\"quick551(\'AMEA2w2+BGlRRw!888!888\',\'特码A\',\'A\');\">特码A<\/button>&nbsp;<button  class=button_a1 id=rtm2 onclick=\"quick551(\'CcgE31HiUj8DFg!888!888\',\'特码B\',\'B\');\">特码B<\/button>";}
if (tmp3=="正1特A"){document.all.m.value=1;document.all.mm.value=50000;document.all.mmm.value=500000;document.all.cm222.innerHTML="<button id=rtm1 class=button_a1 onclick=\"quick551(\'XYVUqgE3B8dU210R\',\'正1特A\',\'A\');\">正1特A<\/button>&nbsp;<button  class=button_a id=rtm2 onclick=\"quick551(\'WYED/QcxAcFX2A9A\',\'正1特B\',\'B\');\">正1特B<\/button>";
}
if (tmp3=="正1特B"){document.all.m.value=1;document.all.mm.value=50000;document.all.mmm.value=500000;document.all.cm222.innerHTML="<button id=rtm1 class=button_a onclick=\"quick551(\'XYVUqgM1BcVT3FwQ\',\'正1特A\',\'A\');\">正1特A<\/button>&nbsp;<button  class=button_a1 id=rtm2 onclick=\"quick551(\'ANgA/gM1UZFe0QlG\',\'正1特B\',\'B\');\">正1特B<\/button>";}
if (tmp3=="正2特A"){document.all.m.value=10;document.all.mm.value=50000;document.all.mmm.value=500000;document.all.cm222.innerHTML="<button id=rtm1 class=button_a1 onclick=\"quick551(\'WYEC/FRhUJACjVwQ\',\'正2特A\',\'A\');\">正2特A<\/button>&nbsp;<button  class=button_a id=rtm2 onclick=\"quick551(\'AdkE+g04BMQDjAtE\',\'正2特B\',\'B\');\">正2特B<\/button>";}
if (tmp3=="正2特B"){document.all.m.value=10;document.all.mm.value=50000;document.all.mmm.value=500000;document.all.cm222.innerHTML="<button id=rtm1 class=button_a onclick=\"quick551(\'D9dTrVFkBsYHiF0R\',\'正2特A\',\'A\');\">正2特A<\/button>&nbsp;<button  class=button_a1 id=rtm2 onclick=\"quick551(\'XIRWqFZjB8cCjV0S\',\'正2特B\',\'B\');\">正2特B<\/button>";}
if (tmp3=="正3特A"){document.all.m.value=10;document.all.mm.value=50000;document.all.mmm.value=500000;document.all.cm222.innerHTML="<button id=rtm1 class=button_a1 onclick=\"quick551(\'CtIP8VdjAsJW2VkV\',\'正3特A\',\'A\');\">正3特A<\/button>&nbsp;<button  class=button_a id=rtm2 onclick=\"quick551(\'XoYE+gczBMRf0AxD\',\'正3特B\',\'B\');\">正3特B<\/button>";}
if (tmp3=="正3特B"){document.all.m.value=10;document.all.mm.value=50000;document.all.mmm.value=500000;document.all.cm222.innerHTML="<button id=rtm1 class=button_a onclick=\"quick551(\'XoZUqgE1UJACjVsX\',\'正3特A\',\'A\');\">正3特A<\/button>&nbsp;<button  class=button_a1 id=rtm2 onclick=\"quick551(\'CtID/QQwDc1e0QpF\',\'正3特B\',\'B\');\">正3特B<\/button>";}
if (tmp3=="正4特A"){document.all.m.value=10;document.all.mm.value=50000;document.all.mmm.value=500000;document.all.cm222.innerHTML="<button id=rtm1 class=button_a1 onclick=\"quick551(\'CdEC/FdkBcVQ31sX\',\'正4特A\',\'A\');\">正4特A<\/button>&nbsp;<button  class=button_a id=rtm2 onclick=\"quick551(\'CNBWqAIxUJBR3lkW\',\'正4特B\',\'B\');\">正4特B<\/button>";}
if (tmp3=="正4特B"){document.all.m.value=10;document.all.mm.value=50000;document.all.mmm.value=500000;document.all.cm222.innerHTML="<button id=rtm1 class=button_a onclick=\"quick551(\'CtIA/gU2DMwAj1oW\',\'正4特A\',\'A\');\">正4特A<\/button>&nbsp;<button  class=button_a1 id=rtm2 onclick=\"quick551(\'DtYA/gIxB8de0VkW\',\'正4特B\',\'B\');\">正4特B<\/button>";}
if (tmp3=="正5特A"){document.all.m.value=10;document.all.mm.value=50000;document.all.mmm.value=500000;document.all.cm222.innerHTML="<button id=rtm1 class=button_a1 onclick=\"quick551(\'WoIF+wU3VZUEiwlF\',\'正5特A\',\'A\');\">正5特A<\/button>&nbsp;<button  class=button_a id=rtm2 onclick=\"quick551(\'XYVSrAMxDMxe0QlG\',\'正5特B\',\'B\');\">正5特B<\/button>";}
if (tmp3=="正5特B"){document.all.m.value=10;document.all.mm.value=50000;document.all.mmm.value=500000;document.all.cm222.innerHTML="<button id=rtm1 class=button_a onclick=\"quick551(\'DdUH+Qc1BsZS3Q1B\',\'正5特A\',\'A\');\">正5特A<\/button>&nbsp;<button  class=button_a1 id=rtm2 onclick=\"quick551(\'DdVTrVdlUpJX2FoV\',\'正5特B\',\'B\');\">正5特B<\/button>";}
if (tmp3=="正6特A"){document.all.m.value=10;document.all.mm.value=50000;document.all.mmm.value=500000;document.all.cm222.innerHTML="<button id=rtm1 class=button_a1 onclick=\"quick551(\'AdkG+FBhUJADjAhE\',\'正6特A\',\'A\');\">正6特A<\/button>&nbsp;<button  class=button_a id=rtm2 onclick=\"quick551(\'XIQD/VZnUJBf0AlG\',\'正6特B\',\'B\');\">正6特B<\/button>";}
if (tmp3=="正6特B"){document.all.m.value=10;document.all.mm.value=50000;document.all.mmm.value=500000;document.all.cm222.innerHTML="<button id=rtm1 class=button_a onclick=\"quick551(\'CNAB/wIzVZVU2w5C\',\'正6特A\',\'A\');\">正6特A<\/button>&nbsp;<button  class=button_a1 id=rtm2 onclick=\"quick551(\'XYVVqwMyB8cCjVoV\',\'正6特B\',\'B\');\">正6特B<\/button>";}
if (tmp3=="正码A"){document.all.m.value=10;document.all.mm.value=50000;document.all.mmm.value=500000;document.all.cm222.innerHTML="<button id=rtm1 class=button_a1 onclick=\"quick551(\'XIRWqAW2VjtXQQ!888!888\',\'正码A\',\'A\');\">正码A<\/button>&nbsp;<button  class=button_a id=rtm2 onclick=\"quick551(\'WYEO8FfkA24EEQ!888!888\',\'正码B\',\'B\');\">正码B<\/button>";}
if (tmp3=="正码B"){document.all.m.value=10;document.all.mm.value=50000;document.all.mmm.value=500000;document.all.cm222.innerHTML="<button id=rtm1 class=button_a onclick=\"quick551(\'XYVUqgGyUD0DFQ!888!888\',\'正码A\',\'A\');\">正码A<\/button>&nbsp;<button  class=button_a1 id=rtm2 onclick=\"quick551(\'DNQF+wS3VjtfSg!888!888\',\'正码B\',\'B\');\">正码B<\/button>";}


var key1=document.all.abcd.value;
editArray2();
quick5();

}
function quick552(abcd){
var key=document.all.x2.value;
var key1=abcd;
document.all.abcd.value=abcd;
quick5();
}

 function quick5(){
var key=document.all.x2.value;
var key1=document.all.abcd.value;
makeRequest("?spul=CG5VCQ1hDS9Qc1o6&savew=CXcDZQJzAWhSdwh2&x1=WptSiVfkBms!888&x2="+key+"&abcd="+key1+"&page=1")
}
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
.STYLE6 {color: #000000}
 
-->
 </style>
<table border="0" cellpadding="0" cellspacing="0" width="780">
  <form name="lt_form" id="lt_form" method="post" action="../?spul=AGYFWVE9ASNefQxs&save=DGRWMQZoVi4!888&x1=CssC2QW2AG0!888" target="k2f6983f2880d32e880d3ds2e83f2880d32b_memll">
  </form>
  <tbody>
    <tr>
      <td class="F_bold" nowrap="nowrap"><b id="t_LID" class="Font_G"> 2012107 </b>期 <b class="font_b"><span id="ftm1"> 特码A </span>&nbsp;&nbsp;&nbsp;&nbsp;
        <select class="za_select" id="ltype" name="ltype" onChange="var jmpURL=this.options[this.selectedIndex].value ; if(jmpURL!='') {quick552(jmpURL);} else {this.selectedIndex=0 ;}">
          <option selected="selected" value="A">A盤</option>
          <option value="B">B盤</option>
          <option value="C">C盤</option>
          <option value="D">D盤</option>
        </select>
        <input name="abcd" id="abcd" value="A" type="hidden">
        <input name="m" id="m" value="1" type="hidden">
        <input name="mm" id="mm" value="50000" type="hidden">
        <input name="mmm" id="mmm" value="500000" type="hidden">
        <input name="xm" id="xm" value="10" type="hidden">
        <input name="xmm" id="xmm" value="50000" type="hidden">
        <input name="xmmm" id="xmmm" value="500000" type="hidden">
        <input name="bm" id="bm" value="10" type="hidden">
        <input name="bmm" id="bmm" value="50000" type="hidden">
        <input name="bmmm" id="bmmm" value="500000" type="hidden">
        <input name="x2" id="x2" value="CMkO1QGyVjsEEg!888!888" type="hidden">
        <input name="ex2" id="ex2" value="特码A" type="hidden">
        </b></td>
      <td class="F_bold" nowrap="nowrap"><span id="cm222">
        <button id="rtm1" class="button_a1" onClick="quick551('CMkA21PgUTwEEg!888!888','特码A','A');"> 特码A</button>
        &nbsp;
        <button class="button_a" id="rtm2" onClick="quick551('CMkO1Q2+DWBVQA!888!888','特码B','B');"> 特码B</button>
        </span></td>
      <td align="right" width="25%"><font color="#000000">距離封盤：</font><span id="hClockTime_C">04:38:00</span></td>
      <td align="right" width="22%"><font color="#000000"><span id="Update_Time"><span id="n">49</span>秒</span></font></td>
    </tr>
  </tbody>
</table>
<!-- 開始  -->
<div id="result">
  <table class="Ball_List Tab" bgcolor="ffffff" border="0" bordercolor="f1f1f1" cellpadding="0" cellspacing="1" width="780">
    <tbody>
      <tr class="td_caption_1">
        <td bordercolor="cccccc" bgcolor="#DFEFFF" nowrap="nowrap"><div align="center"> NO </div></td>
        <td bordercolor="cccccc" align="center" bgcolor="#DFEFFF" nowrap="nowrap" width="8%">賠率</td>
        <td bordercolor="cccccc" align="center" bgcolor="#DFEFFF" nowrap="nowrap" width="8%">金額</td>
        <td bordercolor="cccccc" bgcolor="#DFEFFF" nowrap="nowrap"><div align="center"> NO </div></td>
        <td bordercolor="cccccc" align="center" bgcolor="#DFEFFF" nowrap="nowrap" width="8%">賠率</td>
        <td bordercolor="cccccc" align="center" bgcolor="#DFEFFF" nowrap="nowrap" width="8%">金額</td>
        <td bordercolor="cccccc" bgcolor="#DFEFFF" nowrap="nowrap"><div align="center"> NO </div></td>
        <td bordercolor="cccccc" align="center" bgcolor="#DFEFFF" nowrap="nowrap" width="8%">賠率</td>
        <td bordercolor="cccccc" align="center" bgcolor="#DFEFFF" nowrap="nowrap" width="8%">金額</td>
        <td bordercolor="cccccc" bgcolor="#DFEFFF" nowrap="nowrap"><div align="center"> NO </div></td>
        <td bordercolor="cccccc" align="center" bgcolor="#DFEFFF" nowrap="nowrap" width="8%">賠率</td>
        <td bordercolor="cccccc" align="center" bgcolor="#DFEFFF" nowrap="nowrap" width="8%">金額</td>
        <td bordercolor="cccccc" bgcolor="#DFEFFF" nowrap="nowrap"><div align="center"> NO </div></td>
        <td bordercolor="cccccc" align="center" bgcolor="#DFEFFF" nowrap="nowrap" width="8%">賠率</td>
        <td bordercolor="cccccc" align="center" bgcolor="#DFEFFF" nowrap="nowrap" width="8%">金額</td>
      </tr>
      <tr style="background-color: rgb(255, 255, 255);" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor='ffffff'" bgcolor="#FFFFFF">
        <td bordercolor="cccccc" class="ball_r" id="type_01" onClick="editArray('01');" align="center" height="25"> 01</td>
        <td align="center" height="25"><span id="bl0" class="multiple_Red">42.48</span></td>
        <td align="center"><span id="gold0">
          <input onKeyPress="return CheckKey();" onBlur="this.className='inp1';return CountGold(this,'blur','SP','0','1');" onKeyUp="return CountGold(this,'keyup');" onFocus="this.className='inp1m';CountGold(this,'focus');this.value='';" style="height: 18px;" size="6" name="Num_1" class="inp1">
          </span></td>
        <td bordercolor="cccccc" class="ball_g" id="type_11" onClick="editArray('11');" align="center" height="25"> 11</td>
        <td align="center" height="25"><span id="bl10" class="multiple_Red">42.48</span></td>
        <td align="center"><span id="gold10">
          <input onKeyPress="return CheckKey();" onBlur="this.className='inp1';return CountGold(this,'blur','SP','0','11');" onKeyUp="return CountGold(this,'keyup');" onFocus="this.className='inp1m';CountGold(this,'focus');this.value='';" style="height: 18px;" size="6" name="Num_11" class="inp1">
          </span></td>
        <td bordercolor="cccccc" class="ball_g" id="type_21" onClick="editArray('21');" align="center" height="25"> 21</td>
        <td align="center" height="25"><span id="bl20" class="multiple_Red">42.28</span></td>
        <td align="center"><span id="gold20">
          <input onKeyPress="return CheckKey();" onBlur="this.className='inp1';return CountGold(this,'blur','SP','0','21');" onKeyUp="return CountGold(this,'keyup');" onFocus="this.className='inp1m';CountGold(this,'focus');this.value='';" style="height: 18px;" size="6" name="Num_21" class="inp1">
          </span></td>
        <td bordercolor="cccccc" class="ball_b" id="type_31" onClick="editArray('31');" align="center" height="25"> 31</td>
        <td align="center" height="25"><span id="bl30" class="multiple_Red">42.48</span></td>
        <td align="center"><span id="gold30">
          <input onKeyPress="return CheckKey();" onBlur="this.className='inp1';return CountGold(this,'blur','SP','0','31');" onKeyUp="return CountGold(this,'keyup');" onFocus="this.className='inp1m';CountGold(this,'focus');this.value='';" style="height: 18px;" size="6" name="Num_31" class="inp1">
          </span></td>
        <td bordercolor="cccccc" class="ball_b" id="type_41" onClick="editArray('41');" align="center" height="25"> 41</td>
        <td align="center" height="25"><span id="bl40" class="multiple_Red">42.48</span></td>
        <td align="center"><span id="gold40">
          <input onKeyPress="return CheckKey();" onBlur="this.className='inp1';return CountGold(this,'blur','SP','0','41');" onKeyUp="return CountGold(this,'keyup');" onFocus="this.className='inp1m';CountGold(this,'focus');this.value='';" style="height: 18px;" size="6" name="Num_41" class="inp1">
          </span></td>
      </tr>
      <tr style="background-color: rgb(255, 255, 255);" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor='ffffff'" bgcolor="#FFFFFF">
        <td bordercolor="cccccc" class="ball_r" id="type_02" onClick="editArray('02');" align="center" height="25"> 02</td>
        <td align="center" height="25"><span id="bl1" class="multiple_Red">42.48</span></td>
        <td align="center"><span id="gold1">
          <input onKeyPress="return CheckKey();" onBlur="this.className='inp1';return CountGold(this,'blur','SP','0','2');" onKeyUp="return CountGold(this,'keyup');" onFocus="this.className='inp1m';CountGold(this,'focus');this.value='';" style="height: 18px;" size="6" name="Num_2" class="inp1">
          </span></td>
        <td bordercolor="cccccc" class="ball_r" id="type_12" onClick="editArray('12');" align="center" height="25"> 12</td>
        <td align="center" height="25"><span id="bl11" class="multiple_Red">42.48</span></td>
        <td align="center"><span id="gold11">
          <input onKeyPress="return CheckKey();" onBlur="this.className='inp1';return CountGold(this,'blur','SP','0','12');" onKeyUp="return CountGold(this,'keyup');" onFocus="this.className='inp1m';CountGold(this,'focus');this.value='';" style="height: 18px;" size="6" name="Num_12" class="inp1">
          </span></td>
        <td bordercolor="cccccc" class="ball_g" id="type_22" onClick="editArray('22');" align="center" height="25"> 22</td>
        <td align="center" height="25"><span id="bl21" class="multiple_Red">42.48</span></td>
        <td align="center"><span id="gold21">
          <input onKeyPress="return CheckKey();" onBlur="this.className='inp1';return CountGold(this,'blur','SP','0','22');" onKeyUp="return CountGold(this,'keyup');" onFocus="this.className='inp1m';CountGold(this,'focus');this.value='';" style="height: 18px;" size="6" name="Num_22" class="inp1">
          </span></td>
        <td bordercolor="cccccc" class="ball_g" id="type_32" onClick="editArray('32');" align="center" height="25"> 32</td>
        <td align="center" height="25"><span id="bl31" class="multiple_Red">42.48</span></td>
        <td align="center"><span id="gold31">
          <input onKeyPress="return CheckKey();" onBlur="this.className='inp1';return CountGold(this,'blur','SP','0','32');" onKeyUp="return CountGold(this,'keyup');" onFocus="this.className='inp1m';CountGold(this,'focus');this.value='';" style="height: 18px;" size="6" name="Num_32" class="inp1">
          </span></td>
        <td bordercolor="cccccc" class="ball_b" id="type_42" onClick="editArray('42');" align="center" height="25"> 42</td>
        <td align="center" height="25"><span id="bl41" class="multiple_Red">42.48</span></td>
        <td align="center"><span id="gold41">
          <input onKeyPress="return CheckKey();" onBlur="this.className='inp1';return CountGold(this,'blur','SP','0','42');" onKeyUp="return CountGold(this,'keyup');" onFocus="this.className='inp1m';CountGold(this,'focus');this.value='';" style="height: 18px;" size="6" name="Num_42" class="inp1">
          </span></td>
      </tr>
      <tr style="background-color: rgb(255, 255, 255);" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor='ffffff'" bgcolor="#FFFFFF">
        <td bordercolor="cccccc" class="ball_b" id="type_03" onClick="editArray('03');" align="center" height="25"> 03</td>
        <td align="center" height="25"><span id="bl2" class="multiple_Red">42.48</span></td>
        <td align="center"><span id="gold2">
          <input onKeyPress="return CheckKey();" onBlur="this.className='inp1';return CountGold(this,'blur','SP','0','3');" onKeyUp="return CountGold(this,'keyup');" onFocus="this.className='inp1m';CountGold(this,'focus');this.value='';" style="height: 18px;" size="6" name="Num_3" class="inp1">
          </span></td>
        <td bordercolor="cccccc" class="ball_r" id="type_13" onClick="editArray('13');" align="center" height="25"> 13</td>
        <td align="center" height="25"><span id="bl12" class="multiple_Red">42.48</span></td>
        <td align="center"><span id="gold12">
          <input onKeyPress="return CheckKey();" onBlur="this.className='inp1';return CountGold(this,'blur','SP','0','13');" onKeyUp="return CountGold(this,'keyup');" onFocus="this.className='inp1m';CountGold(this,'focus');this.value='';" style="height: 18px;" size="6" name="Num_13" class="inp1">
          </span></td>
        <td bordercolor="cccccc" class="ball_r" id="type_23" onClick="editArray('23');" align="center" height="25"> 23</td>
        <td align="center" height="25"><span id="bl22" class="multiple_Red">42.48</span></td>
        <td align="center"><span id="gold22">
          <input onKeyPress="return CheckKey();" onBlur="this.className='inp1';return CountGold(this,'blur','SP','0','23');" onKeyUp="return CountGold(this,'keyup');" onFocus="this.className='inp1m';CountGold(this,'focus');this.value='';" style="height: 18px;" size="6" name="Num_23" class="inp1">
          </span></td>
        <td bordercolor="cccccc" class="ball_g" id="type_33" onClick="editArray('33');" align="center" height="25"> 33</td>
        <td align="center" height="25"><span id="bl32" class="multiple_Red">42.48</span></td>
        <td align="center"><span id="gold32">
          <input onKeyPress="return CheckKey();" onBlur="this.className='inp1';return CountGold(this,'blur','SP','0','33');" onKeyUp="return CountGold(this,'keyup');" onFocus="this.className='inp1m';CountGold(this,'focus');this.value='';" style="height: 18px;" size="6" name="Num_33" class="inp1">
          </span></td>
        <td bordercolor="cccccc" class="ball_g" id="type_43" onClick="editArray('43');" align="center" height="25"> 43</td>
        <td align="center" height="25"><span id="bl42" class="multiple_Red">42.48</span></td>
        <td align="center"><span id="gold42">
          <input onKeyPress="return CheckKey();" onBlur="this.className='inp1';return CountGold(this,'blur','SP','0','43');" onKeyUp="return CountGold(this,'keyup');" onFocus="this.className='inp1m';CountGold(this,'focus');this.value='';" style="height: 18px;" size="6" name="Num_43" class="inp1">
          </span></td>
      </tr>
      <tr style="background-color: rgb(255, 255, 255);" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor='ffffff'" bgcolor="#FFFFFF">
        <td bordercolor="cccccc" class="ball_b" id="type_04" onClick="editArray('04');" align="center" height="25"> 04</td>
        <td align="center" height="25"><span id="bl3" class="multiple_Red">42.48</span></td>
        <td align="center"><span id="gold3">
          <input onKeyPress="return CheckKey();" onBlur="this.className='inp1';return CountGold(this,'blur','SP','0','4');" onKeyUp="return CountGold(this,'keyup');" onFocus="this.className='inp1m';CountGold(this,'focus');this.value='';" style="height: 18px;" size="6" name="Num_4" class="inp1">
          </span></td>
        <td bordercolor="cccccc" class="ball_b" id="type_14" onClick="editArray('14');" align="center" height="25"> 14</td>
        <td align="center" height="25"><span id="bl13" class="multiple_Red">42.48</span></td>
        <td align="center"><span id="gold13">
          <input onKeyPress="return CheckKey();" onBlur="this.className='inp1';return CountGold(this,'blur','SP','0','14');" onKeyUp="return CountGold(this,'keyup');" onFocus="this.className='inp1m';CountGold(this,'focus');this.value='';" style="height: 18px;" size="6" name="Num_14" class="inp1">
          </span></td>
        <td bordercolor="cccccc" class="ball_r" id="type_24" onClick="editArray('24');" align="center" height="25"> 24</td>
        <td align="center" height="25"><span id="bl23" class="multiple_Red">42.48</span></td>
        <td align="center"><span id="gold23">
          <input onKeyPress="return CheckKey();" onBlur="this.className='inp1';return CountGold(this,'blur','SP','0','24');" onKeyUp="return CountGold(this,'keyup');" onFocus="this.className='inp1m';CountGold(this,'focus');this.value='';" style="height: 18px;" size="6" name="Num_24" class="inp1">
          </span></td>
        <td bordercolor="cccccc" class="ball_r" id="type_34" onClick="editArray('34');" align="center" height="25"> 34</td>
        <td align="center" height="25"><span id="bl33" class="multiple_Red">42.48</span></td>
        <td align="center"><span id="gold33">
          <input onKeyPress="return CheckKey();" onBlur="this.className='inp1';return CountGold(this,'blur','SP','0','34');" onKeyUp="return CountGold(this,'keyup');" onFocus="this.className='inp1m';CountGold(this,'focus');this.value='';" style="height: 18px;" size="6" name="Num_34" class="inp1">
          </span></td>
        <td bordercolor="cccccc" class="ball_g" id="type_44" onClick="editArray('44');" align="center" height="25"> 44</td>
        <td align="center" height="25"><span id="bl43" class="multiple_Red">42.48</span></td>
        <td align="center"><span id="gold43">
          <input onKeyPress="return CheckKey();" onBlur="this.className='inp1';return CountGold(this,'blur','SP','0','44');" onKeyUp="return CountGold(this,'keyup');" onFocus="this.className='inp1m';CountGold(this,'focus');this.value='';" style="height: 18px;" size="6" name="Num_44" class="inp1">
          </span></td>
      </tr>
      <tr style="background-color: rgb(255, 255, 255);" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor='ffffff'" bgcolor="#FFFFFF">
        <td bordercolor="cccccc" class="ball_g" id="type_05" onClick="editArray('05');" align="center" height="25"> 05</td>
        <td align="center" height="25"><span id="bl4" class="multiple_Red">42.48</span></td>
        <td align="center"><span id="gold4">
          <input onKeyPress="return CheckKey();" onBlur="this.className='inp1';return CountGold(this,'blur','SP','0','5');" onKeyUp="return CountGold(this,'keyup');" onFocus="this.className='inp1m';CountGold(this,'focus');this.value='';" style="height: 18px;" size="6" name="Num_5" class="inp1">
          </span></td>
        <td bordercolor="cccccc" class="ball_b" id="type_15" onClick="editArray('15');" align="center" height="25"> 15</td>
        <td align="center" height="25"><span id="bl14" class="multiple_Red">42.48</span></td>
        <td align="center"><span id="gold14">
          <input onKeyPress="return CheckKey();" onBlur="this.className='inp1';return CountGold(this,'blur','SP','0','15');" onKeyUp="return CountGold(this,'keyup');" onFocus="this.className='inp1m';CountGold(this,'focus');this.value='';" style="height: 18px;" size="6" name="Num_15" class="inp1">
          </span></td>
        <td bordercolor="cccccc" class="ball_b" id="type_25" onClick="editArray('25');" align="center" height="25"> 25</td>
        <td align="center" height="25"><span id="bl24" class="multiple_Red">42.48</span></td>
        <td align="center"><span id="gold24">
          <input onKeyPress="return CheckKey();" onBlur="this.className='inp1';return CountGold(this,'blur','SP','0','25');" onKeyUp="return CountGold(this,'keyup');" onFocus="this.className='inp1m';CountGold(this,'focus');this.value='';" style="height: 18px;" size="6" name="Num_25" class="inp1">
          </span></td>
        <td bordercolor="cccccc" class="ball_r" id="type_35" onClick="editArray('35');" align="center" height="25"> 35</td>
        <td align="center" height="25"><span id="bl34" class="multiple_Red">42.48</span></td>
        <td align="center"><span id="gold34">
          <input onKeyPress="return CheckKey();" onBlur="this.className='inp1';return CountGold(this,'blur','SP','0','35');" onKeyUp="return CountGold(this,'keyup');" onFocus="this.className='inp1m';CountGold(this,'focus');this.value='';" style="height: 18px;" size="6" name="Num_35" class="inp1">
          </span></td>
        <td bordercolor="cccccc" class="ball_r" id="type_45" onClick="editArray('45');" align="center" height="25"> 45</td>
        <td align="center" height="25"><span id="bl44" class="multiple_Red">42.48</span></td>
        <td align="center"><span id="gold44">
          <input onKeyPress="return CheckKey();" onBlur="this.className='inp1';return CountGold(this,'blur','SP','0','45');" onKeyUp="return CountGold(this,'keyup');" onFocus="this.className='inp1m';CountGold(this,'focus');this.value='';" style="height: 18px;" size="6" name="Num_45" class="inp1">
          </span></td>
      </tr>
      <tr style="background-color: rgb(255, 255, 255);" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor='ffffff'" bgcolor="#FFFFFF">
        <td bordercolor="cccccc" class="ball_g" id="type_06" onClick="editArray('06');" align="center" height="25"> 06</td>
        <td align="center" height="25"><span id="bl5" class="multiple_Red">42.48</span></td>
        <td align="center"><span id="gold5">
          <input onKeyPress="return CheckKey();" onBlur="this.className='inp1';return CountGold(this,'blur','SP','0','6');" onKeyUp="return CountGold(this,'keyup');" onFocus="this.className='inp1m';CountGold(this,'focus');this.value='';" style="height: 18px;" size="6" name="Num_6" class="inp1">
          </span></td>
        <td bordercolor="cccccc" class="ball_g" id="type_16" onClick="editArray('16');" align="center" height="25"> 16</td>
        <td align="center" height="25"><span id="bl15" class="multiple_Red">42.48</span></td>
        <td align="center"><span id="gold15">
          <input onKeyPress="return CheckKey();" onBlur="this.className='inp1';return CountGold(this,'blur','SP','0','16');" onKeyUp="return CountGold(this,'keyup');" onFocus="this.className='inp1m';CountGold(this,'focus');this.value='';" style="height: 18px;" size="6" name="Num_16" class="inp1">
          </span></td>
        <td bordercolor="cccccc" class="ball_b" id="type_26" onClick="editArray('26');" align="center" height="25"> 26</td>
        <td align="center" height="25"><span id="bl25" class="multiple_Red">42.48</span></td>
        <td align="center"><span id="gold25">
          <input onKeyPress="return CheckKey();" onBlur="this.className='inp1';return CountGold(this,'blur','SP','0','26');" onKeyUp="return CountGold(this,'keyup');" onFocus="this.className='inp1m';CountGold(this,'focus');this.value='';" style="height: 18px;" size="6" name="Num_26" class="inp1">
          </span></td>
        <td bordercolor="cccccc" class="ball_b" id="type_36" onClick="editArray('36');" align="center" height="25"> 36</td>
        <td align="center" height="25"><span id="bl35" class="multiple_Red">42.48</span></td>
        <td align="center"><span id="gold35">
          <input onKeyPress="return CheckKey();" onBlur="this.className='inp1';return CountGold(this,'blur','SP','0','36');" onKeyUp="return CountGold(this,'keyup');" onFocus="this.className='inp1m';CountGold(this,'focus');this.value='';" style="height: 18px;" size="6" name="Num_36" class="inp1">
          </span></td>
        <td bordercolor="cccccc" class="ball_r" id="type_46" onClick="editArray('46');" align="center" height="25"> 46</td>
        <td align="center" height="25"><span id="bl45" class="multiple_Red">42.48</span></td>
        <td align="center"><span id="gold45">
          <input onKeyPress="return CheckKey();" onBlur="this.className='inp1';return CountGold(this,'blur','SP','0','46');" onKeyUp="return CountGold(this,'keyup');" onFocus="this.className='inp1m';CountGold(this,'focus');this.value='';" style="height: 18px;" size="6" name="Num_46" class="inp1">
          </span></td>
      </tr>
      <tr style="background-color: rgb(255, 255, 255);" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor='ffffff'" bgcolor="#FFFFFF">
        <td bordercolor="cccccc" class="ball_r" id="type_07" onClick="editArray('07');" align="center" height="25"> 07</td>
        <td align="center" height="25"><span id="bl6" class="multiple_Red">42.48</span></td>
        <td align="center"><span id="gold6">
          <input onKeyPress="return CheckKey();" onBlur="this.className='inp1';return CountGold(this,'blur','SP','0','7');" onKeyUp="return CountGold(this,'keyup');" onFocus="this.className='inp1m';CountGold(this,'focus');this.value='';" style="height: 18px;" size="6" name="Num_7" class="inp1">
          </span></td>
        <td bordercolor="cccccc" class="ball_g" id="type_17" onClick="editArray('17');" align="center" height="25"> 17</td>
        <td align="center" height="25"><span id="bl16" class="multiple_Red">42.48</span></td>
        <td align="center"><span id="gold16">
          <input onKeyPress="return CheckKey();" onBlur="this.className='inp1';return CountGold(this,'blur','SP','0','17');" onKeyUp="return CountGold(this,'keyup');" onFocus="this.className='inp1m';CountGold(this,'focus');this.value='';" style="height: 18px;" size="6" name="Num_17" class="inp1">
          </span></td>
        <td bordercolor="cccccc" class="ball_g" id="type_27" onClick="editArray('27');" align="center" height="25"> 27</td>
        <td align="center" height="25"><span id="bl26" class="multiple_Red">42.48</span></td>
        <td align="center"><span id="gold26">
          <input onKeyPress="return CheckKey();" onBlur="this.className='inp1';return CountGold(this,'blur','SP','0','27');" onKeyUp="return CountGold(this,'keyup');" onFocus="this.className='inp1m';CountGold(this,'focus');this.value='';" style="height: 18px;" size="6" name="Num_27" class="inp1">
          </span></td>
        <td bordercolor="cccccc" class="ball_b" id="type_37" onClick="editArray('37');" align="center" height="25"> 37</td>
        <td align="center" height="25"><span id="bl36" class="multiple_Red">42.48</span></td>
        <td align="center"><span id="gold36">
          <input onKeyPress="return CheckKey();" onBlur="this.className='inp1';return CountGold(this,'blur','SP','0','37');" onKeyUp="return CountGold(this,'keyup');" onFocus="this.className='inp1m';CountGold(this,'focus');this.value='';" style="height: 18px;" size="6" name="Num_37" class="inp1">
          </span></td>
        <td bordercolor="cccccc" class="ball_b" id="type_47" onClick="editArray('47');" align="center" height="25"> 47</td>
        <td align="center" height="25"><span id="bl46" class="multiple_Red">42.48</span></td>
        <td align="center"><span id="gold46">
          <input onKeyPress="return CheckKey();" onBlur="this.className='inp1';return CountGold(this,'blur','SP','0','47');" onKeyUp="return CountGold(this,'keyup');" onFocus="this.className='inp1m';CountGold(this,'focus');this.value='';" style="height: 18px;" size="6" name="Num_47" class="inp1">
          </span></td>
      </tr>
      <tr style="background-color: rgb(255, 255, 255);" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor='ffffff'" bgcolor="#FFFFFF">
        <td bordercolor="cccccc" class="ball_r" id="type_08" onClick="editArray('08');" align="center" height="25"> 08</td>
        <td align="center" height="25"><span id="bl7" class="multiple_Red">42.48</span></td>
        <td align="center"><span id="gold7">
          <input onKeyPress="return CheckKey();" onBlur="this.className='inp1';return CountGold(this,'blur','SP','0','8');" onKeyUp="return CountGold(this,'keyup');" onFocus="this.className='inp1m';CountGold(this,'focus');this.value='';" style="height: 18px;" size="6" name="Num_8" class="inp1">
          </span></td>
        <td bordercolor="cccccc" class="ball_r" id="type_18" onClick="editArray('18');" align="center" height="25"> 18</td>
        <td align="center" height="25"><span id="bl17" class="multiple_Red">42.48</span></td>
        <td align="center"><span id="gold17">
          <input onKeyPress="return CheckKey();" onBlur="this.className='inp1';return CountGold(this,'blur','SP','0','18');" onKeyUp="return CountGold(this,'keyup');" onFocus="this.className='inp1m';CountGold(this,'focus');this.value='';" style="height: 18px;" size="6" name="Num_18" class="inp1">
          </span></td>
        <td bordercolor="cccccc" class="ball_g" id="type_28" onClick="editArray('28');" align="center" height="25"> 28</td>
        <td align="center" height="25"><span id="bl27" class="multiple_Red">42.48</span></td>
        <td align="center"><span id="gold27">
          <input onKeyPress="return CheckKey();" onBlur="this.className='inp1';return CountGold(this,'blur','SP','0','28');" onKeyUp="return CountGold(this,'keyup');" onFocus="this.className='inp1m';CountGold(this,'focus');this.value='';" style="height: 18px;" size="6" name="Num_28" class="inp1">
          </span></td>
        <td bordercolor="cccccc" class="ball_g" id="type_38" onClick="editArray('38');" align="center" height="25"> 38</td>
        <td align="center" height="25"><span id="bl37" class="multiple_Red">42.48</span></td>
        <td align="center"><span id="gold37">
          <input onKeyPress="return CheckKey();" onBlur="this.className='inp1';return CountGold(this,'blur','SP','0','38');" onKeyUp="return CountGold(this,'keyup');" onFocus="this.className='inp1m';CountGold(this,'focus');this.value='';" style="height: 18px;" size="6" name="Num_38" class="inp1">
          </span></td>
        <td bordercolor="cccccc" class="ball_b" id="type_48" onClick="editArray('48');" align="center" height="25"> 48</td>
        <td align="center" height="25"><span id="bl47" class="multiple_Red">42.48</span></td>
        <td align="center"><span id="gold47">
          <input onKeyPress="return CheckKey();" onBlur="this.className='inp1';return CountGold(this,'blur','SP','0','48');" onKeyUp="return CountGold(this,'keyup');" onFocus="this.className='inp1m';CountGold(this,'focus');this.value='';" style="height: 18px;" size="6" name="Num_48" class="inp1">
          </span></td>
      </tr>
      <tr style="background-color: rgb(255, 255, 255);" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor='ffffff'" bgcolor="#FFFFFF">
        <td bordercolor="cccccc" class="ball_b" id="type_09" onClick="editArray('09');" align="center" height="25"> 09</td>
        <td align="center" height="25"><span id="bl8" class="multiple_Red">42.48</span></td>
        <td align="center"><span id="gold8">
          <input onKeyPress="return CheckKey();" onBlur="this.className='inp1';return CountGold(this,'blur','SP','0','9');" onKeyUp="return CountGold(this,'keyup');" onFocus="this.className='inp1m';CountGold(this,'focus');this.value='';" style="height: 18px;" size="6" name="Num_9" class="inp1">
          </span></td>
        <td bordercolor="cccccc" class="ball_r" id="type_19" onClick="editArray('19');" align="center" height="25"> 19</td>
        <td align="center" height="25"><span id="bl18" class="multiple_Red">42.48</span></td>
        <td align="center"><span id="gold18">
          <input onKeyPress="return CheckKey();" onBlur="this.className='inp1';return CountGold(this,'blur','SP','0','19');" onKeyUp="return CountGold(this,'keyup');" onFocus="this.className='inp1m';CountGold(this,'focus');this.value='';" style="height: 18px;" size="6" name="Num_19" class="inp1">
          </span></td>
        <td bordercolor="cccccc" class="ball_r" id="type_29" onClick="editArray('29');" align="center" height="25"> 29</td>
        <td align="center" height="25"><span id="bl28" class="multiple_Red">42.48</span></td>
        <td align="center"><span id="gold28">
          <input onKeyPress="return CheckKey();" onBlur="this.className='inp1';return CountGold(this,'blur','SP','0','29');" onKeyUp="return CountGold(this,'keyup');" onFocus="this.className='inp1m';CountGold(this,'focus');this.value='';" style="height: 18px;" size="6" name="Num_29" class="inp1">
          </span></td>
        <td bordercolor="cccccc" class="ball_g" id="type_39" onClick="editArray('39');" align="center" height="25"> 39</td>
        <td align="center" height="25"><span id="bl38" class="multiple_Red">42.48</span></td>
        <td align="center"><span id="gold38">
          <input onKeyPress="return CheckKey();" onBlur="this.className='inp1';return CountGold(this,'blur','SP','0','39');" onKeyUp="return CountGold(this,'keyup');" onFocus="this.className='inp1m';CountGold(this,'focus');this.value='';" style="height: 18px;" size="6" name="Num_39" class="inp1">
          </span></td>
        <td bordercolor="cccccc" class="ball_g" id="type_49" onClick="editArray('49');" align="center" height="25"> 49</td>
        <td align="center" height="25"><span id="bl48" class="multiple_Red">42.58</span></td>
        <td align="center"><span id="gold48">
          <input onKeyPress="return CheckKey();" onBlur="this.className='inp1';return CountGold(this,'blur','SP','0','49');" onKeyUp="return CountGold(this,'keyup');" onFocus="this.className='inp1m';CountGold(this,'focus');this.value='';" style="height: 18px;" size="6" name="Num_49" class="inp1">
          </span></td>
      </tr>
      <tr style="background-color: rgb(255, 255, 255);" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor='ffffff'" bgcolor="#FFFFFF">
        <td bordercolor="cccccc" class="ball_b" id="type_10" onClick="editArray('10');" align="center" height="25"> 10</td>
        <td align="center" height="25"><span id="bl9" class="multiple_Red">42.48</span></td>
        <td align="center"><span id="gold9">
          <input onKeyPress="return CheckKey();" onBlur="this.className='inp1';return CountGold(this,'blur','SP','0','10');" onKeyUp="return CountGold(this,'keyup');" onFocus="this.className='inp1m';CountGold(this,'focus');this.value='';" style="height: 18px;" size="6" name="Num_10" class="inp1">
          </span></td>
        <td bordercolor="cccccc" class="ball_b" id="type_20" onClick="editArray('20');" align="center" height="25"> 20</td>
        <td align="center" height="25"><span id="bl19" class="multiple_Red">42.48</span></td>
        <td align="center"><span id="gold19">
          <input onKeyPress="return CheckKey();" onBlur="this.className='inp1';return CountGold(this,'blur','SP','0','20');" onKeyUp="return CountGold(this,'keyup');" onFocus="this.className='inp1m';CountGold(this,'focus');this.value='';" style="height: 18px;" size="6" name="Num_20" class="inp1">
          </span></td>
        <td bordercolor="cccccc" class="ball_r" id="type_30" onClick="editArray('30');" align="center" height="25"> 30</td>
        <td align="center" height="25"><span id="bl29" class="multiple_Red">42.48</span></td>
        <td align="center"><span id="gold29">
          <input onKeyPress="return CheckKey();" onBlur="this.className='inp1';return CountGold(this,'blur','SP','0','30');" onKeyUp="return CountGold(this,'keyup');" onFocus="this.className='inp1m';CountGold(this,'focus');this.value='';" style="height: 18px;" size="6" name="Num_30" class="inp1">
          </span></td>
        <td bordercolor="cccccc" class="ball_r" id="type_40" onClick="editArray('40');" align="center" height="25"> 40</td>
        <td align="center" height="25"><span id="bl39" class="multiple_Red">42.28</span></td>
        <td align="center"><span id="gold39">
          <input onKeyPress="return CheckKey();" onBlur="this.className='inp1';return CountGold(this,'blur','SP','0','40');" onKeyUp="return CountGold(this,'keyup');" onFocus="this.className='inp1m';CountGold(this,'focus');this.value='';" style="height: 18px;" size="6" name="Num_40" class="inp1">
          </span></td>
        <td colspan="3" bordercolor="cccccc" align="center"><input name="btnSubmit" onClick="return ChkSubmit();" class="btn2" onMouseOut="this.className='btn2'" onMouseOver="this.className='btn2m'" id="btnSubmit" value="下註" type="button"></td>
      </tr>
      <tr style="background-color: rgb(255, 255, 255);" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor='ffffff'" bgcolor="#FFFFFF">
        <td bordercolor="cccccc" align="center" height="25"> 特单</td>
        <td align="center" height="25"><span id="bl49" class="multiple_Red">1.9</span></td>
        <td align="center"><span id="gold49">
          <input onKeyPress="return CheckKey();" onBlur="this.className='inp1';return CountGold(this,'blur','SM','0','50');" onKeyUp="return CountGold(this,'keyup');" onFocus="this.className='inp1m';CountGold(this,'focus');this.value='';" style="height: 18px;" size="6" name="Num_50" class="inp1">
          </span></td>
        <td bordercolor="cccccc" align="center" height="25"> 特双</td>
        <td align="center" height="25"><span id="bl50" class="multiple_Red">1.9</span></td>
        <td align="center"><span id="gold50">
          <input onKeyPress="return CheckKey();" onBlur="this.className='inp1';return CountGold(this,'blur','SM','0','51');" onKeyUp="return CountGold(this,'keyup');" onFocus="this.className='inp1m';CountGold(this,'focus');this.value='';" style="height: 18px;" size="6" name="Num_51" class="inp1">
          </span></td>
        <td bordercolor="cccccc" align="center" height="25"> 特大</td>
        <td align="center" height="25"><span id="bl51" class="multiple_Red">1.9</span></td>
        <td align="center"><span id="gold51">
          <input onKeyPress="return CheckKey();" onBlur="this.className='inp1';return CountGold(this,'blur','SM','0','52');" onKeyUp="return CountGold(this,'keyup');" onFocus="this.className='inp1m';CountGold(this,'focus');this.value='';" style="height: 18px;" size="6" name="Num_52" class="inp1">
          </span></td>
        <td bordercolor="cccccc" align="center" height="25"> 特小</td>
        <td align="center" height="25"><span id="bl52" class="multiple_Red">1.9</span></td>
        <td align="center"><span id="gold52">
          <input onKeyPress="return CheckKey();" onBlur="this.className='inp1';return CountGold(this,'blur','SM','0','53');" onKeyUp="return CountGold(this,'keyup');" onFocus="this.className='inp1m';CountGold(this,'focus');this.value='';" style="height: 18px;" size="6" name="Num_53" class="inp1">
          </span></td>
        <td bordercolor="cccccc" align="center" height="25"> 合单</td>
        <td align="center" height="25"><span id="bl53" class="multiple_Red">1.9</span></td>
        <td align="center"><span id="gold53">
          <input onKeyPress="return CheckKey();" onBlur="this.className='inp1';return CountGold(this,'blur','SM','0','54');" onKeyUp="return CountGold(this,'keyup');" onFocus="this.className='inp1m';CountGold(this,'focus');this.value='';" style="height: 18px;" size="6" name="Num_54" class="inp1">
          </span></td>
      </tr>
      <tr onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor='ffffff'" id="cc7799" style="background-color: rgb(255, 255, 255);" bgcolor="#FFFFFF">
        <td bordercolor="cccccc" align="center" height="25" nowrap="nowrap"><font color="">合双</font></td>
        <td align="center" height="25"><span id="bl54" class="multiple_Red">1.9</span></td>
        <td align="center"><span id="gold54">
          <input onKeyPress="return CheckKey();" onBlur="this.className='inp1';return CountGold(this,'blur','SM','0','55');" onKeyUp="return CountGold(this,'keyup');" onFocus="this.className='inp1m';CountGold(this,'focus');this.value='';" style="height: 18px;" size="6" name="Num_55" class="inp1">
          </span></td>
        <td bordercolor="cccccc" align="center" height="25" nowrap="nowrap"><font color="ff0000">紅波</font></td>
        <td align="center" height="25"><span id="bl55" class="multiple_Red">2.6</span></td>
        <td align="center"><span id="gold55">
          <input onKeyPress="return CheckKey();" onBlur="this.className='inp1';return CountGold(this,'blur','BS','0','56');" onKeyUp="return CountGold(this,'keyup');" onFocus="this.className='inp1m';CountGold(this,'focus');this.value='';" style="height: 18px;" size="6" name="Num_56" class="inp1">
          </span></td>
        <td bordercolor="cccccc" align="center" height="25" nowrap="nowrap"><font color="009900">綠波</font></td>
        <td align="center" height="25"><span id="bl56" class="multiple_Red">2.6</span></td>
        <td align="center"><span id="gold56">
          <input onKeyPress="return CheckKey();" onBlur="this.className='inp1';return CountGold(this,'blur','BS','0','57');" onKeyUp="return CountGold(this,'keyup');" onFocus="this.className='inp1m';CountGold(this,'focus');this.value='';" style="height: 18px;" size="6" name="Num_57" class="inp1">
          </span></td>
        <td bordercolor="cccccc" align="center" height="25" nowrap="nowrap"><font color="0000ff">藍波</font></td>
        <td align="center" height="25"><span id="bl57" class="multiple_Red">2.6</span></td>
        <td align="center"><span id="gold57">
          <input onKeyPress="return CheckKey();" onBlur="this.className='inp1';return CountGold(this,'blur','BS','0','58');" onKeyUp="return CountGold(this,'keyup');" onFocus="this.className='inp1m';CountGold(this,'focus');this.value='';" style="height: 18px;" size="6" name="Num_58" class="inp1">
          </span></td>
        <td bordercolor="cccccc" align="center" height="25" nowrap="nowrap"><font color="">尾小</font></td>
        <td align="center" height="25"><span id="bl58" class="multiple_Red">1.9</span></td>
        <td align="center"><span id="gold58">
          <input onKeyPress="return CheckKey();" onBlur="this.className='inp1';return CountGold(this,'blur','SM','0','59');" onKeyUp="return CountGold(this,'keyup');" onFocus="this.className='inp1m';CountGold(this,'focus');this.value='';" style="height: 18px;" size="6" name="Num_59" class="inp1">
          </span></td>
      </tr>
      <tr onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor='ffffff'" id="cc6699" style="background-color: rgb(255, 255, 255);" bgcolor="#FFFFFF">
        <td bordercolor="cccccc" align="center" height="25"> 尾大</td>
        <td align="center" height="25"><span id="bl59" class="multiple_Red">1.9</span></td>
        <td align="center"><span id="gold59">
          <input onKeyPress="return CheckKey();" onBlur="this.className='inp1';return CountGold(this,'blur','SM','0','60');" onKeyUp="return CountGold(this,'keyup');" onFocus="this.className='inp1m';CountGold(this,'focus');this.value='';" style="height: 18px;" size="6" name="Num_60" class="inp1">
          </span></td>
        <td bordercolor="cccccc" align="center" height="25"> 家禽</td>
        <td align="center" height="25"><span id="bl60" class="multiple_Red">1.9</span></td>
        <td align="center"><span id="gold60">
          <input onKeyPress="return CheckKey();" onBlur="this.className='inp1';return CountGold(this,'blur','SM','0','61');" onKeyUp="return CountGold(this,'keyup');" onFocus="this.className='inp1m';CountGold(this,'focus');this.value='';" style="height: 18px;" size="6" name="Num_61" class="inp1">
          </span></td>
        <td bordercolor="cccccc" align="center" height="25"> 野獸</td>
        <td align="center" height="25"><span id="bl61" class="multiple_Red">1.9</span></td>
        <td align="center"><span id="gold61">
          <input onKeyPress="return CheckKey();" onBlur="this.className='inp1';return CountGold(this,'blur','SM','0','62');" onKeyUp="return CountGold(this,'keyup');" onFocus="this.className='inp1m';CountGold(this,'focus');this.value='';" style="height: 18px;" size="6" name="Num_62" class="inp1">
          </span></td>
        <td align="center"></td>
        <td align="center">&nbsp;</td>
        <td align="center">&nbsp;</td>
        <td align="center">&nbsp;</td>
        <td align="center">&nbsp;</td>
        <td align="center">&nbsp;</td>
      </tr>
    </tbody>
  </table>
  <input value="0" name="gold_all" type="hidden">
  <input value="0" name="allgold" type="hidden">
  <input value="0" name="total_gold" type="hidden">
  <table bordercolordark="#FFFFFF" class="Ball_List" border="0" bordercolor="f1f1f1" cellpadding="0" cellspacing="1" width="780">
    <form name="l1t_form" id="l1t_form" method="post" action="">
    </form>
    <input value="SN" name="rtype" type="hidden">
    <input value="1" name="active" type="hidden">
    <input value="N" name="chk_01" type="hidden">
    <input value="N" name="chk_02" type="hidden">
    <input value="N" name="chk_03" type="hidden">
    <input value="N" name="chk_04" type="hidden">
    <input value="N" name="chk_05" type="hidden">
    <input value="N" name="chk_06" type="hidden">
    <input value="N" name="chk_07" type="hidden">
    <input value="N" name="chk_08" type="hidden">
    <input value="N" name="chk_09" type="hidden">
    <input value="N" name="chk_10" type="hidden">
    <input value="N" name="chk_11" type="hidden">
    <input value="N" name="chk_12" type="hidden">
    <input value="N" name="chk_13" type="hidden">
    <input value="N" name="chk_14" type="hidden">
    <input value="N" name="chk_15" type="hidden">
    <input value="N" name="chk_16" type="hidden">
    <input value="N" name="chk_17" type="hidden">
    <input value="N" name="chk_18" type="hidden">
    <input value="N" name="chk_19" type="hidden">
    <input value="N" name="chk_20" type="hidden">
    <input value="N" name="chk_21" type="hidden">
    <input value="N" name="chk_22" type="hidden">
    <input value="N" name="chk_23" type="hidden">
    <input value="N" name="chk_24" type="hidden">
    <input value="N" name="chk_25" type="hidden">
    <input value="N" name="chk_26" type="hidden">
    <input value="N" name="chk_27" type="hidden">
    <input value="N" name="chk_28" type="hidden">
    <input value="N" name="chk_29" type="hidden">
    <input value="N" name="chk_30" type="hidden">
    <input value="N" name="chk_31" type="hidden">
    <input value="N" name="chk_32" type="hidden">
    <input value="N" name="chk_33" type="hidden">
    <input value="N" name="chk_34" type="hidden">
    <input value="N" name="chk_35" type="hidden">
    <input value="N" name="chk_36" type="hidden">
    <input value="N" name="chk_37" type="hidden">
    <input value="N" name="chk_38" type="hidden">
    <input value="N" name="chk_39" type="hidden">
    <input value="N" name="chk_40" type="hidden">
    <input value="N" name="chk_41" type="hidden">
    <input value="N" name="chk_42" type="hidden">
    <input value="N" name="chk_43" type="hidden">
    <input value="N" name="chk_44" type="hidden">
    <input value="N" name="chk_45" type="hidden">
    <input value="N" name="chk_46" type="hidden">
    <input value="N" name="chk_47" type="hidden">
    <input value="N" name="chk_48" type="hidden">
    <input value="N" name="chk_49" type="hidden">
    <tbody>
      <tr class="td_caption_1" align="center">
        <td colspan="15" bordercolor="cccccc" align="center" bgcolor="#C6D0EC" nowrap="nowrap"><strong>快速下註
          
          
          &nbsp;</strong></td>
      </tr>
      <tr align="center">
        <td bordercolor="cccccc" align="left" bgcolor="#FFFFFF" nowrap="nowrap"><input name="mf[]" id="mf[]" onClick="editArray1(this);" value="05,17,29,41" type="checkbox">
          鼠 </td>
        <td bordercolor="cccccc" align="left" bgcolor="#FFFFFF" nowrap="nowrap"><input name="mf[]" id="mf[]" onClick="editArray1(this);" value="04,16,28,40" type="checkbox">
          牛 </td>
        <td bordercolor="cccccc" align="left" bgcolor="#FFFFFF" nowrap="nowrap"><input name="mf[]" id="mf[]" onClick="editArray1(this);" value="03,15,27,39" type="checkbox">
          虎 </td>
        <td bordercolor="cccccc" align="left" bgcolor="#FFFFFF" nowrap="nowrap"><input name="mf[]" id="mf[]" onClick="editArray1(this);" value="02,14,26,38" type="checkbox">
          兔 </td>
        <td bordercolor="cccccc" align="left" bgcolor="#FFFFFF" nowrap="nowrap"><input name="mf[]" id="mf[]" onClick="editArray1(this);" value="01,13,25,37,49" type="checkbox">
          龙 </td>
        <td bordercolor="cccccc" align="left" bgcolor="#FFFFFF" nowrap="nowrap"><input name="mf[]" id="mf[]" onClick="editArray1(this);" value="12,24,36,48" type="checkbox">
          蛇 </td>
        <td bordercolor="cccccc" align="left" bgcolor="#FFFFFF" nowrap="nowrap"><input name="mf[]" id="mf[]" onClick="editArray1(this);" value="11,23,35,47" type="checkbox">
          马 </td>
        <td bordercolor="cccccc" align="left" bgcolor="#FFFFFF" nowrap="nowrap"><input name="mf[]" id="mf[]" onClick="editArray1(this);" value="10,22,34,46" type="checkbox">
          羊 </td>
        <td bordercolor="cccccc" align="left" bgcolor="#FFFFFF" nowrap="nowrap"><input name="mf[]" id="mf[]" onClick="editArray1(this);" value="09,21,33,45" type="checkbox">
          猴 </td>
        <td bordercolor="cccccc" align="left" bgcolor="#FFFFFF" nowrap="nowrap"><input name="mf[]" id="mf[]" onClick="editArray1(this);" value="08,20,32,44" type="checkbox">
          鸡 </td>
        <td bordercolor="cccccc" align="left" bgcolor="#FFFFFF" nowrap="nowrap"><input name="mf[]" id="mf[]" onClick="editArray1(this);" value="07,19,31,43" type="checkbox">
          狗 </td>
        <td bordercolor="cccccc" align="left" bgcolor="#FFFFFF" nowrap="nowrap"><input name="mf[]" id="mf[]" onClick="editArray1(this);" value="06,18,30,42" type="checkbox">
          猪 </td>
        <td bordercolor="cccccc" align="left" bgcolor="#FFFFFF" nowrap="nowrap">&nbsp;</td>
        <td bordercolor="cccccc" align="left" bgcolor="#FFFFFF" nowrap="nowrap">&nbsp;</td>
        <td bordercolor="cccccc" align="left" bgcolor="#FFFFFF" nowrap="nowrap">&nbsp;</td>
      </tr>
      <tr align="center">
        <td bordercolor="cccccc" align="left" bgcolor="#FFFFFF" nowrap="nowrap"><input name="mf[]" id="mf[]" onClick="editArray1(this);" value="01,07,13,19,23,29,35,45" type="checkbox">
          <span class="Font_R">紅单</span></td>
        <td bordercolor="cccccc" align="left" bgcolor="#FFFFFF" nowrap="nowrap"><input name="mf[]" id="mf[]" onClick="editArray1(this);" value="02,08,12,18,24,30,34,40,46" type="checkbox">
          <span class="Font_R">紅双</span></td>
        <td bordercolor="cccccc" align="left" bgcolor="#FFFFFF" nowrap="nowrap"><input name="mf[]" id="mf[]" onClick="editArray1(this);" value="29,30,34,35,40,45,46" type="checkbox">
          <span class="Font_R">紅大</span></td>
        <td bordercolor="cccccc" align="left" bgcolor="#FFFFFF" nowrap="nowrap"><input name="mf[]" id="mf[]" onClick="editArray1(this);" value="01,02,07,08,12,13,18,19,23,24" type="checkbox">
          <span class="Font_R">紅小</span></td>
        <td bordercolor="cccccc" align="left" bgcolor="#FFFFFF" nowrap="nowrap"><input name="mf[]" id="mf[]" onClick="editArray1(this);" value="03,09,15,25,31,37,41,47" type="checkbox">
          <span class="STYLE2">藍单</span></td>
        <td bordercolor="cccccc" align="left" bgcolor="#FFFFFF" nowrap="nowrap"><input name="mf[]" id="mf[]" onClick="editArray1(this);" value="04,10,14,20,26,36,42,48" type="checkbox">
          <span class="STYLE2">藍双</span></td>
        <td bordercolor="cccccc" align="left" bgcolor="#FFFFFF" nowrap="nowrap"><input name="mf[]" id="mf[]" onClick="editArray1(this);" value="25,26,31,36,37,41,42,47,48" type="checkbox">
          <span class="STYLE2">藍大</span></td>
        <td bordercolor="cccccc" align="left" bgcolor="#FFFFFF" nowrap="nowrap"><input name="mf[]" id="mf[]" onClick="editArray1(this);" value="03,04,09,10,14,15,20" type="checkbox">
          <span class="STYLE2">藍小</span></td>
        <td bordercolor="cccccc" align="left" bgcolor="#FFFFFF" nowrap="nowrap"><input name="mf[]" id="mf[]" onClick="editArray1(this);" value="05,11,17,21,27,33,39,43,49,49" type="checkbox">
          <span class="STYLE8">綠单</span></td>
        <td bordercolor="cccccc" align="left" bgcolor="#FFFFFF" nowrap="nowrap"><input name="mf[]" id="mf[]" onClick="editArray1(this);" value="06,16,22,28,32,38,44" type="checkbox">
          <span class="STYLE8">綠双</span></td>
        <td bordercolor="cccccc" align="left" bgcolor="#FFFFFF" nowrap="nowrap"><input name="mf[]" id="mf[]" onClick="editArray1(this);" value="27,28,32,33,38,39,43,44,49,49" type="checkbox">
          <span class="STYLE8">綠大</span></td>
        <td bordercolor="cccccc" align="left" bgcolor="#FFFFFF" nowrap="nowrap"><input name="mf[]" id="mf[]" onClick="editArray1(this);" value="05,06,11,16,17,21,22" type="checkbox">
          <span class="STYLE8">綠小</span></td>
        <td bordercolor="cccccc" align="left" bgcolor="#FFFFFF" nowrap="nowrap"><input name="mf[]" id="mf[]" onClick="editArray1(this);" value="01,07,13,19,23,29,35,45,02,08,12,18,24,30,34,40,46" type="checkbox">
          <span class="Font_R"><strong>紅波</strong></span></td>
        <td bordercolor="cccccc" align="left" bgcolor="#FFFFFF" nowrap="nowrap"><input name="mf[]" id="mf[]" onClick="editArray1(this);" value="03,09,15,25,31,37,41,47,04,10,14,20,26,36,42,48" type="checkbox">
          <span class="STYLE7">藍波</span></td>
        <td bordercolor="cccccc" align="left" bgcolor="#FFFFFF" nowrap="nowrap"><input name="mf[]" id="mf[]" onClick="editArray1(this);" value="05,11,17,21,27,33,39,43,49,06,16,22,28,32,38,44,49" type="checkbox">
          <span class="STYLE5">綠波</span></td>
      </tr>
      <tr align="center">
        <td bordercolor="cccccc" align="left" bgcolor="#FFFFFF" nowrap="nowrap"><input name="mf[]" id="mf[]" onClick="editArray1(this);" value="01,03,05,07,09,11,13,15,17,19,21,23,25,27,29,31,33,35,37,39,41,43,45,47,49" type="checkbox">
          单號</td>
        <td bordercolor="cccccc" align="left" bgcolor="#FFFFFF" nowrap="nowrap"><input name="mf[]" id="mf[]" onClick="editArray1(this);" value="02,04,06,08,10,12,14,16,18,20,22,24,26,28,30,32,34,36,38,40,42,44,46,48" type="checkbox">
          双號</td>
        <td bordercolor="cccccc" align="left" bgcolor="#FFFFFF" nowrap="nowrap"><input name="mf[]" id="mf[]" onClick="editArray1(this);" value="25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49" type="checkbox">
          大號</td>
        <td bordercolor="cccccc" align="left" bgcolor="#FFFFFF" nowrap="nowrap"><input name="mf[]" id="mf[]" onClick="editArray1(this);" value="01,02,03,04,05,06,07,08,09,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24" type="checkbox">
          小號</td>
        <td bordercolor="cccccc" align="left" bgcolor="#FFFFFF" nowrap="nowrap"><input name="mf[]" id="mf[]" onClick="editArray1(this);" value="01,03,05,07,09,10,12,14,16,18,21,23,25,27,29,30,32,34,36,38,41,43,45,47,49" type="checkbox">
          合单</td>
        <td bordercolor="cccccc" align="left" bgcolor="#FFFFFF" nowrap="nowrap"><input name="mf[]" id="mf[]" onClick="editArray1(this);" value="02,04,06,08,11,13,15,17,19,20,22,24,26,28,31,33,35,37,39,40,42,44,46,48" type="checkbox">
          合双</td>
        <td bordercolor="cccccc" align="left" bgcolor="#FFFFFF" nowrap="nowrap"><input name="mf[]" id="mf[]" onClick="editArray1(this);" value="01,03,05,07,09,11,13,15,17,19,21,23" type="checkbox">
          小单</td>
        <td bordercolor="cccccc" align="left" bgcolor="#FFFFFF" nowrap="nowrap"><input name="mf[]" id="mf[]" onClick="editArray1(this);" value="25,27,29,31,33,35,37,39,41,43,45,47,49" type="checkbox">
          大单</td>
        <td bordercolor="cccccc" align="left" bgcolor="#FFFFFF" nowrap="nowrap"><input name="mf[]" id="mf[]" onClick="editArray1(this);" value="02,04,06,08,10,12,14,16,18,20,22,24" type="checkbox">
          小双</td>
        <td bordercolor="cccccc" align="left" bgcolor="#FFFFFF" nowrap="nowrap"><input name="mf[]" id="mf[]" onClick="editArray1(this);" value="26,28,30,32,34,36,38,40,42,44,46,48" type="checkbox">
          大双</td>
        <td bordercolor="cccccc" align="left" bgcolor="#FFFFFF" nowrap="nowrap"><input name="mf[]" id="mf[]" onClick="editArray1(this);" value="01,02,03,04,05,06,07,08,09" type="checkbox">
          0頭</td>
        <td bordercolor="cccccc" align="left" bgcolor="#FFFFFF" nowrap="nowrap"><input name="mf[]" id="mf[]" onClick="editArray1(this);" value="10,11,12,13,14,15,16,17,18,19" type="checkbox">
          1頭</td>
        <td bordercolor="cccccc" align="left" bgcolor="#FFFFFF" nowrap="nowrap"><input name="mf[]" id="mf[]" onClick="editArray1(this);" value="20,21,22,23,24,25,26,27,28,29" type="checkbox">
          2頭</td>
        <td bordercolor="cccccc" align="left" bgcolor="#FFFFFF" nowrap="nowrap"><input name="mf[]" id="mf[]" onClick="editArray1(this);" value="30,31,32,33,34,35,36,37,38,39" type="checkbox">
          3頭</td>
        <td bordercolor="cccccc" align="left" bgcolor="#FFFFFF" nowrap="nowrap"><input name="mf[]" id="mf[]" onClick="editArray1(this);" value="40,41,42,43,44,45,46,47,48,49" type="checkbox">
          4頭</td>
      </tr>
      <tr align="center">
        <td bordercolor="cccccc" align="left" bgcolor="#FFFFFF" nowrap="nowrap"><input name="mf[]" id="mf[]" onClick="editArray1(this);" value="10,20,30,40" type="checkbox">
          0尾</td>
        <td bordercolor="cccccc" align="left" bgcolor="#FFFFFF" nowrap="nowrap"><input name="mf[]" id="mf[]" onClick="editArray1(this);" value="01,11,21,31,41" type="checkbox">
          1尾</td>
        <td bordercolor="cccccc" align="left" bgcolor="#FFFFFF" nowrap="nowrap"><input name="mf[]" id="mf[]" onClick="editArray1(this);" value="02,12,22,32,42" type="checkbox">
          2尾</td>
        <td bordercolor="cccccc" align="left" bgcolor="#FFFFFF" nowrap="nowrap"><input name="mf[]" id="mf[]" onClick="editArray1(this);" value="03,13,23,33,43" type="checkbox">
          3尾</td>
        <td bordercolor="cccccc" align="left" bgcolor="#FFFFFF" nowrap="nowrap"><input name="mf[]" id="mf[]" onClick="editArray1(this);" value="04,14,24,34,44" type="checkbox">
          4尾</td>
        <td bordercolor="cccccc" align="left" bgcolor="#FFFFFF" nowrap="nowrap"><input name="mf[]" id="mf[]" onClick="editArray1(this);" value="05,15,25,35,45" type="checkbox">
          5尾</td>
        <td bordercolor="cccccc" align="left" bgcolor="#FFFFFF" nowrap="nowrap"><input name="mf[]" id="mf[]" onClick="editArray1(this);" value="06,16,26,36,46" type="checkbox">
          6尾</td>
        <td bordercolor="cccccc" align="left" bgcolor="#FFFFFF" nowrap="nowrap"><input name="mf[]" id="mf[]" onClick="editArray1(this);" value="07,17,27,37,47" type="checkbox">
          7尾</td>
        <td bordercolor="cccccc" align="left" bgcolor="#FFFFFF" nowrap="nowrap"><input name="mf[]" id="mf[]" onClick="editArray1(this);" value="08,18,28,38,48" type="checkbox">
          8尾</td>
        <td bordercolor="cccccc" align="left" bgcolor="#FFFFFF" nowrap="nowrap"><input name="mf[]" id="mf[]" onClick="editArray1(this);" value="09,19,29,39,49" type="checkbox">
          9尾</td>
        <td bordercolor="cccccc" align="left" bgcolor="#FFFFFF" nowrap="nowrap">&nbsp;</td>
        <td colspan="4" bordercolor="cccccc" align="left" bgcolor="#FFFFFF" nowrap="nowrap"><table border="0" cellpadding="0" cellspacing="0">
            <tbody>
              <tr>
                <td>金額</td>
                <td><input name="money" class="input1" value="0" size="4"></td>
                <td>&nbsp;
                  <input name="button2" class="button_a" value="送出" onClick="editArray3();" type="button"></td>
                <td>&nbsp;
                  <input class="button_a" value="取消" name="reset" onClick="editArray2();" type="reset"></td>
              </tr>
            </tbody>
          </table></td>
      </tr>
      <tr class="td_caption_1" align="center">
        <td colspan="15" bordercolor="cccccc" align="center" bgcolor="#FFFFFF" nowrap="nowrap"><strong>手动快速下註</strong></td>
      </tr>
      <tr align="center">
        <td colspan="15" bordercolor="cccccc" align="left" bgcolor="#FFFFFF" height="25" nowrap="nowrap"><span class="Font_R"><span class="STYLE6">快速下单:</span>格式-&gt;01=100 02=100 10=200(<span class="STYLE2">01号100元,02号100元,10号200元</span>),每一注以“空格”分隔,前两位为号码,等号后边为金额。</span></td>
      </tr>
      <tr align="center">
        <td colspan="15" bordercolor="cccccc" align="left" bgcolor="#FFFFFF" nowrap="nowrap"><table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tbody>
              <tr>
                <td width="70%"><textarea name="num" cols="80" rows="5" id="num"></textarea></td>
                <td width="30%"><input name="button22" class="button_a" value="送出" onClick="editArray5();" type="button">
                  <input class="button_a" value="取消" name="reset2" onClick="editArray2();" type="reset"></td>
              </tr>
            </tbody>
          </table></td>
      </tr>
    </tbody>
  </table>
</div>
<!-- 結束  --> 

<script>
			
function ResetControl() {
var o = document.l1t_form;
for(var i=0;i<o.length;i++){
o[i].checked = false
}
}



function setCookie(name, value) //cookies設置 
{ 
var argv = setCookie.arguments; 
var argc = setCookie.arguments.length; 
var expires = (argc > 2) ? argv[2] : null; 
if(expires!=null) 
{ 
var LargeExpDate = new Date (); 
LargeExpDate.setTime(LargeExpDate.getTime() + (expires*1000*3600*24)); 
} 
document.cookie = name + "=" + escape (value)+((expires == null) ? "" : ("; expires=" +LargeExpDate.toGMTString())); 
} 

function getCookie(Name) //cookies讀取 
{ 
var search = Name + "=" 
if(document.cookie.length > 0) 
{ 
offset = document.cookie.indexOf(search) 
if(offset != -1) 
{ 
offset += search.length 
end = document.cookie.indexOf(";", offset) 
if(end == -1) end = document.cookie.length 
return unescape(document.cookie.substring(offset, end)) 
} 
else return "" 
} 
} 	  
				  
var nReload = getCookie("reload");
if (!nReload) { nReload = 0; }
var nNowReload = nReload;
function chgreload(n)
{
    bRun = false;
    if (nReload==0) {
        bRun = true;
    }
    setCookie("reload",n);
    nReload = n;
    nNowReload = nReload;
    if (bRun) {
        timeReload();
    }
}
function timeReload()
{
    if (nReload > 0) {
        document.all.n.innerHTML = nNowReload--;
        if (nNowReload < 0) {
            //makeRequest();
			quick5();
            nNowReload = nReload;
        }
        setTimeout("timeReload()", 1000);
    }
}
if (nReload > 0) {
    document.all.n.innerHTML = nNowReload--;
    setTimeout("timeReload()", 1000);
}

 chgreload("90");
quick5();

 function deafults(){
  quick5();
  editArray2();
document.all.btnSubmit.disabled = false;
document.getElementById("gold_all").value='';
document.all.allgold.value ='0';
 }
  function deafults1(){
document.all.btnSubmit.disabled = false;
 }

 </script> 
<script language="javascript">
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
			quick5();
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
			quick5();
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



ClockTime_C="04:38:42";
ClockTime_O="04:38:42";

Run_onTimer();
 
 </script>
</body>
</html>