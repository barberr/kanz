<? require($_SERVER["DOCUMENT_ROOT"]. "/bitrix/header.php");

//Подключаем модуль работы с инфоблоками
  CModule::IncludeModule('iblock');

//Уточняем какой будем использовать инфоблок
  $arFilter = array(
  'IBLOCK_ID' => 1,
  );

$iterator = \CIBlockElement::GetList(
   array(),
//	array('IBLOCK_ID' => 1, 'NAME' => 'Альбом для пастелей 20л. А4 Лилия Холдинг "Палаццо.Модерн", 280г/м2, сутаж, слоновая кость'),
   array('IBLOCK_ID' => 1, '>ID' =>100, '<ID' =>200, '=TYPE' => 1,'=AVAILABLE' => Y),
   false,
   false,
   array('ID', 'IBLOCK_ID', 'NAME', 'TYPE',  'AVAILABLE', 'QUANTITY', 'PRICE', 'DETAIL_TEXT', 'DETAIL_PICTURE', 'CATALOG_PRICE_1')
);

//	echo '<pre>';
//			print_r($iterator);
//	echo '</pre>';

while($el = $iterator->GetNext()){
	echo '<pre>';
			print_r($el);
	echo '</pre>';
  echo "<div>" . $el['ID'] . " => " .$el['NAME']. " => " .$el['CATALOG_PRICE_1']. " => " .$el['QUANTITY']. " => " ."<img class='category_pic' src='" . CFile::GetPath($el['DETAIL_PICTURE']) . "'>" . "<br></div>";
  
}
  
//Получаем массив всех элементов
//  $res = CIBlockElement::GetList(false, $arFilter, array('IBLOCK_ID','ID'));

////Перебираем все элементы инфоблока и записываем в массив их IDшники
//  while($el = $res->GetNext()):
//  echo $arElementsID[] = $el['ID'] . '<br>';
//  endwhile;

require($_SERVER["DOCUMENT_ROOT"]. "/bitrix/footer.php");
?>