<?php

class Graficos {

	private $grafico;

	/* Extraido de http://stackoverflow.com/questions/5614530/generating-a-random-hex-color-code-with-php */
	private function rand_color() {
	    return '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
	}

	private function pegar_colunas(array $colunas){
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

	private function pegar_valores(array $valores){
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

	private function pegar_dados_pizza(array $valores, array $colunas){

		$saida = '';

		for($i=0; $i<count($valores); $i++){
			if($i<count($valores)-1){
				$saida .= '{
								value: '.$valores[$i].',
								color:"'.$this->rand_color().'",
								highlight: "#FF5A5E",
								label: "'.$colunas[$i].'"
							},';
			} else {
				$saida .= '{
								value: '.$valores[$i].',
								color: "'.$this->rand_color().'",
								highlight: "#FF5A5E",
								label: "'.$colunas[$i].'"
							}';	
			}
		}					
		
		return $saida;					
	}

	public function construir_grafico(array $coluna_nome, array $coluna_quantidade, $tipo){

		if ($tipo==1){ //barras
			$this->grafico .= '<h3>Grafico gerado:</h3><br>';
			$this->grafico .=  
				'<div id="reclamacao_div">
					<canvas id="grafico" height="400" width="1000"></canvas>
				</div>
				<script>
					var barChartData = {
					labels : ['.$this->pegar_colunas($coluna_nome).'],
					datasets : [
						{
							fillColor : "rgba(50,205,50,0.7)",
							strokeColor : "rgba(50,205,50,0.8)",
							highlightFill : "rgba(50,205,50,0.75)",
							highlightStroke : "rgba(50,205,50,1)",
							data : ['.$this->pegar_valores($coluna_quantidade).']
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
			$this->grafico .= '<h3>Grafico gerado:</h3><br>';
			$this->grafico .= 
				'<div id="reclamacao_div">
					<canvas id="grafico" height="400" width="1000"/>
				</div>

				<script>

					var pieData = [
							'.$this->pegar_dados_pizza($coluna_quantidade, $coluna_nome).'

						];

					window.onload = function(){
						var ctx = document.getElementById("grafico").getContext("2d");
						window.myPie = new Chart(ctx).Pie(pieData);
					};
				</script>';
		} elseif ($tipo==3){ //pontos
			$this->grafico .= '<h3>Grafico gerado:</h3><br>';
			$this->grafico .=
				'<div id="reclamacao_div">
					<canvas id="grafico" height="400" width="1000"></canvas>
				</div>


				<script>
					var randomScalingFactor = function(){ return Math.round(Math.random()*100)};
					var lineChartData = {
						labels : ['.$this->pegar_colunas($coluna_nome).'],
						datasets : [
							{
								label: "My First dataset",
								fillColor : "rgba(50,205,50,0.2)",
								strokeColor : "rgba(50,205,50,1)",
								pointColor : "rgba(50,205,50,1)",
								pointStrokeColor : "#fff",
								pointHighlightFill : "#fff",
								pointHighlightStroke : "rgba(50,205,50,1)",
								data : ['.$this->pegar_valores($coluna_quantidade).']
							}
						]

					}

					window.onload = function(){
						var ctx = document.getElementById("grafico").getContext("2d");
						window.myLine = new Chart(ctx).Line(lineChartData, {
							responsive: true
						});
					}
				</script>';
		} else { //erro, forcar pra gerar tipo 1 de grafico
			$tipo = 1;
			$this->construir_grafico($coluna_nome, $coluna_quantidade, $tipo);
		}

		echo $this->grafico;
	}

	public function botao_imprimir(){
		echo '<br><a class="btn btn-primary" id="canvas_pdf">Imprimir Grafico</a>';
	}
}

?>