//script baseado na resposta da resoluçao do problema http://stackoverflow.com/questions/5940963/jquery-show-and-hide-divs-based-on-radio-button-click
$(document).ready(function() {
	$("div.desc").hide(); //esconde as divs da classe desc
	$("input[name$='opcao']").click(function() {
		var test = $(this).val(); //variavel 'test' e o valor do radio button selecionado
		$("div.desc").hide(); //esconde as divs da classe desc
		$("#div_opcao_" + test).show(); //vai mostrar a div de acordo com a opcao selecionada
	});
});