<? 
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
    $APPLICATION->SetTitle("API Bitrix");
    CModule::IncludeModule("iblock");
	
$arElement["ID"] = 4125; // PRODUCT_ID
$price = 555;
$currency = 'RUB';
$catalogGroupId = 1; // Тип цены

cURL::parsXML1c();

//$arFieldsPrice = [
//    "PRODUCT_ID" => $arElement["ID"],
//    "CATALOG_GROUP_ID" => $catalogGroupId,
//    "PRICE" => $price,
//    "CURRENCY" => !$currency ? "RUB" : $currency,
//];
//
//$dbPrice = \Bitrix\Catalog\Model\Price::getList([
//    "filter" => [
//        "PRODUCT_ID" => $arElement["ID"],
//        "CATALOG_GROUP_ID" => $catalogGroupId
//    ]
//]);
//
//
//if ($arPrice = $dbPrice->fetch()) {
//    $result = \Bitrix\Catalog\Model\Price::update($arPrice["ID"], $arFieldsPrice);
//    if ($result->isSuccess()) {
//        echo "Обновили цену у товара у элемента каталога " . $arElement["ID"] . " Цена " . $price . PHP_EOL;
//    } else {
//        echo "Ошибка обновления цены у товара у элемента каталога " . $arElement["ID"] . " Ошибка " . implode('<br>',
//                $result->getErrorMessages()) . PHP_EOL;
//    }
//} else {
//    $result = \Bitrix\Catalog\Model\Price::add($arFieldsPrice);
//    if ($result->isSuccess()) {
//        echo "Добавили цену у товара у элемента каталога " . $arElement["ID"] . " Цена " . $price . PHP_EOL;
//    } else {
//        echo "Ошибка добавления цены у товара у элемента каталога " . $arElement["ID"] . " Ошибка " . implode('<br>',
//                $result->getErrorMessages()) . PHP_EOL;
//    }
//}



require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php"); 
?>



