<?php require("../../includes/topo.php"); ?>

<?php
$edit=0;
if(isset($id)){
	$sql = $db->select("SELECT * FROM categorias WHERE id='$id' LIMIT 1");	
	$ln = $db->expand($sql);
	$edit=1;
}
?>

<div class="slim-pageheader">
  <ol class="breadcrumb slim-breadcrumb">
    <li class="breadcrumb-item"><a href="home">HOME</a></li>
    <li class="breadcrumb-item active" aria-current="page">CATEGORIAS</li>
  </ol>
  <h6 class="slim-pagetitle upper">
  		<?php
  			if($edit==1){
  				echo $ln['categoria'];
  			} else {
  				echo 'NOVA CATEGORIA';
  			}
  		?>
  </h6>
</div>


<form method="post" action="categorias/save">
<div class="section-wrapper">
  		
		<input class="form-control" type="hidden" name="id" value="<?php if($edit==1){ echo $id;} else {echo 0;} ?>">

  		<div class="form-layout">
            <div class="row mg-b-25">
              <div class="col-lg-10">
                <div class="form-group">
                  <label class="form-control-label">Categoria: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="categoria" required="required" value="<?php if($edit==1){ echo $ln['categoria'];} ?>">
                </div>
              </div><!-- col-4 -->
              

              <div class="col-lg-2">
                <div class="form-group mg-b-10-force">
                  <label class="form-control-label">Ativo: <span class="tx-danger">*</span></label>
                  <select class="form-control sel-gd select2" name="ativo"  required="required">
	                    <?php
	                		if($edit==1){
	                			
	                			if($ln['ativo']==1){
	                				echo '<option value="1" selected>SIM</option>';
	                				echo '<option value="0">NÃO</option>';
	                			}	

	                			else if($ln['ativo']==0){
	                				echo '<option value="0" selected>NÃO</option>';
	                				echo '<option value="1">SIM</option>';                				
	                			}

	                		} else {
	                				echo '<option value="1" selected>SIM</option>';
	                				echo '<option value="0">NÃO</option>';

	                		}
	                	?>	
                  </select>
                </div>
              </div><!-- col-4 -->



              <div class="col-md-12 top20">

              <div id="accordion2" class="accordion-two accordion-two-primary" >
                <div class="card">
                  <div class="card-header" role="tab" id="headingOne2">
                    <a data-toggle="collapse">
                      CONFIGURAÇÕES FISCAIS PARA A CATEGORIA
                    </a>
                  </div><!-- card-header -->

                  <div id="collapseOne2" class="collapse show" role="tabpanel" aria-labelledby="headingOne2">
                    
                    <div class="card-body" style="background-color: #FFF">
                           
                          <div class="row">  

                           

                            <div class="col-md-3">
                               <div class="form-group">
                                    <label for="exampleInputEmail1">NCM PADRÃO</label>
                                    <input type="number" onblur="javascript:valida_ncm(this.value);"  class="form-control" name="ncm_categoria" value="<?php if($edit==1){ echo $ln['ncm_categoria'];} ?>">
                                    <small id="esconde_frase">Em caso de não preenchimento no produto.</small>
                                    <small id="ncm_erro" class="hide red"><b>NCM NÃO ENCONTRADO</b></small>  
                               </div>
                            </div>

                            <div class="col-md-3">
                               <div class="form-group">
                                    <label for="exampleInputEmail1">CST PADRÃO</label>
                                    <input type="number"  class="form-control" name="cst_categoria" value="<?php if($edit==1){ echo $ln['cst_categoria'];} ?>">  
                                    <small >Em caso de não preenchimento no produto.</small>                                    
                               </div>
                            </div>

                            <div class="col-md-3">
                               <div class="form-group">
                                    <label for="exampleInputEmail1">CFOP PADRÃO</label>
                                    <input type="number"  class="form-control" name="cfop_categoria" value="<?php if($edit==1){ echo $ln['cfop_categoria'];} ?>">  
                                    <small >Em caso de não preenchimento no produto.</small>                                    
                               </div>
                            </div>

                             <div class="col-md-3">
                               <div class="form-group">
                                    <label for="exampleInputEmail1">CSOSN PADRÃO</label>
                                    <input type="number"  class="form-control" name="csosn_categoria" value="<?php if($edit==1){ echo $ln['csosn_categoria'];} ?>">  
                                    <small >Em caso de não preenchimento no produto.</small>                                    
                               </div>
                            </div>

                            <div class="col-md-12"> 
                              <div class="alert alert-warning thin">
                                  <i class="icofont-exclamation-tringle"></i> AS INFORMAÇÕES ACIMA, SÓ SÃO OBRIGATÓRIAS EM UTILIZAÇÃO FISCAL.
                              </div>
                            </div>


                          </div>    


                    </div>

                  </div>
                </div>
                
              </div><!-- accordion -->

          </div>

            </div><!-- row -->

            <div class="form-layout-footer">
              <button type="submit" class="btn btn-primary bd-0">SALVAR</button>        
              <button type="submit" onclick="javascript:salva_cadastro_insere();" class="btn btn-primary bd-0 pull-right">SALVAR E INSERIR MAIS</button>      
            </div><!-- form-layout-footer -->
          </div><!-- form-layout -->
             
  
</div>
</form>

<?php require("../../includes/rodape.php"); ?>