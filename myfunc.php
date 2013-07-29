<?php
/**
*  抓不到錯誤來源時可叫出來用:
*  勿用，會列出連線字串
*  to save a uncatched exception simply write 
*  <?php throw new Exception('error'); ?> 
*  somewhere in code. 
**/
/*
function exception_handler($exception) { 
ob_start(); 
print_r($GLOBALS); 
print_r($exception); 
  file_put_contents('fullexceptions.txt', ob_get_clean(). "\n",FILE_APPEND); 
} 
set_exception_handler('exception_handler'); 
*/
date_default_timezone_set("Asia/Taipei");

function isPostBack()
{
	if(isset($_SERVER['REQUEST_METHOD'])){
		return ($_SERVER['REQUEST_METHOD'] == 'POST');
	} else {
		return false;
	}
}

function ezPost($post_data = array(), $url)
    {
	$o="";
	foreach ($post_data as $k=>$v)
		{
		    $o.= "$k=".urlencode($v)."&";
		}
	$post_data=substr($o,0,-1);
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_URL,$url);
	//For cookie support
	curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
	$result = curl_exec($ch);
	return $result;
    }

/**
 * 這是測試
 *
 * @param POST/GET $string
 * return 安全跳脫字元後的字串
 */
function savequery($string)
{
	return (mysql_real_escape_string($string));
}
	
// $expire = the time in seconds until a session have to expire
function start_session($expire = 0) {
    if ($expire == 0) {
        $expire = ini_get("session.gc_maxlifetime");
    } else {
        ini_set("session.gc_maxlifetime", $expire);
    }
    if (empty($_COOKIE['PHPSESSID'])) {
        session_set_cookie_params($expire);
        session_start();
    } else {
        session_start();
        setcookie("PHPSESSID", session_id(), time() + $expire);
    }
}
// start_session(600) will start a session which will expire after 10 minutes (60*10 seconds)

function getIP() { 
$ip; 
if (getenv("HTTP_CLIENT_IP")) 
$ip = getenv("HTTP_CLIENT_IP"); 
else if(getenv("HTTP_X_FORWARDED_FOR")) 
$ip = getenv("HTTP_X_FORWARDED_FOR"); 
else if(getenv("REMOTE_ADDR")) 
$ip = getenv("REMOTE_ADDR"); 
else 
$ip = "UNKNOWN";
return $ip; 
}

function big52utf8($big5str) {
	$blen = strlen($big5str);
	$utf8str = "";

	for($i=0; $i<$blen; $i++) {

		$sbit = ord(substr($big5str, $i, 1));
		//echo $sbit;
		//echo "<br>";
		if ($sbit < 129) {
			$utf8str.=substr($big5str,$i,1);
		} elseif ($sbit > 128 && $sbit < 255) {
			$new_word = iconv("BIG5", "UTF-8", substr($big5str,$i,2));
			$utf8str.=($new_word=="")?"?":$new_word;
			$i++;
		}
	}
	return $utf8str;
}

function is_date( $str ) 
{ 
  $stamp = strtotime( $str ); 
  
  if (!is_numeric($stamp)) 
  { 
     return FALSE; 
  } 
  $month = date( 'm', $stamp ); 
  $day   = date( 'd', $stamp ); 
  $year  = date( 'Y', $stamp ); 
  
  if (checkdate($month, $day, $year)) 
  { 
     return TRUE; 
  } 
  
  return FALSE; 
}

function randAlphaNum($caps=false,$length=8){
	$alphNums = "0123456789abcdefghijklmnopqrstuvwxyz";
	if($caps==true)
	    $alphNums = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
    $newString = str_shuffle(str_repeat($alphNums, rand(1, $length))); 
    
    return substr($newString, rand(0,strlen($newString)-$length), $length);
}

function inttime_dayf($timestamp){
	return strtotime(date('Y-m-d', $timestamp));
}
function inttime_dayt($timestamp, $inc=''){
	if($inc != ''){
		$diff = strtotime($inc) - time();
		return  strtotime(date('Y-m-', $timestamp).((int)date('d', $timestamp))) + $diff;
	} else {
		$addOneDay = $timestamp + 86400;
		return strtotime(date('Y-m-d', $addOneDay));
	}
}

function getInt($string){
	$words = '';
	$res = preg_match_all('/(\d+)/', $string, $matches);
	//$res == match times
	foreach($matches[0] as $word){
		$words .= $word;
	}
	return $words;
}

function symbolFilter($inputString){
	preg_match_all('/(\w+)/', $inputString, $matches);
	$fullpattern = '';
	foreach($matches[1] as $match){
		$fullpattern .= $match; 
	}
	return $fullpattern;
}

function genZoneArray($fullzone=false){
	$stack = array();
	$cities = array('台北市', '基隆市', '新北市', '宜蘭縣', '桃園縣', '新竹市', '新竹縣', '苗栗縣', '台中市', '彰化縣', '南投縣', '嘉義市', '嘉義縣', '雲林縣', '台南市', '高雄市', '屏東縣', '台東縣', '花蓮縣');
	
	$c1 = array('中正區 100','大同區 103','中山區 104','松山區 105','大安區 106','萬華區 108','信義區 110','士林區 111','北投區 112','內湖區 114','南港區 115','文山區 116');
	$c2 = array('仁愛區 200','信義區 201','中正區 202','中山區 203','安樂區 204','暖暖區 205','七堵區 206');
	$c3 = array('萬里區 207','金山區 208','板橋區 220','汐止區 221','深坑區 222','石碇區 223','瑞芳區 224','平溪區 226','雙溪區 227','貢寮區 228','新店區 231','坪林區 232','烏來區 233','永和區 234','中和區 235','土城區 236','三峽區 237','樹林區 238','鶯歌區 239','三重區 241','新莊區 242','泰山區 243','林口區 244','蘆洲區 247','五股區 248','八里區 249','淡水區 251','三芝區 252','石門區 253');
	$c4 = array('宜蘭市 260','頭城鎮 261','礁溪鄉 262','壯圍鄉 263','員山鄉 264','羅東鎮 265','三星鄉 266','大同鄉 267','五結鄉 268','冬山鄉 269','蘇澳鎮 270','南澳鄉 272');
	$c5 = array('東　區 300','北　區 300','香山區 300');
	$c6 = array('竹北市 302','湖口鄉 303','新豐鄉 304','新埔鎮 305','關西鎮 306','芎林鄉 307','寶山鄉 308','竹東鎮 310','五峰鄉 311','橫山鄉 312','尖石鄉 313','北埔鄉 314','峨眉鄉 315');
	$c7 = array('中壢市 320','平鎮市 324','龍潭鄉 325','楊梅鎮 326','新屋鄉 327','觀音鄉 328','桃園市 330','龜山鄉 333','八德市 334','大溪鎮 335','復興鄉 336','大園鄉 337','蘆竹鄉 338');
	$c8 = array('竹南鎮 350','頭份鎮 351','三灣鄉 352','南庄鄉 353','獅潭鄉 354','後龍鎮 356','通霄鎮 357','苑裡鎮 358','苗栗市 360','造橋鄉 361','頭屋鄉 362','公館鄉 363','大湖鄉 364','泰安鄉 365','銅鑼鄉 366','三義鄉 367','西湖鄉 368','卓蘭鎮 369');
	$c9 = array('中　區 400','東　區 401','南　區 402','西　區 403','北　區 404','北屯區 406','西屯區 407','南屯區 408','太平區 411','大里區 412','霧峰區 413','烏日區 414','豐原區 420','后里區 421','石岡區 422','東勢區 423','和平區 424','新社區 426','潭子區 427','大雅區 428','神岡區 429','大肚區 432','沙鹿區 433','龍井區 434','梧棲區 435','清水區 436','大甲區 437','外埔區 438','大安區 439');
	$c10 = array('彰化市 500','芬園鄉 502','花壇鄉 503','秀水鄉 504','鹿港鎮 505','福興鄉 506','線西鄉 507','和美鎮 508','伸港鄉 509','員林鎮 510','社頭鄉 511','永靖鄉 512','埔心鄉 513','溪湖鎮 514','大村鄉 515','埔鹽鄉 516','田中鎮 520','北斗鎮 521','田尾鄉 522','埤頭鄉 523','溪州鄉 524','竹塘鄉 525','二林鎮 526','大城鄉 527','芳苑鄉 528','二水鄉 530');
	$c11 = array('南投市 540','中寮鄉 541','草屯鎮 542','國姓鄉 544','埔里鎮 545','仁愛鄉 546','名間鄉 551','集集鎮 552','水里鄉 553','魚池鄉 555','信義鄉 556','竹山鎮 557','鹿谷鄉 558');
	$c12 = array('東　區 600','西　區 600');
	$c13 = array('番路鄉 602','梅山鄉 603','竹崎鄉 604','阿里山 605','中埔鄉 606','大埔鄉 607','水上鄉 608','鹿草鄉 611','太保市 612','朴子市 613','東石鄉 614','六腳鄉 615','新港鄉 616','民雄鄉 621','大林鎮 622','溪口鄉 623','義竹鄉 624','布袋鎮 625');
	$c14 = array('斗南鎮 630','大埤鄉 631','虎尾鎮 632','土庫鎮 633','褒忠鄉 634','東勢鄉 635','台西鄉 636','崙背鄉 637','麥寮鄉 638','斗六市 640','林內鄉 643','古坑鄉 646','莿桐鄉 647','西螺鎮 648','二崙鄉 649','北港鎮 651','水林鄉 652','口湖鄉 653','四湖鄉 654','元長鄉 655');
	$c15 = array('中西區 700','東　區 701','南　區 702','北　區 704','安平區 708','安南區 709','永康區 710','歸仁區 711','新化區 712','左鎮區 713','玉井區 714','楠西區 715','南化區 716','仁德區 717','關廟區 718','龍崎區 719','官田區 720','麻豆區 721','佳里區 722','西港區 723','七股區 724','將軍區 725','學甲區 726','北門區 727','新營區 730','後壁區 731','白河區 732','東山區 733','六甲區 734','下營區 735','柳營區 736','鹽水區 737','善化區 741','大內區 742','山上區 743','新市區 744','安定區 745');
	$c16 = array('新興區 800','前金區 801','苓雅區 802','鹽埕區 803','鼓山區 804','旗津區 805','前鎮區 806','三民區 807','楠梓區 811','小港區 812','左營區 813','仁武區 814','大社區 815','岡山區 820','路竹區 821','阿蓮區 822','田寮區 823','燕巢區 824','橋頭區 825','梓官區 826','彌陀區 827','永安區 828','湖內區 829','鳳山區 830','大寮區 831','林園區 832','鳥松區 833','大樹區 840','旗山區 842','美濃區 843','六龜區 844','內門區 845','杉林區 846','甲仙區 847','桃源區 848','那瑪夏 849','茂林區 851','茄萣區 852');
	$c17 = array('屏東市 900','三地門 901','霧台鄉 902','瑪家鄉 903','九如鄉 904','里港鄉 905','高樹鄉 906','鹽埔鄉 907','長治鄉 908','麟洛鄉 909','竹田鄉 911','內埔鄉 912','萬丹鄉 913','潮州鎮 920','泰武鄉 921','來義鄉 922','萬巒鄉 923','崁頂鄉 924','新埤鄉 925','南州鄉 926','林邊鄉 927','東港鎮 928','琉球鄉 929','佳冬鄉 931','新園鄉 932','枋寮鄉 940','枋山鄉 941','春日鄉 942','獅子鄉 943','車城鄉 944','牡丹鄉 945','恆春鎮 946','滿州鄉 947');
	$c18 = array('台東市 950','綠島鄉 951','蘭嶼鄉 952','延平鄉 953','卑南鄉 954','鹿野鄉 955','關山鎮 956','海端鄉 957','池上鄉 958','東河鄉 959','成功鎮 961','長濱鄉 962','太麻里 963','金峰鄉 964','大武鄉 965','達仁鄉 966');
	$c19 = array('花蓮市 970','新城鄉 971','秀林鄉 972','吉安鄉 973','壽豐鄉 974','鳳林鎮 975','光復鄉 976','豐濱鄉 977','瑞穗鄉 978','萬榮鄉 979','玉里鎮 981','卓溪鄉 982','富里鄉 983');
	foreach($cities as $city){
		switch($city){

			case '台北市':
				$area = $c1;
				break;
			case '基隆市':
				$area = $c2;
				break;
			case '新北市':
				$area = $c3;
				break;
			case '宜蘭縣':
				$area = $c4;
				break;
			case '新竹市':
				$area = $c5;
				break;
			case '新竹縣':
				$area = $c6;
				break;
			case '桃園縣':
				$area = $c7;
				break;
			case '苗栗縣':
				$area = $c8;
				break;
			case '台中市':
				$area = $c9;
				break;
			case '彰化縣':
				$area = $c10;
				break;
			case '南投縣':
				$area = $c11;
				break;
			case '嘉義市':
				$area = $c12;
				break;
			case '嘉義縣':
				$area = $c13;
				break;
			case '雲林縣':
				$area = $c14;
				break;
			case '台南市':
				$area = $c15;
				break;
			case '高雄市':
				$area = $c16;
				break;
			case '屏東縣':
				$area = $c17;
				break;
			case '台東縣':
				$area = $c18;
				break;
			case '花蓮縣':
				$area = $c19;
				break;
			default:
				$area = '';
				break;
		}
		if($area!='') $stack[$city] = $area;
	}
	return $stack;
}

function getCurPath(){
	$filename = basename($_SERVER['PHP_SELF']);
	return substr($_SERVER['PHP_SELF'], 0, -strlen($filename));
}
//應該是抓取英數混中文字用，具體忘了，PDF轉換時用的
function mb_get12($string, $lenth, $getFront = true){
	$utfs = 0;
	for($i=0; $i<$lenth; $i++){
		if(strlen(mb_substr($string, $i-$utfs, 1, 'UTF-8')) >1){
			$utfs++;
			$i++;
		}
	}
	if($getFront == false){
		return mb_substr($string, $lenth-$utfs, mb_strlen($string), 'UTF-8');
	} else
		return mb_substr($string, 0, $lenth-$utfs, 'UTF-8');
}
//PDF載入條碼用
function loadpng($url, $SaveAs = NULL) {
    $ch = curl_init();

    curl_setopt ($ch, CURLOPT_URL, $url);
    curl_setopt ($ch, CURLOPT_BINARYTRANSFER, true);  
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);  
    curl_setopt ($ch, CURLOPT_HEADER, false);  
    curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 0);
	curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
	$useragent = "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0)";
	curl_setopt($ch, CURLOPT_USERAGENT, $useragent); 

    $rawdata = curl_exec($ch);
    $image = imagecreatefromstring($rawdata);

    curl_close($ch);

	if($SaveAs == NULL)
		return imagepng($image);
	else
	    return imagepng($image, $SaveAs);
}
// unset cookies (in whole domain)
function clearCookie(){
	if (isset($_SERVER['HTTP_COOKIE'])) {
		$cookies = explode(';', $_SERVER['HTTP_COOKIE']);
		foreach($cookies as $cookie) {
			$parts = explode('=', $cookie);
			$name = trim($parts[0]);
			setcookie($name, '', time()-1000);
			setcookie($name, '', time()-1000, '/');
		}
	}
}
//safty
function XSSfilter($value) {
  return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}
//this is for array_walk_recursive
function XSSfilter_r(&$value) {
  $value = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

class counts{
	public $load_count;
	function counts(){
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
	}
}
?>