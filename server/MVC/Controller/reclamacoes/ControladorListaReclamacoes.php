<?php


class ControladorListaReclamacoes {

		private $modelo_lista;
		private $erros;
		/**
		*	Algoritmo deste metodo:
		*	
		*	1. Pegar todos os dados que foram passados via GET (modelo)
		*		a. Se a categoria estiver vazia, setar o valor da categoria para 'todos' da categoria correspondente;
		*		b. Se a quantidade de itens por pagina estiver vazia, setar esse valor para 10;
		*		c. Se algum atributo (exceto exportar para CSV) estiver vazio, setar para 'null';
		*		d. Se o atributo exportar para CSV estiver vazio, setar para 'nao';
		*		e. Retornar a 0.
		*		Caso retorne 0: Ir para o passo 2.
		*	
		*	2. Pegar a string SQL atraves dos dados passados via GET (modelo)
		*		a. Definir a string sql que vai servir para a consulta;
		*		c. Retornar a 0.
		*		Caso retorne 0: Ir para o passo 3.
		*	
		*	3. Executar o sql de consulta (modelo)
		*		a. Verificar quantos registros foram encontrados para dividir a paginacao;
		*		b. Pegar quantidade de registro obtidos com a consulta, para realizar a paginacao;
		*		c. Se nao obtiver registros, retornar a 1;
		*		d. Se o numero da pagina que esta sendo acessada for menor que zero ou maior que o limite maximo, retornar a 2;
		*		e. A cada vez que o while de registros rodar, fazer:
		*			i. Se exportar pra CSV estiver igual a "sim", criar arquivo .csv com cada registro encontrado;
		*			ii. Setar array's de latitudes e longitudes para uso posterior no mapa de reclamacoes;
		*			iii. Concatenar corpo da tabela em uma string;
		*			iv. Concatenar as reclamacoes.
		*		Caso retorne 0: Retornar este metodo a true;
		*	
		*	4. Tratamento de erros:
		*		i. Caso retorne 1.1: Imprimir mensagem sobre a categoria selecionada nao fazer parte da categoria de reclamacao da pagina (view);
		*		ii. Caso retorne 3.1: Imprimir mensagem na tela explicando que nao ha registros com os parametros de pesquisa selecionados (view);
		*		iii. Caso retorne 3.2: Imprimir mensagem na tela explicando que a pagina solicitada nao existe (View);
		*		
		*	Obervacao: Caso algum metodo retorne a algum valor exceto 0, retornar este metodo a false.
		**/
		public function executar_controlador($categoria_desta_pagina){
			include '../../MVC/Model/reclamacoes/ModeloListaReclamacoes.php';
			$this->modelo_lista = new ModeloListaReclamacoes();

			if($this->modelo_lista->processar_dados($categoria_desta_pagina)==0){
				if($this->modelo_lista->pegar_string_SQL()==0){
					if($this->modelo_lista->processar_consulta()==0){
						return 0;
					} else {
						return 3;
					}
				} else {
					return 2;
				}
			} else {
				return 1;
			}	
		}

		public function solicitar_tabela($resultado_controlador){
			if($resultado_controlador==0){
				$this->modelo_lista->imprimir_tabela();
			} else {
				include '../../MVC/View/reclamacoes/ErrosReclamacoes.php';
				$this->erros = new ErrosReclamacoes();

				if($resultado_controlador==1){
					$this->erros->categoria_invalida();
				} elseif ($resultado_controlador==2){
					$this->erros->sem_registros();
				} elseif ($resultado_controlador==3){
					$this->erros->pagina_nao_existe();
				}
			}
		}

		
		public function solicitar_lista($resultado_controlador){
			if($resultado_controlador==0){
				$this->modelo_lista->imprimir_lista();
			} else {
				if($resultado_controlador==1){
					$this->erros->categoria_invalida();
				} elseif ($resultado_controlador==2){
					$this->erros->sem_registros();
				} elseif ($resultado_controlador==3){
					$this->erros->pagina_nao_existe();
				}
			}
		}


		public function solicitar_mapa($resultado_controlador){
			if($resultado_controlador==0){
				$this->modelo_lista->imprimir_mapa_reclamacoes();
			} else {
				if($resultado_controlador==1){
					$this->erros->categoria_invalida();
				} elseif ($resultado_controlador==2){
					$this->erros->sem_registros();
				} elseif ($resultado_controlador==3){
					$this->erros->pagina_nao_existe();
				}
			}
		}

	}
	?>