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




$this->addExternalCss("/local/css/styles.css");      
	  
	  echo $arResult['fromAPI']["count"] . "<br>";
//		echo '<pre>';
//			print_r($arResult['Echo']);
//		echo '</pre>';
	  
	  echo 'Список товаров POST Api <br>';
	  // Цикл объекта
		foreach($arResult['fromAPI']["list"] as $key=>$value)
		{
			echo $key . "=>" . $value["name"] . " => " . $value["guid"] . " => " . $value["parentGuid"] . " => " . $value["level"] ." => " . $value["prices"][0]["value"] ." => " . strtotime($value["dateUpdate"]) ." => " . "<img class='category_pic' src='" . $value["images"][0]["path"] . "'>" . "<br>";
			
		}
	  //echo $arResult['Echo']["list"][0]["name"];
	  //printf ("[%s]\n",      $arResult['Echo']);
?>