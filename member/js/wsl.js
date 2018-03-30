var bz=-1;
var xuanle=0;
function xuan_jizhong(z_type,pan){
    window.location.href='wsl.php?o='+z_type+'&pan='+pan;
}

function my_select_type(ty,z_type){
    $("input[name=x_o_type3[]]").attr("checked",false);
    $("#dm1").val('');
    $("#dm2").val('');
    $("#dm3").val('');
    if(ty==2){
        switch(z_type){
            case 57:
                bz=2;
                break;
            case 58:
                bz=2;
                break;
            case 59:
                bz=3;
                break;
            case 60:
                bz=3;
                break;
            case 61:
                bz=4;
                break;
            case 62:
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
}