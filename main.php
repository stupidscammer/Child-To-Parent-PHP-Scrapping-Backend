<?php

// include library file
require_once 'simple_html_dom.php';
header('Content-Type: application/json; charset=UTF-8');
// fetch HTML content from the site.
$dom = file_get_html('https://vehiclebid.info'); 

// gather all the articles 
$article = []; $name = '';
// echo '<pre>';
if(!empty($dom)) {
	$div_class = $title = ""; $k = 0;
	for ($i=0; $i <6 ; $i++) {
		$name = $dom->find('.css-1bpnzr3>.css-1bpnzr3')[$i]->find('p')[0]->innertext;
		# code...
		for ($j=0; $j <4 ; $j++) { 
			# code...
			$type = $dom->find('.css-1mt6xfm')[$i]->find('a>.css-0>h3')[$j]->innertext;
			$temp = str_replace('<!--', '', $type);
			$temp = str_replace('-->', '', $temp);
			$item['type'] = str_replace(' ','',$temp);
			// echo str_replace("world","Peter","Hello world!");
			$image_url = $dom->find('.css-1mt6xfm')[$i]->find('a>.css-0>img')[$j]->getAttribute('src');
			$item['image_url'] = trim($image_url);
			$date = $dom->find('.css-1mt6xfm')[$i]->find('a>.css-0>p')[$j]->innertext;
			$item['name'] = trim($name); 
			$item['date'] = trim($date);
			$article[$k]= $item;
			$k++;
		}
		
	}
	
	// echo $name;
	
}
// print_r($article);
$result = json_encode($article);
print_r($result);
// $fp = fopen('D:/task/carmarketingsite/src/config/finallydataofcopartandiaai.json', 'w');
// fwrite($fp, $result);
// // // // // fwrite($fp, '23');
// fclose($fp);
// // print_r($result);
exit;
?>