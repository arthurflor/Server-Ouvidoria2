<?php


class RegrasNegocioLista {

	private $idade; 
	private $genero; 
	private $email; 
	private $categoria; 
	private $bairro; 
	private $data;
	private $arquivo_csv;
	private $exportar_csv;
	private $nome_arquivo_csv;

	private $bd;
	private $consulta_sql;

	private $latitudes;
	private $longitudes;

	private $categoria_da_pagina;
	private $numero_pagina;
	private $ultima_pagina;
	private $total_resultados;
	private $quantidade_itens;

	private $todas_reclamacoes;

	private $reclamacao;
	private $tabela;

	private $resultado_processamento_dados;

	public function receberDados($categoria_desta_pagina){

		$this->categoria_da_pagina = $categoria_desta_pagina;
		
		if(!isset($_GET['idade'])){
			$this->idade = false;
		} else {
			$this->idade = $_GET['idade'];
			$this->nome_arquivo_csv .= $_GET['idade'];
		}
		if(!isset($_GET['genero'])){
			$this->genero = false;
		} else {
			$this->genero = $_GET['genero'];
			$this->nome_arquivo_csv .= $_GET['genero'];
		}
		if(!isset($_GET['email'])){
			$this->email = false;
		} else {
			$this->email = $_GET['email'];
			$this->nome_arquivo_csv .= $_GET['email'];
		}
		if(!isset($_GET['categoria'])){
			$this->categoria = false;
		} else {
			$this->categoria = $_GET['categoria'];
			$this->nome_arquivo_csv .= $_GET['categoria'];
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
			$this->nome_arquivo_csv .= $_GET['bairro'];
		}
		if(!isset($_GET['data'])){
			$this->data = false;
		} else {
			$this->data = $_GET['data'];
			$this->nome_arquivo_csv .= $_GET['data'];
		}


		if (!isset($_GET['pagina'])){
			$this->numero_pagina = 1;
			$this->nome_arquivo_csv .= 1;
		} else {
			$this->numero_pagina = $_GET['pagina'];
			$this->nome_arquivo_csv .= $_GET['pagina'];
		}
		if (!isset($_GET['itens'])){
			$this->quantidade_itens = 5;
		} else {
			$this->quantidade_itens = $_GET['itens'];
			$this->nome_arquivo_csv .= $_GET['itens'];
		}
		if (!isset($_GET['gerar_csv'])){
			$this->exportar_csv = false;
		} else {
			$this->exportar_csv = true;
		}

		include '../../bd/bd.php';
		$this->bd = new bancoDeDados();
		$this->bd->estabelecerConexao(); //abre conexao com o BD
		$this->consulta_sql = $this->pegarStringSQL();

	}

	private function pegarStringSQL(){

		$consulta_sql = "SELECT * FROM reclamacoes WHERE ";
		$contador_parametros_vazios = 0;
		$coloca_AND = false;

		if(!($this->idade == false)){
			if($this->idade==1){
				$consulta_sql = $consulta_sql . "(user_idade BETWEEN 0 AND 150) ";
			} elseif($this->idade==2){
				$consulta_sql = $consulta_sql . "(user_idade BETWEEN 0 AND 11) ";
			} elseif($this->idade==3){
				$consulta_sql = $consulta_sql . "(user_idade BETWEEN 12 AND 17) ";	
			} elseif($this->idade==4){
				$consulta_sql = $consulta_sql . "(user_idade BETWEEN 18 AND 25) ";
			} elseif($this->idade==5){
				$consulta_sql = $consulta_sql . "(user_idade BETWEEN 26 AND 35) ";
			} elseif($this->idade==6){
				$consulta_sql = $consulta_sql . "(user_idade BETWEEN 36 AND 50) ";
			} elseif($this->idade==7){
				$consulta_sql = $consulta_sql . "(user_idade BETWEEN 50 AND 150) ";
			}
			$coloca_AND = true;
		} else {
			$contador_parametros_vazios++;
		}

		if(!($this->genero == false)){
			if($this->genero!='t'){
				if($coloca_AND==true){
					$consulta_sql .= "AND ";
				}
				$consulta_sql = $consulta_sql . "user_genero = '$this->genero' ";
				$coloca_AND = true;
			}
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
				$consulta_sql = "SELECT * FROM reclamacoes"; 
			} else {
				$resultado_consulta = $this->consultaAoBanco($consulta_sql);
				
				if(isset($resultado_consulta->num_rows)){
					$this->total_resultados = $resultado_consulta->num_rows;
					$this->ultima_pagina = ceil($resultado_consulta->num_rows/$this->quantidade_itens);
				} else {
					return false;
				}
				if($this->numero_pagina==0){
					$this->numero_pagina = 1;
				} elseif($this->numero_pagina==$this->ultima_pagina+1){
					$this->numero_pagina = $this->ultima_pagina;
				}

				if($this->quantidade_itens!=1){
					$limEsq = ($this->quantidade_itens*$this->numero_pagina) - $this->quantidade_itens;
		            $limDir = ($this->quantidade_itens); //quantos itens quer

		            $consulta_sql .= " LIMIT $limEsq , $limDir";
		        } else {
		        	$this->ultima_pagina = 1;
		        }
		        
		        return $consulta_sql;
		    }
		} 


		private function consultaAoBanco($consulta){
			return $this->bd->getConn()->query($consulta);
		}


		public function processarDados(){
			if ($_SERVER['REQUEST_METHOD'] == 'GET'){ // se veio de GET e porque tem algo a ser listado

				$this->latitudes = array();
				$this->longitudes = array();

				if($this->consulta_sql==false){
					return false;
				} else {
					
					include '../view/tabela.php';
					$this->tabela = new Tabela();
					
					include '../view/mensagens_reclamacao.php';
					$this->reclamacao = new MensagensReclamacao();
				

					$resultado_consulta = $this->consultaAoBanco($this->consulta_sql);
					if(isset($resultado_consulta->num_rows)) {
						if($this->exportar_csv==false){
							while ($dados = $resultado_consulta->fetch_array()) {
								$this->tabela->concatenarCorpo($dados); //pegando os dados e colocando na tabela
								$this->todas_reclamacoes .= $this->reclamacao->reclamacao($dados); //concatenando as reclamacoes
								$this->latitudes[] = $dados['latitude']; // pegando latitude
								$this->longitudes[] = $dados['longitude']; //pegando longitude
							}
						} else {
							$this->arquivo_csv = "id,user_nome,user_email,user_idade,user_genero,texto,data,categoria,latitude,longitude\n";
							$ponteiro=fopen("temp/". $this->nome_arquivo_csv.".csv","w");
							while ($dados = $resultado_consulta->fetch_array()) {
								$this->tabela->concatenarCorpo($dados); //pegando os dados e colocando na tabela
								$this->todas_reclamacoes .= $this->reclamacao->reclamacao($dados); //concatenando as reclamacoes
								$this->latitudes[] = $dados['latitude']; // pegando latitude
								$this->longitudes[] = $dados['longitude']; //pegando longitude
								$this->arquivo_csv .= $dados['id'].','.$dados['user_nome'].','.$dados['user_email'].','.$dados['user_idade'].','.$dados['user_genero'].','.$dados['texto'].','.$dados['data'].','.$dados['categoria'].','.$dados['latitude'].','.$dados['longitude']."\n";
							}
							fwrite($ponteiro, $this->arquivo_csv);
						}

					}
					return true;
				}
			}
			//variavel que diz a quantidade de resultados -> $resultado_consulta->num_rows
		}

		public function gerarTabela(){
			$this->resultado_processamento_dados = $this->processarDados();

			if($this->resultado_processamento_dados==true){
				$this->tabela->imprimirInfo($this->total_resultados, $this->ultima_pagina);
				$this->tabela->montarTabela();
				$this->tabela->imprimirPaginacao($this->numero_pagina, $this->ultima_pagina, $this->quantidade_itens);
			} else {
				//retornar mensagem de erro
				return false;
			}

		}

		public function listarReclamacoes(){

			if($this->resultado_processamento_dados==true){
				$this->reclamacao->botoesExportar($this->exportar_csv, $this->nome_arquivo_csv);
				$this->tabela->imprimirDivReclamacoes();
				echo $this->todas_reclamacoes;
				$this->tabela->imprimirFimDivReclamacoes();
				//$this->reclamacao->botoesExportar($this->exportar_csv, $this->nome_arquivo_csv);
			} else {
				//retornar mensagem de erro
				return false;
			}
		}

		public function criarMapaReclamacoes(){
			
			include '../view/mapa_lista_reclamacoes.php';
			$mapa = new MapaListaReclamacoes();
			$mapa->gerarMapa($this->latitudes, $this->longitudes);
		}
	}
	?>