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
				



<?php

include "conexao.php";

$sql = "SELECT * FROM atracao ORDER BY data ASC, hora ASC";


$result = mysqli_query($conn,$sql);

 echo 
 "
 <form action='deletar.php' method='post'>
 <table border='1'>
 <tr>
	<th>ID</th>
	<th>NOME</th>
	<th>DATA</th>
	<th>HORA</th>
 </tr>";

 while($row = mysqli_fetch_array($result))
 {
 echo "<tr>";
 echo "<td>  <input type='radio' name='opcao' value= '" . $row['id'] . "'> </td>";
 echo "<td>" . $row['nome'] . " </td>";
 echo "<td>" . $row['data'] . " </td>";
 echo "<td>" . $row['hora'] . " </td>";
 echo "</tr>";
 }
 echo "</table>
 <br>
 <input class='btn btn-danger' type='submit' value='Deletar'> 
 </form>
 
  <form action = 'index.php' method = 'post'>

	<input style='min-width:100px;' class='btn btn-primary'  type='submit' value='Cadastrar +' >
 
 </form>
 
 
 
 ";

?>



</body>
</html>