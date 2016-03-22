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

        <script src="../../js/esconde_reclamacoes.js"></script>
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
                                            <option value="1">Tudo</option>
                                            <option value="3">3</option>
                                            <option value="5">5</option>
                                            <option value="7">7</option>
                                            <option value="10">10</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-primary" type="submit">Pesquisar!</button>
                        </form>
                            <?php
                                include '../regras_de_negocio/regras_lista.php'; //regra de negocio
                                $negocioDengue = new RegrasNegocioLista();
                                $negocioDengue->receberDados($categoria_desta_pagina); 
                                $negocioDengue->mostrarTodasReclamacoes();
                                $negocioDengue->criarMapaReclamacoes();
                            ?>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h4>Mapa de Reclamacoes:</h4>
                            </div>
                        </div>
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
