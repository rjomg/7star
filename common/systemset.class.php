<?php
class systemset extends mysql {
    public function update_animal_set($params,$url){
            $mod_content='';
            foreach ($params as $key => $v) {
                if($key=='w_close_type'){                  
                    $v=implode(',',$v);
                }elseif(!$params['w_close_type']){
                    $mod_content.="w_close_type='',";
                }if(!$params['w_yanzheng1']){
                    $mod_content.="w_yanzheng1='',";
                }if(!$params['w_yanzheng2345']){
                    $mod_content.="w_yanzheng2345='',";
                }if(!$params['w_yanzheng6']){
                    $mod_content.="w_yanzheng6='',";
                }if($key=='w_dress'){  
                    $v=str_replace("http://","",$v);
                }
                $mod_content.="$key='$v',";
            }
           // w_close_type
            if($mod_content)
                $mod_content=  substr ($mod_content, 0, -1);
            
            $this->update("animal_set", $mod_content, 'id=1', $url);
        }
        
        
    public function auto_animal(){
        $an=array('鼠','牛','虎','兔','龙','蛇','马','羊','猴','鸡','狗','猪');
        $sql="insert into animal (set_id,num,animal,color) values ";
        $q="";
        for($i=1;$i<13;$i++){
            for($j=1;$j<50;$j++){
                $color =  $this->auto_color($j);
                $k=12-(($j+12-$i)%12);
                if($k==12){
                    $k=0;
                }
                $animal=$an[$k];
                $q.="($i,$j,'$animal','$color'),";
            }
        }
        if($q){
            $q =  substr($q, 0,-1);
        }
        $this->query($sql.$q);
    }
    
    public function auto_color($num){
        $r=array(01,02,07,08,12,13,18,19,23,24,29,30,34,35,40,45,46);//红
        $g=array(05,06,11,16,17,21,22,27,28,32,33,38,39,43,44,49);//绿
        //$b=array(03,04,09,10,14,15,20,25,26,31,36,37,41,42,47,48);//蓝
        if(in_array($num, $r)){
            return 'r';
        }elseif (in_array($num, $g)) {
            return 'g';
        }else{
           return 'b'; 
        }
    } 
    
   
}
?>