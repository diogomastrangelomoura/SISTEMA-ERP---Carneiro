$(document).ready(function(){


});


	$("#FormAtualizaCadastroCliente").submit(function(){	
		
		$("#btn_atualiza_dados").html("ATUALIZANDO...");
		$("#aviso_cadastro").hide();	
		var formdata = $("#FormAtualizaCadastroCliente").serialize();		

		$.ajax({type: "POST", url:$("#FormAtualizaCadastroCliente").attr('action'), data:formdata, success: function(msg){										
			
			$("#aviso_cadastro").show();
			$("#btn_atualiza_dados").html("ATUALIZAR DADOS");		
			setTimeout(function(){ $("#aviso_cadastro").hide(); }, 3000);

		} 
			
		});
			
			return false;
	});



function recebe_crediario(){

	var devido = $("#devido").val();
	var pagamento = $("#pagamento").val();
	var forma = $("#forma").val();
	var cliente = $("#id").val();

	if(devido=='' || devido=='0' || devido=='0.00'){
		exibe_erros_gerais('Não existem débitos para o cliente.')
		return;
	}

	if(pagamento=='' || pagamento=='0.00' || pagamento=='0'){
		exibe_erros_gerais('Informe o valor para recebimento.')
		return;
	}

	if(forma==''){
		exibe_erros_gerais('Escolha a forma de pagamento.')
		return;
	}

	

	$("#botao_recebe_crediario").html('AGUARDE...');
	$("#tab20").html('<center>ATUALIZANDO...</center>');
	$("#tab21").html('<center>ATUALIZANDO...</center>');
	$.post('menu_clientes/actions/salva_recebimento_crediario.php', {cliente:cliente, forma:forma, pagamento:pagamento, devido:devido}, function(resposta){			

		$("#atualiza_devido").html(resposta)	
		$("#devido").val(resposta)	
		$("#troco").html('0.00')	
		$("#pagamento").val('')	
		$("#tab20").load('menu_clientes/listagem/listagem_crediario_cliente.php?id='+cliente);
		$("#tab21").load('menu_clientes/listagem/listagem_pagamentos_cliente.php?id='+cliente);
		$("#botao_recebe_crediario").html('RECEBER');	
		$("#pagamento").focus();
		imprime_comprovante_venda();

	});

}


function faz_troco_pgto_compra_cliente(valor){

	var devido = parseFloat($("#devido").val());
	var troco = (parseFloat(valor)-devido);
	if(troco<0){troco=0;}

	$("#troco").html(troco.toFixed(2));

}

function filtra_cidades(estado){
	$("#cidade").html('<option value="">CARREGANDO</option>');
	$.post('menu_clientes/pesquisas/pesquisa_cidades.php', {estado:estado}, function(resposta){			
		$("#cidade").html(resposta);
	});				
}

function pesquisa_ficha_cliente(){
	var tecla = event.keyCode;

	if(tecla==13){
		var nome_cliente = $("#nome_cliente").val();
		$("#resultados_reload").html('<tr><td colspan="13" align="center"><span class="carregando">PESQUISANDO...</span></td></tr>');
   		$.post('menu_clientes/pesquisas/pesquisa_clientes_edicao.php', {nome_cliente:nome_cliente}, function(resposta){			
			$("#resultados_reload").html(resposta);	
		});			
	}

}

function ficha_cliente(id){
	carregando();
	$("#conteudo_geral").load('menu_clientes/telas/novo_cliente.php?id='+id);		
}