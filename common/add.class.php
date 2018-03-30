<?php
class add extends mysql {
    function get_backorder_set($user_id){
        //$sql="select * from backorder_set where user_id=$user_id order by view_order asc";
        $z=array();
        $x=  $this->select("backorder_set", "*", "user_id=$user_id order by view_order asc");
        $y=  $this->fetch_array($x);
        if(empty($y['user_id'])){
           $x=  $this->select("backorder_set", "*", "user_id=0 order by view_order asc");
            while ($row = $this->fetch_array($x)) {
                $z[]=$row;
            }
        }else{
            $z[]=$y;
            while ($row = $this->fetch_array($x)) {
                $z[]=$row;
            }
        }
        return $z;
    }
    
    function start_set($user_id){
        $sql="insert ignore into backorder_set select $user_id,o_typename,mode,control_limit,lowest_limit,begin_limit,is_use,o_ids,view_order from backorder_set where user_id=0";
        $this->query($sql);
    }
}
?>