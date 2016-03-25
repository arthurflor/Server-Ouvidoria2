<html>
 <head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	
	<title>Exemplo Imput type = date.</title> 
	
		<link rel="stylesheet" href="../css/bootstrap.min.css">
        <!-- Esse style abaixo é para mudar a cor de alguns componentes, vem por padrão -->
        <link rel="stylesheet" href="../css/newStyle.css">
	
	</head>
	<body>
					


<?php

	include "conexao.php";
	
	$nome = $_POST["nome"];
	$data = $_POST["data"];
	$hora = $_POST["hora"];


	$sql = "INSERT INTO atracao (nome, data, hora)
	VALUES ('$nome', '$data', '$hora')";

if (mysqli_query($conn, $sql)) {
    echo "Atracao cadastrada com sucesso!";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>

 <form action = "index.php" method = "post">

	<br><input style="min-width:100px;" class="btn btn-primary"  type="submit" value="Cadastrar +">
 
 </form>
 
<form action = "listar.php" method = "post">

	<input style="min-width:100px;" class="btn btn-success"  type="submit" value="Listar">
 
 </form>

	</body>
	</html>