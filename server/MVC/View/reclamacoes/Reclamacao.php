<?php
	
	class Reclamacao{

		private $reclamacoes;

		public function imprimir_inicio_reclamacao(){
			echo '
				<div id="reclamacao_div">';
			$this->reclamacao = '';
		}

		public function imprimir_fim_reclamacao(){
			echo '
					</div>';
		}

		public function processar_reclamacao($dados){
			
			$this->reclamacao .= '
					<div id="reclamacao">
					    <hr>
					    <h1>Dados da reclamacao:</h1>
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
					    </h4>
					</div>
					<hr>
				';
		}

		public function imprimir_mapa(){
			echo '
					<div class="row">
						<div class="col-sm-2"><h4>Mapa:</h4></div>
						<div class="col-sm-10">
							<div id="googleMap" style="width:500px;height:380px;"></div>
						</div>
					</div>';
		}

		public function imprimir_botoes_exportar($exportar_csv, $nome_arquivo_csv){
			echo
				'
				<hr><div class="row">
					<div class="col-sm-2"><h4>Exportar Tudo:</h4></div>
					<div class="col-sm-10">
						<button class="btn btn-primary" id="botao_imprimir">Imprimir</button>
						';
			
			if(!strcmp($exportar_csv,"sim")) {
				echo '
				<a class="btn btn-primary" href="../temp/'.$nome_arquivo_csv.'.csv" id="botao_CSV">CSV</a>
				';
			}
			
			echo '
					</div>
				</div>
				<hr>
					';
		}

		public function imprimir_reclamacao(){
			echo $this->reclamacao;
		}

	}
?>