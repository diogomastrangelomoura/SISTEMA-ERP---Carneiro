


$(document).ready(function(){

  sim_abre_caixa=0;
  sim_finaliza_caixa=0;
  esc_pula_fiscal=0;
  


  $("body").keydown(function(e) {
    
    var keyCode = e.keyCode || e.which;

      
      //TECLA ESC//
      if(keyCode == 27) {
        if(esc_pula_fiscal==1){
          finaliza_venda(0);
          esc_pula_fiscal=0;
        }

      }   

      //TECLA F2//
      if(keyCode == 113) {
        if($('#avanca-compra-enter').val()){             
         pagamento_compra();
        }

        if($('#finaliza-compra-enter').val()){             
         confirma_finaliza_venda();
        }
      }

      //TECLA F3//
      if(keyCode == 114) {
        if($('#volta-compra-enter').val()){   
          retornar_montagem_venda();
        }
      }

      //TECLA F4//
      if(keyCode == 115) {      
        if($('#finaliza-compra-enter').val()){             
         busca_clientes();
        }
      }

      //TECLA F6//
      if(keyCode == 117) {
      
      }

      //TECLA F8//
      if(keyCode == 119) {
       
      }

      //TECLA F10//
      if(keyCode == 121) {
       
      }

      //TECLA F12//
      if(keyCode == 123) {
        
      }


    //TECLA ENTER//
      if(keyCode == 13) {       
        
        //OK PARA ABRIR O CAIXA 
        if(sim_abre_caixa==1){
          abre_caixa();
          sim_abre_caixa=0;
        }

        //OK PARA FINALIZAR O CAIXA 
        if(sim_finaliza_caixa==1){
          finaliza_caixa();         
          sim_finaliza_caixa=0;
        }


        //OK PARA IMPRIMIR A VENDA
        if(typeof sim_imprime_venda != "undefined" && sim_imprime_venda==1){          
          imprime_comprovante_venda();         
          sim_imprime_venda=0;
        }

      }         
      

    
  });

}); 


      

$(document).ready(function(){

        $('.passa_enter').on("keypress", function(e) {
            if (e.keyCode == 13) {
                /* FOCUS ELEMENT */
                var inputs = $(this).parents("form").eq(0).find(":input.passa_enter");
                var idx = inputs.index(this);

                if (idx == inputs.length - 1) {
                    inputs[0].select()
                } else {
                    //id_campo = $(inputs[idx + 1]).attr("id");
                    //if(id_campo!='qtd_frente_caixa'){    
                        inputs[idx + 1].focus(); //  handles submit buttons
                        inputs[idx + 1].select();
                    //}
                }
                return false;
            }
        });


        


		
});        


      
        codigo_produto = 0;
        $(".passa_produtos").keydown(function(event) {

            var keyCode = event.keyCode || event.which;
            
            if(keyCode==13){                
                                
                if(codigo_produto!=0){                                        
                    seleciona_produto_venda_modal(codigo_produto)
                    return false;                    
                } else {
                    id_linha=1;
                    $(".passa_produtos").removeClass("passa_selecionado");                      
                }
            }

            else if(keyCode==40 || keyCode==38){

                var count = $('.table_passa_produtos tbody tr').length;   
                
                /////DESCE (SETA PRA CIMA)
                if(keyCode==40){    

                    if($('.passa_produtos').hasClass('passa_selecionado')){
                      
                      id_linha=id_linha+1;

                      if (id_linha > 6 && id_linha<=count) {

                        var rowpos = $("#linha"+id_linha).position();
                        $('#detalhes_produra_intens_caixa').scrollTop(rowpos.top+60);  
                                               
                      }

                      if(id_linha<=count){
                        $(".passa_produtos").removeClass("passa_selecionado");         
                        $("#linha"+id_linha).addClass("passa_selecionado"); 
                      } else {
                        id_linha=id_linha-1;
                      }
                       
                    } else {                        

                      $("#linha1").addClass("passa_selecionado"); 
                      id_linha=1; 
                       
                    }  

                    codigo_produto = $("#linha"+id_linha).attr("data-id");
                    
                ////DESCE (SETA PRA BAIXO)    
                } else if(keyCode==38) {

                    if($('.passa_produtos').hasClass('passa_selecionado')){

                      id_linha=id_linha-1;
                      
                      if (id_linha<=count && id_linha>0) {
                        var rowpos = $("#linha"+id_linha).position();
                        $('#detalhes_produra_intens_caixa').scrollTop(rowpos.top+60);  
                      }                       
                        


                      if(id_linha<=count && id_linha>0){
                        $(".passa_produtos").removeClass("passa_selecionado");                                 
                        $("#linha"+id_linha).addClass("passa_selecionado"); 
                      } else {
                         id_linha=1; 
                      }    
                                          
                    } 

                    codigo_produto = $("#linha"+id_linha).attr("data-id");                    

                
                }   


            } else {
                codigo_produto = 0;            
            } 
                    
        });






        codigo_cliente = 0;
        nome_cliente = '';
        $(".passa_clientes").keydown(function(event) {

            var keyCode = event.keyCode || event.which;
            
            if(keyCode==13){                
                                
                if(codigo_cliente!=0){                                        
                    seleciona_cliente_venda_modal(nome_cliente, codigo_cliente)
                    return false;                    
                } else {
                    id_linha=1;
                    $(".passa_clientes").removeClass("passa_selecionado");                      
                }
            }

            else if(keyCode==40 || keyCode==38){

                var count = $('.table_passa_produtos tbody tr').length;   
                
                /////DESCE (SETA PRA CIMA)
                if(keyCode==40){    

                    if($('.passa_clientes').hasClass('passa_selecionado')){
                      
                      id_linha=id_linha+1;

                      if (id_linha > 6 && id_linha<=count) {

                        var rowpos = $("#linha"+id_linha).position();
                        $('#detalhes_procura_clientes_caixa').scrollTop(rowpos.top+60);  
                                               
                      }

                      if(id_linha<=count){
                        $(".passa_clientes").removeClass("passa_selecionado");         
                        $("#linha"+id_linha).addClass("passa_selecionado"); 
                      } else {
                        id_linha=id_linha-1;
                      }
                       
                    } else {                        

                      $("#linha1").addClass("passa_selecionado"); 
                      id_linha=1; 
                       
                    }  

                    codigo_cliente = $("#linha"+id_linha).attr("data-id");
                    nome_cliente = $("#linha"+id_linha).attr("data-nome");
                    
                ////DESCE (SETA PRA BAIXO)    
                } else if(keyCode==38) {

                    if($('.passa_clientes').hasClass('passa_selecionado')){

                      id_linha=id_linha-1;
                      
                      if (id_linha<=count && id_linha>0) {
                        var rowpos = $("#linha"+id_linha).position();
                        $('#detalhes_procura_clientes_caixa').scrollTop(rowpos.top+60);  
                      }                       
                        


                      if(id_linha<=count && id_linha>0){
                        $(".passa_clientes").removeClass("passa_selecionado");                                 
                        $("#linha"+id_linha).addClass("passa_selecionado"); 
                      } else {
                         id_linha=1; 
                      }    
                                          
                    } 

                    codigo_cliente = $("#linha"+id_linha).attr("data-id");    
                    nome_cliente = $("#linha"+id_linha).attr("data-nome");                

                
                }   


            } else {
                codigo_cliente = 0;            
            } 
                    
        });