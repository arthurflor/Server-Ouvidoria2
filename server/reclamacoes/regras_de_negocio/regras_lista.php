<?php


class RegrasNegocioLista {

	private $idade; 
	private $genero; 
	private $email; 
	private $categoria; 
	private $bairro; 
	private $data;

	private $bd;
	private $consulta_sql;

	private $latitudes;
	private $longitudes;

	private $categoria_da_pagina;

	public function receberDados($categoria_desta_pagina){

		$this->categoria_da_pagina = $categoria_desta_pagina;
		
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
			if($_POST['categoria']==0){ //treta no if de concatenar sql, pois 0 = false kkk
				$this->categoria = 'z';
			} else {
				$this->categoria = $_POST['categoria'];
			}
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
		$this->consulta_sql = $this->pegarStringSQL();
	}


		private function pegarStringSQL(){
			$consulta_sql = "SELECT id, user_nome, user_email, data, latitude, longitude FROM reclamacoes WHERE ";
			$contador_parametros_vazios = 0;
			$coloca_AND = false;

			if(!($this->idade == false)){
				$consulta_sql = $consulta_sql . "user_idade = $this->idade ";
				$coloca_AND = true;
			} else {
				$contador_parametros_vazios++;
			}
			
			if(!($this->genero == false)){
				if($coloca_AND==true){
					$consulta_sql .= "AND ";
				}
				$consulta_sql = $consulta_sql . "user_genero = '$this->genero' ";
				$coloca_AND = true;
			} else {
				$contador_parametros_vazios++;
			}	
			
			if(!($this->email == false)){
				if($coloca_AND==true){
					$consulta_sql .= "AND ";
				}
				$consulta_sql = $consulta_sql . "user_email = '$this->email' ";
				$coloca_AND = true;
			} else {
				$contador_parametros_vazios++;
			}

			if( (!($this->categoria == false)) && ($this->categoria != 30 && $this->categoria != 35) ) {
				if($this->categoria=='z'){
					$this->categoria = 0;//consegui entrar no if grande hehehehehehe GAMBIARRA
				}
				if($coloca_AND==true){
					$consulta_sql .= "AND ";
				}
				$consulta_sql = $consulta_sql . "categoria = $this->categoria ";
				$coloca_AND = true;
			} elseif ($this->categoria == 30 || $this->categoria == 35){ //todas as categorias
				if($this->categoria_da_pagina==1){
					if($coloca_AND==true){
						$consulta_sql .= "AND ";
					}
					$consulta_sql = $consulta_sql . "(categoria = 1 OR categoria = 2 OR categoria = 3 OR categoria = 4 OR categoria = 5 OR categoria = 6 OR categoria = 7 OR categoria = 8 OR categoria = 9 OR categoria = 10 OR categoria = 11 OR categoria = 12 OR categoria = 13 OR categoria = 14 OR categoria = 15 OR categoria = 16 OR categoria = 17) ";
					$coloca_AND = true;
				} elseif ($this->categoria_da_pagina==2) {
					if($coloca_AND==true){
						$consulta_sql .= "AND ";
					}
					$consulta_sql = $consulta_sql . "(categoria = 18 OR categoria = 19 OR categoria = 20 OR categoria = 21) ";
					$coloca_AND = true;
				}
			} else {
				$contador_parametros_vazios++;
			}
			/*
			if($this->bairro == false)){
				$consulta_sql = $consulta_sql . "AND  = user_idade ";
			} else {
				$consulta_sql = $consulta_sql . "AND user_idade = '$this->user_idade' ";
			}*/
			
			if(!($this->data == false)){
				if($coloca_AND==true){
					$consulta_sql .= "AND ";
				}
				$consulta_sql = $consulta_sql . "data = '$this->data'";
			} else {
				$contador_parametros_vazios++;
			}

			if($contador_parametros_vazios==5){ //ira contar quantos parametros estao vazios, se for igual a 5, quer dizer q nao vai precisar fazer uma consulta normal
				$consulta_sql = "SELECT id FROM reclamacoes WHERE id = -1"; //coloquei um sql qualquer para de proposito nao dar certo
			}
			
			return $consulta_sql;
		} 


		private function consultaAoBanco(){
			return $this->bd->getConn()->query($this->consulta_sql);
		}


		public function mostrarTodasReclamacoes(){
			if ($_SERVER['REQUEST_METHOD'] == 'POST'){ // se veio de POST e porque tem algo a ser listado
				$resultado_consulta = $this->consultaAoBanco();
				
				if($resultado_consulta->num_rows>0){
					include '../view/tabela.php';
					$tabela = new Tabela();
					$tabela->imprimirTitulo();
					$tabela->imprimirCabecalho();

					while ($dados = $resultado_consulta->fetch_array()) {
						$tabela->imprimirCorpo($dados);
					}
					$tabela->imprimirFim();
				}
			}
			//variavel que diz a quantidade de resultados -> $resultado_consulta->num_rows
		}


		private function pegarDadosMapa(){
			$this->latitudes = array();
			$this->longitudes = array();

			if ($_SERVER['REQUEST_METHOD'] == 'POST'){ // se veio de POST e porque tem algo a ser listado
				$resultado_consulta = $this->consultaAoBanco();

				while ($dados = $resultado_consulta->fetch_array()) {
					$this->latitudes[] = $dados['latitude'];
					$this->longitudes[] = $dados['longitude'];
				}
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