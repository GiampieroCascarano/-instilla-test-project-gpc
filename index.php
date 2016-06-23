<?php 
function findAndCompare(){
	$a="primo";
	$b="secondo";
	$l1=strlen($a);
	$l2=strlen($b);
	$nparuguali=similar_text($a, $b);
	if($l1>=$l2){
		
		$perc=$nparuguali/$l1*100;
	
	}else{

		$perc=$nparuguali/$l2*100;
	
	}
	echo $perc;
?>
		<h1>Funziona</h1>		
		<!-- QUI VANNO I RISULTATI -->

		<a href="/">Torna alla home</a>
<?php } ?>
<html>
	<head>
		<title>Test Instilla</title>
	</head>
<body>
		<?php 
		if(isset($_POST["sito2"])){
			findAndCompare();
			die();
		}
		?>
		
	<form action="/" method="POST">
			<label for="sito1">Primo sito</label>
			<input type="text" name="sito1" >
			<label for="sito2">Secondo sito</label>
			<input type="text" name="sito2" >
			<button type="submit" name="button">Invia</button>
		</form>
	
</body>
</html>