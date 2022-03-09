<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Получение списка разделов классификатора");
$APPLICATION->SetTitle("list");
?>

<?

	$APPLICATION->IncludeComponent("cURL:phpcurl.kanz", "template2", Array(
	"COMPONENT_TEMPLATE" => "template1",
		"TEMPLATE_FOR_DATE" => "Y-m-d",	// Шаблон для даты
	),
	false
);
?>
