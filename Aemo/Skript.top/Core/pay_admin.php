<?
if(!defined('SKYLIGHT')){
exit();
}
$admin_per=$db->getOne("SELECT admin_per FROM `config` WHERE id=?i", 1);
$summ=$admin_per+$adminsum;
if($summ<$min_payeer){
	$db->query("UPDATE config SET admin_per=admin_per+$adminsum WHERE id=?i",1);
	}else{
		require_once('classes/cpayeer.php');	
		$payeer = new CPayeer($accountNumber, $apiId, $apiKey);
		if ($payeer->isAuth()){
			$arBalance = $payeer->getBalance();
		}
		$balance = $arBalance["balance"]["RUB"]["DOSTUPNO"];

		if($summ<$balance){
			$summa_admin=$summ;
			$db->query("UPDATE config SET admin_per=admin_per-$admin_per WHERE id=?i",1);
		}else{
			$summa_admin=$adminsum;
			}
			$m_curr='RUB'; 
		$com='Админские с проекта hydes.top';
		$arTransfer = $payeer->transfer(array(
		'curIn' => $m_curr,
		'sum' => $summa_admin,
		'curOut' => $m_curr,
		'to' => $koshelek_admina,
		'comment' => $com,
	));
	}

?>