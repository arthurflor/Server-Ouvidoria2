<?php
class ModeloListaReclamacoes{

		private $idade; //idade setada para consulta
		private $genero; //genero setado para consulta
		private $email; //email setado para consulta
		private $categoria; //subcategoria setada para consulta
		private $bairro; //bairro setado para consulta
		private $data; //data setada para consulta
		private $exportar_csv; //saber se vai exportar pra CSV
		private $nome_arquivo_csv; //nome do arquivo CSV
		private $arquivo_csv; //conteudo do arquivo CSV
		private $link_paginacao;

		private $bd; //arquivo de manipulaçao do banco de dados
		private $consulta_sql; //arquivo de consulta SQL
		private $resultado_consulta; //resultado da consulta SQL

		private $latitudes; //latitude gerado pela consulta
		private $longitudes; //longitude gerado pela consulta

		private $categoria_da_pagina; //categoria da reclamacao
		private $numero_pagina; //numero da pagina atual
		private $ultima_pagina; //numero da ultima pagina
		private $total_resultados; //quantidade total de registros encontrados na consulta
		private $quantidade_itens; //quantidade de itens a serem mostrados na pagina 


		public function processar_dados($categoria_desta_pagina){

			$this->categoria_da_pagina = $categoria_desta_pagina;
			$this->link_paginacao = '';
			
			if(!empty($_GET['idade'])){
				$this->idade = $_GET['idade'];
				$this->nome_arquivo_csv .= $_GET['idade'];
				$this->link_paginacao .= 'idade=' . $_GET['idade'] . '&';
			}

			if(!empty($_GET['genero'])){
				$this->genero = $_GET['genero'];
				$this->nome_arquivo_csv .= $_GET['genero'];
				$this->link_paginacao .= 'genero=' . $_GET['genero'] . '&';
			}
			
			if(!empty($_GET['email'])){
				$this->email = $_GET['email'];
				$this->nome_arquivo_csv .= $_GET['email'];
				$this->link_paginacao .= 'email=' . $_GET['email'] . '&';
			}
			
			if(!empty($_GET['categoria'])){
				$this->nome_arquivo_csv .= $_GET['categoria'];
				$this->link_paginacao .= 'categoria=' . $_GET['categoria'] . '&';
				$this->categoria = $_GET['categoria'];
			} else {
				if($this->categoria_da_pagina==3){ //dengue
					$this->categoria = 100;
				} elseif ($this->categoria_da_pagina==1) { //ouvidoria
					$this->categoria = 30;
				} elseif ($this->categoria_da_pagina==2) { //DH
					$this->categoria = 35;
				}
			}

			if(!empty($_GET['bairro'])){
				$this->bairro = $_GET['bairro'];
				$this->nome_arquivo_csv .= $_GET['bairro'];
				$this->link_paginacao .= 'bairro=' . $_GET['bairro'] . '&';
			}

			if(!empty($_GET['data'])){
				$this->data = $_GET['data'];
				$this->nome_arquivo_csv .= $_GET['data'];
				$this->link_paginacao .= 'data=' . $_GET['data'] . '&';
			}

			if(empty($_GET['pagina'])){ //se pagina estiver vazio, setar para a primeira
				$this->numero_pagina = 1;
				$this->nome_arquivo_csv .= '1';
			} else {
				$this->numero_pagina = $_GET['pagina'];
				$this->nome_arquivo_csv .= $_GET['pagina'];
			}

			if(empty($_GET['itens'])){
				$this->quantidade_itens = 5; //se a quantidade de intens estiver vazio, setar para 5
				$this->nome_arquivo_csv .= '5';
			} else {
				$this->quantidade_itens = $_GET['itens'];
				$this->nome_arquivo_csv .= $_GET['itens'];
				$this->link_paginacao .= 'itens=' . $_GET['itens'] . '&';
			}

			if (empty($_GET['gerar_csv'])){
				$this->exportar_csv = 'nao';
				$this->link_paginacao .= 'gerar_csv=nao&';
			} else {
				$this->exportar_csv = $_GET['gerar_csv'];
				$this->link_paginacao .= 'gerar_csv=' . $_GET['gerar_csv'] . '&';
			}

			include '../../MVC/Model/bd/bd.php';
			$this->bd = new bancoDeDados();

			return 0;
		}


		public function pegar_string_SQL() {

			$consulta_sql = "SELECT * FROM reclamacoes WHERE ";
			$coloca_AND = false;

			if(!empty($this->idade)){
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
			}

			if(!empty($this->genero)){
				if($this->genero!='t'){ //se for diferente de "todos os generos"
				if($coloca_AND==true){
					$consulta_sql .= "AND ";
				}
				$consulta_sql = $consulta_sql . "user_genero = '$this->genero' ";
			}
			$coloca_AND = true;
		}

		if(!empty($this->email)){
			if($coloca_AND==true){
				$consulta_sql .= "AND ";
			}
			$consulta_sql = $consulta_sql . "user_email = '$this->email' ";
			$coloca_AND = true;
		}

		if($this->categoria!=30 && $this->categoria!=35) {
				$autorizado = false; //iniciando a variavel de autorizacao de categoria
				
				if($this->categoria == 100){
					if($this->categoria_da_pagina==3){
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
					return 1;
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
			}
			$this->consulta_sql = $consulta_sql;

			return 0;
		}


		public function processar_consulta(){
			$this->bd->estabelecerConexao();
			$this->resultado_consulta = $this->bd->getConn()->query($this->consulta_sql); //consulta para pegar a quantidade total de dados
				
			if(isset($this->resultado_consulta->num_rows)){
				$this->total_resultados = $this->resultado_consulta->num_rows;
				$this->ultima_pagina = ceil($this->resultado_consulta->num_rows/$this->quantidade_itens);

				if($this->numero_pagina<1 || $this->numero_pagina>$this->ultima_pagina){
					return 2;
				} else {
					if($this->quantidade_itens!=1){
						$limEsq = ($this->quantidade_itens*$this->numero_pagina) - $this->quantidade_itens;
			            $limDir = ($this->quantidade_itens); //quantos itens quer

			            $this->resultado_consulta->close();
				            
			            $this->consulta_sql .= " LIMIT $limEsq , $limDir";
						$this->resultado_consulta = $this->bd->getConn()->query($this->consulta_sql); //consulta para pegar dados por pagina
					} else {
						$this->ultima_pagina = 1;
					}
					//iniciando arrays de latitude e longitude
					$this->latitudes = array(); 
					$this->longitudes = array();

					if(!strcmp($this->exportar_csv, "nao")){ //se nao for pra exportar pra CSV, entao blz, nao vai criar arquivo
						while ($dados = $this->resultado_consulta->fetch_array()) {
							$this->latitudes[] = $dados['latitude']; // pegando latitude
							$this->longitudes[] = $dados['longitude']; //pegando longitude
						}
					} else {
						$this->arquivo_csv = "id,user_nome,user_email,user_idade,user_genero,texto,data,categoria,latitude,longitude\n";
						$ponteiro=fopen("../temp/". $this->nome_arquivo_csv.".csv","w");
						while ($dados = $this->resultado_consulta->fetch_array()) {
							$this->latitudes[] = $dados['latitude']; // pegando latitude
							$this->longitudes[] = $dados['longitude']; //pegando longitude
							$this->arquivo_csv .= $dados['id'].','.$dados['user_nome'].','.$dados['user_email'].','.$dados['user_idade'].','.$dados['user_genero'].','.$dados['texto'].','.$dados['data'].','.$dados['categoria'].','.$dados['latitude'].','.$dados['longitude']."\n";
						}
						fwrite($ponteiro, $this->arquivo_csv);
					}
					$this->resultado_consulta->data_seek(0);
				}

				return 0; 
			} else {
				return 1;
			}
		}


		public function imprimir_tabela(){
			include '../../MVC/View/reclamacoes/Tabela.php';
			$tabela = new Tabela();
			
			$tabela->imprimirInfo($this->total_resultados, $this->ultima_pagina);	
			$tabela->imprimir_cabecalho();
			
			while($dados = $this->resultado_consulta->fetch_array() ){
				$tabela->imprimir_corpo($dados);
			}
			$this->resultado_consulta->data_seek(0);

			$tabela->imprimir_fim();
			$tabela->imprimir_paginacao($this->numero_pagina, $this->ultima_pagina, $this->link_paginacao);
		} 


		public function imprimir_lista(){
			include '../../MVC/View/reclamacoes/Reclamacao.php';
			$reclamacoes = new Reclamacao();
			
			$reclamacoes->imprimir_botoes_exportar($this->exportar_csv, $this->nome_arquivo_csv);
			$reclamacoes->imprimir_inicio_reclamacao();

			while($dados = $this->resultado_consulta->fetch_array() ){
				$reclamacoes->processar_reclamacao($dados);
			}

			$reclamacoes->imprimir_reclamacao();
			$reclamacoes->imprimir_fim_reclamacao();
		}


		public function imprimir_mapa_reclamacoes(){
			include '../../MVC/View/reclamacoes/MapaListaReclamacoes.php';
			$mapa = new MapaListaReclamacoes();
			$mapa->gerar_mapa($this->latitudes, $this->longitudes);
		}
	}
?>