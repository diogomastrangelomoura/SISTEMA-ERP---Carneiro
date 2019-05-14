<?php 
require("../../admin/class/class.db.php");
require("../../admin/class/class.seguranca.php");
require("../../includes/verifica_session.php");
require("../../includes/verifica_caixa_aberto.php");


$valor_total_venda = ($valor_final_compra+$valor_final_desconto);
$hoje = date("Y-m-d");
$hora = date("H:i:s");


$sql = $db->select("INSERT INTO vendas (id_usuario, id_cliente, id_caixa, valor_total, valor_desconto, valor_final_venda, data, hora, id_vendedor, tipo, valor_troco) VALUES ('$id_usuario', '$id_cliente_compra', '$id_caixa_aberto', '$valor_total_venda', '$valor_final_desconto', '$valor_final_compra', '$hoje', '$hora', '$id_vendedor', '$tipo_venda', '$valor_final_troco')");

$id_final = $db->last_id($sql);



//VENDA//
if($tipo_venda==1){
	

	//PAGAMENTOS DA VENDA DINHEIRO///
	if($pgto_dinheiro_final!='' && $pgto_dinheiro_final!='0.00'){

		if($valor_final_troco!='' && $valor_final_troco!='0.00' && $valor_final_troco!='0'){
			$pgto_dinheiro_final = ($pgto_dinheiro_final-$valor_final_troco);
		}

		$grava = $db->select("INSERT INTO pagamentos_vendas (troco_passado, id_venda, forma_pagamento, valor_pagamento, id_usuario, data, hora, id_caixa) VALUES ('$valor_final_troco', '$id_final', '1', '$pgto_dinheiro_final', '$id_usuario', '$hoje', '$hora', '$id_caixa_aberto')");	
	}


	//PAGAMENTOS DA VENDA CARTAO///
	if($pgto_cartao_final!='' && $pgto_cartao_final!='0.00'){

		if($valor_final_troco!='' && $valor_final_troco!='0.00' && $valor_final_troco!='0'){
			if($pgto_dinheiro_final=='0.00' && $pgto_cheque_final=='0.00' && $pgto_crediario_final=='0.00'){
				$pgto_cartao_final = ($pgto_cartao_final-$valor_final_troco);
			} else {
				$valor_final_troco=0;		
			}			
		}

		$grava = $db->select("INSERT INTO pagamentos_vendas (troco_passado, id_venda, forma_pagamento, valor_pagamento, id_usuario, data, hora, id_caixa, forma_cartao) VALUES ('$valor_final_troco', '$id_final', '2', '$pgto_cartao_final', '$id_usuario', '$hoje', '$hora', '$id_caixa_aberto', '$tipo_pgto_cartao')");	
	}
	

	//PAGAMENTOS DA VENDA CHEQUE///
	if($pgto_cheque_final!='' && $pgto_cheque_final!='0.00'){

		

		if($valor_final_troco!='' && $valor_final_troco!='0.00' && $valor_final_troco!='0'){
			if($pgto_dinheiro_final=='0.00' && $pgto_cartao_final=='0.00' && $pgto_crediario_final=='0.00'){
				$pgto_cheque_final = ($pgto_cheque_final-$valor_final_troco);
			} else {
				$valor_final_troco=0;		
			}			
		}

		$grava = $db->select("INSERT INTO pagamentos_vendas (troco_passado, id_venda, forma_pagamento, valor_pagamento, id_usuario, data, hora, id_caixa) VALUES ('$valor_final_troco', '$id_final', '4', '$pgto_cheque_final', '$id_usuario', '$hoje', '$hora', '$id_caixa_aberto')");	
	}


	//PAGAMENTOS DA VENDA CONTA DO CLIENTE///
	if($pgto_crediario_final!='' && $pgto_crediario_final!='0.00'){


		$grava = $db->select("INSERT INTO pagamentos_vendas (id_venda, forma_pagamento, valor_pagamento, id_usuario, data, hora, id_caixa) VALUES ('$id_final', '3', '$pgto_crediario_final', '$id_usuario', '$hoje', '$hora', '$id_caixa_aberto')");

		$grava =  $db->select("INSERT INTO contas_clientes (id_cliente, id_venda, valor, tipo, data_debito, id_caixa_recebe, id_usuario) VALUES ('$id_cliente_compra', '$id_final', '$pgto_crediario_final', '0', '$hoje', '$id_caixa_aberto', '$id_usuario')");



		///PARCELAS///
		$x=1;
		$valor_parcela = ($valor_final_compra/$qtd_parcelas_final);
		$prazo = 30;
		$hoje = date("Y-m-d");

		while($x<=$qtd_parcelas_final){

			$vencimento = date('Y-m-d', strtotime("+$prazo days",strtotime($hoje))); 
			$prazo = $prazo+30;

			$insere = $db->select("INSERT INTO parcelas_contas_clientes (id_venda, id_cliente, valor, vencimento) VALUES ('$id_final', '$id_cliente_compra', '$valor_parcela', '$vencimento')");
			$x++;	
		}
		


			
	}


	$update = $db->select("UPDATE produtos_venda SET id_venda='$id_final' WHERE id_venda='0' AND id_orcamento='0' AND id_usuario='$id_usuario' AND user_hash='$md5_usuario_logado'");


	///BAIXA DO ESTOQUE//
	$sil = $db->select("SELECT id_produtos, quantidade FROM produtos_venda WHERE id_venda='$id_final'");
	while($line = $db->expand($sil)){
		$id_prd = $line['id_produtos'];
		$qtd_prd = $line['quantidade'];
		$baixa = $db->select("UPDATE produtos SET estoque=estoque-$qtd_prd WHERE id='$id_prd' LIMIT 1");	
	}
	



//ORÇAMENTO
} else {

	$update = $db->select("UPDATE produtos_venda SET id_orcamento='$id_final' WHERE id_orcamento='0' AND id_venda='0' AND id_usuario='$id_usuario' AND user_hash='$md5_usuario_logado'");

}
	

$id_venda = $id_final;
require_once ("../impressao/prepara_impressao_venda.php");

echo $id_final;	

?>