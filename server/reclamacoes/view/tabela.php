<?php

	class Tabela{
		
		private $corpo_tabela;

		public function imprimirBotoes(){
			echo '
				<hr>
				<button id="mostrar_reclamacoes" class="btn btn-primary">Visualizar Todas as Reclamacoes a Seguir</button>
			    <button id="ocultar_reclamacoes" class="btn btn-primary">Ocultar Reclamacoes</button>
				';
		}

		public function imprimirDivReclamacoes(){
			echo '<div id="reclamacao_div">';
		}

		public function imprimirFimDivReclamacoes(){
			echo '</div>';
		}

		public function imprimirInfo($total, $paginas){

			echo '<hr><h4>Foram encontradas '.$total. ' reclamacoes, tendo um total de '.$paginas.' paginas para visualizacao:</h4>';
		}
		
		private function cabecalhoTabela(){
			
			$cabecalho = '	
					<table class="table table-hover">
				    <thead>
				      	<tr>
					        <th>Autor</th>
					        <th>E-mail</th>
					        <th>Data</th>
					        <th>Bairro</th>
					        <th></th>
				      	</tr>
				    </thead>
				    <tbody>';
			return $cabecalho;
		}

		public function concatenarCorpo($dados){

			$this->corpo_tabela .= '  <tr>
								     	<td>'. $dados['user_nome'] .'</td>
								        <td>'. $dados['user_email'] .'</td>
								        <td>'. $dados['data'] .'</td>
								        <td>'. '' .'</td>
								        <td><a class="btn btn-primary" href="visualizar.php?id='.$dados['id'].'&autor='.$dados['user_nome'].'&email='.$dados['user_email'].'&data='.$dados['data'].'&lat='.$dados['latitude'].'&long='.$dados['longitude'].'">Visualizar</a></td>
								      </tr>
								      ';			
		}

		private function fimTabela(){

			$fim = '</tbody>
				</table>';
			return $fim;
		}

		public function montarTabela(){
			echo $this->cabecalhoTabela() . $this->corpo_tabela . $this->fimTabela(); 
		}

		public function imprimirPaginacao($atual, $ultimo, $itens){
			// setas: http://www.iconesbr.net/down_ico/6970/setas
			echo '<div class="row">
					<div class="col-sm-4"></div>
					<div class="col-sm-3">
						Pagina atual: '.$atual.'<br>
						<a class="btn btn-primary" href="index.php?categoria='.$_GET['categoria'].'&idade='.$_GET['idade'].'&genero='.$_GET['genero'].'&email='.$_GET['email'].'&data='.$_GET['data'].'&bairro='.$_GET['bairro'].'&pagina=1&itens='.$itens.'">Primeiro</a>
						<a href="index.php?categoria='.$_GET['categoria'].'&idade='.$_GET['idade'].'&genero='.$_GET['genero'].'&email='.$_GET['email'].'&data='.$_GET['data'].'&bairro='.$_GET['bairro'].'&pagina='. ($atual-1) .'&itens='.$itens.'"><img src="../../imagens/seta_esquerda.png" /></a>
						<a href="index.php?categoria='.$_GET['categoria'].'&idade='.$_GET['idade'].'&genero='.$_GET['genero'].'&email='.$_GET['email'].'&data='.$_GET['data'].'&bairro='.$_GET['bairro'].'&pagina='. ($atual+1) .'&itens='.$itens.'"><img src="../../imagens/seta_direita.png" /></a>
						<a class="btn btn-primary" href="index.php?categoria='.$_GET['categoria'].'&idade='.$_GET['idade'].'&genero='.$_GET['genero'].'&email='.$_GET['email'].'&data='.$_GET['data'].'&bairro='.$_GET['bairro'].'&pagina='.$ultimo.'&itens='.$itens.'">Ultimo</a>
						<br>
						Ou digite o numero da pagina que deseja: 
							<div class="form-group">
								<input type="text" class="form-control" id="pagina">
								<a class="btn btn-primary" href="index.php?categoria='.$_GET['categoria'].'&idade='.$_GET['idade'].'&genero='.$_GET['genero'].'&email='.$_GET['email'].'&data='.$_GET['data'].'&bairro='.$_GET['bairro']."&pagina=document.getElementById(\"pagina\").value".'>Ir</a>
							</div>
					</div>
				</div>';
		} //ir para pagina 'x' nao implementado

	}
?>