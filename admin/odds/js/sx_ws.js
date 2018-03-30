function UpdateRate(t3,oid,ty,th,oth,o){
    var thnew=th.val();
    var bl=chk_rat_is_n();
    if(!bl){
        return false;
    }
    
    $.post("ajax_get_synchro_rate.php",{'o_id':oid,'t3':t3,'ty':ty,'oth':oth,'o':o,'thnew':thnew},function (msg){
            th.val(msg.replace(/[ ]/g,""));//正则去掉空格
    });
  // ajax_view_caozuo();
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
   var str=",";
   var i=0;
   var name="";
   var rate="";
   var close="";
   var total="";
   var is_lock=0;
   $(".name"+oid).each(function(){
       is_lock=0;
       name=$(this).val();
       //rate=$(".rate_set"+oid).eq(i).val();
       rate=parseFloat($(".rate_set"+oid).eq(i).val());
       close=$(".num_close"+oid).eq(i).attr("checked");
       if(close==true){
           is_lock=1;
       }
       total=$(".odd_total"+oid).eq(i).text();
       str+=name+":"+rate+":"+is_lock+":"+total+",";
       i++;
   });
   return str;
}
function chk_bl(v){
    if(v<=0){
        alert("赔率设置不能为空！");
        return false;
    }else{
        return true;
    }
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
