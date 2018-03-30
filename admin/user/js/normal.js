
function set_is(v,ty,user_id){
    var val=v.prev("input").val();
    var hval=val-1;
    if(hval<0){
        hval=1;
    }
    $.ajax({
        type: "POST",
        url: "ajax_set_is.php",
        data: {'v':val,'ty':ty,'user_id':user_id},
        success: function(msg){
            v.prev("input").val(hval);
            if(msg==1){
                v.html("<font color='ff0000'>��ֹ</font>");
            }else if(msg==2){
                v.html("���_��");
            }else{
                v.html("���S");
            }
        }
    });
}

//�����~
function To_RMB()
{
    var whole = $("#cs").val();
    var limit_v=$("#kyx").val();
    limit_v=Number(limit_v);
    if(whole > limit_v){
        alert('��Ȳ��ܳ���'+limit_v);
        $("#cs").val(limit_v);
        whole=limit_v+"";
    }
    //���x�����cС��
    var num;
    var dig;
    if(whole.indexOf(".") == -1)
    {
        num = whole;
        dig = "";
    }
    else
    {
        num = whole.substr(0,whole.indexOf("."));
        dig = whole.substr( whole.indexOf(".")+1, whole.length);
    }

    //�D�Q��������
    var i=1;
    var len = num.length;

    var dw2 = new Array("","�f","�|");//��λ
    var dw1 = new Array("ʮ","��","ǧ");//С��λ
    var dw = new Array("","һ","��","��","��","��","��","��","��","��");//����������
    var k1=0;//ӋС��λ
    var k2=0;//Ӌ��λ
    var str="";

    for(i=1;i<=len;i++)
    {
        var n = num.charAt(len-i);
        if(n=="0")
        {
            if(k1!=0)
                str = str.substr( 1, str.length-1);
        }

        str = dw[Number(n)].concat(str);//������

        if(len-i-1>=0)//�����ֹ�����
        {
            if(k1!=3)//��С��λ
            {
                str = dw1[k1].concat(str);
                k1++;
            }
            else//����С��λ���Ӵ�λ
            {
                k1=0;
                var temp = str.charAt(0);
                if(temp=="�f" || temp=="�|")//����λǰ�]�����քt��ȥ��λ
                    str = str.substr( 1, str.length-1);
                str = dw2[k2].concat(str);
            }
        }


        if(k1==3)//С��λ��ǧ�t��λ�Mһ
        {
            k2++;
        }
    }
    if (str.length>=2){
        if (str.substr(0,2)=="һʮ") str=str.substr(1, str.length-1);
    }
    document.getElementById("RMB_XY").innerHTML = str;
}

function SubChk()
{
    if(!$("#top_id").val()){
        if($("#temppid").val()==""){
            document.all.temppid.focus();
            alert("Ո�x���ϼ�!!");
            return false;
        }
    }
    if($("#kauser").val()==""){
        $("#kauser").focus();
        alert("�˺ńձ�ݔ��!!");
        return false;
    }
    
    if($("#kapassword").val()==""){
        $("#kapassword").focus();
        alert("����Ո�ձ�ݔ��!!");
        return false;
    }
    
    if($("#xm").val()==""){
        $("#xm").focus();
        alert("���QՈ�ձ�ݔ��!!");
        return false;
    }
    
    if($("#cs").val()==""){
        $("#cs").focus();
        alert("�������~��Ո�ձ�ݔ��!!");
        return false;
    }
    if(confirm("�Ƿ�_�������Ñ�?")){
        return true;
    }else{
        return false;
    }
    
}
    function get_topyue(va){
        $.ajax({
            type: "post",
            url: 'ajax_get_top_yue.php',
            data: {'va':va},
            success: function(data){
                $('#topyue').html(data);
            },
            error: function(){
                //alert('������!!');
            }
        });
    }
    
     function get_user_is_czai(czai){
        $.ajax({
            type: "post",
            url: 'ajax_get_user_is_czai.php',
            data: {'czai':czai},
            success: function(data){
                $('#Find_Return').html(data);
            },
            error: function(){
                //alert('������!!');
            }
        });
    }
    
function get_top_percent(va){
    if(va==""){
        $("#sff_zc").html("");
        return false;
    }
    var v=new Array();
    v=va.split(",");
    $("#kyx").val(v[3]);
    $.ajax({
        type: "POST",
        url: "ajax_get_top_percent.php",
        data: {'va':va},
        success: function(msg){
            var ms=eval("("+msg+")");
            $("#sff_zc").html(ms.p);
            msg=Number(ms.p);
            var op='<option value="0">��ռ��</option>';
            for(var i=1;i<=msg;i++){
                op+="<option value=\""+i+"\" >"+i+"%</option>";
            }
            $("#sj").html(op);
            $("#sf").html(op);
            $("#abcd_plate").html(ms.plate);
        }
    });
}
function get_top_percent_for_update(va,percent_own,percent_top){
    if(va==""){
        $("#sff_zc").html("");
        return false;
    }
    var v=new Array();
    v=va.split(",");
    $("#kyx").val(v[3]);
    $.ajax({
        type: "POST",
        url: "ajax_get_top_percent.php",
        data: {'va':va},
        success: function(msg){
            var ms=eval("("+msg+")");
            $("#sff_zc").html(ms.p);
            msg=Number(ms.p);
            var op='<option value="0">��ռ��</option>';
            for(var i=1;i<=(msg-percent_own);i++){
                op+="<option value=\""+i+"\" ";
                  if(i==percent_top) {
                      op+="selected='selected'";
                  } 
                       op+=" >"+i+"%</option>";
            }
            $("#sj").html(op);
        }
    });
}

function lian_dong(th){
    var top=$("#sff_zc").text();
    top=Number(top);
    var op='<option value="0">��ռ��</option>';
    for(var i=1;i<=top-th;i++){
        op+="<option value=\""+i+"\" >"+i+"%</option>";
    }
    $("#sf").html(op);
}

function lian_dong2(th){
    var top=$("#sff_zc").text();
    top=Number(top);
    var op='<option value="0">��ռ��</option>';
    for(var i=1;i<=top-th;i++){
        op+="<option value=\""+i+"\" >"+i+"%</option>";
    }
    $("#sj").html(op);
}


function lian_dong_for_update(th,percent_own){
    var top=$("#sff_zc").text();
    top=Number(top);
    var op='';
    for(var i=percent_own;i<=top-th;i++){
        op+="<option value=\""+i+"\" >"+i+"%</option>";
    }
    $("#sf").html(op);
}
function lian_dong_for_update2(th,percent_own){
    var top=$("#sff_zc").text();
    top=Number(top);
    var op='';
    for(var i=percent_own;i<=top-th;i++){
        op+="<option value=\""+i+"\" >"+i+"%</option>";
    }
    $("#sj").html(op);
}

function SubChkedit(user_id){
   if($("#xm").val()==""){
        $("#xm").focus();
        alert("���QՈ�ձ�ݔ��!!");
        return false;
    }
    if($("#cs").val()==""){
        $("#cs").focus();
        alert("�������~��Ո�ձ�ݔ��!!");
        return false;
    }
    var now=$("#cs").val();
    var bottom_credit=0;
    $.ajax({
        type: "POST",
        url: "ajax_get_bottom_credit.php",
        data: {'user_id':user_id},
        async: false,
        success: function(msg){
            bottom_credit=msg;
        }
    });
    //bottom_credit=Number(bottom_credit);
    bottom_credit=parseFloat(bottom_credit);
    now=parseFloat(now);
    if(bottom_credit > now){
        $("#cs").focus();
        $("#cs").val(bottom_credit);
        To_RMB();
        var error="�������~�Ȳ��ܵ���"+bottom_credit+"!!"
        alert(error);
        return false;
    }
}

function SubChkSon(){
    if($("#kauser").val()==""){
        $("#kauser").focus();
        alert("�˺ńձ�ݔ��!!");
        return false;
    }
    
    if($("#kapassword").val()==""){
        $("#kapassword").focus();
        alert("����Ո�ձ�ݔ��!!");
        return false;
    }
    
    if($("#xm").val()==""){
        $("#xm").focus();
        alert("���QՈ�ձ�ݔ��!!");
        return false;
    }
    if(confirm("�Ƿ�_���������Ñ�?")){
        return true;
    }else{
        return false;
    }
}

function get_own_limit_percent(percent_own){
    var v=0;
    $("#sf option").each(function(){
        v=$(this).val();
        v=Number(v);
        if(v<percent_own){
            $(this).hide();
        }
    });
}

function chk_add_or_up_user(){
    var is=0;
    $("input[type='checkbox']").each(function(){
        if($(this).attr("checked")==true){
            is=1;
        }
    });
    if(is==0){
        alert("�̿����ٱ���ѡ��һ����");
        return false;
    }
    return true;
}

function istuishui(ty,th,power,user_id){
    var v=ty.val();
    url='reback.php?power='+power+'&user_id='+user_id;
    if(v>th){
        alert("����ˮֵ���ܴ���"+th);window.location.href= url; return false;
    }
    return true;
}




