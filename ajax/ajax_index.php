<?PHP
require('../classes/pdoSmartGrid.php');

isset($_GET['cb_rare'])? $cb_rare = $_GET['cb_rare'] : $cb_rare = '';
isset($_GET['cb_race'])? $cb_race = $_GET['cb_race'] : $cb_race = '';
isset($_GET['ra_sort'])? $ra_sort = $_GET['ra_sort'] : $ra_sort = 0;
isset($_GET['ra_sortdirect'])? $ra_sortdirect = $_GET['ra_sortdirect'] : $ra_sortdirect = 0;

echo '
                <table width="802" border="1" class="smartgrid onepx" style="table-layout:fixed">
				<col width="83px">
				<col width="120px">
				<col width="48px">
				<col width="48px">
				<col width="63px">
				<col width="63px">
				<col width="60px">
				<col width="63px">
				<col width="63px">
				<col width="60px">
				<col width="65px" id="expandable">
				<col width="64px">
				  ';

$sql = 'SELECT thumbid, jname, rare, cost, maxhp, maxatk, cp, lbmaxhp, lbmaxatk, lbcp, race, `force`, skillno FROM `macardsi_base`.cardbase';

//處理 左側 搜尋功能表

if($cb_rare != '' && $cb_rare != NULL){
	if(!is_array($cb_rare)){
		//byethost or ZhiBon needed
		$cb_rare = stripslashes($cb_rare);
		$cb_rare = json_decode($cb_rare, true);
	}
	$sqlsuffix = ' WHERE';
	foreach($cb_rare as $val){
		switch($val){
			case 1:
				($sqlsuffix == ' WHERE')? $sqlsuffix .= ' rare = 1' : $sqlsuffix .= ' OR rare = 1';
				break;
			case 2:
				($sqlsuffix == ' WHERE')? $sqlsuffix .= ' rare = 2' : $sqlsuffix .= ' OR rare = 2';
				break;
			case 3:
				($sqlsuffix == ' WHERE')? $sqlsuffix .= ' rare = 3' : $sqlsuffix .= ' OR rare = 3';
				break;
			case 4:
				($sqlsuffix == ' WHERE')? $sqlsuffix .= ' rare = 4' : $sqlsuffix .= ' OR rare = 4';
				break;
			case 5:
				($sqlsuffix == ' WHERE')? $sqlsuffix .= ' rare = 5' : $sqlsuffix .= ' OR rare = 5';
				break;
			case 6:
				($sqlsuffix == ' WHERE')? $sqlsuffix .= ' rare = 6' : $sqlsuffix .= ' OR rare = 6';
				break;
			case 7:
				($sqlsuffix == ' WHERE')? $sqlsuffix .= ' rare = 7' : $sqlsuffix .= ' OR rare = 7';
				break;
		}
	}
	if($sqlsuffix != ' WHERE') $sql .= str_replace('WHERE', 'WHERE (', $sqlsuffix).')';
}
if($cb_race != '' && $cb_race != NULL){
	if(!is_array($cb_race)){
		//byethost or ZhiBon needed
		$cb_race = stripslashes($cb_race);
		$cb_race = json_decode($cb_race, true);
	}
	if(isset($sqlsuffix) && $sqlsuffix != ' WHERE'){
		$sqlsuffix = ' AND'; //assign new sqlsuffix or keep old if empty
	} else {
		$sqlsuffix = ' WHERE';
		$wherebegin = true; //rare全空、WHERE從這起始，後頭判斷用
	}
	foreach($cb_race as $val){
		switch($val){
			case 1:
				($sqlsuffix == ' WHERE' || $sqlsuffix == ' AND')? $sqlsuffix .= ' race = 1' : $sqlsuffix .= ' OR race = 1';
				break;
			case 2:
				($sqlsuffix == ' WHERE' || $sqlsuffix == ' AND')? $sqlsuffix .= ' race = 2' : $sqlsuffix .= ' OR race = 2';
				break;
			case 3:
				($sqlsuffix == ' WHERE' || $sqlsuffix == ' AND')? $sqlsuffix .= ' race = 3' : $sqlsuffix .= ' OR race = 3';
				break;
			case 4:
				($sqlsuffix == ' WHERE' || $sqlsuffix == ' AND')? $sqlsuffix .= ' race = 4' : $sqlsuffix .= ' OR race = 4';
				break;
		}
	}
	if($sqlsuffix != ' WHERE' && $sqlsuffix != ' AND'){
		if(isset($wherebegin)){
			$sql .= str_replace('WHERE', 'WHERE (', $sqlsuffix).')';
		} else {
			$sql .= str_replace('AND', 'AND (', $sqlsuffix).')';
		}
	}
}

//再排序，必定要使用，若無傳值預設使用rare
switch($ra_sort){
	case 1:
		$subSortBy = 'cost';
		break;
	case 2:
		$subSortBy = 'maxhp';
		break;
	case 3:
		$subSortBy = 'maxatk';
		break;
	case 4:
		$subSortBy = 'cp';
		break;
	case 5:
		$subSortBy = 'lbmaxhp';
		break;
	case 6:
		$subSortBy = 'lbmaxatk';
		break;
	case 7:
		$subSortBy = 'lbcp';
		break;
	default:
		$subSortBy = 'rare';
}
switch($ra_sortdirect){
	case 1:
		$subSortDirection = 'ASC';
		break;
	default:
		$subSortDirection = 'DESC';
}

//名前 畫像 所屬 rare cost フォース MAXHP MAXATK CP LB_HP LB_ATK LB_CP
$smartgrid = new smartGrid;
$smartgrid->setPath('ajax');
$smartgrid->setQueryString($sql);
$smartgrid->setSorting('rare', 'ASC', false, $subSortBy, $subSortDirection);
$arrCols = array('頭像', '名字', '★', 'COST', '基本滿級HP', '基本滿級ATK', '基本評分', '限突滿級HP', '限突滿級ATK', '限突評分', '陣營', 'フォース', '技能');
$arrPercent = array('85px', '122px', '48px', '46px', '63px', '63px', '60px', '63px', '63px', '60px', '65px', '64px', '129px');
$smartgrid->echoSortAjax('showgrid', $arrCols, $arrPercent, '', false);

/*echo '</table>
		<div style="position: absolute; height:560px; overflow-y:scroll; overflow-x:auto">
		<table width="802" style="table-layout:fixed">
				<col width="83px">
				<col width="120px">
				<col width="48px">
				<col width="48px">
				<col width="63px">
				<col width="63px">
				<col width="60px">
				<col width="63px">
				<col width="63px">
				<col width="60px">
				<col width="65px">
				<col width="64px">';
				*/

if($smartgrid->getNumRows() >0){
	$res = $smartgrid->getRows();
	foreach($res as $row){
		($row['thumbid'] == 'no thumb')? $thumbid = 'thumbHead f0' : $thumbid = $row['thumbid'];
		echo '
			  <tr>';
		echo '
			    <td><a href="http://zh.kssma.wikia.com/wiki/'.$row['jname'].'" target="wikia_detail"><div class="'.$thumbid.'">&nbsp;</div></a></td>';
		echo '
			    <td><a href="http://zh.kssma.wikia.com/wiki/'.$row['jname'].'" target="wikia_detail">'.$row['jname'].'</a></td>';
		echo '
			    <td>'.$row['rare'].'</td>';
		echo '
			    <td>'.$row['cost'].'</td>';
		echo '
			    <td>'.$row['maxhp'].'</td>';
		echo '
			    <td>'.$row['maxatk'].'</td>';
		echo '
			    <td>'.$row['cp'].'</td>';
		echo '
			    <td>'.$row['lbmaxhp'].'</td>';
		echo '
			    <td>'.$row['lbmaxatk'].'</td>';
		echo '
			    <td>'.$row['lbcp'].'</td>';
		switch($row['race']){
			case 0:
				$race = '';
				break;
			case 1:
				$race = '<font color="#EE0000">劍術之城</font>';
				break;
			case 2:
				$race = '<font color="#006600">技巧之場</font>';
				break;
			case 3:
				$race = '<font color="#003399">魔法之派</font>';
				break;
			case 4:
				$race = '<font color="#CC0066">妖精</font>';
				break;
		}
		echo '
			    <td name="smartcol10">'.$race.'</td>';
		switch($row['force']){
			case 0:
				$force = '--';
				break;
			case 1:
				$force = '劍術';
				break;
			case 2:
				$force = '技巧';
				break;
			case 3:
				$force = '魔法';
				break;
			default:
				$force = '--';
				break;
		}
		echo '
			    <td name="smartcol11">'.$force.'</td>';
		echo '
			    <td name="smartcol12">這個欄位擺技能</td>';
		echo '
			  </tr>';
			  $i++;
	}
} else {
		echo '
			  <tr>';
		echo '
			    <td colspan="13"> *沒有查詢到任何資料</td>';
		echo '
			  </tr>';
}

echo '
				</table></div>';

//end brackets

//re-attach position: fixed
echo '		
			<script>
				var theLoc = $("#smartth").position().top;
				
					if(theLoc >= $(window).scrollTop()) {
						if($("#smartth").hasClass("fixed"))
							$("#smartth").removeClass("fixed");
					} else { 
						if(!$("#smartth").hasClass("fixed"))
							$("#smartth").addClass("fixed");
					}
				
				$(window).scroll(function() {
					if(theLoc >= $(window).scrollTop()) {
						if($("#smartth").hasClass("fixed")) {
							$("#smartth").removeClass("fixed");
						}
						$("#searchpanel").removeClass("gotop");
					} else { 
						if(!$("#smartth").hasClass("fixed")) {
							$("#smartth").addClass("fixed");
						}
						$("#searchpanel").addClass("gotop");
					}
				});
			</script>';
//set parameter and binding to submit button
//and avoid repeat binding, use off before on
	echo '
	<script>
		$("#btnsubmit").off("click");
		$("#btnsubmit").on("click", function(){
			var arrRare = [];
			var arrRace = [];
			$("input[name=\'cb_rare\']:checked").each(function() {
                arrRare.push($(this).val());
            });
			$("input[name=\'cb_race\']:checked").each(function() {
                arrRace.push($(this).val());
            });
			$.get("ajax/ajax_index.php'.$smartgrid->add_or_change_parameter('time', time()).'", {"cb_rare": arrRare, "cb_race": arrRace, "ra_sort": $("input[name=\'ra_sort\']:checked").val(), "ra_sortdirect": $("input[name=\'ra_sortdirect\']:checked").val()}, function(data){
				$("#showgrid").html(data);
			});
			return false;
		});
	</script>';
?>