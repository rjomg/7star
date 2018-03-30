$(function(){
    $(".ball").toggle(
    function () {
        $(this).addClass("yellow");
    },
    function () {
        $(this).removeClass("yellow");
    }
    ); 
        
        //aa();
});

function aa(){
    var v="你好";
    alert(v);
    $.post("aa.php",
    {'aa':v},
    function(msg){alert(msg);});
}

function UpdateRate(oid,ty,th,o,plate_num,t3){
    var bl=chk_rat_is_n();
    if(!bl){
        return false;
    }
    var v=parseFloat(th.val());
    if(ty==1){
        v+=o;
    }else if(ty==2){
        v-=o;
    }
    v=v.toFixed(4);
    th.val(v);
   $.post("ajax_set_rate.php",{'oid':oid,'t3':t3,'v':v,'plate_num':plate_num},function (msg){});
}

function get_o_content(oid){
    var dclass=$(".rate_set");
    if(oid==70 || oid==72){
        dclass=$(".rate_set2");
    }
    var str=",";
    var name="";
    var rate="";
    var is_lock="";
    var lock=0;
    var odds="1";
    var i=0;
    var str_ty=1;
    $(".ball").each(function(){
        lock=0;
        odds="1";
        rate="";
        name=$(this).text();
        //rate=dclass.eq(i).val();
        rate=parseFloat(dclass.eq(i).val());
        str_ty=get_str_type(oid);
        if(str_ty==1){
            is_lock=$("input.num_close").eq(i).attr("checked");
            if(is_lock==true){
                lock=1;
            }
            odds=$(".odd_total").eq(i).text();
        }else{
            odds=dclass.eq(i).next().next().next("input").val();
            //alert(odds);
        }
        str+=name+":"+rate+":"+lock+":"+odds+",";
        i++;
    });
    return str;
}

function select_array(th){
    var v=','+th.val()+',';
    var w;
    var b;
    $(".ball").each(function(){
        w=','+$(this).text()+',';
        //w=w.trim();
        b=v.indexOf(w);
        //alert(b+"/"+w+"/"+v);
        if(b!=-1){
            if(th.attr("checked")==true){
                $(this).addClass("yellow");
            }else{
                $(this).removeClass("yellow");
            }
            
        }
    });
}

function set_ab_rate(oid){
    var ma=$("#tmnum").val();
    var sm=$("#tmxx").val();
    var bs=$("#tmps").val();
    $.post(
    "ajax_set_ab_rate.php",
    {'oid':oid,'ma':ma,'sm':sm,'bs':bs},
    function (msg){
        if(msg==1){
            alert("设置成功！");
        }
    });
}

function unset_select(){
    $(".ball").removeClass("yellow");
}

function go_select(){
    var str='';
   $(".yellow").each(function (){
       str+=$(this).text()+',';
   });
   if(str==""){
       alert("请选择需要修改的对象！");
       return false;
   }
   $("#ocontent").val(str);
   return true;
}

function chk_bl(v){
    if(v<=0){
        alert("赔率设置不能为空！");
        return false;
    }else{
        return true;
    }
}

function get_str_type(oid){
    var ty=1;
    if(oid>15 && oid<33){
        ty=1;
    }else if(oid>31 && oid <43){
        ty=2;
    }else if(oid>68 && oid <73 ){
        ty=3;
    }
    return ty;
}

function chk_rat_is_n(){
    var i=-1;
    $("input[type='text']").each(function(){
        var v=$(this).val();
        if(v){
            if(isNaN(v)){
                i=1;
            }
        }
    });
    if(i==1){
        alert("赔率设置输入的必须是数字！");
        return false;
    }
    return true;
}




function change_a_b(ab,plate_num,t1){
    var t2=t1+"A";
    if(ab=="B"){
        t2=t1+"B";
    }else if(ab=="AB"){
        t2=t1+"AB";
    }
    window.location.href="tm.php?plate_num="+plate_num+"&t1="+t1+"&t2="+t2;
}

function go_single_set(uid,oid,plate_num,t1,t2,kx,ts,j){
    $.ajax({
        type: "POST",
        url: "ajax_set_sing.php",
        data: {'uid':uid,'oid':oid,'kx':kx,'ts':ts,'j':j},
        success: function(){
            alert( "设置成功！" );
            window.location.href="tm.php?plate_num="+plate_num+"&t1="+t1+"&t2="+t2;
        }
     }); 
}

function go_single_set2(url,uid,oid,plate_num,t1,t2,kx,ts,j){
    $.ajax({
        type: "POST",
        url: "ajax_set_sing.php",
        data: {'uid':uid,'oid':oid,'zc':kx,'ts':ts,'j':j},
        success: function(){
            alert( "设置成功！" );
            window.location.href=url+"?plate_num="+plate_num+"&t1="+t1+"&t2="+t2;
        }
     }); 
}

function change_plate(url,t1,t2,plate_num){
    window.location.href=url+"?plate_num="+plate_num+"&t1="+t1+"&t2="+t2;
}


