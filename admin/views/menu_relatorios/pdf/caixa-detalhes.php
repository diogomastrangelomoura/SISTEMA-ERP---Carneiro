
<?php
//CONFIGURAÇOES DO BD MYSQL 
include_once("../../../config.php");

//ENDEREÇO DA BIBLIOTECA FPDF 
$end_fpdf = "../../../fpdf"; 

//ENDEREÇO ONDE SERÁ GERADO O PDF
$end_final = "";

//TIPO DO PDF GERADO 
//F-> SALVA NO ENDEREÇO ESPECIFICADO NA VAR END_FINAL 
//I-> ABRE NA TELA
$tipo_pdf = "I";

//PREPARA PARA GERAR O PDF///
define("FPDF_FONTPATH", "$end_fpdf/font/");
require_once("$end_fpdf/fpdf.php"); 

require_once("$end_fpdf/pdf_protect.php"); 
$pdf=new FPDF_Protection();
$pdf->SetProtection(array('modify', 'print'));
$pdf->AddFont('MyriadPro-Semibold','','MyriadPro-Semibold.php');

$pdf->Open(); 
$pdf->SetFont('MyriadPro-Semibold','',20);
$pdf->AddPage('P','A4'); 
$pdf->SetTitle('RELATORIO CONSOLIDADO DE VENDAS');

//LINHA//
$pdf->Line(10,3,200,3);
//LINHA//


//PESQUISA GERAL//
$sql = $db->select("SELECT caixa.*, usuarios.nome FROM caixa 
	LEFT JOIN usuarios ON caixa.id_usuario=usuarios.id
	WHERE caixa.id='$id' 
	LIMIT 1");
$ob = $db->expand($sql);	
//PESQUISA GERAL//

////CABEÇALHO RELATORIO////
$pdf->SetY(3);
$pdf->SetFont("MyriadPro-Semibold", "", 13);
$pdf->Ln(4);	
$pdf->Cell(191, 6, 'RELATÓRIO CONSOLIDADO DE VENDAS',0, 0, 'C');

$pdf->SetFont("MyriadPro-Semibold", "", 11);
$pdf->Ln(7);	
$pdf->Cell(191, 6, 'CAIXA: #'.$id.' | RESPONSÁVEL: '.$ob['nome'],0, 0, 'C');
$pdf->Ln(6);
$pdf->Cell(191, 6, 'ABERTO EM: '.data_mysql_para_user($ob['data_abertura']).' - '.substr($ob['hora_abertura'],0,5).' | '.'FINALIZADO EM: '.data_mysql_para_user($ob['data_fechamento']).' - '.substr($ob['hora_fechamento'],0,5).'',0, 0, 'C');


$pdf->SetFont("MyriadPro-Semibold", "", 9);
$pdf->SetTextColor(0,0,0);
////CABEÇALHO RELATORIO////
$pdf->Ln(11);
$pdf->SetFillColor(244,244,244);

$pdf->Cell(32, 6, 'DATA/HORA',1, 0, 'L',true);	
$pdf->Cell(88, 6, 'CLIENTE',1, 0, 'L',true);
$pdf->Cell(51, 6, 'ATENDENTE',1, 0, 'L',true);			
$pdf->Cell(20, 6, 'R$ TOTAL',1, 0, 'R',true);		
$pdf->Ln(6);

//DADOS DA VENDA
$total_vendas=0;
$sql = $db->select("SELECT aguarda_venda.*, usuarios.nome AS atendente, clientes.nome FROM aguarda_venda 
	LEFT JOIN usuarios ON aguarda_venda.id_usuario=usuarios.id
	LEFT JOIN clientes ON aguarda_venda.id_cliente=clientes.id
	WHERE aguarda_venda.id_caixa='$id' AND aguarda_venda.finalizada='1' AND aguarda_venda.valor_final_venda!='0.00'  
	ORDER BY aguarda_venda.data_pedido, aguarda_venda.pedido_inicio");
if($db->rows($sql)){
	while($row= $db->expand($sql)){


		$msg='';
		$pdf->SetFillColor(255,255,255);
		$pdf->SetTextColor(0,0,0);
		$valor_recebido_venda=0;
		$id_venda = $row['id'];
		$sel2 = $db->select("SELECT valor_caixa_real, forma_pagamento FROM pagamentos_vendas WHERE id_venda='$id_venda'");
		if($db->rows($sel2)){
			while($row2 = $db->expand($sel2)){
				$valor_recebido_venda = ($valor_recebido_venda+$row2['valor_caixa_real']);	
			}
		}
		

		if($valor_recebido_venda==0){
			$msg=' - (VENDA NÃO RECEBIDA)';
			$pdf->SetFillColor(165,36,32);
			$pdf->SetTextColor(255,255,255);
		} else if($valor_recebido_venda!=$row['valor_final_venda']){
			$msg=' - (VALOR TOTAL NÃO RECEBIDO)';
			$pdf->SetFillColor(165,36,32);
			$pdf->SetTextColor(255,255,255);
		} else {
			$total_vendas = ($total_vendas+$row['valor_final_venda']);
		}


		$pdf->Cell(32, 6, data_mysql_para_user($row['data_pedido']).' ás '.substr($row['pedido_inicio'],0,5),1, 0, 'L',true);	
		

		if(!empty($row['nome_cliente'])){
			$row['nome'] = $row['nome_cliente'];
		}

		$pdf->Cell(88, 6, $row['nome'].$msg,1, 0, 'L',true);
	


		$pdf->Cell(51, 6, $row['atendente'],1, 0, 'L',true);	


		$pdf->Cell(20, 6, 'R$ '.number_format($row['valor_final_venda'],2,".",","),1, 0, 'R',true);	
		
		$pdf->Ln(6);



		
	}

	$pdf->SetTextColor(0,0,0);
	$pdf->Ln(4);
	$pdf->SetFont("MyriadPro-Semibold", "", 11);
	
	$pdf->Cell(139, 6, '',0, 0, 'L',false);	
	$pdf->Cell(24, 6, 'TOTAL VENDAS:',0, 0, 'R',false);	
	$pdf->Cell(28, 6, 'R$ '.number_format($total_vendas,2,".",","),0, 0, 'R',false);	


} else {
	$pdf->Cell(191, 6, 'NENHUMA VENDA ENCONTRADA.',1, 0, 'C',0);
}






$total_saidas=0;
$pdf->Ln(22);
$pdf->SetFont("MyriadPro-Semibold", "", 14);
$pdf->Cell(150, 6, 'SAÍDAS DE CAIXA',0, 0, 'L',false);	

$pdf->Ln(10);
$pdf->SetFillColor(244,244,244);
$pdf->SetFont("MyriadPro-Semibold", "", 9);

$pdf->Cell(32, 6, 'DATA/HORA',1, 0, 'L',true);	
$pdf->Cell(139, 6, 'MOTIVO DA SAÍDA',1, 0, 'L',true);
$pdf->Cell(20, 6, 'R$ VALOR',1, 0, 'R',true);		
$pdf->Ln(6);
$sql = $db->select("SELECT saidas_caixa.*, usuarios.nome AS atendente FROM saidas_caixa 
	LEFT JOIN usuarios ON saidas_caixa.id_usuario=usuarios.id	
	WHERE saidas_caixa.id_caixa='$id'
	ORDER BY saidas_caixa.data, saidas_caixa.hora");
if($db->rows($sql)){
	while($row= $db->expand($sql)){

		$pdf->Cell(32, 6, data_mysql_para_user($row['data']).' ás '.substr($row['hora'],0,5),1, 0, 'L',false);	
		$pdf->Cell(139, 6, $row['motivo'],1, 0, 'L',false);	
		$pdf->Cell(20, 6, 'R$ '.number_format($row['valor_saida'],2,".",","),1, 0, 'R',false);	
		
		$pdf->Ln(6);

		$total_saidas = ($total_saidas+$row['valor_saida']);

	}


	$pdf->SetTextColor(0,0,0);
	$pdf->Ln(4);
	$pdf->SetFont("MyriadPro-Semibold", "", 11);
	
	$pdf->Cell(139, 6, '',0, 0, 'L',false);	
	$pdf->Cell(24, 6, 'TOTAL SAÍDAS:',0, 0, 'R',false);	
	$pdf->Cell(28, 6, 'R$ '.number_format($total_saidas,2,".",","),0, 0, 'R',false);	

} else {
	$pdf->Cell(191, 6, 'NENHUMA SAÍDA ENCONTRADA.',1, 0, 'C',0);
}



//SAIDA DO PDF
$pdf->Output("$end_final", "$tipo_pdf");






?>
