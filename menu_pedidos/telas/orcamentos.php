<?php 
include_once("../../admin/class/class.db.php");
include_once("../../admin/class/class.seguranca.php");
include_once("../../includes/verifica_session.php");
?>



<div class="slim-pageheader">
  <ol class="breadcrumb slim-breadcrumb"></ol>
  <h6 class="slim-pagetitle upper">ORÇAMENTOS AGUARDANDO</h6>
</div>

		<div class="section-wrapper">
			<div class="table-responsive">
				  <table class="table table-striped">
				    
				    <thead>
				    	<tr>
				        	<th width="70">ID</th>
					        <th width="200">DATA/HORA</th>				        
					        <th>VALOR R$</th>
					        <th>CLIENTE</th>
					        <th width="5"></th>
					        <th width="5"></th>
						</tr>
				    </thead>
				    
				    <tbody>
				      <?php      
				      	
					    $sel = $db->select("SELECT vendas.*, clientes.nome FROM vendas 
					    	LEFT JOIN clientes ON vendas.id_cliente=clientes.id
					    	WHERE vendas.tipo='2' 
					    	ORDER BY vendas.id DESC");
						if($db->rows($sel)){
						while($dados = $db->expand($sel)){								
					  ?>
						     
						      <tr class="upper" id="apaga<?php echo $dados['id']; ?>">

						        <td>#<?php echo ($dados['id']); ?></td>
								<td><?php echo data_mysql_para_user($dados['data']); ?> ÁS <?php echo substr($dados['hora'],0,5); ?></td>						        
						        
						        <td class="upper">
						        	<?php echo 'R$ '.number_format($dados['valor_final_venda'],2,".",","); ?>				
						        </td>	

						    	<td><?php echo $dados['nome']; ?></td> 

						    	<td><a tabindex="-1" href="javascript:void(0);" onclick="javascript:exibe_orcamento(<?php echo $dados['id']; ?>)" class="thin">
          							<button tabindex="-1" class="btn btn-primary btn-sm"><i class="icofont-eye-alt"></i></button>
          						</a></td>

						    	<td><a tabindex="-1" href="javascript:void(0);" onclick="javascript:exclui_orcamento(<?php echo $dados['id']; ?>)" class="thin">
          							<button tabindex="-1" class="btn btn-danger btn-sm"><i class="icofont-ui-close"></i></button>
          						</a></td> 
						   	
						      </tr>
				      <?php
				      	}
				      } else {
				      	echo '<tr><td colspan="10"><center>NENHUM ORÇAMENTO ENCONTRADO</center></td></tr>';
				      }


				      ?>
				    </tbody>

				</table>
			</div>
		</div>	


<script>
  $(document).ready(function(){    
    $('body').css('overflow', 'auto');      
  }); 
</script>


<script src="javascript/usadas.js"></script>			
