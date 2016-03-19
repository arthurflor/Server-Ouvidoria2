<?php
    session_start(); //inicia sessão, para verificação de login
    include '../regras_de_negocio/erros_php.php'; //mostra os erros de php da pagina
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
            include '../view/head.html'; //cabecalho
        ?>
        <script src="http://maps.googleapis.com/maps/api/js"></script>
        
    </head>
    <body>
        
        <?php
            include '../view/navbar.html'; //navbar (menu)
        ?>

        <div class="container-fluid text-center">    
            <div class="row content">
                
                <?php
                    include '../view/barra_esquerda.html';
                ?>
                
                <!-- Centro da página (horizontalmente falando) ira listar as reclamaçoes -->
                <div class="col-sm-10 text-left">
                    <p class="newFont" align="justify">
                        <?php
                        	include '../regras_de_negocio/regras_reclamacao.php';
		                    $negocio = new RegrasNegocioReclamacao();
		                    $negocio->validarReclamacao();
                        ?>
                    </p>
                </div>
                
                <?php
                    include '../view/barra_direita.html';
                ?>
            </div>
        </div>
        
        
        <!-- Esse script manda o conteúdo de uma div para impressão-->
        <script>
            document.getElementById('id_do_button').onclick = function() {
                var conteudo = document.getElementById('id_da_div').innerHTML,
                    tela_impressao = window.open('about:blank');

                tela_impressao.document.write(conteudo);
                tela_impressao.window.print();
                tela_impressao.window.close();
            };
        </script>
        
        <?php
            include '../view/footer.html'; //rodape da pagina
        ?>

    </body>
</html>
