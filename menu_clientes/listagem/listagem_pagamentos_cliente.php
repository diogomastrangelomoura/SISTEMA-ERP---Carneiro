<?php 
include_once("../../admin/class/class.db.php");
include_once("../../admin/class/class.seguranca.php");
include_once("../../includes/verifica_session.php");
?>


			<div class="table-responsive" style="margin-top: 15px">
				  <table class="table table-striped">
				    
				    <thead>
				    	<tr>
				        	<th width="70">ID</th>
					        <th width="120">DATA/HORA</th>				        
					        <th>VALOR R$</th>
					        <th>FORMA PGTO</th>					        
					        <th></th>
						</tr>
				    </thead>
				    
				    <tbody>
				      <?php      
				      	
						$saldo_pago = 0;

					    $sel = $db->select("SELECT * FROM contas_clientes WHERE id_cliente='$id' AND tipo='1' ORDER BY id DESC");
						if($db->rows($sel)){
						
						

						while($dados = $db->expand($sel)){		

						$saldo_pago = ($saldo_pago+$dados['valor_recebe']);						
					  ?>
						     
						      <tr class="cursor">

						        <td>#<?php echo ($dados['id']); ?></td>
								<td><?php echo data_mysql_para_user($dados['data_debito']); ?></td>						        
						        
						        <td class="upper">
						        	<?php 
						        		echo 'R$ '.number_format($dados['valor_recebe'],2,".",",");
						        	?>						        	
						        </td>	

						        <td class="upper">
						        	<?php 
						        		$forma = $dados['forma_pagamento'];
						        		$nome_forma = '';
						        		if($forma!=0){
						        			$san = $db->select("SELECT forma FROM formas_pagamento WHERE id='$forma' LIMIT 1");
						        			$form = $db->expand($san);
						        			$nome_forma = $form['forma'];
						        		}
						        		echo $nome_forma;
						        	?>						        	
						        </td>
						        
						        

						        <?php
						        	if($dados['tipo']==1){
						        ?>
						        <td><a tabindex="-1" href="javascript:void(0);" onclick="javascript:reimprime_comp_pgto_crediario(<?php echo $dados['id']; ?>)" class="thin">
          							<button tabindex="-1" class="btn btn-primary btn-sm"><i class="icofont-print"></i></button>
          						</a></td>
          						<?php
						        	}else{
						        ?>	
						        <td></td>
								<?php
						        	}
						        ?>							        
						   
						      </tr>
				      <?php
				      	}
				      } else {
				      	echo '<tr><td colspan="10"><center>NENHUM PAGAMENTO ENCONTRADO.</center></td></tr>';
				      }

				      $devedor_final = ($saldo_devedor-$saldo_pago);
				      if($devedor_final<0){$devedor_final=0;}


				      ?>
				    </tbody>

				</table>
			</div>
