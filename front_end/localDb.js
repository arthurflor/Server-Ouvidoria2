//----------------------------------------------------------------------------------------
//
// gerenciador de banco de dados local
//
//----------------------------------------------------------------------------------------

//inserir dados - Evento chamado ao clicar em um botão com id 'save_button'
$(document).ready(function(){
	$("#save_button").click(function(){
		insertCall();
	});
});

$(document).ready(function(){
	$("#sav_env_button").click(function(){
 		var s = ($("#Form_0").serialize());
		postRequest(event.target.value, s);
		
	});
});



function insertCall(){
	
	
		var dataArray = $("#Form_0").serializeArray(),
			len = dataArray.length,
			dataObj = {};

		for (i=0; i<len; i++) {
		  dataObj[dataArray[i].name] = dataArray[i].value;
		}
		console.log(dataObj);
	
			insert(dataObj["categoria"], dataObj["texto"], dataObj["latitude"], dataObj["longitude"], dataObj["data"], dataObj["imagem"], dataObj["anonimo"]);
			//select();
	
	
	
}


function insert(categoria, texto, latitude, longitude, data, imagem, anonimo){

	try{
		var db = openDatabase('mydb', '1.0', 'Test DB', 2 * 1024 * 1024);

		db.transaction(function (tx) {
			tx.executeSql('CREATE TABLE IF NOT EXISTS reclamacoes (id INTEGER PRIMARY KEY ASC, categoria, texto, latitude, longitude, data, imagem, anonimo, status)');
			tx.executeSql('INSERT INTO reclamacoes (categoria, texto, latitude, longitude, data, imagem, anonimo, status) VALUES (?, ?, ?, ?, ?, ?, ?, 0)', [categoria, texto, latitude, longitude, data, imagem, anonimo]);
		});
	}catch(e){
		alert(e);
	}
	
}
//fim de inserir dados


//Deletar dados	
function deleteRec(id){

	try{
		var db = openDatabase('mydb', '1.0', 'Test DB', 2 * 1024 * 1024);

		db.transaction(function (tx) {
			tx.executeSql('DELETE FROM reclamacoes WHERE id=?', [id]);
			if(id != 0) select(); // Deleta apenas caso o formulário não tenha id = 0, que é o formulário de inserção
		});
	}catch(e){
		alert(e);
	}
	
}
//Fim de deletar dados


//Inicio de select 
function select(){
	
	try{
		
		
		var db = openDatabase('mydb', '1.0', 'Test DB', 2 * 1024 * 1024);
		var html = [];
		
		document.getElementById("result").innerHTML = "<img src='progressbar.gif' height='30' width='30'>Carregando lista...";
		
		db.transaction(function (tx) {
			
			
			tx.executeSql('CREATE TABLE IF NOT EXISTS reclamacoes (id INTEGER PRIMARY KEY ASC, categoria, texto, latitude, longitude, data, imagem, anonimo, status)');
			tx.executeSql('SELECT * FROM reclamacoes', [], function (tx, results) {
				
				var len = results.rows.length, i;
				for (i = 0; i < len; i++) {

				html += "<form id='form_"+results.rows.item(i).id+"'>"
				+ "<input name='id' type='text' value='"+ results.rows.item(i).id +"'><br>"
				+ "<input name='categoria' type='text' value='"+ results.rows.item(i).categoria +"'>"
				+ "<input name='texto' type='text' value='"+ results.rows.item(i).texto +"'>"
				+ "<input name='latitude' type='text' value='"+ results.rows.item(i).latitude + "'>"
				+ "<input name='longitude' type='text' value='" + results.rows.item(i).longitude + "'>"
				//+ "<input name='data' type='text' value='"+ results.rows.item(i).data +"'>"
				+ "<input name='imagem' type='text' value='"+ results.rows.item(i).imagem +"'>"
				+ "<input name='anonimo' type='text' value='"+ results.rows.item(i).anonimo +"'>"
				+ "<img src='"+results.rows.item(i).imagem+"' height='50' width='50' >"
				+ "<button name='del_button' value='"+ results.rows.item(i).id +"' type='button' class='teste' >Deletar</button>"
				+ "<button name='env_button' value='"+ results.rows.item(i).id +"' type='button'>Enviar</button>"
				+ "</form>";


		
			}
			
			document.getElementById("result").innerHTML = html;
			
			$("button").click(function(event){
		
				var s = ($("#form_"+event.target.value).serialize());
				//console.log('teste:' + s);
				
				if(event.target.name == "del_button"){	
					deleteRec(event.target.value);
				}
				if(event.target.name == "env_button" && event.target.value > 0){	
					
					postRequest(event.target.value, s);
				}
				
			
			});   
			
			});
			
			
			
		});
	}catch(e){
		alert(e);
	}
	
}



//----------------------------------------------------------------------------------------
//
// Gerenciador de requisição Post
//
//----------------------------------------------------------------------------------------

function postRequest(id, sendData){
		
		var d = new Date();
		var userData="";
				
		//adcionando data
		sendData+= "&data=" + d.getFullYear() + "-" + (d.getMonth()+1) + "-" + d.getDate();
		
		if(!(sendData.indexOf("anonimo=true") > -1)){
			if(localStorage.getItem('nome') != null) userData += "&nome="+localStorage.getItem('nome');
			if(localStorage.getItem('email') != null) userData += "&email="+localStorage.getItem('email');
			if(localStorage.getItem('idade') != null) userData += "&idade="+localStorage.getItem('idade'); 
			if(localStorage.getItem('genero') != null)userData += "&genero="+localStorage.getItem('genero'); 

			//alert(userData);
			sendData+= userData;
			
		}
		//var webService = "http://renanfelixrodrigues.com.br/ouvidoria/server.php"; // Teste remoto
		var webService = "../web_service/handler.php"; // Teste local
		
		//alert("Post data: " + sendData);
		document.getElementById("result").innerHTML = "<img src='progressbar.gif' height='30' width='30'>Enviando dados...";
		
		//
		//Checa se é anonimo ou não
		//
		//Adiciona os parametros restantes no sendData
		//
		
		$.ajax({
		type: "POST",
		url: webService,
		data: sendData,
		success: function(response){
		
			
			alert("Resposta do servidor: " + response);
			if(response == "ok"){
				deleteRec(id);
				document.getElementById("result").innerHTML = "Sucesso!";
			}else{
				document.getElementById("result").innerHTML = "Erro ao tentar inserir dados. Tem certeza que o formato dos dados estão corretos?";
			}
		},
		error: function(e) {
			alert("Resposta do servidor: " + response);
			//called when there is an error
			alert("Erro ao enviar menssagem! Requisição: " + id);
			console.log("erro: " + id);
			if(id == 0){
				
				alert("inserir no banco");
				//inserir no banco de dados
				insertCall();
				document.getElementById("result").innerHTML = "Erro!";
			
			}else{
				select();
			}
		}
	});
		
		
	
}


	
//----------------------------------------------------------------------------------------
//
// CONVERSOR DE IMAGEM PARA BASE64 POR HereChen
// Retirado de: https://gist.github.com/HereChen/e173c64090bea2e2fa51 no dia 10/03/2016
//
//----------------------------------------------------------------------------------------
	
/**
 * version1: convert online image
 * @param  {String}   url
 * @param  {Function} callback
 * @param  {String}   [outputFormat='image/png']
 * @author HaNdTriX
 * @example
    convertImgToBase64('http://goo.gl/AOxHAL', function(base64Img){
        console.log('IMAGE:',base64Img);
    })
 */
function convertImgToBase64(url, callback, outputFormat){
    var img = new Image();
    img.crossOrigin = 'Anonymous';
    img.onload = function(){
        var canvas = document.createElement('CANVAS');
        var ctx = canvas.getContext('2d');
        canvas.height = this.height;
        canvas.width = this.width;
        ctx.drawImage(this,0,0);
        var dataURL = canvas.toDataURL(outputFormat || 'image/png');
        callback(dataURL);
        canvas = null; 
    };
    img.src = url;
}
