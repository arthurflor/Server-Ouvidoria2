<?php
    include '../../MVC/Model/erros_php/erros_php.php'; //mostra os erros de php da pagina
    $categoria_desta_pagina = 1;

    $titulo_da_pagina = 'Reclamacoes da Ouvidoria - Ouvidoria 2.0';
    $pasta_raiz_site = '../../';
    $pasta_reclamacoes = '../';
    $pasta_graficos = '../../graficos/';

    include '../../MVC/Controller/reclamacoes/ControladorListaReclamacoes.php';
    $controlador = new ControladorListaReclamacoes();
    $retorno_controlador = $controlador->executar_controlador($categoria_desta_pagina);
?>
<!DOCTYPE html>
<html lang="en">
    <head> 
        <?php include '../../MVC/View/estrutura_site/head.php'; //cabecalho ?>
    </head>
    <body>
        
        <?php include '../../MVC/View/estrutura_site/navbar.php'; //navbar (menu) ?>

        <div class="container-fluid text-center">    
            <div class="row content">
                
                <?php include '../../MVC/View/estrutura_site/barra_esquerda.html'; ?>
                
                <!-- Centro da página (horizontalmente falando) ira listar as reclamaçoes -->
                <div class="col-sm-10 text-left" id="conteudo_principal">
                    <p class="newFont" align="justify">
                        <hr>
                        <h2>Ouvidoria</h2>
                        <hr>
                        <h4>Escolha os Parametros de Pesquisa:</h4>
                        <form class="form-horizontal" role="form" method="GET" action="../ouvidoria/">
                            <div class="row">
                                <div class="col-sm-1"></div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="sel1">Subcategoria</label>
                                        <select class="form-control" name="categoria" required>
                                            <option value="30">Todas</option>
                                            <option value="1">Administracao</option>
                                            <option value="2">Assistencia Social</option>
                                            <option value="3">CEACA</option>
                                            <option value="4">Controladoria</option>
                                            <option value="5">Cultura e Turismo</option>
                                            <option value="6">Desenvolvimento Rural</option>
                                            <option value="7">Educacao</option>
                                            <option value="8">Infraestrutura</option>
                                            <option value="9">Meio Ambiente</option>
                                            <option value="10">Participacao Social</option>
                                            <option value="11">Previdencia Social</option>
                                            <option value="12">Procon</option>
                                            <option value="13">Procuradoria</option>
                                            <option value="14">Saude</option>
                                            <option value="15">Transito</option>
                                            <option value="16">Transportes</option>
                                            <option value="17">Urbanizaçao</option>
                                        </select>
                                    </div>
                                </div>
                                <?php include '../../MVC/View/reclamacoes/componentes_formulario.html'; ?>
                            </div>
                            <button class="btn btn-primary" type="submit">Pesquisar!</button>
                        </form>
                        <br>

                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#tabela">Tabela</a></li>
                            <li><a data-toggle="tab" href="#listar">Listagem</a></li>
                        </ul>
                        
                        <div class="tab-content">
                            <div id="tabela" class="tab-pane fade in active">
                                <p><?php $controlador->solicitar_tabela($retorno_controlador); ?></p>
                            </div>
                            <div id="listar" class="tab-pane fade">
                                <p><?php $controlador->solicitar_lista($retorno_controlador); ?></p>
                            </div>
                        </div>

                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h4>Mapa de Reclamacoes:</h4>
                            </div>
                        </div>

                        <?php $controlador->solicitar_mapa($retorno_controlador); ?>
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