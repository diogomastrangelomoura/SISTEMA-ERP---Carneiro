<?php require("../../includes/topo.php"); ?>


<div class="slim-pageheader">
  <a href="nova-categoria"><button type="button" class="btn btn-primary  pull-right">NOVA CATEGORIA</button></a>
  <h6 class="slim-pagetitle">LISTAGEM DE CATEGORIAS</h6>
</div><!-- slim-pageheader -->


<div class="row row-sm">        
<div class="col-lg-12">
  <div class="card card-table">
  
              <div class="card-header">
                <h6 class="slim-card-title">CATEGORIAS CADASTRADAS</h6>
              </div>
              

              <div class="table-responsive">
                <table class="table mg-b-0 tx-13">
                  <thead>
                    <tr class="tx-10">
                    <th class="pd-y-5" width="20">CÓD</th>		
                      <th class="pd-y-5">CATEGORIA</th>                      
                      <th class="pd-y-5">MEIO-MEIO/ADICIONAIS</th>
                      <th class="pd-y-5"></th>
                      <th class="pd-y-5 tx-center"></th>
                    </tr>
                  </thead>
                  <tbody>

                <?php
                 $sel = $db->select("SELECT * FROM categorias ORDER BY categoria");
                
                if($db->rows($sel)){
                  $x=1; 
                  while($yy = $db->expand($sel)){  

                  	
                  	$ativo = ativo_produto($yy['ativo']);

                ?>    

                    <tr>
                     
                      <td class="valign-middle upper"><?php if($yy['id']<10){echo '0';} echo $yy['id']; ?></td>		
                      <td class="valign-middle upper"><?php echo $yy['categoria']; ?></td>
                      
                     
                      <td class="valign-middle">                                              
                        	<?php 
                        		if($yy['meio_meio']==1){
                        			echo 'SIM/';	
                        		} else {
                        			echo 'NÃO/';	
                        		}

                        		if($yy['adicionais']==1){
                        			echo 'SIM';	
                        		} else {
                        			echo 'NÃO';	
                        		}
                        	?>
                      </td>

					<td class="valign-middle">                                              
                        	<?php echo $ativo; ?>
                      </td>


                      <td class="valign-middle tx-center">
                        <a href="#" data-toggle="dropdown" class="tx-gray-600 tx-24">
                          <i class="icon ion-android-more-horizontal"></i>
                        </a>
                        <div class="dropdown-menu">
                          <nav class="nav dropdown-nav">
                            <a href="categorias/edit/<?php echo $yy['id']; ?>"  class="nav-link"><i class="icon ion-edit"></i> Editar Ítem</a>
                            <a href="categorias/delete/<?php echo $yy['id']; ?>" class="nav-link"><i class="icon ion-android-delete"></i> Excluir Ítem</a>                            
                          </nav>
                        </div>
                      </td>
                    </tr>


                  
                  <?php
                    }
                  }
                  ?>  

                  </tbody>
                </table>
              </div><!-- table-responsive -->
              
             
  </div>
</div>
</div>

<?php require("../../includes/rodape.php"); ?>