document.getElementById('canvas_pdf').onclick = function() {
	var canvas = document.getElementById("grafico");
	var img = canvas.toDataURL("image/png");
	document.write('<img src="'+img+'"/>');
};