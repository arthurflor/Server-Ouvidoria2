<?php

class RegrasNegocioRelatorio {

	private $categoria_da_pagina;

	private $opcao_escolhida;
	private $categoria_escolhida;

	private $bd;

	private $coluna_nome;
	private $coluna_valor;

	public function receberDados($categoria_desta_pagina){
		if ($_SERVER['REQUEST_METHOD'] == 'GET'){ 
			$this->categoria_da_pagina = $categoria_desta_pagina;

			if(!isset($_GET['categoria'])){
				$this->categoria_escolhida = false;
			} else {
				$this->categoria_escolhida = $_GET['categoria'];
			}

			if(!isset($_GET['opcao'])){
				$this->opcao_escolhida = false;
			} else {
				$this->opcao_escolhida = $_GET['opcao'];
			}

			include '../../bd/bd.php';
			$this->pegarStringSQL();
		}
	}

	private function pegarStringSQL(){
		if($this->categoria_escolhida==false){
			return false;
		} else {
			if($this->opcao_escolhida==false){
				return false;
			} else {
				//ok, ate aqui tudo bem
				if(!strcmp($this->opcao_escolhida, "user_idade")){
					//se for idade vai tratar de um jeito, por causa da faixa etaria
				} else {
					$sql = "SELECT $this->opcao_escolhida, COUNT(*) FROM  reclamacoes GROUP BY $this->opcao_escolhida";
				}
			}
		}

		return $sql;
	}

	public function processarDados(){
		
		$this->coluna_nome = array();
		$this->coluna_valor = array();

		$this->bd = new bancoDeDados();
		$this->bd->estabelecerConexao();
		$sql = $this->pegarStringSQL();
		
		if($sql!=false){
			$resultado_consulta = $this->bd->getConn()->query($sql);
			if(isset($resultado_consulta->num_rows)) {
				while ($dados = $resultado_consulta->fetch_array()) {
					$this->coluna_nome[] = $dados[$this->opcao_escolhida];
					$this->coluna_valor[] = $dados['COUNT(*)'];
				}
			} else {
				return false;
			}
		} else {
			return false; 
		}
	}

	public function construirGrafico(){
		
	}

}

?>