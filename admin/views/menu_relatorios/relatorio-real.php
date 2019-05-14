<?php require("../../includes/topo.php"); ?>

<div class="slim-pageheader">
  <ol class="breadcrumb slim-breadcrumb">
    <li class="breadcrumb-item"><a href="home">HOME</a></li>
    <li class="breadcrumb-item active" aria-current="page">RELATÓRIOS</li>
  </ol>
  <h6 class="slim-pagetitle upper">
    RELATÓRIO CONSOLIDADO
  </h6>
</div>


<form method="post" action="relatorio-real">
<div class="section-wrapper">
          
	<label class="section-title">PERÍODO DE PESQUISA</label>

      <div class="form-layout">
            <div class="row row-xs">
          
          <input type="hidden" name="pesquisa" value="1">

          <div class="col-lg-3">          	  
              <div class="input-group">              	
                <div class="input-group-prepend">
                  <div class="input-group-text">
                    <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                  </div>
                </div>
                <input type="date" name="data_inicio" value="<?php if(isset($data_inicio)){echo $data_inicio;} ?>"    class="form-control" required>
              </div>
          </div>

         <div class="col-lg-3">              
              <div class="input-group">    
              <div class="input-group-prepend">
                  <div class="input-group-text">
                    <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                  </div>
                </div>          	
                <input required type="date" name="data_fim" value="<?php if(isset($data_fim)){echo $data_fim;} ?>"  class="form-control">
                
              </div>
         </div>

         <div class="col-lg-3 ">  
         	<button type="submit" class="btn btn-primary bd-0">GERAR RELATÓRIO</button> 
         </div>	


     	</div><!-- row -->
	</div><!-- form-layout -->         
  
</div>
</form>




<div class="row row-sm" style="margin-top: 15px">        
  
<?php 
if(isset($pesquisa)){  

	$total_dinheiro=0;
	$total_cartao=0;
	$total_crediario=0;
	$total_cheque=0;

	$pesq = $db->select("SELECT valor_pagamento, forma_pagamento FROM pagamentos_vendas WHERE data>='$data_inicio' AND data<='$data_fim' AND forma_pagamento!='3'");
	while($line = $db->expand($pesq)){

		//DINHEIRO
		if($line['forma_pagamento']==1){
			$total_dinheiro = ($total_dinheiro+$line['valor_pagamento']);
		}	

		//CARTAO
		if($line['forma_pagamento']==2){
			$total_cartao = ($total_cartao+$line['valor_pagamento']);
		}	

		//CHEQUE
		if($line['forma_pagamento']==4){
			$total_cheque = ($total_cheque+$line['valor_pagamento']);
		}	

	}


	$sel = $db->select("SELECT valor_recebe FROM contas_clientes WHERE data_debito>='$data_inicio' AND data_debito<='$data_fim' AND tipo='1'");
		if($db->rows($sel)){
			while($row_cred = $db->expand($sel)){
					$total_crediario = ($total_crediario+$row_cred['valor_recebe']);
			}
		}


?>

		<div class="slim-pageheader">  
		  <h6 class="slim-pagetitle upper">
		    VALORES REAIS
		  </h6>
		</div>
    	
    	<div class="col-md-12"></div>	

		<div class="col-md-3">
            <div class="card card-status">
              <div class="media">
                <i class="icon icofont-money-bag tx-teal"></i>
                <div class="media-body">
                  <h4 style="color: #000">R$ <?php echo number_format($total_dinheiro,2,".",","); ?></h4>
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
                  <h4 style="color: #000">R$ <?php echo number_format($total_cartao,2,".",","); ?></h4>
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
                  <h4 style="color: #000">R$ <?php echo number_format($total_cheque,2,".",","); ?></h4>
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
                  <h4 style="color: #000">R$ <?php echo number_format($total_crediario,2,".",","); ?></h4>
                  <p>RECEBIMENTOS DE CREDIÁRIO</p>
                </div>
              </div>
            </div>
          </div>


          <div class="col-md-12 top15 text-center">
            <div class="card card-status">
              <div class="media">
              	           
                <div class="media-body">
                  <h2 style="color: #000">R$ <?php echo number_format(($total_cartao+$total_dinheiro+$total_crediario+$total_cheque),2,".",","); ?></h2>
                  <p>TOTAL CONSOLIDADO NO CAIXA NO PERÍODO</p>
                </div>
              </div>
            </div>
          </div>





<?php
	
	$total_crediario=0;
	$pesq = $db->select("SELECT valor_pagamento FROM pagamentos_vendas WHERE data>='$data_inicio' AND data<='$data_fim' AND forma_pagamento='3'");
	while($row_cred = $db->expand($pesq)){
		$total_crediario = ($total_crediario+$row_cred['valor_pagamento']);
	}
?>


<div class="slim-pageheader top15">
  <h6 class="slim-pagetitle upper">
    VALORES BRUTOS DE VENDAS
  </h6>
</div>


		<div class="col-md-12"></div>	

		<div class="col-md-3">
            <div class="card card-status">
              <div class="media">
                <i class="icon icofont-money-bag tx-teal"></i>
                <div class="media-body">
                  <h4 style="color: #000">R$ <?php echo number_format($total_dinheiro,2,".",","); ?></h4>
                  <p>VENDAS DINHEIRO</p>
                </div>
              </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card card-status">
              <div class="media">
                <i class="icon icofont-mastercard-alt tx-primary"></i>
                <div class="media-body">
                  <h4 style="color: #000">R$ <?php echo number_format($total_cartao,2,".",","); ?></h4>
                  <p>VENDAS CARTÃO</p>
                </div>
              </div>
            </div>
          </div>


          <div class="col-md-3">
            <div class="card card-status">
              <div class="media">

              	<i class="icon icofont-license tx-purple"></i>                
                <div class="media-body">
                  <h4 style="color: #000">R$ <?php echo number_format($total_cheque,2,".",","); ?></h4>
                  <p>VENDAS CHEQUE</p>
                </div>
              </div>
            </div>
          </div>


          <div class="col-md-3">
            <div class="card card-status">
              <div class="media">
              	<i class="icon icofont-users-alt-5 tx-danger"></i>                
                <div class="media-body">
                  <h4 style="color: #000">R$ <?php echo number_format($total_crediario,2,".",","); ?></h4>
                  <p>VENDAS CREDIÁRIO</p>
                </div>
              </div>
            </div>
          </div>


          <div class="col-md-12 top15 text-center">
            <div class="card card-status">
              <div class="media">
              	           
                <div class="media-body">
                  <h2 style="color: #000">R$ <?php echo number_format(($total_cartao+$total_dinheiro+$total_crediario+$total_cheque),2,".",","); ?></h2>
                  <p>TOTAL DE VENDAS NO PERÍODO<br><small>*OS VALORES ACIMA NÃO CORRESPONDEM A ENTRADAS NO CAIXA, MAS SIM VENDAS NO PERÍODO</small></p>
                </div>
              </div>
            </div>
          </div>

</div>


<?php                     
}   
?>

<?php require("../../includes/rodape.php"); ?>