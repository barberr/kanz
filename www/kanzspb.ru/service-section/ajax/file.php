<?
define("STOP_STATISTICS", true);
if (array_key_exists('site_id', $_REQUEST) && is_string($_REQUEST['site_id'])){
   $siteId = $_REQUEST['site_id'];
   if($siteId !== '' && preg_match('/^[a-z0-9_]{2}$/i', $siteId) === 1){
      define('SITE_ID', $siteId);
   }
}

require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

//подключаем нужные модули
use Bitrix\Main\Loader,
   Bitrix\Main\Application,
   Bitrix\Currency,
   Bitrix\Sale\DiscountCouponsManager;

Loader::includeModule('iblock');
Loader::includeModule('sale');
Loader::includeModule('catalog');
CUtil::JSPostUnescape();

if (!check_bitrix_sessid() || $_SERVER["REQUEST_METHOD"] != "POST") return;

//$arRes = array(
//	'res'  = $_POST["guid"],
//);
if (isset($_POST["action"]) && $_POST["action"] == 'count'){
	$result123 = array(
		'update_sec' => $_POST["guid"],
		'count_el' => kanzCatalog::ColElemFromSections($_POST["guid"]),
	);
	
//	if($result123['count_el'] < 2) {
//		$result123['text'] = kanzCatalog::AddElemToSections($_POST["guid"]);
//		
//	}
	$APPLICATION->RestartBuffer();
	header('Content-Type: application/json; charset='.LANG_CHARSET);   
	//echo CUtil::PhpToJSObject($arRes);
	echo CUtil::PhpToJSObject($result123);
	die();
}

if (isset($_POST["action"]) && $_POST["action"] == 'recurs'){
	$result123 = array(
		'update_sec' => $_POST["guid"],
//		'offset' => 'rere!@#',
//		'offset' => kanzCatalog::AddElemToSectionsRecur($_POST["guid"],20,$_POST["offSet"]),
		'notupdate' => kanzCatalog::AddElemToSectionsRecur($_POST["guid"],20,$_POST["offSet"]),
	);
	$APPLICATION->RestartBuffer();
	header('Content-Type: application/json; charset='.LANG_CHARSET);   
	//echo CUtil::PhpToJSObject($arRes);
	echo CUtil::PhpToJSObject($result123);
	die();
}

if (isset($_POST["action"]) && $_POST["action"] == 'add'){
	$result123 = array(
		'update_sec' => $_POST["guid"],
		'text' => kanzCatalog::AddElemToSections($_POST["guid"]),
	);
	$APPLICATION->RestartBuffer();
	header('Content-Type: application/json; charset='.LANG_CHARSET);   
	//echo CUtil::PhpToJSObject($arRes);
	echo CUtil::PhpToJSObject($result123);
	die();
}
//alert($_POST["guid"]);
 
//		$arRes['res']  = kanzCatalog::AddElemToSections($_POST["guid"]);
//		$arRes['res']  = kanzCatalog::ColElemFromSections($_POST["guid"]);
//		echo 'Данные приняты - ' . $_POST['guid'];
      //здесь можно использовать функции и классы модуля

//if (isset($_POST["action"]) && strlen($_POST["action"]) > 0){
//   $arRes['res']  = kanzCatalog::AddElemToSections($_POST["guid"]);
////	$arRes['res']  = $_POST["guid"];
//}

?>