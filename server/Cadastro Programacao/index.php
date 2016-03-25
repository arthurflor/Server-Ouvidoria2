<html>
 <head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	
	<title>Cadastro</title> 
	
		<link rel="stylesheet" href="../css/bootstrap.min.css">
        <!-- Esse style abaixo é para mudar a cor de alguns componentes, vem por padrão -->
        <link rel="stylesheet" href="../css/newStyle.css">
	
	</head>
				<body>
					
						
							<div class="panel panel-default">
							
								<div  class="panel-heading">
									<h2 class="panel-title"> Preencha os dados da atração: </h2>
								</div>
								
								
								<div class="row">
									<div class="col-md-2">
										<form action="salvar.php" method="post">
							
											<label>Digite o nome da atração: </label> 
											<input type="text" id="nome1" name="nome" style="min-width:300px;" required><br>
											
											<label>Selecione a data da atração: </label>
											<input type="date" id="data1" name="data" style="min-width:300px;" required><br> 
											
											<label>Selecione a hora da atração: </label>
											<input type="time" id="hora1" name="hora" style="min-width:300px;" required><br> 
											
											<br><input class="btn btn-success"  type="submit" value="Cadastrar">
										
										</form>
									</div>
									
										
								</div>
							
							
					
							</div>
						
					
					<form action="listar.php" method="post">
					
						<input class="btn btn-primary" type="submit" value="Listar">
					
					
					</form>
					
				</body> 

</html>