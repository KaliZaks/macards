<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en-US" xmlns="http://www.w3.org/1999/xhtml" dir="ltr">
<head>
	<title>卡牌編號擴增器</title>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<link rel="shortcut icon" href="css/images/favicon.ico?cb=1" />
	<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
	<link rel="stylesheet" href="js/fancybox/jquery.fancybox-1.3.2.css" type="text/css" media="all" />
	<!--[if IE 6]>
		<link rel="stylesheet" href="css/ie6.css" type="text/css" media="all" />
		<script src="js/png-fix.js" type="text/javascript" charset="utf-8"></script>
	<![endif]-->
	<script src="js/jquery-1.4.2.js" type="text/javascript" charset="utf-8"></script>
	<script src="js/jquery.tweet.js" type="text/javascript" charset="utf-8"></script>
	<script src="js/jquery.easing.1.3.js" type="text/javascript" charset="utf-8"></script>
	<script src="js/fancybox/jquery.fancybox-1.3.2.js" type="text/javascript" charset="utf-8"></script>
	<script src="js/fancybox/jquery.mousewheel-3.0.2.pack.js" type="text/javascript" charset="utf-8"></script>
	<script src="js/easySlider1.5.js" type="text/javascript" charset="utf-8"></script>
	<script src="js/jquery.jcarousel.js" type="text/javascript" charset="utf-8"></script>
	<script src="js/js-func.js" type="text/javascript" charset="utf-8"></script>
    <script>
	var date = new Date();
	var currenttime = '<?PHP echo date("F d, Y H:i:s", time())?>';
	var serverdate=new Date(currenttime);
	setInterval('serverdate.setSeconds(serverdate.getSeconds()+1)', 1000);
	
	
	</script>
    <style>
	/*smartgrid*/
	.smartgrid{
		text-align:center;
	}
	.smartgrid th, .smartgrid th a{
		font-size:15px;
		text-decoration:none;
		color:#FFFFFF;
	}
	.smartgrid td{
		font-size:13px;
	}
	</style>
</head>
<body>
<!-- wrapper -->
<div id="wrapper">
	
	<!-- header 已移除 -->

<!-- breadcrumbs -->
<div class="breadcrumbs">
	<div class="shell">
		<p>Some intro message goes here</p>
		<h2>Left Sidebar Page</h2>
	</div>
</div>
<!-- end breadcrumbs -->
<!-- main -->
<div id="main">
	<div class="shell">
		
		
                <div id="showgrid">
                
<?PHP
if(isset($_POST['maxid']) && $_POST['maxid']){
	$myFile = "css/thumbs2.css";
	$fh = fopen($myFile, 'w') or die("can't open file");
	$stringData = "";
	for($i=0; $i<=$_POST['maxid']; $i++){
		if($i>9)
			$y = $i / 10;
		else $y = 0;
		$x = $i % 10;
		$stringData .= ".f$i{background-position:-".($x*64)."px -".((int)$y*64)."px}";
	}
	fwrite($fh, $stringData);
	fclose($fh);
	echo $stringData;
} else {
	echo '
	<form id="form1" name="form1" enctype="multipart/form-data" method="post" action="'.basename(__FILE__).'" style="line-height:30px">
                  <label style="font-size:15px">請輸入最新編號：</label><input type="text" name="maxid" id="maxid" style="width:80px" />
                  <input type="submit" name="send" id="send" value="送出" />
                </form>'
				;
	$myFile = "css/thumbs2.css";
	$fh = fopen($myFile, 'r');
	$theData = fread($fh, 512 * 1024);
	fclose($fh);
	
	preg_match_all('/\\.f\\d+?\\{background-position.*?\\}/i', $theData, $matches);
	//note: $matches是二維陣列，資料在第二維
	print_r($matches[0]);
}
?>                
                
                </div>
        
        
		<!-- end content -->
		
		<div class="cl">&nbsp;</div>
	</div>
</div>
<!-- end main -->
<!-- end wrapper -->
<!-- footer 暫時已移除 -->

<!-- login popup -->
<div id="screen">
	<div class="abs-holder">
		<div class="login">
			<a href="#" class="close-btn"></a>
			<h4>LOGIN</h4>
			<div class="form-holder">
				<form action="#" method="post">
					<div class="row">
						<input type="text" class="field blink" title="Username" value="Username" />
						<div class="cl">&nbsp;</div>
					</div>
					<div class="row">
						<input type="password" class="field blink" title="Password" value="Password" />
						<div class="cl">&nbsp;</div>
					</div>
				</form>
				<div class="remember-me">
					<input type="checkbox" class="checkbox" />
					<label>Remember me</label>
				</div>
				<input type="submit" class="login-btn" value="LOGIN" />
				<div class="cl">&nbsp;</div>
			</div>
		</div>
	</div>
</div>
<!-- end login popup -->
</body>
</html>
