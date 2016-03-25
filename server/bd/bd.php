<?php
        /**
         * Classe responsável pela conexão de banco de dados.
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
	class bancoDeDados{
		
		/*
		//informacoes do banco de dados local
		private $servidor = "localhost";
		private $usuario = "root";
		private $senha = "iago2014";
		private $banco = "ouvidoria_app";
		*/

		private $servidor = "renanfelixrodrigues.com.br";
		private $usuario = "renan549_1";
		private $senha = "javac123";
		private $banco = "renan549_ouvidoria";

		private $conn; //variável de banco de dados
                
                /**
                 * Método que pega o valor da conexão.
                 * @return Retorna a conexão, pelo fato da mesma estar encapsulada.
                 */
		public function getConn(){
			return $this->conn;
		}

		/**
		 * Metodo que estabelece a conexão com banco de dados.
		 * @return 'true' para sucesso e 'false' para falha.
		 */
		public function estabelecerConexao(){
			$this->conn = new mysqli($this->servidor, $this->usuario, $this->senha, $this->banco);
			
			if ($this->conn->connect_errno) {
			    return false;
			} else {
				return true;
			}
		}
                /**
                 * Método que encerra a conexão com o banco de dados.
                 */
		public function fecharConexao(){
			mysqli_close($this->conn);
		}
	}

?>