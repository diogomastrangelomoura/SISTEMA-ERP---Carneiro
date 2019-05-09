

$(".muda_tabs").click(function(){
	var target = $(this).attr('data-id');			
	$(".tabs").css('display', 'none');
	$("#tab"+target).css('display', 'flex');
});

$(".valores").maskMoney({
        symbol:'', // Simbolo
        decimal:'.', // Separador do decimal
        precision:2, // Precisão
        thousands:'', // Separador para os milhares
        allowZero:true, // Permite que o digito 0 seja o primeiro caractere
        showSymbol:false, // Exibe/Oculta o símbolo
        selectAllOnFocus:true
    });

$(document).ready(function(){




	  id_global_item_selecao = 0;	


	  $(window).on('scroll', function () {
	    if($(this).scrollTop() > 100) {
	    	var largura = $('#elemento-pai').width();
	        $('#barra-lateral').css('width',largura);
	        $('#barra-lateral').addClass('fixa_lateral');
	    } else {
	        $('#barra-lateral').removeClass('fixa_lateral');
	    }
	  });

	//$('#tudo_conteudo').perfectScrollbar();


});


function exibe_erros_gerais(erro){
	$("#erros_escritos_gerais").html(erro);
	$("#ModalErrosGerais").modal();	
}

function fecha_aviso_topo_caixa(){
	$("#div_erro_caixa_dia").hide();
}

function bloqueia_campos(){
	$("#numero_cartao").prop("disabled",true);
	$("#nome").prop("disabled",true);
	$("#endereco").prop("disabled",true);
	$("#numero").prop("disabled",true);
	$("#bairro").prop("disabled",true);
	$("#complemento").prop("disabled",true);
	$("#cidade").prop("disabled",true);
	$("#ddd").prop("disabled",true);
	$("#celular").prop("disabled",true);	
	$("#numero_telefone").prop("disabled",true);
				
	$("#btn_pesq").prop("disabled",true);
	$("#btn_salvar").prop("disabled",true);
			
}


function desbloqueia_campos(){
	$("#numero_cartao").prop("disabled",false);
	$("#nome").prop("disabled",false);
	$("#endereco").prop("disabled",false);
	$("#numero").prop("disabled",false);
	$("#bairro").prop("disabled",false);
	$("#complemento").prop("disabled",false);
	$("#cidade").prop("disabled",false);
	$("#ddd").prop("disabled",false);
	$("#celular").prop("disabled",false);	
	$("#numero_telefone").prop("disabled",false);
				
	$("#btn_pesq").prop("disabled",false);
	$("#btn_salvar").prop("disabled",false);
	$("#btn_cancelar").prop("disabled",false);

	
}


function carregando(msg=''){

	$(".botoes_rodape").hide();
	if(msg!=''){
		$("#conteudo_geral").html('<div class="col-md-12 text-center"><CENTER><h90>'+msg+'</h90></CENTER></div>');			
	} else {
		$("#conteudo_geral").html('<div class="col-md-12 text-center"><CENTER><h90>CARREGANDO...</h90></CENTER></div>');			
	}
	
}


function SomenteNumero(e){
    var tecla=(window.event)?event.keyCode:e.which;   
    if((tecla>47 && tecla<58)) return true;
    else{
    	if (tecla==8 || tecla==0) return true;
	else  return false;
    }
}










