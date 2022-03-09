<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?IncludeTemplateLangFile(__FILE__);?>

<!DO CTYPE html>
<html lang="ru-RU">

<head>
	<?$APPLICATION->ShowProperty('AfterHeadOpen');?>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?$APPLICATION->ShowTitle();?></title>
	<?
	$APPLICATION->ShowHead();
	
	use Bitrix\Main\UI\Extension;
	Extension::load('ui.bootstrap4');
	
	$APPLICATION->ShowProperty('MetaOG');
	$APPLICATION->ShowProperty('BeforeHeadClose');
	$APPLICATION->SetAdditionalCSS('/bitrix/css/main/bootstrap.css');

	?>
</head>

<body>
<?$APPLICATION->ShowPanel();?>
<div class="container-fluid">
	<div class="container">
		<div class="row ">
			<div class="col-lg-2 col-sm-12 mx-auto">
				<?$APPLICATION->IncludeComponent(
									"bitrix:main.include",
									"",
									Array(
									"AREA_FILE_SHOW" => "file",
									"PATH" => SITE_TEMPLATE_PATH."/include/header_logo.php",
									"EDIT_TEMPLATE" => ""
									),
									false
									);?>
			</div>
			<div class="col-lg-10 d-none d-lg-block">
					<nav class="navbar navbar-expand-lg  navbar-light nav-fill top_nav">
							<div class="container-fluid ">
			<!--					<a class="navbar-brand mx-3  pt-1" href="<?=SITE_DIR;?>">-->
									
								
								
								
									<ul class="nav-item border-right ">
									  <a class="nav-link up_text_menu" aria-current="page" href="#">Оплата и Доставка</a>
									</ul>
									<ul class="nav-item border-right">
									  <a class="nav-link up_text_menu" href="#">Акции</a>
									</ul>
									<ul class="nav-item border-right">
									  <a class="nav-link up_text_menu" href="#">Магазины</a>
									</ul>
									<ul class="nav-item border-right">
									  <a class="nav-link up_text_menu" href="#">Обратная связь</a>
									</ul>
									<ul class="nav-item ">
									  <a class="nav-link up_text_menu" href="/auth/index.php">Вход/Регистрация</a>
									</ul>

			<!--					  </ul>-->

			<!--					</div>-->
						</div>
			<!--
				</nav>
				<nav class="navbar navbar-light">
			-->
					
					
					
					</nav>

				
				
					<div class="row align-items-start">
						
						<div class="col-lg-3">
							<a class="top-nav-2" href="#">
								<img src="<?=SITE_TEMPLATE_PATH;?>/Icon/mail.svg" width="30" height="30" class="d-inline-block align-top" alt="">
								kanzpark78@mail.ru
							</a>
						</div>
						<div class="col-lg-3">
							<a class="top-nav-2" href="#">
								<img src="<?=SITE_TEMPLATE_PATH;?>/Icon/call.svg" width="30" height="30" class="d-inline-block align-top" alt="">
								+7 (911) 777-04-455
							</a>
						</div>
						<div class="col-lg-4">
							<div class="clearfix">
							<a class="top-nav-2" href="#">
								<img class="col-md-6 float-md-end mb-3 top_pic" src="<?=SITE_TEMPLATE_PATH;?>/Icon/cloak.svg" width="30" height="30" class="d-inline-block align-top" alt="">
								Пн-пт 09:00-17:15 </br>Приём заказов - круглосуточно
							</a>
							</div>
						</div>
						<div class="col-lg-2">
							<div class="clearfix up_text_menu">
								<img class="col-md-6 float-md-end mb-3 top-nav-2" src="<?=SITE_TEMPLATE_PATH;?>/Icon/basket.svg" width="30" height="30" class="d-inline-block align-top" alt="">
								
								<?$APPLICATION->IncludeComponent(
	"bitrix:sale.basket.basket.line", 
	"template1", 
	array(
		"HIDE_ON_BASKET_PAGES" => "Y",
		"PATH_TO_AUTHORIZE" => "/auth/index.php",
		"PATH_TO_BASKET" => SITE_DIR."personal/basket.php",
		"PATH_TO_ORDER" => SITE_DIR."personal/order/make/",
		"PATH_TO_PERSONAL" => "/auth/personal.php",
		"PATH_TO_PROFILE" => "/auth/personal.php",
		"PATH_TO_REGISTER" => "/auth/registration.php",
		"POSITION_FIXED" => "N",
		"SHOW_AUTHOR" => "Y",
		"SHOW_EMPTY_VALUES" => "Y",
		"SHOW_NUM_PRODUCTS" => "Y",
		"SHOW_PERSONAL_LINK" => "Y",
		"SHOW_PRODUCTS" => "N",
		"SHOW_REGISTRATION" => "Y",
		"SHOW_TOTAL_PRICE" => "Y",
		"COMPONENT_TEMPLATE" => "template1"
	),
	false
);?>
							</div>
						</div>
					</div>
				
			</div>	
		</div>
	</div>
	<div class="container-fluid main-menu">
		<div class="container">
			<div class="row align-items-center  main-menu">
					<div class="col-md-3  d-none d-lg-block main-content align-items-center">
						Каталог товаров
						
					</div>	
					<div class="col-md-7 d-none d-lg-block my-auto">
<!--
						 <form class="form-inline mt-2 mt-md-0">
							<input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
							<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
						 </form>
-->

							<?$APPLICATION->IncludeComponent("bitrix:search.title", "template2", Array(
	"CATEGORY_0" => array(	// Ограничение области поиска
			0 => "iblock_catalog",
		),
		"CATEGORY_0_TITLE" => "",	// Название категории
		"CATEGORY_0_iblock_catalog" => array(	// Искать в информационных блоках типа "iblock_catalog"
			0 => "all",
		),
		"CHECK_DATES" => "N",	// Искать только в активных по дате документах
		"CONTAINER_ID" => "title-search",	// ID контейнера, по ширине которого будут выводиться результаты
		"INPUT_ID" => "title-search-input",	// ID строки ввода поискового запроса
		"NUM_CATEGORIES" => "1",	// Количество категорий поиска
		"ORDER" => "date",	// Сортировка результатов
		"PAGE" => "#SITE_DIR#search/index.php",	// Страница выдачи результатов поиска (доступен макрос #SITE_DIR#)
		"SHOW_INPUT" => "Y",	// Показывать форму ввода поискового запроса
		"SHOW_OTHERS" => "N",	// Показывать категорию "прочее"
		"TOP_COUNT" => "5",	// Количество результатов в каждой категории
		"USE_LANGUAGE_GUESS" => "Y",	// Включить автоопределение раскладки клавиатуры
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);?>
					</div>
					<div class="col-sm-12 d-block d-sm-none my-auto">

							<?$APPLICATION->IncludeComponent(
	"bitrix:search.title", 
	"template1", 
	array(
		"CATEGORY_0" => array(
			0 => "iblock_catalog",
		),
		"CATEGORY_0_TITLE" => "",
		"CATEGORY_0_iblock_catalog" => array(
			0 => "1",
		),
		"CHECK_DATES" => "N",
		"CONTAINER_ID" => "title-search",
		"INPUT_ID" => "title-search-input",
		"NUM_CATEGORIES" => "1",
		"ORDER" => "date",
		"PAGE" => "#SITE_DIR#search/index.php",
		"SHOW_INPUT" => "Y",
		"SHOW_OTHERS" => "N",
		"TOP_COUNT" => "5",
		"USE_LANGUAGE_GUESS" => "Y",
		"COMPONENT_TEMPLATE" => "template1"
	),
	false
);?>
					</div>
					<div class="col-md-2 ">
						
					</div>
					
			</div>
		</div>
		
	</div>

	<div class="container">
		<div class="row align-items-center ">
			<div class="col-md-3 gy-3 align-self-start">
		
				<?$APPLICATION->IncludeComponent("bitrix:menu", "catalog_vertical3", Array(
	"ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
		"CHILD_MENU_TYPE" => "left",	// Тип меню для остальных уровней
		"DELAY" => "N",	// Откладывать выполнение шаблона меню
		"MAX_LEVEL" => "4",	// Уровень вложенности меню
		"MENU_CACHE_GET_VARS" => "",	// Значимые переменные запроса
		"MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
		"MENU_CACHE_TYPE" => "N",	// Тип кеширования
		"MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
		"ROOT_MENU_TYPE" => "catalog",	// Тип меню для первого уровня
		"USE_EXT" => "Y",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
		"COMPONENT_TEMPLATE" => "catalog_vertical",
		"MENU_THEME" => "site",	// Тема меню
	),
	false
);?>
			</div>
			<div class="col-md-9 gy-3 align-self-start">
<!--
				<?$APPLICATION->IncludeComponent(
					"bitrix:breadcrumb", 
					".default", 
					array(
					"PATH" => "",
					"SITE_ID" => "s1",
					"START_FROM" => "0",
					"COMPONENT_TEMPLATE" => ""
					),
					false
				);?>
-->
				
