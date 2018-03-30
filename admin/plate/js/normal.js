function change_plate_zt(th,thi,plate_num,end,now,is_auto,plate_time_satrt,special_time_end,normal_time_end){
    var v=thi.val();
    if(v==1){
        if(end < now){
            alert("封盘时间已过，请修改封盘时间，再开盘");
            return false;
        }
        v=0;
    }else{v=1;}
    $.post("ajax_plate_zt.php",{'zt':v,'plate_num':plate_num,'now':now,'is_auto':is_auto,'plate_time_satrt':plate_time_satrt,'special_time_end':special_time_end,'normal_time_end':normal_time_end},function (msg){
        if(msg!=""){
            thi.val(v);
            if(v==1){
                th.val("正在封盘中...");
                th.css("color","red");
            }else{
                th.val("正在开盘中...");
                th.css("color","blue");
            }
        }
    }); 
}

function plate_time_send(v,plate_num){
    var k=$("input[name='plate_time_satrt']").val();
    if(k>v){
        alert("开盘时间不能大于封盘时间！");
        return false;
    }
    $.post("ajax_plate_time.php",{'end_time':v,'plate_num':plate_num},function (msg){
        if(msg!=""){
            alert("送出成功！");
            $("#normal_time_end").val(v);
            $("#special_time_end").val(v);
            $("#plate_time_end").val(v);
            $("#wardopen").val(v);
        }
    });
}

function is_auto_set(v,plate_num,plate_time_satrt,special_time_end,normal_time_end){
    $.post("ajax_is_auto.php",{'is_auto':v,'plate_num':plate_num,'plate_time_satrt':plate_time_satrt,'special_time_end':special_time_end,'normal_time_end':normal_time_end},function (msg){
        if(msg!=""){
            alert("设置成功！");
        }
    });
}
function chk_plate_time(){
    var z_f=$("input[name='normal_time_end']").val();
    var t_f=$("input[name='special_time_end']").val();
    var zong_f=$("input[name='plate_time_end']").val();
    var k=$("input[name='plate_time_satrt']").val();
    if($("#qs").val().length!=5 || isNaN($("#qs").val())){
        alert("请输入7位正确期数数字！");
        $("#qs").focus();
        return   false;   
    }
    if(k>z_f){
        alert("开盘时间不能大于正码封盘时间！");
        return false;
    }
    if(k>t_f){
        alert("开盘时间不能大于特码封盘时间！");
        return false;
    }
    if(k>zong_f){
        alert("开盘时间不能大于封盘时间！");
        return false;
    }
    if(z_f > zong_f){
        alert("正码封盘时间不能大于总封盘时间！");
        return false;
    }
    if(t_f > zong_f){
        alert("特码封盘时间不能大于总封盘时间！");
        return false;
    }
    
}

function tongbukaijiang(plate_num){
    $.post("ajax_kaijiang.php",{'plate_num':plate_num},function (msg){
        if(msg!=""){
            alert("开奖成功！");window.location.href='his.php';
        }
    });
}
