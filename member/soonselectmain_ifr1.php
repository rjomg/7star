<?php 
include_once ('../global.php');
$db = new action($mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset); //数据库操作类.
$uid = $_SESSION['uid'.$c_p_seesion];	
if($uid){
$info = mysql_fetch_array(mysql_query("select * from users  where user_id = '$uid'"));	 
$issueno = mysql_fetch_array(mysql_query("select plate_num from orders order by plate_num DESC limit 1"));
}
?>
<!-- saved from url=(0043)http://89955899.com/soonselectmain_ifr1.php -->
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><script>var _cachehot = null;var _cacheuser = {'5':{'f':'9730.000','s':0.005,'s0':null,'o':'20'},'6':{'f':'9.980/16.980','s':0.005,'s0':null,'o':'1000'},'7':{'f':'47.400/80.900/129.800','s':0.005,'s0':null,'o':'500'},'8':{'f':'99.100','s':0.005,'s0':null,'o':'500'},'97':{'f':'99.100','s':0.005,'s0':null,'o':'500'},'98':{'f':'99.100','s':0.005,'s0':null,'o':'500'},'99':{'f':'99.100','s':0.005,'s0':null,'o':'500'},'100':{'f':'99.100','s':0.005,'s0':null,'o':'500'},'101':{'f':'99.100','s':0.005,'s0':null,'o':'500'},'102':{'f':'99.100','s':0.005,'s0':null,'o':'500'},'103':{'f':'978.000','s':0.005,'s0':null,'o':'50'},'104':{'f':'978.000','s':0.005,'s0':null,'o':'50'},'105':{'f':'978.000','s':0.005,'s0':null,'o':'50'},'106':{'f':'978.000','s':0.005,'s0':null,'o':'50'},'107':{'f':'379.200/758.400/1366.800/379.2','s':0.005,'s0':null,'o':'100'}};var _cacheclass = {'1':{'id':'1','parentid':'0','classname':'二定位','money_least':'1'},'4':{'id':'4','parentid':'0','classname':'三定位','money_least':'0.5'},'5':{'id':'5','parentid':'0','classname':'四定位','money_least':'0.1'},'6':{'id':'6','parentid':'0','classname':'二字现','money_least':'1'},'7':{'id':'7','parentid':'0','classname':'三字现','money_least':'1'},'8':{'id':'8','parentid':'0','classname':'XXX囗囗(45位)','money_least':'1'},'97':{'id':'97','parentid':'1','classname':'XX口口','money_least':'1'},'98':{'id':'98','parentid':'1','classname':'X口X口','money_least':'1'},'99':{'id':'99','parentid':'1','classname':'X口口X','money_least':'1'},'100':{'id':'100','parentid':'1','classname':'口XX口','money_least':'1'},'101':{'id':'101','parentid':'1','classname':'口X口X','money_least':'1'},'102':{'id':'102','parentid':'1','classname':'口口XX','money_least':'1'},'103':{'id':'103','parentid':'4','classname':'X口口口','money_least':'0.5'},'104':{'id':'104','parentid':'4','classname':'口X口口','money_least':'0.5'},'105':{'id':'105','parentid':'4','classname':'口口X口','money_least':'0.5'},'106':{'id':'106','parentid':'4','classname':'口口口X','money_least':'0.5'},'107':{'id':'107','parentid':'0','classname':'四字现','money_least':'1'},'601':{'id':'601','parentid':'6','classname':'二字现','money_least':'1'},'602':{'id':'602','parentid':'6','classname':'二字现','money_least':'1'},'701':{'id':'701','parentid':'7','classname':'三字现','money_least':'1'},'702':{'id':'702','parentid':'7','classname':'三字现','money_least':'1'},'703':{'id':'703','parentid':'7','classname':'三字现','money_least':'1'},'1071':{'id':'1071','parentid':'107','classname':'四字现','money_least':'1'},'1072':{'id':'1072','parentid':'107','classname':'四字现','money_least':'1'},'1073':{'id':'1073','parentid':'107','classname':'四字现','money_least':'1'},'1074':{'id':'1074','parentid':'107','classname':'四字现','money_least':'1'}};</script> 
<title>soonselectmain_ifr1</title>
<link rel="stylesheet" type="text/css" id="css" href="css/members.css">
<style>html{overflow-y:scroll;overflow-x:hidden;}</style>
<script src="./js/common.js" type="text/javascript"></script>
<script src="./js/showorderhtml.js" type="text/javascript"></script>
<script src="./js/frank.js" type="text/javascript"></script>
<script src="./js/ajax.js" type="text/javascript"></script>
<script src="./js/showdate.js" type="text/javascript"></script>
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
</style> <script src="./js/pace.min.js"></script>
<link rel="stylesheet" href="./css/pace-theme-loading-bar.css">
<script language="JavaScript">
	var credits = <?php echo $info['credit_total'];?>;
	var credits_use = <?php echo $info['credit_total']-$info['credit_remainder'];?>;
	var credits_remaining = <?php echo $info['credit_remainder'];?>;
	var is_cash = 10000;
	var time_allow_sw = false;
	
	//check time
	function checksend(str){
		str = JSON.parse(str);
		time_beg = str['starttime'];
		time_end = str['endtime'];
		time_sys = str['systime'];
		
		time_allow_sw = (time_sys >= time_beg && time_sys <= time_end)?true:false;
	}

	function soonsend(tt){
		ajax("POST","ajax/ajax.php",false,"",checksend);
		
		if(!time_allow_sw){
			alert("已封盘，尚未开盘!!");
			return false;
		}
		var s,n_m='',allmoney;
		allmoney = Math.floor($("alltotalmoney").value);
		
		if(credits<=0){
			alert("信用额度不足，不能下注！!");
			return false;
		}else if(allmoney > credits){
			alert("信用额度不足，不能下注！");
			$('money').select();
			return false;				
		}else if(allmoney > credits_remaining){
			alert("下注额度超過可用额度，不能下注！");
			return false;
		}
		s = $("selectnumber").value;
		m = $("money").value;
		var s_arr = s.split(",");
		var get_number_award = s_arr[0];
		var get_money_award = m;
		if(frank.__CheckMoney(get_money_award,get_number_award)==false)return false;	
		if(frank.__CheckMoneyLeast(get_money_award)==false)return false;
		if(m==''|| m==0){
			alert("请填写金额！");
			$('money').select();
			return false;
		}else if(s !=""){
			//top.document.getElementById('loading').style.display = "";
			tt.disabled=true;
			n_m=s;
			/*
			datamembers.target='soonselectorder';
			*/
			document.getElementById('post_number_money').value=n_m;
			document.getElementById('post_money').value=m;
			document.getElementById('selectnumber').value='';
			document.getElementById('action').value='soonselectnumber';
			document.getElementById('doaction').value='soonselectnumber';
			selectclassid = document.getElementById('selectlogsclassid').value;
			var statsizi;
			if(selectclassid >= 4){
				statsizi = 1;
			}else{
				statsizi = 0;
			}
			var tmp_data = {}
			var send_data = {};
			for(var i in s_arr){
				tmp_data = {};
				tmp_data.id = i;
				tmp_data.number = s_arr[i];
				tmp_data.money = m;
				tmp_data.statsizi = statsizi;
				send_data[i] = tmp_data;
			}
			send_data_final = CheckBet(send_data);
			//XMLHttp.sendReq("POST","ajax.php?action=soonselect","post_number=" + encodeURIComponent(n_m) + "&post_money=" + m + "&statsizi=" + statsizi,soap_result);
            // console.log("SEND2 :"+JSON.stringify(GET_string));
            GET_string = $("getstring_hidden").value;
			ajax_for_soonselect(JSON.stringify(send_data_final),<?php echo $issueno['plate_num'];?>,GET_string);
		}else{
			alert("请在右边生成号码！");
		}
	}
	
	function ajax_for_soonselect(send_data,issueno,GET_string){
		var html='';
		var new_orders='';
		document.getElementById('soonsendsubmit').disabled = true;
		Pace.restart();
		Pace.track(function(){
			ajax("POST","ajax/ajax.php?action=soonselect",true,"send_data=" + send_data + "&issueno=" + issueno + "&get_string=" + GET_string,function(data){
				// data = JSON.parse(data);
				// new_orders=data['new_orders'];
				// html += '<table width="100%" border="0" cellspacing="0" cellpadding="0">'; 
				// html += '<tr><td style="text-align:right;font-size:15px;">单位：元</td></tr>';
				// html += '</table>';
				
				// html += '<table  align="center" width="100%" cellpadding="0" cellspacing="0" class="tablebprint4" style="margin-bottom: 2px !important;">';
				// html += '  <tr><td colspan=3 class="print2" style="text-align:center;color:red;"><b>七星彩</b></td></tr>';
				// html += '  <tr><td colspan=3 class="print3">时间:<?php echo date("y-m-d");?><br>会员:<?php echo $info["user_name"];?><br>编号:</td></tr>';
				// html += '  <tr class="print2"><td style="text-align:center;">号码</td><td style="text-align:center;">赔率</td><td style="text-align:center;">金额</td>';
				// html +=new_orders;
				// html += '<tr class="print5">    <td colspan="3">笔数0 总金额0</td>  </tr>';
				// html += '<tr>    <td align="center" style="text-align:center;" class="Noprint" colspan="3">         <input class="Noprint" type="button" value="清 空" style="height:20;width=60" onclick="ajax(&quot;POST&quot;,&quot;ajax.php?action=soonprintstat&quot;,true,&quot;strid=&quot;);location.href=&quot;left.php&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input class="Noprint" name="numprint" id="numprint" type="button" value="打 印" style="height:20;width=60" onclick="setprint()" ;=""></td>     </tr>';

				// window.parent.parent.frames["menu"].$("showorderhtml").innerHTML=html;
				// alert('下注成功');
				data_menu = eval('('+data['menu']+')');
				iniPage(0,data_menu,parent.parent.menu);
				if(is_cash == 1){
					parent.parent.menu.document.getElementById('cash_credit').innerHTML = Math.round(data['cash_credit']*1000)/1000;
					credits = Math.round(data['cash_credit']*1000)/1000;
					credits_remaining = Math.round(data['cash_credit']*1000)/1000;
				}else{

					parent.parent.menu.document.getElementById('my_rcedits').innerHTML = Math.round(data['credit']*1000)/1000;
					parent.parent.menu.document.getElementById('my_rcedits_use').innerHTML = Math.round(data['credit_used']*1000)/1000;
					parent.parent.menu.document.getElementById('my_rcedits_leavings').innerHTML = Math.round(data['credit_available']*1000)/1000;
					credits = Math.round(data['credit']*1000)/1000;
					credits_remaining = Math.round(data['credit_available']*1000)/1000;
				}
				if(data['error_text'] != ''){
					if(data['code']==500012){
						var alert_msg = data['error_text'] + '\n';
						for(var i=0;i<data['deadlock_data'].length;i++){
							alert_msg += data['deadlock_data'][i].number + ','
						}
						alert_msg += '\n(总共失败笔数:' + data['deadlock_data'].length + '笔)\n(将为按照原本的金额为您重押!!)';
						if(confirm(alert_msg)){
							deadlock_string = (GET_string.indexOf('rebet')==-1)?('rebet=1|||' + GET_string):GET_string;
							ajax_for_soonselect(JSON.stringify(data['deadlock_data']),issueno,deadlock_string);
						}else{
							document.getElementById('soonsendsubmit').disabled = false;
							parent.location.href = 'main.php';
						}
					}else{
						alert(data['error_text']);
						document.getElementById('soonsendsubmit').disabled = false;
						parent.location.href = 'main.php';
					}
				}else{
					document.getElementById('soonsendsubmit').disabled = false;
					parent.location.href = 'main.php';
				}
				/*
				if(data['success']==0 && data['failed']==0 && data['stopbet']==0){
				}else if(data['success'] > 0 && data['failed']==0 && data['stopbet']==0){
					alert('押注成功!!');
				}else if(data['success'] > 0 && data['failed']==0 && data['stopbet'] > 0){
					alert('押注成功!!停押笔数 ' + data['stopbet'] + ' 笔');
				}else if(data['failed'] > 0){
					alert('押注 - 成功笔数 ' + data['success'] + ' 笔，失败笔数 ' + data['failed'] + ' 笔');
				}
				*/
			});
			window.parent.parent.frames["menu"].location.reload();
			window.parent.parent.location.reload();
			window.parent.location.reload();
		});
	}
	
	var __delid=new Array();
	/*function _d(id){
		if($("d"+id).className!=''){
			$("d"+id).className='';
			var getdelid=new Array();
			for( i = 0 ; i < __delid.length; i++ ){
				if(__delid[i]!=id){
					getdelid[i]=__delid[i];
				}
			}
			__delid = getdelid;
		}else{
			$("d"+id).className='del';
			__delid[__delid.length]='n'+id;
		}
	}*/
	function __getHTML (total,snumber){
		//var total=__ss.__selectnumbertotal;
		//var snumber=__ss.__selectnumber;
		var row = Math.floor( total/8 );
		var rownum = total%8;
		var html = '';
		var idx = 0;
		html = ('<table cellspacing="0" cellpadding="0" class=showselectnumber border="0" style="text-align:left;width:100%"><tbody>');
		for(var i = 0; i< row; i++)
		{
			html +=("<tr><td >"+snumber[idx]+"</td>");idx++;
			html +=("<td>"+snumber[idx]+"</td>");idx++;
			html +=("<td>"+snumber[idx]+"</td>");idx++;
			html +=("<td>"+snumber[idx]+"</td>");idx++;
			html +=("<td>"+snumber[idx]+"</td>");idx++; 
			html +=("<td>"+snumber[idx]+"</td>");idx++; 
			html +=("<td>"+snumber[idx]+"</td>");idx++; 
			html +=("<td>"+snumber[idx]+"</td>");idx++; 
		}
		if(rownum>0) {
			html +=("<tr>");
			for(var i = 0; i<rownum; i++)
			{
				if(snumber[idx]) {
					html +=("<td>"+snumber[idx]+"</td>");
					idx++;
				}
			}
			html +=("</tr>");
		}
		html +=("</tbody></table>");	
		return html;	
	}
	function soondel(){
		var s,n_m='',numberstr,__selectnumbertotal=0,shownumber='';
		var __selectnumber = new Array(),numberdel='';
		s = $("selectnumber").value;
		//s = getcookie('my_selectnumber');
		var s_arr = s.split(",");
		var comm="",comm_2='';
		for (var i in s_arr )
		{
			numberstr = s_arr[i];
			if(checkdel('n'+numberstr)){
				shownumber += '<li id="d'+numberstr+'" onclick="_d(\''+numberstr+'\');">1111'+ numberstr + '</li>';
				__selectnumber[__selectnumbertotal]=numberstr;
				__selectnumbertotal++;
			}else{
				numberdel += comm_2+""+s_arr[i];
				comm_2=',';
			}

		}

		if(numberstr!=""){
			var html=__getHTML(__selectnumbertotal,__selectnumber);
			$("showselectnumber").innerHTML=html;
			//$("showselectnumber").innerHTML=shownumber;
			$("selectnumber").value=__selectnumber;
			$("selectnumbertotal").innerHTML=__selectnumbertotal;
			$("selectnumbertotal_hidden").value=__selectnumbertotal;
			//setcookie('my_selectnumber', __selectnumber);
		}
		XMLHttp.sendReq("POST","./ajax/ajax.php?action=selectdel","post_number="+encodeURIComponent(numberdel)+"&sid=VUeuZt&inajax=1",post_selectMsg,"showorderhtml");
	}
	function checkdel(number){
		if(__delid.length<=0)return true;
		for( i = 0 ; i < __delid.length; i++ ){
			if(__delid[i]==number)return false;
		}
		return true;
	}
	function decimal(num,v)
	{
		var vv = Math.pow(10,v);
		return Math.round(num*vv)/vv;
	} 
	function FloatAdd(arg1,arg2){  
		var r1,r2,m;  
		try{r1=arg1.toString().split(".")[1].length}catch(e){r1=0}  
		try{r2=arg2.toString().split(".")[1].length}catch(e){r2=0}  
		m=Math.pow(10,Math.max(r1,r2))  
		return (arg1*m+arg2*m)/m;
	}
	var credits_use_all=credits_use;
	function totalmoney(t){
		var money = (t.value * $("selectnumbertotal_hidden").value)+"";
		//alert(money)
		if(money.indexOf(".")!=-1){
			var m = money.split(".");
			money = m[0] + "." +  m[1].slice(0,2);
			money=decimal(money,1);
		}
		$("selectnumbermoney").innerHTML=money;
		$("alltotalmoney").value=money;
		credits_use_all = FloatAdd((credits_use-0),(money-0));
	}
</script>
<!-- <title>soonselectmain_ifr1</title> -->
</head>
<body style="margin: 0px;" class=" pace-done"><div class="pace  pace-inactive"><div class="pace-progress" data-progress-text="100%" data-progress="99" style="transform: translate3d(100%, 0px, 0px);">
  <div class="pace-progress-inner"></div>
</div>
<div class="pace-activity"></div></div>
	<table width="99%" border="0" cellpadding="0" cellspacing="0" style="background: #fff;" align="center">
		<tbody>
			<tr>
				<td style="padding:0px" valign="top">
					<table width="99%" border="0" cellpadding="0" cellspacing="0" class="soon_b">
						<!--
						<form method="POST" name="datamembers" id="datamembers" target="soonselectorder" action="soonselectmain_ifr1.php?action=soonselectnumber&amp;sid=VUeuZt" style="padding:0;margin:0">
						</form>
						-->
						<input type="hidden" name="formhash" value="a604d464">
						<input type="hidden" name="selectnumber" id="selectnumber" value="">
						<input type="hidden" id="post_number_money" name="post_number_money">
						<input type="hidden" id="post_money" name="post_money">
						<input type="hidden" name="lujingstat" value="3"> 
						<input type="hidden" name="selectnumbertotal_hidden" id="selectnumbertotal_hidden" value="0">
						<input type="hidden" name="getstring_hidden" id="getstring_hidden" value="classid=3|||dingwei_qu=1|||dingwei_1=1|||dingwei_2=321|||dingwei_3=31|||dingwei_4=3132|||hefen_qu=1">
						<input type="hidden" name="alltotalmoney" id="alltotalmoney" value="18">
						<input type="hidden" name="selectlogs" id="selectlogs" value="0,1,1,321,31,3132,|0,1,0,0,0,0,,0,0,0,0,,0,0,0,0,,0,0,0,0,,|0,0,,|,,|,,,||0,0,,,|0,0,|0,0,|0,0,|0,0,|0,0,|0,0,|0,0,|0,0,,,,|0,0,0,0,0,0,|0,0,0,0,0,0,|||">
						<input type="hidden" name="selectlogsclassid" id="selectlogsclassid" value="1">
						<input type="hidden" id="action" name="action">
						<input type="hidden" id="doaction" name="doaction">
						<tbody>
							<tr class="header_left_b">
								<td style="font-size:16px;font-family:Microsoft JhengHei;">生成号码框</td>
							</tr>
							<tr>
								<td style="height:240px" class="center" align="center" valign="top">
									<div id="showselectnumber"></div>
								</td>
							</tr>
						</tbody>
					</table><br>
					<table width="99%" border="0" cellpadding="0" cellspacing="0" class="left_b">
						<tbody>
							<tr class="header_left_b">
								<td colspan="4" style="font-size:16px;font-family:Microsoft JhengHei;">发送框 <input type="checkbox" style="display:none" id="sizixian" name="sizixian"></td>
							</tr>
							<tr>
								<td width="40" class="number_web" style="font-size:16px;font-family:Microsoft JhengHei;">金额</td>
								<td width="60"><input type="text" name="money" id="money" class="money_count money_1" maxlength="8" onkeyup="totalmoney(this);" onkeydown="if(event.keyCode==13){javascript:if(window.confirm(&#39;\n现在已用是“&#39;+credits_use+&#39;”，下注后已用应是“&#39;+credits_use_all+&#39;”。\n\n下注完成后请在会员信息里再次核对已用信用度！\n\n如果（已用）信用度不相符。\n\n请先进入（快选）检查是否有发送中断号码。\n\n如果有，请输入金额继续下注。\n\n如果没有，请检查是否有（目前停押号码）。\n\n请认真检查。\n\n&#39;)){soonsend(this);return false;}else return;}"></td>
								<td width="45">
									<input type="button" id="soonsendsubmit" name="soonsendsubmit" class="number_w" value="下注" style=" MARGIN-right: 0px; " onclick="javascript:if(window.confirm(&#39;\n现在已用是“&#39;+credits_use+&#39;”，下注后已用应是“&#39;+credits_use_all+&#39;”。\n\n下注完成后请在会员信息里再次核对已用信用度！\n\n如果（已用）信用度不相符。\n\n请先进入（快选）检查是否有发送中断号码。\n\n如果有，请输入金额继续下注。\n\n如果没有，请检查是否有（目前停押号码）。\n\n请认真检查。\n\n&#39;)){soonsend(this);return false;}else return;">
									<!--<button TYPE="button" style=" MARGIN-right: 0px; " id="soondelsubmit" name="soondelsubmit" class="number_w" onclick="soondel();return false;">删除</button>-->
								</td>
								<td width="*" style="font-size:16px;font-family:Microsoft JhengHei;">
									笔数:<span id="selectnumbertotal">0</span><br>金额:<span id="selectnumbermoney">0</span>
								</td>
							</tr>
						</tbody>
					</table>
					<!-- onkeypress="if(event.keyCode==13){Javascript:soonsend();return false;}"  -->
					<script language="JavaScript">
					<!--
						soondel();
								//-->
					</script>
				</td>
			</tr>
			<tr>
			</tr>
		</tbody>
	</table>
<noscript>&amp;amp;lt;iframe src=*.html&amp;amp;gt;&amp;amp;lt;/iframe&amp;amp;gt;</noscript>
</body></html>