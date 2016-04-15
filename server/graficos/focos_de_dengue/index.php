<?php
    include '../../MVC/Model/erros_php/erros_php.php'; //mostra os erros de php da pagina
    $categoria_desta_pagina = 3;

    $titulo_da_pagina = 'Graficos de Reclamacoes de Dengue - SISGD 1.0 - Ouvidoria 2.0';
    $pasta_raiz_site = '../../';
    $pasta_reclamacoes = '../../reclamacoes/';
    $pasta_graficos = '../';

    include '../../MVC/Controller/graficos/ControladorGraficos.php';
    $controlador = new ControladorGraficos(); 
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <?php include '../../MVC/View/estrutura_site/head.php'; //cabecalho ?>

        <!--<script src="../../js/alterna_div_graficos.js"> //alternacao de divs no formulario, de acordo com o radio button</script>
        -->
        <script src="../../js/Chart.js"> //script dos graficos</script> 
    </head>
    <body>

        <?php include '../../MVC/View/estrutura_site/navbar.php'; //navbar (menu) ?>

        <div class="container-fluid text-center">    
            <div class="row content">

                <?php include '../../MVC/View/estrutura_site/barra_esquerda.html'; ?>
                
                <!-- Centro da página (horizontalmente falando) ira listar as reclamaçoes -->
                <div class="col-sm-10 text-left">
                    <p class="newFont" align="justify">
                        <hr>
                        <h2>Graficos de Dengue</h2>
                        <hr>
                        <form class="form-horizontal" role="form" method="GET" action="../focos_de_dengue/">
                            <div class="row">
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="sel1">Subcategoria</label>
                                        <select class="form-control" name="categoria" required>
                                            <option value="100">Focos de Dengue</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <?php include '../../MVC/View/graficos/componentes_formulario.html'; ?>
                            </div>
                            <div class="row">
                                <button class="btn btn-primary" type="submit">Gerar Relatorio</button>

                            </div>
                        </form>
                        <br>    
                        
                        <?php
                            $controlador->iniciar_controlador($categoria_desta_pagina);
                        ?>

                        <hr>
                    </p>
                </div>
                
                <?php include '../../MVC/View/estrutura_site/barra_direita.html'; ?>
                
            </div>
        </div>
        
        <script src="../../js/canvas_pdf.js"></script>

        <?php include '../../MVC/View/estrutura_site/footer.html'; //rodape da pagina ?>
    </body>
</html>