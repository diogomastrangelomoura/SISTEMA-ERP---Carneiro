 //$(function(){
  //      'use strict';

        // Initialize tooltip
       // $('[data-toggle="tooltip"]').tooltip();

     //   $('[data-toggle="tooltip-danger"]').tooltip({
   //       template: '<div class="tooltip tooltip-danger" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>'
     //   });    

//});



function inicia_sistema(){

	carregando();
	//$("#conteudo_geral").load('menu_pedidos/telas/recebimento.php');
	$.post('menu_caixa/actions/verifica_sistema.php', {id:1}, function(resposta) {		

		//TUDO OK PARA INICIAR VENDAS
		if(resposta==1){

			$("#conteudo_geral").load('menu_pedidos/telas/novo_pedido.php', function(){
				$("#produto_frente_caixa").focus();				
			});	
			//$("#conteudo_geral").load('menu_clientes/telas/novo_cliente.php?id=1');	
			
		//NAO TEM CAIXA ABERTO
		} else {

			$("#conteudo_geral").load('menu_caixa/telas/abre_caixa.php', function(){
				$("#troco").focus();				
			});			
			
				
		}		


	});	
	
}


function menu_orcamentos(){
	carregando();
	$("#conteudo_geral").load('menu_pedidos/telas/orcamentos.php');		
}

function menu_caixa_consolidado(){
	carregando();
	$("#conteudo_geral").load('menu_caixa/telas/consolidado.php');		
}

function menu_vendas_realizadas(){
	carregando();
	$("#conteudo_geral").load('menu_caixa/telas/vendas.php');		
}

function menu_cadastro_clientes(){
	carregando();
	$("#conteudo_geral").load('menu_clientes/telas/clientes.php');		
}

function manutencao_caixa(){	
	carregando();
	$("#conteudo_geral").load('menu_caixa/telas/manutencao_caixa.php');		
}

function menu_saidas_caixa(){
	carregando();
	$("#conteudo_geral").load('menu_caixa/telas/saidas-caixa.php');		
}


