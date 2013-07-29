<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en-US" xmlns="http://www.w3.org/1999/xhtml" dir="ltr">
<head>
	<title>Premium CSS template by ChocoTemplates.com</title>
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
	
	$(document).ready(function() {
        $.get('ajax/ajax_index.php', {time: serverdate.getTime()}, function(data){
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
		
		<!-- sidebar -->
		<div id="sidebar" class="left">
			
			<!-- sidebar widget -->
			<div class="entry sidebar-widget">
				<h2 class="title">Sidebar Widget</h2>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc ornare consequat .</p>
				<ul>
				    <li>Lorem ipsum dolor sit amet</li>
				    <li>Consectetuer adipiscing elit</li>
				    <li>Proin sed odio et ante adipiscing</li>
				    <li>Mazim sensibus et usu</li>
				    <li>Nulla dignisim rutrum eleifen</li>
				</ul>
				<a href="#" class="request-btn">Request for Proposal</a>
			</div>
			<!-- end sidebar widget -->
			
			<!-- feature-in widget -->
			<div class="entry">
				<h2 class="title">Featured In</h2>
				<a href="http://cssmayo.com/" class="left css_mayo"></a>
				<a href="http://www.netmag.co.uk/" class="left net_mag"></a>
				<a href="http://www.bbc.co.uk/" class="left bbc"></a>
				<a href="http://digg.com/" class="left digg"></a>
				<div class="cl">&nbsp;</div>
			</div>
			<!-- end feature-in widget -->
			
			<!-- ads -->
			<div class="entry">
				<h2 class="title">Advertisments</h2>
				<a href="http://htmlmafia.com" class="ads"><img src="css/images/htmlmafia.gif" alt="" /></a>
			</div>
			<!-- end ads -->
			
		</div>
		<!-- end sidebar -->
		
		<!-- content -->
		<div id="content" class="right">
			<div class="entry">
				<h2 class="title">Some Title Goes Here</h2>
				
                <form id="form1" name="form1" enctype="multipart/form-data" method="post" action="<?PHP basename(__FILE__);?>" style="line-height:30px">
                  <input name="MAX_FILE_SIZE" type="hidden" id="MAX_FILE_SIZE" value="2000000" />
                  匯入檔案：
                  <input type="file" name="filexls" id="filexls" style="background-color:#FFE9B9" />
                  <input type="submit" name="send" id="send" value="送出" />
                </form>
<?PHP
	echo '<tr>';
	
	if (isset($_FILES['filexls']['name']) && $_FILES['filexls']['name'] != '') {
		echo '檔案名稱：'.$_FILES['filexls']['name'].'<br />';
		echo '檔案大小：'.$_FILES['filexls']['size'].'<br />';
		echo '暫存名稱：'.$_FILES['filexls']['tmp_name'].'<br />';
		echo '檔案類型：'.$_FILES['filexls']['type'].'<br />';
		echo '錯誤訊息：'.$_FILES['filexls']['error'].'<br />';
		echo '<br>'; //美觀~

		//Level 2 needs filter
		function getInt($string){
			$words = '';
			$res = preg_match_all('/(\d+)/', $string, $matches);
			//$res == match times
			foreach($matches[0] as $word){
				$words .= $word;
			}
			return $words;
		}
		
		//Call SQL pdodb
		include_once('db/pdodb.php');
		$core = Core::getInstance();
		
		error_reporting(E_ALL ^ E_NOTICE);
		
		require('classes/PHPExcel.php');
		$inputFileName = $_FILES['filexls']['tmp_name'];
		$inputFileType = PHPExcel_IOFactory::identify($inputFileName);
		$objReader = PHPExcel_IOFactory::createReader($inputFileType);
		if($inputFileType == 'CSV') die('檔案格式錯誤(該檔案為.csv文字格式)，請匯入Excel檔案！！');
		//FileType will like EXCEL5 or excel2007 etc...
		elseif(strstr(strtoupper($inputFileType), 'EXCEL') == FALSE) die('檔案格式錯誤(副檔名錯誤)，請匯入Excel檔案！！');
		$objReader->setReadDataOnly(true);
		$objPHPExcel = $objReader->load($inputFileName);
		$WS = $objPHPExcel->getActiveSheet();
		$highestRow = $WS->getHighestRow();
		$lastColumn = $WS->getHighestColumn();
		$lastColumn++;
		
		//名前 畫像 所屬 rare cost フォース MAXHP MAXATK CP LB_HP LB_ATK LB_CP
		$type = 0;
		$arrType1 = array();
		$cost = 2;
		$sql = 'INSERT IGNORE INTO `macardsi_base`.`cardbase` (`jname`, `thumbid`, `cost`, `maxhp`, `maxatk`, `cp`, `lbmaxhp`, `lbmaxatk`, `lbcp`, `rare`, `race`, `force`) VALUES (:jname, :thumbid, :cost, :maxhp, :maxatk, :cp, :lbmaxhp, :lbmaxatk, :lbcp, :rare, :race, :force);';
		$sth = $core->dbh->prepare($sql);
		for($i; $i <= $highestRow; $i++) {
			
			for($j = 'A'; $j != $lastColumn; $j++){
				$val =  $WS->getCellByColumnAndRow(ord($j)-65, $i)->getValue(); //chr to ascii
				echo '　';
				echo $val;
				
				switch(ord($j)){
					case 65:
						$jname = $val;
						break;
					case 67:
						$race = $val;
						switch($race){
							case '剣術の城':
								$race = 1;
								break;
							case '技巧の場':
								$race = 2;
								break;
							case '魔法の派':
								$race = 3;
								break;
							case '妖精':
								$race = 4;
								break;
						}
						break;
					case 68://計算星星
						$rare = preg_match_all('/☆/', $val, $matchs);
						break;
					case 69:
						$cost = $val;
						break;
					case 70:
						$force = $val;
						switch($force){
							case 'アサルトフォース':
								$force = 1;
								break;
							case 'テクニカルフォース':
								$force = 2;
								break;
							case 'マジックフォース':
								$force = 3;
								break;
						}
						break;
					case 71:
						$maxhp = $val;
						break;
					case 72:
						$maxatk = $val;
						break;
					case 73:
						$cp = $val;
						break;
					case 74:
						$lbmaxhp = $val;
						break;
					case 75:
						$lbmaxatk = $val;
						break;
					case 76:
						$lbcp = $val;
						break;
				}
				
			}
			
			if($jname != ''){
				$params = array(':jname'=> $jname, ':thumbid'=> 'no thumb', ':cost'=> $cost, ':maxhp'=> $maxhp, ':maxatk'=> $maxatk, ':cp'=> $cp, ':lbmaxhp'=> $lbmaxhp, ':lbmaxatk'=> $lbmaxatk, ':lbcp'=> $lbcp, ':rare'=> $rare, ':race'=> $race, ':force'=> $force);
				$sth->execute($params);
				echo '<br>---------------------<br>';
			}
			
		}
	}
	
	echo '</tr>';
?>
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
