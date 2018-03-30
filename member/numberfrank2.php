<?php 
include_once ('../global.php');
$db = new action($mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset); //数据库操作类.
$uid = $_SESSION['uid'.$c_p_seesion];	
if($uid){
$info = mysql_fetch_array(mysql_query("select * from users  where user_id = '$uid'"));	
$issueno = mysql_fetch_array(mysql_query("select plate_num from orders order by plate_num DESC limit 1"));
$oddsset_type=$db->get_all("select * from oddsset_type where user_id={$uid} and o_topid='二字定'");
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
<title>numberfrank2</title>
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

groupid = "";
realid = "";

qCarHead = "";
qCarTail = "";
qChoDiv = "";
qChoTwo = "";

function soonsend(tt){

	var gon_EZ = eval("form1.on_EZ")
	var comm='';
	realid='';
	for(var i=0;i<=gon_EZ.length-1;i++ ){
		//ii = parseInt(i<10 ?  "0"+""+i : i);
		if(gon_EZ[i].checked){
			 if(i<10)
			 realid += comm+""+eval("form1.id0"+i).value ;
			 else
			 realid += comm+""+eval("form1.id"+i).value ;
			 comm=",";
		}
	}

  if (realid == ""){
    alert("请选择号码!");
    return false;
  }else{

	var n_m = realid;
	var m = form1.amount.value;
	var credits_remaining = <?php echo $info['credit_remainder'];?>;
	var num = n_m.split(',');
	var nummoney = num.length * m;

	if(m==0){
		alert("请填写金额!");
		$("amount").select();
		return false;
	}else if(m > 3000){
		alert("请填写金额不能大于3000!");
		$("amount").select();
		return false;
	}else if (nummoney > credits_remaining||credits_remaining<=0){
		alert("信用额度不足!");
		$("amount").select();
		return false;		
	}
	
	//form1.target='soonnotsucceed';
	form1.post_number_money.value=n_m;
	form1.post_money.value=m;
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

	function BHry(cType,theSn,theMode)
	{
		var cJsm ;
		var cVtn ;
		var onSn ;
		var ihav = 100-document.form1.countslt.value ;

		if (ihav>0 ) 
		{
				var num=0;
				if(realid=='') comm='';
			    for(i=0; i < ihav; i++)
			    {	
				    if (theMode==0)
				    { onSn = (theSn-1) + i*10 ; }
				    else{ onSn = (theSn-1)*10 + i ; }
				    cJsm = "document.all.on_" + cType + "[" + onSn +"]!=null" ;
				    cVtn = eval(cJsm) ;
				    //alert(cJsm+" is " + cVtn) ;
				    if (cVtn)
				    {
					    cJsm = "document.all.on_" + cType + "[" + onSn +"].checked==true" ;
					    cVtn = eval(cJsm) ;
					    if (cVtn){	
						    cJsm = "document.all.on_" + cType + "[" + onSn + "].value";
						    cJsm=eval(cJsm) ;			
					    	document.form1.countslt.value-- ;		
						    cJsm = "document.all.id_" + cJsm + ".className='td1';";				    
						    cJsm+= "document.all.on_" + cType + "[" + onSn +"].checked=false;" ;
						    eval(cJsm) ;					    				    	
					    }else{
				    	
					    
					    cJsm = "document.all.on_" + cType + "[" + onSn + "].value";
					    cJsm=eval(cJsm) ;
					    document.form1.countslt.value++ ;
					    cJsm = "document.all.id_" + cJsm + ".className='td2';";				    
					    cJsm+= "document.all.on_" + cType + "[" + onSn +"].checked=true;" ;
					    eval(cJsm) ;
					    }
						$('numbertotal').innerHTML=document.form1.countslt.value;
						$('numbertotalmoney').innerHTML=document.form1.countslt.value*$('amount').value;
					    //alert("document.all.on_" + cType + "[" + onSn +"]") ;
				    }
				    num=num+1;
				    if(num==10){
				    	return false;
				    }
			    }
   
			//document.form1.submit();
		}
		else
		{
			alert("已经选够码了!") ;
		}
	}
	function ChkSelect(newlength)
	{
		var aftlenght=0 ;
		aftlenght=document.form1.countslt.value*1 + newlength*1 ;
		if (aftlenght>100){
			alert('不能选择超过10个码,请重选!') ;
			return false ;
			}
		else{
			return true ;
			}
	}



    function Tg(d,ee)
    {
		e = eval("form1."+ee)
		if (e.value!='')
		{
			var n_oldslt=document.form1.countslt.value*1 ;
			if (d.className=='td2') 
			{
			  e.checked=false ;
			  d.className='td1';
			  document.form1.countslt.value=n_oldslt - 1 ;
			}
			else
			{
			if (ChkSelect(1)) {
			  e.checked=true ;
			  d.className='td2';
			  document.form1.countslt.value=n_oldslt + 1 ;
			  }
			 else
			  {
				if(e.checked==true )
				  {
					e.checked=false;
				  }
				 
				   
			  }
			}
			$('numbertotal').innerHTML=document.form1.countslt.value;
			$('numbertotalmoney').innerHTML=document.form1.countslt.value*$('amount').value;
		}
    }

    function Tre1(nSorD)
    {
		var cJsm , cVtn , cOdw , aOdw , nVdc ;
		
		if (nSorD==0||nSorD==1)
		{	cOdw = document.form1.currendw.value + ",ok" ;
			aOdw = cOdw.split(',');
			nSorD = 1 ;
		}
		else
		{	aOdw = document.form1.currendw.value.split(',');	
			nSorD = aOdw.length-1 ;
		}
		if (nSorD>0)
		{
			for(j=0; j < nSorD; j++)
			{
				cOdw = aOdw[j]
				cJsm = "document.all.on_" + cOdw + ".length";
				nVdc=eval(cJsm) ;
				for(i=0; i < nVdc; i++)
				{
					cJsm = "document.all.on_" + cOdw + "[" + i + "].checked == true";
					cVtn=eval(cJsm) ;
					if (cVtn==true)
					{

					cJsm = "document.all.on_" + cOdw + "[" + i + "].value";
					cJsm=eval(cJsm) ;

					cJsm = "document.all.id_" + cJsm + ".className='td1';";
					cJsm+= "document.all.on_" + cOdw + "[" + i + "].checked = false;";
					eval(cJsm) ;
					}
				}
			}
			document.form1.amount.value='';
		}

		document.form1.countslt.value=0 ;
		$('numbertotal').innerHTML=0;
		$('numbertotalmoney').innerHTML=0;

	  qCarHead = "";
	  qCarTail = "";
	  qChoDiv = "";
	  qChoTwo = "";
	  
	  for(i=0;i<=9;i++){
	    eval("form1.choDiv"+i).style.backgroundColor="";
	  }
	  for(i=4;i<=5;i++){
	    eval("form1.choTwo"+i).style.backgroundColor="";
	  }
	  for(i=0;i<=13;i++){
	    eval("form1.carHead"+i).style.backgroundColor="";
	    eval("form1.carTail"+i).style.backgroundColor="";
	  }
	}

//-->
</SCRIPT>
	<form name=form1 method="post" action="./ajax/ajax.php?action=soonselectnumber">
	<input type="hidden" name="formhash" value="8a52b21d">
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
		 <button type="button" style="height: 22px;line-height: 19px;font: 12px Arial, Helvetica, sans-serif;"  onclick=" moshi();" id="submit1">模式2</button>&nbsp;&nbsp;
		类别 &nbsp;&nbsp;&nbsp;&nbsp;
		<?php foreach ($oddsset_type as $key => $value){?>
			
		<a href="###" onclick='info(1,"<?php echo $value['o_typename'];?>");jsclassname("<?php echo $value['o_typename'];?>",<?php echo $value['o_id'];?>,this);' id="childid<?php echo $key;?>" style="<?php if($value['o_typename']=='口XX口'){echo 'color:#ff0000';}?>"  class="meuntop"><?php echo $value['o_typename'];?></a>&nbsp;&nbsp;&nbsp;&nbsp;
		<?php }?>
		<font color="#FFFF00">笔数：<span id="numbertotal">0</span> 总金额：<span id="numbertotalmoney">0</span></font>
		  

	</td>
	<tr>
	<tr><td style="background: #FFFFFF;"><div id="show_table"></div>
		<table width="100%" border="1" cellspacing="0" cellpadding="0" bordercolor="#000000" bordercolordark="#FFFFFF">

		    <tr>
		    <td>
      <table width="100%" border="1" style="font-size:13px;text-align:left;" cellspacing="0" cellpadding="0" bordercolor="#000000" bordercolordark="#FFFFFF">
        <tr> 

          <td bgcolor=#FFCC66 rowspan="2" width="40" align=center><b>定位置</b></td>
          <td><span id=jsclassname0>仟</span>
          <script>
	    var qChArr = new Array("0","1","2","3","4","5","6","7","8","9","单","双","大","小");
	    for(i=0;i<qChArr.length;i++){
	      document.write('<input class="indw" type=button id=carHead'+i+' value='+qChArr[i]+' onclick="qChooseCar(2,1,'+i+');">');
	    }
	  </script>
	 	 </td>
	 	 <td bgcolor=#FFCC66 rowspan="2" width="30" align=center><b>合分</b></td>
	 	 <td rowspan="2" align=center>
          <script>
	    var qChArr = new Array("0","1","2","3","4","5","6","7","8","9");
	    for(i=0;i<qChArr.length;i++){
	      document.write('<input class="indw" type=button id=choDiv'+i+' value='+qChArr[i]+' onclick="qChooseCar(3,1,'+i+')">');
	      if(i==4){
	      	document.write('<input class="indw" type=button id=choTwo4 value="单" onclick="qChooseCar(1,3,4)">');
	      	document.write('<br>');
	      }else if(i==9){
	      	document.write('<input class="indw" type=button id=choTwo5 value="双" onclick="qChooseCar(1,3,5)">');
	      }
	    }
	  </script>
	 	 </td>
        </tr>
        <tr> 
          <td><span id=jsclassname1>佰</span>
          <script>
	    var qChArr = new Array("0","1","2","3","4","5","6","7","8","9","单","双","大","小");
	    for(i=0;i<qChArr.length;i++){
	      document.write('<input class="indw" type=button id=carTail'+i+' value='+qChArr[i]+' onclick="qChooseCar(2,2,'+i+');">');
	    }
	  </script>
	  </td>
        </tr>
 	  </table>
		    </td>
		      <td ><input type=hidden name=id>   
		      金额:<input type=text name=amount id=amount style="width:50px;" class="number" onkeyup="$('numbertotalmoney').innerHTML=document.form1.countslt.value*this.value;" onkeydown="if(event.keyCode == 13)return false;" size=8 maxlength=7>&nbsp;
		      <button type="button" class="number_w" name="submit1" id="submit1" onclick="soonsend(this);return false;">确定</button>&nbsp;
		      <button type="button" class="number_w"  onclick="return Tre1(0);" id="submit1">取消</button>

		      </td>
		  </tr>
		  </form>
		</table>	
	</td><tr>
	</table>
<script>
//onkeydown="KeyDown(this);"
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
function write_td0(no){    
  var bgcolor='bgcolor=#FFCC66';
  var baoma='号码';
  var peili='赔率';
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
function write_td(no){   
  var h=''; 
  h='<td style="padding:0px;margin:0px;" id=id_'+no+' align="center" onclick="Tg(this,\'od_'+no+'\');" onmouseover="style.cursor = \'hand\';">'
  +"<INPUT type='checkbox' id='od_"+no+"' name='on_EZ' value='"+no+"' style='display:none'>"
  +'<table style="padding:0px;margin:0px;text-align:center" width=98% border="0" cellspacing="0" cellpadding="0" style="font-size:13px;">'
  +'<tr align=center  height=30><td style="padding:0px;margin:0px;" width=40><input type=hidden id=id'+no+' name=id'+no+'><div style="width:96%;text-align:center;" id=name'+no+'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div></td>'
  +'<td style="padding:0px;margin:0px;"><font color=red face="Arial, Helvetica, sans-serif" style="font-size:15px;"><b><div style="width:94%;text-align:center;color:#oooooo;" id=rate'+no+'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div></b></font></td></tr>'
  +'</table>'
  +'</td>';
  return h;
}
function show_t(){
  var h='';
 h='<table width="100%" border="1" cellspacing="0" cellpadding="0" bordercolor="#000000" bordercolordark="#FFFFFF">'
  +'<tr>'
  +"<TR class='c1'>"
  +"<td class='td1' height='6'></td>"
  +"<td id='RowID_A1' onclick=BHry('EZ',1,0) class='td1' height='6'><img src='picture/bhrow.gif'></td>"
  +"<td id='RowID_A2' onclick=BHry('EZ',2,0) class='td1' height='6'><img src='picture/bhrow.gif'></td>"
  +"<td id='RowID_A3' onclick=BHry('EZ',3,0) class='td1' height='6'><img src='picture/bhrow.gif'></td>"
  +"<td id='RowID_A4' onclick=BHry('EZ',4,0) class='td1' height='6'><img src='picture/bhrow.gif'></td>"
  +"<td id='RowID_A5' onclick=BHry('EZ',5,0) class='td1' height='6'><img src='picture/bhrow.gif'></td>"
  +"<td id='RowID_A6' onclick=BHry('EZ',6,0) class='td1' height='6'><img src='picture/bhrow.gif'></td>"
  +"<td id='RowID_A7' onclick=BHry('EZ',7,0) class='td1' height='6'><img src='picture/bhrow.gif'></td>"
  +"<td id='RowID_A8' onclick=BHry('EZ',8,0) class='td1' height='6'><img src='picture/bhrow.gif'></td>"
  +"<td id='RowID_A9' onclick=BHry('EZ',9,0) class='td1' height='6'><img src='picture/bhrow.gif'></td>"
  +"<td id='RowID_A10' onclick=BHry('EZ',10,0) class='td1' height='6'><img src='picture/bhrow.gif'></td>"
  +"</TR>"
  +'<tr>';
  for(i=0;i<11;i++)h+=write_td0(i);
  h+='</tr>';
  var num =1;
for(i=0;i<100;i++){
  if (i%10 == 0) {
  	h+='<tr>';
  	h+="<td id='ColID_A"+num+"' class='td1' width='6' onclick=BHry('EZ',"+num+",1)><img src='picture/bhcol.gif'></td>";
  	num = num+1;
  }
  if (i<10) ii = "0"+i; else ii = i;
  h+= write_td(ii);
  if (i%10 == 9) h+='</tr>';
}
h+='</table>';
  $('show_table').innerHTML=h;
}
function jsclassname(c,d,t){
  carr = c.split('');
  var jsclassnameArr = new Array("仟","佰","拾","个");
  var cc=0;
  for(i=0;i<=(carr.length-1);i++) {
  	if(carr[i]=='口'&&cc==0){
  		$('jsclassname0').innerHTML=jsclassnameArr[i];
  		cc=1;
  	}else if(carr[i]=='口'&&cc==1){
  		$('jsclassname1').innerHTML=jsclassnameArr[i];
  	}
  }
  
  for(i=0;i<=5;i++)
	$("childid"+i).style.color = "#fff"; 
	t.style.color = "#FF0000"; 

}
function showdata(index,id,no,rate,money,frank_limit,shipanfrank){
  if (rate == ""){
  }else{
  	//if(frank_limit<=rate||'v2_default_4'=='v2_trad'||'v2_default_4'=='v2_trad_1')rate="<font color=red>"+rate+"</font>";
  	
  	//if(95>0 && 95 > (rate-0))rate="<font color=#0000FF>"+rate+"</font>"; else rate="<font color=red>"+rate+"</font>";
  	if(95>0 && 95 > (shipanfrank-0))rate="<font color=#0000FF>"+rate+"</font>"; else rate="<font color=red>"+rate+"</font>";
  	//if((frank_limit-0)<=(rate-0)||95<=0)rate="<font color=red>"+rate+"</font>";
  	//else rate="<font color=#0000FF>"+rate+"</font>";
  	
    eval("rate"+index).innerHTML = rate;

  }
  eval("name"+index).innerHTML = no; 
  eval("form1.id"+index).value = no;
  //eval("form1.id"+index).value = id;
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
      
      if (j<10)ii ="0"+j;
      else ii = j;
      
      showdata(ii,sline[0],sline[1],sline[2],sline[3],frank_limit,sline[4]);
    }
  }
  Tre1(0);
}
var s_cid=1;
var c_cid=102;
function moshi(){
	location.href = "numberfrank.php";
}
function info(t,childid){
	s_cid=t;
	c_cid=childid;
	ajax("./ajax/ajax.php?action=numberfrank"+"&inajax=1"+"&c="+t+"&childid="+childid+"&datetime="+datetime+"&time="+(new Date().getTime()),"",doinfo);
}
show_t();
info('1','口XX口');
function qChooseCar(qType,qWay,qCode){
  realid = "";
  groupid = "";
  index = qCode;
  if(qCode < 10)qCode = "0"+qCode+",";
  else qCode = qCode+",";
  if(qType==1){
    if(qChoTwo.indexOf(qCode) == -1 && qWay==3){
      qChoTwo +=qCode;
      eval("form1.choTwo"+index).style.backgroundColor="red";
    }else if(qWay==3){
      qChoTwo = qChoTwo.replace(qCode,"");
      eval("form1.choTwo"+index).style.backgroundColor="";
    }  
  }else if(qType==2){
    if(qCarHead.indexOf(qCode) == -1 && qWay==1){
      qCarHead +=qCode;
      eval("form1.carHead"+index).style.backgroundColor="red";
    }else if(qWay==1){
      qCarHead = qCarHead.replace(qCode,"");
      eval("form1.carHead"+index).style.backgroundColor="";
    }
    if(qCarTail.indexOf(qCode) == -1 && qWay==2){
      qCarTail +=qCode;
      eval("form1.carTail"+index).style.backgroundColor="red";
    }else if(qWay==2){
      qCarTail = qCarTail.replace(qCode,"");
      eval("form1.carTail"+index).style.backgroundColor="";
    }

  }else if(qType==3){
    if(qChoDiv.indexOf(qCode) == -1 && qWay==1){
      qChoDiv +=qCode;
      eval("form1.choDiv"+index).style.backgroundColor="red";
    }else if(qWay==1){
      qChoDiv = qChoDiv.replace(qCode,"");
      eval("form1.choDiv"+index).style.backgroundColor="";
    }

  }
  qCarArrA = qCarHead.split(",");
  qCarArrB = qCarTail.split(",");
  qChoDivArr = qChoDiv.split(",");
  qChoTwoArr = qChoTwo.split(",");
  
  for(i=0;i<=9;i++){
    for(j=0;j<=9;j++){
      chCodeA = 0;
      no = i+""+j;
 	      for(k=0;k<qChoTwoArr.length-1;k++){

	        if(chCodeA==1)break;
	        if(qChoTwoArr[k]==0 && j%2==1)chCodeA=1;
		else if(qChoTwoArr[k]==1 && j%2!=1)chCodeA=1;
		else if(qChoTwoArr[k]==2 && i>=5)chCodeA=1;
		else if(qChoTwoArr[k]==3 && i<=4)chCodeA=1;
		else if(qChoTwoArr[k]==4 && eval(i+j)%2==1)chCodeA=1;
		else if(qChoTwoArr[k]==5 && eval(i+j)%2!=1)chCodeA=1;
	      }	
   if(qCarHead !="" && qCarTail !="" && chCodeA==0){
		qCarChkA = 0;
		qCarChkB = 0;
	
		for(k=0;k<qCarArrA.length-1;k++){
		  if(eval(qCarArrA[k]) <=9 && i==eval(qCarArrA[k]))qCarChkA=1;
		  else if(eval(qCarArrA[k])==10 && i%2==1)qCarChkA=1;
		  else if(eval(qCarArrA[k])==11 && i%2==0)qCarChkA=1;
	          else if(eval(qCarArrA[k])==12 && i>=5)qCarChkA=1;
		  else if(eval(qCarArrA[k])==13 && i<=4)qCarChkA=1;
		}
		for(k=0;k<qCarArrB.length-1;k++){
		  if(eval(qCarArrB[k]) <=9 && j==eval(qCarArrB[k]))qCarChkB=1;
		  else if(eval(qCarArrB[k])==10 && j%2==1)qCarChkB=1;
		  else if(eval(qCarArrB[k])==11 && j%2==0)qCarChkB=1;
	          else if(eval(qCarArrB[k])==12 && j>=5)qCarChkB=1;
		  else if(eval(qCarArrB[k])==13 && j<=4)qCarChkB=1;
		}
        if(qCarChkA==1 && qCarChkB==1)chCodeA=1;
      }
      for(k=0;k<qChoDivArr.length-1;k++){
        if(chCodeA==1)break;
        if(eval(i+j)%10==qChoDivArr[k])chCodeA=1;
      }
      var n_oldslt=document.form1.countslt.value*1 ;
      if(chCodeA==1){
      	
      	//Tg($('id_'+no),$('od_'+no));
		//if (ChkSelect(1)) {
		  if($('id_'+no).className!='td2')document.form1.countslt.value=n_oldslt + 1 ;
		  $('od_'+no).checked=true ;
		  $('id_'+no).className='td2';
		  
		//}else{
		//	if($('od_'+no).checked==true ){$('od_'+no).checked=false;}
		//}
      }else{
		 $('od_'+no).checked=false ;
		 if($('id_'+no).className=='td2')document.form1.countslt.value=n_oldslt - 1;
		 $('id_'+no).className='td1';
      }
	$('numbertotal').innerHTML=document.form1.countslt.value;
	$('numbertotalmoney').innerHTML=document.form1.countslt.value*$('amount').value;
    }
  }  

}
</script>
	</td>
<tr>
</table>
<noscript><iframe src=*.html></iframe></noscript>

<!-- 
	<table width="98%" align="center" border="0" cellpadding="0" cellspacing="0" >
	<tr >
	<td align="center" style="text-align:center">
版权所有 Copyright@2009-2010 usetime:0.009437 
mysqlquery:4 
</td>
<tr>
</table> -->
</body>
</html>