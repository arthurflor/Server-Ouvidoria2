<?php
    session_start(); //inicia sessão, para verificação de login
    ini_set('display_errors',1);
    ini_set('display_startup_erros',1);
    error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- página de reclamações -->
        <title>Reclamações - Ouvidoria 2.0</title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="../../css/bootstrap.min.css">
        <!-- Esse style abaixo é para mudar a cor de alguns componentes, vem por padrão -->
        <link rel="stylesheet" href="../../css/newStyle.css">
        
       <script src="../../js/jquery.min.js"></script>
        <script src="../../js/bootstrap.min.js"></script>
    </head>
    <body>
        <!-- logo -->
        <div class="row">
            <div class="container-fluid">
                <a href="../../">
                    <img src="../../images/logo.png" alt="logo"/>
                </a>
            </div>
        </div>
        
        <!-- Barra de menu -->
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>                        
                    </button>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav">
                        <li><a href="../../">Início</a></li>
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Reclamações
                            <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                              <li><a href="../direitos_humanos/">Direitos Humanos</a></li>
                              <li><a href="../focos_de_dengue/">Focos de Dengue</a></li> 
                              <li><a href="../ouvidoria/">Ouvidoria</a></li> 
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Relatórios
                            <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                              <li><a href="../../relatorios/direitos_humanos/">Direitos Humanos</a></li>
                              <li><a href="../../relatorios/focos_de_dengue">Focos de Dengue</a></li> 
                              <li><a href="../../relatorios/ouvidoria">Ouvidoria</a></li> 
                            </ul>
                        </li>
                        <li><a href="../../contato/">Contato</a></li>
                    </ul>
                    <!-- 
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                        </li>
                    </ul>
                    -->
                </div>
            </div>
        </nav>

        <div class="container-fluid text-center">    
            <div class="row content">
                
                <!-- barra da esquerda -->
                <div class="col-sm-1 sidenav">
                    <!--
                    <p><a href="#">Link</a></p>
                    <p><a href="#">Link</a></p>
                    <p><a href="#">Link</a></p>
                    -->
                </div>
                
                <!-- Centro da página (horizontalmente falando) ira listar as reclamaçoes -->
                <div class="col-sm-10 text-left">
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
                            //ok, aqui vamos chamar alguns metodos
                            //vamos verificar via GET os parametros da pesquisa
                                if(!isset($_GET['idade'])){
                                    $idade = false;
                                } else {
                                    $idade = $_GET['idade'];
                                }
                                if(!isset($_GET['genero'])){
                                    $genero = false;
                                } else {
                                    $genero = $_GET['genero'];
                                }
                                if(!isset($_GET['email'])){
                                    $email = false;
                                } else {
                                    $email = $_GET['email'];
                                }
                                if(!isset($_GET['categoria'])){
                                    $categoria = false;
                                } else {
                                    $categoria = $_GET['categoria'];
                                }
                                if(!isset($_GET['bairro'])){
                                    $bairro = false;
                                } else {
                                    $bairro = $_GET['bairro'];
                                }
                                if(!isset($_GET['data'])){
                                    $data = false;
                                } else {
                                    $data = $_GET['data'];
                                }

                                include '../regras_de_negocio/negocio.php'; //regra de negocio
                                $negocioDH = new NegocioDH();
                                $negocioDH->receberDados($idade,$genero,$email,$categoria,$bairro,$data); 
                                $negocioDH->mostrarTodasReclamacoes();
                                $negocioDH->criarJSONMapa();
                            
                        ?>
                    <hr>
                    <h4>Mapa de Reclamacoes:</h4>
                    <div id="mapa" ></div>
                    </p>
                </div>
                
                <!-- barra da direita -->
                <div class="col-sm-1 sidenav">
                    
                    <div class="well">
                        <p><!--ADS 1--></p>
                    </div>
                    <div class="well">
                        <p><!--ADS 1--></p>
                    </div>
                    <div class="well">
                        <p><!--ADS 1--></p>
                    </div>
                    
                </div>
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
        
        <!-- fim da página -->
        <footer class="container-fluid text-center">
            <p>Prefeitura Municipal de Caruaru | Todos os Direitos Reservados | Desenvolvido por Universidade de Pernambuco (FACITEC)</p>
        </footer>

    </body>
</html>
