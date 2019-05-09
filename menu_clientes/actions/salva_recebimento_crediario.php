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


//CALCULA AINDA O QUE FALTA RECEBER//
$falta_receber = ($devido-$pagamento);
if($falta_receber<0){$falta_receber=0;}




/////////////////////////////////////
$id = $db->last_id($sql); 
require_once ("../impressao/prepara_impressao_pgto_crediario.php");


echo number_format($falta_receber,2,".",",");

?>