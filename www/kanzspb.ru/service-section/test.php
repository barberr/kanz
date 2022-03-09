<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Получение списка товаров API Post");
$APPLICATION->SetTitle("Тестовая страница");

//	$APPLICATION->AddHeadScript('/local/js/scrips.js');
?>
<?
echo SITE_TEMPLATE_PATH. '/js/scripts.js';
//
	$APPLICATION->IncludeComponent("cURL:APITest.kanz", "template1", Array(
	"COMPONENT_TEMPLATE" => ".default",
		"TEMPLATE_FOR_DATE" => "m-d-Y",	// Шаблон для даты
	),
	false
);
?>