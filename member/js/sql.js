var bz=-1;
var xuanle=0;
function xuan_jizhong(z_type,pan){
    window.location.href='sql.php?o='+z_type+'&pan='+pan;
}

function my_select_type(ty,z_type){
    $("input[name=x_o_type3[]]").attr("checked",false);
    $("#dm1").val('');
    $("#dm2").val('');
    $("#dm3").val('');
    if(ty==2){
        switch(z_type){
            case 51:
                bz=2;
                break;
            case 52:
                bz=2;
                break;
            case 53:
                bz=3;
                break;
            case 54:
                bz=3;
                break;
            case 55:
                bz=4;
                break;
            case 56:
                bz=4;
                break;
        }
    }else{
        bz=-1;
    }
}


function select_num(th){
    var v=th.val();
    var num=v.split(':');
   // alert(num[0]);
    if(xuanle < (bz-1)){
        xuanle++;
        $("#dm"+xuanle).val(num[0]);
        th.attr("disabled",true);
    }
//    var xznum=$("input[type=checkbox][name=x_o_type3[]][checked]").length;
//    if(xznum>6){
//        $("input[name=x_o_type3[]]:checked").attr('disabled', false);
//       alert('最多选择6个');
//    }
}