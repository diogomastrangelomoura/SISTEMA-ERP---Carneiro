<?php
require("../../admin/class/class.db.php");
require("../../admin/class/class.seguranca.php");
require("../../includes/verifica_session.php");
?>


<div class="slim-pageheader">
  <ol class="breadcrumb slim-breadcrumb"></ol>
  <h6 class="slim-pagetitle upper">CADASTRO DE CLIENTES</h6>
</div>

<div class="row">
<div class="col-md-12">
      
      <div class="form-group icones-campo">
        <i class="icofont-users"></i>     
        <input type="text" name="nome_cliente" id="nome_cliente" onkeyup="javascript:pesquisa_ficha_cliente();" class="form-control input-lg text-center upper" placeholder="INFORME O NOME DO CLIENTE E APERTE ENTER" autocomplete="off">
      </div>

</div>  
</div>

<div class="top15">
  <div class="table-responsive">
  <table class="table table-striped">
    
    <thead>
      <tr>
          <th width="100">ID</th>
          <th>CLIENTE</th>            
          <th>CPF/CNPJ</th>
          <th>TELEFONES</th>
          <th width="10"></th>            
    </tr>
    </thead>

    <tbody  id="resultados_reload">
      <?php include_once("../pesquisas/pesquisa_clientes_edicao.php"); ?>
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
