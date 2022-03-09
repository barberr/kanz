<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
	

	\Bitrix\Main\Loader::includeModule('iblock');

//Конструктор класса cURL, класс лежит в /local/php_inerface/lib/cURL/cURL_class.php
	$cc = new cURL();
	$cc->content = $cc->get("https://api-sale.relef.ru/api/v1/sections/2fa5c39d-d2fd-11ea-80c2-30e1715c5317/list" );
	$result1 = json_decode($cc->content,true);

	$IBlockID = 1;

	$ID = 0;
	$ibsecid = 3;
	$i = 1;	
	
	foreach($result1["list"] as $key=>$value)
	//For($i = 0; $i <= 100; $i++)
		{
			
			//if (!kanzCatalog::addSection($result1["list"][$i]))
			if (!kanzCatalog::addSection($value,$i))
				echo "Ошибка добавления элемента - " . $result1["list"][$i]["name"] . "<br>";


			echo  $value["guid"] . " => " . $value["name"] . " => " . $value["parentGuid"] . " => " .   $value["image"] . " => " . $value["description"] . $value["level"] . "<br>";

		$i++;
			
		}

	$arResult['SectionBX'] = $items;

	$arResult['SectionAPI'] = $result1;

	$arResult['DATE'] = 'sfkljlsknflskfn';


$this->IncludeComponentTemplate();
	
?>