
function aviso_impressao(aviso){
	if(aviso==1){
		$("#esconde_imprime").hide();
		$("#aparece_imprime").show();
	} else {
		$("#aparece_imprime").hide();
		$("#esconde_imprime").show();		
	}
}


function cancela_impressao_comprovante_venda(){
	$("#ModalPerguntaImprime01").modal('hide');		
	nao_imprime_venda=0;	
	$.post('menu_pedidos/impressao/cancela_impressao.php',{id:1}, function(resposta){	

	});
}


function cancela_impressao_comprovante_venda(){
	$("#ModalPerguntaImprime01").modal('hide');

	$.post('menu_pedidos/impressao/verifica_arquivo_impressao.php',{cancela:1}, function(resposta){});

}

function imprime_comprovante_venda(){	
	
	$("#ModalPerguntaImprime01").modal('hide');

	$.post('menu_pedidos/impressao/verifica_arquivo_impressao.php',{id:1}, function(resposta){

		if(resposta!=0){
			aviso_impressao(1)
			$.post('menu_pedidos/impressao/imprime.php',{tipo:1, arquivo:resposta}, function(resposta2){	

				setTimeout(function(){ imprime_comprovante_venda();}, 2000);

			});			
		} else {
			aviso_impressao(0)
		}								

	});

}


function reimprime_venda(id){
	$.post('menu_pedidos/impressao/prepara_impressao_venda.php',{id_venda:id}, function(resposta){

		imprime_comprovante_venda();

	});		
}

function reimprime_comp_pgto_crediario(id){
	$.post('menu_clientes/impressao/prepara_impressao_pgto_crediario.php',{id:id}, function(resposta){

		imprime_comprovante_venda();

	});		
}


function imprime_fechamento_caixa(id){	
	$.post('menu_caixa/impressao/prepara_fechamento_caixa.php',{id_caixa:id}, function(resposta){		
		imprime_comprovante_venda();
	});	
}