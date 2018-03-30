<?php
include_once( "../../global.php" );
$db = new action( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
$db2 = new action( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
$iss7 = $db->select( "plate", "plate_num", "1 order by plate_num desc " );
$is7 = $db->fetch_array( $iss7 );
$kaijiangs = $db2->select( "caijikaijiang", "*", "plate_num='{$is7['plate_num']}' limit 0,1" );
$kaijiang = $db2->fetch_array( $kaijiangs );
if ( empty( $kaijiang['id'] ) )
{
		$db->kaijiangcaiji( );
}
echo "<html oncontextmenu=\"return false\" xmlns=\"http://www.w3.org/1999/xhtml\">\n<head>\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />\n<title>¼´•ré_ª„</title>\n<link href=\"../images/commom.css\" rel=\"stylesheet\" type=\"text/css\" />\n</head>\n ";
echo "<s";
echo "tyle type=\"text/css\">\n<!--\nbody {\n\tmargin-left: 0px;\n\tmargin-top: 0px;\n\tmargin-right: 0px;\n\tmargin-bottom: 0px;\n\tcolor:#344b50;\n}\n\n-->\n</style>   \n<body>\n    <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n        <tr>\n            <td width=\"800\"> \n       \n    \n<table width=\"800\" border=\"0\" cellpadding=\"0\" cellspacing=\"5\">\n    <!--DWLayoutTable-->\n    <tbody>\n        <tr bgcolor=\"#FFFFFF\"><td";
echo " width=\"88\" height=\"35\" align=\"center\">";
echo "<s";
echo "trong>Ö±²¥…^</strong></td><td style=\"overflow:hidden;\"><iframe style=\"margin-top:-1px;\" src=\"http://bmw.512302.com:8022/live4.html\" width=\"710\" height=\"57\" scrolling=\"no\" frameborder=\"0\"></iframe></td></tr>\n        </tbody></table></td>   \n            <td>\n             <div align=\"left\"><embed quality=\"high\" type=\"application/x-shockwave-flash\" height=\"250\" width=\"330\" src=\"../images/shizhong1.swf\"></div>   \n            </td>\n             </tr> \n        </table>\n    \n</body>\n";
echo "</html>\n";
?>
