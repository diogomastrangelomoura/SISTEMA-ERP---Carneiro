<?php require("../../includes/topo.php"); ?>

<?php
$edit=0;
if(isset($id)){
	$sql = $db->select("SELECT * FROM fornecedores WHERE id='$id' LIMIT 1");	
	$ln = $db->expand($sql);
	$edit=1;
}
?>

<div class="slim-pageheader">
  <ol class="breadcrumb slim-breadcrumb">
    <li class="breadcrumb-item"><a href="home">HOME</a></li>
    <li class="breadcrumb-item active" aria-current="page">FORNECEDORES</li>
  </ol>
  <h6 class="slim-pagetitle upper">
  		<?php
  			if($edit==1){
  				echo $ln['fornecedor'];
  			} else {
  				echo 'NOVO FORNECEDOR';
  			}
  		?>
  </h6>
</div>


<form method="post" action="controlers/cadastros/salva_fornecedor.php">
<div class="section-wrapper">
  		
		<input class="form-control" type="hidden" name="id" value="<?php if($edit==1){ echo $id;} else {echo 0;} ?>">

  		<div class="form-layout">
            <div class="row mg-b-25">

              <div class="col-lg-3">
                <div class="form-group">
                  <label class="form-control-label">CPF/CNPJ: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="number" name="cpf_cnpj" required="required" value="<?php if($edit==1){ echo $ln['cpf_cnpj'];} ?>">
                </div>
              </div><!-- col-4 -->

              <div class="col-lg-9">
                <div class="form-group">
                  <label class="form-control-label">Nome Fantasia: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="nome" required="required" value="<?php if($edit==1){ echo $ln['fornecedor'];} ?>">
                </div>
              </div><!-- col-4 -->
             
             


              <div class="col-lg-7">
                <div class="form-group">
                  <label class="form-control-label">Nome do Contato:</label>
                  <input class="form-control" type="text" name="contato" value="<?php if($edit==1){ echo $ln['contato'];} ?>">
                </div>
              </div><!-- col-4 -->


              <div class="col-lg-5">
                <div class="form-group">
                  <label class="form-control-label">Telefone: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="numero_telefone" required="required" value="<?php if($edit==1){ echo $ln['telefone'];} ?>">
                </div>
              </div><!-- col-4 -->

              
              <div class="col-lg-10">
                <div class="form-group">
                  <label class="form-control-label">Endereço:</label>
                  <input class="form-control" type="text" name="endereco" value="<?php if($edit==1){ echo $ln['endereco'];} ?>">
                </div>
              </div><!-- col-4 -->

              <div class="col-lg-2">
                <div class="form-group">
                  <label class="form-control-label">Nº:</label>
                  <input class="form-control" type="text" name="numero" value="<?php if($edit==1){ echo $ln['numero'];} ?>">
                </div>
              </div><!-- col-4 -->

            
             <div class="col-lg-2">
                      <div class="form-group">
                        <label class="form-control-label">UF:</label>
                        <select class="form-control sel-gd upper" name="estado" onchange="javascript:filtra_cidades(this.value);">
                          <?php
                            if($ln['estado']!=0){
                              $estado = $ln['estado'];
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
                        <select class="form-control sel-gd upper" name="cidade" id="cidade">
                          <?php
                            if($ln['cidade']!=0){
                              $cidade = $ln['cidade'];
                              $estado = $ln['estado'];

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


            </div><!-- row -->

            <div class="form-layout-footer">
              <button type="submit" class="btn btn-primary bd-0">SALVAR</button> 
               <button type="submit" onclick="javascript:salva_cadastro_insere();" class="btn btn-primary bd-0 pull-right">SALVAR E INSERIR MAIS</button>             
            </div><!-- form-layout-footer -->
          </div><!-- form-layout -->
             
  
</div>
</form>

<?php require("../../includes/rodape.php"); ?>