<?


/* ВКЛЮЧАЕМ КЕШИРОВАНИЕ */
header("Cache-control: public");

header("Expires: " . gmdate("D, d M Y H:i:s", time() + 60*60*24*30) . " GMT");



if(!defined('SKYLIGHT')){
echo ('Выявлена попытка взлома!');
exit();
}

$page='main';$id=NULL;$login=NULL;$notpl=0;$alttpl=0;$itsmain=0;$nohead=0;$nofoot=0;$alttpl=0;$copyright='Sirgoffan';$tarif=2;

/* ПОДКЛЮЧАЕМ КЛАСС РАБОТЫ С БД */
require_once(SKYLIGHT.'/core/classes/safemysql.php');

/* ПОДКЛЮЧАЕМ ФАЙЛ НАСТРОЕК */
require_once(SKYLIGHT.'/core/config.php');

		if (($_SERVER['HTTP_X_FORWARDED_PROTO']=='http') and $http_s == 'https' ) {
           $redirect_url = "https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
           header("Location: $redirect_url");
           exit();
       }
	   
$arrayconst=get_defined_constants(true);
$host=$_SERVER["HTTP_HOST"]; 


/* ПОДКЛЮЧАЕМ ФУНКЦИИ */
require_once(SKYLIGHT."/core/functions.php");
/* ПОДКЛЮЧАЕМ */
require_once(SKYLIGHT.'/core/defines.php');
/* ПОДКЛЮЧАЕМ ФАЙЛЫ КЕША */
require_once(SKYLIGHT.'/core/cache.php');
/* ПОДКЛЮЧАЕМ ОБРАБОТЧИК */
require_once(SKYLIGHT.'/core/handler.php');

?>