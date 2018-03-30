<?php 
include_once ('../global.php');
$db = new action($mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset); //数据库操作类.
$uid = $_SESSION['uid'.$c_p_seesion];	
if($uid){
$info = mysql_fetch_array(mysql_query("select * from users  where user_id = '$uid'"));	 
$issueno = mysql_fetch_array(mysql_query("select plate_num from orders order by plate_num DESC limit 1"));
$oddsset_type=$db->get_all("select * from oddsset_type where user_id=".$uid." and o_topid='二字定'");
if (!$oddsset_type) {
	$oddsset_type=$db->get_all("select * from oddsset_type where user_id=0 and o_topid='二字定'");
}
// var_dump($oddsset_type);exit;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<link rel="stylesheet" type="text/css" id="css" href="./css/members.css">
<title>numberfrank</title>
<script src="./js/common.js" type="text/javascript"></script>
<style>
.td1 {
	FONT-FAMILY: Verdana; FONT-SIZE: 10pt;  TEXT-DECORATION: none;
	BACKGROUND-COLOR: white
}
.td2 {
	FONT-FAMILY: Verdana; FONT-SIZE: 10pt;  TEXT-DECORATION: none;
	BACKGROUND-COLOR: #ffff00
}
.c1 {
	BACKGROUND-COLOR: #F3D8D6; TEXT-ALIGN: center;
	font-family: Verdana; font-size: 9pt; COLOR: #202040 
}
.indw{width:20px;margin:0;padding:0;}
</style>
<style>html{overflow-y:scroll;}</style>
</head>
<body style="margin: 0px"  >

<table width="100%" border="0" cellpadding="0" cellspacing="0" align=center>
<tr>
<td style="padding:0 10px">
	<SCRIPT LANGUAGE="JavaScript">
<!--

/*function acturl(t,childid){
  self.location = "index.php?action=numberfrank&amp;c="+t+"&childid="+childid;
}*/
function allmoney(t){
	var m_bj = t.value;
	if(m_bj==0){t.value='';}
	if(m_bj > 5000){
		alert("填写的金额不能超出单注上限5000!");//全局限制
		t.value='';
		t.focus();
	}else if(m_bj>0 && m_bj < 1){
		alert("填写金额不能小于1!");
		t.value='';
		t.focus();
	}
	var gon_m = eval("form1.on_m");
	var num=0;var m=0;
	for(var i=0;i<=gon_m.length-1;i++ ){
		// ii = i<10 ?  "0"+""+i : i;
		// console.log(gon_m[li]);
		if(gon_m[i].value!=''){
			 m = m+(gon_m[i].value-0);
			 num=num+1;
		}
	}
	$('numbertotal').innerHTML=num;
	$('numbertotalmoney').innerHTML=m;	
}
setTimeout("form1.on_m[0].focus();",300);
groupid = "";
realid = "";

qCarHead = "";
qCarTail = "";
qChoDiv = "";
qChoTwo = "";

function soonsend(tt){
	var gon_m = eval("form1.on_m")
	var comm='';
	var allm=0;
	var m_bj=0;
	realid='';
	for(var i=0;i<=gon_m.length-1;i++ ){
		var gm=0;
		gm = eval(gon_m[i].value-0);
		if(gm>0){
			 if(i<10)
			 realid += comm+""+eval("form1.id0"+i).value+"|"+gm;
			 else
			 realid += comm+""+eval("form1.id"+i).value+"|"+gm;
			 allm = allm+gm;
			 if(m_bj<gm)m_bj=gm;
			 comm=",";
		}
	}
  if (realid == ""){
    alert("请填写金额!");
    return false;
  }else{
	var n_m = realid;
	var credits_remaining = <?php echo $info['credit_remainder'];?>;
	if(m_bj > 2000){
		alert("填写的金额不能超出单注上限2000!");
		return false;
	}else if (allm > credits_remaining||credits_remaining<=0){
		alert("信用额度不足!");
		return false;		
	}
	
	//form1.target='soonnotsucceed';
	form1.post_number_money.value=n_m;
	form1.post_money.value=0;
	form1.action.value='soonselectnumber';
	form1.doaction.value='soonselectnumber';
	form1.submit();  
	tt.disabled=true;	
  	//return true;
  }
}

function write_td2(no){       
  document.write('<td>&nbsp;</td>');  
}
/*function Tre1(nSorD)
{
	var gon_m = eval("form1.on_m");
	for(var i=0;i<=gon_m.length-1;i++ ){
		ii = i<10 ?  "0"+""+i : i;
		gon_m[ii].value='';
	}
	$('numbertotal').innerHTML=0;
	$('numbertotalmoney').innerHTML=0;	
}*/

//-->
</SCRIPT>
	<form name="form1" method="post" action="./ajax/ajax.php?action=soonselectnumber">
	<input type="hidden" name="formhash" value="b718f6b0">
	<input type="hidden" name="post_number_money" >
	<input type="hidden" name="post_money" >
	<input type="hidden" name="action" >
	<input type="hidden" name="doaction" > 
	<input type="hidden" name="lujingstat" value="1"> 
	<input type="hidden" value="0" name="countslt" />
	<input type="hidden" value="A" name="currends" />
	<input type="hidden" value="EZ" name="currendw" />
	<input type="hidden" value="" name="currendc" />
	<table width="100%" border="0" cellpadding="0" cellspacing="0" class="numberfrank" >
	<tr class="header_left_b">
	<td colspan="2" >
	<button type="button" style="height: 22px;line-height: 19px;font: 12px Arial, Helvetica, sans-serif;"  onclick="moshi();" id="submit1">模式1</button>&nbsp;&nbsp;
		类别 &nbsp;&nbsp;&nbsp;&nbsp;
		<?php foreach ($oddsset_type as $key => $value){?>
			
		<a href="###" onclick='info(1,"<?php echo $value['o_typename'];?>");jsclassname("<?php echo $value['o_typename'];?>",<?php echo $value['o_id'];?>,this);' id="childid<?php echo $key;?>" style="<?php if($value['o_typename']=='口XX口'){echo 'color:#ff0000';}?>"  class="meuntop"><?php echo $value['o_typename'];?></a>&nbsp;&nbsp;&nbsp;&nbsp;
		<?php }?>
		<!-- <a href="###" onclick='info(1,101);jsclassname("口X口X",101,this);' id=childid1 style=""  class="meuntop">口X口X</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="###" onclick='info(1,100);jsclassname("口XX口",100,this);' id=childid2 style="color:#FF0000;"  class="meuntop">口XX口</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="###" onclick='info(1,98);jsclassname("X口X口",98,this);' id=childid3 style=""  class="meuntop">X口X口</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="###" onclick='info(1,99);jsclassname("X口口X",99,this);' id=childid4 style=""  class="meuntop">X口口X</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="###" onclick='info(1,97);jsclassname("XX口口",97,this);' id=childid5 style=""  class="meuntop">XX口口</a> -->  <font color="#FFFF00">笔数：<span id="numbertotal">0</span> 总金额：<span id="numbertotalmoney">0</span></font>
	</td>
	<tr>
	<tr><td style="background: #FFFFFF;">
	<span id="show_table"></span>
	
	</td><tr></form>
	</table>
<script>
function KeyDown(tt) 
{ 
	if (event.keyCode == 13) 
	{ 
	
	event.returnValue=false; 
	event.cancel = true; 
	soonsend(tt);return false; 
	} 
} 
var datetime = "";
function ajax(url, vars, callbackFunction){
  var request = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject("MSXML2.XMLHTTP.3.0");
  request.open("GET", url, true); 
  request.onreadystatechange = function(){
    if (request.readyState == 4 && request.status == 200){
      if (request.responseText){         
          callbackFunction(request.responseText);
      }
    }
  };
  request.send(vars);
}

function showdata(index,id,no,rate,money,frank_limit,shipanfrank){
  if (rate == ""){
  }else{
  	//if(frank_limit<=rate||'v2_default_4'=='v2_trad'||'v2_default_4'=='v2_trad_1')rate="<font color=red>"+rate+"</font>";
  	//if((frank_limit-0)<=(rate-0)||95==1)rate="<font color=red>"+rate+"</font>";else rate="<font color=#0000FF>"+rate+"</font>";
  	if(95>0 && 95 > (shipanfrank-0))rate="<font color=#0000FF>"+rate+"</font>"; else rate="<font color=red>"+rate+"</font>";
  	
    eval("rate"+index).innerHTML = rate;

  }
  eval("name"+index).innerHTML = no; 
  eval("form1.id"+index).value = no;
  //eval("form1.id"+index).value = id;
}
function write_td0(no){    
  var bgcolor='bgcolor=#FFCC66';
  var baoma='号码';
  var peili='金额';
  if(no==0){
  	bgcolor='';
  	baoma='';
  	peili='';
  }
  var h='';
  h='  <td '+bgcolor+'><table width=99% border="0" cellspacing="0" cellpadding="0"  style="font-size:13px;">'
  +'    <tr height=25 align="center"><td>'+baoma+'</td><td><font color=red>'+peili+'</font></td></tr></table></td>';
  return h;
}
function enter_keyCode2(event,no){
    var e=event||window.event;
    var keyCode=e.keyCode||e.which;//e.which 兼容FF
    if (keyCode ==13) {  
    	var n=no+1;
    	if(n==100)
    	soonsend(eval("form1.submit1"));
    	else if(n<10)
        eval("form1.m0"+n).focus();
        else
        eval("form1.m"+n).focus();
    }
}

function write_td(no){
  var h='';
  h='<td style="padding:0px;margin:0px;" id=id_'+no+' align="center">'
  +"<INPUT type='checkbox' id='od_"+no+"' name='on_EZ' value='"+no+"' style='display:none'>"
  +'<table style="padding:0px;margin:0px;text-align:center" width=99% border="0" cellspacing="0" cellpadding="0" style="font-size:13px;">'
  +'<tr align=center  height=30><td style="padding:0px;margin:0px;" width=40><font color=red face="Arial, Helvetica, sans-serif" style="font-size:15px;"><b><div style="width:94%;text-align:center;color:#oooooo" id=rate'+no+'></div></b></font><input type=hidden name=id'+no+'><div style="width:96%;text-align:center;" id=name'+no+'></div></td>'
  +'<td style="padding:0px;margin:0px;"><INPUT TYPE="text" id="m'+no+'" name="on_m" style="width:40px" maxlength=4 onkeyup="this.value=this.value.replace(/[^0-9]/g,\'\');allmoney(this);return false;" onkeydown="enter_keyCode2(event,'+no+');"></td></tr>'
  +'</table>'
  +'</td>';
  return h;
}
function show_t(){
  var h='';
 h='<table width="100%" border="1" cellspacing="0" cellpadding="0" bordercolor="#000000" bordercolordark="#FFFFFF">'
  +'<tr>';
	for(i=1;i<11;i++)
		// alert(i);
	h+=write_td0(i);
  h+='</tr>';
  var num =1;
  for(i=0;i<100;i++){
    if (i<10) ii = "0"+i;else ii = i;
    h+=write_td(ii);
    if (i%10 == 9) h+='</tr>';
  }
  h+='<tr>';
  h+='<td colspan=11 align=center style="text-align:center" class="number_web">';
  h+='<input type=hidden name=id>';
  h+='<button type="button" class="number_w" name="submit1" id="submit1" onclick="soonsend(this);return false;">确定</button></td></tr></table>';
  $('show_table').innerHTML=h; 	
}
function doinfo(str){
show_t();
  if (str != null && str != ""){
    infoa = str.split("!@#%");
    if(infoa[0]==5){
    	alert(infoa[1]);
    	return ;
    }
    infoline = str.split("@@");
    datetime = infoline[0];
    frank_limit = infoline[2];  
    infodata = infoline[1].split("`");
    for(j=0;j<infodata.length;j++){
      sline = infodata[j].split("|");
      if (j<10)ii ="0"+j; else ii = j;
      // console.log(sline);
      showdata(ii,sline[0],sline[1],sline[2],sline[3],frank_limit,sline[4]);
    }
  }
}
function jsclassname(c,d,t){
   for(i=0;i<=5;i++)
	$("childid"+i).style.color = "#fff"; 
	t.style.color = "#FF0000"; 
}
var s_cid=1;
var c_cid=100;
function moshi(){
	location.href = "./numberfrank2.php";
}
function info(t,childid){
	s_cid=t;
	c_cid=childid;
  ajax("./ajax/ajax.php?action=numberfrank"+"&inajax=1"+"&c="+t+"&childid="+childid+"&datetime="+datetime+"&time="+(new Date().getTime()),"",doinfo);
}
show_t();
info('1','口XX口');
//setInterval("info()",15000);

</script>
	</td>
<tr>
</table>
<noscript><iframe src=*.html></iframe></noscript>

<!-- 
	<table width="98%" align="center" border="0" cellpadding="0" cellspacing="0" >
	<tr >
	<td align="center" style="text-align:center">
版权所有 Copyright@2009-2010 usetime:0.010851 
mysqlquery:2 
</td>
<tr>
</table> -->
</body>
</html>