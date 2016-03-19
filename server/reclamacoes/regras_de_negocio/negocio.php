<?php

	
	class NegocioDH {

		private $idade; 
		private $genero; 
		private $email; 
		private $categoria; 
		//private $bairro = "bairro"; 
		private $data;
		
		//private $resultado_consulta;
		private $bd;

		private $latitudes;
		private $longitudes;


		public function receberDados($idadeC, $generoC, $emailC, $categoriaC, $bairroC, $dataC){
			$this->idade = $idadeC;
			$this->genero = $generoC;
			$this->email = $emailC;
			$this->categoria = $categoriaC;
			$this->bairro = $bairroC;
			$this->data = $dataC;

			include '../../bd/bd.php';
			$this->bd = new bancoDeDados();
			$this->bd->estabelecerConexao(); //abre conexao com o BD
		}


		private function pegarStringSQL(){
			$consulta_sql = "SELECT user_nome, user_email, data, latitude, longitude FROM reclamacoes WHERE ";
			
			if($this->idade == false){
				$consulta_sql = $consulta_sql . "user_idade = user_idade ";
			} else {
				$consulta_sql = $consulta_sql . "user_idade = '$this->idade' ";
			}
			
			if($this->genero == false){
				$consulta_sql = $consulta_sql . "AND user_genero = user_genero ";
			} else {
				$consulta_sql = $consulta_sql . "AND user_genero = '$this->genero' ";
			}
			
			if($this->email == false){
				$consulta_sql = $consulta_sql . "AND user_email = user_email ";
			} else {
				$consulta_sql = $consulta_sql . "AND user_email = '$this->email' ";
			}
			
			if($this->categoria == false){
				$consulta_sql = $consulta_sql . "AND categoria = NULL ";
			} else {
				$consulta_sql = $consulta_sql . "AND categoria = '$this->categoria' ";
			}
			/*
			if($this->bairro == false)){
				$consulta_sql = $consulta_sql . "AND  = user_idade ";
			} else {
				$consulta_sql = $consulta_sql . "AND user_idade = '$this->user_idade' ";
			}*/
			
			if($this->data == false){
				$consulta_sql = $consulta_sql . "AND data = data";
			} else {
				$consulta_sql = $consulta_sql . "AND data = '$this->data'";
			}

			return $consulta_sql;
		} 


		private function consultaAoBanco(){
			$consulta_sql = $this->pegarStringSQL();
			return $this->bd->getConn()->query($consulta_sql);
		}


		public function mostrarTodasReclamacoes(){

			$resultado_consulta = $this->consultaAoBanco();
			
			include '../view/tabela.php';
			$tabela = new Tabela();
			$tabela->imprimirCabecalho();

			while ($dados = $resultado_consulta->fetch_array()) {
				$tabela->imprimirCorpo($dados);
			}
			
			//variavel que diz a quantidade de resultados -> $resultado_consulta->num_rows
			$tabela->imprimirFim();
		}


		private function pegarDadosMapa(){
			$this->latitudes = array();
			$this->longitudes = array();

			$resultado_consulta = $this->consultaAoBanco();

			while ($dados = $resultado_consulta->fetch_array()) {
				$this->latitudes[] = $dados['latitude'];
				$this->longitudes[] = $dados['longitude'];
			}

			$this->bd->fecharConexao();
		}


		public function criarJSONMapa(){
			$this->pegarDadosMapa();

			$escrita = '[
			';
			for ($i=0; $i < count($this->latitudes) ; $i++) { 
				if($i<count($this->latitudes)-1){
					$escrita .= '{
						"Latitude": ' . $this->latitudes[$i] . ',
						"Longitude": ' . $this->longitudes[$i] . '
					},';
				} else {
					$escrita .= '{
						"Latitude": ' . $this->latitudes[$i] . ',
						"Longitude": ' . $this->longitudes[$i] . '
					}
					]';
				}
			}

			$fp = fopen("pontos.json", "w");
 			$escreve = fwrite($fp, $escrita);
			fclose($fp);
		}
	}
?>