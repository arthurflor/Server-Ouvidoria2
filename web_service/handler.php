<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ouvidoriabd";

$texto = $_POST["texto"];
$categoria = $_POST["categoria"];
$latitude = $_POST["latitude"];
$longitude = $_POST["longitude"];
$data = $_POST["data"];
if(isset($_POST["imagem"])){ $imagem = $_POST["imagem"]; }else{ $imagem = null;}

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
		$img_url = "imagens/".$last_id.".jpg";
			
		

		try{
			//convertendo imagem para arquivo... Tratar pra caso o HD do servidor esteja cheio :D
			$ifp = fopen($img_url, "wb"); 
			$img = explode(',', $imagem);
			fwrite($ifp, base64_decode($img[1])); 
			fclose($ifp); 
			$real_path = realpath($img_url);
			if($real_path != false){
				
				$real_path = addslashes($real_path);	
				$sql2 = "UPDATE reclamacoes SET imagem='$real_path' WHERE id=$last_id";
				if ($conn->query($sql2) === TRUE) {
					echo "ok";
				} else {
					echo "Error atualizando endereço da imagem no servidor " . $conn->error;
				}
			
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