<?php
	
	class MensagensReclamacao{

		public function reclamacaoInvalida(){
			echo "<hr><h3>A reclamacao que voce esta tentando acessar e invalida ou pode ter sido removida da base de dados!</h3>";
		}

		public function faltaDados(){
			echo "<hr><h3>Os parametros passados na barra de endereco do navegador para visualizar uma reclamacao sao invalidos!</h3>";
		}

		public function reclamacao($dados){
			include '../view/mapa_reclamacao_individual.php';
			echo 
				'
				<div id="reclamao_div">
					<hr>
					<h2>Dados da reclamacao:</h2>
					<h3>
					<hr>
					<div class="row">
						<div class="col-sm-3">
							Autor: <strong>'.$dados['user_nome'].'</strong>
						</div>
						<div class="col-sm-3">
							E-mail: <strong>'.$dados['user_email'].'</strong>
						</div>
						<div class="col-sm-3">
							Idade: <strong>'.$dados['user_idade'].'</strong>
						</div>
						<div class="col-sm-3">
							Genero: <strong>'.$dados['user_genero'].'</strong>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-sm-12">
							Texto: '.$dados['texto'].'
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-sm-12">
							Imagem:<br> <img src="../../'.$dados['imagem'].'" width="600" height="400" alt="img_reclamacao"/>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-sm-12">
							Mapa:<br>
							<div id="googleMap" style="width:500px;height:380px;"></div>
						</div>
					</div>
					</h3>
					<hr>
				</div>
				';
		}

		public function botoesExportar(){

		}

	}
?>