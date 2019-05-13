<?php 
include_once("../../admin/class/class.db.php");
include_once("../../admin/class/class.seguranca.php");
include_once("../../includes/verifica_session.php");
?>


			<div class="table-responsive" style="margin-top: 15px">
				  <table class="table table-striped">
				    
				    <thead>
				    	<tr>
				        	<th width="70">VENDA</th>
					        <th width="120">VENCIMENTO</th>				        
					        <th>VALOR R$</th>	
					        <th>SITUAÇÃO</th>				        
						</tr>
				    </thead>
				    
				    <tbody>
				      <?php      
				      	$saldo_devedor = 0;
						

					    $sel = $db->select("SELECT * FROM parcelas_contas_clientes WHERE id_cliente='$id'  ORDER BY data_pgto,  vencimento");
						if($db->rows($sel)){
						
						

						while($dados = $db->expand($sel)){								
					  ?>
						     
						      <tr class="cursor">

						        <td>#<?php echo ($dados['id_venda']); ?></td>
								<td><?php echo data_mysql_para_user($dados['vencimento']); ?></td>						        
						        
						        <td class="upper">
						        	<?php 
						        		echo 'R$ '.number_format($dados['valor'],2,".",",");
						        	?>						        	
						        </td>	

						     
						       	<td>
						       	<?php	
						       		if($dados['data_pgto']!='0000-00-00'){
						       			echo 'PAGO DIA '.data_mysql_para_user($dados['data_pgto']);
						       		} else {
						       			echo 'EM ABERTO';
						       		}
						       	?>
						       	</td>		        
						   
						      </tr>
				      <?php

				      	$saldo_devedor = ($saldo_devedor+$dados['valor']);

				      	}
				      } else {
				      	echo '<tr><td colspan="10"><center>NENHUM DÉBITO ENCONTRADO.</center></td></tr>';
				      }

				      ;
				      


				      ?>
				    </tbody>

				</table>
			</div>
