<?PHP
date_default_timezone_set("Asia/Taipei");
$load_count = file_get_contents("counts.txt"); 
if(strlen($load_count) >5){
	$arrCounts = explode("\r\n", $load_count); // $arrCounts = [0]最終寫入日(格式:月/日/年), [1]今日人次, [2]本月人次, [3]總人次
	$isDate = strtotime($arrCounts[0]);
	($isDate !== false)? $arrDate = explode("/", $arrCounts[0]) : $arrDate = explode("/", date("m/d/Y")); // $arrDate = $arrCounts[0] = [0]月 [1]日 [2]年
	if($arrDate[0] != date("m")){ //換月，同時月人次歸零
		$arrDate[0] = date("m");
		$arrCounts[2] = 0;
	}
	if($arrDate[1] != date("d")){ //換日，同時日人次歸零
		$arrDate[1] = date("d");
		$arrCounts[1] = 0;
	}
	if($arrDate[2] != date("Y")) $arrDate[2] = date("Y"); //換年
	
	if(empty($_COOKIE["ct_mainfo"])){
		$tomorrow = date("Y-m-d", time()+86400);
		setcookie("ct_mainfo", "true", strtotime($tomorrow)); //每位訪客每日只計數一次，cookie午夜12時重置
		$arrCounts[1]++;
		$arrCounts[2]++;
		$arrCounts[3]++;
	}
	
	$load_count = $arrDate[0]."/".$arrDate[1]."/".$arrDate[2]."\r\n".$arrCounts[1]."\r\n".$arrCounts[2]."\r\n".$arrCounts[3];
	//寫回
	file_put_contents("counts.txt", $load_count);
} else {
	//Initial new file
	$load_count = date("m/d/Y")."\r\n0\r\n0\r\n0";
	file_put_contents("counts.txt", $load_count);
}
$arrCounts = explode("\r\n", $load_count);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="zh-tw">
<head>
	<title>百萬亞瑟王卡牌能力表</title>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <meta name="google" value="notranslate">
    <meta name="description" content="擴散性MA(日服)卡片資料 如有任何建議歡迎到巴哈姆特(www.gamer.com.tw)留言 謝謝">
    <meta name="keywords" content="卡片,牌組,cp速查表,百萬亞瑟,百萬亞瑟王,擴散性,MA">
	<link rel="shortcut icon" href="css/images/favicon.ico?cb=1" />
	<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
	<link rel="stylesheet" href="css/thumbs.css" type="text/css" media="all" />
	<!--[if IE 6]>
		<link rel="stylesheet" href="css/ie6.css" type="text/css" media="all" />
		<script src="js/png-fix.js" type="text/javascript" charset="utf-8"></script>
	<![endif]-->
    
    <!-- Modified Bootstrap CSS -->
    <!-- Le styles -->
    <link type="text/css" href="css/custom-theme/jquery-ui-1.10.0.custom.css" rel="stylesheet" />
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
	
	$(document).ready(function() {
		var cb_rare = new Array(3)
		cb_rare [0] = "5"
		cb_rare [1] = "6"
		cb_rare [2] = "7"
        $.get('ajax/ajax_index.php', { "cb_rare": cb_rare, time: serverdate.getTime()}, function(data){
			$('#showgrid').html(data);
		});
    });
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
                      <input type="checkbox" name="cb_rare" value="1" id="cb_rare_0" />
                      ★</label>
                      
                    <label for="cb_rare_1" style="position:absolute; left:40px">
                      <input type="checkbox" name="cb_rare" value="2" id="cb_rare_1" />
                      ★★</label>
                    
                    <label for="cb_rare_2" style="position:absolute; left:90px">
                      <input type="checkbox" name="cb_rare" value="3" id="cb_rare_2" />
                      ★★★</label>
                      
                    <br />
                    
                    <label for="cb_rare_3">
                      <input type="checkbox" name="cb_rare" value="4" id="cb_rare_3" />
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
			
			<div id="counterpanel" class="entry sidebar-widget" style="position:fixed; bottom:10px">
<?PHP
echo '今日訪客： '.$arrCounts[1].'<br>'.'本月訪客： '.$arrCounts[2].'<br>'.'總人次： '.$arrCounts[3];
?>
            </div>
			
		</div>
		<!-- end sidebar -->
		
		<!-- content -->
		<div id="content" class="right">
			<div class="entry">
				<h2 class="title" style="margin-top: -10px">說明</h2>
                <div id="showgrid">
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

<script src="js/jquery-ui-1.10.3.custom.min.js"></script>
<script>
$("#menu-collapse").accordion({
    header: "h3"
});
</script>
</body>
</html>