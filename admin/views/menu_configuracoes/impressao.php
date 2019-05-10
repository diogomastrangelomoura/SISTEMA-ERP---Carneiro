<?php require("../../includes/topo.php"); ?>

<?php
  $sql = $db->select("SELECT * FROM dados_loja LIMIT 1");  
  $ln = $db->expand($sql);

  $sql2 = $db->select("SELECT * FROM configuracoes");  
  $ln2 = $db->expand($sql2);
?>

<div class="slim-pageheader">
  <ol class="breadcrumb slim-breadcrumb">
    <li class="breadcrumb-item"><a href="home">HOME</a></li>
    <li class="breadcrumb-item active" aria-current="page">IMPRESSÃO</li>
  </ol>
  <h6 class="slim-pagetitle upper">
    CONFIGURAÇÕES DE IMPRESSÃO
  </h6>
</div>


<form method="post" action="impressao/save">
<div class="section-wrapper">
      
    

      <div class="form-layout">
            <div class="row mg-b-25">
              
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Cabeçalho Nota Linha 01: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="cabecalho_linha01" required="required" value="<?php echo $ln['cabecalho_linha01']; ?>">
                </div>
              </div><!-- col-4 -->

              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Cabeçalho Nota Linha 02: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="cabecalho_linha02" required="required" value="<?php echo $ln['cabecalho_linha02']; ?>">
                </div>
              </div><!-- col-4 -->

              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Cabeçalho Nota Linha 03: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="cabecalho_linha03" required="required"  value="<?php echo $ln['cabecalho_linha03']; ?>">
                </div>
              </div><!-- col-4 -->



        <div class="col-md-4">
           <div class="form-group">
                <label for="exampleInputEmail1">Nome Impressora Principal</label>
                <input type="text" class="form-control" name="impressora_principal"  value="<?php echo $ln2['impressora_principal']; ?>"/>
           </div>
        </div>

        


            </div><!-- row -->

            <div class="form-layout-footer">
              <button type="submit" class="btn btn-primary bd-0">SALVAR</button>              
            </div><!-- form-layout-footer -->
          </div><!-- form-layout -->
             
  
</div>
</form>

<?php require("../../includes/rodape.php"); ?>