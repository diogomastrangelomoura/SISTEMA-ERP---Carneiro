<?php 
require("../../admin/class/class.db.php");
require("../../admin/class/class.seguranca.php");
require("../../includes/verifica_session.php");
?>


<div class="row" id="container_geral_pedido">

	<div class="col-md-5" >

  		<div class="card-header tx-small bd-0 tx-white bg-primary">ÍTENS DO CUPOM DE VENDA</div>

		<div class="card" id="resumo-pedido-comanda">
				<?php require("../listagem/listagem_itens_compra.php"); ?>
		</div>	

	</div>



	<div class="col-md-7" >

		<form onSubmit="return false;" id="FormProdutoAdicionaVenda" action="menu_pedidos/actions/salva_produto_venda.php">

		<div id="escolhe_produtos_frente">
	  			
			<input id="id_produto_frente_caixa" name="id_produto_frente_caixa" type="hidden">

	  		<div class="form-group icones-campo">
	            <i class="icofont-barcode"></i>	    
	            <input type="text" id="produto_frente_caixa" onkeyup="javascript:verifica_pesquisa();" class="form-control input-lg text-center upper" placeholder="CÓDIGO OU NOME DO PRODUTO" autocomplete="off">
	        </div>

	        <div class="row">
	        <div class="col-md-6">
	        <div class="row row-xs">
		        
		        <div class="col-md-4">
			        <div class="form-group icones-campo">		            
			            <input id="qtd_frente_caixa" onblur="javascript:soma_preco_quantidade(this.value)" type="number" class="form-control input-lg text-center passa_enter" placeholder="QTD" value="01" name="qtd_frente_caixa" >
			        </div>	
			    </div>

			    <div class="col-md-8">
			        <div class="form-group icones-campo">		            
			            <input type="text" id="preco_produto_frente_caixa" class="form-control input-lg text-center valores passa_enter" placeholder="R$ UNIT." name="preco_produto_frente_caixa"  readonly>
			        </div>	
			    </div>

			    <div class="col-md-12">
			        <div class="form-group icones-campo">		            
			            <input type="text" id="preco_final_frente_caixa" class="form-control input-lg text-center passa_enter" placeholder="R$ TOTAL" readonly onkeypress="javascript:efetiva_produto_venda()" onfocus="javascript:exibe_aviso_ok()" onblur="javascript:exibe_aviso_ok(1);">
			        </div>	
			    </div>

	    	</div>
	    	</div>

	    		<div class="col-md-6 text-center top15 hide">
			    	<img src="imagens/sistema/logo_centro.png" class="img-responsive center-block">
			    </div>	

	    	</div>


	    	<div class="form-group icones-campo">	            
	            <input  readonly type="text"  id="nome_produto_frente_caixa" class="form-control  input-lg  upper aparencia_campo">
	        </div>

	        <div class="col-md-12 text-left top10 efetiva_venda hide" id="aviso_efetivar">
	        	APERTE ENTER PARA EFETIVAR
	        </div>	

	    </div>	


    	<div class="row row-xs">

    		<div class="col-md-7">
    			<div class="form-group icones-campo2 " >		            	   
		            <input  type="text" class="form-control input-lg text-center upper msg-venda" id="qtd_final_itens_venda" value="QTD ÍTENS: <?php echo $qtd_itens_pedido; ?>" disabled>		            
		        </div>
    		</div>		

    		<div class="col-md-5">
    			<div class="form-group icones-campo2 " >		            	   
		            <input  type="text" id="desconto_compra" class="form-control input-lg text-center upper valores " placeholder="R$ DESC." onblur="javascript:desconto_compra_final();">
		            <e class="icofont-calculator"></e>	    
		        </div>
    		</div>	

    		<div class="col-md-12">
    			<div class="form-group icones-campo2">
		            <i class="icofont-user-suited"></i>	    
		            <select class="form-control input-lg upper padding" id="id_vendedor">
		            	<option value="">INFORME O VENDEDOR</option>
		            	<?php 
		            		$sql = $db->select("SELECT id, nome FROM usuarios WHERE ativo='1' AND vendedor='1' ORDER BY nome");
		            		while($row = $db->expand($sql)){
		            			echo '<option value="'.$row['id'].'">'.$row['nome'].'</option>';
		            		}
		            	?>
		            </select>		            
		            <e class="icofont-thin-down"></e>	    
		        </div>
    		</div>	
    		
    		<?php //pagamento_compra ?>
	    			
	    			<div class="col-md-4">
	    				<button type="button" onclick="javascript:pagamento_compra();" class="btn btn-success btn-block text-center upper grande-botao">ENCERRAR (F2)</button>
	    			</div>	

	    			<div class="col-md-8">
	    				<div class="col-md-12 fim_pagamento text-right">
	    					<h199 id="total_final">TOTAL R$ <?php echo number_format($total_final_pedido,2,".",","); ?></h199>
	    				</div>
	    			</div>
	    		
    		
		</div>
		

	</form>
	</div>	

</div>


<input type="hidden" id="avanca-compra-enter" value="1">

<script>
	$(document).ready(function(){		
		$('#resumo-pedido-comanda').perfectScrollbar();	
		$('body').css('overflow', 'hidden');
			
	});	
</script>



<script src="javascript/usadas.js"></script>
<script src="javascript/teclas_atalho.js"></script>


