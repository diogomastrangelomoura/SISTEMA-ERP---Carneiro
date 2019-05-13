<?php
require("../../admin/class/class.db.php");
require("../../admin/class/class.seguranca.php");
require("../../includes/verifica_session.php");

$dados_proc = $db->select("SELECT * FROM clientes WHERE id='$id' LIMIT 1");
$dados = $db->expand($dados_proc);
?>


<div class="slim-pageheader">
  <ol class="breadcrumb slim-breadcrumb">
  	<li class="breadcrumb-item"><a href="home"><?php //echo data_mysql_para_user($dados['data_cadastro']); ?></a></li>
  </ol>
  <h6 class="slim-pagetitle upper"><?php echo $dados['nome']; ?></h6>
</div>

<div class="row">
	
	<div class="col-md-12">

			<ul class="nav nav-activity-profile">
		        
		        <li class="nav-item"><a style="border-bottom: 0" href="javascript:void(0)" class="nav-link muda_tabs" data-id="1">Dados Principais</a></li>

		       
		        <li class="nav-item"><a style="border-bottom: 0" href="javascript:void(0)" class="nav-link muda_tabs" data-id="2">Compras Realizadas</a></li>

		        <li class="nav-item"><a style="border-bottom: 0" href="javascript:void(0)" class="nav-link muda_tabs" data-id="3">Crediário</a></li>
		        		        
		    </ul>

		
	<div class="section-wrapper">
			
			
	  		<div class="form-layout">
	        	
	        	<form method="post" action="menu_clientes/actions/atualiza_cliente.php" id="FormAtualizaCadastroCliente">
		        <div class="row tabs" id="tab1">

		        	

		        		<input class="form-control" type="hidden" name="id" id="id" value="<?php echo $id; ?>">
		             	
		             	<div class="col-lg-12">
			                <div class="form-group">
			                  <label class="form-control-label">Nome: <span class="tx-danger">*</span></label>
			                  <input class="form-control upper" type="text" name="nome" required="required" value="<?php echo $dados['nome']; ?>">
			                </div>
			              </div><!-- col-4 -->

			              <div class="col-lg-4">
			                <div class="form-group">
			                  <label class="form-control-label">CPF/CNPJ: <span class="tx-danger">*</span></label>
			                  <input class="form-control upper" type="text" name="cpf_cnpj" required="required" value="<?php echo $dados['cpf_cnpj']; ?>" readonly>
			                </div>
			              </div><!-- col-4 -->
			             			             
			              <div class="col-lg-4">
			                <div class="form-group">
			                  <label class="form-control-label">Telefone Principal: <span class="tx-danger">*</span></label>
			                  <input class="form-control upper" type="text" name="telefone" id="telefone" required="required" value="<?php echo $dados['telefone']; ?>">
			                </div>
			              </div><!-- col-4 -->

			              <div class="col-lg-4">
			                <div class="form-group">
			                  <label class="form-control-label">Telefone Secundário:</label>
			                  <input class="form-control upper" type="text" name="celular" id="celular" value="<?php echo $dados['celular']; ?>">
			                </div>
			              </div><!-- col-4 -->			              

		       			<div class="col-lg-12"><hr></div>
		             	
		             	<div class="col-lg-10 top10">
			                <div class="form-group">
			                  <label class="form-control-label">Endereço: <span class="tx-danger">*</span></label>
			                  <input class="form-control upper" type="text" name="endereco" required="required" value="<?php echo $dados['endereco']; ?>">
			                </div>
			            </div><!-- col-4 -->
			             			             
			              <div class="col-lg-2 top10">
			                <div class="form-group">
			                  <label class="form-control-label">Nº: <span class="tx-danger">*</span></label>
			                  <input class="form-control upper" type="text" name="numero" required="required" value="<?php echo $dados['numero']; ?>">
			                </div>
			              </div><!-- col-4 -->

			              

			              <div class="col-lg-4">
			                <div class="form-group">
			                  <label class="form-control-label">Bairro:</label>
			                  <input class="form-control upper" type="text" name="bairro" value="<?php echo $dados['bairro']; ?>">
			                </div>
			              </div><!-- col-4 -->			

			              <div class="col-lg-2">
			                <div class="form-group">
			                  <label class="form-control-label">UF:</label>
			                  <select class="form-control input-md upper" name="estado" onchange="javascript:filtra_cidades(this.value);">
			                  	<?php
			                  		if($dados['estado']!=0){
			                  			$estado = $dados['estado'];
			                  			$pesq = $db->select("SELECT * FROM cad_estado WHERE estado_cod='$estado' LIMIT 1");
			                  			$est = $db->expand($pesq);

			                  			echo '<option value="'.$est['estado_cod'].'">'.$est['estado_uf'].'</option>';
			                  		} else {
			                  			$estado=0;
			                  			echo '<option value="">-- UF --</option>';
			                  		}

			                  			$pesq = $db->select("SELECT * FROM cad_estado WHERE estado_cod!='$estado' ORDER BY estado_uf");
			                  			while($est = $db->expand($pesq)){
			                  				echo '<option value="'.$est['estado_cod'].'">'.$est['estado_uf'].'</option>';	
			                  			}

			                  	?>
			                  </select>	
			                </div>
			              </div><!-- col-4 -->	

			              <div class="col-lg-4">
			                <div class="form-group">
			                  <label class="form-control-label">Cidade:</label>
			                  <select class="form-control input-md upper" name="cidade" id="cidade">
			                  	<?php
			                  		if($dados['cidade']!=0){
			                  			$cidade = $dados['cidade'];
			                  			$estado = $dados['estado'];

			                  			$pesq = $db->select("SELECT * FROM cad_cidade WHERE cidade_cod_ibge='$cidade' LIMIT 1");
			                  			$est = $db->expand($pesq);
										echo '<option value="'.$est['cidade_cod_ibge'].'" selected>'.$est['cidade_nome'].'</option>';


										$pesq = $db->select("SELECT * FROM cad_cidade WHERE cidade_id_estado='$estado' ORDER BY cidade_nome");
			                  			while($est = $db->expand($pesq)){
			                  				echo '<option value="'.$est['cidade_cod_ibge'].'">'.$est['cidade_nome'].'</option>';	
			                  			}

			                  		} else {
			                  			$estado=0;
			                  			echo '<option value="">-- ESCOLHA --</option>';
			                  		}

			                  			

			                  	?>
			                  </select>	
			                </div>
			              </div><!-- col-4 -->

			              <div class="col-lg-2">
			                <div class="form-group">
			                  <label class="form-control-label">CEP:</label>
			                  <input class="form-control" type="text" name="cep" value="<?php echo $dados['cep']; ?>">
			                </div>
			              </div><!-- col-4 -->	 

			              <div class="col-md-12" >
			        		<hr>
				            <button type="submit" class="btn btn-primary bd-0" id="btn_atualiza_dados">ATUALIZAR DADOS</button>
				            
				            <div class="alert alert-success top10 hide" id="aviso_cadastro">
				            	<i class="icofont-verification-check"></i> CADASTRO DO CLIENTE ATUALIZADO COM SUCESSO
				            </div> 	
				          </div>

				          

		        </div>
		        </form>

		        <div class="row tabs" id="tab2">
         			<?php include_once("../listagem/listagem_compras_clientes.php"); ?>
		        </div> 

				<div class="row tabs" id="tab3">
         			
					<div class="col-md-8" id="atualiza_aqui">


						<ul class="nav nav-activity-profile">
		        
					        <li  class="nav-item"><a  href="javascript:void(0)" class="nav-link active muda_tabs_internas" data-id="20">Débitos</a></li>

					       
					        <li class="nav-item"><a  href="javascript:void(0)" class="nav-link muda_tabs_internas" data-id="21">Pagamentos Recebidos</a></li>
					    </ul>
					        
					      

						        <div class="tabs_internas" id="tab20" style="display: flex; ">
						        	
						        		<?php include_once("../listagem/listagem_crediario_cliente.php"); ?>
						        	
						        </div>	

						        <div class="tabs_internas" id="tab21">
						        	
						        	<?php include_once("../listagem/listagem_pagamentos_cliente.php"); ?>
						        </div>


					    

						
					</div>	

					<div class="col-md-4">
						

						<input  type="hidden"  id="devido" value="<?php echo $devedor_final; ?>">


						<div class="card-header tx-small bd-0 tx-white bg-primary">
		                  RECEBIMENTO DE CONTAS
		                </div>

		                <div class="card card-status">
			              <div class="media">
			              	<i class="icon icofont-ui-calculator tx-danger"></i>			                
			                <div class="media-body">
			                  <h1>R$ <span id="atualiza_devido"><?php echo number_format($devedor_final,2,".",","); ?></span></h1>
			                  <p>SALDO DEVEDOR</p>
			                </div><!-- media-body -->
			              </div><!-- media -->
			            </div>

			            <div class="card card-status" style="border-top: 0">
			              <div class="row">
			                
			                <div class="col-md-12">				               
			                  <input  type="text" class="form-control text-center input-lg valores" id="pagamento" placeholder="0.00" style="font-size: 30px; " onkeyup="javascript:faz_troco_pgto_compra_cliente(this.value);">
			                </div>  
			                
			                <div class="col-md-12 top10">				               
			                  	<select class="form-control text-center input-lg upper cent" id="forma">
	           						<option value="">FORMA DE PAGAMENTO</option>
	           						<?php
	           							$sql = $db->select("SELECT * FROM formas_pagamento WHERE id!='3' ORDER BY forma");
	           							while($line = $db->expand($sql)){
	           								echo '<option value="'.$line['id'].'">'.$line['forma'].'</option>';
	           							}
	           						?>
	           					</select>	
			                </div> 
			                
			              </div><!-- media -->
			            </div>


			            <div class="card card-status" style="border-top: 0">
			              <div class="media">
			                <i class="icon icofont-money tx-success"></i>
			                <div class="media-body">
			                  <h1>R$ <span id="troco">0.00</span></h1>
			                  <p>TROCO</p>
			                </div><!-- media-body -->
			              </div><!-- media -->
			            </div>

			           		<div class="input-group" >
	  	 						<button type="button" onclick="javascript:recebe_crediario()"  class="btn btn-success btn-block text-center upper grande-botao" style="border-top: 0" id="botao_recebe_crediario">RECEBER</button>
	  	 					</div>


						


					</div>	

		        </div> 		           


	        	


		    </div>

	</div>  	

	              				
</div> 


</div>

<script>
  $(document).ready(function(){   

  	var SPMaskBehavior = function (val) {
    return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
	  },
	  spOptions = {
	    onKeyPress: function(val, e, field, options) {
	        field.mask(SPMaskBehavior.apply({}, arguments), options);
	      }
	  };

	  $('#telefone, #celular').mask(SPMaskBehavior, spOptions);

    $('body').css('overflow', 'auto');
      
  }); 
</script>

<script src="javascript/clientes.js"></script>
<script src="javascript/caixa.js"></script>
<script src="javascript/usadas.js"></script>
