<?php

class RegrasNegocioRelatorio {

	private $categoria_da_pagina;

	private $opcao_escolhida;
	private $categoria_escolhida;
	private $tipo_de_grafico = 1;
	private $idade1;
	private $idade2;
	private $data1;
	private $data2;

	private $bd;
	private $sql_consulta;

	private $coluna_nome;
	private $coluna_quantidade;

	public function receberDados($categoria_desta_pagina){
		if ($_SERVER['REQUEST_METHOD'] == 'GET'){ 
			$this->categoria_da_pagina = $categoria_desta_pagina;

			if(!isset($_GET['categoria'])){
				$this->categoria_escolhida = -1;
			} else {
				$this->categoria_escolhida = $_GET['categoria'];
			}

			if(!isset($_GET['opcao'])){
				$this->opcao_escolhida = -1;
			} else {
				$this->opcao_escolhida = $_GET['opcao'];
			}

			if((empty($_GET['idade1'])) || (empty($_GET['idade2']))) {
				$this->idade1 = -1;
			} else {
				$this->idade1 = $_GET['idade1'];
				$this->idade2 = $_GET['idade2'];
			}

			if((empty($_GET['data1'])) || (empty($_GET['data2']))) {
				$this->data1 = -1;
			} else {
				$this->data1 = $_GET['data1'];
				$this->data2 = $_GET['data2'];
			}

			include '../../bd/bd.php';

			$this->quantidade_informacoes = 0;
		}
	}

	private function pegarStringSQL(){
		if($this->categoria_escolhida==-1 || $this->opcao_escolhida==-1){
			return false;
		} else {
			$sql = "SELECT $this->opcao_escolhida, COUNT(*) FROM  reclamacoes WHERE categoria = $this->categoria_escolhida ";
			if($this->data1!= -1){ //entre datas
				$sql .= "AND (data BETWEEN '$this->data1' AND '$this->data2') ";
			}
			if($this->idade1!= -1){ //entre idades
				$sql .= "AND (user_idade BETWEEN $this->idade1 AND $this->idade2) ";
			}
			$sql .= " GROUP BY $this->opcao_escolhida";	
		}
		echo $sql;
		return $sql;
	}

	public function processarDados(){
		
		$this->coluna_quantidade = array();
		$this->coluna_valor = array();

		$this->bd = new bancoDeDados();
		$this->bd->estabelecerConexao();
		$this->sql_consulta = $this->pegarStringSQL();
		
		if($this->sql_consulta!=false){
			$resultado_consulta = $this->bd->getConn()->query($this->sql_consulta);
			if(isset($resultado_consulta->num_rows)) {
				while ($dados = $resultado_consulta->fetch_array()) {
					$this->coluna_nome[] = $dados[$this->opcao_escolhida];
					$this->coluna_quantidade[] = $dados['COUNT(*)'];
				}
			} else {
				return false;
			}
		} else {
			return false; 
		}
	}

	public function construirGrafico(){
		if(count($this->coluna_quantidade)>0){
			include '../view/Graficos.php';
			$graficos = new Graficos();
			$graficos->construirGrafico($this->coluna_nome, $this->coluna_quantidade, $this->tipo_de_grafico);	
		} else {
			echo 'nao';
		}
	}

}

?>