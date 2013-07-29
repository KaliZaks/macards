<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en-US" xmlns="http://www.w3.org/1999/xhtml" dir="ltr">
<head>
	<title>卡牌編號選取器</title>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<link rel="shortcut icon" href="css/images/favicon.ico?cb=1" />
	<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
	<link rel="stylesheet" href="js/fancybox/jquery.fancybox-1.3.2.css" type="text/css" media="all" />
    <link type="text/css" href="css/custom-theme/jquery-ui-1.10.0.custom.css" rel="stylesheet" />
	<!--[if IE 6]>
		<link rel="stylesheet" href="css/ie6.css" type="text/css" media="all" />
		<script src="js/png-fix.js" type="text/javascript" charset="utf-8"></script>
	<![endif]-->
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
    <script>
	var date = new Date();
	var currenttime = '<?PHP echo date("F d, Y H:i:s", time())?>';
	var serverdate=new Date(currenttime);
	setInterval('serverdate.setSeconds(serverdate.getSeconds()+1)', 1000);
	
	$(document).ready(function(){
		
		var faceNo = 0;
		var elemNo = 0;
		$( "#dialog1" ).dialog({
			modal: true,
			autoOpen: false,
			resizable: false,
			width: 750,
			height:700,
			dialogClass: "tipbox"
		});
		$('.carddivs').click(function(){
			$('#dialoghint').html($(this).attr('name')+'<input id="pk" type=hidden value="'+ $(this).attr('number') +'" />');
			$('#dialog1').dialog('open');
			$('a[name^="face"]').css('margin-left', '10px').click(function(){
				$('a[name^="face"]').css('border', '0');
				$(this).css('border', '2px solid red');
				faceNo = $(this).attr('name').substr(4, 1);
				if(faceNo == 1)
					$('#something').attr('src', 'images/Face.jpg');
				else
					$('#something').attr('src', 'images/Face'+ faceNo +'.jpg');
            });
		});
		$("#something").click(function(e){
			//var parentOffset = $(this).parent().offset(); 
			var thisOffset = $(this).offset();
			var relX = e.pageX - thisOffset.left;
			var relY = e.pageY - thisOffset.top;
			elemNo = parseInt(parseInt(relX) / 64) + 10*( parseInt(parseInt(relY) / 64) )
			//alert(parseInt(relX) +', '+ parseInt(relY) +', elemNo: '+ elemNo);
			$.post('ans_face_editor.php', {'faceNo': faceNo, 'elemNo': elemNo, 'pk': $('#pk').val()}, function(data){
				if(data == 'done')
					window.location.reload();
				else
					$('#ajax_res').html(data);
			});
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
		
		
                <div id="showgrid">
                
<?PHP
require("db/pdodb.php");
$core = Core::getInstance();
$sql = "SELECT cardno, jname FROM `macardsi_base`.cardbase WHERE thumbid = 'no thumb'";
$sth = $core->dbh->prepare($sql);
$sth->execute();
if($sth->rowCount() >0){
	echo '總筆數:'.$sth->rowCount().'<br>';
	while(list($cardno, $jname) = $sth->fetch()){
		echo '<div class="carddivs" number="'.$cardno.'" name="'.$jname.'">No.'.$cardno.': '.$jname.'</div>';
	}
} else {
	echo '太好了、沒有任何未編號的卡牌！<br>';
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
<div id="dialog1">
	<div id="dialoghint"></div>
	<div id="imagePicker"><a name="face1" href="javascript:void(0)">Face.jpg</a><a name="face2" href="javascript:void(0)">Face2.jpg</a><a name="face3" href="javascript:void(0)">Face3.jpg</a></div>
    <div id="ajax_res"><img src="" id="something" style="border:0" /></div>
</div>
</body>
</html>
