<?php 
	function findAndCompare(){
		if(isset($_POST["sito2"])){
			?> 
			<h1>Funziona</h1>
			

			<!-- QUI VANNO I RISULTATI -->

			<a href="/">Torna alla home</a>

		<?php die(); }

		
	}
?>
<html>
	<head>
		<title>Test Instilla</title>
	</head>
<body>
		<?php 
			findAndCompare();
		?>
		
	<form action="/" method="POST">
			<label for="sito1">Primo sito</label>
			<input type="text" name="sito1" >
			<label for="sito2">Primo sito</label>
			<input type="text" name="sito2" >
			<button type="submit" name="button">Invia</button>
		</form>
	
</body>
</html>