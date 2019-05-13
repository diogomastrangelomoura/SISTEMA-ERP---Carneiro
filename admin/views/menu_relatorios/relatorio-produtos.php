<?php require("../../includes/topo.php"); ?>

<div class="slim-pageheader">
  <ol class="breadcrumb slim-breadcrumb">
    <li class="breadcrumb-item"><a href="home">HOME</a></li>
    <li class="breadcrumb-item active" aria-current="page">RELATÓRIOS</li>
  </ol>
  <h6 class="slim-pagetitle upper">
    RELATÓRIO DE PRODUTOS
  </h6>
</div>


<form method="post" action="relatorio-produtos">
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

         <div class="col-lg-3">              
              <div class="input-group">

              <select id="categoria" name="categoria" class="form-control select2-show-search upper" data-placeholder="ESCOLHA A CATEGORIA" onchange="javascript:carrega_produtos(this.value);">
                <option value="" label="Categoria"></option>
                <option value="0">NENHUM</option>
                <?php

                		if(isset($categoria) && $categoria!='' && $categoria!='0'){
                			$sel = $db->select("SELECT id, categoria FROM categorias WHERE id='$categoria' LIMIT 1");
                			$row = $db->expand($sel);
                			echo '<option value="'.$row['id'].'" selected>'.$row['categoria'].'</option>';                		
                		}

                		$sel = $db->select("SELECT id, categoria FROM categorias ORDER BY categoria");
                		while($row = $db->expand($sel)){
                			echo '<option value="'.$row['id'].'">'.$row['categoria'].'</option>';
                		}
                ?>
              </select>                  
                
              </div>
         </div>





         <div class="col-lg-3">              
              <div class="input-group">

              <select id="produto" name="produto" class="form-control select2-show-search upper" >
                <option value="">ESCOLHA O PRODUTO</option>
                <option value="0">NENHUM</option>
                <?php

                		if(isset($produto) && $produto!='' && $produto!='0'){
                			$sel = $db->select("SELECT id, produto FROM produtos WHERE id='$produto' LIMIT 1");
                			$row = $db->expand($sel);
                			echo '<option value="'.$row['id'].'" selected>'.$row['produto'].'</option>';                		
                		}

                		if(isset($categoria) && $categoria!=''){
                			$sel = $db->select("SELECT id, produto FROM produtos WHERE id!='$produto' AND categoria='$categoria' ORDER BY produto");
                			while($row = $db->expand($sel)){
                				echo '<option value="'.$row['id'].'">'.$row['produto'].'</option>';                		
                			}
                		}
                ?>
              </select>                  
                
              </div>
         </div>


         <div class="col-lg-3 top15">              
              <div class="input-group">

              <select id="categoria" name="fornecedor" class="form-control select2-show-search upper" data-placeholder="ESCOLHA O FORNECEDOR" >
                <option value="" label="Fornecedor"></option>
                <option value="0">NENHUM</option>
                <?php

                		if(isset($fornecedor) && $fornecedor!='' && $fornecedor!='0'){
                			$sel = $db->select("SELECT id, fornecedor FROM fornecedores WHERE id='$fornecedor' LIMIT 1");
                			$row = $db->expand($sel);
                			echo '<option value="'.$row['id'].'" selected>'.$row['fornecedor'].'</option>';                		
                		}

                		$sel = $db->select("SELECT id, fornecedor FROM fornecedores ORDER BY fornecedor");
                		while($row = $db->expand($sel)){
                			echo '<option value="'.$row['id'].'">'.$row['fornecedor'].'</option>';
                		}
                ?>
              </select>                  
                
              </div>
         </div>


         <div class="col-lg-3 top15">  
         	<button type="submit" class="btn btn-primary bd-0">GERAR RELATÓRIO</button> 
         </div>	


     	</div><!-- row -->
	</div><!-- form-layout -->         
  
</div>
</form>




<div class="row row-sm" style="margin-top: 15px">        
<div class="col-lg-12">
  <div class="card card-table">
  
             
              <div class="table-responsive">
                <table class="table mg-b-0 tx-13">
                  <thead>
                    <tr class="tx-10">
                    	<th class="pd-y-5">PRODUTO</th>                                                                  
                    	<th class="pd-y-5" width="140">ESTOQUE ATUAL</th>
                    	<th class="pd-y-5" width="140">PREÇO CUSTO</th>
                    	<th class="pd-y-5" width="140">PREÇO VENDA</th>
                    	<th class="pd-y-5" width="180">VENDIDO NO PERÍODO</th>                      	
                    </tr>
                  </thead>
                  <tbody>

                  	<?php 
                  	if(isset($pesquisa)){  

                  			$busca = "id!='0'";
                  			if($categoria!='' && $categoria!='0'){$busca .= " AND categoria='$categoria'";}
                  			if($produto!='' && $produto!='0'){$busca .= " AND id='$produto'";}
                  			if($fornecedor!='' && $fornecedor!='0'){$busca .= " AND id_fornecedor='$fornecedor'";}

					      	$sel = $db->select("SELECT id_fornecedor, id, codigo, produto, estoque, preco_compra, preco_venda 
					      		FROM produtos WHERE $busca ORDER BY produto");


							if($db->rows($sel)){
								while($px = $db->expand($sel)){

										$qtd_vendido=0;
										$id_prd = $px['id'];
										$id_forn = $px['id_fornecedor'];

										$nome_forn = 'Ñ INFORMADO';
										$pen = $db->select("SELECT fornecedor FROM fornecedores WHERE id='$id_forn' LIMIT 1");
										if($db->rows($pen)){
											$peg_mal = $db->expand($pen);
											$nome_forn = $peg_mal['fornecedor'];
										}
									    
									    $venda_vendido = $db->select("SELECT id_venda FROM produtos_venda WHERE id_produtos='$id_prd' GROUP BY id_venda");	
									    if($db->rows($venda_vendido)){
									    	while($px2 = $db->expand($venda_vendido)){
									    	
										    	$id_venda = $px2['id_venda'];
												$venda = $db->select("SELECT data FROM vendas WHERE id='$id_venda' LIMIT 1");
												$dados_venda = $db->expand($venda);
												
												
												if($dados_venda['data']>=$data_inicio && $dados_venda['data']<=$data_fim){
												
													$prod_vendido = $db->select("SELECT SUM(quantidade) AS total FROM produtos_venda WHERE id_produtos='$id_prd' AND id_venda='$id_venda'");
													$mel = $db->expand($prod_vendido); 

													if($mel['total']!=''){
														$qtd_vendido=($qtd_vendido+$mel['total']);
													}	


												} 

											}

									    }
										
										
										
										if($expa['total']!=''){
											$qtd_vendido = $expa['total'];				
										}
																															
										echo '<tr>';
									    	
									    	echo '<td class="valign-middle upper"><b>'.$nome_forn.'</b><br>'.$px['produto'].'</td>';			
									    	echo '<td class="valign-middle upper" align="center">'.$px['estoque'].'</td>';			
									    	
									    	echo '<td class="valign-middle upper" align="center">R$ '.$px['preco_compra'].'</td>';		
									    	echo '<td class="valign-middle upper" align="center">R$ '.$px['preco_venda'].'</td>';	

									    	echo '<td class="valign-middle upper" align="center">'.$qtd_vendido.'</td>';					
									        
									    echo '</tr>';	

								}
							} else {

								echo '<tr><td  class="valign-middle upper" colspan="10"><center>NENHUM PRODUTO ENCONTRADO!</center></td></tr>';

							}
											
					  } else {

					  		echo '<tr><td  class="valign-middle upper" colspan="10"><center>EFETUE A PESQUISA ACIMA PARA EXIBIR RESULTADOS</center></td></tr>';

					  }		

					  ?>

                  
                
                  </tbody>
                </table>
              </div>
              
             
  </div>
</div>
</div>

<?php require("../../includes/rodape.php"); ?>