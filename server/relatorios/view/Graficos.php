<?php

class Graficos {

	private $grafico;

	private function pegarColunas(array $colunas){
		$retorno = "";

		for ($i=0; $i < count($colunas); $i++) { 
			if($i<count($colunas)-1){
				$retorno .= '"' . $colunas[$i] . '"' . ', ';
			} else {
				$retorno .= '"' . $colunas[$i] . '"';
			}
		}

		return $retorno;
	}

	private function pegarValores(array $valores){
		$retorno = "";

		for ($i=0; $i < count($valores); $i++) { 
			if($i<count($valores)-1){
				$retorno .= $valores[$i] . ', ';
			} else {
				$retorno .= $valores[$i];
			}
		}

		return $retorno;
	}

	public function construirGrafico(array $coluna_nome, array $coluna_quantidade, $tipo){

		if ($tipo==1){ //barras

			$this->grafico .=  
				'<canvas id="grafico" height="100" width="1000"></canvas>
				<script>
				var barChartData = {
					labels : ['.$this->pegarColunas($coluna_nome).'],
					datasets : [
						{
							fillColor : "rgba(151,187,205,0.5)",
							strokeColor : "rgba(151,187,205,0.8)",
							highlightFill : "rgba(151,187,205,0.75)",
							highlightStroke : "rgba(151,187,205,1)",
							data : ['.$this->pegarValores($coluna_quantidade).']
						}
					]
				}
				window.onload = function(){
					var ctx = document.getElementById("grafico").getContext("2d");
					window.myBar = new Chart(ctx).Bar(barChartData, {
						responsive : true
					});
				}
				</script>
				';


		} elseif ($tipo==2){ //pizza

		} elseif ($tipo==3){ //pontos

		} else {
			//erro na opcao do grafico
		}

		echo $this->grafico;

	}
}

?>