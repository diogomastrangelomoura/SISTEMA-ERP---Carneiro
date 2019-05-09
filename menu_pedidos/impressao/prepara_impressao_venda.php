<?php
include_once("../../admin/class/class.db.php");
include_once("../../admin/class/class.seguranca.php");
include_once("../../includes/verifica_session.php");
include_once("../../includes/verifica_dados_loja.php");
include_once("../../includes/verifica_configuracoes_loja.php");
include_once("../../diversos/funcoes_impressao.php");
include_once("../../diversos/funcoes_diversas.php");
	
	$sql = $db->select("SELECT * FROM vendas WHERE id='$id_venda' LIMIT 1");
	$dados_venda = $db->expand($sql);

	//CABEÇALHO//	
		$txt_cabecalho = array();
        
        $txt_cabecalho[] = $dados_loja['cabecalho_linha01'];         
        $txt_cabecalho[] = $dados_loja['cabecalho_linha02'];         
		$txt_cabecalho[] = $dados_loja['cabecalho_linha03'];     		
		$txt_cabecalho[] = '----------------------------------------';

		if($dados_venda['tipo']==1){
			$txt_cabecalho[] = 'VENDA: #'.$id_venda;    
		} else {
			$txt_cabecalho[] = 'ORCAMENTO: #'.$id_venda;    	
		}
		
		$txt_cabecalho[] = data_mysql_para_user($dados_venda['data']).' AS '.substr($dados_venda['hora'],0,5);		
		$cabecalho = array_map("centraliza", $txt_cabecalho);
	//CABEÇALHO


	////ITENS DO PEDIDO////
	$tot_itens = 0;


	$txt_itens_cabecalho[] = array('----', '------------------------------', '-------', '-------');
    $txt_itens_cabecalho[] = array('Qtd ', 'Produto', 'V. UN', 'Total');
	$txt_itens_cabecalho[] = array('----', '------------------------------', '-------', '-------');	

	
		
		$total_itens_pedido=0;

		if($dados_venda['tipo']==1){
			$sel = $db->select("SELECT * FROM produtos_venda WHERE id_venda='$id_venda' ORDER BY id DESC");	
		} else {
			$sel = $db->select("SELECT * FROM produtos_venda WHERE id_orcamento='$id_venda' ORDER BY id DESC");		
		}
		
		
		if($db->rows($sel)){
						
			while($row = $db->expand($sel)){

				$id_produto	= $row['id_produtos'];
				
				$pg = $db->select("SELECT produto, codigo FROM produtos WHERE id='$id_produto' LIMIT 1");
				$var = $db->expand($pg);					
				$nome_produto= $var['produto'];
				

				$prod = retira_acentos($nome_produto);
				$total_prod = ($row['quantidade']*$row['valor']);
				
				//POE O ZERO NA QUANTIDADE
				$quan = explode('.', $row['quantidade']);
				
				if($quan[1]=='00'){
					if($row['quantidade']<10){$row['quantidade']= '0'.$quan[0];} else {$row['quantidade'] = $quan[0];}	
				} 
			
				$txt_itens[] = array($row['quantidade'], retira_acentos($nome_produto), number_format($row['valor'],2,",","."), number_format($total_prod,2,",","."));
				

			}


			

		}



	foreach ($txt_itens as $item) {
       			
   	     $itens[] .= addEspacos($item[0], 5, 'F')
        	. addEspacos($item[1], 35, 'F')."\r\n"
        	. addEspacos('', 26, 'I')
        	. addEspacos($item[2], 7, 'I')
            . addEspacos($item[3], 7, 'I');        	

        	$itens[] .= addEspacos('------------------------------------------------------------------', 40, 'F');
                        
    }

    foreach ($txt_itens_cabecalho as $cab) {
       
        $cabs[] = addEspacos($cab[0], 4, 'F')
        	. addEspacos($cab[1], 22, 'F')           
            . addEspacos($cab[2], 7, 'I')
            . addEspacos($cab[3], 7, 'I');
            
    }
    	

    // SUBTOTAL //
    $aux_valor_total = 'SUBTOTAL';
	$aux_valor_total2 = 'R$ '.number_format(($dados_venda['valor_total']),2,",",".");
	$total_espacos = $n_colunas - strlen($aux_valor_total);
	$total_espacos = $total_espacos- strlen($aux_valor_total2);
    $espacos = ''; 
    for($i = 0; $i < $total_espacos; $i++){
    	$espacos .= ' ';
    }
	$txt_valor_total = $aux_valor_total.$espacos.$aux_valor_total2;
    // SUBTOTAL //	


	// DESCONTO //
    if($dados_venda['valor_desconto']!='0.00'){
	    $aux_valor_total = 'DESCONTO (-)';
		$aux_valor_total2 = 'R$ '.number_format($dados_venda['valor_desconto'],2,",",".");
		$total_espacos = $n_colunas - strlen($aux_valor_total);
		$total_espacos = $total_espacos- strlen($aux_valor_total2);
	    $espacos = ''; 
	    for($i = 0; $i < $total_espacos; $i++){
	    	$espacos .= ' ';
	    }
		$txt_valor_desconto = $aux_valor_total.$espacos.$aux_valor_total2;
	
	} else {
		$txt_valor_desconto ='';
	}	
    // DESCONTO //


    // A RECEBER FINAL //  
    if($dados_venda['tipo']==1){  
	    $aux_valor_total = 'TOTAL A RECEBER (=)';
		$aux_valor_total2 = 'R$ '.number_format($dados_venda['valor_final_venda'],2,",",".");
		$total_espacos = $n_colunas - strlen($aux_valor_total);
		$total_espacos = $total_espacos- strlen($aux_valor_total2);
		$espacos = ''; 
		for($i = 0; $i < $total_espacos; $i++){
			$espacos .= ' ';
		}
		$txt_valor_final_receber = $aux_valor_total.$espacos.$aux_valor_total2."\r\n";			
	} else {
		$txt_valor_final_receber ='';	
	}
    // A RECEBER FINAL //


    //FORMAS DE PAGAMENTO SE HOUVER//	
    $sel = $db->select("SELECT pagamentos_vendas.*, formas_pagamento.forma, usuarios.nome FROM pagamentos_vendas 
		LEFT JOIN formas_pagamento ON pagamentos_vendas.forma_pagamento=formas_pagamento.id
	    LEFT JOIN usuarios ON pagamentos_vendas.id_usuario=usuarios.id
	    WHERE pagamentos_vendas.id_venda='$id_venda'
	    ORDER BY pagamentos_vendas.id");
		
		if($db->rows($sel)){

			$txt_formas_pgto = array();
		    $txt_formas_pgto[] = '----------------------------------------';
		    $txt_formas_pgto[] = 'PAGAMENTOS RECEBIDOS';         
		    $txt_formas_pgto[] = '----------------------------------------';
		    $formas_pgto = array_map("centraliza", $txt_formas_pgto);
		  
		    $txt_pgto_recebidos='';
		    $total_ja_recebido=0;

			while($dados_pgto = $db->expand($sel)){	

				$aux_valor_total = retira_acentos($dados_pgto['forma'].' (-)');

				if($dados_pgto['troco_passado']!='0.00'){
					$aux_valor_total2 = 'R$ '.number_format(($dados_pgto['valor_pagamento']+$dados_pgto['troco_passado']),2,",",".");
				} else {
					$aux_valor_total2 = 'R$ '.number_format($dados_pgto['valor_pagamento'],2,",",".");	
				}
				
				$total_espacos = $n_colunas - strlen($aux_valor_total);
				$total_espacos = $total_espacos- strlen($aux_valor_total2);
				$espacos = ''; 
				for($i = 0; $i < $total_espacos; $i++){
					$espacos .= ' ';
				}
				
				$total_ja_recebido = ($total_ja_recebido+$dados_pgto['valor_pagamento']);
				$txt_pgto_recebidos .= $aux_valor_total.$espacos.$aux_valor_total2."\r\n";	

				if($dados_pgto['troco_passado']!='0.00'){

					$aux_valor_total = retira_acentos('TROCO');
					$aux_valor_total2 = 'R$ '.number_format($dados_pgto['troco_passado'],2,",",".");
					$total_espacos = $n_colunas - strlen($aux_valor_total);
					$total_espacos = $total_espacos- strlen($aux_valor_total2);
					$espacos = ''; 
					for($i = 0; $i < $total_espacos; $i++){
						$espacos .= ' ';
					}
					$txt_pgto_recebidos .= $aux_valor_total.$espacos.$aux_valor_total2."\r\n";		
				
				} else {



				}

			}

			 $txt_pagamentos_recebidos =  "\r\n".$txt_pgto_recebidos;

			 $aux_valor_total = 'TOTAL RECEBIDO:';
			 $aux_valor_total2 = 'R$ '.number_format($total_ja_recebido,2,",",".");
			 $total_espacos = $n_colunas - strlen($aux_valor_total);
			 $total_espacos = $total_espacos- strlen($aux_valor_total2);
			 $espacos = ''; 
			 for($i = 0; $i < $total_espacos; $i++){
				$espacos .= ' ';
			 }

			 $falta_receber = ($dados_venda['valor_final_venda']-$total_ja_recebido);
			 if($falta_receber<0){$falta_receber=0;}

			 $txt_pagamentos_recebidos .=  $aux_valor_total.$espacos.$aux_valor_total2;	 

			 $aux_valor_total = 'RESTANTE A RECEBER:';
			 $aux_valor_total2 = 'R$ '.number_format($falta_receber,2,",",".");
			 $total_espacos = $n_colunas - strlen($aux_valor_total);
			 $total_espacos = $total_espacos- strlen($aux_valor_total2);
			 $espacos = ''; 
			 for($i = 0; $i < $total_espacos; $i++){
				$espacos .= ' ';
			 }

			 $txt_pagamentos_recebidos .=  "\r\n".$aux_valor_total.$espacos.$aux_valor_total2."\r\n";
			 

		} else {
			$txt_pagamentos_recebidos='';
			$formas_pgto='';
		}    
	//FORMAS DE PAGAMENTO SE HOUVER//


	//IMPRIME O NOME DO ATENDENTE NA COMANDA
	$dados_atendente = $dados_venda['id_usuario'];
	$dados_atendente = $db->select("SELECT nome FROM usuarios WHERE id='$dados_atendente' LIMIT 1");	
	$dados_atendente = $db->expand($dados_atendente);

	$dados_entrega = '----------------------------------------'."\r\n";

	if($dados_venda['id_vendedor']!=0){
		$dados_vendedor = $dados_venda['id_vendedor'];
		$dados_vendedor = $db->select("SELECT nome FROM vendedores WHERE id='$dados_vendedor' LIMIT 1");	
		$dados_vendedor = $db->expand($dados_vendedor);		
		$dados_entrega .= retira_acentos('VENDEDOR: '.$dados_vendedor['nome'])."\r\n";	
	}

	$dados_entrega .= retira_acentos('OPERADOR: '.$dados_atendente['nome'])."\r\n";	


	///GERA O ARQUIVO	
	$txt = implode("\r\n", $cabecalho)
	. "\r\n"
	.implode("\r\n", $cabs)
	. "\r\n"
	. implode("\r\n", $itens)
	. "\r\n"
	. $txt_valor_total // SubTotal	
	."\r\n"
	. $txt_valor_desconto // Desconto	
	."\r\n"
	.$txt_valor_final_receber //Final	
	.implode("\r\n", $formas_pgto)
	.$txt_pagamentos_recebidos	
	.$dados_entrega;

	

   //CAMINHO DO TXT CRIADO
   $tipo = $dados_venda['tipo'];

   if($dados_venda['tipo']==1){
   		$arquivo = 'venda_'.$id_venda.'.txt';
   } else {
   		$arquivo = 'orcamento_'.$id_venda.'.txt';
   }

   
   $file = '../../z_imprimir/'.$arquivo;

   $insere = $db->select("INSERT INTO arquivos_imprimir (arquivo, tipo) VALUES ('$arquivo', '$tipo')");

   // cria o arquivo
   $_file  = fopen($file,"w");
   fwrite($_file,$txt);
   fclose($_file);



?>