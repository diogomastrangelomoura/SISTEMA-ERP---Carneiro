<?php require("../../includes/topo.php"); ?>

<?php
$edit=0;
if(isset($id)){
	$sql = $db->select("SELECT * FROM produtos WHERE id='$id' LIMIT 1");	
	$ln = $db->expand($sql);
	$edit=1;
}
?>

<div class="slim-pageheader">
  <ol class="breadcrumb slim-breadcrumb">
    <li class="breadcrumb-item"><a href="home">HOME</a></li>
    <li class="breadcrumb-item active" aria-current="page">PRODUTOS</li>
  </ol>
  <h6 class="slim-pagetitle upper">
  		<?php
  			if($edit==1){
  				echo $ln['produto'];
  			} else {
  				echo 'NOVO PRODUTO';
  			}
  		?>
  </h6>
</div>


<form method="post" action="produtos/save" enctype="multipart/form-data">
<div class="row">


<div class="col-md-8">

	<ul class="nav nav-activity-profile">
        <li class="nav-item"><a style="border-bottom: 0" href="javascript:void(0)" class="nav-link muda_tabs" data-id="1">Dados Principais</a></li>
        
        <li class="nav-item"><a style="border-bottom: 0" href="javascript:void(0)" class="nav-link muda_tabs" data-id="2">Impostos</a></li>
       
        
    </ul>

	<div class="section-wrapper">
		
			<input class="form-control" type="hidden" name="id" value="<?php if($edit==1){ echo $id;} else {echo 0;} ?>">

	  		<div class="form-layout">
	        
	        <div class="row tabs" id="tab1">

	              <div class="col-lg-10">
	                <div class="form-group">
	                  <label class="form-control-label">Código de Barras:</label>
                    <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text"><i class="icofont-barcode"></i></span>
                              </div>
                              <input class="form-control" type="text" id="codigo" name="codigo" required value="<?php if($edit==1){ echo $ln['codigo'];} ?>">
                              <span class="input-group-btn">
                                <button class="btn btn-primary" onclick="javascript:gera_codebar();" type="button"><i class="icofont-verification-check"></i> GERAR</button>
                            </span> 
                            </div>
	                  
	                </div>
	              </div>

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
                </div>

	              <div class="col-lg-12">
	                <div class="form-group">
	                  <label class="form-control-label">Produto:</label>
	                  <input class="form-control" type="text"  name="produto" required="required" value="<?php if($edit==1){ echo $ln['produto'];} ?>">
	                </div>
	              </div>


                <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Preço Custo</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text">R$</span>
                              </div>
                             
                              <input  class="form-control valores" name="preco_compra" id="preco_compra" value="<?php if($edit==1){ echo $ln['preco_compra'];} ?>">
                            </div>
                              
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Preço Venda</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text">R$</span>
                              </div>
                              <input class="form-control valores" name="preco_venda" id="preco_venda" value="<?php if($edit==1){ echo $ln['preco_venda'];} ?>" required>  
                            </div>
                            
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Margem Lucro %</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text">%</span>
                              </div>
                              <input  class="form-control valores" name="margem_lucro" id="margem_lucro" value="<?php if($edit==1){ echo $ln['margem_lucro'];} ?>">  
                              <span class="input-group-btn">
                                <button onclick="javascript:gera_margem_produto();" class="btn btn-primary" type="button"><i class="icofont-verification-check"></i></button>
                            </span> 
                            </div>
                            
                        </div>
                    </div>
	          
	              

	        </div>



	        <div class="row tabs" id="tab2">

	        		   <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">NCM</label>

                            <div class="input-group">                              
                              <input type="number" onblur="javascript:valida_ncm(this.value);"   class="form-control" name="ncm" value="<?php if($edit==1){ echo $ln['ncm'];} ?>">  
                              <span class="input-group-btn">
                                <button class="btn btn-primary" tabindex="-1" onclick="javascript:tabela_ncm();" type="button"><i class="icofont-search-1"></i></button>
                            </span> 
                            </div>

                            
                            <small id="esconde_frase">*Apenas em caso fiscal</small>
                            <small id="ncm_erro" class="hide red"><b>NCM NÃO ENCONTRADO</b></small>  
                        </div>
                    </div>

                    <div class="col-md-6">
                    	<div class="form-group">
                        	<label for="exampleInputEmail1">CST</label>
                            <input type="number"  class="form-control" name="cst" value="<?php if($edit==1){ echo $ln['cst'];} ?>">  
                            <small>*Apenas em caso fiscal</small>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">CFOP</label>
                            <input type="number"  class="form-control" name="cfop" value="<?php if($edit==1){ echo $ln['cfop'];} ?>">  
                            <small>*Apenas em caso fiscal</small>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">CSOSN</label>
                            <input type="number"  class="form-control" name="csosn" value="<?php if($edit==1){ echo $ln['csosn'];} ?>">  
                            <small>*Apenas em caso fiscal</small>
                        </div>
                    </div>
	              	            

                                
	        </div>    







	        	<div class="form-layout-footer" >
	        		<hr>
		            <button type="submit" class="btn btn-primary bd-0">SALVAR</button> 
		            <button type="submit" onclick="javascript:salva_cadastro_insere();" class="btn btn-primary bd-0 pull-right">SALVAR E INSERIR MAIS</button>              
		        </div>


		    </div>

	</div>  	

	              				
</div>



	
<div class="col-md-4">

  <ul class="nav nav-activity-profile">
        <li class="nav-item"><a style="border-bottom: 0" href="javascript:void(0)" class="nav-link">OUTRAS INFORMAÇÕES</a></li>
    </ul>
<div class="section-wrapper">
      
    
      <div class="form-layout">
            <div class="row ">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Estoque</label>
                            <input type="number"  class="form-control" name="estoque" value="<?php if($edit==1){ echo $ln['estoque'];} ?>">                              
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Estoque Mínimo</label>
                            <input type="number"  class="form-control" name="estoque_minimo" value="<?php if($edit==1){ echo $ln['estoque_minimo'];} ?>">                              
                        </div>
                    </div>


               <div class="col-lg-12">
                  <div class="form-group">
                    <label class="form-control-label">Categoria:</label>
                    <select class="form-control select2 sel-gd upper" name="categoria" id="categoria" required="required" >
                      <?php
                        if($edit==1){
                          
                          $categoria = $ln['categoria'];
                          $sql = $db->select("SELECT * FROM categorias WHERE id='$categoria' LIMIT 1");
                          $row = $db->expand($sql);
                          echo '<option value="'.$row['id'].'" selected>'.$row['categoria'].'</option>';

                          $sql = $db->select("SELECT * FROM categorias WHERE id!='$categoria' ORDER BY categoria");
                          while($row = $db->expand($sql)){
                            echo '<option value="'.$row['id'].'">'.$row['categoria'].'</option>';
                          }
                          

                        } else {

                            echo '<option value="">-- escolha a categoria --</option>';
                            $sql = $db->select("SELECT * FROM categorias ORDER BY categoria");
                            while($row = $db->expand($sql)){
                              echo '<option value="'.$row['id'].'">'.$row['categoria'].'</option>';
                            }

                        }
                      ?>
                  </select> 
                  </div>
                </div>


                <div class="col-lg-12">
                  <div class="form-group">
                    <label class="form-control-label">Fornecedor:</label>
                    <select class="form-control select2 sel-gd upper" name="fornecedor" id="fornecedor" >
                      <?php
                        if($edit==1){
                          
                          $fornecedor = $ln['id_fornecedor'];
                          $sql = $db->select("SELECT id, fornecedor FROM fornecedores WHERE id='$fornecedor' LIMIT 1");
                          $row = $db->expand($sql);
                          echo '<option value="'.$row['id'].'" selected>'.$row['fornecedor'].'</option>';

                          $sql = $db->select("SELECT id, fornecedor FROM fornecedores WHERE id!='$fornecedor' ORDER BY fornecedor");
                          while($row = $db->expand($sql)){
                            echo '<option value="'.$row['id'].'">'.$row['fornecedor'].'</option>';
                          }
                          

                        } else {

                            echo '<option value="">-- escolha o fornecedor --</option>';
                            $sql = $db->select("SELECT id, fornecedor FROM fornecedores ORDER BY fornecedor");
                            while($row = $db->expand($sql)){
                              echo '<option value="'.$row['id'].'">'.$row['fornecedor'].'</option>';
                            }

                        }
                      ?>
                  </select> 
                  </div>
                </div>



                  <div class="col-md-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Fabricante</label>
                            <input type="text"  class="form-control" name="fabricante" value="<?php if($edit==1){ echo $ln['fabricante'];} ?>">                              
                        </div>
                    </div>


        


       </div>
    </div>

</div>
</div>




</div>
</form>



<?php require("../../includes/rodape.php"); ?>