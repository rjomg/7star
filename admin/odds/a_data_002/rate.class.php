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

		function get_rate( $o_id, $key = "o_content" )
		{
				$plate_num = "0";
				$x = $this->select( "odds_set", "*", "plate_num='{$plate_num}' and user_id=0 and o_id={$o_id}" );
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
						$str = "特码A";
						break;
				case 17 :
						$str = "特码B";
						break;
				case 18 :
						$str = "正1特A";
						break;
				case 19 :
						$str = "正1特B";
						break;
				case 20 :
						$str = "正2特A";
						break;
				case 21 :
						$str = "正2特B";
						break;
				case 22 :
						$str = "正3特A";
						break;
				case 23 :
						$str = "正3特B";
						break;
				case 24 :
						$str = "正4特A";
						break;
				case 25 :
						$str = "正4特B";
						break;
				case 26 :
						$str = "正5特A";
						break;
				case 27 :
						$str = "正5特B";
						break;
				case 28 :
						$str = "正6特A";
						break;
				case 29 :
						$str = "正6特B";
						break;
				case 30 :
						$str = "正码A";
						break;
				case 31 :
						$str = "正码B";
						break;
				case 32 :
						$str = "二全中";
						break;
				case 33 :
						$str = "二中特";
						break;
				case 34 :
						$str = "特串";
						break;
				case 35 :
						$str = "三全中";
						break;
				case 36 :
						$str = "三中二";
						break;
				case 37 :
						$str = "五不中";
						break;
				case 38 :
						$str = "六不中";
						break;
				case 39 :
						$str = "七不中";
						break;
				case 40 :
						$str = "八不中";
						break;
				case 41 :
						$str = "九不中";
						break;
				case 42 :
						$str = "十不中";
						break;
				case 69 :
						$str = "中二";
						break;
				case 70 :
						$str = "中特";
						break;
				case 71 :
						$str = "中三";
						break;
				case 72 :
						$str = "中二";
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

		function update_another_odd( $oid, $plate_num, $o_content = "", $ab_content = "" )
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
						$dn = $this->select( "odds_set", "*", "o_id={$fxxk_id} and user_id=0 and plate_num='{$plate_num}'" );
						$dm = $this->fetch_array( $dn );
						$do = $dm['o_content'];
						$doab = $dm['ab_content'];
						if ( strstr( $y['o_typename'], "B" ) )
						{
								$this->update( "odds_set", "ab_content='{$doab}'", "o_id={$oid} and user_id=0 and plate_num='{$plate_num}'" );
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
						$n = $this->select( "odds_set", "*", "o_id={$oid} and user_id=0 and plate_num='{$plate_num}'" );
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
						if ( $ab_content && $ab_content != "" )
						{
								$r = $ab_content;
						}
						else
						{
								$r = $m['ab_content'];
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
										$q1[] = $q[1] + $fxx_ty * $w['码'];
								}
								else if ( $q[0] == "红波" || $q[0] == "绿波" || $q[0] == "蓝波" )
								{
										$q1[] = $q[1] + $fxx_ty * $w['波色'];
								}
								else
								{
										$q1[] = $q[1] + $fxx_ty * $w['双面'];
								}
						}
						$i = 0;
						for ( ;	$i < $countdp;	++$i	)
						{
								$to = $o0[$i].":".$q1[$i].":".$o2[$i].":".$o3[$i];
								$toi .= $to.",";
						}
						$fxxk_content = ",".trim( $toi, "," ).",";
						$this->update( "odds_set", "o_content='{$fxxk_content}',ab_content='{$r}'", "o_id={$fxxk_id} and user_id=0 and plate_num='{$plate_num}'" );
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
										$c = $this->get_color( $i );
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
										$c = $this->get_color( $i );
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
										$c = $this->get_color( $i );
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
								if ( $i == "红单" || $i == "绿单" || $i == "蓝单" )
								{
										$v[1] = $all_set;
								}
								$str .= implode( ":", $v ).",";
						}
						break;
				case 12 :
						foreach ( $rate_array as $i => $v )
						{
								if ( $i == "红双" || $i == "绿双" || $i == "蓝双" )
								{
										$v[1] = $all_set;
								}
								$str .= implode( ":", $v ).",";
						}
						break;
				case 13 :
						foreach ( $rate_array as $i => $v )
						{
								if ( $i == "红大" || $i == "绿大" || $i == "蓝大" )
								{
										$v[1] = $all_set;
								}
								$str .= implode( ":", $v ).",";
						}
						break;
				case 14 :
						foreach ( $rate_array as $i => $v )
						{
								if ( $i == "红小" || $i == "绿小" || $i == "蓝小" )
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

		function get_call_back_url( $oid )
		{
				if ( 15 < $oid && $oid < 32 )
				{
						$url = "m_tm.php?o=".$oid;
				}
				else if ( 31 < $oid && $oid < 37 )
				{
						$url = "m_lm.php?o=".$oid;
				}
				else if ( $oid == 69 )
				{
						$url = "m_lm.php?o=33";
				}
				else if ( $oid == 71 )
				{
						$url = "m_lm.php?o=36";
				}
				else if ( 36 < $oid && $oid < 43 )
				{
						$url = "m_bz.php?o=".$oid;
				}
				else if ( 42 < $oid && $oid < 51 )
				{
						$url = "m_dqws.php";
				}
				else if ( 50 < $oid && $oid < 57 )
				{
						$url = "m_sql.php";
				}
				else if ( 56 < $oid && $oid < 63 )
				{
						$url = "m_wsl.php";
				}
				else if ( $oid == 14 )
				{
						$url = "m_bb.php";
				}
				else if ( 62 < $oid && $oid < 69 )
				{
						$url = "m_gg.php";
				}
				return $url;
		}

}

?>
