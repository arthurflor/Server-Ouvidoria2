<?php

//--------------------------
// Informações do banco
//--------------------------
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ouvidoriabd";
//--------------------------
// Informações do banco
//--------------------------



if(isset($_POST["texto"])){ $texto = $_POST["texto"]; }else{ $texto = "";}
if(isset($_POST["categoria"])){ $categoria = $_POST["categoria"]; }else{ $categoria = -1;}
if(isset($_POST["endereco"])){ $endereco = $_POST["endereco"]; }else{ $endereco = "";}
if(isset($_POST["data"])){ $data = $_POST["data"]; }else{ $data = "2000-01-01";}
if(isset($_POST["imagem"])){ $imagem = $_POST["imagem"]; }else{ $imagem = null;}
if(isset($_POST["latitude"]) && ($_POST["longitude"])){ 
	$latitude = $_POST["latitude"];
	$longitude = $_POST["longitude"];
}else{
	
        $prepAddr = str_replace(' ','+',$endereco);
        $geocode=file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=false');
        $output= json_decode($geocode);
        $latitude = $output->results[0]->geometry->location->lat;
        $longitude = $output->results[0]->geometry->location->lng;
		
}



if(isset($_POST["idade"])){ $idade = $_POST["idade"]; }else{ $idade = 0;}
if(isset($_POST["nome"])){ $nome = $_POST["nome"]; }else{ $nome = null;}
if(isset($_POST["email"])){ $email = $_POST["email"]; }else{ $email = null;}
if(isset($_POST["genero"])){ $genero = $_POST["genero"]; }else{ $genero = null;}



// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


$sql = "INSERT INTO `reclamacoes`(`user_nome`, `user_email`, `user_idade`, `user_genero`, `texto`, `data`, `categoria`, `latitude`, `longitude`)
		VALUES ('$nome','$email','$idade','$genero','$texto','$data','$categoria','$latitude','$longitude')";

if ($conn->query($sql) === TRUE) {
    if($imagem != null){

		//inserção com imagem
		$last_id = $conn->insert_id;
		$img_url = $last_id.".jpg";
			
		

		try{
			//convertendo imagem para arquivo... Tratar pra caso o HD do servidor esteja cheio :D
			$ifp = fopen("../server/imagens/upload/".$img_url, "wb"); 
			$img = explode(',', $imagem);
			fwrite($ifp, base64_decode($img[1])); 
			fclose($ifp); 
			//$real_path = realpath($img_url);
				
				$sql2 = "UPDATE reclamacoes SET imagem='$img_url' WHERE id=$last_id";
				if ($conn->query($sql2) === TRUE) {
					echo "ok";
				} else {
					echo "Error atualizando endereço da imagem no servidor " . $conn->error;
				}
			
		}catch(Exception $e){
			echo 'Erro em conversão da imagem: ',  $e->getMessage(), "\n";
		}
			
		
	}else{
		//Inserção sem imagem
		echo "ok";
				
	}

	
	
} else {
    echo "Erro na inserção no banco de dados: " . $sql . " / " . $conn->error;
}

$conn->close();
?>