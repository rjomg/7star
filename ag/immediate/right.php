<?php
$right = $db->get_total_for_r( $user_id, $plate_num, $user_power );
$r_url = $db->get_right_url( );
echo "<table class=\"Ball_List Tab\" align=\"center\" bgcolor=\"cccccc\" border=\"0\" bordercolor=\"#999999\" cellpadding=\"2\" cellspacing=\"1\" width=\"220\">\n    <tbody>\n        <tr class=\"td_caption_1\">\n            <td colspan=\"2\" align=\"center\" bgcolor=\"#E6F4FF\" height=\"22\" nowrap=\"nowrap\">";
echo "<s";
echo "pan id=\"gold20\">¿‚î~£º[";
echo "<s";
echo "pan class=\"cz rate_color\">";
echo $db->get_right_total( $right );
echo "</span>]</span></td>\n        </tr>\n        ";
$i = 0;
for ( ;	$i < 21;	++$i	)
{
		echo "            <tr bgcolor=\"E6E7E8\">\n                ";
		$j = 0;
		for ( ;	$j < 2;	++$j	)
		{
				$k = $i + $j * 21;
				echo "                    <td align=\"left\" bgcolor=\"E8FFFF\" height=\"25\" nowrap=\"nowrap\" width=\"90\"><a href=\"";
				echo $r_url[$k];
				echo "\" target=\"_self\" onclick=\"\">";
				echo "<s";
				echo "pan id=\"gold0\">";
				if ( !empty( $right[$k][0] ) )
				{
						echo $right[$k][0];
						echo "[";
						echo "<s";
						echo "pan class=\"cz rate_color\">";
						echo $right[$k][1];
						echo "</span>]";
				}
				echo "</span></a></td>\n                ";
		}
		echo "            </tr>\n        ";
}
echo "    </tbody>\n</table>";
?>
