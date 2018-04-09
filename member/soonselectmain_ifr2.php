
<!-- saved from url=(0043)http://89955899.com/soonselectmain_ifr2.php -->
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 

<link rel="stylesheet" type="text/css" id="css" href="css/members.css">
<style>html{overflow-y:scroll;overflow-x:hidden;}</style>
<script src="js/common.js" type="text/javascript"></script>
<script src="js/showorderhtml.js" type="text/javascript"></script>
<script src="js/frank.js" type="text/javascript"></script>
<script src="js/ajax.js" type="text/javascript"></script>
<script src="js/showdate.js" type="text/javascript"></script>
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
</style> <script src="js/select.js" type="text/javascript"></script>
<script language="JavaScript">
    function fetch_all_dom() {
        var selectclassid = parent.frames[0].document.getElementById('selectlogsclassid').value;
        var GET_string='classid='+selectclassid;
        if (selectclassid>3) {
            if (document.getElementById('__peishu_chu2').checked) { 
                GET_string+='&peishu_chu2=1'; 
            } 
            if (document.getElementById('__peishu_qu2').checked) { 
                GET_string+='&peishu_qu2=1'; 
            } 
            if (document.getElementById('__dan_1').checked) { 
                GET_string+='&dan_1=1'; 
            } 
            if (document.getElementById('__dan_2').checked) { 
                GET_string+='&dan_2=1'; 
            } 
            if (document.getElementById('__dan_3').checked) { 
                GET_string+='&dan_3=1'; 
            } 
            if (document.getElementById('__dan_4').checked) { 
                GET_string+='&dan_4=1'; 
            } 
            if (document.getElementById('__shuang_3').checked) { 
                GET_string+='&shuang_3=1'; 
            } 
            if (document.getElementById('__shuang_4').checked) { 
                GET_string+='&shuang_4=1'; 
            } 
        }
        else {
            if (document.getElementById('__dingwei_chu').checked) { 
                GET_string+='&dingwei_chu=1'; 
            } 
            if (document.getElementById('__dingwei_qu').checked) { 
                GET_string+='&dingwei_qu=1'; 
            } 
            if (document.getElementById('__dingwei_1').value) { 
                GET_string+='&dingwei_1='+document.getElementById('__dingwei_1').value; 
            } 
            if (document.getElementById('__dingwei_2').value) { 
                GET_string+='&dingwei_2='+document.getElementById('__dingwei_2').value; 
            } 
            if (document.getElementById('__dingwei_3').value) { 
                GET_string+='&dingwei_3='+document.getElementById('__dingwei_3').value; 
            } 
            if (document.getElementById('__dingwei_4').value) { 
                GET_string+='&dingwei_4='+document.getElementById('__dingwei_4').value; 
            } 
            if (document.getElementById('__peishu_chu').checked) { 
                GET_string+='&peishu_chu=1'; 
            } 
            if (document.getElementById('__peishu_qu').checked) { 
                GET_string+='&peishu_qu=1'; 
            } 
            if (document.getElementById('__hefen_chu').checked) { 
                GET_string+='&hefen_chu=1'; 
            } 
            if (document.getElementById('__hefen_qu').checked) { 
                GET_string+='&hefen_qu=1'; 
            } 
            if (document.getElementById('__hefenzhide_1').value!='') { 
                GET_string+='&hefenzhide_1='+document.getElementById('__hefenzhide_1').value; 
            } 
            if (document.getElementById('__hefenzhide_w_11').checked) { 
                GET_string+='&hefenzhide_w_11='+document.getElementById('__hefenzhide_1').value; 
            } 
            if (document.getElementById('__hefenzhide_w_21').checked) { 
                GET_string+='&hefenzhide_w_21='+document.getElementById('__hefenzhide_1').value; 
            } 
            if (document.getElementById('__hefenzhide_w_31').checked) { 
                GET_string+='&hefenzhide_w_31='+document.getElementById('__hefenzhide_1').value; 
            } 
            if (document.getElementById('__hefenzhide_w_41').checked) { 
                GET_string+='&hefenzhide_w_41='+document.getElementById('__hefenzhide_1').value; 
            } 
            if (document.getElementById('__hefenzhide_2').value!='') { 
                GET_string+='&hefenzhide_2='+document.getElementById('__hefenzhide_2').value; 
            } 
            if (document.getElementById('__hefenzhide_w_12').checked) { 
                GET_string+='&hefenzhide_w_12='+document.getElementById('__hefenzhide_2').value; 
            } 
            if (document.getElementById('__hefenzhide_w_22').checked) { 
                GET_string+='&hefenzhide_w_22='+document.getElementById('__hefenzhide_2').value; 
            } 
            if (document.getElementById('__hefenzhide_w_32').checked) { 
                GET_string+='&hefenzhide_w_32='+document.getElementById('__hefenzhide_2').value; 
            } 
            if (document.getElementById('__hefenzhide_w_42').checked) { 
                GET_string+='&hefenzhide_w_42='+document.getElementById('__hefenzhide_2').value; 
            } 
            if (document.getElementById('__hefenzhide_3').value!='') { 
                GET_string+='&hefenzhide_3='+document.getElementById('__hefenzhide_3').value; 
            } 
            if (document.getElementById('__hefenzhide_w_13').checked) { 
                GET_string+='&hefenzhide_w_13='+document.getElementById('__hefenzhide_3').value; 
            } 
            if (document.getElementById('__hefenzhide_w_23').checked) { 
                GET_string+='&hefenzhide_w_23='+document.getElementById('__hefenzhide_3').value; 
            } 
            if (document.getElementById('__hefenzhide_w_33').checked) { 
                GET_string+='&hefenzhide_w_33='+document.getElementById('__hefenzhide_3').value; 
            } 
            if (document.getElementById('__hefenzhide_w_43').checked) { 
                GET_string+='&hefenzhide_w_43='+document.getElementById('__hefenzhide_3').value; 
            } 
            if (document.getElementById('__hefenzhide_4').value!='') { 
                GET_string+='&hefenzhide_4='+document.getElementById('__hefenzhide_4').value; 
            } 
            if (document.getElementById('__hefenzhide_w_14').checked) { 
                GET_string+='&hefenzhide_w_14='+document.getElementById('__hefenzhide_4').value; 
            } 
            if (document.getElementById('__hefenzhide_w_24').checked) { 
                GET_string+='&hefenzhide_w_24='+document.getElementById('__hefenzhide_4').value; 
            } 
            if (document.getElementById('__hefenzhide_w_34').checked) { 
                GET_string+='&hefenzhide_w_34='+document.getElementById('__hefenzhide_4').value; 
            } 
            if (document.getElementById('__hefenzhide_w_44').checked) { 
                GET_string+='&hefenzhide_w_44='+document.getElementById('__hefenzhide_4').value; 
            } 
            if (document.getElementById('__bdwhefen').value!='') { 
                GET_string+='&bdwhefen='+document.getElementById('__bdwhefen').value; 
            } 
            if (document.getElementById('__bdwhefen_1').checked) { 
                GET_string+='&bdwhefen_1='+document.getElementById('__bdwhefen').value;; 
            } 
            if (document.getElementById('__quandao').value!='') { 
                GET_string+='&quandao='+document.getElementById('__quandao').value; 
            } 
            if (document.getElementById('__shangjiang').value!='') { 
                GET_string+='&shangjiang='+document.getElementById('__shangjiang').value; 
            } 
            if (document.getElementById('__paichu').value!='') { 
                GET_string+='&paichu='+document.getElementById('__paichu').value; 
            } 
            if (document.getElementById('__chu_chong_1').checked) { 
                GET_string+='&chu_chong_1=1'; 
            } 
            if (document.getElementById('__qu_chong_1').checked) { 
                GET_string+='&qu_chong_1=1'; 
            } 
            if (document.getElementById('__chu_xiongdi_1').checked) { 
                GET_string+='&chu_xiongdi_1=1'; 
            } 
            if (document.getElementById('__qu_xiongdi_1').checked) { 
                GET_string+='&qu_xiongdi_1=1'; 
            } 
            if (document.getElementById('__dan_1').checked) { 
                GET_string+='&dan_1=1'; 
            } 
            if (document.getElementById('__dan_2').checked) { 
                GET_string+='&dan_2=1'; 
            } 
            if (document.getElementById('__dan_3').checked) { 
                GET_string+='&dan_3=1'; 
            } 
            if (document.getElementById('__dan_4').checked) { 
                GET_string+='&dan_4=1'; 
            } 
            if (document.getElementById('__shuang_1').checked) { 
                GET_string+='&shuang_1=1'; 
            } 
            if (document.getElementById('__shuang_2').checked) { 
                GET_string+='&shuang_2=1'; 
            } 
            if (document.getElementById('__shuang_3').checked) { 
                GET_string+='&shuang_3=1'; 
            } 
            if (document.getElementById('__shuang_4').checked) { 
                GET_string+='&shuang_4=1'; 
            } 
        }
        if (document.getElementById('__peishu_1').value!='') { 
            GET_string+='&peishu_1='+document.getElementById('__peishu_1').value; 
        } 
        if (document.getElementById('__peishu_2').value!='') { 
            GET_string+='&peishu_2='+document.getElementById('__peishu_2').value; 
        } 
        if (document.getElementById('__chu_duishu').checked) { 
            GET_string+='&chu_duishu=1'; 
        } 
        if (document.getElementById('__qu_duishu').checked) { 
            GET_string+='&qu_duishu=1'; 
        } 
        if (document.getElementById('__dan_chu').checked) { 
            GET_string+='&dan_chu=1'; 
        } 
        if (document.getElementById('__dan_qu').checked) { 
            GET_string+='&dan_qu=1'; 
        } 
        if (document.getElementById('__shuang_chu').checked) { 
            GET_string+='&shuang_chu=1'; 
        } 
        if (document.getElementById('__shuang_qu').checked) { 
            GET_string+='&shuang_qu=1'; 
        } 
        if (document.getElementById('__duishu_1').value!='') { 
            GET_string+='&duishu_1='+document.getElementById('__duishu_1').value; 
        } 
        if (document.getElementById('__duishu_2').value!='') { 
            GET_string+='&duishu_2='+document.getElementById('__duishu_2').value; 
        } 
        if (document.getElementById('__duishu_3').value!='') { 
            GET_string+='&duishu_3='+document.getElementById('__duishu_3').value; 
        } 

        if (selectclassid==1 || selectclassid==2) {
            if (document.getElementById('__chenghao_1').checked) { 
                GET_string+='&chenghao_1=1'; 
            } 
            if (document.getElementById('__chenghao_2').checked) { 
                GET_string+='&chenghao_2=1'; 
            } 
            if (document.getElementById('__chenghao_3').checked) { 
                GET_string+='&chenghao_3=1'; 
            } 
            if (document.getElementById('__chenghao_4').checked) { 
                GET_string+='&chenghao_4=1'; 
            } 
        }
        switch (selectclassid) {
        case "1":
            if (document.getElementById('__han_1').value!='') { 
                GET_string+='&han_1='+document.getElementById('__han_1').value; 
            } 
            if (document.getElementById('__chu_1').checked) { 
                GET_string+='&chu_1=1'; 
            } 
            if (document.getElementById('__qu_1').checked) { 
                GET_string+='&qu_1=1'; 
            } 
            if (document.getElementById('__fushi_1').value!='') { 
                GET_string+='&fushi_1='+document.getElementById('__fushi_1').value; 
            } 

            break;
        case "2":
            if (document.getElementById('__han_2').value!='') { 
                GET_string+='&han_2='+document.getElementById('__han_2').value; 
            } 
            if (document.getElementById('__chu_2').checked) { 
                GET_string+='&chu_2=1'; 
            } 
            if (document.getElementById('__qu_2').checked) { 
                GET_string+='&qu_2=1'; 
            } 
            if (document.getElementById('__fushi_2').value!='') { 
                GET_string+='&fushi_2='+document.getElementById('__fushi_2').value; 
            } 

            if (document.getElementById('__peishu_3').value!='') { 
                GET_string+='&peishu_3='+document.getElementById('__peishu_3').value; 
            } 
            if (document.getElementById('__bdwhefen_2').checked) { 
                GET_string+='&bdwhefen_2='+document.getElementById('__bdwhefen').value;                
            } 
            if (document.getElementById('__chu_chong_3').checked) { 
                GET_string+='&chu_chong_3=1'; 
            } 
            if (document.getElementById('__qu_chong_3').checked) { 
                GET_string+='&qu_chong_3=1'; 
            } 
            if (document.getElementById('__chu_xiongdi_2').checked) { 
                GET_string+='&chu_xiongdi_2=1'; 
            } 
            if (document.getElementById('__qu_xiongdi_2').checked) { 
                GET_string+='&qu_xiongdi_2=1'; 
            } 

            break;
        case "3":
            if (document.getElementById('__gd1').checked) { 
                GET_string+='&gd1=1'; 
            } 
            if (document.getElementById('__gd2').checked) { 
                GET_string+='&gd2=1'; 
            } 
            if (document.getElementById('__gd3').checked) { 
                GET_string+='&gd3=1'; 
            } 
            if (document.getElementById('__gd4').checked) { 
                GET_string+='&gd4=1'; 
            } 

            if (document.getElementById('__han_3').value!='') { 
                GET_string+='&han_3='+document.getElementById('__han_3').value; 
            } 
            if (document.getElementById('__chu_3').checked) { 
                GET_string+='&chu_3=1'; 
            } 
            if (document.getElementById('__qu_3').checked) { 
                GET_string+='&qu_3=1'; 
            } 
            if (document.getElementById('__fushi_3').value!='') { 
                GET_string+='&fushi_3='+document.getElementById('__fushi_3').value; 
            } 

            if (document.getElementById('__peishu_3').value!='') { 
                GET_string+='&peishu_3='+document.getElementById('__peishu_3').value; 
            } 
            if (document.getElementById('__peishu_4').value!='') { 
                GET_string+='&peishu_4='+document.getElementById('__peishu_4').value; 
            } 
            if (document.getElementById('__bdwhefen_2').checked) { 
                GET_string+='&bdwhefen_2='+document.getElementById('__bdwhefen').value; 
            } 
            if (document.getElementById('__chu_chong_2').checked) { 
                GET_string+='&chu_chong_2=1'; 
            } 
            if (document.getElementById('__qu_chong_2').checked) { 
                GET_string+='&qu_chong_2=1'; 
            } 
            if (document.getElementById('__chu_chong_3').checked) { 
                GET_string+='&chu_chong_3=1'; 
            } 
            if (document.getElementById('__qu_chong_3').checked) { 
                GET_string+='&qu_chong_3=1'; 
            } 
            if (document.getElementById('__chu_chong_4').checked) { 
                GET_string+='&chu_chong_4=1'; 
            } 
            if (document.getElementById('__qu_chong_4').checked) { 
                GET_string+='&qu_chong_4=1'; 
            } 
            if (document.getElementById('__chu_xiongdi_2').checked) { 
                GET_string+='&chu_xiongdi_2=1'; 
            } 
            if (document.getElementById('__qu_xiongdi_2').checked) { 
                GET_string+='&qu_xiongdi_2=1'; 
            } 
            if (document.getElementById('__chu_xiongdi_3').checked) { 
                GET_string+='&chu_xiongdi_3=1'; 
            } 
            if (document.getElementById('__qu_xiongdi_3').checked) { 
                GET_string+='&qu_xiongdi_3=1'; 
            } 
            if (document.getElementById('__zhifanwei_start').value!='') { 
                GET_string+='&zhifanwei_start='+document.getElementById('__zhifanwei_start').value; 
            } 
            if (document.getElementById('__zhifanwei_end').value!='') { 
                GET_string+='&zhifanwei_end='+document.getElementById('__zhifanwei_end').value; 
            } 

            break;
        case "4":
            if (document.getElementById('__han_4').value!='') { 
                GET_string+='&han_4='+document.getElementById('__han_4').value; 
            } 
            if (document.getElementById('__chu_4').checked) { 
                GET_string+='&chu_4=1'; 
            } 
            if (document.getElementById('__qu_4').checked) { 
                GET_string+='&qu_4=1'; 
            } 
            if (document.getElementById('__fushi_4').value!='') { 
                GET_string+='&fushi_4='+document.getElementById('__fushi_4').value; 
            } 

            break;
        case "5":
            if (document.getElementById('__han_5').value!='') { 
                GET_string+='&han_5='+document.getElementById('__han_5').value; 
            } 
            if (document.getElementById('__chu_5').checked) { 
                GET_string+='&chu_5=1'; 
            } 
            if (document.getElementById('__qu_5').checked) { 
                GET_string+='&qu_5=1'; 
            } 
            if (document.getElementById('__fushi_5').value!='') { 
                GET_string+='&fushi_5='+document.getElementById('__fushi_5').value; 
            } 

            if (document.getElementById('__peishu_3').value!='') { 
                GET_string+='&peishu_3='+document.getElementById('__peishu_3').value; 
            } 
            if (document.getElementById('__bdwhefen_2').checked) { 
                GET_string+='&bdwhefen_2='+document.getElementById('__bdwhefen').value;
            } 
            if (document.getElementById('__shuang_2').checked) { 
                GET_string+='&shuang_2=1'; 
            } 
            break;

        case "6":
            if (document.getElementById('__han_6').value!='') { 
                GET_string+='&han_6='+document.getElementById('__han_6').value; 
            } 
            if (document.getElementById('__chu_6').checked) { 
                GET_string+='&chu_6=1'; 
            } 
            if (document.getElementById('__qu_6').checked) { 
                GET_string+='&qu_6=1'; 
            } 
            if (document.getElementById('__fushi_6').value!='') { 
                GET_string+='&fushi_6='+document.getElementById('__fushi_6').value; 
            } 

            if (document.getElementById('__peishu_3').value!='') { 
                GET_string+='&peishu_3='+document.getElementById('__peishu_3').value; 
            } 
            if (document.getElementById('__peishu_4').value!='') { 
                GET_string+='&peishu_4='+document.getElementById('__peishu_4').value; 
            } 
            if (document.getElementById('__bdwhefen_2').checked) { 
                GET_string+='&bdwhefen_2='+document.getElementById('__bdwhefen').value;
                // GET_string+='&bdwhefen_2=1'; 
            } 
            if (document.getElementById('__shuang_1').checked) { 
                GET_string+='&shuang_1=1'; 
            } 
            if (document.getElementById('__shuang_2').checked) { 
                GET_string+='&shuang_2=1'; 
            } 
            break;

        }
        GET_string = GET_string.replace(/&/g,"|||");
        //console.log("SEND :"+GET_string);
        return GET_string;
    }
    function loging(){
        var objfra = parent.window.frames[0];
        var numbernum=objfra.document.getElementById('selectnumber').value;
        if(numbernum!=''){
            if(window.confirm('\n上次生成数据还没有下注完成，确定要重新生成吗?\n\n')){
                __ss.__create();
                objfra.$("getstring_hidden").value = fetch_all_dom();
                parent.soonselectorder.totalmoney(parent.soonselectorder.$('money'));
                return false;
            }else{ 
                return;
            }
        }else{
            __ss.__create();
            objfra.$("getstring_hidden").value=fetch_all_dom();
            parent.soonselectorder.totalmoney(parent.soonselectorder.$('money'));
        }
        // if (objfra.document.getElementById('showselectnumber').firstChild.rows.length>0) {
            
        // }
        //setTimeout("$('setsoonclass1').disabled=false;",2000);
        //window.parent.parent.frames["main"].frames["soonselectorder"].$("showselectnumber").innerHTML='<br>数据生成中...';
    }
    function __reset (){
        var objfra = parent.window.frames[0];
        objfra.$("showselectnumber").innerHTML='';
        objfra.$("selectnumber").value='';
        objfra.$("selectnumbertotal").innerHTML=0;
        objfra.$("selectnumbertotal_hidden").value=0;
        //XMLHttp.sendReq("GET","ajax.php?action=selectreset&amp;sid=VUeuZt&amp;inajax=1","",post_selectMsg,"showorderhtml");
        //$('setsoonclass1').disabled=false;
    }
    function checknumber(t){
        if(!(/^\d*$/g.test(t.value))){
            t.value = t.value.replace(/[^\d]*/g,'');
        }
    }
    
    function getclassid(s){
        parent.frames[0].document.getElementById('selectlogsclassid').value=s;
        for(i=1;i<=6;i++){
            $("top_"+i).className="top_1";
        }
        $("top_"+s).className="top_2";
    }
</script>
</head>
<body style="margin: 0px;">
    <table width="99%" border="0" cellpadding="0" cellspacing="0" style="background: #fff;" align="center">
        <tbody>
            <tr>
                <td style="padding:0px" valign="top">
                    <script language="JavaScript">
                        var _soonset = {'s_weizhi':1,'s_hefen':1,'s_bdwhefen':1,'zhifenwei':1,'quandao':1,'paichu':1,'chenghao':1,'fushi':1,'shong1':1,'shong2':1,'shong3':1,'shong4':1,'xiongdi1':1,'xiongdi2':1,'xiongdi3':1,'duishu':1,'dan':1,'shuang':1,'shangjiang':1,'sidingwei':1};
                    </script>
                    <table width="100%" border="0" cellpadding="0" cellspacing="0" class="soonselect_b">
                        <form method="POST" name="datamembers" id="datamembers" target="soonsend_ifr" action="" style="padding:0;margin:0"></form>
                        
                        <input type="hidden" name="formhash" value="a604d464">
                        <input type="hidden" name="delaction" value="yes">
                        <tbody>
                            <tr class="center">
                                <td colspan="4">
                                    <table border="0" width="100%" cellpadding="0" cellspacing="0">
                                        <tbody>
                                            <tr style="border:0px">
                                                <td width="16%" id="top_1" class="top_1" style="border:0px"><button onclick="getclassid(1);__ss.__showmeun(1);return false;" type="button" id="soonclass3" name="soonclass1" class="select_button1 number_count number_w3">二字定</button></td>
                                                <td width="16%" id="top_2" class="top_1" style="border:0px"><button onclick="getclassid(2);__ss.__showmeun(2);return false;" type="button" id="soonclass2" name="soonclass1" class="select_button2 number_count number_w3">三字定</button></td>
                                                <td width="16%" id="top_3" class="top_1" style="border:0px"><button onclick="getclassid(3);__ss.__showmeun(3);return false;" type="button" id="soonclass1" name="soonclass1" class="select_button2 number_count number_w3" >四字定</button></td>
                                                <td width="16%" id="top_4" class="top_1" style="border:0px"><button onclick="getclassid(4);__ss.__showmeun(4);return false;" type="button" id="soonclass4" name="soonclass1" class="select_button2 number_count number_w3">二字现</button></td>
                                                <td width="16%" id="top_5" class="top_1" style="border:0px"><button onclick="getclassid(5);__ss.__showmeun(5);return false;" type="button" id="soonclass5" name="soonclass1" class="select_button2 number_count number_w3">三字现</button></td>
                                                <td width="16%" id="top_6" class="top_1" style="border:0px"><button onclick="getclassid(6);__ss.__showmeun(6);return false;" type="button" id="soonclass6" name="soonclass1" class="select_button2 number_count number_w3">四字现</button></td>
                                            </tr>
                                            <tr>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr id="s1" class="soon_head center">
                                <td colspan="2">
                                    <dl>定位置</dl>
                                    <input type="checkbox" name="__dingwei_chu" id="__dingwei_chu" onclick="__ss.__showdis(this,&#39;__dingwei_qu&#39;);">除
                                    <input type="checkbox" name="__dingwei_qu" id="__dingwei_qu" onclick="__ss.__showdis(this,&#39;__dingwei_chu&#39;);" checked="">取
                                </td>
                                <td colspan="2">
                                    <dl>配数全转</dl>
                                    <input type="checkbox" name="__peishu_chu" id="__peishu_chu" onclick="__ss.__showdis(this,&#39;__peishu_qu&#39;);">除
                                    <input type="checkbox" name="__peishu_qu" id="__peishu_qu" onclick="__ss.__showdis(this,&#39;__peishu_chu&#39;);">取
                                </td>
                            </tr>
                            <tr id="s13" class="soon_head center" style="display: none;">
                                <td colspan="4">
                                    <dl>配数</dl>
                                    <input type="checkbox" name="__peishu_chu2" id="__peishu_chu2" onclick="__ss.__showdis(this,&#39;__peishu_qu2&#39;);">除
                                    <input type="checkbox" name="__peishu_qu2" id="__peishu_qu2" onclick="__ss.__showdis(this,&#39;__peishu_chu2&#39;);" checked="">取
                                </td>
                            </tr>
                            <tr id="s12" class="center" style="display: none;">
                                <td colspan="4">
                                    <span id="ps1"><input type="text" name="__peishu_1" id="__peishu_1" class="soonselect_w soonselect_w74" maxlength="10" onkeyup="checknumber(this);"></span>
                                    <span id="ps2"> 配,<input type="text" name="__peishu_2" id="__peishu_2" class="soonselect_w soonselect_w74" maxlength="10" onkeyup="checknumber(this);"></span>
                                    <span id="ps3" style=""> 配,<input type="text" name="__peishu_3" id="__peishu_3" class="soonselect_w soonselect_w74" maxlength="10" onkeyup="checknumber(this);"></span>
                                    <span id="ps4"> 配,<input type="text" name="__peishu_4" id="__peishu_4" class="soonselect_w soonselect_w74" maxlength="10" onkeyup="checknumber(this);"></span>
                                </td>
                            </tr>
                            <tr id="s2" class="center">
                                <td>仟</td>
                                <td>佰</td>
                                <td>拾</td>
                                <td>个</td>
                            </tr>
                            <tr id="s3" class="center">
                                <td><input type="text" name="__dingwei_1" id="__dingwei_1" class="soonselect_w soonselect_w74" maxlength="10" onkeyup="checknumber(this);limitrepeat(this)" onkeydown="changeFocus(1)" ></td>
                                <td><input type="text" name="__dingwei_2" id="__dingwei_2" class="soonselect_w soonselect_w74" maxlength="10" onkeyup="checknumber(this);limitrepeat(this)" onkeydown="changeFocus(2)" ></td>
                                <td><input type="text" name="__dingwei_3" id="__dingwei_3" class="soonselect_w soonselect_w74" maxlength="10" onkeyup="checknumber(this);limitrepeat(this)" onkeydown="changeFocus(3)"></td>
                                <td><input type="text" name="__dingwei_4" id="__dingwei_4" class="soonselect_w soonselect_w74" maxlength="10" onkeyup="checknumber(this);limitrepeat(this)" onkeydown="changeFocus(4)"></td>
                            </tr>
                            <tr id="s4" class="soon_head center">
                                <td colspan="4">
                                    <dl>合　分</dl>
                                    <input type="checkbox" name="__hefen_chu" id="__hefen_chu" onclick="__ss.__showdis(this,&#39;__hefen_qu&#39;);">除
                                    <input type="checkbox" name="__hefen_qu" id="__hefen_qu" onclick="__ss.__showdis(this,&#39;__hefen_chu&#39;);" checked="">取
                                </td>
                            </tr>
                            <tr id="s5" class="center">
                                <td>
                                    1.
                                    <input type="checkbox" id="__hefenzhide_w_11" name="__hefenzhide_w_11">
                                    <input type="checkbox" id="__hefenzhide_w_21" name="__hefenzhide_w_21">
                                    <input type="checkbox" id="__hefenzhide_w_31" name="__hefenzhide_w_31">
                                    <input type="checkbox" id="__hefenzhide_w_41" name="__hefenzhide_w_41">
                                    <input type="text" name="__hefenzhide_1" class="soonselect_w soonselect_w74" id="__hefenzhide_1" maxlength="10" onkeyup="limitrepeat(this)">
                                </td>
                                <td>
                                    2.
                                    <input type="checkbox" id="__hefenzhide_w_12" name="__hefenzhide_w_12">
                                    <input type="checkbox" id="__hefenzhide_w_22" name="__hefenzhide_w_22">
                                    <input type="checkbox" id="__hefenzhide_w_32" name="__hefenzhide_w_32">
                                    <input type="checkbox" id="__hefenzhide_w_42" name="__hefenzhide_w_42">
                                    <input type="text" name="__hefenzhide_2" class="soonselect_w soonselect_w74" id="__hefenzhide_2" maxlength="10" onkeyup="limitrepeat(this)">
                                </td>
                                <td>
                                    3.
                                    <input type="checkbox" id="__hefenzhide_w_13" name="__hefenzhide_w_13">
                                    <input type="checkbox" id="__hefenzhide_w_23" name="__hefenzhide_w_23">
                                    <input type="checkbox" id="__hefenzhide_w_33" name="__hefenzhide_w_33">
                                    <input type="checkbox" id="__hefenzhide_w_43" name="__hefenzhide_w_43">
                                    <input type="text" name="__hefenzhide_3" class="soonselect_w soonselect_w74" id="__hefenzhide_3" maxlength="10" onkeyup="limitrepeat(this)">
                                </td>
                                <td>
                                    4.
                                    <input type="checkbox" id="__hefenzhide_w_14" name="__hefenzhide_w_14">
                                    <input type="checkbox" id="__hefenzhide_w_24" name="__hefenzhide_w_24">
                                    <input type="checkbox" id="__hefenzhide_w_34" name="__hefenzhide_w_34">
                                    <input type="checkbox" id="__hefenzhide_w_44" name="__hefenzhide_w_44">
                                    <input type="text" name="__hefenzhide_4" class="soonselect_w soonselect_w74" id="__hefenzhide_4" maxlength="10" onkeyup="limitrepeat(this)">
                                </td>
                            </tr>
                            <tr id="s6">
                                <td colspan="2">
                                    <span id="bdwhefen1">
                                        <table width="100%" border="0" cellpadding="0" cellspacing="0" style="border: 0px;">
                                            <tbody>
                                                <tr>
                                                    <td width="220" style="border: 0px;">
                                                        <dl>不定位合分</dl>
                                                        <span id="bd1"><input type="checkbox" id="__bdwhefen_1" name="__bdwhefen_1" onclick="__ss.__showdis(this,&#39;__bdwhefen_2&#39;);">两数合</span>
                                                        <span id="bd2" style="display: none;"><input type="checkbox" id="__bdwhefen_2" name="__bdwhefen_2" onclick="__ss.__showdis(this,&#39;__bdwhefen_1&#39;);">三数合</span>
                                                    </td>
                                                    <td width="*" style="border: 0px;">
                                                        <input type="text" name="__bdwhefen" id="__bdwhefen" class="soonselect_w soonselect_w20" style="width:80px" maxlength="8" onkeyup="limitrepeat(this)">
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </span>
                                </td>
                                <td class="center" colspan="2">
                                    <span id="zfw1" style="">
                                        &nbsp;&nbsp;<dl>值 范 围</dl>&nbsp;&nbsp;从
                                        <input type="text" name="__zhifanwei_start" id="__zhifanwei_start" onkeyup="__ss.__keyup_zhifanwei();" class="soonselect_w soonselect_w35" maxlength="8">
                                        值&nbsp;至&nbsp;&nbsp;
                                        <input type="text" name="__zhifanwei_end" id="__zhifanwei_end" onkeyup="__ss.__keyup_zhifanwei();" class="soonselect_w soonselect_w35" maxlength="8">值
                                    </span>
                                </td>
                            </tr>
                            <tr id="s7">
                                <td colspan="4">
                                    <span id="quandao">
                                        <dl>全转</dl>&nbsp;
                                        <input onkeypress="JHshNumberText();" type="text" name="__quandao" id="__quandao" class="soonselect_w soonselect_w55" maxlength="9">
                                    </span>
                                    <span id="shangjiang">
                                        <dl>上奖</dl>&nbsp;
                                        <input onkeypress="JHshNumberText();" type="text" name="__shangjiang" id="__shangjiang" class="soonselect_w soonselect_w55" maxlength="9">
                                    </span>
                                    <span id="paichu">
                                        &nbsp;<dl>排除</dl>&nbsp;
                                        <input type="text" name="__paichu" id="__paichu" class="soonselect_w soonselect_w55" maxlength="9" onkeyup="limitrepeat(this)">
                                    </span>
                                    <span id="changyong">
                                        <input type="checkbox" name="__changyong" id="__changyong" style="display:none">
                                    </span>
                                    &nbsp;
                                    <span id="ch1" style="display: none;"><dl>乘号位置</dl></span>
                                    <span id="ch2" style="display: none;">
                                        <input type="checkbox" name="__chenghao_1" id="__chenghao_1">
                                        <input type="checkbox" name="__chenghao_2" id="__chenghao_2">
                                        <input type="checkbox" name="__chenghao_3" id="__chenghao_3">
                                        <input type="checkbox" name="__chenghao_4" id="__chenghao_4">
                                    </span>
                                    <span id="psgdstr" style="display: none;">
                                        <dl>固定位置</dl>
                                        <input type="checkbox" name="__gd1" id="__gd1">
                                        <input type="checkbox" name="__gd2" id="__gd2">
                                        <input type="checkbox" name="__gd3" id="__gd3">
                                        <input type="checkbox" name="__gd4" id="__gd4">
                                    </span>
                                </td>
                            </tr>
                            <tr id="han1" >
                                <td colspan="4">
                                    <input type="checkbox" name="__chu_1" id="__chu_1" onclick="__ss.__showdis(this,&#39;__qu_1&#39;);">除
                                    <input type="checkbox" name="__qu_1" id="__qu_1" onclick="__ss.__showdis(this,&#39;__chu_1&#39;);">取&nbsp;二字定含&nbsp;
                                    <input type="text" name="__han_1" id="__han_1" class="soonselect_w soonselect_w25" maxlength="1">&nbsp;二字定复式
                                    <input type="text" name="__fushi_1" id="__fushi_1" class="soonselect_w soonselect_w100" maxlength="10" onkeyup="limitrepeat(this)">
                                </td>
                            </tr>
                            <tr id="han2" style="display: none;">
                                <td colspan="4">
                                    <input type="checkbox" name="__chu_2" id="__chu_2" onclick="__ss.__showdis(this,&#39;__qu_2&#39;);">除
                                    <input type="checkbox" name="__qu_2" id="__qu_2" onclick="__ss.__showdis(this,&#39;__chu_2&#39;);">取&nbsp;三字定含&nbsp;
                                    <input type="text" name="__han_2" id="__han_2" class="soonselect_w soonselect_w25" maxlength="2">&nbsp;三字定复式
                                    <input type="text" name="__fushi_2" id="__fushi_2" class="soonselect_w soonselect_w100" maxlength="10" onkeyup="limitrepeat(this)">
                                </td>
                            </tr>
                            <tr id="han3" style="display: none;">
                                <td colspan="4">
                                    <input type="checkbox" name="__chu_3" id="__chu_3" onclick="__ss.__showdis(this,&#39;__qu_3&#39;);">除
                                    <input type="checkbox" name="__qu_3" id="__qu_3" onclick="__ss.__showdis(this,&#39;__chu_3&#39;);">取&nbsp;四字定<dl>含</dl>&nbsp;
                                    <input type="text" name="__han_3" id="__han_3" class="soonselect_w soonselect_w25" maxlength="3">&nbsp;四字定<dl>复式</dl>
                                    <input type="text" name="__fushi_3" id="__fushi_3" class="soonselect_w soonselect_w100" maxlength="10" onkeyup="limitrepeat(this)">
                                </td>
                            </tr>
                            <tr id="han4" style="display: none;">
                                <td colspan="4">
                                    <input type="checkbox" name="__chu_4" id="__chu_4" onclick="__ss.__showdis(this,&#39;__qu_4&#39;);">除
                                    <input type="checkbox" name="__qu_4" id="__qu_4" onclick="__ss.__showdis(this,&#39;__chu_4&#39;);">取&nbsp;二字现<dl>含</dl>&nbsp;
                                    <input type="text" name="__han_4" id="__han_4" class="soonselect_w soonselect_w25" maxlength="1">&nbsp;二字现<dl>复式</dl>
                                    <input type="text" name="__fushi_4" id="__fushi_4" class="soonselect_w soonselect_w100" maxlength="10" onkeyup="limitrepeat(this)">
                                </td>
                            </tr>
                            <tr id="han5" style="display: none;">
                                <td colspan="4">
                                    <input type="checkbox" name="__chu_5" id="__chu_5" onclick="__ss.__showdis(this,&#39;__qu_5&#39;);">除
                                    <input type="checkbox" name="__qu_5" id="__qu_5" onclick="__ss.__showdis(this,&#39;__chu_5&#39;);">取&nbsp;三字现<dl>含</dl>&nbsp;
                                    <input type="text" name="__han_5" id="__han_5" class="soonselect_w soonselect_w25" maxlength="1">&nbsp;三字现<dl>复式</dl>
                                    <input type="text" name="__fushi_5" id="__fushi_5" class="soonselect_w soonselect_w100" maxlength="10" onkeyup="limitrepeat(this)">
                                </td>
                            </tr>
                            <tr id="han6" style="display: none;">
                                <td colspan="4">
                                    <input type="checkbox" name="__chu_6" id="__chu_6" onclick="__ss.__showdis(this,&#39;__qu_6&#39;);">除
                                    <input type="checkbox" name="__qu_6" id="__qu_6" onclick="__ss.__showdis(this,&#39;__chu_6&#39;);">取&nbsp;四字现<dl>含</dl>&nbsp;
                                    <input type="text" name="__han_6" id="__han_6" class="soonselect_w soonselect_w25" maxlength="1">&nbsp;四字现<dl>复式</dl>
                                    <input type="text" name="__fushi_6" id="__fushi_6" class="soonselect_w soonselect_w100" maxlength="10" onkeyup="limitrepeat(this)">
                                </td>
                            </tr>
                            <tr id="s8">
                                <td colspan="4">
                                    <span id="ss1">
                                        <input type="checkbox" name="__chu_chong_1" id="__chu_chong_1" onclick="__ss.__showdis(this,&#39;__qu_chong_1&#39;);">除
                                        <input type="checkbox" name="__qu_chong_1" id="__qu_chong_1" onclick="__ss.__showdis(this,&#39;__chu_chong_1&#39;);">取(<dl>双重</dl>)&nbsp;
                                    </span>
                                    <span id="ss2" style="display: none;">
                                        <input type="checkbox" name="__chu_chong_2" id="__chu_chong_2" onclick="__ss.__showdis(this,&#39;__qu_chong_2&#39;);">除
                                        <input type="checkbox" name="__qu_chong_2" id="__qu_chong_2" onclick="__ss.__showdis(this,&#39;__chu_chong_2&#39;);">取(<dl>双双重</dl>)&nbsp;
                                    </span>
                                    <span id="ss3" style="display: none;">
                                        <input type="checkbox" name="__chu_chong_3" id="__chu_chong_3" onclick="__ss.__showdis(this,&#39;__qu_chong_3&#39;);">除
                                        <input type="checkbox" name="__qu_chong_3" id="__qu_chong_3" onclick="__ss.__showdis(this,&#39;__chu_chong_3&#39;);">取(<dl>三重</dl>)&nbsp;
                                    </span>
                                    <span id="ss4" style="display: none;">
                                        <input type="checkbox" name="__chu_chong_4" id="__chu_chong_4" onclick="__ss.__showdis(this,&#39;__qu_chong_4&#39;);">除
                                        <input type="checkbox" name="__qu_chong_4" id="__qu_chong_4" onclick="__ss.__showdis(this,&#39;__chu_chong_4&#39;);">取(<dl>四重</dl>)
                                    </span>
                                </td>
                            </tr>
                            <tr id="s9">
                                <td colspan="4">
                                    <span id="ss5">
                                        <input type="checkbox" name="__chu_xiongdi_1" id="__chu_xiongdi_1" onclick="__ss.__showdis(this,&#39;__qu_xiongdi_1&#39;);">除
                                        <input type="checkbox" name="__qu_xiongdi_1" id="__qu_xiongdi_1" onclick="__ss.__showdis(this,&#39;__chu_xiongdi_1&#39;);">取(<dl>二兄弟</dl>)&nbsp;
                                    </span>
                                    <span id="ss6" style="display: none;">
                                        <input type="checkbox" name="__chu_xiongdi_2" id="__chu_xiongdi_2" onclick="__ss.__showdis(this,&#39;__qu_xiongdi_2&#39;);">除
                                        <input type="checkbox" name="__qu_xiongdi_2" id="__qu_xiongdi_2" onclick="__ss.__showdis(this,&#39;__chu_xiongdi_2&#39;);">取(<dl>三兄弟</dl>)&nbsp;
                                    </span>
                                    <span id="ss7" style="display: none;">
                                        <input type="checkbox" name="__chu_xiongdi_3" id="__chu_xiongdi_3" onclick="__ss.__showdis(this,&#39;__qu_xiongdi_3&#39;);">除
                                        <input type="checkbox" name="__qu_xiongdi_3" id="__qu_xiongdi_3" onclick="__ss.__showdis(this,&#39;__chu_xiongdi_3&#39;);">取(<dl>四兄弟</dl>)
                                    </span>
                                </td>
                            </tr>
                            <tr id="s10">
                                <td colspan="4">
                                    <span id="ss8">
                                        <input type="checkbox" name="__chu_duishu" id="__chu_duishu" onclick="__ss.__showdis(this,&#39;__qu_duishu&#39;);">除
                                        <input type="checkbox" name="__qu_duishu" id="__qu_duishu" onclick="__ss.__showdis(this,&#39;__chu_duishu&#39;);">取(<dl>对数</dl>)
                                    </span>&nbsp;
                                    <input type="text" name="__duishu_1" id="__duishu_1" class="soonselect_w soonselect_w55" maxlength="2" onkeyup="limitrepeat(this)">&nbsp;
                                    <input type="text" name="__duishu_2" id="__duishu_2" class="soonselect_w soonselect_w55" maxlength="2" onkeyup="limitrepeat(this)">&nbsp;
                                    <input type="text" name="__duishu_3" id="__duishu_3" class="soonselect_w soonselect_w55" maxlength="2" onkeyup="limitrepeat(this)">&nbsp;       
                                </td>
                            </tr>
                            <tr id="s11">
                                <td colspan="4"> 
                                    <span id="dan1">
                                        <span id="ss9">
                                            <input type="checkbox" name="__dan_chu" id="__dan_chu" onclick="__ss.__showdis(this,&#39;__dan_qu&#39;);">除
                                            <input type="checkbox" name="__dan_qu" id="__dan_qu" onclick="__ss.__showdis(this,&#39;__dan_chu&#39;);">取(<dl>单</dl>)
                                        </span>&nbsp;
                                        <span id="dsd1"><input type="checkbox" name="__dan_1" id="__dan_1"></span>
                                        <span id="dsd2"><input type="checkbox" name="__dan_2" id="__dan_2"></span>
                                        <span id="dsd3"><input type="checkbox" name="__dan_3" id="__dan_3"></span>
                                        <span id="dsd4"><input type="checkbox" name="__dan_4" id="__dan_4"></span>
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                    </span>
                                    <span id="shuang1">
                                        <span id="ss10">
                                            <input type="checkbox" name="__shuang_chu" id="__shuang_chu" onclick="__ss.__showdis(this,&#39;__shuang_qu&#39;);">除
                                            <input type="checkbox" name="__shuang_qu" id="__shuang_qu" onclick="__ss.__showdis(this,&#39;__shuang_chu&#39;);">取(<dl>双</dl>)
                                        </span>&nbsp;
                                        <span id="dss1"><input type="checkbox" name="__shuang_1" id="__shuang_1"></span>
                                        <span id="dss2"><input type="checkbox" name="__shuang_2" id="__shuang_2"></span>
                                        <span id="dss3"><input type="checkbox" name="__shuang_3" id="__shuang_3"></span>
                                        <span id="dss4"><input type="checkbox" name="__shuang_4" id="__shuang_4"></span>
                                    </span>
                                </td>
                            </tr>
                            <tr id="tr_452">
                                <td colspan="4">
                                    <img src="./hot.png" style="width:4%;"><input type="checkbox" id="452ding">XXX囗囗(4，5位) 
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <center>
                        <button type="button" onclick="loging();return false;" id="setsoonclass1" name="setsoonclass1" class="number_count number_w3">生成</button>
                        <button type="reset" onclick="__reset();" id="setsoonclass2" name="setsoonclass2" class="number_count number_w3">复位</button>
                    </center>
                    <span id="testshow"></span>
                </td>
            </tr>
            <tr>
            </tr>
        </tbody>
    </table>

<script type="text/javascript">
    getclassid(3);__ss.__showmeun(3);
     function changeFocus(id)
    { 
       if(event.keyCode==13){
        var id=id+1;
        $('__dingwei_'+id).focus();
       }
    }
</script>
</body></html>