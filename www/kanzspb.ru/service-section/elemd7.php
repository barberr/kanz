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
   	Bitrix\Sale\DiscountCouponsManager,
	Bitrix\Sale;

\Bitrix\Main\Loader::includeModule('iblock');
\Bitrix\Main\Loader::includeModule('order');

Loader::includeModule('sale');
Loader::includeModule('catalog');
CUtil::JSPostUnescape();


//if (!check_bitrix_sessid() || $_SERVER["REQUEST_METHOD"] != "POST") return;
//************************************************************************************************
$orderId = 1;
$elementId = 29157;
//$order = Sale\Order::load($orderId);
//print_r($order->getPropertyCollection());

//$element = \Bitrix\Iblock\Elements\ElementKatalogTable::getByPrimary($elementId, [
//    'select' => ['ID', 'NAME', 'DETAIL_TEXT', 'DETAIL_PICTURE', 'CML2_ARTICLE_' => 'CML2_ARTICLE'],
//])->fetch();
//print_r($element[CML2_ARTICLE_VALUE] );

//$arFilter = array('IBLOCK_ID' => 1, "CODE"=>"CML2_BAR_CODE");
//print_r($arFilter);
//$property_enums = CIBlockPropertyEnum::GetList(
//	array(), 
//	$arFilter);
////print_r($property_enums);
//while($enum_fields = $property_enums->GetNext())
//{
//  print_r($enum_fields ."<br>");
//}

//$arFilter = array(
//    'IBLOCK_ID' => 1,
//    'CODE'=>'FILES',
//);
//$arFile["MODULE_ID"] = "iblock";
//$arFile["del"] = "Y";
//echo 'PROPERTY_VALUE_ID - VALUE - CODE </br>';
//$res = CIBlockElement::GetProperty(1,$elementId);
//while ($ob = $res->GetNext())
//{
////	if($ob[CODE] == "IMAGES"){
//////		print_r($ob);
////		print_r($ob["PROPERTY_VALUE_ID"] . ' - ' . $ob["VALUE"] . ' - ' . $ob[CODE]);
////		
////		echo '<script>';
////		echo 'console.log(' . $ob[PROPERTY_VALUE_ID] . ');';
////		echo '</script>';
////		
////		echo '</br>';	
//////		CIBlockElement::SetPropertyValueCode($elementId, $ob[CODE], array ($ob[PROPERTY_VALUE_ID] => array("VALUE"=>$arFile) ) );
////	}
//    
//}
//********************************** ВЫВОД ВСЕХ СВОЙСТВ ЭЛЕМЕНТА ********************************************
//$dbEl = CIBlockElement::GetList(Array(), Array("IBLOCK_TYPE"=>"catalog", "IBLOCK_ID"=>1, "ID"=>31275));
//    if($obEl = $dbEl->GetNextElement())
//    {   
//        $props = $obEl->GetProperties();
//        echo "<pre>";
//        print_r($props);
//        echo "</pre>";
//	}
//***********************************************************************************************************
$dbEl = CIBlockElement::GetList(Array(), Array("IBLOCK_TYPE"=>"catalog", "IBLOCK_ID"=>1, "ID"=>$elementId));
$cc = new cURL();
$cc->content = $cc->post("https://api-sale.relef.ru/api/v1/products/list", 
	"{\"filter\":{\"sections\":[\"2b0ff3e7-dacd-11ea-80c2-30e1715c5317\"]},\"limit\":5000,\"offset\":0}");
	$result1 = json_decode($cc->content,true);
	echo '<pre>!!!' .  $result1["list"][1]["prices"][0]["value"];
			print_r($result1);
	echo '</pre>';
foreach($result1["list"] as $key=>$value)
	{	
	if($value["availability"])
		{	
			if ($key == 1){
				$id = kanzCatalog::addElement($value);
				if (!$id)
					echo "Ошибка добавления элемента - " . $value["name"] . "<br>";
			}
//			$arSelect = Array("ID", "NAME", "PREVIEW_PICTURE");
//			$arFilter = Array("IBLOCK_ID"=>1,  "ID"=>$id);
//			$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), $arSelect);
//			while($ob = $res->GetNextElement())
//			{
//			 $arFields = $ob->GetFields();
//			 print_r($arFields);
//			}
		
//			echo '<pre>!!!';
//			print_r($value);
//			echo '</pre>';
			//if (!kanzCatalog::addSection($result1["list"][$i]))
		}
			
	}
    if($obEl = $dbEl->GetNextElement())
    {   
//		print_r($obEl->fields[ID]);
		$arProperties = $obEl->GetProperties();
		

    if (!empty($arProperties)) {
		
		
        /**
         * Собираем файлы для удаления в массив,
         * группируя по свойствам
         */
        foreach ($arProperties as $sPropCode => $arPropValues) {
			if ($sPropCode == 'CML2_ATTRIBUTES')
			{
				print_r($sPropCode . ' -- ' . $arPropValues['VALUE']);
				echo '</br>';
				print_r($arProperties[CML2_ATTRIBUTES]);
				echo '</br>';
				$PR_VALUE_NOTE['UF_NOTE_USER'][] = array("VALUE" => array ("TEXT" => "Вася привет!", "TYPE" => "text"));
				print_r($PR_VALUE_NOTE);
				echo '</br>';
            /**
             * $sPropCode - ключ код свойства, в котором мы ищем удаляемый файл без PROPERTY_ и _VALUE, например PHOTO
             * $arPropValues - PROPERTY_VALUE_ID удаляемого файла
             * $arFiles["FILE_DELETE"] - массив, содержащий ID удаляемых файлов всех свойств
             * $sValue - искомое значение ID
             */
			
				
			
				foreach ($arPropValues['VALUE'] as $iKeyValue => $sValue) {
//					$arCreateList[$sPropCode][$arPropValues['PROPERTY_VALUE_ID'][$iKeyValue]] = [
//							'VALUE' => [
//							$iKeyValue => '1234',
//							
//							]
//						];
					$arCreateList[$sPropCode][] = [
							'VALUE' =>  'dfgdfg123',
							'DESCRIPTION' => '1234fskjgslfkgj',
						];
					print_r($iKeyValue . ' - ' . $sValue . ' - ' . $arPropValues['VALUE']); 
//					print_r($iKeyValue . ' - ' . $sValue . ' - ' . $arPropValues['PROPERTY_VALUE_ID'][$iKeyValue] . ' - ' . $arDeleteList[$sPropCode][$arPropValues['PROPERTY_VALUE_ID'][$iKeyValue]['VALUE']['del']]);
					echo '</br>';
//					if (in_array($sValue, $arFiles["FILE_DELETE"]) && $arPropValues['PROPERTY_VALUE_ID'][$iKeyValue] > 0) {
//						$arDeleteList[$sPropCode][$arPropValues['PROPERTY_VALUE_ID'][$iKeyValue]] = [
//							'VALUE' => [
//								'del' => 'Y',
//							]
//						];
//					}
					
				}
				print_r($arCreateList);
				
            }
        }
        /**
         * Если массив для удаления файлов не пустой
         * производим удаление
         */
        if (!empty($arCreateList)) {
			echo 'Не пустой </br>'. $elementId;
//            foreach ($arDeleteList as $sPropForDelete => $arDeleteFiles) {
//				print_r($sPropForDelete . ' - ' . $arDeleteFiles . '</br>');
//				print_r($arDeleteFiles);
//				echo '</br>';
//				print_r($arDeleteFiles);
//				echo '</br>';
                CIBlockElement::SetPropertyValues(
                    $elementId,
					1,
					$arCreateList,
                    false                    
                );
            
        }
    }
	}
//*******************************************************************************************************
//Удаление картинок из свойства IMAGE

//$dbEl = CIBlockElement::GetList(Array(), Array("IBLOCK_TYPE"=>"catalog", "IBLOCK_ID"=>1, "ID"=>$elementId));
//    if($obEl = $dbEl->GetNextElement())
//    {   
////		print_r($obEl->fields[ID]);
//		$arProperties = $obEl->GetProperties();
//		
//
//    if (!empty($arProperties)) {
//		
//		
//        /**
//         * Собираем файлы для удаления в массив,
//         * группируя по свойствам
//         */
//        foreach ($arProperties as $sPropCode => $arPropValues) {
////			if ($sPropCode == 'IMAGES')
//			{
//				print_r($sPropCode . ' -- ' . $arPropValues['VALUE']);
//				echo '</br>';
//				print_r($arProperties);
//				echo '</br>';
//            /**
//             * $sPropCode - ключ код свойства, в котором мы ищем удаляемый файл без PROPERTY_ и _VALUE, например PHOTO
//             * $arPropValues - PROPERTY_VALUE_ID удаляемого файла
//             * $arFiles["FILE_DELETE"] - массив, содержащий ID удаляемых файлов всех свойств
//             * $sValue - искомое значение ID
//             */
//			
//				
//			
//				foreach ($arPropValues['VALUE'] as $iKeyValue => $sValue) {
//					$arDeleteList[$sPropCode][$arPropValues['PROPERTY_VALUE_ID'][$iKeyValue]] = [
//							'VALUE' => [
//							'MODULE_ID' => 'iblock',
//							'del' => 'Y',
//							]
//						];
//					print_r($iKeyValue . ' - ' . $sValue . ' - ' . $arPropValues['PROPERTY_VALUE_ID'][$iKeyValue] . ' - ' . $arDeleteList[$sPropCode][$arPropValues['PROPERTY_VALUE_ID'][$iKeyValue]['VALUE']['del']]);
//					echo '</br>';
//					if (in_array($sValue, $arFiles["FILE_DELETE"]) && $arPropValues['PROPERTY_VALUE_ID'][$iKeyValue] > 0) {
//						$arDeleteList[$sPropCode][$arPropValues['PROPERTY_VALUE_ID'][$iKeyValue]] = [
//							'VALUE' => [
//								'del' => 'Y',
//							]
//						];
//					}
//				}
//            }
//        }
//        /**
//         * Если массив для удаления файлов не пустой
//         * производим удаление
//         */
//        if (!empty($arDeleteList)) {
//			echo 'Не пустой </br>';
//            foreach ($arDeleteList as $sPropForDelete => $arDeleteFiles) {
//				print_r($sPropForDelete . ' - ' . $arDeleteFiles . '</br>');
//				print_r($arDeleteFiles);
//				echo '</br>';
//				print_r($arDeleteFiles);
//				echo '</br>';
//                CIBlockElement::SetPropertyValues(
//                    $elementId,
//					1,
//					$arDeleteFiles,
//                    $sPropForDelete
//                    
//                );
//            }
//        }
//    }
//	}

//*********************************************************************************************************

//$VALUES = array();
//    $res = CIBlockElement::GetProperty(IKSO_CUSTOM::$IBLOCKS['brands'], $BRAND_ID, "sort", "asc", array("CODE" => "BRAND_CLASS"));
//    while ($ob = $res->GetNext())
//    {
//        $VALUES[] = $ob['VALUE'];
//    }


//$maps = \Bitrix\Iblock\Elements\ElementKatalogTable::getTableName();
//print_r($maps);
//$elements = \Bitrix\Iblock\Elements\ElementKatalogTable::getList([
//    'select' => ['ID', 'NAME', 'IBLOCK_SECTION_ID', 'XML_ID'],
//    'filter' => ['=XML_ID' => '8d11d719-4d58-11e5-8c60-e4115bd714a8'],
//])->fetchAll();
//foreach ($elements as $element) {
////    print_r($element[NAME].' - '. $element[IBLOCK_SECTION_ID]);
//	print_r($element);
//	echo '</br>';
//}




?>