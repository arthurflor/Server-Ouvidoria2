<?php
$titulo_da_pagina = 'Página Inicial - SISGD 1.0 - Ouvidoria 2.0';
$pasta_raiz_site = '';
$pasta_reclamacoes = 'reclamacoes/';
$pasta_graficos = 'graficos/';
?>
<!DOCTYPE html>
<html lang="en">
<!-- ESSA PÁGINA E TODAS AS OUTRAS DESTE SISTEMA TEM O TEMPLATE DA W3SCHOOLS -->
<!-- página inicial -->
<head>
    <?php include 'MVC/View/estrutura_site/head.php';?>
</head>
<body>
	<?php include 'MVC/View/estrutura_site/navbar.php';?>
    <div class="container-fluid text-center">    
       <div class="row content">

          <?php include 'MVC/View/estrutura_site/barra_esquerda.html'; ?>

            <!-- centro da página (horizontalmente falando) -->
            <div class="col-sm-10 text-left">
            	<hr>
            	<h1>Bem vindo ao SISGD!</h1> 
            	<hr>
            	<h3>Va ate a <a href="reclamacoes/" class="effect-1 a_h3">pagina de reclamacoes</a> para visualiza-las.</h3>
            	<hr>
                <h3>Ou se preferir, <a href="graficos/" class="effect-1 a_h3">visualize graficos</a>.</h3>
            	<hr>
            </div>

            <?php include 'MVC/View/estrutura_site/barra_direita.html'; ?>
        </div>
    </div>

    <?php include 'MVC/View/estrutura_site/footer.html'; ?>

</body>
</html>