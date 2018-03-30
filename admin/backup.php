<?php

include_once('../global.php');

//$d = new back($mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset); //数据库操作类. 



$d=new db($mydbhost,$mydbuser,$mydbpw,$mydbname);  





/*--------------界面--------------*/if(!$_POST['act']){/*----------------------*/  

$msgs[]="服务器备份目录为backup";  

$msgs[]="对于较大的数据表，强烈建议使用分卷备份";  

$msgs[]="只有选择备份到服务器，才能使用分卷备份功能";   

?>  

<html oncontextmenu="return false" xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<style type="text/css">

<!--

body {

	margin-left: 0px;

	margin-top: 0px;

	margin-right: 0px;

	margin-bottom: 0px;

}

-->

</style>

</head>

<body oncontextmenu="return false" onselect="document.selection.empty()" oncopy="document.selection.empty()" onmouseover="self.status='歡迎光臨';return true">

<link href="images/Index.css" rel="stylesheet" type="text/css">

<style type="text/css">

<!--

.STYLE2 {	color: #0000FF;

	font-weight: bold;

}

tr{

   height:25px;

}

-->

 </style>

<table border="0" cellpadding="0" cellspacing="0" width="99%" style="margin:auto;border:1px solid #000;background:#fff;">

  <tbody>

    <tr>

      <td background="css/bg_list.gif" height="25"><table border="0" cellpadding="0" cellspacing="0" width="100%">

          <tbody>

            <tr>

              <td height="25" width="12"><img src="css/bg_list.gif" height="25" width="12"></td>

              <td><table border="0" cellpadding="0" cellspacing="0" width="100%">

                  <tbody>

                    <tr>

                      <td valign="middle" width="87%"><table border="0" cellpadding="0" cellspacing="0" width="100%">

                          <tbody>

                            <tr>

                              <!-- <td width="1%"><div align="center"><img src="css/bg_list.gif" height="16" width="16"></div></td> -->

                              <td class="F_bold" width="32%" style="color:#fff;">备份数据</td>

                              <td class="F_bold" width="33%">&nbsp;</td>

                              <td valign="middle" width="34%">&nbsp;</td>

                            </tr>

                          </tbody>

                        </table></td>

                    </tr>

                  </tbody>

                </table></td>

              <td width="16"><img src="css/bg_list.gif" height="25" width="16"></td>

            </tr>

          </tbody>

        </table></td>

    </tr>

    <tr>

      <td><table border="0" cellpadding="0" cellspacing="0" width="100%">

          <tbody>

            <tr>

              <td align="center" height="200"><!-- 開始  -->

                

                <div id="result"><?php show_msg($msgs); ?><br>

    <form name="form1" method="post" action="backup.php">  

    <table  align="center" bgcolor="ffffff" border="0"  cellpadding="1" cellspacing="1" width="100%" class='Tab'><br>  

      <tr><td colspan="2" bgcolor="#D4E5F4">备份方式</td></tr>  

      <tr><td style="width:30%"><input type="radio" name="bfzl" value="quanbubiao" checked>备份全部数据</td>

          <td>备份全部数据表中的数据到一个备份文件</td></tr>  

      <tr><td><input type="radio" name="bfzl" value="danbiao">备份单张表数据  

          <select name="tablename"><option value="">请选择</option>  

            <?  

    $d->query("show table status from $mydbname");  

    while($d->nextrecord()){  

    echo "<option value='".$d->f('Name')."'>".$d->f('Name')."</option>";}  

    ?>  

          </select></td><td>备份选中数据表中的数据到单独的备份文件</td></tr>  

      <tr><td colspan="2" bgcolor="#D4E5F4">使用分卷备份</td></tr>  

      <tr><td colspan="2"><input type="checkbox" name="fenjuan" value="yes">分卷备份 <input name="filesize" type="text" size="10">K</td></tr>  

      <tr><td colspan="2" bgcolor="#D4E5F4">选择目标位置</td></tr>  

      <tr><td colspan="2"><input type="radio" name="weizhi" value="server" checked>备份到服务器</td></tr><tr class="cells"><td colspan='2'> <input type="radio" name="weizhi" value="localpc">备份到本地</td></tr>  

      <tr><td colspan="2" align='center'><input type="submit" name="act" value="备 份" class="button_a"></td></tr>  

    </table></form> 

</div>

                

                <!-- 結束  --></td>

            </tr>

          </tbody>

        </table></td>

    </tr>

<!--     <tr>

  <td background="css/bg_list.gif" height="35"><table border="0" cellpadding="0" cellspacing="0" width="100%">

      <tbody>

        <tr>

          <td height="35" width="12"><img src="css/bg_list.gif" height="35" width="12"></td>

          <td valign="top"><table border="0" cellpadding="0" cellspacing="0" height="25" width="100%">

              <tbody>

                <tr>

                  <td align="center"><div disabled="disabled" align="right"></div></td>

                </tr>

              </tbody>

            </table></td>

          <td width="1%"><img src="css/bg_list.gif" height="35" width="16"></td>

        </tr>

      </tbody>

    </table></td>

</tr> -->

  </tbody>

</table>

</body>

</html>                    

<?/*-------------界面结束-------------*/}/*---------------------------------*/  

/*----*/else{/*--------------主程序-----------------------------------------*/  

if($_POST['weizhi']=="localpc"&&$_POST['fenjuan']=='yes')  

{$msgs[]="只有选择备份到服务器，才能使用分卷备份功能";  

show_msg($msgs); pageend();}  

if($_POST['fenjuan']=="yes"&&!$_POST['filesize'])  

{$msgs[]="您选择了分卷备份功能，但未填写分卷文件大小";  

show_msg($msgs); pageend();}  

if($_POST['weizhi']=="server"&&!writeable("./backup"))  

{$msgs[]="备份文件存放目录'./backup'不可写，请修改目录属性";  

show_msg($msgs); pageend();}  

  

/*----------备份全部表-------------*/if($_POST['bfzl']=="quanbubiao"){/*----*/  

/*----不分卷*/if(!$_POST['fenjuan']){/*--------------------------------*/  

if(!$tables=$d->query("show table status from $mydbname"))  

{$msgs[]="读数据库结构错误"; show_msg($msgs); pageend();}  

$sql="";  

while($d->nextrecord($tables))  

{  

$table=$d->f("Name");  

$sql.=make_header($table);  

$d->query("select * from $table");  

$num_fields=$d->nf();  

while($d->nextrecord())  

{$sql.=make_record($table,$num_fields);}  

}  

$filename=date("YmdHis",time())."_all.sql";  

if($_POST['weizhi']=="localpc") down_file($sql,$filename);  

elseif($_POST['weizhi']=="server")  

{if(write_file($sql,$filename))  

$msgs[]="全部数据表数据备份完成,生成备份文件'./backup/$filename'";  

else $msgs[]="备份全部数据表失败";  

show_msg($msgs);  

pageend();  

}  

/*-----------------不要卷结束*/}/*-----------------------*/  

/*-----------------分卷*/else{/*-------------------------*/  

if(!$_POST['filesize'])  

{$msgs[]="请填写备份文件分卷大小"; show_msg($msgs);pageend();}  

if(!$tables=$d->query("show table status from $mydbname"))  

{$msgs[]="读数据库结构错误"; show_msg($msgs); pageend();}  

$sql=""; $p=1;  

$filename=date("YmdHis",time())."_all";  

while($d->nextrecord($tables))  

{  

$table=$d->f("Name");  

$sql.=make_header($table);  

$d->query("select * from $table");  

$num_fields=$d->nf();  

while($d->nextrecord())  

{$sql.=make_record($table,$num_fields);  

if(strlen($sql)>=$_POST['filesize']*1000){  

     $filename.=("_v".$p.".sql");  

     if(write_file($sql,$filename))  

     $msgs[]="全部数据表-卷-".$p."-数据备份完成,生成备份文件'./backup/$filename'";  

     else $msgs[]="备份表-".$_POST['tablename']."-失败";  

     $p++;  

     $filename=date("YmdHis",time())."_all";  

     $sql="";}  

}  

}  

if($sql!=""){$filename.=("_v".$p.".sql");   

if(write_file($sql,$filename))  

$msgs[]="全部数据表-卷-".$p."-数据备份完成,生成备份文件'./backup/$filename'";}  

show_msg($msgs);  

/*---------------------分卷结束*/}/*--------------------------------------*/  

/*--------备份全部表结束*/}/*---------------------------------------------*/  

  

/*--------备份单表------*/elseif($_POST['bfzl']=="danbiao"){/*------------*/  

if(!$_POST['tablename'])  

{$msgs[]="请选择要备份的数据表"; show_msg($msgs); pageend();}  

/*--------不分卷*/if(!$_POST['fenjuan']){/*-------------------------------*/  

$sql=make_header($_POST['tablename']);  

$d->query("select * from ".$_POST['tablename']);  

$num_fields=$d->nf();  

while($d->nextrecord())  

{$sql.=make_record($_POST['tablename'],$num_fields);}  

$filename=date("YmdHis",time())."_".$_POST['tablename'].".sql";  

if($_POST['weizhi']=="localpc") down_file($sql,$filename);  

elseif($_POST['weizhi']=="server")  

{if(write_file($sql,$filename))  

$msgs[]="表-".$_POST['tablename']."-数据备份完成,生成备份文件'./backup/$filename'";  

else $msgs[]="备份表-".$_POST['tablename']."-失败";  

show_msg($msgs);  

pageend();  

}  

/*----------------不要卷结束*/}/*------------------------------------*/  

/*----------------分卷*/else{/*--------------------------------------*/  

if(!$_POST['filesize'])  

{$msgs[]="请填写备份文件分卷大小"; show_msg($msgs);pageend();}  

$sql=make_header($_POST['tablename']); $p=1;  

$filename=date("YmdHis",time())."_".$_POST['tablename'];  

$d->query("select * from ".$_POST['tablename']);  

$num_fields=$d->nf();  

while ($d->nextrecord())  

{  

    $sql.=make_record($_POST['tablename'],$num_fields);  

      if(strlen($sql)>=$_POST['filesize']*1000){  

     $filename.=("_v".$p.".sql");  

     if(write_file($sql,$filename))  

     $msgs[]="表-".$_POST['tablename']."-卷-".$p."-数据备份完成,生成备份文件'./backup/$filename'";  

     else $msgs[]="备份表-".$_POST['tablename']."-失败";  

     $p++;  

     $filename=date("YmdHis",time())."_".$_POST['tablename'];  

     $sql="";}  

}  

if($sql!=""){$filename.=("_v".$p.".sql");   

if(write_file($sql,$filename))  

$msgs[]="表-".$_POST['tablename']."-卷-".$p."-数据备份完成,生成备份文件'./backup/$filename'";}  

show_msg($msgs);  

/*----------分卷结束*/}/*--------------------------------------------------*/  

/*----------备份单表结束*/}/*----------------------------------------------*/  

  

/*---*/}/*-------------主程序结束------------------------------------------*/  

  

function write_file($sql,$filename)  

{  

$re=true;  

if(!@$fp=fopen("./backup/".$filename,"w+")) {$re=false; echo "failed to open target file";}  

if(!@fwrite($fp,$sql)) {$re=false; echo "failed to write file";}  

if(!@fclose($fp)) {$re=false; echo "failed to close target file";}  

return $re;  

}  

  

function down_file($sql,$filename)  

{  

ob_end_clean();  

header("Content-Encoding: none");  

header("Content-Type: ".(strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') ? 'application/octetstream' : 'application/octet-stream'));  

    

header("Content-Disposition: ".(strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') ? 'inline; ' : 'attachment; ')."filename=".$filename);  

    

header("Content-Length: ".strlen($sql));  

header("Pragma: no-cache");  

    

header("Expires: 0");  

echo $sql;  

$e=ob_get_contents();  

ob_end_clean();  

}  

  

function writeable($dir)  

{  

  

if(!is_dir($dir)) {  

@mkdir($dir, 0777);  

}  

  

if(is_dir($dir))  

{  

  

if($fp = @fopen("$dir/test.test", 'w'))  

    {  

@fclose($fp);  

@unlink("$dir/test.test");  

$writeable = 1;  

}  

else {  

$writeable = 0;  

}  

  

}  

  

return $writeable;  

  

}  

  

function make_header($table)  

{global $d;  

$sql="DROP TABLE IF EXISTS ".$table."\n";  

$d->query("show create table ".$table);  

$d->nextrecord();  

$tmp=preg_replace("/\n/","",$d->f("Create Table"));  

$sql.=$tmp."\n";  

return $sql;  

}  

  

function make_record($table,$num_fields)  

{global $d;  

$comma="";  

$sql .= "INSERT INTO ".$table." VALUES(";  

for($i = 0; $i < $num_fields; $i++)  

{$sql .= ($comma."'".mysql_escape_string($d->record[$i])."'"); $comma = ",";}  

$sql .= ")\n";  

return $sql;  

}  

  

function show_msg($msgs)  

{  

$title="&nbsp;提示：";  

echo "<table width='100%' border='0'    cellpadding='0' cellspacing='1' class='Tab'>";  

echo "<tr><td bgcolor=#D4E5F4>".$title."</td></tr>";  

echo "<tr><td><ul>";  

while (list($k,$v)=each($msgs))  

{  

echo "<li><font color=red>".$v."</font></li>";  

}  

echo "</ul></td></tr></table>";  

}  

  

function pageend()  

{  

exit();  

}  

?>  