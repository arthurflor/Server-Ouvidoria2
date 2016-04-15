<?php

class ModeloGraficos{

	private $categoria_desta_pagina;

	private $categoria_escolhida;
	private $opcao_escolhida;

	private $tipo_de_grafico;

	private $coluna_nome;
	private $coluna_quantidade;
	private $bd;
	private $sql_consulta;

	private $idade1;
	private $idade2;
	private $data1;
	private $data2;


	public function receber_dados($categoria_desta_pagina){
		
		$this->categoria_da_pagina = $categoria_desta_pagina;
		$parametros_vazios = 0;

		if(empty($_GET['categoria'])){
			$parametros_vazios++;
		} else {
			$this->categoria_escolhida = $_GET['categoria'];
		}

		if(empty($_GET['opcao'])){
			$parametros_vazios++;
		} else {
			$this->opcao_escolhida = $_GET['opcao'];
		}

		if(empty($_GET['tipo_grafico'])){
			$parametros_vazios++;
		} else {
			$this->tipo_de_grafico = $_GET['tipo_grafico'];
		}

		if($parametros_vazios==2 || $parametros_vazios==1){
			return 1;
		} elseif ($parametros_vazios==3){
			return 2;
		}
/*
		if((empty($_GET['idade1'])) || (empty($_GET['idade2']))) {
			$this->idade1 = -1;
		} else {
			$this->idade1 = $_GET['idade1'];
			$this->idade2 = $_GET['idade2'];
		}
*/
		if((empty($_GET['data1'])) || (empty($_GET['data2']))) {
			$this->data1 = -1;
		} else {
			$this->data1 = $_GET['data1'];
			$this->data2 = $_GET['data2'];
		}

		return 0;		
	}


	private function pegar_string_SQL(){
		
		$autorizado = false;
		$sql = "SELECT $this->opcao_escolhida, COUNT(*) FROM  reclamacoes WHERE ";

		if($this->categoria_escolhida == 100){
			if($this->categoria_da_pagina==3){
				$this->categoria_escolhida = 0;
				$autorizado = true;
			}
		} elseif( ($this->categoria_escolhida>=1 && $this->categoria_escolhida<=17) || ($this->categoria_escolhida==30) ){
			if($this->categoria_da_pagina==1){
				$autorizado = true;
				if($this->categoria_escolhida==30){//mostrar tudo
					$sql = $sql . "(categoria = 1 OR categoria = 2 OR categoria = 3 OR categoria = 4 OR categoria = 5 OR categoria = 6 OR categoria = 7 OR categoria = 8 OR categoria = 9 OR categoria = 10 OR categoria = 11 OR categoria = 12 OR categoria = 13 OR categoria = 14 OR categoria = 15 OR categoria = 16 OR categoria = 17) ";
				} else {
					$sql.="categoria = $this->categoria_escolhida ";
				}
			}
		} elseif( ($this->categoria_escolhida>=18 && $this->categoria_escolhida<=21) || ($this->categoria_escolhida==35) ){
			if($this->categoria_da_pagina==2){
				$autorizado = true;
				if($this->categoria_escolhida==35){//mostrar tudo
					$sql = $sql . "(categoria = 18 OR categoria = 19 OR categoria = 20 OR categoria = 21) ";
				} else {
					$sql.="categoria = $this->categoria_escolhida ";
				}
			}
		}

		if($autorizado==false){
			return 1; //nao autorizado a acessar
		}
		
		if($this->data1 != -1){ //entre datas
			$sql .= "AND (data BETWEEN '$this->data1' AND '$this->data2') ";
		}

		$sql .= " GROUP BY $this->opcao_escolhida";	

		$this->sql_consulta = $sql;

		return 0;
	}


	public function processar_dados(){

		$this->coluna_quantidade = array();
		$this->coluna_valor = array();
		$contador_resultados = 0;

		include '../../MVC/Model/bd/bd.php';

		$this->bd = new bancoDeDados();
		$this->bd->estabelecerConexao();
		
		if($this->pegar_string_SQL()==1){
			return 2; //categoria nao permitida para acesso
		}

		$resultado_consulta = $this->bd->getConn()->query($this->sql_consulta);
		if(isset($resultado_consulta->num_rows)) {
			while ($dados = $resultado_consulta->fetch_array()) {
				$this->coluna_nome[] = $dados[$this->opcao_escolhida];
				$this->coluna_quantidade[] = $dados['COUNT(*)'];
				$contador_resultados++;
			}
		}

		if($contador_resultados==0){
			return 1; //nao tem resultados
		} else {
			return 0;
		}
	}

	public function construir_grafico(){
		
		include '../../MVC/View/graficos/Graficos.php';
		$graficos = new Graficos();
		$graficos->construir_grafico($this->coluna_nome, $this->coluna_quantidade, $this->tipo_de_grafico);	
		$graficos->botao_imprimir();
	}

}

?>