<?php 
require("../../admin/class/class.db.php");
require("../../admin/class/class.seguranca.php");
require("../../includes/verifica_session.php");
require("../../includes/verifica_caixa_aberto.php");

$data_hora = date("Y-m-d");

$troco_recebe = ($pagamento - $devido);
if($troco_recebe<0){$troco_recebe=0;}

if($pagamento>$devido){
	$recebido = $devido;
} else {
	$recebido = $pagamento;
}

$sql = $db->select("INSERT INTO contas_clientes (id_cliente, valor, data_debito, id_caixa_recebe, id_usuario, tipo, valor_recebe, troco_passado, forma_pagamento) VALUES ('$cliente', '$pagamento','$data_hora', '$id_caixa_aberto', '$id_usuario', '1', '$recebido', '$troco_recebe', '$forma')");	

$id = $db->last_id($sql);

//CALCULA AINDA O QUE FALTA RECEBER//
$falta_receber = ($devido-$pagamento);
if($falta_receber<0){$falta_receber=0;}


//BAIXA PARCELA//
$saldo = $recebido;

$select = $db->select("SELECT id, valor FROM parcelas_contas_clientes WHERE id_cliente='$cliente' AND data_pgto='0000-00-00' ORDER BY vencimento");
if($db->rows($select)){

	while($naw = $db->expand($select)){

		$id_parcela = $naw['id'];
		$valor_parcela = $naw['valor']; 

		if($valor_parcela<=$saldo || $saldo>=$falta_receber){
			$update = $db->select("UPDATE parcelas_contas_clientes SET data_pgto='$data_hora' WHERE id='$id_parcela' LIMIT 1");	
			$saldo = ($saldo-$valor_parcela);
		}



	}

}
/////////////////






 
require_once ("../impressao/prepara_impressao_pgto_crediario.php");


echo number_format($falta_receber,2,".",",");

?>