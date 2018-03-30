<?php


class immediate extends mysql {
    function get_num49(){
        $x=array();
        for($i=1;$i<50;$i++){
            if($i<10)$i='0'.$i;
            $x[]=$i;
        }
        return $x;
    }
    function get_type_not_num_tm_to_zm($o_type_name){
        if($o_type_name=='����'){
        return array("�ص�","�ش�","�ϵ�","βС","��˫","��С","��˫","β��","�첨","�̲�","����","����","Ұ��");
        }elseif($o_type_name=='����'){
        return array("�ܵ�","��˫","�ܴ�","��С");
        }else{
        return array("��","��","�ϵ�","βС","˫","С","��˫","β��","�첨","�̲�","����","����","Ұ��");
        }
    }
    
    function get_plate(){
        $y =  $this->select("plate", "plate_num","1 order by plate_num desc limit 0,1");
        $z=  $this->fetch_array($y);
        return $z['plate_num'];
    }
    /*
     * @$type ����3�����飬�ο�get_type_not_num_tm_to_zm��get_num49����ֵ
     * @$user_id ��ǰ�û�id
     * @$plate_num����
     * @$t1 ����1
     * @$t2 ����2
     * @$user_power ��ǰ�û�Ȩ��
     * @$is_order �Ƿ�ռ������ 1���򣬷�������(��ѡ��Ĭ������)
     * @kx ����ֵ
     */
    function get_imm_tm_to_zm_by_num($type,$user_id,$plate_num,$t1,$t2,$user_power,$kx=0,$is_order=1,$ab=0){
        //print_r($type);
        //echo $type.'/user:'.$user_id.'/plate_num:'.$plate_num.'/t1:'.$t1.'/t2:'.$t2.'/power:'.$user_power.'/kx:'.$kx.'/or:'.$is_order;
        if($ab){
           $absa=$t1.'A';
           $absb=$t1.'B';
           $tiaojian="(a.o_type2='$absa' || a.o_type2='$absb')"; 
        }else{
           $tiaojian="a.o_type2='$t2'"; 
        }
        //$oid=  $this->change_oid_or_oname(0,$t2);
        //$rate_array=  $this->get_rate($oid, $user_id, $plate_num);
        $imm_detail=array();
        foreach($type as $i){
            $sql="select a.*,a.is_fly as i_fly,b.is_fly as s_fly from orders a left join users b on a.topf_id=b.user_id where a.plate_num='$plate_num' and $tiaojian and a.o_type3='$i'";
            $x =  $this->query($sql);
            
            $total=0;//�ܶ�
			$pl=0;
			$lb=0;
			$pla=0;
            $percent=0;//ռ��ֵ
            $rate=0;//����
            $yl=0;//Ԥ��ӯ��
            $zf=0;//�߷�
            $yf=0;//�ѷ�
            //echo $sql;return false;
            while($r =  $this->fetch_array($x)){
               switch ($user_power) {
                    case 1:
                       if($r['i_fly']==0){
                           //if($r['topd_id']!=$r['user_id']){
                          $total+=abs($r['orders_y']);//��Ա����ע���
						  $pl+=abs($r['orders_p']);
						  $lb+=abs($r['orders_p'])/abs($r['orders_p']);
                          $percent+=round($r['orders_y']*$r['g_z']/100,1);
                          // }
                        }else if($r['i_fly']==1){
                            if($r['s_fly']==0){
                                $total+=abs($r['orders_y']);//�߷ɹ�ȫ��˾���
                                $percent+=$r['orders_y'];
                            }else if($r['s_fly']==1){
                                $total+=abs($r['orders_y']);//�߷ɹ�ֹ�˾���
                                $percent+=round($r['orders_y']*$r['g_z']/100,1);    
                            }else if($r['s_fly']==2){
                                //$total+=round(abs($r['orders_y'])*$r['g_z']/100,1);//�����������������䵽ȫ��˾���
                                $total+=abs($r['orders_y']);//�����������������䵽ȫ��˾���
                                $percent+=round($r['orders_y']*$r['g_z']/100,1);
                            }
                        }
                       
                       if($r['user_id']==$user_id){
                          //$total+=$r['orders_y'];//�Լ��߷ɽ��
                          //$percent-=$r['orders_y'];
                          $yf+=$r['orders_y'];
                       }
                       break;
                   case 2:
                       if($r['topf_id']==$user_id && $r['user_id']!=$user_id){
                            if($r['i_fly']==0 ){
                               //if($r['topd_id']!=$r['user_id']){
                                    $total+=$r['orders_y'];//��Ա����ע���
                                    $percent+=round($r['orders_y']*$r['f_z']/100,1);
									 $pl+=abs($r['orders_p']);
						  $lb+=abs($r['orders_p'])/abs($r['orders_p']);
                               // }
                            }else if($r['i_fly']==1){
                                if($r['s_fly']==1){
                                    $total+=$r['orders_y'];//�߷ɹ�ֹ�˾���
                                    $percent+=$r['orders_y'];
                                }else if($r['s_fly']==2){
                                    //$total+=round($r['orders_y']*$r['f_z']/100,1);//�����������������䵽�ֹ�˾���
                                    $total+=$r['orders_y'];//�����������������䵽�ֹ�˾���
                                    $percent+=round($r['orders_y']*$r['f_z']/100,1);
                                }
                            }
                       }
                       if($r['user_id']==$user_id){
                            $total+=$r['orders_y'];//�Լ��߷ɽ��
                            $percent-=$r['orders_y'];
                            $yf+=$r['orders_y'];
                        }
                       break;
                   case 3:
                       if($r['topgd_id']==$user_id && $r['user_id']!=$user_id){
                            if($r['i_fly']==0){
                                //if($r['topd_id']!=$r['user_id']){
                                    $total+=$r['orders_y'];//��Ա����ע���
                                    $percent+=round($r['orders_y']*$r['gd_z']/100,1);
									 $pl+=abs($r['orders_p']);
						  $lb+=abs($r['orders_p'])/abs($r['orders_p']);
                               // }
                            }else if($r['s_fly']==2 && $r['i_fly']==1){
                                //$total+=round($r['orders_y']*$r['gd_z']/100,1);//�����������������䵽�ֹ�˾���
                                $total+=$r['orders_y'];//�����������������䵽�ֹ�˾���
                                $percent+=round($r['orders_y']*$r['gd_z']/100,1);
                            }
                       }
                       if($r['user_id']==$user_id){
                            $total+=$r['orders_y'];//�Լ��߷ɽ��
                            $percent-=$r['orders_y'];
                            $yf+=$r['orders_y'];
                        }
                       break;
                   case 4:
                       if($r['topzd_id']==$user_id && $r['user_id']!=$user_id){
                            if($r['i_fly']==0){
                                //if($r['topd_id']!=$r['user_id']){
                                    $total+=$r['orders_y'];//��Ա����ע���
                                    $percent+=round($r['orders_y']*$r['zd_z']/100,1);
									 $pl+=abs($r['orders_p']);
						  $lb+=abs($r['orders_p'])/abs($r['orders_p']);
                                //}
                            }else if($r['s_fly']==2 && $r['i_fly']==1){
                                //$total+=round($r['orders_y']*$r['zd_z']/100,1);//�����������������䵽�ֹ�˾���
                                $total+=$r['orders_y'];//�����������������䵽�ֹ�˾���
                                $percent+=round($r['orders_y']*$r['zd_z']/100,1);
                            }
                       }
                       if($r['user_id']==$user_id){
                            $total+=$r['orders_y'];//�Լ��߷ɽ��
                            $percent-=$r['orders_y'];
                            $yf+=$r['orders_y'];
                        }
                       break;
                    case 5:
                       if($r['topd_id']==$user_id && $r['user_id']!=$user_id){
                            if($r['i_fly']==0){
                                //if($r['topd_id']!=$r['user_id']){
                                    $total+=$r['orders_y'];//��Ա����ע���
                                    $percent+=round($r['orders_y']*$r['d_z']/100,1);
									 $pl+=abs($r['orders_p']);
						  $lb+=abs($r['orders_p'])/abs($r['orders_p']);
                               // }
                            }else if($r['s_fly']==2 && $r['i_fly']==1){
                                //$total+=round($r['orders_y']*$r['d_z']/100,1);//�����������������䵽�ֹ�˾���
                                $total+=$r['orders_y'];//�����������������䵽�ֹ�˾���
                                $percent+=round($r['orders_y']*$r['d_z']/100,1);
                            }
                       }
                       if($r['user_id']==$user_id){
                           //echo '<br />'.$i.':'.$r['orders_y'].'<br />';
                            $total+=$r['orders_y'];//�Լ��߷ɽ��
                            $percent-=$r['orders_y'];
                            $yf+=$r['orders_y'];
                        }
                       break;

                    default:
                        break;
                }
                $ratep+=$r['zc'];
				
				$pla=$pl/$lb*$percent;

               
            }
//            if($rate==0){//����Ӧ���ǲ����ݿ�ģ�������д��43.2
//                $rate=$rate_array[$i][1];
//                if(!$rate)$rate="43.2";
//            }
            $yl=-sprintf("%.1f", $pla);
            if($percent>0){
                $zf=$percent;
            }
            if($yl<0){
                $zf= (int)((-$yl-$kx)/$rate);
            }
            //$zf-=$yf;
            if($zf<0)$zf=0;
            
//            echo $total.',';
            //�ճ�����
            $imm_detail[]=array('type3'=>$i,'total'=>$total,'zc'=>$percent,'zf'=>$zf,'yf'=>$yf,'pl'=>$rate,'yl'=>$yl);
        }
        if($is_order==1){
            //�Դ����������鰴ĳ�н�������
            usort($imm_detail, array("immediate","cmp"));
        }
        return $imm_detail;
    }
    
    function cmp($a,$b){//���������
        if($a['zc']>$b['zc']){
            return -1;
        }else if($a['zc']==$b['zc']){
            if($a['type3']>$b['type3']){
                return 1;
            }else{
                return -1;
            }
        }else{
            return 1;
        }
    }
    
    function get_color($num){//��ɫ�ж�
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
    
    /*
     * ������������
     * $o_id  ��������id
     * $user_id�û���
     * $plate_num����
     * ��$key��ʱû�õ���
     * 
     * ���������ʽ
     * array��"type3"=>explode(���ݿ��ַ�������
     * $x[48][1]=$rate;
     */
    function get_rate($o_id,$user_id,$plate_num,$key='o_content'){
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
    
    function get_single_set($user_id,$oid){//��ѯ����
        $query=  $this->select("single_set", "*", "user_id=$user_id and `o_id`='$oid'");
        $x=  $this->fetch_array($query);
        return $x;
    }
    
    function update_single_set($user_id,$oid,$params){//��������
        if(is_array($params)){
            $up="";
            foreach ($params as $k => $v) {
                $up.=$k."='$v',";
            }
            if($up) $up=  substr ($up, 0,-1);
            $this->update("single_set", $up, "user_id=$user_id and `o_id`='$oid'");
        }
    }
    function get_right_total($right){
        $total=0;
        foreach($right as $v){
            $total+=$v[1];
        }
        return $total;
    }
    function get_total_for_r($user_id, $plate_num, $user_power){
        $t1=array('����','��1��','��2��','��3��','��4��','��5��','��6��','����');
        $t2=array('��Ф','��Ф','��Ф','��Ф','��Ф','��Ф','һФ','β��','�벨','����','��ȫ��','������','�ش�','��ȫ��','���ж�','�岻��','������','�߲���','�˲���','�Ų���','ʮ����','��Ф��[��]','��Ф��[����]','��Ф��[��]','��Ф��[����]','��Ф��[��]','��Ф��[����]','��β��[��]','��β��[����]','��β��[��]','��β��[����]','��β��[��]','��β��[����]');
        $m1=  $this->get_total_for_right($t1, 1, $user_id, $plate_num, $user_power);
        $m2=  $this->get_total_for_right($t2, 2, $user_id, $plate_num, $user_power);
        $msg=array_merge($m1, $m2);
        return $msg;
    }
    function get_total_for_right($t,$ty,$user_id,$plate_num,$user_power){
        $msg=array();
        foreach($t as $v):
            if($ty==1){
                $v2=$v.'˫��';
                $sql="select a.*,a.is_fly as i_fly,b.is_fly as s_fly from orders a left join users b on a.topf_id=b.user_id where a.plate_num='$plate_num' and (a.o_type1='$v' || a.o_type1='$v2')";
            }else{
                $sql="select a.*,a.is_fly as i_fly,b.is_fly as s_fly from orders a left join users b on a.topf_id=b.user_id where a.plate_num='$plate_num' and a.o_type2='$v'";
            }
            $x =  $this->query($sql);
            $percent=0;
            while($r =  $this->fetch_array($x)):
          switch ($user_power):
                    case 1:
                        if($r['i_fly']==0){
                            //if($r['topd_id']!=$r['user_id']){
                          //$total+=$r['orders_y'];//��Ա����ע���
                          $percent+=round($r['orders_y']*$r['g_z']/100,1);
						  
                          //  }
                       }else if($r['s_fly']==0){
                          //$total+=$r['orders_y'];//�߷ɹ�ȫ��˾���
                          $percent+=$r['orders_y'];
                       }else if($r['s_fly']==2){
                          //$total+=round($r['orders_y']*$r['g_z']/100,1);//�����������������䵽ȫ��˾���
                          $percent+=round($r['orders_y']*$r['g_z']/100,1);
                       }
                       if($r['user_id']==$user_id){
                          //$total+=$r['orders_y'];//�Լ��߷ɽ��
                          //$percent-=$r['orders_y'];
                       }
                        break;
                    case 2:
                        if($r['topf_id']==$user_id && $r['user_id']!=$user_id){
                            if($r['i_fly']==0){
                                //if($r['topd_id']!=$r['user_id']){
                                    //$total+=$r['orders_y'];//��Ա����ע���
                                    $percent+=$r['orders_y'];
                                //}
                            }else if($r['s_fly']==1){
                                //$total+=$r['orders_y'];//�߷ɹ�ֹ�˾���
                                $percent+=$r['orders_y'];
                            }else if($r['s_fly']==2){
                                //$total+=round($r['orders_y']*$r['f_z']/100,1);//�����������������䵽�ֹ�˾���
                                $percent+=$r['orders_y'];
                            }
                       }
                       if($r['user_id']==$user_id){
                            //$total+=$r['orders_y'];//�Լ��߷ɽ��
                            $percent-=$r['orders_y'];
                        }
                        break;
                    case 3:
                       if($r['topgd_id']==$user_id && $r['user_id']!=$user_id){
                            if($r['i_fly']==0){
                                //if($r['topd_id']!=$r['user_id']){
                                    //$total+=$r['orders_y'];//��Ա����ע���
                                    $percent+=$r['orders_y'];
                               // }
                            }else if($r['s_fly']==2){
                                //$total+=round($r['orders_y']*$r['gd_z']/100,1);//�����������������䵽�ֹ�˾���
                                $percent+=$r['orders_y'];
                            }
                       }
                       if($r['user_id']==$user_id){
                            //$total+=$r['orders_y'];//�Լ��߷ɽ��
                            $percent-=$r['orders_y'];
                        }
                       break;
                   case 4:
                       if($r['topzd_id']==$user_id && $r['user_id']!=$user_id){
                            if($r['i_fly']==0){
                                //if($r['topd_id']!=$r['user_id']){
                                    //$total+=$r['orders_y'];//��Ա����ע���
                                    $percent+=$r['orders_y'];
                                //}
                            }else if($r['s_fly']==2){
                                //$total+=round($r['orders_y']*$r['zd_z']/100,1);//�����������������䵽�ֹ�˾���
                                $percent+=$r['orders_y'];
                            }
                       }
                       if($r['user_id']==$user_id){
                            //$total+=$r['orders_y'];//�Լ��߷ɽ��
                            $percent-=$r['orders_y'];
                        }
                       break;
                    case 5:			
					
					
                       if($r['topd_id']==$user_id && $r['user_id']!=$user_id){
                            if($r['i_fly']==0){
                                //if($r['topd_id']!=$r['user_id']){
                                    //$total+=$r['orders_y'];//��Ա����ע���
                                    $percent+=$r['orders_y'];
                                //}
                            }else if($r['s_fly']==2){
                                //$total+=round($r['orders_y']*$r['d_z']/100,1);//�����������������䵽�ֹ�˾���
                                $percent+=$r['orders_y'];
                            }
                       }
                       if($r['user_id']==$user_id){
                            //$total+=$r['orders_y'];//�Լ��߷ɽ��
                          //  $percent-=$r['orders_y'];
                        }
						
						
						
						
                       break;

                    default:
                        break;
                endswitch;
            endwhile;
           $msg[]=array($v,$percent); 
       endforeach;
       return $msg;
    }
    
    
    function get_all_plate_num(){
        $y=array();
        $x =  $this->select("plate", "plate_num" ,'1 order by plate_num desc');
        while ($row = $this->fetch_array($x)) {
            $y[]=$row['plate_num'];
        }
        return $y;
    }
    
    function change_oid_or_oname($oid=0,$oname=''){
        if($oid!=0){
            $query=$this->select("oddsset_type", "o_typename", "o_id=$oid");
            $row=  $this->fetch_array($query);
            return $row['o_typename'];
        }else{
            $query=$this->select("oddsset_type", "o_id", "o_typename='$oname'");
            $row=  $this->fetch_array($query);
            return $row['o_id'];
        }
    }
    
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
    
    function tongji_zc($user_id,$plate_num,$t1,$t2s,$user_power,$kx){
        $data=array();
        foreach($t2s as $t2){
            $x=$this->get_imm_after_zm($user_id,$plate_num,$t1,$t2,$user_power,$kx);
            foreach($x as $v){
                $data[$t2]+=$v['zc'];
            }
        }
        return $data;
    }
    
    function tongji_all($user_id,$plate_num,$t1,$t2,$user_power,$kx){
            $x=$this->get_imm_after_zm($user_id,$plate_num,$t1,$t2,$user_power,$kx);
            $i=0;
            foreach($x as $v){
                $i++;
                $total+=$v['total'];
                $zc+=$v['zc'];
                $yf+=$v['yf'];
            }
        return array($i,$total,$zc,$yf);
    }
    
    
    function get_imm_after_zm($user_id,$plate_num,$t1,$t2,$user_power,$kx,$firstcount='',$displaypg=''){
           $imm=array();
            if(empty($firstcount) && empty($displaypg)){
             $sql="select a.*,a.is_fly as i_fly,b.is_fly as s_fly from orders a left join users b on a.topf_id=b.user_id where a.plate_num='$plate_num' and a.o_type2='$t2'";   
            }else{
             $sql="select a.*,a.is_fly as i_fly,b.is_fly as s_fly from orders a left join users b on a.topf_id=b.user_id where a.plate_num='$plate_num' and a.o_type2='$t2' limit $firstcount, $displaypg";   
            } 
//            if($t2==-1){
//            $sql="select a.*,a.is_fly as i_fly,b.is_fly as s_fly from orders a left join users b on a.topf_id=b.user_id where a.plate_num='$plate_num' and a.o_type1='$t1'";
//            }

            $x =  $this->query($sql);
            while($r =  $this->fetch_array($x)){
                switch ($user_power) {
                    case 1:
                       if($r['i_fly']==0){
                          $imm[$r['o_type3']]['total']+=$r['orders_y'];//��Ա����ע���
                          $imm[$r['o_type3']]['zc']+=round($r['orders_y']*$r['g_z']/100,1);
                       }else if($r['s_fly']==0){
                          $imm[$r['o_type3']]['total']+=abs($r['orders_y']);//�߷ɹ�ȫ��˾���
                          $imm[$r['o_type3']]['zc']+=$r['orders_y'];
                       }else if($r['s_fly']==1){
                          $imm[$r['o_type3']]['total']+=abs($r['orders_y']);//�߷ɹ�ֹ�˾���
                          $imm[$r['o_type3']]['zc']+=round($r['orders_y']*$r['g_z']/100,1);
                       }else if($r['s_fly']==2){
                          //$imm[$r['o_type3']]['total']+=round($r['orders_y']*$r['g_z']/100,1);//�����������������䵽ȫ��˾���
                          $imm[$r['o_type3']]['total']+=abs($r['orders_y']);//�����������������䵽ȫ��˾���
                          $imm[$r['o_type3']]['zc']+=round($r['orders_y']*$r['g_z']/100,1);
                       }
                       
                       if($r['user_id']==$user_id){
                          //$imm[$r['o_type3']]['total']+=$r['orders_y'];//�Լ��߷ɽ��
                          //$imm[$r['o_type3']]['zc']-=$r['orders_y'];
                          $imm[$r['o_type3']]['yf']+=$r['orders_y'];
                       }
                       break;
                   case 2:
                       if($r['topf_id']==$user_id && $r['user_id']!=$user_id){
                            if($r['i_fly']==0){
                                    $imm[$r['o_type3']]['total']+=$r['orders_y'];//��Ա����ע���
                                    $imm[$r['o_type3']]['zc']+=round($r['orders_y']*$r['f_z']/100,1);
                            }else if($r['s_fly']==1){
                                $imm[$r['o_type3']]['total']+=$r['orders_y'];//�߷ɹ�ֹ�˾���
                                $imm[$r['o_type3']]['zc']+=$r['orders_y'];
                            }else if($r['s_fly']==2){
                                //$imm[$r['o_type3']]['total']+=round($r['orders_y']*$r['f_z']/100,1);//�����������������䵽�ֹ�˾���
                                $imm[$r['o_type3']]['total']+=$r['orders_y'];//�����������������䵽�ֹ�˾���
                                $imm[$r['o_type3']]['zc']+=round($r['orders_y']*$r['f_z']/100,1);
                            }
                       }else if($r['user_id']==$user_id){
                            $imm[$r['o_type3']]['total']+=$r['orders_y'];//�Լ��߷ɽ��
                            $imm[$r['o_type3']]['zc']-=$r['orders_y'];
                            $imm[$r['o_type3']]['yf']+=$r['orders_y'];
                        }
                       break;
                   case 3:
                       if($r['topgd_id']==$user_id && $r['user_id']!=$user_id){
                            if($r['i_fly']==0){
                                    $imm[$r['o_type3']]['total']+=$r['orders_y'];//��Ա����ע���
                                    $imm[$r['o_type3']]['zc']+=round($r['orders_y']*$r['gd_z']/100,1);
                            }else if($r['s_fly']==2){
                                //$imm[$r['o_type3']]['total']+=round($r['orders_y']*$r['gd_z']/100,1);//�����������������䵽�ֹ�˾���
                                $imm[$r['o_type3']]['total']+=$r['orders_y'];//�����������������䵽�ֹ�˾���
                                $imm[$r['o_type3']]['zc']+=round($r['orders_y']*$r['gd_z']/100,1);
                            }
                       }else if($r['user_id']==$user_id){
                            $imm[$r['o_type3']]['total']+=$r['orders_y'];//�Լ��߷ɽ��
                            $imm[$r['o_type3']]['zc']-=$r['orders_y'];
                            $imm[$r['o_type3']]['yf']+=$r['orders_y'];
                        }
                       break;
                   case 4:
                       if($r['topzd_id']==$user_id && $r['user_id']!=$user_id){
                            if($r['i_fly']==0){
                                    $imm[$r['o_type3']]['total']+=$r['orders_y'];//��Ա����ע���
                                    $imm[$r['o_type3']]['zc']+=round($r['orders_y']*$r['zd_z']/100,1);
                            }else if($r['s_fly']==2){
                                //$imm[$r['o_type3']]['total']+=round($r['orders_y']*$r['zd_z']/100,1);//�����������������䵽�ֹ�˾���
                                $imm[$r['o_type3']]['total']+=$r['orders_y'];//�����������������䵽�ֹ�˾���
                                $imm[$r['o_type3']]['zc']+=round($r['orders_y']*$r['zd_z']/100,1);
                            }
                       }else if($r['user_id']==$user_id){
                            $imm[$r['o_type3']]['total']+=$r['orders_y'];//�Լ��߷ɽ��
                            $imm[$r['o_type3']]['zc']-=$r['orders_y'];
                            $imm[$r['o_type3']]['yf']+=$r['orders_y'];
                        }
                       break;
                    case 5:
                       if($r['topd_id']==$user_id && $r['user_id']!=$user_id){
                            if($r['i_fly']==0){
                                    $imm[$r['o_type3']]['total']+=$r['orders_y'];//��Ա����ע���
                                    $imm[$r['o_type3']]['zc']+=round($r['orders_y']*$r['d_z']/100,1);
                            }else if($r['s_fly']==2){
                                //$imm[$r['o_type3']]['total']+=round($r['orders_y']*$r['d_z']/100,1);//�����������������䵽�ֹ�˾���
                                $imm[$r['o_type3']]['total']+=$r['orders_y'];//�����������������䵽�ֹ�˾���
                                $imm[$r['o_type3']]['zc']+=round($r['orders_y']*$r['d_z']/100,1);
                            }
                       }else if($r['user_id']==$user_id){
                            $imm[$r['o_type3']]['total']+=$r['orders_y'];//�Լ��߷ɽ��
                            $imm[$r['o_type3']]['zc']-=$r['orders_y'];
                            $imm[$r['o_type3']]['yf']+=$r['orders_y'];
                        }
                       break;

                    default:
                        break;
                }
                $imm[$r['o_type3']]['pllb']+=$r['orders_p']/$r['orders_p'];
				$imm[$r['o_type3']]['plzs']+=$r['orders_p'];
				$imm[$r['o_type3']]['pl']=$imm[$r['o_type3']]['plzs']/$imm[$r['o_type3']]['pllb'];
                $orders_p_m=$this->get_max_order_p_2($r['orders_p_2']);
                $imm[$r['o_type3']]['pl2']=$orders_p_m[0][0];
                $imm[$r['o_type3']]['yl']=-$imm[$r['o_type3']]['zc']*$imm[$r['o_type3']]['pl'];

                
                if($imm[$r['o_type3']]['zc']>0){
                    $imm[$r['o_type3']]['zf']=$imm[$r['o_type3']]['zc'];
                }
                if($imm[$r['o_type3']]['yl']<0){
                    $imm[$r['o_type3']]['zf']= (int) ((-$imm[$r['o_type3']]['yl']-$kx)/$imm[$r['o_type3']]['pl']);
                }
                 //$imm[$r['o_type3']]['zf']-=$imm[$r['o_type3']]['yf'];
                if($imm[$r['o_type3']]['zf']<0)$imm[$r['o_type3']]['zf']=0;
            }
            return $imm;
    }
    
    
    function get_zd_by_branch_plate($plate_num){
        $user_power=$_SESSION['user_power'.$this->c_p_seesion()];
        $shenfen=  $this->get_shenfen($user_power);
        $tiaojian=$this->loweralluser_arr($_SESSION['uid'.$this->c_p_seesion()]);
        if($user_power==1){
        $tiaojian2="topf_id=0";
        }elseif($user_power==2){
        $tiaojian2="topf_id={$_SESSION['uid'.$this->c_p_seesion()]}";
        }elseif($user_power==3){
        $tiaojian2="topgd_id={$_SESSION['uid'.$this->c_p_seesion()]}";
        }elseif($user_power==4){
        $tiaojian2="topzd_id={$_SESSION['uid'.$this->c_p_seesion()]}";
        }elseif($user_power==5){
        $tiaojian2="topd_id={$_SESSION['uid'.$this->c_p_seesion()]}";
        }
        //�����ҵ��߷ɺ��¼����߷ɣ��ų�ֱ����Աʱ�ظ������
        if($_SESSION['user_power'.$this->c_p_seesion()]==1){
            $tiaojian="user_id>0";
        }else{
            if(!$tiaojian){
                $tiaojian="((user_id=0 and is_fly=0) or (is_fly=1 and user_id={$_SESSION['uid'.$this->c_p_seesion()]}))";
            }else{
                $tiaojian="((user_id in($tiaojian,{$_SESSION['uid'.$this->c_p_seesion()]}) and is_fly=0) or (is_fly=1 and (user_id={$_SESSION['uid'.$this->c_p_seesion()]} or fly_user_id like '%,{$_SESSION['uid'.$this->c_p_seesion()]},%')))";
            }
        }
        $x=  $this->select("orders", "*", "$tiaojian  and plate_num='$plate_num' order by id desc");
        $y=array();
        $i=0;
        while ($row = $this->fetch_array($x)) {
            $y[$row[$shenfen]]['total']+=$row['orders_y'];//��Ա����ע���
            $p_g=$row['orders_y']*$row['g_z']/100;
            $p_f=$row['orders_y']*$row['f_z']/100;
            $p_gd=$row['orders_y']*$row['gd_z']/100;
            $p_zd=$row['orders_y']*$row['zd_z']/100;
            $p_d=$row['orders_y']*$row['d_z']/100;
            $y[$row[$shenfen]]['percent_company_value']+=$p_g;
                $y[$row[$shenfen]]['percent_branch_value']+=$p_f;
                $y[$row[$shenfen]]['percent_partner_value']+=$p_gd;
                $y[$row[$shenfen]]['percent_all_proxy_value']+=$p_zd;
                $y[$row[$shenfen]]['percent_proxy_value']+=$p_d;
                $y[$row[$shenfen]]['tuishui_y']+=$row['tuishui_y'];
                $y[$row[$shenfen]]['count']++;
        }
        return $y;
    }
    
    function get_shenfen($user_power){
        switch($user_power){
            case 1:
                    $shenfen='topf_id';
                break;
            case 2:
                    $shenfen='topf_id';
                break;
            case 3:
                    $shenfen='topgd_id';
                break;
            case 4:
                    $shenfen='topzd_id';
                break;
            case 5:
                    $shenfen='topd_id';
                break;
            case 6:
                    $shenfen='toph_id';
                break;
            case 7:
                    $shenfen='xx';
                break;
        }
        return $shenfen;
    }
    
    
    function get_right_url(){
        $t1=array('����','��1��','��2��','��3��','��4��','��5��','��6��','����');
        $t2=array('��Ф','��Ф','��Ф','��Ф','��Ф','��Ф','һФ','β��');
        //$t3=array('�벨','����');
        $t4=array('��ȫ��','������','�ش�','��ȫ��','���ж�');
        $t5=array('�岻��','������','�߲���','�˲���','�Ų���','ʮ����');
        $t6=array('��Ф��[��]','��Ф��[����]','��Ф��[��]','��Ф��[����]','��Ф��[��]','��Ф��[����]');
        $t7=array('��β��[��]','��β��[����]','��β��[��]','��β��[����]','��β��[��]','��β��[����]');
        foreach($t1 as $v){
            $url[]='tm.php?t1='.$v.'&t2='.$v.'A';
        }
        foreach($t2 as $v){
            $url[]='tx.php?t1=��ФһФβ��&t2='.$v;
        }
        $url[]='bb.php';
        $url[]='gg.php';
        foreach ($t4 as $v) {
            $url[]='lm.php?t1=����&t2='.$v;
        }
        foreach ($t5 as $v) {
            $url[]='bz.php?t1=����&t2='.$v;
        }
        foreach ($t6 as $v) {
            $url[]='sql.php?t1=��Ф��&t2='.$v;
        }
        foreach ($t7 as $v) {
            $url[]='wsl.php?t1=β����&t2='.$v;
        }
        return $url;
    }
    
    function get_imm_by_type3_user_id_power($user_id,$type2,$type3,$power,$plate_num){
        switch ($power) {
            case 1:
                $sql="select o.*,u.user_name from orders o,users u where o.user_id!=$user_id and u.user_id=o.user_id and o.o_type2='$type2' and o.o_type3='$type3' and o.plate_num='$plate_num'";
                //echo $sql;
                break;
            case 2:
                $sql="select o.*,u.user_name from orders o,users u where o.user_id!=$user_id and u.user_id=o.user_id and (o.topf_id=$user_id or o.user_id=$user_id) and o.o_type2='$type2' and o.o_type3='$type3' and o.plate_num='$plate_num'";
                break;
            case 3:
                $sql="select o.*,u.user_name from orders o,users u where o.user_id!=$user_id and u.user_id=o.user_id and (o.topgd_id=$user_id or o.user_id=$user_id) and o.o_type2='$type2' and o.o_type3='$type3' and o.plate_num='$plate_num'";
                break;
            case 4:
                $sql="select o.*,u.user_name from orders o,users u where o.user_id!=$user_id and u.user_id=o.user_id and (o.topzd_id=$user_id or o.user_id=$user_id) and o.o_type2='$type2' and o.o_type3='$type3' and o.plate_num='$plate_num'";
                break;
            case 5:
                $sql="select o.*,u.user_name from orders o,users u where o.user_id!=$user_id and u.user_id=o.user_id and (o.topd_id=$user_id or o.user_id=$user_id) and o.o_type2='$type2' and o.o_type3='$type3' and o.plate_num='$plate_num'";
                break;
            case 6:
                $sql="select o.*,u.user_name from orders o,users u where u.user_id=o.user_id and u.user_id=$user_id and o.o_type2='$type2' and o.o_type3='$type3' and o.plate_num='$plate_num'";
                break;
            default:
                break;
        }
        return $sql;        
    }
    function get_imm_by_type3_user_id_power2($user_id,$type2,$type3,$power,$plate_num){
        switch ($power) {
            case 1:
//                $sql="select o.*,u.user_name from orders o,users u where u.user_id=o.user_id and o.is_fly=1 and o.o_type2='$type2' and o.o_type3='$type3' and o.plate_num='$plate_num'";
//                break;
            case 2:
            case 3:
            case 4:
            case 5:
            case 6:
                $sql="select o.*,u.user_name from orders o,users u where u.user_id=o.user_id and o.user_id=$user_id and o.o_type2='$type2' and o.o_type3='$type3' and o.plate_num='$plate_num'";
                break;
            default:
                break;
        }
        return $sql;        
    }
    
    function get_his_f_user($topf_id){
        $query =  $this->select("users", "is_fly", "user_id=$topf_id");
        $x=$this->fetch_array($query);
        return $x['is_fly'];
    }
    
    //��ȡ�ಹ�ַ���
    function get_duo_bu_string($haoma,$duo_bus,$imm_type3){
        $type3arr = explode(',', trim($imm_type3,','));
        foreach ($type3arr as $key => $v3) {
            if($haoma==$v3){
                $k3=$key;
            }
        }
        
        $duo_buarr = explode(';', $duo_bus);
        foreach ($duo_buarr as $k => $v) {
            if($k<=$k3){
                $duo_bu.=$v.';';
            }
        }
        
        return $duo_bu;
    }
}
?>