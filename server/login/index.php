<?php
session_start(); //inicia sessão, para verificação de login
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- página de relatórios -->
        <title>Login - Ouvidoria 2.0</title>

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
            <div class="container-fluid">
                <a href="../">
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
                        <li><a href="../">Início</a></li>
                        <li><a href="../reclamacoes/">Reclamações</a></li>
                        <li><a href="../relatorios/">Relatórios</a></li>
                        <li><a href="../contato/">Contato</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="active">
                            <?php
                            if (!isset($_SESSION['CODSIST_usuario'])) {
                                echo '<a href="#">Login</a>';
                            } else {
                                echo '<a href="../logout.php?CODSIST_sair=true">Logout</a>';
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
                    <?php
                    if (!isset($_SESSION['CODSIST_usuario'])) {
                        //não está logado
                        echo '
                                <h2>Preencha com os dados do seu login:</h2>
                                <form class="form-horizontal" role="form" method="POST" action="autenticacao.php">
                                    <div class="form-group">
		                        <label class="control-label col-sm-2" for="nome_usuario">Login:</label>
		                        <div class="col-sm-9">
		                            <input class="form-control" id="nome_usuario" placeholder="Digite o seu Login" name="nome_usuario">
		                        </div>
		                    </div>
		                    <div class="form-group">
		                        <label class="control-label col-sm-2" for="senha">Senha:</label>
		                        <div class="col-sm-9"> 
		                            <input type="password" class="form-control" id="senha" placeholder="Digite a sua Senha" name="senha">
		                        </div>
		                    </div>
                                    <div class="form-group"> 
                                        <div class="col-sm-offset-2 col-sm-2">
                                            <button type="submit" class="btn btn-primary">Entrar</button>
                                        </div>
		                    </div>
                                </form>
                            ';
                    } else {
                        echo 
                            '<script language="javascript" type="text/javascript"> 
                                alert("Você já está logado, e será redirecionado à página inicial!");
				window.location.href="../";
                            </script>';
                    }
                    ?>
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
