<?php

require_once 'simple_html_dom.php';
header('Content-Type: application/json; charset=UTF-8');
$static_dom = 'https://vehiclebid.info/lots/jf2gtanc7kh328035-68973792';
$real_dom_temp = $static_dom.'';
$div_class = $title = "";
$article = [];
$item = [];
	$dom = file_get_html($static_dom);
	echo '<pre>';
	if(!empty($dom)) {	
		$i = 0;		
		foreach($dom->find("div.swiper-wrapper") as $div_class){
			foreach($div_class->find("div.swiper-slide") as $div_class_data1){
				foreach($div_class_data1->find("img") as $div_class_data)
				{
					$image_url = $div_class_data->getAttribute('src');
					$image_arry[] = $image_url;
				}
				$item['image'] = $image_arry;
			}
		}


		foreach($dom->find("div.css-1nqhizt") as $div_class){
			foreach($div_class->find("div.css-1bntj9o") as $div_class_data1){
				foreach($div_class_data1->find("h3") as $div_class_data)
				{
					$key=$div_class_data->innertext;
				}
				foreach($div_class_data1->find("p.css-2ru6ai") as $div_class_data)
				{
					if($i==3){
						foreach($div_class_data->find("span") as $div_class_data2)
						{
							$value=$div_class_data2->innertext;	
						}
					}					
					else $value=$div_class_data->innertext;
					$i++;
				}
				$item[$key] = $value;
			}
		}
		// print_r($i);
		foreach($dom->find("div.css-d1ondw") as $div_class){
			foreach($div_class->find("p.css-rltemf") as $div_class_data1){
				$item["detail1"]=$div_class_data1->innertext;
			}
			foreach($div_class->find("p.css-1art13b") as $div_class_data1){
				$item["detail2"]=$div_class_data1->innertext;
			}
		}
		$j=0;
		foreach($dom->find("ul.css-tu0njr") as $div_class){
			foreach($div_class->find("li.css-0") as $div_class_data1){
				if($j==3)$item["VIN"]=$div_class_data1->innertext;
				$j++;				
			}
		}

		$article[] = $item;
		print_r($article);
	}
exit;
?>