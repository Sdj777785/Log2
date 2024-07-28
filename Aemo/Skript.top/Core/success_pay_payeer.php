<?php 
define('SKYLIGHT',dirname(__FILE__));
require_once('classes/safemysql.php');
require_once('config.php');

$cmnt="none";

$sum=$_POST['m_amount']; //Сумма, поступившая от клиента
$id=$_POST['m_orderid'];

	
if (isset($_POST['m_operation_id']) && isset($_POST['m_sign']))
{
	$arHash = array($_POST['m_operation_id'],
			$_POST['m_operation_ps'],
			$_POST['m_operation_date'],
			$_POST['m_operation_pay_date'],
			$_POST['m_shop'],
			$_POST['m_orderid'],
			$_POST['m_amount'],
			$_POST['m_curr'],
			$_POST['m_desc'],
			$_POST['m_status'],
			$m_key);
	$sign_hash = strtoupper(hash('sha256', implode(':', $arHash)));
if ($_POST['m_sign'] == $sign_hash && $_POST['m_status'] == 'success')
{
	echo $_POST['m_orderid'].'|success';
	
		
$referer=$db->getOne("SELECT curator FROM `ss_users` WHERE id=?i", $id);

$db->query("INSERT INTO deposits (userid, curatorid, summa, unixtime) VALUES(?s,?s,?i,?i)", $id, $referer, $sum, time());	

/*в статистику пополнений*/
$wallet=$db->getOne("SELECT wallet FROM `ss_users` WHERE id=?i", $id);
$db->query("INSERT INTO insertoutput (wallet, summa, unixtime,type) VALUES(?s,?s,?i,?i)", $wallet, $sum, time(),0);	 //0-Пополнение;1-Выплата;2-fake пополнение;3-fake выплата;
/*Платим админские*/
$adminid=$db->getOne("SELECT id FROM `ss_users` WHERE wallet=?s", $koshelek_admina);

$adminsum=$sum*($admpercent/100);
addUserStat($adminid, "<!--stat--><!--whithdraw--><!--admin-->Выплата", "<!--stat--><!--whithdraw--><!--admin-->Выплата админских (".$adminsum." руб.)");

require_once('pay_admin.php');
	




//Затем рефские.
//$referer=$db->getOne("SELECT curator FROM `ss_users` WHERE id=?i", $ocherr['userid']);	
$refererwallet=strtoupper($db->getOne("SELECT wallet FROM `ss_users` WHERE id=?i", $referer));
$referersum=$sum*($refpercent/100);
if($referer>0 && $refererwallet[0]=='P'){
$db->query("UPDATE ss_users SET refs_wait=refs_wait+$referersum WHERE id=?i",$referer);
$db->query("INSERT INTO insertoutput (wallet, summa, unixtime,type) VALUES(?s,?s,?i,?i)", $refererwallet, $referersum, time(),4);	 //0-Пополнение;1-Выплата;2-fake пополнение;3-fake выплата;4-реф выплата;5-fake реф выплата

		
addUserStat($referer, "<!--stat--><!--whithdraw--><!--fromreferal-->Выплата", "<!--stat--><!--whithdraw--><!--fromreferal-->Выплата реферальных (".$referersum." руб.)");
}

exit;
}
echo $_POST['m_orderid'].'|error';

}
?>
