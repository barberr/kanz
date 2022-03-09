<?php
if (!defined ('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
{
	die();
}

if (!\Bitrix\Main\Loader::includeModule('landing'))
{
	return;
}

\Bitrix\Landing\Connector\Mobile::prologMobileHit();
?><!DOCTYPE html>
<html xml:lang="<?= LANGUAGE_ID;?>" lang="<?= LANGUAGE_ID;?>" class="<?$APPLICATION->ShowProperty('HtmlClass');?>">
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
	?>
</head>
<body class="<?$APPLICATION->ShowProperty('BodyClass');?>" >
<?

$APPLICATION->ShowPanel();

?>
<?$APPLICATION->ShowProperty('Noscript');?>
<?$APPLICATION->ShowProperty('AfterBodyOpen');?>
<?$APPLICATION->ShowProperty('MainClass');?>
<?$APPLICATION->ShowProperty('MainTag');?>

<header>
	<nav class="navbar navbar-expand-lg fixed-top navbar-light ">
	  <div class="container-fluid">
		<a class="navbar-brand mx-3  pt-1" href="<?=SITE_DIR;?>">
				<img width="118px" height="90px" src="<?=SITE_TEMPLATE_PATH;?>/images/logo CH_B2@2x.png" title="Карандаш - канцелярские товары" alt="Карандаш - канцелярские товары">
		</a>
<!--
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		  <span class="navbar-toggler-icon"></span>
		</button>
-->
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
		  <ul class="navbar-nav me-auto mb-2 mb-lg-0">
			<li class="nav-item">
			  <a class="nav-link" aria-current="page" href="#">Оплата и Доставка</a>
			</li>
			<li class="nav-item">
			  <a class="nav-link" href="#">Акции</a>
			</li>
			<li class="nav-item">
			  <a class="nav-link" href="#">Магазины</a>
			</li>
			<li class="nav-item">
			  <a class="nav-link" href="#">Обратная связь</a>
			</li>
			<li class="nav-item">
			  <a class="nav-link" href="#">Вход/Регистрация</a>
			</li>
			
		  </ul>
		  
		</div>
	  </div>
	</nav>
	<div class="container">
 
	
			
			
<!--
				<nav class="mx-auto  " role="navigation">

													<?$APPLICATION->IncludeComponent(
														"bitrix:menu", 
														"bootstrap_hight_menu", 
														array(
															"ALLOW_MULTI_SELECT" => "N",
															"CHILD_MENU_TYPE" => "left",
															"DELAY" => "N",
															"MAX_LEVEL" => "1",
															"MENU_CACHE_GET_VARS" => array(
															),
															"MENU_CACHE_TIME" => "3600",
															"MENU_CACHE_TYPE" => "N",
															"MENU_CACHE_USE_GROUPS" => "Y",
															"MENU_THEME" => "white",
															"ROOT_MENU_TYPE" => "top",
															"USE_EXT" => "N",
															"COMPONENT_TEMPLATE" => "bootstrap_hight_menu"
														),
														false
													);?>																				


				</nav>
-->
					
					
		<!--</div>-->
		 
</div>	
		<div class="container">
			<div class="row align-items-center mb-2">
				<div class="col-md-3">
					<a class="mx-3 pt-1" href="<?=SITE_DIR;?>">
						<img  src="<?=SITE_TEMPLATE_PATH;?>/images/logo.png" title="Brand" alt="Brand">
					</a>
				</div>	
				<div class="col-md-3 ">
					
						<?$APPLICATION->IncludeComponent(
							"bitrix:search.suggest.input", 
							"main_find", 
							array(
								"DROPDOWN_SIZE" => "10",
								"INPUT_SIZE" => "40",
								"NAME" => "q",
								"VALUE" => "",
								"COMPONENT_TEMPLATE" => "main_find"
							),
							false
						);?>
					
				</div>
				<div class="col-md-3 ">
					<div class="">
						<h5 class="card-title">+7 (911) 777-04-45</h5>
						<p class="">Приём заказов - круглосуточно </br>Режим работы офиса: пн-пт 09:00-17:15</p>
					</div>
				</div>
				<div class="col-md-3 ">
					<?$APPLICATION->IncludeComponent(
	"bitrix:sale.basket.basket.line", 
	".default", 
	array(
		"HIDE_ON_BASKET_PAGES" => "Y",
		"PATH_TO_AUTHORIZE" => "",
		"PATH_TO_BASKET" => SITE_DIR."personal/basket.php",
		"PATH_TO_ORDER" => SITE_DIR."personal/order/make/",
		"PATH_TO_PERSONAL" => SITE_DIR."personal/",
		"PATH_TO_PROFILE" => SITE_DIR."personal/",
		"PATH_TO_REGISTER" => SITE_DIR."login/",
		"POSITION_FIXED" => "N",
		"SHOW_AUTHOR" => "N",
		"SHOW_EMPTY_VALUES" => "Y",
		"SHOW_NUM_PRODUCTS" => "Y",
		"SHOW_PERSONAL_LINK" => "Y",
		"SHOW_PRODUCTS" => "N",
		"SHOW_REGISTRATION" => "Y",
		"SHOW_TOTAL_PRICE" => "Y",
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);?>
				</div>
			</div>
		
		</div>
	
</header>

<div class="container-fluid">
<div class="navbar  navbar-expand navbar-dark flex-column flex-md-row  mb-1">
	<nav class="mx-auto navbar-nav-scroll " role="navigation">

	<?$APPLICATION->IncludeComponent("bitrix:menu", "main_catalog_horizontal", Array(
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
			"COMPONENT_TEMPLATE" => "catalog_horizontal",
			"MENU_THEME" => "site",	// Тема меню
		),
		false
	);?>
	</nav>
</div>
</div>

	
			
			
		
