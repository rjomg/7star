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

function UpdateRate(i,t3,oid,ty,th,th0,oth,o){
    var thnew=th.val();
    var bl=chk_rat_is_n();
    if(!bl){
        return false;
    }
   
    $.post("ajax_get_synchro_rate.php",{'o_id':oid,'t3':t3,'ty':ty,'oth':oth,'o':o,'thnew':thnew},function (msg){
            th.val(msg.replace(/[ ]/g,""));//正则去掉空格
//            if(oid >= 16 && oid <=31){
//            url='odds.php?o='+oid;
//            }else if(oid >=32 && oid <=36  || (oid >=69 && oid <=72)){
//                if(oid >=69 && oid <=72){
//                    if(oid >=71 && oid <=72){
//                        url='lm.php?o=36';
//                    }else{             
//                        url='lm.php?o=33'; 
//                    }
//                }else{
//                   url='lm.php?o='+oid;  
//                }
//            }else if((oid >=37 && oid <=42)){
//            url='bz.php?o='+oid;
//            }else if(oid ==14){
//            url='bb.php';
//            }
//            if(msg>th0){
//                alert("赔率设置不能大于上级");
//                window.open(url,'_self');
//                //window.location.href= url; 
//                return false;
//            }
    });
//    var v=parseFloat(th.val());
//    if(ty==1){
//        v+=o;
//    }else if(ty==2){
//        v-=o;
//    }
//    v=v.toFixed(4);
//    th.val(v);
    
//    var o_content=get_o_content(oid);
////    alert(o_content); return false;
//   $.post("ajax_set_rate.php",{'oid':oid,'o_content':o_content},function (msg){});
 //  ajax_view_caozuo();
     get_synchro_company_rate(oid,t3,i);
}

function ajax_view_caozuo(){
    var view_caozuo_true=1;
            $.ajax({
                type: "post",
                url: "ajax_view_caozuo.php",
                data: {'view_caozuo':view_caozuo_true},
                success: function(data){
                    $('#view_caozuo').html(data);
                },
                error: function(){
                    //alert('出错了!!');
                }
            });
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

function go_select(ty,v,oid){
    var bl=chk_rat_is_n();
    if(!bl){
        return false;
    }
     v=parseFloat(v);
    if(ty==1){
        v=-v;
    }
    var str=",";
    var str2=",";
    var name="";
    var rate="";
    var rate2="";
    var odds2="";
    var is_lock="";
    var lock=0;
    var odds="";
    var i=0;
    var css="";
    var str_ty=1;
    $(".ball").each(function(){
        name=$(this).text();
        rate=$(".rate_set").eq(i).val();
        str_ty=get_str_type(oid);
        if(str_ty==1){
            is_lock=$(this).next("td").children().children("input.num_close").attr("checked");
            if(is_lock==true){
                lock=1;
            }
            odds=$(this).next().next().text();
        }else{
            if(str_ty==3){
                rate2=$(".rate_set2").eq(i).val();
                odds2=$(".rate_set2").eq(i).next().next().next("input").val();
                if(!odds2 || odds2==""){
                odds2=0; 
                }
                rate2=parseFloat(rate2);
            }
            odds=$(".rate_set").eq(i).next().next().next("input").val();
        }
        rate=parseFloat(rate);
        css=$(this).attr("class");
        if(css.indexOf("yellow")!=-1){
            rate+=v;
            rate2+=v;
        }
        str+=name+":"+rate+":"+lock+":"+odds+",";
        if(str_ty==3){
            str2+=name+":"+rate2+":"+lock+":"+odds2+",";
        }
        i++;
    });
    $("#ocontent").val(str);
    $("#ocontent2").val(str2);
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


function get_synchro_company_rate(oid,t3,i){
        $.ajax({
            type: "post",
            url: 'ajax_get_synchro_company_rate.php',
            data: {'o_id':oid,'t3':t3},
            success: function(data){
                if(i<10){
                   $('#synchro_company_rate0'+i).html(data);  
                }else{
                   $('#synchro_company_rate'+i).html(data);  
                }
            },
            error: function(){
               // alert('出错了!!');
            }
        });
}


