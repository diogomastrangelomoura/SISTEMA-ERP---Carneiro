<?php
require("../../admin/class/class.db.php");
require("../../admin/class/class.seguranca.php");
require("../../includes/verifica_session.php");
?>


<div class="col-md-6 offset-md-3">

  <div class="card-header tx-small bd-0 tx-white bg-primary">
                  ABERTURA DE CAIXA
                </div>


<div class="card">

    
    <div class="col-lg-12" style="margin-top:10px">            
      
      <div class="input-group">
           	
  		  <input style="text-transform:uppercase; font-size: 40px" type="text" class="form-control text-center valores" id="troco" placeholder="0.00" >
  	  </div>
      
    </div>


<div class="col-lg-12">
<div class="row row-xs">  
        
    
    <div class="col-lg-6" style=" margin-top:10px">            
      
      <div class="input-group">
    	<div class="input-group-append">
          <span class="input-group-text" style="border-right:0"><i class="icofont-calendar"></i></span>
        </div>      
  		<input style="text-transform:uppercase" type="text" class="form-control input-lg" readonly value="<?php echo date("d/m/Y"); ?>" >
  	  </div>
      
    </div>
    
    <div class="col-lg-6" style=" margin-top:10px">            
      
      <div class="input-group">
    	<div class="input-group-append">
          <span class="input-group-text" style="border-right:0"><i class="icofont-clock-time"></i></span>
        </div>      
  		<input style="text-transform:uppercase" type="text" class="form-control input-lg" readonly value="<?php echo date("H:i:s"); ?>" >
  	  </div>
      
    </div>

</div>    
</div>
    
    <div class="col-lg-12" style="margin-top:10px; padding-bottom:0px; ">
      
      
      
      <div class="input-group">
    	<div class="input-group-append">
          <span class="input-group-text" style="border-right:0"><i class="icofont-user-suited"></i></span>
        </div>      
  		<input style="text-transform:uppercase" type="text" class="form-control input-lg" value="<?php echo $dados_usuario_nome; ?>" readonly>
  	  </div>
      


      <button type="button" class="btn top10 btn-primary bottom20 btn-block btn-lg" id="btn_salvar" onClick="javascript:confirma_abre_caixa();" >ABRIR CAIXA</button>
    </div>

  
  
</div>    




<script type="text/javascript">     

  $("input").keypress(function(event) {
      if (event.which == 13) {
          event.preventDefault();
          confirma_abre_caixa();  
      }
  });

</script>



<script src="javascript/usadas.js"></script>



