<?php
	class ErrosReclamacoes{

		public function pagina_nao_existe(){
			echo '<h3>A pagina solicitada nao existe!</h3>';
		}

		public function categoria_invalida(){
			echo '<h3>A categoria solicitada e invalida!</h3>';
		}

		public function sem_registros(){
			echo '<h3>Nao foram encontradas reclamacoes de acordo com os parametros selecionados!</h3>';
		}


		public function falta_parametros(){
			echo '<h3>Faltam dados nos parametros!<br>Recarregue a pagina anterior e clique em "Visualizar" na reclamacao que deseja visualizar!</h3>';
		}

		public function reclamacao_nao_encontrada(){
			echo '<h3>A reclamacao solicitada nao existe, ela pode ter sido removida!<br>Verifique os dados e tente novamente!</h3>';
		} 

	}
?>