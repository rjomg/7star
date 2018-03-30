var bz=-1;
var xuanle=0;
function xuan_jizhong(z_type){
    window.location.href='lm.php?o='+z_type;
}

function my_select_type(ty,z_type){
    $("input[name=x_o_type3[]]").attr("checked",false);
    $("#dm1").val('');
    $("#dm2").val('');
    if(ty==2){
        switch(z_type){
            case 32:
                bz=2;
                break;
            case 33:
                bz=2;
                break;
            case 34:
                bz=2;
                break;
            case 35:
                bz=3;
                break;
            case 36:
                bz=3;
                break;
        }
    }else{
        bz=-1;
    }
}


function select_num(th){
    var v=th.val();
    var num=v.split(':');
    //alert(num[0]);
    if(xuanle < (bz-1)){
        xuanle++;
        $("#dm"+xuanle).val(num[0]);
        th.attr("disabled",true);
    }
//    var xznum=$("input[type=checkbox][name=x_o_type3[]][checked]").length;
//    if(xznum>13){
//       alert(xznum); return false;
//    }
}