<html>
	<head>
		<title>Test Instilla</title>
	</head>
<body>
		<?php 
		if(isset($_POST["sito2"])){
			?><h1>Funziona</h1>
			
		<?php 
		}else{
			
		?>
		<form action="/index.php" method="POST">
			<label for="sito1">Primo sito</label>
			<input type="text" name="sito1" >
			<label for="sito2">Primo sito</label>
			<input type="text" name="sito2" >
			<button type="submit" name="button">Invia</button>
		</form>
	
	<?php } 

	?>
	
</body>
</html>