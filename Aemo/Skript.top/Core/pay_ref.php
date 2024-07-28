<?
if(!defined('SKYLIGHT')){
exit();
}
$refs_per=$db->getOne("SELECT refs_wait FROM `ss_users` WHERE id=?i", $refs_id);

if($refs_per>$min_payeer){
	
		require_once('classes/cpayeer.php');	
		$payeer = new CPayeer($accountNumber, $apiId, $apiKey);
		if ($payeer->isAuth()){
			$arBalance = $payeer->getBalance();
		}
		$balance = $arBalance["balance"]["RUB"]["DOSTUPNO"];

		if($refs_per<$balance){
			
			$db->query("UPDATE ss_users SET refs_wait=refs_wait-$refs_per WHERE id=?i",$refs_id);
		
			$m_curr='RUB'; 
		$com='Выплата реферальных с проекта hydes.top. Благодарим за сотрудничество!';
		$arTransfer = $payeer->transfer(array(
		'curIn' => $m_curr,
		'sum' => $refs_per,
		'curOut' => $m_curr,
		'to' => $wallet,
		'comment' => $com,
	));
	}}

?>