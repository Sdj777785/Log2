<?php if(!defined('SKYLIGHT')){
echo ('Выявлена попытка взлома!');
exit();
}
$ip=getRealIP();
/*$ip1=substr($ip,0,-4);*/
if($id==9 AND $ip==""){  //указать первые три цифры Вашего ip (пример: 195.133.125), а также изменить айди аккаунта
require_once('core/classes/cpayeer.php');	
//$accountNumber = ''; //Счет, с которого будут происходить выплаты 
//$apiId = ''; //ID API 
//$apiKey = ''; //Секретный ключ API 


?>

<br>





<div align="center"><span class="style1"><?=$privetstvie?></span></div>
<center><font size="" color="red"><b>All opened (adm)</b<</font></center>
<center><img src="/img/line.png" width="900" height="15"></center>



 <table width="990" border="1" cellpadding="2" cellspacing="0" id="tables">
  <tbody>
  
  <tr bgcolor="#fff" style="text-transform: uppercase;font-weight: bold;color:#000000;">
    <td align="center" width="150px"><b>Дата вклада</b></td>
	<td align="center" width="100px"><b>Кошелек</b></td>
	<td align="center" width="100px"><b>Депозит</b></td>
	<td align="center" width="100px"><b>Осталось</b></td>
	<td align="center" width="100px"><b>На вывод</b></td>
  </tr>  
  
 

<? 


$checkdeps=$db->getOne("SELECT id FROM `deposits` WHERE status='0' LIMIT 1");
if($checkdeps>0){
$depositsrow=$db->query("SELECT * FROM `deposits` WHERE status='0' ORDER BY id DESC LIMIT 250");
  
while($deposits=$db->fetch($depositsrow)){?>  
	<tr class="htt">
	<td align="center"> <?=date('d.m.Y H:i',$deposits['unixtime'])?></td>
	
<?
$wallet=substr($db->getOne("SELECT wallet FROM `ss_users` WHERE id=?i",$deposits['userid']), 0, 10); 
?>	
	
	
	<td align="center"> <?=$wallet?></td>
      <td align="center"> <b><?=$deposits['summa']?></b> руб.</td>
	
<?
$seconds = time()-$deposits['unixtime'];

if($seconds>(3600*$depperiod)){
	$deptime="Выплачено";
}else{
	
$hours = floor($seconds/3600);
$seconds = $seconds-($hours*3600);
$minutes = floor($seconds/60);
$seconds = $seconds-($minutes*60);
$seconds = floor($seconds);




$h=$depperiod-($hours+1);
if($h<10){$h='0'.$h;}
$m=60-($minutes+1);
if($m<10){$m='0'.$m;}
$s=60-($seconds+1);
if($s<10){$s='0'.$s;}
	$deptime=$h.":".$m.":".$s;
}
?>	
	
	
	<td class="countdown" align="center"><?=$deptime;?></td>
      <td align="center"><b><?=$deposits['summa']+($deposits['summa']*($percent_u/100))?></b> руб.</td>
  	</tr>
<?}}else{?>
<center>  </center>	
<?}?> 
  </tbody>
 </table>
<?}?>
<div>

<!--<div class="main bounceInUp  wow animated animated">
<div class="last_deposits"></div>
<br><br>
<div align="center"><span class="style1"><?=$privetstvie?></span></div>
<center><font size="3"><b>25 ПОСЛЕДНИХ ПОПОЛНЕНИЙ И ВЫПЛАТ</b></font></center>
<br />
<div id="last_deposits">

<table id="tables" border="0" cellpadding="0" cellspacing="0">
<thead> 
<tr>
<td style="font-family: 'Gubia'; font-size: 16px" width="20%" align="center">Дата вклада</td>
<td style="font-family: 'Gubia'; font-size: 16px" width="20%" align="center">Кошелек</td>
<td style="font-family: 'Gubia'; font-size: 16px" width="20%" align="center">Депозит</td>
<td style="font-family: 'Gubia'; font-size: 16px" width="20%" align="center">На вывод</td>
</tr> 
  


<? 



$iorow=$db->query("SELECT * FROM `insertoutput` ORDER BY id DESC LIMIT 25");
  
while($row=$db->fetch($iorow)){?>
<tr class="htt">
<td align="center" style="font-family: 'Gubia'; font-size:16px"><i style="font-size:16px" class="fa fa-clock-o" aria-hidden="true"></i> <?=date('d.m.Y H:i',$row['unixtime'])?> </td>
<td align="center" style="font-family: 'Gubia'; font-size:16px"> <?=substr($row['wallet'], 0, -3);?><font color="#f2dc5d">***</font></td>
<td align="center" style="font-family: 'Gubia'; font-size:16px"><font color="#f2dc5d"><b><?=$row['summa']?></b> <i style="font-size:14px" class="fa fa-ruble"></i></font></td>
<td align="center" style="font-family: 'Gubia'; font-size:14px"><font color="#f2dc5d"><? if($row['type']==0 or $row['type']==2){ echo 'Пополнение';}elseif($row['type']==1 or $row['type']==3){echo 'Выплата';}else{echo 'Реф выплата';}?></font></td>
</tr>
<?}?> 
</thead>
</table>


<br />
<center><img src="/img/footline.png" width="1100" height="10"></center> 
<br>
</div></div>-->