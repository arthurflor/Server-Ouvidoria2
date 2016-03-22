<?php
	
	class MensagensReclamacao{

		public function reclamacaoInvalida(){
			echo "<hr><h3>A reclamacao que voce esta tentando acessar e invalida ou pode ter sido removida da base de dados!</h3>";
		}

		public function faltaDados(){
			echo "<hr><h3>Os parametros passados na barra de endereco do navegador para visualizar uma reclamacao sao invalidos!</h3>";
		}

		public function inicioReclamacao(){
			echo '
				<div id="reclamacao_div">';
		}

		public function reclamacao($dados){
			
			echo 
				'	<div id="reclamacao">
					    <hr>
					    <h3>Dados da reclamacao:</h3>
					    <h4>
					        <hr>
					        <div class="row">
					            <div class="col-sm-4">
					                Autor: <strong>'.$dados['user_nome'].'</strong>
					            </div>
					            <div class="col-sm-4">
					                E-mail: <strong>'.$dados['user_email'].'</strong>
					            </div>
					            <div class="col-sm-2">
					                Idade: <strong>'.$dados['user_idade'].'</strong>
					            </div>
					            <div class="col-sm-2">
					                Genero: <strong>'.$dados['user_genero'].'</strong>
					            </div>
					        </div>
					        <hr>
					        <div class="row">
					            <div class="col-sm-1">
					                Texto: 
					            </div>
					            <div class="col-sm-11">
					                '.$dados['texto'].'
					            </div>
					        </div>
					        <hr>
					        <div class="row">
					            <div class="col-sm-2">
					                Imagem:
					            </div>
					            <div class="col-sm-10">
					                <img src="../../imagens/upload/'.$dados['imagem'].'" width="600" height="400" alt="img_reclamacao"/>
					            </div>
					        </div>
						</div>
				';
		}

		public function mapa(){
			echo '<hr>
					<div class="row">
						<div class="col-sm-2"><h4>Mapa:</h4></div>
						<div class="col-sm-10">
							<div id="googleMap" style="width:500px;height:380px;"></div>
						</div>
					</div>
				</div><!--finalizando a div do mapa-->';
		}

		public function botoesExportar(){
			echo
				'
				<hr><div class="row">
					<div class="col-sm-2"><h4>Exportar Tudo:</h4></div>
					<div class="col-sm-10">
						<button class="btn btn-primary" id="botao_imprimir">Imprimir</button>
						<button class="btn btn-primary" id="botao_CSV">CSV</button>
					</div>
				</div>
				<hr>
					';
		}

	}
?>