<?php 
include_once("../../admin/class/class.db.php");
include_once("../../admin/class/class.seguranca.php");
include_once("../../includes/verifica_session.php");

$sql = $db->select("SELECT * FROM vendas WHERE id='$id' LIMIT 1");
$dados_venda = $db->expand($sql);

$id_cliente = $dados_venda['id_cliente'];
$sql = $db->select("SELECT nome FROM clientes WHERE id='$id_cliente' LIMIT 1");
$dados_cliente = $db->expand($sql);


$id_vendedor = $dados_venda['id_vendedor'];
$sql = $db->select("SELECT nome FROM vendedores WHERE id='$id_vendedor' LIMIT 1");
$dados_vendedor = $db->expand($sql);
?>




<div class="row" id="container_geral_pedido">

	<div class="col-md-5" >

  		<div class="card-header tx-small bd-0 tx-white bg-primary">ÍTENS DO CUPOM DE VENDA</div>

		<div class="card" id="resumo-pedido-comanda">
				<?php 
					$venda_ja_efetuada = $id;
					require("../listagem/listagem_itens_compra.php"); 
				?>
		</div>	

	</div>

	<div class="col-md-7 ">
	<div class="card">					
					
					<div class="col-md-12">
					<div class="slim-pageheader" style="margin-top: -5px">
					  <ol class="breadcrumb slim-breadcrumb"></ol>
					  <h6 class="slim-pagetitle upper">DETALHES DA VENDA: #<?php echo $id ?></h6>
					</div>
					</div>
					
					<hr style="margin-top: 0px">
					

						<div class="col-md-12">
						  <label class="section-label-md">DATA/HORA:</label>
	                      <span class="upper" style="color: #000">
	                      <?php 
	                        echo data_mysql_para_user($dados_venda['data']); ?> ÁS <?php echo substr($dados_venda['hora'],0,5);
	                      ?>
	                      </span>  

	                      <a tabindex="-1" href="javascript:void(0);" onclick="javascript:reimprime_venda(<?php echo $id; ?>)" class="thin">
		          							<button tabindex="-1" class="btn btn-primary btn-sm pull-right">
		          								<i class="icofont-print"></i> REIMPRIMIR VENDA
		          							</button>
		          		  </a>

	                    </div>

	                    <div class="col-md-12">
	                      <label class="section-label-md">CLIENTE:</label>
	                      <span class="upper" style="color: #000">
	                      <?php 
	                        if($id_cliente!=0){
	                        	echo $dados_cliente['nome'];
	                        } else {
	                        	echo 'NÃO INFORMADO';
	                        } 
	                      ?>
	                      </span> 
	                                 
	                     </div>   


	                      <div class="col-md-12">
	                      <label class="section-label-md">VENDEDOR:</label>
	                      <span class="upper" style="color: #000">
	                      <?php 
	                        if($id_cliente!=0){
	                        	echo $dados_vendedor['nome'];
	                        } else {
	                        	echo 'NÃO INFORMADO';
	                        } 
	                      ?>
	                      </span> 
	                      <hr>             
	                     </div>        

	                     <div class="col-md-12">
			                <div class="table-responsive mg-t-10">
			                  <table class="table table-invoice" style="border:0">
			                    
			                    <tbody>
			                                      
			                      <tr style="border:0">
			                        <td class="tx-right" style="border:0">SUBTOTAL:</td>
			                        <td class="tx-right" width="150" style="border:0">R$ <?php echo number_format($dados_venda['valor_total'],2,",","."); ?></td>
			                      </tr>
			                      <tr>
			                        <td class="tx-right">DESCONTO (-):</td>
			                        <td class="tx-right">R$ <?php echo number_format($dados_venda['valor_desconto'],2,",","."); ?></td>
			                      </tr>                     
			                      <tr>
			                        <td class="tx-right tx-uppercase tx-bold tx-inverse">TOTAL GERAL:</td>
			                        <td class="tx-right"><h4 class="tx-primary tx-bold tx-lato">R$ <?php echo number_format($dados_venda['valor_final_venda'],2,",","."); ?></h4></td>
			                      </tr>
			                    </tbody>
			                  </table>
			                </div>
            			</div>     

            			<div class="col-md-12 top15">
            				<div class="card-header tx-small bd-0 tx-white bg-primary top15">VALORES RECEBIDOS</div>
            				<div class="table-responsive mg-t-10">
				                <table class="table table-invoice" style="border:0">
				                    
				                  <tbody>
				                    <?php
				                      $sel = $db->select("SELECT pagamentos_vendas.*, formas_pagamento.forma, usuarios.nome FROM pagamentos_vendas 
				                        LEFT JOIN formas_pagamento ON pagamentos_vendas.forma_pagamento=formas_pagamento.id
				                        LEFT JOIN usuarios ON pagamentos_vendas.id_usuario=usuarios.id
				                        WHERE pagamentos_vendas.id_venda='$id'
				                        ORDER BY pagamentos_vendas.id
				                        ");
				                      if($db->rows($sel)){
				                    while($dados = $db->expand($sel)){
				                  ?>
				                    <tr>
				                      <td width="200" class="upper thin"><?php echo data_mysql_para_user($dados['data']); ?> ás <?php echo substr($dados['hora'],0,5); ?></td>
				                      <td class="upper thin"><?php echo ($dados['nome']); ?></td>
				                      <td class="upper thin"><?php echo ($dados['forma']); ?></td>
				                      <td class="upper thin">R$ <?php echo number_format($dados['valor_pagamento'],2,",","."); ?></td>
				                      
				                    </tr>
				                    <?php
				                      }}
				                    ?>                                    
				                  </tbody>
				                </table>
				              </div>
            			</div>
                   
     
	 </div>               
	</div>

	

</div>	




<script>
	$(document).ready(function(){		
		$('#resumo-pedido-comanda').perfectScrollbar();	
		$('body').css('overflow', 'auto');
			
	});	
</script>