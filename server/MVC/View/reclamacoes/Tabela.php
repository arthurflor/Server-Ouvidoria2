<?php

	class Tabela{

		public function imprimirInfo($total, $paginas){
			echo '<hr><h4>Foram encontradas '.$total. ' reclamacoes, tendo um total de '.$paginas.' paginas para visualizacao:</h4><hr>';
		}
		
		public function imprimir_cabecalho(){
			
			echo 	'	
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
		}

		public function imprimir_corpo($dados){

			echo '  
					<tr>
					   	<td>'. $dados['user_nome'] .'</td>
					    <td>'. $dados['user_email'] .'</td>
					    <td>'. $dados['data'] .'</td>
					    <td>'. '' .'</td>
					    <td><a class="btn btn-primary" href="visualizar.php?id='.$dados['id'].'&autor='.$dados['user_nome'].'">Visualizar</a></td>
					</tr>
								      ';			
		}

		public function imprimir_fim(){

			echo '
				  </tbody>
				  </table>';
		}

		public function imprimir_paginacao($atual, $ultimo, $link){
			echo '<div class="row">
					<div class="col-sm-4"></div>
					<div class="col-sm-3">
						Pagina atual: '.$atual.'<br>
						<a class="btn btn-primary" href="?pagina=1&'.$link.'">Primeiro</a>
						<a href="?pagina='. ($atual-1) .'&'.$link.'"><img src="../../imagens/seta_esquerda.png" /></a>
						<a href="?pagina='. ($atual+1) .'&'.$link.'"><img src="../../imagens/seta_direita.png" /></a>
						<a class="btn btn-primary" href="?pagina='.$ultimo.'&'.$link.'">Ultimo</a>
						<br>
						Ou digite o numero da pagina que deseja: 
							<div class="form-group">
								<input type="text" class="form-control" id="outra_pagina">
								<button class="btn btn-primary" id="botao_outra_pagina">Ir</a>
							</div>
					</div>
				</div>';
			include '../../MVC/Model/reclamacoes/script_ir_para_pagina.html';
		}
	}
?>