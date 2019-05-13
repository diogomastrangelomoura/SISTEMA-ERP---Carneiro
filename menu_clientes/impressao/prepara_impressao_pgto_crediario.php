<?php
include_once("../../admin/class/class.db.php");
include_once("../../admin/class/class.seguranca.php");
include_once("../../includes/verifica_session.php");
include_once("../../includes/verifica_dados_loja.php");
include_once("../../includes/verifica_configuracoes_loja.php");
include_once("../../diversos/funcoes_impressao.php");
include_once("../../diversos/funcoes_diversas.php");
	


	//CABEÇALHO//	
		$txt_cabecalho = array();
        
        $txt_cabecalho[] = $dados_loja['cabecalho_linha01'];         
        $txt_cabecalho[] = $dados_loja['cabecalho_linha02'];         
		$txt_cabecalho[] = $dados_loja['cabecalho_linha03'];     		
        		
		$txt_cabecalho[] = '----------------------------------------';

		$txt_cabecalho[] = 'COMPROVANTE DE PAGAMENTO'.$id;

		$txt_cabecalho[] = '----------------------------------------';
		 
		$cabecalho = array_map("centraliza", $txt_cabecalho);
	//CABEÇALHO

	

	//PAGAMENTOS//	
    $sel = $db->select("SELECT contas_clientes.*, formas_pagamento.forma, usuarios.nome, clientes.nome AS nome_cliente 
    	FROM contas_clientes 
		LEFT JOIN formas_pagamento ON contas_clientes.forma_pagamento=formas_pagamento.id
	    LEFT JOIN usuarios ON contas_clientes.id_usuario=usuarios.id
	    LEFT JOIN clientes ON contas_clientes.id_cliente=clientes.id
	    WHERE contas_clientes.id='$id'
	    LIMIT 1");
		  
		    $txt_pgto_recebidos='';
		   
			$dados_pgto = $db->expand($sel);
			$id_cliente = $dados_pgto['id_cliente'];
			$total_recebido_agora=$dados_pgto['valor'];

			$aux_valor_total = retira_acentos($dados_pgto['forma'].' RECEBIDO');
			$aux_valor_total2 = 'R$ '.number_format($dados_pgto['valor'],2,",",".");
			$total_espacos = $n_colunas - strlen($aux_valor_total);
			$total_espacos = $total_espacos- strlen($aux_valor_total2);
			$espacos = ''; 
			for($i = 0; $i < $total_espacos; $i++){
				$espacos .= ' ';
			}			
			$txt_pgto_recebidos .= $aux_valor_total.$espacos.$aux_valor_total2."\r\n";	
			

			//TROCO SE HOUVER//	
			if($dados_pgto['troco_passado']!='0.00'){				
				$txt_pgto_recebidos .=	'----------------------------------------'."\r\n";	
				$aux_valor_total = retira_acentos('TROCO');
				$aux_valor_total2 = 'R$ '.number_format($dados_pgto['troco_passado'],2,",",".");
				$total_espacos = $n_colunas - strlen($aux_valor_total);
				$total_espacos = $total_espacos- strlen($aux_valor_total2);
				$espacos = ''; 
				for($i = 0; $i < $total_espacos; $i++){
					$espacos .= ' ';
				}			
				$txt_pgto_recebidos .= $aux_valor_total.$espacos.$aux_valor_total2."\r\n";	
				$txt_pgto_recebidos .=	'----------------------------------------';					
			} else {
				$txt_pgto_recebidos .=	'----------------------------------------';		
			}	
			//TROCO SE HOUVER//
			 			  
	//PAGAMENTOS//

	//NOME DO CLIENTE//	
		$txt_nome_cliente=retira_acentos($dados_pgto['nome_cliente'])."\r\n";
		$txt_nome_cliente.=	'----------------------------------------';					
	//NOME DO CLIENTE//	


	//USUÁRIO RESPONSÁVEL//		
		$id_user = $dados_pgto['id_usuario'];		
		$selx = $db->select("SELECT nome FROM usuarios WHERE id='$id_user' LIMIT 1");	
		$dados_user_venda = $db->expand($selx); 

		$txt_fim = array();        
        $txt_fim[] = 'RECEBIDO POR: '.retira_acentos($dados_user_venda['nome'])."\r\n";                  
		$txt_fim = array_map("centraliza", $txt_fim);	

		$txt_fim2 = array();
		$txt_fim2[] = data_mysql_para_user(substr($dados_pgto['data_debito'],0,10))."\r\n";
		$txt_fim2 = array_map("centraliza", $txt_fim2);					
	//USUÁRIO RESPONSÁVEL//	


	///GERA O ARQUIVO	
	$txt = implode("\r\n", $cabecalho)
	. "\r\n"		
	.$txt_pgto_recebidos."\r\n"	
	.$txt_nome_cliente."\r\n"
	.implode("\r\n", $txt_fim)
	.implode("\r\n", $txt_fim2);



   //CAMINHO DO TXT CRIADO
  	$arquivo = 'comp_pgto_'.md5(time()).'.txt';		
    $file = '../../z_imprimir/'.$arquivo;

   $insere = $db->select("INSERT INTO arquivos_imprimir (arquivo, tipo) VALUES ('$arquivo', '1')");

   // cria o arquivo
   $_file  = fopen($file,"w");
   fwrite($_file,$txt);
   fclose($_file);



?>