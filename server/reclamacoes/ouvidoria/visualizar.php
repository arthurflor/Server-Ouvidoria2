<?php
    include '../../MVC/Model/erros_php/erros_php.php'; //mostra os erros de php da pagina

    $titulo_da_pagina = 'Reclamacao da Ouvidoria - Ouvidoria 2.0';
    $pasta_raiz_site = '../../';
    $pasta_reclamacoes = '../';
    $pasta_graficos = '../../graficos/';

    include '../../MVC/Controller/reclamacoes/ControladorReclamacao.php';
    $controlador = new ControladorReclamacao();
    $retorno_controlador = $controlador->executar_controlador();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include '../../MVC/View/estrutura_site/head.php'; //cabecalho ?>
        <script src="http://maps.googleapis.com/maps/api/js"></script>
    </head>
    <body>
        
        <?php include '../../MVC/View/estrutura_site/navbar.php'; //navbar (menu) ?>

        <div class="container-fluid text-center">    
            <div class="row content">
                
                <?php include '../../MVC/View/estrutura_site/barra_esquerda.html'; ?>

                <!-- Centro da página (horizontalmente falando) ira listar as reclamaçoes -->
                <div class="col-sm-10 text-left">
                    <p class="newFont" align="justify">
                        <?php $controlador->solicitar_reclamacao($retorno_controlador); ?>
                    </p>
                </div>
                
                <?php include '../../MVC/View/estrutura_site/barra_direita.html'; ?>

            </div>
        </div>
        
        <!-- Esse script manda o conteúdo de uma div para impressão-->
        <script src="../../js/opcao_imprimir.js"></script>
        
        <?php include '../../MVC/View/estrutura_site/footer.html'; //rodape da pagina ?>

    </body>
</html>