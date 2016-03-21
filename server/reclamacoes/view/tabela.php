<?php

	class Tabela{
		
		public function imprimirTitulo(){
			echo '<hr>
                        <h4>Resultados:</h4> ';
		}

		public function imprimirCabecalho(){
			
			echo '<table class="table table-hover">
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
		}

		public function imprimirCorpo($dados){

			echo '<tr>
			     	<td>'. $dados['user_nome'] .'</td>
			        <td>'. $dados['user_email'] .'</td>
			        <td>'. $dados['data'] .'</td>
			        <td>'. '' .'</td>
			        <td><a class="btn btn-primary" href="visualizar.php?id='.$dados['id'].'&autor='.$dados['user_nome'].'&email='.$dados['user_email'].'&data='.$dados['data'].'&lat='.$dados['latitude'].'&long='.$dados['longitude'].'">Visualizar</a></td>
			      </tr>';			
		}

		public function imprimirFim(){

			echo '</tbody>
				</table>';
		}

		public function imprimirInfo($total, $paginas){

			echo '<hr><h4>Foram encontradas '.$total. ' reclamacoes, tendo um total de '.$paginas.' paginas para visualizacao:</h4>';
		}

		public function imprimirPaginacao($atual, $ultimo){
			// setas: http://www.iconesbr.net/down_ico/6970/setas
			echo '<div class="row">
					<div class="col-sm-4"></div>
					<div class="col-sm-3">
						<a class="btn btn-primary" href="index.php?categoria='.$_GET['categoria'].'&idade='.$_GET['idade'].'&genero='.$_GET['genero'].'&email='.$_GET['email'].'&data='.$_GET['data'].'&bairro='.$_GET['bairro'].'&pagina=1">Primeiro</a>
						<a href="index.php?categoria='.$_GET['categoria'].'&idade='.$_GET['idade'].'&genero='.$_GET['genero'].'&email='.$_GET['email'].'&data='.$_GET['data'].'&bairro='.$_GET['bairro'].'&pagina='. ($atual-1) .'"><img src="../../imagens/seta_esquerda.png" /></a>
						<a href="index.php?categoria='.$_GET['categoria'].'&idade='.$_GET['idade'].'&genero='.$_GET['genero'].'&email='.$_GET['email'].'&data='.$_GET['data'].'&bairro='.$_GET['bairro'].'&pagina='. ($atual+1) .'"><img src="../../imagens/seta_direita.png" /></a>
						<a class="btn btn-primary" href="index.php?categoria='.$_GET['categoria'].'&idade='.$_GET['idade'].'&genero='.$_GET['genero'].'&email='.$_GET['email'].'&data='.$_GET['data'].'&bairro='.$_GET['bairro'].'&pagina='.$ultimo.'">Ultimo</a>
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