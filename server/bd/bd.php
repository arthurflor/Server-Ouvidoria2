<?php

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

		//variavel de banco de dados
		private $conn;

		public function getConn(){
			return $this->conn;
		}

		/**
		 * Metodo que estabelece conexao com banco de dados.
		 * Retorno - 'true' para sucesso e 'false' para falha.
		 */
		public function estabelecerConexao(){
			$this->conn = new mysqli($this->servidor, $this->usuario, $this->senha, $this->banco);
			
			if ($this->conn->connect_errno) {
			    return false;
			} else {
				return true;
			}
		}

		public function fecharConexao(){
			mysqli_close($this->conn);
		}
	}

	$bd = new bancoDeDados();
	echo $bd->estabelecerConexao();	

?>