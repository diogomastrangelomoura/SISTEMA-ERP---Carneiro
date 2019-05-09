<?php
require("../../admin/class/class.db.php");
require("../../admin/class/class.seguranca.php");
require("../../includes/verifica_session.php");
require("../../includes/verifica_caixa_aberto.php");
require("../actions/totalizadores_caixa.php");
?>

<div class="slim-pageheader">
  <ol class="breadcrumb slim-breadcrumb"></ol>
  <h6 class="slim-pagetitle upper">CAIXA CONSOLIDADO</h6>
</div>


<div class="row row-xs">
          
          <div class="col-md-3">
            <div class="card card-status">
              <div class="media">
                <i class="icon icofont-money-bag tx-teal"></i>
                <div class="media-body">
                  <h4 style="color: #000">R$ <?php echo number_format(devolve_valores_caixa($id_caixa_aberto,1),2,".",","); ?></h4>
                  <p>RECEBIMENTOS EM DINHEIRO</p>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-3">
            <div class="card card-status">
              <div class="media">
                <i class="icon icofont-mastercard-alt tx-primary"></i>
                <div class="media-body">
                  <h4 style="color: #000">R$ <?php echo number_format(devolve_valores_caixa($id_caixa_aberto,2),2,".",","); ?></h4>
                  <p>RECEBIMENTOS NO CARTÃO</p>
                </div>
              </div>
            </div>
          </div>


          <div class="col-md-3">
            <div class="card card-status">
              <div class="media">

              	<i class="icon icofont-license tx-purple"></i>                
                <div class="media-body">
                  <h4 style="color: #000">R$ <?php echo number_format(devolve_valores_caixa($id_caixa_aberto,4),2,".",","); ?></h4>
                  <p>RECEBIMENTOS NO CHEQUE</p>
                </div>
              </div>
            </div>
          </div>


          <div class="col-md-3">
            <div class="card card-status">
              <div class="media">
              	<i class="icon icofont-users-alt-5 tx-danger"></i>                
                <div class="media-body">
                  <h4 style="color: #000">R$ <?php echo number_format(devolve_valores_caixa($id_caixa_aberto,3),2,".",","); ?></h4>
                  <p>RECEBIMENTOS DE CREDIÁRIO</p>
                </div>
              </div>
            </div>
          </div>


          


           <div class="col-md-4 top10">
           	<div class="row">
           		
           		<div class="col-md-12">
		            <div class="card card-status">
		              <div class="media">
		                <i class="icon icofont-line-block-up tx-teal"></i>
		                <div class="media-body">
		                  <h1>R$ <?php echo number_format(devolve_valores_caixa($id_caixa_aberto,0),2,".",","); ?></h1>
		                  <p>SUBTOTAL</p>
		                </div>
		              </div>
		            </div>
		        </div>

		        <div class="col-md-12 top10">
		            <div class="card card-status">
		              <div class="media">
		                <i class="icon icofont-line-block-down tx-primary"></i>
		                <div class="media-body">
		                  <h1>R$ <?php echo number_format(devolve_troco_caixa($id_caixa_aberto),2,".",","); ?></h1>
		                  <p>TROCO INICIAL</p>
		                </div>
		              </div>
		            </div>
		        </div>

		        <div class="col-md-12 top10">
		            <div class="card card-status">
		              <div class="media">
		                <i class="icon icofont-line-block-down tx-danger"></i>
		                <div class="media-body">
		                  <h1>R$ <?php echo number_format(devolve_saidas_caixa($id_caixa_aberto),2,".",","); ?></h1>
		                  <p>SAÍDAS DE CAIXA</p>
		                </div>
		              </div>
		            </div>
		        </div>




		    </div>      
           </div>	


           <div class="col-md-8 top10">
           
	           <div class="card card-info">
	              <div class="card-body pd-20">	               
	                <h1 class="tx-inverse mg-b-20" style="font-size: 60px">R$ <?php echo number_format(devolve_final_caixa($id_caixa_aberto),2,".",","); ?></h1>
	                <p>O TOTAL EM CAIXA É CONSIDERADO SOMANDO-SE: <BR><b>DINHEIRO + CARTÃO + CHEQUES + RECEBIMENTOS CREDIÁRIO + TROCO INICIAL</b>
	                	<BR>
	                	DESSE MONTANDE RETIRA-SE AS SAÍDAS DE CAIXA
	                </p>
	                <a href="javascript:void(0);" onclick="javascript:menu_vendas_realizadas();" class="btn btn-primary btn-block">VER TODAS AS VENDAS</a>
	                <br>
	                <p class="upper">CAIXA ABERTO EM: <?php echo data_mysql_para_user($dados_caixa_aberto['data_abertura']).' ÁS '.substr($dados_caixa_aberto['hora_abertura'],0,5); ?>H</b><br>RESPONSÁVEL: <?php echo $dados_caixa_aberto['nome'] ?>

	              </div><!-- card -->
	            </div>

	        
	        </div>    

</div>          

	


<script>
  $(document).ready(function(){    
    $('body').css('overflow', 'auto');      
  }); 
</script>


<script src="javascript/usadas.js"></script>	
