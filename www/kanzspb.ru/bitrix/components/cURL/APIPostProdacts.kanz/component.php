<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
	
	  CModule::IncludeModule('iblock');

	

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
	
//	2517b566-dacd-11ea-80c2-30e1715c5317 - мешки
	 
	$cc->content = $cc->post("https://api-sale.relef.ru/api/v1/products/list", 
	"{\"filter\":{\"sections\":[\"2b0ff3e7-dacd-11ea-80c2-30e1715c5317\"]},\"limit\":5000,\"offset\":0}");
	$result1 = json_decode($cc->content,true);
	echo '<pre>!!!' .  $result1["list"][1]["prices"][0]["value"];
			print_r($result1);
	echo '</pre>';
////	
//	
//	echo '1111- - ' . $result1["list"][0]["guid"] . '</br>';

//Уточняем какой будем использовать инфоблок
//	  $arFilter = array('IBLOCK_ID' => 1, '=XML_ID' => '24924218-567c-11ea-942d-3ca82a136673');
//
//	$iterator = \CIBlockElement::GetList(
//	   array(),
//		$arFilter,
//	//	array('IBLOCK_ID' => 1, 'NAME' => 'Альбом для пастелей 20л. А4 Лилия Холдинг "Палаццо.Модерн", 280г/м2, сутаж, слоновая кость'),
////	   array('IBLOCK_ID' => 1, '>ID' =>100, '<ID' =>200, '=TYPE' => 1,'=AVAILABLE' => Y),
//	   false,
//	   false,
//	   array('ID', 'IBLOCK_ID', 'NAME', 'XML_ID',  'ACTIVE', 'QUANTITY', 'PRICE', 'DETAIL_TEXT', 'DETAIL_PICTURE',  'MANUFACTURER', 'CATALOG_PRICE_1')
//		);


	
foreach($result1["list"] as $key=>$value)
	{	
	if($value["availability"])
		{
			$id = kanzCatalog::addElement($value);
			if (!$id)
				echo "Ошибка добавления элемента - " . $value["name"] . "<br>";
			
//			$arSelect = Array("ID", "NAME", "PREVIEW_PICTURE");
//			$arFilter = Array("IBLOCK_ID"=>1,  "ID"=>$id);
//			$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), $arSelect);
//			while($ob = $res->GetNextElement())
//			{
//			 $arFields = $ob->GetFields();
//			 print_r($arFields);
//			}
		
//			echo '<pre>!!!';
//			print_r($value);
//			echo '</pre>';
			//if (!kanzCatalog::addSection($result1["list"][$i]))
		}
			
	}

	$arResult['fromAPI'] = $result1;
	$arResult['DATE'] = $result1["count"];

$this->IncludeComponentTemplate();

//class cURL extends CBitrixComponent
//{
//		var $headers;
//		var $user_agent;
//		var $compression;
//		var $cookie_file;
//		var $proxy;
//		var $content;
//	function cURL($cookies=TRUE,$cookie='cookies.txt',$compression='gzip',$proxy='') {
//		$this->headers[] = 'Accept: image/gif, image/x-bitmap, image/jpeg, image/pjpeg';
//		$this->headers[] = 'Connection: Keep-Alive';
//		$this->headers[] = 'Content-type: application/x-www-form-urlencoded;charset=UTF-8';
//		$this->user_agent = 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; .NET CLR 1.0.3705; .NET CLR 1.1.4322; Media Center PC 4.0)';
//		$this->compression=$compression;
//		$this->proxy=$proxy;
//		$this->cookies=$cookies;
//		if ($this->cookies == TRUE) $this->cookie($cookie);
//		}
//	function cookie($cookie_file) {
//		if (file_exists($cookie_file)) {
//			$this->cookie_file=$cookie_file;
//		} else {
//			fopen($cookie_file,'w') or $this->error('The cookie file could not be opened. Make sure this directory has the correct permissions');
//			$this->cookie_file=$cookie_file;
//		fclose($this->cookie_file);
//		}
//	}
//	function get($url) {
//		$process = curl_init($url);
//		curl_setopt($process, CURLOPT_HTTPHEADER, $this->headers);
//		curl_setopt($process, CURLOPT_HEADER, 0);
//		curl_setopt($process, CURLOPT_USERAGENT, $this->user_agent);
//		if ($this->cookies == TRUE) curl_setopt($process, CURLOPT_COOKIEFILE, $this->cookie_file);
//		if ($this->cookies == TRUE) curl_setopt($process, CURLOPT_COOKIEJAR, $this->cookie_file);
//		curl_setopt($process,CURLOPT_ENCODING , $this->compression);
//		curl_setopt($process, CURLOPT_TIMEOUT, 30);
//		if ($this->proxy) curl_setopt($process, CURLOPT_PROXY, $this->proxy);
//		curl_setopt($process, CURLOPT_RETURNTRANSFER, 1);
//		curl_setopt($process, CURLOPT_FOLLOWLOCATION, 1);
//		$return = curl_exec($process);
//		curl_close($process);
//		return $return;
//	}
//	function post($url,$data) {
//		$process = curl_init($url);
//		$header_array = array('accept: application/json',
//								'apikey:e3958bf950944469bee0905142f48e02',
//								'Content-Type: application/json',
//								);
//		
//		curl_setopt($process, CURLOPT_HTTPHEADER, $header_array);
//		//curl_setopt($process, CURLOPT_HEADER, 1);
//		//curl_setopt($process, CURLOPT_USERAGENT, $this->user_agent);
//		//if ($this->cookies == TRUE) curl_setopt($process, CURLOPT_COOKIEFILE, $this->cookie_file);
//		//if ($this->cookies == TRUE) curl_setopt($process, CURLOPT_COOKIEJAR, $this->cookie_file);
//		curl_setopt($process, CURLOPT_ENCODING , $this->compression);
//		curl_setopt($process, CURLOPT_TIMEOUT, 30);
//		//if ($this->proxy) curl_setopt($process, CURLOPT_PROXY, $this->proxy);
//		curl_setopt($process, CURLOPT_POSTFIELDS, $data);
//		curl_setopt($process, CURLOPT_RETURNTRANSFER, 1);
//		//curl_setopt($process, CURLOPT_FOLLOWLOCATION, 1);
//		curl_setopt($process, CURLOPT_POST, 1);
//		curl_setopt($process, CURLOPT_NOBODY, 0);
//		$result = curl_exec($process);
////		echo '<pre>';
////			print_r($result );
////		echo '</pre>';
//		curl_close($process);
//		return $result;
//	}
//	
//	function changePrice($elId,$price) {
//	
//	 	// PRODUCT_ID
////		$price = 555;
//		$currency = 'RUB';
//		$priceGroupId = 1; // Тип цены
//
//		$arFieldsPrice = [
//			"PRODUCT_ID" => $elId,
//			"CATALOG_GROUP_ID" => $priceGroupId,
//			"PRICE" => $price,
//			"CURRENCY" => !$currency ? "RUB" : $currency,
//		];
//
//		$dbPrice = \Bitrix\Catalog\Model\Price::getList([
//			"filter" => [
//				"PRODUCT_ID" => $elId,
//				"CATALOG_GROUP_ID" => $priceGroupId
//			]
//		]);
//
//
//		if ($arPrice = $dbPrice->fetch()) {
//			$result = \Bitrix\Catalog\Model\Price::update($arPrice["ID"], $arFieldsPrice);
//			if ($result->isSuccess()) {
//				echo "Обновили цену у товара у элемента каталога " . $elId . " Цена " . $price . PHP_EOL;
//					} else {
//						echo "Ошибка обновления цены у товара у элемента каталога " . $elId . " Ошибка " . implode('<br>',
//								$result->getErrorMessages()) . PHP_EOL;
//					}
//				} else {
//					$result = \Bitrix\Catalog\Model\Price::add($arFieldsPrice);
//					if ($result->isSuccess()) {
//						echo "Добавили цену у товара у элемента каталога " .  $elId . " Цена " . $price . PHP_EOL;
//					} else {
//						echo "Ошибка добавления цены у товара у элемента каталога " .  $elId . " Ошибка " . implode('<br>',
//								$result->getErrorMessages()) . PHP_EOL;
//					}
//				}
//	}
//	function error($error) {
//	echo "<center><div style='width:500px;border: 3px solid #FFEEFF; padding: 3px; background-color: #FFDDFF;font-family: verdana; font-size: 10px'><b>cURL Error</b><br>$error</div></center>";
//	die;
//	}
//	
//	function cURLcheckBasicFunctions()
//	{
//	  if( !function_exists("curl_init") &&
//		  !function_exists("curl_setopt") &&
//		  !function_exists("curl_exec") &&
//		  !function_exists("curl_close") ) return false;
//	  else return true;
//	}
//	
//	function cURLdownloadAllRazdel($url, $file)
//	{
//	  if( !$this->cURLcheckBasicFunctions() ) return "UNAVAILABLE: cURL Basic Functions";
//	  $ch = curl_init();
//	  if($ch)
//	  {
//		//echo 'CH - '.$ch.' - ';
//		$fp = fopen($file, "w");
//		$fl = fopen($_SERVER['DOCUMENT_ROOT'].'/katalog/cur_log.log', "w");
//		if($fp)
//		{
//		  if( !curl_setopt($ch, CURLOPT_URL, $url) )
//		  {
//			fclose($fp); // to match fopen()
//			curl_close($ch); // to match curl_init()
//			return "FAIL: curl_setopt(CURLOPT_URL)";
//		  }
//		  
//		  $header_array = array('accept: application/json',
//								'apikey:e3958bf950944469bee0905142f48e02',
//								//'Content-Type: application/json',
//								);
//			/*echo '<pre>';
//			print_r($header_array);
//			echo '</pre>';*/
//		  $opt_ar = array(	CURLOPT_FILE => $fp,
//							CURLOPT_URL => $url,
//							//CURLOPT_HEADER => false,
//							//CURLOPT_POST => 1,
//							CURLOPT_HTTPHEADER => $header_array,
//							//CURLOPT_POSTFIELDS => 'limit=50&offset=0',
//							CURLOPT_RETURNTRANSFER => true,
//							CURLOPT_NOBODY => 0,
//							CURLOPT_VERBOSE => 1,
//							CURLOPT_STDERR => $fl,
//					);
//			//$location = curl_escape($ch, 'Hofbräuhaus / München');
//			/*echo '<pre>';
//			print_r($opt_ar);
//			echo '</pre>';		*/
//		  if( !curl_setopt_array($ch, $opt_ar)) return "FAIL: curl_setopt_array(Array)";
//		  /*if( !curl_setopt($ch, CURLOPT_FILE, $fp) ) return "FAIL: curl_setopt(CURLOPT_FILE)";
//		  if( !curl_setopt($ch, CURLOPT_HEADER, 1) ) return "FAIL: curl_setopt(CURLOPT_HEADER)";
//		  if( !curl_setopt($ch, CURLOPT_POST, 1) ) return "FAIL: curl_setopt(CURLOPT_POST)";*/
//		  $result = curl_exec($ch);
//		  
//		  
//
//		  // this will extract the timing information
//			/* Запись в лог!!!!!
//			extract(curl_getinfo($ch)); // create metrics variables from getinfo
//			$appconnect_time = curl_getinfo($ch, CURLINFO_APPCONNECT_TIME); // request this time explicitly
//			$downloadduration = number_format($total_time - $starttransfer_time, 9); // format, to get rid of scientific notation
//			$namelookup_time = number_format($namelookup_time, 9);
//			$metrics = "CURL...: $url Time...: $total_time DNS: $namelookup_time Connect: $connect_time SSL/SSH: $appconnect_time PreTransfer: $pretransfer_time StartTransfer: $starttransfer_time Download: $downloadduration";
//			error_log($metrics);  // write to php-fpm default www-error.log, or append it to same log as above with file_put_contents(<filename>, $metrics, FILE_APPEND)
//			*/
//		  // Проверяем наличие ошибок
//			if (!curl_errno($ch)) {
//			  switch ($http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE)) {
//				case 200:  # OK
//				  break;
//				default:
//				  echo 'Неожиданный код HTTP: ', $http_code, "\n";
//			  }
//			}
//
//
//		  if( !$result ) {
//						var_dump(json_decode($result, true));
//						echo json_decode($result);
//						
//							curl_close($ch);
//							fclose($fp);
//						//echo 'Ошибка curl: ' . curl_error($ch);
//						return "FAIL: curl_exec() - $result - ";
//		  }
//			
//			
//		  curl_close($ch);
//		  fclose($fp);
//		  return $result;
//		}
//		else return "FAIL: fopen()";
//	  }
//	  else return "FAIL: curl_init()";
//	}
//	
//	function str() {
//		$cc = new cURL();
//		//Получение списка разделов классификатора 
//		$cc->content = $cc->cURLdownloadAllRazdel("https://api-sale.relef.ru/api/v1/sections/2fa5c39d-d2fd-11ea-80c2-30e1715c5317/list", $_SERVER['DOCUMENT_ROOT'].'/katalog/example.txt');
//		return $cc->content;
//		
//	}
//}

	
	
	
?>