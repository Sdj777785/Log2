<?
if(!defined('SKYLIGHT')){
exit();
}
date_default_timezone_set("Europe/Moscow");
?>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>top-bonus</title>
		<link rel="shortcut icon" href="img\fav.png" type="image/x-icon">
    <meta name="description" content="Добро пожаловать в мир быстрых инвестиций! Зарабатывай с нами и наслаждайся мгновенными выплатами!">
    <meta name="keywords" content="PAYEER, удвоитель, умножитель, свежие проекты 2019, свежие проекты 2020, хайп проекты, лучшие PAYEER проекты, паер проекты, лучшие пэер проекты, проверенные хайп проекты, новые payeer проекты, новые удвоители">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link href="css\bootstrap.min.css" rel="stylesheet">
    <link href="css\mdb.min.css" rel="stylesheet">
    <link href="css\style.css" rel="stylesheet">

		<script>
		$(document).ready(function(){
			setInterval(function(){
				$('.countdown').each(function(){
					var time=$(this).text().split(':');
					var timestamp=time[0]*3600+ time[1]*60+ time[2]*1;timestamp-=timestamp>0;
					var hours=Math.floor(timestamp/3600);
					var minutes=Math.floor((timestamp- hours*3600)/ 60);
					var seconds=timestamp- hours*3600- minutes*60;if(hours<10){hours='0'+ hours;}
					
				if(minutes<10){minutes='0'+ minutes;}
				if(seconds<10){seconds='0'+ seconds;}
				if(timestamp>0){
				$(this).text(hours+':'+ minutes+':'+ seconds);
				}else{
				$(this).text('В обработке');
				}
				});
		},1000);

		})
        
		</script></head>
  
<?
if(!empty($id)){
$wallet=$db->getOne("SELECT wallet FROM ss_users WHERE id=?i",$id);
?>
<?}?>

<?
$opened=$db->getOne("SELECT count(id)  FROM `insertoutput` WHERE (type=0 or type=2) and unixtime > ".(time()-$depperiod*3600));

$query = $db->query("SELECT COUNT(id) as allusers FROM `ss_users` WHERE 1");	
$qqq=$db->fetch($query);
$allusers=$qqq['allusers'];

$balance = $db->fetch($db->query("SELECT SUM(summa) AS Summa FROM deposits WHERE status=?i",0));

//пополнения +fake
$insertb =number_format($db->getOne("SELECT SUM(summa) AS Summa FROM `insertoutput` WHERE type=0 or type=2"), 2, '.', '');
//выплаты +fake
$outb =number_format($db->getOne("SELECT SUM(summa) AS Summa FROM `insertoutput` WHERE type=1 or type=3 or type=4 or type=5"), 2, '.', '');

?>

<header>
  <div class="container">
    <div class="row pt-4">
                  
      <div class="col-md-3 mx-auto mb-3">
        <div class="header__item">
          <i class="fas fa-user-friends" style="padding-right: 5px;"></i> Пользователей: <b><?=$allusers?> <font color="#f2dc5d">чел.</font></b>
        </div>
      </div>

      <div class="col-md-3 mx-auto mb-3">
        <div class="header__item">
          <i class="fas fa-cogs" style="padding-right: 5px;"></i> Пополнено: <b><?=$insertb?> <font color="#f2dc5d">руб.</font></b>
        </div>
      </div>
      <div class="col-md-3 mx-auto mb-3">
        <div class="header__item">
          <i class="fas fa-hand-holding-usd" style="padding-right: 5px;"></i> Выплачено: <b><?=$outb?> <font color="#f2dc5d">руб.</font></b>
        </div>
      </div>
      <div class="col-md-3 mx-auto mb-3">
        <div class="header__item">
          <i class="far fa-calendar-check" style="padding-right: 5px;"></i> Резерв: <b><?=$insertb-$outb?> <font color="#f2dc5d">руб.</font></b>
        </div>
      </div>
    </div>
   <hr class="header__line"> 
    
        


<style type="text/css">
		
		input:focus{
background-image:none;}
		input{ border-radius:0px;}
		</style>
<?if(!empty($_error)){?><br><br><font color="red"><?=$_error?></font><br><br><?}?>
<?if(!empty($_success)){?><br><br><font color="green"><?=$_success?></font><br><br><?}?>				
<?if(empty($id)){?>		

    <div class="row">
      <div class="col-md-6 mx-auto">
        <h1 class="title">TOP-BONUS</h1>
        <h2 class="title2 mb-5">Автодоход +25% через 24 часа
		<form action="" method="post" class="mt-4">
          <input type="hidden" name="do" value="toaccount">
          <input type="hidden" name="antipovtor" value="1518687348">
          <div class="row">
            <div class="col-md-8 login__before">
              <input required="" pattern="^P[0-9]+$" title="Например: P12345678" autocomplete="on" name="wallet" placeholder="Введите ваш PAYEER" type="text" class="input__login w-100 mb-3">
            </div>
            <div class="col-md-4">
              <button type="submit" name="submit" id="form" class="input__btn w-100"><i class="fas fa-sign-in-alt" style="padding-right: 5px;"></i> продолжить</button>
            </div>
          </div>
        </form>
        <p class="wallet__des">Нет кошелька? Зарегистрируйте его бесплатно <a href="https://payeer.com/0631875" target="_blank"><b>перейдя по ссылке</b></a></p>
      </h2></div>
    </div>
</div>
</header>
<!-- DEMO-32 -->
 <!-- <button class="btn btn-outline-white my-3 mx-auto" data-toggle="modal" data-target="#fullHeightModalRight">Вход в проект</button> -->

<div class="mx-auto text-center"><i class="fas fa-chevron-down" style="color: #fff; font-size: 40px;"></i></div>

<main class="main">
  <div class="container">

    <div class="row pt-4 text-center">
      <div class="col-md-3 mx-auto mb-3">
        <div class="mb-4" style="font-size: 18px;">
          <i class="fas fa-calendar-alt" style="font-size: 30px; padding-bottom: 10px; text-shadow: 2px 2px #000;"></i><br>Тариф: <b>+50% через 50 мин</b>
        </div>
      </div>
      <div class="col-md-3 mx-auto mb-3">
        <div class="mb-4" style="font-size: 18px;">
          <i class="fas fa-handshake" style="font-size: 30px; padding-bottom: 10px; text-shadow: 2px 2px #000;"></i><br>Реф. система: <b>10%</b>
        </div>
      </div>
      <div class="col-md-3 mx-auto mb-3">
        <div class="mb-4" style="font-size: 18px;">
          <i class="fas fa-rocket" style="font-size: 30px; padding-bottom: 10px; text-shadow: 2px 2px #000;"></i><br>Выплаты: <b>Автоматически</b>
        </div>
      </div>
      <div class="col-md-3 mx-auto mb-3">
        <div class="mb-4" style="font-size: 18px;">
          <i class="fas fa-check-double" style="font-size: 30px; padding-bottom: 10px; text-shadow: 2px 2px #000;"></i><br>Вклады: <b>2 - 2000 руб.</b>
        </div>
      </div>
    </div>

<div class="row mt-4">
      <div class="col-md-4 mb-4">
        <div class="table_item">
          <h4 class="table_title">Последние пополнения и выплаты</h4>
          <table style="color: #fff;" class="table table-striped text-center table-borderless">
      <thead>
        <tr>
          <th scope="col">Кошелек</th>
          <th scope="col">Сумма</th>
          <th scope="col">Осталось</th>
          <th scope="col">Осталось</th>
        </tr>
      </thead>
      <tbody>
  
  <tr class="htt">
<? 



$iorow=$db->query("SELECT * FROM `insertoutput` ORDER BY id DESC LIMIT 6");
  
while($row=$db->fetch($iorow)){?>
<tr class="htt">
<td align="center" style="font-family: 'Gubia'; font-size:16px"><i style="font-size:16px" class="fa fa-clock-o" aria-hidden="true"></i> <?=date('d.m.Y H:i',$row['unixtime'])?> </td>
<td align="center" style="font-family: 'Gubia'; font-size:16px"> <?=substr($row['wallet'], 0, -3);?><font color="#f2dc5d">***</font></td>
<td align="center" style="font-family: 'Gubia'; font-size:16px"><font color="#f2dc5d"><b><?=$row['summa']?></b> <i style="font-size:14px" class="fa fa-ruble"></i></font></td>
<td align="center" style="font-family: 'Gubia'; font-size:14px"><font color="#f2dc5d"><? if($row['type']==0 or $row['type']==2){ echo 'Пополнение';}elseif($row['type']==1 or $row['type']==3){echo 'Выплата';}else{echo 'Реф выплата';}?></font></td>
</tr>
<?}?> 
    </tr>
 
  </tbody>
 </table>
        </div>
      </div>

      <div class="col-md-4 mb-4">
        <div class="table_item1">
          <h4 class="table_title">Информация о проекте</h4>
          <p class="text-center mt-3" style="font-size: 13px;">
            <b>Top-bonus.top</b> - финансовая система, на принципе распределения денежного потока. Средства участников вложивших позже, распределяются между участниками, вложившими раньше. Проект <b>Top-bonus.top</b> - это функционирующий сайт по принципу финансовой пирамиды. Участвовать может абсолютно любой желающий. Суть программы проста и заключается в том, что сегодня помог ты, а завтра помогут тебе. Все очень просто и доступно даже новичку. Наш проект не предъявляет вам каких-либо требований и условий. Все что Вам нужно делать - это оформить новую инвестицию, и подождать 50 минут. По истечению этому времени Вы получите свой депозит и плюс 50% автоматически с телом. Ваша инвестиция будет автоматически переведена на кошелёк, который Вы указали при регистрации.
          </p>
          <h4 class="table_title">Тех. поддержка</h4>
          <p class="text-center">E-mail - <b>azartlotoclub@yandex.ru </b></p>
        </div>
      </div>
    </div>
  </div>
</main>
		
<div class="row my-4">
      <div class="col-md-10 mx-auto reklama">
        <p style="color: rgba(255,255,255, .7); font-weight: bold;">На правах рекламы:</p>
        <a href="https://maks-loto.top" target="_blank"><img src="https://maks-loto.top/images/46860.gif" class="img-fluid" alt="ban"></a>      </div>
    </div>
      
<?}else{?>		

<section class="mt-5">
  <div class="container">
    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
      <li class="nav-item mx-auto">
        <a class="nav-link active" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab"
          aria-controls="pills-profile" aria-selected="true">Профиль</a>
      </li>
      <li class="nav-item mx-auto">
        <a class="nav-link" id="pills-depos-tab" data-toggle="pill" href="#pills-depos" role="tab"
          aria-controls="pills-depos" aria-selected="false">Мои вклады</a>
      </li>
      <li class="nav-item mx-auto">
        <a class="nav-link" id="pills-refka-tab" data-toggle="pill" href="#pills-refka" role="tab"
          aria-controls="pills-refka" aria-selected="false">Реф.система</a>
      </li>
      <li class="nav-item mx-auto">
        <a class="nav-link" id="pills-stata-tab" data-toggle="pill" href="#pills-stata" role="tab"
          aria-controls="pills-stata" aria-selected="false">Статистика</a>
      </li>
<!--       <li class="nav-item mx-auto">
        <a class="nav-link" id="pills-ewe-tab" data-toggle="pill" href="#pills-ewe" role="tab"
          aria-controls="pills-ewe" aria-selected="false">Ещё проекты</a>
      </li> -->
      <li class="nav-item mx-auto">
        <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab"
          aria-controls="pills-contact" aria-selected="false">Контакты</a>
      </li>
    </ul>
    <div class="tab-content pt-2 pl-1 z-depth-1-half" id="pills-tabContent" style="color: #fff; background: #10517D; border-radius: 5px; padding: 20px;">
      <div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
        <span class="lk-title">Мой профиль</span>
        <div class="row">
          <div class="col-md-6 mx-auto">
            <div class="text-center">
              <p>Откройте депозит и заработайте <b>+25%</b> уже через <b>24</b> часа.<br>Мин/макс вклады <b>от 2 до 2000 руб.</b><br>Количество вкладов - <b>неограниченно</b>.</p>
              <form action="" method="post">  
                <input type="hidden" name="do" value="payeer_pay">
                <input type="hidden" name="antipovtor" value="1518687422">
                <input  required autocomplete="off" name="m_amount"  name="amount" placeholder="ВВЕДИТЕ СУММУ" size="30" type="text" value="" class="form-control w-75 my-4 mx-auto vklad-btn1">
                <input type="submit" name="submit2" id="form" value="Открыть депозит" class="vklad-btn2">
              </form>
            </div>
          </div>
          <?
          $id=$db->getOne("SELECT id FROM ss_users WHERE id=?i",$id);
          $ihr=$db->getOne("SELECT i_have_refs_as_curator FROM ss_users WHERE id=?i",$id);
          $curator=$db->getOne("SELECT curator FROM ss_users WHERE id=?i",$id);
          ?>
          <div class="col-md-6 mx-auto">
            <div class="text-center">
              <table class="table table-striped text-center table-borderless btn-table m-0">
              <tbody style="color: #fff;">
                <tr>
                  <td>Ваш PAYEER</td>
                  <td><b><?=$wallet?></b></td>
                </tr>
                <tr>
                  <td>ID в системе</td>
                  <td><b><?=$id?></b></td>
                </tr>
                <tr>
                  <td>ID пригласителя</td>
                  <td><b><?=$curator?></b></td>
                </tr>
                <tr>
                  <td>Рефералов</td>
                  <td><b><?=$ihr?></b> чел.</td>
                </tr>
                </tbody>
            </table>
            <a href="/?page=exit" class="exit">Выйти из кабинета</a>
            </div>
          </div>
        </div>
      </div>
      <div class="tab-pane fade" id="pills-depos" role="tabpanel" aria-labelledby="pills-depos-tab">
        <span class="lk-title">Мои вклады</span>
        <div class="row">
      <div class="col-md-10 mx-auto">
        <table class="table table-striped text-center table-borderless">
          <thead>
            <tr style="color: #fff;">
              <th scope="col">Дата вклада</th>
              <th scope="col">Кошелек</th>
              <th scope="col">Сумма</th>
              <th scope="col">Осталось</th>
              <th scope="col">Доход</th>
            </tr>
            
            <? 

$checkdeps=$db->getOne("SELECT id FROM `deposits` WHERE userid=?i LIMIT 1",$id);
if($checkdeps>0){
$depositsrow=$db->query("SELECT * FROM `deposits` WHERE userid=?i AND status='0' ORDER BY id DESC LIMIT 50",$id);
  
while($deposits=$db->fetch($depositsrow)){?>  
    <tr class="htt">
	<td align="center" style="font-family: 'Gubia'; color: #fff; font-size:16px"> <?=date('d.m.Y H:i',$deposits['unixtime'])?></td>
	
<?
$wallet=substr($db->getOne("SELECT wallet FROM `ss_users` WHERE id=?i",$deposits['userid']), 0, -3); 
?>	
	
	
	<td align="center" style="font-family: 'Gubia'; color: #fff; font-size:16px"> <?=$wallet?><font color="#f2dc5d">***</font></td>
      <td align="center" style="font-family: 'Gubia'; font-size:16px"><font color="#f2dc5d"><b><?=$deposits['summa']?></b> <i style="font-size:14px" class="fa fa-ruble"></i></font></td>
	
<?
$seconds = time()-$deposits['unixtime'];

if($seconds>(3600*$depperiod)){
	$deptime="В обработке";
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
	
	<td class="countdown" align="center" style="font-family: 'Gubia'; font-size:16px"><?=$deptime?></td>
      <td align="center" style="font-family: 'Gubia'; font-size:16px"><font color="#f2dc5d"><b> <?=$deposits['summa']+($deposits['summa']*($percent_u/100))?></b> <i style="font-size:14px" class="fa fa-ruble"></i></font></td>
  	</tr>
<?}}
if($checkdeps>0){
$depositsrow=$db->query("SELECT * FROM `deposits` WHERE userid=?i AND status='2' ORDER BY id DESC LIMIT 50",$id);
  
while($deposits=$db->fetch($depositsrow)){?>  
	<tr class="htt">
	<td align="center"><i style="font-size:16px" class="fa fa-clock-o" aria-hidden="true"></i> <?=date('d.m.Y H:i',$deposits['unixtime'])?></td>
	
<?
$wallet=substr($db->getOne("SELECT wallet FROM `ss_users` WHERE id=?i",$deposits['userid']), 0, -3); 
?>	
	
	
    <td align="center" style="font-family: 'Gubia'; font-size:16px"> <?=$wallet?><font color="#f2dc5d">***</font></td>
      <td align="center" style="font-family: 'Gubia'; font-size:16px"><font color="#f2dc5d"><b> <?=$deposits['summa']?></b> <i style="font-size:14px" class="fa fa-ruble"></i></font></td>
	
<?
$seconds = time()-$deposits['unixtime'];


	$deptime="Не выплачено";

?>	
	
	<td align="center" style="font-family: 'Gubia'; font-size:16px"><?=$deptime?></td>
      <td align="center" style="font-family: 'Gubia'; font-size:16px"> <b>0</b> <i style="font-size:14px" class="fa fa-ruble"></i></font></td>
  	</tr>
<?}}
if($checkdeps>0){
$depositsrow=$db->query("SELECT * FROM `deposits` WHERE userid=?i AND status='1' ORDER BY id DESC LIMIT 50",$id);
  
while($deposits=$db->fetch($depositsrow)){?>  
	<tr class="htt">
	<td align="center" style="font-family: 'Gubia'; font-size:16px"><i style="font-size:16px" class="fa fa-clock-o" aria-hidden="true"></i> <?=date('d.m.Y H:i',$deposits['unixtime'])?></td>
	
<?
$wallet=substr($db->getOne("SELECT wallet FROM `ss_users` WHERE id=?i",$deposits['userid']), 0, -3); 
?>	
	
	
	<td align="center" style="font-family: 'Gubia'; font-size:16px"> <?=$wallet?><font color="#f2dc5d">***</font></td>
      <td align="center" style="font-family: 'Gubia'; font-size:16px"><font color="#f2dc5d"><b> <?=$deposits['summa']?></b> <i style="font-size:14px" class="fa fa-ruble"></i></font></td>
		
<?
$seconds = time()-$deposits['unixtime'];


$deptime="Выплачено";

?>	
	
	<td align="center" style="font-family: 'Gubia'; font-size:16px"><?=$deptime?></td>
      <td align="center" style="font-family: 'Gubia'; font-size:16px"><font color="#f2dc5d"><b> <?=$deposits['summa']+($deposits['summa']*($percent_u/100))?></b> <i style="font-size:14px" class="fa fa-ruble"></i></font></td>
  	</tr>
<?}}
else{?> 
<center>У вас нет открытых вкладов</center>
<?}?>
          </thead>
          <tbody style="color: #fff;">
     

    
      </tbody>
     </table>
      </div>
    </div>
      </div>
      <div class="tab-pane fade" id="pills-refka" role="tabpanel" aria-labelledby="pills-refka-tab">
        <span class="lk-title">Реферальная программа</span>
        <div class="row mt-4">
  <div class="col-md-6">
    <p class="text-center">
      Дополнительным заработком в проекте является 1-уровневая партнерская программа. Приглашая новых активных участников, зарабатывайте <b>10%</b> от их вкладов. Автоматическая выплата в порядке очереди срабатывает от 1 рубля.
    </p>
  </div>
  <div class="col-md-6">
    <div class="row">
      <div class="col-md-4 text-center">
        Ссылка для приглашения:
      </div>
      <div class="col-md-8 mb-4">
        <center><input value="<?=$http_s?>://<?=$host?>/?ref=<?=$id?>" onClick="select()" size="30" type="text"></center>
      </div>
      <div class="col-md-4 text-center">
        Рекламный баннер (468x60):
      </div>
      <div class="col-md-8">
        <img src='/img/banner1.gif' class="img-fluid" alt="Responsive image"/>
      </div>
    </div>
  </div>
</div>



 
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
<div class="row text-center my-5">
  <div class="col-md-3 mb-4 mx-auto">
    <div class="ref-item z-depth-1">
      <p>Рефералов</p>
      <p style="font-size: 2rem;"><b><?=$ihr?></b></p>
    </div>
  </div>
  <div class="col-md-3 mb-4 mx-auto">
    <div class="ref-item z-depth-1">
      <p>В ожидании</p>
      <p style="font-size: 2rem;"><b><?=$refs_w?></b></p>
    </div>
  </div>
  <div class="col-md-3 mb-4 mx-auto">
    <div class="ref-item z-depth-1">
      <p>Выплачено</p>
      <p style="font-size: 2rem;"><b><?=$payed?></b></p>
    </div>
  </div>
</div>



<div class="row">
  <div class="col-md-4 mx-auto">
    <center><h3 class="main__title">Список ваших рефералов</h3></center>
  </div>
</div>

    <table class="table table-striped text-center table-borderless">
      <thead>
        <tr style="color: #fff;">
          <th scope="col">Кошелек</th>
          <th scope="col">Дата</th>
          <th scope="col">Доход</th>
        </tr>
      </thead>
      <tbody style="color: #fff;">
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
</table>
</td></tr></tbody>
</table>
      </div>
      <div class="tab-pane fade" id="pills-stata" role="tabpanel" aria-labelledby="pills-stata-tab">
        <span class="lk-title">Статистика проекта</span>
        <div class="row">
          <div class="row1">
            <p class="lk-title">10 Последних операций</p>
            <table style="color: #fff;" class="table table-striped text-center table-borderless">
      <thead>
        <tr>
          <th scope="col">Дата вклада</th>
          <th scope="col">Кошелек</th>
          <th scope="col">Депозит</th>
          <th scope="col">На вывод</th>
        </tr>
      </thead>
      <tbody>
  
  <tr class="htt">
  
  
  
  
  <? 



$iorow=$db->query("SELECT * FROM `insertoutput` ORDER BY id DESC LIMIT 10");
  
while($row=$db->fetch($iorow)){?>
<tr class="htt">
<td><i style="font-size:16px" class="fa fa-clock-o" aria-hidden="true"></i> <?=date('d.m.Y H:i',$row['unixtime'])?> </td>
<td> <?=substr($row['wallet'], 0, -3);?><font color="#f2dc5d">***</font></td>
<td><font color="#f2dc5d"><b><?=$row['summa']?></b> <i style="font-size:14px" class="fa fa-ruble"></i></font></td>
<td><font color="#f2dc5d"><? if($row['type']==0 or $row['type']==2){ echo 'Пополнение';}elseif($row['type']==1 or $row['type']==3){echo 'Выплата';}else{echo 'Реф выплата';}?></font></td>
</tr>
<?}?> 
  </tbody>
 </table>
          </div>

        </div>
      </div>
      <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
        <span class="lk-title">Контакты для связи</span>
        <div class="col-md-10 mx-auto">
        	<p class="text-center">При обращении сразу указывайте ссылку на проект о котором речь и ваш PAYEER кошелек! Время ответа до 12 часов. Пожалуйста, пишите только если у вас возникли действительно технические проблемы!</p>
        	<p class="text-center my-5" style="font-size: 20px;">E-mail: <b>azartlotoclub@yandex.ru</b></p>
        	<p class="text-center m-0"><b>Информация для рефоводов:</b></p>
        	<p class="text-center">Вы можете смело добавлять данный проект на свои ресурсы. Со своей стороны администрация гарантирует 100% выплату реферального вознаграждения моментально после вклада вашего партнёра. Таким образом вы можете быть уверены в заработке 10% от вклада каждого приглашенного вами инвестора.</p>
        </div>
      </div>
    </div>
    <div class="row my-4">
      <div class="col-md-10 mx-auto reklama">
        <p style="color: rgba(255,255,255, .7); font-weight: bold;">На правах рекламы:</p>
        <a href="https://maks-loto.top" target="_blank"><img src="https://maks-loto.top/images/46860.gif" class="img-fluid" alt="ban"></a>      </div>
    </div>
  </div>
</section>

</div></div>

      
      
      
<?}?>