<?php
use \Bitrix\Iblock;


if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

class kanzCatalog {
	
	function changePrice($elId,$price) {
		
	 	// PRODUCT_ID
		//		$price = 555;
		$currency = 'RUB';
		$priceGroupId = 1; // Тип цены

		$arFieldsPrice = [
			"PRODUCT_ID" => $elId,
			"CATALOG_GROUP_ID" => $priceGroupId,
			"PRICE" => $price,
			"CURRENCY" => !$currency ? "RUB" : $currency,
		];
//		echo '<pre>';
//		print_r($arFieldsPrice);
//		echo '</pre>';

		$dbPrice = \Bitrix\Catalog\Model\Price::getList([
			"filter" => [
				"PRODUCT_ID" => $elId,
				"CATALOG_GROUP_ID" => $priceGroupId
			]
		]);


		if ($arPrice = $dbPrice->fetch()) {
			$result = \Bitrix\Catalog\Model\Price::update($arPrice["ID"], $arFieldsPrice);
			if ($result->isSuccess()) {
				echo "Обновили цену у товара у элемента каталога " . $elId . " Цена " . $price . PHP_EOL;
					} else {
						echo "Ошибка обновления цены у товара у элемента каталога " . $elId . " Ошибка " . implode('<br>',
								$result->getErrorMessages()) . PHP_EOL;
					}
				} else {
					$result = \Bitrix\Catalog\Model\Price::add($arFieldsPrice);
					if ($result->isSuccess()) {
						echo "Добавили цену у товара у элемента каталога " .  $elId . " Цена " . $price . PHP_EOL;
					} else {
						echo "Ошибка добавления цены товара у элемента каталога " .  $elId . " Ошибка!!! "; //. //implode('<br>',$result->getErrorMessages()) . PHP_EOL;
						echo '</br>' . $result->getErrorMessages();
					}
				}
	}
	
	function addImage($Id,$imageLink){
		
		$arIMAGE = CFile::MakeFileArray($imageLink);
		$fid = CFile::SaveFile($arIMAGE, "vote");
//		print_r($fid);
//		echo " - ";
//		print_r($arIMAGE);
//		echo " </br> ";
		return $arIMAGE;
		
	}
	
	function addImageArray($imageLink){
		
		$arIMAGE = CFile::MakeFileArray($imageLink);
		$fid = CFile::SaveFile($arIMAGE, "vote");
//		print_r($fid);
//		echo " - ";
//		print_r($arIMAGE);
//		echo " </br> ";
		return $arIMAGE;
		
	}
	
	
	function GuidToId($guid){
		
		$arFilter = array('IBLOCK_ID' => 1, '=XML_ID' => $guid);
		$iterator = \CIBlockSection::GetList(
					array(),
					$arFilter,
					
					array("ID"),
					);
		$el = $iterator->GetNext();
		
		if($el) return $el["ID"];
			else return 3;
		
	}
	
	function GuidToIdActive($guid){
		
		$arFilter = array('IBLOCK_ID' => 1, '=XML_ID' => $guid);
		$iterator = \CIBlockSection::GetList(
					array(),
					$arFilter,
					array("ID","ACTIVE","NAME"),
					);
		$el = $iterator->GetNext();
		
		if($el) {
			if($el["ACTIVE"] == Y)
				return $el;
		}
			else return 0;
		
	}
	
	function AddElemToSections($guid){
		
		$cc = new cURL();
//		$cc->content = $cc->get("https://api-sale.relef.ru/api/v1/sections/".$guid."/list" );
		$cc->content = $cc->post("https://api-sale.relef.ru/api/v1/products/list", 
//								 "{\"limit\":1,\"offset\":0}");
		"{\"filter\":{\"sections\":[\"".$guid."\"]},\"limit\":1,\"offset\":0}");
		$result1 = json_decode($cc->content,true);
//		echo '<pre>';
//			print_r($cc);
//		echo '</pre>';
		$count = $result1["count"];
//		$count = 4999;
		for ($i = 0; $i <= intdiv($count, 5000); $i++)
		{	
//			echo $i+1 . "</br>";
			$offset = $i * 5000;
			$cc->content = $cc->post("https://api-sale.relef.ru/api/v1/products/list", 
				"{\"filter\":{\"sections\":[\"".$guid."\"]},\"limit\":5000,\"offset\":".$offset."}");
			
			$result1 = json_decode($cc->content,true);
//			echo '<pre>';
//			print_r($result1);
//			echo '</pre>';
			foreach($result1["list"] as $key=>$value)
				{
//				echo $value . '</br>';
				$id = kanzCatalog::addElement($value);
				if (!$id)
					echo "Ошибка добавления элемента - " . $value["name"] . "<br>";
				
				}
			
		}
	return "YEs";
		
	}
	
	function AddElemToSectionsRecur($guid,$limit,$offSet){
//		echo '<pre>';
//		print_r($guid);
//		echo '</pre>';
//		echo '<pre>';
//		print_r($offSet);
//		echo '</pre>';
//		echo '<pre>';
//		print_r($limit);
//		echo '</pre>';
		
		$cc = new cURL();
//		$cc->content = $cc->get("https://api-sale.relef.ru/api/v1/sections/".$guid."/list" );
		$cc->content = $cc->post("https://api-sale.relef.ru/api/v1/products/list", 
//								 "{\"limit\":1,\"offset\":0}");
		"{\"filter\":{\"sections\":[\"".$guid."\"]},\"limit\":".$limit.",\"offset\":".$offSet."}");
		$result1 = json_decode($cc->content,true);
		
//		echo  "<script>console.log('Debug Objects: " . $cc . "' );</script>";
		$col = 0;
		
		foreach($result1["list"] as $key=>$value)
				{
//				echo $value . '</br>';
				$id = kanzCatalog::addElement($value);
				if($id == 1)
					$col ++;
//				if (!$id)
//					echo "Ошибка добавления элемента - " . $value["name"] . "<br>";
				
				}
		
		return $col;
			
////		echo '<pre>';
////			print_r($cc);
////		echo '</pre>';
//		$count = $result1["count"];
////		$count = 4999;
//		for ($i = 0; $i <= intdiv($count, 5000); $i++)
//		{	
//			echo $i+1 . "</br>";
//			$offset = $i * 5000;
//			$cc->content = $cc->post("https://api-sale.relef.ru/api/v1/products/list", 
//				"{\"filter\":{\"sections\":[\"".$guid."\"]},\"limit\":5000,\"offset\":".$offset."}");
//			
//			$result1 = json_decode($cc->content,true);
////			echo '<pre>';
////			print_r($result1);
////			echo '</pre>';
//			foreach($result1["list"] as $key=>$value)
//				{
//				echo $value . '</br>';
//				$id = kanzCatalog::addElement($value);
//				if (!$id)
//					echo "Ошибка добавления элемента - " . $value["name"] . "<br>";
//				
//				}
//			
//		}
//	return "YEs";
//		
	}
	
	function ColElemFromSections($guid){
		
		$cc = new cURL();
//		$cc->content = $cc->get("https://api-sale.relef.ru/api/v1/sections/".$guid."/list" );
		$cc->content = $cc->post("https://api-sale.relef.ru/api/v1/products/list", 
//								 "{\"limit\":1,\"offset\":0}");
		"{\"filter\":{\"sections\":[\"".$guid."\"]},\"limit\":1,\"offset\":0}");
		$result1 = json_decode($cc->content,true);
		return $result1["count"];
		
	}	
	
	function RootCategory($SectionID){
		$NacPrice = 1;
		$list = CIBlockSection::GetNavChain(false,$SectionID, array(), true);
		foreach ($list as $arSectionPath){
			if ($arSectionPath['DEPTH_LEVEL'] == 2){
				switch ($arSectionPath['NAME']){
					case "Письменные товары, черчение":
						$NacPrice = 1.5;	
						break;
					case "Бумажная продукция для офиса":
						$NacPrice = 1.5;	
						break;
					case "Офисные принадлежности":
						$NacPrice = 1.5;	
						break;
					case "Папки, системы архивации":
						$NacPrice = 1.5;	
						break;
					case "Бумажная продукция для офиса":
						$NacPrice = 1.5;	
						break;
					case "Новый год":
						$NacPrice = 1.6;	
						break;
					case "Бумажная продукция для школы":
						$NacPrice = 1.5;	
						break;
					case "Товары для учебы":
						$NacPrice = 1.55;	
						break;
					case "Подарки, сувениры, награды":
						$NacPrice = 1.6;	
						break;
					case "Творчество, хобби":
						$NacPrice = 1.5;	
						break;
					case "Товары для художников":
						$NacPrice = 1.4;	
						break;
					case "Хозтовары, упаковка":
						$NacPrice = 1.5;	
						break;
					case "Бумага для офисной техники":
						$NacPrice = 1.4;	
						break;
					case "ГАММА. Художественный ассортимент":
						$NacPrice = 1.4;	
						break;
					
				}
							
				return $NacPrice;
//				echo '</pre>';
			}
		}
		
	}
	
	function GuidToIdElem($guid){
		
		$arFilter = array('IBLOCK_ID' => 1, '=XML_ID' => $guid);
		$iterator = \CIBlockElement::GetList(
					array(),
					$arFilter,
					
					array("ID"),
					);
		$el = $iterator->GetNext();
		
		if($el) return $el["ID"];
			else return 0;
		
	}
	
	function addSection($IdAPI,$sort){
		
		$arFilter = array('IBLOCK_ID' => 1, '=XML_ID' => $IdAPI["guid"]);
		$iterator = \CIBlockSection::GetList(
					array(),
					$arFilter,
					
					array("ID"),
					);
		$bs = new CIBlockSection;	
		
		if ($el = $iterator->GetNext()){//если категория есть, то ОБНОВЛЯЕМ
			echo '<pre>';
			print_r($el["NAME"]);
			echo '</pre>';
			
			$arFields = Array(
				  //"ACTIVE" => Y,
				  "IBLOCK_ID" => 1,
				  "NAME" => $IdAPI["name"],
				  "XML_ID" => $IdAPI["guid"],
				  "IBLOCK_SECTION_ID" => kanzCatalog::GuidToId($IdAPI["parentGuid"]),
				  "SORT" => $sort,
				  //"PICTURE" => $_FILES["PICTURE"],
				  "DESCRIPTION" => $IdAPI["description"],
				  //"DESCRIPTION_TYPE" => $DESCRIPTION_TYPE
				  array(
                        "PICTURE" => kanzCatalog::addImage(1,$IdAPI["image"]),
					  	"MODULE_ID" => "iblock",
                        )
				  );
			$result = $bs->Update(
                        $el["ID"],
                        $arFields,
                    );
		}else{//если категории нет, то СОЗДАЕМ
			
			$arFields = Array(
					  "ACTIVE" => Y,
					  "IBLOCK_SECTION_ID" => kanzCatalog::GuidToId($IdAPI["parentGuid"]),
					  "IBLOCK_ID" => 1,
					  "NAME" => $IdAPI["name"],
					  "XML_ID" => $IdAPI["guid"],
					  "SORT" => $sort,
					  //"PICTURE" => $_FILES["PICTURE"],
					  "DESCRIPTION" => $value["description"],
					  //"DESCRIPTION_TYPE" => $DESCRIPTION_TYPE
					  array(
							"PICTURE" => kanzCatalog::addImage(1,$IdAPI["image"]),
							"MODULE_ID" => "iblock",
							)
					  );
	
	
					  $ID = $bs->Add($arFields);
					  $result = ($ID>0);
	
	
			if(!$result) echo $bs->LAST_ERROR;
		}
		
		
		
			echo '<pre>';
			print_r($result);
			echo '112233';
			echo '</pre>';
		

		return $result;
		
	}
	
	function addSection1($IdAPI,$sort){
		echo '1234567';
		$arFilter = array('IBLOCK_ID' => 1, '=XML_ID' => $IdAPI["guid"]);
		$iterator = \CIBlockSection::GetList(
					array(),
					$arFilter,
					
					array("ID"),
					);
		$bs = new CIBlockSection;	
		
		if ($el = $iterator->GetNext()){//если категория есть, то ОБНОВЛЯЕМ
			echo '<pre>';
			print_r($el["NAME"]);
			echo '</pre>';
			
			$arFields = Array(
				  //"ACTIVE" => Y,
				  "IBLOCK_ID" => 1,
				  "NAME" => $IdAPI["name"],
				  "XML_ID" => $IdAPI["guid"],
				  "IBLOCK_SECTION_ID" => kanzCatalog::GuidToId($IdAPI["parentGuid"]),
				  "SORT" => $sort,
				  //"PICTURE" => $_FILES["PICTURE"],
				  "DESCRIPTION" => $IdAPI["description"],
				  //"DESCRIPTION_TYPE" => $DESCRIPTION_TYPE
				  array(
                        "PICTURE" => kanzCatalog::addImage(1,$IdAPI["image"]),
					  	"MODULE_ID" => "iblock",
                        )
				  );
//			$result = $bs->Update(
//                        $el["ID"],
//                        $arFields,
//                    );
		}else{//если категории нет, то СОЗДАЕМ
			
			$arFields = Array(
					  "ACTIVE" => Y,
					  "IBLOCK_SECTION_ID" => kanzCatalog::GuidToId($IdAPI["parentGuid"]),
					  "IBLOCK_ID" => 1,
					  "NAME" => $IdAPI["name"],
					  "XML_ID" => $IdAPI["guid"],
					  "SORT" => $sort,
					  //"PICTURE" => $_FILES["PICTURE"],
					  "DESCRIPTION" => $value["description"],
					  //"DESCRIPTION_TYPE" => $DESCRIPTION_TYPE
					  array(
							"PICTURE" => kanzCatalog::addImage(1,$IdAPI["image"]),
							"MODULE_ID" => "iblock",
							)
					  );
	
	
//					  $ID = $bs->Add($arFields);
//					  $result = ($ID>0);
	
	
			if(!$result) echo $bs->LAST_ERROR;
		}
		
		
		
//			echo '<pre>';
//			print_r($result);
//			echo '</pre>';
//		
//
//		return $result;
		
	}
	
	function addQuantity($elem,$iOstatok){
	//	ДОБАВЛЕНИЕ КОЛИЧЕСТВА В ТОРГОВЫЙ КАТАЛОГ
		Cmodule::IncludeModule('catalog');
		$existProduct = \Bitrix\Catalog\Model\Product::getCacheItem($elem,true);
		if(!empty($existProduct)){
			$arFields = array("QUANTITY" => $iOstatok);
			\Bitrix\Catalog\Model\Product::update($elem, $arFields);
			echo 'Обновили!!!!! </br>';
			} else {
			$arFields = array(
				"ID"		=> $elem,
				"QUANTITY"	=> $iOstatok);
			 \Bitrix\Catalog\Model\Product::add($arFields);
			echo 'Создали!!!!! </br>';
			}
//		if($existProduct = \Bitrix\Catalog\Model\Product::getCacheItem($elem,true))
//			echo('Est tovar');
//		else echo 'No Tovar!!!!! </br>';
//		$arFields = array("QUANTITY" => $iOstatok);
//		if(print_r(CCatalogProduct::Update($elem, $arFields)))
//		{
//			echo 'Обновили!!!!! </br>';
//			echo '<pre>';
//			print_r($arFields);
//			echo '</pre>';
//		}
//			
//		else echo 'Не Обновили!!!!! </br>';
		
	}
	
	function addSectionFromAPI($IdAPI){
		$OutSections = array();
		$k = 0;
		foreach($IdAPI["sections"] as $key=>$value){
//			echo $value . '</br>';	
			$OutSections[$k] = kanzCatalog::GuidToId($value);
			$k++;
		}
		return $OutSections;
	}
	
	function ImageArrayFromAPI($IdAPI){
		$OutImageArray = array();
		$k = 0;
		foreach($IdAPI["images"] as $key=>$value){
//			echo $value . '</br>';	
			$OutImageArray[$k] = kanzCatalog::addImageArray($value["path"]);
			$k++;
		}
		return $OutImageArray;
	}
	
	function delElementImages($IdAPI){//Удаление всех картинок свойства IMAGES элемента
		

		$dbEl = CIBlockElement::GetList(
			Array(), 
			Array("IBLOCK_TYPE"=>"catalog", "IBLOCK_ID"=>1, '=XML_ID' => $IdAPI["guid"]),
			false, 
        	false, 
        	array("ID" , "IBLOCK_ID",)
		);
    	if($obEl = $dbEl->GetNextElement()){
//					print_r($obEl->fields);
//		Если элемента не было, то пропускаем
//		if ($elem = $iterator->GetNext()){
			$arProperties = $obEl->GetProperties();
			if (!empty($arProperties)) {
				foreach ($arProperties as $sPropCode => $arPropValues) {
//					print_r($sPropCode . ' - ' . $arPropValues['VALUE']);
//				echo '</br>';
				if ($sPropCode == 'IMAGES'){
					foreach ($arPropValues['VALUE'] as $iKeyValue => $sValue) {
						$arDeleteList[$sPropCode][$arPropValues['PROPERTY_VALUE_ID'][$iKeyValue]] = [
							'VALUE' => [
							'MODULE_ID' => 'iblock',
							'del' => 'Y',
							]
						];
//					print_r($iKeyValue . ' - ' . $sValue . ' - ' . $arPropValues['PROPERTY_VALUE_ID'][$iKeyValue] . ' - ' . $arDeleteList[$sPropCode][$arPropValues['PROPERTY_VALUE_ID'][$iKeyValue]['VALUE']['del']]);
//					echo '</br>';
						if (in_array($sValue, $arFiles["FILE_DELETE"]) && $arPropValues['PROPERTY_VALUE_ID'][$iKeyValue] > 0) {
						$arDeleteList[$sPropCode][$arPropValues['PROPERTY_VALUE_ID'][$iKeyValue]] = 
							[	'VALUE' => [
								'del' => 'Y',
							]
							];
						}
					}
            	}
        		}
				
		if (!empty($arDeleteList)) {
//			echo 'Не пустой </br>';
            foreach ($arDeleteList as $sPropForDelete => $arDeleteFiles) {
//				print_r($sPropForDelete . ' - ' . $arDeleteFiles . '</br>');
//				print_r($arDeleteFiles);
//				echo '</br>';
//				print_r($obEl->fields[ID]);
//				echo '</br>';
                CIBlockElement::SetPropertyValues(
                    $obEl->fields[ID],
					1,
					$arDeleteFiles,
                    $sPropForDelete
                    
                );
            }
        }
    }
	}
	
		
	}
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++	
	
	function addElement($IdAPI){
	if(CModule::IncludeModule("catalog") && CModule::IncludeModule("iblock"))
	{
		
		$arFilter = array('IBLOCK_ID' => 1, '=XML_ID' => $IdAPI["guid"]);
		$iterator = \CIBlockElement::GetList(
					array(),
					$arFilter,
					
					array("ID","NAME","IBLOCK_SECTION_ID","TIMESTAMP_X"),
					);
		$el = new CIBlockElement;
//		Если элемента не было, то добавляем!!!
		if (!$elem = $iterator->GetNext())
			{	
				
				$PROP = array();
				$PROP[13] = $IdAPI["code"];  
				$PROP[20] = $IdAPI["manufacturer"]["name"];
				$PROP[33] = kanzCatalog::ImageArrayFromAPI($IdAPI);
				$PROP[34] = $IdAPI["brand"]["name"];
				$PROP[35] = $IdAPI["country"]["name"];
			
				$PROP[36] = array();
				foreach($IdAPI["packUnits"] as $key=>$value)
				{
					$PROP[36]["$key"] = $value;
				}
			
				$Sections = kanzCatalog::addSectionFromAPI($IdAPI);
				

				$arLoadProductArray = Array(
				  //"MODIFIED_BY"    => $USER->GetID(), // элемент изменен текущим пользователем
				  "IBLOCK_SECTION_ID" => $Sections[0],
				  "IBLOCK_SECTION" => $Sections,	
				  "IBLOCK_ID"      => 1,
				  "PROPERTY_VALUES"=> $PROP,
				  "NAME"           => $IdAPI["name"],
				  "XML_ID"		   => $IdAPI["guid"],
				  "ACTIVE"         => "Y",            // активен
				  "PREVIEW_TEXT"   => $IdAPI["description"],
				  "DETAIL_TEXT"    => $IdAPI["description"],
				  "DETAIL_PICTURE" => kanzCatalog::addImage(1,$IdAPI["images"][0]["path"])
				  );

				if($PRODUCT_ID = $el->Add($arLoadProductArray))
				{
					echo "New ID: ".$PRODUCT_ID;
					$price = kanzCatalog::RootCategory($Sections[0]) * $IdAPI["prices"][0]["value"];
					kanzCatalog::changePrice(kanzCatalog::GuidToIdElem($IdAPI["guid"]),$price);
					kanzCatalog::addQuantity($PRODUCT_ID,9);
					
					return $PRODUCT_ID;
				}
				else{
					echo "Error: ".$el->LAST_ERROR;
					return $PRODUCT_ID;
					}
				
			}else //Если элемент был, то обновляем!!!
				{
			//Первая часть условия по времени обновления товара
//					if(strtotime($IdAPI["dateUpdate"]) > strtotime($elem["TIMESTAMP_X"]))
//					{
					
						kanzCatalog::delElementImages($IdAPI);
						
//						echo '<pre>';
//						print_r(strtotime($elem["TIMESTAMP_X"]));
//						echo '</br>';
//						print_r(strtotime($IdAPI["dateUpdate"]));
//						echo '</pre>';
			
						$PROP = array();
						$PROP[13] = $IdAPI["code"];  // Артикул
						$PROP[20] = $IdAPI["manufacturer"]["name"];  //Производитель  
						$PROP[33] = kanzCatalog::ImageArrayFromAPI($IdAPI); //Изображения
						$PROP[34] = $IdAPI["brand"]["name"];  //Брэнд
						$PROP[35] = $IdAPI["country"]["name"]; //Страна
						$sPropCode = 'CML2_ATTRIBUTES';
						foreach($IdAPI["properties"] as $key=>$value)
						{	
							echo '<pre>';
							print_r($key);
							print_r(' - ');
							print_r($value["name"]);
							print_r(' - ');
							print_r($value["value"]);
							echo '</pre>';
							$arCreateList[$sPropCode][] = [
							'VALUE' =>  $value["name"],
							'DESCRIPTION' => $value["value"],
						];
							
//							$PROP['CML2_PACKUNITS'][$key] = $value["unit"];
						}
						if (!empty($arCreateList)) {
								echo '<pre>';
								print_r($elem["ID"]);
								print_r(' - </br>');
								print_r($arCreateList);
								echo '<pre>';
								CIBlockElement::SetPropertyValues(
									$elem["ID"],
									1,
									$arCreateList,
									false                    
								);

						}
						
						
			
						$PROP[36] = array("VALUE" => $IdAPI["packUnits"] );
//						echo '<pre>';
//						var_dump($IdAPI["packUnits"]);
//						print_r(' - 111</br>');
//						echo '</pre>';
//						foreach($IdAPI["packUnits"] as $key=>$value)
//						{	
////							echo '<pre>';
////							print_r($value["unit"]);
////							print_r(' - 111</br>');
////							echo '</pre>';
//							
//							$PROP['CML2_PACKUNITS'][$key] = $value["unit"];
//						}
//						echo '<pre>';
//							print_r($PROP[36]);
//							print_r(' - 111</br>');
//							echo '</pre>';
						$Sections = kanzCatalog::addSectionFromAPI($IdAPI);

												
						$arLoadProductArray = Array(
						  //"MODIFIED_BY"    => $USER->GetID(), // элемент изменен текущим пользователем
						  "IBLOCK_SECTION_ID" => $Sections[0],
						  "IBLOCK_SECTION" => $Sections,	
						  "IBLOCK_ID"      => 1,
						  "PROPERTY_VALUES"=> $PROP,
						  //"NAME"           => $IdAPI["name"],
						  "ACTIVE"         => "Y",            // активен
						  "QUANTITY"	   => 3,
						  "PREVIEW_TEXT"   => $IdAPI["description"],
						  "DETAIL_TEXT"    => $IdAPI["description"],
						  "DETAIL_PICTURE" => kanzCatalog::addImage(1,$IdAPI["images"][0]["path"])
						  );
						
						
//			echo '<pre>';
//			print_r($arLoadProductArray);
//			echo '</pre>';

						if($PRODUCT_ID = $el->Update($elem["ID"],$arLoadProductArray))
						{
//							echo "Renew ID: ".$elem["ID"] .' - ' .$elem["NAME"] . '</br>';
//							echo "ROOT Section - ".kanzCatalog::RootCategory($elem["IBLOCK_SECTION_ID"])."</br>";
							
							$price = kanzCatalog::RootCategory($elem["IBLOCK_SECTION_ID"]) * $IdAPI["prices"][0]["value"];
							kanzCatalog::changePrice(kanzCatalog::GuidToIdElem($IdAPI["guid"]),$price);
							kanzCatalog::addQuantity($elem["ID"],19);
//							echo '<pre>';
//							print_r($IdAPI["vendorCode"]);
//							echo '</pre>';
//							CIBlockElement::SetPropertyValues($PRODUCT_ID, 1, $IdAPI["vendorCode"], "CML2_ARTICLE");
							return $PRODUCT_ID;
						}
						else{
							echo "Error: ".$el->LAST_ERROR;
							return $PRODUCT_ID;
						}
			//Втроая часть условия по времени обновления товара
//					}else{
////						echo '<pre> Время обновления товара на сайте';
////						print_r(strtotime($elem["TIMESTAMP_X"]));
////						echo '</br>Время обновления товара на API';
////						print_r(strtotime($IdAPI["dateUpdate"]));
////						echo '</pre>';
//						return 1;
//					}
				}				
	}
	}
	public static function getIblockElement($iblockElementId) {
		   $arOrder = [];
		   $arFilter = ['ID' => $iblockElementId];
		   $arGroupBy = false;
		   $arNavStartParams = false;
		   $arSelectFields = ['ID', '*'];

		   $dbRes = \CIBlockElement::GetList(
			  $arOrder,
			  $arFilter,
			  $arGroupBy,
			  $arNavStartParams,
			  $arSelectFields
		   );
//		echo '<pre>';
//		print_r($dbRes);
//		echo '</pre>';
		//echo $dbRes->result->current_field;

		   $element = $dbRes->Fetch();

		   $propsDbres = \CIBlockElement::GetProperty($element['IBLOCK_ID'], $iblockElementId, "sort", "asc", array(">ID" => 1));

		   $i = 0;
		   while ($prop = $propsDbres->GetNext()) {
			  $i = !isset($element['PROPS'][$prop['CODE'
			  ]]) ? 0 : $i+1;
			  $element['PROPS'][$prop['CODE']]['NAME'] = $prop['NAME'];
			  $element['PROPS'][$prop['CODE']]['TYPE'] = $prop['PROPERTY_TYPE'];
			  $element['PROPS'][$prop['CODE']]['ACTIVE'] = $prop['ACTIVE'];

			  $element['PROPS'][$prop['CODE']]['VALUES'][$i] = [
				 'VALUE' => $prop['VALUE'],
				 'DESCRIPTION' => $prop['DESCRIPTION'],
			  ];

			  if ($prop['PROPERTY_TYPE'] == 'F')
				 $element['PROPS'][$prop['CODE']]['VALUE'][$i]['PATH'] = \CFile::GetPath(intval($prop['VALUE']));
		   }

		   return $element;
		
	}
	
	public static function putIblockElement($iblockElementId, $IdAPI) {
		   $arOrder = [];
		   $arFilter = ['ID' => $iblockElementId];
		   $arGroupBy = false;
		   $arNavStartParams = false;
		   $arSelectFields = ['ID', '*'];

		   $dbRes = \CIBlockElement::GetList(
			  $arOrder,
			  $arFilter,
			  $arGroupBy,
			  $arNavStartParams,
			  $arSelectFields
		   );

		   $element = $dbRes->Fetch();

		   $propsDbres = \CIBlockElement::GetProperty($element['IBLOCK_ID'], $iblockElementId, "sort", "asc", array(">ID" => 1));

		   $i = 0;
		   while ($prop = $propsDbres->GetNext()) {
			  $i = !isset($element['PROPS'][$prop['CODE'
			  ]]) ? 0 : $i+1;
			  $element['PROPS'][$prop['CODE']]['NAME'] = $prop['NAME'];
			  $element['PROPS'][$prop['CODE']]['TYPE'] = $prop['PROPERTY_TYPE'];
			  $element['PROPS'][$prop['CODE']]['ACTIVE'] = $prop['ACTIVE'];

			  $element['PROPS'][$prop['CODE']]['VALUES'][$i] = [
				 'VALUE' => $prop['VALUE'],
				 'DESCRIPTION' => $prop['DESCRIPTION'],
			  ];

			  if ($prop['PROPERTY_TYPE'] == 'F')
				 $element['PROPS'][$prop['CODE']]['VALUE'][$i]['PATH'] = \CFile::GetPath(intval($prop['VALUE']));
		   }

		   return $element;
	}
	
}
?>