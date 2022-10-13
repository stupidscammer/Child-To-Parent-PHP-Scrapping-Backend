<?php
require_once 'simple_html_dom.php';
header('Content-Type: application/json; charset=UTF-8');
$static_dom = 'https://vehiclebid.info/search';
$pagenum = $_GET['page'];
if ($pagenum == 0) {
	# code...
	$real_url_dom = $static_dom;
} else {
	# code...
	$real_url_dom = $static_dom.'?page='.$pagenum;
}
$div_class = $title = "";
$item = [];
	$dom = file_get_html($real_url_dom);
	if(!empty($dom)) {
		 $j = 0;		
		foreach($dom->find("div.chakra-stack") as $div_class){
			// $allPage = $div_class->find('.css-1btdty2>a')[3]->innertext;
			foreach($div_class->find("a.chakra-card") as $div_class_data1){				
				$href = $div_class_data1->getAttribute('href');
				foreach($div_class_data1->find(".chakra-image") as $div_class_data)
				{
					$image_url = $div_class_data->getAttribute('src');
					$type = $div_class_data->find(".css-n21gh5>.css-1idwstw>h2")[0]->innertext;
					$vin = $div_class_data->find(".css-n21gh5>.css-1idwstw>p")[0]->innertext;
					$lot = $div_class_data->find(".css-n21gh5>.css-1idwstw>p")[1]->innertext;
					$sale_date = $div_class_data->find(".css-n21gh5>.css-1idwstw>p")[2]->innertext;
					$odermeter = $div_class_data->find(".css-n21gh5>.css-1idwstw>p")[3]->innertext;
					$price = $div_class_data->find(".css-n21gh5>.css-1idwstw>span")[0]->innertext;
					if ($href ) {
						# code...
						$item['href'] = $href;
						$item['image'] = $image_url;
						$item['type'] = str_replace('<!-- -->', '', $type);
						$item['vin'] = str_replace('<!-- -->', '', $vin);
						$item['lot'] = str_replace('<!-- -->', '', str_replace('<strong>Lot</strong>: <!-- -->' ,'', $lot));
						$item['sale_date'] = str_replace('<!-- -->', '', str_replace('<strong>Sale date</strong>: <!-- -->' ,'', $sale_date));
						$temp = str_replace('<strong>Odometer</strong>: <!-- -->' ,'', $odermeter);
						$item['odermeter'] = str_replace('<!-- -->' ,'', $temp);
						$item['price'] = str_replace('<!-- -->', '', str_replace('Final price<!-- -->: <!-- -->' ,'', $price));
						// $item['allpage'] = $allPage;
						$article[] = $item;

					}
				}
				
			}
		}			
		
	}
print_r(json_encode($article));
exit;
?>