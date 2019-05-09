
$('#ModalProcuraItensCaixa').on('show.bs.modal', function (){
	setTimeout('$("#campo_busca_produto_modal").focus();',400 );			  	
});

$('#ModalProcuraItensCaixa').on('hidden.bs.modal', function (){
	if($("#produto_frente_caixa").val()==''){
		$("#produto_frente_caixa").focus();	  		
	}
	
});

$('#ModalProcuraClientesCaixa').on('show.bs.modal', function (){
	setTimeout('$("#campo_busca_produto_modal").focus();',400 );			  	
});







function finaliza_venda(fiscal=0){

	if(fiscal==0){
		$("#ModalCupomFiscal").modal('hide');
	}

	var formdata = $("#FormFinalizaVenda").serialize();		
	var url = $("#FormFinalizaVenda").attr('action')
	carregando('FINALIZANDO, AGUARDE...');
	
	$.ajax({type: "POST", url:url, data:formdata, success: function(msg){										

		
		if(fiscal==0){
			sim_imprime_venda=1;
			$("#ModalPerguntaImprime01").modal();			
			inicia_sistema();
		}

	} 		
	});
}







function confirma_finaliza_venda(){

	var restante_receber = $("#restante_receber").val();
	var tipo_venda = $("#tipo_venda").val();
	var valor_crediario = $("#pgto_crediario_final").val();
	var id_cliente_compra = $("#id_cliente_compra").val();
 	
	if(tipo_venda==1){
		if(restante_receber!=0){
			exibe_erros_gerais('O valor recebido é inferior <br>ao total da compra!')
			return;
		}
	}

	if(valor_crediario!='' && valor_crediario!='0.00'){
		if(id_cliente_compra==0 || id_cliente_compra==''){
			exibe_erros_gerais('Informe o cliente para marcar <br>o saldo em sua conta!')
			return;	
		}
	}

	if(tipo_venda==1){
		esc_pula_fiscal=1;
		$("#ModalCupomFiscal").modal();
	} else {
		esc_pula_fiscal=0;
		finaliza_venda(0);
	}

}





function transforma_orcamento_venda(id){
	carregando();
	$.post('menu_pedidos/actions/transforma_orcamento_venda.php', {id:id}, function(msg){
		
		inicia_sistema();
	});
}


function exibe_orcamento(id){
	window.open("menu_pedidos/telas/exibe_orcamento.php?id="+id, "_blank", "toolbar=no,scrollbars=yes,resizable=no,top=30,left=500,width=650,height=600");		
}

function exclui_orcamento(id){	
	if(confirm("Excluir orçamento?")){
		$("#apaga"+id).hide();
		$.post('menu_pedidos/actions/apaga_orcamento.php', {id:id});
	}
}






function faz_troco_pgto(){
	
	var total_compra = ($("#valor_final_compra").val());
	var dinheiro = ($("#pgto_dinheiro_final").val());
	var cartao = ($("#pgto_cartao_final").val());
	var crediario = ($("#pgto_crediario_final").val());
	var cheque = ($("#pgto_cheque_final").val());

	if(dinheiro==''){dinheiro=0;}
	if(cartao==''){cartao=0;}
	if(crediario==''){crediario=0;}
	if(cheque==''){cheque=0;}

	var recebido_final = (parseFloat(dinheiro)+parseFloat(cartao)+parseFloat(crediario)+parseFloat(cheque));
	var troco_final = (parseFloat(recebido_final)-parseFloat(total_compra));
	var restante_final = (parseFloat(total_compra) - parseFloat(recebido_final));

	if(troco_final<0){troco_final=0;}
	if(restante_final<0){restante_final=0;}

	$("#recebido_exibe").html(recebido_final.toFixed(2));
	$("#troco_exibe").html(troco_final.toFixed(2));
	$("#restante_exibe").html(restante_final.toFixed(2));

	$("#restante_receber").val(restante_final);
	$("#valor_final_troco").val(troco_final);

}

function pagamento_compra(){
	var id_vendedor = $("#id_vendedor").val()
	var total_compra = $("#soma_total_pedido").val()
	var desconto_compra = $("#desconto_compra").val()
		
	if(total_compra==0){
		exibe_erros_gerais('O valor de compra é de R$ 0,00')
		return;
	}	

	carregando();

	$.post('menu_pedidos/telas/recebimento.php', {id_vendedor:id_vendedor, total_compra:total_compra, desconto_compra:desconto_compra}, function(resposta){		
				
   		$("#conteudo_geral").html(resposta);				

	});
	
}

function retornar_montagem_venda(){
	carregando();
	$("#conteudo_geral").load('menu_pedidos/telas/novo_pedido.php');
}


function marca_orcamento(a){
	if(a==1){
		$(".valores").val('');
		$(".valores, .tipo_cartao").prop('disabled', false);

	} else if(a==2){
		$(".valores").val('');
		$(".valores, .tipo_cartao").prop('disabled', true);
	}
	faz_troco_pgto()
}



$("#BuscaProdutosModal").submit(function(){	

	$("#resultado_pesquisa").html('<tr><td colspan="3" align="center"><br><span class="carregando">PESQUISANDO...</span></td></tr>');
	var formdata = $("#BuscaProdutosModal").serialize();		

	$.ajax({type: "POST", url:$("#BuscaProdutosModal").attr('action'), data:formdata, success: function(msg){										
		
		$("#resultado_pesquisa").html(msg);

	} 
		
	});
		
		return false;
});


function desconto_compra_final(){
	var final_valor = (parseFloat($("#soma_total_pedido").val())-parseFloat($("#desconto_compra").val()));
	$("#total_final").html('TOTAL R$ ' + parseFloat(final_valor).toFixed(2));
}



function efetiva_produto_venda(){
	
	var tecla = event.keyCode || event.which;
	var id_produto_frente_caixa = $("#id_produto_frente_caixa").val();

	if(tecla==13 && id_produto_frente_caixa!=''){

		$("#desconto_compra").val('');

		$("#resumo-pedido-comanda").html('<br><br><center><span class="carregando">CARREGANDO...</span></center>');
		var formdata = $("#FormProdutoAdicionaVenda").serialize();

		$.ajax({type: "POST", url:$("#FormProdutoAdicionaVenda").attr('action'), data:formdata, success: function(msg){										
			
			$("#resumo-pedido-comanda").load('menu_pedidos/listagem/listagem_itens_compra.php', function(){
				
				$("#qtd_final_itens_venda").val('QTD ÍTENS: ' + $("#soma_qtd_itens").val());
				$("#total_final").html('TOTAL R$ ' + parseFloat($("#soma_total_pedido").val()).toFixed(2));
				$("#id_produto_frente_caixa").val('');

			});			
			$('#FormProdutoAdicionaVenda')[0].reset();
			setTimeout('$("#produto_frente_caixa").focus();',100 );			  			
			
		} 
		});
		
	
		
	}
	
}


function exlcui_produto_compra(id){
	$("#desconto_compra").val('');
	$("#resumo-pedido-comanda").html('<br><br><center><span class="carregando">CARREGANDO...</span></center>');	
	$.post('menu_pedidos/actions/exclui_produto_venda.php', {id:id}, function(resposta){		
				
   		$("#resumo-pedido-comanda").load('menu_pedidos/listagem/listagem_itens_compra.php', function(){
				
				$("#qtd_final_itens_venda").val('QTD ÍTENS: ' + $("#soma_qtd_itens").val());
				$("#total_final").html('TOTAL R$ ' + parseFloat($("#soma_total_pedido").val()).toFixed(2));

		});	

	});

	
}




function cancela_busca_clientes(){
	$("#nome_cliente").val('');
	$("#id_cliente_compra").val('');
}

function seleciona_cliente_venda_modal(nome, codigo){
	$("#nome_cliente").val(nome);
	$("#id_cliente_compra").val(codigo);
	$("#ModalProcuraClientesCaixa").modal('hide');
}

function seleciona_produto_venda_modal(codigo){
	$("#produto_frente_caixa").val(codigo);
	verifica_pesquisa(1);
	focus_campo=0;
	$("#ModalProcuraItensCaixa").modal('hide');
}

function exibe_aviso_ok(apaga=0){
	if(apaga==0){
		if($("#nome_produto_frente_caixa").val()!=''){
			$("#aviso_efetivar").show();	
		}		
	} else {
		$("#aviso_efetivar").hide();
	}

}


function soma_preco_quantidade(valor){

	var preco_produto_frente_caixa = ($("#preco_produto_frente_caixa").val());	
	if(preco_produto_frente_caixa!=0 && preco_produto_frente_caixa!=''){		
		$("#preco_final_frente_caixa").val('TOTAL R$ '+(parseFloat(preco_produto_frente_caixa) * parseFloat(valor)).toFixed(2));
	}


}
	

function verifica_pesquisa(ok=0){
	
	var tecla = event.keyCode;

	if(tecla==13 || ok==1){


		$("#aviso_efetivar").hide();
		$("#qtd_frente_caixa").val('01');		
		$("#preco_produto_frente_caixa").val('0.00');		
		$("#nome_produto_frente_caixa").val('');
		$("#id_produto_frente_caixa").val('');
		$("#preco_final_frente_caixa").val('R$ TOTAL');
		
		var produto_frente_caixa = $("#produto_frente_caixa").val();

		if($.isNumeric($('#produto_frente_caixa').val())) {
   			
   			$.post('menu_pedidos/actions/pesquisa_produto_caixa.php', {produto_frente_caixa:produto_frente_caixa}, function(resposta){		
				
   				if(resposta==0){
   					$("#detalhes_produra_intens_caixa").html('<br><br><center><span class="carregando">CARREGANDO...</span></center>');
   					$("#detalhes_produra_intens_caixa").load('menu_pedidos/listagem/listagem_produtos_pesquisa.php');			
   					$("#ModalProcuraItensCaixa").modal();
   				} else {
   					
   					$("#qtd_frente_caixa").focus().select();
   					var val = resposta.split('&@&');
   					$("#preco_produto_frente_caixa").val(val[1]);		
   					$("#nome_produto_frente_caixa").val(val[0]);
   					$("#id_produto_frente_caixa").val(val[2]);


   					$("#preco_final_frente_caixa").val('TOTAL R$ '+(parseFloat($("#qtd_frente_caixa").val()) * parseFloat(val[1])).toFixed(2));



   				}
				
				
			});

		} else {
			$("#detalhes_produra_intens_caixa").html('<br><br><center><span class="carregando">CARREGANDO...</span></center>');
			$("#detalhes_produra_intens_caixa").load('menu_pedidos/listagem/listagem_produtos_pesquisa.php', function(){
				if(produto_frente_caixa!=''){
					$("#campo_busca_produto_modal").val(produto_frente_caixa);
					$("#BuscaProdutosModal").submit();
				}
			});			
			$("#ModalProcuraItensCaixa").modal();
		}	 
	}
	

}



function busca_clientes(){
	$("#detalhes_produra_intens_caixa").html('');
	$("#ModalProcuraClientesCaixa").modal();
	$("#detalhes_procura_clientes_caixa").html('<br><br><center><span class="carregando">CARREGANDO...</span></center>');
	$("#detalhes_procura_clientes_caixa").load('menu_clientes/listagem/listagem_clientes.php');	
}

			
