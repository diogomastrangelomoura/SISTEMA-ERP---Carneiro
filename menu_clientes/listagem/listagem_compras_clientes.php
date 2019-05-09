<?php 
include_once("../../admin/class/class.db.php");
include_once("../../admin/class/class.seguranca.php");
include_once("../../includes/verifica_session.php");
?>


			<div class="table-responsive">
				  <table class="table table-striped">
				    
				    
				    <tr>
				        <th width="40">ID</th>
				        <th width="200">DATA/HORA</th>				        
				        <th>VALOR R$</th>
				        <th>ATENDENTE</th>
				        <th width="10"></th>
				        <th width="10"></th>
				        <th width="10"></th>					        
				    </tr>	

				    <tbody>
				      <?php      
					      $sel = $db->select("SELECT vendas.*, usuarios.nome FROM vendas
					      LEFT JOIN usuarios ON vendas.id_usuario=usuarios.id 
					      WHERE vendas.id_cliente='$id' AND vendas.tipo='1'
					      ORDER BY vendas.id DESC, vendas.data DESC, vendas.hora DESC
					      ");
						if($db->rows($sel)){
						
							while($dados = $db->expand($sel)){
								

					  ?>
						     
						      <tr class="cursor upper" id="venda_apaga<?php echo ($dados['id']); ?>">
						        <td>#<?php echo ($dados['id']); ?></td>
						        <td><?php echo data_mysql_para_user($dados['data']); ?> ÁS <?php echo substr($dados['hora'],0,5);?>hs</td>						        
						        <td>R$ <?php echo number_format($dados['valor_final_venda'],2,".",","); ?></td>
						        <td><?php echo ($dados['nome']); ?></td>
						        
						        <td><a tabindex="-1" href="javascript:void(0);" onclick="javascript:reimprime_venda(<?php echo $dados['id']; ?>)" class="thin">
          							<button tabindex="-1" class="btn btn-primary btn-sm"><i class="icofont-print"></i></button>
          						</a></td>

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
				      	echo '<tr><td colspan="10"><center>NENHUMA VENDA ENCONTRADA PARA O CLIENTE!</center></td></tr>';
				      }
				      ?>
				    </tbody>

				</table>
			</div>
