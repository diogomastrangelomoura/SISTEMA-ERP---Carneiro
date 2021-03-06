<?php 
include_once("../../admin/class/class.db.php");
include_once("../../admin/class/class.seguranca.php");
include_once("../../includes/verifica_session.php");
include_once("../../includes/verifica_caixa_aberto.php");
?>

<div id="oculta">

<div class="slim-pageheader">
  <ol class="breadcrumb slim-breadcrumb"></ol>
  <h6 class="slim-pagetitle upper">VENDAS REALIZADAS NO CAIXA ATUAL</h6>
</div>

		<div class="section-wrapper">
			<div class="table-responsive">
				  <table class="table table-striped">
				    
				    <thead>
				    	<tr>
				        	<th width="70">VENDA</th>
					        <th width="200">DATA/HORA</th>				        
					        <th>VALOR R$</th>
					        <th>OPERADOR</th>
					        <th width="5"></th>
					        <th width="5"></th>
						</tr>
				    </thead>
				    
				    <tbody>
				      <?php      
				      	
					    $sel = $db->select("SELECT vendas.*, usuarios.nome FROM vendas 
					    	LEFT JOIN usuarios ON vendas.id_usuario=usuarios.id
					    	WHERE vendas.tipo='1' AND  vendas.id_caixa='$id_caixa_aberto'
					    	ORDER BY vendas.id DESC");
						if($db->rows($sel)){
						while($dados = $db->expand($sel)){								
					  ?>
						     
						      <tr class="upper" id="venda_apaga<?php echo ($dados['id']); ?>">

						        <td>#<?php echo ($dados['id']); ?></td>
								<td><?php echo data_mysql_para_user($dados['data']); ?> ÁS <?php echo substr($dados['hora'],0,5); ?></td>						        
						        
						        <td class="upper">
						        	<?php echo 'R$ '.number_format($dados['valor_final_venda'],2,".",","); ?>				
						        </td>	

						    	<td><?php echo $dados['nome']; ?></td> 

						    	<td><a tabindex="-1" href="javascript:void(0);" onclick="javascript:verifica_venda(<?php echo $dados['id']; ?>)" class="thin">
          							<button tabindex="-1" class="btn btn-primary btn-sm"><i class="icofont-eye-alt"></i></button>
          						</a></td>

						    	<td><a tabindex="-1" href="javascript:void(0);" onclick="javascript:cancela_venda(<?php echo $dados['id']; ?>)" class="thin">
          							<button tabindex="-1" class="btn btn-danger btn-sm"><i class="icofont-ui-close"></i></button>
          						</a></td> 
						   	
						      </tr>
				      <?php
				      	}
				      } else {
				      	echo '<tr><td colspan="10"><center>NENHUMA VENDA ENCONTRADA</center></td></tr>';
				      }


				      ?>
				    </tbody>

				</table>
			</div>
		</div>	
</div>


<div id="detalhes_venda" class="hide"></div>

<script>
  $(document).ready(function(){    
    $('body').css('overflow', 'auto');      
  }); 
</script>


<script src="javascript/usadas.js"></script>			
