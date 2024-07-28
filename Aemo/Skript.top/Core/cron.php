<?

if(file_exists(dirname(__FILE__)."/core/ini.php")){
define ("SKYLIGHT" , dirname(__FILE__) );
$_SERVER['DOCUMENT_ROOT']=dirname(__FILE__);}
else if(file_exists($_SERVER['DOCUMENT_ROOT']."/core/ini.php") && !empty($_SERVER['DOCUMENT_ROOT'])){define ("SKYLIGHT" , $_SERVER['DOCUMENT_ROOT']);}else{die ("NOT_DEFINED_ROOT_DIR");}
define ("CRON" , 1);
error_reporting(0); // вывод ошибок
if(empty($nocron)){
require_once('ini.php');
$nocron=1;
}



if($nocron==1) 
{



$mintime=time()-(60*60*$depperiod);
$ocherr=$db->getRow("SELECT * FROM deposits WHERE status='0' AND unixtime<?s ORDER BY id ASC LIMIT 1",$mintime);

if($ocherr['id']>0){

if($ocherr['status']!=2){

$wallet=$db->getOne("SELECT wallet FROM ss_users WHERE id=?i", $ocherr['userid']);		
$psumma=$ocherr['summa']+($ocherr['summa']*($percent_u/100));



whithdraw( $ocherr['userid'], $wallet, $psumma, $ocherr['id'] );
addUserStat($ocherr['userid'], "<!--stat--><!--whithdraw--><!--fromdeposit-->Выплата", "<!--stat--><!--whithdraw--><!--fromdeposit-->Выплата по депозиту (".$psumma." руб.)");







}
}
$refs_pays=$db->getRow("SELECT * FROM ss_users WHERE refs_wait>?s ORDER BY id ASC LIMIT 1",$min_payeer);

if($refs_pays['id']>0){


$wallet=$db->getOne("SELECT wallet FROM ss_users WHERE id=?i", $refs_pays['id']);		
$refs_id=$refs_pays['id'];	

require_once('pay_ref.php');

}

}

?>