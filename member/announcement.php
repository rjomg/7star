<?php
include_once ('../global.php');
$db = new plate($mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset); //数据库操作类.



$query = "select * from system_marquee where type=0 ";

	
			$result_all = mysql_query($query);
			$total = mysql_num_rows($result_all);
			pageft($total, 10);
			if ($firstcount < 0) $firstcount = 0;
			
			$result = mysql_query("$query order by datetime desc limit  $firstcount, $displaypg");


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
<link href="images/Index.css" rel="stylesheet" type="text/css">
 <script language="JavaScript">
function send_request(url){//初始化，指定處理函数，發送請求的函数
    http_request=false;
    //開始初始化XMLHttpRequest對象
    if(window.XMLHttpRequest){//Mozilla瀏覽器
     http_request=new XMLHttpRequest();
     if(http_request.overrideMimeType){//設置MIME類別
       http_request.overrideMimeType("text/xml");
     }
    }
    else if(window.ActiveXObject){//IE瀏覽器
     try{
      http_request=new ActiveXObject("Msxml2.XMLHttp");
     }catch(e){
      try{
      http_request=new ActiveXobject("Microsoft.XMLHttp");
      }catch(e){}
     }
    }
    if(!http_request){//異常，創建對象實例失敗
     window.alert("創建XMLHttp對象失敗！");
     return false;
    }
    http_request.onreadystatechange=processrequest;
    //確定發送請求方式，URL，及是否同步執行下段代码
    http_request.open("GET",url,true);
    http_request.send(null);
  }
  //處理返回信息的函数
  function processrequest(){
   if(http_request.readyState==4){//判斷對象狀態
     if(http_request.status==200){//信息已成功返回，開始處理信息
	 
      document.getElementById(reobj).innerHTML=http_request.responseText;
	  
     }
     else{//頁面不正常
      alert("您所請求的頁面不正常！");
     }
   }
  }
  function dopage(obj,url){
  // document.getElementById(obj).innerHTML="正在讀取数據...";
   send_request(url);
   reobj=obj;
   } 
   
 function C_Key(){
	var key=document.all.key.value;
	dopage('result','?spul=DmgAXFE9UTwCCghrAiEIaQ!888!888&key='+key+'&page=1');
}

</script>

 <style type="text/css">
<!--
.STYLE1 {color: #CCCCCC}
-->
 </style>
 <table border="0" cellpadding="0" cellspacing="0" width="100%">
  <tbody>
    <tr>
      <td background="images/tab_05.gif" height="30"><table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tbody>
          <tr>
            <td height="30" width="12"><img src="images/tab_03.gif" height="30" width="12"></td>
            <td><table border="0" cellpadding="0" cellspacing="0" width="100%">
              <tbody>
                <tr>
                  <td valign="middle" width="87%"><table border="0" cellpadding="0" cellspacing="0" width="100%">
                    <tbody>
                      <tr>
                        <td width="1%"><div align="center"><img src="images/tb.gif" height="16" width="16"></div></td>
                        <td class="F_bold" width="32%">站内信息</td>
                        <td class="F_bold" width="67%"></td>
                      </tr>
                    </tbody>
                  </table></td>
                  </tr>
              </tbody>
            </table></td>
            <td width="16"><img src="images/tab_07.gif" height="30" width="16"></td>
          </tr>
        </tbody>
      </table></td>
    </tr>
    <tr>
      <td><table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tbody>
          <tr>
            <td background="images/tab_12.gif" width="8">&nbsp;</td>
            <td align="center" height="50"><!-- 開始  --><div id="result">              <table class="t_list" border="0" cellpadding="0" cellspacing="1" width="100%">
                <tbody><tr>
                  <td class="t_list_caption">貼出時間</td>
                  <td class="t_list_caption">消息詳情</td>
                </tr>
                <tr style="" class="t_list_tr_0" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor=''">
                  <td class="F_bold">公司規則</td>
                  <td align="left"><table style="TABLE-LAYOUT: fixed" border="0" cellpadding="0" cellspacing="0" width="800">
                      <tbody><tr>
                        <td style="word-wrap:break-word;white-Space:AD_Info;" class="F_bold"><ad_info><br>
                              <br>
                          當您加入本公司成為管理層時，您必須清楚了解及遵從本公司的所有條例。您在本公司網站開出的第一個下線時，就代表您已同意及接受所有本公司的<a href="javascript:void(0)" onClick="document.getElementById('Rele_Div').style.display='block';" class="font_R">《規則及條例》</a>。<br>
                          <br>
                          <div id="Rele_Div" style="display: none;position:absolute; background-color: #ffffa2"> 1、使用本公司網站的各股東和代理商，請留意閣下所在的國家或居住地的相關法律規定，如有疑問應就相關問題，尋求當地法律意見。<br>
                  <br>
                            2、若發生遭駭客入侵破壞行為或不可抗拒之災害導致網站故障或資料損壞、資料丟失等情況，我們將以本公司之後備資料為最後處理依據。<br>
                            <br>
                            3、開獎統計等資料只供參考，并非是對客戶操作的指引，本公司也不接受關於統計数據產生錯誤而引起的相關投訴。<br>
                            <br>
                            4、國際網路的连接速度並非本公司所能控制，本公司也不接受關於網路引起的相關投訴。<br>
                            <br>
                            5、由於係統服務涉及高端的技術要求及外圍所不能控制的因素限制，因此係統的稳定性，连續性會有時受到影響，本公司也不承担由此而產生的損失。<br>
                            <br>
                            6、各股東和代理商必須留意下線的信用額度，在某種特殊情況下，下线之信用額可能會出現透支。<br>
                            <br>
                            7、本公司擁有一切判決及註消任何涉嫌以非正常方式下註註单之權利，在進行調查期間將停止發放與其有關之任何彩金。<br>
                            <br>
                            8、客戶有責任確保自己的帳戶及密码的安全，如果客戶懷疑自己的資料被盜用，應立即通知本公司，並須更改其個人詳細資料。所有被盜用帳號之損失將由客戶自行負責。<br>
                            <br>
                            
9、本公司不接受任何人以任何理由要求註銷會員下註的註单，而不論該註单是否已有開獎結果，除非该註单是由于係統出现错误或人为操作造成出現赔率错误的註
单，而“赔率错误”僅定义於：(1)無論出現任何開獎結果，會員進行单項目下注的註单结果都無法獲利，或 
(2)無論出現任何開獎結果，會員在同一時間如果進行多項目下註的總结果都能獲利。<br>
                            <br>
                            10，本規則及條例的解释權及修改權歸本公司所有。<br>
                            <br>
                            <br>
　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　
“高层管理                " 敬啟<br>
                          </div>
                          <br>
                        </ad_info></td>
                      </tr>
                  </tbody></table></td>
                </tr>
                
                <?php while ($row = mysql_fetch_array($result)) { ?>
                <tr style="" class="t_list_tr_0" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor=''">
                  <td><?php echo date("Y-m-d H:i:s", $row['datetime']); ?></td>
                  <td align="left">
                  <table style="TABLE-LAYOUT: fixed" border="0" cellpadding="2" cellspacing="2" width="800">
                      <tbody>
                      <tr>
                        <td style="word-wrap:break-word;white-Space:AD_Info;" align="left">
                        <ad_info>
                            <?php echo $row['content']; ?>                     
                         </ad_info>
                        </td>
                      </tr>
                  </tbody>
                  </table>
                  </td>
                </tr>
                
                   <?php
						}
					  ?>  
                  </tbody>
                  </table>
              </div> <!-- 結束  --></td>
            <td background="images/tab_15.gif" width="8">&nbsp;</td>
          </tr>
        </tbody>
      </table></td>
    </tr>
    <tr>
      <td background="images/tab_19.gif" height="35"><table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tbody>
          <tr>
            <td height="35" width="12"><img src="images/tab_18.gif" height="35" width="12"></td>
            <td valign="top"><table border="0" cellpadding="0" cellspacing="0" height="30" width="100%">
              <tbody>
                <tr>
                  <td align="center">&nbsp;<?php echo $pagenav;?></td>
                </tr>
              </tbody>
            </table></td>
            <td width="16"><img src="images/tab_20.gif" height="35" width="16"></td>
          </tr>
        </tbody>
      </table></td>
    </tr>
  </tbody>
</table>

</body></html>