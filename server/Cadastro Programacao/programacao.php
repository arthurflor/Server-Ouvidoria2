<html>
 <head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	
	<title>Programacao</title> 
	
		<link rel="stylesheet" href="../css/bootstrap.min.css">
        <!-- Esse style abaixo é para mudar a cor de alguns componentes, vem por padrão -->
        <link rel="stylesheet" href="../css/newStyle.css">

	
	</head>
	<body>
	
	
				<div class="jumbotrom">
				<div class="container">
					<h1>Programação do São João!</h1>
					<p>Algum texto aqui...</p>
			    </div>
				</div>
	
	
	
	<?php
	
			
			include "conexao.php";
			
			$sql = "SELECT * FROM atracao ORDER BY data ASC, hora ASC";
			$result = mysqli_query($conn,$sql);
			
			$data =	date('d/m/Y',strtotime("10 September 2000"));
			$dia = 0;
			
			while($row = mysqli_fetch_array($result)){
				
				if($data != $row['data']){
					
					$data = $row['data'];
					$dia++;
					
					echo "
					
					<div class = 'panel panel-default'>
					<div class = 'panel-heading'>
						<h3>Dia ".$dia." (".date('d/m', strtotime($data)).")</h3>
					</div>
					
					</div>
					
					";
					
					echo $row['nome']." - ".date('h:i', strtotime($row['hora']))."<br>";
					
				}
				
				else{
					
					echo $row['nome']." - ".date('h:i', strtotime($row['hora']))."<br>";
					
				}
			}// fim do while
						
	?>
	
    </body>
	
</html>
