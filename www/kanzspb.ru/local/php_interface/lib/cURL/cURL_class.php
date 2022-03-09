<?php
class cURL extends CBitrixComponent {
		var $headers;
		var $user_agent;
		var $compression;
		var $cookie_file;
		var $proxy;
	function cURL($cookies=TRUE,$cookie='cookies.txt',$compression='gzip',$proxy='') {
		$this->headers[] = 'Accept: image/gif, image/x-bitmap, image/jpeg, image/pjpeg';
		$this->headers[] = 'Connection: Keep-Alive';
		$this->headers[] = 'Content-type: application/x-www-form-urlencoded;charset=UTF-8';
		$this->user_agent = 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; .NET CLR 1.0.3705; .NET CLR 1.1.4322; Media Center PC 4.0)';
		$this->compression=$compression;
		$this->proxy=$proxy;
		$this->cookies=$cookies;
		if ($this->cookies == TRUE) $this->cookie($cookie);
		}
	function cookie($cookie_file) {
		if (file_exists($cookie_file)) {
			$this->cookie_file=$cookie_file;
		} else {
			fopen($cookie_file,'w') or $this->error('The cookie file could not be opened. Make sure this directory has the correct permissions');
			$this->cookie_file=$cookie_file;
		fclose($this->cookie_file);
		}
	}
	function get($url) {
		$process = curl_init($url);
		$header_array = array('accept: application/json',
								'apikey:e3958bf950944469bee0905142f48e02',
								//'Content-Type: application/json',
								);
		
		curl_setopt($process, CURLOPT_HTTPHEADER, $header_array);
		curl_setopt($process, CURLOPT_HEADER, 0);
		//curl_setopt($process, CURLOPT_USERAGENT, $this->user_agent);
		//if ($this->cookies == TRUE) curl_setopt($process, CURLOPT_COOKIEFILE, $this->cookie_file);
		//if ($this->cookies == TRUE) curl_setopt($process, CURLOPT_COOKIEJAR, $this->cookie_file);
		//curl_setopt($process,CURLOPT_ENCODING , $this->compression);
		//curl_setopt($process, CURLOPT_TIMEOUT, 30);
		//if ($this->proxy) curl_setopt($process, CURLOPT_PROXY, $this->proxy);
		curl_setopt($process, CURLOPT_RETURNTRANSFER, 1);
		//curl_setopt($process, CURLOPT_FOLLOWLOCATION, 1);
		$return = curl_exec($process);
		curl_close($process);
		
		return $return;
	}
	function post($url,$data) {
		$process = curl_init($url);
		$header_array = array('accept: application/json',
								'apikey:e3958bf950944469bee0905142f48e02',
								'Content-Type: application/json',
								);
		
		curl_setopt($process, CURLOPT_HTTPHEADER, $header_array);
		//curl_setopt($process, CURLOPT_HEADER, 1);
		//curl_setopt($process, CURLOPT_USERAGENT, $this->user_agent);
		//if ($this->cookies == TRUE) curl_setopt($process, CURLOPT_COOKIEFILE, $this->cookie_file);
		//if ($this->cookies == TRUE) curl_setopt($process, CURLOPT_COOKIEJAR, $this->cookie_file);
		curl_setopt($process, CURLOPT_ENCODING , $this->compression);
		curl_setopt($process, CURLOPT_TIMEOUT, 30);
		//if ($this->proxy) curl_setopt($process, CURLOPT_PROXY, $this->proxy);
		curl_setopt($process, CURLOPT_POSTFIELDS, $data);
		curl_setopt($process, CURLOPT_RETURNTRANSFER, 1);
		//curl_setopt($process, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($process, CURLOPT_POST, 1);
		curl_setopt($process, CURLOPT_NOBODY, 0);
		$result = curl_exec($process);
		
//		echo '<pre>';
//			print_r(curl_error($process));
//		echo '</pre>';
		curl_close($process);
		return $result;
	}
	
	function parsXML1c() {
		
		//echo 'CH -  - ';
		//$fp = fopen($_SERVER['DOCUMENT_ROOT'].'/upload/1c_catalog/import0_1.xml', "w");
		//пример пошагового разбора файла: 
		
		$obXMLFile = new CIBlockXMLFile;
		// Удаляем результат предыдущей загрузки
		$obXMLFile->DropTemporaryTables();
		// Подготавливаем БД
		if(!$obXMLFile->CreateTemporaryTables())
			return "Ошибка создания БД.";
		
		echo 'Парсим файл';
		$NS = &$_SESSION["BX_IMPORT_NS"];
		$ABS_FILE_NAME = $_SERVER['DOCUMENT_ROOT'].'/upload/1c_catalog/import0_1.xml';
		$total = filesize($ABS_FILE_NAME);
		if($fp = fopen($ABS_FILE_NAME, "rb")) {
			// Чтение содержимого файла шагом в 10 секунд
			if ($obXMLFile->ReadXMLToDatabase($fp, $NS, 10, 1024) ) {
					echo '
					Файл прочитан полностью.';
					echo '<pre>';
					print_r($obXMLFile);
					echo '</pre>';
				} else {
					echo '
					Файл прочитан не полностью: '.round($obXMLFile->GetFilePosition()/$total*100, 2).'%.';
				}
				fclose($fp);
			} else {
				// Файл открыть не удалось
				echo "Ошибка открытия файла";
			}
		
	  
	}
	
	function changePrice($elId,$price) {
	
	 	// PRODUCT_ID
		//		$price = 555;
		$currency = 'RUB';
		$priceGroupId = 1; // Тип цены

		$arFieldsPrice = [
			"PRODUCT_ID" => $elId,
			"CATALOG_GROUP_ID" => $priceGroupId,
			"PRICE" => $price,
			"CURRENCY" => !$currency ? "RUB" : $currency,
		];

		$dbPrice = \Bitrix\Catalog\Model\Price::getList([
			"filter" => [
				"PRODUCT_ID" => $elId,
				"CATALOG_GROUP_ID" => $priceGroupId
			]
		]);


		if ($arPrice = $dbPrice->fetch()) {
			$result = \Bitrix\Catalog\Model\Price::update($arPrice["ID"], $arFieldsPrice);
			if ($result->isSuccess()) {
				echo "Обновили цену у товара у элемента каталога " . $elId . " Цена " . $price . PHP_EOL;
					} else {
						echo "Ошибка обновления цены у товара у элемента каталога " . $elId . " Ошибка " . implode('<br>',
								$result->getErrorMessages()) . PHP_EOL;
					}
				} else {
					$result = \Bitrix\Catalog\Model\Price::add($arFieldsPrice);
					if ($result->isSuccess()) {
						echo "Добавили цену у товара у элемента каталога " .  $elId . " Цена " . $price . PHP_EOL;
					} else {
						echo "Ошибка добавления цены у товара у элемента каталога " .  $elId . " Ошибка " . implode('<br>',
								$result->getErrorMessages()) . PHP_EOL;
					}
				}
	}
	
	function error($error) {
	echo "<center><div style='width:500px;border: 3px solid #FFEEFF; padding: 3px; background-color: #FFDDFF;font-family: verdana; font-size: 10px'><b>cURL Error</b><br>$error</div></center>";
	die;
	}
	
	function str() {
		echo 'kfkgjlkfkhglk';
	}
}
/*$cc = new cURL();
$cc->get('http://www.example.com');
$cc->post('http://www.example.com','foo=bar');*/
?>