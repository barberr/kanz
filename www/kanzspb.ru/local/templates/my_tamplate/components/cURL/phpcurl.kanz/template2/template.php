<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true); 

CModule::IncludeModule('iblock');


$this->addExternalCss("/local/css/styles.css");      
	  
	  echo $arResult['DATE'] . "<br>";
	  
//echo 'Получение списка разделов классификатора</br>'; 
//Вывод всего массива на экран
		echo '<pre>';
			print_r($arResult);
		echo '</pre>';	

	  // Цикл объекта
		// вывод картинки "<img class='category_pic' src='" . $value["image"] . "'>" .

//////////////////////////////////////////////////////////////
//		while($arItem = $arResult['SectionBX']->GetNext())
//		{
//			echo '=>' . 'id= ' . $arItem['ID'] . '=>' . $arItem["XML_ID"] . '=>' .$arItem["NAME"] . '<br>';
//			echo $arItem["DESCRIPTION"]."<br>";
//		}
//		
//		foreach($arResult['SectionAPI']["list"] as $key=>$value)
//		{
//			echo  $value["guid"] . " => " . $value["name"] . " => " . "<img class='category_pic' src='" . $value["image"] . "'>" . " => " . $value["description"] . " => " . $value["parentGuid"] . " => " . $value["level"] ."<br>";
//			
////			foreach($value as $key1=>$value1)
////			{
////				echo  $value["guid"] . " => " . $value["name"] . " => " . $value["availability"] . " => " .    $value["images"]["catalogType"] . " => " . "<br>";
////			}
//			
//		}
//////////////////////////////////////////////////////////////

	  //echo $arResult['Echo']["list"][0]["name"];
	  //printf ("[%s]\n",      $arResult['Echo']);
?>