<?php
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
        <script src="../../js/opcao_imprimir.js">
        </script>
        
        <?php
            include '../view/footer.html'; //rodape da pagina
        ?>

    </body>
</html>
