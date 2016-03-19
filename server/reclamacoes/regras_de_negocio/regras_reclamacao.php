<?php
	
	class RegrasNegocioReclamacao{

		private $id;
		private $autor;
		private $email;
		private $data;
		private $lat;
		private $long;

		private $bd;

		//se algum dado estiver faltando, retorna false
		private function verificarDadosGET(){

			if(empty($_GET['id'])){
				return false;
			} else {
				$this->id = $_GET['id'];
			}
			if(empty($_GET['autor'])){
				return false;
			} else {
				$this->autor = $_GET['autor'];
			}
			if(empty($_GET['email'])){
				return false;
			} else {
				$this->email = $_GET['email'];
			}
			if(empty($_GET['data'])){
				return false;
			} else {
				$this->data = $_GET['data'];
			}
			if(empty($_GET['lat'])){
				return false;
			} else {
				$this->lat = $_GET['lat'];
			}
			if(empty($_GET['long'])){
				return false;
			} else {
				$this->long = $_GET['long'];
			}	

			return true;
		}

		private function consultaAoBanco($consulta_sql){
			return $this->bd->getConn()->query($consulta_sql);
		}

		public function validarReclamacao(){
			include '../../bd/bd.php';
			$this->bd = new bancoDeDados();
			$this->bd->estabelecerConexao(); //abre conexao com o BD

			include '../view/mensagens_reclamacao.php';
			$mensagens = new MensagensReclamacao();
			
			if($this->verificarDadosGET()){ //nao falta dado
				$consulta_sql = "SELECT * FROM reclamacoes WHERE id=$this->id AND user_nome='$this->autor' AND user_email='$this->email' AND data='$this->data' AND latitude=$this->lat AND longitude=$this->long";
				$resultado_consulta = $this->consultaAoBanco($consulta_sql);

				if($resultado_consulta->num_rows>0){ //os dados correspondem
					while ($dados = $resultado_consulta->fetch_array()) {
						$mensagens->reclamacao($dados);
					}
				} else { //nao correspondem
					$mensagens->reclamacaoInvalida();
				}
			} else { //falta dado, imprime mensagem de erro na tela
				$mensagens->faltaDados();
			}
		}
	}

?>