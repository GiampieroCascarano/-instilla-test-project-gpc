<?php 

error_reporting(E_ALL ^ E_WARNING);

function findAndCompare(){
	$site1=$_POST['site1'];
	$site2=$_POST['site2'];

	$xpathFirst=getDomXPathFromLink($site1);//ricavi insieme di nodi che costituiscono la pagina

	$linksSiteFirst=getArrayWithUrlAndTitle($xpathFirst);//estrapoli titolo della pagina e relativo link e li inserisci in un array
	
	$xpathSecond = getDomXPathFromLink($site2);

	$linksSiteSecond=getArrayWithUrlAndTitle($xpathSecond);

	$result=compareTwoSitesWithSimilarField($linksSiteFirst,$linksSiteSecond,"url");//applica il confronto similare fra i titoli o fra gli url
	
	$name = 'file';
	$path = $name.".csv";

	createCSVFromResult($name,$path,$result);

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


<?php 


function getDomXPathFromLink($link){
	$html = file_get_contents($link);
	$dom = new DOMDocument;
	$dom->loadHTML($html);
	return new DOMXPath($dom);
}

function getArrayWithUrlAndTitle($DOMXPath){
	$linksSite=[];

	$nodes = $DOMXPath->query('//a/@href');
	foreach($nodes as $href) {
		$url=$href->nodeValue;
		$DOMXPath = getDomXPathFromLink($url);
		$title = @$DOMXPath->query('//title')->item(0)->nodeValue;
		$linksSite[]=[
			'url'=>$url,
			'title'=>$title
		];
	}
	return $linksSite;

}
function compareTwoSitesWithSimilarField($first,$second,$field){
	$res=[];

	for($i = 0; $i < count($first); $i++){
		$posTemp=-1;
		$somiglianza=-1;
		for ($j=0; $j < count($second); $j++) { 
			//trova massima somiglianza
			similar_text($first[$i]["$field"], $second[$j]["$field"], $perc);
			if($perc>$somiglianza){
				$somiglianza=$perc;
				$posTemp=$j;
			}
		}
		$res[]= array($first[$i]['url'],$second[$posTemp]['url'],$somiglianza);
	}

return $res;
}

function createCSVFromResult($filename,$filepath,$result){
	
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

?>