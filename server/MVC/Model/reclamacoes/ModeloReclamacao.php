<?php
	class ModeloReclamacao{

		private $id; //id da reclamação
		private $autor; //autor da reclamação

		private $bd;
		private $resultado_consulta;

		/**
          * Método que recebe e valida os dados passados via GET.
          * @return int - Se algum parâmetro estiver faltando, isto significa
          * que alguém alterou algum dado na barra de endereços, logo a
          * reclamação solicitada é inválida, retornando a 1; se estiver
          * tudo ok, retorna a 0.
          */
		public function pegar_dados(){
            
            if(empty($_GET['id'])){
				return 1;
			} else {
				$this->id = $_GET['id'];
			}
			if(empty($_GET['autor'])){
				return 1;
			} else {
				$this->autor = $_GET['autor'];
			}

			return 0; //tudo ok
		}



		public function validar_reclamacao(){
			include '../../MVC/Model/bd/bd.php'; //incluindo arquivo de BD
			$this->bd = new bancoDeDados(); //instanciando BD
			$this->bd->estabelecerConexao(); //abre conexão com o BD

			$consulta_sql = "SELECT * FROM reclamacoes WHERE id=$this->id AND user_nome='$this->autor'"; //consulta SQL
			$this->resultado_consulta = $this->bd->getConn()->query($consulta_sql); //execução da consulta

			if(isset($this->resultado_consulta->num_rows)){
				if($this->resultado_consulta->num_rows>0){ //os dados correspondem
                	return 0;
                }
			} else { //dados solicitados nos parâmetros não correspondem
				return 1;
			}

		}

		public function exibir_reclamacao(){

			$nome_arquivo_csv = $this->autor . $this->id; //o nome do arquivo CSV gerado
			$arquivo_csv = "id,user_nome,user_email,user_idade,user_genero,texto,data,categoria,latitude,longitude\n"; //primeira linha do CSV
			$ponteiro=fopen("../temp/". $nome_arquivo_csv.".csv","w"); //criando o CSV
		
			include '../../MVC/View/reclamacoes/Reclamacao.php';
			$reclamacao = new Reclamacao();

			while ($dados = $this->resultado_consulta->fetch_array()) {
				include '../../MVC/View/reclamacoes/mapa_reclamacao_individual.php'; //adicionado script do mapa da reclamação
				$reclamacao->imprimir_inicio_reclamacao(); //div da reclamação, com identificador para ser usado na impressão
				$reclamacao->processar_reclamacao($dados); //processando a reclamação
				$reclamacao->imprimir_reclamacao(); //imprimindo na tela a reclamação
				$reclamacao->imprimir_mapa(); //gerando o mapa da reclamação
				$arquivo_csv .= $dados['id'].','.$dados['user_nome'].','.$dados['user_email'].','.$dados['user_idade'].','.$dados['user_genero'].','.$dados['texto'].','.$dados['data'].','.$dados['categoria'].','.$dados['latitude'].','.$dados['longitude']."\n"; //escrevendo os dados da reclamação no CSV
				$exportar_para_csv = "sim";
				fwrite($ponteiro, $arquivo_csv); //escrevendo no arquivo CSV
				$reclamacao->imprimir_botoes_exportar($exportar_para_csv, $nome_arquivo_csv); //adicionando botões de exportação (CSV e impressão)		 
			}
			
		}

	}
?> 