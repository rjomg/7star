<?php  
                $a_a= $_SERVER['REQUEST_URI']; 
                $zifuchang=strlen($_SERVER['REQUEST_URI']);
                $a_ag= '/ag/'; 
                $a_admin= '/admin/'; 
                $a_member='/member/';
                $a_index= '/index.php';
                $a_c0=explode($a_index,$a_a);
                $a_c1=explode($a_ag,$a_a); 
                $a_c2=explode($a_admin,$a_a); 
                $a_c3=explode($a_member,$a_a); 
                
                list(,$p_p)=explode('/',$a_a);        //如果有项目名时获取项目名
                $arr1=explode(',','admin,ag,member');
                $url_link="";
                if(!in_array($p_p,$arr1)){
                    $url_link='/'.$p_p;
                }

                if(count($a_c1) > 1 && count($a_c0)<=1 && $zifuchang>4){ 
                    $managerarr = explode(',', '2,3,4,5');
                    if(!in_array($power,$managerarr)){
		        echo " <script>window.parent.location= '$url_link/ag/index.php'; </script> " ;
                    }
                }elseif(count($a_c2) > 1 && count($a_c0)<=1  && $zifuchang>7){ 
                    if($power!=1){
                        echo " <script>window.parent.location= '$url_link/admin/index.php'; </script> " ;
                    }
                }elseif(count($a_c3) > 1 && count($a_c0)<=1  && $zifuchang>8){ 
                    if($power!=6){
                        echo " <script>window.top.location= '$url_link/index.php'; </script> " ;
                    }
                }else{ 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html oncontextmenu="return false" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<title>404</title>
<style type="text/css">
body{margin:0;padding:0;font:14px/1.6 Arial,Sans-serif;background:#fff url(img/body.png) repeat-x;}
a:link,a:visited{color:#007ab7;text-decoration:none;}
h1{
	position:relative;
	z-index:2;
	width:540px;
	height:0;
	margin:110px auto 15px;
	padding:230px 0 0;
	overflow:hidden;
	xxxxborder:1px solid;
	background-image: url(images/Main.jpg);
	background-repeat: no-repeat;
}
h2{
	position:absolute;
	top:55px;
	left:233px;
	margin:0;
	font-size:0;
	text-indent:-999px;
	-moz-user-select:none;
	-webkit-user-select:none;
	user-select:none;
	cursor:default;
	width: 404px;
	height: 90px;
}
h2 em{display:block;font:italic bold 200px/120px "Times New Roman",Times,Serif;text-indent:0;letter-spacing:-5px;color:rgba(216,226,244,0.3);}
.link a{margin-right:1em;}
.link,.texts{width:540px;margin:0 auto 15px;color:#505050;}
.texts{line-height:2;}
.texts dd{margin:0;padding:0 0 0 15px;}
.texts ul{margin:0;padding:0;}
.portal{color:#505050;text-align:center;white-space:nowrap;word-spacing:0.45em;}
.portal a:link,.portal a:visited{color:#505050;word-spacing:0;}
.portal a:hover,.portal a:active{color:#007ab7;}
.portal span{display:inline-block;height:38px;line-height:35px;background:url(img/portal.png) repeat-x;}
.portal span span{padding:0 0 0 20px;background:url(img/portal.png) no-repeat 0 -40px;}
.portal span span span{padding:0 20px 0 0;background-position:100% -80px;}
.STYLE1 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 65px;
}
</style>
<style type="text/css">
h2 em{color:#e4ebf8;}
</style>
</head>
<body>
    <h1></h1>
    <p class="link">
<!--        <a href="/">&#9666;返回首页</a>
        <a href="javascript:history.go(-1);">&#9666;返回上一页</a>-->
<a href="#">我们正在联系火星总部查找您所需要的页面.返回信息......亲，木有这个页面啊</a>
    </p>
    <dl class="texts">
        <dt><p class="link"></p></dt>
<dd>
            <ul>
                <li>输入了正确地址吗?</li>
                <li>确定输入地址是正确吗?</li>
                <li>真的真的输入地址正确吗?</li>
                <li>好吧.你继续呆在这个页面上吧。</li>
            </ul>
        </dd>
    </dl>

    </span></span></span></p>
</body>
</html>
<?php }?>