<?php 
require("../../admin/class/class.db.php");
require("../../admin/class/class.seguranca.php");
require("../../includes/verifica_session.php");
require("../../includes/verifica_configuracoes_loja.php");
?>

<form id="FormFinalizaVenda" onSubmit="return false;" method="post" action="menu_pedidos/actions/finaliza_venda.php">


<input type="hidden" id="restante_receber" value="<?php echo ($total_compra-$desconto_compra); ?>">

<input type="hidden" id="id_vendedor" name="id_vendedor" value="<?php echo $id_vendedor; ?>">
<input type="hidden" id="valor_final_desconto" name="valor_final_desconto" value="<?php echo $desconto_compra; ?>">
<input type="hidden" id="valor_final_compra" name="valor_final_compra" value="<?php echo ($total_compra-$desconto_compra); ?>">
<input type="hidden" id="valor_final_troco" name="valor_final_troco" value="">

<div class="row" id="container_geral_pedido">

	<div class="col-lg-6">

	    <div class="card card-connection">
	              
	        <div class="row row-xs">
	        	<div class="col-md-8">
	            	TIPO DE VENDA	                
	            </div>	
	        	<div class="col-md-12 text-right top10" >
	        		<div class="form-group icones-campo2" style="margin-bottom: 0">
			            <i class="icofont-ui-note"></i>	    
			            <select class="form-control input-lg upper padding" id="tipo_venda" name="tipo_venda" onchange="javascript:marca_orcamento(this.value);">
			            	<option value="1">VENDA DIRETA</option>
			            	<option value="2">ORÇAMENTO</option>
			            </select>		            
			            <e class="icofont-thin-down"></e>	    
			        </div>
	        	</div> 

	        </div>

	        
	    </div>

	    <div class="card card-connection top10">
	              
	        <div class="row row-xs">
	        	<div class="col-md-8">
	            	DINHEIRO <br>
	                <a tabindex="-1  href="javascript:void(0)">VALOR RECEBIDO EM DINHEIRO</a>
	            </div>
	        	<div class="col-md-4  text-right">
	        		<input type="text" class="valores form-control text-right input-lg" placeholder="R$ 0.00" onblur="javascript:faz_troco_pgto()" id="pgto_dinheiro_final" name="pgto_dinheiro_final">
	        	</div>            
	        </div>
	        <hr>

	        <div class="row row-xs">
	        	<div class="col-md-4">
	            	CARTÃO <br>
	                <a tabindex="-1  href="javascript:void(0)">CARTÃO CRED/DÉB.</a>
	            </div>
	        	<div class="col-md-8 text-right">
	        		<div class="row row-xs">
	        			<div class="col-md-6">
	        				<input type="text" class="valores form-control text-right input-lg" placeholder="R$ 0.00" id="pgto_cartao_final" name="pgto_cartao_final" onblur="javascript:faz_troco_pgto()">
	        			</div>	
	        			<div class="col-md-6">

				        		<select class="form-control tipo_cartao input-lg  upper text-right" id="tipo_pgto_cartao" name="tipo_pgto_cartao">
				        			<option value="">-- TIPO --</option>
				        			<option value="DÉBITO">DÉBITO</option>
				        			<option value="CRÉDITO">CRÉDITO</option>		        			
				        			<option value="PARC 2x">PARC 2x</option>
				        			<option value="PARC 3x">PARC 3x</option>
				        			<option value="PARC 4x">PARC 4x</option>
				        			<option value="PARC 5x">PARC 5x</option>
				        			<option value="PARC 6x">PARC 6x</option>
				        			<option value="PARC 7x">PARC 7x</option>
				        			<option value="PARC 8x">PARC 8x</option>
				        			<option value="PARC 9x">PARC 9x</option>
				        			<option value="PARC 10x">PARC 10x</option>
				        		</select>
			        		
	        			</div>	
	        		</div>	
	        		
	        		
	        	</div>            
	        </div>
	        <hr>


	        <div class="row row-xs">
	        	<div class="col-md-8">
	            	CHEQUE <br>
	                <a tabindex="-1  href="javascript:void(0)">VALOR RECEBIDO EM CHEQUE</a>
	            </div>
	        	<div class="col-md-4  text-right">
	        		<input type="text" class="valores form-control text-right input-lg" placeholder="R$ 0.00" id="pgto_cheque_final" name="pgto_cheque_final" onblur="javascript:faz_troco_pgto()">
	        	</div>            
	        </div>
	        <hr>

	        <div class="row row-xs">
	        	<div class="col-md-8">
	            	CONTA DO CLIENTE <br>
	                <a tabindex="-1  href="javascript:void(0)">VALOR MARCADO NA CONTA DO CLIENTE</a>
	            </div>
	        	<div class="col-md-4  text-right">
	        		<input type="text" class="valores form-control text-right input-lg" placeholder="R$ 0.00" id="pgto_crediario_final" name="pgto_crediario_final" onblur="javascript:faz_troco_pgto()">
	        	</div>            
	        </div>
	        
	    </div>


	    	<div class="row row-xs">
	        	<div class="col-md-4 top10">
	            	<button type="button" onclick="javascript:retornar_montagem_venda();"  class="btn btn-danger btn-block text-center upper grande-botao">VOLTAR (F3)</button>
	            </div>	        	

	        	<div class="col-md-8 top10">
	            	<button type="button" onclick="javascript:confirma_finaliza_venda()"  class="btn btn-success btn-block text-center upper grande-botao">FINALIZAR (F2)</button>
	            </div>	        	
	        </div>

	</div>


	<div class="col-lg-6">

		<div class="card card-connection">
			<div class="row row-xs">
		        	<div class="col-8">
		            	INFORME O CLIENTE 	                
		            </div>	
		        	<div class="col-md-12 text-right top10" >

		        		<input type="hidden" id="id_cliente_compra" name="id_cliente_compra">

		        		<div class="input-group"  style="margin-bottom: 0">	            			
		        			<input tabindex="-1"  type="text" class="valores form-control input-lg upper" placeholder="NOME DO CLIENTE" readonly id="nome_cliente" name="nome_cliente">
		        			<span class="input-group-btn">
			                  <button onclick="javascript:busca_clientes()" class="btn btn-primary input-lg" type="button"><i class="fa fa-search"></i> (F4)</button>
			                  <button tabindex="-1" onclick="javascript:cancela_busca_clientes()" class="btn btn-danger input-lg" type="button"><i class="icofont-close"></i></button>
			                </span>
		        		</div>
		        	</div> 

		    </div>
		</div>  


		<div class="card card-connection top10">
			
			<div class="row row-xs">
		        <div class="col-md-12 text-right ">		        	
		        	<h166>R$ <?php echo number_format(($total_compra-$desconto_compra),2,".",","); ?></h166><br>
		        	<span class="upper">Total da Compra</span>
		        	<hr>
		        </div>	

		        
		         <div class="col-md-12 text-right ">		        	
		        	<h166>R$ <span id="recebido_exibe">0.00</span></h166><br>
		        	<span class="upper">Total Recebido</span>
		        	<hr>
		        </div>	

		        <div class="col-md-12 text-right ">		        	
		        	<h166 class="color_red">R$ <span id="troco_exibe">0.00</span></h166><br>
		        	<span class="upper color_red">Troco a devolver</span>
		        	<hr>
		        </div>

		        <div class="col-md-12 text-right top15">		        	
		        	<h167>R$ <span id="restante_exibe"><?php echo number_format(($total_compra-$desconto_compra),2,".",","); ?></span></h167><br>
		        	<span class="upper">Restante a receber</span>		        	
		        </div>	


			</div>  

		</div>	



</div>	

</form>


<input type="hidden" id="volta-compra-enter" value="1">
<input type="hidden" id="finaliza-compra-enter" value="1">

<script>
	$(document).ready(function(){				
		$('body').css('overflow', 'hidden');
	});	
</script>

<script src="javascript/usadas.js"></script>
<script src="javascript/teclas_atalho.js"></script>