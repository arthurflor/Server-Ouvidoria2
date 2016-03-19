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
                                include '../regras_de_negocio/negocio.php'; //regra de negocio
                                $negocioDH = new NegocioDH();
                                $negocioDH->receberDados(); 
                                $negocioDH->mostrarTodasReclamacoes();
                                //$negocioDH->criarJSONMapa();
                            ?>
                        <hr>
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
