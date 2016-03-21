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
	private $numero_pagina;
	private $ultima_pagina;
	private $total_resultados;

	public function receberDados($categoria_desta_pagina){

		$this->categoria_da_pagina = $categoria_desta_pagina;
		
		if(!isset($_GET['idade'])){
			$this->idade = false;
		} else {
			$this->idade = $_GET['idade'];
		}
		if(!isset($_GET['genero'])){
			$this->genero = false;
		} else {
			$this->genero = $_GET['genero'];
		}
		if(!isset($_GET['email'])){
			$this->email = false;
		} else {
			$this->email = $_GET['email'];
		}
		if(!isset($_GET['categoria'])){
			$this->categoria = false;
		} else {
			$this->categoria = $_GET['categoria'];
			if($_GET['categoria']!=0){
				$this->categoria = $_GET['categoria'];
			} else {
				$this->categoria = 100; //dengue
			}
		}
		if(!isset($_GET['bairro'])){
			$this->bairro = false;
		} else {
			$this->bairro = $_GET['bairro'];
		}
		if(!isset($_GET['data'])){
			$this->data = false;
		} else {
			$this->data = $_GET['data'];
		}


		if (!isset($_GET['pagina'])){
			$this->numero_pagina = 1;
		} else {
			$this->numero_pagina = $_GET['pagina'];
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

			if( !($this->categoria == false) && ($this->categoria!=30 && $this->categoria!=35) ) {
				$autorizado = false;

				if($this->categoria == 100){
					if($this->categoria_da_pagina==0){
						$this->categoria = 0;
						$autorizado = true;
					}
				} elseif($this->categoria>=1 && $this->categoria<=17){
					if($this->categoria_da_pagina==1){
						$autorizado = true;
					}
				} elseif($this->categoria>=18 && $this->categoria<=21){
					if($this->categoria_da_pagina==2){
						$autorizado = true;
					}
				}
				
				if($autorizado==true){	
					if($coloca_AND==true){
						$consulta_sql .= "AND ";
					}
					$consulta_sql = $consulta_sql . "categoria = $this->categoria ";
					$coloca_AND = true;
				} else {
					$contador_parametros_vazios++;
				}
			} elseif ($this->categoria == 30){ //todas as categorias
				if($this->categoria_da_pagina==1){
					if($coloca_AND==true){
						$consulta_sql .= "AND ";
					} 
					$consulta_sql = $consulta_sql . "(categoria = 1 OR categoria = 2 OR categoria = 3 OR categoria = 4 OR categoria = 5 OR categoria = 6 OR categoria = 7 OR categoria = 8 OR categoria = 9 OR categoria = 10 OR categoria = 11 OR categoria = 12 OR categoria = 13 OR categoria = 14 OR categoria = 15 OR categoria = 16 OR categoria = 17) ";
					$coloca_AND = true;
				}
			} elseif($this->categoria == 35){ 
				if ($this->categoria_da_pagina==2) {
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
				return false; //coloquei um sql qualquer para de proposito nao dar certo
			} else {
				$resultado_consulta = $this->consultaAoBanco($consulta_sql);
				$this->total_resultados = $resultado_consulta->num_rows;
				$this->ultima_pagina = ceil($resultado_consulta->num_rows/10);

	            if($this->numero_pagina==0){
	            	$this->numero_pagina = 1;
	            } elseif($this->numero_pagina==$this->ultima_pagina+1){
	            	$this->numero_pagina = $this->ultima_pagina;
	            }

				$limEsq = (10*$this->numero_pagina) - 10;
	            $limDir = (10*$this->numero_pagina);

				$consulta_sql .= " LIMIT $limEsq , $limDir";

				return $consulta_sql;
			}
		} 


		private function consultaAoBanco($consulta){
			return $this->bd->getConn()->query($consulta);
		}


		public function mostrarTodasReclamacoes(){
			$sucesso = false;

			if ($_SERVER['REQUEST_METHOD'] == 'GET'){ // se veio de POST e porque tem algo a ser listado

				if($this->consulta_sql==false){
					//nao tem nada nos parametros
				} else {
					$resultado_consulta = $this->consultaAoBanco($this->consulta_sql);
					
					if($resultado_consulta->num_rows>0){
						include '../view/tabela.php';
						$tabela = new Tabela();
						$tabela->imprimirInfo($this->total_resultados, $this->ultima_pagina);
						$tabela->imprimirCabecalho();

						while ($dados = $resultado_consulta->fetch_array()) {
							$tabela->imprimirCorpo($dados);
						}
						$tabela->imprimirFim();
						$tabela->imprimirPaginacao($this->numero_pagina, $this->ultima_pagina);
					}
				}
			}
			//variavel que diz a quantidade de resultados -> $resultado_consulta->num_rows
		}


		private function pegarDadosMapa(){
			$this->latitudes = array();
			$this->longitudes = array();

			if ($_SERVER['REQUEST_METHOD'] == 'GET'){ // se veio de POST e porque tem algo a ser listado
				
				if($this->consulta_sql==false){
					//nao tem nada nos parametros
				} else {
					$resultado_consulta = $this->consultaAoBanco($this->consulta_sql);

					while ($dados = $resultado_consulta->fetch_array()) {
						$this->latitudes[] = $dados['latitude'];
						$this->longitudes[] = $dados['longitude'];
					}
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