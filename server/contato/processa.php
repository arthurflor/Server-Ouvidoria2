<?php
	
	$nome = $_POST['nome'];
	$mensagem = $_POST['mensagem'];

	if(empty($nome) || empty($mensagem)){
		header("Location: ../contato/");
	} else {
		$caminho_arquivo = 'temp/' . $nome . date('D/M/Y');
		move_uploaded_file($_FILES['arquivo']['tmp_name'], $caminho_arquivo);
	}
?>