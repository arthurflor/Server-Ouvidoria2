<!-- logo -->
<div class="row">
    <div class="container-fluid">
        <a href="<?php echo $pasta_raiz_site; ?>">
            <img src="<?php echo $pasta_raiz_site; ?>imagens/sisgd.png" alt="sisgd"/>
            <img src="<?php echo $pasta_raiz_site; ?>imagens/logo.png" alt="logo"/>
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
                <li><a href="<?php echo $pasta_raiz_site ?>">Início</a></li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Reclamações
                        <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                          <li><a href="<?php echo $pasta_reclamacoes; ?>direitos_humanos/?categoria=35&itens=5">Direitos Humanos</a></li>
                          <li><a href="<?php echo $pasta_reclamacoes; ?>focos_de_dengue/?categoria=100&itens=5">Focos de Dengue</a></li> 
                          <li><a href="<?php echo $pasta_reclamacoes; ?>ouvidoria/?categoria=30&itens=5">Ouvidoria</a></li> 
                      </ul>
                  </li>
                  <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Graficos
                        <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                          <li><a href="<?php echo $pasta_graficos; ?>direitos_humanos/">Direitos Humanos</a></li>
                          <li><a href="<?php echo $pasta_graficos; ?>focos_de_dengue/">Focos de Dengue</a></li> 
                          <li><a href="<?php echo $pasta_graficos; ?>ouvidoria/">Ouvidoria</a></li> 
                      </ul>
                  </li>

                  <li><a href="<?php echo $pasta_raiz_site; ?>contato/">Contato</a></li>
                  <li><a href="<?php echo $pasta_raiz_site; ?>sobre/">Sobre</a></li>
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