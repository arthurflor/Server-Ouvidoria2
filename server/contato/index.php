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
                <h2>Envie-<a class="a_h1" href="../sobre/">nos</a> sugestoes e/ou criticas:</h2>
                <hr>
                <!-- Formulario de contato -->
                <form class="form-horizontal" role="form" method="POST" action="processa.php">
                    <div class="row">
                        <div class="col-sm-10">
                            <div class="form-group">
                                <label for="usr">Nome:</label>
                                <input type="text" class="form-control" name="nome" placeholder="Seu nome. (Obrigatorio)" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-10">
                            <div class="form-group">
                                <label for="usr">Mensagem:</label>
                                <textarea maxlength="500" class="form-control" placeholder="Sua mensagem. Maximo de 500 Caracteres. (Obrigatorio)" name="mensagem" rows="6" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-10">
                            <div class="form-group">
                                <label for="usr">Anexar arquivo (opcional, Maximo 2MB):</label>
                                <input class="form-control" type="file" name="arquivo" />
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
