<?php
echo $_POST['aa'].iconv( "gb2312", "utf-8", "��Һ�" );
iconv( $in_charset, $out_charset, $str );
?>
