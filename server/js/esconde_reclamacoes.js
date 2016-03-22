            $(document).ready(function(){
                $("#reclamacao_div").hide();
                $("#ocultar_reclamacoes").hide();

                $("#mostrar_reclamacoes").click(function(event){
                    event.preventDefault();
                    $("#reclamacao_div").show();
                    $("#ocultar_reclamacoes").show();
                    $("#mostrar_reclamacoes").hide();
                });
                $("#ocultar_reclamacoes").click(function(event){
                    event.preventDefault();
                    $("#reclamacao_div").hide();
                    $("#ocultar_reclamacoes").hide();
                    $("#mostrar_reclamacoes").show();
                });
            });