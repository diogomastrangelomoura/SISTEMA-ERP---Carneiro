<?php require("../../includes/topo.php"); ?>

<div class="slim-pageheader">
  <ol class="breadcrumb slim-breadcrumb">
    <li class="breadcrumb-item"><a href="home">HOME</a></li>
    <li class="breadcrumb-item active" aria-current="page">RELATÓRIOS</li>
  </ol>
  <h6 class="slim-pagetitle upper">
    ESTOQUE CRÍTICO
  </h6>
</div>



<div class="row row-sm" >        
<div class="col-lg-12">
  <div class="card card-table">
  
             
              <div class="table-responsive">
                <table class="table mg-b-0 tx-13">
                  <thead>
                    <tr class="tx-10">
                    	<th class="pd-y-5">PRODUTO</th>                                                                  
                    	<th class="pd-y-5" width="160">ESTOQUE ATUAL</th>
                    	<th class="pd-y-5" width="160">ESTOQUE MÍNIMO</th>
                    </tr>
                  </thead>
                  <tbody>

                  	<?php   


					      	$sel = $db->select("SELECT codigo, produto, estoque, estoque_minimo FROM produtos WHERE estoque<=estoque_minimo ORDER BY produto");
							
							if($db->rows($sel)){
								while($px = $db->expand($sel)){

										echo '<tr>';
									    	
									    	echo '<td class="valign-middle upper"><b>'.$px['codigo'].'</b><br>'.$px['produto'].'</td>';			
									    	echo '<td class="valign-middle upper" align="center">'.$px['estoque'].'</td>';			
									    	echo '<td class="valign-middle upper" align="center">'.$px['estoque_minimo'].'</td>';			
									        
									    echo '</tr>';	

								}
							} else {

								echo '<tr><td  class="valign-middle upper" colspan="10"><center>NENHUM PRODUTO COM ESTOQUE CRITÍCO ENCONTRADO!</center></td></tr>';

							}
											


					  ?>
						     
						      


				      

                  
                
                  </tbody>
                </table>
              </div>
              
             
  </div>
</div>
</div>

<?php require("../../includes/rodape.php"); ?>