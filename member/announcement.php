<?php
include_once ('../global.php');
$db = new plate($mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset); //���ݿ������.



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
<body oncontextmenu="return false" onselect="document.selection.empty()" oncopy="document.selection.empty()" onmouseover="self.status='�gӭ���R';return true">
<link href="images/Index.css" rel="stylesheet" type="text/css">
 <script language="JavaScript">
function send_request(url){//��ʼ����ָ��̎�������l��Ո��ĺ���
    http_request=false;
    //�_ʼ��ʼ��XMLHttpRequest����
    if(window.XMLHttpRequest){//Mozilla�g�[��
     http_request=new XMLHttpRequest();
     if(http_request.overrideMimeType){//�O��MIMEe
       http_request.overrideMimeType("text/xml");
     }
    }
    else if(window.ActiveXObject){//IE�g�[��
     try{
      http_request=new ActiveXObject("Msxml2.XMLHttp");
     }catch(e){
      try{
      http_request=new ActiveXobject("Microsoft.XMLHttp");
      }catch(e){}
     }
    }
    if(!http_request){//����������������ʧ��
     window.alert("����XMLHttp����ʧ����");
     return false;
    }
    http_request.onreadystatechange=processrequest;
    //�_���l��Ո��ʽ��URL�����Ƿ�ͬ�������¶δ���
    http_request.open("GET",url,true);
    http_request.send(null);
  }
  //̎������Ϣ�ĺ���
  function processrequest(){
   if(http_request.readyState==4){//�Д������B
     if(http_request.status==200){//��Ϣ�ѳɹ����أ��_ʼ̎����Ϣ
	 
      document.getElementById(reobj).innerHTML=http_request.responseText;
	  
     }
     else{//��治����
      alert("����Ո�����治������");
     }
   }
  }
  function dopage(obj,url){
  // document.getElementById(obj).innerHTML="�����xȡ����...";
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
                        <td class="F_bold" width="32%">վ����Ϣ</td>
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
            <td align="center" height="50"><!-- �_ʼ  --><div id="result">              <table class="t_list" border="0" cellpadding="0" cellspacing="1" width="100%">
                <tbody><tr>
                  <td class="t_list_caption">�N���r�g</td>
                  <td class="t_list_caption">��ϢԔ��</td>
                </tr>
                <tr style="" class="t_list_tr_0" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor=''">
                  <td class="F_bold">��˾Ҏ�t</td>
                  <td align="left"><table style="TABLE-LAYOUT: fixed" border="0" cellpadding="0" cellspacing="0" width="800">
                      <tbody><tr>
                        <td style="word-wrap:break-word;white-Space:AD_Info;" class="F_bold"><ad_info><br>
                              <br>
                          �������뱾��˾�ɞ����ӕr�����������˽⼰��ı���˾�����Зl�������ڱ���˾�Wվ�_���ĵ�һ���¾��r���ʹ�������ͬ�⼰�������б���˾��<a href="javascript:void(0)" onClick="document.getElementById('Rele_Div').style.display='block';" class="font_R">��Ҏ�t���l����</a>��<br>
                          <br>
                          <div id="Rele_Div" style="display: none;position:absolute; background-color: #ffffa2"> 1��ʹ�ñ���˾�Wվ�ĸ��ɖ|�ʹ����̣�Ո�����w�����ڵć��һ��ס�ص����P����Ҏ���������Ɇ��������P���}�����󮔵ط�����Ҋ��<br>
                  <br>
                            2�����l�����������Ɖ��О�򲻿ɿ���֮�ĺ����¾Wվ���ϻ��Y�ϓp�ġ��Y�ρGʧ����r���҂����Ա���˾֮����Y�Ϟ�����̎��������<br>
                            <br>
                            3���_���yӋ���Y��ֻ�������������ǌ��͑�������ָ��������˾Ҳ�������P춽yӋ�����a���e�`����������PͶ�V��<br>
                            <br>
                            4�����H�W·�������ٶȁK�Ǳ���˾���ܿ��ƣ�����˾Ҳ�������P춾W·��������PͶ�V��<br>
                            <br>
                            5����춂S�y�����漰�߶˵ļ��gҪ����������ܿ��Ƶ��������ƣ���˂S�y���ȶ��ԣ����m�ԕ��Еr�ܵ�Ӱ푣�����˾Ҳ���е��ɴ˶��a���ēpʧ��<br>
                            <br>
                            6�����ɖ|�ʹ����̱�������¾��������~�ȣ���ĳ�N������r�£�����֮�����~���ܕ����F͸֧��<br>
                            <br>
                            7������˾����һ���ЛQ���]���κ������Է�������ʽ���]�]��֮���������M���{�����g��ֹͣ�l���c�����P֮�κβʽ�<br>
                            <br>
                            8���͑���؟�δ_���Լ��Ď���������İ�ȫ������͑������Լ����Y�ϱ��I�ã�������֪ͨ����˾���K횸����䂀��Ԕ���Y�ϡ����б��I�Î�̖֮�pʧ���ɿ͑�����ؓ؟��<br>
                            <br>
                            
9������˾�������κ������κ�����Ҫ���]�N���T���]���]��������Փԓ�]���Ƿ������_���Y�������Ǹ��]�������ڂS�y���ִ������Ϊ������ɳ��F���ʴ�����]
�����������ʴ��󡱃H����춣�(1)�oՓ���F�κ��_���Y�������T�M�е��Ŀ��ע���]��������o���@������ 
(2)�oՓ���F�κ��_���Y�������T��ͬһ�r�g����M�ж��Ŀ���]�Ŀ�������ܫ@����<br>
                            <br>
                            10����Ҏ�t���l���Ľ��͙༰�޸ę��w����˾���С�<br>
                            <br>
                            <br>
��������������������������������������������������������������������������������������������
���߲����                " ����<br>
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
              </div> <!-- �Y��  --></td>
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