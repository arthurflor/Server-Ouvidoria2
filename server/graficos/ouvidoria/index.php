<?php
    include '../../MVC/Model/erros_php/erros_php.php'; //mostra os erros de php da pagina
    $categoria_desta_pagina = 1;

    $titulo_da_pagina = 'Graficos de Reclamacoes da Ouvidoria - Ouvidoria 2.0';
    $pasta_raiz_site = '../../';
    $pasta_reclamacoes = '../../reclamacoes/';
    $pasta_graficos = '../';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include '../../MVC/View/estrutura_site/head.php'; //cabecalho ?>

        <script src="../../js/alterna_div_graficos.js"> //alternacao de divs no formulario, de acordo com o radio button</script>
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
                        <h2>Graficos da Ouvidoria</h2>
                        <hr>
                        <form class="form-horizontal" role="form" method="GET" action="../direitos_humanos/">
                            <div class="row">
                                <div class="col-sm-1"></div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="sel1">Subcategoria</label>
                                        <select class="form-control" name="categoria" required>
                                            <option value="35">Todas</option>
                                            <option value="18">Mulher</option>
                                            <option value="19">Idoso</option>
                                            <option value="20">Infancia e Juventude</option>
                                            <option value="21">Animais</option>
                                        </select>
                                    </div>
                                </div>
                                <?php include '../../MVC/View/graficos/componentes_formulario.html'; ?>
                            </div>
                            <button class="btn btn-primary" type="submit">Gerar Relatorio</button>

                        </form>
                        <br>    
                        
                        <?php
                            include '../regras_de_negocio/regras_relatorio.php'; //regra de negocio
                            $negocioOuvidoria = new RegrasNegocioRelatorio();
                            //$negocioDH->receberDados($categoria_desta_pagina);
                        ?>

                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h4>Mapa de Reclamacoes:</h4>
                            </div>
                        </div>
                        <?php 
                            //$negocioDH->criarMapaReclamacoes(); 
                        ?>
                        <div class="row">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-9">
                                <div id="map" style="width:500px;height:380px;"></div>
                            </div>
                        </div>
                        <hr>
                    </p>
                </div>
                
                <?php include '../../MVC/View/estrutura_site/barra_direita.html'; ?>

            </div>
        </div>
        
        <script src="../../js/opcao_imprimir.js"></script>

        <?php include '../../MVC/View/estrutura_site/footer.html'; //rodape da pagina ?>
        
    </body>
</html>