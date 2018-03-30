<?php
include_once( "../../global.php" );

$db = new action( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );

$msg = $_REQUEST['v'];

$ty = $_REQUEST['ty'];

$user_id = $_REQUEST['user_id'];

if ( $ty == 1 )

{

		$up_type = "允许";

		if ( $msg == 0 )

		{

				$or_value = 0;

				$now_value = 1;

				$tiaojian = "is_bet=1";

				$echo = 1;

		}

		else

		{

				$tiaojian = "is_bet=0";

				$echo = 2;

				$or_value = 1;

				$now_value = 0;

		}

}

else if ( $ty == 2 )

{

		$up_type = "禁止";

		if ( $msg == 0 )

		{

				$tiaojian = "is_lock=1";

				$echo = 1;

				$or_value = 0;

				$now_value = 1;

		}

		else

		{

				$tiaojian = "is_lock=0";

				$echo = 2;

				$or_value = 1;

				$now_value = 0;

		}

}

else if ( $ty == 3 )

{

		$up_type = "允许";

		if ( $msg == 0 )

		{

				$tiaojian = "is_add=1";

				$echo = 1;

				$or_value = 0;

				$now_value = 1;

		}

		else

		{

				$tiaojian = "is_add=0";

				$echo = 3;

				$or_value = 1;

				$now_value = 0;

		}

}

$ip = $_SERVER['REMOTE_ADDR'];

$y = simplexml_load_file( "http://www.youdao.com/smartresult-xml/search.s?type=ip&q={$ip}" );

$location = iconv( "utf-8", "gbk", $y->product->location );

$db->insert( "update_code", "user_id,up_type,or_value,now_value,up_user_name,up_user_ip,up_user_location", "{$user_id},'{$up_type}','{$or_value}','{$now_value}','{$_SESSION["username".$c_p_seesion]}','{$ip}','{$location}'" );

$db->update( "users", $tiaojian, "user_id=".$user_id );

echo $echo;

?>

