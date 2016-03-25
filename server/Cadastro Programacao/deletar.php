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

	if(isset($_POST['opcao'])){
		
		$id = $_POST['opcao'];
		
		$sql = "delete from atracao where id = ".$id;
		
		if(mysqli_query($conn,$sql)){
			echo "Deletado com sucesso!";
		}
		else{
			echo "Erro ao deletar!";
		}
		
		
    }
	else{
		echo "checkbox não marcado! <br/>";
	}

?>

 <form action = "index.php" method = "post">

	<br><input style="min-width:100px;" class="btn btn-primary"  type="submit" value="Cadastrar +">
 
 </form>
 
<form action = "listar.php" method = "post">

	<input style="min-width:100px;" class="btn btn-success"  type="submit" value="Listar">
 
 </form>
 
 
</body>

</html>
