<?php
    include '../regras_de_negocio/erros_php.php'; //mostra os erros de php da pagina
    $categoria_desta_pagina = 0; 
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
            include '../view/head.html'; //cabecalho
        ?>
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
                        <hr>
                        <h2>Reclamacoes de Focos de Dengue</h2>
                        <hr>
                        <form class="form-horizontal" role="form" method="GET" action="../focos_de_dengue/">
                            <div class="row">
                                <div class="col-sm-1"></div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="sel1">Subcategoria</label>
                                        <select class="form-control" name="categoria" required>
                                            <option value="0">Focos de Dengue</option>
                                        </select>
                                    </div>
                                </div>
                                <?php
                                    include '../view/componentes_formulario.html';
                                ?>
                            </div>
                            <button class="btn btn-primary" type="submit">Pesquisar!</button>
                        </form>
                        <br>
                        <?php
                            include '../regras_de_negocio/regras_lista.php'; //regra de negocio
                            $negocioDengue = new RegrasNegocioLista();
                            $negocioDengue->receberDados($categoria_desta_pagina);
                        ?>
                        
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#tabela">Tabela</a></li>
                            <li><a data-toggle="tab" href="#listar">Listagem</a></li>
                        </ul>
                        
                        <div class="tab-content">
                            <div id="tabela" class="tab-pane fade in active">
                                
                                <p><?php $negocioDengue->gerarTabela(); ?></p>
                            </div>
                            <div id="listar" class="tab-pane fade">
                                <p><?php $negocioDengue->listarReclamacoes(); ?></p>
                            </div>
                        </div>

                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h4>Mapa de Reclamacoes:</h4>
                            </div>
                        </div>
                        <?php 
                            $negocioDengue->criarMapaReclamacoes(); 
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
                
                <?php
                    include '../view/barra_direita.html';
                ?>
            </div>
        </div>
        
        <script src="../../js/opcao_imprimir.js">
        </script>
                
        <?php
            include '../view/footer.html'; //rodape da pagina
        ?>

    </body>
</html>
