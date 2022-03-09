<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("товары каталога");
global $arrFilter;
$arrFilter = array(
   "ACTIVE" => "Y",
   "SECTION_ACTIVE" => "Y",
   "SECTION_GLOBAL_ACTIVE" => "Y",
   "CATALOG_AVAILABLE" => "Y",
   array(
      "LOGIC" => "OR",
      "!DETAIL_PICTURE" => false,
      "!PREVIEW_PICTURE" => false
   )
);

use \Bitrix\Main\Localization\Loc;

?>
<?
$secGuid = $_GET["Go"];
if ($secGuid  != 1)
{
	echo 'Добавляем товары в категорию - '. $secGuid;
	
//	kanzCatalog::AddElemToSections($_GET["IsPut"]);
}
?>

<p><a href="load-elem.php?Go=2">Посмотрите на мою фотографию!</a></p>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>