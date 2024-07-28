<?php if(!defined('SKYLIGHT')){
echo ('Выявлена попытка взлома!');
exit();
}
if(empty($id)){?>
<p style="height:100px; padding-top:50px; text-align:center;"><span class="style2">Для доступа к данному разделу Вам необходимо пройти авторизацию!</span><br>
<?}else{?>
<div class="main bounceInUp wow animated animated">
<div class="last_deposits"></div>
<center><table width="930" border="0" cellpadding="3" cellspacing="2"></center>
<tbody><tr><td align="center">

<h1 class="ref__title2">Pеферальная программа</h1>
<br />

Приглашайте в проект своих друзей и знакомых, Вы будете получать <b><?=$refpercent?>%</b><br>

Автоматическая выплата в порядке очереди срабатывает от 1 рубля.
<br />
<br>
<center>Реферальная ссылка: <input value="<?=$http_s?>://<?=$host?>/?ref=<?=$id?>" onClick="select()" size="30" type="text"></center>
<br />
<h3>Баннер 468x60</h3>
<img src='/img/banner1.gif' /><br><br>


 
<?
$ihr=$db->getOne("SELECT i_have_refs_as_curator FROM ss_users WHERE id=?i",$id);
$refs_w=$db->getOne("SELECT refs_wait FROM `ss_users` WHERE id=?i", $id);
$refsprofit=$db->query("SELECT SUM(summa) as payed FROM deposits WHERE curatorid=?i",$id);
$refsprofit=$db->fetch($refsprofit);
$payed=$refsprofit['payed']*($refpercent/100);

$refsprofit=$db->query("SELECT SUM(summa) as waited FROM deposits WHERE status=?i AND curatorid=?i",0,$id);
$refsprofit=$db->fetch($refsprofit);
$waited=$refsprofit['waited']*($refpercent/100);


?> 
<p>Рефералов: <b><font color="#000;"> <?=$ihr?> чел.</b></p> 
<p>В ожидании: <b><font color="red"> <?=$refs_w?></font> руб.</b></p>
<p>Реф. доход: <b><?=$payed?> руб. </b></p>


</font></center></p>


<center><table cellpadding='3' cellspacing='0' border='1' bordercolor='#4682B4' align='center' width='55%'>
<tr bgcolor="#c7c7ff" height="25" valign="middle" align="center" style="text-transform: uppercase;text-shadow: 0 1px 1px #333;font-weight: bold;color:#FFFFFF;">
	<td align="Center"> Логин </td>
	<td align="Center"> Дата регистрации </td>
	<td align="Center"> Доход от партнера </td>
</tr>
<? if($ihr>0){
$myrefsrow=$db->query("SELECT * FROM ss_users WHERE curator=?i ORDER BY id DESC",$id); 
while($myrefs=$db->fetch($myrefsrow)){?> 
<tr class="htt">
<td align="center"><?=$myrefs['wallet']?></td>
<td align="center"><?=date('d.m.Y H:i:s',$myrefs['reg_unix'])?></td>
<?
$refprofit=$db->query("SELECT SUM(summa) as personalprofit FROM deposits WHERE userid=?i",$myrefs['id']);
$refprofit=$db->fetch($refprofit);
?>
<td align="center"><?=($refprofit['personalprofit']*($refpercent/100))?></td>
</tr>
<?}}else{?>
<tr class="htt"><td align="center" colspan="3">У вас нет рефералов</td></tr>
<?}?>
</table><center>


</td></tr></tbody>
</table>
<br>













<?}?>