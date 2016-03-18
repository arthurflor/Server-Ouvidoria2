<?php
    session_start(); //inicia sessão, para verificação de login
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        
        <!-- página do contato -->
        <title>Contato - Ouvidoria 2.0</title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <!-- Esse style abaixo é para mudar a cor de alguns componentes, vem por padrão -->
        <link rel="stylesheet" href="../css/newStyle.css">
        
        <script src="../js/jquery.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
    </head>
    <body>
        <!-- logo -->
        <div class="row">
            <div class="container-fluid"><a href="../">
                    <img src="../images/logo.png" alt="logo"/>
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
                        <ul class="nav navbar-nav">
                        <li><a href="../">Início</a></li>
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Reclamações
                            <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                              <li><a href="../reclamacoes/direitos_humanos/">Direitos Humanos</a></li>
                              <li><a href="../reclamacoes/focos_de_dengue/">Focos de Dengue</a></li> 
                              <li><a href="../reclamacoes/ouvidoria/">Ouvidoria</a></li> 
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Relatórios
                            <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                              <li><a href="../relatorios/direitos_humanos/">Direitos Humanos</a></li>
                              <li><a href="../relatorios/focos_de_dengue">Focos de Dengue</a></li> 
                              <li><a href="../relatorios/ouvidoria">Ouvidoria</a></li> 
                            </ul>
                        </li>
                        <li><a href="#">Contato</a></li>
                    </ul>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <!--<li>
                            
                            ?>
                        </li>-->
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container-fluid text-center">    
            <div class="row content">
                
                <!-- barra da esquerda -->
                <div class="col-sm-2 sidenav">
                    <p><a href="#">Link</a></p>
                    <p><a href="#">Link</a></p>
                    <p><a href="#">Link</a></p>
                </div>
                
                <!-- centro da página (horizontalmente falando) -->
                <div class="col-sm-8 text-left"> 
                    <h1>Welcome</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                    <hr>
                    <h3>Test</h3>
                    <p>Lorem ipsum...</p>
                </div>
                
                <!-- barra da direita -->
                <div class="col-sm-2 sidenav">
                    <div class="well">
                        <p>ADS 1</p>
                    </div>
                    <div class="well">
                        <p>ADS 2</p>
                    </div>
                    <div class="well">
                        <p>ADS 3</p>
                    </div>
                    <div class="well">
                        <p>ADS 4</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- fim da página -->
        <footer class="container-fluid text-center">
            <p>Prefeitura Municipal de Caruaru | Todos os Direitos Reservados | Desenvolvido por Universidade de Pernambuco (FACITEC)</p>
        </footer>

    </body>
</html>
