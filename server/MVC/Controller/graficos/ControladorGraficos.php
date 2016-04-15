<?php

class ControladorGraficos {

	private $modelo;
	private $erros;

	public function iniciar_controlador($categoria_desta_pagina){

		include '../../MVC/Model/graficos/ModeloGraficos.php';
		$this->modelo = new ModeloGraficos();

		include '../../MVC/View/graficos/ErrosGraficos.php';
		$this->erros = new ErrosGraficos();

		$recebe_dados = $this->modelo->receber_dados($categoria_desta_pagina);

		if($recebe_dados==0){
			$processa_dados = $this->modelo->processar_dados();
			
			if($processa_dados==0) {
				$this->modelo->construir_grafico(); //tudo ok, constroi grafico
			} elseif($processa_dados==1) {
				$this->erros->sem_resultados();
			} else {
				$this->erros->permissao_negada();
			}

		} elseif($recebe_dados==1) {
			$this->erros->falta_parametro();
		}


	}

}

?>