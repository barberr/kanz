<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Получение списка товаров API Post");
$APPLICATION->SetTitle("Получение списка товаров API Post");
?>
<?$APPLICATION->IncludeComponent(
	"cURL:APIPostProdacts.kanz", 
	"template", 
	array(
		"COMPONENT_TEMPLATE" => "template",
		"TEMPLATE_FOR_DATE" => "m-d-Y"
	),
	false
);?>