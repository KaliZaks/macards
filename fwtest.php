<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="zh-tw">
<head>
	<title>百萬亞瑟王卡牌能力表</title>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <meta name="google" value="notranslate">
	<link rel="shortcut icon" href="css/images/favicon.ico?cb=1" />
	<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
	<link rel="stylesheet" href="css/thumbs.css" type="text/css" media="all" />
	<link rel="stylesheet" href="js/fancybox/jquery.fancybox-1.3.2.css" type="text/css" media="all" />
	<!--[if IE 6]>
		<link rel="stylesheet" href="css/ie6.css" type="text/css" media="all" />
		<script src="js/png-fix.js" type="text/javascript" charset="utf-8"></script>
	<![endif]-->
    
    <!-- Modified Bootstrap CSS -->
    <!-- Le styles -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link type="text/css" href="css/custom-theme/jquery-ui-1.10.0.custom.css" rel="stylesheet" />
    <link type="text/css" href="assets/css/font-awesome.min.css" rel="stylesheet" />
    <!--[if IE 7]>
    <link rel="stylesheet" href="assets/css/font-awesome-ie7.min.css">
    <![endif]-->
    <!--[if lt IE 9]>
    <link rel="stylesheet" type="text/css" href="css/custom-theme/jquery.ui.1.10.0.ie.css"/>
    <![endif]-->
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script>
	var date = new Date();
	var currenttime = '<?PHP echo date("F d, Y H:i:s", time())?>';
	var serverdate=new Date(currenttime);
	setInterval('serverdate.setSeconds(serverdate.getSeconds()+1)', 1000);
	
	/*$(document).ready(function() {
        $.get('ajax/ajax_index.php', {time: serverdate.getTime()}, function(data){
			$('#showgrid').html(data);
		});
    });*/
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
		font-size:15px;
	}
	.smartgrid td a{
		text-decoration:none;
		color:#3D0101;
	}
	.fixed{
		top:1px;
		position:fixed;
		width:802px;
	}
	.gotop{
		top:1px;
	}
	
	/* modified Bootstrap style */
	.ui-accordion .ui-accordion-content{
		padding: 2px;
		line-height:22px;
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
		<p>カード　オブ　拡散性ミリオンアーサー<br />Card of MILLION ARTHUR</p>
		<h2>百萬亞瑟王的卡牌能力表</h2>
	</div>
</div>
<!-- end breadcrumbs -->
<!-- main -->
<div id="main">
	<div class="shell">
		
		<!-- sidebar -->
		<div id="sidebar" class="left">
			
			<!-- sidebar widget -->
            <form id="form1" name="form1" method="post" action="">
			<div id="searchpanel" class="entry sidebar-widget" style="position:fixed">
				<h2 class="title">搜尋功能表</h2>
                <div id="menu-collapse">
                
                <div>
                <h3><a href="#" style="color:#C00">稀有度：</a></h3>
                  <div style="position:relative">
                    <label for="cb_rare_0">
                      <input type="checkbox" name="cb_rare" value="1" id="cb_rare_0" checked="checked" />
                      ★</label>
                      
                    <label for="cb_rare_1" style="position:absolute; left:40px">
                      <input type="checkbox" name="cb_rare" value="2" id="cb_rare_1" checked="checked" />
                      ★★</label>
                    
                    <label for="cb_rare_2" style="position:absolute; left:90px">
                      <input type="checkbox" name="cb_rare" value="3" id="cb_rare_2" checked="checked" />
                      ★★★</label>
                      
                    <br />
                    
                    <label for="cb_rare_3">
                      <input type="checkbox" name="cb_rare" value="4" id="cb_rare_3" checked="checked" />
                      ★★★★</label>
                      
                    <label for="cb_rare_4">
                      <input type="checkbox" name="cb_rare" value="5" id="cb_rare_4" checked="checked" />
                      ★★★★★</label>
                      
                    <br />
                      
                    <label for="cb_rare_5">
                      <input type="checkbox" name="cb_rare" value="6" id="cb_rare_5" checked="checked" />
                    ★★★★★★</label>
                    
                    <br />
                      
                    <label for="cb_rare_6">
                      <input type="checkbox" name="cb_rare" value="7" id="cb_rare_6" checked="checked" />
                    ＭＲ★★★★★★★</label>
                  </div>
                </div>
                
                <div>
                <h3><a href="#" style="color:#C00">陣營：</a></h3>
                  <div>
                      <label>
                        <input type="checkbox" name="cb_race" value="1" id="cb_race_0" checked="checked" />
                        劍術之城</label>
                      <br />
                      <label>
                        <input type="checkbox" name="cb_race" value="2" id="cb_race_1" checked="checked" />
                        技巧之場</label>
                      <br />
                      <label>
                        <input type="checkbox" name="cb_race" value="3" id="cb_race_2" checked="checked" />
                        魔法之派</label>
                      <br />
                      <label>
                        <input type="checkbox" name="cb_race" value="4" id="cb_race_3" checked="checked" />
                        妖精</label>
                      <br />
                  </div>
                </div>
                  
                <div>
                  <h3><a href="#" style="color:#C00">次要排序：</a></h3>
                  <div>
                    <label>
                      <input type="radio" name="ra_sort" value="0" id="ra_sort_0" checked="checked" />
                      稀有度</label>
                    <br />
                    <label>
                      <input type="radio" name="ra_sort" value="1" id="ra_sort_1" />
                      COST</label>
                    <br />
                    <label>
                      <input type="radio" name="ra_sort" value="2" id="ra_sort_2" />
                      基本滿級HP</label>
                    <br />
                    <label>
                      <input type="radio" name="ra_sort" value="3" id="ra_sort_3" />
                      基本滿級ATK</label>
                    <br />
                    <label>
                      <input type="radio" name="ra_sort" value="4" id="ra_sort_4" />
                      基本評分</label>
                    <br />
                    <label>
                      <input type="radio" name="ra_sort" value="5" id="ra_sort_5" />
                      限突滿級HP</label>
                    <br />
                    <label>
                      <input type="radio" name="ra_sort" value="6" id="ra_sort_6" />
                      限突滿級ATK</label>
                    <br />
                    <label>
                      <input type="radio" name="ra_sort" value="7" id="ra_sort_7" />
                      限突評分</label>
                    <br />
                      <p>
                        <label>
                          <input type="radio" name="ra_sortdirect" value="0" id="ra_sortdirect_0" checked="checked" />
                          大到小</label>
                        <label>
                          <input type="radio" name="ra_sortdirect" value="1" id="ra_sortdirect_1" style="margin-left:10px" />
                          小到大</label>
                        <br />
                      </p>
                  </div>
                </div>
              
            	</div>
<a href="#" class="gray-btn" style="margin:2px 0 0 130px" id="btnsubmit"><span>送出</span></a>
			</div>
            </form>
			<!-- end sidebar widget -->
			
			
		</div>
		<!-- end sidebar -->
		
		<!-- content -->
		<div id="content" class="right">
			<div class="entry">
				<h2 class="title" style="margin-top: -10px">說明</h2>
                <div id="showgrid">
<?PHP
$myFile = "testFile.txt";
$fh = fopen($myFile, 'w') or die("can't open file");
$stringData = "Floppy Jalopy\n";
fwrite($fh, $stringData);
$stringData = "Pointy Pinto\n";
fwrite($fh, $stringData);
fclose($fh);
?>                
                </div>
			</div>
		</div>
        
        
		<!-- end content -->
		
		<div class="cl">&nbsp;</div>
	</div>
</div>
<!-- end main -->
<!-- end wrapper -->
<!-- footer 暫時已移除 -->

<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>
<script src="js/jquery.ui.accordion.js" type="text/javascript" charset="utf-8"></script>
<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
<script>
$("#menu-collapse").accordion({
    header: "h3"
});
</script>
</body>
</html>