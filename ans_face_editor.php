<?PHP
isset($_POST['faceNo'])? $faceNo = $_POST['faceNo'] : $faceNo = 0;
isset($_POST['elemNo'])? $elemNo = $_POST['elemNo'] : $elemNo = 0;
isset($_POST['pk'])? $cardNo = $_POST['pk'] : $cardNo = 0;
if($faceNo!=0 && $cardNo!=0){ // allow $elemNo==0
	require("db/pdodb.php");
	$core = Core::getInstance();
	$sql = "UPDATE `macardsi_base`.cardbase SET thumbid = ? WHERE cardno = ?";
	$sth = $core->dbh->prepare($sql);
	if($faceNo == 1) $faceNo = '';
	$params = array('thumbHead'.$faceNo.' f'.$elemNo, $cardNo);
	$sth->execute($params);
	if($sth->rowCount() >0) echo 'done';
	else echo 'UPDATE FAILS';
} else echo 'error parameters.(faceNo:'.$faceNo.', elemNo:'.$elemNo.', pk:'.$cardNo.')';
?>
