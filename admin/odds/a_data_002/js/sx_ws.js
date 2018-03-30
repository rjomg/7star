function UpdateRate(oid,ty,th,o){
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
    var o_content=get_o_content(oid);
   $.post("ajax_set_rate.php",{'oid':oid,'o_content':o_content},function (msg){});
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
