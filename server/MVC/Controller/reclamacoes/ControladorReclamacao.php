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
	class ControladorReclamacao{

		private $modelo_reclamacao;

		public function executar_controlador(){
			include '../../MVC/Model/reclamacoes/ModeloReclamacao.php';
			$this->modelo_reclamacao = new ModeloReclamacao();

			if($this->modelo_reclamacao->pegar_dados()==0){
				if($this->modelo_reclamacao->validar_reclamacao()==0){
					return 0;
				} else {
					return 2;
				}
			} else {
				return 1;
			}
		}

		public function solicitar_reclamacao($resultado_controlador){
			if($resultado_controlador==0){
				$this->modelo_reclamacao->exibir_reclamacao();
			} else {
				include '../../MVC/View/reclamacoes/ErrosReclamacoes.php';
				$erros = new ErrosReclamacoes();
				
				if($resultado_controlador==1){
					$erros->falta_parametros();
				} elseif($resultado_controlador==2){
					$erros->reclamacao_nao_encontrada();
				}
			}
		}
	}

?>