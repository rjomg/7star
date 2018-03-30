
<?php
include_once( "../../../global.php" );
include_once( "rate.class.php" );
$db = new rate0( $mydbhost, $mydbuser, $mydbpw, $mydbname, ALL_PS, $mydbcharset );
$rate = array( );
$x = array( "Êó", "Å£", "»¢", "ÍÃ", "Áú", "Éß", "Âí", "Ñò", "ºï", "¼¦", "¹·", "Öí" );
$rate[0] = $db->get_rate( 43 );
$rate[1] = $db->get_rate( 45 );
$rate[2] = $db->get_rate( 46 );
$rate[3] = $db->get_rate( 47 );
$rate[4] = $db->get_rate( 48 );
$rate[5] = $db->get_rate( 49 );
$rate[6] = $db->get_rate( 44 );
$rate[7] = $db->get_rate( 50 );
$rates = $rate[0][Êó][1];

?>
<html oncontextmenu="return false" xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<body>

<link href="../../images/Index.css" rel="stylesheet" type="text/css">
<script src="../../js/jquery-1.4.3.min.js?i=0" type="text/javascript"></script>
<script src="js/sx_ws.js?i=b" type="text/javascript"></script>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
  <tbody>
    <tr>
      <td background="../../images/tab_05.gif" height="30"><table border="0" cellpadding="0" cellspacing="0" width="100%">
          <tbody>
            <tr>
              <td height="30" width="12"><img src="../../images/tab_03.gif" height="30" width="12"></td>
              <td><table border="0" cellpadding="0" cellspacing="0" width="100%">
                  <tbody>
                    <tr>
                      <td valign="middle" width="87%"><table border="0" cellpadding="0" cellspacing="0" width="100%">
                          <tbody>
                            <tr>
                              <td width="1%"><div align="center"><img src="../../images/tb.gif" height="16" width="16"></div></td>
                              <td class="F_bold" width="150"><span id="ftm1">ÌØÐ¤/Ò»Ð¤/Î²Êý</span>ÙrÂÊÔOÖÃ<span style="DISPLAY:">
                                <input name="x2" id="x2" value="DcwD2FCHVv4!888" type="hidden">
                                <input name="ex2" id="ex2" value="ÌØÐ¤" type="hidden">
                                </span></td>
                              <td class="F_bold">&nbsp;</td>
                              <td class="F_bold">&nbsp;</td>
                              <td class="F_bold">&nbsp;</td>
                            </tr>
                          </tbody>
                        </table></td>
                    </tr>
                  </tbody>
                </table></td>
              <td width="16"><img src="../../images/tab_07.gif" height="30" width="16"></td>
            </tr>
          </tbody>
        </table></td>
    </tr>
    <tr>
      <td><table border="0" cellpadding="0" cellspacing="0" width="100%">
          <tbody>
            <tr>
              <td background="../../images/tab_12.gif" width="8">&nbsp;</td>
              <td align="center" height="50"><!-- é_Ê¼  -->
                <div id="result">
                  <table class="Ball_List Tab" align="center" bgcolor="ffffff" border="0" bordercolor="f1f1f1" cellpadding="1" cellspacing="1" width="99%">
                   <tbody>
                      <tr class="td_caption_1">
                        <td bordercolor="cccccc" bgcolor="#DFEFFF" nowrap="nowrap" width="20"><div align="center"> NO </div></td>
                        <td bordercolor="cccccc" bgcolor="#DFEFFF" nowrap="nowrap"><div align="center">ÌØÐ¤</div></td>
<!--                        <td bordercolor="cccccc" bgcolor="#DFEFFF" nowrap="nowrap" width="36">¿‚î~</td>-->
                        <td bordercolor="cccccc" bgcolor="#DFEFFF" nowrap="nowrap"><div align="center">¶þÐ¤</div></td>
<!--                        <td bordercolor="cccccc" bgcolor="#DFEFFF" nowrap="nowrap" width="36">¿‚î~</td>-->
                        <td bordercolor="cccccc" bgcolor="#DFEFFF" nowrap="nowrap"><div align="center">ÈýÐ¤</div></td>
<!--                        <td bordercolor="cccccc" bgcolor="#DFEFFF" nowrap="nowrap" width="36">¿‚î~</td>-->
                        <td bordercolor="cccccc" bgcolor="#DFEFFF" nowrap="nowrap"><div align="center">ËÄÐ¤</div></td>
<!--                        <td bordercolor="cccccc" bgcolor="#DFEFFF" nowrap="nowrap" width="36">¿‚î~</td>-->
                        <td bordercolor="cccccc" bgcolor="#DFEFFF" nowrap="nowrap"><div align="center">ÎåÐ¤</div></td>
<!--                        <td bordercolor="cccccc" bgcolor="#DFEFFF" nowrap="nowrap" width="36">¿‚î~</td>-->
                        <td bordercolor="cccccc" bgcolor="#DFEFFF" nowrap="nowrap"><div align="center">ÁùÐ¤</div></td>
<!--                        <td bordercolor="cccccc" bgcolor="#DFEFFF" nowrap="nowrap" width="36">¿‚î~</td>-->
                        <td bordercolor="cccccc" bgcolor="#DFEFFF" nowrap="nowrap">Ò»Ð¤</td>
<!--                        <td bordercolor="cccccc" bgcolor="#DFEFFF" nowrap="nowrap" width="36">¿‚î~</td>-->
                        <td bordercolor="cccccc" bgcolor="#DFEFFF" nowrap="nowrap" width="20"><div align="center"> NO </div></td>
                        <td bordercolor="cccccc" bgcolor="#DFEFFF" nowrap="nowrap">Î²Êý</td>
<!--                        <td bordercolor="cccccc" bgcolor="#DFEFFF" nowrap="nowrap" width="36">¿‚î~</td>-->
                      </tr>
                        
                      <tr style="background-color: rgb(255, 255, 255);" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor='ffffff'" bgcolor="#FFFFFF">
                      
                                                <td bordercolor="cccccc" class="ball_a" align="center" height="25">Êó</td>
                                                <td align="center" height="25">
                            <input type="hidden" value="Êó" class="name43">
                            <a style="" onClick="UpdateRate(43,1,$(this).next('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_01.gif" border="0" height="17" width="19"></span></a>
                            <input onBlur="UpdateRate(43,1,$(this),0);" class="rate_set43 rate_color" type="text" style="width:63px;" value="<?php echo $rate[0][Êó][1] ;?>">
                            <a style="" onClick="UpdateRate(43,2,$(this).prev('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_02.gif" border="0" height="17" width="19"></span></a><span style="vertical-align:middle;">
                            <input onClick="UpdateRate(43,3,$(this),0);" class="num_close43" name="checkbox" style="" title="êPé]Ô“í—" value="TRUE" type="checkbox">
                        </span>
                        </td>
<!--                        <td align="center" height="25"><span id="gold-1 ball"><font class="odd_total43" color="ff6400"></font></span></td>-->
                     
                                                <td align="center" height="25">
                            <input type="hidden" value="Êó" class="name45">
                            <a style="" onClick="UpdateRate(45,1,$(this).next('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_01.gif" border="0" height="17" width="19"></span></a>
                            <input onBlur="UpdateRate(45,1,$(this),0);" class="rate_set45 rate_color" type="text" style="width:63px;" value="<?php echo $rate[1][Êó][1] ;?>">
                            <a style="" onClick="UpdateRate(45,2,$(this).prev('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_02.gif" border="0" height="17" width="19"></span></a><span style="vertical-align:middle;">
                            <input onClick="UpdateRate(45,3,$(this),0);" class="num_close45" name="checkbox" style="" title="êPé]Ô“í—" value="TRUE" type="checkbox">
                        </span>
                        </td>
<!--                        <td align="center" height="25"><span id="gold-1 ball"><font class="odd_total44" color="ff6400"></font></span></td>-->
                     
                                                <td align="center" height="25">
                            <input type="hidden" value="Êó" class="name46">
                            <a style="" onClick="UpdateRate(46,1,$(this).next('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_01.gif" border="0" height="17" width="19"></span></a>
                            <input onBlur="UpdateRate(46,1,$(this),0);" class="rate_set46 rate_color" type="text" style="width:63px;" value="<?php echo $rate[2][Êó][1] ;?>">
                            <a style="" onClick="UpdateRate(46,2,$(this).prev('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_02.gif" border="0" height="17" width="19"></span></a><span style="vertical-align:middle;">
                            <input onClick="UpdateRate(46,3,$(this),0);" class="num_close46" name="checkbox" style="" title="êPé]Ô“í—" value="TRUE" type="checkbox">
                        </span>
                        </td>
<!--                        <td align="center" height="25"><span id="gold-1 ball"><font class="odd_total46" color="ff6400"></font></span></td>-->
                     
                                                <td align="center" height="25">
                            <input type="hidden" value="Êó" class="name47">
                            <a style="" onClick="UpdateRate(47,1,$(this).next('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_01.gif" border="0" height="17" width="19"></span></a>
                            <input onBlur="UpdateRate(47,1,$(this),0);" class="rate_set47 rate_color" type="text" style="width:63px;" value="<?php echo $rate[3][Êó][1] ;?>">
                            <a style="" onClick="UpdateRate(47,2,$(this).prev('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_02.gif" border="0" height="17" width="19"></span></a><span style="vertical-align:middle;">
                            <input onClick="UpdateRate(47,3,$(this),0);" class="num_close47" name="checkbox" style="" title="êPé]Ô“í—" value="TRUE" type="checkbox">
                        </span>
                        </td>
<!--                        <td align="center" height="25"><span id="gold-1 ball"><font class="odd_total47" color="ff6400"></font></span></td>-->
                     
                                                <td align="center" height="25">
                            <input type="hidden" value="Êó" class="name48">
                            <a style="" onClick="UpdateRate(48,1,$(this).next('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_01.gif" border="0" height="17" width="19"></span></a>
                            <input onBlur="UpdateRate(48,1,$(this),0);" class="rate_set48 rate_color" type="text" style="width:63px;" value="<?php echo $rate[4][Êó][1] ;?>">
                            <a style="" onClick="UpdateRate(48,2,$(this).prev('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_02.gif" border="0" height="17" width="19"></span></a><span style="vertical-align:middle;">
                            <input onClick="UpdateRate(48,3,$(this),0);" class="num_close48" name="checkbox" style="" title="êPé]Ô“í—" value="TRUE" type="checkbox">
                        </span>
                        </td>
<!--                        <td align="center" height="25"><span id="gold-1 ball"><font class="odd_total48" color="ff6400"></font></span></td>-->
                     
                                                <td align="center" height="25">
                            <input type="hidden" value="Êó" class="name49">
                            <a style="" onClick="UpdateRate(49,1,$(this).next('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_01.gif" border="0" height="17" width="19"></span></a>
                            <input onBlur="UpdateRate(49,1,$(this),0);" class="rate_set49 rate_color" type="text" style="width:63px;" value="<?php echo $rate[5][Êó][1] ;?>">
                            <a style="" onClick="UpdateRate(49,2,$(this).prev('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_02.gif" border="0" height="17" width="19"></span></a><span style="vertical-align:middle;">
                            <input onClick="UpdateRate(49,3,$(this),0);" class="num_close49" name="checkbox" style="" title="êPé]Ô“í—" value="TRUE" type="checkbox">
                        </span>
                        </td>
<!--                        <td align="center" height="25"><span id="gold-1 ball"><font class="odd_total49" color="ff6400"></font></span></td>-->
                     
                                                <td align="center" height="25">
                            <input type="hidden" value="Êó" class="name44">
                            <a style="" onClick="UpdateRate(44,1,$(this).next('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_01.gif" border="0" height="17" width="19"></span></a>
                            <input onBlur="UpdateRate(44,1,$(this),0);" class="rate_set44 rate_color" type="text" style="width:63px;" value="<?php echo $rate[6][Êó][1] ;?>">
                            <a style="" onClick="UpdateRate(44,2,$(this).prev('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_02.gif" border="0" height="17" width="19"></span></a><span style="vertical-align:middle;">
                            <input onClick="UpdateRate(44,3,$(this),0);" class="num_close44" name="checkbox" style="" title="êPé]Ô“í—" value="TRUE" type="checkbox">
                        </span>
                        </td>
<!--                        <td align="center" height="25"><span id="gold-1 ball"><font class="odd_total44" color="ff6400"></font></span></td>-->
                     
                                                <td bordercolor="cccccc" class="ball_a" align="center" height="25">0</td>
                                                <td align="center" height="25">
                            <input type="hidden" value="0" class="name50">
                            <a style="" onClick="UpdateRate(50,1,$(this).next('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_01.gif" border="0" height="17" width="19"></span></a>
                            <input onBlur="UpdateRate(50,1,$(this),0);" class="rate_set50 rate_color" type="text" style="width:63px;" value="<?php echo $rate[7][0][1] ;?>">
                            <a style="" onClick="UpdateRate(50,2,$(this).prev('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_02.gif" border="0" height="17" width="19"></span></a><span style="vertical-align:middle;">
                            <input onClick="UpdateRate(50,3,$(this),0);" class="num_close50" name="checkbox" style="" title="êPé]Ô“í—" value="TRUE" type="checkbox">
                        </span>
                        </td>
<!--                        <td align="center" height="25"><span id="gold-1 ball"><font class="odd_total50" color="ff6400"></font></span></td>-->
                      </tr>
                      
                      <tr style="background-color: rgb(255, 255, 255);" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor='ffffff'" bgcolor="#FFFFFF">
                      
                                                <td bordercolor="cccccc" class="ball_a" align="center" height="25">Å£</td>
                                                <td align="center" height="25">
                            <input type="hidden" value="Å£" class="name43">
                            <a style="" onClick="UpdateRate(43,1,$(this).next('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_01.gif" border="0" height="17" width="19"></span></a>
                            <input onBlur="UpdateRate(43,1,$(this),0);" class="rate_set43 rate_color" type="text" style="width:63px;" value="<?php echo $rate[0][Å£][1] ;?>">
                            <a style="" onClick="UpdateRate(43,2,$(this).prev('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_02.gif" border="0" height="17" width="19"></span></a><span style="vertical-align:middle;">
                            <input onClick="UpdateRate(43,3,$(this),0);" class="num_close43" name="checkbox" style="" title="êPé]Ô“í—" value="TRUE" type="checkbox">
                        </span>
                        </td>
<!--                        <td align="center" height="25"><span id="gold0 ball"><font class="odd_total43" color="ff6400"></font></span></td>-->
                     
                                                <td align="center" height="25">
                            <input type="hidden" value="Å£" class="name45">
                            <a style="" onClick="UpdateRate(45,1,$(this).next('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_01.gif" border="0" height="17" width="19"></span></a>
                            <input onBlur="UpdateRate(45,1,$(this),0);" class="rate_set45 rate_color" type="text" style="width:63px;" value="<?php echo $rate[1][Å£][1] ;?>">
                            <a style="" onClick="UpdateRate(45,2,$(this).prev('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_02.gif" border="0" height="17" width="19"></span></a><span style="vertical-align:middle;">
                            <input onClick="UpdateRate(45,3,$(this),0);" class="num_close45" name="checkbox" style="" title="êPé]Ô“í—" value="TRUE" type="checkbox">
                        </span>
                        </td>
<!--                        <td align="center" height="25"><span id="gold0 ball"><font class="odd_total44" color="ff6400"></font></span></td>-->
                     
                                                <td align="center" height="25">
                            <input type="hidden" value="Å£" class="name46">
                            <a style="" onClick="UpdateRate(46,1,$(this).next('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_01.gif" border="0" height="17" width="19"></span></a>
                            <input onBlur="UpdateRate(46,1,$(this),0);" class="rate_set46 rate_color" type="text" style="width:63px;" value="<?php echo $rate[2][Å£][1] ;?>">
                            <a style="" onClick="UpdateRate(46,2,$(this).prev('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_02.gif" border="0" height="17" width="19"></span></a><span style="vertical-align:middle;">
                            <input onClick="UpdateRate(46,3,$(this),0);" class="num_close46" name="checkbox" style="" title="êPé]Ô“í—" value="TRUE" type="checkbox">
                        </span>
                        </td>
<!--                        <td align="center" height="25"><span id="gold0 ball"><font class="odd_total46" color="ff6400"></font></span></td>-->
                     
                                                <td align="center" height="25">
                            <input type="hidden" value="Å£" class="name47">
                            <a style="" onClick="UpdateRate(47,1,$(this).next('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_01.gif" border="0" height="17" width="19"></span></a>
                            <input onBlur="UpdateRate(47,1,$(this),0);" class="rate_set47 rate_color" type="text" style="width:63px;" value="<?php echo $rate[3][Å£][1] ;?>">
                            <a style="" onClick="UpdateRate(47,2,$(this).prev('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_02.gif" border="0" height="17" width="19"></span></a><span style="vertical-align:middle;">
                            <input onClick="UpdateRate(47,3,$(this),0);" class="num_close47" name="checkbox" style="" title="êPé]Ô“í—" value="TRUE" type="checkbox">
                        </span>
                        </td>
<!--                        <td align="center" height="25"><span id="gold0 ball"><font class="odd_total47" color="ff6400"></font></span></td>-->
                     
                                                <td align="center" height="25">
                            <input type="hidden" value="Å£" class="name48">
                            <a style="" onClick="UpdateRate(48,1,$(this).next('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_01.gif" border="0" height="17" width="19"></span></a>
                            <input onBlur="UpdateRate(48,1,$(this),0);" class="rate_set48 rate_color" type="text" style="width:63px;" value="<?php echo $rate[4][Å£][1] ;?>">
                            <a style="" onClick="UpdateRate(48,2,$(this).prev('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_02.gif" border="0" height="17" width="19"></span></a><span style="vertical-align:middle;">
                            <input onClick="UpdateRate(48,3,$(this),0);" class="num_close48" name="checkbox" style="" title="êPé]Ô“í—" value="TRUE" type="checkbox">
                        </span>
                        </td>
<!--                        <td align="center" height="25"><span id="gold0 ball"><font class="odd_total48" color="ff6400"></font></span></td>-->
                     
                                                <td align="center" height="25">
                            <input type="hidden" value="Å£" class="name49">
                            <a style="" onClick="UpdateRate(49,1,$(this).next('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_01.gif" border="0" height="17" width="19"></span></a>
                            <input onBlur="UpdateRate(49,1,$(this),0);" class="rate_set49 rate_color" type="text" style="width:63px;" value="<?php echo $rate[5][Å£][1] ;?>">
                            <a style="" onClick="UpdateRate(49,2,$(this).prev('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_02.gif" border="0" height="17" width="19"></span></a><span style="vertical-align:middle;">
                            <input onClick="UpdateRate(49,3,$(this),0);" class="num_close49" name="checkbox" style="" title="êPé]Ô“í—" value="TRUE" type="checkbox">
                        </span>
                        </td>
<!--                        <td align="center" height="25"><span id="gold0 ball"><font class="odd_total49" color="ff6400"></font></span></td>-->
                     
                                                <td align="center" height="25">
                            <input type="hidden" value="Å£" class="name44">
                            <a style="" onClick="UpdateRate(44,1,$(this).next('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_01.gif" border="0" height="17" width="19"></span></a>
                            <input onBlur="UpdateRate(44,1,$(this),0);" class="rate_set44 rate_color" type="text" style="width:63px;" value="<?php echo $rate[6][Å£][1] ;?>">
                            <a style="" onClick="UpdateRate(44,2,$(this).prev('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_02.gif" border="0" height="17" width="19"></span></a><span style="vertical-align:middle;">
                            <input onClick="UpdateRate(44,3,$(this),0);" class="num_close44" name="checkbox" style="" title="êPé]Ô“í—" value="TRUE" type="checkbox">
                        </span>
                        </td>
<!--                        <td align="center" height="25"><span id="gold0 ball"><font class="odd_total44" color="ff6400"></font></span></td>-->
                     
                                                <td bordercolor="cccccc" class="ball_a" align="center" height="25">1</td>
                                                <td align="center" height="25">
                            <input type="hidden" value="1" class="name50">
                            <a style="" onClick="UpdateRate(50,1,$(this).next('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_01.gif" border="0" height="17" width="19"></span></a>
                            <input onBlur="UpdateRate(50,1,$(this),0);" class="rate_set50 rate_color" type="text" style="width:63px;" value="<?php echo $rate[7][1][1] ;?>">
                            <a style="" onClick="UpdateRate(50,2,$(this).prev('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_02.gif" border="0" height="17" width="19"></span></a><span style="vertical-align:middle;">
                            <input onClick="UpdateRate(50,3,$(this),0);" class="num_close50" name="checkbox" style="" title="êPé]Ô“í—" value="TRUE" type="checkbox">
                        </span>
                        </td>
<!--                        <td align="center" height="25"><span id="gold0 ball"><font class="odd_total50" color="ff6400"></font></span></td>-->
                      </tr>
                      
                      <tr style="background-color: rgb(255, 255, 255);" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor='ffffff'" bgcolor="#FFFFFF">
                      
                                                <td bordercolor="cccccc" class="ball_a" align="center" height="25">»¢</td>
                                                <td align="center" height="25">
                            <input type="hidden" value="»¢" class="name43">
                            <a style="" onClick="UpdateRate(43,1,$(this).next('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_01.gif" border="0" height="17" width="19"></span></a>
                            <input onBlur="UpdateRate(43,1,$(this),0);" class="rate_set43 rate_color" type="text" style="width:63px;" value="<?php echo $rate[0][»¢][1] ;?>">
                            <a style="" onClick="UpdateRate(43,2,$(this).prev('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_02.gif" border="0" height="17" width="19"></span></a><span style="vertical-align:middle;">
                            <input onClick="UpdateRate(43,3,$(this),0);" class="num_close43" name="checkbox" style="" title="êPé]Ô“í—" value="TRUE" type="checkbox">
                        </span>
                        </td>
<!--                        <td align="center" height="25"><span id="gold1 ball"><font class="odd_total43" color="ff6400"></font></span></td>-->
                     
                                                <td align="center" height="25">
                            <input type="hidden" value="»¢" class="name45">
                            <a style="" onClick="UpdateRate(45,1,$(this).next('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_01.gif" border="0" height="17" width="19"></span></a>
                            <input onBlur="UpdateRate(45,1,$(this),0);" class="rate_set45 rate_color" type="text" style="width:63px;" value="<?php echo $rate[1][»¢][1] ;?>">
                            <a style="" onClick="UpdateRate(45,2,$(this).prev('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_02.gif" border="0" height="17" width="19"></span></a><span style="vertical-align:middle;">
                            <input onClick="UpdateRate(45,3,$(this),0);" class="num_close45" name="checkbox" style="" title="êPé]Ô“í—" value="TRUE" type="checkbox">
                        </span>
                        </td>
<!--                        <td align="center" height="25"><span id="gold1 ball"><font class="odd_total44" color="ff6400"></font></span></td>-->
                     
                                                <td align="center" height="25">
                            <input type="hidden" value="»¢" class="name46">
                            <a style="" onClick="UpdateRate(46,1,$(this).next('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_01.gif" border="0" height="17" width="19"></span></a>
                            <input onBlur="UpdateRate(46,1,$(this),0);" class="rate_set46 rate_color" type="text" style="width:63px;" value="<?php echo $rate[2][»¢][1] ;?>">
                            <a style="" onClick="UpdateRate(46,2,$(this).prev('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_02.gif" border="0" height="17" width="19"></span></a><span style="vertical-align:middle;">
                            <input onClick="UpdateRate(46,3,$(this),0);" class="num_close46" name="checkbox" style="" title="êPé]Ô“í—" value="TRUE" type="checkbox">
                        </span>
                        </td>
<!--                        <td align="center" height="25"><span id="gold1 ball"><font class="odd_total46" color="ff6400"></font></span></td>-->
                     
                                                <td align="center" height="25">
                            <input type="hidden" value="»¢" class="name47">
                            <a style="" onClick="UpdateRate(47,1,$(this).next('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_01.gif" border="0" height="17" width="19"></span></a>
                            <input onBlur="UpdateRate(47,1,$(this),0);" class="rate_set47 rate_color" type="text" style="width:63px;" value="<?php echo $rate[3][»¢][1] ;?>">
                            <a style="" onClick="UpdateRate(47,2,$(this).prev('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_02.gif" border="0" height="17" width="19"></span></a><span style="vertical-align:middle;">
                            <input onClick="UpdateRate(47,3,$(this),0);" class="num_close47" name="checkbox" style="" title="êPé]Ô“í—" value="TRUE" type="checkbox">
                        </span>
                        </td>
<!--                        <td align="center" height="25"><span id="gold1 ball"><font class="odd_total47" color="ff6400"></font></span></td>-->
                     
                                                <td align="center" height="25">
                            <input type="hidden" value="»¢" class="name48">
                            <a style="" onClick="UpdateRate(48,1,$(this).next('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_01.gif" border="0" height="17" width="19"></span></a>
                            <input onBlur="UpdateRate(48,1,$(this),0);" class="rate_set48 rate_color" type="text" style="width:63px;" value="<?php echo $rate[4][Å£][1] ;?>">
                            <a style="" onClick="UpdateRate(48,2,$(this).prev('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_02.gif" border="0" height="17" width="19"></span></a><span style="vertical-align:middle;">
                            <input onClick="UpdateRate(48,3,$(this),0);" class="num_close48" name="checkbox" style="" title="êPé]Ô“í—" value="TRUE" type="checkbox">
                        </span>
                        </td>
<!--                        <td align="center" height="25"><span id="gold1 ball"><font class="odd_total48" color="ff6400"></font></span></td>-->
                     
                                                <td align="center" height="25">
                            <input type="hidden" value="»¢" class="name49">
                            <a style="" onClick="UpdateRate(49,1,$(this).next('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_01.gif" border="0" height="17" width="19"></span></a>
                            <input onBlur="UpdateRate(49,1,$(this),0);" class="rate_set49 rate_color" type="text" style="width:63px;" value="<?php echo $rate[5][»¢][1] ;?>">
                            <a style="" onClick="UpdateRate(49,2,$(this).prev('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_02.gif" border="0" height="17" width="19"></span></a><span style="vertical-align:middle;">
                            <input onClick="UpdateRate(49,3,$(this),0);" class="num_close49" name="checkbox" style="" title="êPé]Ô“í—" value="TRUE" type="checkbox">
                        </span>
                        </td>
<!--                        <td align="center" height="25"><span id="gold1 ball"><font class="odd_total49" color="ff6400"></font></span></td>-->
                     
                                                <td align="center" height="25">
                            <input type="hidden" value="»¢" class="name44">
                            <a style="" onClick="UpdateRate(44,1,$(this).next('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_01.gif" border="0" height="17" width="19"></span></a>
                            <input onBlur="UpdateRate(44,1,$(this),0);" class="rate_set44 rate_color" type="text" style="width:63px;" value="<?php echo $rate[6][»¢][1] ;?>">
                            <a style="" onClick="UpdateRate(44,2,$(this).prev('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_02.gif" border="0" height="17" width="19"></span></a><span style="vertical-align:middle;">
                            <input onClick="UpdateRate(44,3,$(this),0);" class="num_close44" name="checkbox" style="" title="êPé]Ô“í—" value="TRUE" type="checkbox">
                        </span>
                        </td>
<!--                        <td align="center" height="25"><span id="gold1 ball"><font class="odd_total44" color="ff6400"></font></span></td>-->
                     
                                                <td bordercolor="cccccc" class="ball_a" align="center" height="25">2</td>
                                                <td align="center" height="25">
                            <input type="hidden" value="2" class="name50">
                            <a style="" onClick="UpdateRate(50,1,$(this).next('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_01.gif" border="0" height="17" width="19"></span></a>
                            <input onBlur="UpdateRate(50,1,$(this),0);" class="rate_set50 rate_color" type="text" style="width:63px;" value="<?php echo $rate[7][2][1] ;?>">
                            <a style="" onClick="UpdateRate(50,2,$(this).prev('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_02.gif" border="0" height="17" width="19"></span></a><span style="vertical-align:middle;">
                            <input onClick="UpdateRate(50,3,$(this),0);" class="num_close50" name="checkbox" style="" title="êPé]Ô“í—" value="TRUE" type="checkbox">
                        </span>
                        </td>
<!--                        <td align="center" height="25"><span id="gold1 ball"><font class="odd_total50" color="ff6400"></font></span></td>-->
                      </tr>
                      
                      <tr style="background-color: rgb(255, 255, 255);" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor='ffffff'" bgcolor="#FFFFFF">
                      
                                                <td bordercolor="cccccc" class="ball_a" align="center" height="25">ÍÃ</td>
                                                <td align="center" height="25">
                            <input type="hidden" value="ÍÃ" class="name43">
                            <a style="" onClick="UpdateRate(43,1,$(this).next('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_01.gif" border="0" height="17" width="19"></span></a>
                            <input onBlur="UpdateRate(43,1,$(this),0);" class="rate_set43 rate_color" type="text" style="width:63px;" value="<?php echo $rate[0][ÍÃ][1] ;?>">
                            <a style="" onClick="UpdateRate(43,2,$(this).prev('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_02.gif" border="0" height="17" width="19"></span></a><span style="vertical-align:middle;">
                            <input onClick="UpdateRate(43,3,$(this),0);" class="num_close43" name="checkbox" style="" title="êPé]Ô“í—" value="TRUE" type="checkbox">
                        </span>
                        </td>
<!--                        <td align="center" height="25"><span id="gold2 ball"><font class="odd_total43" color="ff6400"></font></span></td>-->
                     
                                                <td align="center" height="25">
                            <input type="hidden" value="ÍÃ" class="name45">
                            <a style="" onClick="UpdateRate(45,1,$(this).next('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_01.gif" border="0" height="17" width="19"></span></a>
                            <input onBlur="UpdateRate(45,1,$(this),0);" class="rate_set45 rate_color" type="text" style="width:63px;" value="<?php echo $rate[1][ÍÃ][1] ;?>">
                            <a style="" onClick="UpdateRate(45,2,$(this).prev('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_02.gif" border="0" height="17" width="19"></span></a><span style="vertical-align:middle;">
                            <input onClick="UpdateRate(45,3,$(this),0);" class="num_close45" name="checkbox" style="" title="êPé]Ô“í—" value="TRUE" type="checkbox">
                        </span>
                        </td>
<!--                        <td align="center" height="25"><span id="gold2 ball"><font class="odd_total44" color="ff6400"></font></span></td>-->
                     
                                                <td align="center" height="25">
                            <input type="hidden" value="ÍÃ" class="name46">
                            <a style="" onClick="UpdateRate(46,1,$(this).next('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_01.gif" border="0" height="17" width="19"></span></a>
                            <input onBlur="UpdateRate(46,1,$(this),0);" class="rate_set46 rate_color" type="text" style="width:63px;" value="<?php echo $rate[2][ÍÃ][1] ;?>">
                            <a style="" onClick="UpdateRate(46,2,$(this).prev('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_02.gif" border="0" height="17" width="19"></span></a><span style="vertical-align:middle;">
                            <input onClick="UpdateRate(46,3,$(this),0);" class="num_close46" name="checkbox" style="" title="êPé]Ô“í—" value="TRUE" type="checkbox">
                        </span>
                        </td>
<!--                        <td align="center" height="25"><span id="gold2 ball"><font class="odd_total46" color="ff6400"></font></span></td>-->
                     
                                                <td align="center" height="25">
                            <input type="hidden" value="ÍÃ" class="name47">
                            <a style="" onClick="UpdateRate(47,1,$(this).next('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_01.gif" border="0" height="17" width="19"></span></a>
                            <input onBlur="UpdateRate(47,1,$(this),0);" class="rate_set47 rate_color" type="text" style="width:63px;" value="<?php echo $rate[3][ÍÃ][1] ;?>">
                            <a style="" onClick="UpdateRate(47,2,$(this).prev('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_02.gif" border="0" height="17" width="19"></span></a><span style="vertical-align:middle;">
                            <input onClick="UpdateRate(47,3,$(this),0);" class="num_close47" name="checkbox" style="" title="êPé]Ô“í—" value="TRUE" type="checkbox">
                        </span>
                        </td>
<!--                        <td align="center" height="25"><span id="gold2 ball"><font class="odd_total47" color="ff6400"></font></span></td>-->
                     
                                                <td align="center" height="25">
                            <input type="hidden" value="ÍÃ" class="name48">
                            <a style="" onClick="UpdateRate(48,1,$(this).next('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_01.gif" border="0" height="17" width="19"></span></a>
                            <input onBlur="UpdateRate(48,1,$(this),0);" class="rate_set48 rate_color" type="text" style="width:63px;" value="<?php echo $rate[4][ÍÃ][1] ;?>">
                            <a style="" onClick="UpdateRate(48,2,$(this).prev('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_02.gif" border="0" height="17" width="19"></span></a><span style="vertical-align:middle;">
                            <input onClick="UpdateRate(48,3,$(this),0);" class="num_close48" name="checkbox" style="" title="êPé]Ô“í—" value="TRUE" type="checkbox">
                        </span>
                        </td>
<!--                        <td align="center" height="25"><span id="gold2 ball"><font class="odd_total48" color="ff6400"></font></span></td>-->
                     
                                                <td align="center" height="25">
                            <input type="hidden" value="ÍÃ" class="name49">
                            <a style="" onClick="UpdateRate(49,1,$(this).next('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_01.gif" border="0" height="17" width="19"></span></a>
                            <input onBlur="UpdateRate(49,1,$(this),0);" class="rate_set49 rate_color" type="text" style="width:63px;" value="<?php echo $rate[5][ÍÃ][1] ;?>">
                            <a style="" onClick="UpdateRate(49,2,$(this).prev('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_02.gif" border="0" height="17" width="19"></span></a><span style="vertical-align:middle;">
                            <input onClick="UpdateRate(49,3,$(this),0);" class="num_close49" name="checkbox" style="" title="êPé]Ô“í—" value="TRUE" type="checkbox">
                        </span>
                        </td>
<!--                        <td align="center" height="25"><span id="gold2 ball"><font class="odd_total49" color="ff6400"></font></span></td>-->
                     
                                                <td align="center" height="25">
                            <input type="hidden" value="ÍÃ" class="name44">
                            <a style="" onClick="UpdateRate(44,1,$(this).next('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_01.gif" border="0" height="17" width="19"></span></a>
                            <input onBlur="UpdateRate(44,1,$(this),0);" class="rate_set44 rate_color" type="text" style="width:63px;" value="<?php echo $rate[6][ÍÃ][1] ;?>">
                            <a style="" onClick="UpdateRate(44,2,$(this).prev('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_02.gif" border="0" height="17" width="19"></span></a><span style="vertical-align:middle;">
                            <input onClick="UpdateRate(44,3,$(this),0);" class="num_close44" name="checkbox" style="" title="êPé]Ô“í—" value="TRUE" type="checkbox">
                        </span>
                        </td>
<!--                        <td align="center" height="25"><span id="gold2 ball"><font class="odd_total44" color="ff6400"></font></span></td>-->
                     
                                                <td bordercolor="cccccc" class="ball_a" align="center" height="25">3</td>
                                                <td align="center" height="25">
                            <input type="hidden" value="3" class="name50">
                            <a style="" onClick="UpdateRate(50,1,$(this).next('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_01.gif" border="0" height="17" width="19"></span></a>
                            <input onBlur="UpdateRate(50,1,$(this),0);" class="rate_set50 rate_color" type="text" style="width:63px;" value="<?php echo $rate[7][3][1] ;?>">
                            <a style="" onClick="UpdateRate(50,2,$(this).prev('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_02.gif" border="0" height="17" width="19"></span></a><span style="vertical-align:middle;">
                            <input onClick="UpdateRate(50,3,$(this),0);" class="num_close50" name="checkbox" style="" title="êPé]Ô“í—" value="TRUE" type="checkbox">
                        </span>
                        </td>
<!--                        <td align="center" height="25"><span id="gold2 ball"><font class="odd_total50" color="ff6400"></font></span></td>-->
                      </tr>
                      
                      <tr style="background-color: rgb(255, 255, 255);" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor='ffffff'" bgcolor="#FFFFFF">
                      
                                                <td bordercolor="cccccc" class="ball_a" align="center" height="25">Áú</td>
                                                <td align="center" height="25">
                            <input type="hidden" value="Áú" class="name43">
                            <a style="" onClick="UpdateRate(43,1,$(this).next('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_01.gif" border="0" height="17" width="19"></span></a>
                            <input onBlur="UpdateRate(43,1,$(this),0);" class="rate_set43 rate_color" type="text" style="width:63px;" value="<?php echo $rate[0][Áú][1] ;?>">
                            <a style="" onClick="UpdateRate(43,2,$(this).prev('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_02.gif" border="0" height="17" width="19"></span></a><span style="vertical-align:middle;">
                            <input onClick="UpdateRate(43,3,$(this),0);" class="num_close43" name="checkbox" style="" title="êPé]Ô“í—" value="TRUE" type="checkbox">
                        </span>
                        </td>
<!--                        <td align="center" height="25"><span id="gold3 ball"><font class="odd_total43" color="ff6400"></font></span></td>-->
                     
                                                <td align="center" height="25">
                            <input type="hidden" value="Áú" class="name45">
                            <a style="" onClick="UpdateRate(45,1,$(this).next('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_01.gif" border="0" height="17" width="19"></span></a>
                            <input onBlur="UpdateRate(45,1,$(this),0);" class="rate_set45 rate_color" type="text" style="width:63px;" value="<?php echo $rate[1][Áú][1] ;?>">
                            <a style="" onClick="UpdateRate(45,2,$(this).prev('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_02.gif" border="0" height="17" width="19"></span></a><span style="vertical-align:middle;">
                            <input onClick="UpdateRate(45,3,$(this),0);" class="num_close45" name="checkbox" style="" title="êPé]Ô“í—" value="TRUE" type="checkbox">
                        </span>
                        </td>
<!--                        <td align="center" height="25"><span id="gold3 ball"><font class="odd_total44" color="ff6400"></font></span></td>-->
                     
                                                <td align="center" height="25">
                            <input type="hidden" value="Áú" class="name46">
                            <a style="" onClick="UpdateRate(46,1,$(this).next('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_01.gif" border="0" height="17" width="19"></span></a>
                            <input onBlur="UpdateRate(46,1,$(this),0);" class="rate_set46 rate_color" type="text" style="width:63px;" value="<?php echo $rate[2][Áú][1] ;?>">
                            <a style="" onClick="UpdateRate(46,2,$(this).prev('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_02.gif" border="0" height="17" width="19"></span></a><span style="vertical-align:middle;">
                            <input onClick="UpdateRate(46,3,$(this),0);" class="num_close46" name="checkbox" style="" title="êPé]Ô“í—" value="TRUE" type="checkbox">
                        </span>
                        </td>
<!--                        <td align="center" height="25"><span id="gold3 ball"><font class="odd_total46" color="ff6400"></font></span></td>-->
                     
                                                <td align="center" height="25">
                            <input type="hidden" value="Áú" class="name47">
                            <a style="" onClick="UpdateRate(47,1,$(this).next('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_01.gif" border="0" height="17" width="19"></span></a>
                            <input onBlur="UpdateRate(47,1,$(this),0);" class="rate_set47 rate_color" type="text" style="width:63px;" value="<?php echo $rate[3][Áú][1] ;?>">
                            <a style="" onClick="UpdateRate(47,2,$(this).prev('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_02.gif" border="0" height="17" width="19"></span></a><span style="vertical-align:middle;">
                            <input onClick="UpdateRate(47,3,$(this),0);" class="num_close47" name="checkbox" style="" title="êPé]Ô“í—" value="TRUE" type="checkbox">
                        </span>
                        </td>
<!--                        <td align="center" height="25"><span id="gold3 ball"><font class="odd_total47" color="ff6400"></font></span></td>-->
                     
                                                <td align="center" height="25">
                            <input type="hidden" value="Áú" class="name48">
                            <a style="" onClick="UpdateRate(48,1,$(this).next('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_01.gif" border="0" height="17" width="19"></span></a>
                            <input onBlur="UpdateRate(48,1,$(this),0);" class="rate_set48 rate_color" type="text" style="width:63px;" value="<?php echo $rate[4][Áú][1] ;?>">
                            <a style="" onClick="UpdateRate(48,2,$(this).prev('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_02.gif" border="0" height="17" width="19"></span></a><span style="vertical-align:middle;">
                            <input onClick="UpdateRate(48,3,$(this),0);" class="num_close48" name="checkbox" style="" title="êPé]Ô“í—" value="TRUE" type="checkbox">
                        </span>
                        </td>
<!--                        <td align="center" height="25"><span id="gold3 ball"><font class="odd_total48" color="ff6400"></font></span></td>-->
                     
                                                <td align="center" height="25">
                            <input type="hidden" value="Áú" class="name49">
                            <a style="" onClick="UpdateRate(49,1,$(this).next('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_01.gif" border="0" height="17" width="19"></span></a>
                            <input onBlur="UpdateRate(49,1,$(this),0);" class="rate_set49 rate_color" type="text" style="width:63px;" value="<?php echo $rate[5][Áú][1] ;?>">
                            <a style="" onClick="UpdateRate(49,2,$(this).prev('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_02.gif" border="0" height="17" width="19"></span></a><span style="vertical-align:middle;">
                            <input onClick="UpdateRate(49,3,$(this),0);" class="num_close49" name="checkbox" style="" title="êPé]Ô“í—" value="TRUE" type="checkbox">
                        </span>
                        </td>
<!--                        <td align="center" height="25"><span id="gold3 ball"><font class="odd_total49" color="ff6400"></font></span></td>-->
                     
                                                <td align="center" height="25">
                            <input type="hidden" value="Áú" class="name44">
                            <a style="" onClick="UpdateRate(44,1,$(this).next('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_01.gif" border="0" height="17" width="19"></span></a>
                            <input onBlur="UpdateRate(44,1,$(this),0);" class="rate_set44 rate_color" type="text" style="width:63px;" value="<?php echo $rate[6][Áú][1] ;?>">
                            <a style="" onClick="UpdateRate(44,2,$(this).prev('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_02.gif" border="0" height="17" width="19"></span></a><span style="vertical-align:middle;">
                            <input onClick="UpdateRate(44,3,$(this),0);" class="num_close44" name="checkbox" style="" title="êPé]Ô“í—" value="TRUE" type="checkbox">
                        </span>
                        </td>
<!--                        <td align="center" height="25"><span id="gold3 ball"><font class="odd_total44" color="ff6400"></font></span></td>-->
                     
                                                <td bordercolor="cccccc" class="ball_a" align="center" height="25">4</td>
                                                <td align="center" height="25">
                            <input type="hidden" value="4" class="name50">
                            <a style="" onClick="UpdateRate(50,1,$(this).next('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_01.gif" border="0" height="17" width="19"></span></a>
                            <input onBlur="UpdateRate(50,1,$(this),0);" class="rate_set50 rate_color" type="text" style="width:63px;" value="<?php echo $rate[7][4][1] ;?>">
                            <a style="" onClick="UpdateRate(50,2,$(this).prev('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_02.gif" border="0" height="17" width="19"></span></a><span style="vertical-align:middle;">
                            <input onClick="UpdateRate(50,3,$(this),0);" class="num_close50" name="checkbox" style="" title="êPé]Ô“í—" value="TRUE" type="checkbox">
                        </span>
                        </td>
<!--                        <td align="center" height="25"><span id="gold3 ball"><font class="odd_total50" color="ff6400"></font></span></td>-->
                      </tr>
                      
                      <tr style="background-color: rgb(255, 255, 255);" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor='ffffff'" bgcolor="#FFFFFF">
                      
                                                <td bordercolor="cccccc" class="ball_a" align="center" height="25">Éß</td>
                                                <td align="center" height="25">
                            <input type="hidden" value="Éß" class="name43">
                            <a style="" onClick="UpdateRate(43,1,$(this).next('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_01.gif" border="0" height="17" width="19"></span></a>
                            <input onBlur="UpdateRate(43,1,$(this),0);" class="rate_set43 rate_color" type="text" style="width:63px;" value="<?php echo $rate[0][Éß][1] ;?>">
                            <a style="" onClick="UpdateRate(43,2,$(this).prev('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_02.gif" border="0" height="17" width="19"></span></a><span style="vertical-align:middle;">
                            <input onClick="UpdateRate(43,3,$(this),0);" class="num_close43" name="checkbox" style="" title="êPé]Ô“í—" value="TRUE" type="checkbox">
                        </span>
                        </td>
<!--                        <td align="center" height="25"><span id="gold4 ball"><font class="odd_total43" color="ff6400"></font></span></td>-->
                     
                                                <td align="center" height="25">
                            <input type="hidden" value="Éß" class="name45">
                            <a style="" onClick="UpdateRate(45,1,$(this).next('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_01.gif" border="0" height="17" width="19"></span></a>
                            <input onBlur="UpdateRate(45,1,$(this),0);" class="rate_set45 rate_color" type="text" style="width:63px;" value="<?php echo $rate[1][Éß][1] ;?>">
                            <a style="" onClick="UpdateRate(45,2,$(this).prev('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_02.gif" border="0" height="17" width="19"></span></a><span style="vertical-align:middle;">
                            <input onClick="UpdateRate(45,3,$(this),0);" class="num_close45" name="checkbox" style="" title="êPé]Ô“í—" value="TRUE" type="checkbox">
                        </span>
                        </td>
<!--                        <td align="center" height="25"><span id="gold4 ball"><font class="odd_total44" color="ff6400"></font></span></td>-->
                     
                                                <td align="center" height="25">
                            <input type="hidden" value="Éß" class="name46">
                            <a style="" onClick="UpdateRate(46,1,$(this).next('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_01.gif" border="0" height="17" width="19"></span></a>
                            <input onBlur="UpdateRate(46,1,$(this),0);" class="rate_set46 rate_color" type="text" style="width:63px;" value="<?php echo $rate[2][Éß][1] ;?>">
                            <a style="" onClick="UpdateRate(46,2,$(this).prev('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_02.gif" border="0" height="17" width="19"></span></a><span style="vertical-align:middle;">
                            <input onClick="UpdateRate(46,3,$(this),0);" class="num_close46" name="checkbox" style="" title="êPé]Ô“í—" value="TRUE" type="checkbox">
                        </span>
                        </td>
<!--                        <td align="center" height="25"><span id="gold4 ball"><font class="odd_total46" color="ff6400"></font></span></td>-->
                     
                                                <td align="center" height="25">
                            <input type="hidden" value="Éß" class="name47">
                            <a style="" onClick="UpdateRate(47,1,$(this).next('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_01.gif" border="0" height="17" width="19"></span></a>
                            <input onBlur="UpdateRate(47,1,$(this),0);" class="rate_set47 rate_color" type="text" style="width:63px;" value="<?php echo $rate[3][Éß][1] ;?>">
                            <a style="" onClick="UpdateRate(47,2,$(this).prev('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_02.gif" border="0" height="17" width="19"></span></a><span style="vertical-align:middle;">
                            <input onClick="UpdateRate(47,3,$(this),0);" class="num_close47" name="checkbox" style="" title="êPé]Ô“í—" value="TRUE" type="checkbox">
                        </span>
                        </td>
<!--                        <td align="center" height="25"><span id="gold4 ball"><font class="odd_total47" color="ff6400"></font></span></td>-->
                     
                                                <td align="center" height="25">
                            <input type="hidden" value="Éß" class="name48">
                            <a style="" onClick="UpdateRate(48,1,$(this).next('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_01.gif" border="0" height="17" width="19"></span></a>
                            <input onBlur="UpdateRate(48,1,$(this),0);" class="rate_set48 rate_color" type="text" style="width:63px;" value="<?php echo $rate[4][Éß][1] ;?>">
                            <a style="" onClick="UpdateRate(48,2,$(this).prev('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_02.gif" border="0" height="17" width="19"></span></a><span style="vertical-align:middle;">
                            <input onClick="UpdateRate(48,3,$(this),0);" class="num_close48" name="checkbox" style="" title="êPé]Ô“í—" value="TRUE" type="checkbox">
                        </span>
                        </td>
<!--                        <td align="center" height="25"><span id="gold4 ball"><font class="odd_total48" color="ff6400"></font></span></td>-->
                     
                                                <td align="center" height="25">
                            <input type="hidden" value="Éß" class="name49">
                            <a style="" onClick="UpdateRate(49,1,$(this).next('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_01.gif" border="0" height="17" width="19"></span></a>
                            <input onBlur="UpdateRate(49,1,$(this),0);" class="rate_set49 rate_color" type="text" style="width:63px;" value="<?php echo $rate[5][Éß][1] ;?>">
                            <a style="" onClick="UpdateRate(49,2,$(this).prev('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_02.gif" border="0" height="17" width="19"></span></a><span style="vertical-align:middle;">
                            <input onClick="UpdateRate(49,3,$(this),0);" class="num_close49" name="checkbox" style="" title="êPé]Ô“í—" value="TRUE" type="checkbox">
                        </span>
                        </td>
<!--                        <td align="center" height="25"><span id="gold4 ball"><font class="odd_total49" color="ff6400"></font></span></td>-->
                     
                                                <td align="center" height="25">
                            <input type="hidden" value="Éß" class="name44">
                            <a style="" onClick="UpdateRate(44,1,$(this).next('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_01.gif" border="0" height="17" width="19"></span></a>
                            <input onBlur="UpdateRate(44,1,$(this),0);" class="rate_set44 rate_color" type="text" style="width:63px;" value="<?php echo $rate[6][Éß][1] ;?>">
                            <a style="" onClick="UpdateRate(44,2,$(this).prev('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_02.gif" border="0" height="17" width="19"></span></a><span style="vertical-align:middle;">
                            <input onClick="UpdateRate(44,3,$(this),0);" class="num_close44" name="checkbox" style="" title="êPé]Ô“í—" value="TRUE" type="checkbox">
                        </span>
                        </td>
<!--                        <td align="center" height="25"><span id="gold4 ball"><font class="odd_total44" color="ff6400"></font></span></td>-->
                     
                                                <td bordercolor="cccccc" class="ball_a" align="center" height="25">5</td>
                                                <td align="center" height="25">
                            <input type="hidden" value="5" class="name50">
                            <a style="" onClick="UpdateRate(50,1,$(this).next('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_01.gif" border="0" height="17" width="19"></span></a>
                            <input onBlur="UpdateRate(50,1,$(this),0);" class="rate_set50 rate_color" type="text" style="width:63px;" value="<?php echo $rate[7][5][1] ;?>">
                            <a style="" onClick="UpdateRate(50,2,$(this).prev('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_02.gif" border="0" height="17" width="19"></span></a><span style="vertical-align:middle;">
                            <input onClick="UpdateRate(50,3,$(this),0);" class="num_close50" name="checkbox" style="" title="êPé]Ô“í—" value="TRUE" type="checkbox">
                        </span>
                        </td>
<!--                        <td align="center" height="25"><span id="gold4 ball"><font class="odd_total50" color="ff6400"></font></span></td>-->
                      </tr>
                      
                      <tr style="background-color: rgb(255, 255, 255);" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor='ffffff'" bgcolor="#FFFFFF">
                      
                                                <td bordercolor="cccccc" class="ball_a" align="center" height="25">Âí</td>
                                                <td align="center" height="25">
                            <input type="hidden" value="Âí" class="name43">
                            <a style="" onClick="UpdateRate(43,1,$(this).next('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_01.gif" border="0" height="17" width="19"></span></a>
                            <input onBlur="UpdateRate(43,1,$(this),0);" class="rate_set43 rate_color" type="text" style="width:63px;" value="<?php echo $rate[0][Âí][1] ;?>">
                            <a style="" onClick="UpdateRate(43,2,$(this).prev('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_02.gif" border="0" height="17" width="19"></span></a><span style="vertical-align:middle;">
                            <input onClick="UpdateRate(43,3,$(this),0);" class="num_close43" name="checkbox" style="" title="êPé]Ô“í—" value="TRUE" type="checkbox">
                        </span>
                        </td>
<!--                        <td align="center" height="25"><span id="gold5 ball"><font class="odd_total43" color="ff6400"></font></span></td>-->
                     
                                                <td align="center" height="25">
                            <input type="hidden" value="Âí" class="name45">
                            <a style="" onClick="UpdateRate(45,1,$(this).next('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_01.gif" border="0" height="17" width="19"></span></a>
                            <input onBlur="UpdateRate(45,1,$(this),0);" class="rate_set45 rate_color" type="text" style="width:63px;" value="<?php echo $rate[1][Âí][1] ;?>">
                            <a style="" onClick="UpdateRate(45,2,$(this).prev('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_02.gif" border="0" height="17" width="19"></span></a><span style="vertical-align:middle;">
                            <input onClick="UpdateRate(45,3,$(this),0);" class="num_close45" name="checkbox" style="" title="êPé]Ô“í—" value="TRUE" type="checkbox">
                        </span>
                        </td>
<!--                        <td align="center" height="25"><span id="gold5 ball"><font class="odd_total44" color="ff6400"></font></span></td>-->
                     
                        <td align="center" height="25">
                            <input type="hidden" value="Âí" class="name46">
                          <a style="" onClick="UpdateRate(46,1,$(this).next('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_01.gif" border="0" height="17" width="19"></span></a>
                            <input onBlur="UpdateRate(46,1,$(this),0);" class="rate_set46 rate_color" type="text" style="width:63px;" value="<?php echo $rate[2][Âí][1] ;?>">
                        <a style="" onClick="UpdateRate(46,2,$(this).prev('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_02.gif" border="0" height="17" width="19">
                        <input onclick="UpdateRate(46,3,$(this),0);" class="num_close46" name="checkbox2" style="" title="êPé]Ô“í—" value="TRUE" type="checkbox" />
                        </span></a></td>
<!--                        <td align="center" height="25"><span id="gold5 ball"><font class="odd_total46" color="ff6400"></font></span></td>-->
                     
                                                <td align="center" height="25">
                            <input type="hidden" value="Âí" class="name47">
                            <a style="" onClick="UpdateRate(47,1,$(this).next('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_01.gif" border="0" height="17" width="19"></span></a>
                            <input onBlur="UpdateRate(47,1,$(this),0);" class="rate_set47 rate_color" type="text" style="width:63px;" value="<?php echo $rate[3][Âí][1] ;?>">
                            <a style="" onClick="UpdateRate(47,2,$(this).prev('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_02.gif" border="0" height="17" width="19"></span></a><span style="vertical-align:middle;">
                            <input onClick="UpdateRate(47,3,$(this),0);" class="num_close47" name="checkbox" style="" title="êPé]Ô“í—" value="TRUE" type="checkbox">
                        </span>
                        </td>
<!--                        <td align="center" height="25"><span id="gold5 ball"><font class="odd_total47" color="ff6400"></font></span></td>-->
                     
                                                <td align="center" height="25">
                            <input type="hidden" value="Âí" class="name48">
                            <a style="" onClick="UpdateRate(48,1,$(this).next('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_01.gif" border="0" height="17" width="19"></span></a>
                            <input onBlur="UpdateRate(48,1,$(this),0);" class="rate_set48 rate_color" type="text" style="width:63px;" value="<?php echo $rate[4][Âí][1] ;?>">
                            <a style="" onClick="UpdateRate(48,2,$(this).prev('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_02.gif" border="0" height="17" width="19"></span></a><span style="vertical-align:middle;">
                            <input onClick="UpdateRate(48,3,$(this),0);" class="num_close48" name="checkbox" style="" title="êPé]Ô“í—" value="TRUE" type="checkbox">
                        </span>
                        </td>
<!--                        <td align="center" height="25"><span id="gold5 ball"><font class="odd_total48" color="ff6400"></font></span></td>-->
                     
                                                <td align="center" height="25">
                            <input type="hidden" value="Âí" class="name49">
                            <a style="" onClick="UpdateRate(49,1,$(this).next('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_01.gif" border="0" height="17" width="19"></span></a>
                            <input onBlur="UpdateRate(49,1,$(this),0);" class="rate_set49 rate_color" type="text" style="width:63px;" value="<?php echo $rate[5][Âí][1] ;?>">
                            <a style="" onClick="UpdateRate(49,2,$(this).prev('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_02.gif" border="0" height="17" width="19"></span></a><span style="vertical-align:middle;">
                            <input onClick="UpdateRate(49,3,$(this),0);" class="num_close49" name="checkbox" style="" title="êPé]Ô“í—" value="TRUE" type="checkbox">
                        </span>
                        </td>
<!--                        <td align="center" height="25"><span id="gold5 ball"><font class="odd_total49" color="ff6400"></font></span></td>-->
                     
                                                <td align="center" height="25">
                            <input type="hidden" value="Âí" class="name44">
                            <a style="" onClick="UpdateRate(44,1,$(this).next('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_01.gif" border="0" height="17" width="19"></span></a>
                            <input onBlur="UpdateRate(44,1,$(this),0);" class="rate_set44 rate_color" type="text" style="width:63px;" value="<?php echo $rate[6][Âí][1] ;?>">
                            <a style="" onClick="UpdateRate(44,2,$(this).prev('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_02.gif" border="0" height="17" width="19"></span></a><span style="vertical-align:middle;">
                            <input onClick="UpdateRate(44,3,$(this),0);" class="num_close44" name="checkbox" style="" title="êPé]Ô“í—" value="TRUE" type="checkbox">
                        </span>
                        </td>
<!--                        <td align="center" height="25"><span id="gold5 ball"><font class="odd_total44" color="ff6400"></font></span></td>-->
                     
                                                <td bordercolor="cccccc" class="ball_a" align="center" height="25">6</td>
                                                <td align="center" height="25">
                            <input type="hidden" value="6" class="name50">
                            <a style="" onClick="UpdateRate(50,1,$(this).next('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_01.gif" border="0" height="17" width="19"></span></a>
                            <input onBlur="UpdateRate(50,1,$(this),0);" class="rate_set50 rate_color" type="text" style="width:63px;" value="<?php echo $rate[7][6][1] ;?>">
                            <a style="" onClick="UpdateRate(50,2,$(this).prev('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_02.gif" border="0" height="17" width="19"></span></a><span style="vertical-align:middle;">
                            <input onClick="UpdateRate(50,3,$(this),0);" class="num_close50" name="checkbox" style="" title="êPé]Ô“í—" value="TRUE" type="checkbox">
                        </span>
                        </td>
<!--                        <td align="center" height="25"><span id="gold5 ball"><font class="odd_total50" color="ff6400"></font></span></td>-->
                      </tr>
                      
                      <tr style="background-color: rgb(255, 255, 255);" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor='ffffff'" bgcolor="#FFFFFF">
                      
                                                <td bordercolor="cccccc" class="ball_a" align="center" height="25">Ñò</td>
                                                <td align="center" height="25">
                            <input type="hidden" value="Ñò" class="name43">
                            <a style="" onClick="UpdateRate(43,1,$(this).next('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_01.gif" border="0" height="17" width="19"></span></a>
                            <input onBlur="UpdateRate(43,1,$(this),0);" class="rate_set43 rate_color" type="text" style="width:63px;" value="<?php echo $rate[0][Ñò][1] ;?>">
                            <a style="" onClick="UpdateRate(43,2,$(this).prev('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_02.gif" border="0" height="17" width="19"></span></a><span style="vertical-align:middle;">
                            <input onClick="UpdateRate(43,3,$(this),0);" class="num_close43" name="checkbox" style="" title="êPé]Ô“í—" value="TRUE" type="checkbox">
                        </span>
                        </td>
<!--                        <td align="center" height="25"><span id="gold6 ball"><font class="odd_total43" color="ff6400"></font></span></td>-->
                     
                                                <td align="center" height="25">
                            <input type="hidden" value="Ñò" class="name45">
                            <a style="" onClick="UpdateRate(45,1,$(this).next('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_01.gif" border="0" height="17" width="19"></span></a>
                            <input onBlur="UpdateRate(45,1,$(this),0);" class="rate_set45 rate_color" type="text" style="width:63px;" value="<?php echo $rate[1][Ñò][1] ;?>">
                            <a style="" onClick="UpdateRate(45,2,$(this).prev('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_02.gif" border="0" height="17" width="19"></span></a><span style="vertical-align:middle;">
                            <input onClick="UpdateRate(45,3,$(this),0);" class="num_close45" name="checkbox" style="" title="êPé]Ô“í—" value="TRUE" type="checkbox">
                        </span>
                        </td>
<!--                        <td align="center" height="25"><span id="gold6 ball"><font class="odd_total44" color="ff6400"></font></span></td>-->
                     
                                                <td align="center" height="25"><input type="hidden" value="Ñò" class="name46">
                            <a style="" onClick="UpdateRate(46,1,$(this).next('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_01.gif" border="0" height="17" width="19"></span></a>
                            <input onBlur="UpdateRate(46,1,$(this),0);" class="rate_set46 rate_color" type="text" style="width:63px;" value="<?php echo $rate[2][Ñò][1] ;?>">
                            <a style="" onClick="UpdateRate(46,2,$(this).prev('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_02.gif" border="0" height="17" width="19"></span></a><span style="vertical-align:middle;">
                            <input onClick="UpdateRate(46,3,$(this),0);" class="num_close46" name="checkbox" style="" title="êPé]Ô“í—" value="TRUE" type="checkbox">
                        </span>
                        </td>
<!--                        <td align="center" height="25"><span id="gold6 ball"><font class="odd_total46" color="ff6400"></font></span></td>-->
                     
                                                <td align="center" height="25">
                            <input type="hidden" value="Ñò" class="name47">
                            <a style="" onClick="UpdateRate(47,1,$(this).next('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_01.gif" border="0" height="17" width="19"></span></a>
                            <input onBlur="UpdateRate(47,1,$(this),0);" class="rate_set47 rate_color" type="text" style="width:63px;" value="<?php echo $rate[3][Ñò][1] ;?>">
                            <a style="" onClick="UpdateRate(47,2,$(this).prev('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_02.gif" border="0" height="17" width="19"></span></a><span style="vertical-align:middle;">
                            <input onClick="UpdateRate(47,3,$(this),0);" class="num_close47" name="checkbox" style="" title="êPé]Ô“í—" value="TRUE" type="checkbox">
                        </span>
                        </td>
<!--                        <td align="center" height="25"><span id="gold6 ball"><font class="odd_total47" color="ff6400"></font></span></td>-->
                     
                                                <td align="center" height="25">
                            <input type="hidden" value="Ñò" class="name48">
                            <a style="" onClick="UpdateRate(48,1,$(this).next('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_01.gif" border="0" height="17" width="19"></span></a>
                            <input onBlur="UpdateRate(48,1,$(this),0);" class="rate_set48 rate_color" type="text" style="width:63px;" value="<?php echo $rate[4][Ñò][1] ;?>">
                            <a style="" onClick="UpdateRate(48,2,$(this).prev('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_02.gif" border="0" height="17" width="19"></span></a><span style="vertical-align:middle;">
                            <input onClick="UpdateRate(48,3,$(this),0);" class="num_close48" name="checkbox" style="" title="êPé]Ô“í—" value="TRUE" type="checkbox">
                        </span>
                        </td>
<!--                        <td align="center" height="25"><span id="gold6 ball"><font class="odd_total48" color="ff6400"></font></span></td>-->
                     
                                                <td align="center" height="25">
                            <input type="hidden" value="Ñò" class="name49">
                            <a style="" onClick="UpdateRate(49,1,$(this).next('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_01.gif" border="0" height="17" width="19"></span></a>
                            <input onBlur="UpdateRate(49,1,$(this),0);" class="rate_set49 rate_color" type="text" style="width:63px;" value="<?php echo $rate[5][Ñò][1] ;?>">
                            <a style="" onClick="UpdateRate(49,2,$(this).prev('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_02.gif" border="0" height="17" width="19"></span></a><span style="vertical-align:middle;">
                            <input onClick="UpdateRate(49,3,$(this),0);" class="num_close49" name="checkbox" style="" title="êPé]Ô“í—" value="TRUE" type="checkbox">
                        </span>
                        </td>
<!--                        <td align="center" height="25"><span id="gold6 ball"><font class="odd_total49" color="ff6400"></font></span></td>-->
                     
                                                <td align="center" height="25">
                            <input type="hidden" value="Ñò" class="name44">
                            <a style="" onClick="UpdateRate(44,1,$(this).next('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_01.gif" border="0" height="17" width="19"></span></a>
                            <input onBlur="UpdateRate(44,1,$(this),0);" class="rate_set44 rate_color" type="text" style="width:63px;" value="<?php echo $rate[6][Ñò][1] ;?>">
                            <a style="" onClick="UpdateRate(44,2,$(this).prev('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_02.gif" border="0" height="17" width="19"></span></a><span style="vertical-align:middle;">
                            <input onClick="UpdateRate(44,3,$(this),0);" class="num_close44" name="checkbox" style="" title="êPé]Ô“í—" value="TRUE" type="checkbox">
                        </span>
                        </td>
<!--                        <td align="center" height="25"><span id="gold6 ball"><font class="odd_total44" color="ff6400"></font></span></td>-->
                     
                                                <td bordercolor="cccccc" class="ball_a" align="center" height="25">7</td>
                                                <td align="center" height="25">
                            <input type="hidden" value="7" class="name50">
                            <a style="" onClick="UpdateRate(50,1,$(this).next('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_01.gif" border="0" height="17" width="19"></span></a>
                            <input onBlur="UpdateRate(50,1,$(this),0);" class="rate_set50 rate_color" type="text" style="width:63px;" value="<?php echo $rate[7][7][1] ;?>">
                            <a style="" onClick="UpdateRate(50,2,$(this).prev('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_02.gif" border="0" height="17" width="19"></span></a><span style="vertical-align:middle;">
                            <input onClick="UpdateRate(50,3,$(this),0);" class="num_close50" name="checkbox" style="" title="êPé]Ô“í—" value="TRUE" type="checkbox">
                        </span>
                        </td>
<!--                        <td align="center" height="25"><span id="gold6 ball"><font class="odd_total50" color="ff6400"></font></span></td>-->
                      </tr>
                      
                      <tr style="background-color: rgb(255, 255, 255);" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor='ffffff'" bgcolor="#FFFFFF">
                      
                                                <td bordercolor="cccccc" class="ball_a" align="center" height="25">ºï</td>
                                                <td align="center" height="25">
                            <input type="hidden" value="ºï" class="name43">
                            <a style="" onClick="UpdateRate(43,1,$(this).next('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_01.gif" border="0" height="17" width="19"></span></a>
                            <input onBlur="UpdateRate(43,1,$(this),0);" class="rate_set43 rate_color" type="text" style="width:63px;" value="<?php echo $rate[0][ºï][1] ;?>">
                            <a style="" onClick="UpdateRate(43,2,$(this).prev('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_02.gif" border="0" height="17" width="19"></span></a><span style="vertical-align:middle;">
                            <input onClick="UpdateRate(43,3,$(this),0);" class="num_close43" name="checkbox" style="" title="êPé]Ô“í—" value="TRUE" type="checkbox">
                        </span>
                        </td>
<!--                        <td align="center" height="25"><span id="gold7 ball"><font class="odd_total43" color="ff6400"></font></span></td>-->
                     
                                                <td align="center" height="25">
                            <input type="hidden" value="ºï" class="name45">
                            <a style="" onClick="UpdateRate(45,1,$(this).next('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_01.gif" border="0" height="17" width="19"></span></a>
                            <input onBlur="UpdateRate(45,1,$(this),0);" class="rate_set45 rate_color" type="text" style="width:63px;" value="<?php echo $rate[1][ºï][1] ;?>">
                            <a style="" onClick="UpdateRate(45,2,$(this).prev('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_02.gif" border="0" height="17" width="19"></span></a><span style="vertical-align:middle;">
                            <input onClick="UpdateRate(45,3,$(this),0);" class="num_close45" name="checkbox" style="" title="êPé]Ô“í—" value="TRUE" type="checkbox">
                        </span>
                        </td>
<!--                        <td align="center" height="25"><span id="gold7 ball"><font class="odd_total44" color="ff6400"></font></span></td>-->
                     
                                                <td align="center" height="25">
                            <input type="hidden" value="ºï" class="name46">
                            <a style="" onClick="UpdateRate(46,1,$(this).next('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_01.gif" border="0" height="17" width="19"></span></a>
                            <input onBlur="UpdateRate(46,1,$(this),0);" class="rate_set46 rate_color" type="text" style="width:63px;" value="<?php echo $rate[2][ºï][1] ;?>">
                            <a style="" onClick="UpdateRate(46,2,$(this).prev('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_02.gif" border="0" height="17" width="19"></span></a><span style="vertical-align:middle;">
                            <input onClick="UpdateRate(46,3,$(this),0);" class="num_close46" name="checkbox" style="" title="êPé]Ô“í—" value="TRUE" type="checkbox">
                        </span>
                        </td>
<!--                        <td align="center" height="25"><span id="gold7 ball"><font class="odd_total46" color="ff6400"></font></span></td>-->
                     
                                                <td align="center" height="25">
                            <input type="hidden" value="ºï" class="name47">
                            <a style="" onClick="UpdateRate(47,1,$(this).next('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_01.gif" border="0" height="17" width="19"></span></a>
                            <input onBlur="UpdateRate(47,1,$(this),0);" class="rate_set47 rate_color" type="text" style="width:63px;" value="<?php echo $rate[3][ºï][1] ;?>">
                            <a style="" onClick="UpdateRate(47,2,$(this).prev('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_02.gif" border="0" height="17" width="19"></span></a><span style="vertical-align:middle;">
                            <input onClick="UpdateRate(47,3,$(this),0);" class="num_close47" name="checkbox" style="" title="êPé]Ô“í—" value="TRUE" type="checkbox">
                        </span>
                        </td>
<!--                        <td align="center" height="25"><span id="gold7 ball"><font class="odd_total47" color="ff6400"></font></span></td>-->
                     
                                                <td align="center" height="25">
                            <input type="hidden" value="ºï" class="name48">
                            <a style="" onClick="UpdateRate(48,1,$(this).next('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_01.gif" border="0" height="17" width="19"></span></a>
                            <input onBlur="UpdateRate(48,1,$(this),0);" class="rate_set48 rate_color" type="text" style="width:63px;" value="<?php echo $rate[4][ºï][1] ;?>">
                            <a style="" onClick="UpdateRate(48,2,$(this).prev('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_02.gif" border="0" height="17" width="19"></span></a><span style="vertical-align:middle;">
                            <input onClick="UpdateRate(48,3,$(this),0);" class="num_close48" name="checkbox" style="" title="êPé]Ô“í—" value="TRUE" type="checkbox">
                        </span>
                        </td>
<!--                        <td align="center" height="25"><span id="gold7 ball"><font class="odd_total48" color="ff6400"></font></span></td>-->
                     
                                                <td align="center" height="25">
                            <input type="hidden" value="ºï" class="name49">
                            <a style="" onClick="UpdateRate(49,1,$(this).next('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_01.gif" border="0" height="17" width="19"></span></a>
                            <input onBlur="UpdateRate(49,1,$(this),0);" class="rate_set49 rate_color" type="text" style="width:63px;" value="<?php echo $rate[5][ºï][1] ;?>">
                            <a style="" onClick="UpdateRate(49,2,$(this).prev('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_02.gif" border="0" height="17" width="19"></span></a><span style="vertical-align:middle;">
                            <input onClick="UpdateRate(49,3,$(this),0);" class="num_close49" name="checkbox" style="" title="êPé]Ô“í—" value="TRUE" type="checkbox">
                        </span>
                        </td>
<!--                        <td align="center" height="25"><span id="gold7 ball"><font class="odd_total49" color="ff6400"></font></span></td>-->
                     
                        <td align="center" height="25">
                            <input type="hidden" value="ºï" class="name44">
                            <a style="" onClick="UpdateRate(44,1,$(this).next('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_01.gif" border="0" height="17" width="19"></span></a>
                            <input onBlur="UpdateRate(44,1,$(this),0);" class="rate_set44 rate_color" type="text" style="width:63px;" value="<?php echo $rate[6][ºï][1] ;?>">
                            <a style="" onClick="UpdateRate(44,2,$(this).prev('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_02.gif" border="0" height="17" width="19"></span></a><span style="vertical-align:middle;">
                            <input onClick="UpdateRate(44,3,$(this),0);" class="num_close44" name="checkbox" style="" title="êPé]Ô“í—" value="TRUE" type="checkbox">
                        </span>
                        </td>
<!--                        <td align="center" height="25"><span id="gold7 ball"><font class="odd_total44" color="ff6400"></font></span></td>-->
                     
                                                <td bordercolor="cccccc" class="ball_a" align="center" height="25">8</td>
                                                <td align="center" height="25">
                            <input type="hidden" value="8" class="name50">
                            <a style="" onClick="UpdateRate(50,1,$(this).next('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_01.gif" border="0" height="17" width="19"></span></a>
                            <input onBlur="UpdateRate(50,1,$(this),0);" class="rate_set50 rate_color" type="text" style="width:63px;" value="<?php echo $rate[7][8][1] ;?>">
                            <a style="" onClick="UpdateRate(50,2,$(this).prev('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_02.gif" border="0" height="17" width="19"></span></a><span style="vertical-align:middle;">
                            <input onClick="UpdateRate(50,3,$(this),0);" class="num_close50" name="checkbox" style="" title="êPé]Ô“í—" value="TRUE" type="checkbox">
                        </span>
                        </td>
<!--                        <td align="center" height="25"><span id="gold7 ball"><font class="odd_total50" color="ff6400"></font></span></td>-->
                      </tr>
                      
                      <tr style="background-color: rgb(255, 255, 255);" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor='ffffff'" bgcolor="#FFFFFF">
                      
                                                <td bordercolor="cccccc" class="ball_a" align="center" height="25">¼¦</td>
                                                <td align="center" height="25">
                            <input type="hidden" value="¼¦" class="name43">
                            <a style="" onClick="UpdateRate(43,1,$(this).next('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_01.gif" border="0" height="17" width="19"></span></a>
                            <input onBlur="UpdateRate(43,1,$(this),0);" class="rate_set43 rate_color" type="text" style="width:63px;" value="<?php echo $rate[0][¼¦][1] ;?>">
                            <a style="" onClick="UpdateRate(43,2,$(this).prev('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_02.gif" border="0" height="17" width="19"></span></a><span style="vertical-align:middle;">
                            <input onClick="UpdateRate(43,3,$(this),0);" class="num_close43" name="checkbox" style="" title="êPé]Ô“í—" value="TRUE" type="checkbox">
                        </span>
                        </td>
<!--                        <td align="center" height="25"><span id="gold8 ball"><font class="odd_total43" color="ff6400"></font></span></td>-->
                     
                                                <td align="center" height="25">
                            <input type="hidden" value="¼¦" class="name45">
                            <a style="" onClick="UpdateRate(45,1,$(this).next('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_01.gif" border="0" height="17" width="19"></span></a>
                            <input onBlur="UpdateRate(45,1,$(this),0);" class="rate_set45 rate_color" type="text" style="width:63px;" value="<?php echo $rate[1][¼¦][1] ;?>">
                            <a style="" onClick="UpdateRate(45,2,$(this).prev('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_02.gif" border="0" height="17" width="19"></span></a><span style="vertical-align:middle;">
                            <input onClick="UpdateRate(45,3,$(this),0);" class="num_close45" name="checkbox" style="" title="êPé]Ô“í—" value="TRUE" type="checkbox">
                        </span>
                        </td>
<!--                        <td align="center" height="25"><span id="gold8 ball"><font class="odd_total44" color="ff6400"></font></span></td>-->
                     
                                                <td align="center" height="25">
                            <input type="hidden" value="¼¦" class="name46">
                            <a style="" onClick="UpdateRate(46,1,$(this).next('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_01.gif" border="0" height="17" width="19"></span></a>
                            <input onBlur="UpdateRate(46,1,$(this),0);" class="rate_set46 rate_color" type="text" style="width:63px;" value="<?php echo $rate[2][¼¦][1] ;?>">
                            <a style="" onClick="UpdateRate(46,2,$(this).prev('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_02.gif" border="0" height="17" width="19"></span></a><span style="vertical-align:middle;">
                            <input onClick="UpdateRate(46,3,$(this),0);" class="num_close46" name="checkbox" style="" title="êPé]Ô“í—" value="TRUE" type="checkbox">
                        </span>
                        </td>
<!--                        <td align="center" height="25"><span id="gold8 ball"><font class="odd_total46" color="ff6400"></font></span></td>-->
                     
                                                <td align="center" height="25">
                            <input type="hidden" value="¼¦" class="name47">
                            <a style="" onClick="UpdateRate(47,1,$(this).next('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_01.gif" border="0" height="17" width="19"></span></a>
                            <input onBlur="UpdateRate(47,1,$(this),0);" class="rate_set47 rate_color" type="text" style="width:63px;" value="<?php echo $rate[3][¼¦][1] ;?>">
                            <a style="" onClick="UpdateRate(47,2,$(this).prev('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_02.gif" border="0" height="17" width="19"></span></a><span style="vertical-align:middle;">
                            <input onClick="UpdateRate(47,3,$(this),0);" class="num_close47" name="checkbox" style="" title="êPé]Ô“í—" value="TRUE" type="checkbox">
                        </span>
                        </td>
<!--                        <td align="center" height="25"><span id="gold8 ball"><font class="odd_total47" color="ff6400"></font></span></td>-->
                     
                                                <td align="center" height="25">
                            <input type="hidden" value="¼¦" class="name48">
                            <a style="" onClick="UpdateRate(48,1,$(this).next('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_01.gif" border="0" height="17" width="19"></span></a>
                            <input onBlur="UpdateRate(48,1,$(this),0);" class="rate_set48 rate_color" type="text" style="width:63px;" value="<?php echo $rate[4][¼¦][1] ;?>">
                            <a style="" onClick="UpdateRate(48,2,$(this).prev('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_02.gif" border="0" height="17" width="19"></span></a><span style="vertical-align:middle;">
                            <input onClick="UpdateRate(48,3,$(this),0);" class="num_close48" name="checkbox" style="" title="êPé]Ô“í—" value="TRUE" type="checkbox">
                        </span>
                        </td>
<!--                        <td align="center" height="25"><span id="gold8 ball"><font class="odd_total48" color="ff6400"></font></span></td>-->
                     
                                                <td align="center" height="25">
                            <input type="hidden" value="¼¦" class="name49">
                            <a style="" onClick="UpdateRate(49,1,$(this).next('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_01.gif" border="0" height="17" width="19"></span></a>
                            <input onBlur="UpdateRate(49,1,$(this),0);" class="rate_set49 rate_color" type="text" style="width:63px;" value="<?php echo $rate[5][¼¦][1] ;?>">
                            <a style="" onClick="UpdateRate(49,2,$(this).prev('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_02.gif" border="0" height="17" width="19"></span></a><span style="vertical-align:middle;">
                            <input onClick="UpdateRate(49,3,$(this),0);" class="num_close49" name="checkbox" style="" title="êPé]Ô“í—" value="TRUE" type="checkbox">
                        </span>
                        </td>
<!--                        <td align="center" height="25"><span id="gold8 ball"><font class="odd_total49" color="ff6400"></font></span></td>-->
                     
                                                <td align="center" height="25">
                            <input type="hidden" value="¼¦" class="name44">
                            <a style="" onClick="UpdateRate(44,1,$(this).next('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_01.gif" border="0" height="17" width="19"></span></a>
                            <input onBlur="UpdateRate(44,1,$(this),0);" class="rate_set44 rate_color" type="text" style="width:63px;" value="<?php echo $rate[6][¼¦][1] ;?>">
                            <a style="" onClick="UpdateRate(44,2,$(this).prev('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_02.gif" border="0" height="17" width="19"></span></a><span style="vertical-align:middle;">
                            <input onClick="UpdateRate(44,3,$(this),0);" class="num_close44" name="checkbox" style="" title="êPé]Ô“í—" value="TRUE" type="checkbox">
                        </span>
                        </td>
<!--                        <td align="center" height="25"><span id="gold8 ball"><font class="odd_total44" color="ff6400"></font></span></td>-->
                     
                                                <td bordercolor="cccccc" class="ball_a" align="center" height="25">9</td>
                                                <td align="center" height="25">
                            <input type="hidden" value="9" class="name50">
                            <a style="" onClick="UpdateRate(50,1,$(this).next('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_01.gif" border="0" height="17" width="19"></span></a>
                            <input onBlur="UpdateRate(50,1,$(this),0);" class="rate_set50 rate_color" type="text" style="width:63px;" value="<?php echo $rate[7][9][1] ;?>">
                            <a style="" onClick="UpdateRate(50,2,$(this).prev('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_02.gif" border="0" height="17" width="19"></span></a><span style="vertical-align:middle;">
                            <input onClick="UpdateRate(50,3,$(this),0);" class="num_close50" name="checkbox" style="" title="êPé]Ô“í—" value="TRUE" type="checkbox">
                        </span>
                        </td>
<!--                        <td align="center" height="25"><span id="gold8 ball"><font class="odd_total50" color="ff6400"></font></span></td>-->
                      </tr>
                      
                      <tr style="background-color: rgb(255, 255, 162);" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor='ffffff'" bgcolor="#FFFFFF">
                      
                                                <td bordercolor="cccccc" class="ball_a" align="center" height="25">¹·</td>
                                                <td align="center" height="25">
                            <input type="hidden" value="¹·" class="name43">
                            <a style="" onClick="UpdateRate(43,1,$(this).next('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_01.gif" border="0" height="17" width="19"></span></a>
                            <input onBlur="UpdateRate(43,1,$(this),0);" class="rate_set43 rate_color" type="text" style="width:63px;" value="<?php echo $rate[0][¹·][1] ;?>">
                            <a style="" onClick="UpdateRate(43,2,$(this).prev('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_02.gif" border="0" height="17" width="19"></span></a><span style="vertical-align:middle;">
                            <input onClick="UpdateRate(43,3,$(this),0);" class="num_close43" name="checkbox" style="" title="êPé]Ô“í—" value="TRUE" type="checkbox">
                        </span>
                        </td>
<!--                        <td align="center" height="25"><span id="gold9 ball"><font class="odd_total43" color="ff6400"></font></span></td>-->
                     
                                                <td align="center" height="25">
                            <input type="hidden" value="¹·" class="name45">
                            <a style="" onClick="UpdateRate(45,1,$(this).next('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_01.gif" border="0" height="17" width="19"></span></a>
                            <input onBlur="UpdateRate(45,1,$(this),0);" class="rate_set45 rate_color" type="text" style="width:63px;" value="<?php echo $rate[1][¹·][1] ;?>">
                            <a style="" onClick="UpdateRate(45,2,$(this).prev('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_02.gif" border="0" height="17" width="19"></span></a><span style="vertical-align:middle;">
                            <input onClick="UpdateRate(45,3,$(this),0);" class="num_close45" name="checkbox" style="" title="êPé]Ô“í—" value="TRUE" type="checkbox">
                        </span>
                        </td>
<!--                        <td align="center" height="25"><span id="gold9 ball"><font class="odd_total44" color="ff6400"></font></span></td>-->
                     
                                                <td align="center" height="25">
                            <input type="hidden" value="¹·" class="name46">
                            <a style="" onClick="UpdateRate(46,1,$(this).next('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_01.gif" border="0" height="17" width="19"></span></a>
                            <input onBlur="UpdateRate(46,1,$(this),0);" class="rate_set46 rate_color" type="text" style="width:63px;" value="<?php echo $rate[2][¹·][1] ;?>">
                            <a style="" onClick="UpdateRate(46,2,$(this).prev('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_02.gif" border="0" height="17" width="19"></span></a><span style="vertical-align:middle;">
                            <input onClick="UpdateRate(46,3,$(this),0);" class="num_close46" name="checkbox" style="" title="êPé]Ô“í—" value="TRUE" type="checkbox">
                        </span>
                        </td>
<!--                        <td align="center" height="25"><span id="gold9 ball"><font class="odd_total46" color="ff6400"></font></span></td>-->
                     
                                                <td align="center" height="25">
                            <input type="hidden" value="¹·" class="name47">
                            <a style="" onClick="UpdateRate(47,1,$(this).next('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_01.gif" border="0" height="17" width="19"></span></a>
                            <input onBlur="UpdateRate(47,1,$(this),0);" class="rate_set47 rate_color" type="text" style="width:63px;" value="<?php echo $rate[3][¹·][1] ;?>">
                            <a style="" onClick="UpdateRate(47,2,$(this).prev('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_02.gif" border="0" height="17" width="19"></span></a><span style="vertical-align:middle;">
                            <input onClick="UpdateRate(47,3,$(this),0);" class="num_close47" name="checkbox" style="" title="êPé]Ô“í—" value="TRUE" type="checkbox">
                        </span>
                        </td>
<!--                        <td align="center" height="25"><span id="gold9 ball"><font class="odd_total47" color="ff6400"></font></span></td>-->
                     
                                                <td align="center" height="25">
                            <input type="hidden" value="¹·" class="name48">
                            <a style="" onclick="UpdateRate(48,1,$(this).next('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_01.gif" border="0" height="17" width="19" /></span></a>
<input onblur="UpdateRate(48,1,$(this),0);" class="rate_set48 rate_color" type="text" style="width:63px;" value="<?php echo $rate[4][¹·][1] ;?>" />                            
<a style="" onClick="UpdateRate(48,2,$(this).prev('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_02.gif" border="0" height="17" width="19"></span></a><span style="vertical-align:middle;">
                            <input onClick="UpdateRate(48,3,$(this),0);" class="num_close48" name="checkbox" style="" title="êPé]Ô“í—" value="TRUE" type="checkbox">
                        </span>
                        </td>
<!--                        <td align="center" height="25"><span id="gold9 ball"><font class="odd_total48" color="ff6400"></font></span></td>-->
                     
                                                <td align="center" height="25">
                            <input type="hidden" value="¹·" class="name49">
                            <a style="" onClick="UpdateRate(49,1,$(this).next('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_01.gif" border="0" height="17" width="19"></span></a>
                            <input onBlur="UpdateRate(49,1,$(this),0);" class="rate_set49 rate_color" type="text" style="width:63px;" value="<?php echo $rate[5][¹·][1] ;?>">
                            <a style="" onClick="UpdateRate(49,2,$(this).prev('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_02.gif" border="0" height="17" width="19"></span></a><span style="vertical-align:middle;">
                            <input onClick="UpdateRate(49,3,$(this),0);" class="num_close49" name="checkbox" style="" title="êPé]Ô“í—" value="TRUE" type="checkbox">
                        </span>
                        </td>
<!--                        <td align="center" height="25"><span id="gold9 ball"><font class="odd_total49" color="ff6400"></font></span></td>-->
                     
                                                <td align="center" height="25">
                            <input type="hidden" value="¹·" class="name44">
                            <a style="" onClick="UpdateRate(44,1,$(this).next('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_01.gif" border="0" height="17" width="19"></span></a>
                            <input onBlur="UpdateRate(44,1,$(this),0);" class="rate_set44 rate_color" type="text" style="width:63px;" value="<?php echo $rate[6][¹·][1] ;?>">
                            <a style="" onClick="UpdateRate(44,2,$(this).prev('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_02.gif" border="0" height="17" width="19"></span></a><span style="vertical-align:middle;">
                            <input onClick="UpdateRate(44,3,$(this),0);" class="num_close44" name="checkbox" style="" title="êPé]Ô“í—" value="TRUE" type="checkbox">
                        </span>
                        </td>
<!--                        <td align="center" height="25"><span id="gold9 ball"><font class="odd_total44" color="ff6400"></font></span></td>-->
                      </tr>
                      
                      <tr style="background-color: rgb(255, 255, 255);" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor='ffffff'" bgcolor="#FFFFFF">
                      
                                                <td bordercolor="cccccc" class="ball_a" align="center" height="25">Öí</td>
                                                <td align="center" height="25">
                            <input type="hidden" value="Öí" class="name43">
                            <a style="" onClick="UpdateRate(43,1,$(this).next('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_01.gif" border="0" height="17" width="19"></span></a>
                            <input onBlur="UpdateRate(43,1,$(this),0);" class="rate_set43 rate_color" type="text" style="width:63px;" value="<?php echo $rate[0][Öí][1] ;?>">
                            <a style="" onClick="UpdateRate(43,2,$(this).prev('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_02.gif" border="0" height="17" width="19"></span></a><span style="vertical-align:middle;">
                            <input onClick="UpdateRate(43,3,$(this),0);" class="num_close43" name="checkbox" style="" title="êPé]Ô“í—" value="TRUE" type="checkbox">
                        </span>
                        </td>
<!--                        <td align="center" height="25"><span id="gold10 ball"><font class="odd_total43" color="ff6400"></font></span></td>-->
                     
                                                <td align="center" height="25">
                            <input type="hidden" value="Öí" class="name45">
                            <a style="" onClick="UpdateRate(45,1,$(this).next('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_01.gif" border="0" height="17" width="19"></span></a>
                            <input onBlur="UpdateRate(45,1,$(this),0);" class="rate_set45 rate_color" type="text" style="width:63px;" value="<?php echo $rate[1][Öí][1] ;?>">
                            <a style="" onClick="UpdateRate(45,2,$(this).prev('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_02.gif" border="0" height="17" width="19"></span></a><span style="vertical-align:middle;">
                            <input onClick="UpdateRate(45,3,$(this),0);" class="num_close45" name="checkbox" style="" title="êPé]Ô“í—" value="TRUE" type="checkbox">
                        </span>
                        </td>
<!--                        <td align="center" height="25"><span id="gold10 ball"><font class="odd_total44" color="ff6400"></font></span></td>-->
                     
                                                <td align="center" height="25">
                            <input type="hidden" value="Öí" class="name46">
                            <a style="" onClick="UpdateRate(46,1,$(this).next('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_01.gif" border="0" height="17" width="19"></span></a>
                            <input onBlur="UpdateRate(46,1,$(this),0);" class="rate_set46 rate_color" type="text" style="width:63px;" value="<?php echo $rate[2][Öí][1] ;?>">
                            <a style="" onClick="UpdateRate(46,2,$(this).prev('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_02.gif" border="0" height="17" width="19"></span></a><span style="vertical-align:middle;">
                            <input onClick="UpdateRate(46,3,$(this),0);" class="num_close46" name="checkbox" style="" title="êPé]Ô“í—" value="TRUE" type="checkbox">
                        </span>
                        </td>
<!--                        <td align="center" height="25"><span id="gold10 ball"><font class="odd_total46" color="ff6400"></font></span></td>-->
                     
                                                <td align="center" height="25">
                            <input type="hidden" value="Öí" class="name47">
                            <a style="" onClick="UpdateRate(47,1,$(this).next('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_01.gif" border="0" height="17" width="19"></span></a>
                            <input onBlur="UpdateRate(47,1,$(this),0);" class="rate_set47 rate_color" type="text" style="width:63px;" value="<?php echo $rate[3][Öí][1] ;?>">
                            <a style="" onClick="UpdateRate(47,2,$(this).prev('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_02.gif" border="0" height="17" width="19"></span></a><span style="vertical-align:middle;">
                            <input onClick="UpdateRate(47,3,$(this),0);" class="num_close47" name="checkbox" style="" title="êPé]Ô“í—" value="TRUE" type="checkbox">
                        </span>
                        </td>
<!--                        <td align="center" height="25"><span id="gold10 ball"><font class="odd_total47" color="ff6400"></font></span></td>-->
                     
                                                <td align="center" height="25">
                            <input type="hidden" value="Öí" class="name48">
                            <a style="" onClick="UpdateRate(48,1,$(this).next('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_01.gif" border="0" height="17" width="19"></span></a>
                            <input onBlur="UpdateRate(48,1,$(this),0);" class="rate_set48 rate_color" type="text" style="width:63px;" value="<?php echo $rate[4][Öí][1] ;?>">
                            <a style="" onClick="UpdateRate(48,2,$(this).prev('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_02.gif" border="0" height="17" width="19"></span></a><span style="vertical-align:middle;">
                            <input onClick="UpdateRate(48,3,$(this),0);" class="num_close48" name="checkbox" style="" title="êPé]Ô“í—" value="TRUE" type="checkbox">
                        </span>
                        </td>
<!--                        <td align="center" height="25"><span id="gold10 ball"><font class="odd_total48" color="ff6400"></font></span></td>-->
                     
                                                <td align="center" height="25">
                            <input type="hidden" value="Öí" class="name49">
                            <a style="" onClick="UpdateRate(49,1,$(this).next('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_01.gif" border="0" height="17" width="19"></span></a>
                            <input onBlur="UpdateRate(49,1,$(this),0);" class="rate_set49 rate_color" type="text" style="width:63px;" value="<?php echo $rate[5][Öí][1] ;?>">
                            <a style="" onClick="UpdateRate(49,2,$(this).prev('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_02.gif" border="0" height="17" width="19"></span></a><span style="vertical-align:middle;">
                            <input onClick="UpdateRate(49,3,$(this),0);" class="num_close49" name="checkbox" style="" title="êPé]Ô“í—" value="TRUE" type="checkbox">
                        </span>
                        </td>
<!--                        <td align="center" height="25"><span id="gold10 ball"><font class="odd_total49" color="ff6400"></font></span></td>-->
                     
                                                <td align="center" height="25">
                            <input type="hidden" value="Öí" class="name44">
                            <a style="" onClick="UpdateRate(44,1,$(this).next('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_01.gif" border="0" height="17" width="19"></span></a>
                            <input onBlur="UpdateRate(44,1,$(this),0);" class="rate_set44 rate_color" type="text" style="width:63px;" value="<?php echo $rate[6][Öí][1] ;?>">
                            <a style="" onClick="UpdateRate(44,2,$(this).prev('input'),0.1);"><span style="vertical-align:middle;"><img src="../../images/bvbv_02.gif" border="0" height="17" width="19"></span></a><span style="vertical-align:middle;">
                            <input onClick="UpdateRate(44,3,$(this),0);" class="num_close44" name="checkbox" style="" title="êPé]Ô“í—" value="TRUE" type="checkbox">
                        </span>
                        </td>
<!--                        <td align="center" height="25"><span id="gold10 ball"><font class="odd_total44" color="ff6400"></font></span></td>-->
                      </tr>
                   
                       
                    </tbody>
                  </table>
                    <form action="set_rate_by_sxws.php" name="form21" method="post">
                  <table border="0" cellpadding="0" cellspacing="0" width="100%">
                    <tbody>
                      <tr>
                        <td align="center" height="25"><span class="STYLE1">½yÒ»ÐÞ¸Ä£º</span>
                          <input name="dx" value="43" type="radio">
                          ÌØÐ¤
                          <input name="dx" value="45" type="radio">
                          ¶þÐ¤
                          <input name="dx" value="46" type="radio">
                          ÈýÐ¤
                          <input name="dx" value="47" type="radio">
                          ËÄÐ¤
                          <input name="dx" value="48" type="radio">
                          ÎåÐ¤
                          <input name="dx" value="49" type="radio">
                          ÁùÐ¤
                          <input name="dx" value="44" type="radio">
                          Ò»Ð¤
                          <input name="dx" value="50" checked="checked" type="radio">
                          Î²Êý <span class="STYLE1" id="ebl1">ÙrÂÊ</span>
                          <input name="bl" class="input1 rate_color" id="bl" style="height: 18px;" value="0" size="6">
                          &nbsp;
                          <input class="button_a" name="Submit22" value="½yÒ»ÐÞ¸Ä" type="submit"></td>
                      </tr>
                    </tbody>
                  </table>
                  </form>
                </div>
                <!-- ½YÊø  --></td>
              <td background="../../images/tab_15.gif" width="8">&nbsp;</td>
            </tr>
          </tbody>
        </table></td>
    </tr>
    <tr>
      <td background="../../images/tab_19.gif" height="35"><table border="0" cellpadding="0" cellspacing="0" width="100%">
          <tbody>
            <tr>
              <td height="35" width="12"><img src="../../images/tab_18.gif" height="35" width="12"></td>
              <td valign="top"><table border="0" cellpadding="0" cellspacing="0" height="30" width="100%">
                  <tbody>
                    <tr>
                      <td align="center">&nbsp;</td>
                    </tr>
                  </tbody>
                </table></td>
              <td width="16"><img src="../../images/tab_20.gif" height="35" width="16"></td>
            </tr>
          </tbody>
        </table></td>
    </tr>
  </tbody>
</table>

</body></html>