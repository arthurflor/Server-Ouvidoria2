<?php
$titulo_da_pagina = 'Página Inicial - Ouvidoria 2.0';
$pasta_raiz_site = '';
$pasta_reclamacoes = 'reclamacoes/';
$pasta_graficos = 'graficos/';
?>
<!DOCTYPE html>
<html lang="en">
<!-- ESSA PÁGINA E TODAS AS OUTRAS DESTE SISTEMA TEM O TEMPLATE DA W3SCHOOLS -->
<!-- página inicial -->
<head>
	
    <?php include 'MVC/View/estrutura_site/head.php';?>

    <style>
        .slider-size {
            height: 400px; /* This is your slider height */
        }
        .carousel {
            width:100%; 
            margin:0 auto; /* center your carousel if other than 100% */ 
        }
    </style>

 <link rel="shortcut icon" href="/images/logo.ico">
</head>
<body>
	<?php include 'MVC/View/estrutura_site/navbar.php';?>
    <div class="container-fluid text-center">    
       <div class="row content">

          <?php include 'MVC/View/estrutura_site/barra_esquerda.html'; ?>

            <!-- centro da página (horizontalmente falando) -->
            <div class="col-sm-10 text-left">
            	<hr>
            	<h1>Bem vindo ao sistema!</h1> 
            	<hr>
            	<h2>Confira as Ultimas Reclamacoes:</h2>
            	<hr>

            	<div id="myCarousel" class="carousel slide" data-ride="carousel">
            		<!-- Indicators -->
            		<ol class="carousel-indicators">
            			<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            			<li data-target="#myCarousel" data-slide-to="1"></li>
            			<li data-target="#myCarousel" data-slide-to="2"></li>
            			<li data-target="#myCarousel" data-slide-to="3"></li>
            		</ol>

            		<!-- Wrapper for slides -->
            		<div class="carousel-inner" role="listbox">
            			
            			<div class="item active">
            				<div style="background:url(http://random-ize.com/lorem-ipsum-generators/lorem-ipsum/lorem-ipsum.jpg) center center; background-size:cover;" class="slider-size">
            					<div class="carousel-caption">
            						<h3>Flowers</h3>
            						<p>Beatiful flowers in Kolymbari, Crete.</p>
            					</div>
            				</div>
            			</div>

            			<div class="item">
            				<div style="background:url(http://www.eleonoraanzini.com/wp-content/uploads/2011/04/026C_Keep_Calm_and_Lorem_Ipsum_web.jpg) center center; background-size:cover;" class="slider-size">
            					<div class="carousel-caption">
            						<h3>Flowers</h3>
            						<p>Beatiful flowers in Kolymbari, Crete.</p>
            					</div>
            				</div>
            			</div>
            			<div class="item">
            				<div style="background:url(http://www.blogwebdesignmicrocamp.com.br/wp-content/uploads/2015/12/13.jpg) center center; background-size:cover;" class="slider-size">
            					<div class="carousel-caption">
            						<h3>Flowers</h3>
            						<p>Beatiful flowers in Kolymbari, Crete.</p>
            					</div>
            				</div>
            			</div>
            			<div class="item">
            				<div style="background:url(http://www.raywhite.com.lb/wp-content/uploads/2015/03/loremipsumtext.jpg) center center; background-size:cover;" class="slider-size">
            					<div class="carousel-caption">
            						<h3>Flowers</h3>
            						<p>Beatiful flowers in Kolymbari, Crete.</p>
            					</div>
            				</div>
            			</div>
            		</div>

            		<!-- Left and right controls -->
            		<a class="left carousel-control" href="javascript:void(0)" data-slide="prev" data-target="#myCarousel">
            			<span class="glyphicon glyphicon-chevron-left"></span>
            		</a>
            		<a class="right carousel-control" href="javascript:void(0)" data-slide="next" data-target="#myCarousel">
            			<span class="glyphicon glyphicon-chevron-right"></span>
            		</a>
            	</div>
            	
            	<hr>

            </div>

            <?php include 'MVC/View/estrutura_site/barra_direita.html'; ?>
        </div>
    </div>

    <?php include 'MVC/View/estrutura_site/footer.html'; ?>

</body>
</html>