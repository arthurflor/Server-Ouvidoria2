<?php


class RegrasNegocioLista {

	private $idade; 
	private $genero; 
	private $email; 
	private $categoria; 
	private $bairro; 
	private $data;

		//private $resultado_consulta;
	private $bd;

	private $latitudes;
	private $longitudes;


		public function receberDados(){
			if(!isset($_POST['idade'])){
				$this->idade = false;
			} else {
				$this->idade = $_POST['idade'];
			}
			if(!isset($_POST['genero'])){
				$this->genero = false;
			} else {
				$this->genero = $_POST['genero'];
			}
			if(!isset($_POST['email'])){
				$this->email = false;
			} else {
				$this->email = $_POST['email'];
			}
			if(!isset($_POST['categoria'])){
				$this->categoria = false;
			} else {
				$this->categoria = $_POST['categoria'];
			}
			if(!isset($_POST['bairro'])){
				$this->bairro = false;
			} else {
				$this->bairro = $_POST['bairro'];
			}
			if(!isset($_POST['data'])){
				$this->data = false;
			} else {
				$this->data = $_POST['data'];
			}

			include '../../bd/bd.php';
			$this->bd = new bancoDeDados();
			$this->bd->estabelecerConexao(); //abre conexao com o BD
		}


		private function pegarStringSQL(){
			$consulta_sql = "SELECT id, user_nome, user_email, data, latitude, longitude FROM reclamacoes WHERE ";
			
			if($this->email == false){
				$consulta_sql = $consulta_sql . "user_idade = user_idade ";
			} else {
				$consulta_sql = $consulta_sql . "user_idade = '$this->idade' ";
			}
			
			if($this->genero == false){
				$consulta_sql = $consulta_sql . "AND user_genero = user_genero ";
			} else {
				$consulta_sql = $consulta_sql . "AND user_genero = '$this->genero' ";
			}
			
			if($this->email == false){
				$consulta_sql = $consulta_sql . "AND user_email = user_email ";
			} else {
				$consulta_sql = $consulta_sql . "AND user_email = '$this->email' ";
			}
			
			if($this->categoria == false){
				$consulta_sql = $consulta_sql . "AND categoria = NULL ";
			} else {
				$consulta_sql = $consulta_sql . "AND categoria = '$this->categoria' ";
			}
			/*
			if($this->bairro == false)){
				$consulta_sql = $consulta_sql . "AND  = user_idade ";
			} else {
				$consulta_sql = $consulta_sql . "AND user_idade = '$this->user_idade' ";
			}*/
			
			if($this->data == false){
				$consulta_sql = $consulta_sql . "AND data = data";
			} else {
				$consulta_sql = $consulta_sql . "AND data = '$this->data'";
			}

			return $consulta_sql;
		} 


		private function consultaAoBanco(){
			$consulta_sql = $this->pegarStringSQL();
			return $this->bd->getConn()->query($consulta_sql);
		}


		public function mostrarTodasReclamacoes(){

			$resultado_consulta = $this->consultaAoBanco();
			
			include '../view/tabela.php';
			$tabela = new Tabela();
			$tabela->imprimirCabecalho();

			while ($dados = $resultado_consulta->fetch_array()) {
				$tabela->imprimirCorpo($dados);
			}
			
			//variavel que diz a quantidade de resultados -> $resultado_consulta->num_rows
			$tabela->imprimirFim();
		}


		private function pegarDadosMapa(){
			$this->latitudes = array();
			$this->longitudes = array();

			$resultado_consulta = $this->consultaAoBanco();

			while ($dados = $resultado_consulta->fetch_array()) {
				$this->latitudes[] = $dados['latitude'];
				$this->longitudes[] = $dados['longitude'];
			}

			$this->bd->fecharConexao();
		}


		public function criarMapaReclamacoes(){
			$this->pegarDadosMapa();

			include '../view/mapa_lista_reclamacoes.php';
			$mapa = new MapaListaReclamacoes();
			$mapa->gerarMapa($this->latitudes, $this->longitudes);
		}
	}
	?>