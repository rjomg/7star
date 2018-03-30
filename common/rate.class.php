<?php
class rate extends mysql {
    function get_animal_table(){
        $sql="select set_animal from animal_set";
        $x=  $this->query($sql);
        $r=  $this->fetch_array($x);
        $set_id=$r['set_animal'];
        
        $animal=array();
        $query=  $this->select("animal", "*", "set_id=$set_id");
        while ($row = $this->fetch_array($query)) {
            if($row['num']<10){
                $row['num']="0".$row['num'];
            }
            $animal[$row['animal']].=$row['num'].',';
        }
        return $animal;
    }
    
    function get_rate($o_id,$user_id,$key='o_content'){
        if($user_id>0){
        $y =  $this->select("plate", "plate_num","1 order by plate_num desc limit 0,1");
        $z=  $this->fetch_array($y);
        $plate_num=$z['plate_num'];
        
        $x =  $this->select("odds_set", "*", "plate_num='$plate_num' and user_id=$user_id and o_id=$o_id");
        $r=  $this->fetch_array($x);
        $msg=  substr($r[$key], 1,-1);
        //echo $msg; return false;
        $ms =  explode(",", $msg);
        $ret=array();
        foreach ($ms as $v) {
            $o =  explode(":", $v);
            if($key!='o_content'){
                $ret[$o[0]] =  $o[1];
            }else{
                $ret[$o[0]] =  $o;
            }
        }
        return $ret;
        }
    }
    
    function get_otype_by_oid($oid){
        switch ($oid) {
            case 16:
                $str='特码A';
                break;
            case 17:
                $str='特码B';
                break;
            case 18:
                $str='正1特A';
                break;
            case 19:
                $str='正1特B';
                break;
            case 20:
                $str='正2特A';
                break;
            case 21:
                $str='正2特B';
                break;
            case 22:
                $str='正3特A';
                break;
            case 23:
                $str='正3特B';
                break;
            case 24:
                $str='正4特A';
                break;
            case 25:
                $str='正4特B';
                break;
            case 26:
                $str='正5特A';
                break;
            case 27:
                $str='正5特B';
                break;
            case 28:
                $str='正6特A';
                break;
            case 29:
                $str='正6特B';
                break;
            case 30:
                $str='正码A';
                break;
            case 31:
                $str='正码B';
                break;
            case 32:
                $str='二全中';
                break;
            case 33:
                $str='二中特';
                break;
            case 34:
                $str='特串';
                break;
            case 35:
                $str='三全中';
                break;
            case 36:
                $str='三中二';
                break;
            case 37:
                $str='五不中';
                break;
            case 38:
                $str='六不中';
                break;
            case 39:
                $str='七不中';
                break;
            case 40:
                $str='八不中';
                break;
            case 41:
                $str='九不中';
                break;
            case 42:
                $str='十不中';
                break;
            case 43:
                $str='特肖';
                break;
            case 45:
                $str='二肖';
                break;
            case 46:
                $str='三肖';
                break;
            case 47:
                $str='四肖';
                break;
            case 48:
                $str='五肖';
                break;
            case 49:
                $str='六肖';
                break;
            case 44:
                $str='一肖';
                break;
            case 50:
                $str='尾数';
            case 51:
                $str='二肖连[中]';
                break;
            case 52:
                $str='二肖连[不中]';
                break;
            case 53:
                $str='三肖连[中]';
                break;
            case 54:
                $str='三肖连[不中]';
                break;
            case 55:
                $str='四肖连[中]';
                break;
            case 56:
                $str='四肖连[不中]';
                break;
            case 57:
                $str='二尾连[中]';
                break;
            case 58:
                $str='二尾连[不中]';
                break;
            case 59:
                $str='三尾连[中]';                
                break;  
            case 60:
                $str='三尾连[不中]';
                break;
            case 61:
                $str='四尾连[中]';
                break;
            case 62:
                $str='四尾连[不中]';
                break;          
            case 69:
                $str='中二';
                break;
            case 70:
                $str='中特';
                break;
            case 71:
                $str='中三';
                break;
            case 72:
                $str='中二';
                break;
            default:
                break;
        }
        return $str;
    }
    
    
    
    function get_color($num){
        $num=0+$num;
        $f=",1,2,7,8,12,13,18,19,23,24,29,30,34,35,40,45,46,";
        //$b=",3,4,9,10,14,15,20,25,26,31,36,37,41,42,47,48,";
        $g=",5,6,11,16,17,21,22,27,28,32,33,38,39,43,44,49,";
        $x=strstr($f,",".$num.",");
        if($x){
            return "r";
        }else if(strstr($g,",".$num.",")){
            return "g";
        }else{
            return "b";
        }
    }
    
    function update_another_odd($oid,$plate_num,$user_id,$o_content="",$ab_content="") {
        //这里的设置方式是，A赔率不变，根据赔率差来改变B赔率的值
        $x = $this->select("oddsset_type", "*", "o_id={$oid}");
        $y = $this->fetch_array($x);
        if (strstr($y['o_typename'],"A")) {
            $fxxk_id = $oid + 1;
            $fxx_ty = 1;
        } else if (strstr($y['o_typename'],"B")) {
            if(empty($o_content)){
            $fxxk_id = $oid;
            $oid = $oid-1; 
            $fxx_ty = 1;
            }else{
            $fxxk_id = $oid - 1;  
            $fxx_ty = -1;
            }           
        } else {
            $fxxk_id = 0;
            $fxx_ty = 0;
        }
        if ($fxxk_id != 0) {
            if($user_id==1){
            $u =  $this->select("users", "user_id","(user_id=1 or top_id=1) and is_odds=0");
            while($uu= $this->fetch_array($u)){  
                $uu_arr[]=$uu['user_id'];
            }    
            //print_r($uu_arrs);exit;
            //$uu_arr=array_flip(array_flip($uu_arrs));//删除重复
            }else{
            $uu_arr=array($user_id);    
            }
            foreach ($uu_arr as $us){
            $dn = $this->select("odds_set", "*", "o_id={$fxxk_id} and user_id=$us and plate_num='$plate_num'");
            $dm = $this->fetch_array($dn);
            $do = $dm['o_content'];
            $doab = $dm['ab_content'];
            if (strstr($y['o_typename'],"B")) {
            $this->update("odds_set", "ab_content='$doab'", "o_id={$oid} and user_id=$us and plate_num='$plate_num'");    
            }
            $dp = explode(",", substr($do, 1, -1));
            $countdp=count($dp);
               foreach ($dp as $to){
                   $o_arr = explode(':', $to);
                       $o0[]=$o_arr[0];
                       //$o1[]=$o_arr[1];
                       $o2[]=$o_arr[2];
                       $o3[]=$o_arr[3];
               }
            
            $n = $this->select("odds_set", "*", "o_id={$oid} and user_id=$us and plate_num='$plate_num'");
            $m = $this->fetch_array($n);
            if($o_content && $o_content!=""){
                $o = $o_content;
            }else{
                $o = $m['o_content'];
            }
            $p = explode(",", substr($o, 1, -1));

            if($user_id==1){
                if($ab_content && $ab_content!=""){
                    $r = $ab_content;
                }else{
                    $r = $m['ab_content'];
                }
            }else{
                //这里由于分公司不能设置AB盘率差，因此这里读取公司的AB盘率差
                $adminn = $this->select("odds_set", "ab_content", "o_id={$oid} and user_id=1 and plate_num='$plate_num'");
                $adminm = $this->fetch_array($adminn);
                $r=$adminm['ab_content'];
            }
            $s = explode(",", substr($r, 1, -1));

            
            foreach ($s as $t) {
                $u = explode(":", $t);
                $w[$u[0]] = $u[1];
            }
            
            foreach ($p as $ij => $v) {
                $q = explode(":", $v);
                if ($q[0] < "50") {
                    $q1[]=$q[1]+$fxx_ty * $w['码'];
                } else if ($q[0] == '红波' || $q[0] == '绿波' || $q[0] == '蓝波') {
                    $q1[]=$q[1]+$fxx_ty * $w['波色'];
                } else {
                    $q1[]=$q[1]+$fxx_ty * $w['双面'];
                }
            }
  
                for ($i = 0; $i < $countdp; $i++) {
                   $to=$o0[$i].':'.$q1[$i].':'.$o2[$i].':'.$o3[$i];
                   $toi.=$to.',';
                }
                $fxxk_content=','.trim($toi, ',').',';
//            foreach ($p as $ij => $v) {
//
//                $q = explode(":", $v);
//                //if($q[0]==)
//                if ($q[0] < "50") {
//                    $q[1]+=$fxx_ty * $w['码'];
//                } else if ($q[0] == '红波' || $q[0] == '绿波' || $q[0] == '蓝波') {
//                    $q[1]+=$fxx_ty * $w['波色'];
//                } else {
//                    $q[1]+=$fxx_ty * $w['双面'];
//                }
//                if ($q[1] < 0) {
//                    $q[1] = 0;
//                }
//                if($o2[$ij]){
//                    
//                }else{
//                    $q[2]=0;
//                }
//                if($o3[$ij]){
//                    if($o0[$ij]=="$q[0]"){
//                        $q[2]=$o2[$ij];
//                    }
//                }else{
//                    $q[3]=0;
//                }
//                //$q[2]=$o2[$ij];
//                //$q[3]=$o3[$ij];
//                $p[$ij] = implode(":", $q);
//            }
            //$fxxk_content = "," . implode(",", $p) . ",";
           // echo $fxxk_content;
            $this->update("odds_set", "o_content='{$fxxk_content}',ab_content='$r'", "o_id={$fxxk_id} and user_id=$us and plate_num='$plate_num'"); 
            unset($to);
            unset($toi);
            unset($fxxk_content);
            unset($q1);
            unset($o0);
            unset($o2);
            unset($o3);
        }
        }
    }
    
  public function update_odd_down($oid,$plate_num,$o_content) {
//管理员更新赔率，下级同步更新，增加多少减少多少同步更新，并且根据赔率差进行更新
        $x = $this->select("oddsset_type", "*", "o_id={$oid}");
        $y = $this->fetch_array($x);
        if (strstr($y['o_typename'],"A")) {
            $fxxk_id = $oid + 1;
            $fxx_ty = 1;
        } else if (strstr($y['o_typename'],"B")) {
            $fxxk_id = $oid - 1;  
            $fxx_ty = -1;    
        } else {
            $fxxk_id = 0;
            $fxx_ty = 0;
        }
        if($fxxk_id==0){
//            if($oid==69){
//               $oid_arrs=array(69,70);
//            }elseif($oid==71){
//               $oid_arrs=array(71,72);
//            }else{
               $oid_arrs=array($oid);   
//            }
        }else{
        $oid_arrs=array($oid,$fxxk_id);    
        }
        
        if ($oid_arrs[0] != 0) {
                //这里由于分公司不能设置AB盘率差，因此这里读取公司的AB盘率差
                $adminn = $this->select("odds_set", "o_content,ab_content", "o_id={$oid} and user_id=1 and plate_num='$plate_num'");
                $adminm = $this->fetch_array($adminn);
                $r=$adminm['ab_content'];
                $o=$adminm['o_content'];
               // echo '<br>'.$o;exit;
            $p = explode(",", substr($o, 1, -1));//删除前后逗号
            $s = explode(",", substr($r, 1, -1));
            $ot= explode(",", substr($o_content, 1, -1));
            $countpp=count($p);
               foreach ($p as $pp){
                   $p_arr = explode(':', $pp);
                       //$p0[]=$p_arr[0];
                       $p1[]=$p_arr[1];
                       //$p2[]=$p_arr[2];
                       //$p3[]=$p_arr[3];
               }
               foreach ($ot as $ott){
                   $ot_arr = explode(':', $ott);
                       //$ot0[]=$ot_arr[0];
                       $ot1[]=$ot_arr[1];
                       $ot2[]=$ot_arr[2];
                       //$ot3[]=$ot_arr[3];
               }
               
               for ($i = 0; $i < $countpp; $i++) {                  
                   $cha_z[]=$p1[$i]-$ot1[$i];//算出所有号码的差值
                   $co_z[]=$ot2[$i];//是否关闭
                }
                //print_r($cha_z);
                
            $u =  $this->select("users", "user_id","(user_id=1 or top_id=1) and is_odds=0");
            while($uu= $this->fetch_array($u)){  
                $uu_arr[]=$uu['user_id'];
            }    

            foreach ($uu_arr as $us){            
                foreach ($oid_arrs as $oooid){
                $n = $this->select("odds_set", "o_content", "o_id={$oooid} and user_id=$us and plate_num='$plate_num'");
                $m = $this->fetch_array($n);
                $mm = $m['o_content'];

                $mp = explode(",", substr($mm, 1, -1));
                $countmp=count($mp);
                   foreach ($mp as $mo){
                       $mo_arr = explode(':', $mo);
                           $mo0[]=$mo_arr[0];
                           $mo1[]=$mo_arr[1];
                           $mo2[]=$mo_arr[2];
                           $mo3[]=$mo_arr[3];
                   }            
                    for ($mi = 0; $mi < $countmp; $mi++) {
                       $mpo=$mo0[$mi].':'.($mo1[$mi]-$cha_z[$mi]).':'.$co_z[$mi].':'.$mo3[$mi];
                       $mpoi.=$mpo.',';
                    }
                    $mp_content=','.trim($mpoi, ',').',';
                //echo '<br>'.$mp_content;exit;

                $this->update("odds_set", "o_content='{$mp_content}',ab_content='$r'", "o_id={$oooid} and user_id=$us and plate_num='$plate_num'"); 

                unset($mpo);
                unset($mpoi);
                unset($mp_content);
                unset($mo0);
                unset($mo1);
                unset($co_z);
                unset($mo3);
                }
        }
        }
    }
    
    function get_o_content_str($ty,$rate_array, $all_set) {
        $str=",";
        switch ($ty) {
            case 1:
                foreach ($rate_array as $i => $v) {
                    if ($i < '50') {
                        $j = $i % 2;
                        if ($j == 1) {
                            $v[1] = $all_set;
                        }
                    }
                    $str.=implode(":", $v) . ",";
                }

                break;
            case 2:
                foreach ($rate_array as $i => $v) {
                    if ($i < '50') {
                        $j = $i % 2;
                        if ($j == 0) {
                            $v[1] = $all_set;
                        }
                    }
                    $str.=implode(":", $v) . ",";
                }

                break;
            case 3:
                foreach ($rate_array as $i => $v) {
                    if ($i < '50') {
                        if ($i > '24') {
                            $v[1] = $all_set;
                        }
                    }
                    $str.=implode(":", $v) . ",";
                }

                break;
            case 4:
                foreach ($rate_array as $i => $v) {
                    if ($i < '25') {
                        $v[1] = $all_set;
                    }
                    $str.=implode(":", $v) . ",";
                }
                break;
            case 5:
                foreach ($rate_array as $i => $v) {
                    if ($i < '50') {
                        $c = $this->get_color($i);
                        if ($c == "r") {
                            $v[1] = $all_set;
                        }
                    }
                    $str.=implode(":", $v) . ",";
                }
                break;
            case 6:
                foreach ($rate_array as $i => $v) {
                    if ($i < '50') {
                        $c = $this->get_color($i);
                        if ($c == "g") {
                            $v[1] = $all_set;
                        }
                    }
                    $str.=implode(":", $v) . ",";
                }
                break;
            case 7:
                foreach ($rate_array as $i => $v) {
                    if ($i < '50') {
                        $c = $this->get_color($i);
                        if ($c == "b") {
                            $v[1] = $all_set;
                        }
                    }
                    $str.=implode(":", $v) . ",";
                }
                break;
            case 8:
                foreach ($rate_array as $i => $v) {
                    if ($i < '50') {
                        $v[1] = $all_set;
                    }
                    $str.=implode(":", $v) . ",";
                }
                break;
            case 9:
                foreach ($rate_array as $i => $v) {
                        $v[1] = $all_set;
                    $str.=implode(":", $v) . ",";
                }
                break;
           case 11:
               
                foreach ($rate_array as $i => $v) {
                    if($i=="红单" || $i=="绿单" || $i=="蓝单"){
                        $v[1] = $all_set;
                    }
                    $str.=implode(":", $v) . ",";
                }
                break;
           case 12:
                foreach ($rate_array as $i => $v) {
                      if($i=="红双" || $i=="绿双" || $i=="蓝双"){
                        $v[1] = $all_set;
                    }
                    $str.=implode(":", $v) . ",";
                }
                break;
           case 13:
                foreach ($rate_array as $i => $v) {
                       if($i=="红大" || $i=="绿大" || $i=="蓝大"){
                        $v[1] = $all_set;
                    }
                    $str.=implode(":", $v) . ",";
                }
                break;
           case 14:
                foreach ($rate_array as $i => $v) {
                      if($i=="红小" || $i=="绿小" || $i=="蓝小"){
                        $v[1] = $all_set;
                    }
                    $str.=implode(":", $v) . ",";
                }
                break;
            default:
                break;
        }
        return $str;
    }
    
    
    function get_call_back_url($oid){
        if($oid>15 && $oid<32){
            $url="odds.php?o=".$oid;
        }else if($oid>31 && $oid<37){
            $url="lm.php?o=".$oid;
        }else if ($oid==69) {
            $url="lm.php?o=33";
        }else if($oid==71){
            $url="lm.php?o=36";
        }else if($oid>36 && $oid<43){
            $url="bz.php?o=".$oid;
        }else if($oid>42 && $oid<51){
            $url="tqws.php";
        }else if($oid>50 && $oid<57){
            $url="sql.php";
        }else if($oid>56 && $oid<63){
            $url="wsl.php";
        }else if($oid==14){
            $url="bb.php";
        }else if($oid>62 && $oid<69){
            $url="gg.php";
        }
        return $url;
    }
    
   function get_call_back_url2($oid){
        if($oid>15 && $oid<18){
            $url="tm.php?spul=1";
        }else if($oid>17 && $oid<20){
            $url="tm.php?t1=正1特&t2=正1特AB&spul=2";
        }else if($oid>19 && $oid<22){
            $url="tm.php?t1=正2特&t2=正2特AB&spul=3";
        }else if($oid>21 && $oid<24){
            $url="tm.php?t1=正3特&t2=正3特AB&spul=4";
        }else if($oid>23 && $oid<26){
            $url="tm.php?t1=正4特&t2=正4特AB&spul=5";
        }else if($oid>25 && $oid<28){
            $url="tm.php?t1=正5特&t2=正5特AB&spul=6";
        }else if($oid>27 && $oid<30){
            $url="tm.php?t1=正6特&t2=正6特AB&spul=7";  
        }else if($oid>29 && $oid<32){
            $url="tm.php?t1=正码&t2=正码AB&spul=8";            
        }
        return $url;
    }    
    
//    function get_abcd_set(){
//        $x=  $this->select("abcd_rate", "*", "1 order by oa asc");
//    }
}
?>