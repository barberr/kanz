<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Main\Page\Asset;
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/js/my_scripts.js');
CJSCore::Init(array('ajax'));
//$APPLICATION->ShowHead();
//$this->addExternalJS("/local/js/scrips.js");
echo '<div id="results">';
	  echo '1k1';
	  echo $arResult['DATE'];
	
echo '</div>';
?>