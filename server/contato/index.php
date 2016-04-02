<?php
$titulo_da_pagina = 'Contato - Ouvidoria 2.0';
$pasta_raiz_site = '../';
$pasta_reclamacoes = '../reclamacoes/';
$pasta_graficos = '../graficos/';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../MVC/View/estrutura_site/head.php';?>
</head>
<body>

    <?php include '../MVC/View/estrutura_site/navbar.php';?>

    <div class="container-fluid text-center">    
        <div class="row content">

            <?php include '../MVC/View/estrutura_site/barra_esquerda.html';?>

            <!-- centro da página (horizontalmente falando) -->
            <div class="col-sm-10 text-left"> 
                <hr>
                <h2>Entre em contato conosco:</h2>
                <hr>
                <!-- Formulario de contato -->
                <form class="form-horizontal" role="form" method="GET" action="#">
                    <div class="row">
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="usr">Nome:</label>
                                <input type="text" class="form-control" name="nome" placeholder="Seu nome">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-10">
                            <div class="form-group">
                                <label for="usr">Mensagem:</label>
                                <textarea class="form-control" name="mensagem" rows="10"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <button class="btn btn-primary" type="submit">Enviar Mensagem</button>
                    </div>
                </form>
                <hr>
            </div>

            <?php include '../MVC/View/estrutura_site/barra_direita.html';?>

        </div>
    </div>

    <!-- fim da página -->
    <?php include '../MVC/View/estrutura_site/footer.html'; //rodape da pagina?>

</body>
</html>
