<?php 

error_reporting(E_ALL ^ E_WARNING);
function findAndCompare(){
	$site1=$_POST['site1'];
	$site2=$_POST['site2'];
	$html = file_get_contents('http://www.instilla.it/');
	$html2 = file_get_contents('http://www.cresceredigitale.it/');

	// Create DOM from URL or file
	$linksSiteFirst=[];
	$linksSiteSecond=[];
	$dom = new DOMDocument;
	$dom->loadHTML($html);
	$xpath = new DOMXPath($dom);
	$nodes = $xpath->query('//a/@href');
	foreach($nodes as $href) {
		$linksSiteFirst[]=$href->nodeValue;
	}

	$dom->loadHTML($html2);
	$xpath = new DOMXPath($dom);
	$nodes = $xpath->query('//a/@href');
	foreach($nodes as $href) {
		$linksSiteSecond[]=$href->nodeValue;
	}  

	$result=[];
	for($i = 0; $i < count($linksSiteFirst); $i++){
		$posTemp=-1;
		$somiglianza=-1;
		for ($j=0; $j < count($linksSiteSecond); $j++) { 
			//trova massima somiglianza
			similar_text($linksSiteFirst[$i], $linksSiteSecond[$j], $perc);
			if($perc>$somiglianza){
				$somiglianza=$perc;
				$posTemp=$j;
			}
		}
		$result[]= array($linksSiteFirst[$i],$linksSiteSecond[$posTemp],$somiglianza);

	}

	// echo "<pre>";
	// print_r($result);
	// echo "</pre>";
	$filename = 'file';
	$filepath = $filename.".csv";
	$fp = fopen($filepath, 'w');

	foreach ($result as $fields) {
	    fputcsv($fp, $fields);
	}
	fclose($fp);

	header('Content-Type: application/octet-stream');
	header('Content-Disposition: attachment; filename="' . $filename .'.csv"');
	header('Content-Length: ' . filesize($filepath)); 
	echo readfile($filepath);
} 
	if(isset($_POST["site2"])){
		findAndCompare();
	die();
	}
?>
<html>
	<head>
		<title>Test Instilla</title>
	</head>
<body>
		
		
	<form action="/" method="POST">
			<label for="site1">Primo sito</label>
			<input type="text" name="site1" >
			<label for="site2">Secondo sito</label>
			<input type="text" name="site2" >
			<button type="submit" name="button">Invia</button>
		</form>
	
</body>
</html>