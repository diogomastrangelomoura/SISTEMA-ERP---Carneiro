$(document).ready(function(){



	$('#ModalFinalizaCaixa').on('show.bs.modal', function (){
		sim_finaliza_caixa=1;		
	});
	
	$('#ModalFinalizaCaixa').on('hidden.bs.modal', function (){
	    sim_finaliza_caixa=0;
	});


	$('#ModalAbreCaixa').on('show.bs.modal', function (){
		sim_abre_caixa=1;
	});
	
	$('#ModalAbreCaixa').on('hidden.bs.modal', function (){
	    sim_abre_caixa=0;
	});


	$('#CancelaVendaSenha').on('show.bs.modal', function (){		
		setTimeout('$("#senha_cancelamento").focus();',400 );			  	
	});


	$("#FormSaidaCaixa").submit(function(){
				
		$("#botao_saida_caixa").html('AGUARDE...');
		var formdata = $("#FormSaidaCaixa").serialize();		
			
			$("#resultados_reload").html('<tr><td colspan="13" align="center"><span class="carregando">CARREGANDO...</span></td></tr>');			
			$.ajax({type: "POST", url:$("#FormSaidaCaixa").attr('action'), data:formdata, success: function(msg){										
				
				$("#resultados_reload").load('menu_caixa/listagem/listagem_retirada_caixa.php');
				$("#botao_saida_caixa").html('SALVAR RETIRADA');				
				$('#FormSaidaCaixa')[0].reset();
								
			} 
		
		});
		
		return false;
	});



	$("#FormCancelaVenda").submit(function(){
		$("#erro_senha_cancela").hide();		
		$("#botao_cancela_pedido").html('AGUARDE...');
		var id_venda = $("#exibe_cancelamento_venda").val();

		var formdata = $("#FormCancelaVenda").serialize();		

			$.ajax({type: "POST", url:$("#FormCancelaVenda").attr('action'), data:formdata, success: function(msg){										
				
				if(msg==1){

					$("#venda_apaga"+id_venda).hide();
					$("#CancelaVendaSenha").modal('hide');
					$("#botao_cancela_pedido").html('CANCELAR VENDA');

				} else {
					
					$("#erro_senha_cancela").show();	
					$("#botao_cancela_pedido").html('CANCELAR VENDA');
					
				}
								
			} 
		
		});
		
		return false;
	});



});		



function verifica_venda(id){
	//$("#detalhes_venda").html('<br><br><center><span class="carregando">CARREGANDO...</span></center>');	
	//$("#oculta").hide();
	//$("#detalhes_venda").show();
	//$("#detalhes_venda").load('menu_pedidos/telas/detalhes_venda.php?id='+id);	
	carregando();
	$("#conteudo_geral").load('menu_pedidos/telas/detalhes_venda.php?id='+id);	
}
	


function cancela_venda(id){
	$("#exibe_cancelamento_venda").val(id);
	$("#senha_cancelamento").val('');
	$("#erro_senha_cancela").hide();
	$("#CancelaVendaSenha").modal();
}


function exclui_saidas_caixa(id){	
	$("#apaga"+id).hide();
	$.post('menu_caixa/actions/apaga_saida_caixa.php', {id:id});
}



function confirma_abre_caixa(){
	
	valor_inicial = $("#troco").val();
	var data = new Date(),
    dia = data.getDate(),
    mes = data.getMonth() + 1,
    ano = data.getFullYear(),
    hora = data.getHours(),
    minutos = data.getMinutes();
    if(minutos<10){minutos = '0'+minutos;}
    if(dia<10){dia='0'+dia;}
  	$("#abre_caixa").html([dia, mes, ano].join('/')+ ' ás ' + [hora, minutos].join(':') + 'hs');
  	$("#confirma_troco").html('<br><b>Troco Inicial</b><br> R$ '+valor_inicial);
  	$("#ModalAbreCaixa").modal();	
}


function abre_caixa(){
	valor_inicial = $("#troco").val();

	$("#btn_abre_caixa").html('AGUARDE...');
	carregando();
	$.post('menu_caixa/actions/salva_abre_caixa.php', {valor_inicial:valor_inicial}, function(resposta){
	
		location.href='home';			
	});
}



function confirma_fecha_caixa(){	
	$("#horario_caixa").html('atualizando...');
	var data = new Date(),
    dia = data.getDate(),
    mes = data.getMonth() + 1,
    ano = data.getFullYear(),
    hora = data.getHours(),
    minutos = data.getMinutes();
    if(dia<10){dia='0'+dia;}
  	$("#horario_caixa").html([dia, mes, ano].join('/')+ ' ás ' + [hora, minutos].join(':'));
	$("#ModalFinalizaCaixa").modal();	
}



function finaliza_caixa(){	
	$("#btn_fecha_caixa").html('AGUARDE...');			
	
	$.post('menu_caixa/actions/finaliza_caixa.php', {id:1}, function(resposta){		
		$.post('menu_internet/actions/abre_fecha_loja.php',{tipo:0});
		$("#ModalFinalizaCaixa").modal('hide');
		$("#btn_fecha_caixa").html('CONFIRMAR');		
		imprime_fechamento_caixa(resposta);	
		inicia_sistema();
	});	
}
