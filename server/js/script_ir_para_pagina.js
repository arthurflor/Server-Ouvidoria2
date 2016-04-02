
            /**
             * Funçao retirada de: http://stackoverflow.com/questions/901115/how-can-i-get-query-string-values-in-javascript
             * Serve para pegar um valor de algum parametro GET 
             */
              function getParameterByName(name, url) {
                if (!url) url = window.location.href;
                url = url.toLowerCase(); // This is just to avoid case sensitiveness  
                name = name.replace(/[\[\]]/g, "\\$&").toLowerCase();// This is just to avoid case sensitiveness for query parameter name
                var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
                results = regex.exec(url);
                if (!results) return null;
                if (!results[2]) return '';
                return decodeURIComponent(results[2].replace(/\+/g, " "));
              }

              function irPara(){
                var valor_text_box = document.getElementById("outra_pagina").value;
                var link = "index.php?";

                var array_parametros = ["categoria","idade","genero","email","data","bairro","pagina","itens","gerar_csv"];
                
                for (var i = 0; i < array_parametros.length; i++) {
                  var parametro = getParameterByName(array_parametros[i]);
                  if(parametro) {
                    link += array_parametros[i] + '=' + parametro + "&"; 
                  }
                };

                link += 'pagina=' + valor_text_box;
                //alert(link);
                window.location = link;
              }

              $(document).ready(function(){
                $('#botao_outra_pagina').click(function(){
                 irPara();
               });
              });