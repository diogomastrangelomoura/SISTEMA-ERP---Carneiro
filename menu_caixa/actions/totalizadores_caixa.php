<?php


function retorna_data_abertura_caixa($id_caixa_aberto){


	$sel = $db->select("SELECT data_abertura FROM caixa WHERE id='$id_caixa_aberto' LIMIT 1");

	$row = $db->expand($sel);

	return $row['data_abertura'];
}




function devolve_valores_caixa($id_caixa_aberto,$tipo){

	$db=new DB();
	$totais_dinheiro=0;
	$totais_cartao=0;
	$totais_cheque=0;
	$totais_recebimento_convenio=0;

	//DINHEIRO OU CARTAO	
		$sel = $db->select("SELECT id FROM vendas WHERE id_caixa='$id_caixa_aberto' AND tipo='1'  ORDER BY id DESC");
		if($db->rows($sel)){
			while($row = $db->expand($sel)){

				$id_ven_procura = $row['id'];
				$sel2 = $db->select("SELECT valor_pagamento, forma_pagamento FROM pagamentos_vendas WHERE id_venda='$id_ven_procura' ORDER BY id DESC");
				while($row2 = $db->expand($sel2)){

						//DINHEIRO
						if($row2['forma_pagamento']==1){
							$totais_dinheiro = ($totais_dinheiro+$row2['valor_pagamento']);
						}

						//CARTÃO
						if($row2['forma_pagamento']==2){
							$totais_cartao = ($totais_cartao+$row2['valor_pagamento']);
						}

						//CARTÃO
						if($row2['forma_pagamento']==4){
							$totais_cheque = ($totais_cheque+$row2['valor_pagamento']);
						}

				}

			}

		}	


	//CONVENIO	
		$sel = $db->select("SELECT valor_recebe FROM contas_clientes WHERE id_caixa_recebe='$id_caixa_aberto' AND tipo='1'");
		if($db->rows($sel)){
			while($row = $db->expand($sel)){
					$totais_recebimento_convenio = ($totais_recebimento_convenio+$row['valor_recebe']);
			}
		}


		//DINHEIRO
		if($tipo==1){
			return $totais_dinheiro;
		}

		//CARTAO
		if($tipo==2){
			return $totais_cartao;
		}

		//CONVENIO
		if($tipo==3){
			return $totais_recebimento_convenio;
		}

		//CHEQUE
		if($tipo==4){
			return $totais_cheque;
		}

		//TOTAIS
		if($tipo==0){
			$subtotal_vendas = ($totais_dinheiro+$totais_cartao+$totais_recebimento_convenio+$totais_cheque);
			return $subtotal_vendas;
		}
}







///SAIDAS DE CAIXA
function devolve_saidas_caixa($id_caixa_aberto){

	$db=new DB();
	$totais_saidas_caixa=0;

	$sel = $db->select("SELECT valor_saida FROM saidas_caixa WHERE id_caixa='$id_caixa_aberto' ORDER BY id DESC");
	if($db->rows($sel)){
		while($row = $db->expand($sel)){
			$totais_saidas_caixa = ($totais_saidas_caixa+$row['valor_saida']);	
		}
	}
		
	return $totais_saidas_caixa;
	
}



///TROCO DE CAIXA
function devolve_troco_caixa($id_caixa_aberto){

	$db=new DB();
	$totais_troco_caixa=0;

	$sel = $db->select("SELECT valor_inicial FROM caixa WHERE id='$id_caixa_aberto' ORDER BY id DESC");
	$row = $db->expand($sel);
	$totais_troco_caixa = $row['valor_inicial'];	
		
	return $totais_troco_caixa;
	
}


///FINAL GERAL (VENDAS + TROCO - SAIDAS)
function devolve_final_caixa($id_caixa_aberto){

	$totais_final_geral=0;

	$subtotal_vendas = devolve_valores_caixa($id_caixa_aberto,0);
	$totais_troco_caixa = devolve_troco_caixa($id_caixa_aberto);
	$totais_saidas_caixa = devolve_saidas_caixa($id_caixa_aberto);

	$totais_final_geral = (($subtotal_vendas+$totais_troco_caixa)-$totais_saidas_caixa);

	return $totais_final_geral;
	
}








?>