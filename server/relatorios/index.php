<?php
    session_start(); //inicia sessão, para verificação de login
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- página de relatórios -->
        <title>Relatórios - Ouvidoria 2.0</title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <script src="../js/jquery.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>

        <!-- Esse style abaixo é para a barra de menu -->
        <style>
            /* Remove the navbar's default margin-bottom and rounded borders */ 
            .navbar {
                margin-bottom: 0;
                border-radius: 0;
            }

            /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
            .row.content {height: 450px}

            /* Set gray background color and 100% height */
            .sidenav {
                padding-top: 20px;
                background-color: #f1f1f1;
                height: 100%;
            }

            /* Set black background color, white text and some padding */
            footer {
                background-color: #555;
                color: white;
                padding: 15px;
            }

            /* On small screens, set height to 'auto' for sidenav and grid */
            @media screen and (max-width: 767px) {
                .sidenav {
                    height: auto;
                    padding: 15px;
                }
                .row.content {height:auto;} 
            }
        </style>
    </head>
    <body>
        <!-- logo -->
        <div class="row">
            <div class="container-fluid">
                <img src="../images/logo.png"/>
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
                        <li><a href="../">Início</a></li>
                        <li><a href="../reclamacoes/">Reclamações</a></li>
                        <li class="active"><a href="#">Relatórios</a></li>
                        <li><a href="../contato/">Contato</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <?php
                            if (isset($_SESSION['CODSIST_usuario_esta_logado'])) {
                                if (strcmp($_SESSION['CODSIST_usuario_logado'], "logado_com_sucesso") == 0) {
                                    echo '<a href="../logout.php?CODSIST_sair=true">Logout</a>';
                                } else {
                                    echo '<a href="../login/">Login</a>';
                                }
                            } else {
                                echo '<a href="../login/">Login</a>';
                            }
                            ?>
                        </li>
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
