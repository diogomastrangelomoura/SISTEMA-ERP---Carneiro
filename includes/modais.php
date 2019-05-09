<div id="ModalErrosGerais" class="modal fade" role="dialog" tabindex="-1">
  <div class="modal-dialog ">

    <!-- Modal content-->
    <div class="modal-content">
      
      <div class="modal-header">        
        <h4 class="modal-title">Ops!</h4>
        <button type="button" class="close" data-dismiss="modal" tabindex="-1">&times;</button>
      </div>
      
        <div class="modal-body  text-center" style="min-width: 400px; min-height: 130px; overflow-y: none; text-transform: uppercase; padding-top: 40px; padding-bottom: 40px">

            <h19 id="erros_escritos_gerais"></h19>
                     
        </div>
      
    </div>

  </div>
</div>



<div id="ModalCupomFiscal" class="modal fade" tabindex="-1" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-md">

    <!-- Modal content-->
    <div class="modal-content">
      
      <div class="modal-header">        
        <h4 class="modal-title">Cupom Fiscal</h4>
       
      </div>
      
        <div class="modal-body pd-20 text-center" style="text-transform: uppercase;">

            <h19 class="text-center" id="cupom_fiscal_avisos"></h19>

            <div class="form-group top10 text-left" id="hide_input_fiscal" >    
                <label>INFORMAR CPF:</label>           
                <input type="number" autocomplete="off" style="width: 330px; " name="cpf_cliente" id="cpf_cliente" class="form-control input-lg" placeholder="CPF CLIENTE">
                
                <button type="button" onclick="javascript:venda_fiscal();" class="btn btn-block btn-lg  btn-primary top10">CONTINUAR</button>

            </div> 

            <div class="form-group top10 hide" id="botao_erro_sat">                               
                <button type="button" onclick="javascript:libera_venda_fiscal();" class="btn btn-block  btn-danger top10">ENTENDI</button>
            </div> 

                     
        </div>
      
    </div>

  </div>
</div>



<div id="ModalRejeicaoPedidoInternet" class="modal fade" role="dialog" tabindex="-1">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      
      <div class="modal-header">        
        <h4 class="modal-title">Motivo da Rejeição</h4>
        <button type="button" class="close" data-dismiss="modal" tabindex="-1">&times;</button>
      </div>
        
        <form method="post" id="FormRejeitaPedidoInternet" action="menu_internet/actions/aceita-rejeita-pedido.php">      
        <div class="modal-body" id="motivo_rejeicao_pedido_internet_conteudo">
          
            <div class="form-group">
                <input type="hidden" name="status" value="3">
                <input type="hidden" name="id" id="id_pedido_rejeicao">
                <textarea name="motivo_erro_internet" id="motivo_erro_internet" class="form-control" style="height: 120px" placeholder="Informe o motivo da rejeição do pedido"></textarea>
            </div>  
          
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn  btn-danger" id="botao_rejeita_pedido_modal">REJEITAR</button>
      </div>  
      </form>
      
    </div>

  </div>
</div>


<div id="ModalProcuraItensCaixa" class="modal fade" role="dialog" tabindex="-1">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      
      <div class="modal-header">        
        <h4 class="modal-title">Busca de Produtos</h4>
        <button type="button" class="close" data-dismiss="modal" tabindex="-1">&times;</button>
      </div>
      
        <div class="modal-body" id="detalhes_produra_intens_caixa" style="min-width: 800px; min-height: 400px; max-height: 400px; overflow-y: auto;">
            
        </div>
      
    </div>

  </div>
</div>


<div id="ModalProcuraClientesCaixa" class="modal fade" role="dialog" tabindex="-1">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      
      <div class="modal-header">        
        <h4 class="modal-title">Busca de Clientes</h4>
        <button type="button" class="close" data-dismiss="modal" tabindex="-1">&times;</button>
      </div>
      
        <div class="modal-body" id="detalhes_procura_clientes_caixa" style="min-width: 800px; min-height: 400px; max-height: 400px; overflow-y: auto;">
            
        </div>
      
    </div>

  </div>
</div>





<!-- Modal -->
<div id="ModalPgtosRecebidos" class="modal fade" role="dialog" tabindex="-1">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      
      <div class="modal-header">
        <h4 class="modal-title">Pagamentos Recebidos</h4>
        <button type="button" class="close" data-dismiss="modal" tabindex="-1">&times;</button>
        
      </div>
      
      <div class="modal-body" id="exibe_pagamentos_recebidos">
      
  	  </div>
      
      
    </div>

  </div>
</div>







<div id="ModalFinalizaCaixa" class="modal fade" role="dialog" tabindex="-1">
  <div class="modal-dialog ">

    <!-- Modal content-->
    <div class="modal-content">
      
      <div class="modal-header">        
        <h4 class="modal-title">Finalizar Caixa</h4>
        <button type="button" class="close" data-dismiss="modal" tabindex="-1">&times;</button>
      </div>
      
      <div class="modal-body text-center" style="width: 400px">

          <br>
          <h16>Confirma a finalização do caixa?</h16><br>
          <h19 id="horario_caixa"></h19><br><br>
          <h12 class="thin">*Não é possível reabrir o caixa depois.</h12>
           <br><br>         
      </div>

      <div class="modal-footer">
          <button type="submit" id="btn_fecha_caixa" class="btn btn-lg btn-danger btn-block " onclick="finaliza_caixa();">CONFIRMAR</button>

      </div>  
      
      
    </div>

  </div>
</div>




<div id="ModalAbreCaixa" class="modal fade" role="dialog" tabindex="-1">
  <div class="modal-dialog modal-sm">

    <!-- Modal content-->
    <div class="modal-content">
      
      <div class="modal-header">
        <h4 class="modal-title">Iniciar Caixa</h4>
        <button type="button" class="close" data-dismiss="modal" tabindex="-1">&times;</button>
      </div>
      
      <div class="modal-body text-center">

          <br>
          <h16>Confirma abertura do caixa?</h16>
          <h19 id="abre_caixa"></h19><br>
          <h16 id="confirma_troco"></h16>
                    
      </div>

      <div class="modal-footer">
          <button type="submit" id="btn_abre_caixa" class="btn  btn-primary btn-block " onclick="abre_caixa();">CONFIRMAR</button>

      </div>  
      
      
    </div>

  </div>
</div>



<div id="ModalPerguntaImprime01" class="modal fade" role="dialog" tabindex="-1">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      
      <div class="modal-header">        
        <h4 class="modal-title"><center>Impressão</center></h4>
        <button type="button" class="close" data-dismiss="modal" tabindex="-1">&times;</button>
      </div>
      
        <div class="modal-body" style="min-width: 300px">
          <div class="row">

            <div class="col-md-12">               
                    <button onclick="javascript:imprime_comprovante_venda();" class="btn btn-lg btn-success btn-block  grandao">SIM</button>               
            </div> 

            <div class="col-md-12 top15">                
                    <button data-dismiss="modal" tabindex="-1" class="btn btn-danger btn-lg btn-block  grandao">NÃO</button>                
            </div> 

          </div>           
        </div>
      
    </div>

  </div>
</div>





<div id="ModalPerguntaImprime03" class="modal fade" role="dialog" tabindex="-1">
  <div class="modal-dialog modal-md">

    <!-- Modal content-->
    <div class="modal-content">
      
      <div class="modal-header">        
        <h4 class="modal-title"><center>Imprimir Recibo?</center></h4>
        <button type="button" class="close" data-dismiss="modal" tabindex="-1">&times;</button>
      </div>
      
        <div class="modal-body">
          <div class="row">

            <div class="col-md-12">               
                    <button onclick="javascript:imprime_comprovante_crediario();" class="btn btn-success btn-block  grandao">SIM</button>               
            </div> 

            <div class="col-md-12 top15">                
                    <button data-dismiss="modal" tabindex="-1" class="btn btn-danger btn-block  grandao">NÃO</button>                
            </div> 

          </div>           
        </div>
      
    </div>

  </div>
</div>




<div id="ModalPerguntaImprime04" class="modal fade" role="dialog" tabindex="-1">
  <div class="modal-dialog modal-md">

    <!-- Modal content-->
    <div class="modal-content">
      
      <div class="modal-header">        
        <h4 class="modal-title"><center>Imprimir Comprovante?</center></h4>
        <button type="button" class="close" data-dismiss="modal" tabindex="-1">&times;</button>
      </div>
      
        <div class="modal-body">
          <div class="row">

            <div class="col-md-12">               
                    <button onclick="javascript:imprime_ciencia_crediario();" class="btn btn-success btn-block  grandao">SIM</button>               
            </div> 

            <div class="col-md-12 top15">                
                    <button data-dismiss="modal" tabindex="-1" class="btn btn-danger btn-block  grandao">NÃO</button>                
            </div> 

          </div>           
        </div>
      
    </div>

  </div>
</div>



<div id="CancelaVendaSenha" class="modal fade scale" role="dialog" tabindex="-1">
  <div class="modal-dialog modal-dialog-vertical-top modal-sm" role="document">

    <!-- Modal content-->
    <div class="modal-content bd-0 tx-14">
      
      <div class="modal-header">
        <h4 class="modal-title">Cancelamento</h4>
        <button type="button" class="close" data-dismiss="modal" tabindex="-1" aria-label="Close">
              <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="modal-body">
        
        <form method="post" action="menu_pedidos/actions/cancela_venda.php" id="FormCancelaVenda">

            <div class="input-group top5">
                  <div class="input-group-append">
                  <span class="input-group-text" style="border-right:0">VENDA:</span>
                </div>
                  
                   <input type="text" name="id_venda_cancela" id="exibe_cancelamento_venda" readonly="readonly" class="form-control text-center input-lg" required="required">
                   <input type="hidden" name="verifica_senha" value="1">
                  
            </div>  

              <div class="form-group top15">
                
                  
                    <input type="password" class="form-control input-lg text-center"  placeholder="Senha de cancelamento" id="senha_cancelamento" name="senha_cancelamento" required="required">
                    <button type="submit" id="botao_cancela_pedido" class="btn btn-danger btn-block top10 btn-lg" >CANCELAR VENDA</button>
                  
              </div>  

            
              <div class="alert alert-danger text-center" style="margin-bottom: 0; display: none; margin-top: 10px" id="erro_senha_cancela">
                <i class="icofont-exclamation-tringle"></i> SENHA INCORRETA!
              </div>

        </form>      


      </div>
      
      
    </div>

  </div>
</div>

