<?php

class ErrosGraficos{

	public function sem_resultados(){
		echo '<h3>No momento nao ha resultados para os parametros de pesquisa selecionados!<br>Tente outros valores nos parametros!</h3>';
	}

	public function permissao_negada(){
		echo '<h3>A subcategoria que voce esta tentando acessar nao faz parte da categoria desta pagina...<br>Selecione um <a href="../" class="effect-1 a_h3">dessas categorias</a> e tente gerar outro grafico!</h3>';
	}

	public function falta_parametro(){
		echo '<h3>Faltam parametros na barra de endereco...<br><a href="index.php" class="effect-1 a_h3">Tente novamente</a> com outros valores</h3>';
	}

}


?>