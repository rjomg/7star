var bz=-1;
var xuanle=0;
function xuan_jizhong(z_type,pan){
    window.location.href='bz.php?o='+z_type+'&pan='+pan;
}

function my_select_type(ty,z_type){
    $("input[name=x_o_type3[]]").attr("checked",false);
    $("#dm1").val('');
    $("#dm2").val('');
    $("#dm3").val('');
    $("#dm4").val('');
    $("#dm5").val('');
    $("#dm6").val('');
    $("#dm7").val('');
    $("#dm8").val('');
    $("#dm9").val('');
    if(ty==2){
        switch(z_type){
            case 37:
                bz=5;
                break;
            case 38:
                bz=6;
                break;
            case 39:
                bz=7;
                break;
            case 40:
                bz=8;
                break;
            case 41:
                bz=9;
                break;
            case 42:
                bz=10;
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