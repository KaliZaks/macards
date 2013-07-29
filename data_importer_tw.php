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
	
	/*
	$(document).ready(function() {
        $.get('ajax/ajax_index.php', {time: serverdate.getTime()}, function(data){
			$('#showgrid').html(data);
		});
    });
	*/
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
		
		//Call SQL pdodb
		include_once('db/pdodb.php');
		$core = Core::getInstance();
		$sql = 'UPDATE `btbyetho_ma`.`cardbase` SET thumbid = ? WHERE jname = ?';
		$sth = $core->dbh->prepare($sql);
		
		error_reporting(E_ALL ^ E_NOTICE);
		
		$filename = $_FILES['filexls']['name'];
		$file = fopen($filename, 'r');
		$contents = fread($file, filesize($filename));
		$searchstring = preg_match_all('/<div class="(?P<id>.+?)" title="(?P<name>.+?)">/', $contents, $matchs);
		fclose($file);
		
		for($i=0; $i<480; $i++){
			if($matchs['name'][$i]){
				$params = array($matchs['id'][$i], $matchs['name'][$i]);
				$sth->execute($params);
				//echo 'name:'.$matchs['name'][$i].' id:'.$matchs['id'][$i].'<br>';
			}
		}
		
		/*
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
		*/
		
		/*名称　陣營(x) 力量屬性(陣營) RARE COST ???
		$type = 0;
		$arrType1 = array();
		$cost = 2;
		$sql = 'INSERT IGNORE INTO `ma`.`cardbase` (`jname`, `cost`, `maxlv1`, `maxlv2`, `skill`, `rare`, `gender`, `force`) VALUES (:jname, :cost, :maxlv1, :maxlv2, :skill, :rare, :gender, :force);';
		$sth = $core->dbh->prepare($sql);
		for($i; $i <= $highestRow; $i++) {
			
			for($j = 'A'; $j != $lastColumn; $j++){
				$val =  $WS->getCellByColumnAndRow(ord($j)-65, $i)->getValue(); //chr to ascii
				echo '　';
				echo $val;
				
				//首欄有rowspan，且row2第一欄從B開始，即 ord('B')-65 == 1
				if(ord($j)-65 == 0){
					//get [rare] and [name]
					if(preg_match('/☆(\d?)】(.+)/', $val, $matchs)){
						$arrType1['rare'] = $matchs[1];
						$arrType1['jname'] = $matchs[2];
						echo 'found.'.$arrType1['jname'];
						$type = 1;
					} elseif(strstr($val, 'cost')){
						$cost = substr($val, 4);
					}
				}
				if(ord($j)-65 == 1 && $type == 0){
					if(strstr('限突', $val)){
						echo 'found22';
						$type = 2;
					} else echo '<br><font color="red">line '.$i.' 什麼都沒找到！</font><br>';
				}
				
				if($type == 1){
					if(ord($j)-65 == 2) $arrType1['lv1'] = $val;
					if(ord($j)-65 == 8)
						($val)? $arrType1['gender'] = $val : $arrType1['gender'] = '';
					if(ord($j)-65 == 9){
						switch($val){
							case 'アサルト':
								$val = 1;
								break;
							case 'テクニカル':
								$val = 2;
								break;
							case 'マジック':
								$val = 3;
								break;
							default:
							 $val = 0;
						}
						$arrType1['force'] = $val;
					}
				} elseif($type == 2){
					if(ord($j)-65 == 2) $lv2 = $val;
				}
			}
			
			if($arrType1['jname']){
				if($lv2){
					//INSERT data
					$params = array(':jname'=>$arrType1['jname'], ':cost'=>$cost, ':maxlv1'=>$arrType1['lv1'], ':maxlv2'=>$lv2, ':skill'=>0, ':rare'=>$arrType1['rare'], ':gender'=>$arrType1['gender'], ':force'=>$arrType1['force']);
					$sth->execute($params);
					if($sth->rowCount() >0)
						echo '<br>'.$jname.'正常結束<br>';
					else echo '<font color="red">rowCount <1 !!</font>';
					//reset states
					$arrType1 = array();
					$lv2 = '';
					$type = 0;
				} else {
					echo '<br>一邊結束，還需另一邊<br>';
					$type = 0;
				}
			} else echo '<br><font color="red">line '.$i.' 無抓取資料!!($rare:'.$rare.' $jname:'.$jname.' $lv1:'.$lv1.' $gender:'.$gender.' $force:'.$force.')</font><br>';
			//echo '<br>-----------------------<br>';
		}
		*/
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
