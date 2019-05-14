<?php 
require("../../../config.php");
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

   
    <title>TABELA NCM - SIS ERP v<?php echo $dados_sistema['versao']; ?></title>

    <!-- vendor css -->
    <link href="<?php echo ADMIN_DIR; ?>lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="<?php echo ADMIN_DIR; ?>lib/Ionicons/css/ionicons.css" rel="stylesheet">
    <link href="<?php echo ADMIN_DIR; ?>lib/chartist/css/chartist.css" rel="stylesheet">
    <link href="<?php echo ADMIN_DIR; ?>lib/rickshaw/css/rickshaw.min.css" rel="stylesheet">
    <link href="<?php echo ADMIN_DIR; ?>lib/select2/css/select2.min.css" rel="stylesheet">
    
    <link href="<?php echo SISTEMA_DIR; ?>css/icones/icones01/icofont.min.css" rel="stylesheet">


    <!-- Slim CSS -->
    <link rel="stylesheet" href="<?php echo ADMIN_DIR; ?>css/slim.css">
    <link rel="stylesheet" href="<?php echo ADMIN_DIR; ?>css/custom.css">

    <link rel="shortcut icon" href="<?php echo ADMIN_DIR; ?>favicon.ico">
	<base href="<?php echo ADMIN_DIR; ?>">

  </head>
  <body>


  		      
			<div class="col-lg-12" style="margin-top: 15px">
  				<div class="card card-table">

  					<input type="text" onkeyup="javascript:pesquisa_ncm_tabela_externa(this.value);" class="form-control input-lg text-center" name="busca" id="busca" placeholder="PESQUISA DE NCM" value="CARREGANDO, AGUARDE..." disabled>

  				</div>
  			</div>
  		
  			<div  class="col-lg-12 top15" id="pesquisax3">

  				<?php include("listagem_ncm.php"); ?>

  			</div>	
    


  </body>


  <script src="<?php echo ADMIN_DIR; ?>lib/jquery/js/jquery.js"></script>
    <script src="<?php echo ADMIN_DIR; ?>lib/popper.js/js/popper.js"></script>
    <script src="<?php echo ADMIN_DIR; ?>lib/bootstrap/js/bootstrap.js"></script>
    <script src="<?php echo ADMIN_DIR; ?>lib/jquery.cookie/js/jquery.cookie.js"></script>
    <script src="<?php echo ADMIN_DIR; ?>lib/chartist/js/chartist.js"></script>
    <script src="<?php echo ADMIN_DIR; ?>lib/d3/js/d3.js"></script>

    <script src="<?php echo ADMIN_DIR; ?>js/ResizeSensor.js"></script>    
    <script src="<?php echo ADMIN_DIR; ?>js/slim.js"></script>

    <script src="<?php echo ADMIN_DIR; ?>js/mascara_money.js"></script>
    <script src="<?php echo ADMIN_DIR; ?>javascript/funcoes.js"></script>
    <script src="<?php echo ADMIN_DIR; ?>javascript/web.js"></script>

</html>

<script>
	$(document).ready(function(){
		$("#busca").prop('disabled', false); 
		$("#busca").val('');
		$("#busca").focus(); 
	});		
</script>