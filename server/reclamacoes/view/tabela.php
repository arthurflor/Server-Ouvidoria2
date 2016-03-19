<?php

	class Tabela{
	
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
	}
?>