function recursively_ajax(in_guid,in_quantity,in_offset){
	console.log(in_guid,in_quantity," - ",in_offset);
	var postData = {               
				  'sessid': BX.bitrix_sessid(),
				  'site_id': BX.message('SITE_ID'),
				  'action': 'recurs',
				  'guid': in_guid,
				  'quantity': in_quantity,
				  'offSet': in_offset,
				};
	BX.ajax({
		url: '/service-section/ajax/file.php',
		method: 'POST',
		data: postData,
		dataType: 'json', 
		async: true,
		onsuccess: function(result)        
		{            
			
			if((in_offset+20) < in_quantity){  
				console.log("Не обновлено ",result.notupdate, " товаров в категорию - ",result.update_sec);
				in_offset += 20;
				recursively_ajax(in_guid,in_quantity,in_offset); 	
			}else{
				console.log("Загрузили рекурсивно ",in_quantity," товаров в категорию -",result.update_sec);
			}
		},
		onfailure: function(result){
					   console.log("ошибка рекурсивной загрузкив категорию-",result.update_sec);
				   } 
	}); 
}

function single_ajax(in_guid){
			//производим какие-то действия
				
				var postData = {               
				  'sessid': BX.bitrix_sessid(),
				  'site_id': BX.message('SITE_ID'),
				  'action': 'add',
				  'guid': in_guid,
				  'quantity': 1,
				};
				
				BX.ajax({
				   url: '/service-section/ajax/file.php',
				   method: 'POST',
				   data: postData,
				   dataType: 'json',
				   onsuccess: function(result){      
					   console.log("Загрузили за раз товары в категорию-",result.update_sec);
//					   console.log(result.text);
//					   element.value = result.text;
				   },
				   onfailure: function(result){
					   console.log("NO000");
				   } 
				});
		
			return false;
}


BX.ready(function(){
	
	

	var object = BX('submit1');
	var fields = BX.findChild(BX("container"),{tag: 'input'}, false, true);
	var count_pre = BX.findChild(BX("container"),{tag: 'pre'}, false, true);
	
	console.log(count_pre.length);
	count_pre.forEach(function(element){
		console.log(element);
		var postData = {               
				  'sessid': BX.bitrix_sessid(),
				  'site_id': BX.message('SITE_ID'),
				  'action': 'count',
				  'guid': element.previousSibling.name,
				  'quantity': 1,
				};
//				 console.log(postData);
				BX.ajax({
				   url: '/service-section/ajax/file.php',
				   method: 'POST',
				   data: postData,
				   dataType: 'json',
				   async: false,
				   onsuccess: function(result){    
					   
//					   recursively_ajax(result.update_sec,result.count_el,100)
					   
					   console.log("получили количество товаров в категории - ",result.count_el);
//					   console.log(result.count_el);
//					   if(result.count_el < 2){
//						   	single_ajax(result.update_sec);
//					   }else{
							recursively_ajax(result.update_sec,result.count_el,0);
//					   }
					   if(result.update_sec)
					   		element.hidden = true;
					   else 
						   element.firstChild.data = result.count_el;
				   },
				   onfailure: function(result){
					   console.log("NO000");
				   } 
				});
	});
//	console.log(fields.length);
//		fields.forEach(function(element){
//			element.onclick = function() {
//			//производим какие-то действия
//				
//				var postData = {               
//				  'sessid': BX.bitrix_sessid(),
//				  'site_id': BX.message('SITE_ID'),
//				  'action': 'add',
//				  'guid': element.name,
//				  'quantity': 1,
//				};
//				
//				BX.ajax({
//				   url: '/service-section/ajax/file.php',
//				   method: 'POST',
//				   data: postData,
//				   dataType: 'json',
//				   onsuccess: function(result){      
//					   console.log("YES");
//					   console.log(result.text);
//					   element.value = result.text;
//				   },
//				   onfailure: function(result){
//					   console.log("NO000");
//				   } 
//				});
//		
//			return false;
//			}
//		   console.log(element.name);
//		});
	

});

