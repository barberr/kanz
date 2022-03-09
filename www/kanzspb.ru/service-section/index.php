<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("service section");
?>


<div>
Служебный раздел
</div>

<a class="btn" href="list.php" >Загрузка списка категорий по API, </br>категории которые уже были на сайте обновляются</a>

<a class="btn" href="guid.php" >Вывод по списка категорий catalog.section</a>

<a class="btn" href="prodacts.php" >Вывод по POST списка товаров</a>

<a class="btn" href="mylist.php" >Вывод категорий</a>

<a class="btn" href="test.php?IsPut=1" >Тестовая математика</a>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>