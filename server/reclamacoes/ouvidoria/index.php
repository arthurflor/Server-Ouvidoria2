<?php
    session_start(); //inicia sessão, para verificação de login
    include '../regras_de_negocio/erros_php.php'; //mostra os erros de php da pagina
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
                        <form class="form-horizontal" role="form" method="POST" action="../ouvidoria/">
                            <div class="row">
                                <div class="col-sm-1"></div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="sel1">Subcategoria</label>
                                        <select class="form-control" name="categoria" required>
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
                                <div class="col-sm-1">
                                    <div class="form-group">
                                        <label for="usr">Idade:</label>
                                        <input type="text" class="form-control" name="idade">
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                    <div class="form-group ">
                                        <label for="sel1">Genero:</label>
                                        <select class="form-control" name="genero">
                                            <option></option>
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
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="usr">Bairro:</label>
                                        <input type="text" class="form-control" name="bairro">
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-primary" type="submit">Pesquisar!</button>
                        </form>
                        <hr>
                        <h4>Resultados:</h4> 
                            <?php
                                include '../regras_de_negocio/regras_lista.php'; //regra de negocio
                                $negocioOuvidoria = new RegrasNegocioLista();
                                $negocioOuvidoria->receberDados(); 
                                $negocioOuvidoria->mostrarTodasReclamacoes();
                                $negocioOuvidoria->criarMapaReclamacoes()
                                //$negocioDH->criarJSONMapa();
                            ?>
                        <hr>
                        <h4>Mapa de Reclamacoes:</h4>
                        <div id="map" style="width:500px;height:380px;"></div>
                    </p>
                </div>
                
                <?php
                    include '../view/barra_direita.html';
                ?>

            </div>
        </div>
        
        
        <!-- Esse script manda o conteúdo de uma div para impressão-->
        <script>
            document.getElementById('id_do_button').onclick = function() {
                var conteudo = document.getElementById('id_da_div').innerHTML,
                    tela_impressao = window.open('about:blank');

                tela_impressao.document.write(conteudo);
                tela_impressao.window.print();
                tela_impressao.window.close();
            };
        </script>
        
        <?php
            include '../view/footer.html'; //rodape da pagina
        ?>

    </body>
</html>
