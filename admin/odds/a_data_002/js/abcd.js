function abcd_submit(){
    var i=-1;
    $(".input_abcd").each(function(){
        var v=$(this).val();
        if(isNaN(v)){
            i=1;
        }
    });
    if(i==1){
        alert("赔率设置输入的必须是数字！");
        return false;
    }
}


