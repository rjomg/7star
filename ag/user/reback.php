<?php
include_once( "../../global.php" );
$user_id = $_GET['user_id'];
$power = $_GET['power'];
$db = new action( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
$db2 = new mysql( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
$sql = $db->select( "users", "user_name,top_id", "user_id={$user_id}" );
$user = $db->fetch_array( $sql );
$power_char = $db->get_user_power_char( $power );
$is_plate_starts = $db->is_plate_starts( );
echo "<html oncontextmenu=\"return false\" xmlns=\"http://www.w3.org/1999/xhtml\">\n<head>\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=gbk\">\n    ";
echo "<s";
echo "tyle type=\"text/css\">\n<!--\n.t11 {\nbackground-color: #219CBD;\n}\n.fw12 {\nfont-size: 12px;\ncolor: #ffffff;\n}\n-->\n</style>    \n</head>\n\n<body  onselect=\"document.selection.empty()\" oncopy=\"document.selection.empty()\" onmouseover=\"self.status='�gӭ���R';return true\">\n";
echo "<s";
echo "cript src=\"../js/jquery-1.4.3.min.js?i=0\" type=\"text/javascript\"></script>\n";
echo "<s";
echo "cript src=\"js/normal.js?i=1\" type=\"text/javascript\"></script>\n";
?>
<script language="JavaScript">
function quanxuan(){
    var cao = $("input[type='checkbox']");
    for(var i=0;i<20;i++){
        cao.eq(i).attr("checked",false);
    }
}

function doObjValue(obj,tuishui){
	var oldValue = obj.val();
	var value = Number(oldValue) + Number(tuishui);
	value = value.toFixed(2);
	if(value>0){
		obj.val(value);
	}
}

//��ˮ���ýű�

function go_select2(flag){
    
var pan = $("#tpan").val();//����ѡ������
   
 var typea = $("input:checked");//��ѡ��
   
  var tuishui = $("#jjh").val();//��ˮ
  if(tuishui==""||isNaN(tuishui)||Number(tuishui)<=0) return false;
  tuishui = tuishui*flag;
 
 
    var th;
    var tdtext;
  
	var cao = $("input[type='checkbox']");
 
	if(typea.val()==1){
		  if(pan == "all"){  
		  		$(".t_list_tr_1").each(function(index, element) {
                    doObjValue($(this).next().children("input"),tuishui);//a
				   doObjValue($(this).next().next().children("input"),tuishui);//b
				   doObjValue($(this).next().next().next().children("input"),tuishui);//c
				   doObjValue($(this).next().next().next().next().children("input"),tuishui);//d
                });
 			   
          }else if(pan == "A"){
			  $(".t_list_tr_1").each(function(index, element) {
               doObjValue($(this).next().children("input"),tuishui);//a
			  });
          }else if(pan == "B"){
			  $(".t_list_tr_1").each(function(index, element) {
               doObjValue($(this).next().next().children("input"),tuishui);//b
			  });
          }else if(pan == "C"){
			  $(".t_list_tr_1").each(function(index, element) {
               doObjValue($(this).next().next().next().children("input"),tuishui);//c
			  });
          }else if(pan == "D"){
			  $(".t_list_tr_1").each(function(index, element) {
               doObjValue($(this).next().next().next().next().children("input"),tuishui);//d
			  });
          }
   }
    if( cao.eq(0).attr("checked")==false && cao.eq(1).attr("checked")==false && cao.eq(2).attr("checked")==false && cao.eq(3).attr("checked")==false  && cao.eq(4).attr("checked")==false && cao.eq(5).attr("checked")==false && cao.eq(6).attr("checked")==false && cao.eq(7).attr("checked")==false && cao.eq(8).attr("checked")==false && cao.eq(9).attr("checked")==false && cao.eq(10).attr("checked")==false && cao.eq(11).attr("checked")==false && cao.eq(12).attr("checked")==false && cao.eq(13).attr("checked")==false && cao.eq(14).attr("checked")==false && cao.eq(15).attr("checked")==false && cao.eq(16).attr("checked")==false && cao.eq(17).attr("checked")==false){
        if(cao.eq(18).attr("checked")==true){
			$(".t_list_tr_1").each(function(index, element) {
            doObjValue($(this).next().next().next().next().next().children("input"),tuishui);//c
			});
        }
        if(cao.eq(19).attr("checked")==true){
			$(".t_list_tr_1").each(function(index, element) {
            doObjValue($(this).next().next().next().next().next().next().children("input"),tuishui);//c
			});
        }
        if(cao.eq(20).attr("checked")==true){
			$(".t_list_tr_1").each(function(index, element) {
            doObjValue($(this).next().next().next().next().next().next().next().children("input"),tuishui);//c
			});
        }
    }else{
    $(".t_list_tr_1").each(function(){ 
        th = $(this);
        tdtext = th.text();
        tdtext = tdtext.replace(/\s/gi,'');
        //alert(tdtext);
        var i = 0,typevalue,is;
        typea.each(function(){ 
            is = -1;
            typevalue = typea.eq(i).val(); 
            is = typevalue.indexOf(tdtext); //alert(is);
            if(is != -1){ 
                if(cao.eq(18).attr("checked")==true){
                    doObjValue(th.next().next().next().next().next().children("input"),tuishui);//c
                }
                if(cao.eq(19).attr("checked")==true){
                    doObjValue(th.next().next().next().next().next().next().children("input"),tuishui);//c
                }
                if(cao.eq(20).attr("checked")==true){
                    doObjValue(th.next().next().next().next().next().next().next().children("input"),tuishui);//c
                }
                if( cao.eq(18).attr("checked")==false && cao.eq(19).attr("checked")==false && cao.eq(20).attr("checked")==false){
                      if(pan == "all"){  
                          doObjValue(th.next().children("input"),tuishui);//a
                          doObjValue(th.next().next().children("input"),tuishui);//b
                          doObjValue(th.next().next().next().children("input"),tuishui);//c
                          doObjValue(th.next().next().next().next().children("input"),tuishui);//c
                      }else if(pan == "A"){
                          doObjValue(th.next().children("input"),tuishui);//a
                      }else if(pan == "B"){
                          doObjValue(th.next().next().children("input"),tuishui);//b
                      }else if(pan == "C"){
                          doObjValue(th.next().next().next().children("input"),tuishui);//c
                      }else if(pan == "D"){
                          doObjValue(th.next().next().next().next().children("input"),tuishui);//c
                      }
                }
            }
            i++;
        });
    });
    }
}

</script>
<?php
echo "\n<link href=\"../images/Index.css\" rel=\"styleshee";
echo "t\" type=\"text/css\">\n<div id=\"ly\" style=\"position: absolute; top: 0px; background-color: rgb(255, 255, 255); z-index: 2; left: 0px; display: block; width: 1337px; height: 513px;\"> \n  <!--[if lte IE 6.5]><iframe></iframe><![endif]--> \n</div>\n<!--          ���ӿ���_ʼ         -->\n<div id=\"rs_window\" style=\"position: absolute; top: 25px; z-index: 2000; left: 277px; display: block;\">\n    \n      <form action=\"u";
echo "pdate_back_set.php\" method=\"post\" name=\"testFrm\" id=\"testFrm\" onsubmit=\"return SubChkds()\">\n          <input type=\"hidden\" value=\"";
echo $user_id;
echo "\" name=\"user_id\" />\n          <input type=\"hidden\" value=\"";
echo $power;
echo "\" name=\"power\" />\n  <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"900\">\n    <tbody>\n    \n   \n    <tr>\n      <td background=\"../images/tab_05.gif\" height=\"30\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n          <tbody>\n            <tr>\n              <td height=\"30\" width=\"12\"><img src=\"../images/tab_03.gif\" height=\"30\" width=\"12\"></td>\n              <td><table border=\"0\" cellpa";
echo "dding=\"0\" cellspacing=\"0\" width=\"100%\">\n                  <tbody>\n                    <tr>\n                      <td valign=\"middle\" width=\"87%\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n                          <tbody>\n                            <tr>\n                              <td width=\"1%\"><div align=\"center\"><img src=\"../images/tb.gif\" height=\"16\" width=\"16\"></div></td>\n       ";
echo "                       <td class=\"F_bold\" width=\"99%\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n                                  <tbody>\n                                    <tr>\n                                      <td valign=\"middle\" width=\"30%\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n                                          <tbody>\n                      ";
echo "                      <tr>\n                                              <td class=\"F_bold\" align=\"left\" width=\"99%\">&nbsp;��ˮ�O����&gt;";
echo $power_char;
echo "��";
echo "<s";
echo "pan>";
echo $user['user_name'];
echo "</span>��</td>\n                                            </tr>\n                                          </tbody>\n                                        </table></td>\n                                      <td align=\"left\" width=\"60%\">";
if ( $is_plate_starts == 0 )
{
		echo "<font color=\"red\">(*ע:��ǰ���ڿ��̣����޸���ˮ������ע������ˮ��δ�޸�ǰͳ�ơ�)</font>";
}
else
{
		echo $power_char;
		echo "���Q��";
		echo $user['user_name'];
}
echo "</td>\n                                      <td align=\"right\" width=\"10%\"><a href=\"javascript:history.back(-1)\"><img src=\"../images/icon_21x21_del.gif\" border=\"0\" height=\"16\" width=\"16\"></a></td>\n                                    </tr>\n                                  </tbody>\n                                </table></td>\n                            </tr>\n                          </tbody>\n                ";
echo "        </table></td>\n                    </tr>\n                  </tbody>\n                </table></td>\n              <td width=\"16\"><img src=\"../images/tab_07.gif\" height=\"30\" width=\"16\"></td>\n            </tr>\n          </tbody>\n        </table></td>\n    </tr>\n    <tr>\n      <td><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n          <tbody>\n            <tr>\n              <td background=\"../image";
echo "s/tab_12.gif\" width=\"8\">&nbsp;</td>\n              <td align=\"center\"><!-- ����_ʼ  -->\n<div id=\"ToolBar\">\n<table width=\"100%\" height=\"40\" border=\"0\" cellpadding=\"2\" cellspacing=\"1\" class=\"t20\">\n<tbody><tr class=\"t4\" align=\"center\">\n<td class=\"t11 fw12\" width=\"1%\">��Ŀ</td>\n<td width=\"48%\">\n <input value=\"����A\" type=\"checkbox\" />����A&nbsp;\n
<input value=\"����B\" type=\"checkbox\" />����B&nbsp;\n

 

<input value=\"��1��A,��2��A,��3��A,��4��A,��5��A,��6��A\" type=\"checkbox\" />��1-6��A&nbsp;\n    <input value=\"��1��B,��2��";
echo "B,��3��B,��4��B,��5��B,��6��B\" type=\"checkbox\" />��1-6��B&nbsp;\n  
<input value=\"����A\" type=\"checkbox\" />����A&nbsp;\n
<input value=\"����B\" type=\"checkbox\" />����B&nbsp;\n
<input value=\"����\" type=\"checkbox\" />����&nbsp;\n<br><br>
<input value=\"��ɫ\" type=\"checkbox\" />��ɫ&nbsp;\n
<input value=\"��Ф\" type=\"checkbox\" />��Ф&nbsp;\n

<input value=\"��Ф,��Ф,��Ф,��Ф,��Ф\" type=\"checkbox\" />����Ф&nbsp;\n
<input value=\"һФ\" type=\"checkbox\" />һФ&nbsp;\n
<input value=\"β��\" type=\"checkbox\" />β��&nbsp;\n
<input value=\"��Ф��\" type=\"checkbox\" />��Ф��&nbsp;\n
<input value=\"β����\" type=\"checkbox\" />β����&nbsp;\n<br><br>
<input value=\"�岻��,������,�߲���,�˲���,�Ų���,ʮ����\" type=\"checkbox\" />����&nbsp;\n   
<input value=\"�벨\" type=\"checkbox\" />�벨&nbsp;\n
<input value=\"����\" type=\"checkbox\" />����&nbsp;\n	 
<input value=\"��ȫ��,������,�ش�,��ȫ��,���ж�\" type=\"checkbox\" />����&nbsp;<br><br>\n<input  value=\"18\" type=\"checkbox\" />������ע&nbsp;\n<input  value=\"19\" type=\"checkbox\" />��";
echo "�]���~&nbsp;\n<input  value=\"20\" type=\"checkbox\" />�������~&nbsp; \n        ";
echo "<s";
echo "elect size=\"1\" name=\"tpan\" id=\"tpan\">\n\t    <option selected=\"\" value=\"all\">ȫ��</option>\n\t    <option value=\"A\">A</option>\n\t    <option value=\"B\">B</option>\n\t    <option value=\"C\">C</option>\n\t    <option value=\"D\">D</option>\n\t</select>��&nbsp;&nbsp;&nbsp;\n        \n        <input  value=\"1\" type=\"checkbox\" onchange=\"quanxuan()\" />ȫѡ(���~����)&nbsp;&nbsp;&nbsp;\n</td>\n\n<td class=\"t11 fw12\" width=\"1%\">����</td>\n<td";
echo " width=\"40%\">\n    ��ֵ��

<input id=\"jjh\" name=\"money\" class=\"input1 rate_color\" value=\" \" size=\"4\">\n



        <input onclick=\"go_select2(-1)\" name=\"button2\" class=\"button_a\" value=\"��\" type=\"button\" style=\"width:60;height:22\">\n         <input type=\"reset\" name=\"Submit2\" value=\"��ֵ��ԭ\" class=\"button_a\" style=\"width:60;height:22\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n<br><br><!--         <button onClick=\"submit()\" cla";
echo "ss=\"button_a\" style=\"width:80;height:22\" >�_�J�ύ</button>    -->\n<input class=\"btn2\" name=\"Submit\" onmouseout=\"this.className='btn2'\" onmouseover=\"this.className='btn2m'\" value=\"����\" type=\"submit\">\n</td>\n</tr>\n</tbody></table>\n</div><div id=\"result\">                \n                <table class=\"Ball_List\" bgcolor=\"f1f1f1\" border=\"0\" cellpadding=\"1\" cellspacing=\"1\" width=\"100%\">\n                  <tbody>";
echo "\n                    <tr class=\"td_caption_1\">\n                      <td align=\"center\" bgcolor=\"#EBF4DF\" height=\"22\" nowrap=\"nowrap\">�������</td>\n                      <td align=\"center\" bgcolor=\"#EBF4DF\" nowrap=\"nowrap\">A%</td>\n                      <td bordercolor=\"f1f1f1\" align=\"center\" bgcolor=\"#EBF4DF\" nowrap=\"nowrap\">%B</td>\n                      <td bordercolor=\"f1f1f1\" align=\"center\" bgcolor=\"#E";
echo "BF4DF\" nowrap=\"nowrap\">%C</td>\n                      <td bordercolor=\"f1f1f1\" align=\"center\" bgcolor=\"#EBF4DF\" nowrap=\"nowrap\">%D</td>\n                      <td bordercolor=\"f1f1f1\" align=\"center\" bgcolor=\"#EBF4DF\" nowrap=\"nowrap\">������ע</td>\n                      <td align=\"center\" bgcolor=\"#EBF4DF\" nowrap=\"nowrap\">��ע���~</td>\n                      <td align=\"center\" bgcolor=\"#EBF4DF\" nowrap=\"nowrap\">���(̖";
echo ")���~</td>\n                      <td align=\"center\" bgcolor=\"#EBF4DF\" height=\"22\" nowrap=\"nowrap\">�������</td>\n                      <td align=\"center\" bgcolor=\"#EBF4DF\" nowrap=\"nowrap\">A%</td>\n                      <td bordercolor=\"f1f1f1\" align=\"center\" bgcolor=\"#EBF4DF\" nowrap=\"nowrap\">%B</td>\n                      <td bordercolor=\"f1f1f1\" align=\"center\" bgcolor=\"#EBF4DF\" nowrap=\"nowrap\">%C</td>\n      ";
echo "                <td bordercolor=\"f1f1f1\" align=\"center\" bgcolor=\"#EBF4DF\" nowrap=\"nowrap\">%D</td>\n                      <td bordercolor=\"f1f1f1\" align=\"center\" bgcolor=\"#EBF4DF\" nowrap=\"nowrap\">������ע</td>\n                      <td align=\"center\" bgcolor=\"#EBF4DF\" nowrap=\"nowrap\">��ע�޶�</td>\n                      <td align=\"center\" bgcolor=\"#EBF4DF\" nowrap=\"nowrap\">���(̖)���~</td>\n                    </tr>\n ";
echo "                     \n";
$query = $db->select( "back_set", "*", "user_id={$user_id} order by view_order asc" );
$i = 0;
for ( ;	$i < 21;	++$i	)
{
		echo "                    <tr class=\"t_list_tr_0\" onmouseover=\"this.style.backgroundColor='#FFFFA2'\" onmouseout=\"this.style.backgroundColor=''\">\n    ";
		if ( $row = $db->fetch_array( $query ) )
		{
				echo "               \n                      <td class=\"t_list_tr_1\" align=\"center\">";
				echo $row['set_name'];
				echo "                      <input name=\"cname[]\" id=\"set_name[]\" value=\"";
				echo $row['set_name'];
				echo "\" type=\"hidden\">\n                      <td align=\"center\"><input onclick=\"istuishui(\$(this),";
				echo $db2->type_dy_backvalue( $user['top_id'], $row['set_name'], "percent_a" );
				echo ",";
				echo $power;
				echo ",";
				echo $user_id;
				echo ");return CountGoldS1(this,'blur','SP','14');\" onkeypress=\"return CheckKey11();\" onkeyup=\"return CountGoldS1(this,'keyup');\" name=\"percent_a[]\" class=\"input1\" id=\"ma[]\" value=\"";
				echo $row['percent_a'];
				echo "\" size=\"4\"></td>\n                      <td align=\"center\"><input name=\"percent_b[]\" class=\"input1\" onkeypress=\"return CheckKey11();\" onblur=\"istuishui(\$(this),";
				echo $db2->type_dy_backvalue( $user['top_id'], $row['set_name'], "percent_b" );
				echo ",";
				echo $power;
				echo ",";
				echo $user_id;
				echo ");return CountGoldS1(this,'blur','SP','14');\" onkeyup=\"return CountGoldS1(this,'keyup');\" id=\"mm[]\" value=\"";
				echo $row['percent_b'];
				echo "\" size=\"4\"></td>\n                      <td align=\"center\"><input name=\"percent_c[]\" class=\"input1\" id=\"mc[]\" onkeypress=\"return CheckKey11();\" onblur=\"istuishui(\$(this),";
				echo $db2->type_dy_backvalue( $user['top_id'], $row['set_name'], "percent_c" );
				echo ",";
				echo $power;
				echo ",";
				echo $user_id;
				echo ");return CountGoldS1(this,'blur','SP','15');\" onkeyup=\"return CountGoldS1(this,'keyup');\" value=\"";
				echo $row['percent_c'];
				echo "\" size=\"4\"></td>\n                      <td align=\"center\"><input name=\"percent_d[]\" class=\"input1\" id=\"md[]\" onkeypress=\"return CheckKey11();\" onblur=\"istuishui(\$(this),";
				echo $db2->type_dy_backvalue( $user['top_id'], $row['set_name'], "percent_d" );
				echo ",";
				echo $power;
				echo ",";
				echo $user_id;
				echo ");return CountGoldS1(this,'blur','SP','16');\" onkeyup=\"return CountGoldS1(this,'keyup');\" value=\"";
				echo $row['percent_d'];
				echo "\" size=\"4\"></td>\n                      <td align=\"center\"><input onblur=\"zxxz(\$(this),";
				echo $db2->type_dy_backvalue3( $user['top_id'], $row['set_name'], "bottom_limit" );
				echo ",";
				echo $power;
				echo ",";
				echo $user_id;
				echo ");return CountGoldS1(this,'blur','TP','1','0');\" onkeyup=\"return CountGoldS1(this,'keyup');\" onkeypress=\"return CheckKey11();\" name=\"bottom_limit[]\" class=\"input1\" id=\"m0\" value=\"";
				echo $row['bottom_limit'];
				echo "\" size=\"4\"></td>\n                      <td align=\"center\"><input onblur=\"dzxe(\$(this),";
				echo $db2->type_dy_backvalue1( $user['top_id'], $row['set_name'], "top_limit" );
				echo ",";
				echo $power;
				echo ",";
				echo $user_id;
				echo ");return CountGoldS1(this,'blur','MP','50000','0');\" onkeyup=\"return CountGoldS1(this,'keyup');\" onkeypress=\"return CheckKey11();\" name=\"top_limit[]\" class=\"input1\" id=\"mm0\" value=\"";
				echo $row['top_limit'];
				echo "\" size=\"6\"></td>\n                      <td align=\"center\"><input onblur=\"dzxe(\$(this),";
				echo $db2->type_dy_backvalue2( $user['top_id'], $row['set_name'], "odd_limit" );
				echo ",";
				echo $power;
				echo ",";
				echo $user_id;
				echo ");return CountGoldS1(this,'blur','XP','500000','0');\" onkeypress=\"return CheckKey11();\" onkeyup=\"return CountGoldS1(this,'keyup');\" name=\"odd_limit[]\" class=\"input1\" id=\"mmm0\" value=\"";
				echo $row['odd_limit'];
				echo "\" size=\"6\"></td>\n    ";
		}
		echo " \n    ";
		if ( $row = $db->fetch_array( $query ) )
		{
				echo "               \n                      <td class=\"t_list_tr_1\" align=\"center\">";
				echo $row['set_name'];
				echo "                      <input name=\"cname[]\" id=\"set_name[]\" value=\"";
				echo $row['set_name'];
				echo "\" type=\"hidden\">\n                      <td align=\"center\"><input onblur=\"istuishui(\$(this),";
				echo $db2->type_dy_backvalue( $user['top_id'], $row['set_name'], "percent_a" );
				echo ",";
				echo $power;
				echo ",";
				echo $user_id;
				echo ");return CountGoldS1(this,'blur','SP','14');\" onkeypress=\"return CheckKey11();\" onkeyup=\"return CountGoldS1(this,'keyup');\" name=\"percent_a[]\" class=\"input1\" id=\"ma[]\" value=\"";
				echo $row['percent_a'];
				echo "\" size=\"4\"></td>\n                      <td align=\"center\"><input name=\"percent_b[]\" class=\"input1\" onkeypress=\"return CheckKey11();\" onblur=\"istuishui(\$(this),";
				echo $db2->type_dy_backvalue( $user['top_id'], $row['set_name'], "percent_b" );
				echo ",";
				echo $power;
				echo ",";
				echo $user_id;
				echo ");return CountGoldS1(this,'blur','SP','14');\" onkeyup=\"return CountGoldS1(this,'keyup');\" id=\"mm[]\" value=\"";
				echo $row['percent_b'];
				echo "\" size=\"4\"></td>\n                      <td align=\"center\"><input name=\"percent_c[]\" class=\"input1\" id=\"mc[]\" onkeypress=\"return CheckKey11();\" onblur=\"istuishui(\$(this),";
				echo $db2->type_dy_backvalue( $user['top_id'], $row['set_name'], "percent_c" );
				echo ",";
				echo $power;
				echo ",";
				echo $user_id;
				echo ");return CountGoldS1(this,'blur','SP','15');\" onkeyup=\"return CountGoldS1(this,'keyup');\" value=\"";
				echo $row['percent_c'];
				echo "\" size=\"4\"></td>\n                      <td align=\"center\"><input name=\"percent_d[]\" class=\"input1\" id=\"md[]\" onkeypress=\"return CheckKey11();\" onblur=\"istuishui(\$(this),";
				echo $db2->type_dy_backvalue( $user['top_id'], $row['set_name'], "percent_d" );
				echo ",";
				echo $power;
				echo ",";
				echo $user_id;
				echo ");return CountGoldS1(this,'blur','SP','16');\" onkeyup=\"return CountGoldS1(this,'keyup');\" value=\"";
				echo $row['percent_d'];
				echo "\" size=\"4\"></td>\n                      <td align=\"center\"><input onblur=\"zxxz(\$(this),";
				echo $db2->type_dy_backvalue3( $user['top_id'], $row['set_name'], "bottom_limit" );
				echo ",";
				echo $power;
				echo ",";
				echo $user_id;
				echo ");return CountGoldS1(this,'blur','TP','1','0');\" onkeyup=\"return CountGoldS1(this,'keyup');\" onkeypress=\"return CheckKey11();\" name=\"bottom_limit[]\" class=\"input1\" id=\"m0\" value=\"";
				echo $row['bottom_limit'];
				echo "\" size=\"4\"></td>\n                      <td align=\"center\"><input onblur=\"dzxe(\$(this),";
				echo $db2->type_dy_backvalue1( $user['top_id'], $row['set_name'], "top_limit" );
				echo ",";
				echo $power;
				echo ",";
				echo $user_id;
				echo ");return CountGoldS1(this,'blur','MP','50000','0');\" onkeyup=\"return CountGoldS1(this,'keyup');\" onkeypress=\"return CheckKey11();\" name=\"top_limit[]\" class=\"input1\" id=\"mm0\" value=\"";
				echo $row['top_limit'];
				echo "\" size=\"6\"></td>\n                      <td align=\"center\"><input onblur=onblur=\"dzxe(\$(this),";
				echo $db2->type_dy_backvalue2( $user['top_id'], $row['set_name'], "odd_limit" );
				echo ",";
				echo $power;
				echo ",";
				echo $user_id;
				echo ");return CountGoldS1(this,'blur','XP','500000','0');\" onkeypress=\"return CheckKey11();\" onkeyup=\"return CountGoldS1(this,'keyup');\" name=\"odd_limit[]\" class=\"input1\" id=\"mmm0\" value=\"";
				echo $row['odd_limit'];
				echo "\" size=\"6\"></td>\n    ";
		}
		echo "                 \n                    </tr>\n";
}
echo "                  </tbody>\n                </table>\n</div>\n                <!-- �Y��  --></td>\n              <td background=\"../images/tab_15.gif\" width=\"8\">&nbsp;</td>\n            </tr>\n          </tbody>\n        </table></td>\n    </tr>\n    <tr>\n      <td background=\"../images/tab_19.gif\" height=\"35\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n          <tbody>\n            <tr>\n              <t";
echo "d height=\"35\" width=\"12\"><img src=\"../images/tab_18.gif\" height=\"35\" width=\"12\"></td>\n              <td valign=\"top\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" height=\"30\" width=\"100%\">\n                  <tbody>\n                    <tr>\n                      <td align=\"center\">\n<!--                          <input class=\"btn2\" name=\"Submit\" onmouseout=\"this.className='btn2'\" onmouseover=\"this.classN";
echo "ame='btn2m'\" value=\"����\" type=\"submit\">\n                        <a href=\"javascript:history.back(-1)\"><input class=\"btn2\" onclick=\"javascript:history.back(-1)\" name=\"cancel\"  onmouseout=\"this.className='btn2'\" onmouseover=\"this.className='btn2m'\" value=\"ȡ��\" type=\"button\"></a>-->\n                      </td>\n                    </tr>\n                  </tbody>\n                </table></td>\n              ";
echo "<td width=\"1%\"><img src=\"../images/tab_20.gif\" height=\"35\" width=\"17\"></td>\n            </tr>\n          </tbody>\n        </table></td>\n    </tr>\n    </tbody>\n    \n  </table>\n       </form>\n</div>\n</body>\n</html>";
?>
