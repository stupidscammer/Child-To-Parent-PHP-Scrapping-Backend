<?php

// include library file
require_once 'simple_html_dom.php';

// fetch HTML content from the site.
$dom = file_get_html('https://www.iaai.com/Search?url=mcftnRTQcTl5opeck3dHMrio79mDbIcIlabytJXvEwY%3d'); 

// gather all the articles 
$article = [];
echo '<pre>';
if(!empty($dom)) {
	$div_class = $title = ""; $i = 0;
	foreach($dom->find(".table-row-inner") as $div_class) {
		foreach ($dom->find(".table-cell--image") as $div_class_data) {
			# code...
			$img = $div_class_data->find("a>img")[0];
		}
		foreach($dom->find(".table-cell--data") as $div_class) {
			// article title
			foreach($div_class->find(".table-cell--heading>h4>a") as $title ) { 
				$item['title'] = $title->innertext;
			}
			if (count($div_class->find(".table-cell--inner>.table-cell")) < 2) {
				// print_r($div_class->find(".table-cell--inner")[0]->innertext());
				continue;
			}
			$vin = $div_class->find(".table-cell--inner>.table-cell")[2]->find(".data-list__item")[3]->find("span")[1];
			$sale_price = $div_class->find(".table-cell--inner>.table-cell")[3]->find(".data-list__item")[6]->find("span")[1];
			$odermeter = $div_class->find(".table-cell--inner>.table-cell")[1]->find(".data-list__item")[0]->find("span")[0];
			$sale_date = $div_class->find(".table-cell--inner>.table-cell")[4]->find(".data-list__item")[0]->find("span")[0];
			$lote = $div_class->find(".table-cell--inner>.table-cell")[0]->find(".data-list__item")[0]->find("span")[1];
			if ($lote) {
				$item['lote'] = $lote->innertext;
			}
			if ($sale_date) {
				$item['sale_date'] = trim($sale_date->innertext);
			}
			if ($odermeter) {
				$item['odermeter'] = trim($odermeter->innertext);
			}
			if ($sale_price) {
				$item['sale_price'] = $sale_price->innertext;
			}
			if ($vin) {
				$item['vin'] = $vin->innertext;
			}
			if ($img) {
				$item['image'] = $img->getAttribute('src');
			}
			$article[] = $item;
		}
		$i++;
	}
}

$result = json_encode($article);
// $fp = fopen('data.json', 'w');
// fwrite($fp, $result);
// // fwrite($fp, '23');
// fclose($fp);
print_r($result);
exit;
?>