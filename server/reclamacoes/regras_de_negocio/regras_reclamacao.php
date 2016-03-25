<?php
	/**
         * Classe responsável pelas regras de negócio que envolvem uma reclamação
         * envolvida. 
         * @author Iago Rodrigues
         * Testes: Guto Leoni e Leylane Ferreira
         * Primeira versão estável: 0.1 (antes da primeira bateria de testes)
         * 
         * Esta classe faz parte do conjunto de arquivos que formam o servidor
         * do App da Ouvidoria do Gabinete Digital da Prefeitura Municipal de 
         * Caruaru. 
         * Sistema (app cliente e sistema de relatórios) desenvolvido pela equipe 
         * de estágio do 7º Período da Universidade de Pernambuco - Caruaru.
         * Equipe: Arthur Flôr, Guto Leoni, Iago Rodrigues, Leylane Ferreira e
         * Renan Félix.
         */
	class RegrasNegocioReclamacao{

		private $id; //id da reclamação
		private $autor; //autor da reclamação
		private $email; //email do autor da reclamação
		private $data; //data de envio da reclamação
		private $lat; //latitude do local de envio
		private $long; //longitude do local de envio

		private $bd; //variável de banco de dados

		/**
                 * Método que recebe e valida os dados passados via GET.
                 * @return boolean Se algum parâmetro estiver faltando, isto significa
                 * que alguém alterou algum dado na barra de endereços, logo a
                 * reclamação solicitada é inválida, retornando a false; se estiver
                 * tudo ok, retorna a true.
                 */
		private function verificarDadosGET(){
                        //A função empty() retorna a true se a variável solicitada estiver sem nada.
                    
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

			return true; //tudo ok
		}

		private function consultaAoBanco($consulta_sql){
			return $this->bd->getConn()->query($consulta_sql);
		}
                
                /**
                 * Método que valida uma reclamação.
                 * 
                 * Caso 1: Falta algum dado nos parâmetros GET; resultado: mostra
                 * mensagem de erro na tela, que faltam parâmetros.
                 * Caso 2: A quantidade dos dados passados por parâmetros GET estão
                 * ok, porém não correspondem a uma reclamação válida; resultado:
                 * mostra mensagem de erro na tela, que os dados passados não correspondem
                 * a uma reclamação válida.
                 * Caso 3: Está tudo ok; resultado: mostra a reclamação na tela,
                 * e é criado um arquivo CSV com os dados da reclamação, para download.
                 * 
                 * "Porque disso tudo?" -> Ok, o consumo de memória e processamento
                 * será maior, mas tem que haver uma validação dos dados para uma
                 * pessoa que só possui permissões suficientes para acessar reclamações
                 * de uma categoria Y tentar acessar uma reclamação de categoria X.
                 */
		public function validarReclamacao(){
			include '../../bd/bd.php'; //incluindo arquivo de BD
			$this->bd = new bancoDeDados(); //instanciando BD
			$this->bd->estabelecerConexao(); //abre conexão com o BD

			include '../view/mensagens_reclamacao.php'; //incluindo a classe de view de reclamação
			$mensagens = new MensagensReclamacao(); //instanciando a classe de view de reclamação
			
			if($this->verificarDadosGET()){ 
                                /*Se entrou neste if, então não falta dado, é válido tentar fazer uma consulta no BD
                                para verificar se com as informações passadas via GET estão de acordo com uma reclamação
                                válida*/
				$consulta_sql = "SELECT * FROM reclamacoes WHERE id=$this->id AND user_nome='$this->autor' AND user_email='$this->email' AND data='$this->data' AND latitude=$this->lat AND longitude=$this->long"; //consulta SQL
				$resultado_consulta = $this->consultaAoBanco($consulta_sql); //execução da consulta

				if(isset($resultado_consulta->num_rows)){
                                    //Se entrou neste if, quer dizer que as informações passadas via GET correspondem a, de fato, uma reclamação.
					if($resultado_consulta->num_rows>0){ //os dados correspondem
						$nome_arquivo_csv = $this->autor . $this->email . $this->data; //o nme do arquivo CSV gerado
						$arquivo_csv = "id,user_nome,user_email,user_idade,user_genero,texto,data,categoria,latitude,longitude\n"; //primeira linha do CSV
						$ponteiro=fopen("../temp/". $nome_arquivo_csv.".csv","w"); //criando o CSV

						while ($dados = $resultado_consulta->fetch_array()) {
							include '../view/mapa_reclamacao_individual.php'; //adicionado script do mapa da reclamação
							$mensagens->inicioReclamacao(); //div da reclamação, com identificador para ser usado na impressão
							$mensagens->reclamacao($dados); //processando a reclamação
							$mensagens->imprimirReclamacao(); //imprimindo na tela a reclamação
							$mensagens->mapa(); //gerando o mapa da reclamação
							$arquivo_csv .= $dados['id'].','.$dados['user_nome'].','.$dados['user_email'].','.$dados['user_idade'].','.$dados['user_genero'].','.$dados['texto'].','.$dados['data'].','.$dados['categoria'].','.$dados['latitude'].','.$dados['longitude']."\n"; //escrevendo os dados da reclamação no CSV
						}
						$exportar_para_csv = true;
						fwrite($ponteiro, $arquivo_csv); //escrevendo no arquivo CSV

						$mensagens->botoesExportar($exportar_para_csv, $nome_arquivo_csv); //adicionando botões de exportação (CSV e impressão)
					} 
				} else { //dados solicitados nos parâmetros não correspondem
					$mensagens->reclamacaoInvalida(); //mostra mensagem de erro correpondente na tela
				}
			} else { //faltam dados nos parâmetros
				$mensagens->faltaDados(); //mostra mensagem de erro correspondente na tela
			}
		}
	}

?>