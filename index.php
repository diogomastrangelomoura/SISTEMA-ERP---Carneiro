<?php
if(!file_exists('admin/class/class.db.php')){
    header("Location: instalador");       
}
include("admin/class/class.db.php");
include("admin/class/class.seguranca.php");
include("includes/verifica_configuracoes_loja.php");
include("includes/verifica_dados_loja.php");
include("includes/verifica_dados_sistema.php");

if(isset($_SESSION['usuario_sistema_sis_erp'])){
	header("Location: home");
}
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>SIS ERP v<?php echo $dados_sistema['versao']; ?></title>

    <!-- FONTS -->
    <link href="css/home/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="css/home/Ionicons/css/ionicons.css" rel="stylesheet">
    

    <link rel="shortcut icon" href="favicon.ico">

    <!-- Slim CSS -->
    <link rel="stylesheet" href="css/home/slim.css">
    <link rel="stylesheet" href="css/home/home.css">
    <link href="css/icones/icones01/icofont.min.css" rel="stylesheet">
	<link href="css/icones/icones02/css/pe-icon-set-food.min.css" rel="stylesheet">

  </head>
  <body>


  <div class="is_mobile d-block d-sm-none"></div> 	

  <div class="d-md-flex flex-row-reverse">
      
      <div class="signin-right" >

      	<div class="hidden-sm hidden-xs alert alert-info avisos_index_topo text-center"></div>

        <div class="signin-box">
          
          <h2 class="signin-title-primary">
          	
          	SIS ERP <small>v<?php echo $dados_sistema['versao']; ?> </small>
          </h2>
          <h3 class="signin-title-secondary upper">Sistema Integrado de Gestão Empresarial</h3>

          <form method="post" action="login/login.php" id="FormLogin">

          	<div class="alert alert-danger peq" id="erro" role="alert" style="display: none;">
                            
            </div>
	          
	          <div class="form-group">
	            <input type="text" class="form-control" type="text" name="usuario" placeholder="USUÁRIO" required autofocus>
	          </div><!-- form-group -->
	          
	          <div class="form-group">
	            <input type="password" class="form-control" type="password" name="senha" placeholder="SENHA" required>
	          </div><!-- form-group -->
	          
	          <button type="submit" id="botao_enviar_login" class="btn btn-primary btn-block btn-signin">ACESSAR</button>
			
	      </form>
	          
	          <div class="col-md-12 text-center">
	          	<span class="upper peq"><b><?php echo $dados_loja['razao']; ?></b><br> &copy; <?php echo date("Y"); ?> Todos os Direitos Reservados </span>
	          </div>

	         
          
        </div>

      </div>
      


      <div class="signin-left d-none d-md-block">
			
   
			   <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
			   
			            <ol class="carousel-indicators">
			            	<li data-target="#carouselExampleIndicators" data-slide-to="0" ></li>
			                <li data-target="#carouselExampleIndicators" class="active" data-slide-to="1"></li>                    
			            </ol>
			                          
			            <div class="carousel-inner" role="listbox">
							<div class="carousel-item " style="background-image: url(imagens/sistema/anuncio2.jpg); "></div>
							<div class="carousel-item active" style="background-image: url(imagens/sistema/anuncio.jpg); "></div>
						</div>	    

			  </div>				
  

      </div>



    </div><!-- d-flex -->


    <script src="admin/lib/jquery/js/jquery.js"></script>
	<script src="admin/lib/popper.js/js/popper.js"></script>
	<script src="admin/lib/bootstrap/js/bootstrap.js"></script>        
    <script src="javascript/login.js"></script>
  </body>
</html>
	













