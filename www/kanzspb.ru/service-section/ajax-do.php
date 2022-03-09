<?
//if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
	
	 
$_SERVER["DOCUMENT_ROOT"] = "/var/www/u1206408/data/www/kanzspb.ru";
$DOCUMENT_ROOT = $_SERVER["DOCUMENT_ROOT"];

define("NO_KEEP_STATISTIC", true);
define("NOT_CHECK_PERMISSIONS", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

//print_r($_SERVER);
set_time_limit(0);
//echo 'Данные приняты - ' . $_POST['guid'];
if(CModule::IncludeModule("iblock"))
   { 
		$result = kanzCatalog::AddElemToSections($_POST['guid']);
//		echo 'Данные приняты - ' . $_POST['guid'];
      //здесь можно использовать функции и классы модуля
   } 
   
//CModule::IncludeModule('iblock');
//\Bitrix\Main\Loader::includeModule('CModule'); 
//CModule::AddAutoloadClasses(
//        '', // не указываем имя модуля
//        array(
//           // ключ - имя класса, значение - путь относительно корня сайта к файлу с классом
//                'kanzCatalog' => '/local/php_interface/lib/kanzCatalog/kanzCatalog_class.php',
//               
//        )
//);


//$result = kanzCatalog::GuidToId($_POST['guid']);
//$rno = $_POST['id'];

//$con = mysql_connect("localhost","root","");
//$db= mysql_select_db("school", $con);
//$sql = "SELECT address from students where name='".$name."' AND rno=".$rno;
//$result = mysql_query($sql,$con);
//$row=mysql_fetch_array($result);
echo $result;
?>

