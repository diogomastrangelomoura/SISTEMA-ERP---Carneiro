<?php
require("../../admin/class/class.db.php");
require("../../admin/class/class.seguranca.php");
require("../../includes/verifica_session.php");
?>


<div class="slim-pageheader">
  <ol class="breadcrumb slim-breadcrumb">
    <li class="breadcrumb-item"><a href="home">CAIXA</a></li>
    <li class="breadcrumb-item active" aria-current="page">SAÍDAS DE CAIXA</li>
  </ol>
  <h6 class="slim-pagetitle upper">RETIRADA DE CAIXA</h6>
</div>

<form id="FormSaidaCaixa" method="post" action="menu_caixa/actions/salva_saida_caixa.php">
<div class="section-wrapper">
      
    <input class="form-control" type="hidden" name="id" value="<?php if($edit==1){ echo $id;} else {echo 0;} ?>">

      <div class="form-layout">
            <div class="row mg-b-25">
              
              <div class="col-lg-3">
                <div class="form-group">
                  <label class="form-control-label">Valor: <span class="tx-danger">*</span></label>
                  <input class="form-control valores" type="text"  name="valor_saida" required="required" placeholder="R$ 0,00">
                </div>
              </div><!-- col-4 -->


              <div class="col-lg-9">
                <div class="form-group">
                  <label class="form-control-label">Motivo: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text"  name="motivo" required="required" placeholder="Motivo da Retirada">
                </div>
              </div><!-- col-4 -->
              


            </div>

            <div class="form-layout-footer" style="margin-top: -20px">
              <button type="submit" id="botao_saida_caixa" class="btn btn-primary bd-0">SALVAR RETIRADA</button>     
             
            </div>

          </div>
             
  
</div>
</form>


<div class="top15">
  <div class="table-responsive">
  <table class="table table-striped">
    
    <thead>
      <tr>
        <th width="200">Data/Hora</th>
        <th width="150">Valor</th>
        <th>Motivo</th>        
        <th>Operador</th>        
        <th width="10"></th>        

      </tr>
    </thead>

    <tbody  id="resultados_reload">
      <?php include_once("../listagem/listagem_retirada_caixa.php"); ?>
    </tbody>

  </table>
</div>
</div>  

<script>
  $(document).ready(function(){    
    $('body').css('overflow', 'auto');
      
  }); 
</script>
<script src="javascript/caixa.js"></script>
<script src="javascript/usadas.js"></script>
