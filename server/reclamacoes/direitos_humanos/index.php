<?php
    include '../regras_de_negocio/erros_php.php'; //mostra os erros de php da pagina
    $categoria_desta_pagina = 2; 
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
                        <h2>Reclamacoes de Direitos Humanos</h2>
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
                                <div class="col-sm-1">
                                    <div class="form-group">
                                        <label for="sel1">Faixa Etaria:</label>
                                        <select class="form-control" name="idade">
                                            <option value="1">Tudo</option>
                                            <option value="2">0 ate 11</option>
                                            <option value="3">12 ate 17</option>
                                            <option value="4">18 ate 25</option>
                                            <option value="5">26 ate 35</option>
                                            <option value="6">36 ate 50</option>
                                            <option value="7">mais que 50</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                    <div class="form-group ">
                                        <label for="sel1">Genero:</label>
                                        <select class="form-control" name="genero">
                                            <option value="t">Tudo</option>
                                            <option value="m">Masculino</option>
                                            <option value="f">Feminino</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="usr">Email:</label>
                                        <input type="text" class="form-control" name="email">
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="usr">Data:</label>
                                        <input type="text" class="form-control" name="data">
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                    <div class="form-group">
                                        <label for="usr">Bairro:</label>
                                        <input type="text" class="form-control" name="bairro">
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                    <div class="form-group">
                                        <label for="sel1">Itens/Pagina:</label>
                                        <select class="form-control" name="itens" required>
                                            <option value="3">3</option>
                                            <option value="5">5</option>
                                            <option value="7">7</option>
                                            <option value="10">10</option>
                                            <option value="1">Tudo</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-primary" type="submit">Pesquisar!</button>

                        </form>
                        <br>    
                        <?php
                            include '../regras_de_negocio/regras_lista.php'; //regra de negocio
                            $negocioDH = new RegrasNegocioLista();
                            $negocioDH->receberDados($categoria_desta_pagina);
                        ?>
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#tabela">Tabela</a></li>
                            <li><a data-toggle="tab" href="#listar">Listagem</a></li>
                        </ul>
                        
                        <div class="tab-content">
                            <div id="tabela" class="tab-pane fade in active">
                                <h3>Tabela com reclamacoes:</h3>
                                <p><?php $negocioDH->gerarTabela(); ?></p>
                            </div>
                            <div id="listar" class="tab-pane fade">
                                <p><?php $negocioDH->listarReclamacoes(); ?></p>
                            </div>
                        </div>

                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h4>Mapa de Reclamacoes:</h4>
                            </div>
                        </div>
                        <?php 
                            $negocioDH->criarMapaReclamacoes(); 
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
