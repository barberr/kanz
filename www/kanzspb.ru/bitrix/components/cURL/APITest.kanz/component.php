

<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
	
	  CModule::IncludeModule('iblock');

$this->IncludeComponentTemplate();

//	while($el = $iterator->GetNext()){
//	//	echo '<pre>';
//	//			print_r($el);
//	//	echo '</pre>';
//	  echo "<div>" . $el['ID'] . " => " .$el['NAME']. " => " .$el['CATALOG_PRICE_1']. " => " .$el['QUANTITY']. " => " ."<img class='category_pic' src='" . CFile::GetPath($el['DETAIL_PICTURE']) . "'>" . "<br></div>";
//
//	}
	//$result = json_decode(cURL::str(),true);
	//$result = cURL::str(); 
	//$arResult['DATE'] = date($arParams["TEMPLATE_FOR_DATE"]);
	$cc = new cURL();
	//Получение списка разделов классификатора 
//	$cc->content = $cc->post("https://api-sale.relef.ru/api/v1/products/list", "{\"limit\":2,\"offset\":4398}" );
	$cc->content = $cc->get("https://api-sale.relef.ru/api/v1/sections/2fa5c39d-d2fd-11ea-80c2-30e1715c5317/list" );
//	$cc->content = $cc->post("https://api-sale.relef.ru/api/v1/products/list", 
//	"{\"filter\":{\"sections\":[\"2517b566-dacd-11ea-80c2-30e1715c5317\"]},\"limit\":20,\"offset\":0}");
	$result1 = json_decode($cc->content,true);

//		echo '<pre>';
//		print_r($result1);
//		echo '</pre>';

//kanzCatalog::AddElemToSections($value['guid']);
$secGuid = $_GET["IsPut"];
if ($secGuid  == 0)
{
	$i=1;
	echo '<div id="container">';
	
	
	
	foreach($result1["list"] as $key=>$value){
		echo $i .'</br>';
		
		if($value["level"] == 3){
			if(($i > 0)&&($i < 50)){		
	//			if (!include 'https://www.kanzspb.ru/service-section/test.php?IsPut='.$value['guid']) echo "NO YES";
	//			require($_SERVER["DOCUMENT_ROOT"].'/service-section/test.php?IsPut='.$value['guid']);
				echo '<li>' . $i;
					print_r($value);
				echo '</li>';
				echo '<td><input type="button" name="'.$value['guid'].'" id="submit1" value="submit" /></td>';
				echo '<pre id="count" name="'.$value['guid'].'">23456</pre>';
			}
			$i++;
		
		}	
		
	}
	

	
	echo '</div>';
	
}
elseif ($secGuid  != 1)
{
	echo 'Добавляем товары в категорию - '. $_GET["IsPut"];
	
//		echo '<pre>';
//		print_r($result1);
//		echo '</pre>';

	kanzCatalog::AddElemToSectionsRecur($_GET["IsPut"],20,0);
	
//	kanzCatalog::AddElemToSections($_GET["IsPut"]);
	
//	kanzCatalog::AddElemToSections($_GET["IsPut"]);
}
else{
	echo '<div class="container">';

	echo '<ul>';	
	$i = 0;
	foreach($result1["list"] as $key=>$value)
	{	
		if($value["parentGuid"])
		{
			$el = kanzCatalog::GuidToIdActive($value['guid']);
			if($el["ID"] != 0)
			{

				echo '<li>';
				echo '<form name="test" method="post" action="test.php?IsPut='.$value['guid'].'" target="_blank">';
				echo $el["NAME"].' Элементов - '.kanzCatalog::ColElemFromSections($value['guid']).'</br>';
				echo '<input class="adm-btn-save" type="submit" value="Загрузить товары в раздел '. $value['name'].'  >>'.$value['guid'].'">';
				echo $value['guid'];
				echo '</form>';



				echo '</li>';
				if ($i == 10)  break;
			}
			$i++;

		}
	}
	echo '</ul>';
	echo '</div>';
	$arResult['fromAPI'] = $result1;
	$arResult['DATE'] = $result1["count"];
		
}



	
?>

