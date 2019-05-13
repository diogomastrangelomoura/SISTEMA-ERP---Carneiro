// JavaScript Document

function carrega_produtos(id){
	$("#produto").html('<option value="">CARREGANDO</option>');
	$.post('ajax/pega_produtos.php', {categoria:id}, function(resposta){			
		$("#produto").html(resposta);
	});				
}

function filtra_cidades(estado){
	$("#cidade").html('<option value="">CARREGANDO</option>');
	$.post('../menu_clientes/pesquisas/pesquisa_cidades.php', {estado:estado}, function(resposta){			
		$("#cidade").html(resposta);
	});				
}


function gera_codebar(){
	$("#codigo").val('AGUARDE');
	$.post("ajax/gera_codigo_aleatorio.php",{id:1},function(resposta){
		$("#codigo").val(resposta)
	});	
}

function gera_margem_produto(){	
	var margem = $("#margem_lucro").val();
	var compra = $("#preco_compra").val();
	
	if(margem==''){
		exibe_erros_gerais("Informe a margem para calculo");
		return;
	}

	if(compra==''){
		exibe_erros_gerais("Informe o preço de compra para calculo");
		return;
	}

	var venda = (((parseFloat(compra)*parseFloat(margem))/100)+parseFloat(compra));
	$("#preco_venda").val(venda.toFixed(2));	

}


function exibe_erros_gerais(erro){
	$("#erros_escritos_gerais").html(erro);
	$("#ModalErrosGeraisAdmin").modal();	
}


function valida_ncm(ncm){
	$("#ncm_erro").hide();
	$("#esconde_frase").show();
	$.post("ajax/valida_ncm.php",{ncm:ncm},function(resposta){
		if(resposta==0){
			$("#esconde_frase").hide();
			$("#ncm_erro").show();
		}
	});
}


$(".muda_tabs").click(function(){
	var target = $(this).attr('data-id');			
	$(".tabs").css('display', 'none');
	$("#tab"+target).css('display', 'flex');
});


 $('.select2-show-search').select2({
          minimumResultsForSearch: ''
        });

$("#PesquisaXML").submit(function(){
		
		$("#resultado_pesquisa").html("<center>PESQUISANDO, AGUARDE...</center>");
		$("#resultado_pesquisa").show();
		$("#btn_pesquisa").html('PESQUISANDO...');
		var formdata = $("#PesquisaXML").serialize();		
		
		$.ajax({type: "POST", url:$("#PesquisaXML").attr('action'), data:formdata, success: function(retorno){										
				
				$("#resultado_pesquisa").html(retorno);
				$("#btn_pesquisa").html("<center>PESQUISAR</center>");
								
			} 
		
		});
		
		return false;
});


$("#EnviaXML").submit(function(){
		
		$("#sucesso_xml").hide();
		$("#erro_xml").hide();	

		$(".form-control")		
		$("#btn_envio").html('AGUARDE, ENVIANDO...');
		var formdata = $("#EnviaXML").serialize();		
		
		$.ajax({type: "POST", url:$("#EnviaXML").attr('action'), data:formdata, success: function(retorno){										

				if(retorno==1){
					$("#sucesso_xml").show();
				} else {
					
					if(retorno==''){
						$("#erro_xml").html('ERRO AO ANEXAR ARQUIVO E ENVIAR E-MAIL');
					} else {
						$("#erro_xml").html(retorno);
					}
					
					$("#erro_xml").show();

				}

				$("#btn_envio").html('COMPACTAR E ENVIAR');
								
			} 
		
		});
		
		return false;
});




function marcar_todas_opcoes(tipo){

	var categoria_selecionar = $("#categoria_selecionar").val();

	$(".prdx"+categoria_selecionar).each(function () {
		if(tipo==1){
			$(this).prop("checked", true);	
		} else {
			$(this).prop("checked", false);	
		}
        
    });

}

function salva_cadastro_insere(){	
	$('<input>').attr({
	    type: 'hidden',
	    value: '1',
	    name: 'retorno'
	}).appendTo('form');

}

$(document).ready(function(){


		
		$(".cat").change(function(){
			var p = this.value;
			$("#produtos").html('<option value="">pesquisando...</option>');
			$.post("ajax/pega_produtos.php",{categoria:p},function(resposta){

				$("#produtos").html(resposta);
			});
		
		});			

		$(".chk").click(function(){
			var target = $(this).attr('data-id');
			
			if($(this).is(':checked')) {
				$("#ord"+target).prop('disabled', false); 
				$("#ord"+target).prop('required',true);  
			} else  {
				$("#ord"+target).prop('disabled', true);   
				$("#ord"+target).prop('required',false);  
				$("#ord"+target).val('');  
			}

		});





	$("#FormLoginRetaguarda").submit(function(){
		$(".alerta-index").hide();		
		$("#botao_login").html('VALIDANDO USUÁRIO...');
		var formdata = $("#FormLoginRetaguarda").serialize();		

			$.ajax({type: "POST", url:$("#FormLoginRetaguarda").attr('action'), data:formdata, success: function(msg){										
							
				if(msg==1){

						location.href = 'home';

				} else {
					
					$(".msg_erro").show();	
					$("#botao_login").html('ACESSAR');
					
				}
								
			} 
		
		});
		
		return false;
	});


});


$(".valores").maskMoney({
	    symbol:'', // Simbolo
	    decimal:'.', // Separador do decimal
	    precision:2, // Precisão
	    thousands:'', // Separador para os milhares
	    allowZero:true, // Permite que o digito 0 seja o primeiro caractere
	    showSymbol:false // Exibe/Oculta o símbolo
    });



function lista_opcoes(tipo){
	
	//CATEGORIAS//
	if(tipo==1){
		$("#list_produtos").hide();	
		$("#list_categorias").show();	
	}

	//PRODUTOS//
	if(tipo==2){				
		$("#list_categorias").hide();	
		$("#list_produtos").show();
	}

}





