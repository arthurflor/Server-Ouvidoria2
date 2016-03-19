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
			        <td><a href="#" class="btn btn-primary">Visualizar</a></td>
			      </tr>';			
		}

		public function imprimirFim(){

			echo '</tbody>
				</table>';
		}
	}
?>