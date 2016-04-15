<?php
    include '../../MVC/Model/erros_php/erros_php.php'; //mostra os erros de php da pagina

    $titulo_da_pagina = 'Graficos - SISGD 1.0 - Ouvidoria 2.0';
    $pasta_raiz_site = '../';
    $pasta_reclamacoes = '../';
    $pasta_graficos = '../graficos/';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
       <?php include '../MVC/View/estrutura_site/head.php'; //cabecalho ?>
    </head>
    <body>
        
        <?php include '../MVC/View/estrutura_site/navbar.php'; //navbar (menu) ?>
        
        <div class="container-fluid text-center">    
            <div class="row content">
                
                <?php include '../MVC/View/estrutura_site/barra_esquerda.html'; ?>
                
                <!-- centro da página (horizontalmente falando) -->
                <div class="col-sm-10 text-left"> 
                    <hr>
                    <h2>Graficos - Escolha uma categoria:</h2>
                    <hr>
                    <h3><a href="direitos_humanos/" class="effect-1 a_h3">Direitos Humanos</a></h3>
                    <h3><a href="focos_de_dengue/" class="effect-1 a_h3">Focos de Dengue</a></h3>
                    <h3><a href="ouvidoria/" class="effect-1 a_h3">Ouvidoria</a></h3>
                    <hr>
                </div>
                
                <?php include '../MVC/View/estrutura_site/barra_direita.html'; ?>

            </div>
        </div>
        
        <?php include '../MVC/View/estrutura_site/footer.html'; //rodape da pagina ?>

    </body>
</html>
