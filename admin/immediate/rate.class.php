<?php
class rate0 extends mysql
{

		function get_animal_table( )
		{
				$sql = "select set_animal from animal_set";
				$x = $this->query( $sql );
				$r = $this->fetch_array( $x );
				$set_id = $r['set_animal'];
				$animal = array( );
				$query = $this->select( "animal", "*", "set_id={$set_id}" );
				while ( $row = $this->fetch_array( $query ) )
				{
						if ( $row['num'] < 10 )
						{
								$row['num'] = "0".$row['num'];
						}
						$animal[$row['animal']] .= $row['num'].",";
				}
				return $animal;
		}

		function get_rate( $o_id, $user_id, $plate_num, $key = "o_content" )
		{
				$x = $this->select( "odds_set", "*", "plate_num='{$plate_num}' and user_id={$user_id} and o_id={$o_id}" );
				$r = $this->fetch_array( $x );
				$msg = substr( $r[$key], 1, -1 );
				$ms = explode( ",", $msg );
				$ret = array( );
				foreach ( $ms as $v )
				{
						$o = explode( ":", $v );
						if ( $key != "o_content" )
						{
								$ret[$o[0]] = $o[1];
						}
						else
						{
								$ret[$o[0]] = $o;
						}
				}
				return $ret;
		}

		function get_otype_by_oid( $oid )
		{
				switch ( $oid )
				{
				case 16 :
						$str = "����A";
						break;
				case 17 :
						$str = "����B";
						break;
				case 18 :
						$str = "��1��A";
						break;
				case 19 :
						$str = "��1��B";
						break;
				case 20 :
						$str = "��2��A";
						break;
				case 21 :
						$str = "��2��B";
						break;
				case 22 :
						$str = "��3��A";
						break;
				case 23 :
						$str = "��3��B";
						break;
				case 24 :
						$str = "��4��A";
						break;
				case 25 :
						$str = "��4��B";
						break;
				case 26 :
						$str = "��5��A";
						break;
				case 27 :
						$str = "��5��B";
						break;
				case 28 :
						$str = "��6��A";
						break;
				case 29 :
						$str = "��6��B";
						break;
				case 30 :
						$str = "����A";
						break;
				case 31 :
						$str = "����B";
						break;
				case 32 :
						$str = "��ȫ��";
						break;
				case 33 :
						$str = "������";
						break;
				case 34 :
						$str = "�ش�";
						break;
				case 35 :
						$str = "��ȫ��";
						break;
				case 36 :
						$str = "���ж�";
						break;
				case 37 :
						$str = "�岻��";
						break;
				case 38 :
						$str = "������";
						break;
				case 39 :
						$str = "�߲���";
						break;
				case 40 :
						$str = "�˲���";
						break;
				case 41 :
						$str = "�Ų���";
						break;
				case 42 :
						$str = "ʮ����";
						break;
				case 69 :
						$str = "�ж�";
						break;
				case 70 :
						$str = "����";
						break;
				case 71 :
						$str = "����";
						break;
				case 72 :
						$str = "�ж�";
						break;
				default :
						break;
				}
				return $str;
		}

		function get_color( $num )
		{
				$num = 0 + $num;
				$f = ",1,2,7,8,12,13,18,19,23,24,29,30,34,35,40,45,46,";
				$g = ",5,6,11,16,17,21,22,27,28,32,33,38,39,43,44,49,";
				$x = strstr( $f, ",".$num."," );
				if ( $x )
				{
						return "r";
				}
				else if ( strstr( $g, ",".$num."," ) )
				{
						return "g";
				}
				else
				{
						return "b";
				}
		}

		function update_another_odd( $user_id, $oid, $plate_num, $o_content = "", $ab_content = "" )
		{
				$x = $this->select( "oddsset_type", "*", "o_id={$oid}" );
				$y = $this->fetch_array( $x );
				if ( strstr( $y['o_typename'], "A" ) )
				{
						$fxxk_id = $oid + 1;
						$fxx_ty = 1;
				}
				else if ( strstr( $y['o_typename'], "B" ) )
				{
						if ( empty( $o_content ) )
						{
								$fxxk_id = $oid;
								$oid = $oid - 1;
								$fxx_ty = 1;
						}
						else
						{
								$fxxk_id = $oid - 1;
								$fxx_ty = -1;
						}
				}
				else
				{
						$fxxk_id = 0;
						$fxx_ty = 0;
				}
				if ( $fxxk_id != 0 )
				{
						if ( $user_id == 1 )
						{
								$u = $this->select( "users", "user_id", "(user_id=1 or top_id=1) and is_odds=0" );
								while ( $uu = $this->fetch_array( $u ) )
								{
										$uu_arr[] = $uu['user_id'];
								}
						}
						else
						{
								$uu_arr = array(
										$user_id
								);
						}
						foreach ( $uu_arr as $us )
						{
								$dn = $this->select( "odds_set", "*", "o_id={$fxxk_id} and user_id={$us} and plate_num='{$plate_num}'" );
								$dm = $this->fetch_array( $dn );
								$do = $dm['o_content'];
								$doab = $dm['ab_content'];
								if ( strstr( $y['o_typename'], "B" ) )
								{
										$this->update( "odds_set", "ab_content='{$doab}'", "o_id={$oid} and user_id={$us} and plate_num='{$plate_num}'" );
								}
								$dp = explode( ",", substr( $do, 1, -1 ) );
								$countdp = count( $dp );
								foreach ( $dp as $to )
								{
										$o_arr = explode( ":", $to );
										$o0[] = $o_arr[0];
										$o2[] = $o_arr[2];
										$o3[] = $o_arr[3];
								}
								$n = $this->select( "odds_set", "*", "o_id={$oid} and user_id={$us} and plate_num='{$plate_num}'" );
								$m = $this->fetch_array( $n );
								if ( $o_content && $o_content != "" )
								{
										$o = $o_content;
								}
								else
								{
										$o = $m['o_content'];
								}
								$p = explode( ",", substr( $o, 1, -1 ) );
								if ( $user_id == 1 )
								{
										if ( $ab_content && $ab_content != "" )
										{
												$r = $ab_content;
										}
										else
										{
												$r = $m['ab_content'];
										}
								}
								else
								{
										$adminn = $this->select( "odds_set", "ab_content", "o_id={$oid} and user_id=1 and plate_num='{$plate_num}'" );
										$adminm = $this->fetch_array( $adminn );
										$r = $adminm['ab_content'];
								}
								$s = explode( ",", substr( $r, 1, -1 ) );
								foreach ( $s as $t )
								{
										$u = explode( ":", $t );
										$w[$u[0]] = $u[1];
								}
								foreach ( $p as $ij => $v )
								{
										$q = explode( ":", $v );
										if ( $q[0] < "50" )
										{
												$q1[] = $q[1] + $fxx_ty * $w['��'];
										}
										else if ( $q[0] == "�첨" || $q[0] == "�̲�" || $q[0] == "����" )
										{
												$q1[] = $q[1] + $fxx_ty * $w['��ɫ'];
										}
										else
										{
												$q1[] = $q[1] + $fxx_ty * $w['˫��'];
										}
								}
								$i = 0;
								for ( ;	$i < $countdp;	++$i	)
								{
										$to = $o0[$i].":".$q1[$i].":".$o2[$i].":".$o3[$i];
										$toi .= $to.",";
								}
								$fxxk_content = ",".trim( $toi, "," ).",";
								$this->update( "odds_set", "o_content='{$fxxk_content}',ab_content='{$r}'", "o_id={$fxxk_id} and user_id={$us} and plate_num='{$plate_num}'" );
								unset( $to );
								unset( $toi );
								unset( $fxxk_content );
								unset( $q1 );
								unset( $o0 );
								unset( $o2 );
								unset( $o3 );
						}
				}
		}

		function update_odd_down( $oid, $plate_num, $o_content )
		{
				$x = $this->select( "oddsset_type", "*", "o_id={$oid}" );
				$y = $this->fetch_array( $x );
				if ( strstr( $y['o_typename'], "A" ) )
				{
						$fxxk_id = $oid + 1;
						$fxx_ty = 1;
				}
				else if ( strstr( $y['o_typename'], "B" ) )
				{
						$fxxk_id = $oid - 1;
						$fxx_ty = -1;
				}
				else
				{
						$fxxk_id = 0;
						$fxx_ty = 0;
				}
				if ( $fxxk_id == 0 )
				{
						if ( $oid == 69 )
						{
								$oid_arrs = array( 69, 70 );
						}
						else if ( $oid == 71 )
						{
								$oid_arrs = array( 71, 72 );
						}
						else
						{
								$oid_arrs = array(
										$oid
								);
						}
				}
				else
				{
						$oid_arrs = array(
								$oid,
								$fxxk_id
						);
				}
				if ( $oid_arrs[0] != 0 )
				{
						$adminn = $this->select( "odds_set", "o_content,ab_content", "o_id={$oid} and user_id=1 and plate_num='{$plate_num}'" );
						$adminm = $this->fetch_array( $adminn );
						$r = $adminm['ab_content'];
						$o = $adminm['o_content'];
						$p = explode( ",", substr( $o, 1, -1 ) );
						$s = explode( ",", substr( $r, 1, -1 ) );
						$ot = explode( ",", substr( $o_content, 1, -1 ) );
						$countpp = count( $p );
						foreach ( $p as $pp )
						{
								$p_arr = explode( ":", $pp );
								$p1[] = $p_arr[1];
						}
						foreach ( $ot as $ott )
						{
								$ot_arr = explode( ":", $ott );
								$ot1[] = $ot_arr[1];
						}
						$i = 0;
						for ( ;	$i < $countpp;	++$i	)
						{
								$cha_z[] = $p1[$i] - $ot1[$i];
						}
						$u = $this->select( "users", "user_id", "(user_id=1 or top_id=1) and is_odds=0" );
						while ( $uu = $this->fetch_array( $u ) )
						{
								$uu_arr[] = $uu['user_id'];
						}
						foreach ( $uu_arr as $us )
						{
								foreach ( $oid_arrs as $oooid )
								{
										$n = $this->select( "odds_set", "o_content", "o_id={$oooid} and user_id={$us} and plate_num='{$plate_num}'" );
										$m = $this->fetch_array( $n );
										$mm = $m['o_content'];
										$mp = explode( ",", substr( $mm, 1, -1 ) );
										$countmp = count( $mp );
										foreach ( $mp as $mo )
										{
												$mo_arr = explode( ":", $mo );
												$mo0[] = $mo_arr[0];
												$mo1[] = $mo_arr[1];
												$mo2[] = $mo_arr[2];
												$mo3[] = $mo_arr[3];
										}
										$mi = 0;
										for ( ;	$mi < $countmp;	++$mi	)
										{
												$mpo = $mo0[$mi].":".( $mo1[$mi] - $cha_z[$mi] ).":".$mo2[$mi].":".$mo3[$mi];
												$mpoi .= $mpo.",";
										}
										$mp_content = ",".trim( $mpoi, "," ).",";
										$this->update( "odds_set", "o_content='{$mp_content}',ab_content='{$r}'", "o_id={$oooid} and user_id={$us} and plate_num='{$plate_num}'" );
										unset( $mpo );
										unset( $mpoi );
										unset( $mp_content );
										unset( $mo0 );
										unset( $mo1 );
										unset( $mo2 );
										unset( $mo3 );
								}
						}
				}
		}

		function get_o_content_str( $ty, $rate_array, $all_set )
		{
				$str = ",";
				switch ( $ty )
				{
				case 1 :
						foreach ( $rate_array as $i => $v )
						{
								if ( $i < "50" )
								{
										$j = $i % 2;
										if ( $j == 1 )
										{
												$v[1] = $all_set;
										}
								}
								$str .= implode( ":", $v ).",";
						}
						break;
				case 2 :
						foreach ( $rate_array as $i => $v )
						{
								if ( $i < "50" )
								{
										$j = $i % 2;
										if ( $j == 0 )
										{
												$v[1] = $all_set;
										}
								}
								$str .= implode( ":", $v ).",";
						}
						break;
				case 3 :
						foreach ( $rate_array as $i => $v )
						{
								if ( $i < "50" && "24" < $i )
								{
										$v[1] = $all_set;
								}
								$str .= implode( ":", $v ).",";
						}
						break;
				case 4 :
						foreach ( $rate_array as $i => $v )
						{
								if ( $i < "25" )
								{
										$v[1] = $all_set;
								}
								$str .= implode( ":", $v ).",";
						}
						break;
				case 5 :
						foreach ( $rate_array as $i => $v )
						{
								if ( $i < "50" )
								{
										$c = $db->get_color( $i );
										if ( $c == "r" )
										{
												$v[1] = $all_set;
										}
								}
								$str .= implode( ":", $v ).",";
						}
						break;
				case 6 :
						foreach ( $rate_array as $i => $v )
						{
								if ( $i < "50" )
								{
										$c = $db->get_color( $i );
										if ( $c == "g" )
										{
												$v[1] = $all_set;
										}
								}
								$str .= implode( ":", $v ).",";
						}
						break;
				case 7 :
						foreach ( $rate_array as $i => $v )
						{
								if ( $i < "50" )
								{
										$c = $db->get_color( $i );
										if ( $c == "b" )
										{
												$v[1] = $all_set;
										}
								}
								$str .= implode( ":", $v ).",";
						}
						break;
				case 8 :
						foreach ( $rate_array as $i => $v )
						{
								if ( $i < "50" )
								{
										$v[1] = $all_set;
								}
								$str .= implode( ":", $v ).",";
						}
						break;
				case 9 :
						foreach ( $rate_array as $i => $v )
						{
								$v[1] = $all_set;
								$str .= implode( ":", $v ).",";
						}
						break;
				case 11 :
						foreach ( $rate_array as $i => $v )
						{
								if ( $i == "�쵥" || $i == "�̵�" || $i == "����" )
								{
										$v[1] = $all_set;
								}
								$str .= implode( ":", $v ).",";
						}
						break;
				case 12 :
						foreach ( $rate_array as $i => $v )
						{
								if ( $i == "��˫" || $i == "��˫" || $i == "��˫" )
								{
										$v[1] = $all_set;
								}
								$str .= implode( ":", $v ).",";
						}
						break;
				case 13 :
						foreach ( $rate_array as $i => $v )
						{
								if ( $i == "���" || $i == "�̴�" || $i == "����" )
								{
										$v[1] = $all_set;
								}
								$str .= implode( ":", $v ).",";
						}
						break;
				case 14 :
						foreach ( $rate_array as $i => $v )
						{
								if ( $i == "��С" || $i == "��С" || $i == "��С" )
								{
										$v[1] = $all_set;
								}
								$str .= implode( ":", $v ).",";
						}
						break;
				default :
						break;
				}
				return $str;
		}

		function get_call_back_url( $oid, $plate_num )
		{
				switch ( $oid )
				{
				case 16 :
						$url = "tm.php?plate_num={$plate_num}&t1=����&t2=����A";
						break;
				case 17 :
						$url = "tm.php?plate_num={$plate_num}&t1=����&t2=����B";
						break;
				case 18 :
						$url = "tm.php?plate_num={$plate_num}&t1=��1��&t2=��1��A";
						break;
				case 19 :
						$url = "tm.php?plate_num={$plate_num}&t1=��1��&t2=��1��B";
						break;
				case 20 :
						$url = "tm.php?plate_num={$plate_num}&t1=��2��&t2=��2��A";
						break;
				case 21 :
						$url = "tm.php?plate_num={$plate_num}&t1=��2��&t2=��2��B";
						break;
				case 22 :
						$url = "tm.php?plate_num={$plate_num}&t1=��3��&t2=��3��A";
						break;
				case 23 :
						$url = "tm.php?plate_num={$plate_num}&t1=��3��&t2=��3��B";
						break;
				case 24 :
						$url = "tm.php?plate_num={$plate_num}&t1=��4��&t2=��4��A";
						break;
				case 25 :
						$url = "tm.php?plate_num={$plate_num}&t1=��4��&t2=��4��B";
						break;
				case 26 :
						$url = "tm.php?plate_num={$plate_num}&t1=��5��&t2=��5��A";
						break;
				case 27 :
						$url = "tm.php?plate_num={$plate_num}&t1=��5��&t2=��5��B";
						break;
				case 28 :
						$url = "tm.php?plate_num={$plate_num}&t1=��6��&t2=��6��A";
						break;
				case 29 :
						$url = "tm.php?plate_num={$plate_num}&t1=��6��&t2=��6��B";
						break;
				case 30 :
						$url = "tm.php?plate_num={$plate_num}&t1=����&t2=����A";
						break;
				case 31 :
						$url = "tm.php?plate_num={$plate_num}&t1=����&t2=����B";
						break;
				default :
						break;
				}
				return $url;
		}

}

?>
