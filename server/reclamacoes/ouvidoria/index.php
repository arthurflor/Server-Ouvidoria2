<?php
    include '../regras_de_negocio/erros_php.php'; //mostra os erros de php da pagina
    $categoria_desta_pagina = 1; 
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
                                <?php
                                    include '../view/componentes_formulario.html';
                                ?>
                            </div>
                            <button class="btn btn-primary" type="submit">Pesquisar!</button>
                        </form>
                        <br>
                        <?php
                            include '../regras_de_negocio/regras_lista.php'; //regra de negocio
                            $negocioOuvidoria = new RegrasNegocioLista();
                            $negocioOuvidoria->receberDados($categoria_desta_pagina);
                        ?>

                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#tabela">Tabela</a></li>
                            <li><a data-toggle="tab" href="#listar">Listagem</a></li>
                        </ul>
                        
                        <div class="tab-content">
                            <div id="tabela" class="tab-pane fade in active">
                                <h3>Tabela com reclamacoes:</h3>
                                <p><?php $negocioOuvidoria->gerarTabela(); ?></p>
                            </div>
                            <div id="listar" class="tab-pane fade">
                                <p><?php $negocioOuvidoria->listarReclamacoes(); ?></p>
                            </div>
                        </div>

                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h4>Mapa de Reclamacoes:</h4>
                            </div>
                        </div>

                        <?php 
                            $negocioOuvidoria->criarMapaReclamacoes(); 
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